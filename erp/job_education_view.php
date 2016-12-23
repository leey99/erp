<?
$sub_menu = "1700100";
include_once("./_common.php");

$sql_common = " from com_list_gy a, job_education b, com_list_gy_opt c ";

//echo $member[mb_profile];
if($is_admin != "super") {
	$stx_man_cust_name = $member[mb_profile];
}
$is_admin = "super";
//echo $is_admin;
$sql_search = " where a.com_code=b.com_code and a.com_code=c.com_code and b.idx='$id' ";

if (!$sst) {
    $sst = "b.idx";
    $sod = "desc";
}

$sql_order = " order by $sst $sod ";

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

$top_sub_title = "images/top17_01.gif";
$sub_title = "사업주훈련관리";
$g4[title] = $sub_title." : 사업주훈련 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
//echo $sql;
$result = sql_query($sql);
//echo $row[id];

$colspan = 11;

if($w == "u") {
	$row=mysql_fetch_array($result);
	$com_code = $row['com_code'];
}
//echo $row[id];
//검색 파라미터 전송
$qstr = "stx_comp_name=".$stx_comp_name."&stx_uptae=".$stx_uptae."&stx_boss_name=".$stx_boss_name."&stx_t_no=".$stx_t_no."&stx_comp_tel=".$stx_comp_tel."&stx_comp_juso=".$stx_comp_juso;
$qstr .= "&stx_man_cust_name=".$stx_man_cust_name."&stx_train_kind=".$stx_train_kind;
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
function checkAddress(strgbn)
{
	//var ret = window.open("./common/member_address.php?frm_name=dataForm&frm_zip1=adr_zip1&frm_zip2=adr_zip2&frm_addr1=adr_adr1&frm_addr2=adr_adr2", "address", "top=100, left=100, width=410,height=285, scrollbars");
	var ret = window.open("../road_address/search.php", "address", "width=496,height=522,scrollbars=0");
	return;
}
function id_copy() {
	var frm = document.dataForm;
	frm.user_id.value = frm.comp_bznb.value;
}
function checkData() {
	var frm = document.dataForm;
	var rv = 0;
	if (frm.comp_bznb.value == "") {
		alert("사업자등록번호를 입력하세요.");
		frm.comp_bznb.focus();
		return;
	}
	if (frm.com_name.value == "")
	{
		alert("사업장명을 입력하세요.");
		frm.com_name.focus();
		return;
	}
	if (frm.t_insureno.value == "")
	{
		alert("사업장관리번호를 입력하세요.");
		frm.t_insureno.focus();
		return;
	}
	if (frm.boss_name.value == "")
	{
		alert("대표자명을 입력하세요.");
		frm.boss_name.focus();
		return;
	}
	if (frm.uptae.value == "")
	{
		alert("업태를 입력하세요.");
		frm.uptae.focus();
		return;
	}
	if (frm.com_tel1.value == "")
	{
		alert("전화번호를 입력하세요.");
		frm.com_tel1.focus();
		return;
	}
	if (frm.com_tel2.value == "")
	{
		alert("전화번호를 입력하세요.");
		frm.com_tel2.focus();
		return;
	}
	if (frm.com_tel3.value == "")
	{
		alert("전화번호를 입력하세요.");
		frm.com_tel3.focus();
		return;
	}
	if (frm.adr_zip1.value == "") {
		alert("주소를 입력하세요.");
		return;
	}
	frm.action = "job_education_update.php";
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
function only_number() {
	if (event.keyCode < 48 || event.keyCode > 57) {
		event.returnValue = false;
	}
}
function only_number_hyphen() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if(event.keyCode != 45) event.returnValue = false;
	}
}
function only_number_comma() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if(event.keyCode != 46) event.returnValue = false;
	}
}
//주민등록번호 입력 하이픈
function checkhyphen_jumin_no(inputVal, type, keydown) {
	main = document.dataForm;
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
	//탭 시프트+탭 좌 우 Home backsp
	if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
		if(inputVal.length == 6){
			total += input.substring(0,6)+"-";
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
//]]>
</script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script type="text/javascript">
//<![CDATA[
function loadCalendar( obj, k, i )
{
	var calendar = new Calendar(0, null, onSelect, onClose);
	calendar.create();
	calendar.parseDate(obj.value);
	calendar.showAtElement(obj, "Br");

	function onSelect(calendar, date) {
		main = document.dataForm;
		var input_field = obj;
		input_field.value = date;
		if (calendar.dateClicked) {
			calendar.callCloseHandler();
		}
		obj_name = obj.name.substring(0, 18);
		//alert(obj_name);
		//인증유효기간 만료일 계산 151204
		if(obj_name == "approval_effective" || obj_name == "site_approval_effe") {
			var y  = date.substring(0,4);
			var m = date.substring(5,7);
			var d = date.substring(8,10); 
			var date = new Date(m+'/'+d+'/'+y);
			//alert(d+'/'+m+'/'+y);
			var getDate = date.setYear(date.getFullYear() + 1);
			var getDate = date.setDate(date.getDate() - 1);
			var getDate = new Date(getDate);
			var yyyy = getDate.getFullYear();
			var mm = getDate.getMonth()+1;
			var dd = getDate.getDate();
			if(mm < 10) mm = "0"+mm;
			if(dd < 10) dd = "0"+dd;
			resultDate = yyyy+"."+mm+"."+dd;
		}
		//alert(obj_name);
		if(obj_name == "approval_effective") {
			main['approval_expiration'+k].value = resultDate;
		} else if(obj_name == "site_approval_effe") {
			main['site_approval_expiration'+k].value = resultDate;
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
function findNomu(branch) {
	var ret = window.open("pop_manage_cust.php?search_belong="+branch, "pop_nomu_cust", "width=800,height=600, scrollbars=yes");
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
		//백스페이스키 적용
		if(event.keyCode != 8) {
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
					main.user_id.value=total;					// type 에 따라 최종값을 넣어 준다.
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
	if (event.keyCode < 48 || (event.keyCode > 57 && event.keyCode < 97) || (event.keyCode > 122)) event.returnValue = false;
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
		//백스페이스키 적용
		if(event.keyCode != 8) {
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
					main.jumin_no.value=total;					// type 에 따라 최종값을 넣어 준다.
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
	//탭 시프트+탭 좌 우 Home
	if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36) {
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
function writer_onchange(obj) {
	var main = document.dataForm;
	if(obj.value == 1) main.writer_tel.value = "070-4680-7041";
	else if(obj.value == 2) main.writer_tel.value = "070-4680-0331";
	else if(obj.value == 3) main.writer_tel.value = "051-921-5255";
	else if(obj.value == 4) main.writer_tel.value = "055-388-8805";
	else if(obj.value == 5) main.writer_tel.value = "063-461-4747";
	else if(obj.value == 6) main.writer_tel.value = "053-292-4117";
	//정경용
	else if(obj.value == 110) main.writer_tel.value = "070-4680-7041";
	//임영진
	else if(obj.value == 122) main.writer_tel.value = "070-7405-2661";
	//최동환
	else if(obj.value == 2001) main.writer_tel.value = "051-921-5255";
	//황희경
	else if(obj.value == 2002) main.writer_tel.value = "051-921-5255";
	//양국일
	else if(obj.value == 3501) main.writer_tel.value = "055-388-8805";
	//박정민
	else if(obj.value == 3601) main.writer_tel.value = "063-461-4747";
	//엄희철
	else if(obj.value == 1001) main.writer_tel.value = "053-292-4117";
	//노우석
	else if(obj.value == 25) main.writer_tel.value = "070-7405-2661";
	//이유림
	else if(obj.value == 31) main.writer_tel.value = "053-636-1894";
	//김관수
	else if(obj.value == 2301) main.writer_tel.value = "055-245-0337";
}
function input_today(input_obj, output_name, vars) {
	var frm = document.dataForm;
	frm[output_name].value = "<?=$today?>";
}
function field_add(div_id, count_input) {
	var frm = document.dataForm;
	var v2 = document.getElementById(div_id+'2');
	var v2d = document.getElementById(div_id+'2d');
	var v3 = document.getElementById(div_id+'3');
	var v3d = document.getElementById(div_id+'3d');
	var v4 = document.getElementById(div_id+'4');
	var v4d = document.getElementById(div_id+'4d');
	var v5 = document.getElementById(div_id+'5');
	var v5d = document.getElementById(div_id+'5d');
	var v6 = document.getElementById(div_id+'6');
	var v6d = document.getElementById(div_id+'6d');
	var v7 = document.getElementById(div_id+'7');
	var v7d = document.getElementById(div_id+'7d');
	var v8 = document.getElementById(div_id+'8');
	var v8d = document.getElementById(div_id+'8d');
	var v9 = document.getElementById(div_id+'9');
	var v9d = document.getElementById(div_id+'9d');
	var v10 = document.getElementById(div_id+'10');
	var v10d = document.getElementById(div_id+'10d');
	if(v2.style.display == "none") {
		v2.style.display = "";
		if(div_id == "tr_education") v2d.style.display = "";
		frm[count_input].value = 2;
	} else {
		if(v3.style.display == "none") {
			v3.style.display = "";
			if(div_id == "tr_education") v3d.style.display = "";
			frm[count_input].value = 3;
		} else {
			if(v4.style.display == "none") {
				v4.style.display = "";
				if(div_id == "tr_education") v4d.style.display = "";
				frm[count_input].value = 4;
			} else {
				if(v5.style.display == "none") {
					v5.style.display = "";
					if(div_id == "tr_education") v5d.style.display = "";
					frm[count_input].value = 5;
				} else {
					if(v6.style.display == "none") {
						v6.style.display = "";
						if(div_id == "tr_education") v6d.style.display = "";
						frm[count_input].value = 6;
					} else {
						if(v7.style.display == "none") {
							v7.style.display = "";
							if(div_id == "tr_education") v7d.style.display = "";
							frm[count_input].value = 7;
						} else {
							if(v8.style.display == "none") {
								v8.style.display = "";
								if(div_id == "tr_education") v8d.style.display = "";
								frm[count_input].value = 8;
							} else {
								if(v9.style.display == "none") {
									v9.style.display = "";
									if(div_id == "tr_education") v9d.style.display = "";
									frm[count_input].value = 9;
								} else {
									if(v10.style.display == "none") {
										v10.style.display = "";
										if(div_id == "tr_education") v10d.style.display = "";
										frm[count_input].value = 10;
									} else {
										alert("최대 10개까지 추가 가능합니다.");
									}
								}
							}
						}
					}
				}
			}
		}
	}
}
function field_del(div_id, count_input) {
	var frm = document.dataForm;
	var v2 = document.getElementById(div_id+'2');
	var v2d = document.getElementById(div_id+'2d');
	var v3 = document.getElementById(div_id+'3');
	var v3d = document.getElementById(div_id+'3d');
	var v4 = document.getElementById(div_id+'4');
	var v4d = document.getElementById(div_id+'4d');
	var v5 = document.getElementById(div_id+'5');
	var v5d = document.getElementById(div_id+'5d');
	var v6 = document.getElementById(div_id+'6');
	var v6d = document.getElementById(div_id+'6d');
	var v7 = document.getElementById(div_id+'7');
	var v7d = document.getElementById(div_id+'7d');
	var v8 = document.getElementById(div_id+'8');
	var v8d = document.getElementById(div_id+'8d');
	var v9 = document.getElementById(div_id+'9');
	var v9d = document.getElementById(div_id+'9d');
	var v10 = document.getElementById(div_id+'10');
	var v10d = document.getElementById(div_id+'10d');
	if(v10.style.display == "") {
		v10.style.display = "none";
		if(div_id == "tr_education") v10d.style.display = "none";
		frm[count_input].value = 9;
	} else {
		if(v9.style.display == "") {
			v9.style.display = "none";
			if(div_id == "tr_education") v9d.style.display = "none";
			frm[count_input].value = 8;
		} else {
			if(v8.style.display == "") {
				v8.style.display = "none";
				if(div_id == "tr_education") v8d.style.display = "none";
				frm[count_input].value = 7;
			} else {
				if(v7.style.display == "") {
					v7.style.display = "none";
					if(div_id == "tr_education") v7d.style.display = "none";
					frm[count_input].value = 6;
				} else {
					if(v6.style.display == "") {
						v6.style.display = "none";
						if(div_id == "tr_education") v6d.style.display = "none";
						frm[count_input].value = 5;
					} else {
						if(v5.style.display == "") {
							v5.style.display = "none";
							if(div_id == "tr_education") v5d.style.display = "none";
							frm[count_input].value = 4;
						} else {
							if(v4.style.display == "") {
								v4.style.display = "none";
								if(div_id == "tr_education") v4d.style.display = "none";
								frm[count_input].value = 3;
							} else {
								if(v3.style.display == "") {
									v3.style.display = "none";
									if(div_id == "tr_education") v3d.style.display = "none";
									frm[count_input].value = 2;
								} else {
									if(v2.style.display == "") {
										v2.style.display = "none";
										if(div_id == "tr_education") v2d.style.display = "none";
										frm[count_input].value = 1;
									} else {
										alert("최소 1줄은 존재해야 합니다. 해당 사항이 없을시 내용을 삭제하세요.");
									}
								}
							}
						}
					}
				}
			}
		}
	}
}
//직무교육 회차 추가
function field_opt_add(div_id, count_input) {
	var frm = document.dataForm;
	var v2 = document.getElementById(div_id+'2');
	var v2b = document.getElementById(div_id+'2b');
	var v2c = document.getElementById(div_id+'2c');
	var v3 = document.getElementById(div_id+'3');
	var v3b = document.getElementById(div_id+'3b');
	var v3c = document.getElementById(div_id+'3c');
	var v4 = document.getElementById(div_id+'4');
	var v4b = document.getElementById(div_id+'4b');
	var v4c = document.getElementById(div_id+'4c');
	var v5 = document.getElementById(div_id+'5');
	var v5b = document.getElementById(div_id+'5b');
	var v5c = document.getElementById(div_id+'5c');
	var v6 = document.getElementById(div_id+'6');
	var v6b = document.getElementById(div_id+'6b');
	var v6c = document.getElementById(div_id+'6c');
	var v7 = document.getElementById(div_id+'7');
	var v7b = document.getElementById(div_id+'7b');
	var v7c = document.getElementById(div_id+'7c');
	var v8 = document.getElementById(div_id+'8');
	var v8b = document.getElementById(div_id+'8b');
	var v8c = document.getElementById(div_id+'8c');
	var v9 = document.getElementById(div_id+'9');
	var v9b = document.getElementById(div_id+'9b');
	var v9c = document.getElementById(div_id+'9c');
	var v10 = document.getElementById(div_id+'10');
	var v10b = document.getElementById(div_id+'10b');
	var v10c = document.getElementById(div_id+'10c');
	var v2d = document.getElementById(div_id+'2d');
	var v3d = document.getElementById(div_id+'3d');
	var v4d = document.getElementById(div_id+'4d');
	var v5d = document.getElementById(div_id+'5d');
	var v6d = document.getElementById(div_id+'6d');
	var v7d = document.getElementById(div_id+'7d');
	var v8d = document.getElementById(div_id+'8d');
	var v9d = document.getElementById(div_id+'9d');
	var v10d = document.getElementById(div_id+'10d');
	if(v2.style.display == "none") {
		v2.style.display = "";
		v2b.style.display = "";
		v2c.style.display = "";
		v2d.style.display = "";
		frm[count_input].value = 2;
	} else {
		if(v3.style.display == "none") {
			v3.style.display = "";
			v3b.style.display = "";
			v3c.style.display = "";
			v3d.style.display = "";
			frm[count_input].value = 3;
		} else {
			if(v4.style.display == "none") {
				v4.style.display = "";
				v4b.style.display = "";
				v4c.style.display = "";
				v4d.style.display = "";
				frm[count_input].value = 4;
			} else {
				if(v5.style.display == "none") {
					v5.style.display = "";
					v5b.style.display = "";
					v5c.style.display = "";
					v5d.style.display = "";
					frm[count_input].value = 5;
				} else {
					if(v6.style.display == "none") {
						v6.style.display = "";
						v6b.style.display = "";
						v6c.style.display = "";
						v6d.style.display = "";
						frm[count_input].value = 6;
					} else {
						if(v7.style.display == "none") {
							v7.style.display = "";
							v7b.style.display = "";
							v7c.style.display = "";
							v7d.style.display = "";
							frm[count_input].value = 7;
						} else {
							if(v8.style.display == "none") {
								v8.style.display = "";
								v8b.style.display = "";
								v8c.style.display = "";
								v8d.style.display = "";
								frm[count_input].value = 8;
							} else {
								if(v9.style.display == "none") {
									v9.style.display = "";
									v9b.style.display = "";
									v9c.style.display = "";
									v9d.style.display = "";
									frm[count_input].value = 9;
								} else {
									if(v10.style.display == "none") {
										v10.style.display = "";
										v10b.style.display = "";
										v10c.style.display = "";
										v10d.style.display = "";
										frm[count_input].value = 10;
									} else {
										alert("최대 10개까지 추가 가능합니다.");
									}
								}
							}
						}
					}
				}
			}
		}
	}
}
//직무교육 회차 삭제
function field_opt_del(div_id, count_input) {
	var frm = document.dataForm;
	var v2 = document.getElementById(div_id+'2');
	var v2b = document.getElementById(div_id+'2b');
	var v2c = document.getElementById(div_id+'2c');
	var v3 = document.getElementById(div_id+'3');
	var v3b = document.getElementById(div_id+'3b');
	var v3c = document.getElementById(div_id+'3c');
	var v4 = document.getElementById(div_id+'4');
	var v4b = document.getElementById(div_id+'4b');
	var v4c = document.getElementById(div_id+'4c');
	var v5 = document.getElementById(div_id+'5');
	var v5b = document.getElementById(div_id+'5b');
	var v5c = document.getElementById(div_id+'5c');
	var v6 = document.getElementById(div_id+'6');
	var v6b = document.getElementById(div_id+'6b');
	var v6c = document.getElementById(div_id+'6c');
	var v7 = document.getElementById(div_id+'7');
	var v7b = document.getElementById(div_id+'7b');
	var v7c = document.getElementById(div_id+'7c');
	var v8 = document.getElementById(div_id+'8');
	var v8b = document.getElementById(div_id+'8b');
	var v8c = document.getElementById(div_id+'8c');
	var v9 = document.getElementById(div_id+'9');
	var v9b = document.getElementById(div_id+'9b');
	var v9c = document.getElementById(div_id+'9c');
	var v10 = document.getElementById(div_id+'10');
	var v10b = document.getElementById(div_id+'10b');
	var v10c = document.getElementById(div_id+'10c');
	var v2d = document.getElementById(div_id+'2d');
	var v3d = document.getElementById(div_id+'3d');
	var v4d = document.getElementById(div_id+'4d');
	var v5d = document.getElementById(div_id+'5d');
	var v6d = document.getElementById(div_id+'6d');
	var v7d = document.getElementById(div_id+'7d');
	var v8d = document.getElementById(div_id+'8d');
	var v9d = document.getElementById(div_id+'9d');
	var v10d = document.getElementById(div_id+'10d');
	if(v10.style.display == "") {
		v10.style.display = "none";
		v10b.style.display = "none";
		v10c.style.display = "none";
		v10d.style.display = "none";
		frm[count_input].value = 9;
	} else {
		if(v9.style.display == "") {
			v9.style.display = "none";
			v9b.style.display = "none";
			v9c.style.display = "none";
			v9d.style.display = "none";
			frm[count_input].value = 8;
		} else {
			if(v8.style.display == "") {
				v8.style.display = "none";
				v8b.style.display = "none";
				v8c.style.display = "none";
				v8d.style.display = "none";
				frm[count_input].value = 7;
			} else {
				if(v7.style.display == "") {
					v7.style.display = "none";
					v7b.style.display = "none";
					v7c.style.display = "none";
					v7d.style.display = "none";
					frm[count_input].value = 6;
				} else {
					if(v6.style.display == "") {
						v6.style.display = "none";
						v6b.style.display = "none";
						v6c.style.display = "none";
						v6d.style.display = "none";
						frm[count_input].value = 5;
					} else {
						if(v5.style.display == "") {
							v5.style.display = "none";
							v5b.style.display = "none";
							v5c.style.display = "none";
							v5d.style.display = "none";
							frm[count_input].value = 4;
						} else {
							if(v4.style.display == "") {
								v4.style.display = "none";
								v4b.style.display = "none";
								v4c.style.display = "none";
								v4d.style.display = "none";
								frm[count_input].value = 3;
							} else {
								if(v3.style.display == "") {
									v3.style.display = "none";
									v3b.style.display = "none";
									v3c.style.display = "none";
									v3d.style.display = "none";
									frm[count_input].value = 2;
								} else {
									if(v2.style.display == "") {
										v2.style.display = "none";
										v2b.style.display = "none";
										v2c.style.display = "none";
										v2d.style.display = "none";
										frm[count_input].value = 1;
									} else {
										alert("최소 1줄은 존재해야 합니다. 해당 사항이 없을시 내용을 삭제하세요.");
									}
								}
							}
						}
					}
				}
			}
		}
	}
}
//직무교육 처리현황 이력
function open_job_history(id) {
	var ret = window.open("./job_history_popup.php?id="+id, "window_job_history", "scrollbars=yes,width=507,height=240");
	return;
}
//사업주훈련 재연락 이력 150917
function open_job_recall(id) {
	var ret = window.open("./job_recall_popup.php?id="+id, "window_job_recall", "scrollbars=yes,width=507,height=240");
	return;
}
//체크박스 오늘 일자
function checkbox_today(input_obj, output_name) {
	var frm = document.dataForm;
	if(input_obj.checked == true) {
		frm[output_name].value = "<?=$today?>";
	} else {
		frm[output_name].value = "";
	}
}
//사무위탁 이력
function open_samu_history(id) {
	var ret = window.open("./samu_history_popup.php?id="+id, "window_samu_history", "scrollbars=yes,width=640,height=240");
	return;
}
//문자 발송 팝업 151014
function popup_sms_send(url, to_phone) {
	window.open(url+"?to_phone="+to_phone, "window_sms_send", "width=340, height=350, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
}
//]]>
</script>
<script type="text/javascript" src="https://spi.maps.daum.net/imap/map_js_init/postcode.js"></script>
<script type="text/javascript">
//<![CDATA[
function openDaumPostcode(zip1,zip2,addr1,addr2) {
	new daum.Postcode({
			oncomplete: function(data) {
					frm = document.dataForm;
					frm[zip1].value = data.postcode1;
					frm[zip2].value = data.postcode2;
					frm[addr1].value = data.address;
					frm[addr2].focus();
			}
	}).open();
}
//]]>
</script>
<?
include "inc/top.php";
$url_list = "./job_education_list.php?page=".$page;
?>
		<td onmouseover="showM('900')" valign="top">
			<div style="margin:10px 20px 20px 20px;min-height:480px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100"><img src="images/top19.gif" border="0"></td>
						<td width=""><a href="<?=$url_list?>"><img src="<?=$top_sub_title?>" border="0"></a></td>
						<td></td>
					</tr>
					<tr><td height="1" bgcolor="#cccccc" colspan="3"></td></tr>
				</table>
				<table width="<?=$content_width?>" border="0" align="left" cellpadding="0" cellspacing="0" >
					<tr>
						<td valign="top" style="padding:10px 0 0 0">
							<!--댑메뉴 -->
							<table border=0 cellspacing=0 cellpadding=0 style=""> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
												사업장 기본정보
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
							
							<form name="dataForm" method="post" enctype="MULTIPART/FORM-DATA">
							<input type="hidden" name="w" value="<?=$w?>">
							<input type="hidden" name="com_code" value="<?=$row['com_code']?>">
							<!-- 입력폼 -->
							<table width="100%" height="200" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
								<tr>
									<td nowrap class="tdrowk" width="96"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업장명<font color="red">*</font></td>
									<td nowrap  class="tdrow" width="200">
										<input name="com_name" type="text" class="textfm" style="width:100%;ime-mode:active;" value="<?=$row['com_name']?>" maxlength="50">
									</td>
									<td nowrap class="tdrowk" width="110"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업자등록번호<font color="red">*</font></td>
									<td nowrap  class="tdrow" width="170">
										<input name="comp_bznb" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$row['biz_no']?>" maxlength="12" onkeydown="only_number()" onkeyup="checkhyphen(this.value, '1','Y')">
									</td>
									<td nowrap class="tdrowk" width="96"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">기업형태<font color="red"></font></td>
									<td nowrap  class="tdrow" width="">
<?
if($row['upche_div'] == "1") {
	$chk_comp_type1 = "checked";
	$comp_type_text = "개인";
} else if($row[upche_div] == "2") {
	$chk_comp_type2 = "checked";
	$comp_type_text = "법인";
} else if($row[upche_div] == "3") {
	$chk_comp_type3 = "checked";
	$comp_type_text = "유한";
}
?>
										<input type="radio" name="comp_type" value="1" <?=$chk_comp_type1?> />개인
										<input type="radio" name="comp_type" value="2" <?=$chk_comp_type2?> />법인
										<input type="radio" name="comp_type" value="3" <?=$chk_comp_type3?> />유한
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">대표자명<font color="red">*</font></td>
									<td nowrap  class="tdrow">
										<input name="boss_name" type="text" class="textfm" style="width:150px;ime-mode:active;" value="<?=$row['boss_name']?>" maxlength="25">
									</td>
									<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업장관리번호<font color="red">*</font></td>
									<td nowrap  class="tdrow" width="">
										<input name="t_insureno" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$row['t_insureno']?>" maxlength="14" onkeydown="only_number()" onkeyup="checkhyphen_tno(this.value, '2','Y')">
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">주민등록번호</td>
									<td nowrap class="tdrow">
										<input name="jumin_no" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$row['jumin_no']?>" maxlength="14"  onkeypress="only_number_hyphen()" onkeyup="checkhyphen_bupin_no(this.value, '2','Y')">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">업태<font color="red">*</font></td>
									<td nowrap  class="tdrow">
										<input name="uptae" type="text" class="textfm" style="width:120px;" value="<?=$row['uptae']?>" maxlength="12" onkeypress="" onkeyup="">
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">전화번호<font color="red">*</font></td>
									<td nowrap  class="tdrow">
<?
$com_tel = explode("-",$row['com_tel']);
$com_tel1 = $com_tel[0];
$sel_cust_tel1 = array();
$sel_cust_tel1[$com_tel1] = "selected";
$com_tel2 = $com_tel[1];
$com_tel3 = $com_tel[2];
?>
									<select name="com_tel1" class="selectfm">
									<option value="">선택</option>
										<option value="02"  <?=$sel_cust_tel1['02']?> >02</option>
										<option value="031" <?=$sel_cust_tel1['031']?>>031</option>
										<option value="032" <?=$sel_cust_tel1['032']?>>032</option>
										<option value="033" <?=$sel_cust_tel1['033']?>>033</option>
										<option value="041" <?=$sel_cust_tel1['041']?>>041</option>
										<option value="042" <?=$sel_cust_tel1['042']?>>042</option>
										<option value="043" <?=$sel_cust_tel1['043']?>>043</option>
										<option value="044" <?=$sel_cust_tel1['044']?>>044</option>
										<option value="051" <?=$sel_cust_tel1['051']?>>051</option>
										<option value="052" <?=$sel_cust_tel1['052']?>>052</option>
										<option value="053" <?=$sel_cust_tel1['053']?>>053</option>
										<option value="054" <?=$sel_cust_tel1['054']?>>054</option>
										<option value="055" <?=$sel_cust_tel1['055']?>>055</option>
										<option value="061" <?=$sel_cust_tel1['061']?>>061</option>
										<option value="062" <?=$sel_cust_tel1['062']?>>062</option>
										<option value="063" <?=$sel_cust_tel1['063']?>>063</option>
										<option value="064" <?=$sel_cust_tel1['064']?>>064</option>
										<option value="070" <?=$sel_cust_tel1['070']?>>070</option>
										<option value="000" <?=$sel_cust_tel1['000']?>>빈칸</option>
										<option value="010" <?=$sel_cust_tel1['010']?>>010</option>
										<option value="011" <?=$sel_cust_tel1['011']?>>011</option>
										<option value="016" <?=$sel_cust_tel1['016']?>>016</option>
										<option value="017" <?=$sel_cust_tel1['017']?>>017</option>
										<option value="018" <?=$sel_cust_tel1['018']?>>018</option>
										<option value="019" <?=$sel_cust_tel1['019']?>>019</option>
									</select>
										-
										<input name="com_tel2" type="text" class="textfm" style="width:35;ime-mode:disabled;" value="<?=$com_tel2?>" maxlength="4" onKeyPress="onlyNumber();">
										-
										<input name="com_tel3" type="text" class="textfm" style="width:35;ime-mode:disabled;" value="<?=$com_tel3?>" maxlength="4" onKeyPress="onlyNumber();">
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">팩스번호<font color="red"></font></td>
									<td nowrap  class="tdrow">
<?
$com_fax = explode("-",$row[com_fax]);
$com_fax1 = $com_fax[0];
$sel_cust_fax1 = array();
$sel_cust_fax1[$com_fax1] = "selected";
$com_fax2 = $com_fax[1];
$com_fax3 = $com_fax[2];
?>
										<select name="cust_fax1" class="selectfm">
										<option value="">선택</option>
											<option value="02"  <?=$sel_cust_fax1['02']?> >02</option>
											<option value="031" <?=$sel_cust_fax1['031']?>>031</option>
											<option value="032" <?=$sel_cust_fax1['032']?>>032</option>
											<option value="033" <?=$sel_cust_fax1['033']?>>033</option>
											<option value="041" <?=$sel_cust_fax1['041']?>>041</option>
											<option value="042" <?=$sel_cust_fax1['042']?>>042</option>
											<option value="043" <?=$sel_cust_fax1['043']?>>043</option>
											<option value="044" <?=$sel_cust_fax1['044']?>>044</option>
											<option value="051" <?=$sel_cust_fax1['051']?>>051</option>
											<option value="052" <?=$sel_cust_fax1['052']?>>052</option>
											<option value="053" <?=$sel_cust_fax1['053']?>>053</option>
											<option value="054" <?=$sel_cust_fax1['054']?>>054</option>
											<option value="055" <?=$sel_cust_fax1['055']?>>055</option>
											<option value="061" <?=$sel_cust_fax1['061']?>>061</option>
											<option value="062" <?=$sel_cust_fax1['062']?>>062</option>
											<option value="063" <?=$sel_cust_fax1['063']?>>063</option>
											<option value="064" <?=$sel_cust_fax1['064']?>>064</option>
											<option value="070" <?=$sel_cust_fax1['070']?>>070</option>
											<option value="0303" <?=$sel_cust_fax1['0303']?>>0303</option>
											<option value="0502" <?=$sel_cust_fax1['0502']?>>0502</option>
											<option value="0505" <?=$sel_cust_fax1['0505']?>>0505</option>
											<option value="0507" <?=$sel_cust_fax1['0507']?>>0507</option>
										</select>
										-
										<input name="cust_fax2" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$com_fax2?>" maxlength="4" onKeyPress="onlyNumber();">
										-
										<input name="cust_fax3" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$com_fax3?>" maxlength="4" onKeyPress="onlyNumber();">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">업종<font color="red"></font></td>
									<td nowrap  class="tdrow" colspan="3">
										<div style="padding-top:3px;">
											<input name="upjong_code" id="upjong_code_undefined" type="text" class="textfm" style="width:40px;" value="<?=$row['upjong_code']?>" maxlength="5" readonly>
											<label onclick="open_upjong();" style="cursor:pointer"><img src="images/search_bt.png" align=absmiddle></label>
											<input name="upjong" id="upjong_undefined" type="text" class="textfm" style="width:407px;" value="<?=$row['upjong']?>" maxlength="25" readonly>
										</div>
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">담당지사<font color="red"></font></td>
									<td nowrap  class="tdrow">
<?
if($row['damdang_code']) {
	$man_cust_name_code = $row['damdang_code'];
} else {
	$man_cust_name_code = $stx_man_cust_name;
}
if($row['damdang_code2']) {
	$man_cust_name_code2 = $row['damdang_code2'];
}
if($row['damdang_code']) echo $man_cust_name_arry[$man_cust_name_code];
if($row['damdang_code2']) echo " (".$man_cust_name_arry[$man_cust_name_code2].")";
//담당매니저 코드 체크
$manage_cust_code = $row['manage_cust_numb'];
$sql_manage = "select position from a4_manage where code = '$manage_cust_code' ";
$row_manage = sql_fetch($sql_manage);
if($row_manage['position']) {
	$manage_position = " ".$row_manage['position'];
}
if($row['manage_cust_name']) echo " [".$row['manage_cust_name'].$manage_position."]";
?>
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk" rowspan="3"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">주소<font color="red">*</font></td>
									<td nowrap  class="tdrow" rowspan="3" colspan="3">
<?
$adr_zip = explode("-",$row['com_postno']);
?>
										<input name="adr_zip1" type="text" class="textfm" style="width:30px;" value="<?=$adr_zip[0]?>" >
										-
										<input name="adr_zip2" type="text" class="textfm" style="width:30px;" value="<?=$adr_zip[1]?>" >
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;vertical-align:middle"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:openDaumPostcode('adr_zip1','adr_zip2','adr_adr1','adr_adr2');" target="">주소찾기</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
										<br>
										<input name="adr_adr1" type="text" class="textfm" style="width:450px;" value="<?=$row['com_juso']?>" >
										<br>
										<input name="adr_adr2" type="text" class="textfm" style="width:450px;" value="<?=$row['com_juso2']?>" maxlength="150">
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">관리담당자</td>
									<td nowrap  class="tdrow">
										<input name="job_manager_name" type="text" class="textfm" style="width:80px;vertical-align:middle;" value="<?=$row['job_manager_name']?>" maxlength="50">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">담당자HP</td>
									<td nowrap  class="tdrow">
										<input name="job_manager_hp" type="text" class="textfm" style="width:110px;vertical-align:middle;" value="<?=$row['job_manager_hp']?>" maxlength="50">
<?
//본사만 표시 문자 발송 151014
if($member['mb_level'] != 6) {
?>
												<a href="popup/popup_sms_send.php" onclick="popup_sms_send(this.href, '<?=$row['job_manager_hp']?>');return false;" onkeypress="this.onclick;"><img src="images/icon_sms_send.png" style="vertical-align:middle;" border="0" alt="문자발송" /></a>
<?
}
?>
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">담당자이메일</td>
									<td nowrap  class="tdrow">
										<input name="job_manager_mail" type="text" class="textfm" style="width:100%;vertical-align:middle;" value="<?=$row['job_manager_mail']?>" maxlength="50">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">상담메모</td>
									<td nowrap  class="tdrow" colspan="5">
										<textarea name="job_memo" class="textfm" style='width:100%;height:70px;word-break:break-all;' itemname="내용" required><?=$row['job_memo']?></textarea>
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">첨부서류</td>
									<td nowrap  class="tdrow" colspan="5">
										<? if($row['filename_1']) { ?><a href="files/contract/<?=$row['filename_1']?>" target="_blank"><?=$row['filename_1']?></a><br><? } ?>
										<? if($row['filename_2']) { ?><a href="files/contract/<?=$row['filename_2']?>" target="_blank"><?=$row['filename_2']?></a><br><? } ?>
										<? if($row['filename_3']) { ?><a href="files/contract/<?=$row['filename_3']?>" target="_blank"><?=$row['filename_3']?></a><br><? } ?>
										<? if($row['filename_4']) { ?><a href="files/contract/<?=$row['filename_4']?>" target="_blank"><?=$row['filename_4']?></a><br><? } ?>
										<? if($row['filename_5']) { ?><a href="files/contract/<?=$row['filename_5']?>" target="_blank"><?=$row['filename_5']?></a><br><? } ?>
										<? if($row['filename_6']) { ?><a href="files/contract/<?=$row['filename_6']?>" target="_blank"><?=$row['filename_6']?></a><br><? } ?>
										<? if($row['filename_7']) { ?><a href="files/contract/<?=$row['filename_7']?>" target="_blank"><?=$row['filename_7']?></a><br><? } ?>
										<? if($row['filename_8']) { ?><a href="files/contract/<?=$row['filename_8']?>" target="_blank"><?=$row['filename_8']?></a><? } ?>
									</td>
								</tr>
							</table>
							<div style="height:10px;font-size:0px"></div>
							<!--탭메뉴 -->
<?
//현재 탭 메뉴 번호
$tab_onoff_this = 4;
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
//강제 리포트 뷰 출력
$report = "ok";
?>
							<div id="main_process_state">
								<!--댑메뉴 -->
								<a name="10002"><!--의뢰서접수--></a>
								<a name="10003"><!--계약서접수--></a>
								<a name="15000"><!--위탁서접수--></a>
								<a name="15001"><!--사무위탁--></a>
								<a name="20001"><!--대리인선임(공단)--></a>
								<a name="20002"><!--전자민원(센터)--></a>
								<table border=0 cellspacing=0 cellpadding=0 style=""> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
														본사처리현황
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
										<td nowrap class="tdrowk" width="130"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">의뢰서접수</td>
										<td nowrap class="tdrow" width="199">
<?
//사무위탁수임
$chk_contract = $row['chk_contract'];
$editdt_chk = $row['editdt_chk'];
$editdt = $row['editdt'];
echo $editdt;
if($editdt_chk == "2") echo "미도착";
?>
										</td>
										<td nowrap class="tdrowk" width="130"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">계약서접수</td>
										<td nowrap  class="tdrow" width="">
<?
//계약서 번호
if($row['chk_contract_no']) $chk_contract_no = $row['chk_contract_no'];
else $chk_contract_no = "";
echo $row['chk_contract_date']." ";
if($row['chk_contract_no']) echo "(".$row['chk_contract_no'].")";
if($chk_contract == "2") echo "미도착";
?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">위탁서접수</td>
										<td nowrap  class="tdrow" width="">
<?
$editdt = $row['editdt'];
$samu_receive_chk = $row['samu_receive_chk'];
echo $row['samu_receive_date']." ";
if($samu_receive_chk == "2") echo "미도착";
?>
										</td>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사무위탁수임</td>
										<td nowrap  class="tdrow">
<?
//사무위탁수임
$samu_req_yn = $row['samu_req_yn'];
$samu_req_yn_arry = array("","반려","수임가능","타수임","수임","해지");
//위탁번호 0 제거
if($row['samu_receive_no']) $samu_receive_no = $row['samu_receive_no'];
else  $samu_receive_no = "";
if($samu_req_yn) echo "<b>".$samu_req_yn_arry[$samu_req_yn]."</b> ";
if($row['samu_req_date']) echo "수임일 : ".$row['samu_req_date']." ";
if($samu_receive_no) echo "(".$samu_receive_no.") ";
if($row['samu_close_date']) echo "해지일 : ".$row['samu_close_date'];
?>
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./samu_view.php?w=<?=$w?>&id=<?=$com_code?>" target="">사무위탁현황</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<?
//본사만 표시 150916
if($member['mb_level'] != 6) {
?>
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="javascript:open_samu_history('<?=$id?>');" target="">이력</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<?
}
?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">대리인선임(공단)</td>
										<td nowrap  class="tdrow" colspan="3">
<?
$agent_elect_public_chk = $row['agent_elect_public_chk'];
$agent_elect_public_yn = $row['agent_elect_public_yn'];
if($agent_elect_public_chk == "2") echo "미도착";
if($row['agent_elect_public_edate']) echo "완료 : ".$row['agent_elect_public_edate']." ";
if($row['agent_elect_public_cdate']) echo "해지 : ".$row['agent_elect_public_cdate']." ";
if($row['agent_elect_public_memo']) echo $row['agent_elect_public_memo'];
?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">전자민원(센터)</td>
										<td nowrap  class="tdrow" colspan="3">
<?
$agent_elect_center_chk = $row['agent_elect_center_chk'];
$agent_elect_center_yn = $row['agent_elect_center_yn'];
if($agent_elect_center_chk == "2") echo "미도착";
if($row['agent_elect_center_edate']) echo "완료 : ".$row['agent_elect_center_edate']." ";
if($row['agent_elect_center_cdate']) echo "해지 : ".$row['agent_elect_center_cdate']." ";
if($row['agent_elect_center_memo']) echo $row['agent_elect_center_memo'];
?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">지원금신청내역유무</td>
										<td nowrap  class="tdrow" colspan="5">
<?
echo $row['support_history_memo'];
?>
										</td>
									</tr>
								</table>
							</div><!-- main_process_state end -->

							<div style="height:10px;font-size:0px"></div>
							<!--세부내용-->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/sb_tab_on_lt.gif"></td> 
												<td background="images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:120px;text-align:center'> 
													위험성평가 의뢰
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
							<!--댑메뉴 -->
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
								<tr>
									<td nowrap class="tdrowk" width="112">
										<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">KRAS아이디
									</td>
									<td nowrap  class="tdrow" width="">
										<b>아이디</b>
										<input name="job_kras_id" type="text" class="textfm" style="width:140px;vertical-align:middle;ime-mode:disabled;" value="<?=$row['job_kras_id']?>" maxlength="20">
										<b>비밀번호</b>
										<input name="job_kras_pw" type="text" class="textfm" style="width:140px;vertical-align:middle;ime-mode:disabled;" value="<?=$row['job_kras_pw']?>" maxlength="20">
									</td>
								</tr>
							</table>
							<div style="height:10px;font-size:0px"></div>
							<!--댑메뉴 -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:120px;text-align:center'> 
													직무교육 기본내용
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
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
								<tr>
									<td nowrap class="tdrowk" width="112">
										<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">처리현황
									</td>
									<td nowrap  class="tdrow" width="300">
<?
$job_proxy = $row['job_proxy'];
if($member['mb_level'] != 6) {
?>
										<select name="job_proxy" class="selectfm" onchange="input_today(this,'job_proxy_date','3')">
											<option value="">선택</option>
<?
$job_proxy_count = count($job_proxy_array);
for($i=1;$i<$job_proxy_count;$i++) {
?>
											<option value="<?=$i?>" <? if($job_proxy == $i) echo "selected"; ?>><?=$job_proxy_array[$i]?></option>
<?
}
?>
										</select>
										<input name="job_proxy_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;background:#f0f0f0;" value="<?=$row['job_proxy_date']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
										<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="javascript:open_job_history('<?=$com_code?>');" target="">이력</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<?
} else {
	echo $job_proxy_array[$job_proxy];
	if($row['job_proxy_date']) echo "(".$row['job_proxy_date'].")";
}
?>
									</td>
									<td nowrap class="tdrowk" width="112">
										<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">HRD아이디
									</td>
									<td nowrap class="tdrow">
										<strong>아이디</strong>
										<input name="job_hrd_id" type="text" class="textfm" style="width:140px;vertical-align:middle;ime-mode:disabled;" value="<?=$row['job_hrd_id']?>" maxlength="20">
										<strong>비밀번호</strong>
										<input name="job_hrd_pw" type="text" class="textfm" style="width:140px;vertical-align:middle;ime-mode:disabled;" value="<?=$row['job_hrd_pw']?>" maxlength="20">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk" width="" rowspan="">
										<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">담당자
									</td>
									<td nowrap  class="tdrow" width="" rowspan="">
<?
$manage_code = $row['job_cust_numb'];
$manage_name = $row['job_cust_name'];
?>
										<input type="text" name="manage_cust_numb" class="textfm" style="float:left;width:34px" readonly value="<?=$manage_code?>">
										<input name="manage_cust_name" type="text" class="textfm" style="float:left;width:88px" readonly value="<?=$manage_name?>">
										<table border="0" cellpadding="0" cellspacing="0" style="float:left;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:findNomu('1');" target="">검색</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
									</td>
									<td nowrap class="tdrowk">
										<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">재연락일자
									</td>
									<td nowrap class="tdrow">
<?
if($member['mb_level'] != 6) {
?>
										<input name="job_recall_date" type="text" class="textfm" style="float:left;width:80px;ime-mode:disabled;" value="<?=$row['job_recall_date']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
										<table border="0" cellpadding="0" cellspacing="0" style="float:left;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.job_recall_date);" target="">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
										<div style="float:left;padding:4px;"><strong>메모</strong></div>
										<input name="job_recall_memo" type="text" class="textfm" style="float:left;width:200px;ime-mode:active;" value="<?=$row['job_recall_memo']?>" maxlength="20" />
										<table border="0" cellpadding="0" cellspacing="0" style="float:left;vertical-align:middle;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="javascript:open_job_recall('<?=$com_code?>');" target="">이력</a></td><td><img src="images/btn_rt.gif" /></td><td width="2"></td></tr></table>
<?
} else {
	echo $row[$job_recall_memo];
	if($row['job_recall_date']) echo "(".$row['job_recall_date'].")";
}
?>
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk" width="" colspan="">
										<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">공단지사
									</td>
									<td nowrap  class="tdrow" width="" colspan="3">
										<select name="hrd_korea" class="selectfm" onchange="span_onchange(this,'hrd_korea_area');">
											<option value="">선택</option>
<?
//공단지사
$hrd_korea_code = $row['hrd_korea'];
$hrd_korea_name = array();
$hrd_korea_area = array();
$sql_hrd_korea = " select * from hrd_korea order by idx asc ";
$result_hrd_korea = sql_query($sql_hrd_korea);
for ($i=0; $row_hrd_korea=mysql_fetch_assoc($result_hrd_korea); $i++) {
	$k = $row_hrd_korea['idx'];
	$hrd_korea_name[$k] = $row_hrd_korea['branch_name'];
	$hrd_korea_tel[$k] = $row_hrd_korea['branch_tel'];
	$hrd_korea_area[$k] = $row_hrd_korea['branch_area'];
?>
											<option value="<?=$k?>" <? if($k == $hrd_korea_code) echo "selected"; ?> ><?=$hrd_korea_name[$k]?></option>
<?
}
?>
										</select>
										<b>관할지역 :</b>
										<span id="hrd_korea_area">
											<?=$hrd_korea_area[$hrd_korea_code]?>(<?=$hrd_korea_tel[$hrd_korea_code]?>)
										</span>
									</td>
								</tr>
							</table>
							<div style="height:10px;font-size:0px"></div>
<?
//담당자 강제 설정
$is_damdang = "ok";
//직무교육 최대 갯수
$job_limit = 10;
$i = 0;
$idx = $row['idx'];
//$count_job = 1;
$sql_job_max = " select max(step) as step_max from job_education_opt where mid='$idx' ";
$row_job_max = sql_fetch($sql_job_max);
$count_job = $row_job_max['step_max'];
$train_kind[$i] = $row['train_kind'];
$permission_date[$i] = $row['permission_date'];
$scale[$i] = $row['scale'];
$staff[$i] = $row['staff'];
$facility[$i] = $row['facility'];
$facility2[$i] = $row['facility2'];
$facility3[$i] = $row['facility3'];
$facility4[$i] = $row['facility4'];
$chief_name[$i] = $row['chief_name'];
$chief_ssnb[$i] = $row['chief_ssnb'];
$chief_position[$i] = $row['chief_position'];
$chief_job[$i] = $row['chief_job'];
$chief_career[$i] = $row['chief_career'];

$teacher_name[$i] = $row['teacher_name'];
$teacher_ssnb[$i] = $row['teacher_ssnb'];
$teacher_position[$i] = $row['teacher_position'];
$teacher_job[$i] = $row['teacher_job'];
$teacher_career[$i] = $row['teacher_career'];
$teacher_mail[$i] = $row['teacher_mail'];
$teacher_scholarship[$i] = $row['teacher_scholarship'];

$teacher_name2[$i] = $row['teacher_name2'];
$teacher_ssnb2[$i] = $row['teacher_ssnb2'];
$teacher_position2[$i] = $row['teacher_position2'];
$teacher_job2[$i] = $row['teacher_job2'];
$teacher_career2[$i] = $row['teacher_career2'];
$teacher_mail2[$i] = $row['teacher_mail2'];
$teacher_scholarship2[$i] = $row['teacher_scholarship2'];

$approval_effective[$i] = $row['approval_effective'];
$approval_expiration[$i] = $row['approval_expiration'];
$site_approval_effective[$i] = $row['site_approval_effective'];
$site_approval_expiration[$i] = $row['site_approval_expiration'];

$job_fee_year[$i] = $row['job_fee_year'];
$job_fee2_year[$i] = $row['job_fee2_year'];
$job_fee_limit[$i] = $row['job_fee_limit'];
$job_fee2_limit[$i] = $row['job_fee2_limit'];

$job_review[$i] = $row['job_review'];

//opt DB 미존재시 표시, 박소향 요청 151210;
if(!$count_job) $count_job = 1;
?>
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/sb_tab_on_lt.gif"></td> 
												<td background="images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:120px;text-align:center'> 
													직무교육 세부내용
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
<?
//직무교육 반복문 시작
for($job_no=1; $job_no <= $job_limit; $job_no++) {
	$k = $job_no;
	if($k == 1) $k = "";
	$m = $job_no-1;
	$sql_job_step = " select * from job_education_step where mid='$idx' and step='$job_no' ";
	$row_job_step = sql_fetch($sql_job_step);
	$approval_effective[$m] = $row_job_step['approval_effective'];
	$approval_expiration[$m] = $row_job_step['approval_expiration'];
	$site_approval_effective[$m] = $row_job_step['site_approval_effective'];
	$site_approval_expiration[$m] = $row_job_step['site_approval_expiration'];
	$scale[$m] = $row_job_step['scale'];
	$staff[$m] = $row_job_step['staff'];
	$job_fee_year[$m] = $job_fee_year['staff'];
	$job_fee2_year[$m] = $job_fee2_year['staff'];
	$job_fee_limit[$m] = $job_fee_limit['staff'];
	$job_fee2_limit[$m] = $job_fee2_limit['staff'];
?>
								<!--직무교육 반복문-->
								<tr id="tr_education<?=$k?>" style="<? if($count_job < $job_no) echo "display:none"; ?>">
									<td rowspan="2" class="tdrowk" width="90">
										<input type="hidden" name="idx<?=$k?>" value="<?=$idx?>">
										<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">직무교육<?=$job_no?>
<?
	//직무교육1 에서만 표시
	if($job_no == 1) {
?>
										<div style="padding:4px 0 0 5px">
											<a href="javascript:field_add('tr_education', 'job_count');"><img src="images/btn_add.png" align="absmiddle" border="0"></a>
											<a href="javascript:field_del('tr_education', 'job_count');"><img src="images/btn_del.png" align="absmiddle" border="0"></a>
										</div>
<?
	}
?>
									</td>
									<td class="tdrow" style="font-weight:bold;" width="360">
										<div style="padding:4px;line-height:20px;">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">인증유효기간
											<input name="approval_effective<?=$k?>" type="text" class="textfm5" readonly style="width:70px;ime-mode:disabled;background:#f0f0f0;" value="<?=$approval_effective[$m]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.approval_effective<?=$k?>,'<?=$k?>','1');" target="">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
											~  <input name="approval_expiration<?=$k?>" type="text" class="textfm5" readonly style="width:70px;ime-mode:disabled;background:#f0f0f0;" value="<?=$approval_expiration[$m]?>">
											<span style="font-weight:normal";>(집체)</span>
										</div>
										<div style="padding:4px;line-height:20px;">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">인증유효기간
											<input name="site_approval_effective<?=$k?>" type="text" class="textfm5" readonly style="width:70px;ime-mode:disabled;background:#f0f0f0;" value="<?=$site_approval_effective[$m]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.site_approval_effective<?=$k?>,'<?=$k?>','1');" target="">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
											~  <input name="site_approval_expiration<?=$k?>" type="text" class="textfm5" readonly style="width:70px;ime-mode:disabled;background:#f0f0f0;" value="<?=$site_approval_expiration[$m]?>">
											<span style="font-weight:normal";>(현장)</span>
										</div>
									</td>
									<td class="tdrowk" width="59">
										<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">규모
										<br />
										<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">인원
									</td>
									<td  class="tdrow" width="90">
										<input name="scale<?=$k?>" type="text" class="textfm" style="width:50px;ime-mode:disabled;" value="<?=$scale[$m]?>" maxlength="10" onKeyPress="" onkeyup="">㎥
										<br />
										<input name="staff<?=$k?>" type="text" class="textfm" style="width:50px;ime-mode:disabled;" value="<?=$staff[$m]?>" maxlength="10" onKeyPress="" onkeyup="">명
									</td>
									<td class="tdrowk" width="90"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">지원금한도</td>
									<td  class="tdrow" width="">
										<input name="job_fee_year<?=$k?>" type="text" class="textfm" style="width:50px;ime-mode:disabled;" value="<?=$job_fee_year[$m]?>" maxlength="4" />년
										<input name="job_fee_limit<?=$k?>" type="text" class="textfm" style="width:100px;ime-mode:disabled;" value="<?=$job_fee_limit[$m]?>" maxlength="14" onKeyPress="only_number()" onkeyup="checkThousand(this.value, this,'Y');" onblur="checkThousand(this.value, this,'Y');" />원
										<br />
										<input name="job_fee2_year<?=$k?>" type="text" class="textfm" style="width:50px;ime-mode:disabled;" value="<?=$job_fee2_year[$m]?>" maxlength="4" />년
										<input name="job_fee2_limit<?=$k?>" type="text" class="textfm" style="width:100px;ime-mode:disabled;" value="<?=$job_fee2_limit[$m]?>" maxlength="14" onKeyPress="only_number()" onkeyup="checkThousand(this.value, this,'Y');" onblur="checkThousand(this.value, this,'Y');" />원
									</td>
								</tr>
								<tr id="tr_education<?=$k?>d" style="<? if($count_job < $job_no) echo "display:none"; ?>">
									<td class="tdrowk" width="" colspan="7" style="padding:0;">
										<table width="100%" border="0" cellpadding="0" cellspacing="0" class="" style="">
<?
//직무교육 최대 갯수
$job_opt_limit = 10;
//직무교육 DB
$sql_job_opt = " select count(*) as cnt from job_education_opt where mid='$idx' and step='$job_no' ";
$row_job_opt = sql_fetch($sql_job_opt);
$count_job_opt = $row_job_opt['cnt'];
if(!$count_job_opt) $count_job_opt = 1;
$sql_job_opt = " select * from job_education_opt where mid='$idx' and step='$job_no' order by id asc ";
//echo $sql_job_opt;
$result_job_opt = sql_query($sql_job_opt);
for($i=0; $row_job_opt=sql_fetch_array($result_job_opt); $i++) {
	$id_opt[$m][$i] = $row_job_opt['id'];
	$train_kind[$m][$i] = $row_job_opt['train_kind'];
	$job_teaching_material[$m][$i] = $row_job_opt['job_teaching_material'];
	$education_send[$m][$i] = $row_job_opt['education_send'];
	$education_send_no[$m][$i] = $row_job_opt['education_send_no'];
	$education_conduct_report[$m][$i] = $row_job_opt['education_conduct_report'];
	$education_close_date[$m][$i] = $row_job_opt['education_close_date'];
	$job_complete[$m][$i] = $row_job_opt['job_complete'];
	$job_complete_date[$m][$i] = $row_job_opt['job_complete_date'];
	$job_fee[$m][$i] = $row_job_opt['job_fee'];
	$job_fee_date[$m][$i] = $row_job_opt['job_fee_date'];
	$job_memo[$m][$i] = $row_job_opt['job_memo'];
}
$count_job_opt = $count_job_opt;
//직무교육(회차) 반복문 시작
for($job_opt_no=1; $job_opt_no <= $job_opt_limit; $job_opt_no++) {
	$t = $job_opt_no;
	if($t == 1) $t = "";
	$n = $job_opt_no-1;
?>
											<tr id="tr_education<?=$k?>_opt<?=$t?>" style="<? if($count_job_opt < $job_opt_no) echo "display:none"; ?>">
												<td class="tdrowk" width="67" rowspan="4" style="<? if($job_opt_no >= 2) echo "border-top:1px solid #cccccc;"; ?>border-right:1px solid #cccccc;"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">
													<?=$job_opt_no?>차교육
<?
//1차교육 에서만 표시
if($job_opt_no == 1) {
?>
													<div style="padding:4px 0 0 5px">
														<a href="javascript:field_opt_add('tr_education<?=$k?>_opt', 'job_opt_count<?=$k?>');"><img src="images/btn_add.png" align="absmiddle" border="0"></a>
														<a href="javascript:field_opt_del('tr_education<?=$k?>_opt', 'job_opt_count<?=$k?>');"><img src="images/btn_del.png" align="absmiddle" border="0"></a>
													</div>
<?
} //if문 종료
?>
												</td>
												<td class="tdrowk" style="border-right:1px solid #cccccc;<? if($job_opt_no >= 2) echo "border-top:1px solid #cccccc;"; ?>">
													<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">교육구분
												</td>
												<td width="150" class="tdrow" style="border-right:1px solid #cccccc;<? if($job_opt_no >= 2) echo "border-top:1px solid #cccccc;"; ?>">
													<select name="train_kind<?=$k?>_<?=$t?>" class="selectfm" style="font-weight:normal;">
														<option value="" >선택</option>
														<option value="1" <? if($train_kind[$m][$n] == 1) echo "selected"; ?>>집체</option>
														<option value="2" <? if($train_kind[$m][$n] == 2) echo "selected"; ?>>현장</option>
														<option value="3" <? if($train_kind[$m][$n] == 3) echo "selected"; ?>>혼합</option>
													</select>
												</td>
												<td class="tdrowk" style="border-right:1px solid #cccccc;<? if($job_opt_no >= 2) echo "border-top:1px solid #cccccc;"; ?>">
													<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">우편물발송
												</td>
												<td class="tdrow" style="border-right:1px solid #cccccc;<? if($job_opt_no >= 2) echo "border-top:1px solid #cccccc;"; ?>">
													<input type="checkbox" name="job_teaching_material<?=$k?>_<?=$t?>" value="1" <? if($job_teaching_material[$m][$n] == 1) echo "checked"; ?> style="vertical-align:middle" title="교재발송" onclick="checkbox_today(this, 'education_send<?=$k?>_<?=$t?>');" />
													<input name="education_send<?=$k?>_<?=$t?>" type="text" class="textfm" style="width:70px;ime-mode:disabled;" value="<?=$education_send[$m][$n]?>" maxlength="30" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
												</td>
												<td class="tdrowk" style="border-right:1px solid #cccccc;<? if($job_opt_no >= 2) echo "border-top:1px solid #cccccc;"; ?>">
													<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">운송장번호
												</td>
												<td class="tdrow" style="<? if($job_opt_no >= 2) echo "border-top:1px solid #cccccc;"; ?>">
													<input name="education_send_no<?=$k?>_<?=$t?>" type="text" class="textfm" style="width:150px;ime-mode:disabled;" value="<?=$education_send_no[$m][$n]?>" maxlength="30" onKeyPress="only_number_comma();" />
												</td>
											</tr>
											<tr id="tr_education<?=$k?>_opt<?=$t?>b" style="<? if($count_job_opt < $job_opt_no) echo "display:none"; ?>">
												<td class="tdrowk" style="border-top:1px solid #cccccc;border-right:1px solid #cccccc;">
													<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">교육실시일
												</td>
												<td class="tdrow" style="border-top:1px solid #cccccc;border-right:1px solid #cccccc;">
													<input name="education_conduct_report<?=$k?>_<?=$t?>" type="text" class="textfm" style="width:70px;ime-mode:disabled;" value="<?=$education_conduct_report[$m][$n]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
													<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.education_conduct_report<?=$k?>_<?=$t?>);" target="">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
												</td>
												<td class="tdrowk" style="border-top:1px solid #cccccc;border-right:1px solid #cccccc;">
													<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">교육종료일
												</td>
												<td class="tdrow" style="border-top:1px solid #cccccc;border-right:1px solid #cccccc;">
													<input name="education_close_date<?=$k?>_<?=$t?>" type="text" class="textfm" style="width:70px;ime-mode:disabled;" value="<?=$education_close_date[$m][$n]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
													<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.education_close_date<?=$k?>_<?=$t?>);" target="">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
												</td>
												<td class="tdrowk" style="border-top:1px solid #cccccc;border-right:1px solid #cccccc;">
													<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">수료보고
												</td>
												<td class="tdrow" style="border-top:1px solid #cccccc;">
													<select name="job_complete<?=$k?>_<?=$t?>" class="selectfm" onchange="input_today(this,'job_complete_date<?=$k?>_<?=$t?>','1')">
														<option value=""  <? if($job_complete[$m][$n] == "")  echo "selected"; ?>>선택</option>
														<option value="1" <? if($job_complete[$m][$n] == "1") echo "selected"; ?>>완료</option>
														<option value="2" <? if($job_complete[$m][$n] == "2") echo "selected"; ?>>보류</option>
														<option value="3" <? if($job_complete[$m][$n] == "3") echo "selected"; ?>>반려</option>
														<option value="4" <? if($job_complete[$m][$n] == "4") echo "selected"; ?>>취소</option>
													</select>
												</td>
											</tr>
											<tr id="tr_education<?=$k?>_opt<?=$t?>c" style="<? if($count_job_opt < $job_opt_no) echo "display:none"; ?>">
												<td class="tdrowk" style="border-top:1px solid #cccccc;border-right:1px solid #cccccc;">
													<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">수료보고일
												</td>
												<td class="tdrow" style="border-top:1px solid #cccccc;border-right:1px solid #cccccc;">
													<input name="job_complete_date<?=$k?>_<?=$t?>" type="text" class="textfm" style="width:70px;ime-mode:disabled;" value="<?=$job_complete_date[$m][$n]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
													<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.job_complete_date<?=$k?>_<?=$t?>);" target="">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
												</td>
												<td class="tdrowk" style="border-top:1px solid #cccccc;border-right:1px solid #cccccc;">
													<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">지원금
												</td>
												<td class="tdrow" style="border-top:1px solid #cccccc;border-right:1px solid #cccccc;">
<?
//신청금액
if($job_fee[$m][$n]) $job_fee[$m][$n] = number_format($job_fee[$m][$n]);
else $job_fee[$m][$n] = "";
?>
													<input name="job_fee<?=$k?>_<?=$t?>" type="text" class="textfm" style="width:92px;ime-mode:disabled;" value="<?=$job_fee[$m][$n]?>" onKeyPress="only_number()" onkeyup="checkThousand(this.value, this,'Y');" onblur="checkThousand(this.value, this,'Y');">
												</td>
												<td class="tdrowk" style="border-top:1px solid #cccccc;border-right:1px solid #cccccc;">
													<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">입금일
												</td>
												<td class="tdrow" style="border-top:1px solid #cccccc;">
													<input name="job_fee_date<?=$k?>_<?=$t?>" type="text" class="textfm" style="width:70px;ime-mode:disabled;" value="<?=$job_fee_date[$m][$n]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
													<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.job_fee_date<?=$k?>_<?=$t?>);" target="">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
												</td>
											</tr>
											<tr id="tr_education<?=$k?>_opt<?=$t?>d" style="<? if($count_job_opt < $job_opt_no) echo "display:none"; ?>">
												<td class="tdrow" colspan="6" style="border-top:1px solid #cccccc;">
													<input name="job_memo<?=$k?>_<?=$t?>" type="text" class="textfm" style="width:100%;" value="<?=$job_memo[$m][$n]?>">
													<input type="hidden" name="id_opt<?=$k?>_<?=$t?>" value="<?=$id_opt[$m][$n]?>">
												</td>
											</tr>
<?
} //for문 종료
?>
										</table>
										<input type="hidden" name="job_opt_count<?=$k?>" value="<?=$count_job_opt?>">
									</td>
								</tr>
<?
}
//직무교육 반복문 종료
?>
							</table>
							<input type="hidden" name="job_count_old" value="<?=$count_job?>">
							<input type="hidden" name="job_count" value="<?=$count_job?>">

							<div style="height:10px;font-size:0px"></div>
							<!--댑메뉴 -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:120px;text-align:center'> 
													직무교육 첨부서류
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
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
								<tr>
									<td nowrap class="tdrowk" width="112">
										<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">첨부서류목록
									</td>
									<td nowrap  class="tdrow" width="" colspan="">
<?
//echo count($job_file_check_array);
$job_file_check_cnt = count($job_file_check_array);
$job_file_check = explode(',',$row['job_file_check']);
	for($i=0;$i<$job_file_check_cnt;$i++) {
		$k = $i + 1;
?>
										<input type="checkbox" name="job_file_check<?=$k?>" value="1" <? if($job_file_check[$i] == 1) echo "checked"; ?> style="vertical-align:middle"><?=$job_file_check_array[$i]?>
<?
}
//파일명 날짜 시간 제거 표시 160201
if($row['job_file_1']) $job_file_1 = mb_substr($row['job_file_1'],16,99,'euc-kr');
if($row['job_file_2']) $job_file_2 = mb_substr($row['job_file_2'],16,99,'euc-kr');
if($row['job_file_3']) $job_file_3 = mb_substr($row['job_file_3'],16,99,'euc-kr');
if($row['job_file_4']) $job_file_4 = mb_substr($row['job_file_4'],16,99,'euc-kr');
if($row['job_file_5']) $job_file_5 = mb_substr($row['job_file_5'],16,99,'euc-kr');
if($row['job_file_6']) $job_file_6 = mb_substr($row['job_file_6'],16,99,'euc-kr');
if($row['job_file_7']) $job_file_7 = mb_substr($row['job_file_7'],16,99,'euc-kr');
if($row['job_file_8']) $job_file_8 = mb_substr($row['job_file_8'],16,99,'euc-kr');
?>
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk" width="" rowspan="8">
										<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">첨부파일
									</td>
									<td   class="tdrow" width="" colspan="">
										<div style="padding-top:4px;">
											<b>파일1</b> <input type="checkbox" name="job_file_del_1" value="1" style="vertical-align:middle">삭제
											<input name="job_file_1" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;">
											<a href="files/job_file/<?=$row['job_file_1']?>" target="_blank"><?=$job_file_1?></a>
											<input type="hidden" name="p_file_1" value="<?=$row['job_file_1']?>">
										</div>
									</td>
								</tr>
								<tr>
									<td   class="tdrow" colspan="3">
										<div style="padding-top:4px;">
											<b>파일2</b> <input type="checkbox" name="job_file_del_2" value="1" style="vertical-align:middle">삭제
											<input name="job_file_2" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;">
											<a href="files/job_file/<?=$row['job_file_2']?>" target="_blank"><?=$job_file_2?></a>
											<input type="hidden" name="p_file_2" value="<?=$row['job_file_2']?>">
										</div>
									</td>
								</tr>
								<tr>
									<td   class="tdrow" colspan="3">
										<div style="padding-top:4px;">
											<b>파일3</b> <input type="checkbox" name="job_file_del_3" value="1" style="vertical-align:middle">삭제
											<input name="job_file_3" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;">
											<a href="files/job_file/<?=$row['job_file_3']?>" target="_blank"><?=$job_file_3?></a>
											<input type="hidden" name="p_file_3" value="<?=$row['job_file_3']?>">
										</div>
									</td>
								</tr>
								<tr>
									<td   class="tdrow" colspan="3">
										<div style="padding-top:4px;">
											<b>파일4</b> <input type="checkbox" name="job_file_del_4" value="1" style="vertical-align:middle">삭제
											<input name="job_file_4" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;">
											<a href="files/job_file/<?=$row['job_file_4']?>" target="_blank"><?=$job_file_4?></a>
											<input type="hidden" name="p_file_4" value="<?=$row['job_file_4']?>">
										</div>
									</td>
								</tr>
								<tr>
									<td   class="tdrow" colspan="3">
										<div style="padding-top:4px;">
											<b>파일5</b> <input type="checkbox" name="job_file_del_5" value="1" style="vertical-align:middle">삭제
											<input name="job_file_5" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;">
											<a href="files/job_file/<?=$row['job_file_5']?>" target="_blank"><?=$job_file_5?></a>
											<input type="hidden" name="p_file_5" value="<?=$row['job_file_5']?>">
										</div>
									</td>
								</tr>
								<tr>
									<td   class="tdrow" colspan="3">
										<div style="padding-top:4px;">
											<b>파일6</b> <input type="checkbox" name="job_file_del_6" value="1" style="vertical-align:middle">삭제
											<input name="job_file_6" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;">
											<a href="files/job_file/<?=$row['job_file_6']?>" target="_blank"><?=$job_file_6?></a>
											<input type="hidden" name="p_file_6" value="<?=$row['job_file_6']?>">
										</div>
									</td>
								</tr>
								<tr>
									<td   class="tdrow" colspan="3">
										<div style="padding-top:4px;">
											<b>파일7</b> <input type="checkbox" name="job_file_del_7" value="1" style="vertical-align:middle">삭제
											<input name="job_file_7" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;">
											<a href="files/job_file/<?=$row['job_file_7']?>" target="_blank"><?=$job_file_7?></a>
											<input type="hidden" name="p_file_7" value="<?=$row['job_file_7']?>">
										</div>
									</td>
								</tr>
								<tr>
									<td   class="tdrow" colspan="3">
										<div style="padding-top:4px;">
											<b>파일8</b> <input type="checkbox" name="job_file_del_8" value="1" style="vertical-align:middle">삭제
											<input name="job_file_8" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;">
											<a href="files/job_file/<?=$row['job_file_8']?>" target="_blank"><?=$job_file_8?></a>
											<input type="hidden" name="p_file_8" value="<?=$row['job_file_8']?>">
										</div>
									</td>
								</tr>
							</table>

							<div style="height:20px;font-size:0px"></div>
							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
								<tr>
									<td align="center">
<?
//권한별 링크값 : 전체 권한
if($member['mb_level'] == 0) {
	$url_save = "javascript:alert_no_right();";
} else {
	$url_save = "javascript:checkData();";
}
?>
										<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="<?=$url_save?>" target="">저 장</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
										<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="<?=$url_list?>" target="">목 록</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
										<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./client_view.php?w=<?=$w?>&id=<?=$com_code?>" target="">거래처정보</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
										<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./client_process_view.php?w=<?=$w?>&id=<?=$com_code?>" target="">접수처리현황</a></td><td><img src=images/btn_rt.gif></td><td width="2"></td></tr></table>
<?
if($job_fee[0][0]) {
?>
										<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./client_application_view.php?w=<?=$w?>&id=<?=$com_code?>">지원금현황</a></td><td><img src=images/btn_rt.gif></td><td width="2"></td></tr></table>
<?
}
?>
										<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./list_notice.php?bo_table=erp_job_education">스케줄</a></td><td><img src="images/btn_rt.gif" /></td><td width="2"></td></tr></table>
									</td>
								</tr>
							</table>
<?
//수정일 경우 표시
if($w) {
	//전달사항 알림 전달 사업주훈련 ID 150917
	$job_id = $id;
	$memo_type = 4;
	include "inc/client_comment_only.php";
}
?>
						</div>
						<div style="height:20px;font-size:0px"></div>

						<div style="height:20px;font-size:0px"></div>
						<input type="hidden" name="url" value="./<?=$_SERVER['PHP_SELF']?>">
						<input type="hidden" name="w" value="<?=$w?>">
						<input type="hidden" name="id" value="<?=$id?>">
						<input type="hidden" name="page" value="<?=$page?>">
						</form><!-- dataForm end -->
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<script type="text/javascript">
//ifram height 자동 조정
function resizeFrame(frm) {
	frm.style.height = "auto";
	contentHeight = frm.contentWindow.document.documentElement.scrollHeight;
	frm.style.height = contentHeight + 0 + "px";
}
//span 태그 내용 변경
function span_onchange(id, span_id) {
	var id_value = id.value;
	var hrd_korea_tel = [0];
	var hrd_korea_area = [0];
<?
for($i=1;$i<=24;$i++) {
?>
	hrd_korea_tel.push("<?=$hrd_korea_tel[$i]?>");
	hrd_korea_area.push("<?=$hrd_korea_area[$i]?>");
<?
}
?>
	//console.log(hrd_korea_area);
	if(id.value) {
		getId(span_id).innerHTML = hrd_korea_area[id_value]+"("+hrd_korea_tel[id_value]+")";
	} else {
		getId(span_id).innerHTML = "공단지사를 선택하세요.";
	}
}
</script>
<? include "./inc/bottom.php";?>
</body>
</html>
