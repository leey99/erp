<?
$sub_menu = "1901000";
include_once("./_common.php");
$sql_common = " from si4n_history ";

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
$colspan = 13;

//����� �⺻���� ȣ��
$sql_com = "select * from com_list_gy where com_code = '$id' ";
$row_com = sql_fetch($sql_com);

$sub_title = $row_com['com_name'];
$g4[title] = $sub_title." : 4�뺸������������ �̷� : ".$easynomu_name;
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
<div style="padding:0 0 5px 0;">
	<table width="914" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="" align="center">
		<tr>
			<td class="tdhead_center" width="30" rowspan="">No</td>
			<td class="tdhead_center" width="70" rowspan="">����Ͻ�</td>
			<td class="tdhead_center" width="76">����ڸ�</td>
			<td class="tdhead_center" width="62" rowspan="">ó����Ȳ</td>
			<td class="tdhead_center" width="70" rowspan="">������</td>
			<td class="tdhead_center" width="30" rowspan="">����</td>
			<td class="tdhead_center" width="76" rowspan="">�Ա���</td>
			<td class="tdhead_center" width="30" rowspan="">�г�</td>
			<td class="tdhead_center">��Ȳ1</td>
			<td class="tdhead_center">������1</td>
			<td class="tdhead_center">����1</td>
			<td class="tdhead_center">��Ȳ2</td>
			<td class="tdhead_center">������2</td>
			<td class="tdhead_center">����2</td>
			<td class="tdhead_center">ó�����</td>
		</tr>
<?
// ����Ʈ ���
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$idx = $row['idx'];
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
	$si4n_process = $row['si4n_nhis_process'];
	$si4n_process_text = $si4n_nhis_process_arry[$si4n_process];
	if(!$si4n_process) $si4n_process_text = "-";
	//������
	if($row['si4n_fee']) $si4n_fee = $row['si4n_fee'];
	else $si4n_fee = "-";
	//����
	if($row['si4n_fee_choice']) $si4n_fee_choice = $row['si4n_fee_choice'];
	else $si4n_fee_choice = "-";
	//�г�
	if($row['si4n_installment']) $si4n_installment = $row['si4n_installment'];
	else $si4n_installment = "-";
	//��������
	if($row['si4n_change_date']) $si4n_change_date = $row['si4n_change_date'];
	else $si4n_change_date = "-";
	//���ú�
	if($row['si4n_setting']) $si4n_setting = $row['si4n_setting'];
	else $si4n_setting = "-";
	//���ú��Ա���
	if($row['si4n_setting_date']) $si4n_setting_date = $row['si4n_setting_date'];
	else $si4n_setting_date = "-";
	//�ܱ�
	if($row['si4n_remainder']) $si4n_remainder = $row['si4n_remainder'];
	else $si4n_remainder = "-";
	//�ܱ��Ա���
	if($row['si4n_remainder_date']) $si4n_remainder_date = $row['si4n_remainder_date'];
	else $si4n_remainder_date = "-";

	//������ 1/2�� 161213
	if($row['si4n_memo1']) {
		$si4n_memo1_full = $row['si4n_memo1'];
		$si4n_memo1 = cut_str($si4n_memo1_full, 6, "..");
	} else {
		$si4n_memo1 = "";
	}
	if($row['si4n_memo1_condition']) {
		$si4n_memo1_condition_full = $row['si4n_memo1_condition'];
		$si4n_memo1_condition = cut_str($si4n_memo1_condition_full, 6, "..");
	} else {
		$si4n_memo1_condition = "";
	}
	if($row['si4n_memo1_problem']) {
		$si4n_memo1_problem_full = $row['si4n_memo1_problem'];
		$si4n_memo1_problem = cut_str($si4n_memo1_problem_full, 6, "..");
	} else {
		$si4n_memo1_problem = "";
	}
	if($row['si4n_memo2']) {
		$si4n_memo2_full = $row['si4n_memo2'];
		$si4n_memo2 = cut_str($si4n_memo2_full, 6, "..");
	} else {
		$si4n_memo2 = "";
	}
	if($row['si4n_memo2_condition']) {
		$si4n_memo2_condition_full = $row['si4n_memo2_condition'];
		$si4n_memo2_condition = cut_str($si4n_memo2_condition_full, 6, "..");
	} else {
		$si4n_memo2_condition = "";
	}
	if($row['si4n_memo2_problem']) {
		$si4n_memo2_problem_full = $row['si4n_memo2_problem'];
		$si4n_memo2_problem = cut_str($si4n_memo2_problem_full, 6, "..");
	} else {
		$si4n_memo2_problem = "";
	}
	//ó�����
	if($row['si4n_etc']) {
		$si4n_etc_full = $row['si4n_etc'];
		$si4n_etc = cut_str($si4n_etc_full, 6, "..");
	} else {
		$si4n_etc = "";
	}
?>
		<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
			<td class="ltrow1_center_h22"><?=$no?></td>
			<td class="ltrow1_center_h22" title="<?=$w_time?>"><?=$w_date?></td>
			<td class="ltrow1_center_h22"><?=$w_name?></td>
			<td class="ltrow1_center_h22"><?=$si4n_process_text?></td>
			<td class="ltrow1_center_h22"><?=$si4n_fee?></td>
			<td class="ltrow1_center_h22"><?=$si4n_fee_choice?></td>
			<td class="ltrow1_center_h22"><?=$si4n_setting_date?></td>
			<td class="ltrow1_center_h22"><?=$si4n_installment?></td>
			<td class="ltrow1_center_h22"><a href="si4n_history_popup_memo.php?idx=<?=$idx?>&memo=condition1"><?=$si4n_memo1_condition?></a></td>
			<td class="ltrow1_center_h22"><a href="si4n_history_popup_memo.php?idx=<?=$idx?>&memo=problem1"><?=$si4n_memo1_problem?></a></td>
			<td class="ltrow1_center_h22"><a href="si4n_history_popup_memo.php?idx=<?=$idx?>&memo=memo1"><?=$si4n_memo1?></a></td>
			<td class="ltrow1_center_h22"><a href="si4n_history_popup_memo.php?idx=<?=$idx?>&memo=condition2"><?=$si4n_memo2_condition?></a></td>
			<td class="ltrow1_center_h22"><a href="si4n_history_popup_memo.php?idx=<?=$idx?>&memo=problem2"><?=$si4n_memo2_problem?></a></td>
			<td class="ltrow1_center_h22"><a href="si4n_history_popup_memo.php?idx=<?=$idx?>&memo=memo2"><?=$si4n_memo2?></a></td>
			<td class="ltrow1_center_h22"><a href="si4n_history_popup_memo.php?idx=<?=$idx?>&memo=etc"><?=$si4n_etc?></a></td>
		</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">����� �̷��� �����ϴ�.</td></tr>";
?>
	</table>
</div>
</body>
</html>
