<?php

namespace App\Http\Controllers;

use App\Models\User;
use illuminates\Database\Model;
use illuminates\Http\Request;
use illuminates\Http\Validations\Validation;
use illuminates\Logs\Log;

class HomeController extends Controller
{
	public function index()
	{
		var_dump(new User());
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
