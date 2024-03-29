<?php

return [
	'frontend_url_admin' => env('FRONTEND_URL_ADMIN', null),

	'name' => env('APP_NAME', 'Laravel'),

	'env' => env('APP_ENV', 'production'),

	'stripe_key' => env('STRIPE_KEY', null),

	'stripe_secret' => env('STRIPE_SECRET', null),

	'stripe_webhook_secret' => env('STRIPE_WEBHOOK_SECRET', null),

	'debug' => (bool) env('APP_DEBUG', false),

	'url' => env('APP_URL', 'http://localhost'),

	'frontend_url' => env('FRONTEND_URL'),

	'asset_url' => env('ASSET_URL', null),

	'timezone' => 'UTC',

	'locale' => 'en',

	'fallback_locale' => 'en',

	'faker_locale' => 'en_US',

	'key' => env('APP_KEY'),

	'cipher' => 'AES-256-CBC',

	'firebase_serverapiKey' => env('FIREBASE_SERVERAPIKEY'),
	'firebase_apiKey' => env('FIREBASE_APIKEY'),
	'firebase_authDomain' => env('FIREBASE_AUTHDOMAIN'),
	'firebase_projectId' => env('FIREBASE_PROJECTID'),
	'firebase_storageBucket' => env('FIREBASE_STORAGEBUCKET'),
	'firebase_messagingSenderId' => env('FIREBASE_MESSAGINGSENDERID'),
	'firebase_appId' => env('FIREBASE_APPID'),
	'firebase_measurementId' => env('FIREBASE_MEASUREMENTID'),

	'providers' => [

		/*
         * Laravel Framework Service Providers...
         */
		Illuminate\Auth\AuthServiceProvider::class,
		Illuminate\Broadcasting\BroadcastServiceProvider::class,
		Illuminate\Bus\BusServiceProvider::class,
		Illuminate\Cache\CacheServiceProvider::class,
		Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
		Illuminate\Cookie\CookieServiceProvider::class,
		Illuminate\Database\DatabaseServiceProvider::class,
		Illuminate\Encryption\EncryptionServiceProvider::class,
		Illuminate\Filesystem\FilesystemServiceProvider::class,
		Illuminate\Foundation\Providers\FoundationServiceProvider::class,
		Illuminate\Hashing\HashServiceProvider::class,
		Illuminate\Mail\MailServiceProvider::class,
		Illuminate\Notifications\NotificationServiceProvider::class,
		Illuminate\Pagination\PaginationServiceProvider::class,
		Illuminate\Pipeline\PipelineServiceProvider::class,
		Illuminate\Queue\QueueServiceProvider::class,
		Illuminate\Redis\RedisServiceProvider::class,
		Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
		Illuminate\Session\SessionServiceProvider::class,
		Illuminate\Translation\TranslationServiceProvider::class,
		Illuminate\Validation\ValidationServiceProvider::class,
		Illuminate\View\ViewServiceProvider::class,

		/*
         * Package Service Providers...
         */

		/*
         * Application Service Providers...
         */
		App\Providers\AppServiceProvider::class,
		App\Providers\AuthServiceProvider::class,
		// App\Providers\BroadcastServiceProvider::class,
		App\Providers\EventServiceProvider::class,
		App\Providers\RouteServiceProvider::class,

	],

	/*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

	'aliases' => [

		'App' => Illuminate\Support\Facades\App::class,
		'Arr' => Illuminate\Support\Arr::class,
		'Artisan' => Illuminate\Support\Facades\Artisan::class,
		'Auth' => Illuminate\Support\Facades\Auth::class,
		'Blade' => Illuminate\Support\Facades\Blade::class,
		'Broadcast' => Illuminate\Support\Facades\Broadcast::class,
		'Bus' => Illuminate\Support\Facades\Bus::class,
		'Cache' => Illuminate\Support\Facades\Cache::class,
		'Config' => Illuminate\Support\Facades\Config::class,
		'Cookie' => Illuminate\Support\Facades\Cookie::class,
		'Crypt' => Illuminate\Support\Facades\Crypt::class,
		'Date' => Illuminate\Support\Facades\Date::class,
		'DB' => Illuminate\Support\Facades\DB::class,
		'Eloquent' => Illuminate\Database\Eloquent\Model::class,
		'Event' => Illuminate\Support\Facades\Event::class,
		'File' => Illuminate\Support\Facades\File::class,
		'Gate' => Illuminate\Support\Facades\Gate::class,
		'Hash' => Illuminate\Support\Facades\Hash::class,
		'Http' => Illuminate\Support\Facades\Http::class,
		'Lang' => Illuminate\Support\Facades\Lang::class,
		'Log' => Illuminate\Support\Facades\Log::class,
		'Mail' => Illuminate\Support\Facades\Mail::class,
		'Notification' => Illuminate\Support\Facades\Notification::class,
		'Password' => Illuminate\Support\Facades\Password::class,
		'Queue' => Illuminate\Support\Facades\Queue::class,
		'Redirect' => Illuminate\Support\Facades\Redirect::class,
		'Request' => Illuminate\Support\Facades\Request::class,
		'Response' => Illuminate\Support\Facades\Response::class,
		'Route' => Illuminate\Support\Facades\Route::class,
		'Schema' => Illuminate\Support\Facades\Schema::class,
		'Session' => Illuminate\Support\Facades\Session::class,
		'Storage' => Illuminate\Support\Facades\Storage::class,
		'Str' => Illuminate\Support\Str::class,
		'URL' => Illuminate\Support\Facades\URL::class,
		'Validator' => Illuminate\Support\Facades\Validator::class,
		'View' => Illuminate\Support\Facades\View::class,

	],

];
