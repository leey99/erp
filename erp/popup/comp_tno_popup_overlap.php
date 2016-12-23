<?
include_once("./_common.php");
$sub_title = "사업장 검색";
$g4[title] = $sub_title." : 팝업 : ".$easynomu_name;

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
			//alert(value);
			opener.document.location.href = "../client_view.php?w=u&v=write&id="+value;
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
function search_comp() {
	var frm = document.dataForm;
	n = frm.comp_bznb.value;
	if(frm.comp_bznb.value == "") {
		alert("사업자등록번호를 입력 후 검색해 주십시오.");
		return;
	}
	location.href = "<?=$PHP_SELF?>?comp_bznb="+n;
}
</SCRIPT>
<META name=GENERATOR content="MSHTML 10.00.9200.16686"></HEAD>
<BODY onload=""><!-- width:540px, height:650px -->
<DIV 
style="BORDER-TOP: black 0px solid; BORDER-RIGHT: black 0px solid; BORDER-BOTTOM: black 0px solid; TEXT-ALIGN: left; BORDER-LEFT: black 0px solid; WIDTH: 540px">
<DIV id=popup class=width540 style="BORDER-TOP: blue 0px solid; BORDER-RIGHT: blue 0px solid; BORDER-BOTTOM: blue 0px solid; BORDER-LEFT: blue 0px solid">
<H1><IMG alt="직종코드3(139종 신 KECO 코드, 고용,산재)(실제 138개) 검색" 
src="images/D108.gif"></H1>
<P class=logoBg><IMG alt="4대사회보험 정보연계센터" src="images/logoBg.gif"></P>
<p style="margin:0 0 10px">
	<form name="dataForm" method="post" style="margin:0">
	※ 사업장관리번호
	<input name="tno" id="searchKeyword" type="text" class="textfm" style="width:110px;" value="<?=$tno?>" maxlength="14">
	<label onclick="search_comp();" style="cursor:pointer"><img src="../images/search_bt.png" align=absmiddle></label>
	예) 123-12-12345-0
	</form>
</p>
<div style="margin-bottom:10px">
<?
//사업장 코드
//echo $member['mb_level'];
if($member['mb_level'] > 6) {
	$sql_search = " where a.t_insureno = '$tno' ";
} else {
	$sql_search = " where a.t_insureno = '$tno' and ( a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]' ) ";
}
$sql = " select * from com_list_gy a $sql_search ";
//echo $sql;
$result = sql_query($sql);
?>
</div>
<TABLE class=skyTable width="100%" summary="피부양자 자격취득부호(건강) 검색 조회결과(코드,명칭)">
  <CAPTION>4대사회보험 정보연계센터 - 비고 검색</CAPTION>
  <COLGROUP>
  <COL width="11%">
  <COL width="40%"></COLGROUP>
  <COL></COLGROUP>
  <THEAD>
		<TR>
			<TH scope=col>선택</TH>
			<TH scope=col>사업장명</TH>
			<TH scope=col>전화번호</TH>
			<TH scope=col>대표자</TH>
		</TR>
	</THEAD>
  <TBODY>
<?
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$code_var = $row['com_code'];
?>
  <TR>
    <TD class=alignC><INPUT title=코드선택 class=select01 type=radio value="<?=$code_var?>" name=select01></TD>
    <TD class=alignC><?=$row['com_name']?></TD>
    <TD class=alignC><?=$row['com_tel']?></TD>
    <TD class=alignC><?=$row['boss_name']?></TD>
	</TR>
<?
}
?>
	</TBODY>
</TABLE>

<P class=close><A onclick="win_close();event.returnValue = false;" href="#"><IMG alt=닫기 src="images/btn_close.gif"></A></P>
<DIV style="HEIGHT: 10px"></DIV></DIV></DIV></BODY></HTML>
