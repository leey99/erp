<?
$sub_menu = "1500100";
include_once("./_common.php");

$sql_common = " from policy_fund a, policy_fund_opt b ";

//echo $member[mb_profile];
if($is_admin != "super") {
	$stx_man_cust_name = $member['mb_profile'];
}
$is_admin = "super";
//echo $is_admin;
//�λ�2���� �����ڸ��
if($member['mb_profile'] == 20) {
	$member['mb_level'] = 8;
}
if($member['mb_level'] <= 6) {
	$sql_search = " where a.id = b.id and a.delete_yn != '1' and damdang_code='$member[mb_profile]' ";
	//���� ������� ����
	if($member['mb_level'] == 5) {
		$mb_id = $member['mb_id'];
		//���Ŵ��� �ڵ� üũ
		$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
		$row_manage = sql_fetch($sql_manage);
		$manage_code = $row_manage['code'];
		$sql_search .= " and (a.writer='$manage_code') ";
	}
} else {
	$sql_search = " where a.id = b.id and a.delete_yn != '1' ";
	//���� ������� ����
	if($member['mb_level'] == 7) {
		$mb_id = $member['mb_id'];
		//���Ŵ��� �ڵ� üũ
		$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
		$row_manage = sql_fetch($sql_manage);
		$manage_code = $row_manage['code'];
		$sql_search .= " and (a.writer='$manage_code') ";
	}
}
if($member['mb_id'] == "user") {
	$sql_search .= " and a.view_restrict != '1' ";
}

// �˻� : ������Ī
if ($stx_com_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_name like '%$stx_com_name%') ";
	$sql_search .= " ) ";
}
// �˻� : ����
if ($stx_upjong) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.upjong like '%$stx_upjong%') ";
	$sql_search .= " ) ";
}
// �˻� : ��ǥ��
if ($stx_boss_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.boss_name like '%$stx_boss_name%') ";
	$sql_search .= " ) ";
}
// �˻� : ��ȭ��ȣ
if ($stx_comp_tel) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_tel like '%$stx_comp_tel%') ";
	$sql_search .= " ) ";
}
// �˻� : �ּ�
if ($stx_com_juso) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_juso like '%$stx_com_juso%') ";
	$sql_search .= " ) ";
}
// �˻� : ó����Ȳ
if ($stx_process) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.check_ok = '$stx_process') ";
	$sql_search .= " ) ";
}

if (!$sst) {
    $sst = "a.id";
    $sod = "desc";
}

$sql_order = " order by $sst $sod ";

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

$top_sub_title = "images/top15_01.gif";
$sub_title = "��å�ڱ��Ƿ�";
$g4[title] = $sub_title." : ��å�ڱ� : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 13;
//�˻� �Ķ���� ����
$qstr = "stx_comp_name=".$stx_comp_name."&stx_upjong=".$stx_upjong."&stx_boss_name=".$stx_boss_name."&stx_t_no=".$stx_t_no."&stx_comp_tel=".$stx_comp_tel."&stx_comp_juso=".$stx_comp_juso."&stx_attend=".$stx_attend;
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
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<script language="javascript">
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
			frm.action="policy_fund_delete.php";
			frm.submit();
		} else {
			return;
		}
	} 
}
function open_memo(id) {
	var ret = window.open("./policy_fund_memo.php?id="+id, "window_memo", "scrollbars=yes,width=520,height=360");
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
	var check_ok = obj.value;
	check_ok_iframe.location.href = "policy_fund_check_ok_update.php?id="+id+"&check_ok="+check_ok;
	return;
}
</script>
<?
include "inc/top.php";
?>
		<td onmouseover="showM('900')" valign="top" style="padding:10px 20px 20px 20px;min-height:480px;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="100"><img src="images/top19.gif" border="0" alt="����о�" /></td>
					<td><img src="<?=$top_sub_title?>" border="0" alt="��å�ڱ�" /></td>
					<td>
<?
$title_main_no = "19";
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
//ó����Ȳ
$process_arry = array("","���Ϸ�","��������","1�����޿Ϸ�","����Ұ�","����","2�����޿Ϸ�","","","�����");
//���� ��ü ����� ���� ����
if($is_admin == "super") {
	//echo $stx_man_cust_name;
?>
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
						<form name="searchForm" method="get">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
								<tr>
									<td nowrap class="tdrowk" width="68">������</td>
									<td nowrap class="tdrow">
										<input name="stx_com_name" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$stx_com_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk" width="44">����</td>
									<td nowrap class="tdrow">
										<input name="stx_upjong" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$stx_upjong?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk" width="58">��ǥ��</td>
									<td nowrap class="tdrow">
										<input name="stx_boss_name" type="text" class="textfm" style="width:80px;ime-mode:active;" value="<?=$stx_boss_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk" width="68">��ȭ��ȣ</td>
									<td nowrap class="tdrow">
										<input name="stx_comp_tel"  type="text" class="textfm" style="width:100px;ime-mode:disabled;" value="<?=$stx_comp_tel?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk" width="44">�ּ�</td>
									<td nowrap class="tdrow">
										<input name="stx_com_juso" type="text" class="textfm" style="width:80px;ime-mode:active;" value="<?=$stx_com_juso?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk" width="68">ó����Ȳ</td>
									<td nowrap class="tdrow">
										<select name="stx_process" class="selectfm" onchange="goSearch();">
											<option value=""  <? if($stx_process == "")  echo "selected"; ?>>��ü</option>
											<option value="9" <? if($stx_process == "9") echo "selected"; ?>><?=$process_arry[9]?></option>
											<option value="1" <? if($stx_process == "1") echo "selected"; ?>><?=$process_arry[1]?></option>
											<option value="2" <? if($stx_process == "2") echo "selected"; ?>><?=$process_arry[2]?></option>
											<option value="3" <? if($stx_process == "3") echo "selected"; ?>><?=$process_arry[3]?></option>
											<option value="6" <? if($stx_process == "6") echo "selected"; ?>><?=$process_arry[6]?></option>
											<option value="4" <? if($stx_process == "4") echo "selected"; ?>><?=$process_arry[4]?></option>
											<option value="5" <? if($stx_process == "5") echo "selected"; ?>><?=$process_arry[5]?></option>
										</select>
									</td>
									<td nowrap class="tdrowk" width="68">ó������</td>
									<td nowrap class="tdrow">
										<input name="stx_process_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$stx_process_date?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
										<table border="0" cellpadding="0" cellspacing="0" style="vertical-align:middle;display:inline;"><tr><td width=2></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.searchForm.stx_attend_date);" target="">�޷�</a></td><td><img src="./images/btn2_rt.gif"></td> <td width=2></td></tr></table>
									</td>
								</tr>
							</table>
						</form>
						<div style="height:10px;font-size:0px;line-height:0px;"></div>
							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
								<tr>
									<td align="center">
										<a href="javascript:goSearch();" target=""><img src="./images/btn_search_big.png" border="0" /></a>
									</td>
								</tr>
							</table>
						</form>
						<div style="height:1px;font-size:0px"></div>
<? } ?>

						<!--��޴� -->
						<table border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td id=""> 
									<table border="0" cellpadding="0" cellspacing="0">
										<tr> 
											<td><img src="images/g_tab_on_lt.gif" /></td> 
											<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" style="width:80;text-align:center;"> 
											����Ʈ
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
						<!--����Ʈ -->
						<form name="dataForm" method="post">
							<input type="hidden" name="chk_data">
							<input type="hidden" name="idx">
							<input type="hidden" name="page" value="<?=$page?>">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
								<tr>
									<td class="tdhead_center" width="26"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" ></td>
									<td class="tdhead_center" width="40">No</td>
									<td class="tdhead_center" width="70">�������</td>
									<td class="tdhead_center" width="198">������/����</td>
									<td class="tdhead_center" width="70">����</td>
									<td class="tdhead_center" width="70">����</td>
									<td class="tdhead_center" width="94">��ȭ/�ڵ���</td>
									<td class="tdhead_center">���޸�</td>
									<td class="tdhead_center" width="106">������/���޾�</td>
									<td class="tdhead_center" width="50">������</td>
									<td class="tdhead_center" width="100">ó����Ȳ</td>
									<td class="tdhead_center" width="94">������ȭ��</td>
									<td class="tdhead_center" width="70">ó������</td>
								</tr>
<?
// ����Ʈ ���
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//����� �ɼ� DB
	$sql_opt = " select * from policy_fund_opt where id='$row[id]' ";
	$result_opt = sql_query($sql_opt);
	$row_opt=mysql_fetch_array($result_opt);
	//$page
	//$total_page
	//$rows
	//NO �ѹ�
	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;
	$id = $row[id];
	$com_name_full = $row[com_name];
	$com_name = cut_str($com_name_full, 28, "..");
	if($row['memo']) $memo_full = $row['memo'];
	else $memo_full = "���޸� ����";
	$memo = cut_str($memo_full, 48, "..");
	if($row['etc']) $etc_full = $row['etc'];
	else $etc_full = "";
	$etc = "<br>".cut_str($etc_full, 48, "..");
	//�ֱ� �������� NEW ǥ��
	//echo date("Y-m-d H:i:s", time() - 96 * 3600);
	if($row['editdt'] >= date("Y-m-d H:i:s", time() - 120 * 3600)) { 
		$etc_new = "<img src='images/icon_new.gif' border='0' style='vertical-align:middle;'>";
	} else {
		$etc_new = "";
	}
	$etc = $etc.$etc_new;
	//���Ŵ���
	$manage_cust_name = $row_opt['manage_cust_name'];
	//������
	$damdang_code = $row['damdang_code'];
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "-";
	//������ ���� ��� - ǥ�� / ���� / ����ȭ / ������ȭ�� / ������ȭ / �ǰ����� / �̵����� / ����Ͻ� / �����Ͻ� / �������
	if(!$row[com_hp]) $row[com_hp] = "-";
	if(!$row[area]) $row[area] = "-";
	if(!$row[teldt]) $row[teldt] = "-";
	if(!$row[writer]) {
		$writer = "-";
	}
	else {
		$writer_code = $row['writer'];
		$writer = $writer_arry_policy[$writer_code];
	}
	if(!$row[writer_tel]) $row[writer_tel] = "-";
	if(!$row[process_date]) $row[process_date] = "-";
	if(!$row[process_date2]) $row[process_date2] = "-";
	//����
	$sql_comment = " select count(*) as cnt from policy_fund_comment where mid='$id' and delete_yn != '1' ";
	$row_comment = sql_fetch($sql_comment);
	$comment_count = $row_comment[cnt];
	if($comment_count != 0) $comment_count = "[".$comment_count."]";
	else $comment_count = "";
	//���� �ֽű� new ǥ��
	$sql_comment_new = " select * from policy_fund_comment where mid='$id' and delete_yn!='1' order by regdt desc limit 0,1 ";
	//echo $sql_comment_new;
	$row_comment_new = sql_fetch($sql_comment_new);
	//echo date("Y-m-d H:i:s", time() - 12 * 3600);
	//echo $row_comment_new[regdt];
	if($row_comment_new[regdt] >= date("Y-m-d H:i:s", time() - 48 * 3600)) { 
		$comment_new = "<img src='images/icon_new.gif' border='0' style='vertical-align:middle;'>";
	} else {
		$comment_new = "";
	}
	$comment_cnt = $comment_count.$comment_new;
	//������
	if($row['ok_loan_facility']) $ok_loan_facility = $row['ok_loan_facility'];
	else $ok_loan_facility = "-";
	//���ޱݾ�
	if($row['ok_loan_policy']) $ok_loan_policy = $row['ok_loan_policy'];
	else $ok_loan_policy = "-";
	//������
	if($row['ok_loan_fee']) $ok_loan_fee = $row['ok_loan_fee']."%";
	else $ok_loan_fee = "-";
	//����ݾ�
	$lender = $ok_loan_facility."<br>".$ok_loan_policy;
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
									<td class="ltrow1_center_h22"><?=$no?></td>
									<td class="ltrow1_center_h22"><?=$row['regdt']?></td>
									<td class="ltrow1_left_h22" title="<?=$com_name_full?>">
										<a href="policy_fund_view.php?id=<?=$id?>&w=u&<?=$qstr?>&page=<?=$page?>" style="font-weight:bold"><?=$com_name?></a>
										<br><?=$row['upjong']?>
									</td>
									<td class="ltrow1_center_h22"><?=$row['area']?></td>
									<td class="ltrow1_center_h22"><?=$branch?></td>
									<td class="ltrow1_center_h22"><?=$row['com_tel']?><br><?=$row['com_hp']?></td>
									<td class="ltrow1_left_h22">
										<a href="javascript:open_memo('<?=$id?>')" title="<?=$memo_full?>"><?=$memo?><?=$comment_cnt?><span style="color:blue;" title="<?=$etc_full?>"><?=$etc?></span></a>
									</td>
									<td class="ltrow1_center_h22"><?=$lender?></td>
									<td class="ltrow1_center_h22"><?=$ok_loan_fee?></td>
<?
$sel_check_ok = array();
$check_ok_id = $row['check_ok'];
$sel_check_ok[$check_ok_id] = "selected";
?>
									<td class="ltrow1_center_h22">
<?
//if($is_admin == "super" && $member['mb_level'] != 6) {
if(1==1) {
?>
										<select name="check_ok_<?=$id?>" class="selectfm" onchange="goCheck_ok(this);">
											<option value="">����</option>
												<option value="9" <?=$sel_check_ok['9']?>><?=$process_arry[9]?></option>
												<option value="1" <?=$sel_check_ok['1']?>><?=$process_arry[1]?></option>
												<option value="2" <?=$sel_check_ok['2']?>><?=$process_arry[2]?></option>
												<option value="3" <?=$sel_check_ok['3']?>><?=$process_arry[3]?></option>
												<option value="6" <?=$sel_check_ok['6']?>><?=$process_arry[6]?></option>
												<option value="4" <?=$sel_check_ok['4']?>><?=$process_arry[4]?></option>
												<option value="5" <?=$sel_check_ok['5']?>><?=$process_arry[5]?></option>
										</select>
<?
} else {
 echo $process_arry[$check_ok_id];
}
?>
									</td>
									<td class="ltrow1_center_h22"><?=$writer?><br><?=$row[writer_tel]?></td>
									<td class="ltrow1_center_h22"><?=$row['process_date']?><br><?=$row['process_date2']?></td>
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
							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
								<tr>
									<td align="center">
<?
if($is_admin == "super" && $member['mb_level'] != 6) {
?>
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
											<tr>
												<td width=2></td>
												<td><img src=images/btn_lt.gif></td>
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:checked_ok();" target="">���û���</a></td>
												<td><img src=images/btn_rt.gif></td>
											 <td width=2></td>
											</tr>
										</table>
<?
}
?>
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
											<tr>
												<td width=2></td>
												<td><img src=images/btn_lt.gif></td>
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="policy_fund_view.php" target="">�űԵ��</a></td>
												<td><img src=images/btn_rt.gif></td>
											 <td width=2></td>
											</tr>
										</table>
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
<iframe name="check_ok_iframe" src="check_ok_update.php" style="width:0;height:0" frameborder="0"></iframe>
<? include "./inc/bottom.php";?>
</body>
</html>
