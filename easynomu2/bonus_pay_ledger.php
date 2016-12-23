<?
$sub_menu = "500300";
include_once("./_common.php");
//현재 년도
$year_now = date("Y");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}
//사업장정보
$sql_com = " select * from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
//echo $sql_com;
$row_com = sql_fetch($sql_com);
$com_code = $row_com[com_code];

$sub_title = "상여금지급대장(지급시기)";
$g4[title] = $sub_title." : 노무관리 : ".$easynomu_name;
//년도, 월 설정
if(!$search_year) $search_year = date("Y");
if(!$search_month) $search_month = date("m");
//지급시기
if(!$stx_bonus_time) $stx_bonus_time = 1;
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
function back_url() {
	location.href = "bonus.php?page=<?=$page?>&stx_bonus_time=<?=$stx_bonus_time?>";
}
</script>
<? include "./inc/top.php"; ?>

<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="<?=$content_width?>" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="270">
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td><img src="images/subname05.gif" /></td>
								</tr>
								<tr>
									<td><a href="retirement.php" onmouseover="limg1.src='images/menu05_sub01_on.gif'" onmouseout="limg1.src='images/menu05_sub01_off.gif'"><img src="images/menu05_sub01_off.gif" name="limg1" id="limg1" /></a></td>
								</tr>
								<tr>
									<td><a href="annual_paid_holiday.php" onmouseover="limg2.src='images/menu05_sub02_on.gif'" onmouseout="limg2.src='images/menu05_sub02_off.gif'"><img src="images/menu05_sub02_off.gif" name="limg2" id="limg2" /></a></td>
								</tr>
								<tr>
									<td><a href="bonus.php" onmouseover="limg3.src='images/menu05_sub03_on.gif'" onmouseout="limg3.src='images/menu05_sub03_off.gif'"><img src="images/menu05_sub03_off.gif" name="limg3" id="limg3" /></a></td>
								</tr>
							</table>
<?
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


<script type="text/javascript">
//<![CDATA[
var mbrclick= false;
var rooturl = '<?=$rooturl?>';
var rootssl = '<?=$rootssl?>';
var raccount= 'home';
var moduleid= 'home';
var memberid= 'master';
var is_admin= '0';
var needlog = '로그인후에 이용하실 수 있습니다. ';
var neednum = '숫자만 입력해 주세요.';
var myagent	= navigator.appName.indexOf('Explorer') != -1 ? 'ie' : 'ns';
//]]>
</script>
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<?
//지급시기
$sql_a4_opt = " select * from com_list_gy_opt where com_code = '$com_code' ";
$row_a4_opt = sql_fetch($sql_a4_opt);
$bonus_time_array = explode(",",$row_a4_opt[bonus_time]);
$bonus_no = $stx_bonus_time-1;
$bonus_time = $bonus_time_array[$bonus_no];
$bonus_time_cnt = 0;
for($i=0;$i<6;$i++) {
	if($bonus_time_array[$i] != "") {
		$bonus_time_cnt++;
	}
}
$comp_type = $row_com[class_gubun];
if($comp_type != "D") $comp_type = "A";
?>
<div id="rcontent" class="center m_side">
	<form name="HwpControl" id="HwpControl" method="post">
		<table border="0">
			<tr>
				<td>
					<div style="padding:2px">
						<input type="button" name="history_back_bt" value="이전으로" onclick="back_url()" /> 
					</div>
				</td>
				<td>
					<div id="search_year" style="float:left;margin:0 10px 0 0">
						<select name="search_year" class="selectfm" onchange='this.form.submit();'>
<?
for($i=2013;$i<=$year_now;$i++) {
?>
							<option value="<?=$i?>" <? if($i == $search_year) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
						</select> 년
					</div>
					<div style="padding:0 0 0 0;">
						※ 지급시기 : 
						<select name="stx_bonus_time" class="selectfm" onchange='this.form.submit();'>
<?
for($i=0;$i<$bonus_time_cnt;$i++) {
$k = $i + 1;
?>
							<option value="<?=$k?>" <? if($stx_bonus_time == $k) echo "selected"; ?> ><?=$bonus_time_array[$i]?></option>
<?
}
?>
						</select>
					</div>
				</td>
			</tr>
		</table>

		<input type="hidden" name="labor" value="bonus_pay_ledger_time" />
		<input type="hidden" name="pay_gbn" value="<?=$pay_gbn?>" />
		<input type="hidden" name="mb_name" value="<?=$row_com[com_name]?>" />
		<input type="hidden" name="work_form" value="1" />
<?
//청양지피엠
if($com_code == "20247") {
	$approval1 = "담당";
	$approval2 = "부장";
	$approval3 = "사장";
} else {
	$approval1 = "부장";
	$approval2 = "이사";
	$approval3 = "대표";
}
?>
		<input type="hidden" name="approval1" value="<?=$approval1?>" title="결재1"/>
		<input type="hidden" name="approval2" value="<?=$approval2?>" title="결재2"/>
		<input type="hidden" name="approval3" value="<?=$approval3?>" title="결재3"/>

		<input type="hidden" name="comp_type" value="<?=$comp_type?>" title="사업장유형"/>
		<input type="hidden" name="comp_num" value="<?=$row_com[biz_no]?> " title="사업자등록번호" />
		<input type="hidden" name="comp_name" value="<?=$row_com[com_name]?>" title="사업장명" />
		<input type="hidden" name="comp_ceo" value="<?=$row_com[boss_name]?> " title="대표자명" />
		<input type="hidden" name="comp_jumin" value="<?=$row_com[jumin_no]?> " title="대표자주민번호" />
		<input type="hidden" name="comp_upte" value="<?=$row_com[uptae]?> " title="업태" />
		<input type="hidden" name="comp_jongmok" value="<?=$row_com[upjong]?> " title="종목" />
		<input type="hidden" name="comp_tel" value="<?=$row_com[com_tel]?> " title="사업장전화" />
		<input type="hidden" name="comp_fax" value="<?=$row_com[com_fax]?> " title="사업장팩스" />
		<input type="hidden" name="comp_cel" value="<?=$row_com[boss_hp]?> " title="대표자핸드폰" />
		<input type="hidden" name="comp_email" value="<?=$row_a4_opt[boss_mail]?> " title="대표자email" />
		<input type="hidden" name="comp_addr1" value="<?=$row_com[com_juso]?>" title="사업장주소1" />
		<input type="hidden" name="comp_addr2" value="<?=$row_com[com_juso2]?> " title="사업장주소2" />
		<input type="hidden" name="today" value="<?=date("Y년 m월 d일")?>" title="오늘날짜"/>
		<input type="hidden" name="yy" value="<?=$search_year?>" title="년도"/>
		<input type="hidden" name="ceo_jik" value="대표이사"/>

		<!-- 상여금지급대장(지급시기) -->
		<input type="hidden" name="bonus_time" value="<?=$bonus_time?>" />

		<!-- 한글 컨트롤 폼 -->
		<p style="margin-top:20px;z-index:-1;border:1px solid #ccc;width:">
			<object id="HwpCtrl" width="100%" height="650" align="center" classid="CLSID:BD9C32DE-3155-4691-8972-097D53B10052"></object>
		</p>
	</form>
	<script src="./js/bonus_pay_ledger.js" type="text/javascript" charset="euc-kr"></script>
</div>
<script type="text/javascript">
document.getElementById('HwpCtrl').style.height = "674px";
function setRowInsert() {
<?
$sql_common = " from $g4[pibohum_base] a, pibohum_base_opt b, pibohum_base_opt2 c ";
$sql_a4 = " select com_code from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4[com_code];
$sql_search = " where a.com_code='$com_code' ";
//옵션DB join
$sql_search .= " and ( ";
$sql_search .= " (a.com_code = b.com_code and a.sabun = b.sabun and a.com_code = c.com_code and a.sabun = c.sabun) ";
$sql_search .= " ) ";
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
if($sort1) {
	if($sort1 == "in_day" || $sort1 == "name") $sst = "a.".$sort1;
	else $sst = "b.".$sort1;
	$sod = $sod1;
} else {
	$sst = "b.position";
	$sod = "asc";
}
if($sort2) {
	if($sort2 == "in_day" || $sort2 == "name") $sst2 = ", a.".$sort2;
	else $sst2 = ", b.".$sort2;
	$sod2 = $sod2;
} else {
	$sst2 = ", a.in_day";
	$sod2 = "asc";
}
if($sort3) {
	if($sort3 == "in_day" || $sort3 == "name") $sst3 = ", a.".$sort3;
	else $sst3 = ", b.".$sort3;
	$sod3 = $sod3;
} else {
	$sst3 = ", b.dept";
	$sod3 = "asc";
}
$sql_order = " order by $sst $sod $sst2 $sod2 $sst3 $sod3 ";
$sql = " select count(*) as cnt $sql_common $sql_search $sql_order ";
$row = sql_fetch($sql);
$total_count = $row[cnt];
$rows = 15;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if (!$page) $page = 1;
$from_record = ($page - 1) * $rows;
$sql = " select * $sql_common $sql_search $sql_order limit $from_record, $rows ";
$result = sql_query($sql);
//지급시기
$sql_a4_opt = " select * from com_list_gy_opt where com_code = '$com_code' ";
$row_a4_opt = sql_fetch($sql_a4_opt);
$bonus_time = explode(",",$row_a4_opt[bonus_time]);	
$bonus_time_cnt = 0;
for($i=0;$i<6;$i++) {
	if($bonus_time[$i] == "") {
		$bonus_time[$i] = "-";
	} else {
		$bonus_time_cnt++;
	}
}
$j = 1;
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//$page
	//$total_page
	//$rows
	$no = $j;
	$list = $i%2;
	//idx
	$idx = $row[idx];
	//사업장 코드 / 사번 / 코드_사번
	$code = $row[com_code];
	$id = $row[sabun];
	$code_id = $code."_".$id;
	// 사업장명 : 사업장코드
	$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$row[com_code]' ";
	$row_com = sql_fetch($sql_com);
	$com_name = $row_com[com_name];
	$com_name = cut_str($com_name, 21, "..");
	//사원DB
	$sql_base = " select * from pibohum_base where com_code='$code' and sabun='$id' ";
	$result_base = sql_query($sql_base);
	$row_base = mysql_fetch_array($result_base);
	$name = cut_str($row_base[name], 8, "..");
	//입사일, 퇴직일
	$in_day = $row_base[in_day];
	$out_day = $row_base[out_day];
	//사원DB 옵션
	$sql2 = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
	$result2 = sql_query($sql2);
	$row2 = mysql_fetch_array($result2);
	//직위
	if($row2[position]) {
		$sql_position = " select * from com_code_list where item='position' and code=$row2[position] ";
		//echo $sql_position;
		$result_position = sql_query($sql_position);
		$row_position = sql_fetch_array($result_position);
		$position = $row_position[name];
	}
	//채용형태
	if($row_base[work_form] == 1) $work_form = "정규직";
	else if($row_base[work_form] == 2) $work_form = "계약직";
	else if($row_base[work_form] == 3) $work_form = "일용직";
	else $work_form = "";
	//상여금기준 (산정기준, 상여비율)
	$sql_opt2 = " select * from pibohum_base_opt2 where com_code='$code' and sabun='$id' ";
	$result_opt2 = sql_query($sql_opt2);
	$row_opt2 = mysql_fetch_array($result_opt2);
	if($row_opt2[bonus_standard] == "1") {
		$bonus_standard = "기본급";
		$bonus_standard_pay = $row_opt2[money_hour_ms];
	} else if($row_opt2[bonus_standard] == "2") {
		$bonus_standard = "결정임금";
		$bonus_standard_pay = $row_opt2[money_month_base];
	} else if($row_opt2[bonus_standard] == "3") {
		$bonus_standard = "통상임금";
		$bonus_standard_pay = $row_opt2[money_month_base];
	} else if($row_opt2[bonus_standard] == "4") {
		$bonus_standard = "총급여";
		$bonus_standard_pay = $row_opt2[money_month_base];
	}
	//상여금 수동입력
	$check_bonus_money_yn = $row_opt2[check_bonus_money_yn];
	$bonus_money = $row_opt2[bonus_money];
	if($check_bonus_money_yn == "Y") {
		$bonus_standard = "회사내규";
		$bonus_standard_pay = $bonus_money;
	}
	$bonus_percent = $row_opt2[bonus_percent];
	if($bonus_percent != "0") {
		$bonus_standard_percent = $bonus_standard."<br>".$bonus_percent."%";
		//상여금 수정 링크
		$bonus_url = "bonus_view.php?w=u&id=".$id."&page=".$page."&stx_bonus_time=".$stx_bonus_time;
	} else {
		$bonus_standard_percent = "-";
	}
	$bonus_p_array = explode(",",$row_opt2[bonus_p]);
	//지급일자, 지급액, 메모
	for($m=0;$m<6;$m++) {
		$k = $m + 1;
		$sql_bonus = " select * from pibohum_base_bonus where com_code='$code' and sabun='$id' and bonus_time='$m' and bonus_year='$search_year' ";
		$result_bonus = sql_query($sql_bonus);
		$row_bonus = mysql_fetch_array($result_bonus);
		$bonus_day[$m] = $row_bonus[bonus_day];
		if($bonus_p_array[$m]) {
			$bonus_p[$m] = $bonus_p_array[$m]."%";
		} else {
			$bonus_p[$m] = "";
		}
		if($bonus_day[$m]) {
			$bonus_pay[$m] = $row_bonus[pay];
			$tax_so[$m] = $row_bonus[tax_so];
			$tax_ju[$m] = $row_bonus[tax_ju];
			$minus[$m] = $row_bonus[minus];
			//실지급액
			$bonus_pay_num[$m] = preg_replace('@,@', '', $bonus_pay[$m]);
			$tax_so_num[$m] = preg_replace('@,@', '', $tax_so[$m]);
			$tax_ju_num[$m] = preg_replace('@,@', '', $tax_ju[$m]);
			$minus_num[$m] = preg_replace('@,@', '', $minus[$m]);
			$bonus_result[$m] = $bonus_pay_num[$m] - ($tax_so_num[$m] + $tax_ju_num[$m] + $minus_num[$m]);
		} else {
			$bonus_pay[$m] = "";
			$tax_so[$m] = "";
			$tax_ju[$m] = "";
			$minus[$m] = "";
			$bonus_pay_num[$m] = "";
			$tax_so_num[$m] = "";
			$tax_ju_num[$m] = "";
			$minus_num[$m] = "";
			$bonus_result[$m] = "";
		}
	}
	if($bonus_percent) {
		//포밍 160727
		//if($code == 20602) {
?>
	//한글 콘트롤러 버전 체크 / 날짜 형식 다음의 항목 붙는 문제 160727
	if(pHwpCtrl.Version > 117440513) {
		TableAppendRowContents("tbl_s", new Array("<?=$no?>","<?=$name?>","<?=$position?>","<?=$bonus_standard?>","<?=number_format($bonus_standard_pay)?>","<?=$bonus_percent?>","<?=$bonus_p[$bonus_no]?>","<?=$bonus_day[$stx_bonus_time]?>"," ","<?=$bonus_pay[$stx_bonus_time]?>","<?=$tax_so[$stx_bonus_time]?>","<?=$tax_ju[$stx_bonus_time]?>","<?=$minus[$stx_bonus_time]?>","<?=number_format($bonus_result[$stx_bonus_time])?>"));
	} else {
		TableAppendRowContents("tbl_s", new Array("<?=$no?>","<?=$name?>","<?=$position?>","<?=$bonus_standard?>","<?=number_format($bonus_standard_pay)?>","<?=$bonus_percent?>","<?=$bonus_p[$bonus_no]?>","<?=$bonus_day[$stx_bonus_time]?>","<?=$bonus_pay[$stx_bonus_time]?>","<?=$tax_so[$stx_bonus_time]?>","<?=$tax_ju[$stx_bonus_time]?>","<?=$minus[$stx_bonus_time]?>","<?=number_format($bonus_result[$stx_bonus_time])?>"));
	}
<?
		//}
		$j++;
	}
}
?>
	pHwpCtrl.MoveToField("tbl_s", false, false, false);
	pHwpCtrl.Run("TableDeleteRow");
	pHwpCtrl.MovePos(20);
}
</script>
<?//=$sql?>

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
