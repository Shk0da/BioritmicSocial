<?php

namespace App\Http\Controllers;

use App\Models\Dialog;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;


class MessageController extends MainController
{
    public function main(Request $request)
    {
        if ($request->method() == 'POST') {
            $result =  $this->create($request);
        } else {
            $result =  $this->index();
        }

        return $result;
    }

    public function index()
    {
        $view = $this->view;
        $view->with('content', view('layout.message')
            ->with('user', $this->getUser())
        );

        return $view;
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'message' => 'required|max:1000',
            'to' => 'required',
        ], [
            'required' => 'Заполните все поля'
        ]);

        $this->factoryMessage($this->getUser()->id, $request->input('to'), $request->input('message'));

        return redirect()->back();
    }

    public function chat(Request $request, $id)
    {
        $view = $this->view;
        $fromUser = $this->getUser();
        $toUser = User::find($id);
        $thisUserId = $fromUser->id;

        if (!$toUser)
            App::abort(404);

        if ($request->method() == 'POST') {
            $this->validate($request, [
                'message' => 'required|max:1000',
            ], [
                'required' => 'Ваше сообщение пустое'
            ]);

            $this->factoryMessage($fromUser->id, $id, $request->input('message'));
        }

        $messages = Message::
            where(function ($query) use ($id, $thisUserId) {
                $query->where('from', $thisUserId)
                    ->where('to', $id);
            })
            ->orWhere(function ($query) use ($id, $thisUserId) {
                $query->where('to', $thisUserId)
                    ->where('from', $id);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($messages as $message) {
            if ($message->to == $fromUser->id && $message->read != 1) {
                $message->read = true;
                $message->save();
            }
        }

        $view->with('content', view('message.chat')
            ->with('user', $fromUser)
            ->with('to', $toUser)
            ->with('messages', $messages)
        );

        return $view;
    }

    public function factoryMessage($from, $to, $text)
    {
//        $fromUser = User::find($from);
//        $toUser = User::find($to);
//
//        if (!$fromUser || !$toUser || !$fromUser->isFriendWith($toUser))
//            App::abort(403);
//
//        $dialog = Dialog::getOrCreate($from, $to);
//
//        Message::create(
//            [
//                'from' => $from,
//                'to' => $to,
//                'text' => $text,
//                'dialog' => $dialog->id,
//            ]
//        );
    }

    public function delete($id)
    {
        $thisUser = $this->getUser();
        $dialog = Dialog::getOrCreate($thisUser->id, $id);
        //@TODO скрытие сообщений

        return redirect()->back();
    }
}
