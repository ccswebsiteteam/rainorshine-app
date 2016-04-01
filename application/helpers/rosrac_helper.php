<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('print_array'))
{
	function print_array($array)
	{
		echo '<pre>';
		print_r($array);
		echo '</pre>';
	}
}

if( ! function_exists('generate_random_number'))
{
	function generate_random_number()
	{
		return uniqid(rand(10*45, true));
	}
}

if( ! function_exists('generate_reference_number'))
{
	function generate_reference_number($name)
	{
		return strtoupper(md5(generate_random_number() . $name));
	}
}