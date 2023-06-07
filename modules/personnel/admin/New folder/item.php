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

$page_title = $lang_module['item'];
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
if( ACTION_METHOD == 'getClass' )
{
	$json = array();
	
	$class_name = $nv_Request->get_string( 'class_name', 'post', '' );
 
	$implode = array();
	
	if( ! empty( $class_name ) )
	{
		$implode[] = 'class_name LIKE :class_name';
	}
	
	$sql = 'SELECT class_id, class_name FROM ' . TABLE_PERSONNEL_NAME . '_class';
	if( $implode )
	{
		$sql .= ' WHERE ' . implode( ' AND ', $implode );
	}
	$sql .= ' ORDER BY class_name ASC LIMIT 0, 30';
	
	$sth = $db->prepare( $sql );
	if( ! empty( $class_name ) )
	{
		$sth->bindValue( ':class_name', '%' . $class_name . '%' );
	}
	$sth->execute();
	while( list( $class_id, $class_name ) = $sth->fetch( 3 ) )
	{
		$json['data'][] = array( 'id' => $class_id, 'text' => nv_htmlspecialchars( $class_name ) );
	}
 
	nv_jsonOutput( $json );
}
elseif( ACTION_METHOD == 'status' )
{
	$json = array();

	$item_id = $nv_Request->get_int( 'item_id', 'post', 0 );
	$new_vid = $nv_Request->get_int( 'new_vid', 'post', 0 );
	$token = $nv_Request->get_title( 'token', 'post', '', 1 );

	if( $token == md5( $nv_Request->session_id . $global_config['sitekey'] . $item_id ) )
	{
		$sql = 'UPDATE ' . TABLE_PERSONNEL_NAME . '_item SET status=' . $new_vid . ' WHERE item_id=' . $item_id;
		if( $db->exec( $sql ) )
		{
			
			if( $new_vid == 1 )
			{	
				// GOI HAM TAO TAI KHOAN
				
				$dataContent = $db->query( 'SELECT * FROM ' . TABLE_PERSONNEL_NAME . '_item WHERE item_id=' . $item_id )->fetch();
 
				require_once NV_ROOTDIR . '/modules/' . $module_file . '/create_user.php';	
			}
		
			nv_insert_logs( NV_LANG_DATA, $module_name, 'log_change_status_item', 'item_id:' . $item_id, $admin_info['userid'] );

			$nv_Cache->delMod($module_name);
			
			
			$json['success'] = $lang_module['item_status_success'];

		}
		else
		{
			$json['error'] = $lang_module['item_error_status'];

		}
	}
	else
	{
		$json['error'] = $lang_module['class_error_security'];
	}

	nv_jsonOutput( $json );
	
}else if( ACTION_METHOD == 'delete' )
{
	$json = array();

	$item_id = $nv_Request->get_int( 'item_id', 'post', 0 );

	$token = $nv_Request->get_title( 'token', 'post', '', 1 );

	$listid = $nv_Request->get_string( 'listid', 'post', '' );

	if( $listid != '' and md5( $nv_Request->session_id . $global_config['sitekey'] ) == $token )
	{
		$del_array = array_map( 'intval', explode( ',', $listid ) );
	}
	elseif( $token == md5( $nv_Request->session_id . $global_config['sitekey'] . $item_id ) )
	{
		$del_array = array( $item_id );
	}

	if( ! empty( $del_array ) )
	{

		$_del_array = array();

		$a = 0;
		foreach( $del_array as $item_id )
		{
			$result = $db->query( 'DELETE FROM ' . TABLE_PERSONNEL_NAME . '_item WHERE item_id = ' . ( int )$item_id );
			if( $result->rowCount() )
			{
				$json['id'][$a] = $item_id;
				$_del_array[] = $item_id;
				++$a;
			}
		}
		$count = sizeof( $_del_array );

		if( $count )
		{
			nv_insert_logs( NV_LANG_DATA, $module_name, 'log_del_item', implode( ', ', $_del_array ), $admin_info['userid'] );

			$nv_Cache->delMod( $module_name );

			$json['success'] = $lang_module['item_delete_success'];
		}

	}
	else
	{
		$json['error'] = $lang_module['item_error_security'];
	}

	nv_jsonOutput( $json );
}
elseif( ACTION_METHOD == 'add' || ACTION_METHOD == 'edit' )
{

	$data = array(
		'item_id' => 0,
		'full_name' => '',
		'phone' => '',
		'email' => '',
		'class_id' => 0,
		'status' => 0,
		'sms_result' => '',
		'date_added' => 0,
		'date_modified' => 0 );

	$error = array();

	$data['item_id'] = $nv_Request->get_int( 'item_id', 'get,post', 0 );
	if( $data['item_id'] > 0 )
	{
		$data = $db->query( 'SELECT *
		FROM ' . TABLE_PERSONNEL_NAME . '_item  
		WHERE item_id=' . $data['item_id'] )->fetch();
 
		$caption = $lang_module['item_edit'];
	}
	else
	{
		$caption = $lang_module['item_add'];
	}

	if( $nv_Request->get_int( 'save', 'post' ) == 1 )
	{

		$data['full_name'] = nv_substr( $nv_Request->get_title( 'full_name', 'post', '', '' ), 0, 250 );
		$data['phone'] = nv_substr( $nv_Request->get_title( 'phone', 'post', '', '' ), 0, 250 );
		$data['email'] = nv_substr( $nv_Request->get_title( 'email', 'post', '', '' ), 0, 250 );
		$data['class_id'] = $nv_Request->get_int( 'class_id', 'post', 0 );
		$data['status'] = $nv_Request->get_int( 'status', 'post', 0 );
		 
 
		if( empty( $data['full_name'] ) ) $error['full_name'] = $lang_module['item_error_full_name'];
		if( empty( $data['phone'] ) ) $error['phone'] = $lang_module['item_error_phone'];
		if( empty( $data['email'] ) ) $error['email'] = $lang_module['item_error_email'];
		if( empty( $data['class_id'] ) ) $error['class_id'] = $lang_module['item_error_class'];
 
		if( ! empty( $error ) && ! isset( $error['warning'] ) )
		{
			$error['warning'] = $lang_module['item_error_warning'];
		}

		if( empty( $error ) )
		{
			try
			{
				if( $data['item_id'] == 0 )
				{
 
					$stmt = $db->prepare( 'INSERT INTO ' . TABLE_PERSONNEL_NAME . '_item SET 
						sms_result=:sms_result,
						full_name=:full_name,
						email=:email,
						phone=:phone,
						class_id=' . intval( $data['class_id'] ) . ',
						status=' . intval( $data['status'] ) . ',	
						date_added=' . intval( NV_CURRENTTIME ) );

					$stmt->bindParam( ':sms_result', $data['sms_result'], PDO::PARAM_STR );
					$stmt->bindParam( ':full_name', $data['full_name'], PDO::PARAM_STR );
					$stmt->bindParam( ':email', $data['email'], PDO::PARAM_STR );
					$stmt->bindParam( ':phone', $data['phone'], PDO::PARAM_STR );
 
					$stmt->execute();

					if( $data['item_id'] = $db->lastInsertId() )
					{
						nv_insert_logs( NV_LANG_DATA, $module_name, $lang_module['item_add'], 'item_id: ' . $data['item_id'], $admin_info['userid'] );
 
						
						$nv_Request->set_Session( $module_data . '_success', $lang_module['item_add_success'] );

						$nv_Cache->delMod( $module_name );
					}
					else
					{
						$error['warning'] = $lang_module['item_error_save'];

					}
					$stmt->closeCursor();

				

				}
				else
				{
				 

					$stmt = $db->prepare( 'UPDATE ' . TABLE_PERSONNEL_NAME . '_item SET 
							sms_result=:sms_result,
							full_name=:full_name,
							email=:email,
							phone=:phone,
							class_id=' . intval( $data['class_id'] ) . ',
							status=' . intval( $data['status'] ) . ',
							date_modified=' . intval( NV_CURRENTTIME ) . '
							WHERE item_id=' . $data['item_id'] );

					$stmt->bindParam( ':sms_result', $data['sms_result'], PDO::PARAM_STR );
					$stmt->bindParam( ':full_name', $data['full_name'], PDO::PARAM_STR );
					$stmt->bindParam( ':email', $data['email'], PDO::PARAM_STR );
					$stmt->bindParam( ':phone', $data['phone'], PDO::PARAM_STR );

					if( $stmt->execute() )
					{
						nv_insert_logs( NV_LANG_DATA, $module_name, $lang_module['item_edit'], 'item_id: ' . $data['item_id'], $admin_info['userid'] );
 
						$nv_Request->set_Session( $module_data . '_success', $lang_module['item_edit_success'] );

						$nv_Cache->delMod( $module_name );

					}
					else
					{
						$error['warning'] = $lang_module['item_error_save'];

					}

					$stmt->closeCursor();

				 
				}
			}
			catch ( PDOException $e )
			{
				$error['warning'] = $lang_module['item_error_save'];
				// var_dump( $e ); die();
			}
		}

		if( empty( $error ) )
		{

			Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
			die();
		}

	}
 
	$xtpl = new XTemplate( 'item_add.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
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
	$xtpl->assign( 'CANCEL', NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=" . $op );
	$xtpl->assign( 'TOKEN', md5( $client_info['session_id'] . $global_config['sitekey'] ) );

	$xtpl->assign( 'UPLOADDIR', NV_UPLOADS_DIR . '/' . $module_upload );
	$xtpl->assign( 'CURRENTPATH', NV_UPLOADS_DIR . '/' . $module_upload );
	$xtpl->assign( 'BUTTON_SUBMIT', ( $data['item_id'] == 0 ) ? $lang_module['item_create'] : $lang_module['item_update'] );


	if( $data['class_id'] )
	{
		$data['class_name'] = $db->query( 'SELECT class_name FROM ' .TABLE_PERSONNEL_NAME . '_class WHERE class_id=' . intval( $data['class_id'] ))->fetchColumn();
		
		$xtpl->assign( 'CLASS', array('class_id'=> $data['class_id'], 'name'=> $data['class_name'], 'selected'=> 'selected="selected"')  );
	 
		$xtpl->parse( 'main.class' );
	}
	foreach( $arrayStatusItem as $key => $val )
	{
		$xtpl->assign( 'STATUS', array(
			'key' => $key,
			'name' => $val,
			'selected' => $key == $data['status'] ? ' selected="selected"' : '' ) );
		$xtpl->parse( 'main.status' );
	}
	if( $error )
	{
		foreach( $error as $key => $_error )
		{
			$xtpl->assign( 'error_' . $key, $_error );
			$xtpl->parse( 'main.error_' . $key );
		}
	}

	$xtpl->parse( 'main' );
	$contents = $xtpl->text( 'main' );

	include NV_ROOTDIR . '/includes/header.php';
	echo nv_admin_theme( $contents );
	include NV_ROOTDIR . '/includes/footer.php';
}

/*show list item*/

$per_page = 100;
 
$data['q'] = $nv_Request->get_string( 'q', 'get', '' );
$data['class_id'] = $nv_Request->get_int( 'class_id', 'get', 0 );
$data['date_from'] = $nv_Request->get_title( 'date_from', 'get', '' );
$data['date_to'] = $nv_Request->get_title( 'date_to', 'get', '' );
$data['sort'] = $nv_Request->get_string( 'sort', 'get', '' );
$data['order'] = $nv_Request->get_string( 'order', 'get' ) == 'asc' ? 'asc' : 'desc';
$page = $nv_Request->get_int( 'page', 'get', 1 );
 
$base_url_order = $base_url = NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '='. $op;
 
 
$sql = TABLE_PERSONNEL_NAME . '_item i LEFT JOIN ' . TABLE_PERSONNEL_NAME . '_class c ON (i.class_id = c.class_id)';

$implode = array();

if( $data['q'] )
{
	$implode[] = '( i.full_name LIKE \'%' . $db_slave->dblikeescape( $data['q'] ) . '%\' OR i.phone LIKE \'%' . $db_slave->dblikeescape( $data['q'] ) . '%\' OR i.email LIKE \'%' . $db_slave->dblikeescape( $data['q'] ) . '%\')';
	
	$base_url .= '&amp;q=' . $data['q'];
	
	$base_url_order .= '&amp;q=' . $data['q'];
}
if( $data['class_id'] > 0 )
{
	$implode[] = 'i.class_id = ' . intval( $data['class_id'] );
	
	$base_url .= '&amp;class_id=' . $data['class_id'];
	
	$base_url_order .= '&amp;class_id=' . $data['class_id'];
 
}
if( preg_match( '/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $data['date_from'], $m ) )
{

	$date_from = mktime( 0, 0, 0, $m[2], $m[1], $m[3] );
}
else
{
	$date_from = 0;
}
if( preg_match( '/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $data['date_to'], $m ) )
{

	$date_to = mktime( 23, 59, 59, $m[2], $m[1], $m[3] );
}
else
{
	$date_to = 0;
} 

if( $date_from && $date_to )
{
	$implode[] = 'i.date_added BETWEEN ' . intval( $date_from ) . ' AND ' . intval( $date_to );
	
	$base_url .= '&amp;date_from=' . $data['date_to'];
	$base_url .= '&amp;date_to=' . $data['date_to'];
	
	$base_url_order .= '&amp;date_from=' . $data['date_to'];
	$base_url_order .= '&amp;date_to=' . $data['date_to'];
	
}
 
if( $implode )
{
	$sql .= ' WHERE ' . implode( ' AND ', $implode );
}
 
$sort_data = array(
	'full_name',
	'email',
	'phone',
	'class_name',
	'status',
	'weight' );

if( isset( $data['sort'] ) && in_array( $data['sort'], $sort_data ) )
{
	if( $data['sort'] == 'class_name' )
	{
		$sql .= ' ORDER BY c.' . $data['sort'];
	}
	else
	{
		$sql .= ' ORDER BY i.' . $data['sort'];
	}
	
}
else
{
	$sql .= ' ORDER BY i.date_added';
}

if( isset( $data['order'] ) && ( $data['order'] == 'desc' ) )
{
	$sql .= ' DESC';
}
else
{
	$sql .= ' ASC';
}
 
$num_items = $db->query( 'SELECT COUNT(*) FROM ' . $sql )->fetchColumn();


$db->sqlreset()->select( 'i.*, c.class_name' )->from( $sql )->limit( $per_page )->offset( ( $page - 1 ) * $per_page );

$result = $db->query( $db->sql() );

$array = array();
while( $rows = $result->fetch() )
{
	$array[] = $rows;
}

$xtpl = new XTemplate( 'item.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'NV_LANG_VARIABLE', NV_LANG_VARIABLE );
$xtpl->assign( 'NV_LANG_DATA', NV_LANG_DATA );
$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
$xtpl->assign( 'THEME', $global_config['site_theme'] );
$xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
$xtpl->assign( 'OP', $op );
$xtpl->assign( 'MODULE_FILE', $module_file );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'DATA', $data );
$xtpl->assign( 'TOKEN', md5( $nv_Request->session_id . $global_config['sitekey'] ) );
$xtpl->assign( 'ADD_NEW', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '='. $op .'&action=add' );

$order2 = ( $data['order'] == 'asc' ) ? 'desc' : 'asc';

$xtpl->assign( 'URL_FULL_NAME', $base_url_order . '&amp;sort=full_name&amp;order=' . $order2 . '&amp;per_page=' . $per_page );
$xtpl->assign( 'URL_EMAIL', $base_url_order . '&amp;sort=email&amp;order=' . $order2 . '&amp;per_page=' . $per_page );
$xtpl->assign( 'URL_PHONE', $base_url_order . '&amp;sort=phone&amp;order=' . $order2 . '&amp;per_page=' . $per_page );
$xtpl->assign( 'URL_CLASS_NAME', $base_url_order . '&amp;sort=class_name&amp;order=' . $order2 . '&amp;per_page=' . $per_page );

$xtpl->assign( 'FULL_NAME_ORDER', ( $data['sort'] == 'full_name' ) ? 'class="' . $order2 . '"' : '' );
$xtpl->assign( 'EMAIL_ORDER', ( $data['sort'] == 'email' ) ? 'class="' . $order2 . '"' : '' );
$xtpl->assign( 'PHONE_ORDER', ( $data['sort'] == 'phone' ) ? 'class="' . $order2 . '"' : '' );
$xtpl->assign( 'TYPE_ORDER', ( $data['sort'] == 'type_id' ) ? 'class="' . $order2 . '"' : '' );
$xtpl->assign( 'CLASS_NAME_ORDER', ( $data['sort'] == 'class_name' ) ? 'class="' . $order2 . '"' : '' );

if( $data['class_id'] )
{
	$data['class_name'] = $db->query( 'SELECT class_name FROM ' .TABLE_PERSONNEL_NAME . '_class WHERE class_id=' . intval( $data['class_id'] ))->fetchColumn();
	
	$xtpl->assign( 'CLASS', array('class_id'=> $data['class_id'], 'name'=> $data['class_name'], 'selected'=> 'selected="selected"')  );
 
	$xtpl->parse( 'main.class' );
}

if( $nv_Request->get_string( $module_data . '_success', 'session' ) )
{
	$xtpl->assign( 'SUCCESS', $nv_Request->get_string( $module_data . '_success', 'session' ) );
	$xtpl->parse( 'main.success' );
	$nv_Request->unset_request( $module_data . '_success', 'session' );
}

if( ! empty( $array ) )
{
	
	// $getTypes = getTypes();	
	// $getTeacher = getTeacher();
	$stt = 1;
	foreach( $array as $item )
	{

		$item['stt'] = (( $page - 1 ) * $per_page) + $stt;
		$item['token'] = md5( $nv_Request->session_id . $global_config['sitekey'] . $item['item_id'] );
		$item['date_added'] = date('d/m/Y', $item['date_added']);
		$item['edit'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op . '&action=edit&token=' . $item['token'] . '&item_id=' . $item['item_id'];
				
		$xtpl->assign( 'LOOP', $item );
		foreach( $arrayStatusItem as $key => $val )
		{
			$xtpl->assign( 'STATUS', array(
				'key' => $key,
				'name' => $val,
				'selected' => $key == $item['status'] ? ' selected="selected"' : '' ) );
			$xtpl->parse( 'main.loop.status' );
		}
		$xtpl->parse( 'main.loop' );
		++$stt;
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
