<?
$sub_menu = "300100";
include_once("./_common.php");
check_demo();
//auth_check($auth[$sub_menu], "d");
$row = sql_fetch(" select * from a4_attendance where id = '$id' ");
if (!$row[id]){ 
	$msg ="id ���� ����� �Ѿ���� �ʾҽ��ϴ�.";
} else {
	sql_query(" delete from a4_attendance where id = '$id' ");
}
goto_url("./attendance.php?toYear=$toYear&toMonth=$toMonth");
?>
