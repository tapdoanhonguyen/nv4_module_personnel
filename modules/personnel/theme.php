<?php

/**
 * @Project NUKEVIET 4.x
 * @Author DANGDINHTU (dlinhvan@gmail.com)
 * @Copyright (C) 2016 Nuke.vn. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Mon, 11 Jul 2016 09:00:15 GMT
 */

if( ! defined( 'NV_IS_MOD_PERSONNEL' ) ) die( 'Stop!!!' );

function ThemeViewDashboard( $dataContent, $teacherList )
{
	global $getSetting, $nv_Request, $getCategory, $getTypes, $client_info, $lang_module, $lang_global, $module_info, $module_name, $module_file, $global_config, $user_info, $op;
	$xtpl = new XTemplate( 'ThemeViewDashboard.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
	$xtpl->assign( 'TEMPLATE', $module_info['template'] );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'GLANG', $lang_global );
	$xtpl->assign( 'SELFURL', $client_info['selfurl'] );
	$xtpl->assign( 'CONFIG', $getSetting );

	foreach ( $dataContent as $key => $category ) 
	{
		if ( isset( $dataContent[$key]['content'] ) ) 
		{
			$xtpl->assign('CATEGORY', $category );
			if ( $category['subcatid'] != '' )
			{
				$_arr_subcat = explode( ',', $category['subcatid'] );
				$limit = 0;
				foreach ( $_arr_subcat as $category_id_i )
				{
					if ( $getCategory[$category_id_i]['status'] == 1 )
					{
						$xtpl->assign( 'SUBCAT', $getCategory[$category_id_i] );
						$xtpl->parse( 'main.category.subcatloop' );
						$limit++;
					}
					if ( $limit >= 3 )
					{
						$more = array( 'title' => $lang_module['more'], 'link' => $getCategory[$data['category_id']]['link'] );
						$xtpl->assign( 'MORE', $more );
						$xtpl->parse( 'main.category.subcatmore' );
						break;
					}
				}
			}

	    
			foreach ( $dataContent[$key]['content'] as $loop )
			{
				$loop['title_cut'] = nv_clean60( $loop['class_name'], 40 );
				$loop['type'] = isset( $getTypes[$loop['type_id']] ) ? $getTypes[$loop['type_id']]['title'] : '';
				$loop['teacher'] = isset( $teacherList[$loop['teacher_id']] ) ? $teacherList[$loop['teacher_id']] : '';
				$loop['price'] = priceFormat( $loop['price'] );
				
				$xtpl->assign( 'LOOP', $loop );

				$xtpl->parse( 'main.category.loop' );

			}
			$xtpl->parse( 'main.category' );
		}
	}

	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

function ThemeViewWorkforce( $dataCount )
{
	global $getSetting, $nv_Request, $arrayWorkforceTab, $getCategory, $getTypes, $client_info, $lang_module, $lang_global, $module_info, $module_name, $module_file, $global_config, $user_info, $op;
	$xtpl = new XTemplate( 'ThemeViewWorkforce.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
	$xtpl->assign( 'TEMPLATE', $module_info['template'] );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'GLANG', $lang_global );
	$xtpl->assign( 'SELFURL', $client_info['selfurl'] );
	$xtpl->assign( 'CONFIG', $getSetting );
	$xtpl->assign( 'JSONFILE', getDataJson() );
	
	$xtpl->assign( 'REGISTER_URL', nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=register', true ) );
	
	foreach( $arrayWorkforceTab as $key => $tab )
	{
 
		$xtpl->assign( 'TAB', array( 'key'=> $key, 'title'=> $tab, 'total'=> isset( $dataCount[$key] ) ? intval( $dataCount[$key] ) : 0, 'active'=> ( $key == 1 ) ? 'active' : '', 'active2'=> ( $key == 1 ) ? 'show active' : '' ) );
		$xtpl->parse( 'main.tab' );	
		$xtpl->parse( 'main.tabcontent' );	
	}
	
	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

function ThemeViewWorkforceExport( )
{
	global $getSetting, $arrayWorkforcetExport,  $nv_Request, $getCategory, $getTypes, $client_info, $lang_module, $lang_global, $module_info, $module_name, $module_file, $global_config, $user_info, $op;
	$xtpl = new XTemplate( 'ThemeViewWorkforceExport.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
	$xtpl->assign( 'TEMPLATE', $module_info['template'] );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'GLANG', $lang_global );
	$xtpl->assign( 'SELFURL', $client_info['selfurl'] );
	$xtpl->assign( 'TOKENKEY', md5( $nv_Request->session_id ) );
	$xtpl->assign( 'TOKEN', $nv_Request->session_id . $global_config['sitekey'] );
	
	foreach( $arrayWorkforcetExport as $key => $titlelang )
	{
		$xtpl->assign( 'EXPORT', array('key'=> $key, 'title'=> $titlelang ) );
		$xtpl->parse( 'main.export' );
 	}
	
	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

function ThemeViewInsurrance( )
{
	global $getSetting, $arrayInsurranceExport,  $nv_Request, $getCategory, $getTypes, $client_info, $lang_module, $lang_global, $module_info, $module_name, $module_file, $global_config, $user_info, $op;
	$xtpl = new XTemplate( 'ThemeViewInsurrance.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
	$xtpl->assign( 'TEMPLATE', $module_info['template'] );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'GLANG', $lang_global );
	$xtpl->assign( 'SELFURL', $client_info['selfurl'] );
	$xtpl->assign( 'CONFIG', $getSetting );
	$xtpl->assign( 'JSONFILE', getDataJson() );
	$xtpl->assign( 'DAY', date('m/Y', NV_CURRENTTIME) );
	
 
	
	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

function ThemeViewInsurranceExport( )
{
	global $getSetting, $arrayInsurranceExport,  $nv_Request, $getCategory, $getTypes, $client_info, $lang_module, $lang_global, $module_info, $module_name, $module_file, $global_config, $user_info, $op;
	$xtpl = new XTemplate( 'ThemeViewInsurranceExport.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
	$xtpl->assign( 'TEMPLATE', $module_info['template'] );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'GLANG', $lang_global );
	$xtpl->assign( 'SELFURL', $client_info['selfurl'] );
	$xtpl->assign( 'TOKENKEY', md5( $nv_Request->session_id ) );
	$xtpl->assign( 'TOKEN', $nv_Request->session_id . $global_config['sitekey'] );
	
	foreach( $arrayInsurranceExport as $key => $titlelang )
	{
		$xtpl->assign( 'EXPORT', array('key'=> $key, 'title'=> $titlelang ) );
		$xtpl->parse( 'main.export' );
 	}
	
	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

function ThemeViewContract( $datatab, $dataCount )
{
	global $getSetting, $nv_Request, $getData, $getTypes, $client_info, $lang_module, $lang_global, $module_info, $module_name, $module_file, $global_config, $user_info, $op;
	$xtpl = new XTemplate( 'ThemeViewContract.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
	$xtpl->assign( 'TEMPLATE', $module_info['template'] );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'GLANG', $lang_global );
	$xtpl->assign( 'SELFURL', $client_info['selfurl'] );
	$xtpl->assign( 'CONFIG', $getSetting );
	$xtpl->assign( 'JSONFILE', getDataJson() );
	
	$count = 0;
	foreach( $datatab as $key => $tab )
	{
 
		$xtpl->assign( 'TAB', array( 'key'=> $key, 'title'=> $tab['t'], 'total'=> isset( $dataCount[$key] ) ? intval( $dataCount[$key] ) : 0, 'active'=> ( $count == 0 ) ? 'active' : '', 'active2'=> ( $count == 0 ) ? 'show active' : '' ) );
		$xtpl->parse( 'main.tab' );	
		$xtpl->parse( 'main.tabcontent' );
		++$count;		
	}
	 
	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}
 
function ThemeViewContractExport( )
{
	global $getSetting, $arrayContractExport,  $nv_Request, $getCategory, $getTypes, $client_info, $lang_module, $lang_global, $module_info, $module_name, $module_file, $global_config, $user_info, $op;
	$xtpl = new XTemplate( 'ThemeViewContractExport.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
	$xtpl->assign( 'TEMPLATE', $module_info['template'] );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'GLANG', $lang_global );
	$xtpl->assign( 'SELFURL', $client_info['selfurl'] );
	$xtpl->assign( 'TOKENKEY', md5( $nv_Request->session_id ) );
	$xtpl->assign( 'TOKEN', $nv_Request->session_id . $global_config['sitekey'] );
	
	foreach( $arrayContractExport as $key => $titlelang )
	{
		$xtpl->assign( 'EXPORT', array('key'=> $key, 'title'=> $titlelang ) );
		$xtpl->parse( 'main.export' );
 	}
	
	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

function ThemeViewRegister( $dataContent, $dataJson, $dataAddress )
{
	global $getSetting, $arrayGender, $arrayYesNo, $statusIdentityCard, $resignToBill, $arrayMarital, $arrayWorkType, $nv_Request, $category_id, $getCategory, $getTypes, $client_info, $lang_module, $lang_global, $module_info, $module_name, $module_file, $global_config, $user_info, $op;
	$xtpl = new XTemplate( 'ThemeViewRegister.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'GLANG', $lang_global );
	$xtpl->assign( 'SELFURL', $client_info['selfurl'] );
	$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
	$xtpl->assign( 'TEMPLATE', $module_info['template'] );
	$xtpl->assign( 'NV_LANG_DATA', NV_LANG_DATA );
	$xtpl->assign( 'JSONFILE', getDataJson() );
	$xtpl->assign( 'TOKEN', md5( $client_info['session_id'] . $global_config['sitekey'] ) );
	$xtpl->assign( 'DATA', $dataContent );
	$xtpl->assign( 'JSONDATA', json_encode( $dataJson ) );
	$xtpl->assign( 'LIST_PERSOLNEL', nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=workforce', true ) );
	
	$xtpl->assign( 'family_row', count( $dataContent['family'] ) );
	$xtpl->assign( 'degrees_row', count( $dataContent['degrees'] ) );
	$xtpl->assign( 'experience_row', count( $dataContent['experience'] ) );
	$xtpl->assign( 'salary_row', count( $dataContent['allowances'] ) );
	$xtpl->assign( 'history_row', count( $dataContent['historyInsurances'] ) );
	$xtpl->assign( 'solves_row', count( $dataContent['historySolves'] ) );
	
	
	if( $dataContent['personnel_id'] == 0 )
	{
		$xtpl->assign( 'PESOLNEL_ACTION', $lang_module['register_create'] );
		$xtpl->parse( 'main.empty_data' );
		$xtpl->parse( 'main.add' );
		
		
	}
	else
	{
		$xtpl->assign( 'PESOLNEL_ACTION', $lang_module['register_update'] );
		$xtpl->parse( 'main.exist_data' );	
	}
	if( isset( $dataContent['family'] ) )
	{
		foreach( $dataContent['family'] as $key => $item )
		{ 
			$item['key'] = $key;
			$xtpl->assign( 'FAMILY', $item );
			$xtpl->parse( 'main.family' );
 
		}
		
	}
	if( isset( $dataContent['degrees'] ) )
	{
		foreach( $dataContent['degrees'] as $key => $item )
		{ 
			$item['key'] = $key;
			$xtpl->assign( 'DEGREES', $item );
			$xtpl->parse( 'main.degrees' );
 
		}
		
	}
	if( isset( $dataContent['experience'] ) )
	{
		foreach( $dataContent['experience'] as $key => $item )
		{ 
			$item['key'] = $key;
			$xtpl->assign( 'EXPERIENCE', $item );
			$xtpl->parse( 'main.experience' );
 
		}
		
	}
	if( isset( $dataContent['allowances'] ) )
	{
		foreach( $dataContent['allowances'] as $key => $item )
		{ 
			$item['key'] = $key;
			$xtpl->assign( 'ALLOWANCES', $item );
			$xtpl->parse( 'main.allowances' );
 
		}
		
	}
	if( isset( $dataContent['historyInsurances'] ) )
	{
		foreach( $dataContent['historyInsurances'] as $key => $item )
		{ 
			$item['key'] = $key;
			$xtpl->assign( 'HISTORYINSURANCES', $item );
			$xtpl->parse( 'main.historyinsurances' );
 
		}
		
	}
	if( isset( $dataContent['historySolves'] ) )
	{
		foreach( $dataContent['historySolves'] as $key => $item )
		{ 
 
			$item['key'] = $key;
			$xtpl->assign( 'HISTORYSOLVES', $item );
			$xtpl->parse( 'main.historySolves' );
 
		}
		
	}
 
	
	if( isset( $dataContent['attachments'] ) )
	{
		foreach( $dataContent['attachments'] as $key => $item )
		{ 

			$item['ext']= nv_getextension( $item['basename'] );
			$item['size']= nv_convertfromBytes( $item['size'] );
			$item['token'] = md5( $nv_Request->session_id . $global_config['sitekey'] . $item['attachment_id'] );
 
			$item['key'] = $key;
			$xtpl->assign( 'ATTACHMENTS', $item );
			$xtpl->parse( 'main.attachments' );
 
		}
 	
		
	}
	
	$xtpl->assign( 'COUNT_ATTACHMENTS', count( $dataContent['attachments'] ) );
			
	if( $dataContent['signer_id'] )
	{
 
		$xtpl->assign( 'SIGNER', array(
				'key' => $dataContent['signer_id'],
				'name' => $dataContent['signer_name'],
				'selected' => 'selected="selected"' ) );
		$xtpl->parse( 'main.signer' );
 
	}
	
	if( isset( $dataAddress[$dataContent['place_current']] ) )
	{
		foreach( $dataAddress[$dataContent['place_current']] as $key => $val )
		{ 
			
			$xtpl->assign( 'PLACE_CURRENT', array(
					'key' => $val['ward_id'],
					'name' => $val['address'],
					'selected' => $key == $dataContent['place_current'] ? ' selected="selected"' : '' ) );
			$xtpl->parse( 'main.place_current' );
 
		}
		
	}
	
	if( isset( $dataAddress[$dataContent['place_home']] ) )
	{
		foreach( $dataAddress[$dataContent['place_home']] as $key => $val )
		{
			
			$xtpl->assign( 'PLACE_HOME', array(
					'key' => $val['ward_id'],
					'name' => $val['address'],
					'selected' => $key == $dataContent['place_home'] ? ' selected="selected"' : '' ) );
			$xtpl->parse( 'main.place_home' );
 		
 
		}
		
	}
	
	if( isset( $dataAddress[$dataContent['premium_place']] ) )
	{
		foreach( $dataAddress[$dataContent['place_home']] as $key => $val )
		{
			
			$xtpl->assign( 'PREMIUM_PLACE', array(
					'key' => $val['ward_id'],
					'name' => $val['address'],
					'selected' => $key == $dataContent['place_home'] ? ' selected="selected"' : '' ) );
			$xtpl->parse( 'main.place_home' );
 		
 
		}
		
	}
	
	for( $level_school=1; $level_school<=12; ++$level_school )
	{
		$xtpl->assign( 'LEVEL_SCHOOL', array(
				'key' => $level_school,
				'name' => $level_school . '/12',
				'selected' => $level_school == $dataContent['level_school'] ? ' selected="selected"' : '' ) );
		$xtpl->parse( 'main.level_school' );
	}
 
	foreach( $arrayGender as $key => $val)
	{
		
		$xtpl->assign( 'GENDER', array(
				'key' => $key,
				'name' => $val,
				'selected' => $key == $dataContent['gender'] ? ' selected="selected"' : '' ) );
		$xtpl->parse( 'main.gender' );
 	
	}
	foreach( $dataContent['users'] as $key => $val)
	{
		
		$xtpl->assign( 'USER', array(
				'key' => $key,
				'name' => $val['username'],
				'selected' => $key == $dataContent['userid'] ? ' selected="selected"' : '' ) );
		$xtpl->parse( 'main.userid' );
 	
	}
	foreach( $arrayMarital as $key => $val)
	{
		
		$xtpl->assign( 'MARITAL', array(
				'key' => $key,
				'name' => $val,
				'selected' => $key == $dataContent['marital_status'] ? ' selected="selected"' : '' ) );
		$xtpl->parse( 'main.marital' );
 	
	}
 
	foreach( $statusIdentityCard as $key => $val)
	{
		
		$xtpl->assign( 'IDENTITYCARD', array(
				'key' => $key,
				'name' => $val,
				'checked' => in_array( $key, $dataContent['status_identity_card'] ) ? ' checked="checked"' : '' ) );
		$xtpl->parse( 'main.identitycard' );
 	
	}
	
	foreach( $resignToBill as $key => $val)
	{
		
		$xtpl->assign( 'RESIGNTOBILL', array(
				'key' => $key,
				'name' => $val,
				'checked' => in_array( $key, $dataContent['resign_to_bill'] ) ? ' checked="checked"' : '' ) );
		$xtpl->parse( 'main.resigntobill' );
 	
	}
	
	
	
	
	$arrayDepartment = getDepartment();
	foreach( $arrayDepartment as $key => $val)
	{
		if( $key > 6 )
		{
			$xtpl->assign( 'DEPARTMENT', array(
					'key' => $key,
					'name' => $val['title'],
					'selected' => $key == $dataContent['department_id'] ? ' selected="selected"' : '' ) );
			$xtpl->parse( 'main.department' );
		}
		
 	
	}
 
	foreach( $arrayWorkType as $key => $val)
	{
		
		$xtpl->assign( 'WORK_TYPE', array(
				'key' => $key,
				'name' => $val,
				'selected' => $key == $dataContent['work_type'] ? ' selected="selected"' : '' ) );
		$xtpl->parse( 'main.work_type' );
		
		
 	
	}
	
	// $getData = getData( );
	
	// foreach( $dataContent['family'] as $key => $family )
	// {
		// $family['key'] = $key;
		
		// $xtpl->assign( 'FAMILY', $family);
		/* foreach( $getData['family'] as $key => $val )
		{
			
			$xtpl->assign( 'RELATIVE', array(
					'key' => $key,
					'name' => $val['t'] ) );
			$xtpl->parse( 'main.relative' );
		} */
		// foreach( $arrayYesNo as $key => $val)
		// {
			
			// $xtpl->assign( 'DEPENDENT', array(
					// 'key' => $key,
					// 'name' => $val ) );
			// $xtpl->parse( 'main.dependent' );
		// }
		// $xtpl->parse( 'main.family' );
	// }
	
	/* foreach( $dataContent['degrees'] as $key => $degrees )
	{
		$degrees['key'] = $key;
		
		$xtpl->assign( 'DEGREES', $degrees);
		foreach( $getData['type'] as $key => $val )
		{
			
			$xtpl->assign( 'TYPE', array(
					'key' => $key,
					'name' => $val['t'],
					'selected' => $key == $degrees['type_id'] ? ' selected="selected"' : '' ) );
			$xtpl->parse( 'main.degrees.type' );
		}
		foreach( $getData['level'] as $key => $val )
		{
			
			$xtpl->assign( 'LEVEL', array(
					'key' => $key,
					'name' => $val['t'],
					'selected' => $key == $degrees['level_id'] ? ' selected="selected"' : '' ) );
			$xtpl->parse( 'main.degrees.level' );
		}
		 
		$xtpl->parse( 'main.degrees' );
	} */
	
	
	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

function ThemeViewDetail( )
{
	global $getSetting, $getTypes, $nv_Request, $client_info, $lang_module, $lang_global, $module_info, $module_name, $module_file, $global_config, $user_info, $op;
	$xtpl = new XTemplate( 'ThemeViewDetail.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'GLANG', $lang_global );
	$xtpl->assign( 'SELFURL', $client_info['selfurl'] );
 
	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

function ThemeViewClassEmail( $dataContent  )
{
	global $getSetting, $nv_Request, $teacherList, $client_info, $lang_module, $lang_global, $module_info, $module_name, $module_file, $global_config, $user_info, $op;
	$xtpl = new XTemplate( 'ThemeViewClassEmail.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'GLANG', $lang_global );
	$xtpl->assign( 'SELFURL', $client_info['selfurl'] );
	
	$getTypes = getTypes();
	
	$dataContent['type'] = isset( $getTypes[$dataContent['type_id']] ) ? $getTypes[$dataContent['type_id']]['title'] : '';
	$dataContent['teacher'] = isset( $teacherList[$dataContent['teacher_id']] ) ? $teacherList[$dataContent['teacher_id']] : '';
	$dataContent['price'] = priceFormat( $dataContent['price'] );
	$dataContent['register_sucess'] = sprintf( $lang_module['item_register_sucess'], $dataContent['full_name'], $dataContent['class_name'] );
	$dataContent['opening_day'] = date('d/m/Y H:i', $dataContent['opening_day']);
	$dataContent['date_added'] = date('d/m/Y H:i', $dataContent['date_added']);
	
	$xtpl->assign( 'DATA', $dataContent );
	
	 
 
	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

function ThemeViewClassRegister( $dataContent  )
{
	global $getSetting, $getTypes, $nv_Request, $client_info, $lang_module, $lang_global, $module_info, $module_name, $module_file, $global_config, $user_info, $op;
	$xtpl = new XTemplate( 'ThemeViewClassRegister.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'GLANG', $lang_global );
	$xtpl->assign( 'SELFURL', $client_info['selfurl'] );
	$dataContent['token'] = md5( $nv_Request->session_id . $global_config['sitekey'] . $dataContent['class_id'] );
	$dataContent['title_cut'] = nv_clean60( $dataContent['class_name'], 40 );
	$dataContent['type'] = isset( $getTypes[$dataContent['type_id']] ) ? $getTypes[$dataContent['type_id']]['title'] : '';
	$dataContent['teacher'] = isset( $teacherList[$dataContent['teacher_id']] ) ? $teacherList[$dataContent['teacher_id']] : '';
	$dataContent['price'] = priceFormat( $dataContent['price'] );
	$dataContent['opening_day'] = date('d/m/Y H:i', $dataContent['opening_day']);

	$xtpl->assign( 'DATA', $dataContent );
	$xtpl->assign('USER_REGISTER', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '='. $module_name .'&amp;' . NV_OP_VARIABLE . '=ajax');
	$xtpl->assign('NICK_MAXLENGTH', $global_config['nv_unickmax']);
	$xtpl->assign('NICK_MINLENGTH', $global_config['nv_unickmin']);
	$xtpl->assign('PASS_MAXLENGTH', $global_config['nv_upassmax']);
	$xtpl->assign('PASS_MINLENGTH', $global_config['nv_upassmin']);
	$xtpl->assign('GFX_WIDTH', NV_GFX_WIDTH);
	$xtpl->assign('GFX_HEIGHT', NV_GFX_HEIGHT);
	$xtpl->assign('GFX_MAXLENGTH', NV_GFX_NUM);
	$xtpl->assign('N_CAPTCHA', $lang_global['securitycode']);
	$xtpl->assign('CAPTCHA_REFRESH', $lang_global['captcharefresh']);
	$xtpl->assign('SRC_CAPTCHA', NV_BASE_SITEURL . 'index.php?scaptcha=captcha&t=' . NV_CURRENTTIME);
	
	if( $global_config['captcha_type'] == 2 )
	{
		$xtpl->assign( 'RECAPTCHA_ELEMENT', 'recaptcha' . nv_genpass( 8 ) );
		$xtpl->assign( 'N_CAPTCHA', $lang_global['securitycode1'] );
		$xtpl->parse( 'main.recaptcha' );
	}
	else
	{
		$xtpl->assign( 'GFX_WIDTH', NV_GFX_WIDTH );
		$xtpl->assign( 'GFX_HEIGHT', NV_GFX_HEIGHT );
		$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
		$xtpl->assign( 'CAPTCHA_REFRESH', $lang_global['captcharefresh'] );
		$xtpl->assign( 'NV_GFX_NUM', NV_GFX_NUM );
		$xtpl->parse( 'main.captcha' );
	}

 
	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

function ThemeViewClassError( $error )
{
	global $getSetting, $getTypes, $nv_Request, $client_info, $lang_module, $lang_global, $module_info, $module_name, $module_file, $global_config, $user_info, $op;
	$xtpl = new XTemplate( 'ThemeViewClassError.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'GLANG', $lang_global );
	$xtpl->assign( 'SELFURL', $client_info['selfurl'] );
 
	foreach( $error as $key => $_error )
	{
		$xtpl->assign( 'ERROR', $_error );
		$xtpl->parse( 'main.error' );
	} 

 
	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}


/**
 * nv_theme_timekeeper_main()
 * 
 * @param mixed $array_data
 * @return
 */
function nv_theme_timekeeper_main($array_data, $array_locationid)
{
    global $getSetting,$module_info, $lang_module, $lang_global, $op, $module_config, $module_name, $user_info, $array_userid_users;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);
	$xtpl->assign('GOGGLEMAP_API', $getSetting['appapi']);
	$xtpl->assign( 'TEMPLATE', $module_info['template'] );
	$xtpl->assign( 'DATE_TIMEKEEPING', date("d/m/Y", NV_CURRENTTIME )); 
	if($array_data['locationid'] > 0){
		foreach ($array_locationid as $group_id => $group_title) {
			$xtpl->assign('LOCATION', [
				'key' => $group_id,
				'title' => $group_title['title'],
				'selected' => $group_id == $array_data['locationid'] ? ' selected="selected"' : ''
			]);
			$xtpl->parse('main.location');
		}
	}
	if(!empty($array_data['time_week'])){
		$i=0;
		foreach($array_data['time_week'] as $key => $values){
			
			$xtpl->assign( 'DATE', $values );
			$xtpl->parse('main.time_week');
			foreach($values['datetimekeeping'] as $key => $value){
				$xtpl->assign( 'TIMEKEEPING', $value );
				$xtpl->parse('main.time_week_look.loop');
			}
			
			$xtpl->parse('main.time_week_look');
			if($i>5) {
				break;
			}
			$i++;
		}
		foreach($array_data['time_week'] as $key => $values){
			
			if(date("Y-m-d", NV_CURRENTTIME ) == $key){
				foreach($values['datetimekeeping'] as $key => $value){
					$xtpl->assign( 'TIMEKEEPING_CURRENT', $value );
					$xtpl->parse('main.time_current_look.time');
				}
			
				$xtpl->parse('main.time_current_look');
			
			}
			
		}
		
		
		
	}
	
	if(in_array("1", $user_info['in_groups'])||in_array("2", $user_info['in_groups'])){
		foreach($array_userid_users as $u =>$ui){
			$value = array(
				"userid" => $u,
				"username" => $ui['username']
 			);
			$xtpl->assign( 'USER_EMPLOYER', $value );
			$xtpl->parse('main.admin_tab.users_timekeeping');
		
		}
		$xtpl->parse('main.admin');
		$xtpl->parse('main.admin_tab');
	}
	
	
    //------------------
    // Viết code vào đây
    //------------------

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 * nv_theme_timekeeper_punch()
 * 
 * @param mixed $array_data
 * @return
 */
function nv_theme_timekeeper_punch($array_data, $array_locationid)
{
    global $getSetting,$module_info, $lang_module, $lang_global, $op, $module_config, $module_name;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);
	$xtpl->assign('GOGGLEMAP_API', $getSetting['appapi']);
	$xtpl->assign( 'TEMPLATE', $module_info['template'] );
	foreach ($array_locationid as $group_id => $group_title) {
		$xtpl->assign('LOCATION', [
			'key' => $group_id,
			'title' => $group_title['title'],
			'selected' => $group_id == $array_data['locationid'] ? ' selected="selected"' : ''
		]);
		$xtpl->parse('main.location');
	}
	$array_data['punch_date'] = date("d/m/Y", NV_CURRENTTIME);
	if($array_data['cout_time_check'] == 0){
		$xtpl->assign( 'TYPELOGIN', 0 );
		$xtpl->assign( 'IDLOGIN', 0 );
		$xtpl->assign( 'ACTION_LOGIN', $lang_module['login'] );
	}else{
		$xtpl->assign( 'TYPELOGIN', 1 );
		$xtpl->assign( 'IDLOGIN',  $array_data['idlogin']);
		$xtpl->assign( 'ACTION_LOGIN',  $lang_module['logout']);
	}
	$xtpl->assign( 'DATA', $array_data );
    //------------------
    // Viết code vào đây
    //------------------

    $xtpl->parse('main');
    return $xtpl->text('main');
}