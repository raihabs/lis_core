<?php 

$envi = 'DEV';
$before_memory = 0;
//default settings values
$config['filesize_limit'] = 20971520;//50000000;//20MB FILE UPLOAD LIMIT
$close_conn = true;

define("DOMAIN_PATH", dirname(__DIR__));
define('FILE_VERSION', '1.1.3');
define('PAGE_TITLE', 'lis_core');

$url =  base_url();
define("BASE_URL",$url);

define('QUERY_LIMIT', 10);

//function PATH
define('FOLDER', 'C:\xampp\htdocs\lis');
define('CL_SESSION_PATH' , DOMAIN_PATH .'/call_func/cl_session.php');
define('ADMIN_FOOTER_PATH' , DOMAIN_PATH.'/include/admin_footer.php');
define('ADMIN_TOP_PATH' , DOMAIN_PATH.'/include/admin_top.php');
define('ADMIN_BOTTOM_PATH' , DOMAIN_PATH.'/include/admin_bottom_login.php');
define('CONNECT_PATH' , DOMAIN_PATH.'/call_func/connect.php');
define('GLOBAL_FUNC' , DOMAIN_PATH.'/call_func/global_func.php');
define('USER_TOP_PATH' , DOMAIN_PATH.'/include/user_top.php');
define('USER_HEADER_PATH' , DOMAIN_PATH.'/call_func/user_header.php');
define('USER_FOOTER_PATH' , DOMAIN_PATH.'/include/user_footer.php');
define('USER_MEMO_PATH' , DOMAIN_PATH.'/include/user_memo.php');
define('USER_MEMORANDUM_PATH' , DOMAIN_PATH.'/include/user_memorandum.php');
define('ERROR_404',DOMAIN_PATH.'/error_page/404.php');


// C:\xampp\htdocs\scheduling_system\assets\images\favicon.png

//global var
define('DEFAULT_SESSION', 'web_session');
define('SESSION_CONFIG', array('name' => DEFAULT_SESSION,'path' => '/','domain' => '','secure' => false,'bits' => 4,'length' => 32,'hash' => 'sha256','decoy' => true,'min' => 60,'max' => 600,'debug' => false));

function base_url(){   
    // first get http protocol if http or https
        $base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']!='off') ? 'https://' : 'http://';
        #$base_url .= "192.168.0.100/final_lms_prod/"; #change to localhost or domain
        //$base_url .= "192.168.0.6/final_lms_prod/"; #change to localhost or domain
        $base_url .= "localhost/lis_core/"; #change to localhost or domain
        return $base_url; 
    
    }