<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	public function index(){
		echo phpinfo();
	}
}
