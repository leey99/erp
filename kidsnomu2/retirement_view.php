<?
$sub_menu = "500100";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

//사업장정보
$sql_com = " select com_code from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_com = sql_fetch($sql_com);
$com_code = $row_com[com_code];
//사업장정보 추가
$sql_com_opt = " select * from com_list_gy_opt where com_code='$com_code' ";
$result_com_opt = sql_query($sql_com_opt);
$row_com_opt=mysql_fetch_array($result_com_opt);

$sql_common = " from $g4[pibohum_base] ";

$sql1 = " select * $sql_common where com_code='$code' and sabun='$id' ";
//echo $sql1;
$result1 = sql_query($sql1);
//사원DB 옵션
$sql2 = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
$result2 = sql_query($sql2);
//사원DB 노무
$sql3 = " select * from pibohum_base_nomu where idx='$idx' ";
$result3 = sql_query($sql3);
//수정일 경우
if($w == "u") {
	$row1=mysql_fetch_array($result1);
	$row2=mysql_fetch_array($result2);
	$row3=mysql_fetch_array($result3);
}

$sub_title = "퇴직관리";
$g4[title] = $sub_title." : 노무관리 : ".$easynomu_name;
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

	if (frm.sabun.value == "")
	{
		alert("사원을 선택하세요.");
		frm.sabun.focus();
		return;
	}
	if (frm.out_day.value == "")
	{
		alert("퇴직일자를 입력하세요.");
		frm.out_day.focus();
		return;
	}
	if (frm.quit_cause.value == "")
	{
		alert("퇴직구분를 선택하세요.");
		frm.quit_cause.focus();
		return;
	}
	frm.action = "retirement_update.php";
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
function del(page,idx) 
{
	if(confirm("삭제하시겠습니까?")) {
		location.href = "retirement_delete.php?page="+page+"&idx="+idx;
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
//퇴직사유 팝업 150903
function open_quit_cause(n) {
	window.open("popup/quit_cause_popup.php?n=_"+n, "quit_cause_popup", "width=540, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
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
</script>
<? include "./inc/top.php"; ?>

<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="<?=$content_width?>" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="270">
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td><img src="images/subname05.gif" /></td>
								</tr>
								<tr>
									<td><a href="retirement.php" onmouseover="limg1.src='images/menu05_sub01_on.gif'" onmouseout="limg1.src='images/menu05_sub01_off.gif'"><img src="images/menu05_sub01_off.gif" name="limg1" id="limg1" /></a></td>
								</tr>
								<tr>
									<td><a href="annual_paid_holiday.php" onmouseover="limg2.src='images/menu05_sub02_on.gif'" onmouseout="limg2.src='images/menu05_sub02_off.gif'"><img src="images/menu05_sub02_off.gif" name="limg2" id="limg2" /></a></td>
								</tr>
								<tr>
									<td><a href="bonus.php" onmouseover="limg3.src='images/menu05_sub03_on.gif'" onmouseout="limg3.src='images/menu05_sub03_off.gif'"><img src="images/menu05_sub03_off.gif" name="limg3" id="limg3" /></a></td>
								</tr>
							</table>
<?
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
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
													퇴직등록
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

							<form name="dataForm" method="post">
							<input type="hidden" name="w" value="<?=$w?>">
							<input type="hidden" name="com_code" value="<?=$row_com[com_code]?>">
							<input type="hidden" name="code" value="<?=$code?>">
							<input type="hidden" name="id" value="<?=$id?>">
							<input type="hidden" name="idx" value="<?=$idx?>">
							<input type="hidden" name="page" value="<?=$page?>">
							<!-- 입력폼 -->
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
								<tr>
									<td nowrap class="tdrowk" width="20%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사원선택<font color="red">*</font></td>
									<td nowrap  class="tdrow" width="80%">
<?
if($w != u)	{
?>
										<select name='sabun' class='select'>
										<option value=''>근로자선택</option>
										<option value=''>-----------------</option>
										<!-- 근로자리스트사항 -->
										<?
										// 리스트 출력
										$sql = " select * $sql_common where com_code='$com_code' ";
										//echo $sql;
										$result = sql_query($sql);
										for ($i=0; $row=sql_fetch_array($result); $i++) {
											//$page
											//$total_page
											//$rows

											$no = $total_count - $i - ($rows*($page-1));
											$list = $i%2;
											// 사업장명 : 사업장코드
											$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$row[com_code]' ";
											$row_com = sql_fetch($sql_com);
											$com_name = $row_com[com_name];
											$com_name = cut_str($com_name, 21, "..");
											$name = cut_str($row[name], 6, "..");
											//$idx = $row[com_code]."_".$row[sabun];
										?>
														<option value="<?=$row[sabun]?>" <? if($row[sabun] == $row1[sabun]) echo "selected"; ?> >[<?=$row[sabun]?>] <?=$name?> (<?=$row[in_day]?>)</option>
										<?
										}
										if ($i == 0)
												echo "<option value=''>자료가 없습니다.</option>";
										?>
										</select>
<?
} else {
	echo $row1[name]."<input type='hidden' name='sabun' value='$row1[sabun]'>";
}
?>

									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">퇴직일자<font color="red">*</font></td>
									<td nowrap  class="tdrow">
										<input name="out_day" type="text" class="textfm" style="width:76px;" value="<?=$row1['out_day']?>" maxlength="10">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.out_day);" target="">달력</a></td><td><img src=./images/btn2_rt.gif></td><td width=2></td></tr></table>
										* 마지막 근무일의 다음날
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">퇴직구분<font color="red">*</font></td>
									<td nowrap  class="tdrow">
										<input name="quit_cause" id="quit_cause_undefined" value="<?=$row3['quit_cause']?>" type="text" class="textfm" style="width:30px;" value="" maxlength="3" readonly />
										<input name="quit_cause_text" id="quit_cause_text_undefined" value="<?=$row3['quit_cause_text']?>" type="text" class="textfm" style="width:320px;" value="" maxlength="25" readonly />
										<label onclick="open_quit_cause();" style="cursor:pointer"><img src="images/search_bt.png" align=absmiddle></label>
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">퇴직금</td>
									<td nowrap  class="tdrow">
										<input type="text" name="retire_reason" class="textfm" style="width:100px;" value="<?=$row3['retire_pay']?>" maxlength="25" onkeypress="only_number()" onkeyup="checkThousand(this.value, this,'Y');" />원
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">퇴직사유</td>
									<td nowrap  class="tdrow">
										<input type="text" name="retire_reason" class="textfm" style="width:600px;" value="<?=$row3['retire_reason']?>" maxlength="" />
									</td>
								</tr>
							</table>
<?
//권한별 링크값
if($member['mb_level'] == 6) {
	$url_save = "javascript:alert_demo();";
	$url_del = "javascript:alert_demo();";
} else {
	$url_save = "javascript:checkData();";
	$url_del = "javascript:del($page,$idx);";
}
?>

							<div style="height:10px;font-size:0px"></div>
							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
								<tr>
									<td align="left">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_save?>" target="">저 장</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
<?
if($w == "u") {
?>
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_del?>" target="">삭 제</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
<? } ?>
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="./retirement.php?page=<?=$page?>" target="">목 록</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
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
