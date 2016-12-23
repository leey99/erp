<?
$sub_menu = "400100";
include_once("./_common.php");

$now_date = date("Y-m-d");
$now_time = date("H:i:s");

header ( 'Content-Type:application/json; charset=euckr' );

function Unescape($str){
	return urldecode(preg_replace_callback('/%u([[:alnum:]]{4})/', 'UnescapeFunc', $str));
}
function UnescapeFunc($str){
	return iconv('UTF-16LE', 'UTF-8', chr(hexdec(substr($str[1], 2, 2))).chr(hexdec(substr($str[1],0,2))));
}

$check = "ok";
$jData_org      = Unescape($_POST['jData']);

$jData      = str_replace('\\', '', $jData_org);
$jData      = json_decode($jData, true);

$jData['check'] = $check;

$search_year = $jData['year'];
$search_month = $jData['month'];
$code = $jData['code'];

$manual_4insure = $jData['manual_4insure'];
$manual_tax = $jData['manual_tax'];
$c_manual_4insure = $jData['c_manual_4insure'];

$total = (int)$jData['total'];

//수동입력
$manual = $manual_ext.",".$manual_night.",".$manual_hday.",".$manual_4insure.",".$manual_tax.",".$c_manual_4insure;
/*
$sql = "insert pibohum_base_pay_h set 
		memo1 = '$jData_org'
		, com_code = '20399', sabun = '9999', year = '2016', month = '' ";
sql_query($sql);
*/
for($i=1; $i<=$total; $i++) {
	$sabun[$i] = $jData['sabun_'.$i];
	$w_1[$i] = $jData['workhour_1_'.$i];
	$w_2[$i] = $jData['workhour_2_'.$i];
	$w_3[$i] = $jData['workhour_3_'.$i];
	$w_1_hday[$i] = $jData['workhour_1_hday_'.$i];
	$w_2_hday[$i] = $jData['workhour_2_hday_'.$i];
	$w_3_hday[$i] = $jData['workhour_3_hday_'.$i];
	$w_edu[$i] = $jData['w_edu_'.$i];
	$w_phone[$i] = $jData['w_phone_'.$i];

	$annual_paid_holiday_var[$i] = $jData['money_year_'.$i];
	$b1_var[$i] = $jData['b1_'.$i];

	$workhour_total_var[$i] = $jData['workhour_total_'.$i];

	$money_hour_ds_var[$i] = $jData['money_hour_ds_'.$i];
	$money_hour_ts_var[$i] = $jData['money_hour_ts_'.$i];
	$money_time_var[$i] = $jData['money_time_'.$i];

	$tax_so_value[$i] = $jData['tax_so_'.$i];
	$tax_jumin_value[$i] = $jData['tax_jumin_'.$i];

	$yun[$i] = $jData['money_yun_'.$i];
	$health[$i] = $jData['money_health_'.$i];
	$yoyang[$i] = $jData['money_yoyang_'.$i];
	$goyong[$i] = $jData['money_goyong_'.$i];

	$c_yun[$i] = $jData['c_money_yun_'.$i];
	$c_health[$i] = $jData['c_money_health_'.$i];
	$c_yoyang[$i] = $jData['c_money_yoyang_'.$i];
	$c_goyong[$i] = $jData['c_money_goyong_'.$i];
	$c_sanjae[$i] = $jData['c_money_sanjae_'.$i];
	$c_money_gongje_var[$i] = $jData['c_money_gongje_'.$i];
	$retirement_pension_var[$i] = $jData['retirement_pension_'.$i];

	$money_total_var[$i] = $jData['money_total_'.$i];
	$money_for_tax_var[$i] = $jData['money_for_tax_'.$i];
	$money_gongje_var[$i] = $jData['money_gongje_'.$i];
	$money_result_var[$i] = $jData['money_result_'.$i];

	$minus_var[$i] = preg_replace('@,@', '', $jData['minus_'.$i]);

	//천단위 콤마 제거 DB 저장
	$w_phone[$i] = preg_replace('@,@', '', $w_phone[$i]);
	$money_hour_ds_var[$i] = preg_replace('@,@', '', $money_hour_ds_var[$i]);
	$money_hour_ts_var[$i] = preg_replace('@,@', '', $money_hour_ts_var[$i]);
	$money_time_var[$i] = preg_replace('@,@', '', $money_time_var[$i]);

	$annual_paid_holiday_var[$i] = preg_replace('@,@', '', $annual_paid_holiday_var[$i]);
	$b1_var[$i] = preg_replace('@,@', '', $b1_var[$i]);

	$tax_so_value[$i] = preg_replace('@,@', '', $tax_so_value[$i]);
	$tax_jumin_value[$i] = preg_replace('@,@', '', $tax_jumin_value[$i]);

	$yun[$i] = preg_replace('@,@', '', $yun[$i]);
	$health[$i] = preg_replace('@,@', '', $health[$i]);
	$yoyang[$i] = preg_replace('@,@', '', $yoyang[$i]);
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

	//주민등록번호
	$sql2 = " select * from pibohum_base a, pibohum_base_opt b where (a.com_code=b.com_code and a.sabun=b.sabun) and a.com_code='$code' and a.sabun='$sabun[$i]' ";
	$result2 = sql_query($sql2);
	$row2 = mysql_fetch_array($result2);

	//직위
	$position[$i] = $row2['position'];
	if($row2['position']) {
		$sql_position = " select * from com_code_list where item='position' and com_code = '$code' and code = $row2[position] ";
		//echo $sql_position;
		$result_position = sql_query($sql_position);
		$row_position = sql_fetch_array($result_position);
		$position_txt[$i] = $row_position['name'];
	}
	//부서
	$dept_code[$i] = $row2['dept'];
	if($row2['dept']) {
		$sql_dept = " select * from com_code_list where item='dept' and com_code='$code' and code = $row2[dept] ";
		$result_dept = sql_query($sql_dept);
		$row_dept = sql_fetch_array($result_dept);
		$dept[$i] = $row_dept['name'];
	}

	//SQL 필드 입력값
	$sql_common = " 
							w_date = '$now_date',
							w_time = '$now_time',
							name = '$row2[name]',
							ssnb = '$row2[jumin_no]',
							position = '$position[$i]',
							position_txt = '$position_txt[$i]',
							step = '$step[$i]',
							step_txt = '$step_txt[$i]',
							in_day = '$row2[in_day]',
							out_day = '$row2[out_day]',
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

							workhour_total = '$workhour_total_var[$i]',

							money_hour_ds = '$money_hour_ds_var[$i]',
							money_time = '$money_hour_ts_var[$i]',
							money_min_base = '$money_time_var[$i]',
							money_day = '$money_day[$i]',
							money_month = '$money_month_var[$i]',
							money_month_fix = '$money_month_fix',
							money_setting = '$money_setting_var[$i]',

							manual = '$manual',

							annual_paid_holiday = '$annual_paid_holiday_var[$i]',
							b1 = '$b1_var[$i]',

							tax_so = '$tax_so_value[$i]',
							tax_jumin = '$tax_jumin_value[$i]',

							yun = '$yun[$i]',
							health = '$health[$i]',
							yoyang = '$yoyang[$i]',
							goyong = '$goyong[$i]',
							money_gongje = '$money_gongje_var[$i]',

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
							money_result = '$money_result_var[$i]'

	";
/*
	if($i == 1) {
		$sql_common_esc = preg_replace('@\'@', '\"', $sql_common);
		$sql = "insert pibohum_base_pay_h set memo1 = '$sql_common_esc', com_code = '20399', sabun = '9999', year = '2016', month = '' ";
		sql_query($sql);
	}
*/
	//기존 데이터 유무
	$sql_opt1 = "select * from pibohum_base_pay_h 
						where com_code = '$code' and sabun = '$sabun[$i]' and year = '$search_year' and month = '$search_month' ";
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
/*
		$sql_common_esc = preg_replace('@\'@', '\"', $sql);
		$sql_esc = "insert pibohum_base_pay_h set memo1 = '$sql_common_esc', com_code = '20399', sabun = '9999', year = '2016', month = '' ";
		sql_query($sql_esc);
*/
	}
	sql_query($sql);
}
$result = json_encode ( $jData );
echo $result;
?>