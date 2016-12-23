										<!--댑메뉴 -->
										<table border="0" cellspacing="0" cellpadding="0"> 
											<tr>
												<td> 
													<table border="0" cellpadding="0" cellspacing="0"> 
														<tr> 
															<td><img src="images/so_tab_on_lt.gif" alt="[" /></td> 
															<td class="Sftbutton_white" style="background:url('images/so_tab_on_bg.gif');width:100;text-align:center;">
																피보험자신고
															</td> 
															<td><img src="images/so_tab_on_rt.gif" alt="]" /></td> 
														</tr> 
													</table> 
												</td> 
												<td width="2"></td> 
												<td valign="bottom"></td> 
											</tr> 
										</table>
										<div style="height:2px;font-size:0px" class="botr"></div>
										<div style="height:2px;font-size:0px;line-height:0px;"></div>
<?
$total_samu_url = "popup_4insure.php?id=".$com_code;
$get_samu_url  = "popup_4insure.php?id=".$com_code."&stx_report_kind=1";
$loss_samu_url = "popup_4insure.php?id=".$com_code."&stx_report_kind=2";
$change_samu_url = "popup_4insure.php?id=".$com_code."&stx_report_kind=3";
$existence_samu_url = "popup_4insure.php?id=".$com_code."&stx_report_kind=4";
$extinct_samu_url = "popup_4insure.php?id=".$com_code."&stx_report_kind=5";
$modify_samu_url = "popup_4insure.php?id=".$com_code."&stx_report_kind=6";
$except_samu_url = "popup_4insure.php?id=".$com_code."&stx_report_kind=7";
$etc_samu_url = "popup_4insure.php?id=".$com_code."&stx_report_kind=8";
$tab_over = array();
for($t=1;$t<=4;$t++) {
	$tab_over[$t] = "";
}
//탭 메뉴 오버 No
if(!$memo_type) $tab_over[1] = "_over";
else $tab_over[$memo_type] = "_over";
?>
										<!-- 입력폼 -->
										<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1">
											<tr>
												<td style="background:#ffffff;padding:4px;">
													<div style="">
														<div style="float:left;margin-right:2px;"><a href="<?=$total_samu_url?>" onclick="tab_samu_over(1);getId('popup_4insure_iframe').src=this.href;return false;"><img src="./images/samu_4insure_tab<?=$tab_over[1]?>.png" border="0" id="tab_samu1" alt="전체" /></a></div>
														<div style="float:left;margin-right:2px;"><a href="<?=$get_samu_url?>" onclick="tab_samu_over(2);getId('popup_4insure_iframe').src=this.href;return false;"><img src="./images/samu_4insure_tab2<?=$tab_over[2]?>.png" border="0" id="tab_samu2" alt="취득신고" /></a></div>
														<div style="float:left;margin-right:2px;"><a href="<?=$loss_samu_url?>" onclick="tab_samu_over(3);getId('popup_4insure_iframe').src=this.href;return false;"><img src="./images/samu_4insure_tab3<?=$tab_over[3]?>.png" border="0" id="tab_samu3" alt="상실신고" /></a></div>
														<div style="float:left;margin-right:2px;"><a href="<?=$change_samu_url?>" onclick="tab_samu_over(4);getId('popup_4insure_iframe').src=this.href;return false;"><img src="./images/samu_4insure_tab4<?=$tab_over[4]?>.png" border="0" id="tab_samu4" alt="보수변경" /></a></div>
														<div style="float:left;margin-right:2px;"><a href="<?=$existence_samu_url?>" onclick="tab_samu_over(5);getId('popup_4insure_iframe').src=this.href;return false;"><img src="./images/samu_4insure_tab5<?=$tab_over[5]?>.png" border="0" id="tab_samu5" alt="성립신고" /></a></div>
														<div style="float:left;margin-right:2px;"><a href="<?=$extinct_samu_url?>" onclick="tab_samu_over(6);getId('popup_4insure_iframe').src=this.href;return false;"><img src="./images/samu_4insure_tab6<?=$tab_over[6]?>.png" border="0" id="tab_samu6" alt="소멸신고" /></a></div>
														<div style="float:left;margin-right:2px;"><a href="<?=$modify_samu_url?>" onclick="tab_samu_over(7);getId('popup_4insure_iframe').src=this.href;return false;"><img src="./images/samu_4insure_tab7<?=$tab_over[7]?>.png" border="0" id="tab_samu7" alt="변경신고" /></a></div>
														<div style="float:left;margin-right:2px;"><a href="<?=$except_samu_url?>" onclick="tab_samu_over(8);getId('popup_4insure_iframe').src=this.href;return false;"><img src="./images/samu_4insure_tab8<?=$tab_over[8]?>.png" border="0" id="tab_samu8" alt="예외재개" /></a></div>
														<div style="float:left;margin-right:2px;"><a href="<?=$etc_samu_url?>" onclick="tab_samu_over(9);getId('popup_4insure_iframe').src=this.href;return false;"><img src="./images/samu_4insure_tab9<?=$tab_over[9]?>.png" border="0" id="tab_samu9" alt="기타" /></a></div>
													</div>
<script type="text/javascript">
//<![CDATA[
function resizeFrame(frm) {
	frm.style.height = "auto";
	contentHeight = frm.contentWindow.document.documentElement.scrollHeight;
	frm.style.height = contentHeight + 0 + "px";
}
function tab_samu_over(no) {
	for(i=1;i<=4;i++) {
		if(i == 1) getId('tab_samu'+i).src="./images/samu_4insure_tab_over.png";
		else getId('tab_samu'+i).src="./images/samu_4insure_tab"+i+".png";
	}
	if(no == 1) getId('tab_samu'+no).src="./images/samu_4insure_tab_over.png";
	else getId('tab_samu'+no).src="./images/samu_4insure_tab"+no+"_over.png";
}
//]]>
</script>
														<div style="clear:both;">
															<iframe id="popup_4insure_iframe" src="popup_4insure.php?id=<?=$com_code?>&stx_report_kind=<?=$stx_report_kind?>" frameborder="0" width="100%" height="200" scrolling="no" style="margin:4px 0 0 0"></iframe>
														</div>
													</div>
												</td>
											</tr>
										</table>
									</div>
									<div style="height:10px;font-size:0px;line-height:0px;"></div>