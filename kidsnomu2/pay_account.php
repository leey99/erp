<?
$sub_menu = "400400";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$sql_common = " from tax_account_opt ";

$sql_a4 = " select com_code from com_list_gy where t_insureno = '$member[mb_id]' ";
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
//����
if (!$sst) {
	$sst = "com_code";
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
$sql = " select com_code, sabun, year, month, count(month) as cnt, sum(money_total) as sum_total, sum(money_gongje) as sum_gongje, sum(money_result) as sum_result, 
					sum(health) as sum_health, sum(yoyang) as sum_yoyang, sum(yun) as sum_yun, sum(goyong) as sum_goyong, sum(tax_so) as sum_tax_so, sum(tax_jumin) as sum_tax_jumin, w_date, wr_datetime
          $sql_common
          $sql_search group by com_code, year, month
          $sql_order 
          limit $from_record, $rows
";
//echo $sql;
$result = sql_query($sql);

$colspan = 9;
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
<script language="javascript">
// ���� �˻� Ȯ��
function del(page,id) 
{
	if(confirm("�����Ͻðڽ��ϱ�?")) {
		location.href = "4insure_delete.php?page="+page+"&id="+id;
	}
}
function goSearch()
{
	var frm = document.searchForm;
	frm.action = "<?=$PHP_SELF?>";
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
			chk_data = chk_data + ',' + frm.idx[i].value + '_' + frm.codex[i].value;
		}
	}
	if(cnt==0) {
	 alert("���õ� �����Ͱ� �����ϴ�.");
	 return;
	} else {
		if(confirm("���� �����Ͻðڽ��ϱ�?")) {
			chk_data = chk_data.substring(1, chk_data.length);
			frm.chk_data.value = chk_data;
			frm.action="pay_ledger_delete.php";
			frm.submit();
		} else {
			return;
		}
	} 
}
function printPayList(search_year, search_month, com_code) {
	frm = document.printForm;
	frm.mode.value = "salary_list";
	frm.search_year.value = search_year;
	frm.search_month.value = search_month;
	frm.code.value = com_code;
	frm.target = "_blank";
	frm.action = "pay_ledger.php";
	frm.submit();
}
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
for($i=2013;$i<=2016;$i++) {
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

							<form name="printForm" method="get" style="margin:0">
								<input type="hidden" name="mode" />
								<input type="hidden" name="code" />
								<input type="hidden" name="search_year" value="<?=$search_year?>" />
								<input type="hidden" name="search_month" value="<?=$search_month?>" />
							</form>

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
									<td nowrap class="tdhead_center" width="124">�����Ͻ�</td>
									<td nowrap class="tdhead_center" width="70">�ͼӿ���</td>
									<td nowrap class="tdhead_center" width="60">�ο�</td>
									<td nowrap class="tdhead_center" width="90">ó������</td>
									<td nowrap class="tdhead_center" width="90">÷������1</td>
									<td nowrap class="tdhead_center" width="90">÷������2</td>
									<td nowrap class="tdhead_center" width="">ó������</td>
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
	$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$code' ";
	$row_com = sql_fetch($sql_com);
	$com_name = $row_com['com_name'];
	$com_name = cut_str($com_name, 21, "..");
	$name = cut_str($row['name'], 6, "..");
	//����,��
	//$search_year = 2013;
	//$search_month = 11-$i;
	//���
	$year_month = $row['year']."_".$row['month'];
	//�����DB �ɼ�
	$sql1 = " select * from com_list_gy_opt where com_code='$code' ";
	//echo $sql1;
	$result1 = sql_query($sql1);
	$row1=mysql_fetch_array($result1);
	//�ͼӿ���
	$revert_year_month = $row['year']."-".$row['month'];
	//�����
	$reg_day = $row['w_date'];
	//��������
	$wr_datetime = $row['wr_datetime'];
	//����ڼ�
	$pay_count = $row['cnt'];
	//���� ��ũ
	if($member['mb_level'] == 6) {
		$url_form = "javascript:alert_demo();";
		$url_pay_send = "javascript:alert_demo();";
		$url_pay_ledger = "javascript:alert_demo();";
	} else {
		$url_form = "javascript:printPayList('$row[year]','$row[month]','$row[com_code]');";
		$url_pay_send = "pay_account_write.php?w=u&code=".$code."&search_year=".$row['year']."&search_month=".$row['month'];
		$url_pay_ledger = "pay_list.php?w=u&code=".$code."&search_year=".$row['year']."&search_month=".$row['month'];
	}
	//��õ���Ű� DB
	$sql_account = " select * from tax_account where comp_code='$code' and revert_year='$row[year]' and revert_month='$row[month]' ";
	//echo $sql_account;
	$row_account = sql_fetch($sql_account);
	//�߼�����
	if($row_account['send_date']) $send_date = $row_account['send_date'];
	else $send_date = "-";
	//÷������
	$filename_1 = $row_account['filename_1'];
	$filename_2 = $row_account['filename_2'];
	//ó������
	$memo_master = $row_account['memo_master'];
	//ó����Ȳ
	$conduct_code = $row_account['conduct'];
	$conduct_array = array("�����Ϸ�","ó����","ó���Ϸ�","�����","�ݷ�");
	$conduct = $conduct_array[$conduct_code];
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$code_id?>" class="no_borer"><input type="hidden" name="codex" value="<?=$year_month?>"></td>
<?
if($is_admin == "super") {
?>
									<td nowrap class="ltrow1_center_h22"><?=$com_name?></td>
<? } ?>
									<td nowrap class="ltrow1_center_h22"><?=$wr_datetime?></td>
									<td nowrap class="ltrow1_center_h22"><a href="<?=$url_form?>" target=""><b><?=$revert_year_month?></b></a></td>
									<td nowrap class="ltrow1_center_h22"><?=$pay_count?>��</td>
									<td nowrap class="ltrow1_center_h22"><?=$send_date?></td>
									<td nowrap class="ltrow1_center_h22"><? if($filename_1) { ?><a href="/kidsnomu/files/account/<?=$filename_1?>" target="_blank"><img src="images/btn_s_file.png" border="0" /></a><? } ?></td>
									<td nowrap class="ltrow1_center_h22"><? if($filename_2) { ?><a href="/kidsnomu/files/account/<?=$filename_2?>" target="_blank"><img src="images/btn_s_file.png" border="0" /></a><? } ?></td>
									<td class="ltrow1_left_h22"><?=$memo_master?></td>
									<td nowrap class="ltrow1_center_h22"><?=$conduct?></td>
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
								</tr>
							</table>

							<table width="60%" align="center" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td height="40">
										<div align="center">
											<?
											$pagelist = get_paging($config['cf_write_pages'], $page, $total_page, "?$qstr&page=");
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
//�ְ������ ǥ��
if($member['mb_level'] == 10) {
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
									</td>
								</tr>
							</table>
<?
}
?>
							</form>
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
												��������
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
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
								<tr>
									<td nowrap class="tdhead_center" width="124">�����Ͻ�</td>
									<td nowrap class="tdhead_center" width="70">�������</td>
									<td nowrap class="tdhead_center" width="90">��������</td>
									<td nowrap class="tdhead_center" width="90">�Ű�����</td>
									<td nowrap class="tdhead_center" width="90">÷������1</td>
									<td nowrap class="tdhead_center" width="90">÷������2</td>
									<td nowrap class="tdhead_center" width="">ó������</td>
									<td nowrap class="tdhead_center" width="80">ó����Ȳ</td>
								</tr>
<?
//��������
$sql_tax_adjust = " select * from tax_adjust where comp_bznb='$member[mb_id]' and result_file_2 != '' ";
$row_tax_adjust = sql_fetch($sql_tax_adjust);
$wr_datetime = $row_tax_adjust['wr_datetime'];
//�������
if($row_tax_adjust['receive_way']) {
	$receive_way_arry = array("","Ű��빫","��������","�ѽ�","��Ÿ");
	$receive_way_code = $row_tax_adjust['receive_way'];
	$receive_way = $receive_way_arry[$receive_way_code];
} else {
	$receive_way = "";
}
//�߼�����
if($row_tax_adjust['send_date']) $send_date = $row_tax_adjust['send_date'];
else $send_date = "";
//�Ű�����
if($row_tax_adjust['report_date']) $report_date = $row_tax_adjust['report_date'];
else $report_date = "";
$filename_2 = $row_tax_adjust['result_file_2'];
//ó����Ȳ
if($row_tax_adjust[conduct] == "0") $ok = "�����Ϸ�";
else if($row_tax_adjust[conduct] == "1") $ok = "ó����";
else if($row_tax_adjust[conduct] == "2") $ok = "ó���Ϸ�";
else if($row_tax_adjust[conduct] == "3") $ok = "<span style='color:red'>�����</span>";
else if($row_tax_adjust[conduct] == "4") $ok = "<span style='color:red'>�ݷ�</span>";
else if($row_tax_adjust[conduct] == "5") $ok = "<span style='color:blue'>�����Է�</span>";
else $ok = "";
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><?=$wr_datetime?></td>
									<td nowrap class="ltrow1_center_h22"><?=$receive_way?></td>
									<td nowrap class="ltrow1_center_h22"><?=$send_date?></td>
									<td nowrap class="ltrow1_center_h22"><?=$report_date?></td>
									<td nowrap class="ltrow1_center_h22"></td>
									<td nowrap class="ltrow1_center_h22"><? if($filename_2) { ?><a href="/kidsnomu/files/adjustment_result/<?=$filename_2?>" target="_blank"><img src="images/btn_s_file.png" border="0" /></a><? } ?></td>
									<td class="ltrow1_left_h22"><?=$row_tax_adjust['memo_master']?></td>
									<td nowrap class="ltrow1_center_h22"><?=$ok?></td>
								</tr>
							</table>

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
