<?
$sub_menu = "1900300";
include_once("./_common.php");

//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");
$now_time_file = date("Ymd_His");
$now_date = date("Y.m.d");

//ȸ�� ���� ���� : ��ٿ� ��� 9����
if($member['mb_profile'] == 1 && $member['mb_level'] == 4) $member['mb_level'] = 9;

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

//÷������ ���
$upload_dir = 'files/electric_charges/';
$electric_charges_file_sql_1 = "";
$electric_charges_file_sql_2 = "";
$electric_charges_file_sql_3 = "";
$electric_charges_file_sql_4 = "";
$electric_charges_file_sql_5 = "";
$electric_charges_file_sql_6 = "";
$electric_charges_file_sql_7 = "";
$electric_charges_file_sql_8 = "";
//÷�μ��� ���� ���
if($electric_charges_file_hidden_del_1 == 1) {
	$filename = $upload_dir.$file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(1)�� �������� �ʽ��ϴ�.";
	}
}
if($electric_charges_file_hidden_del_2 == 1) {
	$filename = $upload_dir.$file_2;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(2)�� �������� �ʽ��ϴ�.";
	}
}
if($electric_charges_file_hidden_del_3 == 1) {
	$filename = $upload_dir.$file_3;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(3)�� �������� �ʽ��ϴ�.";
	}
}
if($electric_charges_file_hidden_del_4 == 1) {
	$filename = $upload_dir.$file_4;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(4)�� �������� �ʽ��ϴ�.";
	}
}
if($electric_charges_file_hidden_del_5 == 1) {
	$filename = $upload_dir.$file_5;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(5)�� �������� �ʽ��ϴ�.";
	}
}
if($electric_charges_file_hidden_del_6 == 1) {
	$filename = $upload_dir.$file_6;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(6)�� �������� �ʽ��ϴ�.";
	}
}
if($electric_charges_file_hidden_del_7 == 1) {
	$filename = $upload_dir.$file_7;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(7)�� �������� �ʽ��ϴ�.";
	}
}
if($electric_charges_file_hidden_del_8 == 1) {
	$filename = $upload_dir.$file_8;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(8)�� �������� �ʽ��ϴ�.";
	}
}
//÷�μ���1
if($_FILES['electric_charges_file_1']['tmp_name']) {
	$pic_name1 = $_FILES['electric_charges_file_1']['name'];
	$upload_file_name = $now_time_file."_".$pic_name1;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['electric_charges_file_1']['tmp_name'], $upload_file);
} else {
	$pic_name1 = "";
}
if($pic_name1) {
	$electric_charges_file_sql_1 = " electric_charges_file_1 = '$upload_file_name', ";
} else {
	if($electric_charges_file_hidden_del_1 == 1) $electric_charges_file_sql_1 = " electric_charges_file_1 = '', ";
}
//÷�μ���2
if($_FILES['electric_charges_file_2']['tmp_name']) {
	$pic_name2 = $_FILES['electric_charges_file_2']['name'];
	$upload_file_name = $now_time_file."_".$pic_name2;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['electric_charges_file_2']['tmp_name'], $upload_file);
} else {
	$pic_name2 = "";
}
if($pic_name2) {
	$electric_charges_file_sql_2 = " electric_charges_file_2 = '$upload_file_name', ";
} else {
	if($electric_charges_file_hidden_del_2 == 1) $electric_charges_file_sql_2 = " electric_charges_file_2 = '', ";
}
//÷�μ���3
if($_FILES['electric_charges_file_3']['tmp_name']) {
	$pic_name3 = $_FILES['electric_charges_file_3']['name'];
	$upload_file_name = $now_time_file."_".$pic_name3;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['electric_charges_file_3']['tmp_name'], $upload_file);
} else {
	$pic_name3 = "";
}
if($pic_name3) {
	$electric_charges_file_sql_3 = " electric_charges_file_3 = '$upload_file_name', ";
} else {
	if($electric_charges_file_hidden_del_3 == 1) $electric_charges_file_sql_3 = " electric_charges_file_3 = '', ";
}
//÷�μ���4
if($_FILES['electric_charges_file_4']['tmp_name']) {
	$pic_name4 = $_FILES['electric_charges_file_4']['name'];
	$upload_file_name = $now_time_file."_".$pic_name4;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['electric_charges_file_4']['tmp_name'], $upload_file);
} else {
	$pic_name4 = "";
}
if($pic_name4) {
	$electric_charges_file_sql_4 = " electric_charges_file_4 = '$upload_file_name', ";
} else {
	if($electric_charges_file_hidden_del_4 == 1) $electric_charges_file_sql_4 = " electric_charges_file_4 = '', ";
}
//÷�μ���5
if($_FILES['electric_charges_file_5']['tmp_name']) {
	$pic_name5 = $_FILES['electric_charges_file_5']['name'];
	$upload_file_name = $now_time_file."_".$pic_name5;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['electric_charges_file_5']['tmp_name'], $upload_file);
} else {
	$pic_name5 = "";
}
if($pic_name5) {
	$electric_charges_file_sql_5 = " electric_charges_file_5 = '$upload_file_name', ";
} else {
	if($electric_charges_file_hidden_del_5 == 1) $electric_charges_file_sql_5 = " electric_charges_file_5 = '', ";
}
//÷�μ���6
if($_FILES['electric_charges_file_6']['tmp_name']) {
	$pic_name6 = $_FILES['electric_charges_file_6']['name'];
	$upload_file_name = $now_time_file."_".$pic_name6;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['electric_charges_file_6']['tmp_name'], $upload_file);
} else {
	$pic_name6 = "";
}
if($pic_name6) {
	$electric_charges_file_sql_6 = " electric_charges_file_6 = '$upload_file_name', ";
} else {
	if($electric_charges_file_hidden_del_6 == 1) $electric_charges_file_sql_6 = " electric_charges_file_6 = '', ";
}
//÷�μ���7
if($_FILES['electric_charges_file_7']['tmp_name']) {
	$pic_name7 = $_FILES['electric_charges_file_7']['name'];
	$upload_file_name = $now_time_file."_".$pic_name7;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['electric_charges_file_7']['tmp_name'], $upload_file);
} else {
	$pic_name7 = "";
}
if($pic_name7) {
	$electric_charges_file_sql_7 = " electric_charges_file_7 = '$upload_file_name', ";
} else {
	if($electric_charges_file_hidden_del_7 == 1) $electric_charges_file_sql_7 = " electric_charges_file_7 = '', ";
}
//÷�μ���8
if($_FILES['electric_charges_file_8']['tmp_name']) {
	$pic_name8 = $_FILES['electric_charges_file_8']['name'];
	$upload_file_name = $now_time_file."_".$pic_name8;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['electric_charges_file_8']['tmp_name'], $upload_file);
} else {
	$pic_name8 = "";
}
if($pic_name8) {
	$electric_charges_file_sql_8 = " electric_charges_file_8 = '$upload_file_name', ";
} else {
	if($electric_charges_file_hidden_del_8 == 1) $electric_charges_file_sql_8 = " electric_charges_file_8 = '', ";
}
//÷������ ���
$upload_dir = 'files/electric_charges/';
$electric_charges_secret_sql_1 = "";
$electric_charges_secret_sql_2 = "";
$electric_charges_secret_sql_3 = "";
$electric_charges_secret_sql_4 = "";
$electric_charges_secret_sql_5 = "";
$electric_charges_secret_sql_6 = "";
$electric_charges_secret_sql_7 = "";
$electric_charges_secret_sql_8 = "";
//÷�μ��� ���� ���
if($electric_charges_secret_hidden_del_1 == 1) {
	$filename = $upload_dir.$file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(1)�� �������� �ʽ��ϴ�.";
	}
}
if($electric_charges_secret_hidden_del_2 == 1) {
	$filename = $upload_dir.$file_2;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(2)�� �������� �ʽ��ϴ�.";
	}
}
if($electric_charges_secret_hidden_del_3 == 1) {
	$filename = $upload_dir.$file_3;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(3)�� �������� �ʽ��ϴ�.";
	}
}
if($electric_charges_secret_hidden_del_4 == 1) {
	$filename = $upload_dir.$file_4;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(4)�� �������� �ʽ��ϴ�.";
	}
}
if($electric_charges_secret_hidden_del_5 == 1) {
	$filename = $upload_dir.$file_5;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(5)�� �������� �ʽ��ϴ�.";
	}
}
if($electric_charges_secret_hidden_del_6 == 1) {
	$filename = $upload_dir.$file_6;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(6)�� �������� �ʽ��ϴ�.";
	}
}
if($electric_charges_secret_hidden_del_7 == 1) {
	$filename = $upload_dir.$file_7;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(7)�� �������� �ʽ��ϴ�.";
	}
}
if($electric_charges_secret_hidden_del_8 == 1) {
	$filename = $upload_dir.$file_8;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(8)�� �������� �ʽ��ϴ�.";
	}
}
//÷�μ���1
if($_FILES['electric_charges_secret_1']['tmp_name']) {
	$pic_name1 = $_FILES['electric_charges_secret_1']['name'];
	$upload_secret_name = $now_time_file."_".$pic_name1;
	$upload_secret = $upload_dir.$upload_secret_name;
	move_uploaded_file($_FILES['electric_charges_secret_1']['tmp_name'], $upload_secret);
} else {
	$pic_name1 = "";
}
if($pic_name1) {
	$electric_charges_secret_sql_1 = " electric_charges_secret_1 = '$upload_secret_name', ";
} else {
	if($electric_charges_secret_hidden_del_1 == 1) $electric_charges_secret_sql_1 = " electric_charges_secret_1 = '', ";
}
//÷�μ���2
if($_FILES['electric_charges_secret_2']['tmp_name']) {
	$pic_name2 = $_FILES['electric_charges_secret_2']['name'];
	$upload_secret_name = $now_time_file."_".$pic_name2;
	$upload_secret = $upload_dir.$upload_secret_name;
	move_uploaded_file($_FILES['electric_charges_secret_2']['tmp_name'], $upload_secret);
} else {
	$pic_name2 = "";
}
if($pic_name2) {
	$electric_charges_secret_sql_2 = " electric_charges_secret_2 = '$upload_secret_name', ";
} else {
	if($electric_charges_secret_hidden_del_2 == 1) $electric_charges_secret_sql_2 = " electric_charges_secret_2 = '', ";
}
//÷�μ���3
if($_FILES['electric_charges_secret_3']['tmp_name']) {
	$pic_name3 = $_FILES['electric_charges_secret_3']['name'];
	$upload_secret_name = $now_time_file."_".$pic_name3;
	$upload_secret = $upload_dir.$upload_secret_name;
	move_uploaded_file($_FILES['electric_charges_secret_3']['tmp_name'], $upload_secret);
} else {
	$pic_name3 = "";
}
if($pic_name3) {
	$electric_charges_secret_sql_3 = " electric_charges_secret_3 = '$upload_secret_name', ";
} else {
	if($electric_charges_secret_hidden_del_3 == 1) $electric_charges_secret_sql_3 = " electric_charges_secret_3 = '', ";
}
//÷�μ���4
if($_FILES['electric_charges_secret_4']['tmp_name']) {
	$pic_name4 = $_FILES['electric_charges_secret_4']['name'];
	$upload_secret_name = $now_time_file."_".$pic_name4;
	$upload_secret = $upload_dir.$upload_secret_name;
	move_uploaded_file($_FILES['electric_charges_secret_4']['tmp_name'], $upload_secret);
} else {
	$pic_name4 = "";
}
if($pic_name4) {
	$electric_charges_secret_sql_4 = " electric_charges_secret_4 = '$upload_secret_name', ";
} else {
	if($electric_charges_secret_hidden_del_4 == 1) $electric_charges_secret_sql_4 = " electric_charges_secret_4 = '', ";
}
//÷�μ���5
if($_FILES['electric_charges_secret_5']['tmp_name']) {
	$pic_name5 = $_FILES['electric_charges_secret_5']['name'];
	$upload_secret_name = $now_time_file."_".$pic_name5;
	$upload_secret = $upload_dir.$upload_secret_name;
	move_uploaded_file($_FILES['electric_charges_secret_5']['tmp_name'], $upload_secret);
} else {
	$pic_name5 = "";
}
if($pic_name5) {
	$electric_charges_secret_sql_5 = " electric_charges_secret_5 = '$upload_secret_name', ";
} else {
	if($electric_charges_secret_hidden_del_5 == 1) $electric_charges_secret_sql_5 = " electric_charges_secret_5 = '', ";
}
//÷�μ���6
if($_FILES['electric_charges_secret_6']['tmp_name']) {
	$pic_name6 = $_FILES['electric_charges_secret_6']['name'];
	$upload_secret_name = $now_time_file."_".$pic_name6;
	$upload_secret = $upload_dir.$upload_secret_name;
	move_uploaded_file($_FILES['electric_charges_secret_6']['tmp_name'], $upload_secret);
} else {
	$pic_name6 = "";
}
if($pic_name6) {
	$electric_charges_secret_sql_6 = " electric_charges_secret_6 = '$upload_secret_name', ";
} else {
	if($electric_charges_secret_hidden_del_6 == 1) $electric_charges_secret_sql_6 = " electric_charges_secret_6 = '', ";
}
//÷�μ���7
if($_FILES['electric_charges_secret_7']['tmp_name']) {
	$pic_name7 = $_FILES['electric_charges_secret_7']['name'];
	$upload_secret_name = $now_time_file."_".$pic_name7;
	$upload_secret = $upload_dir.$upload_secret_name;
	move_uploaded_file($_FILES['electric_charges_secret_7']['tmp_name'], $upload_secret);
} else {
	$pic_name7 = "";
}
if($pic_name7) {
	$electric_charges_secret_sql_7 = " electric_charges_secret_7 = '$upload_secret_name', ";
} else {
	if($electric_charges_secret_hidden_del_7 == 1) $electric_charges_secret_sql_7 = " electric_charges_secret_7 = '', ";
}
//÷�μ���8
if($_FILES['electric_charges_secret_8']['tmp_name']) {
	$pic_name8 = $_FILES['electric_charges_secret_8']['name'];
	$upload_secret_name = $now_time_file."_".$pic_name8;
	$upload_secret = $upload_dir.$upload_secret_name;
	move_uploaded_file($_FILES['electric_charges_secret_8']['tmp_name'], $upload_secret);
} else {
	$pic_name8 = "";
}
if($pic_name8) {
	$electric_charges_secret_sql_8 = " electric_charges_secret_8 = '$upload_secret_name', ";
} else {
	if($electric_charges_secret_hidden_del_8 == 1) $electric_charges_secret_sql_8 = " electric_charges_secret_8 = '', ";
}

//÷������ ���
$upload_dir = 'files/electric_charges/';
$electric_charges_search_sql_1 = "";
//÷�μ��� ���� ���
if($electric_charges_search_hidden_del_1 == 1) {
	$filename = $upload_dir.$file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(1)�� �������� �ʽ��ϴ�.";
	}
}
//÷�μ���1
if($_FILES['electric_charges_search_1']['tmp_name']) {
	$pic_name1 = $_FILES['electric_charges_search_1']['name'];
	$upload_search_name = $now_time_file."_".$pic_name1;
	$upload_search = $upload_dir.$upload_search_name;
	move_uploaded_file($_FILES['electric_charges_search_1']['tmp_name'], $upload_search);
} else {
	$pic_name1 = "";
}
if($pic_name1) {
	$electric_charges_search_sql_1 = " electric_charges_search_1 = '$upload_search_name', ";
} else {
	if($electric_charges_search_hidden_del_1 == 1) $electric_charges_search_sql_1 = " electric_charges_search_1 = '', ";
}

//÷������ ���
$upload_dir = 'files/electric_charges/';
$electric_charges_construct_sql_1 = "";
$electric_charges_construct_sql_2 = "";
$electric_charges_construct_sql_3 = "";
$electric_charges_construct_sql_4 = "";
$electric_charges_construct_sql_5 = "";
$electric_charges_construct_sql_6 = "";
$electric_charges_construct_sql_7 = "";
$electric_charges_construct_sql_8 = "";
//÷�μ��� ���� ���
if($electric_charges_construct_hidden_del_1 == 1) {
	$filename = $upload_dir.$file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(1)�� �������� �ʽ��ϴ�.";
	}
}
if($electric_charges_construct_hidden_del_2 == 1) {
	$filename = $upload_dir.$file_2;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(2)�� �������� �ʽ��ϴ�.";
	}
}
if($electric_charges_construct_hidden_del_3 == 1) {
	$filename = $upload_dir.$file_3;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(3)�� �������� �ʽ��ϴ�.";
	}
}
if($electric_charges_construct_hidden_del_4 == 1) {
	$filename = $upload_dir.$file_4;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(4)�� �������� �ʽ��ϴ�.";
	}
}
if($electric_charges_construct_hidden_del_5 == 1) {
	$filename = $upload_dir.$file_5;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(5)�� �������� �ʽ��ϴ�.";
	}
}
if($electric_charges_construct_hidden_del_6 == 1) {
	$filename = $upload_dir.$file_6;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(6)�� �������� �ʽ��ϴ�.";
	}
}
if($electric_charges_construct_hidden_del_7 == 1) {
	$filename = $upload_dir.$file_7;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(7)�� �������� �ʽ��ϴ�.";
	}
}
if($electric_charges_construct_hidden_del_8 == 1) {
	$filename = $upload_dir.$file_8;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(8)�� �������� �ʽ��ϴ�.";
	}
}
//÷�μ���1
if($_FILES['electric_charges_construct_1']['tmp_name']) {
	$pic_name1 = $_FILES['electric_charges_construct_1']['name'];
	$upload_construct_name = $now_time_file."_".$pic_name1;
	$upload_construct = $upload_dir.$upload_construct_name;
	move_uploaded_file($_FILES['electric_charges_construct_1']['tmp_name'], $upload_construct);
} else {
	$pic_name1 = "";
}
if($pic_name1) {
	$electric_charges_construct_sql_1 = " electric_charges_construct_1 = '$upload_construct_name', ";
} else {
	if($electric_charges_construct_hidden_del_1 == 1) $electric_charges_construct_sql_1 = " electric_charges_construct_1 = '', ";
}
//÷�μ���2
if($_FILES['electric_charges_construct_2']['tmp_name']) {
	$pic_name2 = $_FILES['electric_charges_construct_2']['name'];
	$upload_construct_name = $now_time_file."_".$pic_name2;
	$upload_construct = $upload_dir.$upload_construct_name;
	move_uploaded_file($_FILES['electric_charges_construct_2']['tmp_name'], $upload_construct);
} else {
	$pic_name2 = "";
}
if($pic_name2) {
	$electric_charges_construct_sql_2 = " electric_charges_construct_2 = '$upload_construct_name', ";
} else {
	if($electric_charges_construct_hidden_del_2 == 1) $electric_charges_construct_sql_2 = " electric_charges_construct_2 = '', ";
}
//÷�μ���3
if($_FILES['electric_charges_construct_3']['tmp_name']) {
	$pic_name3 = $_FILES['electric_charges_construct_3']['name'];
	$upload_construct_name = $now_time_file."_".$pic_name3;
	$upload_construct = $upload_dir.$upload_construct_name;
	move_uploaded_file($_FILES['electric_charges_construct_3']['tmp_name'], $upload_construct);
} else {
	$pic_name3 = "";
}
if($pic_name3) {
	$electric_charges_construct_sql_3 = " electric_charges_construct_3 = '$upload_construct_name', ";
} else {
	if($electric_charges_construct_hidden_del_3 == 1) $electric_charges_construct_sql_3 = " electric_charges_construct_3 = '', ";
}
//÷�μ���4
if($_FILES['electric_charges_construct_4']['tmp_name']) {
	$pic_name4 = $_FILES['electric_charges_construct_4']['name'];
	$upload_construct_name = $now_time_file."_".$pic_name4;
	$upload_construct = $upload_dir.$upload_construct_name;
	move_uploaded_file($_FILES['electric_charges_construct_4']['tmp_name'], $upload_construct);
} else {
	$pic_name4 = "";
}
if($pic_name4) {
	$electric_charges_construct_sql_4 = " electric_charges_construct_4 = '$upload_construct_name', ";
} else {
	if($electric_charges_construct_hidden_del_4 == 1) $electric_charges_construct_sql_4 = " electric_charges_construct_4 = '', ";
}
//÷�μ���5
if($_FILES['electric_charges_construct_5']['tmp_name']) {
	$pic_name5 = $_FILES['electric_charges_construct_5']['name'];
	$upload_construct_name = $now_time_file."_".$pic_name5;
	$upload_construct = $upload_dir.$upload_construct_name;
	move_uploaded_file($_FILES['electric_charges_construct_5']['tmp_name'], $upload_construct);
} else {
	$pic_name5 = "";
}
if($pic_name5) {
	$electric_charges_construct_sql_5 = " electric_charges_construct_5 = '$upload_construct_name', ";
} else {
	if($electric_charges_construct_hidden_del_5 == 1) $electric_charges_construct_sql_5 = " electric_charges_construct_5 = '', ";
}
//÷�μ���6
if($_FILES['electric_charges_construct_6']['tmp_name']) {
	$pic_name6 = $_FILES['electric_charges_construct_6']['name'];
	$upload_construct_name = $now_time_file."_".$pic_name6;
	$upload_construct = $upload_dir.$upload_construct_name;
	move_uploaded_file($_FILES['electric_charges_construct_6']['tmp_name'], $upload_construct);
} else {
	$pic_name6 = "";
}
if($pic_name6) {
	$electric_charges_construct_sql_6 = " electric_charges_construct_6 = '$upload_construct_name', ";
} else {
	if($electric_charges_construct_hidden_del_6 == 1) $electric_charges_construct_sql_6 = " electric_charges_construct_6 = '', ";
}
//÷�μ���7
if($_FILES['electric_charges_construct_7']['tmp_name']) {
	$pic_name7 = $_FILES['electric_charges_construct_7']['name'];
	$upload_construct_name = $now_time_file."_".$pic_name7;
	$upload_construct = $upload_dir.$upload_construct_name;
	move_uploaded_file($_FILES['electric_charges_construct_7']['tmp_name'], $upload_construct);
} else {
	$pic_name7 = "";
}
if($pic_name7) {
	$electric_charges_construct_sql_7 = " electric_charges_construct_7 = '$upload_construct_name', ";
} else {
	if($electric_charges_construct_hidden_del_7 == 1) $electric_charges_construct_sql_7 = " electric_charges_construct_7 = '', ";
}
//÷�μ���8
if($_FILES['electric_charges_construct_8']['tmp_name']) {
	$pic_name8 = $_FILES['electric_charges_construct_8']['name'];
	$upload_construct_name = $now_time_file."_".$pic_name8;
	$upload_construct = $upload_dir.$upload_construct_name;
	move_uploaded_file($_FILES['electric_charges_construct_8']['tmp_name'], $upload_construct);
} else {
	$pic_name8 = "";
}
if($pic_name8) {
	$electric_charges_construct_sql_8 = " electric_charges_construct_8 = '$upload_construct_name', ";
} else {
	if($electric_charges_construct_hidden_del_8 == 1) $electric_charges_construct_sql_8 = " electric_charges_construct_8 = '', ";
}

//���� ����, ����� electric_charges_cost �߰� 160127 electric_charges_cost2 �߰� 160212
if($member['mb_level'] > 6) {

	//÷�μ���(������) üũ
	for($i=1;$i<=10;$i++) {
		$e_file_check_var .= $_POST['e_file_check'.$i].",";
	}
	//�������� ���� �߰� 160517 / �г� 160614
	$sql_common_master = "
						electric_charges_etc = '$electric_charges_etc',
						electric_charges_year_fee = '$electric_charges_year_fee',

						electric_charges_cost = '$electric_charges_cost',
						electric_charges_cost2 = '$electric_charges_cost2',

						electric_charges_cost_b = '$electric_charges_cost_b',
						electric_charges_cost2_b = '$electric_charges_cost2_b',

						electric_charges_existing = '$electric_charges_existing',
						electric_charges_watt = '$electric_charges_watt',
						electric_charges_peak = '$electric_charges_peak',

						remainder_date = '$remainder_date',
						kepco_date_accept = '$kepco_date_accept',
						kepco_date_check = '$kepco_date_check',
						electric_date_change = '$electric_date_change',

						electric_date_request = '$electric_date_request',
						electric_date_delivery = '$electric_date_delivery',

						electric_charges_separate = '$electric_charges_separate',
						electric_charges_separate_no= '$electric_charges_separate_no',
						electric_charges_separate_name = '$electric_charges_separate_name',
						electric_charges_separate_memo = '$electric_charges_separate_memo',

						electric_charges_meter_rate = '$electric_charges_meter_rate',
						electric_charges_watt_revision = '$electric_charges_watt_revision',
						electric_charges_reduce = '$electric_charges_reduce',
						electric_charges_payments = '$electric_charges_payments',
						electric_charges_commission = '$electric_charges_commission',

						electric_charges_meter_rate2 = '$electric_charges_meter_rate2',
						electric_charges_watt_revision2 = '$electric_charges_watt_revision2',
						electric_charges_reduce2 = '$electric_charges_reduce2',
						electric_charges_payments2 = '$electric_charges_payments2',
						electric_charges_commission2 = '$electric_charges_commission2',

						$electric_charges_secret_sql_1
						$electric_charges_secret_sql_2
						$electric_charges_secret_sql_3
						$electric_charges_secret_sql_4
						$electric_charges_secret_sql_5
						$electric_charges_secret_sql_6
						$electric_charges_secret_sql_7
						$electric_charges_secret_sql_8

						$electric_charges_search_sql_1

						electric_charges_search_ask = '$electric_charges_search_ask',
						electric_charges_file_check = '$e_file_check_var',

						electric_charges_construct_chk = '$electric_charges_construct_chk',
						electric_charges_construct_chk2 = '$electric_charges_construct_chk2',
						electric_charges_installment = '$electric_charges_installment',

						electric_charges_visit_kind2 = '$electric_charges_visit_kind2',
						electric_charges_visitdt2 = '$electric_charges_visitdt2',
						electric_charges_visitdt_time2 = '$electric_charges_visitdt_time2',
						electric_charges_visitdt_ok2 = '$electric_charges_visitdt_ok2',

						electric_date_estimate = '$electric_date_estimate',
						electric_date_expect = '$electric_date_expect',
						electric_date_finish = '$electric_date_finish',
						electric_date_collect = '$electric_date_collect',
						electric_charges_memo3 = '$electric_charges_memo3',

						electric_charges_process = '$electric_charges_process',
	";
//����, ���� ���޸� ����
} else {
	$sql_common_master = "
						electric_charges_memo = '$electric_charges_memo',
	";
}
//����� �⺻����
$sql_common = "
						electric_charges_no = '$electric_charges_no',
						electric_charges_ssnb = '$electric_charges_ssnb',
						electric_charges_bupin = '$electric_charges_bupin',

						electric_charges_manager = '$manager_code',
						electric_charges_manager_name = '$manager_name',

						$sql_common_master

						electric_charges_reduce_ask = '$electric_charges_reduce_ask',

						$electric_charges_file_sql_1
						$electric_charges_file_sql_2
						$electric_charges_file_sql_3
						$electric_charges_file_sql_4
						$electric_charges_file_sql_5
						$electric_charges_file_sql_6
						$electric_charges_file_sql_7
						$electric_charges_file_sql_8

						$electric_charges_construct_sql_1
						$electric_charges_construct_sql_2
						$electric_charges_construct_sql_3
						$electric_charges_construct_sql_4
						$electric_charges_construct_sql_5
						$electric_charges_construct_sql_6
						$electric_charges_construct_sql_7
						$electric_charges_construct_sql_8

						electric_charges_visit_kind = '$electric_charges_visit_kind',
						electric_charges_visitdt = '$electric_charges_visitdt',
						electric_charges_visitdt_time = '$electric_charges_visitdt_time',
						electric_charges_visitdt_ok = '$electric_charges_visitdt_ok',

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

//�������� �� ������������ ���
if($row_com['electric_charges_construct_chk'] == "" && $electric_charges_construct_chk > 0) {
	$sql_samu_history = " update com_list_gy set electric_charges_construct_date='$now_date' where com_code = '$id' ";
	sql_query($sql_samu_history);
}

//����� ���� ����
$damdang_code = $row_com['damdang_code'];
$damdang_code2 = $row_com['damdang_code2'];
$firm_name = $row_com['com_name'];
$cust_name = $row_com['boss_name'];
$comp_bznb = $row_com['biz_no'];
//����� ����
$mb_profile_code = $member['mb_profile'];
$mb_profile = $man_cust_name_arry[$mb_profile_code];
$branch = $man_cust_name_arry[$damdang_code];
$branch2 = $man_cust_name_arry[$damdang_code2];
//�ŷ�ó ���Ŵ��� �ڵ� 160322
$manage_cust_numb = $row_com_opt['manage_cust_numb'];
//���Ŵ��� �ڵ� üũ
$sql_manage = "select * from a4_manage where user_id = '$mb_id' ";
$row_manage = sql_fetch($sql_manage);
$manage_code = $row_manage['code'];

//�˸� ����
if($row_com['electric_charges_etc'] != $electric_charges_etc) {
	$wr_subject = "[������������] ".$electric_charges_etc;
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
			send_to = '', manage_code = '$manage_cust_numb',
			user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id',
			com_code = '$id', wr_1 = '$electric_charges_id', com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '10006', alert_name = '������������'
	";
	sql_query($sql_alert);
}
//1��ġ �����ȸ��û �˸� : ������, �ڼ��� / 1��ġ ���� ���� 160411
/*
if($electric_charges_search_ask && $row_com['electric_charges_search_ask'] != $electric_charges_search_ask) {
	$wr_subject = "[������������] �����ȸ ��û�� �ֽ��ϴ�.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
			send_to = 'kcmc1007,kcmc1006', manage_code = '$manage_cust_numb',
			user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id',
			com_code = '$id', wr_1 = '$electric_charges_id', com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '10006', alert_name = '������������'
	";
	sql_query($sql_alert);
}
*/
//1�� �������ǥ �˸� : ������, �ڼ��� 160411
if($electric_charges_reduce_ask && $row_com['electric_charges_reduce_ask'] != $electric_charges_reduce_ask) {
	$wr_subject = "[������������] 1�� �������ǥ ��û�� �ֽ��ϴ�.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
			send_to = 'kcmc1007,kcmc1006,electric,', manage_code = '$manage_cust_numb',
			user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id',
			com_code = '$id', wr_1 = '$electric_charges_id', com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '10006', alert_name = '������������'
	";
	sql_query($sql_alert);
}
//������ǥ ���ε� �˸� : ������� 160411
$e_file_check = explode(',',$row_com['electric_charges_file_check']);
//1��������ǥ üũ ������ if�� ���� 160519
//if($_POST['e_file_check1'] == 1 && $e_file_check[0] != 1) {
if($_POST['e_file_check1'] == 1 && $_POST['e_file_check1'] != $e_file_check[0]) {
	$wr_subject = "[������������] ������ǥ�� ���ε� �Ǿ����ϴ�.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
			send_to = 'branch,', manage_code = '$manage_cust_numb',
			user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id',
			com_code = '$id', wr_1 = '$electric_charges_id', com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '10006', alert_name = '������������'
	";
	sql_query($sql_alert);
}

//ó����Ȳ 14���ݰ��� ���� �� ������ ���ӿ��� �˸� 160630
if($electric_charges_process == 14 && $row_com['electric_charges_process'] != $electric_charges_process) {
	$wr_subject = "[������������] �������� ��û�� �ֽ��ϴ�.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
			send_to = 'kcmc1008,', manage_code = '$manage_cust_numb',
			user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id',
			com_code = '$id', wr_1 = '$electric_charges_id', com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '10006', alert_name = '������������'
	";
	sql_query($sql_alert);
}
//����Ϸ��� ��� �� ������ �븮���� �˸� 160817
if($electric_date_change != "" && $row_com['electric_date_change'] != $electric_date_change) {
	//���� ������
	if($row_com['electric_date_request']) {
		$electric_date_request_arry = explode("~", $row_com['electric_date_request']);
		//û���� ~ ���� ���� ��� - ���ڷ� �迭 ����
		if(!$electric_date_request_arry[1]) $electric_date_request_arry = explode("-", $row_com['electric_date_request']);
		$electric_date_request_arry[0] = (int)str_replace("��", "", $electric_date_request_arry[0]);
		$electric_date_request_arry[1] = (int)str_replace("��", "", $electric_date_request_arry[1]);
		//����Ϸ��� : ��, �� �и�
		$electric_date_change_arry = explode(".", $electric_date_change);
		//����Ϸ��� ���� ���� �ľ�
		$electric_date_change_after = $electric_date_change_arry[0].".".$electric_date_change_arry[1].".".$electric_date_request_arry[0];
		//���� ������
		$electric_date_inquiry = $electric_date_change_arry[0].".".$electric_date_change_arry[1].".".$electric_date_inquiry_day;
		//7��->9�Ϸ� ���� 160511
		$electric_date_inquiry_day = date("Y-m-d", strtotime($electric_date_change_arry[0]."-".$electric_date_change_arry[1]."-".$electric_date_request_arry[1]." + 9 days"));
		//������ <= û�������� 2016.08.08 <= 2016.08.15
		if($electric_date_change <= $electric_date_change_after) {
			$electric_date_inquiry_month = date("Y-m-d", strtotime($electric_date_inquiry_day." + 1 months"));
			$electric_date_inquiry_time = $electric_date_inquiry_month." 09:00:00";
		} else {
			$electric_date_inquiry_month = date("Y-m-d", strtotime($electric_date_inquiry_day." + 2 months"));
			$electric_date_inquiry_time = $electric_date_inquiry_month." 09:00:00";
		}
	}
	//kcmc1008 ������ �븮, kcmc1007 ������ ����, kcmc1006 �ڼ��� 160830
	$wr_subject = "[������������] ".$electric_date_inquiry_month." ����ǥ/���� �����մϴ�. ����Ϸ�(".$electric_date_change.")";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
			send_to = 'electric,kcmc1006', manage_code = '$manage_cust_numb',
			user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id',
			com_code = '$id', wr_1 = '$electric_charges_id', com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$electric_date_inquiry_time', memo = '$wr_subject', 
			alert_code = '10006', alert_name = '������������'
	";
	sql_query($sql_alert);
}

//��������ü ÷������ ���� ���ε�(��ǥ�Ը� ���ε� ����) 161111 / ������ ���� �߰� 161216
if($member['mb_id'] == "kcmc1001" || $member['mb_id'] == "kcmc1003") {
	//������� ��ü for��
	$w_user_arry[1] = "el1001";
	$w_user_arry[2] = "el1002";
	$w_user_arry[3] = "el1003";
	$w_user_arry[4] = "el1004";

	for($i=1; $i<=4; $i++) {
		$upload_dir = 'files/electric_charges/';
		$file_sql_1[$i] = "";
		$file_sql_2[$i] = "";
		$file_sql_3[$i] = "";
		$file_sql_4[$i] = "";
		$file_sql_5[$i] = "";
		$file_sql_6[$i] = "";
		$file_sql_7[$i] = "";
		$file_sql_8[$i] = "";
		//÷�μ��� ���� ���
		if($_POST['file_hidden_del_1_'.$i] == 1) {
			$filename = $upload_dir.$_POST['file_1_'.$i];
			if(is_file($filename)) {
				unlink($filename);
			} else {
				echo "����(1)�� ���� �Ǿ����ϴ�.";
			}
		}
		if($_POST['file_hidden_del_2_'.$i] == 1) {
			$filename = $upload_dir.$_POST['file_2_'.$i];
			if(is_file($filename)) {
				unlink($filename);
			} else {
				echo "����(2)�� ���� �Ǿ����ϴ�.";
			}
		}
		if($_POST['file_hidden_del_3_'.$i] == 1) {
			$filename = $upload_dir.$_POST['file_3_'.$i];
			if(is_file($filename)) {
				unlink($filename);
			} else {
				echo "����(3)�� ���� �Ǿ����ϴ�.";
			}
		}
		if($_POST['file_hidden_del_4_'.$i] == 1) {
			$filename = $upload_dir.$_POST['file_4_'.$i];
			if(is_file($filename)) {
				unlink($filename);
			} else {
				echo "����(4)�� ���� �Ǿ����ϴ�.";
			}
		}
		if($_POST['file_hidden_del_5_'.$i] == 1) {
			$filename = $upload_dir.$_POST['file_5_'.$i];
			if(is_file($filename)) {
				unlink($filename);
			} else {
				echo "����(5)�� ���� �Ǿ����ϴ�.";
			}
		}
		if($_POST['file_hidden_del_6_'.$i] == 1) {
			$filename = $upload_dir.$_POST['file_6_'.$i];
			if(is_file($filename)) {
				unlink($filename);
			} else {
				echo "����(6)�� ���� �Ǿ����ϴ�.";
			}
		}
		if($_POST['file_hidden_del_7_'.$i] == 1) {
			$filename = $upload_dir.$_POST['file_7_'.$i];
			if(is_file($filename)) {
				unlink($filename);
			} else {
				echo "����(7)�� ���� �Ǿ����ϴ�.";
			}
		}
		if($_POST['file_hidden_del_8_'.$i] == 1) {
			$filename = $upload_dir.$_POST['file_8_'.$i];
			if(is_file($filename)) {
				unlink($filename);
			} else {
				echo "����(8)�� ���� �Ǿ����ϴ�.";
			}
		}
		//÷�μ���1
		if($_FILES['file_1_'.$i]['tmp_name']) {
			$pic_name1 = $_FILES['file_1_'.$i]['name'];
			$upload_construct_name = $now_time_file."_".$pic_name1;
			$upload_construct = $upload_dir.$upload_construct_name;
			move_uploaded_file($_FILES['file_1_'.$i]['tmp_name'], $upload_construct);
		} else {
			$pic_name1 = "";
		}
		if($pic_name1) {
			$file_sql_1[$i] = " file_1 = '$upload_construct_name', ";
		} else {
			if($_POST['file_hidden_del_1_'.$i] == 1) $file_sql_1[$i] = " file_1 = '', ";
			else $file_sql_1[$i] = "";
		}
		//÷�μ���2
		if($_FILES['file_2_'.$i]['tmp_name']) {
			$pic_name2 = $_FILES['file_2_'.$i]['name'];
			$upload_construct_name = $now_time_file."_".$pic_name2;
			$upload_construct = $upload_dir.$upload_construct_name;
			move_uploaded_file($_FILES['file_2_'.$i]['tmp_name'], $upload_construct);
		} else {
			$pic_name2 = "";
		}
		if($pic_name2) {
			$file_sql_2[$i] = " file_2 = '$upload_construct_name', ";
		} else {
			if($_POST['file_hidden_del_2_'.$i] == 1) $file_sql_2[$i] = " file_2 = '', ";
			else $file_sql_2[$i] = "";
		}
		//÷�μ���3
		if($_FILES['file_3_'.$i]['tmp_name']) {
			$pic_name3 = $_FILES['file_3_'.$i]['name'];
			$upload_construct_name = $now_time_file."_".$pic_name3;
			$upload_construct = $upload_dir.$upload_construct_name;
			move_uploaded_file($_FILES['file_3_'.$i]['tmp_name'], $upload_construct);
		} else {
			$pic_name3 = "";
		}
		if($pic_name3) {
			$file_sql_3[$i] = " file_3 = '$upload_construct_name', ";
		} else {
			if($_POST['file_hidden_del_3_'.$i] == 1) $file_sql_3[$i] = " file_3 = '', ";
			else $file_sql_3[$i] = "";
		}
		//÷�μ���4
		if($_FILES['file_4_'.$i]['tmp_name']) {
			$pic_name4 = $_FILES['file_4_'.$i]['name'];
			$upload_construct_name = $now_time_file."_".$pic_name4;
			$upload_construct = $upload_dir.$upload_construct_name;
			move_uploaded_file($_FILES['file_4_'.$i]['tmp_name'], $upload_construct);
		} else {
			$pic_name4 = "";
		}
		if($pic_name4) {
			$file_sql_4[$i] = " file_4 = '$upload_construct_name', ";
		} else {
			if($_POST['file_hidden_del_4_'.$i] == 1) $file_sql_4[$i] = " file_4 = '', ";
			else $file_sql_4[$i] = "";
		}
		//÷�μ���5
		if($_FILES['file_5_'.$i]['tmp_name']) {
			$pic_name5 = $_FILES['file_5_'.$i]['name'];
			$upload_construct_name = $now_time_file."_".$pic_name5;
			$upload_construct = $upload_dir.$upload_construct_name;
			move_uploaded_file($_FILES['file_5_'.$i]['tmp_name'], $upload_construct);
		} else {
			$pic_name5 = "";
		}
		if($pic_name5) {
			$file_sql_5[$i] = " file_5 = '$upload_construct_name', ";
		} else {
			if($_POST['file_hidden_del_5_'.$i] == 1) $file_sql_5[$i] = " file_5 = '', ";
			else $file_sql_5[$i] = "";
		}
		//÷�μ���6
		if($_FILES['file_6_'.$i]['tmp_name']) {
			$pic_name6 = $_FILES['file_6_'.$i]['name'];
			$upload_construct_name = $now_time_file."_".$pic_name6;
			$upload_construct = $upload_dir.$upload_construct_name;
			move_uploaded_file($_FILES['file_6_'.$i]['tmp_name'], $upload_construct);
		} else {
			$pic_name6 = "";
		}
		if($pic_name6) {
			$file_sql_6[$i] = " file_6 = '$upload_construct_name', ";
		} else {
			if($_POST['file_hidden_del_6_'.$i] == 1) $file_sql_6[$i] = " file_6 = '', ";
			else $file_sql_6[$i] = "";
		}
		//÷�μ���7
		if($_FILES['file_7_'.$i]['tmp_name']) {
			$pic_name7 = $_FILES['file_7_'.$i]['name'];
			$upload_construct_name = $now_time_file."_".$pic_name7;
			$upload_construct = $upload_dir.$upload_construct_name;
			move_uploaded_file($_FILES['file_7_'.$i]['tmp_name'], $upload_construct);
		} else {
			$pic_name7 = "";
		}
		if($pic_name7) {
			$file_sql_7[$i] = " file_7 = '$upload_construct_name', ";
		} else {
			if($_POST['file_hidden_del_7_'.$i] == 1) $file_sql_7[$i] = " file_7 = '', ";
			else $file_sql_7[$i] = "";
		}
		//÷�μ���8
		if($_FILES['file_8_'.$i]['tmp_name']) {
			$pic_name8 = $_FILES['file_8_'.$i]['name'];
			$upload_construct_name = $now_time_file."_".$pic_name8;
			$upload_construct = $upload_dir.$upload_construct_name;
			move_uploaded_file($_FILES['file_8_'.$i]['tmp_name'], $upload_construct);
		} else {
			$pic_name8 = "";
		}
		if($pic_name8) {
			$file_sql_8[$i] = " file_8 = '$upload_construct_name', ";
		} else {
			if($_POST['file_hidden_del_8_'.$i] == 1) $file_sql_8[$i] = " file_8 = '', ";
			else $file_sql_8[$i] = "";
		}
		//���� ���ε� �ø� SQL Query ���� 161111
		//echo $file_sql_1[$i];
		//exit;
		if($file_sql_1[$i]!="" || $file_sql_2[$i]!="" || $file_sql_3[$i]!="" || $file_sql_4[$i]!="" || $file_sql_5[$i]!="" || $file_sql_6[$i]!="" || $file_sql_7[$i]!="" || $file_sql_8[$i]!="") {
			//echo $file_sql_1[$i];
			//exit;
			//������ ���� Ȯ�� / and w_user = '$mb_id' ���� �߰�, ��������ü ���� ���� ���ε� 161108
			$sql_file = " select * from electric_charges_file where com_code='$id' and w_user = '$w_user_arry[$i]' ";
			$result_file = sql_query($sql_file);
			$total_file = mysql_num_rows($result_file);
			//��������ü ÷�μ��� 161006
			$sql_common_file = "
									$file_sql_1[$i]
									$file_sql_2[$i]
									$file_sql_3[$i]
									$file_sql_4[$i]
									$file_sql_5[$i]
									$file_sql_6[$i]
									$file_sql_7[$i]
									$file_sql_8[$i]
									w_name = '$electric_charges_construct_arry[$i]'
			";
			if($total_file) $sql_file = " update electric_charges_file set $sql_common_file where com_code = '$id' and w_user = '$w_user_arry[$i]' ";
			else $sql_file = " insert electric_charges_file set $sql_common_file , com_code = '$id' , w_user = '$w_user_arry[$i]' ";
			//echo $sql_file;
			//exit;
			sql_query($sql_file);
		}

	} //for�� ����
} //if�� ����

alert("���������� ������������ ������ ���� �Ǿ����ϴ�.","electric_charges_view.php?id=".$id."&w=".$w."&page=".$page."&".$qstr."&".$stx_qstr);
?>