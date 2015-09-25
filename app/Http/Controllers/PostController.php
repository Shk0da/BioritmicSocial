<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends MainController
{

    public function send(Request $request)
    {
        $this->validate($request, [
            'post' => 'required|max:1000',
        ]);

        $this->getUser()->post()->create([
            'body' => $request->input('post'),
        ]);

        return redirect()->back();
    }


    public function comment(Request $request, $postId)
    {
        $this->validate($request, [
            'comment-'.$postId => 'required|max:1000',
        ], [
            'required' => 'Комментарий не может быть пустым'
        ]);

        $post = Post::notComment()->find($postId);

        if ($post && ($this->getUser()->isFriendWith($post->user) || $this->getUser() == $post->user)) {
            $comment = Post::create([
                'body' => $request->input('comment-'.$postId),
            ])->user()->associate($this->getUser());

            $post->comments()->save($comment);
        }

        return redirect()->back();
    }

    public function getLike($postId)
    {
        $post = Post::find($postId);
        $user = $this->getUser();

        if ($post && !$user->hasLikedPost($post)) {
            $like = $post->likes()->create([]);
            $user->likes()->save($like);
        }

        if ($user->hasLikedPost($post)) {
            $user->removeLikePost($post);
        }

        return redirect()->back();
    }
}