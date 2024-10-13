<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Embed\Embed;

class LinkPreviewController extends Controller
{
    public function preview(Request $request)
    {
        $url = $request->input('url');
        $embed = new Embed();
        $info = $embed->get($url);

        return response()->json([
            'title' => $info->title,
            'description' => $info->description,
            'image' => $info->image,
        ]);
    }
}
