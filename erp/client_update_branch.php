<?
$sub_menu = "100100";
include_once("./_common.php");

//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");
$now_time_file = date("Ymd_His");
$now_date = date("Y.m.d");
// 대표자핸드폰
if($cust_cel1) $cust_cel = $cust_cel1."-".$cust_cel2."-".$cust_cel3;
//전화번호
if($cust_tel1) $cust_tel = $cust_tel1."-".$cust_tel2."-".$cust_tel3;
//팩스번호
if($cust_fax1) $cust_fax = $cust_fax1."-".$cust_fax2."-".$cust_fax3;
//담당자전화
if($damdang_cel1) $damdang_cel = $damdang_cel1."-".$damdang_cel2."-".$damdang_cel3;
//우편번호
if($adr_zip1) $adr_zip = $adr_zip1."-".$adr_zip2;

//회계사 전화번호
if($treasurer_tel1) $treasurer_tel = $treasurer_tel1."-".$treasurer_tel2."-".$treasurer_tel3;
//회계사 팩스번호
if($treasurer_fax1) $treasurer_fax = $treasurer_fax1."-".$treasurer_fax2."-".$treasurer_fax3;

//첨부파일 경로
$upload_dir = 'files/contract/';
$pic_name_sql_1 = "";
$pic_name_sql_2 = "";
$pic_name_sql_3 = "";
$pic_name_sql_4 = "";
$pic_name_sql_5 = "";
$pic_name_sql_6 = "";
$pic_name_sql_7 = "";
$pic_name_sql_8 = "";

//첨부서류 삭제 기능
if($file_del_1 == 1) {
	$filename = $upload_dir.$file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(1)이 존재하지 않습니다.";
	}
}
if($file_del_2 == 1) {
	$filename = $upload_dir.$file_2;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(2)이 존재하지 않습니다.";
	}
}
if($file_del_3 == 1) {
	$filename = $upload_dir.$file_3;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(3)이 존재하지 않습니다.";
	}
}
if($file_del_4 == 1) {
	$filename = $upload_dir.$file_4;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(4)이 존재하지 않습니다.";
	}
}
if($file_del_5 == 1) {
	$filename = $upload_dir.$file_5;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(5)이 존재하지 않습니다.";
	}
}
if($file_del_6 == 1) {
	$filename = $upload_dir.$file_6;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(6)이 존재하지 않습니다.";
	}
}
if($file_del_7 == 1) {
	$filename = $upload_dir.$file_7;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(7)이 존재하지 않습니다.";
	}
}
if($file_del_8 == 1) {
	$filename = $upload_dir.$file_8;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(8)이 존재하지 않습니다.";
	}
}
//첨부서류1
if($_FILES['filename_1']['tmp_name']) {
	$pic_name1 = $_FILES['filename_1']['name'];
	$upload_file_name = $now_time_file."_".$pic_name1;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_1']['tmp_name'], $upload_file);
}
if($pic_name1) {
	$pic_name_sql_1 = " filename_1 = '".addslashes($upload_file_name)."', ";
} else {
	if($file_del_1 == 1) $pic_name_sql_1 = " filename_1 = '', ";
}
//첨부서류2
if($_FILES['filename_2']['tmp_name']) {
	$pic_name2 = $_FILES['filename_2']['name'];
	$upload_file_name = $now_time_file."_".$pic_name2;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_2']['tmp_name'], $upload_file);
}
if($pic_name2) {
	$pic_name_sql_2 = " filename_2 = '".addslashes($upload_file_name)."', ";
} else {
	if($file_del_2 == 1) $pic_name_sql_2 = " filename_2 = '', ";
}
//첨부서류3
if($_FILES['filename_3']['tmp_name']) {
	$pic_name3 = $_FILES['filename_3']['name'];
	$upload_file_name = $now_time_file."_".$pic_name3;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_3']['tmp_name'], $upload_file);
}
if($pic_name3) {
	$pic_name_sql_3 = " filename_3 = '".addslashes($upload_file_name)."', ";
} else {
	if($file_del_3 == 1) $pic_name_sql_3 = " filename_3 = '', ";
}
//첨부서류4
if($_FILES['filename_4']['tmp_name']) {
	$pic_name4 = $_FILES['filename_4']['name'];
	$upload_file_name = $now_time_file."_".$pic_name4;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_4']['tmp_name'], $upload_file);
}
if($pic_name4) {
	$pic_name_sql_4 = " filename_4 = '".addslashes($upload_file_name)."', ";
} else {
	if($file_del_4 == 1) $pic_name_sql_4 = " filename_4 = '', ";
}
//첨부서류5
if($_FILES['filename_5']['tmp_name']) {
	$pic_name5 = $_FILES['filename_5']['name'];
	$upload_file_name = $now_time_file."_".$pic_name5;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_5']['tmp_name'], $upload_file);
}
if($pic_name5) {
	$pic_name_sql_5 = " filename_5 = '".addslashes($upload_file_name)."', ";
} else {
	if($file_del_5 == 1) $pic_name_sql_5 = " filename_5 = '', ";
}
//첨부서류6
if($_FILES['filename_6']['tmp_name']) {
	$pic_name6 = $_FILES['filename_6']['name'];
	$upload_file_name = $now_time_file."_".$pic_name6;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_6']['tmp_name'], $upload_file);
}
if($pic_name6) {
	$pic_name_sql_6 = " filename_6 = '".addslashes($upload_file_name)."', ";
} else {
	if($file_del_6 == 1) $pic_name_sql_6 = " filename_6 = '', ";
}
//첨부서류7
if($_FILES['filename_7']['tmp_name']) {
	$pic_name7 = $_FILES['filename_7']['name'];
	$upload_file_name = $now_time_file."_".$pic_name7;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_7']['tmp_name'], $upload_file);
}
if($pic_name7) {
	$pic_name_sql_7 = " filename_7 = '".addslashes($upload_file_name)."', ";
} else {
	if($file_del_7 == 1) $pic_name_sql_7 = " filename_7 = '', ";
}
//첨부서류8
if($_FILES['filename_8']['tmp_name']) {
	$pic_name8 = $_FILES['filename_8']['name'];
	$upload_file_name = $now_time_file."_".$pic_name8;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_8']['tmp_name'], $upload_file);
}
if($pic_name8) {
	$pic_name_sql_8 = " filename_8 = '".addslashes($upload_file_name)."', ";
} else {
	if($file_del_8 == 1) $pic_name_sql_8 = " filename_8 = '', ";
}

//첨부파일 경로 이지노무
$upload_dir = 'files/easynomu/';
$easynomu_fname_sql_1 = "";
$easynomu_fname_sql_2 = "";

//첨부서류 삭제 기능 이지노무
if($file_easynomu_del_1 == 1) {
	$filename = $upload_dir.$feasynomu_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(1)이 존재하지 않습니다.";
	}
}
if($file_easynomu_del_2 == 1) {
	$filename = $upload_dir.$feasynomu_2;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(2)이 존재하지 않습니다.";
	}
}
//첨부서류1 이지노무
if($_FILES['file_easynomu_1']['tmp_name']) {
	$easynomu_fname1 = $_FILES['file_easynomu_1']['name'];
	$upload_file_name = $now_time_file."_".$easynomu_fname1;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['file_easynomu_1']['tmp_name'], $upload_file);
}
if($easynomu_fname1) {
	$easynomu_fname_sql_1 = " file_easynomu_1 = '".addslashes($upload_file_name)."', ";
} else {
	if($file_easynomu_del_1 == 1) $easynomu_fname_sql_1 = " file_easynomu_1 = '', ";
}
//첨부서류2 이지노무
if($_FILES['file_easynomu_2']['tmp_name']) {
	$easynomu_fname2 = $_FILES['file_easynomu_2']['name'];
	$upload_file_name = $now_time_file."_".$easynomu_fname2;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['file_easynomu_2']['tmp_name'], $upload_file);
}
if($easynomu_fname2) {
	$easynomu_fname_sql_2 = " file_easynomu_2 = '".addslashes($upload_file_name)."', ";
} else {
	if($file_easynomu_del_2 == 1) $easynomu_fname_sql_2 = " file_easynomu_2 = '', ";
}

//직무교육 기본정보
//첨부서류 체크
$job_file_check_cnt = count($job_file_check_array);
for($i=1;$i<=$job_file_check_cnt;$i++) {
	$job_file_check_var .= $_POST['job_file_check'.$i].",";
}
//첨부파일 경로
$upload_dir = 'files/job_file/';
$job_file_sql_1 = "";
$job_file_sql_2 = "";
$job_file_sql_3 = "";
$job_file_sql_4 = "";
$job_file_sql_5 = "";
$job_file_sql_6 = "";
$job_file_sql_7 = "";
$job_file_sql_8 = "";

//첨부서류 삭제 기능
if($job_file_del_1 == 1) {
	$filename = $upload_dir.$p_file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(1)이 존재하지 않습니다.";
	}
}
if($job_file_del_2 == 1) {
	$filename = $upload_dir.$p_file_2;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(2)이 존재하지 않습니다.";
	}
}
if($job_file_del_3 == 1) {
	$filename = $upload_dir.$p_file_3;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(3)이 존재하지 않습니다.";
	}
}
if($job_file_del_4 == 1) {
	$filename = $upload_dir.$p_file_4;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(4)이 존재하지 않습니다.";
	}
}
if($job_file_del_5 == 1) {
	$filename = $upload_dir.$p_file_5;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(5)이 존재하지 않습니다.";
	}
}
if($job_file_del_6 == 1) {
	$filename = $upload_dir.$p_file_6;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(6)이 존재하지 않습니다.";
	}
}
if($job_file_del_7 == 1) {
	$filename = $upload_dir.$p_file_7;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(7)이 존재하지 않습니다.";
	}
}
if($job_file_del_8 == 1) {
	$filename = $upload_dir.$p_file_8;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(8)이 존재하지 않습니다.";
	}
}
//첨부서류1
if($_FILES['job_file_1']['tmp_name']) {
	$job_file_name1 = $_FILES['job_file_1']['name'];
	$upload_file_name = $now_time_file."_".$job_file_name1;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['job_file_1']['tmp_name'], $upload_file);
}
if($job_file_name1) {
	$job_file_sql_1 = " job_file_1 = '".addslashes($upload_file_name)."', ";
} else {
	if($job_file_del_1 == 1) $job_file_sql_1 = " job_file_1 = '', ";
}
//첨부서류2
if($_FILES['job_file_2']['tmp_name']) {
	$job_file_name2 = $_FILES['job_file_2']['name'];
	$upload_file_name = $now_time_file."_".$job_file_name2;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['job_file_2']['tmp_name'], $upload_file);
}
if($job_file_name2) {
	$job_file_sql_2 = " job_file_2 = '".addslashes($upload_file_name)."', ";
} else {
	if($job_file_del_2 == 1) $job_file_sql_2 = " job_file_2 = '', ";
}
//첨부서류3
if($_FILES['job_file_3']['tmp_name']) {
	$job_file_name3 = $_FILES['job_file_3']['name'];
	$upload_file_name = $now_time_file."_".$job_file_name3;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['job_file_3']['tmp_name'], $upload_file);
}
if($job_file_name3) {
	$job_file_sql_3 = " job_file_3 = '".addslashes($upload_file_name)."', ";
} else {
	if($job_file_del_3 == 1) $job_file_sql_3 = " job_file_3 = '', ";
}
//첨부서류4
if($_FILES['job_file_4']['tmp_name']) {
	$job_file_name4 = $_FILES['job_file_4']['name'];
	$upload_file_name = $now_time_file."_".$job_file_name4;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['job_file_4']['tmp_name'], $upload_file);
}
if($job_file_name4) {
	$job_file_sql_4 = " job_file_4 = '".addslashes($upload_file_name)."', ";
} else {
	if($job_file_del_4 == 1) $job_file_sql_4 = " job_file_4 = '', ";
}
//첨부서류5
if($_FILES['job_file_5']['tmp_name']) {
	$job_file_name5 = $_FILES['job_file_5']['name'];
	$upload_file_name = $now_time_file."_".$job_file_name5;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['job_file_5']['tmp_name'], $upload_file);
}
if($job_file_name5) {
	$job_file_sql_5 = " job_file_5 = '".addslashes($upload_file_name)."', ";
} else {
	if($job_file_del_5 == 1) $job_file_sql_5 = " job_file_5 = '', ";
}
//첨부서류6
if($_FILES['job_file_6']['tmp_name']) {
	$job_file_name6 = $_FILES['job_file_6']['name'];
	$upload_file_name = $now_time_file."_".$job_file_name6;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['job_file_6']['tmp_name'], $upload_file);
}
if($job_file_name6) {
	$job_file_sql_6 = " job_file_6 = '".addslashes($upload_file_name)."', ";
} else {
	if($job_file_del_6 == 1) $job_file_sql_6 = " job_file_6 = '', ";
}
//첨부서류7
if($_FILES['job_file_7']['tmp_name']) {
	$job_file_name7 = $_FILES['job_file_7']['name'];
	$upload_file_name = $now_time_file."_".$job_file_name7;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['job_file_7']['tmp_name'], $upload_file);
}
if($job_file_name7) {
	$job_file_sql_7 = " job_file_7 = '".addslashes($upload_file_name)."', ";
} else {
	if($job_file_del_7 == 1) $job_file_sql_7 = " job_file_7 = '', ";
}
//첨부서류8
if($_FILES['job_file_8']['tmp_name']) {
	$job_file_name8 = $_FILES['job_file_8']['name'];
	$upload_file_name = $now_time_file."_".$job_file_name8;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['job_file_8']['tmp_name'], $upload_file);
}
if($job_file_name8) {
	$job_file_sql_8 = " job_file_8 = '".addslashes($upload_file_name)."', ";
} else {
	if($job_file_del_8 == 1) $job_file_sql_8 = " job_file_8 = '', ";
}

//신규 등록시 의뢰서접수일자 자동 등록 
if ($w != 'u') {
	//$editdt = $now_date;
	//$editdt_chk = '1';
	$sql_common_regdt = " regdt = '$now_date', regdt_time = '$now_time', regdt_id = '$member[mb_id]', ";
} else {
	$sql_common_regdt = "";
}

//천단위콤마 제거
$bonus_money = str_replace(',','',$bonus_money);
$setting_pay = str_replace(',','',$setting_pay);
$month_pay = str_replace(',','',$month_pay);

if($member['mb_profile'] <= 100 || $member['mb_profile'] >= 110) {
	//지사, 딜러(제휴점) 권한(협력사 제외)
	$sql_common_branch = "
							,
							$job_file_sql_1
							$job_file_sql_2
							$job_file_sql_3
							$job_file_sql_4
							$job_file_sql_5
							$job_file_sql_6
							$job_file_sql_7
							$job_file_sql_8

							job_request_if = '$job_request_if',
							job_hrd_id = '$job_hrd_id',
							job_hrd_pw = '$job_hrd_pw',
							danger_evaluate_if = '$danger_evaluate_if',
							job_kras_id = '$job_kras_id',
							job_kras_pw = '$job_kras_pw',
							job_file_check = '$job_file_check_var',
							job_memo = '$job_memo',

							job_time_if = '$job_time_if',
							insurance_persons = '$insurance_persons',
							visitdt = '$visitdt',
							visitdt_time = '$visitdt_time',
							job_time_memo = '$job_time_memo',

							electric_charges_no = '$electric_charges_no',
							electric_charges_ssnb = '$electric_charges_ssnb',
							electric_charges_bupin = '$electric_charges_bupin',
							electric_charges_memo = '$electric_charges_memo'
	";
}
//사업장 기본정보
$sql_common = " com_name = '$firm_name',
						damdang_code = '$damdang_code',
						upche_div = '$comp_type',
						biz_no = '$comp_bznb',
						bupin_no = '$bupin_no',

						uptae = '$uptae',
						uptae_code = '$uptae_code',
						upjong_code = '$upjong_code',
						upjong = '$upjong',
						jongmok = '$jongmok',

						t_insureno = '$t_insureno',

						boss_name = '$cust_name',
						jumin_no = '$cust_ssnb',

						boss_hp = '$cust_cel',
						com_tel = '$cust_tel',
						com_fax = '$cust_fax',

						treasurer_name = '$treasurer_name',
						treasurer_tel = '$treasurer_tel',
						treasurer_fax = '$treasurer_fax',
						treasurer_adr_zip1 = '$treasurer_adr_zip1',
						treasurer_adr_zip2 = '$treasurer_adr_zip2',
						treasurer_adr_adr1 = '$treasurer_adr_adr1',
						treasurer_adr_adr2 = '$treasurer_adr_adr2',

						com_damdang = '$damdang_name',

						$sql_common_regdt

						com_postno = '$adr_zip',
						new_postno = '$new_zip',
						com_juso = '$adr_adr1',
						com_juso2 = '$adr_adr2',
						com_mail = '$cust_email'

						$sql_common_branch
";

//변수 지정
if($rules_report_year) $rules_report_date = $rules_report_year.".".$rules_report_month.".".$rules_report_day;
for($i=1;$i<=3;$i++) $women_matriarch_kind .= $_POST['women_matriarch_kind'.$i].",";
for($i=1;$i<=4;$i++) $career_kind .= $_POST['women_matriarch_kind'.$i].",";
for($i=1;$i<=14;$i++) $subsidy_type_if .= $_POST['subsidy_type_if'.$i].",";
for($i=1;$i<=5;$i++) $job_creation_proposal .= $_POST['job_creation_proposal'.$i].",";
for($i=1;$i<=4;$i++) $establish_way .= $_POST['establish_way'.$i].",";
for($i=1;$i<=3;$i++) $establish_type .= $_POST['establish_type'.$i].",";
for($i=1;$i<=5;$i++) $establish_request .= $_POST['establish_request'.$i].",";
for($i=1;$i<=6;$i++) $found_if .= $_POST['found_if'.$i].",";
for($i=1;$i<=2;$i++) $found_tax .= $_POST['found_tax'.$i].",";
for($i=1;$i<=4;$i++) $charge_progress .= $_POST['charge_progress'.$i].",";
for($i=1;$i<=6;$i++) $fund_kind .= $_POST['fund_kind'.$i].",";
for($i=1;$i<=5;$i++) $fund_type_industry .= $_POST['fund_type_industry'.$i].",";
for($i=1;$i<=3;$i++) $easynomu_request .= $_POST['easynomu_request'.$i].",";
//첨부서류 체크
for($i=1;$i<=10;$i++) {
	$file_check_var .= $_POST['file_check'.$i].",";
}
for($i=1;$i<=4;$i++) {
	$file_easynomu_var .= $_POST['file_easynomu'.$i].",";
}
//사업장 추가정보
$sql_common2 = " com_name_opt = '$firm_name',
						jongmok = '$jongmok',
						password = '$user_pass',
						registration_day = '$cntr_sdate',
						cntr_sdate = '$cntr_sdate',
						com_damdang_tel = '$damdang_cel',
						emp5_gbn = '$emp5_gbn',

						manage_cust_numb = '$manage_cust_numb',
						manage_cust_name = '$manage_cust_name',

						p_support = '$p_support',
						p_contribution = '$p_contribution',
						p_construction = '$p_construction',
						p_construction_yn = '$p_construction_yn',
						p_training = '$p_training',

						employment_report = '$employment_report',
						employment_report_date = '$employment_report_date',
						persons = '$persons',
						persons_temp = '$persons_temp',

						emp30_gbn = '$emp30_gbn',
						emp0_gbn = '$emp0_gbn',
						persons_gy = '$persons_gy',
						persons_sj = '$persons_sj',

						boss_mail = '$boss_mail',
						easynomu_yn = '$easynomu_yn',

						aid_kind = '$aid_kind',
						family_work_if = '$family_work_if',
						insurance_holder = '$insurance_holder',
						refund_request = '$refund_request',
						family_refund_wrong = '$family_refund_wrong',
						sj_if = '$sj_if',
						join_request = '$join_request',
						handicapped1 = '$handicapped1',
						handicapped2 = '$handicapped2',
						contributor = '$contributor',

						rules_report_if = '$rules_report_if',
						rules_report_date = '$rules_report_date',
						retirement_age = '$retirement_age',
						extend_age = '$extend_age',
						multitude = '$multitude',
						pay_peak_if = '$pay_peak_if',
						hire_support = '$hire_support',
						refugee = '$refugee',
						support_etc = '$support_etc',

						employment_support = '$employment_support',
						employment_program = '$employment_program',
						women_matriarch_if = '$women_matriarch_if',
						women_matriarch_kind = '$women_matriarch_kind',
						handicapped_employment = '$handicapped_employment',
						rural_areas = '$rural_areas',
						employable = '$employable',
						disaster_if = '$disaster_if',
						disaster_memo = '$disaster_memo',

						career_5year = '$career_5year',
						career_item = '$career_item',
						scholar_doctor = '$scholar_doctor',
						lab_career = '$lab_career',
						career_kind = '$career_kind',
						adoption_6months = '$adoption_6months',
						adoption_env_date = '$adoption_env_date',
						adoption_env_completion = '$adoption_env_completion',
						increase_staff = '$increase_staff',
						pay_required = '$pay_required',
						fund_item = '$fund_item',
						adoption_env_etc = '$adoption_env_etc',
						subsidy_type_if = '$subsidy_type_if',
						shift_system = '$shift_system',
						local_return = '$local_return',
						adoption_6months_new = '$adoption_6months_new',

						employ_execute_yn = '$employ_execute_yn',
						employ_execute_age = '$employ_execute_age',
						employ_execute_sex = '$employ_execute_sex',
						employ_execute_date = '$employ_execute_date',
						employ_execute_person = '$employ_execute_person',
						employ_execute_pay = '$employ_execute_pay',
						employ_execute_time = '$employ_execute_time',
						employ_execute_id = '$employ_execute_id',
						employ_execute_pw = '$employ_execute_pw',
						employ_execute_etc = '$employ_execute_etc',

						worktime_shorten_proposal_yn = '$worktime_shorten_proposal_yn',
						worktime_shorten_proposal = '$worktime_shorten_proposal',
						job_creation_proposal = '$job_creation_proposal',

						establish_proposal_if = '$establish_proposal_if',
						establish_plan_date = '$establish_plan_date',
						establish_area = '$establish_area',
						establish_money = '$establish_money',
						establish_way = '$establish_way',
						establish_type = '$establish_type',
						establish_type_etc = '$establish_type_etc',
						establish_request = '$establish_request',
						found_if = '$found_if',
						found_unreg = '$found_unreg',
						first_type = '$first_type',
						found_consent_if = '$found_consent_if',
						factory_before_type = '$factory_before_type',
						found_tax = '$found_tax',
						found_tax_pay = '$found_tax_pay',
						found_reason = '$found_reason',
						charge_progress = '$charge_progress',
						charge_progress_etc = '$charge_progress_etc',
						charge_progress_reason = '$charge_progress_reason',
						charge_progress_factory_scale = '$charge_progress_factory_scale',
						factory_site_1000 = '$factory_site_1000',

						fund_kind = '$fund_kind',
						fund_kind_locality = '$fund_kind_locality',
						new_fund_scale_site_pay = '$new_fund_scale_site_pay',
						new_fund_scale_site2_pay = '$new_fund_scale_site2_pay',
						new_fund_scale_site3_pay = '$new_fund_scale_site3_pay',
						new_fund_scale_site4_pay = '$new_fund_scale_site4_pay',
						fund_inside_pay = '$fund_inside_pay',
						fund_outside_pay = '$fund_outside_pay',
						mou_conclude = '$mou_conclude',
						fund_type_industry = '$fund_type_industry',
						sort_code_number = '$sort_code_number',
						fund_basic_check1_sales = '$fund_basic_check1_sales',
						fund_basic_check2_level = '$fund_basic_check2_level',
						local_tax_yn = '$local_tax_yn',
						fund_etc = '$fund_etc',
						industrial_disaster_rate = '$industrial_disaster_rate',
						factory_split = '$factory_split',
						office_rate = '$office_rate',
						office_person = '$office_person',
						factory_rate = '$factory_rate',
						factory_person = '$factory_person',
						lab_rate = '$lab_rate',
						lab_person = '$lab_person',
						etc_rate = '$etc_rate',
						etc_person = '$etc_person',
						manufacture_process = '$manufacture_process',

						use_program = '$use_program',
						use_pay = '$use_pay',
						contract_employment = '$contract_employment',
						rules_pay = '$rules_pay',
						easynomu_request = '$easynomu_request',
						setting_pay = '$setting_pay',
						month_pay = '$month_pay',
						easynomu_etc = '$easynomu_etc',

						$pic_name_sql_1
						$pic_name_sql_2
						$pic_name_sql_3
						$pic_name_sql_4
						$pic_name_sql_5
						$pic_name_sql_6
						$pic_name_sql_7
						$pic_name_sql_8

						$easynomu_fname_sql_1
						$easynomu_fname_sql_2

						policy_fund_chk = '$policy_fund_chk',

						memo = '$memo',
						memo1 = '$memo1',
						memo2 = '$memo2',
						memo3 = '$memo3',
						memo4 = '$memo4',
						memo5 = '$memo5',

						file_check = '$file_check_var',
						file_easynomu = '$file_easynomu_var',
						file_etc = '$file_etc'
";
//사업장 추가정보2
$sql_common_opt2 = " com_name_opt2 = '$firm_name',
						job_invent_no = '$job_invent_no',
						kepco_dsm_chk = '$kepco_dsm_chk',
						si4n_nhis_chk = '$si4n_nhis_chk',
						memo_total = '$memo_total'
";
//사업장 기본정보
$sql_base = " select * from com_list_gy where com_code='$id' ";
$result_base = sql_query($sql_base);
$row = mysql_fetch_array($result_base);
//사업장 추가정보
$sql_opt = " select * from com_list_gy_opt where com_code='$id' ";
$result_opt = sql_query($sql_opt);
$row_opt = mysql_fetch_array($result_opt);

//추가 필드 데이터 유무
$sql1 = " select * from com_list_gy_opt where com_code='$id' ";
$result1 = sql_query($sql1);
$total1 = mysql_num_rows($result1);
//추가 필드 데이터 유무2
$sql2 = " select * from com_list_gy_opt2 where com_code='$id' ";
$result2 = sql_query($sql2);
$total2 = mysql_num_rows($result2);
//직문발명보상제도 출원인번호 추출 160926
$result_opt2 = sql_query($sql2);
$row_opt2 = mysql_fetch_array($result_opt2);

if ($w == 'u'){
	//첨부서류 체크
	$result1 = sql_query($sql1);
	$row1 =   mysql_fetch_array($result1);
	$file_check = explode(',',$row1['file_check']);
	//echo $sql1;
	//echo $row1['file_check'];
	$file_easynomu = explode(',',$row1['file_easynomu']);
} else {
	$file_check = array("","","","","","","","","","","","","","","");
	$file_easynomu = array("","","","","","","","","","","","","","","");
}

//등록자
$mb_id = $member['mb_id'];
$mb_name = $member['mb_name'];
$mb_profile_code = $member['mb_profile'];
$mb_profile = $man_cust_name_arry[$mb_profile_code];
$branch = $man_cust_name_arry[$damdang_code];
//담당매니저 코드 체크
$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
$row_manage = sql_fetch($sql_manage);
$manage_code = $row_manage['code'];

//수정
if($w == 'u') {
	$sql = " update $g4[com_list_gy] set 
				$sql_common 
			  where com_code = '$id' ";
	//echo $sql;
	//exit;
	sql_query($sql);
	if($total1) {
		$sql2 = " update com_list_gy_opt set 
					$sql_common2 
					where com_code = '$id' ";
	} else {
		$sql2 = " insert com_list_gy_opt set 
					$sql_common2 
					, com_code = '$id' ";
	}
	sql_query($sql2);
	if($total2) {
		$sql_opt2 = " update com_list_gy_opt2 set 
					$sql_common_opt2 
					where com_code = '$id' ";
	} else {
		$sql_opt2 = " insert com_list_gy_opt2 set 
					$sql_common_opt2 
					, com_code = '$id' ";
	}
	sql_query($sql_opt2);
//등록
} else {
	$sql_max = "select max(com_code) from $g4[com_list_gy] ";
	$result_max = sql_query($sql_max);
	$row_max = mysql_fetch_array($result_max);
	$id = $row_max[0]+1;

	$sql = " insert $g4[com_list_gy] set 
					$sql_common 
					, com_code = '$id' ";
	sql_query($sql);
	$sql2 = " insert com_list_gy_opt set 
				$sql_common2 
				, com_code = '$id' ";
	sql_query($sql2);
	$sql_opt2 = " insert com_list_gy_opt2 set 
				$sql_common_opt2 
				, com_code = '$id' ";
	sql_query($sql_opt2);

	//신규등록 알림
	$wr_subject = $now_date." 신규등록 되었습니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '10001', alert_name = '신규등록'
	";
	sql_query($sql_alert);
}

//정책자금 변수 설정
$regdt = $now_date;
$com_name = $firm_name;
$boss_name = $cust_name;
$jumin_no = $cust_ssnb;
$com_hp = $cust_cel;
$com_tel = $cust_tel;
$com_fax = $cust_fax;
$com_mail = $cust_email;
//지사 구분 최초통화자
if($damdang_code == "20") {
	//부산2
	$writer = "2001";
	$writer_tel = "051-921-5255";
} else if($damdang_code == "35") {
	//양산
	$writer = "3501";
	$writer_tel = "055-388-8805";
} else if($damdang_code == "36") {
	//전북1
	$writer = "3601";
	$writer_tel = "063-461-4747";
} else if($damdang_code == "10") {
	//대구2
	$writer = "1001";
	$writer_tel = "053-292-4117";
} else if($damdang_code == "8") {
	//광주
	$writer = "25";
	$writer_tel = "070-7405-2661";
} else if($damdang_code == "16") {
	//경산
	$writer = "31";
	$writer_tel = "053-636-1894";
} else if($damdang_code == "23") {
	//창원
	$writer = "2301";
	$writer_tel = "055-245-0337";
}
//부산2지사 황희경 팀장
if($mb_id == "ps20002") {
	$writer = "2002";
	$writer_tel = "051-921-5255";
} else if($mb_id == "kcmc1004") {
	//정경용
	$writer = "110";
	$writer_tel = "070-4680-7041";
} else if($mb_id == "kcmc0331") {
	//임영진
	$writer = "122";
	$writer_tel = "070-7405-2661";
}

//정책자금DB sql_common
$sql_common_policy = " regdt = '$regdt',
						com_name = '$com_name',
						upche_div = '$comp_type',
						upjong = '$uptae',
						damdang_code = '$damdang_code',

						jumin_no = '$jumin_no',
						reg_factory = '$reg_factory',
						com_postno = '$adr_zip',
						com_juso = '$adr_adr1',
						com_juso2 = '$adr_adr2',
						boss_name = '$boss_name',
						com_tel = '$com_tel',
						com_fax = '$com_fax',
						com_hp = '$com_hp',
						com_mail = '$com_mail',
						area = '$area',

						credit_com = '$credit_com',
						credit_per = '$credit_per',
						property = '$property',
						charter = '$charter',
						rent_month = '$rent_month',
						area_site = '$area_site',
						area_building = '$area_building',
						area_facility = '$area_facility',
						teldt = '$teldt',

						ok_loan_facility = '$ok_loan_facility',
						ok_loan_policy = '$ok_loan_policy',
						ok_loan_fee = '$ok_loan_fee',

						sale_2012 = '$sale_2012',
						sale_2013 = '$sale_2013',
						sale_2014 = '$sale_2014',

						memo = '$memo_policy',
						loan_policy = '$loan_policy',
						loan_finance = '$loan_finance',
						loan_etc = '$loan_etc'
";
//정책자금DB 추가정보
$sql_common_policy_opt = "
						bank_1 = '$bank_1', 
						bank_2 = '$bank_2',
						bank_3 = '$bank_3',
						bank_4 = '$bank_4',
						bank_5 = '$bank_5',
						bank_6 = '$bank_6',
						bank_7 = '$bank_7',
						amount_1 = '$amount_1',
						amount_2 = '$amount_2',
						amount_3 = '$amount_3',
						amount_4 = '$amount_4',
						amount_5 = '$amount_5',
						amount_6 = '$amount_6',
						amount_7 = '$amount_7',
						interst_1 = '$interst_1',
						interst_2 = '$interst_2',
						interst_3 = '$interst_3',
						interst_4 = '$interst_4',
						interst_5 = '$interst_5',
						interst_6 = '$interst_6',
						interst_7 = '$interst_7',
						lend_bank_1 = '$lend_bank_1',
						lend_bank_2 = '$lend_bank_2',
						lend_bank_3 = '$lend_bank_3',
						lend_bank_4 = '$lend_bank_4',
						lend_kind_1 = '$lend_kind_1',
						lend_kind_2 = '$lend_kind_2',
						lend_kind_3 = '$lend_kind_3',
						lend_kind_4 = '$lend_kind_4',
						lend_amount_1 = '$lend_amount_1',
						lend_amount_2 = '$lend_amount_2',
						lend_amount_3 = '$lend_amount_3',
						lend_amount_4 = '$lend_amount_4',
						lend_interst_1 = '$lend_interst_1',
						lend_interst_2 = '$lend_interst_2',
						lend_interst_3 = '$lend_interst_3',
						lend_interst_4 = '$lend_interst_4',

						security = '$security',
						primary_bank = '$primary_bank'
";

//정책자금 의뢰
if($policy_fund_chk) {
	$sql_policy = " select * from policy_fund where com_code='$id' ";
	$result_policy = sql_query($sql_policy);
	$total_policy = mysql_num_rows($result_policy);
	$sql_policy_opt = " select * from policy_fund_opt where com_code='$id' ";
	$result_policy_opt = sql_query($sql_policy_opt);
	$total_policy_opt = mysql_num_rows($result_policy_opt);
	if($total_policy) {
		$sql_policy = " update policy_fund set $sql_common_policy where com_code = '$id' ";
	} else {
		$sql_policy = " insert policy_fund set $sql_common_policy , com_code = '$id', writer = '$writer', writer_tel = '$writer_tel' ";
	}
	if($total_policy_opt) {
		$sql_policy_opt = " update policy_fund_opt set $sql_common_policy_opt where com_code = '$id' ";
	} else {
		$sql_policy_opt = " insert policy_fund_opt set $sql_common_policy_opt , id = '$mid', com_code = '$id', editdt = '$now_time' ";
	}
	sql_query($sql_policy);
	$mid = mysql_insert_id();
	sql_query($sql_policy_opt);
}
//echo $sql_policy_opt;
//exit;

//직무교육 의뢰 시 저장
if($job_request_if) {
	//직무교육DB
	$sql_common_job = " 
						m_date = '$now_time',
						w_user = '$mb_id',
						com_code = '$id',
						com_name_job = '$firm_name'
	";
	//직무교육DB 데이터 유무
	$sql_job_chk = " select * from job_education where com_code='$id' ";
	$result_job_chk = sql_query($sql_job_chk);
	$total_job_chk = mysql_num_rows($result_job_chk);
	$result_job_mid = sql_query($sql_job_chk);
	$row_job_mid = mysql_fetch_array($result_job_mid);
	$mid = $row_job_mid['idx'];
	$sql_job_chk_opt = " select * from job_education_opt where mid='$mid' ";
	//echo $sql_job_chk_opt;
	//exit;
	$result_job_chk_opt = sql_query($sql_job_chk_opt);
	$total_job_chk_opt = mysql_num_rows($result_job_chk_opt);
	if($total_job_chk) {
		$sql_job = " update job_education set $sql_common_job where com_code = '$id' ";
	} else {
		$sql_job = " insert job_education set $sql_common_job , w_date = '$now_date' ";
	}
	sql_query($sql_job);
	if(!$total_job_chk_opt) {
		$sql_job_opt = " insert job_education_opt set mid='$mid' ";
		sql_query($sql_job_opt);
	}
}

//시간선택제 의뢰 시 저장
if($job_time_if) {
	//시간선택제DB
	$sql_common_job_time = " 
						com_code = '$id',
						damdang_code = '$damdang_code',
						damdang_code2 = '$damdang_code2',
						com_name = '$firm_name',
						upche_div = '$comp_type',
						upjong = '$uptae',

						comp_bznb = '$comp_bznb',
						com_postno = '$adr_zip',
						com_juso = '$adr_adr1',
						com_juso2 = '$adr_adr2',
						boss_name = '$boss_name',
						com_tel = '$cust_tel',
						com_fax = '$cust_fax',
						com_hp = '$cust_cel',

						insurance_persons = '$insurance_persons',
						visitdt = '$visitdt',
						visitdt_time = '$visitdt_time',
						memo = '$job_time_memo',
						writer = '$manage_cust_numb',
						writer_name = '$manage_cust_name'
	";
	$sql_common_job_time2 = " 
						editdt = '$now_time'
	";
	//시간선택제DB 데이터 유무
	$sql_job_time_chk = " select * from job_time where com_code='$id' ";
	$result_job_time_chk = sql_query($sql_job_time_chk);
	$total_job_time_chk = mysql_num_rows($result_job_time_chk);
	if($total_job_time_chk) {
		$sql_job_time = " update job_time set $sql_common_job_time where com_code = '$id' ";
	} else {
		$sql_job_time = " insert job_time set $sql_common_job_time , regdt = '$now_date' ";
	}
	sql_query($sql_job_time);
	//시간선택제 DB ID 추출
	$result_job_time_chk = sql_query($sql_job_time_chk);
	$row_job_time_chk = mysql_fetch_array($result_job_time_chk);
	$job_time_id = $row_job_time_chk['id'];
	//추가 필드 데이터 유무
	$sql_job_time_opt = " select * from job_time_opt where id='$job_time_id' ";
	$result_job_time_opt = sql_query($sql_job_time_opt);
	$total_job_time_opt = mysql_num_rows($result_job_time_opt);
	if($total_job_time_opt) {
		$sq_job_time_opt = " update job_time_opt set $sql_common_job_time2 where id = '$job_time_id' ";
	} else {
		$sq_job_time_opt = " insert job_time_opt set $sql_common_job_time2 , id = '$job_time_id' ";
	}
	sql_query($sq_job_time_opt);
}

//컨설팅의뢰서
if($file_check[0] != $file_check1) {
	$wr_subject = $now_date." 첨부서류(컨설팅의뢰서) 등록 되었습니다.";
	$send_to = "manager";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
			send_to = '$send_to',
			user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '10002', alert_name = '의뢰서접수'
	";
	sql_query($sql_alert);
	//의뢰서 도착, 접수일 저장 160405
	$sql = " update com_list_gy set editdt = '$now_date' where com_code = '$id' ";
	sql_query($sql);
	$sql2 = " update com_list_gy_opt set editdt_chk = '1' where com_code = '$id' ";
	sql_query($sql2);
}
//계약서 : 전정애 주임 설정 150923
if($file_check[1] != $file_check2) {
	$wr_subject = $now_date." 첨부서류(계약서) 등록 되었습니다.";
	$send_to = "kcmc1008";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
			send_to = '$send_to',
			user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '10003', alert_name = '계약서접수'
	";
	sql_query($sql_alert);
}
//사무위탁서
if($file_check[2] != $file_check3) {
	$wr_subject = $now_date." 첨부서류(사무위탁서) 등록 되었습니다.";
	$send_to = "kcmc1007";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
			send_to = '$send_to',
			user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '15000', alert_name = '위탁서접수'
	";
	sql_query($sql_alert);
}
//대리인선임(공단)
if($file_check[3] != $file_check4) {
	$wr_subject = $now_date." 첨부서류(대리인선임(공단)) 등록 되었습니다.";
	$send_to = "kcmc1008";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
			send_to = '$send_to',
			user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '20001', alert_name = '대리인선임(공단)'
	";
	sql_query($sql_alert);
}
//전자민원(센터)
if($file_check[3] != $file_check4) {
	$wr_subject = $now_date." 첨부서류(전자민원(센터)) 등록 되었습니다.";
	$send_to = "kcmc1008";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
			send_to = '$send_to',
			user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '20002', alert_name = '대리인선임(공단)'
	";
	sql_query($sql_alert);
}
//이지노무
if($file_easynomu[0] != $file_easynomu1) {
	$wr_subject = $now_date." 첨부서류(이지노무) 등록 되었습니다.";
	$send_to = "kcmc1009";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
			send_to = '$send_to',
			user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '50001', alert_name = '이지노무'
	";
	sql_query($sql_alert);
}
//건설 거래처 등록 알림
$strpos_text = "건설";
if(strpos($row['uptae'], $strpos_text) === false && strpos($uptae, $strpos_text) !== false) {
	$wr_subject = $now_date." 건설 거래처가 등록 되었습니다.";
	$send_to = "manager";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
			send_to = '$send_to',
			user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '10004', alert_name = '건설업체'
	";
	sql_query($sql_alert);
}
//가족보험환급 알림
if( ($row_opt['family_work_if'] != "1" && $family_work_if == "1" ) || ($row_opt['refund_request'] != "1" && $refund_request == "1") ) {
	$wr_subject = $now_date." 가족보험환급신청 의뢰가 있습니다.";
	$send_to = "manager";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
			send_to = '$send_to',
			user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '10005', alert_name = '가족보험'
	";
	sql_query($sql_alert);
	//가족보험료환급 등록일 업데이트 160127
	$sql_family = " update com_list_gy_opt set family_date='$now_date' where com_code='$id' ";
	sql_query($sql_family);
}
//이지노무 의뢰 알림
if(strpos($row_opt['easynomu_request'], "1") === false && strpos($easynomu_request, "1") !== false) {
	$wr_subject = $now_date." 이지노무 의뢰가 있습니다.";
	$send_to = "manager";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
			send_to = '$send_to',
			user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '50001', alert_name = '이지노무'
	";
	sql_query($sql_alert);
}
//시간선택제 알림
if($row['job_time_if'] != "1" && $job_time_if == "1") {
	//방문일자 미등록 시
	if(!$visitdt) $visitdt = "방문일자";	
	if(!$visitdt_time) $visitdt_time = "미정";
	//시간선택제 신규 등록 알림
	$wr_subject = $visitdt."(".$visitdt_time.") 시간선택제 방문예정입니다.";
	$send_to = "manager";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			send_to = '$send_to',
			com_code = '$com_code' , wr_1 = '$job_time_id', com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '40003', alert_name = '시간선택제'
	";
	sql_query($sql_alert);
}
//전기요금절감 알림
if($row['electric_charges_no'] == "" && $electric_charges_no != "") {
/*
	//등록 거래처 증가로 알림 제거 160411
	//전기요금절감 신규 등록 알림
	$wr_subject = $now_date." 전기요금컨설팅 접수 되었습니다.";
	//대표님 아이디
	$send_to = "kcmc1001";
	//전기요금절감 컨설팅 ID
	$electric_charges_id = "";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			send_to = '$send_to',
			com_code = '$id' , wr_1 = '$electric_charges_id', com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '10006', alert_name = '전기요금컨설팅'
	";
	sql_query($sql_alert);
*/
	//전기요금컨설팅 접수 일시 사업장 기본 정보 DB에 저장
	$sql_electric_charges_regdt = " update com_list_gy set electric_charges_regdt = '$now_time' where com_code = '$id' ";
	sql_query($sql_electric_charges_regdt);
}
//직무발명보상제도 출원인번호 입력 시 등록일 등록 160926
if($row_opt2['job_invent_no'] == "" && $job_invent_no != "") {
	$sq_opt2 = " update com_list_gy_opt2 set job_invent_regdt = '$now_time' where com_code = '$id' ";
	sql_query($sq_opt2);
}
//전력수요관리 의뢰 시 등록일 등록 160927
if($row_opt2['kepco_dsm_chk'] == "" && $kepco_dsm_chk != "") {
	$sq_opt2 = " update com_list_gy_opt2 set kepco_dsm_regdt = '$now_time' where com_code = '$id' ";
	sql_query($sq_opt2);
}
//4대보험절감 컨설팅 의뢰 161011
if($row_opt2['si4n_nhis_chk'] == "" && $si4n_nhis_chk != "") {
	$sq_opt2 = " update com_list_gy_opt2 set si4n_nhis_regdt = '$now_time' where com_code = '$id' ";
	sql_query($sq_opt2);
}
if($w == 'u') {
	alert("정상적으로 거래처가 수정 되었습니다.","client_view.php?id=$id&w=$w&page=$page");
}else{
	alert("정상적으로 거래처가 등록 되었습니다.","main.php");
}
?>