<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\AuthTrait;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Notifications\AccountActivated;

use Illuminate\Support\Facades\Notification;

use App\Http\Traits\HelperApi;

class AuthController extends Controller
{
    use HelperApi;
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        try {

            $user = User::where('email', $request->email)->first();
            if ($user && (!Hash::check($request->password, $user->password))) {
                return $this->onError(500, 'invalid password');
            }
            if (!$user) {
                return $this->onError(500, 'invalid data');
            }

            $user->fcm_token = $request->fcm_token;
            $user->update();


            $token = JWTAuth::fromUser($user);
            if (!$token) {
                return response()->json([
                    'message' => 'Unauthorized',
                ], 401);
            }
            return $this->onSuccessWithToken(200, 'login_user', $user, $token);
        } catch (\Throwable $error) {
            return $this->onError(500, 'server_error', $error->getMessage());
        }
    }


    public function register(Request $request)
    {
        try {
            $rules = [
                'email' => ['sometimes', 'required', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'min:6'],
                'name' => ['required', 'string', 'max:255'],
                'phone'=>['required', 'regex:/^\+?[0-9]+$/','max:11','min:11'],
                'company' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string'],

            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $this->onError(500, 'server_error',  $validator->errors()->first());
            }

            $user = User::create([
                'email' => $request->email,
                'company' => $request->company,
                'address' => $request->address,
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'fcm_token'=> $request->fcm_token,
                'phone'=>$request->phone,
                'role_id' => 1,
            ]);

            $token = JWTAuth::fromUser($user);
            return $this->onSuccessWithToken(200, 'create_user', $user, $token);
        } catch (\Throwable $error) {
            return $this->onError(500, 'error', $error->getMessage());
        }
    }

    public function logout(Request $request)
    {
        try {
            // Get the current authenticated user
            $user = auth()->user();
            // Invalidate all tokens for the user by adding them to the blacklist
            JWTAuth::invalidate($request->token);
            return $this->onSuccess(200, 'Logout successful');
        } catch (JWTException $e) {
            return $this->onError(500, 'Error logging out');
        }
    }

    public function userProfile()
    {
        // return response()->json(auth()->user());
        return $this->onSuccess(200, 'User Data Success', auth()->user());
    }

    public function change_password(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            $validator = Validator::make($request->all(), [
                'old_password' => 'nullable|string|min:6|max:255',
                'password' => 'nullable|string|min:8|max:255|confirmed',
            ]);

            if ($validator->fails()) {
                return $this->onError(500, 'Validation error', $validator->errors());
            }

            $data = User::where('id', '=', $user->id)->first();

            // Check if the old password matches the current password
            if (!is_null($request->old_password) && !Hash::check($request->old_password, $user->password)) {
                return $this->onError(400, 'Old password does not match the current password');
            }

            // Update the password if a new one is provided
            if (!is_null($request->password)) {
                $data->password = bcrypt($request->password);
            }

            $data->update();

            return $this->onSuccess(200, 'Change Password successfully', $data);
        } catch (\Throwable $e) {
            return $this->onError(500, 'An error occurred. Please try again', $e->getMessage());
        }
    }
    
    //     public function delete_account()
    // {
    //     try {
    //           $user = JWTAuth::parseToken()->authenticate();
    //         $user = User::find($user->id);
    //         if ($user->id != 1) {
    //             $user->delete();
                
    //         $token = JWTAuth::getToken();
    //         $refreshedToken = JWTAuth::refresh($token);

    //           return $this->onSuccess(200, 'Delete account successfully', $data);

           
    //         }
    //           return $this->onError(500, 'An error occurred. Please try again');
    //     } catch (\Throwable $e) {
    //           return $this->onError(500, 'An error occurred. Please try again', $e->getMessage());

    //     }
    // }
    
    public function delete_account()
{
    try {
        // Authenticate the user using the token
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->id != 1) {
            // Invalidate the current token
            JWTAuth::invalidate(JWTAuth::getToken());

            // Invalidate all other tokens associated with the user (assuming you have a method to do so)
            $this->invalidateAllTokens($user);

            // // Delete the user
            // User::destroy($user->id);

            // Success response
            return $this->onSuccess(200, 'Deleted account and all associated tokens successfully', null);
        }

        // If the user is trying to delete the root admin account (id = 1)
        return $this->onError(403, 'You cannot delete the root admin account');
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        // User not found error
        return $this->onError(404, 'User not found');
    } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
        // Token expired error
        return $this->onError(401, 'Token has expired');
    } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
        // Token invalid error
        return $this->onError(401, 'Token is invalid');
    } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
        // JWT error
        return $this->onError(401, 'Token is not provided');
    } catch (\Throwable $e) {
        // General error
        return $this->onError(500, 'An internal error occurred. Please try again');
    }
}

/**
 * Invalidate all tokens associated with a user.
 *
 * @param \App\Models\User $user
 * @return void
 */
protected function invalidateAllTokens($user)
{
    // This method should contain the logic to invalidate all tokens for the given user.
    // This could be done by maintaining a token blacklist or another appropriate method
    // depending on your specific JWT implementation.
}


}
