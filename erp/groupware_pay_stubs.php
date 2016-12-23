<?
$sub_menu = "700500";
include_once("./_common.php");
/*
//결산 : 권한(대표, 지사장, 본부장, 부장, 경리담당, 관리자) 설정 150914
$mb_id_check = explode('000',$member['mb_id']);
if($mb_id_check[1] != "1" && $member['mb_id'] != "kcmc1001" && $member['mb_id'] != "kcmc1002" && $member['mb_id'] != "kcmc1004" && $member['mb_id'] != "kcmc1008" && $member['mb_id'] != "master") {
	alert("해당 페이지를 열람할 권한이 없습니다.");
} else {
	//접근 권한 있는 사용자 관리자 권한 160331
	$is_admin = "super";
}
*/

$is_admin = "super";

//현재 년도
$year_now = date("Y");
//년도 설정
if(!$search_year) $search_year = date("Y");

//echo date("m");
$sql_common = " from pibohum_base_pay ";

$sql_a4 = " select com_code from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4[com_code];

//echo $is_admin;
if($is_admin == "super") {
	$com_code = 395;
}
$colspan = 16;

$sql_search = " where com_code='$com_code' and year='$search_year' ";

// 검색 : 년
if($search_year) {
	$sql_search .= " and ( ";
	$sql_search .= " (year like '$search_year%') ";
	$sql_search .= " ) ";
}
//등록일
if($w_date) $sql_search .= " and w_date='$w_date' ";
//등록시
if($w_time) $sql_search .= " and w_time='$w_time' ";
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

if($is_admin == "super") {
	$sst = "com_code";
	$sod = "desc";
	if($sort1) $sod .= ", ";
}

if (!$sst1) {
	if($sort1) {
		if($sort1 == "in_day" || $sort1 == "name") $sst1 = "".$sort1;
		else $sst1 = "".$sort1;
	} else {
		$sst1 = "position";
		$sod1 = "asc";
	}
}
if (!$sst2) {
	if($sort2) {
		if($sort2 == "in_day" || $sort2 == "name") $sst2 = ", ".$sort2;
		else $sst2 = ", ".$sort2;
		$sod2 = $sod2;
	} else {
		$sst2 = ", in_day";
		$sod2 = "asc";
	}
}
if (!$sst3) {
	if($sort3) {
		if($sort3 == "in_day" || $sort3 == "name") $sst3 = ", ".$sort3;
		else $sst3 = ", ".$sort3;
		$sod3 = $sod3;
	} else {
		$sst3 = ", dept";
		$sod3 = "asc";
	}
}
if (!$sst4) {
	if($sort4) {
		if($sort4 == "in_day" || $sort4 == "name") $sst4 = ", ".$sort4;
		else $sst4 = ", ".$sort4;
		$sod4 = $sod4;
	} else {
		$sst4 = ", pay_gbn";
		$sod4 = "asc";
	}
}

$sql_order = " order by $sst $sod $sst1 $sod1 $sst2 $sod2 $sst3 $sod3 $sst4 $sod4 ,sabun asc ";

$sub_title = "급여명세";
$g4[title] = $sub_title." : 결산 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
";
//echo $sql;
$result = sql_query($sql);

//검색 파라미터 전송
$qstr = "search_year=".$search_year;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
<script type="text/javascript" src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<script type="text/javascript">
// 삭제 검사 확인
function del(page,id) 
{
	if(confirm("삭제하시겠습니까?")) {
		location.href = "4insure_delete.php?page="+page+"&id="+id;
	}
}
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
	//alert(chk_data);
	if(cnt==0) {
	 alert("선택된 데이터가 없습니다.");
	 return;
	} else {
		if(confirm("정말 삭제하시겠습니까?")) {
			chk_data = chk_data.substring(1, chk_data.length);
			frm.chk_data.value = chk_data;
			frm.action="pay_ledger_delete.php";
			frm.submit();
		} else {
			return;
		}
	} 
}
function printPayList(search_year, search_month) {
	frm = document.printForm;
	frm.mode.value = "salary_list";
	frm.search_year.value = search_year;
	frm.search_month.value = search_month;
	frm.target = "_blank";
	frm.action = "pay_ledger.php?code=<?=$com_code?>";
	frm.submit();
}
function month_plus() {
	f = document.searchForm;
	year_var = f.search_year.value;
	month_var = f.search_month.value;
	if(month_var == "12") {
		year_var = toInt(year_var) + 1;
		month_var = "01";
	} else {
		month_var = ""+(toInt(month_var) + 1);
		if(month_var.length == 1) {
		 month_var = "0"+month_var;
		}
	}
	if(year_var > <?=$year_now?>) {
		alert("<?=$year_now?>년까지 조회가 가능합니다.");
		return;
	}
	f.search_year.value = year_var;
	f.search_month.value = month_var;
	goSearch();
}
function month_minus() {
	f = document.searchForm;
	year_var = f.search_year.value;
	month_var = f.search_month.value;
	if(month_var == "01" || month_var == "") {
		year_var = toInt(year_var) - 1;
		month_var = "12";
	} else {
		month_var = ""+(toInt(month_var) - 1);
		if(month_var.length == 1) {
		 month_var = "0"+month_var;
		}
	}
	if(year_var == "2012") {
		alert("2013년부터 조회가 가능합니다.");
		return;
	}
	f.search_year.value = year_var;
	f.search_month.value = month_var;
	goSearch();
}
</script>
<?
//echo $member['mb_level'];
if( ($member['mb_profile'] >= 110 && $member['mb_profile'] <= 200) || $member['mb_level'] == 4 ) include "inc/top_dealer.php";
else include "inc/top.php";
?>
		<td onmouseover="showM('900')" valign="top">
			<div style="margin:10px 20px 20px 20px;min-height:480px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100"><img src="images/top07.gif" border="0" alt="그룹웨어" /></td>
						<td width="130"><img src="images/top_groupware_pay_stubs.png" border="0" alt="급여명세" /></td>
						<td></td>
					</tr>
					<tr><td height="1" bgcolor="#cccccc" colspan="9"></td></tr>
				</table>
				<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" style="padding:10px 0 0 0">

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
								<input type="hidden" name="page" value="<?=$page?>">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<col width="10%">
									<col width="10%">
									<col width="">
									<tr>
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">급여년도</td>
										<td nowrap class="tdrow">
											<select name="search_year" class="selectfm" onChange="goSearch();">
<?
for($i=2011;$i<=$year_now;$i++) {
?>
												<option value="<?=$i?>" <? if($i == $search_year) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
											</select> 년
										</td>
										<td  nowrap class="tdrow">
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;height:18px;"><tr><td width=2></td><td><img src=images/btn9_lt.gif></td>
											<td style="background:url(images/btn9_bg.gif) repeat-x center" class=ftbutton5_white nowrap><a href="javascript:goSearch();" target="">검 색</a></td><td><img src=images/btn9_rt.gif></td><td width=2></td></tr></table> 
										</td>
									</tr>
								</table>
							</form>
							<div style="height:10px;font-size:0px;line-height:0px;"></div>

							<form name="printForm" method="post" style="margin:0">
								<input type="hidden" name="mode">
								<input type="hidden" name="search_year" value="<?=$search_year?>">
								<input type="hidden" name="search_month" value="<?=$search_month?>">
							</form>
<?
// 리스트 출력
$sst2 = "year desc";
$sst3 = ", month desc";
$sql_order_month = " order by $sst2 $sst3 , w_date asc, w_time asc ";
$sql_month = " select count(*) as cnt
				 $sql_common
				 $sql_search
				 $sql_order ";

//echo $sql;
$row_month = sql_fetch($sql_month);
$total_count_month = $row_month[cnt];

$rows = 15;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql_month = " select com_code, sabun, year, month, count(month) as cnt, sum(money_total) as sum_total, sum(money_gongje) as sum_gongje, 
					sum(money_result) as sum_result, w_date, w_time, sum(money_min_base) as sum_money_min_base, sum(money_time) as sum_money_time,
					sum(money_month) as sum_money_month,
					group_concat(DISTINCT dept SEPARATOR '. ') as dept
					$sql_common
					$sql_search group by year, month, w_date, w_time
					$sql_order_month 
					limit $from_record, $rows ";
//echo $sql_month;
$result_month = sql_query($sql_month);
$colspan_month = 10;

for ($i=0; $row_month=sql_fetch_array($result_month); $i++) {
	$pay_month = $row_month['month'];
	//초기 등록일시
	$w_date_first[$pay_month] = $row_month['w_date'];
	$w_time_first[$pay_month] = $row_month['w_time'];
}
?>
							<!--댑메뉴 -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
												개별 출력
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
							<style>
							.btn00 {display:inline-block;border-top:#DFDFDF solid 1px;border-left:#DFDFDF solid 1px;border-right:#DFDFDF solid 1px;border-bottom:#C0C0C0 solid 1px;}
							.btn00 a {display:inline-block;border-top:#FFFFFF solid 1px;background:#EFEFEF;padding:1px 5px 1px 5px;color:#444;font-family:dotum;font-size:11px;text-decoration:none;letter-spacing:-1px;}
							.btn00 a:hover {background:#E1E1E1;}
							.btn00 input {margin:0;cursor:pointer;border-top:#DFDFDF solid 1px;border-left:#DFDFDF solid 1px;border-right:#DFDFDF solid 1px;border-bottom:#C0C0C0 solid 1px;background:#EFEFEF;height:13px;color:#444;font-family:dotum;font-weight:bold;font-size:11px;text-decoration:none;letter-spacing:-1px;}
							.btn00 input:hover {background:#E1E1E1;}
							</style>
							<form name="dataForm" method="post">
							<input type="hidden" name="chk_data">
							<input type="hidden" name="page" value="<?=$page?>">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
								<tr>
									<td nowrap class="tdhead_center" width="50">연도</td>
									<td nowrap class="tdhead_center" width="30">월</td>
									<td nowrap class="tdhead_center" width="70">이름</td>
									<td nowrap class="tdhead_center" width="74">입사일</td>
									<td nowrap class="tdhead_center" width="60">급여유형</td>
									<td nowrap class="tdhead_center" width="70">직위</td>
									<td nowrap class="tdhead_center" width="70">부서</td>
									<td nowrap class="tdhead_center" width="60">기본시급</td>
									<td nowrap class="tdhead_center" width="60">통상시급</td>
									<td nowrap class="tdhead_center" width="86">기본월급</td>
									<td nowrap class="tdhead_center" width="">과세</td>
									<td nowrap class="tdhead_center" width="">비과세</td>
									<td nowrap class="tdhead_center" width="">공제계</td>
									<td nowrap class="tdhead_center" width="">실지급액</td>
									<td nowrap class="tdhead_center" width="65">엑셀저장</td>
								</tr>
<?
//ERP ID -> mb_code
$mb_id = $member['mb_id'];
$sql_manage = " select * from a4_manage where state=1 and user_id='$mb_id' ";
$result_manage = sql_query($sql_manage);
$row_manage = mysql_fetch_array($result_manage);
$mb_code = $row_manage['code'];
//ERP mb_code -> sabun
$sql_sabun = " select * from pibohum_base where mb_code='$mb_code' ";
$result_sabun = sql_query($sql_sabun);
$row_sabun = mysql_fetch_array($result_sabun);
$sabun = $row_sabun['sabun'];

for($i=12; $i>=1; $i--) {
	//최근 저장 급여DB 호출
	if($i < 10) $search_month = "0".$i;
	else $search_month = $i;
	$sql_common = " from pibohum_base_pay ";

	//관리자 권한 모든 근로자 표시 160610 / 단일 레코드 처리로 작업 보류
	//if($mb_id != 'master') $where_sabun = " and sabun='$sabun' ";
	//else $where_sabun = "";

	//해당 근로자 급여명세만 표시 160610
	$where_sabun = " and sabun='$sabun' ";

	$sql_search = " where com_code='$com_code' $where_sabun and year='$search_year' and month='$search_month' and w_date='$w_date_first[$search_month]' and w_time='$w_time_first[$search_month]' ";
	$sql_search .= " and money_result > 0 ";
	$sql = " select * $sql_common $sql_search $sql_order ";
	//echo $sql;
	$result = sql_query($sql);
	$row = mysql_fetch_array($result);
	// 리스트 출력
	$name = cut_str($row[name], 6, "..");
	//채용형태
	$work_form = $row[work_form];
	//입사일
	$in_day = $row['in_day'];
	//급여유형
	if($row[pay_gbn] == 0) $pay_gbn = "월급제";
	else if($row[pay_gbn] == 1) $pay_gbn = "시급제";
	else if($row[pay_gbn] == 2) $pay_gbn = "복합근무";
	else if($row[pay_gbn] == 3) $pay_gbn = "연봉제";
	else $pay_gbn = "-";
	//직위
	$sql_position = " select * from com_code_list where com_code = '$row[com_code]' and code='$row[position]' and item='position' ";
	//echo $sql_position;
	$result_position = sql_query($sql_position);
	$row_position=mysql_fetch_array($result_position);
	//echo $row_position[name];
	if($row_position[name]) $position_name = $row_position[name];
	else $position_name = "-";
/*
	//사원정보 급여 DB
	$sql_pay = " select * from pibohum_base_pay where com_code='$row[com_code]' and sabun='$row[sabun]' and year='$row[year]' and month='$row[month]' ";
	//echo $sql_pay;
	$result_pay = sql_query($sql_pay);
	$row_pay=mysql_fetch_array($result_pay);
*/
	//서식 링크
	$url_form_excel = "pay_stubs_excel.php?id=".$row['sabun']."&code=".$com_code."&search_year=".$search_year."&search_month=".$search_month."&w_date=".$w_date_first[$search_month]."&w_time=".$w_time_first[$search_month];
	//비과세 합계 160329
	$tax_exemption = $row['money_total']  - $row['money_for_tax'];
	//데이터 존재 시 표시
	if($row['idx']) {
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><?=$search_year?></td>
									<td nowrap class="ltrow1_center_h22"><?=$search_month?></td>
									<td nowrap class="ltrow1_center_h22"><b><?=$name?></b></td>
									<td nowrap class="ltrow1_center_h22"><?=$in_day?></td>
									<td nowrap class="ltrow1_center_h22"><?=$pay_gbn?></td>
									<td nowrap class="ltrow1_center_h22"><?=$position_name?></td>
									<td nowrap class="ltrow1_center_h22"><?=$row['dept']?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row[money_min_base])?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row[money_time])?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row[money_month])?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row[money_for_tax])?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($tax_exemption)?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row['money_gongje'])?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row['money_result'])?></td>
									<td nowrap class="ltrow1_center_h22"><span class="btn00"><a href="<?=$url_form_excel?>">엑셀저장</a></span></td>
								</tr>
<?
	}
}
?>
							</table>
							</form>


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
