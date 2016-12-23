<?
$sub_menu = "500200";
include_once("./_common.php");

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
	$sql = "delete from pibohum_base_nomu where $sql_where ";
	sql_query($sql);
}

goto_url("./annual_paid_holiday.php?page=$page");
?>
