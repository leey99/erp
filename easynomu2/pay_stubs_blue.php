<?
$sub_menu = "400400";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

//���� �⵵
$year_now = date("Y");

//�⵵, �� ����
if(!$search_year) $search_year = date("Y");
if(!$search_month) $search_month = date("m");
//echo date("m");
$sql_common = " from pibohum_base_pay ";

//����� �⺻����
$sql_a4 = " select com_code from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4[com_code];
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

//echo $is_admin;
if($is_admin == "super") {
	$sql_search = " where 1=1 ";
} else {
	$sql_search = " where com_code='$com_code' and year='$search_year' ";
}
//$sql_search .= " and pay_gbn!='1' ";
//�繫��
if(!$stx_dept) {
	$stx_dept1 = 2;
	$stx_dept2 = 6;
	$sql_search .= " and ( dept_code >= $stx_dept1 and dept_code <= $stx_dept2 ) ";
} else {
	$sql_search .= " and ( dept_code = $stx_dept ) ";
}
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
$sql_common_sort = " from com_code_sort ";
$sql_search_sort = " where com_code = '$com_code' ";
//���� 1����
$sql1 = " select * $sql_common_sort $sql_search_sort  and code = '1' ";
$result1 = sql_query($sql1);
$row1 = mysql_fetch_array($result1);
$sort1 = $row1[item];
$sod1 = $row1[sod];
//���� 2����
$sql2 = " select * $sql_common_sort $sql_search_sort  and code = '2' ";
$result2 = sql_query($sql2);
$row2 = mysql_fetch_array($result2);
$sort2 = $row2[item];
$sod2 = $row2[sod];
//���� 3����
$sql3 = " select * $sql_common_sort $sql_search_sort  and code = '3' ";
$result3 = sql_query($sql3);
$row3 = mysql_fetch_array($result3);
$sort3 = $row3[item];
$sod3 = $row3[sod];
//���� 4����
$sql4 = " select * $sql_common_sort $sql_search_sort  and code = '4' ";
$result4 = sql_query($sql4);
$row4 = mysql_fetch_array($result4);
$sort4 = $row4[item];
$sod4 = $row4[sod];

if (!$sst) {
	if($is_admin == "super") {
		$sst = "com_code";
		$sod = "desc";
	} else {
		if($sort1) {
			if($sort1 == "in_day" || $sort1 == "name") $sst = "".$sort1;
			else $sst = "".$sort1;
			$sod = $sod1;
		} else {
			$sst = "position";
			$sod = "asc";
		}
	}
}
if (!$sst2) {
	if($sort2) {
		if($sort2 == "in_day" || $sort2 == "name") $sst2 = ", ".$sort2;
		else $sst2 = ", ".$sort2;
		$sod2 = $sod2;
	} else {
		$sst2 = ", in_day";
		$sod2 = "asc";
	}
}
if (!$sst3) {
	if($sort3) {
		if($sort3 == "in_day" || $sort3 == "name") $sst3 = ", ".$sort3;
		else $sst3 = ", ".$sort3;
		$sod3 = $sod3;
	} else {
		$sst3 = ", dept";
		$sod3 = "asc";
	}
}
if (!$sst4) {
	if($sort4) {
		if($sort4 == "in_day" || $sort4 == "name") $sst4 = ", ".$sort4;
		else $sst4 = ", ".$sort4;
		$sod4 = $sod4;
	} else {
		$sst4 = ", pay_gbn";
		$sod4 = "asc";
	}
}

$sql_order = " order by $sst $sod $sst2 $sod2 $sst3 $sod3 $sst4 $sod4 ,sabun asc ";

$sql = " select count(*) as cnt
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

$sub_title = "�޿����� : ������";
$g4[title] = $sub_title." : �޿����� : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);

$colspan = 14;

//�˻� �Ķ���� ����
$qstr = "search_year=".$search_year."&search_month=".$search_month;
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
			chk_data = chk_data + ',' + frm.idx[i].value;
		}
	}
	//alert(chk_data);
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
function printPayList(search_year, search_month) {
	frm = document.printForm;
	frm.mode.value = "salary_list";
	frm.search_year.value = search_year;
	frm.search_month.value = search_month;
	frm.target = "_blank";
	frm.action = "pay_ledger.php?code=<?=$com_code?>";
	frm.submit();
}
function month_plus() {
	f = document.searchForm;
	year_var = f.search_year.value;
	month_var = f.search_month.value;
	if(month_var == "12") {
		year_var = toInt(year_var) + 1;
		month_var = "01";
	} else {
		month_var = ""+(toInt(month_var) + 1);
		if(month_var.length == 1) {
		 month_var = "0"+month_var;
		}
	}
	if(year_var > <?=$year_now?>) {
		alert("<?=$year_now?>����� ��ȸ�� �����մϴ�.");
		return;
	}
	f.search_year.value = year_var;
	f.search_month.value = month_var;
	goSearch();
}
function month_minus() {
	f = document.searchForm;
	year_var = f.search_year.value;
	month_var = f.search_month.value;
	if(month_var == "01" || month_var == "") {
		year_var = toInt(year_var) - 1;
		month_var = "12";
	} else {
		month_var = ""+(toInt(month_var) - 1);
		if(month_var.length == 1) {
		 month_var = "0"+month_var;
		}
	}
	if(year_var == "2012") {
		alert("2013����� ��ȸ�� �����մϴ�.");
		return;
	}
	f.search_year.value = year_var;
	f.search_month.value = month_var;
	goSearch();
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
if($comp_print_type == "N") {
	include "./inc/left_menu4_type_n.php";
} else if($comp_print_type == "P") {
	include "./inc/left_menu4_type_p.php";
} else {
	include "./inc/left_menu4.php";
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
							<form name="searchForm" method="get">
								<input type="hidden" name="page" value="<?=$page?>" />
								<input type="hidden" name="stx_dept" value="<?=$stx_dept?>" />
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<col width="10%">
									<col width="">
									<col width="">
									<tr>
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�޿��⵵/��</td>
										<td nowrap class="tdrow">
											<select name="search_year" class="selectfm" onChange="goSearch();">
<?
for($i=2013;$i<=$year_now;$i++) {
?>
												<option value="<?=$i?>" <? if($i == $search_year) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
											</select> ��
											<select name="search_month" class="selectfm" onChange="goSearch();">
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
											<div style="padding:0 0 0 2px;display:inline">
												<a href="javascript:month_minus();"><img src="images/btn_del.png" align="absmiddle" border="0"></a>
												<a href="javascript:month_plus();"><img src="images/btn_add.png" align="absmiddle" border="0"></a>
											</div>
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
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
												��ü ���
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
									<td nowrap class="tdhead_center" width="60">����</td>
									<td nowrap class="tdhead_center" width="40">��</td>
									<td nowrap class="tdhead_center" width="90">�����</td>
									<td nowrap class="tdhead_center" width="70">����ڼ�</td>
									<td nowrap class="tdhead_center" width="90">��ձ⺻�ñ�</td>
									<td nowrap class="tdhead_center" width="90">������ñ�</td>
									<td nowrap class="tdhead_center" width="90">��ձ⺻����</td>
									<td nowrap class="tdhead_center" width="90">���ӱݰ�</td>
									<td nowrap class="tdhead_center" width="90">�Ѱ�����</td>
									<td nowrap class="tdhead_center" width="">�����޾�</td>
									<td nowrap class="tdhead_center" width="76">�޿�����</td>
								</tr>
								<?
								// ����Ʈ ���
								$sst2 = "year desc";
								$sst3 = ", month desc";
								$sql_order = " order by $sst2 $sst3 ";
								$sql_month = " select count(*) as cnt
												 $sql_common
												 $sql_search
												 $sql_order ";

								//echo $sql;
								$row_month = sql_fetch($sql_month);
								$total_count_month = $row_month[cnt];

								$rows = 15;
								$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

								if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
								$from_record = ($page - 1) * $rows; // ���� ���� ����

								$sql_month = " select com_code, sabun, year, month, count(month) as cnt, sum(money_total) as sum_total, sum(money_gongje) as sum_gongje, 
													sum(money_result) as sum_result, w_date, w_time, sum(money_hour_ds) as sum_money_hour_ds, sum(money_time) as sum_money_time,
													sum(money_month) as sum_money_month
													$sql_common
													$sql_search group by year, month
													$sql_order 
													limit $from_record, $rows ";
								//echo $sql_month;
								$result_month = sql_query($sql_month);
								$colspan_month = 11;

								for ($i=0; $row_month=sql_fetch_array($result_month); $i++) {
									//$page
									//$total_page
									//$rows
									$no = $total_count_month - $i - ($row_months*($page-1));
									$list = $i%2;
									//����� �ڵ� / ��� / �ڵ�_���
									$code = $row_month[com_code];
									$id = $row_month[sabun];
									$code_id = $code."_".$id;
									// ������ : ������ڵ�
									$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$row_month[com_code]' ";
									$row_month_com = sql_fetch($sql_com);
									$com_name = $row_month_com[com_name];
									$com_name = cut_str($com_name, 21, "..");
									$name = cut_str($row_month[name], 6, "..");
									//����,��
									//$search_year = 2013;
									//$search_month = 11-$i;
									//���
									$year_month = $row_month[year]."_".$row_month[month];
									//�����
									$reg_day = $row_month[w_date];
									//��Ͻð�
									$w_time = $row_month['w_time'];
									//����ڼ�
									$pay_count = $row_month[cnt];
									//���� ��ũ
									if($member['mb_profile'] == "guest") {
										$url_form = "javascript:alert_demo();";
										$url_pay_ledger = "javascript:alert_demo();";
									} else {
										$url_form = "pay_stubs_all.php?code=$code&search_year=$search_year&search_month=$search_month&w_date=$reg_day&w_time=$w_time&page=$page";
										$url_pay_ledger = "pay_list.php?w=u&code=".$code."&search_year=".$row_month[year]."&search_month=".$row_month[month];
									}
								?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><?=$row_month[year]?>��</td>
									<td nowrap class="ltrow1_center_h22"><?=$row_month[month]?>��</td>
									<td nowrap class="ltrow1_center_h22"><?=$reg_day?></td>
									<td nowrap class="ltrow1_center_h22"><?=$pay_count?>��</td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row_month[sum_money_hour_ds]/$pay_count)?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row_month[sum_money_time]/$pay_count)?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row_month[sum_money_month]/$pay_count)?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row_month[sum_total])?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row_month[sum_gongje])?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row_month[sum_result])?></td>
									<td nowrap class="ltrow1_center_h22">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_form?>" target="">��ü ���</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
									</td>
								</tr>
								</tr>
								<?
								}
								if($i == 0) {
									echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan_month' nowrap class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
								} else if($i == 1) {
									echo "<input type='checkbox' name='idx' value='' class='no_borer' style='display:none'><input type='hidden' name='codex' value=''>";
								}
								?>
							</table>
							<div style="height:10px;font-size:0px;line-height:0px;"></div>

							<!--��޴� -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
												���� ���
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
							.btn00 a {display:inline-block;border-top:#FFFFFF solid 1px;background:#EFEFEF;padding:1px 5px 1px 5px;color:#444;font-family:dotum;font-size:11px;text-decoration:none;letter-spacing:-1px;}
							.btn00 a:hover {background:#E1E1E1;}
							.btn00 input {margin:0;cursor:pointer;border-top:#DFDFDF solid 1px;border-left:#DFDFDF solid 1px;border-right:#DFDFDF solid 1px;border-bottom:#C0C0C0 solid 1px;background:#EFEFEF;height:13px;color:#444;font-family:dotum;font-weight:bold;font-size:11px;text-decoration:none;letter-spacing:-1px;}
							.btn00 input:hover {background:#E1E1E1;}
							</style>
							<form name="dataForm" method="post">
							<input type="hidden" name="chk_data">
							<input type="hidden" name="page" value="<?=$page?>">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
								<tr>
									<td nowrap class="tdhead_center" width="3%"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()"></td>
									<td nowrap class="tdhead_center" width="60">����</td>
									<td nowrap class="tdhead_center" width="40">��</td>
									<td nowrap class="tdhead_center" width="40">���</td>
									<td nowrap class="tdhead_center" width="70">�̸�</td>
									<td nowrap class="tdhead_center" width="70">ä������</td>
									<td nowrap class="tdhead_center" width="70">�޿�����</td>
									<td nowrap class="tdhead_center" width="80">����</td>
									<td nowrap class="tdhead_center" width="70">ȣ��</td>
									<td nowrap class="tdhead_center" width="60">�⺻�ñ�</td>
									<td nowrap class="tdhead_center" width="60">���ñ�</td>
									<td nowrap class="tdhead_center" width="86">�⺻����</td>
									<td nowrap class="tdhead_center" width="">�����ӱ�</td>
									<td nowrap class="tdhead_center" width="80">�޿�����</td>
								</tr>
								<?
								$result = sql_query($sql);
								// ����Ʈ ���
								for ($i=0; $row=sql_fetch_array($result); $i++) {
									//$page
									//$total_page
									//$rows

									$no = $total_count - $i - ($rows*($page-1));
									$list = $i%2;
									// ������ : ������ڵ�
									$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$row[com_code]' ";
									$row_com = sql_fetch($sql_com);
									$com_name = $row_com[com_name];
									$com_name = cut_str($com_name, 21, "..");
									$name = cut_str($row[name], 6, "..");

									//������� �߰� DB
									$sql2 = " select * from pibohum_base_opt where com_code='$row[com_code]' and sabun='$row[sabun]' ";
									$result2 = sql_query($sql2);
									$row2=mysql_fetch_array($result2);

									//ä������
									$work_form = $row[work_form];

									//�޿�����
									if($row[pay_gbn] == 0) $pay_gbn = "������";
									else if($row[pay_gbn] == 1) $pay_gbn = "�ñ���";
									else if($row[pay_gbn] == 2) $pay_gbn = "���ձٹ�";
									else if($row[pay_gbn] == 3) $pay_gbn = "������";
									else $pay_gbn = "-";

									//����
									$sql_position = " select * from com_code_list where com_code = '$row[com_code]' and code='$row2[position]' and item='position' ";
									$result_position = sql_query($sql_position);
									$row_position=mysql_fetch_array($result_position);
									//echo $row_position[name];
									if($row_position[name]) $position_name = $row_position[name];
									else $position_name = "-";

									//ȣ��
									$sql_step = " select * from com_code_list where com_code = '$row[com_code]' and code='$row2[step]' and item='step' ";
									$result_step = sql_query($sql_step);
									$row_step=mysql_fetch_array($result_step);
									if($row_step[name]) $step_name = $row_step[name];
									else $step_name = "-";

									//������� �޿� DB
									$sql_pay = " select * from pibohum_base_pay where com_code='$row[com_code]' and sabun='$row[sabun]' and year='$row[year]' and month='$row[month]' ";
									//echo $sql_pay;
									$result_pay = sql_query($sql_pay);
									$row_pay=mysql_fetch_array($result_pay);

									//���� ��ũ
									if($member['mb_profile'] == "guest") {
										$url_form = "javascript:alert_demo();";
									} else {
										$url_form = "pay_stubs.php?id=$row[sabun]&code=$row[com_code]&search_year=$row[year]&search_month=$row[month]&page=$page";
									}

								?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$code_id?>_<?=$year_month?>" class="no_borer"></td>
									<td nowrap class="ltrow1_center_h22"><?=$row[year]?>��</td>
									<td nowrap class="ltrow1_center_h22"><?=$row[month]?>��</td>
									<td nowrap class="ltrow1_center_h22"><?=$row[sabun]?></td>
									<td nowrap class="ltrow1_center_h22"><a href="pay_view.php?id=<?=$row[sabun]?>&code=<?=$row[com_code]?>&page=<?=$page?>"><b><?=$name?></b></a></td>
									<td nowrap class="ltrow1_center_h22"><?=$work_form?></td>
									<td nowrap class="ltrow1_center_h22"><?=$pay_gbn?></td>
									<td nowrap class="ltrow1_center_h22"><?=$position_name?></td>
									<td nowrap class="ltrow1_center_h22"><?=$step_name?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row_pay[money_hour_ds])?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row_pay[money_time])?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row_pay[money_month])?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row_pay[money_total])?></td>
									<td nowrap class="ltrow1_center_h22"><span class="btn00"><a href="<?=$url_form?>">�޿�����</a></span></td>
								</tr>
								<?
								}
								if ($i == 0)
										echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
								?>
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
if($member['mb_profile'] == "guest") {
	$url_del = "javascript:alert_demo();";
	$url_view = "javascript:alert_demo();";
} else {
	$url_del = "javascript:checked_ok();";
	$url_view = "pay_list.php";
}
?>

							<!--<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
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
							</table>-->
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
