<?
$sub_menu = "300100";
include_once("./_common.php");

if($member['mb_profile'] == 1) {
	$is_admin = "super";
}
$sql_common = " from total_pay ";

if($is_admin == "super") {
	$sql_search = " where 1=1 ";
} else {
	$sql_search = " where t_no='$member[mb_id]' ";
}

// 검색 : 사업장명칭
if ($stx_comp_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (comp_name like '%$stx_comp_name%') ";
	$sql_search .= " ) ";
}
// 검색 : 사업자등록번호
if ($stx_t_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (t_no like '%$stx_t_no%') ";
	$sql_search .= " ) ";
}
// 검색 : 전화번호
if ($stx_comp_tel) {
	$sql_search .= " and ( ";
	$sql_search .= " (comp_tel like '%$stx_comp_tel%') ";
	$sql_search .= " ) ";
}
// 검색 : 처리현황
if ($stx_conduct) {
	$sql_search .= " and ( ";
	$sql_search .= " (conduct = '$stx_conduct') ";
	$sql_search .= " ) ";
} else if($stx_conduct == "0") {
	$sql_search .= " and ( ";
	$sql_search .= " (conduct = '0') ";
	$sql_search .= " ) ";
}
// 검색 : 담당자
if ($stx_damdang_code) {
	$sql_search .= " and ( ";
	$sql_search .= " (damdang_code = '$stx_damdang_code') ";
	$sql_search .= " ) ";
}
// 정렬
$sst = "wr_datetime";
$sod = "desc";
$sst2 = ", comp_email";
$sod2 = "desc";

$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 15;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>처음</a>";

$year = 2013;
$sub_title = $year."년도 보수총액신고";
$g4[title] = $sub_title." : 보수총액신고 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

$colspan = 17;
//검색 파라미터 전송
$qstr = "stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_comp_tel=".$stx_comp_tel."&stx_conduct=".$stx_conduct."&stx_damdang_code=".$stx_damdang_code;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
<script language="javascript">
function goSearch()
{
	var frm = document.searchForm;
	frm.action = "<?=$PHP_SELF?>";
	frm.submit();
	return;
}
function checkAll() {
	var f = document.dataForm;
	for( var i = 0; i<f.idx.length; i++ ) {
		f.idx[i].checked = f.checkall.checked;
	}
}
function checked_ok() {
	var frm = document.dataForm;
	var chk_cnt = document.getElementsByName("idx");
	var cnt = 0;
	var chk_data ="";

	for(i=0; i<chk_cnt.length ; i++) {
		if(frm.idx[i].checked==true) {
			cnt++;
			chk_data = chk_data + ',' + frm.idx[i].value;
		}
	}
	if(cnt==0) {
	 alert("선택된 데이터가 없습니다.");
	 return;
	} else{
		if(confirm("정말 삭제하시겠습니까?")) {
			chk_data = chk_data.substring(1, chk_data.length);
			frm.chk_data.value = chk_data;
			frm.action="total_pay_delete.php";
			frm.submit();
		} else {
			return;
		}
	} 
}
//사업자등록번호 자동 하이픈
function checkBznb(inputVal, type, keydown) {		// inputVal은 천단위에 , 표시를 위해 가져오는 값
	main = document.searchForm;			// 여기서 type 은 해당하는 값을 넣기 위한 위치지정 index
	var chk		= 0;				// chk 는 천단위로 나눌 길이를 check
	var chk2	= 0;
	var chk3	= 0;
	var share	= 0;				// share 200,000 와 같이 3의 배수일 때를 구분하기 위한 변수
	var start	= 0;
	var triple	= 0;				// triple 3, 6, 9 등 3의 배수 
	var end		= 0;				// start, end substring 범위를 위한 변수  
	var total	= "";			
	var input	= "";				// total 임의로 string 들을 규합하기 위한 변수
	//숫자 입력만
	//alert(event.keyCode);
	input = delhyphen(inputVal, inputVal.length);
	//관리자 master 입력
	//alert(input);
	if(input.substring(0,3) == "mas" || input.substring(0,3) == "use" || input.substring(0,3) == "gue") {
		//master
	} else {
		//백스페이스키 적용
		if(event.keyCode != 8) {
			//alert(inputVal.length);
			//alert(input);
			if(inputVal.length == 3){
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,3)+"-";
			} else if(inputVal.length == 6){
				total += inputVal.substring(0,8)+"-";
			} else if(inputVal.length == 12){
				total += inputVal.substring(0,14)+"";
			} else {
				total += inputVal;
			}
			if(keydown =='Y'){
				type.value = total;					// type 에 따라 최종값을 넣어 준다.
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
}
function delhyphen(inputVal, count){
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!='-'){		// 먼저 substring을 위해
			tmp += inputVal.substring(i,i+1);	// 값의 모든 , 를 제거
		}
	}
	return tmp;
}
</script>
<? include "./inc/top_admin.php"; ?>

<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="1200" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" style="padding:10px 10px 10px 10px">
							<!--타이틀 -->
							<table width="100%" border=0 cellspacing=0 cellpadding=0>
								<tr>     
									<td height="18">
										<table width=100% border=0 cellspacing=0 cellpadding=0>
											<tr>
												<td style='font-size:8pt;color:#929292;'><img src="images/g_title_icon.gif" align=absmiddle  style='margin:0 5 2 0'><span style='font-size:9pt;color:black;'><?=$sub_title?></span>
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

							<!--데이터 -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr> 
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
												검색
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
							<!--검색 -->
							<form name="searchForm" method="get">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사업장명칭</td>
										<td nowrap class="tdrow">
											<input name="stx_comp_name" type="text" class="textfm" style="width:120;ime-mode:active;" value="<?=$stx_comp_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사업자등록번호</td>
										<td nowrap class="tdrow">
											<input name="stx_t_no" type="text" class="textfm" style="width:120;ime-mode:active;" value="<?=$stx_t_no?>" maxlength="12" onkeyup="checkBznb(this.value, this,'Y')" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">전화번호</td>
										<td nowrap class="tdrow">
											<input name="stx_comp_tel"  type="text" class="textfm" style="width:120;ime-mode:active;" value="<?=$stx_comp_tel?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">처리현황</td>
										<td nowrap class="tdrow">
											<select name="stx_conduct" class="selectfm" onchange="goSearch();">
												<option value=""  <? if($stx_conduct == "")  echo "selected"; ?>>전체</option>
												<option value="0" <? if($stx_conduct == "0") echo "selected"; ?>>접수중</option>
												<option value="1" <? if($stx_conduct == "1") echo "selected"; ?>>처리중</option>
												<option value="2" <? if($stx_conduct == "2") echo "selected"; ?>>처리완료</option>
												<option value="3" <? if($stx_conduct == "3") echo "selected"; ?>>예약중</option>
												<option value="4" <? if($stx_conduct == "4") echo "selected"; ?>>반려</option>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">담당자</td>
										<td nowrap class="tdrow">
											<select name="stx_damdang_code" class="selectfm" onchange="goSearch();">
												<option value=""  <? if($stx_damdang_code == "")  echo "selected"; ?>>전체</option>
												<option value="0022" <? if($stx_damdang_code == "0022") echo "selected"; ?>>정진희</option>
												<option value="0023" <? if($stx_damdang_code == "0023") echo "selected"; ?>>이민화</option>
												<option value="0024" <? if($stx_damdang_code == "0024") echo "selected"; ?>>김국진</option>
												<option value="0025" <? if($stx_damdang_code == "0025") echo "selected"; ?>>석정현</option>
												<option value="0026" <? if($stx_damdang_code == "0026") echo "selected"; ?>>김수라</option>
												<option value="0027" <? if($stx_damdang_code == "0027") echo "selected"; ?>>전정애</option>
											</select>
										</td>
										<td align="center" nowrap class="tdrow_center">
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;height:18px;"><tr><td width=2></td><td><img src=images/btn9_lt.gif></td>
											<td style="background:url(images/btn9_bg.gif) repeat-x center" class=ftbutton5_white nowrap><a href="javascript:goSearch();" target="">검 색</a></td><td><img src=images/btn9_rt.gif></td><td width=2></td></tr></table> 
										</td>
									</tr>
								</table>
							</form>
							<div style="height:10px;font-size:0px;line-height:0px;"></div>
<?
$sql_wr_count = " select count(*) as cnt $sql_common where comp_email != '' ";
$row_wr_count = sql_fetch($sql_wr_count);
$wr_count = $row_wr_count[cnt];
?>
							<!--데이터 -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr> 
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
												통계
												</td> 
												<td><img src="images/g_tab_on_rt.gif"></td> 
											</tr> 
										</table> 
									</td> 
									<td width=2></td> 
									<td valign="bottom" style="padding:0 0 0 8px">전체 : <b><?=$wr_count?></b>건</td> 
								</tr> 
							</table>
							<div style="height:2px;font-size:0px" class="bgtr"></div>
							<div style="height:2px;font-size:0px;line-height:0px;"></div>
							<!--검색 -->
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
								<tr>
									<td class="tdrow">
<?
for($i=0;$i<24;$i++) {
	$today = date("Y-m-d", strtotime(-$i." days"));
	$sql_cnt = " select count(*) as cnt $sql_common where wr_datetime like '$today%' and comp_email != '' ";
	$row_cnt = sql_fetch($sql_cnt);
	$today_count = $row_cnt[cnt];
	echo $today."(<b>".$today_count."</b>건) ";
	if($i == 11) echo "<br>";
}
?>
									</td>
								</tr>
							</table>
							<div style="height:10px;font-size:0px;line-height:0px;"></div>

							<!--댑메뉴 -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
												리스트
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
							<!--댑메뉴 -->

							<!--리스트 -->
							<form name="dataForm" method="post">
							<input type="hidden" name="chk_data">
							<input type="hidden" name="page" value="<?=$page?>">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
								<col width="26">
								<col width="32">
								<col width="84">
								<col width="160">
								<col width="44">
								<col width="44">
								<col width="">
								<col width="94">
								<col width="88">
								<col width="175">
								<col width="40">
								<col width="40">
								<col width="62">
								<col width="48">
								<col width="44">
								<col width="44">
								<col width="44">
								<tr>
									<td nowrap class="tdhead_center"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()"></td>
									<td nowrap class="tdhead_center">No</td>
									<td nowrap class="tdhead_center">신청일자</td>
									<td nowrap class="tdhead_center">사업장명칭</td>
									<td nowrap class="tdhead_center">팩스</td>
									<td nowrap class="tdhead_center">엑셀</td>
									<td nowrap class="tdhead_center">사업장소재지</td>
									<td nowrap class="tdhead_center">사업장관리번호</td>
									<td nowrap class="tdhead_center">전화번호</td>
									<td nowrap class="tdhead_center">이메일</td>
									<td nowrap class="tdhead_center">발송</td>
									<td nowrap class="tdhead_center">신고</td>
									<td nowrap class="tdhead_center">처리현황</td>
									<td nowrap class="tdhead_center">담당자</td>
									<td nowrap class="tdhead_center">공단</td>
									<td nowrap class="tdhead_center">건강</td>
									<td nowrap class="tdhead_center">수정</td>
								</tr>
<?
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//$page
	//$total_page
	//$rows

	$no = $total_count - $i - ($rows*($page-1));
	$id = $row[id];
  $list = $i%2;

	$row[comp_name] = cut_str($row[comp_name], 22, "..");
	$comp_adr = $row[adr_adr1]." ".$row[adr_adr2];
	$comp_adr_short = cut_str($comp_adr, 13, "..");
	//신청일자
	$wr_datetime = explode(" ",$row[wr_datetime]);
	//신고건
	$result_opt_cnt = mysql_query("select count(*) as cnt from total_pay_opt where mid = $id");
	$row_opt_cnt = mysql_fetch_array($result_opt_cnt);
	$worker_count = $row_opt_cnt[cnt];
	//담당자
	$damdang_code_0022 = "정진희";
	$damdang_code_0023 = "이민화";
	if($row[damdang_code] == "0022") $damdang_name = $damdang_code_0022;
	else if($row[damdang_code] == "0023") $damdang_name = $damdang_code_0023;
	else if($row[damdang_code] == "0024") $damdang_name = "김국진";
	else if($row[damdang_code] == "0025") $damdang_name = "석정현";
	else if($row[damdang_code] == "0026") $damdang_name = "김수라";
	else if($row[damdang_code] == "0027") $damdang_name = "전정애";
	else $damdang_name = "";
	//처리현황
	if($row[conduct] == "0" || $row[conduct] == "") $ok = "접수중";
	else if($row[conduct] == "1") $ok = "처리중";
	else if($row[conduct] == "2") $ok = "처리완료";
	else if($row[conduct] == "3") $ok = "<span style='color:red'>예약중</span>";
	else if($row[conduct] == "4") $ok = "<span style='color:red'>반려</span>";
	else if($row[conduct] == "5") $ok = "<span style='color:blue'>직접입력</span>";
	//처리현황 (이메일 없음)
	if(!$row[comp_email]) $ok = "-";
	//처리일자
	$ok_datetime = explode(" ",$row[ok_datetime]);
	if($row[conduct] != "2") $ok_datetime[0] = "-";
	//뷰페이지 url
	$total_pay_view_url = "total_pay_view_admin.php?page=".$page."&id=".$id."&".$qstr;
	//수정페이지 url
	$total_pay_write_url = "total_pay_write_admin.php?w=u&page=".$page."&id=".$id."&".$qstr;
	//메일발송
	if($row[email_send] == "1") $mail_ok = "발송";
	else $mail_ok = "-";
	//이메일
	$email_url = "<a href='popup/total_pay_email_send.php?id=".$id."' onclick='window.open(this.href, \"total_pay_email_send\", \"height=300,width=540,toolbar=no,directories=no,status=no,linemenubar=no,scrollbars=no,resizable=no\");return false;'>$row[comp_email]</a>";
	//FAX발송용 url
	$total_pay_fax_url = "total_pay_fax_admin.php?page=".$page."&id=".$id."&".$qstr;
	//국민건강보험 신고용 url
	$t_no_excel = str_replace('-','',$row[t_no]);
	$total_pay_health_url = "total_pay_health.php?page=".$page."&id=".$id."&excel=".$t_no_excel;
	//공단 신고용 url
	$total_pay_center_url = "total_pay_center.php?page=".$page."&id=".$id."&".$qstr;
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
									<td nowrap class="ltrow1_center_h22"><?=$no?></td>
									<td nowrap style="text-align:center"><a href="<?=$total_pay_view_url?>"><b><?=$wr_datetime[0]?></b></a></td>
									<td nowrap class="ltrow1_left_h22" style="padding:0 0 0 4px">
										<a href="<?=$total_pay_view_url?>"><b><?=$row[comp_name]?></b></a>
									</td>
									<td nowrap class="ltrow1_center_h22">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$total_pay_fax_url?>" target="">팩스</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
									</td>
									<td nowrap class="ltrow1_center_h22">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="total_pay_excel.php?id=<?=$id?>" target="">엑셀</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
									</td>
									<td nowrap class="ltrow1_left_h22" style="padding:0 0 0 4px" title="<?=$comp_adr?>"><?=$comp_adr_short?></td>
									<td nowrap class="ltrow1_left_h22" style="padding:0 0 0 4px"><?=$row[t_no]?></td>
									<td nowrap class="ltrow1_left_h22" style="padding:0 0 0 4px"><?=$row[comp_tel]?></td>
									<td nowrap class="ltrow1_left_h22" style="padding:0 0 0 4px"><?=$email_url?></td>
									<td nowrap class="ltrow1_center_h22"><?=$mail_ok?></td>
									<td nowrap class="ltrow1_center_h22"><?=$worker_count?></td>
									<td nowrap class="ltrow1_center_h22"><?=$ok?></td>
									<td nowrap class="ltrow1_center_h22"><?=$damdang_name?></td>
									<td nowrap class="ltrow1_center_h22">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$total_pay_center_url?>" target="_blank">공단</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
									</td>
									<td nowrap class="ltrow1_center_h22">
<?
	$upload_path = $_SERVER["DOCUMENT_ROOT"]."/total_pay_result";
	$upfile_path = $upload_path."/".$t_no_excel.".xls";
	if(file_exists($upfile_path)) {
?>
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$total_pay_health_url?>" target="_blank">건강</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
<?
	} else {
		echo "-";
	}
?>
									</td>
									<td nowrap class="ltrow1_center_h22">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$total_pay_write_url?>" target="">수정</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
									</td>
								</tr>
<?
}
if ($i == 0) {
	echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
}
else if($i == 1) {
	echo "<input type='checkbox' name='idx' value='' class='no_borer' style='display:none'>";
}
?>
								<tr>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
								</tr>
							</table>

							<table width="60%" align="center" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td height="40">
										<div align="center">
											<?
											$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
											echo $pagelist;
											?>
										</div>
									</td>
								</tr>
							</table>
							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
								<tr>
									<td align="left">
<?
if($member['mb_level'] >= 7) {
	$url_del = "javascript:checked_ok();";
?>
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
											<tr>
												<td width=2></td>
												<td><img src=images/btn_lt.gif></td>
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_del?>" target="">선택삭제</a></td>
												<td><img src=images/btn_rt.gif></td>
											 <td width=2></td>
											</tr>
										</table>
<?
}
?>
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
											<tr>
												<td width=2></td>
												<td><img src=images/btn_lt.gif></td>
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="total_pay_write_admin.php" target="">신고서 작성</a></td>
												<td><img src=images/btn_rt.gif></td>
											 <td width=2></td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							</form>

						</td>
					</tr>
				</table>
				<? include "./inc/bottom.php";?>
			</td>
		</tr>
	</table>			
</div>
</body>
</html>
