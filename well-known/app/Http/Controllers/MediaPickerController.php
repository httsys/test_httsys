<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Support\MediaUpload;
use Illuminate\Http\Request;

/**
 * File picker used by the text editor (TinyMCE) "image / media / file"
 * buttons. It lists and uploads into the same media library as
 * Admin > Media, so there is only one storage folder.
 */
class MediaPickerController extends Controller
{
    protected $groups = [
        'image' => ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp'],
        'media' => ['mp4', 'webm', 'mov', 'avi', 'mkv', 'mp3', 'wav', 'ogg', 'm4a'],
    ];

    public function index(Request $request)
    {
        $type = (string) $request->query('type', 'image');
        $search = trim((string) $request->query('q', ''));

        $query = Photo::orderBy('id', 'desc');

        if (isset($this->groups[$type])) {
            $exts = $this->groups[$type];
            $query->where(function ($q) use ($exts) {
                foreach ($exts as $ext) {
                    $q->orWhere('file', 'like', '%.' . $ext);
                }
            });
        }

        if ($search !== '') {
            $like = str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $search);
            $query->where('file', 'like', '%' . $like . '%');
        }

        $photos = $query->paginate(40)->appends($request->query());

        $items = [];
        foreach ($photos as $photo) {
            $items[] = [
                'name' => $photo->file,
                'url' => MediaUpload::urlFor($photo->file),
                'is_image' => (bool) preg_match('/\.(jpe?g|png|gif|webp|svg|bmp)$/i', $photo->file),
            ];
        }

        return view('media.picker', compact('photos', 'items', 'type', 'search'));
    }

    public function upload(Request $request)
    {
        $file = $request->file('file');

        if (!$file) {
            return response()->json(['error' => 'No file received.'], 422);
        }

        try {
            $photo = MediaUpload::store($file);
        } catch (\InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }

        return response()->json(['file' => $photo->file, 'url' => MediaUpload::urlFor($photo->file)]);
    }
}
