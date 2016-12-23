<?
$sub_menu = "300100";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

//사업장정보
$sql_a4 = " select com_code from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4[com_code];

$sub_title = "근태등록";
$g4[title] = $sub_title." : 근태관리 : ".$easynomu_name;

$colspan = 8;
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
function modify(id,toYear,toMonth,monthday) {
	location.href = "attendance_view.php?id="+id+"&toYear="+toYear+"&toMonth="+toMonth+"&monthday="+monthday;
}
// 삭제 검사 확인
function del(id,toYear,toMonth) {
	if(confirm("삭제하시겠습니까?")) {
		location.href = "attendance_delete.php?id="+id+"&toYear="+toYear+"&toMonth="+toMonth;
	}
}
function checkData() {
	var frm = document.dataForm;
	if(frm.sabun.value == "") {
		alert("사원을 선택하세요.");
		frm.sabun.focus();
		return;
	}
	var chk = false; 
	for(i=0;i<frm.att_category.length;i++) { 
		if(frm.att_category[i].checked) { 
			chk = true; 
			break; 
		} 
	} 
	if(!chk) { 
		alert("분류를 선택하세요."); 
		frm.att_category[0].focus();
		return; 
	}
	if(frm.att_category[4].checked) {
		//alert(frm.att_time2.value.substring(0,2));
		//return; 
		if((frm.att_time2.value.substring(0,2) > 22 && frm.att_time2.value.substring(0,2) < 25) || (frm.att_time2.value.substring(0,2) > 0 && frm.att_time2.value.substring(0,2) < 13)) {
			alert("연장근무는 22:00 까지이며\n22:00~06:00 근무는 야근근무로 입력하세요.");
			frm.att_time2.value = "22:00";
			return; 
		}
	}
	frm.action = "attendance_update.php";
	frm.submit();
	return;
}
</script>
<? include "./inc/top.php"; ?>
<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="1200" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="270">
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td><img src="images/subname03.gif" /></td>
								</tr>
								<tr>
									<td><a href="attendance.php" onmouseover="limg1.src='images/menu03_sub01_on.gif'" onmouseout="limg1.src='images/menu03_sub01_off.gif'"><img src="images/menu03_sub01_off.gif" name="limg1" id="limg1" /></a></td>
								</tr>
								<tr>
									<td><a href="vacation.php" onmouseover="limg2.src='images/menu03_sub02_on.gif'" onmouseout="limg2.src='images/menu03_sub02_off.gif'"><img src="images/menu03_sub02_off.gif" name="limg2" id="limg2" /></a></td>
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
												근태 등록
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

							<!--리스트 -->
							<div id="bbswrite">
								<form name="dataForm" method="post">
<?
if($mod != "write") $w = "u";
else $w = "";
$f_date = $toYear."".$monthday;
//echo $f_date;
//급태정보
$sql_att = " select * from a4_attendance where id='$id' ";
//echo $sql_att;
$result_att = sql_query($sql_att);
$row_att = mysql_fetch_array($result_att);
if($row_att[att_time] == "") $att_time = "09:00";
else $att_time = $row_att[att_time];
if($row_att[att_time2] == "") $att_time2 = "18:00";
else $att_time2 = $row_att[att_time2];
if($row_att[att_day] == "") {
	$att_day = $f_date;
} else {
	$att_day = $row_att[att_day];
}
$att_day_txt = date('Y-m-d',strtotime($att_day));
//echo $att_day;
?>
									<input type="hidden" name="w" value="<?=$w?>" />
									<input type="hidden" name="id" value="<?=$id?>" />
									<input type="hidden" name="com_code" value="<?=$com_code?>" />
									<input type="hidden" name="att_day" value="<?=$att_day?>" />
									<input type="hidden" name="toYear" value="<?=$toYear?>" />
									<input type="hidden" name="toMonth" value="<?=$toMonth?>" />
<?
$yoil = array("일","월","화","수","목","금","토");
$att_day_yoil = $yoil[date('w',strtotime($att_day))];
?>
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
										<tr>
											<td nowrap class="tdrowk" width="105"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사원선택<font color="red">*</font></td>
											<td nowrap class="tdrow">
												<select name='sabun' >
													<option value=''>--사원선택--</option>
<?
//사원정보
$sql1 = " select * from $g4[pibohum_base] where com_code='$com_code' ";
$result1 = sql_query($sql1);
for($i=0; $row1=sql_fetch_array($result1); $i++) {
	$sabun_name[$row1[sabun]] = $row1[name];
?>
													<option value='<?=$row1[sabun]?>' <? if($row1[sabun] == $row_att[sabun]) echo "selected"; ?> ><?=$row1[name]?></option>
<?
}
?>
												</select>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">적용일자</td>
											<td nowrap class="tdrow">
												<input type="text" name="att_day_txt" size="10" value="<?=$att_day_txt?>" disabled/> (<?=$att_day_yoil?>)
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">적용시간</td>
											<td nowrap class="tdrow">
												<input type="text" name="att_time"  id="att_time"  size="6" value="<?=$att_time?>" maxlength="5" /> ~
												<input type="text" name="att_time2" id="att_time2" size="6" value="<?=$att_time2?>" maxlength="5" /> 예) 09:00 ~ 18:00
											</td>
										</tr>
									</table>
									<div style="height:2px;font-size:0px"></div>
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
										<tr>
											<td nowrap class="tdrowk" width="105"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">분류<font color="red">*</font></td>
											<td nowrap class="tdrow">
<?
$att_category_array = array("","결근","조퇴","지각","외출","추가연장","야간근로","출장","당직","교육","기타");
for($i=1; $i<count($att_category_array); $i++) {
?>
												<input type="radio" name="att_category" value="<?=$i?>" <? if($i == $row_att[att_category]) echo "checked"; ?> /><?=$att_category_array[$i]?>
<?
}
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">적용사유</td>
											<td nowrap class="tdrow">
												<input type="text" name="att_note" value="<?=$row_att[att_note]?>" class="input" style="width:700px" />
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">연차적용</td>
											<td nowrap class="tdrow">
												<input type="checkbox" name="att_annual_paid_holiday" value="1" <? if($row_att[att_annual_paid_holiday] == 1) echo "checked"; ?> > 연차적용
											</td>
										</tr>
									</table>
									<div style="height:10px;font-size:0px"></div>
									<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
										<tr>
											<td align="center">
												<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:checkData();" target="">저 장</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
<?
if($w == "u") {
?>
												<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:del(<?=$id?>,<?=$toYear?>,<?=$toMonth?>);" target="">삭 제</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
												<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="./attendance.php?toYear=<?=$toYear?>&toMonth=<?=$toMonth?>" target="">목 록</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
											</td>
										</tr>
									</table>
								</form>
							</div>
							<br>
							<!--댑메뉴 -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
												해당일 근태정보
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

							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
								<tr>
									<td nowrap class="tdhead_center" width="3%"><input type="checkbox" name="chk_all" value="1" class="textfm"></td>
									<td nowrap class="tdhead_center" width="80">적용일자</td>
									<td nowrap class="tdhead_center" width="90">적용시간</td>
									<td nowrap class="tdhead_center" width="70">이름</td>
									<td nowrap class="tdhead_center" width="100">분류</td>
									<td nowrap class="tdhead_center" width="">적용사유</td>
									<td nowrap class="tdhead_center" width="60">수정</td>
									<td nowrap class="tdhead_center" width="60">삭제</td>
								</tr>
<?
//근태관리DB
$sql_common = " from a4_attendance ";
//echo $is_admin;
if($is_admin == "super") {
	$sql_search = " where 1=1 ";
} else {
	$sql_search = " where com_code='$com_code' ";
}
if (!$sst) {
	if($is_admin == "super") {
		$sst = "com_code";
	} else {
		$sst = "att_day";
	}
	$sod = "asc";
}
$sql_order = " order by $sst $sod ";

//데이터 추출
$att_ymd = $toYear."".$monthday;
$sql_search .= " and att_day like '$att_ymd' ";

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
//echo $sql;
$result = sql_query($sql);

// 리스트 출력
for($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $total_count - $i - ($rows*($page-1));
	$id = $row[id];
	$list = $i%2;
	//적용일자
	$att_day = date('Y-m-d',strtotime($row[att_day]));
	//분류
	$att_category = $att_category_array[$row[att_category]];
	//연차적용
	if($row[att_annual_paid_holiday] == 1) {
		$att_annual_paid_holiday_txt = "(연차)";
	} else {
		$att_annual_paid_holiday_txt = "";
	}
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><input type="checkbox" name="chk[]" value="<?=$id?>" class="no_borer"></td>
									<td nowrap class="ltrow1_center_h22"><?=$att_day?></td>
										<td nowrap class="ltrow1_center_h22"><?=$row[att_time]?>~<?=$row[att_time2]?></td>
										<td nowrap class="ltrow1_center_h22"><?=$sabun_name[$row[sabun]]?></td>
										<td nowrap class="ltrow1_center_h22"><?=$att_category?><?=$att_annual_paid_holiday_txt?></td>
										<td nowrap class="ltrow1_left_h22"><?=$row[att_note]?></td>
									<td nowrap class="ltrow1_center_h22">
										<div id="btn_bsget_82">
										 <table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn1_lt.gif></td><td background=images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:modify(<?=$id?>,<?=$toYear?>,<?=$toMonth?>,'<?=$monthday?>');" target="">수정</a></td><td><img src=images/btn1_rt.gif></td><td width=2></td></tr></table>
										</div>
									</td>
									<td nowrap class="ltrow1_center_h22">
										<div id="btn_bslost_82">
										 <table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn1_lt.gif></td><td background=images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:del(<?=$id?>,<?=$toYear?>,<?=$toMonth?>);" target="">삭제</a></td><td><img src=images/btn1_rt.gif></td><td width=2></td></tr></table>
										</div>
									</td>
								</tr>
<?
}
if($i == 0) {
?>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td nowrap class="ltrow1_center_h22" colspan="<?=$colspan?>">자료가 없습니다.</td>
									</tr>
<?
}
?>
								<tr>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
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
<script type="text/javascript">

</script>
</body>
</html>
