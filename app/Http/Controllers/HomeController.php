<?php

namespace App\Http\Controllers;

class HomeController
{
	public function index()
	{
		$title = 'Title';
		$content = 'Content Data';
		return view('index', compact('title', 'content'));
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
