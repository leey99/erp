<?
$sub_menu = "400200";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}
//���� �⵵
$year_now = date("Y");

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
if($row_com_opt['comp_print_type']) {
	$comp_print_type = $row_com_opt['comp_print_type'];
} else {
	$comp_print_type = "default";
}

//echo $is_admin;
if($is_admin == "super") {
	$sql_search = " where 1=1 ";
} else {
	//�ñ���
	$sql_search = " where com_code='$com_code' and pay_gbn='1' ";
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

$sql_group = " group by year, month, w_date, w_time ";

$sst0 = "  ";
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
$sst4 = ", w_date desc";
$sst5 = ", w_time desc";

$sql_order = " order by $sst0 $sst $sod $sst2 $sst3 $sst4 $sst5 ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search $sql_group
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 999;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

//ȭ��������κθ�ȸ ����� Ÿ��Ʋ ����2
if($comp_print_type == "H") {
	$sub_title2 = "(�����)";
} else {
	$sub_title2 = "(�ñ���/��Ÿ)";
}
$sub_title = "�޿�����".$sub_title2;
$g4[title] = $sub_title." : �޿����� : ".$easynomu_name;

$sql = " select com_code, sabun, year, month, dept_code, dept, count(month) as cnt, sum(money_total) as sum_total, sum(money_gongje) as sum_gongje, sum(money_result) as sum_result, w_date, w_time
          $sql_common
          $sql_search $sql_group
          $sql_order 
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$result_reg_cnt = sql_query($sql);
$colspan = 13;
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
			//alert(chk_data);
			frm.action="pay_ledger_delete.php";
			frm.submit();
		} else {
			return;
		}
	} 
}
function printPayList(search_year, search_month, w_date, w_time) {
	frm = document.printForm;
	frm.mode.value = "salary_list";
	frm.search_year.value = search_year;
	frm.search_month.value = search_month;
	frm.w_date.value = w_date;
	frm.w_time.value = w_time;
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
} else if($comp_print_type == "H") {
	include "./inc/left_menu4_type_h.php";
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
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<col width="10%">
									<col width="">
									<col width="">
									<tr>
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�޿��⵵/��</td>
										<td nowrap class="tdrow">
											<select name="search_year" class="selectfm" onChange="goSearch();">
<?
for($i=2011;$i<=2016;$i++) {
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
								<input type="hidden" name="w_date">
								<input type="hidden" name="w_time">
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
									<td nowrap class="tdhead_center" width="60">����</td>
									<td nowrap class="tdhead_center" width="40">��</td>
									<td nowrap class="tdhead_center" width="">�޿������</td>
									<td nowrap class="tdhead_center" width="80">�����</td>
<?
if($search_month) {
?>
									<td nowrap class="tdhead_center" width="60">��Ͻð�</td>

<?
} else {
?>
									<td nowrap class="tdhead_center" width="60">����Ƚ��</td>

<?
}
if($search_month) {
?>
									<td nowrap class="tdhead_center" width="70">����ڼ�</td>
<?
	//������
	if($com_code == "20284") {
?>
									<td nowrap class="tdhead_center" width="155" colspan="2">�μ���</td>
<?
	} else {
?>
									<td nowrap class="tdhead_center" width="80">���ӱݰ�</td>
									<td nowrap class="tdhead_center" width="75">�Ѱ�����</td>
<?
	}
?>
									<td nowrap class="tdhead_center" width="80">�����޾�</td>
<?
} else {
?>
									<td nowrap class="tdhead_center" width="305" colspan="4">�μ���</td>
<?
}
?>
									<td nowrap class="tdhead_center" width="80">�޿�����</td>
									<td nowrap class="tdhead_center" width="44">����</td>
									<td nowrap class="tdhead_center" width="44">����</td>
								</tr>
								<?
								//���Ƚ��
								$r_cnt = 1;
								for ($i=0; $row_reg_cnt=sql_fetch_array($result_reg_cnt); $i++) {
									$year = $row_reg_cnt['year'];
									$month = $row_reg_cnt['month'];
									//echo $year." == ".$old_year." && ".$month." == ".$old_month." &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ";
									$dept_txt = $row_reg_cnt['dept'];
									//echo $i." ".strstr($r_dept, $dept_txt);
									//echo $i.":".preg_match($dept_txt, $r_dept, $matches)." ";
									//echo $i.":".$dept_txt.":".$r_dept.":".$matches." ";
									//echo strpos($r_dept, $dept_txt);
									//echo $r_dept;
									if($year == $old_year && $month == $old_month) {
										//echo $i.":".mb_strpos($r_dept, $dept_txt, 0, "euc-kr").", ";
										//echo $month.":".$row_reg_cnt['dept'];
										if(!$r_dept) $r_dept = "";
										if($dept_txt) {
											if(!mb_strpos($r_dept, $dept_txt, 0, "euc-kr")) {
												$r_dept .= $row_reg_cnt['dept'].". ";
											}
										}
										$r_cnt++;
									} else {
										$r_cnt = 1;
										$r_dept = $row_reg_cnt['dept'].". ";
									}
									$reg_cnt_array[$year][$month] = $r_cnt;
									$reg_dept_array[$year][$month] = $r_dept;
									//echo $no." ";
									$old_year = $row_reg_cnt['year'];
									$old_month = $row_reg_cnt['month'];
								}
								// ����Ʈ ���
								for ($i=0; $row=sql_fetch_array($result); $i++) {
									$year = $row['year'];
									$month = $row['month'];
									//�ߺ� �޿����� ����
									//echo $year." != ".$old_year." && ".$month." != ".$old_month;
									if($search_month || $year != $old_year || $month != $old_month || $i == 0) {
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
										//��Ͻð�
										$reg_time = $row['w_time'];
										//����ڼ�
										$pay_count = $row['cnt'];
										//���Ƚ��
										$reg_cnt = $reg_cnt_array[$year][$month];
										//��Ϻμ�
										$reg_dept = $reg_dept_array[$year][$month];
										//echo " // ".$no;
										//���� ��ũ
										if($member['mb_profile'] == "guest") {
											$url_form = "javascript:alert_demo();";
											$url_pay_ledger = "javascript:alert_demo();";
											$url_pay_ledger_excel = "javascript:alert_demo();";
										} else {
											$url_form = "javascript:printPayList('$row[year]','$row[month]','$reg_day','$reg_time');";
											//(��)���� ������, ����� ���� 160115
											if($com_code == "20602") {
												//�μ� �ڵ�
												$dept_code = $row['dept_code'];
												if($dept_code == 1) $url_pay_ledger = "pay_white.php?w=u&code=".$code."&search_year=".$row['year']."&search_month=".$row['month']."&w_date=".$reg_day."&w_time=".$reg_time;
												if($dept_code == 2) $url_pay_ledger = "pay_blue.php?w=u&code=".$code."&search_year=".$row['year']."&search_month=".$row['month']."&w_date=".$reg_day."&w_time=".$reg_time;
												else $url_pay_ledger = "pay_white.php?w=u&code=".$code."&search_year=".$row['year']."&search_month=".$row['month']."&w_date=".$reg_day."&w_time=".$reg_time;
											} else {
												$url_pay_ledger = "pay_time_list.php?w=u&code=".$code."&search_year=".$row['year']."&search_month=".$row['month']."&w_date=".$reg_day."&w_time=".$reg_time;
											}
											//ȭ��������κθ�ȸ ����� ���� �޿����� 160107
											if($com_code == "20399") $url_pay_ledger_excel = "pay_ledger_excel_h_month.php?code=".$code."&search_year=".$row['year']."&search_month=".$row['month']."&w_date=".$reg_day."&w_time=".$reg_time;
											else if($com_code == "20602") $url_pay_ledger_excel = "pay_ledger_excel_p.php?code=".$code."&search_year=".$row['year']."&search_month=".$row['month']."&w_date=".$reg_day."&w_time=".$reg_time; //(��)����
											else $url_pay_ledger_excel = "pay_ledger_excel.php?code=".$code."&search_year=".$row['year']."&search_month=".$row['month']."&w_date=".$reg_day."&w_time=".$reg_time;
										}
										$url_pay_ledger_list = "pay_ledger_time.php?search_year=".$row['year']."&search_month=".$row['month'];
								?>
<?
if($search_month) {
	$w_gubun = "";
} else {
	//�ش� �� �޿����� ��ü����
	$w_gubun = "all";
}
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$code_id?>_<?=$year_month?>_<?=$reg_day?>_<?=$reg_time?>_<?=$w_gubun?>" class="no_borer"></td>
<?
if($is_admin == "super") {
?>
									<td nowrap class="ltrow1_center_h22"><?=$com_name?></td>
<?
}
?>
									<td nowrap class="ltrow1_center_h22"><?=$row[year]?>��</td>
									<td nowrap class="ltrow1_center_h22"><?=$row[month]?>��</td>
									<td nowrap class="ltrow1_center_h22"><a href="<?=$url_pay_ledger_list?>" target=""><b><?=$row[year]?>�� <?=$row[month]?>�� �޿�����</b></a></td>
									<td nowrap class="ltrow1_center_h22"><?=$reg_day?></td>
<?
if($search_month) {
	$w_gubun = "";
?>
									<td nowrap class="ltrow1_center_h22"><?=$reg_time?></td>
<?
} else {
	//�ش� �� �޿����� ��ü����
	$w_gubun = "all";
?>
									<td nowrap class="ltrow1_center_h22"><?=$reg_cnt?></td>
<?
}
if($search_month) {
?>
									<td nowrap class="ltrow1_center_h22"><?=$pay_count?>��</td>
<?
	//������
	if($com_code == "20284") {
?>
									<td class="ltrow1_left_h22" colspan="2">
										<?=$row[dept]?>
									</td>
<?
	} else {
?>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row[sum_total])?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row[sum_gongje])?></td>
<?
	}
?>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row[sum_result])?></td>
<?
} else {
?>
									<td class="ltrow1_left_h22" colspan="4">
										<?=$reg_dept?>
									</td>
<?
}
if($search_month) {
?>
									<td nowrap class="ltrow1_center_h22">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_form?>" target="">�޿�����</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
									</td>
									<td nowrap class="ltrow1_center_h22">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_pay_ledger_excel?>" target="">����</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
									</td>
									<td nowrap class="ltrow1_center_h22">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_pay_ledger?>" target="">����</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
									</td>
<?
} else {
?>
									<td nowrap class="ltrow1_center_h22" colspan="3">
										�� �޿������ Ŭ���Ͻʽÿ�.
									</td>
<?
}
?>
								</tr>
								</tr>
								<?
									}
									$old_year = $row['year'];
									$old_month = $row['month'];
								}
								if($i == 0) {
									echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
								} else if($i == 1) {
									echo "<input type='checkbox' name='idx' value='' class='no_borer' style='display:none'>";
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
if($member['mb_profile'] == "guest") {
	$url_del = "javascript:alert_demo();";
	$url_view = "javascript:alert_demo();";
} else {
	$url_del = "javascript:checked_ok();";
	$url_view = "pay_list.php";
}
?>

							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
								<tr>
									<td align="center">
										<a href="<?=$url_del?>" target=""><img src="images/btn_choice_big.png" border="0"></a>
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
