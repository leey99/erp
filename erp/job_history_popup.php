<?
$sub_menu = "1700100";
include_once("./_common.php");
$sql_common = " from job_history ";

//echo $member[mb_profile];
if($is_admin != "super") {
	$stx_man_cust_name = $member['mb_profile'];
}
$is_admin = "super";
//echo $is_admin;
$sql_search = " where com_code='$id' ";

if (!$sst) {
    $sst = "idx";
    $sod = "desc";
}

$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$sub_title = "������Ʒ� ó����Ȳ �̷�";
$g4[title] = $sub_title." : ������Ʒ� : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
//echo $sql;
$result = sql_query($sql);
//echo $row[id];
$colspan = 7;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:10px;">
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<script language="javascript">
</script>
<div style="padding:0 0 5px 0;">
	<table width="472" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="" align="center">
		<tr>
			<td class="tdhead_center" width="30" rowspan="">No</td>
			<td class="tdhead_center" width="128" rowspan="">����Ͻ�</td>
			<td class="tdhead_center" rowspan="">�����ID</td>
			<td class="tdhead_center" rowspan="">����ڸ�</td>
			<td class="tdhead_center" width="66" rowspan="">ó����Ȳ</td>
			<td class="tdhead_center" width="72" rowspan="">ó������</td>
		</tr>
<?
// ����Ʈ ���
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;
	//����Ͻ�
	$w_date = $row['w_date'];
	//�����ID
	$w_user = $row['w_user'];
	//����ڸ�
	$w_name = $row['w_name'];
	//ó����Ȳ
	$job_proxy = $row['job_proxy'];
	$job_proxy_text = $job_proxy_array[$job_proxy];
	//ó������
	if($row['job_proxy_date']) $job_proxy_date = $row['job_proxy_date'];
	else $job_proxy_date = "-";
?>
		<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
			<td class="ltrow1_center_h22" style=""><?=$no?></td>
			<td class="ltrow1_center_h22" style=""><?=$w_date?></td>
			<td class="ltrow1_center_h22" style=""><?=$w_user?></td>
			<td class="ltrow1_center_h22" style=""><?=$w_name?></td>
			<td class="ltrow1_center_h22" style=""><?=$job_proxy_text?></td>
			<td class="ltrow1_center_h22" style=""><?=$job_proxy_date?></td>
		</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">ó����Ȳ �̷��� �����ϴ�.</td></tr>";
?>
	</table>
</div>
</body>
</html>
