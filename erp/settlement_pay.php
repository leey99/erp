<?
$sub_menu = "300600";
include_once("./_common.php");

//결산 : 권한(대표, 지사장, 본부장, 부장, 경리담당, 관리자) 설정 150914
$mb_id_check = explode('000',$member['mb_id']);
if($mb_id_check[1] != "1" && $member['mb_id'] != "kcmc1001" && $member['mb_id'] != "kcmc1002" && $member['mb_id'] != "kcmc1004" && $member['mb_id'] != "kcmc1008" && $member['mb_id'] != "master") {
	alert("해당 페이지를 열람할 권한이 없습니다.");
} else {
	//열람 가능 사용자 관리자 권한 설정 160331
	$is_admin = "super";
	$com_code = 395;
}

//현재 년도
$year_now = date("Y");

$sql_common = " from pibohum_base_pay ";

//echo $is_admin;
if($is_admin == "super") {
	$colspan = 15;
} else {
	$colspan = 14;
}
$sql_search = " where com_code='$com_code' ";

//년도, 월 설정
if(!$search_year) $search_year = date("Y");
//if(!$search_month) $search_month = date("m");

//echo $stx_name;
// 검색 : 년
if ($search_year) {
	$sql_search .= " and ( ";
	$sql_search .= " (year like '$search_year%') ";
	$sql_search .= " ) ";
}
// 검색 : 월
if ($search_month) {
	$sql_search .= " and ( ";
	$sql_search .= " (month like '$search_month%') ";
	$sql_search .= " ) ";
}

$sql_group = " group by year, month, w_date, w_time ";

$sst0 = "  ";
if (!$sst) {
	if($is_admin == "super") {
		$sst = "com_code";
	} else {
		$sst = "sort";
	}
	$sod = "desc";
}
$sst2 = ", year desc";
$sst3 = ", month desc";
$sst4 = ", w_date desc";
$sst5 = ", w_time desc";

$sql_order = " order by $sst0 $sst $sod $sst2 $sst3 $sst4 $sst5 ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search $sql_group
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 999;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sub_title = "급여관리";
$g4[title] = $sub_title." : 결산 : ".$easynomu_name;

$sql = " select com_code, sabun, year, month, dept_code, dept, count(month) as cnt, sum(money_total) as sum_total, sum(money_gongje) as sum_gongje, sum(money_result) as sum_result, w_date, w_time
          $sql_common
          $sql_search $sql_group
          $sql_order 
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$result_reg_cnt = sql_query($sql);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
<script type="text/javascript" src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<script type="text/javascript">
// 삭제 검사 확인
function goSearch()
{
	var frm = document.searchForm;
	frm.action = "<?=$PHP_SELF?>";
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
	//alert(chk_data);
	if(cnt==0) {
	 alert("선택된 데이터가 없습니다.");
	 return;
	} else {
		if(confirm("정말 삭제하시겠습니까?")) {
			chk_data = chk_data.substring(1, chk_data.length);
			frm.chk_data.value = chk_data;
			//alert(chk_data);
			frm.action="settlement_pay_delete.php";
			frm.submit();
		} else {
			return;
		}
	} 
}
function printPayList(search_year, search_month, w_date, w_time) {
	frm = document.printForm;
	frm.mode.value = "salary_list";
	frm.search_year.value = search_year;
	frm.search_month.value = search_month;
	frm.w_date.value = w_date;
	frm.w_time.value = w_time;
	frm.target = "_blank";
	frm.action = "pay_ledger.php?code=<?=$com_code?>";
	frm.submit();
}
function printPayList2(search_year, search_month, w_date, w_time) {
	frm = document.printForm;
	frm.mode.value = "salary_list";
	frm.search_year.value = search_year;
	frm.search_month.value = search_month;
	frm.w_date.value = w_date;
	frm.w_time.value = w_time;
	frm.target = "_blank";
	frm.action = "pay_ledger_report.php?code=<?=$com_code?>";
	frm.submit();
}
function printPayList3(search_year, search_month, w_date, w_time) {
	alert("프로그램 개발 중입니다.");
}
//비과세(식대, 유류대) 160603
function printPayList4(search_year, search_month, w_date, w_time) {
	frm = document.printForm;
	frm.mode.value = "salary_list";
	frm.search_year.value = search_year;
	frm.search_month.value = search_month;
	frm.w_date.value = w_date;
	frm.w_time.value = w_time;
	frm.target = "_blank";
	frm.action = "pay_ledger_tax_free.php?code=<?=$com_code?>";
	frm.submit();
}
function month_plus() {
	f = document.searchForm;
	year_var = f.search_year.value;
	month_var = f.search_month.value;
	if(month_var == "12") {
		year_var = toInt(year_var) + 1;
		month_var = "01";
	} else {
		month_var = ""+(toInt(month_var) + 1);
		if(month_var.length == 1) {
		 month_var = "0"+month_var;
		}
	}
	if(year_var > <?=$year_now?>) {
		alert("<?=$year_now?>년까지 조회가 가능합니다.");
		return;
	}
	f.search_year.value = year_var;
	f.search_month.value = month_var;
	goSearch();
}
function month_minus() {
	f = document.searchForm;
	year_var = f.search_year.value;
	month_var = f.search_month.value;
	if(month_var == "01" || month_var == "") {
		year_var = toInt(year_var) - 1;
		month_var = "12";
	} else {
		month_var = ""+(toInt(month_var) - 1);
		if(month_var.length == 1) {
		 month_var = "0"+month_var;
		}
	}
	if(year_var == "2012") {
		alert("2013년부터 조회가 가능합니다.");
		return;
	}
	f.search_year.value = year_var;
	f.search_month.value = month_var;
	goSearch();
}
</script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script type="text/javascript">
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
<?
$previous_month_start = date("Y.m.01",strtotime("-1month"));
$previous_month_last_day = date('t', strtotime($previous_month_start));
$previous_month_end = date("Y.m",strtotime("-1month")).".".$previous_month_last_day;
$this_month_start = date("Y.m.01");
$this_month_last_day = date('t', strtotime($this_month_start));
$this_month_end = date("Y.m").".".$this_month_last_day;
$next_month_start = date("Y.m.01",strtotime("+1month"));
$next_month_last_day = date('t', strtotime($next_month_start));
$next_month_end = date("Y.m",strtotime("+1month")).".".$next_month_last_day;
?>
function stx_search_day_select(input_obj) {
	var frm = document.searchForm;
	if(input_obj.value == 1) {
		frm['search_sday'].value = "<?=$previous_month_start?>";
		frm['search_eday'].value = "<?=$previous_month_end?>";
	} else 	if(input_obj.value == 2) {
		frm['search_sday'].value = "<?=$this_month_start?>";
		frm['search_eday'].value = "<?=$this_month_end?>";
	} else 	if(input_obj.value == 3) {
		frm['search_sday'].value = "<?=$next_month_start?>";
		frm['search_eday'].value = "<?=$next_month_end?>";
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
function search_day_chk() {
	var frm = document.searchForm;
	if(frm.stx_search_day_chk.value=='') {
		alert('기간선택 후 날짜를 입력하세요.');
		frm.stx_search_day_chk.focus();
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
						<td width="100"><img src="images/top03.gif" border="0" alt="결산" /></td>
						<td width="132"><a href="settlement_pay.php"><img src="images/top03_06.gif" border="0" alt="급여관리" /></a></td>
						<td width="129"><a href="settlement_pay.php"><img src="images/menu06_top04_on.gif" border="0" alt="급여대장" /></a></td>
						<td width="129"><a href="pay_all.php"><img src="images/menu06_top03_off.gif" border="0" alt="급여반영" /></a></td>
						<td width="129"><a href="pay_stubs_list.php"><img src="images/menu06_top05_off.gif" border="0" alt="월/년 통계" /></a></td>
						<td></td>
					</tr>
					<tr><td height="1" bgcolor="#cccccc" colspan="9"></td></tr>
				</table>
				<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" style="padding:10px 0 0 0">

							<!--데이터 -->
							<table border="0" cellpadding="0" cellspacing="0">
								<tr> 
									<td id=""> 
										<table border="0" cellpadding="0" cellspacing="0">
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
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
							<form name="searchForm" method="get">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<col width="10%">
									<col width="">
									<col width="">
									<tr>
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">급여년도/월</td>
										<td nowrap class="tdrow">
											<select name="search_year" class="selectfm" onChange="goSearch();">
<?
for($i=2011;$i<=2016;$i++) {
?>
												<option value="<?=$i?>" <? if($i == $search_year) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
											</select> 년
											<select name="search_month" class="selectfm" onChange="goSearch();">
												<option value="" >전체</option>
<?
for($i=1;$i<13;$i++) {
	if($i < 10) $month = "0".$i;
	else $month = $i;
?>
												<option value="<?=$month?>" <? if($i == $search_month) echo "selected"; ?> ><?=$month?></option>
<?
}
?>
											</select> 월
											<div style="padding:0 0 0 2px;display:inline">
												<a href="javascript:month_minus();"><img src="images/btn_del.png" align="absmiddle" border="0"></a>
												<a href="javascript:month_plus();"><img src="images/btn_add.png" align="absmiddle" border="0"></a>
											</div>
										</td>
										<td  nowrap class="tdrow">
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;height:18px;"><tr><td width=2></td><td><img src=images/btn9_lt.gif></td>
											<td style="background:url(images/btn9_bg.gif) repeat-x center" class=ftbutton5_white nowrap><a href="javascript:goSearch();" target="">검 색</a></td><td><img src=images/btn9_rt.gif></td><td width=2></td></tr></table> 
										</td>
									</tr>
								</table>
							</form>
							<div style="height:10px;font-size:0px;line-height:0px;"></div>

							<form name="printForm" method="post" style="margin:0">
								<input type="hidden" name="mode">
								<input type="hidden" name="search_year" value="<?=$search_year?>">
								<input type="hidden" name="search_month" value="<?=$search_month?>">
								<input type="hidden" name="w_date">
								<input type="hidden" name="w_time">
							</form>

							<!--댑메뉴 -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
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

							<!--리스트 -->
							<style>
							.btn00 {display:inline-block;border-top:#DFDFDF solid 1px;border-left:#DFDFDF solid 1px;border-right:#DFDFDF solid 1px;border-bottom:#C0C0C0 solid 1px;}
							.btn00 a {display:inline-block;border-top:#FFFFFF solid 1px;background:#EFEFEF;padding:4px 7px 4px 7px;color:#444;font-family:dotum;font-size:11px;text-decoration:none;letter-spacing:-1px;}
							.btn00 a:hover {background:#E1E1E1;}
							.btn00 input {margin:0;cursor:pointer;border-top:#DFDFDF solid 1px;border-left:#DFDFDF solid 1px;border-right:#DFDFDF solid 1px;border-bottom:#C0C0C0 solid 1px;background:#EFEFEF;height:18px;color:#444;font-family:dotum;font-weight:bold;font-size:11px;text-decoration:none;letter-spacing:-1px;}
							.btn00 input:hover {background:#E1E1E1;}
							</style>
							<form name="dataForm" method="post">
							<input type="hidden" name="chk_data">
							<input type="hidden" name="page" value="<?=$page?>">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
								<tr>
									<td nowrap class="tdhead_center" width="3%"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()"></td>
<?
if($is_admin == "super") {
?>
									<td nowrap class="tdhead_center" width="162">사업장명</th>
<?
}
?>
									<td nowrap class="tdhead_center" width="60">연도</td>
									<td nowrap class="tdhead_center" width="40">월</td>
									<td nowrap class="tdhead_center" width="">급여대장명</td>
									<td nowrap class="tdhead_center" width="80">등록일</td>
<?
if($search_month) {
?>
									<td nowrap class="tdhead_center" width="60">등록시간</td>

<?
} else {
?>
									<td nowrap class="tdhead_center" width="60">저장횟수</td>

<?
}
if($search_month) {
?>
									<td nowrap class="tdhead_center" width="40">인원</td>
<?
	//디윅스
	if($com_code == "20284") {
?>
									<td nowrap class="tdhead_center" width="155" colspan="2">부서명</td>
<?
	} else {
?>
									<td nowrap class="tdhead_center" width="80">총임금계</td>
									<td nowrap class="tdhead_center" width="75">총공제계</td>
<?
	}
?>
									<td nowrap class="tdhead_center" width="80">총지급액</td>
<?
} else {
?>
									<td nowrap class="tdhead_center" width="305" colspan="4">부서명</td>
<?
}
?>
									<td nowrap class="tdhead_center" width="74">급여대장</td>
									<td nowrap class="tdhead_center" width="64">신고용</td>
									<td nowrap class="tdhead_center" width="64">비과세</td>
									<td nowrap class="tdhead_center" width="50">회계</td>
								</tr>
								<?
								//등록횟수
								$r_cnt = 1;
								for ($i=0; $row_reg_cnt=sql_fetch_array($result_reg_cnt); $i++) {
									$year = $row_reg_cnt['year'];
									$month = $row_reg_cnt['month'];
									//echo $year." == ".$old_year." && ".$month." == ".$old_month." &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ";
									$dept_txt = $row_reg_cnt['dept'];
									//echo $i." ".strstr($r_dept, $dept_txt);
									//echo $i.":".preg_match($dept_txt, $r_dept, $matches)." ";
									//echo $i.":".$dept_txt.":".$r_dept.":".$matches." ";
									//echo strpos($r_dept, $dept_txt);
									//echo $r_dept;
									if($year == $old_year && $month == $old_month) {
										//echo $i.":".mb_strpos($r_dept, $dept_txt, 0, "euc-kr").", ";
										//echo $month.":".$row_reg_cnt['dept'];
										if(!$r_dept) $r_dept = "";
										if($dept_txt) {
											if(!mb_strpos($r_dept, $dept_txt, 0, "euc-kr")) {
												$r_dept .= $row_reg_cnt['dept'].". ";
											}
										}
										$r_cnt++;
									} else {
										$r_cnt = 1;
										$r_dept = $row_reg_cnt['dept'].". ";
									}
									$reg_cnt_array[$year][$month] = $r_cnt;
									$reg_dept_array[$year][$month] = $r_dept;
									//echo $no." ";
									$old_year = $row_reg_cnt['year'];
									$old_month = $row_reg_cnt['month'];
								}
								// 리스트 출력
								for ($i=0; $row=sql_fetch_array($result); $i++) {
									$year = $row['year'];
									$month = $row['month'];
									//중복 급여대장 제외
									//echo $year." != ".$old_year." && ".$month." != ".$old_month;
									if($search_month || $year != $old_year || $month != $old_month || $i == 0) {
										//$page
										//$total_page
										//$rows
										$no = $total_count - $i - ($rows*($page-1));
										$list = $i%2;
										//사업장 코드 / 사번 / 코드_사번
										$code = $row['com_code'];
										$id = $row['sabun'];
										$code_id = $code."_".$id;
										// 사업장명 : 사업장코드
										$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$row[com_code]' ";
										$row_com = sql_fetch($sql_com);
										$com_name = $row_com['com_name'];
										$com_name = cut_str($com_name, 21, "..");
										$name = cut_str($row['name'], 6, "..");
										//연도,월
										//$search_year = 2013;
										//$search_month = 11-$i;
										//년월
										$year_month = $row['year']."_".$row['month'];
										//등록일
										$reg_day = $row['w_date'];
										//등록시간
										$reg_time = $row['w_time'];
										//등록자수
										$pay_count = $row['cnt'];
										//등록횟수
										$reg_cnt = $reg_cnt_array[$year][$month];
										//등록부서
										$reg_dept = $reg_dept_array[$year][$month];
										//echo " // ".$no;
										//서식 링크
										if($member['mb_profile'] == "guest") {
											$url_form = "javascript:alert_demo();";
											$url_form_report = "javascript:alert_demo();";
											$url_form_tax_free = "javascript:alert_demo();";
											$url_form_account = "javascript:alert_demo();";
											$url_pay_ledger = "javascript:alert_demo();";
											$url_pay_ledger_excel = "javascript:alert_demo();";
										} else {
											$url_form = "javascript:printPayList('$row[year]','$row[month]','$reg_day','$reg_time');";
											$url_form_report = "javascript:printPayList2('$row[year]','$row[month]','$reg_day','$reg_time');";
											$url_form_tax_free = "javascript:printPayList4('$row[year]','$row[month]','$reg_day','$reg_time');";
											$url_form_account = "javascript:printPayList3('$row[year]','$row[month]','$reg_day','$reg_time');";
											//(주)포밍 관리부, 생산부 구분 160115
											if($com_code == "20602") {
												//부서 코드
												$dept_code = $row['dept_code'];
												if($dept_code == 1) $url_pay_ledger = "pay_white.php?w=u&code=".$code."&search_year=".$row['year']."&search_month=".$row['month']."&w_date=".$reg_day."&w_time=".$reg_time;
												if($dept_code == 2) $url_pay_ledger = "pay_blue.php?w=u&code=".$code."&search_year=".$row['year']."&search_month=".$row['month']."&w_date=".$reg_day."&w_time=".$reg_time;
												else $url_pay_ledger = "pay_white.php?w=u&code=".$code."&search_year=".$row['year']."&search_month=".$row['month']."&w_date=".$reg_day."&w_time=".$reg_time;
											} else {
												$url_pay_ledger = "pay_all.php?w=u&code=".$code."&search_year=".$row['year']."&search_month=".$row['month']."&w_date=".$reg_day."&w_time=".$reg_time;
											}
											//화성시장애인부모회 상용직 엑셀 급여대장 160107
											if($com_code == "20399") $url_pay_ledger_excel = "pay_ledger_excel_h_month.php?code=".$code."&search_year=".$row['year']."&search_month=".$row['month']."&w_date=".$reg_day."&w_time=".$reg_time;
											else if($com_code == "20602") $url_pay_ledger_excel = "pay_ledger_excel_p.php?code=".$code."&search_year=".$row['year']."&search_month=".$row['month']."&w_date=".$reg_day."&w_time=".$reg_time; //(주)포밍
											else $url_pay_ledger_excel = "pay_ledger_excel.php?code=".$code."&search_year=".$row['year']."&search_month=".$row['month']."&w_date=".$reg_day."&w_time=".$reg_time;
										}
										$url_pay_ledger_list = "settlement_pay.php?search_year=".$row['year']."&search_month=".$row['month'];
								?>
<?
if($search_month) {
	$w_gubun = "";
} else {
	//해당 월 급여대장 전체삭제
	$w_gubun = "all";
}
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$code_id?>_<?=$year_month?>_<?=$reg_day?>_<?=$reg_time?>_<?=$w_gubun?>" class="no_borer"></td>
<?
if($is_admin == "super") {
?>
									<td nowrap class="ltrow1_center_h22"><?=$com_name?></td>
<?
}
?>
									<td nowrap class="ltrow1_center_h22"><?=$row[year]?>년</td>
									<td nowrap class="ltrow1_center_h22"><?=$row[month]?>월</td>
<?
if($search_month) {
?>
									<td nowrap class="ltrow1_center_h22"><a href="<?=$url_pay_ledger?>"><?=$row[year]?>년 <?=$row[month]?>월 급여대장</a></td>
<?
} else {
?>
									<td nowrap class="ltrow1_center_h22"><a href="<?=$url_pay_ledger_list?>" target=""><b><?=$row[year]?>년 <?=$row[month]?>월 급여대장</b></a></td>
<?
}
?>
									<td nowrap class="ltrow1_center_h22"><?=$reg_day?></td>
<?
if($search_month) {
	$w_gubun = "";
?>
									<td nowrap class="ltrow1_center_h22"><?=$reg_time?></td>
<?
} else {
	//해당 월 급여대장 전체삭제
	$w_gubun = "all";
?>
									<td nowrap class="ltrow1_center_h22"><?=$reg_cnt?></td>
<?
}
if($search_month) {
?>
									<td nowrap class="ltrow1_center_h22"><?=$pay_count?></td>
<?
	//디윅스
	if($com_code == "20284") {
?>
									<td class="ltrow1_left_h22" colspan="2">
										<?=$row[dept]?>
									</td>
<?
	} else {
?>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row[sum_total])?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row[sum_gongje])?></td>
<?
	}
?>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row[sum_result])?></td>
<?
} else {
?>
									<td class="ltrow1_left_h22" colspan="4">
										<?=$reg_dept?>
									</td>
<?
}
if($search_month) {
?>
									<td nowrap class="ltrow1_center_h22">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_form?>" target="">급여대장</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
									</td>
									<td nowrap class="ltrow1_center_h22">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_form_report?>" target="">신고용</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
									</td>
									<td nowrap class="ltrow1_center_h22">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_form_tax_free?>" target="">비과세</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
									</td>
									<td nowrap class="ltrow1_center_h22">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_form_account?>" target="">회계</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
									</td>
<?
} else {
?>
									<td nowrap class="ltrow1_center_h22" colspan="4">
										← 급여대장명 클릭하십시오.
									</td>
<?
}
?>
								</tr>
								</tr>
								<?
									}
									$old_year = $row['year'];
									$old_month = $row['month'];
								}
								if($i == 0) {
									echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
								} else if($i == 1) {
									echo "<input type='checkbox' name='idx' value='' class='no_borer' style='display:none'>";
								}
								?>
								<tr>
									<td nowrap class="tdhead_center"></td>
<?
if($is_admin == "super") {
?>
									<td nowrap class="tdhead_center"></td>
<? } ?>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
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
<?
//권한별 링크값
if($member['mb_profile'] == "guest") {
	$url_del = "javascript:alert_demo();";
	$url_view = "javascript:alert_demo();";
} else {
	$url_del = "javascript:checked_ok();";
	$url_view = "pay_list.php";
}
?>

							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
								<tr>
									<td align="center">
										<a href="<?=$url_del?>" target=""><img src="images/btn_choice_big.png" border="0"></a>
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
