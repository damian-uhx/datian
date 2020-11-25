<?php
$microtime=microtime(true);

require 'vendor/autoload.php';
use \Firebase\JWT\JWT;
include 'includes.php';

//JWT Example Code
/*$key = "example_key";
$token = array(
    "iss" => "http://example.org",
    "aud" => "http://example.com",
    "iat" => 1356999524,
    "nbf" => 1357000000
);

/**
 * IMPORTANT:
 * You must specify supported algorithms for your application. See
 * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
 * for a list of spec-compliant algorithms.
 */
//$jwt = JWT::encode($token, $key);
//$decoded = JWT::decode($jwt, $key, array('HS256'));
//print_r($decoded);

//make path an array
$path = $_SERVER['REQUEST_URI'];
$path = explode( '?', $path)[0];
$path = substr($path, strlen(PATH)+1);

var_dump($_POST);
//$dir = explode ('/', $path);
if (isset($_POST['create'])){
    echo 'Create';
    create();
}
elseif (isset($_POST['update'])){
    echo 'Update';
}
elseif (isset($_POST['delete'])){
    echo 'Delete';
}
include_once 'page/'.$path.'.php';

echo 'Time: '.number_format((microtime(true)-$microtime)*1000, 0).'ms';

?>