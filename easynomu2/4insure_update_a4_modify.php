<?
$sub_menu = "100220";
include_once("./_common.php");

//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");
$mktime = mktime();
$user_id = $member['mb_id'];

// 천단위 콤마 제거 DB 저장
$modify_salary = ereg_replace(',', '', $modify_salary);
//보험적용여부
$modify_insurance = $misgy.",".$missj.",".$miskm.",".$misgg;

//첨부파일 경로
$upload_dir = 'files/4insure/';
//echo count($modify_name_);
//exit;
$sql_common = " comp_name = '$comp_name',
						comp_adr = '$comp_adr',
						comp_bznb = '$comp_bznb',
						comp_tel = '$comp_tel',
						comp_email = '$comp_email',
						comp_fax = '$comp_fax',

						modify_name = '$modify_name',
						modify_ssnb = '$modify_ssnb',
						modify_salary = '$modify_salary',
						modify_date = '$modify_date',
						modify_insurance = '$modify_insurance',
						modify_reason = '$modify_reason',
						modify_note = '$modify_note',

						user_id = '$user_id',
						wr_datetime = '$now_time' ";

if ($w == 'u') {
	$sql = " update a4_modify set $sql_common where id = '$id' ";
	sql_query($sql);
	$sql_opt = " delete from a4_modify_opt where mid = $id ";
	sql_query($sql_opt);
} else {
	$sql = " insert a4_modify set $sql_common ";
	//echo $sql."<br>";
	sql_query($sql);
	$id = mysql_insert_id();
	//echo $id;
	//exit;
}
//월평균보수 변경 신고 DB 옵션
//echo $modify_count;
//exit;
//echo $modify_count-2;
$modify_count = count($modify_name_)-1;
for($i=0; $i<=$modify_count; $i++) {
	$k = $i + 2;
	$modify_salary_[$i] = ereg_replace(',', '', $modify_salary_[$i]);
	$modify_insurance_[$i] = $_POST["misgy_".$k].",".$_POST["missj_".$k].",".$_POST["miskm_".$k].",".$_POST["misgg_".$k];
	$sql_common2 = " 
						modify_name = '$modify_name_[$i]',
						modify_ssnb = '$modify_ssnb_[$i]',
						modify_salary = '$modify_salary_[$i]',
						modify_date = '$modify_date_[$i]',
						modify_insurance = '$modify_insurance_[$i]',
						modify_reason = '$modify_reason_[$i]',
						modify_note = '$modify_note_[$i]' ";
	$sql2 = " insert a4_modify_opt set $sql_common2 , mid = '$id' ";
	//echo $sql2."<br>";
	sql_query($sql2);
}
//exit;

//gmail 발송
require_once("../inc/PHPMailer/class.phpmailer.php");

$username = "easynomu.com@gmail.com";
$password = "kcmc1394";

$from_email = "kcmc0023@kcmc4519.cafe24.com";
$form_name = "이지노무";

$subject = "[이지노무] 월평균보수 변경 신고 접수 되었습니다.";
$content = "<span style='font-size:9pt;'>[이지노무] ".$comp_name." 월평균보수 변경 신고 접수 되었습니다.<p>";
$content .= "<a href=\"http://www.easynomu.com/easynomu/a4_modify_list_admin.php\">☞ 월평균보수 변경 신고 접수 리스트</a></p><p>아이디 : master / 패스워드 : 8430<p></p>".date("Y-m-d H:i:s")."<p>이 메일 주소로는 회신되지 않습니다.</p></span>";

$to_email = "kcmc0021@kcmc4519.cafe24.com";
$to_name = "이민화";
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

if($mode == "popup") {
	echo "<script>alert(\"정상적으로 신고 접수 되었습니다.\"); close();</script>";
} else {
	alert("정상적으로 신고 접수 되었습니다.","4insure_view.php?id=$id&page=$page");
}
//goto_url("./4insure_list.php");
?>