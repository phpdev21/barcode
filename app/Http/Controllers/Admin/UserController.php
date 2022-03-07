<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\UserTrait;
use App\Repositories\UserRepository;
class UserController extends Controller
{
	use UserTrait;
	protected $repo;
    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }
    public function index(Request $request){
        if ($request->ajax()) {
            return $this->repo->repDataTable();
        }
        return view('admin.user.index');
    }

    public function saveColor(Request $request){
        if($this->repo->saveColor($request)){
            $response = "Color updated successfully";
            $http = 200;
        }else{
            $response = "Something went wrong";
            $http = 500;
        }
        return response()->json($response,$http);
    }

    
}
