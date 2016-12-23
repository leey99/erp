<?
$sub_menu = "500100";
include_once("./_common.php");
//echo $chk_data;
$chk_data_array = explode(",", $chk_data);
//$chk_data_code_array = explode(",", $chk_data_code);
$check_cnt = sizeof($chk_data_array);
for( $i=0 ; $i < $check_cnt ; $i++) {
	if($chk_data_array[$i]) $idx = $chk_data_array[$i];
	//$com_code = $chk_data_code_array[$i];
	$sql_where = " idx = '$idx' ";
	$sql = "select * from pibohum_base_nomu where $sql_where ";
	//echo count($idx);
	//echo $sql;
	//exit;
	$row = sql_fetch($sql);
	if (!$row[com_code]) {
		$msg ="사번코드 값이 제대로 넘어오지 않았습니다.";
	} else {
		sql_query(" update $g4[pibohum_base] set out_day = '' where com_code = '$row[com_code]' and sabun = '$row[sabun]' ");
		$sql = "delete from pibohum_base_nomu where $sql_where ";
		sql_query($sql);
	}
}
goto_url("./retirement.php?page=$page");
?>
