<?
$sub_menu = "200600";
include_once("./_common.php");
echo "check_ok_update";
if(!$id) exit;
echo $id;
$now_time = date("Y-m-d H:i:s");
$now_date = date("Y.m.d");

//����� ����
$mb_id = $member['mb_id'];
$mb_nick = $member['mb_nick'];
$sql_common = " reduction_process = '$check_ok', reduction_user = '$mb_nick', reduction_editdt = '$now_time' ";
$sql = " update com_reduction_app set $sql_common where com_code = '$id' ";
//echo $sql;
sql_query($sql);
alert("���������� Ȯ��üũ �Ǿ����ϴ�.", $_SERVER['PHP_SELF']);
?>
