<?
$sub_menu = "2000100";
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
//�⺻ �ʵ�
$sql_common = " regdt = '$regdt',

						com_name = '$com_name',
						upche_div = '$comp_type',
						upjong = '$upjong',
						damdang_code = '$damdang_code',

						comp_bznb = '$comp_bznb',
						new_postno = '$new_zip',
						com_postno = '$adr_zip',
						com_juso = '$adr_adr1',
						com_juso2 = '$adr_adr2',
						boss_name = '$boss_name',
						com_tel = '$com_tel',
						com_fax = '$com_fax',
						com_hp = '$com_hp',

						visitdt = '$visitdt',
						visitdt_time = '$visitdt_time',

						memo = '$memo',
						writer = '$manage_cust_numb',
						writer_name = '$manage_cust_name',
						check_ok = '$check_ok',
						manager = '$manager_code',
						manager_name = '$manager_name',
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
//����
if ($w == 'u'){
	$sql = " update erp_visit set 
				$sql_common 
			  where id = '$id' ";
	//echo $sql;
	//exit;
	sql_query($sql);
	alert("���������� �湮������ ������ ���� �Ǿ����ϴ�.","schedule_view.php?id=$id&w=$w&page=$page");
//���
} else {
	$sql = " insert erp_visit set 
					$sql_common 
					, regtime = '$now_time'
					, com_code = '$com_code' ";
	sql_query($sql);
	alert("���������� �湮������ ������ ��� �Ǿ����ϴ�.","list_notice.php?bo_table=erp_visit");
}
?>
