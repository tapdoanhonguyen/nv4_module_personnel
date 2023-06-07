<?php

/**
 * @Project NUKEVIET 4.x
 * @Author DANGDINHTU (dlinhvan@gmail.com)
 * @Copyright (C) 2016 Nuke.vn. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Mon, 11 Jul 2016 09:00:15 GMT
 */

if( ! defined( 'NV_IS_MOD_PERSONNEL' ) ) die( 'Stop!!!' );

$json = array();

/* kiem tra dang nhap thanh vien */
if( ! defined( 'NV_IS_USER' ) )
{
	nv_jsonOutput( array( 'error' => $lang_module['uploadErrorLogin'] ) );
}

// Khong cho phep cache
header( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' );
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
header( 'Cache-Control: no-store, no-cache, must-revalidate' );
header( 'Cache-Control: post-check=0, pre-check=0', false );
header( 'Pragma: no-cache' );

// Cross domain
header( 'Access-Control-Allow-Origin: *' );

// Kiem tra phien lam viec
$token = $nv_Request->get_title( 'token', 'post', '' );
$chunk = $nv_Request->get_int( 'chunk', 'post', 0 );
$chunks = $nv_Request->get_int( 'chunks', 'post', 0 );
$cleanupTargetDir = true; // Remove old files

if( $token != md5( $nv_Request->session_id . $global_config['sitekey'] ) )
{
	nv_jsonOutput( array( 'error' => $lang_module['uploadErrorSess'] ) );
}

// Tang thoi luong phien lam viec
if( $sys_info['allowed_set_time_limit'] )
{
	set_time_limit( 5 * 3600 );
}

$result = $db->query( "SHOW TABLE STATUS WHERE Name='" . $db_config['prefix'] . "_attachment'" );
$item = $result->fetch();
$result->closeCursor();

$max_data_id = $item['auto_increment'];

$folder = floor( $max_data_id / 1000 );

if( ! file_exists( NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/attachment/' . $folder ) )
{
	nv_mkdir( NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/attachment', $folder );
}

$fileName = $_FILES['Filedata']['name'];

$fileExt = nv_getextension( $fileName );

$fileOldName = nv_string_to_filename( $fileName );

$fileTemp = NV_ROOTDIR . '/' . NV_TEMP_DIR;

$fileTempName = getRandomString( 15 );

$filePath = $fileTemp . '/' . $fileTempName . '.' . $fileExt;

$file_size = $_FILES['Filedata']['size'];

// Open temp file
if( ! $out = @fopen( "{$fileTemp}.part", $chunks ? 'ab' : 'wb' ) )
{
	nv_jsonOutput( array( 'error' => 'Failed to open output stream.' ) );
}

if( ! empty( $_FILES ) )
{
	if( $_FILES['Filedata']['error'] || ! is_uploaded_file( $_FILES['Filedata']['tmp_name'] ) )
	{
		nv_jsonOutput( array( 'error' => 'Failed to move uploaded file.' ) );
	}

	// Read binary input stream and append it to temp file
	if( ! $in = @fopen( $_FILES['Filedata']['tmp_name'], 'rb' ) )
	{
		nv_jsonOutput( array( 'error' => 'Failed to open input stream.' ) );
	}
}
else
{
	if( ! $in = @fopen( 'php://input', 'rb' ) )
	{
		nv_jsonOutput( array( 'error' => 'Failed to open input stream.' ) );
	}
}

while( $buff = fread( $in, 4096 ) )
{
	fwrite( $out, $buff );
}

@fclose( $out );
@fclose( $in );

clearstatcache();

// Check if file has been uploaded
if( ! $chunks || $chunk == $chunks - 1 )
{
	// Strip the temp .part suffix off
	$check = @rename( "{$fileTemp}.part", $filePath );

	if( empty( $check ) )
	{
		nv_jsonOutput( array( 'error' => $lang_module['uploadErrorRenameFile'] ) );

	}
}

$path_file = NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/attachment/' . $folder;

$mime = nv_get_mime_type( $filePath );

$file_hash = md5_file( $filePath );

$fileName = $max_data_id . '-' . $file_hash . '.data';

$upload_filetype = array(
	'jpg',
	'jpeg',
	'png',
	'gif',
	'pdf',
	'zip',
	'rar',
	'doc',
	'docx',
	'xls',
	'xlsx' );

if( in_array( $fileExt, $upload_filetype ) )
{

	if( rename( $filePath, $path_file . '/' . $fileName ) )
	{
		@chmod( $path_file . '/' . $fileName, 0644 );

		$db->query( 'INSERT INTO ' . $db_config['prefix'] . '_attachment SET 
				userid=' . intval( $user_info['userid'] ) . ',
				addtime=' . NV_CURRENTTIME . ', 
				in_mod=' . $db->quote( $module_name ) . ',
				basename=' . $db->quote( $fileOldName ) . ',
				newname=' . $db->quote( $fileName ) . ',
				ext=' . $db->quote( $fileExt ) . ',
				mime=' . $db->quote( $mime ) . ',
				size=' . $db->quote( $file_size ) );

		$attachment_id = $db->lastInsertId();

		if( $attachment_id > 0 )
		{

			nv_jsonOutput( array( 'data' => array(
					'attachment_id' => $attachment_id,
					'userid' => $user_info['userid'],
					'basename' => $fileOldName,
					'ext' => $fileExt,
					'mime' => $mime,
					'filesize' => nv_convertfromBytes( $file_size ),
					'token' => md5( $nv_Request->session_id . $global_config['sitekey'] . $attachment_id ),

					) ) );

		}
		else
		{
			nv_jsonOutput( array( 'error' => $lang_module['uploadErrorInsert'] ) );
		}

	}
	else
	{

		unlink( $filePath );

		nv_jsonOutput( array( 'error' => $lang_module['uploadErrorRenameFile'] ) );

	}

}
else
{
	nv_jsonOutput( array( 'error' => $lang_module['uploadErrorAllow'] ) );
}
