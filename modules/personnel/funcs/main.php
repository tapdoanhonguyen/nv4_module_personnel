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

$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name;
$base_url_rewrite = nv_url_rewrite( $base_url, true );
$page_url_rewrite = ( $page > 1 ) ? nv_url_rewrite( $base_url . '/page-' . $page, true ) : $base_url_rewrite;
$request_uri = $_SERVER['REQUEST_URI'];
if( ! ( $home or $request_uri == $base_url_rewrite or $request_uri == $page_url_rewrite or NV_MAIN_DOMAIN . $request_uri == $base_url_rewrite or NV_MAIN_DOMAIN . $request_uri == $page_url_rewrite ) )
{
	$redirect = '<meta http-equiv="Refresh" content="3;URL=' . $base_url_rewrite . '" />';
	nv_info_die( $lang_global['error_404_title'], $lang_global['error_404_title'], $lang_global['error_404_content'] . $redirect, 404 );
}

$implode = array();
 
$db_slave->sqlreset()
		->select('COUNT(*)')
		->from( TABLE_PERSONNEL_NAME . '_personnel' );
 
$db_slave->where( implode( ' AND ', $implode ) );

$num_items = $db_slave->query( $db_slave->sql() )->fetchColumn();
 
$db_slave->select( '*' )
			->order( 'date_added DESC' )
			->limit( $perpage )
            ->offset( ( $page - 1 ) * $perpage );
 
$result = $db_slave->query( $db_slave->sql() );
$dataContent = array();
while( $item = $result->fetch() )
{
	// $item['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $item['alias'] . $global_config['rewrite_exturl'];

	/* if( $item['thumb'] == 1 )
	{
		// image thumb
		$item['image'] = NV_BASE_SITEURL . NV_FILES_DIR . '/' . $module_upload . '/' . $item['image'];
	}
	elseif( $item['thumb'] == 2 )
	{
		// image file
		$item['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $item['image'];
	}
	elseif( $item['thumb'] == 3 )
	{
		// image url
		$item['image'] = $item['image'];
	}
	else
	{
		// no image
		$item['image'] = '';
	} */


	$dataContent[] = $item;

}
$result->closeCursor();

$generatePage = nv_alias_page( $page_title, $base_url, $num_items, $perpage, $page );

$contents = ThemeViewDashboard( $dataContent, $generatePage );


include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';
