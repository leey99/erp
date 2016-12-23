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
								<!-- 입력폼 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1">
									<tr>
										<td class="tdrow">
<?
//전기공사 업체와의 전달사항 memo_type = 99
$memo_type = 99;
?>
<script type="text/javascript">
//<![CDATA[
function resizeFrame(frm) {
	frm.style.height = "auto";
	contentHeight = frm.contentWindow.document.documentElement.scrollHeight;
	frm.style.height = contentHeight + 0 + "px";
}
//]]>
</script>
											<iframe id="popup_memo_iframe" src="popup_memo_contractor.php?id=<?=$com_code?>&amp;memo_type=<?=$memo_type?>" frameborder="0" width="100%" height="200" onload="resizeFrame(this)" scrolling="auto" style="margin:10px 0 0 0"></iframe>
										</td>
									</tr>
								</table>
							</div>
