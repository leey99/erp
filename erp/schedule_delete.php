<?
$sub_menu = "2000100";
include_once("./_common.php");

$sql = "select * from erp_visit where id = '$id' ";
//echo count($idx);
//echo $sql;
$row = sql_fetch($sql);
if (!$row[id]) {
	$msg ="사업장코드 값이 제대로 넘어오지 않았습니다.";
	alert($msg);
} else {
	sql_query("update erp_visit set delete_yn='1' where id = '$id' ");
}
goto_url("./list_notice.php?bo_table=erp_visit");
?>
