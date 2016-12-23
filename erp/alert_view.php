<?
$sub_menu = "100900";
include_once("./_common.php");

$now_time = date("Y-m-d H:i:s");
$sql_common = " from com_list_gy a, com_list_gy_opt b ";

//검색 파라미터 전송
$qstr  = "search_detail=".$search_detail;
$qstr .= "&stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_biz_no=".$stx_biz_no."&stx_boss_name=".$stx_boss_name."&stx_comp_tel=".$stx_comp_tel."&stx_proxy=".$stx_proxy."&stx_comp_gubun1=".$stx_comp_gubun1."&stx_comp_gubun2=".$stx_comp_gubun2."&stx_comp_gubun3=".$stx_comp_gubun3."&stx_comp_gubun4=".$stx_comp_gubun4."&stx_comp_gubun5=".$stx_comp_gubun5."&stx_comp_gubun6=".$stx_comp_gubun6."&stx_man_cust_name=".$stx_man_cust_name."&stx_uptae=".$stx_uptae."&stx_upjong=".$stx_upjong."&search_ok=".$search_ok;
$qstr .= "&samu_req_yn=".$samu_req_yn."&agent_elect_public_yn=".$agent_elect_public_yn."&agent_elect_center_yn=".$agent_elect_center_yn."&easynomu_process=".$easynomu_process."&review_process=".$review_process."&stx_reg_day_chk=".$stx_reg_day_chk."&search_year=".$search_year."&search_month=".$search_month."&search_year_end=".$search_year_end."&search_month_end=".$search_month_end."&stx_search_day_chk=".$stx_search_day_chk."&search_sday=".$search_sday."&search_eday=".$search_eday."&stx_emp5_gbn=".$stx_emp5_gbn."&stx_emp30_gbn=".$stx_emp30_gbn;
$qstr .= "&search_day_all=".$search_day_all."&search_day1=".$search_day1."&search_day2=".$search_day2."&search_day3=".$search_day3."&search_day4=".$search_day4."&search_day5=".$search_day5."&search_day6=".$search_day6."&search_day7=".$search_day7."&search_day8=".$search_day8."&stx_manage_name=".$stx_manage_name."&stx_biz_no_input_not=".$stx_biz_no_input_not."&stx_t_no_input_not=".$stx_t_no_input_not."&stx_manage_name_input_not=".$stx_manage_name_input_not;

//echo $member[mb_profile];
if($is_admin != "super") {
	$stx_man_cust_name = $member['mb_profile'];
}
$is_admin = "super";
//echo $is_admin;
$sql_search = " where a.com_code=b.com_code and a.com_code='$id' ";
$sql_order = "";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sub_title = "알림(뷰)";
$g4['title'] = $sub_title." : 거래처 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
//echo $sql;
$result = sql_query($sql);
//echo $row[com_code];

$colspan = 11;

if($w == "u") {
	$row=mysql_fetch_array($result);
	if(!$row['com_code']) alert("해당 거래처는 삭제 되었거나 존재하지 않습니다.","main.php");
	//master 로그인시 com_code 오류
	if(!$com_code) $com_code = $id;
	//사업장DB 옵션2
	$sql2 = " select * from com_list_gy_opt2 where com_code='$com_code' ";
	$result2 = sql_query($sql2);
	$row2=mysql_fetch_array($result2);
	//최종확인자 로그 저장 (관리자 제외)
	if($member['mb_level'] != 10) {
		$mb_profile_code = $member['mb_profile'];
		$mb_id = $member['mb_id'];
		$sql_erp_view_log = " insert erp_view_log set branch='$mb_profile_code', user_id='$mb_id', com_code='$com_code', wr_datetime='$now_time' ";
		sql_query($sql_erp_view_log);
	}
}
//메모
$memo = $row['memo'];
$memo1 = $row['memo1'];
$memo2 = $row['memo2'];
$memo3 = $row['memo3'];
$memo4 = $row['memo4'];
$memo5 = $row['memo5'];
//검색 파라미터 전송
$qstr = "stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_biz_no=".$stx_biz_no."&stx_boss_name=".$stx_boss_name."&stx_comp_tel=".$stx_comp_tel."&stx_proxy=".$stx_proxy."&stx_comp_gubun1=".$stx_comp_gubun1."&stx_comp_gubun2=".$stx_comp_gubun2."&stx_comp_gubun3=".$stx_comp_gubun3."&stx_comp_gubun4=".$stx_comp_gubun4."&stx_comp_gubun5=".$stx_comp_gubun5."&stx_comp_gubun6=".$stx_comp_gubun6."&stx_man_cust_name=".$stx_man_cust_name."&stx_man_cust_name2=".$stx_man_cust_name2."&stx_uptae=".$stx_uptae."&stx_upjong=".$stx_upjong."&search_ok=".$search_ok;
$qstr .= "&samu_req_yn=".$samu_req_yn."&agent_elect_public_yn=".$agent_elect_public_yn."&agent_elect_center_yn=".$agent_elect_center_yn."&easynomu_process=".$easynomu_process."&review_process=".$review_process."&stx_reg_day_chk=".$stx_reg_day_chk."&search_year=".$search_year."&search_month=".$search_month."&search_year_end=".$search_year_end."&search_month_end=".$search_month_end."&stx_search_day_chk=".$stx_search_day_chk."&search_sday=".$search_sday."&search_eday=".$search_eday."&stx_emp5_gbn=".$stx_emp5_gbn."&stx_emp30_gbn=".$stx_emp30_gbn;
$qstr .= "&search_day_all=".$search_day_all."&search_day1=".$search_day1."&search_day2=".$search_day2."&search_day3=".$search_day3."&search_day4=".$search_day4."&search_day5=".$search_day5."&search_day6=".$search_day6."&search_day7=".$search_day7."&search_day8=".$search_day8."&stx_manage_name=".$stx_manage_name."&stx_biz_no_input_not=".$stx_biz_no_input_not."&stx_t_no_input_not=".$stx_t_no_input_not."&stx_manage_name_input_not=".$stx_manage_name_input_not;
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
	<title><?=$g4[title]?></title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
	<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<?
include "inc/top.php";
?>
		<td onmouseover="showM('900')" style="vertical-align:top;">
			<div style="margin:10px 20px 20px 20px;min-height:480px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100"><img src="images/top01.gif" border="0"></td>
						<td width="130"><img src="images/top_alert_subtitle.gif" border="0"></td>
						<td></td>
					</tr>
					<tr><td height="1" bgcolor="#cccccc" colspan="9"></td></tr>
				</table>
				<table width="<?=$content_width?>" border="0" align="left" cellpadding="0" cellspacing="0" >
					<tr>
						<td valign="top" style="padding:10px 0 0 0;">
							<!--타이틀 -->	
<?
$samu_list = "";
$report = "ok";
include "inc/client_basic_info.php";
?>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>
							</div><!--프린트 영역 DIV 종료-->
							<!--탭메뉴 -->
<?
//현재 탭 메뉴 번호
$tab_onoff_this = 10;
//프로그램 종류
if($row['easynomu_yn'] == 1) {
	$tab_program_url = 1;
} else if($row['easynomu_yn'] == 2) {
	$tab_program_url = 2;
} else {
	$tab_program_url = 1;
	if($row['construction_yn'] == 1) $tab_program_url = 3;
}
include "inc/tab_menu.php";
?>
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
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">내용</td>
											<td nowrap class="tdrowk" width="130"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">등록일시</td>
											<td nowrap class="tdrowk" width="130"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">담당자</td>
											<td nowrap class="tdrowk" width="100"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">연락처</td>
										</tr>
<?
$mb_profile_code = $member['mb_profile'];
$branch_where = " com_code='$com_code' and branch='$man_cust_name_code' ";

if($member['mb_level'] <= 6) {
	//전기공사 댓글 노출 금지 160706
	$branch_where .= " and send_to not like '%contractor%' ";
	//전기공사 댓글 노출 금지 / 메모 타입 99 제외
	$branch_where .= " and memo_type!=99 ";
	//대구남부(지원대상확인, 신규고용확인) 전달사항 지사 알림 제거 161010
	if($member['mb_profile'] != 16) $branch_where .= " and user_name != '대구남부' ";
}

$sql_erp_alert_common = " from erp_alert where $branch_where order by idx desc ";
//echo $sql_erp_alert_common;
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
	$sql_manage = " select * from a4_manage where user_id = '$row_erp_alert[user_id]' and state = 1 ";
	$row_manage = sql_fetch($sql_manage);
	$manage_name = $row_manage['name'];
	$manage_tel = $row_manage['tel'];
?>
										<tr>
											<td nowrap class="tdrow_center"><?=$row_erp_alert['alert_name']?></td>
											<td class="tdrow"><?=$memo?> <?=$comment_new?></td>
											<td nowrap class="tdrow"><?=$row_erp_alert['wr_datetime']?></td>
											<td nowrap class="tdrow"><?=$row_erp_alert['user_name']?><? if($manage_name) echo "(".$manage_name.")"; ?></td>
											<td nowrap class="tdrow"><?=$manage_tel?></td>
										</tr>
<?
}
if($i == 0) echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='5' class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
?>
									</table>
									<div style="height:20px;font-size:0px"></div>
								</div>
							</form><!--dataForm 폼 종료-->
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
</table>
<? include "./inc/bottom.php";?>
</body>
</html>
