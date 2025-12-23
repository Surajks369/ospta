<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function __construct()
    {
        // Apply upload size check to store and update actions so oversized uploads are handled gracefully
        $this->middleware('check.upload.size')->only(['store', 'update']);
    }
    public function index()
    {
        $galleries = Gallery::orderBy('sort_order')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            // image is required only when type is image
            'image' => 'required_if:type,image|image|mimes:jpeg,png,jpg,gif|max:10240',
            'type' => 'required|in:image,video',
            // video_url is required only when type is video
            'video_url' => 'required_if:type,video|nullable|url',
            'status' => 'boolean',
            'sort_order' => 'integer'
        ]);

        $data = $request->except(['image']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('gallery', 'public');
        } else {
            // explicitly set image to null for video items so DB nullable column receives NULL
            $data['image'] = null;
        }

        Gallery::create($data);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery item created successfully.');
    }

    public function show(Gallery $gallery)
    {
        return view('admin.galleries.show', compact('gallery'));
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            // allow up to 10 MB (10240 KB)
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'type' => 'required|in:image,video',
            // video_url required when type=video
            'video_url' => 'required_if:type,video|nullable|url',
            'status' => 'boolean',
            'sort_order' => 'integer'
        ]);

        // If the updated type is 'image', ensure there is an image either already stored or uploaded now
        if ($request->input('type') === 'image') {
            $hasExisting = !empty($gallery->image);
            $hasUploaded = $request->hasFile('image');
            if (!$hasExisting && !$hasUploaded) {
                return redirect()->back()
                    ->withErrors(['image' => 'Image is required when type is image.'])
                    ->withInput();
            }
        }

        $data = $request->except(['image']);

        // If type is video and admin did not upload a new image, remove existing image (if any)
        if ($request->input('type') === 'video' && !$request->hasFile('image') && $gallery->image) {
            Storage::disk('public')->delete($gallery->image);
            $data['image'] = null;
        }

        if ($request->hasFile('image')) {
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }
            $data['image'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update($data);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery item updated successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery item deleted successfully.');
    }
}
