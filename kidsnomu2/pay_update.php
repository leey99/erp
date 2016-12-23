<?
$sub_menu = "100300";
include_once("./_common.php");

$now_time = date("Y-m-d H:i:s");
$now_date = date("Y-m-d");
//echo count($emp_name);
//echo $total_count;
//$total_count = trim($total_count);
//echo $money_base[0];

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
		//echo $key."[".$a."] = ".$value[$a]."<br>"; 
		}
	} 
}
//exit;
*/
//수동입력
$manual = $manual_ext.",".$manual_night.",".$manual_hday.",".$manual_4insure.",".$manual_tax.",".$manual_etc2;
for($i=0;$i<$total_count;$i++) {
	$pay_gbn[$i] = $_POST['pay_gbn_'.$i];

	$w_day[$i] = $_POST['w_day_'.$i];
	$w_ext[$i] = $_POST['w_ext_'.$i];
	$w_night[$i] = $_POST['w_night_'.$i];
	$w_hday[$i] = $_POST['w_hday_'.$i];

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
	//$money_day[$i] = $money_time[$i] * 8;
	$money_month_var[$i] = $_POST['money_month_'.$i];
	//echo $_POST['money_month_'.$i]."<br />";
	$g1_var[$i] = $_POST['g1_'.$i];
	$g2_var[$i] = $_POST['g2_'.$i];
	$g3_var[$i] = $_POST['g3_'.$i];
	$g4_var[$i] = $_POST['g4_'.$i];
	$g5_var[$i] = $_POST['g5_'.$i];
	$g6_var[$i] = $_POST['g6_'.$i];
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
	$tax_so_value[$i] = $_POST['tax_so_var_'.$i];
	//echo $_POST['tax_so_var_'.$i];
	//exit;
	$tax_jumin_value[$i] = $_POST['tax_jumin_var_'.$i];
	$advance_pay[$i] = $_POST['advance_pay_'.$i];
	$health[$i] = $_POST['health_'.$i];
	$yoyang[$i] = $_POST['yoyang_'.$i];
	$yun[$i] = $_POST['yun_'.$i];
	$goyong[$i] = $_POST['goyong_'.$i];

	$minus_var[$i] = preg_replace('@,@', '', $_POST['minus_'.$i]);
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

	$g1_var[$i] = preg_replace('@,@', '', $g1_var[$i]);
	$g2_var[$i] = preg_replace('@,@', '', $g2_var[$i]);
	$g3_var[$i] = preg_replace('@,@', '', $g3_var[$i]);
	$g4_var[$i] = preg_replace('@,@', '', $g4_var[$i]);
	$g5_var[$i] = preg_replace('@,@', '', $g5_var[$i]);
	$g6_var[$i] = preg_replace('@,@', '', $g6_var[$i]);

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
	if(!$minus_var[$i]) $minus_var[$i] = 0;
	//echo $i;
	$sql_common = " 
							w_date = '$now_date',
							name = '$staff_name[$i]',
							position = '$position[$i]',
							step = '$step[$i]',
							position_txt = '$position_txt[$i]',
							step_txt = '$step_txt[$i]',
							in_day = '$in_day[$i]',
							out_day = '$out_day[$i]',
							work_form = '$work_form[$i]',
							dept = '$dept[$i]',
							pay_gbn = '$pay_gbn[$i]',

							w_day = '$w_day[$i]',
							w_ext = '$w_ext[$i]',
							w_night = '$w_night[$i]',
							w_hday = '$w_hday[$i]',

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
							money_month_fix = '$money_month_fix',
							money_month = '$money_month_var[$i]',

							g1 = '$g1_var[$i]',
							g2 = '$g2_var[$i]',
							g3 = '$g3_var[$i]',
							g4 = '$g4_var[$i]',
							g5 = '$g5_var[$i]',
							g6 = '$g6_var[$i]',

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
	 
							tax_so = '$tax_so_value[$i]',
							tax_jumin = '$tax_jumin_value[$i]',
							advance_pay = '$advance_pay[$i]',
							health = '$health[$i]',
							yoyang = '$yoyang[$i]',
							yun = '$yun[$i]',
							goyong = '$goyong[$i]',
							end_pay = '$end_pay[$i]',
							minus = '$minus_var[$i]',
							minus2 = '$minus2_var[$i]',
							etc = '$etc_var[$i]',
							etc2 = '$etc2_var[$i]',

							money_total = '$money_total_var[$i]',
							money_for_tax = '$money_for_tax_var[$i]',
							money_gongje = '$money_gongje_var[$i]',
							money_result = '$money_result_var[$i]'
							";
	/*
	com_code varchar(5)
	sabun carchar(4)
	name var(10) 성명
	year var(4) 년도
	month var(2) 월
	position int(5) 직위
	step int(5) 호봉
	in_day var(10) 입사일
	out_day var(10) 퇴사일
	work_form var(10) 채용형태
	dept var(20) 부서
	pay_gbn char(1) 유형
	월소정근로시간
	w_day int(5) 기본근로
	w_ext int(4) 기본연장
	w_ext_add int(4) 추가연장
	w_night int(4) 야간근로
	w_hday int(4) 휴일근로
	기본급
	money_hour_ds double 기준시급
	money_time int(12) 기본시급
	money_day int(12) 기본일급
	money_month int(12) 기본월급
	통상임금(과세)
	g1 int(12) 직책
	g2 int(12) 직무
	g3 int(12) 호봉
	g4 int(12) 통상1
	g5 int(12) 통상2
	g6 int(12) 통상3
	법정수당(과세)
	ext int(12) 
	ext_add int(12) 
	night int(12) 
	hday int(12) 
	annual_paid_holiday int(12) 
	기타수당(비과세)
	b1 int(12) 차량유지
	b2 int(12) 식대
	b3 int(12) 보육
	b4 int(12) 연구보조
	b5 int(12) 교육
	b6 int(12) 기타1
	b7 int(12) 기타2
	b8 int(12) 기타2
	공제내역
	tax_so int(12) 소득세
	tax_jumin int(12) 주민세
	advance_pay int(12) 가불
	health int(12) 건강보험
	yoyang int(12) 건강보험
	yun int(12) 연금보험
	goyong int(12) 고용보험
	end_pay int(12) 퇴직적립
	minus int(12) 기타공제
	*/
	//지급금액 존재하면 DB 입력
	//if($money_result_var[$i]) {
	if(1==1) {
		//기존 데이터 유무
		$sql_opt1 = "select * from pibohum_base_pay 
							where com_code = '$code' and sabun = '$sabun[$i]' and year = '$search_year' and month = '$search_month' ";
		//echo $sql_opt1;
		//exit;
		$result_opt1 = sql_query($sql_opt1);
		$total_opt1 = mysql_num_rows($result_opt1);

		//수정
		if ($total_opt1) {
			$sql = "update pibohum_base_pay set 
					$sql_common 
					where com_code = '$code' and sabun = '$sabun[$i]' and year = '$search_year' and month = '$search_month' ";
		//등록
		}else{
			$sql = "insert pibohum_base_pay set 
					$sql_common
					, com_code = '$code', sabun = '$sabun[$i]', year = '$search_year', month = '$search_month' ";
		}
		//echo $_POST['g6_'.$i]."<br><br>";
		//echo $sql."<br><br>";
		//exit;
		sql_query($sql);
	}
}
//exit;
alert("정상적으로 급여반영이 되었습니다.","pay_list.php?search_year=$search_year&search_month=$search_month");
//goto_url("./4insure_list.php");
?>