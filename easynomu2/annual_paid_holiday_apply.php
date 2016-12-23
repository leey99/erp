<?
$sub_menu = "500200";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}
$now_date = date("Y-m-d");
$now_time = date("Y-m-d H:i:s");

//사원정보 추가2
$sql_opt2 = " select * from pibohum_base a, pibohum_base_opt2 b where a.com_code='$com_code' 
							and a.com_code = b.com_code and a.sabun = b.sabun order by a.sabun asc
						";
//echo $sql_opt2;
//exit;
$result_opt2 = sql_query($sql_opt2);
//해당 사업장 사원 전체 적용
for ($i=0; $row=sql_fetch_array($result_opt2); $i++) {
	$id = $row['sabun'];
	$in_day = $row['in_day'];
	$in_day_array = explode('.', $in_day);
	$year1 = ($in_day_array[0]+1)."-".$in_day_array[1]."-".$in_day_array[2];
	$year3 = ($in_day_array[0]+3)."-".$in_day_array[1]."-".$in_day_array[2];
	$year5 = ($in_day_array[0]+5)."-".$in_day_array[1]."-".$in_day_array[2];
	$year7 = ($in_day_array[0]+7)."-".$in_day_array[1]."-".$in_day_array[2];
	$year9 = ($in_day_array[0]+9)."-".$in_day_array[1]."-".$in_day_array[2];
	$year11 = ($in_day_array[0]+11)."-".$in_day_array[1]."-".$in_day_array[2];
	$year13 = ($in_day_array[0]+13)."-".$in_day_array[1]."-".$in_day_array[2];
	$year15 = ($in_day_array[0]+15)."-".$in_day_array[1]."-".$in_day_array[2];
	$year17 = ($in_day_array[0]+17)."-".$in_day_array[1]."-".$in_day_array[2];
	$year19 = ($in_day_array[0]+19)."-".$in_day_array[1]."-".$in_day_array[2];
	$year21 = ($in_day_array[0]+21)."-".$in_day_array[1]."-".$in_day_array[2];
	//echo $year1."<br>";
	if($year1 < $now_date) {
		$annual_paid_holiday = 15;
		if($year3 <= $now_date) $annual_paid_holiday = 16;
		//echo $year5." < ".$now_date."<br>";
		if($year5 <= $now_date) $annual_paid_holiday = 17;
		if($year7 <= $now_date) $annual_paid_holiday = 18;
		if($year9 <= $now_date) $annual_paid_holiday = 19;
		if($year11 <= $now_date) $annual_paid_holiday = 20;
		if($year13 <= $now_date) $annual_paid_holiday = 21;
		if($year15 <= $now_date) $annual_paid_holiday = 22;
		if($year17 <= $now_date) $annual_paid_holiday = 23;
		if($year19 <= $now_date) $annual_paid_holiday = 24;
		if($year21 <= $now_date) $annual_paid_holiday = 25;
	} else {
		$annual_paid_holiday = 0;
	}
	$sql_common = " annual_paid_holiday = '$annual_paid_holiday' ";
	//총연차
	$sql = " update pibohum_base_opt2 set 
				$sql_common
				where com_code = '$com_code' and sabun='$id' ";
	//echo $sql."<br>";
	sql_query($sql);
	//echo $in_day;
}
//exit;
alert("정상적으로 연차 적용 되었습니다.","annual_paid_holiday.php?page=$page");
?>
