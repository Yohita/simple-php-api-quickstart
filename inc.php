<?php
if(file_exists(__DIR__.'/env.php')){ include __DIR__.'/env.php';  }else{  die('Error : env.php file not found, Refer env-sample.php.');}
define('ENV', $ENV);
date_default_timezone_set(ENV['timezone'] ?? "Asia/Kolkata"); 
/*include all from libs folder*/ foreach (glob(__DIR__.'/lib/*.php') as $filename) { include $filename; }
/*include all controllers*/ foreach (glob(__DIR__.'/controllers/*.php') as $filename) { include $filename; }
/*include all classes*/ foreach (glob(__DIR__.'/classes/*.php') as $filename) { include $filename; }

//define constants
define('APP_NAME', 'Simple PHP API Quickstart');
define('APP_VERSION', '1.0.0');

//url paths
define('APP_URL', $_SERVER['HTTP_HOST'] ?? 'http://localhost');
define('APP_ASSETS_URL', APP_URL . '/assets');
define('APP_UPLOADS_URL', APP_URL . '/data/uploads');
define('APP_DOWNLOADS_URL', APP_URL . '/data/downloads');

//directory paths
define('APP_ROOT', __DIR__); 
define('APP_CACHE_PATH', APP_ROOT . '/cache'); 
define('APP_DATA_PATH', APP_ROOT . '/data');
define('APP_ASSETS_PATH', APP_DATA_PATH . '/assets');
define('APP_UPLOADS_PATH', APP_DATA_PATH . '/uploads');
define('APP_DOWNLOADS_PATH', APP_DATA_PATH . '/downloads');