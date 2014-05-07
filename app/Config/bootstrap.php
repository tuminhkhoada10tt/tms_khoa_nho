<?php

// Setup a 'default' cache configuration for use in the application.
Cache::config('default', array('engine' => 'File'));

CakePlugin::load('BoostCake');
CakePlugin::load('Authorize');
CakePlugin::load('AclManager', array('bootstrap' => true));
CakePlugin::load('DebugKit');
CakePlugin::load('Upload');
CakePlugin::load('TinymceElfinder');

Configure::write('Dispatcher.filters', array(
    'AssetDispatcher',
    'CacheDispatcher'
));

/**
 * Configures default file logging options
 */
App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
    'engine' => 'File',
    'types' => array('notice', 'info', 'debug'),
    'file' => 'debug',
));
CakeLog::config('error', array(
    'engine' => 'File',
    'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
    'file' => 'error',
));
/* System Configuration */
Configure::write('System.name', 'Hệ thống quản lý Công tác Tập huấn giáo viên');
/* User default group */
if (!defined("EMAIL_FROM_ADDRESS")) {
    define("EMAIL_FROM_ADDRESS", 'thaitoan2210@gmail.com');
}
if (!defined("EMAIL_FROM_NAME")) {
    define("EMAIL_FROM_NAME", 'Trường ĐH Trà Vinh, Trung tâm HT - PT Dạy & Học - Hệ thống Quản lý Tập huấn Giáo viên');
}
if (!defined("SITE_URL")) {
    define("SITE_URL", Router::url('/', true));
}
if (!defined("SEND_REGISTRATION_MAIL")) {
    define("SEND_REGISTRATION_MAIL", false);
}
if (!defined("EMAIL_VERIFICATION")) {
    define("EMAIL_VERIFICATION", false);
}