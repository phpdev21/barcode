<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\UserTrait;
use Auth;
use App\Repositories\UserRepository;
use App\Http\Requests\User\{
    ResetPasswordRequest
};
use App\Models\{
    Otp
};
class UserController extends Controller
{
    use UserTrait; 
    protected $repo;
    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }
    function getRecoverPassword($id){
        $otp = $this->repo->getOtp($id);
        if($otp->exists()){
            $id = encrypt($otp->first()->user_id);
            return view('user.profile.recover_password',compact('id'));    
        }else{
            return view('user.link_expired');
        }
        
    }
    
    function verifyEmail($id){
        $user = $this->repo->getUserFromId(decrypt($id));
        if($this->repo->verifyUserEmail($user)){
            return view('user.email_verified',compact('user'));
        }else{
            return "Something went wrong";
        }
        
    }
    
    function changePassword(ResetPasswordRequest $request){

        if($this->repo->updatePassword($request,decrypt($request->input('id')))){
            $response = 'Password changed Successfully !';
        }else{
            $response = 'Something went wrong !';
        }
        return redirect('login')->with('password_reset', $response);
    }

    function loginUser($id){
        Auth::logout();
        Auth::loginUsingId(decrypt($id), true);
        return redirect('user/profile');
    }
}
