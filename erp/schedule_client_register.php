<?
$sub_menu = "2000100";
include_once("./_common.php");
$now_time = date("Y-m-d H:i:s");
$now_time_only = date("H:i:s");
$now_time_file = date("Ymd_His");
$now_date = date("Y.m.d");
//��ȭ��ȣ
if($com_tel1) $com_tel = $com_tel1."-".$com_tel2."-".$com_tel3;
//�޴���
if($cust_cel1) $com_hp = $cust_cel1."-".$cust_cel2."-".$cust_cel3;
//�����ȣ
if($adr_zip1) $adr_zip = $adr_zip1."-".$adr_zip2;
//����� ����
$mb_id = $member['mb_id'];
//���Ŵ���
$sql_manage = " select * from a4_manage where item='manage' and state='1' and user_id='$mb_id' ";
$result_manage = sql_query($sql_manage);
$row_manage = mysql_fetch_array($result_manage);
$manage_cust_numb = $row_manage['code'];
$manage_cust_name = $row_manage['name'];
//�⺻����
$sql_common = " editdt = '$now_date',
						regdt = '$now_date',
						com_name = '$com_name',
						upche_div = '$comp_type',
						uptae = '$upjong',
						damdang_code = '$damdang_code',
						damdang_code2 = '$damdang_code2',
						biz_no = '$comp_bznb',
						new_postno = '$new_zip',
						com_postno = '$adr_zip',
						com_juso = '$adr_adr1',
						com_juso2 = '$adr_adr2',
						boss_name = '$boss_name',
						com_tel = '$com_tel',
						com_fax = '$com_fax',
						boss_hp = '$com_hp',
						com_mail = '$com_mail'
";
//�߰�����
$sql_common2 = "
						com_name_opt = '$com_name',
						manage_cust_numb = '$manage_cust_numb',
						manage_cust_name = '$manage_cust_name'
";
//�߰�����2
$sql_common_opt2 = "
						com_name_opt2 = '$com_name'
";
//����ڵ�Ϲ�ȣ ��ȸ : ����� com_code ����
$sql_com = " select com_code from com_list_gy where biz_no='$comp_bznb' ";
//echo $sql_com;
//exit;
$result_com = sql_query($sql_com);
$row_com = mysql_fetch_array($result_com);
$com_code = $row_com['com_code'];
if($com_code) {
	alert("�̹� ��ϵ� �ŷ�ó�Դϴ�.");
} else {
	$sql_max = "select max(com_code) from com_list_gy ";
	$result_max = sql_query($sql_max);
	$row_max = mysql_fetch_array($result_max);
	$com_code = $row_max[0]+1;
	$sql_base = " insert com_list_gy set $sql_common , com_code = '$com_code' ";
	$sql1 = " insert com_list_gy_opt set $sql_common2 , com_code = '$com_code' ";
	$sql2 = " insert com_list_gy_opt2 set $sql_common_opt2 , com_code = '$com_code' ";
	sql_query($sql_base);
	sql_query($sql1);
	sql_query($sql2);
}
//����ڵ�Ϲ�ȣ ���â��DB ����
$sql = " update erp_visit set 
			comp_bznb='$comp_bznb', com_code='$com_code'
			where id='$id' ";
//echo $sql;
//exit;
sql_query($sql);
//echo $sql2;
//exit;
//alert("���������� �ű� �ŷ�ó�� ��� �Ǿ����ϴ�.","schedule_view.php?id=$id&w=$w&page=$page");
//�ŷ�ó ���� ���� �������� �̵� / ����� ��û 160204
alert("���������� �ű� �ŷ�ó�� ��� �Ǿ����ϴ�.","client_view.php?id=$com_code&w=u");
?>
