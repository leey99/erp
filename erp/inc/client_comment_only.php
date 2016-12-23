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
//신규고용확인 13 / 직무발명보상제도 14 / 전력수요관리 15 160927
for($t=1;$t<=15;$t++) {
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
										<td style="background:#ffffff;padding:4px;">
											<div style="float:left;margin-right:2px;"><a href="<?=$total_memo_url?>" onclick="tab_memo_over(1);getId('popup_memo_iframe').src=this.href;return false;"><img src="./images/comment_tab<?=$tab_over[1]?>.png" border="0" id="tab_memo1" alt="전체" /></a></div>
											<div style="float:left;margin-right:2px;"><a href="<?=$client_memo_url?>" onclick="tab_memo_over(2);getId('popup_memo_iframe').src=this.href;return false;"><img src="./images/comment_tab2<?=$tab_over[2]?>.png" border="0" id="tab_memo2" alt="거래처" /></a></div>
											<div style="float:left;margin-right:2px;"><a href="<?=$samu_memo_url?>" onclick="tab_memo_over(3);getId('popup_memo_iframe').src=this.href;return false;"><img src="./images/comment_tab3<?=$tab_over[3]?>.png" border="0" id="tab_memo3" alt="사무위탁" /></a></div>
											<div style="float:left;margin-right:2px;"><a href="<?=$job_education_memo_url?>" onclick="tab_memo_over(4);getId('popup_memo_iframe').src=this.href;return false;"><img src="./images/comment_tab4<?=$tab_over[4]?>.png" border="0" id="tab_memo4" alt="사업주훈련" /></a></div>
											<div style="float:left;margin-right:2px;display:none;"><a href="<?=$danger_evaluate_memo_url?>" onclick="tab_memo_over(5);getId('popup_memo_iframe').src=this.href;return false;"><img src="./images/comment_tab5<?=$tab_over[5]?>.png" border="0" id="tab_memo5" alt="위험성평가" /></a></div>
											<div style="float:left;margin-right:2px;"><a href="<?=$support_memo_url?>" onclick="tab_memo_over(6);getId('popup_memo_iframe').src=this.href;return false;"><img src="./images/comment_tab6<?=$tab_over[6]?>.png" border="0" id="tab_memo6" alt="지원금" /></a></div>
											<div style="float:left;margin-right:2px;"><a href="<?=$program_memo_url?>" onclick="tab_memo_over(7);getId('popup_memo_iframe').src=this.href;return false;"><img src="./images/comment_tab7<?=$tab_over[7]?>.png" border="0" id="tab_memo7" alt="프로그램" /></a></div>
											<div style="float:left;margin-right:2px;"><a href="<?=$family_insurance_memo_url?>" onclick="tab_memo_over(8);getId('popup_memo_iframe').src=this.href;return false;"><img src="./images/comment_tab8<?=$tab_over[8]?>.png" border="0" id="tab_memo8" alt="가족보험료" /></a></div>
											<div style="float:left;margin-right:2px;"><a href="<?=$policy_fund_memo_url?>" onclick="tab_memo_over(9);getId('popup_memo_iframe').src=this.href;return false;"><img src="./images/comment_tab9<?=$tab_over[9]?>.png" border="0" id="tab_memo9" alt="정책자금" /></a></div>
											<div style="float:left;margin-right:2px;"><a href="<?=$popup_memo_url[10]?>" onclick="tab_memo_over(10);getId('popup_memo_iframe').src=this.href;return false;"><img src="./images/comment_tab10<?=$tab_over[10]?>.png" border="0" id="tab_memo10" alt="고용창출" /></a></div>
											<div style="float:left;margin-right:2px;"><a href="<?=$popup_memo_url[11]?>" onclick="tab_memo_over(11);getId('popup_memo_iframe').src=this.href;return false;"><img src="./images/comment_tab11<?=$tab_over[11]?>.png" border="0" id="tab_memo11" alt="전기요금컨설팅" /></a></div>
											<div style="float:left;margin-right:2px;"><a href="<?=$popup_memo_url[12]?>" onclick="tab_memo_over(12);getId('popup_memo_iframe').src=this.href;return false;"><img src="./images/comment_tab12<?=$tab_over[12]?>.png" border="0" id="tab_memo12" alt="지원대상확인" /></a></div>
											<div style="float:left;margin-right:2px;"><a href="<?=$popup_memo_url[13]?>" onclick="tab_memo_over(13);getId('popup_memo_iframe').src=this.href;return false;"><img src="./images/comment_tab13<?=$tab_over[13]?>.png" border="0" id="tab_memo13" alt="신규고용확인" /></a></div>
											<div style="float:left;margin-right:2px;"><a href="<?=$popup_memo_url[14]?>" onclick="tab_memo_over(14);getId('popup_memo_iframe').src=this.href;return false;"><img src="./images/comment_tab14<?=$tab_over[14]?>.png" border="0" id="tab_memo14" alt="직무발명보상제도" /></a></div>
											<div style="float:left;margin-right:2px;"><a href="<?=$popup_memo_url[15]?>" onclick="tab_memo_over(15);getId('popup_memo_iframe').src=this.href;return false;"><img src="./images/comment_tab15<?=$tab_over[15]?>.png" border="0" id="tab_memo15" alt="전력수요관리" /></a></div>
										</td>
									</tr>
									<tr>
										<td class="tdrow">
<script type="text/javascript">
//<![CDATA[
<?
//전기요금컨설팅 뷰페이지일 경우 resizeFrame 함수 호출하지 않음 160530
if($sub_menu != "1900300") {
?>
function resizeFrame(frm) {
	frm.style.height = "auto";
	contentHeight = frm.contentWindow.document.documentElement.scrollHeight;
	frm.style.height = contentHeight + 0 + "px";
}
<?
}
?>
//13 -> 14 -> 15
function tab_memo_over(no) {
	for(i=1;i<=15;i++) {
		if(i == 1) getId('tab_memo'+i).src="./images/comment_tab_over.png";
		else getId('tab_memo'+i).src="./images/comment_tab"+i+".png";
	}
	if(no == 1) getId('tab_memo'+no).src="./images/comment_tab_over.png";
	else getId('tab_memo'+no).src="./images/comment_tab"+no+"_over.png";
}
//]]>
</script>
											<iframe id="popup_memo_iframe" src="popup_memo.php?id=<?=$com_code?>&amp;memo_type=<?=$memo_type?>&amp;job_id=<?=$job_id?>&amp;manage_code=<?=$manage_code?>" frameborder="0" width="100%" height="200" onload="resizeFrame(this)" scrolling="auto" style="margin:10px 0 0 0"></iframe>
										</td>
									</tr>
								</table>
							</div>
