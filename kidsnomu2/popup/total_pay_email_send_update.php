<?
//$mode = "popup";
$member['mb_id'] = "test";
$sub_menu = "100200";
include_once("./_common.php");

//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");

$sql_common = " 
						email_send = '1'
";
//첨부파일
$upload_path = $_SERVER["DOCUMENT_ROOT"]."/total_pay_result";
$upfile_path = $upload_path."/".$file_name.".xls";
//echo $upfile_path;
//수정
if($w == 'u') {
	$sql = " update total_pay set $sql_common where id = '$id' ";
	sql_query($sql);
	//신규 등록시 메일 발송 (팝업)
	//gmail 발송
	require_once("../../inc/PHPMailer/class.phpmailer.php");

	$username = "kidsnomu@gmail.com";
	$password = "kcmc1394";

	$from_email = "kidsnomu@gmail.com";
	$form_name = "키즈노무";

	$subject = "[키즈노무] 2013년도 보수총액 신고 접수 완료 되었습니다.";
	$content = "<span style='font-size:9pt;'><p>[키즈노무] 2013년도 보수총액 신고 접수 완료 되었습니다.</p>";
	$content .= "<p><br>사업장명 : ".$comp_name."</p><p>사업자등록번호 : ".$comp_bznb."</p><p>이메일 주소 : ".$comp_email."</p><p>발송일자 : ".$now_time."</p><p><br>※ 2013년도 보수총액 신고 접수 결과를 메일에 첨부된 첨부파일을 확인하십시오.</p><p><br>이 메일 주소로는 회신되지 않습니다.</p></span>";

	$to_email = $comp_email;
	$to_name = $comp_name;
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
		$mail->AddAttachment($upfile_path);
		$mail->MsgHTML($content);
		$mail->Send();
	} catch (phpmailerException $e) {
	} catch (Exception $e) {
	}
	echo "<script>alert(\"정상적으로 이메일 발송 되었습니다.\"); close();</script>";
}
?>