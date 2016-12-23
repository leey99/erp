<? 
$mode = "popup";
$mode2 = "";
$member['mb_id'] = "test";
include_once("_common.php");
//include_once("$g4[path]/lib/popup.lib.php"); 
$year = "2013";
$s_title = $year."년도 보수총액 신고";

// 수정 상태만 작동
if($w == "u") {
	$sql1 = " select * from total_pay where id = $id ";
	echo $sql;
	$result1=mysql_query($sql1);
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
	if($sj_upjong_code) {
		$sj_upjong = $row1[sj_upjong];
		$sj_percent = $row1[sj_percent];
	}
	$comp_email = $row1[comp_email];
	$comp_tel = $row1[comp_tel];
	$comp_fax = $row1[comp_fax];
	//근로자 신고건수
	$sql2 = "select count(*) as cnt from total_pay_opt where mid = $id";
	$result2=mysql_query($sql2);
	//echo $sql2;
	$row2=mysql_fetch_array($result2);
	if($row2[cnt] < 6) {
		$worker_count = 5;
	} else {
		$worker_count = $row2[cnt];
	}
} else {
	$worker_count = 5;
}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$s_title?></title>
<link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
<br>
<h1>2013년도 고용,산재 보수총액신고가 종료 되었습니다.</h1>
</body>
</html>
<? exit; ?>
<script language="javascript">
function checkData(mode2) {
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
	if (frm.comp_email.value == "")
	{
		alert("이메일을 입력하세요.");
		frm.comp_email.focus();
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
	if (frm.ssnb1_1.value == "")
	{
		alert("근로자 주민등록번호(앞자리)를 입력하세요.");
		frm.ssnb1_1.focus();
		return;
	}
	if (frm.ssnb2_1.value == "")
	{
		alert("근로자 주민등록번호(뒷자리)를 입력하세요.");
		frm.ssnb2_1.focus();
		return;
	}
	if(frm.agree_check1.checked == false) {
		alert("직접 작성 확인에 체크해 주세요.");
		frm.agree_check1.focus();
		return;
	}
	if(frm.agree_check2.checked == false) {
		alert("개인정보처리방침 동의에 체크해 주세요.");
		frm.agree_check2.focus();
		return;
	}
	if(mode2 == "popup") {
		frm.mode2.value = "popup";
		document.getElementById('save_bt').style.display = "none";
		document.getElementById('save_ing').style.display = "inline";
	}
	frm.action = "total_pay_update.php";
	frm.submit();
	return;
}
function t_no_data() {
	var frm = document.dataForm;
	frm.action = "<?=$_PHP_SELF?>";
	frm.method = "post";
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
	//보수총액신고 종료 알림
	alert("보수총액신고가 종료 되었습니다.");
	return;
	var frm = document.dataForm;
	n = frm.comp_bznb.value;
	if(frm.comp_bznb.value == "") {
		alert("사업자등록번호를 입력 후 검색해 주십시오.");
		frm.comp_bznb.focus();
		return;
	}
	window.open("popup/t_no_popup.php?comp_bznb="+n, "comp_popup", "width=540, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
}
function open_sj_upjong(n) {
	window.open("popup/sj_upjong_popup.php?n=_"+n, "sj_upjong_popup", "width=640, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
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
	//alert(worker_count+1);
	for(i=toInt(worker_count)+1;i<=80;i++) {
		document.getElementById('worker_tr'+i).style.display = "none";
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
		//alert(frm['sj_ypay'+i].value);
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
		frm['u_gy_sdate_'+i].value = frm['u_sj_sdate_'+i].value;
		frm['u_gy_edate_'+i].value = frm['u_sj_edate_'+i].value;
		frm['u_gy_mpay_'+i].value = frm['u_sj_mpay_'+i].value;
	}
	gy_ypay_sum();
}
//작성방법
function total_pay_rule() {
	var ret = window.open("total_pay_rule.php", "total_pay_rule", "width=496,height=522,scrollbars=1");
	return;
}
</script>
<div style="">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td width="200"><img src="images/logo.png" /></td>
						<td width="700" style="padding-top:10px">
							<table width="90%" border="0" cellpadding="0" cellspacing="0" id="tables">
								<tr>
									<td>
										<div align="right" class="">
											[ 한국기업경영원 ]&nbsp;&nbsp;&nbsp;
											TEL : 1544-4519&nbsp;&nbsp;&nbsp;
											<!--직통 : 02-1111-1111&nbsp;&nbsp;&nbsp;-->
											FAX : 0505-609-0001
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
			<td style="background:#2a549c;height:9px"></td>
		</tr>
	</table>
</div>
<div>
<table width="1240" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" style="padding:10px 10px 10px 10px">
			<!--타이틀 -->
			<table width="100%" border=0 cellspacing=0 cellpadding=0>
				<tr>     
					<td height="18">
						<table width=100% border=0 cellspacing=0 cellpadding=0>
							<tr>
								<td><img src="images/g_title_icon.gif" align=absmiddle  style='margin:0 5 2 0'><span style='font-size:9pt;color:black;'><?=$s_title?></span>
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
			<form name="dataForm" method="post">
			<input type="hidden" name="mode" value="<?=$mode?>">
			<input type="hidden" name="mode2" value="<?=$mode2?>">
			<input type="hidden" name="year" value="<?=$year?>">
			<input type="hidden" name="w" id="w" value="<?=$w?>">
			<input type="hidden" name="id" id="id" value="<?=$id?>">
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
						<td valign="">
							<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:total_pay_rule();" target="">작성방법</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
							보수총액 신고 작성방법 안내
						</td> 
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
							<input name="adr_adr2" type="text" class="textfm" style="width:250px;ime-mode:active;" value="<?=$adr_adr1?>" maxlength="150">
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
							<input name="worker_count" type="text" class="textfm" style="width:30px;height:19px;ime-mode:active;" value="<?=$worker_count?>">명
							<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:worker_count_apply();" target="">적용</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
							(최대 80명까지 등록 가능) ※ 근로자 추가시 숫자 변경 후 "적용" 버튼을 클릭하십시오.
						</td> 
					</tr> 
				</table>
				<div style="height:2px;font-size:0px" class="bgtr"></div>
				<div style="height:2px;font-size:0px;line-height:0px;"></div>
				<!--검색 -->
				<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
					<tr>
						<td nowrap class="tdrowk_center" rowspan="3">No</td>
						<td nowrap class="tdrowk_center" rowspan="3">성명<font color="red">*</font></td>
						<td nowrap class="tdrowk_center" rowspan="3">주민등록번호<font color="red">*</font></td>
						<td nowrap class="tdrowk_center" rowspan="3">①<br>보험료<br>부과<br>구분</td>
						<td nowrap class="tdrowk_center" colspan="4">산재보험</td>
						<td nowrap class="tdrowk_center" colspan="5">고용보험 <table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:worker_copy();" target="">복사</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table></td>
						<td nowrap class="tdrowk_center" colspan="3">건강보험 <table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:worker_copy_gg();" target="">복사</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table></td>
					</tr>
					<tr>
						<td nowrap class="tdrowk_center" rowspan="2">취득일</td>
						<td nowrap class="tdrowk_center" rowspan="2">상실일</td>
						<td nowrap class="tdrowk_center" rowspan="2">②<br>연간보수총액(원)</td>
						<td nowrap class="tdrowk_center" rowspan="2">③<br>월평균보수(원)</td>
						<td nowrap class="tdrowk_center" rowspan="2">취득일</td>
						<td nowrap class="tdrowk_center" rowspan="2">상실일</td>
						<td nowrap class="tdrowk_center" colspan="2">연간보수총액(원)</td>
						<td nowrap class="tdrowk_center" rowspan="2">⑥<br>월평균보수(원)</td>
						<td nowrap class="tdrowk_center" rowspan="2">자격취득<br>(변동)일</td>
						<td nowrap class="tdrowk_center" rowspan="2">연간보수총액<br>(원)</td>
						<td nowrap class="tdrowk_center" rowspan="2">근무<br>월수</td>
					</tr>
					<tr>
						<td nowrap class="tdrowk_center" rowspan="">④ (1~6월)</td>
						<td nowrap class="tdrowk_center" rowspan="">⑤ (7~12월)</td>
					</tr>
<?
// 수정 상태만 작동
if($w == "u") {
	$result_opt = mysql_query("select * from total_pay_opt where mid = $id order by id asc");
	for($i=1; $row_opt=sql_fetch_array($result_opt); $i++) {
		$name[$i] = $row_opt[name1];
		//주민등록번호 뒷자리 별표 처리
		$ssnb[$i] = explode("-",$row_opt[ssnb1]);
		$ssnb1[$i] = $ssnb[$i][0];
		$ssnb2[$i] = $ssnb[$i][1];
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

for($i=1;$i<81;$i++) {
	if($i > $worker_count) {
	 $worker_display[$i] = "display:none";
	}
?>
					<tr id="worker_tr<?=$i?>" style="<?=$worker_display[$i]?>" class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
						<td nowrap class="ltrow1_center_h24"><?=$i?></td>
						<td nowrap class="ltrow1_center_h24"><input name="name_<?=$i?>" type="text" class="textfm" style="width:60px;"  value="<?=$name[$i]?>" maxlength="10"></td>
						<td nowrap class="ltrow1_center_h24"><input name="ssnb1_<?=$i?>" type="text" class="textfm" style="width:46px;" value="<?=$ssnb1[$i]?>" maxlength="6" onKeyPress="only_number();" onkeyup=""><input name="ssnb2_<?=$i?>" type="password" class="textfm" style="width:52px;" value="<?=$ssnb2[$i]?>" maxlength="7" onKeyPress="only_number();" onkeyup=""></td>
						<td nowrap class="ltrow1_center_h24"><input name="bohum_code_<?=$i?>" type="text" class="textfm" style="width:30px;" value="<?=$bohum_code[$i]?>" maxlength="2"></td>
						<td nowrap class="ltrow1_center_h24"><input name="sj_sdate_<?=$i?>" type="text" class="textfm" style="width:64px;" value="<?=$sj_sdate[$i]?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="sj_edate_<?=$i?>" type="text" class="textfm" style="width:64px;" value="<?=$sj_edate[$i]?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="sj_ypay_<?=$i?>" type="text" class="textfm" style="width:94px;" value="<?=$sj_ypay[$i]?>" maxlength="14" onkeypress="only_number();" onkeyup="sj_ypay_sum();checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="sj_mpay_<?=$i?>" type="text" class="textfm" style="width:90px;" value="<?=$sj_mpay[$i]?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="gy_sdate_<?=$i?>" type="text" class="textfm" style="width:64px;" value="<?=$gy_sdate[$i]?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="gy_edate_<?=$i?>" type="text" class="textfm" style="width:64px;" value="<?=$gy_edate[$i]?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="gy_ypay_<?=$i?>" type="text" class="textfm" style="width:94px;" value="<?=$gy_ypay[$i]?>" maxlength="14" onkeypress="only_number();" onkeyup="gy_ypay_sum();checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="gy_ypay2_<?=$i?>" type="text" class="textfm" style="width:94px;" value="<?=$gy_ypay2[$i]?>" maxlength="14" onkeypress="only_number();" onkeyup="gy_ypay_sum2();checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="gy_mpay_<?=$i?>" type="text" class="textfm" style="width:90px;" value="<?=$gy_mpay[$i]?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="gg_sdate_<?=$i?>" type="text" class="textfm" style="width:64px;"  value="<?=$gg_sdate[$i]?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="gg_ypay_<?=$i?>" type="text" class="textfm" style="width:94px;" value="<?=$gg_ypay[$i]?>" maxlength="14" onkeypress="only_number();" onkeyup="gg_ypay_sum();checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="gg_month_<?=$i?>" type="text" class="textfm" style="width:30px;" value="<?=$gg_month[$i]?>" maxlength="2"></td>
					</tr>
<?
}
?>
					<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
						<td nowrap class="ltrow1_center_h24" colspan="6">⑦ 일용근로자 보수총액</td>
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
						<td nowrap class="ltrow1_center_h24" colspan="6">⑧ 그 밖의 근로자 보수총액(60시간 미만)</td>
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
						<td nowrap class="ltrow1_center_h24" colspan="6">⑧ 그 밖의 근로자 보수총액(외국인 근로자)</td>
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
						<td nowrap class="ltrow1_center_h24" colspan="6">⑨ 합 계</td>
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
						<td nowrap class="ltrow1_center_h24"><?=$i?>월</td>
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
									<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:244;text-align:center'> 
									<a href="javascript:tab_view('change_total');">산재보험 업종변경 사업장 기간별 보수총액</a>
									</td> 
									<td><img src="images/g_tab_on_rt.gif"></td> 
								</tr> 
							</table> 
						</td> 
						<td width=4></td> 
						<td valign="bottom"> ⑪ (연도 중 산재보험 업종변경이 있는 경우에만 기재)</td>  
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
						<td nowrap class="tdrowk_center" colspan="5">고용보험</td>
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
						<td nowrap class="ltrow1_center_h24"><input name="u_name1" type="text" class="textfm" style="width:50px;"  value="<?=$u_name1?>" maxlength="10"></td>
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
						<td nowrap class="ltrow1_center_h24"><input name="u_name2" type="text" class="textfm" style="width:50px;"  value="<?=$u_name2?>" maxlength="10"></td>
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
						<td nowrap class="ltrow1_center_h24"><input name="u_name3" type="text" class="textfm" style="width:50px;"  value="<?=$u_name3?>" maxlength="10"></td>
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
						<td nowrap class="ltrow1_center_h24"><input name="u_name4" type="text" class="textfm" style="width:50px;"  value="<?=$u_name4?>" maxlength="10"></td>
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
						<td nowrap class="ltrow1_center_h24"><input name="u_name5" type="text" class="textfm" style="width:50px;"  value="<?=$u_name5?>" maxlength="10"></td>
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
							<span style="font-weight:bold">※ 건강보험 대상자 (근로자 + 대표자) : 대표자는 "근로자 보수총액" 리스트에 추가 입력 바랍니다.</span>
						</td>
					</tr>
					<tr>
						<td align="" style="padding-bottom:5px;">
							<input type="checkbox" name="chk_temp_etc" value="Y" <? if($row1[chk_temp_etc] == "Y") echo "checked"; ?> style="border:0;margin:0 0 3px 0; vertical-align: middle;"> <span style="font-weight:bold"> 2013년도에 근로자(일용근로자, 그밖의 기타근로자, 자활근로자, 노조전임자, 아르바이트 등 포함)가 없었음을 신고합니다.</span>
						</td>
					</tr>
					<tr>
						<td align="" style="padding-bottom:15px;font-size:16px;font-weight:bold">
							<input type="checkbox" name="agree_check1" value="Y" <? if($ok == 1) echo "checked"; ?> style="border:0;margin:0 0 3px 0; vertical-align: middle;"> 위 사항에 대해 업체에서 직접 작성하였음을 확인합니다.
						</td>
					</tr>
					<tr>
						<td align="" style="padding-bottom:5px;font-size:16px;font-weight:bold">
<style type="text/css">
em {
	font-style: normal;
}
.agree {
	width:1214px;height:120px;overflow:auto; overflow-x:hidden;
	border:1px solid #cccccc;
	padding:5px;
	color: rgb(85, 85, 85); font-family: "굴림", Gulim, "돋움", Dotum, AppleGothic, Sans-serif; font-size: 0.75em; position: relative;
}
.agree_check {
	text-align:left;padding:10px 0 10px 0;
}
.ls2 {
	margin-left: 0.83em !important;
}
.lh6 {
	line-height: 1.8em;
}
.bs5 {
	margin-bottom: 2.08em !important;
}
.ts4 {
	margin-top: 1.67em !important;
}
.article_child1 em.emphasis {
	color: rgb(200, 77, 39); font-style: normal; font-weight: normal;
}
</style>
							<div class="agree">
								<p><p class="ls2 lh6 bs5 ts4"><em class="emphasis">&lt;(주)한국기업경영원&gt;('easynomu.com'이하  '이지노무')</em>은(는) 개인정보보호법에 따라 이용자의 개인정보 보호 및 권익을 보호하고 개인정보와 관련한 이용자의 고충을 원활하게 처리할 수 있도록 다음과 같은 처리방침을 두고 있습니다.</p><p class="ls2 lh6 bs5 ts4"><em class="emphasis">&lt;(주)한국기업경영원&gt;('이지노무')</em> 은(는) 회사는 개인정보처리방침을 개정하는 경우 웹사이트 공지사항(또는 개별공지)을 통하여 공지할 것입니다.</p><p class="ls2">○ 본 방침은부터 <em class="emphasis">2013</em>년 <em class="emphasis">11</em>월 <em class="emphasis">1</em>일부터 시행됩니다.</p><br><p class="lh6 bs4"><strong>1. 개인정보의 처리 목적 <em class="emphasis">&lt;(주)한국기업경영원&gt;('easynomu.com'이하  '이지노무')</em>은(는) 개인정보를 다음의 목적을 위해 처리합니다. 처리한 개인정보는 다음의 목적이외의 용도로는 사용되지 않으며 이용 목적이 변경될 시에는 사전동의를 구할 예정입니다.</strong></p><p class="ls2">가. 홈페이지 회원가입 및 관리</p><p class="ls2">회원 가입의사 확인, 회원제 서비스 제공에 따른 본인 식별·인증, 회원자격 유지·관리, 서비스 부정이용 방지, 각종 고지·통지 등을 목적으로 개인정보를 처리합니다.</p><br><p class="ls2">나. 민원사무 처리</p><p class="ls2">민원인의 신원 확인, 민원사항 확인, 처리결과 통보 등을 목적으로 개인정보를 처리합니다.</p><br><p class="ls2">다. 재화 또는 서비스 제공</p><p class="ls2">서비스 제공, 청구서 발송, 요금결제·정산 등을 목적으로 개인정보를 처리합니다.</p><br><p class="ls2">라. 마케팅 및 광고에의 활용</p><p class="ls2">신규 서비스(제품) 개발 및 맞춤 서비스 제공, 서비스의 유효성 확인 등을 목적으로 개인정보를 처리합니다.</p><br><br><br><p class="lh6 bs4"><strong>2. 개인정보 파일 현황<br>('easynomu.com'이하  '이지노무')가 개인정보 보호법 제32조에 따라 등록/공개하는 개인정보파일의 처리목적은 다음과 같습니다.</strong></p><p class="ls2">1. 개인정보 파일명 : privacy_information<br> - 개인정보 항목 : 자택주소, 비밀번호, 생년월일, 자택전화번호, 로그인ID, 휴대전화번호, 이름, 이메일, 회사명, 직책, 회사전화번호, 직업, 부서, 학력, 주민등록번호, 은행계좌정보, 접속 IP 정보, 쿠키, 서비스 이용 기록, 접속 로그<br> - 수집방법 : 서면양식, 홈페이지, 전화/팩스<br> - 보유근거 : 회사DB<br>  - 보유기간 : 1년<br>  - 관련법령 : 계약 또는 청약철회 등에 관한 기록 : 5년</p><br><br>※ 기타('easynomu.com'이하  '이지노무')의 개인정보파일 등록사항 공개는 행정안전부 개인정보보호 종합지원 포털(www.privacy.go.kr) → 개인정보민원 → 개인정보열람등 요구 → 개인정보파일 목록검색 메뉴를 활용해주시기 바랍니다.<br><br><p class="lh6 bs4"><strong>3. 개인정보의 처리 및 보유 기간</strong><br><br>① <em class="emphasis">&lt;(주)한국기업경영원&gt;('이지노무')</em>은(는) 법령에 따른 개인정보 보유·이용기간 또는 정보주체로부터 개인정보를 수집시에 동의 받은 개인정보 보유,이용기간 내에서 개인정보를 처리,보유합니다.<br><br>② 각각의 개인정보 처리 및 보유 기간은 다음과 같습니다.</p>1.&lt;홈페이지 회원가입 및 관리&gt;<br>&lt;홈페이지 회원가입 및 관리&gt;와 관련한 개인정보는 수집.이용에 관한 동의일로부터&lt;1년&gt;까지 위 이용목적을 위하여 보유.이용됩니다.<br>-보유근거 : 회사DB<br>-관련법령 : 계약 또는 청약철회 등에 관한 기록 : 5년<br>-예외사유 : 사무위탁 가입<br><br><br><br><p class="lh6 bs4"><strong>4. 개인정보의 제3자 제공에 관한 사항</strong><br><br> ① <em class="emphasis">&lt;(주)한국기업경영원&gt;('easynomu.com'이하 '이지노무')</em>은(는) 정보주체의 동의, 법률의 특별한 규정 등 개인정보 보호법 제17조 및 제18조에 해당하는 경우에만 개인정보를 제3자에게 제공합니다.</p>②  <em class="emphasis">&lt;(주)한국기업경영원&gt;('easynomu.com')</em>은(는) 다음과 같이 개인정보를 제3자에게 제공하고 있습니다.<br><br><p class="ls2"><br>1. &lt;&gt;<br>- 개인정보를 제공받는 자 : <br>- 제공받는 자의 개인정보 이용목적 : <br>- 제공받는 자의 보유.이용기간: </p><br><br><p class="lh6 bs4"><strong>5. 개인정보처리 위탁</strong><br><br> ① <em class="emphasis">&lt;(주)한국기업경영원&gt;('이지노무')</em>은(는) 원활한 개인정보 업무처리를 위하여 다음과 같이 개인정보 처리업무를 위탁하고 있습니다.</p><p class="ls2">1. &lt;&gt;<br>- 위탁받는 자 (수탁자) : <br>- 위탁하는 업무의 내용 : <br>- 위탁기간 : </p><p>②  <em class="emphasis">&lt;(주)한국기업경영원&gt;('easynomu.com'이하 '이지노무')</em>은(는) 위탁계약 체결시 개인정보 보호법 제25조에 따라 위탁업무 수행목적 외 개인정보 처리금지, 기술적?관리적 보호조치, 재위탁 제한, 수탁자에 대한 관리?감독, 손해배상 등 책임에 관한 사항을 계약서 등 문서에 명시하고, 수탁자가 개인정보를 안전하게 처리하는지를 감독하고 있습니다.<br><br>③ 위탁업무의 내용이나 수탁자가 변경될 경우에는 지체없이 본 개인정보 처리방침을 통하여 공개하도록 하겠습니다.<br><br><br></p><p class="lh6 bs4"><strong>6. 정보주체의 권리,의무 및 그 행사방법 이용자는 개인정보주체로서 다음과 같은 권리를 행사할 수 있습니다.</strong></p><p class="ls2">① 정보주체는 (주)한국기업경영원(‘easynomu.com’이하 ‘이지노무) 에 대해 언제든지 다음 각 호의 개인정보 보호 관련 권리를 행사할 수 있습니다.<br>1. 개인정보 열람요구<br>2. 오류 등이 있을 경우 정정 요구<br>3. 삭제요구<br>4. 처리정지 요구<br>② 제1항에 따른 권리 행사는(주)한국기업경영원(‘easynomu.com’이하 ‘이지노무) 에 대해 개인정보 보호법 시행규칙 별지 제8호 서식에 따라 서면, 전자우편, 모사전송(FAX) 등을 통하여 하실 수 있으며 &lt;기관/회사명&gt;(‘사이트URL’이하 ‘사이트명) 은(는) 이에 대해 지체 없이 조치하겠습니다.<br>③ 정보주체가 개인정보의 오류 등에 대한 정정 또는 삭제를 요구한 경우에는 &lt;기관/회사명&gt;(‘사이트URL’이하 ‘사이트명) 은(는) 정정 또는 삭제를 완료할 때까지 당해 개인정보를 이용하거나 제공하지 않습니다.<br>④ 제1항에 따른 권리 행사는 정보주체의 법정대리인이나 위임을 받은 자 등 대리인을 통하여 하실 수 있습니다. 이 경우 개인정보 보호법 시행규칙 별지 제11호 서식에 따른 위임장을 제출하셔야 합니다.</p><br><br><p class="lh6 bs4"><strong>7. 처리하는 개인정보의 항목 작성 </strong><br><br> ① <em class="emphasis">&lt;(주)한국기업경영원&gt;('easynomu.com'이하  '이지노무')</em>은(는) 다음의 개인정보 항목을 처리하고 있습니다.</p><p class="ls2">1&lt;홈페이지 회원가입 및 관리&gt;<br>- 필수항목 : 자택주소, 비밀번호 질문과 답, 비밀번호, 생년월일, 자택전화번호, 로그인ID, 휴대전화번호, 이름, 이메일, 회사명, 직책, 회사전화번호, 직업, 부서, 학력, 주민등록번호, 은행계좌정보, 접속 IP 정보, 쿠키, 서비스 이용 기록, 접속 로그<br>- 선택항목 : 자택주소, 비밀번호, 생년월일, 자택전화번호, 로그인ID, 휴대전화번호, 이름, 이메일, 회사명, 직책, 회사전화번호, 직업, 부서, 학력, 주민등록번호, 은행계좌정보, 접속 IP 정보, 쿠키, 서비스 이용 기록, 접속 로그</p><br><br><br><p class="lh6 bs4"><strong>8. 개인정보의 파기<em class="emphasis">&lt;(주)한국기업경영원&gt;('이지노무')</em>은(는) 원칙적으로 개인정보 처리목적이 달성된 경우에는 지체없이 해당 개인정보를 파기합니다. 파기의 절차, 기한 및 방법은 다음과 같습니다.</strong></p><p class="ls2">-파기절차<br>이용자가 입력한 정보는 목적 달성 후 별도의 DB에 옮겨져(종이의 경우 별도의 서류) 내부 방침 및 기타 관련 법령에 따라 일정기간 저장된 후 혹은 즉시 파기됩니다. 이 때, DB로 옮겨진 개인정보는 법률에 의한 경우가 아니고서는 다른 목적으로 이용되지 않습니다.<br>-파기기한<br>이용자의 개인정보는 개인정보의 보유기간이 경과된 경우에는 보유기간의 종료일로부터 5일 이내에, 개인정보의 처리 목적 달성, 해당 서비스의 폐지, 사업의 종료 등 그 개인정보가 불필요하게 되었을 때에는 개인정보의 처리가 불필요한 것으로 인정되는 날로부터 5일 이내에 그 개인정보를 파기합니다.</p><p class="ls2">-파기방법<br>전자적 파일 형태의 정보는 기록을 재생할 수 없는 기술적 방법을 사용합니다.<br>종이에 출력된 개인정보는 분쇄기로 분쇄하거나 소각을 통하여 파기합니다.</p><br><br><p class="lh6 bs4"><strong>9. 개인정보의 안전성 확보 조치 <em class="emphasis">&lt;(주)한국기업경영원&gt;('이지노무')</em>은(는) 개인정보보호법 제29조에 따라 다음과 같이 안전성 확보에 필요한 기술적/관리적 및 물리적 조치를 하고 있습니다.</strong></p><p class="ls2">1. 개인정보 취급 직원의 최소화 및 교육<br> 개인정보를 취급하는 직원을 지정하고 담당자에 한정시켜 최소화 하여 개인정보를 관리하는 대책을 시행하고 있습니다.<br><br>2. 정기적인 자체 감사 실시<br> 개인정보 취급 관련 안정성 확보를 위해 정기적(분기 1회)으로 자체 감사를 실시하고 있습니다.<br><br>3. 내부관리계획의 수립 및 시행<br> 개인정보의 안전한 처리를 위하여 내부관리계획을 수립하고 시행하고 있습니다.<br><br>4. 개인정보의 암호화<br> 이용자의 개인정보는 비밀번호는 암호화 되어 저장 및 관리되고 있어, 본인만이 알 수 있으며 중요한 데이터는 파일 및 전송 데이터를 암호화 하거나 파일 잠금 기능을 사용하는 등의 별도 보안기능을 사용하고 있습니다.<br><br>5. 해킹 등에 대비한 기술적 대책<br> &lt;<em class="emphasis">(주)한국기업경영원</em>&gt;('<em class="emphasis">이지노무</em>')은 해킹이나 컴퓨터 바이러스 등에 의한 개인정보 유출 및 훼손을 막기 위하여 보안프로그램을 설치하고 주기적인 갱신·점검을 하며 외부로부터 접근이 통제된 구역에 시스템을 설치하고 기술적/물리적으로 감시 및 차단하고 있습니다.<br><br>6. 개인정보에 대한 접근 제한<br> 개인정보를 처리하는 데이터베이스시스템에 대한 접근권한의 부여,변경,말소를 통하여 개인정보에 대한 접근통제를 위하여 필요한 조치를 하고 있으며 침입차단시스템을 이용하여 외부로부터의 무단 접근을 통제하고 있습니다.<br><br>7. 접속기록의 보관 및 위변조 방지<br> 개인정보처리시스템에 접속한 기록을 최소 6개월 이상 보관, 관리하고 있으며, 접속 기록이 위변조 및 도난, 분실되지 않도록 보안기능 사용하고 있습니다.<br><br>8. 문서보안을 위한 잠금장치 사용<br> 개인정보가 포함된 서류, 보조저장매체 등을 잠금장치가 있는 안전한 장소에 보관하고 있습니다.<br><br>9. 비인가자에 대한 출입 통제<br> 개인정보를 보관하고 있는 물리적 보관 장소를 별도로 두고 이에 대해 출입통제 절차를 수립, 운영하고 있습니다.<br><br></p><br><br><p class="lh6 bs4"><strong>10. 개인정보 보호책임자 작성 </strong></p><br> ①  (주)한국기업경영원(‘easynomu.com’이하 ‘이지노무) 은(는) 개인정보 처리에 관한 업무를 총괄해서 책임지고, 개인정보 처리와 관련한 정보주체의 불만처리 및 피해구제 등을 위하여 아래와 같이 개인정보 보호책임자를 지정하고 있습니다.<p class="ls2"><br>
								▶ 개인정보 보호책임자 <br>성명 :정경용<br>직책 :정경용<br>직급 :부장<br>연락처 :1544-4519, kcmc4519@naver.com, 055-299-1272<br>※ 개인정보 보호 담당부서로 연결됩니다.<br> <br>
								▶ 개인정보 보호 담당부서<br>부서명 :경영관리부<br>담당자 :정경용<br>연락처 :1544-4519, kcmc4519@naver.com, 055-299-1272<br>② 정보주체께서는 (주)한국기업경영원(‘easynomu.com’이하 ‘이지노무) 의 서비스(또는 사업)을 이용하시면서 발생한 모든 개인정보 보호 관련 문의, 불만처리, 피해구제 등에 관한 사항을 개인정보 보호책임자 및 담당부서로 문의하실 수 있습니다. (주)한국기업경영원(‘easynomu.com’이하 ‘이지노무) 은(는) 정보주체의 문의에 대해 지체 없이 답변 및 처리해드릴 것입니다.</p><br><br><p class="lh6 bs4"><strong>11. 개인정보 처리방침 변경 </strong></p><p>① 이 개인정보처리방침은 시행일로부터 적용되며, 법령 및 방침에 따른 변경내용의 추가, 삭제 및 정정이 있는 경우에는 변경사항의 시행 7일 전부터 공지사항을 통하여 고지할 것입니다.</p><p></p>
							</div>
							<div class="agree_check">
								<input type="checkbox" name="agree_check2" value="Y" <? if($ok == 1) echo "checked"; ?> style="border:0;margin:0 5px 0 0; vertical-align: middle;"><img src="privacy_information/images/safe_agree.png" style="margin: 6px 0; vertical-align: middle;">
							</div>
						</td>
					</tr>
					<tr>
						<td align="" style="padding:5px;border:1px solid #cccccc">
							<span style="font-weight:bold">※ 정산보험료 분할고지 미희망</span>
							<p>보험료징수법 제16조의 9 제4항에 따라 월보험료를 초과하는 정산보험료의 경우 2분할하여 고지됩니다. 정산보험료 일시납을 원하실 경우 아래사항을 선택하여 주시기 바랍니다.</p>
							<p><input type="checkbox" name="chk_divide" value="Y" <? if($row1[chk_divide] == "Y") echo "checked"; ?> style="border:0;margin:0 0 3px 0; vertical-align: middle;"> <span style="font-weight:bold"> 분할고지 미희망</span></p>
						</td>
					</tr>
					<tr>
						<td align="" style="padding:4px;border:0px solid #cccccc">
						</td>
					</tr>
					<tr>
						<td align="" style="padding:5px;border:1px solid #cccccc">
							<span style="font-weight:bold">※ 과납보험료 충당신청서</span>
							<p>"고용보험 및 산업재해보상보험의 보험료징수 등에 관한 법률 시행령" 제31조 제2항 ("임금채권보장권 시행령 제21조")에 따라 아래와 같이 과납보험료를 충당 신청합니다.
							<br>과납된 산재보험료, 고용보험료가 있을 경우 내야 할(<font color="blue">앞으로 발생되는</font>) 보험료와 그 밖의 징수금에 충당하여 주시기 바랍니다.</p>
							<p><input type="checkbox" name="chk_appropriate" value="Y" <? if($row1[chk_appropriate] == "Y") echo "checked"; ?> style="border:0;margin:0 0 3px 0; vertical-align: middle;"> <span style="font-weight:bold"> 동의</span></p>
						</td>
					</tr>
					<tr>
						<td align="center" style="padding:10px 0 0 0">
							<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
								<tr>
									<td width=2></td>
									<td><img src=images/btn_lt.gif></td>
									<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:checkData();" target="">저장</a></td>
									<td><img src=images/btn_rt.gif></td>
								 <td width=2></td>
								</tr>
							</table>
							<div id="save_ing" style="display:none"><img src="images/save_ing.gif"></div>
							<table border=0 cellpadding=0 cellspacing=0 style="display:inline;" id="save_bt">
								<tr>
									<td width=2></td>
									<td><img src=images/btn_lt.gif></td>
									<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:checkData('popup');" target="">전송</a></td>
									<td><img src=images/btn_rt.gif></td>
								 <td width=2></td>
								</tr>
							</table>
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
		</td>
  </tr>
</table>

<? include "./inc/bottom.php";?>

</div>
</body>
</html>
