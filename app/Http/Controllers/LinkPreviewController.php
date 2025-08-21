<?php

namespace App\Http\Controllers;

use Embed\Embed;
use Illuminate\Http\Request;

class LinkPreviewController extends Controller
{
    public function preview(Request $request)
    {
        $url = $request->input('url');
        $embed = new Embed;
        $info = $embed->get($url);

        return response()->json([
            'title' => $info->title,
            'description' => $info->description,
            'image' => $info->image,
        ]);
    }
}
