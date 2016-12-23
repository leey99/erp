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
$upload_dir = 'files/convey_file/';
$convey_file_sql_1 = "";
$convey_file_sql_2 = "";
$convey_file_sql_3 = "";
$convey_file_sql_4 = "";
$convey_file_sql_5 = "";
$convey_file_sql_6 = "";

//첨부서류 삭제 기능
if($convey_file_del_1 == 1) {
	$filename = $upload_dir.$c_file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(1)이 존재하지 않습니다.";
	}
}
if($convey_file_del_2 == 1) {
	$filename = $upload_dir.$c_file_2;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(2)이 존재하지 않습니다.";
	}
}
if($convey_file_del_3 == 1) {
	$filename = $upload_dir.$c_file_3;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(3)이 존재하지 않습니다.";
	}
}
if($convey_file_del_4 == 1) {
	$filename = $upload_dir.$c_file_4;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(4)이 존재하지 않습니다.";
	}
}
if($convey_file_del_5 == 1) {
	$filename = $upload_dir.$c_file_5;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(5)이 존재하지 않습니다.";
	}
}
if($convey_file_del_6 == 1) {
	$filename = $upload_dir.$c_file_6;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(6)이 존재하지 않습니다.";
	}
}

//첨부서류1
if($_FILES['convey_file_1']['tmp_name']) {
	$pic_name1 = $_FILES['convey_file_1']['name'];
	$upload_file_name = $now_time_file."_".$pic_name1;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['convey_file_1']['tmp_name'], $upload_file);
}
if($pic_name1) {
	$convey_file_sql_1 = " convey_file_1 = '$upload_file_name', ";
} else {
	if($convey_file_del_1 == 1) $convey_file_sql_1 = " convey_file_1 = '', ";
}
//첨부서류2
if($_FILES['convey_file_2']['tmp_name']) {
	$pic_name2 = $_FILES['convey_file_2']['name'];
	$upload_file_name = $now_time_file."_".$pic_name2;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['convey_file_2']['tmp_name'], $upload_file);
}
if($pic_name2) {
	$convey_file_sql_2 = " convey_file_2 = '$upload_file_name', ";
} else {
	if($convey_file_del_2 == 1) $convey_file_sql_2 = " convey_file_2 = '', ";
}
//첨부서류3
if($_FILES['convey_file_3']['tmp_name']) {
	$pic_name3 = $_FILES['convey_file_3']['name'];
	$upload_file_name = $now_time_file."_".$pic_name3;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['convey_file_3']['tmp_name'], $upload_file);
}
if($pic_name3) {
	$convey_file_sql_3 = " convey_file_3 = '$upload_file_name', ";
} else {
	if($convey_file_del_3 == 1) $convey_file_sql_3 = " convey_file_3 = '', ";
}
//첨부서류4
if($_FILES['convey_file_4']['tmp_name']) {
	$pic_name4 = $_FILES['convey_file_4']['name'];
	$upload_file_name = $now_time_file."_".$pic_name4;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['convey_file_4']['tmp_name'], $upload_file);
}
if($pic_name4) {
	$convey_file_sql_4 = " convey_file_4 = '$upload_file_name', ";
} else {
	if($convey_file_del_4 == 1) $convey_file_sql_4 = " convey_file_4 = '', ";
}
//첨부서류5
if($_FILES['convey_file_5']['tmp_name']) {
	$pic_name5 = $_FILES['convey_file_5']['name'];
	$upload_file_name = $now_time_file."_".$pic_name5;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['convey_file_5']['tmp_name'], $upload_file);
}
if($pic_name5) {
	$convey_file_sql_5 = " convey_file_5 = '$upload_file_name', ";
} else {
	if($convey_file_del_5 == 1) $convey_file_sql_5 = " convey_file_5 = '', ";
}
//첨부서류6
if($_FILES['convey_file_6']['tmp_name']) {
	$pic_name6 = $_FILES['convey_file_6']['name'];
	$upload_file_name = $now_time_file."_".$pic_name6;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['convey_file_6']['tmp_name'], $upload_file);
}
if($pic_name6) {
	$convey_file_sql_6 = " convey_file_6 = '$upload_file_name', ";
} else {
	if($convey_file_del_6 == 1) $convey_file_sql_6 = " convey_file_6 = '', ";
}

//사업자도장
$upload_dir = 'files/seal/';
if($_FILES['filename']['tmp_name']) {
	$pic_name = $id.".jpg";
	$upload_file = $upload_dir . $pic_name;
	//echo $upload_file;
	//echo $_FILES['filename']['tmp_name'];
	//exit;
	if ( move_uploaded_file($_FILES['filename']['tmp_name'], $upload_file) ) {
		//echo "SUCCESS";
	} else {
		alert("정상적으로 파일 업로드가 되지 않았습니다.\n파일을 확인하신 후 다시 업로드하여 주십시오.","client_process_view.php?id=$id&code=$code&page=$page");
	}
} else {
	if(!is_file($upload_file)) $pic_name = "";
}
//사진 업로드 안할 때 설정값
if($pic_name) {
	$pic_name_sql = " pic = '$pic_name', ";
} else {
	$pic_name_sql = "";
}

//직무교육 기본정보
//첨부서류 체크
for($i=1;$i<=5;$i++) {
	$job_file_check_var .= $_POST['job_file_check'.$i].",";
}
//첨부파일 경로
$upload_dir = 'files/job_file/';
$job_file_sql_1 = "";
$job_file_sql_2 = "";
//첨부서류 삭제 기능
if($job_file_del_1 == 1) {
	$filename = $upload_dir.$c_file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(1)이 존재하지 않습니다.";
	}
}
if($job_file_del_2 == 1) {
	$filename = $upload_dir.$c_file_2;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(2)이 존재하지 않습니다.";
	}
}
if($job_file_del_3 == 1) {
	$filename = $upload_dir.$c_file_3;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(3)이 존재하지 않습니다.";
	}
}
if($job_file_del_4 == 1) {
	$filename = $upload_dir.$c_file_4;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(4)이 존재하지 않습니다.";
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
	$job_file_sql_1 = " job_file_1 = '$upload_file_name', ";
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
	$job_file_sql_2 = " job_file_2 = '$upload_file_name', ";
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
	$job_file_sql_3 = " job_file_3 = '$upload_file_name', ";
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
	$job_file_sql_4 = " job_file_4 = '$upload_file_name', ";
} else {
	if($job_file_del_4 == 1) $job_file_sql_4 = " job_file_4 = '', ";
}

$sql_common = " com_name = '$firm_name',
						damdang_code = '$damdang_code',
						damdang_code2 = '$damdang_code2',
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

						editdt = '$editdt',

						com_postno = '$adr_zip',
						new_postno = '$new_zip',
						com_juso = '$adr_adr1',
						com_juso2 = '$adr_adr2',
						com_mail = '$cust_email',

						$job_file_sql_1
						$job_file_sql_2
						$job_file_sql_3
						$job_file_sql_4

						job_manager_name = '$job_manager_name',
						job_manager_hp = '$job_manager_hp',
						job_manager_mail = '$job_manager_mail',
						job_work_time = '$job_work_time',
						job_shift_system = '$job_shift_system',
						job_main_produce = '$job_main_produce',
						job_produce_method = '$job_produce_method',
						job_hrd_id = '$job_hrd_id',
						job_hrd_pw = '$job_hrd_pw',
						job_education_industrial_safety = '$job_education_industrial_safety',
						job_education_health = '$job_education_health',
						job_file_check = '$job_file_check_var'
";

//천단위콤마 제거
$setting_pay = str_replace(',','',$setting_pay);
$month_pay = str_replace(',','',$month_pay);
$application_fee_sum = str_replace(',','',$application_fee_sum);
$application_fee_sum2 = str_replace(',','',$application_fee_sum2);
$application_fee_sum3 = str_replace(',','',$application_fee_sum3);
$application_fee_sum4 = str_replace(',','',$application_fee_sum4);
$application_fee_sum5 = str_replace(',','',$application_fee_sum5);

//고용창출 고용구분
$employment_kind = $employment_kind1.",".$employment_kind2.",".$employment_kind3.",".$employment_kind4;

//신청년도
$application_quarter_year = $application_quarter_year_1.",".$application_quarter_year_2.",".$application_quarter_year_3;
$application_quarter_year2 = $application_quarter_year2_1.",".$application_quarter_year2_2.",".$application_quarter_year2_3;
$application_quarter_year3 = $application_quarter_year3_1.",".$application_quarter_year3_2.",".$application_quarter_year3_3;
$application_quarter_year4 = $application_quarter_year4_1.",".$application_quarter_year4_2.",".$application_quarter_year4_3;
$application_quarter_year5 = $application_quarter_year5_1.",".$application_quarter_year5_2.",".$application_quarter_year5_3;
//선청기간/분기 선택
$application_date_chk = $application_date_chk1.",".$application_date_chk2.",".$application_date_chk3.",".$application_date_chk4.",".$application_date_chk5;
//선청분기
$application_quarter = $application_quarter_1_1.",".$application_quarter_1_2.",".$application_quarter_1_3.",".$application_quarter_1_4."_".$application_quarter_2_1.",".$application_quarter_2_2.",".$application_quarter_2_3.",".$application_quarter_2_4."_".$application_quarter_3_1.",".$application_quarter_3_2.",".$application_quarter_3_3.",".$application_quarter_3_4;
$application_quarter2 = $application_quarter2_1_1.",".$application_quarter2_1_2.",".$application_quarter2_1_3.",".$application_quarter2_1_4."_".$application_quarter2_2_1.",".$application_quarter2_2_2.",".$application_quarter2_2_3.",".$application_quarter2_2_4."_".$application_quarter2_3_1.",".$application_quarter2_3_2.",".$application_quarter2_3_3.",".$application_quarter2_3_4;
$application_quarter3 = $application_quarter3_1_1.",".$application_quarter3_1_2.",".$application_quarter3_1_3.",".$application_quarter3_1_4."_".$application_quarter3_2_1.",".$application_quarter3_2_2.",".$application_quarter3_2_3.",".$application_quarter3_2_4."_".$application_quarter3_3_1.",".$application_quarter3_3_2.",".$application_quarter3_3_3.",".$application_quarter3_3_4;
$application_quarter4 = $application_quarter4_1_1.",".$application_quarter4_1_2.",".$application_quarter4_1_3.",".$application_quarter4_1_4."_".$application_quarter4_2_1.",".$application_quarter4_2_2.",".$application_quarter4_2_3.",".$application_quarter4_2_4."_".$application_quarter4_3_1.",".$application_quarter4_3_2.",".$application_quarter4_3_3.",".$application_quarter4_3_4;
$application_quarter5 = $application_quarter5_1_1.",".$application_quarter5_1_2.",".$application_quarter5_1_3.",".$application_quarter5_1_4."_".$application_quarter5_2_1.",".$application_quarter5_2_2.",".$application_quarter5_2_3.",".$application_quarter5_2_4."_".$application_quarter5_3_1.",".$application_quarter5_3_2.",".$application_quarter5_3_3.",".$application_quarter5_3_4;
//신청금액
$application_fee = $application_fee_1."_".$application_fee_2."_".$application_fee_3;
$application_fee2 = $application_fee2_1."_".$application_fee2_2."_".$application_fee2_3;
$application_fee3 = $application_fee3_1."_".$application_fee3_2."_".$application_fee3_3;
$application_fee4 = $application_fee4_1."_".$application_fee4_2."_".$application_fee4_3;
$application_fee5 = $application_fee5_1."_".$application_fee5_2."_".$application_fee5_3;
//재신청일자 완료
//$reapplication_done = $reapplication_done1.",".$reapplication_done2.",".$reapplication_done3.",".$reapplication_done4.",".$reapplication_done5;

//계약서 번호 자동 증가 (신규 도착일자 존재, 이전 도착일자 없을 경우) 141218 (합)쏠에비뉴 석주임 요청 자동입력 해제
/*
if($chk_contract_date && $chk_contract_date_old == "") {
	$sql_contract_auto = " select max(chk_contract_no) as max_no from com_list_gy_opt ";
	$result_contract_auto = sql_query($sql_contract_auto);
	$row_contract_auto = mysql_fetch_array($result_contract_auto);
	$chk_contract_no_auto = $row_contract_auto['max_no']+1;
} else {
	$chk_contract_no_auto = $chk_contract_no;
}
*/
$chk_contract_no_auto = $chk_contract_no;
//위탁번호 자동 생성
if($samu_req_date && !$samu_receive_no) {
	$sql_samu_receive_no = " select max(samu_receive_no) max_samu_receive_no from com_list_gy_opt ";
	$row_samu_receive_no = sql_fetch($sql_samu_receive_no);
	$max_samu_receive_no = $row_samu_receive_no['max_samu_receive_no'];
	$max_samu_receive_no = (int)$max_samu_receive_no;
	$samu_receive_no = $max_samu_receive_no + 1;
}
//사업장 추가정보 (관리자 전용)
$sql_common2_master = "
						manage_cust_numb = '$manage_cust_numb',
						manage_cust_name = '$manage_cust_name',
						settlement_day = '$settlement_day',
						settlement_day_last = '$settlement_day_last',
						chk_contract_date = '$chk_contract_date',
						chk_contract_no = '$chk_contract_no_auto',
						samu_req_yn = '$samu_req_yn',
						samu_req_date = '$samu_req_date',
						samu_receive_date = '$samu_receive_date',
						samu_receive_no = '$samu_receive_no',
						samu_close_date = '$samu_close_date',

						editdt_chk = '$editdt_chk',
						chk_contract = '$chk_contract',
						samu_receive_chk = '$samu_receive_chk',
						agent_elect_public_chk = '$agent_elect_public_chk',
						agent_elect_center_chk = '$agent_elect_center_chk',

						agent_elect_public_date = '$agent_elect_public_date',
						agent_elect_center_date = '$agent_elect_center_date',
						agent_elect_public_edate = '$agent_elect_public_edate',
						agent_elect_center_edate = '$agent_elect_center_edate',
						agent_elect_public_cdate = '$agent_elect_public_cdate',
						agent_elect_center_cdate = '$agent_elect_center_cdate',
						agent_elect_public_yn = '$agent_elect_public_yn',
						agent_elect_public_charge = '$agent_elect_public_charge',
						agent_elect_center_yn = '$agent_elect_center_yn',
						agent_elect_public_memo = '$agent_elect_public_memo',
						agent_elect_center_memo = '$agent_elect_center_memo',

						support_history_memo = '$support_history_memo',

						service_day_start = '$service_day_start',
						service_day_end = '$service_day_end',
						setting_pay = '$setting_pay',
						month_pay = '$month_pay',
						proxy = '$proxy',
";
$sql_common2 = " jongmok = '$jongmok',
						password = '$user_pass',
						registration_day = '$cntr_sdate',
						cntr_sdate = '$cntr_sdate',
						com_damdang_tel = '$damdang_cel',
						emp5_gbn = '$emp5_gbn',
						workday_month = '$workday_month',

						$sql_common2_master

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
						$pic_name_sql
						memo = '$memo',
						easynomu_yn = '$easynomu_yn',
						construction_yn = '$construction_yn'
";
//reapplication_done = '$reapplication_done', //최종완료 제거 전정애 대리 의견 161028
$sql_common_opt2 = " easynomu_process = '$easynomu_process',
						easynomu_finish_date = '$easynomu_finish_date',
						easynomu_close_date = '$easynomu_close_date',
						easynomu_memo = '$easynomu_memo',

						review_process = '$review_process',
						review_finish_date = '$review_finish_date',
						first_review_item = '$first_review_item',

						support_kind = '$support_kind',
						support_kind2 = '$support_kind2',
						support_kind3 = '$support_kind3',
						support_kind4 = '$support_kind4',
						support_kind5 = '$support_kind5',
						support_memo = '$support_memo',
						support_memo2 = '$support_memo2',
						support_memo3 = '$support_memo3',
						support_memo4 = '$support_memo4',
						support_memo5 = '$support_memo5',

						re_call_date = '$re_call_date',
						re_call_memo = '$re_call_memo',

						support_document = '$support_document',
						support_document2 = '$support_document2',
						support_document3 = '$support_document3',
						support_document4 = '$support_document4',
						support_document5 = '$support_document5',
						support_document_lack = '$support_document_lack',
						support_document_lack2 = '$support_document_lack2',
						support_document_lack3 = '$support_document_lack3',
						support_document_lack4 = '$support_document_lack4',
						support_document_lack5 = '$support_document_lack5',

						employment_kind = '$employment_kind',
						time_choice_work_date = '$time_choice_work_date',
						youth_intern_date = '$youth_intern_date',
						middle_age_intern_date = '$middle_age_intern_date',
						professional_date = '$professional_date',

						application_kind = '$application_kind',
						application_kind2 = '$application_kind2',
						application_kind3 = '$application_kind3',
						application_kind4 = '$application_kind4',
						application_kind5 = '$application_kind5',
						application_review = '$application_review',
						application_review2 = '$application_review2',
						application_review3 = '$application_review3',
						application_review4 = '$application_review4',
						application_review5 = '$application_review5',
						application_recognize = '$application_recognize',
						application_recognize2 = '$application_recognize2',
						application_recognize3 = '$application_recognize3',
						application_recognize4 = '$application_recognize4',
						application_recognize5 = '$application_recognize5',
						application_send = '$application_send',
						application_send2 = '$application_send2',
						application_send3 = '$application_send3',
						application_send4 = '$application_send4',
						application_send5 = '$application_send5',
						application_send_no = '$application_send_no',
						application_send_no2 = '$application_send_no2',
						application_send_no3 = '$application_send_no3',
						application_send_no4 = '$application_send_no4',
						application_send_no5 = '$application_send_no5',
						application_accept = '$application_accept',
						application_accept2 = '$application_accept2',
						application_accept3 = '$application_accept3',
						application_accept4 = '$application_accept4',
						application_accept5 = '$application_accept5',

						application_date_chk = '$application_date_chk',

						application_date_start = '$application_date_start',
						application_date_start2 = '$application_date_start2',
						application_date_start3 = '$application_date_start3',
						application_date_start4 = '$application_date_start4',
						application_date_start5 = '$application_date_start5',
						application_date_end = '$application_date_end',
						application_date_end2 = '$application_date_end2',
						application_date_end3 = '$application_date_end3',
						application_date_end4 = '$application_date_end4',
						application_date_end5 = '$application_date_end5',

						application_quarter_year = '$application_quarter_year',
						application_quarter_year2 = '$application_quarter_year2',
						application_quarter_year3 = '$application_quarter_year3',
						application_quarter_year4 = '$application_quarter_year4',
						application_quarter_year5 = '$application_quarter_year5',
						application_quarter = '$application_quarter',
						application_quarter2 = '$application_quarter2',
						application_quarter3 = '$application_quarter3',
						application_quarter4 = '$application_quarter4',
						application_quarter5 = '$application_quarter5',
						application_quarter = '$application_quarter',
						application_quarter2 = '$application_quarter2',
						application_quarter3 = '$application_quarter3',
						application_quarter4 = '$application_quarter4',
						application_quarter5 = '$application_quarter5',
						application_fee = '$application_fee',
						application_fee2 = '$application_fee2',
						application_fee3 = '$application_fee3',
						application_fee4 = '$application_fee4',
						application_fee5 = '$application_fee5',
						application_fee_sum = '$application_fee_sum',
						application_fee_sum2 = '$application_fee_sum2',
						application_fee_sum3 = '$application_fee_sum3',
						application_fee_sum4 = '$application_fee_sum4',
						application_fee_sum5 = '$application_fee_sum5',

						reapplication_date = '$reapplication_date',
						reapplication_date2 = '$reapplication_date2',
						reapplication_date3 = '$reapplication_date3',
						reapplication_date4 = '$reapplication_date4',
						reapplication_date5 = '$reapplication_date5',



						proxy_date = '$proxy_date',
						proxy_memo = '$proxy_memo',

						$convey_file_sql_1
						$convey_file_sql_2
						$convey_file_sql_3
						$convey_file_sql_4
						$convey_file_sql_5
						$convey_file_sql_6

						convey_name = '$convey_name',
						memo_total = '$memo_total'
";
//사업장 기본정보
$sql_base = " select * from com_list_gy where com_code='$id' ";
$result_base = sql_query($sql_base);
$row = mysql_fetch_array($result_base);
//추가 필드 데이터 유무
$sql1 = " select * from com_list_gy_opt where com_code='$id' ";
$result1 = sql_query($sql1);
$total1 = mysql_num_rows($result1);
//수정
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
//추가 필드 데이터 유무2
$sql2 = " select * from com_list_gy_opt2 where com_code='$id' ";
$result2 = sql_query($sql2);
$total2 = mysql_num_rows($result2);
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
//echo $sql;
//echo $sql2;
//echo $sql_opt2;
//exit;
//$id = mysql_insert_id();

//담당자 설정
$mb_id = $member['mb_id'];
$mb_name = $member['mb_name'];
$mb_nick = $member['mb_nick'];
$mb_profile_code = $member['mb_profile'];
$mb_profile = $man_cust_name_arry[$mb_profile_code];
$branch = $man_cust_name_arry[$damdang_code];
$branch2 = $man_cust_name_arry[$damdang_code2];

//지원금DB insert / update
for($app_no=1;$app_no<=$app_count;$app_no++) {
	$k = $app_no;
	if($k == 1) $k = "";
	$idx = $_POST['idx'.$k];
	//천단위콤마 제거
	$application_fee_sum = str_replace(',','',$_POST['application_fee_sum'.$k]);
	//지원금 종류
	$application_kind = $_POST['application_kind'.$k];
	$application_review = $_POST['application_review'.$k];
	$application_recognize = $_POST['application_recognize'.$k];
	$erp_application_send = $_POST['application_send'.$k];
	$erp_application_send_no = $_POST['application_send_no'.$k];
	$application_accept = $_POST['application_accept'.$k];
	//선청기간/분기 선택
	$application_date_chk = $_POST['application_date_chk'.$k];
	$application_date_start = $_POST['application_date_start'.$k];
	$application_date_end = $_POST['application_date_end'.$k];
	//신청년도
	$application_quarter_year = $_POST['application_quarter_year'.$k.'_1'].",".$_POST['application_quarter_year'.$k.'_2'].",".$_POST['application_quarter_year'.$k.'_3'];
	//선청분기
	$application_quarter = $_POST['application_quarter'.$k.'_1_1'].",".$_POST['application_quarter'.$k.'_1_2'].",".$_POST['application_quarter'.$k.'_1_3'].",".$_POST['application_quarter'.$k.'_1_4']."_".$_POST['application_quarter'.$k.'_2_1'].",".$_POST['application_quarter'.$k.'_2_2'].",".$_POST['application_quarter'.$k.'_2_3'].",".$_POST['application_quarter'.$k.'_2_4']."_".$_POST['application_quarter'.$k.'_3_1'].",".$_POST['application_quarter'.$k.'_3_2'].",".$_POST['application_quarter'.$k.'_3_3'].",".$_POST['application_quarter'.$k.'_3_4'];
	//종료구분
	$close_kind = $_POST['close_kind'.$k];
	//종료일자
	$close_date = $_POST['close_date'.$k];
	//종료년도
	$close_year = $_POST['close_year'.$k];
	//종료분기
	$close_quarter = $_POST['close_quarter'.$k];
	//신청주기
	$application_cycle = $_POST['application_cycle'.$k];
	//재신청일자
	$reapplication_date = $_POST['reapplication_date'.$k];
	//재신청일자 완료
	//$reapplication_done = $_POST['reapplication_done'.$k];
	//지원금DB
	//reapplication_done = '$reapplication_done' //최종완료 제거 161028
	$sql_common_app = " 
						w_date = '$now_time',
						w_user = '$mb_id',
						com_code = '$id',
						com_name_app = '$firm_name',

						application_kind = '$application_kind',
						application_review = '$application_review',
						application_recognize = '$application_recognize',
						application_send = '$erp_application_send',
						application_send_no = '$erp_application_send_no',
						application_accept = '$application_accept',
						application_date_chk = '$application_date_chk',
						application_date_start = '$application_date_start',
						application_date_end = '$application_date_end',
						application_quarter_year = '$application_quarter_year',
						application_quarter = '$application_quarter',
						application_fee_sum = '$application_fee_sum',

						close_kind = '$close_kind',
						close_date = '$close_date',
						close_year = '$close_year',
						close_quarter = '$close_quarter',
						application_cycle = '$application_cycle',

						reapplication_date = '$reapplication_date'

	";
	//지원금DB 데이터 유무
	$sql_app_chk = " select * from erp_application where idx='$idx' ";
	$result_app_chk = sql_query($sql_app_chk);
	$total_app_chk = mysql_num_rows($result_app_chk);
	if($total_app_chk) {
		$sql_app = " update erp_application set 
					$sql_common_app 
					where idx = '$idx'
		";
	} else {
		$sql_app = " insert erp_application set 
					$sql_common_app 
		";
	}
	//echo $sql_app."<br><br>";
	sql_query($sql_app);
}
//exit;

//직무교육 구분 선택 시 저장
if($train_kind) {
	//직무교육DB insert / update
	for($job_no=1;$job_no<=$job_count;$job_no++) {
		$k = $job_no;
		if($k == 1) $k = "";
		$job_idx = $_POST['job_idx'.$k];
		//지원금 종류
		$train_kind = $_POST['train_kind'.$k];
		$permission_date = $_POST['permission_date'.$k];
		$scale = $_POST['scale'.$k];
		$staff = $_POST['staff'.$k];
		$facility = $_POST['facility_'.$k];
		$facility2 = $_POST['facility2_'.$k];
		$facility3 = $_POST['facility3_'.$k];
		//관리책임자
		$chief_name = $_POST['chief_name'.$k];
		$chief_ssnb = $_POST['chief_ssnb'.$k];
		$chief_position = $_POST['chief_position'.$k];
		$chief_job = $_POST['chief_job'.$k];
		$chief_career = $_POST['chief_career'.$k];
		//강사1
		$teacher_name = $_POST['teacher_name_'.$k];
		$teacher_ssnb = $_POST['teacher_ssnb_'.$k];
		$teacher_position = $_POST['teacher_position_'.$k];
		$teacher_job = $_POST['teacher_job_'.$k];
		$teacher_career = $_POST['teacher_career_'.$k];
		$teacher_mail = $_POST['teacher_mail_'.$k];
		$teacher_scholarship = $_POST['teacher_scholarship_'.$k];
		//강사2
		$teacher_name2 = $_POST['teacher_name2_'.$k];
		$teacher_ssnb2 = $_POST['teacher_ssnb2_'.$k];
		$teacher_position2 = $_POST['teacher_position2_'.$k];
		$teacher_job2 = $_POST['teacher_job2_'.$k];
		$teacher_career2 = $_POST['teacher_career2_'.$k];
		$teacher_mail2 = $_POST['teacher_mail2_'.$k];
		$teacher_scholarship2 = $_POST['teacher_scholarship2_'.$k];
		//인증유효기간
		$approval_effective = $_POST['approval_effective'.$k];
		$approval_expiration = $_POST['approval_expiration'.$k];
		//교육실시일 교육종료일
		$education_conduct_report = $_POST['education_conduct_report'.$k.'_1'];
		$education_close_date = $_POST['education_close_date'.$k.'_1'];
		//지원금 : 천단위콤마 제거
		$job_fee = str_replace(',','',$_POST['job_fee'.$k.'_1']);
		//메모
		$job_review = $_POST['job_memo'.$k.'_1'];

		//직무교육DB
		$sql_common_job = " 
							w_date = '$now_time',
							w_user = '$mb_id',
							com_code = '$id',
							com_name_job = '$firm_name',

							train_kind = '$train_kind',
							permission_date = '$permission_date',
							scale = '$scale',
							staff = '$staff',
							facility = '$facility',
							facility2 = '$facility2',
							facility3 = '$facility3',

							chief_name = '$chief_name',
							chief_ssnb = '$chief_ssnb',
							chief_position = '$chief_position',
							chief_job = '$chief_job',
							chief_career = '$chief_career',

							teacher_name = '$teacher_name',
							teacher_ssnb = '$teacher_ssnb',
							teacher_position = '$teacher_position',
							teacher_job = '$teacher_job',
							teacher_career = '$teacher_career',
							teacher_mail = '$teacher_mail',
							teacher_scholarship = '$teacher_scholarship',

							teacher_name2 = '$teacher_name2',
							teacher_ssnb2 = '$teacher_ssnb2',
							teacher_position2 = '$teacher_position2',
							teacher_job2 = '$teacher_job2',
							teacher_career2 = '$teacher_career2',
							teacher_mail2 = '$teacher_mail2',
							teacher_scholarship2 = '$teacher_scholarship2',

							approval_effective = '$approval_effective',
							approval_expiration = '$approval_expiration',
							education_conduct_report = '$education_conduct_report',
							education_close_date = '$education_close_date',
							job_fee = '$job_fee',

							job_review = '$job_review'
		";
		//직무교육DB 데이터 유무
		$sql_job_chk = " select * from job_education where idx='$job_idx' ";
		$result_job_chk = sql_query($sql_job_chk);
		$total_job_chk = mysql_num_rows($result_job_chk);
		if($total_job_chk) {
			$sql_job = " update job_education set $sql_common_job where idx = '$job_idx' ";
		} else {
			$sql_job = " insert job_education set $sql_common_job ";
		}
		sql_query($sql_job);
		//직무교육 idx 미존재 시 idx 추출
		if(!$job_idx) {
			$sql_job_idx = " select idx from job_education where com_code='$id' ";
			$row_job_idx = sql_fetch($sql_job_idx);
			$job_idx = $row_job_idx['idx'];
		}

		//직무교육DB insert / update
		for($job_opt_no=1;$job_opt_no<=$_POST['job_opt_count'.$k];$job_opt_no++) {
			$t = $job_opt_no;
			if($t == 1) $t = "";
			$id_opt = $_POST['id_opt'.$k.'_'.$t];
			//교육실시일 교육종료일 지원금 메모
			$education_conduct_report = $_POST['education_conduct_report'.$k.'_'.$t];
			$education_close_date = $_POST['education_close_date'.$k.'_'.$t];
			$job_fee = str_replace(',','',$_POST['job_fee'.$k.'_'.$t]);
			$job_memo = $_POST['job_memo'.$k.'_'.$t];
			//직무교육 세부DB
			$sql_common_job_opt = " 
								education_conduct_report = '$education_conduct_report',
								education_close_date = '$education_close_date',
								job_fee = '$job_fee',
								job_memo = '$job_memo'
			";
			//직무교육DB 데이터 유무
			$sql_job_opt_chk = " select * from job_education_opt where mid='$job_idx' and id='$id_opt' ";
			$result_job_opt_chk = sql_query($sql_job_opt_chk);
			$total_job_opt_chk = mysql_num_rows($result_job_opt_chk);
			if($total_job_opt_chk) {
				$sql_job_opt = " update job_education_opt set $sql_common_job_opt where mid='$job_idx' and id='$id_opt' ";
			} else {
				$sql_job_opt = " insert job_education_opt set $sql_common_job_opt , mid='$job_idx' ";
			}
			sql_query($sql_job_opt);
		}
	}
}
//알림 DB 저장용 데이터 select
$row1 = mysql_fetch_array($result1);
$row2 = mysql_fetch_array($result2);

//담당매니저 코드 체크
$sql_manage = "select * from a4_manage where user_id = '$mb_id' ";
$row_manage = sql_fetch($sql_manage);
$manage_code = $row_manage['code'];

//사무위탁 이력 DB 저장
if($row1['samu_receive_no'] == "0") $samu_receive_no_db = "";
if($row1['samu_req_yn'] != $samu_req_yn || $row1['samu_req_date'] != $samu_req_date || $samu_receive_no_db != $samu_receive_no || $row1['samu_close_date'] != $samu_close_date) {
	$sql_samu_history = " insert samu_history set 
			com_code = '$id', w_date='$now_time', w_user = '$mb_id', w_name = '$mb_nick', samu_req_yn = '$samu_req_yn', samu_req_date = '$samu_req_date', samu_receive_no = '$samu_receive_no', samu_close_date = '$samu_close_date'
	";
	sql_query($sql_samu_history);
}

//의뢰서접수
//echo $row['editdt']." != ".$editdt;
//exit;
if($row['editdt'] != $editdt) {
	$wr_subject = $editdt." 의뢰서 서류도착 되었습니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '10002', alert_name = '의뢰서접수'
	";
	sql_query($sql_alert);
}
//계약서접수
if($chk_contract_date && $row1['chk_contract_date'] != $chk_contract_date) {
	$wr_subject = $chk_contract_date." 계약서 서류도착 되었습니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '10003', alert_name = '계약서접수'
	";
	sql_query($sql_alert);
}
//위탁서접수
if($row1['samu_receive_date'] != $samu_receive_date) {
	$wr_subject = $samu_receive_date." 위탁서 서류도착 되었습니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '15000', alert_name = '위탁서접수'
	";
	sql_query($sql_alert);
}
//사무위탁 수임가능
if($row1['samu_req_yn'] != "2" && $samu_req_yn == "2") {
	$wr_subject = $now_date." 사무위탁 수임가능 합니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '15001', alert_name = '사무위탁'
	";
	sql_query($sql_alert);
}
//사무위탁 타수임 / 김국진 과장 의견 160512
if($row1['samu_req_yn'] != "3" && $samu_req_yn == "3") {
	$wr_subject = $now_date." 사무위탁 타수임입니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '15001', alert_name = '사무위탁'
	";
	sql_query($sql_alert);
}
//사무위탁 수임
if($row1['samu_req_yn'] != "4" && $samu_req_yn == "4") {
	$wr_subject = $samu_req_date." 사무위탁 수임 신고 되었습니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '15001', alert_name = '사무위탁'
	";
	sql_query($sql_alert);
}
//사무위탁 해지
if($row1['samu_req_yn'] != "5" && $samu_req_yn == "5") {
	$wr_subject = $samu_close_date." 사무위탁 해지 되었습니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '15001', alert_name = '사무위탁'
	";
	sql_query($sql_alert);
}
//대리인선임(공단) 접수
if($agent_elect_public_date && $row1['agent_elect_public_date'] != $agent_elect_public_date) {
	$wr_subject = $agent_elect_public_date." 대리인선임(공단) 서류도착 되었습니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '20001', alert_name = '대리인선임(공단)'
	";
	sql_query($sql_alert);
}
//대리인선임(공단) 완료
if($row1['agent_elect_public_yn'] != "3" && $agent_elect_public_yn == "3") {
	$wr_subject = $agent_elect_public_edate." 대리인선임(공단) 완료 되었습니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '20001', alert_name = '대리인선임(공단)'
	";
	sql_query($sql_alert);
}
//대리인선임(공단) 미접수
if($row1['agent_elect_public_yn'] != "4" && $agent_elect_public_yn == "4") {
	$wr_subject = $now_date." 대리인선임(공단) 미접수 되었습니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '20001', alert_name = '대리인선임(공단)'
	";
	sql_query($sql_alert);
}
//대리인선임(공단) 회원가입
if($row1['agent_elect_public_yn'] != "6" && $agent_elect_public_yn == "6") {
	$wr_subject = $now_date." 대리인선임(공단) 회원가입이 필요합니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '20001', alert_name = '대리인선임(공단)'
	";
	sql_query($sql_alert);
}
//대리인선임(공단) 해지
if($row1['agent_elect_public_yn'] != "7" && $agent_elect_public_yn == "7") {
	$wr_subject = $agent_elect_public_cdate." 대리인선임(공단) 해지 되었습니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '20001', alert_name = '대리인선임(공단)'
	";
	sql_query($sql_alert);
}
//전자민원(센터) 접수
if($agent_elect_center_date && $row1['agent_elect_center_date'] != $agent_elect_center_date) {
	$wr_subject = $agent_elect_center_date." 전자민원(센터) 서류도착 되었습니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '20002', alert_name = '전자민원(센터)'
	";
	sql_query($sql_alert);
}
//전자민원(센터) 완료
if($row1['agent_elect_center_yn'] != "3" && $agent_elect_center_yn == "3") {
	$wr_subject = $agent_elect_center_edate." 전자민원(센터) 완료 되었습니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '20002', alert_name = '전자민원(센터)'
	";
	sql_query($sql_alert);
}
//전자민원(센터) 미접수
if($row1['agent_elect_center_yn'] != "4" && $agent_elect_center_yn == "4") {
	$wr_subject = $now_date." 전자민원(센터) 미접수 되었습니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '20002', alert_name = '전자민원(센터)'
	";
	sql_query($sql_alert);
}
//전자민원(센터) 회원가입
if($row1['agent_elect_center_yn'] != "6" && $agent_elect_center_yn == "6") {
	$wr_subject = $now_date." 전자민원(센터) 회원가입이 필요합니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '20002', alert_name = '전자민원(센터)'
	";
	sql_query($sql_alert);
}
//전자민원(센터) 해지
if($row1['agent_elect_center_yn'] != "7" && $agent_elect_center_yn == "7") {
	$wr_subject = $agent_elect_center_cdate." 전자민원(센터) 해지 되었습니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '20002', alert_name = '전자민원(센터)'
	";
	sql_query($sql_alert);
}
//이지노무 키즈노무 선택 표시
if($easynomu_yn == 2) $easynomu_text = "키즈노무";
else $easynomu_text = "이지노무";
//이지노무 셋팅완료
if($row2['easynomu_process'] != "3" && $easynomu_process == "3") {
	$wr_subject = $easynomu_finish_date." ".$easynomu_text." 셋팅 완료 되었습니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '50001', alert_name = '이지노무'
	";
	sql_query($sql_alert);
}
//이지노무 해지
if($row2['easynomu_process'] != "5" && $easynomu_process == "5") {
	$wr_subject = $easynomu_close_date." ".$easynomu_text." 해지 되었습니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '50001', alert_name = '이지노무'
	";
	sql_query($sql_alert);
}
//검토현황 검토중
if($row2['review_process'] != "1" && $review_process == "1") {
	$wr_subject = $now_date." 의뢰서 검토중 입니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '60001', alert_name = '검토현황'
	";
	sql_query($sql_alert);
}
//검토현황 검토완료
if($row2['review_process'] != "2" && $review_process == "2") {
	$wr_subject = $review_finish_date." 의뢰서 검토완료 되었습니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '60001', alert_name = '검토현황'
	";
	sql_query($sql_alert);
}
//검토현황 해당사항없음
if($row2['review_process'] != "3" && $review_process == "3") {
	$wr_subject = $review_finish_date." 의뢰서 검토결과 해당사항없음 처리 되었습니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '60001', alert_name = '검토현황'
	";
	sql_query($sql_alert);
}
//재연락일
if($row2['re_call_date'] != $re_call_date) {
	if($re_call_memo) $re_call_text = "[".$re_call_memo."]";
	else $re_call_text = "";
	$wr_subject = "재연락 ".$re_call_text;
	$re_call_date_modify = str_replace('.','-',$re_call_date);
	$re_call_time = $re_call_date_modify." 00:00:00";
	$send_to = "kcmc1007";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			send_to = '$send_to', manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$re_call_time', memo = '$wr_subject', 
			memo2 = '$re_call_memo', alert_code = '30003', alert_name = '재연락'
	";
	sql_query($sql_alert);
}
//신청서류안내
if($row2['support_document'] != $support_document) {
	if($support_document) $support_document_text = "[".$support_document."]";
	else $support_document_text = "";
	$wr_subject = "신청서류안내 ".$support_document_text;
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			memo2 = '$support_document', alert_code = '30001', alert_name = '신청서류안내'
	";
	sql_query($sql_alert);
}
//보완(미비)서류안내
if($row2['support_document_lack'] != $support_document_lack) {
	if($support_document_lack) $support_document_lack_text = "[".$support_document_lack."]";
	else $support_document_lack_text = "";
	$wr_subject = "보완(미비)서류안내 ".$support_document_lack_text;
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			memo2 = '$support_document_lack', alert_code = '30002', alert_name = '보완(미비)서류'
	";
	sql_query($sql_alert);
}
//신청가능(예상) 추가 항목 151014
for($k=2;$k<=5;$k++) {
	//신청서류안내2~5
	if($row2['support_document'.$k] != $_POST['support_document'.$k]) {
		$support_document = $_POST['support_document'.$k];
		if($_POST['support_document'.$k]) $support_document_text = "[".$_POST['support_document'.$k]."]";
		else $support_document_text = "";
		$wr_subject = "신청서류안내 ".$support_document_text;
		$sql_alert = " insert erp_alert set 
				branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
				manage_code = '$manage_cust_numb',
				com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
				memo2 = '$support_document', alert_code = '30001', alert_name = '신청서류안내'
		";
		sql_query($sql_alert);
	}
	if($row2['support_document_lack'.$k] != $_POST['support_document_lack'.$k]) {
		$support_document_lack = $_POST['support_document_lack'.$k];
		if($_POST['support_document_lack'.$k]) $support_document_lack_text = "[".$_POST['support_document_lack'.$k]."]";
		else $support_document_lack_text = "";
		$wr_subject = "보완(미비)서류안내 ".$support_document_lack_text;
		$sql_alert = " insert erp_alert set 
				branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
				manage_code = '$manage_cust_numb',
				com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
				memo2 = '$support_document_lack', alert_code = '30002', alert_name = '보완(미비)서류'
		";
		sql_query($sql_alert);
	}
}

//지원금 관련 알림 체크
$sql_app = " select * from erp_application where com_code='$id' order by idx asc ";
$result_app = sql_query($sql_app);
for($i=0; $row_app=sql_fetch_array($result_app); $i++) {
	$array_application_send[$i] = $row_app['application_send'];
	$array_application_send_no[$i] = $row_app['application_send_no'];
	//echo $i." ".$array_application_send[$i],"<br>";
}
//echo $application_send3;
//exit;
//우편물발송 1
if($array_application_send[0] != $application_send) {
	if($application_send_no) $application_send_no_text = "운송장번호(".$application_send_no.")";
	else $application_send_no_text = "";
	$wr_subject = $application_send." ".$application_send_no_text." ".$support_kind_array[$application_kind]." 우편물 발송 되었습니다.(1)";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '40001', alert_name = '우편물발송'
	";
	sql_query($sql_alert);
}
//우편물발송 2
if($array_application_send[1] != $application_send2) {
	if($application_send_no2) $application_send_no_text = "운송장번호(".$application_send_no2.")";
	else $application_send_no_text = "";
	$wr_subject = $application_send2." ".$application_send_no_text." ".$support_kind_array[$application_kind2]." 우편물 발송 되었습니다.(2)";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '40001', alert_name = '우편물발송'
	";
	sql_query($sql_alert);
}
//우편물발송 3
if($array_application_send[2] != $application_send3) {
	if($application_send_no3) $application_send_no_text = "운송장번호(".$application_send_no3.")";
	else $application_send_no_text = "";
	$wr_subject = $application_send3." ".$application_send_no_text." ".$support_kind_array[$application_kind3]." 우편물 발송 되었습니다.(3)";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '40001', alert_name = '우편물발송'
	";
	sql_query($sql_alert);
}
//우편물발송 4
if($array_application_send[3] != $application_send4) {
	if($application_send_no4) $application_send_no_text = "운송장번호(".$application_send_no4.")";
	else $application_send_no_text = "";
	$wr_subject = $application_send4." ".$application_send_no_text." ".$support_kind_array[$application_kind4]." 우편물 발송 되었습니다.(4)";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '40001', alert_name = '우편물발송'
	";
	sql_query($sql_alert);
}
//우편물발송 5
if($array_application_send[4] != $application_send5) {
	if($application_send_no5) $application_send_no_text = "운송장번호(".$application_send_no5.")";
	else $application_send_no_text = "";
	$wr_subject = $application_send5." ".$application_send_no_text." ".$support_kind_array[$application_kind5]." 우편물 발송 되었습니다.(5)";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '40001', alert_name = '우편물발송'
	";
	sql_query($sql_alert);
}
//우편물발송 6
if($array_application_send[5] != $application_send6) {
	if($application_send_no6) $application_send_no_text = "운송장번호(".$application_send_no6.")";
	else $application_send_no_text = "";
	$wr_subject = $application_send6." ".$application_send_no_text." ".$support_kind_array[$application_kind6]." 우편물 발송 되었습니다.(6)";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '40001', alert_name = '우편물발송'
	";
	sql_query($sql_alert);
}
//전달 첨부서류
if($row2['convey_name'] != $convey_name) {
	if($convey_name) $convey_name_text = "(".$convey_name.")";
	else $convey_name_text = "";
	$wr_subject = "전달첨부서류 ".$convey_name_text;
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			memo2 = '$convey_name', alert_code = '80002', alert_name = '전달첨부서류'
	";
	sql_query($sql_alert);
}
//건설 거래처 등록 알림
$strpos_text = "건설";
//echo $uptae.", ".$strpos_text;
//exit;
if(strpos($row['uptae'], $strpos_text) === false && strpos($uptae, $strpos_text) !== false) {
	$wr_subject = $now_date." 건설 거래처가 등록 되었습니다.";
	$send_to = "kcmc1009";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
			send_to = '$send_to', manage_code = '$manage_cust_numb',
			user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '10004', alert_name = '건설업체'
	";
	sql_query($sql_alert);
}
//고용창출
$employment_kind = explode(',',$row2['employment_kind']);
$send_to = "branch";
//고용창출 시간선택제
if($employment_kind[0] != $employment_kind1 && $employment_kind1 == 1) {
	$wr_subject = $time_choice_work_date." 시간선택제 접수 되었습니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			send_to = '$send_to', manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '40002', alert_name = '고용창출'
	";
	sql_query($sql_alert);
}
//고용창출 청년인턴
if($employment_kind[1] != $employment_kind2 && $employment_kind2 == 1) {
	$wr_subject = $youth_intern_date." 청년인턴 접수 되었습니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			send_to = '$send_to', manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '40002', alert_name = '고용창출'
	";
	sql_query($sql_alert);
}
//고용창출 장년인턴
if($employment_kind[2] != $employment_kind3 && $employment_kind3 == 1) {
	$wr_subject = $middle_age_intern_date." 장년인턴 접수 되었습니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			send_to = '$send_to', manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '40002', alert_name = '고용창출'
	";
	sql_query($sql_alert);
}
//고용창출 전문인력
if($employment_kind[3] != $employment_kind4 && $employment_kind4 == 1) {
	$wr_subject = $professional_date." 전문인력 접수 되었습니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			send_to = '$send_to', manage_code = '$manage_cust_numb',
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '40002', alert_name = '고용창출'
	";
	sql_query($sql_alert);
}
$qstr = $_POST['qstr'];
alert("정상적으로 접수처리현황이 수정 되었습니다.","client_process_view.php?id=".$id."&w=".$w."&page=".$page."&".$qstr."&".$stx_qstr);
//goto_url("./4insure_list.php");
?>