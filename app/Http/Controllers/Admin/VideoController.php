<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class VideoController extends Controller
{
    /**
     * Display all YouTube and Instagram videos.
     */
    public function index()
    {
        $videos = Video::query()
            ->orderBy('sort_order', 'asc')
            ->orderByDesc('id')
            ->paginate(12);

        return view('admin.videos.index', compact('videos'));
    }

    /**
     * Show create video form.
     */
    public function create()
    {
        return view('admin.videos.form', [
            'video' => new Video(),
        ]);
    }

    /**
     * Store YouTube or Instagram video.
     */
    public function store(Request $request)
    {
        $data = $this->validatedData($request, true);

        // Extract and validate platform-specific video ID.
        $data['video_id'] = $this->extractVideoId(
            $data['platform'],
            $data['video_url']
        );

        // Upload custom thumbnail.
        $data['thumbnail'] = $request
            ->file('thumbnail')
            ->store('videos/thumbnails', 'public');

        try {
            Video::create($data);
        } catch (\Throwable $exception) {

            // Remove uploaded thumbnail if database save fails.
            Storage::disk('public')->delete($data['thumbnail']);

            throw $exception;
        }

        return redirect()
            ->route('admin.videos.index')
            ->with('success', 'Video added successfully.');
    }

    /**
     * Show edit form.
     */
    public function edit(Video $video)
    {
        return view('admin.videos.form', compact('video'));
    }

    /**
     * Update video information.
     */
    public function update(Request $request, Video $video)
    {
        $data = $this->validatedData($request, false);

        // Re-extract ID if platform or video URL changes.
        $data['video_id'] = $this->extractVideoId(
            $data['platform'],
            $data['video_url']
        );

        $oldThumbnail = $video->thumbnail;
        $newThumbnail = null;

        if ($request->hasFile('thumbnail')) {

            $newThumbnail = $request
                ->file('thumbnail')
                ->store('videos/thumbnails', 'public');

            $data['thumbnail'] = $newThumbnail;
        }

        try {
            $video->update($data);
        } catch (\Throwable $exception) {

            if ($newThumbnail) {
                Storage::disk('public')->delete($newThumbnail);
            }

            throw $exception;
        }

        // Delete old thumbnail only after successful update.
        if ($newThumbnail && $oldThumbnail) {
            Storage::disk('public')->delete($oldThumbnail);
        }

        return redirect()
            ->route('admin.videos.index')
            ->with('success', 'Video updated successfully.');
    }

    /**
     * Delete video and its thumbnail.
     */
    public function destroy(Video $video)
    {
        $thumbnail = $video->thumbnail;

        $video->delete();

        if ($thumbnail) {
            Storage::disk('public')->delete($thumbnail);
        }

        return redirect()
            ->route('admin.videos.index')
            ->with('success', 'Video deleted successfully.');
    }

    /**
     * Validate admin video form.
     */
    private function validatedData(
        Request $request,
        bool $creating
    ): array {

        return $request->validate([
            'title' => [
                'required',
                'string',
                'max:180',
            ],

            'platform' => [
                'required',
                'in:youtube,instagram',
            ],

            'video_url' => [
                'required',
                'url',
                'max:2000',
            ],

            'thumbnail' => [
                $creating ? 'required' : 'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:3072',
            ],

            'is_active' => [
                'required',
                'boolean',
            ],

            'is_celebrity' => [
                'required',
                'boolean',
            ],

            'sort_order' => [
                'required',
                'integer',
                'min:0',
            ],
        ]);
    }

    /**
     * Extract YouTube ID or Instagram shortcode.
     */
    private function extractVideoId(
        string $platform,
        string $url
    ): string {

        $parts = parse_url($url);

        if (!is_array($parts)) {
            throw ValidationException::withMessages([
                'video_url' => 'Invalid video URL.',
            ]);
        }

        $scheme = strtolower($parts['scheme'] ?? '');
        $host = strtolower($parts['host'] ?? '');

        // Remove optional www. prefix.
        $host = preg_replace('/^www\./', '', $host);

        $path = trim($parts['path'] ?? '', '/');

        // Only secure HTTPS links.
        if ($scheme !== 'https') {
            throw ValidationException::withMessages([
                'video_url' => 'Please enter a valid HTTPS video URL.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | YOUTUBE URL VALIDATION
        |--------------------------------------------------------------------------
        |
        | Supported examples:
        |
        | https://www.youtube.com/watch?v=VIDEO_ID
        | https://youtu.be/VIDEO_ID
        | https://www.youtube.com/shorts/VIDEO_ID
        | https://www.youtube.com/embed/VIDEO_ID
        | https://www.youtube.com/live/VIDEO_ID
        |
        */

        if ($platform === 'youtube') {

            $id = null;

            // Short YouTube URL
            if ($host === 'youtu.be') {

                $id = explode('/', $path)[0] ?? null;

            } elseif (
                in_array($host, [
                    'youtube.com',
                    'm.youtube.com',
                    'youtube-nocookie.com',
                    'music.youtube.com',
                ], true)
            ) {

                // Standard YouTube watch URL
                if ($path === 'watch') {

                    parse_str(
                        $parts['query'] ?? '',
                        $query
                    );

                    $id = $query['v'] ?? null;

                } elseif (
                    preg_match(
                        '~^(shorts|embed|live)/([A-Za-z0-9_-]{11})$~',
                        $path,
                        $matches
                    )
                ) {

                    $id = $matches[2];
                }
            }

            // Validate YouTube video ID format.
            if (
                !is_string($id) ||
                !preg_match(
                    '/^[A-Za-z0-9_-]{11}$/',
                    $id
                )
            ) {

                throw ValidationException::withMessages([
                    'video_url' =>
                        'Invalid YouTube video link. Please use a valid YouTube video or Shorts URL.',
                ]);
            }

            return $id;
        }

        /*
        |--------------------------------------------------------------------------
        | INSTAGRAM URL VALIDATION
        |--------------------------------------------------------------------------
        |
        | Supported examples:
        |
        | https://www.instagram.com/reel/SHORTCODE/
        | https://www.instagram.com/reels/SHORTCODE/
        | https://www.instagram.com/p/SHORTCODE/
        | https://www.instagram.com/tv/SHORTCODE/
        |
        */

        if ($platform === 'instagram') {

            if (
                $host === 'instagram.com' &&
                preg_match(
                    '~^(reel|reels|p|tv)/([A-Za-z0-9_-]+)/?$~',
                    $path,
                    $matches
                )
            ) {

                return $matches[2];
            }

            throw ValidationException::withMessages([
                'video_url' =>
                    'Invalid Instagram link. Please use a public Instagram Reel or Post URL.',
            ]);
        }

        throw ValidationException::withMessages([
            'platform' => 'Unsupported video platform.',
        ]);
    }
}
