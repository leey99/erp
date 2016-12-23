<?
$sub_menu = "400400";
include_once("./_common.php");

//현재 연도 고정
$now_year = date('Y');
//if(!$stx_total_year) $stx_total_year = $now_year;

//보험료신고 DB 검색시 테이블 추가
if($stx_total_year || $stx_total_insure_input1 || $stx_total_insure_input2 || $stx_total_insure_input3 || $stx_total_insure_input4 || $stx_total_insure_input5 || $stx_total_insure_input6 || $stx_total_process || $stx_gg_process || $stx_ok_date || $stx_insure_input_date) {
	$add_db_table = ", com_total_insure d ";
	$add_sql_search = "and a.com_code=d.com_code";
} else {
	$add_db_table = "";
	$add_sql_search = "";
}
$sql_common = " from com_list_gy a, com_list_gy_opt b, com_list_gy_opt2 c $add_db_table ";

if($member['mb_level'] > 6 || $search_ok == "ok") {
	$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code $add_sql_search ";
	//본사 영업사원 권한
	if($member['mb_level'] == 7) {
		$mb_id = $member['mb_id'];
		//담당매니저 코드 체크
		$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
		$row_manage = sql_fetch($sql_manage);
		$manage_code = $row_manage['code'];
		$sql_search .= " and b.manage_cust_numb='$manage_code' ";
	}
} else {
	$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code $add_sql_search and a.damdang_code='$member[mb_profile]' ";
	//지사 영업사원 권한
	if($member['mb_level'] == 5) {
		$mb_id = $member['mb_id'];
		//담당매니저 코드 체크
		$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
		$row_manage = sql_fetch($sql_manage);
		$manage_code = $row_manage['code'];
		$sql_search .= " and b.manage_cust_numb='$manage_code' ";
	}
}

//검색 : 사업장명칭
if($stx_comp_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_name like '%$stx_comp_name%') ";
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
//검색 : 담당자
if($stx_manage_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.manage_cust_name = '$stx_manage_name') ";
	$sql_search .= " ) ";
}
//검색 : TM매니저
if($stx_tm_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.tm_cust_name = '$stx_tm_name') ";
	$sql_search .= " ) ";
}
//검색 : 사업장관리번호
if($stx_t_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.t_insureno like '%$stx_t_no%') ";
	$sql_search .= " ) ";
}
//검색 : 전화번호
if($stx_comp_tel) {
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
//검색 : 업태
if ($stx_uptae) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.uptae like '%$stx_uptae%') ";
	$sql_search .= " ) ";
}
//검색 : 업태 : 제조 외
if($stx_uptae_non) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.uptae not like '%보육시설%' and a.uptae not like '%사회복지%' and a.uptae not like '%제조%') ";
	$sql_search .= " ) ";
}
//검색 : 업종
if ($stx_upjong) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.upjong like '%$stx_upjong%') ";
	$sql_search .= " ) ";
}
//검색 : 위탁번호
if ($stx_samu_receive_no_search) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.samu_receive_no = '$stx_samu_receive_no_search') ";
	$sql_search .= " ) ";
}
//검색2 : 위탁서
if ($stx_comp_gubun2) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.samu_receive_date != '') ";
	$sql_search .= " ) ";
}
//사무위탁수임 : 초기선택 수임 -> 전체  150226
if(!$samu_req_yn) $samu_req_yn = "all";
if ($samu_req_yn != "all") {
	$sql_search .= " and ( ";
	$sql_search .= " (b.samu_req_yn = '$samu_req_yn') ";
	$sql_search .= " ) ";
}
//건강EDI위임
if ($health_req_yn) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.health_req_yn = '$health_req_yn') ";
	$sql_search .= " ) ";
}
//위탁번호 : 초기선택 입력
if(!$stx_samu_receive_no) $stx_samu_receive_no = "1";
if($stx_samu_receive_no != "all") {
	$sql_search .= " and ( ";
	if($stx_samu_receive_no == 1) {
		$sql_search .= " (b.samu_receive_no != '') ";
	} else if($stx_samu_receive_no == 2) {
		$sql_search .= " (b.samu_receive_no = '') ";
	}
	$sql_search .= " ) ";
	$sst = "b.samu_receive_no+0";
	$sod = "desc";
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
//사무위탁수임 미등록
if($samu_req_yn_input_not) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.samu_req_yn = '') ";
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
//보험구분
if ($stx_samu_state_total != "2" && $stx_samu_state) {
	$sql_search .= " and ( ";
	if($stx_samu_state == "1") $sql_search .= " (a.samu_state_gy <> '') ";
	else if($stx_samu_state == "2") $sql_search .= " (a.samu_state_sj <> '') ";
	$sql_search .= " ) ";
}
//부과고지구분
if(!$stx_levy_kind) $stx_levy_kind = 2;
if($stx_levy_kind) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.levy_kind = '$stx_levy_kind') ";
	$sql_search .= " ) ";
}
//사업장상태 정상/소멸 : 초기선택 정상 -> 전체 150212
//if(!$stx_samu_state_total) $stx_samu_state_total = "1";
if($stx_samu_state_total != "all") {
	if($stx_samu_state_total == "2") {
		if($stx_samu_state == "1") {
			$sql_search .= " and (a.samu_state_gy = '2') ";
			if($stx_samu_state_total_only) $sql_search .= " and (a.samu_state_sj = '1') ";
		} else if($stx_samu_state == "2") {
			$sql_search .= " and (a.samu_state_sj = '2') ";
			if($stx_samu_state_total_only) $sql_search .= " and (a.samu_state_gy = '1') ";
		} else {
			$sql_search .= " and (a.samu_state_gy = '2' or a.samu_state_sj = '2') ";
		}
	} else if($stx_samu_state_total == "1") {
		if($stx_samu_state == "1") {
			$sql_search .= " and (a.samu_state_gy <> '2') ";
			if($stx_samu_state_total_only) $sql_search .= " and (a.samu_state_sj = '2') ";
		} else if($stx_samu_state == "2") {
			$sql_search .= " and (a.samu_state_sj <> '2') ";
			if($stx_samu_state_total_only) $sql_search .= " and (a.samu_state_gy = '2') ";
		} else {
			$sql_search .= " and (a.samu_state_gy <> '2' or a.samu_state_sj <> '2') ";
		}
	}
}
//관리공단지사
if($stx_samu_branch) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.samu_branch = '$stx_samu_branch') ";
	$sql_search .= " ) ";
}
//사업구분
if($stx_employer_insure) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.employer_insure = '$stx_employer_insure') ";
	$sql_search .= " ) ";
}
//적용담당자
if($stx_samu_charge) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.samu_charge = '$stx_samu_charge') ";
	$sql_search .= " ) ";
}
//신고연도
//신고연도 강제 설정
//if(!$stx_total_year) $stx_total_year = $now_year;
if($stx_total_year) {
	$sql_search .= " and ( ";
	$sql_search .= " (d.year = '$stx_total_year') ";
	$sql_search .= " ) ";
}
//접수 : 복수선택
if($stx_total_insure_input1 || $stx_total_insure_input2 || $stx_total_insure_input3 || $stx_total_insure_input4 || $stx_total_insure_input5 || $stx_total_insure_input6) {
	//$sql_search .= " and (d.year = '$stx_total_year') ";
	$sql_search .= " and ( ";
	$stx_total_insure_input_or = "";
	//접수 : 이지노무
	if($stx_total_insure_input1) {
		$sql_search .= " d.easynomu = '$stx_total_insure_input1' ";
		$stx_total_insure_input_or = "or";
	}
	//접수 : 자료
	if($stx_total_insure_input2) {
		$sql_search .= " $stx_total_insure_input_or d.data = '$stx_total_insure_input2' ";
		$stx_total_insure_input_or = "or";
	}
	//접수 : 더존
	if($stx_total_insure_input3) {
		$sql_search .= " $stx_total_insure_input_or d.duzon = '$stx_total_insure_input3' ";
		$stx_total_insure_input_or = "or";
	}
	//접수 : 팩스
	if($stx_total_insure_input4) {
		$sql_search .= " $stx_total_insure_input_or d.fax = '$stx_total_insure_input4' ";
		$stx_total_insure_input_or = "or";
	}
	//접수 : 메일
	if($stx_total_insure_input5) {
		$sql_search .= " $stx_total_insure_input_or d.mail = '$stx_total_insure_input5' ";
		$stx_total_insure_input_or = "or";
	}
	//접수 : 신고서
	if($stx_total_insure_input6) {
		$sql_search .= " $stx_total_insure_input_or d.report = '$stx_total_insure_input6' ";
	}
	$sql_search .= " ) ";
}
//신고현황
if($stx_total_process) {
	//$sql_search .= " and (d.year = '$stx_total_year') ";
	$sql_search .= " and ( ";
	//접수중
	if($stx_total_process == "r") $sql_search .= " (d.ok_report = '') ";
	//미신고
	else if($stx_total_process == "n") $sql_search .= " (d.ok_report != '2' and d.input_date != '') ";
	else $sql_search .= " (d.ok_report = '$stx_total_process') ";
	$sql_search .= " ) ";
}
//위탁유지
if($stx_samu_keep) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.samu_keep = '$stx_samu_keep') ";
	$sql_search .= " ) ";
}
//위탁해지일
if($stx_samu_close_date) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.samu_close_date = '$stx_samu_close_date') ";
	$sql_search .= " ) ";
}
//신고일자
if($stx_ok_date) {
	$sql_search .= " and ( ";
	$sql_search .= " (d.ok_date = '$stx_ok_date') ";
	$sql_search .= " ) ";
}
//접수일자
if($stx_input_date) {
	$sql_search .= " and ( ";
	$sql_search .= " (d.input_date = '$stx_input_date') ";
	$sql_search .= " ) ";
}
//정렬
if (!$sst) {
    $sst = "a.com_code";
    $sod = "desc";
}
$sst2 = "b.samu_receive_no_old";
$sod2 = "desc";
$sql_order = " order by $sst $sod , $sst2 $sod2 ";
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

$sub_title = "보험료신고";
$g4[title] = $sub_title." : 사무위탁 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 16;
//검색 파라미터 전송
$qstr = "stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_biz_no=".$stx_biz_no."&stx_boss_name=".$stx_boss_name."&stx_comp_tel=".$stx_comp_tel."&stx_comp_fax=".$stx_comp_fax."&stx_proxy=".$stx_proxy."&stx_comp_gubun2=".$stx_comp_gubun2."&stx_man_cust_name=".$stx_man_cust_name."&stx_uptae=".$stx_uptae."&stx_upjong=".$stx_upjong."&search_ok=".$search_ok;
$qstr .= "&samu_req_yn=".$samu_req_yn."&health_req_yn=".$health_req_yn."&stx_samu_receive_no=".$stx_samu_receive_no."&stx_samu_receive_no_search=".$stx_samu_receive_no_search."&stx_reg_day_chk=".$stx_reg_day_chk."&search_year=".$search_year."&search_month=".$search_month."&search_year_end=".$search_year_end."&search_month_end=".$search_month_end."&stx_search_day_chk=".$stx_search_day_chk."&search_sday=".$search_sday."&search_eday=".$search_eday;
$qstr .= "&search_day_all=".$search_day_all."&search_day1=".$search_day1."&search_day3=".$search_day3."&search_day4=".$search_day4."&search_day5=".$search_day5."&stx_biz_no_input_not=".$stx_biz_no_input_not."&stx_t_no_input_not=".$stx_t_no_input_not."&stx_uptae_non=".$stx_uptae_non."&stx_samu_keep=".$stx_samu_keep."&stx_samu_close_date=".$stx_samu_close_date."&stx_ok_date=".$stx_ok_date."&stx_input_date=".$stx_input_date;
$qstr .= "&stx_addr=".$stx_addr."&stx_addr_first=".$stx_addr_first."&stx_manage_name=".$stx_manage_name."&stx_samu_state=".$stx_samu_state."&stx_levy_kind=".$stx_levy_kind."&stx_samu_state_total=".$stx_samu_state_total."&stx_tm_name=".$stx_tm_name."&stx_samu_branch=".$stx_samu_branch;
$qstr .= "&stx_total_year=".$stx_total_year."&stx_total_insure_input_all=".$stx_total_insure_input_all."&stx_total_insure_input1=".$stx_total_insure_input1."&stx_total_insure_input2=".$stx_total_insure_input2."&stx_total_insure_input3=".$stx_total_insure_input3."&stx_total_insure_input4=".$stx_total_insure_input4."&stx_total_insure_input5=".$stx_total_insure_input5."&stx_total_insure_input6=".$stx_total_insure_input6."&stx_total_process=".$stx_total_process;
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
</script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script language="javascript">
function loadCalendar( obj )
{
	var calendar = new Calendar(0, null, onSelect, onClose);
	calendar.create();
	calendar.parseDate(obj.value);
	calendar.showAtElement(obj, "Br");

	function onSelect(calendar, date)
	{
		var input_field = obj;
		input_field.value = date;
		if (calendar.dateClicked) {
			calendar.callCloseHandler();
		}
	};

	function onClose(calendar)
	{
		calendar.hide();
		calendar.destroy();
	};
}
function stx_search_day_select(input_obj) {
	var frm = document.searchForm;
	if(input_obj.value == 1) {
		frm['search_sday'].value = "<?=$today?>";
		frm['search_eday'].value = "<?=$today?>";
	} else {
		frm['search_sday'].value = "";
		frm['search_eday'].value = "";
	}
}
function search_day_func(obj) {
	var frm = document.searchForm;
	if(frm.search_day_all.checked) {
		if(obj.name == "search_day_all") {
			for(i=1; i<=8; i++) {
				frm['search_day'+i].checked = true;
			}
		} else {
			frm['search_day_all'].checked = false;
		}
	} else if(obj.name == "search_day_all") {
		for(i=1; i<=8; i++) {
			frm['search_day'+i].checked = false;
		}
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
//신고조회 접수방법 전체 선택
function total_input_func(obj) {
	var frm = document.searchForm;
	if(frm.stx_total_insure_input_all.checked) {
		if(obj.name == "stx_total_insure_input_all") {
			for(i=1; i<=6; i++) {
				frm['stx_total_insure_input'+i].checked = true;
			}
		} else {
			frm['stx_total_insure_input_all'].checked = false;
		}
	} else if(obj.name == "stx_total_insure_input_all") {
		for(i=1; i<=6; i++) {
			frm['stx_total_insure_input'+i].checked = false;
		}
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
						<td width="100"><img src="images/top05.gif" border="0"></td>
						<td width=""><a href="<?=$_SERVER['PHP_SELF']?>"><img src="images/top05_04.gif" border="0"></a></td>
						<td>
<?
$title_main_no = "05";
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
										<td valign="bottom"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--검색 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업장명칭</td>
										<td nowrap class="tdrow">
											<input name="stx_comp_name" type="text" class="textfm" style="width:120px;ime-mode:active;" value="<?=$stx_comp_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업자등록번호</td>
										<td nowrap class="tdrow">
											<input name="stx_biz_no" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$stx_biz_no?>" maxlength="12" onkeyup="checkhyphen(this.value, this,'Y')" onkeydown="only_number();if(event.keyCode == 13){ goSearch(); }">
											<input type="checkbox" name="stx_biz_no_input_not" value="1" <? if($stx_biz_no_input_not == 1) echo "checked"; ?> style="vertical-align:middle">미등록
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">대표자</td>
										<td nowrap class="tdrow">
											<input name="stx_boss_name"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_boss_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">진행사항</td>
										<td nowrap class="tdrow" <? if($member['mb_level'] <= 7) echo "colspan='3'"; ?> >
											<select name="stx_proxy" class="selectfm" onchange="">
												<option value=""  <? if($stx_proxy == "")  echo "selected"; ?>>전체</option>
												<option value="1" <? if($stx_proxy == "1") echo "selected"; ?>>접수</option>
												<option value="2" <? if($stx_proxy == "2") echo "selected"; ?>>처리중</option>
												<option value="3" <? if($stx_proxy == "3") echo "selected"; ?>>완료</option>
											</select>
										</td>
<?
if($member['mb_level'] > 7) {
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
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">담당자</td>
										<td nowrap class="tdrow">
											<input name="stx_manage_name" type="text" class="textfm" style="width:120px;ime-mode:active;" value="<?=$stx_manage_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업장관리번호</td>
										<td nowrap class="tdrow">
											<input name="stx_t_no" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$stx_t_no?>" maxlength="14" onkeyup="checkhyphen_tno(this.value, this,'Y')" onkeydown="only_number();if(event.keyCode == 13){ goSearch(); }">
											<input type="checkbox" name="stx_t_no_input_not" value="1" <? if($stx_t_no_input_not == 1) echo "checked"; ?> style="vertical-align:middle">미등록
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">주소검색</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_addr"  type="text" class="textfm" style="width:75px;ime-mode:active;" value="<?=$stx_addr?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
											<input type="checkbox" name="stx_addr_first" value="1" <? if($stx_addr_first == 1) echo "checked"; ?> style="vertical-align:middle" title="선검색어">
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">전화번호</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_comp_tel"  type="text" class="textfm" style="width:90px;ime-mode:disabled ;" value="<?=$stx_comp_tel?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">TM매니저</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_tm_name"  type="text" class="textfm" style="width:90px;" value="<?=$stx_tm_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">처리현황</td>
										<td nowrap class="tdrow" colspan="3">
											<b>위탁번호</b>
											<select name="stx_samu_receive_no" class="selectfm" style="color:red;font-weight:bold;" onchange="">
												<option value="all"  <? if($stx_samu_receive_no == "all")  echo "selected"; ?>>전체</option>
												<option value="1" <? if($stx_samu_receive_no == "1") echo "selected"; ?>>입력</option>
												<option value="2" <? if($stx_samu_receive_no == "2") echo "selected"; ?>>미입력</option>
											</select>
											<b>사무위탁수임</b>
											<select name="samu_req_yn" class="selectfm" style="color:red;font-weight:bold;" onchange="">
												<option value="all" <? if($samu_req_yn == "all")  echo "selected"; ?>>전체</option>
												<option value="1" <? if($samu_req_yn == "1") echo "selected"; ?>>반려</option>
												<option value="2" <? if($samu_req_yn == "2") echo "selected"; ?>>수임가능</option>
												<option value="3" <? if($samu_req_yn == "3") echo "selected"; ?>>타수임</option>
												<option value="4" <? if($samu_req_yn == "4") echo "selected"; ?>>수임</option>
												<option value="5" <? if($samu_req_yn == "5") echo "selected"; ?>>해지</option>
											</select>
											<input type="checkbox" name="samu_req_yn_input_not" value="1" <? if($samu_req_yn_input_not == 1) echo "checked"; ?> style="vertical-align:middle">미등록
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업장상태</td>
										<td nowrap class="tdrow" colspan="">
											<select name="stx_samu_state_total" class="selectfm" style="color:red;font-weight:bold;" onchange="">
												<option value="all"  <? if($stx_samu_state_total == "all")  echo "selected"; ?>>전체</option>
												<option value="1" <? if($stx_samu_state_total == "1") echo "selected"; ?>>정상</option>
												<option value="2" <? if($stx_samu_state_total == "2") echo "selected"; ?>>소멸</option>
											</select>
											<input type="checkbox" name="stx_samu_state_total_only" value="1" <? if($stx_samu_state_total_only == 1) echo "checked"; ?> style="vertical-align:middle">단독
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">소멸일자</td>
										<td nowrap class="tdrow" colspan="3">
											<select name="stx_discharge_date_chk" class="selectfm" onchange="stx_discharge_date_select(this)">
												<option value=""  <? if($stx_discharge_date_chk == "")  echo "selected"; ?>>전체</option>
												<option value="2" <? if($stx_discharge_date_chk == "2") echo "selected"; ?>>기간선택</option>
											</select>
											<input name="discharge_date_start" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$discharge_date_start?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.searchForm.discharge_date_start);" target="">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
											~
											<input name="discharge_date_end" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$discharge_date_end?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.searchForm.discharge_date_end);" target="">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">보험구분</td>
										<td nowrap class="tdrow" colspan="">
											<select name="stx_samu_state" class="selectfm" onchange="">
												<option value=""  <? if($stx_samu_state == "")  echo "selected"; ?>>전체</option>
												<option value="1" <? if($stx_samu_state == "1") echo "selected"; ?>>고용</option>
												<option value="2" <? if($stx_samu_state == "2") echo "selected"; ?>>산재</option>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">부과고지구분</td>
										<td nowrap class="tdrow" colspan="">
											<select name="stx_levy_kind" class="selectfm" onchange="">
												<option value=""  <? if($stx_levy_kind == "")  echo "selected"; ?>>전체</option>
												<option value="1" <? if($stx_levy_kind == "1") echo "selected"; ?>>부과고지</option>
												<option value="2" <? if($stx_levy_kind == "2") echo "selected"; ?>>자진신고</option>
												<option value="3" <? if($stx_levy_kind == "3") echo "selected"; ?>>부과+자진</option>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">업태</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_uptae"  type="text" class="textfm" style="width:75px;ime-mode:active;" value="<?=$stx_uptae?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
											<input type="checkbox" name="stx_uptae_non" value="1" <? if($stx_uptae_non == 1) echo "checked"; ?> style="vertical-align:middle" title="제조 외">
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">업종</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_upjong"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_upjong?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">위탁번호</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_samu_receive_no_search"  type="text" class="textfm" style="width:62px;ime-mode:disabled;" value="<?=$stx_samu_receive_no_search?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">신고조회</td>
										<td nowrap class="tdrow" colspan="3">
<input type="checkbox" name="stx_total_insure_input_all" onclick="total_input_func(this)" value="1" <?=$stx_total_insure_input_all_chk?> style="vertical-align:middle"><b>전체</b>
<?
if($stx_total_insure_input1) $stx_total_insure_input1_chk = "checked";
else $stx_total_insure_input1_chk = "";
if($stx_total_insure_input2) $stx_total_insure_input2_chk = "checked";
else $stx_total_insure_input2_chk = "";
if($stx_total_insure_input3) $stx_total_insure_input3_chk = "checked";
else $stx_total_insure_input3_chk = "";
if($stx_total_insure_input4) $stx_total_insure_input4_chk = "checked";
else $stx_total_insure_input4_chk = "";
if($stx_total_insure_input5) $stx_total_insure_input5_chk = "checked";
else $stx_total_insure_input5_chk = "";
if($stx_total_insure_input6) $stx_total_insure_input6_chk = "checked";
else $stx_total_insure_input6_chk = "";
?>
											<input type="checkbox" name="stx_total_insure_input1" value="1" <?=$stx_total_insure_input1_chk?> style="vertical-align:middle">이지노무
											<input type="checkbox" name="stx_total_insure_input2" value="1" <?=$stx_total_insure_input2_chk?> style="vertical-align:middle">자료
											<input type="checkbox" name="stx_total_insure_input3" value="1" <?=$stx_total_insure_input3_chk?> style="vertical-align:middle">더존
											<input type="checkbox" name="stx_total_insure_input4" value="1" <?=$stx_total_insure_input4_chk?> style="vertical-align:middle">팩스
											<input type="checkbox" name="stx_total_insure_input5" value="1" <?=$stx_total_insure_input5_chk?> style="vertical-align:middle">메일
											<input type="checkbox" name="stx_total_insure_input6" value="1" <?=$stx_total_insure_input6_chk?> style="vertical-align:middle">신고서
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">신고연도</td>
										<td nowrap class="tdrow" colspan="">
											<select name="stx_total_year" class="selectfm" style="color:red;font-weight:bold;" onChange="">
												<option value="">전체</option>
<?
for($i=2013;$i<=$now_year;$i++) {
?>
												<option value="<?=$i?>" <? if($i == $stx_total_year) echo "selected"; ?> ><?=$i?></option>
<?
}
if($stx_total_insure_input_all) $stx_total_insure_input_all_chk = "checked";
else $stx_total_insure_input_all_chk = "";
?>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">신고현황</td>
										<td nowrap class="tdrow" colspan="">
<?
$total_process_chk = $stx_total_process;
?>
											<select name="stx_total_process" class="selectfm" onchange="">
												<option value=""  <? if($total_process_chk == "")  echo "selected"; ?>>전체</option>
												<option value="r" <? if($total_process_chk == "r") echo "selected"; ?>>접수중</option>
												<option value="1" <? if($total_process_chk == "1") echo "selected"; ?>>처리중</option>
												<option value="2" <? if($total_process_chk == "2") echo "selected"; ?>>신고완료</option>
												<option value="3" <? if($total_process_chk == "3") echo "selected"; ?>>자체신고</option>
												<option value="4" <? if($total_process_chk == "4") echo "selected"; ?>>회계신고</option>
												<option value="5" <? if($total_process_chk == "5") echo "selected"; ?>>현장신고</option>
												<option value="6" <? if($total_process_chk == "6") echo "selected"; ?>>반려</option>
												<option value="7" <? if($total_process_chk == "7") echo "selected"; ?>>기타</option>
												<option value="n" <? if($total_process_chk == "n") echo "selected"; ?>>미신고</option>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">관리공단</td>
										<td nowrap class="tdrow" colspan="">
											<select name="stx_samu_branch" class="selectfm" onchange="">
												<option value="">선택</option>
<?
for($i=1;$i<count($samu_branch_arry);$i++) {
?>
												<option value="<?=$samu_branch_arry[$i]?>" <? if($stx_samu_branch == $samu_branch_arry[$i]) echo "selected"; ?>><?=$samu_branch_arry[$i]?></option>
<?
}
?>
											</select>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">위탁유지</td>
										<td nowrap class="tdrow" colspan="">
											<select name="stx_samu_keep" class="selectfm" onchange="">
												<option value=""  <? if($stx_samu_keep == "")  echo "selected"; ?>>전체</option>
												<option value="1" <? if($stx_samu_keep == "1") echo "selected"; ?>>유지</option>
												<option value="2" <? if($stx_samu_keep == "2") echo "selected"; ?>>해지예정</option>
												<option value="3" <? if($stx_samu_keep == "3") echo "selected"; ?>>해지</option>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">위탁해지일</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_samu_close_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$stx_samu_close_date?>" maxlength="10" onkeydown="only_number();if(event.keyCode==13){goSearch();};" onkeyup="checkcomma(this.value, this,'Y')">
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.searchForm.stx_samu_close_date);" target="">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">신고일자</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_ok_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$stx_ok_date?>" maxlength="10" onkeydown="only_number();if(event.keyCode==13){goSearch();};" onkeyup="checkcomma(this.value, this,'Y')">
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.searchForm.stx_ok_date);" target="">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">접수일자</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_input_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$stx_input_date?>" maxlength="10" onkeydown="only_number();if(event.keyCode==13){goSearch();};" onkeyup="checkcomma(this.value, this,'Y')">
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.searchForm.stx_input_date);" target="">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
										</td>
										<td nowrap class="tdrowk"></td>
										<td nowrap class="tdrow" colspan="">

										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>
<?
	//신고현황 기준 연도 160318
	if(!$stx_total_year) $total_req_year = $now_year;
	else $total_req_year = $stx_total_year;
?>
								<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
									<tr>
										<td align="center">
											<a href="javascript:goSearch();" target=""><img src="./images/btn_search_big.png" border="0"></a>
											<a href="client_list.php" target=""><img src="./images/btn_customer_con_big.png" border="0"></a>
											<a href="total_insure_excel.php?<?=$qstr?>&stx_total_year=<?=$total_req_year?>"><img src="./images/btn_excel_print_big.png" border="0"></a>
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
							<!--리스트 -->
							<form name="dataForm" method="post">
								<input type="hidden" name="chk_data">
								<input type="hidden" name="page" value="<?=$page?>">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
									<tr>
										<td class="tdhead_center" width="26" rowspan="2"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" ></td>
										<td class="tdhead_center" width="46" rowspan="2">No</td>
										<td class="tdhead_center" width="46" rowspan="2">위탁No</td>
										<td class="tdhead_center" width="68" rowspan="">등록일자</td>
										<td class="tdhead_center" rowspan="2">사업장명</td>
										<td class="tdhead_center" width="98" rowspan="1">사업자등록번호</td>
										<td class="tdhead_center" width="90" rowspan="1">전화번호</td>
										<td class="tdhead_center" width="78" rowspan="1">대표자</td>
										<td class="tdhead_center" width="70" rowspan="2">신고연도<br></td>
										<td class="tdhead_center" width="80" rowspan="1">접수방법</td>
										<td class="tdhead_center" width="80" rowspan="1">신고현황</td>
										<td class="tdhead_center" width="70" rowspan="1">수임일자</td>
										<td class="tdhead_center" width="44" rowspan="1">고용</td>
										<td class="tdhead_center" width="70" rowspan="1">관리점</td>
									</tr>
									<tr>
										<td class="tdhead_center" width="" rowspan="1">업태</td>
										<td class="tdhead_center" width="" rowspan="1">사업장관리번호</td>
										<td class="tdhead_center" width="" rowspan="1">팩스번호</td>
										<td class="tdhead_center" width="" rowspan="1">사업개시일</td>
										<td class="tdhead_center" width="" rowspan="1">접수일자</td>
										<td class="tdhead_center" width="" rowspan="1">신고일자</td>
										<td class="tdhead_center" width="" rowspan="1">해지일자</td>
										<td class="tdhead_center" width="" rowspan="1">산재</td>
										<td class="tdhead_center" width="" rowspan="1">담당자</td>
									</tr>
<?
//위탁번호 이전 번호 초기화
$samu_receive_no_old = "";
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;
	//거래처 코드
	$id = $row['com_code'];
	//위탁서래처 코드
	if($row['samu_receive_no'] > 0) {
		$samu_receive_no = $row['samu_receive_no']."<br>";
	} else if($row['samu_receive_no'] == "-") {
		$samu_receive_no = "";
	} else {
		$samu_receive_no = "";
	}
	//echo $samu_receive_no." != ".$samu_receive_no_old." / ";
	if($samu_receive_no_old && $samu_receive_no != $samu_receive_no_old-1) $samu_receive_no_color = "color:red";
	else $samu_receive_no_color = "";
	//위탁번호 이전 번호
	if($row['samu_receive_no_old']) {
		$samu_receive_no_old = $row['samu_receive_no_old'];
	} else {
		$samu_receive_no_old = "";
	}
	//등록일자
	$regdt = $row['regdt'];
	//등록일자 색상
	if($regdt >= $search_sday && $regdt <= $search_eday) $regdt_color = "color:red";
	else $regdt_color = "";
	//등록일시
	if($row['regdt_time'] != "0000-00-00 00:00:00") $regdt_time = $row['regdt_time'];
	else $regdt_time = "";
	//사업장명
	$com_name_full = $row['com_name'];
	$com_name = cut_str($com_name_full, 28, "..");
	//사업개시일
	if($row['registration_day']) $registration_day = $row['registration_day'];
	else $registration_day = "-";
	//법인 구분
	if($row['upche_div'] == "2") {
		$upche_div = "법인";
	} else {
		$upche_div = "개인";
	}
	//주소
	$com_juso_full = $row['com_juso']." ".$row['com_juso2'];
	$com_juso = cut_str($com_juso_full, 18, "..");
	//전화번호
	$com_tel = $row['com_tel'];
	//1544 국번 지역번호 제거
	$com_tel_array = explode("-", $com_tel);
	if($com_tel_array[0] == "000") $com_tel = $com_tel_array[1]."-".$com_tel_array[2];
	//사업자등록번호
	if($row['biz_no']) $biz_no = $row['biz_no'];
	else $biz_no = "-";
	//사업장관리번호
	if($row['t_insureno']) $t_insureno = $row['t_insureno'];
	else $t_insureno = "-";
	//대표자
	$boss_name_full = $row['boss_name'];
	if($row['boss_name']) $boss_name = cut_str($boss_name_full, 10, "..");
	else $boss_name = "-";
	//관리점
	$damdang_code = $row['damdang_code'];
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "-";
	//담당매니저
	$manage_cust_name = $row['manage_cust_name'];
	//TM매니저
	$tm_cust_name = $row['tm_cust_name'];
	//신고연도
	$total_insure_year = $row['year'];
	//사무위탁
	if($row['samu_req_yn'] == "0" || $row['samu_req_yn'] == "") {
		$samu_req = "";
	} else if($row['samu_req_yn'] == "1") {
		$samu_req = "신청";
	}
	//업태
	$uptae_full = $row['uptae'];
	if($row['uptae']) $uptae = cut_str($uptae_full, 8, "..");
	else $uptae = "-";
	//업종
	$upjong_full = $row['upjong'];
	if($row['upjong']) $upjong = cut_str($upjong_full, 16, "..");
	else $upjong = "-";
	//의뢰서
	if($row['editdt']) $editdt = $row['editdt'];
	else $editdt = "-";
	if($editdt >= $search_sday && $editdt <= $search_eday) $editdt_color = "color:red";
	else $editdt_color = "";
	//위탁서
	if($row['samu_receive_date']) $samu_receive_date = $row['samu_receive_date'];
	else $samu_receive_date = "-";
	if($samu_receive_date >= $search_sday && $samu_receive_date <= $search_eday) $samu_receive_date_color = "color:red";
	else $samu_receive_date_color = "";
	//수임일
	if($row['samu_req_date']) $samu_req_date = $row['samu_req_date'];
	else $samu_req_date = "-";
	if($samu_req_date >= $search_sday && $samu_req_date <= $search_eday) $samu_req_date_color = "color:red";
	else $samu_req_date_color = "";
	//해지일
	if($row['samu_close_date']) $samu_close_date = $row['samu_close_date'];
	else $samu_close_date = "-";
	$samu_close_date_color = "";
	//진행사항
	if($row['editdt']) $p_accept = "접수";
	else $p_accept = "-";
	if($row['samu_receive_date']) $p_accept = "처리중";
	if($row['samu_req_date']) $p_accept = "처리중";
	if($row['agent_elect_public_date']) $p_accept = "처리중";
	if($row['agent_elect_center_date']) $p_accept = "처리중";
	if($row['easynomu_process']) $p_accept = "처리중";
	if($row['proxy'] == 1)  $p_accept = "접수";
	else if($row['proxy'] == 3) $p_accept = "완료";
	//처리현황 (사무위탁)
	$samu_req_yn_array = Array("","반려","수임가능","타수임","수임","해지");
	$samu_req_yn_code = $row['samu_req_yn'];
	if($row['samu_req_yn']) $samu_req_yn_text = $samu_req_yn_array[$samu_req_yn_code];
	else $samu_req_yn_text = "-";
	//보수총액 신고현황 배열
	$total_req_yn_array = Array("","처리중","신고완료","자체신고","회계신고","현장신고","반려","기타");
	//접수자료 2014 ~ 현재연도
	for($total_year=2014; $total_year<=$now_year; $total_year++) {
		//보수총액신고 DB
		$sql_total = " select * from com_total_insure where com_code='$id' and year='$total_year' ";
		$result_total = sql_query($sql_total);
		$row_total = mysql_fetch_array($result_total);
		if($row_total['easynomu']) $total_input1[$total_year] = "이지.";
		else $total_input1[$total_year] = "";
		if($row_total['data']) $total_input2[$total_year] = "자료.";
		else $total_input2[$total_year] = "";
		if($row_total['duzon']) $total_input3[$total_year] = "더존.";
		else $total_input3[$total_year] = "";
		if($row_total['fax']) $total_input4[$total_year] = "팩스.";
		else $total_input4[$total_year] = "";
		if($row_total['mail']) $total_input5[$total_year] = "자료.";
		else $total_input5[$total_year] = "";
		if($row_total['report']) $total_input6[$total_year] = "신고서";
		else $total_input6[$total_year] = "";
		//접수일자
		if($row_total['input_date']) $total_input_date[$total_year] = $row_total['input_date'];
		else $total_input_date[$total_year] = "";
		//신고현황 (보험료신고)
		$total_req_yn_code = $row_total['ok_report'];
		if($row_total['ok_report']) $total_req_yn_text[$total_year] = $total_req_yn_array[$total_req_yn_code];
		else $total_req_yn_text[$total_year] = "-";
		if($stx_total_process == "r") $total_req_yn_text[$total_year] = "접수중";
		//신고일자
		if($row_total['ok_date']) $total_ok_date[$total_year] = $row_total['ok_date'];
		else $total_ok_date[$total_year] = "-";
	}
	//소멸 사업장
	if($row['samu_state_gy'] == "2") $samu_req_yn_text1 = "<span style='color:red'>소멸</span>(고용)";
	else $samu_req_yn_text1 = "";
	if($row['samu_state_sj'] == "2") $samu_req_yn_text2 = "<span style='color:red'>소멸</span>(산재)";
	else $samu_req_yn_text2 = "";
	if($samu_req_yn_text1) $samu_req_yn_text_br = "<br>";
	else $samu_req_yn_text_br = "";
	if($samu_req_yn_text1 || $samu_req_yn_text2) {
		$samu_req_yn_text = $samu_req_yn_text1.$samu_req_yn_text_br.$samu_req_yn_text2;
		$samu_termination = "<span style='color:red;'>(소멸)</span>";
	} else {
		$samu_req_yn_text = "";
		$samu_termination = "";
	}
	//상시근로자 고용/산재
	$persons_gy = $row['persons_gy'];
	$persons_sj = $row['persons_sj'];
	if($persons_gy == "0") $persons_gy = "<span style='color:red'>-</span>";
	if($persons_sj == "0") $persons_sj = "<span style='color:red'>-</span>";
	if($member['mb_level'] > 6 || $row['damdang_code'] == $member['mb_profile']) {
		$com_view = "total_insure_view.php?id=$id&w=u&$qstr&page=$page";
	} else {
		$com_view = "javascript:alert('해당 거래처 정보를 열람할 권한이 없습니다.');";
	}
	//해지 사업장 회색 블럭 표시
	if($samu_req_yn_code == '5') {
		$tr_class = "list_row_now_gr";
		$samu_close_text = "<span style='color:red;'>(해지)</span>";
	} else {
		$tr_class = "list_row_now_wh";
		$samu_close_text = "";
	}
	//samu_receive_no_color 색상 강제 제거
	$samu_receive_no_color = "";
?>
									<tr class="<?=$tr_class?>" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='<?=$tr_class?>';">
										<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
										<td class="ltrow1_center_h22"><?=$no?></td>
										<td class="ltrow1_center_h22" style="<?=$samu_receive_no_color?>">
											<div style="line-height:12px;">
												<span style="font-weight:bold;"><?=$samu_receive_no?></span><span style="font-size:8pt;"><?=$samu_receive_no_old?></span>
											</div>
										</td>
										<td class="ltrow1_center_h22"><span style="<?=$regdt_color?>" title="<?=$regdt_time?>"><?=$regdt?></span><br><span title="<?=$uptae_full?>"><?=$uptae?></span></td>
										<td class="ltrow1_left_h22" title="">
											<a href="<?=$com_view?>" style="font-weight:bold"><?=$com_name_full?><?=$samu_close_text?><?=$samu_termination?></a>
											<br>(<?=$row['com_postno']?>) <?=$com_juso_full?>
										</td>
										<td class="ltrow1_center_h22"><?=$biz_no?><br><?=$t_insureno?></td>
										<td class="ltrow1_center_h22"><?=$com_tel?><br><?=$row['com_fax']?></td>
										<td class="ltrow1_center_h22" title="<?=$boss_name_full?>"><?=$boss_name?><br><?=$registration_day?></td>
										<td class="ltrow1_center_h22"><span style=""><?=$total_insure_year?></span></td>
										<td class="ltrow1_center_h22"><span style="font-size:8pt;"><?=$total_input1[$total_req_year]?><?=$total_input2[$total_req_year]?><?=$total_input3[$total_req_year]?><?=$total_input4[$total_req_year]?><?=$total_input5[$total_req_year]?><?=$total_input6[$total_req_year]?></span><br><b><?=$total_input_date[$total_req_year]?></b></td>
										<td class="ltrow1_center_h22"><?=$total_req_yn_text[$total_req_year]?><br><b><?=$total_ok_date[$total_req_year]?></b></td>
										<td class="ltrow1_center_h22"><span style="<?=$samu_req_date_color?>"><?=$samu_req_date?></span><br><span style="<?=$samu_close_date_color?>"><?=$samu_close_date?></span></td>
										<td class="ltrow1_center_h22"><?=$persons_gy?><br><?=$persons_sj?></td>
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
