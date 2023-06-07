<?php
 
/**
 * @Project NUKEVIET 4.x
 * @Author DANGDINHTU (dlinhvan@gmail.com)
 * @Copyright (C) 2016 Nuke.vn. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Mon, 11 Jul 2016 09:00:15 GMT
 */

if( ! defined( 'NV_MAINFILE' ) )
{
	die( 'Stop!!!' );
}

if( ! nv_function_exists( 'nukevn_block_register' ) )
{ 
 
	function nukevn_block_register( $block_config, $module )
	{
		global  $module_info, $db, $nv_Cache, $lang_module, $global_config, $site_mods;
		
		$module = $block_config['module'];
		
		if( file_exists( NV_ROOTDIR . '/modules/' . $site_mods[$module]['module_file'] . '/language/' . NV_LANG_DATA . '.php' ) )
		{
			include NV_ROOTDIR . '/modules/' . $site_mods[$module]['module_file'] . '/language/' . NV_LANG_DATA . '.php';
		}
		else
		{
			include NV_ROOTDIR . '/modules/' . $site_mods[$module]['module_file'] . '/language/vi.php';
		}
		
		if( file_exists( NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $site_mods[$module]['module_file'] . '/BlockRegister.tpl' ) )
		{
			$block_theme = $global_config['module_theme'];
		}
		else
		{
			$block_theme = 'default';
		}

		$xtpl = new XTemplate( 'BlockRegister.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/' . $site_mods[$module]['module_file'] );
		$xtpl->assign( 'LANG', $lang_module );
		$xtpl->assign( 'MODULE_NAME', $module );
		$xtpl->assign( 'TEMPLATE', $block_theme );
 
		$services = $nv_Cache->db( 'SELECT service_id, service_name, image FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_service WHERE status=1 ORDER BY weight ASC', '', $module );	
		
		if( !empty( $services ) )
		{
			foreach( $services as $service )
			{	
				$service['image'] = NV_BASE_SITEURL .  NV_UPLOADS_DIR . '/' . $site_mods[$module]['module_upload'] . '/' . $service['image'];
				$xtpl->assign( 'SERVICE', $service );
				$xtpl->parse( 'main.service' );
			}
			
		}
		
		$dataContent = $nv_Cache->db( 'SELECT config_name, config_value FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_setting', 'config_name', $module );

		$getSetting = array();

		foreach( $dataContent as $row )
		{
			$getSetting[$row['config_name']] = $row['config_value'];
		}

		unset($dataContent);
		
		$xtpl->assign( 'CONFIG', $getSetting );
		$xtpl->assign( 'TODAY', date('d/m/Y', NV_CURRENTTIME ) );
		
		
		$booking_time = explode( '-', $getSetting['booking_time'] );
	
		$begintime = isset( $booking_time[0] ) ? intval( $booking_time[0] ) : 0;
		$endtime = isset( $booking_time[1] ) ? $booking_time[1] : 0;
		
		
		$list_time = array();
		if( !empty( $begintime ) && !empty( $endtime ) )
		{
			
			
			preg_match( '/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', date('d/m/Y', NV_CURRENTTIME), $m );
			
			$date_from = mktime( $begintime, 0, 0, $m[2], $m[1], $m[3] );
			$date_to = mktime( $endtime, 23, 59, $m[2], $m[1], $m[3] );
			
			while( $date_from <= $date_to )
			{
				$list_time[] = date( 'H:i', $date_from );
				
				$date_from = $date_from + ( $getSetting['space_time'] * 60 );
		
			}
			
		}
	 
		if( $list_time )
		{
			$i = 0;
			foreach( $list_time as $key => $time )
			{
				
				$xtpl->assign( 'ACTIVE', ( $i == 0 ) ? ' class="timing-list-active" ' : '' );
				$xtpl->assign( 'TIME', $time );
				$xtpl->parse( 'main.time1' );
				$xtpl->parse( 'main.time2' );
				++$i;
			}
		}
		
		
		$xtpl->parse( 'main' );
		return $xtpl->text( 'main' );
		 
	}

	 
}

if( defined( 'NV_SYSTEM' ) )
{
	global $site_mods, $module_name, $nv_Cache;
	$module = $block_config['module'];
	if( isset( $site_mods[$module] ) )
	{
		$content = nukevn_block_register( $block_config, $module );
	}
}
