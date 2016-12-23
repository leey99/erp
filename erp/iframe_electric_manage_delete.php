<?
$sub_menu = "1900300";
include_once("./_common.php");

$sql = "select * from electric_manage where idx = '$idx' ";
$row = sql_fetch($sql);
if(!$row['idx']) {
	$msg ="코드 값이 제대로 넘어오지 않았습니다.";
} else {
	sql_query("update electric_manage set delete_yn='1' where idx = '$idx' ");
}
goto_url("./iframe_electric_manage.php?id=".$id);
?>
