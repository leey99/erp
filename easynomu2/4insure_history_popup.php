<?
$sub_menu = "200110";
include_once("./_common.php");

$sql_common = " from a4_4insure ";

$sql_search = " where com_code='$code' and ( join_code='$id' or join_code_2='$id' or join_code_3='$id' or join_code_4='$id' or join_code_5='$id' or quit_code='$id' or quit_code_2='$id' or quit_code_3='$id' or quit_code_4='$id' or quit_code_5='$id' ) ";

if (!$sst) {
    $sst = "id";
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
//$result = sql_query($sql);
//$total_count = mysql_num_rows($result);
//echo $total_count;

$rows = 1000;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$kind_text = "��ȸ����";

$sub_title = $kind_text." �Ű��̷�";
$g4['title'] = $sub_title." : ������� : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
//echo $sql;
$result = sql_query($sql);
//echo $row[id];
$colspan = 5;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4['title']?></title>
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
	<table width="440" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="" align="center">
		<tr>
			<td class="tdhead_center" width="30" rowspan="">No</td>
			<td class="tdhead_center" width="100" rowspan="">���豸��</td>
			<td class="tdhead_center" width="78" rowspan="">�����</td>
			<td class="tdhead_center" width="78" rowspan="">�����</td>
			<td class="tdhead_center" width="" rowspan="">����Ͻ�</td>
		</tr>
<?
// ����Ʈ ���
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;
	//�θ� ID
	$mid = $row['id'];
	//���豸��
	$insure_kind = "";
	if($row['join_code'] == $id) {
		if($row['isgy']) $insure_kind .= "���.";
		if($row['issj']) $insure_kind .= "����.";
		if($row['iskm']) $insure_kind .= "����.";
		if($row['isgg']) $insure_kind .= "�ǰ�";
	}
	if($row['join_code_2'] == $id) {
		if($row['isgy_2']) $insure_kind .= "���.";
		if($row['issj_2']) $insure_kind .= "����.";
		if($row['iskm_2']) $insure_kind .= "����.";
		if($row['isgg_2']) $insure_kind .= "�ǰ�";
	}
	if($row['join_code_3'] == $id) {
		if($row['isgy_3']) $insure_kind .= "���.";
		if($row['issj_3']) $insure_kind .= "����.";
		if($row['iskm_3']) $insure_kind .= "����.";
		if($row['isgg_3']) $insure_kind .= "�ǰ�";
	}
	if($row['join_code_4'] == $id) {
		if($row['isgy_4']) $insure_kind .= "���.";
		if($row['issj_4']) $insure_kind .= "����.";
		if($row['iskm_4']) $insure_kind .= "����.";
		if($row['isgg_4']) $insure_kind .= "�ǰ�";
	}
	if($row['join_code_5'] == $id) {
		if($row['isgy_5']) $insure_kind .= "���.";
		if($row['issj_5']) $insure_kind .= "����.";
		if($row['iskm_5']) $insure_kind .= "����.";
		if($row['isgg_5']) $insure_kind .= "�ǰ�";
	}
	if($row['quit_code'] == $id) {
		if($row['quit_isgy']) $insure_kind .= "���.";
		if($row['quit_issj']) $insure_kind .= "����.";
		if($row['quit_iskm']) $insure_kind .= "����.";
		if($row['quit_isgg']) $insure_kind .= "�ǰ�";
	}
	if($row['quit_quit_code_2'] == $id) {
		if($row['quit_isgy_2']) $insure_kind .= "���.";
		if($row['quit_issj_2']) $insure_kind .= "����.";
		if($row['quit_iskm_2']) $insure_kind .= "����.";
		if($row['quit_isgg_2']) $insure_kind .= "�ǰ�";
	}
	if($row['quit_quit_code_3'] == $id) {
		if($row['quit_isgy_3']) $insure_kind .= "���.";
		if($row['quit_issj_3']) $insure_kind .= "����.";
		if($row['quit_iskm_3']) $insure_kind .= "����.";
		if($row['quit_isgg_3']) $insure_kind .= "�ǰ�";
	}
	if($row['quit_quit_code_4'] == $id) {
		if($row['quit_isgy_4']) $insure_kind .= "���.";
		if($row['quit_issj_4']) $insure_kind .= "����.";
		if($row['quit_iskm_4']) $insure_kind .= "����.";
		if($row['quit_isgg_4']) $insure_kind .= "�ǰ�";
	}
	if($row['quit_quit_code_5'] == $id) {
		if($row['quit_isgy_5']) $insure_kind .= "���.";
		if($row['quit_issj_5']) $insure_kind .= "����.";
		if($row['quit_iskm_5']) $insure_kind .= "����.";
		if($row['quit_isgg_5']) $insure_kind .= "�ǰ�";
	}
	if(!$insure_kind) $insure_kind = "-";
	//�����
	$join_date = "";
	if($row['join_code'] == $id && $row['join_date'] != "0000-00-00 00:00:00") {
		$join_date = substr($row['join_date'],0,10);
	}
	if($row['join_code_2'] == $id && $row['join_date_2'] != "0000-00-00 00:00:00") {
		$join_date = substr($row['join_date'],0,10);
	}
	if($row['join_code_3'] == $id && $row['join_date_3'] != "0000-00-00 00:00:00") {
		$join_date = substr($row['join_date'],0,10);
	}
	if($row['join_code_4'] == $id && $row['join_date_4'] != "0000-00-00 00:00:00") {
		$join_date = substr($row['join_date'],0,10);
	}
	if($row['join_code_5'] == $id && $row['join_date_5'] != "0000-00-00 00:00:00") {
		$join_date = substr($row['join_date'],0,10);
	}
	if(!$join_date) $join_date = "-";
	//�����
	$quit_date = "";
	if($row['quit_code'] == $id && $row['quit_date'] != "0000-00-00 00:00:00") {
		$quit_date = substr($row['quit_date'],0,10);
	}
	if($row['quit_code_2'] == $id && $row['quit_date_2'] != "0000-00-00 00:00:00") {
		$quit_date = substr($row['quit_date'],0,10);
	}
	if($row['quit_code_3'] == $id && $row['quit_date_3'] != "0000-00-00 00:00:00") {
		$quit_date = substr($row['quit_date'],0,10);
	}
	if($row['quit_code_4'] == $id && $row['quit_date_4'] != "0000-00-00 00:00:00") {
		$quit_date = substr($row['quit_date'],0,10);
	}
	if($row['quit_code_5'] == $id && $row['quit_date_5'] != "0000-00-00 00:00:00") {
		$quit_date = substr($row['quit_date'],0,10);
	}
	if(!$quit_date) $quit_date = "-";
	//����Ͻ�
	$reg_time = $row['wr_datetime'];
	if(!$reg_time) $reg_time = "-";
?>
		<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
			<td class="ltrow1_center_h22" style=""><?=$no?></td>
			<td class="ltrow1_center_h22" style=""><?=$insure_kind?></td>
			<td class="ltrow1_center_h22" style=""><?=$join_date?></td>
			<td class="ltrow1_center_h22" style=""><?=$quit_date?></td>
			<td class="ltrow1_center_h22" style=""><?=$reg_time?></td>
		</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">�̷��� �����ϴ�.</td></tr>";
?>
	</table>
</div>
</body>
</html>
