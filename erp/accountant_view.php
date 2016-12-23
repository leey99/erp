<?
$sub_menu = "500200";
include_once("./_common.php");

$now_time = date("Y-m-d H:i:s");
$sql_common = " from com_list_gy ";

//echo $member[mb_profile];
if($is_admin != "super") {
	$stx_man_cust_name = $member['mb_profile'];
}
$is_admin = "super";
//echo $is_admin;
$sql_search = " where com_code='$id' ";
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

$sub_title = "회계사무소(뷰)";
$g4['title'] = $sub_title." : 사무위탁 : ".$easynomu_name;

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
	//사업장DB 옵션
	$sql1 = " select * from com_list_gy_opt where com_code='$com_code' ";
	//echo $sql1;
	$result1 = sql_query($sql1);
	$row1=mysql_fetch_array($result1);
	//사업장DB 옵션2
	$sql2 = " select * from com_list_gy_opt2 where com_code='$com_code' ";
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
//echo $row[com_code];
//검색 파라미터 전송
$qstr = "stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_comp_tel=".$stx_comp_tel."&stx_proxy=".$stx_proxy;
//메모
$memo = $row1['memo'];
$memo1 = $row1['memo1'];
$memo2 = $row1['memo2'];
$memo3 = $row1['memo3'];
$memo4 = $row1['memo4'];
$memo5 = $row1['memo5'];
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
function checkData(action_file) {
	var frm = document.dataForm;
	frm.action = action_file;
	frm.submit();
	return;
}
function radio_chk(x,t){
	var count=0;
	for(i=0;i<x.length;i++){
		if(x[i].checked){
			count += 1;
			radio_name_val = x[i].value; 
		}
	}
	if(count == 0){
		alert(t+" 선택해 주세요.");
		return rv = 0;
	}else{
		//alert(radio_name_val);
		return rv = 1;
	}
}
// 삭제 검사 확인
function del(page,id) 
{
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
function findNomu() {
	var ret = window.open("pop_manage_cust.php", "pop_nomu_cust", "top=100, left=100, width=800,height=600, scrollbars");
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
function field_add(div_id) {
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
	} else {
		if(v3.style.display == "none") {
			v3.style.display = "";
			v3b.style.display = "";
		} else {
			if(v4.style.display == "none") {
				v4.style.display = "";
				v4b.style.display = "";
			} else {
				if(v5.style.display == "none") {
					v5.style.display = "";
					v5b.style.display = "";
				} else {
					alert("최대 5개까지 추가 가능합니다.");
				}
			}
		}
	}
}
function field_del(div_id) {
	var v2 = document.getElementById(div_id+'2');
	var v3 = document.getElementById(div_id+'3');
	var v4 = document.getElementById(div_id+'4');
	var v5 = document.getElementById(div_id+'5');
	var v2b = document.getElementById(div_id+'2b');
	var v3b = document.getElementById(div_id+'3b');
	var v4b = document.getElementById(div_id+'4b');
	var v5b = document.getElementById(div_id+'5b');
	if(v5.style.display == "") {
		v5.style.display = "none";
		v5b.style.display = "none";
	} else {
		if(v4.style.display == "") {
			v4.style.display = "none";
			v4b.style.display = "none";
		} else {
			if(v3.style.display == "") {
				v3.style.display = "none";
				v3b.style.display = "none";
			} else {
				if(v2.style.display == "") {
					v2.style.display = "none";
					v2b.style.display = "none";
				} else {
					alert("최소 1줄은 존재해야 합니다. 해당 사항이 없을시 내용을 삭제하세요.");
				}
			}
		}
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
function application_fee_sum_func(obj_no) {
	var frm = document.dataForm;
	if(obj_no == 1) {
		application_fee_sum = toInt(frm.application_fee_1.value) + toInt(frm.application_fee_2.value) + toInt(frm.application_fee_3.value);
		frm.application_fee_sum.value = number_format(application_fee_sum);
		if(application_fee_sum == 0) frm.application_fee_sum.value = "";
	} else if(obj_no == 2) {
		application_fee_sum2 = toInt(frm.application_fee2_1.value) + toInt(frm.application_fee2_2.value) + toInt(frm.application_fee2_3.value);
		frm.application_fee_sum2.value = number_format(application_fee_sum2);
		if(application_fee_sum2 == 0) frm.application_fee_sum2.value = "";
	} else if(obj_no == 3) {
		application_fee_sum3 = toInt(frm.application_fee3_1.value) + toInt(frm.application_fee3_2.value) + toInt(frm.application_fee3_3.value);
		frm.application_fee_sum3.value = number_format(application_fee_sum3);
		if(application_fee_sum3 == 0) frm.application_fee_sum3.value = "";
	} else if(obj_no == 4) {
		application_fee_sum4 = toInt(frm.application_fee4_1.value) + toInt(frm.application_fee4_2.value) + toInt(frm.application_fee4_3.value);
		frm.application_fee_sum4.value = number_format(application_fee_sum4);
		if(application_fee_sum4 == 0) frm.application_fee_sum4.value = "";
	} else if(obj_no == 5) {
		application_fee_sum5 = toInt(frm.application_fee5_1.value) + toInt(frm.application_fee5_2.value) + toInt(frm.application_fee5_3.value);
		frm.application_fee_sum5.value = number_format(application_fee_sum5);
		if(application_fee_sum5 == 0) frm.application_fee_sum5.value = "";
	}
}
function persons_0(obj) {
	var frm = document.dataForm;
	if(obj.checked) {
		frm.persons_gy_old.value = frm.persons_gy.value;
		frm.persons_sj_old.value = frm.persons_sj.value;
		frm.persons_gy.value = "";
		frm.persons_sj.value = "";
	} else {
		frm.persons_gy.value = frm.persons_gy_old.value;
		frm.persons_sj.value = frm.persons_sj_old.value;
	}
}
</script>
<?
include "inc/top.php";
?>
					<td onmouseover="showM('900')">
						<div style="margin:10px 20px 20px 20px;min-height:480px;">
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td width="100"><img src="images/top05.gif" border="0"></td>
									<td width="130"><img src="images/top05_02.gif" border="0"></td>
									<td></td>
								</tr>
								<tr><td height="1" bgcolor="#cccccc" colspan="9"></td></tr>
							</table>
							<table width="1000" border="0" align="left" cellpadding="0" cellspacing="0" >
								<tr>
									<td valign="top" style="padding:10px 0 0 0">
										<!--타이틀 -->	
<?
$samu_list = "ok";
$report = "ok";
include "inc/client_basic_info.php";
?>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>
<?
//권한별 링크값
//echo $member['mb_level'];
if($member['mb_level'] >= 8) {
	$url_save = "javascript:checkData('samu_update.php');";
} else {
	$url_save = "javascript:alert_no_right();";
}
?>
							</div>
							<div id="tab2" >
								<!--댑메뉴 -->
								<a name="50001"></a>
								<table border=0 cellspacing=0 cellpadding=0 style=""> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
														회계사무소
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
								<!-- 입력폼 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrowk" width="130"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">위탁서접수</td>
										<td nowrap  class="tdrow" width="290">
<?
$samu_receive_chk = $row1['samu_receive_chk'];
if($row1['samu_receive_non_arrival']) $samu_receive_non_arrival_text = "미도착";
//위탁번호 0 제거
if($row1['samu_receive_no']) $samu_receive_no = $row1['samu_receive_no'];
else  $samu_receive_no = "";
?>
											<select name="samu_receive_chk" class="selectfm" onchange="input_today(this,'samu_receive_date', '1')">
												<option value=""  <? if($samu_receive_chk == "")  echo "selected"; ?>>선택</option>
												<option value="1" <? if($samu_receive_chk == "1") echo "selected"; ?>>도착</option>
												<option value="2" <? if($samu_receive_chk == "2") echo "selected"; ?>>미도착</option>
											</select>
											<input name="samu_receive_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row1['samu_receive_date']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
											번호 <input name="samu_receive_no" type="text" class="textfm" style="width:55px;ime-mode:disabled;" value="<?=$samu_receive_no?>" maxlength="4" onKeyPress="onlyNumber();">
										</td>
										<td nowrap class="tdrowk" width="130"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사무위탁수임</td>
										<td nowrap class="tdrow" width="" colspan="3">
<?
//사무위탁수임
$samu_req_yn = $row1['samu_req_yn'];
?>
											<select name="samu_req_yn" class="selectfm" onchange="input_today_samu(this,'samu_req_date','samu_close_date')">
												<option value=""  <? if($samu_req_yn == "")  echo "selected"; ?>>선택</option>
												<option value="1" <? if($samu_req_yn == "1") echo "selected"; ?>>반려</option>
												<option value="2" <? if($samu_req_yn == "2") echo "selected"; ?>>수임가능</option>
												<option value="3" <? if($samu_req_yn == "3") echo "selected"; ?>>타수임</option>
												<option value="4" <? if($samu_req_yn == "4") echo "selected"; ?>>수임</option>
												<option value="5" <? if($samu_req_yn == "5") echo "selected"; ?>>해지</option>
											</select>
											수임
											<input name="samu_req_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row1['samu_req_date']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
											해지
											<input name="samu_close_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row1['samu_close_date']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">상시근로자</td>
										<td nowrap class="tdrow">
<?
$persons_gy = $row1['persons_gy'];
$persons_sj = $row1['persons_sj'];
if($persons_gy == "0") $persons_gy = "";
if($persons_sj == "0") $persons_sj = "";
if($row1['emp0_gbn'] == 1) $emp0_gbn = "checked";
?>
											고용 <input name="persons_gy" type="text" class="textfm" style="width:30px;ime-mode:disabled;" value="<?=$persons_gy?>" maxlength="3">명
											/
											산재 <input name="persons_sj" type="text" class="textfm" style="width:30px;ime-mode:disabled;" value="<?=$persons_sj?>" maxlength="3">명
											<input name="persons_gy_old" type="hidden"><input name="persons_sj_old" type="hidden">
											<input type="checkbox" name="emp0_gbn" value="1" <?=$emp0_gbn?> style="vertical-align:middle" onclick="persons_0(this)">0명
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업장 규모</td>
										<td nowrap class="tdrow" colspan="3">
<?
//사업장규모
if($row1['emp5_gbn'] == 1) $emp5_gbn = "checked";
if($row1['emp30_gbn'] == 1) $emp30_gbn = "checked";
?>
											<input type="checkbox" name="emp5_gbn" value="1" <?=$emp5_gbn?> style="vertical-align:middle">5인 미만
											<input type="checkbox" name="emp30_gbn" value="1" <?=$emp30_gbn?> style="vertical-align:middle">30인 이상
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">보험구분</td>
										<td nowrap class="tdrow">
<?
//보험구분
$samu_state_gy = $row['samu_state_gy'];
$samu_state_sj = $row['samu_state_sj'];
?>
											고용
											<select name="samu_state_gy" class="selectfm" onchange="">
												<option value=""  <? if($samu_state_gy == "")  echo "selected"; ?>>선택</option>
												<option value="1" <? if($samu_state_gy == "1") echo "selected"; ?>>정상</option>
												<option value="2" <? if($samu_state_gy == "2") echo "selected"; ?>>소멸</option>
											</select>
											산재
											<select name="samu_state_sj" class="selectfm" onchange="">
												<option value=""  <? if($samu_state_sj == "")  echo "selected"; ?>>선택</option>
												<option value="1" <? if($samu_state_sj == "1") echo "selected"; ?>>정상</option>
												<option value="2" <? if($samu_state_sj == "2") echo "selected"; ?>>소멸</option>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">부과고지 구분</td>
										<td nowrap  class="tdrow">
<?
//부과고지구분
$levy_kind = $row['levy_kind'];
?>
											<select name="levy_kind" class="selectfm" onchange="">
												<option value=""  <? if($levy_kind == "")  echo "selected"; ?>>선택</option>
												<option value="1" <? if($levy_kind == "1") echo "selected"; ?>>부과고지</option>
												<option value="2" <? if($levy_kind == "2") echo "selected"; ?>>자진신고</option>
											</select>
										</td>
										<td nowrap class="tdrowk" width="94"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업구분</td>
										<td nowrap  class="tdrow">
<?
//사업장상태
$employer_insure = $row['employer_insure'];
?>
											<select name="employer_insure" class="selectfm" onchange="">
												<option value=""  <? if($employer_insure == "")  echo "selected"; ?>>선택</option>
												<option value="1" <? if($employer_insure == "1") echo "selected"; ?>>사업주산재</option>
												<option value="2" <? if($employer_insure == "2") echo "selected"; ?>>자영업자고용</option>
											</select>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">소멸일자</td>
										<td nowrap class="tdrow">
											고용
											<input name="samu_discharge_date_gy" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['samu_discharge_date_gy']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.samu_discharge_date_gy);" target="">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
											산재
											<input name="samu_discharge_date_sj" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['samu_discharge_date_sj']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.samu_discharge_date_sj);" target="">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">관리공단지사</td>
										<td nowrap  class="tdrow">
<?
//관리공단지사
$samu_branch = $row['samu_branch'];
?>
											<select name="samu_branch" class="selectfm" onchange="">
												<option value="">선택</option>
<?
for($i=1;$i<count($samu_branch_arry);$i++) {
?>
												<option value="<?=$samu_branch_arry[$i]?>" <? if($samu_branch == $samu_branch_arry[$i]) echo "selected"; ?>><?=$samu_branch_arry[$i]?></option>
<?
}
?>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">적용담당자</td>
										<td nowrap  class="tdrow">
											<input name="samu_charge" type="text" class="textfm" style="width:80px;" value="<?=$row['samu_charge']?>" maxlength="10" onKeyPress="" onkeyup="">
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">건강EDI위임</td>
										<td nowrap class="tdrow" width="" colspan="">
<?
//건강EDI위임
$health_req_yn = $row1['health_req_yn'];
?>
											<select name="health_req_yn" class="selectfm" onchange="input_today_samu(this,'health_req_date','health_close_date')">
												<option value=""  <? if($health_req_yn == "")  echo "selected"; ?>>선택</option>
												<option value="1" <? if($health_req_yn == "1") echo "selected"; ?>>반려</option>
												<option value="2" <? if($health_req_yn == "2") echo "selected"; ?>>수임가능</option>
												<option value="3" <? if($health_req_yn == "3") echo "selected"; ?>>타위임</option>
												<option value="4" <? if($health_req_yn == "4") echo "selected"; ?>>위임</option>
												<option value="5" <? if($health_req_yn == "5") echo "selected"; ?>>해지</option>
											</select>
											위임
											<input name="health_req_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row1['health_req_date']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
											해지
											<input name="health_close_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row1['health_close_date']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
										</td>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">산재요율</td>
										<td nowrap class="tdrow" width="" colspan="3">
<?
$sj_rate = $row1['sj_rate'];
?>
											<input name="sj_rate" type="text" class="textfm" style="width:32px;ime-mode:disabled;" value="<?=$sj_rate?>" maxlength="4">%
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>
								<!--댑메뉴 -->
								<a name="60001"></a>
								<table border=0 cellspacing=0 cellpadding=0 style=""> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
														우편물 피드백
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
								<!-- 입력폼 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrowk" width="130"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">통화일자</td>
										<td nowrap class="tdrow" width="290">
											<input name="samu_call_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row2['samu_call_date']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;vertical-align:middle"><tr><td width=2></td><td><img src=./images/btn3_lt.gif></td><td background=./images/btn3_bg.gif class=ftbutton3_white nowrap><a href="javascript:chk_today('samu_call_date', '1');" target="">완료</a></td><td><img src=./images/btn3_rt.gif></td> <td width=2></td></tr></table>
										</td>
										<td nowrap class="tdrowk" width="130"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">팩스전송결과</td>
										<td nowrap  class="tdrow" width="">
<?
//팩스전송결과
$fax_error = $row['fax_error'];
$fax_error2 = $row['fax_error2'];
$fax_error3 = $row['fax_error3'];
?>
											1차
											<select name="fax_error" class="selectfm" onchange="">
												<option value=""  <? if($fax_error == "")  echo "selected"; ?>>선택</option>
												<option value="1" <? if($fax_error == "1") echo "selected"; ?>>정상전송</option>
												<option value="2" <? if($fax_error == "2") echo "selected"; ?>>부분전달</option>
												<option value="3" <? if($fax_error == "3") echo "selected"; ?>>전화연결</option>
												<option value="4" <? if($fax_error == "4") echo "selected"; ?>>응답없음</option>
												<option value="5" <? if($fax_error == "5") echo "selected"; ?>>없는번호</option>
												<option value="6" <? if($fax_error == "6") echo "selected"; ?>>통화중</option>
												<option value="7" <? if($fax_error == "7") echo "selected"; ?>>기타</option>
											</select>
											2차
											<select name="fax_error2" class="selectfm" onchange="">
												<option value=""  <? if($fax_error2 == "")  echo "selected"; ?>>선택</option>
												<option value="1" <? if($fax_error2 == "1") echo "selected"; ?>>정상전송</option>
												<option value="2" <? if($fax_error2 == "2") echo "selected"; ?>>부분전달</option>
												<option value="3" <? if($fax_error2 == "3") echo "selected"; ?>>전화연결</option>
												<option value="4" <? if($fax_error2 == "4") echo "selected"; ?>>응답없음</option>
												<option value="5" <? if($fax_error2 == "5") echo "selected"; ?>>없는번호</option>
												<option value="6" <? if($fax_error2 == "6") echo "selected"; ?>>통화중</option>
												<option value="7" <? if($fax_error2 == "7") echo "selected"; ?>>기타</option>
											</select>
											3차
											<select name="fax_error3" class="selectfm" onchange="">
												<option value=""  <? if($fax_error3 == "")  echo "selected"; ?>>선택</option>
												<option value="1" <? if($fax_error3 == "1") echo "selected"; ?>>정상전송</option>
												<option value="2" <? if($fax_error3 == "2") echo "selected"; ?>>부분전달</option>
												<option value="3" <? if($fax_error3 == "3") echo "selected"; ?>>전화연결</option>
												<option value="4" <? if($fax_error3 == "4") echo "selected"; ?>>응답없음</option>
												<option value="5" <? if($fax_error3 == "5") echo "selected"; ?>>없는번호</option>
												<option value="6" <? if($fax_error3 == "6") echo "selected"; ?>>통화중</option>
												<option value="7" <? if($fax_error3 == "7") echo "selected"; ?>>기타</option>
											</select>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">메모</td>
										<td nowrap  class="tdrow" colspan="3">
											<textarea name="samu_feedback_memo" class="textfm" style='width:100%;height:40px; word-break:break-all;' itemname="first_review_item" required><?=$row2['samu_feedback_memo']?></textarea>
										</td>
									</tr>
								</table>
								<div style="height:20px;font-size:0px"></div>
								<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
									<tr>
										<td align="center">
<?
if($member['mb_level'] >= 6) {
?>
											<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_save?>" target="">저 장</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
<? } ?>
											<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="./samu_list.php?page=<?=$page?>" target="">목 록</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
<?
if($w == "u") {
?>
										<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./client_view.php?w=<?=$w?>&id=<?=$id?>" target="">거래처정보</a></td><td><img src=images/btn_rt.gif></td><td width="2"></td></tr></table>
										<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./client_process_view.php?w=<?=$w?>&id=<?=$id?>" target="">접수처리현황</a></td><td><img src=images/btn_rt.gif></td><td width="2"></td></tr></table>
<? } ?>
										</td>
									</tr>
								</table>

<?
include "inc/client_samu_inc.php";
?>
							<div style="height:20px;font-size:0px"></div>
						</form>
						<!--댑메뉴 -->
						<!-- 입력폼 -->
						</div>
					</td>
				</tr>
			</table>


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
