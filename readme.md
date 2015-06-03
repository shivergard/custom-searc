To Start using it add to composer.json repozitory

    "repositories": [
      {
      "type": "git",
       "url": "git@github.com:shivergard/custom-search.git"
      }
    ],

and add requirements

	"require": {
		...
        "shivergard/custom-search" : "dev-master" 
    },

and add service provider

		'providers' => [
		...
      'Shivergard\CustomSearch\CustomSearchServiceProvider',
		...