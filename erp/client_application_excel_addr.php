<?
$sub_menu = "200100";
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
$sql_search .= " and ( c.application_kind != '0' and c.application_kind != '' ) ";

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
//�˻� : ��ü�Ա���
if($stx_client_receipt_date_chk) {
	$sql_search .= " and ( ";
	if($stx_client_receipt_date_chk == 1) {
		$sql_search .= " (c.client_receipt_date != '') ";
	} else if($stx_client_receipt_date_chk == 2) {
		$sql_search .= " (c.client_receipt_date = '') ";
	}
	$sql_search .= " ) ";
	$sst = "c.client_receipt_date";
	$sod = "desc";
}
//�˻� : �����Ա���
if($stx_main_receipt_date_chk) {
	$sql_search .= " and ( ";
	if($stx_main_receipt_date_chk == 1) {
		$sql_search .= " (c.main_receipt_date != '') ";
	} else if($stx_main_receipt_date_chk == 2) {
		$sql_search .= " (c.main_receipt_date = '') ";
	}
	$sql_search .= " ) ";
	$sst = "c.main_receipt_date";
	$sod = "desc";
}
//�˻� : �˻��Ⱓ
if($stx_search_day_chk) {
	$sst = "a.regdt";
	$sod = "desc";
	if($search_day_all || $search_day1 || $search_day2 || $search_day3 || $search_day4 || $search_day5 || $search_day6 || $search_day7) $sql_search .= " and ( ";
	//����������
	if($search_day1) {
		$sql_search .= " ( (c.reapplication_date >= '$search_sday' and c.reapplication_date <= '$search_eday') ) ";
		$sst = "c.reapplication_date";
	}
	//��ü�Ա���
	if($search_day2) {
		if($search_day1) $sql_search .= " or ";
		$sql_search .= " (c.client_receipt_date >= '$search_sday' and c.client_receipt_date <= '$search_eday') ";
		$sst = "c.client_receipt_date";
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
	//���� �Ա���
	if($search_day7) {
		if($search_day1 || $search_day2 || $search_day3 || $search_day4 || $search_day5 || $search_day6) $sql_search .= " or ";
		$sql_search .= " (c.down_payment_date >= '$search_sday' and c.down_payment_date <= '$search_eday') ";
		$sst = "c.down_payment_date";
	}
	if($search_day_all || $search_day1 || $search_day2 || $search_day3 || $search_day4 || $search_day5 || $search_day6 || $search_day7) $sql_search .= " ) ";
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
//�˻� : �����Ϸ�
if($stx_reapplication_done) {
	$sql_search .= " and ( ";
	if($stx_reapplication_done == "ing") $sql_search .= " (c.reapplication_done = '') ";
	else $sql_search .= " (c.reapplication_done = '$stx_reapplication_done') ";
	$sql_search .= " ) ";
}
//������ ��û����
if($stx_application_kind) {
	$sql_search .= " and ( ";
	$sql_search .= " (c.application_kind = '$stx_application_kind') ";
	$sql_search .= " ) ";
}
//����
if (!$sst) {
    $sst = "c.application_accept";
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

$sub_title = "��������Ȳ";
$g4[title] = $sub_title." : ������ : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          ";
//echo $sql;
//exit;
$result = sql_query($sql);
$colspan = 18;

$file_name = "��������Ȳ_".$now_time_file.".xls";
header("Pragma:");
header("Cache-Control:");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
header("Content-Description: PHP5 Generated Data");
?>
<style type="text/css">
table { font-size:10px; }
.bgtable {  }
.tdhead_center { background-color:#e2e2e2;;text-align:center; }
</style>
											<table border="1" cellpadding="0" cellspacing="0" class="bgtable" style="">
												<tr>
													<td class="tdhead_center" width="30" rowspan="">No</td>
													<td class="tdhead_center" width="40" rowspan="">Code</td>
													<td class="tdhead_center" width="150">������</td>
													<td class="tdhead_center" width="90">��ǥ�ڸ�</td>
													<td class="tdhead_center" width="90">��ü�����</td>
													<td class="tdhead_center" width="300" rowspan="">�ּ�</td>
													<td class="tdhead_center" width="82" rowspan="">��ȭ��ȣ</td>
													<td class="tdhead_center" width="82" rowspan="">�ѽ���ȣ</td>
													<td class="tdhead_center" width="60" rowspan="">����</td>
													<td class="tdhead_center" width="60" rowspan="">�����</td>
													<td class="tdhead_center" width="50" rowspan="">�����Ϸ�</td>
													<td class="tdhead_center" width="72" rowspan="">��������</td>
													<td class="tdhead_center" width="120" rowspan="">��û����</td>
													<td class="tdhead_center" width="48" rowspan="">������</td>
													<td class="tdhead_center" width="72" rowspan="">��û�ݾ�</td>
													<td class="tdhead_center" width="70" rowspan="">����ݾ�</td>
													<td class="tdhead_center" width="160" rowspan="">��û�Ⱓ<br></td>
													<td class="tdhead_center" width="72" rowspan="">����������</td>
													<td class="tdhead_center" width="68" rowspan="">����Ա���</td>
													<td class="tdhead_center" width="72" rowspan="">����</td>
													<td class="tdhead_center" width="68" rowspan="">��ü�Ա���</td>
													<td class="tdhead_center" width="72" rowspan="">��ü�Աݾ�</td>
													<td class="tdhead_center" width="68" rowspan="">�����Ա���</td>
													<td class="tdhead_center" width="72" rowspan="">�����Աݾ�</td>
													<td class="tdhead_center" width="68" rowspan="">�ŷ�����</td>
													<td class="tdhead_center" width="68" rowspan="">���ݰ�꼭</td>
													<td class="tdhead_center" width="150" rowspan="">�޸�</td>
												</tr>
<?
// ����Ʈ ���
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $total_count - $i;
  $list = $i%2;
	//�ŷ�ó �ڵ�
	$id = $row['com_code'];
	//��Ź����ó �ڵ�
	if($row['samu_receive_no']) {
		$samu_receive_no = "(".$row['samu_receive_no'].")";
	} else {
		$samu_receive_no = "";
	}
	//�������
	$regdt = $row['regdt'];
	//������� ����
	if($regdt >= $search_sday && $regdt <= $search_eday) $regdt_color = "color:red";
	else $regdt_color = "";
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
	//��û�ݾ� / ����ݾ� �հ�
	$afs = str_replace(',','',$application_fee_sum);
	$application_fee_sum_sum += ($afs);
	$afe = str_replace(',','',$application_fee_expect);
	$application_fee_expect_sum += ($afe);
	//��û�Ⱓ/�б� ����
	$application_date_chk = $row['application_date_chk'];
	//��û�б� 1
	$application_quarter_year = explode(',',$row['application_quarter_year']);
	$application_quarter = explode('_',$row['application_quarter']);
	$application_quarter_1 = explode(',',$application_quarter[0]);
	$application_quarter_2 = explode(',',$application_quarter[1]);
	$application_quarter_3 = explode(',',$application_quarter[2]);
	if($application_date_chk == 1) {
		$application_date = "�б�";
		if($application_quarter_year[0]) {
			$application_date_title = $application_quarter_year[0]."�� ";
			if($application_quarter_1[0] == 1) $application_date_title .= "1.";
			if($application_quarter_1[1] == 1) $application_date_title .= "2.";
			if($application_quarter_1[2] == 1) $application_date_title .= "3.";
			if($application_quarter_1[3] == 1) $application_date_title .= "4.";
			$application_date_title .= "�б�";
		} else {
			$application_date_title = "-\n";
		}
		if($application_quarter_year[1]) {
			$application_date_title .= "\n".$application_quarter_year[1]."�� ";
			if($application_quarter_2[0] == 1) $application_date_title .= "1.";
			if($application_quarter_2[1] == 1) $application_date_title .= "2.";
			if($application_quarter_2[2] == 1) $application_date_title .= "3.";
			if($application_quarter_2[3] == 1) $application_date_title .= "4.";
			$application_date_title .= "�б�";
		}
		if($application_quarter_year[2]) {
			$application_date_title .= "\n".$application_quarter_year[2]."�� ";
			if($application_quarter_3[0] == 1) $application_date_title .= "1.";
			if($application_quarter_3[1] == 1) $application_date_title .= "2.";
			if($application_quarter_3[2] == 1) $application_date_title .= "3.";
			if($application_quarter_3[3] == 1) $application_date_title .= "4.";
			$application_date_title .= "�б�";
		}
	} else {
		if($row['application_date_start']) {
			$application_date = "�Ⱓ";
			$application_date_title = $row['application_date_start']."~".$row['application_date_end'];
		} else {
			$application_date = "-";
			$application_date_title = "";
		}
	}
	//��������
	if($row['application_accept']) $application_accept = $row['application_accept'];
	else $application_accept = "-";
	//�������� ����
	if($search_day6) {
		if($application_accept >= $search_sday && $application_accept <= $search_eday) $application_accept_color = "color:red";
		else $application_accept_color = "";
	}
	//����������
	if($row['reapplication_date']) $reapplication_date = $row['reapplication_date'];
	else $reapplication_date = "-";
	//���������� ����
	if($search_day1) {
		if($reapplication_date >= $search_sday && $reapplication_date <= $search_eday) $reapplication_date_color = "color:red";
		else $reapplication_date_color = "";
	}
	//����Ա���
	if($row['down_payment_date']) $down_payment_date = $row['down_payment_date'];
	else $down_payment_date = "-";
	//����
	if($row['down_payment']) $down_payment = number_format($row['down_payment']);
	else $down_payment = "-";
	//��ü�Ա���
	if($row['client_receipt_date']) $client_receipt_date = $row['client_receipt_date'];
	else $client_receipt_date = "-";
	//��ü�Ա��� ����
	if($search_day2) {
		if($client_receipt_date >= $search_sday && $client_receipt_date <= $search_eday) $client_receipt_date_color = "color:red";
		else $client_receipt_date_color = "";
	}
	//��ü�Աݾ�
	if($row['client_receipt_fee']) {
		$client_receipt_fee = number_format($row['client_receipt_fee'])."<br>";
	} else {
		$client_receipt_fee = "-<br>";
	}
	if($application_kind2) {
		if($row['client_receipt_fee2']) {
			$client_receipt_fee2 = number_format($row['client_receipt_fee2'])."<br>";
		} else {
			$client_receipt_fee2 = "-<br>";
		}
	} else {
		$client_receipt_fee2 = "";
	}
	if($application_kind3) {
		if($row['client_receipt_fee3']) {
			$client_receipt_fee3 = number_format($row['client_receipt_fee3'])."<br>";
		} else {
			$client_receipt_fee3 = "-<br>";
		}
	} else {
		$client_receipt_fee3 = "";
	}
	if($application_kind4) {
		if($row['client_receipt_fee4']) {
			$client_receipt_fee4 = number_format($row['client_receipt_fee4'])."<br>";
		} else {
			$client_receipt_fee4 = "-<br>";
		}
	} else {
		$client_receipt_fee4 = "";
	}
	if($application_kind5) {
		if($row['client_receipt_fee5']) {
			$client_receipt_fee5 = number_format($row['client_receipt_fee5'])."<br>";
		} else {
			$client_receipt_fee5 = "-<br>";
		}
	} else {
		$client_receipt_fee5 = "";
	}
	//��ü�Աݾ� �հ�
	$crf = str_replace(',','',$client_receipt_fee);
	$crf2 = str_replace(',','',$client_receipt_fee2);
	$crf3 = str_replace(',','',$client_receipt_fee3);
	$crf4 = str_replace(',','',$client_receipt_fee4);
	$crf5 = str_replace(',','',$client_receipt_fee5);
	$client_receipt_fee_sum += ($crf+$crf2+$crf3+$crf4+$crf5);
	//�����Ա���
	if($row['main_receipt_date']) $main_receipt_date = $row['main_receipt_date']."<br>";
	else $main_receipt_date = "-<br>";
	if($application_kind2) {
		if($row['main_receipt_date2']) $main_receipt_date2 = $row['main_receipt_date2']."<br>";
		else $main_receipt_date2 = "-<br>";
	} else {
		$main_receipt_date2 = "";
	}
	if($application_kind3) {
		if($row['main_receipt_date3']) $main_receipt_date3 = $row['main_receipt_date3']."<br>";
		else $main_receipt_date3 = "-<br>";
	} else {
		$main_receipt_date3 = "";
	}
	if($application_kind4) {
		if($row['main_receipt_date4']) $main_receipt_date4 = $row['main_receipt_date4']."<br>";
		else $main_receipt_date4 = "-<br>";
	} else {
		$main_receipt_date4 = "";
	}
	if($application_kind5) {
		if($row['main_receipt_date5']) $main_receipt_date5 = $row['main_receipt_date5']."";
		else $main_receipt_date5 = "-";
	} else {
		$main_receipt_date5 = "";
	}
	//�����Ա��� ����
	if($search_day3) {
		if($main_receipt_date >= $search_sday && $main_receipt_date <= $search_eday) $main_receipt_date_color = "color:red";
		else $main_receipt_date_color = "";
	}
	//�����Աݾ�
	if($row['main_receipt_fee']) $main_receipt_fee = number_format($row['main_receipt_fee']);
	else $main_receipt_fee = "-";
	//�ŷ�����
	if($row['statement_date']) $statement_date = $row['statement_date']."<br>";
	else $statement_date = "-<br>";
	if($application_kind2) {
		if($row['statement_date2']) $statement_date2 = $row['statement_date2']."<br>";
		else $statement_date2 = "-<br>";
	} else {
		$statement_date2 = "";
	}
	if($application_kind3) {
		if($row['statement_date3']) $statement_date3 = $row['statement_date3']."<br>";
		else $statement_date3 = "-<br>";
	} else {
		$statement_date3 = "";
	}
	if($application_kind4) {
		if($row['statement_date4']) $statement_date4 = $row['statement_date4']."<br>";
		else $statement_date4 = "-<br>";
	} else {
		$statement_date4 = "";
	}
	if($application_kind5) {
		if($row['statement_date5']) $statement_date5 = $row['statement_date5']."";
		else $statement_date5 = "-";
	} else {
		$statement_date5 = "";
	}
	//�ŷ����� ����
	if($search_day4) {
		if($statement_date >= $search_sday && $statement_date <= $search_eday) $statement_date_color = "color:red";
		else $statement_date_color = "";
	}
	//���ݰ�꼭
	if($row['tax_invoice']) $tax_invoice = $row['tax_invoice']."<br>";
	else $tax_invoice = "-<br>";
	if($application_kind2) {
		if($row['tax_invoice2']) $tax_invoice2 = $row['tax_invoice2']."<br>";
		else $tax_invoice2 = "-<br>";
	} else {
		$tax_invoice2 = "";
	}
	if($application_kind3) {
		if($row['tax_invoice3']) $tax_invoice3 = $row['tax_invoice3']."<br>";
		else $tax_invoice3 = "-<br>";
	} else {
		$tax_invoice3 = "";
	}
	if($application_kind4) {
		if($row['tax_invoice4']) $tax_invoice4 = $row['tax_invoice4']."<br>";
		else $tax_invoice4 = "-<br>";
	} else {
		$tax_invoice4 = "";
	}
	if($application_kind5) {
		if($row['tax_invoice5']) $tax_invoice5 = $row['tax_invoice5']."";
		else $tax_invoice5 = "-";
	} else {
		$tax_invoice5 = "";
	}
	//�ŷ����� ����
	if($search_day5) {
		if($tax_invoice >= $search_sday && $tax_invoice <= $search_eday) $tax_invoice_color = "color:red";
		else $tax_invoice_color = "";
	}
	//������
	$com_name_full = $row['com_name'];
	$com_name = cut_str($com_name_full, 28, "..");
	//�����Ϸ� : �ݷ�
	if($row['reapplication_done'] == 2) $reapplication_done_return = "<span style='color:red;'>(�ݷ�)</span>";
	else $reapplication_done_return = "";
	//���������
	if($row['registration_day']) $registration_day = $row['registration_day'];
	else $registration_day = "-";
	//���� ����
	if($row['upche_div'] == "2") {
		$upche_div = "����";
	} else {
		$upche_div = "����";
	}
	$com_juso_full = $row['com_juso']." ".$row['com_juso2'];
	$com_juso = cut_str($com_juso_full, 18, "..");
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
	//����
	$uptae_full = $row['uptae'];
	if($row['uptae']) $uptae = cut_str($uptae_full, 16, "..");
	else $uptae = "-";
	//����
	$upjong_full = $row['upjong'];
	if($row['upjong']) $upjong = cut_str($upjong_full, 16, "..");
	else $upjong = "-";
	//�����Ϸ�
	$reapplication_done_code = $row['reapplication_done'];
	$reapplication_done = $reapplication_done_array[$reapplication_done_code];
	if(!$reapplication_done) $reapplication_done = "-";
	//�޸�(����)
	$app_memo = $row['app_memo'];	
	//�ּ�
	$com_juso_full = $row['com_juso']." ".$row['com_juso2'];
	$com_juso = cut_str($com_juso_full, 18, "..");
	$com_tel = $row['com_tel'];
	//��ǥ��
	$boss_name_full = $row['boss_name'];
	if($row['boss_name']) $boss_name = cut_str($boss_name_full, 10, "..");
	else $boss_name = "-";
	$manage_cust_name = $row['manage_cust_name'];
	//��ü�����
	if($row['com_damdang']) $com_damdang = $row['com_damdang'];
	else $com_damdang = "-";
?>
												<tr class="list_row_now_wh" onMouseOver="" onMouseOut="">
													<td class="ltrow1_center_h22"><?=$no?></td>
													<td class="ltrow1_center_h22"><?=$id?></td>
													<td class="ltrow1_left_h22">
														<?=$com_name_full?>
													</td>
													<td align="center"><?=$boss_name?></td>
													<td align="center"><?=$com_damdang?></td>
													<td align="ltrow1_left_h22"><?=$com_juso_full?></td>
													<td align="center"><?=$com_tel?></td>
													<td align="center"><?=$row['com_fax']?></td>
													<td align="center"><?=$branch?></td>
													<td align="center"><?=$manage_cust_name?></td>
													<td align="center"><?=$reapplication_done?></td>
													<td align="center"><?=$application_accept?></td>
													<td class="ltrow1_left_h22" style=""><?=$application_kind?></td>
													<td class="ltrow1_center_h22"><?=$p_support?></td>
													<td class="ltrow1_right_h22_padding"><?=$application_fee_sum?></td>
													<td class="ltrow1_right_h22_padding"><?=$application_fee_expect?></td>
													<td class="ltrow1_left_h22"><?=$application_date_title?></td>
													<td align="center"><?=$reapplication_date?></td>
													<td align="center"><?=$down_payment_date?></td>
													<td class="ltrow1_right_h22_padding"><?=$down_payment?></td>
													<td align="center"><?=$client_receipt_date?></td>
													<td class="ltrow1_right_h22_padding"><?=$client_receipt_fee?></td>
													<td align="center"><?=$main_receipt_date?></td>
													<td class="ltrow1_right_h22_padding"><?=$main_receipt_fee?></td>
													<td align="center"><?=$statement_date?></td>
													<td align="center"><?=$tax_invoice?></td>
													<td align="ltrow1_left_h22"><?=$app_memo?></td>
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
