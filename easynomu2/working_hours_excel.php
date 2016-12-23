<?
$sub_menu = "200412";
include_once("./_common.php");

//현재 연도
//$now_year = date("Y");
$now_year = 2015;
$code = $com_code;

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

$sql_common = " from $g4[pibohum_base] a, pibohum_base_opt b ";

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
//화성시장애인부모회 : 상용직만 추출
if($comp_print_type == "H") {
	if($kind == "beistand") {
		$sql_search .= " and ( b.position = '13' ) ";
		$title = "활동보조인";
	} else if($kind == "helper") {
		$sql_search .= " and ( b.position = '14' ) ";
		$title = "헬퍼";
	} else {
		$sql_search .= " and ( b.position != '13' and b.position != '14' ) ";
		$title = "상용직";
	}
} else {
		$title = "근로자";
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
// 검색 : 사번
if ($stx_sabun) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.sabun like '$stx_sabun%') ";
	$sql_search .= " ) ";
}
// 검색 : 채용형태
if ($stx_work_form) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.work_form = $stx_work_form) ";
	$sql_search .= " ) ";
}
// 검색 : 취득여부
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
//if(!$stx_emp_stat) $stx_emp_stat = "0";
if(!$stx_emp_stat) $stx_emp_stat = "all";
if ($stx_emp_stat != "all") {
	$sql_search .= " and ( ";
	$sql_search .= " (a.gubun = '$stx_emp_stat') ";
	$sql_search .= " ) ";
}
//정렬
$sql_common_sort = " from com_code_sort ";
$sql_search_sort = " where com_code = '$com_code' ";
//정렬 1순위
$sql1 = " select * $sql_common_sort $sql_search_sort  and code = '1' ";
$result1 = sql_query($sql1);
$row1 = mysql_fetch_array($result1);
$sort1 = $row1[item];
$sod1 = $row1[sod];
//정렬 2순위
$sql2 = " select * $sql_common_sort $sql_search_sort  and code = '2' ";
$result2 = sql_query($sql2);
$row2 = mysql_fetch_array($result2);
$sort2 = $row2[item];
$sod2 = $row2[sod];
//정렬 3순위
$sql3 = " select * $sql_common_sort $sql_search_sort  and code = '3' ";
$result3 = sql_query($sql3);
$row3 = mysql_fetch_array($result3);
$sort3 = $row3[item];
$sod3 = $row3[sod];
//정렬 4순위
$sql4 = " select * $sql_common_sort $sql_search_sort  and code = '4' ";
$result4 = sql_query($sql4);
$row4 = mysql_fetch_array($result4);
$sort4 = $row4[item];
$sod4 = $row4[sod];

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

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
//echo $sql;
$result = sql_query($sql);
$colspan = 11;

$now_date_file = date("Ymd");
$file_name = "근로시간_급여_".$title."_".$now_date_file.".xls";
header("Pragma:");
header("Cache-Control:");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
header("Content-Description: PHP5 Generated Data");
?>
<style type="text/css">
table { font-size:10px; }
</style>
<table border="1" cellspacing="1" cellpadding="3" bgcolor="#5B8398">
			<tr bgcolor="65CBFF" align=center>
				<td align="center" rowspan="2">번호</td>
				<td align="center" rowspan="2">성명</td>
<?
if($kind != "beistand" && $kind != "helper") {
?>
				<td align="center" rowspan="2">직위</td>
				<td align="center" rowspan="2">부서</td>
<?
}
?>
				<td align="center" rowspan="2">주민등록번호</td>
				<td align="center" rowspan="2">만나이</td>
				<td align="center" rowspan="2">입사일</td>
				<td align="center" rowspan="2">퇴사일</td>
				<td align="center" colspan="26">2012년도</td>
				<td align="center" colspan="26">2013년도</td>
				<td align="center" colspan="26">2014년도</td>
				<td align="center" colspan="26">2015년도</td>
				<td align="center" colspan="26">2016년도</td>
				<td align="center" rowspan="2">근로시간</td>
				<td align="center" rowspan="2">총급여</td>
			</tr>
			<tr bgcolor="65CBFF" align=center>
<?
//연도별 월 표시
for($y=($now_year-3);$y<=($now_year+1);$y++) {
?>
				<td align="center" colspan="2">1월</td>
				<td align="center" colspan="2">2월</td>
				<td align="center" colspan="2">3월</td>
				<td align="center" colspan="2">4월</td>
				<td align="center" colspan="2">5월</td>
				<td align="center" colspan="2">6월</td>
				<td align="center" colspan="2">7월</td>
				<td align="center" colspan="2">8월</td>
				<td align="center" colspan="2">9월</td>
				<td align="center" colspan="2">10월</td>
				<td align="center" colspan="2">11월</td>
				<td align="center" colspan="2">12월</td>
				<td align="center" colspan="2">합계</td>
<?
}
?>
			</tr>
<?
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $i + 1;
	$code = $row[com_code];
	$id = $row[sabun];
	//근로자명
	$name = cut_str($row[name], 6, "..");
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
	//사원 추가 DB
	$sql2 = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
	$result2 = sql_query($sql2);
	$row2=mysql_fetch_array($result2);
	//직위
	$position = " ";
	if($row2[position]) {
		$sql_position = " select * from com_code_list where item='position' and com_code = '$code' and code = $row2[position] ";
		//echo $sql_position;
		$result_position = sql_query($sql_position);
		$row_position = sql_fetch_array($result_position);
		$position = $row_position[name];
		if($position == "단시간근로자") $position = "단시간<br>근로자";
	}
	//부서
	//$dept = $row2[dept_1];
	if($row2[dept]) {
		$sql_dept = " select * from com_code_list where item='dept' and com_code='$code' and code = $row2[dept] ";
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
	$jumin_no = substr($row[jumin_no],0,9)."*";
	//만나이
	$now_date = date("Ymd");
	$jumin_date = "19".substr($row[jumin_no],0,9);
	$age_cal = ( $now_date - $jumin_date ) / 10000;
	$age = (int)$age_cal;
	//근로시간
	$work_gbn = $row2[work_gbn];
	$sql_time = " select * from a4_work_time where com_code = '$code' and work_gbn = '$work_gbn' ";
	$result_time = sql_query($sql_time);
	$row_time = sql_fetch_array($result_time);
	$work_gbn_text = $row_time[work_gbn_text];
	if($work_gbn_text) $work_gbn_text = cut_str($work_gbn_text, 8, "..");
	//급여구분
	if($row2[pay_gbn] == "0") $pay_gbn = "월급제";
	else if($row2[pay_gbn] == "1") $pay_gbn = "시급제";
	else if($row2[pay_gbn] == "2") $pay_gbn = "복합근무";
	else if($row2[pay_gbn] == "3") $pay_gbn = "연봉제";
	else if($row2[pay_gbn] == "4") $pay_gbn = "일급제";
	else if($row2[pay_gbn] == "5") $pay_gbn = "사업소득";
	else $pay_gbn = "-";
	//근로시간 총액
	$rp_sum_sum = 0;
	$rp_month = 0;
	//총 급여
	$pay_sum_sum = 0;
	for($y=($now_year-3);$y<=($now_year+1);$y++) {
		$sql_rp = " select sum(workhour_total) as rp_sum, sum(money_for_tax) as pay_sum from pibohum_base_pay_h where com_code='$code' and sabun='$id' and year='$y' ";
		//echo $sql_rp."<br />";
		$result_rp = sql_query($sql_rp);
		$row_rp = sql_fetch_array($result_rp);
		$rp_sum[$y] = $row_rp['rp_sum'];
		$rp_sum_sum += $rp_sum[$y];
		if($row_rp['rp_sum']) $rp_sum[$y] = number_format($row_rp['rp_sum']);
		else $rp_sum[$y] = "";
		$pay_sum[$y] = $row_rp['pay_sum'];
		$pay_sum_sum += $pay_sum[$y];
		if($row_rp['pay_sum']) $pay_sum[$y] = number_format($row_rp['pay_sum']);
		else $pay_sum[$y] = "";
		$sql_rp_month = " select workhour_total, money_for_tax, month from pibohum_base_pay_h where com_code='$code' and sabun='$id' and year='$y' ";
		$result_rp_month = sql_query($sql_rp_month);
		//해당 연도 근로시간이 없을 경우를 위해 초기화
		for($k=1;$k<=12;$k++) {
			if($k < 10) $k = "0".$k;
			$rp_sum_month[$y][$k] = "";
			$pay_sum_month[$y][$k] = "";
		}
		for($m=0; $row_rp_month=sql_fetch_array($result_rp_month); $m++) {
			//echo $row_rp_month['month']." ".$row_rp_month['workhour_total']."<br />";
			$k = $row_rp_month['month'];
			$rp_sum_month[$y][$k] = number_format($row_rp_month['workhour_total']);
			$pay_sum_month[$y][$k] = number_format($row_rp_month['money_for_tax']);
			if(!$rp_sum_month[$y][$k]) $rp_sum_month[$y][$k] = "";
			if(!$pay_sum_month[$y][$k]) $pay_sum_month[$y][$k] = "";
			//echo $name." ".$y." ".$k." ".$row_rp_month['workhour_total']."<br />";
			if($row_rp_month['workhour_total'] > 0) $rp_month++;
		}
		//if($rp_sum[$y] > 0) echo $sql_rp."<br />";
	}
	if($rp_sum_sum) $rp_sum_sum = number_format($rp_sum_sum);
	else $rp_sum_sum = "";
	if($pay_sum_sum) $pay_sum_sum = number_format($pay_sum_sum);
	else $pay_sum_sum = "";
?>
			<tr bgcolor="#FFFFFF" align=center>
				<td align="center"><?=$no?></td>
				<td align="center"><?=$name?></td>
<?
if($kind != "beistand" && $kind != "helper") {
?>
				<td align="center"><?=$position?></td>
				<td align="center"><?=$dept?></td>
<?
}
?>
				<td align="center"><?=$jumin_no?></td>
				<td align="center">만 <?=$age?></td>
				<td align="center"><?=$in_day?></td>
				<td align="center"><?=$out_day?></td>
<?
	for($y=($now_year-3);$y<=($now_year+1);$y++) {
?>
				<td align="center" width="30" style="font-weight:bold;"><?=$rp_sum_month[$y]['01']?></td>
				<td align="center" width="58"><?=$pay_sum_month[$y]['01']?></td>
				<td align="center" width="30" style="font-weight:bold;"><?=$rp_sum_month[$y]['02']?></td>
				<td align="center" width="58"><?=$pay_sum_month[$y]['02']?></td>
				<td align="center" width="30" style="font-weight:bold;"><?=$rp_sum_month[$y]['03']?></td>
				<td align="center" width="58"><?=$pay_sum_month[$y]['03']?></td>
				<td align="center" width="30" style="font-weight:bold;"><?=$rp_sum_month[$y]['04']?></td>
				<td align="center" width="58"><?=$pay_sum_month[$y]['04']?></td>
				<td align="center" width="30" style="font-weight:bold;"><?=$rp_sum_month[$y]['05']?></td>
				<td align="center" width="58"><?=$pay_sum_month[$y]['05']?></td>
				<td align="center" width="30" style="font-weight:bold;"><?=$rp_sum_month[$y]['06']?></td>
				<td align="center" width="58"><?=$pay_sum_month[$y]['06']?></td>
				<td align="center" width="30" style="font-weight:bold;"><?=$rp_sum_month[$y]['07']?></td>
				<td align="center" width="58"><?=$pay_sum_month[$y]['07']?></td>
				<td align="center" width="30" style="font-weight:bold;"><?=$rp_sum_month[$y]['08']?></td>
				<td align="center" width="58"><?=$pay_sum_month[$y]['08']?></td>
				<td align="center" width="30" style="font-weight:bold;"><?=$rp_sum_month[$y]['09']?></td>
				<td align="center" width="58"><?=$pay_sum_month[$y]['09']?></td>
				<td align="center" width="30" style="font-weight:bold;"><?=$rp_sum_month[$y]['10']?></td>
				<td align="center" width="58"><?=$pay_sum_month[$y]['10']?></td>
				<td align="center" width="30" style="font-weight:bold;"><?=$rp_sum_month[$y]['11']?></td>
				<td align="center" width="58"><?=$pay_sum_month[$y]['11']?></td>
				<td align="center" width="30" style="font-weight:bold;"><?=$rp_sum_month[$y]['12']?></td>
				<td align="center" width="58"><?=$pay_sum_month[$y]['12']?></td>
				<td align="center" width="34" style="font-weight:bold;"><?=$rp_sum[$y]?></td>
				<td align="center" width="62"><?=$pay_sum[$y]?></td>
<?
	}
?>
				<td align="right" style="font-weight:bold;"><?=$rp_sum_sum?></td>
				<td align="right"><?=$pay_sum_sum?></td>
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

