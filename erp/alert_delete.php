<?
$sub_menu = "100100";
include_once("./_common.php");

//check_demo();
//auth_check($auth[$sub_menu], "d");

$chk_data_array = explode(",", $chk_data);
$check_cnt = sizeof($chk_data_array);
for( $i=0 ; $i < $check_cnt ; $i++) {
	$id = $chk_data_array[$i];
	$sql = "select * from erp_alert where idx = '$id' ";
	//echo count($idx);
	//echo $sql;
	$row = sql_fetch($sql);
	if (!$row[com_code]) {
		$msg ="알람코드 값이 제대로 넘어오지 않았습니다.";
	} else {
		sql_query("delete from erp_alert where idx = '$id' ");
	}
}
goto_url("./alert_list.php?page=".$page);
?>
