<?
$sub_menu = "400100";
include_once("./_common.php");

$sql_common = " from pibohum_base_pay ";

$sql_a4 = " select * from $g4[com_list_gy] where com_code = '$code' ";
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

//�����
if($w_date) $sql_search .= " and w_date='$w_date' ";
//��Ͻ�
if($w_time) $sql_search .= " and w_time='$w_time' ";

//�����޾� 0�� ��� ���� 160331
$sql_search .= " and money_result > 0 ";

$sql_order = " order by dept_code asc, position asc, in_day asc ";
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

$file_name = $com_name."_�޿�����_".$search_year."_".$search_month.".xls";
header("Pragma:");
header("Cache-Control:");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
header("Content-Description: PHP5 Generated Data");

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

// ����Ʈ ���
$pay_page = ceil($rows / 6);
//echo $pay_page;
for($i=1;$i<=$pay_page;$i++) {
	$w_day_sum[$i] = 0;
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

	//���
	$employee_no = $row_sabun['employee_no'];

	//�ٷνð�
	$w_sum = $row[workhour_total];

	//���°��� �ð�
	$w_late = $row['w_late'];
	$w_leave = $row['w_leave'];
	$w_out = $row['w_out'];
	$w_absence = $row['w_absence'];
	$w_etc = $w_late + $w_leave + $w_out + $w_absence;

	//����ӱݼ���
	$g_sum = $row[g1] + $row[g2] + $row[g3] + $row[g4] + $row[g5];

	//��������
	$s_sum = $row[ext] + $row[ext_add] + $row[night] + $row[hday] + $row[annual_paid_holiday]  + $row[money_period];

	//��Ÿ����
	$b_sum = $row[b1] + $row[b2] + $row[b3] + $row[b4] + $row[b5] + $row[b6] + $row[b7] + $row[b8] + $row[b9];

	//�����հ�
	//$m_sum = $row['tax_so'] + $row['tax_jumin'] + $row['health'] + $row['yoyang'] + $row['yun'] + $row['goyong'] + $row['minus'];
	$m_sum = $row['money_gongje'];
?>
<table border="1" cellspacing="1" cellpadding="3">
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
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "���")?></td>
		<td align="center" colspan="2"><?=iconv("EUC-KR", "UTF-8", $employee_no)?></td>
	</tr>
	<tr>
		<td align="center" colspan="7"><strong><?=iconv("EUC-KR", "UTF-8", "�޿�����")?></strong></td>
	</tr>
	<tr>
		<td align="center" rowspan=""><?=iconv("EUC-KR", "UTF-8", "�⺻��")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "���ñ�")?></td>
		<td align="center"><?=number_format($row['money_min_base'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "�⺻��")?></td>
		<td align="center"><?=number_format($row['money_month'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
	</tr>
	<tr>
		<td align="center" rowspan="4" ><?=iconv("EUC-KR", "UTF-8", "<br />�ٷ�<br />�ð�")?></td>
		<td align="center" colspan="6"><strong><?=iconv("EUC-KR", "UTF-8", "�������ٷνð�")?></strong></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "�⺻�ٷ�")?></td>
		<td align="center"><?=$row['w_day']?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "�ð�")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "����ٷ�")?></td>
		<td align="center"><?=$row['w_ext']?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "�ð�")?></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "�߰��ٷ�")?></td>
		<td align="center"><?=$row['w_night']?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "�ð�")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "���ϱٷ�")?></td>
		<td align="center"><?=$row['w_hday']?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "�ð�")?></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "���°���")?></td>
		<td align="center"><?=$w_etc?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "�ð�")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "�Ұ�")?></td>
		<td align="center"><?=number_format($w_sum)?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "�ð�")?></td>
	</tr>
	<tr>
		<td align="center" rowspan="3" ><?=iconv("EUC-KR", "UTF-8", "���<br />�ӱ�<br />����")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $money_g_txt['g1'])?></td>
		<td align="center"><?=number_format($row['g1'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $money_g_txt['g4'])?></td>
		<td align="center"><?=number_format($row['g4'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $money_g_txt['g2'])?></td>
		<td align="center"><?=number_format($row['g2'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $money_g_txt['g5'])?></td>
		<td align="center"><?=number_format($row['g5'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $money_g_txt['g3'])?></td>
		<td align="center"><?=number_format($row['g3'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
	</tr>
	<tr>
		<td align="center" rowspan="3" ><?=iconv("EUC-KR", "UTF-8", "����<br />����")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "�⺻����")?></td>
		<td align="center"><?=number_format($row['ext'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��������")?></td>
		<td align="center"><?=number_format($row['annual_paid_holiday'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "�߰��ٷ�")?></td>
		<td align="center"><?=number_format($row['night'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "���ϱٷ�")?></td>
		<td align="center"><?=number_format($row['hday'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
	</tr>
	<tr>
		<td align="center" rowspan="2" ><?=iconv("EUC-KR", "UTF-8", "��Ÿ<br />(�����)")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $money_e_txt['e1'])?></td>
		<td align="center"><?=number_format($row['b1'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $money_e_txt['e3'])?></td>
		<td align="center"><?=number_format($row['b3'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $money_e_txt['e2'])?></td>
		<td align="center"><?=number_format($row['b2'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
	</tr>
	<tr>
		<td align="center" rowspan="3" ><?=iconv("EUC-KR", "UTF-8", "��Ÿ<br />(����)")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $money_e_txt['e4'])?></td>
		<td align="center"><?=number_format($row['b4'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $money_e_txt['e6'])?></td>
		<td align="center"><?=number_format($row['b6'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $money_e_txt['e5'])?></td>
		<td align="center"><?=number_format($row['b5'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $money_e_txt['e7'])?></td>
		<td align="center"><?=number_format($row['b7'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $money_e_txt['e8'])?></td>
		<td align="center"><?=number_format($row['b8'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $money_e_txt['e9'])?></td>
		<td align="center"><?=number_format($row['b9'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��Ÿ")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "������")?></td>
		<td align="center"><?=number_format($row['etc'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
	</tr>
	<tr>
		<td align="center" colspan="5"><strong><?=iconv("EUC-KR", "UTF-8", "�ӱݰ�")?></strong></td>
		<td align="center"><?=number_format($row['money_total'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
	</tr>
	<tr>
		<td align="center" colspan="5"><strong><?=iconv("EUC-KR", "UTF-8", "�����ҵ�")?></strong></td>
		<td align="center"><?=number_format($row['money_for_tax'])?></td>
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
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "���°���")?></td>
		<td align="center">
<?
	if($row['etc2']) {
		//���°��� ���̳ʽ� ǥ�� 160224 -> �÷��� ǥ�� 160503
		//echo "-".number_format($row['etc2']);
		echo number_format($row['etc2']);
	} else {
		echo "0";
	}
?>
		</td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
	</tr>
	<tr>
		<td align="center" colspan="5"><strong><?=iconv("EUC-KR", "UTF-8", "�����Ѿ�")?></strong></td>
		<td align="center"><?=number_format($m_sum)?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
	</tr>
	<tr>
		<td align="center" colspan="5"><strong><?=iconv("EUC-KR", "UTF-8", "�������Ѿ�")?></strong></td>
		<td align="center"><?=number_format($row['money_result'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
	</tr>
</table>
<br />
<?
}
?>		
</body>
</html>
