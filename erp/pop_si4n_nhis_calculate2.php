<?
include_once("./_common.php");
$html_title = "4대보험절감계산기";
$colspan = 12;
//$total_count = 10;
$total_count = $_GET['cnt'];
//테이블 넓이			기본	절감액 사업장4대보험 산재보험
$pay_list_width = 837 + 74 +   488          + (58*2);
?>
<html>
<head>
<title><?=$html_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
</head>
<body topmargin="0" leftmargin="0">
<div id="loading" style="position:absolute;top:0px;right:0px;left:0px;bottom:0px;background:#000;z-index:100;color:#FFF;padding:20px;">
	잠시만 기다려 주십시오. 페이지 로딩 중입니다.
</div>
<script type="text/javascript" src="js/common.js"></script>
<!--제이쿼리 -->
<script type="text/javascript" src="popup/images/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="popup/images/jquery.maskedinput-1.3.min.js"></script>
<script type="text/javascript">
function getId(id)
{
	return document.getElementById(id);
}
//사업게시일 입력 콤마
function checkcomma(inputVal, type, keydown) {		// inputVal은 천단위에 , 표시를 위해 가져오는 값
	var main = document.dataForm;			// 여기서 type 은 해당하는 값을 넣기 위한 위치지정 index
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
	input = delcomma(inputVal, inputVal.length);
	//관리자 master 입력
	//alert(input);
	if(1 == 1) { // 모두 포함
		//백스페이스키 적용
		if(event.keyCode != 8) {
			//alert(inputVal.length);
			//alert(input);
			if(inputVal.length == 4){
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,4)+".";
			} else if(inputVal.length == 7){
				total += inputVal.substring(0,7)+".";
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
function delcomma(inputVal, count){
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!='.'){		// 먼저 substring을 위해
			tmp += inputVal.substring(i,i+1);	// 값의 모든 , 를 제거
		}
	}
	return tmp;
}
function getInternetVersion(browser) {
	var rv = -1; // Return value assumes failure.     
	var ua = navigator.userAgent; 
	var re = null;
	if(browser=="MSIE") {
	 re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
	 if(re.exec(ua) == null) { // IE11 above (Trident)
		re = new RegExp("rv:([0-9]{1,}[\.0-9]{0,})");
	 }
	}
	else if(browser=="Safari" || browser=="Opera") re = new RegExp("Version/([0-9]{1,}[\.0-9]{0,})");
	else re = new RegExp(browser+"/([0-9]{1,}[\.0-9]{0,})");
	if(re.exec(ua) != null) {
	 rv = parseInt(RegExp.$1);
	}
	return rv; 
}
//브라우저 종류 및 버전확인 
function getBroswserType() {
	var browser = "UnKnown";
	if(navigator.appName.charAt(0) == "N") { // Netscape
	 if(navigator.userAgent.indexOf("Chrome") != -1) browser = "Chrome";
	 else if(navigator.userAgent.indexOf("Firefox") != -1) browser = "Firefox";
	 else if(navigator.userAgent.indexOf("Safari") != -1) browser = "Safari";
	 else if(navigator.userAgent.indexOf("Opera") != -1) browser = "Opera";
	 else if(navigator.userAgent.indexOf("Trident") != -1) browser = "MSIE"; // IE11 above (Trident)
	}
	else if(navigator.appName.charAt(0) == "M") { // Microsoft Internet Explorer
	 browser = "MSIE";
	}
	else if(navigator.appName.indexOf("Opera") != -1) { // Opera
	 browser = "Opera";
	}
	return browser;
}
//좌표 설정
function clientxy(e) {
	var frm = document.dataForm;

	// InternetVersion
 var browser = getBroswserType();
 var ver = getInternetVersion(browser);

	//var browser = navigator.userAgent
	//frm.error_code.value = browser+" "+ver;
	if(browser=="MSIE") {   //브라우저가 IE일때 돌아간다. 크롬에서 써도 잘 된다.
		//alert("현재 좌표는 " + event.x + "/" + event.y);
		x = event.x;
		y = event.y+document.body.scrollTop;
	} else {   //그외(파이어폭스)일 때 돌아간다.
		//alert("현재 좌표는 " + e.clientX + "/" + e.clientY);
		x = e.clientX;
		y = e.clientY;
	}
	//이거는 그냥 덤으로 현재 브라우저의 가운데 좌표 표시
	//alert("가운데 좌표는" + screen.width/2 + "/" + screen.height/2 )
	div_id = document.getElementById('couponHelpDiv');
	div_id.style.display = 'block';
	div_id.style.top = y+"px";
	div_id.style.left = x+"px";
}
//급여유형 변경 (월급제)
//페이지 로딩중 160329
$(document).ready(function(){
	$("#loading").css("display","none");
});

function cal_pay2(idx){
	var f = document.dataForm;
	var money_month,money_hour,money_hour_ts,workhour_day,workhour_ext,workhour_night,workhour_hday,workhour_ext_add,workhour_night_add,workhour_hday_add,workhour_total;
	var week_hday,year_hday,money_base,money_ext,money_night,money_hday,money_ext_add,money_night_add,money_hday_add,money_week,money_year;
	var money2_yun,money2_health,money2_yoyang,money2_goyong;
	var money_total,tax_exemption, money_for_tax,money2_for_tax,money_yun,money_health,money_yoyang,money_goyong,tax_so,tax_jumin,minus,minus2,etc,etc2,money_gongje,money2_gongje,money_result, workhour_year;
	var c_money_yun,c_money_health,c_money_yoyang,c_money_goyong,c_money_sanjae,c_money2_yun,c_money2_health,c_money2_yoyang,c_money2_goyong,c_money2_sanjae;

	tax_exemption   = toInt(f.tax_exemption [idx].value);	//비과세

	money_for_tax   = toInt(f.money_for_tax [idx].value);	//과세소득
	money2_for_tax   = toInt(f.money2_for_tax [idx].value);	//과세소득

	money_yun       = toInt(f.money_yun     [idx].value);	//국민연금     
	money_health    = toInt(f.money_health  [idx].value);	//건강보험     
	money_yoyang    = toInt(f.money_yoyang  [idx].value);	//장기요양보험 
	money_goyong    = toInt(f.money_goyong  [idx].value);	//고용보험

	money2_yun       = toInt(f.money2_yun     [idx].value);	//국민연금     
	money2_health    = toInt(f.money2_health  [idx].value);	//건강보험     
	money2_yoyang    = toInt(f.money2_yoyang  [idx].value);	//장기요양보험 
	money2_goyong    = toInt(f.money2_goyong  [idx].value);	//고용보험

	c_money_yun     = toInt(f.c_money_yun   [idx].value);	//국민연금
	c_money_health  = toInt(f.c_money_health[idx].value);	//건강보험
	c_money_yoyang  = toInt(f.c_money_yoyang[idx].value);	//장기요양보험
	c_money_goyong  = toInt(f.c_money_goyong[idx].value);	//고용보험
	c_money_sanjae  = toInt(f.c_money_sanjae[idx].value);

	c_money2_yun     = toInt(f.c_money2_yun   [idx].value);	//국민연금
	c_money2_health  = toInt(f.c_money2_health[idx].value);	//건강보험
	c_money2_yoyang  = toInt(f.c_money2_yoyang[idx].value);	//장기요양보험
	c_money2_goyong  = toInt(f.c_money2_goyong[idx].value);	//고용보험
	c_money2_sanjae  = toInt(f.c_money2_sanjae[idx].value);

	money_gongje    = toInt(f.money_gongje  [idx].value);	//공제계
	money2_gongje    = toInt(f.money2_gongje  [idx].value);	//공제계
	money_result    = toInt(f.money_result  [idx].value);	//절감금액

	//money_gongje 공제계 = 국민연금+건강보험+장기요양보험+고용보험+사업장
	money_gongje = money_yun+money_health+money_yoyang+money_goyong;
	money_gongje += c_money_yun+c_money_health+c_money_yoyang+c_money_goyong+c_money_sanjae;
	money2_gongje = money2_yun+money2_health+money2_yoyang+money2_goyong;
	money2_gongje += c_money2_yun+c_money2_health+c_money2_yoyang+c_money2_goyong+c_money2_sanjae;

	//money_result 공제후 지급액
	money_result = money_gongje - money2_gongje;
	f.money_gongje[idx].value = number_format(money_gongje); //money_gongje 공제계
	f.money2_gongje[idx].value = number_format(money_gongje); //money_gongje 공제계(변경후)
	f.money_result[idx].value = number_format(money_result); //money_result 절감금액
}
function cal_pay3(idx) {
	cal_pay2(idx); // 공제후 지급액 재계산
}
function focusClickClass(idx) {
	var frm = document.dataForm;
	//alert(f.idx[idx].checked);
	if(frm.idx[idx].checked == true) {
		focusInClass(idx);
	} else {
		focusOutClass(idx);
	}
}
function focusInClass(idx) {
	var frm = document.dataForm;

	frm.tax_exemption[idx].className = "textfm_trans";

	frm.money_for_tax[idx].className = "textfm_trans";
	frm.money2_for_tax[idx].className = "textfm_trans";

	frm.money_yun[idx].className = "textfm_trans";
	frm.money_health[idx].className = "textfm_trans";
	frm.money_yoyang[idx].className = "textfm_trans";
	frm.money_goyong[idx].className = "textfm_trans";

	frm.money2_yun[idx].className = "textfm_trans";
	frm.money2_health[idx].className = "textfm_trans";
	frm.money2_yoyang[idx].className = "textfm_trans";
	frm.money2_goyong[idx].className = "textfm_trans";

	frm.c_money_yun[idx].className = "textfm_trans";
	frm.c_money_health[idx].className = "textfm_trans";
	frm.c_money_yoyang[idx].className = "textfm_trans";
	frm.c_money_goyong[idx].className = "textfm_trans";
	frm.c_money_sanjae[idx].className = "textfm_trans";

	frm.c_money2_yun[idx].className = "textfm_trans";
	frm.c_money2_health[idx].className = "textfm_trans";
	frm.c_money2_yoyang[idx].className = "textfm_trans";
	frm.c_money2_goyong[idx].className = "textfm_trans";
	frm.c_money2_sanjae[idx].className = "textfm_trans";

	frm.money_gongje[idx].className = "textfm_trans";
	frm.money2_gongje[idx].className = "textfm_trans";
	frm.money_result[idx].className = "textfm_trans";
}
function focusOutClass(idx) {
	//alert(idx);
	var frm = document.dataForm;
	if(frm.idx[idx].checked == false) {

		frm.tax_exemption[idx].className = "textfm";

		frm.money_for_tax[idx].className = "textfm";
		frm.money2_for_tax[idx].className = "textfm";

		frm.money_yun[idx].className = "textfm";
		frm.money_health[idx].className = "textfm";
		frm.money_yoyang[idx].className = "textfm";
		frm.money_goyong[idx].className = "textfm";

		frm.money2_yun[idx].className = "textfm";
		frm.money2_health[idx].className = "textfm";
		frm.money2_yoyang[idx].className = "textfm";
		frm.money2_goyong[idx].className = "textfm";

		frm.c_money_yun[idx].className = "textfm";
		frm.c_money_health[idx].className = "textfm";
		frm.c_money_yoyang[idx].className = "textfm";
		frm.c_money_goyong[idx].className = "textfm";
		frm.c_money_sanjae[idx].className = "textfm";

		frm.c_money2_yun[idx].className = "textfm";
		frm.c_money2_health[idx].className = "textfm";
		frm.c_money2_yoyang[idx].className = "textfm";
		frm.c_money2_goyong[idx].className = "textfm";
		frm.c_money2_sanjae[idx].className = "textfm";

		frm.money_gongje[idx].className = "textfm5";
		frm.money2_gongje[idx].className = "textfm5";
		frm.money_result[idx].className = "textfm5";
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
//천단위 콤바
function checkThousand(inputVal, type, keydown) {		// inputVal은 천단위에 , 표시를 위해 가져오는 값
	main = document.dataForm;			// 여기서 type 은 해당하는 값을 넣기 위한 위치지정 index
	var chk		= 0;				// chk 는 천단위로 나눌 길이를 check
	var share	= 0;				// share 200,000 와 같이 3의 배수일 때를 구분하기 위한 변수
	var start	= 0;
	var triple	= 0;				// triple 3, 6, 9 등 3의 배수 
	var end		= 0;				// start, end substring 범위를 위한 변수  
	var total	= "";			
	var input	= "";				// total 임의로 string 들을 규합하기 위한 변수
	//alert(event.keyCode);
	//백스페이스 탭 시프트+탭 좌 우 Del
	if(event.keyCode!=8 && event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=46) {
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
}
//천단위 마이너스 부호 허용
function commify(n, type) {
	var reg = /(^[+-]?\d+)(\d{3})/;
	n += '';  // 숫자를 문자열로 변환
	while (reg.test(n)) n = n.replace(reg, '$1' + ',' + '$2');
	type.value=n;	
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
//급여저장
function goInput(mode){
	var f = document.dataForm;
	for(i=1;i<=<?=$total_count?>;i++) {
		k = i-1;
		f["tax_exemption_"+k].value = f.tax_exemption[i].value;

		f["money_for_tax_"+k].value = f.money_for_tax[i].value;
		f["money2_for_tax_"+k].value = f.money2_for_tax[i].value;

		f["yun_"+k].value = f.money_yun[i].value;
		f["health_"+k].value = f.money_health[i].value;
		f["yoyang_"+k].value = f.money_yoyang[i].value;
		f["goyong_"+k].value = f.money_goyong[i].value;

		f["yun2_"+k].value = f.money2_yun[i].value;
		f["health2_"+k].value = f.money2_health[i].value;
		f["yoyang2_"+k].value = f.money2_yoyang[i].value;
		f["goyong2_"+k].value = f.money2_goyong[i].value;

		f["c_yun_"+k].value = f.c_money_yun[i].value;
		f["c_health_"+k].value = f.c_money_health[i].value;
		f["c_yoyang_"+k].value = f.c_money_yoyang[i].value;
		f["c_goyong_"+k].value = f.c_money_goyong[i].value;
		f["c_sanjae_"+k].value = f.c_money_sanjae[i].value;

		f["c_yun2_"+k].value = f.c_money2_yun[i].value;
		f["c_health2_"+k].value = f.c_money2_health[i].value;
		f["c_yoyang2_"+k].value = f.c_money2_yoyang[i].value;
		f["c_goyong2_"+k].value = f.c_money2_goyong[i].value;
		f["c_sanjae2_"+k].value = f.c_money2_sanjae[i].value;

		f["money_gongje_"+k].value = f.money_gongje[i].value;
		f["money2_gongje_"+k].value = f.money2_gongje[i].value;

		f["money_result_"+k].value = f.money_result[i].value;
	}

	f.mode.value = mode;
	f.action = "pop_si4n_nhis_calculate2_update.php";
	f.submit();
}
//절감금액 입력
function data_input() {
	var sum_money_result_val = $('#sum_money_result').html();
	if(!sum_money_result_val) {
		alert('절감금액 합계로 계산되지 않았습니다.');
		return false;
	}
	opener.document.dataForm.si4n_pay_month.value = sum_money_result_val;
	var sum_money_result_num = ('' + sum_money_result_val).replace(/,/g, "");
	//alert(sum_money_result_num);
	opener.document.dataForm.si4n_pay_year.value = number_format(sum_money_result_num * 12);
	return;
}
//숫자만 입력 ('-' 포함)
function onlyNumber_negative() {
	//alert(event.keyCode);
	if(((event.keyCode<48)||(event.keyCode>57)) && event.keyCode !=13 && event.keyCode !=45) {
		//event.returnValue=false;
		event.preventDefault();
		alert("숫자와 음수만 입력할 수 있습니다.");
	}
}
function onlyNumber_plus(obj) {
	//alert(event.keyCode);
	//+키 입력 시 천단위 입력 000
	if(event.keyCode == 43) {
		var tmp = obj.value;
		obj.value = tmp+"000";
		//event.returnValue = false;
		event.preventDefault();
	}
}
function delStr(inputVal, count, txt) {
	var tmp = "";
	for(i=0; i<count; i++) {
		if(inputVal.substring(i,i+1)!=txt) {
			tmp += inputVal.substring(i,i+1);
		}
	}
	return tmp;
}
//삭제 161107
function del(id) {
	if(id) {
		var f = document.dataForm;
		f.action = "pop_si4n_nhis_calculate2_del.php";
		if(confirm("데이터를 삭제하시겠습니까?")) {
			f.submit();
		}
	}
}
</script>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px">
	<tr>
		<td style="padding:0 20 0 20">
			<!--타이틀 -->
			<table width="100%" border=0 cellspacing=0 cellpadding=0>
				<tr>     
					<td height="18">
						<table width="100%" border=0 cellspacing=0 cellpadding=0>
							<tr>
								<td style='font-size:8pt;color:#929292;'>
									<img src="./images/title_icon.gif" align="absmiddle" style="margin:0 5px 2px 0;"><span style="font-size:9pt;color:black;"><?=$html_title?></span>
								</td>
								<td align=right class=navi></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height=1 bgcolor=e0e0de></td>
				</tr>
				<tr>
					<td height=2 bgcolor=f5f5f5></td>
				</tr>
				<tr>
					<td height=5></td>
				</tr>
			</table>
<?
//산재요율 161021
$sql_opt = " select * from com_list_gy_opt where com_code='$id' ";
$result_opt = sql_query($sql_opt);
$row_opt = mysql_fetch_array($result_opt);
if($row_opt['industrial_disaster_rate']) $industrial_disaster_rate = $row_opt['industrial_disaster_rate'];
else $industrial_disaster_rate = 0.025;
?>
			<!--검색 -->
			<form name="dataForm" method="post">
				<input type="hidden" name="mode">
				<input type="hidden" name="code" value="<?=$id?>">
				<input type="hidden" name="total_count" value="<?=$total_count?>">
				<!--댑메뉴 -->
				<table border=0 cellspacing=0 cellpadding=0> 
					<tr> 
						<td id="Tab_cust_tab_01_0" valign="bottom"> 
							<table border=0 cellpadding=0 cellspacing=0> 
								<tr> 
									<td><img src="./images/g_tab_on_lt.gif"></td> 
									<td background="./images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80px;text-align:center'> 
									<a href="#">급여입력</a>
									</td> 
									<td><img src="./images/g_tab_on_rt.gif"></td> 
								</tr> 
							</table> 
						</td> 
						<td width="6"></td> 
						<td align="right" style="padding-left:20px">사원수 : <?=$total_count?>명 / 산재요율 : <?=$industrial_disaster_rate?></td>
					</tr> 
				</table>
				<div style="height:2px;font-size:0px" class="bgtr"></div>
				<div style="height:2px;font-size:0px;line-height:0px;"></div>

				<!--리스트 -->
				<table width="100%" border="0" cellpadding="0" cellspacing="0" class="bgtable" style="table-layout:fixed;">
					<tr>
						<td width="70" valign="top">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
								<col width="20">
								<col width="">
								<tr>
									<td nowrap height="62" align="center" style="background-color:rgb(226, 226, 226);"></td></td>
									<td nowrap class="tdhead_center">연번</td>
								</tr>
							</table>
						</td>
						<td nowrap class="tdhead_center" valign="top">
							<div id="spanTop" style="width:100%;overflow:hidden">
								<table cellpadding="0" cellspacing="0" border="0">
									<tr>
										<td>  
											<table width="<?=$pay_list_width?>" border="0" cellpadding="0" cellspacing="1" class="bgtable">
												<tr>
													<td class="tdhead_center" colspan="3">급여정보</td>
													<td class="tdhead_center" colspan="20"><input type="checkbox" name="manual_4insure" <?=$check_manual_4insure?> onclick="check_manual(this);" value="1" title="수동입력" style="vertical-align:middle;"> 4대보험</td>
													<td class="tdhead_center" rowspan="3">절감금액</td>
													<td class="tdhead_center" rowspan="3" width="18"></td>
												</tr>
												<tr>
													<td class="tdhead_center" rowspan="2" width="74">(변경전)</td>
													<td class="tdhead_center" rowspan="2" width="74">(절감액)</td>
													<td class="tdhead_center" rowspan="2" width="74">(변경후)</td>
													<td class="tdhead_center" colspan="4">근로자(변경전)</td>
													<td class="tdhead_center" colspan="5">사업장(변경전)</td>
													<td class="tdhead_center" rowspan="2" width="64">합계</td>
													<td class="tdhead_center" colspan="4">근로자(변경후)</td>
													<td class="tdhead_center" colspan="5">사업장(변경후)</td>
													<td class="tdhead_center" rowspan="2" width="64">합계</td>
												</tr>
												<tr>
													<td class="tdhead_center" width="58">국민연금</td>
													<td class="tdhead_center" width="58">건강보험</td>
													<td class="tdhead_center" width="58">장기요양</td>
													<td class="tdhead_center" width="58">고용보험</td>
													<td class="tdhead_center" width="58">국민연금</td>
													<td class="tdhead_center" width="58">건강보험</td>
													<td class="tdhead_center" width="58">장기요양</td>
													<td class="tdhead_center" width="58">고용보험</td>
													<td class="tdhead_center" width="58">산재보험</td>
													<td class="tdhead_center" width="58">국민연금</td>
													<td class="tdhead_center" width="58">건강보험</td>
													<td class="tdhead_center" width="58">장기요양</td>
													<td class="tdhead_center" width="58">고용보험</td>
													<td class="tdhead_center" width="58">국민연금</td>
													<td class="tdhead_center" width="58">건강보험</td>
													<td class="tdhead_center" width="58">장기요양</td>
													<td class="tdhead_center" width="58">고용보험</td>
													<td class="tdhead_center" width="58">산재보험</td>
												</tr>
											</table>
										</td>
										<td nowrap bgcolor=white>&nbsp; &nbsp;&nbsp; &nbsp;</td>
									</tr>
								</table>
							</div>
						</td>
					</tr>
					<tr>
						<td width="200" bgcolor="#ffffff" valign="top">
<?
//$spanMain_height = $total_count * 25 + 1;
$spanMain_height = 250;
?>
							<div id="spanLeft" style="width:200px;height:<?=$spanMain_height?>px;overflow:hidden">
								<div style="display:none;">
									<input type="hidden" name="idx">
									<input type="hidden" name="family_cnt">

									<input type="hidden" name="tax_exemption">

									<input type="hidden" name="money_for_tax">
									<input type="hidden" name="money2_for_tax">

									<input type="hidden" name="money_yun">
									<input type="hidden" name="money_health">
									<input type="hidden" name="money_yoyang">
									<input type="hidden" name="money_goyong">
									<input type="hidden" name="money2_yun">
									<input type="hidden" name="money2_health">
									<input type="hidden" name="money2_yoyang">
									<input type="hidden" name="money2_goyong">

									<input type="hidden" name="c_money_yun">
									<input type="hidden" name="c_money_health">
									<input type="hidden" name="c_money_yoyang">
									<input type="hidden" name="c_money_goyong">
									<input type="hidden" name="c_money_sanjae">
									<input type="hidden" name="c_money2_yun">
									<input type="hidden" name="c_money2_health">
									<input type="hidden" name="c_money2_yoyang">
									<input type="hidden" name="c_money2_goyong">
									<input type="hidden" name="c_money2_sanjae">

									<input type="hidden" name="money_gongje">
									<input type="hidden" name="money2_gongje">
									<input type="hidden" name="money_result">
									<!--추가 필드-->

									<!--4대보험여부-->
									<input type="hidden" name="isgy">
									<input type="hidden" name="issj">
									<input type="hidden" name="iskm">
									<input type="hidden" name="isgg">
									<input type="hidden" name="isjy">

								</div>
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable">
									<col width="10%">
									<col width="">
<?
//연번
for ($i=0; $i<$total_count; $i++) {
	$k = $i + 1;
?>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td nowrap class="ltrow1_center_h24">
											<input type="checkbox" name="idx" value="<?=$k?>" onclick="focusClickClass('<?=$k?>')">
											<input type="hidden" name="sabun_<?=$i?>" value="<?=$k?>" />
										</td>
										<td nowrap class="ltrow1_left_h24" style="padding-left:20px;"><?=$k?></td>
									</tr>
<?
}
if ($i == 0)
		echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='2' nowrap class=\"ltrow1_center_h22\"></td></tr>";
?>

								</table>
								<br />
							</div>
						</td>
						<td bgcolor="#ffffff" valign="top">
							<div id="spanMain" style="width:100%;height:<?=$spanMain_height?>px;overflow-x:hidden;overflow-y:auto;" onScroll="spanLeft.scrollTop = this.scrollTop; spanTop.scrollLeft = this.scrollLeft;">
								<table width="<?=$pay_list_width?>" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
<?
//금여정보
for ($i=0; $i<$total_count; $i++) {
	$k = $i + 1;
	$isgy_chk = "checked";
	$issj_chk = "checked";
	$iskm_chk = "checked";
	$isgg_chk = "checked";
	$isjy_chk = "checked";
	//if($row['sabun']) $sabun = $row['sabun'];
	//else $sabun = $k;
	//4대보험절감 급여DB
	$sql = " select * from si4n_nhis_pay where com_code='$id' and sabun='$k' ";
	$result = sql_query($sql);
	$row = mysql_fetch_array($result);
	if($row['family_cnt']) $family_cnt = $row['family_cnt'];
	else $family_cnt = 1;

	$money_yun = $row['yun'];
	$money_health = $row['health'];
	$money_yoyang = $row['yoyang'];
	$money_goyong = $row['goyong'];
	$money2_yun = $row['yun2'];
	$money2_health = $row['health2'];
	$money2_yoyang = $row['yoyang2'];
	$money2_goyong = $row['goyong2'];
?>
									<tr class="list_row_now_gr" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_gr';">
										<input type="hidden" name="family_cnt" value="<?=$family_cnt?>" />

										<!--공제내역-->
										<input type="hidden" name="yun_<?=$i?>">
										<input type="hidden" name="health_<?=$i?>">
										<input type="hidden" name="yoyang_<?=$i?>">
										<input type="hidden" name="goyong_<?=$i?>">

										<input type="hidden" name="yun2_<?=$i?>">
										<input type="hidden" name="health2_<?=$i?>">
										<input type="hidden" name="yoyang2_<?=$i?>">
										<input type="hidden" name="goyong2_<?=$i?>">

										<input type="hidden" name="c_yun_<?=$i?>">
										<input type="hidden" name="c_health_<?=$i?>">
										<input type="hidden" name="c_yoyang_<?=$i?>">
										<input type="hidden" name="c_goyong_<?=$i?>">
										<input type="hidden" name="c_sanjae_<?=$i?>">

										<input type="hidden" name="c_yun2_<?=$i?>">
										<input type="hidden" name="c_health2_<?=$i?>">
										<input type="hidden" name="c_yoyang2_<?=$i?>">
										<input type="hidden" name="c_goyong2_<?=$i?>">
										<input type="hidden" name="c_sanjae2_<?=$i?>">

										<input type="hidden" name="tax_exemption_<?=$i?>" />

										<input type="hidden" name="money_for_tax_<?=$i?>">
										<input type="hidden" name="money2_for_tax_<?=$i?>">
										<input type="hidden" name="money_gongje_<?=$i?>">
										<input type="hidden" name="money2_gongje_<?=$i?>">
										<input type="hidden" name="money_result_<?=$i?>">
										<!--4대보험여부-->
										<input type="hidden" name="isgy" value="<?=$isgy_chk?>">
										<input type="hidden" name="issj" value="<?=$issj_chk?>">
										<input type="hidden" name="iskm" value="<?=$iskm_chk?>">
										<input type="hidden" name="isgg" value="<?=$isgg_chk?>">
										<input type="hidden" name="isjy" value="<?=$isjy_chk?>">

										<!--기준시급(시급제) 필드-->
<?
	if($k < $total_count) {
		$k_next = $k+1;
	}
?>
										<td nowrap class="ltrow1_center_h24" width="74"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber_plus(this);" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_for_tax"  id="id_money_for_tax_<?=$k?>"  value="<?if($row['money_for_tax']) echo number_format($row['money_for_tax'])?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_for_tax_<?=$k_next?>').select(); }" /></td><!-- 과세소득 -->
										<td nowrap class="ltrow1_center_h24" width="74"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber_plus(this);" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="tax_exemption"  id="id_tax_exemption_<?=$k?>"  value="<?if($row['tax_exemption']) echo number_format($row['tax_exemption'])?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_tax_exemption_<?=$k_next?>').select(); }" /></td><!-- 비과세 -->

										<td nowrap class="ltrow1_center_h24" width="74"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money2_for_tax" id="id_money2_for_tax_<?=$k?>" value="<?=number_format($row['money2_for_tax'])?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money2_for_tax_<?=$k_next?>').select(); }" /></td><!-- 과세소득 -->

										<td nowrap class="ltrow1_center_h24" width="58"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_yun" id="id_money_yun_<?=$k?>" value="<?=number_format($money_yun)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_yun_<?=$k_next?>').select(); }" /></td><!-- 국민연금 -->
										<td nowrap class="ltrow1_center_h24" width="58"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_health" id="id_money_health_<?=$k?>" value="<?=number_format($money_health)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_health_<?=$k_next?>').select(); }" /></td><!-- 건강보험 -->
										<td nowrap class="ltrow1_center_h24" width="58"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_yoyang" id="id_money_yoyang_<?=$k?>" value="<?=number_format($money_yoyang)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_yoyang_<?=$k_next?>').select(); }" /></td><!-- 장기요양보험 -->
										<td nowrap class="ltrow1_center_h24" width="58"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_goyong" id="id_money_goyong_<?=$k?>" value="<?=number_format($money_goyong)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_goyong_<?=$k_next?>').select(); }" /></td><!-- 고용보험 -->

										<td nowrap class="ltrow1_center_h24" width="58"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber_negative();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="c_money_yun" id="id_c_money_yun_<?=$k?>" value="<?=number_format($row['c_yun'])?>" onkeyup="checkThousand_negative(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_c_money_yun_<?=$k_next?>').focus(); }" /></td><!--국민연금-->
										<td nowrap class="ltrow1_center_h24" width="58"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber_negative();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="c_money_health" id="id_c_money_health_<?=$k?>" value="<?=number_format($row['c_health'])?>" onkeyup="checkThousand_negative(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_c_money_health_<?=$k_next?>').focus(); }" /></td><!--건강보험-->
										<td nowrap class="ltrow1_center_h24" width="58"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber_negative();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="c_money_yoyang" id="id_c_money_yoyang_<?=$k?>" value="<?=number_format($row['c_yoyang'])?>" onkeyup="checkThousand_negative(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_c_money_yoyang_<?=$k_next?>').focus(); }" /></td><!--장기요양보험-->
										<td nowrap class="ltrow1_center_h24" width="58"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber_negative();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="c_money_goyong" id="id_c_money_goyong_<?=$k?>" value="<?=number_format($row['c_goyong'])?>" onkeyup="checkThousand_negative(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_c_money_goyong_<?=$k_next?>').focus(); }" /></td><!--고용보험-->
										<td nowrap class="ltrow1_center_h24" width="58"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber_negative();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="c_money_sanjae" id="id_c_money_sanjae_<?=$k?>" value="<?=number_format($row['c_sanjae'])?>" onkeyup="checkThousand_negative(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_c_money_sanjae_<?=$k_next?>').focus(); }" /></td>

										<td nowrap class="ltrow1_center_h24" width="64"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_gongje" value="<?=number_format($row['money_gongje'])?>"></td><!-- 공제계 -->

										<td nowrap class="ltrow1_center_h24" width="58"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money2_yun" id="id_money2_yun_<?=$k?>" value="<?=number_format($money2_yun)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money2_yun_<?=$k_next?>').select(); }" /></td><!-- 국민연금 -->
										<td nowrap class="ltrow1_center_h24" width="58"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money2_health" id="id_money2_health_<?=$k?>" value="<?=number_format($money2_health)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money2_health_<?=$k_next?>').select(); }" /></td><!-- 건강보험 -->
										<td nowrap class="ltrow1_center_h24" width="58"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money2_yoyang" id="id_money2_yoyang_<?=$k?>" value="<?=number_format($money2_yoyang)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money2_yoyang_<?=$k_next?>').select(); }" /></td><!-- 장기요양보험 -->
										<td nowrap class="ltrow1_center_h24" width="58"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money2_goyong" id="id_money2_goyong_<?=$k?>" value="<?=number_format($money2_goyong)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money2_goyong_<?=$k_next?>').select(); }" /></td><!-- 고용보험 -->

										<td nowrap class="ltrow1_center_h24" width="58"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber_negative();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="c_money2_yun" id="id_c_money2_yun_<?=$k?>" value="<?=number_format($row['c_yun2'])?>" onkeyup="checkThousand_negative(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_c_money2_yun_<?=$k_next?>').focus(); }" /></td><!--국민연금-->
										<td nowrap class="ltrow1_center_h24" width="58"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber_negative();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="c_money2_health" id="id_c_money2_health_<?=$k?>" value="<?=number_format($row['c_health2'])?>" onkeyup="checkThousand_negative(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_c_money2_health_<?=$k_next?>').focus(); }" /></td><!--건강보험-->
										<td nowrap class="ltrow1_center_h24" width="58"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber_negative();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="c_money2_yoyang" id="id_c_money2_yoyang_<?=$k?>" value="<?=number_format($row['c_yoyang2'])?>" onkeyup="checkThousand_negative(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_c_money2_yoyang_<?=$k_next?>').focus(); }" /></td><!--장기요양보험-->
										<td nowrap class="ltrow1_center_h24" width="58"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber_negative();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="c_money2_goyong" id="id_c_money2_goyong_<?=$k?>" value="<?=number_format($row['c_goyong2'])?>" onkeyup="checkThousand_negative(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_c_money2_goyong_<?=$k_next?>').focus(); }" /></td><!--고용보험-->
										<td nowrap class="ltrow1_center_h24" width="58"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber_negative();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="c_money2_sanjae" id="id_c_money2_sanjae_<?=$k?>" value="<?=number_format($row['c_sanjae2'])?>" onkeyup="checkThousand_negative(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_c_money2_sanjae_<?=$k_next?>').focus(); }" /></td>

										<td nowrap class="ltrow1_center_h24" width="64"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money2_gongje" value="<?=number_format($row['money2_gongje'])?>"></td><!-- 공제계 -->

										<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_result" value="<?=number_format($row['money_result'])?>"></td><!-- 절감금액 -->
										<td nowrap class="ltrow1_center_h24" width="18"></td>
									</tr>
<?
}
if ($i == 0) {
	echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
}
if ($i == 1) {
	echo "<input type='checkbox' name='idx' value='' style='display:none'>";
}
?>
								</div>
							</table>
						</td>
					</tr>
				</table>

				<table width="100%" border="0" cellpadding="0" cellspacing="0" class="bgtable">
					<tr>
						<td width="70" valign="top">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable">
								<tr>
									<td nowrap height="25" align="center" style="background-color:rgb(226, 226, 226);">합계</td>
								</tr>
							</table>
						</td>
						<td nowrap class="tdhead_center" valign="top">
							<table width="<?=$pay_list_width?>" border="0" cellpadding="0" cellspacing="1" class="bgtable">
								<tr class="list_row_now_wh">
									<td nowrap class="ltrow1_center_h24" width="74"><span id="sum_money_for_tax"><?=number_format($row['sum_money_for_tax'])?></span></td>
									<td nowrap class="ltrow1_center_h24" width="74"><span id="sum_tax_exemption"><?=number_format($row['sum_tax_exemption'])?></span></td>

									<td nowrap class="ltrow1_center_h24" width="74"><span id="sum_money2_for_tax"><?=number_format($row['sum_money2_for_tax'])?></span></td>

									<td nowrap class="ltrow1_center_h24" width="58"><span id="sum_money_yun"><?=number_format($sum_money_yun)?></span></td><!-- 국민연금 -->
									<td nowrap class="ltrow1_center_h24" width="58"><span id="sum_money_health"><?=number_format($sum_money_health)?></span></td><!-- 건강보험 -->
									<td nowrap class="ltrow1_center_h24" width="58"><span id="sum_money_yoyang"><?=number_format($sum_money_yoyang)?></span></td><!-- 장기요양보험 -->
									<td nowrap class="ltrow1_center_h24" width="58"><span id="sum_money_goyong"><?=number_format($sum_money_goyong)?></span></td><!-- 고용보험 -->
									<td nowrap class="ltrow1_center_h24" width="58"><span id="sum_c_money_yun"><?=number_format($sum_c_money_yun)?></span></td><!-- 국민연금 -->
									<td nowrap class="ltrow1_center_h24" width="58"><span id="sum_c_money_health"><?=number_format($sum_c_money_health)?></span></td><!-- 건강보험 -->
									<td nowrap class="ltrow1_center_h24" width="58"><span id="sum_c_money_yoyang"><?=number_format($sum_c_money_yoyang)?></span></td><!-- 장기요양보험 -->
									<td nowrap class="ltrow1_center_h24" width="58"><span id="sum_c_money_goyong"><?=number_format($sum_c_money_goyong)?></span></td><!-- 고용보험 -->
									<td nowrap class="ltrow1_center_h24" width="58"><span id="sum_c_money_sanjae"><?=number_format($sum_c_money_sanjae)?></span></td>
									<td nowrap class="ltrow1_center_h24" width="64"><span id="sum_money_gongje"><?=number_format($row['sum_money_gongje'])?></span></td><!-- 공제계 -->

									<td nowrap class="ltrow1_center_h24" width="58"><span id="sum_money2_yun"><?=number_format($sum_money2_yun)?></span></td><!-- 국민연금 -->
									<td nowrap class="ltrow1_center_h24" width="58"><span id="sum_money2_health"><?=number_format($sum_money2_health)?></span></td><!-- 건강보험 -->
									<td nowrap class="ltrow1_center_h24" width="58"><span id="sum_money2_yoyang"><?=number_format($sum_money2_yoyang)?></span></td><!-- 장기요양보험 -->
									<td nowrap class="ltrow1_center_h24" width="58"><span id="sum_money2_goyong"><?=number_format($sum_money2_goyong)?></span></td><!-- 고용보험 -->
									<td nowrap class="ltrow1_center_h24" width="58"><span id="sum_c_money2_yun"><?=number_format($sum_c_money2_yun)?></span></td><!-- 국민연금 -->
									<td nowrap class="ltrow1_center_h24" width="58"><span id="sum_c_money2_health"><?=number_format($sum_c_money2_health)?></span></td><!-- 건강보험 -->
									<td nowrap class="ltrow1_center_h24" width="58"><span id="sum_c_money2_yoyang"><?=number_format($sum_c_money2_yoyang)?></span></td><!-- 장기요양보험 -->
									<td nowrap class="ltrow1_center_h24" width="58"><span id="sum_c_money2_goyong"><?=number_format($sum_c_money2_goyong)?></span></td><!-- 고용보험 -->
									<td nowrap class="ltrow1_center_h24" width="58"><span id="sum_c_money2_sanjae"><?=number_format($sum_c_money2_sanjae)?></span></td>
									<td nowrap class="ltrow1_center_h24" width="64"><span id="sum_money2_gongje"><?=number_format($row['sum_money2_gongje'])?></span></td><!-- 공제계 -->

									<td nowrap class="ltrow1_center_h24"><span id="sum_money_result"><?=number_format($row['sum_money_result'])?></span></td><!-- 절감금액 -->
									<td nowrap class="ltrow1_center_h24" width="18"></td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
			</table>
			<!--리스트 -->
			<input type="hidden" name="total_cnt" value="<?=$k?>">
			<input type="hidden" name="error_code" style="width:100%" value="code">
		</form>

			<div style="height:10px"></div>
			<!--리스트 -->
			<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
				<tr>
					<td align="center">
						<table border="0" cellpadding="0" cellspacing="0" style="display:inline;margin-right:20px;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="javascript:cal_pay_bt();" target="">계 산</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
						<table border="0" cellpadding="0" cellspacing="0" style="display:inline;margin-right:20px;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="javascript:goInput('input');" target="">저 장</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
						<table border="0" cellpadding="0" cellspacing="0" style="display:inline;margin-right:20px;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="javascript:data_input();" target="">입 력</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
						<table border="0" cellpadding="0" cellspacing="0" style="display:inline;margin-right:20px;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="pop_si4n_nhis_excel2.php?id=<?=$id?>">엑 셀</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
						<table border="0" cellpadding="0" cellspacing="0" style="display:inline;margin-right:20px;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="pop_si4n_nhis_excel2_result.php?id=<?=$id?>">절감결과</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
						<table border="0" cellpadding="0" cellspacing="0" style="display:inline;margin-right:20px;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="javascript:del(<?=$id?>);" target="">삭 제</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<script language="javascript">
//자동 계산 버튼 함수 / Confirm 확인창 추가 160121
function cal_pay_bt() {
	if(confirm("입력한 내용으로 급여계산 하겠습니까?")) {
<?
for($i=1;$i<=$k;$i++) {
?>
		cal_pay('<?=$i?>');
<?
}
?>
		cal_pay_sum();
	} else {
		return;
	}
}
function cal_pay_sum() {
	var f = document.dataForm;
	var sum_money_time = sum_time = 0;
	var sum_tax_exemption = sum_money_for_tax = sum_money2_for_tax = 0;
	var sum_money_yun = sum_money_health = sum_money_yoyang = sum_money_goyong = 0;
	var sum_money2_yun = sum_money2_health = sum_money2_yoyang = sum_money2_goyong = 0;
	var sum_c_money_yun = sum_c_money_health = sum_c_money_yoyang = sum_c_money_goyong = sum_c_money_sanjae = 0;
	var sum_c_money2_yun = sum_c_money2_health = sum_c_money2_yoyang = sum_c_money2_goyong = sum_c_money2_sanjae = 0;
	var sum_money_gongje = sum_money2_gongje = sum_money_result = 0;
<?
for($i=1;$i<=$k;$i++) {
?>
	//합계 선언
	money_yun = toInt(f.money_yun[<?=$i?>].value);
	money_health = toInt(f.money_health[<?=$i?>].value);
	money_yoyang = toInt(f.money_yoyang[<?=$i?>].value);
	money_goyong = toInt(f.money_goyong[<?=$i?>].value);

	money2_yun = toInt(f.money2_yun[<?=$i?>].value);
	money2_health = toInt(f.money2_health[<?=$i?>].value);
	money2_yoyang = toInt(f.money2_yoyang[<?=$i?>].value);
	money2_goyong = toInt(f.money2_goyong[<?=$i?>].value);

	c_money_yun = toInt(f.c_money_yun[<?=$i?>].value);
	c_money_health = toInt(f.c_money_health[<?=$i?>].value);
	c_money_yoyang = toInt(f.c_money_yoyang[<?=$i?>].value);
	c_money_goyong = toInt(f.c_money_goyong[<?=$i?>].value);
	c_money_sanjae = toInt(f.c_money_sanjae[<?=$i?>].value);

	c_money2_yun = toInt(f.c_money2_yun[<?=$i?>].value);
	c_money2_health = toInt(f.c_money2_health[<?=$i?>].value);
	c_money2_yoyang = toInt(f.c_money2_yoyang[<?=$i?>].value);
	c_money2_goyong = toInt(f.c_money2_goyong[<?=$i?>].value);
	c_money2_sanjae = toInt(f.c_money2_sanjae[<?=$i?>].value);

	money_gongje = toInt(f.money_gongje[<?=$i?>].value);
	money2_gongje = toInt(f.money2_gongje[<?=$i?>].value);

	tax_exemption = toInt(f.tax_exemption[<?=$i?>].value);

	money_for_tax = toInt(f.money_for_tax[<?=$i?>].value);
	money2_for_tax = toInt(f.money2_for_tax[<?=$i?>].value);
	money_result = toInt(f.money_result[<?=$i?>].value);

	//합계 계산
	sum_money_yun += money_yun;
	sum_money_health += money_health;
	sum_money_yoyang += money_yoyang;
	sum_money_goyong += money_goyong;

	sum_money2_yun += money2_yun;
	sum_money2_health += money2_health;
	sum_money2_yoyang += money2_yoyang;
	sum_money2_goyong += money2_goyong;

	sum_c_money_yun += c_money_yun;
	sum_c_money_health += c_money_health;
	sum_c_money_yoyang += c_money_yoyang;
	sum_c_money_goyong += c_money_goyong;
	sum_c_money_sanjae += c_money_sanjae;

	sum_c_money2_yun += c_money2_yun;
	sum_c_money2_health += c_money2_health;
	sum_c_money2_yoyang += c_money2_yoyang;
	sum_c_money2_goyong += c_money2_goyong;
	sum_c_money2_sanjae += c_money2_sanjae;

	sum_money_gongje += money_gongje;
	sum_money2_gongje += money2_gongje;

	sum_tax_exemption += tax_exemption;

	sum_money_for_tax += money_for_tax;
	sum_money2_for_tax += money2_for_tax;
	sum_money_result += money_result;
<?
}
?>
	//합계 표시
	$('#sum_money_yun').html(number_format(sum_money_yun));
	$('#sum_money_health').html(number_format(sum_money_health));
	$('#sum_money_yoyang').html(number_format(sum_money_yoyang));
	$('#sum_money_goyong').html(number_format(sum_money_goyong));

	$('#sum_money2_yun').html(number_format(sum_money2_yun));
	$('#sum_money2_health').html(number_format(sum_money2_health));
	$('#sum_money2_yoyang').html(number_format(sum_money2_yoyang));
	$('#sum_money2_goyong').html(number_format(sum_money2_goyong));

	$('#sum_c_money_yun').html(number_format(sum_c_money_yun));
	$('#sum_c_money_health').html(number_format(sum_c_money_health));
	$('#sum_c_money_yoyang').html(number_format(sum_c_money_yoyang));
	$('#sum_c_money_goyong').html(number_format(sum_c_money_goyong));
	$('#sum_c_money_sanjae').html(number_format(sum_c_money_sanjae));

	$('#sum_c_money2_yun').html(number_format(sum_c_money2_yun));
	$('#sum_c_money2_health').html(number_format(sum_c_money2_health));
	$('#sum_c_money2_yoyang').html(number_format(sum_c_money2_yoyang));
	$('#sum_c_money2_goyong').html(number_format(sum_c_money2_goyong));
	$('#sum_c_money2_sanjae').html(number_format(sum_c_money2_sanjae));

	$('#sum_money_gongje').html(number_format(sum_money_gongje));
	$('#sum_money2_gongje').html(number_format(sum_money2_gongje));

	$('#sum_tax_exemption').html(number_format(sum_tax_exemption));

	$('#sum_money_for_tax').html(number_format(sum_money_for_tax));
	$('#sum_money2_for_tax').html(number_format(sum_money2_for_tax));
	$('#sum_money_result').html(number_format(sum_money_result));
}
<?
//로딩 시 실행
if($id) {
	echo "addLoadEvent(cal_pay_sum);";
}
?>
function cal_pay(idx) {
	var f = document.dataForm;
	var pay_gbn,money_day;
	var money_month,money_hour,money_hour_ds,money_hour_ts,workhour_day,workhour_ext,workhour_night,workhour_hday,workhour_ext_add,workhour_night_add,workhour_hday_add,workhour_total;
	var workhour_late,workhour_leave,workhour_out,workhour_absence,money_hour_ms;
	var week_hday,year_hday,money_base,money_time,money_ext,money_night,money_hday,money_ext_add,money_night_add,money_hday_add,money_week,money_year;
	var money2_yun,money2_health,money2_yoyang,money2_goyong,money_time,time;
	var money_total,tax_exemption,money_for_tax,money2_for_tax,money_yun,money_health,money_yoyang,money_goyong,tax_so,tax_jumin,etc,etc2,money_gongje,money2_gongje,money_result,workhour_year;
	var c_money_yun,c_money_health,c_money_yoyang,c_money_goyong,c_money_sanjae,c_money2_yun,c_money2_health,c_money2_yoyang,c_money2_goyong,c_money2_sanjae;

	tax_exemption   = toInt(f.tax_exemption [idx].value);	//비과세

	money_for_tax   = toInt(f.money_for_tax [idx].value);	//과세소득
	money2_for_tax   = toInt(f.money2_for_tax [idx].value);	//과세소득

	money_yun       = toInt(f.money_yun     [idx].value);	//국민연금     
	money_health    = toInt(f.money_health  [idx].value);	//건강보험     
	money_yoyang    = toInt(f.money_yoyang  [idx].value);	//장기요양보험 
	money_goyong    = toInt(f.money_goyong  [idx].value);	//고용보험     

	money2_yun       = toInt(f.money2_yun     [idx].value);	//국민연금     
	money2_health    = toInt(f.money2_health  [idx].value);	//건강보험     
	money2_yoyang    = toInt(f.money2_yoyang  [idx].value);	//장기요양보험 
	money2_goyong    = toInt(f.money2_goyong  [idx].value);	//고용보험

	c_money_yun    = toInt(f.c_money_yun   [idx].value);	//국민연금
	c_money_health = toInt(f.c_money_health[idx].value);	//건강보험     
	c_money_yoyang = toInt(f.c_money_yoyang[idx].value);	//장기요양보험 
	c_money_goyong = toInt(f.c_money_goyong[idx].value);	//고용보험
	c_money_sanjae = toInt(f.c_money_sanjae[idx].value);

	c_money2_yun    = toInt(f.c_money2_yun   [idx].value);	//국민연금
	c_money2_health = toInt(f.c_money2_health[idx].value);	//건강보험     
	c_money2_yoyang = toInt(f.c_money2_yoyang[idx].value);	//장기요양보험 
	c_money2_goyong = toInt(f.c_money2_goyong[idx].value);	//고용보험
	c_money2_sanjae = toInt(f.c_money2_sanjae[idx].value);

	money_gongje    = toInt(f.money_gongje  [idx].value);	//공제계       
	money2_gongje    = toInt(f.money2_gongje  [idx].value);	//공제계

	k = idx-1;

	//비과세 적용 금액 161017
	if(money_time) money2_for_tax = money_time * time;
	else money2_for_tax = money_for_tax - tax_exemption;

	//4대보험 수동입력 유무
	if(!f.manual_4insure.checked) {
		money_yun = get_round( parseInt(money_for_tax) * 0.045 );
		money_health = get_round( parseInt(money_for_tax) * 0.0306 );
		money_yoyang = get_round( money_health* 0.0655  );
		money_goyong = get_round( parseInt(money_for_tax) * 0.0065 );
		//변경후
		money2_yun = get_round( parseInt(money2_for_tax) * 0.045 );
		money2_health = get_round( parseInt(money2_for_tax) * 0.0306 );
		money2_yoyang = get_round( money2_health* 0.0655  );
		money2_goyong = get_round( parseInt(money2_for_tax) * 0.0065 );
		//사업장 4대보험
		c_money_yun = get_round( parseInt(money_for_tax) * 0.045 );
		c_money_health = get_round( parseInt(money_for_tax) * 0.0306 );
		c_money_yoyang = get_round( c_money_health* 0.0655  );
		c_money_goyong = get_round( parseInt(money_for_tax) * 0.0090 );
		c_money_sanjae = get_round( parseInt(money_for_tax) * <?=$industrial_disaster_rate?> );
		//변경후
		c_money2_yun = get_round( parseInt(money2_for_tax) * 0.045 );
		c_money2_health = get_round( parseInt(money2_for_tax) * 0.0306 );
		c_money2_yoyang = get_round( c_money2_health* 0.0655  );
		c_money2_goyong = get_round( parseInt(money2_for_tax) * 0.0090 );
		c_money2_sanjae = get_round( parseInt(money2_for_tax) * <?=$industrial_disaster_rate?> );
	}
<?
	echo "	money_gongje = money_yun+money_health+money_yoyang+money_goyong;";
	echo "	money_gongje += c_money_yun+c_money_health+c_money_yoyang+c_money_goyong+c_money_sanjae;";
	echo "	money2_gongje = money2_yun+money2_health+money2_yoyang+money2_goyong;";
	echo "	money2_gongje += c_money2_yun+c_money2_health+c_money2_yoyang+c_money2_goyong+c_money2_sanjae;";
?>
	//공제계 반올림
	money_gongje = money_gongje.toFixed(0);
	money2_gongje = money2_gongje.toFixed(0);
	money_result = money_gongje - money2_gongje;

	//천단위 구분
	money_yun = number_format(money_yun);
	money_health = number_format(money_health);
	money_yoyang = number_format(money_yoyang);
	money_goyong = number_format(money_goyong);
	money2_yun = number_format(money2_yun);
	money2_health = number_format(money2_health);
	money2_yoyang = number_format(money2_yoyang);
	money2_goyong = number_format(money2_goyong);

	c_money_yun = number_format(c_money_yun);
	c_money_health = number_format(c_money_health);
	c_money_yoyang = number_format(c_money_yoyang);
	c_money_goyong = number_format(c_money_goyong);
	c_money_sanjae = number_format(c_money_sanjae);
	c_money2_yun = number_format(c_money2_yun);
	c_money2_health = number_format(c_money2_health);
	c_money2_yoyang = number_format(c_money2_yoyang);
	c_money2_goyong = number_format(c_money2_goyong);
	c_money2_sanjae = number_format(c_money2_sanjae);

	money_gongje = number_format(money_gongje);
	money2_gongje = number_format(money2_gongje);
	money_result = number_format(money_result);

	money2_for_tax = number_format(money2_for_tax);

	//과세소득(변경후) 161017
	f.money2_for_tax[idx].value = money2_for_tax;

	//변수 input 입력
	f.money_yun[idx].value = money_yun //money_yun 국민연금
	f.money_health[idx].value = money_health //money_health 건강보험 
	f.money_yoyang[idx].value = money_yoyang //money_yoyang 장기요양보험 
	f.money_goyong[idx].value = money_goyong //money_goyong 고용보험
	f.money2_yun[idx].value = money2_yun //money2_yun 국민연금
	f.money2_health[idx].value = money2_health //money2_health 건강보험
	f.money2_yoyang[idx].value = money2_yoyang //money2_yoyang 장기요양보험 
	f.money2_goyong[idx].value = money2_goyong //money2_goyong 고용보험

	f.c_money_yun[idx].value = c_money_yun;
	f.c_money_health[idx].value = c_money_health;
	f.c_money_yoyang[idx].value = c_money_yoyang;
	f.c_money_goyong[idx].value = c_money_goyong;
	f.c_money_sanjae[idx].value = c_money_sanjae;
	f.c_money2_yun[idx].value = c_money2_yun;
	f.c_money2_health[idx].value = c_money2_health;
	f.c_money2_yoyang[idx].value = c_money2_yoyang;
	f.c_money2_goyong[idx].value = c_money2_goyong;
	f.c_money2_sanjae[idx].value = c_money2_sanjae;

	f.money_gongje[idx].value = money_gongje //money_gongje 공제계 
	f.money2_gongje[idx].value = money2_gongje //money_gongje 공제계 
	f.money_result[idx].value = money_result //money_result 절감금액
}
</script>

</body>
</html>
