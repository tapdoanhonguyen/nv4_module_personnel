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

$page_title = $lang_module['class'];

function class_fix_weight()
{
	global $db;
	$sql = 'SELECT class_id FROM ' . TABLE_PERSONNEL_NAME . '_class ORDER BY weight ASC';
	$result = $db->query( $sql );
	$weight = 0;
	while( $row = $result->fetch() )
	{
		++$weight;
		$db->query( 'UPDATE ' . TABLE_PERSONNEL_NAME . '_class SET weight=' . $weight . ' WHERE class_id=' . $row['class_id'] );
	}
	$result->closeCursor();
}

if( ACTION_METHOD == 'delete' )
{
	$json = array();

	$class_id = $nv_Request->get_int( 'class_id', 'post', 0 );

	$token = $nv_Request->get_title( 'token', 'post', '', 1 );

	$listid = $nv_Request->get_string( 'listid', 'post', '' );

	if( $listid != '' and md5( $nv_Request->session_id . $global_config['sitekey'] ) == $token )
	{
		$del_array = array_map( 'intval', explode( ',', $listid ) );
	}
	elseif( $token == md5( $nv_Request->session_id . $global_config['sitekey'] . $class_id ) )
	{
		$del_array = array( $class_id );
	}

	if( ! empty( $del_array ) )
	{

		$_del_array = array();

		$a = 0;
		foreach( $del_array as $class_id )
		{

			$db->query( 'DELETE FROM ' . TABLE_PERSONNEL_NAME . '_class WHERE class_id = ' . ( int )$class_id );

				$json['id'][$a] = $class_id;

				$_del_array[] = $class_id;

				++$a;
		}

		$count = sizeof( $_del_array );

		if( $count )
		{
			class_fix_weight();

			nv_insert_logs( NV_LANG_DATA, $module_name, 'log_del_class', implode( ', ', $_del_array ), $admin_info['userid'] );

			$nv_Cache->delMod($module_name);

			$json['success'] = $lang_module['class_delete_success'];
		}

	}
	else
	{
		$json['error'] = $lang_module['class_error_security'];
	}

	nv_jsonOutput( $json );
}
elseif( ACTION_METHOD == 'alias' )
{
	$json = array();
 
	$title = $nv_Request->get_title( 'title', 'post', '', 1 );
	
	$json['alias'] = strtolower( change_alias( $title  ) );

	nv_jsonOutput( $json );
}
elseif( ACTION_METHOD == 'status' )
{
	$json = array();

	$class_id = $nv_Request->get_int( 'class_id', 'post', 0 );
	$new_vid = $nv_Request->get_int( 'new_vid', 'post', 0 );
	$token = $nv_Request->get_title( 'token', 'post', '', 1 );

	if( $token == md5( $nv_Request->session_id . $global_config['sitekey'] . $class_id ) )
	{
		$sql = 'UPDATE ' . TABLE_PERSONNEL_NAME . '_class SET status=' . $new_vid . ' WHERE class_id=' . $class_id;
		if( $db->exec( $sql ) )
		{
			nv_insert_logs( NV_LANG_DATA, $module_name, 'log_change_status_class', 'class_id:' . $class_id, $admin_info['userid'] );

			$nv_Cache->delMod($module_name);

			$json['success'] = $lang_module['class_status_success'];

		}
		else
		{
			$json['error'] = $lang_module['class_error_status'];

		}
	}
	else
	{
		$json['error'] = $lang_module['class_error_security'];
	}

	nv_jsonOutput( $json );
}
elseif( ACTION_METHOD == 'weight' )
{
	$json = array();

	$class_id = $nv_Request->get_int( 'class_id', 'post', 0 );
	$new_vid = $nv_Request->get_int( 'new_vid', 'post', 0 );
	$token = $nv_Request->get_title( 'token', 'post', '', 1 );

	if( $token == md5( $nv_Request->session_id . $global_config['sitekey'] . $class_id ) )
	{
		$sql = 'SELECT class_id FROM ' . TABLE_PERSONNEL_NAME . '_class WHERE class_id!=' . $class_id . ' ORDER BY weight ASC';
		$result = $db->query( $sql );

		$weight = 0;
		while( $row = $result->fetch() )
		{
			++$weight;
			if( $weight == $new_vid ) ++$weight;
			$sql = 'UPDATE ' . TABLE_PERSONNEL_NAME . '_class SET weight=' . $weight . ' WHERE class_id=' . intval( $row['class_id'] );
			$db->query( $sql );
		}

		$sql = 'UPDATE ' . TABLE_PERSONNEL_NAME . '_class SET weight=' . $new_vid . ' WHERE class_id=' . $class_id;
		if( $db->exec( $sql ) )
		{
			nv_insert_logs( NV_LANG_DATA, $module_name, 'log_change_weight_class', 'class_id:' . $class_id, $admin_info['userid'] );

			$nv_Cache->delMod($module_name);

			$json['success'] = $lang_module['class_weight_success'];
			$json['link'] = NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op;

		}
		else
		{
			$json['error'] = $lang_module['class_error_weight'];

		}
	}
	else
	{
		$json['error'] = $lang_module['class_error_security'];
	}

	nv_jsonOutput( $json );
}
elseif( ACTION_METHOD == 'add' || ACTION_METHOD == 'edit' )
{
	
	
	if( defined( 'NV_EDITOR' ) )
	{
		require_once NV_ROOTDIR . '/' . NV_EDITORSDIR . '/' . NV_EDITOR . '/nv.php';
	}
	$currentpath = $module_upload . '/' . date( 'Y_m' );

	if( file_exists( NV_UPLOADS_REAL_DIR . '/' . $currentpath ) )
	{
		$upload_real_dir_page = NV_UPLOADS_REAL_DIR . '/' . $currentpath;
	}
	else
	{
		$upload_real_dir_page = NV_UPLOADS_REAL_DIR . '/' . $module_upload;
		$e = explode( '/', $currentpath );
		if( ! empty( $e ) )
		{
			$cp = '';
			foreach( $e as $p )
			{
				if( ! empty( $p ) and ! is_dir( NV_UPLOADS_REAL_DIR . '/' . $cp . $p ) )
				{
					$mk = nv_mkdir( NV_UPLOADS_REAL_DIR . '/' . $cp, $p );
					if( $mk[0] > 0 )
					{
						$upload_real_dir_page = $mk[2];
						try
						{
							$db->query( "INSERT INTO " . NV_UPLOAD_GLOBALTABLE . "_dir (dirname, time) VALUES ('" . NV_UPLOADS_DIR . "/" . $cp . $p . "', 0)" );
						}
						catch ( PDOException $e )
						{
							trigger_error( $e->getMessage() );
						}
					}
				}
				elseif( ! empty( $p ) )
				{
					$upload_real_dir_page = NV_UPLOADS_REAL_DIR . '/' . $cp . $p;
				}
				$cp .= $p . '/';
			}
		}
		$upload_real_dir_page = str_replace( '\\', '/', $upload_real_dir_page );
	}

	$currentpath = str_replace( NV_ROOTDIR . '/', '', $upload_real_dir_page );
	$moudulepath = NV_UPLOADS_DIR . '/' . $module_upload ;

	$data = array(
		'class_id' => 0,
		'category_id' => 0,
		'teacher_id' => 0,
		'type_id' => 0,
		'class_name' => '',
		'numberlearn' => '',
		'price' => '',
		'description' => '',
		'detail' => '',
		'image' => '',
		'weight' => '',
		'status' => 1,
		'opening_day' => '',
		'opening_hour' => 8,
		'opening_minute' => 0,
		'date_added' => NV_CURRENTTIME );

	$error = array();

	$data['class_id'] = $nv_Request->get_int( 'class_id', 'get,post', 0 );
	if( $data['class_id'] > 0 )
	{
		$data = $db->query( 'SELECT *
		FROM ' . TABLE_PERSONNEL_NAME . '_class  
		WHERE class_id=' . $data['class_id'] )->fetch();
		
		$data['opening_hour'] = ( $data['opening_day'] ) ? date( 'H', $data['opening_day'] ) : 0;
		$data['opening_minute'] = ( $data['opening_day'] ) ? date('i', $data['opening_day']) : 0;
		// $data['opening_day'] = ( $data['opening_day'] ) ? date('d/m/Y', $data['opening_day']) : '';
		
		$caption = $lang_module['class_edit'];
	}
	else
	{
		$caption = $lang_module['class_add'];
	}

	if( $nv_Request->get_int( 'save', 'post' ) == 1 )
	{

		$data['class_id'] = $nv_Request->get_int( 'class_id', 'post', 0 );
		$data['category_id'] = $nv_Request->get_int( 'category_id', 'post', 0 );
		$data['teacher_id'] = $nv_Request->get_int( 'teacher_id', 'post', 0 );
		$data['type_id'] = $nv_Request->get_int( 'type_id', 'post', 0 );
		$data['numberlearn'] =  $nv_Request->get_int( 'numberlearn', 'post', 0 );
 		$data['description'] = nv_substr( $nv_Request->get_title( 'description', 'post', '', '' ), 0, 255 );
 		$data['class_name'] = nv_substr( $nv_Request->get_title( 'class_name', 'post', '', '' ), 0, 250 );
		$data['alias'] = nv_substr( $nv_Request->get_title( 'alias', 'post', '', '' ), 0, 240 );
		
		$data['alias'] = empty( $data['alias'] ) ? strtolower( change_alias( $data['class_name'] ) ) : strtolower( change_alias( $data['alias'] ) );
		
		
		$data['price'] = $nv_Request->get_title( 'price', 'post', '', '' );
		$data['price'] = preg_replace( '/[^0-9\.]/', '', $data['price'] );
		$data['image'] = nv_substr( $nv_Request->get_title( 'image', 'post', '', '' ), 0, 250 );
		$data['detail'] = $nv_Request->get_editor( 'detail', '', NV_ALLOWED_HTML_TAGS );

		$data['status'] = $nv_Request->get_int( 'status', 'post', 0 );
		$data['opening_day'] = $nv_Request->get_title( 'opening_day', 'post', '' );
		$data['opening_hour'] = $nv_Request->get_int( 'opening_hour', 'post', 0 );
		$data['opening_minute'] = $nv_Request->get_int( 'opening_minute', 'post',0 );
		
		if( preg_match( '/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $data['opening_day'], $m ) )
		{
			
			$data['opening_day'] = mktime( $data['opening_hour'], $data['opening_minute'], 0, $m[2], $m[1], $m[3] );
		}
		else
		{
			$data['opening_day'] = 0;
		} 
		
		
		if( empty( $data['class_name'] ) )
		{
			$error['class_name'] = $lang_module['class_error_class_name'];
		}
		if( empty( $data['price'] ) )
		{
			$error['price'] = $lang_module['class_error_price'];
		}
		if( empty( $data['numberlearn'] ) )
		{
			$error['numberlearn'] = $lang_module['class_error_numberlearn'];
		}
		if( empty( $data['teacher_id'] ) )
		{
			$error['teacher'] = $lang_module['class_error_teacher'];
		}
		if( empty( $data['type_id'] ) )
		{
			$error['type'] = $lang_module['class_error_type'];
		}

		if( empty( $data['image'] ) )
		{
			$error['image'] = $lang_module['class_error_image'];
		}
		if( trim( strip_tags( $data['detail'] ) ) == '' and !preg_match("/\<img[^\>]*alt=\"([^\"]+)\"[^\>]*\>/is", $data['detail'] ) and !preg_match("/<iframe.*src=\"(.*)\".*><\/iframe>/isU", $data['detail'] ) )
		{
			$error['detail'] = $lang_module['class_error_detail'];
		}

		if( ! empty( $error ) && ! isset( $error['warning'] ) )
		{
			$error['warning'] = $lang_module['class_error_warning'];
		}

		if( empty( $error ) )
		{
			
			if( ! nv_is_url( $data['image'] ) and nv_is_file( $data['image'], NV_UPLOADS_DIR . '/' . $module_upload ) === true )
			{
				$lu = strlen( NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' );
				$data['image'] = substr( $data['image'], $lu );
				if( file_exists( NV_ROOTDIR . '/' . NV_FILES_DIR . '/' . $module_upload . '/' . $data['image'] ) )
				{
					$data['thumb'] = 1;
				}
				else
				{
					$data['thumb'] = 2;
				}
			}
			elseif( nv_is_url( $data['image'] ) )
			{
				$data['thumb'] = 3;
			}
			else
			{
				$data['image'] = '';
			}
  
			if( $data['class_id'] == 0 )
			{
				try
				{
					$stmt = $db->prepare( 'SELECT MAX(weight) FROM ' . TABLE_PERSONNEL_NAME . '_class' );
					$stmt->execute();
					$weight = $stmt->fetchColumn();

					$weight = intval( $weight ) + 1;

					$stmt = $db->prepare( 'INSERT INTO ' . TABLE_PERSONNEL_NAME . '_class SET 
						weight = ' . intval( $weight ) . ', 
						status=' . intval( $data['status'] ) . ', 
						category_id=' . intval( $data['category_id'] ) . ', 
						teacher_id=' . intval( $data['teacher_id'] ) . ', 
						type_id=' . intval( $data['type_id'] ) . ', 
						numberlearn=' . intval( $data['numberlearn'] ) . ', 
						opening_day=' . intval( $data['opening_day'] ) . ',  
						date_added=' . intval( $data['date_added'] ) . ',  
						thumb=' . intval( $data['thumb'] ) . ',  
						class_name =:class_name, 
						alias =:alias, 
						description =:description, 
						detail =:detail, 
						price =:price, 
						image =:image' );

					$stmt->bindParam( ':class_name', $data['class_name'], PDO::PARAM_STR );
					$stmt->bindParam( ':alias', $data['alias'], PDO::PARAM_STR );
					$stmt->bindParam( ':description', $data['description'], PDO::PARAM_STR );
					$stmt->bindParam( ':detail', $data['detail'], PDO::PARAM_STR, strlen( $data['detail'] )  );
					$stmt->bindParam( ':price', $data['price'], PDO::PARAM_STR );
					$stmt->bindParam( ':image', $data['image'], PDO::PARAM_STR );
					$stmt->execute();

					if( $data['class_id'] = $db->lastInsertId() )
					{
						nv_insert_logs( NV_LANG_DATA, $module_name,$lang_module['class_add'], 'class_id: ' . $data['class_id'], $admin_info['userid'] );
						
						$nv_Request->set_Session( $module_data . '_success', $lang_module['class_insert_success'] );
					}
					else
					{
						$error['warning'] = $lang_module['class_error_save'];

					}
					$stmt->closeCursor();

				}
				catch ( PDOException $e )
				{
					$error['warning'] = $lang_module['class_error_save'];
					var_dump($e);die();
				}

			}
			else
			{
				try
				{

					$stmt = $db->prepare( 'UPDATE ' . TABLE_PERSONNEL_NAME . '_class SET 
						status=' . intval( $data['status'] ) . ',
						category_id =' . intval( $data['category_id'] ) . ',
						teacher_id =' . intval( $data['teacher_id'] ) . ',
						type_id=' . intval( $data['type_id'] ) . ',
						numberlearn=' . intval( $data['numberlearn'] ) . ',
						opening_day=' . intval( $data['opening_day'] ) . ',
						thumb=' . intval( $data['thumb'] ) . ',
						class_name =:class_name,
						alias =:alias,
						description =:description,
						detail =:detail,
						price =:price,
						image =:image
						WHERE class_id=' . $data['class_id'] );

					$stmt->bindParam( ':class_name', $data['class_name'], PDO::PARAM_STR );
					$stmt->bindParam( ':alias', $data['alias'], PDO::PARAM_STR );
					$stmt->bindParam( ':description', $data['description'], PDO::PARAM_STR );
					$stmt->bindParam( ':detail', $data['detail'], PDO::PARAM_STR, strlen( $data['detail'] ) );
					$stmt->bindParam( ':detail', $data['detail'], PDO::PARAM_STR, strlen( $data['detail'] ) );
					$stmt->bindParam( ':price', $data['price'], PDO::PARAM_STR );
					$stmt->bindParam( ':image', $data['image'], PDO::PARAM_STR );
					if( $stmt->execute() )
					{
						nv_insert_logs( NV_LANG_DATA, $module_name, $lang_module['class_edit'], 'class_id: ' . $data['class_id'], $admin_info['userid'] );
						$nv_Request->set_Session( $module_data . '_success', $lang_module['class_update_success'] );
					}
					else
					{
						$error['warning'] = $lang_module['class_error_save'];

					}

					$stmt->closeCursor();

				}
				catch ( PDOException $e )
				{
					$error['warning'] = $lang_module['class_error_save'];
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
	
	if( ! empty( $data['opening_day'] )  )
	{
		$data['opening_day'] = date('d/m/Y', $data['opening_day']);
	}
	else
	{
		$data['opening_day'] = '';
	}
	
	if( ! empty( $data['image'] ) and file_exists( NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/' . $data['image'] ) )
	{
		$data['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $data['image'];
	}
 	
	$data['detail'] = htmlspecialchars( nv_editor_br2nl($data['detail'] ) );

	if( defined( 'NV_EDITOR' ) and nv_function_exists( 'nv_aleditor' ) )
	{
		$data['detail'] = nv_aleditor( 'detail', '100%', '300px', $data['detail'], '', $moudulepath, $currentpath );
	}
	else
	{
		$data['detail'] = "<textarea class=\"form-control\" style=\"width: 100%\" name=\"detail\" id=\"' . $module_data . '_detail\" rows=\"10\">" . $data['detail'] . "</textarea>";
	} 
 
	$xtpl = new XTemplate( 'class_add.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
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
 	
	for( $hour = 1; $hour <= 24 ; ++$hour )
	{
		$xtpl->assign( 'OPENING_HOUR', array('key'=> $hour, 'name' => str_pad( $hour, 2, "0", STR_PAD_LEFT ), 'selected'=> ( $hour == intval( $data['opening_hour'] ) ) ? 'selected="selected"' : '' ) );
		$xtpl->parse( 'main.opening_hour' );
	}

	for( $minute = 0; $minute <= 59 ; ++$minute )
	{
		$xtpl->assign( 'OPENING_MINUTE', array('key'=> $minute, 'name' => str_pad( $minute, 2, "0", STR_PAD_LEFT ), 'selected'=> ( $minute == intval($data['opening_minute']) ) ? 'selected="selected"' : '' ) );
		$xtpl->parse( 'main.opening_minute' );
	}

	unset( $hour, $minute );
 
	$getTypes = getTypes();
	foreach( $getTypes as $key => $name )
	{
		$xtpl->assign( 'TYPE', array(
			'key' => $key,
			'name' => $name['title'],
			'selected' => ( $key == $data['type_id'] ) ? 'selected="selected"' : '' ) );
		$xtpl->parse( 'main.type' );
	}
		
	$getTeacher = getTeacher();
	foreach( $getTeacher as $key => $name )
	{
		$xtpl->assign( 'TEACHER', array(
			'key' => $key,
			'name' => $name['full_name'],
			'selected' => ( $key == $data['teacher_id'] ) ? 'selected="selected"' : '' ) );
		$xtpl->parse( 'main.teacher' );
	}
	
	$getCategory = getCategory();
 
	foreach( $getCategory as $_category_id => $item )
	{
		$xtitle_i = '';
		if( $item['lev'] > 0 )
		{
			$xtitle_i .= '&nbsp;';
			for( $i = 1; $i <= $item['lev']; $i++ )
			{
				$xtitle_i .= '---';
			}
		}
		$xtitle_i .= $item['title'];
		$xtpl->assign( 'CATEGORY', array(
			'key' => $_category_id,
			'name' => $xtitle_i,
			'selected' => ( $_category_id == $data['category_id'] ) ? 'selected="selected"' : '' ) );
		$xtpl->parse( 'main.category' );
	}
	
	
	foreach( $array_status as $key => $name )
	{
		$xtpl->assign( 'STATUS', array(
			'key' => $key,
			'name' => $name,
			'selected' => ( $key == $data['status'] ) ? 'selected="selected"' : '' ) );
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
	
	if( empty( $data['alias'] ) )
	{
		$xtpl->parse( 'main.getalias' );
	}
	
	$xtpl->parse( 'main' );
	$contents = $xtpl->text( 'main' );

	include NV_ROOTDIR . '/includes/header.php';
	echo nv_admin_theme( $contents );
	include NV_ROOTDIR . '/includes/footer.php';
}

/*show list class*/

$per_page = 50;
 
$data['q'] = $nv_Request->get_string( 'q', 'get', '' );
$data['sort'] = $nv_Request->get_string( 'sort', 'get', '' );
$data['order'] = $nv_Request->get_string( 'order', 'get' ) == 'asc' ? 'asc' : 'desc';
$page = $nv_Request->get_int( 'page', 'get', 1 );

$base_url_order = $base_url = NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '='. $op;


$implode = array();

if( $data['q'] )
{
	$implode[] = 'class_name LIKE \'%' . $db_slave->dblikeescape( $data['q'] ) . '%\'';
	$base_url .= '&amp;q=' . $data['q'];
	$base_url_order .= '&amp;q=' . $data['q'];
}

$sql = TABLE_PERSONNEL_NAME . '_class';

if( $implode )
{
	$sql .= ' WHERE ' . implode( ' AND ', $implode );
}


$sort_data = array(
	'class_name',
	'opening_day',
	'price',
	'status',
	'weight' );

if( isset( $data['sort'] ) && in_array( $data['sort'], $sort_data ) )
{

	$sql .= ' ORDER BY ' . $data['sort'];
}
else
{
	$sql .= ' ORDER BY date_added';
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


$db->sqlreset()->select( '*' )->from( $sql )->limit( $per_page )->offset( ( $page - 1 ) * $per_page );

$result = $db->query( $db->sql() );

$array = array();
while( $rows = $result->fetch() )
{
	$array[] = $rows;
}

$xtpl = new XTemplate( 'class.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
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

$xtpl->assign( 'URL_CLASS_NAME', $base_url_order . '&amp;sort=class_name&amp;order=' . $order2 . '&amp;per_page=' . $per_page );
$xtpl->assign( 'URL_PRICE', $base_url_order . '&amp;sort=price&amp;order=' . $order2 . '&amp;per_page=' . $per_page );
$xtpl->assign( 'URL_NUMBERLEARN', $base_url_order . '&amp;sort=numberlearn&amp;order=' . $order2 . '&amp;per_page=' . $per_page );
$xtpl->assign( 'URL_TYPE', $base_url_order . '&amp;sort=type_id&amp;order=' . $order2 . '&amp;per_page=' . $per_page );
$xtpl->assign( 'URL_TEACHER', $base_url_order . '&amp;sort=teacher_id&amp;order=' . $order2 . '&amp;per_page=' . $per_page );
$xtpl->assign( 'URL_WEIGHT', $base_url_order . '&amp;sort=weight&amp;order=' . $order2 . '&amp;per_page=' . $per_page );
$xtpl->assign( 'URL_STATUS', $base_url_order . '&amp;sort=status&amp;order=' . $order2 . '&amp;per_page=' . $per_page );

$xtpl->assign( 'CLASS_NAME_ORDER', ( $data['sort'] == 'class_name' ) ? 'class="' . $order2 . '"' : '' );
$xtpl->assign( 'PRICE_ORDER', ( $data['sort'] == 'price' ) ? 'class="' . $order2 . '"' : '' );
$xtpl->assign( 'NUMBERLEARN_ORDER', ( $data['sort'] == 'numberlearn' ) ? 'class="' . $order2 . '"' : '' );
$xtpl->assign( 'TYPE_ORDER', ( $data['sort'] == 'type_id' ) ? 'class="' . $order2 . '"' : '' );
$xtpl->assign( 'TEACHER_ORDER', ( $data['sort'] == 'teacher_id' ) ? 'class="' . $order2 . '"' : '' );
$xtpl->assign( 'WEIGHT_ORDER', ( $data['sort'] == 'weight' ) ? 'class="' . $order2 . '"' : '' );
$xtpl->assign( 'STATUS_ORDER', ( $data['sort'] == 'status' ) ? 'class="' . $order2 . '"' : '' );

if( $nv_Request->get_string( $module_data . '_success', 'session' ) )
{
	$xtpl->assign( 'SUCCESS', $nv_Request->get_string( $module_data . '_success', 'session' ) );
	$xtpl->parse( 'main.success' );
	$nv_Request->unset_request( $module_data . '_success', 'session' );
}

if( ! empty( $array ) )
{
	
	$getTypes = getTypes();	
	$getTeacher = getTeacher();
	
	foreach( $array as $item )
	{
		$item['price'] =  priceFormat( $item['price'] );
		$item['opening_day'] =  ( $item['opening_day'] ) ? date('d/m/Y H:i', $item['opening_day'] ) : '';
		
		$item['token'] = md5( $nv_Request->session_id . $global_config['sitekey'] . $item['class_id'] );
		
		$item['teacher'] = ( isset( $getTeacher[$item['teacher_id']] ) ) ? $getTeacher[$item['teacher_id']]['full_name'] : '';
		$item['type'] = ( isset( $getTypes[$item['type_id']] ) ) ? $getTypes[$item['type_id']]['title'] : '';
		$item['edit'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op . '&action=edit&token=' . $item['token'] . '&class_id=' . $item['class_id'];
		$item['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $item['alias'] . $global_config['rewrite_exturl'];
		
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
