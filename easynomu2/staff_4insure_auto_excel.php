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
          $sql_order ";
echo $sql;
$result = sql_query($sql);
$colspan = 14;

$file_name = $sub_title.".xls";
header("Pragma:");
header("Cache-Control:");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
header("Content-Description: PHP5 Generated Data");
?>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:x="urn:schemas-microsoft-com:office:excel">
<table width="1200" border="1" cellspacing="1" cellpadding="3">
	<tr>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "����")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "����")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "�ֹε�Ϲ�ȣ")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "�Ի���<br />�����")?></td>
		<td bgcolor="#65CBFF" align="center"><strong><?=$search_year_pre3.".".$search_month_pre3?></strong>)<br />(<strong><?=$search_year_pre2.".".$search_month_pre2?></strong></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
		<td bgcolor="#65CBFF" align="center"><strong><?=$search_year_pre.".".$search_month_pre?></strong>)<br />(<strong><?=$search_year.".".$search_month?></strong></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "��")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "�Ű���")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "���濬��")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "�Ű���")?></td>
	</tr>
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
	<tr>
		<td align="center"><?=$staff_count?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $name)?></td>
		<td align="center"><?=$jumin_no?></td>
		<td align="center"><?=$in_day?><br /><span style="color:red"><?=$out_day?></span></td>
		<td align="center"><?=number_format($money_month_pre3)?><br /><?=number_format($money_month_pre2)?></td>
		<td align="center"><?=$workhour_total_pre3?><br /><?=$workhour_total_pre2?></td>
		<td align="center"><?=number_format($money_month_pre)?><br /><?=number_format($money_month)?></td>
		<td align="center"><?=$workhour_total_pre?><br /><?=$workhour_total?></td>
		<td align="center" style="<?=$reason_style?>"><?=iconv("EUC-KR", "UTF-8", $modify_reason)?></td>
		<td align="center"><?=$modify_year_month?></td>
		<td align="center">
			<? if($row['apply_gy'] == "0") echo iconv("EUC-KR", "UTF-8", "���"); ?>
			<? if($row['apply_sj'] == "0") echo iconv("EUC-KR", "UTF-8", "����"); ?>
			<? if($apply_km_checked) echo iconv("EUC-KR", "UTF-8", "����"); ?>
			<? if($row['apply_gg'] == "0") echo iconv("EUC-KR", "UTF-8", "�ǰ�"); ?>
		</td>
	</tr>
<?
	}
}
?>
</table>
</body>
</html>


