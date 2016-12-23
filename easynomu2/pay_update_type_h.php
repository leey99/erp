<?
$sub_menu = "400100";
include_once("./_common.php");

$now_time = date("Y-m-d H:i:s");
if($mode == "input") {
	$now_date = date("Y-m-d");
	$now_time = date("H:i:s");
} else {
	$now_date = "";
	$now_time = "";
}
//echo count($emp_name);
//echo $total_count;
//$total_count = trim($total_count);
//echo $money_base[0];

//echo $money_month;
//echo $_POST[money_month];
//POST용
/*
foreach($_POST as $key => $value) { 
	$$key = $value; // register_globals option 편하게(?) 사용하기 위한 부분 
	if(!is_array($$key)) {
		//echo $key." = ".$value."<br>"; 
		//echo substr($key,0,14);
		if(substr($key,0,14) == "workhour_total") {
			$array[$key] = $value;
			//echo $array[$key];
		}
	} else { 
		for($a=0; $a < sizeof($$key); $a++) {
		echo $key."[".$a."] = ".$value[$a]."<br>"; 
		}
	} 
}
exit;
*/
//echo $total_count;

//급여유형 설정
if($pay_gbn_value == 'all') $pay_gbn_sql = "";
else if($pay_gbn_value == '0') $pay_gbn_sql = " and (pay_gbn='0' or pay_gbn='3') ";
else $pay_gbn_sql = " and (pay_gbn='1') ";
//기존 데이터 유무
$sql_opt1 = "select * from pibohum_base_pay_h
					where com_code = '$code' and year = '$search_year' and month = '$search_month' $pay_gbn_sql ";
//echo $sql_opt1;
//exit;
$result_opt1 = sql_query($sql_opt1);
$total_opt1 = mysql_num_rows($result_opt1);

//수동입력
$manual = $manual_ext.",".$manual_night.",".$manual_hday.",".$manual_4insure.",".$manual_tax.",".$c_manual_4insure;
for($i=0;$i<$total_count;$i++) {
	$sabun[$i] = $_POST['sabun_'.$i];
	$staff_name[$i] = $_POST['staff_name_'.$i];
	$in_day[$i] = $_POST['in_day_'.$i];
	$out_day[$i] = $_POST['out_day_'.$i];
	$position[$i] = $_POST['position_'.$i];
	$position_txt[$i] = $_POST['position_txt_'.$i];
	$step[$i] = $_POST['step_'.$i];
	$step_txt[$i] = $_POST['step_txt_'.$i];
	$work_form[$i] = $_POST['work_form_'.$i];
	$dept_code[$i] = $_POST['dept_code_'.$i];
	$pay_gbn_txt[$i] = $_POST['pay_gbn_txt_'.$i];
	$pay_gbn[$i] = $_POST['pay_gbn_'.$i];

	$workday_var[$i] = $_POST['workday_'.$i];

	$w_1[$i] = $_POST['w_1_'.$i];
	$w_2[$i] = $_POST['w_2_'.$i];
	$w_3[$i] = $_POST['w_3_'.$i];
	$w_1_hday[$i] = $_POST['w_1_hday_'.$i];
	$w_2_hday[$i] = $_POST['w_2_hday_'.$i];
	$w_3_hday[$i] = $_POST['w_3_hday_'.$i];
	$w_edu[$i] = $_POST['w_edu_'.$i];
	$w_phone[$i] = $_POST['w_phone_'.$i];

	$w_day[$i] = $_POST['w_day_'.$i];
	$w_ext[$i] = $_POST['w_ext_'.$i];
	$w_night[$i] = $_POST['w_night_'.$i];
	$w_hday[$i] = $_POST['w_hday_'.$i];
	$w_year[$i] = $_POST['w_year_'.$i];
	$w_ext_add[$i] = $_POST['w_ext_add_'.$i];
	$w_night_add[$i] = $_POST['w_night_add_'.$i];
	$w_hday_add[$i] = $_POST['w_hday_add_'.$i];

	$w_late[$i] = $_POST['w_late_'.$i];
	$w_leave[$i] = $_POST['w_leave_'.$i];
	$w_out[$i] = $_POST['w_out_'.$i];
	$w_absence[$i] = $_POST['w_absence_'.$i];

	$workhour_total_var[$i] = $_POST['workhour_total_'.$i];
	//echo $array['workhour_total_'.$i];
	//exit;

	$money_hour_ds_var[$i] = $_POST['money_hour_ds_'.$i];
	$money_hour_ts_var[$i] = $_POST['money_hour_ts_'.$i];
	//echo $_POST['money_hour_ds_'.$i];
	$money_time_var[$i] = $_POST['money_time_'.$i];
	//$money_day[$i] = $_POST['money_day_'.$i];
	$money_month_var[$i] = $_POST['money_month_'.$i];
	$money_setting_var[$i] = $_POST['money_setting_'.$i];
	$g1_var[$i] = $_POST['g1_'.$i];
	$g2_var[$i] = $_POST['g2_'.$i];
	$g3_var[$i] = $_POST['g3_'.$i];
	$g4_var[$i] = $_POST['g4_'.$i];
	$g5_var[$i] = $_POST['g5_'.$i];
	$ext[$i] = $_POST['ext_'.$i];
	$night[$i] = $_POST['night_'.$i];
	$hday[$i] = $_POST['hday_'.$i];

	$ext_add[$i] = $_POST['ext_add_'.$i];
	$night_add[$i] = $_POST['night_add_'.$i];
	$hday_add[$i] = $_POST['hday_add_'.$i];

	$annual_paid_holiday[$i] = $_POST['annual_paid_holiday_'.$i];
	$b1_var[$i] = $_POST['e1_'.$i];
	$b2_var[$i] = $_POST['e2_'.$i];
	$b3_var[$i] = $_POST['e3_'.$i];
	$b4_var[$i] = $_POST['e4_'.$i];
	$b5_var[$i] = $_POST['e5_'.$i];
	$b6_var[$i] = $_POST['e6_'.$i];
	$b7_var[$i] = $_POST['e7_'.$i];
	$b8_var[$i] = $_POST['e8_'.$i];
	$b9_var[$i] = $_POST['e9_'.$i];
	$tax_so_value[$i] = $_POST['tax_so_var_'.$i];
	//echo $_POST['tax_so_var_'.$i];
	//exit;
	$tax_jumin_value[$i] = $_POST['tax_jumin_var_'.$i];
	$advance_pay[$i] = $_POST['advance_pay_'.$i];
	$health[$i] = $_POST['health_'.$i];
	$yoyang[$i] = $_POST['yoyang_'.$i];
	$yun[$i] = $_POST['yun_'.$i];
	$goyong[$i] = $_POST['goyong_'.$i];

	$c_yun[$i] = $_POST['c_yun_'.$i];
	$c_health[$i] = $_POST['c_health_'.$i];
	$c_yoyang[$i] = $_POST['c_yoyang_'.$i];
	$c_goyong[$i] = $_POST['c_goyong_'.$i];
	$c_sanjae[$i] = $_POST['c_sanjae_'.$i];
	$c_money_gongje_var[$i] = $_POST['c_money_gongje_'.$i];
	$retirement_pension_var[$i] = $_POST['retirement_pension_'.$i];

	$minus_var[$i] = preg_replace('@,@', '', $_POST['minus_'.$i]);
	//$minus[$i] = $_POST['minus_'.$i];
	//echo $minus_var[$i];
	//echo $_POST['minus_'.$i];
	$minus2_var[$i] = preg_replace('@,@', '', $_POST['minus2_'.$i]);

	$etc_var[$i] = preg_replace('@,@', '', $_POST['etc_'.$i]);
	$etc2_var[$i] = preg_replace('@,@', '', $_POST['etc2_'.$i]);

	$money_total_var[$i] = $_POST['money_total_'.$i];
	$money_for_tax_var[$i] = $_POST['money_for_tax_'.$i];
	$money_gongje_var[$i] = $_POST['money_gongje_'.$i];
	$money_result_var[$i] = $_POST['money_result_'.$i];

	// 천단위 콤마 제거 DB 저장
	$money_hour_ds_var[$i] = preg_replace('@,@', '', $money_hour_ds_var[$i]);
	$money_hour_ts_var[$i] = preg_replace('@,@', '', $money_hour_ts_var[$i]);
	$money_time_var[$i] = preg_replace('@,@', '', $money_time_var[$i]);
	$money_day[$i] = preg_replace('@,@', '', $money_day[$i]);
	$money_month_var[$i] = preg_replace('@,@', '', $money_month_var[$i]);
	$money_setting_var[$i] = preg_replace('@,@', '', $money_setting_var[$i]);

	$g1_var[$i] = preg_replace('@,@', '', $g1_var[$i]);
	$g2_var[$i] = preg_replace('@,@', '', $g2_var[$i]);
	$g3_var[$i] = preg_replace('@,@', '', $g3_var[$i]);
	$g4_var[$i] = preg_replace('@,@', '', $g4_var[$i]);
	$g5_var[$i] = preg_replace('@,@', '', $g5_var[$i]);

	$b1_var[$i] = preg_replace('@,@', '', $b1_var[$i]);
	$b2_var[$i] = preg_replace('@,@', '', $b2_var[$i]);
	$b3_var[$i] = preg_replace('@,@', '', $b3_var[$i]);
	$b4_var[$i] = preg_replace('@,@', '', $b4_var[$i]);
	$b5_var[$i] = preg_replace('@,@', '', $b5_var[$i]);
	$b6_var[$i] = preg_replace('@,@', '', $b6_var[$i]);
	$b7_var[$i] = preg_replace('@,@', '', $b7_var[$i]);
	$b8_var[$i] = preg_replace('@,@', '', $b8_var[$i]);
	$b9_var[$i] = preg_replace('@,@', '', $b9_var[$i]);

	$ext[$i] = preg_replace('@,@', '', $ext[$i]);
	$night[$i] = preg_replace('@,@', '', $night[$i]);
	$hday[$i] = preg_replace('@,@', '', $hday[$i]);

	$ext_add[$i] = preg_replace('@,@', '', $ext_add[$i]);
	$night_add[$i] = preg_replace('@,@', '', $night_add[$i]);
	$hday_add[$i] = preg_replace('@,@', '', $hday_add[$i]);

	$annual_paid_holiday[$i] = preg_replace('@,@', '', $annual_paid_holiday[$i]);

	$tax_so_value[$i] = preg_replace('@,@', '', $tax_so_value[$i]);
	$tax_jumin_value[$i] = preg_replace('@,@', '', $tax_jumin_value[$i]);

	$health[$i] = preg_replace('@,@', '', $health[$i]);
	$yoyang[$i] = preg_replace('@,@', '', $yoyang[$i]);
	$yun[$i] = preg_replace('@,@', '', $yun[$i]);
	$goyong[$i] = preg_replace('@,@', '', $goyong[$i]);

	$c_yun[$i] = preg_replace('@,@', '', $c_yun[$i]);
	$c_health[$i] = preg_replace('@,@', '', $c_health[$i]);
	$c_yoyang[$i] = preg_replace('@,@', '', $c_yoyang[$i]);
	$c_goyong[$i] = preg_replace('@,@', '', $c_goyong[$i]);
	$c_sanjae[$i] = preg_replace('@,@', '', $c_sanjae[$i]);
	$c_money_gongje_var[$i] = preg_replace('@,@', '', $c_money_gongje_var[$i]);
	$retirement_pension_var[$i] = preg_replace('@,@', '', $retirement_pension_var[$i]);

	$money_total_var[$i] = preg_replace('@,@', '', $money_total_var[$i]);
	$money_for_tax_var[$i] = preg_replace('@,@', '', $money_for_tax_var[$i]);
	$money_gongje_var[$i] = preg_replace('@,@', '', $money_gongje_var[$i]);
	$money_result_var[$i] = preg_replace('@,@', '', $money_result_var[$i]);
	//통상일급
	$money_day[$i] = $money_time_var[$i] * 8;

	//숫자형 필드 데이터 0 입력
	if(!$step[$i]) $step[$i] = 0;
	if(!$ext_add[$i]) $ext_add[$i] = 0;
	if(!$night_add[$i]) $night_add[$i] = 0;
	if(!$hday_add[$i]) $hday_add[$i] = 0;
	if(!$advance_pay[$i]) $advance_pay[$i] = 0;
	if(!$end_pay[$i]) $end_pay[$i] = 0;
	if(!$minus[$i]) $minus[$i] = 0;
	if(!$minus2[$i]) $minus2[$i] = 0;
	//echo $i;

	//비고
	if($memo1 == "비고1" || !$memo1) $memo1 = "";
	if($memo2 == "비고2" || !$memo2) $memo2 = "";

	//주민등록번호
	$sql2 = " select * from pibohum_base where com_code='$code' and sabun='$sabun[$i]' ";
	$result2 = sql_query($sql2);
	$row2 = mysql_fetch_array($result2);

	//SQL 필드 입력값
	$sql_common = " 
							w_date = '$now_date',
							w_time = '$now_time',
							name = '$staff_name[$i]',
							ssnb = '$row2[jumin_no]',
							position = '$position[$i]',
							position_txt = '$position_txt[$i]',
							step = '$step[$i]',
							step_txt = '$step_txt[$i]',
							in_day = '$in_day[$i]',
							out_day = '$out_day[$i]',
							work_form = '$work_form[$i]',

							dept_code = '$dept_code[$i]',
							dept = '$dept[$i]',
							pay_gbn = '$pay_gbn[$i]',

							w_1 = '$w_1[$i]',
							w_2 = '$w_2[$i]',
							w_3 = '$w_3[$i]',
							w_1_hday = '$w_1_hday[$i]',
							w_2_hday = '$w_2_hday[$i]',
							w_3_hday = '$w_3_hday[$i]',
							w_edu = '$w_edu[$i]',
							w_phone = '$w_phone[$i]',

							workday = '$workday_var[$i]',
							w_day = '$w_day[$i]',
							w_ext = '$w_ext[$i]',
							w_night = '$w_night[$i]',
							w_hday = '$w_hday[$i]',
							w_year = '$w_year[$i]',

							w_ext_add = '$w_ext_add[$i]',
							w_night_add = '$w_night_add[$i]',
							w_hday_add = '$w_hday_add[$i]',

							w_late = '$w_late[$i]',
							w_leave = '$w_leave[$i]',
							w_out = '$w_out[$i]',
							w_absence = '$w_absence[$i]',

							workhour_total = '$workhour_total_var[$i]',

							money_hour_ds = '$money_hour_ds_var[$i]',
							money_time = '$money_hour_ts_var[$i]',
							money_min_base = '$money_time_var[$i]',
							money_day = '$money_day[$i]',
							money_month = '$money_month_var[$i]',
							money_month_fix = '$money_month_fix',
							money_setting = '$money_setting_var[$i]',

							g1 = '$g1_var[$i]',
							g2 = '$g2_var[$i]',
							g3 = '$g3_var[$i]',
							g4 = '$g4_var[$i]',
							g5 = '$g5_var[$i]',

							manual = '$manual',

							ext = '$ext[$i]',
							night = '$night[$i]',
							hday = '$hday[$i]',
							ext_add = '$ext_add[$i]',
							night_add = '$night_add[$i]',
							hday_add = '$hday_add[$i]',
							annual_paid_holiday = '$annual_paid_holiday[$i]',

							b1 = '$b1_var[$i]',
							b2 = '$b2_var[$i]',
							b3 = '$b3_var[$i]',
							b4 = '$b4_var[$i]',
							b5 = '$b5_var[$i]',
							b6 = '$b6_var[$i]',
							b7 = '$b7_var[$i]',
							b8 = '$b8_var[$i]',
							b9 = '$b9_var[$i]',
	 
							tax_so = '$tax_so_value[$i]',
							tax_jumin = '$tax_jumin_value[$i]',
							advance_pay = '$advance_pay[$i]',
							health = '$health[$i]',
							yoyang = '$yoyang[$i]',
							yun = '$yun[$i]',
							goyong = '$goyong[$i]',

							c_yun = '$c_yun[$i]',
							c_health = '$c_health[$i]',
							c_yoyang = '$c_yoyang[$i]',
							c_goyong = '$c_goyong[$i]',
							c_sanjae = '$c_sanjae[$i]',
							c_money_gongje = '$c_money_gongje_var[$i]',
							retirement_pension = '$retirement_pension_var[$i]',

							end_pay = '$end_pay[$i]',
							minus = '$minus_var[$i]',
							minus2 = '$minus2_var[$i]',
							etc = '$etc_var[$i]',
							etc2 = '$etc2_var[$i]',

							money_total = '$money_total_var[$i]',
							money_for_tax = '$money_for_tax_var[$i]',
							money_gongje = '$money_gongje_var[$i]',
							money_result = '$money_result_var[$i]',

							memo1 = '$memo1',
							memo2 = '$memo2'
	";
	//기존 데이터 유무
	$sql_opt1 = "select * from pibohum_base_pay_h 
						where com_code = '$code' and sabun = '$sabun[$i]' and year = '$search_year' and month = '$search_month' ";
	/*if($i == 54) {
		echo $sql_opt1;
		exit;
	}*/
	$result_opt1 = sql_query($sql_opt1);
	$total_opt1 = mysql_num_rows($result_opt1);
	//수정
	if($total_opt1) {
		$sql = "update pibohum_base_pay_h set 
				$sql_common 
				where com_code = '$code' and sabun = '$sabun[$i]' and year = '$search_year' and month = '$search_month' ";
	//등록
	} else {
		$sql = "insert pibohum_base_pay_h set 
				$sql_common
				, com_code = '$code', sabun = '$sabun[$i]', year = '$search_year', month = '$search_month' ";
	}
	//echo $sql."<br />";
	sql_query($sql);
}
//exit;
if($mode == "input") {
	if($pay_gbn_value == 'all') $pay_list_url = "pay_list.php";
	else if($pay_gbn_value == '0') $pay_list_url = "pay_month_list.php";
	else $pay_list_url = "pay_time_list.php";
	alert("정상적으로 급여반영이 되었습니다.","$pay_list_url?search_year=$search_year&search_month=$search_month&stx_dept=$stx_dept");
} else {
	echo "<script>window.open('pay_preview.php?code=$code&search_year=$search_year&search_month=$search_month');history.back();</script>";
}
//goto_url("./4insure_list.php");
?>