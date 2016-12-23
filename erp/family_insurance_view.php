<?
$sub_menu = "200500";
include_once("./_common.php");

$now_time = date("Y-m-d H:i:s");
$sql_common = " from com_list_gy a, com_list_gy_opt b ";

//echo $member[mb_profile];
if($is_admin != "super") {
	$stx_man_cust_name = $member['mb_profile'];
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

$sub_title = "가족보험료";
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
	//지원금DB 대체 141112
/*
	$sql2 = " select * from com_list_gy_opt2 where com_code='$com_code' ";
	$result2 = sql_query($sql2);
	$row2=mysql_fetch_array($result2);
*/
	//최종확인자 로그 저장 (관리자 제외)
	if($member['mb_level'] != 10) {
		$mb_profile_code = $member['mb_profile'];
		$mb_id = $member['mb_id'];
		$sql_erp_view_log = " insert erp_view_log set branch='$mb_profile_code', user_id='$mb_id', com_code='$com_code', wr_datetime='$now_time' ";
		sql_query($sql_erp_view_log);
	}
}
//echo $row[com_code];
//메모
$memo = $row['memo'];
//검색 파라미터 전송
$qstr = "stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_comp_tel=".$stx_comp_tel."&stx_proxy=".$stx_proxy;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4['title']?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="./js/jquery-1.8.0.min.js" charset="euc-kr"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<script type="text/javascript">
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
<script type="text/javascript">
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
function view_application_date_chk(obj, obj_no) {
	if(!obj.value) {
		obj2 = document.getElementById('application_date_a_'+obj_no);
		obj2.style.display = "";
		obj3 = document.getElementById('application_date_b_'+obj_no);
		obj3.style.display = "none";
	} else {
		obj2 = document.getElementById('application_date_a_'+obj_no);
		obj2.style.display = "none";
		obj3 = document.getElementById('application_date_b_'+obj_no);
		obj3.style.display = "";
	}
}
function view_close_kind(obj, obj_no) {
	if(!obj.value) {
		obj2 = document.getElementById('close_date_a_'+obj_no);
		obj2.style.display = "";
		obj3 = document.getElementById('close_date_b_'+obj_no);
		obj3.style.display = "none";
	} else {
		obj2 = document.getElementById('close_date_a_'+obj_no);
		obj2.style.display = "none";
		obj3 = document.getElementById('close_date_b_'+obj_no);
		obj3.style.display = "";
	}
}
//청구금액 * 1.1 = 본사입금금액
function main_receipt_fee_cal(k) {
	var frm = document.dataForm;
	requested_amount = toInt(frm['requested_amount'+k].value);
	main_receipt_fee = requested_amount * 1.1;
	frm['main_receipt_fee'+k].value = number_format(main_receipt_fee);
}
//신청금액 = 입금금액 복사
function requested_amount_copy(k, fee_kind) {
	var frm = document.dataForm;
	application_fee_sum = toInt(frm['application_fee_sum'+k].value);
	if(fee_kind == "support") {
		p_support = frm['p_support'].value;
	} else {
		p_support = frm['p_contribution'].value;
	}
	if(p_support == "") {
		alert('수수료 설정이 되어 있지 않습니다.');
		return;
	}
	client_receipt_fee = toInt(frm['client_receipt_fee'+k].value);
	if(application_fee_sum == "") {
		alert("신청금액을 입력하세요.");
		frm['application_fee_sum'+k].focus();
		return;
	}
	client_receipt_fee = application_fee_sum;
	requested_amount = client_receipt_fee * p_support / 100;
	frm['client_receipt_fee'+k].value = number_format(client_receipt_fee);
	frm['requested_amount'+k].value = number_format(requested_amount);
}
//본사입금금액 계산
function main_receipt_fee_cal(k) {
	var frm = document.dataForm;
	requested_amount = toInt(frm['requested_amount'+k].value);
	if(requested_amount == "") {
		alert("청구금액(거래)을 입력하세요.");
		frm['requested_amount'+k].focus();
		return;
	}
	main_receipt_fee = requested_amount * 1.1;
	frm['main_receipt_fee'+k].value = number_format(main_receipt_fee);
}
</script>
<?
include "inc/top.php";
?>
		<td onmouseover="showM('900')" style="vertical-align:top;">
			<div style="margin:10px 20px 20px 20px;min-height:480px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100"><img src="images/top19.gif" border="0" alt="사업분야" /></td>
						<td width=""><a href="family_insurance_list.php?page=<?=$page?>&<?=$qstr?>"><img src="images/top19_05.gif" border="0" alt="가족보험료환급" /></a></td>
						<td></td>
					</tr>
					<tr><td height="1" bgcolor="#cccccc" colspan="3"></td></tr>
				</table>
				<table width="<?=$content_width?>" border="0" align="left" cellpadding="0" cellspacing="0" >
					<tr>
						<td valign="top" style="padding:10px 0 0 0">
							<!--타이틀 -->	
<?
$samu_list = "ok";
$report = "ok";
include "inc/client_basic_info.php";
?>
									<div style="height:10px;font-size:0px;line-height:0px;"></div>
								</div><!--프린트 영역 DIV 종료-->
								<!--탭메뉴 -->
<?
//현재 탭 메뉴 번호
$tab_onoff_this = 8;
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
								<div id="tab2" >
					<table border=0 cellspacing=0 cellpadding=0 style=""> 
						<tr>
							<td id=""> 
								<table border=0 cellpadding=0 cellspacing=0> 
									<tr> 
										<td><img src="images/g_tab_on_lt.gif"></td> 
										<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
											가족보험환급
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
							<td nowrap class="tdrowk" width="110"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">가족보험관계</td>
							<td nowrap  class="tdrow" colspan="">
<?
	//직계가족 근무여부
	if($row['family_work_if'] == "1") $family_work_if = "YES";
	else if($row['family_work_if'] == "2") $family_work_if = "NO";
	else $family_work_if = "";
	$insurance_holder = $row['insurance_holder']; //보험가입자
	//환급신청의뢰
	if($row['refund_request'] == "1") $refund_request = "YES";
	else if($row['refund_request'] == "2") $refund_request = "NO";
	else $refund_request = "";
	$family_refund_wrong = $row['family_refund_wrong']; //불가사유
	if($is_damdang == "ok") {
?>
								<b>직계가족 근무여부</b>
								<input type="radio" name="family_work_if" value="1" <? if($row['family_work_if'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="family_work_if" value="2" <? if($row['family_work_if'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<br><b>보험가입자</b>
								<input name="insurance_holder" type="text" class="textfm" style="width:240px;ime-mode:active;vertical-align:middle" value="<?=$row['insurance_holder']?>" maxlength="50">
<?
	} else {
		if($family_work_if) echo "<b>직계가족 근무여부</b> : ".$family_work_if."<br>";
		if($insurance_holder) echo "<b>보험가입자</b> : ".$insurance_holder."";

	}
?>
							</td>
							<td nowrap  class="tdrow" width="480">
<?
	if($is_damdang == "ok") {
?>
								<b>환급신청의뢰</b>
								<input type="radio" name="refund_request" value="1" <? if($row['refund_request'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="refund_request" value="2" <? if($row['refund_request'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<br />
								<b>불가사유</b>
								<input name="family_refund_wrong" type="text" class="textfm" style="width:240px;ime-mode:active;vertical-align:middle" value="<?=$row['family_refund_wrong']?>" maxlength="50">
<?
	} else {
		if($refund_request) echo "<b>환급신청의뢰</b> : ".$refund_request."<br>";
		if($family_refund_wrong) echo "<b>불가사유</b> : ".$family_refund_wrong."";

	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">메모<font color="red"></font></td>
							<td nowrap  class="tdrow" colspan="3">
								<textarea name="memo1" class="textfm" style='width:100%;height:100px;word-break:break-all;'><?=$row['memo1']?></textarea>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">처리현황<font color="red"></font></td>
							<td nowrap  class="tdrow" colspan="3">
<?
$sel_check_ok = array();
$check_ok_id = $row['family_process'];
$sel_check_ok[$check_ok_id] = "selected";
if($member['mb_level'] != 6) {
?>
								<select name="family_process" class="selectfm" style="float:left;">
									<option value="">선택</option>
									<option value="1" <?=$sel_check_ok['1']?>><?=$family_process_arry[1]?></option>
									<option value="2" <?=$sel_check_ok['2']?>><?=$family_process_arry[2]?></option>
									<option value="3" <?=$sel_check_ok['3']?>><?=$family_process_arry[3]?></option>
									<option value="4" <?=$sel_check_ok['4']?>><?=$family_process_arry[4]?></option>
									<option value="5" <?=$sel_check_ok['5']?>><?=$family_process_arry[5]?></option>
									<option value="6" <?=$sel_check_ok['6']?>><?=$family_process_arry[6]?></option>
								</select>
<?
} else {
	echo $family_process_arry[$check_ok_id];
}
?>
							</td>
						</tr>
					</table>
					<div style="height:10px;font-size:0px;line-height:0px;"></div>
<?
//첨부파일 등록 가능하도록 강제 담당 설정 151030
$is_damdang = "ok";
$upload_dir = 'files/family_insurance/';
?>
					<table border=0 cellspacing=0 cellpadding=0 style=""> 
						<tr>
							<td id=""> 
								<table border=0 cellpadding=0 cellspacing=0> 
									<tr> 
										<td><img src="images/g_tab_on_lt.gif"></td> 
										<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
											가족보험관련서류
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
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
						<tr>
							<td nowrap class="tdrowk" width="110" rowspan="4">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">첨부파일
							</td>
							<td   class="tdrow" width="">
								<div style="padding-top:4px;">
									<? if($is_damdang == "ok") { ?><b>파일1</b> <input type="checkbox" name="family_file_del_1" value="1" style="vertical-align:middle">삭제
									<input name="family_file_1" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
									<a href="<?=$upload_dir?><?=$row['family_file_1']?>" target="_blank"><?=$row['family_file_1']?></a>
									<input type="hidden" name="p_file_1" value="<?=$row['family_file_1']?>">
								</div>
							</td>
							<td   class="tdrow" colspan="2">
								<div style="padding-top:4px;">
									<? if($is_damdang == "ok") { ?><b>파일2</b> <input type="checkbox" name="family_file_del_2" value="1" style="vertical-align:middle">삭제
									<input name="family_file_2" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
									<a href="<?=$upload_dir?><?=$row['family_file_2']?>" target="_blank"><?=$row['family_file_2']?></a>
									<input type="hidden" name="p_file_2" value="<?=$row['family_file_2']?>">
								</div>
							</td>
						</tr>
						<tr>
							<td   class="tdrow" width="">
								<div style="padding-top:4px;">
									<? if($is_damdang == "ok") { ?><b>파일3</b> <input type="checkbox" name="family_file_del_3" value="1" style="vertical-align:middle">삭제
									<input name="family_file_3" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
									<a href="<?=$upload_dir?><?=$row['family_file_3']?>" target="_blank"><?=$row['family_file_3']?></a>
									<input type="hidden" name="p_file_3" value="<?=$row['family_file_3']?>">
								</div>
							</td>
							<td   class="tdrow" colspan="2">
								<div style="padding-top:4px;">
									<? if($is_damdang == "ok") { ?><b>파일4</b> <input type="checkbox" name="family_file_del_4" value="1" style="vertical-align:middle">삭제
									<input name="family_file_4" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
									<a href="<?=$upload_dir?><?=$row['family_file_4']?>" target="_blank"><?=$row['family_file_4']?></a>
									<input type="hidden" name="p_file_4" value="<?=$row['family_file_4']?>">
								</div>
							</td>
						</tr>
						<tr>
							<td   class="tdrow" width="">
								<div style="padding-top:4px;">
									<? if($is_damdang == "ok") { ?><b>파일5</b> <input type="checkbox" name="family_file_del_5" value="1" style="vertical-align:middle">삭제
									<input name="family_file_5" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
									<a href="<?=$upload_dir?><?=$row['family_file_5']?>" target="_blank"><?=$row['family_file_5']?></a>
									<input type="hidden" name="p_file_5" value="<?=$row['family_file_5']?>">
								</div>
							</td>
							<td   class="tdrow" colspan="2">
								<div style="padding-top:4px;">
									<? if($is_damdang == "ok") { ?><b>파일6</b> <input type="checkbox" name="family_file_del_6" value="1" style="vertical-align:middle">삭제
									<input name="family_file_6" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
									<a href="<?=$upload_dir?><?=$row['family_file_6']?>" target="_blank"><?=$row['family_file_6']?></a>
									<input type="hidden" name="p_file_6" value="<?=$row['family_file_6']?>">
								</div>
							</td>
						</tr>
					</table>
					<div style="height:10px;font-size:0px;line-height:0px;"></div>
<?
//지원금 번호
$app_no = 1;
//지원금 DB
$sql2 = " select * from erp_application where com_code='$com_code' and application_kind='18' order by idx asc ";
$result2 = sql_query($sql2);
?>
									<!--댑메뉴 -->
									<a name="40001"><!--신청서 작성--></a>
<?
//지원금 for문 start
//for($app_no=1;$app_no<=$app_count;$app_no++) {
for ($app_no=1; $row2=sql_fetch_array($result2); $app_no++) {
	//IDX 설정
	$idx = $row2['idx'];
	//지원금 종류
	$application_kind[$app_no] = $row2['application_kind'];
	//신청기간/분기 선택
	$application_date_chk = $row2['application_date_chk'];
	//재신청일자 완료
	$reapplication_done = $row2['reapplication_done'];

	$k = $app_no;
	if($k == 1) $k = "";
	$m = $app_no-1;
?>
									<table border="0" cellspacing="0" cellpadding="0" style=""> 
										<tr>
											<td id=""> 
												<table border="0" cellpadding="0" cellspacing="0"> 
													<tr> 
														<td><img src="images/g_tab_on_lt.gif"></td> 
														<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
															지원금<?=$app_no?>
														</td> 
														<td><img src="images/g_tab_on_rt.gif"></td> 
													</tr> 
												</table> 
											</td> 
											<td width=2></td> 
											<td valign="bottom">
											</td> 
										</tr> 
									</table>
									<div style="height:2px;font-size:0px" class="bgtr"></div>
									<div style="height:2px;font-size:0px;line-height:0px;"></div>
									<!-- 입력폼 -->
									<input type="hidden" name="idx<?=$k?>" value="<?=$idx?>">
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
										<tr>
											<td nowrap rowspan="" class="tdrowk" width="110">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">종류
											</td>
											<td nowrap class="tdrow" width="136">
<?
$application_review = $row2['application_review'];
$application_recognize = $row2['application_recognize'];
//전기,물, 농지, 취등록세
if($application_kind[$app_no] >= 13 && $application_kind[$app_no] <= 16) $fee_kind = "contribution";
else $fee_kind = "support";
$application_kind_app_no = $application_kind[$app_no];
echo $support_kind_array[$application_kind_app_no];
?>
											</td>
											<td nowrap class="tdrowk" width="80"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">우편물발송</td>
											<td nowrap  class="tdrow" width="130">
<?
echo $row2['application_send'];
?>
											</td>
											<td nowrap class="tdrowk" width="80"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">운송장번호</td>
											<td nowrap  class="tdrow" width="160">
<?
echo $row2['application_send_no'];
?>
											</td>
											<td nowrap class="tdrowk" width="80"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">접수일자</td>
											<td nowrap  class="tdrow">
												<input name="application_accept<?=$k?>" type="text" class="textfm" style="width:70px;ime-mode:disabled;" value="<?=$row2['application_accept']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
												<table border=0 cellpadding=0 cellspacing=0 style="display:inline;vertical-align:middle"><tr><td width=2></td><td><img src=./images/btn3_lt.gif></td><td background=./images/btn3_bg.gif class=ftbutton3_white nowrap><a href="javascript:chk_today('application_accept<?=$k?>', '1');" target="">완료</a></td><td><img src=./images/btn3_rt.gif></td> <td width=2></td></tr></table>
											</td>
										</tr>
										<tr>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" />신청기간
<?
//echo $m;
if($application_date_chk == 1) $application_date_chk_selected = "selected";
else $application_date_chk_selected = "";
if($application_date_chk == 1) echo ": 분기";
else echo ": 기간";
?>
											</td>
											<td nowrap  class="tdrow" colspan="3">
<?
//신청분기
$application_quarter_year = explode(',',$row2['application_quarter_year']);
$application_quarter = explode('_',$row2['application_quarter']);
$application_quarter_1 = explode(',',$application_quarter[0]);
$application_quarter_2 = explode(',',$application_quarter[1]);
$application_quarter_3 = explode(',',$application_quarter[2]);
if($application_quarter_year[0]) {
	echo $application_quarter_year[0]."년 ";
	if($application_quarter_1[0]) echo "1분기 ";
	if($application_quarter_1[1]) echo "2분기 ";
	if($application_quarter_1[2]) echo "3분기 ";
	if($application_quarter_1[3]) echo "4분기 ";
	echo "<br>";
}
if($application_quarter_year[1]) {
	echo $application_quarter_year[1]."년 ";
	if($application_quarter_2[0]) echo "1분기 ";
	if($application_quarter_2[1]) echo "2분기 ";
	if($application_quarter_2[2]) echo "3분기 ";
	if($application_quarter_2[3]) echo "4분기 ";
	echo "<br>";
}
if($application_quarter_year[2]) {
	echo $application_quarter_year[2]."년 ";
	if($application_quarter_3[0]) echo "1분기 ";
	if($application_quarter_3[1]) echo "2분기 ";
	if($application_quarter_3[2]) echo "3분기 ";
	if($application_quarter_3[3]) echo "4분기 ";
}
?>
												</div>
											</td>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">신청금액
											</td>
											<td nowrap class="tdrow">
<?
//신청금액
if($row2['application_fee_sum']) $application_fee_sum = number_format($row2['application_fee_sum']);
else $application_fee_sum = "";
if($row2['application_fee_sum']) echo number_format($row2['application_fee_sum'])."";
?>
											</td>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">재접수일자
											</td>
											<td nowrap class="tdrow">
<?
if($row2['reapplication_date']) echo $row2['reapplication_date'];
?>
											</td>
										</tr>
										<tr>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">종료구분
											</td>
											<td nowrap class="tdrow">
<?
if($row2['close_kind'] == 1) echo "분기";
else echo "기간";
?>
											</td>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">종료일자
											</td>
											<td nowrap class="tdrow">
												<div id="close_date_a_<?=$app_no?>" style="<? if($row2['close_kind'] == 1) echo "display:none"; ?>">
<?
echo $row2['close_date'];
?>
												</div>
												<div id="close_date_b_<?=$app_no?>" style="<? if($row2['close_kind'] != 1) echo "display:none"; ?>">
<?
echo $row2['close_year']."년 ";
echo $row2['close_quarter']."분기 ";
?>
												</div>
											</td>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">신청주기
											</td>
											<td nowrap class="tdrow">
<?
if($row2['application_cycle'] == 1) echo "매월";
else if($row2['application_cycle'] == 2) echo "분기";
else echo "";
?>
											</td>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">최종완료
											</td>
											<td nowrap class="tdrow">
<?
if($row2['reapplication_done'] == 1) $reapplication_done_text = "완료";
else if($row2['reapplication_done'] == 2) $reapplication_done_text = "반려";
else if($row2['reapplication_done'] == 3) $reapplication_done_text = "취소";
else if($row2['reapplication_done'] == 4) $reapplication_done_text = "이관";
else $reapplication_done_text = "";
echo $reapplication_done_text;
?>
											</td>
										</tr>
										<tr>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">업체입금일
											</td>
											<td nowrap class="tdrow">
<?
if($row2['client_receipt_date']) echo $row2['client_receipt_date'];
?>
											</td>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">입금금액
											</td>
											<td nowrap class="tdrow">
<?
//신청금액
if($row2['client_receipt_fee']) $client_receipt_fee = number_format($row2['client_receipt_fee']);
else $client_receipt_fee = "";
if($row2['client_receipt_fee']) echo number_format($row2['client_receipt_fee'])."";
?>
											</td>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">거래명세서
											</td>
											<td nowrap class="tdrow">
<?
if($row2['statement_date']) echo $row2['statement_date'];
?>
											</td>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">청구금액(거래)
											</td>
											<td nowrap class="tdrow">
<?
if($row2['requested_amount']) $requested_amount = number_format($row2['requested_amount']);
else $requested_amount = "";
if($row2['requested_amount']) echo number_format($row2['requested_amount'])."";
?>
											</td>
										</tr>
										<tr>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">세금계산서
											</td>
											<td nowrap class="tdrow">
<?
if($row2['tax_invoice']) echo $row2['tax_invoice'];
?>
											</td>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">본사입금일
											</td>
											<td nowrap class="tdrow">
<?
if($row2['main_receipt_date']) echo $row2['main_receipt_date']." ".$main_receipt_date;
?>
											</td>
											<td nowrap colspan="3" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">본사입금금액(부가세<b>포함</b>)
											</td>
											<td nowrap class="tdrow" colspan="">
<?
if($row2['main_receipt_fee']) $main_receipt_fee = number_format($row2['main_receipt_fee']);
else $main_receipt_fee = "";
if($row2['main_receipt_fee']) echo $main_receipt_fee;
?>
											</td>
										</tr>
										<tr>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">입금처
											</td>
											<td nowrap class="tdrow">
<?
$receipt_place = $row2['receipt_place'];
if($receipt_place == 1) echo "한경";
else if($receipt_place == 2) echo "변호사";
else echo "";
?>
											</td>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">담당자
											</td>
											<td nowrap class="tdrow">
<?
if($row2['person_charge']) {
	$person_charge = $row2['person_charge'];
} else if($row['damdang_code'] == 1) {
	$person_charge = $row['manage_cust_name'];
} else {
	$man_cust_name_code = $row['damdang_code'];
	$person_charge = $man_cust_name_arry[$man_cust_name_code];
}
if($row2['person_charge']) echo $person_charge;
?>
											</td>
											<td nowrap colspan="" class="tdrowk" width="">
											</td>
											<td nowrap class="tdrow" colspan="3">
											</td>
										</tr>
										<tr>
											<td nowrap colspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">메모(사유)
											</td>
											<td nowrap class="tdrow" colspan="7">
<?
$app_memo = $row2['app_memo'];
?>
												<pre style='white-space:pre-wrap;word-wrap:break-word;'><?=$app_memo?></pre>
											</td>
										</tr>
									</table>
									<div style="height:10px;font-size:0px"></div>
<?
}
//지원금 for문 end
?>
									<!--첨부서류-->
									<table border=0 cellspacing=0 cellpadding=0> 
										<tr>
											<td id=""> 
												<table border=0 cellpadding=0 cellspacing=0> 
													<tr> 
														<td><img src="images/sb_tab_on_lt.gif"></td> 
														<td background="images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
															첨부서류
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
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
										<tr>
											<td nowrap class="tdrowk" width="110"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><b>기본서류</b><font color="red"></font></td>
											<td nowrap  class="tdrow" colspan="3">
<?
$file_check = explode(',',$row['file_check']);
$file_easynomu = explode(',',$row['file_easynomu']);
if($file_check[0]) echo "컨설팅의뢰서. ";
if($file_check[1]) echo "계약서. ";
if($file_check[2]) echo "사무위탁서. ";
if($file_check[3]) echo "대리인선임(공단). ";
if($file_check[4]) echo "전자민원(센터). ";
if($file_check[5]) echo "사업자등록증. ";
if($file_check[6]) echo "통장사본. ";
if($file_check[7]) echo "취득/상실리스트. ";
if($file_check[8]) echo "시간선택제. ";
if($file_check[9]) echo "정책자금의뢰서. ";
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일1
											</td>
											<td   class="tdrow" width="373">
												<a href="files/contract/<?=$row['filename_1']?>" target="_blank"><?=$row['filename_1']?></a>
											</td>
											<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일2</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_2']?>" target="_blank"><?=$row['filename_2']?></a>
											</td>
										</tr>
										<tr id="file_tr2" style="<? if(!$row['filename_3'] && !$row['filename_4']) echo "display:none"; ?>">
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일3</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_3']?>" target="_blank"><?=$row['filename_3']?></a>
											</td>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일4</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_4']?>" target="_blank"><?=$row['filename_4']?></a>
											</td>
										</tr>
										<tr id="file_tr3" style="<? if(!$row['filename_5'] && !$row['filename_6']) echo "display:none"; ?>">
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일5</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_5']?>" target="_blank"><?=$row['filename_5']?></a>
											</td>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일6</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_6']?>" target="_blank"><?=$row['filename_6']?></a>
											</td>
										</tr>
										<tr id="file_tr4" style="<? if(!$row['filename_7'] && !$row['filename_8']) echo "display:none"; ?>">
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일7</td>
											<td   class="tdrow" >
												<br><a href="files/contract/<?=$row['filename_7']?>" target="_blank"><?=$row['filename_7']?></a>
											</td>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일8</td>
											<td   class="tdrow" >
												<br><a href="files/contract/<?=$row['filename_8']?>" target="_blank"><?=$row['filename_8']?></a>
											</td>
										</tr>
									</table>
									<div style="height:10px;font-size:0px"></div>

									<input type="hidden" name="app_count" value="<?=$app_no-1?>">
									<div style="height:10px;font-size:0px"></div>
									<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
										<tr>
											<td align="center">
<?
//권한별 링크값
//echo $member['mb_level'];
if($member['mb_level'] >= 8) {
	$url_save = "javascript:checkData('family_insurance_update.php');";
} else {
	$url_save = "javascript:alert_no_right();";
}
$url_save = "javascript:checkData('family_insurance_update.php');";
if($member['mb_level'] >= 6) {
?>
												<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="<?=$url_save?>" target="">저 장</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<? } ?>
												<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./family_insurance_list.php?page=<?=$page?>&stx_count=<?=$stx_count?>" target="">목 록</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<?
if($w == "u") {
?>
												<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./client_view.php?w=<?=$w?>&id=<?=$id?>" target="">거래처정보</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
												<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./client_process_view.php?w=<?=$w?>&id=<?=$id?>" target="">접수처리현황</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
												<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./settlement_view.php?w=<?=$w?>&id=<?=$id?>" target="">결산현황</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<? } ?>
											</td>
										</tr>
									</table>
<?
include "inc/client_comment_only.php";
?>
									<div style="height:20px;font-size:0px"></div>
									<!--공통 변수-->
									<input type="hidden" name="prv_cust_tell"  value="<?=$row['com_tel']?>" />
									<input type="hidden" name="prv_user_id" value="<?=$row['t_insureno']?>" />
									<input type="hidden" name="w" value="<?=$w?>" />
									<input type="hidden" name="id" value="<?=$id?>" />
									<input type="hidden" name="page" value="<?=$page?>" />
								</form>
							</div>
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
