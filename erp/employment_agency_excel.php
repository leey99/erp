<?
$sub_menu = "1900900";
include_once("./_common.php");

$sql_common = " from com_list_gy a, com_list_gy_opt b, employment_agency c ";

//echo $member[mb_profile];
if($is_admin != "super") {
	//$stx_man_cust_name = $member[mb_profile];
}
//$is_admin = "super";
//echo $is_admin;
if($member['mb_level'] > 6 || $search_ok == "ok") {
	$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code ";
	//본사 영업사원 권한
	if($member['mb_level'] == 7) {
		$mb_id = $member['mb_id'];
		//담당매니저 코드 체크
		$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
		$row_manage = sql_fetch($sql_manage);
		$manage_code = $row_manage['code'];
		$sql_search .= " and b.manage_cust_numb='$manage_code' ";
	}
} else {
	$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code and ( a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]' ) ";
	//지사 영업사원 권한
	if($member['mb_level'] == 5) {
		$mb_id = $member['mb_id'];
		//담당매니저 코드 체크
		$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
		$row_manage = sql_fetch($sql_manage);
		$manage_code = $row_manage['code'];
		$sql_search .= " and b.manage_cust_numb='$manage_code' ";
	}
}
//기본 검색 : 삭제 여부
$sql_search .= " and c.delete_yn = '' ";
//검색 : 사업장명칭
if($stx_comp_name) {
	$sql_search .= " and a.com_name like '%$stx_comp_name%' ";
}
//검색 : 사업자등록번호
if($stx_biz_no) {
	$sql_search .= " and a.biz_no like '%$stx_biz_no%' ";
}
//검색 : 대표자
if($stx_boss_name) {
	$sql_search .= " and a.boss_name like '%$stx_boss_name%' ";
}
//검색 : 담당자
if($stx_manage_name) {
	$sql_search .= " and b.manage_cust_name = '$stx_manage_name' ";
}
//검색 : 사업장관리번호
if($stx_t_no) {
	$sql_search .= " and a.t_insureno like '%$stx_t_no%' ";
}
//검색 : 전화번호
if($stx_comp_tel) {
	$sql_search .= " and a.com_tel like '%$stx_comp_tel%' ";
}
//검색 : 처리현황
if($stx_proxy) {
	$sql_search .= " and b.proxy = '$stx_proxy' ";
}
//검색 : 지사
if($stx_man_cust_name) {
	$sql_search .= " and a.damdang_code = '$stx_man_cust_name' ";
}
//검색기간 = 접수일자
if($stx_search_day_chk) {
	$sql_search .= " and (c.report_date >= '$search_sday' and c.report_date <= '$search_eday') ";
}
//검색 : 업태
if ($stx_uptae) {
	$sql_search .= " and a.uptae like '%$stx_uptae%' ";
}
//검색 : 업종
if ($stx_com_job) {
	$sql_search .= " and c.com_job like '%$stx_com_job%' ";
}
//사업자등록번호 미등록
if($stx_biz_no_input_not) {
	$sql_search .= " and ( a.biz_no = '-' or a.biz_no = '' ) ";
}
//사업장관리번호 미등록
if($stx_t_no_input_not) {
	$sql_search .= " and ( a.t_insureno = '-' or a.t_insureno = '' ) ";
}
//사무위탁수임 미등록
if($samu_req_yn_input_not) {
	$sql_search .= " and b.samu_req_yn = '' ";
}
//주소검색
if ($stx_addr) {
	if ($stx_addr_first) $addr_first = "";
	else $addr_first = "%";
	$sql_search .= " and a.com_juso like '".$addr_first;
	$sql_search .= "$stx_addr%' ";
}
//근로자명
if($stx_staff_name) {
	$sql_search .= " and c.staff_name like '%$stx_staff_name%' ";
}
//정렬
$sst = "c.report_date";
$sod = "desc";
$sst2 = "c.idx";
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
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sub_title = "인력관리";
$sql = " select *
          $sql_common
          $sql_search
          $sql_order
			";
//echo $sql;
$result = sql_query($sql);
$cell = array("No","접수일자","근로자명","주민등록번호","연락처","학력","희망직종","자격증","경력","사업장명","전화번호","업종","취업","임금","소개비","근로기간","숙식","관리점","담당자");
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
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;
	//거래처 코드
	$id = $row['com_code'];
	//안력관리 코드
	$idx = $row['idx'];
	//접수일자
	$report_date = $row['report_date'];
	//사업장명
	$com_name_full = $row['com_name'];
	$com_name = cut_str($com_name_full, 28, "..");
	//전화번호
	$com_tel = $row['com_tel'];
	//1544 국번 지역번호 제거
	$com_tel_array = explode("-", $com_tel);
	if($com_tel_array[0] == "000") $com_tel = $com_tel_array[1]."-".$com_tel_array[2];
	//관리점
	$damdang_code = $row['damdang_code'];
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "-";
	//담당매니저
	$manage_cust_name = $row['manage_cust_name'];
	//취업
	if($row['work_emp']) $work_emp = "○";
	else $work_emp = "-";
	//숙식
	if($row['board_lodging']) $board_lodging = "○";
	else $board_lodging = "-";
	//근로기간
	if($row['work_period']) $work_period = $row['work_period'];
	else $work_period = "";
	if($row['work_period2']) $work_period2 = $row['work_period2'];
	else $work_period2 = "";
?>
			<tr bgcolor="#FFFFFF" align=center>
				<td align="center"><?=$no?></td>
				<td align="center"><?=$report_date?></td>
				<td align="left"><?=$row['staff_name']?></td>
				<td align="center"><?=$row['staff_ssnb']?></td>
				<td align="center"><?=$row['staff_tel']?></td>
				<td align="center"><?=$row['scholarship']?></td>
				<td align="center"><?=$row['hope_job']?></td>
				<td align="center"><?=$row['certificate']?></td>
				<td align="center"><?=$row['career']?></td>
				<td align="left" width="194"><?=$com_name_full?></td>
				<td align="center"><?=$com_tel?></td>
				<td align="center"><?=$row['com_job']?></td>
				<td align="center"><?=$work_emp?></td>
				<td align="center"><?=$row['work_pay']?></td>
				<td align="center"><?=$row['commission']?></td>
				<td align="center"><?=$work_period?>~<?=$work_period2?></td>
				<td align="center"><?=$board_lodging?></td>
				<td align="center"><?=$branch?></td>
				<td align="center"><?=$manage_cust_name?></td>
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
