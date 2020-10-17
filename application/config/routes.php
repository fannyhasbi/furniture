<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['product'] = 'main/product';
$route['product/(:num)'] = 'main/productDetail/$1';

$route['default_controller'] = 'main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
