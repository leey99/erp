<?
$sub_menu = "100100";
include_once("./_common.php");

//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");
$now_time_file = date("Ymd_His");

//천단위콤마 제거
$bonus_money = str_replace(',','',$bonus_money);
$setting_pay = str_replace(',','',$setting_pay);
$month_pay = str_replace(',','',$month_pay);
//상여금 지급일
$bonus_array = $bonus_0.",".$bonus_1.",".$bonus_2.",".$bonus_3.",".$bonus_4.",".$bonus_5;
$bonus_p_array = $bonus_p_0.",".$bonus_p_1.",".$bonus_p_2.",".$bonus_p_3.",".$bonus_p_4.",".$bonus_p_5;
//퇴직금
$retirement_gbn = $retirement_gbn1.",".$retirement_gbn2.",".$retirement_gbn3;

//부속규정 / 화성서남부 이현주 국장 요청 160727
//첨부파일 경로
$upload_dir = 'files/employment/';
$employment_report_file_sql_1 = "";
$employment_report_file_sql_2 = "";
$employment_report_file_sql_3 = "";

//첨부서류 삭제 기능
if($employment_report_file_del_1 == 1) {
	$filename = $upload_dir.$e_file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(1)이 존재하지 않습니다.";
	}
}
if($employment_report_file_del_2 == 1) {
	$filename = $upload_dir.$e_file_2;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(2)이 존재하지 않습니다.";
	}
}
if($employment_report_file_del_3 == 1) {
	$filename = $upload_dir.$e_file_3;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(3)이 존재하지 않습니다.";
	}
}
//첨부서류1
if($_FILES['employment_report_file_1']['tmp_name']) {
	$employment_report_file_name1 = $_FILES['employment_report_file_1']['name'];
	$upload_file_name = $now_time_file."_".$employment_report_file_name1;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['employment_report_file_1']['tmp_name'], $upload_file);
}
if($employment_report_file_name1) {
	$employment_report_file_sql_1 = " employment_report_file_1 = '$upload_file_name', ";
} else {
	if($employment_report_file_del_1 == 1) $employment_report_file_sql_1 = " employment_report_file_1 = '', ";
}
//첨부서류2
if($_FILES['employment_report_file_2']['tmp_name']) {
	$employment_report_file_name2 = $_FILES['employment_report_file_2']['name'];
	$upload_file_name = $now_time_file."_".$employment_report_file_name2;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['employment_report_file_2']['tmp_name'], $upload_file);
}
if($employment_report_file_name2) {
	$employment_report_file_sql_2 = " employment_report_file_2 = '$upload_file_name', ";
} else {
	if($employment_report_file_del_2 == 1) $employment_report_file_sql_2 = " employment_report_file_2 = '', ";
}
//첨부서류3
if($_FILES['employment_report_file_3']['tmp_name']) {
	$employment_report_file_name3 = $_FILES['employment_report_file_3']['name'];
	$upload_file_name = $now_time_file."_".$employment_report_file_name3;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['employment_report_file_3']['tmp_name'], $upload_file);
}
if($employment_report_file_name3) {
	$employment_report_file_sql_3 = " employment_report_file_3 = '$upload_file_name', ";
} else {
	if($employment_report_file_del_3 == 1) $employment_report_file_sql_3 = " employment_report_file_3 = '', ";
}

$sql_common2 = " 
						check_bonus_money_yn = '$check_bonus_money_yn',
						bonus_money = '$bonus_money',
						bonus_standard = '$bonus_standard',
						bonus_percent = '$bonus_percent',
						bonus_time = '$bonus_array',
						bonus_p = '$bonus_p_array',
						check_bonus_money_payment = '$check_bonus_money_payment',

						$employment_report_file_sql_1
						$employment_report_file_sql_2
						$employment_report_file_sql_3

						persons = '$persons',
						man = '$man',
						woman = '$woman',

						work_gbn_text_a = '$work_gbn_text_a',
						work_gbn_text_b = '$work_gbn_text_b',

						stime = '$stime',
						etime = '$etime',
						rest1 = '$rest1',
						rest1e = '$rest1e',
						rest2 = '$rest2',
						rest2e = '$rest2e',
						rest3 = '$rest3',
						rest3e = '$rest3e',

						stime_b = '$stime_b',
						etime_b = '$etime_b',
						rest1_b = '$rest1_b',
						rest1e_b = '$rest1e_b',
						rest2_b = '$rest2_b',
						rest2e_b = '$rest2e_b',
						rest3_b = '$rest3_b',
						rest3e_b = '$rest3e_b',

						ext = '$ext',
						ext_b = '$ext_b',
						exte = '$exte',
						exte_b = '$exte_b',
						night = '$night',
						night_b = '$night_b',
						nighte = '$nighte',
						nighte_b = '$nighte_b',
						saturday_work = '$saturday_work',
						saturday_work_b = '$saturday_work_b',
						sunday_work = '$sunday_work',
						sunday_work_b = '$sunday_work_b',
						saturday_time = '$saturday_time',
						saturday_time_b = '$saturday_time_b',
						saturday_timee = '$saturday_timee',
						saturday_timee_b = '$saturday_timee_b',
						sunday_time = '$sunday_time',
						sunday_time_b = '$sunday_time_b',
						sunday_timee = '$sunday_timee',
						sunday_timee_b = '$sunday_timee_b',

						hday = '$hday',
						saturday_paid = '$saturday_paid',
						fday1 = '$fday1',
						fday2 = '$fday2',
						fday3 = '$fday3',

						hday1 = '$hday1',
						hday2 = '$hday2',
						hday3 = '$hday3',
						hday4 = '$hday4',
						hday5 = '$hday5',
						hday6 = '$hday6',
						hday7 = '$hday7',
						hday8 = '$hday8',
						hday9 = '$hday9',
						hday10 = '$hday10',
						hday11 = '$hday11',
						hday12 = '$hday12',

						holiday1 = '$holiday1',
						holiday2 = '$holiday2',
						holiday3 = '$holiday3',
						holiday4 = '$holiday4',
						holiday5 = '$holiday5',
						holiday6 = '$holiday6',

						summer_vacation = '$summer_vacation',

						affair1 = '$affair1',
						affair2 = '$affair2',
						affair3 = '$affair3',
						affair4 = '$affair4',
						affair5 = '$affair5',
						affair6 = '$affair6',
						affair7 = '$affair7',
						affair8 = '$affair8',
						affair9 = '$affair9',
						affair10 = '$affair10',
						affair11 = '$affair11',
						affair12 = '$affair12',

						affair1_pay = '$affair1_pay',
						affair2_pay = '$affair2_pay',
						affair3_pay = '$affair3_pay',
						affair4_pay = '$affair4_pay',
						affair5_pay = '$affair5_pay',
						affair6_pay = '$affair6_pay',
						affair7_pay = '$affair7_pay',
						affair8_pay = '$affair8_pay',
						affair9_pay = '$affair9_pay',
						affair10_pay = '$affair10_pay',
						affair11_pay = '$affair11_pay',
						affair12_pay = '$affair12_pay',

						affair1_etc = '$affair1_etc',
						affair2_etc = '$affair2_etc',
						affair3_etc = '$affair3_etc',
						affair4_etc = '$affair4_etc',
						affair5_etc = '$affair5_etc',
						affair6_etc = '$affair6_etc',
						affair7_etc = '$affair7_etc',
						affair8_etc = '$affair8_etc',
						affair9_etc = '$affair9_etc',
						affair10_etc = '$affair10_etc',
						affair11_etc = '$affair11_etc',
						affair12_etc = '$affair12_etc',

						vacation1 = '$vacation1',
						vacation2 = '$vacation2',
						vacation3 = '$vacation3',
						vacation4 = '$vacation4',
						vacation5 = '$vacation5',
						vacation6 = '$vacation6',
						vacation7 = '$vacation7',
						vacation8 = '$vacation8',
						vacation9 = '$vacation9',
						vacation10 = '$vacation10',
						vacation11 = '$vacation11',
						vacation12 = '$vacation12',

						celebrate_mourn1 = '$celebrate_mourn1',
						celebrate_mourn2 = '$celebrate_mourn2',
						celebrate_mourn3 = '$celebrate_mourn3',
						celebrate_mourn4 = '$celebrate_mourn4',
						celebrate_mourn5 = '$celebrate_mourn5',
						celebrate_mourn6 = '$celebrate_mourn6',

						pay_system = '$pay_system',
						pay_structure = '$pay_structure',
						pay_payment = '$pay_payment',

						pay_calculate_day_period = '$pay_calculate_day_period',

						check_pay_calculate_a = '$check_pay_calculate_a',
						check_pay_calculate_b = '$check_pay_calculate_b',
						pay_calculate_a = '$pay_calculate_a',
						pay_calculate_b = '$pay_calculate_b',

						pay_calculate_day_period1 = '$pay_calculate_day_period1',
						pay_calculate_day_period2 = '$pay_calculate_day_period2',
						pay_calculate_day_period3 = '$pay_calculate_day_period3',
						pay_calculate_day1 = '$pay_calculate_day1',
						pay_calculate_day2 = '$pay_calculate_day2',
						pay_calculate_day3 = '$pay_calculate_day3',

						pay_calculate_day_period1_b = '$pay_calculate_day_period1_b',
						pay_calculate_day_period2_b = '$pay_calculate_day_period2_b',
						pay_calculate_day_period3_b = '$pay_calculate_day_period3_b',
						pay_calculate_day1_b = '$pay_calculate_day1_b',
						pay_calculate_day2_b = '$pay_calculate_day2_b',
						pay_calculate_day3_b = '$pay_calculate_day3_b',

						retirement_age_rule = '$retirement_age_rule',
						retirement_age_rule1 = '$retirement_age_rule1',
						retirement_age_rule2 = '$retirement_age_rule2',
						retirement_gbn = '$retirement_gbn',
						retirement_annuity = '$retirement_annuity',
						bonus = '$bonus',

						document_before1 = '$document_before1',
						document_before2 = '$document_before2',
						document_before3 = '$document_before3',
						document_before4 = '$document_before4',
						document_before5 = '$document_before5',
						document_before6 = '$document_before6',

						document_after1 = '$document_after1',
						document_after2 = '$document_after2',
						document_after3 = '$document_after3',
						document_after4 = '$document_after4',
						document_after5 = '$document_after5',
						document_after6 = '$document_after6',

						conduct_day = '$conduct_day'
";

//수정
$sql2 = " update com_list_gy_opt set 
			$sql_common2 
			where com_code = '$id' ";
sql_query($sql2);
alert("정상적으로 취업규칙 정보가 수정 되었습니다.","com_employment_report.php?id=$id&w=$w");
//echo $sql;
//echo $sql2;
//exit;
//goto_url("./4insure_list.php");
?>