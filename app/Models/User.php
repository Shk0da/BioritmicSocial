<?php

namespace App\Models;

use App\Http\Controllers\BiorhythmController;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'location',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    public function photo()
    {
        return $this->hasMany('App\Models\Photo');
    }

    public function friend()
    {
        return $this->hasMany('App\Models\Friend');
    }

    public function post()
    {
        return $this->hasMany('App\Models\Post', 'user_id');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Like', 'user_id');
    }

    public function album()
    {
        return $this->hasMany('App\Models\Album', 'user_id');
    }

    public function getName()
    {
        return $this->name ?: null;
    }

    public function getCountry()
    {
        return $this->profile->gatLocation()['country'];
    }

    public function getCountryList()
    {
        if (!isset($this->countryList)) {
            $list = [];
            foreach (Location::all(['country']) as $location) {
                $list[] = $location->country;
                $list = array_unique($list);
            }
            $this->countryList = $list;
        }

        return $this->countryList;
    }

    public function getCityList($country = null)
    {
        $saveName = 'cityList' . $country;

        if ($country) {
            if (!isset($this->$saveName)) {
                $list = [];
                foreach (Location::whereCountry($country)->get(['id', 'city']) as $location) {
                    $list[$location->id] = $location->city;
                    $list = array_unique($list);
                }
                $this->$saveName = $list;
            }
        }
        else {
            if (!isset($this->$saveName)) {
                $list = [];
                foreach (Location::all(['id', 'city']) as $location) {
                    $list[$location->id] = $location->city;
                    $list = array_unique($list);
                }
                $this->$saveName = $list;
            }
        }

        return $this->$saveName;
    }

    public function getCity()
    {
        return $this->profile->gatLocation()['city'];
    }

    public function getLocation()
    {
        return $this->getCity();
    }

    public function getProfileLink()
    {
        return "/id{$this->id}";
    }

    public function getImageProfile()
    {
        $image = Photo::find($this->profile->image_profile);
        if (!$image) {
            $image = url(($this->profile->gender) ? '/public/img/no-image-male.jpg' : '/public/img/no-image-female.jpg');
            return $image;
        }

        return $image->getUrl();
    }

    public function getBackground()
    {
        $image = Photo::find($this->profile->background);

        if (!$image) {
            $image = '/public/img/iceland.jpg';
        } else {
            $image = $image->path;
        }

        return url($image);
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getStatus()
    {
        return $this->profile->status ?: null;
    }

    public function getBirthday()
    {
        return array_map('intval', explode("-", $this->profile->birthday)) ?: null;
    }

    public function getStringBirthday()
    {
        return implode('.', array_reverse(explode("-", $this->profile->birthday))) ?: null;
    }

    public function getAge()
    {
        $birthday_timestamp = strtotime($this->profile->birthday);
        $age = date('Y') - date('Y', $birthday_timestamp);
        if (date('md', $birthday_timestamp) > date('md')) {
            $age--;
        }
        return $age;
    }

    public function getAbout()
    {
        return $this->profile->about ?: null;
    }

    public function getGender()
    {
        if (!$this->profile->gender)
            return null;

        $gender = ['мужской', 'женский'];
        return $gender[$this->profile->gender];
    }

    public function getIntGender()
    {
        if (!isset($this->profile->gender))
            return null;

        return (int)$this->profile->gender;
    }

    public function getZodiac()
    {
        if (!isset($this->profile->zodiac))
            return null;

        $zodiac = ['Козерог', 'Водолей', 'Рыбы', 'Овен', 'Телец', 'Близнецы', 'Рак', 'Лев', 'Девы', 'Весы', 'Скорпион', 'Стрелец'];
        return $zodiac[$this->profile->zodiac];
    }

    public function getAnimal()
    {
        if (!isset($this->profile->animal))
            return null;

        $animals = ['Крысы', 'Быка', 'Тигра', 'Кролика', 'Дракона', 'Змеи', 'Лошади', 'Овцы', 'Обезьяны', 'Петуха', 'Собаки', 'Кабана'];
        return $animals[$this->profile->animal];
    }

    function setZodiac()
    {
        if (!isset($this->profile->birthday))
            return null;

        $birthday = array_reverse(explode("-", $this->profile->birthday));
        $day = $birthday[0];
        $month = $birthday[1];
        $signsstart = [1 => 21, 2 => 20, 3 => 20, 4 => 20, 5 => 20, 6 => 20, 7 => 21, 8 => 22, 9 => 23, 10 => 23, 11 => 23, 12 => 23, 13 => 21];
        $znak = $day < $signsstart[$month + 1] ? $month - 1 : $month % 12;
        return $znak;
    }


    public function setAnimal()
    {
        if (!isset($this->profile->birthday))
            return null;

        $birthday = $this->profile->birthday;
        $year = str_replace("-", "", substr($birthday, 0, 4));

        $count = 1;
        for ($i = 1900; $i < $year; $i++) {
            $zodiac = $count++;
            if ($count == 12) $count = 0;
        }

        return $zodiac;
    }

    public function friendsOfMine()
    {
        return $this->belongsToMany('App\Models\User', 'friends', 'user_id', 'friend_id');
    }

    public function friendsOf()
    {
        return $this->belongsToMany('App\Models\User', 'friends', 'friend_id', 'user_id');
    }

    public function friends()
    {
        return $this->friendsOfMine()->wherePivot('accepted', true)->get()
            ->merge($this->friendsOf()->wherePivot('accepted', true)->get());
    }

    public function friendsRequests()
    {
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

   public function friendRequestPending()
   {
       return $this->friendsOf()->wherePivot('accepted', false)->get();
   }

    public function hasRequestPending(User $user)
    {
        return (bool) $this->friendRequestPending()->where('id', $user->id)->count();
    }

    public function hasFriendRequestReceived(User $user)
    {
        return (bool) $this->friendsRequests()->where('id', $user->id)->count();
    }

    public function addFriend(User $user)
    {
        $this->friendsOf()->attach($user->id);
    }

    public function removeRequestToFriend(User $user)
    {
        $this->friendsOf()->detach($user->id);
    }

    public function removeFriend(User $user)
    {
        $this->friends()->where('id', $user->id)->first()->pivot->update(['accepted' => false]);
    }

    public function acceptFriendRequest(User $user)
    {
        $this->friendsRequests()->where('id', $user->id)->first()->pivot->update(['accepted' => true]);
    }

    public function isFriendWith(User $user)
    {
        return (bool) $this->friends()->where('id', $user->id)->count();
    }

    public function hasLikedPost(Post $post)
    {
        return (bool) $post->likes->where('user_id', $this->id)->count();
    }

    public function removeLikePost(Post $post)
    {
        $post->likes
            ->where('like_id', $post->id)
            ->where('like_type', get_class($post))
            ->where('user_id', $this->id)
            ->first()
            ->delete();
    }

    public function getCompare(User $user)
    {
        $rhythms = "Ваша совместимость: \n";
        $compare = BiorhythmController::instance()->compare($this, $user);
        foreach ($compare as $name => $val) {
            $rhythms .= "{$name}: {$val} \n";
        }
        return $rhythms;
    }

    public function getUserLikes()
    {
        $users = [];
        $likes = $this->likes()->get();

        foreach ($likes as $like) {
            $user = User::find($like->user_id);
            if ($user->id <> $this->id)
                $users[] = $user;
        }

        return $users;
    }

    public function getUserDialogs()
    {
        $result = [];
        $dialogs = \App\Models\Message::where('to', $this->id)->orWhere('from', $this->id)->get();

        foreach ($dialogs as $dialog) {
            $from = $dialog->getFromUser();

            if ($from->id != $this->id) {
                $result[$dialog->from] = $dialog;
            }
        }

        return $result;
    }


    public function getMessageKey()
    {
        return md5($this->getRememberToken() . env('APP_KEY', 0));
    }

    public function getRealMessageKey()
    {
        return md5($_SERVER['REMOTE_ADDR'] . $this->getMessageKey() . $_SERVER['HTTP_USER_AGENT']);
    }
}
