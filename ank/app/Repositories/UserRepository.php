<?php 
namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
	User,
	Otp,
    SalesRep
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

class UserRepository
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function createUser($request){
        return $user = $this->model::create($request->only('email','first_name','last_name','is_product_update','is_promo') + ['role' =>1, 'password' => bcrypt($request->input('password'))]);
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

    public function generateOtp($min,$id){
        $otp = $this->generateRandomString();
        $expires = Carbon::now()->addMinutes($min);
        $otps = Otp::updateOrCreate(['type'=>0,'user_id' => $id],['otp' => $otp, 'expires_on' => $expires]);
        return $otp;
    }

    public function generateRandomString(){
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($permitted_chars), 0, 10);
    }
    
    public function changePasswordValidator($request){
        return Validator::make($request->all(), [
            'password' => 'required|min:4|max:50|confirmed',
            'old_password' => 'required'
        ]);
    }

    public function sendSignupMail($email){
        $id = User::whereEmail($email)->first()->id;
        return Mail::to($email)->send(new EmailVerification($id));
    }
    
    public function generateToken($credentials){
        return Auth::guard('api')->attempt($credentials);
    }
    
    public function updatePassword($request,$id){
    	Otp::whereUserId($id)->whereType(0)->delete();
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

    public function getOtp($id){
        return Otp::whereOtp($id)->whereType(0)->where('expires_on', '>=' ,Carbon::now());
    }
    
    public function sendForgetPasswordMail($request,$otp){
        if(Mail::to($request->input('email'))->send(new ForgetPassword($otp))){
        	return true;
        }else{
        	return false;	
        }
        
    }

    public function updateUser($request, $id){
        return  User::whereId($id)->update($request->only('first_name', 'last_name', 'email', 'is_product_update', 'is_promo'));
    }

    public function saveColor($request){
        return  SalesRep::whereId($request->input('id'))->update($request->only('color'));
    }

    public function repDataTable(){
        $data = SalesRep::all();
        return Datatables::of($data)
                ->addIndexColumn()  
                ->addColumn('action', function($row){

                       $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" data-color="'.$row->color.'" class="color btn btn-primary btn-sm">Assign Color</a>';

                        return $btn;
                })
                ->addColumn('colors', function($row){

                       $btn = '<a style="background-color:'.$row->color.';height:30px;width:70px"  class="btn  btn-sm"></a>';

                        return $btn;
                })
                ->rawColumns(['action','colors'])
                ->make(true);
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