<?php
/**
 * Rest Config for Rest Class
 *
 *
 * @author Prateek Gupta <prateek.gupta54@gmail.com>
 */

defined('BASEPATH') OR exit('No direct script access allowed');

$config['enabled_login'] = false;

$config['credential'] = ['username' => 'admin@gmail.com', 'password' => '123'];

$config['handle_exception'] = true;

// Expire token timings (will be a parameter in strtotime)
$config['customer_expiry']    = '5000 seconds';