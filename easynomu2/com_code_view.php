<?
include_once("./_common.php");
if($item == "position") {
	$sub_title = "직위코드(급여연동)";
	$sub_menu = "100201";
	$code_name = "직위";
	$pay_type = "급수";
	$amount_name = "금액";
} else if($item == "step") {
	$sub_title = "연동급수(급여연동)";
	$sub_menu = "100202";
	$code_name = "호봉명칭";
	$pay_type = "급수";
	$amount_name = "금액";
} else {
	$sub_title = "부서코드";
	$sub_menu = "100203";
	$code_name = "부서명";
	$pay_type = "급수";
	$amount_name = "부서명2";
}
$g4[title] = $sub_title." : 코드관리 : 사업장관리 : ".$easynomu_name;

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

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

$sql_common = " from com_code_list ";

//echo $is_admin;
if(!$item) $item = "position";

//수정일 경우
if($w == "u") {
	$sql_search = " where com_code = '$code' and code='$id' and item = '$item' ";

	$sql = " select *
						$sql_common
						$sql_search";

	//echo $sql;
	$result = sql_query($sql);
	$row=mysql_fetch_array($result);
	//echo $row[com_code];
	if($item == "dept") {
		$amount = $row[amount];
	} else {
		$amount = $row[amount];
		//$amount = number_format($row[amount]);
	}
}
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
	var rv = 0;

	if (frm.name.value == "")
	{
		alert("<?=$code_name?>을 입력하세요.");
		frm.name.focus();
		return;
	}
/*
	if (frm.rate.value == "")
	{
		alert("<?=$pay_type?>를 입력하세요.");
		frm.rate.focus();
		return;
	}
*/
	frm.action = "com_code_update.php";
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
function del(item,page,id) 
{
	if(confirm("삭제하시겠습니까?")) {
		location.href = "com_code_delete.php?item="+item+"page="+page+"&id="+id;
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
		if ( type =='1' ) {
			main.amount.value=total;					// type 에 따라 최종값을 넣어 준다.
		}
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
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
												코드관리 기본정보
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
							<input type="hidden" name="item" value="<?=$item?>">
							<input type="hidden" name="id" value="<?=$id?>">
							<input type="hidden" name="page" value="<?=$page?>">
							<!-- 입력폼 -->
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
								<tr>
									<td nowrap class="tdrowk" width="20%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0"><?=$code_name?><font color="red">*</font></td>
									<td nowrap  class="tdrow" width="80%">
										<input name="name" type="text" class="textfm" style="width:150;ime-mode:active;" value="<?=$row[name]?>" maxlength="50">
									</td>
								</tr>
								<!--<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">급수<font color="red">*</font></td>
									<td nowrap  class="tdrow">
										<input name="rate" type="text" class="textfm" style="width:150;ime-mode:disabled;" value="<?=$row[rate]?>" maxlength="25" onKeyPress="onlyNumber();">
									</td>
								</tr>-->
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0"><?=$amount_name?><font color="red"></font></td>
									<td nowrap  class="tdrow">
										<input type="text" name="amount" class="textfm" style="width:150px;" value="<?=$amount?>" maxlength="25" onkeyup="checkThousand(this.value, '1','Y')" />
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사용여부<font color="red"></font></td>
									<td nowrap  class="tdrow">
										<input type="checkbox" name="use_yn" value="Y" <? if($w == "w" || $row[use_yn] == "Y") echo "checked"; ?> /> 사용
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">기타<font color="red"></font></td>
									<td nowrap  class="tdrow">
										<input name="memo" type="text" class="textfm" style="width:710px;" value="<?=$row[memo]?>" maxlength="">
									</td>
								</tr>
							</table>
							<div style="height:10px;font-size:0px"></div>
<?
//권한별 링크값
if($member['mb_level'] == 6) {
	$url_del = "javascript:alert_demo();";
	$url_save = "javascript:alert_demo();";
} else {
	$url_del = "javascript:del('$item',$page,$id);";
	$url_save = "javascript:checkData();";
}
?>
							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
								<tr>
									<td align="left">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_save?>" target="">저 장</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
<?
if($w != "w") {
?>
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_del?>" target="">삭 제</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
<? } ?>
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="./com_code_list.php?item=<?=$item?>&page=<?=$page?>" target="">목 록</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
									</td>
								</tr>
							</table>
							<div style="height:20px;font-size:0px"></div>
							</form>
							<!--댑메뉴 -->
							<!-- 입력폼 -->

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
