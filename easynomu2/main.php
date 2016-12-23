<?
$mode = "main";
include_once("./_common.php");
include_once("$g4[path]/lib/latest.lib.php");
//include_once "../extend/schedule.lib.php";
//echo $member['mb_id'];
if(!$member['mb_id']) {
?>
<script language=javascript>
location.href = "login.php?url=%2Feasynomu%2Fmain.php";
</script>
<?
	exit;
}
//echo $member['mb_level'];
if($member['mb_level'] == 5) {
	header("Location:./com_view.php");
} else if($member['mb_level'] >= 6) {
	//header("Location:./com_list_admin.php");
?>
<script language=javascript>
location.href = "/easynomu/main.php";
</script>
<?
}
//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
}
//지사 관리 ID
if($member['mb_level'] == 6) {
	$is_admin = "super";
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>메인 페이지 : <?=$easynomu_name?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
<script language="javascript">
// 삭제 검사 확인
function del(page,id) 
{
	if(confirm("삭제하시겠습니까?")) {
		location.href = "4insure_delete.php?page="+page+"&id="+id;
	}
}
</script>
<?
if($is_admin != "super") $top_inc = "./inc/top.php";
else $top_inc = "./inc/top_admin.php";
include $top_inc;
?>

<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="1200" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" style="padding:10px 10px 10px 10px">
							<!-- 타이틀 -->
							<table width="100%" border=0 cellspacing=0 cellpadding=0>
								<tr>     
									<td height="18">
										<table width=100% border=0 cellspacing=0 cellpadding=0>
											<tr>
												<td style='font-size:8pt;color:#929292;'>
													<img src="images/g_title_icon.gif" align=absmiddle  style='margin:0 5 2 0'><span style='font-size:9pt;color:black;'><?=$member['mb_name']?> 담당자님 안녕하세요.</span>
												</td>
												<td align=right class=navi></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr><td height=1 bgcolor=e0e0de></td></tr>
								<tr><td height=2 bgcolor=f5f5f5></td></tr>
								<tr><td height=5></td></tr>
							</table>

							<!-- 내용영역 S -->
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?
if($is_admin != "super") {
?>
								<tr>
									<td valign="top">
										<table width="530" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td height="30" style="background:url(./images/main_tit_bg.gif) repeat-x;"><img src="images/main_tit_notice.gif" /></td>
												<td style="background:url(./images/main_tit_bg.gif) repeat-x;"><div align="right"><a href="list_notice.php?bo_table=oc_notice"><img src="images/btn_tit_more.gif" /></a></div></td>
											</tr>
											<tr>
												<td colspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="mainlisttable" style="table-layout:fixed;">
													<tr>
														<th width="15%" height="34">No</th>
														<th width="59%">제목</th>
														<th width="26%">등록일자</th>
													</tr>
													<?=latest('oc_notice', 'oc_notice', 6, 100)?>
												</table></td>
											</tr>
											<tr>
												<td colspan="2" valign="top">
													
												</td>
											</tr>
										</table></td>
										<td width="20"></td>
										<td valign="top"><table width="530" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td height="30" style="background:url(./images/main_tit_bg.gif) repeat-x;"><img src="images/main_tit_event.gif" /></td>
												<td style="background:url(./images/main_tit_bg.gif) repeat-x;"><div align="right"><a href="list_notice.php?bo_table=oc_event"><img src="images/btn_tit_more.gif" /></a></div></td>
											</tr>
											<tr>
												<td colspan="2">
													<?//=$member['mb_id']?>
													<?=latest_schedule("calendar", "oc_event", $member['mb_id'])?>
												</td>
											</tr>
										</table>
									</td>
								</tr>
<?
}
//지사관리ID
if($member['mb_level'] != 6) {
?>
								<tr>
									<td colspan="3" valign="top">
										<div style="height:20px"><!--여백--></div>
										<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:url(./images/main_tit_bg.gif) repeat-x;">
											<tr>
												<td height="30"><img src="images/main_tit_4insure.gif" /></td>
												<td>
													<div align="right">
<?
if($is_admin != "super") {
?>
														<table border=0 cellpadding=0 cellspacing=0 style="display:inline;margin-top:9px">
															<tr>
																<td width=2></td>
																<td><img src=images/btn_lt.gif></td>
																<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="4insure_write.php" target="">신고서 작성</a></td>
																<td><img src=images/btn_rt.gif></td>
															 <td width=2></td>
															</tr>
														</table>
														<a href="4insure_list.php"><img src="images/btn_tit_more.gif" style="margin-bottom:4px" /></a>
<?
} else {
?>
														<a href="4insure_list_admin.php"><img src="images/btn_tit_more.gif" style="margin-top:6px" /></a>
<?
}
?>
													</div>
												</td>
											</tr>
										</table>

										<!--리스트 -->
										<table width="100%" border="0" cellpadding="0" cellspacing="0" class="mainlisttable">
											<col width="4%">
<?
if($is_admin == "super") {
?>
											<col width="220">
											<col width="100">
											<col width="100">
<? } ?>
											<col width="100">
											<col width="">
											<col width="">
											<col width="76">
											<col width="80">
											<col width="100">
											<tr>
												<th nowrap style="text-align:center" height="34">No</th>
<?
if($is_admin == "super") {
?>
												<th nowrap style="text-align:left">사업장명칭</th>
												<th nowrap style="text-align:left">사업자등록번호</th>
												<th nowrap style="text-align:left">전화번호</th>
<? } ?>
												<th nowrap style="text-align:left">신청일자</th>
												<th nowrap style="text-align:left">입사자 명단</th>
												<th nowrap style="text-align:left">퇴사자 명단</th>
												<th nowrap style="text-align:center">담당자</th>
												<th nowrap style="text-align:center">처리현황</th>
												<th nowrap style="text-align:center">처리일자</th>
											</tr>
<?
$sql_common = " from $g4[insure_table] ";
if($is_admin == "super") {
	$sql_search = " where 1=1 ";
} else {
	$sql_search = " where comp_bznb='$member[mb_id]' ";
}
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        default :
            $sql_search .= " ($sfl like '$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}
$sst = "";
if (!$sst) {
    $sst = "wr_datetime";
    $sod = "desc";
}
$sql_order = " order by $sst $sod ";
$total_count = 10;
$rows = 10;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함
$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>처음</a>";
$g4[title] = "4대보험";
$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);
$colspan = 9;
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//$page
	//$total_page
	//$rows
	$no = $total_count - $i - ($rows*($page-1));
	$id = $row[id];
  $list = $i%2;
	$openchk = "";
	if($row[isgy] == "1")
		$openchk = "checked";
	$popchk = "";
	if($row[issj] == "1")
		$popchk = "checked";
	// 입사자(명)
	$sql_join = " select count(*) as cnt
					 $sql_common
					 $sql_search
							and join_name <> '' 
							and id = '$row[id]' ";
	//echo $sql_join;
	$row_join = sql_fetch($sql_join);
	$join__count = $row_join[cnt];
	for($k=2; $k<=5; $k++) {
		$sql_join_add = " select count(*) as cnt
						 $sql_common
						 $sql_search
								and join_name_".$k." <> '' 
								and id = '$row[id]' ";
		//echo $sql_join_add;
		$row_join_add = sql_fetch($sql_join_add);
		$join__count += $row_join_add[cnt];
	}
	// 퇴사자(명)
	$sql_quit = " select count(*) as cnt
					 $sql_common
					 $sql_search
							and quit_name <> ''
							and id = '$row[id]' ";
	$row_quit = sql_fetch($sql_quit);
	$quit__count = $row_quit[cnt];
	for($k=2; $k<=5; $k++) {
		$sql_quit_add = " select count(*) as cnt
						 $sql_common
						 $sql_search
								and quit_name_".$k." <> '' 
								and id = '$row[id]' ";
		//echo $sql_quit_add;
		$row_quit_add = sql_fetch($sql_quit_add);
		$quit__count += $row_quit_add[cnt];
	}
	$comp_adr = cut_str($row[comp_adr], 60, "..");
	//신청일자
	$wr_datetime = explode(" ",$row[wr_datetime]);
	//입사자 명단
	$sql_join = " select *
					 $sql_common
					 $sql_search
							and join_name <> '' 
							and id = '$row[id]' ";
	//echo $sql_join;
	$row_join = sql_fetch($sql_join);
	//추가 입사자 초기화
	$join_name_add = "";
	for($k=2; $k<=5; $k++) {
		$sql_join_add = " select *
						 $sql_common
						 $sql_search
								and join_name_".$k." <> '' 
								and id = '$row[id]' ";
		//echo $sql_join_add;
		$row_join_add = sql_fetch($sql_join_add);
		$row_join_name_add = $row_join_add['join_name_'.$k];
		if($row_join_name_add != "") {
			$join_name_add .= ",".$row_join_name_add;
		}
	}
	//퇴사자 명단
	$sql_quit = " select *
					 $sql_common
					 $sql_search
							and quit_name <> '' 
							and id = '$row[id]' ";
	//echo $sql_quit;
	$row_quit = sql_fetch($sql_quit);
	//추가 입사자 초기화
	$quit_name_add = "";
	for($k=2; $k<=5; $k++) {
		$sql_quit_add = " select *
						 $sql_common
						 $sql_search
								and quit_name_".$k." <> '' 
								and id = '$row[id]' ";
		//echo $sql_quit_add;
		$row_quit_add = sql_fetch($sql_quit_add);
		$row_quit_name_add = $row_quit_add['quit_name_'.$k];
		if($row_quit_name_add != "") {
			$quit_name_add .= ",".$row_quit_name_add;
		}
	}
	//입사자, 퇴사자 명단 없을 시 - 표시
	if($row_join[join_name]) $join_name = $row_join[join_name];
	else $join_name = "-";
	if($row_quit[quit_name]) $quit_name = $row_quit[quit_name];
	else $quit_name = "-";
	// 담당자
	$damdang_code_0022 = "정진희";
	//$damdang_code_0023 = "이민화";
	$damdang_code_0023 = "임현미";
	if($row[damdang_code] == "0022") $damdang_name = $damdang_code_0022;
	else if($row[damdang_code] == "0023") $damdang_name = $damdang_code_0023;
	else $damdang_name = "&nbsp;";
	//처리현황
	if($row[conduct] == "0" || $row[conduct] == "") $ok = "접수중";
	else if($row[conduct] == "1") $ok = "처리중";
	else if($row[conduct] == "2") $ok = "처리완료";
	else if($row[conduct] == "3") $ok = "예약중";
	else if($row[conduct] == "4") $ok = "반려";
	//처리일자
	$ok_datetime = explode(" ",$row[ok_datetime]);
	if($row[conduct] != "2") $ok_datetime[0] = "-";
	//4대보험관리 뷰페이지 url
	if($is_admin != "super") $insure_view_url = "4insure_view.php?id=".$id."".$qstr;
	else $insure_view_url = "4insure_view_admin.php?id=".$id."".$qstr;
?>
											<tr>
												<td nowrap style="text-align:center"><?=$no?></td>
<?
if($is_admin == "super") {
?>
												<td nowrap style="text-align:left">
													<a href="<?=$insure_view_url?>"><b><?=$row[comp_name]?></b></a>
												</td>
												<td nowrap style="text-align:left"><?=$row[comp_bznb]?></td>
												<td nowrap style="text-align:left"><?=$row[comp_tel]?></td>
<? } ?>
												<td nowrap style="text-align:left"><a href="<?=$insure_view_url?>"><b><?=$wr_datetime[0]?></b></a></td>
												<td nowrap style="text-align:left"><?=$join__count?>명(<?=$join_name?><?=$join_name_add?>)</td>
												<td nowrap style="text-align:left"><?=$quit__count?>명(<?=$quit_name?><?=$quit_name_add?>)</td>
												<td nowrap style="text-align:center"><?=$damdang_name?></td>
												<td nowrap style="text-align:center"><?=$ok?></td>
												<td nowrap style="text-align:center"><?=$ok_datetime[0]?></td>
											</tr>
<?
}
if ($i == 0)
    echo "<tr><td colspan='$colspan' nowrap style=\"text-align:center\">자료가 없습니다.</td></tr>";
//지사관리ID end
} else {
	//사업장 리스트 표시
	//사업장관리 페이지로 이동
}
?>
										</table>
<?
//관리자 로그인시 보임
if($is_admin == "super") {
?>
										<div style="height:30px"><!--사업장 리스트--></div>
										<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:url(./images/main_tit_bg.gif) repeat-x;">
											<tr>
												<td height="30"><img src="images/main_tit_com.gif" /></td>
												<td>
													<div align="right">
														<a href="com_list_admin.php"><img src="images/btn_tit_more.gif" style="margin-top:6px" /></a>
													</div>
												</td>
											</tr>
											<tr>
												<td colspan="2">
													<table width="100%" border="0" cellpadding="0" cellspacing="0" class="mainlisttable">
														<tr>
															<th style="text-align:center" width="26" height="34">No</th>
															<th style="text-align:center" width="40">코드</th>
															<th style="text-align:center" width="">사업장명</th>
															<th style="text-align:center" width="70">대표자명</th>
															<th style="text-align:center" width="40">구분</th>
															<th style="text-align:center" width="98">사업자등록번호</th>
															<th style="text-align:center" width="94">사업장전화</th>
															<th style="text-align:center" width="140">서비스기간</th>
															<th style="text-align:center" width="56">세팅비</th>
															<th style="text-align:center" width="56">월정액</th>
															<th style="text-align:center" width="48">결제일</th>
															<th style="text-align:center" width="42">지사</th>
															<th style="text-align:center" width="52">매니저</th>
															<th style="text-align:center" width="40">위탁</th>
															<th style="text-align:center" width="36">재직</th>
															<th style="text-align:center" width="36">퇴직</th>
														</tr>
<?
	$sql_common = " from com_list_gy a, com_list_gy_opt b ";
	$sql_search = " where a.com_code = b.com_code ";
	$sst = "a.com_code";
  $sod = "desc";
	$sql_order = " order by $sst $sod ";
	$total_count = 10;
	$from_record = 0;
	$rows = 10;
	$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
	$result = sql_query($sql);
	$colspan = 16;
	// 리스트 출력
	for ($i=0; $row=sql_fetch_array($result); $i++) {
		//사업장 옵션 DB
		$sql_opt = " select * from com_list_gy_opt where com_code='$row[com_code]' ";
		$result_opt = sql_query($sql_opt);
		$row_opt=mysql_fetch_array($result_opt);
		//$page
		//$total_page
		//$rows

		$no = $total_count - $i - ($rows*($page-1));
		$list = $i%2;

		$id = $row[com_code];
		$com_name = cut_str($row[com_name], 28, "..");
		if($row[upche_div] == "2") {
			$upche_div = "법인";
		} else {
			$upche_div = "개인";
		}
		$com_juso = $row[com_juso]." ".$row[com_juso2];
		$com_juso = cut_str($com_juso, 29, "..");
		//서비스기간
		if($row_opt[service_day_start]) {
			$service_day = $row_opt[service_day_start]."~".$row_opt[service_day_end];
			//echo $id." ".$service_day;
		} else {
			$service_day = "";
		}
		//세팅비
		if($row_opt[setting_pay]) {
			$setting_pay = number_format($row_opt[setting_pay]);
			$setting_sum += $row_opt[setting_pay];
		} else {
			$setting_pay = "";
		}
		//월정액금
		if($row_opt[month_pay]) {
			$month_pay = number_format($row_opt[month_pay]);
			$month_sum += $row_opt[month_pay];
		} else {
			$month_pay = "";
		}	
		//재직자
		$sql1 = " select count(*) as cnt from pibohum_base where com_code='$row[com_code]' and out_day='' ";
		$result1 = sql_query($sql1);
		$row1=mysql_fetch_array($result1);
		$join_cnt = $row1[cnt];
		//퇴직자
		$sql1 = " select count(*) as cnt from pibohum_base where com_code='$row[com_code]' and out_day!='' ";
		$result1 = sql_query($sql1);
		$row1=mysql_fetch_array($result1);
		$quit_cnt = $row1[cnt];
		//담당지사
		$man_cusr_numb = $row_opt[man_cust_name];
		$man_cust_name = $man_cust_name_arry[$man_cusr_numb];
		//담당매니저
		$manage_cust_name = $row_opt[manage_cust_name];
		//월정액결제일
		if($row_opt[settlement_day] == "" || $row_opt[settlement_day] == 0) $settlement_day = "";
		else $settlement_day = $row_opt[settlement_day]."일";
		//결제일 말일
		if($row_opt[settlement_day_last]) $settlement_day = "말일";
		//사무위탁
		if($row_opt[samu_req_yn] == "0" || $row_opt[samu_req_yn] == "") {
			$samu_req = "";
		} else if($row_opt[samu_req_yn] == "1") {
			$samu_req = "신청";
		}
?>
														<tr>
															<td style="text-align:center"><?=$no?></td>
															<td style="text-align:center"><?=$id?></td>
															<td style="text-align:left">
																<a href="com_view_admin.php?id=<?=$id?>&w=u"><b><?=$com_name?></b></a>
															</td>
															<td style="text-align:center"><?=$row[boss_name]?>&nbsp;</td>
															<td style="text-align:center"><?=$upche_div?>&nbsp;</td>
															<td style="text-align:center"><?=$row[biz_no]?>&nbsp;</td>
															<td style="text-align:center"><?=$row[com_tel]?>&nbsp;</td>
															<td style="text-align:center"><?=$service_day?>&nbsp;</td>
															<td style="text-align:center"><?=$setting_pay?>&nbsp;</td>
															<td style="text-align:center"><?=$month_pay?>&nbsp;</td>
															<td style="text-align:center"><?=$settlement_day?>&nbsp;</td>
															<td style="text-align:center"><?=$man_cust_name?>&nbsp;</td>
															<td style="text-align:center"><?=$manage_cust_name?>&nbsp;</td>
															<td style="text-align:center"><?=$samu_req?>&nbsp;</td>
															<td style="text-align:center"><?=$join_cnt?>&nbsp;</td>
															<td style="text-align:center"><?=$quit_cnt?>&nbsp;</td>
														</tr>
<?
	}
	if ($i == 0)
			echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' style=\"text-align:center\" nowrap class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
?>
													</table>
												</td>
											</tr>
										</table>
<?
}
?>
<?
//권한별 링크값
if($member['mb_profile'] == "guest") {
	$url_view = "javascript:alert_demo();";
} else {
	$url_view = "staff_view.php?w=w";
}
//관리자 로그인시 숨김
if($is_admin != "super") {
?>
										<div style="height:30px"><!--여백--></div>
										<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:url(./images/main_tit_bg.gif) repeat-x;">
											<tr>
												<td height="30"><img src="images/main_tit_staff.gif" /></td>
												<td>
													<div align="right">
														<table border=0 cellpadding=0 cellspacing=0 style="display:inline;margin-top:9px">
															<tr>
																<td width=2></td>
																<td><img src=images/btn_lt.gif></td>
																<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_view?>" target="">사원 등록</a></td>
																<td><img src=images/btn_rt.gif></td>
															 <td width=2></td>
															</tr>
														</table>
														<a href="staff_list.php"><img src="images/btn_tit_more.gif" style="margin-bottom:4px" /></a>
													</div>
												</td>
											</tr>
											<tr>
												<td colspan="2">
													<table width="100%" border="0" cellpadding="0" cellspacing="0" class="mainlisttable">
														<tr>
															<th style="text-align:center" width="34" height="34">No</th>
															<th style="text-align:center" width="50">사번</th>
															<th style="text-align:center" width="90">사진</th>
															<th style="text-align:center" width="120">성명</th>
															<th style="text-align:center" width="74">급여정보</th>
															<th style="text-align:center" width="70">직위</th>
															<th style="text-align:center" width="110">주민번호</th>
															<th style="text-align:center" width="80">채용형태</th>
															<th style="text-align:center" width="90">입/퇴사일</th>
															<th style="text-align:center" width="110">부서</th>
															<th style="text-align:center" width="120">취득여부</th>
															<th style="text-align:center" width="80">근로계약서</th>
															<th style="text-align:center" width="">취득</th>
															<th style="text-align:center" width="">상실</th>
														</tr>
<?
	$sql_common = " from $g4[pibohum_base] ";

	$sql_a4 = " select com_code from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
	$row_a4 = sql_fetch($sql_a4);
	$com_code = $row_a4[com_code];

	//echo $is_admin;
	if($is_admin == "super") {
		$sql_search = " where 1=1 ";
	} else {
		$sql_search = " where com_code='$com_code' ";
	}

	if($is_admin == "super") {
		$sst = "com_code";
	} else {
		$sst = "sabun";
	}
	$sod = "desc";

	$sql_order = " order by $sst $sod ";
	$total_count = 5;

	$rows = 5;
	$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

	if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
	$from_record = ($page - 1) * $rows; // 시작 열을 구함

	$sql = " select *
						$sql_common
						$sql_search
						$sql_order
						limit $from_record, $rows ";
	$result = sql_query($sql);

	$colspan = 14;

	// 리스트 출력
	for ($i=0; $row=sql_fetch_array($result); $i++) {
		//$page
		//$total_page
		//$rows

		$no = $total_count - $i - ($rows*($page-1));
		$list = $i%2;
		//사업장 코드 / 사번 / 코드_사번
		$code = $row[com_code];
		$id = $row[sabun];
		$code_id = $code."_".$id;
		// 사업장명 : 사업장코드
		$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$row[com_code]' ";
		$row_com = sql_fetch($sql_com);
		$com_name = $row_com[com_name];
		$com_name = cut_str($com_name, 21, "..");
		$name = cut_str($row[name], 6, "..");
		//채용형태
		if($row[work_form] == "") $work_form = "";
		else if($row[work_form] == "1") $work_form = "정규직";
		else if($row[work_form] == "2") $work_form = "계약직";
		else if($row[work_form] == "3") $work_form = "일용직";
		//입사일/퇴사일
		if($row[in_day] == "..")  $in_day = "";
		else $in_day = $row[in_day];
		if($row[out_day] == "..") $out_day = "";
		else $out_day = $row[out_day];
		//사원 추가 DB
		$sql2 = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
		$result2 = sql_query($sql2);
		$row2=mysql_fetch_array($result2);
		//부서
		$dept = $row2[dept_1];
		//직위
		$position = " ";
		if($row2[position]) {
			$sql_position = " select * from com_code_list where item='position' and com_code = '$code' and code = $row2[position] ";
			//echo $sql_position;
			$result_position = sql_query($sql_position);
			$row_position = sql_fetch_array($result_position);
			$position = $row_position[name];
		}
		//주민등록번호 뒷 다섯자리 별표 처리
		$jumin_no = substr($row[jumin_no],0,9)."*****";
		//급여구분
		if($row2[pay_gbn] == "0") $pay_gbn = "월급제";
		else if($row2[pay_gbn] == "1") $pay_gbn = "시급제";
		else if($row2[pay_gbn] == "2") $pay_gbn = "복합근무";
		else if($row2[pay_gbn] == "3") $pay_gbn = "연봉제";
		else $pay_gbn = "-";
		//권한별 링크값
		if($member['mb_profile'] == "guest") {
			$url_work = "javascript:alert_demo();";
		} else {
			$url_work = "work_contract.php?id=$id&code=$code&page=$page";
		}
		//강제 근로계약서
		$row2[work_contract] = 1;
		if($row2[work_contract] == 1) $work_contract = "<a href='$url_work' target=''><img src='./images/btn_work_contract.png' border='0'></a>";
		else $work_contract = "미작성";
		//증명사진
		if($row2[pic]) {
			$pic = "./files/images/$row[com_code]_$row[sabun].jpg";
		} else {
			$pic = "./images/blank_pic.gif";
		}
		//연락처
		if(!$row[add_tel]) {
			$tel_cel = $row2[emp_cel];
		} else {
			$tel_cel = $row[add_tel];
		}
		$pay_url = "staff_pay_view.php?w=u&id=$id&code=$code&page=$page";
		$pay_info = "<a href='$pay_url' target=''><img src='./images/btn_pay_info.png' border='0'></a>";
?>
														<tr>
															<td style="text-align:center;height:55px"><?=$no?></td>
															<td style="text-align:center"><?=$id?></td>
															<td style="text-align:center"><img src="<?=$pic?>" width="50" height="50" alt="증명사진" style="border:solid 1px #dfdfdf;" /></td>
															<td style="text-align:center">
																<a href="staff_view.php?w=u&id=<?=$id?>&code=<?=$code?>&page=<?=$page?>"><b><?=$name?></b></a>
															</td>
															<td style="text-align:center"><?=$pay_info?></td>
															<td style="text-align:center"><?=$position?>&nbsp;</td>
															<td style="text-align:center"><?=$jumin_no?></td>
															<td style="text-align:center"><?=$work_form?><br><?=$pay_gbn?>&nbsp;</td>
															<td style="text-align:center"><?=$in_day?><br><?=$out_day?></td>
															<td style="text-align:center"><?=$dept?>&nbsp;</td>
															<td style="text-align:center">
																<input type="checkbox" name="isgy" value="0" class="checkbox" disabled <? if($row[apply_gy] == "0") echo "checked"; ?> >고용
																<input type="checkbox" name="issj" value="0" class="checkbox" disabled <? if($row[apply_sj] == "0") echo "checked"; ?> >산재<br>
																<input type="checkbox" name="iskm" value="0" class="checkbox" disabled <? if($row[apply_km] == "0") echo "checked"; ?> >연금
																<input type="checkbox" name="isgg" value="0" class="checkbox" disabled <? if($row[apply_gg] == "0") echo "checked"; ?> >건강
															</td>
															<td style="text-align:center"><?=$work_contract?></td>
															<td style="text-align:center">
																<a href="4insure_write.php?mode=in&id=<?=$id?>&code=<?=$code?>&page=<?=$page?>" target=""><img src="./images/btn_get.png"></a>
															</td>
															<td style="text-align:center">
																<a href="4insure_write.php?mode=out&id=<?=$id?>&code=<?=$code?>&page=<?=$page?>" target=""><img src="./images/btn_loss.png"></a>
															</td>
														</tr>
<?
	}
	if ($i == 0)
			echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' style=\"text-align:center\" nowrap class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
?>
													</table>
												</td>
											</tr>
										</table>
<?
}
?>
									</td>
								</tr>
							</table>

						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<? include "./inc/bottom.php";?>
</div>

<?
$rs[po_id] = 1;
if (trim($_COOKIE["easy_ck_pop_".$rs[po_id]]) != "done") {
	//팝업1 좌표
	$pop_left = 50;
	$pop_top = 129;
?>
<style type="text/css">
#pop1 {
	position:absolute;
	z-index:100;
	width:460px;
	left:<?=$pop_left?>px;
	top:<?=$pop_top?>px;
	cursor:;
	background:#545454;;
}
.clsDrag {
	position:relative;
}
</style>
<div id="pop1" class="clsDrag" style="display:none">
	<table width="440" border="0" cellspacing="0" cellpadding="0" style="margin:10px 10px 4px 10px;">
		<tr>
			<td style="">
				<img src="popup_images/easynomu_update_140305.jpg" align="top" alt="" border="0" align="absmiddle" usemap="#easynomu_update_140305.jpg" style="border: 0;">
			</td>
		</tr>
	</table>
	<div id="popup_close_bt" style="margin:4px 10px 10px 10px">
		<div style="float:left" onclick="" style="cursor:pointer"><input type="checkbox" id="expirehours1" name="expirehours1" value="24" style="display:none" checked></div>
		<div style="padding:4px 10px 10px 10px;">
			<div style="display:inline;float:left"><a href="#" class="white" onclick="layer_close(1)">24시간 동안 이 창을 다시 열지 않음</a></div>
			<div style="display:inline;float:right"><a href="#" class="white" onclick="document.getElementById('pop1').style.display='none';return false;">닫기</a></div>
		</div>
	</div>
</div>
<map name="easynomu_update_140305.jpg">
	<area shape="rect" coords="2,468,436,499" href="./list_notice.php?bo_table=oc_notice&wr_id=11" target="" alt="" />
</map>
<script type="text/JavaScript">
var x, y;
var objDoc;
var objIE = document.all;
var objOtherBrowsers = document.getElementById && !document.all;
var blIsDrag = false;
function fnMoveMouse(e) {
	if (blIsDrag)
	{
		objDoc.style.left = objOtherBrowsers ? intLeftX + e.clientX - x : intLeftX + event.clientX - x;
		objDoc.style.top  = objOtherBrowsers ? intTopY  + e.clientY - y : intTopY  + event.clientY - y;

		return false;
	}
}
function fnSelectMouse(e) {
	var objF = document.getElementById('pop1');
	blIsDrag = true;
	objDoc = objF;
	intLeftX = parseInt(objDoc.style.left + <?=$pop_left?>, 10);
	intTopY = parseInt(objDoc.style.top + <?=$pop_top?>, 10);
	x = objOtherBrowsers ? e.clientX : event.clientX;
	y = objOtherBrowsers ? e.clientY : event.clientY;
	document.onmousemove = fnMoveMouse;
	return false;
}

// 쿠키 입력
function set_cookie(name, value, expirehours, domain) 
{
		var today = new Date();
		today.setTime(today.getTime() + (60*60*1000*expirehours));
		document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + today.toGMTString() + ";";
		if (domain) {
				document.cookie += "domain=" + domain + ";";
		}
}
// 쿠키 얻음
function get_cookie(name) 
{
		var find_sw = false;
		var start, end;
		var i = 0;
		for (i=0; i<= document.cookie.length; i++)
		{
				start = i;
				end = start + name.length;
				if(document.cookie.substring(start, end) == name) 
				{
						find_sw = true
						break
				}
		}
		if (find_sw == true) 
		{
				start = end + 1;
				end = document.cookie.indexOf(";", start);
				if(end < start)
						end = document.cookie.length;
				return document.cookie.substring(start, end);
		}
		return "";
}
// 쿠키 지움
function delete_cookie(name) 
{
		var today = new Date();
		today.setTime(today.getTime() - 1);
		var value = get_cookie(name);
		if(value != "")
				document.cookie = name + "=" + value + "; path=/; expires=" + today.toGMTString();
}

function layer_close(id) {
	var obj = document.getElementById("expirehours"+ id);
	if (obj.checked == true) {
		set_cookie("easy_ck_pop_"+id, "done", obj.value, window.location.host);
	}
	document.getElementById("pop"+id).style.display = "none";
	selectbox_visible();
}

function selectbox_hidden(layer_id) 
{ 
		var ly = eval(layer_id); 
		// 레이어 좌표 
		var ly_left  = ly.offsetLeft; 
		var ly_top    = ly.offsetTop; 
		var ly_right  = ly.offsetLeft + ly.offsetWidth; 
		var ly_bottom = ly.offsetTop + ly.offsetHeight; 
		// 셀렉트박스의 좌표 
		var el; 
		for (i=0; i<document.forms.length; i++) { 
				for (k=0; k<document.forms[i].length; k++) { 
						el = document.forms[i].elements[k];    
						if (el.type == "select-one") { 
								var el_left = el_top = 0; 
								var obj = el; 
								if (obj.offsetParent) { 
										while (obj.offsetParent) { 
												el_left += obj.offsetLeft; 
												el_top  += obj.offsetTop; 
												obj = obj.offsetParent; 
										} 
								} 
								el_left  += el.clientLeft; 
								el_top    += el.clientTop; 
								el_right  = el_left + el.clientWidth; 
								el_bottom = el_top + el.clientHeight; 
								// 좌표를 따져 레이어가 셀렉트 박스를 침범했으면 셀렉트 박스를 hidden 시킴 
								if ( (el_left >= ly_left && el_top >= ly_top && el_left <= ly_right && el_top <= ly_bottom) || 
										(el_right >= ly_left && el_right <= ly_right && el_top >= ly_top && el_top <= ly_bottom) || 
										(el_left >= ly_left && el_bottom >= ly_top && el_right <= ly_right && el_bottom <= ly_bottom) || 
										(el_left >= ly_left && el_left <= ly_right && el_bottom >= ly_top && el_bottom <= ly_bottom) ) 
										el.style.visibility = 'hidden'; 
						} 
				} 
		} 
} 
// 감추어진 셀렉트 박스를 모두 보이게 함 
function selectbox_visible() 
{ 
		for (i=0; i<document.forms.length; i++) { 
				for (k=0; k<document.forms[i].length; k++) { 
						el = document.forms[i].elements[k];    
						if (el.type == "select-one" && el.style.visibility == 'hidden') 
								el.style.visibility = 'visible'; 
				} 
		} 
}
//팝업셋팅
//document.getElementById('pop1').style.display = "none";

//팝업 임시 숨김 140312------------------------------------------------------------------------*****
//document.getElementById('pop1').style.display = "block";

//fnSelectMouse();
//selectbox_hidden("pop1");
//selectbox_visible("pop1");
//팝업드래그
function fnSelectMouse_drag() {
	document.onmousedown = fnSelectMouse;
	document.onmouseup = new Function("blIsDrag = false");
}
//addLoadEvent(fnSelectMouse);
//addLoadEvent(fnSelectMouse_drag);
</script>
<? } ?>
</body>
</html>
