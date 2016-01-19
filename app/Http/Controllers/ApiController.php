<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class ApiController extends MainController
{

    public function main($action, Request $request)
    {
        if (method_exists($this, $action))
            return $this->$action($request);

        return 0;
    }

    public function getCityList($request = null)
    {
        $country = $request->input('country') ?: null;
        $list = $this->getUser()->getCityList($country);
        return $list;
    }

    public function getClientInfo()
    {
        return Auth::user()->getRealAgentInfo();
    }

    public function getNewMessage($request = null)
    {
        $result = [];
        $from = User::find($request->input('from'));
        $to = User::find($request->input('to'));

        if ($from->isFriendWith($to) && ($this->getUser()->id == $to->id)) {
            $messages = Message::where('read', 0)
                ->where('from', $from->id)
                ->where('to', $to->id)
                ->orderBy('created_at')
                ->get();

            foreach ($messages as $message) {
                $result[] = [
                    'text' => $message->getText(),
                    'name' => $from->getName(),
                    'time' => $message->diffForHumans(),
                    'image' => $from->getImageProfile(),
                ];
                $message->read = true;
                $message->save();
            }
        }

        return $result;
    }
}

