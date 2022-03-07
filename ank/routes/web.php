<?php

use App\Models\SalesRep;
use App\Models\ZipCode;
ini_set('max_execution_time', 0);
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('barcode');//view('welcome');
});
Route::get('/demo', function () {
    $file = fopen("/var/www/html/rep.csv","r");
$arr =[];
$f = [];
$l = [];
$fl = [];
while (($line = fgetcsv($file)) !== FALSE) {
  //$line is an array of the csv elements
  $arr[] =$line;
}
fclose($file);
echo "<pre>";
//print_r($arr);
foreach ($arr as $key => $value) {
    array_push($f, $value[2]);
    array_push($l, $value[3]);
    array_push($fl, $value[1]);
}
echo "<pre>";

$full = array_unique($fl);
$a = $finalData = [];
/*foreach ($full as $key => $value) {
    $a['first_name'] = explode(" ",$value)[0];
    $a['last_name'] = explode(" ",$value)[1];
    $a['full_name'] = $value;
    $finalData[] = $a;
}
SalesRep::insert($finalData);*/
foreach ($arr as $key => $value) {
    foreach ($full as $key1 => $value1) {
        if($value[1] == $value1){
            $a[$value[1]][] = str_pad($value[0], 5, '0', STR_PAD_LEFT);
        }
    }
}
//echo "<pre>";
//print_r($a);die();
$temp=[];
$i =0;
foreach ($a as $key => $value) {
    ++$i;
    $finalData = [];
    foreach ($value as $key1 => $value1) {
        $temp['zip_code'] = $value1;
        $temp['rep_id'] = $i;
        $temp['created_at'] = \Carbon\Carbon::now();
        $temp['updated_at'] = \Carbon\Carbon::now();
        $finalData[] = $temp;
    }
    ZipCode::insert($finalData);
  //  echo "<pre>";
//print_r($finalData);die();
}
echo "<pre>";
//print_r($finalData);die();
//ZipCode::insert($finalData);
});
Route::get('/home1', function(){
    return view('jsdemo');
});
Route::get('/new', function(){
    return view('new');
});
Route::get('/visitors','GuestController@index1')->name('user.listing');
Route::get('/barcode','GuestController@getBarCode')->name('bar.code');
Route::get('/thanks','GuestController@getThanksMessage')->name('thanks.message');
Route::post('/post/barcode','GuestController@postBarCode')->name('post.badge');
Route::post('/save/listing','GuestController@saveListing')->name('save.listing');
Route::get('/reload/listing','GuestController@reloadListing')->name('reload.listing');
Route::get('/user/change/password/{id}','Api\UserController@getRecoverPassword');
Route::get('user/verify/email/{id}','Api\UserController@verifyEmail');
Route::get('change/password','Api\UserController@changePassword')->name('user.change.password');
Route::get('user/login/{id}','Api\UserController@loginUser')->name('login.user');
//   route group middleware guest starts
Route::group(['namespace' => 'Auth','middleware' => ['guest']], function ()
{

    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::get('forget', 'ForgotPasswordController@showLinkRequestForm')->name('get-forget');
    Route::post('forget', 'ForgotPasswordController@sendResetLinkEmail')->name('post-forget');
    Route::get('signup', 'RegisterController@showRegistrationForm')->name('get-signup');
    Route::post('signup', 'RegisterController@register')->name('admin.signup');
    Route::post('/login', 'LoginController@login')->name('admin.login');
});

//   route group middleware guest ends

// routes accessed by admin only
Route::group([ 'prefix' => 'admin', 'namespace' => 'Admin','middleware' => ['admin']], function ()
{
    Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
    Route::get('rep', 'UserController@index')->name('admin.rep');
    Route::get('lead', 'LeadController@index')->name('admin.lead');
    Route::post('save/rep/color', 'UserController@saveColor')->name('post.rep.color');
});

// routes accessed by users only
Route::group([ 'prefix' => 'user', 'namespace' => 'User', 'middleware' => ['user']], function ()
{
    Route::get('profile', 'ProfileController@index')->name('user.profile');
    Route::put('update/profile', 'ProfileController@updateProfile')->name('user.profile.update');
    Route::put('update/password', 'ProfileController@changePassword')->name('user.password.update');
});

Route::get('logout', 'Auth\LoginController@logout')->name('logout');