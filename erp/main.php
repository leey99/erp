<?
$mode = "main";
include_once("./_common.php");
include_once("$g4[path]/lib/latest.lib.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>메인 페이지 : <?=$easynomu_name?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<script language="javascript">
</script>
<?
//제휴점, 지사 딜러 160216
if( ($member['mb_profile'] >= 110 && $member['mb_profile'] <= 200) || $member['mb_level'] == 4 ) include "inc/top_dealer.php";
else include "inc/top.php";
?>
					<td onmouseover="showM('900')">
						<div style="margin:10px 20px 20px 20px;min-height:480px;">
							<!-- 내용영역 S -->
<?
$mb_id = $member['mb_id'];
//담당매니저 코드 체크
$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
$row_manage = sql_fetch($sql_manage);
$manage_code = $row_manage['code'];


//본사(전기담당 김근호 표시) 160610
if($member['mb_profile'] == 1 && $member['mb_level'] == 4) {
?>
							<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="margin:10px 10px 20px 0">
								<tr>
									<td valign="top">

										<table width="490" border="0" cellspacing="0" cellpadding="0" align="right">
											<tr>
												<td height="30" style="background:url(./images/main_tit_bg.gif) repeat-x;"><img src="images/main_tit_notice.gif" /></td>
												<td style="background:url(./images/main_tit_bg.gif) repeat-x;"><div align="right"><a href="list_notice.php?bo_table=erp_notice"><img src="images/btn_tit_more.gif" /></a></div></td>
											</tr>
											<tr>
												<td colspan="2" valign="top">
													<table width="100%" border="0" cellpadding="0" cellspacing="0" class="mainlisttable" style="table-layout:fixed;">
														<tr>
															<th width="40" height="34">No</th>
															<th width="">제목</th>
															<th width="100">등록일자</th>
														</tr>
														<?=latest('erp_notice', 'erp_notice', 5, 50)?>
													</table>
												</td>
											</tr>
										</table>
									</td>
									<td width="20"></td>
									<td valign="top">
										<table width="490" border="0" cellspacing="0" cellpadding="0" align="left">
											<tr>
												<td height="30" style="background:url(./images/main_tit_bg.gif) repeat-x;"><img src="images/main_tit_event.gif" /></td>
												<td style="background:url(./images/main_tit_bg.gif) repeat-x;"><div align="right"><a href="list_notice.php?bo_table=erp_event"><img src="images/btn_tit_more.gif" /></a></div></td>
											</tr>
											<tr>
												<td colspan="2" valign="top">
													<table width="100%" border="0" cellpadding="0" cellspacing="0" class="mainlisttable" style="">
														<tr>
															<th width="40" height="34">No</th>
															<th width="">제목</th>
															<th width="100">시행일자</th>
														</tr>
														<?=latest('erp_event', 'erp_event', 5, 56)?>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
<?
}
//딜러 제외 표시(본사, 본사영업) 160204
if(($member['mb_profile'] < 110 || $member['mb_profile'] > 300) && $member['mb_level'] != 4) {
?>
							<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="margin:10px 10px 20px 0">
								<tr>
									<td valign="top">

										<table width="490" border="0" cellspacing="0" cellpadding="0" align="right">
											<tr>
												<td height="30" style="background:url(./images/main_tit_bg.gif) repeat-x;"><img src="images/main_tit_notice.gif" /></td>
												<td style="background:url(./images/main_tit_bg.gif) repeat-x;"><div align="right"><a href="list_notice.php?bo_table=erp_notice"><img src="images/btn_tit_more.gif" /></a></div></td>
											</tr>
											<tr>
												<td colspan="2" valign="top">
													<table width="100%" border="0" cellpadding="0" cellspacing="0" class="mainlisttable" style="table-layout:fixed;">
														<tr>
															<th width="40" height="34">No</th>
															<th width="">제목</th>
															<th width="100">등록일자</th>
														</tr>
														<?=latest('erp_notice', 'erp_notice', 5, 50)?>
													</table>
												</td>
											</tr>
										</table>
									</td>
									<td width="20"></td>
									<td valign="top">
										<table width="490" border="0" cellspacing="0" cellpadding="0" align="left">
											<tr>
												<td height="30" style="background:url(./images/main_tit_bg.gif) repeat-x;"><img src="images/main_tit_event.gif" /></td>
												<td style="background:url(./images/main_tit_bg.gif) repeat-x;"><div align="right"><a href="list_notice.php?bo_table=erp_event"><img src="images/btn_tit_more.gif" /></a></div></td>
											</tr>
											<tr>
												<td colspan="2" valign="top">
													<table width="100%" border="0" cellpadding="0" cellspacing="0" class="mainlisttable" style="">
														<tr>
															<th width="40" height="34">No</th>
															<th width="">제목</th>
															<th width="100">시행일자</th>
														</tr>
														<?=latest('erp_event', 'erp_event', 5, 56)?>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>

							<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="margin:10px 10px 20px 0">
								<tr>
									<td valign="top">

										<table width="490" border="0" cellspacing="0" cellpadding="0" align="right">
											<tr>
												<td height="30" style="background:url(./images/main_tit_bg.gif) repeat-x;"><img src="images/main_tit_reg_new.gif" /></td>
												<td style="background:url(./images/main_tit_bg.gif) repeat-x;"><div align="right"><a href="./client_list.php?search_ok=branch"><img src="images/btn_tit_more.gif" /></a></div></td>
											</tr>
											<tr>
												<td colspan="2" valign="top">
													<table width="100%" border="0" cellpadding="0" cellspacing="0" class="mainlisttable" style="table-layout:;">
														<tr>
															<th width="40" height="34">No</th>
															<th width="100">관리점</th>
															<th width="">거래처명</th>
															<th width="100">등록일자</th>
														</tr>
<?
//본사/지사 영업사원, 딜러(에이전시) 권한
if($member['mb_level'] == 7 || $member['mb_level'] == 5 || $member['mb_level'] == 4) {
	$cnt_where = " and b.manage_cust_numb='$manage_code' ";
}
$sql_common = " from com_list_gy a, com_list_gy_opt b where a.com_code = b.com_code $cnt_where order by a.com_code desc limit 0, 5 ";
//카운트
$sql_cnt = " select count(*) as cnt $sql_common ";
//echo $sql_cnt;
/*
$row_cnt = sql_fetch($sql_cnt);
$total_count = $row_cnt['cnt'];
if($total_count > 5) $total_count = 5;
*/
$total_count = 5;
$sql = " select * $sql_common ";
//echo $sql;
$result = sql_query($sql);
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $total_count - $i;
	$id = $row['com_code'];
	//관리점
	$damdang_code = $row['damdang_code'];
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "-";
	$com_name_full = $row['com_name'];
	$com_name = cut_str($com_name_full, 28, "..");
	//의뢰서 접수일자
	if($row['editdt']) $editdt = $row['editdt'];
	else $editdt = "-";
	//등록일자
	if($row['regdt']) $regdt = $row['regdt'];
	else $regdt = "-";
	//덧글 최신글 new 표시
	if($row['regdt'] >= date("Y.m.d", time() - 12 * 3600)) { 
		$comment_new = "<img src='images/icon_new.gif' border='0' style='vertical-align:middle;'>";
	} else {
		$comment_new = "";
	}
?>
														<tr>
															<td><div align='center'><?=$no?></td>
															<td><div align='center'><?=$branch?></td>
															<td><div align="left"><a href="./client_view.php?w=u&id=<?=$id?>"><b><?=$com_name?></b> <?=$comment_new?></a></div></td>
															<td><div align='center'><?=$regdt?></td>
														</tr>
<?
}
?>
													</table>
												</td>
											</tr>
										</table>
									</td>
									<td width="20"></td>
									<td valign="top">
										<table width="490" border="0" cellspacing="0" cellpadding="0" align="left">
											<tr>
												<td height="30" style="background:url(./images/main_tit_bg.gif) repeat-x;"><img src="images/main_tit_reg_today.gif" /></td>
												<td style="background:url(./images/main_tit_bg.gif) repeat-x;"><div align="right"><a href="./client_process_list.php?search_ok=branch&stx_search_day_chk=1&search_sday=<?=$today?>&search_eday=<?=$today?>&search_day_all=1&search_day1=1&search_day2=1&search_day3=1&search_day4=1&search_day5=1&search_day6=1&search_day7=1&search_day8=1"><img src="images/btn_tit_more.gif" /></a></div></td>
											</tr>
											<tr>
												<td colspan="2" valign="top">
													<table width="100%" border="0" cellpadding="0" cellspacing="0" class="mainlisttable" style="">
														<tr>
															<th width="160" height="34">거래처명</th>
															<th width="">의뢰서</th>
															<th width="">계약서</th>
															<th width="">위탁</th>
															<th width="">공단</th>
															<th width="">센터</th>
														</tr>
<?
$chk_today = " and ( a.editdt = '$today' or b.cntr_sdate = '$today' or samu_req_date = '$today' or agent_elect_public_edate = '$today' or agent_elect_center_edate = '$today' ) ";
$sql = " select * from com_list_gy a, com_list_gy_opt b, com_list_gy_opt2 c where a.com_code = b.com_code and a.com_code = c.com_code $cnt_where $chk_today order by a.com_code desc limit 0, 5 ";
$result = sql_query($sql);
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$id = $row['com_code'];
	$com_name_full = $row['com_name'];
	$com_name = cut_str($com_name_full, 18, "..");
	//의뢰서
	if($row['editdt']) $editdt = $row['editdt'];
	else $editdt = "-";
	//계약서
	if($row['chk_contract']) $chk_contract = "접수";
	else $chk_contract = "-";
	//사무위탁수임
	$samu_req_yn_array = Array("","미도착","수임가능","타수임","수임","해지");
	$samu_req_yn_code = $row['samu_req_yn'];
	if($row['samu_req_yn']) $samu_req_yn = $samu_req_yn_array[$samu_req_yn_code];
	else $samu_req_yn = "-";
	//공단
	$agent_elect_public_yn_array = Array("","없음","처리중","완료","미접수","지사요청","회원가입","해지");
	$agent_elect_public_yn_code = $row['agent_elect_public_yn'];
	if($row['agent_elect_public_yn']) $agent_elect_public_yn = $agent_elect_public_yn_array[$agent_elect_public_yn_code];
	else $agent_elect_public_yn = "-";
	//센터
	$agent_elect_center_yn_array = Array("","없음","처리중","완료","미접수","지사요청","회원가입","해지");
	$agent_elect_center_yn_code = $row['agent_elect_center_yn'];
	if($row['agent_elect_center_yn']) $agent_elect_center_yn = $agent_elect_center_yn_array[$agent_elect_center_yn_code];
	else $agent_elect_center_yn = "-";
?>
														<tr>
															<td><div align="center"><a href="./client_process_view.php?w=u&id=<?=$id?>"><b><?=$com_name?></b></a></div></td>
															<td><div align='center'><?=$editdt?></td>
															<td><div align='center'><?=$chk_contract?></td>
															<td><div align='center'><?=$samu_req_yn?></td>
															<td><div align='center'><?=$agent_elect_public_yn?></td>
															<td><div align='center'><?=$agent_elect_center_yn?></td>
														</tr>
<?
}
if ($i == 0)
	echo "<tr><td colspan='6' style=\"text-align:center\">금일 처리된 거래처가 없습니다.</td></tr>";
?>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
<?
//딜러 제외 표시 끝
}
?>
							<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="margin:10px 10px 20px 0">
								<tr>
									<td valign="top">
										<table width="1000" border="0" cellspacing="0" cellpadding="0" align="center">
											<tr>
												<td height="30" style="background:url(./images/main_tit_bg.gif) repeat-x;"><img src="images/main_tit_alert.gif" /></td>
												<td style="background:url(./images/main_tit_bg.gif) repeat-x;"><div align="right"><a href="alert_list.php"><img src="images/btn_tit_more.gif" /></a></div></td>
											</tr>
											<tr>
												<td colspan="2" valign="top">
													<table width="100%" border="0" cellpadding="0" cellspacing="0" class="mainlisttable" style="">
														<tr>
															<th width="40" height="34">No</th>
															<th width="90">관리점</th>
															<th width="210">거래처 (거래처현황)</th>
															<th width="">내용 (접수처리현황)</th>
															<th width="130">등록자</th>
															<th width="100">등록일자</th>
														</tr>
<?
//if($member['mb_level'] <= 6) {
if($member['mb_profile'] != 1) {
	$mb_profile_code = $member['mb_profile'];
	$branch_where = " ( branch='$mb_profile_code' or branch2='$mb_profile_code' ) ";
	//$branch_where .= " and read_branch = '' ";	
	//지사 딜러 권한
	if($member['mb_level'] == 4 || $member['mb_level'] == 5) {
		$branch_where .= " and (send_to like '%$mb_id%' or user_code='$manage_code' or manage_code='$manage_code') ";
	} else {
		$branch_where .= " and ( send_to = '' or send_to like '%branch%' or user_code='$manage_code' or manage_code='$manage_code' ) ";
	}
	//대구남부(지원대상확인, 신규고용확인) 전달사항 지사 알림 제거 161010
	if($member['mb_profile'] != 16) $branch_where .= " and user_name != '대구남부' ";
} else {
	if($member['mb_id'] == "master") $branch_where = " alert_code = '90001' ";
	else {
		//대표님, 부장님만 그룹웨어(시말서 90013) 알림 표시 161018
		if($member['mb_id'] != "kcmc1001" && $member['mb_id'] != "kcmc1004") $branch_where .= " (alert_code != 90013 and alert_code != '90001') ";
		else $branch_where = " alert_code != '90001' ";
	}
	$branch_where .= " and read_main != '$member[mb_id]' ";
	//본사 영업사원 권한
	if($member['mb_level'] == 7) {
		$branch_where .= " and (send_to like '%$mb_id%' or user_code='$manage_code' or manage_code='$manage_code') ";
	} else if($member['mb_level'] == 2) {
		//전기담당2, 전기요금컨설팅 에이전시 권한 160516
		$branch_where .= " and (alert_code=10006) ";
	}

}
$sql_common = " from erp_alert where $branch_where order by idx desc limit 0, 10 ";
//카운트
$sql_cnt = " select count(*) as cnt $sql_common ";
//echo $sql_cnt;
/*
$row_cnt = sql_fetch($sql_cnt);
$total_count = $row_cnt['cnt'];
if($total_count > 10) $total_count = 10;
*/
$total_count = 10;
$sql = " select * $sql_common ";
//echo $sql;
$result = sql_query($sql);
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $total_count - $i;
	$idx = $row['idx'];
	$id = $row['com_code'];
	//관리점
	$damdang_code = $row['branch'];
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "-";
	$com_name_full = $row['com_name'];
	$com_name = cut_str($com_name_full, 24, "..");
	$memo_full = $row['memo'];
	$memo = cut_str($memo_full, 60, "..");
	//최종확인자
/*
	$sql_erp_view_log = " select * from erp_view_log where com_code = '$row[com_code]' order by idx desc limit 0, 1 ";
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
*/
	//등록자
	$sql_member = " select * from a4_member where mb_id = '$row[user_id]' ";
	$row_member = sql_fetch($sql_member);
	$mb_name = $row_member['mb_name'];
	$mb_nick = $row_member['mb_nick'];
	if($mb_name) {
		//$reg_user = $mb_name." (".$mb_nick.")";
		$reg_user = $mb_name;
		$reg_user_name = $mb_nick;
		//등록자 본사 소속일 경우 성명 표시 160825
		if($row_member['mb_profile'] == 1) $reg_user = $mb_nick;
		//최성민(최상진) 대표 총괄관리로 표시 160825
		if($row_member['mb_id'] == "kcmc1001") $reg_user = $mb_name;
	} else {
		$reg_user = "-";
		$reg_user_name = "";
	}
	//담당자 성명
	if($member['mb_id'] == "kcmc1001") $reg_user_name_text = "<br />(".$reg_user_name.")";
	else $reg_user_name_text = "";
	//등록일자
	$date1 = substr($row['wr_datetime'],0,10); //날짜표시형식변경
	$date = explode("-", $date1); 
	$year = $date[0];
	$month = $date[1]; 
	$day = $date[2]; 
	$latest_date = $year."-".$month."-".$day."";
	//알림 코드
	$alert_code = $row['alert_code'];
	//링크
	if($member['mb_level'] > 6 || $row['branch'] == $member['mb_profile'] || $row['branch2'] == $member['mb_profile']) {
		//딜러 권한
		if(($member['mb_profile'] >= 110 && $member['mb_profile'] <= 200) || $member['mb_level'] == 4) {
			$client_view = "alert_read_link.php?link_url=view_dealer&idx=$idx&id=$id&w=u&$qstr";
			$client_process_view = "alert_read_link.php?link_url=view_dealer&idx=$idx&id=$id&w=u&$qstr";
		} else {
			$client_view = "alert_read_link.php?link_url=view&idx=$idx&id=$id&w=u&$qstr";
			$client_process_view = "alert_read_link.php?link_url=process&idx=$idx&id=$id&w=u&$qstr&alert_code=$alert_code";
		}
	} else {
		$client_view = "javascript:alert('해당 거래처 정보를 열람할 권한이 없습니다.');";
		$client_process_view = "javascript:alert('해당 거래처 정보를 열람할 권한이 없습니다.');";
	}
	//덧글 최신글 new 표시
	if($row['wr_datetime'] >= date("Y-m-d H:i:s", time() - 12 * 3600)) { 
		$comment_new = "<img src='images/icon_new.gif' border='0' style='vertical-align:middle;'>";
	} else {
		$comment_new = "";
	}
	//읽음처리
	if($member['mb_profile'] == 1) {
		if($row['read_main']) {
			$text_bold = "";
		} else {
			$text_bold = "font-weight:bold";
		}
	} else {
		if($row['read_branch']) {
			$text_bold = "";
		} else {
			$text_bold = "font-weight:bold";
		}
	}
	//업무일지 전달사항 제외 161021 / 그룹웨어 전체 제외 161115
	//if($row['alert_code'] != 90010) {
	if($row['com_code']) {
?>
														<tr>
															<td><div align='center'><?=$no?></td>
															<td><div align='center'><?=$branch?></td>
															<td><div align="left"><a href="<?=$client_view?>" style="<?=$text_bold?>"><?=$com_name?></a></div></td>
															<td><div align='left'><a href="<?=$client_process_view?>" style="<?=$text_bold?>"><?=$memo?> <?=$comment_new?></a></td>
															<td><div align='center'><?=$reg_user?></td>
															<td><div align='center'><?=$latest_date?></td>
														</tr>
<?
	}
}
?>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
</table>
<!--팝업-->
<?
//딜러 제외 표시 160112
if($member['mb_profile'] < 110 && $member['mb_level'] != 4) include "./inc/popup.php";
?>
<a href="javascript:delete_cookie_all();"><img src="images/btn_popup_reset.gif" border="0" style="border:1px solid #000000;" /></a>
<? include "./inc/bottom.php";?>
</body>
</html>
