<?
$sub_menu = "100220";
include_once("./_common.php");

//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");
$mktime = mktime();
$user_id = $member['mb_id'];

// õ���� �޸� ���� DB ����
$modify_salary = ereg_replace(',', '', $modify_salary);
//�������뿩��
$modify_insurance = $misgy.",".$missj.",".$miskm.",".$misgg;

//÷������ ���
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
//����պ��� ���� �Ű� DB �ɼ�
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

//gmail �߼�
require_once("../inc/PHPMailer/class.phpmailer.php");

$username = "easynomu.com@gmail.com";
$password = "kcmc1394";

$from_email = "kcmc0023@kcmc4519.cafe24.com";
$form_name = "�����빫";

$subject = "[�����빫] ����պ��� ���� �Ű� ���� �Ǿ����ϴ�.";
$content = "<span style='font-size:9pt;'>[�����빫] ".$comp_name." ����պ��� ���� �Ű� ���� �Ǿ����ϴ�.<p>";
$content .= "<a href=\"http://www.easynomu.com/easynomu/a4_modify_list_admin.php\">�� ����պ��� ���� �Ű� ���� ����Ʈ</a></p><p>���̵� : master / �н����� : 8430<p></p>".date("Y-m-d H:i:s")."<p>�� ���� �ּҷδ� ȸ�ŵ��� �ʽ��ϴ�.</p></span>";

$to_email = "kcmc0021@kcmc4519.cafe24.com";
$to_name = "�̹�ȭ";
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
	echo "<script>alert(\"���������� �Ű� ���� �Ǿ����ϴ�.\"); close();</script>";
} else {
	alert("���������� �Ű� ���� �Ǿ����ϴ�.","4insure_view.php?id=$id&page=$page");
}
//goto_url("./4insure_list.php");
?>