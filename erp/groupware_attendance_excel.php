<?
$sub_menu = "700200";
include_once("./_common.php");

//���� ����
$year_now = date("Y");
//���� ��
$month_now = date("m");

$sql_common = " from a4_manage ";
$sql_search = " where item='manage' ";
//����
if(!$stx_year) $stx_year = $year_now;
//��
if(!$stx_month) $stx_month = $month_now;
//��������
if(!$search_state) $search_state = 1;
if($search_state) {
	$sql_search .= " and state='$search_state'  ";
}
//���� ����
if($member['mb_level'] == 6) $search_belong = $member['mb_profile'];
//���� ������ ǥ�� 1600304
else if(!$search_belong) $search_belong = 1;
//�Ҽ�
if($search_belong) {
	if($search_belong != "all") $sql_search .= " and belong = '$search_belong' ";
}
//�μ�
if($search_dept) $sql_search .= " and dept_code = '$search_dept' ";
//�˻� : ����ڸ�
if($search_cust_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (name like '%$search_cust_name%') ";
	$sql_search .= " ) ";
}
//�˻� : ������ȭ
if($search_cust_tel) {
	$sql_search .= " and ( ";
	$sql_search .= " (tel like '%$search_cust_tel%') ";
	$sql_search .= " ) ";
}
//�˻� : �ѽ�
if($search_cust_fax) {
	$sql_search .= " and ( ";
	$sql_search .= " (fax like '%$search_cust_fax%') ";
	$sql_search .= " ) ";
}
//�˻� : �޴���
if($search_cust_hp) {
	$sql_search .= " and ( ";
	$sql_search .= " (hp like '%$search_cust_hp%') ";
	$sql_search .= " ) ";
}
//����, ��������, �Ҽ�, �μ� 160304, ����
$sql_order = " order by state asc, belong asc, dept_code asc, p_code asc ";
//ī��Ʈ
$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

//���� : ������ 20�� / 100�� / ��ü
if ($stx_count) {
	if($stx_count == "all") $rows = 999;
	else $rows = $stx_count;
} else {
	$rows = 20;
}

$total_page  = ceil($total_count / $rows);  // ��ü ������ ���
if(!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����
$sql = " select * $sql_common $sql_search $sql_order limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);

$file_name = "������Ȳ_".$stx_year."_".$stx_month.".xls";
header("Pragma:");
header("Cache-Control:");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
header("Content-Description: PHP5 Generated Data");
?>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:x="urn:schemas-microsoft-com:office:excel">
<?
//�ش� �� ���� 160307
$stx_month_last_day = date("t", mktime(0, 0, 0, $stx_month, 1, $stx_year));
?>
<table width="1200" border="1" cellspacing="1" cellpadding="3">
	<tr>
		<td align="left" colspan="38"><?=$stx_year?><?=iconv("EUC-KR", "UTF-8", "��")?> <?=$stx_month?><?=iconv("EUC-KR", "UTF-8", "�� ������Ȳ")?></td>
	</tr>
	<tr>
		<td bgcolor="#65CBFF" align="center" rowspan="2"><?=iconv("EUC-KR", "UTF-8", "No")?></td>
		<td bgcolor="#65CBFF" align="center" rowspan="2"><?=iconv("EUC-KR", "UTF-8", "�μ�")?></td>
		<td bgcolor="#65CBFF" align="center" rowspan="2"><?=iconv("EUC-KR", "UTF-8", "����ڸ�")?></td>
		<td bgcolor="#65CBFF" align="center" rowspan="2"><?=iconv("EUC-KR", "UTF-8", "����")?></td>
		<td bgcolor="#65CBFF" align="center" rowspan="2"><?=iconv("EUC-KR", "UTF-8", "���̵�")?></td>
		<td bgcolor="#65CBFF" align="center" colspan="<?=$stx_month_last_day?>"><?=$stx_year?><?=iconv("EUC-KR", "UTF-8", "��")?> <?=$stx_month?><?=iconv("EUC-KR", "UTF-8", "�� ������Ȳ")?></td>
		<td bgcolor="#65CBFF" align="center" rowspan="2"><?=iconv("EUC-KR", "UTF-8", "����")?></td>
		<td bgcolor="#65CBFF" align="center" rowspan="2"><?=iconv("EUC-KR", "UTF-8", "���")?></td>
	</tr>
	<tr>
<?
//�ش� �� ���� ǥ�� 160304
for($m=1;$m<=$stx_month_last_day;$m++) {
	//���� ȸ�� ó��
	if($m < 10) $m = "0".$m;
	$this_date = $stx_year."-".$stx_month."-".$m;
	//���� ������, ������
	if($this_date == "2016-03-01") $hday_color[$m] = "background:#f1f1f1;";
	//��̳�
	if($this_date == "2016-05-05") $hday_color[$m] = "background:#f1f1f1;";
	//������
	if($this_date == "2016-06-06") $hday_color[$m] = "background:#f1f1f1;";
	//������
	if($this_date == "2016-08-15") $hday_color[$m] = "background:#f1f1f1;";
	//�ش� �� ���� ����
	$yoil_chk = date("w", strtotime($this_date));
	if($yoil_chk == 6 || $yoil_chk == 0) {
		if($yoil_chk == 6) {
			$yoil_style = "background:#E6F2FF;"; //�����
		} else if($yoil_chk == 0) {
			$yoil_style = "background:#FFEEFF;"; //�Ͽ���
		}
		//�ش� �� ��/�� ���� ǥ�� 160307
		$hday_color[$m] = $yoil_style;
	} else {
		//$hday_color[$m] = "";
		$yoil_style = "background:#65CBFF;";
	}
?>
		<td align="center" style="<?=$yoil_style?>" width="50"><?=$m?></td>
<?
}
?>
	</tr>
<?
//���� üũ
$week_array = array("��", "��", "ȭ", "��", "��", "��", "��");
// ����Ʈ ���
for ($i=0; $row=mysql_fetch_assoc($result); $i++) {
	$no = $i + 1;
	//echo $total_count;
  $list = $i%2;
	if($row['state'] == 1) {
		$state = "����";
	} else {
		$state = "����";
	}
	$code = $row['code'];
	//�μ�
	$dept_code = $row['dept_code'];
	$dept_text = $dept_code_arry[$dept_code];
	//���̵�
	$user_id = $row['user_id'];
	//������ ȸ�� �� ǥ��
	if($row['state'] == 2) {
		$tr_class = "list_row_now_gr";
	} else {
		$tr_class = "list_row_now_wh";
	}
	//������Ȳ
	$sql_attendance = " select * from work_go_leave where user_id='$user_id' and date_format(check_time,'%Y-%m')='$stx_year-$stx_month' ";
	//echo $sql_attendance."<br />";
	$result_attendance = sql_query($sql_attendance);
	for($att=0; $row_attendance=sql_fetch_array($result_attendance); $att++) {
		//$att_user_id[$att] = $row_attendance['user_id'];
		$att_type = $row_attendance['type'];
		$att_memo = $row_attendance['memo'];
		$att_check_time[$user_id][$att] = $row_attendance['check_time'];
		$att_check_day = substr($att_check_time[$user_id][$att], 8, 2);
		//$att_check_time[$user_id][$att_check_day] = $att_check_time[$user_id][$att];
		if($att_type == 1) $att_check_in[$user_id][$att_check_day] = $att_check_time[$user_id][$att];
		if($att_type == 2) $att_check_out[$user_id][$att_check_day] = $att_check_time[$user_id][$att];
		//echo $att_type." ";
		if($att_type >= 3) {
			$att_check_type[$user_id][$att_check_day] = $att_type;
			$att_check_memo[$user_id][$att_check_day] = $att_memo;
		}
	}
?>
	<tr>
		<td align="center" rowspan="2"><?=$no?></td>
		<td align="center" rowspan="2"><?=iconv("EUC-KR", "UTF-8", $dept_text)?></td>
		<td align="center" rowspan="2"><?=iconv("EUC-KR", "UTF-8", $row['name'])?></td>
		<td align="center" rowspan="2"><?=iconv("EUC-KR", "UTF-8", $row['position'])?></td>
		<td align="center" rowspan="2"><?=$row['user_id']?></td>
<?
	for($m=1;$m<=$stx_month_last_day;$m++) {
		if($m < 10) $m = "0".$m;
		$att_day[$m] = "";
		$att_in[$m] = "";
		$att_out[$m] = "";
		if($att_check_in[$user_id][$m]) {
			$att_day[$m] = "O";
			//$att_in[$m] = substr($att_check_in[$user_id][$m], 11, 8);
			$att_in[$m] = substr($att_check_in[$user_id][$m], 11, 5);
		}
		if($att_check_out[$user_id][$m]) {
			//$att_out[$m] = substr($att_check_out[$user_id][$m], 11, 8);
			$att_out[$m] = substr($att_check_out[$user_id][$m], 11, 5);
		}
		//if($att_check_time[$att] = )
		if($att_check_type[$user_id][$m] >= 3) {
			if($att_check_type[$user_id][$m] == 3) $att_in[$m] = "����";
			else if($att_check_type[$user_id][$m] == 4) $att_in[$m] = "���";
			else if($att_check_type[$user_id][$m] == 5) $att_in[$m] = "����";
			else if($att_check_type[$user_id][$m] == 6) $att_in[$m] = "����";
		}
?>
		<td align="center" style="<?=$hday_color[$m]?>" x:str><?=iconv("EUC-KR", "UTF-8", $att_in[$m])?></td>
<?
	}
?>
		<td align="center" rowspan="2"><?=iconv("EUC-KR", "UTF-8", $state)?></td>
		<td align="center" rowspan="2"><?=iconv("EUC-KR", "UTF-8", $memo)?></td>
	</tr>
	<tr>
<?
	for($m=1;$m<=$stx_month_last_day;$m++) {
		if($m < 10) $m = "0".$m;
?>
		<td align="center" style="<?=$hday_color[$m]?>" x:str><?=$att_out[$m]?></td>
<?
	}
?>
	</tr>
<?
}
?>
</table>
</body>
</html>
