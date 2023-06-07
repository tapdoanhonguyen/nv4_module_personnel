<?php

/**
 * @Project NUKEVIET 4.x
 * @Author DANGDINHTU (dlinhvan@gmail.com)
 * @Copyright (C) 2016 Nuke.vn. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Mon, 11 Jul 2016 09:00:15 GMT
 */

if( ! defined( 'NV_SYSTEM' ) ) die( 'Stop!!!' );


if ( empty( $user_info ) )
{
	$link_redirect = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=users&' . NV_OP_VARIABLE . '=login&&nv_redirect=' . nv_redirect_encrypt( $client_info['selfurl'] );
	
	Header( 'Location: ' . $link_redirect );
	exit();
}


define( 'NV_IS_MOD_PERSONNEL', true );
 
define( 'TABLE_PERSONNEL_NAME', NV_PREFIXLANG . '_' . $module_data );

define( 'TABLE_LOCATION_NAME', $db_config['prefix'] . '_location' );

define( 'TABLE_ATTACHMENT_NAME', $db_config['prefix'] . '_attachment' );

define( 'ACTION_METHOD', $nv_Request->get_string( 'action', 'get,post', '' ) );

require_once NV_ROOTDIR . '/modules/' . $module_file . '/global.functions.php';

$arrayWorkforceTab = array('1'=> $lang_module['workforce_tab_1'], '2'=> $lang_module['workforce_tab_2'], '3'=> $lang_module['workforce_tab_3'], '0'=> $lang_module['workforce_tab_0']);

$arrayInsurranceExport = array(
	'personnel_code'=> $lang_module['export_personnel_code'], 
	'full_name'=> $lang_module['export_full_name'], 
	'department_id'=> $lang_module['export_department_id'], 
	'position_id'=> $lang_module['export_position_id'],
	'job_title'=> $lang_module['export_job_title'],
	'premium_number'=> $lang_module['export_premium_number'],
 	'premium_card'=> $lang_module['export_premium_card'],
	'insdown_date_apply'=> $lang_module['export_insdown_date_apply'],
	'salary_money'=> $lang_module['export_salary_money'],
);

$arrayContractExport = array(
	'user_create'=> $lang_module['export_user_create'], 
	'contract_code'=> $lang_module['export_contract_code'], 
	'full_name'=> $lang_module['export_full_name'], 
	'department_id'=> $lang_module['export_department_id'], 
	'position_id'=> $lang_module['export_position_id'], 
	'job_title'=> $lang_module['export_job_title'],
	'contract_type'=> $lang_module['export_contract_type'],
 	'date_reg'=> $lang_module['export_date_reg'],
	'date_start'=> $lang_module['export_date_start']
);

$arrayWorkforcetExport = array(
	'personnel_code'=> $lang_module['export_personnel_code'], 
	'full_name'=> $lang_module['export_full_name'], 
	'department_id'=> $lang_module['export_department_id'], 
	'position_id'=> $lang_module['export_position_id'],
	'job_title'=> $lang_module['export_job_title'],
	'date_start'=> $lang_module['export_date_work'],
	
);

$statusIdentityCard = array(
	'1'=> $lang_module['identitycard_1'], 
	'2'=> $lang_module['identitycard_2'], 
	'3'=> $lang_module['identitycard_3'], 
	'4'=> $lang_module['identitycard_4'],
	'5'=> $lang_module['identitycard_5'],
	'6'=> $lang_module['identitycard_6'],
	'7'=> $lang_module['identitycard_7'],	
);


$resignToBill = array(
	'1'=> $lang_module['resigntobill_1'], 
	'2'=> $lang_module['resigntobill_2'], 
	'3'=> $lang_module['resigntobill_3'], 
	'4'=> $lang_module['resigntobill_4'],
	'5'=> $lang_module['resigntobill_5'],
	'6'=> $lang_module['resigntobill_6'],
	
);





// $itemx[0] = ($offset + $stt);
// $itemx[1] = $item['user_create'];
// $itemx[2] = substr($item['contract_code'],6);
// $itemx[3] = $item['full_name'];
// $itemx[4] =  $item['department_id'];
// $itemx[5] =  $item['contract_type'];
// $itemx[6] = $item['date_reg'] ? date('d/m/Y', $item['date_reg']) : '';
// $itemx[7] = $item['date_start'] ? date('d/m/Y', $item['date_start']) : '';
 
$page = 1;
$perpage = $getSetting['perpage'];
  
$count_op = sizeof( $array_op );
if( ! empty( $array_op ) and $op == 'main' )
{
	$op = 'main';
	

	
	/* if( $count_op == 1 or substr( $array_op[1], 0, 5 ) == 'page-' )
	{

		if( $count_op > 1 or $category_id > 0 )
		{
			$op = 'viewcat';
			if( isset( $array_op[1] ) and substr( $array_op[1], 0, 5 ) == 'page-' )
			{
				$page = intval( substr( $array_op[1], 5 ) );
			}
		}
		elseif( $category_id == 0 && !empty( $alias_cat_url ) )
		{
 
			$dataContent = $db->query('SELECT * FROM ' . TABLE_PERSONNEL_NAME . '_class WHERE alias=' . $db->quote( $alias_cat_url ) )->fetch();
			
			$category_id = $dataContent['category_id'];
			
			$op = 'detail';
			 
		}
		elseif( $category_id == 0 )
		{
			$contents = $lang_module['nocatpage'] . $array_op[0];
			if( isset( $array_op[0] ) and substr( $array_op[0], 0, 5 ) == 'page-' )
			{
				$page = intval( substr( $array_op[0], 5 ) );
			}
		}

	} */
 
}
 