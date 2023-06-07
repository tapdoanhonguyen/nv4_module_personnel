<?php

/**
 * @Project NUKEVIET 4.x
 * @Author DANGDINHTU (dlinhvan@gmail.com)
 * @Copyright (C) 2016 Nuke.vn. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Mon, 11 Jul 2016 09:00:15 GMT
 */

if ( ! defined( 'NV_IS_MOD_PERSONNEL' ) ) die( 'Stop!!!' );


$contents = '';
 
if( !empty( $dataContent ) )
{
	if(! nv_is_url ( $dataContent['image'] ))
	{
		// image file
		$dataContent['image'] =  NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $dataContent['image'];
	}
	else
	{
		// image url
		$dataContent['image'] = $dataContent['image'];
	}
	
	
	$teacherList = $db->query('SELECT teacher_id, full_name, birthday, photo, experience FROM ' . TABLE_PERSONNEL_NAME . '_teacher WHERE teacher_id=' . intval( $dataContent['teacher_id'] ) )->fetch();
	$dataContent['teacher_photo'] = NV_BASE_SITEURL . NV_UPLOADS_DIR  . '/' . $module_upload . '/' . $teacherList['photo'];
	$dataContent['teacher_name'] = $teacherList['full_name'];
	$dataContent['teacher_year'] = $teacherList['birthday'];
	$dataContent['teacher_experience'] = $teacherList['experience'];
 
	
	// comment
	if( isset( $site_mods['comment'] ) and isset( $module_config[$module_name]['activecomm'] ) )
	{
		define( 'NV_COMM_ID', $dataContent['class_id'] );
		define( 'NV_COMM_AREA', $module_info['funcs'][$op]['func_id'] ); 
		// check allow comemnt
		$allowed = $module_config[$module_name]['allowed_comm'];
		
		// if( $allowed == '-1' )
		// {
			// $allowed = $getSetting['active_comment'];
		// }
		require_once NV_ROOTDIR . '/modules/comment/comment.php';
		$area = ( defined( 'NV_COMM_AREA' ) ) ? NV_COMM_AREA : 0;
		$checkss = md5( $module_name . '-' . $area . '-' . NV_COMM_ID . '-' . $allowed . '-' . NV_CACHE_PREFIX );

		$dataComment = nv_comment_module( $module_name, $checkss, $area, NV_COMM_ID, $allowed, 1 );
	}
	else
	{
		$dataComment = '';
	}
 
	$getTypes = getTypes(); 

	$contents = ThemeViewClassDetail( $dataContent, $dataComment );
}
else
{
	Header( 'Location: ' . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name, true ) );
	die();
}

$page_title = $dataContent['class_name'];
$key_words = '';
$description = nv_clean60( strip_tags( $dataContent['description'] ), 160 );
 
include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';
