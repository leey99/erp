<?
$sub_menu = "1900400";
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
$upload_dir = 'files/convey_file/';
$convey_file_sql_1 = "";
$convey_file_sql_2 = "";
$convey_file_sql_3 = "";
$convey_file_sql_4 = "";
$convey_file_sql_5 = "";
$convey_file_sql_6 = "";

//÷�μ��� ���� ���
if($convey_file_del_1 == 1) {
	$filename = $upload_dir.$c_file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(1)�� �������� �ʽ��ϴ�.";
	}
}
if($convey_file_del_2 == 1) {
	$filename = $upload_dir.$c_file_2;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(2)�� �������� �ʽ��ϴ�.";
	}
}
if($convey_file_del_3 == 1) {
	$filename = $upload_dir.$c_file_3;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(3)�� �������� �ʽ��ϴ�.";
	}
}
if($convey_file_del_4 == 1) {
	$filename = $upload_dir.$c_file_4;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(4)�� �������� �ʽ��ϴ�.";
	}
}
if($convey_file_del_5 == 1) {
	$filename = $upload_dir.$c_file_5;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(5)�� �������� �ʽ��ϴ�.";
	}
}
if($convey_file_del_6 == 1) {
	$filename = $upload_dir.$c_file_6;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(6)�� �������� �ʽ��ϴ�.";
	}
}

//÷�μ���1
if($_FILES['convey_file_1']['tmp_name']) {
	$pic_name1 = $_FILES['convey_file_1']['name'];
	$upload_file_name = $now_time_file."_".$pic_name1;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['convey_file_1']['tmp_name'], $upload_file);
}
if($pic_name1) {
	$convey_file_sql_1 = " convey_file_1 = '$upload_file_name', ";
} else {
	if($convey_file_del_1 == 1) $convey_file_sql_1 = " convey_file_1 = '', ";
}
//÷�μ���2
if($_FILES['convey_file_2']['tmp_name']) {
	$pic_name2 = $_FILES['convey_file_2']['name'];
	$upload_file_name = $now_time_file."_".$pic_name2;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['convey_file_2']['tmp_name'], $upload_file);
}
if($pic_name2) {
	$convey_file_sql_2 = " convey_file_2 = '$upload_file_name', ";
} else {
	if($convey_file_del_2 == 1) $convey_file_sql_2 = " convey_file_2 = '', ";
}
//÷�μ���3
if($_FILES['convey_file_3']['tmp_name']) {
	$pic_name3 = $_FILES['convey_file_3']['name'];
	$upload_file_name = $now_time_file."_".$pic_name3;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['convey_file_3']['tmp_name'], $upload_file);
}
if($pic_name3) {
	$convey_file_sql_3 = " convey_file_3 = '$upload_file_name', ";
} else {
	if($convey_file_del_3 == 1) $convey_file_sql_3 = " convey_file_3 = '', ";
}
//÷�μ���4
if($_FILES['convey_file_4']['tmp_name']) {
	$pic_name4 = $_FILES['convey_file_4']['name'];
	$upload_file_name = $now_time_file."_".$pic_name4;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['convey_file_4']['tmp_name'], $upload_file);
}
if($pic_name4) {
	$convey_file_sql_4 = " convey_file_4 = '$upload_file_name', ";
} else {
	if($convey_file_del_4 == 1) $convey_file_sql_4 = " convey_file_4 = '', ";
}
//÷�μ���5
if($_FILES['convey_file_5']['tmp_name']) {
	$pic_name5 = $_FILES['convey_file_5']['name'];
	$upload_file_name = $now_time_file."_".$pic_name5;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['convey_file_5']['tmp_name'], $upload_file);
}
if($pic_name5) {
	$convey_file_sql_5 = " convey_file_5 = '$upload_file_name', ";
} else {
	if($convey_file_del_5 == 1) $convey_file_sql_5 = " convey_file_5 = '', ";
}
//÷�μ���6
if($_FILES['convey_file_6']['tmp_name']) {
	$pic_name6 = $_FILES['convey_file_6']['name'];
	$upload_file_name = $now_time_file."_".$pic_name6;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['convey_file_6']['tmp_name'], $upload_file);
}
if($pic_name6) {
	$convey_file_sql_6 = " convey_file_6 = '$upload_file_name', ";
} else {
	if($convey_file_del_6 == 1) $convey_file_sql_6 = " convey_file_6 = '', ";
}

//�߰� �ʵ� ������ ����2
$sql2 = " select * from com_list_gy_opt2 where com_code='$id' ";
$result2 = sql_query($sql2);
$row2 = mysql_fetch_array($result2);

//���� DB �ʵ�
if($member['mb_level'] != 6) {
	$sql_common_opt2_master = "
							$convey_file_sql_1
							$convey_file_sql_2
							$convey_file_sql_3
							$convey_file_sql_4
							$convey_file_sql_5
							$convey_file_sql_6

							support_kind = '$support_kind',
							support_kind2 = '$support_kind2',
							support_kind3 = '$support_kind3',
							support_kind4 = '$support_kind4',
							support_kind5 = '$support_kind5',

							support_document = '$support_document',
							support_document2 = '$support_document2',
							support_document3 = '$support_document3',
							support_document4 = '$support_document4',
							support_document5 = '$support_document5',

							support_person_process = '$support_person_process',
							support_person_kind1 = '$support_person_kind1',
							support_person_kind2 = '$support_person_kind2',
							support_person_kind3 = '$support_person_kind3',
	";
//�������� ���� 151209
/*
} else if($member['mb_profile'] == 8) {
	$sql_common_opt2_master = "
						support_person_process = '$support_person_process',
	";
*/
}
//����� ���� �߰�2 DB
$sql_common_opt2 = "
						$sql_common_opt2_master

						support_person_process = '$support_person_process',

						support_person_manager = '$manager_code',
						support_person_manager_name = '$manager_name',
						support_person_user = '$mb_name',
						support_person_editdt = '$now_time'
";
$sql_opt2 = " update com_list_gy_opt2 set 
				$sql_common_opt2 
				where com_code = '$id' ";
sql_query($sql_opt2);

//���� ����
if($member['mb_level'] != 6) {
	//����� ����
	$mb_profile_code = $member['mb_profile'];
	$mb_profile = $man_cust_name_arry[$mb_profile_code];
	$branch = $man_cust_name_arry[$damdang_code];
	$branch2 = $man_cust_name_arry[$damdang_code2];

	//���Ŵ��� �ڵ� üũ
	$sql_manage = "select * from a4_manage where user_id = '$mb_id' ";
	$row_manage = sql_fetch($sql_manage);
	$manage_code = $row_manage['code'];

	//��û�����ȳ�
	if($row2['support_document'] != $support_document) {
		if($support_document) $support_document_text = "[".$support_document."]";
		else $support_document_text = "";
		$wr_subject = "��û�����ȳ� ".$support_document_text;
		$sql_alert = " insert erp_alert set 
				branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
				com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
				memo2 = '$support_document', alert_code = '30001', alert_name = '��û�����ȳ�'
		";
		sql_query($sql_alert);
	}
	//��û�����ȳ�2
	if($row2['support_document2'] != $support_document2) {
		if($support_document2) $support_document2_text = "[".$support_document2."]";
		else $support_document2_text = "";
		$wr_subject = "��û�����ȳ� ".$support_document2_text;
		$sql_alert = " insert erp_alert set 
				branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
				com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
				memo2 = '$support_document2', alert_code = '30001', alert_name = '��û�����ȳ�'
		";
		sql_query($sql_alert);
	}
	//��û�����ȳ�3
	if($row2['support_document3'] != $support_document3) {
		if($support_document3) $support_document3_text = "[".$support_document3."]";
		else $support_document3_text = "";
		$wr_subject = "��û�����ȳ� ".$support_document3_text;
		$sql_alert = " insert erp_alert set 
				branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
				com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
				memo2 = '$support_document3', alert_code = '30001', alert_name = '��û�����ȳ�'
		";
		sql_query($sql_alert);
	}
	//��û�����ȳ�4
	if($row2['support_document4'] != $support_document4) {
		if($support_document4) $support_document4_text = "[".$support_document4."]";
		else $support_document4_text = "";
		$wr_subject = "��û�����ȳ� ".$support_document4_text;
		$sql_alert = " insert erp_alert set 
				branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
				com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
				memo2 = '$support_document4', alert_code = '30001', alert_name = '��û�����ȳ�'
		";
		sql_query($sql_alert);
	}
	//��û�����ȳ�5
	if($row2['support_document5'] != $support_document5) {
		if($support_document5) $support_document5_text = "[".$support_document5."]";
		else $support_document5_text = "";
		$wr_subject = "��û�����ȳ� ".$support_document5_text;
		$sql_alert = " insert erp_alert set 
				branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
				com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
				memo2 = '$support_document5', alert_code = '30001', alert_name = '��û�����ȳ�'
		";
		sql_query($sql_alert);
	}
	$qstr = $_POST['qstr'];
}
alert("���������� �������Ȯ�� ������ ���� �Ǿ����ϴ�.","support_person_view.php?id=".$id."&w=".$w."&page=".$page."&".$qstr);
?>