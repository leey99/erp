<?php
$sub_menu = "1700100";
include_once("./_common.php");

$sql_common = " from com_list_gy a, job_education b, com_list_gy_opt c ";

$is_admin = "super";
//echo $is_admin;
if($member['mb_level'] == 6) {
	$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code and b.delete_yn != '1' and (damdang_code='$member[mb_profile]' or damdang_code2='$member[mb_profile]') ";
} else {
	$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code and b.delete_yn != '1' ";
	//���� ������� ����
	if($member['mb_level'] == 7) {
		$mb_id = $member['mb_id'];
		//���Ŵ��� �ڵ� üũ
		$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
		$row_manage = sql_fetch($sql_manage);
		$manage_code = $row_manage['code'];
		$sql_search .= " and c.manage_cust_numb='$manage_code' ";
	}
}

// �˻� : ������Ī
if ($stx_com_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_name like '%$stx_com_name%') ";
	$sql_search .= " ) ";
}
// �˻� : ����
if ($stx_uptae) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.uptae like '%$stx_uptae%') ";
	$sql_search .= " ) ";
}
// �˻� : ��ǥ��
if ($stx_boss_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.boss_name like '%$stx_boss_name%') ";
	$sql_search .= " ) ";
}
// �˻� : ��ȭ��ȣ
if ($stx_comp_tel) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_tel like '%$stx_comp_tel%') ";
	$sql_search .= " ) ";
}
// �˻� : �ּ�
if ($stx_com_juso) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_juso like '%$stx_com_juso%') ";
	$sql_search .= " ) ";
}
// �˻� : ó����Ȳ
if ($stx_process) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.job_proxy = '$stx_process') ";
	$sql_search .= " ) ";
}
// �˻� : ó������
if ($stx_process_date) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.job_proxy_date = '$stx_process_date') ";
	$sql_search .= " ) ";
}
//�˻� : ����
if($stx_man_cust_name) {
	$sql_search .= " and ( ";
	//���� ó���� �ŷ�ó ����
	if($stx_man_cust_name != 1) {
		$sql_search .= " (a.damdang_code = '$stx_man_cust_name' or a.damdang_code2 = '$stx_man_cust_name') ";
	} else {
		$sql_search .= " (a.damdang_code = '$stx_man_cust_name' and a.damdang_code2 = '') ";
	}
	$sql_search .= " ) ";
}
//�˻� : ���� : �ѱ�����η°��� ��������
if($stx_hrd_korea) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.hrd_korea = '$stx_hrd_korea') ";
	$sql_search .= " ) ";
}
//�˻� : ��������
if($stx_train_kind) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.train_kind = '$stx_train_kind') ";
	$sql_search .= " ) ";
}
//�˻� : �����
if($stx_job_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.job_cust_name like '%$stx_job_name%') ";
	$sql_search .= " ) ";
}
//����
$sst = "b.idx";
$sod = "desc";
$sql_order = " order by $sst $sod ";
$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
$row = sql_fetch($sql);
$total_count = $row[cnt];
$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
$result = sql_query($sql);

//��������
$hrd_korea_name = array();
$sql_hrd_korea = " select * from hrd_korea order by idx asc ";
$result_hrd_korea = sql_query($sql_hrd_korea);
for ($i=0; $row_hrd_korea=mysql_fetch_assoc($result_hrd_korea); $i++) {
	$k = $row_hrd_korea['idx'];
	$hrd_korea_name[$k] = $row_hrd_korea['branch_name'];
}

$cell = array("No","����","������","����������ȣ","����","�ּ�","�������","����","���޸�","üũList","÷������","�����","�����ǽ���","����������","���Ẹ����","������","�Ա���","ó����Ȳ","ó������");

$now_date_file = date("Ymd");
$file_name = "������Ʒ�_".$now_date_file.".xls";
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
// ����Ʈ ���
for ($i=0; $row = mysql_fetch_assoc($result); $i++) {
	//NO �ѹ�
	$no = $total_count - $i;
	$id = $row[idx];
	//���ʱ�����
	if($row['permission_date']) $permission_date = $row['permission_date'];
	else $permission_date = "-";
	$com_name_full = $row[com_name];
	$com_name = cut_str($com_name_full, 28, "..");
	//����
	$upjong = $row['upjong'];
	if($row[upche_div] == "2") {
		$upche_div = "����";
	} else {
		$upche_div = "����";
	}
	//�ּ�
	$com_juso_full = $row['com_juso']." ".$row['com_juso2'];
	$com_juso = cut_str($com_juso_full, 38, "..");
	//�������
	if($row['w_date']) $w_date = $row['w_date'];
	else $w_date = "";
	//��������
	$hrd_korea_code = $row['hrd_korea'];
	if($hrd_korea_code) $hrd_korea_branch_name = $hrd_korea_name[$hrd_korea_code];
	else $hrd_korea_branch_name = "";
	//����
	//$sql_jop_opt = " select * from job_education_opt where mid='$id' and delete_yn != '1' ";
	//���� �������� ǥ�� 161205
	$sql_jop_opt = " select * from job_education_opt where mid='$id' and delete_yn != '1' order by id desc ";
	$row_jop_opt = sql_fetch($sql_jop_opt);
	$train_kind = $row_jop_opt['train_kind'];
	if($train_kind == 1) $train_kind_text = "��ü";
	else if($train_kind == 2) $train_kind_text = "����";
	else if($train_kind == 3) $train_kind_text = "ȥ��";
	else $train_kind_text = "";
	if($train_kind_text) $train_kind_text_display = "<span style='color:blue'>(".$train_kind_text.")</span>";
	else $train_kind_text_display = "";
	//�޸�
	if($row['job_memo']) $memo_full = $row['job_memo'];
	else $memo_full = "";
	$memo = cut_str($memo_full, 48, "..");
	//������
	$damdang_code = $row['damdang_code'];
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "";
	$damdang_code2 = $row['damdang_code2'];
	if($damdang_code2) $branch = $man_cust_name_arry[$damdang_code2];
	if(!$row[writer_tel]) $row[writer_tel] = "-";
	if(!$row[process_date]) $row[process_date] = "-";
	if(!$row[process_date2]) $row[process_date2] = "-";
	//����
	$sql_comment = " select count(*) as cnt from job_education_comment where mid='$id' and delete_yn != '1' ";
	$row_comment = sql_fetch($sql_comment);
	$comment_count = $row_comment[cnt];
	if($comment_count != 0) $comment_count = "[".$comment_count."]";
	else $comment_count = "";
	//���� �ֽű� new ǥ��
	$sql_comment_new = " select * from job_education_comment where mid='$id' and delete_yn!='1' order by regdt desc limit 0,1 ";
	//echo $sql_comment_new;
	$row_comment_new = sql_fetch($sql_comment_new);
	//echo date("Y-m-d H:i:s", time() - 12 * 3600);
	//echo $row_comment_new[regdt];
	if($row_comment_new[regdt] >= date("Y-m-d H:i:s", time() - 12 * 3600)) { 
		$comment_new = "<img src='images/icon_new.gif' border='0' style='vertical-align:middle;'>";
	} else {
		$comment_new = "";
	}
	$comment_cnt = $comment_count.$comment_new;
	//üũ����Ʈ
	$job_file_check = explode(',',$row['job_file_check']);
	if($job_file_check[0] == 1) $check_list = "���";
	else $check_list = "";
	//÷������
	$file_list = "";
	if($job_file_check[1] == 1) $file_list .= "��鵵.";
	else $file_list .= "";
	if($job_file_check[2] == 1) $file_list .= "����.";
	else $file_list .= "";
	if($job_file_check[3] == 1) $file_list .= "�����ð�ǥ.";
	else $file_list .= "";
	if($job_file_check[4] == 1) $file_list .= "�����ڷ�.";
	else $file_list .= "";
	if($job_file_check[5] == 1) $file_list .= "HRD��û��.";
	else $file_list .= "";
	if($job_file_check[6] == 1) $file_list .= "�����ڸ��.";
	else $file_list .= "";
	if($job_file_check[7] == 1) $file_list .= "��������.";
	else $file_list .= "";
	//�����
	if($row['job_cust_name']) $job_cust_name = $row['job_cust_name'];
	else $job_cust_name = "";
	//����å���� �̸�
	if($row['chief_name']) $chief_name = $row['chief_name'];
	else $chief_name = "-";
	//����å���� ����
	if($row['chief_position']) $chief_position = $row['chief_position'];
	else $chief_position = "";
	//����å����
	$chief = $chief_name." ".$chief_position;
	//����
	if($row['teacher_name']) $teacher = $row['teacher_name'];
	else $teacher = "-";
	//����2
	if($row['teacher_name2']) $teacher .= ", ".$row['teacher_name2'];
	//��������
	$education_conduct_report = $row_jop_opt['education_conduct_report'];
	$education_close_date = $row_jop_opt['education_close_date'];
	if(!$education_conduct_report) $education_conduct_report = "";
	if(!$education_close_date) $education_close_date = "";
	//���Ẹ����
	$job_complete_date = $row_jop_opt['job_complete_date'];
	//������
	$job_fee = $row_jop_opt['job_fee'];
	if($job_fee) $job_fee = number_format($job_fee);
	else $job_fee = "";
	//�Ա���
	$job_fee_date = $row_jop_opt['job_fee_date'];
	//ó����Ȳ
	$job_proxy = $row['job_proxy'];
	if($job_proxy) $job_proxy_text = $job_proxy_array[$job_proxy];
	else $job_proxy_text = "";
	//ó������
	if($row['job_proxy_date']) $job_proxy_date = $row['job_proxy_date'];
	else $job_proxy_date = "";
	//�������, ���� ����� ȸ�� �� ǥ��
	if($job_proxy == '10') {
		$tr_class = "list_row_now_gr";
		$job_proxy_text_cancel = "<span style='color:red;'>(�������)</span>";
	} else if($job_proxy == '12') {
		$tr_class = "list_row_now_gr";
		$job_proxy_text_cancel = "<span style='color:red;'>(����)</span>";
	} else {
		$tr_class = "list_row_now_wh";
		$job_proxy_text_cancel = "";
	}
?>
			<tr bgcolor="#FFFFFF" align=center>
				<td align="center"><?=$no?></td>
				<td align="center"><?=$branch?></td>
				<td align="left" width="194"><?=$com_name_full?></td>
				<td align="center"><?=$row['t_insureno']?></td>
				<td align="center"><?=$train_kind_text?></td>
				<td align="left" width="240"><?=$com_juso_full?></td>
				<td align="center"><?=$w_date?></td>
				<td align="center"><?=$hrd_korea_branch_name?></td>
				<td align="left" width="280"><?=$memo?></td>
				<td align="center"><?=$check_list?></td>
				<td align="left" width="230"><?=$file_list?></td>
				<td align="center"><?=$job_cust_name?></td>
				<td align="center"><?=$education_conduct_report?></td>
				<td align="center"><?=$education_close_date?></td>
				<td align="center"><?=$job_complete_date?></td>
				<td align="center"><?=$job_fee?></td>
				<td align="center"><?=$job_fee_date?></td>
				<td align="center"><?=$job_proxy_text?></td>
				<td align="center"><?=$job_proxy_date?></td>
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

