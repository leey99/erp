<?
$sub_menu = "100500";
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
if($member['mb_level'] > 6 || $search_ok == "ok") {
	$sql_search = " where a.com_code = b.com_code ";
} else {
	$sql_search = " where a.com_code = b.com_code and ( a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]' ) ";
}
//기본 검색 : 대표자 HP 존재 여부
if(!$stx_boss_hp) $sql_search .= " and a.boss_hp != '' ";
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
//검색 : 담당자
if($stx_manage_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.manage_cust_name like '%$stx_manage_name%') ";
	$sql_search .= " ) ";
}
//검색 : 사업장관리번호
if($stx_t_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.t_insureno like '%$stx_t_no%') ";
	$sql_search .= " ) ";
}
//검색 : 전화번호
if ($stx_comp_tel) {
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
//검색 : 대표자HP
if ($stx_boss_hp) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.boss_hp like '%$stx_boss_hp%') ";
	$sql_search .= " ) ";
}
//검색 : 지사
if ($stx_man_cust_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.damdang_code = '$stx_man_cust_name') ";
	$sql_search .= " ) ";
}
//검색 : 열람
if($stx_man_cust_name2) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.damdang_code2 = '$stx_man_cust_name2') ";
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
//검색 : 위탁번호 여부 (사무위탁업체)
if ($stx_samu_receive_no_search) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.samu_receive_no != '') ";
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
//지역별검색
if($stx_area1 || $stx_area2 || $stx_area3 || $stx_area4 || $stx_area5 || $stx_area6 || $stx_area7 || $stx_area8 || $stx_area9 || $stx_area10 || $stx_area11 || $stx_area12 || $stx_area13 || $stx_area14 || $stx_area15 || $stx_area16 || $stx_area17) $sql_search .= " and ( ";
if($stx_area_not) {
	$area_not = "not";
	$area_or_var = "and";
} else {
	$area_not = "";
	$area_or_var = "or";
}
$area_or = "";
if($stx_area1) {
	$sql_search .= " (a.com_juso $area_not like '서울%') ";
	$area_or = $area_or_var;
}
if($stx_area2) {
	$sql_search .= " $area_or (a.com_juso $area_not like '부산%') ";
	$area_or = $area_or_var;
}
if($stx_area3) {
	$sql_search .= " $area_or (a.com_juso $area_not like '인천%') ";
	$area_or = $area_or_var;
}
if($stx_area4) {
	$sql_search .= " $area_or (a.com_juso $area_not like '대구%') ";
	$area_or = $area_or_var;
}
if($stx_area5) {
	$sql_search .= " $area_or (a.com_juso $area_not like '대전%') ";
	$area_or = $area_or_var;
}
if($stx_area6) {
	$sql_search .= " $area_or (a.com_juso $area_not like '광주%') ";
	$area_or = $area_or_var;
}
if($stx_area7) {
	$sql_search .= " $area_or (a.com_juso $area_not like '울산%') ";
	$area_or = $area_or_var;
}
if($stx_area8) {
	$sql_search .= " $area_or (a.com_juso $area_not like '경기%') ";
	$area_or = $area_or_var;
}
if($stx_area9) {
	$sql_search .= " $area_or (a.com_juso $area_not like '경북%' $area_or_var a.com_juso $area_not like '경상북도%') ";
	$area_or = $area_or_var;
}
if($stx_area10) {
	$sql_search .= " $area_or (a.com_juso $area_not like '경남%' $area_or_var a.com_juso $area_not like '경상남도%') ";
	$area_or = $area_or_var;
}
if($stx_area11) {
	$sql_search .= " $area_or (a.com_juso $area_not like '전북%' $area_or_var a.com_juso $area_not like '전라북도%') ";
	$area_or = $area_or_var;
}
if($stx_area12) {
	$sql_search .= " $area_or (a.com_juso $area_not like '전남%' $area_or_var a.com_juso $area_not like '전라남도%') ";
	$area_or = $area_or_var;
}
if($stx_area13) {
	$sql_search .= " $area_or (a.com_juso $area_not like '충북%' $area_or_var a.com_juso $area_not like '충청북도%') ";
	$area_or = $area_or_var;
}
if($stx_area14) {
	$sql_search .= " $area_or (a.com_juso $area_not like '충남%' $area_or_var a.com_juso $area_not like '충청남도%') ";
	$area_or = $area_or_var;
}
if($stx_area15) {
	$sql_search .= " $area_or (a.com_juso $area_not like '강원%') ";
	$area_or = $area_or_var;
}
if($stx_area16) {
	$sql_search .= " $area_or (a.com_juso $area_not like '제주%') ";
	$area_or = $area_or_var;
}
if($stx_area17) {
	$sql_search .= " $area_or (a.com_juso $area_not like '세종%') ";
}
if($stx_area1 || $stx_area2 || $stx_area3 || $stx_area4 || $stx_area5 || $stx_area6 || $stx_area7 || $stx_area8 || $stx_area9 || $stx_area10 || $stx_area11 || $stx_area12 || $stx_area13 || $stx_area14 || $stx_area15 || $stx_area16 || $stx_area17) $sql_search .= " ) ";
//인원검색
if(!$stx_scount && $stx_ecount) $stx_scount = 0;
if ($stx_scount != "" || $stx_scount == 0) {
	$sql_search .= " and ( ";
	$sql_search .= " (cast(b.persons AS signed) >= '$stx_scount') ";
	if ($stx_ecount) $sql_search .= " and (cast(b.persons AS signed) <= '$stx_ecount') ";
	$sql_search .= " ) ";
}
//업종분류검색
if($stx_industry1 || $stx_industry2 || $stx_industry3 || $stx_industry4 || $stx_industry5 || $stx_industry6 || $stx_industry7 || $stx_industry8 || $stx_industry9 || $stx_industry10 || $stx_industry11 || $stx_industry99) {
	$sql_search .= " and ( ";
}
if($stx_industry_not) {
	$industry_not = "not";
	$industry_or_var = "and";
} else {
	$industry_not = "";
	$industry_or_var = "or";
}
$industry_or = "";
if($stx_industry1) {
	$sql_search .= " (a.uptae $industry_not like '%제조%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry2) {
	$sql_search .= " $industry_or (a.uptae like '%서비스%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry3) {
	$sql_search .= " $industry_or (a.uptae like '%건설%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry4) {
	$sql_search .= " $industry_or (a.uptae $industry_not like '%보육시설%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry5) {
	$sql_search .= " $industry_or (a.uptae $industry_not like '%사회복지%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry6) {
	$sql_search .= " $industry_or (a.uptae $industry_not like '%교육%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry7) {
	$sql_search .= " $industry_or (a.uptae $industry_not like '%의료%' $industry_or_var a.uptae $industry_not like '%제약%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry8) {
	$sql_search .= " $industry_or (a.uptae $industry_not like '%도매%' $industry_or_var a.uptae $industry_not like '%소매%' $industry_or_var a.uptae $industry_not like '%유통%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry9) {
	$sql_search .= " $industry_or (a.uptae $industry_not like '%디자인%' $industry_or_var a.uptae $industry_not like '%출판%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry10) {
	$sql_search .= " $industry_or (a.uptae $industry_not like '%음식점%' $industry_or_var a.uptae $industry_not like '%숙박%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry11) {
	$sql_search .= " $industry_or (a.uptae $industry_not like '%기관%' $industry_or_var a.uptae $industry_not like '%협회%' $industry_or_var a.uptae $industry_not like '%단체%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry99) {
	if(!$industry_not) $sql_search .= " $industry_or (a.uptae = '' $industry_or_var a.uptae = '-') ";
	else $sql_search .= " $industry_or (a.uptae != '' $industry_or_var a.uptae != '-') ";
}
if($stx_industry1 || $stx_industry2 || $stx_industry3 || $stx_industry4 || $stx_industry5 || $stx_industry6 || $stx_industry7 || $stx_industry8 || $stx_industry9 || $stx_industry10 || $stx_industry11 || $stx_industry99) $sql_search .= " ) ";
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

$sub_title = "문자메세지발송";
$g4[title] = $sub_title." : 거래처 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 17;
//검색 파라미터 전송
$qstr  = "search_detail=".$search_detail;
$qstr .= "&amp;stx_comp_name=".$stx_comp_name."&amp;stx_t_no=".$stx_t_no."&amp;stx_biz_no=".$stx_biz_no."&amp;stx_boss_name=".$stx_boss_name."&amp;stx_comp_tel=".$stx_comp_tel."&amp;stx_comp_fax=".$stx_comp_fax."&amp;stx_boss_hp=".$stx_boss_hp."&amp;stx_comp_gubun1=".$stx_comp_gubun1."&amp;stx_comp_gubun2=".$stx_comp_gubun2."&amp;stx_comp_gubun3=".$stx_comp_gubun3."&amp;stx_comp_gubun4=".$stx_comp_gubun4."&amp;stx_comp_gubun5=".$stx_comp_gubun5."&amp;stx_comp_gubun6=".$stx_comp_gubun6."&amp;stx_comp_gubun7=".$stx_comp_gubun7."&amp;stx_comp_gubun8=".$stx_comp_gubun8."&amp;stx_comp_gubun9=".$stx_comp_gubun9."&amp;stx_man_cust_name=".$stx_man_cust_name."&amp;stx_man_cust_name2=".$stx_man_cust_name2."&amp;stx_uptae=".$stx_uptae."&amp;stx_upjong=".$stx_upjong."&amp;search_ok=".$search_ok;
$qstr .= "&amp;stx_biz_no_input_not=".$stx_biz_no_input_not."&amp;stx_t_no_input_not=".$stx_t_no_input_not."&amp;stx_samu_receive_no_search=".$stx_samu_receive_no_search."&amp;stx_area1=".$stx_area1."&amp;stx_area2=".$stx_area2."&amp;stx_area3=".$stx_area3."&amp;stx_area4=".$stx_area4."&amp;stx_area5=".$stx_area5."&amp;stx_area6=".$stx_area6."&amp;stx_area7=".$stx_area7."&amp;stx_area8=".$stx_area8."&amp;stx_area9=".$stx_area9."&amp;stx_area10=".$stx_area10."&amp;stx_area11=".$stx_area11."&amp;stx_area12=".$stx_area12."&amp;stx_area13=".$stx_area13."&amp;stx_area14=".$stx_area14."&amp;stx_area15=".$stx_area15."&amp;stx_area16=".$stx_area16."&amp;stx_area17=".$stx_area17."&amp;stx_area_not=".$stx_area_not;
$qstr .= "&amp;stx_addr=".$stx_addr."&amp;stx_addr_first=".$stx_addr_first."&amp;stx_manage_name=".$stx_manage_name."&amp;stx_scount=".$stx_scount."&amp;stx_ecount=".$stx_ecount."&amp;stx_industry1=".$stx_industry1."&amp;stx_industry2=".$stx_industry2."&amp;stx_industry3=".$stx_industry3."&amp;stx_industry4=".$stx_industry4."&amp;stx_industry5=".$stx_industry5."&amp;stx_industry6=".$stx_industry6."&amp;stx_industry7=".$stx_industry7."&amp;stx_industry8=".$stx_industry8."&amp;stx_industry9=".$stx_industry9."&amp;stx_industry10=".$stx_industry10."&amp;stx_industry11=".$stx_industry11."&amp;stx_industry99=".$stx_industry99."&amp;stx_industry_not=".$stx_industry_not;
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
//전체 선택
function check_All() {
	var f = document.dataForm;
	var cnt = 0;
	var id = "";
	//alert(f.checkall.checked);
	f.hp_all.checked = false;
	f.to_hp.value = "";
	for( var i = 0; i<f.idx.length-1; i++ ) {
		f.idx[i].checked = f.checkall.checked;
		id = f.idx[i].value;
		if(i > 0) line_feed = "\n"
		else line_feed = "";
		f.to_hp.value += line_feed + getId('hp_'+id).childNodes[0].nodeValue;
	}
	if(f.checkall.checked) {
		getId('to_count').innerHTML = i+"건";
		f.to_cnt.value = i;
	} else {
		getId('to_count').innerHTML = "0건";
		f.to_cnt.value = 0;
		f.to_hp.value = "";
	}
}
//개별 선택
function check_sms(obj) {
	var f = document.dataForm;
	var cnt = parseInt(f.to_cnt.value);
	var id = "";
	var line_feed = "";
	f.hp_all.checked = false;
	if(obj.checked) {
		getId('to_count').innerHTML = (cnt+1)+"건";
		f.to_cnt.value = cnt+1;
	} else {
		getId('to_count').innerHTML = (cnt-1)+"건";
		f.to_cnt.value = cnt-1;
	}
	//수신 휴대폰 번호 초기화
	f.to_hp.value = "";
	var m = 0;
	for( var i = 0; i<f.idx.length-1; i++ ) {
		id = f.idx[i].value;
		if(f.idx[i].checked) {
			if(m > 0) line_feed = "\n"
			else line_feed = "";
			m++;
			f.to_hp.value += line_feed + getId('hp_'+id).childNodes[0].nodeValue;
		}
	}
}
//휴대폰번호 전체선택
function hp_all_func(obj,cnt) {
	var f = document.dataForm;
	f.checkall.checked = false;
	for( var i = 0; i<f.idx.length-1; i++ ) {
		f.idx[i].checked = false;
	}
	if(obj.checked) {
		f.to_hp.value = f.to_hp_all.value;
		getId('to_count').innerHTML = cnt+"건";
	} else {
		f.to_hp.value = "";
		getId('to_count').innerHTML = "0건";
	}
}
//문자발송
function sms_send() {
	//alert("문자발송 서비스는 관리자 승인 후 이용 가능합니다.");
	//return;
	var frm = document.dataForm;
	if (frm.chk1.value == "") {
		alert("문자 내용을 입력하세요.");
		frm.chk1.focus();
		return;
	}
	if (frm.to_sms.value == "") {
		alert("발신자 번호를 입력하세요.");
		frm.to_sms.focus();
		return;
	}
	if (frm.to_hp.value == "") {
	 alert("선택된 사업장이 없습니다.");
	 return;
	} else{
		if(confirm("정말 문자 발송 하시겠습니까?")) {

			frm.action="client_sms_update.php";
			frm.submit();
		} else {
			return;
		}
	} 
}
//문자선택
function select_sms_func(select_sms_var) {
	var frm = document.dataForm;
	if(select_sms_var == 1) sms_text = "[한국기업경영원] 전기요금 컨설팅 안내";
	else if(select_sms_var == 2) sms_text = "[한국기업경영원] 시간선택제 지원사업";
	else if(select_sms_var == 3) sms_text = "[한국기업경영원] 이지노무 프로그램";
	else if(select_sms_var == 4) sms_text = "[한국기업경영원] 키즈노무 프로그램";
	else if(select_sms_var == 5) sms_text = "[한국기업경영원] 사업주훈련 지원금";
	else sms_text = "";
	frm.chk1.value = sms_text;
	displayBytes(80,'chk1');
}
//문자 80byte 체크
function displayBytes( sz, id ) {
	var form= document.dataForm;
	var obj = document.getElementById( id );
	if(obj.value.bytes() > sz) {
		if(event.keyCode != '8') {
			alert( sz+'자까지 입력이 가능합니다.');
			obj_value = obj.value;
			obj.value = cutStr(obj_value, sz+1);
		}
		obj.value = obj.value.substring(0, obj.value.length - 1);
	}
	getId(id+'_bytes').value = form[id].value.bytes()+"자";
}
String.prototype.bytes = function() {
	var str = this;
	var l = 0;
	for(var i=0; i<str.length; i++) l += (str.charCodeAt(i) > 128) ? 2 : 1;
	return l;
}
//문자열 바이트로 자르기
function cutStr(str, limit) {
	var retstr = '';
	var strlength = 0;
	var character = '';
	for(var i = 0; i < str.length; i++) {
		character = str.charAt(i);
		strlength += chk_byte(character);
		if(strlength > limit) {
			retstr += '';
			break;
		} else {
			retstr += character;
		}
	}
	return retstr;
} 
function chk_byte(character) { 
	if(escape(character).length > 4) return 2; 
	else return 1;
}
function checked_ok() {
	var frm = document.dataForm;
	var chk_cnt = document.getElementsByName("idx");
	var cnt = 0;
	var chk_data ="";

	for(i=0; i<chk_cnt.length-1 ; i++) {
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
		<td onmouseover="showM('900')" valign="top" style="padding:10px 20px 20px 20px;min-height:480px;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="100"><img src="images/top01.gif" border="0"></td>
					<td width=""><a href="<?=$_SERVER['PHP_SELF']?>"><img src="images/top01_05.gif" border="0"></a></td>
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
							<input type="hidden" name="search_ok" />
							<input type="hidden" name="search_detail" value="<?=$search_detail?>" />
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
									<td nowrap class="tdrowk" width="80"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업장명</td>
									<td nowrap class="tdrow"  width="170">
										<input name="stx_comp_name" type="text" class="textfm" style="width:160px;" value="<?=$stx_comp_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk" width="104"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업자등록번호</td>
									<td nowrap class="tdrow">
										<input name="stx_biz_no" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$stx_biz_no?>" maxlength="12" onkeyup="checkhyphen(this.value, this,'Y')" onkeydown="only_number();if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">대표자명</td>
									<td nowrap class="tdrow">
										<input name="stx_boss_name"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_boss_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">대표자HP</td>
									<td nowrap class="tdrow">
										<input name="stx_boss_hp"  type="text" class="textfm" style="width:90px;ime-mode:disabled;" value="<?=$stx_boss_hp?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
<?
if($member['mb_level'] > 6) {
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
<? } else { ?>
									<td nowrap class="tdrowk"></td>
									<td nowrap class="tdrow">
									</td>
<? } ?>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">담당자</td>
									<td nowrap class="tdrow">
										<input name="stx_manage_name" type="text" class="textfm" style="width:120px;" value="<?=$stx_manage_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">사업장관리번호</td>
									<td nowrap class="tdrow">
										<input name="stx_t_no" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$stx_t_no?>" maxlength="14" onkeyup="checkhyphen_tno(this.value, this,'Y')" onkeydown="only_number();if(event.keyCode == 13){ goSearch(); }">
										<input type="checkbox" name="stx_t_no_input_not" value="1" <? if($stx_t_no_input_not == 1) echo "checked"; ?> style="vertical-align:middle">미등록
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">위탁거래처</td>
									<td nowrap class="tdrow" colspan="">
										<input type="checkbox" name="stx_samu_receive_no_search" value="1" <? if($stx_samu_receive_no_search == 1) echo "checked"; ?> style="vertical-align:middle;" title="">사무위탁
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">전화번호</td>
									<td nowrap class="tdrow" colspan="">
										<input name="stx_comp_tel"  type="text" class="textfm" style="width:90px;ime-mode:disabled ;" value="<?=$stx_comp_tel?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">팩스번호</td>
									<td nowrap class="tdrow" colspan="">
										<input name="stx_comp_fax"  type="text" class="textfm" style="width:90px;ime-mode:disabled;" value="<?=$stx_comp_fax?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">사업개시일</td>
									<td nowrap class="tdrow" colspan="3">
										<select name="stx_reg_day_chk" class="selectfm" onchange="">
											<option value=""  <? if($stx_reg_day_chk == "")  echo "selected"; ?>>선택</option>
											<option value="1" <? if($stx_reg_day_chk == "1") echo "selected"; ?>>전체</option>
											<option value="2" <? if($stx_reg_day_chk == "2") echo "selected"; ?>>기간선택</option>
										</select>
										<select name="search_year" class="selectfm" onChange="">
											<option value="1980" <? if(1980 == $search_year) echo "selected"; ?> >1980 이전</option>
<?
if(!$search_year) $search_year = $year_now;
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
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">업태</td>
									<td nowrap class="tdrow" colspan="">
										<input name="stx_uptae"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_uptae?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">업종</td>
									<td nowrap class="tdrow" colspan="">
										<input name="stx_upjong"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_upjong?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
<?
if($member['mb_level'] > 6) {
	//echo $stx_man_cust_name;
?>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">열람</td>
									<td nowrap class="tdrow">
										<select name="stx_man_cust_name2" class="selectfm">
											<option value="">전체</option>
<?
$stx_man_cust_name = $stx_man_cust_name2;
include "inc/stx_man_cust_name.php";
?>
										</select>
									</td>
<? } else { ?>
									<td nowrap class="tdrowk"></td>
									<td nowrap class="tdrow">
									</td>
<? } ?>
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
									<td nowrap class="tdrowk"></td>
									<td nowrap class="tdrow" colspan="3">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">주소검색</td>
									<td nowrap class="tdrow" colspan="">
										<input name="stx_addr"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_addr?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										<input type="checkbox" name="stx_addr_first" value="1" <? if($stx_addr_first == 1) echo "checked"; ?> style="vertical-align:middle" title="선검색어">
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">지역검색<input type="checkbox" name="stx_area_not" value="1" <? if($stx_area_not == 1) echo "checked"; ?> style="vertical-align:middle" title="검색제외"><span style="font-size:8pt;">제외</span></td>
									<td nowrap class="tdrow" colspan="7">
										<input type="checkbox" name="stx_area1" value="1" <? if($stx_area1 == 1) echo "checked"; ?> style="vertical-align:middle">서울
										<input type="checkbox" name="stx_area2" value="1" <? if($stx_area2 == 1) echo "checked"; ?> style="vertical-align:middle">부산
										<input type="checkbox" name="stx_area3" value="1" <? if($stx_area3 == 1) echo "checked"; ?> style="vertical-align:middle">인천
										<input type="checkbox" name="stx_area4" value="1" <? if($stx_area4 == 1) echo "checked"; ?> style="vertical-align:middle">대구
										<input type="checkbox" name="stx_area5" value="1" <? if($stx_area5 == 1) echo "checked"; ?> style="vertical-align:middle">대전
										<input type="checkbox" name="stx_area6" value="1" <? if($stx_area6 == 1) echo "checked"; ?> style="vertical-align:middle">광주
										<input type="checkbox" name="stx_area7" value="1" <? if($stx_area7 == 1) echo "checked"; ?> style="vertical-align:middle">울산
										<input type="checkbox" name="stx_area8" value="1" <? if($stx_area8 == 1) echo "checked"; ?> style="vertical-align:middle">경기
										<input type="checkbox" name="stx_area9" value="1" <? if($stx_area9 == 1) echo "checked"; ?> style="vertical-align:middle">경북
										<input type="checkbox" name="stx_area10" value="1" <? if($stx_area10 == 1) echo "checked"; ?> style="vertical-align:middle">경남
										<input type="checkbox" name="stx_area11" value="1" <? if($stx_area11 == 1) echo "checked"; ?> style="vertical-align:middle">전북
										<input type="checkbox" name="stx_area12" value="1" <? if($stx_area12 == 1) echo "checked"; ?> style="vertical-align:middle">전남
										<input type="checkbox" name="stx_area13" value="1" <? if($stx_area13 == 1) echo "checked"; ?> style="vertical-align:middle">충북
										<input type="checkbox" name="stx_area14" value="1" <? if($stx_area14 == 1) echo "checked"; ?> style="vertical-align:middle">충남
										<input type="checkbox" name="stx_area15" value="1" <? if($stx_area15 == 1) echo "checked"; ?> style="vertical-align:middle">강원
										<input type="checkbox" name="stx_area16" value="1" <? if($stx_area16 == 1) echo "checked"; ?> style="vertical-align:middle">제주
										<input type="checkbox" name="stx_area17" value="1" <? if($stx_area17 == 1) echo "checked"; ?> style="vertical-align:middle">세종
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">인원검색</td>
									<td nowrap class="tdrow" colspan="">
										<input name="stx_scount"  type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$stx_scount?>" onkeydown="">
										~
										<input name="stx_ecount"  type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$stx_ecount?>" onkeydown="">
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">업종분류<input type="checkbox" name="stx_industry_not" value="1" <? if($stx_industry_not == 1) echo "checked"; ?> style="vertical-align:middle" title="검색제외"><span style="font-size:8pt;">제외</span></td>
									<td nowrap class="tdrow" colspan="7">
										<input type="checkbox" name="stx_industry1" value="1" <? if($stx_industry1 == 1) echo "checked"; ?> style="vertical-align:middle">제조
										<input type="checkbox" name="stx_industry2" value="1" <? if($stx_industry2 == 1) echo "checked"; ?> style="vertical-align:middle">서비스
										<input type="checkbox" name="stx_industry3" value="1" <? if($stx_industry3 == 1) echo "checked"; ?> style="vertical-align:middle">건설
										<input type="checkbox" name="stx_industry4" value="1" <? if($stx_industry4 == 1) echo "checked"; ?> style="vertical-align:middle">보육시설
										<input type="checkbox" name="stx_industry5" value="1" <? if($stx_industry5 == 1) echo "checked"; ?> style="vertical-align:middle">사회복지
										<input type="checkbox" name="stx_industry6" value="1" <? if($stx_industry6 == 1) echo "checked"; ?> style="vertical-align:middle">교육업
										<input type="checkbox" name="stx_industry7" value="1" <? if($stx_industry7 == 1) echo "checked"; ?> style="vertical-align:middle">의료/제약
										<input type="checkbox" name="stx_industry8" value="1" <? if($stx_industry8 == 1) echo "checked"; ?> style="vertical-align:middle">판매/유통
										<input type="checkbox" name="stx_industry9" value="1" <? if($stx_industry9 == 1) echo "checked"; ?> style="vertical-align:middle">디자인/출판
										<input type="checkbox" name="stx_industry10" value="1" <? if($stx_industry10 == 1) echo "checked"; ?> style="vertical-align:middle">음식점/숙박
										<input type="checkbox" name="stx_industry11" value="1" <? if($stx_industry11 == 1) echo "checked"; ?> style="vertical-align:middle">기관/협회
										<input type="checkbox" name="stx_industry99" value="1" <? if($stx_industry99 == 1) echo "checked"; ?> style="vertical-align:middle">미분류
									</td>
								</tr>
							</table>
							<div style="height:20px;font-size:0px;line-height:0px;"></div>
							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
								<tr>
									<td align="center">
										<a href="javascript:goSearch();" target=""><img src="./images/btn_search_big.png" border="0"></a>
										<a href="client_process_list.php" target=""><img src="./images/btn_receipt_con_big.png" border="0"></a>
<?
//엑셀출력
$client_excel = "client_sms_excel.php?$qstr&$stx_qstr";
?>
										<a href="<?=$client_excel?>"><img src="./images/btn_excel_print_big.png" border="0"></a>
									</td>
								</tr>
							</table>
						</form>
						<div style="height:4px;font-size:0px"></div>
						<form name="dataForm" method="post">
							<input type="hidden" name="chk_data" />
							<input type="hidden" name="page" value="<?=$page?>" />
							<input type="hidden" name="url_qstr" value="<?=$qstr?>" />
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
												문자발송
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
<?
$sql_hp = " select a.boss_hp $sql_common $sql_search $sql_order ";
//echo $sql_hp;
$result_hp = sql_query($sql_hp);
$hp_all_cnt = 0;
for($i=0; $row_hp=mysql_fetch_assoc($result_hp); $i++) {
	$hp_all_cnt++;
	if($i > 0) $line_feed = "\n";
	else $line_feed = "";
	$to_hp_all .= $line_feed.$row_hp['boss_hp'];
	//echo $to_hp_all;
}
?>
							<!--검색 -->
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
								<tr>
									<td nowrap class="tdrowk" width="80"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">문자선택</td>
									<td nowrap class="tdrow"  width="160">
										<select name="select_sms" class="selectfm" onchange="select_sms_func(this.value)">
											<option value="">선택</option>
											<option value="1">전기요금 컨설팅 안내</option>
											<option value="2">시간선택제 지원사업</option>
											<option value="3">이지노무 프로그램</option>
											<option value="4">키즈노무 프로그램</option>
											<option value="5">사업주훈련 지원금</option>
										</select>
									</td>
									<td nowrap class="tdrowk" width="80"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">문자내용</td>
									<td nowrap class="tdrow" width="334">
										<textarea id="chk1" name="chk1" onkeyup="displayBytes(80,'chk1');" style="width:270px;height30px;"></textarea>
										<input type="text" name='chk1_bytes' id='chk1_bytes' style="width:40px;" value="80자" />
									</td>
									<td nowrap class="tdrowk" width="80"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">회신번호</td>
									<td nowrap class="tdrow" width="130">
										<input type="text" name='to_sms' style="width:110px;" value="1544-4519" />
									</td>
									<td nowrap class="tdrow_center" width="90">
										<a href="javascript:sms_send();"><img src="./images/btn_sms_send.png" border="0" /></a>
									</td>
									<td nowrap class="tdrow" width="55"><input type="checkbox" name="hp_all" value="1" onclick="hp_all_func(this,<?=$hp_all_cnt?>);" style="vertical-align:middle" />전체</td>
									<td nowrap class="tdrow">
										<div>선택<input type="hidden" name="to_cnt" value="0" /></div>
										<div id="to_count" style="font-weight:bold;">0건</div>
									</td>
								</tr>
							</table>
							<textarea name="to_hp" style="width:110px;height:310px;display:none;"></textarea>
							<textarea name="to_hp_all" style="width:110px;height:310px;display:none;"><?=$to_hp_all?></textarea>
							<div style="height:20px;font-size:0px"></div>
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
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:">
								<tr>
									<td class="tdhead_center" width="26" rowspan="2"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="check_All()" ></td>
									<td class="tdhead_center" width="46" rowspan="2">No</td>
									<td class="tdhead_center" rowspan="2">사업장명</td>
									<td class="tdhead_center" width="90" rowspan="2">업태</td>
									<td class="tdhead_center" width="94" rowspan="2">휴대폰</td>
									<td class="tdhead_center" width="94" rowspan="2">전화번호</td>
									<td class="tdhead_center" width="94" rowspan="2">팩스번호</td>
									<td class="tdhead_center" width="96" rowspan="1">사업자등록번호</td>
									<td class="tdhead_center" width="100" rowspan="1">대표자</td>
									<td class="tdhead_center" width="78" rowspan="1">의뢰서접수</td>
									<td class="tdhead_center" width="78" rowspan="1">대리인</td>
									<td class="tdhead_center" width="78" rowspan="2">계약서</td>
									<td class="tdhead_center" width="90" rowspan="1">관리점</td>
								</tr>
								<tr>
									<td class="tdhead_center" width="" rowspan="1">사업장관리번호</td>
									<td class="tdhead_center" width="" rowspan="1">사업개시일</td>
									<td class="tdhead_center" width="" rowspan="1">사무위탁</td>
									<td class="tdhead_center" width="" rowspan="1">전자민원</td>
									<td class="tdhead_center" width="" rowspan="1">담당자</td>
								</tr>
<?
// 리스트 출력
for ($i=0; $row=mysql_fetch_assoc($result); $i++) {
	//사업장 옵션 DB
	$sql_opt = " select * from com_list_gy_opt where com_code='$row[com_code]' ";
	$result_opt = sql_query($sql_opt);
	$row_opt=mysql_fetch_array($result_opt);
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
	$manage_cust_name = $row_opt['manage_cust_name'];
	//사무위탁
	if($row_opt['samu_req_yn'] == "0" || $row_opt['samu_req_yn'] == "") {
		$samu_req = "";
	} else if($row_opt['samu_req_yn'] == "1") {
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
	//대표자HP
	if($row['boss_hp']) $boss_hp = $row['boss_hp'];
	else $boss_hp = "-";
	//전화번호
	if($row['com_tel']) $com_tel = $row['com_tel'];
	else $com_tel = "-";
	//팩스번호
	if($row['com_fax']) $com_fax = $row['com_fax'];
	else $com_fax = "-";
	//의뢰서
	if($row['editdt']) $editdt = $row['editdt'];
	else $editdt = "-";
	//위탁서
	if($row['samu_receive_date']) $samu_receive_date = $row['samu_receive_date'];
	else $samu_receive_date = "-";
	//사무위탁수임
	$samu_req_yn_array = Array("","미도착","수임가능","타수임","수임","해지");
	$samu_req_yn_code = $row['samu_req_yn'];
	if($row['samu_req_yn']) $samu_state = $samu_req_yn_array[$samu_req_yn_code];
	else $samu_state = "-";
	if($row['samu_req_date']) $samu_req_date = $row['samu_req_date'];
	else $samu_req_date = "-";
	//대리인(공단)
	if($row['agent_elect_public_date']) $agent_elect_public_date = $row['agent_elect_public_date'];
	else $agent_elect_public_date = "-";
	if($row['agent_elect_public_edate']) $agent_elect_public_edate = $row['agent_elect_public_edate'];
	else $agent_elect_public_edate = "-";
	//대리인(센터)
	if($row['agent_elect_center_date']) $agent_elect_center_date = $row['agent_elect_center_date'];
	else $agent_elect_center_date = "-";
	if($row['agent_elect_center_edate']) $agent_elect_center_edate = $row['agent_elect_center_edate'];
	else $agent_elect_center_edate = "-";
	//진행사항
	if($row['editdt']) $p_accept = "의뢰서접수";
	else $p_accept = "-";
	if($row['samu_receive_date']) $p_accept = "위탁서접수";
	if($row['samu_req_date']) $p_accept = "사무위탁수임";
	if($row['agent_elect_public_edate']) $p_accept = "대리인(공단)";
	if($row['agent_elect_center_edate']) $p_accept = "대리인(센터)";
	//계약서
	if($row['chk_contract'] == "1") $chk_contract = "도착";
	else if($row['chk_contract'] == "2") $chk_contract = "미도착";
	else $chk_contract = "-";
	if($row['chk_contract_date']) $chk_contract_date = $row['chk_contract_date'];
	else $chk_contract_date = "";

	//이지노무 셋팅비/월정액
	if($row['setting_pay']) $setting_pay = number_format($row['setting_pay']);
	else $setting_pay = "-";
	if($row['month_pay']) $month_pay = number_format($row['month_pay']);
	else $month_pay = "-";
	//인원
	if($row['persons']) $persons = $row['persons'];
	else $persons = "0";
	//뷰페이지 링크
	if($member['mb_level'] > 6 || $row['damdang_code'] == $member['mb_profile'] || $row['damdang_code2'] == $member['mb_profile']) {
		$com_view = "client_view.php?id=$id&w=u&page=$page&$qstr&$stx_qstr";
	} else {
		$com_view = "javascript:alert('해당 거래처 정보를 열람할 권한이 없습니다.');";
	}
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer" onclick="check_sms(this);"></td>
									<td class="ltrow1_center_h22"><?=$no?></td>
									<td class="ltrow1_left_h22" title="<?=$com_name_full?>">
										<a href="<?=$com_view?>" style="font-weight:bold"><?=$com_name?></a>
<?
//주소, 지역별
if($stx_addr || $stx_area1 || $stx_area2 || $stx_area3 || $stx_area4 || $stx_area5 || $stx_area6 || $stx_area7 || $stx_area8 || $stx_area9 || $stx_area10 || $stx_area11 || $stx_area12 || $stx_area13 || $stx_area14 || $stx_area15 || $stx_area16 || $stx_area17) {
?>
										<br><?=$com_juso?>
<?
} else {
?>
										<?=$regdt_br?>
<?
}
//인원
if($stx_scount || $stx_ecount) {
	echo "<br>인원: <b>".$persons."</b>명";
}
?>
									</td>
									<td class="ltrow1_center_h22"><span title="<?=$uptae_full?>"><?=$uptae?></span></td>
									<td class="ltrow1_center_h22" id="hp_<?=$id?>"><?=$boss_hp?></td>
									<td class="ltrow1_center_h22"><?=$com_tel?></td>
									<td class="ltrow1_center_h22"><?=$com_fax?></td>
									<td class="ltrow1_center_h22"><?=$biz_no?><br><?=$t_insureno?></td>
									<td class="ltrow1_center_h22" title="<?=$boss_name_full?>"><?=$boss_name?><br><?=$registration_day?></td>
									<td class="ltrow1_center_h22"><?=$editdt?><br><?=$samu_state?></td>
									<td class="ltrow1_center_h22"><?=$agent_elect_public_edate?><br><?=$agent_elect_center_edate?></td>
									<td class="ltrow1_center_h22"><?=$chk_contract?><br><?=$chk_contract_date?></td>
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
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
								</tr>
							</table>
							<input type="checkbox" name="idx" value="idx_array_last" style="display:none;">
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
		</td>
	</tr>
</table>
<? include "./inc/bottom.php";?>
</body>
</html>
