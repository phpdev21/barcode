<?php 
namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
	User,
	Otp,
    SalesRep,
    RepUserListing,
    ZipCode
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

class GuestRepository
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function saveListing($request){
        $zip=ZipCode::where('zip_code',$request->input('zip'));
        if($zip->exists()){
            $data['rep_name'] = $zip->first()->rep->full_name;    
            $data['rep_id'] = $zip->first()->rep->id;    
            $data['user_name'] = $request->input('name');    
            $data['date'] = Carbon::now();
            RepUserListing::create($data);
            $response['message'] = "success";
            $response['rep_name'] = $data['rep_name'];
            $http_status = 200;
        }else{
            $response['message'] = "ZipCode not found";
            $http_status = 500;
        }
        return response()->json($response,$http_status);
        
        //RepUserListing::create
    }

    public function getUserDetails($request){
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://www.xpressleadpro.com/Leads/LeadsAPI/LeadsAPI_v2.php?AuthKey=311C4A1D-177F-4A01-BC6E-7086A390728D&exid=1973770&eventcode=LVMS0719&Scan_TS=2019-07-11%2007%3A31%3A50&Scan_TS_UTC=2019-07-11%2007%3A31%3A50&badge=".urlencode($request->input('badge_id'))."&lastname=".urlencode($request->input('last_name'))."&function=GETBADGEINFO",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          return $err;
        } else {
          return $response;
        }
    
    }

    public function getUserListing(){
        return RepUserListing::latest()->take(10)->with(['rep'])->get();
    }

}