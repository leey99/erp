<?
$sub_menu = "1900600";
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
$upload_dir = 'files/employment_file/';

//���(����)
$branch_file_sql_1 = "";
$branch_file_sql_2 = "";
$branch_file_sql_3 = "";
$branch_file_sql_4 = "";
//÷�μ��� ���� ���
if($branch_file_del_1 == 1) {
	$filename = $upload_dir.$b_file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(1)�� �������� �ʽ��ϴ�.";
	}
}
if($branch_file_del_2 == 1) {
	$filename = $upload_dir.$b_file_2;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(2)�� �������� �ʽ��ϴ�.";
	}
}
if($branch_file_del_3 == 1) {
	$filename = $upload_dir.$b_file_3;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(3)�� �������� �ʽ��ϴ�.";
	}
}
if($branch_file_del_4 == 1) {
	$filename = $upload_dir.$b_file_4;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(4)�� �������� �ʽ��ϴ�.";
	}
}
//÷�μ���1
if($_FILES['branch_file_1']['tmp_name']) {
	$pic_name1 = $_FILES['branch_file_1']['name'];
	$upload_file_name = $now_time_file."_".$pic_name1;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['branch_file_1']['tmp_name'], $upload_file);
} else {
	$pic_name1 = "";
}
if($pic_name1) {
	$branch_file_sql_1 = " branch_file_1 = '$upload_file_name', ";
} else {
	if($branch_file_del_1 == 1) $branch_file_sql_1 = " branch_file_1 = '', ";
}
//÷�μ���2
if($_FILES['branch_file_2']['tmp_name']) {
	$pic_name2 = $_FILES['branch_file_2']['name'];
	$upload_file_name = $now_time_file."_".$pic_name2;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['branch_file_2']['tmp_name'], $upload_file);
} else {
	$pic_name2 = "";
}
if($pic_name2) {
	$branch_file_sql_2 = " branch_file_2 = '$upload_file_name', ";
} else {
	if($branch_file_del_2 == 1) $branch_file_sql_2 = " branch_file_2 = '', ";
}
//÷�μ���3
if($_FILES['branch_file_3']['tmp_name']) {
	$pic_name3 = $_FILES['branch_file_3']['name'];
	$upload_file_name = $now_time_file."_".$pic_name3;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['branch_file_3']['tmp_name'], $upload_file);
} else {
	$pic_name3 = "";
}
if($pic_name3) {
	$branch_file_sql_3 = " branch_file_3 = '$upload_file_name', ";
} else {
	if($branch_file_del_3 == 1) $branch_file_sql_3 = " branch_file_3 = '', ";
}
//÷�μ���4
if($_FILES['branch_file_4']['tmp_name']) {
	$pic_name4 = $_FILES['branch_file_4']['name'];
	$upload_file_name = $now_time_file."_".$pic_name4;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['branch_file_4']['tmp_name'], $upload_file);
} else {
	$pic_name4 = "";
}
if($pic_name4) {
	$branch_file_sql_4 = " branch_file_4 = '$upload_file_name', ";
} else {
	if($branch_file_del_4 == 1) $branch_file_sql_4 = " branch_file_4 = '', ";
}
//���(����)
$main_file_sql_1 = "";
$main_file_sql_2 = "";
$main_file_sql_3 = "";
$main_file_sql_4 = "";
//÷�μ��� ���� ���
if($main_file_del_1 == 1) {
	$filename = $upload_dir.$m_file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(1)�� �������� �ʽ��ϴ�.";
	}
}
if($main_file_del_2 == 1) {
	$filename = $upload_dir.$m_file_2;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(2)�� �������� �ʽ��ϴ�.";
	}
}
if($main_file_del_3 == 1) {
	$filename = $upload_dir.$m_file_3;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(3)�� �������� �ʽ��ϴ�.";
	}
}
if($main_file_del_4 == 1) {
	$filename = $upload_dir.$m_file_4;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(4)�� �������� �ʽ��ϴ�.";
	}
}
//÷�μ���1
if($_FILES['main_file_1']['tmp_name']) {
	$pic_name1 = $_FILES['main_file_1']['name'];
	$upload_file_name = $now_time_file."_".$pic_name1;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['main_file_1']['tmp_name'], $upload_file);
} else {
	$pic_name1 = "";
}
if($pic_name1) {
	$main_file_sql_1 = " main_file_1 = '$upload_file_name', ";
} else {
	if($main_file_del_1 == 1) $main_file_sql_1 = " main_file_1 = '', ";
}
//÷�μ���2
if($_FILES['main_file_2']['tmp_name']) {
	$pic_name2 = $_FILES['main_file_2']['name'];
	$upload_file_name = $now_time_file."_".$pic_name2;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['main_file_2']['tmp_name'], $upload_file);
} else {
	$pic_name2 = "";
}
if($pic_name2) {
	$main_file_sql_2 = " main_file_2 = '$upload_file_name', ";
} else {
	if($main_file_del_2 == 1) $main_file_sql_2 = " main_file_2 = '', ";
}
//÷�μ���3
if($_FILES['main_file_3']['tmp_name']) {
	$pic_name3 = $_FILES['main_file_3']['name'];
	$upload_file_name = $now_time_file."_".$pic_name3;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['main_file_3']['tmp_name'], $upload_file);
} else {
	$pic_name3 = "";
}
if($pic_name3) {
	$main_file_sql_3 = " main_file_3 = '$upload_file_name', ";
} else {
	if($main_file_del_3 == 1) $main_file_sql_3 = " main_file_3 = '', ";
}
//÷�μ���4
if($_FILES['main_file_4']['tmp_name']) {
	$pic_name4 = $_FILES['main_file_4']['name'];
	$upload_file_name = $now_time_file."_".$pic_name4;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['main_file_4']['tmp_name'], $upload_file);
} else {
	$pic_name4 = "";
}
if($pic_name4) {
	$main_file_sql_4 = " main_file_4 = '$upload_file_name', ";
} else {
	if($main_file_del_4 == 1) $main_file_sql_4 = " main_file_4 = '', ";
}
//���(���)
$employment_file_sql_1 = "";
$employment_file_sql_2 = "";
$employment_file_sql_3 = "";
$employment_file_sql_4 = "";
//÷�μ��� ���� ���
if($employment_file_del_1 == 1) {
	$filename = $upload_dir.$e_file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(1)�� �������� �ʽ��ϴ�.";
	}
}
if($employment_file_del_2 == 1) {
	$filename = $upload_dir.$e_file_2;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(2)�� �������� �ʽ��ϴ�.";
	}
}
if($employment_file_del_3 == 1) {
	$filename = $upload_dir.$e_file_3;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(3)�� �������� �ʽ��ϴ�.";
	}
}
if($employment_file_del_4 == 1) {
	$filename = $upload_dir.$e_file_4;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(4)�� �������� �ʽ��ϴ�.";
	}
}
//÷�μ���1
if($_FILES['employment_file_1']['tmp_name']) {
	$pic_name1 = $_FILES['employment_file_1']['name'];
	$upload_file_name = $now_time_file."_".$pic_name1;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['employment_file_1']['tmp_name'], $upload_file);
} else {
	$pic_name1 = "";
}
if($pic_name1) {
	$employment_file_sql_1 = " employment_file_1 = '$upload_file_name', ";
} else {
	if($employment_file_del_1 == 1) $employment_file_sql_1 = " employment_file_1 = '', ";
}
//÷�μ���2
if($_FILES['employment_file_2']['tmp_name']) {
	$pic_name2 = $_FILES['employment_file_2']['name'];
	$upload_file_name = $now_time_file."_".$pic_name2;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['employment_file_2']['tmp_name'], $upload_file);
} else {
	$pic_name2 = "";
}
if($pic_name2) {
	$employment_file_sql_2 = " employment_file_2 = '$upload_file_name', ";
} else {
	if($employment_file_del_2 == 1) $employment_file_sql_2 = " employment_file_2 = '', ";
}
//÷�μ���3
if($_FILES['employment_file_3']['tmp_name']) {
	$pic_name3 = $_FILES['employment_file_3']['name'];
	$upload_file_name = $now_time_file."_".$pic_name3;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['employment_file_3']['tmp_name'], $upload_file);
} else {
	$pic_name3 = "";
}
if($pic_name3) {
	$employment_file_sql_3 = " employment_file_3 = '$upload_file_name', ";
} else {
	if($employment_file_del_3 == 1) $employment_file_sql_3 = " employment_file_3 = '', ";
}
//÷�μ���4
if($_FILES['employment_file_4']['tmp_name']) {
	$pic_name4 = $_FILES['employment_file_4']['name'];
	$upload_file_name = $now_time_file."_".$pic_name4;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['employment_file_4']['tmp_name'], $upload_file);
} else {
	$pic_name4 = "";
}
if($pic_name4) {
	$employment_file_sql_4 = " employment_file_4 = '$upload_file_name', ";
} else {
	if($employment_file_del_4 == 1) $employment_file_sql_4 = " employment_file_4 = '', ";
}
// ������2 ����
$sql2 = " select * from com_employment where com_code='$id' ";
$result2 = sql_query($sql2);
$row2 = mysql_fetch_array($result2);
//�ڵ� ó����Ȳ �Է� ��� 151117
if(!$row2['employment_process'] && !$employment_process) {
	$employment_process = 1;
}
//�ڵ� ó����Ȳ ���� ���� 151118 (���� ���� ���ε� �ʼ�, ó����Ȳ �̼���, �Ƿ��� ���)
if( ($employment_process == "" || $employment_process == 1) && $main_file_sql_1 ) {
	$employment_process = 6;
	//���������Ⱓ��ȸ �ŷ�ó ���� ó�� 151118
	$sql_common_del = " update com_reduction set delete_yn='1' where com_code = '$id' ";
	sql_query($sql_common_del);
}
//�ڵ� ó����Ȳ Ȯ�� ���� 151119 (���� ���� ���ε� �ʼ�, ó����Ȳ ������ ���)
if( ($employment_process == 6) && $employment_file_sql_1 ) {
	$employment_process = 9;
}
//ó����Ȳ ���� ���� �� �ڵ� ������� ���� 151210
if($row2['employment_process'] != 6 && $employment_process == 6) $employment_regt_sql = " employment_regt='$now_time', ";
else $employment_regt_sql = "";
//�޸� ���� / ���� ���� ����/���� ���� ������ �븮 ��û 161215
/*
if($employment_memo) $employment_memo_sql = " employment_memo = '$employment_memo', ";
else $employment_memo_sql = "";
*/
$employment_memo_sql = " employment_memo = '$employment_memo', ";
//������, ����, ������� 
if( ($is_admin == "super" || $member['mb_profile'] == 1) || $member['mb_profile'] == '16' ) {
	//���� ���� �ʵ� ����
	$sql_common_employment_master = "

							$main_file_sql_1
							$main_file_sql_2
							$main_file_sql_3
							$main_file_sql_4

							$employment_file_sql_1
							$employment_file_sql_2
							$employment_file_sql_3
							$employment_file_sql_4

							$employment_regt_sql

							$employment_memo_sql
							employment_process = '$employment_process',
	";
} else {
	$sql_common_employment_master = "
							$employment_memo_sql
							employment_process = '$employment_process',
	";
}
//����� ���� �߰�2 DB
$sql_common_employment = "
							$sql_common_employment_master

							$branch_file_sql_1
							$branch_file_sql_2
							$branch_file_sql_3
							$branch_file_sql_4

							employment_visit_kind = '$employment_visit_kind',
							employment_visitdt = '$employment_visitdt',
							employment_visitdt_time = '$employment_visitdt_time',
							employment_visitdt_ok = '$employment_visitdt_ok',

							employment_user = '$mb_name',
							employment_editdt = '$now_time'
";
//������2 ���� �� update, ������ �� insert
if($row2['com_code']) {
	$sql_employment = " update com_employment set 
				$sql_common_employment 
				where com_code = '$id' ";
} else {
	$sql_employment = " insert com_employment set 
				$sql_common_employment 
				, com_code='$id' ";
	//1110 : Column 'employment_regt' specified twice ���� ���� 151210
	if(!$employment_regt_sql) $sql_employment .= " , employment_regt='$now_time' ";
}
//echo $sql_employment;
//exit;
sql_query($sql_employment);

//�߰� �ʵ� ������ ����2
$sql_opt2 = " select * from com_list_gy_opt2 where com_code='$id' ";
$result_opt2 = sql_query($sql_opt2);
$row_opt2 = mysql_fetch_array($result_opt2);

//���� DB �ʵ�
if($member['mb_level'] != 6) {
	$sql_common_opt2_master = "
							support_kind = '$support_kind',
							support_kind2 = '$support_kind2',
							support_kind3 = '$support_kind3',
							support_kind4 = '$support_kind4',
							support_kind5 = '$support_kind5',

							support_document = '$support_document',
							support_document2 = '$support_document2',
							support_document3 = '$support_document3',
							support_document4 = '$support_document4',
							support_document5 = '$support_document5'
	";
	$sql_opt2 = " update com_list_gy_opt2 set 
					$sql_common_opt2_master 
					where com_code = '$id' ";
	sql_query($sql_opt2);
}
//�ش���� ó����Ȳ ���� �� �ڵ� ���������Ⱓ��ȸ ó����Ȳ �ش���� ó�� 151126
if($employment_process == 5) {
	$sql2 = " select * from com_reduction where com_code='$id' ";
	$result2 = sql_query($sql2);
	$row2 = mysql_fetch_array($result2);
	if($row2['com_code']) {
		$sql_common = " reduction_process = '$employment_process', reduction_user = '$mb_nick', reduction_editdt = '$now_time' ";
		$sql = " update com_reduction set $sql_common where com_code = '$id' ";
		sql_query($sql);
	}
}
//�̷� DB ����
$sql_history = " insert com_employment_history set 
		com_code = '$id', w_date='$now_time', w_user = '$mb_id', w_name = '$mb_nick', 
		$branch_file_sql_1
		$branch_file_sql_2
		$branch_file_sql_3
		$branch_file_sql_4
		$main_file_sql_1
		$main_file_sql_2
		$main_file_sql_3
		$main_file_sql_4
		$employment_file_sql_1
		$employment_file_sql_2
		$employment_file_sql_3
		$employment_file_sql_4
		$employment_memo_sql
		employment_process = '$employment_process'
";
sql_query($sql_history);

//����� ���� + opt DB
$sql_com = "select * from com_list_gy a, com_list_gy b where a.com_code='$id' and a.com_code=b.com_code ";
$row_com = sql_fetch($sql_com);

//����� ����
$mb_profile_code = $member['mb_profile'];
$mb_profile = $man_cust_name_arry[$mb_profile_code];
$damdang_code = $row_com['damdang_code'];
$branch = $man_cust_name_arry[$damdang_code];
$damdang_code2 = $row_com['damdang_code2'];
$branch2 = $man_cust_name_arry[$damdang_code2];

//�����
$mb_name = $member['mb_name'];
$mb_id = $member['mb_id'];

//���Ŵ��� �ڵ� üũ
$sql_manage = "select * from a4_manage where user_id = '$mb_id' ";
$row_manage = sql_fetch($sql_manage);
$manage_code = $row_manage['code'];


//���� ���� ���ε� ��(�뱸����) �˸� 151119 : �⺻ ���ϰ� �ٸ� ���, ���� ������ �ƴ� ���
if($row2['employment_file_1'] != $employment_file_sql_1 && $employment_file_sql_1 && !$employment_file_del_1) {
	//�ð������� �ű� ��� �˸�
	$wr_subject = "�ű԰��Ȯ�� ����� Ȯ�� �Ǿ����ϴ�.";
	//�����
	$send_to = "manager";
	//$branch = $damdang_code;
	//���� ���� ����
	$branch_code = 1;
	$sql_alert = " insert erp_alert set 
			branch = '$branch_code', branch_name = '$branch', branch2 = '$branch_code', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			send_to = '$send_to',
			com_code = '$id' , wr_1 = '$row2[idx]', com_name = '$row_com[com_name]', boss_name = '$row_com[boss_name]', biz_no = '$row_com[biz_no]', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '40004', alert_name = '�ű԰��Ȯ��'
	";
	sql_query($sql_alert);
}

//���� ����
if($member['mb_level'] != 6) {
	//��û�����ȳ�
	if($row_opt2['support_document'] != $support_document) {
		if($support_document) $support_document_text = "[".$support_document."]";
		else $support_document_text = "";
		$wr_subject = "��û�����ȳ� ".$support_document_text;
		$sql_alert = " insert erp_alert set 
				branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
				com_code = '$id' , com_name = '$row_com[com_name]', boss_name = '$row_com[boss_name]', biz_no = '$row_com[biz_no]', wr_datetime='$now_time', memo = '$wr_subject', 
				memo2 = '$support_document', alert_code = '30001', alert_name = '��û�����ȳ�'
		";
		sql_query($sql_alert);
	}
	//��û�����ȳ�2
	if($row_opt2['support_document2'] != $support_document2) {
		if($support_document2) $support_document2_text = "[".$support_document2."]";
		else $support_document2_text = "";
		$wr_subject = "��û�����ȳ� ".$support_document2_text;
		$sql_alert = " insert erp_alert set 
				branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
				com_code = '$id' , com_name = '$row_com[com_name]', boss_name = '$row_com[boss_name]', biz_no = '$row_com[biz_no]', wr_datetime='$now_time', memo = '$wr_subject', 
				memo2 = '$support_document2', alert_code = '30001', alert_name = '��û�����ȳ�'
		";
		sql_query($sql_alert);
	}
	//��û�����ȳ�3
	if($row_opt2['support_document3'] != $support_document3) {
		if($support_document3) $support_document3_text = "[".$support_document3."]";
		else $support_document3_text = "";
		$wr_subject = "��û�����ȳ� ".$support_document3_text;
		$sql_alert = " insert erp_alert set 
				branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
				com_code = '$id' , com_name = '$row_com[com_name]', boss_name = '$row_com[boss_name]', biz_no = '$row_com[biz_no]', wr_datetime='$now_time', memo = '$wr_subject', 
				memo2 = '$support_document3', alert_code = '30001', alert_name = '��û�����ȳ�'
		";
		sql_query($sql_alert);
	}
	//��û�����ȳ�4
	if($row_opt2['support_document4'] != $support_document4) {
		if($support_document4) $support_document4_text = "[".$support_document4."]";
		else $support_document4_text = "";
		$wr_subject = "��û�����ȳ� ".$support_document4_text;
		$sql_alert = " insert erp_alert set 
				branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
				com_code = '$id' , com_name = '$row_com[com_name]', boss_name = '$row_com[boss_name]', biz_no = '$row_com[biz_no]', wr_datetime='$now_time', memo = '$wr_subject', 
				memo2 = '$support_document4', alert_code = '30001', alert_name = '��û�����ȳ�'
		";
		sql_query($sql_alert);
	}
	//��û�����ȳ�5
	if($row_opt2['support_document5'] != $support_document5) {
		if($support_document5) $support_document5_text = "[".$support_document5."]";
		else $support_document5_text = "";
		$wr_subject = "��û�����ȳ� ".$support_document5_text;
		$sql_alert = " insert erp_alert set 
				branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
				com_code = '$id' , com_name = '$row_com[com_name]', boss_name = '$row_com[boss_name]', biz_no = '$row_com[biz_no]', wr_datetime='$now_time', memo = '$wr_subject', 
				memo2 = '$support_document5', alert_code = '30001', alert_name = '��û�����ȳ�'
		";
		sql_query($sql_alert);
	}
}

//�Ϸ� �� ������ �̵�
alert("���������� �ű԰��Ȯ�� ������ ���� �Ǿ����ϴ�.","acceleration_employment_view.php?w=".$w."&id=".$id."&page=".$page."&".$qstr);
?>