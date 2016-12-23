								<!--전달사항-->
								<div style="height:10px;font-size:0px;line-height:0px;"></div>
								<!--댑메뉴 -->
								<a name="80001"><!--전달사항--></a>
								<table border="0" cellspacing="0" cellpadding="0" style=""> 
									<tr>
										<td id=""> 
											<table border="0" cellpadding="0" cellspacing="0"> 
												<tr> 
													<td><img src="images/so_tab_on_lt.gif"></td> 
													<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
														전달사항
													</td> 
													<td><img src="images/so_tab_on_rt.gif"></td> 
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
for($t=1;$t<=9;$t++) {
	$tab_over[$t] = "";
}
$tab_over[1] = "_over";
?>
								<!-- 입력폼 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1">
									<tr>
										<td style="background:#ffffff;padding:4px;">
											<div style="float:left;margin-right:2px;"><a href="<?=$total_memo_url?>" onclick="tab_memo_over(1);getId('popup_memo_iframe').src=this.href;return false;"><img src="./images/comment_tab<?=$tab_over[1]?>.png" border="0" id="tab_memo1" alt="전체" /></a></div>
											<div style="float:left;margin-right:2px;"><a href="<?=$client_memo_url?>" onclick="tab_memo_over(2);getId('popup_memo_iframe').src=this.href;return false;"><img src="./images/comment_tab2<?=$tab_over[2]?>.png" border="0" id="tab_memo2" alt="거래처" /></a></div>
											<div style="float:left;margin-right:2px;"><a href="<?=$samu_memo_url?>" onclick="tab_memo_over(3);getId('popup_memo_iframe').src=this.href;return false;"><img src="./images/comment_tab3<?=$tab_over[3]?>.png" border="0" id="tab_memo3" alt="사무위탁" /></a></div>
											<div style="float:left;margin-right:2px;"><a href="<?=$job_education_memo_url?>" onclick="tab_memo_over(4);getId('popup_memo_iframe').src=this.href;return false;"><img src="./images/comment_tab4<?=$tab_over[4]?>.png" border="0" id="tab_memo4" alt="사업주훈련" /></a></div>
											<div style="float:left;margin-right:2px;"><a href="<?=$danger_evaluate_memo_url?>" onclick="tab_memo_over(5);getId('popup_memo_iframe').src=this.href;return false;"><img src="./images/comment_tab5<?=$tab_over[5]?>.png" border="0" id="tab_memo5" alt="위험성평가" /></a></div>
											<div style="float:left;margin-right:2px;"><a href="<?=$support_memo_url?>" onclick="tab_memo_over(6);getId('popup_memo_iframe').src=this.href;return false;"><img src="./images/comment_tab6<?=$tab_over[6]?>.png" border="0" id="tab_memo6" alt="지원금" /></a></div>
											<div style="float:left;margin-right:2px;"><a href="<?=$program_memo_url?>" onclick="tab_memo_over(7);getId('popup_memo_iframe').src=this.href;return false;"><img src="./images/comment_tab7<?=$tab_over[7]?>.png" border="0" id="tab_memo7" alt="프로그램" /></a></div>
											<div style="float:left;margin-right:2px;"><a href="<?=$family_insurance_memo_url?>" onclick="tab_memo_over(8);getId('popup_memo_iframe').src=this.href;return false;"><img src="./images/comment_tab8<?=$tab_over[8]?>.png" border="0" id="tab_memo8" alt="가족보험료" /></a></div>
											<div style="float:left;margin-right:2px;"><a href="<?=$policy_fund_memo_url?>" onclick="tab_memo_over(9);getId('popup_memo_iframe').src=this.href;return false;"><img src="./images/comment_tab9<?=$tab_over[9]?>.png" border="0" id="tab_memo9" alt="정책자금" /></a></div>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrow" width="">
<script type="text/javascript">
//<![CDATA[
function resizeFrame(frm) {
	frm.style.height = "auto";
	contentHeight = frm.contentWindow.document.documentElement.scrollHeight;
	frm.style.height = contentHeight + 0 + "px";
}
function tab_memo_over(no) {
	for(i=1;i<=9;i++) {
		if(i == 1) getId('tab_memo'+i).src="./images/comment_tab_over.png";
		else getId('tab_memo'+i).src="./images/comment_tab"+i+".png";
	}
	if(no == 1) getId('tab_memo'+no).src="./images/comment_tab_over.png";
	else getId('tab_memo'+no).src="./images/comment_tab"+no+"_over.png";
}
//]]>
</script>
											<iframe id="popup_memo_iframe" src="popup_memo.php?id=<?=$com_code?>" frameborder="0" width="100%" height="200" onload="resizeFrame(this)" scrolling="auto" style="margin:10px 0 0 0"></iframe>
										</td>
									</tr>
								</table>
							</div>

							<div style="height:10px;font-size:0px"></div>
							<div>
								<!--댑메뉴 -->
								<table border="0" cellspacing="0" cellpadding="0" style=""> 
									<tr>
										<td id=""> 
											<table border="0" cellpadding="0" cellspacing="0"> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
														알람 내역
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
								<!-- 입력폼 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrowk" width="160"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">구분</td>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">내용</td>
										<td nowrap class="tdrowk" width="130"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">등록일시</td>
										<td nowrap class="tdrowk" width="130"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">담당자</td>
										<td nowrap class="tdrowk" width="100"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">연락처</td>
									</tr>
<?
$mb_profile_code = $member['mb_profile'];
$branch_where = " com_code='$com_code' and branch='$damdang_code' ";
$sql_erp_alert_common = " from erp_alert where $branch_where order by idx desc ";
//카운트
$sql_erp_alert_cnt = " select count(*) as cnt $sql_erp_alert_common ";
//echo $sql_erp_alert_cnt;
$row_erp_alert_cnt = sql_fetch($sql_erp_alert_cnt);
$total_count = $row_erp_alert_cnt['cnt'];
if($total_count > 10) $total_count = 10;
$sql_erp_alert = " select * $sql_erp_alert_common ";
$result_erp_alert = sql_query($sql_erp_alert);
// 리스트 출력
for ($i=0; $row_erp_alert=sql_fetch_array($result_erp_alert); $i++) {
	$no = $total_count - $i;
	$id = $row_erp_alert['com_code'];
	//관리점
	$damdang_code = $row_erp_alert['branch'];
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "-";
	$com_name_full = $row_erp_alert['com_name'];
	$com_name = cut_str($com_name_full, 18, "..");
	$memo = $row_erp_alert['memo'];
	//최종확인자
	$sql_erp_view_log = " select * from erp_view_log where com_code = '$row_erp_alert[com_code]' order by idx desc limit 0, 1 ";
	$row_erp_view_log = sql_fetch($sql_erp_view_log);
	$sql_member = " select * from a4_member where mb_id = '$row_erp_view_log[user_id]' ";
	$row_member = sql_fetch($sql_member);
	$mb_name = $row_member['mb_name'];
	$mb_nick = $row_member['mb_nick'];
	if($mb_name) {
		$latest_user = $mb_name." (".$mb_nick.")";
	} else {
		$latest_user = "-";
	}
	//등록일자
	$date1 = substr($row_erp_alert['wr_datetime'],0,10); //날짜표시형식변경
	$date = explode("-", $date1); 
	$year = $date[0];
	$month = $date[1]; 
	$day = $date[2]; 
	$latest_date = $year."-".$month."-".$day."";
	//덧글 최신글 new 표시
	if($row_erp_alert['wr_datetime'] >= date("Y-m-d H:i:s", time() - 12 * 3600)) { 
		$comment_new = "<img src='images/icon_new.gif' border='0' style='vertical-align:middle;'>";
	} else {
		$comment_new = "";
	}
	//담당자
	$sql_manage = " select * from a4_manage where user_id = '$row_erp_alert[user_id]' ";
	$row_manage = sql_fetch($sql_manage);
	$manage_name = $row_manage['name'];
	$manage_tel = $row_manage['tel'];
?>
									<tr>
										<td nowrap class="tdrow_center" width=""><?=$row_erp_alert['alert_name']?></td>
										<td class="tdrow" width=""><?=$memo?> <?=$comment_new?></td>
										<td nowrap class="tdrow" width=""><?=$row_erp_alert['wr_datetime']?></td>
										<td nowrap class="tdrow" width=""><?=$row_erp_alert['user_name']?>(<?=$manage_name?>)</td>
										<td nowrap class="tdrow" width=""><?=$manage_tel?></td>
									</tr>
<?
}
?>
								</table>
