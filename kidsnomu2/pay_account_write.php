<?
$sub_menu = "400400";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$sql_common = " from pibohum_base_pay ";

$sql_a4 = " select com_code from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4[com_code];

//echo $is_admin;
if($is_admin == "super") {
	$sql_search = " where 1=1 ";
} else {
	$sql_search = " where com_code='$com_code' ";
}

//�⵵, �� ����
if(!$search_year) $search_year = date("Y");
//if(!$search_month) $search_month = date("m");

//echo $stx_name;
// �˻� : ��
if ($search_year) {
	$sql_search .= " and ( ";
	$sql_search .= " (year like '$search_year%') ";
	$sql_search .= " ) ";
}
// �˻� : ��
if ($search_month) {
	$sql_search .= " and ( ";
	$sql_search .= " (month like '$search_month%') ";
	$sql_search .= " ) ";
}

if (!$sst) {
	if($is_admin == "super") {
		$sst = "com_code";
	} else {
		$sst = "sort";
	}
	$sod = "desc";
}
$sst2 = ", year desc";
$sst3 = ", month desc";

$sql_order = " order by $sst $sod $sst2 $sst3 ";

$sql = " select count(distinct year, month) as cnt
         $sql_common
         $sql_search
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 15;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>ó��</a>";

$sub_title = "��������";
$g4[title] = $sub_title." : �޿����� : ".$easynomu_name;

$sql = " select com_code, sabun, year, month, count(month) as cnt, sum(money_total) as sum_total, sum(money_gongje) as sum_gongje, sum(money_result) as sum_result, w_date
          $sql_common
          $sql_search group by year, month
          $sql_order 
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);

$colspan = 10;
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript">
<!--
function checkData() {
	var frm = document.dataForm;
	if (frm.comp_name.value == "")
	{
		alert("������Ī�� �Է��ϼ���.");
		frm.comp_name.focus();
		return;
	}
	if (frm.comp_adr.value == "")
	{
		alert("������������ �Է��ϼ���.");
		frm.comp_adr.focus();
		return;
	}
	if (frm.comp_bznb.value == "")
	{
		alert("����ڵ�Ϲ�ȣ�� �Է��ϼ���.");
		frm.comp_bznb.focus();
		return;
	}
	if (frm.comp_tel.value == "")
	{
		alert("��ȭ��ȣ(�����)�� �Է��ϼ���.");
		frm.comp_tel.focus();
		return;
	}
	if (frm.comp_email.value == "")
	{
		alert("�̸����� �Է��ϼ���.");
		frm.comp_email.focus();
		return;
	}
	frm.action = "4insure_update.php";
	frm.submit();
	return;
}
function only_number() {
	if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;
}
//-->
</script>
</head>
<body style="margin:0px">
<? include "./inc/top.php"; ?>
<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="1200" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="270">
<?
include "./inc/left_menu4.php";
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

							<!--������ -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr> 
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
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
							<form name="searchForm" method="post">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<col width="10%">
									<col width="">
									<col width="">
									<tr>
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�ͼӳ⵵/��</td>
										<td nowrap class="tdrow">
											<select name="search_year" class="selectfm" onChange="goSearch();">
<?
for($i=2013;$i<=2015;$i++) {
?>
												<option value="<?=$i?>" <? if($i == $search_year) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
											</select> ��
											<select name="search_month" class="selectfm" onChange="goSearch();">
												<option value="" >��ü</option>
<?
for($i=1;$i<13;$i++) {
	if($i < 10) $month = "0".$i;
	else $month = $i;
?>
												<option value="<?=$month?>" <? if($i == $search_month) echo "selected"; ?> ><?=$month?></option>
<?
}
?>
											</select> ��
										</td>
										<td  nowrap class="tdrow">
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;height:18px;"><tr><td width=2></td><td><img src=images/btn9_lt.gif></td>
											<td style="background:url(images/btn9_bg.gif) repeat-x center" class=ftbutton5_white nowrap><a href="javascript:goSearch();" target="">�� ��</a></td><td><img src=images/btn9_rt.gif></td><td width=2></td></tr></table> 
										</td>
									</tr>
								</table>
							</form>
							<div style="height:10px;font-size:0px;line-height:0px;"></div>

							<form name="printForm" method="post" style="margin:0">
								<input type="hidden" name="mode">
								<input type="hidden" name="search_year" value="<?=$search_year?>">
								<input type="hidden" name="search_month" value="<?=$search_month?>">
							</form>

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
									<td valign="bottom"></td> 
								</tr> 
							</table>
							<div style="height:2px;font-size:0px" class="bgtr"></div>
							<div style="height:2px;font-size:0px;line-height:0px;"></div>
							<!--��޴� -->

							<!--����Ʈ -->
							<style>
							.btn00 {display:inline-block;border-top:#DFDFDF solid 1px;border-left:#DFDFDF solid 1px;border-right:#DFDFDF solid 1px;border-bottom:#C0C0C0 solid 1px;}
							.btn00 a {display:inline-block;border-top:#FFFFFF solid 1px;background:#EFEFEF;padding:4px 7px 4px 7px;color:#444;font-family:dotum;font-size:11px;text-decoration:none;letter-spacing:-1px;}
							.btn00 a:hover {background:#E1E1E1;}
							.btn00 input {margin:0;cursor:pointer;border-top:#DFDFDF solid 1px;border-left:#DFDFDF solid 1px;border-right:#DFDFDF solid 1px;border-bottom:#C0C0C0 solid 1px;background:#EFEFEF;height:18px;color:#444;font-family:dotum;font-weight:bold;font-size:11px;text-decoration:none;letter-spacing:-1px;}
							.btn00 input:hover {background:#E1E1E1;}
							</style>
							<form name="dataForm" method="post">
							<input type="hidden" name="chk_data">
							<input type="hidden" name="page" value="<?=$page?>">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
								<tr>
									<td nowrap class="tdhead_center" width="3%"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()"></td>
<?
if($is_admin == "super") {
?>
									<td nowrap class="tdhead_center" width="142">������</th>
<?
}
?>
									<td nowrap class="tdhead_center" width="80">��������</td>
									<td nowrap class="tdhead_center" width="80">�ͼӿ���</td>
									<td nowrap class="tdhead_center" width="80">���޿���</td>
									<td nowrap class="tdhead_center" width="70">�ο���</td>
									<td nowrap class="tdhead_center" width="90">�����޾�</td>
									<td nowrap class="tdhead_center" width="84">4�뺸��</td>
									<td nowrap class="tdhead_center" width="80">�ҵ漼��</td>
									<td nowrap class="tdhead_center" width="">�޸�</td>
									<td nowrap class="tdhead_center" width="80">ó����Ȳ</td>
								</tr>
								<?
								// ����Ʈ ���
								for ($i=0; $row=sql_fetch_array($result); $i++) {
									//$page
									//$total_page
									//$rows
									$no = $total_count - $i - ($rows*($page-1));
									$list = $i%2;
									//����� �ڵ� / ��� / �ڵ�_���
									$code = $row['com_code'];
									$id = $row['sabun'];
									$code_id = $code."_".$id;
									// ������ : ������ڵ�
									$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$row[com_code]' ";
									$row_com = sql_fetch($sql_com);
									$com_name = $row_com['com_name'];
									$com_name = cut_str($com_name, 21, "..");
									$name = cut_str($row['name'], 6, "..");
									//����,��
									//$search_year = 2013;
									//$search_month = 11-$i;
									//���
									$year_month = $row['year']."_".$row['month'];
									//�����
									$reg_day = $row['w_date'];
									//����ڼ�
									$pay_count = $row['cnt'];
									//4�뺸�� �հ�
									$insure4_sum = (int)$row['health'] + (int)$row['yoyang'] + (int)$row['yun'] + (int)$row['goyong'];
									//�ҵ漼�� �հ�
									$tax_sum = $row['tax_so'] + $row['tax_jumin'];
									//���� ��ũ
									if($member['mb_level'] == 6) {
										$url_form = "javascript:alert_demo();";
										$url_pay_send = "javascript:alert_demo();";
										$url_pay_ledger = "javascript:alert_demo();";
									} else {
										$url_form = "javascript:printPayList('$row[year]','$row[month]');";
										$url_pay_send = "#";
										$url_pay_ledger = "pay_list.php?w=u&code=".$code."&search_year=".$row['year']."&search_month=".$row['month'];
									}
								?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$code_id?>" class="no_borer"><input type="hidden" name="codex" value="<?=$year_month?>"></td>
<?
if($is_admin == "super") {
?>
									<td nowrap class="ltrow1_center_h22"><?=$com_name?></td>
<? } ?>
									<td nowrap class="ltrow1_center_h22"><?=$reg_day?></td>
									<td nowrap class="ltrow1_center_h22"><a href="<?=$url_form?>" target=""><b><?=$row[year]?>�� <?=$row['month']?>��</b></a></td>
									<td nowrap class="ltrow1_center_h22"><?=$row['month']?>��</td>
									<td nowrap class="ltrow1_center_h22"><?=$pay_count?>��</td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row['sum_result'])?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($insure4_sum)?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($tax_sum)?></td>
									<td nowrap class="ltrow1_center_h22"><?=$memo?></td>
									<td nowrap class="ltrow1_center_h22"><?=$process?></td>
								</tr>
								</tr>
								<?
								}
								if($i == 0) {
									echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
								} else if($i == 1) {
									echo "<input type='checkbox' name='idx' value='' class='no_borer' style='display:none'><input type='hidden' name='codex' value=''>";
								}
								?>
								<tr>
									<td nowrap class="tdhead_center"></td>
<?
if($is_admin == "super") {
?>
									<td nowrap class="tdhead_center"></td>
<? } ?>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
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
<?
//���Ѻ� ��ũ��
if($member['mb_level'] == 6) {
	$url_del = "javascript:alert_demo();";
	$url_view = "javascript:alert_demo();";
} else {
	$url_del = "javascript:checked_ok();";
	$url_view = "pay_list.php";
}
?>

							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
								<tr>
									<td align="left">
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
											<tr>
												<td width=2></td>
												<td><img src=images/btn_lt.gif></td>
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_del?>" target="">���û���</a></td>
												<td><img src=images/btn_rt.gif></td>
											 <td width=2></td>
											</tr>
										</table>
										<!--<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
											<tr>
												<td width=2></td>
												<td><img src=images/btn_lt.gif></td>
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_view?>" target="">�޿��ݿ�</a></td>
												<td><img src=images/btn_rt.gif></td>
											 <td width=2></td>
											</tr>
										</table>-->
									</td>
								</tr>
							</table>
							</form>
						</td>
					</tr>
				</table>
				<? include "./inc/bottom.php";?>
			</td>
		</tr>
	</table>			
</div>
</body>
</html>
