<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function sendComment(Request $request)
    {
        $request['user_id'] = Auth::user()->id;
        Comment::create($request->all());
        return back();
    }
}
