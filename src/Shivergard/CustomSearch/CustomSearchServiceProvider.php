<?php namespace Shivergard\CustomSearch;

use Illuminate\Support\ServiceProvider;

class CustomSearchServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{

		//config publish
		$this->publishes([
		    __DIR__.'/custom-search.php' => config_path('custom-search.php'),
		    realpath(__DIR__ .'/../../migrations') => $this->app->databasePath().'/migrations',
		]);

		\Response::macro('mst', function($value){
			$value = str_replace('[[' , '{{' , $value);
			$value = str_replace(']]' , '}}' , $value);
            return \Response::make($value);
        });

		require __DIR__ .'/../../routes.php';
		$this->loadViewsFrom(__DIR__.'/../../views', 'custom-search');
		$this->commands('Shivergard\CustomSearch\CustomSearchConsole');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [];
	}

}
