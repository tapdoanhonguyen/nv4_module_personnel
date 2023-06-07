<?php

 

if( ! defined( 'NV_IS_FILE_SITEINFO' ) )
{
	die( 'Stop!!!' );
}

$lang_siteinfo = nv_get_lang_module( $mod );

 
$data['title'] = sprintf( $lang_siteinfo['notification_user_new'], $data['content']['full_name'],$data['content']['class_name'] );
$data['link'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $data['module'] . '&amp;' . NV_OP_VARIABLE . '=item&amp;action=edit&amp;item_id=' . $data['obid'];
