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

//����� �⺻���� ȣ��
$sql_com = "select * from com_list_gy where com_code = '$id' ";
$row_com = sql_fetch($sql_com);

//����� �߰����� opt ȣ��
$sql_com_opt = "select * from com_list_gy_opt where com_code = '$id' ";
$row_com_opt = sql_fetch($sql_com_opt);

//����Ϸ��� �Է� �� �ڵ� ����Ϸ� ó�� 160517
if($electric_date_finish && $row_com['electric_date_finish'] != $electric_date_finish) {
	$electric_charges_process = 7;
	$electric_charges_process_sql = " electric_charges_process = '".$electric_charges_process."', ";
}

//����� �⺻����
$sql_common = "
						electric_date_estimate = '$electric_date_estimate',
						electric_date_expect = '$electric_date_expect',
						electric_date_finish = '$electric_date_finish',
						electric_charges_memo2 = '$electric_charges_memo2',

						$electric_charges_process_sql

						electric_charges_user = '$mb_name',
						electric_charges_editdt = '$now_time'
";
$sql = " update com_list_gy set $sql_common where com_code = '$id' ";
//echo $sql;
//exit;
sql_query($sql);
//�̷� DB ����
$sql_samu_history = " insert electric_charges_history set 
		com_code = '$id', w_date='$now_time', w_user = '$mb_id', w_name = '$mb_nick', electric_charges_process = '$electric_charges_process', 
		electric_charges_no = '$electric_charges_no', electric_charges_watt = '$electric_charges_watt', electric_charges_year_fee = '$electric_charges_year_fee', 
		electric_charges_payments = '$electric_charges_payments', electric_charges_reduce = '$electric_charges_reduce', 
		electric_charges_etc = '$electric_charges_etc'
";
sql_query($sql_samu_history);

//÷������ ���
$upload_dir = 'files/electric_charges/';
$file_sql_1 = "";
$file_sql_2 = "";
$file_sql_3 = "";
$file_sql_4 = "";
$file_sql_5 = "";
$file_sql_6 = "";
$file_sql_7 = "";
$file_sql_8 = "";
//÷�μ��� ���� ���
if($file_hidden_del_1 == 1) {
	$filename = $upload_dir.$file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(1)�� �������� �ʽ��ϴ�.";
	}
}
if($file_hidden_del_2 == 1) {
	$filename = $upload_dir.$file_2;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(2)�� �������� �ʽ��ϴ�.";
	}
}
if($file_hidden_del_3 == 1) {
	$filename = $upload_dir.$file_3;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(3)�� �������� �ʽ��ϴ�.";
	}
}
if($file_hidden_del_4 == 1) {
	$filename = $upload_dir.$file_4;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(4)�� �������� �ʽ��ϴ�.";
	}
}
if($file_hidden_del_5 == 1) {
	$filename = $upload_dir.$file_5;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(5)�� �������� �ʽ��ϴ�.";
	}
}
if($file_hidden_del_6 == 1) {
	$filename = $upload_dir.$file_6;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(6)�� �������� �ʽ��ϴ�.";
	}
}
if($file_hidden_del_7 == 1) {
	$filename = $upload_dir.$file_7;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(7)�� �������� �ʽ��ϴ�.";
	}
}
if($file_hidden_del_8 == 1) {
	$filename = $upload_dir.$file_8;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(8)�� �������� �ʽ��ϴ�.";
	}
}
//÷�μ���1
if($_FILES['file_1']['tmp_name']) {
	$pic_name1 = $_FILES['file_1']['name'];
	$upload_construct_name = $now_time_file."_".$pic_name1;
	$upload_construct = $upload_dir.$upload_construct_name;
	move_uploaded_file($_FILES['file_1']['tmp_name'], $upload_construct);
} else {
	$pic_name1 = "";
}
if($pic_name1) {
	$file_sql_1 = " file_1 = '$upload_construct_name', ";
} else {
	if($file_hidden_del_1 == 1) $file_sql_1 = " file_1 = '', ";
}
//÷�μ���2
if($_FILES['file_2']['tmp_name']) {
	$pic_name2 = $_FILES['file_2']['name'];
	$upload_construct_name = $now_time_file."_".$pic_name2;
	$upload_construct = $upload_dir.$upload_construct_name;
	move_uploaded_file($_FILES['file_2']['tmp_name'], $upload_construct);
} else {
	$pic_name2 = "";
}
if($pic_name2) {
	$file_sql_2 = " file_2 = '$upload_construct_name', ";
} else {
	if($file_hidden_del_2 == 1) $file_sql_2 = " file_2 = '', ";
}
//÷�μ���3
if($_FILES['file_3']['tmp_name']) {
	$pic_name3 = $_FILES['file_3']['name'];
	$upload_construct_name = $now_time_file."_".$pic_name3;
	$upload_construct = $upload_dir.$upload_construct_name;
	move_uploaded_file($_FILES['file_3']['tmp_name'], $upload_construct);
} else {
	$pic_name3 = "";
}
if($pic_name3) {
	$file_sql_3 = " file_3 = '$upload_construct_name', ";
} else {
	if($file_hidden_del_3 == 1) $file_sql_3 = " file_3 = '', ";
}
//÷�μ���4
if($_FILES['file_4']['tmp_name']) {
	$pic_name4 = $_FILES['file_4']['name'];
	$upload_construct_name = $now_time_file."_".$pic_name4;
	$upload_construct = $upload_dir.$upload_construct_name;
	move_uploaded_file($_FILES['file_4']['tmp_name'], $upload_construct);
} else {
	$pic_name4 = "";
}
if($pic_name4) {
	$file_sql_4 = " file_4 = '$upload_construct_name', ";
} else {
	if($file_hidden_del_4 == 1) $file_sql_4 = " file_4 = '', ";
}
//÷�μ���5
if($_FILES['file_5']['tmp_name']) {
	$pic_name5 = $_FILES['file_5']['name'];
	$upload_construct_name = $now_time_file."_".$pic_name5;
	$upload_construct = $upload_dir.$upload_construct_name;
	move_uploaded_file($_FILES['file_5']['tmp_name'], $upload_construct);
} else {
	$pic_name5 = "";
}
if($pic_name5) {
	$file_sql_5 = " file_5 = '$upload_construct_name', ";
} else {
	if($file_hidden_del_5 == 1) $file_sql_5 = " file_5 = '', ";
}
//÷�μ���6
if($_FILES['file_6']['tmp_name']) {
	$pic_name6 = $_FILES['file_6']['name'];
	$upload_construct_name = $now_time_file."_".$pic_name6;
	$upload_construct = $upload_dir.$upload_construct_name;
	move_uploaded_file($_FILES['file_6']['tmp_name'], $upload_construct);
} else {
	$pic_name6 = "";
}
if($pic_name6) {
	$file_sql_6 = " file_6 = '$upload_construct_name', ";
} else {
	if($file_hidden_del_6 == 1) $file_sql_6 = " file_6 = '', ";
}
//÷�μ���7
if($_FILES['file_7']['tmp_name']) {
	$pic_name7 = $_FILES['file_7']['name'];
	$upload_construct_name = $now_time_file."_".$pic_name7;
	$upload_construct = $upload_dir.$upload_construct_name;
	move_uploaded_file($_FILES['file_7']['tmp_name'], $upload_construct);
} else {
	$pic_name7 = "";
}
if($pic_name7) {
	$file_sql_7 = " file_7 = '$upload_construct_name', ";
} else {
	if($file_hidden_del_7 == 1) $file_sql_7 = " file_7 = '', ";
}
//÷�μ���8
if($_FILES['file_8']['tmp_name']) {
	$pic_name8 = $_FILES['file_8']['name'];
	$upload_construct_name = $now_time_file."_".$pic_name8;
	$upload_construct = $upload_dir.$upload_construct_name;
	move_uploaded_file($_FILES['file_8']['tmp_name'], $upload_construct);
} else {
	$pic_name8 = "";
}
if($pic_name8) {
	$file_sql_8 = " file_8 = '$upload_construct_name', ";
} else {
	if($file_hidden_del_8 == 1) $file_sql_8 = " file_8 = '', ";
}

//������ ���� Ȯ�� / and w_user = '$mb_id' ���� �߰�, ��������ü ���� ���� ���ε� 161108
$sql_file = " select * from electric_charges_file where com_code='$id' and w_user = '$mb_id' ";
$result_file = sql_query($sql_file);
$total_file = mysql_num_rows($result_file);

//��������ü ÷�μ��� 161006
$sql_common_file = "
						$file_sql_1
						$file_sql_2
						$file_sql_3
						$file_sql_4
						$file_sql_5
						$file_sql_6
						$file_sql_7
						$file_sql_8
						w_name = '$mb_nick'
";
if($total_file) $sql_file = " update electric_charges_file set $sql_common_file where com_code = '$id' and w_user = '$mb_id' ";
else $sql_file = " insert electric_charges_file set $sql_common_file , w_user = '$mb_id', com_code = '$id' ";
//echo $sql_file;
//exit;
sql_query($sql_file);
alert("���������� ������������ ������ ���� �Ǿ����ϴ�.","electric_charges_contractor_view.php?id=".$id."&w=".$w."&page=".$page."&".$qstr."&".$stx_qstr);
?>