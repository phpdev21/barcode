<?php 
namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
	User,
	RepUserListing,
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

class LeadRepository
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(RepUserListing $model)
    {
        $this->model = $model;
    }

    public function leadDataTable(){
        $data = $this->model::latest()->get();
        return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
    }
    
}