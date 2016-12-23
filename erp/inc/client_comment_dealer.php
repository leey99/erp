								<!--전달사항-->
								<div style="height:10px;font-size:0px;line-height:0px;"></div>
								<!--댑메뉴 -->
								<a name="80001"><!--전달사항--></a>
								<table border="0" cellspacing="0" cellpadding="0"> 
									<tr>
										<td> 
											<table border="0" cellpadding="0" cellspacing="0"> 
												<tr> 
													<td><img src="images/so_tab_on_lt.gif" alt="[" /></td> 
													<td class="Sftbutton_white" style="background:url('images/so_tab_on_bg.gif');width:100px;text-align:center;">
														전달사항
													</td> 
													<td><img src="images/so_tab_on_rt.gif" alt="]" /></td> 
												</tr> 
											</table> 
										</td> 
										<td width=2></td> 
										<td valign="bottom"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="botr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
<?
$total_memo_url = "popup_memo.php?id=".$com_code;
$client_memo_url = "popup_memo.php?id=".$com_code."&memo_type=2";
$samu_memo_url = "popup_memo.php?id=".$com_code."&memo_type=3";
$job_education_memo_url = "popup_memo.php?id=".$com_code."&memo_type=4";
$danger_evaluate_memo_url = "popup_memo.php?id=".$com_code."&memo_type=5";
$support_memo_url = "popup_memo.php?id=".$com_code."&memo_type=6";
$program_memo_url = "popup_memo.php?id=".$com_code."&memo_type=7";
$family_insurance_memo_url = "popup_memo.php?id=".$com_code."&memo_type=8";
$policy_fund_memo_url = "popup_memo.php?id=".$com_code."&memo_type=9";
$tab_over = array();
for($t=1;$t<=13;$t++) {
	$tab_over[$t] = "";
	$popup_memo_url[$t] = "popup_memo.php?id=".$com_code."&memo_type=".$t;
}
//탭 메뉴 오버 No
if(!$memo_type) $tab_over[1] = "_over";
else $tab_over[$memo_type] = "_over";
?>
								<!-- 입력폼 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1">
									<tr>
										<td class="tdrow">
<script type="text/javascript">
//<![CDATA[
function resizeFrame(frm) {
	frm.style.height = "auto";
	contentHeight = frm.contentWindow.document.documentElement.scrollHeight;
	frm.style.height = contentHeight + 0 + "px";
}
function tab_memo_over(no) {
	for(i=1;i<=13;i++) {
		if(i == 1) getId('tab_memo'+i).src="./images/comment_tab_over.png";
		else getId('tab_memo'+i).src="./images/comment_tab"+i+".png";
	}
	if(no == 1) getId('tab_memo'+no).src="./images/comment_tab_over.png";
	else getId('tab_memo'+no).src="./images/comment_tab"+no+"_over.png";
}
//]]>
</script>
											<iframe id="popup_memo_iframe" src="popup_memo_dealer.php?id=<?=$com_code?>&amp;memo_type=<?=$memo_type?>" frameborder="0" width="100%" height="200" onload="resizeFrame(this)" scrolling="auto" style="margin:10px 0 0 0"></iframe>
										</td>
									</tr>
								</table>
							</div>
