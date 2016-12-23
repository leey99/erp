<?
$sub_menu = "200100";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$sql_common = " from $g4[pibohum_base] a, pibohum_base_pay_h c ";

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

//년도, 월 설정 (현재 년월 이전달 -1) 151005
if(!$search_month) {
	$search_month = date("m");
	//echo $search_month;
	if($search_month == 1) {
		$search_year_minus = 1;
		$search_month = 12;
	} else {
		$search_year_minus = 0;
		$search_month -= 1;
	}
	if($search_month < 10) $search_month = "0".$search_month;
	$search_year = date("Y");
	$search_year -= $search_year_minus;
	//이전 달 -2
	$search_month_pre = $search_month;
	if($search_month_pre == 1) {
		$search_year_minus = 1;
		$search_month_pre = 12;
	} else {
		$search_year_minus = 0;
		$search_month_pre -= 1;
	}
	if($search_month_pre < 10) $search_month_pre = "0".$search_month_pre;
	$search_year_pre = $search_year;
	$search_year_pre -= $search_year_minus;
	//이전 달 -3
	$search_month_pre2 = $search_month_pre;
	if($search_month_pre2 == 1) {
		$search_year_minus = 1;
		$search_month_pre2 = 12;
	} else {
		$search_year_minus = 0;
		$search_month_pre2 -= 1;
	}
	if($search_month_pre2 < 10) $search_month_pre2 = "0".$search_month_pre2;
	$search_year_pre2 = $search_year_pre;
	$search_year_pre2 -= $search_year_minus;
	//이전 달 -4
	$search_month_pre3 = $search_month_pre2;
	if($search_month_pre3 == 1) {
		$search_year_minus = 1;
		$search_month_pre3 = 12;
	} else {
		$search_year_minus = 0;
		$search_month_pre3 -= 1;
	}
	if($search_month_pre3 < 10) $search_month_pre3 = "0".$search_month_pre3;
	$search_year_pre3 = $search_year_pre;
	$search_year_pre3 -= $search_year_minus;
}

if($is_admin == "super") {
	$sql_search = " where 1=1 ";
} else {
	$sql_search = " where a.com_code='$com_code' ";
}
//급여대장 DB join
$sql_search .= " and (a.com_code = c.com_code and a.sabun = c.sabun) ";
//전월 급여대장
$sql_search .= " and ( c.year = '$search_year' and c.month = '$search_month' ) ";
//과세 급여 존재
//$sql_search .= " and c.money_for_tax > 0 ";
//퇴사자 제외
$sql_search .= " and a.out_day='' ";
//그룹
$group_by = " group by c.com_code, c.sabun ";
$sql_order = " order by a.name ";
//표시 제한
$rows = 300;
if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sub_title = "4대보험신고(자동)";
$g4[title] = $sub_title." : 사원관리 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
					$group_by
          $sql_order ";
echo $sql;
$result = sql_query($sql);
$colspan = 14;

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
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "입사일<br />퇴사일")?></td>
		<td bgcolor="#65CBFF" align="center"><strong><?=$search_year_pre3.".".$search_month_pre3?></strong>)<br />(<strong><?=$search_year_pre2.".".$search_month_pre2?></strong></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "時")?></td>
		<td bgcolor="#65CBFF" align="center"><strong><?=$search_year_pre.".".$search_month_pre?></strong>)<br />(<strong><?=$search_year.".".$search_month?></strong></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "時")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "신고구분")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "변경연월")?></td>
		<td bgcolor="#65CBFF" align="center"><?=iconv("EUC-KR", "UTF-8", "신고보험")?></td>
	</tr>
<?
//대상 근로자 카운트
$staff_count = 0;
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//$page
	//$total_page
	//$rows
	$no = $total_count - ($total_count - $i - ($rows*($page-1))) + 1;
  $list = $i%2;
	//사업장 코드 / 사번 / 코드_사번
	$code = $row['com_code'];
	$id = $row['sabun'];
	$code_id = $code."_".$id;
	//사원명
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
	//주민등록번호 뒷 다섯자리 별표 처리
	$jumin_no = substr($row[jumin_no],0,9)."*****";
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
	//보수(이전월)
	$sql_month_pre = " select money_for_tax, workhour_total from pibohum_base_pay_h where com_code='$code' and sabun='$id' and year='$search_year_pre' and month='$search_month_pre' ";
	$row_month_pre = sql_fetch($sql_month_pre);
	$money_month_pre = $row_month_pre['money_for_tax'];
	$workhour_total_pre = $row_month_pre['workhour_total'];
	if(!$workhour_total_pre) $workhour_total_pre = "0";
	//보수(이전월) -2 개월
	$sql_month_pre2 = " select money_for_tax, workhour_total from pibohum_base_pay_h where com_code='$code' and sabun='$id' and year='$search_year_pre2' and month='$search_month_pre2' ";
	$row_month_pre2 = sql_fetch($sql_month_pre2);
	$money_month_pre2 = $row_month_pre2['money_for_tax'];
	$workhour_total_pre2 = $row_month_pre2['workhour_total'];
	if(!$workhour_total_pre2) $workhour_total_pre2 = "0";
	//보수(이전월) -3 개월
	$sql_month_pre3 = " select money_for_tax, workhour_total from pibohum_base_pay_h where com_code='$code' and sabun='$id' and year='$search_year_pre3' and month='$search_month_pre3' ";
	$row_month_pre3 = sql_fetch($sql_month_pre3);
	$money_month_pre3 = $row_month_pre3['money_for_tax'];
	$workhour_total_pre3 = $row_month_pre3['workhour_total'];
	if(!$workhour_total_pre3) $workhour_total_pre3 = "0";
	//보수(해당월)
	$money_month = $row['money_for_tax'];
	//총근로시간(해당월)
	$workhour_total = $row['workhour_total'];
	//변경사유
	if($money_month_pre < $money_month) $modify_reason = "보수인상";
	else $modify_reason = "보수인하";
	//취득신고
	if($money_month_pre == 0) $modify_reason = "취득신고";
	//상실신고
	if($money_month == 0) $modify_reason = "상실신고";
	//신고구분 스타일
	if($modify_reason == "취득신고") $reason_style = "color:blue;";
	else if($modify_reason == "상실신고") $reason_style = "color:red;";
	else $reason_style = "";
	//변경연월
	if($modify_reason == "보수인상" || $modify_reason == "보수인하") $modify_year_month = $search_year.".".$search_month;
	else $modify_year_month = "-";
	//신고보험 선택
	if($money_month_pre == 0) {
		$row['apply_km'] = "";
		$row['apply_gg'] = "";
	}
	//전월 동일 미지급 근로자 제외
	if($money_month > 0 || $money_month_pre > 0) {
		$staff_count++;
		//연금 신고 유무 : 보수인하 20% 차이 151012
		if($modify_reason == "보수인상" || $modify_reason == "보수인하") {
			//보수변경 건만 체크
			$idx_checked = "checked";
			if($row['apply_km'] == "0") {
				//보수인상 체크 해지
				if($money_month_pre < $money_month) {
					$apply_km_checked = "";
				} else {
					//보수인하 20$ 차이 비교
					if( ($money_month_pre-$money_month) > ($money_month_pre/5) ) $apply_km_checked = "checked";
					else $apply_km_checked = "";
				}
			} else {
				$apply_km_checked = "";
			}
			//무조건 연금 체크 해제 160125
			$apply_km_checked = "";
		} else {
			$idx_checked = "";
			if($money_month == 0) {
				$row['apply_gy'] = "";
				$row['apply_sj'] = "";
			}
		}
		//인상, 인하 폭 계산 : abs() 음수일 경우 정수로 변환 151112
		$modify_pay_diff = abs($money_month_pre - $money_month);
		//echo $name." ".$modify_pay_diff." ";
		//취득,상실 포함 : 인상, 인하 폭 1만원 미만 제외
		//if( ($modify_reason == "취득신고" || $modify_reason == "상실신고") || ( ($modify_reason == "보수인상" || $modify_reason == "보수인하") && $modify_pay_diff >= 10000 ) ) {
		//차이 1만원 미만 신고구분 미표시
		if($modify_pay_diff < 10000) {
			$idx_checked = "";
			$modify_reason = "-";
		}
?>
	<tr>
		<td align="center"><?=$staff_count?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $name)?></td>
		<td align="center"><?=$jumin_no?></td>
		<td align="center"><?=$in_day?><br /><span style="color:red"><?=$out_day?></span></td>
		<td align="center"><?=number_format($money_month_pre3)?><br /><?=number_format($money_month_pre2)?></td>
		<td align="center"><?=$workhour_total_pre3?><br /><?=$workhour_total_pre2?></td>
		<td align="center"><?=number_format($money_month_pre)?><br /><?=number_format($money_month)?></td>
		<td align="center"><?=$workhour_total_pre?><br /><?=$workhour_total?></td>
		<td align="center" style="<?=$reason_style?>"><?=iconv("EUC-KR", "UTF-8", $modify_reason)?></td>
		<td align="center"><?=$modify_year_month?></td>
		<td align="center">
			<? if($row['apply_gy'] == "0") echo iconv("EUC-KR", "UTF-8", "고용"); ?>
			<? if($row['apply_sj'] == "0") echo iconv("EUC-KR", "UTF-8", "산재"); ?>
			<? if($apply_km_checked) echo iconv("EUC-KR", "UTF-8", "연금"); ?>
			<? if($row['apply_gg'] == "0") echo iconv("EUC-KR", "UTF-8", "건강"); ?>
		</td>
	</tr>
<?
	}
}
?>
</table>
</body>
</html>


