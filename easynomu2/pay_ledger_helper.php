<?
$sub_menu = "400100";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$sql_common = " from pibohum_base_pay_helper ";

$sql_a4 = " select * from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4[com_code];

$sql_a4_opt = " select * from com_list_gy_opt where com_code = '$com_code' ";
$row_a4_opt = sql_fetch($sql_a4_opt);
//����� Ÿ��
$comp_print_type = $row_a4_opt[comp_print_type];
//���� KŸ�� ����
if(!$comp_print_type) $comp_print_type = "K";

$sub_title = "�޿�����";
$g4[title] = $sub_title." : ������� : ".$easynomu_name;

$colspan = 11;

//�⵵, �� ����
if(!$search_year) $search_year = date("Y");
if(!$search_month) $search_month = date("m");

//����
$sql_common_sort = " from com_code_sort ";
$sql_search_sort = " where com_code = '$com_code' ";
//���� 1����
$sql1 = " select * $sql_common_sort $sql_search_sort  and code = '1' ";
//echo $sql1;
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
		$sst = ", com_code";
		$sod = "desc";
	} else {
		//echo $sort1;
		if($sort1) {
			if($sort1 == "in_day" || $sort1 == "name") $sst = ", ".$sort1;
			else $sst = ", ".$sort1;
			$sod = $sod1;
		} else {
			$sst = ", position";
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
$sst5 = ", name";
$sod5 = "asc";
//������ ������ �ñ��� ���� -> �޿����� ���� ���� 150210
//$sst0 = " w_date desc, w_time desc, field(pay_gbn, 0,3,2,1) ";
//$sst0 = " w_date desc, w_time desc ";
$sst0 = " com_code asc ";

//�޿����� �����Ͻ�
if($dept_code) {
	if($dept_code == 2) $dept_code_sql = " and ( dept_code >= 2 and dept_code <= 6 ) ";
	else $dept_code_sql = " and dept_code = '$dept_code' ";
} else {
	$dept_code_sql = "";
}
//�����Ͻ� ���� 150630
/*
if($w_date) {
	$w_date_sql = " and w_date = '$w_date' and w_time = '$w_time' $dept_code_sql ";
}
*/
//�޿�����
//$sql_search = " where com_code='$com_code' and year = '$search_year' and month = '$search_month' and money_result != 0 $w_date_sql ";
//�޿� 0�� Ȱ�������� ��� ����
$sql_search = " where com_code='$com_code' and year = '$search_year' and month = '$search_month' $w_date_sql ";
$sql_order = " order by $sst0 $sst $sod $sst2 $sod2 $sst3 $sod3 $sst4 $sod4 $sst5 $sod5 ";
$from_record = 0;
//$rows = 7;

//�ֱ� �޿�DB ����
$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
$row = sql_fetch($sql);
$w_date = $row['w_date'];
$w_time = $row['w_time'];

//�޿����� �ٷ��ڼ�
$sql = " select count(*) as cnt
          $sql_common
          $sql_search ";
//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];
//echo $total_count;
$rows = $total_count;
$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
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
function back_url() {
	location.href = "pay_list.php?search_year=<?=$search_year?>&search_month=<?=$search_month?>";
}
function month_plus() {
	f = document.HwpControl;
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
	if(year_var > "2015") {
		alert("2015����� ��ȸ�� �����մϴ�.");
		return;
	}
	f.search_year.value = year_var;
	f.search_month.value = month_var;
	//goSearch();
}
function month_minus() {
	f = document.HwpControl;
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
	if(year_var < "2013") {
		alert("2013����� ��ȸ�� �����մϴ�.");
		return;
	}
	f.search_year.value = year_var;
	f.search_month.value = month_var;
	//goSearch();
}
</script>
<script type="text/javascript">
//<![CDATA[
var mbrclick= false;
var rooturl = '<?=$rooturl?>';
var rootssl = '<?=$rootssl?>';
var raccount= 'home';
var moduleid= 'home';
var memberid= 'master';
var is_admin= '0';
var needlog = '�α����Ŀ� �̿��Ͻ� �� �ֽ��ϴ�. ';
var neednum = '���ڸ� �Է��� �ּ���.';
var myagent	= navigator.appName.indexOf('Explorer') != -1 ? 'ie' : 'ns';
//]]>
</script>
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>

<div id="">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
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

							<div id="rcontent" class="center m_side">
								<form name = "HwpControl" id="HwpControl" method="post" action="<?=$PHP_SELF?>">
									<!--<input type="hidden" name="w_date" value="<?=$w_date?>">
									<input type="hidden" name="w_time" value="<?=$w_time?>">-->
									<input type="hidden" name="dept_code" value="<?=$dept_code?>">
									<table border="0">
										<tr>
											<td>
												<div style="padding:2px">
													<input type="button" name="history_back_bt" value="â�ݱ�" onclick="window.close()" /> 
												</div>
											</td>
											<td>
												<div id="year_month">
													<select name="search_year">
<?
for($i=2013;$i<=2015;$i++) {
?>
														<option value="<?=$i?>" <? if($i == $search_year) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
													</select>��
													<select name="search_month">
<?
for($i=1;$i<13;$i++) {
	if($i < 10) $month = "0".$i;
	else $month = $i;
?>
														<option value="<?=$month?>" <? if($i == $search_month) echo "selected"; ?> ><?=$month?></option>
<?
}
?>


													</select>��
													<div style="padding:0 0 0 2px;display:inline">
														<a href="javascript:month_minus();"><img src="images/btn_del.png" align="absmiddle" border="0"></a>
														<a href="javascript:month_plus();"><img src="images/btn_add.png" align="absmiddle" border="0"></a>
													</div>
													<input type="submit" value="��ȸ" class="btnblue" />
												</div>
											</td>
											<td>
												������ : <?=$row_a4['com_name']?> / ����ڵ�Ϲ�ȣ : <?=$row_a4['biz_no']?>
<?
if($dept_code) {
	if($dept_code == 1) echo " / �μ� : �繫��";
	else if($dept_code == 7) echo " / �μ� : �繫��(����)";
	else if($dept_code == 8) echo " / �μ� : ������(����)";
	else echo " / �μ� : ������";
}
echo " / ����� : ".$total_count."��";
?>
											</td>
										</tr>
									</table>
									<!--�޿�����-->
									<input type="hidden" name="comp_type" value="<?=$comp_print_type?>"/>
									<input type="hidden" name="company" value="<?=$row_a4[com_name]?>"/>
									<input type="hidden" name="pay_year" value="<?=$search_year?>"/>
									<input type="hidden" name="pay_month" value="<?=$search_month?>"/>

									<!--�ݺ� ���� �迭 ó��-->
									<input type="hidden" name="no" value=" "/>
									<input type="hidden" name="pay_name" value=" "/>
									<input type="hidden" name="jdate" value=" "/>
									<input type="hidden" name="ssnb" value=" "/>

									<input type="hidden" name="w_1" value=" "/>
									<input type="hidden" name="w_2" value=" "/>
									<input type="hidden" name="w_3" value=" "/>
									<input type="hidden" name="w_1_hday" value=" "/>
									<input type="hidden" name="w_2_hday" value=" "/>
									<input type="hidden" name="w_3_hday" value=" "/>
									<input type="hidden" name="w_edu" value=" "/>
									<input type="hidden" name="w_phone" value=" "/>
									<input type="hidden" name="w_sum" value=" "/>

									<input type="hidden" name="money_time_low" value=" "/>
									<input type="hidden" name="money_time" value=" "/>
									<input type="hidden" name="money_month" value=" "/>

									<input type="hidden" name="annual_paid_holiday" value=" "/>

									<input type="hidden" name="etc" value=" "/>
									<input type="hidden" name="etc2" value=" "/>

									<input type="hidden" name="tax_so" value=" "/>
									<input type="hidden" name="tax_jumin" value=" "/>
									<input type="hidden" name="advance_pay" value=" "/>
									<input type="hidden" name="health" value=" "/>
									<input type="hidden" name="yoyang" value=" "/>
									<input type="hidden" name="yun" value=" "/>
									<input type="hidden" name="goyong" value=" "/>
									<input type="hidden" name="end_pay" value=" "/>
									<input type="hidden" name="minus" value=" "/>
									<input type="hidden" name="minus2" value=" "/>
									<input type="hidden" name="m_sum" value=" "/>

									<input type="hidden" name="money_total" value=" "/>
									<input type="hidden" name="money_for_tax" value=" "/>
									<input type="hidden" name="money_result" value=" "/>

<?
// ����Ʈ ���
if($comp_print_type == "E" || $comp_print_type == "G") {
	$pay_worker_count = 10;
} else if($comp_print_type == "H") {
	$pay_worker_count = 15;
	if($rows == 135) $row_add = 1;
	else $row_add = 0;
	//echo "<script>alert('".$row_add."');</script>";
} else {
	$pay_worker_count = 15;
}
$pay_page = ceil($rows / $pay_worker_count) + $row_add;
//����� Ÿ�Կ� ���� �ڹٽ�ũ��Ʈ ȣ��
//echo $comp_print_type;
if($comp_print_type == "H") {
	$pay_ledger_js = "pay_ledger_h";
} else if($comp_print_type == "G") {
	$pay_ledger_js = "pay_ledger_g";
} else {
	$pay_ledger_js = "pay_ledger_beistand";
}
//Ư�� ����� : �׿���
//echo $member['mb_id'];
if($member['mb_id'] == "513-16-98675") {
	$pay_ledger_js = "pay_ledger_z";
}
//echo $pay_page;
for($i=1;$i<=$pay_page;$i++) {
	$w_day_sum[$i] = 0;
}
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//���
	$memo1 = $row['memo1'];
	$memo2 = $row['memo2'];
	//������ ������ ����ó��
	if(!$row['in_day']) $row['in_day'] = "-";
	if(!$row['out_day']) $row['out_day'] = "-";
	if(!$row['position_txt']) $row['position_txt'] = "-";
	if(!$row['step_txt']) $row['step_txt'] = "-";
	if(!$row['work_form']) $row['work_form'] = "-";
	if(!$row['dept']) $row['dept'] = "-";
	if($row['pay_gbn'] == "") {
		$pay_gbn = "-";
	} else {
		if($row['pay_gbn'] == 0) $pay_gbn = "������";
		else if($row['pay_gbn'] == 1) $pay_gbn = "�ñ���";
		else if($row['pay_gbn'] == 2) $pay_gbn = "���ձٹ�";
		else if($row['pay_gbn'] == 3) $pay_gbn = "������";
		else $pay_gbn = "-";
	}
	//���ؽñ� (�ñ���)
	/*
	if($row[pay_gbn] == 1) $money_time_low = $row[money_hour_ds];
	else $money_time_low = 4860; //�����ӱ�
	*/
	if($comp_print_type == "K") {
		$money_time_low = $row['money_min_base'];
	} else {
		$money_time_low = $row['money_hour_ds'];
	}
	if($row['annual_paid_holiday'] == "") $row['annual_paid_holiday'] = 0;

	$w_sum = $row['workhour_total'];

	if($comp_print_type == "D") {
		$m_sum = $row['tax_so'] + $row['tax_jumin'] + $row['advance_pay'] + $row['health'] + $row['yoyang'] + $row['yun'] + $row['goyong'] + $row['end_pay'] + $row['minus'] + $row['minus2']+$row['etc'];;
	} else {
		$m_sum = $row['tax_so'] + $row['tax_jumin'] + $row['advance_pay'] + $row['health'] + $row['yoyang'] + $row['yun'] + $row['goyong'] + $row['end_pay'] + $row['minus'] + $row['minus2'];
	}
	$money_total = $row['money_month'] + $row['ext'];

	//6�� 1�������� (E type : 10��)
	$p = ceil(($i+1)/$pay_worker_count);
	//echo $w_day_sum[$p];
	$w_1_sum[$p] = $w_1_sum[$p] + $row['w_1'];
	$w_2_sum[$p] = $w_2_sum[$p] + $row['w_2'];
	$w_3_sum[$p] = $w_3_sum[$p] + $row['w_3'];
	$w_1_hday_sum[$p] = $w_1_hday_sum[$p] + $row['w_1_hday'];
	$w_2_hday_sum[$p] = $w_2_hday_sum[$p] + $row['w_2_hday'];
	$w_3_hday_sum[$p] = $w_3_hday_sum[$p] + $row['w_3_hday'];
	$w_edu_sum[$p] = $w_edu_sum[$p] + $row['w_edu'];
	$w_phone_sum[$p] = $w_phone_sum[$p] + $row['w_phone'];
	$w_sum_sum[$p] = $w_sum_sum[$p] + $w_sum;

	$money_time_low_sum[$p] = $money_time_low_sum[$p] + $money_time_low;
	$money_time_sum[$p] = $money_time_sum[$p] + $row['money_time'];
	$money_month_sum[$p] = $money_month_sum[$p] + $row['money_month'];

	$annual_paid_holiday_sum[$p] = $annual_paid_holiday_sum[$p] + $row['annual_paid_holiday'];

	$etc_sum[$p] = $etc_sum[$p] + $row['etc'];
	$etc2_sum[$p] = $etc2_sum[$p] + $row['etc2'];

	$tax_so_sum[$p] = $tax_so_sum[$p] + $row['tax_so'];
	$tax_jumin_sum[$p] = $tax_jumin_sum[$p] + $row['tax_jumin'];
	$advance_pay_sum[$p] = $advance_pay_sum[$p] + $row['advance_pay'];
	$health_sum[$p] = $health_sum[$p] + $row['health'];
	$yoyang_sum[$p] = $yoyang_sum[$p] + $row['yoyang'];
	$yun_sum[$p] = $yun_sum[$p] + $row['yun'];
	$goyong_sum[$p] = $goyong_sum[$p] + $row['goyong'];
	$end_pay_sum[$p] = $end_pay_sum[$p] + $row['end_pay'];
	$minus_sum[$p] = $minus_sum[$p] + $row['minus'];
	$minus2_sum[$p] = $minus2_sum[$p] + $row['minus2'];
	$m_sum_sum[$p] = $m_sum_sum[$p] + $m_sum;

	$money_total_sum[$p] = $money_total_sum[$p] + $row['money_total'];
	$money_for_tax_sum[$p] = $money_for_tax_sum[$p] + $row['money_for_tax'];
	$money_result_sum[$p] = $money_result_sum[$p] + $row['money_result'];

	//�ֹε�Ϲ�ȣ 7�ڸ������� ǥ��
	$sql_sabun = " select * from pibohum_base where com_code='$row[com_code]' and sabun='$row[sabun]' ";
	//echo $sql_sabun;
	$result_sabun = sql_query($sql_sabun);
	$row_sabun = mysql_fetch_array($result_sabun);
	if($row_sabun['jumin_no']) {
		$ssnb_txt = $row_sabun['jumin_no'];
		//$ssnb_txt_len = strlen($ssnb_txt);
		//if($ssnb_txt_len > 8) $ssnb_txt = cut_str($ssnb_txt, 8, "******");
	} else {
		$ssnb_txt = " ";
	}
?>
									<input type="hidden" name="no" value="<?=$i+1?>"/>
									<input type="hidden" name="pay_name" value="<?=$row['name']?>"/>
									<input type="hidden" name="jdate" value="<?=$row['in_day']?>"/>
									<input type="hidden" name="ssnb" value="<?=$ssnb_txt?>"/>

									<input type="hidden" name="w_1" value="<?=$row['w_1']?>"/>
									<input type="hidden" name="w_2" value="<?=$row['w_2']?>"/>
									<input type="hidden" name="w_3" value="<?=$row['w_3']?>"/>
									<input type="hidden" name="w_1_hday" value="<?=$row['w_1_hday']?>"/>
									<input type="hidden" name="w_2_hday" value="<?=$row['w_2_hday']?>"/>
									<input type="hidden" name="w_3_hday" value="<?=$row['w_3_hday']?>"/>
									<input type="hidden" name="w_edu" value="<?=$row['w_edu']?>"/>
									<input type="hidden" name="w_phone" value="<?=$row['w_phone']?>"/>
									<input type="hidden" name="w_sum" value="<?=$w_sum?>"/>
<?
	if($comp_print_type == "K") {
?>
									<input type="hidden" name="money_time_low" value="<?=number_format($row['money_min_base'])?>"/>
<? } else { ?>
									<input type="hidden" name="money_time_low" value="<?=number_format($money_time_low)?>"/>
<? } ?>
									<input type="hidden" name="money_time" value="<?=number_format($row['money_time'])?>"/>
									<input type="hidden" name="money_day" value="<?=number_format($row['money_day'])?>"/>
									<input type="hidden" name="money_month" value="<?=number_format($row['money_month'])?>"/>

									<input type="hidden" name="annual_paid_holiday" value="<?=number_format($row['annual_paid_holiday'])?>"/>

									<input type="hidden" name="etc" value="<?=number_format($row['etc'])?>"/>
									<input type="hidden" name="etc2" value="<?=number_format($row['etc2']*(-1))?>"/>

									<input type="hidden" name="tax_so" value="<?=number_format($row['tax_so'])?>"/>
									<input type="hidden" name="tax_jumin" value="<?=number_format($row['tax_jumin'])?>"/>
									<input type="hidden" name="advance_pay" value="<?=number_format($row['advance_pay'])?>"/>
									<input type="hidden" name="health" value="<?=number_format($row['health'])?>"/>
									<input type="hidden" name="yoyang" value="<?=number_format($row['yoyang'])?>"/>
									<input type="hidden" name="yun" value="<?=number_format($row['yun'])?>"/>
									<input type="hidden" name="goyong" value="<?=number_format($row['goyong'])?>"/>
									<input type="hidden" name="end_pay" value="<?=number_format($row['end_pay'])?>"/>
									<input type="hidden" name="minus" value="<?=number_format($row['minus'])?>"/>
									<input type="hidden" name="minus2" value="<?=number_format($row['minus2'])?>"/>
									<input type="hidden" name="m_sum" value="<?=number_format($m_sum)?>"/>

									<input type="hidden" name="money_total" value="<?=number_format($row['money_total'])?>"/>
									<input type="hidden" name="money_for_tax" value="<?=number_format($row['money_for_tax'])?>"/>
									<input type="hidden" name="money_result" value="<?=number_format($row['money_result'])?>"/>
<?
}
//echo $i;
if($i == 0) alert("�ش� ����� �޿������� �������� �ʽ��ϴ�.");
?>
									<input type="hidden" name="pay_count" value="<?=$i?>"/>
									<input type="hidden" name="pay_page" value="<?=$pay_page?>"/>
<?
//���� ��� hwp control ����
$tr_count = $pay_page * $pay_worker_count;
$k_limit = $tr_count - $i;
for($k=0;$k<$k_limit;$k++) {
?>
									<input type="hidden" name="no" value=" "/>
									<input type="hidden" name="pay_name" value=" "/>
									<input type="hidden" name="jdate" value=" "/>
									<input type="hidden" name="ssnb" value=" "/>

									<input type="hidden" name="w_1" value=" "/>
									<input type="hidden" name="w_2" value=" "/>
									<input type="hidden" name="w_3" value=" "/>
									<input type="hidden" name="w_1_hday" value=" "/>
									<input type="hidden" name="w_2_hday" value=" "/>
									<input type="hidden" name="w_3_hday" value=" "/>
									<input type="hidden" name="w_edu" value=" "/>
									<input type="hidden" name="w_phone" value=" "/>
									<input type="hidden" name="w_sum" value=" "/>

									<input type="hidden" name="money_time_low" value=" "/>
									<input type="hidden" name="money_time" value=" "/>
									<input type="hidden" name="money_month" value=" "/>

									<input type="hidden" name="annual_paid_holiday" value=" "/>

									<input type="hidden" name="etc" value=" "/>
									<input type="hidden" name="etc2" value=" "/>

									<input type="hidden" name="tax_so" value=" "/>
									<input type="hidden" name="tax_jumin" value=" "/>
									<input type="hidden" name="advance_pay" value=" "/>
									<input type="hidden" name="health" value=" "/>
									<input type="hidden" name="yoyang" value=" "/>
									<input type="hidden" name="yun" value=" "/>
									<input type="hidden" name="goyong" value=" "/>
									<input type="hidden" name="end_pay" value=" "/>
									<input type="hidden" name="minus" value=" "/>
									<input type="hidden" name="minus2" value=" "/>
									<input type="hidden" name="m_sum" value=" "/>

									<input type="hidden" name="money_total" value=" "/>
									<input type="hidden" name="money_for_tax" value=" "/>
									<input type="hidden" name="money_result" value=" "/>
<?
}
?>

<?
for($i=1;$i<=$pay_page;$i++) {
?>
									<input type="hidden" name="w_1_sum" value="<?=number_format($w_1_sum[$i],2)?>"/>
									<input type="hidden" name="w_2_sum" value="<?=number_format($w_2_sum[$i],2)?>"/>
									<input type="hidden" name="w_3_sum" value="<?=number_format($w_3_sum[$i],2)?>"/>
									<input type="hidden" name="w_1_hday_sum" value="<?=number_format($w_1_hday_sum[$i],2)?>"/>
									<input type="hidden" name="w_2_hday_sum" value="<?=number_format($w_2_hday_sum[$i],2)?>"/>
									<input type="hidden" name="w_3_hday_sum" value="<?=number_format($w_3_hday_sum[$i],2)?>"/>
									<input type="hidden" name="w_edu_sum" value="<?=number_format($w_edu_sum[$i],2)?>"/>
									<input type="hidden" name="w_phone_sum" value="<?=number_format($w_phone_sum[$i],2)?>"/>
									<input type="hidden" name="w_sum_sum" value="<?=number_format($w_sum_sum[$i],2)?>"/>

									<input type="hidden" name="money_time_low_sum" value="<?=number_format($money_time_low_sum[$i])?>"/>
									<input type="hidden" name="money_time_sum" value="<?=number_format($money_time_sum[$i])?>"/>
									<input type="hidden" name="money_month_sum" value="<?=number_format($money_month_sum[$i])?>"/>

									<input type="hidden" name="annual_paid_holiday_sum" value="<?=number_format($annual_paid_holiday_sum[$i])?>"/>

									<input type="hidden" name="etc_sum" value="<?=number_format($etc_sum[$i])?>"/>
									<input type="hidden" name="etc2_sum" value="<?=number_format($etc2_sum[$i]*(-1))?>"/>

									<input type="hidden" name="tax_so_sum" value="<?=number_format($tax_so_sum[$i])?>"/>
									<input type="hidden" name="tax_jumin_sum" value="<?=number_format($tax_jumin_sum[$i])?>"/>
									<input type="hidden" name="advance_pay_sum" value="<?=number_format($advance_pay_sum[$i])?>"/>
									<input type="hidden" name="health_sum" value="<?=number_format($health_sum[$i])?>"/>
									<input type="hidden" name="yoyang_sum" value="<?=number_format($yoyang_sum[$i])?>"/>
									<input type="hidden" name="yun_sum" value="<?=number_format($yun_sum[$i])?>"/>
									<input type="hidden" name="goyong_sum" value="<?=number_format($goyong_sum[$i])?>"/>
									<input type="hidden" name="end_pay_sum" value="<?=number_format($end_pay_sum[$i])?>"/>
									<input type="hidden" name="minus_sum" value="<?=number_format($minus_sum[$i])?>"/>
									<input type="hidden" name="minus2_sum" value="<?=number_format($minus2_sum[$i])?>"/>
									<input type="hidden" name="m_sum_sum" value="<?=number_format($m_sum_sum[$i])?>"/>

									<input type="hidden" name="money_total_sum" value="<?=number_format($money_total_sum[$i])?>"/>
									<input type="hidden" name="money_for_tax_sum" value="<?=number_format($money_for_tax_sum[$i])?>"/>
									<input type="hidden" name="money_result_sum" value="<?=number_format($money_result_sum[$i])?>"/>
<?
	//�Ѱ� ���
	$w_1_sum_t += $w_1_sum[$i];
	$w_2_sum_t += $w_2_sum[$i];
	$w_3_sum_t += $w_3_sum[$i];
	$w_1_hday_sum_t += $w_1_hday_sum[$i];
	$w_2_hday_sum_t += $w_2_hday_sum[$i];
	$w_3_hday_sum_t += $w_3_hday_sum[$i];
	$w_edu_sum_t += $w_edu_sum[$i];
	$w_phone_sum_t += $w_phone_sum[$i];
	$w_sum_sum_t += $w_sum_sum[$i];

	$money_time_low_sum_t += $money_time_low_sum[$i];
	$money_time_sum_t += $money_time_sum[$i];
	$money_month_sum_t += $money_month_sum[$i];

	$annual_paid_holiday_sum_t += $annual_paid_holiday_sum[$i];

	$etc_sum_t += $etc_sum[$i];
	$etc2_sum_t += $etc2_sum[$i];

	$tax_so_sum_t += $tax_so_sum[$i];
	$tax_jumin_sum_t += $tax_jumin_sum[$i];
	$advance_pay_sum_t += $advance_pay_sum[$i];
	$health_sum_t += $health_sum[$i];
	$yoyang_sum_t += $yoyang_sum[$i];
	$yun_sum_t += $yun_sum[$i];
	$goyong_sum_t += $goyong_sum[$i];
	$end_pay_sum_t += $end_pay_sum[$i];
	$minus_sum_t += $minus_sum[$i];
	$minus2_sum_t += $minus2_sum[$i];
	$m_sum_sum_t += $m_sum_sum[$i];
	$money_total_sum_t += $money_total_sum[$i];
	$money_for_tax_sum_t += $money_for_tax_sum[$i];
	$money_result_sum_t += $money_result_sum[$i];
}
?>
									<!-- �迭�� -->
									<input type="hidden" name="w_1_sum" value=""/>
									<input type="hidden" name="w_2_sum" value=""/>
									<input type="hidden" name="w_3_sum" value=""/>
									<input type="hidden" name="w_1_hday_sum" value=""/>
									<input type="hidden" name="w_2_hday_sum" value=""/>
									<input type="hidden" name="w_3_hday_sum" value=""/>
									<input type="hidden" name="w_edu_sum" value=""/>
									<input type="hidden" name="w_phone_sum" value=""/>
									<input type="hidden" name="w_sum_sum" value=""/>

									<input type="hidden" name="money_time_low_sum" value=""/>
									<input type="hidden" name="money_time_sum" value=""/>
									<input type="hidden" name="money_month_sum" value=""/>

									<input type="hidden" name="annual_paid_holiday_sum" value=""/>

									<input type="hidden" name="etc_sum" value=""/>
									<input type="hidden" name="etc2_sum" value=""/>

									<input type="hidden" name="tax_so_sum" value=""/>
									<input type="hidden" name="tax_jumin_sum" value=""/>
									<input type="hidden" name="advance_pay_sum" value=""/>
									<input type="hidden" name="health_sum" value=""/>
									<input type="hidden" name="yoyang_sum" value=""/>
									<input type="hidden" name="yun_sum" value=""/>
									<input type="hidden" name="goyong_sum" value=""/>
									<input type="hidden" name="end_pay_sum" value=""/>
									<input type="hidden" name="minus_sum" value=""/>
									<input type="hidden" name="minus_sum2" value=""/>
									<input type="hidden" name="m_sum_sum" value=""/>

									<input type="hidden" name="money_total_sum" value=""/>
									<input type="hidden" name="money_for_tax_sum" value=""/>
									<input type="hidden" name="money_result_sum" value=""/>

									<!-- �Ѱ� -->
									<input type="hidden" name="w_1_sum_t" value="<?=number_format($w_1_sum_t,2)?>"/>
									<input type="hidden" name="w_2_sum_t" value="<?=number_format($w_2_sum_t,2)?>"/>
									<input type="hidden" name="w_3_sum_t" value="<?=number_format($w_3_sum_t,2)?>"/>
									<input type="hidden" name="w_1_hday_sum_t" value="<?=number_format($w_1_hday_sum_t,2)?>"/>
									<input type="hidden" name="w_2_hday_sum_t" value="<?=number_format($w_2_hday_sum_t,2)?>"/>
									<input type="hidden" name="w_3_hday_sum_t" value="<?=number_format($w_3_hday_sum_t,2)?>"/>
									<input type="hidden" name="w_edu_sum_t" value="<?=number_format($w_edu_sum_t,2)?>"/>
									<input type="hidden" name="w_phone_sum_t" value="<?=number_format($w_phone_sum_t,2)?>"/>
									<input type="hidden" name="w_sum_sum_t" value="<?=number_format($w_sum_sum_t,2)?>"/>

									<input type="hidden" name="money_time_low_sum_t" value="<?=number_format($money_time_low_sum_t)?>"/>
									<input type="hidden" name="money_time_sum_t" value="<?=number_format($money_time_sum_t)?>"/>
									<input type="hidden" name="money_month_sum_t" value="<?=number_format($money_month_sum_t)?>"/>

									<input type="hidden" name="annual_paid_holiday_sum_t" value="<?=number_format($annual_paid_holiday_sum_t)?>"/>

									<input type="hidden" name="etc_sum_t" value="<?=number_format($etc_sum_t)?>"/>
									<input type="hidden" name="etc2_sum_t" value="<?=number_format($etc2_sum_t*(-1))?>"/>

									<input type="hidden" name="tax_so_sum_t" value="<?=number_format($tax_so_sum_t)?>"/>
									<input type="hidden" name="tax_jumin_sum_t" value="<?=number_format($tax_jumin_sum_t)?>"/>
									<input type="hidden" name="advance_pay_sum_t" value="<?=number_format($advance_pay_sum_t)?>"/>
									<input type="hidden" name="health_sum_t" value="<?=number_format($health_sum_t)?>"/>
									<input type="hidden" name="yoyang_sum_t" value="<?=number_format($yoyang_sum_t)?>"/>
									<input type="hidden" name="yun_sum_t" value="<?=number_format($yun_sum_t)?>"/>
									<input type="hidden" name="goyong_sum_t" value="<?=number_format($goyong_sum_t)?>"/>
									<input type="hidden" name="end_pay_sum_t" value="<?=number_format($end_pay_sum_t)?>"/>
									<input type="hidden" name="minus_sum_t" value="<?=number_format($minus_sum_t)?>"/>
									<input type="hidden" name="minus2_sum_t" value="<?=number_format($minus2_sum_t)?>"/>
									<input type="hidden" name="m_sum_sum_t" value="<?=number_format($m_sum_sum_t)?>"/>

									<input type="hidden" name="money_total_sum_t" value="<?=number_format($money_total_sum_t)?>"/>
									<input type="hidden" name="money_for_tax_sum_t" value="<?=number_format($money_for_tax_sum_t)?>"/>
									<input type="hidden" name="money_result_sum_t" value="<?=number_format($money_result_sum_t)?>"/>

									<input type="hidden" name="memo1" value="<?=$memo1?>"/>
									<input type="hidden" name="memo2" value="<?=$memo2?>"/>
									<!-- �ѱ� ��Ʈ�� �� -->
									<p style="margin-top:20px;z-index:-1;border:1px solid #ccc;width:">
										<object id="HwpCtrl" width="100%" height="860" align="center" classid="CLSID:BD9C32DE-3155-4691-8972-097D53B10052"></object>
									</p>
								</form>
							</div>

						</td>
					</tr>
				</table>

			</td>
		</tr>
	</table>			
</div>
<script language="javascript" src="js/<?=$pay_ledger_js?>.js"></script>
</body>
</html>
