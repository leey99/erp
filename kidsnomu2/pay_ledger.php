<?
$sub_menu = "400100";
include_once("./_common.php");

$sql_common = " from pibohum_base_pay ";

if(!$code) {
	$sql_a4 = " select * from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
	$row_a4 = sql_fetch($sql_a4);
	$com_code = $row_a4[com_code];
} else {
	$sql_a4 = " select * from $g4[com_list_gy] where com_code = '$code' ";
	$row_a4 = sql_fetch($sql_a4);
	$com_code = $code;
}

$sql_a4_opt = " select * from com_list_gy_opt where com_code = '$com_code' ";
$row_a4_opt = sql_fetch($sql_a4_opt);
//����� Ÿ��
$comp_print_type = $row_a4_opt['comp_print_type'];

$sub_title = "�޿�����";
$g4[title] = $sub_title." : ������� : ".$easynomu_name;

$colspan = 11;

$sql1 = " select * from $g4[pibohum_base] where com_code='$code' and sabun='$id' ";
//echo $sql1;
$result1 = sql_query($sql1);
$row1=mysql_fetch_array($result1);

$sql2 = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
$result2 = sql_query($sql2);
$row2=mysql_fetch_array($result2);

//�Ի���
$in_day_array = explode(".",$row1[in_day]);
$in_day = $in_day_array[0]."�� ".$in_day_array[1]."�� ".$in_day_array[2]."��";

//ä������
if($row1[work_form] == "") $work_form = "";
else if($row1[work_form] == "1") $work_form = "������";
else if($row1[work_form] == "2") $work_form = "�����";
else if($row1[work_form] == "3") $work_form = "�Ͽ���";

//����
$sql_position = " select * from com_code_list where code='$row2[position]' and item='position' ";
$result_position = sql_query($sql_position);
$row_position=mysql_fetch_array($result_position);
//echo $row_position[name];

//ȣ��
$sql_step = " select * from com_code_list where code='$row2[step]' and item='step' ";
$result_step = sql_query($sql_step);
$row_step=mysql_fetch_array($result_step);

//�⵵, �� ����
if(!$search_year) $search_year = date("Y");
if(!$search_month) $search_month = date("m");

//�޿�����
$sql_search = " where com_code='$com_code' and year = '$search_year' and month = '$search_month' and money_result != 0 ";

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

$from_record = 0;
//$rows = 7;
//$rows = 24;
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
<link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
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
for($i=2013;$i<=2016;$i++) {
?>
														<option value="<?=$i?>" <? if($i == $search_year) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
													</select>��
													<select name="search_month">
<?
for($i=1;$i<=12;$i++) {
	if($i < 10) $month = "0".$i;
	else $month = $i;
?>
														<option value="<?=$month?>" <? if($i == $search_month) echo "selected"; ?> ><?=$month?></option>
<?
}
?>


													</select>��
													<input type="submit" value="��ȸ" class="btnblue" />
												</div>
											</td>
											<td>������ : <?=$row_a4[com_name]?> / ����ڵ�Ϲ�ȣ : <?=$row_a4[biz_no]?></td>
										</tr>
									</table>
									<!--�޿�����-->
									<input type="hidden" name="comp_type" value="<?=$comp_print_type?>"/>
									<input type="hidden" name="company" value="<?=$row_a4[com_name]?>"/>
									<input type="hidden" name="pay_year" value="<?=$search_year?>"/>
									<input type="hidden" name="pay_month" value="<?=$search_month?>"/>
<?
//����ӱ�
$sql_g = " select * from com_paycode_list where com_code = '$com_code' and item='trade' ";
//echo $sql_g;
$result_g = sql_query($sql_g);
for($i=0; $row_g=sql_fetch_array($result_g); $i++) {
	$g_code = $row_g[code];
	$money_g_txt[$g_code] = $row_g[name];
	//echo $g_code;
}
//��Ÿ����
$sql_e = " select * from com_paycode_list where com_code = '$com_code' and item='privilege' ";
$result_e = sql_query($sql_e);
for($i=0; $row_e=sql_fetch_array($result_e); $i++) {
	$e_code = $row_e[code];
	$money_e_txt[$e_code] = $row_e[name];
}
//����ӱ�,��Ÿ���� �� �׸� ó��
for($i=1; $i<=5; $i++) {
	if($money_g_txt['g'.$i] == "") $money_g_txt['g'.$i] = "-";
}
for($i=1; $i<=8; $i++) {
	if($money_e_txt['e'.$i] == "") $money_e_txt['e'.$i] = "-";
}
?>
									<input type="hidden" name="g1_text" value="<?=$money_g_txt['g1']?>"/>
									<input type="hidden" name="g2_text" value="<?=$money_g_txt['g2']?>"/>
									<input type="hidden" name="g3_text" value="<?=$money_g_txt['g3']?>"/>
									<input type="hidden" name="g4_text" value="<?=$money_g_txt['g4']?>"/>
									<input type="hidden" name="g5_text" value="<?=$money_g_txt['g5']?>"/>
									<input type="hidden" name="g6_text" value="<?=$money_g_txt['g6']?>"/>
									<input type="hidden" name="b1_text" value="<?=$money_e_txt['e1']?>"/>
									<input type="hidden" name="b2_text" value="<?=$money_e_txt['e2']?>"/>
									<input type="hidden" name="b3_text" value="<?=$money_e_txt['e3']?>"/>
									<input type="hidden" name="b4_text" value="<?=$money_e_txt['e4']?>"/>
									<input type="hidden" name="b5_text" value="<?=$money_e_txt['e5']?>"/>
									<input type="hidden" name="b6_text" value="<?=$money_e_txt['e6']?>"/>
									<input type="hidden" name="b7_text" value="<?=$money_e_txt['e7']?>"/>
									<input type="hidden" name="b8_text" value="<?=$money_e_txt['e8']?>"/>
<?
//�ų� 2�� �������� ǥ�� 160225
if($search_month == "02") $minus_text="��������";
else $minus_text="��Ÿ����";
?>
									<input type="hidden" name="minus_text" value="<?=$minus_text?>"/>
<?
//�������ƾ����
if($com_code == "20368") $etc_text = "ȯ��/�ұ�";
else $etc_text = "����";
?>
									<input type="hidden" name="etc1_text" value="<?=$etc_text?>"/>
									<input type="hidden" name="etc2_text" value="���°���"/>

									<!--�ݺ� ���� �迭 ó��-->
									<input type="hidden" name="no" value=" "/>
									<input type="hidden" name="pay_name" value=" "/>
									<input type="hidden" name="jik" value=" "/>
									<input type="hidden" name="jdate" value=" "/>
									<input type="hidden" name="edate" value=" "/>
									<input type="hidden" name="position" value=" "/>
									<input type="hidden" name="step" value=" "/>
									<input type="hidden" name="work_form" value=" "/>
									<input type="hidden" name="dept" value=" "/>
									<input type="hidden" name="pay_gbn" value=" "/>

									<input type="hidden" name="w_day" value=" "/>
									<input type="hidden" name="w_ext" value=" "/>
									<input type="hidden" name="w_night" value=" "/>
									<input type="hidden" name="w_hday" value=" "/>
									<input type="hidden" name="w_ext_add" value=" "/>
									<input type="hidden" name="w_night_add" value=" "/>
									<input type="hidden" name="w_hday_add" value=" "/>
									<input type="hidden" name="w_sum" value=" "/>

									<input type="hidden" name="money_time_low" value=" "/>
									<input type="hidden" name="money_time" value=" "/>
									<input type="hidden" name="money_month" value=" "/>

									<input type="hidden" name="ext" value=" "/>
									<input type="hidden" name="night" value=" "/>
									<input type="hidden" name="hday" value=" "/>
									<input type="hidden" name="annual_paid_holiday" value=" "/>
									<input type="hidden" name="ext_add" value=" "/>
									<input type="hidden" name="night_add" value=" "/>
									<input type="hidden" name="hday_add" value=" "/>
									<input type="hidden" name="s_sum" value=" "/>

									<input type="hidden" name="g1" value=" "/>
									<input type="hidden" name="g2" value=" "/>
									<input type="hidden" name="g3" value=" "/>
									<input type="hidden" name="g4" value=" "/>
									<input type="hidden" name="g5" value=" "/>
									<input type="hidden" name="g6" value=" "/>
									<input type="hidden" name="g_sum" value=" "/>

									<input type="hidden" name="b1" value=" "/>
									<input type="hidden" name="b2" value=" "/>
									<input type="hidden" name="b3" value=" "/>
									<input type="hidden" name="b4" value=" "/>
									<input type="hidden" name="b5" value=" "/>
									<input type="hidden" name="b6" value=" "/>
									<input type="hidden" name="b7" value=" "/>
									<input type="hidden" name="b8" value=" "/>
									<input type="hidden" name="b_sum" value=" "/>

									<input type="hidden" name="v_sum" value=" "/>

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
									<input type="hidden" name="m_sum" value=" "/>
									<input type="hidden" name="tax_sum" value=" "/>

									<input type="hidden" name="gongje_sum" value=" "/>

									<input type="hidden" name="money_total" value=" "/>
									<input type="hidden" name="money_result" value=" "/>

<?
// ����Ʈ ���
if($comp_print_type == "S") {
	$pay_worker_count = 14;
	$pay_ledger_js = "pay_ledger_s";
//����� �����
} else if($comp_print_type == "G") {
	$pay_worker_count = 14;
	$pay_ledger_js = "pay_ledger_g";
} else {
	//ASE�����
	if($com_code == 20482) {
		$pay_worker_count = 28;
		$pay_ledger_js = "pay_ledger_ase";
	} else {
		//�ο� 14�� �޿����� (��õ���Ű��)
		$pay_worker_count = 14;
		$pay_ledger_js = "pay_ledger_k";
	}
}
$row_add = 0;
$pay_page = ceil($rows / $pay_worker_count) + $row_add;
$w_day_sum = 0;
//�⺻�ñ�, �⺻��, �����3 �հ� ��� ���� �ʱ�ȭ 150810
$money_time_low_sum = 0;
$money_time_low_sum2 = 0;
$money_time_low_sum3 = 0;
$money_time_low_sum4 = 0;
$money_month_sum = 0;
$money_month_sum2 = 0;
$money_month_sum3 = 0;
$money_month_sum4 = 0;
$b1_sum = 0;
$b1_sum2 = 0;
$b1_sum3 = 0;
$b1_sum4 = 0;
$b3_sum = 0;
$b3_sum2 = 0;
$b3_sum3 = 0;
$b3_sum4 = 0;
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//������ ������ ����ó��
	if(!$row[in_day]) $row[in_day] = "-";
	if(!$row[out_day]) $row[out_day] = "-";
	if(!$row[position_txt]) $row[position_txt] = "-";
	if(!$row[step_txt]) $row[step_txt] = "-";
	if(!$row[work_form]) $row[work_form] = "-";
	if(!$row[dept]) $row[dept] = "-";
	if(!$row[pay_gbn]) {
		$pay_gbn = "-";
	} else {
		if($row[pay_gbn] == 0) $pay_gbn = "������";
		else if($row[pay_gbn] == 1) $pay_gbn = "�ñ���";
		else if($row[pay_gbn] == 2) $pay_gbn = "���ձٹ�";
		else if($row[pay_gbn] == 3) $pay_gbn = "������";
		else $pay_gbn = "-";
	}
	//���ؽñ� (�ñ���)
	/*
	if($row[pay_gbn] == 1) $money_time_low = $row[money_hour_ds];
	else $money_time_low = $row[money_hour_ds];
	*/
	//���ؽñ� DB �ʵ� ���� 160121
	if($row['pay_gbn'] == 1) $money_time_low = $row['money_min_base'];
	else $money_time_low = $row['money_min_base'];
	//else $money_time_low = 4860; //�����ӱ�

	if($row[w_ext] == "") $row[w_ext] = 0;
	if($row[w_ext_add] == "") $row[w_ext_add] = 0;
	if($row[w_night] == "") $row[w_night] = 0;
	if($row[w_hday] == "") $row[w_hday] = 0;

	if($row[hday] == "") $row[hday] = 0;
	if($row[annual_paid_holiday] == "") $row[annual_paid_holiday] = 0;

	//�ٷνð� ���
	//$w_sum = $row[w_day] + ($row[w_ext]*1.5) + ($row[w_ext_add]*1.5) + ($row[w_night]*0.5) + ($row[w_hday]*1.5);
	//$w_sum = round($w_sum,2);
	$w_sum = $row[workhour_total];
	$s_sum = $row[ext] + $row[ext_add] + $row[night] + $row[hday] + $row[annual_paid_holiday];
	$g_sum = $row[g1] + $row[g2] + $row[g3] + $row[g4] + $row[g5] + $row[g6];
	$g_sum_ase = $row[g1] + $row[g2] + $row[g3] + $row[g4] + $row[g6];
	$b_sum = $row[b1] + $row[b2] + $row[b3] + $row[b4] + $row[b5] + $row[b6] + $row[b7] + $row[b8];
	//���������� ó��
	if($row_a4_opt[comp_print_type] == "D") {
		$b_sum = $row[b1] + $row[b2] + $row[b3] + $row[b4] + $row[b5] + $row[b6];
	}
	//����������, ���� ó��
	if($row_a4_opt[comp_print_type] == "E") {
		$b_sum = $row[b1] + $row[b2] + $row[b3] + $row[b4] + $row[b5] + $row[b6];
	}
	//������ �հ� ASE����� 160329
	$v_sum = $s_sum + $g_sum_ase + $b_sum;
	//$m_sum = $row[health] + $row[yun] + $row[goyong] + $row[advance_pay] + $row[end_pay] + $row[minus];
	$m_sum = $row[health] + $row[yoyang] + $row[yun] + $row[goyong];
	$tax_sum = $row[tax_so] + $row[tax_jumin];

	//������ 160329
	$gongje_sum = $m_sum + $tax_sum;

	$money_total = $row[money_month] + $row[ext];
	if($i < $pay_worker_count) {

		$w_day_sum = $w_day_sum + $row[w_day];
		//echo $w_day_sum;
		$w_ext_sum = $w_ext_sum + $row[w_ext];
		$w_night_sum = $w_night_sum + $row[w_night];
		$w_hday_sum = $w_hday_sum + $row[w_hday];
		$w_ext_add_sum = $w_ext_add_sum + $row[w_ext_add];
		$w_night_add_sum = $w_night_add_sum + $row[w_night_add];
		$w_hday_add_sum = $w_hday_add_sum + $row[w_hday_add];
		$w_sum_sum = $w_sum_sum + $w_sum;

		$money_time_low_sum = $money_time_low_sum + $money_time_low;
		$money_time_sum = $money_time_sum + $row[money_time];
		$money_month_sum = $money_month_sum + $row[money_month];

		$ext_sum = $ext_sum + $row[ext];
		$night_sum = $night_sum + $row[night];
		$hday_sum = $hday_sum + $row[hday];
		$annual_paid_holiday_sum = $annual_paid_holiday_sum + $row[annual_paid_holiday];
		$ext_add_sum = $ext_add_sum + $row[ext_add];
		$night_add_sum = $night_add_sum + $row[night_add];
		$hday_add_sum = $hday_add_sum + $row[hday_add];
		$s_sum_sum = $s_sum_sum + $s_sum;

		$g1_sum = $g1_sum + $row[g1];
		$g2_sum = $g2_sum + $row[g2];
		$g3_sum = $g3_sum + $row[g3];
		$g4_sum = $g4_sum + $row[g4];
		$g5_sum = $g5_sum + $row[g5];
		$g6_sum = $g6_sum + $row[g6];
		$g_sum_sum = $g_sum_sum + $g_sum;

		$b1_sum = $b1_sum + $row[b1];
		$b2_sum = $b2_sum + $row[b2];
		//echo $i." ".$b3_sum;
		$b3_sum = $b3_sum + $row[b3];
		$b4_sum = $b4_sum + $row[b4];
		$b5_sum = $b5_sum + $row[b5];
		$b6_sum = $b6_sum + $row[b6];
		$b7_sum = $b7_sum + $row[b7];
		$b8_sum = $b8_sum + $row[b8];
		$b_sum_sum = $b_sum_sum + $b_sum;

		$v_sum_sum = $v_sum_sum + $v_sum;

		$tax_so_sum = $tax_so_sum + $row[tax_so];
		$tax_jumin_sum = $tax_jumin_sum + $row[tax_jumin];
		$advance_pay_sum = $advance_pay_sum + $row[advance_pay];
		$health_sum = $health_sum + $row[health];
		$yoyang_sum = $yoyang_sum + $row[yoyang];
		$yun_sum = $yun_sum + $row[yun];
		$goyong_sum = $goyong_sum + $row[goyong];
		$end_pay_sum = $end_pay_sum + $row[end_pay];
		$minus_sum = $minus_sum + $row[minus];
		$m_sum_sum = $m_sum_sum + $m_sum;
		//echo $m_sum_sum;
		$tax_sum_sum = $tax_sum_sum + $tax_sum;

		$gongje_sum_sum = $m_sum_sum + $tax_sum_sum;

		$money_total_sum = $money_total_sum + $row[money_total];
		$money_result_sum = $money_result_sum + $row[money_result];

	} else if($i < ($pay_worker_count*2) && $i > ($pay_worker_count-1)) {
		$w_day_sum2 = $w_day_sum2 + $row[w_day];
		$w_ext_sum2 = $w_ext_sum2 + $row[w_ext];
		$w_night_sum2 = $w_night_sum2 + $row[w_night];
		$w_hday_sum2 = $w_hday_sum2 + $row[w_hday];
		$w_ext_add_sum2 = $w_ext_add_sum2 + $row[w_ext_add];
		$w_night_add_sum2 = $w_night_add_sum2 + $row[w_night_add];
		$w_hday_add_sum2 = $w_hday_add_sum2 + $row[w_hday_add];
		$w_sum2_sum2 = $w_sum2_sum2 + $w_sum;

		$money_time_low_sum2 = $money_time_low_sum2 + $money_time_low;
		$money_time_sum2 = $money_time_sum2 + $row[money_time];
		$money_month_sum2 = $money_month_sum2 + $row[money_month];

		$ext_sum2 = $ext_sum2 + $row[ext];
		$night_sum2 = $night_sum2 + $row[night];
		$hday_sum2 = $hday_sum2 + $row[hday];
		$annual_paid_holiday_sum2 = $annual_paid_holiday_sum2 + $row[annual_paid_holiday];
		$ext_add_sum2 = $ext_add_sum2 + $row[ext_add];
		$night_add_sum2 = $night_add_sum2 + $row[night_add];
		$hday_add_sum2 = $hday_add_sum2 + $row[hday_add];
		$s_sum2_sum2 = $s_sum2_sum2 + $s_sum2;

		$g1_sum2 = $g1_sum2 + $row[g1];
		$g2_sum2 = $g2_sum2 + $row[g2];
		$g3_sum2 = $g3_sum2 + $row[g3];
		$g4_sum2 = $g4_sum2 + $row[g4];
		$g5_sum2 = $g5_sum2 + $row[g5];
		$g6_sum2 = $g6_sum2 + $row[g6];
		$g_sum2_sum2 = $g_sum2_sum2 + $g_sum;

		$b1_sum2 = $b1_sum2 + $row[b1];
		$b2_sum2 = $b2_sum2 + $row[b2];
		$b3_sum2 = $b3_sum2 + $row[b3];
		$b4_sum2 = $b4_sum2 + $row[b4];
		$b5_sum2 = $b5_sum2 + $row[b5];
		$b6_sum2 = $b6_sum2 + $row[b6];
		$b7_sum2 = $b7_sum2 + $row[b7];
		$b8_sum2 = $b8_sum2 + $row[b8];
		$b_sum2_sum2 = $b_sum2_sum2 + $b_sum;

		$v_sum2_sum2 = $v_sum2_sum2 + $v_sum;

		$tax_so_sum2 = $tax_so_sum2 + $row[tax_so];
		$tax_jumin_sum2 = $tax_jumin_sum2 + $row[tax_jumin];
		$advance_pay_sum2 = $advance_pay_sum2 + $row[advance_pay];
		$health_sum2 = $health_sum2 + $row[health];
		$yoyang_sum2 = $yoyang_sum2 + $row[yoyang];
		$yun_sum2 = $yun_sum2 + $row[yun];
		$goyong_sum2 = $goyong_sum2 + $row[goyong];
		$end_pay_sum2 = $end_pay_sum2 + $row[end_pay];
		$minus_sum2 = $minus_sum2 + $row[minus];
		$m_sum2_sum2 = $m_sum2_sum2 + $m_sum;
		$tax_sum2_sum2 = $tax_sum2_sum2 + $tax_sum;

		$gongje_sum2_sum2 = $m_sum2_sum2 + $tax_sum2_sum2;

		$money_total_sum2 = $money_total_sum2 + $row[money_total];
		$money_result_sum2 = $money_result_sum2 + $row[money_result];

	} else if($i < ($pay_worker_count*3) && $i > ($pay_worker_count*2-1)) {
		$w_day_sum3 = $w_day_sum3 + $row[w_day];
		$w_ext_sum3 = $w_ext_sum3 + $row[w_ext];
		$w_night_sum3 = $w_night_sum3 + $row[w_night];
		$w_hday_sum3 = $w_hday_sum3 + $row[w_hday];
		$w_ext_add_sum3 = $w_ext_add_sum3 + $row[w_ext_add];
		$w_night_add_sum3 = $w_night_add_sum3 + $row[w_night_add];
		$w_hday_add_sum3 = $w_hday_add_sum3 + $row[w_hday_add];
		$w_sum3_sum3 = $w_sum3_sum3 + $w_sum;

		$money_time_low_sum3 = $money_time_low_sum3 + $money_time_low;
		$money_time_sum3 = $money_time_sum3 + $row[money_time];
		$money_month_sum3 = $money_month_sum3 + $row[money_month];

		$ext_sum3 = $ext_sum3 + $row[ext];
		$night_sum3 = $night_sum3 + $row[night];
		$hday_sum3 = $hday_sum3 + $row[hday];
		$annual_paid_holiday_sum3 = $annual_paid_holiday_sum3 + $row[annual_paid_holiday];
		$ext_add_sum3 = $ext_add_sum3 + $row[ext_add];
		$night_add_sum3 = $night_add_sum3 + $row[night_add];
		$hday_add_sum3 = $hday_add_sum3 + $row[hday_add];
		$s_sum3_sum3 = $s_sum3_sum3 + $s_sum3;

		$g1_sum3 = $g1_sum3 + $row[g1];
		$g2_sum3 = $g2_sum3 + $row[g2];
		$g3_sum3 = $g3_sum3 + $row[g3];
		$g4_sum3 = $g4_sum3 + $row[g4];
		$g5_sum3 = $g5_sum3 + $row[g5];
		$g6_sum3 = $g6_sum3 + $row[g6];
		$g_sum3_sum3 = $g_sum3_sum3 + $g_sum;

		$b1_sum3 = $b1_sum3 + $row[b1];
		$b2_sum3 = $b2_sum3 + $row[b2];
		$b3_sum3 = $b3_sum3 + $row[b3];
		$b4_sum3 = $b4_sum3 + $row[b4];
		$b5_sum3 = $b5_sum3 + $row[b5];
		$b6_sum3 = $b6_sum3 + $row[b6];
		$b7_sum3 = $b7_sum3 + $row[b7];
		$b8_sum3 = $b8_sum3 + $row[b8];
		$b_sum3_sum3 = $b_sum3_sum3 + $b_sum;

		$v_sum3_sum3 = $v_sum3_sum3 + $v_sum;

		$tax_so_sum3 = $tax_so_sum3 + $row[tax_so];
		$tax_jumin_sum3 = $tax_jumin_sum3 + $row[tax_jumin];
		$advance_pay_sum3 = $advance_pay_sum3 + $row[advance_pay];
		$health_sum3 = $health_sum3 + $row[health];
		$yoyang_sum3 = $yoyang_sum3 + $row[yoyang];
		$yun_sum3 = $yun_sum3 + $row[yun];
		$goyong_sum3 = $goyong_sum3 + $row[goyong];
		$end_pay_sum3 = $end_pay_sum3 + $row[end_pay];
		$minus_sum3 = $minus_sum3 + $row[minus];
		$m_sum3_sum3 = $m_sum3_sum3 + $m_sum;
		$tax_sum3_sum3 = $tax_sum3_sum3 + $tax_sum;

		$gongje_sum3_sum3 = $m_sum3_sum3 + $tax_sum3_sum3;

		$money_total_sum3 = $money_total_sum3 + $row[money_total];
		$money_result_sum3 = $money_result_sum3 + $row[money_result];

	} else if($i < ($pay_worker_count*4) && $i > ($pay_worker_count*3-1)) {
		$w_day_sum4 = $w_day_sum4 + $row[w_day];
		$w_ext_sum4 = $w_ext_sum4 + $row[w_ext];
		$w_night_sum4 = $w_night_sum4 + $row[w_night];
		$w_hday_sum4 = $w_hday_sum4 + $row[w_hday];
		$w_ext_add_sum4 = $w_ext_add_sum4 + $row[w_ext_add];
		$w_night_add_sum4 = $w_night_add_sum4 + $row[w_night_add];
		$w_hday_add_sum4 = $w_hday_add_sum4 + $row[w_hday_add];
		$w_sum4_sum4 = $w_sum4_sum4 + $w_sum;

		$money_time_low_sum4 = $money_time_low_sum4 + $money_time_low;
		$money_time_sum4 = $money_time_sum4 + $row[money_time];
		$money_month_sum4 = $money_month_sum4 + $row[money_month];

		$ext_sum4 = $ext_sum4 + $row[ext];
		$night_sum4 = $night_sum4 + $row[night];
		$hday_sum4 = $hday_sum4 + $row[hday];
		$annual_paid_holiday_sum4 = $annual_paid_holiday_sum4 + $row[annual_paid_holiday];
		$ext_add_sum4 = $ext_add_sum4 + $row[ext_add];
		$night_add_sum4 = $night_add_sum4 + $row[night_add];
		$hday_add_sum4 = $hday_add_sum4 + $row[hday_add];
		$s_sum4_sum4 = $s_sum4_sum4 + $s_sum4;

		$g1_sum4 = $g1_sum4 + $row[g1];
		$g2_sum4 = $g2_sum4 + $row[g2];
		$g3_sum4 = $g3_sum4 + $row[g3];
		$g4_sum4 = $g4_sum4 + $row[g4];
		$g5_sum4 = $g5_sum4 + $row[g5];
		$g6_sum4 = $g6_sum4 + $row[g6];
		$g_sum4_sum4 = $g_sum4_sum4 + $g_sum;

		$b1_sum4 = $b1_sum4 + $row[b1];
		$b2_sum4 = $b2_sum4 + $row[b2];
		$b3_sum4 = $b3_sum4 + $row[b3];
		$b4_sum4 = $b4_sum4 + $row[b4];
		$b5_sum4 = $b5_sum4 + $row[b5];
		$b6_sum4 = $b6_sum4 + $row[b6];
		$b7_sum4 = $b7_sum4 + $row[b7];
		$b8_sum4 = $b8_sum4 + $row[b8];
		$b_sum4_sum4 = $b_sum4_sum4 + $b_sum;

		$v_sum4_sum4 = $v_sum4_sum4 + $v_sum;

		$tax_so_sum4 = $tax_so_sum4 + $row[tax_so];
		$tax_jumin_sum4 = $tax_jumin_sum4 + $row[tax_jumin];
		$advance_pay_sum4 = $advance_pay_sum4 + $row[advance_pay];
		$health_sum4 = $health_sum4 + $row[health];
		$yoyang_sum4 = $yoyang_sum4 + $row[yoyang];
		$yun_sum4 = $yun_sum4 + $row[yun];
		$goyong_sum4 = $goyong_sum4 + $row[goyong];
		$end_pay_sum4 = $end_pay_sum4 + $row[end_pay];
		$minus_sum4 = $minus_sum4 + $row[minus];
		$m_sum4_sum4 = $m_sum4_sum4 + $m_sum;
		$tax_sum4_sum4 = $tax_sum4_sum4 + $tax_sum;

		$gongje_sum4_sum4 = $m_sum4_sum4 + $tax_sum4_sum4;

		$money_total_sum4 = $money_total_sum4 + $row[money_total];
		$money_result_sum4 = $money_result_sum4 + $row[money_result];
	}
?>
									<input type="hidden" name="no" value="<?=$i+1?>"/>
									<input type="hidden" name="pay_name" value="<?=$row[name]?>"/>
									<input type="hidden" name="jik" value="<?=$row_position[name]?>"/>
									<input type="hidden" name="jdate" value="<?=$row[in_day]?>"/>
									<input type="hidden" name="edate" value="<?=$row[out_day]?>"/>
									<input type="hidden" name="position" value="<?=$row[position_txt]?>"/>
									<input type="hidden" name="step" value="<?=$row[step_txt]?>"/>
									<input type="hidden" name="work_form" value="<?=$row[work_form]?> "/>
									<input type="hidden" name="dept" value="<?=$row[dept]?> "/>
									<input type="hidden" name="pay_gbn" value="<?=$pay_gbn?> "/>

									<input type="hidden" name="w_day" value="<?=$row[w_day]?>"/>
									<input type="hidden" name="w_ext" value="<?=$row[w_ext]?>"/>
									<input type="hidden" name="w_night" value="<?=$row[w_night]?>"/>
									<input type="hidden" name="w_hday" value="<?=$row[w_hday]?>"/>
									<input type="hidden" name="w_ext_add" value="<?=$row[w_ext_add]?>"/>
									<input type="hidden" name="w_night_add" value="<?=$row[w_night_add]?>"/>
									<input type="hidden" name="w_hday_add" value="<?=$row[w_hday_add]?>"/>
									<input type="hidden" name="w_sum" value="<?=$w_sum?>"/>

									<input type="hidden" name="money_time_low" value="<?=number_format($money_time_low)?>"/>
									<input type="hidden" name="money_time" value="<?=number_format($row[money_time])?>"/>
									<input type="hidden" name="money_day" value="<?=number_format($row[money_day])?>"/>
									<input type="hidden" name="money_month" value="<?=number_format($row[money_month])?>"/>

									<input type="hidden" name="ext" value="<?=number_format($row[ext])?>"/>
									<input type="hidden" name="night" value="<?=number_format($row[night])?>"/>
									<input type="hidden" name="hday" value="<?=number_format($row[hday])?>"/>
									<input type="hidden" name="ext_add" value="<?=number_format($row[ext_add])?>"/>
									<input type="hidden" name="night_add" value="<?=number_format($row[night_add])?>"/>
									<input type="hidden" name="hday_add" value="<?=number_format($row[hday_add])?>"/>
									<input type="hidden" name="annual_paid_holiday" value="<?=number_format($row[annual_paid_holiday])?>"/>
									<input type="hidden" name="s_sum" value="<?=number_format($s_sum)?>"/>

									<input type="hidden" name="g1" value="<?=number_format($row[g1])?>"/>
									<input type="hidden" name="g2" value="<?=number_format($row[g2])?>"/>
									<input type="hidden" name="g3" value="<?=number_format($row[g3])?>"/>
									<input type="hidden" name="g4" value="<?=number_format($row[g4])?>"/>
									<input type="hidden" name="g5" value="<?=number_format($row[g5])?>"/>
									<input type="hidden" name="g6" value="<?=number_format($row[g6])?>"/>
									<input type="hidden" name="g_sum" value="<?=number_format($g_sum)?>"/>

									<input type="hidden" name="b1" value="<?=number_format($row[b1])?>"/>
									<input type="hidden" name="b2" value="<?=number_format($row[b2])?>"/>
									<input type="hidden" name="b3" value="<?=number_format($row[b3])?>"/>
									<input type="hidden" name="b4" value="<?=number_format($row[b4])?>"/>
									<input type="hidden" name="b5" value="<?=number_format($row[b5])?>"/>
									<input type="hidden" name="b6" value="<?=number_format($row[b6])?>"/>
									<input type="hidden" name="b7" value="<?=number_format($row[b7])?>"/>
									<input type="hidden" name="b8" value="<?=number_format($row[b8])?>"/>
									<input type="hidden" name="b_sum" value="<?=number_format($b_sum)?>"/>

									<input type="hidden" name="v_sum" value="<?=number_format($v_sum)?>"/>

									<input type="hidden" name="etc" value="<?=number_format($row[etc])?>"/>
									<input type="hidden" name="etc2" value="<?=number_format($row[etc2]*(-1))?>"/>

									<input type="hidden" name="tax_so" value="<?=number_format($row[tax_so])?>"/>
									<input type="hidden" name="tax_jumin" value="<?=number_format($row[tax_jumin])?>"/>
									<input type="hidden" name="advance_pay" value="<?=number_format($row[advance_pay])?>"/>
									<input type="hidden" name="health" value="<?=number_format($row[health])?>"/>
									<input type="hidden" name="yoyang" value="<?=number_format($row[yoyang])?>"/>
									<input type="hidden" name="yun" value="<?=number_format($row[yun])?>"/>
									<input type="hidden" name="goyong" value="<?=number_format($row[goyong])?>"/>
									<input type="hidden" name="end_pay" value="<?=number_format($row[end_pay])?>"/>
<?
//�ؿ�������� ����������
if($comp_print_type == "S") {
?>
									<input type="hidden" name="minus" value="<?=number_format($row[minus])?>"/>
<?
} else {
?>
									<input type="hidden" name="minus" value="<?=number_format($row[minus])?>"/>
<?
}
?>
									<input type="hidden" name="m_sum" value="<?=number_format($m_sum)?>"/>
									<input type="hidden" name="tax_sum" value="<?=number_format($tax_sum)?>"/>

									<input type="hidden" name="gongje_sum" value="<?=number_format($gongje_sum)?>"/>

									<input type="hidden" name="money_total" value="<?=number_format($row[money_total])?>"/>
									<input type="hidden" name="money_result" value="<?=number_format($row[money_result])?>"/>
<?
}
//echo $i;
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
									<input type="hidden" name="jik" value=" "/>
									<input type="hidden" name="jdate" value=" "/>
									<input type="hidden" name="edate" value=" "/>
									<input type="hidden" name="position" value=" "/>
									<input type="hidden" name="step" value=" "/>
									<input type="hidden" name="work_form" value=" "/>
									<input type="hidden" name="dept" value=" "/>
									<input type="hidden" name="pay_gbn" value=" "/>

									<input type="hidden" name="w_day" value=" "/>
									<input type="hidden" name="w_ext" value=" "/>
									<input type="hidden" name="w_night" value=" "/>
									<input type="hidden" name="w_hday" value=" "/>
									<input type="hidden" name="w_ext_add" value=" "/>
									<input type="hidden" name="w_night_add" value=" "/>
									<input type="hidden" name="w_hday_add" value=" "/>
									<input type="hidden" name="w_sum" value=" "/>

									<input type="hidden" name="money_time_low" value=" "/>
									<input type="hidden" name="money_time" value=" "/>
									<input type="hidden" name="money_month" value=" "/>

									<input type="hidden" name="ext" value=" "/>
									<input type="hidden" name="night" value=" "/>
									<input type="hidden" name="hday" value=" "/>
									<input type="hidden" name="annual_paid_holiday" value=" "/>
									<input type="hidden" name="ext_add" value=" "/>
									<input type="hidden" name="night_add" value=" "/>
									<input type="hidden" name="hday_add" value=" "/>
									<input type="hidden" name="s_sum" value=" "/>

									<input type="hidden" name="g1" value=" "/>
									<input type="hidden" name="g2" value=" "/>
									<input type="hidden" name="g3" value=" "/>
									<input type="hidden" name="g4" value=" "/>
									<input type="hidden" name="g5" value=" "/>
									<input type="hidden" name="g6" value=" "/>
									<input type="hidden" name="g_sum" value=" "/>

									<input type="hidden" name="b1" value=" "/>
									<input type="hidden" name="b2" value=" "/>
									<input type="hidden" name="b3" value=" "/>
									<input type="hidden" name="b4" value=" "/>
									<input type="hidden" name="b5" value=" "/>
									<input type="hidden" name="b6" value=" "/>
									<input type="hidden" name="b7" value=" "/>
									<input type="hidden" name="b8" value=" "/>
									<input type="hidden" name="b_sum" value=" "/>

									<input type="hidden" name="v_sum" value=" "/>

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
									<input type="hidden" name="m_sum" value=" "/>
									<input type="hidden" name="tax_sum" value=" "/>

									<input type="hidden" name="gongje_sum" value=" "/>

									<input type="hidden" name="money_total" value=" "/>
									<input type="hidden" name="money_result" value=" "/>
<?
}
?>
									<input type="hidden" name="w_day_sum" value="<?=number_format($w_day_sum,2)?>"/>
									<input type="hidden" name="w_ext_sum" value="<?=number_format($w_ext_sum,2)?>"/>
									<input type="hidden" name="w_night_sum" value="<?=number_format($w_night_sum,2)?>"/>
									<input type="hidden" name="w_hday_sum" value="<?=number_format($w_hday_sum,2)?>"/>
									<input type="hidden" name="w_ext_add_sum" value="<?=number_format($w_ext_add_sum,2)?>"/>
									<input type="hidden" name="w_night_add_sum" value="<?=number_format($w_night_add_sum,2)?>"/>
									<input type="hidden" name="w_hday_add_sum" value="<?=number_format($w_hday_add_sum,2)?>"/>
									<input type="hidden" name="w_sum_sum" value="<?=number_format($w_sum_sum,2)?>"/>

									<input type="hidden" name="money_time_low_sum" value="<?=number_format($money_time_low_sum)?>"/>
									<input type="hidden" name="money_time_sum" value="<?=number_format($money_time_sum)?>"/>
									<input type="hidden" name="money_month_sum" value="<?=number_format($money_month_sum)?>"/>

									<input type="hidden" name="ext_sum" value="<?=number_format($ext_sum)?>"/>
									<input type="hidden" name="night_sum" value="<?=number_format($night_sum)?>"/>
									<input type="hidden" name="hday_sum" value="<?=number_format($hday_sum)?>"/>
									<input type="hidden" name="annual_paid_holiday_sum" value="<?=number_format($annual_paid_holiday_sum)?>"/>
									<input type="hidden" name="ext_add_sum" value="<?=number_format($ext_add_sum)?>"/>
									<input type="hidden" name="night_add_sum" value="<?=number_format($ext_add_sum)?>"/>
									<input type="hidden" name="hday_add_sum" value="<?=number_format($ext_add_sum)?>"/>
									<input type="hidden" name="s_sum_sum" value="<?=number_format($s_sum_sum)?>"/>

									<input type="hidden" name="g1_sum" value="<?=number_format($g1_sum)?>"/>
									<input type="hidden" name="g2_sum" value="<?=number_format($g2_sum)?>"/>
									<input type="hidden" name="g3_sum" value="<?=number_format($g3_sum)?>"/>
									<input type="hidden" name="g4_sum" value="<?=number_format($g4_sum)?>"/>
									<input type="hidden" name="g5_sum" value="<?=number_format($g5_sum)?>"/>
									<input type="hidden" name="g6_sum" value="<?=number_format($g6_sum)?>"/>
									<input type="hidden" name="g_sum_sum" value="<?=number_format($g_sum_sum)?>"/>

									<input type="hidden" name="b1_sum" value="<?=number_format($b1_sum)?>"/>
									<input type="hidden" name="b2_sum" value="<?=number_format($b2_sum)?>"/>
									<input type="hidden" name="b3_sum" value="<?=number_format($b3_sum)?>"/>
									<input type="hidden" name="b4_sum" value="<?=number_format($b4_sum)?>"/>
									<input type="hidden" name="b5_sum" value="<?=number_format($b5_sum)?>"/>
									<input type="hidden" name="b6_sum" value="<?=number_format($b6_sum)?>"/>
									<input type="hidden" name="b7_sum" value="<?=number_format($b7_sum)?>"/>
									<input type="hidden" name="b8_sum" value="<?=number_format($b8_sum)?>"/>
									<input type="hidden" name="b_sum_sum" value="<?=number_format($b_sum_sum)?>"/>

									<input type="hidden" name="v_sum_sum" value="<?=number_format($v_sum_sum)?>"/>

									<input type="hidden" name="etc_sum" value="<?=number_format($etc_sum[$i])?>"/>
									<input type="hidden" name="etc2_sum" value="<?=number_format($etc2_sum[$i]*(-1))?>"/>

									<input type="hidden" name="tax_so_sum" value="<?=number_format($tax_so_sum)?>"/>
									<input type="hidden" name="tax_jumin_sum" value="<?=number_format($tax_jumin_sum)?>"/>
									<input type="hidden" name="advance_pay_sum" value="<?=number_format($advance_pay_sum)?>"/>
									<input type="hidden" name="health_sum" value="<?=number_format($health_sum)?>"/>
									<input type="hidden" name="yoyang_sum" value="<?=number_format($yoyang_sum)?>"/>
									<input type="hidden" name="yun_sum" value="<?=number_format($yun_sum)?>"/>
									<input type="hidden" name="goyong_sum" value="<?=number_format($goyong_sum)?>"/>
									<input type="hidden" name="end_pay_sum" value="<?=number_format($end_pay_sum)?>"/>
									<input type="hidden" name="minus_sum" value="<?=number_format($minus_sum)?>"/>
									<input type="hidden" name="m_sum_sum" value="<?=number_format($m_sum_sum)?>"/>
									<input type="hidden" name="tax_sum_sum" value="<?=number_format($tax_sum_sum)?>"/>

									<input type="hidden" name="gongje_sum_sum" value="<?=number_format($gongje_sum_sum)?>"/>

									<input type="hidden" name="money_total_sum" value="<?=number_format($money_total_sum)?>"/>
									<input type="hidden" name="money_result_sum" value="<?=number_format($money_result_sum)?>"/>

<!--2page-->
									<input type="hidden" name="w_day_sum2" value="<?=number_format($w_day_sum2,2)?>"/>
									<input type="hidden" name="w_ext_sum2" value="<?=number_format($w_ext_sum2,2)?>"/>
									<input type="hidden" name="w_night_sum2" value="<?=number_format($w_night_sum2,2)?>"/>
									<input type="hidden" name="w_hday_sum2" value="<?=number_format($w_hday_sum2,2)?>"/>
									<input type="hidden" name="w_ext_add_sum2" value="<?=number_format($w_ext_add_sum2,2)?>"/>
									<input type="hidden" name="w_night_add_sum2" value="<?=number_format($w_night_add_sum2,2)?>"/>
									<input type="hidden" name="w_hday_add_sum2" value="<?=number_format($w_hday_add_sum2,2)?>"/>
									<input type="hidden" name="w_sum2_sum2" value="<?=number_format($w_sum2_sum2,2)?>"/>

									<input type="hidden" name="money_time_low_sum2" value="<?=number_format($money_time_low_sum2)?>"/>
									<input type="hidden" name="money_time_sum2" value="<?=number_format($money_time_sum2)?>"/>
									<input type="hidden" name="money_month_sum2" value="<?=number_format($money_month_sum2)?>"/>

									<input type="hidden" name="ext_sum2" value="<?=number_format($ext_sum2)?>"/>
									<input type="hidden" name="night_sum2" value="<?=number_format($night_sum2)?>"/>
									<input type="hidden" name="hday_sum2" value="<?=number_format($hday_sum2)?>"/>
									<input type="hidden" name="annual_paid_holiday_sum2" value="<?=number_format($annual_paid_holiday_sum2)?>"/>
									<input type="hidden" name="ext_add_sum2" value="<?=number_format($ext_add_sum2)?>"/>
									<input type="hidden" name="night_add_sum2" value="<?=number_format($ext_add_sum2)?>"/>
									<input type="hidden" name="hday_add_sum2" value="<?=number_format($ext_add_sum2)?>"/>
									<input type="hidden" name="s_sum2_sum2" value="<?=number_format($s_sum2_sum2)?>"/>

									<input type="hidden" name="g1_sum2" value="<?=number_format($g1_sum2)?>"/>
									<input type="hidden" name="g2_sum2" value="<?=number_format($g2_sum2)?>"/>
									<input type="hidden" name="g3_sum2" value="<?=number_format($g3_sum2)?>"/>
									<input type="hidden" name="g4_sum2" value="<?=number_format($g4_sum2)?>"/>
									<input type="hidden" name="g5_sum2" value="<?=number_format($g5_sum2)?>"/>
									<input type="hidden" name="g6_sum2" value="<?=number_format($g6_sum2)?>"/>
									<input type="hidden" name="g_sum2_sum2" value="<?=number_format($g_sum2_sum2)?>"/>

									<input type="hidden" name="b1_sum2" value="<?=number_format($b1_sum2)?>"/>
									<input type="hidden" name="b2_sum2" value="<?=number_format($b2_sum2)?>"/>
									<input type="hidden" name="b3_sum2" value="<?=number_format($b3_sum2)?>"/>
									<input type="hidden" name="b4_sum2" value="<?=number_format($b4_sum2)?>"/>
									<input type="hidden" name="b5_sum2" value="<?=number_format($b5_sum2)?>"/>
									<input type="hidden" name="b6_sum2" value="<?=number_format($b6_sum2)?>"/>
									<input type="hidden" name="b7_sum2" value="<?=number_format($b7_sum2)?>"/>
									<input type="hidden" name="b8_sum2" value="<?=number_format($b8_sum2)?>"/>
									<input type="hidden" name="b_sum2_sum2" value="<?=number_format($b_sum2_sum2)?>"/>

									<input type="hidden" name="v_sum2_sum2" value="<?=number_format($v_sum2_sum2)?>"/>

									<input type="hidden" name="tax_so_sum2" value="<?=number_format($tax_so_sum2)?>"/>
									<input type="hidden" name="tax_jumin_sum2" value="<?=number_format($tax_jumin_sum2)?>"/>
									<input type="hidden" name="advance_pay_sum2" value="<?=number_format($advance_pay_sum2)?>"/>
									<input type="hidden" name="health_sum2" value="<?=number_format($health_sum2)?>"/>
									<input type="hidden" name="yoyang_sum2" value="<?=number_format($yoyang_sum2)?>"/>
									<input type="hidden" name="yun_sum2" value="<?=number_format($yun_sum2)?>"/>
									<input type="hidden" name="goyong_sum2" value="<?=number_format($goyong_sum2)?>"/>
									<input type="hidden" name="end_pay_sum2" value="<?=number_format($end_pay_sum2)?>"/>
									<input type="hidden" name="minus_sum2" value="<?=number_format($minus_sum2)?>"/>
									<input type="hidden" name="m_sum2_sum2" value="<?=number_format($m_sum2_sum2)?>"/>
									<input type="hidden" name="tax_sum2_sum2" value="<?=number_format($tax_sum2_sum2)?>"/>

									<input type="hidden" name="gongje_sum2_sum2" value="<?=number_format($gongje_sum2_sum2)?>"/>

									<input type="hidden" name="money_total_sum2" value="<?=number_format($money_total_sum2)?>"/>
									<input type="hidden" name="money_result_sum2" value="<?=number_format($money_result_sum2)?>"/>

<!--3page-->
									<input type="hidden" name="w_day_sum3" value="<?=number_format($w_day_sum3,2)?>"/>
									<input type="hidden" name="w_ext_sum3" value="<?=number_format($w_ext_sum3,2)?>"/>
									<input type="hidden" name="w_night_sum3" value="<?=number_format($w_night_sum3,2)?>"/>
									<input type="hidden" name="w_hday_sum3" value="<?=number_format($w_hday_sum3,2)?>"/>
									<input type="hidden" name="w_ext_add_sum3" value="<?=number_format($w_ext_add_sum3,2)?>"/>
									<input type="hidden" name="w_night_add_sum3" value="<?=number_format($w_night_add_sum3,2)?>"/>
									<input type="hidden" name="w_hday_add_sum3" value="<?=number_format($w_hday_add_sum3,2)?>"/>
									<input type="hidden" name="w_sum3_sum3" value="<?=number_format($w_sum3_sum3,2)?>"/>

									<input type="hidden" name="money_time_low_sum3" value="<?=number_format($money_time_low_sum3)?>"/>
									<input type="hidden" name="money_time_sum3" value="<?=number_format($money_time_sum3)?>"/>
									<input type="hidden" name="money_month_sum3" value="<?=number_format($money_month_sum3)?>"/>

									<input type="hidden" name="ext_sum3" value="<?=number_format($ext_sum3)?>"/>
									<input type="hidden" name="night_sum3" value="<?=number_format($night_sum3)?>"/>
									<input type="hidden" name="hday_sum3" value="<?=number_format($hday_sum3)?>"/>
									<input type="hidden" name="annual_paid_holiday_sum3" value="<?=number_format($annual_paid_holiday_sum3)?>"/>
									<input type="hidden" name="ext_add_sum3" value="<?=number_format($ext_add_sum3)?>"/>
									<input type="hidden" name="night_add_sum3" value="<?=number_format($ext_add_sum3)?>"/>
									<input type="hidden" name="hday_add_sum3" value="<?=number_format($ext_add_sum3)?>"/>
									<input type="hidden" name="s_sum3_sum3" value="<?=number_format($s_sum3_sum3)?>"/>

									<input type="hidden" name="g1_sum3" value="<?=number_format($g1_sum3)?>"/>
									<input type="hidden" name="g2_sum3" value="<?=number_format($g2_sum3)?>"/>
									<input type="hidden" name="g3_sum3" value="<?=number_format($g3_sum3)?>"/>
									<input type="hidden" name="g4_sum3" value="<?=number_format($g4_sum3)?>"/>
									<input type="hidden" name="g5_sum3" value="<?=number_format($g5_sum3)?>"/>
									<input type="hidden" name="g6_sum3" value="<?=number_format($g6_sum3)?>"/>
									<input type="hidden" name="g_sum3_sum3" value="<?=number_format($g_sum3_sum3)?>"/>

									<input type="hidden" name="b1_sum3" value="<?=number_format($b1_sum3)?>"/>
									<input type="hidden" name="b2_sum3" value="<?=number_format($b2_sum3)?>"/>
									<input type="hidden" name="b3_sum3" value="<?=number_format($b3_sum3)?>"/>
									<input type="hidden" name="b4_sum3" value="<?=number_format($b4_sum3)?>"/>
									<input type="hidden" name="b5_sum3" value="<?=number_format($b5_sum3)?>"/>
									<input type="hidden" name="b6_sum3" value="<?=number_format($b6_sum3)?>"/>
									<input type="hidden" name="b7_sum3" value="<?=number_format($b7_sum3)?>"/>
									<input type="hidden" name="b8_sum3" value="<?=number_format($b8_sum3)?>"/>
									<input type="hidden" name="b_sum3_sum3" value="<?=number_format($b_sum3_sum3)?>"/>

									<input type="hidden" name="v_sum3_sum3" value="<?=number_format($v_sum3_sum3)?>"/>

									<input type="hidden" name="tax_so_sum3" value="<?=number_format($tax_so_sum3)?>"/>
									<input type="hidden" name="tax_jumin_sum3" value="<?=number_format($tax_jumin_sum3)?>"/>
									<input type="hidden" name="advance_pay_sum3" value="<?=number_format($advance_pay_sum3)?>"/>
									<input type="hidden" name="health_sum3" value="<?=number_format($health_sum3)?>"/>
									<input type="hidden" name="yoyang_sum3" value="<?=number_format($yoyang_sum3)?>"/>
									<input type="hidden" name="yun_sum3" value="<?=number_format($yun_sum3)?>"/>
									<input type="hidden" name="goyong_sum3" value="<?=number_format($goyong_sum3)?>"/>
									<input type="hidden" name="end_pay_sum3" value="<?=number_format($end_pay_sum3)?>"/>
									<input type="hidden" name="minus_sum3" value="<?=number_format($minus_sum3)?>"/>
									<input type="hidden" name="m_sum3_sum3" value="<?=number_format($m_sum3_sum3)?>"/>
									<input type="hidden" name="tax_sum3_sum3" value="<?=number_format($tax_sum3_sum3)?>"/>

									<input type="hidden" name="gongje_sum3_sum3" value="<?=number_format($gongje_sum3_sum3)?>"/>

									<input type="hidden" name="money_total_sum3" value="<?=number_format($money_total_sum3)?>"/>
									<input type="hidden" name="money_result_sum3" value="<?=number_format($money_result_sum3)?>"/>

<!--4page-->
									<input type="hidden" name="w_day_sum4" value="<?=number_format($w_day_sum4,2)?>"/>
									<input type="hidden" name="w_ext_sum4" value="<?=number_format($w_ext_sum4,2)?>"/>
									<input type="hidden" name="w_night_sum4" value="<?=number_format($w_night_sum4,2)?>"/>
									<input type="hidden" name="w_hday_sum4" value="<?=number_format($w_hday_sum4,2)?>"/>
									<input type="hidden" name="w_ext_add_sum4" value="<?=number_format($w_ext_add_sum4,2)?>"/>
									<input type="hidden" name="w_night_add_sum4" value="<?=number_format($w_night_add_sum4,2)?>"/>
									<input type="hidden" name="w_hday_add_sum4" value="<?=number_format($w_hday_add_sum4,2)?>"/>
									<input type="hidden" name="w_sum4_sum4" value="<?=number_format($w_sum4_sum4,2)?>"/>

									<input type="hidden" name="money_time_low_sum4" value="<?=number_format($money_time_low_sum4)?>"/>
									<input type="hidden" name="money_time_sum4" value="<?=number_format($money_time_sum4)?>"/>
									<input type="hidden" name="money_month_sum4" value="<?=number_format($money_month_sum4)?>"/>

									<input type="hidden" name="ext_sum4" value="<?=number_format($ext_sum4)?>"/>
									<input type="hidden" name="night_sum4" value="<?=number_format($night_sum4)?>"/>
									<input type="hidden" name="hday_sum4" value="<?=number_format($hday_sum4)?>"/>
									<input type="hidden" name="annual_paid_holiday_sum4" value="<?=number_format($annual_paid_holiday_sum4)?>"/>
									<input type="hidden" name="ext_add_sum4" value="<?=number_format($ext_add_sum4)?>"/>
									<input type="hidden" name="night_add_sum4" value="<?=number_format($ext_add_sum4)?>"/>
									<input type="hidden" name="hday_add_sum4" value="<?=number_format($ext_add_sum4)?>"/>
									<input type="hidden" name="s_sum4_sum4" value="<?=number_format($s_sum4_sum4)?>"/>

									<input type="hidden" name="g1_sum4" value="<?=number_format($g1_sum4)?>"/>
									<input type="hidden" name="g2_sum4" value="<?=number_format($g2_sum4)?>"/>
									<input type="hidden" name="g3_sum4" value="<?=number_format($g3_sum4)?>"/>
									<input type="hidden" name="g4_sum4" value="<?=number_format($g4_sum4)?>"/>
									<input type="hidden" name="g5_sum4" value="<?=number_format($g5_sum4)?>"/>
									<input type="hidden" name="g6_sum4" value="<?=number_format($g6_sum4)?>"/>
									<input type="hidden" name="g_sum4_sum4" value="<?=number_format($g_sum4_sum4)?>"/>

									<input type="hidden" name="b1_sum4" value="<?=number_format($b1_sum4)?>"/>
									<input type="hidden" name="b2_sum4" value="<?=number_format($b2_sum4)?>"/>
									<input type="hidden" name="b3_sum4" value="<?=number_format($b3_sum4)?>"/>
									<input type="hidden" name="b4_sum4" value="<?=number_format($b4_sum4)?>"/>
									<input type="hidden" name="b5_sum4" value="<?=number_format($b5_sum4)?>"/>
									<input type="hidden" name="b6_sum4" value="<?=number_format($b6_sum4)?>"/>
									<input type="hidden" name="b7_sum4" value="<?=number_format($b7_sum4)?>"/>
									<input type="hidden" name="b8_sum4" value="<?=number_format($b8_sum4)?>"/>
									<input type="hidden" name="b_sum4_sum4" value="<?=number_format($b_sum4_sum4)?>"/>

									<input type="hidden" name="v_sum4_sum4" value="<?=number_format($v_sum4_sum4)?>"/>

									<input type="hidden" name="tax_so_sum4" value="<?=number_format($tax_so_sum4)?>"/>
									<input type="hidden" name="tax_jumin_sum4" value="<?=number_format($tax_jumin_sum4)?>"/>
									<input type="hidden" name="advance_pay_sum4" value="<?=number_format($advance_pay_sum4)?>"/>
									<input type="hidden" name="health_sum4" value="<?=number_format($health_sum4)?>"/>
									<input type="hidden" name="yoyang_sum4" value="<?=number_format($yoyang_sum4)?>"/>
									<input type="hidden" name="yun_sum4" value="<?=number_format($yun_sum4)?>"/>
									<input type="hidden" name="goyong_sum4" value="<?=number_format($goyong_sum4)?>"/>
									<input type="hidden" name="end_pay_sum4" value="<?=number_format($end_pay_sum4)?>"/>
									<input type="hidden" name="minus_sum4" value="<?=number_format($minus_sum4)?>"/>
									<input type="hidden" name="m_sum4_sum4" value="<?=number_format($m_sum4_sum4)?>"/>
									<input type="hidden" name="tax_sum4_sum4" value="<?=number_format($tax_sum4_sum4)?>"/>

									<input type="hidden" name="gongje_sum4_sum4" value="<?=number_format($gongje_sum4_sum4)?>"/>

									<input type="hidden" name="money_total_sum4" value="<?=number_format($money_total_sum4)?>"/>
									<input type="hidden" name="money_result_sum4" value="<?=number_format($money_result_sum4)?>"/>
<?
	//�Ѱ� ���
	$w_day_sum_t = $w_day_sum + $w_day_sum2 + $w_day_sum3 + $w_day_sum4;
	$w_ext_sum_t = $w_ext_sum + $w_ext_sum2 + $w_ext_sum3 + $w_ext_sum4;
	$w_night_sum_t = $w_night_sum + $w_night_sum2 + $w_night_sum3 + $w_night_sum4;
	$w_hday_sum_t = $w_hday_sum + $w_hday_sum2 + $w_hday_sum3 + $w_hday_sum4;
	$w_sum_sum_t = $w_sum_sum + $w_sum_sum2 + $w_sum_sum3 + $w_sum_sum4;
	$money_time_low_sum_t = $money_time_low_sum + $money_time_low_sum2 + $money_time_low_sum3 + $money_time_low_sum4;
	$money_time_sum_t = $money_time_sum + $money_time_sum2 + $money_time_sum3 + $money_time_sum4;
	$money_month_sum_t = $money_month_sum + $money_month_sum2 + $money_month_sum3 + $money_month_sum4;
	$ext_sum_t = $ext_sum + $ext_sum2 + $ext_sum3 + $ext_sum4;
	$night_sum_t = $night_sum + $night_sum2 + $night_sum3 + $night_sum4;
	$hday_sum_t = $hday_sum + $hday_sum2 + $hday_sum3 + $hday_sum4;
	$annual_paid_holiday_sum_t = $annual_paid_holiday_sum + $annual_paid_holiday_sum2 + $annual_paid_holiday_sum3 + $annual_paid_holiday_sum4;
	$s_sum_sum_t = $s_sum_sum + $s_sum_sum2 + $s_sum_sum3 + $s_sum_sum4;
	$g1_sum_t = $g1_sum + $g1_sum2 + $g1_sum3 + $g1_sum4;
	$g2_sum_t = $g2_sum + $g2_sum2 + $g2_sum3 + $g2_sum4;
	$g3_sum_t = $g3_sum + $g3_sum2 + $g3_sum3 + $g3_sum4;
	$g4_sum_t = $g4_sum + $g4_sum2 + $g4_sum3 + $g4_sum4;
	$g5_sum_t = $g5_sum + $g5_sum2 + $g5_sum3 + $g5_sum4;
	$g6_sum_t = $g6_sum + $g6_sum2 + $g6_sum3 + $g6_sum4;
	$g_sum_sum_t = $g_sum_sum + $g_sum_sum2 + $g_sum_sum3 + $g_sum_sum4;
	$b1_sum_t = $b1_sum + $b1_sum2 + $b1_sum3 + $b1_sum4;
	$b2_sum_t = $b2_sum + $b2_sum2 + $b2_sum3 + $b2_sum4;
	//echo $b3_sum." + ".$b3_sum2." + ".$b3_sum3." + ".$b3_sum4;
	$b3_sum_t = $b3_sum + $b3_sum2 + $b3_sum3 + $b3_sum4;
	$b4_sum_t = $b4_sum + $b4_sum2 + $b4_sum3 + $b4_sum4;
	$b5_sum_t = $b5_sum + $b5_sum2 + $b5_sum3 + $b5_sum4;
	$b6_sum_t = $b6_sum + $b6_sum2 + $b6_sum3 + $b6_sum4;
	$b7_sum_t = $b7_sum + $b7_sum2 + $b7_sum3 + $b7_sum4;
	$b8_sum_t = $b8_sum + $b8_sum2 + $b8_sum3 + $b8_sum4;
	$b9_sum_t = $b9_sum + $b9_sum2 + $b9_sum3 + $b9_sum4;
	$b_sum_sum_t = $b_sum_sum + $b_sum_sum2 + $b_sum_sum3 + $b_sum_sum4;

	$v_sum_sum_t = $v_sum_sum + $v_sum_sum2 + $v_sum_sum3 + $v_sum_sum4;

	$etc_sum_t = $etc_sum + $etc_sum2 + $etc_sum3 + $etc_sum4;
	$etc2_sum_t = $etc2_sum + $etc2_sum2 + $etc2_sum3 + $etc2_sum4;

	$tax_so_sum_t = $tax_so_sum + $tax_so_sum2 + $tax_so_sum3 + $tax_so_sum4;
	$tax_jumin_sum_t = $tax_jumin_sum + $tax_jumin_sum2 + $tax_jumin_sum3 + $tax_jumin_sum4;
	$advance_pay_sum_t = $advance_pay_sum + $advance_pay_sum2 + $advance_pay_sum3 + $advance_pay_sum4;
	$health_sum_t = $health_sum + $health_sum2 + $health_sum3 + $health_sum4;
	$yoyang_sum_t = $yoyang_sum + $yoyang_sum2 + $yoyang_sum3 + $yoyang_sum4;
	$yun_sum_t = $yun_sum + $yun_sum2 + $yun_sum3 + $yun_sum4;
	$goyong_sum_t = $goyong_sum + $goyong_sum2 + $goyong_sum3 + $goyong_sum4;
	$end_pay_sum_t = $end_pay_sum + $end_pay_sum2 + $end_pay_sum3 + $end_pay_sum4;
	$minus_sum_t = $minus_sum + $minus_sum2 + $minus_sum3 + $minus_sum4;
	$minus2_sum_t = $minus2_sum + $minus2_sum2 + $minus2_sum3 + $minus2_sum4;
	$m_sum_sum_t = $health_sum_t + $yoyang_sum_t + $yun_sum_t + $goyong_sum_t;
	$tax_sum_sum_t = $tax_so_sum_t + $tax_jumin_sum_t;

	$gongje_sum_sum_t = $m_sum_sum_t + $tax_sum_sum_t;

	$money_total_sum_t = $money_total_sum + $money_total_sum2 + $money_total_sum3 + $money_total_sum4;
	$money_result_sum_t = $money_result_sum + $money_result_sum2 + $money_result_sum3 + $money_result_sum4;
?>
									<!-- �Ѱ� -->
									<input type="hidden" name="w_day_sum_t" value="<?=number_format($w_day_sum_t,2)?>"/>
									<input type="hidden" name="w_ext_sum_t" value="<?=number_format($w_ext_sum_t,2)?>"/>
									<input type="hidden" name="w_night_sum_t" value="<?=number_format($w_night_sum_t,2)?>"/>
									<input type="hidden" name="w_hday_sum_t" value="<?=number_format($w_hday_sum_t,2)?>"/>
									<input type="hidden" name="w_year_sum_t" value="<?=number_format($w_year_sum_t,2)?>"/>
									<input type="hidden" name="w_etc_sum_t" value="<?=number_format($w_etc_sum_t,2)?>"/>

									<input type="hidden" name="w_sum_sum_t" value="<?=number_format($w_sum_sum_t,2)?>"/>

									<input type="hidden" name="money_time_low_sum_t" value="<?=number_format($money_time_low_sum_t)?>"/>
									<input type="hidden" name="money_time_sum_t" value="<?=number_format($money_time_sum_t)?>"/>
									<input type="hidden" name="money_month_sum_t" value="<?=number_format($money_month_sum_t)?>"/>

									<input type="hidden" name="ext_sum_t" value="<?=number_format($ext_sum_t)?>"/>
									<input type="hidden" name="night_sum_t" value="<?=number_format($night_sum_t)?>"/>
									<input type="hidden" name="hday_sum_t" value="<?=number_format($hday_sum_t)?>"/>
									<input type="hidden" name="annual_paid_holiday_sum_t" value="<?=number_format($annual_paid_holiday_sum_t)?>"/>
									<input type="hidden" name="s_sum_sum_t" value="<?=number_format($s_sum_sum_t)?>"/>

									<input type="hidden" name="g1_sum_t" value="<?=number_format($g1_sum_t)?>"/>
									<input type="hidden" name="g2_sum_t" value="<?=number_format($g2_sum_t)?>"/>
									<input type="hidden" name="g3_sum_t" value="<?=number_format($g3_sum_t)?>"/>
									<input type="hidden" name="g4_sum_t" value="<?=number_format($g4_sum_t)?>"/>
									<input type="hidden" name="g5_sum_t" value="<?=number_format($g5_sum_t)?>"/>
									<input type="hidden" name="g6_sum_t" value="<?=number_format($g6_sum_t)?>"/>
									<input type="hidden" name="g_sum_sum_t" value="<?=number_format($g_sum_sum_t)?>"/>

									<input type="hidden" name="b1_sum_t" value="<?=number_format($b1_sum_t)?>"/>
									<input type="hidden" name="b2_sum_t" value="<?=number_format($b2_sum_t)?>"/>
									<input type="hidden" name="b3_sum_t" value="<?=number_format($b3_sum_t)?>"/>
									<input type="hidden" name="b4_sum_t" value="<?=number_format($b4_sum_t)?>"/>
									<input type="hidden" name="b5_sum_t" value="<?=number_format($b5_sum_t)?>"/>
									<input type="hidden" name="b6_sum_t" value="<?=number_format($b6_sum_t)?>"/>
									<input type="hidden" name="b7_sum_t" value="<?=number_format($b7_sum_t)?>"/>
									<input type="hidden" name="b8_sum_t" value="<?=number_format($b8_sum_t)?>"/>
									<input type="hidden" name="b9_sum_t" value="<?=number_format($b9_sum_t)?>"/>
									<input type="hidden" name="b_sum_sum_t" value="<?=number_format($b_sum_sum_t)?>"/>

									<input type="hidden" name="v_sum_sum_t" value="<?=number_format($v_sum_sum_t)?>"/>

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
									<input type="hidden" name="tax_sum_sum_t" value="<?=number_format($tax_sum_sum_t)?>"/>

									<input type="hidden" name="gongje_sum_sum_t" value="<?=number_format($gongje_sum_sum_t)?>"/>

									<input type="hidden" name="money_total_sum_t" value="<?=number_format($money_total_sum_t)?>"/>
									<input type="hidden" name="money_result_sum_t" value="<?=number_format($money_result_sum_t)?>"/>

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
