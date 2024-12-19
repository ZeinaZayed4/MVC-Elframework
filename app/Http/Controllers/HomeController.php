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
		$users = User::paginate(1);
//		echo $paginate->getTotal() . '<br />';
//		echo $paginate->getPerPage() . '<br />';
//		echo $paginate->getCurrentPage() . '<br />';
//		echo $paginate->hasNextPage() ? 'Yes' : 'No' . '<br />';
//		echo $paginate->hasPreviousPage() ? 'Yes' : 'No' . '<br />';
//		return User::where('name', '=', 'zeina')->count();
//		$users = User::limit(1)->get()->toArray();
//		foreach ($users as $user) {
//			echo $user['name'] . '<br />';
//		};
		return view('index', ['users' => $users]);
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
