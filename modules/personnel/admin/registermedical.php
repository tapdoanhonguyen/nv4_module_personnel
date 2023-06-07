<?php

/**
 * @Project NUKEVIET 4.x
 * @Author DANGDINHTU (dlinhvan@gmail.com)
 * @Copyright (C) 2013 Webdep24.com. All rights reserved
 * @Blog  http://dangdinhtu.com
 * @License GNU/GPL version 2 or any later version
 * @Createdate  Wed, 21 Jan 2015 14:00:59 GMT
 */

if( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

$page_title = $lang_module['registermedical'];

function registermedical_fix_weight()
{
	global $db;
	$sql = 'SELECT registermedical_id FROM ' . TABLE_PERSONNEL_NAME . '_registermedical ORDER BY weight ASC';
	$result = $db->query( $sql );
	$weight = 0;
	while( $row = $result->fetch() )
	{
		++$weight;
		$db->query( 'UPDATE ' . TABLE_PERSONNEL_NAME . '_registermedical SET weight=' . $weight . ' WHERE registermedical_id=' . $row['registermedical_id'] );
	}
	$result->closeCursor();
}

if( ACTION_METHOD == 'delete' )
{
	$json = array();

	$registermedical_id = $nv_Request->get_int( 'registermedical_id', 'post', 0 );

	$token = $nv_Request->get_title( 'token', 'post', '', 1 );

	$listid = $nv_Request->get_string( 'listid', 'post', '' );

	if( $listid != '' and md5( $nv_Request->session_id . $global_config['sitekey'] ) == $token )
	{
		$del_array = array_map( 'intval', explode( ',', $listid ) );
	}
	elseif( $token == md5( $nv_Request->session_id . $global_config['sitekey'] . $registermedical_id ) )
	{
		$del_array = array( $registermedical_id );
	}

	if( ! empty( $del_array ) )
	{

		$_del_array = array();

		$a = 0;
		foreach( $del_array as $registermedical_id )
		{

			$db->query( 'DELETE FROM ' . TABLE_PERSONNEL_NAME . '_registermedical WHERE registermedical_id = ' . ( int )$registermedical_id );

				$json['id'][$a] = $registermedical_id;

				$_del_array[] = $registermedical_id;

				++$a;
		}

		$count = sizeof( $_del_array );

		if( $count )
		{
			registermedical_fix_weight();

			nv_insert_logs( NV_LANG_DATA, $module_name, 'log_del_registermedical', implode( ', ', $_del_array ), $admin_info['userid'] );

			$nv_Cache->delMod($module_name);

			$json['success'] = $lang_module['registermedical_delete_success'];
		}

	}
	else
	{
		$json['error'] = $lang_module['registermedical_error_security'];
	}

	nv_jsonOutput( $json );
}
elseif( ACTION_METHOD == 'status' )
{
	$json = array();

	$registermedical_id = $nv_Request->get_int( 'registermedical_id', 'post', 0 );
	$new_vid = $nv_Request->get_int( 'new_vid', 'post', 0 );
	$token = $nv_Request->get_title( 'token', 'post', '', 1 );

	if( $token == md5( $nv_Request->session_id . $global_config['sitekey'] . $registermedical_id ) )
	{
		$sql = 'UPDATE ' . TABLE_PERSONNEL_NAME . '_registermedical SET status=' . $new_vid . ' WHERE registermedical_id=' . $registermedical_id;
		if( $db->exec( $sql ) )
		{
			nv_insert_logs( NV_LANG_DATA, $module_name, 'log_change_status_registermedical', 'registermedical_id:' . $registermedical_id, $admin_info['userid'] );

			$nv_Cache->delMod($module_name);

			$json['success'] = $lang_module['registermedical_status_success'];

		}
		else
		{
			$json['error'] = $lang_module['registermedical_error_status'];

		}
	}
	else
	{
		$json['error'] = $lang_module['registermedical_error_security'];
	}

	nv_jsonOutput( $json );
}
elseif( ACTION_METHOD == 'weight' )
{
	$json = array();

	$registermedical_id = $nv_Request->get_int( 'registermedical_id', 'post', 0 );
	$new_vid = $nv_Request->get_int( 'new_vid', 'post', 0 );
	$token = $nv_Request->get_title( 'token', 'post', '', 1 );

	if( $token == md5( $nv_Request->session_id . $global_config['sitekey'] . $registermedical_id ) )
	{
		$sql = 'SELECT registermedical_id FROM ' . TABLE_PERSONNEL_NAME . '_registermedical WHERE registermedical_id!=' . $registermedical_id . ' ORDER BY weight ASC';
		$result = $db->query( $sql );

		$weight = 0;
		while( $row = $result->fetch() )
		{
			++$weight;
			if( $weight == $new_vid ) ++$weight;
			$sql = 'UPDATE ' . TABLE_PERSONNEL_NAME . '_registermedical SET weight=' . $weight . ' WHERE registermedical_id=' . intval( $row['registermedical_id'] );
			$db->query( $sql );
		}

		$sql = 'UPDATE ' . TABLE_PERSONNEL_NAME . '_registermedical SET weight=' . $new_vid . ' WHERE registermedical_id=' . $registermedical_id;
		if( $db->exec( $sql ) )
		{
			nv_insert_logs( NV_LANG_DATA, $module_name, 'log_change_weight_registermedical', 'registermedical_id:' . $registermedical_id, $admin_info['userid'] );

			$nv_Cache->delMod($module_name);

			$json['success'] = $lang_module['registermedical_weight_success'];
			$json['link'] = NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op;

		}
		else
		{
			$json['error'] = $lang_module['registermedical_error_weight'];

		}
	}
	else
	{
		$json['error'] = $lang_module['registermedical_error_security'];
	}

	nv_jsonOutput( $json );
}
elseif( ACTION_METHOD == 'add' || ACTION_METHOD == 'edit' )
{

	$data = array(
		'registermedical_id' => 0,
		'title' => '',
		'province_id' => 0,
		'weight' => '',
		'status' => 1,
		'date_added' => NV_CURRENTTIME );

	$error = array();

	$data['registermedical_id'] = $nv_Request->get_int( 'registermedical_id', 'get,post', 0 );
	if( $data['registermedical_id'] > 0 )
	{
		$data = $db->query( 'SELECT *
		FROM ' . TABLE_PERSONNEL_NAME . '_registermedical  
		WHERE registermedical_id=' . $data['registermedical_id'] )->fetch();

		$caption = $lang_module['registermedical_edit'];
	}
	else
	{
		$caption = $lang_module['registermedical_add'];
	}

	if( $nv_Request->get_int( 'save', 'post' ) == 1 )
	{

		$data['registermedical_id'] = $nv_Request->get_int( 'registermedical_id', 'post', 0 );
		$data['title'] = nv_substr( $nv_Request->get_title( 'title', 'post', '', '' ), 0, 250 );
 		$data['province_id'] = $nv_Request->get_int( 'province_id', 'post', 0 );
 		$data['status'] = $nv_Request->get_int( 'status', 'post', 0 );

		if( empty( $data['title'] ) )
		{
			$error['title'] = $lang_module['registermedical_error_title'];
		}

		if( ! empty( $error ) && ! isset( $error['warning'] ) )
		{
			$error['warning'] = $lang_module['registermedical_error_warning'];
		}

		if( empty( $error ) )
		{
			
			$image = NV_DOCUMENT_ROOT . $data['image'];
			if( !nv_is_url( $data['image'] ) and is_file( $image ) )
			{
				$lu = strlen( NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' );
				$data['image'] = substr( $data['image'], $lu );
			}
			
			if( $data['registermedical_id'] == 0 )
			{
				try
				{
					$stmt = $db->prepare( 'SELECT MAX(weight) FROM ' . TABLE_PERSONNEL_NAME . '_registermedical' );
					$stmt->execute();
					$weight = $stmt->fetchColumn();

					$weight = intval( $weight ) + 1;

					$stmt = $db->prepare( 'INSERT INTO ' . TABLE_PERSONNEL_NAME . '_registermedical SET 
						weight = ' . intval( $weight ) . ', 
						status=' . intval( $data['status'] ) . ', 
						date_added=' . intval( $data['date_added'] ) . ',  
						province_id=' . intval( $data['province_id'] ) . ',  
						title =:title' );

					$stmt->bindParam( ':title', $data['title'], PDO::PARAM_STR );
 					$stmt->execute();

					if( $data['registermedical_id'] = $db->lastInsertId() )
					{
						nv_insert_logs( NV_LANG_DATA, $module_name,$lang_module['registermedical_add'], 'registermedical_id: ' . $data['registermedical_id'], $admin_info['userid'] );
						
						$nv_Request->set_Session( $module_data . '_success', $lang_module['registermedical_insert_success'] );
					}
					else
					{
						$error['warning'] = $lang_module['registermedical_error_save'];

					}
					$stmt->closeCursor();

				}
				catch ( PDOException $e )
				{
					$error['warning'] = $lang_module['registermedical_error_save'];
					var_dump($e);die();
				}

			}
			else
			{
				try
				{

					$stmt = $db->prepare( 'UPDATE ' . TABLE_PERSONNEL_NAME . '_registermedical SET 
						status=' . intval( $data['status'] ) . ',
						province_id=' . intval( $data['province_id'] ) . ',
						title =:title
						WHERE registermedical_id=' . $data['registermedical_id'] );

					$stmt->bindParam( ':title', $data['title'], PDO::PARAM_STR );
					$stmt->bindParam( ':image', $data['image'], PDO::PARAM_STR );
					if( $stmt->execute() )
					{
						nv_insert_logs( NV_LANG_DATA, $module_name, $lang_module['registermedical_edit'], 'registermedical_id: ' . $data['registermedical_id'], $admin_info['userid'] );
						$nv_Request->set_Session( $module_data . '_success', $lang_module['registermedical_update_success'] );
					}
					else
					{
						$error['warning'] = $lang_module['registermedical_error_save'];

					}

					$stmt->closeCursor();

				}
				catch ( PDOException $e )
				{
					$error['warning'] = $lang_module['registermedical_error_save'];
					//var_dump($e);
				}

			}

		}
		if( empty( $error ) )
		{
			$nv_Cache->delMod($module_name); 

			Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
			die();
		}

	}
 
	$xtpl = new XTemplate( 'registermedical_add.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'GLANG', $lang_global );
	$xtpl->assign( 'NV_LANG_VARIABLE', NV_LANG_VARIABLE );
	$xtpl->assign( 'NV_LANG_DATA', NV_LANG_DATA );
	$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
	$xtpl->assign( 'THEME', $global_config['site_theme'] );
	$xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
	$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
	$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
	$xtpl->assign( 'MODULE_FILE', $module_file );
	$xtpl->assign( 'MODULE_NAME', $module_name );
	$xtpl->assign( 'OP', $op );
	$xtpl->assign( 'CAPTION', $caption );
	$xtpl->assign( 'DATA', $data );
	$xtpl->assign( 'CURRENT', NV_UPLOADS_DIR . '/' . $module_upload );
	$xtpl->assign( 'CANCEL', NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=" . $op );

	if( isset( $error['warning'] ) )
	{
		$xtpl->assign( 'error_warning', $error['warning'] );
		$xtpl->parse( 'main.error_warning' );
	}

	if( isset( $error['title'] ) )
	{
		$xtpl->assign( 'error_title', $error['title'] );
		$xtpl->parse( 'main.error_title' );
	}
	
	$getProvince = getProvince();
	if( $getProvince )
	{
		foreach( $getProvince as $key => $name )
		{
			$xtpl->assign( 'PROVINCE', array(
				'key' => $key,
				'name' => $name['title'],
				'selected' => ( $key == $data['province_id'] ) ? 'selected="selected"' : '' ) );
			$xtpl->parse( 'main.province' );
		}
	}
	
	foreach( $array_status as $key => $name )
	{
		$xtpl->assign( 'STATUS', array(
			'key' => $key,
			'name' => $name,
			'selected' => ( $key == $data['status'] ) ? 'selected="selected"' : '' ) );
		$xtpl->parse( 'main.status' );
	}

	$xtpl->parse( 'main' );
	$contents = $xtpl->text( 'main' );

	include NV_ROOTDIR . '/includes/header.php';
	echo nv_admin_theme( $contents );
	include NV_ROOTDIR . '/includes/footer.php';
}

/*show list registermedical*/

$per_page = 50;

$page = $nv_Request->get_int( 'page', 'get', 1 );

$sql = TABLE_PERSONNEL_NAME . '_registermedical';

$sort = $nv_Request->get_string( 'sort', 'get', '' );

$order = $nv_Request->get_string( 'order', 'get' ) == 'desc' ? 'desc' : 'asc';

$sort_data = array(
	'title',
	'status',
	'weight' );

if( isset( $sort ) && in_array( $sort, $sort_data ) )
{

	$sql .= ' ORDER BY ' . $sort;
}
else
{
	$sql .= ' ORDER BY weight';
}

if( isset( $order ) && ( $order == 'desc' ) )
{
	$sql .= ' DESC';
}
else
{
	$sql .= ' ASC';
}

$num_items = $db->query( 'SELECT COUNT(*) FROM ' . $sql )->fetchColumn();

$base_url = NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=registermedical&amp;sort=' . $sort . '&amp;order=' . $order . '&amp;per_page=' . $per_page;

$db->sqlreset()->select( '*' )->from( $sql )->limit( $per_page )->offset( ( $page - 1 ) * $per_page );

$result = $db->query( $db->sql() );

$array = array();
while( $rows = $result->fetch() )
{
	$array[] = $rows;
}

$xtpl = new XTemplate( 'registermedical.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'NV_LANG_VARIABLE', NV_LANG_VARIABLE );
$xtpl->assign( 'NV_LANG_DATA', NV_LANG_DATA );
$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
$xtpl->assign( 'THEME', $global_config['site_theme'] );
$xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
$xtpl->assign( 'MODULE_FILE', $module_file );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'TOKEN', md5( $nv_Request->session_id . $global_config['sitekey'] ) );
$xtpl->assign( 'ADD_NEW', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=registermedical&action=add' );

$order2 = ( $order == 'asc' ) ? 'desc' : 'asc';

$xtpl->assign( 'URL_SERVICE_NAME', NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;sort=title&amp;order=' . $order2 . '&amp;per_page=' . $per_page );
$xtpl->assign( 'URL_NGAYKHAIGIANG', NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;sort=ghichu&amp;order=' . $order2 . '&amp;per_page=' . $per_page );
$xtpl->assign( 'URL_WEIGHT', NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;sort=weight&amp;order=' . $order2 . '&amp;per_page=' . $per_page );
$xtpl->assign( 'URL_STATUS', NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;sort=status&amp;order=' . $order2 . '&amp;per_page=' . $per_page );

$xtpl->assign( 'SERVICE_NAME_ORDER', ( $sort == 'title' ) ? 'class="' . $order2 . '"' : '' );
$xtpl->assign( 'WEIGHT_ORDER', ( $sort == 'weight' ) ? 'class="' . $order2 . '"' : '' );
$xtpl->assign( 'STATUS_ORDER', ( $sort == 'status' ) ? 'class="' . $order2 . '"' : '' );

if( $nv_Request->get_string( $module_data . '_success', 'session' ) )
{
	$xtpl->assign( 'SUCCESS', $nv_Request->get_string( $module_data . '_success', 'session' ) );
	$xtpl->parse( 'main.success' );
	$nv_Request->unset_request( $module_data . '_success', 'session' );
}

$getProvince = getProvince();



if( ! empty( $array ) )
{
	
	foreach( $array as $item )
	{
		$item['province'] = isset( $getProvince[$item['province_id']] ) ? $getProvince[$item['province_id']]['title'] : ''; 
		
		$item['token'] = md5( $nv_Request->session_id . $global_config['sitekey'] . $item['registermedical_id'] );
		$item['edit'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op . '&action=edit&token=' . $item['token'] . '&registermedical_id=' . $item['registermedical_id'];
		$item['link_province'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '='. $op .'&province_id=' . $item['province_id'] . '&token=' . $item['token'];
 		$xtpl->assign( 'LOOP', $item );

		for( $i = 1; $i <= $num_items; ++$i )
		{
			$xtpl->assign( 'WEIGHT', array(
				'key' => $i,
				'name' => $i,
				'selected' => ( $i == $item['weight'] ) ? ' selected="selected"' : '' ) );

			$xtpl->parse( 'main.loop.weight' );
		}
		foreach( $array_status as $key => $val )
		{
			$xtpl->assign( 'STATUS', array(
				'key' => $key,
				'name' => $val,
				'selected' => $key == $item['status'] ? ' selected="selected"' : '' ) );
			$xtpl->parse( 'main.loop.status' );
		}
		$xtpl->parse( 'main.loop' );
	}

}

$generate_page = nv_generate_page( $base_url, $num_items, $per_page, $page );
if( ! empty( $generate_page ) )
{
	$xtpl->assign( 'GENERATE_PAGE', $generate_page );
	$xtpl->parse( 'main.generate_page' );
}

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';
