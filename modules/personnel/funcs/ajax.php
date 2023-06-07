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
ini_set('display_errors',1);

error_reporting( 1 );

// khai bao thong so lam viec
 
error_reporting(E_ALL);

if( ACTION_METHOD == 'removeFile' )
{
	
	$token = $nv_Request->get_title( 'token', 'post', '' );
	$attachment_id = $nv_Request->get_int( 'attachment_id', 'post', 0 );
	
	if ( $token == md5( $nv_Request->session_id . $global_config['sitekey'] . $attachment_id ) )
	{
		$sql = 'SELECT attachment_id, rid, newname FROM ' . $db_config['prefix'] . '_attachment WHERE attachment_id=' . $attachment_id;
		$result = $db->query( $sql );
		list( $attachment_id, $rid, $newname ) = $result->fetch( 3 );
		
		
		
		$folder = floor( $attachment_id / 1000 );

		if ( $rid == 0 && $attachment_id > 0)
		{
			$db->query( 'DELETE FROM ' . $db_config['prefix'] . '_attachment WHERE attachment_id =' . $attachment_id );
			if ( ! empty( $newname ) and is_file( NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/attachment/' . $folder . '/' . $newname ) )
			{
				@nv_deletefile( NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/attachment/' . $folder . '/' . $newname );
				$json['attachment_id'] = $attachment_id;
				$json['success'] = 'OK';
			}
		}
		else
		{
			$db->query( 'DELETE FROM ' . $db_config['prefix'] . '_attachment WHERE attachment_id =' . $attachment_id );
			$json['success'] = 'OK';
			$json['attachment_id'] = $attachment_id;
		}
	}
	else
	{
		$json['error'] = 'Lỗi bảo mật thao tác bị dùng lại';
	}
	nv_jsonOutput( $json );
}

if( ACTION_METHOD == 'address' )
{
 
	$address = $nv_Request->get_string( 'q', 'post', '');
	
	$address = array_map('trim', explode( ',', $address ) );
	$address = array_filter( $address );
	$address = array_unique( $address );

	$implode = array();
	$implode[] = 'status=1';
	
	if( !empty( $address ) )
	{
		foreach( $address as $key => $add )
		{
			
			$implode[] = '( CONCAT(title,\', \', address) LIKE :address'. $key .' )';
		}
	}
	
	$sql = 'SELECT ward_id, CONCAT(title,\', \', address) AS address FROM ' . TABLE_LOCATION_NAME . '_ward';
 
	if( !empty( $implode ) )
	{
		$sql .= ' WHERE ' . implode( ' AND ', $implode );
	}		
	
	$sql .= ' ORDER BY address ASC LIMIT 0, 100';
 	
 
	$sth = $db->prepare( $sql );
	
	if( ! empty( $address ) )
	{
		foreach( $address as $key => $add )
		{
			$sth->bindValue( ':address'. $key, "%".$add."%" );
		}
		
	}

	$sth->execute();
	while( list( $ward_id, $address ) = $sth->fetch( 3 ) )
	{
		$json['data'][] = array( 'id' => $ward_id, 'text' => nv_htmlspecialchars( $address ) );
	}
 
	nv_jsonOutput( $json );
}

if( ACTION_METHOD == 'signer' )
{
 
	$keyword = $nv_Request->get_string( 'q', 'post', '');
	if( !empty( $keyword ) )
	{
		$implode = array();
		$implode[] = 'full_name LIKE :full_name';
	}
	$sql = 'SELECT personnel_id, full_name FROM ' . TABLE_PERSONNEL_NAME . '_personnel';
 
	if( !empty( $implode ) )
	{
		$sql .= ' WHERE ' . implode( ' AND ', $implode );
	}		
	
	$sql .= ' ORDER BY full_name ASC LIMIT 0, 200';

	$sth = $db->prepare( $sql );
	
	if( ! empty( $implode ) )
	{
		$sth->bindValue( ':full_name', '%'.$keyword.'%' );
		
	}
	$sth->execute();
	while( list( $personnel_id, $full_name ) = $sth->fetch( 3 ) )
	{
		$json['data'][] = array( 'id' => $personnel_id, 'text' => nv_htmlspecialchars( $full_name ) );
	}
 
	nv_jsonOutput( $json );
}

if( ACTION_METHOD == 'registermedical' )
{
 
	$province_id = $nv_Request->get_int( 'province_id', 'post', 0);
	if( $province_id > 0 )
	{
		$implode = array();
		$implode[] = 'province_id=' . $province_id;
 
		$sql = 'SELECT registermedical_id, title FROM ' . TABLE_PERSONNEL_NAME . '_registermedical';
	 
		if( !empty( $implode ) )
		{
			$sql .= ' WHERE ' . implode( ' AND ', $implode );
		}		
		
		$sql .= ' ORDER BY title ASC LIMIT 0, 200';

		$sth = $db->prepare( $sql );
		$sth->execute();
		while( list( $registermedical_id, $title ) = $sth->fetch( 3 ) )
		{
			$json['data'][] = array( 'id' => $registermedical_id, 'text' => nv_htmlspecialchars( $title ) );
		}
 	
	}
 
	nv_jsonOutput( $json );
}



if( ACTION_METHOD == 'getForm' )
{
	$token = $nv_Request->get_title( 'token', 'post', '');
	$class_id = $nv_Request->get_int( 'class_id', 'post', 0);
	if( $token == md5( $nv_Request->session_id . $global_config['sitekey'] . $class_id ) )
	{
		$dataContent = $db->query('SELECT * FROM ' . TABLE_PERSONNEL_NAME . '_class WHERE class_id=' . intval( $class_id ) )->fetch();
		$teacherList = $db->query('SELECT teacher_id, full_name, birthday, photo, experience FROM ' . TABLE_PERSONNEL_NAME . '_teacher WHERE teacher_id=' . intval( $dataContent['teacher_id'] ) )->fetch();
		$dataContent['teacher_photo'] = NV_BASE_SITEURL . NV_UPLOADS_DIR  . '/' . $module_upload . '/' . $teacherList['photo'];
		$dataContent['teacher_name'] = $teacherList['full_name'];
		$dataContent['teacher_year'] = $teacherList['birthday'];
		$dataContent['teacher_experience'] = $teacherList['experience'];
		
		$json['title'] = $dataContent['class_name'];
		
		$json['template'] = ThemeViewClassRegister( $dataContent );
 
	}
	else
	{
		$json['error'] = $lang_module['class_error_security'];
	}
 
	nv_jsonOutput( $json );
	
}


$token = $nv_Request->get_title( 'token', 'post', '');
$data['class_id'] = $nv_Request->get_int( 'class_id', 'post', 0);
if( $token == md5( $nv_Request->session_id . $global_config['sitekey'] . $data['class_id'] ) )
{
 
	$data['full_name'] = nv_substr( $nv_Request->get_title( 'full_name', 'post', '', '' ), 0, 250 );
	$data['phone'] = nv_substr( $nv_Request->get_title( 'phone', 'post', '', '' ), 0, 250 );
	$data['email'] = nv_substr( $nv_Request->get_title( 'email', 'post', '', '' ), 0, 250 );
 
	$error = array();
	if( empty( $data['full_name'] ) ) $error['full_name'] = $lang_module['item_full_name_empty'];
	if( empty( $data['phone'] ) ) $error['phone'] = $lang_module['item_phone_empty'];
	if( empty( $data['email'] ) ) $error['email'] = $lang_module['item_email_empty'];
	if( empty( $data['class_id'] ) ) $error['class_id'] = $lang_module['item_error_class_empty'];
	 
	if( ! nv_capcha_txt( ( $global_config['captcha_type'] == 2 ? $nv_Request->get_title( 'g-recaptcha-response', 'post', '' ) : $nv_Request->get_title( 'captcha', 'post', '' ) ) ) )
	{
		nv_jsonOutput( array(
			'status' => 'error',
			'input' => ( $global_config['captcha_type'] == 2 ? '' : 'captcha' ),
			'mess' => ( $global_config['captcha_type'] == 2 ? $lang_global['securitycodeincorrect1'] : $lang_global['securitycodeincorrect'] ) ) );
	}
	if( empty( $error ) )
	{
		
		try
		{
			
			$dataContent = $db->query('SELECT * FROM ' . TABLE_PERSONNEL_NAME . '_class WHERE class_id=' . intval( $data['class_id'] ) )->fetch();
			$teacherList = $db->query('SELECT teacher_id, full_name, birthday, photo, experience FROM ' . TABLE_PERSONNEL_NAME . '_teacher WHERE teacher_id=' . intval( $dataContent['teacher_id'] ) )->fetch();
			$dataContent['teacher_photo'] = NV_BASE_SITEURL . NV_UPLOADS_DIR  . '/' . $module_upload . '/' . $teacherList['photo'];
			$dataContent['teacher_name'] = $teacherList['full_name'];
			$dataContent['teacher_year'] = $teacherList['birthday'];
			$dataContent['teacher_experience'] = $teacherList['experience'];
			
			
			$stmt = $db->prepare( 'INSERT INTO ' .  NV_PREFIXLANG . '_' . $module_data . '_item SET 
				full_name=:full_name,
				email=:email,
				phone=:phone,
				class_id=:class_id,
				date_added=' . intval( NV_CURRENTTIME ) );

			$stmt->bindParam( ':full_name', $data['full_name'], PDO::PARAM_STR );
			$stmt->bindParam( ':email', $data['email'], PDO::PARAM_STR );
			$stmt->bindParam( ':phone', $data['phone'], PDO::PARAM_STR );
			$stmt->bindParam( ':class_id', $data['class_id'], PDO::PARAM_INT );

			$stmt->execute();

			if( $data['item_id'] = $db->lastInsertId() )
			{
				$sender_id = intval( defined( 'NV_IS_USER' ) ? $user_info['userid'] : 0 );
				
				nv_insert_notification( $module_name, 'Học viên mới', array( 'full_name' => $data['full_name'], 'class_name' => $dataContent['class_name'] ), $data['item_id'], 0, $sender_id, 1 );
				
				$from = array(
					$global_config['site_name'],
					$global_config['site_email']
				);
				
				
				$dataContent['full_name'] = $data['full_name'];
				$dataContent['email'] = $data['email'];
				$dataContent['phone'] = $data['phone'];
 
				$message = ThemeViewClassEmail( $dataContent );
				
				if ( @nv_sendmail( $from, $data['email'], $dataContent['class_name'], $message, '', false ) ) 
				{
					$json['mess'] =  sprintf( $lang_module['thankyou_email'], $dataContent['class_name'] );;
				}
				else
				{
					$json['mess'] = $lang_module['thankyou'];
				}
			}
		}
		catch ( PDOException $e )
		{
			$error['save'] = $lang_module['item_error_save'];
			// var_dump( $e ); die();
		}	
	}
	
	$json['error'] = $error;
}
else
{
	$json['error'] = $lang_module['class_error_security'];
}


nv_jsonOutput( $json );