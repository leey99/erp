<?
$sub_menu = "1900500";
include_once("./_common.php");
echo "family_insurance_check_ok_update.php";
if(!$id) exit;
echo $id;
$now_time = date("Y-m-d H:i:s");
$now_date = date("Y.m.d");

//����� ����
$mb_id = $member['mb_id'];
$mb_nick = $member['mb_nick'];
$sql_common = " family_process = '$check_ok' ";

$sql = " update com_list_gy_opt set $sql_common where com_code = '$id' ";
//echo $sql;
sql_query($sql);
alert("���������� Ȯ��üũ �Ǿ����ϴ�.","family_insurance_check_ok_update.php");
?>
