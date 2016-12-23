<?
$sub_menu = "100200";
include_once("./_common.php");

//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");
$mktime = time();
$user_id = $member['mb_id'];
if(!$user_id) $user_id = $comp_bznb;

// 천단위 콤마 제거 DB 저장
$join_salary = preg_replace("(,)", "", $join_salary);
$quit_sum_now = preg_replace("(,)", "", $quit_sum_now);
$quit_sum_pre = preg_replace("(,)", "", $quit_sum_pre);
$quit_3month = preg_replace("(,)", "", $quit_3month);
for($i=0; $i<=3; $i++) {
	$join_salary_[$i] = preg_replace("(,)", "", $join_salary_[$i]);
	$quit_sum_now_[$i] = preg_replace("(,)", "", $quit_sum_now_[$i]);
	$quit_sum_pre_[$i] = preg_replace("(,)", "", $quit_sum_pre_[$i]);
	$quit_3month_[$i] = preg_replace("(,)", "", $quit_3month_[$i]);
}

//첨부파일 경로
$upload_dir = 'files/4insure/';

if($_FILES['filename']['tmp_name']) {
	$file_name = $mktime."_".$_FILES['filename']['name'];
	$upload_file = $upload_dir . $file_name;
	//echo $upload_file;
	//echo $_FILES['filename']['tmp_name'];
	//exit;
	if ( move_uploaded_file($_FILES['filename']['tmp_name'], $upload_file) ) {
		//echo "SUCCESS";
	} else {
		alert("1.정상적으로 파일 업로드가 되지 않았습니다.\n파일을 확인하신 후 다시 업로드하여 주십시오.");
	}
} else {
	if(!is_file($upload_file)) $file_name = "";
}
//echo $_FILES['filename2']['tmp_name'];
//exit;
if($_FILES['filename2']['tmp_name']) {
	$file_name2 = $mktime."_".$_FILES['filename2']['name'];
	$upload_file = $upload_dir . $file_name2;
	if ( move_uploaded_file($_FILES['filename2']['tmp_name'], $upload_file) ) {
	} else {
		alert("2.정상적으로 파일 업로드가 되지 않았습니다.\n파일을 확인하신 후 다시 업로드하여 주십시오.");
	}
} else {
	if(!is_file($upload_file)) $file_name2 = "";
}
if($_FILES['filename3']['tmp_name']) {
	$file_name3 = $mktime."_".$_FILES['filename3']['name'];
	$upload_file = $upload_dir . $file_name3;
	if ( move_uploaded_file($_FILES['filename3']['tmp_name'], $upload_file) ) {
	} else {
		alert("3.정상적으로 파일 업로드가 되지 않았습니다.\n파일을 확인하신 후 다시 업로드하여 주십시오.");
	}
} else {
	if(!is_file($upload_file)) $file_name3 = "";
}
if($_FILES['filename4']['tmp_name']) {
	$file_name4 = $mktime."_".$_FILES['filename4']['name'];
	$upload_file = $upload_dir . $file_name4;
	if ( move_uploaded_file($_FILES['filename4']['tmp_name'], $upload_file) ) {
	} else {
		alert("4.정상적으로 파일 업로드가 되지 않았습니다.\n파일을 확인하신 후 다시 업로드하여 주십시오.");
	}
} else {
	if(!is_file($upload_file)) $file_name4 = "";
}
if($_FILES['filename5']['tmp_name']) {
	$file_name5 = $mktime."_".$_FILES['filename5']['name'];
	$upload_file = $upload_dir . $file_name5;
	if ( move_uploaded_file($_FILES['filename5']['tmp_name'], $upload_file) ) {
	} else {
		alert("5.정상적으로 파일 업로드가 되지 않았습니다.\n파일을 확인하신 후 다시 업로드하여 주십시오.");
	}
} else {
	if(!is_file($upload_file)) $file_name5 = "";
}
//피부양자 등록
$children1 = $children_relation.",".$children_name.",".$children_ssnb.",".$children_cohabitation;
$children2 = $children_relation2.",".$children_name2.",".$children_ssnb2.",".$children_cohabitation2;
$children3 = $children_relation3.",".$children_name3.",".$children_ssnb3.",".$children_cohabitation3;
$children4 = $children_relation4.",".$children_name4.",".$children_ssnb4.",".$children_cohabitation4;
$children5 = $children_relation5.",".$children_name5.",".$children_ssnb5.",".$children_cohabitation5;
$children6 = $children_relation6.",".$children_name6.",".$children_ssnb6.",".$children_cohabitation6;

$children1_2 = $children_relation1_[0].",".$children_name1_[0].",".$children_ssnb1_[0].",".$children_cohabitation1_[0];
$children2_2 = $children_relation2_[0].",".$children_name2_[0].",".$children_ssnb2_[0].",".$children_cohabitation2_[0];
$children3_2 = $children_relation3_[0].",".$children_name3_[0].",".$children_ssnb3_[0].",".$children_cohabitation3_[0];
$children4_2 = $children_relation4_[0].",".$children_name4_[0].",".$children_ssnb4_[0].",".$children_cohabitation4_[0];
$children5_2 = $children_relation5_[0].",".$children_name5_[0].",".$children_ssnb5_[0].",".$children_cohabitation5_[0];
$children6_2 = $children_relation6_[0].",".$children_name6_[0].",".$children_ssnb6_[0].",".$children_cohabitation6_[0];

$children1_3 = $children_relation1_[1].",".$children_name1_[1].",".$children_ssnb1_[1].",".$children_cohabitation1_[1];
$children2_3 = $children_relation2_[1].",".$children_name2_[1].",".$children_ssnb2_[1].",".$children_cohabitation2_[1];
$children3_3 = $children_relation3_[1].",".$children_name3_[1].",".$children_ssnb3_[1].",".$children_cohabitation3_[1];
$children4_3 = $children_relation4_[1].",".$children_name4_[1].",".$children_ssnb4_[1].",".$children_cohabitation4_[1];
$children5_3 = $children_relation5_[1].",".$children_name5_[1].",".$children_ssnb5_[1].",".$children_cohabitation5_[1];
$children6_3 = $children_relation6_[1].",".$children_name6_[1].",".$children_ssnb6_[1].",".$children_cohabitation6_[1];

$children1_4 = $children_relation1_[2].",".$children_name1_[2].",".$children_ssnb1_[2].",".$children_cohabitation1_[2];
$children2_4 = $children_relation2_[2].",".$children_name2_[2].",".$children_ssnb2_[2].",".$children_cohabitation2_[2];
$children3_4 = $children_relation3_[2].",".$children_name3_[2].",".$children_ssnb3_[2].",".$children_cohabitation3_[2];
$children4_4 = $children_relation4_[2].",".$children_name4_[2].",".$children_ssnb4_[2].",".$children_cohabitation4_[2];
$children5_4 = $children_relation5_[2].",".$children_name5_[2].",".$children_ssnb5_[2].",".$children_cohabitation5_[2];
$children6_4 = $children_relation6_[2].",".$children_name6_[2].",".$children_ssnb6_[2].",".$children_cohabitation6_[2];

$children1_5 = $children_relation1_[3].",".$children_name1_[3].",".$children_ssnb1_[3].",".$children_cohabitation1_[3];
$children2_5 = $children_relation2_[3].",".$children_name2_[3].",".$children_ssnb2_[3].",".$children_cohabitation2_[3];
$children3_5 = $children_relation3_[3].",".$children_name3_[3].",".$children_ssnb3_[3].",".$children_cohabitation3_[3];
$children4_5 = $children_relation4_[3].",".$children_name4_[3].",".$children_ssnb4_[3].",".$children_cohabitation4_[3];
$children5_5 = $children_relation5_[3].",".$children_name5_[3].",".$children_ssnb5_[3].",".$children_cohabitation5_[3];
$children6_5 = $children_relation6_[3].",".$children_name6_[3].",".$children_ssnb6_[3].",".$children_cohabitation6_[3];

$sql_common = " comp_name = '$comp_name',
						comp_adr = '$comp_adr',
						comp_bznb = '$comp_bznb',
						comp_tel = '$comp_tel',
						comp_email = '$comp_email',
						comp_fax = '$comp_fax',

						file1 = '$file_name',
						file2 = '$file_name2',
						file3 = '$file_name3',
						file4 = '$file_name4',
						file5 = '$file_name5',

						quit_note = '$quit_note',
						quit_note_2 = '$quit_note_[0]',
						quit_note_3 = '$quit_note_[1]',
						quit_note_4 = '$quit_note_[2]',
						quit_note_5 = '$quit_note_[3]',

						children1 = '$children1',
						children2 = '$children2',
						children3 = '$children3',
						children4 = '$children4',
						children5 = '$children5',
						children6 = '$children6',
						children1_2 = '$children1_2',
						children2_2 = '$children2_2',
						children3_2 = '$children3_2',
						children4_2 = '$children4_2',
						children5_2 = '$children5_2',
						children6_2 = '$children6_2',
						children1_3 = '$children1_3',
						children2_3 = '$children2_3',
						children3_3 = '$children3_3',
						children4_3 = '$children4_3',
						children5_3 = '$children5_3',
						children6_3 = '$children6_3',
						children1_4 = '$children1_4',
						children2_4 = '$children2_4',
						children3_4 = '$children3_4',
						children4_4 = '$children4_4',
						children5_4 = '$children5_4',
						children6_4 = '$children6_4',
						children1_5 = '$children1_5',
						children2_5 = '$children2_5',
						children3_5 = '$children3_5',
						children4_5 = '$children4_5',
						children5_5 = '$children5_5',
						children6_5 = '$children6_5',

						join_name = '$join_name',
						join_ssnb = '$join_ssnb',
						join_date = '$join_date',
						join_jikjong = '$join_jikjong',
						join_jikjong_code = '$join_jikjong_code',
						join_time = '$join_time',
						join_salary = '$join_salary',
						isgy = '$isgy',
						issj = '$issj',
						iskm = '$iskm',
						isgg = '$isgg',
						contract_worker = '$contract_worker',
						contract_end_date = '$contract_end_date',
						join_note = '$join_note',

						quit_name = '$quit_name',
						quit_ssnb = '$quit_ssnb',
						quit_tel = '$quit_tel',
						quit_date = '$quit_date',
						quit_cause = '$quit_cause',
						quit_cause_text = '$quit_cause_text',
						quit_sum_now = '$quit_sum_now',
						quit_sum_now_month = '$quit_sum_now_month',
						quit_sum_pre = '$quit_sum_pre',
						quit_sum_pre_month = '$quit_sum_pre_month',
						quit_3month = '$quit_3month',

						join_name_2 = '$join_name_[0]',
						join_ssnb_2 = '$join_ssnb_[0]',
						join_date_2 = '$join_date_[0]',
						join_jikjong_2 = '$join_jikjong_[0]',
						join_jikjong_code_2 = '$join_jikjong_code_[0]',
						join_time_2 = '$join_time_[0]',
						join_salary_2 = '$join_salary_[0]',
						isgy_2 = '$isgy_[0]',
						issj_2 = '$issj_[0]',
						iskm_2 = '$iskm_[0]',
						isgg_2 = '$isgg_[0]',
						contract_worker_2 = '$contract_worker_2',
						contract_end_date_2 = '$contract_end_date_[0]',
						join_note_2 = '$join_note_[0]',

						quit_name_2 = '$quit_name_[0]',
						quit_ssnb_2 = '$quit_ssnb_[0]',
						quit_tel_2 = '$quit_tel_[0]',
						quit_date_2 = '$quit_date_[0]',
						quit_cause_2 = '$quit_cause_[0]',
						quit_cause_text_2 = '$quit_cause_text_[0]',
						quit_sum_now_2 = '$quit_sum_now_[0]',
						quit_sum_now_month_2 = '$quit_sum_now_month_[0]',
						quit_sum_pre_2 = '$quit_sum_pre_[0]',
						quit_sum_pre_month_2 = '$quit_sum_pre_month_[0]',
						quit_3month_2 = '$quit_3month_[0]',

						join_name_3 = '$join_name_[1]',
						join_ssnb_3 = '$join_ssnb_[1]',
						join_date_3 = '$join_date_[1]',
						join_jikjong_3 = '$join_jikjong_[1]',
						join_jikjong_code_3 = '$join_jikjong_code_[1]',
						join_time_3 = '$join_time_[1]',
						join_salary_3 = '$join_salary_[1]',
						isgy_3 = '$isgy_[1]',
						issj_3 = '$issj_[1]',
						iskm_3 = '$iskm_[1]',
						isgg_3 = '$isgg_[1]',
						contract_worker_3 = '$contract_worker_3',
						contract_end_date_3 = '$contract_end_date_[1]',
						join_note_3 = '$join_note_[1]',

						quit_name_3 = '$quit_name_[1]',
						quit_ssnb_3 = '$quit_ssnb_[1]',
						quit_tel_3 = '$quit_tel_[1]',
						quit_date_3 = '$quit_date_[1]',
						quit_cause_3 = '$quit_cause_[1]',
						quit_cause_text_3 = '$quit_cause_text_[1]',
						quit_sum_now_3 = '$quit_sum_now_[1]',
						quit_sum_now_month_3 = '$quit_sum_now_month_[1]',
						quit_sum_pre_3 = '$quit_sum_pre_[1]',
						quit_sum_pre_month_3 = '$quit_sum_pre_month_[1]',
						quit_3month_3 = '$quit_3month_[1]',

						join_name_4 = '$join_name_[2]',
						join_ssnb_4 = '$join_ssnb_[2]',
						join_date_4 = '$join_date_[2]',
						join_jikjong_4 = '$join_jikjong_[2]',
						join_jikjong_code_4 = '$join_jikjong_code_[2]',
						join_time_4 = '$join_time_[2]',
						join_salary_4 = '$join_salary_[2]',
						isgy_4 = '$isgy_[2]',
						issj_4 = '$issj_[2]',
						iskm_4 = '$iskm_[2]',
						isgg_4 = '$isgg_[2]',
						contract_worker_4 = '$contract_worker_4',
						contract_end_date_4 = '$contract_end_date_[2]',
						join_note_4 = '$join_note_[2]',

						quit_name_4 = '$quit_name_[2]',
						quit_ssnb_4 = '$quit_ssnb_[2]',
						quit_tel_4 = '$quit_tel_[2]',
						quit_date_4 = '$quit_date_[2]',
						quit_cause_4 = '$quit_cause_[2]',
						quit_cause_text_4 = '$quit_cause_text_[2]',
						quit_sum_now_4 = '$quit_sum_now_[2]',
						quit_sum_now_month_4 = '$quit_sum_now_month_[2]',
						quit_sum_pre_4 = '$quit_sum_pre_[2]',
						quit_sum_pre_month_4 = '$quit_sum_pre_month_[2]',
						quit_3month_4 = '$quit_3month_[2]',

						join_name_5 = '$join_name_[3]',
						join_ssnb_5 = '$join_ssnb_[3]',
						join_date_5 = '$join_date_[3]',
						join_jikjong_5 = '$join_jikjong_[3]',
						join_jikjong_code_5 = '$join_jikjong_code_[3]',
						join_time_5 = '$join_time_[3]',
						join_salary_5 = '$join_salary_[3]',
						isgy_5 = '$isgy_[3]',
						issj_5 = '$issj_[3]',
						iskm_5 = '$iskm_[3]',
						isgg_5 = '$isgg_[3]',
						contract_worker_5 = '$contract_worker_5',
						contract_end_date_5 = '$contract_end_date_[3]',
						join_note_5 = '$join_note_[3]',

						quit_name_5 = '$quit_name_[3]',
						quit_ssnb_5 = '$quit_ssnb_[3]',
						quit_tel_5 = '$quit_tel_[3]',
						quit_date_5 = '$quit_date_[3]',
						quit_cause_5 = '$quit_cause_[3]',
						quit_cause_text_5 = '$quit_cause_text_[3]',
						quit_sum_now_5 = '$quit_sum_now_[3]',
						quit_sum_now_month_5 = '$quit_sum_now_month_[3]',
						quit_sum_pre_5 = '$quit_sum_pre_[3]',
						quit_sum_pre_month_5 = '$quit_sum_pre_month_[3]',
						quit_3month_5 = '$quit_3month_[3]',

						quit_isgy = '$quit_isgy',
						quit_issj = '$quit_issj',
						quit_iskm = '$quit_iskm',
						quit_isgg = '$quit_isgg',
						quit_isgy_2 = '$quit_isgy_2',
						quit_issj_2 = '$quit_issj_2',
						quit_iskm_2 = '$quit_iskm_2',
						quit_isgg_2 = '$quit_isgg_2',
						quit_isgy_3 = '$quit_isgy_3',
						quit_issj_3 = '$quit_issj_3',
						quit_iskm_3 = '$quit_iskm_3',
						quit_isgg_3 = '$quit_isgg_3',
						quit_isgy_4 = '$quit_isgy_4',
						quit_issj_4 = '$quit_issj_4',
						quit_iskm_4 = '$quit_iskm_4',
						quit_isgg_4 = '$quit_isgg_4',
						quit_isgy_5 = '$quit_isgy_5',
						quit_issj_5 = '$quit_issj_5',
						quit_iskm_5 = '$quit_iskm_5',
						quit_isgg_5 = '$quit_isgg_5',

						user_id = '$user_id',
						samu_trust = '$rst_chk',
						wr_datetime = '$now_time' ";

if ($w == 'u'){
	$sql = " update $g4[insure_table] set 
				$sql_common 
			  where id = '$id' ";
	sql_query($sql);
}else{
    $sql = " insert $g4[insure_table] set 
				$sql_common ";
		//echo $sql;
		//exit;
    sql_query($sql);
    $id = mysql_insert_id();
}
/*
//gmail 발송
require_once("../inc/PHPMailer/class.phpmailer.php");

$username = "kidsnomu@gmail.com";
$password = "kcmc1394";

$from_email = "kcmc0023@kcmc4519.cafe24.com";
$form_name = "키즈노무";

$subject = "[키즈노무] 4대보험 취득/상실/변경 신고 접수 되었습니다.";
$content = "<span style='font-size:9pt;'>[키즈노무] ".$comp_name." 4대보험 취득/상실/변경 신고 접수 되었습니다.<p>";
$content .= "<a href=\"http://www.kidsnomu.com/kidsnomu/4insure_list_admin.php\">☞ 4대보험 취득/상실/변경 신고 접수 리스트</a></p><br />";
$content .= "".date("Y-m-d H:i:s")."<p>이 메일 주소로는 회신되지 않습니다.</p></span>";

$to_email = "kcmc4519@naver.com";
$to_name = "한국기업경영원";
$mail = new PHPMailer(true);
$mail->IsSMTP();
try {
  $mail->Host = "smtp.gmail.com";
  $mail->SMTPAuth = true;
  $mail->Port = 465;
  $mail->SMTPSecure = "ssl";
  $mail->Username   = $username;
  $mail->Password   = $password;
  $mail->SetFrom($from_email, $form_name);
  $mail->AddAddress($to_email, $to_name);
	$mail->Subject = $subject;
	$mail->MsgHTML($content);
  $mail->Send();
} catch (phpmailerException $e) {
} catch (Exception $e) {
}
*/
if($mode == "popup") {
	echo "<script>alert(\"정상적으로 신고 접수 되었습니다.\"); close();</script>";
} else {
	alert("정상적으로 신고 접수 되었습니다.","4insure_view.php?id=$id&page=$page");
}
//goto_url("./4insure_list.php");
?>