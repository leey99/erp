<?
$sub_menu = "200100";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$sql_common = " from $g4[pibohum_base] a, pibohum_base_opt b ";

//사업장정보 옵션 DB
$sql_com_opt = " select * from com_list_gy_opt where com_code='$com_code' ";
$result_com_opt = sql_query($sql_com_opt);
$row_com_opt=mysql_fetch_array($result_com_opt);
//사업장 타입
if($row_com_opt[comp_print_type]) {
	$comp_print_type = $row_com_opt[comp_print_type];
} else {
	$comp_print_type = "default";
}
//사업장정보 옵션 opr2 DB
$sql_com_opt2 = " select * from com_list_gy_opt2 where com_code='$com_code' ";
$result_com_opt2 = sql_query($sql_com_opt2);
$row_com_opt2=mysql_fetch_array($result_com_opt2);

//echo $is_admin;
if($is_admin == "super") {
	$sql_search = " where 1=1 ";
} else {
	$sql_search = " where a.com_code='$com_code' ";
}
//옵션DB join
$sql_search .= " and ( ";
$sql_search .= " (a.com_code = b.com_code and a.sabun = b.sabun) ";
$sql_search .= " ) ";
//화성시장애인부모회 : 활동보조인 추출
if($comp_print_type == "H") {
	//화성서남부
	if($com_code == 20627) $sql_search .= " and ( b.position = '5' ) ";
	else $sql_search .= " and ( b.position = '13' ) ";
}
// 검색 : 부서
if ($stx_dept) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.dept = '$stx_dept') ";
	$sql_search .= " ) ";
}
//echo $stx_name;
// 검색 : 성명
if ($stx_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.name like '$stx_name%') ";
	$sql_search .= " ) ";
}
// 검색 : 사번
if ($stx_sabun) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.sabun like '$stx_sabun%') ";
	$sql_search .= " ) ";
}
// 검색 : 채용형태
if ($stx_work_form) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.work_form = $stx_work_form) ";
	$sql_search .= " ) ";
}
// 검색 : 취득여부
//echo $stx_get_ok;
//exit;
if ($stx_get_ok == '0') {
	$sql_search .= " and ( ";
	$sql_search .= " (a.apply_gy = '$stx_get_ok') ";
	$sql_search .= " ) ";
} else if ($stx_get_ok == 1) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.apply_gy = '') ";
	$sql_search .= " ) ";
}
//검색 : 재직상태
if(!$stx_emp_stat) $stx_emp_stat = "0";
if ($stx_emp_stat != "all") {
	$sql_search .= " and ( ";
	$sql_search .= " (a.gubun = '$stx_emp_stat') ";
	$sql_search .= " ) ";
}
//검색 : 임시퇴사
if($stx_out_temp == "no") $stx_out_temp_var = "";
if($stx_out_temp != "all") {
	if($stx_out_temp == 1) $stx_out_temp_var = 1;
	$sql_search .= " and ( ";
	$sql_search .= " (a.out_temp = '$stx_out_temp_var') ";
	$sql_search .= " ) ";
}
//정렬
$sql_common_sort = " from com_code_sort ";
$sql_search_sort = " where com_code = '$com_code' ";
//정렬 1순위
$sql1 = " select * $sql_common_sort $sql_search_sort  and code = '1' ";
$result1 = sql_query($sql1);
$row1 = mysql_fetch_array($result1);
$sort1 = $row1[item];
$sod1 = $row1[sod];
//정렬 2순위
$sql2 = " select * $sql_common_sort $sql_search_sort  and code = '2' ";
$result2 = sql_query($sql2);
$row2 = mysql_fetch_array($result2);
$sort2 = $row2[item];
$sod2 = $row2[sod];
//정렬 3순위
$sql3 = " select * $sql_common_sort $sql_search_sort  and code = '3' ";
$result3 = sql_query($sql3);
$row3 = mysql_fetch_array($result3);
$sort3 = $row3[item];
$sod3 = $row3[sod];
//정렬 4순위
$sql4 = " select * $sql_common_sort $sql_search_sort  and code = '4' ";
$result4 = sql_query($sql4);
$row4 = mysql_fetch_array($result4);
$sort4 = $row4[item];
$sod4 = $row4[sod];

if (!$sst) {
	if($is_admin == "super") {
		$sst = "a.com_code";
		$sod = "desc";
	} else {
		if($sort1) {
			if($sort1 == "in_day" || $sort1 == "name" || $sort1 == "work_form") $sst = "a.".$sort1;
			else $sst = "b.".$sort1;
			$sod = $sod1;
		} else {
			$sst = "b.position";
			$sod = "asc";
		}
	}
}
if (!$sst2) {
	if($sort2) {
		if($sort2 == "in_day" || $sort2 == "name" || $sort2 == "work_form") $sst2 = ", a.".$sort2;
		else $sst2 = ", b.".$sort2;
		$sod2 = $sod2;
	} else {
		$sst2 = ", a.in_day";
		$sod2 = "asc";
	}
}
if (!$sst3) {
	if($sort3) {
		if($sort3 == "in_day" || $sort3 == "name" || $sort3 == "work_form") $sst3 = ", a.".$sort3;
		else $sst3 = ", b.".$sort3;
		$sod3 = $sod3;
	} else {
		$sst3 = ", b.dept";
		$sod3 = "asc";
	}
}
if (!$sst4) {
	if($sort4) {
		if($sort4 == "in_day" || $sort4 == "name" || $sort4 == "work_form") $sst4 = ", a.".$sort4;
		else $sst4 = ", b.".$sort4;
		$sod4 = $sod4;
	} else {
		$sst4 = ", b.pay_gbn";
		$sod4 = "asc";
	}
}

$sql_order = " order by $sst $sod $sst2 $sod2 $sst3 $sod3 $sst4 $sod4 ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];
//페이지 무시 전체보기
if($page == "all") $rows = 100;
else $rows = 15;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>처음</a>";

$sub_title = "급여정보";
$g4[title] = $sub_title." : 사원관리 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 14;
//검색 파라미터 전송
$qstr  = "stx_dept=".$stx_dept."&amp;stx_name=".$stx_name."&amp;stx_sabun=".$stx_sabun."&amp;stx_work_form=".$stx_work_form."&amp;stx_emp_stat=".$stx_emp_stat."&amp;stx_out_temp=".$stx_out_temp."&amp;sst=".$sst."&amp;sod=".$sod;
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
<script language="javascript">
// 삭제 검사 확인
function del(page,id) {
	if(confirm("삭제하시겠습니까?")) {
		location.href = "4insure_delete.php?page="+page+"&id="+id;
	}
}
function goSearch() {
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
			frm.action="staff_delete.php";
			frm.submit();
		} else {
			return;
		}
	} 
}
//급여복사
function pay_copy(id) {
	var ret = window.open("./popup/staff_pay_copy.php?id="+id, "pay_copy", "width=640, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
	return;
}
//영역출력
function printIt(printThis)  {
	var win=null;
	win = window.open();
	self.focus();
	win.document.open();
	win.document.write('<'+'html'+'><'+'head'+'>');
	win.document.write("<"+"link rel='stylesheet' type='text/css' href='http://easynomu.com/easynomu2/css/style.css'"+">");
	win.document.write("<"+"link rel='stylesheet' type='text/css' href='http://easynomu.com/easynomu2/css/style_admin.css'"+">");
	win.document.write('<'+'/'+'head'+'>');
	win.document.write("<"+"body style='text-align:center'"+">");
	win.document.write("<"+"div style='width:910px'"+">");
	win.document.write(printThis);
	win.document.write("<"+"/"+"div"+">");
	win.document.write('<'+'/'+'body'+'><'+'/'+'html'+'>');
	win.document.close();
	win.print();
	win.close();
}
</script>
<? include "./inc/top.php"; ?>

<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="1200" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="270">
<?
if($comp_print_type == "H") {
	include "./inc/left_menu2_type_h.php";
} else {
	include "./inc/left_menu2.php";
}
include "./inc/left_banner.php";
?>
						</td>
						<td valign="top" style="padding:10px 10px 10px 10px">
							<!--타이틀 -->
							<table width="100%" border=0 cellspacing=0 cellpadding=0>
								<tr>     
									<td height="18">
										<table width=100% border=0 cellspacing=0 cellpadding=0>
											<tr>
												<td style='font-size:9pt;color:#929292;'><img src="images/g_title_icon.gif" align=absmiddle  style='margin:0 5 2 0'><span style='font-size:9pt;color:black;'><?=$sub_title?></span>
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
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1">
									<tr>
										<td nowrap class="tdrowk"><b>부서</b></td>
										<td nowrap class="tdrow">
											<select name="stx_dept" class="selectfm">
												<option value="">전체</option>
												<?
												$sql_dept = " select * from com_code_list where item='dept' and com_code='$com_code' order by code ";
												$result_dept = sql_query($sql_dept);
												for($i=0; $row_dept=sql_fetch_array($result_dept); $i++) {
												?>

												<option value="<?=$row_dept[code]?>" <? if($stx_dept == $row_dept[code]) echo "selected"; ?> ><?=$row_dept[name]?></option>
												<?
												}
												?>
											</select>
										</td>
										<td nowrap class="tdrowk">성명</td>
										<td nowrap class="tdrow">
											<input name="stx_name" type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk">채용형태</td>
										<td nowrap class="tdrow">
											<select name="stx_work_form" class="selectfm">
												<option value="">전체</option>
												<option value="1" <? if($stx_work_form == 1) echo "selected"; ?> >정규직</option>
												<option value="2" <? if($stx_work_form == 2) echo "selected"; ?> >계약직</option>
												<option value="3" <? if($stx_work_form == 3) echo "selected"; ?> >일용직</option>
												<option value="4" <? if($stx_work_form == 4) echo "selected"; ?> >사업소득</option>
											</select>
										</td>
										<td nowrap class="tdrowk">재직상태</td>
										<td nowrap class="tdrow">
											<select name="stx_emp_stat" class="selectfm">
												<option value="all">전체</option>
												<option value="0" <? if($stx_emp_stat == '0') echo "selected"; ?> >재직</option>
												<option value="1" <? if($stx_emp_stat == '1') echo "selected"; ?> >휴직</option>
												<option value="2" <? if($stx_emp_stat == '2') echo "selected"; ?> >퇴직</option>
											</select>
										</td>
										<td nowrap class="tdrowk">임시퇴사</td>
										<td nowrap class="tdrow">
											<select name="stx_out_temp" class="selectfm">
												<option value="all">전체</option>
												<option value="1" <? if($stx_out_temp == '1') echo "selected"; ?> >임시퇴사</option>
												<option value="no" <? if($stx_out_temp == 'no') echo "selected"; ?> >재직자</option>
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
									<td valign="bottom" style="padding:0 0 0 10px"><b>총 <?=$total_count?>명</b> (성명을 클릭 시 상세 내용을 볼 수 있습니다.)</td>
								</tr> 
							</table>
							<div style="height:2px;font-size:0px" class="bgtr"></div>
							<div style="height:2px;font-size:0px;line-height:0px;"></div>
							<!--댑메뉴 -->

							<!--리스트 -->
							<form name="dataForm" method="post">
							<input type="hidden" name="chk_data">
							<input type="hidden" name="page" value="<?=$page?>">
							<div id="printme">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:;">
								<tr>
									<td nowrap class="tdhead_center" width="3%"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()"></td>
<?
//정렬 기능
if($sod == "asc") $sod_sort = "desc";
else $sod_sort = "asc";
$sort_name = $PHP_SELF."?page=".$page."&sst=a.name&sod=".$sod_sort;
$sort_position = $PHP_SELF."?page=".$page."&sst=b.position&sod=".$sod_sort;
$sort_jumin_no = $PHP_SELF."?page=".$page."&sst=a.jumin_no&sod=".$sod_sort;
$sort_in_day = $PHP_SELF."?page=".$page."&sst=a.in_day&sod=".$sod_sort;
$sort_dept = $PHP_SELF."?page=".$page."&sst=b.dept_1&sod=".$sod_sort;

if($is_admin == "super") {
?>
									<td nowrap class="tdhead_center" width="156">사업장</td>
<?
}
?>
									<td nowrap class="tdhead_center" width="34">번호</td>

									<td nowrap class="tdhead_center" width=""><a href="<?=$sort_name?>">성명</a></td>
									<td nowrap class="tdhead_center" width="58"><a href="<?=$sort_position?>">직위</a></td>
									<td nowrap class="tdhead_center" width="90"><a href="<?=$sort_dept?>">부서</a></td>
									<td nowrap class="tdhead_center" width="70"><a href="<?=$sort_jumin_no?>">주민번호<br />만나이</a></td>
									<td nowrap class="tdhead_center" width="70"><a href="<?=$sort_in_day?>">입사일<br />퇴사일</a></td>
									<td nowrap class="tdhead_center" width="70">근로시간</td>
<?
if($is_admin != "super") {
?>
									<td nowrap class="tdhead_center" width="60"><a href="<?=$sort_jumin_no?>">급여유형</a></td>
<?
}
?>
									<td nowrap class="tdhead_center" width="72" style="line-height:100%;">보건복지<br /><span style="font-size:8pt;">(평근/휴심)</span></td>
									<td nowrap class="tdhead_center" width="72" style="line-height:100%;">경기도<br /><span style="font-size:8pt;">(평근/휴심)</span></td>
									<td nowrap class="tdhead_center" width="65" style="line-height:100%;">화성시<br /><span style="font-size:8pt;">(평근/휴심)</span></td>
									<td nowrap class="tdhead_center" width="64">교육시간<br />스마트폰</td>
									<td nowrap class="tdhead_center" width="70">급여복사</td>
								</tr>
<?
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//$page
	//$total_page
	//$rows

	//$no = $total_count - $i - ($rows*($page-1));
	$no = $i + 1;
  $list = $i%2;
	//사업장 코드 / 사번 / 코드_사번
	$code = $row[com_code];
	$id = $row[sabun];
	$code_id = $code."_".$id;
	// 사업장명 : 사업장코드
	$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$code' ";
	$row_com = sql_fetch($sql_com);
	$com_name = $row_com[com_name];
	$com_name = cut_str($com_name, 21, "..");
	$name = cut_str($row[name], 6, "..");
	//채용형태
	if($row[work_form] == "") $work_form = "-";
	else if($row[work_form] == "1") $work_form = "정규직";
	else if($row[work_form] == "2") $work_form = "계약직";
	else if($row[work_form] == "3") $work_form = "일용직";
	else $work_form = "-";
	//입사일/퇴사일
	if($row[in_day] == "..") $in_day = "-";
	else if($row[in_day] == "") $in_day = "-";
	else $in_day = $row[in_day];
	if($row[out_day] == "..") $out_day = "-";
	else if($row[out_day] == "") $out_day = "-";
	else $out_day = $row[out_day];
	//퇴사자 표시
	if($row[out_day] == "..") $out_text = "";
	else if($row[out_day] == "") $out_text = "";
	else $out_text = "(퇴사)";
	//사원 추가 DB
	$sql2 = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
	$result2 = sql_query($sql2);
	$row2=mysql_fetch_array($result2);
	//직위
	$position = " ";
	if($row2[position]) {
		$sql_position = " select * from com_code_list where item='position' and com_code = '$code' and code = $row2[position] ";
		//echo $sql_position;
		$result_position = sql_query($sql_position);
		$row_position = sql_fetch_array($result_position);
		$position = $row_position[name];
		if($position == "단시간근로자") $position = "단시간<br />근로자";
	}
	//부서
	//$dept = $row2[dept_1];
	if($row2[dept]) {
		$sql_dept = " select * from com_code_list where item='dept' and com_code='$code' and code = $row2[dept] ";
		$result_dept = sql_query($sql_dept);
		$row_dept = sql_fetch_array($result_dept);
		$dept = $row_dept[name];
		if($dept == "명동지점(스텝)") $dept = "명동지점<br />(스텝)";
		else if($dept == "안양지점(스텝)") $dept = "안양지점<br />(스텝)";
		else if($dept == "명동지점(대리주차)") $dept = "명동지점<br />(대리주차)";
		else if($dept == "안양지점(대리주차)") $dept = "안양지점<br />(대리주차)";
	} else {
		$dept = "-";
	}
	//주민등록번호 뒷 다섯자리 별표 처리
	$jumin_no = substr($row[jumin_no],0,9)."*";
	//만나이
	$now_date = date("Ymd");
	$jumin_date = "19".substr($row[jumin_no],0,9);
	$age_cal = ( $now_date - $jumin_date ) / 10000;
	$age = (int)$age_cal;
	//근로시간
	$work_gbn = $row2[work_gbn];
	$sql_time = " select * from a4_work_time where com_code = '$code' and work_gbn = '$work_gbn' ";
	$result_time = sql_query($sql_time);
	$row_time = sql_fetch_array($result_time);
	$work_gbn_text = $row_time[work_gbn_text];
	if($work_gbn_text) $work_gbn_text = cut_str($work_gbn_text, 8, "..");
	//급여구분
	if($row2[pay_gbn] == "0") $pay_gbn = "월급제";
	else if($row2[pay_gbn] == "1") $pay_gbn = "시급제";
	else if($row2[pay_gbn] == "2") $pay_gbn = "복합근무";
	else if($row2[pay_gbn] == "3") $pay_gbn = "연봉제";
	else if($row2[pay_gbn] == "4") $pay_gbn = "일급제";
	else if($row2[pay_gbn] == "5") $pay_gbn = "사업소득";
	else $pay_gbn = "-";
	//결정임금
	$sql_pay = " select * from pibohum_base_opt2 where com_code='$code' and sabun='$id' ";
	//echo $sql_pay;
	$result_pay = sql_query($sql_pay);
	$row_pay = sql_fetch_array($result_pay);
	$money_month_base = $row_pay[money_month_base];
	//기본급
	$money_hour_ms = $row_pay[money_hour_ms];
	//기본시급
	$money_min_base = $row_pay[money_min_base];
	if($money_min_base < 5210) $money_min_base_color = "style='color:red'";
	else $money_min_base_color = "";
	//기준시급
	$money_hour_ds = $row_pay[money_hour_ds];
	//통상시급
	$money_hour_ts = $row_pay[money_hour_ts];
	//제수당
	$money_g = $row_pay[money_g1] + $row_pay[money_g2] + $row_pay[money_g3] + $row_pay[money_g4] + $row_pay[money_g5];
	$money_b = $row_pay[money_b1] + $row_pay[money_b2] + $row_pay[money_b3] + $row_pay[money_b4] + $row_pay[money_b5];
	$money_e = $row_pay[money_e1] + $row_pay[money_e2] + $row_pay[money_e3] + $row_pay[money_e4] + $row_pay[money_e5] + $row_pay[money_e6] + $row_pay[money_e7] + $row_pay[money_e8];
	$money_allowance = $money_g + $money_b + $money_e;
	//보건복지 경기도 화성시 교육시간 스마트폰
	if($row_pay['money_hour_ds']) {
		$money_time1 = number_format($row_com_opt2['money_time1']);
		$money_time2 = number_format($row_com_opt2['money_time2']);
		$money_time3 = number_format($row_com_opt2['money_time3']);
		$money_time1_hday = number_format($row_com_opt2['money_time1_hday']);
		$money_time2_hday = number_format($row_com_opt2['money_time2_hday']);
		$money_time3_hday = number_format($row_com_opt2['money_time3_hday']);
		$money_time_edu = number_format($row_com_opt2['money_time_edu']);
		$money_time_phone = number_format($row_com_opt2['money_time_phone']);
	} else {
		$money_time1 = "-";
		$money_time2 = "-";
		$money_time3 = "-";
		$money_time1_hday = "-";
		$money_time2_hday = "-";
		$money_time3_hday = "-";
		$money_time_edu = "-";
		$money_time_phone = "-";
	}
	//권한별 링크값
	if($member['mb_profile'] == "guest") {
		$url_pay_copy = "javascript:alert_demo();";
	} else {
		$url_pay_copy = "javascript:pay_copy('".$code_id."');";
	}
	//사원정보 링크
	$staff_url = "staff_view.php?w=u&id=$id&code=$code&page=$page";
	//급여정보 링크
	$pay_url = "staff_pay_view.php?w=u&id=$id&code=$code&page=$page&tab=tab2";
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$code_id?>" class="no_borer"></td>
<?
if($is_admin == "super") {
?>
									<td nowrap class="ltrow1_left_h22" style="padding:4px"><?=$com_name?>&nbsp;</td>
<?
}
?>
									<td nowrap class="ltrow1_center_h22"><?=$no?></td>
									<td nowrap class="ltrow1_center_h22">
										<a href="<?=$pay_url?>"><b><?=$name?></b><br /><?=$out_text?></a>
									</td>
									<td nowrap class="ltrow1_center_h22"><?=$position?></td>
									<td nowrap class="ltrow1_center_h22"><?=$dept?>&nbsp;</td>
									<td nowrap class="ltrow1_center_h22"><?=$jumin_no?><br />(만 <?=$age?>)</td>
									<td nowrap class="ltrow1_center_h22"><?=$in_day?><br /><span style="color:red"><?=$out_day?></span></td>
									<td nowrap class="ltrow1_center_h22"><?=$work_gbn_text?><br /><?=$work_gbn?></td>
<?
if($is_admin != "super") {
	if($row_pay[input_type] == "1") $input_type = "A";
	else if($row_pay[input_type] == "2") $input_type = "B";
	else if($row_pay[input_type] == "3") $input_type = "C";
	else $input_type = "-";
?>
									<td nowrap class="ltrow1_center_h22"><?=$pay_gbn?><br /><?=$input_type?></td>
<?
}
?>
									<td nowrap class="ltrow1_center_h22"><?=$money_time1?><br /><?=$money_time1_hday?></td>
									<td nowrap class="ltrow1_center_h22"><?=$money_time2?><br /><?=$money_time2_hday?></td>
									<td nowrap class="ltrow1_center_h22"><?=$money_time3?><br /><?=$money_time3_hday?></td>
									<td nowrap class="ltrow1_center_h22"><?=$money_time_edu?><br /><?=$money_time_phone?></td>
									<td nowrap class="ltrow1_center_h22"><table border=0 cellpadding=0 cellspacing=0 style="display:inline;"><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class="ftbutton1" nowrap><a href="<?=$url_pay_copy?>" target="">급여복사</a></td><td><img src="images/btn_rt.gif"></td><td width=2></td></tr></table></td>
								</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
?>
								<tr>
									<td nowrap class="tdhead_center"></td>
<?
if($is_admin == "super") {
?>
									<td nowrap class="tdhead_center"></td>
<?
}
?>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
<?
if($is_admin != "super") {
?>
									<td nowrap class="tdhead_center"></td>
<?
}
?>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
								</tr>
							</table>
							</div><!--영역출력-->
							<input type="checkbox" name="idx" value="" style="display:none">

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
<?
//권한별 링크값
if($member['mb_profile'] == "guest") {
	$url_del = "javascript:alert_demo();";
	$url_view = "javascript:alert_demo();";
	$url_print = "javascript:alert_demo();";
} else {
	$url_del = "javascript:checked_ok();";
	$url_view = "staff_view.php?code=$code";
	$url_print = "javascript:printIt(document.getElementById('printme').innerHTML);";
}
?>

							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
								<tr>
									<td align="center">
										<a href="<?=$url_print?>" target=""><img src="images/btn_print_big.png" border="0"></a>
									</td>
								</tr>
							</table>
							</form>
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
