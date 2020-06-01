<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Support\Facades\Input;
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
                'commentable_id' => $model_id,
                'commentable_type' => $model,
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

    public function destroy($id)
    {
        $comment = Comment::find($id);
        if ($comment->ip == \Illuminate\Support\Facades\Request::ip()) {
            Comment::where('reply', '=', $comment->id)->delete();
            $comment->delete();
            // dd(Comment::find($id));
            return Response::json($comment, 200, [], JSON_NUMERIC_CHECK);
        } else {
            return Response::json('ce comment ne vous appartient pas', 403);
        }
    }
}
