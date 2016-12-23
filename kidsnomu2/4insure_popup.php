<? 
$mode = "popup";
$member['mb_id'] = "test";
include_once("_common.php");
//include_once("$g4[path]/lib/popup.lib.php"); 

// 로그인 시 사업자정보 로그인
if($member['mb_id']) {
	$sql_a4 = " select * from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
	$row_a4 = sql_fetch($sql_a4);
	$row1['comp_name'] = $row_a4['com_name'];
	$row1['comp_adr']  = $row_a4['com_juso']." ".$row_a4['com_juso2'];
	$row1['comp_bznb'] = $row_a4['t_insureno'];
	$row1['comp_tel']  = $row_a4['com_tel'];
	$row1['comp_mail']  = $row_a4['com_mail'];
	$row1['comp_fax']  = $row_a4['com_fax'];
}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>4대보험 취득/상실 신고서</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
<script language="javascript">
function checkData() {
	var frm = document.dataForm;
/*
	//alert(frm.quit_count.value);
	if(frm.quit_count.value == 3) {
		if(frm['quit_sum_pre_[]'].value == "") {
			alert("2번째 퇴사자 전년도임금총액을 입력하세요.");
			frm['quit_sum_pre_[]'].focus();
			return;
		}
	}
	if(frm.quit_count.value > 3) {
		if(frm['quit_sum_pre_[]'][0].value == "") {
			alert("2번째 퇴사자 전년도임금총액을 입력하세요.");
			frm['quit_sum_pre_[]'][0].focus();
			return;
		}
		if(frm['quit_sum_pre_[]'][1].value == "") {
			alert("3번째 퇴사자 전년도임금총액을 입력하세요.");
			frm['quit_sum_pre_[]'][1].focus();
			return;
		}
	}
	return;
*/
	if (frm.comp_bznb.value == "")
	{
		alert("사업자등록번호를 입력하세요.");
		frm.comp_bznb.focus();
		return;
	}
	if (frm.comp_name.value == "")
	{
		alert("사업장명칭을 입력하세요.");
		frm.comp_name.focus();
		return;
	}
	if (frm.comp_adr.value == "")
	{
		alert("사업장소재지를 입력하세요.");
		frm.comp_adr.focus();
		return;
	}
	if (frm.comp_tel.value == "")
	{
		alert("전화번호(사업장)를 입력하세요.");
		frm.comp_tel.focus();
		return;
	}
	if (frm.comp_email.value == "")
	{
		alert("이메일을 입력하세요.");
		frm.comp_email.focus();
		return;
	}
	if (!frm.join_ok.checked && !frm.quit_ok.checked)
	{
		alert("입사자 또는 퇴사자 정보를 입력하세요.");
		frm.join_ok.focus();
		return;
	}

	if(frm.join_ok.checked) {

		if (frm.join_name.value == "")
		{
			alert("성명(입사자)을 입력하세요.");
			frm.join_name.focus();
			return;
		}
		if (frm.join_ssnb.value == "")
		{
			alert("주민등록번호(입사자)를 입력하세요.");
			frm.join_ssnb.focus();
			return;
		}
		if (frm.join_date.value == "")
		{
			alert("입사일을 입력하세요.");
			frm.join_date.focus();
			return;
		}
		if (frm.join_jikjong.value == "")
		{
			alert("직종을 입력하세요.");
			frm.join_jikjong.focus();
			return;
		}
		if (frm.join_time.value == "")
		{
			alert("주소정근로시간을 입력하세요.");
			frm.join_time.focus();
			return;
		}
		if (frm.join_salary.value == "")
		{
			alert("월임금을 입력하세요.");
			frm.join_salary.focus();
			return;
		}
		//alert(frm.isgy.checked);
		if (!frm.isgy.checked && !frm.issj.checked && !frm.iskm.checked && !frm.isgg.checked)
		{
			alert("보험적용여부를 선택해 주세요.");
			frm.isgy.focus();
			return;
		}
	}
	//퇴사자 체크
	if(frm.quit_ok.checked) {
		if (frm.quit_name.value == "")
		{
			alert("성명(퇴사자)을 입력하세요.");
			frm.quit_name.focus();
			return;
		}
		if (frm.quit_ssnb.value == "")
		{
			alert("주민등록번호(퇴사자)를 입력하세요.");
			frm.quit_ssnb.focus();
			return;
		}
		if (frm.quit_tel.value == "")
		{
			alert("전화번호(퇴사자)를 입력하세요.");
			frm.quit_tel.focus();
			return;
		}
		if (frm.quit_date.value == "")
		{
			alert("마지막근무일을 입력하세요.");
			frm.quit_date.focus();
			return;
		}
		if (frm.quit_cause.value == "")
		{
			alert("퇴직사유를 입력하세요.");
			frm.quit_cause.focus();
			return;
		}
		if (frm.quit_sum_now.value == "")
		{
			alert("해당연도임금총액을 입력하세요.");
			frm.quit_sum_now.focus();
			return;
		}
		if (frm.quit_sum_now_month.value == "")
		{
			alert("해당연도임금총액 산정월수를 입력하세요.");
			frm.quit_sum_now_month.focus();
			return;
		}
/*
		if (frm.quit_3month.value == "")
		{
			alert("퇴직전3개월간 평균임금을 입력하세요.");
			frm.quit_3month.focus();
			return;
		}
*/
		if (frm.quit_sum_pre.value == "")
		{
			alert("전년도임금총액을 입력하세요.");
			frm.quit_sum_pre.focus();
			return;
		}
		if (frm.quit_sum_pre_month.value == "")
		{
			alert("전년도임금총액 산정월수를 입력하세요.");
			frm.quit_sum_pre_month.focus();
			return;
		}
		//퇴사자 추가
		if(frm.quit_count.value == 3) {
			if(frm['quit_name_[]'].value != "") {
				if(frm['quit_ssnb_[]'].value == "") {
					alert("2번째 퇴사자 주민등록번호를 입력하세요.");
					frm['quit_ssnb_[]'].focus();
					return;
				}
				if(frm['quit_tel_[]'].value == "") {
					alert("2번째 퇴사자 전화번호를 입력하세요.");
					frm['quit_tel_[]'].focus();
					return;
				}
				if(frm['quit_date_[]'].value == "") {
					alert("2번째 퇴사자 마지막근무일을 입력하세요.");
					frm['quit_date_[]'].focus();
					return;
				}
				if(frm['quit_cause_[]'].value == "") {
					alert("2번째 퇴사자 퇴직사유를 입력하세요.");
					frm['quit_cause_[]'].focus();
					return;
				}
				if(frm['quit_sum_now_[]'].value == "") {
					alert("2번째 퇴사자 해당연도임금총액을 입력하세요.");
					frm['quit_sum_now_[]'].focus();
					return;
				}
				if(frm['quit_sum_now_month_[]'].value == "") {
					alert("2번째 퇴사자 해당연도임금총액 산정월수를 입력하세요.");
					frm['quit_sum_now_month_[]'].focus();
					return;
				}
/*
				if(frm['quit_3month_[]'].value == "") {
					alert("2번째 퇴직전3개월간 평균임금을 입력하세요.");
					frm['quit_3month_[]'].focus();
					return;
				}
*/
				if(frm['quit_sum_pre_[]'].value == "") {
					alert("2번째 퇴사자 전년도임금총액을 입력하세요.");
					frm['quit_sum_pre_[]'].focus();
					return;
				}
				if(frm['quit_sum_pre_month_[]'].value == "") {
					alert("2번째 퇴사자 전년도임금총액 산정월수를 입력하세요.");
					frm['quit_sum_pre_month_[]'].focus();
					return;
				}
			}
		}
		if(frm.quit_count.value > 3) {
			if(frm['quit_name_[]'][0].value != "") {
				if(frm['quit_ssnb_[]'][0].value == "") {
					alert("2번째 퇴사자 주민등록번호를 입력하세요.");
					frm['quit_ssnb_[]'][0].focus();
					return;
				}
				if(frm['quit_tel_[]'][0].value == "") {
					alert("2번째 퇴사자 전화번호를 입력하세요.");
					frm['quit_tel_[]'][0].focus();
					return;
				}
				if(frm['quit_date_[]'][0].value == "") {
					alert("2번째 퇴사자 마지막근무일을 입력하세요.");
					frm['quit_date_[]'][0].focus();
					return;
				}
				if(frm['quit_cause_[]'][0].value == "") {
					alert("2번째 퇴사자 퇴직사유를 입력하세요.");
					frm['quit_cause_[]'][0].focus();
					return;
				}
				if(frm['quit_sum_now_[]'][0].value == "") {
					alert("2번째 퇴사자 해당연도임금총액을 입력하세요.");
					frm['quit_sum_now_[]'][0].focus();
					return;
				}
				if(frm['quit_sum_now_month_[]'][0].value == "") {
					alert("2번째 퇴사자 해당연도임금총액 산정월수를 입력하세요.");
					frm['quit_sum_now_month_[]'][0].focus();
					return;
				}
/*
				if(frm['quit_3month_[]'][0].value == "") {
					alert("2번째 퇴직전3개월간 평균임금을 입력하세요.");
					frm['quit_3month_[]'][0].focus();
					return;
				}
*/
				if(frm['quit_sum_pre_[]'][0].value == "") {
					alert("2번째 퇴사자 전년도임금총액을 입력하세요.");
					frm['quit_sum_pre_[]'][0].focus();
					return;
				}
				if(frm['quit_sum_pre_month_[]'][0].value == "") {
					alert("2번째 퇴사자 전년도임금총액 산정월수를 입력하세요.");
					frm['quit_sum_pre_month_[]'][0].focus();
					return;
				}
			}
			if(frm['quit_name_[]'][1].value != "") {
				if(frm['quit_ssnb_[]'][1].value == "") {
					alert("3번째 퇴사자 주민등록번호를 입력하세요.");
					frm['quit_ssnb_[]'][1].focus();
					return;
				}
				if(frm['quit_tel_[]'][1].value == "") {
					alert("3번째 퇴사자 전화번호를 입력하세요.");
					frm['quit_tel_[]'][1].focus();
					return;
				}
				if(frm['quit_date_[]'][1].value == "") {
					alert("3번째 퇴사자 마지막근무일을 입력하세요.");
					frm['quit_date_[]'][1].focus();
					return;
				}
				if(frm['quit_cause_[]'][1].value == "") {
					alert("3번째 퇴사자 퇴직사유를 입력하세요.");
					frm['quit_cause_[]'][1].focus();
					return;
				}
				if(frm['quit_sum_now_[]'][1].value == "") {
					alert("3번째 퇴사자 해당연도임금총액을 입력하세요.");
					frm['quit_sum_now_[]'][1].focus();
					return;
				}
				if(frm['quit_sum_now_month_[]'][1].value == "") {
					alert("3번째 퇴사자 해당연도임금총액 산정월수를 입력하세요.");
					frm['quit_sum_now_month_[]'][1].focus();
					return;
				}
/*
				if(frm['quit_3month_[]'][1].value == "") {
					alert("3번째 퇴직전3개월간 평균임금을 입력하세요.");
					frm['quit_3month_[]'][1].focus();
					return;
				}
*/
				if(frm['quit_sum_pre_[]'][1].value == "") {
					alert("3번째 퇴사자 전년도임금총액을 입력하세요.");
					frm['quit_sum_pre_[]'][1].focus();
					return;
				}
				if(frm['quit_sum_pre_month_[]'][1].value == "") {
					alert("3번째 퇴사자 전년도임금총액 산정월수를 입력하세요.");
					frm['quit_sum_pre_month_[]'][1].focus();
					return;
				}
			}
			if(frm.quit_count.value > 4) {
				if(frm['quit_name_[]'][2].value != "") {
					if(frm['quit_ssnb_[]'][2].value == "") {
						alert("4번째 퇴사자 주민등록번호를 입력하세요.");
						frm['quit_ssnb_[]'][2].focus();
						return;
					}
					if(frm['quit_tel_[]'][2].value == "") {
						alert("4번째 퇴사자 전화번호를 입력하세요.");
						frm['quit_tel_[]'][2].focus();
						return;
					}
					if(frm['quit_date_[]'][2].value == "") {
						alert("4번째 퇴사자 마지막근무일을 입력하세요.");
						frm['quit_date_[]'][2].focus();
						return;
					}
					if(frm['quit_cause_[]'][2].value == "") {
						alert("4번째 퇴사자 퇴직사유를 입력하세요.");
						frm['quit_cause_[]'][2].focus();
						return;
					}
					if(frm['quit_sum_now_[]'][2].value == "") {
						alert("4번째 퇴사자 해당연도임금총액을 입력하세요.");
						frm['quit_sum_now_[]'][2].focus();
						return;
					}
					if(frm['quit_sum_now_month_[]'][2].value == "") {
						alert("4번째 퇴사자 해당연도임금총액 산정월수를 입력하세요.");
						frm['quit_sum_now_month_[]'][2].focus();
						return;
					}
/*
					if(frm['quit_3month_[]'][2].value == "") {
						alert("4번째 퇴직전3개월간 평균임금을 입력하세요.");
						frm['quit_3month_[]'][2].focus();
						return;
					}
*/
					if(frm['quit_sum_pre_[]'][2].value == "") {
						alert("4번째 퇴사자 전년도임금총액을 입력하세요.");
						frm['quit_sum_pre_[]'][2].focus();
						return;
					}
					if(frm['quit_sum_pre_month_[]'][2].value == "") {
						alert("4번째 퇴사자 전년도임금총액 산정월수를 입력하세요.");
						frm['quit_sum_pre_month_[]'][2].focus();
						return;
					}
				}
				if(frm.quit_count.value > 5) {
					if(frm['quit_name_[]'][3].value != "") {
						if(frm['quit_ssnb_[]'][3].value == "") {
							alert("5번째 퇴사자 주민등록번호를 입력하세요.");
							frm['quit_ssnb_[]'][3].focus();
							return;
						}
						if(frm['quit_tel_[]'][3].value == "") {
							alert("5번째 퇴사자 전화번호를 입력하세요.");
							frm['quit_tel_[]'][3].focus();
							return;
						}
						if(frm['quit_date_[]'][3].value == "") {
							alert("5번째 퇴사자 마지막근무일을 입력하세요.");
							frm['quit_date_[]'][3].focus();
							return;
						}
						if(frm['quit_cause_[]'][3].value == "") {
							alert("5번째 퇴사자 퇴직사유를 입력하세요.");
							frm['quit_cause_[]'][3].focus();
							return;
						}
						if(frm['quit_sum_now_[]'][3].value == "") {
							alert("5번째 퇴사자 해당연도임금총액을 입력하세요.");
							frm['quit_sum_now_[]'][3].focus();
							return;
						}
						if(frm['quit_sum_now_month_[]'][3].value == "") {
							alert("5번째 퇴사자 해당연도임금총액 산정월수를 입력하세요.");
							frm['quit_sum_now_month_[]'][3].focus();
							return;
						}
/*
						if(frm['quit_3month_[]'][3].value == "") {
							alert("4번째 퇴직전3개월간 평균임금을 입력하세요.");
							frm['quit_3month_[]'][3].focus();
							return;
						}
*/
						if(frm['quit_sum_pre_[]'][3].value == "") {
							alert("5번째 퇴사자 전년도임금총액을 입력하세요.");
							frm['quit_sum_pre_[]'][3].focus();
							return;
						}
						if(frm['quit_sum_pre_month_[]'][3].value == "") {
							alert("5번째 퇴사자 전년도임금총액 산정월수를 입력하세요.");
							frm['quit_sum_pre_month_[]'][3].focus();
							return;
						}
					}
				}
			}
		}
	}
	document.getElementById('save_bt').style.display = "none";
	document.getElementById('save_ing').style.display = "inline";

	frm.action = "4insure_update.php";
	frm.submit();
	return;
}
function join_ok_func() {
	var frm = document.dataForm;
	if(!frm.join_ok.checked) frm.join_ok.checked = true;
}
function quit_ok_func() {
	var frm = document.dataForm;
	if(!frm.quit_ok.checked) frm.quit_ok.checked = true;
}
function checkThousand(inputVal, type, keydown) {		// inputVal은 천단위에 , 표시를 위해 가져오는 값
	main = document.dataForm;			// 여기서 type 은 해당하는 값을 넣기 위한 위치지정 index
	var chk		= 0;				// chk 는 천단위로 나눌 길이를 check
	var share	= 0;				// share 200,000 와 같이 3의 배수일 때를 구분하기 위한 변수
	var start	= 0;
	var triple	= 0;				// triple 3, 6, 9 등 3의 배수 
	var end		= 0;				// start, end substring 범위를 위한 변수  
	var total	= "";			
	var input	= "";				// total 임의로 string 들을 규합하기 위한 변수
	if (inputVal.length > 3){
		input = delCom(inputVal, inputVal.length);
		/*
		for(i=0; i<inputVal.length; i++){
			if(inputVal.substring(i,i+1)!=','){		// 먼저 substring을 위해
				input += inputVal.substring(i,i+1);	// 값의 모든 , 를 제거
			}
		}*/
		chk = (input.length)/3;					// input 값을 3의로 나눈 값 계산
		chk = Math.floor(chk);					// 그 값보다 작거나 같은 값 중 최대의 정수 계산
		share = (input.length)%3;				// 200,000 와 같은 3의 배수인 수를 걸러내기 위해 나머지 계산
		if (share == 0 ) {						
			chk = chk - 1;					// 길이가 3의 배수인 수를 위해 chk 값을 하나 뺀다.
		}
		for(i=chk; i>0; i--){
			triple = i * 3;					// 3의 배수 계산 9,6,3 등과 같은 순으로
			end = Number(input.length)-Number(triple);	// 이 때의 end 값은 점차 늘어 나게 된다.
			total += input.substring(start,end)+",";	// total은 앞에서 부터 차례로 붙인다.
			start = end;					// end 값은 다음번의 start 값으로 들어간다.
		}
		total +=input.substring(start,input.length);		// 최종적으로 마지막 3자리 수를 뒤에 붙힌다.
	} else {
		total = inputVal;					// 3의 배수가 되기 이전에는 값이 그대로 유지된다.
	}
	if(keydown =='Y'){
		type.value=total;					// type 에 따라 최종값을 넣어 준다.
	}else if(keydown =='N'){
		return total
	}
	return total
}
function delCom(inputVal, count){
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!=','){		// 먼저 substring을 위해
			tmp += inputVal.substring(i,i+1);	// 값의 모든 , 를 제거
		}
	}
	return tmp;
}
function only_number_hyphen() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if(event.keyCode != 45) event.returnValue = false;
	}
}
function only_number() {
	//키보드 상단 숫자키
	if (event.keyCode < 48 || event.keyCode > 57) {
		//키보드 우측 숫자키
		if (event.keyCode < 95 || event.keyCode > 105) {
			//del 46 , backsp 8 , left 37 , right 39 , tab 9 , shift 16 , Ctrl+V , Ctrl+C
			if(event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39 && event.keyCode != 9 && event.keyCode != 16 && !(event.ctrlKey  == true && event.keyCode == 86) && !(event.ctrlKey  == true && event.keyCode == 67)) {
				event.preventDefault ? event.preventDefault() : event.returnValue = false;
			}
		}
	}
}
function open_comp(frm_name) {
	if(frm_name == 2) frm = document.dataForm2;
	else frm = document.dataForm;
	n = frm.comp_bznb.value;
	if(frm.comp_bznb.value == "") {
		alert("사업자등록번호를 입력 후 검색해 주십시오.");
		frm.comp_bznb.focus();
		return;
	}
	window.open("popup/comp_bznb_popup.php?comp_bznb="+n+"&frm="+frm_name, "comp_popup", "width=540, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
}
function open_jikjong(n) {
	window.open("popup/jikjong_popup.php?n=_"+n, "jikjong_popup", "width=540, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
}
function iframe_focus(rowNum,nhicRowNum) {
	//빈함수
}
function value_set(n,m) {
	//빈함수
}
//사업자등록번호 자동 하이픈
function checkBznb(inputVal, type, keydown, frm) {		// inputVal은 천단위에 , 표시를 위해 가져오는 값
	// 여기서 type 은 해당하는 값을 넣기 위한 위치지정 index
	if(frm == 2) main = document.dataForm2;
	else main = document.dataForm;
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
	if(input.substring(0,3) == "mas" || input.substring(0,3) == "use" || input.substring(0,3) == "gue") {
		//master
	} else {
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
				type.value=total;					// type 에 따라 최종값을 넣어 준다.
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
//DIV 숨김 보임
function tab_view(tab) {
	var obj = document.getElementById(tab);
	if(obj.style.display == "none") {
		obj.style.display = "";
	} else {
		obj.style.display = "none";
	}
}
//탭메뉴 변경
function tab_show(tab) {
	var frm = document.dataForm;
	frm.tab.value = tab;
	document.getElementById(tab).style.display="";
	if(tab == "tab1") {
		document.getElementById('tab2').style.display="none";
		document.getElementById('tab_img1').src="./images/4insure_tab01_on.gif";
		document.getElementById('tab_img2').src="./images/4insure_tab02_off.gif";
	} else {
		document.getElementById('tab1').style.display="none";
		document.getElementById('tab_img1').src="./images/4insure_tab01_off.gif";
		document.getElementById('tab_img2').src="./images/4insure_tab02_on.gif";
	}
}
//월평균보수 변경 신고
function checkData2() {
	//alert("준비중입니다.");
	//return;
	var frm = document.dataForm2;
	if (frm.comp_bznb.value == "")
	{
		alert("사업자등록번호를 입력하세요.");
		frm.comp_bznb.focus();
		return;
	}
	if (frm.comp_name.value == "")
	{
		alert("사업장명칭을 입력하세요.");
		frm.comp_name.focus();
		return;
	}
	if (frm.comp_adr.value == "")
	{
		alert("사업장소재지를 입력하세요.");
		frm.comp_adr.focus();
		return;
	}
	if (frm.comp_tel.value == "")
	{
		alert("전화번호(사업장)를 입력하세요.");
		frm.comp_tel.focus();
		return;
	}
	if (frm.comp_email.value == "")
	{
		alert("이메일을 입력하세요.");
		frm.comp_email.focus();
		return;
	}
	if (frm.modify_name.value == "")
	{
		alert("성명을 입력하세요.");
		frm.modify_name.focus();
		return;
	}
	if (frm.modify_ssnb.value == "")
	{
		alert("주민등록번호를 입력하세요.");
		frm.modify_ssnb.focus();
		return;
	}
	if (frm.modify_salary.value == "")
	{
		alert("변경 후 월평균보수를 입력하세요.");
		frm.modify_salary.focus();
		return;
	}
	if (frm.modify_date.value == "")
	{
		alert("보수 변경 연월을 입력하세요.");
		frm.modify_date.focus();
		return;
	}
	if (!frm.misgy.checked && !frm.missj.checked && !frm.miskm.checked && !frm.misgg.checked)
	{
		alert("보험적용여부를 선택해 주세요.");
		frm.misgy.focus();
		return;
	}
	if (frm.modify_reason.value == "")
	{
		alert("변경사유를 입력하세요.");
		frm.modify_reason.focus();
		return;
	}
	document.getElementById('save_bt2').style.display = "none";
	document.getElementById('save_ing2').style.display = "inline";
	frm.action = "4insure_update_a4_modify.php";
	frm.submit();
	return;
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
	//상실일 알림
	if(obj.name == "quit_date") {
		//alert("노동부의 신고되는 상실일은 마지막 근무일 다음 날짜로 신고됩니다.\nex) 마지막 근무일이 2월 28일이면 3월 1일로 상실일을 신고해야 공단에 신고되는 상실일은 2월 28일로 신고됩니다.");
	}
}
</script>
<div style="">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td width="200"><img src="images/logo_kidsnomu.png" /></td>
						<td width="700" style="padding-top:10px">
							<table width="90%" border="0" cellpadding="0" cellspacing="0" id="tables">
								<tr>
									<td>
										<div align="right" class="">
											[ 한국기업경영원 ]&nbsp;&nbsp;&nbsp;
											담당매니저 : 임현미&nbsp;&nbsp;&nbsp;
											TEL : 070-4680-7050&nbsp;&nbsp;&nbsp;
											<!--직통 : 02-1111-1111&nbsp;&nbsp;&nbsp;-->
											FAX : 055-299-1272 <br>0505-609-0001
										</div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td style="background:#ef8036;height:9px"></td>
		</tr>
	</table>
</div>
<div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" style="padding:10px 10px 10px 10px">

			<!--탭메뉴 -->
			<table border=0 cellspacing=0 cellpadding=0> 
				<tr> 
					<td id="Tab_cust_tab_03"> 
						<a href="javascript:tab_show('tab1');"><img src="./images/4insure_tab01_on.gif" border="0" id="tab_img1"></a>
					</td> 
					<td width=2></td> 
					<td id="Tab_cust_tab_04"> 
						<a href="javascript:tab_show('tab2');"><img src="./images/4insure_tab02_off.gif" border="0" id="tab_img2"></a>
					</td> 
					<td width=10></td> 
					<td>동시에 신고가 되지 않습니다. 신고하시고자 하는 화면에서 입력 후 "저장" 버튼을 클릭하여 주십시오.</td>
				</tr> 
			</table>
			<div style="height:2px;font-size:0px" class="bgtr_tab"></div>
			<div style="height:10px;font-size:0px"></div>
			<div id="tab1">
				<!--타이틀 -->
				<table width="100%" border=0 cellspacing=0 cellpadding=0>
					<tr>     
						<td height="18">
							<table width=100% border=0 cellspacing=0 cellpadding=0>
								<tr>
									<td style='font-size:8pt;color:#929292;'><img src="images/g_title_icon.gif" align=absmiddle  style='margin:0 5 2 0'><span style='font-size:8pt;color:black;'>4대보험 취득/상실 신고서</span>
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

				<!--데이터 -->
				<form name="dataForm" method="post" enctype="multipart/form-data">
					<input type="hidden" name="mode" value="<?=$mode?>">
					<input type="hidden" name="join_count" value="2">
					<input type="hidden" name="quit_count" value="2">
					<input type="hidden" name="tab" value="<?=$tab?>">
					<input type="hidden" name="user_id" value="<?=$member['mb_id']?>">
					<table border=0 cellspacing=0 cellpadding=0> 
						<tr> 
							<td id=""> 
								<table border=0 cellpadding=0 cellspacing=0> 
									<tr> 
										<td><img src="images/g_tab_on_lt.gif"></td> 
										<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
										사업장정보
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
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
						<col width="15%">
						<col width="35%">
						<col width="15%">
						<col width="35%">
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사업자등록번호<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="comp_bznb" id="comp_bznb" type="text" class="textfm" style="width:100px;" value="<?=$row1['comp_bznb']?>" maxlength="12" onkeydown="only_number()"  onkeyup="checkBznb(this.value, this,'Y')" >
								<label onclick="open_comp();" style="cursor:pointer"><img src="images/search_bt.png" align=absmiddle></label>
								예) 123-12-12345
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사업장소재지<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="comp_adr" id="comp_adr" type="text" class="textfm" style="width:250px;" value="<?=$row1['comp_adr']?>" maxlength="50">
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사업장명칭<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="comp_name" id="comp_name" type="text" class="textfm" style="width:210px;" value="<?=$row1['comp_name']?>" maxlength="25">
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">전화번호<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="comp_tel" id="comp_tel" type="text" class="textfm" style="width:100px;" value="<?=$row1['comp_tel']?>" maxlength="15"> 예) 055-1234-1234
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">이메일<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="comp_email" id="comp_email" type="text" class="textfm" style="width:210px;" value="<?=$row1['comp_mail']?>" maxlength="30">
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">팩스번호<font color="red"></font></td>
							<td nowrap class="tdrow">
								<input name="comp_fax" id="comp_fax" type="text" class="textfm" style="width:100px;" value="<?=$row1['comp_fax']?>" maxlength="15"> 예) 055-1234-1234
							</td>
						</tr>
					</table>
					<div style="height:10px;font-size:0px;line-height:0px;"></div>

					<table border=0 cellspacing=0 cellpadding=0> 
						<tr> 
							<td style="background-color:#8db41d" valign="top"> 
								<table border=0 cellpadding=0 cellspacing=0> 
									<tr> 
										<td><img src="images/g_tab_on_lt.gif"></td> 
										<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center;'>입사자</td> 
										<td><img src="images/g_tab_on_rt.gif"></td> 
									</tr> 
								</table> 
							</td> 
							<td width=2></td> 
							<td valign="bottom"> <input type="checkbox" name="join_ok" value="1" class="checkbox" style="height:18px"> </td> 
							<td valign="bottom">입사자 입력시 체크해주십시오.</td> 
						</tr> 
					</table>
					<div style="height:2px;font-size:0px" class="bgtr"></div>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<!--검색 -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
						<col width="20%">
						<col width="30%">
						<col width="20%">
						<col width="30%">
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">성명<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="join_name" type="text" class="textfm" style="width:150px;" value="" maxlength="25" onclick="join_ok_func()">
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">주민등록번호<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="join_ssnb" type="text" class="textfm" style="width:100px;" onkeypress="only_number_hyphen()" value="" maxlength="14"> 예) 123456-1234567
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">입사일<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="join_date" type="text" class="textfm5" readonly style="width:80px;" value="" maxlength="10">
								<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.join_date);" target="">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">직종<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="join_jikjong_code" id="join_jikjong_code_undefined" type="text" class="textfm" style="width:30px;" value="" maxlength="3" readonly>
								<input name="join_jikjong" id="join_jikjong_undefined" type="text" class="textfm" style="width:180px;" value="" maxlength="25" readonly>
								<label onclick="open_jikjong();" style="cursor:pointer"><img src="images/search_bt.png" align=absmiddle></label>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">주소정근로시간<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="join_time" type="text" class="textfm" style="width:100px;ime-mode:inactive;" onkeypress="only_number()" value="" maxlength="4">
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">월임금<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="join_salary" type="text" class="textfm" style="width:150px;ime-mode:inactive;" onkeypress="only_number()" value="" maxlength="25" onkeyup="checkThousand(this.value, this,'Y')">
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">보험적용여부<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input type="checkbox" name="isgy" value="1" class="checkbox" checked> 고용
								<input type="checkbox" name="issj" value="1" class="checkbox" checked> 산재
								<input type="checkbox" name="iskm" value="1" class="checkbox" checked> 연금
								<input type="checkbox" name="isgg" value="1" class="checkbox" checked> 건강
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">비고<font color="red"></font></td>
							<td nowrap class="tdrow">
								<input name="join_note" type="text" class="textfm" style="width:150px;" value="" maxlength="25">
							</td>
						</tr>
					</table>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<table border=0 cellspacing=0 cellpadding=0> 
						<tr>
							<td id=""> 
								<table border=0 cellpadding=0 cellspacing=0> 
									<tr> 
										<td><img src="images/sb_tab_on_lt.gif"></td> 
										<td background="images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
											<a href="javascript:tab_view('children');">피부양자 등록</a>
										</td> 
										<td><img src="images/sb_tab_on_rt.gif"></td> 
									</tr> 
								</table> 
							</td> 
							<td width=6></td> 
							<td valign="middle"></td> 
						</tr> 
					</table>
					<div style="height:2px;font-size:0px;background-color:#226bd4"></div>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<!--댑메뉴 -->
					<div id="children" style="display:none">
						<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
							<col width="10%">
							<col width="10%">
							<col width="20%">
							<col width="10%">
							<col width="10%">
							<col width="10%">
							<col width="20%">
							<col width="10%">
							<tr>
								<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">관계</td>
								<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">성명</td>
								<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">주민등록번호</td>
								<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">동거여부</td>
								<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">관계</td>
								<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">성명</td>
								<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">주민등록번호</td>
								<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">동거여부</td>
							</tr>
							<tr>
								<td nowrap class="tdrow">
									<input name="children_relation" type="text" class="textfm" style="width:80px;" value="" maxlength="10">
								</td>
								<td nowrap class="tdrow">
									<input name="children_name" type="text" class="textfm" style="width:80px;" value="" maxlength="10">
								</td>
								<td nowrap class="tdrow">
									<input name="children_ssnb" type="text" class="textfm" style="width:120px;" value="" maxlength="14">
								</td>
								<td nowrap class="tdrow">
									<input name="children_cohabitation" type="checkbox" value="1" class="checkbox"> 동거
								</td>
								<td nowrap class="tdrow">
									<input name="children_relation2" type="text" class="textfm" style="width:80px;" value="" maxlength="10">
								</td>
								<td nowrap class="tdrow">
									<input name="children_name2" type="text" class="textfm" style="width:80px;" value="" maxlength="10">
								</td>
								<td nowrap class="tdrow">
									<input name="children_ssnb2" type="text" class="textfm" style="width:120px;" value="" maxlength="14">
								</td>
								<td nowrap class="tdrow">
									<input name="children_cohabitation2" type="checkbox" value="1" class="checkbox"> 동거
								</td>
							</tr>
							<tr>
								<td nowrap class="tdrow">
									<input name="children_relation3" type="text" class="textfm" style="width:80px;" value="" maxlength="10">
								</td>
								<td nowrap class="tdrow">
									<input name="children_name3" type="text" class="textfm" style="width:80px;" value="" maxlength="10">
								</td>
								<td nowrap class="tdrow">
									<input name="children_ssnb3" type="text" class="textfm" style="width:120px;" value="" maxlength="14">
								</td>
								<td nowrap class="tdrow">
									<input name="children_cohabitation3" type="checkbox" value="1" class="checkbox"> 동거
								</td>
								<td nowrap class="tdrow">
									<input name="children_relation4" type="text" class="textfm" style="width:80px;" value="" maxlength="10">
								</td>
								<td nowrap class="tdrow">
									<input name="children_name4" type="text" class="textfm" style="width:80px;" value="" maxlength="10">
								</td>
								<td nowrap class="tdrow">
									<input name="children_ssnb4" type="text" class="textfm" style="width:120px;" value="" maxlength="14">
								</td>
								<td nowrap class="tdrow">
									<input name="children_cohabitation4" type="checkbox" value="1" class="checkbox"> 동거
								</td>
							</tr>
							<tr>
								<td nowrap class="tdrow">
									<input name="children_relation5" type="text" class="textfm" style="width:80px;" value="" maxlength="10">
								</td>
								<td nowrap class="tdrow">
									<input name="children_name5" type="text" class="textfm" style="width:80px;" value="" maxlength="10">
								</td>
								<td nowrap class="tdrow">
									<input name="children_ssnb5" type="text" class="textfm" style="width:120px;" value="" maxlength="14">
								</td>
								<td nowrap class="tdrow">
									<input name="children_cohabitation5" type="checkbox" value="1" class="checkbox"> 동거
								</td>
								<td nowrap class="tdrow">
									<input name="children_relation6" type="text" class="textfm" style="width:80px;" value="" maxlength="10">
								</td>
								<td nowrap class="tdrow">
									<input name="children_name6" type="text" class="textfm" style="width:80px;" value="" maxlength="10">
								</td>
								<td nowrap class="tdrow">
									<input name="children_ssnb6" type="text" class="textfm" style="width:120px;" value="" maxlength="14">
								</td>
								<td nowrap class="tdrow">
									<input name="children_cohabitation6" type="checkbox" value="1" class="checkbox"> 동거
								</td>
							</tr>
						</table>
					</div>

					<div style="height:5px;font-size:0px;line-height:0px;"></div>

					<script language="javascript">
					function join_plus(n){
						var frm = document.dataForm;
						if(frm.join_count.value > 5) {
							alert("한번에 신고할 수 있는 인원은 5명까지 입니다.");
							return false;
						} else { 
							document.getElementById('join_add_div').style.display = "";
							var Tbl = document.getElementById('join_optable'); 
							tRow = Tbl.insertRow();//tr 추가
							tCell = tRow.insertCell();//td 추가
							tCell.className = "tdrowk";
							tCell.colSpan = 2; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">성명<font color=\"red\">*</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<input name=\"join_name_[]\" type=\"text\" class=\"textfm\" style=\"width:150px;\" value=\"\" maxlength=\"25\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">주민등록번호<font color=\"red\">*</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<input name=\"join_ssnb_[]\" type=\"text\" class=\"textfm\" style=\"width:100px;\" value=\"\" maxlength=\"14\">";

							tRow = Tbl.insertRow();
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">입사일<font color=\"red\">*</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<input name=\"join_date_[]\" type=\"text\" class=\"textfm5\" readonly style=\"width:80px;\" value=\"\" maxlength=\"10\" onclick=\"loadCalendar(this);\"> ☜ <font color=\"red\">클릭시 달력 표시</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">직종<font color=\"red\">*</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<input name=\"join_jikjong_code_[]\" id=\"join_jikjong_code_"+n+"\" type=\"text\" class=\"textfm\" style=\"width:30px;\" value=\"\" maxlength=\"3\" readonly><input name=\"join_jikjong_[]\" id=\"join_jikjong_"+n+"\" type=\"text\" class=\"textfm\" style=\"width:180px;\" value=\"\" maxlength=\"25\" readonly><label onclick=\"open_jikjong("+n+");\" style=\"cursor:pointer\"><img src=\"images/search_bt.png\" align=absmiddle></label>";

							tRow = Tbl.insertRow();
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">주소정근로시간<font color=\"red\">*</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<input name=\"join_time_[]\" type=\"text\" class=\"textfm\" style=\"width:100px;\" value=\"\" maxlength=\"4\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">월임금<font color=\"red\">*</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<input name=\"join_salary_[]\" type=\"text\" class=\"textfm\" style=\"width:150px;ime-mode:inactive;\" onkeypress=\"only_number()\" value=\"\" maxlength=\"25\" onkeyup=\"checkThousand(this.value, this,'Y')\">";

							tRow = Tbl.insertRow();
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">보험적용여부<font color=\"red\">*</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<input type=\"checkbox\" name=\"isgy_[]\" value=\"1\" class=\"checkbox\" checked> 고용 <input type=\"checkbox\" name=\"issj_[]\" value=\"1\" class=\"checkbox\" checked> 산재 <input type=\"checkbox\" name=\"iskm_[]\" value=\"1\" class=\"checkbox\" checked> 연금 <input type=\"checkbox\" name=\"isgg_[]\" value=\"1\" class=\"checkbox\" checked> 건강";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">비고<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<input name=\"join_note_[]\" type=\"text\" class=\"textfm\" style=\"width:150px;\" value=\"\" maxlength=\"25\">";

							tRow = Tbl.insertRow();
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">관계<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">성명<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">주민등록번호<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">동거여부<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">관계<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">성명<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">주민등록번호<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">동거여부<font color=\"red\"></font>";

							tRow = Tbl.insertRow();
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_relation1_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\"\" maxlength=\"10\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_name1_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\"\" maxlength=\"10\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_ssnb1_[]\" type=\"text\" class=\"textfm\" style=\"width:120px;\" value=\"\" maxlength=\"14\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_cohabitation1_[]\" type=\"checkbox\" value=\"1\" class=\"checkbox\"> 동거";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_relation2_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\"\" maxlength=\"10\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_name2_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\"\" maxlength=\"10\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_ssnb2_[]\" type=\"text\" class=\"textfm\" style=\"width:120px;\" value=\"\" maxlength=\"14\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_cohabitation2_[]\" type=\"checkbox\" value=\"1\" class=\"checkbox\"> 동거";

							tRow = Tbl.insertRow();
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_relation3_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\"\" maxlength=\"10\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_name3_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\"\" maxlength=\"10\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_ssnb3_[]\" type=\"text\" class=\"textfm\" style=\"width:120px;\" value=\"\" maxlength=\"14\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_cohabitation3_[]\" type=\"checkbox\" value=\"1\" class=\"checkbox\"> 동거";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_relation4_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\"\" maxlength=\"10\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_name4_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\"\" maxlength=\"10\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_ssnb4_[]\" type=\"text\" class=\"textfm\" style=\"width:120px;\" value=\"\" maxlength=\"14\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_cohabitation4_[]\" type=\"checkbox\" value=\"1\" class=\"checkbox\"> 동거";

							tRow = Tbl.insertRow();
							tCell = tRow.insertCell();
							tCell.className = "tdrow_end"; 
							tCell.innerHTML = "<input name=\"children_relation5_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\"\" maxlength=\"10\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow_end"; 
							tCell.innerHTML = "<input name=\"children_name5_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\"\" maxlength=\"10\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow_end"; 
							tCell.innerHTML = "<input name=\"children_ssnb5_[]\" type=\"text\" class=\"textfm\" style=\"width:120px;\" value=\"\" maxlength=\"14\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow_end"; 
							tCell.innerHTML = "<input name=\"children_cohabitation5_[]\" type=\"checkbox\" value=\"1\" class=\"checkbox\"> 동거";
							tCell = tRow.insertCell();
							tCell.className = "tdrow_end"; 
							tCell.innerHTML = "<input name=\"children_relation6_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\"\" maxlength=\"10\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow_end"; 
							tCell.innerHTML = "<input name=\"children_name6_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\"\" maxlength=\"10\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow_end"; 
							tCell.innerHTML = "<input name=\"children_ssnb6_[]\" type=\"text\" class=\"textfm\" style=\"width:120px;\" value=\"\" maxlength=\"14\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow_end"; 
							tCell.innerHTML = "<input name=\"children_cohabitation6_[]\" type=\"checkbox\" value=\"1\" class=\"checkbox\"> 동거";

							frm.join_count.value++;
							//alert(frm.join_count.value);
						} 
					}

					function quit_plus(n){
						var frm = document.dataForm;
						var quit_cause_option = "<option value=\"11\">개인사정으로 인한 자진퇴사</option><option value=\"12\">사업장 이전, 근로조건변동, 임금체불 등으로 자진퇴사</option><option value=\"22\">폐업, 도산</option><option value=\"23\">경영상 필요 및 회사불황으로 인한감축 등에 의한 퇴사(실업급여)</option><option value=\"26\">근로자의 귀책사유에 의한 징계해고, 권고사직</option><option value=\"31\">정년</option><option value=\"32\">계약만료, 공사종료</option><option value=\"41\">고용보험 비적용, 이중고용</option><option value=\"98\">소명사업장 일괄종료</option><option value=\"99\">전근에 의한 퇴직</option>";
						if(frm.quit_count.value > 5) {
							alert("한번에 신고할 수 있는 인원은 5명까지 입니다.");
							return false;
						} else { 
							document.getElementById('quit_add_div').style.display = "";
							var Tbl = document.getElementById('quit_optable'); 
							tRow = Tbl.insertRow();//tr 추가
							tCell = tRow.insertCell();//td 추가
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">성명<font color=\"red\">*</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"quit_name_[]\" type=\"text\" class=\"textfm\" style=\"width:130px;\" value=\"\" maxlength=\"25\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">주민등록번호<font color=\"red\">*</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"quit_ssnb_[]\" type=\"text\" class=\"textfm\" style=\"width:130px;\" value=\"\" maxlength=\"25\">";

							tRow = Tbl.insertRow();
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">전화번호<font color=\"red\">*</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"quit_tel_[]\" type=\"text\" class=\"textfm\" style=\"width:100px;\" value=\"\" maxlength=\"15\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">마지막근무일<font color=\"red\">*</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"quit_date_[]\" type=\"text\" class=\"textfm5\" readonly style=\"width:80px;\" value=\"\" maxlength=\"10\" onclick=\"loadCalendar(this);\"> ☜ <font color=\"red\">클릭시 달력 표시</font>";

							tRow = Tbl.insertRow();
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">퇴직사유<font color=\"red\">*</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<select name=\"quit_cause_[]\" class=\"selectfm\" style=\"width:100%\"><option value=\"\">선택하세요</option>"+quit_cause_option+"</select>";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">해당연도임금총액<font color=\"red\">*</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"quit_sum_now_[]\" type=\"text\" class=\"textfm\" style=\"width:130px;ime-mode:inactive;\" onkeypress=\"only_number()\" value=\"\" maxlength=\"25\" onkeyup=\"checkThousand(this.value, this,'Y')\"> 산정월수 <input name=\"quit_sum_now_month_[]\" type=\"text\" class=\"textfm\" style=\"width:30px;ime-mode:inactive;\" onkeypress=\"only_number()\" value=\"\" maxlength=\"2\">";

							tRow = Tbl.insertRow();
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">퇴직전3개월간 평균임금<font color=\"red\">*</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"quit_3month_[]\" type=\"text\" class=\"textfm\" style=\"width:130px;ime-mode:inactive;\" onkeypress=\"only_number()\" value=\"\" maxlength=\"25\" onkeyup=\"checkThousand(this.value, this,'Y')\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">전년도임금총액<font color=\"red\">*</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"quit_sum_pre_[]\" type=\"text\" class=\"textfm\" style=\"width:130px;ime-mode:inactive;\" onclick=\"\" onkeypress=\"only_number()\" value=\"\" maxlength=\"25\" onkeyup=\"checkThousand(this.value, this,'Y')\"> 산정월수 <input name=\"quit_sum_pre_month_[]\" type=\"text\" class=\"textfm\" style=\"width:30px;ime-mode:inactive;\" onkeypress=\"only_number()\" value=\"\" maxlength=\"2\">";

							tRow = Tbl.insertRow();
							tCell = tRow.insertCell();
							tCell.className = "tdrowk_end"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">첨부파일<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow_end"; 
							tCell.innerHTML = "<input name=\"filename"+n+"\" type=\"file\" class=\"textfm_search\" style=\"width:220px;\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk_end"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">비고<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow_end"; 
							tCell.innerHTML = "<input name=\"quit_note_[]\" type=\"text\" class=\"textfm\" style=\"width:100%;\" value=\"\" maxlength=\"25\">";

							frm.quit_count.value++;
							//alert(frm.join_count.value);
						} 
					}
					</script>

					<div id="join_add_div" style="display:none">
						<table border=0 cellspacing=0 cellpadding=0> 
							<tr> 
								<td id=""> 
									<table border=0 cellpadding=0 cellspacing=0> 
										<tr> 
											<td><img src="images/g_tab_on_lt.gif"></td> 
											<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
											입사자(추가)
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
					</div>
					<!--검색 -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed" id="join_optable">
						<col width="10%">
						<col width="10%">
						<col width="20%">
						<col width="10%">
						<col width="10%">
						<col width="10%">
						<col width="20%">
						<col width="10%">
					</table>
	 
					<div style="height:5px;font-size:0px;line-height:0px;"></div>
					<table border=0 cellpadding=0 cellspacing=0 style=display:inline;>
						<tr>
							<td width=2></td>
							<td><img src="images/btn_lt.gif"></td>        
							<td background="images/btn_bg.gif" class=ftbutton1 nowrap><label onclick="join_plus(document.dataForm.join_count.value);" style="cursor:pointer">입사자 추가</label></td>
							<td><img src="images/btn_rt.gif"></td>
							<td width=2></td>
						</tr>
					</table>
					<div style="height:10px;font-size:0px;line-height:0px;"></div>

					<table border=0 cellspacing=0 cellpadding=0> 
						<tr> 
							<td style="background-color:#8db41d" valign="top"> 
								<table border=0 cellpadding=0 cellspacing=0> 
									<tr> 
										<td><img src="images/g_tab_on_lt.gif"></td> 
										<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'>퇴사자</td> 
										<td><img src="images/g_tab_on_rt.gif"></td> 
									</tr> 
								</table> 
							</td> 
							<td width=2></td> 
							<td valign="bottom"> <input type="checkbox" name="quit_ok" value="1" class="checkbox" style="height:18px"> </td>
							<td valign="bottom">퇴사자 입력시 체크해주십시오.</td> 
						</tr> 
					</table>
					<div style="height:2px;font-size:0px" class="bgtr"></div>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<!--검색 -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
						<col width="20%">
						<col width="30%">
						<col width="20%">
						<col width="30%">
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">성명<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="quit_name" type="text" class="textfm" style="width:130px;" value="" maxlength="25" onclick="quit_ok_func()">
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">주민등록번호<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="quit_ssnb" type="text" class="textfm" style="width:130px;" value="" maxlength="14">
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">전화번호<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="quit_tel" type="text" class="textfm" style="width:100px;" value="" maxlength="15"> 예) 055-1234-1234
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">마지막근무일<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="quit_date" type="text" class="textfm5" readonly style="width:80px;" value="" maxlength="25">
								<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.quit_date);" target="">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
								<!--<span style="color:red;font-weight:bold;">(마지막 근무 다음날)</span>-->
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">퇴직사유<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<select name="quit_cause" class="selectfm" style="width:100%">
									<option value="">선택하세요</option>
									<option value="11">개인사정으로 인한 자진퇴사</option>
									<option value="12">사업장 이전, 근로조건변동, 임금체불 등으로 자진퇴사</option>
									<option value="22">폐업, 도산</option>
									<option value="23">경영상 필요 및 회사불황으로 인한감축 등에 의한 퇴사(실업급여)</option>
									<option value="26">근로자의 귀책사유에 의한 징계해고, 권고사직</option>
									<option value="31">정년</option>
									<option value="32">계약만료, 공사종료</option>
									<option value="41">고용보험 비적용, 이중고용</option>
									<option value="98">소명사업장 일괄종료</option>
									<option value="99">전근에 의한 퇴직</option>
								</select>
							</td>
							<td nowrap class="tdrowk" style="padding-top:4px;padding-bottom:4px;"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0"><b style="color:red;">해당연도</b>임금총액(<?=date("Y")?>년)<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="quit_sum_now" type="text" class="textfm" style="width:130px;ime-mode:inactive;" onkeypress="only_number()" value="" maxlength="25" onkeyup="checkThousand(this.value, this,'Y')"> 산정월수
								<input name="quit_sum_now_month" type="text" class="textfm" style="width:30px;ime-mode:inactive;" onkeypress="only_number()" value="" maxlength="2"> 
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">퇴직전3개월간 평균임금<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="quit_3month" type="text" class="textfm" style="width:130px;ime-mode:inactive;" onkeypress="only_number()" value="" maxlength="25" onkeyup="checkThousand(this.value, this,'Y')">
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0"><b style="color:red;">전년도</b>임금총액(<?=date("Y", strtotime("-1 year"))?>년)<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="quit_sum_pre" type="text" class="textfm" style="width:130px;ime-mode:inactive;" onkeypress="only_number()" value="" maxlength="25" onkeyup="checkThousand(this.value, this,'Y')"> 산정월수
								<input name="quit_sum_pre_month" type="text" class="textfm" style="width:30px;ime-mode:inactive;" onkeypress="only_number()" value="" maxlength="2"> 
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">첨부파일<font color="red"></font></td>
							<td nowrap class="tdrow">
								<input name="filename" type="file" class="textfm_search" style="width:220px;">
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">비고<font color="red"></font></td>
							<td nowrap class="tdrow">
								<input name="quit_note" type="text" class="textfm" style="width:100%;" value="" maxlength="25">
							</td>
						</tr>
					</table>
					<div style="height:5px;font-size:0px;line-height:0px;"></div>

					<div id="quit_add_div" style="display:none">
					<table border=0 cellspacing=0 cellpadding=0> 
						<tr> 
							<td id=""> 
								<table border=0 cellpadding=0 cellspacing=0> 
									<tr> 
										<td><img src="images/g_tab_on_lt.gif"></td> 
										<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
										퇴사자(추가)
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
					</div>
					<!--검색 -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed" id="quit_optable">
						<col width="20%">
						<col width="30%">
						<col width="20%">
						<col width="30%">
					</table>
	 
					<div style="height:5px;font-size:0px;line-height:0px;"></div>
					<table border=0 cellpadding=0 cellspacing=0 style=display:inline;>
						<tr>
							<td width=2></td>
							<td><img src="images/btn_lt.gif"></td>        
							<td background="images/btn_bg.gif" class=ftbutton1 nowrap><label onclick="quit_plus(document.dataForm.quit_count.value);" style="cursor:pointer">퇴사자 추가</label></td>
							<td><img src="images/btn_rt.gif"></td>
							<td width=2></td>
						</tr>
					</table>
					<div style="height:10px;font-size:0px;line-height:0px;"></div>

					<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:">
						<tr>
							<td align="" style="padding-bottom:15px">
								※ 입사자 건강보험 피부양자 신청시 주민등록사본1부<br>
								※ 임금기재시 식대(10만원), 차량유지비(20만원 단, 차량소지자만 해당) 제외!!<br>
								※ 퇴직사유가 권고사직일 경우 이직확인서 필요함 (3개월 급여, 상여금, 퇴직금, 연락처 기재바람)
							</td>
							<td align="right" style="padding-bottom:15px">
								<div style="padding:0 0 4px 0"><a href="files/hwp/samu_reg.hwp"><img src="images/btn_samu_reg.gif" border="0"></a></div>
								<div>
									<a href="files/hwp/leave_confirmation.hwp"><img src="images/btn_leave.png" border="0"></a>
									<a href="files/hwp/leave_confirmation.zip"><img src="images/btn_leave_zip.png" border="0"></a>
								</div>
							</td>
						</tr>
						<tr>
							<td align="center" colspan="2">
								<table border=0 cellpadding=0 cellspacing=0 style=display:inline;>
								 <tr>
									 <td width=2></td>
										<td><img src=images/btn_lt.gif></td>
										<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:print();" target="">출력</a></td>
										<td><img src=images/btn_rt.gif></td>
									 <td width=2></td>
									</tr>
								</table>
								<table border=0 cellpadding=0 cellspacing=0 style="display:inline;" id="save_bt">
									<tr>
										<td width=2></td>
										<td><img src=images/btn_lt.gif></td>
										<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:checkData();" target="">저장</a></td>
										<td><img src=images/btn_rt.gif></td>
									 <td width=2></td>
									</tr>
								</table>
								<div id="save_ing" style="display:none"><img src="images/save_ing.gif"></div>
								<table border=0 cellpadding=0 cellspacing=0 style=display:inline;>
								 <tr>
									 <td width=2></td>
										<td><img src=images/btn_lt.gif></td>
										<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:close();" target="">닫기</a></td>
										<td><img src=images/btn_rt.gif></td>
									 <td width=2></td>
									</tr>
								</table>
								<div style="color:red;font-weight:bold;">※ 확인서 제출이 필요한 경우 출력 버튼을 먼저 클릭하십시오.</div>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<div id="tab2" style="display:none">
				<!--타이틀 -->
				<table width="100%" border=0 cellspacing=0 cellpadding=0>
					<tr>     
						<td height="18">
							<table width=100% border=0 cellspacing=0 cellpadding=0>
								<tr>
									<td style='font-size:9pt;color:#929292;'><img src="images/g_title_icon.gif" align=absmiddle  style='margin:0 5 2 0'><span style='font-size:9pt;color:black;'>월평균보수 변경 신고서</span>
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
				<!--데이터 -->
				<form name="dataForm2" method="post" enctype="multipart/form-data">
					<input type="hidden" name="mode" value="<?=$mode?>">
					<input type="hidden" name="modify_count" value="2">
					<input type="hidden" name="user_id" value="<?=$member['mb_id']?>">
					<table border=0 cellspacing=0 cellpadding=0> 
						<tr> 
							<td id=""> 
								<table border=0 cellpadding=0 cellspacing=0> 
									<tr> 
										<td><img src="images/g_tab_on_lt.gif"></td> 
										<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
										사업장정보
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
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
						<col width="20%">
						<col width="30%">
						<col width="20%">
						<col width="30%">
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사업자등록번호<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="comp_bznb" id="comp_bznb2" type="text" class="textfm" style="width:100px;" value="<?=$row1['comp_bznb']?>" maxlength="12" onkeydown="only_number()" onkeyup="checkBznb(this.value,this,'Y',2)" >
								<label onclick="open_comp(2);" style="cursor:pointer"><img src="images/search_bt.png" align=absmiddle></label>
								예) 123-12-12345
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사업장소재지<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="comp_adr" id="comp_adr2" type="text" class="textfm" style="width:250px;" value="<?=$row1['comp_adr']?>" maxlength="50">
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사업장명칭<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="comp_name" id="comp_name2" type="text" class="textfm" style="width:210px;" value="<?=$row1['comp_name']?>" maxlength="25">
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">전화번호<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="comp_tel" id="comp_tel2" type="text" class="textfm" style="width:100px;" value="<?=$row1['comp_tel']?>" maxlength="15"> 예) 055-1234-1234
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">이메일<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="comp_email" id="comp_email2" type="text" class="textfm" style="width:210px;" value="<?=$row1['comp_mail']?>" maxlength="30">
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">팩스번호<font color="red"></font></td>
							<td nowrap class="tdrow">
								<input name="comp_fax" id="comp_fax2" type="text" class="textfm" style="width:100px;" value="<?=$row1['comp_fax']?>" maxlength="15"> 예) 055-1234-1234
							</td>
						</tr>
					</table>
					<div style="height:10px;font-size:0px;line-height:0px;"></div>
					<table border=0 cellspacing=0 cellpadding=0> 
						<tr> 
							<td style="background-color:#8db41d" valign="top"> 
								<table border=0 cellpadding=0 cellspacing=0> 
									<tr> 
										<td><img src="images/g_tab_on_lt.gif"></td> 
										<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center;'>근로자</td> 
										<td><img src="images/g_tab_on_rt.gif"></td> 
									</tr> 
								</table> 
							</td> 
							<td width=2></td> 
							<td valign="bottom"></td> 
							<td valign="bottom"></td> 
						</tr> 
					</table>
					<div style="height:2px;font-size:0px" class="bgtr"></div>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<!--검색 -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
						<col width="20%">
						<col width="30%">
						<col width="20%">
						<col width="30%">
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">성명<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="modify_name" type="text" class="textfm" style="width:150px;" value="" maxlength="25" onclick="">
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">주민등록번호<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="modify_ssnb" type="text" class="textfm" style="width:110px;" onkeypress="only_number_hyphen()" value="" maxlength="14"> 예) 123456-1234567
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">변경 후 월평균보수<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="modify_salary" type="text" class="textfm" style="width:150px;ime-mode:inactive;" onkeypress="only_number()" value="" maxlength="25" onkeyup="checkThousand(this.value, this,'Y')">
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">보수 변경 연월<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="modify_date" type="text" class="textfm" style="width:70px;" value="" maxlength="7"> 예) 2014.02
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">보험적용여부<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input type="checkbox" name="misgy" value="1" class="checkbox" checked> 고용
								<input type="checkbox" name="missj" value="1" class="checkbox" checked> 산재
								<input type="checkbox" name="miskm" value="1" class="checkbox" checked> 연금
								<input type="checkbox" name="misgg" value="1" class="checkbox" checked> 건강
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">변경사유<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<select name="modify_reason" class="selectfm" style="">
									<option value="" >선택</option>
									<option value="보수인상" >보수인상</option>
									<option value="보수인하" >보수인하</option>
									<option value="착오정정" >착오정정</option>
								</select>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">비고</td>
							<td nowrap class="tdrow">
								<input name="modify_note" type="text" class="textfm" style="width:250px;ime-mode:active;" value="" maxlength="25">
							</td>
							<td nowrap class="tdrowk"></td>
							<td nowrap class="tdrow">
							</td>
						</tr>
					</table>
					<div style="height:5px;font-size:0px;line-height:0px;"></div>
					<script language="javascript">
					function modify_plus(n){
						var frm = document.dataForm2;
						if(frm.modify_count.value > 20) {
							alert("한번에 신고할 수 있는 인원은 20명까지 입니다.");
							return false;
						} else { 
							document.getElementById('modify_add_div').style.display = "";
							var Tbl = document.getElementById('modify_optable'); 
							tRow = Tbl.insertRow();//tr 추가
							tCell = tRow.insertCell();//td 추가
							tCell.className = "tdrowk"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">성명<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<input name=\"modify_name_[]\" type=\"text\" class=\"textfm\" style=\"width:150px;\" value=\"\" maxlength=\"25\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">주민등록번호<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<input name=\"modify_ssnb_[]\" type=\"text\" class=\"textfm\" style=\"width:110px;\" value=\"\" maxlength=\"14\">";

							tRow = Tbl.insertRow();
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">변경 후 월평균보수<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<input name=\"modify_salary_[]\" type=\"text\" class=\"textfm\" style=\"width:150px;ime-mode:inactive;\" onkeypress=\"only_number()\" value=\"\" maxlength=\"25\" onkeyup=\"checkThousand(this.value, this,'Y')\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">보수 변경 연월<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<input name=\"modify_date_[]\" type=\"text\" class=\"textfm\" style=\"width:70px;\" value=\"\" maxlength=\"7\">";


							tRow = Tbl.insertRow();
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">보험적용여부<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<input type=\"checkbox\" name=\"misgy_"+n+"\" value=\"1\" class=\"checkbox\" checked> 고용 <input type=\"checkbox\" name=\"missj_"+n+"\" value=\"1\" class=\"checkbox\" checked> 산재 <input type=\"checkbox\" name=\"miskm_"+n+"\" value=\"1\" class=\"checkbox\" checked> 연금 <input type=\"checkbox\" name=\"misgg_"+n+"\" value=\"1\" class=\"checkbox\" checked> 건강";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">변경사유<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<select name=\"modify_reason_[]\" class=\"selectfm\" style=\"\"><option value=\"\" >선택</option><option value=\"보수인상\" >보수인상</option><option value=\"보수인하\" >보수인하</option><option value=\"착오정정\" >착오정정</option></select>";


							tRow = Tbl.insertRow();
							tCell = tRow.insertCell();
							tCell.className = "tdrowk_end"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">비고<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow_end"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<input name=\"modify_note_[]\" type=\"text\" class=\"textfm\" style=\"width:250px;ime-mode:active;\" value=\"\" maxlength=\"25\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk_end"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "";
							tCell = tRow.insertCell();
							tCell.className = "tdrow_end"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "";

							frm.modify_count.value++;
							//alert(frm.modify_count.value);
						} 
					}
					</script>
					<div id="modify_add_div" style="display:none">
						<table border=0 cellspacing=0 cellpadding=0> 
							<tr> 
								<td id=""> 
									<table border=0 cellpadding=0 cellspacing=0> 
										<tr> 
											<td><img src="images/g_tab_on_lt.gif"></td> 
											<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
											근로자(추가)
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
					</div>
					<!--검색 -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed" id="modify_optable">
						<col width="10%">
						<col width="10%">
						<col width="20%">
						<col width="10%">
						<col width="10%">
						<col width="10%">
						<col width="20%">
						<col width="10%">
					</table>
	 					<div style="height:5px;font-size:0px;line-height:0px;"></div>
					<table border=0 cellpadding=0 cellspacing=0 style=display:inline;>
						<tr>
							<td width=2></td>
							<td><img src="images/btn_lt.gif"></td>        
							<td background="images/btn_bg.gif" class=ftbutton1 nowrap><label onclick="modify_plus(document.dataForm2.modify_count.value);" style="cursor:pointer">근로자 추가</label></td>
							<td><img src="images/btn_rt.gif"></td>
							<td width=2></td>
							<td>※ 최대 20명까지 신고가 가능합니다.</td>
						</tr>
					</table>
					<div style="height:10px;font-size:0px;line-height:0px;"></div>

					<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:">
						<tr>
							<td align="center">
								<table border=0 cellpadding=0 cellspacing=0 style=display:inline;>
								 <tr>
									 <td width=2></td>
										<td><img src=images/btn_lt.gif></td>
										<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:print();" target="">출력</a></td>
										<td><img src=images/btn_rt.gif></td>
									 <td width=2></td>
									</tr>
								</table>
								<table border=0 cellpadding=0 cellspacing=0 style="display:inline;" id="save_bt2">
									<tr>
										<td width=2></td>
										<td><img src=images/btn_lt.gif></td>
										<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:checkData2();" target="">저장</a></td>
										<td><img src=images/btn_rt.gif></td>
									 <td width=2></td>
									</tr>
								</table>
								<div id="save_ing2" style="display:none"><img src="images/save_ing.gif"></div>
								<table border=0 cellpadding=0 cellspacing=0 style=display:inline;>
								 <tr>
									 <td width=2></td>
										<td><img src=images/btn_lt.gif></td>
										<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:close();" target="">닫기</a></td>
										<td><img src=images/btn_rt.gif></td>
									 <td width=2></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</td>
  </tr>
</table>

<? include "./inc/bottom.php";?>

</div>
<script language="javascript">
<?
if(!$tab) $tab = "tab1";
?>
tab_show('<?=$tab?>');
</script>
</body>
</html>
