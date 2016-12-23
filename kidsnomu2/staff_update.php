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
// 휴대폰
if($emp_cel1) $emp_cel = $emp_cel1."-".$emp_cel2."-".$emp_cel3;
//전화번호
if($emp_tel1) $emp_tel = $emp_tel1."-".$emp_tel2."-".$emp_tel3;
//우편번호
if($adr_zip1) $adr_zip = $adr_zip1."-".$adr_zip2;
//주민번호
if($emp_ssnb1) $cust_ssnb = $emp_ssnb1."-".$emp_ssnb2;

//증명사진 경로
$upload_dir = 'files/images/';
$pic_name = $code."_".$id.".jpg";
$upload_file = $upload_dir . $pic_name;

if($_FILES['filename']['tmp_name']) {
	//echo $upload_file;
	//echo $_FILES['filename']['tmp_name'];
	if ( move_uploaded_file($_FILES['filename']['tmp_name'], $upload_file) ) {
		//echo "SUCCESS";
	} else {
		alert("정상적으로 파일 업로드가 되지 않았습니다.\n파일을 확인하신 후 다시 업로드하여 주십시오.","staff_view.php?id=$id&code=$code&page=$page");
	}
} else {
	if(!is_file($upload_file)) $pic_name = "";
}
//echo is_file($upload_file);
//echo $w;
//echo $fund[0];
//exit;
// 취업프로그램 참여 여부
$fund_array = $fund[0].",".$fund[1].",".$fund[2].",".$fund[3].",".$fund[4].",".$fund[5].",".$fund[6].",".$fund[7].",".$fund[8].",".$fund[9].",".$fund[10].",".$fund[11];
//echo $fund_array;
//exit;
// 상여금 지급일
$bonus_array = $bonus[0].",".$bonus[1].",".$bonus[2].",".$bonus[3].",".$bonus[4].",".$bonus[5];
$bonus_p_array = $bonus_p[0].",".$bonus_p[1].",".$bonus_p[2].",".$bonus_p[3].",".$bonus_p[4].",".$bonus_p[5];
//피부양자 등록
$children1 = $children_relation.",".$children_name.",".$children_ssnb.",".$children_cohabitation;
$children2 = $children_relation2.",".$children_name2.",".$children_ssnb2.",".$children_cohabitation2;
$children3 = $children_relation3.",".$children_name3.",".$children_ssnb3.",".$children_cohabitation3;
$children4 = $children_relation4.",".$children_name4.",".$children_ssnb4.",".$children_cohabitation4;
$children5 = $children_relation5.",".$children_name5.",".$children_ssnb5.",".$children_cohabitation5;
$children6 = $children_relation6.",".$children_name6.",".$children_ssnb6.",".$children_cohabitation6;

$sql_common = " name = '$emp_name',
						jumin_no = '$cust_ssnb',
						add_tel = '$emp_tel',
						w_postno = '$adr_zip',
						w_juso = '$adr_adr1',
						in_day = '$emp_sdate',
						fg_div = '$foreign_gbn',
						out_day = '$emp_edate',
						apply_gy = '$isgy',
						apply_sj = '$issj',
						apply_km = '$iskm',
						apply_gg = '$isgg',

						children1 = '$children1',
						children2 = '$children2',
						children3 = '$children3',
						children4 = '$children4',
						children5 = '$children5',
						children6 = '$children6',

						gubun = '$emp_stat',
						work_form = '$work_form'
						";
$sql_common2 = " emp_cel = '$emp_cel',
						emp_email = '$emp_email',
						w_juso2 = '$adr_adr2',
						dept_1 = '$dept',
						dept_2 = '$dept2',
						jikjong_code = '$jikjong_code',
						jikjong = '$jikjong',
						pay_gbn = '$pay_gbn',
						position = '$position',
						step = '$step',
						pic = '$pic_name',
						remark = '$remark',
						work_gbn = '$work_gbn',
						workday_week = '$workday_week',
						family_cnt = '$family_count',
						child_cnt = '$child_count',
						etc_cnt = '$etc_count',
						spouse_yn = '$spouse_yn',

						bank_name = '$bank_1',
						bank_account = '$bank_2',
						bank_depositor = '$bank_3',
						drawback_form = '$drawback_form',
						drawback_form_grade = '$drawback_form_grade',
						aged = '$aged',
						insurance = '$insurance',
						retired = '$retired',
						deferred = '$deferred',
						chidbirth = '$chidbirth',
						matriarch = '$matriarch',
						rural = '$rural',
						straight = '$straight',
						fund = '$fund_array',
						contract_sdate = '$contract_sdate',
						contract_edate = '$contract_edate',
						layoff_sdate = '$layoff_sdate',
						layoff_edate = '$layoff_edate',

						school_sdate = '$school_sdate',
						school_edate = '$school_edate',
						school_name = '$school_name',
						school_part = '$school_part',
						school_sdate2 = '$school_sdate2',
						school_edate2 = '$school_edate2',
						school_name2 = '$school_name2',
						school_part2 = '$school_part2',
						school_sdate3 = '$school_sdate3',
						school_edate3 = '$school_edate3',
						school_name3 = '$school_name3',
						school_part3 = '$school_part3',
						career_sdate = '$career_sdate',
						career_edate = '$career_edate',
						career_name = '$career_name',
						career_part = '$career_part',
						career_sdate2 = '$career_sdate2',
						career_edate2 = '$career_edate2',
						career_name2 = '$career_name2',
						career_part2 = '$career_part2',
						career_sdate3 = '$career_sdate3',
						career_edate3 = '$career_edate3',
						career_name3 = '$career_name3',
						career_part3 = '$career_part3',
						education_sdate = '$education_sdate',
						education_edate = '$education_edate',
						education_name = '$education_name',
						education_organization = '$education_organization',
						education_sdate2 = '$education_sdate2',
						education_edate2 = '$education_edate2',
						education_name2 = '$education_name2',
						education_organization2 = '$education_organization2',
						education_sdate3 = '$education_sdate3',
						education_edate3 = '$education_edate3',
						education_name3 = '$education_name3',
						education_organization3 = '$education_organization3',
						license_date = '$license_date',
						license_name = '$license_name',
						license_step = '$license_step',
						license_organization = '$license_organization'
						";

//천단위콤마 제거
$bonus_money = str_replace(',','',$bonus_money);
$money_year = str_replace(',','',$money_year);
$money_month_base = str_replace(',','',$money_month_base);
$money_month = str_replace(',','',$money_month);
$money_min = str_replace(',','',$money_min);
$money_hour = str_replace(',','',$money_hour);
$money_hour_ds = str_replace(',','',$money_hour_ds);
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
//$money_total_sum = str_replace(',','',$money_total_sum);
//기본시급 천단위콤바 제거
$money_hour_ds = str_replace(',','',$money_min_time);
//기본시급
$money_min_base = str_replace(',','',$money_min_base);

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

if($pay_gbn == 1) {
	//시급제 : 기준시급
	$money_hour_ds = $money_hour;
	//$money_month_base = $money_total_sum;
}
//강제 기본급 수동입력 > 제거 150707
//$check_money_min_yn = "Y";

$sql_common3 = " annual_paid_holiday = '$annual_paid_holiday',
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
						money_hour_ms = '$money_min',
						money_hour_ds = '$money_hour_ds',
						money_hour_ts = '$money_hour_ts',
						money_min_base = '$money_min_base',
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
						money_e8 = '$money_e8'
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

//수정
if ($w == 'u') {
	$sql = " update $g4[pibohum_base] set 
				$sql_common 
			  where com_code = '$code' and sabun='$id' ";
	//echo $sql;
	//exit;
//등록
} else {
	$sql = " insert $g4[pibohum_base] set 
					$sql_common
					, com_code = '$code', sabun='$id' ";
	//echo $sql;
	//exit;
  //$id = mysql_insert_id();
}
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
//echo $sql3;
//exit;

//기본 근로자 정보 DB
$sql_base = " select * from pibohum_base where com_code='$code' and sabun='$id' ";
$result_base = sql_query($sql_base);
$row_base = mysql_fetch_array($result_base);
//echo $sql_base;
//exit;

//쿼리 실행
sql_query($sql);
sql_query($sql2);
sql_query($sql3);
//변경내역 DB 저장
$sql5 = " insert pibohum_bak     set  $sql_common  , com_code = '$code', sabun = '$id' ";
$sql6 = " insert pibohum_bak_opt set  $sql_common2 , com_code = '$code', sabun = '$id' ";
$sql7 = " insert pibohum_bak_opt2 set $sql_common3 , com_code = '$code', sabun = '$id', wr_date = '$now_time' ";
sql_query($sql5);
sql_query($sql6);
sql_query($sql7);

//노무관리 - 퇴직관리 자동 입력 160217
//재직상태 기존 퇴사 아니며 새 입력 데이터 퇴사일 경우
if($row_base['gubun'] != "2" && $emp_stat == "2") {
	$sql1 = " select * from pibohum_base_nomu where com_code='$code' and sabun='$id' ";
	$result1 = sql_query($sql1);
	$total1 = mysql_num_rows($result1);
	//퇴직구분 기타 개인사정 기본 설정
	$sql_common_nomu = " retire_reason = '', quit_date = '$emp_edate', quit_cause = '15' ";
	if($total1) {
		$sql_nomu = " update pibohum_base_nomu set 
					$sql_common_nomu 
					where com_code='$code' and sabun='$id' ";
	} else {
		$sql_nomu = " insert pibohum_base_nomu set 
					$sql_common_nomu 
					, com_code = '$code', sabun='$id' ";
	}
	sql_query($sql_nomu);
}
if ($w == 'u') {
	alert("정상적으로 사원정보가 수정 되었습니다.","staff_view.php?w=u&id=$id&code=$code&page=$page&tab=$tab");
	//alert("정상적으로 사원정보가 수정 되었습니다.","staff_list.php?page=$page");
} else {
	//alert("정상적으로 사원정보가 등록 되었습니다.","staff_list.php");
	alert("정상적으로 사원정보가 등록 되었습니다.","staff_view.php?w=u&id=$id&code=$code&page=$page&tab=$tab");
}
//echo $sql;
//echo $sql2;
//exit;
?>
