<?
$sub_menu = "400500";
include_once("./_common.php");

$sql_common = " from com_list_gy a, com_list_gy_opt b, samu_4insure c ";

//echo $member[mb_profile];
if($is_admin != "super") {
	//$stx_man_cust_name = $member[mb_profile];
}
//$is_admin = "super";
//echo $is_admin;
if($member['mb_level'] > 6 || $search_ok == "ok") {
	$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code ";
} else {
	$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code and ( a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]' ) ";
}
//�⺻ �˻� : ���� ����
$sql_search .= " and c.delete_yn = '' ";
//�˻� : ������Ī
if($stx_comp_name) {
	$sql_search .= " and a.com_name like '%$stx_comp_name%' ";
}
//�˻� : ����ڵ�Ϲ�ȣ
if($stx_biz_no) {
	$sql_search .= " and a.biz_no like '%$stx_biz_no%' ";
}
//�˻� : ��ǥ��
if($stx_boss_name) {
	$sql_search .= " and a.boss_name like '%$stx_boss_name%' ";
}
//�˻� : �����
if($stx_manage_name) {
	$sql_search .= " and b.manage_cust_name = '$stx_manage_name' ";
}
//�˻� : ����������ȣ
if($stx_t_no) {
	$sql_search .= " and a.t_insureno like '%$stx_t_no%' ";
}
//�˻� : ��ȭ��ȣ
if($stx_comp_tel) {
	$sql_search .= " and a.com_tel like '%$stx_comp_tel%' ";
}
//�˻� : �ѽ���ȣ
if($stx_comp_fax) {
	$sql_search .= " and a.com_fax like '%$stx_comp_fax%' ";
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
	$sql_search .= " and b.proxy = '$stx_proxy' ";
}
//�˻� : ����
if($stx_man_cust_name) {
	$sql_search .= " and a.damdang_code = '$stx_man_cust_name' ";
}
//�˻��Ⱓ => �Ű�����
if($stx_search_day_chk) {
	$sql_search .= " and (c.report_date >= '$search_sday' and c.report_date <= '$search_eday') ";
}
//�˻� : ����
if ($stx_uptae) {
	$sql_search .= " and a.uptae like '%$stx_uptae%' ";
}
//�˻� : ����
if ($stx_upjong) {
	$sql_search .= " and a.upjong like '%$stx_upjong%' ";
}
//�˻�2 : ��Ź��
if ($stx_comp_gubun2) {
	$sql_search .= " and b.samu_receive_date != '' ";
}
//�繫��Ź���� : �ʱ⼱�� ���� / ��ü �˻� 150326
//if(!$samu_req_yn) $samu_req_yn = "4";
if(!$samu_req_yn) $samu_req_yn = "all";
if ($samu_req_yn != "all") {
	$sql_search .= " and b.samu_req_yn = '$samu_req_yn' ";
}
//�ǰ�EDI����
if ($health_req_yn) {
	$sql_search .= " and b.health_req_yn = '$health_req_yn' ";
}
//��Ź��ȣ : �ʱ⼱�� �Է�
if(!$stx_samu_receive_no) $stx_samu_receive_no = "1";
if($stx_samu_receive_no != "all") {
	if($stx_samu_receive_no == 1) {
		$sql_search .= " and b.samu_receive_no != '' ";
	} else if($stx_samu_receive_no == 2) {
		$sql_search .= " and b.samu_receive_no = '' ";
	}
	$sst = "b.samu_receive_no+0";
	$sod = "desc";
}
//����ڵ�Ϲ�ȣ �̵��
if($stx_biz_no_input_not) {
	$sql_search .= " and (a.biz_no = '-' or a.biz_no = '') ";
}
//����������ȣ �̵��
if($stx_t_no_input_not) {
	$sql_search .= " and (a.t_insureno = '-' or a.t_insureno = '') ";
}
//�繫��Ź���� �̵��
if($samu_req_yn_input_not) {
	$sql_search .= " and b.samu_req_yn = '' ";
}
//�ּҰ˻�
if ($stx_addr) {
	if ($stx_addr_first) $addr_first = "";
	else $addr_first = "%";
	$sql_search .= " and a.com_juso like '".$addr_first;
	$sql_search .= "$stx_addr%' ";
}
//���豸��
if ($stx_samu_state_total != "2" && $stx_samu_state) {
	if($stx_samu_state == "1") $sql_search .= " and a.samu_state_gy <> '' ";
	else if($stx_samu_state == "2") $sql_search .= " and a.samu_state_sj <> '' ";
}
//�ΰ���������
if($stx_levy_kind) {
	$sql_search .= " and a.levy_kind = '$stx_levy_kind' ";
}
//�������� ����/�Ҹ� : �ʱ⼱�� ���� / �ٽ� ��ü�� ���� 150325
//if(!$stx_samu_state_total) $stx_samu_state_total = "1";
if($stx_samu_state_total != "all") {
	if($stx_samu_state_total == "2") {
		if($stx_samu_state == "1") {
			$sql_search .= " and a.samu_state_gy = '2' ";
			if($stx_samu_state_total_only) $sql_search .= " and a.samu_state_sj = '1' ";
		} else if($stx_samu_state == "2") {
			$sql_search .= " and a.samu_state_sj = '2' ";
			if($stx_samu_state_total_only) $sql_search .= " and a.samu_state_gy = '1' ";
		} else {
			$sql_search .= " and a.samu_state_gy = '2' or a.samu_state_sj = '2' ";
		}
	} else if($stx_samu_state_total == "1") {
		if($stx_samu_state == "1") {
			$sql_search .= " and a.samu_state_gy <> '2' ";
			if($stx_samu_state_total_only) $sql_search .= " and a.samu_state_sj = '2' ";
		} else if($stx_samu_state == "2") {
			$sql_search .= " and (a.samu_state_sj <> '2') ";
			if($stx_samu_state_total_only) $sql_search .= " and a.samu_state_gy = '2' ";
		} else {
			$sql_search .= " and a.samu_state_gy <> '2' or a.samu_state_sj <> '2' ";
		}
	}
}
//������������
if($stx_samu_branch) {
	$sql_search .= " and a.samu_branch = '$stx_samu_branch' ";
}
//�������
if($stx_employer_insure) {
	$sql_search .= " and a.employer_insure = '$stx_employer_insure' ";
}
//��������
if($stx_samu_charge) {
	$sql_search .= " and a.samu_charge = '$stx_samu_charge' ";
}
//�Ű���
if($stx_report_kind) {
	$sql_search .= " and c.report_kind = '$stx_report_kind' ";
}
//�ٷ��ڸ�
if($stx_staff_name) {
	$sql_search .= " and c.staff_name like '%$stx_staff_name%' ";
}
//�������
if($stx_input_type) {
	$sql_search .= " and c.input_type = '$stx_input_type' ";
}

//����
$sst = "c.report_time";
$sod = "desc";
$sst2 = "c.report_kind";
$sod2 = "desc";
$sql_order = " order by $sst $sod , $sst2 $sod2 ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 9999;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$sub_title = "�Ǻ����ڽŰ�";
$sql = " select *
          $sql_common
          $sql_search
          $sql_order
			";
//echo $sql;
$result = sql_query($sql);
$cell = array("No","�������","�Ű�����","�ٷ��ڸ�","�ֹε�Ϲ�ȣ","�������","�Ű���","���","����","����","�ǰ�","������","����ڵ�Ϲ�ȣ","����������ȣ","��ȭ��ȣ","�ѽ���ȣ","��ǥ��","����","��������","��������","�ǰ�EDI","������","�����");
$colspan = count($cell) + 1;
$now_date_file = date("Ymd");
$file_name = $sub_title."_".$now_date_file.".xls";
header("Pragma:");
header("Cache-Control:");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
header("Content-Description: PHP5 Generated Data");
?>
<meta http-equiv="Content-Type" content="application/vnd.ms-excel; charset=euc-kr">
<style type="text/css">
table { font-size:10px; }
</style>
<table width='1200' border='1' cellspacing="1" cellpadding="3" bgcolor="#5B8398">
			<tr bgcolor="65CBFF" align=center>
<?
for($i=0; $i<count($cell); $i++) {
?>
				<td align="center"><?=$cell[$i]?></td>
<?
}
// ����Ʈ ���
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;
	//�ŷ�ó �ڵ�
	$id = $row['com_code'];
	//�Ǻ����ڽŰ� �ڵ�
	$idx = $row['idx'];
	//��Ź����ó �ڵ�
	if($row['samu_receive_no'] > 0) {
		$samu_receive_no = $row['samu_receive_no']."<br>";
	} else if($row['samu_receive_no'] == "-") {
		$samu_receive_no = "";
	} else {
		$samu_receive_no = "";
	}
	//echo $samu_receive_no." != ".$samu_receive_no_old." / ";
	//if($samu_receive_no_old && $samu_receive_no != $samu_receive_no_old-1) $samu_receive_no_color = "color:red";
	//else $samu_receive_no_color = "";
	//��Ź��ȣ ���� ���� ���� 150318
	$samu_receive_no_color = "";
	//��Ź��ȣ ���� ��ȣ
	if($row['samu_receive_no_old']) {
		$samu_receive_no_old = $row['samu_receive_no_old'];
	} else {
		$samu_receive_no_old = "";
	}
	//�������
	$regdt = $row['regdt'];
	$date1 = substr($row['regdt'],0,10); //��¥ǥ�����ĺ���
	$samu_4insure_regdt_time = substr($row['regdt'],11,8); //�ð��� ǥ��
	$date = explode("-", $date1); 
	$year = $date[0];
	$month = $date[1]; 
	$day = $date[2]; 
	$samu_4insure_regdt = $year.".".$month.".".$day."";
	//�Ű�����
	$report_date = $row['report_date'];
	//�ΰ�����
	if($row['levy_kind'] == 1) $levy_kind = "�ΰ�����";
	else if($row['levy_kind'] == 2) $levy_kind = "�����Ű�";
	else $levy_kind = "-";
	//������
	$com_name_full = $row['com_name'];
	$com_name = cut_str($com_name_full, 28, "..");
	//���������
	if($row['registration_day']) $registration_day = $row['registration_day'];
	else $registration_day = "-";
	//���� ����
	if($row['upche_div'] == "2") {
		$upche_div = "����";
	} else {
		$upche_div = "����";
	}
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
	else $t_insureno = "-";
	//��ǥ��
	$boss_name_full = $row['boss_name'];
	if($row['boss_name']) $boss_name = cut_str($boss_name_full, 10, "..");
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
	//�Ƿڼ�
	if($row['editdt']) $editdt = $row['editdt'];
	else $editdt = "-";
	//��Ź��
	if($row['samu_receive_date']) $samu_receive_date = $row['samu_receive_date'];
	else $samu_receive_date = "-";
	//������
	if($row['samu_req_date']) $samu_req_date = $row['samu_req_date'];
	else $samu_req_date = "-";
	//������
	if($row['samu_close_date']) $samu_close_date = $row['samu_close_date'];
	else $samu_close_date = "-";
	$samu_close_date_color = "";
	//ó����Ȳ (�繫��Ź)
	$samu_req_yn_array = Array("","�ݷ�","���Ӱ���","Ÿ����","����","����");
	$samu_req_yn_code = $row['samu_req_yn'];
	if($row['samu_req_yn']) $samu_req_yn_text = $samu_req_yn_array[$samu_req_yn_code];
	else $samu_req_yn_text = "-";
	//�Ҹ� �����
	if($row['samu_state_gy'] == "2") $samu_req_yn_text1 = "<span style='color:red'>�Ҹ�</span>(���)";
	else $samu_req_yn_text1 = "";
	if($row['samu_state_sj'] == "2") $samu_req_yn_text2 = "<span style='color:red'>�Ҹ�</span>(����)";
	else $samu_req_yn_text2 = "";
	if($samu_req_yn_text1) $samu_req_yn_text_br = "<br>";
	else $samu_req_yn_text_br = "";
	if($samu_req_yn_text1 || $samu_req_yn_text2) {
		$samu_req_yn_text = $samu_req_yn_text1.$samu_req_yn_text_br.$samu_req_yn_text2;
		$samu_termination = "<span style='color:red;'>(�Ҹ�)</span>";
	} else {
		$samu_req_yn_text = "";
		$samu_termination = "";
	}
	//���� ����� ȸ�� �� ǥ��
	if($samu_req_yn_code == '5') {
		$tr_class = "list_row_now_gr";
		$samu_close_text = "<span style='color:red;'>(����)</span>";
	} else {
		$tr_class = "list_row_now_wh";
		$samu_close_text = "";
	}
	//�ǰ�EDI
	$health_req_yn_array = Array("","�ݷ�","���Ӱ���","Ÿ����","����","����");
	$health_req_yn_code = $row['health_req_yn'];
	if($row['health_req_yn']) $health_req_yn_text = $health_req_yn_array[$health_req_yn_code];
	else $health_req_yn_text = "-";
	//�Ű���
	$report_kind_arry = array("","���","���","����","����","�Ҹ�","����","����","��Ÿ");
	$report_kind = $row['report_kind'];
	$report_kind_text = $report_kind_arry[$report_kind];
	//���豸��
	if($row['isgy']) $isgy = "O";
	else $isgy = "";
	if($row['issj']) $issj = "O";
	else $issj = "";
	if($row['iskm']) $iskm = "O";
	else $iskm = "";
	if($row['isgg']) $isgg = "O";
	else $isgg = "";
	//�������
	$input_type_arry = array("","�����빫","Ű��빫","��Ÿ");
	$input_type = $row['input_type'];
	$input_type_text = $input_type_arry[$input_type];
?>
			<tr bgcolor="#FFFFFF" align=center>
				<td align="center"><?=$no?></td>
				<td align="center"><?=$samu_4insure_regdt?></td>
				<td align="center"><?=$report_date?></td>
				<td align="left"><?=$row['staff_name']?></td>
				<td align="center"><?=$row['staff_ssnb']?></td>
				<td align="center"><?=$input_type_text?></td>
				<td align="center"><?=$report_kind_text?></td>
				<td align="center"><?=$isgy?></td>
				<td align="center"><?=$issj?></td>
				<td align="center"><?=$iskm?></td>
				<td align="center"><?=$isgg?></td>
				<td align="left" width="194"><?=$com_name_full?></td>
				<td align="center"><?=$biz_no?></td>
				<td align="center"><?=$t_insureno?></td>
				<td align="center"><?=$com_tel?></td>
				<td align="center"><?=$row['com_fax']?></td>
				<td align="center"><?=$boss_name?></td>
				<td align="center"><?=$row['uptae']?></td>
				<td align="center"><?=$samu_req_date?></td>
				<td align="center"><?=$samu_close_date?></td>
				<td align="center"><?=$health_req_yn_text?></td>
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
