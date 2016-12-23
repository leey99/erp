	<!--mb_name 사업장명-->
	<input type="hidden" name="mb_name" value="<?=$row_a4[com_name]?>" />
	<!--공통변수-->
<?
$comp_type = $row_a4[class_gubun];
if($comp_type != "D") $comp_type = "A";
//$comp_type = "A";
?>
	<input type="hidden" name="comp_type" value="<?=$comp_type?>" title="사업장유형"/>
	<input type="hidden" name="comp_num" value="<?=$row_a4[biz_no]?> " title="사업자등록번호" />
	<input type="hidden" name="comp_name" value="<?=$row_a4[com_name]?>" title="사업장명" />
	<input type="hidden" name="comp_ceo" value="<?=$row_a4[boss_name]?> " title="대표자명" />
	<input type="hidden" name="comp_jumin" value="<?=$row_a4[jumin_no]?> " title="대표자주민번호" />
	<input type="hidden" name="comp_upte" value="<?=$row_a4[uptae]?> " title="업태" />
	<input type="hidden" name="comp_jongmok" value="<?=$row_a4[upjong]?> " title="종목" />
	<input type="hidden" name="comp_tel" value="<?=$row_a4[com_tel]?> " title="사업장전화" />
	<input type="hidden" name="comp_fax" value="<?=$row_a4[com_fax]?> " title="사업장팩스" />
	<input type="hidden" name="comp_cel" value="<?=$row_a4[boss_hp]?> " title="대표자핸드폰" />
	<input type="hidden" name="comp_email" value="<?=$row_a4_opt[boss_mail]?> " title="대표자email" />
	<input type="hidden" name="comp_addr1" value="<?=$row_a4[com_juso]?>" title="사업장주소1" />
	<input type="hidden" name="comp_addr2" value="<?=$row_a4[com_juso2]?> " title="사업장주소2" />
	<input type="hidden" name="today" value="<?=date("Y년 m월 d일")?>" title="오늘날짜"/>
	<input type="hidden" name="yy" value="<?=$search_year?>" title="년도"/>
	<input type="hidden" name="ceo_jik" value="원장"/>
<?
//echo $labor;
if($labor == "labor1") {
	$employee_array = explode("_",$employee);
	$code  = $employee_array[0];
	$sabun = $employee_array[1];
	$sql1 = " select * from $g4[pibohum_base] where com_code='$code' and sabun='$sabun' ";
	$result1 = sql_query($sql1);
	$row1 = mysql_fetch_array($result1);
	$sql2 = " select * from pibohum_base_opt where com_code='$code' and sabun='$sabun' ";
	$result2 = sql_query($sql2);
	$row2 = mysql_fetch_array($result2);
	//echo $sql2;
	//연락처
	if(!$row1[add_tel]) {
		$tel_cel = $row2[emp_cel];
	} else {
		$tel_cel = $row1[add_tel];
	}
	//입사일
	if($row1[in_day] == "") {
		//데이터 없을 시 공백 처리
		$in_day = " ";
	} else {
		$in_day_array = explode(".",$row1[in_day]);
		$in_day = $in_day_array[0]."년 ".$in_day_array[1]."월 ".$in_day_array[2]."일";
	}
	//퇴직일
	//echo "a".$row1[out_day]."b";
	if($row1[out_day] == "") {
		$out_day = " 년 월 일";
	} else {
		$out_day_array = explode(".",$row1[out_day]);
		$out_day = $out_day_array[0]."년 ".$out_day_array[1]."월 ".$out_day_array[2]."일";
	}
	//채용형태
	if($row1[work_form] == "") $work_form = "";
	else if($row1[work_form] == "1") $work_form = "정규직";
	else if($row1[work_form] == "2") $work_form = "계약직";
	else if($row1[work_form] == "3") $work_form = "일용직";

$contract_sdate = str_replace(".","-",$row2[contract_sdate]);
$contract_edate = str_replace(".","-",$row2[contract_edate]);
//상여금
$bonus_percent = $row3[bonus_percent];
$bonus_standard_array = array("","기본급","결정임금","통상임금","총급여");
$bonus_standard = " ";
for($i=0;$i<=count($bonus_standard_array);$i++) {
	if($row3[bonus_standard] == $i) $bonus_standard = $bonus_standard_array[$i];
}
$bonus_array = explode(",",$row3[bonus_p]);
$bonus_time = 0;
for($i=0;$i<=count($bonus_array);$i++) {
	if($bonus_array[$i] != "") $bonus_time++;
}
if($bonus_percent == "0") {
	$bonus1 = "○";
	$bonus2 = " ";
	$bonus3 = " ";
} else {
	$bonus1 = " ";
	$bonus2 = "○";
	if($row3[check_bonus_money_yn] == "Y") $bonus_standard = number_format($row3[bonus_money])."원";
	$bonus3 = $bonus_standard." * ".$bonus_percent."% (".$bonus_time.")회 분할";
}
//휴게시간2(점심시간)
if($row_a4_opt[rest2]) $rest2 = $row_a4_opt[rest2]."~".$row_a4_opt[rest2e];
else $rest2 = "없음";
?>
	<!-- 근로계약서 -->
	<input type="hidden" name="name_k" value="<?=$row1[name]?>" />
	<input type="hidden" name="jumin" value="<?=$row1[jumin_no]?>" />
	<input type="hidden" name="addr" value="<?=$row1[w_juso]?> " />
	<input type="hidden" name="addr2" value="<?=$row2[w_juso2]?> " />
	<input type="hidden" name="cel" value="<?=$row2[emp_cel]?> " title="핸드폰번호" />
	<input type="hidden" name="tel" value="<?=$row1[add_tel]?> " title="사원전화" />
	<input type="hidden" name="email" value="<?=$row2[emp_email]?> " title="EMAIL" />

	<input type="hidden" name="bank_1" value="" title="은행명" />
	<input type="hidden" name="bank_2" value="" title="계좌번호" />
	<input type="hidden" name="bank_3" value="" title="예금주" />
	<input type="hidden" name="jdate" value="<?=$in_day?>" title="입사일" />
	<input type="hidden" name="edate" value="<?=$out_day?>" title="퇴직일" />
	<input type="hidden" name="job_div" value="<?=$work_form?>" />
	<input type="hidden" name="work_form" value="<?=$row1[work_form]?>" />

	<input type="hidden" name="contract_sdate" value="<?=date("Y년 m월 d일",strtotime($contract_sdate))?>" />
	<input type="hidden" name="contract_edate" value="<?=date("Y년 m월 d일",strtotime($contract_edate))?>" />

	<input type="hidden" name="employee_id" value="10150011" title="사번" />
	<input type="hidden" name="dept" value="교무부" title="부서" />
	<input type="hidden" name="jik" value="<?=$row_position[name]?>" title="직위" />

	<input type="hidden" name="jogun" value="40" />
	<input type="hidden" name="wtime" value="10:00" />
	<input type="hidden" name="workhour_40" value="○" />
	<input type="hidden" name="workhour_44" value=" " />
	<input type="hidden" name="stime" value="08:00" />
	<input type="hidden" name="etime" value="18:00" />
	<input type="hidden" name="rest2" value="<?=$row_a4_opt[rest2]?>" />
	<input type="hidden" name="saturday1" value="○" />
	<input type="hidden" name="saturday2" value=" " />
	<input type="hidden" name="saturday_s" value=" " />
	<input type="hidden" name="saturday_e" value=" " />
	<input type="hidden" name="workday1" value="월" />
	<input type="hidden" name="workday2" value="금" />
	<input type="hidden" name="workday3" value="5" />

	<input type="hidden" name="time_chk" value="○" title="시급"/>
	<input type="hidden" name="day_chk" value=" " title="일급"/>
	<input type="hidden" name="timegub" value="<?=number_format($row3[money_hour_ts])?>" title="시간급"/>
	<input type="hidden" name="calculate1" value="1" title="산정1"/>
	<input type="hidden" name="calculate2" value="말" title="산정2"/>
	<input type="hidden" name="payment1" value=" " title="직접지급"/>
	<input type="hidden" name="payment2" value="○" title="입금"/>
	<input type="hidden" name="hday" value="<?=$row_a4_opt[hday]?>" title="주휴일" />
	<input type="hidden" name="bonus1" value="<?=$bonus1?>" title="상여금1"/>
	<input type="hidden" name="bonus2" value="<?=$bonus2?>" title="상여금2"/>
	<input type="hidden" name="bonus3" value="<?=$bonus3?>" title="상여금3"/>
	<input type="hidden" name="bonus_standard" value=" <?=$bonus_standard?>" title="산정기준"/>
	<input type="hidden" name="bonus_percent" value=" <?=$bonus_percent?>%" title="상여비율"/>
	<input type="hidden" name="bonus_time" value="<?=$bonus_time?>" title="회"/>

	<input type="hidden" name="pay1" value="<?=number_format($row3[money_hour_ms])?>" />
	<input type="hidden" name="pay2" value="<?=number_format($row3[money_g1]+$row3[money_g2]+$row3[money_g3])?>" />    <!--과세수당-->
	<input type="hidden" name="pay3" value="<?=number_format($row3[money_b1]+$row3[money_b2]+$row3[money_b3])?>" />    <!--법정수당-->
	<input type="hidden" name="pay4" value="<?=number_format($row3[money_e1]+$row3[money_e2]+$row3[money_e3]+$row3[money_e4]+$row3[money_e5]+$row3[money_e6]+$row3[money_e7]+$row3[money_e8])?>" />    <!--기타수당-->
	<input type="hidden" name="pay5" value="<?=number_format($row3[money_month_base])?>" />    <!--지급총액(급여지급총액+별정수당총액)-->
	<input type="hidden" name="pay_day" value="<?=$row_a4_opt[pay_day]?>" /> <!--급여지금일-->
	<input type="hidden" name="jikjong" value="<?=$row2[jikjong]?> " /><!--직종-->
<?
} else if($labor == "pay_table") {
	$sql_pay = " select * from pibohum_base_pay where com_code='$code' and sabun='$id' and year = '$search_year' and month = '$search_month' ";
	//echo $sql_pay;
	$result_pay = sql_query($sql_pay);
	$row_pay=mysql_fetch_array($result_pay);
	//통상임금
	$sql_g = " select * from com_paycode_list where com_code = '$code' and item='trade' ";
	//echo $sql_g;
	$result_g = sql_query($sql_g);
	for($i=0; $row_g=sql_fetch_array($result_g); $i++) {
		$g_code = $row_g[code];
		$money_g_txt[$g_code] = $row_g[name];
		//echo $g_code;
	}
	//기타수당
	$sql_e = " select * from com_paycode_list where com_code = '$code' and item='privilege' ";
	$result_e = sql_query($sql_e);
	for($i=0; $row_e=sql_fetch_array($result_e); $i++) {
		$e_code = $row_e[code];
		$money_e_txt[$e_code] = $row_e[name];
	}
?>
									<!-- 급여명세서 -->
									<input type="hidden" name="company" value="<?=$row_a4[com_name]?>"/>
									<input type="hidden" name="pay_year" value="<?=$search_year?>"/>
									<input type="hidden" name="pay_month" value="<?=$search_month?>"/>
									<input type="hidden" name="pay_name" value="<?=$row1[name]?>"/>
									<input type="hidden" name="jik" value="<?=$row_position[name]?>"/>
									<input type="hidden" name="jdate" value="<?=$in_day?>"/>

									<input type="hidden" name="money_time" value="<?=number_format($row_pay[money_time])?>" title="통상시급" />
									<input type="hidden" name="basic_pay" value="<?=number_format($row_pay[money_month])?>" title="기본급여" />
									<input type="hidden" name="money_total" value="<?=number_format($row_pay[money_total])?>" title="급여총액" />
									<input type="hidden" name="rtotal" value="<?=number_format($row_pay[money_result])?>" title="지급총액" />

									<input type="hidden" name="yun" value="<?=number_format($row_pay[yun])?>"/>
									<input type="hidden" name="goyong" value="<?=number_format($row_pay[goyong])?>"/>
									<input type="hidden" name="health" value="<?=number_format($row_pay[health])?>"/>
									<input type="hidden" name="hi2" value="<?=number_format($row_pay[yoyang])?>"/>
									<input type="hidden" name="tax_so" value="<?=number_format($row_pay[tax_so])?>"/>
									<input type="hidden" name="tax_jumin" value="<?=number_format($row_pay[tax_jumin])?>"/>

									<input type="hidden" name="minus1_text" value="근태공제"/>
									<input type="hidden" name="minus2_text" value="가불"/>
									<input type="hidden" name="minus3_text" value="-"/>
									<input type="hidden" name="minus4_text" value="-"/>
									<input type="hidden" name="minus5_text" value="-"/>
									<input type="hidden" name="minus6_text" value="-"/>
									<input type="hidden" name="minus1" value="0"/>
									<input type="hidden" name="minus2" value="0"/>
									<input type="hidden" name="minus3" value="-"/>
									<input type="hidden" name="minus4" value="-"/>
									<input type="hidden" name="minus5" value="-"/>
									<input type="hidden" name="minus6" value="-"/>
									<input type="hidden" name="minus" value="<?=number_format($row_pay[money_gongje])?>" title="공제합계" />

									<input type="hidden" name="g1_text" value="<?=$money_g_txt['g1']?>"/>
									<input type="hidden" name="g2_text" value="<?=$money_g_txt['g2']?>"/>
									<input type="hidden" name="g3_text" value="<?=$money_g_txt['g3']?>"/>
									<input type="hidden" name="g4_text" value="<?=$money_g_txt['g4']?>"/>
									<input type="hidden" name="g5_text" value="<?=$money_g_txt['g5']?>"/>
									<input type="hidden" name="g6_text" value="-"/>
									<input type="hidden" name="g7_text" value="-"/>

									<input type="hidden" name="g1" value="<?=number_format($row_pay[g1])?>"/>
									<input type="hidden" name="g2" value="<?=number_format($row_pay[g2])?>"/>
									<input type="hidden" name="g3" value="<?=number_format($row_pay[g3])?>"/>
									<input type="hidden" name="g4" value="<?=number_format($row_pay[g4])?>"/>
									<input type="hidden" name="g5" value="<?=number_format($row_pay[g5])?>"/>
									<input type="hidden" name="g6" value="-"/>
									<input type="hidden" name="g7" value="-"/>
									<input type="hidden" name="g_sum" value="<?=number_format($row_pay[g1]+$row_pay[g2]+$row_pay[g3]+$row_pay[g4]+$row_pay[g5])?>"/>

									<input type="hidden" name="b1" value="<?=number_format($row_pay[ext])?>"/>
									<input type="hidden" name="b2" value="<?=number_format($row_pay[night])?>"/>
									<input type="hidden" name="b3" value="<?=number_format($row_pay[hday])?>"/>
									<input type="hidden" name="b4" value="<?=number_format($row_pay[ext_add])?>"/>
									<input type="hidden" name="b5" value="<?=number_format($row_pay[night_add])?>"/>
									<input type="hidden" name="b6" value="<?=number_format($row_pay[hday_add])?>"/>
									<input type="hidden" name="b7" value="<?=number_format($row_pay[annual_paid_holiday])?>"/>
									<input type="hidden" name="b_sum" value="<?=number_format($row_pay[ext]+$row_pay[night]+$row_pay[hday]+$row_pay[ext_add]+$row_pay[night_add]+$row_pay[hday_add]+$row_pay[annual_paid_holiday])?>"/>

									<input type="hidden" name="e1_text" value="<?=$money_e_txt['e1']?>"/>
									<input type="hidden" name="e2_text" value="<?=$money_e_txt['e2']?>"/>
									<input type="hidden" name="e3_text" value="<?=$money_e_txt['e3']?>"/>
									<input type="hidden" name="e4_text" value="<?=$money_e_txt['e4']?>"/>
									<input type="hidden" name="e5_text" value="<?=$money_e_txt['e5']?>"/>
									<input type="hidden" name="e6_text" value="<?=$money_e_txt['e6']?>"/>
									<input type="hidden" name="e7_text" value="<?=$money_e_txt['e7']?>"/>
									<input type="hidden" name="e8_text" value="<?=$money_e_txt['e8']?>"/>
									<input type="hidden" name="e9_text" value="-"/>
									<input type="hidden" name="e10_text" value="-"/>
									<input type="hidden" name="e11_text" value="-"/>
									<input type="hidden" name="e1" value="<?=number_format($row_pay[b1])?>"/>
									<input type="hidden" name="e2" value="<?=number_format($row_pay[b2])?>"/>
									<input type="hidden" name="e3" value="<?=number_format($row_pay[b3])?>"/>
									<input type="hidden" name="e4" value="<?=number_format($row_pay[b4])?>"/>
									<input type="hidden" name="e5" value="<?=number_format($row_pay[b5])?>"/>
									<input type="hidden" name="e6" value="<?=number_format($row_pay[b6])?>"/>
									<input type="hidden" name="e7" value="<?=number_format($row_pay[b7])?>"/>
									<input type="hidden" name="e8" value="<?=number_format($row_pay[b8])?>"/>
									<input type="hidden" name="e9" value="-"/>
									<input type="hidden" name="e10" value="-"/>
									<input type="hidden" name="e11" value="-"/>
									<input type="hidden" name="e_sum" value="<?=number_format($row_pay[b1]+$row_pay[b2]+$row_pay[b3]+$row_pay[b4]+$row_pay[b5]+$row_pay[b6]+$row_pay[b7]+$row_pay[b8])?>"/>

<?
} else if($labor == "rule1") {
	//$rule1_ok = 1;
	$rule1_ok = $row_a4[fee_amt];
	//echo $rule1_ok
	if($is_admin != "super") {
		if($rule1_ok == "0") alert("취업규칙 출력은 관리자 승인이 있어야 합니다.\\n고객센터 1544-4519 연락 바랍니다.","form_labor.php");
	}
	//임금계산기간
	$pay_calculate_day_period = $row_a4_opt[pay_calculate_day1]." ".$row_a4_opt[pay_calculate_day_period1]."일부터 ".$row_a4_opt[pay_calculate_day2]." ".$row_a4_opt[pay_calculate_day_period2]."일까지로 하며, ".$row_a4_opt[pay_calculate_day3]." ".$row_a4_opt[pay_calculate_day_period3]."일";
	//근무시간 휴게시간
	if($row_a4_opt[rest1] == "") $rest1 = "없음";
	else $rest1 = $row_a4_opt[rest1]."~".$row_a4_opt[rest1e];
	if($row_a4_opt[rest2] == "") $rest2 = "없음";
	else $rest2 = $row_a4_opt[rest2]."~".$row_a4_opt[rest2e];
	if($row_a4_opt[rest3] == "") $rest3 = "없음";
	else $rest3 = $row_a4_opt[rest3]."~".$row_a4_opt[rest3e];
	//명절
	for($i=1;$i<4;$i++) {
		$fday .= $row_a4_opt["fday".$i];
		if($row_a4_opt["fday".$i]) {
			$fday .= ". ";
		}
	}
	//유급휴일
	for($i=1;$i<13;$i++) {
		//echo $row_a4_opt["hday".$i];
		$new_hday .= $row_a4_opt["hday".$i];
		if($row_a4_opt["hday".$i]) {
			$new_hday .= ". ";
		}
		//echo $new_hday;
	}
	//무급휴일
	for($i=1;$i<7;$i++) {
		$new_holiday .= $row_a4_opt["holiday".$i];
		if($row_a4_opt["holiday".$i]) {
			$new_holiday .= ". ";
		}
	}
	//경조사(유급)
	for($i=1;$i<13;$i++) {
		$affair .= $row_a4_opt["affair".$i];
		if($row_a4_opt["affair".$i]) {
			$affair .= ". ";
		}
	}
	//유급휴가
	for($i=1;$i<13;$i++) {
		$new_vacation .= $row_a4_opt["vacation".$i];
		if($row_a4_opt["vacation".$i]) {
			$new_vacation .= ". ";
		}
	}
	//무급휴가
	for($i=1;$i<7;$i++) {
		$new_celebrate_mourn .= $row_a4_opt["celebrate_mourn".$i];
		if($row_a4_opt["celebrate_mourn".$i]) {
			$new_celebrate_mourn .= ". ";
		}
	}
	//정기상여금
	if($row_a4_opt[bonus]) $bonus = $row_a4_opt[bonus];
	else $bonus = "정기상여금 없음.";
?>
	<!--취업규칙-->
	<input type="hidden" name="head" value="<?=$row_a4[com_name]?>" title="머리말" />
	<input type="hidden" name="persons" value="<?=$row_a4_opt[persons]?>" title="명" />
	<input type="hidden" name="man" value="<?=$row_a4_opt[man]?>" title="남" />
	<input type="hidden" name="woman" value="<?=$row_a4_opt[woman]?>" title="여" />
	<input type="hidden" name="stime" value="<?=$row_a4_opt[stime]?>" title="시업시간" />
	<input type="hidden" name="etime" value="<?=$row_a4_opt[etime]?>" title="종업시간" />
	<input type="hidden" name="rest1" value="<?=$rest1?>" title="휴게시간1" />
	<input type="hidden" name="rest2" value="<?=$rest2?>" title="휴게시간2" />
	<input type="hidden" name="rest3" value="<?=$rest3?>" title="휴게시간3" />
	<input type="hidden" name="hday" value="<?=$row_a4_opt[hday]?>" title="주휴일" />
	<input type="hidden" name="fday" value="- <?=$fday?>" title="명절" />
	<input type="hidden" name="new_hday" value="- <?=$new_hday?>" title="유급휴일" />
	<input type="hidden" name="new_holiday" value="- <?=$new_holiday?>" title="무급휴일" />
	<input type="hidden" name="affair" value="- <?=$affair?>" title="경조사(유급)" />
	<input type="hidden" name="new_vacation" value="- <?=$new_vacation?>" title="유급휴가" />
	<input type="hidden" name="new_celebrate_mourn" value="- <?=$new_celebrate_mourn?>" title="무급휴가" />
	<input type="hidden" name="hday1" value="- <?=$row_a4_opt[hday1]?>" title="휴일1" />
	<input type="hidden" name="hday2" value="- <?=$row_a4_opt[hday2]?>" title="휴일2" />
	<input type="hidden" name="hday3" value="- <?=$row_a4_opt[hday3]?>" title="휴일3" />
	<input type="hidden" name="hday4" value="- <?=$row_a4_opt[hday4]?>" title="휴일4" />
	<input type="hidden" name="hday5" value="- <?=$row_a4_opt[hday5]?>" title="휴일5" />
	<input type="hidden" name="hday6" value="- <?=$row_a4_opt[hday6]?>" title="휴일6" />
	<input type="hidden" name="hday7" value="- <?=$row_a4_opt[hday7]?>" title="휴일7" />
	<input type="hidden" name="hday8" value="- <?=$row_a4_opt[hday8]?>" title="휴일8" />
	<input type="hidden" name="holiday1" value="<?=$row_a4_opt[holiday1]?>" title="설날" />
	<input type="hidden" name="holiday2" value="<?=$row_a4_opt[holiday2]?>" title="추석" />
	<input type="hidden" name="holiday3" value="<?=$row_a4_opt[holiday3]?>" title="신정" />
	<input type="hidden" name="summer_vacation" value="<?=$row_a4_opt[summer_vacation]?>" title="하기휴가" />
	<input type="hidden" name="celebrate_mourn1" value="<?=$row_a4_opt[celebrate_mourn1]?>" title="경조휴가1" />
	<input type="hidden" name="celebrate_mourn2" value="<?=$row_a4_opt[celebrate_mourn2]?>" title="경조휴가2" />
	<input type="hidden" name="celebrate_mourn3" value="<?=$row_a4_opt[celebrate_mourn3]?>" title="경조휴가3" />
	<input type="hidden" name="celebrate_mourn4" value="<?=$row_a4_opt[celebrate_mourn4]?>" title="경조휴가4" />
	<input type="hidden" name="celebrate_mourn5" value="<?=$row_a4_opt[celebrate_mourn5]?>" title="경조휴가5" />
	<input type="hidden" name="celebrate_mourn6" value="<?=$row_a4_opt[celebrate_mourn6]?>" title="경조휴가6" />
	<input type="hidden" name="celebrate_mourn7" value="<?=$row_a4_opt[celebrate_mourn7]?>" title="경조휴가7" />
	<input type="hidden" name="celebrate_mourn8" value="<?=$row_a4_opt[celebrate_mourn8]?>" title="경조휴가8" />
	<input type="hidden" name="celebrate_mourn9" value="<?=$row_a4_opt[celebrate_mourn9]?>" title="경조휴가9" />
	<input type="hidden" name="celebrate_mourn10" value="<?=$row_a4_opt[celebrate_mourn10]?>" title="경조휴가10" />
	<input type="hidden" name="celebrate_mourn11" value="<?=$row_a4_opt[celebrate_mourn11]?>" title="경조휴가11" />
	<input type="hidden" name="celebrate_mourn12" value="<?=$row_a4_opt[celebrate_mourn12]?>" title="경조휴가12" />
	<input type="hidden" name="celebrate_mourn13" value="<?=$row_a4_opt[celebrate_mourn13]?>" title="경조휴가13" />
	<input type="hidden" name="celebrate_mourn14" value="<?=$row_a4_opt[celebrate_mourn14]?>" title="경조휴가14" />
	<input type="hidden" name="pay_calculate_day_period" value="<?=$pay_calculate_day_period?>" title="임금계산기간" />
	<input type="hidden" name="retirement_age_rule" value="<?=$row_a4_opt[retirement_age_rule]?>" title="정년" />
	<input type="hidden" name="bonus" value="<?=$bonus?>" title="정기상여금" />
<?
} else if($labor == "career_describe") {
	$age_year = "19".substr($row1[jumin_no],0,2);
	$age = date("Y") - $age_year;
	if(substr($row1[jumin_no],7,1) == 1) $sex = "남";
	else if(substr($row1[jumin_no],7,1) == 2) $sex = "여";
	$birth_day = "19".substr($row1[jumin_no],0,2).".".substr($row1[jumin_no],2,2).".".substr($row1[jumin_no],4,2);
	//경력일
	if($row2[career_sdate]) $career_date1 = $row2[career_sdate]."~".$row2[career_edate];
	if($row2[career_sdate2]) $career_date2 = $row2[career_sdate2]."~".$row2[career_edate2];
	if($row2[career_sdate3]) $career_date3 = $row2[career_sdate3]."~".$row2[career_edate3];
?>
	<!--경력기술서-->
	<input type="hidden" name="name_k" value="<?=$row1[name]?>" />
	<input type="hidden" name="birth_day" value="<?=$birth_day?>" />
	<input type="hidden" name="addr" value="<?=$row1[w_juso]?> " />
	<input type="hidden" name="sex" value="<?=$sex?> " />
	<input type="hidden" name="age" value="<?=$age?> " />
	<input type="hidden" name="hak1" value="<?=$row2[school_name]?> " />
	<input type="hidden" name="hak2" value="<?=$row2[school_name2]?> " />
	<input type="hidden" name="hak3" value="<?=$row2[school_name3]?> " />
	<input type="hidden" name="graduate1" value="<?=$row2[school_edate]?> " />
	<input type="hidden" name="graduate2" value="<?=$row2[school_edate2]?> " />
	<input type="hidden" name="graduate3" value="<?=$row2[school_edate3]?> " />
	<input type="hidden" name="career_date1" value="<?=$career_date1?> " />
	<input type="hidden" name="career_date2" value="<?=$career_date2?> " />
	<input type="hidden" name="career_date3" value="<?=$career_date3?> " />
	<input type="hidden" name="career_space1" value="<?=$row2[career_name]?> " />
	<input type="hidden" name="career_space2" value="<?=$row2[career_name2]?> " />
	<input type="hidden" name="career_space3" value="<?=$row2[career_name3]?> " />
	<input type="hidden" name="career_jik1" value="<?=$row2[career_part]?> " />
	<input type="hidden" name="career_jik2" value="<?=$row2[career_part2]?> " />
	<input type="hidden" name="career_jik3" value="<?=$row2[career_part3]?> " />
<?//=$row2[emp_cel]?>
<?
} else if($labor == "labor15") {
	$employee_array = explode("_",$employee);
	$code  = $employee_array[0];
	$sabun = $employee_array[1];
	$sql1 = " select * from $g4[pibohum_base] where com_code='$code' and sabun='$sabun' ";
	$result1 = sql_query($sql1);
	$row1 = mysql_fetch_array($result1);
	//입사일
	if($row1[in_day] == "") {
		//데이터 없을 시 공백 처리
		$in_day = " ";
	} else {
		$in_day_array = explode(".",$row1[in_day]);
		$in_day = $in_day_array[0]."년 ".$in_day_array[1]."월 ".$in_day_array[2]."일";
	}
	//퇴직일
	//echo "a".$row1[out_day]."b";
	if($row1[out_day] == "") {
		$out_day = " 년 월 일";
	} else {
		$out_day_array = explode(".",$row1[out_day]);
		$out_day = $out_day_array[0]."년 ".$out_day_array[1]."월 ".$out_day_array[2]."일";
	}
?>
	<!--경력증명서-->
	<input type="hidden" name="name_k" value="<?=$row1[name]?>" />
	<input type="hidden" name="jumin" value="<?=$row1[jumin_no]?>" />
	<input type="hidden" name="addr" value="<?=$row1[w_juso]?> " />
	<input type="hidden" name="jik" value="<?=$row_position[name]?>"/>
	<input type="hidden" name="jdate" value="<?=$in_day?>" title="입사일" />
	<input type="hidden" name="edate" value="<?=$out_day?>" title="퇴직일" />
<?
} else if($labor == "public_document") {
?>
	<!--공문(결제란포함)-->
	<!--공통변수 이용-->
<?
} else if($labor == "advice_resign") {
?>
	<!--권고사직서-->
	<input type="hidden" name="name_k" value="<?=$row1[name]?>" />
	<input type="hidden" name="jumin" value="<?=$row1[jumin_no]?>" />
	<input type="hidden" name="jik" value="<?=$row_position[name]?>"/>
<?
} else if($labor == "minor_consent") {
	$age_year = "19".substr($row1[jumin_no],0,2);
	$age = date("Y") - $age_year;
	$birth_day = "19".substr($row1[jumin_no],0,2).".".substr($row1[jumin_no],2,2).".".substr($row1[jumin_no],4,2);
?>
	<!--미성년자취업동의서-->
	<input type="hidden" name="name_k" value="<?=$row1[name]?>" />
	<input type="hidden" name="birth_day" value="<?=$birth_day?>" />
	<input type="hidden" name="addr" value="<?=$row1[w_juso]?> " />
	<input type="hidden" name="age" value="<?=$age?> " />
<?
} else if($labor == "resign") {
	$employee_array = explode("_",$employee);
	$code  = $employee_array[0];
	$sabun = $employee_array[1];
	$sql1 = " select * from $g4[pibohum_base] where com_code='$code' and sabun='$sabun' ";
	$result1 = sql_query($sql1);
	$row1 = mysql_fetch_array($result1);
	//입사일
	if($row1[in_day] == "") {
		//데이터 없을 시 공백 처리
		$in_day = " ";
	} else {
		$in_day_array = explode(".",$row1[in_day]);
		$in_day = $in_day_array[0]."년 ".$in_day_array[1]."월 ".$in_day_array[2]."일";
	}
	//퇴직일
	//echo "a".$row1[out_day]."b";
	if($row1[out_day] == "") {
		$out_day = " 년 월 일";
	} else {
		$out_day_array = explode(".",$row1[out_day]);
		$out_day = $out_day_array[0]."년 ".$out_day_array[1]."월 ".$out_day_array[2]."일";
	}
	//퇴직구분(사유)
	$sql_nomu = " select * from pibohum_base_nomu where com_code='$code' and sabun='$sabun' and quit_cause<>'0' ";
	//echo $sql_nomu;
	$result_nomu = sql_query($sql_nomu);
	$row_nomu = mysql_fetch_array($result_nomu);
	//echo $row_nomu[idx];
	//퇴직구분 배열
	$quit_cause_text[11] = "전직,자영업";
	$quit_cause_text[12] = "결혼,출산,거주지변경";
	$quit_cause_text[13] = "질병,부상,노령";
	$quit_cause_text[14] = "징계해고";
	$quit_cause_text[15] = "기타 개인사정";
	$quit_cause_text[22] = "폐업,도산,공사중단";
	$quit_cause_text[23] = "경영상 해고";
	$quit_cause_text[24] = "휴업,임금체불,회사이전";
	$quit_cause_text[25] = "기타 회사사정";
	$quit_cause_text[31] = "정년";
	$quit_cause_text[32] = "계약기간 만료";
	$quit_cause_text[33] = "공사종료";
	$quit_cause_text[41] = "고용보험 비적용";
	$quit_cause_text[42] = "이중고용";
	$quit_cause_text[98] = "소명사업장 일괄종료";
	$quit_cause_text[99] = "전근에 의한 퇴직";
	$retire_cause = $row_nomu[quit_cause];
	//echo $retire_cause;
	if($quit_cause_text[$retire_cause]) {
		$retire_cause = $quit_cause_text[$retire_cause];
	} else {
		$retire_cause = " ";
	}
?>
	<!--사직서-->
	<input type="hidden" name="name_k" value="<?=$row1[name]?>" />
	<input type="hidden" name="resign_cause" value="<?=$retire_cause?>" />
	<input type="hidden" name="jik" value="<?=$row_position[name]?> "/>
	<input type="hidden" name="jdate" value="<?=$in_day?>" title="입사일" />
	<input type="hidden" name="edate" value="<?=$out_day?>" title="퇴직일" />
<?
} else if($labor == "identity") {
	$birth_day = "19".substr($row1[jumin_no],0,2).".".substr($row1[jumin_no],2,2).".".substr($row1[jumin_no],4,2);
?>
	<!--신원보증서-->
	<input type="hidden" name="name_k" value="<?=$row1[name]?>" />
	<input type="hidden" name="addr" value="<?=$row1[w_juso]?> " />
	<input type="hidden" name="birth_day" value="<?=$birth_day?>" />
	<input type="hidden" name="jumin" value="<?=$row1[jumin_no]?>" />
<?
//인사발령장
} else if($labor == "personnel_appointment") {
?>
	<input type="hidden" name="name_k" value="<?=$row1[name]?>"/>
<?
//재직(퇴직)증명서
} else if($labor == "hold_retirement_certificate") {
?>
	<input type="hidden" name="addr" value="<?=$row1[w_juso]?>"/>
	<input type="hidden" name="name_k" value="<?=$row1[name]?>"/>
	<input type="hidden" name="jumin" value="<?=$row1[jumin_no]?>"/>
	<input type="hidden" name="jik" value="<?=$row_position[name]?> "/>
	<input type="hidden" name="sdate" value="<?=$row1[in_day]?>"/>
	<input type="hidden" name="edate" value="<?=$row1[out_day]?>"/>
<?
//출장품의서
} else if($labor == "business_trip_report") {
?>
	<input type="hidden" name="name_k" value="<?=$row1[name]?>"/>
<?
//근로자명부(재직자)
} else if($labor == "worker_register_holder") {
	//성명, 입사일자
	$sql_base = " select * from pibohum_base where com_code='$com_code' and out_day = '' ";
	$result_base = sql_query($sql_base);
	for ($i=0; $row_base=sql_fetch_array($result_base); $i++) {
		//사원DB 옵션
		$sql_opt = " select * from pibohum_base_opt where com_code='$com_code' and sabun = '$row_base[sabun]' ";
		//echo $sql_opt;
		$result_opt = sql_query($sql_opt);
		$row_opt = mysql_fetch_array($result_opt);
		//직위
		$sql_position = " select * from com_code_list where com_code='$com_code' and code='$row_opt[position]' and item='position' ";
		//echo $sql_position;
		$result_position = sql_query($sql_position);
		$row_position=mysql_fetch_array($result_position);
		if($row_position[name]) $position = $row_position[name];
		else $position = " ";
		//호봉
		$sql_step = " select * from com_code_list where com_code='$com_code' and code='$row_opt[step]' and item='step' ";
		//echo $sql_step;
		$result_step = sql_query($sql_step);
		$row_step=mysql_fetch_array($result_step);
		if($row_step[rate]) $step = $row_step[rate];
		else $step = " ";
?>
	<input type="hidden" name="jik" value="<?=$position?>"/>
	<input type="hidden" name="name_k" value="<?=$row_base[name]?>"/>
	<input type="hidden" name="jumin" value="<?=$row_base[jumin_no]?>"/>
	<input type="hidden" name="license_name" value="<?=$row_opt[license_name]?>"/>
	<input type="hidden" name="license_step" value="<?=$row_opt[license_step]?>"/>
	<input type="hidden" name="addr" value="<?=$row_base[w_juso]?> <?=$row_opt[w_juso2]?>"/>
	<input type="hidden" name="in_day" value="<?=$row_base[in_day]?>"/>
	<input type="hidden" name="step" value="<?=$step?>"/>
	<input type="hidden" name="tel" value="<?=$row_base[add_tel]?>"/>
	<input type="hidden" name="hp" value="<?=$row_opt[emp_cel]?>"/>
<?
	}
//근로자명부(퇴직자)
} else if($labor == "worker_register_retiree") {
	//성명, 입사일자
	$sql_base = " select * from pibohum_base where com_code='$com_code' and out_day != '' ";
	$result_base = sql_query($sql_base);
	for ($i=0; $row_base=sql_fetch_array($result_base); $i++) {
		//사원DB 옵션
		$sql_opt = " select * from pibohum_base_opt where com_code='$com_code' and sabun = '$row_base[sabun]' ";
		//echo $sql_opt;
		$result_opt = sql_query($sql_opt);
		$row_opt = mysql_fetch_array($result_opt);
		//직위
		$sql_position = " select * from com_code_list where com_code='$com_code' and code='$row_opt[position]' and item='position' ";
		//echo $sql_position;
		$result_position = sql_query($sql_position);
		$row_position=mysql_fetch_array($result_position);
		if($row_position[name]) $position = $row_position[name];
		else $position = " ";
		//호봉
		$sql_step = " select * from com_code_list where com_code='$com_code' and code='$row_opt[step]' and item='step' ";
		//echo $sql_step;
		$result_step = sql_query($sql_step);
		$row_step=mysql_fetch_array($result_step);
		if($row_step[rate]) $step = $row_step[rate];
		else $step = " ";
		//퇴직구분(사유)
		$sql_nomu = " select * from pibohum_base_nomu where com_code='$com_code' and sabun='$row_base[sabun]' and quit_cause<>'0' ";
		//echo $sql_nomu;
		$result_nomu = sql_query($sql_nomu);
		$row_nomu = mysql_fetch_array($result_nomu);
		//echo $row_nomu[idx];
		//퇴직구분
		$quit_cause_text[11] = "전직,자영업";
		$quit_cause_text[12] = "결혼,출산,거주지변경";
		$quit_cause_text[13] = "질병,부상,노령";
		$quit_cause_text[14] = "징계해고";
		$quit_cause_text[15] = "기타 개인사정";
		$quit_cause_text[22] = "폐업,도산,공사중단";
		$quit_cause_text[23] = "경영상 해고";
		$quit_cause_text[24] = "휴업,임금체불,회사이전";
		$quit_cause_text[25] = "기타 회사사정";
		$quit_cause_text[31] = "정년";
		$quit_cause_text[32] = "계약기간 만료";
		$quit_cause_text[33] = "공사종료";
		$quit_cause_text[41] = "고용보험 비적용";
		$quit_cause_text[42] = "이중고용";
		$quit_cause_text[98] = "소명사업장 일괄종료";
		$quit_cause_text[99] = "전근에 의한 퇴직";
		$retire_cause = $row_nomu[quit_cause];
		//echo $retire_cause;
		$retire_cause = $quit_cause_text[$retire_cause];
?>
	<input type="hidden" name="jik" value="<?=$position?>"/>
	<input type="hidden" name="name_k" value="<?=$row_base[name]?>"/>
	<input type="hidden" name="jumin" value="<?=$row_base[jumin_no]?>"/>
	<input type="hidden" name="license_name" value="<?=$row_opt[license_name]?>"/>
	<input type="hidden" name="license_step" value="<?=$row_opt[license_step]?>"/>
	<input type="hidden" name="addr" value="<?=$row_base[w_juso]?> <?=$row_opt[w_juso2]?>"/>
	<input type="hidden" name="in_day" value="<?=$row_base[in_day]?>"/>
	<input type="hidden" name="step" value="<?=$step?>"/>
	<input type="hidden" name="out_day" value="<?=$row_base[out_day]?>"/>
	<input type="hidden" name="retire_cause" value="<?=$retire_cause?>"/>
	<input type="hidden" name="tel" value="<?=$row_base[add_tel]?>"/>
	<input type="hidden" name="hp" value="<?=$row_opt[emp_cel]?>"/>
<?
	}
	//여분 출력 hwp control 셋팅
	$k_limit = 16 - $i;
	for($k=0;$k<$k_limit;$k++) {
?>
	<input type="hidden" name="jik" value=" "/>
	<input type="hidden" name="name_k" value=" "/>
	<input type="hidden" name="jumin" value=" "/>
	<input type="hidden" name="license_name" value=" "/>
	<input type="hidden" name="license_step" value=" "/>
	<input type="hidden" name="addr" value=" "/>
	<input type="hidden" name="in_day" value=" "/>
	<input type="hidden" name="step" value=" "/>
	<input type="hidden" name="out_day" value=" "/>
	<input type="hidden" name="retire_cause" value=" "/>
	<input type="hidden" name="tel" value=" "/>
	<input type="hidden" name="hp" value=" "/>
<?
	}
//야간휴일근로동의서
} else if($labor == "night_holiday_work_consent") {
	$employee_array = explode("_",$employee);
	$code  = $employee_array[0];
	$sabun = $employee_array[1];
	//사원DB 옵션
	$sql_opt = " select * from pibohum_base_opt where com_code='$code' and sabun = '$sabun' ";
	//echo $sql_opt;
	$result_opt = sql_query($sql_opt);
	$row_opt = mysql_fetch_array($result_opt);
	//직위
	$sql_position = " select * from com_code_list where com_code='$code' and code='$row_opt[position]' and item='position' ";
	//echo $sql_position;
	$result_position = sql_query($sql_position);
	$row_position=mysql_fetch_array($result_position);
	if($row_position[name]) $position = $row_position[name];
	else $position = " ";
?>
	<input type="hidden" name="dept" value="<?=$row_opt[dept_1]?>"/>
	<input type="hidden" name="jik" value="<?=$position?>"/>
	<input type="hidden" name="name_k" value="<?=$row1[name]?>"/>
	<input type="hidden" name="time" value="오후 10시부터 익일 오전 6시까지"/>
<?
//연장근로동의서
} else if($labor == "extend_work_consent") {
?>
	<input type="hidden" name="name_k" value="<?=$row1[name]?>"/>
<?
//인사기록카드(개정)
} else if($labor == "personnel_document_card") {
	$age_year = "19".substr($row1[jumin_no],0,2);
	$age = date("Y") - $age_year;
	if(substr($row1[jumin_no],7,1) == 1) $sex = "남";
	else if(substr($row1[jumin_no],7,1) == 2) $sex = "여";
	$birth_day = "19".substr($row1[jumin_no],0,2).".".substr($row1[jumin_no],2,2).".".substr($row1[jumin_no],4,2);
?>
	<input type="hidden" name="jumin" value="<?=$row1[jumin_no]?>"/>
	<input type="hidden" name="name_k" value="<?=$row1[name]?>"/>
	<input type="hidden" name="sex" value="<?=$sex?> " />
	<input type="hidden" name="birth_day" value="<?=$birth_day?>" />
	<input type="hidden" name="addr" value="<?=$row1[w_juso]?> <?=$row_opt[w_juso2]?>"/>
<?
//대체휴가합의서
} else if($labor == "change_vacation_agree") {
?>
	<input type="hidden" name="name_k" value="<?=$row1[name]?>"/>
	<input type="hidden" name="jumin" value="<?=$row1[jumin_no]?>"/>
	<input type="hidden" name="addr" value="<?=$row1[w_juso]?> <?=$row_opt[w_juso2]?>"/>
<?
//시말서
} else if($labor == "written_apology") {
	$employee_array = explode("_",$employee);
	$code  = $employee_array[0];
	$sabun = $employee_array[1];
	//사원DB 옵션
	$sql_opt = " select * from pibohum_base_opt where com_code='$code' and sabun = '$sabun' ";
	$result_opt = sql_query($sql_opt);
	$row_opt = mysql_fetch_array($result_opt);
	//직위
	$sql_position = " select * from com_code_list where com_code='$code' and code='$row_opt[position]' and item='position' ";
	$result_position = sql_query($sql_position);
	$row_position=mysql_fetch_array($result_position);
	if($row_position[name]) $position = $row_position[name];
	else $position = " ";
?>
	<input type="hidden" name="dept" value="<?=$row_opt[dept_1]?>"/>
	<input type="hidden" name="jik" value="<?=$position?>"/>
	<input type="hidden" name="name_k" value="<?=$row1[name]?>"/>
<?
//연차관리대장
} else if($labor == "annual_paid_holiday") {
	//연차 개인별 리스트
	$sql_annual = " select * from pibohum_base_nomu where com_code = '$com_code' and annual_paid_holiday_day != '' group by com_code, sabun  ";
	//echo $sql_annual;
	$result_annual = sql_query($sql_annual);
	// 리스트 출력
	for ($i=0; $row_annual=sql_fetch_array($result_annual); $i++) {
		//사원DB 옵션
		$sql_opt = " select * from pibohum_base_opt where com_code='$com_code' and sabun = '$row_annual[sabun]' ";
		//echo $sql_opt;
		$result_opt = sql_query($sql_opt);
		$row_opt = mysql_fetch_array($result_opt);
		//직위
		$sql_position = " select * from com_code_list where com_code='$com_code' and code='$row_opt[position]' and item='position' ";
		$result_position = sql_query($sql_position);
		$row_position=mysql_fetch_array($result_position);
		if($row_position[name]) $position = $row_position[name];
		else $position = " ";
		//성명, 입사일자
		$sql_base = " select * from pibohum_base where com_code='$com_code' and sabun = '$row_annual[sabun]' ";
		$result_base = sql_query($sql_base);
		$row_base = mysql_fetch_array($result_base);
		//사원DB 옵션2
		$sql_opt2 = " select * from pibohum_base_opt2 where com_code='$com_code' and sabun = '$row_annual[sabun]' ";
		$result_opt2 = sql_query($sql_opt2);
		$row_opt2 = mysql_fetch_array($result_opt2);
		//연차사용일수
		$sql_annual_cnt = " select count(*) as cnt from pibohum_base_nomu where com_code = '$com_code' and sabun = '$row_annual[sabun]' and annual_paid_holiday_day != '' ";
		//echo $sql_annual_cnt;
		$result_annual_cnt = sql_query($sql_annual_cnt);
		$row_annual_cnt = mysql_fetch_array($result_annual_cnt);
?>
	<!--연차관리대장-->
	<input type="hidden" name="jik" value="<?=$position?>"/>
	<input type="hidden" name="name_k" value="<?=$row_base[name]?>" />
	<input type="hidden" name="in_day" value="<?=$row_base[in_day]?>" title="입사일자" />
	<input type="hidden" name="annual_sum" value="<?=$row_opt2[annual_paid_holiday]?>" title="발생일수" />
	<input type="hidden" name="annual_use" value="<?=$row_annual_cnt[cnt]?>" title="사용일수" />
	<input type="hidden" name="annual_rest" value="<?=($row_opt2[annual_paid_holiday]-$row_annual_cnt[cnt])?>" title="잔여일수" />
<?
	}
	//여분 출력 hwp control 셋팅
	$k_limit = 30 - $i;
	for($k=0;$k<$k_limit;$k++) {
?>
	<input type="hidden" name="jik" value=" "/>
	<input type="hidden" name="name_k" value=" " />
	<input type="hidden" name="in_day" value=" " title="입사일자" />
	<input type="hidden" name="annual_sum" value=" " title="발생일수" />
	<input type="hidden" name="annual_use" value=" " title="사용일수" />
	<input type="hidden" name="annual_rest" value=" " title="잔여일수" />
<?
	}
//지각,조퇴,결근 사유서
} else if($labor == "attendance_reason") {
?>
	<input type="hidden" name="name_k" value="<?=$row1[name]?>"/>
<?
//휴가신청서(회사)
} else if($labor == "vacation") {
	if($row1[emp_cel]) {
		$tel = $row1[emp_cel];
	} else {
		$tel = $row1[add_tel];
	}
	//퇴직/휴가/휴직 DB
	$sql_nomu = " select * from pibohum_base_nomu where idx='$idx' ";
	$result_nomu = sql_query($sql_nomu);
	$row_nomu = mysql_fetch_array($result_nomu);
	//휴가구분
	$cause = $row_nomu[vacation_cause];
	//휴가사유
	$reason = $row_nomu[vacation_reason];
?>
	<!--휴가신청서(회사)-->
	<input type="hidden" name="jik" value="<?=$row_position[name]?> "/>
	<input type="hidden" name="tel" value="<?=$tel?> " />
	<input type="hidden" name="name_k" value="<?=$row1[name]?>" />
	<input type="hidden" name="cause" value="<?=$cause?>" title="휴가구분" />
	<input type="hidden" name="vdate" value="<?=$out_day?>" title="기간" />
	<input type="hidden" name="space" value="<?=$space?> " />
	<input type="hidden" name="reason" value="<?=$reason?>" />
<?
//노동부 자율점검서식
//상여금지급대장
} else if($labor == "bonus_pay_ledger") {
	$bonus_array = explode(",",$row_a4_opt[bonus_time]);
	$bonus_time1 = $bonus_array[0];
	$bonus_time2 = $bonus_array[1];
	$bonus_time3 = $bonus_array[2];
	$bonus_time4 = $bonus_array[3];
	$bonus_time5 = $bonus_array[4];
	$bonus_time6 = $bonus_array[5];
?>
<input type="hidden" name="bonus_time1" value="<?=$bonus_time1?>" />
<input type="hidden" name="bonus_time2" value="<?=$bonus_time2?>" />
<input type="hidden" name="bonus_time3" value="<?=$bonus_time3?>" />
<input type="hidden" name="bonus_time4" value="<?=$bonus_time4?>" />
<input type="hidden" name="bonus_time5" value="<?=$bonus_time5?>" />
<input type="hidden" name="bonus_time6" value="<?=$bonus_time6?>" />
<script type="text/javascript">
function setRowInsert() {
<?
	$sql_common = " from pibohum_base_bonus ";
	if($is_admin == "super") {
		$sql_search = " where 1=1 ";
		$sst = "com_code";
	} else {
		$sql_search = " where com_code='$com_code' ";
		$sst = "idx";
	}
	$sod = "desc";
	$sql_order = " order by $sst $sod ";
	$sql = " select count(*) as cnt
					 $sql_common
					 $sql_search
					 $sql_order ";
	$row = sql_fetch($sql);
	$total_count = $row[cnt];
	$rows = 15;
	$total_page  = ceil($total_count / $rows);
	if (!$page) $page = 1;
	$from_record = ($page - 1) * $rows;
	$sql = " select *
						$sql_common
						$sql_search
						$sql_order
						limit $from_record, $rows ";
	$result = sql_query($sql);
	for ($i=0; $row=sql_fetch_array($result); $i++) {
		$no = $total_count - $i - ($rows*($page-1));
		//사업장 코드 / 사번 / 코드_사번
		$code = $row[com_code];
		$id = $row[sabun];
		//사원DB
		$sql_base = " select * from pibohum_base where com_code='$code' and sabun='$id' ";
		$result_base = sql_query($sql_base);
		$row_base = mysql_fetch_array($result_base);
		$name = cut_str($row_base[name], 6, "..");
		//사원DB 옵션
		$sql_opt = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
		$result_opt = sql_query($sql_opt);
		$row_opt = mysql_fetch_array($result_opt);
		$dept = $row_opt[dept_1];
		//사원DB 옵션
		$sql_opt2 = " select * from pibohum_base_opt2 where com_code='$code' and sabun='$id' ";
		//echo "alert(\"$sql_opt2\");";
		$result_opt2 = sql_query($sql_opt2);
		$row_opt2 = mysql_fetch_array($result_opt2);
		$money_hour_ms_int = $row_opt2[money_hour_ms];
		$money_hour_ms = number_format($money_hour_ms_int);
		$money_g_sum_int = ( $row_opt2[money_g1] + $row_opt2[money_g2] + $row_opt2[money_g3] + $row_opt2[money_g4] + $row_opt2[money_g5] );
		$money_g_sum = number_format($money_g_sum_int);
		$money_sum = number_format($money_hour_ms_int+$money_g_sum_int);
		//상여비율
		$bonus_percent = $row_opt2[bonus_percent]."%";
		//상여비율(지급시기별)
		$bonus_p = explode(",",$row_opt2[bonus_p]);
		for($k=0;$k<6;$k++) {
			if($bonus_p[$k]) $bonus_p[$k] .= "%";
		}
?>
	TableAppendRowContents("tbl_s", new Array("<?=$no?>","<?=$name?>","<?=$dept?>","<?=$money_hour_ms?>","<?=$money_g_sum?>","<?=$money_sum?>","<?=$bonus_percent?>","<?=$bonus_p[0]?>","<?=$bonus_p[1]?>","<?=$bonus_p[2]?>","<?=$bonus_p[3]?>","<?=$bonus_p[4]?>","<?=$bonus_p[5]?>"));
<?
	}
?>
	pHwpCtrl.MoveToField("tbl_s", false, false, false);
	pHwpCtrl.Run("TableDeleteRow");
	pHwpCtrl.MovePos(20);
}
</script>
<?
//퇴직금지급대장
} else if($labor == "retirement_pay_ledger") {
?>
<script type="text/javascript">
function setRowInsert() {
<?
	$sql_common = " from pibohum_base_nomu ";
	if($is_admin == "super") {
		$sql_search = " where 1=1 ";
		$sst = "com_code";
	} else {
		$sql_search = " where com_code='$com_code' and quit_cause<>'0' ";
		$sst = "idx";
	}
	$sod = "desc";
	$sql_order = " order by $sst $sod ";
	$sql = " select count(*) as cnt
					 $sql_common
					 $sql_search
					 $sql_order ";
	$row = sql_fetch($sql);
	$total_count = $row[cnt];
	$rows = 15;
	$total_page  = ceil($total_count / $rows);
	if (!$page) $page = 1;
	$from_record = ($page - 1) * $rows;
	$sql = " select *
						$sql_common
						$sql_search
						$sql_order
						limit $from_record, $rows ";
	$result = sql_query($sql);
	for ($i=0; $row=sql_fetch_array($result); $i++) {
		$no = $total_count - $i - ($rows*($page-1));
		//사업장 코드 / 사번 / 코드_사번
		$code = $row[com_code];
		$id = $row[sabun];
		//사원DB
		$sql_base = " select * from pibohum_base where com_code='$code' and sabun='$id' ";
		$result_base = sql_query($sql_base);
		$row_base = mysql_fetch_array($result_base);
		$name = cut_str($row_base[name], 6, "..");
		$jumin = $row_base[jumin_no];
		//사원DB 옵션
		$sql_opt = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
		$result_opt = sql_query($sql_opt);
		$row_opt = mysql_fetch_array($result_opt);
		$dept = $row_opt[dept_1];
		//사원DB 옵션
		$sql_opt2 = " select * from pibohum_base_opt2 where com_code='$code' and sabun='$id' ";
		$result_opt2 = sql_query($sql_opt2);
		$row_opt2 = mysql_fetch_array($result_opt2);
		$money_hour_ms_int = $row_opt2[money_hour_ms];
		$money_hour_ms = number_format($money_hour_ms_int);
		//주소
		$addr = $row_base[w_juso]." ".$row_opt[w_juso2];
		//근속기간
		function dateDiff($date1, $date2) { 
			$date1 = date_parse($date1); 
			$date2 = date_parse($date2); 
			return ((gmmktime(0, 0, 0, $date1['month'], $date1['day'], $date1['year']) - gmmktime(0, 0, 0, $date2['month'], $date2['day'], $date2['year']))/3600/24);
		}
		/*
		$frDate = str_replace(".","-",$row_base[in_day]);
		$toDate = str_replace(".","-",$row_base[out_day]);
		$datetime1 = date_create($frDate);
		$datetime2 = date_create($toDate);
		$date_diff = $datetime2 - $datetime1;
		//$interval = date_diff($datetime1, $datetime2);
		//$str =  $interval->format('%y년 %m개월 %d일');
		$long_service_date = dateDiff($frDate, $toDate);
		$long_service_date = date_format($date_diff, 'y년 m개월 d일');
		*/
		$frDate = str_replace(".","-",$row_base[in_day]);
		$toDate = str_replace(".","-",$row_base[out_day]);
		$stime = ($frDate == "")?date("Y-m-d"):$frDate;
		$etime = ($toDate == "")?date("Y-m-d"):$toDate;
		//echo "document.write('".$stime.$etime."');";
		// 시작날짜와 종료 날짜의 기간 계산
		$intStime = substr(str_replace("-","",$stime),0,8);
		$intSyear = substr($intStime ,0,4);
		$intSmonth = substr($intStime ,4,2);
		$intSday = substr($intStime ,6,2);
		$intEtime = substr(str_replace("-","",$etime),0,8);
		$intEyear = substr($intEtime ,0,4);
		$intEmonth = substr($intEtime ,4,2);
		$intEday = substr($intEtime ,6,2) ;
		$intStime = mktime(0,0,0, $intSmonth , $intSday , $intSyear );//타임스탬프로 변환
		$intEtime = mktime(0,0,0, $intEmonth , $intEday +1, $intEyear );
		//echo "document.write('".$intStime." ".$intEtime."');";
		$strDay = ($intEtime - $intStime ) / 86400;
		$strDaycnt = floor($strDay)."일"; //두 날짜 사이의 기간
		
?>
		TableAppendRowContents("tbl_s", new Array("<?=$no?>","<?=$name?>","<?=$jumin?>","<?=$addr?>","<?=$strDaycnt?>","<?=$money_sum?>","<?=$bonus_percent?>","","","","",""));
<?
	}
?>
	pHwpCtrl.MoveToField("tbl_s", false, false, false);
	pHwpCtrl.Run("TableDeleteRow");
	pHwpCtrl.MovePos(20);
}
</script>
<?
//echo $intStime." ".$intEtime;
}
//guest id
if($member[mb_id] != "guest") {
?>
	<!-- 한글 컨트롤 폼 -->
	<div style="border:1px solid #ccc;width:">
		<object id="HwpCtrl" width="100%" height="650" align="center" classid="CLSID:BD9C32DE-3155-4691-8972-097D53B10052"></object>
	</div>
<?
} else {
	echo "정식 이용시 가능합니다.";
}
?>
	</form>
</div>
<script type="text/javascript">
<?
if($labor == "labor2") {
?>
document.getElementById('HwpCtrl').style.height = "2570px";
<?
} else if($labor == "worker_register_holder" || $labor == "worker_register_retiree" || $labor == "personnel_document_card" || $labor == "bonus_pay_ledger" || $labor == "retirement_paid_holiday") {
?>
document.getElementById('HwpCtrl').style.height = "680px";
<?
} else if($labor == "rule1") {
?>
document.getElementById('HwpCtrl').style.width = "642px";
document.getElementById('HwpCtrl').style.height = "720px";
<?
//} else if($labor == "labor1" || $labor == "labor3" || $labor == "labor4" || $labor == "pay_table" || $labor == "labor15" || $labor == "career_describe" ) {
//} else {
} else if($labor != "") {
?>
document.getElementById('HwpCtrl').style.height = "1310px";
<?
}
?>

function toggleLayer(id,name) {
	//alert(id);
	document.getElementById('employeeList').style.display='none';
	if(name != "pay_table") {
		document.getElementById('search_year').style.display='none';
		document.getElementById('search_month').style.display='none';
	}
	document.getElementById('yearList').style.display='none';
	document.getElementById('monthList').style.display='none';
	document.getElementById(id).style.display='inline';
	document.HwpControl.labor.value = name;
}
function toggleLayer_hidden(id,name) {
	document.getElementById('employeeList').style.display='none';
	document.getElementById('search_year').style.display='none';
	document.getElementById('search_month').style.display='none';
	document.getElementById('employeeList_text').style.display='none';
	document.getElementById('yearList').style.display='none';
	document.getElementById('monthList').style.display='none';
}
function toggleLayer2(id,name) {
	if(document.getElementById(id).style.display=='block'){
		document.getElementById(id).style.display='none';
		document.getElementById('yy2').style.display='none';
	}else{
		document.getElementById(id).style.display='block';
		document.getElementById('yy2').style.display='inline';
	}
	document.HwpControl.labor.value = name;
}
function goSubmit(name) {
	//alert(name);
	document.HwpControl.labor.value = name;
	document.HwpControl.submit();
}
function goSubmit_vacation() {
	name = "vacation";
	document.HwpControl.labor.value = name;
	document.HwpControl.submit();
}
<?
if($labor == "pay_table") {
	$hwp_js = "pay_stubs.js";
	echo "toggleLayer('employeeList','$labor');";
} else if($labor == "rule1") {
	$hwp_js = "arbeitsordnung.js";
	echo "toggleLayer_hidden();";
} else if($labor == "labor1") {
	$hwp_js = "work_contract.js";
	echo "toggleLayer('employeeList','$labor');";
} else {
	$hwp_js = "form_labor.js";
	if($labor == "rule1" || $labor == "public_document" || $labor == "business_trip_report" || $labor == "worker_register_holder" || $labor == "worker_register_retiree") {
		//근로자 선택 없음 : 취업규칙, 공문(결제란포함)
	} else {
		echo "toggleLayer('employeeList','$labor');";
	}
}
//연차관리대장, 상여금지급대장, 퇴직금지급대장
if($labor == "annual_paid_holiday" || $labor == "bonus_pay_ledger" || $labor == "retirement_paid_holiday") {
	echo "document.getElementById('employeeList').style.display='none';";
	echo "document.getElementById('employeeList_text').style.display='none';";
	echo "document.getElementById('search_year').style.display='inline';";
//출장품의서, 근로자명부(재직자,퇴직자), 
} else if($labor == "" || $labor == "business_trip_report" || $labor == "worker_register_holder" || $labor == "worker_register_retiree") {
	echo "toggleLayer_hidden();";
}
//휴가서식 idx 설정시 실행
//if($idx) echo "addLoadEvent(goSubmit_vacation);";
?>
//hwp컨트롤러 20px 하단으로 이동 fix
for(i=1;i<10;i++) {
	box = getId('subMenuBox'+i+'00');
	//box.style.top = -20;
}

</script>
<script src="./js/<?=$hwp_js?>" type="text/javascript" charset="euc-kr"></script>
			</td>
		</tr>
	</table>
