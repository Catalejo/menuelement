<?php namespace Catalejo\MenuElement;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class MenuElementServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

    public function boot()
    {
        // Especificamos cual es el nombre del archivo de configuración
        $this->publishes([
            __DIR__.'/../../config/menuelement.php' => config_path('menuelement.php'),
        ]);

        // Merge entre la configuración por defecto y la que se especifique al hacer un vendor:publish
        $this->mergeConfigFrom(__DIR__.'/../../config/menuelement.php', 'menuelement');

        // Alias de nuestra clase, para facilitar su suo
        AliasLoader::getInstance()->alias('MenuElement', 'Catalejo\MenuElement\MenuElement');
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
