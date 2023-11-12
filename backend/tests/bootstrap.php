<?php
// Define the CodeIgniter application paths
$system_path = '/app/system/';
$application_folder = '/app/application/';

// The following line might not be necessary if it's already set in your phpunit.xml
define('ENVIRONMENT', 'testing');

/*
 * CodeIgniter doesn't have a built-in way to be bootstrapped without going through
 * the front controller (index.php), so we need to simulate the minimal bootstrap
 * process here.
 */

// The name of THIS file
define('FCPATH', __FILE__);

// Path to the system directory
define('BASEPATH', str_replace("\\", "/", $system_path));

// Path to the front controller (this file) directory
define('APPPATH', $application_folder);

// Path to the writable directory
define('WRITEPATH', $application_folder . '/writable');

// Name of the "system" directory
define('SYSDIR', basename($system_path));

// The path to the "views" directory
define('VIEWPATH', $application_folder . '/views/');

// Boot the application
require_once BASEPATH . 'core/CodeIgniter.php';
?>