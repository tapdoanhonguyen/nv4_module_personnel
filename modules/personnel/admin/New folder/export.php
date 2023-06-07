<?php

/**
 * @Project NUKEVIET 3.4
 * @Author ĐẶNG ĐÌNH TỨ (dlinhvan@gmail.com)
 * @Copyright (C) 2010 webdep24.com All rights reserved
 * @Createdate 10/08/2012 08:00
 */

if( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

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
	}
	else
	{
		die( 'File not exists !' );
	}
}
if( ACTION_METHOD == 'is_download' )
{
	ini_set( 'memory_limit', '512M' );

	set_time_limit( 0 );
	
	
	$per_page = 100;
	
	$sql = 'SELECT i.item_id, i.class_id, i.full_name, i.email, i.phone, i.date_added, c.class_name, c.opening_day FROM ' . TABLE_PERSONNEL_NAME . '_item i LEFT JOIN ' . TABLE_PERSONNEL_NAME . '_class c ON (i.class_id = c.class_id)';
	
	$implode = array();
	if( $nv_Request->get_int( 'all', 'post', 0 ) == 0 )
	{
		$data['q'] = $nv_Request->get_string( 'q', 'post' );
		$data['class_id'] = $nv_Request->get_int( 'class_id', 'post', 0 );

		$data['date_from'] = $nv_Request->get_title( 'date_from', 'post', '' );
		$data['date_to'] = $nv_Request->get_title( 'date_to', 'post', '' );

		if( preg_match( '/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $data['date_from'], $m ) )
		{

			$date_from = mktime( 0, 0, 0, $m[2], $m[1], $m[3] );
		}
		else
		{
			$date_from = 0;
		}
		if( preg_match( '/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $data['date_to'], $m ) )
		{

			$date_to = mktime( 23, 59, 59, $m[2], $m[1], $m[3] );
		}
		else
		{
			$date_to = 0;
		}

		

		if( $data['q'] )
		{
			$implode[] = '( i.full_name LIKE \'%' . $db_slave->dblikeescape( $data['q'] ) . '%\' OR i.phone LIKE \'%' . $db_slave->dblikeescape( $data['q'] ) . '%\' OR i.email LIKE \'%' . $db_slave->dblikeescape( $data['q'] ) . '%\')';
		}
		if( $data['class_id'] > 0 )
		{
			$implode[] = 'class_id = ' . intval( $data['class_id'] );
		}
		if( preg_match( '/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $data['date_from'], $m ) )
		{

			$date_from = mktime( 0, 0, 0, $m[2], $m[1], $m[3] );
		}
		else
		{
			$date_from = 0;
		}
		if( preg_match( '/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $data['date_to'], $m ) )
		{

			$date_to = mktime( 23, 59, 59, $m[2], $m[1], $m[3] );
		}
		else
		{
			$date_to = 0;
		} 
		
		if( $date_from && $date_to )
		{
			$implode[] = 'date_added BETWEEN ' . intval( $date_from ) . ' AND ' . intval( $date_to );
		}
 
	}

	if( $implode )
	{
		$sql .= ' WHERE ' . implode( ' AND ', $implode );
	}
	
	$sql .=' ORDER BY date_added DESC LIMIT 0,' . $per_page; 
 
	$result = $db->query( $sql );

	if( $result->rowCount() )
	{
		$data_array = array();
		$dataContent = array();
		$i = 0;
		while( $row = $result->fetch() )
		{
			$data_array['stt'] = ++$i;
			$data_array['class_name'] = nv_unhtmlspecialchars( $row['class_name'] );
			$data_array['full_name'] = nv_unhtmlspecialchars( $row['full_name'] );
			$data_array['phone'] = nv_unhtmlspecialchars( $row['phone'] );
			$data_array['email'] = ' ' . nv_unhtmlspecialchars( $row['email'] );
			$data_array['opening_day'] = nv_unhtmlspecialchars( date( 'd/m/Y H:i', $row['opening_day'] ) );
			$data_array['date_added'] = nv_unhtmlspecialchars( date( 'd/m/Y', $row['date_added'] ) );

			$dataContent[] = $data_array;
		}

		/** Include PHPExcel */
		require_once ( NV_ROOTDIR . "/includes/PHPExcel.php" );

		$Excel_Cell_Begin = 1; // Dong bat dau viet du lieu

		$objReader = PHPExcel_IOFactory::createReader( 'Excel2007' );
		$objPHPExcel = $objReader->load( NV_ROOTDIR . "/modules/" . $module_file . "/template_excel/template.xlsx" );

		$objWorksheet = $objPHPExcel->getActiveSheet();

		$page_title = 'DANH SÁCH HỌC VIÊN';
		$objWorksheet->setTitle( 'danh_sach_hoc_vien' );

		// Set page orientation and size
		$objWorksheet->getPageSetup()->setOrientation( PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE );
		$objWorksheet->getPageSetup()->setPaperSize( PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4 );
		$objWorksheet->getPageSetup()->setHorizontalCentered( true );

		$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd( 1, $Excel_Cell_Begin );

		// Tieu de
		$array_title = array();
		$array_title[] = 'stt';
		$array_title[] = 'full_name';
		$array_title[] = 'phone';
		$array_title[] = 'email';
		$array_title[] = 'class_name';
		$array_title[] = 'opening_day';
		$array_title[] = 'date_added';
		
		$columnIndex = 0;
		foreach( $array_title as $key_lang )
		{
			$TextColumnIndex = PHPExcel_Cell::stringFromColumnIndex( $columnIndex );
			$objWorksheet->getColumnDimension( $TextColumnIndex )->setAutoSize( true );
			$objWorksheet->setCellValue( $TextColumnIndex . $Excel_Cell_Begin, $lang_module[$key_lang] );
			$columnIndex++;
		}

		// Du lieu
		$array_key_data = array();
		$array_key_data[] = 'stt';
		$array_key_data[] = 'full_name';
		$array_key_data[] = 'phone';
		$array_key_data[] = 'email';
		$array_key_data[] = 'class_name';
		$array_key_data[] = 'opening_day';
		$array_key_data[] = 'date_added';
		
		$pRow = $Excel_Cell_Begin;
		foreach( $dataContent as $row )
		{
			$pRow++;
			$columnIndex = 0;

			foreach( $array_key_data as $key_data )
			{

				$TextColumnIndex = PHPExcel_Cell::stringFromColumnIndex( $columnIndex );
				$objWorksheet->setCellValue( $TextColumnIndex . $pRow, $row[$key_data] );
				$columnIndex++;
			}
		}

		$highestRow = $objWorksheet->getHighestRow(); // Tinh so dong du lieu
		$highestColumn = $objWorksheet->getHighestColumn(); // Tinh so cot du lieu

		//$objWorksheet->mergeCells('A1:' . $highestColumn . '1');
		// $objWorksheet->setCellValue( 'A1', $page_title );
		//$objWorksheet->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		//$objWorksheet->getStyle('A2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		//$styleArray = array('borders' => array('outline' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => 'FF000000'))));

		//$objWorksheet->getStyle('A' . $Excel_Cell_Begin . ':' . $highestColumn . $highestRow)->applyFromArray($styleArray); // Tao duong bao

		//Redirect output to a client's web browser (Excel5)

		$file_name = 'danh_sach_hoc_vien_'. date('dmYHi', NV_CURRENTTIME) .' .xlsx';

		$file_path = NV_ROOTDIR . '/' . NV_TEMP_DIR . '/' . $file_name;

		header( 'Content-Type: application/vnd.ms-excel' );
		header( 'Content-Disposition: attachment;filename="' . $file_name . '"' );
		header( 'Cache-Control: max-age=0' );

		$objWriter = PHPExcel_IOFactory::createWriter( $objPHPExcel, 'Excel2007' );

		$objWriter->save( $file_path );

		$link = NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=export&action=download&file_name=' . $file_name;

		nv_jsonOutput( array( 'link' => $link ) );

		//$objWriter->save( 'php://output' );
		//exit;

	}
	else
	{
		nv_jsonOutput( array( 'error' => 'Không tìm thấy dữ liệu' ) );
	}

}
