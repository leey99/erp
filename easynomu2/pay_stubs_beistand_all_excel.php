<?
$sub_menu = "400100";
include_once("./_common.php");

//guest id
if($member['mb_id'] == "guest") {
	$member['mb_id'] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$sql_common = " from pibohum_base_pay_h ";

$sql_a4 = " select * from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4['com_code'];
$com_name = $row_a4['com_name'];

$sql_a4_opt = " select * from com_list_gy_opt where com_code = '$com_code' ";
$row_a4_opt = sql_fetch($sql_a4_opt);

$sub_title = "�޿�����";
$g4['title'] = $sub_title." : ������� : ".$easynomu_name;

$colspan = 11;

//�⵵, �� ����
if(!$search_year) $search_year = date("Y");
if(!$search_month) $search_month = date("m");

//�޿�����
$sql_search = " where com_code='$com_code' and year = '$search_year' and month = '$search_month' ";
$sql_order = " order by name asc ";
$from_record = 0;
//$rows = 7;

//�޿����� �ٷ��ڼ�
$sql = " select count(*) as cnt
          $sql_common
          $sql_search ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
//echo $total_count;
$rows = $total_count;
$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);

$file_name = $com_name."_Ȱ��������_�޿�����_".$search_year."_".$search_month.".xls";
header("Pragma:");
header("Cache-Control:");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
header("Content-Description: PHP5 Generated Data");

//�ð��� �޿� �ܰ� ���� DB
$start_date = $search_year.".".$search_month.".01";
$end_date = $search_year.".".$search_month.".31";
$where_time = " and end_date >= '$start_date' and start_date <= '$end_date' ";
$sql_time = " select * from com_list_gy_time where com_code='$com_code' $where_time ";
//echo $sql_time;
$result_time = sql_query($sql_time);
$row_time = mysql_fetch_array($result_time);
//type h ���Ǻ���, ��⵵, ȭ����(���,�޽�), �����ð�, ����Ʈ��
$money_time1 = $row_time['money_time1'];
$money_time1_hday = $row_time['money_time1_hday'];
$money_time2 = $row_time['money_time2'];
$money_time2_hday = $row_time['money_time2_hday'];
$money_time3 = $row_time['money_time3'];
$money_time3_hday = $row_time['money_time3_hday'];
$money_time1_com = $row_time['money_time1_com'];
$money_time1_hday_com = $row_time['money_time1_hday_com'];
$money_time2_com = $row_time['money_time2_com'];
$money_time2_hday_com = $row_time['money_time2_hday_com'];
$money_time3_com = $row_time['money_time3_com'];
$money_time3_hday_com = $row_time['money_time3_hday_com'];
$money_time_edu = $row_time['money_time_edu'];
$money_time_phone = $row_time['money_time_phone'];

// ����Ʈ ���
$pay_page = ceil($rows / 6);
//echo $pay_page;
for($i=1;$i<=$pay_page;$i++) {
	$w_day_sum[$i] = 0;
}

//������, �̳����� �ų� 4�� ǥ��, �켱 2016�⸸ ���� / ȭ��������κθ�ȸ ������ ���� ��û 160512
if($com_code == 20399 && $search_year == 2016 && $search_month == "04") {
	$a2_text = "������";
	$m2_text = "�̳�����";
} else {
	$a2_text = "";
	$m2_text = "";
}
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//������ ������ ����ó��
	if(!$row['in_day']) $row['in_day'] = "-";
	if(!$row['out_day']) $row['out_day'] = "-";
	//�ֹε�Ϲ�ȣ
	$sql_sabun = " select * from pibohum_base where com_code='$row[com_code]' and sabun='$row[sabun]' ";
	$result_sabun = sql_query($sql_sabun);
	$row_sabun = mysql_fetch_array($result_sabun);
	if($row_sabun['jumin_no']) {
		$ssnb_txt = $row_sabun['jumin_no'];
	} else {
		$ssnb_txt = " ";
	}
	//��å
	$position_txt = $row['position_txt'];
	//�Ի���
	$in_day_array = explode(".", $row['in_day']);
	$in_day = $in_day_array[0]."�� ".$in_day_array[1]."�� ".$in_day_array[2]."��";
	//�ٷνð�
	$w_sum = $row['workhour_total'];
	$w_1_s = $row['w_1'] + $row['w_1_hday'];
	$w_2_s = $row['w_2'] + $row['w_2_hday'];
	$w_3_s = $row['w_3'] + $row['w_3_hday'];
	//����������
	if($row['annual_paid_holiday'] == "") $row['annual_paid_holiday'] = 0;

	//������, �̳����� / ���� �߰��� DB Table ȣ�� 160512
	if($com_code == 20399 && $search_year == 2016 && $search_month == "04") {
		$sql_fee = " select * from performance_fee where com_code='$row[com_code]' and sabun='$row[sabun]' and year='$search_year' and month='$search_month' ";
		$result_fee = sql_query($sql_fee);
		$row_fee = mysql_fetch_array($result_fee);
		$a2 = number_format($row_fee['a2']);
		$m2 = number_format($row_fee['m2']);
		$a_sum = $row['annual_paid_holiday'] + (int)$row_fee['a2'];
		$m_sum = $row['tax_so'] + $row['tax_jumin'] + $row['health'] + $row['yoyang'] + $row['yun'] + $row['goyong'] + $row['minus'] + (int)$row_fee['m2'];
		$money_for_tax = $row['money_for_tax'] + (int)$row_fee['a2'];
		$money_result = $money_for_tax - $m_sum;
	} else {
		$a2 = "";
		$m2 = "";
		//��Ÿ �Ұ�
		$a_sum = $row['annual_paid_holiday'];
		//�����հ�
		$m_sum = $row['tax_so'] + $row['tax_jumin'] + $row['health'] + $row['yoyang'] + $row['yun'] + $row['goyong'] + $row['minus'];
		//�޿��Ѿ�
		$money_for_tax = $row['money_for_tax'];
		//�������Ѿ�
		$money_result = $row['money_result'];
	}
	//�޿�����
	$w_1_pay = ($row['w_1']*$money_time1) + ($row['w_1_hday']*$money_time1_hday);
	$w_2_pay = ($row['w_2']*$money_time2) + ($row['w_2_hday']*$money_time2_hday);
	$w_3_pay = ($row['w_3']*$money_time3) + ($row['w_3_hday']*$money_time3_hday);
	//�����հ�(�����)
	$c_m_sum = $row['c_health'] + $row['c_yoyang'] + $row['c_yun'] + $row['c_goyong'] + $row['c_sanjae'];
	//��������
	$retirement_pension = $row['retirement_pension'];
	//�Ѱ�
	$money_total_sum = $money_total_sum + $row['money_total'];
	$w_sum_sum = $w_sum_sum + $w_sum;
	$w_1_s_sum += $w_1_s;
	$w_2_s_sum += $w_2_s;
	$w_3_s_sum += $w_3_s;
	$w_1_sum = $w_1_sum + $row['w_1'];
	$w_2_sum = $w_2_sum + $row['w_2'];
	$w_3_sum = $w_3_sum + $row['w_3'];
	$w_1_hday_sum = $w_1_hday_sum + $row['w_1_hday'];
	$w_2_hday_sum = $w_2_hday_sum + $row['w_2_hday'];
	$w_3_hday_sum = $w_3_hday_sum + $row['w_3_hday'];
	$w_edu_sum = $w_edu_sum + $row['w_edu'];
	$w_phone_sum = $w_phone_sum + $row['w_phone'];
	$annual_paid_holiday_sum = $annual_paid_holiday_sum + $row['annual_paid_holiday'];
	$money_for_tax_sum = $money_for_tax_sum + $money_for_tax;
	$w_1_pay_sum += $w_1_pay;
	$w_2_pay_sum += $w_2_pay;
	$w_3_pay_sum += $w_3_pay;
	//���ټ� ��ȸ���� �����հ�
	$tax_so_sum = $tax_so_sum + $row['tax_so'];
	$tax_jumin_sum = $tax_jumin_sum + $row['tax_jumin'];
	$yun_sum = $yun_sum + $row['yun'];
	$health_sum = $health_sum + $row['health'];
	$yoyang_sum = $yoyang_sum + $row['yoyang'];
	$goyong_sum = $goyong_sum + $row['goyong'];
	$m_sum_sum += $m_sum;
	$money_result_sum = $money_result_sum + $money_result;
	//��ȸ����(�����)
	$c_yun_sum = $c_yun_sum + $row['c_yun'];
	$c_health_sum = $c_health_sum + $row['c_health'];
	$c_yoyang_sum = $c_yoyang_sum + $row['c_yoyang'];
	$c_goyong_sum = $c_goyong_sum + $row['c_goyong'];
	$c_sanjae_sum = $c_sanjae_sum + $row['c_sanjae'];
	$c_m_sum_sum += $c_m_sum;
	$retirement_pension_sum += $retirement_pension_sum;

	//�ٷ��� ���� ���� �� ǥ�� 160122
	if($row['name']) {
?>
<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">
<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 14">
<link rel=File-List href=filelist.xml>
<link rel=Stylesheet href=stylesheet.css>
<style>
<!--table
	{mso-displayed-decimal-separator:"\.";
	mso-displayed-thousand-separator:"\,";}
@page
	{margin:.4in .25in .37in .25in;
	mso-header-margin:.3in;
	mso-footer-margin:.3in;
	mso-page-orientation:landscape;}
ruby
	{ruby-align:left;}
rt
	{color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"���� ���", monospace;
	mso-font-charset:129;
	mso-char-type:none;
	display:none;}
-->
</style>
</head>
<body>
<table border="1" cellspacing="1" cellpadding="3" style='border-collapse:collapse;table-layout:fixed;width:1110pt'>
	<tr>
		<td align="center" colspan="7"><strong>( <?=iconv("EUC-KR", "UTF-8", $row['name'])?> ) <?=$search_year?><?=iconv("EUC-KR", "UTF-8", "��")?> <?=$search_month?><?=iconv("EUC-KR", "UTF-8", "�� �޿�����")?></strong></td>
	</tr>
	<tr>
		<td align="center" rowspan="2"><?=iconv("EUC-KR", "UTF-8", "����")?></td>
		<td align="center" rowspan="2" colspan="3"><?=iconv("EUC-KR", "UTF-8", $row['name'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��å")?></td>
		<td align="center" colspan="2"><?=iconv("EUC-KR", "UTF-8", $position_txt)?></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "�Ի���")?></td>
		<td align="center" colspan="2"><?=iconv("EUC-KR", "UTF-8", $in_day)?></td>
	</tr>
	<tr>
		<td align="center" colspan="7"><strong><?=iconv("EUC-KR", "UTF-8", "�޿�����")?></strong></td>
	</tr>
	<tr>
		<td align="center" rowspan="2"><?=iconv("EUC-KR", "UTF-8", "�⺻<br />�ñ�")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "���ϱٹ�")?></td>
		<td align="center"><?=number_format($money_time1)?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "���Ͻɾ�")?></td>
		<td align="center"><?=number_format($money_time1_hday)?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "�����ð�")?></td>
		<td align="center"><?=number_format($money_time_edu)?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "����Ʈ��")?></td>
		<td align="center"><?=number_format($money_time_phone)?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
	</tr>
	<tr>
		<td align="center" rowspan="9" ><?=iconv("EUC-KR", "UTF-8", "<br /><br /><br /><br />�ٷ�<br />�ð�")?></td>
		<td align="center" colspan="6"><strong><?=iconv("EUC-KR", "UTF-8", "���Ǻ���")?></strong></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "���ϱٹ�")?></td>
		<td align="center"><?=$row['w_1']?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "�ð�")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "���Ͻɾ�")?></td>
		<td align="center"><?=$row['w_1_hday']?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "�ð�")?></td>
	</tr>
	<tr>
		<td align="center" colspan="6"><strong><?=iconv("EUC-KR", "UTF-8", "��⵵")?></strong></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "���ϱٹ�")?></td>
		<td align="center"><?=$row['w_2']?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "�ð�")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "���Ͻɾ�")?></td>
		<td align="center"><?=$row['w_2_hday']?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "�ð�")?></td>
	</tr>
	<tr>
		<td align="center" colspan="6"><strong><?=iconv("EUC-KR", "UTF-8", "ȭ����")?></strong></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "���ϱٹ�")?></td>
		<td align="center"><?=$row['w_3']?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "�ð�")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "���Ͻɾ�")?></td>
		<td align="center"><?=$row['w_3_hday']?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "�ð�")?></td>
	</tr>
	<tr>
		<td align="center" colspan="3"></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "�Ұ�")?></td>
		<td align="center"><?=$w_sum?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "�ð�")?></td>
	</tr>
	<tr>
		<td align="center" colspan="6"><strong><?=iconv("EUC-KR", "UTF-8", "��Ÿ")?></strong></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "�����ð�")?></td>
		<td align="center"><?=$row['w_edu']?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "�ð�")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "����Ʈ��")?></td>
		<td align="center"><?=$row['w_phone']?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "�ð�")?></td>
	</tr>
	<tr>
		<td align="center" rowspan="2" ><?=iconv("EUC-KR", "UTF-8", "��Ÿ")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "����������")?></td>
		<td align="center"><?=number_format($row['annual_paid_holiday'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $a2_text)?></td>
		<td align="center"><?=$a2?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
	</tr>
	<tr>
		<td align="center" colspan="3"></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "�Ұ�")?></td>
		<td align="center"><?=number_format($a_sum)?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
	</tr>
	<tr>
		<td align="center" colspan="5"><strong><?=iconv("EUC-KR", "UTF-8", "�޿��Ѿ�")?></strong></td>
		<td align="center"><?=number_format($money_for_tax)?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
	</tr>
	<tr>
		<td align="center" colspan="7"><strong><?=iconv("EUC-KR", "UTF-8", "��������")?></strong></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "����")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "�ҵ漼")?></td>
		<td align="center"><?=number_format($row['tax_so'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "�ֹμ�")?></td>
		<td align="center"><?=number_format($row['tax_jumin'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
	</tr>
	<tr>
		<td align="center" rowspan="2"><?=iconv("EUC-KR", "UTF-8", "4��<br />����")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "���ο���")?></td>
		<td align="center"><?=number_format($row['yun'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��뺸��")?></td>
		<td align="center"><?=number_format($row['goyong'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "�ǰ�����")?></td>
		<td align="center"><?=number_format($row['health'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "�����")?></td>
		<td align="center"><?=number_format($row['yoyang'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��Ÿ")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��Ÿ����")?></td>
		<td align="center"><?=number_format($row['minus'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $m2_text)?></td>
		<td align="center"><?=$m2?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
	</tr>
	<tr>
		<td align="center" colspan="5"><strong><?=iconv("EUC-KR", "UTF-8", "�����Ѿ�")?></strong></td>
		<td align="center"><?=number_format($m_sum)?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
	</tr>
	<tr>
		<td align="center" colspan="5"><strong><?=iconv("EUC-KR", "UTF-8", "�������Ѿ�")?></strong></td>
		<td align="center"><?=number_format($money_result)?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
	</tr>
<?
//ȭ��������������ڸ���Ȱ�������� ��Ī �ϴ� ��� 161018 
if($code == 20627) {
?>
	<tr>
		<td align="center" colspan="5"><strong><?=iconv("EUC-KR", "UTF-8", "��������")?></strong></td>
		<td align="center"><?=number_format($retirement_pension)?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
	</tr>
	<tr>
		<td align="center" colspan="5" height="70"><strong><?=iconv("EUC-KR", "UTF-8", "ȭ��������������ڸ���Ȱ��������")?></strong></td>
		<td colspan="2"><img src="http://easynomu.com/easynomu2/files/seal/20627_pay_stubs.png" width="90" height="70" /></td>
	</tr>
<?
}
?>	
</table>
<br />
<?
	}
}
?>		
</body>
</html>
