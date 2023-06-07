<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Tập Đoàn Họ Nguyễn <tgd@tapdoanhonguyen.com>
 * @Copyright (C) 2023 Tập Đoàn Họ Nguyễn. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Sat, 29 Apr 2023 12:49:32 GMT
 */

if (!defined('NV_IS_MOD_PERSONNEL'))
    die('Stop!!!');

$page_title = $module_info['site_title'];
$key_words = $module_info['keywords'];
$getData = getData();
$data_work_place = $getData['work_place'];
if( ACTION_METHOD == 'timekeeping' )
{
 
	
	$row = array();
	$date_timekeeping = $nv_Request->get_string('date_timekeeping', 'post', date("d/m/Y",NV_CURRENTTIME));
	if (defined('NV_IS_USER')  || defined('NV_IS_ADMIN')){
		if (defined('NV_IS_USER')){
			$row['userid'] = $user_info['userid'];
			$row['username'] = $user_info['username'];
		}elseif(defined('NV_IS_ADMIN')){
			$row['userid'] = $admin_info['userid'];
			$row['username'] = $admin_info['username'];
		}
		$json['data'] = array();
		$date_current_array = explode("/",$date_timekeeping);
		$date_current_start = mktime(0,0,0,$date_current_array[1],$date_current_array[0],$date_current_array[2]);
		$date_current_end = mktime(23,59,59,$date_current_array[1],$date_current_array[0],$date_current_array[2]);
		
		$row = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_timekeeper WHERE userid=' . $row['userid'] . ' AND date_login >= ' . $date_current_start . ' AND date_login <= ' . $date_current_end);
		$data_array = array();
		while($datas = $row->fetch()){
			$data_array[$datas['id']]=$datas;
		}
		$data_tmp = array();
		foreach ($data_array as $key => $value){
			if($value['type_login'] == 0 ){
				$data_tmp[] = $value;
			}
		}
		$data = array();
		foreach ($data_tmp as $key => $value){
			$value['location'] = $data_work_place[$value['locationid']]['t'];
			$value['type_checkout'] = $data_array[$value['parentid']]['type_login'];
			$value['locationid_checkout'] = $data_array[$value['parentid']]['locationid'];
			$value['location_checkout'] = $data_work_place[$data_array[$value['parentid']]['locationid']]['t'];
			$value['time_checkout'] = $data_array[$value['parentid']]['time_login'];
			$value['date_checkout'] = $data_array[$value['parentid']]['date_login'];
			$value['image_checkout'] = $data_array[$value['parentid']]['image_file'];
			$value['image_data_checkout'] = $data_array[$value['parentid']]['image_data'];
			$value['note_checkout'] = $data_array[$value['parentid']]['note'];
			$value['lat_checkout'] = $data_array[$value['parentid']]['lat'];
			$value['lng_checkout'] = $data_array[$value['parentid']]['lng'];
			$value['ip_checkout'] = $data_array[$value['parentid']]['ip'];
			$value['address_checkout'] = $data_array[$value['parentid']]['address'];
			$value['distance_checkout'] = $data_array[$value['parentid']]['distance'];
			$value['browse_checkout'] = $data_array[$value['parentid']]['browse'];
			$value['duration'] = $data_array[$value['parentid']]['browse'];
			$data[] = $value;
		}
		$json['success'] = 1;
		$json['data'] = $data;
		$json['total_duration'] = 0;
		$json['records_found'] = count($json['data']);
		
	}else{
		$json['error'] = $lang_module['no_login'];
	}
	
	
	nv_jsonOutput( $json );
}
if( ACTION_METHOD == 'userstimekeeping' )
{
 
	
	$row = array();
	$users_timekeeping = $nv_Request->get_int('users_timekeeping', 'post', 0);
	$date_begin_timekeeping = $nv_Request->get_string('date_begin_timekeeping', 'post', date("d/m/Y",NV_CURRENTTIME));
	$date_end_timekeeping = $nv_Request->get_string('date_end_timekeeping', 'post', date("d/m/Y",NV_CURRENTTIME));
	
	if (defined('NV_IS_USER')  || defined('NV_IS_ADMIN')){
		if (defined('NV_IS_USER')){
			$row['userid'] = $user_info['userid'];
			$row['username'] = $user_info['username'];
		}elseif(defined('NV_IS_ADMIN')){
			$row['userid'] = $admin_info['userid'];
			$row['username'] = $admin_info['username'];
		}
		$json['data'] = array();
		$date_begin_array = explode("/",$date_begin_timekeeping);
		$start_date = $date_begin_array[2].'-' . $date_begin_array[1] . '-' . $date_begin_array[0] . '';
		$date_end_array = explode("/",$date_end_timekeeping);
		
		$end_date = $date_end_array[2].'-' . $date_end_array[1] . '-' . $date_end_array[0] . '';
		
		$dates = array();
		$current_date = strtotime($start_date);
		$end_date = strtotime($end_date);

		while ($current_date <= $end_date) {
			
			$dates[] = date('d/m/Y', $current_date);
			$current_date = strtotime('+1 day', $current_date);
		}
		
		foreach ($dates as $date) {
			$data = array();
			$date_current_array = explode("/",$date);
			$date_current_start = mktime(0,0,0,$date_current_array[1],$date_current_array[0],$date_current_array[2]);
		
			$date_current_end = mktime(23,59,59,$date_current_array[1],$date_current_array[0],$date_current_array[2]);
			$row = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_timekeeper WHERE userid=' . $users_timekeeping . ' AND date_login >= ' . $date_current_start . ' AND date_login <= ' . $date_current_end);
			$data_array = array();
			while($datas = $row->fetch()){
				$data_array[$datas['id']]=$datas;
			}
			
			$data_tmp = array();
			foreach ($data_array as $key => $value){
				if($value['type_login'] == 0 ){
					$data_tmp[] = $value;
				}
			}
			foreach ($data_tmp as $key => $value){
				$value['location'] = $data_work_place[$value['locationid']]['t'];
				$value['type_checkout'] = $data_array[$value['parentid']]['type_login'];
				$value['locationid_checkout'] = $data_array[$value['parentid']]['locationid'];
				$value['location_checkout'] = $data_work_place[$data_array[$value['parentid']]['locationid']]['t'];
				$value['time_checkout'] = $data_array[$value['parentid']]['time_login'];
				$value['date_checkout'] = $data_array[$value['parentid']]['date_login'];
				$value['image_checkout'] = $data_array[$value['parentid']]['image_file'];
				$value['image_data_checkout'] = $data_array[$value['parentid']]['image_data'];
				$value['note_checkout'] = $data_array[$value['parentid']]['note'];
				$value['lat_checkout'] = $data_array[$value['parentid']]['lat'];
				$value['lng_checkout'] = $data_array[$value['parentid']]['lng'];
				$value['ip_checkout'] = $data_array[$value['parentid']]['ip'];
				$value['address_checkout'] = $data_array[$value['parentid']]['address'];
				$value['distance_checkout'] = $data_array[$value['parentid']]['distance'];
				$value['browse_checkout'] = $data_array[$value['parentid']]['browse'];
				$value['duration'] = $data_array[$value['parentid']]['browse'];
				$data[] = $value;
			}
			
			$json['data'][$date] = array(
				'date' => $date,
				'data' => $data
			);
			
		}
		
		
		
		$json['success'] = 1;
		$json['total_duration'] = 0;
		$json['records_found'] = count($json['data']);
		
	}else{
		$json['error'] = $lang_module['no_login'];
	}
	
	
	nv_jsonOutput( $json );
}
if (defined('NV_IS_USER') || defined('NV_IS_ADMIN')){
	$array_data = array();
	$row = array();
	$error = array();
	$row['id'] = $nv_Request->get_int('id', 'post,get', 0);
	if (defined('NV_IS_USER')){
		$row['userid'] = $user_info['userid'];
		$row['username'] = $user_info['username'];
	}elseif(defined('NV_IS_ADMIN')){
		$row['userid'] = $admin_info['userid'];
		$row['username'] = $admin_info['username'];
	}
	$array_userid_users = array();
	$array_userid = array();
	$_sql = 'SELECT * FROM nv4_users as u  left join nv4_users_groups_users as gu on u.userid = gu.userid where gu.group_id = ' . $getSetting['employer_group'];
	$_query = $db->query($_sql);
	while ($_row = $_query->fetch()) {
		$array_userid_users[$_row['userid']] = $_row;
		$array_userid[] = $_row['userid']; 
	}
	$array_locationid = array();
	$_sql = 'SELECT * FROM ' . TABLE_PERSONNEL_NAME . '_data where group_name="work_place"';
	$_query = $db->query($_sql);
	while ($_row = $_query->fetch()) {
		$array_locationid[$_row['data_id']] = $_row;
	}
	
	
	$targetDate = date("Y-m-d", NV_CURRENTTIME); // Ngày cần xác định các ngày trong tuần
	$weekdays = array(  'Chủ nhật', 'Thứ hai', 'Thứ ba', 'Thứ tư', 'Thứ năm', 'Thứ sáu', 'Thứ bảy');

	$startDate = date('Y-m-d', strtotime('last Monday', strtotime($targetDate)));
	$endDate = date('Y-m-d', strtotime('next Saturday', strtotime($targetDate)));

	$currentDate = $startDate;
	$array_date = array();
	if (defined('NV_IS_USER')){
		$row['userid'] = $user_info['userid'];
		$row['username'] = $user_info['username'];
	}elseif(defined('NV_IS_ADMIN')){
		$row['userid'] = $admin_info['userid'];
		$row['username'] = $admin_info['username'];
	}
	while ($currentDate <= $endDate) {
		$dayOfWeek = date('w', strtotime($currentDate));
		$date_current_array = explode("-",$currentDate);
		$date_current_start = mktime(0,0,0,$date_current_array[1],$date_current_array[2],$date_current_array[0]);
		
		$date_current_end = mktime(23,59,59,$date_current_array[1],$date_current_array[2],$date_current_array[0]);
		
		$rows = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_timekeeper WHERE userid=' . $row['userid'] . ' AND date_login >= ' . $date_current_start . ' AND date_login <= ' . $date_current_end);
		$data_array = array();
		while($datas = $rows->fetch()){
			$data_array[$datas['id']]=$datas;
		}
		
		$data_tmp = array();
		foreach ($data_array as $key => $value){
			if($value['type_login'] == 0 ){
				$data_tmp[] = $value;
			}
		}
		
		$data = array();
		if(!empty($data_tmp)){
			foreach ($data_tmp as $key => $value){
				if($value['parentid']>0){
					
					$value['type_checkout'] = $data_array[$value['parentid']]['type_login'];
					$value['locationid_checkout'] = $data_array[$value['parentid']]['locationid'];
					$value['time_checkout'] = $data_array[$value['parentid']]['time_login'];
					$value['date_checkout'] = $data_array[$value['parentid']]['date_login'];
					$value['image_checkout'] = $data_array[$value['parentid']]['image_file'];
					$value['image_data_checkout'] = $data_array[$value['parentid']]['image_data'];
					$value['lat_checkout'] = $data_array[$value['parentid']]['lat'];
					$value['lng_checkout'] = $data_array[$value['parentid']]['lng'];
					$value['ip_checkout'] = $data_array[$value['parentid']]['ip'];
					$value['address_checkout'] = $data_array[$value['parentid']]['address'];
					$value['distance_checkout'] = $data_array[$value['parentid']]['distance'];
					$value['browse_checkout'] = $data_array[$value['parentid']]['browse'];
					$value['duration'] = $data_array[$value['parentid']]['browse'];
					
				}
				$data[] = $value;
			}
		}
		$array_date[$currentDate] = array(
			"date" => $currentDate,
			"datename" => $weekdays[$dayOfWeek],
			"datetimekeeping" => $data
		);
		$currentDate = date('Y-m-d', strtotime('+1 day', strtotime($currentDate)));
	}
	$array_data['time_week'] = $array_date;
	$array_data['locationid'] = 0;

	//------------------
	// Viết code vào đây
	//------------------

	$contents = nv_theme_timekeeper_main($array_data, $array_locationid, $module_config, $module_name);

	include NV_ROOTDIR . '/includes/header.php';
	echo nv_site_theme($contents);
	include NV_ROOTDIR . '/includes/footer.php';
}else{
	nv_redirect_location(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=users&' . NV_OP_VARIABLE . '=login&nv_redirect=' . nv_redirect_encrypt($client_info['selfurl']) . '&checkss=' . md5('0' . NV_CHECK_SESSION));
}