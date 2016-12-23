<?
$sub_menu = "400100";
include_once("./_common.php");

$sub_title = "2013년도 건강보험 보수총액신고";
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
	location.href = "pay_list.php?search_year=<?=$search_year?>&search_month=<?=$search_month?>";
}
</script>

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
									<input type="hidden" name="today" value="<?=date("Y년 m월 d일")?>" title="오늘날짜"/>

									<!--반복 변수 배열 처리-->
									<input type="hidden" name="no" value=" "/>
									<input type="hidden" name="pay_name" value=" "/>
									<input type="hidden" name="ssnb" value=" "/>
									<input type="hidden" name="sdate" value=" "/>
									<input type="hidden" name="ypay" value=" "/>
									<input type="hidden" name="month" value=" "/>
<?
//엑셀 리더
if($excel) {
	include $_SERVER["DOCUMENT_ROOT"]."/PHPExcel/Classes/PHPExcel.php";
	$UpFileExt = "xls";
	$objPHPExcel = new PHPExcel();
	$upload_path = $_SERVER["DOCUMENT_ROOT"]."/total_pay_result";
	$upfile_path = $upload_path."/".$excel.".xls";
	if(file_exists($upfile_path)) {
		$inputFileType = 'Excel2007';
		if($UpFileExt == "xls") {
			$inputFileType = 'Excel5';	
		}
		$objReader = PHPExcel_IOFactory::createReaderForFile($upfile_path);
		$objPHPExcel = $objReader->load($upfile_path);
		$objPHPExcel ->setActiveSheetIndex(0);
		$objWorksheet = $objPHPExcel->getActiveSheet(); 
		$maxRow = $objWorksheet->getHighestRow(); 
		//echo $maxRow;
		$m = 0;
		$count_page = 0;

		//서식 비교 (3.17 서식 변경됨)
		$excel_new_form = $objWorksheet->getCell('A' . 2)->getValue();
		$new_form = iconv("UTF-8", "EUC-KR", $excel_new_form);
		$new_form_chk = substr($new_form,0,2);
		//echo $new_form_chk;

		//(주)쓰리브이테크놀러지 등 (이전 서식)
		if($new_form_chk == "【") $start_line = 15;
		else $start_line = 14;
		//echo $start_line;

		for ($i = 0; $i < $maxRow; $i++) {
			$k = $i + $start_line;
			$excel_name[$i] = $objWorksheet->getCell('A' . $k)->getValue();
			$name[$i] = iconv("UTF-8", "EUC-KR", $excel_name[$i]);
			$name_chk = substr($name[$i],0,2);
			if($name_chk == "⑥") {
				$excel_count = $i;
				$excel_type = 1;
			} else if($name_chk == "⑦") {
				if(!$excel_count) {
					$excel_count = $i;
					$excel_type = 2;
				}
			} else if($name_chk == "") {
				if(!$excel_count) {
					$excel_count = $i;
					$excel_type = 6;
				}
			} else {
				$count_page++;
				//echo $i." / ";
				if(!$excel_type) {
					$excel_count = $count_page;
					$excel_type = 3;
				}
				$excel_type_chk = $objWorksheet->getCell('AD' . 7)->getValue();
				$excel_type_chk = iconv("UTF-8", "EUC-KR", $excel_type_chk);
				//echo $excel_type_chk;
				if($excel_type_chk == "(앞 쪽)") $excel_type = 4;
				$excel_type_chk = $objWorksheet->getCell('AA' . 6)->getValue();
				$excel_type_chk = iconv("UTF-8", "EUC-KR", $excel_type_chk);
				if($excel_type_chk == "(앞 면)") $excel_type = 5;
				$excel_type_chk = $objWorksheet->getCell('AC' . 7)->getValue();
				$excel_type_chk = iconv("UTF-8", "EUC-KR", $excel_type_chk);
				if($excel_type_chk == "(앞 쪽)") $excel_type = 6;
			}
			if($excel_type == 5) $excel_count = $count_page;
			else if($excel_type == 6) $excel_count = $count_page;
		}
		//(주)현진테크 / 동아에프앤티 / 다산목재 / CHIKO INTERNATIONAL / 민진시스템 / 대흥밸브금속 / ㈜룸비니항공여행사 / 성민주유소 / 쌍마기계
		if($excel == "12486743260") $excel_type = 7;
		else if($excel == "60681980290" || $excel == "40105512170") $excel_type = 4;
		else if($excel == "60627923960" || $excel == "61503992140" || $excel == "61081731810" || $excel == "51481497240" || $excel == "51312917140") $excel_type = 8;
		else if($excel == "51581256710") $excel_type = 10;
		//140317
		if($excel == "" || $excel == "") $excel_type = 4;
		else if($excel == "51707788590" || $excel == "") $excel_type = 8;
		else if($excel == "" || $excel == "") $excel_type = 9;
		else if($excel == "") $excel_type = 10;
		//140318
		if($excel == "22480215780" || $excel == "40105512170" || $excel == "50342756360") $excel_type = 4;
		else if($excel == "12580238140" || $excel == "12680141330" || $excel == "40280092520" || $excel == "51505596340" || $excel == "60980357440" || $excel == "61303697520" || $excel == "61380346470" || $excel == "61381622660" || $excel == "61580346620" || $excel == "91202014601" || $excel == "91202977511") $excel_type = 8;
		else if($excel == "10580030560" || $excel == "12480268180" || $excel == "12580238140" || $excel == "12734652970" || $excel == "12880416360" || $excel == "14082673050" || $excel == "30382034980" || $excel == "30395058600" || $excel == "31280246440" || $excel == "50335643200" || $excel == "60686396990" || $excel == "61293035010" || $excel == "61380477970" || $excel == "90901318791") $excel_type = 9;
		else if($excel == "31428612160") $excel_type = 10;
		//140319
		if($excel == "14280264560" || $excel == "41780041660" || $excel == "51181144870" || $excel == "60880070750") $excel_type = 4;
		else if($excel == "12580237740" || $excel == "12581795420" || $excel == "12880270080" || $excel == "13080106260" || $excel == "13280422880" || $excel == "14080124650" || $excel == "14189019260" || $excel == "14280300420" || $excel == "14280318520" || $excel == "14480020330" || $excel == "30380035910" || $excel == "40380076690" || $excel == "40780060180" || $excel == "40982727980" || $excel == "41580080550" || $excel == "41880167770" || $excel == "50582688400" || $excel == "51305861540" || $excel == "51422597350" || $excel == "51480142140" || $excel == "60522956810" || $excel == "61319875760" || $excel == "61380123760" || $excel == "62021780630" || $excel == "62180084940" || $excel == "91304172971") $excel_type = 8;
		else if($excel == "10780071020" || $excel == "12180127650" || $excel == "12680253770" || $excel == "13480298640" || $excel == "14280111610" || $excel == "14280221820" || $excel == "41181544570" || $excel == "60580038610" || $excel == "60680102680" || $excel == "60980197820" || $excel == "61380043470" || $excel == "90800356471") $excel_type = 9;
		else if($excel == "30180051800" || $excel == "41880053240" || $excel == "51581292310" || $excel == "62080209090") $excel_type = 10;
		//140320
		if($excel == "10780039020" || $excel == "31280098330" || $excel == "60891679290") $excel_type = 4;
		else if($excel == "12182707880" || $excel == "12482699370" || $excel == "12580190420" || $excel == "12780138590" || $excel == "13180120820" || $excel == "13280073020" || $excel == "13280196380" || $excel == "13580322990" || $excel == "14080062450" || $excel == "22280135050" || $excel == "41086777000" || $excel == "41680133610" || $excel == "60580076250" || $excel == "60980280160" || $excel == "61282771190" || $excel == "61381488900" || $excel == "91304636471") $excel_type = 8;
		else if($excel == "13709779490" || $excel == "14380002400" || $excel == "22480024690" || $excel == "50280086070" || $excel == "50682108460" || $excel == "60980288450" || $excel == "61515836890" || $excel == "62080149740") $excel_type = 9;
		else if($excel == "13181686230" || $excel == "60717499660" || $excel == "60980315820") $excel_type = 10;
		//140321
		if($excel == "12182693020" || $excel == "12980070050" || $excel == "60681980290" || $excel == "91303536881") $excel_type = 4;
		else if($excel == "11917212290" || $excel == "12880089570" || $excel == "13080154650" || $excel == "13181803790" || $excel == "31082633250" || $excel == "31280363590" || $excel == "40407488070" || $excel == "40880090370" || $excel == "41086623760" || $excel == "60880400360" || $excel == "61580330380" || $excel == "61682249150" || $excel == "90900910971" || $excel == "91201883441" || $excel == "91202318461") $excel_type = 8;
		else if($excel == "11780072300" || $excel == "12480282140" || $excel == "14180039880" || $excel == "14180056900" || $excel == "20480165570" || $excel == "40280236660") $excel_type = 9;
		else if($excel == "12180140790" || $excel == "14080119800" || $excel == "61581705490" || $excel == "62080055720") $excel_type = 10;
		//140324
		if($excel == "" || $excel == "") $excel_type = 4;
		else if($excel == "" || $excel == "") $excel_type = 8;
		else if($excel == "" || $excel == "") $excel_type = 9;
		else if($excel == "" || $excel == "") $excel_type = 10;
		//140325
		if($excel == "" || $excel == "") $excel_type = 4;
		else if($excel == "" || $excel == "") $excel_type = 8;
		else if($excel == "" || $excel == "") $excel_type = 9;
		else if($excel == "" || $excel == "") $excel_type = 10;
		//행번호 구분
		$record_count = $excel_count + $start_line - 1;
		//echo $record_count;
		if($record_count >= 14 && $record_count <= 18) $excel_type = 8;
		else if($record_count >= 19 && $record_count <= 23) $excel_type = 9;
		else if($record_count >= 24 && $record_count <= 27) $excel_type = 4;
		else if($record_count >= 28 && $record_count <= 30) $excel_type = 10;
		//강제 적용
		//if($excel == "12381614780" || $excel == "") $excel_type = 4;


		//echo $excel_count;
		//echo $excel_type;
		for ($i = 0; $i < $maxRow; $i++) {
			$k = $i + $start_line;
			$excel_name[$i] = $objWorksheet->getCell('A' . $k)->getValue(); 
			$excel_ssnb[$i] = $objWorksheet->getCell('B' . $k)->getValue(); 
			$excel_bohum_code[$i] = $objWorksheet->getCell('C' . $k)->getValue(); 
			$excel_sj_sdate[$i] = $objWorksheet->getCell('F' . $k)->getValue();
			$excel_gy_sdate[$i] = $objWorksheet->getCell('R' . $k)->getValue();
			$excel_gy_sdate2[$i] = $objWorksheet->getCell('Q' . $k)->getValue();
			$excel_sj_edate[$i] = trim($objWorksheet->getCell('H' . $k)->getValue());
			$excel_sj_edate2[$i] = trim($objWorksheet->getCell('I' . $k)->getValue()); 
			$excel_sj_edate3[$i] = trim($objWorksheet->getCell('K' . $k)->getValue()); 
			$excel_sj_edate4[$i] = trim($objWorksheet->getCell('J' . $k)->getValue()); 
			$excel_sj_ypay[$i]  = $objWorksheet->getCell('K' . $k)->getValue();
			$excel_sj_ypay2[$i] = $objWorksheet->getCell('L' . $k)->getValue();
			$excel_sj_ypay3[$i] = $objWorksheet->getCell('N' . $k)->getValue();
			$excel_sj_ypay4[$i] = $objWorksheet->getCell('Q' . $k)->getValue();
			$excel_sj_ypay5[$i] = $objWorksheet->getCell('P' . $k)->getValue();
			$excel_sj_ypay6[$i] = $objWorksheet->getCell('O' . $k)->getValue();
			$excel_sj_ypay7[$i] = $objWorksheet->getCell('M' . $k)->getValue();
			$excel_gy_ypay[$i]  = $objWorksheet->getCell('V' . $k)->getValue();
			$excel_gy_ypay2[$i] = $objWorksheet->getCell('Y' . $k)->getValue();

			$name[$i] = iconv("UTF-8", "EUC-KR", $excel_name[$i]);
			$ssnb[$i] = substr($excel_ssnb[$i],0,6)."-".substr($excel_ssnb[$i],6,7);
			$bohum_code[$i] = $excel_bohum_code[$i];
			if($excel_sj_sdate[$i])  $sj_sdate = substr($excel_sj_sdate[$i],0,4).".".substr($excel_sj_sdate[$i],4,2).".".substr($excel_sj_sdate[$i],6,2);
			else $sj_sdate = " ";
			if($excel_gy_sdate[$i])  $gy_sdate = substr($excel_gy_sdate[$i],0,4).".".substr($excel_gy_sdate[$i],4,2).".".substr($excel_gy_sdate[$i],6,2);
			else $gy_sdate = " ";
			if($excel_gy_sdate2[$i])  $gy_sdate2 = substr($excel_gy_sdate2[$i],0,4).".".substr($excel_gy_sdate2[$i],4,2).".".substr($excel_gy_sdate2[$i],6,2);
			else $gy_sdate2 = " ";	
			if($excel_sj_edate[$i])  $sj_edate[$i] = substr($excel_sj_edate[$i],0,4).".".substr($excel_sj_edate[$i],4,2).".".substr($excel_sj_edate[$i],6,2);
			if($excel_sj_edate2[$i]) $sj_edate2[$i] = substr($excel_sj_edate2[$i],0,4).".".substr($excel_sj_edate2[$i],4,2).".".substr($excel_sj_edate2[$i],6,2);
			if($excel_sj_edate3[$i]) $sj_edate3[$i] = substr($excel_sj_edate3[$i],0,4).".".substr($excel_sj_edate3[$i],4,2).".".substr($excel_sj_edate3[$i],6,2);
			if($excel_sj_edate4[$i]) $sj_edate4[$i] = substr($excel_sj_edate4[$i],0,4).".".substr($excel_sj_edate4[$i],4,2).".".substr($excel_sj_edate4[$i],6,2);
			$edate = $sj_edate[$i];
			if($excel_type == 1) {
				$edate = $sj_edate3[$i];
			} else if($excel_type == 2) {
				$edate = $sj_edate2[$i];
			} else if($excel_type == 3) {
				$edate = $sj_edate2[$i];
			} else if($excel_type == 4) {
				$edate = $sj_edate2[$i];
			} else if($excel_type == 5) {
				$edate = $sj_edate[$i];
			} else if($excel_type == 7) {
				$edate = $sj_edate[$i];
			} else if($excel_type == 8) {
				$edate = $sj_edate4[$i];
			} else if($excel_type == 9) {
				$edate = $sj_edate4[$i];
			} else if($excel_type == 10) {
				$edate = $sj_edate[$i];
				//if(!$sj_sdate == "") $sj_sdate = $gy_sdate2;
			} else {
				$edate = $sj_edate2[$i];
			}
			//echo $sj_edate[$i]."/";
			//echo $sj_sdate."/";
			//echo $edate."/";
			$sj_ypay = $excel_sj_ypay[$i];
			if($excel_type == 1) {
				if($excel_count > 5) {
					$sj_ypay = $excel_sj_ypay5[$i];
				} else {
					$sj_ypay = $excel_sj_ypay4[$i];
				}
			} else if($excel_type == 2) {
				$sj_ypay = $excel_sj_ypay2[$i];
			} else if($excel_type == 3) {
				$sj_ypay = $excel_sj_ypay2[$i];
			} else if($excel_type == 4) {
				$sj_ypay = $excel_sj_ypay3[$i];
			} else if($excel_type == 5) {
				$sj_ypay = $excel_sj_ypay[$i];
			} else if($excel_type == 7) {
				$sj_ypay = $excel_sj_ypay2[$i];
			} else if($excel_type == 8) {
				$sj_ypay = $excel_sj_ypay5[$i];
			} else if($excel_type == 9) {
				$sj_ypay = $excel_sj_ypay6[$i];
			} else if($excel_type == 10) {
				$sj_ypay = $excel_sj_ypay7[$i];
			} else {
				$sj_ypay = $excel_sj_ypay3[$i];
			}
			//echo $sj_ypay." / ";
			//echo $name[$i];
			//echo $excel_sj_ypay3[$i]." / ";
			$name_chk = substr($name[$i],0,2);
			if($name[$i] == "" || $name_chk == "⑥" || $name_chk == "⑦" || $name_chk == "※") {
				$maxRow = $i;
			} else {
				//echo $edate." / ";
				if(!$edate || substr($edate,0,4) > 2013 || substr($edate,0,7) == "2013.12") {
					$m++;
					//echo $sj_ypay2;
					//echo $sj_sdate;
					$year = substr($sj_sdate,0,4);
					if($year == "2013") {
						$month_org = substr($sj_sdate,5,2);
						$day_org = substr($sj_sdate,8,2);
						//echo $month_org;
						//이번달의 마지막날
						$end=mktime(0,0,0,$month_org+1,1,$year)-1;
						$end_month=date('d',$end);
						//echo $end_month;
						if((int)$day_org < ($end_month - 10)) {
							$month = 13 - (int)$month_org;
						} else {
							$month = 13 - (int)$month_org - 1;
						}
					} else {
						$month = 12;
					}
					if($sj_sdate == " ") $month = " ";
					//산재보험 취득일 없을 경우 고용보험 취득일 표시
					if(!$sj_sdate) $sj_sdate = $gy_sdate;
					if(!$sj_ypay) $sj_ypay = (int)$excel_gy_ypay[$i] + (int)$excel_gy_ypay2[$i];
?>
									<input type="hidden" name="no" value="<?=$m?>"/>
									<input type="hidden" name="pay_name" value="<?=$name[$i]?>"/>
									<input type="hidden" name="ssnb" value="<?=$ssnb[$i]?>"/>
									<input type="hidden" name="sdate" value="<?=$sj_sdate?>"/>
									<input type="hidden" name="ypay" value="<?=number_format($sj_ypay)?>"/>
									<input type="hidden" name="month" value="<?=$month?>"/>
<?
				}
			}
		}
		//강제 적용
		if($excel == "51481426240" || $excel == "") $excel_type = 11;
		//2페이지가 있을 경우
		if($excel_count > 16) {
			$objPHPExcel ->setActiveSheetIndex(1);
			$objWorksheet = $objPHPExcel->getActiveSheet(); 
			$maxRow = $objWorksheet->getHighestRow(); 
			for ($i = 0; $i < $maxRow; $i++) {
				$k = $i + 1;
				$excel_name_2[$i] = $objWorksheet->getCell('A' . $k)->getValue(); 
				$excel_ssnb_2[$i] = $objWorksheet->getCell('B' . $k)->getValue(); 
				$excel_bohum_code_2[$i] = $objWorksheet->getCell('C' . $k)->getValue(); 
				$excel_sj_sdate_2[$i] = $objWorksheet->getCell('E' . $k)->getValue(); 
				$excel_sj_edate_2[$i] = trim($objWorksheet->getCell('G' . $k)->getValue());
				$excel_sj_edate2_2[$i] = trim($objWorksheet->getCell('H' . $k)->getValue());
				$excel_sj_ypay_2[$i] = $objWorksheet->getCell('H' . $k)->getValue();
				$excel_sj_ypay2_2[$i] = $objWorksheet->getCell('K' . $k)->getValue();
				$excel_sj_ypay2_3[$i] = $objWorksheet->getCell('I' . $k)->getValue();
				$excel_sj_ypay2_4[$i] = $objWorksheet->getCell('J' . $k)->getValue();

				$name_2[$i] = iconv("UTF-8", "EUC-KR", $excel_name_2[$i]);
				$ssnb[$i] = substr($excel_ssnb[$i],0,6)."-".substr($excel_ssnb_2[$i],6,7);
				$bohum_code[$i] = $excel_bohum_code_2[$i];
				if($excel_sj_sdate_2[$i])  $sj_sdate = substr($excel_sj_sdate_2[$i],0,4).".".substr($excel_sj_sdate_2[$i],4,2).".".substr($excel_sj_sdate_2[$i],6,2);
				if($excel_sj_edate_2[$i])  $sj_edate_2[$i] = substr($excel_sj_edate_2[$i],0,4).".".substr($excel_sj_edate_2[$i],4,2).".".substr($excel_sj_edate_2[$i],6,2);
				if($excel_sj_edate2_2[$i])  $sj_edate2_2[$i] = substr($excel_sj_edate2_2[$i],0,4).".".substr($excel_sj_edate2_2[$i],4,2).".".substr($excel_sj_edate2_2[$i],6,2);
				$edate_org = $excel_sj_edate_2[$i];
				if($excel_type == 3) {
					$edate = $sj_edate_2[$i];
				} else if($excel_type == 4) {
					$edate = $sj_edate2_2[$i];
				} else if($excel_type == 5) {
					$edate = $sj_edate_2[$i];
				} else {
					$edate = $sj_edate_2[$i];
				}
				//echo $excel_sj_sdate[$i]."/";
				//echo $name_2[$i]."/";
				//echo substr($name_2[$i],0,2)."/";
				$sj_ypay = $excel_sj_ypay_2[$i];
				//echo $edate_org;
				//echo $sj_ypay;
				if($excel_type == 1) {
					$sj_ypay = $excel_sj_ypay_2[$i];
				} else if($excel_type == 4) {
					$sj_ypay = $excel_sj_ypay2_2[$i];
				} else if($excel_type == 5) {
					$sj_ypay = $excel_sj_ypay_2[$i];
				} else if($excel_type == 11) {
					$sj_ypay = $excel_sj_ypay2_4[$i];
				} else {
					$sj_ypay = $excel_sj_ypay2_2[$i];
				}
				//echo $sj_ypay;
				$name_chk_2 = substr($name_2[$i],0,2);
				if($name_2[$i] == "" || $name_chk_2 == "⑥" || $name_chk_2 == "⑦" || $name_chk_2 == "※" || $name_2[$i] == "(뒷 쪽)" || $name_2[$i] == "(뒷 면)") {
					$maxRow = $i;
				} else {
					//echo $edate."/";
					//echo $sj_edate2[$i];
					if(!$edate || substr($edate,0,4) > 2013) {
						$m++;
						//echo $sj_ypay2;
						$year = substr($sj_sdate,0,4);
						if($year == "2013") {
							$month_org = substr($sj_sdate,5,2);
							$day_org = substr($sj_sdate,8,2);
							//echo $month_org;
							//이번달의 마지막날
							$end=mktime(0,0,0,$month_org+1,1,$year)-1;
							$end_month=date('d',$end);
							//echo $end_month;
							if((int)$day_org < ($end_month - 10)) {
								$month = 13 - (int)$month_org;
							} else {
								$month = 13 - (int)$month_org - 1;
							}
						} else {
							$month = 12;
						}
?>
									<input type="hidden" name="no" value="<?=$m?>"/>
									<input type="hidden" name="pay_name" value="<?=$name_2[$i]?>"/>
									<input type="hidden" name="ssnb" value="<?=$ssnb[$i]?>"/>
									<input type="hidden" name="sdate" value="<?=$sj_sdate?>"/>
									<input type="hidden" name="ypay" value="<?=number_format($sj_ypay)?>"/>
									<input type="hidden" name="month" value="<?=$month?>"/>
<?
					}
				}
			}
		}
	}
}
//echo $m;
?>
									<input type="hidden" name="pay_count" value="<?=$m?>"/>
<?
//여분 출력 hwp control 셋팅
//echo $m;
$page_count = 13;
if($m > 13) $page_count = 37;
//echo $page_count;
$k_limit = $page_count - $m;
//echo $k_limit;
for($k=0;$k<$k_limit;$k++) {
?>
									<input type="hidden" name="no" value=" "/>
									<input type="hidden" name="pay_name" value=" "/>
									<input type="hidden" name="ssnb" value=" "/>
									<input type="hidden" name="sdate" value=" "/>
									<input type="hidden" name="ypay" value=" "/>
									<input type="hidden" name="month" value=" "/>
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
<script language="javascript" src="js/total_pay_health.js"></script>
</body>
</html>
