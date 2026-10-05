<?php

/*
|--------------------------------------------------------------------------
| Documentation for this config :
|--------------------------------------------------------------------------
| online  => http://unisharp.github.io/laravel-filemanager/config
| offline => vendor/unisharp/laravel-filemanager/docs/config.md
|
| NOTE: this file was previously written for an older lfm version and did
| not match keys read by the installed v2.2.0 package (folder_categories.*,
| allow_private_folder, should_validate_mime, etc). Rewritten to match.
 */

return [

    'use_package_routes'       => true,

    // NOTE: this key is NOT read by the installed v2.2.0 package - its route
    // group prefix is hardcoded to 'filemanager' in the service provider.
    // Left here for documentation only; the real URL is /filemanager
    'prefix'                   => 'laravel-filemanager',

    // For laravel 5.1+, keep 'auth' so only logged-in admins can upload.
    'middlewares'               => ['web', 'auth'],

    // If true, laravel-filemanager creates private folders for each signed-in user.
    'allow_private_folder'     => true,

    'private_folder_name'      => UniSharp\LaravelFilemanager\Handlers\ConfigHandler::class,

    'allow_shared_folder'      => true,

    'shared_folder_name'       => 'shares',

    /*
    |--------------------------------------------------------------------------
    | Folder Categories
    |--------------------------------------------------------------------------
    | 'image' powers the TinyMCE "image" picker.
    | 'file'  powers the TinyMCE "media" picker (this is where video/audio go).
     */
    'folder_categories'        => [
        'file'  => [
            'folder_name'  => 'files',
            'startup_view' => 'grid',
            'max_size'     => 3000000, // KB (~3GB) - raise further if you host even longer videos
            'valid_mime'   => [
                'image/jpeg',
                'image/pjpeg',
                'image/png',
                'image/gif',
                'image/svg+xml',
                'application/pdf',
                'text/plain',
                // video
                'video/mp4',
                'video/webm',
                'video/ogg',
                'video/quicktime',
                'video/x-matroska', // .mkv - note: most browsers CANNOT play mkv in <video>, see chat
                // audio
                'audio/mpeg',
                'audio/mp3',
                'audio/wav',
                'audio/ogg',
            ],
        ],
        'image' => [
            'folder_name'  => 'photos',
            'startup_view' => 'grid',
            'max_size'     => 50000, // KB
            'valid_mime'   => [
                'image/jpeg',
                'image/pjpeg',
                'image/png',
                'image/gif',
                'image/svg+xml',
            ],
        ],
    ],

    'paginator' => [
        'perPage' => 30,
    ],

    'disk'                      => 'public',

    // If true, the uploaded file will be renamed to uniqid() + file extension.
    'rename_file'               => false,

    'rename_duplicates'         => false,

    // If rename_file is false and this is true, non-alphanumeric characters in filename are replaced.
    'alphanumeric_filename'     => true,

    // If true, non-alphanumeric folder names are not allowed.
    'alphanumeric_directory'    => false,

    // Actually enforce the mime/size limits set above.
    'should_validate_size'      => true,

    'should_validate_mime'      => true,

    // behavior on files with identical name
    'over_write_on_duplicate'   => false,

    /*
    |--------------------------------------------------------------------------
    | Thumbnail
    |--------------------------------------------------------------------------
     */
    'should_create_thumbnails'  => true,

    'thumb_folder_name'         => 'thumbs',

    // Only these get an auto-generated thumbnail (video/audio don't apply here).
    'raster_mimetypes'          => [
        'image/jpeg',
        'image/pjpeg',
        'image/png',
    ],

    'thumb_img_width'           => 200, // px
    'thumb_img_height'          => 200, // px

    /*
    |--------------------------------------------------------------------------
    | File Extension Information (display only - labels & icons in the UI)
    |--------------------------------------------------------------------------
     */
    'file_type_array'           => [
        'pdf'  => 'Adobe Acrobat',
        'doc'  => 'Microsoft Word',
        'docx' => 'Microsoft Word',
        'xls'  => 'Microsoft Excel',
        'xlsx' => 'Microsoft Excel',
        'zip'  => 'Archive',
        'gif'  => 'GIF Image',
        'jpg'  => 'JPEG Image',
        'jpeg' => 'JPEG Image',
        'png'  => 'PNG Image',
        'ppt'  => 'Microsoft PowerPoint',
        'pptx' => 'Microsoft PowerPoint',
        'mp4'  => 'MP4 Video',
        'webm' => 'WebM Video',
        'mov'  => 'QuickTime Video',
        'mp3'  => 'MP3 Audio',
        'wav'  => 'WAV Audio',
        'ogg'  => 'OGG Audio',
    ],

    'file_icon_array'           => [
        'pdf'  => 'fa-file-pdf-o',
        'doc'  => 'fa-file-word-o',
        'docx' => 'fa-file-word-o',
        'xls'  => 'fa-file-excel-o',
        'xlsx' => 'fa-file-excel-o',
        'zip'  => 'fa-file-archive-o',
        'gif'  => 'fa-file-image-o',
        'jpg'  => 'fa-file-image-o',
        'jpeg' => 'fa-file-image-o',
        'png'  => 'fa-file-image-o',
        'ppt'  => 'fa-file-powerpoint-o',
        'pptx' => 'fa-file-powerpoint-o',
        'mp4'  => 'fa-file-video-o',
        'webm' => 'fa-file-video-o',
        'mov'  => 'fa-file-video-o',
        'mp3'  => 'fa-file-audio-o',
        'wav'  => 'fa-file-audio-o',
        'ogg'  => 'fa-file-audio-o',
    ],

    /*
    |--------------------------------------------------------------------------
    | php.ini override
    |--------------------------------------------------------------------------
    | Note: 'upload_max_filesize' & 'post_max_size' are NOT controllable here -
    | those must be raised in your actual php.ini (see php.ini at project root)
    | or video uploads over that size will fail before lfm even sees them.
     */
    'php_ini_overrides'         => [
        'memory_limit' => '256M',
    ],
];
