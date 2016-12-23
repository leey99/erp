<?
$sub_menu = "400101";
include_once("./_common.php");

$sql = "select * from samu_4insure where idx = '$idx' ";
$row = sql_fetch($sql);
if(!$row['idx']) {
	$msg ="코드 값이 제대로 넘어오지 않았습니다.";
} else {
	sql_query(" update samu_4insure set delete_yn='1' where idx = '$idx' ");
}
goto_url("./samu_insure_list.php?page=".$page);
?>
