<?
$sub_menu = "1900100";
include_once("./_common.php");

//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");
$now_time_only = date("H:i:s");
$now_time_file = date("Ymd_His");
//��ȭ��ȣ
if($com_tel1) $com_tel = $com_tel1."-".$com_tel2."-".$com_tel3;
//�޴���
if($cust_cel1) $com_hp = $cust_cel1."-".$cust_cel2."-".$cust_cel3;
//�����ȣ
if($adr_zip1) $adr_zip = $adr_zip1."-".$adr_zip2;

//÷������ ���
$upload_dir = 'files/job_time/';
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

$sql_common = " regdt = '$regdt',
						com_name = '$com_name',
						upche_div = '$comp_type',
						upjong = '$upjong',
						damdang_code = '$damdang_code',

						comp_bznb = '$comp_bznb',
						com_postno = '$adr_zip',
						com_juso = '$adr_adr1',
						com_juso2 = '$adr_adr2',
						boss_name = '$boss_name',
						com_tel = '$com_tel',
						com_fax = '$com_fax',
						com_hp = '$com_hp',
						com_mail = '$com_mail',
						area = '$area',
						insurance_persons = '$insurance_persons',
						insurance_persons_over = '$insurance_persons_over',

						visitdt = '$visitdt',
						visitdt_time = '$visitdt_time',
						visitdt_ok = '$visitdt_ok',

						memo = '$memo',
						process = '$process',
						process_date = '$process_date',
						writer = '$manage_cust_numb',
						writer_name = '$manage_cust_name',
						manager = '$manager_code',
						manager_name = '$manager_name'
";
//����� ����
$mb_id = $member['mb_id'];
$mb_name = $member['mb_name'];
$mb_nick = $member['mb_nick'];
$mb_profile_code = $member['mb_profile'];
$mb_profile = $man_cust_name_arry[$mb_profile_code];
$branch = $man_cust_name_arry[$damdang_code];
$branch2 = $man_cust_name_arry[$damdang_code2];
//�߰�����
$sql_common2 = " check_ok = '$check_ok',
						job_placement = '$job_placement',
						type_occupation = '$type_occupation',
						charge_job = '$charge_job',
						worktime = '$worktime',
						workday_week = '$workday_week',
						recruit_personnel = '$recruit_personnel',
						distinction_sex = '$distinction_sex',

						$pic_name_sql_1
						$pic_name_sql_2
						$pic_name_sql_3
						$pic_name_sql_4
						$pic_name_sql_5
						$pic_name_sql_6
						$pic_name_sql_7
						$pic_name_sql_8

						recall = '$recall',
						joindt = '$joindt',
						approval = '$approval',
						etc = '$etc',
						etc_user = '$mb_name',
						editdt = '$now_time'
";
//����ڵ�Ϲ�ȣ ��ȸ : ����� com_code ����
if($comp_bznb && !$com_code) {
	$sql_com = " select com_code from com_list_gy where biz_no='$comp_bznb' ";
	$result_com = sql_query($sql_com);
	$row_com = mysql_fetch_array($result_com);
	$com_code = $row_com['com_code'];
} else {
	$com_code = "";
}
//�߰� �ʵ� ������ ����
$sql1 = " select * from job_time_opt where id='$id' ";
$result1 = sql_query($sql1);
$total1 = mysql_num_rows($result1);
//����
if ($w == 'u'){
	$sql = " update job_time set 
				$sql_common 
			  where id = '$id' ";
	//echo $sql;
	//exit;
	sql_query($sql);
	if($total1) {
		$sql2 = " update job_time_opt set 
					$sql_common2 
					where id = '$id' ";
	} else {
		$id = mysql_insert_id();
		$sql2 = " insert job_time_opt set 
					$sql_common2 
					, id = '$id' ";
	}
	//echo $sql2;
	//exit;
	sql_query($sql2);
	alert("���������� �ð������� ������ ���� �Ǿ����ϴ�.","job_time_view.php?id=$id&w=$w&page=$page");
//���
}else{
	$sql = " insert job_time set 
					$sql_common 
					, regtime = '$now_time'
					, com_code = '$com_code' ";
	sql_query($sql);
	if($total1) {
		$sql2 = " update job_time_opt set 
					$sql_common2 
					where id = '$id' ";
	} else {
		$id = mysql_insert_id();
		$sql2 = " insert job_time_opt set 
					$sql_common2 
					, id = '$id' ";
	}
	sql_query($sql2);
  //$id = mysql_insert_id();
	//�湮���� �̵�� ��
	if(!$visitdt) $visitdt = "�湮����";	
	if(!$visitdt_time) $visitdt_time = "����";
	//�ð������� �ű� ��� �˸�
	$wr_subject = $visitdt."(".$visitdt_time.") �ð������� �湮�����Դϴ�.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_cust_numb', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$com_code' , wr_1 = '$id', com_name = '$com_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '40003', alert_name = '�ð�������'
	";
	sql_query($sql_alert);
	alert("���������� �ð������� ������ ��� �Ǿ����ϴ�.","job_time_list.php?page=$page");
}
?>
