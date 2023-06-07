<?php

/**
 * @Project NUKEVIET 4.x
 * @Author DANGDINHTU (dlinhvan@gmail.com)
 * @Copyright (C) 2013 Webdep24.com. All rights reserved
 * @Blog  http://dangdinhtu.com
 * @License GNU/GPL version 2 or any later version
 * @Createdate  Wed, 21 Jan 2015 14:00:59 GMT
 */

if( ! defined( 'NV_ADMIN' ) or ! defined( 'NV_MAINFILE' ) or ! defined( 'NV_IS_MODADMIN' ) ) die( 'Stop!!!' );
 

define( 'NV_IS_FILE_ADMIN', true );

define( 'TABLE_PERSONNEL_NAME', NV_PREFIXLANG . '_' . $module_data ); 
define( 'TABLE_LOCATION_NAME', $db_config['prefix'] . '_location' );

define( 'ACTION_METHOD', $nv_Request->get_string( 'action', 'get,post', '' ) ); 
 
require_once NV_ROOTDIR . '/modules/' . $module_file . '/global.functions.php';
 
 
$array_status = array( '0' => $lang_module['disabled'], '1' => $lang_module['enable'] );
$array_inhome = array( '0' => $lang_module['disabled'], '1' => $lang_module['enable'] );
$arrayStatusItem = array( '0' => $lang_module['pending'], '1' => $lang_module['approved'] );

