<?
$sub_menu = "500300";
include_once("./_common.php");

//���� ����
if(!$total_year_fix) $total_year_fix = 2015;

//�����Ѿ׽Ű�DB �˻��� ���̺� �߰�
if($stx_total_year || $stx_total_input1 || $stx_total_input2 || $stx_total_input3 || $stx_total_input4 || $stx_total_input5 || $stx_total_input6 || $stx_total_process || $stx_gg_process || $stx_ok_date || $stx_input_date) {
	$add_db_table = ", com_total_pay d ";
	$add_sql_search = "and a.com_code=d.com_code";
} else {
	$add_db_table = "";
	$add_sql_search = "";
}
$sql_common = " from com_list_gy a, com_list_gy_opt b, com_list_gy_opt2 c $add_db_table ";

if($member['mb_level'] > 6 || $search_ok == "ok") {
	$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code $add_sql_search ";
	//���� ������� ����
	if($member['mb_level'] == 7) {
		$mb_id = $member['mb_id'];
		//���Ŵ��� �ڵ� üũ
		$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
		$row_manage = sql_fetch($sql_manage);
		$manage_code = $row_manage['code'];
		$sql_search .= " and b.manage_cust_numb='$manage_code' ";
	}
} else {
	$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code $add_sql_search and a.damdang_code='$member[mb_profile]' ";
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
//�˻� : TM�Ŵ���
if($stx_tm_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.tm_cust_name = '$stx_tm_name') ";
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
//�˻� : ����
if ($stx_uptae) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.uptae like '%$stx_uptae%') ";
	$sql_search .= " ) ";
}
//�˻� : ���� : ���� ��
if($stx_uptae_non) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.uptae not like '%�����ü�%' and a.uptae not like '%��ȸ����%' and a.uptae not like '%����%') ";
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
//�繫��Ź���� : �ʱ⼱�� ���� -> ��ü  150226
if(!$samu_req_yn) $samu_req_yn = "all";
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
//�������� ����/�Ҹ� : �ʱ⼱�� ���� -> ��ü 150212
//if(!$stx_samu_state_total) $stx_samu_state_total = "1";
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
//�Ű�⵵
if($stx_total_year) {
	$sql_search .= " and ( ";
	$sql_search .= " (d.year = '$stx_total_year') ";
	$sql_search .= " ) ";
}
//���� : ��������
if($stx_total_input1 || $stx_total_input2 || $stx_total_input3 || $stx_total_input4 || $stx_total_input5 || $stx_total_input6) {
	$sql_search .= " and ( ";
	$stx_total_input_or = "";
	//���� : �����빫
	if($stx_total_input1) {
		$sql_search .= " d.easynomu = '$stx_total_input1' ";
		$stx_total_input_or = "or";
	}
	//���� : Ű��빫
	if($stx_total_input2) {
		$sql_search .= " $stx_total_input_or d.kidsnomu = '$stx_total_input2' ";
		$stx_total_input_or = "or";
	}
	//���� : ����
	if($stx_total_input3) {
		$sql_search .= " $stx_total_input_or d.duzon = '$stx_total_input3' ";
		$stx_total_input_or = "or";
	}
	//���� : �ѽ�
	if($stx_total_input4) {
		$sql_search .= " $stx_total_input_or d.fax = '$stx_total_input4' ";
		$stx_total_input_or = "or";
	}
	//���� : �ڷ�
	if($stx_total_input5) {
		$sql_search .= " $stx_total_input_or d.mail = '$stx_total_input5' ";
		$stx_total_input_or = "or";
	}
	//���� : ��Ÿ
	if($stx_total_input6) {
		$sql_search .= " $stx_total_input_or d.etc = '$stx_total_input6' ";
	}
	$sql_search .= " ) ";
}
//�Ű���Ȳ
if($stx_total_process) {
	//��������
	$stx_total_year = $total_year_fix;
	$sql_search .= " and (d.year = '$stx_total_year') ";
	$sql_search .= " and ( ";
	//������
	if($stx_total_process == "r") $sql_search .= " (d.ok_report = '') ";
	//�̽Ű�
	else if($stx_total_process == "n") $sql_search .= " (d.ok_report != '2' and d.input_date != '') ";
	else $sql_search .= " (d.ok_report = '$stx_total_process') ";
	$sql_search .= " ) ";
}
//�ǰ��Ű�
if($stx_gg_process) {
	//��������
	$stx_total_year = $total_year_fix;
	$sql_search .= " and (d.year = '$stx_total_year') ";
	$sql_search .= " and ( ";
	if($stx_gg_process == "r") $sql_search .= " (d.ok_report_gg = '') ";
	else if($stx_gg_process == "n") $sql_search .= " (d.ok_report_gg != '2' and d.input_date != '') ";
	else $sql_search .= " (d.ok_report_gg = '$stx_gg_process') ";
	$sql_search .= " ) ";
}
//��Ź����
if($stx_samu_keep) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.samu_keep = '$stx_samu_keep') ";
	$sql_search .= " ) ";
}
//��Ź������
if($stx_samu_close_date) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.samu_close_date = '$stx_samu_close_date') ";
	$sql_search .= " ) ";
}
//�Ű�����
if($stx_ok_date) {
	$sql_search .= " and ( ";
	$sql_search .= " (d.ok_date = '$stx_ok_date') ";
	$sql_search .= " ) ";
}
//��������
if($stx_input_date) {
	$sql_search .= " and ( ";
	$sql_search .= " (d.input_date = '$stx_input_date') ";
	$sql_search .= " ) ";
}
//����
$sst = "b.samu_receive_no";
$sod = "desc";
$sql_order = " order by $sst $sod ";
$sql = " select * $sql_common $sql_search $sql_order ";
$result = sql_query($sql);

$cell = array("��ŹNo","�������","�ΰ�����","��������","������","�����ȣ","�ּ�","���ּ�","����ڵ�Ϲ�ȣ","����������ȣ","��ȭ��ȣ","�ѽ���ȣ","�̸���","��ǥ��","���������","����","����","��Ź������","��������","��������","ó����Ȳ","�ǰ�EDI","���","����","������","�����","TM�Ŵ���","����(".($total_year_fix-1).")","�Ű�(".($total_year_fix-1).")","����(".$total_year_fix.")","�Ű�(".$total_year_fix.")","�Ű�����","�ǰ��Ű�");

$now_date_file = date("Ymd");
$file_name = "�����Ѿ׽Ű�_".$now_date_file.".xls";
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
	//echo $samu_receive_no." != ".$samu_receive_no_old." / ";
	if($samu_receive_no_old && $samu_receive_no != $samu_receive_no_old-1) $samu_receive_no_color = "color:red";
	else $samu_receive_no_color = "";
	//��Ź��ȣ ���� ��ȣ
	$samu_receive_no_old = $row['samu_receive_no'];
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
	//������
	$damdang_code = $row['damdang_code'];
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "";
	//���Ŵ���
	$manage_cust_name = $row['manage_cust_name'];
	//TM�Ŵ���
	$tm_cust_name = $row['tm_cust_name'];
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
	//TM�Ŵ���
	$tm_cust_name = $row['tm_cust_name'];
	//�����Ѿ� �Ű���Ȳ �迭
	$total_req_yn_array_2014 = Array("","ó����","�Ű�Ϸ�","��ü�Ű�","�ݷ�","��Ÿ");
	$total_req_yn_array = Array("","�ȳ��Ϸ�(1��)","�ȳ��Ϸ�(2��)","ó����","�Ű�Ϸ�","��ü�Ű�","�ݷ�","��������","�����Ϸ�");
	//�����ڷ� 2014 ~
	for($total_year=2014; $total_year<=$total_year_fix; $total_year++) {
		//�����Ѿ׽Ű� DB
		$sql_total = " select * from com_total_pay where com_code='$id' and year='$total_year' ";
		$result_total = sql_query($sql_total);
		$row_total = mysql_fetch_array($result_total);
		if($row_total['easynomu']) $total_input1[$total_year] = "����.";
		else $total_input1[$total_year] = "";
		if($row_total['kidsnomu']) $total_input2[$total_year] = "Ű��.";
		else $total_input2[$total_year] = "";
		if($row_total['duzon']) $total_input3[$total_year] = "����.";
		else $total_input3[$total_year] = "";
		if($row_total['fax']) $total_input4[$total_year] = "�ѽ�.";
		else $total_input4[$total_year] = "";
		if($row_total['mail']) $total_input5[$total_year] = "�ڷ�.";
		else $total_input5[$total_year] = "";
		if($row_total['etc']) $total_input6[$total_year] = "��Ÿ";
		else $total_input6[$total_year] = "";
		//��������
		if($row_total['input_date']) $total_input_date[$total_year] = $row_total['input_date'];
		else $total_input_date[$total_year] = "";
		//�Ű���Ȳ (�����Ѿ׽Ű�)
		$total_req_yn_code = $row_total['ok_report'];
		if($row_total['ok_report']) {
			//2014�� ���� �Ű���Ȳ 160308
			if($total_year <= 2014) $total_req_yn_text[$total_year] = $total_req_yn_array_2014[$total_req_yn_code];
			else $total_req_yn_text[$total_year] = $total_req_yn_array[$total_req_yn_code];
		} else {
			$total_req_yn_text[$total_year] = "-";
		}
		//�Ű�����
		if($row_total['ok_date']) $total_ok_date[$total_year] = $row_total['ok_date'];
		else $total_ok_date[$total_year] = "";
		//�ǰ��Ű�����
		if($row_total['ok_date_gg']) $total_ok_date_gg[$total_year] = $row_total['ok_date_gg'];
		else $total_ok_date_gg[$total_year] = "";
	}
	//���� ����� ȸ�� �� ǥ��
	if($samu_req_yn_code == '5') $tr_color = "#f3f3f3";
	else $tr_color = "#ffffff";
	//��������
	$sql_samu = " select * from com_samu where t_no='$t_insureno' ";
	$row_samu = sql_fetch($sql_samu);
	$samu_branch = $row_samu['samu_branch'];
?>
			<tr bgcolor="<?=$tr_color?>" align=center>
				<td align="center"><?=$samu_receive_no?></td>
				<td align="center"><?=$regdt?></td>
				<td align="center"><?=$levy_kind_text?></td>
				<td align="center"><?=$samu_branch?></td>
				<td align="left" width="194"><?=$com_name_full?></td>
				<td align="center"><?=$zip?></td>
				<td align="left" width="200"><?=$row['com_juso']?></td>
				<td align="left" width="200"><?=$row['com_juso2']?></td>
				<td align="center"><?=$biz_no?></td>
				<td align="center"><?=$t_insureno?></td>
				<td align="center"><?=$com_tel?></td>
				<td align="center"><?=$row['com_fax']?></td>
				<td align="left"><?=$row['com_mail']?></td>
				<td align="center"><?=$boss_name?></td>
				<td align="center"><?=$registration_day?></td>
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
				<td align="center"><?=$tm_cust_name?></td>
				<td align="center"><?=$total_input1[$total_year_fix-1]?><?=$total_input2[$total_year_fix-1]?><?=$total_input3[$total_year_fix-1]?><?=$total_input4[$total_year_fix-1]?><?=$total_input5[$total_year_fix-1]?><?=$total_input6[$total_year_fix-1]?></td>
				<td align="center"><?=$total_req_yn_text[$total_year_fix-1]?></td>
				<td align="center"><?=$total_input1[$total_year_fix]?><?=$total_input2[$total_year_fix]?><?=$total_input3[$total_year_fix]?><?=$total_input4[$total_year_fix]?><?=$total_input5[$total_year_fix]?><?=$total_input6[$total_year_fix]?></td>
				<td align="center"><?=$total_req_yn_text[$total_year_fix]?></td>
				<td align="center"><?=$total_ok_date[$total_year_fix]?></td>
				<td align="center"><?=$total_ok_date_gg[$total_year_fix]?></td>
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

