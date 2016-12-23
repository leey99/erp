<?
$sub_menu = "700102";
$now_date = date("Y.m.d");

//공통 변수 로딩
include_once("./_common.php");
$sql_common = " from business_log a ";
$sql_search = " where a.id='$id' ";

if(!$sst) {
    $sst = "a.id";
    $sod = "desc";
}

$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$top_sub_title = "images/top07_01_02.png";
$sub_title = "근태신청";
$doc_code = 2;

$g4['title'] = $sub_title." : 그룹웨어 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
//echo $sql;
$result = sql_query($sql);
//echo $row[id];

$colspan = 11;

if($w == "u") {
	$row=mysql_fetch_array($result);
	//DB 옵션
	//$sql_opt = " select * from job_time_opt where id='$id' ";
	//echo $sql1;
	//$result_opt = sql_query($sql_opt);
	//$row_opt=mysql_fetch_array($result_opt);
}

//검색 파라미터 전송
$qstr = "stx_comp_name=".$stx_comp_name."&stx_upjong=".$stx_upjong."&stx_boss_name=".$stx_boss_name;
$qstr .= "&stx_process=".$stx_process."&stx_joindt=".$stx_joindt;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
	<title><?=$g4['title']?></title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
	<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
	<script type="text/javascript"  src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<script type="text/javascript"  src="./js/jquery-1.8.0.min.js" charset="euc-kr"></script>
<script type="text/javascript">
//<![CDATA[
function checkData(id) {
	var frm = document.dataForm;
	if(frm.manage_cust_name.value == "") {
		alert("기안자를 입력하세요.");
		frm.manage_cust_name.focus();
		return;
	}
	if(frm.subject.value == "") {
		alert("제목을 입력하세요.");
		frm.subject.focus();
		return;
	}
	if(frm.attendance_date.value == "") {
		alert("일자를 입력하세요.");
		frm.attendance_date.focus();
		return;
	}
	//결근사유서, 기타사유서 제외 시간 필수값
	if(frm.v_code.value != "5" && frm.v_code.value != "6") {
		if(frm.attendance_time.value == "") {
			alert("시간을 입력하세요.");
			frm.attendance_time.focus();
			return;
		}
	}
	if(frm.memo.value == "") {
		alert("사유를 입력하세요.");
		frm.memo.focus();
		return;
	}
	if(id == "report") frm.report_bt.value = 1;
	frm.action = "groupware_attendance_report_update.php";
	frm.submit();
	return;
}
function radio_chk(x,t){
	var count=0;
	for(i=0;i<x.length;i++){
		if(x[i].checked){
			count += 1;
			radio_name_val = x[i].value; 
		}
	}
	if(count == 0){
		alert(t+" 선택해 주세요.");
		return rv = 0;
	}else{
		//alert(radio_name_val);
		return rv = 1;
	}
}
function only_number() {
	//키보드 상단 숫자키
	if (event.keyCode < 48 || event.keyCode > 57) {
		//키보드 우측 숫자키
		if (event.keyCode < 95 || event.keyCode > 105) {
			//del 46 , backsp 8 , left 37 , right 39 , tab 9 , shift 16
			if(event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39 && event.keyCode != 9 && event.keyCode != 16) {
				event.preventDefault ? event.preventDefault() : event.returnValue = false;
			}
		}
	}
}
function only_number_hyphen() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if (event.keyCode < 95 || event.keyCode > 105) {
			//hyphen 109 , del 46 , backsp 8 , left 37 , right 39 , tab 9 , shift 16
			if(event.keyCode != 109 && event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39 && event.keyCode != 9 && event.keyCode != 16) {
				event.preventDefault ? event.preventDefault() : event.returnValue = false;
			}
		}
	}
}
function only_number_comma() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if (event.keyCode < 95 || event.keyCode > 105) {
			//comma 110 , del 46 , backsp 8 , left 37 , right 39 , tab 9 , shift 16
			if(event.keyCode != 110 && event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39 && event.keyCode != 9 && event.keyCode != 16) {
				event.preventDefault ? event.preventDefault() : event.returnValue = false;
			}
		}
	}
}
//]]>
</script>
<?
$mb_id = $member['mb_id'];
$sql_manage = " select * from a4_manage where state=1 and user_id='$mb_id' ";
$result_manage = sql_query($sql_manage);
$row_manage = mysql_fetch_array($result_manage);
$damdang_code_no = $row_manage['belong'];
//관리자일 경우 본사 코드 사용 160414
if($mb_id == "master") $damdang_code_no = 1;

//제목 문구
//부서
$dept_code = $row_manage['dept_code'];
$dept_name = $dept_code_arry[$dept_code];
//제목 뒷 문구
$subject_end = " ".$dept_name." ".$row_manage['name']." 근태신청서";

if(!$w) {
	$row['drafter_code'] = $row_manage['code'];
	$row['drafter_name'] = $row_manage['name'];
	//신규 등록 시 현재 날짜 표시
	$row['subject_date'] = $now_date;
	$now_date_arry = explode(".", $now_date);
	$row['subject'] = $now_date_arry[0]."년 ".$now_date_arry[1]."월 ".$now_date_arry[2]."일".$subject_end;
}
?>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<script type="text/javascript">
//<![CDATA[
function loadCalendar( obj )
{
	var calendar = new Calendar(0, null, onSelect, onClose);
	calendar.create();
	calendar.parseDate(obj.value);
	calendar.showAtElement(obj, "Br");

	function onSelect(calendar, date)
	{
		var input_field = obj;
		input_field.value = date;
		if (calendar.dateClicked) {
			calendar.callCloseHandler();
		}
		//기안일 수정 시 제목에 날짜(년 월 일) 근태신청서 입력
		if(obj.name == "subject_date") subject_date_change(date);
	};

	function onClose(calendar)
	{
		calendar.hide();
		calendar.destroy();
	};
}
function findNomu(branch,kind) {
	var ret = window.open("pop_manage_cust.php?search_belong="+branch+"&amp;kind="+kind, "pop_nomu_cust", "top=100, left=100, width=800,height=600, scrollbars");
	return;
}
//숫자/영문만
function only_number_english() {
	if (event.keyCode < 48 || (event.keyCode > 57 && event.keyCode < 97) || (event.keyCode > 122)) event.returnValue = false;
}
//사업게시일 입력 콤마
function checkcomma(inputVal, type, keydown) {		// inputVal은 천단위에 , 표시를 위해 가져오는 값
	var main = document.dataForm;			// 여기서 type 은 해당하는 값을 넣기 위한 위치지정 index
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
	input = delcomma(inputVal, inputVal.length);
	//관리자 master 입력
	//alert(input);
	if(1 == 1) { // 모두 포함
		//백스페이스키 적용
		if(event.keyCode != 8) {
			//alert(inputVal.length);
			//alert(input);
			if(inputVal.length == 4){
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,4)+".";
			} else if(inputVal.length == 7){
				total += inputVal.substring(0,7)+".";
			} else if(inputVal.length == 12){
				total += inputVal.substring(0,14)+"";
			} else {
				total += inputVal;
			}
			if(keydown =='Y'){
				type.value=total;
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
}
function delcomma(inputVal, count){
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!='.'){		// 먼저 substring을 위해
			tmp += inputVal.substring(i,i+1);	// 값의 모든 , 를 제거
		}
	}
	return tmp;
}
//천단위 콤바
function checkThousand(inputVal, type, keydown) {
	main = document.dataForm;
	var chk		= 0;
	var share	= 0;
	var start	= 0;
	var triple	= 0;
	var end		= 0;
	var total	= "";			
	var input	= "";
	//탭 시프트+탭 좌 우 Home
	if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36) {
		if (inputVal.length > 3) {
			input = delCom(inputVal, inputVal.length);
			chk = (input.length)/3;
			chk = Math.floor(chk);
			share = (input.length)%3;
			if (share == 0 ) {						
				chk = chk - 1;
			}
			for(i=chk; i>0; i--) {
				triple = i * 3;
				end = Number(input.length)-Number(triple);
				total += input.substring(start,end)+",";
				start = end;
			}
			total +=input.substring(start,input.length);
		} else {
			total = inputVal;
		}
		if(keydown =='Y') {
			type.value=total;
		}else if(keydown =='N') {
			return total
		}
		return total
	}
}
function delCom(inputVal, count) {
	var tmp = "";
	for(i=0; i<count; i++) {
		if(inputVal.substring(i,i+1)!=',') {
			tmp += inputVal.substring(i,i+1);
		}
	}
	return tmp;
}
function field_add(div_id) {
	var v2 = document.getElementById(div_id+'2');
	var v3 = document.getElementById(div_id+'3');
	var v4 = document.getElementById(div_id+'4');
	if(v2.style.display == "none") {
		v2.style.display = "";
	} else {
		if(v3.style.display == "none") {
			v3.style.display = "";
		} else {
			if(v4.style.display == "none") {
				v4.style.display = "";
			} else {
				alert("최대 8개까지 추가 가능합니다.");
			}
		}
	}
}
//스케줄 거래처 검색
function schedule_com_find() {
	alert("준비중입니다.");
}
//기안일 수정 시 제목 변경 160419
function subject_date_change(date) {
	var frm = document.dataForm;
	var date_kor_arry = date.split(".");
	var date_kor = date_kor_arry[0]+"년 "+date_kor_arry[1]+"월 "+date_kor_arry[2]+"일<?=$subject_end?>";
	frm.subject.value = date_kor;
	//스케줄 iframe src 변경
	getId("popup_schedule_iframe_today").src = "popup_schedule.php?manage_code=<?=$row['drafter_code']?>&search_sday="+date+"&today_chk=1";
	getId("popup_schedule_iframe").src = "popup_schedule.php?manage_code=<?=$row['drafter_code']?>&search_sday="+date;
}
//]]>
</script>
<?
if( ($member['mb_profile'] >= 110 && $member['mb_profile'] <= 200) || $member['mb_level'] == 4 ) include "inc/top_dealer.php";
else include "inc/top.php";
$is_damdang = "ok";
$url_list = "groupware_business_log.php";
?>
		<td onmouseover="showM('900')" valign="top">
			<div style="margin:10px 20px 20px 20px;min-height:480px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100"><img src="images/top07.gif" border="0" alt="그룹웨어" /></td>
						<td><a href="<?=$url_list?>"><img src="<?=$top_sub_title?>" border="0" alt="<?=$sub_title?>" /></a></td>
						<td></td>
					</tr>
					<tr><td colspan="3" style="background:#cccccc;height:1px;"></td></tr>
				</table>
				<table width="900" border="0" align="left" cellpadding="0" cellspacing="0" >
					<tr>
						<td valign="top" style="padding:10px 0 0 0;">
							<form name="dataForm" method="post" enctype="MULTIPART/FORM-DATA">
								<input type="hidden" name="dept_code" value="<?=$dept_code?>" />
								<input type="hidden" name="doc_code" value="<?=$doc_code?>" />
								<input type="hidden" name="report_bt" value="" />
								<!--입력폼-->
								<table border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td> 
											<table border="0" cellpadding="0" cellspacing="0">
												<tr> 
													<td><img src="images/g_tab_on_lt.gif" alt="[" /></td> 
													<td class="Sftbutton_white" style="background:url('images/g_tab_on_bg.gif');width:90px;text-align:center;"> 
														기본정보
													</td> 
													<td><img src="images/g_tab_on_rt.gif" alt="]" /></td> 
												</tr> 
											</table> 
										</td> 
										<td width="2"></td> 
										<td valign="bottom"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--댑메뉴 -->
								<table border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="width:100%;height:200px;">
									<tr>
										<td class="tdrowk" width="96"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />기안자<font color="red">*</font></td>
										<td class="tdrow" colspan="3">
											<input type="text" name="manage_cust_numb" class="textfm" style="float:left;width:34px;background:#bbbbbb;" readonly value="<?=$row['drafter_code']?>">
											<input type="text" name="manage_cust_name" class="textfm" style="float:left;width:82px;background:#bbbbbb;" readonly value="<?=$row['drafter_name']?>">
											<table border="0" cellpadding="0" cellspacing="0" style="float:left;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white nowrap"><a href="javascript:findNomu(<?=$damdang_code_no?>,1);" target="">검색</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />제목<font color="red">*</font></td>
										<td class="tdrow" colspan="3">
											<input name="subject" type="text" class="textfm" style="width:300px;ime-mode:active;vertical-align:middle;float:left;background:#dddddd;" readonly value="<?=$row['subject']?>" maxlength="100" />
											<input name="subject_date" type="text" class="textfm" style="width:78px;ime-mode:disabled;float:left;background:#dddddd;" readonly value="<?=$row['subject_date']?>" />
											<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')" class="ftbutton3_white"><a href="javascript:loadCalendar(document.dataForm.subject_date);">달력</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
											<div style="margin:4px 0 0 8px;float:left;">※ 기안일 수정은 달력을 클릭 후 날짜를 설정하면 됩니다.</div>
										</td>
									</tr>
									<tr>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />결재라인<font color="red">*</font></td>
										<td class="tdrow" colspan="3">
<?
//결재라인
$sql_approval = " select * from business_approval where code='$row[drafter_code]' ";
$result_approval = sql_query($sql_approval);
$row_approval = mysql_fetch_array($result_approval);
$approval_cnt = 0;
for($i=1;$i<=5;$i++) {
	$approval[$i] = $row_approval['approval'.$i];
	//반려일 경우 싸인 대신 반려 표시
	if($row['approval'.$i.'_process'] == 3) $approval_sign[$i] = "return";
	else $approval_sign[$i] = $approval[$i];
	//결재일시
	$approval_time[$i] = $row['approval'.$i.'_time'];
	//직위
	$sql_position = " select position from a4_manage where user_id='$approval[$i]' and state=1 ";
	//echo $sql_position;
	$result_position = sql_query($sql_position);
	$row_position = mysql_fetch_array($result_position);
	$position[$i] = $row_position['position'];
	if($approval[$i]) {
		$approval_cnt ++;
?>
											<div style="width:80px;height:70px;border-right:1px solid #cccccc;text-align:center;float:left;">
												<input type="hidden" name="approval_<?=$i?>" value="<?=$approval[$i]?>" />
												<input type="hidden" name="approval<?=$i?>_process" value="<?=$row['approval'.$i.'_process']?>" />
												<?=$position[$i]?><br />
<?
		if($row['approval'.$i.'_time']) {
?>
												<img src="images/sign_<?=$approval_sign[$i]?>.png" title="<?=$approval_time[$i]?>" />
<?
		}
?>
											</div>
<?
	}
}
?>
											<input type="hidden" name="approval_cnt" value="<?=$approval_cnt?>" />
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />종류<font color="red">*</font></td>
										<td class="tdrow" colspan="3">
											<select name="v_code" class="selectfm">
<?
for($m=1;$m<count($attendance_report_kind_arry);$m++) {
?>
												<option value="<?=$m?>" <? if($row['v_code'] == $m) echo "selected"; ?> ><?=$attendance_report_kind_arry[$m]?></option>
<?
}
?>

											</select>
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />일자<font color="red">*</font></td>
										<td class="tdrow" width="170">
											<div style="float:left;">
												<input name="attendance_date" type="text" class="textfm" style="width:78px;ime-mode:disabled;float:left;background:#dddddd;" readonly value="<?=$row['work_forenoon']?>" />
												<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')" class="ftbutton3_white"><a href="javascript:loadCalendar(document.dataForm.attendance_date);">달력</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
											</div>
										</td>
										<td class="tdrowk" width="96"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />시간<font color="red">*</font></td>
										<td class="tdrow" width="300">
											<input type="text" name="attendance_time" value="<?=$row['work_afternoon']?>" class="textfm" style="width:120px;ime-mode:disabled;vertical-align:middle;" />
											※ 훈련, 조퇴, 외출, 지각 시 필수값입니다.
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />사유<font color="red">*</font></td>
										<td class="tdrow" colspan="3">
											<textarea name="memo" class="textfm" style='width:100%;height:152px;word-break:break-all;'><?=$row['memo']?></textarea>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>

								<div style="height:30px;font-size:0px;text-align:center;margin-top:10px;" id="btn_new_client_register">
									<a href="#submitTemp"   onclick="checkData('temp');  return false;" onkeypress="this.onclick;" style="margin-left:0;"   ><img src="images/btn_temp_save_big.png" width="78" height="30" border="0" /></a>
<?
//이미 상신 상태이거나 결재라인의 결재자 중 한명이라도 결재를 한 경우 상신 버튼 숨김
if($report_chk != 1) {
?>
									<a href="#submitReport" onclick="checkData('report');return false;" onkeypress="this.onclick;" style="margin-left:10px;"><img src="images/btn_report_big.png"    width="78" height="30" border="0" /></a>
<?
}
?>
									<a href="groupware_business_log.php?<?=$qstr?>" style="margin-left:10px;"><img src="images/btn_list_big.png" border="0" /></a>
								</div>
								<div style="height:20px;font-size:0px"></div>
								<input type="hidden" name="w" value="<?=$w?>" />
								<input type="hidden" name="id" value="<?=$id?>" />
								<input type="hidden" name="page" value="<?=$page?>" />
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
