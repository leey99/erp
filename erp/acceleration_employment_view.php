<?
//$sub_menu = "1900600";
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

$top_sub_title = "images/top19_06.gif";
$sub_title = "신규고용확인(뷰)";
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
	//신규고용확인 DB
	$sql2 = " select * from com_employment where com_code='$com_code' ";
	//echo $sql2;
	$result2 = sql_query($sql2);
	$row2=mysql_fetch_array($result2);
	//사업장DB 옵션2
	$sql_opt2 = " select * from com_list_gy_opt2 where com_code='$com_code' ";
	//echo $sql_opt2;
	$result_opt2 = sql_query($sql_opt2);
	$row_opt2=mysql_fetch_array($result_opt2);
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
$qstr .= "&amp;stx_addr=".$stx_addr."&amp;stx_addr_first=".$stx_addr_first."&amp;stx_employment_kind1=".$stx_employment_kind1."&amp;stx_employment_kind2=".$stx_employment_kind2."&amp;stx_employment_kind3=".$stx_employment_kind3."&stx_employment_manager_name=".$stx_employment_manager_name;
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
	<title><?=$g4[title]?></title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/style_admin.css">
	<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
	<script type="text/javascript"  src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd;">
<script type="text/javascript"  src="./js/jquery-1.8.0.min.js" charset="euc-kr"></script>
<script type="text/javascript">
//<![CDATA[
function checkID() {
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
function del(page,id) {
	if(confirm("삭제하시겠습니까?")) {
		location.href = "4insure_delete.php?page="+page+"&id="+id;
	}
}
function goSearch()
{
	var frm = document.searchForm;
	frm.action = "<?=$PHP_SELF?>";
	frm.submit();
	return;
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
//]]>
</script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<script type="text/javascript">
//<![CDATA[
function loadCalendar( obj ) {
	var calendar = new Calendar(0, null, onSelect, onClose);
	calendar.create();
	calendar.parseDate(obj.value);
	calendar.showAtElement(obj, "Br");

	function onSelect(calendar, date) {
		var input_field = obj;
		input_field.value = date;
		if (calendar.dateClicked) {
			calendar.callCloseHandler();
		}
	};
	function onClose(calendar) {
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
//이력
function popup_history(id) {
	var ret = window.open("./acceleration_history_popup.php?id="+id, "window_electric_charges_history", "scrollbars=yes,width=640,height=240");
	return;
}
//신청서류 안내 추가 삭제 151116 (동일 함수 사용, tr 갯수 2개, 5개까지 가능)
function possible_add(div_id, count_input) {
	var frm = document.dataForm;
	var v2 = document.getElementById(div_id+'2');
	var v2b = document.getElementById(div_id+'2b');
	var v3 = document.getElementById(div_id+'3');
	var v3b = document.getElementById(div_id+'3b');
	var v4 = document.getElementById(div_id+'4');
	var v4b = document.getElementById(div_id+'4b');
	var v5 = document.getElementById(div_id+'5');
	var v5b = document.getElementById(div_id+'5b');
	if(v2.style.display == "none") {
		v2.style.display = "";
		v2b.style.display = "";
		frm[count_input].value = 2;
	} else {
		if(v3.style.display == "none") {
			v3.style.display = "";
			v3b.style.display = "";
			frm[count_input].value = 3;
		} else {
			if(v4.style.display == "none") {
				v4.style.display = "";
				v4b.style.display = "";
				frm[count_input].value = 4;
			} else {
				if(v5.style.display == "none") {
					v5.style.display = "";
					v5b.style.display = "";
					frm[count_input].value = 5;
				} else {
					alert("최대 5개까지 추가 가능합니다.");
				}
			}
		}
	}
}
function possible_del(div_id, count_input) {
	var frm = document.dataForm;
	var v2 = document.getElementById(div_id+'2');
	var v2b = document.getElementById(div_id+'2b');
	var v3 = document.getElementById(div_id+'3');
	var v3b = document.getElementById(div_id+'3b');
	var v4 = document.getElementById(div_id+'4');
	var v4b = document.getElementById(div_id+'4b');
	var v5 = document.getElementById(div_id+'5');
	var v5b = document.getElementById(div_id+'5b');
	if(v5.style.display == "") {
		v5.style.display = "none";
		v5b.style.display = "none";
		frm[count_input].value = 4;
	} else {
		if(v4.style.display == "") {
			v4.style.display = "none";
			v4b.style.display = "none";
			frm[count_input].value = 3;
		} else {
			if(v3.style.display == "") {
				v3.style.display = "none";
				v3b.style.display = "none";
				frm[count_input].value = 2;
			} else {
				if(v2.style.display == "") {
					v2.style.display = "none";
					v2b.style.display = "none";
					frm[count_input].value = 1;
				} else {
					alert("최소 1줄은 존재해야 합니다. 해당 사항이 없을시 내용을 삭제하세요.");
				}
			}
		}
	}
}
//]]>
</script>
<?
include "inc/top.php";
$php_self_list = "acceleration_employment.php";
?>
		<td onmouseover="showM('900')" valign="top">
			<div style="margin:10px 20px 20px 20px;min-height:480px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<!--<td width="100"><img src="images/top19.gif" border="0" alt="사업분야" /></td>-->
						<td width="100"><img src="images/top02.gif" border="0" alt="지원금" /></td>
						<td width="130"><a href="<?=$php_self_list?>"><img src="<?=$top_sub_title?>" border="0" alt="<?=$sub_title?>" /></a></td>
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
$tab_onoff_this = 14;
//프로그램 종류
if($row['easynomu_yn'] == 1) {
	$tab_program_url = 1;
} else if($row['easynomu_yn'] == 2) {
	$tab_program_url = 2;
} else {
	$tab_program_url = 1;
	if($row['construction_yn'] == 1) $tab_program_url = 3;
}
if( ($row['damdang_code'] == $mb_profile_code || $row['damdang_code2'] == $mb_profile_code) || $mb_profile_code == 1 ) include "inc/tab_menu.php";
?>
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td id=""> 
											<table border="0" cellpadding="0" cellspacing="0">
												<tr> 
													<td><img src="images/so_tab_on_lt.gif"></td> 
													<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:90px;text-align:center'> 
														기본 정보
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
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="electric_charges_div" style="">
									<tr>
										<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">처리현황<font color="red"></font></td>
										<td   class="tdrow" width="365">
<?
$sel_check_ok = array();
$check_ok_id = $row2['employment_process'];
$sel_check_ok[$check_ok_id] = "selected";
?>
											<select name="employment_process" class="selectfm" style="float:left;">
												<option value="">선택</option>
												<option value="1" <?=$sel_check_ok['1']?>><?=$employment_process_arry[1]?></option>
												<option value="6" <?=$sel_check_ok['6']?>><?=$employment_process_arry[6]?></option>
												<option value="9" <?=$sel_check_ok['9']?>><?=$employment_process_arry[9]?></option>
												<option value="8" <?=$sel_check_ok['8']?>><?=$employment_process_arry[8]?></option>
												<option value="12" <?=$sel_check_ok['12']?>><?=$employment_process_arry[12]?></option>
												<option value="13" <?=$sel_check_ok['13']?>><?=$employment_process_arry[13]?></option>
												<option value="4" <?=$sel_check_ok['4']?>><?=$employment_process_arry[4]?></option>
												<option value="7" <?=$sel_check_ok['7']?>><?=$employment_process_arry[7]?></option>
												<option value="10" <?=$sel_check_ok['10']?>><?=$employment_process_arry[10]?></option>
												<option value="14" <?=$sel_check_ok['14']?>><?=$employment_process_arry[14]?></option>
												<option value="5" <?=$sel_check_ok['5']?>><?=$employment_process_arry[5]?></option>
												<option value="11" <?=$sel_check_ok['11']?>><?=$employment_process_arry[11]?></option>
											</select>
											<table border="0" cellpadding="0" cellspacing="0" style="float:left;vertical-align:middle;margin-left:10px;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="javascript:popup_history('<?=$id?>');" target="">이력</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
											<div style="float:left;padding:4px 0 0 6px;;">
<? if($row['samu_req_yn'] == 4) { ?>
												<img src="images/icon_samu_full.gif" border="0" alt="사무위탁">
<? } ?>
<? if($row['agent_elect_public_yn'] == 3) { ?>
												<img src="images/icon_agent_elect_public_full.gif" border="0" alt="대리인">
<? } ?>
<? if($row['agent_elect_center_yn'] == 3) { ?>
												<img src="images/icon_agent_elect_center_full.gif" border="0" alt="전자민원">
<? } ?>
											</div>
										</td>
										<td nowrap class="tdrowk" width="120">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">스케줄관리
										</td>
										<td nowrap  class="tdrow">
											<select name="employment_visit_kind" class="selectfm" style="float:left;">
												<option value="">선택</option>
												<option value="방문" <? if($row2['employment_visit_kind'] == "방문") echo "selected"; ?>>방문</option>
												<option value="재연락" <? if($row2['employment_visit_kind'] == "재연락") echo "selected"; ?>>재연락</option>
											</select>
											<input name="employment_visitdt" type="text" class="textfm" style="width:78px;ime-mode:disabled;float:left;" value="<?=$row2['employment_visitdt']?>" maxlength="10" onkeypress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
											<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')" class="ftbutton3_white"><a href="javascript:loadCalendar(document.dataForm.employment_visitdt);">달력</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
											<select name="employment_visitdt_time" class="selectfm" style="float:left;">
												<option value="">선택</option>
												<option value="오전" <? if($row2['employment_visitdt_time'] == "오전") echo "selected"; ?>>오전</option>
												<option value="오후" <? if($row2['employment_visitdt_time'] == "오후") echo "selected"; ?>>오후</option>
											</select>
											<input type="checkbox" name="employment_visitdt_ok" <? if($row2['employment_visitdt_ok']) echo "checked"; ?> value="1" onclick="" style="vertical-align:middle;" />완료
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">특이사항<font color="red"></font></td>
										<td nowrap class="tdrow" colspan="3">
<?
//본사, 관리자, 경산 지사 표시 151119
if($member['mb_profile'] == 1 || $member['mb_id'] == 'master' || $member['mb_profile'] == 16) $hidden_memo = "";
else $hidden_memo = "display:none;";
?>
											<textarea name="employment_memo" class="textfm" style='width:100%;height:68px;word-break:break-all;<?=$hidden_memo?>'><?=$row2['employment_memo']?></textarea>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>
<?
//담당 지사가 아닐 경우 숨김
if(!$hidden_branch) {
?>
								<table border=0 cellspacing=0 cellpadding=0 style=""> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/so_tab_on_lt.gif"></td> 
													<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:90px;text-align:center'> 
														<span>신청서류안내</span>
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
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="electric_charges_div" style="">
									<tr>
										<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">지원금1
<?
if($member['mb_level'] != 6) {
?>
											<span style="padding:4px 0 0 15px">
												<a href="javascript:possible_add('tr_process', 'process_count');"><img src="images/btn_add.png" align="absmiddle" border="0"></a>
												<a href="javascript:possible_del('tr_process', 'process_count');"><img src="images/btn_del.png" align="absmiddle" border="0"></a>
											</span>
<?
}
?>
										</td>
										<td nowrap class="tdrow" colspan="">
<?
$support_kind[1] = $row_opt2['support_kind'];
if($member['mb_level'] != 6) {
?>
											<select name="support_kind" class="selectfm">
												<option value="0" >선택</option>
<?
for($i=1;$i<count($support_kind_array);$i++) {
?>
												<option value="<?=$i?>" <? if($support_kind[1] == $i) echo "selected"; ?>><?=$support_kind_array[$i]?></option>
<?
}
?>
											</select>
<?
} else {
	echo $support_kind_array[$support_kind[1]];
}
?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">신청서류안내</td>
										<td class="tdrow" colspan="">
<?
if($member['mb_level'] != 6) {
?>
											<textarea name="support_document" class="textfm" style='width:100%;height:68px; word-break:break-all;' itemname="support_document" required><?=$row_opt2['support_document']?></textarea>
<?
} else {
	echo "<pre style='white-space:pre-wrap;word-wrap:break-word;'>".$row_opt2['support_document']."</pre>";
}
?>
										</td>
									</tr>
<?
//신청가능 추가 tr 총 5개 151014
for($k=2;$k<=5;$k++) {
	$support_kind[$k] = $row_opt2['support_kind'.$k];
	if(!$row_opt2['support_kind'.$k] && !$row_opt2['support_document'.$k]) $support_kind_display[$k] = "none";
	else $support_kind_display[$k] = "";
?>
									<tr id="tr_process<?=$k?>" style="<? if($support_kind_display[$k] == "none") echo "display:none"; ?>">
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">지원금<?=$k?>
										</td>
										<td nowrap class="tdrow" colspan="3">
<?
	if($member['mb_level'] != 6) {
?>
											<select name="support_kind<?=$k?>" class="selectfm">
												<option value="0" >선택</option>
<?
		for($i=1;$i<count($support_kind_array);$i++) {
?>
												<option value="<?=$i?>" <? if($support_kind[$k] == $i) echo "selected"; ?>><?=$support_kind_array[$i]?></option>
<?
		}
?>
											</select>
<?
} else {
	echo $support_kind_array[$support_kind[$k]];
}
?>
										</td>
									</tr>
									<tr id="tr_process<?=$k?>b" style="<? if($support_kind_display[$k] == "none") echo "display:none"; ?>">
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">신청서류 안내</td>
										<td class="tdrow" colspan="3">
<?
if($member['mb_level'] != 6) {
?>
											<textarea name="support_document<?=$k?>" class="textfm" style='width:100%;height:68px; word-break:break-all;' itemname="support_document" required><?=$row_opt2['support_document'.$k]?></textarea>
<?
} else {
	echo $row_opt2['support_document'.$k];
}
?>
										</td>
									</tr>
<?
}
?>
								</table>
								<input type="hidden" name="process_count" value="<?=$process_count?>">
								<div style="height:10px;font-size:0px"></div>
<?
}
//담당 지사 아닐 경우 숨김 종료
?>
								<table border="0" cellpadding="0" cellspacing="0" style=""> 
									<tr>
										<td id=""> 
											<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='branch_file_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
												<tr> 
													<td><img src="images/so_tab_on_lt.gif"></td> 
													<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:90px;text-align:center'> 
														의뢰
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
if(!$w || $row['damdang_code'] == $mb_profile_code || $row['damdang_code2'] == $mb_profile_code || $member['mb_level'] >= 9) $is_damdang = "ok";
else $is_damdang = "";
//대표님 숨김
if($member['mb_id'] == "kcmc1001") $branch_file_div_display = "display:none;";
else $branch_file_div_display = "";
?>
								<!-- 입력폼 -->
								<div id="branch_file_div" style="<?=$branch_file_div_display?>">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일1 <? if($is_damdang) { ?><input type="checkbox" name="branch_file_del_1" value="1" style="vertical-align:middle">삭제<? } ?></td>
										<td   class="tdrow" width="365">
											<? if($is_damdang) { ?><input name="branch_file_1" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
											<a href="files/employment_file/<?=$row2['branch_file_1']?>" target="_blank"><?=$row2['branch_file_1']?></a>
											<input type="hidden" name="b_file_1" value="<?=$row2['branch_file_1']?>">
										</td>
										<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일2 <? if($is_damdang) { ?><input type="checkbox" name="branch_file_del_2" value="1" style="vertical-align:middle">삭제<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang) { ?><input name="branch_file_2" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
											<a href="files/employment_file/<?=$row2['branch_file_2']?>" target="_blank"><?=$row2['branch_file_2']?></a>
											<input type="hidden" name="b_file_2" value="<?=$row2['branch_file_2']?>">
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일3 <? if($is_damdang) { ?><input type="checkbox" name="branch_file_del_3" value="1" style="vertical-align:middle">삭제<? } ?></td>
										<td   class="tdrow" width="">
											<? if($is_damdang) { ?><input name="branch_file_3" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
											<a href="files/employment_file/<?=$row2['branch_file_3']?>" target="_blank"><?=$row2['branch_file_3']?></a>
											<input type="hidden" name="b_file_3" value="<?=$row2['branch_file_3']?>">
										</td>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일4 <? if($is_damdang) { ?><input type="checkbox" name="branch_file_del_4" value="1" style="vertical-align:middle">삭제<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang) { ?><input name="branch_file_4" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
											<a href="files/employment_file/<?=$row2['branch_file_4']?>" target="_blank"><?=$row2['branch_file_4']?></a>
											<input type="hidden" name="b_file_4" value="<?=$row2['branch_file_4']?>">
										</td>
									</tr>
								</table>
								</div>
								<div style="height:10px;font-size:0px"></div>
<?
//검토, 진행 권한 : 본사, 관리자, 대구남부지사 151116
if($member['mb_profile'] == 1 || $member['mb_id'] == 'master' || $member['mb_profile'] == 16) {
?>
								<table border="0" cellpadding="0" cellspacing="0" style=""> 
									<tr>
										<td id=""> 
											<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='main_file_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:90px;text-align:center'> 
														검토
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
	//본사 권한
	if($member['mb_level'] != 6) $is_damdang = "ok";
	else $is_damdang = "";
	//대표님 숨김
	if($member['mb_id'] == "kcmc1001") $main_file_div_display = "display:none;";
	else $main_file_div_display = "";
?>
								<!-- 입력폼 -->
								<div id="main_file_div" style="<?=$main_file_div_display?>">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일1 <? if($is_damdang) { ?><input type="checkbox" name="main_file_del_1" value="1" style="vertical-align:middle">삭제<? } ?></td>
										<td   class="tdrow" width="365">
											<? if($is_damdang) { ?><input name="main_file_1" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
											<a href="files/employment_file/<?=$row2['main_file_1']?>" target="_blank"><?=$row2['main_file_1']?></a>
											<input type="hidden" name="m_file_1" value="<?=$row2['main_file_1']?>">
										</td>
										<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일2 <? if($is_damdang) { ?><input type="checkbox" name="main_file_del_2" value="1" style="vertical-align:middle">삭제<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang) { ?><input name="main_file_2" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
											<a href="files/employment_file/<?=$row2['main_file_2']?>" target="_blank"><?=$row2['main_file_2']?></a>
											<input type="hidden" name="m_file_2" value="<?=$row2['main_file_2']?>">
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일3 <? if($is_damdang) { ?><input type="checkbox" name="main_file_del_3" value="1" style="vertical-align:middle">삭제<? } ?></td>
										<td   class="tdrow" width="">
											<? if($is_damdang) { ?><input name="main_file_3" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
											<a href="files/employment_file/<?=$row2['main_file_3']?>" target="_blank"><?=$row2['main_file_3']?></a>
											<input type="hidden" name="m_file_3" value="<?=$row2['main_file_3']?>">
										</td>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일4 <? if($is_damdang) { ?><input type="checkbox" name="main_file_del_4" value="1" style="vertical-align:middle">삭제<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang) { ?><input name="main_file_4" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
											<a href="files/employment_file/<?=$row2['main_file_4']?>" target="_blank"><?=$row2['main_file_4']?></a>
											<input type="hidden" name="m_file_4" value="<?=$row2['main_file_4']?>">
										</td>
									</tr>
								</table>
								</div>
								<div style="height:10px;font-size:0px"></div>
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td id=""> 
											<table border="0" cellpadding="0" cellspacing="0">
												<tr> 
													<td><img src="images/so_tab_on_lt.gif"></td> 
													<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:90px;text-align:center'> 
														진행
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
<?
	//대구남부 권한
	if($member['mb_profile'] == 16) $is_damdang = "ok";
	else $is_damdang = "";
?>
								<!-- 입력폼 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="electric_charges_div" style="">
									<tr>
										<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일1 <? if($is_damdang) { ?><input type="checkbox" name="employment_file_del_1" value="1" style="vertical-align:middle">삭제<? } ?></td>
										<td   class="tdrow" width="365">
											<? if($is_damdang) { ?><input name="employment_file_1" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
											<a href="files/employment_file/<?=$row2['employment_file_1']?>" target="_blank"><?=$row2['employment_file_1']?></a>
											<input type="hidden" name="e_file_1" value="<?=$row2['employment_file_1']?>">
										</td>
										<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일2 <? if($is_damdang) { ?><input type="checkbox" name="employment_file_del_2" value="1" style="vertical-align:middle">삭제<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang) { ?><input name="employment_file_2" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
											<a href="files/employment_file/<?=$row2['employment_file_2']?>" target="_blank"><?=$row2['employment_file_2']?></a>
											<input type="hidden" name="e_file_2" value="<?=$row2['employment_file_2']?>">
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일3 <? if($is_damdang) { ?><input type="checkbox" name="employment_file_del_3" value="1" style="vertical-align:middle">삭제<? } ?></td>
										<td   class="tdrow" width="">
											<? if($is_damdang) { ?><input name="employment_file_3" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
											<a href="files/employment_file/<?=$row2['employment_file_3']?>" target="_blank"><?=$row2['employment_file_3']?></a>
											<input type="hidden" name="e_file_3" value="<?=$row2['employment_file_3']?>">
										</td>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일4 <? if($is_damdang) { ?><input type="checkbox" name="employment_file_del_4" value="1" style="vertical-align:middle">삭제<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang) { ?><input name="employment_file_4" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
											<a href="files/employment_file/<?=$row2['employment_file_4']?>" target="_blank"><?=$row2['employment_file_4']?></a>
											<input type="hidden" name="e_file_4" value="<?=$row2['employment_file_4']?>">
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>
<?
}
//지사 권한 화면 표시 (확인 영역만 표시) 151116
?>
								<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
									<tr>
										<td align="center">
<?
//권한별 링크값
$url_save = "javascript:checkData('acceleration_employment_update.php');";
?>
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="<?=$url_save?>" target="">저 장</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./acceleration_employment.php?page=<?=$page?>&<?=$qstr?>">목 록</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
<?
//담당 지사에만 표시
if( ($row['damdang_code'] == $mb_profile_code || $row['damdang_code2'] == $mb_profile_code) || $member['mb_profile'] == 1 ) {
?>
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./reduction_prevention_view.php?w=<?=$w?>&id=<?=$id?>" target="">감원방지기간조회</a></td><td><img src=images/btn_rt.gif></td><td width="2"></td></tr></table>
<?
}
?>
										</td>
									</tr>
								</table>
								<div style="height:4px;font-size:0px"></div>
							</div>
							<div id="tab2" >
								<a name="40001"><!--전달사항--></a>
<?
$memo_type = 13;
include "inc/client_comment_only.php";
?>
							<div style="height:20px;font-size:0px"></div>
							<input type="hidden" name="id" value="<?=$id?>" />
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
