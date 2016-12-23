<?
$sub_menu = "400101";
include_once("./_common.php");

$sql = "select * from employment_agency where idx = '$idx' ";
$row = sql_fetch($sql);
if(!$row['idx']) {
	$msg ="코드 값이 제대로 넘어오지 않았습니다.";
} else {
	sql_query("update employment_agency set delete_yn='1' where idx = '$idx' ");
}
goto_url("./popup_emp_agency.php?id=$id");
?>
