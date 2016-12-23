<?
$sub_menu = "400100";
include_once("./_common.php");

$sql_common = " from pibohum_base_pay ";

$sql_a4 = " select * from $g4[com_list_gy] where com_code = '$code' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4['com_code'];
$com_name = $row_a4['com_name'];

$sql_a4_opt = " select * from com_list_gy_opt where com_code = '$com_code' ";
$row_a4_opt = sql_fetch($sql_a4_opt);

$sub_title = "급여대장";
$g4['title'] = $sub_title." : 서식출력 : ".$easynomu_name;

$colspan = 11;

//년도, 월 설정
if(!$search_year) $search_year = date("Y");
if(!$search_month) $search_month = date("m");

//급여대장
$sql_search = " where com_code='$com_code' and year = '$search_year' and month = '$search_month' ";

//등록일
if($w_date) $sql_search .= " and w_date='$w_date' ";
//등록시
if($w_time) $sql_search .= " and w_time='$w_time' ";

//실지급액 0일 경우 제외 160331
$sql_search .= " and money_result > 0 ";

$sql_order = " order by dept_code asc, position asc, in_day asc ";
$from_record = 0;
//$rows = 7;

//급여대장 근로자수
$sql = " select count(*) as cnt
          $sql_common
          $sql_search ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
//echo $total_count;
$rows = $total_count;
$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);

$file_name = $com_name."_급여명세서_".$search_year."_".$search_month.".xls";
header("Pragma:");
header("Cache-Control:");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
header("Content-Description: PHP5 Generated Data");

//통상임금
$sql_g = " select * from com_paycode_list where com_code = '$com_code' and item='trade' ";
//echo $sql_g;
$result_g = sql_query($sql_g);
for($i=0; $row_g=sql_fetch_array($result_g); $i++) {
	$g_code = $row_g[code];
	$money_g_txt[$g_code] = $row_g[name];
	//echo $g_code;
}
//기타수당
$sql_e = " select * from com_paycode_list where com_code = '$com_code' and item='privilege' ";
$result_e = sql_query($sql_e);
for($i=0; $row_e=sql_fetch_array($result_e); $i++) {
	$e_code = $row_e[code];
	$money_e_txt[$e_code] = $row_e[name];
}

// 리스트 출력
$pay_page = ceil($rows / 6);
//echo $pay_page;
for($i=1;$i<=$pay_page;$i++) {
	$w_day_sum[$i] = 0;
}
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//데이터 없을시 공백처리
	if(!$row['in_day']) $row['in_day'] = "-";
	if(!$row['out_day']) $row['out_day'] = "-";
	//주민등록번호
	$sql_sabun = " select * from pibohum_base where com_code='$row[com_code]' and sabun='$row[sabun]' ";
	$result_sabun = sql_query($sql_sabun);
	$row_sabun = mysql_fetch_array($result_sabun);
	if($row_sabun['jumin_no']) {
		$ssnb_txt = $row_sabun['jumin_no'];
	} else {
		$ssnb_txt = " ";
	}
	//직책
	$position_txt = $row['position_txt'];
	//입사일
	$in_day_array = explode(".", $row['in_day']);
	$in_day = $in_day_array[0]."년 ".$in_day_array[1]."월 ".$in_day_array[2]."일";

	//사번
	$employee_no = $row_sabun['employee_no'];

	//근로시간
	$w_sum = $row[workhour_total];

	//근태공제 시간
	$w_late = $row['w_late'];
	$w_leave = $row['w_leave'];
	$w_out = $row['w_out'];
	$w_absence = $row['w_absence'];
	$w_etc = $w_late + $w_leave + $w_out + $w_absence;

	//통상임금수당
	$g_sum = $row[g1] + $row[g2] + $row[g3] + $row[g4] + $row[g5];

	//법정수당
	$s_sum = $row[ext] + $row[ext_add] + $row[night] + $row[hday] + $row[annual_paid_holiday]  + $row[money_period];

	//기타수당
	$b_sum = $row[b1] + $row[b2] + $row[b3] + $row[b4] + $row[b5] + $row[b6] + $row[b7] + $row[b8] + $row[b9];

	//공제합계
	//$m_sum = $row['tax_so'] + $row['tax_jumin'] + $row['health'] + $row['yoyang'] + $row['yun'] + $row['goyong'] + $row['minus'];
	$m_sum = $row['money_gongje'];
?>
<table border="1" cellspacing="1" cellpadding="3">
	<tr>
		<td align="center" colspan="7"><strong>( <?=iconv("EUC-KR", "UTF-8", $row['name'])?> ) <?=$search_year?><?=iconv("EUC-KR", "UTF-8", "년")?> <?=$search_month?><?=iconv("EUC-KR", "UTF-8", "월 급여내역")?></strong></td>
	</tr>
	<tr>
		<td align="center" rowspan="2"><?=iconv("EUC-KR", "UTF-8", "성명")?></td>
		<td align="center" rowspan="2" colspan="3"><?=iconv("EUC-KR", "UTF-8", $row['name'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "직책")?></td>
		<td align="center" colspan="2"><?=iconv("EUC-KR", "UTF-8", $position_txt)?></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "사번")?></td>
		<td align="center" colspan="2"><?=iconv("EUC-KR", "UTF-8", $employee_no)?></td>
	</tr>
	<tr>
		<td align="center" colspan="7"><strong><?=iconv("EUC-KR", "UTF-8", "급여내역")?></strong></td>
	</tr>
	<tr>
		<td align="center" rowspan=""><?=iconv("EUC-KR", "UTF-8", "기본급")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "통상시급")?></td>
		<td align="center"><?=number_format($row['money_min_base'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "기본급")?></td>
		<td align="center"><?=number_format($row['money_month'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
	</tr>
	<tr>
		<td align="center" rowspan="4" ><?=iconv("EUC-KR", "UTF-8", "<br />근로<br />시간")?></td>
		<td align="center" colspan="6"><strong><?=iconv("EUC-KR", "UTF-8", "월소정근로시간")?></strong></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "기본근로")?></td>
		<td align="center"><?=$row['w_day']?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "시간")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "연장근로")?></td>
		<td align="center"><?=$row['w_ext']?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "시간")?></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "야간근로")?></td>
		<td align="center"><?=$row['w_night']?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "시간")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "휴일근로")?></td>
		<td align="center"><?=$row['w_hday']?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "시간")?></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "근태공제")?></td>
		<td align="center"><?=$w_etc?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "시간")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "소계")?></td>
		<td align="center"><?=number_format($w_sum)?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "시간")?></td>
	</tr>
	<tr>
		<td align="center" rowspan="3" ><?=iconv("EUC-KR", "UTF-8", "통상<br />임금<br />수당")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $money_g_txt['g1'])?></td>
		<td align="center"><?=number_format($row['g1'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $money_g_txt['g4'])?></td>
		<td align="center"><?=number_format($row['g4'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $money_g_txt['g2'])?></td>
		<td align="center"><?=number_format($row['g2'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $money_g_txt['g5'])?></td>
		<td align="center"><?=number_format($row['g5'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $money_g_txt['g3'])?></td>
		<td align="center"><?=number_format($row['g3'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
	</tr>
	<tr>
		<td align="center" rowspan="3" ><?=iconv("EUC-KR", "UTF-8", "법정<br />수당")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "기본연장")?></td>
		<td align="center"><?=number_format($row['ext'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "연차수당")?></td>
		<td align="center"><?=number_format($row['annual_paid_holiday'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "야간근로")?></td>
		<td align="center"><?=number_format($row['night'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "휴일근로")?></td>
		<td align="center"><?=number_format($row['hday'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
	</tr>
	<tr>
		<td align="center" rowspan="2" ><?=iconv("EUC-KR", "UTF-8", "기타<br />(비과세)")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $money_e_txt['e1'])?></td>
		<td align="center"><?=number_format($row['b1'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $money_e_txt['e3'])?></td>
		<td align="center"><?=number_format($row['b3'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $money_e_txt['e2'])?></td>
		<td align="center"><?=number_format($row['b2'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
	</tr>
	<tr>
		<td align="center" rowspan="3" ><?=iconv("EUC-KR", "UTF-8", "기타<br />(과세)")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $money_e_txt['e4'])?></td>
		<td align="center"><?=number_format($row['b4'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $money_e_txt['e6'])?></td>
		<td align="center"><?=number_format($row['b6'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $money_e_txt['e5'])?></td>
		<td align="center"><?=number_format($row['b5'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $money_e_txt['e7'])?></td>
		<td align="center"><?=number_format($row['b7'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $money_e_txt['e8'])?></td>
		<td align="center"><?=number_format($row['b8'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", $money_e_txt['e9'])?></td>
		<td align="center"><?=number_format($row['b9'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "기타")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "컨설팅")?></td>
		<td align="center"><?=number_format($row['etc'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
	</tr>
	<tr>
		<td align="center" colspan="5"><strong><?=iconv("EUC-KR", "UTF-8", "임금계")?></strong></td>
		<td align="center"><?=number_format($row['money_total'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
	</tr>
	<tr>
		<td align="center" colspan="5"><strong><?=iconv("EUC-KR", "UTF-8", "과세소득")?></strong></td>
		<td align="center"><?=number_format($row['money_for_tax'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
	</tr>
	<tr>
		<td align="center" colspan="7"><strong><?=iconv("EUC-KR", "UTF-8", "공제내역")?></strong></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "세금")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "소득세")?></td>
		<td align="center"><?=number_format($row['tax_so'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "주민세")?></td>
		<td align="center"><?=number_format($row['tax_jumin'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
	</tr>
	<tr>
		<td align="center" rowspan="2"><?=iconv("EUC-KR", "UTF-8", "4대<br />보험")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "국민연금")?></td>
		<td align="center"><?=number_format($row['yun'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "고용보험")?></td>
		<td align="center"><?=number_format($row['goyong'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "건강보험")?></td>
		<td align="center"><?=number_format($row['health'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "장기요양")?></td>
		<td align="center"><?=number_format($row['yoyang'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
	</tr>
	<tr>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "기타")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "기타공제")?></td>
		<td align="center"><?=number_format($row['minus'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "근태공제")?></td>
		<td align="center">
<?
	if($row['etc2']) {
		//근태공제 마이너스 표시 160224 -> 플러스 표시 160503
		//echo "-".number_format($row['etc2']);
		echo number_format($row['etc2']);
	} else {
		echo "0";
	}
?>
		</td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
	</tr>
	<tr>
		<td align="center" colspan="5"><strong><?=iconv("EUC-KR", "UTF-8", "공제총액")?></strong></td>
		<td align="center"><?=number_format($m_sum)?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
	</tr>
	<tr>
		<td align="center" colspan="5"><strong><?=iconv("EUC-KR", "UTF-8", "실지급총액")?></strong></td>
		<td align="center"><?=number_format($row['money_result'])?></td>
		<td align="center"><?=iconv("EUC-KR", "UTF-8", "원")?></td>
	</tr>
</table>
<br />
<?
}
?>		
</body>
</html>
