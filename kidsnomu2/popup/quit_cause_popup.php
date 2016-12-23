<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0096)http://www.4insure.or.kr/ins4/ptl/ptcp/clnt/popup/ClntCommPopupSrchP.do -->
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<META content="IE=7.0000" http-equiv="X-UA-Compatible">
<META content="text/html; charset=ks_c_5601-1987" http-equiv="Content-Type">
<META content="IE=7 http-equiv=X-UA-Compatible">
<META content="text/css http-equiv=Content-Style-Type">
<TITLE>퇴직사유</TITLE>
<LINK rel="stylesheet" type="text/css" href="images/default.css">
<LINK rel="stylesheet" type="text/css" href="images/pko.css">
<SCRIPT type="text/javascript" src="images/jquery-1.5.2.min.js"></SCRIPT>
<SCRIPT type="text/javascript" src="images/jquery.maskedinput-1.3.min.js"></SCRIPT>
<?
if(!$_GET['n']) $n = "";
else $n = $_GET['n'];
?>
<SCRIPT type="text/javascript">
$(function(){
	var nhicRowNum = "null";
	var rowNum     = "null";
	$("input[name='select01']").click(function() { 
			var i = $("input[name='select01']").index(this); 
			var value = $("input[name='select01']").eq(i).val();
			if( rowNum != "null" && nhicRowNum != "null" ){

			}else{
				$('#quit_cause<?=$n?>',opener.document).val(value.split("_")[0]);
				$('#quit_cause_text<?=$n?>',opener.document).val(value.split("_")[1]);
				self.close();
			}
	}); 
	$("#searchKeyword").focus();
});
function win_close(){
	window.close();
}
</SCRIPT>
<META name=GENERATOR content="MSHTML 10.00.9200.16686"></HEAD>
<BODY onload=""><!-- width:540px, height:650px -->
<DIV 
style="BORDER-TOP: black 0px solid; BORDER-RIGHT: black 0px solid; BORDER-BOTTOM: black 0px solid; TEXT-ALIGN: left; BORDER-LEFT: black 0px solid; WIDTH: 540px">
<DIV id=popup class=width540 style="BORDER-TOP: blue 0px solid; BORDER-RIGHT: blue 0px solid; BORDER-BOTTOM: blue 0px solid; BORDER-LEFT: blue 0px solid">
<H1><IMG alt="직종코드3(139종 신 KECO 코드, 고용,산재)(실제 138개) 검색" 
src="images/D107.gif"></H1>
<P class=logoBg><IMG alt="4대사회보험 정보연계센터" src="images/logoBg.gif"></P>
<p>※ Ctrl + F 단축키로 빠른 검색이 가능합니다.</p>
<P class=full>전체 <SPAN>138</SPAN>개</P>
<TABLE class=skyTable width="100%" summary="피부양자 자격취득부호(건강) 검색 조회결과(코드,명칭)">
  <CAPTION>4대사회보험 정보연계센터 - 비고 검색</CAPTION>
  <COLGROUP>
  <COL width="11%">
  <COL width="12%">
  <COL></COLGROUP>
  <THEAD>
		<TR>
			<TH scope=col>선택</TH>
			<TH scope=col>코드</TH>
			<TH scope=col>명칭</TH>
		</TR>
	</THEAD>
</TABLE>
<div style="overflow:auto;overflow-x:hidden;height:470px">
<TABLE class=skyTable2 width="100%" summary="피부양자 자격취득부호(건강) 검색 조회결과(코드,명칭)">
  <CAPTION>4대사회보험 정보연계센터 - 비고 검색</CAPTION>
  <COLGROUP>
  <COL width="11%">
  <COL width="12%">
  <COL></COLGROUP>
  <TBODY>
  <TR>
    <TD class="alignC"><INPUT title="코드선택" class="select01" type="radio" value="11_개인사정으로 인한 자진퇴사" name="select01"></TD>
    <TD class="alignC">11</TD>
    <TD>개인사정으로 인한 자진퇴사</TD></TR>
  <TR>
    <TD class="alignC"><INPUT title="코드선택" class="select01" type="radio" value="12_사업장 이전, 근로조건변동, 임금체불 등으로 자진퇴사" name="select01"></TD>
    <TD class="alignC">12</TD>
    <TD>사업장 이전, 근로조건변동, 임금체불 등으로 자진퇴사</TD></TR>
  <TR>
    <TD class="alignC"><INPUT title="코드선택" class="select01" type="radio" value="22_폐업, 도산으로 인한 퇴직" name="select01"></TD>
    <TD class="alignC">22</TD>
    <TD>폐업, 도산으로 인한 퇴직</TD></TR>
  <TR>
    <TD class="alignC"><INPUT title="코드선택" class="select01" type="radio" value="23_경영상 필요 및 회사불황으로 인한감축 퇴사(실업급여)" name="select01"></TD>
    <TD class="alignC">23</TD>
    <TD>경영상 필요 및 회사불황으로 인한감축 퇴사(<span style="color:red;">실업급여</span>)</TD></TR>
  <TR>
    <TD class="alignC"><INPUT title="코드선택" class="select01" type="radio" value="26_근로자의 귀책사유에 의한 징계해고, 권고사직" name="select01"></TD>
    <TD class="alignC">26</TD>
    <TD>근로자의 귀책사유에 의한 징계해고</TD></TR>
		<!--, 권고사직 삭제 임현미, 김국진 요청 160603-->
  <TR>
    <TD class="alignC"><INPUT title="코드선택" class="select01" type="radio" value="31_정년으로 인한 퇴직" name="select01"></TD>
    <TD class="alignC">31</TD>
    <TD>정년으로 인한 퇴직</TD></TR>
  <TR>
    <TD class="alignC"><INPUT title="코드선택" class="select01" type="radio" value="32_계약만료, 공사종료" name="select01"></TD>
    <TD class="alignC">32</TD>
    <TD>계약만료, 공사종료</TD></TR>
  <TR>
    <TD class="alignC"><INPUT title="코드선택" class="select01" type="radio" value="41_고용보험 비적용, 이중고용" name="select01"></TD>
    <TD class="alignC">41</TD>
    <TD>고용보험 비적용, 이중고용</TD></TR>
	</TBODY>
</TABLE>
</div>

<P class=close><A onclick="win_close();event.returnValue = false;" href="#"><IMG alt=닫기 src="images/btn_close.gif"></A></P>
<DIV style="HEIGHT: 10px"></DIV></DIV></DIV></BODY></HTML>
