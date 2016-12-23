<?
$sub_menu = "500101";
include_once("./_common.php");

$sql = "select * from com_list_gy_call where idx = '$idx' ";
$row = sql_fetch($sql);
if (!$row['idx']) {
	$msg ="코드 값이 제대로 넘어오지 않았습니다.";
} else {
	sql_query("update com_list_gy_call set delete_yn='1' where idx = '$idx' ");
}
goto_url("./client_call_iframe.php?id=$id");
?>
