<?
$sub_menu = "700100";
include_once("./_common.php");
$sql_common = " from com_list_gy a, com_list_gy_opt b ";

//echo $member[mb_profile];
if($is_admin != "super") {
	$stx_man_cust_name = $member['mb_profile'];
}
$is_admin = "super";

$sub_title = "������";
$g4['title'] = $sub_title." : �������� : �׷���� : ".$easynomu_name;

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4['title']?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0 10px 10px 10px;">
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<script language="javascript">
function goInsert() {
	var frm = document.dataForm;
	var rv = 0;
	if(frm.memo.value == "") {
		alert("������ �Է��Ͻʽÿ�.");
		frm.memo.focus();
		return;
	}
	frm.action = "popup_schedule_update.php";
	frm.submit();
	return;
}
function memo_del(id,idx,memo_type) {
	if(confirm("�����Ͻðڽ��ϱ�?")) {
		location.href = "popup_schedule_delete.php?id="+id+"&idx="+idx+"&memo_type="+memo_type;
	}
}
</script>

<?
//�ݿ� �˻�
$today = date("Y.m.d");
//$this_month_start = date("Y.m.d");
//�湮/���� ��Ȳ ��Ʋ �� �����ٺ��� ǥ�� 160224 / ���Ϻ��� ǥ�� 160415
$this_month_start = date("Y.m.d",strtotime("0 day"));
$this_month_last_day = date('t', strtotime($this_month_start));

//���� ���� ���� . -> -
$search_sday_arry = explode(".",$search_sday);
$search_sday2 = $search_sday_arry[0]."-".$search_sday_arry[1]."-".$search_sday_arry[2];

//������ ����, ���� ���� 160422
/*
if(!$today_chk) {
	$this_month_1_day = date('Y.m.d', strtotime($search_sday2." +1 day"));
	$search_sday = $this_month_1_day;
}
*/

//5�� �� ����
$this_month_5_day = date('Y.m.d', strtotime($search_sday2." +5 day"));
//echo $this_month_5_day;
//$this_month_end = date("Y.m").".".$this_month_last_day;
$this_month_end = $this_month_5_day;
//$search_sday = $this_month_start;

//������ ����, ���� ���� 160422
if(!$today_chk) $search_eday = $this_month_end;
else $search_eday = $search_sday;

//������������(������� �ŷ�ó ǥ��)
$sql_manage = "select * from a4_manage where code = '$manage_code' ";
$row_manage = sql_fetch($sql_manage);
$manage_code = $row_manage['code'];
$sql_search = " (a.damdang_code='$row_manage[belong]' or a.damdang_code2='$row_manage[belong]') and ";
$sql_search .= " b.manage_cust_numb='$manage_code' and ";

//�ش� �� �����͸� ǥ��
$sql_search .= " (a.electric_charges_visitdt >= '$search_sday' and a.electric_charges_visitdt <= '$search_eday') and ";
//������������(SQL����) �湮���� ���Ϻ��� ������� ���� 160415
$sql_electric_charges = " select * from com_list_gy a, com_list_gy_opt b where  $sql_search a.com_code = b.com_code and a.electric_charges_visitdt != '' order by a.electric_charges_visitdt asc ";
//echo $sql_electric_charges;
$result_electric_charges = sql_query($sql_electric_charges);
?>
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="" align="center">
						<tr>
							<td class="tdhead_center" width="70" rowspan="">�������</td>
							<td class="tdhead_center" width="130" rowspan="">����</td>
							<td class="tdhead_center" width="62" rowspan="">�湮����</td>
							<td class="tdhead_center" rowspan="">������</td>
							<td class="tdhead_center" width="62">������</td>
							<td class="tdhead_center" width="72">�����</td>
						</tr>
<?
$colspan = 6;
//������������ ����Ʈ ���
for ($k=0; $row_electric_charges=sql_fetch_array($result_electric_charges); $k++) {
	//�ŷ�ó �ڵ�
	$com_code = $row_electric_charges['com_code'];
	//ó����Ȳ
	$check_ok_id = $row_electric_charges['check_ok'];
	//�湮����
	$memo_date = $row_electric_charges['electric_charges_visitdt'];
	$visitdt_time = $row_electric_charges['electric_charges_visitdt_time'];
	$com_name_full = $row_electric_charges['com_name'];
	$com_name = cut_str($com_name_full, 28, "..");
	if($member['mb_level'] > 6 || $row_electric_charges['damdang_code'] == $member['mb_profile']) {
		$com_view = "electric_charges_view.php?id=".$com_code."&w=u";
	} else {
		$com_view = "javascript:alert('�ش� �ŷ�ó ������ ������ ������ �����ϴ�.');";
	}
	//������
	$damdang_code = $row_electric_charges['damdang_code'];
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "-";
	//�����
	$user_nick = $row_electric_charges['manage_cust_name'];
	//���� �迭
	$doms	= array( "��", "��", "ȭ", "��", "��", "��", "��" );
	$this_date_chk = explode(".", $memo_date);
	$this_date = $this_date_chk[0]."-".$this_date_chk[1]."-".$this_date_chk[2];
	$yoil_chk = date("w", strtotime($this_date));
	$yoil_text = $doms[$yoil_chk];
	//ó����Ȳ �迭 ���� ���� ǥ��
	$check_ok = "������";
	if($row_electric_charges['electric_charges_visit_kind']) $visit_kind = $row_electric_charges['electric_charges_visit_kind'];
	else $visit_kind = "";
	//�翬����, �湮���� ���� ���
	if(!$memo_date) {
		$yoil_text = "";
	} else {
		$yoil_text = "(".$yoil_text.")";
	}
?>
						<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
							<td class="ltrow1_center_h22" style=""><?=$check_ok?></td>
							<td class="ltrow1_left_h22" style="<?=$memo_date_color?>"><?=$memo_date?> <?=$yoil_text?> <?=$visitdt_time?></td>
							<td class="ltrow1_center_h22" style=""><?=$visit_kind?></td>
							<td class="ltrow1_left_h22" title="<?=$visit_call_memo_full?>">
								<a href="<?=$com_view?>" target="_blank"><span style="font-weight:bold"><?=$com_name?></span></a>
							</td>
							<td class="ltrow1_center_h22" style=""><?=$branch?></td>
							<td class="ltrow1_center_h22" style=""><? if($user_nick) echo $user_nick; ?></td>
						</tr>
<?
}

//���â��
$sql_common = " from job_time a, job_time_opt b ";
//�ش� ������� �湮������ ǥ��
$sql_search = " where (a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]') ";
//���� �ŷ�ó ����, �翬�� or �湮���� 150811
$sql_search .= " and a.id=b.id and a.delete_yn != '1' and ( b.check_ok='9' or  b.check_ok='10' ) ";
//���Ϻ��� �ݿ������� ǥ�� ���� 150709 -> �ش� �� �����͸� ǥ�� 150104
$sql_search .= " and ( (a.visitdt >= '$search_sday' and a.visitdt <= '$search_eday') ) ";
//�����ٰ��� �Ϸ� �� ��ǥ�� 160224
$sql_search .= " and (a.visitdt_ok = '') ";
//�����, ��������ڿ��Ը� ǥ�� 160211
$sql_search .= " and (a.writer='$manage_code' or a.manager='$manage_code') ";
//������ ��û (�⺻ �˻�)
$sql_search .= " ";

//���â�� ī��Ʈ
$sql = " select count(*) as cnt
         $sql_common
         $sql_search ";
//echo $sql;
$row = sql_fetch($sql);
$total_count_job_time = $row['cnt'];

$sql_order = " order by a.visitdt asc, b.recall asc ";
$sql = " select *
          $sql_common
          $sql_search
          $sql_order
";
//echo $sql;
$result = sql_query($sql);
$colspan = 6;

//�ű԰��Ȯ��(������� �ŷ�ó ǥ��)
$sql_search = " (a.damdang_code='$row_manage[belong]' or a.damdang_code2='$row_manage[belong]') and ";
$sql_search .= " c.manage_cust_numb='$manage_code' and ";

//�ش� �� �����͸� ǥ��
$sql_search .= " (b.employment_visitdt >= '$search_sday' and b.employment_visitdt <= '$search_eday') and ";
//�����ٰ��� �Ϸ� �� ��ǥ�� 160224
$sql_search .= " (b.employment_visitdt_ok = '') and ";
//�ű԰��Ȯ��(SQL����)
$sql_employment = " select * from com_list_gy a, com_employment b, com_list_gy_opt c where  $sql_search a.com_code = b.com_code and a.com_code = c.com_code and b.employment_visitdt != '' order by b.employment_visitdt asc ";
$result_employment = sql_query($sql_employment);
//�ű԰��Ȯ�� ����Ʈ ���
for ($k=0; $row_employment=sql_fetch_array($result_employment); $k++) {
	//�ŷ�ó �ڵ�
	$com_code = $row_employment['com_code'];
	//ó����Ȳ
	$check_ok_id = $row_employment['check_ok'];
	//�湮����
	$memo_date = $row_employment['employment_visitdt'];
	$visitdt_time = $row_employment['employment_visitdt_time'];
	$com_name_full = $row_employment['com_name'];
	$com_name = cut_str($com_name_full, 28, "..");
	if($member['mb_level'] > 6 || $row_employment['damdang_code'] == $member['mb_profile']) {
		$com_view = "acceleration_employment_view.php?id=".$com_code."&w=u";
	} else {
		$com_view = "javascript:alert('�ش� �ŷ�ó ������ ������ ������ �����ϴ�.');";
	}
	//������
	$damdang_code = $row_employment['damdang_code'];
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "-";
	//�����
	$user_nick = $row_employment['manage_cust_name'];
	//���� �迭
	$doms	= array( "��", "��", "ȭ", "��", "��", "��", "��" );
	$this_date_chk = explode(".", $memo_date);
	$this_date = $this_date_chk[0]."-".$this_date_chk[1]."-".$this_date_chk[2];
	$yoil_chk = date("w", strtotime($this_date));
	$yoil_text = $doms[$yoil_chk];
	//ó����Ȳ �迭 ���� ���� ǥ��
	$check_ok = "�ű԰��";
	if($row_employment['employment_visit_kind']) $visit_kind = $row_employment['employment_visit_kind'];
	else $visit_kind = "";
	//�翬����, �湮���� ���� ���
	if(!$memo_date) {
		$yoil_text = "";
	} else {
		$yoil_text = "(".$yoil_text.")";
	}
?>
						<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
							<td class="ltrow1_center_h22" style=""><?=$check_ok?></td>
							<td class="ltrow1_left_h22" style="<?=$memo_date_color?>"><?=$memo_date?> <?=$yoil_text?> <?=$visitdt_time?></td>
							<td class="ltrow1_center_h22" style=""><?=$visit_kind?></td>
							<td class="ltrow1_left_h22" title="<?=$visit_call_memo_full?>">
								<a href="<?=$com_view?>" target="_blank"><span style="font-weight:bold"><?=$com_name?></span></a>
							</td>
							<td class="ltrow1_center_h22" style=""><?=$branch?></td>
							<td class="ltrow1_center_h22" style=""><? if($user_nick) echo $user_nick; ?></td>
						</tr>
<?
}

//�湮������ 160707
$sql_common = " from erp_visit a ";
//�˻� ����
$sql_search = " where 1=1 ";
//���� �ŷ�ó ����, �湮���� 150811
$sql_search .= " and a.delete_yn != '1' and ( a.check_ok='10' ) ";
//10�� �� ����
$this_month_10_day = date('Y.m.d', strtotime($search_sday2." +10 day"));
//���Ϻ��� �ݿ������� ǥ�� ���� 150709 -> �ش� �� �����͸� ǥ�� 150104
$sql_search .= " and ( a.visitdt >= '$search_sday' and a.visitdt <= '$this_month_10_day' ) ";
//�����, ��������ڿ��Ը� ǥ�� 160211
$sql_search .= " and (a.writer='$manage_code' or a.manager='$manage_code') ";
//������ ��û (�⺻ �˻�)
$sql_search .= " ";

//���â�� ī��Ʈ
$sql_visit = " select count(*) as cnt
         $sql_common
         $sql_search ";
//echo $sql;
$row_visit = sql_fetch($sql_visit);
$total_count_visit = $row_visit['cnt'];
//�湮���� �������� ����
$sql_order = " order by a.visitdt asc ";
$sql_visit = " select *
          $sql_common
          $sql_search
          $sql_order
";
//echo $sql_visit;
$result_visit = sql_query($sql_visit);

//����Ʈ ���
for ($k=0; $row_visit=sql_fetch_array($result_visit); $k++) {
	//�ŷ�ó �ڵ�
	$com_code = $row_visit['com_code'];
	$id = $row_visit['id'];
	//�湮����
	$memo_date = $row_visit['visitdt'];
	$visitdt_time = $row_visit['visitdt_time'];
	$com_name_full = $row_visit['com_name'];
	$com_name = cut_str($com_name_full, 28, "..");
	if($id) {
		$com_view = "schedule_view.php?id=".$id."&w=u";
	} else {
		$com_view = "javascript:alert('�ش� �ŷ�ó�� �湮�����ٸ� ��ϵǾ� �ֽ��ϴ�.');";
	}
	//������
	$damdang_code = $row_visit['damdang_code'];
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "-";
	//����� -> ��������� 160707
	//$user_nick = $row_visit['writer_name'];
	$user_nick = $row_visit['manager_name'];
	//���� �迭
	$doms	= array( "��", "��", "ȭ", "��", "��", "��", "��" );
	$this_date_chk = explode(".", $memo_date);
	$this_date = $this_date_chk[0]."-".$this_date_chk[1]."-".$this_date_chk[2];
	$yoil_chk = date("w", strtotime($this_date));
	$yoil_text = $doms[$yoil_chk];
	//ó����Ȳ �迭 ���� ���� ǥ��
	$check_ok = "�湮������";
	$visit_kind = "�湮";
	//�翬����, �湮���� ���� ���
	if(!$memo_date) {
		$yoil_text = "";
	} else {
		$yoil_text = "(".$yoil_text.")";
	}
?>
						<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
							<td class="ltrow1_center_h22" style=""><?=$check_ok?></td>
							<td class="ltrow1_left_h22" style="<?=$memo_date_color?>"><?=$memo_date?> <?=$yoil_text?> <?=$visitdt_time?></td>
							<td class="ltrow1_center_h22" style=""><?=$visit_kind?></td>
							<td class="ltrow1_left_h22" title="<?=$visit_call_memo_full?>">
								<a href="<?=$com_view?>" target="_blank"><span style="font-weight:bold"><?=$com_name?></span></a>
							</td>
							<td class="ltrow1_center_h22" style=""><?=$branch?></td>
							<td class="ltrow1_center_h22" style=""><? if($user_nick) echo $user_nick; ?></td>
						</tr>
<?
}

//�����ٵ�� 160720
$sql_common = " from com_list_gy a ";
//�˻� ����
$sql_search = " where 1=1 ";
//10�� �� ����
$this_month_10_day = date('Y.m.d', strtotime($search_sday2." +10 day"));
//���Ϻ��� �ݿ������� ǥ�� ���� 150709 -> �ش� �� �����͸� ǥ�� 150104
$sql_search .= " and ( a.client_schedule_visitdt >= '$search_sday' and a.client_schedule_visitdt <= '$this_month_10_day' ) ";
//�����, ��������ڿ��Ը� ǥ�� 160211
$sql_search .= " and (a.client_schedule_visitdt_writer='$manage_code' or a.client_schedule_visitdt_manager='$manage_code') ";
//������ ��û (�⺻ �˻�)
$sql_search .= " ";

//���â�� ī��Ʈ
$sql_visit = " select count(*) as cnt
         $sql_common
         $sql_search ";
//echo $sql;
$row_visit = sql_fetch($sql_visit);
$total_count_visit = $row_visit['cnt'];
//�湮���� �������� ����
$sql_order = " order by a.client_schedule_visitdt asc ";
$sql_visit = " select *
          $sql_common
          $sql_search
          $sql_order
";
//echo $sql_visit;
$result_visit = sql_query($sql_visit);

//����Ʈ ���
for ($k=0; $row_visit=sql_fetch_array($result_visit); $k++) {
	//�ŷ�ó �ڵ�
	$id = $row_visit['com_code'];
	//�湮����
	$memo_date = $row_visit['client_schedule_visitdt'];
	$visitdt_time = $row_visit['client_schedule_visitdt_time'];
	$com_name_full = $row_visit['com_name'];
	$com_name = cut_str($com_name_full, 28, "..");
	if($id) {
		$com_view = "client_schedule_view.php?id=".$id."&w=u";
	} else {
		$com_view = "javascript:alert('�ش� �ŷ�ó�� �湮�����ٸ� ��ϵǾ� �ֽ��ϴ�.');";
	}
	//������
	$damdang_code = $row_visit['damdang_code'];
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "-";
	//����� -> ��������� 160707
	//$user_nick = $row_visit['writer_name'];
	//��������ڸ� ����
	$manager_code = $row_visit['client_schedule_visitdt_manager'];
	$sql_manage = " select * from a4_manage where state=1 and code='$manager_code' ";
	$result_manage = sql_query($sql_manage);
	$row_manage = mysql_fetch_array($result_manage);
	$user_nick = $row_manage['name'];
	//���� �迭
	$doms	= array( "��", "��", "ȭ", "��", "��", "��", "��" );
	$this_date_chk = explode(".", $memo_date);
	$this_date = $this_date_chk[0]."-".$this_date_chk[1]."-".$this_date_chk[2];
	$yoil_chk = date("w", strtotime($this_date));
	$yoil_text = $doms[$yoil_chk];
	//ó����Ȳ �迭 ���� ���� ǥ��
	$check_ok = "�湮������";
	$visit_kind = "�湮";
	//�翬����, �湮���� ���� ���
	if(!$memo_date) {
		$yoil_text = "";
	} else {
		$yoil_text = "(".$yoil_text.")";
	}
?>
						<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
							<td class="ltrow1_center_h22" style=""><?=$check_ok?></td>
							<td class="ltrow1_left_h22" style="<?=$memo_date_color?>"><?=$memo_date?> <?=$yoil_text?> <?=$visitdt_time?></td>
							<td class="ltrow1_center_h22" style=""><?=$visit_kind?></td>
							<td class="ltrow1_left_h22" title="<?=$visit_call_memo_full?>">
								<a href="<?=$com_view?>" target="_blank"><span style="font-weight:bold"><?=$com_name?></span></a>
							</td>
							<td class="ltrow1_center_h22" style=""><?=$branch?></td>
							<td class="ltrow1_center_h22" style=""><? if($user_nick) echo $user_nick; ?></td>
						</tr>
<?
}
?>

<?
//���â�� ī��Ʈ ���� ��
if($total_count_job_time) {
	// ����Ʈ ���
	for ($i=0; $row=sql_fetch_array($result); $i++) {
		$no = $total_count - $i - ($rows*($page-1));
		$job_time_id = $row['id'];
		$list = $i%2;
		//�ŷ�ó �ڵ�
		$com_code = $row['com_code'];
		//ó����Ȳ
		$check_ok_id = $row['check_ok'];
		//�翬�� ��
		if($check_ok_id == 9) {
			//�湮����
			$memo_date = $row['recall'];
			$visitdt_time = "";
		} else {
			//�湮����
			$memo_date = $row['visitdt'];
			$visitdt_time = $row['visitdt_time'];
		}
		//���� ����
		//if($memo_date >= $today && $memo_date <= $search_eday) $memo_date_color = "color:#ff0000;";
		//else $memo_date_color = "";
		//������
		$com_name_full = $row['com_name'];
		$com_name = cut_str($com_name_full, 28, "..");
		//������
		$damdang_code = $row['damdang_code'];
		if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
		else $branch = "-";
		if($member['mb_level'] > 6 || $row['damdang_code'] == $member['mb_profile']) {
			//$com_view = "client_memo_view.php?id=$com_code&w=u#40001";
			$com_view = "job_time_view.php?id=".$job_time_id."&w=u";
		} else {
			$com_view = "javascript:alert('�ش� �ŷ�ó ������ ������ ������ �����ϴ�.');";
		}
		//�޸� ����
		$visit_call_memo_full = $row['memo'];
		$visit_call_memo = cut_str($visit_call_memo_full, 28, "..");
		//ó����� �߰�
		$visit_call_memo_full .= "\n".$row['etc'];
		//�����
		$user_nick = $row['writer_name'];
		//�����
		$manager_name = $row['manager_name'];
		//���� �迭
		$doms	= array( "��", "��", "ȭ", "��", "��", "��", "��" );
		$this_date_chk = explode(".", $memo_date);
		$this_date = $this_date_chk[0]."-".$this_date_chk[1]."-".$this_date_chk[2];
		$yoil_chk = date("w", strtotime($this_date));
		$yoil_text = $doms[$yoil_chk];
		//ó����Ȳ �迭 ���� ���� ǥ��
		//$check_ok = $job_time_process_arry[$check_ok_id];
		$check_ok = "���â��";
		if($check_ok_id) {
			if($job_time_process_arry[$check_ok_id] == "�湮����") $visit_kind = "(�湮)";
			else $visit_kind = "(".$job_time_process_arry[$check_ok_id].")";
		} else {
			$visit_kind = "";
		}
		//�翬����, �湮���� ���� ���
		if(!$memo_date) {
			$memo_date = "-";
			$yoil_text = "";
		} else {
			$yoil_text = "(".$yoil_text.")";
		}
?>
						<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
							<td class="ltrow1_center_h22" style=""><?=$check_ok?></td>
							<td class="ltrow1_left_h22" style="<?=$memo_date_color?>"><?=$memo_date?> <?=$yoil_text?> <?=$visitdt_time?></td>
							<td class="ltrow1_center_h22" style=""><?=$visit_kind?></td>
							<td class="ltrow1_left_h22" title="<?=$visit_call_memo_full?>">
								<a href="<?=$com_view?>" target="_blank"><span style="font-weight:bold"><?=$com_name?></span></a>
							</td>
							<td class="ltrow1_center_h22" style=""><?=$user_nick?></td>
							<td class="ltrow1_center_h22" style=""><? if($manager_name) echo $manager_name; ?></td>
						</tr>
<?
	}
?>
					</table>
<?
}
?>
</body>
</html>
