<?php
/**
 * Created by PhpStorm.
 * User: iongh
 * Date: 8/1/2018
 * Time: 3:37 PM
 */

namespace App\Http\Controllers\v1;


use App\Http\Controllers\Controller;
use App\User;
use GenTux\Jwt\JwtToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Login User
     *
     * @param Request $request
     * @param User $userModel
     * @param JwtToken $jwtToken
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \GenTux\Jwt\Exceptions\NoTokenException
     */
    public function login(Request $request, User $userModel, JwtToken $jwtToken)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];

        $messages = [
            'email.required' => 'Email empty',
            'email.email' => 'Email invalid',
            'password.required' => 'Password empty'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if (!$validator->passes()) {
            return $this->returnBadRequest();
        }

        $user = $userModel->login($request->email, $request->password);

        if (!$user) {
            return $this->returnNotFound('User sau parola gresite');
        }

        $token = $jwtToken->createToken($user);

        $data = [
            'user' => $user,
            'jwt' => $token->token()
        ];


        return $this->returnSuccess($data);
    }


    public function register(Request $request)
    {
        try {
            $rules = [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
            ];

            $messages = [
                'name.required' => 'Name empty',
                'email.required' => 'Email empty',
                'password.required' => 'Password empty',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if (!$validator->passes()) {
                return $this->returnBadRequest($validator->messages());
            }

            $user = new User();

            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->password = Hash::make($request->get('password'));
            $user->status = User::STATUS_UNCONFIRMED;
            $user->role_id = User::ROLE_USER;
            $user->save();

            return $this->returnSuccess($user);
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }

    public function activate($id)
    {
            $userActivate= User::where('id', $id)->first();
            $userActivate->status = User::STATUS_CONFIRMED;
            $userActivate->update();
            return $this->returnSuccess($userActivate);
    }

    public function update($id,Request $request)
    {
        try {
            $rules = [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'status' => 'required',
                'role_id' => 'required'
            ];

            $messages = [
                'name.required' => 'Name empty',
                'email.required' => 'Email empty',
                'password.required' => 'Password empty',
                'status.required' => 'Status empty',
                'role_id.required' => 'Role_id empty'
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if (!$validator->passes()) {
                return $this->returnBadRequest($validator->messages());
            }

            $user = User::where('id',$id)->first();

            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->password = Hash::make($request->get('password'));
            $user->status = $request->get('status');
            $user->role_id = $request->get('role_id');
            $user->save();

            return $this->returnSuccess($user);
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }
}