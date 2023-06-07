<?php

/**
 * @Project NUKEVIET 4.x
 * @Author DANGDINHTU (dlinhvan@gmail.com)
 * @Copyright (C) 2016 Nuke.vn. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Mon, 11 Jul 2016 09:00:15 GMT
 */

if( ! defined( 'NV_IS_MOD_PERSONNEL' ) ) die( 'Stop!!!' );

$page_title = $module_info['custom_title'];
$key_words = $module_info['keywords'];
$json = array();

if( ACTION_METHOD == 'export' )
{
	$attachment_id = $nv_Request->get_int( 'attachment_id', 'post', 0 );
	$token = $nv_Request->get_title( 'token', 'post', '' );
	if( $token == md5( $nv_Request->session_id . $global_config['sitekey'] . $attachment_id ) )
	{
		$json['success'] = true;
	}
	else
	{
		$json['error']= 'Bạn không có quyền truy cập tệp tin này';
	}
	nv_jsonOutput( $json );
}
elseif( ACTION_METHOD == 'download' )
{
	$attachment_id = $nv_Request->get_int( 'attachment_id', 'get,post', 0 );
	$token = $nv_Request->get_title( 'token', 'get,post', '' );
	if( $token == md5( $nv_Request->session_id . $global_config['sitekey'] . $attachment_id ) )
	{
		$info = $_SESSION[$module_data . '_attachment' . $attachment_id];

		$folder = floor( $attachment_id / 1000 );

		ignore_user_abort( true );

		$file = NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/attachment/' . $folder . '/' . $info['newname'];

		if( is_file( $file ) )
		{

			header( 'Content-Description: File Transfer' );
			header( 'Content-Type: ' . $info['mime'] . '' );
			header( 'Content-Disposition: attachment; filename=' . $info['basename'] );
			header( 'Content-Transfer-Encoding: binary' );
			header( 'Expires: 0' );
			header( 'Cache-Control: must-revalidate' );
			header( 'Pragma: public' );
			header( 'Content-Length: ' . $info['size'] );
			flush();
			set_time_limit( 0 );
			@readfile( $file ) or die( 'File not found.' );
		}
		else
		{
			die( 'Tệp tin cần tải không tồn tại' );
		}
	}
	else
	{
		die( 'Bạn không có quyền truy cập tệp tin này' );
	}
}
