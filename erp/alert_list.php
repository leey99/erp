<?
$sub_menu = "100100";
include_once("./_common.php");

$now_date_type = date("Y-m-d");

$sql_common = " from erp_alert ";

//echo $member[mb_profile];
if($is_admin != "super") {
	//$stx_man_cust_name = $member[mb_profile];
}
//$is_admin = "super";
//echo $is_admin;

$mb_id = $member['mb_id'];
//���Ŵ��� �ڵ� üũ
$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
$row_manage = sql_fetch($sql_manage);
$manage_code = $row_manage['code'];
$p_code = $row_manage['p_code'];

if($member['mb_level'] > 6 || $search_ok == "ok") {
	//$sql_search = " where send_to not like '%branch%' ";
	$sql_search = " where 1=1 ";
	//���� ������� ����
	if($member['mb_level'] == 7) {
		//������ ID, ����� �ڵ�, ���Ŵ��� �ڵ�(���������� �ǰ�) 160322
		$sql_search .= " and (send_to like '%$mb_id%' or user_code='$manage_code' or manage_code='$manage_code') ";
	}
//������� ��ü ���� 160706
} else if($member['mb_level'] == 2) {
	$sql_search = " where ( user_id='$mb_id' ) ";
} else {
	$sql_search = " where ( branch='$member[mb_profile]' or branch2='$member[mb_profile]' ) ";
	//���� ���� : ������ ID, ����� �ڵ�, ���Ŵ��� �ڵ�(���������� �ǰ�) 160322 / ������� 160408
	if($member['mb_level'] == 4 || $member['mb_level'] == 5) {
		$sql_search .= " and (send_to like '%$mb_id%' or user_code='$manage_code' or manage_code='$manage_code') ";
	} else {
		if($p_code == 1) $sql_search .= " ";
		else $sql_search .= " and ( send_to = '' or send_to like '%branch%' or user_code='$manage_code' or manage_code='$manage_code' ) ";
	}
	//������� ��� ���� ���� 160706
	$sql_search .= " and send_to not like '%contractor%' ";
	//������� ��� ���� ���� / �޸� Ÿ�� 99 ����
	$sql_search .= " and memo_type!=99 ";
	//�뱸����(�������Ȯ��, �ű԰��Ȯ��) ���޻��� ���� �˸� ���� 161007
	if($member['mb_profile'] != 16) $sql_search .= " and user_name != '�뱸����' ";
}
//���� ���� �˸��� ǥ�� : �̷� �˸� �ش� �Ͻÿ� ǥ�õ� 151111
$sql_search .= " and ( wr_datetime < '$now_date_type 23:59:59' ) ";

//�ŷ�ó ���� �ִ� �˸��� ǥ��
$sql_search .= " and com_code!='' ";

//ȸ��ID
$mb_id = $member['mb_id'];
//$sql_search .= " or user_id='$mb_id' ";
//�ְ������ : ������û�� ǥ�� : ��ü�� ��ȯ 150909
//if($member['mb_id'] == "master" && !$stx_alert_code) $stx_alert_code = "90001";

//������
if ($stx_comp_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (com_name like '%$stx_comp_name%') ";
	$sql_search .= " ) ";
}
//����ڵ�Ϲ�ȣ
if ($stx_biz_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (biz_no like '%$stx_biz_no%') ";
	$sql_search .= " ) ";
}
//��ǥ��
if ($stx_boss_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (boss_name like '%$stx_boss_name%') ";
	$sql_search .= " ) ";
}
//����
if ($stx_man_cust_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (branch = '$stx_man_cust_name') ";
	$sql_search .= " ) ";
}
//����
if ($stx_man_cust_name2) {
	$sql_search .= " and ( ";
	$sql_search .= " (branch2 = '$stx_man_cust_name2') ";
	$sql_search .= " ) ";
}
//�˸�����
if ($stx_alert_code && $stx_alert_code != "all") {
	$sql_search .= " and ( ";
	$sql_search .= " (alert_code = '$stx_alert_code') ";
	$sql_search .= " ) ";
}
//�˻��Ⱓ
if($stx_search_day_chk) {
	$sql_search .= " and ( ";
	$sql_search .= " (wr_datetime >= '$search_sday 00:00:00' and wr_datetime <= '$search_eday 23:59:59') ";
	$sql_search .= " ) ";
	$sst = "wr_datetime";
	$sod = "desc";
}
//����/������ (����)
if ($stx_read_main) {
	$sql_search .= " and ( ";
	if ($stx_read_main == 1) {
		$sql_search .= " (read_main = '') ";
	} else if ($stx_read_main == 2) {
		$sql_search .= " (read_main != '') ";
	}
	$sql_search .= " ) ";
}
//����/������ (����)
if ($stx_read_branch) {
	$sql_search .= " and ( ";
	if ($stx_read_branch == 1) {
		$sql_search .= " (read_branch = '') ";
	} else if ($stx_read_branch == 2) {
		$sql_search .= " (read_branch != '') ";
	}
	$sql_search .= " ) ";
}
//�����
if($stx_charge) {
	$sql_search .= " and ( ";
	$sql_search .= " (user_name like '%$stx_charge%') ";
	$sql_search .= " ) ";
}
//�޸�
if ($stx_memo) {
	$sql_search .= " and ( ";
	$sql_search .= " (memo like '%$stx_memo%') ";
	$sql_search .= " ) ";
}
//����� : �Ѱ����� kcmc1001 / ������ electric 160920
if($stx_send_to1) $sql_search .= " and (send_to like '%$stx_send_to1%') ";
if($stx_send_to2) $sql_search .= " and (send_to like '%$stx_send_to2%') ";
if($stx_send_to3) $sql_search .= " and (send_to like '%$stx_send_to3%') ";
if($stx_send_to4) $sql_search .= " and (send_to like '%$stx_send_to4%') ";
if($stx_send_to5) $sql_search .= " and (send_to like '%$stx_send_to5%') ";
if($stx_send_to6) $sql_search .= " and (send_to like '%$stx_send_to6%') ";
if($stx_send_to7) $sql_search .= " and (send_to like '%$stx_send_to7%') ";
if($stx_send_to8) $sql_search .= " and (send_to like '%$stx_send_to8%') ";
//����
if (!$sst) {
    $sst = "wr_datetime";
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

$sub_title = "��ü";
$g4[title] = $sub_title." : �˸� : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 12;
//�˻� �Ķ���� ����
$qstr = "stx_comp_name=".$stx_comp_name."&stx_biz_no=".$stx_biz_no."&stx_boss_name=".$stx_boss_name."&stx_man_cust_name=".$stx_man_cust_name."&stx_man_cust_name2=".$stx_man_cust_name2."&search_ok=".$search_ok."&stx_search_day_chk=".$stx_search_day_chk."&search_sday=".$search_sday."&search_eday=".$search_eday;
$qstr .= "&stx_alert_code=".$stx_alert_code."&stx_charge=".$stx_charge."&stx_read_main=".$stx_read_main."&stx_read_branch=".$stx_read_branch."&stx_memo=".$stx_memo."&stx_send_to1=".$stx_send_to1."&stx_send_to2=".$stx_send_to2."&stx_send_to3=".$stx_send_to3."&stx_send_to4=".$stx_send_to4."&stx_send_to5=".$stx_send_to5."&stx_send_to6=".$stx_send_to6."&stx_send_to7=".$stx_send_to7."&stx_send_to8=".$stx_send_to8;
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
function checkAll() {
	var f = document.dataForm;
	for( var i = 0; i<f.idx.length; i++ ) {
		f.idx[i].checked = f.checkall.checked;
	}
}
function del_ok() {
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
			frm.action="alert_delete.php";
			frm.submit();
		} else {
			return;
		}
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
		if(confirm("���� ����ó�� �Ͻðڽ��ϱ�?")) {
			chk_data = chk_data.substring(1, chk_data.length);
			frm.chk_data.value = chk_data;
			frm.action="alert_read_check.php";
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
<script language="javascript">
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
</script>
<?
if( ($member['mb_profile'] >= 110 && $member['mb_profile'] <= 200) || $member['mb_level'] == 4 ) include "inc/top_dealer.php";
else include "inc/top.php";
$php_self = $_SERVER['PHP_SELF'];
?>
					<td onmouseover="showM('900')" valign="top">
						<div style="margin:10px 20px 20px 20px;min-height:480px;">
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td width="100"><img src="images/top_alert.gif" border="0" alt="�˸�" /></td>
									<td><a href="<?=$php_self?>"><img src="images/top_alert_all.gif" border="0" alt="��ü" /></a></td>
									<td>
<?
//���縸 ǥ��
if($member['mb_level'] > 6) {
	//include "inc/sub_menu_alert.php";
}
?>
									</td>
								</tr>
								<tr><td height="1" bgcolor="#cccccc" colspan="3"></td></tr>
							</table>

							<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
								<tr>
									<td valign="top" style="padding:10px 0 0 0">
										<!--Ÿ��Ʋ -->	
										<form name="searchForm" method="get">
											<input type="hidden" name="search_ok">
											<input type="hidden" name="search_detail" value="<?=$search_detail?>">
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
													<td nowrap class="tdrow" width="180">
														<input name="stx_comp_name" type="text" class="textfm" style="width:160px;ime-mode:active;" value="<?=$stx_comp_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
													</td>
													<td nowrap class="tdrowk" width="110"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����ڵ�Ϲ�ȣ</td>
													<td nowrap class="tdrow" width="140">
														<input name="stx_biz_no" type="text" class="textfm" style="width:120px;ime-mode:active;" value="<?=$stx_biz_no?>" maxlength="12" onkeyup="checkBznb(this.value, this,'Y')" onkeydown="if(event.keyCode == 13){ goSearch(); }">
													</td>
													<td nowrap class="tdrowk" width="80"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��ǥ�ڸ�</td>
													<td nowrap class="tdrow" width="130">
														<input name="stx_boss_name"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_boss_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
													</td>
													<td nowrap class="tdrowk" width="80"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�˸�����</td>
													<td nowrap class="tdrow" width="140">
														<select name="stx_alert_code" class="selectfm">
															<option value="all">��ü</option>
															<option value="10002" <? if($stx_alert_code == '10002') echo "selected"; ?>>�Ƿڼ�����</option>
															<option value="10003" <? if($stx_alert_code == '10003') echo "selected"; ?>>��༭����</option>
															<option value="10004" <? if($stx_alert_code == '10004') echo "selected"; ?>>�Ǽ���ü</option>
															<option value="10005" <? if($stx_alert_code == '10005') echo "selected"; ?>>��������ȯ��</option>
															<option value="10006" <? if($stx_alert_code == '10006') echo "selected"; ?>>������������</option>
															<option value="15000" <? if($stx_alert_code == '15000') echo "selected"; ?>>��Ź������</option>
															<option value="15001" <? if($stx_alert_code == '15001') echo "selected"; ?>>�繫��Ź</option>
															<option value="20001" <? if($stx_alert_code == '20001') echo "selected"; ?>>�븮�μ���</option>
															<option value="20002" <? if($stx_alert_code == '20002') echo "selected"; ?>>���ڹο�</option>
															<option value="30001" <? if($stx_alert_code == '30001') echo "selected"; ?>>��û�����ȳ�</option>
															<option value="30002" <? if($stx_alert_code == '30002') echo "selected"; ?>>���ϼ���</option>
															<option value="40001" <? if($stx_alert_code == '40001') echo "selected"; ?>>�����߼�</option>
															<option value="40002" <? if($stx_alert_code == '40002') echo "selected"; ?>>�ð�������</option>
															<option value="40003" <? if($stx_alert_code == '40003') echo "selected"; ?>>���â��</option>
															<option value="40004" <? if($stx_alert_code == '40004') echo "selected"; ?>>�ű԰��Ȯ��</option>
															<option value="50001" <? if($stx_alert_code == '50001') echo "selected"; ?>>�����빫</option>
															<option value="60001" <? if($stx_alert_code == '60001') echo "selected"; ?>>������Ȳ</option>
															<option value="70001" <? if($stx_alert_code == '70001') echo "selected"; ?>>��������</option>
															<option value="80001" <? if($stx_alert_code == '80001') echo "selected"; ?>>���޻���</option>
															<option value="80002" <? if($stx_alert_code == '80002') echo "selected"; ?>>����÷�μ���</option>
															<option value="80003" <? if($stx_alert_code == '80003') echo "selected"; ?>>��������</option>
															<option value="90001" <? if($stx_alert_code == '90001') echo "selected"; ?>>������û</option>
															<option value="90002" <? if($stx_alert_code == '90002') echo "selected"; ?>>�ֿ�����</option>
														</select>
													</td>
<?
$search_colspan = 3;
$search_colspan2 = 5;
if($member['mb_level'] > 6) {
	$search_colspan = 3;
	$search_colspan2 = 7;
	//echo $stx_man_cust_name;
?>
													<td nowrap class="tdrowk" width="70"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����</td>
													<td nowrap class="tdrow" width="100">
														<select name="stx_man_cust_name" class="selectfm">
															<option value="">��ü</option>
<?
include "inc/stx_man_cust_name.php";
?>
														</select>
													</td>
<?
}
?>
												</tr>
												<tr>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�˻��Ⱓ</td>
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
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��������</td>
													<td nowrap class="tdrow" colspan="<?=$search_colspan?>">
														����
														<select name="stx_read_main" class="selectfm" onchange="">
															<option value=""  <? if($stx_read_main == "")  echo "selected"; ?>>��ü</option>
															<option value="1" <? if($stx_read_main == "1") echo "selected"; ?>>������</option>
															<option value="2" <? if($stx_read_main == "2") echo "selected"; ?>>����</option>
														</select>
														����
														<select name="stx_read_branch" class="selectfm" onchange="">
															<option value=""  <? if($stx_read_branch == "")  echo "selected"; ?>>��ü</option>
															<option value="1" <? if($stx_read_branch == "1") echo "selected"; ?>>������</option>
															<option value="2" <? if($stx_read_branch == "2") echo "selected"; ?>>����</option>
														</select>
													</td>
<?
if($member['mb_level'] > 6) {
?>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�����</td>
													<td nowrap class="tdrow">
														<input name="stx_charge"  type="text" class="textfm" style="width:70px;ime-mode:active;" value="<?=$stx_charge?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
													</td>
<?
}
?>
												</tr>
												<tr>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����</td>
													<td nowrap class="tdrow">
														<input name="stx_memo" type="text" class="textfm" style="width:160px;ime-mode:active;" value="<?=$stx_memo?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
													</td>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����</td>
													<td nowrap class="tdrow" colspan="<?=$search_colspan2?>">
														<input type="checkbox" name="stx_send_to2" value="kcmc1001" <? if($stx_send_to2 == "kcmc1001") echo "checked"; ?> style="vertical-align:middle" />�Ѱ�����
														<input type="checkbox" name="stx_send_to7" value="electric" <? if($stx_send_to7 == "electric") echo "checked"; ?> style="vertical-align:middle" />������
														<input type="checkbox" name="stx_send_to8" value="kcmc1006" <? if($stx_send_to8 == "kcmc1006") echo "checked"; ?> style="vertical-align:middle" />������Ʒ�
														<input type="checkbox" name="stx_send_to1" value="kcmc1007" <? if($stx_send_to1 == "kcmc1007") echo "checked"; ?> style="vertical-align:middle" />�繫��Ź
														<input type="checkbox" name="stx_send_to3" value="kcmc1008" <? if($stx_send_to3 == "kcmc1008") echo "checked"; ?> style="vertical-align:middle" />��༭/�븮�μ���
														<input type="checkbox" name="stx_send_to4" value="manager"  <? if($stx_send_to4 == "manager")  echo "checked"; ?> style="vertical-align:middle" />������/�δ��
														<input type="checkbox" name="stx_send_to5" value="kcmc1009" <? if($stx_send_to5 == "kcmc1009") echo "checked"; ?> style="vertical-align:middle" />�����빫/��������
														<input type="checkbox" name="stx_send_to6" value="branch"   <? if($stx_send_to6 == "branch")   echo "checked"; ?> style="vertical-align:middle" />�������
													</td>
												</tr>
											</table>
											<div style="height:10px;font-size:0px;line-height:0px;"></div>

											<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
												<tr>
													<td align="center">
														<a href="javascript:goSearch();" target=""><img src="./images/btn_search_big.png" border="0"></a>
														<a href="javascript:checked_ok();" target=""><img src="./images/btn_read_check_big.png" border="0"></a>
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
										<!--��޴� -->
<?
//�˻� �� ����Ʈ ǥ��
//if($search_ok == "ok" || $search_ok == "branch") {
if(1==1) {
?>
										<!--����Ʈ -->
										<form name="dataForm" method="post">
											<input type="hidden" name="chk_data">
											<input type="hidden" name="page" value="<?=$page?>">
											<input type="hidden" name="qstr" value="<?=$qstr?>">
											<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed">
												<tr>
													<td class="tdhead_center" width="26" rowspan=""><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" ></td>
													<td class="tdhead_center" width="46" rowspan="">No</td>
													<td class="tdhead_center" width="74" rowspan="">����Ͻ�</td>
													<td class="tdhead_center" width="80" rowspan="">������</td>
													<td class="tdhead_center" width="202" rowspan="">�ŷ�ó��</td>
													<td class="tdhead_center" width="94" rowspan="">����ڵ�Ϲ�ȣ</td>
													<td class="tdhead_center" width="70" rowspan="">��ǥ��</td>
													<td class="tdhead_center" width="" rowspan="">����</td>
													<td class="tdhead_center" width="78" rowspan="">�����</td>
													<td class="tdhead_center" width="78" rowspan="">�����</td>
													<td class="tdhead_center" width="84" rowspan="">Ȯ����(����)</td>
													<td class="tdhead_center" width="84" rowspan="">Ȯ����(����)</td>
												</tr>
<?
// ����Ʈ ���
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//����� �ɼ� DB
	$sql_opt = " select * from com_list_gy_opt where com_code='$row[com_code]' ";
	$result_opt = sql_query($sql_opt);
	$row_opt=mysql_fetch_array($result_opt);
	//$page
	//$total_page
	//$rows
	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;
	$idx = $row['idx'];
	$id = $row['com_code'];
	$com_name_full = $row['com_name'];
	$com_name = cut_str($com_name_full, 28, "..");
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
	if($row['boss_name']) $boss_name = $row['boss_name'];
	else $boss_name = "-";
	//������
	$damdang_code = $row['branch'];
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "-";
	//������ : ����
	$damdang_code2 = $row['branch2'];
	if($damdang_code2) $branch2 = ">".$man_cust_name_arry[$damdang_code2];
	else $branch2 = "";
	//���Ŵ���
	$manage_cust_name = $row_opt['manage_cust_name'];
	$memo = $row['memo'];
	//Ȯ����(����)
	$sql_member = " select * from a4_member where mb_id = '$row[read_main]' ";
	$row_member = sql_fetch($sql_member);
	$mb_name = $row_member['mb_name'];
	$mb_nick = $row_member['mb_nick'];
	if($mb_name) {
		$read_main = $mb_name;
		$read_main_name = $mb_nick;
	} else {
		$read_main = "-";
	}
	//Ȯ����(����)
	$sql_member = " select * from a4_member where mb_id = '$row[read_branch]' ";
	$row_member = sql_fetch($sql_member);
	$mb_name = $row_member['mb_name'];
	$mb_nick = $row_member['mb_nick'];
	if($mb_name) {
		$read_branch = $mb_name;
		$read_branch_name = $mb_nick;
	} else {
		$read_branch = "-";
	}
	//����Ȯ����
/*
	$sql_erp_view_log = " select * from erp_view_log where com_code = '$row[com_code]' order by idx desc limit 0, 1 ";
	$row_erp_view_log = sql_fetch($sql_erp_view_log);
	$sql_member = " select * from a4_member where mb_id = '$row_erp_view_log[user_id]' ";
	$row_member = sql_fetch($sql_member);
	$mb_name = $row_member['mb_name'];
	$mb_nick = $row_member['mb_nick'];
	if($mb_name) {
		//$latest_user = $mb_name." (".$mb_nick.")";
		$latest_user = $mb_name;
		$latest_user_name = $mb_nick;
	} else {
		$latest_user = "-";
	}
*/
	//�����
	$send_to_array = explode(",", $row['send_to']);
	$send_to = "";
	for($sta=0; $sta<=count($send_to_array);$sta++) {
		if($send_to_array[0]) {
			//echo $idx." ".$sta." ".$send_to_array[$sta]." / ";
			if($send_to_array[$sta] == "kcmc1007") $send_to = "�繫��Ź<br />";
			else if($send_to_array[$sta] == "kcmc1006") $send_to .= "������Ʒ�<br />";
			else if($send_to_array[$sta] == "kcmc1008") $send_to .= "�븮�μ���<br />";
			else if($send_to_array[$sta] == "manager") $send_to .= "������<br />";
			else if($send_to_array[$sta] == "kcmc1009") $send_to .= "�����빫<br />";
			else if($send_to_array[$sta] == "branch") $send_to .= "�������<br />";
			else if($send_to_array[$sta] == "kcmc1001") $send_to .= "�Ѱ�����<br />";
			else if($send_to_array[$sta] == "electric") $send_to .= "������<br />";
			else if($send_to_array[$sta] == "si4n") $send_to .= "4�뺸��<br />";
		} else {
			$send_to = "��ü";
		}
	}
	//�����
	$sql_member = " select * from a4_member where mb_id = '$row[user_id]' ";
	$row_member = sql_fetch($sql_member);
	$mb_name = $row_member['mb_name'];
	$mb_nick = $row_member['mb_nick'];
	if($mb_name) {
		$reg_user = $mb_name;
		$reg_user_name = $mb_nick;
	} else {
		$reg_user = "-";
		$reg_user_name = "";
	}
	//����� ����
	if($member['mb_level'] > 6 && $reg_user_name) $reg_user_name_text = "<br />(".$reg_user_name.")";
	else $reg_user_name_text = "";
	//�������
	$date1 = substr($row['wr_datetime'],0,10); //��¥ǥ�����ĺ���
	$date = explode("-", $date1); 
	$year = $date[0];
	$month = $date[1]; 
	$day = $date[2]; 
	$latest_date = $year."-".$month."-".$day."";
	$latest_time = $date1 = substr($row['wr_datetime'],11,10);
	//echo $row['branch']." == ".$member['mb_profile'];
	//�˸��ڵ�
	$alert_code = $row['alert_code'];
	//���޻��� �ڵ�
	$memo_type = $row['memo_type'];
	//��ũ
	if($member['mb_level'] > 6 || $row['branch'] == $member['mb_profile'] || $row['branch2'] == $member['mb_profile']) {
		//���� ����
		if($member['mb_profile'] >= 110 && $member['mb_profile'] <= 200) {
			$client_view = "alert_read_link.php?link_url=view_dealer&idx=$idx&id=$id&w=u&$qstr&page=$page";
			$client_process_view = "alert_read_link.php?link_url=view_dealer&idx=$idx&id=$id&w=u&$qstr&page=$page";
		} else {
			$client_view = "alert_read_link.php?link_url=view&idx=$idx&id=$id&w=u&$qstr&page=$page";
			$client_process_view = "alert_read_link.php?link_url=process&idx=$idx&id=$id&w=u&$qstr&page=$page&alert_code=$alert_code&memo_type=$memo_type";
		}
	} else {
		$client_view = "javascript:alert('�ش� �ŷ�ó ������ ������ ������ �����ϴ�.');";
		$client_process_view = "javascript:alert('�ش� �ŷ�ó ������ ������ ������ �����ϴ�.');";
	}
	//���� �ֽű� new ǥ��
	if($row['wr_datetime'] >= date("Y-m-d H:i:s", time() - 12 * 3600)) { 
		$comment_new = "<img src='images/icon_new.gif' border='0' style='vertical-align:middle;'>";
	} else {
		$comment_new = "";
	}
	//����ó��
	if($member['mb_profile'] == 1) {
		if($row['read_main']) {
			$text_bold = "";
		} else {
			$text_bold = "font-weight:bold";
		}
	} else {
		if($row['read_branch']) {
			$text_bold = "";
		} else {
			$text_bold = "font-weight:bold";
		}
	}
?>
												<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
													<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$idx?>" class="no_borer"></td>
													<td class="ltrow1_center_h22"><?=$no?></td>
													<td class="ltrow1_center_h22"><?=$latest_date?><br /><?=$latest_time?></td>
													<td class="ltrow1_center_h22"><?=$branch?><?=$branch2?></td>
													<td class="ltrow1_left_h22" title="<?=$com_name_full?>">
														<a href="<?=$client_process_view?>" style="<?=$text_bold?>"><?=$com_name?></a>
													</td>
													<td class="ltrow1_center_h22"><?=$biz_no?></td>
													<td class="ltrow1_center_h22"><?=$boss_name?></td>
													<td class="ltrow1_left_h22"><a href="<?=$client_process_view?>" style="<?=$text_bold?>"><?=$memo?> <?=$comment_new?></a></td>
													<td class="ltrow1_center_h22" title="<?=$reg_user_name?> <?=$row['wr_datetime']?>"><?=$reg_user?><?=$reg_user_name_text?></td>
													<td class="ltrow1_center_h22" title="<?=$send_to_name?>"><?=$send_to?></td>
													<td class="ltrow1_center_h22" title="<?=$read_main_name?> <?=$row['read_main_time']?>"><?=$read_main?></td>
													<td class="ltrow1_center_h22" title="<?=$read_branch_name?> <?=$row['read_branch_time']?>"><?=$read_branch?></td>

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
															$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
															echo $pagelist;
															?>
														</div>
													</td>
												</tr>
											</table>
<? } else { ?>
											<table width="60%" align="center" border="0" cellpadding="0" cellspacing="0">
												<tr>
													<td height="40">
														<div align="center">
															�˻� �� ����Ʈ�� ǥ�� �˴ϴ�.
														</div>
													</td>
												</tr>
											</table>
<? } ?>
											<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
												<tr>
													<td align="center">
<?
if($is_admin == "super" || $member['mb_level'] >= 9) {
?>
														<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
															<tr>
																<td width=2></td>
																<td><img src=images/btn_lt.gif></td>
																<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:del_ok();" target="">���û���</a></td>
																<td><img src=images/btn_rt.gif></td>
															 <td width=2></td>
															</tr>
														</table>
<?
}
?>
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
