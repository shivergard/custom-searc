<?php namespace Shivergard\CustomSearch;

use \Shivergard\CustomSearch\BaseModel;
use \Config;
class Instance extends BaseModel {
	public $table = false;

	public function __construct(){
		if (Config::get('custom-search.instance_table'))
			$this->table = Config::get('custom-search.instance_table');
		else
			$this->table = 'users';
	}

}