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

$array_userid_users = array();
$array_userid = array();
$_sql = 'SELECT * FROM nv4_users as u  left join nv4_users_groups_users as gu on u.userid = gu.userid where gu.group_id = ' . $getSetting['employer_group'];
$_query = $db->query($_sql);
while ($_row = $_query->fetch()) {
    $array_userid_users[$_row['userid']] = $_row;
	$array_userid[] = $_row['userid']; 
}

$personnel_id = $nv_Request->get_int('personnel_id', 'post', 0);
if( ACTION_METHOD == 'getData' )
{
 
	$json = array();
	
	$perpage = $nv_Request->get_int('length', 'get', 10);
	$offset = $nv_Request->get_int('start', 'get', 1);
 
	$implode = array();
 
	$db_slave->sqlreset()
			->select('COUNT(*)')
			->from( TABLE_PERSONNEL_NAME . '' );
	 
	$db_slave->where( implode( ' AND ', $implode ) );

	$num_items = $db_slave->query( $db_slave->sql() )->fetchColumn();
	$json['recordsFiltered'] = $num_items;
	$json['recordsTotal'] = $num_items;
	
	$db_slave->select( '*' )
				->order( 'date_added DESC' )
				->limit( $perpage )
				->offset( $offset );
	$result = $db_slave->query( $db_slave->sql() );
	$stt = 1;
	while( $item = $result->fetch() )
	{
		$itemx[0] = ($offset + $stt);
		$itemx[1] = 'ABCDEFG' . ($offset + $stt);
		$itemx[2] = 'Đặng Đình Tứ ' . ($offset + $stt);
		$itemx[3] = 'Đặng Đình Tứ ' . ($offset + $stt);
		$itemx[4] = 'Đặng Đình Tứ ' . ($offset + $stt);
		$itemx[5] = 'Đặng Đình Tứ ' . ($offset + $stt);
		$itemx[6] = 'Đặng Đình Tứ ' . ($offset + $stt);
		$itemx[7] = 'Đặng Đình Tứ ' . ($offset + $stt);
		$json['data'][] = $itemx;
		++$stt;
	}

	nv_jsonOutput( $json );
}

elseif( ACTION_METHOD == 'create' || ACTION_METHOD == 'update' )
{
	
	$json = array();
	
	
	// $db->query('TRUNCATE nv4_vi_personnel_degrees');
	// $db->query('TRUNCATE nv4_vi_personnel_experience');
	// $db->query('TRUNCATE nv4_vi_personnel_family');
	// $db->query('TRUNCATE nv4_vi_personnel_history_insurances');
	// $db->query('TRUNCATE nv4_vi_personnel_personnel');
	// $db->query('TRUNCATE nv4_vi_personnel_history_solves');
	// $db->query('TRUNCATE nv4_vi_personnel_allowances');
	// die();
	$dataContent['work_status'] =1;
	$dataContent['timekeeping_code'] = $nv_Request->get_title('timekeeping_code', 'post', '');
	$dataContent['personnel_code'] = $nv_Request->get_title('personnel_code', 'post', '');
	$dataContent['profile_code'] = $nv_Request->get_title('profile_code', 'post', '');
	$dataContent['full_name'] = $nv_Request->get_title('full_name', 'post', '');
	$dataContent['birthday'] = $nv_Request->get_title('birthday', 'post', '');
	$dataContent['birthday'] = convertToTimeStamp( $dataContent['birthday'] );
	
	$dataContent['gender'] = $nv_Request->get_int('gender', 'post', 0);
	$dataContent['userid'] = $nv_Request->get_int('userid', 'post', 0);
	
	$dataContent['place_of_birth'] = $nv_Request->get_title('place_of_birth', 'post', '');
	$dataContent['origin_state'] = $nv_Request->get_title('origin_state', 'post', '');
	$dataContent['private_code'] = $nv_Request->get_title('private_code', 'post', '');
	$dataContent['private_code_date'] = $nv_Request->get_title('private_code_date', 'post', '');
	$dataContent['private_code_date'] = convertToTimeStamp($dataContent['private_code_date']);
	
	$dataContent['private_code_place'] = $nv_Request->get_title('private_code_place', 'post', '');
	
	$dataContent['marital_status'] = $nv_Request->get_int('marital_status', 'post', 0);
	$dataContent['nationality'] = $nv_Request->get_int('nationality', 'post', 0);
	$dataContent['people'] = $nv_Request->get_int('people', 'post', 0);
	$dataContent['religious'] = $nv_Request->get_int('religious', 'post', 0);
	
	$dataContent['job_bank_account'] = $nv_Request->get_title('job_bank_account', 'post', '');
	$dataContent['job_bank_account_name'] = $nv_Request->get_title('job_bank_account_name', 'post', '');
	$dataContent['job_bank_id'] = $nv_Request->get_int('job_bank_id', 'post', 0);
	$dataContent['job_bank_desc'] = $nv_Request->get_title('job_bank_desc', 'post', '');
	$dataContent['job_tax'] = $nv_Request->get_title('job_tax', 'post', '');
	$dataContent['level_id'] = $nv_Request->get_int('level_id', 'post', 0);
	$dataContent['level_school'] = $nv_Request->get_int('level_school', 'post', 0);
	$dataContent['level_academic'] = $nv_Request->get_int('level_academic', 'post', 0);
	$dataContent['mobile'] = $nv_Request->get_title('mobile', 'post', '');
	$dataContent['email'] = $nv_Request->get_title('email', 'post', '');
	$dataContent['home_address'] = $nv_Request->get_title('home_address', 'post', '');
	$dataContent['place_home'] = $nv_Request->get_int('place_home', 'post', 0);
	$dataContent['current_address'] = $nv_Request->get_title('current_address', 'post', '');
	$dataContent['place_current'] = $nv_Request->get_int('place_current', 'post', 0);
	
	$dataContent['family'] = $nv_Request->get_typed_array('family', 'post', 'array', array());
	// family[0][relative_id]: 1
	// family[0][full_name]: Đặng Hữu Lành
	// family[0][birthday]: 15/09/1954
	// family[0][job]: Tự do
	// family[0][origin_state_address]: Hà nội
	// family[0][phone]: 09543454353
	// family[0][is_dependent]: 5
 
	$dataContent['degrees'] = $nv_Request->get_typed_array('degrees', 'post', 'array', array());
	// degrees[0][date_from]: 11/2020
	// degrees[0][date_to]: 11/2020
	// degrees[0][type_id]: 27
	// degrees[0][specialization]: Lập Trình
	// degrees[0][type_id]: 17
	// degrees[0][place]: Đại học cntt và truyền thông thái nguyên
	$dataContent['experience'] = $nv_Request->get_typed_array('experience', 'post', 'array', array());
	
	// experience[0][date_from]: 11/2020
	// experience[0][date_to]: 11/2020
	// experience[0][company_title]: Ở nahf choiq
	// experience[0][position_id]: sda sad á
	// experience[0][contact_info]: ds ad sad
	// experience[0][phone]: 435454353435
	// experience[0][work_desc]: dfd sf sdf sfsd fds
	
	$dataContent['contract_code'] = $nv_Request->get_title('contract_code', 'post', '');
	$dataContent['contract_type'] = $nv_Request->get_int('contract_type', 'post', 0);
	$dataContent['department_id'] = $nv_Request->get_int('department_id', 'post', 0);
	$dataContent['work_type'] = $nv_Request->get_int('work_type', 'post', 0);
	$dataContent['position_id'] = $nv_Request->get_int('position_id', 'post', 0);
	$dataContent['job_title'] = $nv_Request->get_int('job_title', 'post', 0);
	$dataContent['work_place'] = $nv_Request->get_int('work_place', 'post', 0);
	$dataContent['date_start'] = $nv_Request->get_title('date_start', 'post', '');
	$dataContent['date_start'] = convertToTimeStamp($dataContent['date_start']);
	
	$dataContent['date_finish'] = $nv_Request->get_title('date_finish', 'post', '');
	$dataContent['date_finish'] = convertToTimeStamp($dataContent['date_finish']);
	
	$dataContent['date_reg'] = $nv_Request->get_title('date_reg', 'post', '');
	$dataContent['date_reg'] = convertToTimeStamp($dataContent['date_reg']);
	
	$dataContent['signer_id'] = $nv_Request->get_int('signer_id', 'post', 0);
	$dataContent['salary_date_from'] = $nv_Request->get_title('salary_date_from', 'post', '');
	$dataContent['salary_date_from'] = convertToTimeStamp( $dataContent['salary_date_from'] );
	
	$dataContent['salary_method_id'] = $nv_Request->get_int('salary_method_id', 'post', 0);
	$dataContent['salary_money'] = $nv_Request->get_title('salary_money', 'post', '');
	$dataContent['salary_money'] = preg_replace('/[^0-9\.]/', '', $dataContent['salary_money']);



 
	
	$dataContent['allowances'] = $nv_Request->get_typed_array('allowances', 'post', 'array', array());
	 
	// allowances[0][allow_id]: -1
	// allowances[0][money]: 0
	
	$dataContent['premium_number'] = $nv_Request->get_title('premium_number', 'post', '');
	$dataContent['premium_insurance_status'] = $nv_Request->get_int('premium_insurance_status', 'post', 0);
	$dataContent['premium_personnel'] = $nv_Request->get_int('premium_personnel', 'post', 0);
	$dataContent['premium_card'] = $nv_Request->get_title('premium_card', 'post', '');
	$dataContent['premium_code'] = $nv_Request->get_int('premium_code', 'post', 0);
	
	$dataContent['insup_date_get'] = $nv_Request->get_title('insup_date_get', 'post', '');
	$dataContent['insup_date_get'] = convertToTimeStamp( $dataContent['insup_date_get'] );
	
	$dataContent['insup_date_complete'] = $nv_Request->get_title('insup_date_complete', 'post', '');
	$dataContent['insup_date_complete'] = convertToTimeStamp( $dataContent['insup_date_complete'] );
	
	$dataContent['insup_date_receive'] = $nv_Request->get_title('insup_date_receive', 'post', '');
	$dataContent['insup_date_receive'] = convertToTimeStamp( $dataContent['insup_date_receive'] );
 
	$dataContent['insup_date_return'] = $nv_Request->get_title('insup_date_return', 'post', '');
	$dataContent['insup_date_return'] = convertToTimeStamp( $dataContent['insup_date_return'] );
	
	$dataContent['insdown_date_get'] = $nv_Request->get_title('insdown_date_get', 'post', '');
	$dataContent['insdown_date_get'] = convertToTimeStamp( $dataContent['insdown_date_get'] );
 
	$dataContent['insdown_date_complete'] = $nv_Request->get_title('insdown_date_complete', 'post', '');
	$dataContent['insdown_date_complete'] = convertToTimeStamp( $dataContent['insdown_date_complete'] );
	
	$dataContent['insdown_date_apply'] = $nv_Request->get_title('insdown_date_apply', 'post', '');
	$dataContent['insdown_date_apply'] = convertToTimeStamp( $dataContent['insdown_date_apply'] );
	
	$dataContent['insdown_date_return'] = $nv_Request->get_title('insdown_date_return', 'post', '');
	$dataContent['insdown_date_return'] = convertToTimeStamp( $dataContent['insdown_date_return'] );
 
 
 
	$dataContent['historyInsurances'] = $nv_Request->get_typed_array('historyInsurances', 'post', 'array', array());
	// historyInsurances[0][date_from]: 11/2020
	// historyInsurances[0][type]: up
	// historyInsurances[0][reason]: 99
	// historyInsurances[0][salary_premium_base]: 5,000,000
	$dataContent['historySolves'] = $nv_Request->get_typed_array('historySolves', 'post', 'array', array());
	// historySolves[0][model]: 105
	// historySolves[0][premium_date_get]: 17/11/2020
	// historySolves[0][premium_date_complete]: 17/11/2020
	// historySolves[0][premium_date_close]: 29/11/2020
	// historySolves[0][premium_date_return]: 30/11/2020
	// historySolves[0][price]: 5,000,000
	
	$dataContent['status_identity_card'] = $nv_Request->get_typed_array('status_identity_card', 'post', 'int', array());
	$dataContent['resign_to_bill'] = $nv_Request->get_typed_array('resign_to_bill', 'post', 'int', array());
	
	if( !empty( $dataContent['status_identity_card'] ) )
	{
		$dataContent['status_identity_card'] = implode(',', $dataContent['status_identity_card']);
	}
	else{
		$dataContent['resign_to_bill'] = '';
	}
	
	if( !empty( $dataContent['resign_to_bill'] ) )
	{
		$dataContent['resign_to_bill'] = implode(',', $dataContent['resign_to_bill']);
	}
	else{
		$dataContent['resign_to_bill'] = '';
	}
	
	$dataContent['attachments'] = $nv_Request->get_typed_array('attachments', 'post', 'int', array());
	$attachment = count( $dataContent['attachments'] );
	
	// sleep(2);
	
	// if( empty( $dataContent['personnel_code'] ) )
	// {
		// $error[] = array('input'=> 'personnel_code', 'mess'=> $lang_module['register_personnel_code_error']); 
	// }
	// if( empty( $dataContent['timekeeping_code'] ) )
	// {
		// $error[] = array('input'=> 'timekeeping_code', 'mess'=>$lang_module['register_timekeeping_code_error']); 
	// }
	// if( empty( $dataContent['profile_code'] ) )
	// {
		// $error[] = array('input'=> 'profile_code', 'mess'=>$lang_module['register_profile_code_error']); 
	// }
	// if( empty( $dataContent['mobile'] ) )
	// {
		// $error[] = array('input'=> 'mobile', 'mess'=>$lang_module['register_mobile_error']); 
	// }
	// if( empty( $dataContent['email'] ) )
	// {
		// $error[] = array('input'=> 'email', 'mess'=>$lang_module['register_email_error']); 
	// }
	// if( empty( $dataContent['full_name'] ) )
	// {
		// $error[] = array('input'=> 'full_name', 'mess'=>$lang_module['register_full_name_error']); 
	// }
	 
	
	// $hovaten = array('Thế Minh Khôi','Bùi Thị Thu Hằng','Bá Ngọc Quyền','Nguyễn Quý Liễu','Giang Quang Tú','Bùi Thị Chung','Bùi Thị Thanh Hải','Nguyễn Thảo Nguyên','Nguyễn Đăng Minh','Nguyễn Thị Minh Phương','Bá Tùng Dương','Phan Xuân Đạt','Nguyễn Ngọc Hà Vy','Thế Thị Lương','Nguyễn Đăng Trường','Đỗ Anh Tấn','Nguyễn Thị Duyên','Nguyễn Thị Thủy','Nguyễn Thị Tuyết','Bùi Minh Hồng','Đỗ Thị Hằng','Ngô Thị Nhã','Nguyễn Thị Hương','Trần Thị Tâm','Dương Thị Phượng','Lê Thanh Vân','Trần Thị Hương','Trần Thị Ánh Dương','Hoàng Thị Thanh','Nguyễn Thị Hồng Gấm','Nguyễn Thị Yến','Nguyễn Thị Đà o','Nguyễn Thị Thu Hiền','Nguyễn Thị Thắng','Nguyễn Thị Chuyên','Nguyễn Văn Tuấn','Nguyễn Thị Hoa','Thạc Thị Xuân','Lê Văn Mai','Nguyễn Ngọc Long','Nguyễn Thị Thúy','Nguyễn Thị Hồng Dung','Nguyễn Thị Thúy Nga','Nguyễn Thị Nga','Nguyễn Viết Đại','Nguyễn Thị Nụ','Lê Hữu Thanh','Nguyễn Xuân Lý','Nguyễn Thị Hồng Hạnh','Đinh Thị Anh Đà o','Đinh Thị Kim Ngân','Nguyễn Bá Lương','Nguyễn Ngọc Trân','Nguyễn Thị Đặng Huyền','Cù Thị Minh Hòa','Lưu Thị Nhị','Nguyễn Thị Lợi','Bùi Đức Huy','Nguyễn Văn Hải','Nguyễn Tà i Phong','Bùi Đức Tân','Nguyễn Xuân Tùng','Nguyễn Thị Quyên','Nguyễn Minh Tú','Nguyễn Bảo Thuyên','Phạm Minh Tuấn','Phạm Thị Hương Giang','Phạm Thu Hà','Phạm Gia Hân','Phạm Gia Hưng','Nguyễn Thị Oanh','Nguyễn Thị Hoà i Thương','Nguyễn Thị Ánh Nguyệt','Nguyễn Thị Thu Huyền','Nguyễn Như Thanh','Nguyễn Thu Phương','Lê Thị Hà Giang','Nguyễn Thảo Vy','Nguyễn Minh Thảo','Lê Thị Cậy','Đặng Thị Đông','Mai Thị Vinh','Mai Thị Vân','Phạm Mai Quỳnh Trang','Phạm Hải Đăng','Đặng Thanh Hiếu','Nguyễn Ngọc Quyên','Đặng Thanh Lâm','Đặng Ngọc Lan Vy','Nguyễn Xuân Nam','Nguyễn Thị Ngọc Bích','Nguyễn Ngọc Lan Khuê','Nguyễn Xuân Nghĩa','Nguyễn Thị Phượng','Mai Bảo Châu','Ngô Tùng Sơn','Bùi Thúy Hoa','Lê Nam Anh','Đoàn Văn Nam','Nguyễn Thị Vóc','Đoàn Ngọc Hân','Đoàn Chí Bảo','Nguyễn Văn Thuận','Nguyễn Thị Đông','Đoàn Văn Chiến','Mè công Sinh','Nguyễn Tú Anh','Hoàng Quốc Việt','Trần Quốc Hùng','Vũ Thăng Long','Trần Thu Hương','Trần Bảo Thiên','Lương Thị Thái Thanh','Phạm Thị Vân','Bùi Đức Hiệp','Bùi Bảo Ngọc Linh','Lỗ Thị Kiều Oanh','Bùi Nam Tùng','Trần Thị Điệm','Bùi Đức Hồng','Lê Anh Tuấn','Lê Anh Minh','Bùi Thị Hồng','Nguyễn Văn An','Nguyễn Anh Đức','Nguyễn Hoàng Long','Hoàng Mạnh Thắng','Nguyễn Thị Vân','Hoàng Nghị Quân','Hoàng Vân Long','Hoàng Thị Ngọc Bích','Hoàng Anh Đức','Hoàng Trâm Anh','Đinh Thị Thùy Linh','Nguyễn Minh Phúc','Đỗ Thị Yến','Ngô Thị Kiều Liên','Nguyễn Phương Linh','Nguyễn Quang Vinh','Trần Tuấn Khanh','Nguyễn Thị Lạng');
	// $sodienthoai = array('0945610194','0949510294','0949410394','0944910494','0944610594','0948420194','0947820294','0946620394','0944920494','0944920594','0945630194','0946830294','0944730394','0947630494','0949530594','0948840194','0948840294','0948840394','0945640494','0949440594','0944450194','0944950294','0944450394','0942450494','0945650594','0949660194','0944660294','0949960394','0943760494','0944560594','0945670194','0948870294','0944870394','0944970494','0948970594','0946880194','0948880294','0948880394','0946880494','0946680594','0949890194','0949490294','0944690394','0949690494','0944690594','0944410194','0944710294','0944710394','0944610494','0944810594','0944711194','0947711294','0949411394','0946811494','0946111594','0948812194','0947712294','0944412394','0944912494','0946412594','0944413194','0948813294','0948813394','0944613494','0949413594','0945614194','0944914294','0944114394','0944914494','0946614594','0946615194','0945615294','0944915394','0946615494','0944315594','0946816194','0949616294','0946416394','0948816494','0946416594','0949417194','0945517294','0946617394','0947117594','0944918194','0944518294','0945418394','0947917494','0948818594','0944719194','0949319294','0947419394','0949718494','0944919594','0947720194','0944620494','0944621194','0949921294','0944921394','0949421494','0949421594','0943222194','0946422294','0943222394','0948022494','0946222594','0949923194','0942223294','0942323394','0944623494','0947423594','0948824194','0946824294','0949424394','0949024494','0949424594','0947725194','0944225294','0944725394','0946425494','0944725594','0948827194','0948426294','0949426394','0944926494','0946226594','0946628194','0947227294','0946627394','0944827494','0943227594','0944429194','0949428294','0949428394','0948928494','0942328594','0944729294','0946829394','0948829594','0946831194','0947430394','0946930594','0948610694','0946610794','0944810894','0944710994','0945711094','0949920694','0945520794','0945620894','0947620994','0947421094','0944330694','0944430794','0946630894','0948630994','0947431094','0946640694','0946640794','0945650894','0949840994','0949441094','0943450694','0946850794','0949960894','0947450994','0948651094','0949970694','0947770794','0944680894','0948970994','0946861094','0948880694','0949480794','0949490894','0948380994','0946671094','0944790694','0942490794','0947410894','0947790994','0949881094','0948910694','0942111894','0948412994','0946891094','0946611694','0944711794','0948412894','0943413994','0948612694','0949912794','0945413894','0944815994','0946813694','0946413794','0944714894','0948916994','0949901194','0948814694','0949014794','0948415894','0945617994','0946421194','0945615694','0944715794','0943416894','0945618994','0944631194','0946116694','0949916794','0947417894','0943720994','0947441194','0944417694','0946417794','0942218894','0949423994','0948651194','0944618694','0946618794','0945619894','0946425994','0944861194','0949419694','0944919794','0947726994','0944971194','0944520694','0944720794','0945421894','0945627994','0944581194','0942221694','0944221794','0946622894','0942428994','0947791194','0946222694','0949922794','0944623894','0949424694','0947724794','0944625894','0945625694','0949425794','0945726894','0944727694','0943626794','0946827894','0947421294','0947428694','0949427794','0947728894','0944929694','0949428794','0946629894','0948831294','0944929794','0944841294','0949451294','0944661294','0947471294','0944781294','0944910195','0949410295','0949410395','0945610495','0943301595','0945620195','0948820295','0946820395','0949420495','0946602595','0944430195','0944430295','0946630395','0949430495','0944403595','0946640195','0949940295','0944930395','0946440495','0944104595','0949950195','0948850295','0948440395','0944650495','0946805595','0949960195','0944560295','0946650395','0943460495','0944607595','0949970195','0944770295','0944660395','0949980495','0946508595','0948980195','0945680295','0946770395','0944470495','0949790595','0944411095','0948410295','0948490395','0944910495','0944610595','0944712195','0946811295','0948610395','0942411495','0945311595','0946813195','0943212295','0948111395','0942112495','0946612595','0946814195','0946613295','0943212395','0946613495','0948815195','0949914295','0948413395','0948114495','0944913595','0947716195','0946615295','0946814395','0946615495','0943314595','0946617195','0946616295','0944415395','0946416495','0946015595','0945418195','0945617295','0944416395','0944617495','0947716595','0948619195','0948918295','0944417395','0944618495','0948817595','0949419295','0944618395','0947119495','0943218595','0946621195','0945519395','0942221495','0948621595','0949222195','0944721295','0947420395','0949222495','0948923595','0946623195','0948622295','0949421395','0948623495','0946624595','0942424195','0949923295','0944422395','0944724495','0949625595','0947725195','0947724295','0949923395','0945525495','0948526595','0944927195','0944226295','0949426395','0949926495','0949827595','0949428195','0946627295','0949427395','0944727495','0949428595','0949430195','0944829295','0946828395','0944328495','0944830595','0949610695','0946610795','0944610895','0944810995','0943320695','0944620795','0944720895','0945820995','0948621095','0949440695','0944630795','0947430895','0944850995','0946631095','0949550695','0948650795','0944740895','0942460995','0942441095','0945660695','0946660795','0946550895','0948670995','0948851095','0945670695','0944570795','0944860895','0945980995','0948461095','0947880695','0944480795','0949970895','0946690995','0944471095','0949590695','0945490795','0948980895','0943412995','0946681095','0944710695','0946810795','0944913995','0943891095','0948611695','0949911795','0948611895','0944814995','0946612695','0944412795','0949412895','0944516995','0944611195','0945513695','0944413795','0948813895','0944417995','0948814695','0949414795','0944814895','0946018995','0948631195','0949515695','0949415795','0948915895','0946623995','0945441195','0948916695','0944516795','0944516895','0944824995','0944651195','0949418695','0947717795','0946417895','0947726995','0946461195','0947419695','0948618795','0947718895','0947927995','0948971195','0947420695','0946419795','0948619895','0944428995','0947881195','0944422695','0944221795','0948621895','0947891195','0946623695','0946622795','0949922895','0948425695','0949423795','0949423895','0949901295','0942426695','0943425795','0947425895','0944911295','0947828695','0947726795','0944626895','0946321295','0948929695','0944327795','0949427895','0949331295','0944930695','0946828795','0946629895','0949941295','0944661295','0949471295');
		
	// foreach( $hovaten as $key => $tenNS )
	// {
 
		// $sodienthoai = $sodienthoai[$key];
		// $dataContent['timekeeping_code'] = getRandomNumber( 16 );
		// $dataContent['personnel_code'] = getRandomNumber( 16 );
		// $dataContent['profile_code'] = getRandomNumber( 16 );
		// $dataContent['private_code'] = getRandomNumber( 16 );
		// $dataContent['contract_code'] = getRandomNumber( 16 );
		// $dataContent['job_tax'] = getRandomNumber( 16 );
		// $dataContent['premium_card'] = getRandomNumber( 16 );
		// $dataContent['premium_number'] = getRandomNumber( 20 );
		// $dataContent['full_name'] = $tenNS;
		// $dataContent['email'] = strtolower(str_replace('-', '', change_alias( $dataContent['full_name'] )) . $sodienthoai) . '@gmail.com';

		
		if($personnel_id == 0){
			$_sql = 'SELECT * FROM ' . TABLE_PERSONNEL_NAME . '_personnel where userid = ' . $dataContent['userid'];
			$_query = $db->query($_sql)->fetchall();

			if(!empty($_query) >0){
				$error[] = array('input'=> 'userid', 'mess'=>"Nhân sự đã tồn tại, vui lòng kiểm tra lại thông tin"); 
			}
			if( empty( $error ) )
			{
				try
				{
					if($dataContent['gender'] < 0) {$dataContent['gender'] = 0;}
					if($dataContent['level_school'] < 0) {$dataContent['level_school'] = 0;}
					if($dataContent['department_id'] < 0) {$dataContent['department_id'] = 0;}
					if($dataContent['birthday'] < 0) {$dataContent['birthday'] = 0;}
					if($dataContent['private_code_date'] < 0) {$dataContent['private_code_date'] = 0;}
					if($dataContent['marital_status'] < 0) {$dataContent['marital_status'] = 0;}
					
					if($dataContent['work_type'] < 0) {$dataContent['work_type'] = 0;}
					$stmt = $db->prepare( 'INSERT INTO ' . TABLE_PERSONNEL_NAME . '_personnel SET 
						userid=' . intval( $dataContent['userid'] ) . ',
						timekeeping_code=:timekeeping_code,
						personnel_code=:personnel_code,
						profile_code=:profile_code,
						full_name=:full_name,
						birthday=' . intval( $dataContent['birthday'] ) . ',
						gender=' . intval( $dataContent['gender'] ) . ',
						place_of_birth=:place_of_birth,
						origin_state=:origin_state,
						private_code=:private_code,
						private_code_date=' . intval( $dataContent['private_code_date'] ) . ',
						private_code_place=:private_code_place,
						marital_status=' . intval( $dataContent['marital_status'] ) . ',
						nationality=' . intval( $dataContent['nationality'] ) . ',
						people=' . intval( $dataContent['people'] ) . ',
						religious=' . intval( $dataContent['religious'] ) . ',
						job_bank_account=:job_bank_account,
						job_bank_account_name=:job_bank_account_name,
						job_bank_id=' . intval( $dataContent['job_bank_id'] ) . ',
						job_bank_desc=:job_bank_desc,
						job_tax=:job_tax,				
						level_id=' . intval( $dataContent['level_id'] ) . ',
						level_school=:level_school,
						level_academic=' . intval( $dataContent['level_academic'] ) . ',
						mobile=:mobile,				
						email=:email,				
						home_address=:home_address,				
						place_home=' . intval( $dataContent['place_home'] ) . ',
						current_address=:current_address,				
						place_current=' . intval( $dataContent['place_current'] ) . ',
						contract_code=:contract_code,				
						contract_type=' . intval( $dataContent['contract_type'] ) . ',
						department_id=' . intval( $dataContent['department_id'] ) . ',
						work_type=' . intval( $dataContent['work_type'] ) . ',
						position_id=' . intval( $dataContent['position_id'] ) . ',
						job_title=' . intval( $dataContent['job_title'] ) . ',
						work_place=' . intval( $dataContent['work_place'] ) . ',
						date_start=' . intval( $dataContent['date_start'] ) . ',
						date_finish=' . intval( $dataContent['date_finish'] ) . ',
						date_reg=' . intval( $dataContent['date_reg'] ) . ',
						signer_id=' . intval( $dataContent['signer_id'] ) . ',
						salary_date_from=' . intval( $dataContent['salary_date_from'] ) . ',
						salary_method_id=' . intval( $dataContent['salary_method_id'] ) . ',
						salary_money=:salary_money,
						premium_number=:premium_number,
						premium_insurance_status=' . intval( $dataContent['premium_insurance_status'] ) . ',
						premium_personnel=' . intval( $dataContent['premium_personnel'] ) . ',
						premium_card=' . intval( $dataContent['premium_card'] ) . ',
						premium_code=' . intval( $dataContent['premium_code'] ) . ',
						insup_date_get=' . intval( $dataContent['insup_date_get'] ) . ',
						insup_date_complete=' . intval( $dataContent['insup_date_complete'] ) . ',
						insup_date_receive=' . intval( $dataContent['insup_date_receive'] ) . ',
						insup_date_return=' . intval( $dataContent['insup_date_return'] ) . ',
						insdown_date_get=' . intval( $dataContent['insdown_date_get'] ) . ',
						insdown_date_complete=' . intval( $dataContent['insdown_date_complete'] ) . ',
						insdown_date_apply=' . intval( $dataContent['insdown_date_apply'] ) . ',
						insdown_date_return=' . intval( $dataContent['insdown_date_return'] ) . ',
						status_identity_card=:status_identity_card,				
						resign_to_bill=:resign_to_bill,				
						attachment=' . intval( $attachment ) . ',
						userid_create=' . intval( $user_info['userid'] ) .',
						work_status=' . intval( $dataContent['work_status'] ) .',
						date_added=' . intval( NV_CURRENTTIME ) );

					$stmt->bindParam( ':timekeeping_code', $dataContent['timekeeping_code'], PDO::PARAM_STR );
					$stmt->bindParam( ':personnel_code', $dataContent['personnel_code'], PDO::PARAM_STR );
					$stmt->bindParam( ':profile_code', $dataContent['profile_code'], PDO::PARAM_STR );
					$stmt->bindParam( ':full_name', $dataContent['full_name'], PDO::PARAM_STR );
					$stmt->bindParam( ':place_of_birth', $dataContent['place_of_birth'], PDO::PARAM_STR );
					$stmt->bindParam( ':origin_state', $dataContent['origin_state'], PDO::PARAM_STR );
					$stmt->bindParam( ':private_code', $dataContent['private_code'], PDO::PARAM_STR );
					$stmt->bindParam( ':private_code_place', $dataContent['private_code_place'], PDO::PARAM_STR );
					$stmt->bindParam( ':job_bank_account', $dataContent['job_bank_account'], PDO::PARAM_STR );
					$stmt->bindParam( ':job_bank_account_name', $dataContent['job_bank_account_name'], PDO::PARAM_STR );
					$stmt->bindParam( ':job_bank_desc', $dataContent['job_bank_desc'], PDO::PARAM_STR );
					$stmt->bindParam( ':job_tax', $dataContent['job_tax'], PDO::PARAM_STR );
					
					$stmt->bindParam( ':level_school', $dataContent['level_school'], PDO::PARAM_INT );
					$stmt->bindParam( ':mobile', $dataContent['mobile'], PDO::PARAM_STR );
					$stmt->bindParam( ':email', $dataContent['email'], PDO::PARAM_STR );
					$stmt->bindParam( ':home_address', $dataContent['home_address'], PDO::PARAM_STR );
					$stmt->bindParam( ':current_address', $dataContent['current_address'], PDO::PARAM_STR );
					$stmt->bindParam( ':contract_code', $dataContent['contract_code'], PDO::PARAM_STR );
					$stmt->bindParam( ':salary_money', $dataContent['salary_money'], PDO::PARAM_STR );
					$stmt->bindParam( ':premium_number', $dataContent['premium_number'], PDO::PARAM_STR );
					$stmt->bindParam( ':status_identity_card', $dataContent['status_identity_card'], PDO::PARAM_STR );
					$stmt->bindParam( ':resign_to_bill', $dataContent['resign_to_bill'], PDO::PARAM_STR );

					$stmt->execute();

					if( $dataContent['personnel_id'] = $db->lastInsertId() )
					{
						if( !empty( $dataContent['family'] ) )
						{
							foreach( $dataContent['family'] as $key => $item )
							{
								$item['full_name'] = isset( $item['full_name'] ) ? (string) $item['full_name'] : '';
								$item['birthday'] = isset( $item['birthday'] ) ? (string) $item['birthday'] : '';
								$item['job'] = isset( $item['job'] ) ? (string) $item['job'] : '';
								$item['origin_state_address'] = isset( $item['origin_state_address'] ) ? (string) $item['origin_state_address'] : '';
								$item['phone'] = isset( $item['phone'] ) ? (string) $item['phone'] : '';
								$item['relative_id'] = isset( $item['relative_id'] ) ? (int) $item['relative_id'] : 0;
								if($item['relative_id'] < 0 ) {$item['relative_id'] = 0;}
								$item['is_dependent'] = isset( $item['is_dependent'] ) ? (int) $item['is_dependent'] : '';
								if($item['is_dependent'] < 0 ) {$item['is_dependent'] = 0;}
								$db->query('INSERT INTO ' . TABLE_PERSONNEL_NAME . '_family SET
									personnel_id='. intval( $dataContent['personnel_id'] ) .',
									full_name='. $db->quote( $item['full_name'] ) .',
									birthday='. $db->quote( $item['birthday'] ) .',
									job='. $db->quote( $item['job'] ) .',
									origin_state_address='. $db->quote( $item['origin_state_address'] ) .',
									phone='. $db->quote( $item['phone'] ) .',
									relative_id='. intval( $item['relative_id'] ) . ',
									is_dependent='. intval( $item['is_dependent'] ) );
								
								// family[0][relative_id]: 1
								// family[0][full_name]: Đặng Hữu Lành
								// family[0][birthday]: 15/09/1954
								// family[0][job]: Tự do
								// family[0][origin_state_address]: Hà nội
								// family[0][phone]: 09543454353
								// family[0][is_dependent]: 5
							}
						}
						
						if( !empty( $dataContent['degrees'] ) )
						{
							foreach( $dataContent['degrees'] as $key => $item )
							{
								$item['date_from'] = isset( $item['date_from'] ) ? (string) $item['date_from'] : '';
								$item['date_to'] = isset( $item['date_to'] ) ? (string) $item['date_to'] : '';
								$item['specialization'] = isset( $item['specialization'] ) ? (string) $item['specialization'] : '';
								$item['place'] = isset( $item['place'] ) ? (string) $item['place'] : '';
								$item['type_id'] = isset( $item['type_id'] ) ? (int) $item['type_id'] : '';
								$item['level_id'] = isset( $item['level_id'] ) ? (int) $item['level_id'] : '';
								if($item['level_id'] < 0 ) {$item['level_id'] = 0;}
								if($item['type_id'] < 0 ) {$item['type_id'] = 0;}
								$db->query('INSERT INTO ' . TABLE_PERSONNEL_NAME . '_degrees SET
									personnel_id='. intval( $dataContent['personnel_id'] ) .',
									date_from='. $db->quote( $item['date_from'] ) .',
									date_to='. $db->quote( $item['date_to'] ) .',
									specialization='. $db->quote( $item['specialization'] ) .',
									place='. $db->quote( $item['place'] ) .',
									level_id='. intval( $item['level_id'] ) . ',
									type_id='. intval( $item['type_id'] ) );
								// degrees[0][date_from]: 11/2020
								// degrees[0][date_to]: 11/2020
								// degrees[0][type_id]: 27
								// degrees[0][specialization]: Lập Trình
								// degrees[0][level_id]: 17
								// degrees[0][place]: Đại học cntt và truyền thông thái nguyên
								 
							}
						}
			
						if( !empty( $dataContent['historySolves'] ) )
						{
							foreach( $dataContent['historySolves'] as $key => $item )
							{
								$item['model'] = isset( $item['model'] ) ? (int) $item['model'] : 0;
								
								$item['premium_date_get'] = isset( $item['premium_date_get'] ) ? (string) $item['premium_date_get'] : 0;
								$item['premium_date_get'] = convertToTimeStamp( $item['premium_date_get'] );
		 
								$item['premium_date_complete'] = isset( $item['premium_date_complete'] ) ? (string) $item['premium_date_complete'] : 0;
								$item['premium_date_complete'] = convertToTimeStamp( $item['premium_date_complete'] );
								
								$item['premium_date_close'] = isset( $item['premium_date_close'] ) ? (string) $item['premium_date_close'] : 0;
								$item['premium_date_close'] = convertToTimeStamp( $item['premium_date_close'] );
								
								$item['premium_date_return'] = isset( $item['premium_date_return'] ) ? (string) $item['premium_date_return'] : 0;
								$item['premium_date_return'] = convertToTimeStamp( $item['premium_date_return'] );
								
								$item['price'] = isset( $item['price'] ) ? doubleval($item['price']) : 0;
								$item['price'] = preg_replace('/[^0-9\.]/', '', $item['price'] );
								
								$db->query('INSERT INTO ' . TABLE_PERSONNEL_NAME . '_history_solves SET
									personnel_id='. intval( $dataContent['personnel_id'] ) .',
									premium_date_get='. intval( $item['premium_date_get'] ) .',
									premium_date_complete='. intval( $item['premium_date_complete'] ) .',
									premium_date_close='. intval( $item['premium_date_close'] ) .',
									premium_date_return='. intval( $item['premium_date_return'] ) .',
									price='. doubleval( $item['price'] ) );
		 
							}
						}
			
						if( !empty( $dataContent['historyInsurances'] ) )
						{
							foreach( $dataContent['historyInsurances'] as $key => $item )
							{
								$item['date_from'] = isset( $item['date_from'] ) ? (string) $item['date_from'] : 0;
		  
								$item['type'] = isset( $item['type'] ) ? (string) $item['type'] : 0;
								$item['reason'] = isset( $item['reason'] ) ? (string) $item['reason'] : 0;
		 
								$item['salary_premium_base'] = isset( $item['salary_premium_base'] ) ? doubleval( $item['salary_premium_base'] ): 0;
								$item['salary_premium_base'] = preg_replace('/[^0-9\.]/', '', $item['salary_premium_base']);
								
								$db->query('INSERT INTO ' . TABLE_PERSONNEL_NAME . '_history_insurances SET
									personnel_id='. intval( $dataContent['personnel_id'] ) .',
									date_from='. $db->quote( $item['date_from'] ) .',
									type='. $db->quote( $item['type'] ) .',
									reason='. $db->quote( $item['reason'] ) .',
									salary_premium_base='. doubleval( $item['salary_premium_base'] ) );	
		 
							}
						}
						
						if( !empty( $dataContent['allowances'] ) )
						{
							foreach( $dataContent['allowances'] as $key => $item )
							{
								
								$item['allow_id'] = isset( $item['allow_id'] ) ? $item['allow_id'] : 0;
								$item['money'] = isset( $item['money'] ) ? $item['money'] : 0;
								$item['money'] = preg_replace('/[^0-9\.]/', '', $item['money']);
								if( $item['allow_id'] > 0 )
								{
									$db->query('INSERT INTO ' . TABLE_PERSONNEL_NAME . '_allowances SET
									personnel_id='. intval( $dataContent['personnel_id'] ) .',
									allow_id='. intval( $item['allow_id'] ) .',
									money='. $db->quote( $item['money'] ) );
								}
		 
							}
						}
						
						if( !empty( $dataContent['experience'] ) )
						{
							foreach( $dataContent['experience'] as $key => $item )
							{
								$item['date_from'] = isset( $item['date_from'] ) ? (string) $item['date_from'] : '';
								$item['date_to'] = isset( $item['date_to'] ) ? (string) $item['date_to'] : '';
								$item['company_title'] = isset( $item['company_title'] ) ? (string) $item['company_title'] : '';
								$item['contact_info'] = isset( $item['contact_info'] ) ? (string) $item['contact_info'] : '';
								$item['phone'] = isset( $item['phone'] ) ? (string) $item['phone'] : '';
								$item['work_desc'] = isset( $item['work_desc'] ) ? (string) $item['work_desc'] : '';
								$item['position_id'] = isset( $item['position_id'] ) ? (string) $item['position_id'] : '';
								
		 
								$db->query('INSERT INTO ' . TABLE_PERSONNEL_NAME . '_experience SET
									personnel_id='. intval( $dataContent['personnel_id'] ) .',
									date_from='. $db->quote( $item['date_from'] ) .',
									date_to='. $db->quote( $item['date_to'] ) .',
									company_title='. $db->quote( $item['company_title'] ) .',
									contact_info='. $db->quote( $item['contact_info'] ) .',
									phone='. $db->quote( $item['phone'] ) .',
									work_desc='. $db->quote( $item['work_desc'] ) .',
									position_id='. $db->quote( $item['position_id'] ) );
								// experience[0][date_from]: 11/2020
								// experience[0][date_to]: 11/2020
								// experience[0][company_title]: Ở nahf choiq
								// experience[0][position_id]: sda sad á
								// experience[0][contact_info]: ds ad sad
								// experience[0][phone]: 435454353435
								// experience[0][work_desc]: dfd sf sdf sfsd fds
							}
						}
						
						if( !empty( $dataContent['attachments'] ) )
						{
							$db->query( 'UPDATE ' . $db_config['prefix'] . '_attachment SET rid = ' . $dataContent['personnel_id'] . ' WHERE attachment_id IN ( ' . implode( $dataContent['attachments'] )  . ' ) AND userid=' . intval( $user_info['userid'] ) );	
						}
						
						$json['success']= $lang_module['register_success_create'];
					}
				}
				catch ( PDOException $e )
				{
					$error['warning'] = $lang_module['register_error_save'];
				}
				
			}
			else
			{
				$json['error']= $error;
			}
		}
		else{
			
			if( empty( $error ) )
			{
				
				try
				{
					
					if($dataContent['gender'] < 0) {$dataContent['gender'] = 0;}
					if($dataContent['level_school'] < 0) {$dataContent['level_school'] = 0;}
					if($dataContent['department_id'] < 0) {$dataContent['department_id'] = 0;}
					if($dataContent['birthday'] < 0) {$dataContent['birthday'] = 0;}
					if($dataContent['private_code_date'] < 0) {$dataContent['private_code_date'] = 0;}
					if($dataContent['marital_status'] < 0) {$dataContent['marital_status'] = 0;}
					
					if($dataContent['work_type'] < 0) {$dataContent['work_type'] = 0;}
					$stmt = $db->prepare( 'UPDATE ' . TABLE_PERSONNEL_NAME . '_personnel SET 
						userid=' . intval( $dataContent['userid'] ) . ',
						timekeeping_code=:timekeeping_code,
						personnel_code=:personnel_code,
						profile_code=:profile_code,
						full_name=:full_name,
						birthday=' . intval( $dataContent['birthday'] ) . ',
						gender=' . intval( $dataContent['gender'] ) . ',
						place_of_birth=:place_of_birth,
						origin_state=:origin_state,
						private_code=:private_code,
						private_code_date=' . intval( $dataContent['private_code_date'] ) . ',
						private_code_place=:private_code_place,
						marital_status=' . intval( $dataContent['marital_status'] ) . ',
						nationality=' . intval( $dataContent['nationality'] ) . ',
						people=' . intval( $dataContent['people'] ) . ',
						religious=' . intval( $dataContent['religious'] ) . ',
						job_bank_account=:job_bank_account,
						job_bank_account_name=:job_bank_account_name,
						job_bank_id=' . intval( $dataContent['job_bank_id'] ) . ',
						job_bank_desc=:job_bank_desc,
						job_tax=:job_tax,				
						level_id=' . intval( $dataContent['level_id'] ) . ',
						level_school=:level_school,
						level_academic=' . intval( $dataContent['level_academic'] ) . ',
						mobile=:mobile,				
						email=:email,				
						home_address=:home_address,				
						place_home=' . intval( $dataContent['place_home'] ) . ',
						current_address=:current_address,				
						place_current=' . intval( $dataContent['place_current'] ) . ',
						contract_code=:contract_code,				
						contract_type=' . intval( $dataContent['contract_type'] ) . ',
						department_id=' . intval( $dataContent['department_id'] ) . ',
						work_type=' . intval( $dataContent['work_type'] ) . ',
						position_id=' . intval( $dataContent['position_id'] ) . ',
						job_title=' . intval( $dataContent['job_title'] ) . ',
						work_place=' . intval( $dataContent['work_place'] ) . ',
						date_start=' . intval( $dataContent['date_start'] ) . ',
						date_finish=' . intval( $dataContent['date_finish'] ) . ',
						date_reg=' . intval( $dataContent['date_reg'] ) . ',
						signer_id=' . intval( $dataContent['signer_id'] ) . ',
						salary_date_from=' . intval( $dataContent['salary_date_from'] ) . ',
						salary_method_id=' . intval( $dataContent['salary_method_id'] ) . ',
						salary_money=:salary_money,
						premium_number=:premium_number,
						premium_insurance_status=' . intval( $dataContent['premium_insurance_status'] ) . ',
						premium_personnel=' . intval( $dataContent['premium_personnel'] ) . ',
						premium_card=' . intval( $dataContent['premium_card'] ) . ',
						premium_code=' . intval( $dataContent['premium_code'] ) . ',
						insup_date_get=' . intval( $dataContent['insup_date_get'] ) . ',
						insup_date_complete=' . intval( $dataContent['insup_date_complete'] ) . ',
						insup_date_receive=' . intval( $dataContent['insup_date_receive'] ) . ',
						insup_date_return=' . intval( $dataContent['insup_date_return'] ) . ',
						insdown_date_get=' . intval( $dataContent['insdown_date_get'] ) . ',
						insdown_date_complete=' . intval( $dataContent['insdown_date_complete'] ) . ',
						insdown_date_apply=' . intval( $dataContent['insdown_date_apply'] ) . ',
						insdown_date_return=' . intval( $dataContent['insdown_date_return'] ) . ',
						status_identity_card=:status_identity_card,				
						resign_to_bill=:resign_to_bill,				
						attachment=' . intval( $attachment ) . ',
						userid_create=' . intval( $user_info['userid'] ) .',
						work_status=' . intval( $dataContent['work_status'] ) .',
						date_added=' . intval( NV_CURRENTTIME ) . '
						WHERE personnel_id = ' . $personnel_id
						);

					$stmt->bindParam( ':timekeeping_code', $dataContent['timekeeping_code'], PDO::PARAM_STR );
					$stmt->bindParam( ':personnel_code', $dataContent['personnel_code'], PDO::PARAM_STR );
					$stmt->bindParam( ':profile_code', $dataContent['profile_code'], PDO::PARAM_STR );
					$stmt->bindParam( ':full_name', $dataContent['full_name'], PDO::PARAM_STR );
					$stmt->bindParam( ':place_of_birth', $dataContent['place_of_birth'], PDO::PARAM_STR );
					$stmt->bindParam( ':origin_state', $dataContent['origin_state'], PDO::PARAM_STR );
					$stmt->bindParam( ':private_code', $dataContent['private_code'], PDO::PARAM_STR );
					$stmt->bindParam( ':private_code_place', $dataContent['private_code_place'], PDO::PARAM_STR );
					$stmt->bindParam( ':job_bank_account', $dataContent['job_bank_account'], PDO::PARAM_STR );
					$stmt->bindParam( ':job_bank_account_name', $dataContent['job_bank_account_name'], PDO::PARAM_STR );
					$stmt->bindParam( ':job_bank_desc', $dataContent['job_bank_desc'], PDO::PARAM_STR );
					$stmt->bindParam( ':job_tax', $dataContent['job_tax'], PDO::PARAM_STR );
					
					$stmt->bindParam( ':level_school', $dataContent['level_school'], PDO::PARAM_INT );
					$stmt->bindParam( ':mobile', $dataContent['mobile'], PDO::PARAM_STR );
					$stmt->bindParam( ':email', $dataContent['email'], PDO::PARAM_STR );
					$stmt->bindParam( ':home_address', $dataContent['home_address'], PDO::PARAM_STR );
					$stmt->bindParam( ':current_address', $dataContent['current_address'], PDO::PARAM_STR );
					$stmt->bindParam( ':contract_code', $dataContent['contract_code'], PDO::PARAM_STR );
					$stmt->bindParam( ':salary_money', $dataContent['salary_money'], PDO::PARAM_STR );
					$stmt->bindParam( ':premium_number', $dataContent['premium_number'], PDO::PARAM_STR );
					$stmt->bindParam( ':status_identity_card', $dataContent['status_identity_card'], PDO::PARAM_STR );
					$stmt->bindParam( ':resign_to_bill', $dataContent['resign_to_bill'], PDO::PARAM_STR );

					$stmt->execute();
					if( $dataContent['personnel_id'] = $personnel_id )
					{
						if( !empty( $dataContent['family'] ) )
						{
							$db->query('DELETE FROM ' . TABLE_PERSONNEL_NAME . '_family WHERE personnel_id = ' . $personnel_id);
							foreach( $dataContent['family'] as $key => $item )
							{
								$item['full_name'] = isset( $item['full_name'] ) ? (string) $item['full_name'] : '';
								$item['birthday'] = isset( $item['birthday'] ) ? (string) $item['birthday'] : '';
								$item['job'] = isset( $item['job'] ) ? (string) $item['job'] : '';
								$item['origin_state_address'] = isset( $item['origin_state_address'] ) ? (string) $item['origin_state_address'] : '';
								$item['phone'] = isset( $item['phone'] ) ? (string) $item['phone'] : '';
								$item['relative_id'] = isset( $item['relative_id'] ) ? (int) $item['relative_id'] : 0;
								if($item['relative_id'] < 0 ) {$item['relative_id'] = 0;}
								$item['is_dependent'] = isset( $item['is_dependent'] ) ? (int) $item['is_dependent'] : '';
								if($item['is_dependent'] < 0 ) {$item['is_dependent'] = 0;}
		 
								$db->query('INSERT INTO ' . TABLE_PERSONNEL_NAME . '_family SET
									personnel_id='. intval( $dataContent['personnel_id'] ) .',
									full_name='. $db->quote( $item['full_name'] ) .',
									birthday='. $db->quote( $item['birthday'] ) .',
									job='. $db->quote( $item['job'] ) .',
									origin_state_address='. $db->quote( $item['origin_state_address'] ) .',
									phone='. $db->quote( $item['phone'] ) .',
									relative_id='. intval( $item['relative_id'] ) . ',
									is_dependent='. intval( $item['is_dependent'] ) );
								
								// family[0][relative_id]: 1
								// family[0][full_name]: Đặng Hữu Lành
								// family[0][birthday]: 15/09/1954
								// family[0][job]: Tự do
								// family[0][origin_state_address]: Hà nội
								// family[0][phone]: 09543454353
								// family[0][is_dependent]: 5
							}
						}
						
						if( !empty( $dataContent['degrees'] ) )
						{
							$db->query('DELETE FROM ' . TABLE_PERSONNEL_NAME . '_degrees WHERE personnel_id = ' . $personnel_id);
							foreach( $dataContent['degrees'] as $key => $item )
							{
								$item['date_from'] = isset( $item['date_from'] ) ? (string) $item['date_from'] : '';
								$item['date_to'] = isset( $item['date_to'] ) ? (string) $item['date_to'] : '';
								$item['specialization'] = isset( $item['specialization'] ) ? (string) $item['specialization'] : '';
								$item['place'] = isset( $item['place'] ) ? (string) $item['place'] : '';
								$item['type_id'] = isset( $item['type_id'] ) ? (int) $item['type_id'] : '';
								$item['level_id'] = isset( $item['level_id'] ) ? (int) $item['level_id'] : '';
								if($item['level_id'] < 0 ) {$item['level_id'] = 0;}
								if($item['type_id'] < 0 ) {$item['type_id'] = 0;}
		 
								$db->query('INSERT INTO ' . TABLE_PERSONNEL_NAME . '_degrees SET
									personnel_id='. intval( $dataContent['personnel_id'] ) .',
									date_from='. $db->quote( $item['date_from'] ) .',
									date_to='. $db->quote( $item['date_to'] ) .',
									specialization='. $db->quote( $item['specialization'] ) .',
									place='. $db->quote( $item['place'] ) .',
									level_id='. intval( $item['level_id'] ) . ',
									type_id='. intval( $item['type_id'] ) );
								// degrees[0][date_from]: 11/2020
								// degrees[0][date_to]: 11/2020
								// degrees[0][type_id]: 27
								// degrees[0][specialization]: Lập Trình
								// degrees[0][level_id]: 17
								// degrees[0][place]: Đại học cntt và truyền thông thái nguyên
								 
							}
						}
			
						if( !empty( $dataContent['historySolves'] ) )
						{
							$db->query('DELETE FROM ' . TABLE_PERSONNEL_NAME . '_history_solves WHERE personnel_id = ' . $personnel_id);
							foreach( $dataContent['historySolves'] as $key => $item )
							{
								$item['model'] = isset( $item['model'] ) ? (int) $item['model'] : 0;
								
								$item['premium_date_get'] = isset( $item['premium_date_get'] ) ? (string) $item['premium_date_get'] : 0;
								$item['premium_date_get'] = convertToTimeStamp( $item['premium_date_get'] );
		 
								$item['premium_date_complete'] = isset( $item['premium_date_complete'] ) ? (string) $item['premium_date_complete'] : 0;
								$item['premium_date_complete'] = convertToTimeStamp( $item['premium_date_complete'] );
								
								$item['premium_date_close'] = isset( $item['premium_date_close'] ) ? (string) $item['premium_date_close'] : 0;
								$item['premium_date_close'] = convertToTimeStamp( $item['premium_date_close'] );
								
								$item['premium_date_return'] = isset( $item['premium_date_return'] ) ? (string) $item['premium_date_return'] : 0;
								$item['premium_date_return'] = convertToTimeStamp( $item['premium_date_return'] );
								
								$item['price'] = isset( $item['price'] ) ? doubleval($item['price']) : 0;
								$item['price'] = preg_replace('/[^0-9\.]/', '', $item['price'] );
								
								$db->query('INSERT INTO ' . TABLE_PERSONNEL_NAME . '_history_solves SET
									personnel_id='. intval( $dataContent['personnel_id'] ) .',
									premium_date_get='. intval( $item['premium_date_get'] ) .',
									premium_date_complete='. intval( $item['premium_date_complete'] ) .',
									premium_date_close='. intval( $item['premium_date_close'] ) .',
									premium_date_return='. intval( $item['premium_date_return'] ) .',
									price='. doubleval( $item['price'] ) );
		 
							}
						}
			
						if( !empty( $dataContent['historyInsurances'] ) )
						{
							$db->query('DELETE FROM ' . TABLE_PERSONNEL_NAME . '_history_insurances WHERE personnel_id = ' . $personnel_id);
							foreach( $dataContent['historyInsurances'] as $key => $item )
							{
								$item['date_from'] = isset( $item['date_from'] ) ? (string) $item['date_from'] : 0;
		  
								$item['type'] = isset( $item['type'] ) ? (string) $item['type'] : 0;
								$item['reason'] = isset( $item['reason'] ) ? (string) $item['reason'] : 0;
		 
								$item['salary_premium_base'] = isset( $item['salary_premium_base'] ) ? doubleval( $item['salary_premium_base'] ): 0;
								$item['salary_premium_base'] = preg_replace('/[^0-9\.]/', '', $item['salary_premium_base']);
								
								$db->query('INSERT INTO ' . TABLE_PERSONNEL_NAME . '_history_insurances SET
									personnel_id='. intval( $dataContent['personnel_id'] ) .',
									date_from='. $db->quote( $item['date_from'] ) .',
									type='. $db->quote( $item['type'] ) .',
									reason='. $db->quote( $item['reason'] ) .',
									salary_premium_base='. doubleval( $item['salary_premium_base'] ) );	
		 
							}
						}
						
						if( !empty( $dataContent['allowances'] ) )
						{
							$db->query('DELETE FROM ' . TABLE_PERSONNEL_NAME . '_allowances WHERE personnel_id = ' . $personnel_id);
							foreach( $dataContent['allowances'] as $key => $item )
							{
								
								$item['allow_id'] = isset( $item['allow_id'] ) ? $item['allow_id'] : 0;
								$item['money'] = isset( $item['money'] ) ? $item['money'] : 0;
								$item['money'] = preg_replace('/[^0-9\.]/', '', $item['money']);
								if( $item['allow_id'] > 0 )
								{
									$db->query('INSERT INTO ' . TABLE_PERSONNEL_NAME . '_allowances SET
									personnel_id='. intval( $dataContent['personnel_id'] ) .',
									allow_id='. intval( $item['allow_id'] ) .',
									money='. $db->quote( $item['money'] ) );
								}
		 
							}
						}
						
						if( !empty( $dataContent['experience'] ) )
						{
							$db->query('DELETE FROM ' . TABLE_PERSONNEL_NAME . '_experience WHERE personnel_id = ' . $personnel_id);
							foreach( $dataContent['experience'] as $key => $item )
							{
								$item['date_from'] = isset( $item['date_from'] ) ? (string) $item['date_from'] : '';
								$item['date_to'] = isset( $item['date_to'] ) ? (string) $item['date_to'] : '';
								$item['company_title'] = isset( $item['company_title'] ) ? (string) $item['company_title'] : '';
								$item['contact_info'] = isset( $item['contact_info'] ) ? (string) $item['contact_info'] : '';
								$item['phone'] = isset( $item['phone'] ) ? (string) $item['phone'] : '';
								$item['work_desc'] = isset( $item['work_desc'] ) ? (string) $item['work_desc'] : '';
								$item['position_id'] = isset( $item['position_id'] ) ? (string) $item['position_id'] : '';
								
		 
								$db->query('INSERT INTO ' . TABLE_PERSONNEL_NAME . '_experience SET
									personnel_id='. intval( $dataContent['personnel_id'] ) .',
									date_from='. $db->quote( $item['date_from'] ) .',
									date_to='. $db->quote( $item['date_to'] ) .',
									company_title='. $db->quote( $item['company_title'] ) .',
									contact_info='. $db->quote( $item['contact_info'] ) .',
									phone='. $db->quote( $item['phone'] ) .',
									work_desc='. $db->quote( $item['work_desc'] ) .',
									position_id='. $db->quote( $item['position_id'] ) );
								// experience[0][date_from]: 11/2020
								// experience[0][date_to]: 11/2020
								// experience[0][company_title]: Ở nahf choiq
								// experience[0][position_id]: sda sad á
								// experience[0][contact_info]: ds ad sad
								// experience[0][phone]: 435454353435
								// experience[0][work_desc]: dfd sf sdf sfsd fds
							}
						}
						
						if( !empty( $dataContent['attachments'] ) )
						{
							$db->query( 'UPDATE ' . $db_config['prefix'] . '_attachment SET rid = ' . $dataContent['personnel_id'] . ' WHERE attachment_id IN ( ' . implode( $dataContent['attachments'] )  . ' ) AND userid=' . intval( $user_info['userid'] ) );	
						}
						
						$json['success']= $lang_module['register_success_update'];
					}
				}
				catch ( PDOException $e )
				{
					$error[] = array('input' => '', 'mess' => $lang_module['register_error_save']);
					var_dump($e);die;
				}
				
			}
			else
			{
				$json['error']= $error;
			}
		}
		
	// }
	
 
	
	
	nv_jsonOutput( $json );
}


if( isset( $array_op[1] ) )
{
	$getId = explode('-', $array_op[1]);
	$personnel_id = intval( $getId[0] );
	if( $personnel_id == 0  )
	{
		$base_url_rewrite = nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=workforce', true );
	
		//chuyen huong neu doi alias
		header( 'HTTP/1.1 301 Moved Permanently' );
		Header( 'Location: ' . $base_url_rewrite );
		die();
	}
}
$dataAddress = array();
$dataJson = array();
if( $personnel_id == 0 )
{
	$dataContent['userid'] = 0;
	$dataContent = array(
		'gender'=> '-1',
		'level_school'=> '',
		'marital_status'=> '',
		'department_id'=> '',
		'work_type'=> '',
		'family'=> array(),
	);
	$dataContent['family'][]= array(
		'relative_id'=> '',
		'full_name'=> '',
		'birthday'=> '',
		'job'=> '',
		'origin_state_address'=> '',
		'phone'=> '',
		'is_dependent'=> 0,
	);
	$dataContent['degrees'][]= array(
		'date_from'=> '',
		'date_to'=> '',
		'type_id'=> '',
		'specialization'=> '',
		'level_id'=> '',
		'place'=> ''
	);
	$dataContent['allowances'][]= array(
		'allow_id'=> '',
		'money'=> ''
	);
	 $dataContent['experience'][]= array(
		'allow_id'=> '',
		'money'=> ''
	);
	$dataContent['historyInsurances'][]= array(
		'allow_id'=> '',
		'money'=> ''
	);
	$dataContent['historySolves'][]= array(
		'allow_id'=> '',
		'money'=> ''
	);
	$dataContent['attachments'][]= array(
		'attachment_id'=> '',
		'basename'=> '',
		'size'=> '',
		'token'=> ''
	);
	$dataContent['personnel_id'] = 0;
	$dataContent['department_id'] = 0;
	$dataContent['status_identity_card'] = array();
	$dataContent['resign_to_bill'] = array();
	$dataContent['place_current'] = 0;
	$dataContent['place_home'] = 0;
	$dataContent['premium_place'] = 0;
	$dataContent['signer_id'] = 0;
	$dataContent['signer_name'] = ''; 
	$dataContent['header_title'] = $lang_module['register_create'];
	$dataContent['userid'] = 0;
}
else
{
	$dataContent = $db->query('SELECT * FROM ' . TABLE_PERSONNEL_NAME . '_personnel WHERE personnel_id=' . intval( $personnel_id ) )->fetch();
	$dataContent['header_title'] = $lang_module['register_update'];
	$dataContent['private_code_date'] = $dataContent['private_code_date'] ? date('d/m/Y', $dataContent['private_code_date']) : '';
	$dataContent['date_start'] = $dataContent['date_start'] ? date('d/m/Y', $dataContent['date_start']) : '';
	$dataContent['date_finish'] = $dataContent['date_finish'] ? date('d/m/Y', $dataContent['date_finish']) : '';
	$dataContent['date_reg'] = $dataContent['date_reg'] ? date('d/m/Y', $dataContent['date_reg']) : '';
	$dataContent['salary_date_from'] = $dataContent['salary_date_from'] ? date('d/m/Y', $dataContent['salary_date_from']) : '';
	$dataContent['birthday'] = $dataContent['birthday'] ? date('d/m/Y', $dataContent['birthday']) : '';
	$dataContent['status_identity_card'] = $dataContent['status_identity_card'] ? array_map('intval', explode(',', $dataContent['status_identity_card']) ) : array();
	$dataContent['resign_to_bill'] = $dataContent['resign_to_bill'] ? array_map('intval', explode(',', $dataContent['resign_to_bill']) ) : array();
 
	
	
	$address = array();
	$address[] = intval( $dataContent['place_current'] ); 
	$address[] = intval( $dataContent['place_home'] ); 
	$address[] = intval( $dataContent['premium_place'] ); 
	$address = array_unique( array_filter( $address ) );
	if( $address )
	{
		$result = $db->query('SELECT ward_id, CONCAT(title,\', \', address) AS address FROM ' . TABLE_LOCATION_NAME . '_ward WHERE ward_id IN (' . implode( ',', $address ) .')');
		while( $item = $result->fetch() ) 
		{
			$dataAddress[$item['ward_id']][] = $item;
		}
		$result->closeCursor();
	}
	
	$dataContent['signer_name'] = $db->query('SELECT full_name FROM ' . TABLE_PERSONNEL_NAME . '_personnel WHERE signer_id=' . intval( $dataContent['signer_id'] ) )->fetchColumn();
	
	$dataContent['family'] =array();
	$result = $db->query('SELECT * FROM ' . TABLE_PERSONNEL_NAME . '_family WHERE personnel_id=' . intval( $personnel_id ) );
	while( $item = $result->fetch() ) 
	{
		$dataContent['family'][] = $item;
	}
	$result->closeCursor();
	
	$dataContent['degrees'] =array();
	$result = $db->query('SELECT * FROM ' . TABLE_PERSONNEL_NAME . '_degrees WHERE personnel_id=' . intval( $personnel_id ) );
	while( $item = $result->fetch() ) 
	{
		$dataContent['degrees'][] = $item;
	}
	$result->closeCursor();
	$dataContent['allowances'] =array();
	$result = $db->query('SELECT * FROM ' . TABLE_PERSONNEL_NAME . '_allowances WHERE personnel_id=' . intval( $personnel_id ) );
	while( $item = $result->fetch() ) 
	{
		$dataContent['allowances'][] = $item;
	}
	$result->closeCursor();
	$dataContent['experience'] =array();
	$result = $db->query('SELECT * FROM ' . TABLE_PERSONNEL_NAME . '_experience WHERE personnel_id=' . intval( $personnel_id ) );
	while( $item = $result->fetch() ) 
	{
		$dataContent['experience'][] = $item;
	}
	$result->closeCursor();
	$dataContent['historyInsurances'] =array();
	$result = $db->query('SELECT * FROM ' . TABLE_PERSONNEL_NAME . '_history_insurances WHERE personnel_id=' . intval( $personnel_id ) );
	while( $item = $result->fetch() ) 
	{
		$dataContent['historyInsurances'][] = $item;
	}
	$result->closeCursor();
	$dataContent['historySolves'] =array();
	$result = $db->query('SELECT * FROM ' . TABLE_PERSONNEL_NAME . '_history_solves WHERE personnel_id=' . intval( $personnel_id ) );
	while( $item = $result->fetch() ) 
	{
		$dataContent['historySolves'][] = $item;
	}
	$result->closeCursor();
	$dataContent['attachments'] =array();
	$result = $db->query('SELECT * FROM ' . TABLE_ATTACHMENT_NAME .' WHERE in_mod='. $db->quote( $module_name ) .' AND rid=' . intval( $personnel_id ) );
	while( $item = $result->fetch() ) 
	{
		if( ! isset( $_SESSION[$module_data . '_attachment' . $item['attachment_id']] ) ) $_SESSION[$module_data . '_attachment' . $item['attachment_id']] = array();

		$_SESSION[$module_data . '_attachment' . $item['attachment_id']] = array(
			'basename' => $item['basename'],
			'newname' => $item['newname'],
			'mime' => $item['mime'],
			'ext' => $item['ext'],
			'size' => $item['size'] );
		$dataContent['attachments'][] = $item;
	}
	$result->closeCursor();
	
	
	$dataJson = array(
		'nationality' => $dataContent['nationality'],
		'level_id' => $dataContent['level_id'],
		'level_academic' => $dataContent['level_academic'],
		'place_current' => $dataContent['place_current'],
		'contract_type' => $dataContent['contract_type'],
		'people' => $dataContent['people'],
		'position_id' => $dataContent['position_id'],
		'job_title' => $dataContent['job_title'],
		'job_bank_id' => $dataContent['job_bank_id'],
		'religious' => $dataContent['religious'],
		'premium_code' => $dataContent['premium_code'],
		'work_place' => $dataContent['work_place'],
		'premium_insurance_status' => $dataContent['premium_insurance_status'],
		'salary_method_id' => $dataContent['salary_method_id'],
		'premium_personnel' => $dataContent['premium_personnel'],
		'premium_place' => $dataContent['premium_place'],
		'place_home' => $dataContent['place_home'],
		'attachments' => $dataContent['attachments'],
		'signer_id' => $dataContent['signer_id'],
		
		
	);
}


$dataContent['users'] = $array_userid_users;
$contents = ThemeViewRegister( $dataContent, $dataJson, $dataAddress);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';
