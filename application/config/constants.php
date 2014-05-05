<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
|--------------------------------------------------------------------------
| Level of log
|--------------------------------------------------------------------------
|
| These levels are for use in function log_messages
|
*/

define('LEVEL_ERROR', 'error');
define('LEVEL_DEBUG', 'debug');
define('LEVEL_INFO', 'info');

/*
|--------------------------------------------------------------------------
| Level log message
|--------------------------------------------------------------------------
|
| Define the levels of log 
|
*/

define('INFO_SESSION_LOGGIN_IN', 'loggin_in');
define('INFO_SESSION_USER', 'mail');

define('DATE_PATTERN', '#^[0-9]{2}/[0-9]{2}/[0-9]{4}$#');
define('PDF_FILES_PATH','./uploads/pdf_files/');

/*
|--------------------------------------------------------------------------
| Table t_user
|--------------------------------------------------------------------------
|
| Names of tables and fields 
|
*/


//Tabla USER
define('USER_TABLE', 't_user');
define('USER_TABLE_FIELD_USER_PK', 'user_pk');
define('USER_TABLE_FIELD_NAME', 'name_vc');
define('USER_TABLE_FIELD_PASS', 'password_vc');
define('USER_TABLE_FIELD_ROLE', 'role_int');

//Tabla PDF_FILES
define('PDF_TABLE', 't_pdf_files');
define('PDF_TABLE_PDF_FILES_PK_FIELD', 'pdf_files_pk');
define('PDF_TABLE_CODE_FIELD', 'code');
define('PDF_TABLE_NAME_FIELD', 'name');
define('PDF_TABLE_FULL_PATH_FIELD', 'full_path');
define('PDF_TABLE_PDF_DATE_FIELD', 'pdf_date');
define('PDF_TABLE_LOAD_DATE_FIELD', 'load_date');
define('PDF_TABLE_ORIG_NAME_FIELD', 'orig_name');


/* End of file constants.php */
/* Location: ./application/config/constants.php */