<?
$sub_menu = "100100";
include_once("./_common.php");

//check_demo();
//auth_check($auth[$sub_menu], "d");

//����� ����
$mb_id = $member['mb_id'];
$mb_name = $member['mb_name'];
$mb_profile_code = $member['mb_profile'];
$mb_profile = $man_cust_name_arry[$mb_profile_code];
//���Ŵ��� �ڵ� üũ
$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
$row_manage = sql_fetch($sql_manage);
$manage_code = $row_manage['code'];

$sql = "select * from $g4[com_list_gy] where com_code = '$id' ";
//echo $sql;
//exit;
$row = sql_fetch($sql);
if (!$row['com_code']) {
	$msg ="������ڵ� ���� ����� �Ѿ���� �ʾҽ��ϴ�.";
} else {
	sql_query("delete from $g4[com_list_gy] where com_code = '$id' ");
	sql_query("delete from com_list_gy_opt where com_code = '$id' ");
	sql_query("delete from com_list_gy_opt2 where com_code = '$id' ");
}
//exit;
goto_url("./client_list.php?page=".$page);
?>
