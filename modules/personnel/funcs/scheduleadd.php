<?php

/**
 * NukeViet Content Management System
 * @version 4.x
 * @author VINADES.,JSC <contact@vinades.vn>
 * @copyright (C) 2009-2023 VINADES.,JSC. All rights reserved
 * @license GNU/GPL version 2 or any later version
 * @see https://github.com/nukeviet The NukeViet CMS GitHub project
 */

if (!defined('NV_IS_MOD_PERSONNEL'))
    die('Stop!!!');

if ($nv_Request->isset_request('delete_id', 'get') and $nv_Request->isset_request('delete_checkss', 'get')) {
    $id = $nv_Request->get_int('delete_id', 'get');
    $delete_checkss = $nv_Request->get_string('delete_checkss', 'get');
    if ($id > 0 and $delete_checkss == md5($id . NV_CACHE_PREFIX . $client_info['session_id'])) {
        $db->query('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_timekeeper_schedule  WHERE id = ' . $db->quote($id));
        $nv_Cache->delMod($module_name);
        nv_insert_logs(NV_LANG_DATA, $module_name, 'Delete Scheduleadd', 'ID: ' . $id, $admin_info['userid']);
        nv_redirect_location(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
    }
}

$row = array();
$error = array();
$row['id'] = $nv_Request->get_int('id', 'post,get', 0);
if ($nv_Request->isset_request('submit', 'post')) {
    $row['locationid'] = $nv_Request->get_int('locationid', 'post', 0);
    if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $nv_Request->get_string('date_login', 'post'), $m))     {
        $_hour = 0;
        $_min = 0;
        $row['date_login'] = mktime($_hour, $_min, 0, $m[2], $m[1], $m[3]);
    }
    else
    {
        $row['date_login'] = 0;
    }
    $row['time_login'] = $nv_Request->get_title('time_login', 'post', '');

    if (empty($error)) {
        try {
            if (empty($row['id'])) {
                $row['parentid'] = 0;
                $row['userid'] = 0;
                $row['ip'] = '''';
                $row['browse'] = '''';
                $row['edit_time'] = 0;
                $row['adminid'] = 0;

                $stmt = $db->prepare('INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_timekeeper_schedule (parentid, userid, locationid, date_login, time_login, ip, browse, edit_time, adminid) VALUES (:parentid, :userid, :locationid, :date_login, :time_login, :ip, :browse, :edit_time, :adminid)');

                $stmt->bindParam(':parentid', $row['parentid'], PDO::PARAM_INT);
                $stmt->bindParam(':userid', $row['userid'], PDO::PARAM_INT);
                $stmt->bindParam(':ip', $row['ip'], PDO::PARAM_STR);
                $stmt->bindParam(':browse', $row['browse'], PDO::PARAM_STR);
                $stmt->bindParam(':edit_time', $row['edit_time'], PDO::PARAM_INT);
                $stmt->bindParam(':adminid', $row['adminid'], PDO::PARAM_INT);

            } else {
                $stmt = $db->prepare('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_timekeeper_schedule SET locationid = :locationid, date_login = :date_login, time_login = :time_login WHERE id=' . $row['id']);
            }
            $stmt->bindParam(':locationid', $row['locationid'], PDO::PARAM_INT);
            $stmt->bindParam(':date_login', $row['date_login'], PDO::PARAM_INT);
            $stmt->bindParam(':time_login', $row['time_login'], PDO::PARAM_STR);

            $exc = $stmt->execute();
            if ($exc) {
                $nv_Cache->delMod($module_name);
                if (empty($row['id'])) {
                    nv_insert_logs(NV_LANG_DATA, $module_name, 'Add Scheduleadd', ' ', $admin_info['userid']);
                } else {
                    nv_insert_logs(NV_LANG_DATA, $module_name, 'Edit Scheduleadd', 'ID: ' . $row['id'], $admin_info['userid']);
                }
                nv_redirect_location(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
            }
        } catch(PDOException $e) {
            trigger_error($e->getMessage());
            die($e->getMessage()); //Remove this line after checks finished
        }
    }
} elseif ($row['id'] > 0) {
    $row = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_timekeeper_schedule WHERE id=' . $row['id'])->fetch();
    if (empty($row)) {
        nv_redirect_location(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
    }
} else {
    $row['id'] = 0;
    $row['locationid'] = 0;
    $row['date_login'] = 0;
    $row['time_login'] = '''';
}

if (empty($row['date_login'])) {
    $row['date_login'] = '';
}
else
{
    $row['date_login'] = date('d/m/Y', $row['date_login']);
}
$array_parentid_personnel = array();
$_sql = 'SELECT data_id,title FROM nv4_vi_personnel_data';
$_query = $db->query($_sql);
while ($_row = $_query->fetch()) {
    $array_parentid_personnel[$_row['data_id']] = $_row;
}

$array_userid_users = array();
$_sql = 'SELECT userid,username FROM nv4_users';
$_query = $db->query($_sql);
while ($_row = $_query->fetch()) {
    $array_userid_users[$_row['userid']] = $_row;
}

$array_locationid_personnel = array();
$_sql = 'SELECT data_id,title FROM nv4_vi_personnel_data';
$_query = $db->query($_sql);
while ($_row = $_query->fetch()) {
    $array_locationid_personnel[$_row['data_id']] = $_row;
}


$q = $nv_Request->get_title('q', 'post,get');

// Fetch Limit
$show_view = false;
if (!$nv_Request->isset_request('id', 'post,get')) {
    $show_view = true;
    $per_page = 20;
    $page = $nv_Request->get_int('page', 'post,get', 1);
    $db->sqlreset()
        ->select('COUNT(*)')
        ->from('' . NV_PREFIXLANG . '_' . $module_data . '_timekeeper_schedule');

    if (!empty($q)) {
        $db->where('locationid LIKE :q_locationid OR date_login LIKE :q_date_login OR time_login LIKE :q_time_login');
    }
    $sth = $db->prepare($db->sql());

    if (!empty($q)) {
        $sth->bindValue(':q_locationid', '%' . $q . '%');
        $sth->bindValue(':q_date_login', '%' . $q . '%');
        $sth->bindValue(':q_time_login', '%' . $q . '%');
    }
    $sth->execute();
    $num_items = $sth->fetchColumn();

    $db->select('*')
        ->order('id DESC')
        ->limit($per_page)
        ->offset(($page - 1) * $per_page);
    $sth = $db->prepare($db->sql());

    if (!empty($q)) {
        $sth->bindValue(':q_locationid', '%' . $q . '%');
        $sth->bindValue(':q_date_login', '%' . $q . '%');
        $sth->bindValue(':q_time_login', '%' . $q . '%');
    }
    $sth->execute();
}

$xtpl = new XTemplate('scheduleadd.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
$xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
$xtpl->assign('NV_BASE_SITEURL', NV_BASE_SITEURL);
$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('MODULE_UPLOAD', $module_upload);
$xtpl->assign('NV_ASSETS_DIR', NV_ASSETS_DIR);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);

foreach ($array_parentid_personnel as $value) {
    $xtpl->assign('OPTION', array(
        'key' => $value['data_id'],
        'title' => $value['title'],
        'selected' => ($value['data_id'] == $row['parentid']) ? ' selected="selected"' : ''
    ));
    $xtpl->parse('main.select_parentid');
}
$xtpl->assign('Q', $q);

if ($show_view) {
    $base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
    if (!empty($q)) {
        $base_url .= '&q=' . $q;
    }
    $generate_page = nv_generate_page($base_url, $num_items, $per_page, $page);
    if (!empty($generate_page)) {
        $xtpl->assign('NV_GENERATE_PAGE', $generate_page);
        $xtpl->parse('main.view.generate_page');
    }
    $number = $page > 1 ? ($per_page * ($page - 1)) + 1 : 1;
    while ($view = $sth->fetch()) {
        $view['number'] = $number++;
        $view['date_login'] = (empty($view['date_login'])) ? '' : nv_date('d/m/Y', $view['date_login']);
        $view['parentid'] = $array_parentid_personnel[$view['parentid']]['title'];
        $view['userid'] = $array_userid_users[$view['userid']]['username'];
        $view['locationid'] = $array_locationid_personnel[$view['locationid']]['title'];
        $view['link_edit'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;id=' . $view['id'];
        $view['link_delete'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;delete_id=' . $view['id'] . '&amp;delete_checkss=' . md5($view['id'] . NV_CACHE_PREFIX . $client_info['session_id']);
        $xtpl->assign('VIEW', $view);
        $xtpl->parse('main.view.loop');
    }
    $xtpl->parse('main.view');
}


if (!empty($error)) {
    $xtpl->assign('ERROR', implode('<br />', $error));
    $xtpl->parse('main.error');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $lang_module['scheduleadd'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
