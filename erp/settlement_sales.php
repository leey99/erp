<?
$sub_menu = "300300";
include_once("./_common.php");

//��� ���� ���� 160408
include "./settlement_right.php";

$sql_common = " from com_list_gy a, com_list_gy_opt b, erp_application c ";

//echo $member[mb_profile];
if($is_admin != "super") {
	//$stx_man_cust_name = $member[mb_profile];
}
//$is_admin = "super";
//echo $is_admin;
if($member['mb_level'] > 6 || $search_ok == "ok") {
	$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code ";
} else {
	$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code and ( a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]' ) ";
}
//������ ��û (�⺻ �˻�)
$sql_search .= " and ( c.application_kind != '0' and c.application_kind != '' and ( c.main_receipt_date != '') ) ";
//�������� ��� ���� (�⺻ �˻�)
$sql_search .= " and c.sales_pay != '' ";
//�˻� : ������Ī
if($stx_comp_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_name like '%$stx_comp_name%') ";
	$sql_search .= " ) ";
}
//�˻� : ����������ȣ
if($stx_t_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.t_insureno like '%$stx_t_no%') ";
	$sql_search .= " ) ";
}
//�˻� : ����ڵ�Ϲ�ȣ
if($stx_biz_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.biz_no like '%$stx_biz_no%') ";
	$sql_search .= " ) ";
}
//�˻� : ��ǥ��
if($stx_boss_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.boss_name like '%$stx_boss_name%') ";
	$sql_search .= " ) ";
}
//�˻� : ��ȭ��ȣ
if($stx_comp_tel) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_tel like '%$stx_comp_tel%') ";
	$sql_search .= " ) ";
}
//�˻� : ó����Ȳ
if($stx_proxy) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.proxy = '$stx_proxy') ";
	$sql_search .= " ) ";
}
//�˻� : ����
if($stx_man_cust_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.damdang_code = '$stx_man_cust_name') ";
	$sql_search .= " ) ";
}
//�˻� : �����
if($stx_manage_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (c.person_charge like '%$stx_manage_name%') ";
	$sql_search .= " ) ";
}
//�˻� : �˻��Ⱓ
if($stx_search_day_chk) {
	$sst = "a.regdt";
	$sod = "desc";
	if($search_day_all || $search_day1 || $search_day2 || $search_day3 || $search_day4 || $search_day5) $sql_search .= " and ( ";
	//���û����
	if($search_day1) {
		$sql_search .= " ( (c.reapplication_date >= '$search_sday' and c.reapplication_date <= '$search_eday') ) ";
		$sst = "c.reapplication_date";
	}
	//��ü�Ա���
	if($search_day2) {
		if($search_day1) $sql_search .= " or ";
		$sql_search .= " (c.client_receipt_date >= '$search_sday' and c.client_receipt_date <= '$search_eday') ";
		$sst = "c.client_receipt_date";
	}
	//�����Ա���
	if($search_day3) {
		if($search_day1 || $search_day2) $sql_search .= " or ";
		$sql_search .= " (c.main_receipt_date >= '$search_sday' and c.main_receipt_date <= '$search_eday') ";
		$sst = "c.main_receipt_date";
	}
	//�ŷ�����
	if($search_day4) {
		if($search_day1 || $search_day2 || $search_day3) $sql_search .= " or ";
		$sql_search .= " (c.statement_date >= '$search_sday' and c.statement_date <= '$search_eday') ";
		$sst = "c.statement_date";
	}
	//���ݰ�꼭
	if($search_day5) {
		if($search_day1 || $search_day2 || $search_day3 || $search_day4) $sql_search .= " or ";
		$sql_search .= " (c.tax_invoice >= '$search_sday' and c.tax_invoice <= '$search_eday') ";
		$sst = "c.tax_invoice";
	}
	if($search_day_all || $search_day1 || $search_day2 || $search_day3 || $search_day4 || $search_day5) $sql_search .= " ) ";
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
//������ ��û����
if($stx_application_kind) {
	$sql_search .= " and ( ";
	$sql_search .= " (c.application_kind = '$stx_application_kind') ";
	$sql_search .= " ) ";
}
//�˻� : ���������
if($stx_sales_manage_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (c.sales_manager_name like '%$stx_sales_manage_name%') ";
	$sql_search .= " ) ";
}
//����
if (!$sst) {
    $sst = "c.main_receipt_date";
    $sod = "desc";
}
$sst2 = ", c.com_code";
$sod2 = "desc";
$sql_order = " order by $sst $sod $sst2 $sod2 ";
//ī��Ʈ
$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

//������ 20�� / 100�� / ��ü
if ($stx_count) {
	if($stx_count == "all") $rows = 999;
	else $rows = $stx_count;
} else {
	$rows = 20;
}
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$sub_title = "��������";
$g4[title] = $sub_title." : ��� : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 15;
//�˻� �Ķ���� ����
$qstr = "stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_biz_no=".$stx_biz_no."&stx_boss_name=".$stx_boss_name."&stx_comp_tel=".$stx_comp_tel."&stx_proxy=".$stx_proxy."&stx_man_cust_name=".$stx_man_cust_name."&stx_uptae=".$stx_uptae."&stx_upjong=".$stx_upjong."&search_ok=".$search_ok;
$qstr .= "&search_year=".$search_year."&search_month=".$search_month."&search_year_end=".$search_year_end."&search_month_end=".$search_month_end."&stx_search_day_chk=".$stx_search_day_chk."&search_sday=".$search_sday."&search_eday=".$search_eday."&stx_application_kind=".$stx_application_kind."&stx_sales_manage_name=".$stx_sales_manage_name;
$qstr .= "&search_day_all=".$search_day_all."&search_day1=".$search_day1."&search_day2=".$search_day2."&search_day3=".$search_day3."&search_day4=".$search_day4."&search_day5=".$search_day5."&search_day6=".$search_day6."&search_day7=".$search_day7."&search_day8=".$search_day8."&stx_biz_no_input_not=".$stx_biz_no_input_not."&stx_manage_name=".$stx_manage_name."&stx_count=".$stx_count;

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
<script type="text/javascript" src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<script type="text/javascript">
function goSearch() {
	var frm = document.searchForm;
	frm.search_ok.value = "branch";
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
</script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script type="text/javascript">
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
<?
$previous_month_start = date("Y.m.01",strtotime("-1month"));
$previous_month_last_day = date('t', strtotime($previous_month_start));
$previous_month_end = date("Y.m",strtotime("-1month")).".".$previous_month_last_day;
$this_month_start = date("Y.m.01");
$this_month_last_day = date('t', strtotime($this_month_start));
$this_month_end = date("Y.m").".".$this_month_last_day;
$next_month_start = date("Y.m.01",strtotime("+1month"));
$next_month_last_day = date('t', strtotime($next_month_start));
$next_month_end = date("Y.m",strtotime("+1month")).".".$next_month_last_day;
?>
function stx_search_day_select(input_obj) {
	var frm = document.searchForm;
	if(input_obj.value == 1) {
		frm['search_sday'].value = "<?=$previous_month_start?>";
		frm['search_eday'].value = "<?=$previous_month_end?>";
	} else 	if(input_obj.value == 2) {
		frm['search_sday'].value = "<?=$this_month_start?>";
		frm['search_eday'].value = "<?=$this_month_end?>";
	} else 	if(input_obj.value == 3) {
		frm['search_sday'].value = "<?=$next_month_start?>";
		frm['search_eday'].value = "<?=$next_month_end?>";
	} else {
		frm['search_sday'].value = "";
		frm['search_eday'].value = "";
	}
}
function search_day_func(obj) {
	var frm = document.searchForm;
	if(frm.search_day_all.checked) {
		if(obj.name == "search_day_all") {
			for(i=1; i<=8; i++) {
				frm['search_day'+i].checked = true;
			}
		} else {
			frm['search_day_all'].checked = false;
		}
	} else if(obj.name == "search_day_all") {
		for(i=1; i<=8; i++) {
			frm['search_day'+i].checked = false;
		}
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
function search_day_chk() {
	var frm = document.searchForm;
	if(frm.stx_search_day_chk.value=='') {
		alert('�Ⱓ���� �� ��¥�� �Է��ϼ���.');
		frm.stx_search_day_chk.focus();
	}
}
</script>
<?
include "inc/top.php";
?>
		<td onmouseover="showM('900')" valign="top">
			<div style="margin:10px 20px 20px 20px;min-height:480px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100"><img src="images/top03.gif" border="0" alt="���" /></td>
						<td><a href="settlement_sales.php"><img src="images/top03_03.gif" border="0" alt="��������" /></a></td>
						<td>
<?
$title_main_no = "03";
include "inc/sub_menu.php";
?>
						</td>
					</tr>
					<tr><td height="1" bgcolor="#cccccc" colspan="9"></td></tr>
				</table>
				<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" style="padding:10px 0 0 0">
							<!--Ÿ��Ʋ -->	
							<form name="searchForm" method="get">
								<input type="hidden" name="search_ok" />
								<input type="hidden" name="search_detail" value="<?=$search_detail?>" />
								<!--������ -->
								<table border="0" cellpadding="0" cellspacing="0"> 
									<tr> 
										<td id=""> 
											<table border="0" cellpadding="0" cellspacing="0"> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif" /></td> 
													<td class="Sftbutton_white" style="width:80px;text-align:center;background:url('images/g_tab_on_bg.gif');">�˻�</td> 
													<td><img src="images/g_tab_on_rt.gif" /></td> 
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
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrowk" width="94"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">������Ī</td>
										<td nowrap class="tdrow" width="140">
											<input name="stx_comp_name" type="text" class="textfm" style="width:120px;" value="<?=$stx_comp_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk" width="116"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����ڵ�Ϲ�ȣ</td>
										<td nowrap class="tdrow" width="200">
											<input name="stx_biz_no" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$stx_biz_no?>" maxlength="12" onkeyup="checkhyphen(this.value, this,'Y')" onkeydown="only_number();if(event.keyCode == 13){ goSearch(); }">
											<input type="checkbox" name="stx_biz_no_input_not" value="1" <? if($stx_biz_no_input_not == 1) echo "checked"; ?> style="vertical-align:middle">�̵��
										</td>
										<td nowrap class="tdrowk" width="90"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��ǥ�ڸ�</td>
										<td nowrap class="tdrow" width="120">
											<input name="stx_boss_name"  type="text" class="textfm" style="width:90px;" value="<?=$stx_boss_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk" width="100"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�������</td>
										<td nowrap class="tdrow" width="110">
											<select name="stx_proxy" class="selectfm" onchange="">
												<option value=""  <? if($stx_proxy == "")  echo "selected"; ?>>��ü</option>
												<option value="1" <? if($stx_proxy == "1") echo "selected"; ?>>����</option>
												<option value="2" <? if($stx_proxy == "2") echo "selected"; ?>>ó����</option>
												<option value="3" <? if($stx_proxy == "3") echo "selected"; ?>>�Ϸ�</option>
												<option value="4" <? if($stx_proxy == "4") echo "selected"; ?>>�������</option>
												<option value="5" <? if($stx_proxy == "5") echo "selected"; ?>>�ݷ�</option>
											</select>
										</td>
<?
if($member['mb_level'] > 6) {
	$colspan_plus = 2;
	//echo $stx_man_cust_name;
?>
													<td nowrap class="tdrowk" width="70"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����</td>
													<td nowrap class="tdrow">
														<select name="stx_man_cust_name" class="selectfm">
															<option value="">��ü</option>
<?
include "inc/stx_man_cust_name.php";
?>
														</select>
													</td>
<? } ?>
												</tr>
												<tr>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����</td>
													<td nowrap class="tdrow" colspan="">
														<input name="stx_manage_name"  type="text" class="textfm" style="width:120px;" value="<?=$stx_manage_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
													</td>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����������ȣ</td>
													<td nowrap class="tdrow" colspan="">
														<input name="stx_t_no" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$stx_t_no?>" maxlength="14" onkeyup="checkhyphen_tno(this.value, this,'Y')" onkeydown="only_number();if(event.keyCode == 13){ goSearch(); }">
														<input type="checkbox" name="stx_t_no_input_not" value="1" <? if($stx_t_no_input_not == 1) echo "checked"; ?> style="vertical-align:middle">�̵��
													</td>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����</td>
													<td nowrap class="tdrow" colspan="">
														<input name="stx_uptae"  type="text" class="textfm" style="width:90px;" value="<?=$stx_uptae?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
													</td>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����</td>
													<td nowrap class="tdrow" colspan="<?=(1+$colspan_plus)?>">
														<input name="stx_upjong"  type="text" class="textfm" style="width:90px;" value="<?=$stx_upjong?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
													</td>
												</tr>
												<tr>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����Ա���</td>
													<td nowrap class="tdrow" colspan="3">
														<select name="stx_search_day_chk" class="selectfm" onchange="stx_search_day_select(this)">
															<option value=""  <? if($stx_search_day_chk == "")  echo "selected"; ?>>��ü</option>
															<option value="1" <? if($stx_search_day_chk == "1") echo "selected"; ?>>����</option>
															<option value="2" <? if($stx_search_day_chk == "2") echo "selected"; ?>>�ݿ�</option>
															<option value="3" <? if($stx_search_day_chk == "3") echo "selected"; ?>>�Ϳ�</option>
															<option value="4" <? if($stx_search_day_chk == "4") echo "selected"; ?>>�Ⱓ����</option>
														</select>
														<input name="search_sday" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$search_sday?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y');" onclick="search_day_chk();">
														<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.searchForm.search_sday);" target="">�޷�</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
														~
														<input name="search_eday" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$search_eday?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y');" onclick="search_day_func();">
														<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.searchForm.search_eday);" target="">�޷�</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
<?
$search_day_all = "";
$search_day3 = 1;
?>
														<input type="hidden" name="search_day_all" value="<?=$search_day_all?>">
														<input type="hidden" name="search_day1" value="<?=$search_day1?>">
														<input type="hidden" name="search_day2" value="<?=$search_day2?>">
														<input type="hidden" name="search_day3" value="<?=$search_day3?>">
														<input type="hidden" name="search_day4" value="<?=$search_day4?>">
														<input type="hidden" name="search_day5" value="<?=$search_day5?>">
													</td>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����</td>
													<td nowrap class="tdrow" colspan="">
														<select name="stx_count" class="selectfm" onchange="">
															<option value="20"  <? if($stx_count == "20" || $stx_count == "")  echo "selected"; ?>>20��</option>
															<option value="100"  <? if($stx_count == "100")  echo "selected"; ?>>100��</option>
															<option value="all"  <? if($stx_count == "all")  echo "selected"; ?>>��ü</option>
														</select>
													</td>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��û����</td>
													<td nowrap class="tdrow" colspan="<?=(1+$colspan_plus)?>">
														<select name="stx_application_kind" class="selectfm">
															<option value="0" >����</option>
<?
for($i=1;$i<count($support_kind_array);$i++) {
?>
															<option value="<?=$i?>" <? if($stx_application_kind == $i) echo "selected"; ?>><?=$support_kind_array[$i]?></option>
<?
}
?>
														</select>
													</td>
												</tr>
												<tr>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���������</td>
													<td nowrap class="tdrow" colspan="<?=(7+$colspan_plus)?>">
														<input name="stx_sales_manage_name" type="text" class="textfm" style="width:120px;" value="<?=$stx_sales_manage_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
													</td>
												</tr>
											</table>
											<div style="height:10px;font-size:0px;line-height:0px;"></div>
											<div style="height:10px;font-size:0px;line-height:0px;"></div>
											<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
												<tr>
													<td align="center">
														<a href="javascript:goSearch();" target=""><img src="./images/btn_search_big.png" border="0"></a>
													</td>
												</tr>
											</table>
										</form>
										<div style="height:10px;font-size:0px"></div>

										<!--��޴� -->
										<table border=0 cellspacing=0 cellpadding=0> 
											<tr>
												<td id=""> 
													<table border=0 cellpadding=0 cellspacing=0> 
														<tr> 
															<td><img src="images/g_tab_on_lt.gif" /></td> 
															<td class="Sftbutton_white" style="width:80px;text-align:center;background:url('images/g_tab_on_bg.gif');"> 
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
										<!--����Ʈ -->
										<form name="dataForm" method="post">
											<input type="hidden" name="chk_data">
											<input type="hidden" name="page" value="<?=$page?>">
											<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
												<tr>
													<td class="tdhead_center" width="26" rowspan=""><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" ></td>
													<td class="tdhead_center" width="46" rowspan="">No</td>
													<td class="tdhead_center" rowspan="">������</td>
													<td class="tdhead_center" width="50" rowspan="">����</td>
													<td class="tdhead_center" width="90" rowspan="">�����</td>
													<td class="tdhead_center" width="120" rowspan="">��û����</td>
													<td class="tdhead_center" width="68" rowspan="">�����Ա���</td>
													<td class="tdhead_center" width="72" rowspan="">��ü�Աݾ�</td>
													<td class="tdhead_center" width="48" rowspan="">������</td>
													<td class="tdhead_center" width="72" rowspan="">�������</td>
													<td class="tdhead_center" width="48" rowspan="">�����</td>
													<td class="tdhead_center" width="73" rowspan="">�뿪��</td>
													<td class="tdhead_center" width="48" rowspan="">Ŀ�̼�</td>
													<td class="tdhead_center" width="72" rowspan="">��������</td>
													<td class="tdhead_center" width="80" rowspan="">���������</td>
												</tr>
<?
// ����Ʈ ���
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;
	//�ŷ�ó �ڵ�
	$id = $row['com_code'];
	//��Ź����ó �ڵ�
	if($row['samu_receive_no']) {
		$samu_receive_no = "(".$row['samu_receive_no'].")";
	} else {
		$samu_receive_no = "";
	}
	//�������
	$regdt = $row['regdt'];
	//������� ����
	if($regdt >= $search_sday && $regdt <= $search_eday) $regdt_color = "color:red";
	else $regdt_color = "";
	//��û����
	$application_kind_code = $row['application_kind'];
	$application_kind = $support_kind_array[$application_kind_code];
	//������ : ������, �δ��, �Ǽ�
	$p_support = $row['p_support']."%";
	$p_contribution = $row['p_contribution']."%";
	$p_construction = $row['p_construction']."%";
	$p_training = $row['p_training']."%";
	if($p_support == "0%") $p_support = "-";
	if($p_support == "%") $p_support = "-";
	if($p_training == "%") $p_training = "-";
	if($p_contribution == "0%") $p_contribution = "-";
	if($p_construction == "0%") $p_construction = "-";
	if($p_training == "0%") $p_training = "-";
	//�δ�� ������ ���� 150626
	if($application_kind_code >= 13 && $application_kind_code <= 16) $p_support = $p_contribution;
	else if($application_kind_code == 22) $p_support = $p_training;
	//��û����ݾ� / ���⿹��ݾ�
	if($row['application_fee_sum']) {
		$application_fee_sum = number_format($row['application_fee_sum']);
	} else {
		$application_fee_sum = "-";
	}
	if($row['application_fee_sum']) {
		if($row['p_support']) $application_fee_expect = number_format($row['application_fee_sum']*($row['p_support']/100));
		else $application_fee_expect = "-";
	} else {
		$application_fee_expect = "-";
	}
	//��û�ݾ� / ����ݾ� �հ�
	$afs = str_replace(',','',$application_fee_sum);
	$application_fee_sum_sum += ($afs);
	$afe = str_replace(',','',$application_fee_expect);
	$application_fee_expect_sum += ($afe);
	//��û�Ⱓ/�б� ����
	$application_date_chk = explode(',',$row['application_date_chk']);
	//��û�б� 1
	$application_quarter_year = explode(',',$row['application_quarter_year']);
	$application_quarter = explode('_',$row['application_quarter']);
	$application_quarter_1 = explode(',',$application_quarter[0]);
	$application_quarter_2 = explode(',',$application_quarter[1]);
	$application_quarter_3 = explode(',',$application_quarter[2]);
	if($application_date_chk[0] == 1) {
		$application_date = "�б�";
		if($application_quarter_year[0]) {
			$application_date_title = $application_quarter_year[0]."�� ";
			if($application_quarter_1[0] == 1) $application_date_title .= "1.";
			if($application_quarter_1[1] == 1) $application_date_title .= "2.";
			if($application_quarter_1[2] == 1) $application_date_title .= "3.";
			if($application_quarter_1[3] == 1) $application_date_title .= "4.";
			$application_date_title .= "�б�";
		} else {
			$application_date_title = "-\n";
		}
		if($application_quarter_year[1]) {
			$application_date_title .= "\n".$application_quarter_year[1]."�� ";
			if($application_quarter_2[0] == 1) $application_date_title .= "1.";
			if($application_quarter_2[1] == 1) $application_date_title .= "2.";
			if($application_quarter_2[2] == 1) $application_date_title .= "3.";
			if($application_quarter_2[3] == 1) $application_date_title .= "4.";
			$application_date_title .= "�б�";
		}
		if($application_quarter_year[2]) {
			$application_date_title .= "\n".$application_quarter_year[2]."�� ";
			if($application_quarter_3[0] == 1) $application_date_title .= "1.";
			if($application_quarter_3[1] == 1) $application_date_title .= "2.";
			if($application_quarter_3[2] == 1) $application_date_title .= "3.";
			if($application_quarter_3[3] == 1) $application_date_title .= "4.";
			$application_date_title .= "�б�";
		}
	} else {
		$application_date = "�Ⱓ";
		if($row['application_date_start']) $application_date_title = $row['application_date_start']."~".$row['application_date_end'];
		else $application_date_title = "-";
	}
	//����������
	if($row['reapplication_date']) $reapplication_date = $row['reapplication_date'];
	else $reapplication_date = "-";
	//���������� ����
	if($reapplication_date >= $search_sday && $reapplication_date <= $search_eday) $reapplication_date_color = "color:red";
	else $reapplication_date_color = "";
	//��ü�Ա���
	if($row['client_receipt_date']) $client_receipt_date = $row['client_receipt_date'];
	else $client_receipt_date = "-";
	//���������� ����
	if($client_receipt_date >= $search_sday && $client_receipt_date <= $search_eday) $client_receipt_date_color = "color:red";
	else $client_receipt_date_color = "";
	//��ü�Աݾ�
	if($row['client_receipt_fee']) {
		$client_receipt_fee = number_format($row['client_receipt_fee']);
	} else {
		$client_receipt_fee = "-";
	}
	//��ü�Ա��� ����
	if($client_receipt_date >= $search_sday && $client_receipt_date <= $search_eday) $client_receipt_date_color = "color:red";
	else $client_receipt_date_color = "";
	//��ü�Աݾ� �հ�
	$crf = str_replace(',','',$client_receipt_fee);
	$client_receipt_fee_sum += ($crf);
	//�����Ա���
	if($row['main_receipt_date']) $main_receipt_date = $row['main_receipt_date'];
	else $main_receipt_date = "-";
	//�����Ա��� ����
	if($search_sday) {
		if($row['main_receipt_date'] >= $search_sday && $row['main_receipt_date'] <= $search_eday) $main_receipt_date_color = "color:red";
		else $main_receipt_date_color = "";
	}
	//�����Աݾ�
	if($row['main_receipt_fee']) {
		$main_receipt_fee = number_format($row['main_receipt_fee']);
	} else {
		$main_receipt_fee = "-";
	}
	//�����Աݾ� �հ�
	$crf = str_replace(',','',$main_receipt_fee);
	$main_receipt_fee_sum += ($crf);
	//�����Աݾ�
	if($row['requested_amount']) {
		$requested_amount = number_format($row['requested_amount']);
	} else {
		$requested_amount = "-";
	}
	//�����Աݾ� �հ�
	$ra  = str_replace(',','',$requested_amount);
	$requested_amount_sum += ($ra);

	//����� ������ (vat����)
	$lawyer_fee_rate = 0.05;
	if($row['lawyer_fee']) {
		$lawyer_fee1 = number_format($row['lawyer_fee']);
	} else {
		$lawyer_fee1 = "-";
	}
	//����� ������ �հ�
	$lf  = $row['lawyer_fee'];
	$lawyer_fee_sum += ($lf);
	//�������
	$main_income1 = number_format((int)$row['main_income'],0);
	if($main_income1 == 0) $main_income1 = "-";
	//������� �հ�
	$mi  = $row['main_income'];
	$main_income_sum += ($mi);
	//����� / �뿪��
	if($row['allowance_rate']) {
		$allowance_rate = $row['allowance_rate']."%";
		$allowance_pay_num = $row['allowance_pay'];
		$allowance_pay = number_format((int)$allowance_pay_num);
	} else {
		$allowance_rate = "-";
		$allowance_pay_num = 0;
		$allowance_pay = "-";
	}
	$allowance_pay_sum += ($allowance_pay_num);
	//�ŷ�����
	if($row['statement_date']) $statement_date = $row['statement_date'];
	else $statement_date = "-";
	//���ݰ�꼭
	if($row['tax_invoice']) $tax_invoice = $row['tax_invoice'];
	else $tax_invoice = "-";
	//������
	$com_name_full = $row['com_name'];
	$com_name = cut_str($com_name_full, 28, "..");
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
	$com_juso = cut_str($com_juso_full, 18, "..");
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
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "-";
	//���Ŵ���
	$manage_cust_name = $row['manage_cust_name'];
	//�����
	if($row['person_charge']) $person_charge = $row['person_charge'];
	else $person_charge = "-";
	//Ŀ�̼�, ��������
	if($row['sales_rate']) {
		$sales_rate = $row['sales_rate']."%";
		$sales_pay_num = $row['sales_pay'];
		$sales_pay = number_format((int)$sales_pay_num);
	} else {
		$sales_rate = "-";
		$sales_pay_num = 0;
		$sales_pay = "-";
	}
	$sales_pay_sum += ($sales_pay_num);
	//���������
	if($row['sales_manager_name']) $sales_manager_name = $row['sales_manager_name'];
	else $sales_manager_name = "-";
	if($search_sday) {
		if(!($row['main_receipt_date'] >= $search_sday) or !($row['main_receipt_date'] <= $search_eday) or !$row['main_receipt_date']) {
			$person_charge = "";
			$application_kind = "";
			$main_receipt_date = "";
			$client_receipt_fee = "";
			$requested_amount = "";
			$main_income1 = "";
			$lawyer_fee1 = "";
			$allowance_rate = "";
			$allowance_pay = "";
		}
	}
	if($member['mb_level'] > 6 || $row['damdang_code'] == $member['mb_profile']) {
		$com_view = "javascript:alert('��� ���� ������ ���� �����Ȳ �������� �̵��մϴ�.');self.location.href='settlement_view.php?id=$id&w=u&$qstr&page=$page';";
	} else {
		$com_view = "javascript:alert('�ش� �ŷ�ó ������ ������ ������ �����ϴ�.');";
	}
?>
												<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
													<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
													<td class="ltrow1_center_h22"><?=$no?></td>
													<td class="ltrow1_left_h22" title="<?=$com_name_full?>">
														<a href="<?=$com_view?>" style="font-weight:bold"><?=$com_name?></a>
													</td>
													<td class="ltrow1_center_h22"><?=$branch?></td>
													<td class="ltrow1_center_h22"><?=$person_charge?></td>
													<td class="ltrow1_left_h22" style=""><?=$application_kind?></td>
													<td class="ltrow1_center_h22" style="<?=$main_receipt_date_color?>"><?=$main_receipt_date?></td>
													<td class="ltrow1_right_h22_padding" style="color:blue"><?=$client_receipt_fee?></td>
													<td class="ltrow1_center_h22"><?=$p_support?></td>
													<td class="ltrow1_right_h22_padding" style="color:blue"><?=$main_income1?></td>
													<td class="ltrow1_center_h22"><?=$allowance_rate?></td>
													<td class="ltrow1_right_h22_padding" style="color:blue"><?=$allowance_pay?></td>
													<td class="ltrow1_center_h22"><?=$sales_rate?></td>
													<td class="ltrow1_right_h22_padding" style="color:blue"><?=$sales_pay?></td>
													<td class="ltrow1_center_h22"><?=$sales_manager_name?></td>
												</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
?>
												<tr>
													<td class="tdhead_center"></td>
													<td class="tdhead_center"></td>
													<td class="tdhead_center" colspan="5">�հ�(��ü�Աݾ�, �������, �뿪��, ��������)</td>
													<td class="tdhead_right"><?=number_format($client_receipt_fee_sum)?></td>
													<td class="tdhead_center"></td>

													<td class="tdhead_right"><?=number_format($main_income_sum)?></td>

													<td class="tdhead_center"></td>
													<td class="tdhead_right"><?=number_format($allowance_pay_sum)?></td>
													<td class="tdhead_center"></td>
													<td class="tdhead_right"><?=number_format($sales_pay_sum)?></td>
													<td class="tdhead_right"></td>
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
										</form>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
</table>
<? include "./inc/bottom.php";?>
</body>
</html>
