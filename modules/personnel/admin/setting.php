<?php

/**
 * @Project NUKEVIET 4.x
 * @Author ĐẶNG ĐÌNH TỨ (dlinhvan@gmail.com)
 * @Website https://nuke.vn - http://dangdinhtu.com
 * @Copyright (C) 2014 https://nuke.vn All rights reserved
 * @License GNU/GPL version 3 or any later version
 * @Createdate Fri, 30 Sep 2016 15:00:00 GMT
 */

if( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );
 
$page_title = $lang_module['setting'];
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
$savesetting = $nv_Request->get_int( 'savesetting', 'post', 0 );
if( ! empty( $savesetting ) )
{

	$getSetting = array();
	$getSetting['perpage'] = $nv_Request->get_int( 'perpage', 'post', 0 ); 
	$getSetting['employer_group'] = $nv_Request->get_int( 'employer_group', 'post', 0 ); 
	$getSetting['appapi'] = $nv_Request->get_string( 'appapi', 'post', 0 ); 
	$getSetting['perpage'] = !empty( $getSetting['perpage'] ) ? $getSetting['perpage'] : 1;
	// $getSetting['active_comment'] = $nv_Request->get_int( 'active_comment', 'post', 0 ); 
	// $getSetting['active_capcha'] = $nv_Request->get_int( 'active_comment', 'post', 0 ); 
	
   // $getSetting['notification_site'] = $nv_Request->get_editor( 'notification_site', '', NV_ALLOWED_HTML_TAGS );
    // $getSetting['notification_email'] = $nv_Request->get_editor( 'notification_email', '', NV_ALLOWED_HTML_TAGS );

	 
	$sth = $db->prepare( 'UPDATE ' . TABLE_PERSONNEL_NAME . '_setting SET config_value = :config_value WHERE config_name = :config_name');
	foreach( $getSetting as $config_name => $config_value )
	{
		$sth->bindParam( ':config_name', $config_name, PDO::PARAM_STR );
		$sth->bindParam( ':config_value', $config_value, PDO::PARAM_STR );
		$sth->execute();
	}
	$sth->closeCursor();
	
	$nv_Request->set_Session( $module_data . '_success', $lang_module['setting_update_success'] );

	$nv_Cache->delMod( $module_name );
	Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op . '&rand=' . nv_genpass() );
	die();
}

/* $getSetting['notification_site'] = htmlspecialchars( nv_editor_br2nl($getSetting['notification_site'] ) );

if( defined( 'NV_EDITOR' ) and nv_function_exists( 'nv_aleditor' ) )
{
	$getSetting['notification_site'] = nv_aleditor( 'notification_site', '100%', '300px', $getSetting['notification_site'], '', $moudulepath, $currentpath );
}
else
{
	$getSetting['notification_site'] = "<textarea class=\"form-control\" style=\"width: 100%\" name=\"notification_site\" id=\"' . $module_data . '_notification_site\" rows=\"8\">" . $data['notification_site'] . "</textarea>";
} 
 */

/* 
$getSetting['notification_email'] = htmlspecialchars( nv_editor_br2nl($getSetting['notification_email'] ) );

if( defined( 'NV_EDITOR' ) and nv_function_exists( 'nv_aleditor' ) )
{
	$getSetting['notification_email'] = nv_aleditor( 'notification_email', '100%', '300px', $getSetting['notification_email'], '', $moudulepath, $currentpath );
}
else
{
	$getSetting['notification_email'] = "<textarea class=\"form-control\" style=\"width: 100%\" name=\"notification_email\" id=\"' . $module_data . '_notification_email\" rows=\"8\">" . $data['notification_email'] . "</textarea>";
}  */

$groups_list = nv_groups_list();
unset($groups_list[1], $groups_list[2], $groups_list[3], $groups_list[4], $groups_list[5], $groups_list[7]);
$employer_group = $groups_list;
$xtpl = new XTemplate( 'setting.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'GLANG', $lang_global );
$xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'OP', $op );
$xtpl->assign( 'DATA', $getSetting  );
$xtpl->assign( 'LINK_COMMENT', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=comment&' . NV_OP_VARIABLE . '=config&mod_name=' . $module_name  );
$xtpl->assign( 'LINK_CAPTCHA', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=settings&' . NV_OP_VARIABLE . '=security#settingCaptcha'  );
 foreach ($employer_group as $group_id => $group_title) {
	$xtpl->assign('GROUP', [
		'group_id' => $group_id,
		'group_title' => $group_title,
		'selected' => $group_id == $getSetting['employer_group'] ? ' selected="selected"' : ''
	]);
	$xtpl->parse('main.employer_group');
}
if( $nv_Request->get_string( $module_data . '_success', 'session' ) )
{
	$xtpl->assign( 'SUCCESS', $nv_Request->get_string( $module_data . '_success', 'session' ) );

	$xtpl->parse( 'main.success' );

	$nv_Request->unset_request( $module_data . '_success', 'session' );

}
 
$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );
include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';