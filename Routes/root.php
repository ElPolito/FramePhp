<?php 
	
	/* This script allow you to add routes you must start by precising the path of the route (here "/", but it could also be "/login")
	then you must put the function in the controller to call the first word must be the name of the controller class without the "Controller" at last
	and after the semicolon you must put the function to call
	*/

	// Home
	$routes->add("/", "Default:home");

	// Blog
	/*
	This example show you how to add some unknown values here blogId.
	THis mean that every address like http://yoursite.com/blog/something will be available with something that can be anything (article-2, 026468465) 
	and will call the method YourMethod in YourController
	On your controller method you must add a parameter whiwh will contain the {blogId} value
	You can also add multiple variables like that /blog/{date}/{name} but you will get {date}/{name} in your method parameter then you can treat it as you want
	*/
	$routes->add("/blog/{blogId}", "YourController:YourMethod");


?>