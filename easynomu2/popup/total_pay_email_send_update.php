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
//÷������
$upload_path = $_SERVER["DOCUMENT_ROOT"]."/total_pay_result";
$upfile_path = $upload_path."/".$file_name.".xls";
//echo $upfile_path;
//����
if($w == 'u') {
	$sql = " update total_pay set $sql_common where id = '$id' ";
	sql_query($sql);
	//�ű� ��Ͻ� ���� �߼� (�˾�)
	//gmail �߼�
	require_once("../../inc/PHPMailer/class.phpmailer.php");

	$username = "kidsnomu@gmail.com";
	$password = "kcmc1394";

	$from_email = "kidsnomu@gmail.com";
	$form_name = "Ű��빫";

	$subject = "[Ű��빫] 2013�⵵ �����Ѿ� �Ű� ���� �Ϸ� �Ǿ����ϴ�.";
	$content = "<span style='font-size:9pt;'><p>[Ű��빫] 2013�⵵ �����Ѿ� �Ű� ���� �Ϸ� �Ǿ����ϴ�.</p>";
	$content .= "<p><br>������ : ".$comp_name."</p><p>����ڵ�Ϲ�ȣ : ".$comp_bznb."</p><p>�̸��� �ּ� : ".$comp_email."</p><p>�߼����� : ".$now_time."</p><p><br>�� 2013�⵵ �����Ѿ� �Ű� ���� ����� ���Ͽ� ÷�ε� ÷�������� Ȯ���Ͻʽÿ�.</p><p><br>�� ���� �ּҷδ� ȸ�ŵ��� �ʽ��ϴ�.</p></span>";

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
	echo "<script>alert(\"���������� �̸��� �߼� �Ǿ����ϴ�.\"); close();</script>";
}
?>