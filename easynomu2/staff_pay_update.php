<?
$sub_menu = "200100";
include_once("./_common.php");

/*
//POST용
foreach($_POST as $key => $value) { 
	$$key = $value; // register_globals option 편하게(?) 사용하기 위한 부분 
	if(!is_array($$key)) {
		echo $key." = ".$value."<br>"; 
	} else { 
		for($a=0; $a < sizeof($$key); $a++) 
		echo $key."[".$a."] = ".$value[$a]."<br>"; 
	} 
}
exit;
*/

//id 변수 생성
if ($w != 'u') {
	$sql_max = "select max(sabun) from $g4[pibohum_base] where com_code = '$code' ";
	$result_max = sql_query($sql_max);
	$row_max = mysql_fetch_array($result_max);
	$id = $row_max[0]+1;
	if(strlen($id) == 3) $id = "0".$id;
	else if(strlen($id) == 2) $id = "00".$id;
	else if(strlen($id) == 1) $id = "000".$id;
	//echo strlen($id);
	//echo $id;
	//exit;
}
$now_time = date("Y-m-d H:i:s");

// 상여금 지급일
$bonus_array = $bonus[0].",".$bonus[1].",".$bonus[2].",".$bonus[3].",".$bonus[4].",".$bonus[5];
$bonus_p_array = $bonus_p[0].",".$bonus_p[1].",".$bonus_p[2].",".$bonus_p[3].",".$bonus_p[4].",".$bonus_p[5];

$sql_common2 = " pay_gbn = '$pay_gbn',
						step = '$step',
						work_gbn = '$work_gbn',
						workday_week = '$workday_week' 
						";

//천단위콤마 제거
$bonus_money = str_replace(',','',$bonus_money);
$money_year = str_replace(',','',$money_year);
$money_month_base = str_replace(',','',$money_month_base);
$money_month = str_replace(',','',$money_month);
//기본급
$money_min = str_replace(',','',$money_min);
$money_hour_ts = str_replace(',','',$money_hour_ts);

$money_g1 = str_replace(',','',$money_g1);
$money_g2 = str_replace(',','',$money_g2);
$money_g3 = str_replace(',','',$money_g3);
$money_g4 = str_replace(',','',$money_g4);
$money_g5 = str_replace(',','',$money_g5);
$money_b1 = str_replace(',','',$money_b1);
$money_b2 = str_replace(',','',$money_b2);
$money_b3 = str_replace(',','',$money_b3);
$money_b4 = str_replace(',','',$money_b4);
$money_b5 = str_replace(',','',$money_b5);
$money_e1 = str_replace(',','',$money_e1);
$money_e2 = str_replace(',','',$money_e2);
$money_e3 = str_replace(',','',$money_e3);
$money_e4 = str_replace(',','',$money_e4);
$money_e5 = str_replace(',','',$money_e5);
$money_e6 = str_replace(',','',$money_e6);
$money_e7 = str_replace(',','',$money_e7);
$money_e8 = str_replace(',','',$money_e8);
$money_e9 = str_replace(',','',$money_e9);
//$money_total_sum = str_replace(',','',$money_total_sum);
//최저시급 천단위콤바 제거
$money_hour_ds = str_replace(',','',$money_min_time);
//시급제일 경우 기본시급 미입력 시 (기본시급 = 기준시급) 161102
if(!$money_min_base) $money_min_base = $money_hour;
//기준시급
$money_hour = str_replace(',','',$money_hour);
//기본시급
$money_min_base = str_replace(',','',$money_min_base);
//기본일급
$money_day_base = str_replace(',','',$money_day_base);
//연봉총액
$money_year_base = str_replace(',','',$money_year_base);
//월평균신고금액
$pay_yun = str_replace(',','',$pay_yun);
$pay_health = str_replace(',','',$pay_health);
$pay_goyong = str_replace(',','',$pay_goyong);
//4대보험 수동입력
$money_yun = str_replace(',','',$money_yun);
$money_health = str_replace(',','',$money_health);
$money_yoyang = str_replace(',','',$money_yoyang);
$money_goyong = str_replace(',','',$money_goyong);

if($money_b4 == "") $money_b4 = 0;
if($money_b5 == "") $money_b5 = 0;
if($money_e1 == "") $money_e1 = 0;
if($money_e2 == "") $money_e2 = 0;
if($money_e3 == "") $money_e3 = 0;
if($money_e4 == "") $money_e4 = 0;
if($money_e5 == "") $money_e5 = 0;
if($money_e6 == "") $money_e6 = 0;
if($money_e7 == "") $money_e7 = 0;
if($money_e8 == "") $money_e8 = 0;
if($money_e9 == "") $money_e9 = 0;

if($pay_gbn == 1) {
	//시급제 : 기준시급
	$money_hour_ds = $money_hour;
	//$money_month_base = $money_total_sum;
}
//강제 기본급 수동입력
$check_money_min_yn = "Y";

//급여유형 세부사항
if($pay_gbn == "0") $input_type = $pay_gbn2_0;
else if($pay_gbn == "1") $input_type = $pay_gbn2_1;
else if($pay_gbn == "3") $input_type = $pay_gbn2_3;

$sql_common3 = "
						memo_pay = '$memo_pay',
						annual_paid_holiday = '$annual_paid_holiday',
						check_bonus_money_yn = '$check_bonus_money_yn',
						bonus_money = '$bonus_money',
						bonus_standard = '$bonus_standard',
						bonus_percent = '$bonus_percent',
						bonus_time = '$bonus_array',
						bonus_p = '$bonus_p_array',
						input_type = '$input_type',
						workhour_day_d = '$workhour_day_d',
						workhour_day_w = '$workhour_day_w',
						workhour_ext_w = '$workhour_ext_w',
						workhour_hday_w = '$workhour_hday_w',
						workhour_night_w = '$workhour_night_w',
						check_worktime_d_yn = '$check_worktime_d_yn',
						check_worktime_w_yn = '$check_worktime_w_yn',
						check_worktime_yn = '$check_worktime_yn',
						check_money_hour_ts_yn = '$check_money_hour_ts_yn',
						check_money_month_yn = '$check_money_month_yn',
						check_money_min_yn = '$check_money_min_yn',
						check_money_min_2013_yn = '$check_money_min_2013_yn',
						check_money_b_yn = '$check_money_b_yn',
						money_e_exclude = '$money_e_exclude',
						workhour_day = '$workhour_day',
						workhour_ext = '$workhour_ext',
						workhour_hday = '$workhour_hday',
						workhour_night = '$workhour_night',
						money_year_yn = '$money_year_yn',
						workhour_year = '$workhour_year',
						money_year = '$money_year',
						money_month_base = '$money_month_base',
						money_month_base_pesent = '$money_month_base_pesent',
						money_hour_ms = '$money_min',
						money_hour_ds = '$money_hour_ds',
						money_hour_ts = '$money_hour_ts',
						money_min_base = '$money_min_base',
						money_day_base = '$money_day_base',
						money_year_base = '$money_year_base',
						money_year_base_division = '$money_year_base_division',
						money_g1 = '$money_g1',
						money_g2 = '$money_g2',
						money_g3 = '$money_g3',
						money_g4 = '$money_g4',
						money_g5 = '$money_g5',
						money_b1 = '$money_b1',
						money_b2 = '$money_b2',
						money_b3 = '$money_b3',
						money_b4 = '$money_b4',
						money_b5 = '$money_b5',
						money_e1 = '$money_e1',
						money_e2 = '$money_e2',
						money_e3 = '$money_e3',
						money_e4 = '$money_e4',
						money_e5 = '$money_e5',
						money_e6 = '$money_e6',
						money_e7 = '$money_e7',
						money_e8 = '$money_e8',
						money_e9 = '$money_e9',

						pay_yun = '$pay_yun',
						pay_health = '$pay_health',
						pay_goyong = '$pay_goyong',
						money_yun = '$money_yun',
						money_health = '$money_health',
						money_yoyang = '$money_yoyang',
						money_goyong = '$money_goyong'
						";
//echo $sql_common3;
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
	$sql2 = " update pibohum_base_opt set 
				$sql_common2 
				where com_code = '$code' and sabun='$id' ";
} else {
	$sql2 = " insert pibohum_base_opt set 
				$sql_common2 
				, com_code = '$code', sabun='$id' ";
}
if($total_opt2) {
	$sql3 = " update pibohum_base_opt2 set 
				$sql_common3 
				where com_code = '$code' and sabun='$id' ";
} else {
	$sql3 = " insert pibohum_base_opt2 set 
				$sql_common3 
				, com_code = '$code', sabun='$id', wr_date = '$now_time' ";
}
//echo $sql2;
//exit;
sql_query($sql);
sql_query($sql2);
sql_query($sql3);

//백업DB 저장용 쿼리
$sql_base = " select * from pibohum_base where com_code='$code' and sabun='$id' ";
$result_base = sql_query($sql_base);
$row_base=mysql_fetch_array($result_base);
$sql_common = " name = '$row_base[name]',
						jumin_no = '$row_base[jumin_no]',
						add_tel = '$row_base[add_tel]',
						w_postno = '$row_base[w_postno]',
						w_juso = '$row_base[w_juso]',
						in_day = '$row_base[in_day]',
						fg_div = '$row_base[fg_div]',
						out_day = '$row_base[out_day]',
						apply_gy = '$row_base[apply_gy]',
						apply_sj = '$row_base[apply_sj]',
						apply_km = '$row_base[apply_km]',
						apply_gg = '$row_base[apply_gg]',
						apply_jy = '$row_base[apply_jy]',
						gubun = '$row_base[gubun]',
						work_form = '$row_base[work_form]',
						nation = '$row_base[nation]',
						staycapacity = '$row_base[staycapacity]'
						";
//$result_opt1 = sql_query($sql_opt1);
$row_opt=mysql_fetch_array($result_opt1);
$sql_common2_opt = " emp_cel = '$row_opt[emp_cel]',
						emp_email = '$row_opt[emp_email]',
						w_juso2 = '$row_opt[w_juso2]',
						dept = '$row_opt[dept]',
						dept_1 = '$row_opt[dept_1]',
						dept_2 = '$row_opt[dept_2]',
						jikjong_code = '$row_opt[jikjong_code]',
						jikjong = '$row_opt[jikjong]',
						position = '$row_opt[position]',

						pic = '$row_opt[pic]',
						remark = '$row_opt[remark]',

						family_cnt = '$row_opt[family_cnt]',
						child_cnt = '$row_opt[child_cnt]',
						etc_cnt = '$row_opt[etc_cnt]',

						bank_name = '$row_opt[bank_name]',
						bank_account = '$row_opt[bank_account]',
						bank_depositor = '$row_opt[bank_depositor]',
						drawback_form = '$row_opt[drawback_form]',
						drawback_form_grade = '$row_opt[drawback_form_grade]',
						aged = '$row_opt[aged]',
						insurance = '$row_opt[insurance]',
						retired = '$row_opt[retired]',
						deferred = '$row_opt[deferred]',
						chidbirth = '$row_opt[chidbirth]',
						matriarch = '$row_opt[matriarch]',
						rural = '$row_opt[rural]',
						straight = '$row_opt[straight]',
						fund = '$row_opt[fund]',
						contract_sdate = '$row_opt[contract_sdate]',
						contract_edate = '$row_opt[contract_edate]',
						apply_so = '$row_opt[apply_so]',
						apply_ju = '$row_opt[apply_ju]',

						school_sdate = '$row_opt[school_sdate]',
						school_edate = '$row_opt[school_edate]',
						school_name = '$row_opt[school_name]',
						school_part = '$row_opt[school_part]',
						school_sdate2 = '$row_opt[school_sdate2]',
						school_edate2 = '$row_opt[school_edate2]',
						school_name2 = '$row_opt[school_name2]',
						school_part2 = '$row_opt[school_part2]',
						school_sdate3 = '$row_opt[school_sdate3]',
						school_edate3 = '$row_opt[school_edate3]',
						school_name3 = '$row_opt[school_name3]',
						school_part3 = '$row_opt[school_part3]',
						career_sdate = '$row_opt[career_sdate]',
						career_edate = '$row_opt[career_edate]',
						career_name = '$row_opt[career_name]',
						career_part = '$row_opt[career_part]',
						career_sdate2 = '$row_opt[career_sdate2]',
						career_edate2 = '$row_opt[career_edate2]',
						career_name2 = '$row_opt[career_name2]',
						career_part2 = '$row_opt[career_part2]',
						career_sdate3 = '$row_opt[career_sdate3]',
						career_edate3 = '$row_opt[career_edate3]',
						career_name3 = '$row_opt[career_name3]',
						career_part3 = '$row_opt[career_part3]',
						education_sdate = '$row_opt[education_sdate]',
						education_edate = '$row_opt[education_edate]',
						education_name = '$row_opt[education_name]',
						education_organization = '$row_opt[education_organization]',
						education_sdate2 = '$row_opt[education_sdate2]',
						education_edate2 = '$row_opt[education_edate2]',
						education_name2 = '$row_opt[education_name2]',
						education_organization2 = '$row_opt[education_organization2]',
						education_sdate3 = '$row_opt[education_sdate3]',
						education_edate3 = '$row_opt[education_edate3]',
						education_name3 = '$row_opt[education_name3]',
						education_organization3 = '$row_opt[education_organization3]',
						license_date = '$row_opt[license_date]',
						license_name = '$row_opt[license_name]',
						license_step = '$row_opt[license_step]',
						license_organization = '$row_opt[license_organization]'
						";

//변경내역 DB 저장
$sql5 = " insert pibohum_bak     set  $sql_common  , com_code = '$code', sabun = '$id' ";
sql_query($sql5);
//mid 추출
$sql_bak = " select * from pibohum_bak where com_code='$code' and sabun='$id' order by id desc limit 0,1 ";
$result_bak = sql_query($sql_bak);
$row_bak=mysql_fetch_array($result_bak);
$mid = $row_bak['id'];
$sql6 = " insert pibohum_bak_opt set  $sql_common2 , $sql_common2_opt , com_code = '$code', sabun = '$id', mid = '$mid' ";
$sql7 = " insert pibohum_bak_opt2 set $sql_common3 , com_code = '$code', sabun = '$id', mid = '$mid', wr_date = '$now_time' ";
sql_query($sql6);
sql_query($sql7);

if ($w == 'u') {
	alert("정상적으로 급여정보가 수정 되었습니다.","staff_pay_view.php?w=u&id=$id&code=$code&page=$page&tab=$tab");
} else {
	alert("정상적으로 급여정보가 등록 되었습니다.","staff_pay_view.php?w=u&id=$id&code=$code&page=$page&tab=$tab");
}
?>
