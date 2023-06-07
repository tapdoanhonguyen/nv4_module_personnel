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

$page_title = $lang_module['bookstatus'];

function bookstatus_fix_weight()
{
	global $db;
	$sql = 'SELECT data_id FROM ' . TABLE_PERSONNEL_NAME . '_data WHERE group_name=\'bookstatus\' ORDER BY weight ASC';
	$result = $db->query( $sql );
	$weight = 0;
	while( $row = $result->fetch() )
	{
		++$weight;
		$db->query( 'UPDATE ' . TABLE_PERSONNEL_NAME . '_data SET weight=' . $weight . ' WHERE group_name=\'bookstatus\' AND data_id=' . $row['data_id'] );
	}
	$result->closeCursor();
}

if( ACTION_METHOD == 'delete' )
{
	$json = array();

	$data_id = $nv_Request->get_int( 'data_id', 'post', 0 );

	$token = $nv_Request->get_title( 'token', 'post', '', 1 );

	$listid = $nv_Request->get_string( 'listid', 'post', '' );

	if( $listid != '' and md5( $nv_Request->session_id . $global_config['sitekey'] ) == $token )
	{
		$del_array = array_map( 'intval', explode( ',', $listid ) );
	}
	elseif( $token == md5( $nv_Request->session_id . $global_config['sitekey'] . $data_id ) )
	{
		$del_array = array( $data_id );
	}

	if( ! empty( $del_array ) )
	{

		$_del_array = array();

		$a = 0;
		foreach( $del_array as $data_id )
		{

			$db->query( 'DELETE FROM ' . TABLE_PERSONNEL_NAME . '_data WHERE group_name=\'bookstatus\' AND data_id = ' . ( int )$data_id );

				$json['id'][$a] = $data_id;

				$_del_array[] = $data_id;

				++$a;
		}

		$count = sizeof( $_del_array );

		if( $count )
		{
			bookstatus_fix_weight();

			nv_insert_logs( NV_LANG_DATA, $module_name, 'log_del_data', implode( ', ', $_del_array ), $admin_info['userid'] );

			$nv_Cache->delMod($module_name);
			nv_deletefile ( NV_ROOTDIR . NV_BASE_SITEURL . NV_ASSETS_DIR . '/js/' . md5( $module_name ) . '.json' );
			
			$json['success'] = $lang_module['bookstatus_delete_success'];
		}

	}
	else
	{
		$json['error'] = $lang_module['bookstatus_error_security'];
	}

	nv_jsonOutput( $json );
}
elseif( ACTION_METHOD == 'status' )
{
	$json = array();

	$data_id = $nv_Request->get_int( 'data_id', 'post', 0 );
	$new_vid = $nv_Request->get_int( 'new_vid', 'post', 0 );
	$token = $nv_Request->get_title( 'token', 'post', '', 1 );

	if( $token == md5( $nv_Request->session_id . $global_config['sitekey'] . $data_id ) )
	{
		$sql = 'UPDATE ' . TABLE_PERSONNEL_NAME . '_data SET status=' . $new_vid . ' WHERE group_name=\'bookstatus\' AND data_id=' . $data_id;
		if( $db->exec( $sql ) )
		{
			nv_insert_logs( NV_LANG_DATA, $module_name, 'log_change_status_data', 'data_id:' . $data_id, $admin_info['userid'] );

			$nv_Cache->delMod($module_name);
			nv_deletefile ( NV_ROOTDIR . NV_BASE_SITEURL . NV_ASSETS_DIR . '/js/' . md5( $module_name ) . '.json' );
			
			$json['success'] = $lang_module['bookstatus_status_success'];

		}
		else
		{
			$json['error'] = $lang_module['bookstatus_error_status'];

		}
	}
	else
	{
		$json['error'] = $lang_module['bookstatus_error_security'];
	}

	nv_jsonOutput( $json );
}
elseif( ACTION_METHOD == 'weight' )
{
	$json = array();

	$data_id = $nv_Request->get_int( 'data_id', 'post', 0 );
	$new_vid = $nv_Request->get_int( 'new_vid', 'post', 0 );
	$token = $nv_Request->get_title( 'token', 'post', '', 1 );

	if( $token == md5( $nv_Request->session_id . $global_config['sitekey'] . $data_id ) )
	{
		$sql = 'SELECT data_id FROM ' . TABLE_PERSONNEL_NAME . '_data WHERE group_name=\'bookstatus\' AND data_id !=' . $data_id . ' ORDER BY weight ASC';
		$result = $db->query( $sql );

		$weight = 0;
		while( $row = $result->fetch() )
		{
			++$weight;
			if( $weight == $new_vid ) ++$weight;
			$sql = 'UPDATE ' . TABLE_PERSONNEL_NAME . '_data SET weight=' . $weight . ' WHERE group_name=\'bookstatus\' AND data_id=' . intval( $row['data_id'] );
			$db->query( $sql );
		}

		$sql = 'UPDATE ' . TABLE_PERSONNEL_NAME . '_data SET weight=' . $new_vid . ' WHERE group_name=\'bookstatus\' AND data_id=' . $data_id;
		if( $db->exec( $sql ) )
		{
			nv_insert_logs( NV_LANG_DATA, $module_name, 'log_change_weight_data', 'data_id:' . $data_id, $admin_info['userid'] );

			$nv_Cache->delMod($module_name);
			nv_deletefile ( NV_ROOTDIR . NV_BASE_SITEURL . NV_ASSETS_DIR . '/js/' . md5( $module_name ) . '.json' );
			
			$json['success'] = $lang_module['bookstatus_weight_success'];
			$json['link'] = NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op;

		}
		else
		{
			$json['error'] = $lang_module['bookstatus_error_weight'];

		}
	}
	else
	{
		$json['error'] = $lang_module['bookstatus_error_security'];
	}

	nv_jsonOutput( $json );
}
elseif( ACTION_METHOD == 'add' || ACTION_METHOD == 'edit' )
{
 
	
	$data = array(
		'data_id' => 0,
		'title' => '',
		'group_name' => 'bookstatus',
		'weight' => '',
		'status' => 1,
		'date_added' => NV_CURRENTTIME );

	$error = array();

	$data['data_id'] = $nv_Request->get_int( 'data_id', 'get,post', 0 );
	if( $data['data_id'] > 0 )
	{
		$data = $db->query( 'SELECT *
		FROM ' . TABLE_PERSONNEL_NAME . '_data  
		WHERE data_id=' . $data['data_id'] )->fetch();

		$caption = $lang_module['bookstatus_edit'];
	}
	else
	{
		$caption = $lang_module['bookstatus_add'];
	}

	if( $nv_Request->get_int( 'save', 'post' ) == 1 )
	{

		$data['data_id'] = $nv_Request->get_int( 'data_id', 'post', 0 );
		$data['title'] = nv_substr( $nv_Request->get_title( 'title', 'post', '', '' ), 0, 250 );
		$data['status'] = $nv_Request->get_int( 'status', 'post', 0 );

		if( empty( $data['title'] ) )
		{
			$error['title'] = $lang_module['bookstatus_error_title'];
		}
 

		if( ! empty( $error ) && ! isset( $error['warning'] ) )
		{
			$error['warning'] = $lang_module['bookstatus_error_warning'];
		}

		if( empty( $error ) )
		{
			 
			if( $data['data_id'] == 0 )
			{
				try
				{
					$stmt = $db->prepare( 'SELECT MAX(weight) FROM ' . TABLE_PERSONNEL_NAME . '_data WHERE group_name=' . $db->quote( $data['group_name'] ) );
					$stmt->execute();
					$weight = $stmt->fetchColumn();

					$weight = intval( $weight ) + 1;

					$stmt = $db->prepare( 'INSERT INTO ' . TABLE_PERSONNEL_NAME . '_data SET 
						weight = ' . intval( $weight ) . ', 
						status=' . intval( $data['status'] ) . ', 
						date_added=' . intval( $data['date_added'] ) . ',  
						title =:title, 
						group_name =:group_name' );

					$stmt->bindParam( ':title', $data['title'], PDO::PARAM_STR );
					$stmt->bindParam( ':group_name', $data['group_name'], PDO::PARAM_STR );
					$stmt->execute();

					if( $data['data_id'] = $db->lastInsertId() )
					{
						nv_insert_logs( NV_LANG_DATA, $module_name, $lang_module['bookstatus_add'], 'data_id: ' . $data['data_id'], $admin_info['userid'] );
						
						$nv_Request->set_Session( $module_data . '_success', $lang_module['bookstatus_insert_success'] );
					}
					else
					{
						$error['warning'] = $lang_module['bookstatus_error_save'];

					}
					$stmt->closeCursor();

				}
				catch ( PDOException $e )
				{
					$error['warning'] = $lang_module['bookstatus_error_save'];
					var_dump($e);die();
				}

			}
			else
			{
				try
				{

					$stmt = $db->prepare( 'UPDATE ' . TABLE_PERSONNEL_NAME . '_data SET 
						status=' . intval( $data['status'] ) . ',
						title =:title,
						group_name =:group_name
						WHERE data_id=' . $data['data_id'] );

					$stmt->bindParam( ':title', $data['title'], PDO::PARAM_STR );
					$stmt->bindParam( ':group_name', $data['group_name'], PDO::PARAM_STR );
					if( $stmt->execute() )
					{
						nv_insert_logs( NV_LANG_DATA, $module_name, $lang_module['bookstatus_edit'], 'data_id: ' . $data['data_id'], $admin_info['userid'] );
						$nv_Request->set_Session( $module_data . '_success', $lang_module['bookstatus_update_success'] );
					}
					else
					{
						$error['warning'] = $lang_module['bookstatus_error_save'];

					}

					$stmt->closeCursor();

				}
				catch ( PDOException $e )
				{
					$error['warning'] = $lang_module['bookstatus_error_save'];
					//var_dump($e);
				}

			}

		}
		if( empty( $error ) )
		{
			$nv_Cache->delMod($module_name); 
			nv_deletefile ( NV_ROOTDIR . NV_BASE_SITEURL . NV_ASSETS_DIR . '/js/' . md5( $module_name ) . '.json' );
			
			Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
			die();
		}

	}
 
	$xtpl = new XTemplate( 'bookstatus_add.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
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
 
	if( $error )
	{
		foreach( $error as $key => $_error )
		{
			$xtpl->assign( 'error_' . $key, $_error );
			$xtpl->parse( 'main.error_' . $key );
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

/*show list bookstatus*/

$per_page = 50;

$page = $nv_Request->get_int( 'page', 'get', 1 );

$sql = TABLE_PERSONNEL_NAME . '_data';

$implode[] = 'group_name=\'bookstatus\'';

if( $implode )
{
	$sql .= ' WHERE ' . implode( ' AND ', $implode );
}


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

$base_url = NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=bookstatus&amp;sort=' . $sort . '&amp;order=' . $order . '&amp;per_page=' . $per_page;

$db->sqlreset()->select( '*' )->from( $sql )->limit( $per_page )->offset( ( $page - 1 ) * $per_page );

$result = $db->query( $db->sql() );

$array = array();
while( $rows = $result->fetch() )
{
	$array[] = $rows;
}

$xtpl = new XTemplate( 'bookstatus.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
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
$xtpl->assign( 'ADD_NEW', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=bookstatus&action=add' );

$order2 = ( $order == 'asc' ) ? 'desc' : 'asc';

$xtpl->assign( 'URL_TITLE', NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;sort=title&amp;order=' . $order2 . '&amp;per_page=' . $per_page );
$xtpl->assign( 'URL_DATE_ADDED', NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;sort=date_added&amp;order=' . $order2 . '&amp;per_page=' . $per_page );
$xtpl->assign( 'URL_WEIGHT', NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;sort=weight&amp;order=' . $order2 . '&amp;per_page=' . $per_page );
$xtpl->assign( 'URL_STATUS', NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;sort=status&amp;order=' . $order2 . '&amp;per_page=' . $per_page );

$xtpl->assign( 'TITLE_ORDER', ( $sort == 'title' ) ? 'class="' . $order2 . '"' : '' );
$xtpl->assign( 'WEIGHT_ORDER', ( $sort == 'weight' ) ? 'class="' . $order2 . '"' : '' );
$xtpl->assign( 'STATUS_ORDER', ( $sort == 'status' ) ? 'class="' . $order2 . '"' : '' );

if( $nv_Request->get_string( $module_data . '_success', 'session' ) )
{
	$xtpl->assign( 'SUCCESS', $nv_Request->get_string( $module_data . '_success', 'session' ) );
	$xtpl->parse( 'main.success' );
	$nv_Request->unset_request( $module_data . '_success', 'session' );
}

if( ! empty( $array ) )
{
	foreach( $array as $item )
	{

		$item['token'] = md5( $nv_Request->session_id . $global_config['sitekey'] . $item['data_id'] );
		$item['edit'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op . '&action=edit&token=' . $item['token'] . '&data_id=' . $item['data_id'];
		$item['link_appointment'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=hocvien&data_id=' . $item['data_id'] . '&token=' . $item['token'];
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
