<?
//$sub_menu = "1900400";
$sub_menu = "200700";
include_once("./_common.php");
//������ �˻� ��
if(!$stx_comp_name && !$stx_biz_no) {
	$sql_common = " from com_list_gy a, com_list_gy_opt b, com_list_gy_memo c, com_list_gy_opt2 d ";
} else {
	$sql_common = " from com_list_gy a, com_list_gy_opt b, com_list_gy_opt2 d ";
}
//echo $member[mb_profile];
if($is_admin != "super") {
	//$ = $member[mb_profile];
}
//$is_admin = "super";
//echo $is_admin;
if($member['mb_level'] > 6 || $search_ok == "ok") {
	if(!$stx_comp_name && !$stx_biz_no) {
		$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code and a.com_code = d.com_code ";
		//�޸� ���� ����
		$sql_search .= " and c.delete_yn != '1' ";
	} else {
		$sql_search = " where a.com_code = b.com_code and a.com_code = d.com_code ";
	}
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
	if(!$stx_comp_name && !$stx_biz_no) {
		$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code and a.com_code = d.com_code and ( a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]' ) ";
		//�޸� ���� ����
		$sql_search .= " and c.delete_yn != '1' ";
	} else {
		$sql_search = " where a.com_code = b.com_code and a.com_code = d.com_code and ( a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]' ) ";
	}
	//���� ������� ����
	if($member['mb_level'] == 5) {
		$mb_id = $member['mb_id'];
		//���Ŵ��� �ڵ� üũ
		$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
		$row_manage = sql_fetch($sql_manage);
		$manage_code = $row_manage['code'];
		$sql_search .= " and b.manage_cust_numb='$manage_code' ";
	}
}
//������Ī
if ($stx_comp_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_name like '%$stx_comp_name%') ";
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
//��ȭ��ȣ
if ($stx_comp_tel) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_tel like '%$stx_comp_tel%') ";
	$sql_search .= " ) ";
}
//�ּҰ˻�
if ($stx_addr) {
	if ($stx_addr_first) $addr_first = "";
	else $addr_first = "%";
	$sql_search .= " and a.com_juso like '".$addr_first;
	$sql_search .= "$stx_addr%' ";
}
//����
if ($stx_man_cust_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.damdang_code = '$stx_man_cust_name') ";
	$sql_search .= " ) ";
}
//����
if($stx_man_cust_name2) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.damdang_code2 = '$stx_man_cust_name2') ";
	$sql_search .= " ) ";
}
//�˻��Ⱓ
if($stx_search_day_chk) {
	//$sst = "a.report_date";
	//$sod = "desc";
	$search_sday_date = explode(".", $search_sday); 
	$year = $search_sday_date[0];
	$month = $search_sday_date[1]; 
	$day = $search_sday_date[2]; 
	$search_sday_time = $year."-".$month."-".$day." 00:00:00";
	$search_eday_date = explode(".", $search_eday); 
	$year = $search_eday_date[0];
	$month = $search_eday_date[1]; 
	$day = $search_eday_date[2]; 
	$search_eday_time = $year."-".$month."-".$day." 23:59:59";
	$sql_search .= " and (c.regdt >= '$search_sday_time' and c.regdt <= '$search_eday_time') ";
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
//�������
if($stx_support_person_kind1) {
	$sql_search .= " and ( ";
	$sql_search .= " (d.support_person_kind1 = '$stx_support_person_kind1') ";
	$sql_search .= " ) ";
}
if($stx_support_person_kind2) {
	$sql_search .= " and ( ";
	$sql_search .= " (d.support_person_kind2 = '$stx_support_person_kind2') ";
	$sql_search .= " ) ";
}
if($stx_support_person_kind3) {
	$sql_search .= " and ( ";
	$sql_search .= " (d.support_person_kind3 = '$stx_support_person_kind3') ";
	$sql_search .= " ) ";
}
//ó����Ȳ
if($stx_process) {
	$sql_search .= " and ( ";
	if($stx_process == "no") $sql_search .= " (d.support_person_process = '') ";
	else $sql_search .= " (d.support_person_process = '$stx_process') ";
	$sql_search .= " ) ";
}
//���������
if($stx_support_person_manager_name) {
	$sql_search .= " and (d.support_person_manager_name like '%$stx_support_person_manager_name%') ";
}
//����
if (!$sst) {
	if(!$stx_comp_name && !$stx_biz_no) {
		$sst = "c.regdt";
	} else {
		$sst = "a.com_code";
	}
	$sod = "desc";
}
//�׷����
if(!$stx_comp_name && !$stx_biz_no) {
	$group_by = " group by c.com_code ";
} else {
	$group_by = "";
}
$sql_order = " order by $sst $sod ";
//ī��Ʈ
if(!$stx_comp_name && !$stx_biz_no) {
	$sql = " select count(distinct c.com_code) as cnt $sql_common $sql_search $sql_order ";
} else {
	$sql = " select count(*) as cnt $sql_common $sql_search $sql_order ";
}
//echo $sql;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

//���� ������ 20,100��,��ü
if ($stx_count) {
	if($stx_count == "all") $rows = 999;
	else $rows = $stx_count;
} else {
	$rows = 20;
}
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$top_sub_title = "images/top19_04.gif";
$sub_title = "�����ݴ����Ȯ��";
$g4['title'] = $sub_title." : ����о� : ".$easynomu_name;

$sql = " select *
					$sql_common
					$sql_search
					$group_by
					$sql_order
					limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 12;
//�˻� �Ķ���� ����
$qstr = "stx_process=".$stx_process."&amp;stx_comp_name=".$stx_comp_name."&amp;stx_biz_no=".$stx_biz_no."&amp;stx_boss_name=".$stx_boss_name."&amp;stx_comp_tel=".$stx_comp_tel."&amp;stx_contract=".$stx_contract."&amp;stx_man_cust_name=".$stx_man_cust_name."&amp;stx_man_cust_name2=".$stx_man_cust_name2."&amp;stx_uptae=".$stx_uptae."&amp;stx_upjong=".$stx_upjong."&amp;stx_search_day_chk=".$stx_search_day_chk;
$qstr .= "&amp;stx_addr=".$stx_addr."&amp;stx_addr_first=".$stx_addr_first."&amp;stx_support_person_kind1=".$stx_support_person_kind1."&amp;stx_support_person_kind2=".$stx_support_person_kind2."&amp;stx_support_person_kind3=".$stx_support_person_kind3."&stx_support_person_manager_name=".$stx_support_person_manager_name;
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
function delhyphen(inputVal, count){
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!='-'){		// ���� substring�� ����
			tmp += inputVal.substring(i,i+1);	// ���� ��� , �� ����
		}
	}
	return tmp;
}
//ó����Ȳ ���� �Լ�
function goCheck_ok(obj) {
	var id = obj.name.substring(9,14);
	var check_ok = obj.value;
	check_ok_iframe.location.href = "support_person_check_ok_update.php?id="+id+"&check_ok="+check_ok;
	return;
}
<?
//�˻��Ⱓ �Լ�
$previous_month_start = date("Y.m.01",strtotime("-1month"));
$previous_month_last_day = date('t', strtotime($previous_month_start));
$previous_month_end = date("Y.m",strtotime("-1month")).".".$previous_month_last_day;
$this_month_start = date("Y.m.01");
$this_month_last_day = date('t', strtotime($this_month_start));
$this_month_end = date("Y.m").".".$this_month_last_day;
?>
function stx_search_day_select(input_obj) {
	var frm = document.searchForm;
	if(input_obj.value == 1) {
		frm['search_sday'].value = "<?=$previous_month_start?>";
		frm['search_eday'].value = "<?=$previous_month_end?>";
	} else 	if(input_obj.value == 2) {
		frm['search_sday'].value = "<?=$this_month_start?>";
		frm['search_eday'].value = "<?=$this_month_end?>";
	} else {
		frm['search_sday'].value = "";
		frm['search_eday'].value = "";
	}
}
</script>
<?
include "inc/top.php";
?>
		<td onmouseover="showM('900')" valign="top" style="padding:10px 20px 20px 20px;min-height:480px;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<!--<td width="100"><img src="images/top19.gif" border="0" alt="����о�" /></td>-->
					<td width="100"><img src="images/top02.gif" border="0" alt="������" /></td>
					<td><a href="support_person_list.php"><img src="<?=$top_sub_title?>" border="0" alt="<?=$sub_title?>" /></a></td>
					<td>
<?
//$title_main_no = "19";
$title_main_no = "02";
include "inc/sub_menu.php";
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
								<td valign="bottom"> �� ��������ڰ� �ִ� �ش� "������" �Ǵ� "����ڵ�Ϲ�ȣ"�� �˻� ��, �������� Ŭ���Ͽ� ��������� ������ �Է��ϸ� �˴ϴ�.</td> 
							</tr> 
						</table>
						<div style="height:2px;font-size:0px" class="bgtr"></div>
						<div style="height:2px;font-size:0px;line-height:0px;"></div>
						<!--�˻� -->
						<form name="searchForm" method="get">
							<!--������ -->
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
								<tr>
									<td nowrap class="tdrowk" width="100"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;font-weight:bold;">������</td>
									<td nowrap class="tdrow" width="164">
										<input name="stx_comp_name" type="text" class="textfm" style="width:140px;border:2px solid red;" value="<?=$stx_comp_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk" width="116"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����ڵ�Ϲ�ȣ</td>
									<td nowrap class="tdrow" width="146">
										<input name="stx_biz_no" type="text" class="textfm" style="width:120px;border:2px solid red;ime-mode:disabled;" value="<?=$stx_biz_no?>" maxlength="12" onkeyup="checkhyphen(this.value, this,'Y')" onkeydown="only_number();if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk" width="94"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��ǥ�ڸ�</td>
									<td nowrap class="tdrow" width="116">
										<input name="stx_boss_name"  type="text" class="textfm" style="width:90px;" value="<?=$stx_boss_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk" width="94"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />�ּҰ˻�</td>
									<td nowrap class="tdrow"  width="116">
										<input name="stx_addr"  type="text" class="textfm" style="width:75px;ime-mode:active;" value="<?=$stx_addr?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
										<input type="checkbox" name="stx_addr_first" value="1" <? if($stx_addr_first == 1) echo "checked"; ?> style="vertical-align:middle" title="���˻���" />
									</td>
<?
if($member['mb_level'] > 7) {
	//echo $stx_man_cust_name;
?>
									<td nowrap class="tdrowk" width="70"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����</td>
									<td nowrap class="tdrow">
										<select name="stx_man_cust_name" class="selectfm">
											<option value="">��ü</option>
<?
//$damdang_code = $stx_man_cust_name;
include "inc/stx_man_cust_name.php";
?>
										</select>
									</td>
<? } ?>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�˻��Ⱓ</td>
									<td nowrap class="tdrow" colspan="3">
										<select name="stx_search_day_chk" class="selectfm" onchange="stx_search_day_select(this)">
											<option value=""  <? if($stx_search_day_chk == "")  echo "selected"; ?>>��ü</option>
											<option value="1" <? if($stx_search_day_chk == "1") echo "selected"; ?>>����</option>
											<option value="2" <? if($stx_search_day_chk == "2") echo "selected"; ?>>�ݿ�</option>
											<option value="3" <? if($stx_search_day_chk == "3") echo "selected"; ?>>�Ϳ�</option>
											<option value="4" <? if($stx_search_day_chk == "4") echo "selected"; ?>>�Ⱓ����</option>
										</select>
										<input name="search_sday" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$search_sday?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
										<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.searchForm.search_sday);" target="">�޷�</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
										~
										<input name="search_eday" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$search_eday?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
										<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.searchForm.search_eday);" target="">�޷�</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
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
if($member['mb_level'] > 7) {
?>
									<td nowrap class="tdrowk" width="70"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����</td>
									<td nowrap class="tdrow">
										<select name="stx_man_cust_name2" class="selectfm">
											<option value="">��ü</option>
<?
//���� �˻� ������ ���� 151027
$stx_man_cust_name_old = $stx_man_cust_name;
$stx_man_cust_name = $stx_man_cust_name2;
include "inc/stx_man_cust_name.php";
$stx_man_cust_name = $stx_man_cust_name_old;
?>
										</select>
									</td>
<? } ?>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�������</td>
									<td nowrap class="tdrow" colspan="3">
										<input type="checkbox" name="stx_support_person_kind1" value="1" <? if($stx_support_person_kind1 == 1) echo "checked"; ?> style="vertical-align:middle" />�������
										<input type="checkbox" name="stx_support_person_kind2" value="1" <? if($stx_support_person_kind2 == 1) echo "checked"; ?> style="vertical-align:middle" />60�������
										<input type="checkbox" name="stx_support_person_kind3" value="1" <? if($stx_support_person_kind3 == 1) echo "checked"; ?> style="vertical-align:middle" />���纹����
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���������</td>
									<td nowrap class="tdrow" colspan="">
										<input name="stx_support_person_manager_name"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_support_person_manager_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">ó����Ȳ</td>
									<td nowrap class="tdrow" colspan="">
<?
$sel_check_ok[$stx_process] = "selected";
?>
										<select name="stx_process" class="selectfm">
											<option value="">��ü</option>
											<option value="no" <?=$sel_check_ok['no']?>>�̼���</option>
											<option value="1" <?=$sel_check_ok['1']?>><?=$support_person_process_arry[1]?></option>
											<option value="6" <?=$sel_check_ok['6']?>><?=$support_person_process_arry[6]?></option>
											<option value="2" <?=$sel_check_ok['2']?>><?=$support_person_process_arry[2]?></option>
											<option value="8" <?=$sel_check_ok['8']?>><?=$support_person_process_arry[8]?></option>
											<option value="3" <?=$sel_check_ok['3']?>><?=$support_person_process_arry[3]?></option>
											<option value="4" <?=$sel_check_ok['4']?>><?=$support_person_process_arry[4]?></option>
											<option value="7" <?=$sel_check_ok['7']?>><?=$support_person_process_arry[7]?></option>
											<option value="5" <?=$sel_check_ok['5']?>><?=$support_person_process_arry[5]?></option>
										</select>
									</td>
<?
if($member['mb_level'] > 7) {
?>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����</td>
									<td nowrap class="tdrow" colspan="">
										<select name="stx_count" class="selectfm" onchange="">
											<option value="20"  <? if($stx_count == "20" || $stx_count == "")  echo "selected"; ?>>20��</option>
											<option value="100"  <? if($stx_count == "100")  echo "selected"; ?>>100��</option>
											<option value="all"  <? if($stx_count == "all")  echo "selected"; ?>>��ü</option>
										</select>
									</td>
<? } ?>
								</tr>
							</table>
						</form>
<?
//������Ȳ ó����Ȳ ī��Ʈ
$progress_task = 0;
$document_request = 0;
$contracts_progress = 0;
$support_request = 0;
$work_complete = 0;
$not_target = 0;
$official_document = 0;
$reserve = 0;
$unselect = 0;
//����, ���� ���� �˻�
if($damdang_code != "all" && $damdang_code) {
	$sql_search_add = " and a.damdang_code='$damdang_code' ";
} 
//����� �⺻���� DB : ��� ���� �˻� ����
if($member['mb_level'] == 6) {
	$sql_search_add2 = " and ( a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]' ) ";
} else {
	if($stx_man_cust_name) $sql_search_add2 = " and ( a.damdang_code='$stx_man_cust_name' ) ";
	if($stx_man_cust_name2) $sql_search_add2 .= " and ( a.damdang_code2='$stx_man_cust_name2' ) ";
}
$sql_support_person = " select b.support_person_process from com_list_gy a, com_list_gy_opt2 b, com_list_gy_memo c where a.com_code=b.com_code and a.com_code=c.com_code and c.delete_yn != '1' $sql_search_add $sql_search_add2 group by c.com_code ";
//echo $sql_support_person;
$result_support_person = sql_query($sql_support_person);
for ($i=0; $row_support_person=mysql_fetch_assoc($result_support_person); $i++) {
	if($row_support_person['support_person_process'] == 1) $progress_task++;
	else if($row_support_person['support_person_process'] == 2) $document_request++;
	else if($row_support_person['support_person_process'] == 3) $support_request++;
	else if($row_support_person['support_person_process'] == 4) $work_complete++;
	else if($row_support_person['support_person_process'] == 5) $not_target++;
	else if($row_support_person['support_person_process'] == 6) $official_document++;
	else if($row_support_person['support_person_process'] == 7) $reserve++;
	else if($row_support_person['support_person_process'] == 8) $contracts_progress++;
	else if($row_support_person['support_person_process'] == "") $unselect++;
}
$job_total_count = $i;
?>
						<div>
							<div style="cursor:pointer;float:left;width:92px;height:36px;background:url('images/support_person_tag_total.png');margin:5px 10px 0 0;" onclick="location.href='support_person_list.php?stx_man_cust_name=<?=$stx_man_cust_name?>&stx_man_cust_name2=<?=$stx_man_cust_name2?>';">
								<div class="ftwhite_div" style="margin:11px 0 0 50px;"><?=$job_total_count?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_job_time_tag11.png');margin:5px 10px 0 0;" onclick="location.href='support_person_list.php?stx_process=no&stx_man_cust_name=<?=$stx_man_cust_name?>&stx_man_cust_name2=<?=$stx_man_cust_name2?>';">
								<div class="ftwhite_div"><?=$unselect?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_process_tag1.png');margin:5px 10px 0 0;" onclick="location.href='support_person_list.php?stx_process=1&stx_man_cust_name=<?=$stx_man_cust_name?>&stx_man_cust_name2=<?=$stx_man_cust_name2?>';">
								<div class="ftwhite_div"><?=$progress_task?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/support_person_tag6.png');margin:5px 10px 0 0;" onclick="location.href='support_person_list.php?stx_process=6&stx_man_cust_name=<?=$stx_man_cust_name?>&stx_man_cust_name2=<?=$stx_man_cust_name2?>';">
								<div class="ftwhite_div"><?=$official_document?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_process_tag2.png');margin:5px 10px 0 0;" onclick="location.href='support_person_list.php?stx_process=2&stx_man_cust_name=<?=$stx_man_cust_name?>&stx_man_cust_name2=<?=$stx_man_cust_name2?>';">
								<div class="ftwhite_div"><?=$document_request?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/support_person_tag8.png');margin:5px 10px 0 0;" onclick="location.href='support_person_list.php?stx_process=8&stx_man_cust_name=<?=$stx_man_cust_name?>&stx_man_cust_name2=<?=$stx_man_cust_name2?>';">
								<div class="ftwhite_div"><?=$contracts_progress?></div>
							</div>
							<div style="cursor:pointer;float:left;width:139px;height:36px;background:url('images/erp_process_tag3.png');margin:5px 10px 0 0;" onclick="location.href='support_person_list.php?stx_process=3&stx_man_cust_name=<?=$stx_man_cust_name?>&stx_man_cust_name2=<?=$stx_man_cust_name2?>';">
								<div class="ftwhite_div" style="margin:11px 0 0 103px;"><?=$support_request?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_process_tag4.png');margin:5px 10px 0 0;" onclick="location.href='support_person_list.php?stx_process=4&stx_man_cust_name=<?=$stx_man_cust_name?>&stx_man_cust_name2=<?=$stx_man_cust_name2?>';">
								<div class="ftwhite_div"><?=$work_complete?></div>
							</div>
							<div style="cursor:pointer;float:left;width:95px; height:36px;background:url('images/erp_electric_charges_tag6.png');margin:5px 10px 0 0;" onclick="location.href='support_person_list.php?stx_process=7&stx_man_cust_name=<?=$stx_man_cust_name?>&stx_man_cust_name2=<?=$stx_man_cust_name2?>';">
								<div class="ftwhite_div" style="margin:11px 0 0 61px;"><?=$reserve?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_process_tag5.png');margin:5px 10px 0 0;" onclick="location.href='support_person_list.php?stx_process=5&stx_man_cust_name=<?=$stx_man_cust_name?>&stx_man_cust_name2=<?=$stx_man_cust_name2?>';">
								<div class="ftwhite_div"><?=$not_target?></div>
							</div>
						</div>
						<div style="clear:both;width:100%;height:10px;font-size:0px;line-height:0px;"></div>
						<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
							<tr>
								<td align="center">
									<a href="javascript:goSearch();"><img src="./images/btn_search_big.png" border="0" /></a>
									<a href="support_person_excel.php?<?=$qstr?>"><img src="./images/btn_excel_print_big.png" border="0" /></a>
								</td>
							</tr>
						</table>
						<div style="height:1px;font-size:0px"></div>
<? } ?>
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
							<form name="dataForm" method="post">
								<input type="hidden" name="chk_data" />
								<input type="hidden" name="page" value="<?=$page?>" />
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:">
									<tr>
										<td class="tdhead_center" width="26" rowspan="2"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" ></td>
										<td class="tdhead_center" width="46" rowspan="2">No</td>
										<td class="tdhead_center" width="240" rowspan="2">������</td>
										<td class="tdhead_center" width="110" rowspan="1">����ڵ�Ϲ�ȣ</td>
										<td class="tdhead_center" width="100" rowspan="1">��ǥ��</td>
										<td class="tdhead_center" width="110" rowspan="1">����</td>
										<td class="tdhead_center" width="62" rowspan="2">�������</td>
										<td class="tdhead_center" width="" rowspan="2">�޸�</td>
										<td class="tdhead_center" width="94" rowspan="2">ó����Ȳ</td>
										<td class="tdhead_center" width="80" rowspan="2">����<br />�����</td>
										<td class="tdhead_center" width="106" rowspan="1">������</td>
									</tr>
									<tr>
										<td class="tdhead_center" width="" rowspan="1">����������ȣ</td>
										<td class="tdhead_center" width="" rowspan="1">���������</td>
										<td class="tdhead_center" width="" rowspan="1">����</td>
										<td class="tdhead_center" width="" rowspan="1">�����</td>
									</tr>
<?
// ����Ʈ ���
for ($i=0; $row=sql_fetch_array($result); $i++) {
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
	//�ּ�
	$com_juso_full = $row['com_juso']." ".$row['com_juso2'];
	$com_juso = cut_str($com_juso_full, 24, "..");
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
	$manage_cust_name = $row['manage_cust_name'];
	//�繫��Ź
	if($row['samu_req_yn'] == "0" || $row['samu_req_yn'] == "") {
		$samu_req = "";
	} else if($row['samu_req_yn'] == "1") {
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
	//���������
	$manager_name = $row['support_person_manager_name'];
	if(!$manager_name) $manager_name = "-";
	//�޸�
	$memo = $row['memo'];
	//�޸�2
	if($row['support_document']) $memo2 = cut_str($row['support_document'], 40, "..");
	else $memo2 = "";
	//������� ����
	if($row['support_person_kind1']) $support_person_kind1 = "<div>�������</div>";
	else $support_person_kind1 = "";
	if($row['support_person_kind2']) $support_person_kind2 = "<div>�����</div>";
	else $support_person_kind2 = "";
	if($row['support_person_kind3']) $support_person_kind3 = "<div>���纹��</div>";
	else $support_person_kind3 = "";
	//�������� ��ũ
	if($member['mb_level'] > 6 || $row['damdang_code'] == $member['mb_profile'] || $row['damdang_code2'] == $member['mb_profile']) {
		$com_view = "support_person_view.php?id=$id&amp;w=u&amp;page=$page&amp;$qstr";
	} else {
		$com_view = "javascript:alert('�ش� �ŷ�ó ������ ������ ������ �����ϴ�.');";
	}
?>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
										<td class="ltrow1_center_h22"><?=$no?></td>
										<td class="ltrow1_left_h22" title="<?=$com_name_full?>">
											<a href="<?=$com_view?>" style="font-weight:bold"><?=$com_name?></a><?//=$regdt_br?>
<?
if($row['com_juso']) {
?>
											<br>											(<?=$row['com_postno']?>) <?=$com_juso?>
<?
}
?>
										</td>
										<td class="ltrow1_center_h22"><?=$biz_no?><br><?=$t_insureno?></td>
										<td class="ltrow1_center_h22" title="<?=$boss_name_full?>"><?=$boss_name?><br><?=$registration_day?></td>
										<td class="ltrow1_center_h22"><span title="<?=$uptae_full?>"><?=$uptae?></span><br><span title="<?=$upjong_full?>"><?=$upjong?></span></td>
										<td class="ltrow1_center_h22"><?=$support_person_kind1?><?=$support_person_kind2?><?=$support_person_kind3?></td>
										<td class="ltrow1_left_h22"><?=$memo?><br /><?=$memo2?></td>
										<td class="ltrow1_center_h22">
<?
$sel_check_ok = array();
if($stx_comp_name || $stx_biz_no) {
	$sql_process = " select support_person_process from com_list_gy_opt2 where com_code='$row[com_code]' ";
	//echo $sql_process;
	$result_process = sql_query($sql_process);
	$row = mysql_fetch_array($result_process);
}
$check_ok_id = $row['support_person_process'];
$sel_check_ok[$check_ok_id] = "selected";
//������, ����, �������� ���� ���� 151209 �뱸���� 160216
//if( ($is_admin == "super" && $member['mb_level'] != 6) || $member['mb_profile'] == 8 || $member['mb_profile'] == 16) {
//��� ����
if(1==1) {
?>
											<select name="check_ok_<?=$id?>" class="selectfm" onchange="goCheck_ok(this);">
												<option value="">����</option>
												<option value="1" <?=$sel_check_ok['1']?>><?=$support_person_process_arry[1]?></option>
												<option value="6" <?=$sel_check_ok['6']?>><?=$support_person_process_arry[6]?></option>
												<option value="2" <?=$sel_check_ok['2']?>><?=$support_person_process_arry[2]?></option>
												<option value="8" <?=$sel_check_ok['8']?>><?=$support_person_process_arry[8]?></option>
												<option value="3" <?=$sel_check_ok['3']?>><?=$support_person_process_arry[3]?></option>
												<option value="4" <?=$sel_check_ok['4']?>><?=$support_person_process_arry[4]?></option>
												<option value="7" <?=$sel_check_ok['7']?>><?=$support_person_process_arry[7]?></option>
												<option value="5" <?=$sel_check_ok['5']?>><?=$support_person_process_arry[5]?></option>
											</select>
<?
} else {
	if($support_person_process_arry[$check_ok_id]) echo $support_person_process_arry[$check_ok_id];
	else echo "-";
}
?>
										</td>
										<td class="ltrow1_center_h22"><?=$manager_name?></td>
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
									</tr>
								</table>
								<table width="60%" align="center" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td height="40">
											<div align="center">
												<?
												$pagelist = get_paging($config['cf_write_pages'], $page, $total_page, "?$qstr&amp;page=");
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
			</div>
		</td>
	</tr>
</table>
<iframe name="check_ok_iframe" src="support_person_check_ok_update.php" style="width:0;height:0" frameborder="0"></iframe>
<? include "./inc/bottom.php";?>
</body>
</html>
