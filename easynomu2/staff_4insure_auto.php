<?
$sub_menu = "200100";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$sql_common = " from $g4[pibohum_base] a, pibohum_base_pay_h c ";

//��������� �ɼ� DB
$sql_com_opt = " select * from com_list_gy_opt where com_code='$com_code' ";
$result_com_opt = sql_query($sql_com_opt);
$row_com_opt=mysql_fetch_array($result_com_opt);
//����� Ÿ��
if($row_com_opt[comp_print_type]) {
	$comp_print_type = $row_com_opt[comp_print_type];
} else {
	$comp_print_type = "default";
}

//�⵵, �� ���� (���� ��� ������ -1) 151005
if(!$search_month) {
	$search_month = date("m");
	//echo $search_month;
	if($search_month == 1) {
		$search_year_minus = 1;
		$search_month = 12;
	} else {
		$search_year_minus = 0;
		$search_month -= 1;
	}
	if($search_month < 10) $search_month = "0".$search_month;
	$search_year = date("Y");
	$search_year -= $search_year_minus;
	//���� �� -2
	$search_month_pre = $search_month;
	if($search_month_pre == 1) {
		$search_year_minus = 1;
		$search_month_pre = 12;
	} else {
		$search_year_minus = 0;
		$search_month_pre -= 1;
	}
	if($search_month_pre < 10) $search_month_pre = "0".$search_month_pre;
	$search_year_pre = $search_year;
	$search_year_pre -= $search_year_minus;
	//���� �� -3
	$search_month_pre2 = $search_month_pre;
	if($search_month_pre2 == 1) {
		$search_year_minus = 1;
		$search_month_pre2 = 12;
	} else {
		$search_year_minus = 0;
		$search_month_pre2 -= 1;
	}
	if($search_month_pre2 < 10) $search_month_pre2 = "0".$search_month_pre2;
	$search_year_pre2 = $search_year_pre;
	$search_year_pre2 -= $search_year_minus;
	//���� �� -4
	$search_month_pre3 = $search_month_pre2;
	if($search_month_pre3 == 1) {
		$search_year_minus = 1;
		$search_month_pre3 = 12;
	} else {
		$search_year_minus = 0;
		$search_month_pre3 -= 1;
	}
	if($search_month_pre3 < 10) $search_month_pre3 = "0".$search_month_pre3;
	$search_year_pre3 = $search_year_pre;
	$search_year_pre3 -= $search_year_minus;
}

if($is_admin == "super") {
	$sql_search = " where 1=1 ";
} else {
	$sql_search = " where a.com_code='$com_code' ";
}
//�޿����� DB join
$sql_search .= " and (a.com_code = c.com_code and a.sabun = c.sabun) ";
//���� �޿�����
$sql_search .= " and ( c.year = '$search_year' and c.month = '$search_month' ) ";
//���� �޿� ����
//$sql_search .= " and c.money_for_tax > 0 ";
//����� ����
$sql_search .= " and a.out_day='' ";
//�׷�
$group_by = " group by c.com_code, c.sabun ";
$sql_order = " order by a.name ";
//ǥ�� ����
$rows = 300;
if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$sub_title = "4�뺸��Ű�(�ڵ�)";
$g4[title] = $sub_title." : ������� : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
					$group_by
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 14;

//�˻� �Ķ���� ����
$qstr  = "stx_dept=".$stx_dept."&amp;stx_name=".$stx_name."&amp;stx_sabun=".$stx_sabun."&amp;stx_work_form=".$stx_work_form."&amp;stx_emp_stat=".$stx_emp_stat."&amp;stx_out_temp=".$stx_out_temp."&amp;sst=".$sst."&amp;sod=".$sod;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script src="https://spi.maps.daum.net/imap/map_js_init/postcode.js"></script>
<script type="text/javascript">
//<![CDATA[
function openDaumPostcode(zip1,zip2,addr1,addr2) {
	new daum.Postcode({
			oncomplete: function(data) {
					frm = document.dataForm;
					frm.adr_zip1.value = data.postcode1;
					frm.adr_zip2.value = data.postcode2;
					frm.adr_adr1.value = data.address;
					frm.adr_adr2.focus();
			}
	}).open();
}
function func_checkAll() {
	var f = document.dataForm;
	for( var i = 0; i<f.idx.length; i++ ) {
		f.idx[i].checked = f.checkall.checked;
	}
}
//����Ű�
function checked_ok(action_file) {
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
	 alert("���õ� �ٷ��ڰ� �����ϴ�.");
	 return;
	} else{
		if(confirm("���� �����Ͻðڽ��ϱ�?")) {
			chk_data = chk_data.substring(1, chk_data.length);
			frm.chk_data.value = chk_data;
			frm.action = action_file;
			frm.submit();
		} else {
			return;
		}
	} 
}
//���Ű�, ��ǽŰ� 151112
function join_quit_ok(mode) {
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
	 alert("���õ� �ٷ��ڰ� �����ϴ�.");
	 return;
	} else if(cnt > 5) {
	 alert("���õ� �ٷ��ڰ� 5���� �ʰ��Ͽ����ϴ�.");
	 return;
	} else {
		if(confirm("���� �����Ͻðڽ��ϱ�?")) {
			chk_data = chk_data.substring(1, chk_data.length);
			frm.chk_data.value = chk_data;
			action_file = "4insure_write.php?mode="+mode;
			frm.action = action_file;
			frm.submit();
		} else {
			return;
		}
	} 
}
//]]>
</script>
<? include "./inc/top.php"; ?>
<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="1200" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="270">
<?
if($comp_print_type == "H") {
	include "./inc/left_menu2_type_h.php";
} else {
	include "./inc/left_menu2.php";
}
include "./inc/left_banner.php";
?>
						</td>
						<td valign="top" style="padding:10px 10px 10px 10px">
							<!--Ÿ��Ʋ -->
							<table width="100%" border=0 cellspacing=0 cellpadding=0>
								<tr>     
									<td height="18">
										<table width=100% border=0 cellspacing=0 cellpadding=0>
											<tr>
												<td style='font-size:8pt;color:#929292;'><img src="images/g_title_icon.gif" align=absmiddle  style='margin:0 5 2 0'><span style='font-size:9pt;color:black;'><?=$sub_title?></span>
												</td>
												<td align=right class=navi></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr><td height=1 bgcolor=e0e0de></td></tr>
								<tr><td height=2 bgcolor=f5f5f5></td></tr>
								<tr><td height=5></td></tr>
							</table>


							<!--��޴� -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
												����Ʈ
												</td> 
												<td><img src="images/g_tab_on_rt.gif"></td> 
											</tr> 
										</table> 
									</td> 
									<td width=2></td> 
									<td valign="bottom" style="padding:0 0 0 10px"></td> 
								</tr> 
							</table>
							<div style="height:2px;font-size:0px" class="bgtr"></div>
							<div style="height:2px;font-size:0px;line-height:0px;"></div>
							<!--��޴� -->

							<!--����Ʈ -->
							<form name="dataForm" method="post">
							<input type="hidden" name="chk_data">
							<input type="hidden" name="page" value="<?=$page?>">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
								<tr>
									<td nowrap class="tdhead_center" width="28"><input type="checkbox" name="checkall" value="1" class="textfm" checked onclick="func_checkAll()"></td>
<?
if($is_admin == "super") {
?>
									<td nowrap class="tdhead_center" width="156">�����</td>
<?
}
?>
									<td nowrap class="tdhead_center" width="34">��ȣ</td>
									<td nowrap class="tdhead_center" width="72">����</td>
									<td nowrap class="tdhead_center" width="100">�ֹε�Ϲ�ȣ</td>
									<td nowrap class="tdhead_center" width="70">�Ի���<br />�����</td>
									<td nowrap class="tdhead_center" width="84">(<strong><?=$search_year_pre3.".".$search_month_pre3?></strong>)<br />(<strong><?=$search_year_pre2.".".$search_month_pre2?></strong>)</td>
									<td nowrap class="tdhead_center" width="36">��</td>
									<td nowrap class="tdhead_center" width="84">(<strong><?=$search_year_pre.".".$search_month_pre?></strong>)<br />(<strong><?=$search_year.".".$search_month?></strong>)</td>
									<td nowrap class="tdhead_center" width="36">��</td>
									<td nowrap class="tdhead_center" width="70">�Ű���</td>
									<td nowrap class="tdhead_center" width="66">���濬��</td>
									<td nowrap class="tdhead_center" width="200">�Ű���</td>
									<td nowrap class="tdhead_center" width=""></td>
								</tr>
							</table>
<?
$spanMain_height = 10 * 56 + 1;
?>
							<div id="spanMain" style="width:100%;height:<?=$spanMain_height?>px;overflow-x:hidden;overflow-y:auto;" onScroll="spanLeft.scrollTop = this.scrollTop; spanTop.scrollLeft = this.scrollLeft;">
							<table border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
<?
//��� �ٷ��� ī��Ʈ
$staff_count = 0;
// ����Ʈ ���
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//$page
	//$total_page
	//$rows

	$no = $total_count - ($total_count - $i - ($rows*($page-1))) + 1;
  $list = $i%2;
	//����� �ڵ� / ��� / �ڵ�_���
	$code = $row['com_code'];
	$id = $row['sabun'];
	$code_id = $code."_".$id;
	//�����
	$name = cut_str($row[name], 6, "..");
	//�Ի���/�����
	if($row[in_day] == "..") $in_day = "-";
	else if($row[in_day] == "") $in_day = "-";
	else $in_day = $row[in_day];
	if($row[out_day] == "..") $out_day = "-";
	else if($row[out_day] == "") $out_day = "-";
	else $out_day = $row[out_day];
	//����� ǥ��
	if($row[out_day] == "..") $out_text = "";
	else if($row[out_day] == "") $out_text = "";
	else $out_text = "(���)";
	//�ֹε�Ϲ�ȣ �� �ټ��ڸ� ��ǥ ó��
	$jumin_no = substr($row[jumin_no],0,9)."*****";
	//������
	$now_date = date("Ymd");
	$jumin_date = "19".substr($row[jumin_no],0,9);
	$age_cal = ( $now_date - $jumin_date ) / 10000;
	$age = (int)$age_cal;
	//���ο��� ��60�� �ش� ���
	if($age_cal >= 60) {
		$color_km = "style='color:red' title='�� 60�� �̻� �ٷ���'";
	} else {
		$color_km = "";
	}
	//��뺸�� ��65�� �ش� ���
	if($age_cal >= 65) {
		$color_gy = "style='color:red' title='�� 65�� �̻� �ٷ���'";
	} else {
		$color_gy = "";
	}
	//����(������)
	$sql_month_pre = " select money_for_tax, workhour_total from pibohum_base_pay_h where com_code='$code' and sabun='$id' and year='$search_year_pre' and month='$search_month_pre' ";
	$row_month_pre = sql_fetch($sql_month_pre);
	$money_month_pre = $row_month_pre['money_for_tax'];
	$workhour_total_pre = $row_month_pre['workhour_total'];
	if(!$workhour_total_pre) $workhour_total_pre = "0";
	//����(������) -2 ����
	$sql_month_pre2 = " select money_for_tax, workhour_total from pibohum_base_pay_h where com_code='$code' and sabun='$id' and year='$search_year_pre2' and month='$search_month_pre2' ";
	$row_month_pre2 = sql_fetch($sql_month_pre2);
	$money_month_pre2 = $row_month_pre2['money_for_tax'];
	$workhour_total_pre2 = $row_month_pre2['workhour_total'];
	if(!$workhour_total_pre2) $workhour_total_pre2 = "0";
	//����(������) -3 ����
	$sql_month_pre3 = " select money_for_tax, workhour_total from pibohum_base_pay_h where com_code='$code' and sabun='$id' and year='$search_year_pre3' and month='$search_month_pre3' ";
	$row_month_pre3 = sql_fetch($sql_month_pre3);
	$money_month_pre3 = $row_month_pre3['money_for_tax'];
	$workhour_total_pre3 = $row_month_pre3['workhour_total'];
	if(!$workhour_total_pre3) $workhour_total_pre3 = "0";
	//����(�ش��)
	$money_month = $row['money_for_tax'];
	//�ѱٷνð�(�ش��)
	$workhour_total = $row['workhour_total'];
	//�������
	if($money_month_pre < $money_month) $modify_reason = "�����λ�";
	else $modify_reason = "��������";
	//���Ű�
	if($money_month_pre == 0) $modify_reason = "���Ű�";
	//��ǽŰ�
	if($money_month == 0) $modify_reason = "��ǽŰ�";
	//�Ű��� ��Ÿ��
	if($modify_reason == "���Ű�") $reason_style = "color:blue;";
	else if($modify_reason == "��ǽŰ�") $reason_style = "color:red;";
	else $reason_style = "";
	//���濬��
	if($modify_reason == "�����λ�" || $modify_reason == "��������") $modify_year_month = $search_year.".".$search_month;
	else $modify_year_month = "-";
	//�Ű��� ����
	if($money_month_pre == 0) {
		$row['apply_km'] = "";
		$row['apply_gg'] = "";
	}
	//������� ��ũ
	//$staff_url = "javascript:alert('������� ������ ���� ������� �������� �̵��մϴ�.');self.location.href='staff_view.php?w=u&id=$id&code=$code&page=$page';";
	$staff_url = "staff_view.php?w=u&id=$id&code=$code&page=$page";
	//���� ���� ������ �ٷ��� ����
	if($money_month > 0 || $money_month_pre > 0) {
		$staff_count++;
		//���� �Ű� ���� : �������� 20% ���� 151012
		if($modify_reason == "�����λ�" || $modify_reason == "��������") {
			//�������� �Ǹ� üũ
			$idx_checked = "checked";
			if($row['apply_km'] == "0") {
				//�����λ� üũ ����
				if($money_month_pre < $money_month) {
					$apply_km_checked = "";
				} else {
					//�������� 20$ ���� ��
					if( ($money_month_pre-$money_month) > ($money_month_pre/5) ) $apply_km_checked = "checked";
					else $apply_km_checked = "";
				}
			} else {
				$apply_km_checked = "";
			}
			//������ ���� üũ ���� 160125
			$apply_km_checked = "";
		} else {
			$idx_checked = "";
			if($money_month == 0) {
				$row['apply_gy'] = "";
				$row['apply_sj'] = "";
			}
		}
		//�λ�, ���� �� ��� : abs() ������ ��� ������ ��ȯ 151112
		$modify_pay_diff = abs($money_month_pre - $money_month);
		//echo $name." ".$modify_pay_diff." ";
		//���,��� ���� : �λ�, ���� �� 1���� �̸� ����
		//if( ($modify_reason == "���Ű�" || $modify_reason == "��ǽŰ�") || ( ($modify_reason == "�����λ�" || $modify_reason == "��������") && $modify_pay_diff >= 10000 ) ) {
		//���� 1���� �̸� �Ű��� ��ǥ��
		if($modify_pay_diff < 10000) {
			$idx_checked = "";
			$modify_reason = "-";
		}
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h55" width="28"><input type="checkbox" name="idx" value="<?=$id?>" <?=$idx_checked?> class="no_borer"></td>
<?
if($is_admin == "super") {
?>
									<td nowrap class="ltrow1_left_h55" style="padding:4px"><?=$com_name?>&nbsp;</td>
<?
}
?>
									<td nowrap class="ltrow1_center_h55" width="34"><?=$staff_count?></td>
									<td nowrap class="ltrow1_center_h55" width="72">
										<a href="<?=$staff_url?>" target="_blank"><b><?=$name?></b></a>
									</td>
									<td nowrap class="ltrow1_center_h55" width="100"><?=$jumin_no?></td>
									<td nowrap class="ltrow1_center_h55" width="70"><?=$in_day?><br /><span style="color:red"><?=$out_day?></span></td>
									<td nowrap class="ltrow1_right_h55" width="80"><div style="padding-right:4px;"><?=number_format($money_month_pre3)?></div><div style="padding-right:4px;"><?=number_format($money_month_pre2)?></div></td>
									<td nowrap class="ltrow1_center_h55" width="36"><?=$workhour_total_pre3?><br /><?=$workhour_total_pre2?></td>
									<td nowrap class="ltrow1_right_h55" width="80"><div style="padding-right:4px;"><?=number_format($money_month_pre)?></div><div style="padding-right:4px;"><?=number_format($money_month)?><input type="hidden" name="money_month_<?=$id?>" value="<?=$money_month?>" /></div></td>
									<td nowrap class="ltrow1_center_h55" width="36"><?=$workhour_total_pre?><br /><?=$workhour_total?></td>
									<td nowrap class="ltrow1_center_h55" width="70" style="<?=$reason_style?>"><?=$modify_reason?><input type="hidden" name="modify_reason_<?=$id?>" value="<?=$modify_reason?>" /></td>
									<td nowrap class="ltrow1_center_h55" width="66"><?=$modify_year_month?><input type="hidden" name="modify_date_<?=$id?>" value="<?=$modify_year_month?>" /></td>
									<td nowrap class="ltrow1_center_h55" width="200">
										<!--��濩�� ������ 0 ��-->
										<input type="checkbox" name="isgy_<?=$id?>" value="1" class="checkbox" <? if($row['apply_gy'] == "0") echo "checked"; ?> ><span <?=$color_gy?>>���</span>
										<input type="checkbox" name="issj_<?=$id?>" value="1" class="checkbox" <? if($row['apply_sj'] == "0") echo "checked"; ?> >����
										<input type="checkbox" name="iskm_<?=$id?>" value="1" class="checkbox" <?=$apply_km_checked?> ><span <?=$color_km?>>����</span>
										<input type="checkbox" name="isgg_<?=$id?>" value="1" class="checkbox" <? if($row['apply_gg'] == "0") echo "checked"; ?> >�ǰ�
									</td>
									<td nowrap class="ltrow1_center_h55" width=""></td>
								</tr>
<?
		//�λ��� �� 1���� �̸� if�� ����
		//}
	}
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
?>
							</table>
							</div>
							<input type="hidden" name="com_code" value="<?=$code?>" />
							<input type="hidden" name="staff_count" value="<?=$staff_count?>" />
							<input type="checkbox" name="idx" value="" style="display:none" />
<?
//���Ѻ� ��ũ��
//echo $member[mb_profile];
if($member['mb_profile'] == "guest") {
	$url_save = "javascript:alert_demo();";
	$url_save2 = "javascript:alert_demo();";
	$url_save3 = "javascript:alert_demo();";
	$url_form = "javascript:alert_demo();";
	$url_excel = "javascript:alert_demo();";
} else {
	$url_save = "javascript:checked_ok('staff_4insure_auto_update.php');";
	$url_save2 = "javascript:join_quit_ok('in');";
	$url_save3 = "javascript:join_quit_ok('out');";
	$url_form = "./work_contract.php?id=$id&code=$code&page=$page";
	$url_excel = "./staff_4insure_auto_excel.php";
}
if($id) {
	$url_pay = "./staff_pay_view.php?w=u&id=$id&code=$code&page=$page";
} else {
	$url_pay = "javascript:alert('���� �� �̿��Ͻʽÿ�.');";
}
//ȭ��������κθ�ȸ : Ȱ��������
if($comp_print_type == "H") {
	if($row2['position'] == "13" || $kind == "beistand") {
		$url_list = "staff_list_beistand.php?page=".$page;
	} else if($row2['position'] == "14" || $kind == "helper") {
		$url_list = "staff_list_helper.php?page=".$page;
	} else {
		$url_list = "staff_list.php?page=".$page;
	}
} else {
	$url_list = "staff_list.php?page=".$page;
}
?>
							<div style="margin-top:10px;"><b>�� <?=$staff_count?>��</b></div>
							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed;margin-top:10px;">
								<tr>
									<td style="text-align:center">
										<a href="<?=$url_save?>"><img src="images/btn_transmit_modify.png" border="0"></a>
										<a href="<?=$url_save2?>"><img src="images/btn_transmit_join.png" border="0"></a>
										<a href="<?=$url_save3?>"><img src="images/btn_transmit_quit.png" border="0"></a>
										<a href="<?=$url_excel?>" target=""><img src="images/btn_excel_print_big.png" border="0"></a>
									</td>
								</tr>
							</table>
							<input type="hidden" name="error_code" style="width:100%" value="" />
							</form>
						</td>
					</tr>
				</table>
				<? include "./inc/bottom.php";?>

			</td>
		</tr>
	</table>			
</div>
<script type="text/javascript">
//<![CDATA[
//�ʱ� ���� ��ü üũ 151014
//addLoadEvent(func_checkAll);
//]]>
</script>
</body>
</html>
