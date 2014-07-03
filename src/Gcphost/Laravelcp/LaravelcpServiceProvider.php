<?php namespace Gcphost\Laravelcp;

use Illuminate\Support\ServiceProvider;
use Gcphost\Laravelcp\Commands\InstallLaravelCP;

class LaravelcpServiceProvider extends ServiceProvider {

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
		$this->package('Gcphost/Laravelcp');
        //require __DIR__ .'/../../routes.php';
		\View::addNamespace('Laravelcp', __DIR__.'/../../Views');

		$this->app->bind('command.install_laravelcp', function($app) {
			return new InstallLaravelCP();
		});
		$this->commands(array(
			'command.install_laravelcp'
		));

	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

		$providers=array(	
			'Illuminate\Foundation\Providers\ArtisanServiceProvider',
			'Illuminate\Auth\AuthServiceProvider',
			'Illuminate\Cache\CacheServiceProvider',
			'Illuminate\Session\CommandsServiceProvider',
			'Illuminate\Foundation\Providers\ConsoleSupportServiceProvider',
			'Illuminate\Routing\ControllerServiceProvider',
			'Illuminate\Cookie\CookieServiceProvider',
			'Illuminate\Database\DatabaseServiceProvider',
			'Illuminate\Encryption\EncryptionServiceProvider',
			'Illuminate\Filesystem\FilesystemServiceProvider',
			'Illuminate\Hashing\HashServiceProvider',
			'Illuminate\Html\HtmlServiceProvider',
			'Illuminate\Log\LogServiceProvider',
			'Illuminate\Mail\MailServiceProvider',
			'Illuminate\Database\MigrationServiceProvider',
			'Illuminate\Pagination\PaginationServiceProvider',
			'Illuminate\Queue\QueueServiceProvider',
			'Illuminate\Redis\RedisServiceProvider',
			'Illuminate\Remote\RemoteServiceProvider',
			'Illuminate\Auth\Reminders\ReminderServiceProvider',
			'Illuminate\Database\SeedServiceProvider',
			'Illuminate\Session\SessionServiceProvider',
			'Illuminate\Translation\TranslationServiceProvider',
			'Illuminate\Validation\ValidationServiceProvider',
			'Illuminate\View\ViewServiceProvider',
			'Illuminate\Workbench\WorkbenchServiceProvider',

			/* Additional Providers */
			"Khill\Lavacharts\LavachartsServiceProvider",
			'Zizaco\Confide\ConfideServiceProvider', 
			'Zizaco\Entrust\EntrustServiceProvider', 
			'Bllim\Datatables\DatatablesServiceProvider',
			'anlutro\LaravelSettings\ServiceProvider',
			'Thomaswelton\LaravelGravatar\LaravelGravatarServiceProvider',
			'Regulus\ActivityLog\ActivityLogServiceProvider',
			'Raahul\LarryFour\LarryFourServiceProvider',
			'Atticmedia\Anvard\AnvardServiceProvider',
			'Msurguy\Honeypot\HoneypotServiceProvider',
			'Liebig\Cron\CronServiceProvider',

			/* LaravelCP */
			'Gcphost\Laravelcp\UserServiceProvider',
			'Gcphost\Laravelcp\TodoServiceProvider',
			'Gcphost\Laravelcp\BlogServiceProvider',
			'Gcphost\Laravelcp\CommentServiceProvider',
			'Gcphost\Laravelcp\RoleServiceProvider',
			'Gcphost\Laravelcp\DesktopServiceProvider',
			'Gcphost\Laravelcp\EmailServiceProvider',
			'Gcphost\Laravelcp\MergeServiceProvider',
			'Gcphost\Laravelcp\ProfileServiceProvider',
			'Gcphost\Laravelcp\SearchServiceProvider',
			'Gcphost\Laravelcp\SettingServiceProvider',
			'Gcphost\Laravelcp\SiteUserServiceProvider',
			'Gcphost\Laravelcp\SiteBlogServiceProvider',
			'Gcphost\Laravelcp\ClientServiceProvider',

		);
			
		$aliases=array(
			'App'             => 'Illuminate\Support\Facades\App',
			'Artisan'         => 'Illuminate\Support\Facades\Artisan',
			'Auth'            => 'Illuminate\Support\Facades\Auth',
			'Blade'           => 'Illuminate\Support\Facades\Blade',
			'Cache'           => 'Illuminate\Support\Facades\Cache',
			'ClassLoader'     => 'Illuminate\Support\ClassLoader',
			'Config'          => 'Illuminate\Support\Facades\Config',
			'Controller'      => 'Illuminate\Routing\Controller',
			'Cookie'          => 'Illuminate\Support\Facades\Cookie',
			'Crypt'           => 'Illuminate\Support\Facades\Crypt',
			'DB'              => 'Illuminate\Support\Facades\DB',
			'Eloquent'        => 'Illuminate\Database\Eloquent\Model',
			'Event'           => 'Illuminate\Support\Facades\Event',
			'File'            => 'Illuminate\Support\Facades\File',
			//'Form'            => 'Illuminate\Support\Facades\Form',
			'Hash'            => 'Illuminate\Support\Facades\Hash',
			'HTML'            => 'Illuminate\Support\Facades\HTML',
			'Input'           => 'Illuminate\Support\Facades\Input',
			'Lang'            => 'Illuminate\Support\Facades\Lang',
			'Log'             => 'Illuminate\Support\Facades\Log',
			'Mail'            => 'Illuminate\Support\Facades\Mail',
			'Paginator'       => 'Illuminate\Support\Facades\Paginator',
			'Password'        => 'Illuminate\Support\Facades\Password',
			'Queue'           => 'Illuminate\Support\Facades\Queue',
			'Redirect'        => 'Illuminate\Support\Facades\Redirect',
			'Redis'           => 'Illuminate\Support\Facades\Redis',
			'Request'         => 'Illuminate\Support\Facades\Request',
			'Response'        => 'Illuminate\Support\Facades\Response',
			'Route'           => 'Illuminate\Support\Facades\Route',
			'Schema'          => 'Illuminate\Support\Facades\Schema',
			'Seeder'          => 'Illuminate\Database\Seeder',
			'Session'         => 'Illuminate\Support\Facades\Session',
			'SSH'             => 'Illuminate\Support\Facades\SSH',
			'Str'             => 'Illuminate\Support\Str',
			'URL'             => 'Illuminate\Support\Facades\URL',
			'Validator'       => 'Illuminate\Support\Facades\Validator',
			'View'            => 'Illuminate\Support\Facades\View',

			/* Additional Aliases */
	        'Confide'         => 'Zizaco\Confide\ConfideFacade',
			'Entrust'         => 'Zizaco\Entrust\EntrustFacade',
			'Carbon'          => 'Carbon\Carbon',
			'Datatables'      => 'Bllim\Datatables\Datatables',
			'Setting'		  => 'anlutro\LaravelSettings\Facade',
			'Activity'		  => 'Regulus\ActivityLog\Activity',
			'Gravatar'		  => 'Thomaswelton\LaravelGravatar\Facades\Gravatar',
			'Anvard'		  => 'Atticmedia\Anvard\Anvard',
			'CronWrapper'	  => 'Gcphost\Laravelcp\Helpers\CronWrapper',
			'Form'            => 'Caouecs\Bootstrap3\Form',

			/* Laravelcp */
			'String'          => 'Gcphost\Laravelcp\Helpers\String',
			'Theme'           => 'Gcphost\Laravelcp\Helpers\Theme',
			'Api'			  => 'Gcphost\Laravelcp\Helpers\Api',
			'Search'          => 'Gcphost\Laravelcp\Helpers\Search',
			'CronWrapper'     => 'Gcphost\Laravelcp\Helpers\CronWrapper',
			'LCP'		  => 'Gcphost\Laravelcp\Helpers\LaravelCP',
		);

		foreach($providers as $provider) $this->app->register($provider);

		$loader = \Illuminate\Foundation\AliasLoader::getInstance();
		foreach($aliases as $alias => $class) $loader->alias($alias, $class);

		include __DIR__.'/../../filters.php';
		include __DIR__.'/../../routes.php';
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
