<?php namespace Shivergard\CustomSearch;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\Model;
use \Schema;
use \Config;
use \DB;
use \Artisan;

use Illuminate\Container\Container;

class CustomSearchConsole extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'custom-search:init';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'CustomSearch init.';


	private $role_id = false;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(Container $app)
	{
		$this->app = $app;
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$this->info('¯\(°_o)/¯');
		Model::unguard();
		if (class_exists('App\Model\Akwilon\Roles')){
			$this->createRole("App\Model\Akwilon\Roles");
		}else if (class_exists('App\User\Roles')){
			$this->createRole("App\User\Roles");
		}
		if (DB::table('users')->where('name' , 'custom-search')->select('id')->count() == 0){

			$user = 				array(
				'email'    => 'root@CustomSearch.dev',
	            "password" => \Hash::make("custom-search"),
	            "name"  => "custom-search"
	        );

	        if (isset($this->role_id) && $this->role_id){
	        	$user["username"] = "custom-search";
	        	$user["confirmation_code"] = "custom-search";
	        	$user["role_id"] = $this->role_id;
	        }
			\App\User::create($user);
			$this->info(' Mail: root@CustomSearch.dev');
			$this->info(' Passowrd: custom-search');

		}else{
			$this->info(' User exists');
		}
	}

	private function createRole($roleModel){

		$role = $roleModel::create(
			array(
				'name' => 'custom-search',
				'default_route' => '\Shivergard\CustomSearch\CustomSearchController@init',
				'parent_id' => 1
			)
		);
		$this->role_id = $role->id;
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [];
	}

}