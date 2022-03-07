<?php

namespace App\Http\Controllers;
use App\Repositories\GuestRepository;
use Illuminate\Http\Request;
use App\Http\Requests\FrontEnd\{
	AssignRepRequest
};
class GuestController extends Controller
{
	protected $repo;
    public function __construct(GuestRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getBarCode(){
    	return view('guest.showBarCode');
    }
    public function getThanksMessage(){
    	return view('guest.thanks');
    }

    public function postBarCode(AssignRepRequest $request){
    	
    	return $this->repo->getUserDetails($request);
    }

    public function saveListing(Request $request){
    	
    	if($data = $this->repo->saveListing($request)){
    		return $data;
    	}
    }

    public function index1(Request $request){
		$data = $this->repo->getUserListing();
        return view('guest.visit',compact('data'));
    }

    public function reloadListing(Request $request){
		$data = $this->repo->getUserListing();
        return $data;
    }
}
