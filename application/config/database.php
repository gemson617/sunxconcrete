<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

if ($_SERVER['HTTP_HOST'] == 'localhost') {
	$hostname = 'localhost';
	$username = 'root';
	$password = 'root';
	$database = 'sunxconcre';
	$environment = 'development';
} else {
	$hostname 		= 'localhost:3306';
	$username 		= 'mvco_buser';
	$password 		= 'Pass123!@#';
	$database 		= 'mvco_client_camahesh';
	$environment 	= 'production';
}

$db['default'] = array(
	'dsn' => '',
	'hostname' => $hostname,
	'username' => $username,
	'password' => $password,
	'database' => $database,
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== $environment),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE,
);
