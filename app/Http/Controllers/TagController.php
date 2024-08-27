<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function search(Request $request)
    {
        $query = Tag::query();

        if ($request->q) {
            $query->where('name', 'LIKE', '%' . $request->q . '%'); // Filter by search term
        }

        $tags = $query->take(20)->pluck('name');

        $html = view('tag.list', compact('tags'))->render();

        return response()->json(['success' => true, 'html' => $html]);
    }
}
