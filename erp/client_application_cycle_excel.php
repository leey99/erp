<?
$sub_menu = "200400";
include_once("./_common.php");

$now_time_file = date("Ymd_His");

$sql_common = " from com_list_gy a, com_list_gy_opt b, erp_application c ";

//echo $member[mb_profile];
if($is_admin != "super") {
	//$stx_man_cust_name = $member[mb_profile];
}
//$is_admin = "super";
//echo $is_admin;
if($member['mb_level'] > 6 || $search_ok == "ok") {
	$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code ";
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
	$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code and a.damdang_code='$member[mb_profile]' ";
}
//������ ��û (�⺻ �˻�)
$sql_search .= " and c.application_cycle != '' and ( c.close_date >= '2015.01.01' or c.close_year >= 2015) ";

//�˻� : ������Ī
if($stx_comp_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_name like '%$stx_comp_name%') ";
	$sql_search .= " ) ";
}
//�˻� : ����������ȣ
if($stx_t_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.t_insureno like '%$stx_t_no%') ";
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
//�˻� : ��ȭ��ȣ
if($stx_comp_tel) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_tel like '%$stx_comp_tel%') ";
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
//�˻� : ���Ŵ���
if($stx_manage_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.manage_cust_name = '$stx_manage_name') ";
	$sql_search .= " ) ";
}
//�˻� : ����б� : ��
if($stx_close_year) {
	$sql_search .= " and ( ";
	$sql_search .= " (c.close_year = '$stx_close_year') ";
	$sql_search .= " ) ";
	$sst = "c.close_year";
	$sod = "desc";
}
//�˻� : ����б� : �б�
if($stx_close_quarter) {
	$sql_search .= " and ( ";
	$sql_search .= " (c.close_quarter = '$stx_close_quarter') ";
	$sql_search .= " ) ";
	$sst = "c.close_quarter";
	$sod = "desc";
}
//�˻� : �˻��Ⱓ
if($stx_search_day_chk) {
	$sst = "a.regdt";
	$sod = "desc";
	if($search_day_all || $search_day1 || $search_day2 || $search_day3 || $search_day4 || $search_day5 || $search_day6) $sql_search .= " and ( ";
	//����������
	if($search_day1) {
		$sql_search .= " ( (c.reapplication_date >= '$search_sday' and c.reapplication_date <= '$search_eday') ) ";
		$sst = "c.reapplication_date";
	}
	//��������
	if($search_day2) {
		if($search_day1) $sql_search .= " or ";
		$sql_search .= " (c.close_date >= '$search_sday' and c.close_date <= '$search_eday') ";
		$sst = "c.close_date";
	}
	//�����Ա���
	if($search_day3) {
		if($search_day1 || $search_day2) $sql_search .= " or ";
		$sql_search .= " (c.main_receipt_date >= '$search_sday' and c.main_receipt_date <= '$search_eday') ";
		$sst = "c.main_receipt_date";
	}
	//�ŷ�����
	if($search_day4) {
		if($search_day1 || $search_day2 || $search_day3) $sql_search .= " or ";
		$sql_search .= " (c.statement_date >= '$search_sday' and c.statement_date <= '$search_eday') ";
		$sst = "c.statement_date";
	}
	//���ݰ�꼭
	if($search_day5) {
		if($search_day1 || $search_day2 || $search_day3 || $search_day4) $sql_search .= " or ";
		$sql_search .= " (c.tax_invoice >= '$search_sday' and c.tax_invoice <= '$search_eday') ";
		$sst = "c.tax_invoice";
	}
	//��������
	if($search_day6) {
		if($search_day1 || $search_day2 || $search_day3 || $search_day4 || $search_day5) $sql_search .= " or ";
		$sql_search .= " (c.application_accept >= '$search_sday' and c.application_accept <= '$search_eday') ";
		$sst = "c.application_accept";
	}
	if($search_day_all || $search_day1 || $search_day2 || $search_day3 || $search_day4 || $search_day5 || $search_day6) $sql_search .= " ) ";
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
//�˻�2 : �Ƿڼ�
if ($stx_comp_gubun1) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.editdt != '') ";
	$sql_search .= " ) ";
}
//�˻�2 : ��Ź��
if ($stx_comp_gubun2) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.samu_receive_date != '') ";
	$sql_search .= " ) ";
}
//�˻�2 : �븮�μ���(����)
if ($stx_comp_gubun3) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.agent_elect_public_edate != '') ";
	$sql_search .= " ) ";
}
//�˻�2 : �븮�μ���(����)
if ($stx_comp_gubun4) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.agent_elect_center_edate != '') ";
	$sql_search .= " ) ";
}
//�˻�2 : �����빫
if ($stx_comp_gubun5) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.easynomu_yn = '1') ";
	$sql_search .= " ) ";
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

//����
if (!$sst) {
    $sst = "c.reapplication_date";
    $sod = "desc";
}
$sql_order = " order by $sst $sod ";
//ī��Ʈ
$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

//������ ��ü
//echo $page;
if($page == "all") $rows = 999;
else $rows = 20;

//������ �ֱ�100��
if ($stx_count) {
	$rows = $stx_count;
}
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$sub_title = "��û�ֱ�";
$g4[title] = $sub_title." : ������ : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 17;
//�˻� �Ķ���� ����
$qstr = "stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_biz_no=".$stx_biz_no."&stx_boss_name=".$stx_boss_name."&stx_comp_tel=".$stx_comp_tel."&stx_proxy=".$stx_proxy."&stx_comp_gubun1=".$stx_comp_gubun1."&stx_comp_gubun2=".$stx_comp_gubun2."&stx_comp_gubun3=".$stx_comp_gubun3."&stx_comp_gubun4=".$stx_comp_gubun4."&stx_comp_gubun5=".$stx_comp_gubun5."&stx_comp_gubun6=".$stx_comp_gubun6."&stx_man_cust_name=".$stx_man_cust_name."&stx_uptae=".$stx_uptae."&stx_upjong=".$stx_upjong."&search_ok=".$search_ok;
$qstr .= "&stx_client_receipt_date_chk=".$stx_client_receipt_date_chk."&stx_main_receipt_date_chk=".$stx_main_receipt_date_chk."&search_year=".$search_year."&search_month=".$search_month."&search_year_end=".$search_year_end."&search_month_end=".$search_month_end."&stx_search_day_chk=".$stx_search_day_chk."&search_sday=".$search_sday."&search_eday=".$search_eday."&stx_close_year=".$stx_close_year."&stx_close_quarter=".$stx_close_quarter;
$qstr .= "&search_day_all=".$search_day_all."&search_day1=".$search_day1."&search_day2=".$search_day2."&search_day3=".$search_day3."&search_day4=".$search_day4."&search_day5=".$search_day5."&search_day6=".$search_day6."&search_day7=".$search_day7."&search_day8=".$search_day8."&stx_biz_no_input_not=".$stx_biz_no_input_not."&stx_manage_name=".$stx_manage_name."&stx_count=".$stx_count;


$file_name = $sub_title."_".$now_time_file.".xls";
header("Pragma:");
header("Cache-Control:");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
header("Content-Description: PHP5 Generated Data");
?>
<style type="text/css">
table { font-size:10px; }
</style>
											<table width="1300" border="1" cellpadding="0" cellspacing="0" class="bgtable" style="">
												<tr>
													<td class="tdhead_center" width="46" rowspan="">No</td>
													<td class="tdhead_center" rowspan="">������</td>
													<td class="tdhead_center" width="50" rowspan="">����</td>
													<td class="tdhead_center" width="90" rowspan="">�����</td>
													<td class="tdhead_center" width="72" rowspan="">��������</td>
													<td class="tdhead_center" width="120" rowspan="">��û����</td>
													<td class="tdhead_center" width="48" rowspan="">������</td>
													<td class="tdhead_center" width="72" rowspan="">��û�ݾ�</td>
													<td class="tdhead_center" width="72" rowspan="">����ݾ�</td>
													<td class="tdhead_center" width="280" rowspan="">��û�Ⱓ<br></td>
													<td class="tdhead_center" width="72" rowspan="">����������</td>
													<td class="tdhead_center" width="60" rowspan="">���ᱸ��</td>
													<td class="tdhead_center" width="74" rowspan="">��������</td>
													<td class="tdhead_center" width="60" rowspan="">��û�ֱ�</td>
													<td class="tdhead_center" width="60" rowspan="">�����Ϸ�</td>
												</tr>
<?
// ����Ʈ ���
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;
	//�ŷ�ó �ڵ�
	$id = $row['com_code'];
	//��û����
	$application_kind_code = $row['application_kind'];
	$application_kind = $support_kind_array[$application_kind_code];
	//������ : ������, �δ��, �Ǽ�
	$p_support = $row['p_support']."%";
	$p_contribution = $row['p_contribution']."%";
	$p_construction = $row['p_construction']."%";
	if($p_support == "0%") $p_support = "-";
	if($p_support == "%") $p_support = "-";
	if($p_contribution == "0%") $p_contribution = "-";
	if($p_construction == "0%") $p_construction = "-";
	//��û����ݾ� / ���⿹��ݾ�
	if($row['application_fee_sum']) {
		$application_fee_sum = number_format($row['application_fee_sum']);
	} else {
		$application_fee_sum = "-";
	}
	if($row['application_fee_sum']) {
		if($row['p_support']) $application_fee_expect = number_format($row['application_fee_sum']*($row['p_support']/100));
		else $application_fee_expect = "-";
	} else {
		$application_fee_expect = "-";
	}
	//��û�Ⱓ/�б� ����
	$application_date_chk = explode(',',$row['application_date_chk']);
	//��û�б� 1
	$application_quarter_year = explode(',',$row['application_quarter_year']);
	$application_quarter = explode('_',$row['application_quarter']);
	$application_quarter_1 = explode(',',$application_quarter[0]);
	$application_quarter_2 = explode(',',$application_quarter[1]);
	$application_quarter_3 = explode(',',$application_quarter[2]);
	//��û�Ⱓ 1
	if($application_date_chk[0] == 1) {
		if($application_quarter_year[0]) {
			$application_date = $application_quarter_year[0]."��";
			if($application_quarter_1[0] == 1) $application_date .= "1.";
			if($application_quarter_1[1] == 1) $application_date .= "2.";
			if($application_quarter_1[2] == 1) $application_date .= "3.";
			if($application_quarter_1[3] == 1) $application_date .= "4.";
			$application_date .= "�б� ";
		} else {
			$application_date = "";
		}
		if($application_quarter_year[1]) {
			$application_date .= $application_quarter_year[1]."��";
			if($application_quarter_2[0] == 1) $application_date .= "1.";
			if($application_quarter_2[1] == 1) $application_date .= "2.";
			if($application_quarter_2[2] == 1) $application_date .= "3.";
			if($application_quarter_2[3] == 1) $application_date .= "4.";
			$application_date .= "�б� ";
		}
		if($application_quarter_year[2]) {
			$application_date .= $application_quarter_year[2]."��";
			if($application_quarter_3[0] == 1) $application_date .= "1.";
			if($application_quarter_3[1] == 1) $application_date .= "2.";
			if($application_quarter_3[2] == 1) $application_date .= "3.";
			if($application_quarter_3[3] == 1) $application_date .= "4.";
			$application_date .= "�б�";
		}
	} else {
		if($row['application_date_start']) $application_date = $row['application_date_start']."~".$row['application_date_end'];
		else $application_date = "-";
	}
	//��������
	if($row['application_accept']) $application_accept = $row['application_accept'];
	else $application_accept = "";
	//����������
	if($row['reapplication_date']) $reapplication_date = $row['reapplication_date'];
	else $reapplication_date = "";
	//���������� ����
	if($search_day1) {
		if($reapplication_date >= $search_sday && $reapplication_date <= $search_eday) $reapplication_date_color = "color:red";
		else $reapplication_date_color = "";
	}
	//���ᱸ��
	if($row['close_kind'] == 1) {
		$close_kind = "�б�";
		$close_kind_title = $row['close_year']."��".$row['close_quarter']."�б�";
	} else {
		if($row['close_date']) {
			$close_kind = "�Ⱓ";
			$close_kind_title = $row['close_date'];
		} else {
			$close_kind = "";
			$close_kind_title = "";
		}
	}
	//��û�ֱ�
	if($row['application_cycle'] == 1) {
		$application_cycle = "�ſ�";
	} else if($row['application_cycle'] == 2) {
		$application_cycle = "�б�";
	} else {
		$application_cycle = "";
	}
	//�����Ϸ�
	if($row['reapplication_done'] == 1) $reapplication_done_text = "�Ϸ�";
	else $reapplication_done_text = "";
	//�ŷ�����
	if($row['statement_date']) $statement_date = $row['statement_date'];
	else $statement_date = "-";
	//���ݰ�꼭
	if($row['tax_invoice']) $tax_invoice = $row['tax_invoice'];
	else $tax_invoice = "-";
	//������
	$com_name_full = $row['com_name'];
	$com_name = cut_str($com_name_full, 28, "..");
	//����ڵ�Ϲ�ȣ
	if($row['biz_no']) $biz_no = $row['biz_no'];
	else $biz_no = "-";
	//����������ȣ
	if($row['t_insureno']) $t_insureno = $row['t_insureno'];
	else $t_insureno = "-";
	//��ǥ��
	$boss_name_full = $row['boss_name'];
	if($row['boss_name']) $boss_name = cut_str($boss_name_full, 14, "..");
	else $boss_name = "-";
	//������
	$damdang_code = $row['damdang_code'];
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "-";
	//���Ŵ���
	$manage_cust_name = $row['manage_cust_name'];
?>
												<tr class="list_row_now_wh" onMouseOver="" onMouseOut="">
													<td class="ltrow1_center_h22"><?=$no?></td>
													<td class="ltrow1_left_h22" title="<?=$com_name_full?>">
														<?=$com_name?>
													</td>
													<td class="ltrow1_center_h22"><?=$branch?></td>
													<td class="ltrow1_center_h22"><?=$manage_cust_name?></td>
													<td class="ltrow1_center_h22"><?=$application_accept?></td>
													<td class="ltrow1_left_h22" style=""><?=$application_kind?></td>
													<td class="ltrow1_center_h22"><?=$p_support?></td>
													<td class="ltrow1_right_h22_padding"><?=$application_fee_sum?></td>
													<td class="ltrow1_right_h22_padding"><?=$application_fee_expect?></td>
													<td class="ltrow1_left_h22"><?=$application_date?></td>
													<td class="ltrow1_center_h22"><?=$reapplication_date?></td>
													<td class="ltrow1_center_h22"><?=$close_kind?></td>
													<td class="ltrow1_center_h22"><?=$close_kind_title?></td>
													<td class="ltrow1_center_h22"><?=$application_cycle?></td>
													<td class="ltrow1_center_h22"><?=$reapplication_done_text?></td>
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
