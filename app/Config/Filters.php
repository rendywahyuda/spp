<?php

namespace Config;


use App\Filters\SiswaAuth;
use App\Filters\BendaharaAuth;
use App\Filters\SiswaNoAuth;
use App\Filters\AdminAuth;
use CodeIgniter\Filters\CSRF;
use App\Filters\BendaharaNoAuth;
use App\Filters\AdminNoAuth;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\DebugToolbar;

class Filters extends BaseConfig
{
	/**
	 * Configures aliases for Filter classes to
	 * make reading things nicer and simpler.
	 *
	 * @var array
	 */
	public $aliases = [
		'csrf'     => CSRF::class,
		'toolbar'  => DebugToolbar::class,
		'honeypot' => Honeypot::class,
		'siswaauth' => SiswaAuth::class,
		'bendaharaauth' => BendaharaAuth::class,
		'adminauth' => AdminAuth::class,
		'siswanoauth'   => SiswaNoAuth::class,
		'bendaharanoauth'   => BendaharaNoAuth::class,
		'adminnoauth'   => AdminNoAuth::class,
	];

	/**
	 * List of filter aliases that are always
	 * applied before and after every request.
	 *
	 * @var array
	 */
	public $globals = [
		'before' => [
			// 'honeypot',
			// 'csrf',
		],
		'after'  => [
			'toolbar',
			// 'honeypot',
		],
	];

	/**
	 * List of filter aliases that works on a
	 * particular HTTP method (GET, POST, etc.).
	 *
	 * Example:
	 * 'post' => ['csrf', 'throttle']
	 *
	 * @var array
	 */
	public $methods = [];

	/**
	 * List of filter aliases that should run on any
	 * before or after URI patterns.
	 *
	 * Example:
	 * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
	 *
	 * @var array
	 */
	public $filters = [];
}
