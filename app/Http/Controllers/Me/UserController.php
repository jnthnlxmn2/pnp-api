<?php

namespace App\Http\Controllers\Me;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;
use App\Http\Requests\User\ChangePasswordRequest;

class UserController extends Controller
{
    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }
    public function getMe(){
        $me = $this->userRepository->getMe();
       return response()->success($me);
       // return response()->json(['data' => $me]);
    }
    public function changePassword(ChangePasswordRequest $request){
        $input = $request->only(['new_password']);
        $data = $this->userRepository->ChangePassword($input['new_password']);
        return response()->success($data);
    }


}
