<?php
namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Photo;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Language;

class SettingController extends Controller
{
    //

    public function edit(Request $request)
    {
        $langs = Language::all();
        if (empty($request->language)) {
            $data['lang_id'] = 0;
            $data['setting'] = Setting::firstOrFail();
        } else {
            $lang = Language::where('code', $request->language)->firstOrFail();
            $data['lang_id'] = $lang->id;
            $data['setting'] = Setting::findOrFail($lang->id);
        }


        return view('settings.edit', $data, compact('langs'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting, $langid)
    {

        $setting = Setting::where('language_id', $langid)->firstOrFail();
        
        $input = $request->all();

        $this->validate($request, [

            'photo_id' => 'mimes:jpg,jpeg,png,webp,gif,svg',
            'photo_dark_id' => 'mimes:jpg,jpeg,png,webp,gif,svg']

        );

        if ($file = $request->file('photo_id')) {
            
            $name = time() . $file->getClientOriginalName();

            $file->move('images/media/', $name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;
        }

        if ($file = $request->file('photo_dark_id')) {

            $name = time() . $file->getClientOriginalName();

            $file->move('images/media/', $name);

            $photoDark = Photo::create(['file'=>$name]);

            $input['photo_dark_id'] = $photoDark->id;
        }

        // Checkboxes aren't submitted at all when unchecked, so resolve this
        // explicitly rather than relying on it being present in $input.
        $input['email_verification_enabled'] = $request->has('email_verification_enabled');
        $input['ip_language_detection_enabled'] = $request->has('ip_language_detection_enabled');

        $setting->update($input);

        // These are single site-wide flags, not per-language content, so
        // keep every language's settings row in sync to avoid ambiguity
        // about which row actually governs behaviour.
        Setting::where('id', '!=', $setting->id)->update([
            'email_verification_enabled' => $input['email_verification_enabled'],
            'ip_language_detection_enabled' => $input['ip_language_detection_enabled'],
        ]);

        return back()->with('setting_success','Settings updated successfully!');
    }

    /**
     * Update the site-wide slider autoplay interval. This is a single
     * global value (not per-language content), so — like
     * email_verification_enabled above — every language's settings row is
     * kept in sync.
     */
    public function updateSliderAutoplay(Request $request)
    {
        $this->validate($request, [
            'slider_autoplay_seconds' => 'required|integer|min:1|max:60',
        ]);

        Setting::query()->update([
            'slider_autoplay_seconds' => $request->slider_autoplay_seconds,
        ]);

        return back()->with('slider_success', 'Slider autoplay interval updated successfully!');
    }

}
