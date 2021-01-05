<?php

namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;
use Config\Services;
use CodeIgniter\Session\Session;

class BaseController extends Controller
{
	// Password Salt
	protected int $saltRound = 10;

	// Cookie Expire
	private int $cookieExpire = 86400 * 7; // 7 Days Cookie

	protected Session $session;

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['showError', 'generateID', 'form'];

	public function __construct()
	{
		$this->session = Services::session();
	}

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		if (!isset($this->session)) {
			$this->session = Services::session();
		}
	}

	protected function getCookie(string $name)
	{
		return $this->request->getCookie($name);
	}

	protected function setCookie(string $name, string $value)
	{
		// TODO : Set Secure to true if in SSL
		$this->response->setcookie(
			$name,
			$value,
			$this->cookieExpire,
			'',
			'/',
			'',
			false,
			true
		);
	}

	protected function clearCookies(array $cookies)
	{
		foreach ($cookies as $item) {
			if ($this->getCookie($item)) {
				$this->response->deleteCookie($item);
			}
		}
	}

	public function goBack()
	{
		$httpReferer = $_SERVER['HTTP_REFERER'];
		header("Location: {$httpReferer}");
		exit;
	}

	protected function toAuth()
	{
		header("Location: " . base_url('auth'));
		exit();
	}

	public function createPasswordHash(string $password)
	{
		return password_hash($password, PASSWORD_BCRYPT, [
			'cost' => $this->saltRound
		]);
	}
}
