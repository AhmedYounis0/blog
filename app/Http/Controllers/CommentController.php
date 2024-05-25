<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(CommentStoreRequest $request)
    {
        $data = $request->validated();

        Comment::create($data);

        return back()->with('commentCreateSuccess','Your comment has been added successfully');

    }
}
