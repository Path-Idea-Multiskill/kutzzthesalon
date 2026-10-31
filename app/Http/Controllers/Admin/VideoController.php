<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::orderBy('sort_order')
            ->latest()
            ->paginate(12);

        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.videos.form', [
            'video' => new Video(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request, true);

        $data['video_id'] = $this->extractVideoId(
            $data['platform'],
            $data['video_url']
        );

        $data['thumbnail'] = $request
            ->file('thumbnail')
            ->store('videos/thumbnails', 'public');

        Video::create($data);

        return redirect()
            ->route('admin.videos.index')
            ->with('success', 'Video added successfully.');
    }

    public function edit(Video $video)
    {
        return view('admin.videos.form', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $data = $this->validatedData($request, false);

        $data['video_id'] = $this->extractVideoId(
            $data['platform'],
            $data['video_url']
        );

        if ($request->hasFile('thumbnail')) {
            $newThumbnail = $request
                ->file('thumbnail')
                ->store('videos/thumbnails', 'public');

            if ($video->thumbnail) {
                Storage::disk('public')->delete($video->thumbnail);
            }

            $data['thumbnail'] = $newThumbnail;
        }

        $video->update($data);

        return redirect()
            ->route('admin.videos.index')
            ->with('success', 'Video updated successfully.');
    }

    public function destroy(Video $video)
    {
        if ($video->thumbnail) {
            Storage::disk('public')->delete($video->thumbnail);
        }

        $video->delete();

        return redirect()
            ->route('admin.videos.index')
            ->with('success', 'Video deleted successfully.');
    }

    private function validatedData(
        Request $request,
        bool $creating
    ): array {
        return $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'platform' => ['required', 'in:youtube,instagram'],
            'video_url' => ['required', 'url', 'max:2000'],
            'thumbnail' => [
                $creating ? 'required' : 'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:3072',
            ],
            'is_active' => ['required', 'boolean'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ]);
    }

    private function extractVideoId(
        string $platform,
        string $url
    ): string {
        $parts = parse_url($url);

        $host = strtolower($parts['host'] ?? '');
        $host = preg_replace('/^www\./', '', $host);

        $path = trim($parts['path'] ?? '', '/');

        if (($parts['scheme'] ?? '') !== 'https') {
            throw ValidationException::withMessages([
                'video_url' => 'Please enter a valid HTTPS video URL.',
            ]);
        }

        if ($platform === 'youtube') {
            $id = null;

            if ($host === 'youtu.be') {
                $id = explode('/', $path)[0] ?? null;
            } elseif (
                in_array($host, [
                    'youtube.com',
                    'm.youtube.com',
                    'youtube-nocookie.com',
                ], true)
            ) {
                if ($path === 'watch') {
                    parse_str($parts['query'] ?? '', $query);
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

            if (
                !is_string($id) ||
                !preg_match('/^[A-Za-z0-9_-]{11}$/', $id)
            ) {
                throw ValidationException::withMessages([
                    'video_url' => 'Invalid YouTube video link.',
                ]);
            }

            return $id;
        }

        if (
            $platform === 'instagram' &&
            $host === 'instagram.com' &&
            preg_match(
                '~^(reel|reels|p|tv)/([A-Za-z0-9_-]+)(?:/.*)?$~',
                $path,
                $matches
            )
        ) {
            return $matches[2];
        }

        throw ValidationException::withMessages([
            'video_url' => 'Invalid Instagram video link.',
        ]);
    }
}
