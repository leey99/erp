<?
$sub_menu = "300200";
include_once("./_common.php");

$chk_data_array = explode(",", $chk_data);
$check_cnt = sizeof($chk_data_array);
for( $i=0 ; $i < $check_cnt ; $i++) {
	$idx = $chk_data_array[$i];
	$sql = "select * from pibohum_base_nomu where idx = '$idx' ";
	//echo count($chk_data_array);
	//echo $sql;
	//exit;
	$row = sql_fetch($sql);
	if (!$row[com_code]) {
		$msg ="사번코드 값이 제대로 넘어오지 않았습니다.";
	} else {
		sql_query(" delete from pibohum_base_nomu where idx = '$idx' ");
	}
}
goto_url("./vacation.php?page=$page");
?>
