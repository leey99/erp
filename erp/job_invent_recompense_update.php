<?
$sub_menu = "1900300";
include_once("./_common.php");

//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");
$now_time_file = date("Ymd_His");
$now_date = date("Y.m.d");

//����� ����
$mb_id = $member['mb_id'];
$mb_nick = $member['mb_nick'];
$mb_name = $member['mb_name'];

//÷������ ���
$upload_dir = 'files/job_invent/';
$job_invent_file_sql_1 = "";
$job_invent_file_sql_2 = "";
$job_invent_file_sql_3 = "";
$job_invent_file_sql_4 = "";
$job_invent_file_sql_5 = "";
$job_invent_file_sql_6 = "";
$job_invent_file_sql_7 = "";
$job_invent_file_sql_8 = "";
//÷�μ��� ���� ���
if($job_invent_file_hidden_del_1 == 1) {
	$filename = $upload_dir.$file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(1)�� �������� �ʽ��ϴ�.";
	}
}
if($job_invent_file_hidden_del_2 == 1) {
	$filename = $upload_dir.$file_2;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(2)�� �������� �ʽ��ϴ�.";
	}
}
if($job_invent_file_hidden_del_3 == 1) {
	$filename = $upload_dir.$file_3;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(3)�� �������� �ʽ��ϴ�.";
	}
}
if($job_invent_file_hidden_del_4 == 1) {
	$filename = $upload_dir.$file_4;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(4)�� �������� �ʽ��ϴ�.";
	}
}
if($job_invent_file_hidden_del_5 == 1) {
	$filename = $upload_dir.$file_5;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(5)�� �������� �ʽ��ϴ�.";
	}
}
if($job_invent_file_hidden_del_6 == 1) {
	$filename = $upload_dir.$file_6;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(6)�� �������� �ʽ��ϴ�.";
	}
}
if($job_invent_file_hidden_del_7 == 1) {
	$filename = $upload_dir.$file_7;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(7)�� �������� �ʽ��ϴ�.";
	}
}
if($job_invent_file_hidden_del_8 == 1) {
	$filename = $upload_dir.$file_8;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(8)�� �������� �ʽ��ϴ�.";
	}
}
//÷�μ���1
if($_FILES['job_invent_file_1']['tmp_name']) {
	$pic_name1 = $_FILES['job_invent_file_1']['name'];
	$upload_file_name = $now_time_file."_".$pic_name1;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['job_invent_file_1']['tmp_name'], $upload_file);
} else {
	$pic_name1 = "";
}
if($pic_name1) {
	$job_invent_file_sql_1 = " job_invent_file_1 = '$upload_file_name', ";
} else {
	if($job_invent_file_hidden_del_1 == 1) $job_invent_file_sql_1 = " job_invent_file_1 = '', ";
}
//÷�μ���2
if($_FILES['job_invent_file_2']['tmp_name']) {
	$pic_name2 = $_FILES['job_invent_file_2']['name'];
	$upload_file_name = $now_time_file."_".$pic_name2;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['job_invent_file_2']['tmp_name'], $upload_file);
} else {
	$pic_name2 = "";
}
if($pic_name2) {
	$job_invent_file_sql_2 = " job_invent_file_2 = '$upload_file_name', ";
} else {
	if($job_invent_file_hidden_del_2 == 1) $job_invent_file_sql_2 = " job_invent_file_2 = '', ";
}
//÷�μ���3
if($_FILES['job_invent_file_3']['tmp_name']) {
	$pic_name3 = $_FILES['job_invent_file_3']['name'];
	$upload_file_name = $now_time_file."_".$pic_name3;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['job_invent_file_3']['tmp_name'], $upload_file);
} else {
	$pic_name3 = "";
}
if($pic_name3) {
	$job_invent_file_sql_3 = " job_invent_file_3 = '$upload_file_name', ";
} else {
	if($job_invent_file_hidden_del_3 == 1) $job_invent_file_sql_3 = " job_invent_file_3 = '', ";
}
//÷�μ���4
if($_FILES['job_invent_file_4']['tmp_name']) {
	$pic_name4 = $_FILES['job_invent_file_4']['name'];
	$upload_file_name = $now_time_file."_".$pic_name4;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['job_invent_file_4']['tmp_name'], $upload_file);
} else {
	$pic_name4 = "";
}
if($pic_name4) {
	$job_invent_file_sql_4 = " job_invent_file_4 = '$upload_file_name', ";
} else {
	if($job_invent_file_hidden_del_4 == 1) $job_invent_file_sql_4 = " job_invent_file_4 = '', ";
}
//÷�μ���5
if($_FILES['job_invent_file_5']['tmp_name']) {
	$pic_name5 = $_FILES['job_invent_file_5']['name'];
	$upload_file_name = $now_time_file."_".$pic_name5;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['job_invent_file_5']['tmp_name'], $upload_file);
} else {
	$pic_name5 = "";
}
if($pic_name5) {
	$job_invent_file_sql_5 = " job_invent_file_5 = '$upload_file_name', ";
} else {
	if($job_invent_file_hidden_del_5 == 1) $job_invent_file_sql_5 = " job_invent_file_5 = '', ";
}
//÷�μ���6
if($_FILES['job_invent_file_6']['tmp_name']) {
	$pic_name6 = $_FILES['job_invent_file_6']['name'];
	$upload_file_name = $now_time_file."_".$pic_name6;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['job_invent_file_6']['tmp_name'], $upload_file);
} else {
	$pic_name6 = "";
}
if($pic_name6) {
	$job_invent_file_sql_6 = " job_invent_file_6 = '$upload_file_name', ";
} else {
	if($job_invent_file_hidden_del_6 == 1) $job_invent_file_sql_6 = " job_invent_file_6 = '', ";
}
//÷�μ���7
if($_FILES['job_invent_file_7']['tmp_name']) {
	$pic_name7 = $_FILES['job_invent_file_7']['name'];
	$upload_file_name = $now_time_file."_".$pic_name7;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['job_invent_file_7']['tmp_name'], $upload_file);
} else {
	$pic_name7 = "";
}
if($pic_name7) {
	$job_invent_file_sql_7 = " job_invent_file_7 = '$upload_file_name', ";
} else {
	if($job_invent_file_hidden_del_7 == 1) $job_invent_file_sql_7 = " job_invent_file_7 = '', ";
}
//÷�μ���8
if($_FILES['job_invent_file_8']['tmp_name']) {
	$pic_name8 = $_FILES['job_invent_file_8']['name'];
	$upload_file_name = $now_time_file."_".$pic_name8;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['job_invent_file_8']['tmp_name'], $upload_file);
} else {
	$pic_name8 = "";
}
if($pic_name8) {
	$job_invent_file_sql_8 = " job_invent_file_8 = '$upload_file_name', ";
} else {
	if($job_invent_file_hidden_del_8 == 1) $job_invent_file_sql_8 = " job_invent_file_8 = '', ";
}

//���� ����
if($member['mb_level'] > 6) {
	//�������� ���� �߰� 160517 / �г� 160614
	$sql_common_master = "
						job_invent_process = '$job_invent_process',
	";
} else {
	$sql_common_master = "";
}
//����� �⺻����
$sql_common = "
						job_invent_no = '$job_invent_no',
						job_invent_down_payment = '$job_invent_down_payment',
						job_invent_down_payment_date = '$job_invent_down_payment_date',
						job_invent_remainder = '$job_invent_remainder',
						job_invent_fee = '$job_invent_fee',

						$sql_common_master

						job_invent_memo = '$job_invent_memo',

						$job_invent_file_sql_1
						$job_invent_file_sql_2
						$job_invent_file_sql_3
						$job_invent_file_sql_4
						$job_invent_file_sql_5
						$job_invent_file_sql_6
						$job_invent_file_sql_7
						$job_invent_file_sql_8

						job_invent_user = '$mb_name',
						job_invent_editdt = '$now_time'
";
$sql = " update com_list_gy_opt2 set $sql_common where com_code = '$id' ";
//echo $sql;
//exit;
sql_query($sql);
//�̷� DB ����
$sql_samu_history = " insert job_invent_history set 
		com_code = '$id', w_date='$now_time', w_user = '$mb_id', w_name = '$mb_nick', job_invent_process = '$job_invent_process', 
		job_invent_no = '$job_invent_no', job_invent_down_payment = '$job_invent_down_payment', job_invent_down_payment_date = '$job_invent_down_payment_date', 
		job_invent_remainder = '$job_invent_remainder', job_invent_fee = '$job_invent_fee', 
		job_invent_memo = '$job_invent_memo'
";
sql_query($sql_samu_history);

alert("���������� �����߸������� ������ ���� �Ǿ����ϴ�.","job_invent_recompense_view.php?id=".$id."&w=".$w."&page=".$page."&".$qstr."&".$stx_qstr);
?>