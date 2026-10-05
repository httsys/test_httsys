<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\NotificationSetting;
use App\Models\Photo;
use Illuminate\Http\Request;

class NotificationSettingController extends Controller
{
    public function edit(Request $request)
    {
        $langs = Language::all();

        if (empty($request->language)) {
            $lang = Language::where('is_default', 1)->first() ?? $langs->first();
        } else {
            $lang = Language::where('code', $request->language)->firstOrFail();
        }

        $data['lang_id'] = $lang->id;
        $data['setting'] = NotificationSetting::findOrFail($lang->id);

        return view('settings.notification.edit', $data, compact('langs'));
    }

    public function update(Request $request, $langid)
    {
        $this->validate($request, [
            'title' => 'nullable|string|max:191',
            'description' => 'nullable|string|max:1000',
            'badge_text' => 'nullable|string|max:60',
            'button_text' => 'nullable|string|max:60',
            'button_link' => 'nullable|string|max:2000',
            'photo_id' => 'nullable|mimes:jpg,jpeg,png,webp,gif,svg',
        ]);

        $setting = NotificationSetting::findOrFail($langid);

        $input = $request->except(['photo_id', 'is_enabled']);

        if ($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images/media/', $name);
            $photo = Photo::create(['file' => $name]);
            $input['photo_id'] = $photo->id;
        }

        // Checkboxes aren't submitted at all when unchecked, so resolve
        // this explicitly rather than relying on it being present.
        $input['is_enabled'] = $request->has('is_enabled');

        $setting->update($input);

        return back()->with('notification_success', 'Notification settings updated successfully!');
    }
}
