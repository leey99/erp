<?
$sub_menu = "600200";
include_once("./_common.php");
//현재 년도
$year_now = date("Y");

$sql_common = " from $g4[pibohum_base] ";

if($mb_id == "") $mb_id = $member[mb_id];

$sql_a4 = " select * from $g4[com_list_gy] where t_insureno = '$mb_id' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4[com_code];

$sql_a4_opt = " select * from com_list_gy_opt where com_code = '$com_code' ";
$row_a4_opt = sql_fetch($sql_a4_opt);

//echo $is_admin;
if($is_admin == "super") {
	$sql_search = " where 1=1 ";
} else {
	$sql_search = " where com_code='$com_code' ";
}

//echo $stx_name;
// 검색 : 성명
if ($stx_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (name like '$stx_name%') ";
	$sql_search .= " ) ";
}
// 검색 : 사번
if ($stx_sabun) {
	$sql_search .= " and ( ";
	$sql_search .= " (sabun like '$stx_sabun%') ";
	$sql_search .= " ) ";
}

if (!$sst) {
	if($is_admin == "super") {
		$sst = "com_code";
	} else {
		$sst = "sabun";
	}
	$sod = "desc";
}

$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 15;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>처음</a>";

$sub_title = "노동부 자율점검서식";
$g4[title] = $sub_title." : 서식출력 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

$colspan = 11;

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
</script>
<? include "./inc/top.php"; ?>

<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="1200" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="270">
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td><img src="images/subname06.gif" /></td>
								</tr>
								<tr>
									<td><a href="form_labor.php"   onmouseover="limg2.src='images/menu06_sub02_on.gif'" onmouseout="limg2.src='images/menu06_sub02_off.gif'"><img src="images/menu06_sub02_off.gif" name="limg2" id="limg2" /></a></td>
								</tr>
								<tr>
									<td><a href="form_inspect.php" onmouseover="limg3.src='images/menu06_sub03_on.gif'" onmouseout="limg3.src='images/menu06_sub03_off.gif'"><img src="images/menu06_sub03_off.gif" name="limg3" id="limg3" /></a></td>
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
<script src="./js/hwpcontrol.js" type="text/javascript" charset="euc-kr"></script>
<div id="rcontent" class="center m_side">
	<form name = "HwpControl" id="HwpControl" method="post">
	<input type="hidden" name="labor" value="<?=$labor?>" />
	<input type="hidden" name="bohum" value="" />
<?
//권한별 링크값
if($member['mb_level'] == 6) {
	$url_pay_ledger = "return false;";
} else {
	$url_pay_ledger = "window.open('pay_ledger.php');return false;";
}
?>
	<div>
		<div style="margin:5px 0 10px 10px;background:url('./images/tab_labor_bg05.gif') no-repeat;width:136px;height:102px;float:left;">
			<div style="padding:46px 0 0 25px;"><a href="form_labor.php" onmouseover='getId("labor_bt1").src="./images/tab05_icon01_on.png";' onmouseout='getId("labor_bt1").src="./images/tab05_icon01_off.png";' onclick="toggleLayer('employeeList','labor1');goSubmit('labor1');return false;"><img src="./images/tab05_icon01_off.png" border="0" name="labor_bt1" id="labor_bt1"></a></div>
			<div style="padding:0 0 0 25px;"   ><a href="form_labor.php" onmouseover='getId("labor_bt2").src="./images/tab05_icon02_on.png";' onmouseout='getId("labor_bt2").src="./images/tab05_icon02_off.png";' onclick="goSubmit('rule1');return false;"><img src="./images/tab05_icon02_off.png" border="0" name="labor_bt2" id="labor_bt2"></a></div>
			<div style="padding:0 0 0 25px;"   ><img src="./images/space.png"></div>
		</div>
		<div style="margin:5px 0 10px 13px;background:url('./images/tab_labor_bg06.gif') no-repeat;width:323px;height:102px;float:left;">
			<div style="width:170px;height:102px;float:left;">
				<div style="padding:46px 0 0 25px;"><a href="form_labor.php" onmouseover='getId("labor_bt_2_1").src="./images/tab06_icon01_on.png";' onmouseout='getId("labor_bt_2_1").src="./images/tab06_icon01_off.png";' onclick="<?=$url_pay_ledger?>"><img src="./images/tab06_icon01_off.png" border="0" name="labor_bt_2_1" id="labor_bt_2_1"></a></div>
				<div style="padding:0 0 0 25px;"   ><a href="form_labor.php" onmouseover='getId("labor_bt_2_2").src="./images/tab06_icon02_on.png";' onmouseout='getId("labor_bt_2_2").src="./images/tab06_icon02_off.png";' onclick="toggleLayer('yearList','bonus_pay_ledger');goSubmit('bonus_pay_ledger');return false;"><img src="./images/tab06_icon02_off.png" border="0" name="labor_bt_2_2" id="labor_bt_2_2"></a></div>
				<div style="padding:0 0 0 25px;"   ><img src="./images/space.png"></div>
			</div>
			<div style="height:102px;float:left;">
				<div style="padding:43px 0 0 17px;"><a href="form_labor.php" onmouseover='getId("labor_bt_3_1").src="./images/tab06_icon03_on.png";' onmouseout='getId("labor_bt_3_1").src="./images/tab06_icon03_off.png";' onclick="toggleLayer('yearList','retirement_pay_ledger');goSubmit('retirement_pay_ledger');return false;"><img src="./images/tab06_icon03_off.png" border="0" name="labor_bt_3_1" id="labor_bt_3_1"></a></div>
				<div style="padding:0 0 0 17px;"   ><a href="form_labor.php" onmouseover='getId("labor_bt_3_2").src="./images/tab06_icon04_on.png";' onmouseout='getId("labor_bt_3_2").src="./images/tab06_icon04_off.png";' onclick="toggleLayer('yearList','annual_paid_holiday');goSubmit('annual_paid_holiday');return false;"><img src="./images/tab06_icon04_off.png" border="0" name="labor_bt_3_2" id="labor_bt_3_2"></a></div>
				<div style="padding:0 0 0 25px;"   ><img src="./images/space.png"></div>
			</div>
		</div>
		<div style="margin:5px 0 10px 13px;background:url('./images/tab_labor_bg07.gif') no-repeat;width:405px;height:102px;float:left;">
			<div style="width:190px;height:102px;float:left;">
				<div style="padding:46px 0 0 25px;"><a href="form_labor.php" onmouseover='getId("labor_bt_4_1").src="./images/tab07_icon01_on.png";' onmouseout='getId("labor_bt_4_1").src="./images/tab07_icon01_off.png";' onclick="toggleLayer('employeeList','worker_register_holder');goSubmit('worker_register_holder');return false;"><img src="./images/tab07_icon01_off.png" border="0" name="labor_bt_4_1" id="labor_bt_4_1"></a></div>
				<div style="padding:0 0 0 25px;"   ><a href="form_labor.php" onmouseover='getId("labor_bt_4_2").src="./images/tab07_icon02_on.png";' onmouseout='getId("labor_bt_4_2").src="./images/tab07_icon02_off.png";' onclick="toggleLayer('employeeList','worker_register_retiree');goSubmit('worker_register_retiree');return false;"><img src="./images/tab07_icon02_off.png" border="0" name="labor_bt_4_2" id="labor_bt_4_2"></a></div>
				<div style="padding:0 0 0 25px;"   ><img src="./images/space.png"></div>
			</div>
			<div style="height:102px;float:left;">
				<div style="padding:46px 0 0 17px;"><a href="form_labor.php" onmouseover='getId("labor_bt_5_1").src="./images/tab07_icon03_on.png";' onmouseout='getId("labor_bt_5_1").src="./images/tab07_icon03_off.png";' onclick="toggleLayer('employeeList','night_holiday_work_consent');goSubmit('night_holiday_work_consent');return false;"><img src="./images/tab07_icon03_off.png" border="0" name="labor_bt_5_1" id="labor_bt_5_1"></a></div>
				<div style="padding:0 0 0 25px;"   ><img src="./images/space.png"></div>
			</div>
		</div>
	</div>

	<div style="height:26px">
		<!-- 근로자리스트사항 -->
		<div id="employeeList" class="hide" style="margin-top:0;"> 근로자 선택 :
			<select name='employee' id='employee' class='select' onchange='this.form.submit();'>
			<!-- 근로자리스트사항 -->
			<?
			// 리스트 출력
			for ($i=0; $row=sql_fetch_array($result); $i++) {
				//$page
				//$total_page
				//$rows

				$no = $total_count - $i - ($rows*($page-1));
				$list = $i%2;
				// 사업장명 : 사업장코드
				$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$row[com_code]' ";
				$row_com = sql_fetch($sql_com);
				$com_name = $row_com[com_name];
				$com_name = cut_str($com_name, 21, "..");
				$name = cut_str($row[name], 6, "..");
				$idx = $row[com_code]."_".$row[sabun];
				if($employee) {
					$code_id_array = explode("_", $employee);
					$code = $code_id_array[0];
					$id = $code_id_array[1];
				}
			?>
				<option value="<?=$idx?>" <? if($id == $row[sabun]) echo "selected"; ?> ><?=$name?> (<?=$row[in_day]?>)</option>
			<?
			}
			if ($i == 0)
				echo "<option value=''>자료가 없습니다.</option>";
			?>
			</select>
		</div>
		<div id="search_year" style="float:left">
			<select name="search_year" class="" onchange='this.form.submit();'>
<?
for($i=2013;$i<=$year_now;$i++) {
?>
			<option value="<?=$i?>" <? if($i == $search_year) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
			</select> 년
		</div>
		<div id="search_month" style="float:left">
			<select name="search_month" class="" onchange='this.form.submit();'>
<?
for($i=1;$i<=12;$i++) {
?>
			<option value="<?=$i?>" <? if($i == $search_month) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
			</select> 월
		</div>
		<div id="employeeList_text" style="float:left">
<?
if($employee) {
	$sql1 = " select * from $g4[pibohum_base] where com_code='$code' and sabun='$id' ";
	//echo $sql1;
	$result1 = sql_query($sql1);
	$row1=mysql_fetch_array($result1);

	$sql2 = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
	$result2 = sql_query($sql2);
	$row2=mysql_fetch_array($result2);

	//입사일
	$in_day_array = explode(".",$row1[in_day]);
	$in_day = $in_day_array[0]."년 ".$in_day_array[1]."월 ".$in_day_array[2]."일";

	//채용형태
	if($row1[work_form] == "") $work_form = "";
	else if($row1[work_form] == "1") $work_form = "정규직";
	else if($row1[work_form] == "2") $work_form = "계약직";
	else if($row1[work_form] == "3") $work_form = "일용직";

	//직위
	$sql_position = " select * from com_code_list where code='$row2[position]' and item='position' ";
	$result_position = sql_query($sql_position);
	$row_position=mysql_fetch_array($result_position);
	//echo $row_position[name];

	//호봉
	$sql_step = " select * from com_code_list where code='$row2[step]' ";
	$result_step = sql_query($sql_step);
	$row_step=mysql_fetch_array($result_step);

	//급여 DB
	$sql_pay = " select * from pibohum_base_pay where com_code='$code' and sabun='$id' and year = '$search_year' and month = '$search_month' ";
	//echo $sql_pay;
	$result_pay = sql_query($sql_pay);
	$row_pay=mysql_fetch_array($result_pay);

	//기초급여정보 DB
	$sql3 = " select * from pibohum_base_opt2 where com_code='$code' and sabun='$id' ";
	//echo $sql3;
	$result3 = sql_query($sql3);
	$row3=mysql_fetch_array($result3);
?>
			성명 : <?=$row1[name]?> / 주민등록번호 : <?=$row1[jumin_no]?> / 입사일 : <?=$in_day?> / 채용형태 : <?=$work_form?>
<?
}
$pay_gbn = $row2[pay_gbn];
?>
			<input type="hidden" name="pay_gbn" value="<?=$pay_gbn?>" />
		</div>
		<!-- 해당년도 -->
		<div id="yearList" class="hide" style="margin-top:0;"> 연도 선택 :
			<select name="sYear" onchange='this.form.submit();'>
				<option value="">연도선택</option>
<?
for($i=2013;$i<=$year_now;$i++) {
?>
			<option value="<?=$i?>" <? if($i == $search_year) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
			</select>
		</div>
		<!-- 해당년월 -->
		<div id="monthList" class="hide" style="margin-top:0;">
			<select name="mm" onchange='this.form.submit();'>
				<option value="">월선택</option>
<?
for($i=1;$i<=12;$i++) {
?>
			<option value="<?=$i?>" <? if($i == $search_month) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
			</select>
		</div>
	</div>

	<? include "./inc/form_hwp.php"; ?>

	<? include "./inc/bottom.php"; ?>

</div>
</body>
</html>
