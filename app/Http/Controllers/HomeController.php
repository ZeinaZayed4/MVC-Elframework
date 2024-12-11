<?php

namespace App\Http\Controllers;

use illuminates\Http\Validations\Validation;
use illuminates\Logs\Log;

class HomeController extends Controller
{
	/**
	 * @throws Log
	 */
	public function index()
	{
		$validation =  $this->validate([
			'user_id' => $_GET['user_id'] ?? '',
		], [
			'user_id' =>  'required|integer',
		], [
			'user_id' => trans('main.user_id'),
		]);
		
		var_dump($validation->validated());
	}
	
	public function about(): void
	{
		echo 'Welcome to about page <br />';
	}
	
	public function article(int $id): void
	{
		echo 'Welcome to article page id = ' . $id . '<br />';
	}
	
	public function api_any(): void
	{
		echo 'Welcome to api any page <br />';
	}
}
