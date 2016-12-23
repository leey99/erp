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
	//본사 영업사원 권한
	if($member['mb_level'] == 7) {
		$mb_id = $member['mb_id'];
		//담당매니저 코드 체크
		$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
		$row_manage = sql_fetch($sql_manage);
		$manage_code = $row_manage['code'];
		$sql_search .= " and c.manage_cust_numb='$manage_code' ";
	}
}

// 검색 : 사업장명칭
if ($stx_com_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_name like '%$stx_com_name%') ";
	$sql_search .= " ) ";
}
// 검색 : 업태
if ($stx_uptae) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.uptae like '%$stx_uptae%') ";
	$sql_search .= " ) ";
}
// 검색 : 대표자
if ($stx_boss_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.boss_name like '%$stx_boss_name%') ";
	$sql_search .= " ) ";
}
// 검색 : 전화번호
if ($stx_comp_tel) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_tel like '%$stx_comp_tel%') ";
	$sql_search .= " ) ";
}
// 검색 : 주소
if ($stx_com_juso) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_juso like '%$stx_com_juso%') ";
	$sql_search .= " ) ";
}
// 검색 : 처리현황
if ($stx_process) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.job_proxy = '$stx_process') ";
	$sql_search .= " ) ";
}
// 검색 : 처리일자
if ($stx_process_date) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.job_proxy_date = '$stx_process_date') ";
	$sql_search .= " ) ";
}
//검색 : 지사
if($stx_man_cust_name) {
	$sql_search .= " and ( ";
	//열람 처리된 거래처 포함
	if($stx_man_cust_name != 1) {
		$sql_search .= " (a.damdang_code = '$stx_man_cust_name' or a.damdang_code2 = '$stx_man_cust_name') ";
	} else {
		$sql_search .= " (a.damdang_code = '$stx_man_cust_name' and a.damdang_code2 = '') ";
	}
	$sql_search .= " ) ";
}
//검색 : 공단 : 한국산업인력공단 관할지사
if($stx_hrd_korea) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.hrd_korea = '$stx_hrd_korea') ";
	$sql_search .= " ) ";
}
//검색 : 교육구분
if($stx_train_kind) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.train_kind = '$stx_train_kind') ";
	$sql_search .= " ) ";
}
//검색 : 담당자
if($stx_job_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.job_cust_name like '%$stx_job_name%') ";
	$sql_search .= " ) ";
}
//정렬
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

//관할지사
$hrd_korea_name = array();
$sql_hrd_korea = " select * from hrd_korea order by idx asc ";
$result_hrd_korea = sql_query($sql_hrd_korea);
for ($i=0; $row_hrd_korea=mysql_fetch_assoc($result_hrd_korea); $i++) {
	$k = $row_hrd_korea['idx'];
	$hrd_korea_name[$k] = $row_hrd_korea['branch_name'];
}

$cell = array("No","지사","사업장명","사업장관리번호","구분","주소","등록일자","공단","상담메모","체크List","첨부파일","담당자","교육실시일","교육종료일","수료보고일","지원금","입금일","처리현황","처리일자");

$now_date_file = date("Ymd");
$file_name = "사업주훈련_".$now_date_file.".xls";
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
// 리스트 출력
for ($i=0; $row = mysql_fetch_assoc($result); $i++) {
	//NO 넘버
	$no = $total_count - $i;
	$id = $row[idx];
	//최초교육일
	if($row['permission_date']) $permission_date = $row['permission_date'];
	else $permission_date = "-";
	$com_name_full = $row[com_name];
	$com_name = cut_str($com_name_full, 28, "..");
	//업종
	$upjong = $row['upjong'];
	if($row[upche_div] == "2") {
		$upche_div = "법인";
	} else {
		$upche_div = "개인";
	}
	//주소
	$com_juso_full = $row['com_juso']." ".$row['com_juso2'];
	$com_juso = cut_str($com_juso_full, 38, "..");
	//등록일자
	if($row['w_date']) $w_date = $row['w_date'];
	else $w_date = "";
	//관할지사
	$hrd_korea_code = $row['hrd_korea'];
	if($hrd_korea_code) $hrd_korea_branch_name = $hrd_korea_name[$hrd_korea_code];
	else $hrd_korea_branch_name = "";
	//구분
	//$sql_jop_opt = " select * from job_education_opt where mid='$id' and delete_yn != '1' ";
	//최종 교육일정 표시 161205
	$sql_jop_opt = " select * from job_education_opt where mid='$id' and delete_yn != '1' order by id desc ";
	$row_jop_opt = sql_fetch($sql_jop_opt);
	$train_kind = $row_jop_opt['train_kind'];
	if($train_kind == 1) $train_kind_text = "집체";
	else if($train_kind == 2) $train_kind_text = "현장";
	else if($train_kind == 3) $train_kind_text = "혼합";
	else $train_kind_text = "";
	if($train_kind_text) $train_kind_text_display = "<span style='color:blue'>(".$train_kind_text.")</span>";
	else $train_kind_text_display = "";
	//메모
	if($row['job_memo']) $memo_full = $row['job_memo'];
	else $memo_full = "";
	$memo = cut_str($memo_full, 48, "..");
	//관리점
	$damdang_code = $row['damdang_code'];
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "";
	$damdang_code2 = $row['damdang_code2'];
	if($damdang_code2) $branch = $man_cust_name_arry[$damdang_code2];
	if(!$row[writer_tel]) $row[writer_tel] = "-";
	if(!$row[process_date]) $row[process_date] = "-";
	if(!$row[process_date2]) $row[process_date2] = "-";
	//덧글
	$sql_comment = " select count(*) as cnt from job_education_comment where mid='$id' and delete_yn != '1' ";
	$row_comment = sql_fetch($sql_comment);
	$comment_count = $row_comment[cnt];
	if($comment_count != 0) $comment_count = "[".$comment_count."]";
	else $comment_count = "";
	//덧글 최신글 new 표시
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
	//체크리스트
	$job_file_check = explode(',',$row['job_file_check']);
	if($job_file_check[0] == 1) $check_list = "등록";
	else $check_list = "";
	//첨부파일
	$file_list = "";
	if($job_file_check[1] == 1) $file_list .= "평면도.";
	else $file_list .= "";
	if($job_file_check[2] == 1) $file_list .= "사진.";
	else $file_list .= "";
	if($job_file_check[3] == 1) $file_list .= "교육시간표.";
	else $file_list .= "";
	if($job_file_check[4] == 1) $file_list .= "교육자료.";
	else $file_list .= "";
	if($job_file_check[5] == 1) $file_list .= "HRD신청서.";
	else $file_list .= "";
	if($job_file_check[6] == 1) $file_list .= "교육자명단.";
	else $file_list .= "";
	if($job_file_check[7] == 1) $file_list .= "재직증명서.";
	else $file_list .= "";
	//담당자
	if($row['job_cust_name']) $job_cust_name = $row['job_cust_name'];
	else $job_cust_name = "";
	//관리책임자 이름
	if($row['chief_name']) $chief_name = $row['chief_name'];
	else $chief_name = "-";
	//관리책임자 직위
	if($row['chief_position']) $chief_position = $row['chief_position'];
	else $chief_position = "";
	//관리책임자
	$chief = $chief_name." ".$chief_position;
	//강사
	if($row['teacher_name']) $teacher = $row['teacher_name'];
	else $teacher = "-";
	//강사2
	if($row['teacher_name2']) $teacher .= ", ".$row['teacher_name2'];
	//교육일정
	$education_conduct_report = $row_jop_opt['education_conduct_report'];
	$education_close_date = $row_jop_opt['education_close_date'];
	if(!$education_conduct_report) $education_conduct_report = "";
	if(!$education_close_date) $education_close_date = "";
	//수료보고일
	$job_complete_date = $row_jop_opt['job_complete_date'];
	//지원금
	$job_fee = $row_jop_opt['job_fee'];
	if($job_fee) $job_fee = number_format($job_fee);
	else $job_fee = "";
	//입금일
	$job_fee_date = $row_jop_opt['job_fee_date'];
	//처리현황
	$job_proxy = $row['job_proxy'];
	if($job_proxy) $job_proxy_text = $job_proxy_array[$job_proxy];
	else $job_proxy_text = "";
	//처리일자
	if($row['job_proxy_date']) $job_proxy_date = $row['job_proxy_date'];
	else $job_proxy_date = "";
	//진행취소, 보류 사업장 회색 블럭 표시
	if($job_proxy == '10') {
		$tr_class = "list_row_now_gr";
		$job_proxy_text_cancel = "<span style='color:red;'>(진행취소)</span>";
	} else if($job_proxy == '12') {
		$tr_class = "list_row_now_gr";
		$job_proxy_text_cancel = "<span style='color:red;'>(보류)</span>";
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
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
?>
</table>
<?
exit;
?>

