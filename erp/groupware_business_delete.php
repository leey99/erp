<?
$sub_menu = "700100";
include_once("./_common.php");

$chk_data_array = explode(",", $chk_data);
$check_cnt = sizeof($chk_data_array);
for( $i=0 ; $i < $check_cnt ; $i++) {
	$id = $chk_data_array[$i];
	$sql = "select * from business_log where id = '$id' ";
	//echo $sql;
	//exit;
	$row = sql_fetch($sql);
	if(!$row['id']) {
		$msg ="알람코드 값이 제대로 넘어오지 않았습니다.";
	} else {
		$del_yn = 1;
		$sql_del = " update business_log set delete_yn='$del_yn' where id = '$id' ";
		//echo $sql_del;
		//exit;
		sql_query($sql_del);
	}
}
goto_url("./groupware_business_log.php?page=".$page);
?>
