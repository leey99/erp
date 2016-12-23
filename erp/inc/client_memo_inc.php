
								<!--전달사항-->
								<div style="height:1px;font-size:0px;line-height:0px;"></div>
								<!--댑메뉴 -->
								<a name="80001"><!--전달사항--></a>
								<table border="0" cellspacing="0" cellpadding="0" style=""> 
									<tr>
										<td id=""> 
											<table border="0" cellpadding="0" cellspacing="0"> 
												<tr> 
													<td><img src="images/so_tab_on_lt.gif"></td> 
													<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80px;text-align:center'> 
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
								<!-- 입력폼 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrow" width="">
											<script type="text/javascript">
											function resizeFrame(frm) {
											 frm.style.height = "auto";
											 contentHeight = frm.contentWindow.document.documentElement.scrollHeight;
											 frm.style.height = contentHeight + 0 + "px";
											}
											</script>
											<iframe src="client_memo_iframe.php?id=<?=$com_code?>" frameborder="0" width="100%" height="200" onload="resizeFrame(this)" scrolling="auto" style="margin:10px 0 0 0"></iframe>
										</td>
									</tr>
								</table>
								<input type="hidden" name="prv_dojang_img" value="<?$row1['dojang_img']?>">
								<input type="hidden" name="prv_cust_tell"  value="<?=$row['com_tel']?>">
								<input type="hidden" name="prv_user_id" value="<?=$row['t_insureno']?>">
								<input type="hidden" name="url" value="./com_view.php">
								<input type="hidden" name="w" value="<?=$w?>">
								<input type="hidden" name="id" value="<?=$id?>">
								<input type="hidden" name="page" value="<?=$page?>">
								<input type="hidden" name="tab" value="<?=$tab?>">
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
	$sql_manage = " select * from a4_manage where user_id = '$row_erp_alert[user_id]' and state='1' ";
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
