<?php

/**
 * @Project NUKEVIET 4.x
 * @Author DANGDINHTU (dlinhvan@gmail.com)
 * @Copyright (C) 2019 DANG DINH TU. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Wed, 04 Sep 2019 17:00:00 GMT
 */

if( ! defined( 'NV_IS_FILE_MODULES' ) ) die( 'Stop!!!' );

$sql_drop_module = array();

$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . '_personnel';
$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . '_data';
$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . '_setting';
$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . '_premium';
$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . '_allowances';
$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . '_degrees';
$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . '_experience';
$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . '_family';
$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . '_history_insurances';
$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . '_history_solves';
$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . '_registermedical';
$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . '_timekeeper';
$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . '_timekeeper_schedule';
 
$sql_create_module = $sql_drop_module;
 
$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_personnel (
	personnel_id mediumint NOT NULL AUTO_INCREMENT,
	userid mediumint UNSIGNED NOT NULL,
	personnel_code varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Mã nhân viên',
	timekeeping_code varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Mã chấm công',
	profile_code varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Mã hồ sơ',
	full_name varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Họ và tên',
	gender tinyint UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Giới tính',
	birthday int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Ngày sinh',
	place_of_birth varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Nơi sinh',
	origin_state varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Nguyên quán',
	private_code varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'CMT/Căn cước/Hộ Chiếu',
	private_code_date int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Ngày cấp CMT',
	private_code_place varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Nơi cấp',
	marital_status tinyint UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Tình trạng hôn nhân',
	nationality smallint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Quốc tịch',
	people smallint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Dân tộc: Kinh...',
	religious smallint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Tôn giáo',
	job_bank_account varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Số tài khoản BANK',
	job_bank_account_name varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Tên tài khoản BANK',
	job_bank_id mediumint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'ID ngân hàng',
	job_bank_desc varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Chi nhánh',
	job_tax varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Mã số thuế cá nhân',
	level_id smallint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Cấp bậc',
	level_school smallint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Trình độ phổ thông',
	level_academic smallint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Trình độ chuyên môn cao nhất',
	mobile varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Điện thoại',
	email varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Email',
	home_address varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Địa chỉ nhà',
	place_home mediumint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Nơi ở thường trú',
	current_address varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Địa chỉ hiện tại',
	place_current mediumint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'ID nơi ở hiện tại',
	photo varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Ảnh đại diện',
	description text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ghi chú',
	contract_code varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Mã hợp đồng',
	contract_type smallint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Loại hợp đồng',
	department_id smallint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Phòng ban',
	work_type smallint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Hình thức làm việc',
	position_id smallint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Vị trí làm việc',
	job_title smallint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Chức vụ',
	work_place mediumint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'ID nơi làm việc',
	date_start int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Ngày hiệu lực',
	date_finish int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Ngày kết thúc hợp đồng',
	date_reg int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Ngày ký',
	signer_id mediumint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'ID người ký',
	salary_date_from int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Ngày đầu lương',
	salary_method_id smallint UNSIGNED NOT NULL DEFAULT '0',
	salary_money varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
	premium_number varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Số sổ bảo hiểm',
	premium_insurance_status smallint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Trạng thái sổ',
	premium_personnel mediumint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Pháp nhân đóng',
	premium_card varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Số thẻ BHYT',
	premium_code smallint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'ĐK khám chữa bệnh',
	premium_place mediumint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'ĐK khám chữa bệnh',
	insup_date_get int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'NV hoàn thiện HS',
	insup_date_complete int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'NS hoàn thiện HS',
	insup_date_receive int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Ngày nhận thẻ BHYT',
	insup_date_return int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Ngày trả thẻ BHYT',
	insdown_date_get int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Ngày nhận sổ BH từ NLĐ',
	insdown_date_complete int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'NS hoàn thiện HS',
	insdown_date_apply int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Ngày nhận sổ BH đã chốt',
	insdown_date_return int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Ngày trả số cho NLĐ',
	status_email tinyint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Tạo tài khoản email',
	status_profile tinyint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Sơ yếu lý lịch',
	status_document tinyint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Bằng cấp, trình độ chuyên môn',
	status_photo tinyint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Ảnh cá nhân',
	files mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Lịch sử giải quyết chế độ',
	status_identity_card varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
	resign_to_bill varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
	attachment smallint UNSIGNED NOT NULL DEFAULT '0',
	date_added int UNSIGNED NOT NULL,
	date_modified int UNSIGNED NOT NULL DEFAULT '0',
	userid_create mediumint UNSIGNED NOT NULL,
	work_status tinyint UNSIGNED NOT NULL DEFAULT '1' COMMENT '1: đang làm việc, 2: thai sản, 3: Nghỉ việc',
	PRIMARY KEY (personnel_id),
	UNIQUE KEY personnel_code (personnel_code),
	UNIQUE KEY private_code (private_code),
	UNIQUE KEY profile_code (profile_code),
	UNIQUE KEY job_tax (job_tax),
	UNIQUE KEY premium_number (premium_number),
	UNIQUE KEY premium_card (premium_card),
	UNIQUE KEY timekeeping_code (timekeeping_code) USING BTREE,
	KEY userid_create (userid_create),
	KEY group_id (department_id),
	KEY date_added (date_added),
	KEY date_modified (date_modified)	
) ENGINE=MyISAM;";
 
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_data (
	data_id mediumint UNSIGNED NOT NULL AUTO_INCREMENT,
	title varchar(235) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
	group_name varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
	weight smallint UNSIGNED NOT NULL DEFAULT '0',
	status tinyint UNSIGNED NOT NULL DEFAULT '0',
	date_added int UNSIGNED NOT NULL DEFAULT '0',
	date_modified int UNSIGNED NOT NULL DEFAULT '0',
	PRIMARY KEY (data_id),
	UNIQUE KEY title_group (title,group_name)	
) ENGINE=MyISAM;"; 


$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_premium (
	premium_id smallint(5) unsigned NOT NULL AUTO_INCREMENT,
	parent_id smallint(5) unsigned NOT NULL DEFAULT 0,
	title varchar(250) NOT NULL,
	alias varchar(250) NOT NULL DEFAULT '',
	description text NOT NULL,
	numlinks smallint(5) unsigned NOT NULL DEFAULT 0,
	weight smallint(5) unsigned NOT NULL DEFAULT 0,
	sort smallint(5) NOT NULL DEFAULT 0,
	lev smallint(5) NOT NULL DEFAULT 0,
	numsubcat smallint(5) NOT NULL DEFAULT 0,
	subcatid varchar(250) DEFAULT '',
	status tinyint(1) unsigned NOT NULL DEFAULT 0,
	date_added int(11) unsigned NOT NULL DEFAULT 0,
	date_modified int(11) unsigned NOT NULL DEFAULT 0,
	PRIMARY KEY (premium_id),
	UNIQUE KEY alias (alias),
	KEY parent_id (parent_id)
) ENGINE=MyISAM";


$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_registermedical (
	registermedical_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
	province_id mediumint(8) NOT NULL DEFAULT 0,
	title varchar(250) NOT NULL DEFAULT '',
	weight smallint(5) NOT NULL DEFAULT 0,
	status tinyint(1) NOT NULL DEFAULT 0,
	date_added int(11) unsigned NOT NULL DEFAULT 0,
	PRIMARY KEY (registermedical_id),
	UNIQUE KEY title (title)
) ENGINE=MyISAM;";
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_allowances (
	allowances_id mediumint UNSIGNED NOT NULL AUTO_INCREMENT,
	personnel_id mediumint UNSIGNED NOT NULL DEFAULT '0',
	allow_id smallint UNSIGNED NOT NULL DEFAULT '0',
	money varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
	PRIMARY KEY (allowances_id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_degrees (
  degrees_id mediumint UNSIGNED NOT NULL AUTO_INCREMENT,
  personnel_id mediumint UNSIGNED NOT NULL DEFAULT '0',
  type_id mediumint UNSIGNED NOT NULL DEFAULT '0',
  level_id mediumint UNSIGNED NOT NULL DEFAULT '0',
  date_from varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  date_to varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  specialization varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  place varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (degrees_id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_experience (
  experience_id mediumint UNSIGNED NOT NULL AUTO_INCREMENT,
  personnel_id mediumint UNSIGNED NOT NULL DEFAULT '0',
  position_id varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  date_from varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  date_to varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  company_title varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  contact_info varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  phone varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  work_desc varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (experience_id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_family (
  family_id mediumint UNSIGNED NOT NULL AUTO_INCREMENT,
  personnel_id mediumint UNSIGNED NOT NULL DEFAULT '0',
  relative_id mediumint UNSIGNED NOT NULL DEFAULT '0',
  is_dependent mediumint UNSIGNED NOT NULL DEFAULT '0',
  full_name varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  birthday varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  job varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  origin_state_address varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  phone varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (family_id)
) ENGINE=MyISAM";


$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_history_insurances (
  history_insurances_id mediumint UNSIGNED NOT NULL AUTO_INCREMENT,
  personnel_id mediumint UNSIGNED NOT NULL DEFAULT '0',
  date_from varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  type varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  reason varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  salary_premium_base varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (history_insurances_id)
) ENGINE=MyISAM";


$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_history_solves (
  history_solves_id mediumint UNSIGNED NOT NULL AUTO_INCREMENT,
  personnel_id mediumint UNSIGNED NOT NULL DEFAULT '0',
  model varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  premium_date_get int UNSIGNED NOT NULL DEFAULT '0',
  premium_date_complete int UNSIGNED NOT NULL DEFAULT '0',
  premium_date_close int UNSIGNED NOT NULL DEFAULT '0',
  premium_date_return int UNSIGNED NOT NULL DEFAULT '0',
  price varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (history_solves_id)
) ENGINE=MyISAM";
$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_timekeeper (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  parentid int(11) NOT NULL DEFAULT 0,
  userid int(11) NOT NULL DEFAULT 0,
  locationid int(11) NOT NULL DEFAULT 0,
  date_login int(11) NOT NULL DEFAULT 0,
  time_login varchar(250) NOT NULL DEFAULT '',
  type_login tinyint(4) NOT NULL DEFAULT 0,
  image_file varchar(250) NOT NULL DEFAULT '',
  image_data longblob NOT NULL,
  note text NOT NULL DEFAULT '',
  lat varchar(250) NOT NULL DEFAULT '0',
  lng varchar(250) NOT NULL DEFAULT '0',
  distance varchar(250) NOT NULL DEFAULT '',
  address varchar(250) NOT NULL DEFAULT '',
  ip varchar(250) NOT NULL DEFAULT '',
  browse varchar(250) NOT NULL DEFAULT '',
  edit_time int(11) NOT NULL DEFAULT 0,
  adminid int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
) ENGINE=MyISAM";
$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_timekeeper_schedule (
  id int(11) NOT NULL AUTO_INCREMENT,
  parentid int(11) NOT NULL DEFAULT 0,
  userid int(11) NOT NULL DEFAULT 0,
  locationid int(11) NOT NULL DEFAULT 0,
  date_start int(11) NOT NULL DEFAULT 0,
  date_end int(11) NOT NULL DEFAULT 0,
  ip varchar(250) NOT NULL DEFAULT '',
  browse varchar(250) NOT NULL DEFAULT '',
  edit_time int(11) NOT NULL DEFAULT 0,
  adminid int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
) ENGINE=MyISAM";
$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_registermedical (
  registermedical_id mediumint UNSIGNED NOT NULL AUTO_INCREMENT,
  province_id mediumint NOT NULL DEFAULT '0',
  title varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  weight smallint NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL DEFAULT '0',
  date_added int UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (registermedical_id),
  UNIQUE KEY title (title)
) ENGINE=MyISAM";
 $sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_setting (
	config_name varchar(50) NOT NULL DEFAULT '',
	config_value text NOT NULL,
	UNIQUE KEY config_name (config_name)
) ENGINE=MyISAM";
 
$sql_create_module[] = "INSERT INTO  " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_setting (config_name, config_value) VALUES
('perpage', '100'),
('employer_group', '10'),
('employer_manager', '11'),
('appapi', '')";
