<?
$sub_menu = "200100";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$sql_common = " from $g4[pibohum_base] a, pibohum_base_opt b ";

//사업장정보 옵션 DB
$sql_com_opt = " select * from com_list_gy_opt where com_code='$com_code' ";
$result_com_opt = sql_query($sql_com_opt);
$row_com_opt=mysql_fetch_array($result_com_opt);
//사업장 타입
if($row_com_opt[comp_print_type]) {
	$comp_print_type = $row_com_opt[comp_print_type];
} else {
	$comp_print_type = "default";
}

//echo $is_admin;
if($is_admin == "super") {
	$sql_search = " where 1=1 ";
} else {
	$sql_search = " where a.com_code='$com_code' ";
}
//옵션DB join
$sql_search .= " and ( ";
$sql_search .= " (a.com_code = b.com_code and a.sabun = b.sabun) ";
$sql_search .= " ) ";
//화성시장애인부모회 : 활동보조인 추출
if($comp_print_type == "H") {
	$sql_search .= " and ( b.position = '13' ) ";
}
// 검색 : 부서
if ($stx_dept) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.dept = '$stx_dept') ";
	$sql_search .= " ) ";
}
//echo $stx_name;
// 검색 : 성명
if ($stx_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.name like '%$stx_name%') ";
	$sql_search .= " ) ";
}
//검색 : 사번
if ($stx_sabun) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.sabun = '$stx_sabun') ";
	$sql_search .= " ) ";
}
//검색 : 채용형태
if ($stx_work_form) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.work_form = $stx_work_form) ";
	$sql_search .= " ) ";
}
//검색 : 취득여부
//echo $stx_get_ok;
//exit;
if ($stx_get_ok == '0') {
	$sql_search .= " and ( ";
	$sql_search .= " (a.apply_gy = '$stx_get_ok') ";
	$sql_search .= " ) ";
} else if ($stx_get_ok == 1) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.apply_gy = '') ";
	$sql_search .= " ) ";
}
//검색 : 재직상태
if(!$stx_emp_stat) $stx_emp_stat = "0";
if ($stx_emp_stat != "all") {
	$sql_search .= " and ( ";
	$sql_search .= " (a.gubun = '$stx_emp_stat') ";
	$sql_search .= " ) ";
}
//검색 : 임시퇴사
if($stx_out_temp == "no") $stx_out_temp_var = "";
if($stx_out_temp != "all") {
	if($stx_out_temp == 1) $stx_out_temp_var = 1;
	$sql_search .= " and ( ";
	$sql_search .= " (a.out_temp = '$stx_out_temp_var') ";
	$sql_search .= " ) ";
}
//정렬
$sql_common_sort = " from com_code_sort ";
$sql_search_sort = " where com_code = '$com_code' ";
//정렬 1순위
$sql1 = " select * $sql_common_sort $sql_search_sort  and code = '1' ";
$result1 = sql_query($sql1);
$row1 = mysql_fetch_array($result1);
$sort1 = $row1['item'];
$sod1 = $row1['sod'];
//정렬 2순위
$sql2 = " select * $sql_common_sort $sql_search_sort  and code = '2' ";
$result2 = sql_query($sql2);
$row2 = mysql_fetch_array($result2);
$sort2 = $row2['item'];
$sod2 = $row2['sod'];
//정렬 3순위
$sql3 = " select * $sql_common_sort $sql_search_sort  and code = '3' ";
$result3 = sql_query($sql3);
$row3 = mysql_fetch_array($result3);
$sort3 = $row3['item'];
$sod3 = $row3['sod'];
//정렬 4순위
$sql4 = " select * $sql_common_sort $sql_search_sort  and code = '4' ";
$result4 = sql_query($sql4);
$row4 = mysql_fetch_array($result4);
$sort4 = $row4['item'];
$sod4 = $row4['sod'];

if (!$sst) {
	if($is_admin == "super") {
		$sst = "a.com_code";
		$sod = "desc";
	} else {
		if($sort1) {
			if($sort1 == "in_day" || $sort1 == "name" || $sort1 == "work_form") $sst = "a.".$sort1;
			else $sst = "b.".$sort1;
			$sod = $sod1;
		} else {
			$sst = "b.position";
			$sod = "asc";
		}
	}
}
if (!$sst2) {
	if($sort2) {
		if($sort2 == "in_day" || $sort2 == "name" || $sort2 == "work_form") $sst2 = ", a.".$sort2;
		else $sst2 = ", b.".$sort2;
		$sod2 = $sod2;
	} else {
		$sst2 = ", a.in_day";
		$sod2 = "asc";
	}
}
if (!$sst3) {
	if($sort3) {
		if($sort3 == "in_day" || $sort3 == "name" || $sort3 == "work_form") $sst3 = ", a.".$sort3;
		else $sst3 = ", b.".$sort3;
		$sod3 = $sod3;
	} else {
		$sst3 = ", b.dept";
		$sod3 = "asc";
	}
}
if (!$sst4) {
	if($sort4) {
		if($sort4 == "in_day" || $sort4 == "name" || $sort4 == "work_form") $sst4 = ", a.".$sort4;
		else $sst4 = ", b.".$sort4;
		$sod4 = $sod4;
	} else {
		$sst4 = ", b.pay_gbn";
		$sod4 = "asc";
	}
}

$sql_order = " order by $sst $sod $sst2 $sod2 $sst3 $sod3 $sst4 $sod4 ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
//echo $sql;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 999;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sub_title = "사원정보(활동보조인)";

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 14;

//장애여부
//drawback_form
//drawback_form_grade
$file_name = $sub_title.".xls";
header("Pragma:");
header("Cache-Control:");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
header("Content-Description: PHP5 Generated Data");
?>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:x="urn:schemas-microsoft-com:office:excel">
<table width="1200" border="1" cellspacing="1" cellpadding="3">
	<tr>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "연번")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "성명")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "주민등록번호")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "입사일")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "퇴사일")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "전화번호")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "주소")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "은행명")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "계좌번호")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "장애여부")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "장애등급")?></td>
	</tr>
<?
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//$page
	//$total_page
	//$rows

	$no = $total_count - ($total_count - $i - ($rows*($page-1))) + 1;
  $list = $i%2;
	//사업장 코드 / 사번 / 코드_사번
	$code = $row[com_code];
	$id = $row[sabun];
	$code_id = $code."_".$id;
	// 사업장명 : 사업장코드
	$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$code' ";
	$row_com = sql_fetch($sql_com);
	$com_name = $row_com[com_name];
	$com_name = cut_str($com_name, 21, "..");
	$name = cut_str($row[name], 6, "..");
	//채용형태
	if($row[work_form] == "") $work_form = "-";
	else if($row[work_form] == "1") $work_form = "정규직";
	else if($row[work_form] == "2") $work_form = "계약직";
	else if($row[work_form] == "3") $work_form = "일용직";
	else if($row[work_form] == "4") $work_form = "사업소득";
	//입사일/퇴사일
	if($row[in_day] == "..") $in_day = "-";
	else if($row[in_day] == "") $in_day = "-";
	else $in_day = $row[in_day];
	if($row[out_day] == "..") $out_day = "-";
	else if($row[out_day] == "") $out_day = "-";
	else $out_day = $row[out_day];
	//퇴사자 표시
	if($row[out_day] == "..") $out_text = "";
	else if($row[out_day] == "") $out_text = "";
	else $out_text = "(퇴사)";
	//직위
	$position = " ";
	if($row[position]) {
		$sql_position = " select * from com_code_list where item='position' and com_code = '$code' and code = $row[position] ";
		//echo $sql_position;
		$result_position = sql_query($sql_position);
		$row_position = sql_fetch_array($result_position);
		$position = $row_position[name];
		if($position == "단시간근로자") $position = "단시간<br>근로자";
	}
	//부서
	//$dept = $row[dept_1];
	if($row[dept]) {
		$sql_dept = " select * from com_code_list where item='dept' and com_code='$code' and code = $row[dept] ";
		$result_dept = sql_query($sql_dept);
		$row_dept = sql_fetch_array($result_dept);
		$dept = $row_dept[name];
		if($dept == "명동지점(스텝)") $dept = "명동지점<br>(스텝)";
		else if($dept == "안양지점(스텝)") $dept = "안양지점<br>(스텝)";
		else if($dept == "명동지점(대리주차)") $dept = "명동지점<br>(대리주차)";
		else if($dept == "안양지점(대리주차)") $dept = "안양지점<br>(대리주차)";
	} else {
		$dept = "-";
	}
	//주민등록번호 뒷 다섯자리 별표 처리
	//$jumin_no = substr($row[jumin_no],0,9)."*****";
	$jumin_no = $row[jumin_no];
	//만나이
	$now_date = date("Ymd");
	$jumin_date = "19".substr($row[jumin_no],0,9);
	$age_cal = ( $now_date - $jumin_date ) / 10000;
	$age = (int)$age_cal;
	//국민연금 만60세 해당 사원
	if($age_cal >= 60) {
		$color_km = "style='color:red' title='만 60세 이상 근로자'";
	} else {
		$color_km = "";
	}
	//고용보험 만65세 해당 사원
	if($age_cal >= 65) {
		$color_gy = "style='color:red' title='만 65세 이상 근로자'";
	} else {
		$color_gy = "";
	}
	//급여구분
	if($row[pay_gbn] == "0") $pay_gbn = "월급제";
	else if($row[pay_gbn] == "1") $pay_gbn = "시급제";
	else if($row[pay_gbn] == "2") $pay_gbn = "복합근무";
	else if($row[pay_gbn] == "3") $pay_gbn = "연봉제";
	else $pay_gbn = "-";
	//재직상태
	if($row[gubun] == "0") $emp_stat = "재직";
	else if($row[gubun] == "1") $emp_stat = "휴직";
	else if($row[gubun] == "2") $emp_stat = "<span style='color:red'>퇴직</span>";
	//연락처
	if(!$row[add_tel]) {
		$tel_cel = $row[emp_cel];
	} else {
		$tel_cel = $row[add_tel];
	}
	//주소
	if($row['w_juso']) $adr = $row['w_juso']." ".$row['w_juso2'];
	else $adr = "-";
	//계좌번호
	$bank_name = $row['bank_name'];
	$bank_account = $row['bank_account'];
	//장애여부
	$drawback_form_arry = array("0.해당사항없음","1.지체장애","2.뇌병변장애","3.시각장애","4.청각장애","5.언어장애","6.안명장애","7.신장장애","8.심장장애","9.간장애","10.호흡기장애","11.장루/요루장애","12.간질장애","13.지적장애","14.정신장애","15.자폐성장애","16.기타");
	$drawback_form = $row['drawback_form'];
	if($row['drawback_form']) $drawback_form_text = $drawback_form_arry[$drawback_form];
	else $drawback_form_text = "-";
	//장애 등급
	if($row['drawback_form_grade']) $drawback_form_grade_text = $row['drawback_form_grade']."급";
	else $drawback_form_grade_text = "-";
?>
	<tr>
		<td align="center"><?=$no?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $name)?></td>
		<td align="center"><?=$jumin_no?></td>
		<td align="center"><?=$in_day?></td>
		<td align="center"><?=$out_day?></td>
		<td align="center"><?=$tel_cel?></td>
		<td align="left"><?=iconv("EUC-KR", "UTF-8", $adr)?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $bank_name)?></td>
		<td align="center" x:str><?=iconv("EUC-KR", "UTF-8", $bank_account)?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $drawback_form_text)?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $drawback_form_grade_text)?></td>
	</tr>
<?
}
?>
</table>
</body>
</html>