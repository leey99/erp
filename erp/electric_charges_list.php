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
//if($member['mb_level'] > 6 || $search_ok == "ok") {
if($member['mb_profile'] == 1) {
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
	//���� ����, ������� ����
	if($member['mb_level'] <= 5) $sql_search = " where a.com_code = b.com_code and ( b.manage_cust_numb='$manage_code' ) ";
	else $sql_search = " where a.com_code = b.com_code and ( a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]' ) ";
}
//�ʼ� �˻����� ���� ����ȣ 150812
$sql_search .= " and a.electric_charges_no != '' ";
//������Ī
if ($stx_comp_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_name like '%$stx_comp_name%') ";
	$sql_search .= " ) ";
}
//����������ȣ
if ($stx_t_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.t_insureno like '%$stx_t_no%') ";
	$sql_search .= " ) ";
}
//����ڵ�Ϲ�ȣ
if ($stx_biz_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.biz_no like '%$stx_biz_no%') ";
	$sql_search .= " ) ";
}
//��ǥ��
if ($stx_boss_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.boss_name like '%$stx_boss_name%') ";
	$sql_search .= " ) ";
}
//�����
if($stx_manage_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.manage_cust_name like '%$stx_manage_name%') ";
	$sql_search .= " ) ";
}
//����������ȣ
if($stx_t_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.t_insureno like '%$stx_t_no%') ";
	$sql_search .= " ) ";
}
//��ȭ��ȣ
if ($stx_comp_tel) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_tel like '%$stx_comp_tel%') ";
	$sql_search .= " ) ";
}
//�ѽ���ȣ
if($stx_comp_fax) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_fax like '%$stx_comp_fax%') ";
	$sql_search .= " ) ";
}
//���� : ����+���� �˻� / ������ 110~119 161010
if($stx_man_cust_name) {
	//if($stx_man_cust_name == "dl") $sql_search .= " and (a.damdang_code>=110 and a.damdang_code<=119) ";
	//else $sql_search .= " and a.damdang_code = '$stx_man_cust_name' ";
	if($stx_man_cust_name == "dl") $sql_search .= " and ( (a.damdang_code>='110' and a.damdang_code<='119') or (a.damdang_code2>='110' and a.damdang_code2<='119') ) ";
	else $sql_search .= " and (a.damdang_code = '$stx_man_cust_name' or a.damdang_code2 = '$stx_man_cust_name') ";
}
//����
if($stx_man_cust_name2) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.damdang_code2 = '$stx_man_cust_name2') ";
	$sql_search .= " ) ";
}
//����
if ($stx_uptae) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.uptae like '%$stx_uptae%') ";
	$sql_search .= " ) ";
}
//����
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
//���ε�Ϲ�ȣ 161122
if($stx_electric_charges_bupin) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.electric_charges_bupin like '%$stx_electric_charges_bupin%') ";
	$sql_search .= " ) ";
}
//ó����Ȳ
if($stx_process) {
	$sql_search2 = " and ( ";
	if($stx_process == "no") $sql_search2 .= " (a.electric_charges_process = '') ";
	else $sql_search2 .= " (a.electric_charges_process = '$stx_process') ";
	$sql_search2 .= " ) ";
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
if($stx_electric_charges_watt1 != "") {
	//���� ���� ������ ���� ��� ���� ���� ������ ���� 160602 / 100,000 �̸� ���� ǥ�� 160630
	if(!$stx_electric_charges_watt2) $stx_electric_charges_watt2 = 99999;
	$sql_search .= " and ( replace(a.electric_charges_watt,',','') >= $stx_electric_charges_watt1 and replace(a.electric_charges_watt,',','') <= $stx_electric_charges_watt2) ";
}
//1�� �������ǥ ��û 160411
if($stx_reduce_ask) $sql_search .= " and a.electric_charges_reduce_ask != '' ";
//1�� �������ǥ ��û 160411
if($stx_search_ask) $sql_search .= " and a.electric_charges_search_ask != '' ";
//�������� 160517
//if($stx_construct_chk) $sql_search .= " and a.electric_charges_construct_chk != '' ";
//if($stx_construct_chk) $sql_search .= " and a.electric_charges_construct_chk = '$stx_construct_chk' ";
if($stx_construct_chk) $sql_search .= " and ( a.electric_charges_construct_chk = '$stx_construct_chk' or a.electric_charges_construct_chk2 = '$stx_construct_chk' ) ";
//���±���
if($stx_electric_charges_power_kind) {
	//����
	if($stx_electric_charges_power_kind == 1) $sql_search .= " and (a.electric_charges_existing='1' or a.electric_charges_existing='4' or a.electric_charges_existing='7' or a.electric_charges_existing='11' or a.electric_charges_existing='14' or a.electric_charges_existing='17' or a.electric_charges_existing='21' or a.electric_charges_existing='24') ";
	//���
	else $sql_search .= " and (a.electric_charges_existing='2' or a.electric_charges_existing='3' or a.electric_charges_existing='5' or a.electric_charges_existing='6' or a.electric_charges_existing='8' or a.electric_charges_existing='9' or a.electric_charges_existing='40' or a.electric_charges_existing='10' or a.electric_charges_existing='50' or a.electric_charges_existing='20' or a.electric_charges_existing='12' or a.electric_charges_existing='13' or a.electric_charges_existing='32' or a.electric_charges_existing='31' or a.electric_charges_existing='15' or a.electric_charges_existing='16' or a.electric_charges_existing='30' or a.electric_charges_existing='18' or a.electric_charges_existing='19' or a.electric_charges_existing='22' or a.electric_charges_existing='25' or a.electric_charges_existing='26') ";
}
//�г� 160614
if($stx_installment) $sql_search .= " and a.electric_charges_installment != '' ";
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

//�������� : �������� ����
if($stx_process == 13) {
	$sst = "a.electric_charges_construct_date";
  $sod = "desc";
}

//����
if (!$sst) {
    $sst = "a.electric_charges_regdt";
    $sod = "desc";
}
$sql_order = " order by $sst $sod ";
//ī��Ʈ
$sql = " select count(*) as cnt
         $sql_common
         $sql_search $sql_search2
         $sql_order ";
//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$top_sub_title = "images/top19_03.gif";
$sub_title = "������";
$g4['title'] = $sub_title." : ����о� : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search $sql_search2
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 15;

//�˻� �Ķ���� ����
$qstr  = "search_detail=".$search_detail;
$qstr .= "&stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_biz_no=".$stx_biz_no."&stx_boss_name=".$stx_boss_name."&stx_comp_tel=".$stx_comp_tel."&stx_comp_fax=".$stx_comp_fax."&stx_man_cust_name=".$stx_man_cust_name."&stx_man_cust_name2=".$stx_man_cust_name2."&stx_uptae=".$stx_uptae."&stx_upjong=".$stx_upjong."&search_ok=".$search_ok."&stx_process=".$stx_process;
$qstr .= "&stx_biz_no_input_not=".$stx_biz_no_input_not."&stx_t_no_input_not=".$stx_t_no_input_not."&stx_area1=".$stx_area1."&stx_area2=".$stx_area2."&stx_area3=".$stx_area3."&stx_area4=".$stx_area4."&stx_area5=".$stx_area5."&stx_area6=".$stx_area6."&stx_area7=".$stx_area7."&stx_area8=".$stx_area8."&stx_area9=".$stx_area9."&stx_area10=".$stx_area10."&stx_area11=".$stx_area11."&stx_area12=".$stx_area12."&stx_area13=".$stx_area13."&stx_area14=".$stx_area14."&stx_area15=".$stx_area15."&stx_area16=".$stx_area16."&stx_area17=".$stx_area17."&stx_area_not=".$stx_area_not;
$qstr .= "&stx_addr=".$stx_addr."&stx_addr_first=".$stx_addr_first."&stx_manage_name=".$stx_manage_name."&stx_electric_charges_no=".$stx_electric_charges_no."&stx_ecount=".$stx_ecount."&stx_industry1=".$stx_industry1."&stx_industry2=".$stx_industry2."&stx_industry3=".$stx_industry3."&stx_industry4=".$stx_industry4."&stx_industry5=".$stx_industry5."&stx_industry6=".$stx_industry6."&stx_industry7=".$stx_industry7."&stx_industry8=".$stx_industry8."&stx_industry9=".$stx_industry9."&stx_industry10=".$stx_industry10."&stx_industry11=".$stx_industry11."&stx_industry99=".$stx_industry99."&stx_industry_not=".$stx_industry_not;
$qstr .= "&stx_electric_charges_visit_kind=".$stx_electric_charges_visit_kind."&stx_payments=".$stx_payments."&stx_cost=".$stx_cost."&stx_electric_charges_watt1=".$stx_electric_charges_watt1."&stx_electric_charges_watt2=".$stx_electric_charges_watt2."&stx_reduce_ask=".$stx_reduce_ask."&stx_search_ask=".$stx_search_ask."&stx_construct_chk=".$stx_construct_chk."&stx_electric_charges_power_kind=".$stx_electric_charges_power_kind."&stx_search_day_chk=".$stx_search_day_chk."&search_sday=".$search_sday."&search_eday=".$search_eday."&stx_installment=".$stx_installment."&stx_electric_charges_bupin=".$stx_electric_charges_bupin;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4['title']?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
<script type="text/javascript" src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script type="text/javascript" src="./js/jquery-1.8.0.min.js" charset="euc-kr"></script>
<script type="text/javascript">
function goSearch() {
	var frm = document.searchForm;
	frm.action = "<?=$_SERVER['PHP_SELF']?>";
	frm.submit();
	return;
}
function checkAll() {
	var f = document.dataForm;
	for( var i = 0; i<f.idx.length; i++ ) {
		f.idx[i].checked = f.checkall.checked;
	}
}
function checked_ok() {
	//alert("������ ������ �����ڿ��� �����Ͻʽÿ�.");
	//return;
	var frm = document.dataForm;
	var chk_cnt = document.getElementsByName("idx");
	var cnt = 0;
	var chk_data ="";

	for(i=0; i<chk_cnt.length ; i++) {
		if(frm.idx[i].checked==true) {
			cnt++;
			chk_data = chk_data + ',' + frm.idx[i].value;
		}
	}
	if(cnt==0) {
	 alert("���õ� �����Ͱ� �����ϴ�.");
	 return;
	} else{
		if(confirm("���� �����Ͻðڽ��ϱ�?")) {
			chk_data = chk_data.substring(1, chk_data.length);
			frm.chk_data.value = chk_data;
			frm.action="electric_charges_delete.php";
			frm.submit();
		} else {
			return;
		}
	} 
}
function open_memo(id) {
	var ret = window.open("./electric_charges_etc.php?id="+id, "electric_charges_etc", "scrollbars=yes,width=600,height=360");
	return;
}
function loadCalendar( obj )
{
	var calendar = new Calendar(0, null, onSelect, onClose);
	calendar.create();
	calendar.parseDate(obj.value);
	calendar.showAtElement(obj, "Br");

	function onSelect(calendar, date)
	{
		var input_field = obj;
		input_field.value = date;
		if (calendar.dateClicked) {
			calendar.callCloseHandler();
		}
	};

	function onClose(calendar)
	{
		calendar.hide();
		calendar.destroy();
	};
}
function only_number_comma() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if(event.keyCode != 46) event.returnValue = false;
	}
}
function goCheck_ok(obj) {
	//alert(obj.name+" "+obj.value);
	var id = obj.name.substring(9,14);
	//alert(id);
	var check_ok = obj.value;
	check_ok_iframe.location.href = "electric_charges_check_ok_update.php?id="+id+"&check_ok="+check_ok;
	return;
}
//�����ݰ�� 160212
function pop_electric_calculate() {
	var ret = window.open("pop_electric_calculate.php", "pop_electric_calculate", "width=450,height=420,scrollbars=no");
	return;
}
//������� ����
function stx_search_day_select(input_obj) {
	var frm = document.searchForm;
	if(input_obj.value == 1) {
		frm['search_sday'].value = "<?=$today?>";
		frm['search_eday'].value = "<?=$today?>";
	} else {
		frm['search_sday'].value = "";
		frm['search_eday'].value = "";
	}
}
//�����ݰ��� 160616
function electric_charges_calculate() {
	var ret = window.open("pop_electric_charges_calculate.php", "pop_electric_charges_calculate", "width=450,height=570,scrollbars=yes");
	return;
}
</script>
<?
if( ($member['mb_profile'] >= 110 && $member['mb_profile'] <= 200) || $member['mb_level'] == 4 ) include "inc/top_dealer.php";
else include "inc/top.php";
?>
		<td onmouseover="showM('900')" valign="top" style="padding:10px 20px 20px 20px;min-height:480px;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="100"><img src="images/top19.gif" border="0" alt="����о�" /></td>
					<td><a href="electric_charges_list.php"><img src="<?=$top_sub_title?>" border="0" alt="������������" /></a></td>
					<td>
<?
$title_main_no = "19";
//���� ������ ��� ǥ��
if($member['mb_profile'] < 110 && $member['mb_level'] != 4) include "inc/sub_menu.php";
?>
					</td>
				</tr>
				<tr><td height="1" bgcolor="#cccccc" colspan="3"></td></tr>
			</table>
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
				<tr>
					<td valign="top" style="padding:10px 0 0 0">
						<!--Ÿ��Ʋ -->	
<?
//���� ��ü ����� ���� ����
$is_admin = "super";
if($is_admin == "super") {
	//echo $stx_man_cust_name;
?>
						<!--������ -->
						<table border="0" cellpadding="0" cellspacing="0"> 
							<tr> 
								<td id=""> 
									<table border="0" cellpadding="0" cellspacing="0"> 
										<tr> 
											<td><img src="images/g_tab_on_lt.gif"></td> 
											<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
											�˻�
											</td> 
											<td><img src="images/g_tab_on_rt.gif"></td> 
										</tr> 
									</table> 
								</td> 
								<td width="2"></td> 
								<td valign="bottom"></td> 
							</tr> 
						</table>
						<div style="height:2px;font-size:0px" class="bgtr"></div>
						<div style="height:2px;font-size:0px;line-height:0px;"></div>
						<!--�˻� -->
						<form name="searchForm" method="get">
							<input type="hidden" name="search_ok" />
							<input type="hidden" name="search_detail" value="<?=$search_detail?>" />
							<!--������ -->
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
								<tr>
									<td nowrap class="tdrowk" width="100"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">������Ī</td>
									<td nowrap class="tdrow" width="150">
										<input name="stx_comp_name" type="text" class="textfm" style="width:120px;" value="<?=$stx_comp_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk" width="110"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����ڵ�Ϲ�ȣ</td>
									<td nowrap class="tdrow" width="200">
										<input name="stx_biz_no" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$stx_biz_no?>" maxlength="12" onkeyup="checkhyphen(this.value, this,'Y')" onkeydown="only_number();if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk" width="80"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��ǥ�ڸ�</td>
									<td nowrap class="tdrow" width="150">
										<input name="stx_boss_name"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_boss_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk" width="80"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����</td>
									<td nowrap class="tdrow" width="112" colspan="">
										<input name="stx_uptae"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_uptae?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
<?
//���� ������ ����, ���� ���� ��� ���� 160530
if( $member['mb_level'] > 7 || ($member['mb_profile'] == 1 && $member['mb_level'] == 4) ) {
	//echo $stx_man_cust_name;
?>
									<td nowrap class="tdrowk" width="70"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����</td>
									<td nowrap class="tdrow" width="">
										<select name="stx_man_cust_name" class="selectfm">
											<option value="">��ü</option>
<?
$damdang_code = $stx_man_cust_name;
include "inc/stx_man_cust_name.php";
?>
										</select>
									</td>
<? } else { ?>
									<td nowrap class="tdrowk"></td>
									<td nowrap class="tdrow">
									</td>
<? } ?>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">�����</td>
									<td nowrap class="tdrow">
										<input name="stx_manage_name" type="text" class="textfm" style="width:120px;" value="<?=$stx_manage_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">����������ȣ</td>
									<td nowrap class="tdrow">
										<input name="stx_t_no" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$stx_t_no?>" maxlength="14" onkeyup="checkhyphen_tno(this.value, this,'Y')" onkeydown="only_number();if(event.keyCode == 13){ goSearch(); }">
										<input type="checkbox" name="stx_t_no_input_not" value="1" <? if($stx_t_no_input_not == 1) echo "checked"; ?> style="vertical-align:middle">�̵��
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">��ȭ��ȣ</td>
									<td nowrap class="tdrow" colspan="">
										<input name="stx_comp_tel"  type="text" class="textfm" style="width:90px;ime-mode:disabled ;" value="<?=$stx_comp_tel?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">�ѽ���ȣ</td>
									<td nowrap class="tdrow" colspan="">
										<input name="stx_comp_fax"  type="text" class="textfm" style="width:90px;ime-mode:disabled;" value="<?=$stx_comp_fax?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
<?
//������ ���� ����, 7->17 160502
if($member['mb_level'] > 17) {
	//echo $stx_man_cust_name;
?>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />����</td>
									<td nowrap class="tdrow">
										<select name="stx_man_cust_name2" class="selectfm">
											<option value="">��ü</option>
<?
	$stx_man_cust_name = $stx_man_cust_name2;
	//���»�, ������, ���ֵ��� �������� ����
	$stx_man_cust_name2_except = 1;
	include "inc/stx_man_cust_name.php";
	$stx_man_cust_name2_except = "";
?>
										</select>
									</td>
<?
} else {
	//�������� �ŷ�ó �˻� 160517
	//�������� ���� ��ü �߰� 160711
?>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />��������</td>
									<td nowrap class="tdrow">
										<select name="stx_construct_chk" class="selectfm">
											<option value="">��ü</option>
											<option value="1" <? if($stx_construct_chk == "1") echo "selected"; ?>><?=$electric_charges_construct_arry[1]?></option>
											<option value="2" <? if($stx_construct_chk == "2") echo "selected"; ?>><?=$electric_charges_construct_arry[2]?></option>
											<option value="3" <? if($stx_construct_chk == "3") echo "selected"; ?>><?=$electric_charges_construct_arry[3]?></option>
											<option value="4" <? if($stx_construct_chk == "4") echo "selected"; ?>><?=$electric_charges_construct_arry[4]?></option>
											<option value="5" <? if($stx_construct_chk == "5") echo "selected"; ?>><?=$electric_charges_construct_arry[5]?></option>
										</select>
									</td>
<?
}
?>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ּҰ˻�</td>
									<td nowrap class="tdrow" colspan="">
										<input name="stx_addr"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_addr?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										<input type="checkbox" name="stx_addr_first" value="1" <? if($stx_addr_first == 1) echo "checked"; ?> style="vertical-align:middle" title="���˻���">
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����˻�<input type="checkbox" name="stx_area_not" value="1" <? if($stx_area_not == 1) echo "checked"; ?> style="vertical-align:middle" title="�˻�����"><span style="font-size:8pt;">����</span></td>
									<td nowrap class="tdrow" colspan="7">
										<input type="checkbox" name="stx_area1" value="1" <? if($stx_area1 == 1) echo "checked"; ?> style="vertical-align:middle">����
										<input type="checkbox" name="stx_area2" value="1" <? if($stx_area2 == 1) echo "checked"; ?> style="vertical-align:middle">�λ�
										<input type="checkbox" name="stx_area3" value="1" <? if($stx_area3 == 1) echo "checked"; ?> style="vertical-align:middle">��õ
										<input type="checkbox" name="stx_area4" value="1" <? if($stx_area4 == 1) echo "checked"; ?> style="vertical-align:middle">�뱸
										<input type="checkbox" name="stx_area5" value="1" <? if($stx_area5 == 1) echo "checked"; ?> style="vertical-align:middle">����
										<input type="checkbox" name="stx_area6" value="1" <? if($stx_area6 == 1) echo "checked"; ?> style="vertical-align:middle">����
										<input type="checkbox" name="stx_area7" value="1" <? if($stx_area7 == 1) echo "checked"; ?> style="vertical-align:middle">���
										<input type="checkbox" name="stx_area8" value="1" <? if($stx_area8 == 1) echo "checked"; ?> style="vertical-align:middle">���
										<input type="checkbox" name="stx_area9" value="1" <? if($stx_area9 == 1) echo "checked"; ?> style="vertical-align:middle">���
										<input type="checkbox" name="stx_area10" value="1" <? if($stx_area10 == 1) echo "checked"; ?> style="vertical-align:middle">�泲
										<input type="checkbox" name="stx_area11" value="1" <? if($stx_area11 == 1) echo "checked"; ?> style="vertical-align:middle">����
										<input type="checkbox" name="stx_area12" value="1" <? if($stx_area12 == 1) echo "checked"; ?> style="vertical-align:middle">����
										<input type="checkbox" name="stx_area13" value="1" <? if($stx_area13 == 1) echo "checked"; ?> style="vertical-align:middle">���
										<input type="checkbox" name="stx_area14" value="1" <? if($stx_area14 == 1) echo "checked"; ?> style="vertical-align:middle">�泲
										<input type="checkbox" name="stx_area15" value="1" <? if($stx_area15 == 1) echo "checked"; ?> style="vertical-align:middle">����
										<input type="checkbox" name="stx_area16" value="1" <? if($stx_area16 == 1) echo "checked"; ?> style="vertical-align:middle">����
										<input type="checkbox" name="stx_area17" value="1" <? if($stx_area17 == 1) echo "checked"; ?> style="vertical-align:middle">����
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">����ȣ</td>
									<td nowrap class="tdrow" colspan="">
										<input name="stx_electric_charges_no"  type="text" class="textfm" style="width:90px;ime-mode:disabled;" value="<?=$stx_electric_charges_no?>" maxlength="10"  onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����з�<input type="checkbox" name="stx_industry_not" value="1" <? if($stx_industry_not == 1) echo "checked"; ?> style="vertical-align:middle" title="�˻�����"><span style="font-size:8pt;">����</span></td>
									<td nowrap class="tdrow" colspan="7">
										<input type="checkbox" name="stx_industry1" value="1" <? if($stx_industry1 == 1) echo "checked"; ?> style="vertical-align:middle">����
										<input type="checkbox" name="stx_industry2" value="1" <? if($stx_industry2 == 1) echo "checked"; ?> style="vertical-align:middle">����
										<input type="checkbox" name="stx_industry3" value="1" <? if($stx_industry3 == 1) echo "checked"; ?> style="vertical-align:middle">�Ǽ�
										<input type="checkbox" name="stx_industry4" value="1" <? if($stx_industry4 == 1) echo "checked"; ?> style="vertical-align:middle">�����ü�
										<input type="checkbox" name="stx_industry5" value="1" <? if($stx_industry5 == 1) echo "checked"; ?> style="vertical-align:middle">��ȸ����
										<input type="checkbox" name="stx_industry6" value="1" <? if($stx_industry6 == 1) echo "checked"; ?> style="vertical-align:middle">������
										<input type="checkbox" name="stx_industry7" value="1" <? if($stx_industry7 == 1) echo "checked"; ?> style="vertical-align:middle">�Ƿ�/����
										<input type="checkbox" name="stx_industry8" value="1" <? if($stx_industry8 == 1) echo "checked"; ?> style="vertical-align:middle">�Ǹ�/����
										<input type="checkbox" name="stx_industry9" value="1" <? if($stx_industry9 == 1) echo "checked"; ?> style="vertical-align:middle">������/����
										<input type="checkbox" name="stx_industry10" value="1" <? if($stx_industry10 == 1) echo "checked"; ?> style="vertical-align:middle">������/����
										<input type="checkbox" name="stx_industry11" value="1" <? if($stx_industry11 == 1) echo "checked"; ?> style="vertical-align:middle">���/��ȸ
										<input type="checkbox" name="stx_industry99" value="1" <? if($stx_industry99 == 1) echo "checked"; ?> style="vertical-align:middle">�̺з�
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">���ε�Ϲ�ȣ</td>
									<td nowrap class="tdrow" colspan="">
										<input name="stx_electric_charges_bupin"  type="text" class="textfm" style="width:90px;ime-mode:disabled;" value="<?=$stx_electric_charges_bupin?>" maxlength="10"  onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk"></td>
									<td nowrap class="tdrow" colspan="7">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">�����ٰ���</td>
									<td nowrap class="tdrow">
										<select name="stx_electric_charges_visit_kind" class="selectfm">
											<option value="">��ü</option>
											<option value="�湮" <? if($stx_electric_charges_visit_kind == "�湮") echo "selected"; ?>>�湮</option>
											<option value="�翬��" <? if($stx_electric_charges_visit_kind == "�翬��") echo "selected"; ?>>�翬��</option>
										</select>
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">���߻�����</td>
									<td nowrap class="tdrow" colspan="">
										<input type="checkbox" name="stx_payments" value="1" <? if($stx_payments == 1) echo "checked"; ?> style="vertical-align:middle" title="">�������Ա�
										<input type="checkbox" name="stx_cost" value="1" <? if($stx_cost == 1) echo "checked"; ?> style="vertical-align:middle" title="">�����
									</td>
<?
if($member['mb_level'] > 7) {
?>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">�������</td>
									<td nowrap class="tdrow">
										<input name="stx_electric_charges_watt1"  type="text" class="textfm" style="width:50px;ime-mode:disabled;" value="<?=$stx_electric_charges_watt1?>" maxlength="5" /> ~
										<input name="stx_electric_charges_watt2"  type="text" class="textfm" style="width:50px;ime-mode:disabled;" value="<?=$stx_electric_charges_watt2?>" maxlength="5" />
<?
	//��ǥ, ������ ���� 160212
	if($member['mb_id'] == "kcmc1001" || $member['mb_id'] == "master") {
?>
										<!--<a href="#pop_electric_calculate" onclick="pop_electric_calculate();return false;" onkeypress="this.onclick" style="margin-left:10px;font-weight:bold;">[�����ݰ��]</a>-->
<?
	}
?>
									</td>
<?
} else {
?>
									<td nowrap class="tdrowk"></td>
									<td nowrap class="tdrow">
									</td>
<?
}
?>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�������ǥ</td>
									<td nowrap class="tdrow">
										<input type="checkbox" name="stx_reduce_ask" value="1" <? if($stx_reduce_ask == 1) echo "checked"; ?> style="vertical-align:middle" title="">��û
									</td>
<?
//���� ���� (����, ������� ����) 160411
if($member['mb_level'] >= 7) {
	//echo $stx_man_cust_name;
?>
									<td nowrap class="tdrowk" width="70"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����ȸ</td>
									<td nowrap class="tdrow" width="98">
										<input type="checkbox" name="stx_search_ask" value="1" <? if($stx_search_ask == 1) echo "checked"; ?> style="vertical-align:middle" title="">����ȸ
									</td>
<? } else { ?>
									<td nowrap class="tdrowk"></td>
									<td nowrap class="tdrow">
									</td>
<? } ?>
								</tr>
<?
//���� ���� ����(������� ����) 160527
if($member['mb_level'] > 7) {
?>
								<tr>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">���±���</td>
									<td nowrap class="tdrow">
										<select name="stx_electric_charges_power_kind" class="selectfm">
											<option value="">��ü</option>
											<option value="1" <? if($stx_electric_charges_power_kind == "1") echo "selected"; ?>>����</option>
											<option value="2" <? if($stx_electric_charges_power_kind == "2") echo "selected"; ?>>���</option>
										</select>
										����/���
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">�������</td>
									<td nowrap class="tdrow" colspan="3">
											<select name="stx_search_day_chk" class="selectfm" onchange="stx_search_day_select(this)">
												<option value=""  <? if($stx_search_day_chk == "")  echo "selected"; ?>>��ü</option>
												<option value="1" <? if($stx_search_day_chk == "1") echo "selected"; ?>>����</option>
												<option value="2" <? if($stx_search_day_chk == "2") echo "selected"; ?>>�Ⱓ����</option>
											</select>
											<input name="search_sday" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$search_sday?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.searchForm.search_sday);" target="">�޷�</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
											~
											<input name="search_eday" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$search_eday?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.searchForm.search_eday);" target="">�޷�</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">�г�</td>
									<td nowrap class="tdrow">
										<input type="checkbox" name="stx_installment" value="1" <? if($stx_installment == 1) echo "checked"; ?> style="vertical-align:middle" title="">�г�
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">����</td>
									<td nowrap class="tdrow">
										<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;margin-left:0;float:left;"><tr><td width="2"></td><td><img src="./images/btn3_lt.gif" alt="[" /></td><td style="background:url('./images/btn3_bg.gif')"><a href="#pop_electric_calculate" onclick="electric_charges_calculate();return false;" onkeypress="this.onclick;" style="color:white;font-size:8pt;">�����ݰ���</a></td><td><img src="./images/btn3_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
									</td>
								</tr>
<?
}
?>
							</table>
						</form>
<?
//������Ȳ ó����Ȳ ī��Ʈ
$not_lookup = 0;
$rates_lookup = 0;
$contracts_progress = 0;
$progress_task = 0;
$progress_wrong = 0;
$reserve = 0;
$work_underway = 0;
$work_complete = 0;
$complete_task = 0;
$counsel_complete = 0;
$kepco_receipt = 0;
$progress_cancel = 0;
$unselect = 0;
$construct_advance = 0;
$charges_change = 0;
$collet_money = 0;
$check_complete = 0;
//�˻� ���� �ʱ�ȭ
$sql_search_cnt = " where a.com_code = b.com_code and a.electric_charges_no != '' ";
//����, ������, ���� ���� �˻�
if($damdang_code != "all" && $damdang_code != "dl" && $damdang_code) {
	$sql_search_add = " and ( a.damdang_code='$damdang_code' or a.damdang_code2='$damdang_code' ) ";
} 
//����� �⺻���� DB : ������������
if($member['mb_level'] == 6) {
	$sql_search_add2 = " and ( a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]' ) ";
//������������ ��������, ������ ��� 160516
} else if($member['mb_level'] == 4 && $member['mb_profile'] != 1) {
	//���� ���� ����
	$sql_search_add2 = " and ( b.manage_cust_numb='$manage_code' ) ";
}
//$sql_electric_charges = " select a.electric_charges_process from com_list_gy a, com_list_gy_opt b where a.com_code=b.com_code and a.electric_charges_no != '' $sql_search_add $sql_search_add2 ";
$sql_electric_charges = " select a.electric_charges_process, a.electric_charges_construct_chk from com_list_gy a, com_list_gy_opt b ";
$sql_electric_charges .= " $sql_search_cnt $sql_search_add $sql_search_add2 ";
//echo $sql_electric_charges;
$result_electric_charges = sql_query($sql_electric_charges);
for ($i=0; $row_electric_charges=mysql_fetch_assoc($result_electric_charges); $i++) {
	if($row_electric_charges['electric_charges_process'] == 1) $not_lookup++;
	else if($row_electric_charges['electric_charges_process'] == 2) $rates_lookup++;
	else if($row_electric_charges['electric_charges_process'] == 3) $contracts_progress++;
	else if($row_electric_charges['electric_charges_process'] == 4) $progress_task++;
	else if($row_electric_charges['electric_charges_process'] == 5) $progress_wrong++;
	else if($row_electric_charges['electric_charges_process'] == 6) $reserve++;
	else if($row_electric_charges['electric_charges_process'] == 7) $work_underway++;
	else if($row_electric_charges['electric_charges_process'] == 8) $work_complete++;
	else if($row_electric_charges['electric_charges_process'] == 9) $complete_task++;
	else if($row_electric_charges['electric_charges_process'] == 10) $counsel_complete++;
	else if($row_electric_charges['electric_charges_process'] == 11) $kepco_receipt++;
	else if($row_electric_charges['electric_charges_process'] == 12) $progress_cancel++;
	else if($row_electric_charges['electric_charges_process'] == 13) $construct_advance++;
	else if($row_electric_charges['electric_charges_process'] == 14) $collet_money++;
	else if($row_electric_charges['electric_charges_process'] == 15) $charges_change++;
	else if($row_electric_charges['electric_charges_process'] == 16) $check_complete++;
	else if($row_electric_charges['electric_charges_process'] == "") $unselect++;
	//if($row_electric_charges['electric_charges_process'] != 7 && $row_electric_charges['electric_charges_construct_chk']) $construct_advance++;
}
$job_total_count = $i;
?>
						<div>
							<div style="cursor:pointer;float:left;width:92px;height:36px;background:url('images/support_person_tag_total.png');margin:5px 10px 0 0;" onclick="location.href='electric_charges_list.php';">
								<div class="ftwhite_div" style="margin:11px 0 0 49px;"><?=$job_total_count?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_job_time_tag11.png');margin:5px 10px 0 0;" onclick="location.href='electric_charges_list.php?<?=$qstr?>&stx_process=no&stx_construct_chk=';">
								<div class="ftwhite_div"><?=$unselect?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_electric_charges_tag1.png');margin:5px 10px 0 0;" onclick="location.href='electric_charges_list.php?<?=$qstr?>&stx_construct_chk=&stx_process=1';">
								<div class="ftwhite_div"><?=$not_lookup?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_electric_charges_tag2.png');margin:5px 10px 0 0;" onclick="location.href='electric_charges_list.php?<?=$qstr?>&stx_construct_chk=&stx_process=2';">
								<div class="ftwhite_div"><?=$rates_lookup?></div>
							</div>
							<div style="cursor:pointer;float:left;width:128px;height:36px;background:url('images/erp_electric_charges_tag3.png');margin:5px 10px 0 0;" onclick="location.href='electric_charges_list.php?<?=$qstr?>&stx_construct_chk=&stx_process=3';">
								<div class="ftwhite_div" style="margin:11px 0 0 87px;"><?=$contracts_progress?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_electric_charges_tag11.png');margin:5px 10px 0 0;" onclick="location.href='electric_charges_list.php?<?=$qstr?>&stx_construct_chk=&stx_process=10';">
								<div class="ftwhite_div"><?=$counsel_complete?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_electric_charges_tag4.png');margin:5px 10px 0 0;" onclick="location.href='electric_charges_list.php?<?=$qstr?>&stx_construct_chk=&stx_process=4';">
								<div class="ftwhite_div"><?=$progress_task?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_electric_charges_tag17.png');margin:5px 10px 0 0;" onclick="location.href='electric_charges_list.php?<?=$qstr?>&stx_construct_chk=&stx_process=11';">
								<div class="ftwhite_div"><?=$check_complete?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_electric_charges_tag13.png');margin:5px 10px 0 0;" onclick="location.href='electric_charges_list.php?<?=$qstr?>&stx_construct_chk=&stx_process=11';">
								<div class="ftwhite_div"><?=$kepco_receipt?></div>
							</div>
							<div style="cursor:pointer;float:left;width:128px;height:36px;background:url('images/erp_electric_charges_tag5.png');margin:5px 10px 0 0;" onclick="location.href='electric_charges_list.php?<?=$qstr?>&stx_construct_chk=&stx_process=5';">
								<div class="ftwhite_div" style="margin:11px 0 0 87px;"><?=$progress_wrong?></div>
							</div>
							<div style="cursor:pointer;float:left;width:95px; height:36px;background:url('images/erp_electric_charges_tag6.png');margin:5px 10px 0 0;" onclick="location.href='electric_charges_list.php?<?=$qstr?>&stx_construct_chk=&stx_process=6';">
								<div class="ftwhite_div" style="margin:11px 0 0 61px;"><?=$reserve?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_electric_charges_tag14.png');margin:5px 10px 0 0;" onclick="location.href='electric_charges_list.php?<?=$qstr?>&stx_construct_chk=&stx_process=12';">
								<div class="ftwhite_div"><?=$progress_cancel?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_electric_charges_tag12.png');margin:5px 10px 0 0;" onclick="location.href='electric_charges_list.php?<?=$qstr?>&stx_construct_chk=&stx_process=13';">
								<div class="ftwhite_div"><?=$construct_advance?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_electric_charges_tag8.png');margin:5px 10px 0 0;" onclick="location.href='electric_charges_list.php?<?=$qstr?>&stx_construct_chk=&stx_process=7';">
								<div class="ftwhite_div"><?=$work_underway?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_electric_charges_tag10.png');margin:5px 10px 0 0;" onclick="location.href='electric_charges_list.php?<?=$qstr?>&stx_construct_chk=&stx_process=8';">
								<div class="ftwhite_div"><?=$work_complete?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_electric_charges_tag16.png');margin:5px 10px 0 0;" onclick="location.href='electric_charges_list.php?<?=$qstr?>&stx_construct_chk=&stx_process=15';">
								<div class="ftwhite_div"><?=$charges_change?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_electric_charges_tag15.png');margin:5px 10px 0 0;" onclick="location.href='electric_charges_list.php?<?=$qstr?>&stx_construct_chk=&stx_process=14';">
								<div class="ftwhite_div"><?=$collet_money?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_electric_charges_tag9.png');margin:5px 10px 0 0;" onclick="location.href='electric_charges_list.php?<?=$qstr?>&stx_construct_chk=&stx_process=9';">
								<div class="ftwhite_div"><?=$complete_task?></div>
							</div>
						</div>
						<div style="clear:both;width:100%;height:10px;font-size:0px;line-height:0px;"></div>
						<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
							<tr>
								<td align="center">
									<a href="javascript:goSearch();"><img src="./images/btn_search_big.png" border="0" /></a>
<?
if($member['mb_id'] == "master") $electric_charges_excel_url = "electric_charges_excel_admin.php?".$qstr;
else $electric_charges_excel_url = "electric_charges_excel.php?".$qstr;
?>
									<a href="<?=$electric_charges_excel_url?>"><img src="./images/btn_excel_print_big.png" border="0" /></a>
<?
	//���� ����
	if($member['mb_level'] > 6) {
?>
									<a href="electric_charges_sms.php"><img src="./images/btn_customer_manage.png" border="0" alt="������" /></a>
									<a href="electric_charges_collection.php"><img src="./images/btn_collection_manage.png" border="0" alt="���ݰ���" /></a>
<?
	}
?>
								</td>
							</tr>
						</table>
						<div style="height:1px;font-size:0px"></div>
<? } ?>
						<!--��޴� -->
						<table border="0" cellspacing="0" cellpadding="0"> 
							<tr>
								<td id=""> 
									<table border="0" cellspacing="0" cellpadding="0"> 
										<tr> 
											<td><img src="images/g_tab_on_lt.gif" /></td> 
											<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
											����Ʈ
											</td> 
											<td><img src="images/g_tab_on_rt.gif" /></td> 
										</tr> 
									</table> 
								</td> 
								<td width=2></td> 
								<td valign="bottom"></td> 
							</tr> 
						</table>
						<div style="height:2px;font-size:0px" class="bgtr"></div>
						<div style="height:2px;font-size:0px;line-height:0px;"></div>
						<!--��޴� -->

						<!--����Ʈ -->
						<form name="dataForm" method="post">
							<input type="hidden" name="chk_data">
							<input type="hidden" name="idx">
							<input type="hidden" name="page" value="<?=$page?>">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
								<tr>
									<td class="tdhead_center" rowspan="2" width="26"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" ></td>
									<td class="tdhead_center" rowspan="2" width="40">No</td>
<?
//�������� : �������� 
if($stx_process == 13) $list_date = "��������";
else $list_date = "�������";
?>
									<td class="tdhead_center" rowspan="2" width="70"><?=$list_date?></td>
									<td class="tdhead_center" rowspan="2" width="188">������</td>
									<td class="tdhead_center" rowspan="2" width="84">����ȣ</td>
									<td class="tdhead_center" width="96">���ε�Ϲ�ȣ</td>
									<td class="tdhead_center" rowspan="2">���޸�</td>
<?
//���� ����
if($member['mb_level'] > 6) {
?>
									<td class="tdhead_center" rowspan="2" width="60">�������</td>
<?
}
?>
									<td class="tdhead_center" width="82">�����(1�Ⱓ)</td>
									<td class="tdhead_center" width="89">�������Ա�</td>
									<td class="tdhead_center" width="80">������</td>
<?
//ó����Ȳ ���������� ��� 160622
if($stx_process == 13) {
?>
									<td class="tdhead_center" width="70">���翹��</td>
<?
} else {
?>
									<td class="tdhead_center" width="70">��������</td>
<?
}
?>
									<td class="tdhead_center" rowspan="2" width="90">ó����Ȳ<? if($member['mb_level'] > 6) echo "<br />�����ü"; ?></td>
									<td class="tdhead_center" rowspan="2" width="110">�����</td>
								</tr>
								<tr>
									<td class="tdhead_center" width="">�ֹε�Ϲ�ȣ</td>
									<td class="tdhead_center" width="">��������ݾ�</td>
									<td class="tdhead_center" width="">�����</td>
									<td class="tdhead_center" width="">�г�</td>
<?
//ó����Ȳ ���������� ��� 160622
if($stx_process == 13) {
?>
									<td class="tdhead_center" width="">����Ϸ�</td>
<?
} else {
?>
									<td class="tdhead_center" width="">�ǻ�Ϸ�</td>
<?
}
?>
								</tr>
<?
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

	//�������� �� �������� ǥ�� 160704
	if($stx_process == 13) $electric_charges_regdt = $row['electric_charges_construct_date'];

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
		$damdang_code2 = $row['damdang_code2'];
		//���ֵ��� -> ���ַ� ǥ�� / ���� ���� ����, ������ ������5 114 ���� �������� ���� 161021
/*
		if($damdang_code >= 112 && $damdang_code <= 118) {
			$branch = $man_cust_name_arry[$damdang_code2];
		} else {
*/
			if($damdang_code2) {
				$branch .= ">".$man_cust_name_arry[$damdang_code2];
			}
		//}
	} else {
		$branch = "-";
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
	//�������
	if($row['electric_charges_watt']) $electric_charges_watt = $row['electric_charges_watt']."kW";
	else $electric_charges_watt = "-";
	//�����(1�Ⱓ)
	if($row['electric_charges_year_fee']) $electric_charges_year_fee = $row['electric_charges_year_fee'];
	else $electric_charges_year_fee = "-";
	//�������Ա�
	if($row['electric_charges_payments']) $electric_charges_payments = $row['electric_charges_payments'];
	else {
		if($row['electric_charges_payments2']) $electric_charges_payments = $row['electric_charges_payments2'];
		else $electric_charges_payments = "-";
	}
	//�����
	if($row['electric_charges_cost']) $electric_charges_cost = $row['electric_charges_cost'];
	else {
		if($row['electric_charges_cost_b']) $electric_charges_cost = $row['electric_charges_cost_b'];
		else $electric_charges_cost = "-";
	}
	//�����2
	if($row['electric_charges_cost2']) $electric_charges_cost2 = "~".$row['electric_charges_cost2']."��";
	else {
		if($row['electric_charges_cost2_b']) $electric_charges_cost2 = "~".$row['electric_charges_cost2_b']."��";
		else $electric_charges_cost2 = "";
	}
	//��������ݾ�
	if($row['electric_charges_reduce']) $electric_charges_reduce = $row['electric_charges_reduce'];
	else {
		if($row['electric_charges_reduce2']) $electric_charges_reduce = $row['electric_charges_reduce2'];
		else $electric_charges_reduce = "-";
	}
	//������
	if($row['electric_charges_commission']) $electric_charges_commission = $row['electric_charges_commission'];
	else {
		if($row['electric_charges_commission2']) $electric_charges_commission = $row['electric_charges_commission2'];
		else $electric_charges_commission = "-";
	}
	//�г�
	if($row['electric_charges_installment']) $electric_charges_installment = $row['electric_charges_installment']."ȸ";
	else $electric_charges_installment = "-";
	//���������� 160621
	if($row['kepco_date_accept']) $kepco_date_accept = $row['kepco_date_accept'];
	else $kepco_date_accept = "-";
	//�ǻ�Ϸ���
	if($row['kepco_date_check']) $kepco_date_check = $row['kepco_date_check'];
	else $kepco_date_check = "-";
	//���翹����
	if($row['electric_date_expect']) $electric_date_expect = $row['electric_date_expect'];
	else $electric_date_expect = "-";
	//����Ϸ���
	if($row['electric_date_finish']) $electric_date_finish = $row['electric_date_finish'];
	else $electric_date_finish = "-";
	//��������ü ǥ�� 160729
	$electric_charges_construct_chk = $row['electric_charges_construct_chk'];
	$electric_charges_construct_chk2 = $row['electric_charges_construct_chk2'];
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
									<td class="ltrow1_center_h22"><?=$no?></td>
									<td class="ltrow1_center_h22" title="<?=$electric_charges_regdt_time?>"><?=$electric_charges_regdt?></td>
									<td class="ltrow1_left_h22" title="<?=$com_name_full?>">
										<a href="electric_charges_view.php?id=<?=$id?>&w=u&<?=$qstr?>&page=<?=$page?>" style="font-weight:bold"><?=$com_name?></a>
										<br><?=$com_juso?>
									</td>
									<td class="ltrow1_center_h22"><?=$electric_charges_no?></td>
									<td class="ltrow1_center_h22"><?=$electric_charges_bupin?><br /><?=$electric_charges_ssnb?></td>
									<td class="ltrow1_left_h22">
<?
//���� ����
if($member['mb_level'] > 6) {
?>
										<a href="javascript:open_memo('<?=$id?>')" title="<?=$memo_full?>"><?=$memo?><?=$comment_cnt?><span style="color:blue;" title="<?=$etc_full?>"><?=$etc?></span></a>
<? } else { ?>
										<?=$memo?><?=$comment_cnt?><span style="color:blue;" title="<?=$etc_full?>"><?=$etc?></span>
<? } ?>
									</td>
<?
//���� ����
if($member['mb_level'] > 6) {
?>
									<td class="ltrow1_center_h22"><?=$electric_charges_watt?></td>
<? } ?>
									<td class="ltrow1_center_h22"><?=$electric_charges_year_fee?><br /><?=$electric_charges_reduce?></td>
									<td class="ltrow1_center_h22"><?=$electric_charges_payments?><br /><?=$electric_charges_cost?><?=$electric_charges_cost2?></td>
									<td class="ltrow1_center_h22"><?=$electric_charges_commission?><br /><?=$electric_charges_installment?></td>
<?
//ó����Ȳ ���������� ��� 160622
if($stx_process == 13) {
?>
									<td class="ltrow1_center_h22"><?=$electric_date_expect?><br /><?=$electric_date_finish?></td>
<?
} else {
?>
									<td class="ltrow1_center_h22"><?=$kepco_date_accept?><br /><?=$kepco_date_check?></td>
<?
}
?>
<?
$sel_check_ok = array();
$check_ok_id = $row['electric_charges_process'];
$sel_check_ok[$check_ok_id] = "selected";
?>
									<td class="ltrow1_center_h22">
<?
//if($is_admin == "super" && $member['mb_level'] != 6) {
//���� ���� 150918
//���� ���� ��� ǥ�� 160112
//if($member['mb_profile'] < 110 && $member['mb_level'] != 4) {
//���� �������� ���� ��ǥ�� ���� 160629
if($member['mb_level'] > 6) {
?>
										<select name="check_ok_<?=$id?>" class="selectfm" onchange="goCheck_ok(this);">
											<option value="">����</option>
												<option value="1" <?=$sel_check_ok['1']?>><?=$electric_charges_process_arry[1]?></option>
												<option value="2" <?=$sel_check_ok['2']?>><?=$electric_charges_process_arry[2]?></option>
												<option value="3" <?=$sel_check_ok['3']?>><?=$electric_charges_process_arry[3]?></option>
												<option value="10" <?=$sel_check_ok['10']?>><?=$electric_charges_process_arry[10]?></option><!--���Ϸ�-->
												<option value="4" <?=$sel_check_ok['4']?>><?=$electric_charges_process_arry[4]?></option>
												<option value="16" <?=$sel_check_ok['16']?>><?=$electric_charges_process_arry[16]?></option><!--���˿Ϸ� 160919-->
												<option value="11" <?=$sel_check_ok['11']?>><?=$electric_charges_process_arry[11]?></option>
												<option value="5" <?=$sel_check_ok['5']?>><?=$electric_charges_process_arry[5]?></option>
												<option value="6" <?=$sel_check_ok['6']?>><?=$electric_charges_process_arry[6]?></option>
												<option value="12" <?=$sel_check_ok['12']?>><?=$electric_charges_process_arry[12]?></option>
												<option value="13" <?=$sel_check_ok['13']?>><?=$electric_charges_process_arry[13]?></option>
												<option value="7" <?=$sel_check_ok['7']?>><?=$electric_charges_process_arry[7]?></option>
												<option value="8" <?=$sel_check_ok['8']?>><?=$electric_charges_process_arry[8]?></option>
												<option value="15" <?=$sel_check_ok['15']?>><?=$electric_charges_process_arry[15]?></option>
												<option value="14" <?=$sel_check_ok['14']?>><?=$electric_charges_process_arry[14]?></option>
												<option value="9" <?=$sel_check_ok['9']?>><?=$electric_charges_process_arry[9]?></option>
										</select>
<?
	//��������ü ���� �� ǥ�� 160729
	if($electric_charges_construct_chk || $electric_charges_construct_chk2) echo "<div style='padding-top:4px;'>".$electric_charges_construct_arry[$electric_charges_construct_chk]."<br />".$electric_charges_construct_arry[$electric_charges_construct_chk2]."</div>";
} else {
	if($electric_charges_process_arry[$check_ok_id]) echo $electric_charges_process_arry[$check_ok_id];
	else echo "-";
}
?>
									</td>
									<td class="ltrow1_center_h22"><?=$branch?><br><?=$manager?></td>
								</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
?>
								<tr>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
<?
//���� ����
if($member['mb_level'] > 6) {
?>
									<td class="tdhead_center"></td>
<? } ?>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
								</tr>
							</table>
							<table width="60%" align="center" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td height="40">
										<div align="center">
											<?
											$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
											echo $pagelist;
											?>
										</div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</form>
		</td>
	</tr>
</table>
<iframe name="check_ok_iframe" src="electric_charges_check_ok_update.php" style="width:0;height:0" frameborder="0"></iframe>
<? include "./inc/bottom.php";?>
</body>
</html>
