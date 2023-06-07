<?php

/**
 * @Project NUKEVIET 4.x
 * @Author DANGDINHTU (dlinhvan@gmail.com)
 * @Copyright (C) 2016 Nuke.vn. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Mon, 11 Jul 2016 09:00:15 GMT
 */

if( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );
 
$arrayGender = array( '0' => $lang_module['female'], '1' => $lang_module['male'], '2' => $lang_module['othergender'] );
$arrayYesNo = array( '0' => $lang_module['no'], '1' => $lang_module['yes'] );
$arrayMarital = array( '4' => $lang_module['marital4'], '5' => $lang_module['marital5'], '6' => $lang_module['marital6'] );
$arrayWorkType = array( '1' => $lang_module['work_type1'], '2' => $lang_module['work_type2'], '3' => $lang_module['work_type3'], '4' => $lang_module['work_type4'] );
$arrayUpDown = array( 'up' => $lang_module['up'], 'down' => $lang_module['down']);
$arraysalaryPremiumBase = array( 'c' => '21.5', 'p' => '10.5');
 

$dataContent = $nv_Cache->db( 'SELECT config_name, config_value FROM ' . TABLE_PERSONNEL_NAME . '_setting', 'config_name', $module_name);

$getSetting = array();

foreach( $dataContent as $row )
{
	$getSetting[$row['config_name']] = $row['config_value'];
}

unset($dataContent);

function getData( )
{
	global $nv_Cache, $db_slave, $global_config, $module_name;
	
	$cache_file = md5( $module_name ) . '.cache';
	if( ( $cache = $nv_Cache->getItem( $module_name, $cache_file ) ) != false )
	{
		$dataContent = unserialize( $cache );
	}
	else
	{
		$dataContent = array();

		$result = $db_slave->query( 'SELECT data_id, title, group_name FROM ' . TABLE_PERSONNEL_NAME . '_data ORDER BY group_name ASC, weight ASC' );

		while( $item = $result->fetch( ) )
		{
			 
			 $dataContent[$item['group_name']][$item['data_id']] = array('k'=> $item['data_id'], 't'=> $item['title']);
		}
 
		$cache = serialize($dataContent);
		$nv_Cache->setItem( $module_name, $cache_file, $cache );
	}
	
	return $dataContent;
}


function getDataJson( )
{
	global $db_slave, $module_name, $lang_module, $global_config, $arrayUpDown, $arraysalaryPremiumBase;
	
	$jon_file = NV_ROOTDIR . NV_BASE_SITEURL . NV_ASSETS_DIR . '/js/' . md5( $module_name ) . ".json";
	$dataContent = array();
	if( ! is_file( $jon_file ) )
	{
		$dataContent = array();

		$result = $db_slave->query( 'SELECT data_id, title, group_name FROM ' . TABLE_PERSONNEL_NAME . '_data ORDER BY group_name ASC, weight ASC' );

		while( $item = $result->fetch( ) )
		{	 
			 $dataContent[$item['group_name']][$item['data_id']] = array('k'=> $item['data_id'], 't'=> $item['title']);
		}
		$result->closeCursor();

		$result = $db_slave->query( 'SELECT premium_id, lev, title  FROM ' . TABLE_PERSONNEL_NAME . '_premium ORDER BY sort ASC' );

		while( $item = $result->fetch( ) )
		{	 
			 $dataContent['premium'][$item['premium_id']] = array('k'=> $item['premium_id'], 't'=> $item['title'], 'l'=> $item['lev']);
		}
		$result->closeCursor();
		
		$result = $db_slave->query( 'SELECT country_id, title FROM ' . TABLE_LOCATION_NAME . '_country WHERE status=1 ORDER BY weight ASC');

		while( $item = $result->fetch( ) )
		{	 
			 $dataContent['country'][$item['country_id']] = array('k'=> $item['country_id'], 't'=> $item['title'] );
		}
		
		$result = $db_slave->query( 'SELECT province_id, title, code FROM ' . TABLE_LOCATION_NAME . '_province WHERE status=1 ORDER BY weight ASC');

		while( $item = $result->fetch( ) )
		{	 
			 $dataContent['province'][$item['province_id']] = array('k'=> $item['province_id'], 't'=> $item['title'], 'c'=> $item['code']);
		}
		
		$dataContent['updown'] = $arrayUpDown;
		$dataContent['salaryPremiumBase'] = $arraysalaryPremiumBase;
		$dataContent['department'] = getDepartment();
		
 
		$pathfile = NV_ROOTDIR . NV_BASE_SITEURL . NV_ASSETS_DIR . '/js/' . md5( $module_name ) . '.json';
		
		$jsondata = 'var globalData=' . json_encode( $dataContent ) . ';';
		$jsondata.= 'var globalLanguage=' . json_encode( $lang_module ) . ';';
		unset( $dataContent, $item, $result );
		
		$json = file_put_contents( $pathfile, $jsondata );
	}
	return NV_BASE_SITEURL . NV_ASSETS_DIR . '/js/' . md5( $module_name ) . '.json?t=' .$global_config['timestamp'];
}
 
function getCountry()
{
	global $nv_Cache, $module_name;

	$sql = 'SELECT country_id, title, alias FROM ' . TABLE_LOCATION_NAME . '_country WHERE status=1 ORDER BY weight ASC';
	
	return $nv_Cache->db($sql, 'country_id', $module_name);
}
function getProvince()
{
	global $nv_Cache, $module_name;

	$sql = 'SELECT province_id, country_id, title, alias, type FROM ' . TABLE_LOCATION_NAME . '_province WHERE status=1 ORDER BY weight ASC';
	
	return $nv_Cache->db($sql, 'province_id', $module_name);
}

function getDistrict()
{
	global $nv_Cache, $module_name;

	$sql = 'SELECT district_id, province_id, title, alias, type FROM ' . TABLE_LOCATION_NAME . '_district WHERE status=1 ORDER BY weight ASC';
	
	return $nv_Cache->db($sql, 'district_id', $module_name);
}
 
function getDepartment()
{
	global $nv_Cache, $module_name, $global_config;

	$sql = 'SELECT ug.group_id, ugd.title, ug.group_type, ug.exp_time FROM ' . NV_USERS_GLOBALTABLE . '_groups ug LEFT JOIN ' . NV_USERS_GLOBALTABLE . '_groups_detail ugd ON ug.group_id = ugd.group_id  WHERE ug.act=1 AND ug.group_id>7 AND (ug.idsite = ' . $global_config['idsite'] . ' OR (ug.idsite =0 AND ug.siteus = 1)) ORDER BY ug.idsite, ug.weight';
	
	return $nv_Cache->db($sql, 'group_id', 'users');
}

function getRandomString( $length = 32 ) 
{
    return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyz'), 0, $length);
}

function getRandomNumber( $length = 32 ) 
{
    return substr(str_shuffle('012345678901234567890123456789'), 0, $length);
}

 
function convertToTimeStamp( $time, $default=0, $phour=0, $pmin=0, $second=0 )
{
	if( preg_match( '/^([0-9]{1,2})[\/|-]([0-9]{1,2})[\/|-]([0-9]{4})$/', $time, $m ) )
	{
		
		$time = mktime( $phour, $pmin, $second, $m[2], $m[1], $m[3] );
	}
	else
	{
		if( $default )
		{
			$time = NV_CURRENTTIME;
		}
		else
		{
			$time = 0;
		}
	}
 
	return $time;
	
}


function is_decimal( $val )
{
	return is_numeric( $val ) && floor( $val ) != $val;
}
 
function price_format( $price, $round = 0 )
{
	if( ! is_numeric( $price ) ) return $price;
	if(  $round ) //is_decimal( $price ) &&
	{
		// $_round = strlen( substr( strrchr( $price, "." ), 1 ) );
		// if( $_round > 2 ) 
			
		$_round = 2;

		return ( is_numeric( $price ) && $price > 0 ) ? number_format( $price, $_round, ".", "," ) : 0;
	}
	else
	{
		return ( is_numeric( $price ) && $price > 0 ) ? number_format( $price, 0, ".", "," ) : 0;
	}
}

function price_round( $price )
{
	if( ! is_numeric( $price ) ) return $price;
	return ( is_numeric( $price ) && $price > 0 ) ? round( $price, 0, PHP_ROUND_HALF_UP ) : 0;
}

 /*
function getTypes()
{
	global $nv_Cache, $module_name;

	$sql = 'SELECT type_id, title FROM ' . TABLE_PERSONNEL_NAME . '_type WHERE status=1 ORDER BY weight ASC';
	
	return $nv_Cache->db($sql, 'type_id', $module_name);
}

function priceFormat( $price, $round = 0 )
{
	if( ! is_numeric( $price ) ) return $price;
	if(  $round ) //is_decimal( $price ) &&
	{
		// $_round = strlen( substr( strrchr( $price, "." ), 1 ) );
		// if( $_round > 2 ) 
			
		$_round = 2;

		return ( is_numeric( $price ) && $price > 0 ) ? number_format( $price, $_round, ".", "," ) : 0;
	}
	else
	{
		return ( is_numeric( $price ) && $price > 0 ) ? number_format( $price, 0, ".", "," ) : 0;
	}
} 


/// GOI CAC HAM SU DUNG THUONG XUYEN //
global $getCategory;
$getCategory = getCategory ();
 */