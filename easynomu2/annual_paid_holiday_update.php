<?
$sub_menu = "500200";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$now_time = date("Y-m-d H:i:s");

$sql_common = " annual_paid_holiday = '$annual_paid_holiday'
						";

$sql_common2 = " annual_paid_holiday = '$annual_paid_holiday',
								annual_paid_holiday_day = '$annual_paid_holiday_day',
								annual_paid_holiday_reason = '$annual_paid_holiday_reason'
						";

//사원정보 추가2 유무
$sql_opt2 = " select * from pibohum_base_opt2 where com_code='$com_code' and sabun='$id' ";
$result_opt2 = sql_query($sql_opt2);
$total_opt2 = mysql_num_rows($result_opt2);

//총연차
if($total_opt2) {
	$sql = " update pibohum_base_opt2 set 
				$sql_common
				where com_code = '$com_code' and sabun='$id' ";
} else {
	$sql = " insert pibohum_base_opt2 set 
				$sql_common
				, com_code = '$com_code', sabun='$id' ";
}
sql_query($sql);

//수정
if ($w == 'u' && $idx){
	$sql2 = " update pibohum_base_nomu set 
				$sql_common2 
				where idx = '$idx' ";
	sql_query($sql2);
	alert("정상적으로 연차가 수정 되었습니다.","annual_paid_holiday.php?page=$page");
//등록
}else{
	$sql2 = " insert pibohum_base_nomu set 
				$sql_common2 
				, com_code = '$com_code', sabun='$sabun' ";
	//$id = mysql_insert_id();
	//echo $sql2;
	//exit;
	sql_query($sql2);
	alert("정상적으로 연차가 등록 되었습니다.","annual_paid_holiday.php");
}
?>
