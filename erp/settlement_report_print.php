<?
$sub_menu = "300201";
include_once("./_common.php");

$sql_common = " from com_list_gy a, com_list_gy_opt b, erp_application c ";

//echo $member[mb_profile];
if($is_admin != "super") {
	//$stx_man_cust_name = $member[mb_profile];
}
//$is_admin = "super";
//echo $is_admin;
if($member['mb_level'] > 6 || $search_ok == "ok") {
	$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code ";
} else {
	$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code and a.damdang_code='$member[mb_profile]' ";
}
//지원금 신청 (기본 검색)
$sql_search .= " and ( c.application_kind != '0' and c.application_kind != '' and ( c.main_receipt_date != '' ) ) ";

//검색 : 사업장명칭
if($stx_comp_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_name like '%$stx_comp_name%') ";
	$sql_search .= " ) ";
}
//검색 : 사업장관리번호
if($stx_t_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.t_insureno like '%$stx_t_no%') ";
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
//검색 : 전화번호
if($stx_comp_tel) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_tel like '%$stx_comp_tel%') ";
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
//검색 : 담당자
if($stx_manage_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (c.person_charge like '%$stx_manage_name%') ";
	$sql_search .= " ) ";
}
//용역비
if($stx_allowance_pay) {
	if($stx_allowance_pay == 1) $sql_search .= " and c.allowance_pay != '' ";
	else if($stx_allowance_pay == 2) $sql_search .= " and c.allowance_pay = '' ";
}
//업무지원
if($stx_service_support_staff) {
	$sql_search .= " and c.service_support_staff = '$stx_service_support_staff' ";
	//대구남부일 경우 결산보고서 제목에 표시 161107
	if($stx_service_support_staff == "대구남부") $service_support_staff = "대구남부 ";
	else $service_support_staff = "";
}

//날짜 계산
$previous_month_start = date("Y.m.01",strtotime("-1month"));
$previous_month_last_day = date('t', strtotime($previous_month_start));
$previous_month_end = date("Y.m",strtotime("-1month")).".".$previous_month_last_day;
$this_month_start = date("Y.m.01");
$this_month_last_day = date('t', strtotime($this_month_start));
$this_month_end = date("Y.m").".".$this_month_last_day;
$next_month_start = date("Y.m.01",strtotime("+1month"));
$next_month_last_day = date('t', strtotime($next_month_start));
$next_month_end = date("Y.m",strtotime("+1month")).".".$next_month_last_day;

//결산기간 강제 전월 설정
if(!$stx_search_day_chk) {
	$search_day3 = 1;
	$stx_search_day_chk = 1;
	$search_sday = $previous_month_start;
	$search_eday = $previous_month_end;
}

//검색 : 검색기간
if($stx_search_day_chk) {
	$sst = "a.regdt";
	$sod = "asc";
	if($search_day_all || $search_day1 || $search_day2 || $search_day3 || $search_day4 || $search_day5) $sql_search .= " and ( ";
	//본사입금일
	if($search_day3) {
		if($search_day1 || $search_day2) $sql_search .= " or ";
		$sql_search .= " (c.main_receipt_date >= '$search_sday' and c.main_receipt_date <= '$search_eday') ";
		//$sst = "case when (c.main_receipt_date < '$search_sday') then  c.main_receipt_date2 else c.main_receipt_date end ";
		$sst = "c.main_receipt_date";
		$sod = "asc";
		$sst2 = ", c.com_code";
		$sod2 = "asc";
	}
	if($search_day_all || $search_day1 || $search_day2 || $search_day3 || $search_day4 || $search_day5) $sql_search .= " ) ";
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
//검색2 : 의뢰서
if ($stx_comp_gubun1) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.editdt != '') ";
	$sql_search .= " ) ";
}
//검색2 : 위탁서
if ($stx_comp_gubun2) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.samu_receive_date != '') ";
	$sql_search .= " ) ";
}
//검색2 : 대리인선임(공단)
if ($stx_comp_gubun3) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.agent_elect_public_edate != '') ";
	$sql_search .= " ) ";
}
//검색2 : 대리인선임(센터)
if ($stx_comp_gubun4) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.agent_elect_center_edate != '') ";
	$sql_search .= " ) ";
}
//검색2 : 이지노무
if ($stx_comp_gubun5) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.easynomu_yn = '1') ";
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

//정렬
if (!$sst) {
    $sst = "c.main_receipt_date";
    $sod = "asc";
}
$sql_order = " order by $sst $sod $sst2 $sod2 ";
//카운트
$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];
$rows = $total_count;

$from_record = 0;

$sub_title = "결산보고서";
$g4[title] = $sub_title." : 결산 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);

//결산년도 / 결산월
$search_sday_array = explode('.', $search_sday);
$search_year = $search_sday_array[0];
$search_month = $search_sday_array[1];
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
<script language="javascript">
function goSearch() {
	var frm = document.searchForm;
	frm.action = "<?=$PHP_SELF?>";
	frm.submit();
	return;
}
</script>
<script type="text/javascript">
//<![CDATA[
var mbrclick= false;
var rooturl = '<?=$rooturl?>';
var rootssl = '<?=$rootssl?>';
var raccount= 'home';
var moduleid= 'home';
var memberid= 'master';
var is_admin= '0';
var needlog = '로그인후에 이용하실 수 있습니다. ';
var neednum = '숫자만 입력해 주세요.';
var myagent	= navigator.appName.indexOf('Explorer') != -1 ? 'ie' : 'ns';
//]]>
</script>
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<div id="">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" style="padding:10px 10px 10px 10px">
							<!--타이틀 -->
							<table width="100%" border=0 cellspacing=0 cellpadding=0>
								<tr>     
									<td height="18">
										<table width=100% border=0 cellspacing=0 cellpadding=0>
											<tr>
												<td style='font-size:8pt;color:#929292;'><img src="images/g_title_icon.gif" align=absmiddle  style='margin:0 5 2 0'><span style='font-size:9pt;color:black;'><?=$sub_title?></span>
												</td>
												<td align=right class=navi></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr><td height=1 bgcolor=e0e0de></td></tr>
								<tr><td height=2 bgcolor=f5f5f5></td></tr>
								<tr><td height=5></td></tr>
							</table>
							<div id="rcontent" class="center m_side">
								<form name = "HwpControl" id="HwpControl" method="post" action="<?=$PHP_SELF?>">
									<input type="hidden" name="w_date" value="<?=$w_date?>">
									<input type="hidden" name="w_time" value="<?=$w_time?>">
									<input type="hidden" name="dept_code" value="<?=$dept_code?>">
									<!--업무지원: 대구남부-->
									<input type="hidden" name="service_support_staff" value="<?=$service_support_staff?>">
									<!--급여대장-->
									<input type="hidden" name="comp_type" value="<?=$comp_print_type?>"/>
									<input type="hidden" name="company" value="<?=$row_a4[com_name]?>"/>
									<input type="hidden" name="pay_year" value="<?=$search_year?>"/>
									<input type="hidden" name="pay_month" value="<?=$search_month?>"/>
<?
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
?>
									<!--반복 변수 배열 처리-->
									<input type="hidden" name="no" value=" "/>
									<input type="hidden" name="com_name" value=" "/>
									<input type="hidden" name="person_charge" value=" "/>
									<input type="hidden" name="application_kind" value=" "/>

									<input type="hidden" name="main_receipt_date" value=" "/>
									<input type="hidden" name="client_receipt_fee" value=" "/>
									<input type="hidden" name="p_support" value=" "/>
									<input type="hidden" name="requested_amount" value=" "/>
									<input type="hidden" name="main_income" value=" "/>
									<input type="hidden" name="lawyer_fee" value=" "/>

									<input type="hidden" name="allowance_rate" value=" "/>
									<input type="hidden" name="allowance_pay" value=" "/>
									<input type="hidden" name="remark_text" value=" "/>
<?
// 출력 페이지 계산
$pay_worker_count = 24;
$pay_page = ceil($rows / $pay_worker_count);
//echo $pay_page;
for($i=1;$i<=$pay_page;$i++) {
	$w_day_sum[$i] = 0;
}
//$i변수 추가 증가값
$add_i = 0;
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;
	//거래처 코드
	$id = $row['com_code'];
	//위탁서래처 코드
	if($row['samu_receive_no']) {
		$samu_receive_no = "(".$row['samu_receive_no'].")";
	} else {
		$samu_receive_no = "";
	}
	//등록일자
	$regdt = $row['regdt'];
	//등록일자 색상
	if($regdt >= $search_sday && $regdt <= $search_eday) $regdt_color = "color:red";
	else $regdt_color = "";
	//신청내용
	$application_kind_code = $row['application_kind'];
	$application_kind = $support_kind_array[$application_kind_code]."";
	//수수료 : 지원금, 부담금, 건설, 직무교육
	$p_support = $row['p_support']."%";
	$p_contribution = $row['p_contribution']."%";
	$p_construction = $row['p_construction']."%";
	$p_training = $row['p_training']."%";
	if($p_support == "0%") $p_support = "-";
	if($p_contribution == "0%") $p_contribution = "-";
	if($p_construction == "0%") $p_construction = "-";
	if($p_training == "0%") $p_training = "-";
	if($p_support == "%") $p_support = "-";
	if($p_contribution == "%") $p_contribution = "-";
	if($p_construction == "%") $p_construction = "-";
	if($p_training == "%") $p_training = "-";
	//부담금, 직무교육, 전기요금컨설팅, 시간선택제일자리 수수료 적용 151210
	if($application_kind_code >= 13 && $application_kind_code <= 16) $p_support = $p_contribution;
	else if($application_kind_code == 22) $p_support = $p_training;
	else if($application_kind_code == 25) $p_support = "-";
	else if($application_kind_code == 11) $p_support = "-";
	//업체입금일
	if($row['client_receipt_date']) $client_receipt_date = $row['client_receipt_date']."";
	else $client_receipt_date = "-";
	//재접수일자 색상
	if($client_receipt_date >= $search_sday && $client_receipt_date <= $search_eday) $client_receipt_date_color = "color:red";
	else $client_receipt_date_color = "";
	//업체입금액
	if($row['client_receipt_fee']) {
		$client_receipt_fee = number_format($row['client_receipt_fee'])."";
	} else {
		$client_receipt_fee = "-";
	}
	//업체입금일 색상
	if($client_receipt_date >= $search_sday && $client_receipt_date <= $search_eday) $client_receipt_date_color = "color:red";
	else $client_receipt_date_color = "";
	//업체입금액 합계
	$crf = str_replace(',','',$client_receipt_fee);
	$client_receipt_fee_sum += ($crf);
	//본사입금일
	if($row['main_receipt_date']) $main_receipt_date = $row['main_receipt_date']."";
	else $main_receipt_date = "-";
	//본사입금일 색상
	if($row['main_receipt_date'] >= $search_sday && $row['main_receipt_date'] <= $search_eday) $main_receipt_date_color = "color:red";
	else $main_receipt_date_color = "";
	//본사입금액
	if($row['main_receipt_fee']) {
		$main_receipt_fee = number_format($row['main_receipt_fee'])."";
	} else {
		$main_receipt_fee = "-";
	}
	//본사입금액 합계
	$crf = str_replace(',','',$main_receipt_fee);
	$main_receipt_fee_sum += ($crf);
	//통장입금액
	if($row['requested_amount']) {
		$requested_amount = number_format($row['requested_amount'])."";
	} else {
		$requested_amount = "-";
	}
	//통장입금액 합계
	$ra  = str_replace(',','',$requested_amount);
	$requested_amount_sum += ($ra);

	//김봉균 수수료 (vat별도)
	$lawyer_fee_rate = 0.05;
	if($row['lawyer_fee']) {
		$lawyer_fee1 = number_format($row['lawyer_fee'])."";
	} else {
		$lawyer_fee1 = "-";
	}
	//김봉균 수수료 합계
	$lf  = $row['lawyer_fee'];
	$lawyer_fee_sum += ($lf);
	//본사수입
	$main_income1 = number_format($row['main_income'])."";
	if($main_income1 == 0) $main_income1 = "-";
	//본사수입 합계
	$mi  = $row['main_income'];
	$main_income_sum += ($mi);
	//수당료 / 용역비
	if($row['allowance_rate']) {
		$allowance_rate = $row['allowance_rate']."%";
		$allowance_pay_num = $row['allowance_pay'];
		$allowance_pay = number_format($allowance_pay_num)."";
	} else {
		$allowance_rate = "-";
		$allowance_pay_num = 0;
		$allowance_pay = "-";
	}
	$allowance_pay_sum += ($allowance_pay_num);
	//거래명세서
	if($row['statement_date']) $statement_date = $row['statement_date']."";
	else $statement_date = "-";
	//세금계산서
	if($row['tax_invoice']) $tax_invoice = $row['tax_invoice']."";
	else $tax_invoice = "-";
	//사업장명
	$com_name = $row['com_name'];
	//$com_name = cut_str($com_name_full, 28, "..");
	//사업개시일
	if($row['registration_day']) $registration_day = $row['registration_day'];
	else $registration_day = "-";
	//법인 구분
	if($row['upche_div'] == "2") {
		$upche_div = "법인";
	} else {
		$upche_div = "개인";
	}
	$com_juso_full = $row['com_juso']." ".$row['com_juso2'];
	$com_juso = cut_str($com_juso_full, 18, "..");
	//사업자등록번호
	if($row['biz_no']) $biz_no = $row['biz_no'];
	else $biz_no = "-";
	//사업장관리번호
	if($row['t_insureno']) $t_insureno = $row['t_insureno'];
	else $t_insureno = "-";
	//대표자
	$boss_name_full = $row['boss_name'];
	if($row['boss_name']) $boss_name = cut_str($boss_name_full, 14, "..");
	else $boss_name = "-";
	//관리점
	$damdang_code = $row['damdang_code'];
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "-";
	//담당매니저
	$manage_cust_name = $row['manage_cust_name'];
	//담당자
	if($row['person_charge']) $person_charge = $row['person_charge']."";
	else $person_charge = "-";
	//개인계좌
	$individual_account = explode(',',$row['individual_account']);
	//갑근세
	$grade_income_tax = explode(',',$row['grade_income_tax']);
	//비고
	if($individual_account[0] == 1) $remark_text = " 개인계좌"; 
	else $remark_text = ""; 
	if($grade_income_tax[0] == 1) $remark_text .= " 갑근세"; 
	//이관
	if($row['transfer_chk']) $remark_text .= " 이관"; 
	//본사조회
	if($row['inquiry_chk']) $remark_text .= " 본사조회"; 
	//날짜 검색 제외 항목
	//echo $row['main_receipt_date']." >= ".$search_sday." / ";
	//$main_receipt_date_num  = str_replace('.','',$row['main_receipt_date']);
	//$search_sday_num  = str_replace('.','',$search_sday);
	//if( ($row['main_receipt_date'] >= $search_sday) ) echo "true";
	if(!($row['main_receipt_date'] >= $search_sday) or !($row['main_receipt_date'] <= $search_eday) or !$row['main_receipt_date']) {
		$person_charge = "";
		$application_kind = "";
		$main_receipt_date = "";
		$client_receipt_fee = "";
		$requested_amount = "";
		$main_income1 = "";
		$lawyer_fee1 = "";
		$allowance_rate = "";
		$allowance_pay = "";
		$add_not1 = 1;
	} else {
		$add_not1 = 2;
		$add_i++;
	}
	//echo $com_name." ".$add_not1;
	//지원금 1번째 표시
	if($add_not1 == 2) {
		//업무지원 선택 시 원 지원금 거래처 표시 안함
		if(!$stx_service_support_staff) {
?>
									<input type="hidden" name="no" value="<?=$i+1?>"/>
									<input type="hidden" name="com_name" value="<?=$com_name?>"/>
									<input type="hidden" name="person_charge" value="<?=$person_charge?>"/>
									<input type="hidden" name="application_kind" value="<?=$application_kind?>"/>

									<input type="hidden" name="main_receipt_date" value="<?=$main_receipt_date?>"/>
									<input type="hidden" name="client_receipt_fee" value="<?=$client_receipt_fee?>"/>
									<input type="hidden" name="p_support" value="<?=$p_support?>"/>
									<input type="hidden" name="requested_amount" value="<?=$requested_amount?>"/>
									<input type="hidden" name="main_income" value="<?=$main_income1?> "/>
									<input type="hidden" name="lawyer_fee" value="<?=$lawyer_fee1?> "/>

									<input type="hidden" name="allowance_rate" value="<?=$allowance_rate?> "/>
									<input type="hidden" name="allowance_pay" value="<?=$allowance_pay?>"/>
									<input type="hidden" name="remark_text" value="<?=$remark_text?> "/>
<?
		}
		//업무지원 존재 시 표시
		if($stx_service_support_staff && $row['service_support_staff']) {
			$service_support_pay_sum += $row['service_support_pay'];
?>
									<input type="hidden" name="no" value="<?=$i+1?>"/>
									<input type="hidden" name="com_name" value="<?=$com_name?>"/>
									<input type="hidden" name="person_charge" value="<?=$row['service_support_staff']?>"/>
									<input type="hidden" name="application_kind" value="<?=$application_kind?>"/>

									<input type="hidden" name="main_receipt_date" value="<?=$main_receipt_date?>"/>
									<input type="hidden" name="client_receipt_fee" value="<?=$client_receipt_fee?>"/>
									<input type="hidden" name="p_support" value="<?=$p_support?>"/>
									<input type="hidden" name="requested_amount" value="<?=$requested_amount?>"/>
									<input type="hidden" name="main_income" value="<?=$main_income1?> "/>
									<input type="hidden" name="lawyer_fee" value="<?=$lawyer_fee1?> "/>

									<input type="hidden" name="allowance_rate" value="<?=$row['service_support_rate']?>% "/>
									<input type="hidden" name="allowance_pay" value="<?=number_format($row['service_support_pay'])?>"/>
									<input type="hidden" name="remark_text" value="<?=$remark_text?> "/>
<?
		}
	}
	//지원금 2번째 표시
	if($add_not2 == 2) {
?>
									<input type="hidden" name="no" value="<?=$i+1?>"/>
									<input type="hidden" name="com_name" value="<?=$com_name?>"/>
									<input type="hidden" name="person_charge" value="<?=$person_charge2?>"/>
									<input type="hidden" name="application_kind" value="<?=$application_kind2?>"/>

									<input type="hidden" name="main_receipt_date" value="<?=$main_receipt_date2?>"/>
									<input type="hidden" name="client_receipt_fee" value="<?=$client_receipt_fee2?>"/>
									<input type="hidden" name="p_support" value="<?=$p_support?>"/>
									<input type="hidden" name="requested_amount" value="<?=$requested_amount2?>"/>
									<input type="hidden" name="main_income" value="<?=$main_income2?> "/>
									<input type="hidden" name="lawyer_fee" value="<?=$lawyer_fee2?> "/>

									<input type="hidden" name="allowance_rate" value="<?=$allowance_rate2?> "/>
									<input type="hidden" name="allowance_pay" value="<?=$allowance_pay2?>"/>
									<input type="hidden" name="remark_text" value="<?=$remark_text2?> "/>
<?
	}
}
//echo $i;
?>
									<input type="hidden" name="pay_count" value="<?=$i?>"/>
									<input type="hidden" name="pay_page" value="<?=$pay_page?>"/>
<?
//여분 출력 hwp control 셋팅
if($pay_page == 1) $tr_count = 24;
else if($pay_page == 2) $tr_count = 53;
else $tr_count = 53;
//echo $tr_count;
//$i_num = $add_i;
//echo $i_num;
$k_limit = $tr_count - $add_i;
for($k=0;$k<$k_limit;$k++) {
?>

									<input type="hidden" name="no" value="<?=$i+1+$k?>"/>
									<input type="hidden" name="com_name" value=" "/>
									<input type="hidden" name="person_charge" value=" "/>
									<input type="hidden" name="application_kind" value=" "/>

									<input type="hidden" name="main_receipt_date" value=" "/>
									<input type="hidden" name="client_receipt_fee" value=" "/>
									<input type="hidden" name="p_support" value=" "/>
									<input type="hidden" name="requested_amount" value=" "/>
									<input type="hidden" name="main_income" value=" "/>
									<input type="hidden" name="lawyer_fee" value=" "/>

									<input type="hidden" name="allowance_rate" value=" "/>
									<input type="hidden" name="allowance_pay" value=" "/>
									<input type="hidden" name="remark_text" value=" "/>
<?
}
?>
									<!-- 총계 -->
									<input type="hidden" name="client_receipt_fee_sum_t" value="<?=number_format($client_receipt_fee_sum)?>"/>
									<input type="hidden" name="requested_amount_sum_t" value="<?=number_format($requested_amount_sum)?>"/>
									<input type="hidden" name="main_income_sum_t" value="<?=number_format($main_income_sum)?>"/>
									<input type="hidden" name="lawyer_fee_sum_t" value="<?=number_format($lawyer_fee_sum)?>"/>
<?
	//업무지원 선택 시 원 지원금 거래처 표시 안함
	if(!$stx_service_support_staff) {
?>
									<input type="hidden" name="allowance_pay_sum_t" value="<?=number_format($allowance_pay_sum)?>"/>
<?
	} else {
?>
									<input type="hidden" name="allowance_pay_sum_t" value="<?=number_format($service_support_pay_sum)?>"/>
<?
	}
?>
									<!-- 한글 컨트롤 폼 -->
									<p style="margin-top:1px;z-index:-1;border:1px solid #ccc;width:">
										<object id="HwpCtrl" width="100%" height="860" align="center" classid="CLSID:BD9C32DE-3155-4691-8972-097D53B10052"></object>
									</p>
								</form>
							</div>

						</td>
					</tr>
				</table>

			</td>
		</tr>
	</table>			
</div>
<script language="javascript" src="js/settlement_report_print.js"></script>
</body>
</html>
