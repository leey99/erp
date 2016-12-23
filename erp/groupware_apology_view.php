<?
$sub_menu = "700103";

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

$top_sub_title = "images/top07_01_03.png";
$sub_title = "시말서";
$doc_code = 3;

$g4['title'] = $sub_title." : 그룹웨어 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
//echo $sql;
$result = sql_query($sql);
//echo $row[id];

$row_log = mysql_fetch_array($result);

for($i=1; $i<=8; $i++) {
	$filename[$i] = $row_log['filename_'.$i];
}

//검색 파라미터 전송
$qstr  = "search_dept=".$search_dept."&amp;stx_me_chk=".$stx_me_chk."&amp;stx_process=".$stx_process."&amp;stx_doc_type=".$stx_doc_type;
$qstr .= "&amp;stx_manage_name=".$stx_manage_name."&amp;stx_search_day_chk=".$stx_search_day_chk."&amp;search_sday=".$search_sday."&amp;search_eday=".$search_eday;
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
function checkID() {
	var frm = document.dataForm;
	if (frm.comp_bznb.value == "")
	{
		alert("사업자번호를 입력하세요.");
		frm.comp_bznb.focus();
		return;
	}
	var ret = window.open("./common/member_idcheck.php?user_id="+frm.comp_bznb.value, "id_check", "top=100, left=100, width=395,height=240");
	return;
}
function checkAddress(strgbn)
{
	//var ret = window.open("./common/member_address.php?frm_name=dataForm&frm_zip1=adr_zip1&frm_zip2=adr_zip2&frm_addr1=adr_adr1&frm_addr2=adr_adr2", "address", "top=100, left=100, width=410,height=285, scrollbars");
	var ret = window.open("../road_address/search.php", "address", "width=496,height=522,scrollbars=0");
	return;
}
function id_copy() {
	var frm = document.dataForm;
	frm.user_id.value = frm.comp_bznb.value;
}
function checkData() {
	var frm = document.dataForm;
	if (frm.manage_cust_name.value == "") {
		alert("기안자를 입력하세요.");
		frm.manage_cust_name.focus();
		return;
	}
	if (frm.subject.value == "") {
		alert("제목을 입력하세요.");
		frm.subject.focus();
		return;
	}
	if (frm.approval_1.value == "") {
		alert("결재라인을 입력하세요.");
		return;
	}
	frm.action = "groupware_business_update.php";
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
//결재 버튼
function btn_approval(no) {
<?
//결재자가 이미 결재했을 경우 알림 메시지 표시
if($row_log['approval1'] == $member['mb_id'] ) $approval_no = 1;
if($row_log['approval2'] == $member['mb_id'] ) $approval_no = 2;
if($row_log['approval3'] == $member['mb_id'] ) $approval_no = 3;
if($row_log['approval4'] == $member['mb_id'] ) $approval_no = 4;
if($row_log['approval5'] == $member['mb_id'] ) $approval_no = 5;
if($row_log['approval'.$approval_no.'_process'] == 2) $approved = "ok";
if($approved == "ok") echo "alert('이미 결재하셨습니다.');return;";
?>
	var frm = document.dataForm;
	if(confirm("정말 결재하시겠습니까?")) {
		frm['approval_no'].value = no;
		frm['approval'+no+'_process'].value = 2;
		frm.action="groupware_business_approval.php";
		frm.submit();
	} else {
		return;
	}
}
//반려 버튼
function btn_return(no) {
<?
if($row_log['approval'.$approval_no.'_process'] == 3) $approved = "return";
if($approved == "return") echo "alert('이미 반려하셨습니다.');return;";
?>
	var frm = document.dataForm;
	if(confirm("정말 반려하시겠습니까?")) {
		frm['approval_no'].value = no;
		frm['approval'+no+'_process'].value = 3;
		frm.action="groupware_business_return.php";
		frm.submit();
	} else {
		return;
	}
}
//]]>
</script>
<?
if( ($member['mb_profile'] >= 110 && $member['mb_profile'] <= 200) || $member['mb_level'] == 4 ) include "inc/top_dealer.php";
else include "inc/top.php";
//$is_damdang = "ok";
$url_list = "groupware_business_log.php";
?>
		<td onmouseover="showM('900')" valign="top">
			<div style="margin:10px 20px 20px 20px;min-height:480px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100"><img src="images/top07.gif" border="0" alt="그룹웨어" /></td>
						<td><a href="<?=$url_list?>"><img src="<?=$top_sub_title?>" border="0" alt="업무일지" /></a></td>
						<td></td>
					</tr>
					<tr><td colspan="3" style="background:#cccccc;height:1px;"></td></tr>
				</table>
				<table width="900" border="0" align="left" cellpadding="0" cellspacing="0" >
					<tr>
						<td valign="top" style="padding:10px 0 0 0;">
							<form name="dataForm" method="post" enctype="MULTIPART/FORM-DATA">
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
								<table border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed;width:100%;height:200px;">
									<tr>
										<td class="tdrowk" width="96"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />기안자<font color="red"></font></td>
										<td class="tdrow" width="170">
											<?=$row_log['drafter_name']?>
										</td>
										<td class="tdrowk" width="96"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />제목<font color="red"></font></td>
										<td class="tdrow">
											<?=$row_log['subject']?>
										</td>
									</tr>
									<tr>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />결재라인<font color="red"></font></td>
										<td class="tdrow" colspan="3">
<?
//결재라인
$sql_approval = " select * from business_approval where code='$row_log[drafter_code]' ";
$result_approval = sql_query($sql_approval);
$row_approval = mysql_fetch_array($result_approval);
for($i=1;$i<=5;$i++) {
	$approval[$i] = $row_approval['approval'.$i];
	//반려일 경우 싸인 대신 반려 표시
	if($row_log['approval'.$i.'_process'] == 3) $approval_sign[$i] = "return";
	else $approval_sign[$i] = $approval[$i];
	//결재일시
	$approval_time[$i] = $row_log['approval'.$i.'_time'];
	//직위
	$sql_position = " select position from a4_manage where user_id='$approval[$i]' and state=1 ";
	//echo $sql_position;
	$result_position = sql_query($sql_position);
	$row_position = mysql_fetch_array($result_position);
	$position[$i] = $row_position['position'];
	//결재 또는 반려일 경우 싸인, 반려 표시
	if($approval[$i]) {
?>
											<div style="width:80px;height:70px;border-right:1px solid #cccccc;text-align:center;float:left;">
												<input type="hidden" name="approval_<?=$i?>" value="<?=$approval[$i]?>" />
												<input type="hidden" name="approval<?=$i?>_process" value="<?=$row_log['approval'.$i.'_process']?>" />
												<?=$position[$i]?><br />
<?
		if($row_log['approval'.$i.'_time']) {
			//결재, 반려시 결재완료 변수 설정
			$report_chk = 1;
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
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />개요</td>
										<td class="tdrow" colspan="3">
<?
//시말서 개요
$sql_business_form = " select * from business_form where mb_id='apology' ";
$result_business_form = sql_query($sql_business_form);
$row_business_form = mysql_fetch_array($result_business_form);
echo $row_business_form['memo'];
?>
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />위반내용<br /><img src="./images/blank.gif" width="7" height="2" />(상세기술)</td>
										<td class="tdrow" colspan="3">
<?
if($row_log['memo']) echo "<pre style='word-wrap:break-word;white-space:pre-wrap;white-space:-moz-pre-wrap;white-space:-pre-wrap;white-space:-o-pre-wrap;word-break:break-all;'>".$row_log['memo']."</pre>";
?>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>

								<table border="0" cellspacing="0" cellpadding="0"> 
									<tr>
										<td> 
											<table border="0" cellpadding="0" cellspacing="0"> 
												<tr> 
													<td><img src="images/so_tab_on_lt.gif" alt="[" /></td> 
													<td class="Sftbutton_white" style="background:url('images/so_tab_on_bg.gif');width:100px;text-align:center;">
														전달사항
													</td> 
													<td><img src="images/so_tab_on_rt.gif" alt="]" /></td> 
												</tr> 
											</table> 
										</td> 
										<td width=2></td> 
										<td valign="bottom"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="botr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!-- 입력폼 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1">
									<tr>
										<td class="tdrow">
<script type="text/javascript">
//<![CDATA[
function resizeFrame(frm) {
	frm.style.height = "auto";
	contentHeight = frm.contentWindow.document.documentElement.scrollHeight;
	frm.style.height = contentHeight + 0 + "px";
}
//]]>
</script>
<?
$sql_manage = " select * from a4_manage where code='$row_log[drafter_code]' ";
//echo $sql_manage;
$result_manage = sql_query($sql_manage);
$row_manage = mysql_fetch_array($result_manage);
$drafter_id = $row_manage['user_id'];
//문서구분
$memo_type = $row_log['doc_code'];
if(!$memo_type) $memo_type = 1;
$popup_business_log_memo_url = "popup_business_log_memo.php?id=".$id."&amp;drafter_id=".$drafter_id."&amp;position1=".$position[1]."&amp;position2=".$position[2]."&amp;position3=".$position[3]."&amp;position4=".$position[4]."&amp;position5=".$position[5];
$popup_business_log_memo_url .= "&amp;approval1=".$row_log['approval1']."&amp;approval2=".$row_log['approval2']."&amp;approval3=".$row_log['approval3']."&amp;approval4=".$row_log['approval4']."&amp;approval5=".$row_log['approval5'];
$popup_business_log_memo_url .= "&amp;memo_type=".$memo_type;
?>
											<iframe id="popup_business_log_memo_iframe" src="<?=$popup_business_log_memo_url?>" frameborder="0" width="100%" height="100" onload="resizeFrame(this)" scrolling="no" style="margin:10px 0 0 0"></iframe>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>

								<div style="height:30px;font-size:0px;text-align:center;margin-top:10px;" id="btn_new_client_register">
<?
//기안자 본인일 경우 수정 버튼 표시 160420
$mb_id = $member['mb_id'];
$sql_manage = " select * from a4_manage where state=1 and user_id='$mb_id' ";
//echo $sql_manage;
$result_manage = sql_query($sql_manage);
$row_manage = mysql_fetch_array($result_manage);
$drafter_code = $row_manage['code'];
if($row_log['drafter_code'] == $drafter_code) {
	$modify_url = "groupware_apology_write.php?id=".$id."&w=u&page=".$page."&".$qstr;
	//결재라인 결재가 존재할 경우 수정 불가 160425
	if($report_chk == 1) {
		$modify_url = "javascript:alert('이미 결재가 된 기안서는 수정이 불가능합니다.');";
	}
?>
									<a href="<?=$modify_url?>"><img src="images/btn_modify_big.png" border="0" /></a>
<?
}

//결재자일 경우 결재, 반려 버튼 표시
if($row_log['approval1'] == $mb_id ) $approval_no = 1;
if($row_log['approval2'] == $mb_id ) $approval_no = 2;
if($row_log['approval3'] == $mb_id ) $approval_no = 3;
if($row_log['approval4'] == $mb_id ) $approval_no = 4;
if($row_log['approval5'] == $mb_id ) $approval_no = 5;
echo $row_log['approval3'];
if($row_log['approval1'] == $mb_id || $row_log['approval2'] == $mb_id || $row_log['approval3'] == $mb_id || $row_log['approval4'] == $mb_id || $row_log['approval5'] == $mb_id) {
?>
									<a href="javascript:btn_approval(<?=$approval_no?>);"><img src="images/btn_approval_big.png" border="0" /></a>
									<a href="javascript:btn_return(<?=$approval_no?>);" style="margin-left:10px;"><img src="images/btn_return_big.png" border="0" /></a>
<?
}
?>
									<a href="groupware_business_log.php?<?=$qstr?>" style="margin-left:10px;"><img src="images/btn_list_big.png" border="0" /></a>
								</div>
								<div style="height:20px;font-size:0px"></div>
								<input type="hidden" name="w" value="<?=$w?>" />
								<input type="hidden" name="id" value="<?=$id?>" />
								<input type="hidden" name="page" value="<?=$page?>" />
								<input type="hidden" name="approval_no" value="" />
								<input type="hidden" name="qstr" value="<?=$qstr?>" />
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
