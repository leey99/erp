<?
$sub_menu = "1901100";
include_once("./_common.php");

$sql_common = " from com_list_gy a, com_list_gy_opt b, com_list_gy_opt2 c ";

//echo $member[mb_profile];
if($is_admin != "super") {
	//$stx_man_cust_name = $member[mb_profile];
}
//$is_admin = "super";
//echo $is_admin;
//if($member['mb_level'] > 6 || $search_ok == "ok") {

$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code ";

//����, �������(���) ��ü ǥ�� 160928
if($member['mb_profile'] == 1 || $member['mb_profile'] == 122) {
	//$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code ";
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
	if($member['mb_level'] <= 5) $sql_search .= " and ( b.manage_cust_numb='$manage_code' ) ";
	else $sql_search .= " and ( a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]' ) ";
}
//�ʼ� �˻����� : ���¼������ üũ
$sql_search .= " and c.kepco_dsm_chk = '1' ";

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
//����
if($stx_man_cust_name) {
	if($stx_man_cust_name == "dl") $sql_search .= " and (a.damdang_code>=110 and a.damdang_code<=119) ";
	//else $sql_search .= " and a.damdang_code = '$stx_man_cust_name' ";
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
//������� ��ȣ
if($stx_kepco_dsm_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (c.kepco_dsm_no = '$stx_kepco_dsm_no') ";
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
//ó����Ȳ
if($stx_process) {
	$sql_search2 = " and ( ";
	if($stx_process == "no") $sql_search2 .= " (c.kepco_dsm_process = '') ";
	else $sql_search2 .= " (c.kepco_dsm_process = '$stx_process') ";
	$sql_search2 .= " ) ";
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
	$sql_search .= " and (c.kepco_dsm_regdt >= '$search_sday_var' and c.kepco_dsm_regdt <= '$search_eday_var') ";
}
//����
if (!$sst) {
    $sst = "c.kepco_dsm_regdt";
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

$top_sub_title = "images/top19_11.png";
$sub_title = "���¼������";
$g4['title'] = $sub_title." : ����о� : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search $sql_search2
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 13;

//�˻� �Ķ���� ����
$qstr  = "search_detail=".$search_detail;
$qstr .= "&stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_biz_no=".$stx_biz_no."&stx_boss_name=".$stx_boss_name."&stx_comp_tel=".$stx_comp_tel."&stx_comp_fax=".$stx_comp_fax."&stx_man_cust_name=".$stx_man_cust_name."&stx_man_cust_name2=".$stx_man_cust_name2."&stx_uptae=".$stx_uptae."&stx_upjong=".$stx_upjong."&search_ok=".$search_ok."&stx_process=".$stx_process;
$qstr .= "&stx_biz_no_input_not=".$stx_biz_no_input_not."&stx_t_no_input_not=".$stx_t_no_input_not."&stx_area1=".$stx_area1."&stx_area2=".$stx_area2."&stx_area3=".$stx_area3."&stx_area4=".$stx_area4."&stx_area5=".$stx_area5."&stx_area6=".$stx_area6."&stx_area7=".$stx_area7."&stx_area8=".$stx_area8."&stx_area9=".$stx_area9."&stx_area10=".$stx_area10."&stx_area11=".$stx_area11."&stx_area12=".$stx_area12."&stx_area13=".$stx_area13."&stx_area14=".$stx_area14."&stx_area15=".$stx_area15."&stx_area16=".$stx_area16."&stx_area17=".$stx_area17."&stx_area_not=".$stx_area_not;
$qstr .= "&stx_addr=".$stx_addr."&stx_addr_first=".$stx_addr_first."&stx_manage_name=".$stx_manage_name."&stx_kepco_dsm_no=".$stx_kepco_dsm_no."&stx_ecount=".$stx_ecount."&stx_industry1=".$stx_industry1."&stx_industry2=".$stx_industry2."&stx_industry3=".$stx_industry3."&stx_industry4=".$stx_industry4."&stx_industry5=".$stx_industry5."&stx_industry6=".$stx_industry6."&stx_industry7=".$stx_industry7."&stx_industry8=".$stx_industry8."&stx_industry9=".$stx_industry9."&stx_industry10=".$stx_industry10."&stx_industry11=".$stx_industry11."&stx_industry99=".$stx_industry99."&stx_industry_not=".$stx_industry_not;
$qstr .= "&stx_search_day_chk=".$stx_search_day_chk."&search_sday=".$search_sday."&search_eday=".$search_eday."&stx_installment=".$stx_installment;
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
	check_ok_iframe.location.href = "kepco_dsm_check_ok_update.php?id="+id+"&check_ok="+check_ok;
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
$php_self_list = "kepco_dsm_list.php";
?>
		<td onmouseover="showM('900')" valign="top" style="padding:10px 20px 20px 20px;min-height:480px;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="100"><img src="images/top19.gif" border="0" alt="����о�" /></td>
					<td><a href="<?=$php_self_list?>"><img src="<?=$top_sub_title?>" border="0" alt="<?=$sub_title?>" /></a></td>
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
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">�г�</td>
									<td nowrap class="tdrow">
										<input type="checkbox" name="stx_installment" value="1" <? if($stx_installment == 1) echo "checked"; ?> style="vertical-align:middle" title="">�г�
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
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">iSMART ID</td>
									<td nowrap class="tdrow" colspan="">
										<input name="stx_kepco_dsm_no"  type="text" class="textfm" style="width:90px;ime-mode:disabled;" value="<?=$stx_kepco_dsm_no?>" maxlength="10"  onkeydown="if(event.keyCode == 13){ goSearch(); }">
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
<?
//���� ���� ����(������� ����) 160527
if($member['mb_level'] > 7) {
?>
								<tr>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">�������</td>
									<td nowrap class="tdrow" colspan="9">
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
								</tr>
<?
}
?>
							</table>
						</form>
<?
//������Ȳ ó����Ȳ ī��Ʈ
$contracts_progress = 0;
$progress_task = 0;
$progress_wrong = 0;
$reserve = 0;
$complete_task = 0;
$part_reduce = 0;
$progress_cancel = 0;
$unselect = 0;
$collet_money = 0;
$reduce1 = 0;
$reduce2 = 0;
$reduce3 = 0;
$reduce4 = 0;
$test1 = 0;
$test2 = 0;

//�˻� ���� �ʱ�ȭ
$sql_search_cnt = " where a.com_code = b.com_code and a.com_code = c.com_code and c.kepco_dsm_chk = '1' ";
//����, ������, ���� ���� �˻�
if($damdang_code != "all" && $damdang_code != "dl" && $damdang_code) {
	$sql_search_add = " and a.damdang_code='$damdang_code' ";
} 
//����� �⺻���� DB : ������������
if($member['mb_level'] == 6) {
	$sql_search_add2 = " and ( a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]' ) ";
//������������ ��������, ������ ��� 160516
} else if($member['mb_level'] == 4 && $member['mb_profile'] != 1) {
	//���� ���� ����
	$sql_search_add2 = " and ( b.manage_cust_numb='$manage_code' ) ";
}
$sql_kepco_dsm = " select c.kepco_dsm_process from com_list_gy a, com_list_gy_opt b, com_list_gy_opt2 c ";
$sql_kepco_dsm .= " $sql_search_cnt $sql_search_add $sql_search_add2 ";
//echo $sql_kepco_dsm;
$result_kepco_dsm = sql_query($sql_kepco_dsm);
for ($i=0; $row_kepco_dsm=mysql_fetch_assoc($result_kepco_dsm); $i++) {
	if($row_kepco_dsm['kepco_dsm_process'] == 1) $contracts_progress++;
	else if($row_kepco_dsm['kepco_dsm_process'] == 2) $progress_task++;
	else if($row_kepco_dsm['kepco_dsm_process'] == 3) $progress_wrong++;
	else if($row_kepco_dsm['kepco_dsm_process'] == 4) $reserve++;
	else if($row_kepco_dsm['kepco_dsm_process'] == 5) $part_reduce++;
	else if($row_kepco_dsm['kepco_dsm_process'] == 6) $progress_cancel++;
	else if($row_kepco_dsm['kepco_dsm_process'] == 7) $collet_money++;
	else if($row_kepco_dsm['kepco_dsm_process'] == 8) $complete_task++;
	else if($row_kepco_dsm['kepco_dsm_process'] == 9)  $reduce1++;
	else if($row_kepco_dsm['kepco_dsm_process'] == 10) $reduce2++;
	else if($row_kepco_dsm['kepco_dsm_process'] == 11) $reduce3++;
	else if($row_kepco_dsm['kepco_dsm_process'] == 12) $reduce4++;
	else if($row_kepco_dsm['kepco_dsm_process'] == 13) $test1++;
	else if($row_kepco_dsm['kepco_dsm_process'] == 14) $test2++;
	else if($row_kepco_dsm['kepco_dsm_process'] == "") $unselect++;
}
$job_total_count = $i;
?>
						<div>
							<div style="cursor:pointer;float:left;width:92px;height:36px;background:url('images/support_person_tag_total.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>';">
								<div class="ftwhite_div" style="margin:11px 0 0 49px;"><?=$job_total_count?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_job_time_tag11.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>?<?=$qstr?>&stx_process=no&stx_construct_chk=';">
								<div class="ftwhite_div"><?=$unselect?></div>
							</div>
							<div style="cursor:pointer;float:left;width:128px;height:36px;background:url('images/erp_electric_charges_tag3.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>?<?=$qstr?>&stx_construct_chk=&stx_process=3';">
								<div class="ftwhite_div" style="margin:11px 0 0 87px;"><?=$contracts_progress?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_electric_charges_tag4.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>?<?=$qstr?>&stx_construct_chk=&stx_process=4';">
								<div class="ftwhite_div"><?=$progress_task?></div>
							</div>
							<div style="cursor:pointer;float:left;width:128px;height:36px;background:url('images/erp_electric_charges_tag5.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>?<?=$qstr?>&stx_construct_chk=&stx_process=5';">
								<div class="ftwhite_div" style="margin:11px 0 0 87px;"><?=$progress_wrong?></div>
							</div>
							<div style="cursor:pointer;float:left;width:95px; height:36px;background:url('images/erp_electric_charges_tag6.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>?<?=$qstr?>&stx_construct_chk=&stx_process=6';">
								<div class="ftwhite_div" style="margin:11px 0 0 61px;"><?=$reserve?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/kepco_dsm_tag5.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>?<?=$qstr?>&stx_construct_chk=&stx_process=5';">
								<div class="ftwhite_div"><?=$part_reduce?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/kepco_dsm_tag9.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>?<?=$qstr?>&stx_construct_chk=&stx_process=9';">
								<div class="ftwhite_div"><?=$reduce1?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/kepco_dsm_tag10.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>?<?=$qstr?>&stx_construct_chk=&stx_process=10';">
								<div class="ftwhite_div"><?=$reduce2?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/kepco_dsm_tag11.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>?<?=$qstr?>&stx_construct_chk=&stx_process=11';">
								<div class="ftwhite_div"><?=$reduce3?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/kepco_dsm_tag12.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>?<?=$qstr?>&stx_construct_chk=&stx_process=12';">
								<div class="ftwhite_div"><?=$reduce4?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/kepco_dsm_tag13.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>?<?=$qstr?>&stx_construct_chk=&stx_process=13';">
								<div class="ftwhite_div"><?=$test1?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/kepco_dsm_tag14.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>?<?=$qstr?>&stx_construct_chk=&stx_process=14';">
								<div class="ftwhite_div"><?=$test2?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_electric_charges_tag14.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>?<?=$qstr?>&stx_construct_chk=&stx_process=12';">
								<div class="ftwhite_div"><?=$progress_cancel?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_electric_charges_tag15.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>?<?=$qstr?>&stx_construct_chk=&stx_process=14';">
								<div class="ftwhite_div"><?=$collet_money?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_electric_charges_tag9.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>?<?=$qstr?>&stx_construct_chk=&stx_process=9';">
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
//���α׷� ������
$electric_charges_excel_url = "javascript:alert('���α׷� ���� ���Դϴ�.');";
?>
									<a href="<?=$electric_charges_excel_url?>"><img src="./images/btn_excel_print_big.png" border="0" /></a>
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
									<td class="tdhead_center" width="26"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" ></td>
									<td class="tdhead_center" width="40">No</td>
<?
$list_date = "�������";
?>
									<td class="tdhead_center" width="70"><?=$list_date?></td>
									<td class="tdhead_center" width="188">������</td>
									<td class="tdhead_center" width="100">��ǥ��</td>
									<td class="tdhead_center" width="94">iSMART ID</td>
									<td class="tdhead_center">���޸�</td>
									<td class="tdhead_center" width="62">÷�μ���</td>
									<td class="tdhead_center" width="88">����</td>
									<td class="tdhead_center" width="80">�ܱ�</td>
									<td class="tdhead_center" width="90">��ü������</td>
									<td class="tdhead_center" width="90">ó����Ȳ</td>
									<td class="tdhead_center" width="110">�����</td>
								</tr>
<?
// ����Ʈ ���
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//NO �ѹ�
	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;
	$id = $row['com_code'];
	//�������
	$date1 = substr($row['kepco_dsm_regdt'],0,10); //��¥ǥ�����ĺ���
	//echo $date1;
	$kepco_dsm_regdt_time = substr($row['kepco_dsm_regdt'],11,8); //�ð��� ǥ��
	$date = explode("-", $date1); 
	$year = $date[0];
	$month = $date[1];
	$day = $date[2];
	$kepco_dsm_regdt = $year.".".$month.".".$day."";
	//������
	$com_name_full = $row['com_name'];
	$com_name = cut_str($com_name_full, 28, "..");
	//�ּ�
	$com_juso_full = $row['com_juso']." ".$row['com_juso2'];
	$com_juso = cut_str($com_juso_full, 28, "..");
	//��ǥ��
	$boss_name_full = $row['boss_name'];
	if($row['boss_name']) $boss_name = cut_str($boss_name_full, 14, "..");
	else $boss_name = "-";
	//���޸�
	if($row['kepco_dsm_memo']) $memo_full = $row['kepco_dsm_memo'];
	else $memo_full = "���޸� ����";
	$memo = cut_str($memo_full, 48, "..");
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
		//���ֵ��� -> ���ַ� ǥ��
		if($damdang_code >= 112 && $damdang_code <= 118) {
			$branch = $man_cust_name_arry[$damdang_code2];
		} else {
			if($damdang_code2) {
				$branch .= ">".$man_cust_name_arry[$damdang_code2];
			}
		}
	} else {
		$branch = "-";
	}
	//������� ��ȣ
	if($row['kepco_dsm_no']) {
		$kepco_dsm_no = $row['kepco_dsm_no'];
	} else {
		$kepco_dsm_no = "-";
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
	//÷�μ���
	if($row['kepco_dsm_file_1']) $kepco_dsm_file_1 = "��";
	else $kepco_dsm_file_1 = "-";
	//����
	if($row['kepco_dsm_down_payment']) $kepco_dsm_down_payment = $row['kepco_dsm_down_payment'];
	else $kepco_dsm_down_payment = "-";
	//�ܱ�
	if($row['kepco_dsm_remainder']) $kepco_dsm_remainder = $row['kepco_dsm_remainder'];
	else {
		if($row['kepco_dsm_remainder2']) $kepco_dsm_remainder = $row['kepco_dsm_remainder2'];
		else $kepco_dsm_remainder = "-";
	}
	//��������ݾ�
	if($row['electric_charges_reduce']) $electric_charges_reduce = $row['electric_charges_reduce'];
	else {
		if($row['electric_charges_reduce2']) $electric_charges_reduce = $row['electric_charges_reduce2'];
		else $electric_charges_reduce = "-";
	}
	//������
	if($row['kepco_dsm_fee']) $kepco_dsm_fee = $row['kepco_dsm_fee'];
	else {
		if($row['kepco_dsm_fee2']) $kepco_dsm_fee = $row['kepco_dsm_fee2'];
		else $kepco_dsm_fee = "-";
	}
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
									<td class="ltrow1_center_h22"><?=$no?></td>
									<td class="ltrow1_center_h22" title="<?=$kepco_dsm_regdt_time?>"><?=$kepco_dsm_regdt?></td>
									<td class="ltrow1_left_h22" title="<?=$com_name_full?>">
										<a href="kepco_dsm_view.php?id=<?=$id?>&w=u&<?=$qstr?>&page=<?=$page?>" style="font-weight:bold"><?=$com_name?></a>
										<br /><?=$com_juso?>
									</td>
									<td class="ltrow1_center_h22" title="<?=$boss_name_full?>"><?=$boss_name?></td>
									<td class="ltrow1_center_h22"><?=$kepco_dsm_no?></td>
									<td class="ltrow1_left_h22">
<?
//���� ����
if($member['mb_level'] > 6) {
?>
										<a href="javascript:open_memo('<?=$id?>')" title="<?=$memo_full?>"><?=$memo?></a>
<? } else { ?>
										<?=$memo?></span>
<? } ?>
									</td>
									<td class="ltrow1_center_h22"><?=$kepco_dsm_file_1?></td>
									<td class="ltrow1_center_h22"><?=$kepco_dsm_down_payment?></td>
									<td class="ltrow1_center_h22"><?=$kepco_dsm_remainder?></td>
									<td class="ltrow1_center_h22"><?=$kepco_dsm_fee?></td>
<?
$sel_check_ok = array();
$check_ok_id = $row['kepco_dsm_process'];
$sel_check_ok[$check_ok_id] = "selected";
?>
									<td class="ltrow1_center_h22">
<?
if($member['mb_level'] > 6) {
?>
										<select name="check_ok_<?=$id?>" class="selectfm" onchange="goCheck_ok(this);">
											<option value="">����</option>
												<option value="1" <?=$sel_check_ok['1']?>><?=$kepco_dsm_process_arry[1]?></option>
												<option value="2" <?=$sel_check_ok['2']?>><?=$kepco_dsm_process_arry[2]?></option>
												<option value="3" <?=$sel_check_ok['3']?>><?=$kepco_dsm_process_arry[3]?></option>
												<option value="4" <?=$sel_check_ok['4']?>><?=$kepco_dsm_process_arry[4]?></option>
												<option value="5" <?=$sel_check_ok['5']?>><?=$kepco_dsm_process_arry[5]?></option>
												<option value="9" <?=$sel_check_ok['9']?>><?=$kepco_dsm_process_arry[9]?></option>
												<option value="10" <?=$sel_check_ok['10']?>><?=$kepco_dsm_process_arry[10]?></option>
												<option value="11" <?=$sel_check_ok['11']?>><?=$kepco_dsm_process_arry[11]?></option>
												<option value="12" <?=$sel_check_ok['12']?>><?=$kepco_dsm_process_arry[12]?></option>
												<option value="13" <?=$sel_check_ok['13']?>><?=$kepco_dsm_process_arry[13]?></option>
												<option value="14" <?=$sel_check_ok['14']?>><?=$kepco_dsm_process_arry[14]?></option>
												<option value="6" <?=$sel_check_ok['6']?>><?=$kepco_dsm_process_arry[6]?></option>
												<option value="7" <?=$sel_check_ok['7']?>><?=$kepco_dsm_process_arry[7]?></option>
												<option value="8" <?=$sel_check_ok['8']?>><?=$kepco_dsm_process_arry[8]?></option>
										</select>
<?
} else {
	if($kepco_dsm_process_arry[$check_ok_id]) echo $kepco_dsm_process_arry[$check_ok_id];
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
<iframe name="check_ok_iframe" src="kepco_dsm_check_ok_update.php" style="width:500px;height:100px" frameborder="0"></iframe>
<? include "./inc/bottom.php";?>
</body>
</html>
