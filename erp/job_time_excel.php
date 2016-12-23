<?
$sub_menu = "1900100";
include_once("./_common.php");

$sql_common = " from job_time a, job_time_opt b ";



$is_admin = "super";
//권한별 표시
if($member['mb_level'] == 6) {
	$stx_man_cust_name = $member['mb_profile'];
	$sql_search = " where a.id=b.id and a.delete_yn != '1' and a.damdang_code='$stx_man_cust_name' ";
} else {
	$sql_search = " where a.id=b.id and a.delete_yn != '1' ";
	//본사 영업사원 권한
	if($member['mb_level'] == 7) {
		$mb_id = $member['mb_id'];
		//담당매니저 코드 체크
		$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
		$row_manage = sql_fetch($sql_manage);
		$manage_code = $row_manage['code'];
		$sql_search .= " and (a.writer='$manage_code' or a.manager='$manage_code') ";
	}
}
if($member['mb_id'] == "user") {
	$sql_search .= " and a.view_restrict != '1' ";
}

//검색 : 사업장명칭
if($stx_com_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_name like '%$stx_com_name%') ";
	$sql_search .= " ) ";
}
//검색 : 업종
if($stx_upjong) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.upjong like '%$stx_upjong%') ";
	$sql_search .= " ) ";
}
//검색 : 대표자
if($stx_boss_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.boss_name like '%$stx_boss_name%') ";
	$sql_search .= " ) ";
}
//검색 : 전화번호
if($stx_comp_tel) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_tel like '%$stx_comp_tel%') ";
	$sql_search .= " ) ";
}
//검색 : 주소
if($stx_com_juso) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_juso like '%$stx_com_juso%') ";
	$sql_search .= " ) ";
}
//검색 : 처리현황
if($stx_process) {
	$sql_search .= " and ( ";
	if($stx_process == "no") $sql_search .= " (b.check_ok = '') ";
	else $sql_search .= " (b.check_ok = '$stx_process') ";
	$sql_search .= " ) ";
}
//검색 : 참여신청일
if($stx_process) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.joindt = '$stx_joindt') ";
	$sql_search .= " ) ";
}
//검색 : 담당자
if($stx_job_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.writer_name like '%$stx_job_name%') ";
	$sql_search .= " ) ";
}
//검색 : 지사
if($stx_man_cust_name != "all" && $stx_man_cust_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.damdang_code = '$stx_man_cust_name') ";
	$sql_search .= " ) ";
}
if (!$sst) {
    $sst = "a.id";
    $sod = "desc";
}

$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 9999;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sub_title = "고용창출";
$sql = " select *
          $sql_common
          $sql_search
          $sql_order
			";
//echo $sql;
$result = sql_query($sql);
$cell = array("No","등록일자","상호","업종","방문일자","주소","사업자등록번호","전화번호","핸드폰","대표자","가입자","상담메모","참여신청일","승인완료일","처리현황","관리점","담당자");
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
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//사업장 옵션 DB
	$sql_opt = " select * from job_time_opt where id='$row[id]' ";
	$result_opt = sql_query($sql_opt);
	$row_opt=mysql_fetch_array($result_opt);
	//$page
	//$total_page
	//$rows
	//NO 넘버
	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;
	$id = $row[id];
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
	$com_juso = cut_str($com_juso_full, 28, "..");
	if($row['memo']) $memo_full = $row['memo'];
	else $memo_full = "상담메모 없음";
	$memo = cut_str($memo_full, 48, "..");
	if($row['etc']) $etc_full = $row['etc'];
	else $etc_full = "";
	$etc = "<br>".cut_str($etc_full, 48, "..");
	//최근 수정일자 NEW 표시
	//echo date("Y-m-d H:i:s", time() - 96 * 3600);
	if($row['editdt'] >= date("Y-m-d H:i:s", time() - 120 * 3600)) { 
		$etc_new = "<img src='images/icon_new.gif' border='0' style='vertical-align:middle;'>";
	} else {
		$etc_new = "";
	}
	$etc = $etc.$etc_new;
	//담당매니저
	$manage_cust_name = $row_opt['manage_cust_name'];
	//관리점
	$damdang_code = $row['damdang_code'];
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "-";
	//방문일자
	if($row['visitdt']) {
		$visitdt = $row['visitdt']." ".$row['visitdt_time'];
	} else {
		$visitdt = "-";
	}
	//데이터 없을 경우 - 표시 : 전화번호, 휴대폰
	if(!$row['com_tel']) $row['com_tel'] = "-";
	if(!$row['com_hp']) $row['com_hp'] = "-";
	if(!$row['area']) $row['area'] = "-";
	if(!$row['writer_name']) {
		$writer = "-";
	} else {
		$writer = $row['writer_name'];
	}
	if(!$row[writer_tel]) $row[writer_tel] = "-";
	if(!$row[process_date]) $row[process_date] = "-";
	if(!$row[process_date2]) $row[process_date2] = "-";
	//덧글
	$sql_comment = " select count(*) as cnt from job_time_comment where mid='$id' and delete_yn != '1' ";
	$row_comment = sql_fetch($sql_comment);
	$comment_count = $row_comment[cnt];
	if($comment_count != 0) $comment_count = "[".$comment_count."]";
	else $comment_count = "";
	//덧글 최신글 new 표시
	$sql_comment_new = " select * from job_time_comment where mid='$id' and delete_yn!='1' order by regdt desc limit 0,1 ";
	//echo $sql_comment_new;
	$row_comment_new = sql_fetch($sql_comment_new);
	//echo date("Y-m-d H:i:s", time() - 12 * 3600);
	//echo $row_comment_new[regdt];
	if($row_comment_new[regdt] >= date("Y-m-d H:i:s", time() - 48 * 3600)) { 
		$comment_new = "<img src='images/icon_new.gif' border='0' style='vertical-align:middle;'>";
	} else {
		$comment_new = "";
	}
	$comment_cnt = $comment_count.$comment_new;
	//참여신청일
	if($row['joindt']) $joindt = $row['joindt'];
	else $joindt = "-";
	//승인완료일
	if($row['approval']) $ok_loan_policy = $row['approval'];
	else $approval = "-";
	//"No","등록일자","상호","업종","방문일자","주소","사업자등록번호","전화번호","핸드폰","대표자","상담메모","참여신청일","승인완료일","처리현황","관리점","담당자"
	//처리현황
	$check_ok_id = $row['check_ok'];
	//대표자
	$boss_name = $row['boss_name'];
	if(!$boss_name) $boss_name = "-";
	//사업자등록번호
	$biz_no = $row['comp_bznb'];
	if(!$biz_no) $biz_no = "-";
	//보험가입인원
	$insurance_persons = $row['insurance_persons'];
	if(!$insurance_persons) $insurance_persons = "-";
?>
			<tr bgcolor="#FFFFFF" align=center>
				<td align="center"><?=$no?></td>
				<td align="center"><?=$row['regdt']?></td>
				<td align="left" width="194"><?=$com_name_full?></td>
				<td align="center"><?=$row['upjong']?></td>
				<td align="center"><?=$visitdt?></td>
				<td align="left" width="328"><?=$zip?><?=$com_juso_full?></td>
				<td align="center"><?=$biz_no?></td>
				<td align="center"><?=$row['com_tel']?></td>
				<td align="center"><?=$row['com_hp']?></td>
				<td align="center"><?=$boss_name?></td>
				<td align="center"><?=$insurance_persons?></td>
				<td align="left" width="315"><?=$memo_full?></td>
				<td align="center"><?=$joindt?></td>
				<td align="center"><?=$approval?></td>
				<td align="center"><?=$job_time_process_arry[$check_ok_id]?></td>
				<td align="center"><?=$branch?></td>
				<td align="center"><?=$writer?></td>
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
