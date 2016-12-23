<?
$sub_menu = "100100";
include_once("./_common.php");

//현재 년도
$year_now = date("Y");

$sql_common = " from com_list_gy a, com_list_gy_opt b ";

//echo $member[mb_profile];
if($is_admin != "super") {
	//$stx_man_cust_name = $member[mb_profile];
}
//$is_admin = "super";
//echo $is_admin;
if($is_admin == "super" || $search_ok == "ok") {
	$sql_search = " where a.com_code = b.com_code ";
} else {
	$sql_search = " where a.com_code = b.com_code and a.damdang_code='$member[mb_profile]' ";
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
//검색 : 처리현황
if ($stx_proxy) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.proxy = '$stx_proxy') ";
	$sql_search .= " ) ";
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
//검색 : 위탁서
if ($stx_comp_gubun2) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.samu_receive_date != '') ";
	$sql_search .= " ) ";
}
//검색 : 대리인선임(공단)
if ($stx_comp_gubun3) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.agent_elect_public_edate != '') ";
	$sql_search .= " ) ";
}
//검색 : 대리인선임(센터)
if ($stx_comp_gubun4) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.agent_elect_center_edate != '') ";
	$sql_search .= " ) ";
}
//검색 : 이지노무
if ($stx_comp_gubun5) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.easynomu_yn = '1') ";
	$sql_search .= " ) ";
}
//상세검색
//정년나이
if ($retirement_age) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.retirement_age = '$retirement_age') ";
	$sql_search .= " ) ";
}
//정렬
if (!$sst) {
	$sst = "a.com_code";
	$sod = "desc";
}
$sql_order = " order by $sst $sod ";
//카운트
$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>처음</a>";

$sub_title = "거래처검색";
$g4[title] = $sub_title." : 거래처 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);

$colspan = 8;
//검색 파라미터 전송
$qstr = "stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_biz_no=".$stx_biz_no."&stx_boss_name=".$stx_boss_name."&stx_comp_tel=".$stx_comp_tel."&stx_proxy=".$stx_proxy."&stx_comp_gubun1=".$stx_comp_gubun1."&stx_comp_gubun2=".$stx_comp_gubun2."&stx_comp_gubun3=".$stx_comp_gubun3."&stx_comp_gubun4=".$stx_comp_gubun4."&stx_comp_gubun5=".$stx_comp_gubun5."&stx_comp_gubun6=".$stx_comp_gubun6."&stx_man_cust_name=".$stx_man_cust_name."&search_ok=".$search_ok;
//상세검색
$qstr .= "&rules_report_if=".$rules_report_if."&retirement_age=".$retirement_age."&new_fund_scale_site=".$new_fund_scale_site."&establish_type=".$establish_type."&refund_request=".$refund_request."&factory_split=".$factory_split."&extend_age=".$extend_age."&easynomu_request=".$easynomu_request;
$qstr .= "&fund_type_industry=".$fund_type_industry."&employment_support=".$employment_support."&establish_proposal_if=".$establish_proposal_if."&multitude=".$multitude."&charge_progress=".$charge_progress."&establish_way=".$establish_way."&sj_if=".$sj_if."&handicapped_employment=".$handicapped_employment;
$qstr .= "&disaster_if=".$disaster_if."&found_if=".$found_if."&subsidy_type_if=".$found_if."&factory_site_1000=".$factory_site_1000."&women_matriarch_if=".$women_matriarch_if."&found_tax=".$found_tax."&disaster_if=".$disaster_if."&job_creation_proposal=".$job_creation_proposal."&rule_pay=".$rule_pay;
$qstr .= "&rural_areas=".$rural_areas."&pay_peak_if=".$pay_peak_if."&career_kind=".$career_kind."&fund_basic_check=".$fund_basic_check."&shift_system=".$shift_system."&local_tax_yn=".$local_tax_yn."&work_contract=".$work_contract."&fund_kind=".$fund_kind."&establish_request=".$establish_request;
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
<?
if($is_admin != "super") {
?>
	if(frm.stx_comp_name.value == "" && frm.stx_biz_no.value == "" && frm.stx_boss_name.value == "") {
		alert("사업장명을 입력하세요.");
		frm.stx_comp_name.focus();
		return;
	}
	if(frm.stx_biz_no.value == "" && frm.stx_boss_name.value == "") {
		//alert(frm.stx_comp_name.value.length);
		if(frm.stx_comp_name.value.length < 2) {
			alert("사업장명을 2자 이상 입력하세요.");
			frm.stx_comp_name.focus();
			return;
		}
	}
	if(frm.stx_comp_name.value == "" && frm.stx_boss_name.value == "") {
		if(frm.stx_biz_no.value.length < 12) {
			alert("사업자등록번호 12자리를 입력하세요.");
			frm.stx_biz_no.focus();
			return;
		}
	}
	if(frm.stx_comp_name.value == "" && frm.stx_biz_no.value == "") {
		if(frm.stx_boss_name.value.length < 2) {
			alert("대표자명을 2자 이상 입력하세요.");
			frm.stx_boss_name.focus();
			return;
		}
	}
<?
}
?>
	frm.search_ok.value = "ok";
	frm.action = "<?=$_SERVER['PHP_SELF']?>";
	frm.submit();
	return;
}
function goSearch_branch() {
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
function only_number_hyphen() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if(event.keyCode != 45) event.returnValue = false;
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
//사업자번호 입력 하이픈
function checkhyphen(inputVal, type, keydown) {
	main = document.searchForm;
	var chk		= 0;
	var chk2	= 0;
	var chk3	= 0;
	var share	= 0;
	var start	= 0;
	var triple	= 0;
	var end		= 0;
	var total	= "";			
	var input	= "";
	input = delhyphen(inputVal, inputVal.length);
	if(1 == 1) {
		if(event.keyCode != 8) {
			if(inputVal.length == 3){
				total += input.substring(0,3)+"-";
			} else if(inputVal.length == 6){
				total += inputVal.substring(0,8)+"-";
			} else if(inputVal.length == 12){
				total += inputVal.substring(0,14)+"";
			} else {
				total += inputVal;
			}
			if(keydown =='Y'){
				type.value=total;
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
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
									<td width=""><img src="images/top01_03.gif" border="0"></td>
									<td></td>
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
													<td valign="bottom"></td> 
												</tr> 
											</table>
											<div style="height:2px;font-size:0px" class="bgtr"></div>
											<div style="height:2px;font-size:0px;line-height:0px;"></div>
											<!--검색 -->
											<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
												<tr>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업장명칭<font color="red">*</font></td>
													<td nowrap class="tdrow">
														<input name="stx_comp_name" type="text" class="textfm" style="width:120px;" value="<?=$stx_comp_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
													</td>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업자등록번호<font color="red">*</font></td>
													<td nowrap class="tdrow">
														<input name="stx_biz_no" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$stx_biz_no?>" maxlength="12" onkeyup="checkhyphen(this.value, this,'Y')" onkeydown="only_number();if(event.keyCode == 13){ goSearch(); }">
													</td>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">대표자명<font color="red">*</font></td>
													<td nowrap class="tdrow">
														<input name="stx_boss_name"  type="text" class="textfm" style="width:90px;" value="<?=$stx_boss_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
													</td>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">진행사항</td>
													<td nowrap class="tdrow">
														<select name="stx_proxy" class="selectfm" onchange="">
															<option value=""  <? if($stx_proxy == "")  echo "selected"; ?>>전체</option>
															<option value="1" <? if($stx_proxy == "1") echo "selected"; ?>>접수</option>
															<option value="2" <? if($stx_proxy == "2") echo "selected"; ?>>처리중</option>
															<option value="3" <? if($stx_proxy == "3") echo "selected"; ?>>완료</option>
														</select>
													</td>
<?
if($is_admin == "super") {
	//echo $stx_man_cust_name;
?>
													<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">지사</td>
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
													<td nowrap class="tdrow" colspan="9">
														<select name="stx_reg_day_chk" class="selectfm" onchange="">
															<option value=""  <? if($stx_reg_day_chk == "")  echo "selected"; ?>>선택</option>
															<option value="1" <? if($stx_reg_day_chk == "1") echo "selected"; ?>>전체</option>
															<option value="2" <? if($stx_reg_day_chk == "2") echo "selected"; ?>>기간선택</option>
														</select>
														<select name="search_year" class="selectfm" onChange="">
															<option value="1980" <? if(1980 == $search_year) echo "selected"; ?> >1980 이전</option>
<?
if(!$search_year) $search_year = 2013;
for($i=1981;$i<=$year_now;$i++) {
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
if(!$search_year_end) $search_year_end = $year_now;
for($i=1981;$i<=$year_now;$i++) {
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
												</tr>
											</table>
											<div style="height:10px;font-size:0px;line-height:0px;"></div>
											<div id="request" style="<? if(!$search_detail) echo "display:none"; ?>">
											<!--댑메뉴 -->
											<table border=0 cellspacing=0 cellpadding=0> 
												<tr>
													<td id=""> 
														<table border=0 cellpadding=0 cellspacing=0> 
															<tr> 
																<td><img src="images/sb_tab_on_lt.gif"></td> 
																<td background="images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
																	상세검색
																</td> 
																<td><img src="images/sb_tab_on_rt.gif"></td> 
															</tr> 
														</table> 
													</td> 
													<td width=6></td> 
													<td valign="middle"></td> 
												</tr> 
											</table>
											<div style="height:2px;font-size:0px" class="bbtr"></div>
											<div style="height:2px;font-size:0px;line-height:0px;"></div>
<? include "./inc/client_search_detail.php";?>
											</div>
											<div style="height:10px;font-size:0px;line-height:0px;"></div>
											<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
												<tr>
													<td align="center">
														<a href="javascript:goSearch();" target=""><img src="./images/btn_search_big.png" border="0"></a>
														<!--<a href="javascript:tab_view('request');" target=""><img src="./images/btn_detail_search_big.png" border="0"></a>-->
													</td>
												</tr>
											</table>
										</form>
										<div style="height:10px;font-size:0px"></div>

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
										<!--댑메뉴 -->
<?
//검색 후 리스트 표시
if($search_ok == "ok" || $search_ok == "branch") {
?>
										<!--리스트 -->
										<form name="dataForm" method="post">
											<input type="hidden" name="chk_data">
											<input type="hidden" name="page" value="<?=$page?>">
											<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
												<tr>
													<td class="tdhead_center" width="26"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" ></td>
													<td class="tdhead_center" width="46">No</td>
<?
//본사 기업지원과 권한(본사 전체) 160519
if($member['mb_level'] > 6) {
?>
													<td class="tdhead_center" width="100">관리점</td>
													<td class="tdhead_center" width="80">담당자</td>
<?
}
?>
													<td class="tdhead_center">사업장명</td>
													<td class="tdhead_center" width="140">주소</td>
													<td class="tdhead_center" width="92">사업자등록번호</td>
													<td class="tdhead_center" width="100">대표자</td>
													<td class="tdhead_center" width="110">업태</td>
													<td class="tdhead_center" width="170">업종</td>
												</tr>
<?
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//사업장 옵션 DB
	$sql_opt = " select * from com_list_gy_opt where com_code='$row[com_code]' ";
	$result_opt = sql_query($sql_opt);
	$row_opt=mysql_fetch_array($result_opt);
	//$page
	//$total_page
	//$rows

	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;

	$id = $row['com_code'];
	//사업장명
	$com_name_full = $row['com_name'];
	$com_name = cut_str($com_name_full, 28, "..");
	//주소
	$com_juso_full = $row['com_juso'];
	$com_juso = cut_str($com_juso_full, 28, "..");
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
	//본사, 지사 주소 표시 구분 160519
	if($member['mb_level'] > 6) $com_juso = $com_juso_full;
	else $com_juso = cut_str($com_juso_full, 18, "..");
	//사업자등록번호
	if($row['biz_no']) $biz_no = $row['biz_no'];
	else $biz_no = "-";
	//사업장관리번호
	if($row['t_insureno']) $t_insureno = $row['t_insureno'];
	else $t_insureno = "-";
	//대표자
	if($row['boss_name']) $boss_name = $row['boss_name'];
	else $boss_name = "-";
	//관리점
	$damdang_code = $row['damdang_code'];
	if($damdang_code) {
		$branch = $man_cust_name_arry[$damdang_code];
		if($row['damdang_code2']) {
			$damdang_code2 = $row['damdang_code2'];
			$branch .= ">".$man_cust_name_arry[$damdang_code2];
		}
	} else {
		$branch = "-";
	}
	//담당매니저
	$manage_cust_name = $row['manage_cust_name'];
	//사무위탁
	if($row_opt['samu_req_yn'] == "0" || $row_opt['samu_req_yn'] == "") {
		$samu_req = "";
	} else if($row_opt['samu_req_yn'] == "1") {
		$samu_req = "신청";
	}
	//업태
	if($row['uptae']) $uptae = $row['uptae'];
	else $uptae = "-";
	//업종
	if($row['upjong']) $upjong = cut_str($row['upjong'], 26, "..");
	else $upjong = "-";
	//의뢰서
	if($row['editdt']) $editdt = $row['editdt'];
	else $editdt = "-";
	//위탁서
	if($row['samu_receive_date']) $samu_receive_date = $row['samu_receive_date'];
	else $samu_receive_date = "-";
	//사무위탁수임
	$samu_req_yn_array = Array("","타수임","반려","완료");
	$samu_req_yn_code = $row['samu_req_yn'];
	if($row['samu_req_yn']) $samu_req_yn = $samu_req_yn_array[$samu_req_yn_code];
	else $samu_req_yn = "-";
	if($row['samu_req_date']) $samu_req_date = $row['samu_req_date'];
	else $samu_req_date = "-";
	//대리인(공단)
	if($row['agent_elect_public_edate']) $agent_elect_public_edate = $row['agent_elect_public_edate'];
	else $agent_elect_public_edate = "-";
	//대리인(공단)
	if($row['agent_elect_center_edate']) $agent_elect_center_edate = $row['agent_elect_center_edate'];
	else $agent_elect_center_edate = "-";
	//진행사항
	if($row['editdt']) $p_accept = "의뢰서접수";
	else $p_accept = "-";
	if($row['samu_receive_date']) $p_accept = "위탁서접수";
	if($row['samu_req_date']) $p_accept = "사무위탁수임";
	if($row['agent_elect_public_edate']) $p_accept = "대리인(공단)";
	if($row['agent_elect_center_edate']) $p_accept = "대리인(센터)";
	//수수료 : 지원금, 부담금, 건설
	$p_support = $row_opt['p_support']."%";
	$p_contribution = $row_opt['p_contribution']."%";
	$p_construction = $row_opt['p_construction']."%";
	if($p_support == "0%") $p_support = "";
	if($p_contribution == "0%") $p_contribution = "";
	if($p_construction == "0%") $p_construction = "";
	//위임장
	if($row_opt[proxy] == "1") {
		$proxy = "○";
	} else {
		$proxy = "";
	}
	//취업규칙
	if($row_opt[employment] > 0) {
		$employment = number_format($row_opt[employment]);
	} else {
		$employment = "";
	}
	if($is_admin == "super" || $row['damdang_code'] == $member['mb_profile']) {
		$com_view = "client_view.php?id=$id&w=u&$qstr&page=$page";
	} else {
		$com_view = "javascript:alert('해당 거래처 정보를 열람할 권한이 없습니다.');";
	}
?>
												<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
													<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
													<td class="ltrow1_center_h22"><?=$no?></td>
<?
if($member['mb_level'] > 6) {
?>
													<td class="ltrow1_center_h22"><?=$branch?></td>
													<td class="ltrow1_center_h22"><?=$manage_cust_name?></td>
<?
}
?>
													<td class="ltrow1_left_h22" title="<?=$com_name_full?>">
														<span style="font-weight:bold"><?=$com_name_full?></span>
													</td>
													<td class="ltrow1_left_h22" title=""><?=$com_juso?></td>
													<td class="ltrow1_center_h22"><?=$biz_no?></td>
													<td class="ltrow1_center_h22"><?=$boss_name?></td>
													<td class="ltrow1_center_h22"><?=$uptae?></td>
													<td class="ltrow1_left_h22"><?=$upjong?></td>
												</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
?>
												<tr>
													<td class="tdhead_center"></td>
													<td class="tdhead_center"></td>
<?
if($member['mb_level'] > 6) {
?>
													<td class="tdhead_center"></td>
													<td class="tdhead_center"></td>
<?
}
?>
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
															$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
															echo $pagelist;
															?>
														</div>
													</td>
												</tr>
											</table>
<? } else { ?>
											<table width="60%" align="center" border="0" cellpadding="0" cellspacing="0">
												<tr>
													<td height="40">
														<div align="center">
															검색 후 리스트가 표시 됩니다.
														</div>
													</td>
												</tr>
											</table>
<? } ?>
											<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
												<tr>
													<td align="center">

													</td>
												</tr>
											</table>

										</form>
									</td>
								</tr>
							</table>
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
