<?
$mode = "popup";
$member['mb_id'] = "test";
include_once("./_common.php");
if($frm == 2) {
	$sql_common = " from total_pay ";
} else {
	$sql_common = " from total_pay ";
}
//echo $id;
$sql_search = " where id='$id' ";

$sub_title = "이메일 발송";
$g4[title] = $sub_title." : 팝업 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";

//echo $sql;
$result = sql_query($sql);

$colspan = 11;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0096)http://www.4insure.or.kr/ins4/ptl/ptcp/clnt/popup/ClntCommPopupSrchP.do -->
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD><META content="IE=7.0000" 
http-equiv="X-UA-Compatible">
<TITLE><?=$g4[title]?></TITLE>
<META content="text/html; charset=ks_c_5601-1987" http-equiv=Content-Type>
<META content="IE=7 http-equiv=X-UA-Compatible">
<META content="text/css http-equiv=Content-Style-Type">
<LINK rel=stylesheet type=text/css href="images/default.css">
<LINK rel=stylesheet type=text/css href="images/pko.css">
<SCRIPT type=text/javascript src="images/jquery-1.5.2.min.js"></SCRIPT>
<SCRIPT type=text/javascript src="images/jquery.maskedinput-1.3.min.js"></SCRIPT>
<?
if(!$n) $n = "";
?>
<SCRIPT type=text/javascript>
$(function(){
	var nhicRowNum = "null";
	var rowNum     = "null";
	$("input[name='select01']").click(function() { 
			var i = $("input[name='select01']").index(this); 
			var value = $("input[name='select01']").eq(i).val();
<?
if($frm == 2) {
?>			
			$('#comp_bznb2',opener.document).val(value.split("_")[0]);
			$('#comp_name2',opener.document).val(value.split("_")[1]);
			$('#comp_adr2', opener.document).val(value.split("_")[2]);
			$('#comp_tel2', opener.document).val(value.split("_")[3]);
			$('#comp_email2', opener.document).val(value.split("_")[4]);
			$('#comp_fax2', opener.document).val(value.split("_")[5]);
<?
} else {
?>
			$('#comp_bznb',opener.document).val(value.split("_")[0]);
			$('#comp_name',opener.document).val(value.split("_")[1]);
			$('#comp_adr', opener.document).val(value.split("_")[2]);
			$('#comp_tel', opener.document).val(value.split("_")[3]);
			$('#comp_email', opener.document).val(value.split("_")[4]);
			$('#comp_fax', opener.document).val(value.split("_")[5]);
<?
}
?>
			self.close();
	}); 
	
	if( rowNum != "null" && nhicRowNum != "null" ){
		//parent.iframe_focus(rowNum,nhicRowNum);
	}
	
	$("#searchKeyword").focus();
});

function win_close(){
	window.close();
}
function email_send() {
	var frm = document.dataForm;
	if(frm.comp_email.value == "") {
		alert("이메일 주소가 등록 되어 있지 않습니다.");
		return;
	}
	if(frm.file_name.value == "") {
		alert("첨부파일이 등록 되어 있지 않습니다.");
		return;
	}
	//발송 버튼 클릭 후 저장 중 이미지 표시
	document.getElementById('save_bt').style.display = "none";
	document.getElementById('save_ing').style.display = "inline";
	frm.action = "total_pay_email_send_update.php";
	frm.submit();
	return;
}
</SCRIPT>
<META name=GENERATOR content="MSHTML 10.00.9200.16686"></HEAD>
<BODY onload=""><!-- width:540px, height:650px -->
<DIV 
style="BORDER-TOP: black 0px solid; BORDER-RIGHT: black 0px solid; BORDER-BOTTOM: black 0px solid; TEXT-ALIGN: left; BORDER-LEFT: black 0px solid; WIDTH: 540px">
<DIV id=popup class=width540 style="BORDER-TOP: blue 0px solid; BORDER-RIGHT: blue 0px solid; BORDER-BOTTOM: blue 0px solid; BORDER-LEFT: blue 0px solid">
<H1><IMG alt="직종코드3(139종 신 KECO 코드, 고용,산재)(실제 138개) 검색" 
src="images/email_send_title.gif"></H1>
<P class=logoBg><IMG alt="4대사회보험 정보연계센터" src="images/logoBg.gif"></P>
<?
$row = mysql_fetch_array($result);
$t_no = $row[t_no];
$comp_bznb = $row[comp_bznb];
$comp_name = $row[comp_name];
$comp_email = $row[comp_email];
//코드
$code_var = $row[comp_bznb]."_".$row[comp_name]."_".$row[comp_adr]."_".$row[comp_tel]."_".$row[comp_email]."_".$row[comp_fax];
$w_date_array = explode(" ", $row[wr_datetime]);
$w_date = $w_date_array[0];
//메일 발송 여부
$email_ok = $row[email_ok];
if(!$email_ok) $email_ok = "-";
//첨부파일
$file_name = "".str_replace('-','',$t_no);
$upload_path = $_SERVER["DOCUMENT_ROOT"]."/total_pay_result";
$upfile_path = $upload_path."/".$file_name.".xls";
//echo file_exists($upfile_path);
if(file_exists($upfile_path)) {
	$file_ok = "<a href='/total_pay_result/".$file_name.".xls' target='_blank'>".$file_name.".xls</a>";
} else {
	$file_ok = "없음";
	$file_name = "";
}
?>
<p style="margin:0 0 10px">
	<form name="dataForm" method="post" style="margin:0">
		<input type="hidden" name="w" value="u">
		<input type="hidden" name="id" value="<?=$id?>">
		<input type="hidden" name="comp_bznb" value="<?=$comp_bznb?>">
		<input type="hidden" name="comp_name" value="<?=$comp_name?>">
		<input type="hidden" name="comp_email" value="<?=$comp_email?>">
		<input type="hidden" name="file_name" value="<?=$file_name?>">
		※ 사업자등록번호 : <?=$comp_bznb?> / 사업장관리번호 : <?=$row[t_no]?>

	</form>
</p>
<TABLE class=skyTable width="100%" summary="피부양자 자격취득부호(건강) 검색 조회결과(코드,명칭)">
  <CAPTION>4대사회보험 정보연계센터 - 비고 검색</CAPTION>
  <THEAD>
		<TR>
			<TH scope=col>사업장명</TH>
			<TH scope=col>이메일</TH>
			<TH scope=col>발송</TH>
			<TH scope=col>등록일자</TH>
		</TR>
	</THEAD>
  <TBODY>
  <TR>
    <TD class=alignC><?=$comp_name?></TD>
    <TD class=alignC><?=$comp_email?></TD>
    <TD class=alignC><?=$email_ok?></TD>
    <TD class=alignC><?=$w_date?></TD>
	</TR>
	</TBODY>
</TABLE>

<p style="margin:20px 0 0 0">
	※ 첨부파일  : <?=$file_ok?>
</p>

<div class=close>
	<div style="float:left;margin:0 10px 0 0">
		<div id="save_ing" style="display:none"><img src="images/send_ing.gif"></div>
		<div id="save_bt"><A onclick="email_send()" href="#"><IMG alt="발송" src="images/btn_send.gif"></A></div>
	</div>
	<div style="float:left">
		<A onclick="win_close();event.returnValue = false;" href="#"><IMG alt="닫기" src="images/btn_close.gif"></A>
	</div>
</div>
<DIV style="HEIGHT: 10px"></DIV></DIV></DIV></BODY></HTML>
