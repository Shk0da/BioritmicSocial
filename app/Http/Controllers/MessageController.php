<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests;


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

        if ($request->method() == 'POST') {
            $this->validate($request, [
                'message' => 'required|max:1000',
            ], [
                'required' => 'Ваше сообщение пустое'
            ]);

            $this->factoryMessage($this->getUser()->id, $id, $request->input('message'));
        }

        $messages = Message::orderBy('created_at', 'desc')->get();

        $view->with('content', view('message.chat')
            ->with('user', $this->getUser())
            ->with('to', User::find($id))
            ->with('messages', $messages)
        );

        return $view;
    }

    public function factoryMessage($from, $to, $text)
    {
        Message::create(
            [
                'from' => $from,
                'to' => $to,
                'text' => $text,
            ]
        );
    }
}
