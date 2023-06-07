<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 2-9-2010 14:43
 */

if( ! defined( 'NV_IS_FILE_ADMIN' ) )
{
	die( 'Stop!!!' );
}

$dataContent['class_id'] = $nv_Request->get_int( 'id', 'get,post', 0 );
if( $dataContent['class_id'] > 0 )
{
	$dataContent = $db_slave->query( 'SELECT * FROM ' . TABLE_PERSONNEL_NAME . '_class WHERE class_id=' . $dataContent['class_id'] )->fetch();
 
	if( ! empty( $dataContent ) )
	{	
		Header( 'Location: ' . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $dataContent['alias'] . $global_config['rewrite_exturl'], true ) );
		die();
	}
}
 