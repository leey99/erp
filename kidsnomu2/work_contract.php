<?
$sub_menu = "600100";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$sql_common = " from $g4[pibohum_base] ";

$sql_a4 = " select * from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4[com_code];

$sql_a4_opt = " select * from com_list_gy_opt where com_code = '$com_code' ";
$row_a4_opt = sql_fetch($sql_a4_opt);

$sub_title = "근로계약서";
$g4[title] = $sub_title." : 서식출력 : ".$easynomu_name;

$colspan = 11;

$sql1 = " select * from $g4[pibohum_base] where com_code='$code' and sabun='$id' ";
//echo $sql1;
$result1 = sql_query($sql1);
$row1=mysql_fetch_array($result1);

$sql2 = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
//echo $sql2;
$result2 = sql_query($sql2);
$row2=mysql_fetch_array($result2);

$sql3 = " select * from pibohum_base_opt2 where com_code='$code' and sabun='$id' ";
//echo $sql3;
$result3 = sql_query($sql3);
$row3=mysql_fetch_array($result3);

//입사일
$in_day_array = explode(".",$row1[in_day]);
$in_day = $in_day_array[0]."년 ".$in_day_array[1]."월 ".$in_day_array[2]."일";
//퇴직일
if($row1[out_day] == "") {
	$out_day = "퇴직일자";
} else {
	$out_day_array = explode(".",$row1[out_day]);
	$out_day = $out_day_array[0]."년 ".$out_day_array[1]."월 ".$out_day_array[2]."일";
}

//채용형태
if($row1[work_form] == "") $work_form = "";
else if($row1[work_form] == "1") $work_form = "정규직";
else if($row1[work_form] == "2") $work_form = "계약직";
else if($row1[work_form] == "3") $work_form = "일용직";
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
	//location.href = "staff_view.php?id=<?=$id?>&code=<?=$code?>&page=<?=$page?>";
	location.href = "staff_list.php?page=<?=$page?>";
}
function work_contract_ok() {
	document.work_contract_form.submit();
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
							<table border="0" cellspacing="0" cellpadding="0" style="margin-top:20px">
								<tr>
									<td>
										<a href="http://e-consulting.kr" target="_blank"><img src="./images/banner01.gif" border="0"></a>
										<br>
										<a href="http://cafe.naver.com/kcmcceo" target="_blank"><img src="./images/banner02.gif" border="0"></a>
										<br>
										<a href="http://blog.naver.com/kcmc4519" target="_blank"><img src="./images/banner03.gif" border="0"></a>
									</td>
								</tr>
							</table>
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
<div id="rcontent" class="center m_side">
	<table border="0">
		<tr>
			<td>
				<div style="padding:2px">
					<form name="work_contract_form" method="post" action="work_contract_ok.php">
					<input type="button" name="history_back_bt" value="목록으로" onclick="back_url()" /> 
<?
if($row2[work_contract] != 1) {
?>
					<input type="button" name="work_contract_bt" value="작성완료" onclick="work_contract_ok()" /> 
<? } ?>
					<input type="hidden" name="id" value="<?=$id?>" />
					<input type="hidden" name="code" value="<?=$code?>" />
					</form>
				</div>
			</td>
			<td>성명 : <?=$row1[name]?> / 주민등록번호 : <?=$row1[jumin_no]?> / 입사일 : <?=$in_day?> / 채용형태 : <?=$work_form?></td>
		</tr>
	</table>
<?
$pay_gbn = $row2[pay_gbn];
?>
<form name = "HwpControl" id="HwpControl" method="post">
	<input type="hidden" name="labor" value="labor1" />
	<input type="hidden" name="pay_gbn" value="<?=$pay_gbn?>" />
	<!-- 근로계약서 -->
	<input type="hidden" name="addtxt11_0" value="교사처우개선비" title="별정수당1"/>
	<input type="hidden" name="addtxt11_1" value="근무환경개선비" title="별정수당3"/>
	<input type="hidden" name="addtxt11_2" value="특별수당" title="별정수당5"/>
	<input type="hidden" name="addtxt11_3" value="특수교사수당" title="별정수당7"/>
	<input type="hidden" name="addtxt11_4" value="농어촌특별수당" title="별정수당9"/>
	<input type="hidden" name="addtxt11_5" value="담임수당" title="별정수당11"/>
	<input type="hidden" name="addtxt12_0" value="0" title="별정수당2"/>
	<input type="hidden" name="addtxt12_1" value="0" title="별정수당4"/>
	<input type="hidden" name="addtxt12_2" value="0" title="별정수당6"/>
	<input type="hidden" name="addtxt12_3" value="0" title="별정수당8"/>
	<input type="hidden" name="addtxt12_4" value="0" title="별정수당10"/>
	<input type="hidden" name="addtxt12_5" value="0" title="별정수당12"/>

		<input type="hidden" name="today" value="<?=date("Y년 m월 d일")?>" title="오늘날짜"/>
	<input type="hidden" name="job_grade" value="3" title="호봉"/>
	<input type="hidden" name="comp_type" value="A" title="사업장유형"/>
	<input type="hidden" name="comp_num" value="<?=$row_a4[biz_no]?> " title="사업자등록번호" />
	<input type="hidden" name="comp_name" value="<?=$row_a4[com_name]?> " title="사업장명" />
	<input type="hidden" name="comp_ceo" value="<?=$row_a4[boss_name]?> " title="대표자명" />
	<input type="hidden" name="comp_upte" value="<?=$row_a4[uptae]?> " title="업태" />
	<input type="hidden" name="comp_jongmok" value="<?=$row_a4[upjong]?> " title="종목" />
	<input type="hidden" name="comp_tel" value="<?=$row_a4[com_tel]?> " title="사업장전화" />
	<input type="hidden" name="comp_fax" value="<?=$row_a4[com_fax]?> " title="사업장팩스" />
	<input type="hidden" name="comp_cel" value="<?=$row_a4[boss_hp]?> " title="대표자핸드폰" />
	<input type="hidden" name="comp_email" value=""<?=$row_a4_opt[boss_mail]?> " title="대표자email" />
	<input type="hidden" name="comp_addr1" value="<?=$row_a4[com_juso]?> " title="사업장주소1" />
	<input type="hidden" name="comp_addr2" value="<?=$row_a4[com_juso2]?> " title="사업장주소2" />

	<input type="hidden" name="mb_name" value="<?=$row_a4[com_name]?>" />

	<input type="hidden" name="name_k" value="<?=$row1[name]?>" />
	<input type="hidden" name="jumin" value="<?=$row1[jumin_no]?>" />
	<input type="hidden" name="addr" value="<?=$row1[w_juso]?> " />
	<input type="hidden" name="addr2" value="<?=$row2[w_juso2]?> " />
	<input type="hidden" name="cel" value="<?=$row2[emp_cel]?> " title="핸드폰번호" />
	<input type="hidden" name="tel" value="<?=$row1[add_tel]?> " title="사원전화" />
	<input type="hidden" name="email" value="<?=$row2[emp_email]?> " title="EMAIL" />

	<input type="hidden" name="bank_1" value="" title="은행명" />
	<input type="hidden" name="bank_2" value="" title="계좌번호" />
	<input type="hidden" name="bank_3" value="" title="예금주" />
	<input type="hidden" name="jdate" value="<?=$in_day?>" title="입사일" />
	<input type="hidden" name="edate" value="<?=$out_day?>" title="퇴직일" />
	<input type="hidden" name="job_div" value="<?=$work_form?>" />
	<input type="hidden" name="work_form" value="<?=$row1[work_form]?>" />
<?
$contract_sdate = str_replace(".","-",$row2[contract_sdate]);
$contract_edate = str_replace(".","-",$row2[contract_edate]);
//상여금
$bonus_percent = $row3[bonus_percent];
$bonus_standard_array = array("","기본급","결정임금","통상임금","총급여");
$bonus_standard = " ";
for($i=0;$i<=count($bonus_standard_array);$i++) {
	if($row3[bonus_standard] == $i) $bonus_standard = $bonus_standard_array[$i];
}
$bonus_array = explode(",",$row3[bonus_p]);
$bonus_time = 0;
for($i=0;$i<=count($bonus_array);$i++) {
	if($bonus_array[$i] != "") $bonus_time++;
}
if($bonus_percent == "0") {
	$bonus1 = "○";
	$bonus2 = " ";
	$bonus3 = " ";
} else {
	$bonus1 = " ";
	$bonus2 = "○";
	if($row3[check_bonus_money_yn] == "Y") $bonus_standard = number_format($row3[bonus_money])."원";
	$bonus3 = $bonus_standard." * ".$bonus_percent."% (".$bonus_time.")회 분할";
}
//휴게시간2(점심시간)
if($row_a4_opt[rest2]) $rest2 = $row_a4_opt[rest2]."~".$row_a4_opt[rest2e];
else $rest2 = "없음";
?>
	<input type="hidden" name="contract_sdate" value="<?=date("Y년 m월 d일",strtotime($contract_sdate))?>" />
	<input type="hidden" name="contract_edate" value="<?=date("Y년 m월 d일",strtotime($contract_edate))?>" />

	<input type="hidden" name="employee_id" value="10150011" title="사번" />
	<input type="hidden" name="dept" value="교무부" title="부서" />
	<input type="hidden" name="jik" value="<?=$row_position[name]?>" title="직위" />

	<input type="hidden" name="jogun" value="40" />
	<input type="hidden" name="wtime" value="10:00" />
	<input type="hidden" name="workhour_40" value="○" />
	<input type="hidden" name="workhour_44" value=" " />
	<input type="hidden" name="stime" value="09:00" />
	<input type="hidden" name="etime" value="18:00" />
	<input type="hidden" name="rest2" value="<?=$rest2?>" />
	<input type="hidden" name="saturday1" value="○" />
	<input type="hidden" name="saturday2" value=" " />
	<input type="hidden" name="saturday_s" value=" " />
	<input type="hidden" name="saturday_e" value=" " />
	<input type="hidden" name="workday1" value="월" />
	<input type="hidden" name="workday2" value="금" />
	<input type="hidden" name="workday3" value="5" />

	<input type="hidden" name="time_chk" value="○" title="시급"/>
	<input type="hidden" name="day_chk" value=" " title="일급"/>
	<input type="hidden" name="timegub" value="<?=number_format($row3[money_hour_ts])?>" title="시간급"/>
	<input type="hidden" name="calculate1" value="1" title="산정1"/>
	<input type="hidden" name="calculate2" value="말" title="산정2"/>
	<input type="hidden" name="payment1" value=" " title="직접지급"/>
	<input type="hidden" name="payment2" value="○" title="입금"/>
	<input type="hidden" name="hday" value="<?=$row_a4_opt[hday]?>" title="주휴일" />
	<input type="hidden" name="bonus1" value="<?=$bonus1?>" title="상여금1"/>
	<input type="hidden" name="bonus2" value="<?=$bonus2?>" title="상여금2"/>
	<input type="hidden" name="bonus3" value="<?=$bonus3?>" title="상여금3"/>
	<input type="hidden" name="bonus_standard" value=" <?=$bonus_standard?>" title="산정기준"/>
	<input type="hidden" name="bonus_percent" value=" <?=$bonus_percent?>%" title="상여비율"/>
	<input type="hidden" name="bonus_time" value="<?=$bonus_time?>" title="회"/>

	<input type="hidden" name="pay1" value="<?=number_format($row3[money_hour_ms])?>" />
	<input type="hidden" name="pay2" value="<?=number_format($row3[money_g1]+$row3[money_g2]+$row3[money_g3])?>" /><!--과세수당-->
	<input type="hidden" name="pay3" value="<?=number_format($row3[money_b1]+$row3[money_b2]+$row3[money_b3])?>" /><!--법정수당-->
	<input type="hidden" name="pay4" value="<?=number_format($row3[money_e1]+$row3[money_e2]+$row3[money_e3]+$row3[money_e4]+$row3[money_e5]+$row3[money_e6]+$row3[money_e7]+$row3[money_e8])?>" /><!--기타수당-->
	<input type="hidden" name="pay5" value="<?=number_format($row3[money_month_base])?>" /><!--지급총액(급여지급총액+별정수당총액)-->
	<input type="hidden" name="annual_salary" value="<?=number_format($row3[money_month_base]*12)?>" /><!--연봉총액-->
	<input type="hidden" name="pay_day" value=" <?=$row_a4_opt[pay_day]?>" /><!--급여지금일-->
	<input type="hidden" name="jikjong" value="<?=$row2[jikjong]?> " /><!--직종-->

	<!-- 한글 컨트롤 폼 -->
	<p style="margin-top:20px;z-index:-1;border:1px solid #ccc;width:">
		<object id="HwpCtrl" width="100%" height="650" align="center" classid="CLSID:BD9C32DE-3155-4691-8972-097D53B10052"></object>
	</p>
	</form>
	<script type="text/javascript">
	document.getElementById('HwpCtrl').style.height = "710px";
	function setAppendRow1(){
	}

	function setAppendRow2(){
	}

	function setAppendRow3(){
	}

	function setAppendRow4(){
	}

	function setAppendRow5(){
	}

	function setAppendRow6(){
	}
	//toggleLayer('employeeList',this.name);
	</script>
	<script src="./js/work_contract.js" type="text/javascript" charset="euc-kr"></script>
</div>



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
