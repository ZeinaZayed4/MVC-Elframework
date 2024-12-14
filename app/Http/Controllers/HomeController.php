<?php

namespace App\Http\Controllers;

use illuminates\Http\Request;
use illuminates\Http\Validations\Validation;
use illuminates\Logs\Log;

class HomeController extends Controller
{
	/**
	 * @throws Log
	 */
	public function index()
	{
//		$random = random_bytes(4);
//		$bin = bin2hex($random);
//		echo $bin;
		exit;
		$validation =  $this->validate([
			'user_id' => $_GET['user_id'] ?? '',
		], [
			'user_id' =>  'required|integer',
		], [
			'user_id' => trans('main.user_id'),
		]);
		echo '<pre>';
		var_dump($validation->failed());
	}
	
	public function data()
	{
		return view('data');
	}
	
	public function data_post()
	{
		echo '<pre>';
		var_dump(request());
//		$file = request()->file('file');
//		$name = $file->name(time());
//		return $file->store('my/images');
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
