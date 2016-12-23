<?
$sub_menu = "500300";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}
$now_time = date("Y-m-d H:i:s");

//수정
$sql_delete = " delete from pibohum_base_bonus where com_code = '$com_code' and sabun='$id' and bonus_year='$bonus_year' ";
sql_query($sql_delete);
for($i=0;$i<$count;$i++) {
	$k = $i + 1;
	$bonus_year = $_POST['bonus_year'];
	$bonus_day = $_POST['bonus_day_'.$k];
	$bonus_percent = $_POST['bonus_p_'.$k];
	$bonus_time = $k;
	$pay = $_POST['pay_'.$k];
	$tax_so = $_POST['tax_so_'.$k];
	$tax_ju = $_POST['tax_ju_'.$k];
	$minus = $_POST['minus_'.$k];
	$minus_negative = $_POST['minus_negative_'.$k];
	$bonus_total = $_POST['bonus_total_'.$k];
	$memo = $_POST['memo_'.$k];
	$sql_common = " bonus_year = '$bonus_year', bonus_day = '$bonus_day', bonus_percent = '$bonus_percent', bonus_time = '$bonus_time', pay = '$pay', tax_so = '$tax_so', tax_ju = '$tax_ju', minus = '$minus', minus_negative = '$minus_negative', bonus_total = '$bonus_total', memo = '$memo' ";
	$sql_insert = " insert pibohum_base_bonus set $sql_common , com_code = '$com_code', sabun='$id' ";
	//echo $sql_insert;
	sql_query($sql_insert);
}
alert("정상적으로 상여금이 등록 되었습니다.","bonus.php?page=$page&stx_bonus_year=$bonus_year");
?>
