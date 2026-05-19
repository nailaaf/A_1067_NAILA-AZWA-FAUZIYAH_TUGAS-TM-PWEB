<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreferensiController extends Controller
{
    public function index()
    {
        return view('preferensi');
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'theme' => 'required|in:light,dark,system',
            'font_size' => 'required|in:small,medium,large',
        ]);

        $cookieTheme = cookie(name: 'theme', value: $request->theme, minutes: 43200, httpOnly: false);
        $cookieFont = cookie(name: 'font_size', value: $request->font_size, minutes: 43200, httpOnly: false);

        return response()->json([
            'success' => true,
            'message' => 'Preferensi berhasil disimpan'
        ])->withCookie($cookieTheme)->withCookie($cookieFont);
    }
}
