<?php
$sub_menu = "400100";
include_once("./_common.php");

$sql_common = " from com_list_gy a, com_list_gy_opt b, com_list_gy_opt2 c ";

//echo $member[mb_profile];
if($is_admin != "super") {
	//$stx_man_cust_name = $member[mb_profile];
}
//$is_admin = "super";
//echo $is_admin;
if($member['mb_level'] > 6 || $search_ok == "ok") {
	$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code ";
} else {
	$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code and a.damdang_code='$member[mb_profile]' ";
}

//�˻� : ������Ī
if($stx_comp_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_name like '%$stx_comp_name%') ";
	$sql_search .= " ) ";
}
//�˻� : ����ڵ�Ϲ�ȣ
if($stx_biz_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.biz_no like '%$stx_biz_no%') ";
	$sql_search .= " ) ";
}
//�˻� : ��ǥ��
if($stx_boss_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.boss_name like '%$stx_boss_name%') ";
	$sql_search .= " ) ";
}
//�˻� : �����
if($stx_manage_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.manage_cust_name = '$stx_manage_name') ";
	$sql_search .= " ) ";
}
//�˻� : ����������ȣ
if($stx_t_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.t_insureno like '%$stx_t_no%') ";
	$sql_search .= " ) ";
}
//�˻� : ��ȭ��ȣ
if($stx_comp_tel) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_tel like '%$stx_comp_tel%') ";
	$sql_search .= " ) ";
}
//�˻� : �ѽ���ȣ
if($stx_comp_fax) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_fax like '%$stx_comp_fax%') ";
	$sql_search .= " ) ";
}
//�˻� : �̸���
if($stx_com_mail) {
	$sql_search .= " and a.com_mail like '%$stx_ccom_mail%' ";
}
//�˻� : �̸��� ��� ����
if($stx_com_mail_yn) {
	if($stx_com_mail_yn == 1) $sql_search .= " and a.com_mail != '-' ";
	else if($stx_com_mail_yn == 2) $sql_search .= " and a.com_mail = '-' ";
}
//�˻� : ó����Ȳ
if($stx_proxy) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.proxy = '$stx_proxy') ";
	$sql_search .= " ) ";
}
//�˻� : ����
if($stx_man_cust_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.damdang_code = '$stx_man_cust_name') ";
	$sql_search .= " ) ";
}
//�˻� : ���������
if($stx_reg_day_chk) {
	$sql_search .= " and ( ";
	if($stx_reg_day_chk == 1) {
		$sql_search .= " (b.registration_day != '') ";
	} else if($stx_reg_day_chk == 2) {
		$sql_search .= " (b.registration_day >= '$search_year.$search_month.00' and b.registration_day <= '$search_year_end.$search_month_end.32') ";
	}
	$sql_search .= " ) ";
	$sst = "b.registration_day";
	$sod = "desc";
}
//�˻� : �˻��Ⱓ
if($stx_search_day_chk) {
	$sst = "a.regdt";
	$sod = "desc";
	if($search_day_all || $search_day1 || $search_day3 || $search_day4 || $search_day5) $sql_search .= " and ( ";
	//�������
	if($search_day1) {
		$sql_search .= " (a.regdt >= '$search_sday' and a.regdt <= '$search_eday') ";
	}
	//��Ź��
	if($search_day3) {
		if($search_day1) $sql_search .= " or ";
		$sql_search .= " (b.samu_receive_date >= '$search_sday' and b.samu_receive_date <= '$search_eday') ";
		$sst = "b.samu_receive_date";
	}
	//�繫����
	if($search_day4) {
		if($search_day1 || $search_day3) $sql_search .= " or ";
		$sql_search .= " (b.samu_req_date >= '$search_sday' and b.samu_req_date <= '$search_eday') ";
		$sst = "b.samu_req_date";
	}
	//�繫���� ����
	if($search_day5) {
		if($search_day1 || $search_day3 || $search_day4) $sql_search .= " or ";
		$sql_search .= " (b.samu_close_date >= '$search_sday' and b.samu_close_date <= '$search_eday') ";
		$sst = "b.samu_close_date";
	}
	if($search_day_all || $search_day1 || $search_day3 || $search_day4 || $search_day5) $sql_search .= " ) ";
}
//�˻� : ����
if ($stx_uptae) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.uptae like '%$stx_uptae%') ";
	$sql_search .= " ) ";
}
//�˻� : ����
if ($stx_upjong) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.upjong like '%$stx_upjong%') ";
	$sql_search .= " ) ";
}
//�˻� : ��Ź��ȣ
if ($stx_samu_receive_no_search) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.samu_receive_no = '$stx_samu_receive_no_search') ";
	$sql_search .= " ) ";
}
//�˻�2 : ��Ź��
if ($stx_comp_gubun2) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.samu_receive_date != '') ";
	$sql_search .= " ) ";
}
//�繫��Ź���� : �ʱ⼱�� ����
if(!$samu_req_yn) $samu_req_yn = "4";
if ($samu_req_yn != "all") {
	$sql_search .= " and ( ";
	$sql_search .= " (b.samu_req_yn = '$samu_req_yn') ";
	$sql_search .= " ) ";
}
//�ǰ�EDI����
if ($health_req_yn) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.health_req_yn = '$health_req_yn') ";
	$sql_search .= " ) ";
}
//��Ź��ȣ : �ʱ⼱�� �Է�
if(!$stx_samu_receive_no) $stx_samu_receive_no = "1";
if($stx_samu_receive_no != "all") {
	$sql_search .= " and ( ";
	if($stx_samu_receive_no == 1) {
		$sql_search .= " (b.samu_receive_no != '') ";
	} else if($stx_samu_receive_no == 2) {
		$sql_search .= " (b.samu_receive_no = '') ";
	}
	$sql_search .= " ) ";
	$sst = "b.samu_receive_no";
	$sod = "desc";
}
//����ڵ�Ϲ�ȣ �̵��
if($stx_biz_no_input_not) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.biz_no = '-' or a.biz_no = '') ";
	$sql_search .= " ) ";
}
//����������ȣ �̵��
if($stx_t_no_input_not) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.t_insureno = '-' or a.t_insureno = '') ";
	$sql_search .= " ) ";
}
//�繫��Ź���� �̵��
if($samu_req_yn_input_not) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.samu_req_yn = '') ";
	$sql_search .= " ) ";
}
//�ּҰ˻�
if ($stx_addr) {
	if ($stx_addr_first) $addr_first = "";
	else $addr_first = "%";
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_juso like '".$addr_first;
	$sql_search .= "$stx_addr%') ";
	$sql_search .= " ) ";
}
//���豸��
if ($stx_samu_state_total != "2" && $stx_samu_state) {
	$sql_search .= " and ( ";
	if($stx_samu_state == "1") $sql_search .= " (a.samu_state_gy <> '') ";
	else if($stx_samu_state == "2") $sql_search .= " (a.samu_state_sj <> '') ";
	$sql_search .= " ) ";
}
//�ΰ���������
if($stx_levy_kind) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.levy_kind = '$stx_levy_kind') ";
	$sql_search .= " ) ";
}
//�������� ����/�Ҹ� : �ʱ⼱�� ����
if(!$stx_samu_state_total) $stx_samu_state_total = "1";
if($stx_samu_state_total != "all") {
	if($stx_samu_state_total == "2") {
		if($stx_samu_state == "1") {
			$sql_search .= " and (a.samu_state_gy = '2') ";
			if($stx_samu_state_total_only) $sql_search .= " and (a.samu_state_sj = '1') ";
		} else if($stx_samu_state == "2") {
			$sql_search .= " and (a.samu_state_sj = '2') ";
			if($stx_samu_state_total_only) $sql_search .= " and (a.samu_state_gy = '1') ";
		} else {
			$sql_search .= " and (a.samu_state_gy = '2' or a.samu_state_sj = '2') ";
		}
	} else if($stx_samu_state_total == "1") {
		if($stx_samu_state == "1") {
			$sql_search .= " and (a.samu_state_gy <> '2') ";
			if($stx_samu_state_total_only) $sql_search .= " and (a.samu_state_sj = '2') ";
		} else if($stx_samu_state == "2") {
			$sql_search .= " and (a.samu_state_sj <> '2') ";
			if($stx_samu_state_total_only) $sql_search .= " and (a.samu_state_gy = '2') ";
		} else {
			$sql_search .= " and (a.samu_state_gy <> '2' or a.samu_state_sj <> '2') ";
		}
	}
}
//������������
if($stx_samu_branch) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.samu_branch = '$stx_samu_branch') ";
	$sql_search .= " ) ";
}
//�������
if($stx_employer_insure) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.employer_insure = '$stx_employer_insure') ";
	$sql_search .= " ) ";
}
//��������
if($stx_samu_charge) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.samu_charge = '$stx_samu_charge') ";
	$sql_search .= " ) ";
}

$sst = "b.samu_receive_no";
$sod = "desc";
$sql_order = " order by $sst $sod ";
$sql = " select * $sql_common $sql_search $sql_order ";
$result = sql_query($sql);

$cell = array("���No","��ŹNo","��No","�������","�ΰ�����","������","�����ȣ","�⺻�ּ�","���ּ�","����ڵ�Ϲ�ȣ","����������ȣ","��ȭ��ȣ","�ѽ���ȣ","��ǥ��","�ڵ���","���������","�̸���","����","����","��Ź������","��������","��������","ó����Ȳ","�ǰ�EDI","���","����","������","�����");

$now_date_file = date("Ymd");
$file_name = "�繫��Ź��Ȳ_".$now_date_file.".xls";
header("Pragma:");
header("Cache-Control:");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
header("Content-Description: PHP5 Generated Data");
?>
<style type="text/css">
table { font-size:10px; }
</style>
<table width='1250' border='1' cellspacing=1 cellpadding=3 bgcolor="#5B8398">
			<tr bgcolor="65CBFF" align=center>
<?
$colspan = count($cell);
for($i=0; $i<count($cell); $i++) {
?>
				<td align="center"><?=$cell[$i]?></td>
<?
}
//��Ź��ȣ ���� ��ȣ �ʱ�ȭ
$samu_receive_no_old = "";
// ����Ʈ ���
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;
	//�ŷ�ó �ڵ�
	$id = $row['com_code'];
	//��Ź����ó �ڵ�
	if($row['samu_receive_no']) {
		$samu_receive_no = "".$row['samu_receive_no']."";
	} else {
		$samu_receive_no = "-";
	}
	//��Ź��ȣ ���� ��ȣ
	$samu_receive_no_old = $row['samu_receive_no_old'];
	if(!$samu_receive_no_old) $samu_receive_no_old = "-";
	//�������
	$regdt = $row['regdt'];
	//������� ����
	if($regdt >= $search_sday && $regdt <= $search_eday) $regdt_color = "color:red";
	else $regdt_color = "";
	//����Ͻ�
	if($row['regdt_time'] != "0000-00-00 00:00:00") $regdt_time = $row['regdt_time'];
	else $regdt_time = "";
	//�ΰ�����
	$levy_kind_array = array("-","�ΰ�����","�����Ű�","�ΰ�+����");
	$levy_kind_code = $row['levy_kind'];
	if($row['levy_kind']) $levy_kind_text = $levy_kind_array[$levy_kind_code];
	else $levy_kind_text = "-";
	//������
	$com_name_full = $row['com_name'];
	$com_name = cut_str($com_name_full, 28, "..");
	//���������
	if($row['registration_day']) $registration_day = $row['registration_day'];
	else $registration_day = "";
	//���� ����
	if($row['upche_div'] == "2") {
		$upche_div = "����";
	} else {
		$upche_div = "����";
	}
	//�����ȣ
	$zip = $row['com_postno']." ";
	//�ּ�
	$com_juso_full = $row['com_juso']." ".$row['com_juso2'];
	$com_juso = cut_str($com_juso_full, 18, "..");
	//��ȭ��ȣ
	$com_tel = $row['com_tel'];
	//1544 ���� ������ȣ ����
	$com_tel_array = explode("-", $com_tel);
	if($com_tel_array[0] == "000") $com_tel = $com_tel_array[1]."-".$com_tel_array[2];
	//����ڵ�Ϲ�ȣ
	if($row['biz_no']) $biz_no = $row['biz_no'];
	else $biz_no = "-";
	//����������ȣ
	if($row['t_insureno']) $t_insureno = $row['t_insureno'];
	else $t_insureno = "";
	//��ǥ��
	$boss_name_full = $row['boss_name'];
	if($row['boss_name']) $boss_name = cut_str($boss_name_full, 10, "..");
	else $boss_name = "-";
	if($row['boss_hp']) $boss_hp = $row['boss_hp'];
	else $boss_hp = "";
	//������
	$damdang_code = $row['damdang_code'];
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "";
	//���Ŵ���
	$manage_cust_name = $row['manage_cust_name'];
	//�繫��Ź
	if($row['samu_req_yn'] == "0" || $row['samu_req_yn'] == "") {
		$samu_req = "";
	} else if($row['samu_req_yn'] == "1") {
		$samu_req = "��û";
	}
	//����
	$uptae_full = $row['uptae'];
	if($row['uptae']) $uptae = cut_str($uptae_full, 16, "..");
	else $uptae = "";
	if($uptae == "-") $uptae = "";
	//����
	$upjong_full = $row['upjong'];
	if($row['upjong']) $upjong = cut_str($upjong_full, 16, "..");
	else $upjong = "-";
	//�Ƿڼ�
	if($row['editdt']) $editdt = $row['editdt'];
	else $editdt = "-";
	if($editdt >= $search_sday && $editdt <= $search_eday) $editdt_color = "color:red";
	else $editdt_color = "";
	//��Ź��
	if($row['samu_receive_date']) $samu_receive_date = $row['samu_receive_date'];
	else $samu_receive_date = "-";
	if($samu_receive_date >= $search_sday && $samu_receive_date <= $search_eday) $samu_receive_date_color = "color:red";
	else $samu_receive_date_color = "";
	//������
	if($row['samu_req_date']) $samu_req_date = $row['samu_req_date'];
	else $samu_req_date = "-";
	if($samu_req_date >= $search_sday && $samu_req_date <= $search_eday) $samu_req_date_color = "color:red";
	else $samu_req_date_color = "";
	//������
	if($row['samu_close_date']) $samu_close_date = $row['samu_close_date'];
	else $samu_close_date = "";
	$samu_close_date_color = "";
	//ó������(�븮��, ���ڹο�)
	$agent_elect_public_text = array("����","ó����","�Ϸ�","������","�����û","ȸ������","�����Ϸ�","������û");
	//�븮��(����)
	if($row['agent_elect_public_edate']) {
		$agent_elect_public_edate = $row['agent_elect_public_edate'];
	} else {
		if($row['agent_elect_public_date']) $agent_elect_public_edate = "����";
		else $agent_elect_public_edate = "-";
		for ($k=0; $k<=7; $k++) {
			if($row['agent_elect_public_yn'] == ($k+1)) $agent_elect_public_edate = $agent_elect_public_text[$k];
		}
	}
	if($agent_elect_public_edate >= $search_sday && $agent_elect_public_edate <= $search_eday) $agent_elect_public_edate_color = "color:red";
	else $agent_elect_public_edate_color = "";
	//���ڹο�(����)
	if($row['agent_elect_center_edate']) {
		$agent_elect_center_edate = $row['agent_elect_center_edate'];
	} else {
		if($row['agent_elect_center_date']) $agent_elect_center_edate = "����";
		else $agent_elect_center_edate = "-";
		for ($k=0; $k<=7; $k++) {
			if($row['agent_elect_center_yn'] == ($k+1)) $agent_elect_center_edate = $agent_elect_public_text[$k];
		}
	}
	if($agent_elect_center_edate >= $search_sday && $agent_elect_center_edate <= $search_eday) $agent_elect_center_edate_color = "color:red";
	else $agent_elect_center_edate_color = "";
	//������Ȳ
	$review_process_array = Array("","������","�Ϸ�","�ش����");
	$review_process_code = $row['review_process'];
	if($row['review_process']) $review_process = $review_process_array[$review_process_code];
	else $review_process = "-";
	//�����빫
	$easynomu_process_array = Array("","���ʼ�����","�޿�������","�Ϸ�","����","����","���ϼ�����û");
	$easynomu_process_code = $row['easynomu_process'];
	if($row['easynomu_process']) $easynomu_process = $easynomu_process_array[$easynomu_process_code];
	else $easynomu_process = "-";
	//�����빫 ������
	if($easynomu_process_code == 3) {
		if($row['month_pay']) $easynomu_process = number_format($row['month_pay']);
	}
	//�������
	if($row['editdt']) $p_accept = "����";
	else $p_accept = "-";
	if($row['samu_receive_date']) $p_accept = "ó����";
	if($row['samu_req_date']) $p_accept = "ó����";
	if($row['agent_elect_public_date']) $p_accept = "ó����";
	if($row['agent_elect_center_date']) $p_accept = "ó����";
	if($row['easynomu_process']) $p_accept = "ó����";
	if($row['proxy'] == 1)  $p_accept = "����";
	else if($row['proxy'] == 3) $p_accept = "�Ϸ�";
	//ó����Ȳ (�繫��Ź)
	$samu_req_yn_array = Array("","�ݷ�","���Ӱ���","Ÿ����","����","����");
	$samu_req_yn_code = $row['samu_req_yn'];
	if($row['samu_req_yn']) $samu_req_yn_text = $samu_req_yn_array[$samu_req_yn_code];
	else $samu_req_yn_text = "-";
	//�ǰ�EDI����
	$health_req_yn_array = Array("","�ݷ�","���Ӱ���","Ÿ����","����","����");
	$health_req_yn_code = $row['health_req_yn'];
	if($row['health_req_yn']) $health_req_yn_text = $health_req_yn_array[$health_req_yn_code];
	else $health_req_yn_text = "-";
	//��ñٷ��� ���/����
	$persons_gy = $row['persons_gy'];
	$persons_sj = $row['persons_sj'];
	if($persons_gy == "0") $persons_gy = "";
	if($persons_sj == "0") $persons_sj = "";
	//������ : ������, �δ��, �Ǽ�
	$p_support = $row['p_support']."%";
	$p_contribution = $row['p_contribution']."%";
	$p_construction = $row['p_construction']."%";
	if($p_support == "0%") $p_support = "";
	if($p_contribution == "0%") $p_contribution = "";
	if($p_construction == "0%") $p_construction = "";
	//������
	if($row[proxy] == "1") {
		$proxy = "��";
	} else {
		$proxy = "";
	}
	//�����Ģ
	if($row[employment] > 0) {
		$employment = number_format($row[employment]);
	} else {
		$employment = "";
	}
	if($member['mb_level'] > 6 || $row['damdang_code'] == $member['mb_profile']) {
		$com_view = "samu_view.php?id=$id&w=u&$qstr&page=$page";
	} else {
		$com_view = "javascript:alert('�ش� �ŷ�ó ������ ������ ������ �����ϴ�.');";
	}
?>
			<tr bgcolor="#FFFFFF" align=center>
				<td align="center"><?=$id?></td>
				<td align="center"><?=$samu_receive_no?></td>
				<td align="center"><?=$samu_receive_no_old?></td>
				<td align="center"><?=$regdt?></td>
				<td align="center"><?=$levy_kind_text?></td>
				<td align="left" width="194"><?=$com_name_full?></td>
				<td align="center"><?=$zip?></td>
				<td align="left" width="168"><?=$row['com_juso']?></td>
				<td align="left" width="168"><?=$row['com_juso2']?></td>
				<td align="center"><?=$biz_no?></td>
				<td align="center"><?=$t_insureno?></td>
				<td align="center"><?=$com_tel?></td>
				<td align="center"><?=$row['com_fax']?></td>
				<td align="center"><?=$boss_name_full?></td>
				<td align="center"><?=$boss_hp?></td>
				<td align="center"><?=$registration_day?></td>
				<td align="left"><?=$row['com_mail']?></td>
				<td align="center"><?=$uptae?></td>
				<td align="left" width="215"><?=$upjong_full?></td>
				<td align="center"><?=$samu_receive_date?></td>
				<td align="center"><?=$samu_req_date?></td>
				<td align="center"><?=$samu_close_date?></td>
				<td align="center"><?=$samu_req_yn_text?></td>
				<td align="center"><?=$health_req_yn_text?></td>
				<td align="center"><?=$persons_gy?></td>
				<td align="center"><?=$persons_sj?></td>
				<td align="center"><?=$branch?></td>
				<td align="center"><?=$manage_cust_name?></td>
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

