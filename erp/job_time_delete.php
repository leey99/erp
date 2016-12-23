<?
$sub_menu = "1900100";
include_once("./_common.php");

$chk_data_array = explode(",", $chk_data);
$check_cnt = sizeof($chk_data_array);
for( $i=0 ; $i < $check_cnt ; $i++) {
	$id = $chk_data_array[$i];
	$sql = "select * from job_time where id = '$id' ";
	//echo count($idx);
	//echo $sql;
	$row = sql_fetch($sql);
	if (!$row[id]) {
		$msg ="사업장코드 값이 제대로 넘어오지 않았습니다.";
	} else {
		sql_query("update job_time set delete_yn='1' where id = '$id' ");
	}
}
goto_url("./job_time_list.php?page=$page");
?>
