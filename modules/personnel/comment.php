<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 21 Jan 2014 01:32:02 GMT
 */

if( ! defined( 'NV_MAINFILE' ) )
{
	die( 'Stop!!!' );
}
 
$numf = $db->query( 'SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_comment WHERE module= ' . $db->quote( $row['module'] ) . ' AND id= ' . intval( $row['id'] ) . ' AND status=1' )->fetchColumn();

$query = 'UPDATE ' . NV_PREFIXLANG . '_' . $mod_info['module_data'] . '_class SET hitscm=' . $numf . ' WHERE class_id=' . $row['id'];
$db->query( $query );
 
