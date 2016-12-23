<?
//$sub_menu = "1900700";
$sub_menu = "200700";
include_once("./_common.php");

$now_time = date("Y-m-d H:i:s");
$sql_common = " from com_list_gy a, com_list_gy_opt b ";

//echo $member[mb_profile];
if($is_admin != "super") {
	//$stx_man_cust_name = $member['mb_profile'];
}
$is_admin = "super";
//echo $is_admin;
$sql_search = " where a.com_code=b.com_code and a.com_code='$id' ";
$sql_order = "";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$top_sub_title = "images/top19_07.gif";
$sub_title = "감원방지기간조회(뷰)";
//$g4['title'] = $sub_title." : 사업분야 : ".$easynomu_name;
$g4['title'] = $sub_title." : 지원금 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
//echo $sql;
$result = sql_query($sql);
//echo $row[com_code];

$colspan = 11;

if($w == "u") {
	$row=mysql_fetch_array($result);
	if(!$row['com_code']) alert("해당 거래처는 삭제 되었거나 존재하지 않습니다.","main.php");
	//master 로그인시 com_code 오류
	if(!$com_code) $com_code = $id;
	//사업장DB 옵션2
	$sql_opt2 = " select * from com_list_gy_opt2 where com_code='$com_code' ";
	//echo $sql2;
	$result_opt2 = sql_query($sql_opt2);
	$row_opt2 = mysql_fetch_array($result_opt2);
	//감원방지기간조회 DB
	$sql2 = " select * from com_reduction where com_code='$com_code' ";
	//echo $sql2;
	$result2 = sql_query($sql2);
	$row2=mysql_fetch_array($result2);
	//최종확인자 로그 저장 (관리자 제외)
	if($member['mb_level'] != 10) {
		$mb_profile_code = $member['mb_profile'];
		$mb_id = $member['mb_id'];
		$sql_erp_view_log = " insert erp_view_log set branch='$mb_profile_code', user_id='$mb_id', com_code='$com_code', wr_datetime='$now_time' ";
		sql_query($sql_erp_view_log);
	}
}
//메모
$memo = $row['memo'];
//검색 파라미터 전송
$qstr = "stx_process=".$stx_process."&amp;stx_comp_name=".$stx_comp_name."&amp;stx_biz_no=".$stx_biz_no."&amp;stx_boss_name=".$stx_boss_name."&amp;stx_comp_tel=".$stx_comp_tel."&amp;stx_contract=".$stx_contract."&amp;stx_man_cust_name=".$stx_man_cust_name."&amp;stx_man_cust_name2=".$stx_man_cust_name2."&amp;stx_uptae=".$stx_uptae."&amp;stx_upjong=".$stx_upjong."&amp;stx_search_day_chk=".$stx_search_day_chk;
$qstr .= "&amp;stx_addr=".$stx_addr."&amp;stx_addr_first=".$stx_addr_first."&amp;stx_reduction_kind1=".$stx_reduction_kind1."&amp;stx_reduction_kind2=".$stx_reduction_kind2."&amp;stx_reduction_kind3=".$stx_reduction_kind3."&stx_reduction_manager_name=".$stx_reduction_manager_name;
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
function checkID()
{
	var frm = document.dataForm;
	if (frm.comp_bznb.value == "")
	{
		alert("사업자번호를 입력하세요.");
		frm.comp_bznb.focus();
		return;
	}
	var ret = window.open("./common/member_idcheck.php?user_id="+frm.comp_bznb.value, "id_check", "top=100, left=100, width=395,height=240");
	return;
}
function id_copy() {
	var frm = document.dataForm;
	frm.user_id.value = frm.comp_bznb.value;
}
function checkData(action_file) {
	var frm = document.dataForm;
	var rv = 0;
	frm.action = action_file;
	frm.submit();
	return;
}
// 삭제 검사 확인
function del(page,id) 
{
	if(confirm("삭제하시겠습니까?")) {
		location.href = "4insure_delete.php?page="+page+"&id="+id;
	}
}
function only_number() {
	//alert(event.keyCode);
	//키보드 상단 숫자키
	if (event.keyCode < 48 || event.keyCode > 57) {
		//키보드 우측 숫자키
		if (event.keyCode < 95 || event.keyCode > 105) {
			//del 46 , backsp 8 , left 37 , right 39 , tab 9 , shift 16
			if(event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39 && event.keyCode != 9 && event.keyCode != 16) {
				event.preventDefault ? event.preventDefault() : event.returnValue = false;
			}
		}
	}
}
function only_number_hyphen() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if (event.keyCode < 95 || event.keyCode > 105) {
			if(event.keyCode != 45) event.preventDefault ? event.preventDefault() : event.returnValue = false;
		}
	}
}
function only_number_comma() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if (event.keyCode < 95 || event.keyCode > 105) {
			if(event.keyCode != 46) event.returnValue = false;
		}
	}
}
function only_number_isnan() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if (event.keyCode < 95 || event.keyCode > 105) {
			event.preventDefault ? event.preventDefault() : event.returnValue = false;
		}
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
function open_upjong(n) {
	window.open("popup/upjong_popup.php?n=_"+n, "upjong_popup", "width=540, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
}
//담당자 선택 "2" 영업담당자
function findNomu(branch,kind) {
	var ret = window.open("pop_manage_cust.php?search_belong="+branch+"&kind="+kind, "pop_nomu_cust", "top=100, left=100, width=800,height=600, scrollbars");
	return;
}
//사업자번호 입력 하이픈
function checkhyphen(inputVal, type, keydown) {		// inputVal은 천단위에 , 표시를 위해 가져오는 값
	main = document.dataForm;			// 여기서 type 은 해당하는 값을 넣기 위한 위치지정 index
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
				if ( type =='1' ) {
					main.comp_bznb.value=total;					// type 에 따라 최종값을 넣어 준다.
				}
				else if ( type =='2' ) {
					main.t_insureno.value=total;					// type 에 따라 최종값을 넣어 준다.
				}
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
}
//사업장관리번호 입력 하이픈
function checkhyphen_tno(inputVal, type, keydown) {
	main = document.dataForm;			// 여기서 type 은 해당하는 값을 넣기 위한 위치지정 index
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
				main.t_insureno.value=total;
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
//숫자/영문만
function only_number_english() {
	if (event.keyCode < 48 || (event.keyCode > 57 && event.keyCode < 97) || (event.keyCode > 122))  event.preventDefault ? event.preventDefault() : event.returnValue = false;
}
//사업게시일 입력 콤마
function checkcomma(inputVal, type, keydown) {		// inputVal은 천단위에 , 표시를 위해 가져오는 값
	var main = document.dataForm;			// 여기서 type 은 해당하는 값을 넣기 위한 위치지정 index
	var chk		= 0;				// chk 는 천단위로 나눌 길이를 check
	var chk2	= 0;
	var chk3	= 0;
	var share	= 0;				// share 200,000 와 같이 3의 배수일 때를 구분하기 위한 변수
	var start	= 0;
	var triple	= 0;			// triple 3, 6, 9 등 3의 배수 
	var end		= 0;				// start, end substring 범위를 위한 변수  
	var total	= "";			
	var input	= "";				// total 임의로 string 들을 규합하기 위한 변수
	//숫자 입력만
	//alert(event.keyCode);
	input = delcomma(inputVal, inputVal.length);
	//관리자 master 입력
	//alert(input);
	if(1 == 1) { // 모두 포함
		//탭 시프트+탭 좌 우 Home backsp
		if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
			//alert(inputVal.length);
			//alert(input);
			if(inputVal.length == 4){
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,4)+".";
			} else if(inputVal.length == 7) {
				total += inputVal.substring(0,7)+".";
			} else if(inputVal.length == 12) {
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
function delcomma(inputVal, count){
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!='.'){		// 먼저 substring을 위해
			tmp += inputVal.substring(i,i+1);	// 값의 모든 , 를 제거
		}
	}
	return tmp;
}
function pay_day_last_chk(val) {
	var main = document.dataForm;
	if(val.checked == true) {
		if(main.pay_day.value != "") main.pay_day_old.value = main.pay_day.value;
		main.pay_day.value = "";
	} else {
		//alert(main.pay_day_old.value);
		main.pay_day.value = main.pay_day_old.value;
	}
}
//법인등록번호 입력 하이픈
function checkhyphen_bupin_no(inputVal, type, keydown) {		// inputVal은 천단위에 , 표시를 위해 가져오는 값
	main = document.dataForm;			// 여기서 type 은 해당하는 값을 넣기 위한 위치지정 index
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
			if(inputVal.length == 6){
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,6)+"-";
			} else {
				total += inputVal;
			}
			if(keydown =='Y'){
				if ( type =='1' ) {
					main.bupin_no.value=total;					// type 에 따라 최종값을 넣어 준다.
				}
				else if ( type =='2' ) {
					main.cust_ssnb.value=total;					// type 에 따라 최종값을 넣어 준다.
				}
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
}
function tab_view(tab) {
	var obj = document.getElementById(tab);
	if(obj.style.display == "none") {
		obj.style.display = "";
	} else {
		obj.style.display = "none";
	}
}
//천단위 콤바
function checkThousand(inputVal, type, keydown) {
	main = document.dataForm;
	var chk		= 0;
	var share	= 0;
	var start	= 0;
	var triple	= 0;
	var end		= 0;
	var total	= "";			
	var input	= "";
	//탭 시프트+탭 좌 우 Home backsp
	if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
		if (inputVal.length > 3) {
			input = delCom(inputVal, inputVal.length);
			chk = (input.length)/3;
			chk = Math.floor(chk);
			share = (input.length)%3;
			if (share == 0 ) {						
				chk = chk - 1;
			}
			for(i=chk; i>0; i--) {
				triple = i * 3;
				end = Number(input.length)-Number(triple);
				total += input.substring(start,end)+",";
				start = end;
			}
			total +=input.substring(start,input.length);
		} else {
			total = inputVal;
		}
		if(keydown =='Y') {
			type.value=total;
		}else if(keydown =='N') {
			return total
		}
		return total
	}
}
function delCom(inputVal, count) {
	var tmp = "";
	for(i=0; i<count; i++) {
		if(inputVal.substring(i,i+1)!=',') {
			tmp += inputVal.substring(i,i+1);
		}
	}
	return tmp;
}
function tab_show(tab) {
	var frm = document.dataForm;
	frm.tab.value = tab;
	document.getElementById(tab).style.display="";
	if(tab == "tab1") {
		document.getElementById('tab2').style.display="none";
		document.getElementById('tab_img1').src="./images/tab01_on.gif";
		document.getElementById('tab_img2').src="./images/tab02_off.gif";
	} else {
		document.getElementById('tab1').style.display="none";
		document.getElementById('tab_img1').src="./images/tab01_off.gif";
		document.getElementById('tab_img2').src="./images/tab02_on.gif";
	}
}
//number_format 함수
function number_format (number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');    }
    return s.join(dec);
}
//검색
function goSearch() {
	var frm = document.dataForm;
	frm.action = "reduction_prevention_view.php#search_result";
	frm.method = "get";
	frm.submit();
	return;
}
</script>
<?
include "inc/top.php";
?>
		<td onmouseover="showM('900')" valign="top">
			<div style="margin:10px 20px 20px 20px;min-height:480px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<!--<td width="100"><img src="images/top19.gif" border="0" alt="사업분야" /></td>-->
						<td width="100"><img src="images/top02.gif" border="0" alt="지원금" /></td>
						<td><a href="reduction_prevention.php"><img src="<?=$top_sub_title?>" border="0" alt="<?=$sub_title?>" /></a></td>
						<td>
<?
//$title_main_no = "19";
$title_main_no = "02";
include "inc/sub_menu.php";
?>
						</td>
					</tr>
					<tr><td height="1" bgcolor="#cccccc" colspan="9"></td></tr>
				</table>
				<table width="<?=$content_width?>" border="0" align="left" cellpadding="0" cellspacing="0" >
					<tr>
						<td valign="top" style="padding:10px 0 0 0">
							<!--타이틀 -->	
<?
//$samu_list = "ok";
$report = "ok";
//관리점 숨기기
if(!$w || $row['damdang_code'] == $mb_profile_code || $row['damdang_code2'] == $mb_profile_code || $member['mb_level'] >= 9) $hidden_branch = "";
else $hidden_branch = "ok";
include "inc/client_basic_info.php";
?>
									<div style="height:10px;font-size:0px;line-height:0px;"></div>
								</div><!--프린트 영역 DIV 종료-->
								<!--탭메뉴 -->
<?
//현재 탭 메뉴 번호
$tab_onoff_this = 13;
//프로그램 종류
if($row['easynomu_yn'] == 1) {
	$tab_program_url = 1;
} else if($row['easynomu_yn'] == 2) {
	$tab_program_url = 2;
} else {
	$tab_program_url = 1;
	if($row['construction_yn'] == 1) $tab_program_url = 3;
}
include "inc/tab_menu.php";
?>
								<!--거래처 ID Form Input-->
								<input type="hidden" name="id" value="<?=$id?>" />
								<a name="80002"><!--첨부서류 (본사 → 지사)--></a>
								<table border=0 cellspacing=0 cellpadding=0 style=""> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/so_tab_on_lt.gif"></td> 
													<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:140;text-align:center'> 
														첨부서류 (본사 → 지사)
													</td> 
													<td><img src="images/so_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=2></td> 
										<td valign="bottom"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="botr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!-- 입력폼 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일1</td>
										<td   class="tdrow" width="373">
											<a href="files/convey_file/<?=$row_opt2['convey_file_1']?>" target="_blank"><?=$row_opt2['convey_file_1']?></a>
										</td>
										<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일2</td>
										<td   class="tdrow" >
											<a href="files/convey_file/<?=$row_opt2['convey_file_2']?>" target="_blank"><?=$row_opt2['convey_file_2']?></a>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일3</td>
										<td   class="tdrow" width="">
											<a href="files/convey_file/<?=$row_opt2['convey_file_3']?>" target="_blank"><?=$row_opt2['convey_file_3']?></a>
										</td>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일4</td>
										<td   class="tdrow" >
											<a href="files/convey_file/<?=$row_opt2['convey_file_4']?>" target="_blank"><?=$row_opt2['convey_file_4']?></a>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일5</td>
										<td   class="tdrow" width="373">
											<a href="files/convey_file/<?=$row_opt2['convey_file_5']?>" target="_blank"><?=$row_opt2['convey_file_5']?></a>
										</td>
										<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일6</td>
										<td   class="tdrow" >
											<a href="files/convey_file/<?=$row_opt2['convey_file_6']?>" target="_blank"><?=$row_opt2['convey_file_6']?></a>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>
								<table border=0 cellspacing=0 cellpadding=0 style=""> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/so_tab_on_lt.gif"></td> 
													<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:120px;text-align:center'> 
														취득/상실 업로드
													</td> 
													<td><img src="images/so_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=2></td> 
										<td valign="bottom"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="botr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
<?
//담당 지사, 열람 지사, 본사 권한
if(!$w || $row['damdang_code'] == $mb_profile_code || $row['damdang_code2'] == $mb_profile_code || $member['mb_level'] != 6) $is_damdang = "ok";
else $is_damdang = "";
//엑셀 파일 존재 여부
if($row2['in_file_1']) $excel = $row2['in_file_1'];
if($row2['out_file_1']) $excel2 = $row2['out_file_1'];
//기간설정 초기화
if(!$row2['before_month']) $before_month = 12;
else $before_month = $row2['before_month'];
if(!$row2['after_month']) $after_month = 3;
else $after_month = $row2['after_month'];
if(!$row2['before_month2']) $before_month2 = 6;
else $before_month2 = $row2['before_month2'];
if(!$row2['after_month2']) $after_month2 = 3;
else $after_month2 = $row2['after_month2'];
//기간설정 검색
if($stx_before_month) $before_month = $stx_before_month;
if($stx_after_month) $after_month = $stx_after_month;
if($stx_before_month2) $before_month2 = $stx_before_month2;
if($stx_after_month2) $after_month2 = $stx_after_month2;
?>
								<!-- 입력폼 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">취득 <? if($is_damdang) { ?><input type="checkbox" name="in_file_del_1" value="1" style="vertical-align:middle">삭제<? } ?></td>
										<td   class="tdrow" width="365">
											<? if($is_damdang) { ?><input name="in_file_1" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
											<a href="files/reduction_file/<?=$row2['in_file_1']?>" target="_blank"><?=$row2['in_file_1']?></a>
											<input type="hidden" name="i_file_1" value="<?=$row2['in_file_1']?>">
										</td>
										<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">상실 <? if($is_damdang) { ?><input type="checkbox" name="out_file_del_1" value="1" style="vertical-align:middle">삭제<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang) { ?><input name="out_file_1" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
											<a href="files/reduction_file/<?=$row2['out_file_1']?>" target="_blank"><?=$row2['out_file_1']?></a>
											<input type="hidden" name="o_file_1" value="<?=$row2['out_file_1']?>">
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">처리현황<font color="red"></font></td>
										<td nowrap class="tdrow" colspan="3">
<?
$sel_check_ok = array();
$check_ok_id = $row2['reduction_process'];
$sel_check_ok[$check_ok_id] = "selected";
if( ($is_admin == "super" && $member['mb_level'] != 6) ) $is_damdang = "ok";
else $is_damdang = "";
if($is_damdang) {
?>
											<select name="reduction_process" class="selectfm" style="float:left;">
												<option value="">선택</option>
												<option value="1" <?=$sel_check_ok['1']?>><?=$reduction_process_arry[1]?></option>
												<option value="6" <?=$sel_check_ok['6']?>><?=$reduction_process_arry[6]?></option>
												<option value="2" <?=$sel_check_ok['2']?>><?=$reduction_process_arry[2]?></option>
												<option value="7" <?=$sel_check_ok['7']?>><?=$reduction_process_arry[7]?></option>
												<option value="5" <?=$sel_check_ok['5']?>><?=$reduction_process_arry[5]?></option>
											</select>
<?
} else {
	echo $reduction_process_arry[$check_ok_id];
}
?>
<?
//권한별 링크값
$url_save = "javascript:checkData('reduction_prevention_update.php');";
?>
											<table border="0" cellpadding="0" cellspacing="0" style="margin-left:10px;display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="<?=$url_save?>" target="">저장</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">특이사항<font color="red"></font></td>
										<td nowrap class="tdrow" colspan="3">
											<textarea name="reduction_memo" class="textfm" style='width:100%;height:68px;word-break:break-all;'><?=$row2['reduction_memo']?></textarea>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td id=""> 
											<table border="0" cellpadding="0" cellspacing="0" style="cursor:pointer;" onclick="var div_display='in_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}">
												<tr> 
													<td><img src="images/so_tab_on_lt.gif"></td> 
													<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:120px;text-align:center'> 
														취득자 리스트
													</td> 
													<td><img src="images/so_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=6></td> 
										<td valign="bottom" style="padding-left:10px;">
										</td> 
										</td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="botr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--취득자 div-->
								<div id="in_div" style="display:none;">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:">
									<tr>
										<td class="tdhead_center" width="26"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" ></td>
										<td class="tdhead_center" width="46">No</td>
										<td class="tdhead_center" width="80">구분</td>
										<td class="tdhead_center" width="110">성명</td>
										<td class="tdhead_center" width="100">생년월일</td>
										<td class="tdhead_center" width="100">취득일자</td>
										<td class="tdhead_center" width="100">비고</td>
										<td class="tdhead_center" width="60">연령</td>
										<td class="tdhead_center" width="">직종</td>
									</tr>
<?
//엑셀 리더
include $_SERVER["DOCUMENT_ROOT"]."/PHPExcel/Classes/PHPExcel.php";
if($excel) {
	$UpFileExt = "xls";
	$objPHPExcel = new PHPExcel();
	$upload_path = $_SERVER["DOCUMENT_ROOT"]."/erp/files/reduction_file";
	$upfile_path = $upload_path."/".$excel;
	//echo $upfile_path;
	if(file_exists($upfile_path)) {
		$inputFileType = 'Excel2007';
		if($UpFileExt == "xls") {
			$inputFileType = 'Excel5';	
		}
		//echo $inputFileType;
		$objReader = PHPExcel_IOFactory::createReaderForFile($upfile_path);
		$objPHPExcel = $objReader->load($upfile_path);
		$objPHPExcel ->setActiveSheetIndex(0);
		$objWorksheet = $objPHPExcel->getActiveSheet(); 
		$maxRow = $objWorksheet->getHighestRow(); 
		//echo $maxRow;
		$m = 0;
		$count_page = 0;

		//서식 비교 (3.17 서식 변경됨)
		$excel_new_form = $objWorksheet->getCell('A' . 2)->getValue();
		$new_form = iconv("UTF-8", "EUC-KR", $excel_new_form);
		$new_form_chk = substr($new_form,0,2);
		//echo $excel_new_form;

		//연번
		$start_line = 2;
		//echo $excel_count;
		//echo $excel_type;
		$p = 0;
		for ($i = 0; $i < $maxRow; $i++) {
			$k = $i + $start_line;
			$excel_code[$i] = $objWorksheet->getCell('A' . $k)->getValue(); 
			$excel_kind[$i] = $objWorksheet->getCell('D' . $k)->getValue();
			$excel_name[$i] = $objWorksheet->getCell('F' . $k)->getValue();
			$excel_ssnb[$i] = $objWorksheet->getCell('E' . $k)->getValue();
			$excel_sj_sdate[$i] = $objWorksheet->getCell('G' . $k)->getValue();
			$excel_memo[$i] = $objWorksheet->getCell('I' . $k)->getValue();
			$excel_age_in[$i] = trim($objWorksheet->getCell('J' . $k)->getValue()); 
			$excel_job[$i] = $objWorksheet->getCell('L' . $k)->getValue();

			//한글 인코딩
			$in_out_kind_in[$i] = iconv("UTF-8", "EUC-KR", $excel_kind[$i]);
			$name_in[$i] = iconv("UTF-8", "EUC-KR", $excel_name[$i]);
			$excel_memo[$i] = iconv("UTF-8", "EUC-KR", $excel_memo[$i]);
			$excel_job[$i] = iconv("UTF-8", "EUC-KR", $excel_job[$i]);
			$ssnb_in[$i] = $excel_ssnb[$i];
			$bohum_code[$i] = $excel_bohum_code[$i];
			if($excel_sj_sdate[$i])  $sj_sdate_in[$i] = substr($excel_sj_sdate[$i],0,4)."-".substr($excel_sj_sdate[$i],5,2)."-".substr($excel_sj_sdate[$i],8,2);
			else $sj_sdate_in[$i] = "-";
			//데이터가 있을 경우
			if($excel_code[$i]) {
				$p++;
?>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
										<td class="ltrow1_center_h22"><?=$excel_code[$i]?></td>
										<td class="ltrow1_center_h22"><?=$in_out_kind_in[$i]?></td>
										<td class="ltrow1_center_h22"><?=$name_in[$i]?></td>
										<td class="ltrow1_center_h22"><?=$ssnb_in[$i]?></td>
										<td class="ltrow1_center_h22"><?=$sj_sdate_in[$i]?></td>
										<td class="ltrow1_center_h22"><?=$excel_memo[$i]?></td>
										<td class="ltrow1_center_h22"><?=$excel_age_in[$i]?></td>
										<td class="ltrow1_left_h22"><?=$excel_job[$i]?></td>
									</tr>
<?
			}
		}
		//취득자 카운트
		$in_cnt = $p;
	}
}
//echo $m;
?>
								</table>
								</div>
								<div style="height:10px;font-size:0px"></div>
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td id=""> 
											<table border="0" cellpadding="0" cellspacing="0" style="cursor:pointer;" onclick="var div_display='out_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}">
												<tr> 
													<td><img src="images/so_tab_on_lt.gif"></td> 
													<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:120px;text-align:center'> 
														상실자 리스트
													</td> 
													<td><img src="images/so_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=6></td> 
										<td valign="bottom" style="padding-left:10px;">
										</td> 
										</td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="botr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--상실자 div-->
								<div id="out_div" style="display:none;">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:">
									<tr>
										<td class="tdhead_center" width="26"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" ></td>
										<td class="tdhead_center" width="46">No</td>
										<td class="tdhead_center" width="80">구분</td>
										<td class="tdhead_center" width="110">성명</td>
										<td class="tdhead_center" width="100">생년월일</td>
										<td class="tdhead_center" width="100">취득일자</td>
										<td class="tdhead_center" width="100">상일일자</td>
										<td class="tdhead_center" width="60">연령</td>
										<td class="tdhead_center" width="">상실사유</td>
									</tr>
<?
//엑셀 리더
if($excel2) {
	$UpFileExt = "xls";
	$objPHPExcel = new PHPExcel();
	$upload_path = $_SERVER["DOCUMENT_ROOT"]."/erp/files/reduction_file";
	$upfile_path = $upload_path."/".$excel2;
	//echo $upfile_path;
	if(file_exists($upfile_path)) {
		$inputFileType = 'Excel2007';
		if($UpFileExt == "xls") {
			$inputFileType = 'Excel5';	
		}
		//echo $inputFileType;
		$objReader = PHPExcel_IOFactory::createReaderForFile($upfile_path);
		$objPHPExcel = $objReader->load($upfile_path);
		$objPHPExcel ->setActiveSheetIndex(0);
		$objWorksheet = $objPHPExcel->getActiveSheet(); 
		$maxRow = $objWorksheet->getHighestRow(); 
		//echo $maxRow;
		$m = 0;
		$count_page = 0;

		//서식 비교 (3.17 서식 변경됨)
		$excel_new_form = $objWorksheet->getCell('A' . 2)->getValue();
		$new_form = iconv("UTF-8", "EUC-KR", $excel_new_form);
		$new_form_chk = substr($new_form,0,2);
		//echo $excel_new_form;

		//연번
		$start_line = 2;
		//echo $excel_count;
		//echo $excel_type;
		$p = 0;
		$e = 0;
		$c = 0;
		for ($i = 0; $i < $maxRow; $i++) {
			$k = $i + $start_line;
			$excel_code[$i] = $objWorksheet->getCell('A' . $k)->getValue(); 
			$excel_kind[$i] = $objWorksheet->getCell('D' . $k)->getValue();
			$excel_name[$i] = $objWorksheet->getCell('F' . $k)->getValue();
			$excel_ssnb[$i] = $objWorksheet->getCell('E' . $k)->getValue();
			$excel_sj_sdate[$i] = $objWorksheet->getCell('G' . $k)->getValue();
			$excel_sj_edate[$i] = $objWorksheet->getCell('H' . $k)->getValue();
			$excel_age_out[$i] = trim($objWorksheet->getCell('J' . $k)->getValue()); 
			$excel_case[$i] = $objWorksheet->getCell('L' . $k)->getValue();

			//한글 인코딩
			$in_out_kind[$i] = iconv("UTF-8", "EUC-KR", $excel_kind[$i]);
			$name_out[$i] = iconv("UTF-8", "EUC-KR", $excel_name[$i]);
			$excel_case[$i] = iconv("UTF-8", "EUC-KR", $excel_case[$i]);
			$ssnb_out[$i] = $excel_ssnb[$i];
			$bohum_code[$i] = $excel_bohum_code[$i];
			if($excel_sj_sdate[$i])  $sj_sdate_out[$i] = substr($excel_sj_sdate[$i],0,4)."-".substr($excel_sj_sdate[$i],5,2)."-".substr($excel_sj_sdate[$i],8,2);
			else $sj_sdate_out[$i] = "-";
			if($excel_sj_edate[$i])  $sj_edate_out[$i] = substr($excel_sj_edate[$i],0,4)."-".substr($excel_sj_edate[$i],5,2)."-".substr($excel_sj_edate[$i],8,2);
			else $sj_edate_out[$i] = "-";
			//데이터가 있을 경우
			if($excel_code[$i]) {
				$p++;
				//권고사직
				if($excel_case[$i] == "경영상 필요 및 회사불황으로 인원감축 등에 의한 퇴사(해고,권고,사직,명예퇴직 포함)" || $excel_case[$i] == "기타회사사정에 의한 퇴직" || $excel_case[$i] == "근로자의 귀책사유에 의한 징계해고, 권고사직" || $excel_case[$i] == "근로자의 귀책사유에 의한 징계해고,권고사직" || $excel_case[$i] == "경영상 필요에 의한 해고") {
					$tr_class = "list_row_now_gr";
					$color_red = "color:red;";
					//권고사직 기간 계산
					$dehiring_date[$e] = $sj_edate_out[$i];
					$e++;
				} else {
					$tr_class = "list_row_now_wh";
					$color_red = "";
					//권고사직 근로자 제외
					$in_out_kind_clean[$c] = $in_out_kind[$i];
					$name_out_clean[$c] = $name_out[$i];
					//echo $c." ".$name_out_clean[$c];
					$ssnb_out_clean[$c] = $ssnb_out[$i];
					$sj_sdate_out_clean[$c] = $sj_sdate_out[$i];
					$sj_edate_out_clean[$c] = $sj_edate_out[$i];
					$excel_age_clean[$c] = $excel_age_out[$i];
					$excel_case_clean[$c] = $excel_case[$i];
					$c++;
				}
?>
									<tr class="<?=$tr_class?>" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='<?=$tr_class?>';">
										<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
										<td class="ltrow1_center_h22"><?=$excel_code[$i]?></td>
										<td class="ltrow1_center_h22"><?=$in_out_kind[$i]?></td>
										<td class="ltrow1_center_h22"><?=$name_out[$i]?></td>
										<td class="ltrow1_center_h22"><?=$ssnb_out[$i]?></td>
										<td class="ltrow1_center_h22"><?=$sj_sdate_out[$i]?></td>
										<td class="ltrow1_center_h22" style="<?=$color_red?>"><?=$sj_edate_out[$i]?></td>
										<td class="ltrow1_center_h22"><?=$excel_age_out[$i]?></td>
										<td class="ltrow1_left_h22"><?=$excel_case[$i]?></td>
									</tr>
<?
			}
		}
		//상실자 카운트
		$out_cnt = $p;
		//권고사직 카운트
		$dehiring_cnt = $e;
		//권고사직 제외 카운트
		$clean_cnt = $c;
	}
}
//echo $m;
?>
								</table>
								</div>
								<div style="height:10px;font-size:0px"></div>
								<a name="search_result"><!--검색 결과--></a>
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td id=""> 
											<table border="0" cellpadding="0" cellspacing="0">
												<tr> 
													<td><img src="images/so_tab_on_lt.gif"></td> 
													<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:120px;text-align:center'> 
														감원방지기간조회
													</td> 
													<td><img src="images/so_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=6></td> 
										<td valign="bottom" style="padding-left:10px;">
										</td> 
										</td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="botr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!-- 입력폼 -->
<?
//현재 일자
$now_date = date("Y-m-d");
//3년 6개월 이전
$ago_3year = date("Y-m-d", strtotime("- 3 year", strtotime($now_date)));
$ago_3year_6month = date("Y-m-d", strtotime("- 6 month", strtotime($ago_3year)));
//echo $ago_3year_6month;
//만 65세 계산용 일자
$age65 = date("Y-m-d", strtotime("- 65 year", strtotime($now_date)));
//echo $age65;
//정책 변경 일자
$standard_date = "2013-01-25";
?>
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="electric_charges_div" style="">
									<tr>
										<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">기간설정<font color="red"></font></td>
										<td nowrap class="tdrow">
											[2013년 1월 25일 이후] 전 <input name="stx_before_month" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$before_month?>" maxlength="2" /> 개월
											/
											후 <input name="stx_after_month" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$after_month?>" maxlength="2" /> 개월
											[2013년 1월 24일 이전] 전 <input name="stx_before_month2" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$before_month2?>" maxlength="2" /> 개월
											/
											후 <input name="stx_after_month2" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$after_month2?>" maxlength="2" /> 개월
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:goSearch();">검색</a></td><td><img src="./images/btn2_rt.gif"></td><td width="2"></td></tr></table>
											(권고사직 기준)
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" width="120" style="padding:6px;"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">권고사직 기간<div style="margin:4px 0 0 4px;">(2013.1.25 이후)</div><font color="red"></font></td>
										<td class="tdrow" colspan="">
<?
//권고사직 일자
for($i=0; $i<$dehiring_cnt; $i++) {
	$dehiring_sdate[$i] = date("Y-m-d", strtotime("-".$before_month." month", strtotime($dehiring_date[$i])));
	$dehiring_edate[$i] = date("Y-m-d", strtotime("+".$after_month." month", strtotime($dehiring_date[$i])));
	//echo $dehiring_date[$i]." ".$standard_date;
	if($dehiring_date[$i] >= $standard_date) echo "<strong>".$dehiring_date[$i]."</strong>(".$dehiring_sdate[$i]."~".$dehiring_edate[$i].") ";
}
?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" width="120" style="padding:6px;"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">권고사직 기간<div style="margin:4px 0 0 4px;">(2013.1.24 이전)</div><font color="red"></font></td>
										<td class="tdrow" colspan="">
<?
//권고사직 일자
for($i=0; $i<$dehiring_cnt; $i++) {
	$dehiring_sdate2[$i] = date("Y-m-d", strtotime("-".$before_month2." month", strtotime($dehiring_date[$i])));
	$dehiring_edate2[$i] = date("Y-m-d", strtotime("+".$after_month2." month", strtotime($dehiring_date[$i])));
	if($dehiring_date[$i] < $standard_date) echo "<strong>".$dehiring_date[$i]."</strong>(".$dehiring_sdate2[$i]."~".$dehiring_edate2[$i].") ";
}
?>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td id=""> 
											<table border="0" cellpadding="0" cellspacing="0">
												<tr> 
													<td><img src="images/so_tab_on_lt.gif"></td> 
													<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:120px;text-align:center'> 
														대상자 확인 결과
													</td> 
													<td><img src="images/so_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=6></td> 
										<td valign="bottom" style="padding-left:10px;">
										</td> 
										</td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="botr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!-- 입력폼 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:">
									<tr>
										<td class="tdhead_center" width="26"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" ></td>
										<td class="tdhead_center" width="46">No</td>
										<td class="tdhead_center" width="80">구분</td>
										<td class="tdhead_center" width="110">성명</td>
										<td class="tdhead_center" width="100">생년월일</td>
										<td class="tdhead_center" width="100">취득일자</td>
										<td class="tdhead_center" width="100">비고/상실일자</td>
										<td class="tdhead_center" width="60">연령</td>
										<td class="tdhead_center" width="">직종/상실사유</td>
									</tr>
<?
//대상자 DB 삭제 com_reduction_opt
$sql_del = "select * from com_reduction_opt where com_code = '$id' ";
$row_del = sql_fetch($sql_del);
if($row['com_code']) sql_query("delete from com_reduction_opt where com_code = '$id' ");
//대상자 추출(취득자)
$k = 0;
for($i=0; $i<$in_cnt; $i++) {
	//권고사직 기간 제외
	$dehiring_except[$i] = "ok";
	for($m=0; $m<$dehiring_cnt; $m++) {
		//취득일자가 정책 변경 이전일 경우 151124
		if($sj_sdate_in[$i] < $standard_date) {
			if($sj_sdate_in[$i] > $dehiring_sdate2[$m] && $sj_sdate_in[$i] < $dehiring_edate2[$m]) $dehiring_except[$i] = "";
		} else {
			if($sj_sdate_in[$i] > $dehiring_sdate[$m] && $sj_sdate_in[$i] < $dehiring_edate[$m]) $dehiring_except[$i] = "";
		}
	}
	//3년 6개월 이전 제외
	if($sj_sdate_in[$i] < $ago_3year_6month) $dehiring_except[$i] = "";
	//만65세 이상 제외
	$birth_date = "19".substr($ssnb_in[$i],0,2)."-".substr($ssnb_in[$i],3,2)."-".substr($ssnb_in[$i],6,2);
	if($birth_date < $age65) $dehiring_except[$i] = "";
	//권고사직 기간 제외 근로자 추출
	if($dehiring_except[$i]) {
		$k++;
?>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
										<td class="ltrow1_center_h22"><?=$k?></td>
										<td class="ltrow1_center_h22"><?=$in_out_kind_in[$i]?></td>
										<td class="ltrow1_center_h22"><?=$name_in[$i]?></td>
										<td class="ltrow1_center_h22"><?=$ssnb_in[$i]?></td>
										<td class="ltrow1_center_h22"><?=$sj_sdate_in[$i]?></td>
										<td class="ltrow1_center_h22"><?=$excel_memo[$i]?></td>
										<td class="ltrow1_center_h22"><?=$excel_age_in[$i]?></td>
										<td class="ltrow1_left_h22"><?=$excel_job[$i]?></td>
									</tr>
<?
		//대상자 DB 저장 com_reduction_opt
		$sql_common_opt = " mid='$row2[idx]', in_out='$in_out_kind_in[$i]', name='$name_in[$i]', birth='$ssnb_in[$i]', in_day='$sj_sdate_in[$i]', out_day='$excel_memo[$i]', age='$excel_age_in[$i]', quit_case='$excel_job[$i]' ";
		$sql_opt = " insert com_reduction_opt set $sql_common_opt , com_code = '$id' ";
		sql_query($sql_opt);
	}
}
//대장자 추출(취득자) 카운트
$in_clean_cnt = $k;
//echo $clean_cnt;
//대상자 추출(상실자)
$k = 0;
$k2 = 0;
for($i=0; $i<$clean_cnt; $i++) {
	//3개월 이상 근로자 추출
	$datetime1 = date_create($sj_sdate_out_clean[$i]);
	$datetime2 = date_create($sj_edate_out_clean[$i]);
	$interval = date_diff($datetime1, $datetime2);
	$str[$i] =  $interval->format('%y 년 %m 개월 %d 일 ');
	$result_year[$i] =  $interval->format('%y');
	$result_month[$i] =  $interval->format('%m');
	//echo $str[$i];
	//권고사직 기간 제외
	$dehiring_except[$i] = "ok";
	for($m=0; $m<$dehiring_cnt; $m++) {
		//취득일자가 정책 변경 이전일 경우 151124
		if($sj_sdate_out_clean[$i] < $standard_date) {
			if($sj_sdate_out_clean[$i] > $dehiring_sdate2[$m] && $sj_sdate_out_clean[$i] < $dehiring_edate2[$m]) $dehiring_except[$i] = "";
			//상실일 제외
			//if($sj_edate_out_clean[$i] > $dehiring_sdate2[$m] && $sj_edate_out_clean[$i] < $dehiring_edate2[$m]) $dehiring_except[$i] = "";
		} else {
			if($sj_sdate_out_clean[$i] > $dehiring_sdate[$m] && $sj_sdate_out_clean[$i] < $dehiring_edate[$m]) $dehiring_except[$i] = "";
			//상실일 제외
			//if($sj_edate_out_clean[$i] > $dehiring_sdate[$m] && $sj_edate_out_clean[$i] < $dehiring_edate[$m]) $dehiring_except[$i] = "";
			//if($i == 61) echo $name_out_clean[$i]." ".$sj_sdate_out_clean[$i]." > ".$dehiring_sdate[$m]." && ".$sj_sdate_out_clean[$i]." < ".$dehiring_edate[$m]." : ".$dehiring_except[$i]."<br /> ";
			//if($i == 61) echo $name_out_clean[$i]." ".$sj_edate_out_clean[$i]." > ".$dehiring_sdate[$m]." && ".$sj_edate_out_clean[$i]." < ".$dehiring_edate[$m]." : ".$dehiring_except[$i]."<br /> ";
		}
		//echo $name_out_clean[$i]." ".$sj_sdate_out_clean[$i]." < ".$dehiring_sdate[$m]." && ".$sj_sdate_out_clean[$i]." > ".$dehiring_edate[$m]." ";
		//echo $name_out_clean[$i]." ".$sj_edate_out_clean[$i]." < ".$dehiring_sdate[$m]." && ".$sj_edate_out_clean[$i]." > ".$dehiring_edate[$m]." ";
		//echo $name_out_clean[$i]." ".$dehiring_except[$i]."<br /> ";
	}
	//3년 6개월 이전 제외
	if($sj_sdate_out_clean[$i] < $ago_3year_6month) $dehiring_except[$i] = "";
	//만65세 이상 제외
	$birth_date = "19".substr($ssnb_out_clean[$i],0,2)."-".substr($ssnb_out_clean[$i],3,2)."-".substr($ssnb_out_clean[$i],6,2);
	//if($i == 61) echo $birth_date." < ".$age65;
	if($birth_date < $age65) $dehiring_except[$i] = "";
	//1년 이상, 1년 미만일 경우 3개월 이상 근무자, /권고사직 기간 제외
	if( ($result_year[$i] >= 1 || ($result_year[$i] == 0 && $result_month[$i] >= 3) ) && $dehiring_except[$i] ) {
		$k++;
		$k2 = $in_clean_cnt + $k;
?>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
										<td class="ltrow1_center_h22"><?=$k2?></td>
										<td class="ltrow1_center_h22"><?=$in_out_kind_clean[$i]?></td>
										<td class="ltrow1_center_h22"><?=$name_out_clean[$i]?></td>
										<td class="ltrow1_center_h22"><?=$ssnb_out_clean[$i]?></td>
										<td class="ltrow1_center_h22"><?=$sj_sdate_out_clean[$i]?></td>
										<td class="ltrow1_center_h22"><?=$sj_edate_out_clean[$i]?></td>
										<td class="ltrow1_center_h22"><?=$excel_age_clean[$i]?></td>
										<td class="ltrow1_left_h22"><?=$excel_case_clean[$i]?></td>
									</tr>
<?
		//대상자 DB 저장 com_reduction_opt
		$sql_common_opt = " mid='$row2[idx]', in_out='$in_out_kind_clean[$i]', name='$name_out_clean[$i]', birth='$ssnb_out_clean[$i]', in_day='$sj_sdate_out_clean[$i]', out_day='$sj_edate_out_clean[$i]', age='$excel_age_clean[$i]', quit_case='$excel_case_clean[$i]' ";
		$sql_opt = " insert com_reduction_opt set $sql_common_opt , com_code = '$id' ";
		sql_query($sql_opt);
	}
}
//처리현황, 대상자 없을 경우 해당없음 변경 151118
if(!$check_ok_id && $k2 == 0) {
	$sql_common = " update com_reduction set reduction_process='5' where com_code = '$id' ";
	sql_query($sql_common);
}
//대상자 없을 경우 메세지 표시
if($in_clean_cnt == 0 && $k2 == 0) {
	$colspan = 9;
	echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
}
?>
								</table>
								<div style="height:10px;font-size:0px"></div>
								<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
									<tr>
										<td align="center">
<?
//권한별 링크값
$url_save = "javascript:checkData('reduction_prevention_update.php');";
?>
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="<?=$url_save?>" target="">조 회</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./reduction_prevention_result_excel.php?idx=<?=$row2['idx']?>">엑셀저장</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./reduction_prevention.php?page=<?=$page?>&<?=$qstr?>">목 록</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./acceleration_employment_view.php?w=<?=$w?>&id=<?=$id?>" target="">신규고용확인</a></td><td><img src=images/btn_rt.gif></td><td width="2"></td></tr></table>
										</td>
									</tr>
								</table>
								<div style="height:4px;font-size:0px"></div>
							</div>
							<div id="tab2" >
								<a name="40001"><!--전달사항--></a>
<?
$memo_type = 12;
include "inc/client_comment_only.php";
?>
							<div style="height:20px;font-size:0px"></div>
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
