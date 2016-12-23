<?
$sub_menu = "1700100";
include_once("./_common.php");

$chk_data_array = explode(",", $chk_data);
$check_cnt = sizeof($chk_data_array);
for( $i=0 ; $i < $check_cnt ; $i++) {
	$id = $chk_data_array[$i];
	$sql = "select * from job_education where idx = '$id' ";
	$row = sql_fetch($sql);
	if (!$row[idx]) {
		$msg ="사업장코드 값이 제대로 넘어오지 않았습니다.";
	} else {
		sql_query("update job_education set delete_yn='1' where idx = '$id' ");
	}
}
goto_url("./job_education_list.php?page=$page");
?>
