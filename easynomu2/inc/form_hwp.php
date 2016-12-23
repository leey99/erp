	<!--mb_name 사업장명-->
	<input type="hidden" name="mb_name" value="<?=$row_a4['com_name']?>" />
	<!--공통변수-->
<?
$comp_type = $row_a4['class_gubun'];
if($comp_type != "D") $comp_type = "A";
//$comp_type = "A";
//결재라인 설정 : 청양지피엠
if($com_code == "20247") {
	$approval1 = "담당";
	$approval2 = "부장";
	$approval3 = "사장";
} else {
	$approval1 = "부장";
	$approval2 = "이사";
	$approval3 = "대표";
}
?>
	<input type="hidden" name="comp_type" value="<?=$comp_type?>" title="사업장유형"/>
	<input type="hidden" name="comp_num" value="<?=$row_a4['biz_no']?> " title="사업자등록번호" />
	<input type="hidden" name="bupin_no" value="<?=$row_a4['bupin_no']?> " title="법인등록번호" />
	<input type="hidden" name="comp_name" value="<?=$row_a4['com_name']?>" title="사업장명" />
	<input type="hidden" name="comp_ceo" value="<?=$row_a4['boss_name']?> " title="대표자명" />
	<input type="hidden" name="comp_jumin" value="<?=$row_a4['jumin_no']?> " title="대표자주민번호" />
	<input type="hidden" name="comp_upte" value="<?=$row_a4['uptae']?> " title="업태" />
	<input type="hidden" name="comp_jongmok" value="<?=$row_a4['upjong']?> " title="종목" />
	<input type="hidden" name="comp_tel" value="<?=$row_a4['com_tel']?> " title="사업장전화" />
	<input type="hidden" name="comp_fax" value="<?=$row_a4['com_fax']?> " title="사업장팩스" />
	<input type="hidden" name="comp_cel" value="<?=$row_a4['boss_hp']?> " title="대표자핸드폰" />
	<input type="hidden" name="comp_email" value="<?=$row_a4_opt['boss_mail']?> " title="대표자email" />
	<input type="hidden" name="comp_addr1" value="<?=$row_a4['com_juso']?>" title="사업장주소1" />
	<input type="hidden" name="comp_addr2" value="<?=$row_a4['com_juso2']?> " title="사업장주소2" />
	<input type="hidden" name="today" value="<?=date("Y년 m월 d일")?>" title="오늘날짜"/>
	<input type="hidden" name="yy" value="<?=$search_year?>" title="년도"/>
	<input type="hidden" name="ceo_jik" value="대표"/>
	<!--결재라인-->
	<input type="hidden" name="approval1" value="<?=$approval1?>" />
	<input type="hidden" name="approval2" value="<?=$approval2?>" />
	<input type="hidden" name="approval3" value="<?=$approval3?>" />
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

	//include 근로계약서
	include "work_contract_inc.php";

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
		if($rule1_ok == "0") alert("취업규칙 출력은 관리자 승인이 있어야 합니다.\\n고객센터 1544-4519 연락 바랍니다.");
	}
	//채용전서류
	for($i=1;$i<7;$i++) {
		$document_before .= $row_a4_opt["document_before".$i];
		if($row_a4_opt["document_before".$i]) {
			$document_before .= ". ";
		}
	}
	//채용후서류
	for($i=1;$i<7;$i++) {
		$document_after .= $row_a4_opt["document_after".$i];
		if($row_a4_opt["document_after".$i]) {
			$document_after .= ". ";
		}
	}
	//근무시간 휴게시간
	if($row_a4_opt[rest1] == "") $rest1 = "없음";
	else $rest1 = $row_a4_opt[rest1]."~".$row_a4_opt[rest1e];
	if($row_a4_opt[rest2] == "") $rest2 = "없음";
	else $rest2 = $row_a4_opt[rest2]."~".$row_a4_opt[rest2e];
	if($row_a4_opt[rest3] == "") $rest3 = "없음";
	else $rest3 = $row_a4_opt[rest3]."~".$row_a4_opt[rest3e];
	if($row_a4_opt[stime_b]) {
		if($row_a4_opt[rest1_b] == "") $rest1_b = "없음";
		else $rest1_b = $row_a4_opt[rest1_b]."~".$row_a4_opt[rest1e_b];
		if($row_a4_opt[rest2_b] == "") $rest2_b = "없음";
		else $rest2_b = $row_a4_opt[rest2_b]."~".$row_a4_opt[rest2e_b];
		if($row_a4_opt[rest3_b] == "") $rest3_b = "없음";
		else $rest3_b = $row_a4_opt[rest3_b]."~".$row_a4_opt[rest3e_b];
	}
	//연장/야간근무
	if($row_a4_opt[ext] == "") $ext = "없음";
	else $ext = $row_a4_opt[ext]."~".$row_a4_opt[exte];
	if($row_a4_opt[night] == "") $night = "없음";
	else $night = $row_a4_opt[night]."~".$row_a4_opt[nighte];
	if($row_a4_opt[stime_b]) {
		if($row_a4_opt[ext_b] == "") $ext_b = "없음";
		else $ext_b = $row_a4_opt[ext_b]."~".$row_a4_opt[exte_b];
		if($row_a4_opt[night_b] == "") $night_b = "없음";
		else $night_b = $row_a4_opt[night_b]."~".$row_a4_opt[nighte_b];
	}
	//토/일요일근무
	if($row_a4_opt['saturday_work']) $saturday_work = "근무함.";
	if($row_a4_opt['saturday_work_b']) $saturday_work_b = "근무함.";
	if($row_a4_opt['sunday_work']) $sunday_work = "근무함.";
	if($row_a4_opt['sunday_work_b']) $sunday_work_b = "근무함.";
	if($row_a4_opt['saturday_time'] == "") $saturday_time = " ";
	else $saturday_time = $row_a4_opt['saturday_time']."~".$row_a4_opt['saturday_timee'];
	if($row_a4_opt['saturday_time_b'] == "") $saturday_time_b = " ";
	else $saturday_time_b = $row_a4_opt['saturday_time_b']."~".$row_a4_opt['saturday_timee_b'];
	if($row_a4_opt['sunday_time'] == "") $sunday_time = " ";
	else $sunday_time = $row_a4_opt['sunday_time']."~".$row_a4_opt['sunday_timee'];
	if($row_a4_opt['sunday_time_b'] == "") $sunday_time_b = " ";
	else $sunday_time_b = $row_a4_opt['sunday_time_b']."~".$row_a4_opt['sunday_timee_b'];
	//토요일 유급휴일
	if($row_a4_opt[saturday_paid] == "1") {
		$saturday_paid = "(토요일 유급휴일)";
		$saturday_paid_text = "② 토요일은 유급휴일로 하며 소정근무일에 포함한다.";
	} else {
		$saturday_paid = "";
		$saturday_paid_text = "";
	}
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
	if(!$new_hday) $new_hday = "휴일없음";
	//무급휴일
	for($i=1;$i<7;$i++) {
		$new_holiday .= $row_a4_opt["holiday".$i];
		if($row_a4_opt["holiday".$i]) {
			$new_holiday .= ". ";
		}
	}
	if(!$new_holiday) $new_holiday = "휴일없음";
	//경조사(유급)
	for($i=1;$i<13;$i++) {
		$affair .= $row_a4_opt["affair".$i];
		if($row_a4_opt["affair".$i]) {
			$affair .= ". ";
		}
	}
	if(!$affair) $affair = "휴가없음";
	//유급휴가
	for($i=1;$i<13;$i++) {
		$new_vacation .= $row_a4_opt["vacation".$i];
		if($row_a4_opt["vacation".$i]) {
			$new_vacation .= ". ";
		}
	}
	if(!$new_vacation) $new_vacation = "휴가없음";
	//무급휴가
	for($i=1;$i<7;$i++) {
		$new_celebrate_mourn .= $row_a4_opt["celebrate_mourn".$i];
		if($row_a4_opt["celebrate_mourn".$i]) {
			$new_celebrate_mourn .= ". ";
		}
	}
	if(!$new_celebrate_mourn) $new_celebrate_mourn = "휴가없음";
	//임금계산기간
	if($row_a4_opt['pay_calculate_a']) $pay_calculate_a = $row_a4_opt['pay_calculate_a']." ";
	else $pay_calculate_a = "";
	$pay_calculate_day_period = $pay_calculate_a.$row_a4_opt['pay_calculate_day1']." ".$row_a4_opt['pay_calculate_day_period1']."일부터 ".$row_a4_opt['pay_calculate_day2']." ".$row_a4_opt['pay_calculate_day_period2']."일까지로 하며, ".$row_a4_opt['pay_calculate_day3']." ".$row_a4_opt['pay_calculate_day_period3']."일";
	if($row_a4_opt['check_pay_calculate_b']) $pay_calculate_day_period .= "에 지급하고, ".$row_a4_opt['pay_calculate_b']." ".$row_a4_opt['pay_calculate_day1_b']." ".$row_a4_opt['pay_calculate_day_period1_b']."일부터 ".$row_a4_opt['pay_calculate_day2_b']." ".$row_a4_opt['pay_calculate_day_period2_b']."일까지로 하며, ".$row_a4_opt['pay_calculate_day3_b']." ".$row_a4_opt['pay_calculate_day_period3_b']."일";
	//퇴직금
	$retirement_gbn_array = explode(",",$row_a4_opt[retirement_gbn]);
	if($retirement_gbn_array[0] == "1") $retirement_gbn_text[1] = "퇴직시정산";
	if($retirement_gbn_array[1] == "1") $retirement_gbn_text[2] = "퇴직연금";
	if($retirement_gbn_array[2] == "1") $retirement_gbn_text[3] = "퇴직금중간정산";
	for($i=1;$i<4;$i++) {
		$retirement_gbn .= $retirement_gbn_text[$i];
		if($retirement_gbn_text[$i]) {
			$retirement_gbn .= ". ";
		}
	}
	//퇴직연금
	if($row_a4_opt[retirement_annuity] == "") {
		$retirement_annuity = " ";
	} else {
		$retirement_annuity = "(가입상품: ".$row_a4_opt[retirement_annuity].")";
	}
	//정기상여금
	if($row_a4_opt[bonus]) $bonus = $row_a4_opt[bonus];
	else $bonus = "해당사항 않음.";
	if($row_a4_opt['check_bonus_money_payment']) $bonus = "해당사항 않음.";
	//시행일
	if($row_a4_opt[conduct_day] == "") {
		$conduct_day = "      년    월   일";
	} else {
		$conduct_day_array = explode(".",$row_a4_opt[conduct_day]);
		$conduct_day = $conduct_day_array[0]."년 ".$conduct_day_array[1]."월 ".$conduct_day_array[2]."일";
	}
	//퇴직수속2
	//echo "사업자등록번호 : ".$row_a4['t_insureno'];
	if($row_a4['t_insureno'] == "513-16-98675") {
		$annual_paid_holiday_standard = "입사일을";
		$out_procedure2 = "유니폼, 작업복, 안전화 등 회사에서 제공한 개인 물품, 비품의 경우 근무기간이 3개월 미만일 경우 급여에서 공제할 수 있다.";
	} else {
		$annual_paid_holiday_standard = "회계연도를";
		$out_procedure2 = "사원의 퇴직시 회사는 필요한 경우 사원에게 업무상의 비밀보호 및 사용금지에 관한 서약서를 청구 할 수 있다.";
	}
	//제수당 5인 이상 / 5인 미만
	if($row_a4_opt['persons'] > 5) {
		//제수당 86조
		$allowance_86 = "사원이 시간외 연장, 야간 및 휴일근무를 한 경우에는 시간급 통상임금의 50%를 가산한 임금을 지급한다. 다만, 포괄임금 근로계약을 체결한 경우는 예외로 한다.";
		//제수당 88조
		$allowance_88 = "① 회사의 사정으로 인한 휴업 시에는 휴업기간 중 해당 사원에게 평균임금의 70%에 해당하는 금액을 지급한다. 다만, 부득이한 사유로 인하여 사업계속이 불가능하여 노동위원회의 승인을 받은 경우에는 예외로 한다. ② 회사는 업무형편에 의하여 전부 또는 소정의 사원에 대하여 휴무 또는 근무단축을 실시할 수 있다.";
	} else {
		$allowance_86 = "상시근로자 5인미만 미적용(연장,야간,휴일근로에 대한 가산수당)";
		$allowance_88 = "상시근로자 5인미만 미적용";
	}
?>
	<!--취업규칙-->
	<input type="hidden" name="head" value="<?=$row_a4[com_name]?>" title="머리말" />
	<input type="hidden" name="document_before" value="<?=$document_before?>" title="채용전서류" />
	<input type="hidden" name="document_after" value="<?=$document_after?>" title="채용후서류" />
	<input type="hidden" name="persons" value="<?=$row_a4_opt[persons]?>" title="명" />
	<input type="hidden" name="man" value="<?=$row_a4_opt[man]?>" title="남" />
	<input type="hidden" name="woman" value="<?=$row_a4_opt[woman]?>" title="여" />
	<input type="hidden" name="work_gbn_text_a" value="<?=$row_a4_opt[work_gbn_text_a]?>" title="근무시간A" />
	<input type="hidden" name="work_gbn_text_b" value="<?=$row_a4_opt[work_gbn_text_b]?>" title="근무시간B" />
	<input type="hidden" name="stime" value="<?=$row_a4_opt[stime]?>" title="시업시간" />
	<input type="hidden" name="etime" value="<?=$row_a4_opt[etime]?>" title="종업시간" />
	<input type="hidden" name="rest1" value="<?=$rest1?>" title="휴게시간1" />
	<input type="hidden" name="rest2" value="<?=$rest2?>" title="휴게시간2" />
	<input type="hidden" name="rest3" value="<?=$rest3?>" title="휴게시간3" />
	<input type="hidden" name="stime_b" value="<?=$row_a4_opt[stime_b]?>" title="시업시간" />
	<input type="hidden" name="etime_b" value="<?=$row_a4_opt[etime_b]?>" title="종업시간" />
	<input type="hidden" name="rest1_b" value="<?=$rest1_b?>" title="휴게시간1" />
	<input type="hidden" name="rest2_b" value="<?=$rest2_b?>" title="휴게시간2" />
	<input type="hidden" name="rest3_b" value="<?=$rest3_b?>" title="휴게시간3" />
	<input type="hidden" name="ext" value="<?=$ext?>" title="연장근로" />
	<input type="hidden" name="ext_b" value="<?=$ext_b?>" title="연장근로b" />
	<input type="hidden" name="night" value="<?=$night?>" title="야간근로" />
	<input type="hidden" name="night_b" value="<?=$night_b?>" title="야간근로b" />
	<input type="hidden" name="saturday_work" value="<?=$saturday_work?>" title="토요일근무" />
	<input type="hidden" name="saturday_work_b" value="<?=$saturday_work_b?>" title="토요일근무b" />
	<input type="hidden" name="sunday_work" value="<?=$sunday_work?>" title="일요일근무" />
	<input type="hidden" name="sunday_work_b" value="<?=$sunday_work_b?>" title="일요일근무b" />
	<input type="hidden" name="saturday_time" value="<?=$saturday_time?>" title="토요일근무시간" />
	<input type="hidden" name="saturday_time_b" value="<?=$saturday_time_b?>" title="토요일근무시간b" />
	<input type="hidden" name="sunday_time" value="<?=$sunday_time?>" title="일요일근무시간" />
	<input type="hidden" name="sunday_time_b" value="<?=$sunday_time_b?>" title="일요일근무시간b" />
	<input type="hidden" name="hday" value="<?=$row_a4_opt[hday]?> <?=$saturday_paid?>" title="주휴일" />
	<input type="hidden" name="saturday_paid" value="<?=$saturday_paid_text?> " title="토요일유급" />
	<input type="hidden" name="fday" value="<?=$fday?>" title="명절" />
	<input type="hidden" name="new_hday" value="- <?=$new_hday?>" title="유급휴일" />
	<input type="hidden" name="new_holiday" value="- <?=$new_holiday?>" title="무급휴일" />
	<input type="hidden" name="affair" value="- <?=$affair?>" title="경조사(유급)" />
	<input type="hidden" name="new_vacation" value="- <?=$new_vacation?>" title="유급휴가" />
	<input type="hidden" name="new_celebrate_mourn" value="- <?=$new_celebrate_mourn?>" title="무급휴가" />
	<input type="hidden" name="summer_vacation" value="<?=$row_a4_opt[summer_vacation]?>" title="하기휴가" />
	<input type="hidden" name="pay_system" value="<?=$row_a4_opt[pay_system]?>" title="임금체계" />
	<input type="hidden" name="pay_structure" value="<?=$row_a4_opt[pay_structure]?>" title="임금구성" />
	<input type="hidden" name="pay_calculate_day_period" value="<?=$pay_calculate_day_period?>" title="임금계산기간" />

	<input type="hidden" name="allowance_86" value="<?=$allowance_86?>" title="시간외근무수당" />
	<input type="hidden" name="allowance_88" value="<?=$allowance_88?>" title="휴업수당" />

	<input type="hidden" name="retirement_age_rule" value="<?=$row_a4_opt[retirement_age_rule]?>" title="정년" />
	<input type="hidden" name="retirement_gbn" value="<?=$retirement_gbn?>" title="퇴직금" />
	<input type="hidden" name="out_procedure2" value="<?=$out_procedure2?>" title="퇴직수속2" />
	<input type="hidden" name="annual_paid_holiday_standard" value="<?=$annual_paid_holiday_standard?>" title="연차기준" />
	<input type="hidden" name="bonus" value="<?=$bonus?>" title="정기상여금" />
	<input type="hidden" name="retirement_annuity" value="<?=$retirement_annuity?>" title="퇴직연금" />
	<input type="hidden" name="conduct_day" value="<?=$conduct_day?>" title="시행일" />
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
	if($row2[dept]) {
		$sql_dept = " select * from com_code_list where item='dept' and com_code='$code' and code = $row2[dept] ";
		//echo $sql_dept;
		$result_dept = sql_query($sql_dept);
		$row_dept = sql_fetch_array($result_dept);
		$dept = $row_dept[name];
	} else {
		$dept = "-";
	}
?>
	<!--경력증명서-->
	<input type="hidden" name="addr" value="<?=$row1[w_juso]?> "/>
	<input type="hidden" name="name_k" value="<?=$row1[name]?>"/>
	<input type="hidden" name="jumin" value="<?=$row1[jumin_no]?>"/>
	<input type="hidden" name="dept" value="<?=$dept?>"/>
	<input type="hidden" name="jik" value="<?=$row_position[name]?> "/>
	<input type="hidden" name="sdate" value="<?=$row1[in_day]?>"/>
	<input type="hidden" name="edate" value="<?=$row1[out_day]?> "/>
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
	<input type="hidden" name="jumin" value="<?=$row1[jumin_no]?>" />
	<input type="hidden" name="dept" value="<?=$dept?>"/>
	<input type="hidden" name="tel" value="<?=$row1[add_tel]?>"/>
	<input type="hidden" name="resign_cause" value="<?=$retire_cause?>" />
	<input type="hidden" name="jik" value="<?=$row_position[name]?> "/>
	<input type="hidden" name="jdate" value="<?=$row1['in_day']?>" title="입사일" />
	<input type="hidden" name="edate" value="<?=$row1['out_day']?>" title="퇴직일" />
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
	if($row2[dept]) {
		$sql_dept = " select * from com_code_list where item='dept' and com_code='$code' and code = $row2[dept] ";
		//echo $sql_dept;
		$result_dept = sql_query($sql_dept);
		$row_dept = sql_fetch_array($result_dept);
		$dept = $row_dept[name];
	} else {
		$dept = "-";
	}
?>
	<input type="hidden" name="addr" value="<?=$row1[w_juso]?> "/>
	<input type="hidden" name="name_k" value="<?=$row1[name]?>"/>
	<input type="hidden" name="jumin" value="<?=$row1[jumin_no]?>"/>
	<input type="hidden" name="dept" value="<?=$dept?>"/>
	<input type="hidden" name="jik" value="<?=$row_position[name]?> "/>
	<input type="hidden" name="sdate" value="<?=$row1[in_day]?>"/>
	<input type="hidden" name="edate" value="<?=$row1[out_day]?> "/>
<?
//출장품의서
} else if($labor == "business_trip_report") {
?>
	<input type="hidden" name="name_k" value="<?=$row1[name]?>"/>
<?
//근로자명부(재직자)
} else if($labor == "worker_register_holder") {
	//성명, 입사일자
	$sql_base = " select * from pibohum_base a, pibohum_base_opt b where a.com_code=b.com_code and a.sabun=b.sabun and a.com_code='$com_code' and a.out_day = '' order by b.position ";
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
		//자격증, 자격증번호, 집전화, 휴대전화
		if(!$row_opt[license_name]) $row_opt[license_name] = " ";
		if(!$row_opt[license_step]) $row_opt[license_step] = " ";
		//주소
		if($row_base[w_juso]) {
			$w_juso_full = $row_base[w_juso]." ".$row_opt[w_juso2];
			$w_juso = cut_str($w_juso_full, 70, "..");
		} else {
			$w_juso = " ";
		}
		if(!$row_base[add_tel]) $row_base[add_tel] = " ";
		if(!$row_opt[emp_cel]) $row_opt[emp_cel] = " ";
?>
	<input type="hidden" name="jik" value="<?=$position?>"/>
	<input type="hidden" name="name_k" value="<?=$row_base[name]?>"/>
	<input type="hidden" name="jumin" value="<?=$row_base[jumin_no]?>"/>
	<input type="hidden" name="license_name" value="<?=$row_opt[license_name]?>"/>
	<input type="hidden" name="license_step" value="<?=$row_opt[license_step]?>"/>
	<input type="hidden" name="addr" value="<?=$w_juso?>"/>
	<input type="hidden" name="in_day" value="<?=$row_base[in_day]?>"/>
	<input type="hidden" name="step" value="<?=$step?>"/>
	<input type="hidden" name="tel" value="<?=$row_base[add_tel]?>"/>
	<input type="hidden" name="hp" value="<?=$row_opt[emp_cel]?>"/>
<?
	}
	//여분 출력 hwp control 셋팅
	if($i >= 0 && $i < 16) $k_limit = 16 - $i;
	else if($i >= 16 && $i < 32) $k_limit = 32 - $i;
	else if($i >= 32 && $i < 48) $k_limit = 48 - $i;
	else if($i >= 48 && $i < 64) $k_limit = 64 - $i;
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
	<input type="hidden" name="tel" value=" "/>
	<input type="hidden" name="hp" value=" "/>
<?
	}
	$worker_count = $i + 1;
?>
	<input type="hidden" name="worker_count" value="<?=$worker_count?>"/>
<?
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
		//자격증, 자격증번호, 집전화, 휴대전화
		if(!$row_opt[license_name]) $row_opt[license_name] = " ";
		if(!$row_opt[license_step]) $row_opt[license_step] = " ";
		if(!$row_base[add_tel]) $row_base[add_tel] = " ";
		if(!$row_opt[emp_cel]) $row_opt[emp_cel] = " ";
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
	if($i >= 0 && $i < 16) $k_limit = 16 - $i;
	else if($i >= 16 && $i < 32) $k_limit = 32 - $i;
	else if($i >= 32 && $i < 48) $k_limit = 48 - $i;
	else if($i >= 48 && $i < 64) $k_limit = 64 - $i;
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
	$worker_count = $i + 1;
?>
	<input type="hidden" name="worker_count" value="<?=$worker_count?>"/>
<?
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
	<input type="hidden" name="dept" value="<?=$row_opt[dept_1]?>"/>
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
	//echo $search_year;
	//연차 개인별 리스트 : 재직자만 표시 160317
	//$sql_annual = " select * from pibohum_base_nomu a, pibohum_base b, pibohum_base_opt c where a.com_code='$com_code' and a.com_code=b.com_code and a.com_code=c.com_code and a.sabun=b.sabun and a.sabun=c.sabun and b.gubun='0' group by a.com_code, a.sabun order by c.position asc ";
	$sql_annual = " select * from pibohum_base b, pibohum_base_opt c where b.com_code='$com_code' and b.com_code=c.com_code and b.sabun=c.sabun and b.gubun='0' order by c.position asc ";
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
		$sql_annual_cnt = " select count(*) as cnt from pibohum_base_nomu where com_code = '$com_code' and sabun = '$row_annual[sabun]' and ( annual_paid_holiday_day != '' and annual_paid_holiday_day like '$search_year%' ) ";
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
	$cause_array = array("","연차휴가(유급)","생리휴가(무급)","경조사휴가(유급)","경조사휴가(무급)","병가(유급)","병가(무급)","임신/출산관련휴직","육아휴직");
	$cause_no = $row_nomu[vacation_cause];
	$cause = $cause_array[$cause_no];
	//휴가사유
	$reason = $row_nomu[vacation_reason];
?>
	<!--휴가신청서(회사)-->
	<input type="hidden" name="dept" value="<?=$row_opt[dept_1]?>"/>
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
	if($bonus_array[0]) $bonus_time1 = $bonus_array[0];
	else $bonus_time1 = " ";
	if($bonus_array[1]) $bonus_time2 = $bonus_array[1];
	else $bonus_time2 = " ";
	if($bonus_array[2]) $bonus_time3 = $bonus_array[2];
	else $bonus_time3 = " ";
	if($bonus_array[3]) $bonus_time4 = $bonus_array[3];
	else $bonus_time4 = " ";
	if($bonus_array[4]) $bonus_time5 = $bonus_array[4];
	else $bonus_time5 = " ";
	if($bonus_array[5]) $bonus_time6 = $bonus_array[5];
	else $bonus_time6 = " ";
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
$sql_common = " from $g4[pibohum_base] a, pibohum_base_opt b, pibohum_base_opt2 c ";
$sql_a4 = " select com_code from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4[com_code];
$sql_search = " where a.com_code='$com_code' ";
//옵션DB join
$sql_search .= " and ( ";
$sql_search .= " (a.com_code = b.com_code and a.sabun = b.sabun and a.com_code = c.com_code and a.sabun = c.sabun) ";
$sql_search .= " ) ";
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
if($sort1) {
	if($sort1 == "in_day" || $sort1 == "name") $sst = "a.".$sort1;
	else $sst = "b.".$sort1;
	$sod = $sod1;
} else {
	$sst = "b.position";
	$sod = "asc";
}
if($sort2) {
	if($sort2 == "in_day" || $sort2 == "name") $sst2 = ", a.".$sort2;
	else $sst2 = ", b.".$sort2;
	$sod2 = $sod2;
} else {
	$sst2 = ", a.in_day";
	$sod2 = "asc";
}
if($sort3) {
	if($sort3 == "in_day" || $sort3 == "name") $sst3 = ", a.".$sort3;
	else $sst3 = ", b.".$sort3;
	$sod3 = $sod3;
} else {
	$sst3 = ", b.dept";
	$sod3 = "asc";
}
$sql_order = " order by $sst $sod $sst2 $sod2 $sst3 $sod3 ";
$sql = " select count(*) as cnt $sql_common $sql_search $sql_order ";
$row = sql_fetch($sql);
$total_count = $row[cnt];
if (!$page) $page = 1;
$from_record = ($page - 1) * $rows;
$rows = 15;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
$sql = " select * $sql_common $sql_search $sql_order limit $from_record, $rows ";
$result = sql_query($sql);
//지급시기
$sql_a4_opt = " select * from com_list_gy_opt where com_code = '$com_code' ";
$row_a4_opt = sql_fetch($sql_a4_opt);
$bonus_time = explode(",",$row_a4_opt[bonus_time]);	
$bonus_time_cnt = 0;
for($i=0;$i<6;$i++) {
	if($bonus_time[$i] == "") {
		$bonus_time[$i] = "-";
	} else {
		$bonus_time_cnt++;
	}
}
$j = 1;
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//$page
	//$total_page
	//$rows
	$no = $j;
	$list = $i%2;
	//idx
	$idx = $row[idx];
	//사업장 코드 / 사번 / 코드_사번
	$code = $row[com_code];
	$id = $row[sabun];
	$code_id = $code."_".$id;
	// 사업장명 : 사업장코드
	$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$row[com_code]' ";
	$row_com = sql_fetch($sql_com);
	$com_name = $row_com[com_name];
	$com_name = cut_str($com_name, 21, "..");
	//사원DB
	$sql_base = " select * from pibohum_base where com_code='$code' and sabun='$id' ";
	$result_base = sql_query($sql_base);
	$row_base = mysql_fetch_array($result_base);
	$name = cut_str($row_base[name], 8, "..");
	//입사일, 퇴직일
	$in_day = $row_base[in_day];
	$out_day = $row_base[out_day];
	//사원DB 옵션
	$sql2 = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
	$result2 = sql_query($sql2);
	$row2 = mysql_fetch_array($result2);
	//직위
	if($row2[position]) {
		$sql_position = " select * from com_code_list where item='position' and code=$row2[position] ";
		//echo $sql_position;
		$result_position = sql_query($sql_position);
		$row_position = sql_fetch_array($result_position);
		$position = $row_position[name];
	}
	//채용형태
	if($row_base[work_form] == 1) $work_form = "정규직";
	else if($row_base[work_form] == 2) $work_form = "계약직";
	else if($row_base[work_form] == 3) $work_form = "일용직";
	else $work_form = "";
	//상여금기준 (산정기준, 상여비율)
	$sql_opt2 = " select * from pibohum_base_opt2 where com_code='$code' and sabun='$id' ";
	$result_opt2 = sql_query($sql_opt2);
	$row_opt2 = mysql_fetch_array($result_opt2);
	//$bonus_code = $row_opt2[bonus_standard];
	if($row_opt2[bonus_standard] == "1") $bonus_standard = "기본급";
	else if($row_opt2[bonus_standard] == "2") $bonus_standard = "결정임금";
	else if($row_opt2[bonus_standard] == "3") $bonus_standard = "통상임금";
	else if($row_opt2[bonus_standard] == "4") $bonus_standard = "총급여";
	//상여금 수동입력
	$check_bonus_money_yn = $row_opt2[check_bonus_money_yn];
	$bonus_money = $row_opt2[bonus_money];
	if($check_bonus_money_yn == "Y") {
		$bonus_standard = "회사내규";
		$bonus_standard_pay = $bonus_money;
	}
	$bonus_percent = $row_opt2[bonus_percent];
	if($bonus_percent != "0") {
		$bonus_standard_percent = $bonus_standard."<br>".$bonus_percent."%";
		//상여금 수정 링크
		$bonus_url = "bonus_view.php?w=u&id=".$id."&page=".$page."&stx_bonus_time=".$stx_bonus_time;
	} else {
		$bonus_standard_percent = "-";
	}
	$bonus_p_array = explode(",",$row_opt2[bonus_p]);
	//지급일자, 지급액, 메모
	for($m=0;$m<6;$m++) {
		$k = $m + 1;
		$sql_bonus = " select * from pibohum_base_bonus where com_code='$code' and sabun='$id' and bonus_time='$k' ";
		$result_bonus = sql_query($sql_bonus);
		$row_bonus = mysql_fetch_array($result_bonus);
		$bonus_percent_array[$m] = $row_bonus[bonus_percent];
		$bonus_day[$m] = $row_bonus[bonus_day];
		if($bonus_day[$m]) {
			$bonus_pay[$m] = $row_bonus[pay];
		} else {
			$bonus_day[$m] = "             ";
			$bonus_pay[$m] = " ";
		}
		$memo = $row_bonus[memo];
		//지급시기별 상여비율
		if($bonus_percent_array[$m]) {
			$bonus_p[$m] = $bonus_percent_array[$m]."%";
		} else {
			if($bonus_p_array[$m]) $bonus_p[$m] = $bonus_p_array[$m]."%";
			else $bonus_p[$m] = " ";
		}
	}
	if($bonus_percent && !$sabun) {
?>
	TableAppendRowContents("tbl_s", new Array("<?=$no?>","<?=$name?>","<?=$position?>","<?=$bonus_standard?>","<?=$bonus_percent?>","<?=$bonus_day[0]?><?=$bonus_p[0]?>","<?=$bonus_pay[0]?>","<?=$bonus_day[1]?><?=$bonus_p[1]?>","<?=$bonus_pay[1]?>","<?=$bonus_day[2]?><?=$bonus_p[2]?>","<?=$bonus_pay[2]?>","<?=$bonus_day[3]?><?=$bonus_p[3]?>","<?=$bonus_pay[3]?>","<?=$bonus_day[4]?><?=$bonus_p[4]?>","<?=$bonus_pay[4]?>","<?=$bonus_day[5]?><?=$bonus_p[5]?>","<?=$bonus_pay[5]?>"));
<?
		$j++;
	} else {
		if($sabun == $id) {	
?>
	TableAppendRowContents("tbl_s", new Array("<?=$no?>","<?=$name?>","<?=$position?>","<?=$bonus_standard?>","<?=$bonus_percent?>","<?=$bonus_day[0]?><?=$bonus_p[0]?>","<?=$bonus_pay[0]?>","<?=$bonus_day[1]?><?=$bonus_p[1]?>","<?=$bonus_pay[1]?>","<?=$bonus_day[2]?><?=$bonus_p[2]?>","<?=$bonus_pay[2]?>","<?=$bonus_day[3]?><?=$bonus_p[3]?>","<?=$bonus_pay[3]?>","<?=$bonus_day[4]?><?=$bonus_p[4]?>","<?=$bonus_pay[4]?>","<?=$bonus_day[5]?><?=$bonus_p[5]?>","<?=$bonus_pay[5]?>"));
<?
		}
	}
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
} else if($labor == "security_covenant") {
	//보안서약서
?>
	<input type="hidden" name="name_k" value="<?=$row1[name]?>"/>
<?
//echo $intStime." ".$intEtime;
}
//guest id
if($member[mb_id] != "guest") {
?>
	<!-- 한글 컨트롤 폼 -->
	<div style="">
		<object id="HwpCtrl" width="100%" height="650" align="center" classid="CLSID:BD9C32DE-3155-4691-8972-097D53B10052" style="margin:4px 0 0 0;border:1px solid #ccc"></object>
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
} else if($labor == "worker_register_holder" || $labor == "worker_register_retiree" || $labor == "personnel_document_card" || $labor == "bonus_pay_ledger" || $labor == "retirement_paid_holiday" || $labor == "retirement_pay_ledger") {
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
	if($member['mb_id'] == "410-86-38857") $hwp_js = "work_contract_cns.js";
	else $hwp_js = "work_contract.js";
	//$hwp_js = "work_contract.js";
	echo "toggleLayer('employeeList','$labor');";
} else if($labor == "security_covenant") {
	$hwp_js = "security_covenant.js";
	echo "toggleLayer('employeeList','$labor');";
} else {
	$hwp_js = "form_labor.js";
	//화성시장애인부모회 서식
	if($member['mb_id'] == "124-82-18063") $hwp_js = "form_labor_h.js";	
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
