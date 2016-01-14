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

        $message = Message::class;
        $message::create(
            [
                'from' => $this->getUser()->id,
                'to' => $request->input('to'),
                'text' => $request->input('message'),
            ]
        );

        return redirect()->back();
    }

    public function chat($id)
    {
        $view = $this->view;

        $messages = Message::orderBy('created_at', 'desc')->get();

        $view->with('content', view('message.chat')
            ->with('user', $this->getUser())
            ->with('to', User::find($id))
            ->with('messages', $messages)
        );

        return $view;
    }
}
