<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;
use App\User;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;
/**

 * Register api
 *
 * @return \Illuminate\Http\Response
 */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;
        return response()->json(['success' => $success], $this->successStatus);
    }

    public function getUsers(Request $request)
    {
        $options = $request->only(['paginate', 'limit', 'sort']);
        $users = $this->userRepository->getUsers($options);
        return response()->success($users);
    }
}
