<?
$sub_menu = "100500";
include_once("./_common.php");

//���� �⵵
$year_now = date("Y");

$sql_common = " from com_list_gy a, com_list_gy_opt b ";

//echo $member[mb_profile];
if($is_admin != "super") {
	//$stx_man_cust_name = $member[mb_profile];
}
//$is_admin = "super";
//echo $is_admin;
if($member['mb_level'] > 6 || $search_ok == "ok") {
	$sql_search = " where a.com_code = b.com_code ";
} else {
	$sql_search = " where a.com_code = b.com_code and ( a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]' ) ";
}
//�⺻ �˻� : ��ǥ�� HP ���� ����
if(!$stx_boss_hp) $sql_search .= " and a.boss_hp != '' ";
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
//�˻� : ��ǥ��HP
if ($stx_boss_hp) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.boss_hp like '%$stx_boss_hp%') ";
	$sql_search .= " ) ";
}
//�˻� : ����
if ($stx_man_cust_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.damdang_code = '$stx_man_cust_name') ";
	$sql_search .= " ) ";
}
//�˻� : ����
if($stx_man_cust_name2) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.damdang_code2 = '$stx_man_cust_name2') ";
	$sql_search .= " ) ";
}
//�˻� : ���������
if ($stx_reg_day_chk) {
	$sql_search .= " and ( ";
	if($stx_reg_day_chk == 1) {
		$sql_search .= " (b.registration_day != '') ";
	} else if($stx_reg_day_chk == 2) {
		$sql_search .= " (b.registration_day >= '$search_year.$search_month.00' and b.registration_day <= '$search_year_end.$search_month_end.32') ";
	}
	$sql_search .= " ) ";
	$sst = "b.registration_day";
	$sod = "desc";
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
//�˻� : ��Ź��ȣ ���� (�繫��Ź��ü)
if ($stx_samu_receive_no_search) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.samu_receive_no != '') ";
	$sql_search .= " ) ";
}
//�˻�2 : �Ƿڼ�
if ($stx_comp_gubun1) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.editdt != '') ";
	$sql_search .= " ) ";
}
//�˻�2 : ��Ź��
if ($stx_comp_gubun2) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.samu_receive_date != '') ";
	$sql_search .= " ) ";
}
//�˻�2 : ��༭
if ($stx_comp_gubun3) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.chk_contract != '') ";
	$sql_search .= " ) ";
}
//�˻�2 : �븮�μ���(����)
if ($stx_comp_gubun4) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.agent_elect_public_edate != '') ";
	$sql_search .= " ) ";
}
//�˻�2 : �븮�μ���(����)
if ($stx_comp_gubun5) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.agent_elect_center_edate != '') ";
	$sql_search .= " ) ";
}
//�˻�2 : �����빫
if ($stx_comp_gubun6) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.easynomu_yn != '') ";
	$sql_search .= " ) ";
}
//�˻� : ������
if ($stx_comp_gubun7) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.p_support > 0) ";
	$sql_search .= " ) ";
}
//�˻� : ȯ�ޱ�
if ($stx_comp_gubun8) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.p_contribution > 0) ";
	$sql_search .= " ) ";
}
//�˻� : ��Ÿ
if ($stx_comp_gubun9) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.p_construction > 0) ";
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
//�ο��˻�
if(!$stx_scount && $stx_ecount) $stx_scount = 0;
if ($stx_scount != "" || $stx_scount == 0) {
	$sql_search .= " and ( ";
	$sql_search .= " (cast(b.persons AS signed) >= '$stx_scount') ";
	if ($stx_ecount) $sql_search .= " and (cast(b.persons AS signed) <= '$stx_ecount') ";
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
//����
if (!$sst) {
    $sst = "a.com_code";
    $sod = "desc";
}
$sql_order = " order by $sst $sod ";
//ī��Ʈ
$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>ó��</a>";

$sub_title = "���ڸ޼����߼�";
$g4[title] = $sub_title." : �ŷ�ó : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 17;
//�˻� �Ķ���� ����
$qstr  = "search_detail=".$search_detail;
$qstr .= "&amp;stx_comp_name=".$stx_comp_name."&amp;stx_t_no=".$stx_t_no."&amp;stx_biz_no=".$stx_biz_no."&amp;stx_boss_name=".$stx_boss_name."&amp;stx_comp_tel=".$stx_comp_tel."&amp;stx_comp_fax=".$stx_comp_fax."&amp;stx_boss_hp=".$stx_boss_hp."&amp;stx_comp_gubun1=".$stx_comp_gubun1."&amp;stx_comp_gubun2=".$stx_comp_gubun2."&amp;stx_comp_gubun3=".$stx_comp_gubun3."&amp;stx_comp_gubun4=".$stx_comp_gubun4."&amp;stx_comp_gubun5=".$stx_comp_gubun5."&amp;stx_comp_gubun6=".$stx_comp_gubun6."&amp;stx_comp_gubun7=".$stx_comp_gubun7."&amp;stx_comp_gubun8=".$stx_comp_gubun8."&amp;stx_comp_gubun9=".$stx_comp_gubun9."&amp;stx_man_cust_name=".$stx_man_cust_name."&amp;stx_man_cust_name2=".$stx_man_cust_name2."&amp;stx_uptae=".$stx_uptae."&amp;stx_upjong=".$stx_upjong."&amp;search_ok=".$search_ok;
$qstr .= "&amp;stx_biz_no_input_not=".$stx_biz_no_input_not."&amp;stx_t_no_input_not=".$stx_t_no_input_not."&amp;stx_samu_receive_no_search=".$stx_samu_receive_no_search."&amp;stx_area1=".$stx_area1."&amp;stx_area2=".$stx_area2."&amp;stx_area3=".$stx_area3."&amp;stx_area4=".$stx_area4."&amp;stx_area5=".$stx_area5."&amp;stx_area6=".$stx_area6."&amp;stx_area7=".$stx_area7."&amp;stx_area8=".$stx_area8."&amp;stx_area9=".$stx_area9."&amp;stx_area10=".$stx_area10."&amp;stx_area11=".$stx_area11."&amp;stx_area12=".$stx_area12."&amp;stx_area13=".$stx_area13."&amp;stx_area14=".$stx_area14."&amp;stx_area15=".$stx_area15."&amp;stx_area16=".$stx_area16."&amp;stx_area17=".$stx_area17."&amp;stx_area_not=".$stx_area_not;
$qstr .= "&amp;stx_addr=".$stx_addr."&amp;stx_addr_first=".$stx_addr_first."&amp;stx_manage_name=".$stx_manage_name."&amp;stx_scount=".$stx_scount."&amp;stx_ecount=".$stx_ecount."&amp;stx_industry1=".$stx_industry1."&amp;stx_industry2=".$stx_industry2."&amp;stx_industry3=".$stx_industry3."&amp;stx_industry4=".$stx_industry4."&amp;stx_industry5=".$stx_industry5."&amp;stx_industry6=".$stx_industry6."&amp;stx_industry7=".$stx_industry7."&amp;stx_industry8=".$stx_industry8."&amp;stx_industry9=".$stx_industry9."&amp;stx_industry10=".$stx_industry10."&amp;stx_industry11=".$stx_industry11."&amp;stx_industry99=".$stx_industry99."&amp;stx_industry_not=".$stx_industry_not;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<script language="javascript">
function goSearch() {
	var frm = document.searchForm;
	frm.search_ok.value = "branch";
	frm.action = "<?=$_SERVER['PHP_SELF']?>";
	frm.submit();
	return;
}
//��ü ����
function check_All() {
	var f = document.dataForm;
	var cnt = 0;
	var id = "";
	//alert(f.checkall.checked);
	f.hp_all.checked = false;
	f.to_hp.value = "";
	for( var i = 0; i<f.idx.length-1; i++ ) {
		f.idx[i].checked = f.checkall.checked;
		id = f.idx[i].value;
		if(i > 0) line_feed = "\n"
		else line_feed = "";
		f.to_hp.value += line_feed + getId('hp_'+id).childNodes[0].nodeValue;
	}
	if(f.checkall.checked) {
		getId('to_count').innerHTML = i+"��";
		f.to_cnt.value = i;
	} else {
		getId('to_count').innerHTML = "0��";
		f.to_cnt.value = 0;
		f.to_hp.value = "";
	}
}
//���� ����
function check_sms(obj) {
	var f = document.dataForm;
	var cnt = parseInt(f.to_cnt.value);
	var id = "";
	var line_feed = "";
	f.hp_all.checked = false;
	if(obj.checked) {
		getId('to_count').innerHTML = (cnt+1)+"��";
		f.to_cnt.value = cnt+1;
	} else {
		getId('to_count').innerHTML = (cnt-1)+"��";
		f.to_cnt.value = cnt-1;
	}
	//���� �޴��� ��ȣ �ʱ�ȭ
	f.to_hp.value = "";
	var m = 0;
	for( var i = 0; i<f.idx.length-1; i++ ) {
		id = f.idx[i].value;
		if(f.idx[i].checked) {
			if(m > 0) line_feed = "\n"
			else line_feed = "";
			m++;
			f.to_hp.value += line_feed + getId('hp_'+id).childNodes[0].nodeValue;
		}
	}
}
//�޴�����ȣ ��ü����
function hp_all_func(obj,cnt) {
	var f = document.dataForm;
	f.checkall.checked = false;
	for( var i = 0; i<f.idx.length-1; i++ ) {
		f.idx[i].checked = false;
	}
	if(obj.checked) {
		f.to_hp.value = f.to_hp_all.value;
		getId('to_count').innerHTML = cnt+"��";
	} else {
		f.to_hp.value = "";
		getId('to_count').innerHTML = "0��";
	}
}
//���ڹ߼�
function sms_send() {
	//alert("���ڹ߼� ���񽺴� ������ ���� �� �̿� �����մϴ�.");
	//return;
	var frm = document.dataForm;
	if (frm.chk1.value == "") {
		alert("���� ������ �Է��ϼ���.");
		frm.chk1.focus();
		return;
	}
	if (frm.to_sms.value == "") {
		alert("�߽��� ��ȣ�� �Է��ϼ���.");
		frm.to_sms.focus();
		return;
	}
	if (frm.to_hp.value == "") {
	 alert("���õ� ������� �����ϴ�.");
	 return;
	} else{
		if(confirm("���� ���� �߼� �Ͻðڽ��ϱ�?")) {

			frm.action="client_sms_update.php";
			frm.submit();
		} else {
			return;
		}
	} 
}
//���ڼ���
function select_sms_func(select_sms_var) {
	var frm = document.dataForm;
	if(select_sms_var == 1) sms_text = "[�ѱ�����濵��] ������ ������ �ȳ�";
	else if(select_sms_var == 2) sms_text = "[�ѱ�����濵��] �ð������� �������";
	else if(select_sms_var == 3) sms_text = "[�ѱ�����濵��] �����빫 ���α׷�";
	else if(select_sms_var == 4) sms_text = "[�ѱ�����濵��] Ű��빫 ���α׷�";
	else if(select_sms_var == 5) sms_text = "[�ѱ�����濵��] ������Ʒ� ������";
	else sms_text = "";
	frm.chk1.value = sms_text;
	displayBytes(80,'chk1');
}
//���� 80byte üũ
function displayBytes( sz, id ) {
	var form= document.dataForm;
	var obj = document.getElementById( id );
	if(obj.value.bytes() > sz) {
		if(event.keyCode != '8') {
			alert( sz+'�ڱ��� �Է��� �����մϴ�.');
			obj_value = obj.value;
			obj.value = cutStr(obj_value, sz+1);
		}
		obj.value = obj.value.substring(0, obj.value.length - 1);
	}
	getId(id+'_bytes').value = form[id].value.bytes()+"��";
}
String.prototype.bytes = function() {
	var str = this;
	var l = 0;
	for(var i=0; i<str.length; i++) l += (str.charCodeAt(i) > 128) ? 2 : 1;
	return l;
}
//���ڿ� ����Ʈ�� �ڸ���
function cutStr(str, limit) {
	var retstr = '';
	var strlength = 0;
	var character = '';
	for(var i = 0; i < str.length; i++) {
		character = str.charAt(i);
		strlength += chk_byte(character);
		if(strlength > limit) {
			retstr += '';
			break;
		} else {
			retstr += character;
		}
	}
	return retstr;
} 
function chk_byte(character) { 
	if(escape(character).length > 4) return 2; 
	else return 1;
}
function checked_ok() {
	var frm = document.dataForm;
	var chk_cnt = document.getElementsByName("idx");
	var cnt = 0;
	var chk_data ="";

	for(i=0; i<chk_cnt.length-1 ; i++) {
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
			frm.action="client_delete.php";
			frm.submit();
		} else {
			return;
		}
	} 
}
function tab_view(tab) {
	var obj = document.getElementById(tab);
	var frm = document.searchForm;
	if(obj.style.display == "none") {
		obj.style.display = "";
		frm.search_detail.value = "ok";
	} else {
		obj.style.display = "none";
		frm.search_detail.value = "";
	}
}
//����ڹ�ȣ �Է� ������
function checkhyphen(inputVal, type, keydown) {		// inputVal�� õ������ , ǥ�ø� ���� �������� ��
	main = document.searchForm;			// ���⼭ type �� �ش��ϴ� ���� �ֱ� ���� ��ġ���� index
	var chk		= 0;				// chk �� õ������ ���� ���̸� check
	var chk2	= 0;
	var chk3	= 0;
	var share	= 0;				// share 200,000 �� ���� 3�� ����� ���� �����ϱ� ���� ����
	var start	= 0;
	var triple	= 0;				// triple 3, 6, 9 �� 3�� ��� 
	var end		= 0;				// start, end substring ������ ���� ����  
	var total	= "";			
	var input	= "";				// total ���Ƿ� string ���� �����ϱ� ���� ����
	//���� �Է¸�
	//alert(event.keyCode);
	input = delhyphen(inputVal, inputVal.length);
	//������ master �Է�
	//alert(input);
	if(1 == 1) { //��� ����
		//�� ����Ʈ+�� �� �� Home backsp
		if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
			//alert(inputVal.length);
			//alert(input);
			if(inputVal.length == 3){
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,3)+"-";
			} else if(inputVal.length == 6){
				total += inputVal.substring(0,8)+"-";
			} else if(inputVal.length == 12){
				total += inputVal.substring(0,14)+"";
			} else {
				total += inputVal;
			}
			if(keydown =='Y'){
				type.value = total;
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
}
//����������ȣ �Է� ������
function checkhyphen_tno(inputVal, type, keydown) {
	main = document.searchForm;			// ���⼭ type �� �ش��ϴ� ���� �ֱ� ���� ��ġ���� index
	var chk		= 0;				// chk �� õ������ ���� ���̸� check
	var chk2	= 0;
	var chk3	= 0;
	var share	= 0;				// share 200,000 �� ���� 3�� ����� ���� �����ϱ� ���� ����
	var start	= 0;
	var triple	= 0;				// triple 3, 6, 9 �� 3�� ��� 
	var end		= 0;				// start, end substring ������ ���� ����  
	var total	= "";			
	var input	= "";				// total ���Ƿ� string ���� �����ϱ� ���� ����
	//���� �Է¸�
	//alert(event.keyCode);
	input = delhyphen(inputVal, inputVal.length);
	//������ master �Է�
	//alert(input);
	if(1 == 1) { //��� ����
		//�� ����Ʈ+�� �� �� Home backsp
		if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
			//alert(inputVal.length);
			//alert(input);
			if(inputVal.length == 3){
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,3)+"-";
			} else if(inputVal.length == 6){
				total += inputVal.substring(0,8)+"-";
			} else if(inputVal.length == 12){
				total += inputVal.substring(0,14)+"-";
			} else {
				total += inputVal;
			}
			if(keydown =='Y'){
				type.value = total;
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
}
function delhyphen(inputVal, count){
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!='-'){		// ���� substring�� ����
			tmp += inputVal.substring(i,i+1);	// ���� ��� , �� ����
		}
	}
	return tmp;
}
</script>
<?
include "inc/top.php";
?>
		<td onmouseover="showM('900')" valign="top" style="padding:10px 20px 20px 20px;min-height:480px;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="100"><img src="images/top01.gif" border="0"></td>
					<td width=""><a href="<?=$_SERVER['PHP_SELF']?>"><img src="images/top01_05.gif" border="0"></a></td>
						<td>
<?
$title_main_no = "01";
include "inc/sub_menu.php";
?>
						</td>
				</tr>
				<tr><td height="1" bgcolor="#cccccc" colspan="9"></td></tr>
			</table>
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
				<tr>
					<td valign="top" style="padding:10px 0 0 0">
						<!--Ÿ��Ʋ -->	
						<form name="searchForm" method="get">
							<input type="hidden" name="search_ok" />
							<input type="hidden" name="search_detail" value="<?=$search_detail?>" />
							<!--������ -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr> 
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
												�˻�
												</td> 
												<td><img src="images/g_tab_on_rt.gif"></td> 
											</tr> 
										</table> 
									</td> 
									<td width=2></td> 
									<td valign="bottom"></td> 
								</tr> 
							</table>
							<div style="height:2px;font-size:0px" class="bgtr"></div>
							<div style="height:2px;font-size:0px;line-height:0px;"></div>
							<!--�˻� -->
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
								<tr>
									<td nowrap class="tdrowk" width="80"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">������</td>
									<td nowrap class="tdrow"  width="170">
										<input name="stx_comp_name" type="text" class="textfm" style="width:160px;" value="<?=$stx_comp_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk" width="104"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����ڵ�Ϲ�ȣ</td>
									<td nowrap class="tdrow">
										<input name="stx_biz_no" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$stx_biz_no?>" maxlength="12" onkeyup="checkhyphen(this.value, this,'Y')" onkeydown="only_number();if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��ǥ�ڸ�</td>
									<td nowrap class="tdrow">
										<input name="stx_boss_name"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_boss_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��ǥ��HP</td>
									<td nowrap class="tdrow">
										<input name="stx_boss_hp"  type="text" class="textfm" style="width:90px;ime-mode:disabled;" value="<?=$stx_boss_hp?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
<?
if($member['mb_level'] > 6) {
	//echo $stx_man_cust_name;
?>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����</td>
									<td nowrap class="tdrow">
										<select name="stx_man_cust_name" class="selectfm">
											<option value="">��ü</option>
<?
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
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">��Ź�ŷ�ó</td>
									<td nowrap class="tdrow" colspan="">
										<input type="checkbox" name="stx_samu_receive_no_search" value="1" <? if($stx_samu_receive_no_search == 1) echo "checked"; ?> style="vertical-align:middle;" title="">�繫��Ź
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">��ȭ��ȣ</td>
									<td nowrap class="tdrow" colspan="">
										<input name="stx_comp_tel"  type="text" class="textfm" style="width:90px;ime-mode:disabled ;" value="<?=$stx_comp_tel?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">�ѽ���ȣ</td>
									<td nowrap class="tdrow" colspan="">
										<input name="stx_comp_fax"  type="text" class="textfm" style="width:90px;ime-mode:disabled;" value="<?=$stx_comp_fax?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">���������</td>
									<td nowrap class="tdrow" colspan="3">
										<select name="stx_reg_day_chk" class="selectfm" onchange="">
											<option value=""  <? if($stx_reg_day_chk == "")  echo "selected"; ?>>����</option>
											<option value="1" <? if($stx_reg_day_chk == "1") echo "selected"; ?>>��ü</option>
											<option value="2" <? if($stx_reg_day_chk == "2") echo "selected"; ?>>�Ⱓ����</option>
										</select>
										<select name="search_year" class="selectfm" onChange="">
											<option value="1980" <? if(1980 == $search_year) echo "selected"; ?> >1980 ����</option>
<?
if(!$search_year) $search_year = $year_now;
for($i=1981;$i<=$year_now;$i++) {
?>
											<option value="<?=$i?>" <? if($i == $search_year) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
										</select> ��
										<select name="search_month" class="selectfm" onChange="">
<?
for($i=1;$i<13;$i++) {
	if($i < 10) $month = "0".$i;
	else $month = $i;
?>
											<option value="<?=$month?>" <? if($i == $search_month) echo "selected"; ?> ><?=$month?></option>
<?
}
?>
										</select> �� ~
										<select name="search_year_end" class="selectfm" onChange="">
<?
if(!$search_year_end) $search_year_end = $year_now;
for($i=1981;$i<=$year_now;$i++) {
?>
											<option value="<?=$i?>" <? if($i == $search_year_end) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
										</select> ��
										<select name="search_month_end" class="selectfm" onChange="">
<?
for($i=1;$i<13;$i++) {
	if($i < 10) $month = "0".$i;
	else $month = $i;
?>
											<option value="<?=$month?>" <? if($i == $search_month_end) echo "selected"; ?> ><?=$month?></option>
<?
}
?>
										</select> ��
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����</td>
									<td nowrap class="tdrow" colspan="">
										<input name="stx_uptae"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_uptae?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����</td>
									<td nowrap class="tdrow" colspan="">
										<input name="stx_upjong"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_upjong?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
<?
if($member['mb_level'] > 6) {
	//echo $stx_man_cust_name;
?>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����</td>
									<td nowrap class="tdrow">
										<select name="stx_man_cust_name2" class="selectfm">
											<option value="">��ü</option>
<?
$stx_man_cust_name = $stx_man_cust_name2;
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
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ŷ�ó����</td>
									<td nowrap class="tdrow" colspan="5">
										<input type="checkbox" name="stx_comp_gubun1" value="1" <? if($stx_comp_gubun1 == 1) echo "checked"; ?> style="vertical-align:middle">�Ƿڼ�
										<input type="checkbox" name="stx_comp_gubun2" value="1" <? if($stx_comp_gubun2 == 1) echo "checked"; ?> style="vertical-align:middle">��Ź��
										<input type="checkbox" name="stx_comp_gubun3" value="1" <? if($stx_comp_gubun3 == 1) echo "checked"; ?> style="vertical-align:middle">��༭
										<input type="checkbox" name="stx_comp_gubun4" value="1" <? if($stx_comp_gubun4 == 1) echo "checked"; ?> style="vertical-align:middle">�븮�μ���(����)
										<input type="checkbox" name="stx_comp_gubun5" value="1" <? if($stx_comp_gubun5 == 1) echo "checked"; ?> style="vertical-align:middle">�븮�μ���(����)
										<input type="checkbox" name="stx_comp_gubun6" value="1" <? if($stx_comp_gubun6 == 1) echo "checked"; ?> style="vertical-align:middle">�����빫
										<input type="checkbox" name="stx_comp_gubun7" value="1" <? if($stx_comp_gubun7 == 1) echo "checked"; ?> style="vertical-align:middle">������
										<input type="checkbox" name="stx_comp_gubun8" value="1" <? if($stx_comp_gubun8 == 1) echo "checked"; ?> style="vertical-align:middle">ȯ�ޱ�
										<input type="checkbox" name="stx_comp_gubun9" value="1" <? if($stx_comp_gubun9 == 1) echo "checked"; ?> style="vertical-align:middle">��Ÿ
									</td>
									<td nowrap class="tdrowk"></td>
									<td nowrap class="tdrow" colspan="3">
									</td>
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
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ο��˻�</td>
									<td nowrap class="tdrow" colspan="">
										<input name="stx_scount"  type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$stx_scount?>" onkeydown="">
										~
										<input name="stx_ecount"  type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$stx_ecount?>" onkeydown="">
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
							</table>
							<div style="height:20px;font-size:0px;line-height:0px;"></div>
							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
								<tr>
									<td align="center">
										<a href="javascript:goSearch();" target=""><img src="./images/btn_search_big.png" border="0"></a>
										<a href="client_process_list.php" target=""><img src="./images/btn_receipt_con_big.png" border="0"></a>
<?
//�������
$client_excel = "client_sms_excel.php?$qstr&$stx_qstr";
?>
										<a href="<?=$client_excel?>"><img src="./images/btn_excel_print_big.png" border="0"></a>
									</td>
								</tr>
							</table>
						</form>
						<div style="height:4px;font-size:0px"></div>
						<form name="dataForm" method="post">
							<input type="hidden" name="chk_data" />
							<input type="hidden" name="page" value="<?=$page?>" />
							<input type="hidden" name="url_qstr" value="<?=$qstr?>" />
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
												���ڹ߼�
												</td> 
												<td><img src="images/g_tab_on_rt.gif"></td> 
											</tr> 
										</table> 
									</td> 
									<td width=2></td> 
									<td valign="bottom"></td> 
								</tr> 
							</table>
							<div style="height:2px;font-size:0px" class="bgtr"></div>
							<div style="height:2px;font-size:0px;line-height:0px;"></div>
<?
$sql_hp = " select a.boss_hp $sql_common $sql_search $sql_order ";
//echo $sql_hp;
$result_hp = sql_query($sql_hp);
$hp_all_cnt = 0;
for($i=0; $row_hp=mysql_fetch_assoc($result_hp); $i++) {
	$hp_all_cnt++;
	if($i > 0) $line_feed = "\n";
	else $line_feed = "";
	$to_hp_all .= $line_feed.$row_hp['boss_hp'];
	//echo $to_hp_all;
}
?>
							<!--�˻� -->
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
								<tr>
									<td nowrap class="tdrowk" width="80"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���ڼ���</td>
									<td nowrap class="tdrow"  width="160">
										<select name="select_sms" class="selectfm" onchange="select_sms_func(this.value)">
											<option value="">����</option>
											<option value="1">������ ������ �ȳ�</option>
											<option value="2">�ð������� �������</option>
											<option value="3">�����빫 ���α׷�</option>
											<option value="4">Ű��빫 ���α׷�</option>
											<option value="5">������Ʒ� ������</option>
										</select>
									</td>
									<td nowrap class="tdrowk" width="80"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���ڳ���</td>
									<td nowrap class="tdrow" width="334">
										<textarea id="chk1" name="chk1" onkeyup="displayBytes(80,'chk1');" style="width:270px;height30px;"></textarea>
										<input type="text" name='chk1_bytes' id='chk1_bytes' style="width:40px;" value="80��" />
									</td>
									<td nowrap class="tdrowk" width="80"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">ȸ�Ź�ȣ</td>
									<td nowrap class="tdrow" width="130">
										<input type="text" name='to_sms' style="width:110px;" value="1544-4519" />
									</td>
									<td nowrap class="tdrow_center" width="90">
										<a href="javascript:sms_send();"><img src="./images/btn_sms_send.png" border="0" /></a>
									</td>
									<td nowrap class="tdrow" width="55"><input type="checkbox" name="hp_all" value="1" onclick="hp_all_func(this,<?=$hp_all_cnt?>);" style="vertical-align:middle" />��ü</td>
									<td nowrap class="tdrow">
										<div>����<input type="hidden" name="to_cnt" value="0" /></div>
										<div id="to_count" style="font-weight:bold;">0��</div>
									</td>
								</tr>
							</table>
							<textarea name="to_hp" style="width:110px;height:310px;display:none;"></textarea>
							<textarea name="to_hp_all" style="width:110px;height:310px;display:none;"><?=$to_hp_all?></textarea>
							<div style="height:20px;font-size:0px"></div>
							<!--��޴� -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
												����Ʈ
												</td> 
												<td><img src="images/g_tab_on_rt.gif"></td> 
											</tr> 
										</table> 
									</td> 
									<td width=2></td> 
									<td valign="bottom"></td> 
								</tr> 
							</table>
							<div style="height:2px;font-size:0px" class="bgtr"></div>
							<div style="height:2px;font-size:0px;line-height:0px;"></div>
							<!--����Ʈ -->
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:">
								<tr>
									<td class="tdhead_center" width="26" rowspan="2"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="check_All()" ></td>
									<td class="tdhead_center" width="46" rowspan="2">No</td>
									<td class="tdhead_center" rowspan="2">������</td>
									<td class="tdhead_center" width="90" rowspan="2">����</td>
									<td class="tdhead_center" width="94" rowspan="2">�޴���</td>
									<td class="tdhead_center" width="94" rowspan="2">��ȭ��ȣ</td>
									<td class="tdhead_center" width="94" rowspan="2">�ѽ���ȣ</td>
									<td class="tdhead_center" width="96" rowspan="1">����ڵ�Ϲ�ȣ</td>
									<td class="tdhead_center" width="100" rowspan="1">��ǥ��</td>
									<td class="tdhead_center" width="78" rowspan="1">�Ƿڼ�����</td>
									<td class="tdhead_center" width="78" rowspan="1">�븮��</td>
									<td class="tdhead_center" width="78" rowspan="2">��༭</td>
									<td class="tdhead_center" width="90" rowspan="1">������</td>
								</tr>
								<tr>
									<td class="tdhead_center" width="" rowspan="1">����������ȣ</td>
									<td class="tdhead_center" width="" rowspan="1">���������</td>
									<td class="tdhead_center" width="" rowspan="1">�繫��Ź</td>
									<td class="tdhead_center" width="" rowspan="1">���ڹο�</td>
									<td class="tdhead_center" width="" rowspan="1">�����</td>
								</tr>
<?
// ����Ʈ ���
for ($i=0; $row=mysql_fetch_assoc($result); $i++) {
	//����� �ɼ� DB
	$sql_opt = " select * from com_list_gy_opt where com_code='$row[com_code]' ";
	$result_opt = sql_query($sql_opt);
	$row_opt=mysql_fetch_array($result_opt);
	//$page
	//$total_page
	//$rows
	$no = $total_count - $i - ($rows*($page-1));
	//echo $total_count;
  $list = $i%2;
	//����� �ڵ��ȣ
	$id = $row['com_code'];
	//�������
	$regdt = $row['regdt'];
	if($regdt) $regdt_br = "<br>".$regdt;
	else $regdt_br = "";
	$regdt_time = $row['regdt_time'];
	$regdt_time_array = explode(" ",$row['regdt_time']);
	$regdt_time_only = $regdt_time_array[1];
	//������
	$com_name_full = $row['com_name'];
	$com_name = cut_str($com_name_full, 26, "..");
	//���������
	if($row['registration_day']) $registration_day = $row['registration_day'];
	else $registration_day = "-";
	//���� ����
	if($row['upche_div'] == "2") {
		$upche_div = "����";
	} else {
		$upche_div = "����";
	}
	$com_juso_full = $row['com_juso']." ".$row['com_juso2'];
	$com_juso = cut_str($com_juso_full, 38, "..");
	//����ڵ�Ϲ�ȣ
	if($row['biz_no']) $biz_no = $row['biz_no'];
	else $biz_no = "-";
	//����������ȣ
	if($row['t_insureno']) $t_insureno = $row['t_insureno'];
	else $t_insureno = "-";
	//��ǥ��
	$boss_name_full = $row['boss_name'];
	if($row['boss_name']) $boss_name = cut_str($boss_name_full, 14, "..");
	else $boss_name = "-";
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
	//���Ŵ���
	$manage_cust_name = $row_opt['manage_cust_name'];
	//�繫��Ź
	if($row_opt['samu_req_yn'] == "0" || $row_opt['samu_req_yn'] == "") {
		$samu_req = "";
	} else if($row_opt['samu_req_yn'] == "1") {
		$samu_req = "��û";
	}
	//����
	$uptae_full = $row['uptae'];
	if($row['uptae']) $uptae = cut_str($uptae_full, 16, "..");
	else $uptae = "-";
	//����
	$upjong_full = $row['upjong'];
	if($row['upjong']) $upjong = cut_str($upjong_full, 16, "..");
	else $upjong = "-";
	//��ǥ��HP
	if($row['boss_hp']) $boss_hp = $row['boss_hp'];
	else $boss_hp = "-";
	//��ȭ��ȣ
	if($row['com_tel']) $com_tel = $row['com_tel'];
	else $com_tel = "-";
	//�ѽ���ȣ
	if($row['com_fax']) $com_fax = $row['com_fax'];
	else $com_fax = "-";
	//�Ƿڼ�
	if($row['editdt']) $editdt = $row['editdt'];
	else $editdt = "-";
	//��Ź��
	if($row['samu_receive_date']) $samu_receive_date = $row['samu_receive_date'];
	else $samu_receive_date = "-";
	//�繫��Ź����
	$samu_req_yn_array = Array("","�̵���","���Ӱ���","Ÿ����","����","����");
	$samu_req_yn_code = $row['samu_req_yn'];
	if($row['samu_req_yn']) $samu_state = $samu_req_yn_array[$samu_req_yn_code];
	else $samu_state = "-";
	if($row['samu_req_date']) $samu_req_date = $row['samu_req_date'];
	else $samu_req_date = "-";
	//�븮��(����)
	if($row['agent_elect_public_date']) $agent_elect_public_date = $row['agent_elect_public_date'];
	else $agent_elect_public_date = "-";
	if($row['agent_elect_public_edate']) $agent_elect_public_edate = $row['agent_elect_public_edate'];
	else $agent_elect_public_edate = "-";
	//�븮��(����)
	if($row['agent_elect_center_date']) $agent_elect_center_date = $row['agent_elect_center_date'];
	else $agent_elect_center_date = "-";
	if($row['agent_elect_center_edate']) $agent_elect_center_edate = $row['agent_elect_center_edate'];
	else $agent_elect_center_edate = "-";
	//�������
	if($row['editdt']) $p_accept = "�Ƿڼ�����";
	else $p_accept = "-";
	if($row['samu_receive_date']) $p_accept = "��Ź������";
	if($row['samu_req_date']) $p_accept = "�繫��Ź����";
	if($row['agent_elect_public_edate']) $p_accept = "�븮��(����)";
	if($row['agent_elect_center_edate']) $p_accept = "�븮��(����)";
	//��༭
	if($row['chk_contract'] == "1") $chk_contract = "����";
	else if($row['chk_contract'] == "2") $chk_contract = "�̵���";
	else $chk_contract = "-";
	if($row['chk_contract_date']) $chk_contract_date = $row['chk_contract_date'];
	else $chk_contract_date = "";

	//�����빫 ���ú�/������
	if($row['setting_pay']) $setting_pay = number_format($row['setting_pay']);
	else $setting_pay = "-";
	if($row['month_pay']) $month_pay = number_format($row['month_pay']);
	else $month_pay = "-";
	//�ο�
	if($row['persons']) $persons = $row['persons'];
	else $persons = "0";
	//�������� ��ũ
	if($member['mb_level'] > 6 || $row['damdang_code'] == $member['mb_profile'] || $row['damdang_code2'] == $member['mb_profile']) {
		$com_view = "client_view.php?id=$id&w=u&page=$page&$qstr&$stx_qstr";
	} else {
		$com_view = "javascript:alert('�ش� �ŷ�ó ������ ������ ������ �����ϴ�.');";
	}
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer" onclick="check_sms(this);"></td>
									<td class="ltrow1_center_h22"><?=$no?></td>
									<td class="ltrow1_left_h22" title="<?=$com_name_full?>">
										<a href="<?=$com_view?>" style="font-weight:bold"><?=$com_name?></a>
<?
//�ּ�, ������
if($stx_addr || $stx_area1 || $stx_area2 || $stx_area3 || $stx_area4 || $stx_area5 || $stx_area6 || $stx_area7 || $stx_area8 || $stx_area9 || $stx_area10 || $stx_area11 || $stx_area12 || $stx_area13 || $stx_area14 || $stx_area15 || $stx_area16 || $stx_area17) {
?>
										<br><?=$com_juso?>
<?
} else {
?>
										<?=$regdt_br?>
<?
}
//�ο�
if($stx_scount || $stx_ecount) {
	echo "<br>�ο�: <b>".$persons."</b>��";
}
?>
									</td>
									<td class="ltrow1_center_h22"><span title="<?=$uptae_full?>"><?=$uptae?></span></td>
									<td class="ltrow1_center_h22" id="hp_<?=$id?>"><?=$boss_hp?></td>
									<td class="ltrow1_center_h22"><?=$com_tel?></td>
									<td class="ltrow1_center_h22"><?=$com_fax?></td>
									<td class="ltrow1_center_h22"><?=$biz_no?><br><?=$t_insureno?></td>
									<td class="ltrow1_center_h22" title="<?=$boss_name_full?>"><?=$boss_name?><br><?=$registration_day?></td>
									<td class="ltrow1_center_h22"><?=$editdt?><br><?=$samu_state?></td>
									<td class="ltrow1_center_h22"><?=$agent_elect_public_edate?><br><?=$agent_elect_center_edate?></td>
									<td class="ltrow1_center_h22"><?=$chk_contract?><br><?=$chk_contract_date?></td>
									<td class="ltrow1_center_h22"><?=$branch?><br><?=$manage_cust_name?></td>
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
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
								</tr>
							</table>
							<input type="checkbox" name="idx" value="idx_array_last" style="display:none;">
							<table width="60%" align="center" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td height="40">
										<div align="center">
											<?
											$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&$stx_qstr&page=");
											echo $pagelist;
											?>
										</div>
									</td>
								</tr>
							</table>
						</form>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<? include "./inc/bottom.php";?>
</body>
</html>
