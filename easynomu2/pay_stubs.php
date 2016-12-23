<?
$sub_menu = "400100";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}
//현재 년도
$year_now = date("Y");

$sql_common = " from $g4[pibohum_base] ";

$sql_a4 = " select * from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4[com_code];

$sql_a4_opt = " select * from com_list_gy_opt where com_code = '$com_code' ";
$row_a4_opt = sql_fetch($sql_a4_opt);

$sub_title = "급여명세서";
$g4[title] = $sub_title." : 서식출력 : ".$easynomu_name;

$colspan = 11;

$sql1 = " select * from $g4[pibohum_base] where com_code='$code' and sabun='$id' ";
//echo $sql1;
$result1 = sql_query($sql1);
$row1=mysql_fetch_array($result1);

$sql2 = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
$result2 = sql_query($sql2);
$row2=mysql_fetch_array($result2);

$sql_pay = " select * from pibohum_base_pay where com_code='$code' and sabun='$id' and year = '$search_year' and month = '$search_month' order by w_date desc, w_time desc limit 0, 1 ";
//echo $sql_pay;
$result_pay = sql_query($sql_pay);
$row_pay=mysql_fetch_array($result_pay);

//입사일
$in_day_array = explode(".",$row1[in_day]);
$in_day = $in_day_array[0]."년 ".$in_day_array[1]."월 ".$in_day_array[2]."일";

//채용형태
if($row1[work_form] == "") $work_form = "";
else if($row1[work_form] == "1") $work_form = "정규직";
else if($row1[work_form] == "2") $work_form = "계약직";
else if($row1[work_form] == "3") $work_form = "일용직";

//직위
$sql_position = " select * from com_code_list where com_code='$code' and code='$row2[position]' and item='position' ";
$result_position = sql_query($sql_position);
$row_position=mysql_fetch_array($result_position);
//echo $row_position[name];

//호봉
$sql_step = " select * from com_code_list where com_code='$code' and code='$row2[step]' and item='step' ";
$result_step = sql_query($sql_step);
$row_step=mysql_fetch_array($result_step);

//년도, 월 설정
if(!$search_year) $search_year = date("Y");
if(!$search_month) $search_month = date("m");
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
function back_url() {
	//location.href = "pay_list.php?search_year=<?=$search_year?>&search_month=<?=$search_month?>";
	history.back();
}
</script>
<? include "./inc/top.php"; ?>

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

<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="1200" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="270">
<?
if($comp_print_type == "N") {
	include "./inc/left_menu4_type_n.php";
} else if($comp_print_type == "P") {
	include "./inc/left_menu4_type_p.php";
} else {
	//(주)노아텍
	if($com_code == 20623) include "./inc/left_menu4_noa.php";
	else include "./inc/left_menu4.php";
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

							<div id="rcontent" class="center m_side">
									<form name = "HwpControl" id="HwpControl" method="post" action="<?=$PHP_SELF?>">
									<input type="hidden" name="id" value="<?=$id?>" />
									<input type="hidden" name="code" value="<?=$code?>" />
									<table border="0">
										<tr>
											<td>
												<div style="padding:2px">
													<input type="button" name="history_back_bt" value="이전으로" onclick="back_url()" /> 
												</div>
											</td>
											<td>
												<div id="year_month">
													<select name="search_year">
<?
for($i=2011;$i<=$year_now;$i++) {
?>
												<option value="<?=$i?>" <? if($i == $search_year) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
													</select>년
													<select name="search_month">
<?
for($i=1;$i<13;$i++) {
?>
														<option value="<?=$i?>" <? if($i == $search_month) echo "selected"; ?> ><?=$i?></option>
<?
}
//통상임금
$sql_g = " select * from com_paycode_list where com_code = '$com_code' and item='trade' ";
//echo $sql_g;
$result_g = sql_query($sql_g);
for($i=0; $row_g=sql_fetch_array($result_g); $i++) {
	$g_code = $row_g[code];
	$money_g_txt[$g_code] = $row_g[name];
	//echo $g_code;
}
//기타수당
$sql_e = " select * from com_paycode_list where com_code = '$com_code' and item='privilege' ";
$result_e = sql_query($sql_e);
for($i=0; $row_e=sql_fetch_array($result_e); $i++) {
	$e_code = $row_e[code];
	$money_e_txt[$e_code] = $row_e[name];
}
//사업장유형
$comp_type = $row_a4_opt[comp_print_type];
if(!$comp_type) $comp_type = "A";
?>


													</select>월
													<input type="submit" value="조회" class="btnblue" />
												</div>
											</td>
											<td>성명 : <?=$row1[name]?> / 주민등록번호 : <?=$row1[jumin_no]?> / 입사일 : <?=$in_day?> / 채용형태 : <?=$work_form?></td>
										</tr>
									</table>

									<!-- 급여명세서 -->
									<input type="hidden" name="comp_type" value="<?=$comp_type?>" title="사업장유형"/>
									<input type="hidden" name="company" value="<?=$row_a4[com_name]?>"/>
									<input type="hidden" name="pay_year" value="<?=$search_year?>"/>
									<input type="hidden" name="pay_month" value="<?=$search_month?>"/>
									<input type="hidden" name="pay_name" value="<?=$row1[name]?>"/>
									<input type="hidden" name="jik" value="<?=$row_position[name]?>"/>
									<input type="hidden" name="jdate" value="<?=$in_day?>"/>

									<input type="hidden" name="money_time" value="<?=number_format($row_pay[money_time])?>" title="통상시급" />
									<input type="hidden" name="money_min_base" value="<?=number_format($row_pay['money_min_base'])?>" title="기본시급" />
									<input type="hidden" name="basic_pay" value="<?=number_format($row_pay[money_month])?>" title="기본급여" />
<?
//대성하이테크 가불, 근태공제 금여총액에서 제외 : 제외처리 해제 150311
if($comp_type == "D") {
?>
									<input type="hidden" name="money_total" value="<?=number_format($row_pay[money_total])?>" title="급여총액" />
									<input type="hidden" name="minus" value="<?=number_format($row_pay[money_gongje])?>" title="공제합계" />
<?
} else {
?>
									<input type="hidden" name="money_total" value="<?=number_format($row_pay[money_total])?>" title="급여총액" />
									<input type="hidden" name="minus" value="<?=number_format($row_pay[money_gongje])?>" title="공제합계" />
<?
}
?>
									<input type="hidden" name="rtotal" value="<?=number_format($row_pay[money_result])?>" title="지급총액" />

									<input type="hidden" name="yun" value="<?=number_format($row_pay[yun])?>"/>
									<input type="hidden" name="goyong" value="<?=number_format($row_pay[goyong])?>"/>
									<input type="hidden" name="health" value="<?=number_format($row_pay[health])?>"/>
									<input type="hidden" name="hi2" value="<?=number_format($row_pay[yoyang])?>"/>
									<input type="hidden" name="tax_so" value="<?=number_format($row_pay[tax_so])?>"/>
									<input type="hidden" name="tax_jumin" value="<?=number_format($row_pay[tax_jumin])?>"/>

<?
if($comp_type == "E" || $comp_type == "F") {
?>
									<input type="hidden" name="b1_text" value="기본연장"/>
									<input type="hidden" name="b2_text" value="기본야간"/>
									<input type="hidden" name="b3_text" value="기본휴일"/>
									<input type="hidden" name="b4_text" value="연차수당"/>
									<input type="hidden" name="minus1_text" value="기타공제"/>
									<input type="hidden" name="minus2_text" value="-"/>
									<input type="hidden" name="minus3_text" value="-"/>
									<input type="hidden" name="minus4_text" value="-"/>
									<input type="hidden" name="minus5_text" value="-"/>
									<input type="hidden" name="minus6_text" value="-"/>
									<input type="hidden" name="minus1" value="<?=number_format($row_pay[minus])?>"/>
									<input type="hidden" name="minus2" value="-"/>
									<input type="hidden" name="minus3" value="-"/>
									<input type="hidden" name="minus4" value="-"/>
									<input type="hidden" name="minus5" value="-"/>
									<input type="hidden" name="minus6" value="-"/>
<?
} else if($comp_type == "I") {
?>
									<input type="hidden" name="b1_text" value="기본연장"/>
									<input type="hidden" name="b2_text" value="기본야간"/>
									<input type="hidden" name="b3_text" value="기본휴일"/>
									<input type="hidden" name="b4_text" value="연차수당"/>
									<input type="hidden" name="minus1_text" value="기타공제"/>
									<input type="hidden" name="minus2_text" value="기타공제2"/>
									<input type="hidden" name="minus3_text" value="-"/>
									<input type="hidden" name="minus4_text" value="-"/>
									<input type="hidden" name="minus5_text" value="-"/>
									<input type="hidden" name="minus6_text" value="-"/>
									<input type="hidden" name="minus1" value="<?=number_format($row_pay[minus])?>"/>
									<input type="hidden" name="minus2" value="<?=number_format($row_pay[minus2])?>"/>
									<input type="hidden" name="minus3" value="-"/>
									<input type="hidden" name="minus4" value="-"/>
									<input type="hidden" name="minus5" value="-"/>
									<input type="hidden" name="minus6" value="-"/>
<?
} else if($comp_type == "G") {
?>
									<input type="hidden" name="b1_text" value="잔업수당"/>
									<input type="hidden" name="b2_text" value="주차수당"/>
									<input type="hidden" name="b3_text" value="휴일수당"/>
									<input type="hidden" name="b4_text" value="특근수당"/>
									<input type="hidden" name="minus1_text" value="근태공제"/>
									<input type="hidden" name="minus2_text" value="가불"/>
									<input type="hidden" name="minus3_text" value="-"/>
									<input type="hidden" name="minus4_text" value="-"/>
									<input type="hidden" name="minus5_text" value="-"/>
									<input type="hidden" name="minus6_text" value="-"/>
									<input type="hidden" name="minus1" value="0"/>
									<input type="hidden" name="minus2" value="0"/>
									<input type="hidden" name="minus3" value="-"/>
									<input type="hidden" name="minus4" value="-"/>
									<input type="hidden" name="minus5" value="-"/>
									<input type="hidden" name="minus6" value="-"/>
<?
} else if($comp_type == "J") {
?>
									<input type="hidden" name="b1_text" value="기본연장"/>
									<input type="hidden" name="b2_text" value="기본야간"/>
									<input type="hidden" name="b3_text" value="기본휴일"/>
									<input type="hidden" name="b4_text" value="연차수당"/>
									<input type="hidden" name="minus1_text" value="기타"/>
									<input type="hidden" name="minus2_text" value="근태공제"/>
									<input type="hidden" name="minus3_text" value="-"/>
									<input type="hidden" name="minus4_text" value="-"/>
									<input type="hidden" name="minus5_text" value="-"/>
									<input type="hidden" name="minus6_text" value="-"/>
									<input type="hidden" name="minus1" value="<?=number_format($row_pay[minus])?>"/>
									<input type="hidden" name="minus2" value="<?=number_format($row_pay[etc2])?>"/>
									<input type="hidden" name="minus3" value="-"/>
									<input type="hidden" name="minus4" value="-"/>
									<input type="hidden" name="minus5" value="-"/>
									<input type="hidden" name="minus6" value="-"/>
<?
} else if($comp_type == "D") {
?>
									<input type="hidden" name="b1_text" value="기본연장"/>
									<input type="hidden" name="b2_text" value="기본야간"/>
									<input type="hidden" name="b3_text" value="기본휴일"/>
									<input type="hidden" name="b4_text" value="연차수당"/>
									<input type="hidden" name="minus1_text" value="기타공제"/>
									<input type="hidden" name="minus2_text" value="가불"/>
									<input type="hidden" name="minus3_text" value="-"/>
									<input type="hidden" name="minus4_text" value="-"/>
									<input type="hidden" name="minus5_text" value="-"/>
									<input type="hidden" name="minus6_text" value="-"/>
									<input type="hidden" name="minus1" value="<?=number_format($row_pay[minus])?>"/>
									<input type="hidden" name="minus2" value="<?=number_format($row_pay[etc])?>"/>
									<input type="hidden" name="minus3" value="-"/>
									<input type="hidden" name="minus4" value="-"/>
									<input type="hidden" name="minus5" value="-"/>
									<input type="hidden" name="minus6" value="-"/>
<?
//기본
} else {
	//씨앤에스
	if($row_a4['biz_no'] == "410-86-38857" || $row_a4['biz_no'] == "321-87-00290") $minus4_text="상조회비";
	else {
		//매년 2월 연말정산 환급분으로 교체 160225
		if($search_month == 2) $minus4_text="연말정산";
		else $minus4_text="기타공제";
	}
	//포밍
	if($comp_type == "P") {
		$minus5_text="건강정산";
		$minus6_text="요양정산";
		$minus5 = number_format($row_pay['c_health']);
		$minus6 = number_format($row_pay['c_yoyang']);
	} else {
		$minus5_text = "-";
		$minus6_text = "-";
		$minus5 = "-";
		$minus6 = "-";
	}
?>
									<input type="hidden" name="b1_text" value="기본연장"/>
									<input type="hidden" name="b2_text" value="기본야간"/>
									<input type="hidden" name="b3_text" value="기본휴일"/>
									<input type="hidden" name="b4_text" value="연차수당"/>
									<input type="hidden" name="minus1_text" value="가불"/>
									<input type="hidden" name="minus2_text" value="근태공제"/>
									<input type="hidden" name="minus3_text" value="-"/>
									<input type="hidden" name="minus4_text" value="<?=$minus4_text?>"/>
									<input type="hidden" name="minus5_text" value="<?=$minus5_text?>"/>
									<input type="hidden" name="minus6_text" value="<?=$minus6_text?>"/>
									<input type="hidden" name="minus1" value="<?=number_format($row_pay[etc])?>"/>
									<input type="hidden" name="minus2" value="<?=number_format($row_pay[etc2])?>"/>
									<input type="hidden" name="minus3" value="-"/>
									<input type="hidden" name="minus4" value="<?=number_format($row_pay[minus])?>"/>
									<input type="hidden" name="minus5" value="<?=$minus5?>"/>
									<input type="hidden" name="minus6" value="<?=$minus6?>"/>
<?
}
?>
									<input type="hidden" name="g1_text" value="<?=$money_g_txt['g1']?>"/>
									<input type="hidden" name="g2_text" value="<?=$money_g_txt['g2']?>"/>
									<input type="hidden" name="g3_text" value="<?=$money_g_txt['g3']?>"/>
									<input type="hidden" name="g4_text" value="<?=$money_g_txt['g4']?>"/>
									<input type="hidden" name="g5_text" value="<?=$money_g_txt['g5']?>"/>
									<input type="hidden" name="g6_text" value="-"/>
									<input type="hidden" name="g7_text" value="-"/>

									<input type="hidden" name="g1" value="<?=number_format($row_pay[g1])?>"/>
									<input type="hidden" name="g2" value="<?=number_format($row_pay[g2])?>"/>
									<input type="hidden" name="g3" value="<?=number_format($row_pay[g3])?>"/>
									<input type="hidden" name="g4" value="<?=number_format($row_pay[g4])?>"/>
									<input type="hidden" name="g5" value="<?=number_format($row_pay[g5])?>"/>
									<input type="hidden" name="g6" value="-"/>
									<input type="hidden" name="g7" value="-"/>
									<input type="hidden" name="g_sum" value="<?=number_format($row_pay[g1]+$row_pay[g2]+$row_pay[g3]+$row_pay[g4]+$row_pay[g5])?>"/>

									<input type="hidden" name="b1" value="<?=number_format($row_pay[ext])?>"/>
									<input type="hidden" name="b2" value="<?=number_format($row_pay[night])?>"/>
									<input type="hidden" name="b3" value="<?=number_format($row_pay[hday])?>"/>
									<input type="hidden" name="b4" value="<?=number_format($row_pay[ext_add])?>"/>
									<input type="hidden" name="b5" value="<?=number_format($row_pay[night_add])?>"/>
									<input type="hidden" name="b6" value="<?=number_format($row_pay[hday_add])?>"/>
									<input type="hidden" name="b7" value="<?=number_format($row_pay[annual_paid_holiday])?>"/>
									<input type="hidden" name="b_sum" value="<?=number_format($row_pay[ext]+$row_pay[night]+$row_pay[hday]+$row_pay[ext_add]+$row_pay[night_add]+$row_pay[hday_add]+$row_pay[annual_paid_holiday])?>"/>

									<input type="hidden" name="e1_text" value="<?=$money_e_txt['e1']?>"/>
									<input type="hidden" name="e2_text" value="<?=$money_e_txt['e2']?>"/>
									<input type="hidden" name="e3_text" value="<?=$money_e_txt['e3']?>"/>
									<input type="hidden" name="e4_text" value="<?=$money_e_txt['e4']?>"/>
									<input type="hidden" name="e5_text" value="<?=$money_e_txt['e5']?>"/>
									<input type="hidden" name="e6_text" value="<?=$money_e_txt['e6']?>"/>
									<input type="hidden" name="e7_text" value="<?=$money_e_txt['e7']?>"/>
									<input type="hidden" name="e8_text" value="<?=$money_e_txt['e8']?>"/>

									<input type="hidden" name="e1" value="<?=number_format($row_pay[b1])?>"/>
									<input type="hidden" name="e2" value="<?=number_format($row_pay[b2])?>"/>
									<input type="hidden" name="e3" value="<?=number_format($row_pay[b3])?>"/>
									<input type="hidden" name="e4" value="<?=number_format($row_pay[b4])?>"/>
									<input type="hidden" name="e5" value="<?=number_format($row_pay[b5])?>"/>
									<input type="hidden" name="e6" value="<?=number_format($row_pay[b6])?>"/>
									<input type="hidden" name="e7" value="<?=number_format($row_pay[b7])?>"/>
									<input type="hidden" name="e8" value="<?=number_format($row_pay[b8])?>"/>
<?
//기타수당(기타) 타입별 설정 대성하이테크. 대성산업기계
if($comp_type == "D") {
?>
									<input type="hidden" name="e9_text" value="근태공제"/>
									<input type="hidden" name="e10_text" value="-"/>
									<input type="hidden" name="e11_text" value="-"/>
									<input type="hidden" name="e9" value="<?=number_format($row_pay['etc2'])?>"/>
									<input type="hidden" name="e10" value="-"/>
									<input type="hidden" name="e11" value="-"/>
<?
//한성기모, 한성섬유
} else if($comp_type == "J") {
?>
									<input type="hidden" name="e9_text" value="가불"/>
									<input type="hidden" name="e10_text" value="-"/>
									<input type="hidden" name="e11_text" value="-"/>
									<input type="hidden" name="e9" value="<?=number_format($row_pay['etc'])?>"/>
									<input type="hidden" name="e10" value="-"/>
									<input type="hidden" name="e11" value="-"/>
<?
} else {
?>
									<input type="hidden" name="e9_text" value="-"/>
									<input type="hidden" name="e10_text" value="-"/>
									<input type="hidden" name="e11_text" value="-"/>
									<input type="hidden" name="e9" value="-"/>
									<input type="hidden" name="e10" value="-"/>
									<input type="hidden" name="e11" value="-"/>
<?
}
?>
									<input type="hidden" name="e_sum" value="<?=number_format($row_pay[b1]+$row_pay[b2]+$row_pay[b3]+$row_pay[b4]+$row_pay[b5]+$row_pay[b6]+$row_pay[b7]+$row_pay[b8])?>"/>

									<!-- 한글 컨트롤 폼 -->
									<p style="margin-top:20px;z-index:-1;border:1px solid #ccc;width:">
										<object id="HwpCtrl" width="100%" height="1292" align="center" classid="CLSID:BD9C32DE-3155-4691-8972-097D53B10052"></object>
									</p>
								</form>
							</div>

						</td>
					</tr>
				</table>
				<? include "./inc/bottom.php";?>
			</td>
		</tr>
	</table>			
</div>
<script src="./js/pay_stubs.js" type="text/javascript" charset="euc-kr"></script>
</body>
</html>
