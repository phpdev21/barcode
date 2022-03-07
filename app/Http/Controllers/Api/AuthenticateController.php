<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\{User,Otp};
use App\Mail\User\{
    ForgetPassword,
    EmailVerification
};
use App\Repositories\UserRepository;
use Mail;
use App\Http\Requests\User\{
    SignupRequest,
    LoginRequest,
    ForgetPasswordRequest,
    RecoverPasswordRequest,
    ChangePasswordRequest
};
use App\Traits\UserTrait;
use \Carbon\Carbon;

class AuthenticateController extends Controller
{
    use UserTrait;
    protected $repo;
    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
        $this->middleware('jwt.auth', ['except' => ['login','signUp','forgetPassword']]);
    }

    /**
    * Create a new User and send email for verify email.
    *
    * @return json
    */
    public function signUp(SignupRequest $request){
        if ($user = $this->repo->createUser($request)){
            $response['message'] = "User created succesfully";
            $response['token'] = $this->repo->generateToken($request->only('email', 'password'));
            $this->repo->sendSignupMail($request->input('email'));
            $http_status = 200;
        }else{
            $response['message'] = "Something went wrong";
            $http_status = 500;
        }
        return response()->json($response, $http_status);
    }

    /**
    * resend email for verify email.
    *
    * @return json
    */
    public function emailVerify(){
        $email = Auth::guard('api')->user()->email;
        if ($this->repo->sendSignupMail($email)){
            $response['message'] = "Email verification mail send to you email succesfully";
            $http_status = 200;
        }else{
            $response['message'] = "Something went wrong";
            $http_status = 500;
        }
        return response()->json($response, $http_status);
    }

    /**
    * rgenerate token for already login user.
    *
    * @return json
    */
    public function regenerateToken(){
        $user = Auth::guard('api')->user();
        if ($token = Auth::guard('api')->fromUser($user)){
            $response['message'] = "Token generated successfully";
            $response['token'] = $token;
            $http_status = 200;
        }else{
            $response['message'] = "Something went wrong";
            $http_status = 500;
        }
        return response()->json($response, $http_status);
    }
        
    

    /**
    * login user and return jwt auth token.
    *
    * @return json
    */
    public function login(LoginRequest $request){
        $credentials = $request->only('email', 'password');
        if ($token = $this->repo->generateToken($credentials)) {
            $response['token'] = $token;
            $response['user'] = $this->repo->getUserFromEmail($request->input('email'));
            $http_status = 200;
        }else{
            $response['message'] = "Wrong credentials";
            $http_status = 401;
        }
        return response()->json($response, $http_status);
    }

    
    /**
    * Send forgot password email to user email.
    *
    * @return json
    */
    public function forgetPassword(ForgetPasswordRequest $request){
        $id = $this->repo->getUserFromEmail($request->input('email'))['id'];
        $otp = $this->repo->generateOtp(30,$id);
        if($otp){
            $this->repo->sendForgetPasswordMail($request,$otp);
            $response['message'] = "password reset link has been send to your mail Successfully.";
            $http_status = 200;
        }else{
            $response['message'] = "Something went wrong";
            $http_status = 500;
        }
        return response()->json($response,$http_status);
        
    }

    /**
    * get detail of login user with jwt auth token.
    *
    * @return json
    */
    public function getDetails(Request $request){
        if($user = Auth::guard('api')->user()){
            $response['user'] = $user->toArray();
            $http_status = 200;
        }
        else{
            $response['user'] = [];
            $http_status = 500;
        }
        return response()->json($response,$http_status);
    }


    /**
    * change password with old password by user.
    *
    * @return json
    */
    public function changePassword(ChangePasswordRequest $request){
        if(\Hash::check($request->input('old_password'), Auth::guard('api')->user()->password)){
            if($this->repo->updatePassword($request,Auth::guard('api')->user()->id)){
                $response['message'] = "Password changed successfully";
                $http_status = 200;
            }else{
                $response['message'] = "Something went wrong";
                $http_status = 500;
            }
        }
        else{
            $response['message'] = "Your password does not matched with our record.";
            $http_status = 422;
        }
        return response()->json($response,$http_status);
    }
}
