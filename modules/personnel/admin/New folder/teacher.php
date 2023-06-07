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

$page_title = $lang_module['teacher'];

function teacher_fix_weight()
{
	global $db;
	$sql = 'SELECT teacher_id FROM ' . TABLE_PERSONNEL_NAME . '_teacher ORDER BY weight ASC';
	$result = $db->query( $sql );
	$weight = 0;
	while( $row = $result->fetch() )
	{
		++$weight;
		$db->query( 'UPDATE ' . TABLE_PERSONNEL_NAME . '_teacher SET weight=' . $weight . ' WHERE teacher_id=' . $row['teacher_id'] );
	}
	$result->closeCursor();
}

if( ACTION_METHOD == 'delete' )
{
	$json = array();

	$teacher_id = $nv_Request->get_int( 'teacher_id', 'post', 0 );

	$token = $nv_Request->get_title( 'token', 'post', '', 1 );

	$listid = $nv_Request->get_string( 'listid', 'post', '' );

	if( $listid != '' and md5( $nv_Request->session_id . $global_config['sitekey'] ) == $token )
	{
		$del_array = array_map( 'intval', explode( ',', $listid ) );
	}
	elseif( $token == md5( $nv_Request->session_id . $global_config['sitekey'] . $teacher_id ) )
	{
		$del_array = array( $teacher_id );
	}

	if( ! empty( $del_array ) )
	{

		$_del_array = array();

		$a = 0;
		foreach( $del_array as $teacher_id )
		{

			$db->query( 'DELETE FROM ' . TABLE_PERSONNEL_NAME . '_teacher WHERE teacher_id = ' . ( int )$teacher_id );

				$json['id'][$a] = $teacher_id;

				$_del_array[] = $teacher_id;

				++$a;
		}

		$count = sizeof( $_del_array );

		if( $count )
		{
			teacher_fix_weight();

			nv_insert_logs( NV_LANG_DATA, $module_name, 'log_del_teacher', implode( ', ', $_del_array ), $admin_info['userid'] );

			$nv_Cache->delMod($module_name);

			$json['success'] = $lang_module['teacher_delete_success'];
		}

	}
	else
	{
		$json['error'] = $lang_module['teacher_error_security'];
	}

	nv_jsonOutput( $json );
}
elseif( ACTION_METHOD == 'status' )
{
	$json = array();

	$teacher_id = $nv_Request->get_int( 'teacher_id', 'post', 0 );
	$new_vid = $nv_Request->get_int( 'new_vid', 'post', 0 );
	$token = $nv_Request->get_title( 'token', 'post', '', 1 );

	if( $token == md5( $nv_Request->session_id . $global_config['sitekey'] . $teacher_id ) )
	{
		$sql = 'UPDATE ' . TABLE_PERSONNEL_NAME . '_teacher SET status=' . $new_vid . ' WHERE teacher_id=' . $teacher_id;
		if( $db->exec( $sql ) )
		{
			nv_insert_logs( NV_LANG_DATA, $module_name, 'log_change_status_teacher', 'teacher_id:' . $teacher_id, $admin_info['userid'] );

			$nv_Cache->delMod($module_name);

			$json['success'] = $lang_module['teacher_status_success'];

		}
		else
		{
			$json['error'] = $lang_module['teacher_error_status'];

		}
	}
	else
	{
		$json['error'] = $lang_module['teacher_error_security'];
	}

	nv_jsonOutput( $json );
}
elseif( ACTION_METHOD == 'weight' )
{
	$json = array();

	$teacher_id = $nv_Request->get_int( 'teacher_id', 'post', 0 );
	$new_vid = $nv_Request->get_int( 'new_vid', 'post', 0 );
	$token = $nv_Request->get_title( 'token', 'post', '', 1 );

	if( $token == md5( $nv_Request->session_id . $global_config['sitekey'] . $teacher_id ) )
	{
		$sql = 'SELECT teacher_id FROM ' . TABLE_PERSONNEL_NAME . '_teacher WHERE teacher_id!=' . $teacher_id . ' ORDER BY weight ASC';
		$result = $db->query( $sql );

		$weight = 0;
		while( $row = $result->fetch() )
		{
			++$weight;
			if( $weight == $new_vid ) ++$weight;
			$sql = 'UPDATE ' . TABLE_PERSONNEL_NAME . '_teacher SET weight=' . $weight . ' WHERE teacher_id=' . intval( $row['teacher_id'] );
			$db->query( $sql );
		}

		$sql = 'UPDATE ' . TABLE_PERSONNEL_NAME . '_teacher SET weight=' . $new_vid . ' WHERE teacher_id=' . $teacher_id;
		if( $db->exec( $sql ) )
		{
			nv_insert_logs( NV_LANG_DATA, $module_name, 'log_change_weight_teacher', 'teacher_id:' . $teacher_id, $admin_info['userid'] );

			$nv_Cache->delMod($module_name);

			$json['success'] = $lang_module['teacher_weight_success'];
			$json['link'] = NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op;

		}
		else
		{
			$json['error'] = $lang_module['teacher_error_weight'];

		}
	}
	else
	{
		$json['error'] = $lang_module['teacher_error_security'];
	}

	nv_jsonOutput( $json );
}
elseif( ACTION_METHOD == 'add' || ACTION_METHOD == 'edit' )
{

	$data = array(
		'teacher_id' => 0,
		'full_name' => '',
		'email' => '',
		'phone' => '',
		'birthday' => '',
		'photo' => '',
		'weight' => '',
		'status' => 1,
		'date_added' => NV_CURRENTTIME );

	$error = array();

	$data['teacher_id'] = $nv_Request->get_int( 'teacher_id', 'get,post', 0 );
	if( $data['teacher_id'] > 0 )
	{
		$data = $db->query( 'SELECT *
		FROM ' . TABLE_PERSONNEL_NAME . '_teacher  
		WHERE teacher_id=' . $data['teacher_id'] )->fetch();

		$caption = $lang_module['teacher_edit'];
	}
	else
	{
		$caption = $lang_module['teacher_add'];
	}

	if( $nv_Request->get_int( 'save', 'post' ) == 1 )
	{

		$data['teacher_id'] = $nv_Request->get_int( 'teacher_id', 'post', 0 );
		$data['full_name'] = nv_substr( $nv_Request->get_title( 'full_name', 'post', '', '' ), 0, 250 );
		$data['phone'] = nv_substr( $nv_Request->get_title( 'phone', 'post', '', '' ), 0, 250 );
		$data['email'] = nv_substr( $nv_Request->get_title( 'email', 'post', '', '' ), 0, 250 );
		$data['birthday'] = nv_substr( $nv_Request->get_title( 'birthday', 'post', '', '' ), 0, 10 );
		
		if( preg_match( '/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $data['birthday'], $m ) )
		{

			$data['birthday'] = mktime( 0, 0, 0, $m[2], $m[1], $m[3] );
		}
		else
		{
			$data['birthday'] = 0;
		}
		
		$data['experience'] = nv_substr( $nv_Request->get_title( 'experience', 'post', '', '' ), 0, 250 );
		$data['photo'] = nv_substr( $nv_Request->get_title( 'photo', 'post', '', '' ), 0, 250 );
		$data['status'] = $nv_Request->get_int( 'status', 'post', 0 );

		if( empty( $data['full_name'] ) )
		{
			$error['full_name'] = $lang_module['teacher_error_full_name'];
		}

		if( empty( $data['photo'] ) )
		{
			$error['photo'] = $lang_module['teacher_error_photo'];
		}

		if( ! empty( $error ) && ! isset( $error['warning'] ) )
		{
			$error['warning'] = $lang_module['teacher_error_warning'];
		}

		if( empty( $error ) )
		{
			
			$photo = NV_DOCUMENT_ROOT . $data['photo'];
			if( !nv_is_url( $data['photo'] ) and is_file( $photo ) )
			{
				$lu = strlen( NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' );
				$data['photo'] = substr( $data['photo'], $lu );
			}
			
			if( $data['teacher_id'] == 0 )
			{
				try
				{
					$stmt = $db->prepare( 'SELECT MAX(weight) FROM ' . TABLE_PERSONNEL_NAME . '_teacher' );
					$stmt->execute();
					$weight = $stmt->fetchColumn();

					$weight = intval( $weight ) + 1;

					$stmt = $db->prepare( 'INSERT INTO ' . TABLE_PERSONNEL_NAME . '_teacher SET 
						weight = ' . intval( $weight ) . ', 
						status=' . intval( $data['status'] ) . ', 
						birthday=' . intval( $data['birthday'] ) . ', 
						date_added=' . intval( $data['date_added'] ) . ',  
						full_name =:full_name, 
						phone =:phone, 
						email =:email, 
						experience =:experience, 
						photo =:photo' );

					$stmt->bindParam( ':full_name', $data['full_name'], PDO::PARAM_STR );
					$stmt->bindParam( ':phone', $data['phone'], PDO::PARAM_STR );
					$stmt->bindParam( ':email', $data['email'], PDO::PARAM_STR );
					$stmt->bindParam( ':experience', $data['experience'], PDO::PARAM_STR );
					$stmt->bindParam( ':photo', $data['photo'], PDO::PARAM_STR );
					$stmt->execute();

					if( $data['teacher_id'] = $db->lastInsertId() )
					{
						nv_insert_logs( NV_LANG_DATA, $module_name,$lang_module['teacher_add'], 'teacher_id: ' . $data['teacher_id'], $admin_info['userid'] );
						
						$nv_Request->set_Session( $module_data . '_success', $lang_module['teacher_insert_success'] );
					}
					else
					{
						$error['warning'] = $lang_module['teacher_error_save'];

					}
					$stmt->closeCursor();

				}
				catch ( PDOException $e )
				{
					$error['warning'] = $lang_module['teacher_error_save'];
					var_dump($e);die();
				}

			}
			else
			{
				try
				{

					$stmt = $db->prepare( 'UPDATE ' . TABLE_PERSONNEL_NAME . '_teacher SET 
						status=' . intval( $data['status'] ) . ',
						birthday=' . intval( $data['birthday'] ) . ',
						full_name =:full_name,
						phone =:phone,
						email =:email,
						experience =:experience,
						photo =:photo
						WHERE teacher_id=' . $data['teacher_id'] );

					$stmt->bindParam( ':full_name', $data['full_name'], PDO::PARAM_STR );
					$stmt->bindParam( ':phone', $data['phone'], PDO::PARAM_STR );
					$stmt->bindParam( ':email', $data['email'], PDO::PARAM_STR );
					$stmt->bindParam( ':experience', $data['experience'], PDO::PARAM_STR );
					$stmt->bindParam( ':photo', $data['photo'], PDO::PARAM_STR );
					if( $stmt->execute() )
					{
						nv_insert_logs( NV_LANG_DATA, $module_name, $lang_module['teacher_edit'], 'teacher_id: ' . $data['teacher_id'], $admin_info['userid'] );
						$nv_Request->set_Session( $module_data . '_success', $lang_module['teacher_update_success'] );
					}
					else
					{
						$error['warning'] = $lang_module['teacher_error_save'];

					}

					$stmt->closeCursor();

				}
				catch ( PDOException $e )
				{
					$error['warning'] = $lang_module['teacher_error_save'];
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
	
	if( ! empty( $data['photo'] ) and file_exists( NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/' . $data['photo'] ) )
	{
		$data['photo'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $data['photo'];
	}

	$data['birthday'] = ! empty( $data['birthday'] ) ? date('d/m/Y', $data['birthday']) : '';
	
	$xtpl = new XTemplate( 'teacher_add.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
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

/*show list teacher*/

$per_page = 50;

$page = $nv_Request->get_int( 'page', 'get', 1 );

$sql = TABLE_PERSONNEL_NAME . '_teacher';

$sort = $nv_Request->get_string( 'sort', 'get', '' );

$order = $nv_Request->get_string( 'order', 'get' ) == 'desc' ? 'desc' : 'asc';

$sort_data = array(
	'full_name',
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

$base_url = NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=teacher&amp;sort=' . $sort . '&amp;order=' . $order . '&amp;per_page=' . $per_page;

$db->sqlreset()->select( '*' )->from( $sql )->limit( $per_page )->offset( ( $page - 1 ) * $per_page );

$result = $db->query( $db->sql() );

$array = array();
while( $rows = $result->fetch() )
{
	$array[] = $rows;
}

$xtpl = new XTemplate( 'teacher.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
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
$xtpl->assign( 'ADD_NEW', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=teacher&action=add' );

$order2 = ( $order == 'asc' ) ? 'desc' : 'asc';

$xtpl->assign( 'URL_SERVICE_NAME', NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;sort=full_name&amp;order=' . $order2 . '&amp;per_page=' . $per_page );
$xtpl->assign( 'URL_NGAYKHAIGIANG', NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;sort=ghichu&amp;order=' . $order2 . '&amp;per_page=' . $per_page );
$xtpl->assign( 'URL_WEIGHT', NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;sort=weight&amp;order=' . $order2 . '&amp;per_page=' . $per_page );
$xtpl->assign( 'URL_STATUS', NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;sort=status&amp;order=' . $order2 . '&amp;per_page=' . $per_page );

$xtpl->assign( 'SERVICE_NAME_ORDER', ( $sort == 'full_name' ) ? 'class="' . $order2 . '"' : '' );
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

		$item['token'] = md5( $nv_Request->session_id . $global_config['sitekey'] . $item['teacher_id'] );
		$item['edit'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op . '&action=edit&token=' . $item['token'] . '&teacher_id=' . $item['teacher_id'];
		$item['link_appointment'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=hocvien&teacher_id=' . $item['teacher_id'] . '&token=' . $item['token'];
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
