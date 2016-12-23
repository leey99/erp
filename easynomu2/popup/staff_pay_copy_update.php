<?
//$mode = "popup";
$member['mb_id'] = "test";
$sub_menu = "100200";
include_once("./_common.php");

//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");

//추가 필드 데이터 기준DB (사원정보 추가)
$sql_opt1 = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
$row_opt1 = sql_fetch($sql_opt1);

//추가 필드 데이터 기준DB (급여정보)
$sql_opt2 = " select * from pibohum_base_opt2 where com_code='$code' and sabun='$id' ";
$row_opt2 = sql_fetch($sql_opt2);

$sql_common2 = " pay_gbn = '$row_opt1[pay_gbn]',
						work_gbn = '$row_opt1[work_gbn]',
						workday_week = '$row_opt1[workday_week]'
						";
$sql_common3 = " annual_paid_holiday = '$row_opt2[annual_paid_holiday]',
						check_bonus_money_yn = '$row_opt2[check_bonus_money_yn]',
						bonus_money = '$row_opt2[bonus_money]',
						bonus_standard = '$row_opt2[bonus_standard]',
						bonus_percent = '$row_opt2[bonus_percent]',
						bonus_time = '$row_opt2[bonus_array]',
						bonus_p = '$row_opt2[bonus_p_array]',
						input_type = '$row_opt2[input_type]',
						workhour_day_w = '$row_opt2[workhour_day_w]',
						workhour_ext_w = '$row_opt2[workhour_ext_w]',
						workhour_hday_w = '$row_opt2[workhour_hday_w]',
						workhour_night_w = '$row_opt2[workhour_night_w]',
						check_worktime_w_yn = '$row_opt2[check_worktime_w_yn]',
						check_worktime_yn = '$row_opt2[check_worktime_yn]',
						check_money_hour_ts_yn = '$row_opt2[check_money_hour_ts_yn]',
						check_money_month_yn = '$row_opt2[check_money_month_yn]',
						check_money_min_yn = '$row_opt2[check_money_min_yn]',
						check_money_min_2013_yn = '$row_opt2[check_money_min_2013_yn]',
						check_money_b_yn = '$row_opt2[check_money_b_yn]',
						money_e_exclude = '$row_opt2[money_e_exclude]',
						workhour_day = '$row_opt2[workhour_day]',
						workhour_ext = '$row_opt2[workhour_ext]',
						workhour_hday = '$row_opt2[workhour_hday]',
						workhour_night = '$row_opt2[workhour_night]',
						money_year_yn = '$row_opt2[money_year_yn]',
						workhour_year = '$row_opt2[workhour_year]',
						money_year = '$row_opt2[money_year]',
						money_month_base = '$row_opt2[money_month_base]',
						money_hour_ms = '$row_opt2[money_hour_ms]',
						money_hour_ds = '$row_opt2[money_hour_ds]',
						money_hour_ts = '$row_opt2[money_hour_ts]',
						money_min_base = '$row_opt2[money_min_base]',
						money_g1 = '$row_opt2[money_g1]',
						money_g2 = '$row_opt2[money_g2]',
						money_g3 = '$row_opt2[money_g3]',
						money_g4 = '$row_opt2[money_g4]',
						money_g5 = '$row_opt2[money_g5]',
						money_b1 = '$row_opt2[money_b1]',
						money_b2 = '$row_opt2[money_b2]',
						money_b3 = '$row_opt2[money_b3]',
						money_b4 = '$row_opt2[money_b4]',
						money_b5 = '$row_opt2[money_b5]',
						money_e1 = '$row_opt2[money_e1]',
						money_e2 = '$row_opt2[money_e2]',
						money_e3 = '$row_opt2[money_e3]',
						money_e4 = '$row_opt2[money_e4]',
						money_e5 = '$row_opt2[money_e5]',
						money_e6 = '$row_opt2[money_e6]',
						money_e7 = '$row_opt2[money_e7]',
						money_e8 = '$row_opt2[money_e8]'
						";

$chk_data_array = explode(",", $chk_data);
$check_cnt = sizeof($chk_data_array);

for( $i=0 ; $i < $check_cnt ; $i++) {
	$code_id_array = explode("_", $chk_data_array[$i]);
	$code = $code_id_array[0];
	$id = $code_id_array[1];
	//echo $id;
	//exit;
	//추가 필드 데이터 유무 (사원정보 추가)
	$sql_opt1 = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
	//echo $sql_opt1;
	//exit;
	$result_opt1 = sql_query($sql_opt1);
	$total_opt1 = mysql_num_rows($result_opt1);
	//추가 필드 데이터 유무 (급여정보)
	$sql_opt2 = " select * from pibohum_base_opt2 where com_code='$code' and sabun='$id' ";
	$result_opt2 = sql_query($sql_opt2);
	$total_opt2 = mysql_num_rows($result_opt2);
	if($total_opt1) {
		$sql2 = " update pibohum_base_opt set $sql_common2 where com_code = '$code' and sabun='$id' ";
	} else {
		$sql2 = " insert pibohum_base_opt set $sql_common2 , com_code = '$code', sabun='$id' ";
	}
	if($total_opt2) {
		$sql3 = " update pibohum_base_opt2 set $sql_common3 , wr_date = '$now_time' where com_code = '$code' and sabun='$id' ";
	} else {
		$sql3 = " insert pibohum_base_opt2 set $sql_common3 , com_code = '$code', sabun='$id', wr_date = '$now_time' ";
	}
	//echo $sql2."<br>";
	//echo $sql3;
	//exit;
	sql_query($sql2);
	sql_query($sql3);
	//변경내역 DB 저장
	$sql6_select = " select * from pibohum_bak_opt where com_code = '$code' and sabun = '$id' order by id desc limit 0, 1 ";
	$row6_select = sql_fetch($sql6_select);
	$sql6 = " update pibohum_bak_opt set  $sql_common2 where com_code = '$code' and sabun = '$id' and id = '$row6_select[id]' ";
	$sql7 = " insert pibohum_bak_opt2 set $sql_common3 , com_code = '$code', sabun = '$id', wr_date = '$now_time' ";
	sql_query($sql6);
	sql_query($sql7);
}
//exit;
echo "<script>alert(\"정상적으로 복사 되었습니다.\"); opener.location.reload(); close();</script>";
?>