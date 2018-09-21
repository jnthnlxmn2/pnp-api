<?php

namespace App\Repositories\User;

use App\Repositories\Common\Eloquent\EloquentRepository;
use App\User;
use Auth;

class UserEloquent extends EloquentRepository implements UserRepository
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getMe()
    {
        $user = Auth::user();
        $user->user_type;

        return $user;

    }

    public function changePassword($new_password)
    {
        $user = Auth::user();
        $user->password = bcrypt($new_password);
        $user->save();
        return array(
            'status' => 'success',
            'message' => 'Password updated!!!',
        );
    }

    public function getUsers($options = [])
    {
        $options = $this->getOptions($options);
        $users = $this->model->orderBy('created_at', 'DESC')
            ->orderBy('created_at', 'desc')
            ->limit($options['limit'])
            ->paginate($options['paginate']);
        foreach ($users as $user) {
            $user->user_type;
        }

        return $users;

    }

}
