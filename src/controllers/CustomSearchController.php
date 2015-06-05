<?php namespace Shivergard\CustomSearch;

use App\Requests;

use Illuminate\Http\Request;

use \Carbon;

use \Config;

use \Shivergard\CustomSearch\Instance;


class CustomSearchController extends \Shivergard\CustomSearch\PackageController {

	public function __construct(){

	}


	public function init(){	
		return view('custom-search::custom-search');
	}

	public function listFields(){
		if(!\Request::ajax())
            return \Redirect::to(action("\Shivergard\CustomSearch\@init"));

        $response = array();
        
        $instances = Instance::where('name', 'LIKE' ,  '%'.\Input::get('query').'%')->orderBy('id', 'DESC')->paginate(10);
        foreach ($instances as $instance) {
            $response["suggestions"][] = array('value' => $instance->name , 'data' => array('category' => $instance->table , 'id' => $instance->id));
        }

        return \Response::json($response);
	}

	public function getInstance(){
		if(!\Request::ajax())
            return \Redirect::to(action("\Shivergard\CustomSearch\@init"));

        $return = array();
        $instance = Instance::where('id', \Input::get('id'));

        if ($instance->count() > 0){
        	$return = $instance->first();
        }

        return \Response::json($return);

	}

    public function getMust(){
       $instance = new Instance();
       return \Response::mst(view('custom-search::mustache.blocks' , array('fields' => $instance->getAllColumnsNames())));
    }

}