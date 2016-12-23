							<!--급여반영 입력폼-->
							<iframe name="hframe" src="" style="width:0;height:0;border:0"></iframe>
							<form name="printForm" method="post" style="margin:0">
								<input type="hidden" name="mode">
								<input type="hidden" name="search_year" value="<?=$search_year?>">
								<input type="hidden" name="search_month" value="<?=$search_month?>">
								<input type="hidden" name="stx_dept" value="<?=$stx_dept?>">
							</form>
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr> 
									<td id="Tab_cust_tab_01_0"> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="./images/g_tab_on_lt.gif"></td> 
												<td background="./images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80px;text-align:center'> 
												<a href="#">검색</a>
												</td> 
												<td><img src="./images/g_tab_on_rt.gif"></td> 
											</tr> 
										</table> 
									</td> 
									<td width=2></td> 
								</tr> 
							</table>
							<div style="height:2px;font-size:0px" class="bgtr"></div>
							<div style="height:2px;font-size:0px;line-height:0px;"></div>
							<!--댑메뉴 -->
							<!--검색 -->
							<form name="searchForm" method="get">
								<input type="hidden" name="select_type" value="" />
								<input type="hidden" name="stx_dept" value="<?=$stx_dept?>" />
								<input type="hidden" name="search_pay_gbn" value="01" />
								<input type="hidden" name="add_work_numb" />
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="" style="table-layout:">
									<col width="180">
									<col width="140">
									<col width="">
									<tr>
										<td class="tdrow">
<?
//디윅스
if($com_code == "20284") {
?>
											<select name="stx_dept" class="selectfm">
												<?
												$sql_dept = " select * from com_code_list where item='dept' and com_code='$com_code' order by code ";
												$result_dept = sql_query($sql_dept);
												for($i=0; $row_dept=sql_fetch_array($result_dept); $i++) {
												?>

												<option value="<?=$row_dept[code]?>" <? if($stx_dept == $row_dept[code]) echo "selected"; ?> ><?=$row_dept[name]?></option>
												<?
												}
												?>
											</select>
											부서
<?
}
?>
											<select name="search_year" class="selectfm" onChange="goSearch();">
<?
for($i=2013;$i<=2016;$i++) {
?>
												<option value="<?=$i?>" <? if($i == $search_year) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
											</select> 년
											<select name="search_month" class="selectfm" onChange="goSearch();">
<?
for($i=1;$i<13;$i++) {
	if($i < 10) $month = "0".$i;
	else $month = $i;
?>
			<option value="<?=$month?>" <? if($i == $search_month) echo "selected"; ?> ><?=$month?></option>
<?
}
?>
											</select> 월
											<div style="padding:0 0 0 2px;display:inline">
												<a href="javascript:month_minus();"><img src="images/btn_del.png" align="absmiddle" border="0"></a>
												<a href="javascript:month_plus();"><img src="images/btn_add.png" align="absmiddle" border="0"></a>
											</div>
										</td>
										<td nowrap class="tdrow">
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;height:18px;">
												<tr>
													<td width=2></td><td><img src=images/btn9_lt.gif></td>
													<td style="background:url(images/btn9_bg.gif) repeat-x center" class=ftbutton5_white nowrap><a href="javascript:goSearch();" target="">검 색</a></td><td><img src=images/btn9_rt.gif></td><td width=2></td>
												</tr>
											</table> 
										</td>
										<td nowrap class="tdrow">
											<b>급여지급일</b> : <?=$pay_date?>  / <b>최종저장일</b> : <?=$w_date?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrow" colspan="2" style="height:38px">
											<b>임금산출기간</b> : <?=$pay_calculate_date?>
<?
//(주)노아텍 160129
if($com_code == 20623) {
	$pay_calculate_date_hday = $row_com_opt['pay_calculate_day1_hday']." ".$row_com_opt['pay_calculate_day_period1_hday']."일 ~ ".$row_com_opt['pay_calculate_day2_hday']." ".$row_com_opt['pay_calculate_day_period2_hday']."일";
?>
											<br /><b>휴일근로</b> : <?=$pay_calculate_date_hday?>
<?
}
?>
										</td>
										<td nowrap class="tdrow" colspan="" style="text-align:right">
<?
//권한별 링크값
if($member['mb_profile'] == "guest") {
	$url_save = "javascript:alert_demo();";
	$url_preview = "javascript:alert_demo();";
	$url_paylist = "javascript:alert_demo();";
} else {
	if(!$mode) $mode = "input";
	$url_save = "javascript:goInput('".$mode."');";
	$url_preview = "javascript:goInput('preview');";
	$url_paylist = "javascript:printPayList();";
}
?>
											<div style="float:left">
												<select name="copy_year" id="copy_year" class="selectfm" style="font-size:12pt;">
<?
//급여복사 기본 년월 전달 표시 150723
if(!$copy_month) {
	$copy_month = $search_month;
	//echo $copy_month;
	if($copy_month == 1) {
		$copy_year_minus = 1;
		$copy_month = 12;
	} else {
		$copy_year_minus = 0;
		$copy_month -= 1;
	}
	if($copy_month < 10) $copy_month = "0".$copy_month;
	$copy_year = $search_year;
	$copy_year -= $copy_year_minus;
}
for($i=2013;$i<=2016;$i++) {
?>
													<option value="<?=$i?>" <? if($i == $copy_year) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
												</select> 년<br />
												<select name="copy_month" id="copy_month" class="selectfm" style="font-size:12pt;">
<?
for($i=1;$i<=12;$i++) {
	if($i < 10) $month = "0".$i;
	else $month = $i;
?>
													<option value="<?=$month?>" <? if($i == $copy_month) echo "selected"; ?> ><?=$month?></option>
<?
}
?>
												</select> 월
											</div>
											<div style="float:left;padding-left:4px;">
												<span onclick="pay_copy('<?=$PHP_SELF?>');" style="cursor:pointer"><img src="images/btn_pay_copy_big.png" border="0" /></span>
											</div>
											<div style="float:right">
												<a href="<?=$PHP_SELF?>?data=load&select_type=<?=$select_type?>&search_pay_gbn=<?=$search_pay_gbn?>&stx_dept=<?=$stx_dept?>&add_work_numb=<?=$add_work_numb?>&search_year=<?=$search_year?>&search_month=<?=$search_month?>" target=""><img src="images/btn_staff_pay_get_big.png" border="0"></a>
												<a href="<?=$PHP_SELF?>?select_type=<?=$select_type?>&search_pay_gbn=<?=$search_pay_gbn?>&stx_dept=<?=$stx_dept?>&add_work_numb=<?=$add_work_numb?>&search_year=<?=$search_year?>&search_month=<?=$search_month?>" target=""><img src="images/btn_last_pay_get_big.png" border="0"></a>
												<a href="javascript:cal_pay_bt();" target=""><img src="images/btn_paycal_big.png" border="0"></a>
												<!--<a href="<?=$url_preview?>" target=""><img src="images/btn_preview_big.png" border="0"></a>-->
												<a href="<?=$url_save?>" target=""><img src="images/btn_paysave_big.png" border="0"></a>
												<a href="<?=$url_paylist?>" target=""><img src="images/btn_paylist_big_07.png" border="0"></a>
											</div>
										</td>
									</tr>
								</table>
							</form>
							<div style="height:10px;font-size:0px;line-height:0px;"></div>
<!--제이쿼리 -->
<script type="text/javascript" src="popup/images/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="popup/images/jquery.maskedinput-1.3.min.js"></script>
<script type="text/javascript">
function pay_step_btn(no) {
	for(i=1;i<=5;i++) {
		getId("pay_step"+i).src = "images/pay_step"+i+".gif";
	}
	getId("pay_step"+no).src = "images/pay_step"+no+"_on.gif";
}
$(function(){
	$('#step1').click(function() { 
		$('#spanTop').scrollLeft(0);
		$('#spanMain').scrollLeft(0);
		pay_step_btn(1);
	});
	$('#step2').click(function() { 
		$('#spanTop').scrollLeft(710);
		$('#spanMain').scrollLeft(710);
		pay_step_btn(2);
	});
	$('#step3').click(function() { 
		$('#spanTop').scrollLeft(1420);
		$('#spanMain').scrollLeft(1420);
		pay_step_btn(3);
	});
	$('#step4').click(function() { 
		$('#spanTop').scrollLeft(2130);
		$('#spanMain').scrollLeft(2130);
		pay_step_btn(4);
	});
	$('#step5').click(function() { 
		$('#spanTop').scrollLeft(2840);
		$('#spanMain').scrollLeft(2840);
		pay_step_btn(5);
	});
});
//급여복사
function pay_copy(url) {
	self.location.href = url+"?data=copy&amp;select_type=<?=$select_type?>&amp;search_pay_gbn=<?=$search_pay_gbn?>&amp;add_work_numb=<?=$add_work_numb?>&amp;search_year=<?=$search_year?>&amp;search_month=<?=$search_month?>&amp;copy_year="+getId('copy_year').value+"&amp;copy_month="+getId('copy_month').value;
}
</script>
							<!--검색 -->
							<form name="dataForm" method="post">
								<input type="hidden" name="mode">
								<input type="hidden" name="pay_gbn_value" value="0">
								<input type="hidden" name="code" value="<?=$com_code?>">
								<input type="hidden" name="search_year" value="<?=$search_year?>">
								<input type="hidden" name="search_month" value="<?=$search_month?>">
								<input type="hidden" name="stx_dept" value="<?=$stx_dept?>">
								<input type="hidden" name="total_count" value="<?=$total_count?>">
								<input type="hidden" name="search_pay_gbn" value="01">
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
										<td width="" align="left">
											<div id="step1" style="cursor:pointer;margin:0 5px 0 0"><img src="images/pay_step1_on.gif" id="pay_step1"></div>
										</td> 
										<td width="" align="left">
											<div id="step2" style="cursor:pointer;margin:0 5px 0 0"><img src="images/pay_step2.gif" id="pay_step2"></div>
										</td> 
										<td width="" align="left">
											<div id="step3" style="cursor:pointer;margin:0 5px 0 0"><img src="images/pay_step3.gif" id="pay_step3"></div>
										</td> 
										<td width="" align="left">
											<div id="step4" style="cursor:pointer;margin:0 5px 0 0"><img src="images/pay_step4.gif" id="pay_step4"></div>
										</td> 
										<td width="" align="left">
											<div id="step5" style="cursor:pointer;margin:0 5px 0 0"><img src="images/pay_step5.gif" id="pay_step5"></div>
										</td> 
										<td align="right" style="padding-left:20px">사원수 : <?=$total_count?>명</td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--댑메뉴 -->