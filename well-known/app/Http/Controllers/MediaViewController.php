<?php

namespace App\Http\Controllers;

use App\Models\Photo;

class MediaViewController extends Controller
{
    protected $imageExts = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
    protected $audioExts = ['mp3', 'wav', 'ogg', 'm4a'];
    protected $videoExts = ['mp4', 'mov', 'avi', 'mkv', 'webm'];

    /**
     * Show a shareable page that plays/displays the file inline in the
     * browser, appropriate to its type (image, audio, video, PDF, or a
     * plain download link for anything else). No auth required — this is
     * the page people get when a media link is shared with them.
     */
    public function show(Photo $photo)
    {
        $ext = strtolower(pathinfo($photo->file, PATHINFO_EXTENSION));

        $type = 'other';
        if (in_array($ext, $this->imageExts)) {
            $type = 'image';
        } elseif (in_array($ext, $this->audioExts)) {
            $type = 'audio';
        } elseif (in_array($ext, $this->videoExts)) {
            $type = 'video';
        } elseif ($ext === 'pdf') {
            $type = 'pdf';
        }

        return view('media.view', [
            'photo' => $photo,
            'type' => $type,
            'url' => url('/public/images/media/' . $photo->file),
        ]);
    }
}
