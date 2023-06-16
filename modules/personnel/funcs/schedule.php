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
	$_sql = 'SELECT * FROM ' . TABLE_PERSONNEL_NAME . '_data where group_name="work_place" ORDER BY weight ASC';
	$_query = $db->query($_sql);
	while ($_row = $_query->fetch()) {
		$array_locationid[$_row['data_id']] = $_row;
	}
	if ($nv_Request->isset_request('submit', 'post')) {
		$row['locationid'] = $nv_Request->get_int('locationid', 'post', 0);
		$date_start = $nv_Request->get_string('date_start', 'post');
		$date_end = $nv_Request->get_string('date_end', 'post');
		if(empty($date_start)){
			$error[] = $lang_module['no_date_start'];
		}
		if(empty($date_start)){
			$error[] = $lang_module['no_date_end'];
		}
		$date_begin_array = explode("/",$date_start);
		$start_date = $date_begin_array[2].'-' . $date_begin_array[1] . '-' . $date_begin_array[0] . '';
		$date_end_array = explode("/",$date_end);
		
		$end_date = $date_end_array[2].'-' . $date_end_array[1] . '-' . $date_end_array[0] . '';
		
		$dates = array();
		$current_date = strtotime($start_date);
		$end_date = strtotime($end_date);

		while ($current_date <= $end_date) {
			
			$dates[] = date('d/m/Y', $current_date);
			$current_date = strtotime('+1 day', $current_date);
		}
		
		if (empty($error)) {
			try {
				if (empty($row['id'])) {
					$row['parentid'] = 0;
					$row['ip'] = $client_info['ip'];
					$row['browse'] = $client_info['browser']['key'] . '-' . $client_info['client_os']['key'];


					$stmt = $db->prepare('INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_timekeeper_schedule (parentid, userid, locationid, date_start, date_end, ip, browse) VALUES (:parentid, :userid, :locationid, :date_start, :date_end, :ip, :browse)');

					$stmt->bindParam(':parentid', $row['parentid'], PDO::PARAM_INT);
					$stmt->bindParam(':userid', $row['userid'], PDO::PARAM_INT);
					$stmt->bindParam(':ip', $row['ip'], PDO::PARAM_STR);
					$stmt->bindParam(':browse', $row['browse'], PDO::PARAM_STR);

				} else {
					$stmt = $db->prepare('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_timekeeper_schedule SET locationid = :locationid, date_start = :date_start, date_end = :date_end WHERE id=' . $row['id']);
				}
				$stmt->bindParam(':locationid', $row['locationid'], PDO::PARAM_INT);
				$stmt->bindParam(':date_start', $row['date_start'], PDO::PARAM_INT);
				$stmt->bindParam(':date_end', $row['date_end'], PDO::PARAM_STR);

				$exc = $stmt->execute();
				if ($exc) {
					$nv_Cache->delMod($module_name);
					if (empty($row['id'])) {
						nv_insert_logs(NV_LANG_DATA, $module_name, 'Add Scheduleadd', ' ', $user_info['userid']);
					} else {
						nv_insert_logs(NV_LANG_DATA, $module_name, 'Edit Scheduleadd', 'ID: ' . $row['id'], $user_info['userid']);
					}
					nv_redirect_location(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
				}
			} catch(PDOException $e) {
				trigger_error($e->getMessage());
				die($e->getMessage()); //Remove this line after checks finished
			}
		}
	} elseif ($row['id'] > 0) {
		$row = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $row['id'])->fetch();
		if (empty($row)) {
			nv_redirect_location(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
		}
	} else {
		$row['id'] = 0;
		$array_data['locationid'] = 0;
	}
	$date_current = date("d-m-Y" , NV_CURRENTTIME);
	$date_current_array = explode("-",$date_current);
	$date_current_start = mktime(0,0,0,$date_current_array[1],$date_current_array[0],$date_current_array[2]);
	$date_current_end = mktime(23,59,59,$date_current_array[1],$date_current_array[0],$date_current_array[2]);
	$row = $db->query('SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_timekeeper WHERE type_login = 0 AND parentid = 0 AND userid=' . $row['userid'] . ' AND date_login >= ' . $date_current_start . ' AND date_login <= ' . $date_current_end)->fetchAll();
	$array_data['cout_time_check'] = count($row);
	if(count($row) > 0){
		$array_data['idlogin'] = $row[0]['id'];
	}else{
		$array_data['idlogin'] = 0;
	}
	//------------------
	// Viết code vào đây
	//------------------

	$contents = nv_theme_timekeeper_schedule($array_data, $array_locationid, $module_config, $module_name);

	include NV_ROOTDIR . '/includes/header.php';
	echo nv_site_theme($contents);
	include NV_ROOTDIR . '/includes/footer.php';
}else{
	nv_redirect_location(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=users&' . NV_OP_VARIABLE . '=login&nv_redirect=' . nv_redirect_encrypt($client_info['selfurl']) . '&checkss=' . md5('0' . NV_CHECK_SESSION));
}