<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Photo;
use Illuminate\Http\Request;

class PostController extends MainController
{

    public function send(Request $request)
    {
        $hasAttach = $request->hasFile('attach');
        $this->validate($request, [
            'post' => !$hasAttach ? 'required|' : '' . 'max:1000',
        ], [
            'required' => 'Напишите что-нибудь =)'
        ]);

        $attach = [];
        if ($hasAttach) {
            $attach = $this->saveAttach($request);
        }

        $this->getUser()->post()->create([
            'body' => $request->input('post'),
            'attach' => serialize($attach),
        ]);

        return redirect()->back();
    }


    public function comment(Request $request, $postId)
    {
        $hasAttach = $request->hasFile('attach');

        $this->validate($request, [
            'comment-'.$postId => !$hasAttach ? 'required|' : '' . 'max:1000',
        ], [
            'required' => 'Комментарий не может быть пустым'
        ]);

        $post = Post::notComment()->find($postId);

        if ($post && ($this->getUser()->isFriendWith($post->user) || $this->getUser() == $post->user)) {

            $attach = [];
            if ($hasAttach) {
                $attach = $this->saveAttach($request);
            }

            $comment = Post::create([
                'body' => $request->input('comment-'.$postId),
                'attach' => serialize($attach),
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

    public function repost($postId)
    {
        $post = Post::find($postId);
        $this->getUser()->post()->create([
            'body' => $post->body,
        ]);

        return redirect()->back();
    }

    public function delete($postId)
    {
        $post = Post::find($postId);
        if ($this->getUser()->id == $post->user->id) {

            $comments = Post::where('parent_id', $postId)->get();

            foreach ($comments as $comment) {
                $this->clearLikes($comment);
                $comment->delete();
            }

            $this->clearLikes($post);
            $post->delete();
        }

        return redirect()->back();
    }

    public function saveAttach($request)
    {
        $attach = [];
        $files = $request->file('attach');
        foreach ($files as $file) {
            $path = '/image/album/'.$this->getUser()->id.'/';
            $fileName = md5_file($file->getRealPath());
            $file->move($path, $fileName);

            $photo = new Photo();
            $photo->user_id = $this->getUser()->id;
            $photo->tag = 'upload';
            $photo->path = $path.$fileName;
            $photo->save();

            $attach[] = $photo->id;
        }

        return $attach;
    }

    public function clearLikes(Post $post)
    {
        $like = $post->likes
            ->where('like_id', $post->id)
            ->where('like_type', get_class($post))
            ->first();

        if ($like)
            $like->delete();
    }
}