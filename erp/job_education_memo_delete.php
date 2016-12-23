<?
$sub_menu = "1700101";
include_once("./_common.php");

$sql = "select * from job_education_comment where idx = '$idx' ";
$row = sql_fetch($sql);
if (!$row['idx']) {
	$msg ="코드 값이 제대로 넘어오지 않았습니다.";
} else {
	sql_query("update job_education_comment set delete_yn='1' where idx = '$idx' ");
}
goto_url("./job_education_memo.php?id=$id");
?>
