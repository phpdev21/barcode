<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\UserTrait;
use App\Repositories\LeadRepository;
class LeadController extends Controller
{
	protected $repo;
    public function __construct(LeadRepository $repo)
    {
        $this->repo = $repo;
    }
    public function index(Request $request){
        if ($request->ajax()) {
            return $this->repo->leadDataTable();
        }
        return view('admin.lead.index');
    }

    
}
