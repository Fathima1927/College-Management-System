<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = Setting::first() ?? new Setting();
        
        $data = $request->validate([
            'college_name' => 'nullable|string|max:255',
            'college_address' => 'nullable|string',
            'college_phone' => 'nullable|string|max:20',
            'college_email' => 'nullable|email|max:255',
            'report_header' => 'nullable|string',
            'report_footer' => 'nullable|string',
            'college_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('college_logo')) {
            // Delete old logo if exists
            if ($settings->college_logo && Storage::exists('public/' . $settings->college_logo)) {
                Storage::delete('public/' . $settings->college_logo);
            }
            $data['college_logo'] = $request->file('college_logo')->store('logos', 'public');
        }

        $settings->fill($data);
        $settings->save();

        return redirect()->route('settings.index')
            ->with('success', 'Settings updated successfully!');
    }
}