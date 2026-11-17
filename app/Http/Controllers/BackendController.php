<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackendController extends Controller
{
    public function summernoteImageUpload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);
        $path = $request->file('image')->store('summernote_uploads', 'public');
        $url = asset('storage/'. $path);
        return response()->json(['url' => $url]);
    }
}
