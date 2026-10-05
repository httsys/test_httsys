<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFontSizesToHeaderFooterSettingsTable extends Migration
{
    /**
     * Font sizes (in px) the admin can set for the footer / typed-text
     * section. NULL = use the default size from the theme CSS.
     */
    protected $columns = [
        'typed_font_size',           // the quote text above the footer ("Typed title")
        'footer_col1_subtitle_size', // small line above the big footer heading
        'footer_col1_title_size',    // big footer heading
        'footer_col2_title_size',    // "Quick Links" / "Say Hello" titles
        'footer_col2_text_size',     // the link lists / text under those titles
        'footer_copyright_size',     // copyright line
    ];

    public function up()
    {
        if (! Schema::hasTable('header_footer_settings')) {
            return;
        }

        foreach ($this->columns as $column) {
            if (! Schema::hasColumn('header_footer_settings', $column)) {
                Schema::table('header_footer_settings', function (Blueprint $table) use ($column) {
                    $table->unsignedSmallInteger($column)->nullable();
                });
            }
        }
    }

    public function down()
    {
        foreach ($this->columns as $column) {
            if (Schema::hasTable('header_footer_settings') && Schema::hasColumn('header_footer_settings', $column)) {
                Schema::table('header_footer_settings', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
}
