<?
$sub_menu = "700100";
include_once("./_common.php");

$sql_common = " from business_log a ";
$sql_search = " where 1=1 ";

//����� manage code
$mb_id = $member['mb_id'];
$sql_manage = " select * from a4_manage where state=1 and user_id='$mb_id' ";
$result_manage = sql_query($sql_manage);
$row_manage = mysql_fetch_array($result_manage);
$drafter_code = $row_manage['code'];

//�⺻ �˻�, �����ڰ� �ƴ� ��� �����, ������� ������ ���� 160420
if($mb_id != "master") {
	$sql_search .= " and ( drafter_code='$drafter_code' or approval1='$mb_id' or approval2='$mb_id' or approval3='$mb_id' or approval4='$mb_id' or approval5='$mb_id' ) ";
	//��ǥ�� ���
	if($mb_id == "kcmc1001") {
		$sql_search .= " and approval1_process!='' " ;
	//����, ������ ��� / ���� ������ �߰� 160622
	} else if($mb_id == "kcmc1004" || $mb_id == "kcmc1009" || $mb_id == "kcmc2006") {
		$sql_search .= " and (approval1_process!='' or drafter_code='$drafter_code') " ;
	} else if($mb_id == "kcmc1008") {
		$sql_search .= " or (doc_code='2' or doc_code='4') " ;
	}
}

//������ �������� ǥ�� ����
$sql_search .= " and delete_yn='' ";

//�Ҽ�
if($stx_man_cust_name) {
	if($stx_man_cust_name != "all") $sql_search .= " and belong = '$stx_man_cust_name' ";
}
//�μ�
if($search_dept) $sql_search .= " and dept_code = '$search_dept' ";
//��������
if($stx_doc_type) {
	//���������� ��� doc_code = '' ���� 160524
	if($stx_doc_type == 1) $sql_search .= " and doc_code = '' ";
	else $sql_search .= " and doc_code = '$stx_doc_type' ";
}
//�����
if($stx_manage_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (drafter_name like '%$stx_manage_name%') ";
	$sql_search .= " ) ";
}
//�� ��������
if($stx_me_chk) $sql_search .= " and drafter_code = '$drafter_code' ";
//�����
if($stx_search_day_chk) {
	$sst = "subject_date";
	$sod = "desc";
	$sql_search .= " and subject_date >= '$search_sday' and subject_date <= '$search_eday' ";
}
//ó����Ȳ : ���
if($mb_id == "kcmc1009" || $mb_id == "kcmc1004") {
	if(!$stx_process && !$stx_me_chk) $stx_process = 1;
}
if($stx_process) {
	if($stx_process != "all") $sql_search .= " and ( ( approval1='$mb_id' and approval1_process = '$stx_process' ) or ( approval2='$mb_id' and approval2_process = '$stx_process' ) or ( approval3='$mb_id' and approval3_process = '$stx_process' ) or ( approval4='$mb_id' and approval4_process = '$stx_process' ) or ( approval5='$mb_id' and approval5_process = '$stx_process' ) ) ";
}

//����
if (!$sst) {
    $sst = "a.id";
    $sod = "desc";
}
$sql_order = " order by $sst $sod ";
//ī��Ʈ
$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

//���� : ������ 20�� / 100�� / ��ü
if ($stx_count) {
	if($stx_count == "all") $rows = 999;
	else $rows = $stx_count;
} else {
	$rows = 20;
}
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���
if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����
$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>ó��</a>";
$sub_title = "��������";
$g4[title] = $sub_title." : �׷���� : ".$easynomu_name;
$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 12;
//�˻� �Ķ���� ����
$qstr  = "search_dept=".$search_dept."&amp;stx_me_chk=".$stx_me_chk."&amp;stx_process=".$stx_process."&amp;stx_doc_type=".$stx_doc_type;
$qstr .= "&amp;stx_manage_name=".$stx_manage_name."&amp;stx_search_day_chk=".$stx_search_day_chk."&amp;search_sday=".$search_sday."&amp;search_eday=".$search_eday;
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
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script type="text/javascript">
function loadCalendar( obj ) {
	var calendar = new Calendar(0, null, onSelect, onClose);
	calendar.create();
	calendar.parseDate(obj.value);
	calendar.showAtElement(obj, "Br");

	function onSelect(calendar, date) {
		var input_field = obj;
		input_field.value = date;
		if (calendar.dateClicked) {
			calendar.callCloseHandler();
		}
	};

	function onClose(calendar) {
		calendar.hide();
		calendar.destroy();
	};
}
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
			frm.action="groupware_business_delete.php";
			frm.submit();
		} else {
			return;
		}
	} 
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
//����, ����
$previous_day = date("Y.m.d",strtotime("-1day"));
$this_day = date("Y.m.d");
?>
function stx_search_day_select(input_obj) {
	var frm = document.searchForm;
	if(input_obj.value == 1) {
		frm['search_sday'].value = "<?=$previous_month_start?>";
		frm['search_eday'].value = "<?=$previous_month_end?>";
	} else 	if(input_obj.value == 2) {
		frm['search_sday'].value = "<?=$this_month_start?>";
		frm['search_eday'].value = "<?=$this_month_end?>";
	} else 	if(input_obj.value == 4) {
		frm['search_sday'].value = "<?=$previous_day?>";
		frm['search_eday'].value = "<?=$previous_day?>";
	} else 	if(input_obj.value == 5) {
		frm['search_sday'].value = "<?=$this_day?>";
		frm['search_eday'].value = "<?=$this_day?>";
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
</script>
<?
if( ($member['mb_profile'] >= 110 && $member['mb_profile'] <= 200) || $member['mb_level'] == 4 ) include "inc/top_dealer.php";
else include "inc/top.php";
?>
		<td onmouseover="showM('900')" valign="top" style="padding:10px 20px 20px 20px;min-height:480px;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="100"><img src="images/top07.gif" border="0" /></td>
					<td width=""><a href="<?=$_SERVER['PHP_SELF']?>"><img src="images/top_groupware_approval.png" border="0" /></a></td>
					<td>
<?
$title_main_no = "07";
//������2 ����
if($member['mb_level'] != 4) include "inc/sub_menu.php";
//�������� �������
$approval_process_arry = array("","���","����","�ݷ�");
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
							<table border="0" cellpadding="0" cellspacing="0">
								<tr> 
									<td id=""> 
										<table border="0" cellpadding="0" cellspacing="0">
											<tr> 
												<td><img src="images/g_tab_on_lt.gif" /></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
												�˻�
												</td> 
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
									<td nowrap class="tdrowk" width="80"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����</td>
									<td nowrap class="tdrow"  width="170">
										<input name="stx_manage_name" type="text" class="textfm" style="width:120px;" value="<?=$stx_manage_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk" width="50"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����</td>
									<td nowrap class="tdrow"  width="140">
										<input type="checkbox" name="stx_me_chk" value="1" style="vertical-align:middle;" <? if($stx_me_chk) echo "checked"; ?> />�� ��������
									</td>
									<td nowrap class="tdrowk" width="50"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�μ�</td>
									<td nowrap class="tdrow"  width="140">
										<select name="search_dept" class="selectfm">
											<option value="">��ü</option>
<?
	//�μ� : ������, ���������, TM�� �� 3�� 160304
	for($i=1;$i<=3;$i++) {
?>
											<option value="<?=$i?>" <? if($search_dept == $i) echo "selected"; ?>><?=$dept_code_arry[$i]?></option>
<?
	}
?>
										</select>
									</td>
									<td nowrap class="tdrowk" width="80"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��������</td>
									<td nowrap class="tdrow"  width="140">
										<select name="stx_doc_type" class="selectfm">
											<option value="">��ü</option>
<?
for($m=1;$m<count($doc_type_arry);$m++) {
?>
											<option value="<?=$m?>" <? if($stx_doc_type == $m) echo "selected"; ?> ><?=$doc_type_arry[$m]?></option>
<?
}
?>

										</select>
									</td>
									<td nowrap class="tdrowk" width="50"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����</td>
									<td nowrap class="tdrow">
										<select name="stx_count" class="selectfm" onchange="">
											<option value="20"  <? if($stx_count == "20" || $stx_count == "")  echo "selected"; ?>>20��</option>
											<option value="100"  <? if($stx_count == "100")  echo "selected"; ?>>100��</option>
											<option value="all"  <? if($stx_count == "all")  echo "selected"; ?>>��ü</option>
										</select>
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�˻��Ⱓ</td>
									<td nowrap class="tdrow" colspan="3">
										<select name="stx_search_day_chk" class="selectfm" onchange="stx_search_day_select(this)">
											<option value=""  <? if($stx_search_day_chk == "")  echo "selected"; ?>>��ü</option>
											<option value="4" <? if($stx_search_day_chk == "4") echo "selected"; ?>>����</option>
											<option value="5" <? if($stx_search_day_chk == "5") echo "selected"; ?>>����</option>
											<option value="1" <? if($stx_search_day_chk == "1") echo "selected"; ?>>����</option>
											<option value="2" <? if($stx_search_day_chk == "2") echo "selected"; ?>>�ݿ�</option>
											<option value="3" <? if($stx_search_day_chk == "3") echo "selected"; ?>>�Ⱓ����</option>
										</select>
										<input name="search_sday" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$search_sday?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y');" onclick="search_day_chk();">
										<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.searchForm.search_sday);" target="">�޷�</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
										~
										<input name="search_eday" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$search_eday?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y');" onclick="search_day_func();">
										<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.searchForm.search_eday);" target="">�޷�</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����</td>
									<td nowrap class="tdrow" colspan="3">
<?
$sql_annual = " select * from pibohum_base a, pibohum_base_opt2 c where a.com_code=c.com_code and a.sabun=c.sabun and a.mb_code='$drafter_code' ";
$result_annual = sql_query($sql_annual);
$row_annual = mysql_fetch_array($result_annual);
$annual_total = $row_annual['annual_paid_holiday'];
$annual_used  = $row_annual['annual_used'];
$annual_rest  = $annual_total - $annual_used;
echo date("Y")."�� ��ü <strong>".$annual_total."</strong> / ��� <strong title='���ϴ�ü : ��3��, �ϰ��ް�3��, �߼�3��'>".$annual_used."</strong> / �ܿ� <strong>".$annual_rest."</strong>";
?>
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����</td>
									<td nowrap class="tdrow" colspan="">
<?
if($stx_process == "all" || $stx_process == "") echo "<strong>��ü</strong>";
else if($stx_process == 1) echo "<strong>���</strong>";
else if($stx_process == 2) echo "<strong>����</strong>";
else if($stx_process == 3) echo "<strong>�ݷ�</strong>";
?>
										<input type="hidden" name="stx_process" value="<?=$stx_process?>" />
									</td>
								</tr>
							</table>
						</form>
<?
//������Ȳ ó����Ȳ ī��Ʈ
$cnt_report = 0;
$cnt_approval = 0;
$cnt_return = 0;
$sql_search_groupware = " where ( drafter_code='$drafter_code' or approval1='$mb_id' or approval2='$mb_id' or approval3='$mb_id' or approval4='$mb_id' or approval5='$mb_id' ) and delete_yn='' ";
$sql_groupware = " select approval1, approval2, approval3, approval4, approval5, approval1_process, approval2_process, approval3_process, approval4_process, approval5_process from business_log ";
$sql_groupware .= " $sql_search_groupware ";
//echo $sql_groupware;
$result_groupware = sql_query($sql_groupware);
for ($i=0; $row_groupware=mysql_fetch_assoc($result_groupware); $i++) {
	if( ($row_groupware['approval1'] == $mb_id && $row_groupware['approval1_process'] == 1) || ($row_groupware['approval2'] == $mb_id && $row_groupware['approval2_process'] == 1) || ($row_groupware['approval3'] == $mb_id && $row_groupware['approval3_process'] == 1) || ($row_groupware['approval4'] == $mb_id && $row_groupware['approval4_process'] == 1) || ($row_groupware['approval5'] == $mb_id && $row_groupware['approval5_process'] == 1) ) $cnt_report++;
	else if( ($row_groupware['approval1'] == $mb_id && $row_groupware['approval1_process'] == 2) || ($row_groupware['approval2'] == $mb_id && $row_groupware['approval2_process'] == 2) || ($row_groupware['approval3'] == $mb_id && $row_groupware['approval3_process'] == 2) || ($row_groupware['approval4'] == $mb_id && $row_groupware['approval4_process'] == 2) || ($row_groupware['approval5'] == $mb_id && $row_groupware['approval5_process'] == 2) ) $cnt_approval++;
	else if( ($row_groupware['approval1'] == $mb_id && $row_groupware['approval1_process'] == 3) || ($row_groupware['approval2'] == $mb_id && $row_groupware['approval2_process'] == 3) || ($row_groupware['approval3'] == $mb_id && $row_groupware['approval3_process'] == 3) || ($row_groupware['approval4'] == $mb_id && $row_groupware['approval4_process'] == 3) || ($row_groupware['approval5'] == $mb_id && $row_groupware['approval5_process'] == 3) ) $cnt_return++;
}
$job_total_count = $i;
?>
						<div>
							<div style="cursor:pointer;float:left;width:92px;height:36px;background:url('images/groupware_tag_total.png');margin:5px 10px 0 0;" onclick="location.href='groupware_business_log.php?stx_process=all';">
								<div class="ftwhite_div" style="margin:11px 0 0 49px;"><?=$job_total_count?></div>
							</div>
							<div style="cursor:pointer;float:left;width:95px;height:36px;background:url('images/groupware_tag1.png');margin:5px 10px 0 0;" onclick="location.href='groupware_business_log.php?<?=$qstr?>&stx_process=1';">
								<div class="ftwhite_div" style="margin:11px 0 0 61px;"><?=$cnt_report?></div>
							</div>
							<div style="cursor:pointer;float:left;width:105px;height:36px;background:url('images/groupware_tag2.png');margin:5px 10px 0 0;" onclick="location.href='groupware_business_log.php?<?=$qstr?>&stx_process=2';">
								<div class="ftwhite_div" style="margin:11px 0 0 63px;"><?=$cnt_approval?></div>
							</div>
							<div style="cursor:pointer;float:left;width:95px;height:36px;background:url('images/groupware_tag3.png');margin:5px 10px 0 0;" onclick="location.href='groupware_business_log.php?<?=$qstr?>&stx_process=3';">
								<div class="ftwhite_div" style="margin:11px 0 0 61px;"><?=$cnt_return?></div>
							</div>
						</div>

						<div style="clear:both;height:10px;font-size:0px;line-height:0px;"></div>
						<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
							<tr>
								<td align="center">
									<a href="javascript:goSearch();" style="margin-right:20px;"><img src="./images/btn_search_big.png" border="0" /></a>
									<a href="groupware_business_write.php"><img src="./images/btn_business_log.png" border="0" /></a>
									<a href="groupware_attendance_report_write.php"><img src="./images/btn_attendance_report.png" border="0" /></a>
									<a href="groupware_vacation_report_write.php"><img src="./images/btn_vacation_report.png" border="0" /></a>
									<a href="groupware_apology_write.php"><img src="./images/btn_apology.png" border="0" /></a>
								</td>
							</tr>
						</table>

						<div style="height:10px;font-size:0px"></div>

						<!--��޴� -->
						<table border="0" cellpadding="0" cellspacing="0"> 
							<tr>
								<td id=""> 
									<table border="0" cellpadding="0" cellspacing="0"> 
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
							<input type="hidden" name="chk_data">
							<input type="hidden" name="page" value="<?=$page?>">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:">
								<tr>
									<td class="tdhead_center" width="26"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" /></td>
									<td class="tdhead_center" width="46">No</td>
									<td class="tdhead_center" width="130">����Ͻ�</td>
									<td class="tdhead_center" width="70">��������</td>
									<td class="tdhead_center" width="80">��������</td>
									<td class="tdhead_center">����</td>
									<td class="tdhead_center" width="70">�����</td>
									<td class="tdhead_center" width="76">��������</td>
									<td class="tdhead_center" width="130">�����Ͻ�</td>
									<td class="tdhead_center" width="76">�������</td>
									<td class="tdhead_center" width="100">�μ�</td>
									<td class="tdhead_center" width="90">������</td>
								</tr>
<?
// ����Ʈ ���
for ($i=0; $row=mysql_fetch_assoc($result); $i++) {
	$no = $total_count - $i - ($rows*($page-1));
	//echo $total_count;
  $list = $i%2;
	//����� �ڵ��ȣ
	$id = $row['id'];
	//����Ͻ�
	$regdt_time = $row['regdt'];
	$regdt_time_array = explode(" ",$regdt_time);
	$regdt_date_only = $regdt_time_array[0];
	//��������
	$doc_code = $row['doc_code'];
	if($doc_code) $doc_type = $doc_type_arry[$doc_code];
	else $doc_type = "��������";
	//��������
	$v_code = $row['v_code'];
	if($doc_code == 2) $v_type = $attendance_report_kind_arry[$v_code];
	else if($doc_code == 4) {
		$v_type = $vacation_report_kind_arry[$v_code];
		//���������� ������ �������� ǥ�� 160504
		if($v_code == 1) {
			$v_day = substr($row['work_forenoon'], 5, 5);
			$v_type .= " ".$v_day;
		}
	}
	else $v_type = "";
	//����
	$subject_full = $row['subject'];
	$subject = cut_str($subject_full, 66, "..");
	//�����
	if($row['drafter_name']) $drafter_name = $row['drafter_name'];
	else $drafter_name = "-";
	//����������
	$approval_last = "";
	//���� �ڵ� ���� �߰� 160622
	$sql_manage2 = " select * from a4_manage where state=1 and ( user_id='$row[approval1]' or user_id='$row[approval2]' or user_id='$row[approval3]' or user_id='$row[approval4]' or user_id='$row[approval5]' ) order by p_code desc ";
	//echo $sql_manage2;
	$result_manage2 = sql_query($sql_manage2);
	for($k=0; $row_manage2=sql_fetch_array($result_manage2); $k++) {
		$m = $k + 1;
		$approval_name[$m] = $row_manage2['position'];
		//echo $approval_name[$m];
		//�������1 �� 1�� ��� �ӽ�����, 1 �ʰ��� ��� ���������� ǥ�� 160425
		if($row['approval'.$m.'_process'] > 1) $approval_last = $approval_name[$m];
	}
	//������
	$approval_date = $row['approval1_time'];
	if($row['approval2_time']) $approval_date = $row['approval2_time'];
	if($row['approval3_time']) $approval_date = $row['approval3_time'];
	if($row['approval4_time']) $approval_date = $row['approval4_time'];
	if($row['approval5_time']) $approval_date = $row['approval5_time'];
	//�������� ��ũ
	//if($member['mb_level'] > 6 || $row['damdang_code'] == $member['mb_profile'] || $row['damdang_code2'] == $member['mb_profile']) {
	if($member['mb_level'] >= 2 || $row['damdang_code'] == $member['mb_profile'] || $row['damdang_code2'] == $member['mb_profile']) {
		//���½�û
		if($doc_code == 2) $com_view = "groupware_attendance_report_view.php?id=$id&amp;w=u&amp;page=$page&amp;$qstr";
		//�ø���
		else if($doc_code == 3) $com_view = "groupware_apology_view.php?id=$id&amp;w=u&amp;page=$page&amp;$qstr";
		//�ް���û
		else if($doc_code == 4) $com_view = "groupware_vacation_report_view.php?id=$id&amp;w=u&amp;page=$page&amp;$qstr";
		else $com_view = "groupware_business_view.php?id=$id&amp;w=u&amp;page=$page&amp;$qstr";
	} else {
		$com_view = "javascript:alert('�ش� �ŷ�ó ������ ������ ������ �����ϴ�.');";
	}
	//������� 160418
	$approval_process = $row['approval1_process'];
	if($row['approval2_time']) $approval_process = $row['approval2_process'];
	if($row['approval3_time']) $approval_process = $row['approval3_process'];
	if($row['approval4_time']) $approval_process = $row['approval4_process'];
	if($row['approval5_time']) $approval_process = $row['approval5_process'];
	$approval_process_text = $approval_process_arry[$approval_process];
	if(!$approval_process) $approval_process_text = "�ӽ�����";
	//�μ�
	$drafter_code = $row['drafter_code'];
	$sql_dept = " select * from a4_manage where code='$drafter_code' ";
	$result_dept = sql_query($sql_dept);
	$row_dept = mysql_fetch_array($result_dept);
	$dept_code = $row_dept['dept_code'];
	$dept_name = $dept_code_arry[$dept_code];
	//������
	$belong_code = $row_dept['belong'];
	$belong_name = $man_cust_name_arry[$belong_code];
	//�ݷ� ȸ�� ó��
	if($row['approval1_process'] == 3 || $row['approval2_process'] == 3 || $row['approval3_process'] == 3 || $row['approval4_process'] == 3 || $row['approval5_process'] == 3) {
		$log_return = "<span style='color:red;'>(�ݷ�)</span>";
		$tr_class = "list_row_now_gr";
	} else {
		$log_return = "";
		$tr_class = "list_row_now_wh";
	}
	//���޻��� ����
	$sql_message = " select count(*) as message_cnt from business_log_comment where mid='$id' and delete_yn='' ";
	$result_message = sql_query($sql_message);
	$row_message = mysql_fetch_array($result_message);
	if($row_message['message_cnt']) $message_cnt = " <span class='textfm8_trans'>[".$row_message['message_cnt']."]</span>";
	else $message_cnt = "";
?>
								<tr class="<?=$tr_class?>" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='<?=$tr_class?>';">
									<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer" /></td>
									<td class="ltrow1_center_h22"><?=$no?></td>
									<td class="ltrow1_center_h22"><?=$regdt_time?></td>
									<td class="ltrow1_center_h22"><?=$doc_type?></td>
									<td class="ltrow1_center_h22"><?=$v_type?></td>
									<td class="ltrow1_left_h22" title="<?=$subject_full?>">
										<a href="<?=$com_view?>" style="font-weight:bold;<? if($mb_id=='kcmc1001' && $approval_last=='��ǥ') echo "color:blue;"; ?>"><?=$subject.$log_return.$message_cnt?></a>
									</td>
									<td class="ltrow1_center_h22"><?=$drafter_name?></td>
									<td class="ltrow1_center_h22"><?=$approval_last?></td>
									<td class="ltrow1_center_h22"><?=$approval_date?></td>
									<td class="ltrow1_center_h22"><?=$approval_process_text?></td>
									<td class="ltrow1_center_h22"><?=$dept_name?></td>
									<td class="ltrow1_center_h22"><?=$belong_name?></td>
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
							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
								<tr>
									<td align="center">
										<table border="0" cellpadding="0" cellspacing="0" style="display:inline;">
											<tr>
												<td width="2"></td>
												<td><img src="images/btn_lt.gif" /></td>
												<td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="javascript:checked_ok();" target="">���û���</a></td>
												<td><img src="images/btn_rt.gif" /></td>
											 <td width="2"></td>
											</tr>
										</table>
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
