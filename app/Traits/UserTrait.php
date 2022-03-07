<?php

namespace App\Traits;
use App\Models\{
	User
};
use Auth;
use Mail;
use App\Mail\User\{
    ForgetPassword,
    EmailVerification
};
use DataTables;
use Validator;
use \Carbon\Carbon;
trait UserTrait
{

    public function createUser($request){
        return $user = User::create($request->only('email','first_name','last_name','is_product_update','is_promo') + ['role' =>1, 'password' => bcrypt($request->input('password'))]);
    }
    public function signupValidator($request){
        return Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:4|max:50'
        ]);
    }
    
    public function updateUserValidation($request, $id){
        return Validator::make($request->all(), [
            'first_name' => 'max:255',
            'last_name' => 'max:255',
            'email' => 'bail|email|unique:users,email,'.$id.'|max:255',
        ]);
    }
    
    public function loginValidator($request){
        return Validator::make($request->all(), [
            'email' => 'required|email|exists:users|max:255',
            'password' => 'required'
        ]);
    }
    
    public function forgetPasswordValidate($request){
        return Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
    }
    
    public function changePasswordValidator($request){
        return Validator::make($request->all(), [
            'password' => 'required|min:4|max:50|confirmed',
            'old_password' => 'required'
        ]);
    }

    public function sendSignupMail($request,$user){
        $id = User::whereEmail($user->email)->first()->id;
        return Mail::to($request->input('email'))->send(new EmailVerification($id));
    }
    
    public function generateToken($credentials){
        return Auth::guard('api')->attempt($credentials);
    }
    
    public function updatePassword($request,$id){
        return User::whereId($id)->update(['password' => bcrypt($request->input('password'))]);
    }

    public function getUserFromEmail($email){
        return User::whereEmail($email)->first()->toArray();
    }

    public function getUserFromId($id){
        return User::whereId($id)->first();
    }

    public function verifyUserEmail($user){
        return $user->update(['email_verified_at' => Carbon::now()]);
    }
    
    public function sendForgetPasswordMail($request){
        if($user = User::whereEmail($request->input('email'))){
            Mail::to($request->input('email'))->send(new ForgetPassword($user->first()->id));
            $f = true;
        }else{
            $f = false;
        }
        return $f;
    }

    public function updateUser($request, $id){
        return  User::whereId($id)->update($request->only('first_name', 'last_name', 'email', 'is_product_update', 'is_promo'));
    }

    public function userDataTable(){
        $data = User::whereRole(1)->latest()->get();
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('is_email',function($query){
                    if($query->email_verified_at){
                        $res = "Yes";
                    }else{
                        $res = "No";
                    }
                    return $res;
                })
                ->addColumn('is_product',function($query){
                    if($query->is_product_update){
                        $res = "Yes";
                    }else{
                        $res = "No";
                    }
                    return $res;
                })
                ->addColumn('is_promo',function($query){
                    if($query->is_promo){
                        $res = "Yes";
                    }else{
                        $res = "No";
                    }
                    return $res;
                })  
                ->addColumn('action', function($row){

                       $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }
    

}