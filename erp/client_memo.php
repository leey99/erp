<?
$sub_menu = "100400";
include_once("./_common.php");
//사업장명 검색 시
if(!$stx_comp_name) {
	$sql_common = " from com_list_gy a, com_list_gy_opt b, com_list_gy_memo c ";
} else {
	$sql_common = " from com_list_gy a, com_list_gy_opt b ";
}
//echo $member[mb_profile];
if($is_admin != "super") {
	//$stx_man_cust_name = $member[mb_profile];
}
//$is_admin = "super";
//echo $is_admin;
if($member['mb_level'] > 6 || $search_ok == "ok") {
	if(!$stx_comp_name) {
		$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code ";
		//메모 삭제 제외
		$sql_search .= " and c.delete_yn != '1' ";
	} else {
		$sql_search = " where a.com_code = b.com_code ";
	}
} else {
	if(!$stx_comp_name) {
		$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code and ( a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]' ) ";
		//메모 삭제 제외
		$sql_search .= " and c.delete_yn != '1' ";
	} else {
		$sql_search = " where a.com_code = b.com_code and ( a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]' ) ";
	}
}
//검색 : 사업장명칭
if ($stx_comp_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_name like '%$stx_comp_name%') ";
	$sql_search .= " ) ";
}
//검색 : 사업장관리번호
if ($stx_t_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.t_insureno like '%$stx_t_no%') ";
	$sql_search .= " ) ";
}
//검색 : 사업자등록번호
if ($stx_biz_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.biz_no like '%$stx_biz_no%') ";
	$sql_search .= " ) ";
}
//검색 : 대표자
if ($stx_boss_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.boss_name like '%$stx_boss_name%') ";
	$sql_search .= " ) ";
}
//검색 : 전화번호
if ($stx_comp_tel) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_tel like '%$stx_comp_tel%') ";
	$sql_search .= " ) ";
}
//검색 : 계약서
if ($stx_contract) {
	if($stx_contract == "no") $stx_contract = "";
	$sql_search .= " and ( ";
	$sql_search .= " (b.chk_contract = '$stx_contract') ";
	$sql_search .= " ) ";
	$sst = "b.chk_contract_no";
	$sod = "desc";
}
//검색 : 지사
if ($stx_man_cust_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.damdang_code = '$stx_man_cust_name') ";
	$sql_search .= " ) ";
}
//검색 : 사업개시일
if ($stx_reg_day_chk) {
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
//검색2 : 계약서
if ($stx_comp_gubun3) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.chk_contract != '') ";
	$sql_search .= " ) ";
}
//검색2 : 대리인선임(공단)
if ($stx_comp_gubun4) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.agent_elect_public_edate != '') ";
	$sql_search .= " ) ";
}
//검색2 : 대리인선임(센터)
if ($stx_comp_gubun5) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.agent_elect_center_edate != '') ";
	$sql_search .= " ) ";
}
//검색2 : 이지노무
if ($stx_comp_gubun6) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.easynomu_yn != '') ";
	$sql_search .= " ) ";
}
//검색 : 지원금
if ($stx_comp_gubun7) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.p_support > 0) ";
	$sql_search .= " ) ";
}
//검색 : 환급금
if ($stx_comp_gubun8) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.p_contribution > 0) ";
	$sql_search .= " ) ";
}
//검색 : 기타
if ($stx_comp_gubun9) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.p_construction > 0) ";
	$sql_search .= " ) ";
}
//주소검색
if ($stx_addr) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_juso like '%$stx_addr%') ";
	$sql_search .= " ) ";
}
//메모 유무
if ($stx_memo) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.memo <> '') ";
	$sql_search .= " ) ";
}
//상세검색
//정년나이
if ($stx_retirement_age) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.retirement_age = '$stx_retirement_age') ";
	$sql_search .= " ) ";
}
//가족보험환급
if ($stx_refund_request) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.refund_request = '$stx_refund_request') ";
	$sql_search .= " ) ";
}
//이지노무의뢰
if ($stx_easynomu_request) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.easynomu_request REGEXP '^(1,|,){".($stx_easynomu_request-1)."}1.*$') ";
	$sql_search .= " ) ";
}
//정렬
if (!$sst) {
	if(!$stx_comp_name) {
		$sst = "c.regdt";
	} else {
		$sst = "a.com_code";
	}
	$sod = "desc";
}
//그룹바이
if(!$stx_comp_name) {
	$group_by = " group by c.com_code ";
} else {
	$group_by = "";
}
$sql_order = " order by $sst $sod ";
//카운트
if(!$stx_comp_name) {
	$sql = " select count(distinct c.com_code) as cnt $sql_common $sql_search $sql_order ";
} else {
	$sql = " select count(*) as cnt $sql_common $sql_search $sql_order ";
}
//echo $sql;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>처음</a>";

$sub_title = "거래처방문/연락";
$g4['title'] = $sub_title." : 거래처 : ".$easynomu_name;

$sql = " select *
					$sql_common
					$sql_search
					$group_by
					$sql_order
					limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 11;
//검색 파라미터 전송
$qstr  = "search_detail=".$search_detail;
$qstr .= "&stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_biz_no=".$stx_biz_no."&stx_boss_name=".$stx_boss_name."&stx_comp_tel=".$stx_comp_tel."&stx_contract=".$stx_contract."&stx_comp_gubun1=".$stx_comp_gubun1."&stx_comp_gubun2=".$stx_comp_gubun2."&stx_comp_gubun3=".$stx_comp_gubun3."&stx_comp_gubun4=".$stx_comp_gubun4."&stx_comp_gubun5=".$stx_comp_gubun5."&stx_comp_gubun6=".$stx_comp_gubun6."&stx_comp_gubun7=".$stx_comp_gubun7."&stx_comp_gubun8=".$stx_comp_gubun8."&stx_comp_gubun9=".$stx_comp_gubun9."&stx_man_cust_name=".$stx_man_cust_name."&stx_uptae=".$stx_uptae."&stx_upjong=".$stx_upjong."&search_ok=".$search_ok;
$qstr .= "&stx_addr=".$stx_addr."&stx_memo=".$stx_memo;
//상세검색
$stx_qstr  = "stx_rules_report_if=".$stx_rules_report_if."&stx_retirement_age=".$stx_retirement_age."&stx_new_fund_scale_site=".$stx_new_fund_scale_site."&stx_establish_type=".$stx_establish_type."&stx_refund_request=".$stx_refund_request."&stx_factory_split=".$stx_factory_split."&stx_extend_age=".$stx_extend_age."&stx_easynomu_request=".$stx_easynomu_request;
$stx_qstr .= "&stx_fund_type_industry=".$stx_fund_type_industry."&stx_employment_support=".$stx_employment_support."&stx_establish_proposal_if=".$stx_establish_proposal_if."&stx_multitude=".$stx_multitude."&stx_charge_progress=".$stx_charge_progress."&stx_establish_way=".$stx_establish_way."&stx_sj_if=".$stx_sj_if."&stx_handicapped_employment=".$stx_handicapped_employment;
$stx_qstr .= "&stx_disaster_if=".$stx_disaster_if."&stx_found_if=".$stx_found_if."&stx_subsidy_type_if=".$stx_found_if."&stx_factory_site_1000=".$stx_factory_site_1000."&stx_women_matriarch_if=".$stx_women_matriarch_if."&stx_found_tax=".$stx_found_tax."&stx_disaster_if=".$stx_disaster_if."&stx_job_creation_proposal=".$stx_job_creation_proposal."&stx_rule_pay=".$stx_rule_pay;
$stx_qstr .= "&stx_rural_areas=".$stx_rural_areas."&stx_pay_peak_if=".$stx_pay_peak_if."&stx_career_kind=".$stx_career_kind."&stx_fund_basic_check=".$stx_fund_basic_check."&stx_shift_system=".$stx_shift_system."&stx_local_tax_yn=".$stx_local_tax_yn."&stx_work_contract=".$stx_work_contract."&stx_fund_kind=".$stx_fund_kind."&stx_establish_request=".$stx_establish_request;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<script language="javascript">
function goSearch() {
	var frm = document.searchForm;
	frm.search_ok.value = "branch";
	frm.action = "<?=$_SERVER['PHP_SELF']?>";
	frm.submit();
	return;
}
function checkAll() {
	var f = document.dataForm;
	for( var i = 0; i<f.idx.length; i++ ) {
		f.idx[i].checked = f.checkall.checked;
	}
}
function checked_ok() {
	var frm = document.dataForm;
	var chk_cnt = document.getElementsByName("idx");
	var cnt = 0;
	var chk_data ="";

	for(i=0; i<chk_cnt.length ; i++) {
		if(frm.idx[i].checked==true) {
			cnt++;
			chk_data = chk_data + ',' + frm.idx[i].value;
		}
	}
	if(cnt==0) {
	 alert("선택된 데이터가 없습니다.");
	 return;
	} else{
		if(confirm("정말 삭제하시겠습니까?")) {
			chk_data = chk_data.substring(1, chk_data.length);
			frm.chk_data.value = chk_data;
			frm.action="client_delete.php";
			frm.submit();
		} else {
			return;
		}
	} 
}
function tab_view(tab) {
	var obj = document.getElementById(tab);
	var frm = document.searchForm;
	if(obj.style.display == "none") {
		obj.style.display = "";
		frm.search_detail.value = "ok";
	} else {
		obj.style.display = "none";
		frm.search_detail.value = "";
	}
}
//사업자번호 입력 하이픈
function checkhyphen(inputVal, type, keydown) {		// inputVal은 천단위에 , 표시를 위해 가져오는 값
	main = document.searchForm;			// 여기서 type 은 해당하는 값을 넣기 위한 위치지정 index
	var chk		= 0;				// chk 는 천단위로 나눌 길이를 check
	var chk2	= 0;
	var chk3	= 0;
	var share	= 0;				// share 200,000 와 같이 3의 배수일 때를 구분하기 위한 변수
	var start	= 0;
	var triple	= 0;				// triple 3, 6, 9 등 3의 배수 
	var end		= 0;				// start, end substring 범위를 위한 변수  
	var total	= "";			
	var input	= "";				// total 임의로 string 들을 규합하기 위한 변수
	//숫자 입력만
	//alert(event.keyCode);
	input = delhyphen(inputVal, inputVal.length);
	//관리자 master 입력
	//alert(input);
	if(1 == 1) { //모두 포함
		//탭 시프트+탭 좌 우 Home backsp
		if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
			//alert(inputVal.length);
			//alert(input);
			if(inputVal.length == 3){
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,3)+"-";
			} else if(inputVal.length == 6){
				total += inputVal.substring(0,8)+"-";
			} else if(inputVal.length == 12){
				total += inputVal.substring(0,14)+"";
			} else {
				total += inputVal;
			}
			if(keydown =='Y'){
				type.value = total;
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
}
//사업장관리번호 입력 하이픈
function checkhyphen_tno(inputVal, type, keydown) {
	main = document.searchForm;			// 여기서 type 은 해당하는 값을 넣기 위한 위치지정 index
	var chk		= 0;				// chk 는 천단위로 나눌 길이를 check
	var chk2	= 0;
	var chk3	= 0;
	var share	= 0;				// share 200,000 와 같이 3의 배수일 때를 구분하기 위한 변수
	var start	= 0;
	var triple	= 0;				// triple 3, 6, 9 등 3의 배수 
	var end		= 0;				// start, end substring 범위를 위한 변수  
	var total	= "";			
	var input	= "";				// total 임의로 string 들을 규합하기 위한 변수
	//숫자 입력만
	//alert(event.keyCode);
	input = delhyphen(inputVal, inputVal.length);
	//관리자 master 입력
	//alert(input);
	if(1 == 1) { //모두 포함
		//탭 시프트+탭 좌 우 Home backsp
		if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
			//alert(inputVal.length);
			//alert(input);
			if(inputVal.length == 3){
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,3)+"-";
			} else if(inputVal.length == 6){
				total += inputVal.substring(0,8)+"-";
			} else if(inputVal.length == 12){
				total += inputVal.substring(0,14)+"-";
			} else {
				total += inputVal;
			}
			if(keydown =='Y'){
				type.value = total;
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
}
function delhyphen(inputVal, count){
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!='-'){		// 먼저 substring을 위해
			tmp += inputVal.substring(i,i+1);	// 값의 모든 , 를 제거
		}
	}
	return tmp;
}
</script>
<?
include "inc/top.php";
?>
		<td onmouseover="showM('900')" valign="top">
			<div style="margin:10px 20px 20px 20px;min-height:480px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100"><img src="images/top01.gif" border="0"></td>
						<td width=""><img src="images/top01_04.gif" border="0"></td>
						<td>
<?
$title_main_no = "01";
include "inc/sub_menu.php";
?>
						</td>
					</tr>
					<tr><td height="1" bgcolor="#cccccc" colspan="9"></td></tr>
				</table>

				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
					<tr>
						<td valign="top" style="padding:10px 0 0 0">
							<!--타이틀 -->	
							<form name="searchForm" method="get">
								<input type="hidden" name="search_ok">
								<input type="hidden" name="search_detail" value="<?=$search_detail?>">
								<!--데이터 -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr> 
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
													검색
													</td> 
													<td><img src="images/g_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=2></td> 
										<td valign="bottom"> ※ 재연락 요청 업체가 있을 경우 "사업장명칭"으로 검색, 사업장 클릭 후 메모 내용과 재연락일을 입력하면 됩니다.</td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--검색 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrowk" width="100"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;font-weight:bold;">사업장명칭</td>
										<td nowrap class="tdrow" width="164">
											<input name="stx_comp_name" type="text" class="textfm" style="width:140px;border:2px solid red;" value="<?=$stx_comp_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk" width="116"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업자등록번호</td>
										<td nowrap class="tdrow" width="146">
											<input name="stx_biz_no" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$stx_biz_no?>" maxlength="12" onkeyup="checkhyphen(this.value, this,'Y')" onkeydown="only_number();if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk" width="94"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">대표자명</td>
										<td nowrap class="tdrow" width="116">
											<input name="stx_boss_name"  type="text" class="textfm" style="width:90px;" value="<?=$stx_boss_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk" width="70"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">계약서</td>
										<td nowrap class="tdrow" width="96">
											<select name="stx_contract" class="selectfm" onchange="">
												<option value=""  <? if($stx_contract == "")  echo "selected"; ?>>전체</option>
												<option value="1" <? if($stx_contract == "1") echo "selected"; ?>>도착</option>
												<option value="no" <? if($stx_contract == "no") echo "selected"; ?>>미도착</option>
											</select>
										</td>
<?
if($member['mb_level'] > 6) {
	//echo $stx_man_cust_name;
?>
										<td nowrap class="tdrowk" width="70"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">지사</td>
										<td nowrap class="tdrow">
											<select name="stx_man_cust_name" class="selectfm">
												<option value="">전체</option>
<?
include "inc/stx_man_cust_name.php";
?>
											</select>
										</td>
<? } ?>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업개시일</td>
										<td nowrap class="tdrow" colspan="3">
											<select name="stx_reg_day_chk" class="selectfm" onchange="">
												<option value=""  <? if($stx_reg_day_chk == "")  echo "selected"; ?>>선택</option>
												<option value="1" <? if($stx_reg_day_chk == "1") echo "selected"; ?>>전체</option>
												<option value="2" <? if($stx_reg_day_chk == "2") echo "selected"; ?>>기간선택</option>
											</select>
											<select name="search_year" class="selectfm" onChange="">
												<option value="1980" <? if(1980 == $search_year) echo "selected"; ?> >1980 이전</option>
<?
if(!$search_year) $search_year = 2013;
for($i=1981;$i<2015;$i++) {
?>
												<option value="<?=$i?>" <? if($i == $search_year) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
											</select> 년
											<select name="search_month" class="selectfm" onChange="">
<?
for($i=1;$i<13;$i++) {
	if($i < 10) $month = "0".$i;
	else $month = $i;
?>
												<option value="<?=$month?>" <? if($i == $search_month) echo "selected"; ?> ><?=$month?></option>
<?
}
?>
											</select> 월 ~
											<select name="search_year_end" class="selectfm" onChange="">
<?
if(!$search_year_end) $search_year_end = 2014;
for($i=1981;$i<2015;$i++) {
?>
												<option value="<?=$i?>" <? if($i == $search_year_end) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
											</select> 년
											<select name="search_month_end" class="selectfm" onChange="">
<?
for($i=1;$i<13;$i++) {
	if($i < 10) $month = "0".$i;
	else $month = $i;
?>
												<option value="<?=$month?>" <? if($i == $search_month_end) echo "selected"; ?> ><?=$month?></option>
<?
}
?>
											</select> 월
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">업태</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_uptae"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_uptae?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">업종</td>
										<td nowrap class="tdrow" colspan="3">
											<input name="stx_upjong"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_upjong?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">거래처구분</td>
										<td nowrap class="tdrow" colspan="5">
											<input type="checkbox" name="stx_comp_gubun1" value="1" <? if($stx_comp_gubun1 == 1) echo "checked"; ?> style="vertical-align:middle">의뢰서
											<input type="checkbox" name="stx_comp_gubun2" value="1" <? if($stx_comp_gubun2 == 1) echo "checked"; ?> style="vertical-align:middle">위탁서
											<input type="checkbox" name="stx_comp_gubun3" value="1" <? if($stx_comp_gubun3 == 1) echo "checked"; ?> style="vertical-align:middle">계약서
											<input type="checkbox" name="stx_comp_gubun4" value="1" <? if($stx_comp_gubun4 == 1) echo "checked"; ?> style="vertical-align:middle">대리인선임(공단)
											<input type="checkbox" name="stx_comp_gubun5" value="1" <? if($stx_comp_gubun5 == 1) echo "checked"; ?> style="vertical-align:middle">대리인선임(센터)
											<input type="checkbox" name="stx_comp_gubun6" value="1" <? if($stx_comp_gubun6 == 1) echo "checked"; ?> style="vertical-align:middle">이지노무
											<input type="checkbox" name="stx_comp_gubun7" value="1" <? if($stx_comp_gubun7 == 1) echo "checked"; ?> style="vertical-align:middle">지원금
											<input type="checkbox" name="stx_comp_gubun8" value="1" <? if($stx_comp_gubun8 == 1) echo "checked"; ?> style="vertical-align:middle">환급금
											<input type="checkbox" name="stx_comp_gubun9" value="1" <? if($stx_comp_gubun9 == 1) echo "checked"; ?> style="vertical-align:middle">기타
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" />메모</td>
										<td nowrap class="tdrow" colspan="3">
											<input type="checkbox" name="stx_memo" value="1" <? if($stx_memo == 1) echo "checked"; ?> style="vertical-align:middle">메모유무
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" />주소검색</td>
										<td nowrap class="tdrow">
											<input name="stx_addr"  type="text" class="textfm" style="width:140px;ime-mode:active;" value="<?=$stx_addr?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk"></td>
										<td nowrap class="tdrow" colspan="7">
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>
								<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
									<tr>
										<td align="center">
											<a href="javascript:goSearch();" target=""><img src="./images/btn_search_big.png" border="0" /></a>
											<a href="client_list.php" target=""><img src="./images/btn_customer_con_big.png" border="0" /></a>
											<a href="client_process_list.php" target=""><img src="./images/btn_receipt_con_big.png" border="0" /></a>
										</td>
									</tr>
								</table>
							</form>
							<!--댑메뉴 -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
												리스트
												</td> 
												<td><img src="images/g_tab_on_rt.gif"></td> 
											</tr> 
										</table> 
									</td> 
									<td width=2></td> 
									<td valign="bottom"></td> 
								</tr> 
							</table>
							<div style="height:2px;font-size:0px" class="bgtr"></div>
							<div style="height:2px;font-size:0px;line-height:0px;"></div>
							<!--리스트 -->
							<form name="dataForm" method="post">
								<input type="hidden" name="chk_data" />
								<input type="hidden" name="page" value="<?=$page?>" />
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:">
									<tr>
										<td class="tdhead_center" width="26" rowspan="2"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" ></td>
										<td class="tdhead_center" width="46" rowspan="2">No</td>
										<td class="tdhead_center" width="240" rowspan="2">사업장명</td>
										<td class="tdhead_center" width="110" rowspan="1">사업자등록번호</td>
										<td class="tdhead_center" width="100" rowspan="1">대표자</td>
										<td class="tdhead_center" width="110" rowspan="1">업태</td>
										<td class="tdhead_center" width="70" rowspan="1">재방문일</td>
										<td class="tdhead_center" width="" rowspan="2">메모</td>
										<td class="tdhead_center" width="90" rowspan="1">관리점</td>
									</tr>
									<tr>
										<td class="tdhead_center" width="" rowspan="1">사업장관리번호</td>
										<td class="tdhead_center" width="" rowspan="1">사업개시일</td>
										<td class="tdhead_center" width="" rowspan="1">업종</td>
										<td class="tdhead_center" width="" rowspan="1">재연락일</td>
										<td class="tdhead_center" width="" rowspan="1">담당자</td>
									</tr>
<?
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//$page
	//$total_page
	//$rows
	$no = $total_count - $i - ($rows*($page-1));
	//echo $total_count;
  $list = $i%2;
	//사업장 코드번호
	$id = $row['com_code'];
	//등록일자
	$regdt = $row['regdt'];
	if($regdt) $regdt_br = "<br>".$regdt;
	else $regdt_br = "";
	$regdt_time = $row['regdt_time'];
	$regdt_time_array = explode(" ",$row['regdt_time']);
	$regdt_time_only = $regdt_time_array[1];
	//사업장명
	$com_name_full = $row['com_name'];
	$com_name = cut_str($com_name_full, 26, "..");
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
	$com_juso = cut_str($com_juso_full, 38, "..");
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
	//사무위탁
	if($row['samu_req_yn'] == "0" || $row['samu_req_yn'] == "") {
		$samu_req = "";
	} else if($row['samu_req_yn'] == "1") {
		$samu_req = "신청";
	}
	//업태
	$uptae_full = $row['uptae'];
	if($row['uptae']) $uptae = cut_str($uptae_full, 16, "..");
	else $uptae = "-";
	//업종
	$upjong_full = $row['upjong'];
	if($row['upjong']) $upjong = cut_str($upjong_full, 16, "..");
	else $upjong = "-";
	//거래처 메모 DB
	$sql_visit = " select * from com_list_gy_memo where com_code='$row[com_code]' and visit <> '' order by idx desc limit 0, 1 ";
	$result_visit = sql_query($sql_visit);
	$row_visit=mysql_fetch_array($result_visit);
	$sql_call = " select * from com_list_gy_memo where com_code='$row[com_code]' and call_day <> '' order by idx desc limit 0, 1 ";
	$result_call = sql_query($sql_call);
	$row_call=mysql_fetch_array($result_call);
	//재방문일
	if($row_visit['visit']) {
		$visit = $row_visit['visit'];
		$visit_memo = $row_visit['memo'];
	} else {
		$visit = "-";
		$visit_memo = "-";
	}
	//재연락일
	if($row_call['call_day']) {
		$call = $row_call['call_day'];
		$call_memo = $row_call['memo'];
	} else {
		$call = "-";
		$call_memo = "-";
	}
	//메모
	if($row_visit['visit'] || $row_call['call_day']) $memo = $visit_memo."<br>".$call_memo;
	else 	$memo = $row['memo'];
	if($member['mb_level'] > 6 || $row['damdang_code'] == $member['mb_profile'] || $row['damdang_code2'] == $member['mb_profile']) {
		$com_view = "client_memo_view.php?id=$id&w=u&page=$page&$qstr&$stx_qstr";
	} else {
		$com_view = "javascript:alert('해당 거래처 정보를 열람할 권한이 없습니다.');";
	}
?>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
										<td class="ltrow1_center_h22"><?=$no?></td>
										<td class="ltrow1_left_h22" title="<?=$com_name_full?>">
											<a href="<?=$com_view?>" style="font-weight:bold"><?=$com_name?></a><?=$regdt_br?>
<?
if($stx_addr) {
?>
											<br><?=$com_juso?>
<?
}
?>
										</td>
										<td class="ltrow1_center_h22"><?=$biz_no?><br><?=$t_insureno?></td>
										<td class="ltrow1_center_h22" title="<?=$boss_name_full?>"><?=$boss_name?><br><?=$registration_day?></td>
										<td class="ltrow1_center_h22"><span title="<?=$uptae_full?>"><?=$uptae?></span><br><span title="<?=$upjong_full?>"><?=$upjong?></span></td>
										<td class="ltrow1_center_h22"><?=$visit?><br><?=$call?></td>
										<td class="ltrow1_left_h22"><?=$memo?></td>
										<td class="ltrow1_center_h22"><?=$branch?><br><?=$manage_cust_name?></td>
									</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
?>
									<tr>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
									</tr>
								</table>
								<table width="60%" align="center" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td height="40">
											<div align="center">
												<?
												$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&$stx_qstr&page=");
												echo $pagelist;
												?>
											</div>
										</td>
									</tr>
								</table>
							</form>
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
</table>
<? include "./inc/bottom.php";?>
</body>
</html>
