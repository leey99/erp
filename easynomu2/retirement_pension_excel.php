<?
$sub_menu = "200452";
include_once("./_common.php");

//���� ����
//$now_year = date("Y");
$now_year = 2015;
$code = $com_code;

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

$sql_common = " from $g4[pibohum_base] a, pibohum_base_opt b ";

//echo $is_admin;
if($is_admin == "super") {
	$sql_search = " where 1=1 ";
} else {
	$sql_search = " where a.com_code='$com_code' ";
}
//�ɼ�DB join
$sql_search .= " and ( ";
$sql_search .= " (a.com_code = b.com_code and a.sabun = b.sabun) ";
$sql_search .= " ) ";
//ȭ��������κθ�ȸ : ������� ����
if($comp_print_type == "H") {
	if($kind == "beistand") {
		$sql_search .= " and ( b.position = '13' ) ";
		$title = "Ȱ��������";
	} else if($kind == "helper") {
		$sql_search .= " and ( b.position = '14' ) ";
		$title = "����";
	} else {
		$sql_search .= " and ( b.position != '13' and b.position != '14' ) ";
		$title = "�����";
	}
} else {
		$title = "�ٷ���";
}
// �˻� : �μ�
if ($stx_dept) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.dept = '$stx_dept') ";
	$sql_search .= " ) ";
}
//echo $stx_name;
// �˻� : ����
if ($stx_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.name like '%$stx_name%') ";
	$sql_search .= " ) ";
}
// �˻� : ���
if ($stx_sabun) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.sabun like '$stx_sabun%') ";
	$sql_search .= " ) ";
}
// �˻� : ä������
if ($stx_work_form) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.work_form = $stx_work_form) ";
	$sql_search .= " ) ";
}
// �˻� : ��濩��
//echo $stx_get_ok;
//exit;
if ($stx_get_ok == '0') {
	$sql_search .= " and ( ";
	$sql_search .= " (a.apply_gy = '$stx_get_ok') ";
	$sql_search .= " ) ";
} else if ($stx_get_ok == 1) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.apply_gy = '') ";
	$sql_search .= " ) ";
}
//�˻� : ��������
//if(!$stx_emp_stat) $stx_emp_stat = "0";
if(!$stx_emp_stat) $stx_emp_stat = "all";
if ($stx_emp_stat != "all") {
	$sql_search .= " and ( ";
	$sql_search .= " (a.gubun = '$stx_emp_stat') ";
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
		$sst = "a.com_code";
		$sod = "desc";
	} else {
		if($sort1) {
			if($sort1 == "in_day" || $sort1 == "name" || $sort1 == "work_form") $sst = "a.".$sort1;
			else $sst = "b.".$sort1;
			$sod = $sod1;
		} else {
			$sst = "b.position";
			$sod = "asc";
		}
	}
}
if (!$sst2) {
	if($sort2) {
		if($sort2 == "in_day" || $sort2 == "name" || $sort2 == "work_form") $sst2 = ", a.".$sort2;
		else $sst2 = ", b.".$sort2;
		$sod2 = $sod2;
	} else {
		$sst2 = ", a.in_day";
		$sod2 = "asc";
	}
}
if (!$sst3) {
	if($sort3) {
		if($sort3 == "in_day" || $sort3 == "name" || $sort3 == "work_form") $sst3 = ", a.".$sort3;
		else $sst3 = ", b.".$sort3;
		$sod3 = $sod3;
	} else {
		$sst3 = ", b.dept";
		$sod3 = "asc";
	}
}
if (!$sst4) {
	if($sort4) {
		if($sort4 == "in_day" || $sort4 == "name" || $sort4 == "work_form") $sst4 = ", a.".$sort4;
		else $sst4 = ", b.".$sort4;
		$sod4 = $sod4;
	} else {
		$sst4 = ", b.pay_gbn";
		$sod4 = "asc";
	}
}

$sql_order = " order by $sst $sod $sst2 $sod2 $sst3 $sod3 $sst4 $sod4 ";

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
//echo $sql;
$result = sql_query($sql);
$colspan = 12;

$now_date_file = date("Ymd");
$file_name = "��������_".$title."_".$now_date_file.".xls";
header("Pragma:");
header("Cache-Control:");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
header("Content-Description: PHP5 Generated Data");
?>
<style type="text/css">
table { font-size:10px; }
</style>
<table width='1200' border='1' cellspacing=1 cellpadding=3 bgcolor="#5B8398">
			<tr bgcolor="65CBFF" align=center>
				<td align="center" rowspan="2">��ȣ</td>
				<td align="center" rowspan="2">����</td>
<?
if($kind != "beistand" && $kind != "helper") {
?>
				<td align="center" rowspan="2">����</td>
				<td align="center" rowspan="2">�μ�</td>
<?
}
?>
				<td align="center" rowspan="2">�ֹε�Ϲ�ȣ</td>
				<td align="center" rowspan="2">������</td>
				<td align="center" rowspan="2">�Ի���</td>
				<td align="center" rowspan="2">�����</td>
				<td align="center" colspan="12">2012�⵵</td>
				<td align="center" colspan="12">2013�⵵</td>
				<td align="center" colspan="12">2014�⵵</td>
				<td align="center" colspan="12">2015�⵵</td>
				<td align="center" colspan="12">2016�⵵</td>
				<td align="center" rowspan="2">�Ѿ�</td>
				<td align="center" rowspan="2">�Ⱓ</td>
			</tr>
			<tr bgcolor="65CBFF" align=center>
<?
//������ �� ǥ��
for($y=($now_year-3);$y<=($now_year+1);$y++) {
?>
				<td align="center">1��</td>
				<td align="center">2��</td>
				<td align="center">3��</td>
				<td align="center">4��</td>
				<td align="center">5��</td>
				<td align="center">6��</td>
				<td align="center">7��</td>
				<td align="center">8��</td>
				<td align="center">9��</td>
				<td align="center">10��</td>
				<td align="center">11��</td>
				<td align="center">12��</td>
<?
}
?>
			</tr>
<?
// ����Ʈ ���
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $i + 1;
	$code = $row[com_code];
	$id = $row[sabun];
	//�ٷ��ڸ�
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
	//��� �߰� DB
	$sql2 = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
	$result2 = sql_query($sql2);
	$row2=mysql_fetch_array($result2);
	//����
	$position = " ";
	if($row2[position]) {
		$sql_position = " select * from com_code_list where item='position' and com_code = '$code' and code = $row2[position] ";
		//echo $sql_position;
		$result_position = sql_query($sql_position);
		$row_position = sql_fetch_array($result_position);
		$position = $row_position[name];
		if($position == "�ܽð��ٷ���") $position = "�ܽð�<br>�ٷ���";
	}
	//�μ�
	//$dept = $row2[dept_1];
	if($row2[dept]) {
		$sql_dept = " select * from com_code_list where item='dept' and com_code='$code' and code = $row2[dept] ";
		$result_dept = sql_query($sql_dept);
		$row_dept = sql_fetch_array($result_dept);
		$dept = $row_dept[name];
		if($dept == "������(����)") $dept = "������<br>(����)";
		else if($dept == "�Ⱦ�����(����)") $dept = "�Ⱦ�����<br>(����)";
		else if($dept == "������(�븮����)") $dept = "������<br>(�븮����)";
		else if($dept == "�Ⱦ�����(�븮����)") $dept = "�Ⱦ�����<br>(�븮����)";
	} else {
		$dept = "-";
	}
	//�ֹε�Ϲ�ȣ �� �ټ��ڸ� ��ǥ ó��
	$jumin_no = substr($row[jumin_no],0,9)."*";
	//������
	$now_date = date("Ymd");
	$jumin_date = "19".substr($row[jumin_no],0,9);
	$age_cal = ( $now_date - $jumin_date ) / 10000;
	$age = (int)$age_cal;
	//�ٷνð�
	$work_gbn = $row2[work_gbn];
	$sql_time = " select * from a4_work_time where com_code = '$code' and work_gbn = '$work_gbn' ";
	$result_time = sql_query($sql_time);
	$row_time = sql_fetch_array($result_time);
	$work_gbn_text = $row_time[work_gbn_text];
	if($work_gbn_text) $work_gbn_text = cut_str($work_gbn_text, 8, "..");
	//�޿�����
	if($row2[pay_gbn] == "0") $pay_gbn = "������";
	else if($row2[pay_gbn] == "1") $pay_gbn = "�ñ���";
	else if($row2[pay_gbn] == "2") $pay_gbn = "���ձٹ�";
	else if($row2[pay_gbn] == "3") $pay_gbn = "������";
	else if($row2[pay_gbn] == "4") $pay_gbn = "�ϱ���";
	else if($row2[pay_gbn] == "5") $pay_gbn = "����ҵ�";
	else $pay_gbn = "-";
	//�������� �Ѿ�
	$rp_sum_sum = 0;
	$rp_month = 0;
	for($y=($now_year-3);$y<=($now_year+1);$y++) {
		$sql_rp = " select sum(retirement_pension) as rp_sum from pibohum_base_pay_h where com_code='$code' and sabun='$id' and year='$y' ";
		//echo $sql_rp."<br />";
		$result_rp = sql_query($sql_rp);
		$row_rp = sql_fetch_array($result_rp);
		$rp_sum[$y] = $row_rp['rp_sum'];
		$rp_sum_sum += $rp_sum[$y];
		$sql_rp_month = " select retirement_pension, month from pibohum_base_pay_h where com_code='$code' and sabun='$id' and year='$y' ";
		$result_rp_month = sql_query($sql_rp_month);
		//�ش� ���� ���������� ���� ��츦 ���� �ʱ�ȭ
		for($k=1;$k<=12;$k++) {
			if($k < 10) $k = "0".$k;
			$rp_sum_month[$y][$k] = 0;
		}
		for($m=0; $row_rp_month=sql_fetch_array($result_rp_month); $m++) {
			//echo $row_rp_month['month']." ".$row_rp_month['retirement_pension']."<br />";
			$k = $row_rp_month['month'];
			$rp_sum_month[$y][$k] = number_format($row_rp_month['retirement_pension']);
			//echo $name." ".$y." ".$k." ".$row_rp_month['retirement_pension']."<br />";
			if($row_rp_month['retirement_pension'] > 0) $rp_month++;
		}
		//if($rp_sum[$y] > 0) echo $sql_rp."<br />";
	}
	//���� �Ⱓ
	$rp_year = (int)($rp_month/12);
	if($rp_year > 0) $rp_year = $rp_year."��";
	else $rp_year = "";
	$rp_month_text = $rp_month - ($rp_year*12)."����";
	$rp_month_text = "<span style='font-size:11px;'>".$rp_year.$rp_month_text."</span>";
	if(!$rp_month) $rp_month_text = "<span style='font-size:11px;'>-</span>";
?>
			<tr bgcolor="#FFFFFF" align=center>
				<td align="center"><?=$no?></td>
				<td align="center"><?=$name?></td>
<?
if($kind != "beistand" && $kind != "helper") {
?>
				<td align="center"><?=$position?></td>
				<td align="center"><?=$dept?></td>
<?
}
?>
				<td align="center"><?=$jumin_no?></td>
				<td align="center">�� <?=$age?></td>
				<td align="center"><?=$in_day?></td>
				<td align="center"><?=$out_day?></td>
<?
	for($y=($now_year-3);$y<=($now_year+1);$y++) {
?>
				<td align="center"><?=$rp_sum_month[$y]['01']?></td>
				<td align="center"><?=$rp_sum_month[$y]['02']?></td>
				<td align="center"><?=$rp_sum_month[$y]['03']?></td>
				<td align="center"><?=$rp_sum_month[$y]['04']?></td>
				<td align="center"><?=$rp_sum_month[$y]['05']?></td>
				<td align="center"><?=$rp_sum_month[$y]['06']?></td>
				<td align="center"><?=$rp_sum_month[$y]['07']?></td>
				<td align="center"><?=$rp_sum_month[$y]['08']?></td>
				<td align="center"><?=$rp_sum_month[$y]['09']?></td>
				<td align="center"><?=$rp_sum_month[$y]['10']?></td>
				<td align="center"><?=$rp_sum_month[$y]['11']?></td>
				<td align="center"><?=$rp_sum_month[$y]['12']?></td>
<?
	}
?>
				<td align="right"><?=number_format($rp_sum_sum)?></td>
				<td align="right"><?=$rp_month_text?></td>
			</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
?>
</table>
<?
exit;
?>

