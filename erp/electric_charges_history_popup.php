<?
$sub_menu = "1900100";
include_once("./_common.php");
$sql_common = " from electric_charges_history ";

//echo $member[mb_profile];
if($is_admin != "super") {
	$stx_man_cust_name = $member['mb_profile'];
}
$is_admin = "super";
//echo $is_admin;
$sql_search = " where com_code='$id' ";

if (!$sst) {
    $sst = "w_date";
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

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
//echo $sql;
$result = sql_query($sql);
//echo $row[id];
$colspan = 10;

//����� �⺻���� ȣ��
$sql_com = "select * from com_list_gy where com_code = '$id' ";
$row_com = sql_fetch($sql_com);

$sub_title = $row_com['com_name'];
$g4[title] = $sub_title." : ������������ �̷� : ".$easynomu_name;
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
function goInsert() {
	var frm = document.dataForm;
	var rv = 0;
	if (frm.memo.value == "")
	{
		alert("������ �Է��ϼ���.");
		frm.memo.focus();
		return;
	}
	frm.action = "job_education_memo_update.php";
	frm.submit();
	return;
}
</script>
<div style="padding:0 0 5px 0;">
	<table width="604" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="" align="center">
		<tr>
			<td class="tdhead_center" width="30" rowspan="">No</td>
			<td class="tdhead_center" width="70" rowspan="">����Ͻ�</td>
			<td class="tdhead_center" rowspan="">����ڸ�</td>
			<td class="tdhead_center" width="62" rowspan="">ó����Ȳ</td>
			<td class="tdhead_center" width="78" rowspan="">�����1��</td>
			<td class="tdhead_center" width="76" rowspan="">��������ݾ�</td>
			<td class="tdhead_center" width="76" rowspan="">�������Ա�</td>
			<td class="tdhead_center" width="64" rowspan="">�������</td>
			<td class="tdhead_center" width="64" rowspan="">ó�����</td>
		</tr>
<?
// ����Ʈ ���
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;
	//����Ͻ�
	//$w_date = $row['w_date'];
	//�������
	$date1 = substr($row['w_date'],0,10); //��¥ǥ�����ĺ���
	$w_time = substr($row['w_date'],11,8); //�ð��� ǥ��
	$date = explode("-", $date1); 
	$year = $date[0];
	$month = $date[1]; 
	$day = $date[2]; 
	$w_date = $year.".".$month.".".$day."";
	//�����ID
	$w_user = $row['w_user'];
	//����ڸ�
	$w_name = $row['w_name'];
	//��Ź��Ȳ
	$electric_charges_process = $row['electric_charges_process'];
	$electric_charges_process_text = $electric_charges_process_arry[$electric_charges_process];
	if(!$electric_charges_process) $electric_charges_process_text = "-";
	//�����
	if($row['electric_charges_year_fee']) $electric_charges_year_fee = $row['electric_charges_year_fee'];
	else $electric_charges_year_fee = "-";
	//��������ݾ�
	if($row['electric_charges_reduce']) $electric_charges_reduce = $row['electric_charges_reduce'];
	else $electric_charges_reduce = "-";
	//�������Ա�
	if($row['electric_charges_payments']) $electric_charges_payments = $row['electric_charges_payments'];
	else $electric_charges_payments = "-";
	//�������
	if($row['electric_charges_watt']) $electric_charges_watt = $row['electric_charges_watt']."kW";
	else $electric_charges_watt = "-";
	//ó�����
	if($row['electric_charges_etc']) {
		$electric_charges_etc_full = $row['electric_charges_etc'];
		$electric_charges_etc = cut_str($electric_charges_etc_full, 8, "..");
	} else {
		$electric_charges_etc = "-";
	}
?>
		<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
			<td class="ltrow1_center_h22" style=""><?=$no?></td>
			<td class="ltrow1_center_h22" title="<?=$w_time?>"><?=$w_date?></td>
			<td class="ltrow1_center_h22" style=""><?=$w_name?></td>
			<td class="ltrow1_center_h22" style=""><?=$electric_charges_process_text?></td>
			<td class="ltrow1_center_h22" style=""><?=$electric_charges_year_fee?></td>
			<td class="ltrow1_center_h22" style=""><?=$electric_charges_reduce?></td>
			<td class="ltrow1_center_h22" style=""><?=$electric_charges_payments?></td>
			<td class="ltrow1_center_h22" style=""><?=$electric_charges_watt?></td>
			<td class="ltrow1_center_h22" title="<?=$electric_charges_etc_full?>"><?=$electric_charges_etc?></td>
		</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">������������ �̷��� �����ϴ�.</td></tr>";
?>
	</table>
</div>
</body>
</html>
