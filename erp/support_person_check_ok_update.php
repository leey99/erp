<?
$sub_menu = "1900400";
include_once("./_common.php");
echo "check_ok_update";
if(!$id) exit;
echo $id;
$now_time = date("Y-m-d H:i:s");
$now_date = date("Y.m.d");

//����� ����
$mb_id = $member['mb_id'];
$mb_nick = $member['mb_nick'];
$sql_common = " support_person_process = '$check_ok', support_person_user = '$mb_nick', support_person_editdt = '$now_time' ";
$sql = " update com_list_gy_opt2 set $sql_common where com_code = '$id' ";
//echo $sql;
sql_query($sql);
alert("���������� Ȯ��üũ �Ǿ����ϴ�.","support_person_check_ok_update.php");
?>
