<?
$sub_menu = "100100";
include_once("./_common.php");

//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");
// 대표자핸드폰
if($cust_cel1) $cust_cel = $cust_cel1."-".$cust_cel2."-".$cust_cel3;
//전화번호
//if($cust_tel1) $cust_tel = "(".$cust_tel1.") ".$cust_tel2."-".$cust_tel3;
if($cust_tel1) $cust_tel = $cust_tel1."-".$cust_tel2."-".$cust_tel3;
//팩스번호
//if($cust_fax1) $cust_fax = "(".$cust_fax1.") ".$cust_fax2."-".$cust_fax3;
if($cust_fax1) $cust_fax = $cust_fax1."-".$cust_fax2."-".$cust_fax3;
//담당자전화
if($damdang_cel1) $damdang_cel = $damdang_cel1."-".$damdang_cel2."-".$damdang_cel3;
//우편번호
if($adr_zip1) $adr_zip = $adr_zip1."-".$adr_zip2;
//급여지급일 말일
if($pay_day_last == 1) $pay_day = "";
//월정액결제일 말일
if($settlement_day_last == 1) $settlement_day = "";

//증명사진 경로
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
		alert("정상적으로 파일 업로드가 되지 않았습니다.\n파일을 확인하신 후 다시 업로드하여 주십시오.","staff_view.php?id=$id&code=$code&page=$page");
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

//아이디 발급
$mb_id = $user_id;
$mb_password = $user_pass;
$sql_common_id = " mb_name         = '$firm_name',
                mb_nick         = '$firm_name',
                mb_email        = 'kcmc4519@naver.com',
								mb_level        = '3'
							";

$sql_common = " com_name = '$firm_name',
						upche_div = '$comp_type',
						biz_no = '$comp_bznb',
						bupin_no = '$bupin_no',
						uptae = '$uptae',

						upjong_code = '$upjong_code',
						upjong = '$upjong',
						t_insureno = '$user_id',

						boss_name = '$cust_name',
						jumin_no = '$cust_ssnb',

						boss_hp = '$cust_cel',
						com_tel = '$cust_tel',
						com_fax = '$cust_fax',

						com_damdang = '$damdang_name',

						com_postno = '$adr_zip',
						com_juso = '$adr_adr1',
						com_juso2 = '$adr_adr2',
						com_mail = '$cust_email',

						account_report_way = '$account_report_way'
";
//천단위콤마 제거
$bonus_money = str_replace(',','',$bonus_money);
$setting_pay = str_replace(',','',$setting_pay);
$month_pay = str_replace(',','',$month_pay);
// 상여금 지급일
$bonus_array = $bonus_0.",".$bonus_1.",".$bonus_2.",".$bonus_3.",".$bonus_4.",".$bonus_5;
$bonus_p_array = $bonus_p_0.",".$bonus_p_1.",".$bonus_p_2.",".$bonus_p_3.",".$bonus_p_4.",".$bonus_p_5;

$sql_common2 = " jongmok = '$jongmok',
						password = '$user_pass',
						cntr_sdate = '$cntr_sdate',
						com_damdang_tel = '$damdang_cel',
						emp5_gbn = '$emp5_gbn',
						workday_month = '$workday_month',

						pay_day = '$pay_day',
						pay_day_last = '$pay_day_last',
						pay_day_now_month = '$pay_day_now_month',

						$pic_name_sql
						employment_report = '$employment_report',
						employment_report_date = '$employment_report_date',
						retirement_age = '$retirement_age',

						g1 = '$g1',
						g2 = '$g2',
						g3 = '$g3',
						b1 = '$b1',
						b2 = '$b2',
						b3 = '$b3',
						ng1 = '$ng1',
						ng2 = '$ng2',
						ng3 = '$ng3',
						g1_t = '$g1_t',
						g2_t = '$g2_t',
						g3_t = '$g3_t',
						b1_t = '$b1_t',
						b2_t = '$b2_t',
						b3_t = '$b3_t',

						check_bonus_money_yn = '$check_bonus_money_yn',
						bonus_money = '$bonus_money',
						bonus_standard = '$bonus_standard',
						bonus_percent = '$bonus_percent',
						bonus_time = '$bonus_array',
						bonus_p = '$bonus_p_array',

						persons = '$persons',
						man = '$man',
						woman = '$woman',
						stime = '$stime',
						etime = '$etime',
						rest1 = '$rest1',
						rest1e = '$rest1e',
						rest2 = '$rest2',
						rest2e = '$rest2e',
						rest3 = '$rest3',
						rest3e = '$rest3e',

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

						pay_calculate_day_period = '$pay_calculate_day_period',
						pay_calculate_day_period1 = '$pay_calculate_day_period1',
						pay_calculate_day_period2 = '$pay_calculate_day_period2',
						pay_calculate_day_period3 = '$pay_calculate_day_period3',
						pay_calculate_day1 = '$pay_calculate_day1',
						pay_calculate_day2 = '$pay_calculate_day2',
						pay_calculate_day3 = '$pay_calculate_day3',

						retirement_age_rule = '$retirement_age_rule',
						retirement_age_rule1 = '$retirement_age_rule1',
						retirement_age_rule2 = '$retirement_age_rule2',
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
						document_after6 = '$document_after6'
";

//추가 필드 데이터 유무
$sql1 = " select * from com_list_gy_opt where com_code='$id' ";
$result1 = sql_query($sql1);
$total1 = mysql_num_rows($result1);
//수정
if ($w == 'u'){
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
	//비밀번호 변경
	$sql3 = " update $g4[member_table] set mb_password = '".sql_password($mb_password)."' where mb_id='$mb_id' ";
	sql_query($sql3);
	alert("정상적으로 사업장 기본정보가 수정 되었습니다.","com_view.php?id=$id&w=$w&page=$page");
//등록
}else{
	$sql_max = "select max(com_code) from $g4[com_list_gy] ";
	$result_max = sql_query($sql_max);
	$row_max = mysql_fetch_array($result_max);
	$id = $row_max[0]+1;
	if(strlen($id) == 4) $id = "0".$id;
	else if(strlen($id) == 3) $id = "00".$id;
	else if(strlen($id) == 2) $id = "000".$id;
	else if(strlen($id) == 1) $id = "0000".$id;
	//echo strlen($id);
	//echo $id;
	//exit;
	$sql = " insert $g4[com_list_gy] set 
					$sql_common 
					, com_code = '$id' ";
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
	//회원등록
	//sql_query(" insert into $g4[member_table] set mb_id = '$mb_id', mb_password = '".sql_password($mb_password)."', mb_datetime = '$g4[time_ymdhis]', mb_ip = '$_SERVER[REMOTE_ADDR]', mb_email_certify = '$g4[time_ymdhis]', mb_open = '1', $sql_common_id  ");
	//관리자 승인 mb_email_certify 제거
	sql_query(" insert into $g4[member_table] set mb_id = '$mb_id', mb_password = '".sql_password($mb_password)."', mb_datetime = '$g4[time_ymdhis]', mb_ip = '$_SERVER[REMOTE_ADDR]', mb_open = '1', $sql_common_id  ");

	sql_query($sql2);
  //$id = mysql_insert_id();

	if($member['mb_level'] != 5) {
		alert("정상적으로 사업장 기본정보가 등록 되었습니다.","com_list.php?page=$page");
	} else {
		alert("정상적으로 사업장 기본정보가 등록 되었습니다.","/bbs/logout.php?url=%2Feasynomu%2Flogin.php");
	}
}
//echo $sql;
//echo $sql2;
//exit;
//goto_url("./4insure_list.php");
?>