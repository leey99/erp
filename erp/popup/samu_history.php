<?
$sub_menu = "400100";
include_once("../_common.php");
include_once("../../dbconfig_erp.php");
$sql_common = " from samu_history ";

//echo $member[mb_profile];
if($is_admin != "super") {
	$stx_man_cust_name = $member[mb_profile];
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

$sub_title = "�繫��Ź �̷�";
$g4[title] = $sub_title." : �繫��Ź : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
//echo $sql;
$result = sql_query($sql);
//echo $row[id];
$colspan = 8;
$row=mysql_fetch_array($result);
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
	<table width="560" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="" align="center">
		<tr>
			<td class="tdhead_center" width="10" rowspan="">No</td>
			<td class="tdhead_center" width="90" rowspan="">����Ͻ�</td>
			<td class="tdhead_center" rowspan="">�����ID</td>
			<td class="tdhead_center" width="120" rowspan="">��Ź��Ȳ</td>
			<td class="tdhead_center" width="70" rowspan="">��������</td>
			<td class="tdhead_center" width="70" rowspan="">��Ź��ȣ</td>
			<td class="tdhead_center" width="70" rowspan="">��������</td>
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
	//��Ź��Ȳ
	$samu_req_yn = $row['samu_req_yn'];
	$samu_req_yn_arry = array("","�ݷ�","���Ӱ���","Ÿ����","����","����");
	$samu_req_yn_text = $samu_req_yn_arry[$samu_req_yn];
	//������
	if($row['samu_req_date']) $samu_req_date = $row['samu_req_date'];
	else $samu_req_date = "-";
	//��Ź��ȣ
	if($row['samu_receive_no']) $samu_receive_no = $row['samu_receive_no'];
	else $samu_receive_no = "-";
	//������
	if($row['samu_close_date']) $samu_close_date = $row['samu_close_date'];
	else $samu_close_date = "-";
?>
		<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
			<td class="ltrow1_center_h22" style=""><?=$no?></td>
			<td class="ltrow1_center_h22" style=""><?=$w_date?></td>
			<td class="ltrow1_center_h22" style=""><?=$w_user?></td>
			<td class="ltrow1_center_h22" style=""><?=$samu_req_yn_text?></td>
			<td class="ltrow1_center_h22" style=""><?=$samu_req_date?></td>
			<td class="ltrow1_center_h22" style=""><?=$samu_receive_no?></td>
			<td class="ltrow1_center_h22" style=""><?=$samu_close_date?></td>
		</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">�繫��Ź �̷��� �����ϴ�.</td></tr>";
?>
	</table>
</div>
</body>
</html>
