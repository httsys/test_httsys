<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMediaLinkUsesTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('media_link_uses')) {
            DB::statement('CREATE TABLE `media_link_uses` (
                `token_hash` CHAR(32) NOT NULL,
                `used_at` INT UNSIGNED NOT NULL,
                PRIMARY KEY (`token_hash`),
                KEY `used_at` (`used_at`)
            ) ENGINE=InnoDB DEFAULT CHARSET=ascii');
        }
    }

    public function down()
    {
        Schema::dropIfExists('media_link_uses');
    }
}
