<?php

return [

    /*
    | Master switch for the random media links (/m/...).
    | Put MEDIA_RANDOM_LINKS=false in the .env file (then run
    | php artisan config:clear) to turn the whole system off and get the
    | old /public/images/media/<file> links back everywhere.
    */
    'random_links' => env('MEDIA_RANDOM_LINKS', true),

];
