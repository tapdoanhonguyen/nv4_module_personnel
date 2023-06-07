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


if( ACTION_METHOD == 'download' )
{
	$file_name = $nv_Request->get_string( 'file_name', 'get', '' );
 
	$file_path = NV_ROOTDIR . '/' . NV_TEMP_DIR . '/' . $file_name;
	
	if( file_exists( $file_path ) )
	{
		header( 'Content-Description: File Transfer' );
		header( 'Content-Type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' );
		header( 'Content-Disposition: attachment; filename=' . $file_name );
		header( 'Content-Transfer-Encoding: binary' );
		header( 'Expires: 0' );
		header( 'Cache-Control: must-revalidate' );
		header( 'Pragma: public' );
		header( 'Content-Length: ' . filesize( $file_path ) );
		readfile( $file_path );
		// ob_clean();
		flush();
		nv_deletefile( $file_path );
		exit();
	}else
	{
		die('File not exists !');
	}
}

if( ACTION_METHOD == 'Export' )
{
	ini_set( 'memory_limit', '512M' );

	set_time_limit( 0 );
	$token = $nv_Request->get_title( md5( $nv_Request->session_id ), 'post', '');
	if( $token == $nv_Request->session_id . $global_config['sitekey'] )
	{
 
		$all = $nv_Request->get_int('all', 'post',0);
		$contract_type = $nv_Request->get_int('contract_type', 'get', 0);
 	
		$exportlist = $nv_Request->get_title('exportlist', 'post', '');
		if( empty( $exportlist ) )
		{
			$exportlist = array();
			$exportlist[]  = 'stt';
			foreach( $arrayContractExport as $key => $titlelang )
			{
				$exportlist[]  = $key;
			}
		}
		else{
	
			$exportlist = 'stt,' . $exportlist;
			$exportlist = explode(',', $exportlist);
		}
		$implode = array();
		if( !empty( $contract_type ) && $all == 0 )
		{
			$implode[] = 'p.contract_type=' . intval( $contract_type );
		}
 

		$sql = TABLE_PERSONNEL_NAME . '_personnel p LEFT JOIN ' . NV_USERS_GLOBALTABLE .' u ON (p.userid_create = u.userid)';

		if( $implode )
		{
			$sql .= ' WHERE ' . implode( ' AND ', $implode );
		}
		
		$sql .= ' ORDER BY p.date_reg DESC';
 
		$result = $db->query( 'SELECT p.*, u.first_name, u.last_name, u.username FROM ' .  $sql );

		if( $result->rowCount() )
		{
			$getData = getData();
			$getDepartment = getDepartment();
			$data_array = array();
			$dataContent = array();
			$stt = 0;
			while( $row = $result->fetch() )
			{
				$row['user_create'] = nv_show_name_user( $row['first_name'], $row['last_name'], $row['username'] );
				$row['stt'] = ++$stt;
				$row['department_id'] = isset( $getDepartment[$row['department_id']] ) ? $getDepartment[$row['department_id']]['title'] : '';
				$row['position_id'] = isset( $getData['position'][$row['position_id']] ) ? $getData['position'][$row['position_id']]['t'] : '';
				$row['job_title'] = isset( $getData['job_title'][$row['job_title']] ) ? $getData['job_title'][$row['job_title']]['t'] : '';
				$row['contract_type'] = isset( $getData['contract'][$row['contract_type']] ) ? $getData['contract'][$row['contract_type']]['t'] : '';
				$row['date_reg'] = ( $row['date_reg'] ) ? date('d/m/Y', $row['date_reg']) : '';
				$row['date_start'] = ( $row['date_start'] ) ? date('d/m/Y', $row['date_start']) : '';
  
				
				$dataContent[] = $row;	
				++$stt;
			}
			$result->closeCursor();
			
			  
			
			$Excel_Cell_Begin = 1; // Dong bat dau viet du lieu

	 
			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(NV_ROOTDIR . '/modules/' . $module_file . '/template/template.xlsx');
	 
			$worksheet = $spreadsheet->getActiveSheet();
			
			$worksheet->setTitle( $lang_module['export_contract'] );

			// Set page orientation and size
			$worksheet->getPageSetup()->setOrientation( PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE );
			$worksheet->getPageSetup()->setPaperSize( PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4 );
			$worksheet->getPageSetup()->setHorizontalCentered( true );
	  

			$spreadsheet->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd( 1, $Excel_Cell_Begin );
			
			// Tieu de
			$array_title = array();
			$array_key_data = array();
			foreach( $exportlist as $item )
			{
				//KEY LANG
				$array_title[] = 'export_'. $item;
				
				// DU LIEU
				$array_key_data[] = $item;
			}
			
 

			$columnIndex = 0;
			foreach( $array_title as $key_lang )
			{
				++$columnIndex;
				$TextColumnIndex = PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex( $columnIndex );
				$worksheet->getColumnDimension( $TextColumnIndex )->setAutoSize( false );
				$worksheet->setCellValue( $TextColumnIndex . $Excel_Cell_Begin, $lang_module[$key_lang] );
			}
			
		 
			  
			$pRow = $Excel_Cell_Begin;
			foreach( $dataContent as $row )
			{
				
 
				$pRow++;
				$columnIndex2 = 0;
	 
				foreach( $array_key_data as $key_data )
				{
 
					++$columnIndex2;
					$TextColumnIndex = PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex( $columnIndex2 );
					$worksheet->setCellValue( $TextColumnIndex . $pRow, $row[$key_data] );
					 
				}
			}
	 

			$highestRow = $worksheet->getHighestRow(); // Tinh so dong du lieu
			$highestColumn = $TextColumnIndex; // Tinh so cot du lieu
			
			
			// $worksheet->setCellValue( 'G' . ( $highestRow + 1 ), '=SUM(G2:G11)' );
			
			
			
			//$objWorksheet->mergeCells('A1:' . $highestColumn . '1');
			// $objWorksheet->setCellValue( 'A1', $page_title );
			//$objWorksheet->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			//$objWorksheet->getStyle('A2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

			$spreadsheet->getActiveSheet()->getStyle('A' . $Excel_Cell_Begin . ':' . $highestColumn . $highestRow)->getBorders()->applyFromArray( 
			[ 
				'bottom' => [ 'borderStyle' => PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => [ 'rgb' => '000000' ] ], 
				'top' => 	[ 'borderStyle' => PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => [ 'rgb' => '000000' ] ], 
				'left' => [ 'borderStyle' => PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => [ 'rgb' => '000000' ] ], 
				'right' => 	[ 'borderStyle' => PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => [ 'rgb' => '000000' ] ], 
			]);


	 
			
			$file_name = $module_name . '_orders_' . date('d_m_Y', NV_CURRENTTIME ) . '.xlsx';
			
			$file_path = NV_ROOTDIR . '/' . NV_TEMP_DIR . '/' . $file_name;
			
			header( 'Content-Type: application/vnd.ms-excel' );
			header( 'Content-Disposition: attachment;filename="'. $file_name .'"' );
			header( 'Cache-Control: max-age=0' );

			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
			$writer->save($file_path);
			
			$link = NV_BASE_SITEURL . "index.php?" . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '='. $op .'&action=download&file_name=' . $file_name;  
			
			nv_jsonOutput( array('link'=> $link) );		
			
			
			
			//$objWriter->save( 'php://output' );
			//exit;
		}
		else
		{
			nv_jsonOutput( array('error'=> 'Không tìm thấy dữ liệu') );		
		}
	}
	else
	{
		$json['error'] = $lang_module['export_error_security'];
	}	 
	nv_jsonOutput( $json );		
}


if( ACTION_METHOD == 'getFormExport' )
{
	$json['template'] = ThemeViewContractExport( );
	$contract_type = $nv_Request->get_int('contract_type', 'get', 0);
 	
	nv_jsonOutput( $json );
}

if( ACTION_METHOD == 'getData' )
{
 
	$json = array();
	$json['data'] = array();
	$contract_type = $nv_Request->get_int('contract_type', 'get', 0);
 	$perpage = $nv_Request->get_int('length', 'get', 10);
	$offset = $nv_Request->get_int('start', 'get', 1);
 
	$implode = array();
	if( !empty( $contract_type ) )
	{
		$implode[] = 'p.contract_type=' . intval( $contract_type );
	}
	$db_slave->sqlreset()
			->select('COUNT(*)')
			->from( TABLE_PERSONNEL_NAME . '_personnel p LEFT JOIN ' . NV_USERS_GLOBALTABLE .' u ON (p.userid_create = u.userid)' );
	 
	$db_slave->where( implode( ' AND ', $implode ) );

	$num_items = $db_slave->query( $db_slave->sql() )->fetchColumn();
	$json['recordsFiltered'] = $num_items;
	$json['recordsTotal'] = $num_items;
	
	$db_slave->select( 'p.*, u.username, u.first_name, u.last_name' )
				->order( 'p.date_added DESC' )
				->limit( $perpage )
				->offset( $offset );
				
	$result = $db_slave->query( $db_slave->sql() );
	$stt = 1;
	while( $item = $result->fetch() )
	{
		$item['user_create'] = nv_show_name_user( $item['first_name'], $item['last_name'], $item['username'] );

		$itemx[0] = ($offset + $stt);
		$itemx[1] = $item['user_create'];
		$itemx[2] = substr($item['contract_code'],6);
		$itemx[3] = $item['full_name'];
		$itemx[4] =  $item['department_id'];
		$itemx[5] =  $item['contract_type'];
		$itemx[6] = $item['date_reg'] ? date('d/m/Y', $item['date_reg']) : '';
		$itemx[7] = $item['date_start'] ? date('d/m/Y', $item['date_start']) : '';
		$json['data'][] = $itemx;
		++$stt;
	}
	 
	nv_jsonOutput( $json );
}
 
$getData = getData( ); 
 
$datatab = array();
$datatab[0] = array( 'k'=> 0, 't'=> $lang_module['all']);
foreach( $getData['contract'] as $key => $tab )
{ 
	$datatab[$key] =  $tab;
 
}
 
$dataCount = array(); 
$result = $db->query('SELECT COUNT(*) total, contract_type FROM ' . TABLE_PERSONNEL_NAME .  '_personnel GROUP BY contract_type');
$total = 0;
while( $item = $result->fetch() )
{
	$total = $total + intval($item['total']);
	$dataCount[$item['contract_type']] = intval( $item['total'] );
}
$dataCount[0] = $total;
$result->closeCursor();

$contents = ThemeViewContract( $datatab, $dataCount );

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';
