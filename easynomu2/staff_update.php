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
if($_FILES['filename']['tmp_name']) {
	$pic_name = $code."_".$id.".jpg";
	$upload_file = $upload_dir . $pic_name;
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
//퇴사일 입력 시 자동 퇴사 기능 : 자동 퇴사 기능 제외 150819
if($emp_edate) {
	//$emp_stat = 2;
}
$sql_common = " name = '$emp_name',
						jumin_no = '$cust_ssnb',
						add_tel = '$emp_tel',
						w_postno = '$adr_zip',
						w_juso = '$adr_adr1',
						in_day = '$emp_sdate',
						fg_div = '$foreign_gbn',
						out_day = '$emp_edate',
						out_temp = '$out_temp',

						layoff_sdate = '$layoff_sdate',
						layoff_edate = '$layoff_edate',

						apply_gy = '$isgy',
						apply_sj = '$issj',
						apply_km = '$iskm',
						apply_gg = '$isgg',
						apply_jy = '$isjy',

						date_gy = '$date_gy',
						date_sj = '$date_sj',
						date_km = '$date_km',
						date_gg = '$date_gg',

						quit_gy = '$quit_gy',
						quit_sj = '$quit_sj',
						quit_km = '$quit_km',
						quit_gg = '$quit_gg',

						gubun = '$emp_stat',
						work_form = '$work_form',
						nation = '$nation',
						staycapacity = '$staycapacity',
						employee_no = '$employee_no'
";

//화성시장애인부모회
if($code == '20399') {
	//echo getInitial($emp_name);
	//exit;
	$emp_name_first = mb_substr($emp_name, 0, 1, "euc-kr");
	if(preg_match("/[가-깋]/", $emp_name_first)) {
		$dept1 = 3;
		echo $dept1;
		exit;
	}
}
$sql_common2 = " emp_cel = '$emp_cel',
						emp_email = '$emp_email',
						w_juso2 = '$adr_adr2',
						dept = '$dept',
						dept_1 = '$dept1',
						dept_2 = '$dept2',
						jikjong_code = '$jikjong_code',
						jikjong = '$jikjong',
						position = '$position',

						pic = '$pic_name',
						remark = '$remark',

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
						apply_so = '$isso',
						apply_ju = '$isju',

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

//활동보조인 opt
if($kind == "beistand" && !$w) {
	$sql_common2_beistand = " , pay_gbn = '1',
							work_gbn = 'A',
							workday_week = '5' ";
	$sql_common3 = " annual_paid_holiday = '15', check_bonus_money_yn = '', bonus_money = '0', bonus_standard = '', bonus_percent = '0', bonus_time = '', bonus_p = '', input_type = '2', workhour_day_w = '0', workhour_ext_w = '0', workhour_hday_w = '0', workhour_night_w = '0', check_worktime_w_yn = 'N', check_worktime_yn = 'N', check_money_hour_ts_yn = '', check_money_month_yn = '', check_money_min_yn = 'Y', check_money_min_2013_yn = '', check_money_b_yn = 'N', money_e_exclude = '', workhour_day = '0', workhour_ext = '0', workhour_hday = '0', workhour_night = '0', money_year_yn = '', workhour_year = '0', money_year = '0', money_month_base = '0', money_hour_ms = '0', money_hour_ds = '6700', money_hour_ts = '0', money_min_base = '0', money_g1 = '0', money_g2 = '0', money_g3 = '0', money_g4 = '0', money_g5 = '0', money_b1 = '0', money_b2 = '0', money_b3 = '0', money_b4 = '0', money_b5 = '0', money_e1 = '0', money_e2 = '0', money_e3 = '0', money_e4 = '0', money_e5 = '0', money_e6 = '0', money_e7 = '0', money_e8 = '0' ";
	$sql3 = " insert pibohum_base_opt2 set $sql_common3 , com_code = '$code', sabun='$id', wr_date = '$now_time' ";
	sql_query($sql3);
} else {
	$sql_common2_beistand = "";
}

//추가 필드 데이터 유무 (사원정보 추가)
$sql_opt1 = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
//echo $sql_opt1;
//exit;
$result_opt1 = sql_query($sql_opt1);
$total_opt1 = mysql_num_rows($result_opt1);

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
				$sql_common2_beistand
				, com_code = '$code', sabun='$id' ";
}
sql_query($sql);
sql_query($sql2);

//백업DB 저장용 쿼리
$row_opt=mysql_fetch_array($result_opt1);
$sql_common2_opt = " pay_gbn = '$row_opt[pay_gbn]',
						step = '$row_opt[step]',
						work_gbn = '$row_opt[work_gbn]',
						workday_week = '$row_opt[workday_week]' 
						";
$sql_opt2 = " select * from pibohum_base_opt2 where com_code='$code' and sabun='$id' ";
$result_opt2 = sql_query($sql_opt2);
$row_opt2=mysql_fetch_array($result_opt2);
$sql_common3 = " annual_paid_holiday = '$row_opt2[annual_paid_holiday]',
						check_bonus_money_yn = '$row_opt2[check_bonus_money_yn]',
						bonus_money = '$row_opt2[bonus_money]',
						bonus_standard = '$row_opt2[bonus_standard]',
						bonus_percent = '$row_opt2[bonus_percent]',
						bonus_time = '$row_opt2[bonus_time]',
						bonus_p = '$row_opt2[bonus_p]',
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
						money_month_base_pesent = '$row_opt2[money_month_base_pesent]',
						money_hour_ms = '$row_opt2[money_hour_ms]',
						money_hour_ds = '$row_opt2[money_hour_ds]',
						money_hour_ts = '$row_opt2[money_hour_ts]',
						money_min_base = '$row_opt2[money_min_base]',
						money_day_base = '$row_opt2[money_day_base]',
						money_year_base = '$row_opt2[money_year_base]',
						money_year_base_division = '$row_opt2[money_year_base_division]',
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
						money_e8 = '$row_opt2[money_e8]',
						money_e9 = '$row_opt2[money_e9]'
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
	alert("정상적으로 사원정보가 수정 되었습니다.","staff_view.php?w=u&id=$id&code=$code&page=$page");
} else {
	//alert("정상적으로 사원정보가 등록 되었습니다.","staff_list.php?page=$page");
	alert("정상적으로 사원정보가 등록 되었습니다.","staff_view.php?w=u&id=$id&code=$code&page=$page");
}
//echo $sql;
//echo $sql2;
//exit;
?>
