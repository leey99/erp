<?
$sub_menu = "400100";
include_once("./_common.php");

$sub_title = "2013년도 고용산재보험 보수총액신고";
$g4[title] = $sub_title." : 서식출력 : ".$easynomu_name;

$sub_menu = "300100";
include_once("./_common.php");
$is_admin = "super";

//담당자, 처리현황, 처리일자 저장
$now_time = date("Y-m-d H:i:s");
$damdang_code_0022 = "정진희";
$damdang_code_0023 = "이민화";
if($damdang_code != "") {
	$sql = " update total_pay set 
				damdang_code = '$damdang_code',
				conduct = '$conduct',
				ok_datetime = '$now_time'
			  where id = '$id' ";
	//echo $sql;
	//exit;
	sql_query($sql);

	if($damdang_code == "0022") $damdang_name = $damdang_code_0022;
	else if($damdang_code == "0023") $damdang_name = $damdang_code_0023;

	alert("정상적으로 담당자($damdang_name) 확인이 되었습니다.","total_pay_list_admin.php?page=$page");
}
$result1=mysql_query("select * from total_pay where id = $id");
$row1=mysql_fetch_array($result1);
$comp_bznb = $row1[t_no];
$comp_name = $row1[comp_name];
$boss_name = $row1[boss_name];
$adr_zip = explode("-",$row1[adr_zip]);
$adr_zip1 = $adr_zip[0];
$adr_zip2 = $adr_zip[1];
$adr_adr1 = $row1[adr_adr1];
$adr_adr2 = $row1[adr_adr2];
$sj_upjong_code = $row1[sj_upjong_code];
$sj_upjong = $row1[sj_upjong];
$sj_percent = $row1[sj_percent];
$comp_email = $row1[comp_email];
$comp_tel = $row1[comp_tel];
$comp_fax = $row1[comp_fax];
//근로자 신고건수
$result2=mysql_query("select count(*) as cnt from total_pay_opt where mid = $id");
$row2=mysql_fetch_array($result2);
$worker_count = $row2[cnt];

// 로그인 시 사업자정보 로그인
if(!$row1[comp_name]) {
	$sql_a4 = " select * from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
	$row_a4 = sql_fetch($sql_a4);
	$row1[comp_name] = $row_a4[com_name];
	$row1[comp_adr]  = $row_a4[com_juso]." ".$row_a4[com_juso2];
	$row1[comp_bznb] = $row_a4[t_insureno];
	$row1[comp_tel]  = $row_a4[com_tel];
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
<link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
</head>
<body style="margin:0px">
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
<div id="">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
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
							</table>

							<div id="rcontent" class="center m_side">
								<form name = "HwpControl" id="HwpControl" method="post" action="<?=$PHP_SELF?>" style="margin:0">
									<input type="hidden" name="company" value="<?=$comp_name?>"/>
									<input type="hidden" name="t_no" value="<?=$comp_bznb?>"/>
									<input type="hidden" name="tel" value="<?=$comp_tel?>"/>
									<input type="hidden" name="fax" value="<?=$comp_fax?>"/>
									<input type="hidden" name="ceo" value="<?=$boss_name?>"/>
									<input type="hidden" name="addr" value="<?=$adr_zip1?>-<?=$adr_zip2?> <?=$adr_adr1?> <?=$adr_adr2?>"/>
									<input type="hidden" name="today" value="<?=date("Y년 m월 d일")?>" title="오늘날짜"/>

									<!--반복 변수 배열 처리-->
									<input type="hidden" name="no" value=" "/>
									<input type="hidden" name="bohum_code" value=" "/>
									<input type="hidden" name="pay_name" value=" "/>
									<input type="hidden" name="ssnb" value=" "/>
									<input type="hidden" name="sj_sdate" value=" "/>
									<input type="hidden" name="sj_edate" value=" "/>
									<input type="hidden" name="sj_ypay" value=" "/>
									<input type="hidden" name="sj_mpay" value=" "/>
									<input type="hidden" name="gy_sdate" value=" "/>
									<input type="hidden" name="gy_edate" value=" "/>
									<input type="hidden" name="gy_ypay" value=" "/>
									<input type="hidden" name="gy_ypay2" value=" "/>
									<input type="hidden" name="gy_mpay" value=" "/>
<?
$n = 0;
$result_opt_cnt = mysql_query("select count(*) as cnt from total_pay_opt where mid = $id");
$row_opt_cnt = mysql_fetch_array($result_opt_cnt);
$cnt = $row_opt_cnt[cnt];
//echo $cnt;
$result_opt = mysql_query("select * from total_pay_opt where mid = $id order by id asc");
for($i=1; $row_opt=sql_fetch_array($result_opt); $i++) {
	$name[$i] = $row_opt[name1];
	//주민등록번호 뒷자리 별표 처리
	$ssnb[$i] = explode("-",$row_opt[ssnb1]);
	$ssnb1[$i] = $ssnb[$i][0];
	$ssnb2[$i] = $ssnb[$i][1];
	$bohum_code[$i] = $row_opt[bohum_code1];
	$sj_sdate[$i] = $row_opt[sj_sdate1];
	$sj_edate[$i] = $row_opt[sj_edate1];
	$sj_ypay[$i] = number_format($row_opt[sj_ypay1]);
	if($sj_ypay[$i] == "0") $sj_ypay[$i] = "&nbsp;";
	$sj_mpay[$i] = number_format($row_opt[sj_mpay1]);
	if($sj_mpay[$i] == "0") $sj_mpay[$i] = "&nbsp;";
	$gy_sdate[$i] = $row_opt[gy_sdate1];
	$gy_edate[$i] = $row_opt[gy_edate1];
	$gy_ypay[$i] = number_format($row_opt[gy_ypay1]);
	$gy_ypay2[$i] = number_format($row_opt[gy_ypay2]);
	$gy_mpay[$i] = number_format($row_opt[gy_mpay1]);
	if($gy_ypay[$i] == "0") $gy_ypay[$i] = "&nbsp;";
	if($gy_ypay2[$i] == "0") $gy_ypay2[$i] = "&nbsp;";
	if($gy_mpay[$i] == "0") $gy_mpay[$i] = "&nbsp;";
	$gy_post[$i] = $row_opt[gy_post1];
	$gg_sdate[$i] = $row_opt[gg_sdate1];
	$gg_ypay[$i] = number_format($row_opt[gg_ypay1]);
	$gg_month[$i] = number_format($row_opt[gg_month1]);
	if($gg_ypay[$i] == "0") $gg_ypay[$i] = "&nbsp;";
	if($gg_month[$i] == "0") $gg_month[$i] = "&nbsp;";
}
$temp_sj_ypay = number_format($row1[temp_sj_ypay]);
$temp_gy_ypay = number_format($row1[temp_gy_ypay]);
$temp_gy_ypay2 = number_format($row1[temp_gy_ypay2]);
$etc_sj_ypay = number_format($row1[etc_sj_ypay]);
$etc2_sj_ypay = number_format($row1[etc2_sj_ypay]);
$sj_ysum = number_format($row1[sj_ysum]);
$gy_ysum = number_format($row1[gy_ysum]);
$gy_ysum2 = number_format($row1[gy_ysum2]);
$temp_gg_ypay = number_format($row1[temp_gg_ypay]);
$etc_gg_ypay = number_format($row1[etc_gg_ypay]);
$etc2_gg_ypay = number_format($row1[etc2_gg_ypay]);
$gg_ysum = number_format($row1[gg_ysum]);
if($temp_sj_ypay == "0") $temp_sj_ypay = "&nbsp;";
if($temp_gy_ypay == "0") $temp_gy_ypay = "&nbsp;";
if($temp_gy_ypay2 == "0") $temp_gy_ypay2 = "&nbsp;";
if($etc_sj_ypay == "0") $etc_sj_ypay = "&nbsp;";
if($etc2_sj_ypay == "0") $etc2_sj_ypay = "&nbsp;";
if($sj_ysum == "0") $sj_ysum = "&nbsp;";
if($gy_ysum == "0") $gy_ysum = "&nbsp;";
if($gy_ysum2 == "0") $gy_ysum2 = "&nbsp;";
if($temp_gg_ypay == "0") $temp_gg_ypay = "&nbsp;";
if($etc_gg_ypay == "0") $etc_gg_ypay = "&nbsp;";
if($etc2_gg_ypay == "0") $etc2_gg_ypay = "&nbsp;";
if($gg_ysum == "0") $gg_ysum = "&nbsp;";

for($i=1;$i<=$cnt;$i++) {
	if($i > $worker_count) {
	 $worker_display[$i] = "display:none";
	}
	$n = $i;
	if(!$bohum_code[$i]) $bohum_code[$i] = "&nbsp;";
	if(!$sj_sdate[$i]) $sj_sdate[$i] = "&nbsp;";
	if(!$sj_edate[$i]) $sj_edate[$i] = "&nbsp;";
	if(!$gy_sdate[$i]) $gy_sdate[$i] = "&nbsp;";
	if(!$gy_edate[$i]) $gy_edate[$i] = "&nbsp;";
	if(!$gg_sdate[$i]) $gg_sdate[$i] = "&nbsp;";
	if(!$gg_month[$i]) $gg_month[$i] = "&nbsp;";
?>
									<input type="hidden" name="no" value="<?=$n?>"/>
									<input type="hidden" name="bohum_code" value="<?=$bohum_code[$i]?>"/>
									<input type="hidden" name="pay_name" value="<?=$name[$i]?>"/>
									<input type="hidden" name="ssnb" value="<?=$ssnb1[$i]?>-*******"/>
									<input type="hidden" name="sj_sdate" value="<?=$sj_sdate[$i]?>"/>
									<input type="hidden" name="sj_edate" value="<?=$sj_edate[$i]?>"/>
									<input type="hidden" name="sj_ypay" value="<?=$sj_ypay[$i]?>"/>
									<input type="hidden" name="sj_mpay" value="<?=$sj_mpay[$i]?>"/>
									<input type="hidden" name="gy_sdate" value="<?=$gy_sdate[$i]?>"/>
									<input type="hidden" name="gy_edate" value="<?=$gy_edate[$i]?>"/>
									<input type="hidden" name="gy_ypay" value="<?=$gy_ypay[$i]?>"/>
									<input type="hidden" name="gy_ypay2" value="<?=$gy_ypay2[$i]?>"/>
									<input type="hidden" name="gy_mpay" value="<?=$gy_mpay[$i]?>"/>
<?
}
?>



									<input type="hidden" name="pay_count" value="<?=$n?>"/>
<?
//여분 출력 hwp control 셋팅
//echo $m;
$page_count = 10;
if($n > 10 && $n < 33) $page_count = 32;
else if($n > 32) $page_count = 54;
//echo $page_count;
$k_limit = $page_count - $n;
//echo $k_limit;
for($k=0;$k<$k_limit;$k++) {
?>
									<input type="hidden" name="no" value=" "/>
									<input type="hidden" name="bohum_code" value=" "/>
									<input type="hidden" name="pay_name" value=" "/>
									<input type="hidden" name="ssnb" value=" "/>
									<input type="hidden" name="sj_sdate" value=" "/>
									<input type="hidden" name="sj_edate" value=" "/>
									<input type="hidden" name="sj_ypay" value=" "/>
									<input type="hidden" name="sj_mpay" value=" "/>
									<input type="hidden" name="gy_sdate" value=" "/>
									<input type="hidden" name="gy_edate" value=" "/>
									<input type="hidden" name="gy_ypay" value=" "/>
									<input type="hidden" name="gy_ypay2" value=" "/>
									<input type="hidden" name="gy_mpay" value=" "/>

<?
}
?>
									<input type="hidden" name="temp_sj_ypay" value="<?=$temp_sj_ypay?>"/>
									<input type="hidden" name="temp_gy_ypay" value="<?=$temp_gy_ypay?>"/>
									<input type="hidden" name="temp_gy_ypay2" value="<?=$temp_gy_ypay2?>"/>
									<input type="hidden" name="etc_sj_ypay" value="<?=$etc_sj_ypay?>"/>
									<input type="hidden" name="sj_ysum" value="<?=$sj_ysum?>"/>
									<input type="hidden" name="gy_ysum" value="<?=$gy_ysum?>"/>
									<input type="hidden" name="gy_ysum2" value="<?=$gy_ysum2?>"/>

									<input type="hidden" name="etc_count" value=" "/>
<?
$etc_count = explode(",",$row1[etc_count]);
for($i=1;$i<13;$i++) {
	$k = $i - 1;
	if(!$etc_count[$k]) $etc_count[$k] = " ";
?>
									<input type="hidden" name="etc_count" value="<?=$etc_count[$k]?>"/>
<?
}
?>
									<!-- 한글 컨트롤 폼 -->
									<div style="margin-top:6px;z-index:-1;border:1px solid #ccc;width:1160">
										<object id="HwpCtrl" width="100%" height="850" align="center" classid="CLSID:BD9C32DE-3155-4691-8972-097D53B10052"></object>
									</div>
								</form>
							</div>

						</td>
					</tr>
				</table>

			</td>
		</tr>
	</table>			
</div>
<script language="javascript" src="js/total_pay_center.js"></script>
</body>
</html>
