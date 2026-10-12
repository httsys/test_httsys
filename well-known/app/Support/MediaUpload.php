<?php

namespace App\Support;

use App\Models\Photo;
use Illuminate\Http\UploadedFile;

/**
 * The ONE place where media files are saved: public/images/media + a row
 * in the "photos" table. Used by the Media > Upload page and by the
 * editor's image/file picker, so both always end up in the same folder
 * and get the same /public/images/media/<file> URL.
 */
class MediaUpload
{
    public static function allowedExtensions()
    {
        return ['jpeg', 'jpg', 'png', 'gif', 'webp', 'svg', 'mp3', 'wav', 'ogg', 'm4a',
                'mp4', 'mov', 'avi', 'mkv', 'webm', 'pdf'];
    }

    /**
     * @return \App\Models\Photo
     * @throws \InvalidArgumentException when the file is not allowed
     */
    public static function store(UploadedFile $file)
    {
        if (!$file->isValid()) {
            throw new \InvalidArgumentException('The upload failed, please try again.');
        }

        $original = $file->getClientOriginalName();
        $ext = strtolower(pathinfo($original, PATHINFO_EXTENSION));

        if (!in_array($ext, self::allowedExtensions(), true)) {
            throw new \InvalidArgumentException('This file type is not allowed: .' . $ext);
        }

        // Keep letters (any language), numbers, dot, dash, underscore, space.
        $base = pathinfo($original, PATHINFO_FILENAME);
        $base = preg_replace('/[^\p{L}\p{M}\p{N}_\- ]+/u', '_', $base);
        if ($base === null || trim($base) === '') {
            $base = 'file';
        }
        $base = mb_strcut($base, 0, 120, 'UTF-8');

        $name = time() . $base . '.' . $ext;

        $file->move(MediaUrl::mediaDir(), $name);

        return Photo::create(['file' => $name]);
    }

    public static function urlFor($filename)
    {
        return '/public/images/media/' . rawurlencode($filename);
    }
}
