<?
$sub_menu = "1900600";
include_once("./_common.php");
//������ �˻� ��
if( (!$stx_comp_name && !$stx_biz_no) || $stx_process ) {
	$sql_common = " from com_list_gy a, com_list_gy_opt b, com_employment c, com_list_gy_opt2 d ";
} else {
	$sql_common = " from com_list_gy a, com_list_gy_opt b, com_list_gy_opt2 d ";
}
if($member['mb_level'] > 6 || $search_ok == "ok" || $member['mb_profile'] == '16') {
	if( (!$stx_comp_name && !$stx_biz_no) || $stx_process ) {
		$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code and a.com_code = d.com_code ";
		//�޸� ���� ����
		$sql_search .= " and c.delete_yn != '1' ";
	} else {
		$sql_search = " where a.com_code = b.com_code and a.com_code = d.com_code ";
	}
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
	if( (!$stx_comp_name && !$stx_biz_no) || $stx_process ) {
		$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code and a.com_code = d.com_code and ( a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]' ) ";
		//�޸� ���� ����
		$sql_search .= " and c.delete_yn != '1' ";
	} else {
		$sql_search = " where a.com_code = b.com_code and a.com_code = d.com_code and ( a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]' ) ";
	}
}
//������Ī
if ($stx_comp_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_name like '%$stx_comp_name%') ";
	$sql_search .= " ) ";
}
//����ڵ�Ϲ�ȣ
if ($stx_biz_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.biz_no like '%$stx_biz_no%') ";
	$sql_search .= " ) ";
}
//��ǥ��
if ($stx_boss_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.boss_name like '%$stx_boss_name%') ";
	$sql_search .= " ) ";
}
//��ȭ��ȣ
if ($stx_comp_tel) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_tel like '%$stx_comp_tel%') ";
	$sql_search .= " ) ";
}
//�ּҰ˻�
if ($stx_addr) {
	if ($stx_addr_first) $addr_first = "";
	else $addr_first = "%";
	$sql_search .= " and a.com_juso like '".$addr_first;
	$sql_search .= "$stx_addr%' ";
}
//����
if ($stx_man_cust_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.damdang_code = '$stx_man_cust_name') ";
	$sql_search .= " ) ";
}
//����
if($stx_man_cust_name2) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.damdang_code2 = '$stx_man_cust_name2') ";
	$sql_search .= " ) ";
}
//�˻��Ⱓ
if($stx_search_day_chk) {
	//$sst = "a.report_date";
	//$sod = "desc";
	$search_sday_date = explode(".", $search_sday); 
	$year = $search_sday_date[0];
	$month = $search_sday_date[1]; 
	$day = $search_sday_date[2]; 
	$search_sday_time = $year."-".$month."-".$day." 00:00:00";
	$search_eday_date = explode(".", $search_eday); 
	$year = $search_eday_date[0];
	$month = $search_eday_date[1]; 
	$day = $search_eday_date[2]; 
	$search_eday_time = $year."-".$month."-".$day." 23:59:59";
	$sql_search .= " and (c.employment_regt >= '$search_sday_time' and c.employment_regt <= '$search_eday_time') ";
}
//����
if ($stx_uptae) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.uptae like '%$stx_uptae%') ";
	$sql_search .= " ) ";
}
//����
if ($stx_upjong) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.upjong like '%$stx_upjong%') ";
	$sql_search .= " ) ";
}
//��� ��� ����
if($stx_employment_kind1) {
	$sql_search .= " and ( ";
	$sql_search .= " (c.branch_file_1 != '') ";
	$sql_search .= " ) ";
}
if($stx_employment_kind2) {
	$sql_search .= " and ( ";
	$sql_search .= " (c.main_file_1 != '') ";
	$sql_search .= " ) ";
}
if($stx_employment_kind3) {
	$sql_search .= " and ( ";
	$sql_search .= " (c.employment_file_1 != '') ";
	$sql_search .= " ) ";
}
//����
if ($stx_comp_gubun1) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.samu_req_yn = '4') ";
	$sql_search .= " ) ";
}
if ($stx_comp_gubun2) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.agent_elect_public_yn = '3') ";
	$sql_search .= " ) ";
}
if ($stx_comp_gubun3) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.agent_elect_center_yn = '3') ";
	$sql_search .= " ) ";
}
//ó����Ȳ
if($stx_process) {
	$sql_search .= " and ( ";
	if($stx_process == "no") $sql_search .= " (c.employment_process = '') ";
	else $sql_search .= " (c.employment_process = '$stx_process') ";
	$sql_search .= " ) ";
}
//����
if (!$sst) {
	if(!$stx_comp_name && !$stx_biz_no) {
		$sst = "c.idx";
	} else {
		$sst = "a.com_code";
	}
	$sod = "desc";
}
//Ư�̻���
if($stx_memo) {
	$sql_search .= " and c.employment_memo like '%$stx_memo%' ";
}
//Ư�̻��� ������
if($stx_memo_yn) {
	$sql_search .= " and c.employment_memo != '' ";
}
//Ư�̻��� ������
if($stx_support_document_yn) {
	$sql_search .= " and (d.support_document != '' or d.support_document2 != '' or d.support_document3 != '' or d.support_document4 != '' or d.support_document5 != '') ";
}
//�׷����
if(!$stx_comp_name && !$stx_biz_no) {
	$group_by = " group by c.com_code ";
} else {
	$group_by = "";
}
$sql_order = " order by $sst $sod ";
//ī��Ʈ
if(!$stx_comp_name && !$stx_biz_no) {
	$sql = " select count(distinct c.com_code) as cnt $sql_common $sql_search $sql_order ";
} else {
	$sql = " select count(*) as cnt $sql_common $sql_search $sql_order ";
}
//echo $sql;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 9999;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$sub_title = "�ű԰��Ȯ��";

$sql = " select *
					$sql_common
					$sql_search
					$group_by
					$sql_order
					limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$cell = array("No","����Ͻ�","������","�ּ�","����ڵ�Ϲ�ȣ","��ȭ��ȣ","�ڵ���","��ǥ��","ó����Ȳ","�Ƿ�","����","����","Ư�̻���","��û����","��û����2","��û����3","��û����4","��û����5","����","����","������","����","�����");
$colspan = count($cell) + 1;
$now_date_file = date("Ymd");
$file_name = $sub_title."_".$now_date_file.".xls";
header("Pragma:");
header("Cache-Control:");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
header("Content-Description: PHP5 Generated Data");
?>
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
	$id = $row[id];
	//�������
	$regdt_time = $row['employment_regt'];
	$regdt_time_array = explode(" ",$row['employment_regt']);
	$regdt = $regdt_time_array[0];
	//������
	$com_name_full = $row['com_name'];
	$com_name = cut_str($com_name_full, 28, "..");
	//����
	$uptae = $row['uptae'];
	//����
	$upjong = $row['upjong'];
	//�ּ�
	$com_juso_full = $row['com_juso']." ".$row['com_juso2'];
	//���Ŵ���
	$manage_cust_name = $row['manage_cust_name'];
	//������
	$damdang_code = $row['damdang_code'];
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "-";
	//����
	$damdang_code2 = $row['damdang_code2'];
	if($damdang_code2) $branch2 = $man_cust_name_arry[$damdang_code2];
	else $branch2 = "-";
	//������ ���� ��� - ǥ�� : ��ȭ��ȣ, �޴���
	if(!$row['com_tel']) $row['com_tel'] = "-";
	if(!$row['boss_hp']) $row['boss_hp'] = "-";
	//��ǥ��
	$boss_name = $row['boss_name'];
	if(!$boss_name) $boss_name = "-";
	//����ڵ�Ϲ�ȣ
	if($row['biz_no']) $biz_no = $row['biz_no'];
	else $biz_no = "-";
	//���(����, ����, �뱸����)
	if($row['branch_file_1']) $branch_file = "��";
	else $branch_file = "";
	if($row['main_file_1']) $main_file = "��";
	else $main_file = "";
	if($row['employment_file_1']) $employment_file = "��";
	else $employment_file = "";
	//�޸�
	if( ($is_admin == "super" && $member['mb_level'] != 6) || $member['mb_profile'] == '16' ) {
		$memo = $row['employment_memo'];
	} else {
		$memo = "";
	}
	//��û�����ȳ�
	$support_document = $row['support_document'];
	$support_document2 = $row['support_document2'];
	$support_document3 = $row['support_document3'];
	$support_document4 = $row['support_document4'];
	$support_document5 = $row['support_document5'];
	//ó����Ȳ
	$check_ok_id = $row['employment_process'];
?>
			<tr bgcolor="#FFFFFF" align=center>
				<td align="center"><?=$no?></td>
				<td align="center"><?=$regdt?></td>
				<td align="left" width="194"><?=$com_name_full?></td>
				<td align="left" width="328"><?=$zip?><?=$com_juso_full?></td>
				<td align="center"><?=$biz_no?></td>
				<td align="center"><?=$row['com_tel']?></td>
				<td align="center"><?=$row['boss_hp']?></td>
				<td align="center"><?=$boss_name?></td>
				<td align="center"><?=$employment_process_arry[$check_ok_id]?></td>
				<td align="center"><?=$branch_file?></td>
				<td align="center"><?=$main_file?></td>
				<td align="center"><?=$employment_file?></td>
				<td align="left" width="315"><?=$memo?></td>
				<td align="left" width="315"><?=$support_document?></td>
				<td align="left"><?=$support_document2?></td>
				<td align="left"><?=$support_document3?></td>
				<td align="left"><?=$support_document4?></td>
				<td align="left"><?=$support_document5?></td>
				<td align="center"><?=$uptae?></td>
				<td align="left"><?=$upjong?></td>
				<td align="center"><?=$branch?></td>
				<td align="center"><?=$branch2?></td>
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
