<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Response;

class CommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::allFor(Input::get('type'), Input::get('id'));
        return Response::json($comments, 200, [], JSON_NUMERIC_CHECK);
    }


    public function store(StoreCommentRequest $request)
    {
        $model_id = Input::get('commentable_id');
        $model = Input::get('commentable_type');
        if (Comment::isCommentable($model, $model_id)) {

            $comment = Comment::create([
                'commentable_id' => Input::get('commentable_id'),
                'commentable_type' => Input::get('commentable_type'),
                'content' => Input::get('content'),
                'email' => Input::get('email'),
                'username' => Input::get('username'),
                'reply' => Input::get('reply', 0),
                'ip' => $request->ip(),
            ]);
            return Response::json($comment, 200, [], JSON_NUMERIC_CHECK);
        } else {
            return Response::json("ce contenu est non commentable", 422);
        }
        //dd(Input::get());
    }
}
