<?php

/** Absolute path to the Installer directory. - necessary for php protection */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

/* Some machines don’t have this set so just do it here. */
date_default_timezone_set('UTC');

/******  
 *****  The global Data 1.
  ***
  ***  This data is necessary to call the function without the parameters.
  */

/* These data are default data when the input data is none. */
$GLOBALS['DBHOST_DEFAULT']              = 'localhost';
$GLOBALS['DBPORT_DEFAULT']              = 3306;
$GLOBALS['DBUSER_PREFIX_DEFAULT']       = 'thailay0_';
$GLOBALS['DBUSER_DEFAULT']              = 'shop';
$GLOBALS['DBPASS_DEFAULT']              = '!jpassword';
$GLOBALS['DBNAME_PREFIX_DEFAULT']       = 'thailay0_';
$GLOBALS['SITE_DIR_DEFAULT']            = '/home1/thailay0/public_html/yourlogo/';
$GLOBALS['INSTALL_DIR_PREFIX_DEFAULT']  = 'shop';
$GLOBALS['PACKAGE_NAME_DEFAULT']        = '/home1/thailay0/public_html/yourlogo/installer/20180609_yourlogo_6cd46371650d76c14688180609030304_archive.zip';
$GLOBALS['CPANEL_HOST_DEFAULT']         = 'https://yourlogo.online:2083';
$GLOBALS['CPANEL_USER_DEFAULT']         = 'thailay0';
$GLOBALS['CPANEL_PASS_DEFAULT']         = 'O08l"j&we|';
$GLOBALS['URL_NEW_DEFAULT']             = 'http://yourlogo.online';
$GLOBALS['URL_OLD_DEFAULT']             = 'http://yourlogo.site';
$GLOBALS['PATH_NEW_DEFAULT']            = 'http://yourlogo.online';
$GLOBALS['PATH_OLD_DEFAULT']            = 'http://yourlogo.site';
$GLOBALS['SITEURL_DEFAULT']             = 'http://yourlogo.online';

/* Log file and SQL file path */
$GLOBALS['SQL_FILE_NAME']               = "installer-data.sql";
$GLOBALS['LOG_FILE_NAME']               = "installer-log.txt";
$GLOBALS['LOGGING']                     = 1;

/* The property information of the defult site . */
$GLOBALS['FW_TABLEPREFIX']              = '44e_';
$GLOBALS['FW_URL_OLD']                  = 'http://yourlogo.site';
$GLOBALS['FW_WPROOT']                   = '/home1/thailay0/public_html/yourlogo_site/';
$GLOBALS['FW_WPLOGIN_URL']              = 'http://yourlogo.site/wp-login.php';
$GLOBALS['FW_OPTS_DELETE']              = json_decode('["duplicator_ui_view_state","duplicator_package_active","duplicator_settings"]', true);
$GLOBALS['REPLACE_LIST'] = array();

/* DATABASE SETUP: all time in seconds */
$GLOBALS['DBCHARSET_DEFAULT']           = 'utf8';
$GLOBALS['DBCOLLATE_DEFAULT']           = 'utf8_general_ci';
$GLOBALS['FAQ_URL']                     = 'https://snapcreek.com/duplicator/docs/faqs-tech';
$GLOBALS['DB_MAX_TIME']                 = 5000;
$GLOBALS['DB_MAX_PACKETS']              = 268435456;
$GLOBALS['DB_FCGI_FLUSH']               = false;
ini_set('mysql.connect_timeout', '5000');

/* PHP SETUP: all time in seconds */
ini_set('memory_limit', '2048M');
ini_set("max_execution_time", '5000');
ini_set("max_input_time", '5000');
ini_set('default_socket_timeout', '5000');
@set_time_limit(0);


/**  
 **  If the admin user of the new sub site is none, the program will exit.
  *  This data is necessary to call the function without the parameters.
  */
if (!isset($_POST['wp_user'])) {
    die();
}

/******  
 *****  The posted Data.
  ***  This data is posted the caller is submited in form.
  */
$_POST['sitedir']                       = '/home1/thailay0/public_html/yourlogo/';
$_POST['postguid']                      = 1;
$_POST['path_old']                      = 'http://yourlogo.site';
$_POST['url_old']                       = 'http://yourlogo.site';
$_POST['fullsearch']                    = 1;
$_POST['wp_pass']                       = isset($_POST['wp_pass']) ? trim($_POST['wp_pass']) : $_POST['wp_user'];
$_POST['dbhost']                        = isset($_POST['dbhost']) ? trim($_POST['dbhost']) : $GLOBALS['DBHOST_DEFAULT'];
$_POST['dbport']                        = isset($_POST['dbport']) ? trim($_POST['dbport']) : $GLOBALS['DBPORT_DEFAULT'] ;
$_POST['dbuser']                        = isset($_POST['dbuser']) ? $GLOBALS['DBUSER_PREFIX_DEFAULT'] . trim($_POST['dbuser']) : $GLOBALS['DBUSER_PREFIX_DEFAULT'] . $GLOBALS['DBUSER_DEFAULT'];
$_POST['dbpass']                        = isset($_POST['dbpass']) ? trim($_POST['dbpass']) : $GLOBALS['DBPASS_DEFAULT'];
$_POST['dbname']                        = isset($_POST['dbname']) ? $GLOBALS['DBNAME_PREFIX_DEFAULT'] . trim($_POST['dbname']) : $GLOBALS['DBNAME_PREFIX_DEFAULT'] . $_POST['wp_user'];
$_POST['dbcharset']                     = isset($_POST['dbcharset'])  ? trim($_POST['dbcharset']) : $GLOBALS['DBCHARSET_DEFAULT'];
$_POST['archive_engine']                = isset($_POST['archive_engine']) ? $_POST['archive_engine']  : 'auto';
$_POST['archive_filetime']              = (isset($_POST['archive_filetime'])) ? $_POST['archive_filetime'] : 'current';
$_POST['retain_config']                 = (isset($_POST['retain_config']) && $_POST['retain_config'] == '1') ? true : false;
$_POST['exe_safe_mode']                 = (isset($_POST['exe_safe_mode'])) ? $_POST['exe_safe_mode'] : 0;
$_POST['dbaction']                      = isset($_POST['dbaction']) ? $_POST['dbaction'] : 'create';
$_POST['dbnbsp']                        = (isset($_POST['dbnbsp']) && $_POST['dbnbsp'] == '1') ? true : false;
$_POST['cache_wp']                      = (isset($_POST['cache_wp']))   ? true : false;
$_POST['cache_path']                    = (isset($_POST['cache_path'])) ? true : false;
$_POST['dbcollatefb'                    = isset($_POST['dbcollatefb']) ? $_POST['dbcollatefb'] : false;


/******  
 *****  The posted Data 2.
  ***
  ***   This data is posted the caller is submited in form.
  **    The difference from the posted data 1 is determinated after the posted is decided.
  */
$GLOBALS['INSTALL_DIR_PREFIX']          = isset($_POST['insdir']) ? trim($_POST['insdir']) : $GLOBALS['INSTALL_DIR_PREFIX_DEFAULT'];
$GLOBALS['SITE_DIR']                    = isset($_POST['sitedir']) ?  trim($_POST['sitedir']) : $GLOBALS['SITE_DIR_DEFAULT'];
$GLOBALS['CURRENT_ROOT_PATH']           = isset($_POST['wp_user']) ? $GLOBALS['SITE_DIR'] . '/' . $GLOBALS['INSTALL_DIR_PREFIX'] . '/' . $_POST['wp_user'] : dirname(__FILE__);
$GLOBALS['CHOWN_ROOT_PATH']             = @chmod("{$GLOBALS['CURRENT_ROOT_PATH']}", 0755);
$GLOBALS['CHOWN_LOG_PATH']              = @chmod("{$GLOBALS['CURRENT_ROOT_PATH']}/{$GLOBALS['LOG_FILE_NAME']}", 0644);
$GLOBALS['PHP_MEMORY_LIMIT']            = ini_get('memory_limit') === false ? 'n/a' : ini_get('memory_limit');
$GLOBALS['PHP_SUHOSIN_ON']              = extension_loaded('suhosin') ? 'enabled' : 'disabled';
$GLOBALS['FW_PACKAGE_NAME']             = isset($_POST['archive']) ?  trim($_POST['archive']) : $GLOBALS['PACKAGE_NAME_DEFAULT'];
$GLOBALS['ARCHIVE_PATH']                = $GLOBALS['CURRENT_ROOT_PATH'] . '/' . $GLOBALS['FW_PACKAGE_NAME'];
$GLOBALS['ARCHIVE_PATH']                = str_replace("\\", "/", $GLOBALS['ARCHIVE_PATH']);
$GLOBALS['LOG_FILE_PATH']               = $GLOBALS['CURRENT_ROOT_PATH'] . '/' . $GLOBALS['LOG_FILE_NAME'];
$_POST['archive_name']                  = isset($_POST['archive_name']) ? $_POST['archive_name'] : $GLOBALS['PACKAGE_NAME_DEFAULT'];

/******  
 *****  The preproces.
  ***   
  **    It unzip the archive file.
  */
function unzip_archive_file($target, $archive) {

    if (@is_dir($target)) {
        @rmdir($target);
    }

    $prev_log = "";
    if (class_exists('ZipArchive')) {
        $zip	 = new ZipArchive();
        if ($zip->open($archive) === TRUE) {

            if (!$zip->extractTo($target)) {
                $prev_log .= 'Errors extracting zip file.  Portions or part of the zip archive did not extract correctly.    Try to extract the archive manually with a client side program like unzip/win-zip/winrar or your hosts cPanel to make sure the file is not corrupted.  If the file extracts correctly then there is an invalid file or directory that PHP is unable to extract.  This can happen if your moving from one operating system to another where certain naming conventions work on one environment and not another. <br/><br/> <b>Workarounds:</b> <br/> 1. Create a new package and be sure to exclude any directories that have invalid names or files in them.   This warning will be displayed on the scan results under "Name Checks". <br/> 2. Manually extract the zip file with a client side program or your hosts cPanel.  Then under options in step 1 of this installer check the "Manual Archive Extraction" option and perform the install.';
            }
            $log = print_r($zip, true);

            if ($_POST['archive_filetime'] == 'original') {
                $log .= "File timestamp is 'Original' mode.\n";
                for ($idx = 0; $s = $zip->statIndex($idx); $idx++) {
                    touch($target.DIRECTORY_SEPARATOR.$s['name'], $s['mtime']);
                }
            } else {
                $now = date("Y-m-d H:i:s");
                $log .= "File timestamp is 'Current' mode: {$now}\n";
            }

            $close_response = $zip->close();
            $log .= "<<< EXTRACTION COMPLETE: " . var_export($close_response, true);
            $prev_log .= $log;
        } else {
            $prev_log = 'Failed to open zip archive file. Please be sure the archive is completely downloaded before running the installer. Try to extract the archive manually to make sure the file is not corrupted.';
        }
    } else {
        $log_file_handle = @fopen($GLOBALS['LOG_FILE_NAME'] , "w+");
        $msg = "ZipArchive class do not exist";
        $breaks = array("<br />","<br>","<br/>");  
        $log_msg = str_ireplace($breaks, "\r\n", $msg);
        $log_msg = strip_tags($log_msg);
        @fwrite($log_file_handle, "\nINSTALLER ERROR:\n{$log_msg}\n");
        @fclose($log_file_handle);
        die("<div class='dupx-ui-error'><hr size='1' /><b style='color:#B80000;'>INSTALL ERROR!</b><br/>{$msg}</div>");
    }
}

unzip_archive_file($GLOBALS['CURRENT_ROOT_PATH'], $_POST['archive_name']);

/******  
 *****  Includ the required files.
  ***   
  */
require_once('dupx/class.dupx.u.php');
require_once('dupx/class.dupx.server.php');
require_once('dupx/class.dupx.db.php');
require_once('dupx/class.dupx.log.php');
require_once('dupx/class.dupx.updateengine.php');
require_once('dupx/class.dupx.wpconfig.php');
require_once('dupx/class.dupx.serverconfig.php');
require_once('cpanel/class.cpnl.ctrl.php');

/* It open the log file and set the file handle as a global variable. */
$GLOBALS['LOG_FILE_HANDLE']                 = @fopen($GLOBALS['LOG_FILE_PATH'], "w+");

/*********  
 *******
  ****                   The main process start!
  */

/*****
  ***   The first process
  **    This process log the current status.
  */
$prev_log = "\n>>> START EXTRACTION:";
DUPX_Log::info("********************************************************************************");
DUPX_Log::info('* DUPLICATOR-LITE: INSTALL-LOG');
DUPX_Log::info("* VERSION: {$GLOBALS['FW_DUPLICATOR_VERSION']}");
DUPX_Log::info('* STEP-1 START @ '.@date('h:i:s'));
DUPX_Log::info('* NOTICE: Do NOT post this data to public sites or forums');
DUPX_Log::info("********************************************************************************");
DUPX_Log::info("PHP VERSION:\t".phpversion().' | SAPI: '.php_sapi_name());
DUPX_Log::info("PHP TIME LIMIT:\t{$php_max_time}");
DUPX_Log::info("PHP MEMORY:\t".$GLOBALS['PHP_MEMORY_LIMIT'].' | SUHOSIN: '.$GLOBALS['PHP_SUHOSIN_ON']);
DUPX_Log::info("SERVER:\t\t{$_SERVER['SERVER_SOFTWARE']}");
DUPX_Log::info("DOC ROOT:\t{$root_path}");
DUPX_Log::info("DOC ROOT 755:\t".var_export($GLOBALS['CHOWN_ROOT_PATH'], true));
DUPX_Log::info("LOG FILE 644:\t".var_export($GLOBALS['CHOWN_LOG_PATH'], true));
DUPX_Log::info("REQUEST URL:\t{$GLOBALS['URL_PATH']}");
DUPX_Log::info("SAFE MODE :\t{$_POST['exe_safe_mode']}");

$log = "--------------------------------------\n";
$log .= "POST DATA\n";
$log .= "--------------------------------------\n";
$log .= print_r($POST_LOG, true);
DUPX_Log::info($log, 2);

$log = "--------------------------------------\n";
$log .= "ARCHIVE EXTRACTION\n";
$log .= "--------------------------------------\n";
$log .= "NAME:\t{$_POST['archive_name']}\n";
$log .= "SIZE:\t".DUPX_U::readableByteSize(@filesize($_POST['archive_name']))."\n";
$log .= "ZIP:\t{$zip_support} (ZipArchive Support)";
DUPX_Log::info($log);

if ($GLOBALS['FW_PACKAGE_NAME'] != $_POST['archive_name']) {
    $log = "\n--------------------------------------\n";
    $log .= "WARNING: This package set may be incompatible!  \nBelow is a summary of the package this installer was built with and the package used. \n";
    $log .= "To guarantee accuracy the installer and archive should match. For details see the online FAQs.";
    $log .= "\nCREATED WITH:\t{$GLOBALS['FW_PACKAGE_NAME']} \nPROCESSED WITH:\t{$_POST['archive_name']}  \n";
    $log .= "--------------------------------------\n";
    DUPX_Log::info($log);
}

/*
 *   RESET SERVER CONFIG FILES
 */
if ($_POST['retain_config']) {
	DUPX_Log::info("\nNOTICE: Manual update of permalinks required see:  Admin > Settings > Permalinks > Click Save Changes");
	DUPX_Log::info("Retaining the original htaccess, user.ini or web.config files may cause issues with the setup of this site.");
	DUPX_Log::info("If you run into issues during or after the install process please uncheck the 'Config Files' checkbox labeled:");
	DUPX_Log::info("'Retain original .htaccess, .user.ini and web.config' from Step 1 and re-run the installer. Backups of the");
	DUPX_Log::info("orginal config files will be made and can be merged per required directive.");
} else {
	DUPX_ServerConfig::reset();
}

/*
 *   FINAL RESULTS
 */
$ajax1_end	 = DUPX_U::getMicrotime();
$ajax1_sum	 = DUPX_U::elapsedTime($ajax1_end, $ajax1_start);
DUPX_Log::info("\nSTEP-1 COMPLETE @ " . @date('h:i:s') . " - RUNTIME: {$ajax1_sum}");

//PAGE VARS
$date_time      = @date('h:i:s');
$ajax2_start	= DUPX_U::getMicrotime();

/*
 *   ERROR MESSAGES
 */
/* ERR_MYSQLI_SUPPORT */
function_exists('mysqli_connect') or DUPX_Log::error(ERR_MYSQLI_SUPPORT);

/* Create db_user and db via Cpanel API */
function create_db_and_user(host, cp_user, cp_pass, db_name, db_user, db_pass) {
    $CPNL		 = new DUPX_cPanel_Controller();
    $cpnlToken	 = $CPNL->create_token(host, cp_user, cp_user);
    $cpnlHost	 = $CPNL->connect($cpnlToken);
    
    $result = $CPNL->create_db_user($cpnlToken, db_user, db_pass);
    if ($_POST['dbaction'] == 'create' ) {
        $result = $CPNL->delete_db($cpnlToken, db_name);
    } 
    $result = $CPNL->create_db($cpnlToken, db_name);
    
    $result = $CPNL->is_user_in_db($cpnlToken, db_name, db_user);
    if (!$result['status']) {
        $result = $CPNL->assign_db_user($cpnlToken, db_name, db_user);
    }
}
create_db_and_user($GLOBALS['CPANEL_HOST_DEFAULT'], $GLOBALS['CPANEL_USER_DEFAULT'], $GLOBALS['CPANEL_PASS_DEFAULT'], $_POST['dbname'],  $_POST['dbuser'], $_POST['dbpass']);

/* ERR_DBCONNECT */
$dbh = DUPX_DB::connect($_POST['dbhost'], $_POST['dbuser'], $_POST['dbpass'], null, $_POST['dbport']);
@mysqli_query($dbh, "SET wait_timeout = {$GLOBALS['DB_MAX_TIME']}");
($dbh) or DUPX_Log::error(ERR_DBCONNECT . mysqli_connect_error());

/* ERR_DBCSELECT */
mysqli_select_db($dbh, $_POST['dbname']) or DUPX_Log::error(sprintf(ERR_DBCREATE, $_POST['dbname']));

/*****
  ***   The second process
  **    This process log the current status.
  */
$log = <<<LOG
\n\n********************************************************************************
* DUPLICATOR-LITE: INSTALL-LOG
* STEP-2 START @ {$date_time}
* NOTICE: Do NOT post to public sites or forums
********************************************************************************
LOG;
DUPX_Log::info($log);

$log  = "--------------------------------------\n";
$log .= "POST DATA\n";
$log .= "--------------------------------------\n";
$log .= print_r($POST_LOG, true);
DUPX_Log::info($log, 2);

/* Scan the database file and create the installer-data.sql. */
$log = '';
$faq_url = $GLOBALS['FAQ_URL'];
$utm_prefix = '?utm_source=duplicator_free&utm_medium=wordpress_plugin&utm_campaign=problem_resolution&utm_content=';
$sql_file_name = 'database.sql';
$db_file_size = filesize($root_path . '/' . $sql_file_name);
$php_mem = $GLOBALS['PHP_MEMORY_LIMIT'];
$php_mem_range = DUPX_U::getBytes($GLOBALS['PHP_MEMORY_LIMIT']);
$php_mem_range = $php_mem_range == null ?  0 : $php_mem_range - 5000000; //5 MB Buffer

/*
   Fatal Memory errors from file_get_contents is not catchable.
   Try to warn ahead of time with a buffer in memory differenceble.
 */
if ($db_file_size >= $php_mem_range  && $php_mem_range != 0)
{
	$db_file_size = DUPX_U::readableByteSize($db_file_size);
	$msg = "\nWARNING: The database script is '{$db_file_size}' in size.  The PHP memory allocation is set\n";
	$msg .= "at '{$php_mem}'.  There is a high possibility that the installer script will fail with\n";
	$msg .= "a memory allocation error when trying to load the database.sql file.  It is\n";
	$msg .= "recommended to increase the 'memory_limit' setting in the php.ini config file.\n";
    $msg .= "see: {$faq_url}{$utm_prefix}inst_step2_lgdbscript#faq-trouble-056-q \n";
	DUPX_Log::info($msg);
}

function scan_sql_file($path, $sql_file_name, $dbnbsp, $dbcollatefb, $new_sql_file_name, $dbh) {
    @chmod($path . '/' . $sql_file_name, 0777);
    $sql_file = file_get_contents($path . '/' . $sql_file_name, true);
    
    /* ERROR: Reading database.sql file */
    if ($sql_file === FALSE || strlen($sql_file) < 10)
    {
        $msg = "<b>Unable to read the database.sql file from the archive.  Please check these items:</b> <br/>";
        $msg .= " - File: database.sql <br/> - Directory: [{$path}] <br/>";
        DUPX_Log::error($msg);
    }

    /* Removes invalid space characters
       Complex Subject See: http://webcollab.sourceforge.net/unicode.html
    */
    if ($dbnbsp)
    {
        DUPX_Log::info("NOTICE: Ran fix non-breaking space characters\n");
        $sql_file = preg_replace('/\xC2\xA0/', ' ', $sql_file);
    }
    
    /* Write new contents to install-data.sql */
    $sql_file_copy_status   = file_put_contents($path . '/' . $new_sql_file_name, $sql_file);
    $sql_result_file_data	= explode(";\n", $sql_file);
    $sql_result_file_length = count($sql_result_file_data);
    $sql_result_file_path	= "{$path}/{$new_sql_file_name}";
    $sql_file = null;
    $db_collatefb_log = '';

    if($dbcollatefb) {
        $supportedCollations = DUPX_DB::getSupportedCollationsList($dbh);
        $collation_arr = array(
            'utf8mb4_unicode_520_ci',
            'utf8mb4_unicode_520',
            'utf8mb4_unicode_ci',
            'utf8mb4',
            'utf8_unicode_520_ci',
            'utf8_unicode_520',
            'utf8_unicode_ci',
            'utf8'
        );
        $latest_supported_collation = '';
        $latest_supported_index = -1;

        foreach ($collation_arr as $key => $val){
            if(in_array($val,$supportedCollations)){
                $latest_supported_collation = $val;
                $latest_supported_index = $key;
                break;
            }
        }

        /* No need to replace if current DB is up to date */
        if($latest_supported_index != 0){
            for($i=0; $i < $latest_supported_index; $i++){
                foreach ($sql_result_file_data as $index => $col_sql_query){
                    if(strpos($col_sql_query,$collation_arr[$i]) !== false){
                        $sql_result_file_data[$index] = str_replace($collation_arr[$i], $latest_supported_collation, $col_sql_query);
                        if(strpos($collation_arr[$i],'utf8mb4') !== false && strpos($latest_supported_collation,'utf8mb4') === false){
                            $sql_result_file_data[$index] = str_replace('utf8mb4','utf8',$sql_result_file_data[$index]);
                        }
                        $sub_query = str_replace("\n", '', substr($col_sql_query, 0, 75));
                        $db_collatefb_log .= "   - Collation '{$collation_arr[$i]}' set to '{$latest_supported_collation}' on query [{$sub_query}...]\n";
                    }
                }
            }
        }
    }

    /* WARNING: Create installer-data.sql failed */
    if ($sql_file_copy_status === FALSE || filesize($sql_result_file_path) == 0 || !is_readable($sql_result_file_path))
    {
        $sql_file_size = DUPX_U::readableByteSize(filesize($path . '/' . $sql_file_name));
        $msg  = "\nWARNING: Unable to properly copy database.sql ({$sql_file_size}) to {$GLOBALS['SQL_FILE_NAME']}.  Please check these items:\n";
        $msg .= "- Validate permissions and/or group-owner rights on database.sql and directory [{$path}] \n";
        DUPX_Log::info($msg);
    }
}

scan_sql_file($root_path, $sql_file_name, $_POST['dbnbsp'], $_POST['dbcollatefb'], $GLOBALS['SQL_FILE_NAME'],  $dbh);

/*
   START DB RUN
 */
function start_db_run($dbh, $path, $sql_file_name, $new_sql_file_name, $dbcharset, $dbcollate, $dbcollatefb) {
    @mysqli_query($dbh, "SET wait_timeout = {$GLOBALS['DB_MAX_TIME']}");
    @mysqli_query($dbh, "SET max_allowed_packet = {$GLOBALS['DB_MAX_PACKETS']}");
    DUPX_DB::setCharset($dbh, $dbcharset, $dbcollate);

    //Set defaults in-case the variable could not be read
    $dbvar_maxtime		= DUPX_DB::getVariable($dbh, 'wait_timeout');
    $dbvar_maxpacks		= DUPX_DB::getVariable($dbh, 'max_allowed_packet');
    $dbvar_sqlmode		= DUPX_DB::getVariable($dbh, 'sql_mode');
    $dbvar_maxtime		= is_null($dbvar_maxtime) ? 300 : $dbvar_maxtime;
    $dbvar_maxpacks		= is_null($dbvar_maxpacks) ? 1048576 : $dbvar_maxpacks;
    $dbvar_sqlmode		= empty($dbvar_sqlmode) ? 'NOT_SET'  : $dbvar_sqlmode;
    $dbvar_version		= DUPX_DB::getVersion($dbh);
    $sql_file_size1		= DUPX_U::readableByteSize(@filesize($path . '/' .$sql_file_name));
    $sql_file_size2		= DUPX_U::readableByteSize(@filesize($path . '/' . $new_sql_file_name));
    $db_collatefb		= isset($dbcollatef) ? 'On' : 'Off';
    
    DUPX_Log::info("--------------------------------------");
    DUPX_Log::info("DATABASE ENVIRONMENT");
    DUPX_Log::info("--------------------------------------");
    DUPX_Log::info("MYSQL VERSION:\tThis Server: {$dbvar_version} -- Build Server: {$GLOBALS['FW_VERSION_DB']}");
    DUPX_Log::info("FILE SIZE:\tdatabase.sql ({$sql_file_size1}) - installer-data.sql ({$sql_file_size2})");
    DUPX_Log::info("TIMEOUT:\t{$dbvar_maxtime}");
    DUPX_Log::info("MAXPACK:\t{$dbvar_maxpacks}");
    DUPX_Log::info("SQLMODE:\t{$dbvar_sqlmode}");
    DUPX_Log::info("NEW SQL FILE:\t[{$sql_result_file_path}]");
    DUPX_Log::info("COLLATE RESET:\t{$db_collatefb}\n{$db_collatefb_log}");

    if ($qry_session_custom == false) {
        DUPX_Log::info("\n{$log}\n");
    }
}

start_db_run($dbh, $path, $sql_file_name, $new_sql_file_name,  $_POST['dbcharset'], $_POST['dbcollate'], $_POST['dbcollatefb']);

function write_new_db_file($dbh, $sql_result_file_length, $sql_result_file_data, $dbhost, $dbuser, $dbpass, $dbname, $dbport, $dbcharset, $dbcollate) {
    //WRITE DATA
    DUPX_Log::info("--------------------------------------");
    DUPX_Log::info("DATABASE RESULTS");
    DUPX_Log::info("--------------------------------------");
    $profile_start = DUPX_U::getMicrotime();
    $fcgi_buffer_pool = 5000;
    $fcgi_buffer_count = 0;
    $dbquery_rows = 0;
    $dbtable_rows = 1;
    $dbquery_errs = 0;
    $counter = 0;
    @mysqli_autocommit($dbh, false);
    
    while ($counter < $sql_result_file_length) {

        $query_strlen = strlen(trim($sql_result_file_data[$counter]));

        if ($dbvar_maxpacks < $query_strlen) {

            DUPX_Log::info("**ERROR** Query size limit [length={$query_strlen}] [sql=" . substr($sql_result_file_data[$counter], 0, 75) . "...]");
            $dbquery_errs++;

        } elseif ($query_strlen > 0) {

            @mysqli_free_result(@mysqli_query($dbh, ($sql_result_file_data[$counter])));
            $err = mysqli_error($dbh);

            /* Check to make sure the connection is alive */
            if (!empty($err)) {

                if (!mysqli_ping($dbh)) {
                    mysqli_close($dbh);
                    $dbh = DUPX_DB::connect($dbhost, $dbuser, $dbpass, $dbname, $dbport);
                    // Reset session setup
                    @mysqli_query($dbh, "SET wait_timeout = {$GLOBALS['DB_MAX_TIME']}");
                    DUPX_DB::setCharset($dbh, $dbcharset, $dbcollate);
                }
                DUPX_Log::info("**ERROR** database error write '{$err}' - [sql=" . substr($sql_result_file_data[$counter], 0, 75) . "...]");
                $dbquery_errs++;

            /* Buffer data to browser to keep connection open */
            } else {
                if ($GLOBALS['DB_FCGI_FLUSH'] && $fcgi_buffer_count++ > $fcgi_buffer_pool) {
                    $fcgi_buffer_count = 0;
                    DUPX_U::fcgiFlush();
                }
                $dbquery_rows++;
            }
        }
        $counter++;
    }
    @mysqli_commit($dbh);
    @mysqli_autocommit($dbh, true);

    DUPX_Log::info("ERRORS FOUND:\t{$dbquery_errs}");
    DUPX_Log::info("TABLES DROPPED:\t{$drop_log}");
    DUPX_Log::info("QUERIES RAN:\t{$dbquery_rows}\n");
}

write_new_db_file($dbh, $sql_result_file_length, $sql_result_file_data, $_POST['dbhost'], $_POST['dbuser'], $_POST['dbpass'], $_POST['dbname'], $_POST['dbport'], $_POST['dbcharset'], $_POST['dbcollate']);

/*  Find the rows and tables to replace the fileds */
if ($_POST['fullsearch']) {
    $_POST['tables'] = array();
}
$dbtable_count = 0;
if ($result = mysqli_query($dbh, "SHOW TABLES")) {
	while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
		$table_rows = DUPX_DB::countTableRows($dbh, $row[0]);
        $dbtable_rows += $table_rows;
        if ($_POST['fullsearch']) {
            if (is_array($_POST['tables'])) {
                array_push($_POST['tables'], $row[0]);
            } else {
                $_POST['tables'] = array($row[0]);
            }
        }
		DUPX_Log::info("{$row[0]}: ({$table_rows})");
		$dbtable_count++;
	}
	@mysqli_free_result($result);
}

if ($dbtable_count == 0) {
	DUPX_Log::error("No tables where created during step 2 of the install.  Please review the <a href='installer-log.txt' target='install_log'>installer-log.txt</a> file for
		ERROR messages.  You may have to manually run the installer-data.sql with a tool like phpmyadmin to validate the data input.  If you have enabled compatibility mode
		during the package creation process then the database server version your using may not be compatible with this script.\n");
}

/***
 **  DATA CLEANUP: Perform Transient Cache Cleanup
 *  Remove all duplicator entries and record this one since this is a new install.
 */
$dbdelete_count = 0;
@mysqli_query($dbh, "DELETE FROM `{$GLOBALS['FW_TABLEPREFIX']}duplicator_packages`");
$dbdelete_count1 = @mysqli_affected_rows($dbh) or 0;
@mysqli_query($dbh, "DELETE FROM `{$GLOBALS['FW_TABLEPREFIX']}options` WHERE `option_name` LIKE ('_transient%') OR `option_name` LIKE ('_site_transient%')");
$dbdelete_count2 = @mysqli_affected_rows($dbh) or 0;
$dbdelete_count = (abs($dbdelete_count1) + abs($dbdelete_count2));
DUPX_Log::info("\nRemoved '{$dbdelete_count}' cache/transient rows");

/* Reset Duplicator Options */
foreach ($GLOBALS['FW_OPTS_DELETE'] as $value) {
	mysqli_query($dbh, "DELETE FROM `{$GLOBALS['FW_TABLEPREFIX']}options` WHERE `option_name` = '{$value}'");
}

@mysqli_close($dbh);

/* FINAL RESULTS */
$profile_end	= DUPX_U::getMicrotime();
$ajax2_end		= DUPX_U::getMicrotime();
$ajax1_sum		= DUPX_U::elapsedTime($ajax2_end, $ajax2_start);
DUPX_Log::info("\nCREATE/INSTALL RUNTIME: " . DUPX_U::elapsedTime($profile_end, $profile_start));
DUPX_Log::info('STEP-2 COMPLETE @ ' . @date('h:i:s') . " - RUNTIME: {$ajax1_sum}");

/*****
  ***   The Third process
  **    This process update the database.
  */
$ajax2_start = DUPX_U::getMicrotime();

/* MYSQL CONNECTION */
$dbh = DUPX_DB::connect($_POST['dbhost'], $_POST['dbuser'], html_entity_decode($_POST['dbpass']), $_POST['dbname'], $_POST['dbport']);
$charset_server = @mysqli_character_set_name($dbh);
@mysqli_query($dbh, "SET wait_timeout = {$GLOBALS['DB_MAX_TIME']}");
DUPX_DB::setCharset($dbh, $_POST['dbcharset'], $_POST['dbcollate']);

/* POST PARAMS */
$_POST['blogname']		= mysqli_real_escape_string($dbh, $_POST['blogname']);
$_POST['postguid']		= isset($_POST['postguid']) && $_POST['postguid'] == 1 ? 1 : 0;
$_POST['fullsearch']	= isset($_POST['fullsearch']) && $_POST['fullsearch'] == 1 ? 1 : 0;
$_POST['path_old']		= isset($_POST['path_old']) ? trim($_POST['path_old']) : $GLOBALS['PATH_OLD_DEFAULT'];
$_POST['siteurl']		= isset($_POST['siteurl']) ? rtrim(trim($_POST['siteurl']), '/') : rtrim(trim($GLOBALS['SITEURL_DEFAULT'] . '/' . $GLOBALS['INSTALL_DIR_PREFIX'] . '/' . $_POST['wp_user']), '/');
$_POST['path_new']		= isset($_POST['path_new']) ? trim($_POST['path_new']) : $_POST['siteurl'];
$_POST['tables']		= isset($_POST['tables']) && is_array($_POST['tables']) ? array_map('stripcslashes', $_POST['tables']) : array();
$_POST['url_old']		= isset($_POST['url_old']) ? trim($_POST['url_old']) : $GLOBALS['URL_OLD_DEFAULT'];
$_POST['url_new']		= isset($_POST['url_new']) ? rtrim(trim($_POST['url_new']), '/') : $GLOBALS['URL_NEW_DEFAULT'] . '/' . $_POST['wp_user'];
$_POST['retain_config'] = (isset($_POST['retain_config']) && $_POST['retain_config'] == '1') ? true : false;
$_POST['exe_safe_mode']	= isset($_POST['exe_safe_mode']) ? $_POST['exe_safe_mode'] : 0;

/* LOGGING */
$POST_LOG = $_POST;
unset($POST_LOG['tables']);
unset($POST_LOG['plugins']);
unset($POST_LOG['dbpass']);
ksort($POST_LOG);

$date = @date('h:i:s');
$charset_client = @mysqli_character_set_name($dbh);

$log = <<<LOG
\n\n********************************************************************************
* DUPLICATOR-LITE: INSTALL-LOG
* STEP-3 START @ {$date}
* NOTICE: Do NOT post to public sites or forums
********************************************************************************
CHARSET SERVER:\t{$charset_server}
CHARSET CLIENT:\t{$charset_client}
LOG;
DUPX_Log::info($log);

/* Detailed logging */
$log  = "--------------------------------------\n";
$log .= "POST DATA\n";
$log .= "--------------------------------------\n";
$log .= print_r($POST_LOG, true);		
$log .= "--------------------------------------\n";
$log .= "SCANNED TABLES\n";
$log .= "--------------------------------------\n";
$log .= (isset($_POST['tables']) && count($_POST['tables'] > 0)) 
		? print_r($_POST['tables'], true) 
		: 'No tables selected to update';
$log .= "--------------------------------------\n";
$log .= "KEEP PLUGINS ACTIVE\n";
$log .= "--------------------------------------\n";
$log .= (isset($_POST['plugins']) && count($_POST['plugins'] > 0)) 
		? print_r($_POST['plugins'], true) 
		: 'No plugins selected for activation';
DUPX_Log::info($log);

/* UPDATE SETTINGS */
$blog_name   = $_POST['blogname'];
$plugin_list = (isset($_POST['plugins'])) ? $_POST['plugins'] : array();
// Force Duplicator active so we the security cleanup will be available
if (!in_array('duplicator/duplicator.php', $plugin_list)) {
	$plugin_list[] = 'duplicator/duplicator.php';
}
$serial_plugin_list	 = @serialize($plugin_list);

mysqli_query($dbh, "UPDATE `{$GLOBALS['FW_TABLEPREFIX']}options` SET option_value = '{$blog_name}' WHERE option_name = 'blogname' ");
//mysqli_query($dbh, "UPDATE `{$GLOBALS['FW_TABLEPREFIX']}options` SET option_value = '{$serial_plugin_list}'  WHERE option_name = 'active_plugins' ");

$log  = "--------------------------------------\n";
$log .= "SERIALIZER ENGINE\n";
$log .= "[*] scan every column\n";
$log .= "[~] scan only text columns\n";
$log .= "[^] no searchable columns\n";
$log .= "--------------------------------------";
DUPX_Log::info($log);

$url_old_json = str_replace('"', "", json_encode($_POST['url_old']));
$url_new_json = str_replace('"', "", json_encode($_POST['url_new']));
$path_old_json = str_replace('"', "", json_encode($_POST['path_old']));
$path_new_json = str_replace('"', "", json_encode($_POST['path_new']));

/* DIRS PATHSS */
array_push($GLOBALS['REPLACE_LIST'],
	array('search' => $_POST['path_old'],			 'replace' => $_POST['path_new']),
	array('search' => $path_old_json,				 'replace' => $path_new_json),
	array('search' => urlencode($_POST['path_old']), 'replace' => urlencode($_POST['path_new'])),
	array('search' => rtrim(DUPX_U::unsetSafePath($_POST['path_old']), '\\'), 'replace' => rtrim($_POST['path_new'], '/'))
);

/* SEARCH WITH NO PROTOCAL: RAW */
$url_old_raw = str_ireplace(array('http://', 'https://'), '//', $_POST['url_old']);
$url_new_raw = str_ireplace(array('http://', 'https://'), '//', $_POST['url_new']);
$url_old_raw_json = str_replace('"',  "", json_encode($url_old_raw));
$url_new_raw_json = str_replace('"',  "", json_encode($url_new_raw));
array_push($GLOBALS['REPLACE_LIST'],
    array('search' => $url_old_raw,			 	'replace' => $url_new_raw),
    array('search' => $url_old_raw_json,		'replace' => $url_new_raw_json),
    array('search' => urlencode($url_old_raw), 	'replace' => urlencode($url_new_raw))
);


/* SEARCH HTTP(S) EXPLICIT REQUEST
    Because the raw replace above has already changed all urls just fix https/http issue
    if the user has explicitly asked other-wise word boundary issues will occur:
    Old site: http://mydomain.com/somename/
    New site: http://mydomain.com/somename-dup/
    Result: http://mydomain.com/somename-dup-dup/
*/
if (stristr($_POST['url_old'], 'http:') && stristr($_POST['url_new'], 'https:') ) {
    $url_old_http = str_ireplace('https:', 'http:', $_POST['url_new']);
    $url_new_http = $_POST['url_new'];
    $url_old_http_json = str_replace('"',  "", json_encode($url_old_http));
    $url_new_http_json = str_replace('"',  "", json_encode($url_new_http));

} elseif(stristr($_POST['url_old'], 'https:') && stristr($_POST['url_new'], 'http:')) {
    $url_old_http = str_ireplace('http:', 'https:', $_POST['url_new']);
    $url_new_http = $_POST['url_new'];
    $url_old_http_json = str_replace('"',  "", json_encode($url_old_http));
    $url_new_http_json = str_replace('"',  "", json_encode($url_new_http));
}
if(isset($url_old_http)){
    array_push($GLOBALS['REPLACE_LIST'],
        array('search' => $url_old_http,			 	 'replace' => $url_new_http),
        array('search' => $url_old_http_json,			 'replace' => $url_new_http_json),
        array('search' => urlencode($url_old_http),  	 'replace' => urlencode($url_new_http))
    );
}

/* Remove trailing slashes */
function _dupx_array_rtrim(&$value) {
    $value = rtrim($value, '\/');
}
array_walk_recursive($GLOBALS['REPLACE_LIST'], _dupx_array_rtrim);

@mysqli_autocommit($dbh, false);

$report = DUPX_UpdateEngine::load($dbh, $GLOBALS['REPLACE_LIST'], $_POST['tables'], $_POST['fullsearch']);
@mysqli_commit($dbh);
@mysqli_autocommit($dbh, true);

DUPX_UpdateEngine::logStats($report);
DUPX_UpdateEngine::logErrors($report);

/* Reset the postguid data */
if ($_POST['postguid']) {
	mysqli_query($dbh, "UPDATE `{$GLOBALS['FW_TABLEPREFIX']}posts` SET guid = REPLACE(guid, '{$_POST['url_new']}', '{$_POST['url_old']}')");
	$update_guid = @mysqli_affected_rows($dbh) or 0;
	DUPX_Log::info("Reverted '{$update_guid}' post guid columns back to '{$_POST['url_old']}'");
}

/** FINAL UPDATES: Must happen after the global replace to prevent double pathing
  http://xyz.com/abc01 will become http://xyz.com/abc0101  with trailing data */
mysqli_query($dbh, "UPDATE `{$GLOBALS['FW_TABLEPREFIX']}options` SET option_value = '{$_POST['url_new']}'  WHERE option_name = 'home' ");
mysqli_query($dbh, "UPDATE `{$GLOBALS['FW_TABLEPREFIX']}options` SET option_value = '{$_POST['siteurl']}'  WHERE option_name = 'siteurl' ");
mysqli_query($dbh, "INSERT INTO `{$GLOBALS['FW_TABLEPREFIX']}options` (option_value, option_name) VALUES('{$_POST['exe_safe_mode']}','duplicator_exe_safe_mode')");

/*
    CONFIGURATION FILE UPDATES
*/
DUPX_Log::info("\n====================================");
DUPX_Log::info('CONFIGURATION FILE UPDATES:');
DUPX_Log::info("====================================\n");
DUPX_WPConfig::updateStandard();
$config_file = DUPX_WPConfig::updateExtended();
DUPX_Log::info("UPDATED WP-CONFIG: {$root_path}/wp-config.php' (if present)");

/* Web Server Config Updates */
if (!isset($_POST['url_new']) || $_POST['retain_config']) {
    DUPX_Log::info("\nNOTICE: Manual update of permalinks required see:  Admin > Settings > Permalinks > Click Save Changes");
    DUPX_Log::info("Retaining the original htaccess, user.ini or web.config files may cause issues with the setup of this site.");
    DUPX_Log::info("If you run into issues during or after the install process please uncheck the 'Config Files' checkbox labeled:");
    DUPX_Log::info("'Retain original .htaccess, .user.ini and web.config' from Step 1 and re-run the installer. Backups of the");
    DUPX_Log::info("orginal config files will be made and can be merged per required directive.");
} else {
    DUPX_ServerConfig::setup($dbh);
}


/* GENERAL UPDATES & CLEANUP */
DUPX_Log::info("\n====================================");
DUPX_Log::info('GENERAL UPDATES & CLEANUP:');
DUPX_Log::info("====================================\n");

/** CREATE NEW USER LOGIC */
if (strlen($_POST['wp_user']) >= 1 && strlen($_POST['wp_pass']) >= 1) {
	
	$newuser_check = mysqli_query($dbh, "SELECT COUNT(*) AS count FROM `{$GLOBALS['FW_TABLEPREFIX']}users` WHERE user_login = '{$_POST['wp_user']}' ");
	$newuser_row   = mysqli_fetch_row($newuser_check);
    $newuser_count = is_null($newuser_row) ? 0 : $newuser_row[0];
	
	if ($newuser_count == 0) {
	
		$newuser_datetime =	@date("Y-m-d H:i:s");
		$newuser_security = mysqli_real_escape_string($dbh, 'a:1:{s:13:"administrator";s:1:"1";}');

		$newuser_test1 = @mysqli_query($dbh, "INSERT INTO `{$GLOBALS['FW_TABLEPREFIX']}users` 
			(`user_login`, `user_pass`, `user_nicename`, `user_email`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) 
			VALUES ('{$_POST['wp_user']}', MD5('{$_POST['wp_pass']}'), '{$_POST['wp_user']}', '', '{$newuser_datetime}', '', '0', '{$_POST['wp_user']}')");

		$newuser_insert_id = mysqli_insert_id($dbh);

		$newuser_test2 = @mysqli_query($dbh, "INSERT INTO `{$GLOBALS['FW_TABLEPREFIX']}usermeta` 
				(`user_id`, `meta_key`, `meta_value`) VALUES ('{$newuser_insert_id}', '{$GLOBALS['FW_TABLEPREFIX']}capabilities', '{$newuser_security}')");

		$newuser_test3 = @mysqli_query($dbh, "INSERT INTO `{$GLOBALS['FW_TABLEPREFIX']}usermeta` 
				(`user_id`, `meta_key`, `meta_value`) VALUES ('{$newuser_insert_id}', '{$GLOBALS['FW_TABLEPREFIX']}user_level', '10')");
				
		//Misc Meta-Data Settings:
		@mysqli_query($dbh, "INSERT INTO `{$GLOBALS['FW_TABLEPREFIX']}usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('{$newuser_insert_id}', 'rich_editing', 'true')");
		@mysqli_query($dbh, "INSERT INTO `{$GLOBALS['FW_TABLEPREFIX']}usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('{$newuser_insert_id}', 'admin_color',  'fresh')");
		@mysqli_query($dbh, "INSERT INTO `{$GLOBALS['FW_TABLEPREFIX']}usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('{$newuser_insert_id}', 'nickname', '{$_POST['wp_user']}')");

		if ($newuser_test1 && $newuser_test2 && $newuser_test3) {
			DUPX_Log::info("NEW WP-ADMIN USER: New username '{$_POST['wp_user']}' was created successfully \n ");
		} else {
			$newuser_warnmsg = "NEW WP-ADMIN USER: Failed to create the user '{$_POST['wp_user']}' \n ";
			$JSON['step3']['warnlist'][] = $newuser_warnmsg;
			DUPX_Log::info($newuser_warnmsg);
		}			
	} 
	else {
		$newuser_warnmsg = "NEW WP-ADMIN USER: Username '{$_POST['wp_user']}' already exists in the database.  Unable to create new account \n";
		DUPX_Log::info($newuser_warnmsg);
	}
}

/* MU Updates */
$mu_newDomain = parse_url($_POST['url_new']);
$mu_oldDomain = parse_url($_POST['url_old']);
$mu_newDomainHost = $mu_newDomain['host'];
$mu_oldDomainHost = $mu_oldDomain['host'];
$mu_newUrlPath = parse_url($_POST['url_new'], PHP_URL_PATH);
$mu_oldUrlPath = parse_url($_POST['url_old'], PHP_URL_PATH);

/* Force a path for PATH_CURRENT_SITE */
$mu_newUrlPath = (empty($mu_newUrlPath) || ($mu_newUrlPath == '/')) ? '/'  : rtrim($mu_newUrlPath, '/') . '/';
$mu_oldUrlPath = (empty($mu_oldUrlPath) || ($mu_oldUrlPath == '/')) ? '/'  : rtrim($mu_oldUrlPath, '/') . '/';

$mu_updates = @mysqli_query($dbh, "UPDATE `{$GLOBALS['FW_TABLEPREFIX']}blogs` SET domain = '{$mu_newDomainHost}' WHERE domain = '{$mu_oldDomainHost}'");
if ($mu_updates) {
	DUPX_Log::info("Update MU table blogs: domain {$mu_newDomainHost} ");
	DUPX_Log::info("UPDATE `{$GLOBALS['FW_TABLEPREFIX']}blogs` SET domain = '{$mu_newDomainHost}' WHERE domain = '{$mu_oldDomainHost}'");
} 

/* NOTICES TESTS */
DUPX_Log::info("\n====================================");
DUPX_Log::info("NOTICES");
DUPX_Log::info("====================================\n");
$config_vars = array('WPCACHEHOME', 'COOKIE_DOMAIN', 'WP_SITEURL', 'WP_HOME', 'WP_TEMP_DIR');
$config_found = DUPX_U::getListValues($config_vars, $config_file);

/* Config File: */
if (! empty($config_found)) {
	$msg  = "NOTICE: The wp-config.php has the following values set [" . implode(", ", $config_found) . "]. \n";
	$msg .= 'Please validate these values are correct in your wp-config.php file.  See the codex link for more details: https://codex.wordpress.org/Editing_wp-config.php';
	DUPX_Log::info($msg);
}

/* Database: */
$result = @mysqli_query($dbh, "SELECT option_value FROM `{$GLOBALS['FW_TABLEPREFIX']}options` WHERE option_name IN ('upload_url_path','upload_path')");
if ($result) {
	while ($row = mysqli_fetch_row($result)) {
		if (strlen($row[0])) {
			$msg  = "NOTICE: The media settings values in the table '{$GLOBALS['FW_TABLEPREFIX']}options' has at least one the following values ['upload_url_path','upload_path'] set. \n";
			$msg .= "Please validate these settings by logging into your wp-admin and going to Settings->Media area and validating the 'Uploading Files' section";
			DUPX_Log::info($msg);
			break;
		}
	}
}

mysqli_close($dbh);

$ajax2_end = DUPX_U::getMicrotime();
$ajax2_sum = DUPX_U::elapsedTime($ajax2_end, $ajax2_start);
DUPX_Log::info("\nSTEP 3 COMPLETE @ " . @date('h:i:s') . " - RUNTIME: {$ajax2_sum}\n\n");

//wp_redirect();

/* Result Window */
?>

<div class="row"  style="width: 50%;margin-left: 25%;margin-top: 5%;">
    <h1>The Shop has been successfully created!</h1>
    <form method="post" action="<?php echo $_POST['siteurl']?>/wp-login.php">
        <button type="submit" class="btn btn-success btn-lg">View Shop</button>
    </form>
</div>