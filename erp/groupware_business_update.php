<?
$sub_menu = "700100";
include_once("./_common.php");

//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");
$now_time_file = date("Ymd_His");
$now_date = date("Y.m.d");

//÷������ ���
$upload_dir = 'files/business_log/';
$pic_name_sql_1 = "";
$pic_name_sql_2 = "";
$pic_name_sql_3 = "";
$pic_name_sql_4 = "";
$pic_name_sql_5 = "";
$pic_name_sql_6 = "";
$pic_name_sql_7 = "";
$pic_name_sql_8 = "";

//÷�μ��� ���� ���
if($file_del_1 == 1) {
	$filename = $upload_dir.$file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(1)�� �������� �ʽ��ϴ�.";
	}
}
if($file_del_2 == 1) {
	$filename = $upload_dir.$file_2;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(2)�� �������� �ʽ��ϴ�.";
	}
}
if($file_del_3 == 1) {
	$filename = $upload_dir.$file_3;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(3)�� �������� �ʽ��ϴ�.";
	}
}
if($file_del_4 == 1) {
	$filename = $upload_dir.$file_4;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(4)�� �������� �ʽ��ϴ�.";
	}
}
if($file_del_5 == 1) {
	$filename = $upload_dir.$file_5;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(5)�� �������� �ʽ��ϴ�.";
	}
}
if($file_del_6 == 1) {
	$filename = $upload_dir.$file_6;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(6)�� �������� �ʽ��ϴ�.";
	}
}
if($file_del_7 == 1) {
	$filename = $upload_dir.$file_7;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(7)�� �������� �ʽ��ϴ�.";
	}
}
if($file_del_8 == 1) {
	$filename = $upload_dir.$file_8;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(8)�� �������� �ʽ��ϴ�.";
	}
}
//÷�μ���1
if($_FILES['filename_1']['tmp_name']) {
	$pic_name1 = $_FILES['filename_1']['name'];
	$upload_file_name = $now_time_file."_".$pic_name1;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_1']['tmp_name'], $upload_file);
}
if($pic_name1) {
	$pic_name_sql_1 = " filename_1 = '$upload_file_name', ";
} else {
	if($file_del_1 == 1) $pic_name_sql_1 = " filename_1 = '', ";
}
//÷�μ���2
if($_FILES['filename_2']['tmp_name']) {
	$pic_name2 = $_FILES['filename_2']['name'];
	$upload_file_name = $now_time_file."_".$pic_name2;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_2']['tmp_name'], $upload_file);
}
if($pic_name2) {
	$pic_name_sql_2 = " filename_2 = '$upload_file_name', ";
} else {
	if($file_del_2 == 1) $pic_name_sql_2 = " filename_2 = '', ";
}
//÷�μ���3
if($_FILES['filename_3']['tmp_name']) {
	$pic_name3 = $_FILES['filename_3']['name'];
	$upload_file_name = $now_time_file."_".$pic_name3;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_3']['tmp_name'], $upload_file);
}
if($pic_name3) {
	$pic_name_sql_3 = " filename_3 = '$upload_file_name', ";
} else {
	if($file_del_3 == 1) $pic_name_sql_3 = " filename_3 = '', ";
}
//÷�μ���4
if($_FILES['filename_4']['tmp_name']) {
	$pic_name4 = $_FILES['filename_4']['name'];
	$upload_file_name = $now_time_file."_".$pic_name4;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_4']['tmp_name'], $upload_file);
}
if($pic_name4) {
	$pic_name_sql_4 = " filename_4 = '$upload_file_name', ";
} else {
	if($file_del_4 == 1) $pic_name_sql_4 = " filename_4 = '', ";
}
//÷�μ���5
if($_FILES['filename_5']['tmp_name']) {
	$pic_name5 = $_FILES['filename_5']['name'];
	$upload_file_name = $now_time_file."_".$pic_name5;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_5']['tmp_name'], $upload_file);
}
if($pic_name5) {
	$pic_name_sql_5 = " filename_5 = '$upload_file_name', ";
} else {
	if($file_del_5 == 1) $pic_name_sql_5 = " filename_5 = '', ";
}
//÷�μ���6
if($_FILES['filename_6']['tmp_name']) {
	$pic_name6 = $_FILES['filename_6']['name'];
	$upload_file_name = $now_time_file."_".$pic_name6;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_6']['tmp_name'], $upload_file);
}
if($pic_name6) {
	$pic_name_sql_6 = " filename_6 = '$upload_file_name', ";
} else {
	if($file_del_6 == 1) $pic_name_sql_6 = " filename_6 = '', ";
}
//÷�μ���7
if($_FILES['filename_7']['tmp_name']) {
	$pic_name7 = $_FILES['filename_7']['name'];
	$upload_file_name = $now_time_file."_".$pic_name7;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_7']['tmp_name'], $upload_file);
}
if($pic_name7) {
	$pic_name_sql_7 = " filename_7 = '$upload_file_name', ";
} else {
	if($file_del_7 == 1) $pic_name_sql_7 = " filename_7 = '', ";
}
//÷�μ���8
if($_FILES['filename_8']['tmp_name']) {
	$pic_name8 = $_FILES['filename_8']['name'];
	$upload_file_name = $now_time_file."_".$pic_name8;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_8']['tmp_name'], $upload_file);
}
if($pic_name8) {
	$pic_name_sql_8 = " filename_8 = '$upload_file_name', ";
} else {
	if($file_del_8 == 1) $pic_name_sql_8 = " filename_8 = '', ";
}

//�ڵ� �����۸�ũ 160622
/*
$pattern = "/(mms|http|HTTP|ftp|FTP|telnet|TELNET)\:\/\/(.[^ \n\<\"\']+)/";
$work_forenoon = preg_replace($pattern, "<a href=\"\\1://\\2\" target=\"_blank\">\\1://\\2</a>", $work_forenoon);
$work_afternoon = preg_replace($pattern, "<a href=\"\\1://\\2\" target=\"_blank\">\\1://\\2</a>", $work_afternoon);
$work_night = preg_replace($pattern, "<a href=\"\\1://\\2\" target=\"_blank\">\\1://\\2</a>", $work_night);
*/

//DB �ʵ�, memo(Ư�̻���)
$sql_common = " regdt = '$now_time',
						drafter_code = '$manage_cust_numb',
						drafter_name = '$manage_cust_name',
						dept_code = '$dept_code',
						subject = '$subject',
						subject_date = '$subject_date',
						approval1 = '$approval_1',
						approval2 = '$approval_2',
						approval3 = '$approval_3',
						approval4 = '$approval_4',
						approval5 = '$approval_5',

						work_forenoon = '$work_forenoon',
						work_afternoon = '$work_afternoon',
						work_night = '$work_night',
						work_plan = '$work_plan',

						$pic_name_sql_1
						$pic_name_sql_2
						$pic_name_sql_3
						$pic_name_sql_4
						$pic_name_sql_5
						$pic_name_sql_6
						$pic_name_sql_7
						$pic_name_sql_8

						memo = '$memo'
";
//TM �ݼ� DB ����
$sql_common_call = " call_consult='$count_today_consult', call_schedule='$count_today_schedule', call_memo='$count_today_memo' ";
$sql_call_chk = " select * from tm_call_count where mb_code='$manage_cust_numb' and call_date='$subject_date' ";
$result_call_chk = sql_query($sql_call_chk);
$total_call_chk = mysql_num_rows($result_call_chk);
if($total_call_chk) {
	$sql_call = " update tm_call_count set $sql_common_call where mb_code='$manage_cust_numb' and call_date='$subject_date' ";
} else {
	$sql_call = " insert tm_call_count set $sql_common_call , mb_code='$manage_cust_numb', call_date='$subject_date' ";
}
sql_query($sql_call);

//��� ��ư Ŭ��
if($report_bt) {
	if ($w == 'u'){
		$sql = " update business_log set $sql_common , approval1_process=1, approval2_process=1, approval3_process=1, approval4_process=1, approval5_process=1 where id = '$id' ";
		sql_query($sql);
	} else {
		$sql = " insert business_log set $sql_common , approval1_process=1, approval2_process=1, approval3_process=1, approval4_process=1, approval5_process=1 ";
		sql_query($sql);
	}
//�������� ���� �ö���� ������ �ڵ� �˸� ���� 160425
/*
	//������ο� ���Ե� �����ڿ��� �˸� �߼�
	for($i=1; $i<=$approval_cnt; $i++) {
		$approval .= $_POST['approval_'.$i].",";
	}
	//�α��� ���� ����
	$damdang_code = 1;
	$mb_id = $member['mb_id'];
	$mb_name = $member['mb_name'];
	$mb_nick = $member['mb_nick'];
	$mb_profile_code = $member['mb_profile'];
	$mb_profile = $man_cust_name_arry[$mb_profile_code];
	$branch = $man_cust_name_arry[$damdang_code];
	$branch2 = $man_cust_name_arry[$damdang_code2];
	//�������� �ű� ��� �˸�
	$wr_subject = $subject." ��� �Ǿ����ϴ�.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', user_code = '$manage_cust_numb', user_name = '$mb_name', user_id = '$mb_id', 
			send_to = '$approval', wr_1 = '$id',
			wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '90003', alert_name = '��������'
	";
	//echo $sql_alert;
	//exit;
	sql_query($sql_alert);
*/
	alert("���������� ���������� ��� �Ǿ����ϴ�.","groupware_business_log.php?stx_process=all");
} else {
	if ($w == 'u'){
		$sql = " update business_log set $sql_common where id = '$id' ";
		sql_query($sql);
	} else {
		$sql = " insert business_log set $sql_common ";
		sql_query($sql);
	}
	alert("���������� ���������� �ӽ����� �Ǿ����ϴ�.","groupware_business_log.php?stx_process=all");
}
?>
