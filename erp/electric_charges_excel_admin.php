<?
$sub_menu = "1900300";
include_once("./_common.php");

$sql_common = " from com_list_gy a, com_list_gy_opt b ";

//echo $member[mb_profile];
if($is_admin != "super") {
	//$stx_man_cust_name = $member[mb_profile];
}
//$is_admin = "super";
//echo $is_admin;
if($member['mb_level'] > 6 || $search_ok == "ok") {
	$sql_search = " where a.com_code = b.com_code ";
	//���� ������� ����
	if($member['mb_level'] == 7) {
		$mb_id = $member['mb_id'];
		//���Ŵ��� �ڵ� üũ
		$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
		$row_manage = sql_fetch($sql_manage);
		$manage_code = $row_manage['code'];
		$sql_search .= " and b.manage_cust_numb='$manage_code' ";
	}
} else {
	$mb_id = $member['mb_id'];
	//���Ŵ��� �ڵ� üũ
	$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
	$row_manage = sql_fetch($sql_manage);
	$manage_code = $row_manage['code'];
	//���� ���� ����
	if($member['mb_level'] == 4) $sql_search = " where a.com_code = b.com_code and ( b.manage_cust_numb='$manage_code' ) ";
	else $sql_search = " where a.com_code = b.com_code and ( a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]' ) ";
}
//�ʼ� �˻����� ���� ����ȣ 150812
$sql_search .= " and a.electric_charges_no != '' ";
//�˻� : ������Ī
if ($stx_comp_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_name like '%$stx_comp_name%') ";
	$sql_search .= " ) ";
}
//�˻� : ����������ȣ
if ($stx_t_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.t_insureno like '%$stx_t_no%') ";
	$sql_search .= " ) ";
}
//�˻� : ����ڵ�Ϲ�ȣ
if ($stx_biz_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.biz_no like '%$stx_biz_no%') ";
	$sql_search .= " ) ";
}
//�˻� : ��ǥ��
if ($stx_boss_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.boss_name like '%$stx_boss_name%') ";
	$sql_search .= " ) ";
}
//�˻� : �����
if($stx_manage_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.manage_cust_name like '%$stx_manage_name%') ";
	$sql_search .= " ) ";
}
//�˻� : ����������ȣ
if($stx_t_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.t_insureno like '%$stx_t_no%') ";
	$sql_search .= " ) ";
}
//�˻� : ��ȭ��ȣ
if ($stx_comp_tel) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_tel like '%$stx_comp_tel%') ";
	$sql_search .= " ) ";
}
//�˻� : �ѽ���ȣ
if($stx_comp_fax) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_fax like '%$stx_comp_fax%') ";
	$sql_search .= " ) ";
}
//����
if($stx_man_cust_name) {
	if($stx_man_cust_name == "dl") $sql_search .= " and (a.damdang_code='110' or a.damdang_code='111') ";
	else if($stx_man_cust_name == "gj") $sql_search .= " and (a.damdang_code>='112' and a.damdang_code<='118') ";
	else $sql_search .= " and a.damdang_code = '$stx_man_cust_name' ";
}
//�˻� : ����
if($stx_man_cust_name2) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.damdang_code2 = '$stx_man_cust_name2') ";
	$sql_search .= " ) ";
}
//�˻� : ����
if ($stx_uptae) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.uptae like '%$stx_uptae%') ";
	$sql_search .= " ) ";
}
//�˻� : ����
if ($stx_upjong) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.upjong like '%$stx_upjong%') ";
	$sql_search .= " ) ";
}
//����ڵ�Ϲ�ȣ �̵��
if($stx_biz_no_input_not) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.biz_no = '-' or a.biz_no = '') ";
	$sql_search .= " ) ";
}
//����������ȣ �̵��
if($stx_t_no_input_not) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.t_insureno = '-' or a.t_insureno = '') ";
	$sql_search .= " ) ";
}
//�ּҰ˻�
if ($stx_addr) {
	if ($stx_addr_first) $addr_first = "";
	else $addr_first = "%";
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_juso like '".$addr_first;
	$sql_search .= "$stx_addr%') ";
	$sql_search .= " ) ";
}
//�������˻�
if($stx_area1 || $stx_area2 || $stx_area3 || $stx_area4 || $stx_area5 || $stx_area6 || $stx_area7 || $stx_area8 || $stx_area9 || $stx_area10 || $stx_area11 || $stx_area12 || $stx_area13 || $stx_area14 || $stx_area15 || $stx_area16 || $stx_area17) $sql_search .= " and ( ";
if($stx_area_not) {
	$area_not = "not";
	$area_or_var = "and";
} else {
	$area_not = "";
	$area_or_var = "or";
}
$area_or = "";
if($stx_area1) {
	$sql_search .= " (a.com_juso $area_not like '����%') ";
	$area_or = $area_or_var;
}
if($stx_area2) {
	$sql_search .= " $area_or (a.com_juso $area_not like '�λ�%') ";
	$area_or = $area_or_var;
}
if($stx_area3) {
	$sql_search .= " $area_or (a.com_juso $area_not like '��õ%') ";
	$area_or = $area_or_var;
}
if($stx_area4) {
	$sql_search .= " $area_or (a.com_juso $area_not like '�뱸%') ";
	$area_or = $area_or_var;
}
if($stx_area5) {
	$sql_search .= " $area_or (a.com_juso $area_not like '����%') ";
	$area_or = $area_or_var;
}
if($stx_area6) {
	$sql_search .= " $area_or (a.com_juso $area_not like '����%') ";
	$area_or = $area_or_var;
}
if($stx_area7) {
	$sql_search .= " $area_or (a.com_juso $area_not like '���%') ";
	$area_or = $area_or_var;
}
if($stx_area8) {
	$sql_search .= " $area_or (a.com_juso $area_not like '���%') ";
	$area_or = $area_or_var;
}
if($stx_area9) {
	$sql_search .= " $area_or (a.com_juso $area_not like '���%' $area_or_var a.com_juso $area_not like '���ϵ�%') ";
	$area_or = $area_or_var;
}
if($stx_area10) {
	$sql_search .= " $area_or (a.com_juso $area_not like '�泲%' $area_or_var a.com_juso $area_not like '��󳲵�%') ";
	$area_or = $area_or_var;
}
if($stx_area11) {
	$sql_search .= " $area_or (a.com_juso $area_not like '����%' $area_or_var a.com_juso $area_not like '����ϵ�%') ";
	$area_or = $area_or_var;
}
if($stx_area12) {
	$sql_search .= " $area_or (a.com_juso $area_not like '����%' $area_or_var a.com_juso $area_not like '���󳲵�%') ";
	$area_or = $area_or_var;
}
if($stx_area13) {
	$sql_search .= " $area_or (a.com_juso $area_not like '���%' $area_or_var a.com_juso $area_not like '��û�ϵ�%') ";
	$area_or = $area_or_var;
}
if($stx_area14) {
	$sql_search .= " $area_or (a.com_juso $area_not like '�泲%' $area_or_var a.com_juso $area_not like '��û����%') ";
	$area_or = $area_or_var;
}
if($stx_area15) {
	$sql_search .= " $area_or (a.com_juso $area_not like '����%') ";
	$area_or = $area_or_var;
}
if($stx_area16) {
	$sql_search .= " $area_or (a.com_juso $area_not like '����%') ";
	$area_or = $area_or_var;
}
if($stx_area17) {
	$sql_search .= " $area_or (a.com_juso $area_not like '����%') ";
}
if($stx_area1 || $stx_area2 || $stx_area3 || $stx_area4 || $stx_area5 || $stx_area6 || $stx_area7 || $stx_area8 || $stx_area9 || $stx_area10 || $stx_area11 || $stx_area12 || $stx_area13 || $stx_area14 || $stx_area15 || $stx_area16 || $stx_area17) $sql_search .= " ) ";
//���� ����ȣ 150831
if($stx_electric_charges_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.electric_charges_no like '$stx_electric_charges_no%') ";
	$sql_search .= " ) ";
}
//�����з��˻�
if($stx_industry1 || $stx_industry2 || $stx_industry3 || $stx_industry4 || $stx_industry5 || $stx_industry6 || $stx_industry7 || $stx_industry8 || $stx_industry9 || $stx_industry10 || $stx_industry11 || $stx_industry99) {
	$sql_search .= " and ( ";
}
if($stx_industry_not) {
	$industry_not = "not";
	$industry_or_var = "and";
} else {
	$industry_not = "";
	$industry_or_var = "or";
}
$industry_or = "";
if($stx_industry1) {
	$sql_search .= " (a.uptae $industry_not like '%����%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry2) {
	$sql_search .= " $industry_or (a.uptae like '%����%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry3) {
	$sql_search .= " $industry_or (a.uptae like '%�Ǽ�%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry4) {
	$sql_search .= " $industry_or (a.uptae $industry_not like '%�����ü�%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry5) {
	$sql_search .= " $industry_or (a.uptae $industry_not like '%��ȸ����%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry6) {
	$sql_search .= " $industry_or (a.uptae $industry_not like '%����%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry7) {
	$sql_search .= " $industry_or (a.uptae $industry_not like '%�Ƿ�%' $industry_or_var a.uptae $industry_not like '%����%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry8) {
	$sql_search .= " $industry_or (a.uptae $industry_not like '%����%' $industry_or_var a.uptae $industry_not like '%�Ҹ�%' $industry_or_var a.uptae $industry_not like '%����%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry9) {
	$sql_search .= " $industry_or (a.uptae $industry_not like '%������%' $industry_or_var a.uptae $industry_not like '%����%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry10) {
	$sql_search .= " $industry_or (a.uptae $industry_not like '%������%' $industry_or_var a.uptae $industry_not like '%����%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry11) {
	$sql_search .= " $industry_or (a.uptae $industry_not like '%���%' $industry_or_var a.uptae $industry_not like '%��ȸ%' $industry_or_var a.uptae $industry_not like '%��ü%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry99) {
	if(!$industry_not) $sql_search .= " $industry_or (a.uptae = '' $industry_or_var a.uptae = '-') ";
	else $sql_search .= " $industry_or (a.uptae != '' $industry_or_var a.uptae != '-') ";
}
if($stx_industry1 || $stx_industry2 || $stx_industry3 || $stx_industry4 || $stx_industry5 || $stx_industry6 || $stx_industry7 || $stx_industry8 || $stx_industry9 || $stx_industry10 || $stx_industry11 || $stx_industry99) $sql_search .= " ) ";
//�˻� : ó����Ȳ
if($stx_process) {
	$sql_search .= " and ( ";
	if($stx_process == "no") $sql_search .= " (a.electric_charges_process = '') ";
	else $sql_search .= " (a.electric_charges_process = '$stx_process') ";
	$sql_search .= " ) ";
}
//�����ٰ���
if ($stx_electric_charges_visit_kind) {
	$sql_search .= " and ( ";
	$sql_search .= " a.electric_charges_visit_kind = '$stx_electric_charges_visit_kind' ";
	$sql_search .= " ) ";
}
//��� �߻� ���� 160127
if($stx_payments) $sql_search .= " and a.electric_charges_payments != '' ";
if($stx_cost) $sql_search .= " and a.electric_charges_cost != '' ";
//�������, õ���� �޸� ���� �� �� 160202
if($stx_electric_charges_watt1 != "") $sql_search .= " and ( replace(a.electric_charges_watt,',','') >= $stx_electric_charges_watt1 and replace(a.electric_charges_watt,',','') <= $stx_electric_charges_watt2) ";
//1�� �������ǥ ��û 160411
if($stx_reduce_ask) $sql_search .= " and a.electric_charges_reduce_ask != '' ";
//1�� �������ǥ ��û 160411
if($stx_search_ask) $sql_search .= " and a.electric_charges_search_ask != '' ";
//�������� 160517
if($stx_construct_chk) $sql_search .= " and a.electric_charges_construct_chk != '' ";
//���±���
if($stx_electric_charges_power_kind) {
	//����
	if($stx_electric_charges_power_kind == 1) $sql_search .= " and (a.electric_charges_existing='1' or a.electric_charges_existing='4' or a.electric_charges_existing='7' or a.electric_charges_existing='11' or a.electric_charges_existing='14' or a.electric_charges_existing='17' or a.electric_charges_existing='21' or a.electric_charges_existing='24') ";
	//���
	else $sql_search .= " and (a.electric_charges_existing='2' or a.electric_charges_existing='3' or a.electric_charges_existing='5' or a.electric_charges_existing='6' or a.electric_charges_existing='8' or a.electric_charges_existing='9' or a.electric_charges_existing='40' or a.electric_charges_existing='10' or a.electric_charges_existing='50' or a.electric_charges_existing='20' or a.electric_charges_existing='12' or a.electric_charges_existing='13' or a.electric_charges_existing='32' or a.electric_charges_existing='31' or a.electric_charges_existing='15' or a.electric_charges_existing='16' or a.electric_charges_existing='30' or a.electric_charges_existing='18' or a.electric_charges_existing='19' or a.electric_charges_existing='22' or a.electric_charges_existing='25' or a.electric_charges_existing='26') ";
}
//�������
if($stx_search_day_chk) {
	$date = explode(".", $search_sday);
	$year = $date[0];
	$month = $date[1]; 
	$day = $date[2]; 
	$search_sday_var = $year."-".$month."-".$day." 00:00:00";
	if($search_eday) {
		$date = explode(".", $search_eday);
		$year = $date[0];
		$month = $date[1]; 
		$day = $date[2]; 
	}
	$search_eday_var = $year."-".$month."-".$day." 23:59:59";
	$sql_search .= " and (a.electric_charges_regdt >= '$search_sday_var' and a.electric_charges_regdt <= '$search_eday_var') ";
}

//����
if (!$sst) {
    $sst = "a.electric_charges_regdt";
    $sod = "desc";
}

$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 9999;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$sub_title = "������������";
$sql = " select *
          $sql_common
          $sql_search
          $sql_order
			";
//echo $sql;
$result = sql_query($sql);
if($member['mb_level'] > 6) $cell = array("No","����Ͻ�","������","����","�ּ�","��ȭ��ȣ","��ǥ��HP","�̸���","��ǥ��","����ȣ","���ε�Ϲ�ȣ","�ֹε�Ϲ�ȣ","���������","�������","�����(1�Ⱓ)","��������ݾ�1","�������Ա�1","�����1","������1","��������ݾ�2","�������Ա�2","�����2","������2","ó����Ȳ","����","�����","���޸�","ó�����");
else												$cell = array("No","����Ͻ�","������","����","�ּ�","��ȭ��ȣ","��ǥ��HP","�̸���","��ǥ��","����ȣ","���ε�Ϲ�ȣ","�ֹε�Ϲ�ȣ",           "�����(1�Ⱓ)","��������ݾ�1","�������Ա�1","�����1","������1","��������ݾ�2","�������Ա�2","�����2","������2","ó����Ȳ","����","�����","���޸�","ó�����");
$colspan = count($cell) + 1;
$now_date_file = date("Ymd");
$file_name = $sub_title."_".$now_date_file.".xls";
header("Pragma:");
header("Cache-Control:");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
header("Content-Description: PHP5 Generated Data");
?>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:x="urn:schemas-microsoft-com:office:excel">
<meta http-equiv="Content-Type" content="application/vnd.ms-excel; charset=euc-kr">
<style type="text/css">
table { font-size:10px; }
</style>
<table width='1200' border='1' cellspacing="1" cellpadding="3" bgcolor="#5B8398">
			<tr bgcolor="65CBFF" align=center>
<?
for($i=0; $i<count($cell); $i++) {
?>
				<td align="center"><?=$cell[$i]?></td>
<?
}
//������� �迭 160317;
$electric_charges_existing_arry[1] = "�����(��)�� ����";
$electric_charges_existing_arry[2] = "�����(��)�� ���A ���å�";
$electric_charges_existing_arry[3] = "�����(��)�� ���A ���å�";
$electric_charges_existing_arry[4] = "�Ϲݿ�(��)�� ����";
$electric_charges_existing_arry[5] = "�Ϲݿ�(��)�� ���A ���å�";
$electric_charges_existing_arry[6] = "�Ϲݿ�(��)�� ���A ���å�";
$electric_charges_existing_arry[7] = "������(��)�� ����";
$electric_charges_existing_arry[8] = "������(��)�� ���A ���å�";
$electric_charges_existing_arry[9] = "������(��)�� ���A ���å�";

$electric_charges_existing_arry[40] = "�Ϲݿ�(��)�� ���A ���å�";
$electric_charges_existing_arry[10] = "�Ϲݿ�(��)�� ���A ���å�";
$electric_charges_existing_arry[50] = "�����(��)�� ���A ���å�";
$electric_charges_existing_arry[20] = "�����(��)�� ���A ���å�";

$electric_charges_existing_arry[11] = "�����(��) ����";
$electric_charges_existing_arry[12] = "�����(��) ���A ���å�";
$electric_charges_existing_arry[13] = "�����(��) ���A ���å�";
$electric_charges_existing_arry[32] = "�����(��) ���A ���å�";
$electric_charges_existing_arry[31] = "�����(��) ���B ���å�";

$electric_charges_existing_arry[14] = "�Ϲݿ�(��) ����";
$electric_charges_existing_arry[15] = "�Ϲݿ�(��) ���A ���å�";
$electric_charges_existing_arry[16] = "�Ϲݿ�(��) ���A ���å�";
$electric_charges_existing_arry[30] = "�Ϲݿ�(��) ���B ���å�";

$electric_charges_existing_arry[17] = "������(��) ����";
$electric_charges_existing_arry[18] = "������(��) ���A ���å�";
$electric_charges_existing_arry[19] = "������(��) ���A ���å�";

$electric_charges_existing_arry[21] = "����(��) ����";
$electric_charges_existing_arry[22] = "����(��) ���";
$electric_charges_existing_arry[24] = "����(��) ����";
$electric_charges_existing_arry[25] = "����(��) ���A";
$electric_charges_existing_arry[26] = "����(��) ���B";
// ����Ʈ ���
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//NO �ѹ�
	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;
	$id = $row['com_code'];
	//�������
	$date1 = substr($row['electric_charges_regdt'],0,10); //��¥ǥ�����ĺ���
	$electric_charges_regdt_time = substr($row['electric_charges_regdt'],11,8); //�ð��� ǥ��
	$date = explode("-", $date1); 
	$year = $date[0];
	$month = $date[1]; 
	$day = $date[2]; 
	$electric_charges_regdt = $year.".".$month.".".$day."";
	//������
	$com_name_full = $row['com_name'];
	$com_name = cut_str($com_name_full, 28, "..");
	//�þ��� ����
	if($row['upche_div'] == "2") {
		$upche_div = "����";
	} else {
		$upche_div = "����";
	}
	//�ּ�
	$com_juso_full = $row['com_juso']." ".$row['com_juso2'];
	$com_juso = cut_str($com_juso_full, 28, "..");
	if($row['electric_charges_memo']) $memo_full = $row['electric_charges_memo'];
	else $memo_full = "���޸� ����";
	$memo = cut_str($memo_full, 48, "..");
	if($row['electric_charges_etc']) $etc_full = $row['electric_charges_etc'];
	else $etc_full = "";
	$etc = "<br>".cut_str($etc_full, 48, "..");
	//�ֱ� �������� NEW ǥ��
	//echo date("Y-m-d H:i:s", time() - 96 * 3600);
	if($row['editdt'] >= date("Y-m-d H:i:s", time() - 24 * 3600)) { 
		$etc_new = "<img src='images/icon_new.gif' border='0' style='vertical-align:middle;'>";
	} else {
		$etc_new = "";
	}
	$etc = $etc.$etc_new;
	//������
	$damdang_code = $row['damdang_code'];
	if($damdang_code) {
		$branch = $man_cust_name_arry[$damdang_code];
		if($row['damdang_code2']) {
			$damdang_code2 = $row['damdang_code2'];
			$branch .= ">".$man_cust_name_arry[$damdang_code2];
		}
	} else {
		$branch = "-";
	}
	//��ǥ�ڸ�
	if($row['boss_name']) {
		$boss_name = $row['boss_name'];
	} else {
		$boss_name = "-";
	}	
	//����ȣ
	if($row['electric_charges_no']) {
		$electric_charges_no = $row['electric_charges_no'];
	} else {
		$electric_charges_no = "-";
	}
	//���ε�Ϲ�ȣ
	if($row['electric_charges_bupin']) {
		$electric_charges_bupin = $row['electric_charges_bupin'];
	} else {
		$electric_charges_bupin = "-";
	}
	//���� ������ �ֹε�Ϲ�ȣ
	if($row['electric_charges_ssnb']) {
		$electric_charges_ssnb = $row['electric_charges_ssnb'];
	} else {
		$electric_charges_ssnb = "-";
	}
	//������ ���� ��� - ǥ�� : ��ȭ��ȣ, �޴���
	if(!$row['com_tel']) $row['com_tel'] = "-";
	if(!$row['com_hp']) $row['com_hp'] = "-";
	if(!$row['area']) $row['area'] = "-";
	//�����
	if(!$row['manage_cust_name']) {
		$manager = "-";
	} else {
		$manager = $row['manage_cust_name'];
	}
	if(!$row['writer_tel']) $row['writer_tel'] = "-";
	if(!$row['process_date']) $row['process_date'] = "-";
	if(!$row['process_date2']) $row['process_date2'] = "-";
	//���������
	if($row['electric_charges_existing']) {
		$electric_charges_existing = $row['electric_charges_existing'];
		$electric_charges_existing_text = $electric_charges_existing_arry[$electric_charges_existing];
	} else {
		$electric_charges_existing_text = "-";
	}
	//�������
	if($row['electric_charges_watt']) $electric_charges_watt = $row['electric_charges_watt']."kW";
	else $electric_charges_watt = "-";
	//�����(1�Ⱓ)
	if($row['electric_charges_year_fee']) $electric_charges_year_fee = $row['electric_charges_year_fee'];
	else $electric_charges_year_fee = "-";

	//�������Ա�
	if($row['electric_charges_payments']) $electric_charges_payments = $row['electric_charges_payments'];
	else $electric_charges_payments = "-";
	//��������ݾ�
	if($row['electric_charges_reduce']) $electric_charges_reduce = $row['electric_charges_reduce'];
	else $electric_charges_reduce = "-";
	//�����
	if($row['electric_charges_cost']) $electric_charges_cost = $row['electric_charges_cost']."~".$row['electric_charges_cost2']."��";
	else $electric_charges_cost = "-";
	//������
	if($row['electric_charges_commission']) $electric_charges_commission = $row['electric_charges_commission'];
	else $electric_charges_commission = "-";

	//�������Ա�2
	if($row['electric_charges_payments2']) $electric_charges_payments2 = $row['electric_charges_payments2'];
	else $electric_charges_payments2 = "-";
	//��������ݾ�2
	if($row['electric_charges_reduce2']) $electric_charges_reduce2 = $row['electric_charges_reduce2'];
	else $electric_charges_reduce2 = "-";
	//�����2
	if($row['electric_charges_cost_b']) $electric_charges_cost2 = $row['electric_charges_cost_b']."~".$row['electric_charges_cost2_b']."��";
	else $electric_charges_cost2 = "-";
	//������2
	if($row['electric_charges_commission2']) $electric_charges_commission2 = $row['electric_charges_commission2'];
	else $electric_charges_commission2 = "-";

	//ó����Ȳ
	$check_ok_id = $row['electric_charges_process'];
?>
			<tr bgcolor="#FFFFFF" align=center>
				<td align="center"><?=$no?></td>
				<td align="center"><?=$row['electric_charges_regdt']?></td>
				<td align="left" width="194"><?=$com_name_full?></td>
				<td align="center"><?=$row['uptae']?></td>
				<td align="left" width="328"><?=$zip?><?=$com_juso_full?></td>
				<td align="center"><?=$row['com_tel']?></td>
				<td align="center"><?=$row['boss_hp']?></td>
				<td align="center"><?=$row['com_mail']?></td>
				<td align="center"><?=$boss_name?></td>
				<td align="center" x:str><?=$electric_charges_no?></td>
				<td align="center"><?=$electric_charges_bupin?></td>
				<td align="center"><?=$electric_charges_ssnb?></td>
<?
	//���縸 ������� ǥ�� 160425
	if($member['mb_level'] > 6) {
?>
				<td align="center"><?=$electric_charges_existing_text?></td>
				<td align="center"><?=$electric_charges_watt?></td>
<?
	}
?>
				<td align="center"><?=$electric_charges_year_fee?></td>

				<td align="center"><?=$electric_charges_reduce?></td>
				<td align="center"><?=$electric_charges_payments?></td>
				<td align="center"><?=$electric_charges_cost?></td>
				<td align="center"><?=$electric_charges_commission?></td>

				<td align="center"><?=$electric_charges_reduce2?></td>
				<td align="center"><?=$electric_charges_payments2?></td>
				<td align="center"><?=$electric_charges_cost2?></td>
				<td align="center"><?=$electric_charges_commission2?></td>

				<td align="center"><?=$electric_charges_process_arry[$check_ok_id]?></td>
				<td align="center"><?=$branch?></td>
				<td align="center"><?=$manager?></td>
				<td align="left"><?=$memo_full?></td>
				<td align="left" width="328"><?=$etc_full?></td>
			</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
?>
</table>
<?
exit;
?>
