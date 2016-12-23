<?
$sub_menu = "600300";
include_once("./_common.php");

//echo $member[mb_profile];
if($is_admin != "super") {
	$stx_man_cust_name = $member[mb_profile];
}
$is_admin = "super";
//echo $is_admin;

//년도, 월 설정
if(!$search_year) $search_year = date("Y");
if(!$search_month) $search_month = date("m");

$sql_common = " from $g4[pibohum_base] a, pibohum_base_opt b ";

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
//급여월 이후 입사자 제외
$year_month = $search_year.".".$search_month;
$in_day_base = $year_month.".32";
$sql_search .= " and ( a.in_day = '' or a.in_day < '$in_day_base' ) ";
//퇴직자 제외
$year_month = $search_year.".".$search_month;
$out_day_base = $year_month.".01";
$sql_search .= " and ( a.out_day = '' or a.out_day > '$out_day_base' ) ";
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
	$sql_search .= " (a.work_form like '$stx_work_form%') ";
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

if (!$sst) {
	if($is_admin == "super") {
		$sst = "a.com_code";
		$sod = "desc";
	} else {
		if($sort1) {
			if($sort1 == "in_day" || $sort1 == "name") $sst = "a.".$sort1;
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
		if($sort2 == "in_day" || $sort2 == "name") $sst2 = ", a.".$sort2;
		else $sst2 = ", b.".$sort2;
		$sod2 = $sod2;
	} else {
		$sst2 = ", a.in_day";
		$sod2 = "asc";
	}
}
if (!$sst3) {
	if($sort3) {
		if($sort3 == "in_day" || $sort3 == "name") $sst3 = ", a.".$sort3;
		else $sst3 = ", b.".$sort3;
		$sod3 = $sod3;
	} else {
		$sst3 = ", b.dept";
		$sod3 = "asc";
	}
}

$sql_order = " order by $sst $sod $sst2 $sod2 $sst3 $sod3 ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 180;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>처음</a>";

$sub_title = "급여반영";
$g4[title] = $sub_title." : 급여관리 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 12;

//급여반영 테이블 넓이
$pay_list_width = 3550;

//급여관리 DB (급여반영) 년월
$sql_w_date = " select * from pibohum_base_pay where com_code='$com_code' and year = '$search_year' and month = '$search_month' ";
$result_w_date = sql_query($sql_w_date);
$row_w_date=mysql_fetch_array($result_w_date);
//echo $sql_w_date;
if($row_w_date[w_date] != "0000-00-00") {
	$w_date = $row_w_date[w_date];
	$w_date_ok = "1";
} else {
	$w_date = "<span style='color:red'>임시저장</span>";
	$w_date_ok = "";
}
if($row_w_date[w_date] == "") {
	$w_date = "<span style='color:red'>미등록</span>";
	$w_date_ok = "";
}
//사업장정보 옵션 DB
$sql_com_opt = " select * from com_list_gy_opt where com_code='$com_code' ";
$result_com_opt = sql_query($sql_com_opt);
$row_com_opt=mysql_fetch_array($result_com_opt);
//사업장 타입
$comp_print_type = $row_com_opt[comp_print_type];
//급여지급일
if($row_com_opt[pay_day]) {
	if($search_month == 12) {
		$pay_date = "1월 ".$row_com_opt[pay_day]."일";
	} else {
		$pay_date = ($search_month+1)."월 ".$row_com_opt[pay_day]."일";
	}
	//급여지급일 당월 체크 유무
	if($row_com_opt[pay_day_now_month] == 1) {
		$pay_date = $search_month."월 ".$row_com_opt[pay_day]."일";
	}
} else {
	$pay_date = "급여지급일 미지정";
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<?
include "inc/top.php";
?>
					<td onmouseover="showM('900')">
						<div style="margin:10px 20px 20px 20px;min-height:480px;">
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td width="100"><img src="images/top06.gif" border="0"></td>
									<td width="129"><a href="pay_list.php"><img src="images/menu06_top01_on.gif" border="0"></a></td>
									<td width="129"><a href="pay_list.php"><img src="images/menu06_top02_off.gif" border="0"></a></td>
									<td width="129"><a href="pay_list.php"><img src="images/menu06_top03_off.gif" border="0"></a></td>
									<td width="129"><a href="pay_list.php"><img src="images/menu06_top04_off.gif" border="0"></a></td>
									<td width="129"><a href="pay_list.php"><img src="images/menu06_top05_off.gif" border="0"></a></td>
									<td></td>
								</tr>
								<tr><td height="1" bgcolor="#cccccc" colspan="7"></td></tr>
							</table>

							<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
								<tr>
									<td valign="top" style="padding:10px 0 0 0">
										<!--타이틀 -->	
<?
include "pay_list_default.php";
?>
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
<? include "./inc/bottom.php";?>
</body>
</html>
