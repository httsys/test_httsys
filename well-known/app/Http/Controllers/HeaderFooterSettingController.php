<?php
namespace App\Http\Controllers;

use App\Models\HeaderFooterSetting;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Language;
use DB;

class HeaderFooterSettingController extends Controller
{
    //

    public function edit(Request $request)
    {

        $langs = Language::all();
        if (empty($request->language)) {
            $data['lang_id'] = 0;
            $data['setting'] = HeaderFooterSetting::firstOrFail();
        } else {
            $lang = Language::where('code', $request->language)->firstOrFail();
            $data['lang_id'] = $lang->id;
            $data['setting'] = HeaderFooterSetting::findOrFail($lang->id);
        }

        return view('settings.headerfooter.headerfooter-edit', $data, compact('langs'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HeaderFooterSetting $setting, $langid)
    {
        $setting = HeaderFooterSetting::where('language_id', $langid)->firstOrFail();
        
        $input = $request->all();

        // Font-size fields: whole pixels between 8 and 120, or empty = theme default.
        // Only touched when the submitted form actually contains them, so saving one
        // section never wipes another section's sizes.
        foreach (['typed_font_size', 'footer_col1_subtitle_size', 'footer_col1_title_size',
                  'footer_col2_title_size', 'footer_col2_text_size', 'footer_copyright_size'] as $sizeField) {
            if (! array_key_exists($sizeField, $input)) {
                continue;
            }
            $value = trim((string) $input[$sizeField]);
            if ($value === '' || ! ctype_digit($value)) {
                $input[$sizeField] = null;
            } else {
                $input[$sizeField] = max(8, min(120, (int) $value));
            }
        }

        $setting->update($input);

        return back()->with('setting_success','Settings updated successfully!');
    }


}


