<?
$sub_menu = "800100";
include_once("./_common.php");

$now_time = date("Y-m-d H:i:s");
$now_time_file = date("Ymd_His");
$now_date = date("Y.m.d");
// �޴���
if($emp_cel1) $emp_cel = $emp_cel1."-".$emp_cel2."-".$emp_cel3;
//��ȭ��ȣ
if($emp_tel1) $emp_tel = $emp_tel1."-".$emp_tel2."-".$emp_tel3;
//�ѽ���ȣ
if($emp_fax1) $emp_fax = $emp_fax1."-".$emp_fax2."-".$emp_fax3;

//÷������ ���
$upload_dir = 'files/images/';

//�������
if($_FILES['filename_1']['tmp_name']) {
	$pic_name1 = $_FILES['filename_1']['name'];
	$upload_file_name = $mb_id.".jpg";
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_1']['tmp_name'], $upload_file);
}
if($pic_name1) {
	$pic_name_sql = " filename_1 = '$upload_file_name', ";
} else {
	$pic_name_sql = "";
}
//��й�ȣ mysql ��ȣȭ
$sql_password = " mb_password = '".sql_password($mb_password)."', ";

//ȸ�� DB
$sql_common = " mb_nick = '$mb_nick',

						mb_pass = '$mb_password',
						$sql_password

						mb_tel = '$emp_tel',
						mb_hp = '$emp_cel',
						mb_email = '$emp_email',

						mb_zip1 = '$adr_zip1',
						mb_zip2 = '$adr_zip2',
						mb_addr1 = '$adr_adr1',
						mb_addr2 = '$adr_adr2',

						mb_memo_call = '$mb_memo_call',
						mb_modify_date = '$now_time'
";

//�Ŵ��� DB
$sql_common2 = " name = '$mb_nick',
						tel = '$emp_tel',
						fax = '$emp_fax',
						hp = '$emp_cel',
						email = '$emp_email'
";
$sql = " update a4_member set 
			$sql_common 
			where mb_id = '$mb_id' ";
sql_query($sql);
//���� ������ ���ڵ� ������Ʈ 161005
$sql2 = " update a4_manage set 
			$sql_common2 
			where user_id = '$mb_id' and state = 1 ";
sql_query($sql2);

//������� DB ���� 160419
$sql_common_approval = " approval1='$approval1', approval2='$approval2', approval3='$approval3', approval4='$approval4', approval5='$approval5', code='$code', user_name='$mb_nick' ";
$sql_approval_chk = " select * from business_approval where user_id='$mb_id' ";
$result_approval_chk = sql_query($sql_approval_chk);
$total_approval_chk = mysql_num_rows($result_approval_chk);
if($total_approval_chk) {
	$sql_approval = " update business_approval set $sql_common_approval where user_id = '$mb_id' ";
} else {
	$sql_approval = " insert business_approval set $sql_common_approval , user_id = '$mb_id' ";
}
sql_query($sql_approval);

alert("���������� ȸ�������� ���� �Ǿ����ϴ�.","setup_member_info.php");
?>
