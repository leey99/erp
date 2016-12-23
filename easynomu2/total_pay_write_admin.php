<?
$sub_menu = "300100";
include_once("./_common.php");
$is_admin = "super";
$year = "2013";

// 수정 상태만 작동
if($w == "u") {
	$result1=mysql_query("select * from total_pay where id = $id");
	$row1=mysql_fetch_array($result1);
	$t_no = $row1[t_no];
	$comp_bznb = $row1[comp_bznb];
	$comp_name = $row1[comp_name];
	$boss_name = $row1[boss_name];
	$adr_zip = explode("-",$row1[adr_zip]);
	$adr_zip1 = $adr_zip[0];
	$adr_zip2 = $adr_zip[1];
	$adr_adr1 = $row1[adr_adr1];
	$adr_adr2 = $row1[adr_adr2];
	$sj_upjong_code = $row1[sj_upjong_code];
	$sj_upjong = $row1[sj_upjong];
	$sj_percent = $row1[sj_percent];
	$comp_email = $row1[comp_email];
	$comp_tel = $row1[comp_tel];
	$comp_fax = $row1[comp_fax];
	//근로자 신고건수
	$result2=mysql_query("select count(*) as cnt from total_pay_opt where mid = $id");
	$row2=mysql_fetch_array($result2);
	if($row2[cnt] < 6) {
		$worker_count = 5;
	} else {
		$worker_count = $row2[cnt];
	}
} else {
	$worker_count = 5;
}

// 로그인 시 사업자정보 로그인
if(!$row1[comp_name]) {
	$sql_a4 = " select * from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
	$row_a4 = sql_fetch($sql_a4);
	$row1[comp_name] = $row_a4[com_name];
	$row1[comp_adr]  = $row_a4[com_juso]." ".$row_a4[com_juso2];
	$row1[comp_bznb] = $row_a4[t_insureno];
	$row1[comp_tel]  = $row_a4[com_tel];
}

$sub_title = $year."년도 보수총액신고";
$g4[title] = $sub_title." : 보수총액신고 : ".$easynomu_name;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
<script language="javascript">
function checkData() {
	var frm = document.dataForm;
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
	if (frm.boss_name.value == "")
	{
		alert("대표자를 입력하세요.");
		frm.boss_name.focus();
		return;
	}
	if (frm.adr_adr1.value == "")
	{
		alert("사업장소재지를 입력하세요.");
		frm.adr_adr1.focus();
		return;
	}
	if (frm.comp_tel.value == "")
	{
		alert("전화번호를 입력하세요.");
		frm.comp_tel.focus();
		return;
	}
	if (frm.name_1.value == "")
	{
		alert("근로자 성명을 입력하세요.");
		frm.name_1.focus();
		return;
	}
	if (frm.ssnb_1.value == "")
	{
		alert("근로자 주민등록번호를 입력하세요.");
		frm.ssnb_1.focus();
		return;
	}
	if(frm.agree_check1.checked == false) {
		alert("직접 작성 확인에 체크해 주세요.");
		frm.agree_check1.focus();
		return;
	}
	document.getElementById('save_bt').style.display = "none";
	document.getElementById('save_ing').style.display = "inline";

	frm.action = "total_pay_update_admin.php";
	frm.submit();
	return;
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
	//탭 시프트+탭 좌 우 Home
	if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36) {
		if (inputVal.length > 3) {
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
			for(i=chk; i>0; i--) {
				triple = i * 3;					// 3의 배수 계산 9,6,3 등과 같은 순으로
				end = Number(input.length)-Number(triple);	// 이 때의 end 값은 점차 늘어 나게 된다.
				total += input.substring(start,end)+",";	// total은 앞에서 부터 차례로 붙인다.
				start = end;					// end 값은 다음번의 start 값으로 들어간다.
			}
			total +=input.substring(start,input.length);		// 최종적으로 마지막 3자리 수를 뒤에 붙힌다.
		} else {
			total = inputVal;					// 3의 배수가 되기 이전에는 값이 그대로 유지된다.
		}
		if(keydown =='Y') {
			type.value=total;					// type 에 따라 최종값을 넣어 준다.
		}else if(keydown =='N') {
			return total
		}
		return total
	}
}
function delCom(inputVal, count) {
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!=','){		// 먼저 substring을 위해
			tmp += inputVal.substring(i,i+1);	// 값의 모든 , 를 제거
		}
	}
	return tmp;
}
//날짜 입력 콤마
function checkcomma(inputVal, type, keydown) {		// inputVal은 천단위에 , 표시를 위해 가져오는 값
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
	input = delcomma(inputVal, inputVal.length);
	//관리자 master 입력
	//alert(input);
	//백스페이스 탭 시프트+탭 좌 우 Del
	if(event.keyCode!=8 && event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=46) {
		//alert(inputVal.length);
		//alert(input);
		if(inputVal.length == 4){
			//input = delhyphen(inputVal, inputVal.length);
			total += input.substring(0,4)+".";
			//alert(type.name);
		} else if(inputVal.length == 7){
			total += inputVal.substring(0,7)+".";
		} else if(inputVal.length == 12){
			total += inputVal.substring(0,14)+"";
		} else {
			total += inputVal;
		}
		if(keydown =='Y'){
			type.value = total;
		}else if(keydown =='N'){
			return total;
		}
	}
	return total;
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
function only_number_hyphen() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if(event.keyCode != 45) event.returnValue = false;
	}
}
function only_number() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		event.returnValue = false;
	}
}
function open_comp() {
	var frm = document.dataForm;
	n = frm.comp_bznb.value;
	if(frm.comp_bznb.value == "") {
		alert("사업자등록번호를 입력 후 검색해 주십시오.");
		frm.comp_bznb.focus();
		return;
	}
	window.open("popup/comp_bznb_popup.php?comp_bznb="+n, "comp_popup", "width=540, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
}
function open_sj_upjong(n) {
	window.open("popup/sj_upjong_popup.php?n=_"+n, "sj_upjong_popup", "width=640, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
}
function iframe_focus(rowNum,nhicRowNum) {
	//빈함수
}
function value_set(n,m) {
	//빈함수
}
//천단위 콤바
function checkBznb(inputVal, type, keydown) {		// inputVal은 천단위에 , 표시를 위해 가져오는 값
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
	if(input.substring(0,3) == "mas" || input.substring(0,3) == "use" || input.substring(0,3) == "gue") {
		//master
	} else {
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
//주민등록번호 입력 하이픈
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
		//백스페이스 탭 시프트+탭 좌 우 Del
		if(event.keyCode!=8 && event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=46) {
			//alert(inputVal.length);
			//alert(input);
			if(inputVal.length == 6){
				//input = delhyphen(inputVal, inputVal.length);
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
}
//우편번호 입력 하이픈
function checkhyphen_post(inputVal, type, keydown) {
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
	if(event.keyCode != 8) {
		if(inputVal.length == 3){
			total += input.substring(0,3)+"-";
		} else {
			total += inputVal;
		}
		if(keydown =='Y'){
			type.value = total;
		}else if(keydown =='N'){
			return total;
		}
	}
	return total;
}
function tab_view(tab) {
	var obj = document.getElementById(tab);
	if(obj.style.display == "none") {
		obj.style.display = "";
	} else {
		obj.style.display = "none";
	}
}
function worker_count_apply() {
	main = document.dataForm;
	//alert(main.worker_count.value);
	worker_count = main.worker_count.value;
	if(worker_count > 80) {
		alert("최대 80명까지 등록 가능합니다.");
		main.worker_count.focus();
		return;
	}
	for(i=1;i<=worker_count;i++) {
		document.getElementById('worker_tr'+i).style.display = "";
	}
}
function checkAddress(strgbn) {
	var ret = window.open("../road_address/search.php", "address", "width=496,height=522,scrollbars=0");
	return;
}
//산재보험 연간보수총액 합계
function sj_ypay_sum() {
	frm = document.dataForm;
	worker_count = frm.worker_count.value;
	sj_ysum = 0;
	//alert(frm.sj_ypay1.value);
	for(i=1;i<=worker_count;i++) {
		sj_ysum += toInt(frm['sj_ypay_'+i].value);
		//alert(frm['sj_ypay_'+i].value);
	}
	sj_ysum += toInt(frm['temp_sj_ypay'].value);
	sj_ysum += toInt(frm['etc_sj_ypay'].value);
	sj_ysum += toInt(frm['etc2_sj_ypay'].value);
	frm.sj_ysum.value = setComma(sj_ysum);
}
//고용보험 연간보수총액 합계 1~6월
function gy_ypay_sum() {
	frm = document.dataForm;
	worker_count = frm.worker_count.value;
	gy_ysum = 0;
	for(i=1;i<=worker_count;i++) {
		gy_ysum += toInt(frm['gy_ypay_'+i].value);
	}
	gy_ysum += toInt(frm['temp_gy_ypay'].value);
	frm.gy_ysum.value = setComma(gy_ysum);
}
//고용보험 연간보수총액 합계 7~12월
function gy_ypay_sum2() {
	frm = document.dataForm;
	worker_count = frm.worker_count.value;
	gy_ysum2 = 0;
	for(i=1;i<=worker_count;i++) {
		gy_ysum2 += toInt(frm['gy_ypay2_'+i].value);
	}
	gy_ysum2 += toInt(frm['temp_gy_ypay2'].value);
	frm.gy_ysum2.value = setComma(gy_ysum2);
}
//산재보험 -> 고용보험 복사
function worker_copy() {
	frm = document.dataForm;
	worker_count = frm.worker_count.value;
	for(i=1;i<=worker_count;i++) {
		frm['gy_sdate_'+i].value = frm['sj_sdate_'+i].value;
		frm['gy_edate_'+i].value = frm['sj_edate_'+i].value;
		//frm['gy_ypay_'+i].value = frm['sj_ypay_'+i].value;
		frm['gy_mpay_'+i].value = frm['sj_mpay_'+i].value;
	}
	//frm.temp_gy_ypay.value = frm.temp_sj_ypay.value;
	gy_ypay_sum();
}
//산재보험 -> 건강보험 복사
function worker_copy_gg() {
	frm = document.dataForm;
	worker_count = frm.worker_count.value;
	for(i=1;i<=worker_count;i++) {
		frm['gg_sdate_'+i].value = frm['sj_sdate_'+i].value;
		frm['gg_ypay_'+i].value = frm['sj_ypay_'+i].value;
	}
	frm.temp_gg_ypay.value = frm.temp_sj_ypay.value;
	frm.etc_gg_ypay.value = frm.etc_sj_ypay.value;
	frm.etc2_gg_ypay.value = frm.etc2_sj_ypay.value;
	gg_ypay_sum();
}
//건강보험 연간보수총액 합계
function gg_ypay_sum() {
	frm = document.dataForm;
	worker_count = frm.worker_count.value;
	gg_ysum = 0;
	for(i=1;i<=worker_count;i++) {
		gg_ysum += toInt(frm['gg_ypay_'+i].value);
	}
	gg_ysum += toInt(frm['temp_gg_ypay'].value);
	gg_ysum += toInt(frm['etc_gg_ypay'].value);
	gg_ysum += toInt(frm['etc2_gg_ypay'].value);
	frm.gg_ysum.value = setComma(gg_ysum);
}
function u_total_copy() {
	frm = document.dataForm;
	for(i=1;i<=5;i++) {
		frm['u_gy_sdate'+i].value = frm['u_sj_sdate'+i].value;
		frm['u_gy_edate'+i].value = frm['u_sj_edate'+i].value;
		frm['u_gy_mpay'+i].value = frm['u_sj_mpay'+i].value;
	}
	gy_ypay_sum();
}
</script>
<? include "./inc/top_admin.php"; ?>
<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="1240" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100%" valign="top" style="padding:10px 10px 10px 10px">
							<div style="">
							<!--타이틀 -->
							<table width="100%" border=0 cellspacing=0 cellpadding=0>
								<tr>     
									<td height="18">
										<table width=100% border=0 cellspacing=0 cellpadding=0>
											<tr>
												<td style='font-size:8pt;color:#929292;'><img src="images/g_title_icon.gif" align=absmiddle  style='margin:0 5 2 0'><span style='font-size:9pt;color:black;'><?=$sub_title?></span>
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
<style type="text/css">
.textfm,.textfm5 {
	font-size:8pt;
	border:1px solid #cccccc;
	height:22px;
	background:#ffffff;
}
</style>
							<!--데이터 -->
							<form name="dataForm" method="post">
								<input type="hidden" name="w" value="<?=$w?>">
								<input type="hidden" name="id" value="<?=$row1[id]?>">
								<input type="hidden" name="page" value="<?=$page?>">
								<input type="hidden" name="year" value="<?=$year?>">
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
									<col width="120">
									<col width="320">
									<col width="112">
									<col width="230">
									<col width="110">
									<col width="">
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사업자등록번호<font color="red">*</font></td>
										<td nowrap class="tdrow">
											<input name="comp_bznb" id="comp_bznb" type="text" class="textfm" style="width:100px;" value="<?=$comp_bznb?>" maxlength="12" onkeyup="checkBznb(this.value, '1','Y')" >
											<label onclick="open_comp();" style="cursor:pointer"><img src="images/search_bt.png" align=absmiddle></label>
											예) 123-12-12345
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사업장명칭<font color="red">*</font></td>
										<td nowrap class="tdrow">
											<input name="comp_name" id="comp_name" type="text" class="textfm" style="width:223px;" value="<?=$comp_name?>" maxlength="25">
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">대표자<font color="red">*</font></td>
										<td nowrap class="tdrow">
											<input name="boss_name" id="boss_name" type="text" class="textfm" style="width:100px;" value="<?=$boss_name?>" maxlength="6"> 사업장관리번호 : <span id="t_no"><?=$t_no?></span>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사업장소재지<font color="red">*</font></td>
										<td nowrap class="tdrow" colspan="3">
											<input name="adr_zip1" type="text" class="textfm" style="width:30px;ime-mode:active;" value="<?=$adr_zip1?>" readonly>
											-
											<input name="adr_zip2" type="text" class="textfm" style="width:30px;ime-mode:active;" value="<?=$adr_zip2?>" readonly>
											<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:checkAddress('cust');" target="">주소찾기</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
											<input name="adr_adr1" type="text" class="textfm" style="width:270px;ime-mode:active;" value="<?=$adr_adr1?>" readonly>
											<input name="adr_adr2" type="text" class="textfm" style="width:250px;ime-mode:active;" value="<?=$adr_adr2?>" maxlength="150">
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">산재업종</td>
										<td nowrap class="tdrow">
											<input name="sj_upjong_code" id="sj_upjong_code" type="text" class="textfm" style="width:40px;" value="<?=$sj_upjong_code?>" maxlength="5" readonly>
											<input name="sj_upjong"  id="sj_upjong" type="text" class="textfm" style="width:180px;" value="<?=$sj_upjong?>" maxlength="25" readonly>
											<input name="sj_percent" id="sj_percent" type="text" class="textfm" style="width:40px;" value="<?=$sj_percent?>" maxlength="25" readonly> %
											<label onclick="open_sj_upjong();" style="cursor:pointer"><img src="images/search_bt.png" align=absmiddle></label>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">이메일<font color="red">*</font></td>
										<td nowrap class="tdrow">
											<input name="comp_email" id="comp_email" type="text" class="textfm" style="width:210px;" value="<?=$comp_email?>" maxlength="30">
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">전화번호<font color="red">*</font></td>
										<td nowrap class="tdrow">
											<input name="comp_tel" id="comp_tel" type="text" class="textfm" style="width:100px;" value="<?=$comp_tel?>" maxlength="15"> 예) 055-1234-1234
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">팩스번호<font color="red"></font></td>
										<td nowrap class="tdrow">
											<input name="comp_fax" id="comp_fax" type="text" class="textfm" style="width:100px;" value="<?=$comp_fax?>" maxlength="15"> 예) 055-1234-1234
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>

								<table border=0 cellspacing=0 cellpadding=0> 
									<tr> 
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'>
													근로자 보수총액
													</td> 
													<td><img src="images/g_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=4></td> 
										<td valign="bottom">
											<input name="worker_count" type="text" class="textfm" style="width:30px;ime-mode:active;" value="<?=$worker_count?>">명
											<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:worker_count_apply();" target="">적용</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
											(최대 80명까지 등록 가능)
										</td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--검색 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
									<tr>
										<td nowrap class="tdrowk_center" rowspan="3">성명<font color="red">*</font></td>
										<td nowrap class="tdrowk_center" rowspan="3">주민등록번호<font color="red">*</font></td>
										<td nowrap class="tdrowk_center" rowspan="3">보험료<br>부과<br>구분</td>
										<td nowrap class="tdrowk_center" colspan="4">산재보험</td>
										<td nowrap class="tdrowk_center" colspan="5">고용보험 <table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:worker_copy();" target="">복사</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table></td>
										<td nowrap class="tdrowk_center" colspan="3">건강보험 <table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:worker_copy_gg();" target="">복사</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table></td>
									</tr>
									<tr>
										<td nowrap class="tdrowk_center" rowspan="2">취득일</td>
										<td nowrap class="tdrowk_center" rowspan="2">상실일</td>
										<td nowrap class="tdrowk_center" rowspan="2">연간보수총액(원)</td>
										<td nowrap class="tdrowk_center" rowspan="2">월평균보수(원)</td>
										<td nowrap class="tdrowk_center" rowspan="2">취득일</td>
										<td nowrap class="tdrowk_center" rowspan="2">상실일</td>
										<td nowrap class="tdrowk_center" colspan="2">연간보수총액(원)</td>
										<td nowrap class="tdrowk_center" rowspan="2">월평균보수(원)</td>
										<td nowrap class="tdrowk_center" rowspan="2">자격취득<br>(변동)일</td>
										<td nowrap class="tdrowk_center" rowspan="2">연간보수총액(원)</td>
										<td nowrap class="tdrowk_center" rowspan="2">근무월수</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk_center" rowspan="">(1~6월)</td>
										<td nowrap class="tdrowk_center" rowspan="">(7~12월)</td>
									</tr>
<?
// 수정 상태만 작동
if($w == "u") {
	$result_opt = mysql_query("select * from total_pay_opt where mid = $id order by id asc");
	for($i=1; $row_opt=sql_fetch_array($result_opt); $i++) {
		$name[$i] = $row_opt[name1];
		$ssnb[$i] = $row_opt[ssnb1];
		$bohum_code[$i] = $row_opt[bohum_code1];
		$sj_sdate[$i] = $row_opt[sj_sdate1];
		$sj_edate[$i] = $row_opt[sj_edate1];
		$sj_ypay[$i] = number_format($row_opt[sj_ypay1]);
		$sj_mpay[$i] = number_format($row_opt[sj_mpay1]);
		$gy_sdate[$i] = $row_opt[gy_sdate1];
		$gy_edate[$i] = $row_opt[gy_edate1];
		$gy_ypay[$i] = number_format($row_opt[gy_ypay1]);
		$gy_ypay2[$i] = number_format($row_opt[gy_ypay2]);
		$gy_mpay[$i] = number_format($row_opt[gy_mpay1]);
		$gy_post[$i] = $row_opt[gy_post1];
		$gg_sdate[$i] = $row_opt[gg_sdate1];
		$gg_ypay[$i] = number_format($row_opt[gg_ypay1]);
		$gg_month[$i] = number_format($row_opt[gg_month1]);
	}
	$temp_sj_ypay = number_format($row1[temp_sj_ypay]);
	$temp_gy_ypay = number_format($row1[temp_gy_ypay]);
	$temp_gy_ypay2 = number_format($row1[temp_gy_ypay2]);
	$etc_sj_ypay = number_format($row1[etc_sj_ypay]);
	$etc2_sj_ypay = number_format($row1[etc2_sj_ypay]);
	$sj_ysum = number_format($row1[sj_ysum]);
	$gy_ysum = number_format($row1[gy_ysum]);
	$gy_ysum2 = number_format($row1[gy_ysum2]);
	$temp_gg_ypay = number_format($row1[temp_gg_ypay]);
	$etc_gg_ypay = number_format($row1[etc_gg_ypay]);
	$etc2_gg_ypay = number_format($row1[etc2_gg_ypay]);
	$gg_ysum = number_format($row1[gg_ysum]);
}

//엑셀 리더
if($excel) {
	include $_SERVER["DOCUMENT_ROOT"]."/PHPExcel/Classes/PHPExcel.php";
	$UpFileExt = "xls";
	$objPHPExcel = new PHPExcel();
	$upload_path = $_SERVER["DOCUMENT_ROOT"]."/total_pay";
	$upfile_path = $upload_path."/".$excel.".xls";
	if(file_exists($upfile_path)) {
		$inputFileType = 'Excel2007';
		if($UpFileExt == "xls") {
			$inputFileType = 'Excel5';	
		}
		$objReader = PHPExcel_IOFactory::createReaderForFile($upfile_path);
		$objPHPExcel = $objReader->load($upfile_path);
		$objPHPExcel ->setActiveSheetIndex(0);
		$objWorksheet = $objPHPExcel->getActiveSheet(); 
		$maxRow = $objWorksheet->getHighestRow(); 
		//echo $maxRow;
		for ($i = 0; $i < $maxRow; $i++) {
			$k = $i + 1;
			$excel_name[$i] = $objWorksheet->getCell('A' . $k)->getValue(); 
			$excel_ssnb[$i] = $objWorksheet->getCell('B' . $k)->getValue(); 
			$excel_bohum_code[$i] = $objWorksheet->getCell('C' . $k)->getValue(); 
			$excel_sj_sdate[$i] = $objWorksheet->getCell('D' . $k)->getValue(); 
			$excel_sj_edate[$i] = $objWorksheet->getCell('E' . $k)->getValue(); 
			$excel_gy_sdate[$i] = $objWorksheet->getCell('H' . $k)->getValue(); 
			$excel_gy_edate[$i] = $objWorksheet->getCell('I' . $k)->getValue(); 

			$name[$i] = iconv("UTF-8", "EUC-KR", $excel_name[$i]);
			$ssnb[$i] = substr($excel_ssnb[$i],0,6)."-".substr($excel_ssnb[$i],6,7);
			$bohum_code[$i] = $excel_bohum_code[$i];
			if($excel_sj_sdate[$i]) $sj_sdate[$i] = substr($excel_sj_sdate[$i],0,4).".".substr($excel_sj_sdate[$i],4,2).".".substr($excel_sj_sdate[$i],6,2);
			if($excel_sj_edate[$i]) $sj_edate[$i] = substr($excel_sj_edate[$i],0,4).".".substr($excel_sj_edate[$i],4,2).".".substr($excel_sj_edate[$i],6,2);
			if($excel_gy_sdate[$i]) $gy_sdate[$i] = substr($excel_gy_sdate[$i],0,4).".".substr($excel_gy_sdate[$i],4,2).".".substr($excel_gy_sdate[$i],6,2);
			if($excel_gy_edate[$i]) $gy_edate[$i] = substr($excel_gy_edate[$i],0,4).".".substr($excel_gy_edate[$i],4,2).".".substr($excel_gy_edate[$i],6,2);
		}
	}
}
//tr숨김
for($i=1;$i<81;$i++) {
	if($i > $worker_count) {
	 $worker_display[$i] = "display:none";
	}
?>
									<tr id="worker_tr<?=$i?>" style="<?=$worker_display[$i]?>" class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td nowrap class="ltrow1_center_h24"><input name="name_<?=$i?>" type="text" class="textfm" style="width:60px;"  value="<?=$name[$i]?>" maxlength="10"></td>
										<td nowrap class="ltrow1_center_h24"><input name="ssnb_<?=$i?>" type="text" class="textfm" style="width:98px;" value="<?=$ssnb[$i]?>" maxlength="14" onKeyPress="only_number();" onkeyup="checkhyphen_bupin_no(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="bohum_code_<?=$i?>" type="text" class="textfm" style="width:30px;" value="<?=$bohum_code[$i]?>" maxlength="2"></td>
										<td nowrap class="ltrow1_center_h24"><input name="sj_sdate_<?=$i?>" type="text" class="textfm" style="width:70px;" value="<?=$sj_sdate[$i]?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="sj_edate_<?=$i?>" type="text" class="textfm" style="width:70px;" value="<?=$sj_edate[$i]?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="sj_ypay_<?=$i?>" type="text" class="textfm" style="width:94px;" value="<?=$sj_ypay[$i]?>" maxlength="14" onkeypress="only_number();" onkeyup="sj_ypay_sum();checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="sj_mpay_<?=$i?>" type="text" class="textfm" style="width:90px;" value="<?=$sj_mpay[$i]?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="gy_sdate_<?=$i?>" type="text" class="textfm" style="width:70px;" value="<?=$gy_sdate[$i]?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="gy_edate_<?=$i?>" type="text" class="textfm" style="width:70px;" value="<?=$gy_edate[$i]?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="gy_ypay_<?=$i?>" type="text" class="textfm" style="width:94px;" value="<?=$gy_ypay[$i]?>" maxlength="14" onkeypress="only_number();" onkeyup="gy_ypay_sum();checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="gy_ypay2_<?=$i?>" type="text" class="textfm" style="width:94px;" value="<?=$gy_ypay2[$i]?>" maxlength="14" onkeypress="only_number();" onkeyup="gy_ypay_sum2();checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="gy_mpay_<?=$i?>" type="text" class="textfm" style="width:90px;" value="<?=$gy_mpay[$i]?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="gg_sdate_<?=$i?>" type="text" class="textfm" style="width:70px;"  value="<?=$gg_sdate[$i]?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="gg_ypay_<?=$i?>" type="text" class="textfm" style="width:94px;" value="<?=$gg_ypay[$i]?>" maxlength="14" onkeypress="only_number();" onkeyup="gg_ypay_sum();checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="gg_month_<?=$i?>" type="text" class="textfm" style="width:30px;" value="<?=$gg_month[$i]?>" maxlength="2"></td>
									</tr>
<?
}
?>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td nowrap class="ltrow1_center_h24" colspan="5">⑦ 일용근로자 보수총액</td>
										<td nowrap class="ltrow1_center_h24"><input name="temp_sj_ypay" type="text" class="textfm" style="width:94px;" value="<?=$temp_sj_ypay?>" maxlength="14" onkeypress="only_number();" onkeyup="sj_ypay_sum();checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"></td>
										<td nowrap class="ltrow1_center_h24"></td>
										<td nowrap class="ltrow1_center_h24"></td>
										<td nowrap class="ltrow1_center_h24"><input name="temp_gy_ypay" type="text" class="textfm" style="width:94px;" value="<?=$temp_gy_ypay?>" maxlength="14" onkeypress="only_number();" onkeyup="gy_ypay_sum();checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="temp_gy_ypay2" type="text" class="textfm" style="width:94px;" value="<?=$temp_gy_ypay2?>" maxlength="14" onkeypress="only_number();" onkeyup="gy_ypay_sum2();checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"></td>
										<td nowrap class="ltrow1_center_h24"></td>
										<td nowrap class="ltrow1_center_h24"><input name="temp_gg_ypay" type="text" class="textfm" style="width:94px;" value="<?=$temp_gg_ypay?>" maxlength="14" onkeypress="only_number();" onkeyup="gg_ypay_sum();checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"></td>
									</tr>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td nowrap class="ltrow1_center_h24" colspan="5">⑧ 그 밖의 근로자 보수총액(60시간 미만)</td>
										<td nowrap class="ltrow1_center_h24"><input name="etc_sj_ypay" type="text" class="textfm" style="width:94px;" value="<?=$etc_sj_ypay?>" maxlength="14" onkeypress="only_number();" onkeyup="sj_ypay_sum();checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"></td>
										<td nowrap class="ltrow1_center_h24"></td>
										<td nowrap class="ltrow1_center_h24"></td>
										<td nowrap class="ltrow1_center_h24"></td>
										<td nowrap class="ltrow1_center_h24"></td>
										<td nowrap class="ltrow1_center_h24"></td>
										<td nowrap class="ltrow1_center_h24"></td>
										<td nowrap class="ltrow1_center_h24"><input name="etc_gg_ypay" type="text" class="textfm" style="width:94px;" value="<?=$etc_gg_ypay?>" maxlength="14" onkeypress="only_number();" onkeyup="gg_ypay_sum();checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"></td>
									</tr>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td nowrap class="ltrow1_center_h24" colspan="5">⑧ 그 밖의 근로자 보수총액(외국인 근로자)</td>
										<td nowrap class="ltrow1_center_h24"><input name="etc2_sj_ypay" type="text" class="textfm" style="width:94px;" value="<?=$etc2_sj_ypay?>" maxlength="14" onkeypress="only_number();" onkeyup="sj_ypay_sum();checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"></td>
										<td nowrap class="ltrow1_center_h24"></td>
										<td nowrap class="ltrow1_center_h24"></td>
										<td nowrap class="ltrow1_center_h24"></td>
										<td nowrap class="ltrow1_center_h24"></td>
										<td nowrap class="ltrow1_center_h24"></td>
										<td nowrap class="ltrow1_center_h24"></td>
										<td nowrap class="ltrow1_center_h24"><input name="etc2_gg_ypay" type="text" class="textfm" style="width:94px;" value="<?=$etc2_gg_ypay?>" maxlength="14" onkeypress="only_number();" onkeyup="gg_ypay_sum();checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"></td>
									</tr>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td nowrap class="ltrow1_center_h24" colspan="5">⑨ 합 계</td>
										<td nowrap class="ltrow1_center_h24"><input name="sj_ysum" type="text" class="textfm5" readonly style="width:94px;" value="<?=$sj_ysum?>" ></td>
										<td nowrap class="ltrow1_center_h24"></td>
										<td nowrap class="ltrow1_center_h24"></td>
										<td nowrap class="ltrow1_center_h24"></td>
										<td nowrap class="ltrow1_center_h24"><input name="gy_ysum" type="text" class="textfm5" readonly style="width:94px;" value="<?=$gy_ysum?>" ></td>
										<td nowrap class="ltrow1_center_h24"><input name="gy_ysum2" type="text" class="textfm5" readonly style="width:94px;" value="<?=$gy_ysum2?>" ></td>
										<td nowrap class="ltrow1_center_h24"></td>
										<td nowrap class="ltrow1_center_h24"></td> 
										<td nowrap class="ltrow1_center_h24"><input name="gg_ysum" type="text" class="textfm5" readonly style="width:90px;" value="<?=$gg_ysum?>"></td>
										<td nowrap class="ltrow1_center_h24"></td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>
<?
$etc_count = explode(",",$row1[etc_count]);
?>
				<table border=0 cellspacing=0 cellpadding=0> 
					<tr> 
						<td id=""> 
							<table border=0 cellpadding=0 cellspacing=0> 
								<tr> 
									<td><img src="images/g_tab_on_lt.gif"></td> 
									<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:180;text-align:center'> 
									<a href="javascript:tab_view('temp_etc_count');">일용근로자 및 그밖의 근로자수</a>
									</td> 
									<td><img src="images/g_tab_on_rt.gif"></td> 
								</tr> 
							</table> 
						</td> 
						<td width=4></td> 
						<td valign="bottom"> ⑩ 일용근로자 및 그밖의 근로자수(명)</td>  
					</tr> 
				</table>
				<div style="height:2px;font-size:0px" class="bgtr"></div>
				<div style="height:2px;font-size:0px;line-height:0px;"></div>
				<!--검색 -->
				<div id="temp_etc_count" style="<?=$change_total_display?>">
				<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
					<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
						<td nowrap class="tdrowk_center">구분</td>
				<?
				for($i=1;$i<13;$i++) {
				?>
										<td nowrap class="tdrowk_center"><?=$i?>월</td>
				<?
				}
				?>
									</tr>

									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
						<td nowrap class="tdrowk_center">근로자수</td>
				<?
				for($i=1;$i<13;$i++) {
					$k = $i - 1;
				?>
										<td nowrap class="ltrow1_center_h24"><input name="etc_count<?=$i?>" type="text" class="textfm" style="width:40px;" value="<?=$etc_count[$k]?>" maxlength="3" onkeypress="only_number();"></td>
				<?
				}
				?>
					</tr>
				</table>
				</div>
				<!--검색 -->
				<div style="height:10px;font-size:0px;line-height:0px;"></div>
<?
$change_sdate = $row1[change_sdate];
$change_edate = $row1[change_edate];
if($change_sdate) {
	$change_total_display = "";
} else {
	$change_total_display = "display:none";
}
$now_sdate = $row1[now_sdate];
$now_edate = $row1[now_edate];
$change_ypay = number_format($row1[change_ypay]);
$now_ypay = number_format($row1[now_ypay]);
$etc_count = explode(",",$row1[etc_count]);
?>
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr> 
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:240;text-align:center'> 
													<a href="javascript:tab_view('change_total');">산재보험 업종변경 사업장 기간별 보수총액</a>
													</td> 
													<td><img src="images/g_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=4></td> 
										<td valign="bottom"> (연도 중 산재보험 업종변경이 있는 경우에만 기재)</td>  
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--검색 -->
								<div id="change_total" style="<?=$change_total_display?>">
								<table width="40%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
									<tr>
										<td nowrap class="tdrowk_center">구 분</td>
										<td nowrap class="tdrowk_center">업종변경 전</td>
										<td nowrap class="tdrowk_center">업종변경 후</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk_center">해당기간</td>
										<td nowrap class="tdrowk_center"><input name="change_sdate" type="text" class="textfm" style="width:70px;" value="<?=$change_sdate?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')">~<input name="change_edate" type="text" class="textfm" style="width:70px;" value="<?=$change_edate?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
										<td nowrap class="tdrowk_center"><input name="now_sdate"    type="text" class="textfm" style="width:70px;" value="<?=$now_sdate?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')">~<input name="now_edate" type="text" class="textfm" style="width:70px;" value="<?=$now_edate?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
									</tr>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td nowrap class="ltrow1_center_h24">사업장보수총액</td>
										<td nowrap class="ltrow1_center_h24"><input name="change_ypay" type="text" class="textfm" style="width:100px;" value="<?=$change_ypay?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> 원</td>
										<td nowrap class="ltrow1_center_h24"><input name="now_ypay" type="text" class="textfm" style="width:100px;" value="<?=$now_ypay?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> 원</td>
									</tr>
								</table>
								</div>
								<!--검색 -->
								<div style="height:10px;font-size:0px;line-height:0px;"></div>
<?
$u_name1 = $row1[u_name1];
if($u_name1) {
	$u_total_display = "";
	$u_ssnb1 = $row1[u_ssnb1];
	$u_bohum_code1 = $row1[u_bohum_code1];
	$u_sj_sdate1 = $row1[u_sj_sdate1];
	$u_sj_edate1 = $row1[u_sj_edate1];
	$u_sj_ypay1 = number_format($row1[u_sj_ypay1]);
	$u_sj_mpay1 = number_format($row1[u_sj_mpay1]);
	$u_gy_sdate1 = $row1[u_gy_sdate1];
	$u_gy_edate1 = $row1[u_gy_edate1];
	$u_loss_pay1 = number_format($row1[u_loss_pay1]);
	$u_hire_pay1 = number_format($row1[u_hire_pay1]);
	$u_gy_mpay1 = number_format($row1[u_gy_mpay1]);
} else {
	$u_total_display = "display:none";
}
$u_name2 = $row1[u_name2];
if($u_name2) {
	$u_ssnb2 = $row1[u_ssnb2];
	$u_bohum_code2 = $row1[u_bohum_code2];
	$u_sj_sdate2 = $row1[u_sj_sdate2];
	$u_sj_edate2 = $row1[u_sj_edate2];
	$u_sj_ypay2 = number_format($row1[u_sj_ypay2]);
	$u_sj_mpay2 = number_format($row1[u_sj_mpay2]);
	$u_gy_sdate2 = $row1[u_gy_sdate2];
	$u_gy_edate2 = $row1[u_gy_edate2];
	$u_loss_pay2 = number_format($row1[u_loss_pay2]);
	$u_hire_pay2 = number_format($row1[u_hire_pay2]);
	$u_gy_mpay2 = number_format($row1[u_gy_mpay2]);
}
$u_name3 = $row1[u_name3];
if($u_name3) {
	$u_ssnb3 = $row1[u_ssnb3];
	$u_bohum_code3 = $row1[u_bohum_code3];
	$u_sj_sdate3 = $row1[u_sj_sdate3];
	$u_sj_edate3 = $row1[u_sj_edate3];
	$u_sj_ypay3 = number_format($row1[u_sj_ypay3]);
	$u_sj_mpay3 = number_format($row1[u_sj_mpay3]);
	$u_gy_sdate3 = $row1[u_gy_sdate3];
	$u_gy_edate3 = $row1[u_gy_edate3];
	$u_loss_pay3 = number_format($row1[u_loss_pay3]);
	$u_hire_pay3 = number_format($row1[u_hire_pay3]);
	$u_gy_mpay3 = number_format($row1[u_gy_mpay3]);
}
$u_name4 = $row1[u_name4];
if($u_name4) {
	$u_ssnb4 = $row1[u_ssnb4];
	$u_bohum_code4 = $row1[u_bohum_code4];
	$u_sj_sdate4 = $row1[u_sj_sdate4];
	$u_sj_edate4 = $row1[u_sj_edate4];
	$u_sj_ypay4 = number_format($row1[u_sj_ypay4]);
	$u_sj_mpay4 = number_format($row1[u_sj_mpay4]);
	$u_gy_sdate4 = $row1[u_gy_sdate4];
	$u_gy_edate4 = $row1[u_gy_edate4];
	$u_loss_pay4 = number_format($row1[u_loss_pay4]);
	$u_hire_pay4 = number_format($row1[u_hire_pay4]);
	$u_gy_mpay4 = number_format($row1[u_gy_mpay4]);
}
$u_name5 = $row1[u_name5];
if($u_name5) {
	$u_ssnb5 = $row1[u_ssnb5];
	$u_bohum_code5 = $row1[u_bohum_code5];
	$u_sj_sdate5 = $row1[u_sj_sdate5];
	$u_sj_edate5 = $row1[u_sj_edate5];
	$u_sj_ypay5 = number_format($row1[u_sj_ypay5]);
	$u_sj_mpay5 = number_format($row1[u_sj_mpay5]);
	$u_gy_sdate5 = $row1[u_gy_sdate5];
	$u_gy_edate5 = $row1[u_gy_edate5];
	$u_loss_pay5 = number_format($row1[u_loss_pay5]);
	$u_hire_pay5 = number_format($row1[u_hire_pay5]);
	$u_gy_mpay5 = number_format($row1[u_gy_mpay5]);
}
?>
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr> 
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:130;text-align:center'> 
													<a href="javascript:tab_view('u_total');">노조전임자 보수총액</a>
													</td> 
													<td><img src="images/g_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=4></td> 
										<td valign="bottom">(자활근로종사자 및 노동조함 등으로부터 금품을 지급받는 "노조전임자" 보수총액 신고) ※ 해당근로자가 있는 경우에만 기재</td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--검색 -->
								<div id="u_total" style="<?=$u_total_display?>">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
									<tr>
										<td nowrap class="tdrowk_center" rowspan="3">성명</td>
										<td nowrap class="tdrowk_center" rowspan="3">주민등록번호</td>
										<td nowrap class="tdrowk_center" rowspan="3">보험료<br>부과<br>구분</td>
										<td nowrap class="tdrowk_center" colspan="4">산재보험</td>
										<td nowrap class="tdrowk_center" colspan="5">고용보험 <table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:u_total_copy();" target="">복사</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table></td></td>
									</tr>
									<tr>
										<td nowrap class="tdrowk_center" rowspan="2">취득일</td>
										<td nowrap class="tdrowk_center" rowspan="2">상실일</td>
										<td nowrap class="tdrowk_center" rowspan="2">연간보수총액(원)</td>
										<td nowrap class="tdrowk_center" rowspan="2">월평균보수(원)</td>
										<td nowrap class="tdrowk_center" rowspan="2">취득일</td>
										<td nowrap class="tdrowk_center" rowspan="2">상실일</td>
										<td nowrap class="tdrowk_center" colspan="2">연간보수총액(원)</td>
										<td nowrap class="tdrowk_center" rowspan="2">월평균보수(원)</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk_center" rowspan="">실업급여</td>
										<td nowrap class="tdrowk_center" rowspan="">고용안정/직업능력개발</td>
									</tr>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td nowrap class="ltrow1_center_h24"><input name="u_name1" type="text" class="textfm" style="width:90px;"  value="<?=$u_name1?>" maxlength="10"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_ssnb1" type="text" class="textfm" style="width:110px;" value="<?=$u_ssnb1?>" maxlength="14" onKeyPress="only_number();" onkeyup="checkhyphen_bupin_no(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_bohum_code1" type="text" class="textfm" style="width:30px;" value="<?=$u_bohum_code1?>" maxlength="2"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_sj_sdate1" type="text" class="textfm" style="width:70px;" value="<?=$u_sj_sdate1?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_sj_edate1" type="text" class="textfm" style="width:70px;" value="<?=$u_sj_edate1?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_sj_ypay1" type="text" class="textfm" style="width:100px;" value="<?=$u_sj_ypay1?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_sj_mpay1" type="text" class="textfm" style="width:100px;" value="<?=$u_sj_mpay1?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_gy_sdate1" type="text" class="textfm" style="width:70px;" value="<?=$u_gy_sdate1?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_gy_edate1" type="text" class="textfm" style="width:70px;" value="<?=$u_gy_edate1?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_loss_pay1" type="text" class="textfm" style="width:100px;" value="<?=$u_loss_pay1?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_hire_pay1" type="text" class="textfm" style="width:100px;" value="<?=$u_hire_pay1?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_gy_mpay1" type="text" class="textfm" style="width:100px;"  value="<?=$u_gy_mpay1?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
									</tr>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td nowrap class="ltrow1_center_h24"><input name="u_name2" type="text" class="textfm" style="width:90px;"  value="<?=$u_name2?>" maxlength="10"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_ssnb2" type="text" class="textfm" style="width:110px;" value="<?=$u_ssnb2?>" maxlength="14" onKeyPress="only_number();" onkeyup="checkhyphen_bupin_no(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_bohum_code2" type="text" class="textfm" style="width:30px;" value="<?=$u_bohum_code2?>" maxlength="2"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_sj_sdate2" type="text" class="textfm" style="width:70px;" value="<?=$u_sj_sdate2?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_sj_edate2" type="text" class="textfm" style="width:70px;" value="<?=$u_sj_edate2?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_sj_ypay2" type="text" class="textfm" style="width:100px;" value="<?=$u_sj_ypay2?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_sj_mpay2" type="text" class="textfm" style="width:100px;" value="<?=$u_sj_mpay2?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_gy_sdate2" type="text" class="textfm" style="width:70px;" value="<?=$u_gy_sdate2?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_gy_edate2" type="text" class="textfm" style="width:70px;" value="<?=$u_gy_edate2?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_loss_pay2" type="text" class="textfm" style="width:100px;" value="<?=$u_loss_pay2?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_hire_pay2" type="text" class="textfm" style="width:100px;" value="<?=$u_hire_pay2?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_gy_mpay2" type="text" class="textfm" style="width:100px;"  value="<?=$u_gy_mpay2?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
									</tr>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td nowrap class="ltrow1_center_h24"><input name="u_name3" type="text" class="textfm" style="width:90px;"  value="<?=$u_name3?>" maxlength="10"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_ssnb3" type="text" class="textfm" style="width:110px;" value="<?=$u_ssnb3?>" maxlength="14" onKeyPress="only_number();" onkeyup="checkhyphen_bupin_no(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_bohum_code3" type="text" class="textfm" style="width:30px;" value="<?=$u_bohum_code3?>" maxlength="2"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_sj_sdate3" type="text" class="textfm" style="width:70px;" value="<?=$u_sj_sdate3?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_sj_edate3" type="text" class="textfm" style="width:70px;" value="<?=$u_sj_edate3?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_sj_ypay3" type="text" class="textfm" style="width:100px;" value="<?=$u_sj_ypay3?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_sj_mpay3" type="text" class="textfm" style="width:100px;" value="<?=$u_sj_mpay3?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_gy_sdate3" type="text" class="textfm" style="width:70px;" value="<?=$u_gy_sdate3?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_gy_edate3" type="text" class="textfm" style="width:70px;" value="<?=$u_gy_edate3?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_loss_pay3" type="text" class="textfm" style="width:100px;" value="<?=$u_loss_pay3?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_hire_pay3" type="text" class="textfm" style="width:100px;" value="<?=$u_hire_pay3?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_gy_mpay3" type="text" class="textfm" style="width:100px;"  value="<?=$u_gy_mpay3?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
									</tr>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td nowrap class="ltrow1_center_h24"><input name="u_name4" type="text" class="textfm" style="width:90px;"  value="<?=$u_name4?>" maxlength="10"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_ssnb4" type="text" class="textfm" style="width:110px;" value="<?=$u_ssnb4?>" maxlength="14" onKeyPress="only_number();" onkeyup="checkhyphen_bupin_no(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_bohum_code4" type="text" class="textfm" style="width:30px;" value="<?=$u_bohum_code4?>" maxlength="2"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_sj_sdate4" type="text" class="textfm" style="width:70px;" value="<?=$u_sj_sdate4?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_sj_edate4" type="text" class="textfm" style="width:70px;" value="<?=$u_sj_edate4?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_sj_ypay4" type="text" class="textfm" style="width:100px;" value="<?=$u_sj_ypay4?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_sj_mpay4" type="text" class="textfm" style="width:100px;" value="<?=$u_sj_mpay4?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_gy_sdate4" type="text" class="textfm" style="width:70px;" value="<?=$u_gy_sdate4?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_gy_edate4" type="text" class="textfm" style="width:70px;" value="<?=$u_gy_edate4?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_loss_pay4" type="text" class="textfm" style="width:100px;" value="<?=$u_loss_pay4?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_hire_pay4" type="text" class="textfm" style="width:100px;" value="<?=$u_hire_pay4?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_gy_mpay4" type="text" class="textfm" style="width:100px;"  value="<?=$u_gy_mpay4?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
									</tr>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td nowrap class="ltrow1_center_h24"><input name="u_name5" type="text" class="textfm" style="width:90px;"  value="<?=$u_name5?>" maxlength="10"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_ssnb5" type="text" class="textfm" style="width:110px;" value="<?=$u_ssnb5?>" maxlength="14" onKeyPress="only_number();" onkeyup="checkhyphen_bupin_no(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_bohum_code5" type="text" class="textfm" style="width:30px;" value="<?=$u_bohum_code5?>" maxlength="2"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_sj_sdate5" type="text" class="textfm" style="width:70px;" value="<?=$u_sj_sdate5?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_sj_edate5" type="text" class="textfm" style="width:70px;" value="<?=$u_sj_edate5?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_sj_ypay5" type="text" class="textfm" style="width:100px;" value="<?=$u_sj_ypay5?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_sj_mpay5" type="text" class="textfm" style="width:100px;" value="<?=$u_sj_mpay5?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_gy_sdate5" type="text" class="textfm" style="width:70px;" value="<?=$u_gy_sdate5?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_gy_edate5" type="text" class="textfm" style="width:70px;" value="<?=$u_gy_edate5?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_loss_pay5" type="text" class="textfm" style="width:100px;" value="<?=$u_loss_pay5?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_hire_pay5" type="text" class="textfm" style="width:100px;" value="<?=$u_hire_pay5?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
										<td nowrap class="ltrow1_center_h24"><input name="u_gy_mpay5" type="text" class="textfm" style="width:100px;"  value="<?=$u_gy_mpay5?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
									</tr>
								</table>
								</div>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>

								<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:">
									<tr>
										<td align="" style="padding-bottom:5px;">
											2013년도에 근로자(일용근로자, 그밖의 기타근로자, 자활근로자, 노조전임자, 아르바이트 등 포함)가 없었음을 신고합니다.<br>
											<input type="checkbox" name="chk_temp_etc" value="Y" <? if($row1[chk_temp_etc] == "Y") echo "checked"; ?> style="border:0;margin:0 0 3px 0; vertical-align: middle;"> <span style="font-weight:bold">2013년도 근로자(일용근로자 등) 사용 및 보수지급액 없음</span>
										</td>
									</tr>
									<tr>
										<td align="" style="padding-bottom:15px;font-size:16px;font-weight:bold">
											<input type="checkbox" name="agree_check1" value="Y" <? echo "checked"; ?> style="border:0;margin:0 0 3px 0; vertical-align: middle;"> 위 사항에 대해 업체에서 직접 작성하였음을 확인합니다.
										</td>
									</tr>
									<tr>
										<td align="center">
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;" id="save_bt">
												<tr>
													<td width=2></td>
													<td><img src=images/btn_lt.gif></td>
													<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:checkData();" target="">저 장</a></td>
													<td><img src=images/btn_rt.gif></td>
												 <td width=2></td>
												</tr>
											</table>
											<div id="save_ing" style="display:none"><img src="images/save_ing.gif"></div>
											<table border=0 cellpadding=0 cellspacing=0 style=display:inline;>
											 <tr>
												 <td width=2></td>
													<td><img src=images/btn_lt.gif></td>
													<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="total_pay_list_admin.php?page=<?=$page?>;" target="">목 록</a></td>
													<td><img src=images/btn_rt.gif></td>
												 <td width=2></td>
												</tr>
											</table>
<?
$t_no_excel = "입력정보_일반_".str_replace('-','',$t_no);
?>
											<table border=0 cellpadding=0 cellspacing=0 style=display:inline;>
											 <tr>
												 <td width=2></td>
													<td><img src=images/btn_lt.gif></td>
													<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$_PHP_SELF?>?w=u&id=<?=$id?>&excel=<?=$t_no_excel?>&page=<?=$page?>" target="">엑셀입력</a></td>
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
			</td>
		</tr>
	</table>			
</div>
<script language="javascript">
function worker_count_apply_excel() {
	main = document.dataForm;
	worker_count = <?=$maxRow-1?>;
	main.worker_count.value = worker_count;
	if(worker_count > 80) {
		alert("최대 80명까지 등록 가능합니다.");
		main.worker_count.focus();
		return;
	}
	for(i=1;i<=worker_count;i++) {
		document.getElementById('worker_tr'+i).style.display = "";
	}
}
<?
if($excel) {
?>
addLoadEvent(worker_count_apply_excel);
<?
}
?>
</script>
</body>
</html>
