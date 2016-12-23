<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-69345586-3', 'auto');
  ga('send', 'pageview');

</script>
<? $top_width = "1200"; ?>
<? $content_width = "1200"; ?>
<? $margin_right = "140"; ?>
<?
//사업장DB 옵션
$sql_opt = " select * from com_list_gy_opt where com_code='$com_code' ";
//echo $sql_opt;
$result_opt = sql_query($sql_opt);
$row_opt=mysql_fetch_array($result_opt);
if(!$row_opt[manage_cust_numb]) {
	$manage_name = "이민화";
	$manage_tel = "070-4680-7050";
	$manage_fax = "0505-609-0001";

} else {
	//담당 매니저
	$sql_manage = " select * from a4_manage where code='$row_opt[manage_cust_numb]' ";
	//echo $sql_manage;
	$result_manage = sql_query($sql_manage);
	$row_manage=mysql_fetch_array($result_manage);
	$manage_name = $row_manage[name];
	$manage_tel = $row_manage[tel];
	$manage_fax = $row_manage[fax];
}
?>
<link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
<div style="">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td align=center>
				<table width="<?=$top_width?>" align="center" border="0" cellpadding="0" cellspacing="0" style="margin:0 <?=$margin_right?>px 0 0;">
					<tr>
						<td width="180" align="left"><a href="main.php" target=""><img src="images/logo_kidsnomu.png" /></a></td>
						<td style="padding:10px 0 0 0" align="left">
							<table border="0" align="right" cellpadding="0" cellspacing="0" id="tables">
								<tr>
									<td width="180" align="left">
										<!--marquee behavior=scrol>[ <?=$member['mb_name']?> ] 담당자님 반갑습니다. <?=$easynomu_name?>입니다.</marquee-->
										<marquee behavior=scrol>[ <?=$easynomu_name?> ] 담당자님 반갑습니다.</marquee>
									</td>
									<td width="460" align="right">
										<div align="left" style="margin:0 10px 0 30px">
<?
//사업장DB 옵션
$sql_com_opt = " select * from com_list_gy_opt where com_code='$com_code' ";
//echo $sql1;
$result_com_opt = sql_query($sql_com_opt);
$row_com_opt=mysql_fetch_array($result_com_opt);
//담당 매니저
$manage_cust_numb_int = (int)$row_com_opt[manage_cust_numb];
$sql_manage = " select * from a4_manage where code='$manage_cust_numb_int' ";
//echo $sql_manage;
$result_manage = sql_query($sql_manage);
$row_manage=mysql_fetch_array($result_manage);
if($row_manage[name]) {
	$manage_cust_name = $row_manage[name];
	$manage_cust_tel = "직통 : ".$row_manage[tel];
	$manage_cust_fax = "FAX : ".$row_manage[fax];
} else {
	$manage_cust_name = "미지정";
	$manage_cust_tel = "";
	$manage_cust_fax = "";
}
//강제 담당자 지정
$manage_cust_name = "김국진 과장";
$manage_cust_tel = "직통 : 070-4680-0499";
$manage_cust_fax = "";
?>
										키즈노무 담당자 : <?=$manage_cust_name?>&nbsp;
										<?=$manage_cust_tel?>&nbsp;&nbsp;
										<?=$manage_cust_fax?>
										<br>
										사무대행 담당자 : 임현미 사원&nbsp;
										직통 : 070-4680-7050&nbsp;&nbsp;
										<!--직통 : 02-1111-1111&nbsp;&nbsp;&nbsp;-->
										FAX : 0505-609-0001
										<!--<br>프로그램 담당자 : 이영래&nbsp;&nbsp;&nbsp;
										직통 : 070-4680-7044&nbsp;&nbsp;&nbsp;-->
										</div>
									</td>
<?
if($is_admin == "super") {
?>
									<td align="left" style="padding:0 10px 0 0"><a href="/admin/member_list.php" target="_blank"><img src="images/btn_admin.png" border="0"></a></td>
<?
} else {
?>
									<td align="left" style="padding:0 10px 0 0"><a href="./list_notice.php?bo_table=oc_pds&wr_id=3"><img src="images/manual.png" border="0"></a></td>
									<td align="left" style="padding:0 10px 0 0"><a href="http://kidsnomu.com/kidsnomu/files/Kids-Nomu.zip"><img src="images/btn_url.png" border="0"></a></td>
<?
}
?>
									<td align="left" style="padding:0 10px 0 0"><a href="./remote_support.php"><img src="images/btn_cyber.gif" border="0"></a></td>
									<td align="left"><a href="/bbs/logout.php?url=%2Fkidsnomu%2Flogin.php"><img src="images/btn_logout.gif" border="0"></a></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<!--이지노무 2a549c 키즈노무 ef8036-->
			<td style="background:#ef8036;height:9px"></td>
		</tr>
		<tr>
			<td align="center">
				<script type="text/javascript">
				function getId(id)
				{
					return document.getElementById(id);
				}
				function showM(m)
				{
					for(i=1;i<10;i++) {
						hideM(i+"00");
					}
					var box = getId('subMenuBox'+m);
					if(box) {
						box.style.display = 'block';
						box.style.top = 0;
						//alert(box.style.top);
					}
				}
				function hideM(m)
				{
					var box = getId('subMenuBox'+m);
					if(box) box.style.display = 'none';
				}
				</script>
<?
//사업장DB 옵션
$sql_samu_req = " select * from com_list_gy_opt where com_code='$com_code' ";
$result_samu_req = sql_query($sql_samu_req);
$row_samu_req=mysql_fetch_array($result_samu_req);
$samu_req_yn = $row_samu_req[samu_req_yn];
if($samu_req_yn != 1) {
	$menu7_url = "form_4insure.php";
} else {
	$menu7_url = "4insure_list.php";
}
if($member['mb_level'] != 5) {
?>
				<table width="<?=$top_width?>" height="45" border="0" align="center" cellpadding="0" cellspacing="0" style="table-layout:fixed;background:url(./images/_menu_bg.gif);margin:0 <?=$margin_right?>px 0 0">
					<tr>
						<td width="145" align="left"><div align="center"><a href='com_list.php'     target="" onmouseover='img1.src="images/menu01_on.gif";showM("100");' onmouseout='img1.src="images/menu01_off.gif"'><img src='images/menu01_off.gif' name='img1' border="0" id="img1" /></a></div></td>
						<td width="145" align="left"><div align="center"><a href='staff_list.php'   target="" onmouseover='img2.src="images/menu02_on.gif";showM("200");' onmouseout='img2.src="images/menu02_off.gif"'><img src='images/menu02_off.gif' name='img2' border="0" id="img2" /></a></div></td>
						<td width="145" align="left"><div align="center"><a href='attendance.php'   target="" onmouseover='img3.src="images/menu03_on.gif";showM("300");' onmouseout='img3.src="images/menu03_off.gif"'><img src='images/menu03_off.gif' name='img3' border="0" id="img3" /></a></div></td>
						<td width="145" align="left"><div align="center"><a href='pay_list.php'     target="" onmouseover='img4.src="images/menu04_on.gif";showM("400");' onmouseout='img4.src="images/menu04_off.gif"'><img src='images/menu04_off.gif' name='img4' border="0" id="img4" /></a></div></td>
						<td width="145" align="left"><div align="center"><a href='retirement.php'   target="" onmouseover='img5.src="images/menu05_on.gif";showM("500");' onmouseout='img5.src="images/menu05_off.gif"'><img src='images/menu05_off.gif' name='img5' border="0" id="img5" /></a></div></td>
						<td width="145" align="left"><div align="center"><a href='form_labor.php' target="" onmouseover='img6.src="images/menu06_on.gif";showM("600");' onmouseout='img6.src="images/menu06_off.gif"'><img src='images/menu06_off.gif' name='img6' border="0" id="img6" /></a></div></td>
						<td width="145" align="left"><div align="center"><a href='<?=$menu7_url?>' target="" onmouseover='img7.src="images/menu07_on.gif";showM("700");' onmouseout='img7.src="images/menu07_off.gif"'><img src='images/menu07_off.gif' name='img7' border="0" id="img7" /></a></div></td>
						<td width="145" align="left"><div align="center"><a href='list_notice.php?bo_table=oc_notice' target="" onmouseover='img8.src="images/menu08_on.gif";showM("800");' onmouseout='img8.src="images/menu08_off.gif"'><img src='images/menu08_off.gif' name='img8' border="0" id="img8" /></a></div></td>
					</tr>
				</table>
			</td>
    </tr>
		<tr>
			<td align="center">
				<!--이지노무 8e7a5e-->
				<table width="<?=$top_width?>" height="33" border="0" valign="top" align="center" cellpadding="0" cellspacing="0" style="table-layout:fixed;background:#b0a28f;margin:0 <?=$margin_right?>px 0 0">
					<tr>
						<td align="left">
							<div style="position:relative;top:0;height:33px">
								<style type="text/css">
<?
//echo $_SERVER[HTTP_USER_AGENT];
if(preg_match("/MSIE 10.0[0-9]*/", $_SERVER[HTTP_USER_AGENT])) {
	//echo "10버전";
?>
								.submenubox {position:absolute;top:-2px;border:0 solid #aaaaaa;display:none;}
<?
} else {
?>
								.submenubox {position:absolute;top:-2px;border:0 solid #aaaaaa;display:none;}
<?
}
?>
								</style>
								<!--롤오버 이미지 업데이트-->
								<img src="images/sub04_con02_on.png" style="display:none;" />
								<img src="images/sub04_con03_on.png" style="display:none;" />
								<div id="subMenuBox100" class="submenubox" style="left:10px" >
									<table width="" height="33" border="0" align="" cellpadding="0" cellspacing="0">
										<tr>
											<td style="padding-left:40px"><div align="center"><a href="com_list.php"         target="" onmouseover="sim1_1.src='images/sub01_con01_on.png'" onmouseout="sim1_1.src='images/sub01_con01_off.png'"><img src="images/sub01_con01_off.png" name="sim1_1" border="0" id="sim1_1" /></a></div></td>
											<td style="padding-left:40px"><div align="center"><a href="com_code_list.php"    target="" onmouseover="sim1_2.src='images/sub01_con02_on.png'" onmouseout="sim1_2.src='images/sub01_con02_off.png'"><img src="images/sub01_con02_off.png" name="sim1_2" border="0" id="sim1_2" /></a></div></td>
											<td style="padding-left:40px"><div align="center"><a href="com_paycode_list.php?item=company" target="" onmouseover="sim1_3.src='images/sub01_con03_on.png'" onmouseout="sim1_3.src='images/sub01_con03_off.png'"><img src="images/sub01_con03_off.png" name="sim1_3" border="0" id="sim1_3" /></a></div></td>
										</tr>
									</table>
								</div>
								<div id="subMenuBox200" class="submenubox" style="left:156px" >
									<table width="" height="33" border="0" align="" cellpadding="0" cellspacing="0">
										<tr>
											<td style="padding-left:40px"><div align="center"><a href="staff_list.php"    target="" onmouseover="sim2_1.src='images/sub02_con01_on.png'" onmouseout="sim2_1.src='images/sub02_con01_off.png'"><img src="images/sub02_con01_off.png" name="sim2_1" border="0" id="sim2_1" /></a></div></td>
											<td style="padding-left:40px"><div align="center"><a href="staff_history.php" target="" onmouseover="sim2_2.src='images/sub02_con02_on.png'" onmouseout="sim2_2.src='images/sub02_con02_off.png'"><img src="images/sub02_con02_off.png" name="sim2_2" border="0" id="sim2_2" /></a></div></td>
										</tr>
									</table>
								</div>
								<div id="subMenuBox300" class="submenubox" style="left:306px" >
									<table width="" height="33" border="0" align="" cellpadding="0" cellspacing="0">
										<tr>
											<td style="padding-left:40px"><div align="center"><a href="attendance.php"      target="" onmouseover="sim3_1.src='images/sub03_con01_on.png'" onmouseout="sim3_1.src='images/sub03_con01_off.png'"><img src="images/sub03_con01_off.png" name="sim3_1" border="0" id="sim3_1" /></a></div></td>
											<td style="padding-left:40px"><div align="center"><a href="vacation.php"        target="" onmouseover="sim3_2.src='images/sub03_con02_on.png'" onmouseout="sim3_2.src='images/sub03_con02_off.png'"><img src="images/sub03_con02_off.png" name="sim3_2" border="0" id="sim3_2" /></a></div></td>
										</tr>
									</table>
								</div>
								<div id="subMenuBox400" class="submenubox" style="left:458px" >
									<table width="" height="33" border="0" align="" cellpadding="0" cellspacing="0">
										<tr>
											<td style="padding-left:40px"><div align="center"><a href="pay_list.php"       target="" onmouseover="sim4_1.src='images/sub04_con01_on.png'" onmouseout="sim4_1.src='images/sub04_con01_off.png'"><img src="images/sub04_con01_off.png" name="sim4_1" border="0" id="sim4_1" /></a></div></td>
<?
//엑셀업로드 반기 신고 업체 선정 160629
//효돈 20277, 창평 20264, 세창 20252, 나경 20389, 비네 20486, 화랑 20298, 다솜 20285, 해남 20278, 송백마을 20259, 주례2동 20334, 해오름 20045, 큰숲 20534, 꼬마숲어린이집(횡성점) 20310
if($com_code==20277 || $com_code==20264 || $com_code==20252 || $com_code==20389 || $com_code==20486 || $com_code==20298 || $com_code==20285 || $com_code==20278 || $com_code==20259 || $com_code==20334 || $com_code==20045 || $com_code==20534 || $com_code==20310) {
	$excel_upload_com = "ok";
?>
											<td style="padding-left:40px"><div align="center"><a href="pay_excel.php"     target="" onmouseover="sim4_5.src='images/sub04_con05_on.png'" onmouseout="sim4_5.src='images/sub04_con05_off.png'"><img src="images/sub04_con05_off.png" name="sim4_5" border="0" id="sim4_5" /></a></div></td>
<?
}
?>
											<td style="padding-left:40px"><div align="center"><a href="pay_ledger_list.php"     target="" onmouseover="sim4_2.src='images/sub04_con02_on.png'" onmouseout="sim4_2.src='images/sub04_con02_off.png'"><img src="images/sub04_con02_off.png" name="sim4_2" border="0" id="sim4_2" /></a></div></td>
											<td style="padding-left:40px"><div align="center"><a href="pay_statistics.php" target="" onmouseover="sim4_3.src='images/sub04_con03_on.png'" onmouseout="sim4_3.src='images/sub04_con03_off.png'"><img src="images/sub04_con03_off.png" name="sim4_3" border="0" id="sim4_3" /></a></div></td>
											<td style="padding-left:40px"><div align="center"><a href="pay_account.php" target="" onmouseover="sim4_4.src='images/sub04_con04_on.png'" onmouseout="sim4_4.src='images/sub04_con04_off.png'"><img src="images/sub04_con04_off.png" name="sim4_4" border="0" id="sim4_4" /></a></div></td>
										</tr>
									</table>
								</div>
								<div id="subMenuBox500" class="submenubox" style="left:610px" >
									<table width="" height="33" border="0" align="" cellpadding="0" cellspacing="0">
										<tr>
											<td style="padding-left:40px"><div align="center"><a href="retirement.php" target="" onmouseover="sim5_1.src='images/sub05_con01_on.png'" onmouseout="sim5_1.src='images/sub05_con01_off.png'"><img src="images/sub05_con01_off.png" name="sim5_1" border="0" id="sim5_1" /></a></div></td>
											<td style="padding-left:40px"><div align="center"><a href="annual_paid_holiday.php"   target="" onmouseover="sim5_2.src='images/sub05_con02_on.png'" onmouseout="sim5_2.src='images/sub05_con02_off.png'"><img src="images/sub05_con02_off.png" name="sim5_2" border="0" id="sim5_2" /></a></div></td>
											<td style="padding-left:40px"><div align="center"><a href="bonus.php" target="" onmouseover="sim5_3.src='images/sub05_con03_on.png'" onmouseout="sim5_3.src='images/sub05_con03_off.png'"><img src="images/sub05_con03_off.png" name="sim5_3" border="0" id="sim5_3" /></a></div></td>
										</tr>
									</table>
								</div>
								<div id="subMenuBox600" class="submenubox" style="left:730px" >
									<table width="" height="33" border="0" align="" cellpadding="0" cellspacing="0">
										<tr>
											<td style="padding-left:40px"><div align="center"><a href="form_labor.php"   target="" onmouseover="sim6_2.src='images/sub06_con02_on.png'" onmouseout="sim6_2.src='images/sub06_con02_off.png'"><img src="images/sub06_con02_off.png" name="sim6_2" border="0" id="sim6_2" /></a></div></td>
											<td style="padding-left:40px"><div align="center"><a href="form_inspect.php" target="" onmouseover="sim6_3.src='images/sub06_con03_on.png'" onmouseout="sim6_3.src='images/sub06_con03_off.png'"><img src="images/sub06_con03_off.png" name="sim6_3" border="0" id="sim6_3" /></a></div></td>
										</tr>
									</table>
								</div>
								<div id="subMenuBox700" class="submenubox" style="left:908px" >
									<table width="" height="33" border="0" align="" cellpadding="0" cellspacing="0">
										<tr>
											<td style="padding-left:40px"><div align="center"><a href="/kidsnomu/4insure_popup.php" onclick="window.open(this.href, '4insure_popup', 'height=780,width=920,toolbar=no,directories=no,status=no,linemenubar=no,scrollbars=yes,resizable=no');return false;" target="" onmouseover="sim7_3.src='images/sub07_con03_on.png'" onmouseout="sim7_3.src='images/sub07_con03_off.png'"><img src="images/sub07_con03_off.png" name="sim7_3" border="0" id="sim7_3" /></a></div></td>
<?
if($samu_req_yn != 1) {
?>
											<td style="padding-left:40px"><div align="center"><a href="form_4insure.php" target="" onmouseover="sim7_1.src='images/sub07_con01_on.png'" onmouseout="sim7_1.src='images/sub07_con01_off.png'"><img src="images/sub07_con01_off.png" name="sim7_1" border="0" id="sim7_1" /></a></div></td>
<?
} else {
?>
											<td style="padding-left:40px"><div align="center"><a href="4insure_list.php" target="" onmouseover="sim7_2.src='images/sub07_con02_on.png'" onmouseout="sim7_2.src='images/sub07_con02_off.png'"><img src="images/sub07_con02_off.png" name="sim7_2" border="0" id="sim7_2" /></a></div></td>
<?
}
?>
										</tr>
									</table>
								</div>
								<div id="subMenuBox800" class="submenubox" style="left:658px" >
									<table width="" height="33" border="0" align="" cellpadding="0" cellspacing="0">
										<tr>
											<td style="padding-left:40px"><div align="center"><a href="list_notice.php?bo_table=oc_notice" target="" onmouseover="sim8_1.src='images/sub08_con01_on.png'" onmouseout="sim8_1.src='images/sub08_con01_off.png'"><img src="images/sub08_con01_off.png" name="sim8_1" border="0" id="sim8_1" /></a></div></td>
											<td style="padding-left:40px"><div align="center"><a href="list_notice.php?bo_table=oc_event"  target="" onmouseover="sim8_2.src='images/sub08_con02_on.png'" onmouseout="sim8_2.src='images/sub08_con02_off.png'"><img src="images/sub08_con02_off.png" name="sim8_2" border="0" id="sim8_2" /></a></div></td>
											<td style="padding-left:40px"><div align="center"><a href="list_notice.php?bo_table=oc_free"   target="" onmouseover="sim8_3.src='images/sub08_con03_on.png'" onmouseout="sim8_3.src='images/sub08_con03_off.png'"><img src="images/sub08_con03_off.png" name="sim8_3" border="0" id="sim8_3" /></a></div></td>
											<td style="padding-left:40px"><div align="center"><a href="list_notice.php?bo_table=oc_pds"    target="" onmouseover="sim8_4.src='images/sub08_con04_on.png'" onmouseout="sim8_4.src='images/sub08_con04_off.png'"><img src="images/sub08_con04_off.png" name="sim8_4" border="0" id="sim8_4" /></a></div></td>
											<td style="padding-left:40px"><div align="center"><a href="list_notice.php?bo_table=oc_online" target="" onmouseover="sim8_5.src='images/sub08_con05_on.png'" onmouseout="sim8_5.src='images/sub08_con05_off.png'"><img src="images/sub08_con05_off.png" name="sim8_5" border="0" id="sim8_5" /></a></div></td>
										</tr>
									</table>
								</div>
							</div>
						</td>
					</tr>
				</table>
<?
//지사/영업사원 전용 ID 접속시 표시안함
}
?>
			</td>
    </tr>
	</table>
	<div style="margin-right:<?=$margin_right?>px;width:100%">
	<div style="margin-right:<?=$margin_right?>px;">
<?
$sub_menu_str = substr($sub_menu,0,3);
?>
<script type="text/javascript">
function showMenu_top_reset() {
	showM(<?=$sub_menu_str?>);
}
addLoadEvent(showMenu_top_reset);
</script>
