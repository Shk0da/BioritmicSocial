<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends MainController
{

    public function show(User $user)
    {
        $view = $this->view;
        $view->with('content', view('layout.profile')
            ->with('user', $user)
            ->with('authUser', $this->getUser())
            ->with('albums', $user->album()->get()));
        return $view;
    }

    public function edit(){
        $view = $this->view;
        $view->with('content', view('user.edit')
            ->with('user', $this->getUser())
            ->with('month', ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль', 'Август','Сентябрь','Октябрь','Ноябрь','Декабрь'])
        );
        return $view;
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2',
            'birthday' => 'required',
            'location' => 'required',
        ]);

        $name = $request->input('name');
        $birthday = $request->input('birthday');
        $gender = $request->input('gender');
        $status = $request->input('status');
        $location = $request->input('location');
        $about = $request->input('about');

        $user = User::find($this->getUser()->id);
        $user->name = $name;
        $user->profile->birthday = "{$birthday['y']}-{$birthday['m']}-{$birthday['d']}";
        $user->profile->status = $status;
        $user->profile->location = $location;
        $user->profile->about = $about;
        $user->profile->gender = $gender;
        $user->profile->zodiac = $user->setZodiac();
        $user->profile->animal = $user->setAnimal();
        $user->profile->save();
        $user->save();

        return redirect()->back();
    }

    public function destroy(){}
}
