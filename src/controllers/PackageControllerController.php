<?php namespace Shivergard\CustomSearch;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use \Auth;
use \Redirect;


abstract class PackageController extends BaseController {

	use DispatchesCommands, ValidatesRequests;

	public function __construct()
	{
		if (class_exists('App\Model\Akwilon\Roles')){
			$this->validateRole(\App\Model\Akwilon\Roles::where('name' ,'custom-search'));
		}else if (class_exists('App\User\Roles')){
			$this->validateRole(\App\User\Roles::where('name' ,'custom-search'));
		} else if (!is_object(Auth::user()) || !Auth::user()->name == 'custom-search'){
			Redirect::to('/')->send();
		}
	}

	public function validateRole($role){
		if ($role->count() == 0 || !is_object(Auth::user()) || Auth::user()->role_id != $role->first()->id){
			Redirect::to('/')->send();
		}
	}

}