<?php
$sub_menu = "400200";
include_once("./_common.php");

$sql_common = " from com_list_gy a, com_list_gy_opt b, com_list_gy_opt2 c ";
$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code ";

//검색 : 사업장명칭
if($stx_comp_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_name like '%$stx_comp_name%') ";
	$sql_search .= " ) ";
}
//검색 : 사업자등록번호
if($stx_biz_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.biz_no like '%$stx_biz_no%') ";
	$sql_search .= " ) ";
}
//검색 : 대표자
if($stx_boss_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.boss_name like '%$stx_boss_name%') ";
	$sql_search .= " ) ";
}
//검색 : 담당자
if($stx_manage_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.manage_cust_name = '$stx_manage_name') ";
	$sql_search .= " ) ";
}
//검색 : 사업장관리번호
if($stx_t_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.t_insureno like '%$stx_t_no%') ";
	$sql_search .= " ) ";
}
//검색 : 전화번호
if($stx_comp_tel) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_tel like '%$stx_comp_tel%') ";
	$sql_search .= " ) ";
}
//검색 : 팩스번호
if($stx_comp_fax) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_fax like '%$stx_comp_fax%') ";
	$sql_search .= " ) ";
}
//검색 : 처리현황
if($stx_proxy) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.proxy = '$stx_proxy') ";
	$sql_search .= " ) ";
}
//검색 : 지사
if($stx_man_cust_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.damdang_code = '$stx_man_cust_name') ";
	$sql_search .= " ) ";
}
//검색 : 사업개시일
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
//검색 : 업태
if ($stx_uptae) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.uptae like '%$stx_uptae%') ";
	$sql_search .= " ) ";
}
//검색 : 업종
if ($stx_upjong) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.upjong like '%$stx_upjong%') ";
	$sql_search .= " ) ";
}
//회계사무소 입력 유무
if(!$stx_treasurer_yn) $stx_treasurer_yn = "1";
if($stx_treasurer_yn != "all") {
	$sql_search .= " and ( ";
	if($stx_treasurer_yn == 1) {
		$sql_search .= " (a.treasurer_name != '') ";
	} else if($stx_treasurer_yn == 2) {
		$sql_search .= " (a.treasurer_name = '') ";
	}
	$sql_search .= " ) ";
	$sst = "a.com_code";
	$sod = "desc";
}
//검색 : 회계사무소명
if($stx_treasurer_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.treasurer_name like '%$stx_treasurer_name%') ";
	$sql_search .= " ) ";
}
//회계주소
if ($stx_treasurer_addr) {
	if ($stx_treasurer_addr_first) $treasurer_addr_first = "";
	else $treasurer_addr_first = "%";
	$sql_search .= " and ( ";
	$sql_search .= " (a.treasurer_adr_adr1 like '".$treasurer_addr_first;
	$sql_search .= "$stx_treasurer_addr%') ";
	$sql_search .= " ) ";
}
//검색 : 회계전화번호
if($stx_treasurer_tel) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.treasurer_tel like '%$stx_treasurer_tel%') ";
	$sql_search .= " ) ";
}
//검색 : 회계팩스번호
if($stx_treasurer_fax) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.treasurer_fax like '%$stx_treasurer_fax%') ";
	$sql_search .= " ) ";
}
//사업자등록번호 미등록
if($stx_biz_no_input_not) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.biz_no = '-' or a.biz_no = '') ";
	$sql_search .= " ) ";
}
//사업장관리번호 미등록
if($stx_t_no_input_not) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.t_insureno = '-' or a.t_insureno = '') ";
	$sql_search .= " ) ";
}
//주소검색
if ($stx_addr) {
	if ($stx_addr_first) $addr_first = "";
	else $addr_first = "%";
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_juso like '".$addr_first;
	$sql_search .= "$stx_addr%') ";
	$sql_search .= " ) ";
}

$sst = "a.com_code";
$sod = "desc";
$sql_order = " order by $sst $sod ";
$sql = " select * $sql_common $sql_search $sql_order ";
$result = sql_query($sql);

$cell = array("위탁No","등록일자","사업장명","회계사무소명","회계주소","회계전화","회계팩스","주소","사업자등록번호","사업장관리번호","전화번호","팩스번호","대표자","사업개시일","이메일","업태","업종","고용","산재","관리점","담당자");

$now_date_file = date("Ymd");
$file_name = "회계사무소_".$now_date_file.".xls";
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
//위탁번호 이전 번호 초기화
$samu_receive_no_old = "";
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;
	//거래처 코드
	$id = $row['com_code'];
	//위탁서래처 코드
	if($row['samu_receive_no']) {
		$samu_receive_no = "".$row['samu_receive_no']."";
	} else {
		$samu_receive_no = "-";
	}
	//echo $samu_receive_no." != ".$samu_receive_no_old." / ";
	if($samu_receive_no_old && $samu_receive_no != $samu_receive_no_old-1) $samu_receive_no_color = "color:red";
	else $samu_receive_no_color = "";
	//위탁번호 이전 번호
	$samu_receive_no_old = $row['samu_receive_no'];
	//등록일자
	$regdt = $row['regdt'];
	//등록일자 색상
	if($regdt >= $search_sday && $regdt <= $search_eday) $regdt_color = "color:red";
	else $regdt_color = "";
	//등록일시
	if($row['regdt_time'] != "0000-00-00 00:00:00") $regdt_time = $row['regdt_time'];
	else $regdt_time = "";
	//사업장명
	$com_name_full = $row['com_name'];
	$com_name = cut_str($com_name_full, 28, "..");
	//사업개시일
	if($row['registration_day']) $registration_day = $row['registration_day'];
	else $registration_day = "";
	//법인 구분
	if($row['upche_div'] == "2") {
		$upche_div = "법인";
	} else {
		$upche_div = "개인";
	}
	//우편번호
	$zip = $row['com_postno']." ";
	//주소
	$com_juso_full = $row['com_juso']." ".$row['com_juso2'];
	$com_juso = cut_str($com_juso_full, 18, "..");
	//전화번호
	$com_tel = $row['com_tel'];
	//1544 국번 지역번호 제거
	$com_tel_array = explode("-", $com_tel);
	if($com_tel_array[0] == "000") $com_tel = $com_tel_array[1]."-".$com_tel_array[2];
	//사업자등록번호
	if($row['biz_no']) $biz_no = $row['biz_no'];
	else $biz_no = "-";
	//사업장관리번호
	if($row['t_insureno']) $t_insureno = $row['t_insureno'];
	else $t_insureno = "";
	//대표자
	$boss_name_full = $row['boss_name'];
	if($row['boss_name']) $boss_name = cut_str($boss_name_full, 10, "..");
	else $boss_name = "-";
	//관리점
	$damdang_code = $row['damdang_code'];
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "";
	//담당매니저
	$manage_cust_name = $row['manage_cust_name'];
	//사무위탁
	if($row['samu_req_yn'] == "0" || $row['samu_req_yn'] == "") {
		$samu_req = "";
	} else if($row['samu_req_yn'] == "1") {
		$samu_req = "신청";
	}
	//업태
	$uptae_full = $row['uptae'];
	if($row['uptae']) $uptae = cut_str($uptae_full, 16, "..");
	else $uptae = "";
	if($uptae == "-") $uptae = "";
	//업종
	$upjong_full = $row['upjong'];
	if($row['upjong']) $upjong = cut_str($upjong_full, 16, "..");
	else $upjong = "-";
	//의뢰서
	if($row['editdt']) $editdt = $row['editdt'];
	else $editdt = "-";
	if($editdt >= $search_sday && $editdt <= $search_eday) $editdt_color = "color:red";
	else $editdt_color = "";
	//회계사무소
	if($row['treasurer_name']) $treasurer_name = $row['treasurer_name'];
	else $treasurer_name = "-";
	//우편번호
	if($row['treasurer_adr_zip1']) $treasurer_zip = $row['treasurer_adr_zip1']."-".$row['treasurer_adr_zip2']." ";
	else $treasurer_zip = "";
	//회계사무소 주소
	$treasurer_addr = $row['treasurer_adr_adr1']." ".$row['treasurer_adr_adr2'];
	//상시근로자 고용/산재
	$persons_gy = $row['persons_gy'];
	$persons_sj = $row['persons_sj'];
	if($persons_gy == "0") $persons_gy = "";
	if($persons_sj == "0") $persons_sj = "";

	if($member['mb_level'] > 6 || $row['damdang_code'] == $member['mb_profile']) {
		$com_view = "samu_view.php?id=$id&w=u&$qstr&page=$page";
	} else {
		$com_view = "javascript:alert('해당 거래처 정보를 열람할 권한이 없습니다.');";
	}
?>
			<tr bgcolor="#FFFFFF" align=center>
				<td align="center"><?=$samu_receive_no?></td>
				<td align="center"><?=$regdt?></td>
				<td align="left" width="194"><?=$com_name_full?></td>
				<td align="left"><?=$treasurer_name?></td>
				<td align="left"><?=$treasurer_zip?><?=$treasurer_addr?></td>
				<td align="center"><?=$row['treasurer_tel']?></td>
				<td align="center"><?=$row['treasurer_fax']?></td>
				<td align="left" width="328"><?=$zip?><?=$com_juso_full?></td>
				<td align="center"><?=$biz_no?></td>
				<td align="center"><?=$t_insureno?></td>
				<td align="center"><?=$com_tel?></td>
				<td align="center"><?=$row['com_fax']?></td>
				<td align="center"><?=$boss_name?></td>
				<td align="center"><?=$registration_day?></td>
				<td align="left"><?=$row['com_mail']?></td>
				<td align="center"><?=$uptae?></td>
				<td align="left" width="215"><?=$upjong_full?></td>
				<td align="center"><?=$persons_gy?></td>
				<td align="center"><?=$persons_sj?></td>
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

