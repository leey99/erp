<?
$sub_title = "급여유형";
$sub_menu = "100302";

include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$g4[title] = $sub_title." : 급여기초코드 : 사업장관리 : ".$easynomu_name;

//com_code 출력
$sql_common_com = " from $g4[com_list_gy] ";
$sql_search_com = " where t_insureno='$member[mb_id]' ";
$sql_com = " select *
          $sql_common_com
          $sql_search_com ";
//echo $sql_com;
$result_com = sql_query($sql_com);
$row_com = mysql_fetch_array($result_com);
//echo $row_com[com_code];
//echo $row_com[payrpt];
$pay_gbn0 = substr($row_com['payrpt'], 0,1);
$pay_gbn1 = substr($row_com['payrpt'], 1,1);
$pay_gbn2 = substr($row_com['payrpt'], 2,1);
$pay_gbn3 = substr($row_com['payrpt'], 3,1);
$pay_gbn4 = substr($row_com['payrpt'], 4,1);
//추가 필드 데이터 (급여유형)
$sql_common_opt2 = " from com_list_gy_opt2 ";
$sql_search_opt2 = " where com_code='$row_com[com_code]' ";
$sql_opt2 = " select *
          $sql_common_opt2
          $sql_search_opt2 ";
//echo $sql_opt2;
$result_opt2 = sql_query($sql_opt2);
$row_opt2 = mysql_fetch_array($result_opt2);
//급여유형 기본
$pay_gbn = $row_opt2['pay_gbn'];
$pay_gbn_a = $row_opt2['pay_gbn_a'];
$pay_gbn_b = $row_opt2['pay_gbn_b'];
$pay_gbn_c = $row_opt2['pay_gbn_c'];
$pay_gbn_d = $row_opt2['pay_gbn_d'];
//시급제 : 최저시급
$money_min_time = 5580;
//시급제 : 직접입력
$money_time_input = $row_opt2['money_time_input'];
//활동보조인 교육시간, 스마트폰 수당
$money_time_edu = $row_opt2['money_time_edu'];
$money_time_phone = $row_opt2['money_time_phone'];
//월급제 : 최저임금
$money_min_month = $money_min_time * 209;
//월급제 : 퍼센트
$money_month_base_pesent = $row_opt2['money_month_base_pesent'];
//월급제 : 직접입력
$money_month_input = $row_opt2['money_month_input'];
//연봉제 : 포괄임금제 : 분할
$money_year_base_division = $row_opt2['money_year_base_division'];
//연봉제 : 순수연봉 : 분할
$money_year_base_division2 = $row_opt2['money_year_base_division2'];
//일급제 : 직접입력
$money_day_input = $row_opt2['money_day_input'];
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
<script language="javascript">
function checkID()
{
	var frm = document.dataForm;
	if (frm.user_id.value == "")
	{
		alert("아이디를 입력하세요.");
		frm.user_id.focus();
		return;
	}
	var ret = window.open("./common/member_idcheck.php?uid="+frm.user_id.value, "id_check", "top=100, left=100, width=395,height=240");
	return;
}
function checkAddress(strgbn)
{
	var ret = window.open("./common/member_address.php?frm_name=dataForm&frm_zip1=adr_zip1&frm_zip3=adr_zip2&frm_addr1=adr_adr1&frm_addr2=adr_adr2", "address", "top=100, left=100, width=410,height=285, scrollbars");
	return;
}
function checkData() {
	var frm = document.dataForm;
	if(confirm("저장 하시겠습니까?")) {
		frm.action = "com_pay_gbn_update.php";
		frm.submit();
	}
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
function goSearch()
{
	var frm = document.searchForm;
	frm.action = "<?=$PHP_SELF?>";
	frm.submit();
	return;
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
function only_number() {
	//alert(event.keyCode);
	var e = event.keyCode;
	window.status = e;
	if (e>=48 && e<=57) return;
	if (e>=96 && e<=105) return;
	if (e>=37 && e<=40) return;
	if (e==8 || e==9 || e==13 || e==46) return;
	event.returnValue = false;
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
	//백스페이스, Del 제거
	//&& event.keyCode!=8 && event.keyCode!=46
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
function delCom(inputVal, count){
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!=','){		// 먼저 substring을 위해
			tmp += inputVal.substring(i,i+1);	// 값의 모든 , 를 제거
		}
	}
	return tmp;
}
</script>
<? include "./inc/top.php"; ?>

<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="<?=$content_width?>" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="270">
<?
include "./inc/left_menu1.php";
include "./inc/left_banner.php";
?>
						</td>
						<td valign="top" style="padding:10px 10px 10px 10px">
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

							<!--댑메뉴 -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:140;text-align:center'> 
												급여유형 선택 (기본급)
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
							<input type="hidden" name="com_code" value="<?=$row_com[com_code]?>">
							<input type="hidden" name="pay_gbn2" value="<?=$pay_gbn2?>">
							<!-- 입력폼 -->
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
								<tr>
									<td nowrap class="tdrowk" width="134"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">월급제 <input type="checkbox" name="pay_gbn_a" value="1" <? if($pay_gbn_a == "1") echo "checked"; ?> />기본</td>
									<td nowrap  class="tdrow" width="">
										<input type="radio" name="pay_gbn0" value="1" <? if($pay_gbn0 == "1") echo "checked"; ?> /> A. 최저임금
										<input name="money_min_month" id="money_min_month" type="text" class="textfm5" style="width:70px;ime-mode:disabled;" value="<?=number_format($money_min_month)?>" maxlength="10" onkeypress="only_number();" onkeyup=""> 원
									</td>
									<td nowrap  class="tdrow" width="">
										<input type="radio" name="pay_gbn0" value="2" <? if($pay_gbn0 == "2") echo "checked"; ?> onclick="getId('money_month_base_pesent').focus();" /> B. 퍼센트
										<input name="money_month_base_pesent" id="money_month_base_pesent" type="text" class="textfm" style="width:50px;ime-mode:disabled;" value="<?=$money_month_base_pesent?>" maxlength="2" onkeypress="only_number();" onfocus="this.select()"> %
									</td>
									<td nowrap  class="tdrow" width="">
										<input type="radio" name="pay_gbn0" value="3" <? if($pay_gbn0 == "3") echo "checked"; ?> onclick="getId('money_month_input').focus();" /> C. 직접입력
										<input name="money_month_input" id="money_month_input" type="text" class="textfm" style="width:70px;ime-mode:disabled;" value="<?=number_format($money_month_input)?>" maxlength="10" onkeyup="checkThousand(this.value, this,'Y')" onfocus="this.select()"> 원
									</td>
								</tr>
<?
//화성시장애인부모회, 화성서남부장애인자립생활지원센터
if($com_code==20399 || $com_code==20627) {
	//$money_time_rowspan = "rowspan=\"2\"";
	//시간당 급여 단가 적용 DB
	$sql_time = " select * from com_list_gy_time where com_code='$row_com[com_code]' order by idx ";
	//echo $sql_time;
	$result_time = sql_query($sql_time);
	//$row_time = mysql_fetch_array($result_time);
} else {
	//$money_time_rowspan = "";
}
?>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">시급제 <input type="checkbox" name="pay_gbn_b" value="1" <? if($pay_gbn_b == "1") echo "checked"; ?> />기본</td>
<?
//화성시장애인부모회, 화성서남부장애인자립생활지원센터
if($com_code==20399 || $com_code==20627) {
?>
									<td class="tdrow" colspan="3">
										<table width="100%" border="0" cellpadding="0" cellspacing="0">
<?
	$k = "";
	for($i=0; $row_time=sql_fetch_array($result_time); $i++) {
?>
											<tr>
												<td class="tdrow" colspan="3">
													<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" /><strong>단가기준</strong>
													<input type="hidden" name="pay_time_idx_<?=$i?>" value="<?=$row_time['idx']?>" />
													<input name="start_date_<?=$i?>" type="text" class="textfm" style="width:81px;ime-mode:disabled;" value="<?=$row_time['start_date']?>" maxlength="10" />
													~
													<input name="end_date_<?=$i?>" type="text" class="textfm" style="width:81px;ime-mode:disabled;" value="<?=$row_time['end_date']?>" maxlength="10" />
												</td>
											</tr>
											<tr>
												<td class="tdrow" width="253">
													<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" />보건복지 <strong>평근</strong>
													<input name="money_time1_<?=$i?>" type="text" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=number_format($row_time['money_time1'])?>" maxlength="10" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')" onfocus="this.select()" />
													<strong>휴심</strong>
													<input name="money_time1_hday_<?=$i?>" type="text" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=number_format($row_time['money_time1_hday'])?>" maxlength="10" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')" onfocus="this.select()" />
												</td>
												<td class="tdrow" width="239">
													<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" />경기도 <strong>평근</strong>
													<input name="money_time2_<?=$i?>" type="text" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=number_format($row_time['money_time2'])?>" maxlength="10" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')" onfocus="this.select()" />
													<strong>휴심</strong>
													<input name="money_time2_hday_<?=$i?>" type="text" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=number_format($row_time['money_time2_hday'])?>" maxlength="10" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')" onfocus="this.select()" />
												</td>
												<td class="tdrow">
													<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" />화성시 <strong>평근</strong>
													<input name="money_time3_<?=$i?>" type="text" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=number_format($row_time['money_time3'])?>" maxlength="10" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')" onfocus="this.select()" />
													<strong>휴심</strong>
													<input name="money_time3_hday_<?=$i?>" type="text" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=number_format($row_time['money_time3_hday'])?>" maxlength="10" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')" onfocus="this.select()" />
												</td>
											</tr>
											<tr>
												<td class="tdrow">
													<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" />서비스　 <strong>평근</strong>
													<input name="money_time1_com_<?=$i?>" type="text" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=number_format($row_time['money_time1_com'])?>" maxlength="10" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')" onfocus="this.select()" />
													<strong>휴심</strong>
													<input name="money_time1_hday_com_<?=$i?>" type="text" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=number_format($row_time['money_time1_hday_com'])?>" maxlength="10" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')" onfocus="this.select()" />										
												</td>
												<td class="tdrow">
													<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" />서비스 <strong>평근</strong>
													<input name="money_time2_com_<?=$i?>" type="text" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=number_format($row_time['money_time2_com'])?>" maxlength="10" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')" onfocus="this.select()" />
													<strong>휴심</strong>
													<input name="money_time2_hday_com_<?=$i?>" type="text" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=number_format($row_time['money_time2_hday_com'])?>" maxlength="10" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')" onfocus="this.select()" />										
												</td>
												<td class="tdrow">
													<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" />서비스 <strong>평근</strong>
													<input name="money_time3_com_<?=$i?>" type="text" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=number_format($row_time['money_time3_com'])?>" maxlength="10" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')" onfocus="this.select()" />
													<strong>휴심</strong>
													<input name="money_time3_hday_com_<?=$i?>" type="text" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=number_format($row_time['money_time3_hday_com'])?>" maxlength="10" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')" onfocus="this.select()" />										
												</td>
											</tr>
											<tr>
												<td class="tdrow">
													<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" />동부권　 <strong>평근</strong>
													<input name="money_time1_helper_<?=$i?>" type="text" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=number_format($row_time['money_time1_helper'])?>" maxlength="10" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')" onfocus="this.select()" />
												</td>
												<td class="tdrow">
													<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" />서남부 <strong>평근</strong>
													<input name="money_time2_helper_<?=$i?>" type="text" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=number_format($row_time['money_time2_helper'])?>" maxlength="10" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')" onfocus="this.select()" />
												</td>
												<td class="tdrow">
												</td>
											</tr>
											<tr>
												<td class="tdrow" style="border-bottom:1px solid #cccccc;">
													<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" />교육시간
													<input name="money_time_edu_<?=$i?>" type="text" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=number_format($row_time['money_time_edu'])?>" maxlength="10" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')" onfocus="this.select()" />
												</td>
												<td class="tdrow" style="border-bottom:1px solid #cccccc;">
													<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" />스마트폰
													<input name="money_time_phone_<?=$i?>" type="text" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=number_format($row_time['money_time_phone'])?>" maxlength="10" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')" onfocus="this.select()" />
												</td>
												<td class="tdrow" style="border-bottom:1px solid #cccccc;">
													<input type="radio" name="pay_gbn1<?=$k?>" value="2" <? if($pay_gbn1 == "2") echo "checked"; ?> onclick="getId('money_time_input').focus();" />  기본시급
													<input name="money_time_input_<?=$i?>" type="text" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=number_format($row_time['money_time_input'])?>" maxlength="10" onkeyup="checkThousand(this.value, this,'Y')" onfocus="this.select()"> 원
												</td>
											</tr>
<?
		$k = "_".($i + 1);
		//echo $k;
	}
	echo "<input type='hidden' name='pay_time_cnt' value='".$i."' />";
?>
										</table>
									</td>
<?
} else {
?>
									<td nowrap  class="tdrow">
										<input type="radio" name="pay_gbn1" value="1" <? if($pay_gbn1 == "1") echo "checked"; ?> /> A. 최저시급
										<input name="money_min_time" id="money_min_time" type="text" class="textfm5" readonly style="width:60px;ime-mode:disabled;" value="<?=number_format($money_min_time)?>" maxlength="10" onkeypress="only_number();" onkeyup=""> 원
									</td>
									<td nowrap  class="tdrow">
										<input type="radio" name="pay_gbn1" value="2" <? if($pay_gbn1 == "2") echo "checked"; ?> onclick="getId('money_time_input').focus();" /> B. 직접입력
										<input name="money_time_input" id="money_time_input" type="text" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=number_format($money_time_input)?>" maxlength="10" onkeyup="checkThousand(this.value, this,'Y')" onfocus="this.select()"> 원
									</td>
									<td nowrap  class="tdrow">
									</td>
<?
}
?>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">연봉제 <input type="checkbox" name="pay_gbn_c" value="1" <? if($pay_gbn_c == "1") echo "checked"; ?> />기본</td>
									<td nowrap  class="tdrow">
										<input type="radio" name="pay_gbn3" value="1" <? if($pay_gbn3 == "1") echo "checked"; ?> onclick="getId('money_year_base_division').focus();" /> A. 포괄임금제
										<input name="money_year_base_division" id="money_year_base_division" type="text" class="textfm" style="width:50px;ime-mode:disabled;" value="<?=$money_year_base_division?>" maxlength="2" onkeypress="only_number();" onkeyup="" onfocus="this.select()"> 분할
									</td>
									<td nowrap  class="tdrow">
										<input type="radio" name="pay_gbn3" value="2" <? if($pay_gbn3 == "2") echo "checked"; ?> onclick="getId('money_year_base_division2').focus();" /> B. 순수연봉
										<input name="money_year_base_division2" id="money_year_base_division2" type="text" class="textfm" style="width:50px;ime-mode:disabled;" value="<?=$money_year_base_division2?>" maxlength="2" onkeypress="only_number();" onkeyup="" onfocus="this.select()"> 분할
									</td>
									<td nowrap  class="tdrow">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">일급제 <input type="checkbox" name="pay_gbn_d" value="1" <? if($pay_gbn_d == "1") echo "checked"; ?> />기본</td>
									<td nowrap  class="tdrow">
										<input type="radio" name="pay_gbn4" value="1" <? if($pay_gbn4 == "1") echo "checked"; ?> />A. 최저일급
										<input name="money_min_day" id="money_min_day" type="text" class="textfm5" readonly style="width:60px;ime-mode:disabled;" value="<?=number_format($money_min_time*8)?>" maxlength="10" onkeypress="only_number();" onkeyup=""> 원
									</td>
									<td nowrap  class="tdrow">
										<input type="radio" name="pay_gbn4" value="2" <? if($pay_gbn4 == "2") echo "checked"; ?> onclick="getId('money_day_input').focus();" /> B. 직접입력
										<input name="money_day_input" id="money_day_input" type="text" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=number_format($money_day_input)?>" maxlength="10" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')" onfocus="this.select()"> 원
									</td>
									<td nowrap  class="tdrow">
									</td>
								</tr>
							</table>
<?
//권한별 링크값
if($member['mb_level'] == 6) {
	$url_save = "javascript:alert_demo();";
} else {
	$url_save = "javascript:checkData();";
}
?>

							<div style="height:10px;font-size:0px"></div>
							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
								<tr>
									<td align="center">
										<a href="<?=$url_save?>" target=""><img src="images/btn_save_big.png" border="0"></a>
									</td>
								</tr>
							</table>
							<div style="height:10px;font-size:0px"></div>
							</form>
							<!--댑메뉴 -->
							<!-- 입력폼 -->

							<div id="help_div">
								<!--댑메뉴 -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
													급여유형 설명
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

								<!-- 입력폼 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
									<tr>
										<td nowrap class="tdrowk" style="padding:10px;font-size:15px">
											<b>* 월급제</b>
											<div style="margin:0 0 0 12px">A(최저임금) : 기본급이 최저임금으로 설정 (최저시급 * 월소정근로시간)<br>
											B(퍼센트) : 결정임금 * 설정% = 기본급<br>
											C(직접입력) : 기본급을 직접입력</div>
											<br>
											<b>* 시급제</b>
											<div style="margin:0 0 0 12px">A(최저임금) : 시급이 최저시급 <?=number_format($money_min_time)?>원(2015년)<br>
											B(직접입력) : 시급을 직접입력</div>
											<br>
											<b>* 연봉제</b>
											<div style="margin:0 0 0 12px">A(포괄임금제) : 기본급+법정수당(고정연장,야간,휴일근로수당)통상임금+기타수당 합계를 연봉으로 나누어 지급<br>
											B(순수연봉) : 결정연봉을 월액으로 나누어 지급</div>
										</td>
									</tr>
								</table>
							</div>
						</td>
					</tr>
				</table>
				<? include "./inc/bottom.php";?>
			</td>
		</tr>
	</table>			
</div>
</body>
</html>
