<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SistemController extends Controller
{
    public function index()
    {
        $appStatus = Setting::get('app_status', 'open');
        return view('admin.sistem.index', compact('appStatus'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'app_status' => 'required|in:open,closed'
        ]);

        Setting::set('app_status', $request->app_status);

        return redirect()->route('admin.sistem.index')
            ->with('success', 'Status aplikasi berhasil diperbarui!');
    }
}