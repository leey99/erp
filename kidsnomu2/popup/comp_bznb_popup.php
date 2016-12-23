<?
$mode = "popup";
$member['mb_id'] = "test";
include_once("./_common.php");
if($frm == 2) {
	$sql_common = " from a4_modify ";
} else {
	$sql_common = " from a4_4insure ";
}
$sql_search = " where comp_bznb='$comp_bznb' order by id desc ";

$sub_title = "사업장 검색";
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
	※ 사업자등록번호
	<input name="comp_bznb" id="searchKeyword" type="text" class="textfm" style="width:100px;" value="<?=$comp_bznb?>" maxlength="12">
	<label onclick="search_comp();" style="cursor:pointer"><img src="../images/search_bt.png" align=absmiddle></label>
	예) 123-12-12345
	</form>
</p>
<div style="margin-bottom:10px">
<?
//통합관리프로그램 DB
include_once("../../dbconfig_erp.php");
$db2 = mysql_connect($mysql_host,$mysql_user,$mysql_password);
mysql_select_db($mysql_db,$db2);
mysql_query(" set names euckr ");
//사업장 코드
$sql_a4 = " select * from com_list_gy where biz_no = '$comp_bznb' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4['com_code'];
if($com_code) {
	$sql_a4_opt = " select * from com_list_gy_opt where com_code = '$com_code' ";
	$row_a4_opt = sql_fetch($sql_a4_opt);
	$samu_req_yn = $row_a4_opt['samu_req_yn'];
	if($samu_req_yn == "4") $samu_text = "수임중";
	else $samu_text = "수임가능";
	//echo $sql_a4;
	//echo $com_code;
	echo "ㆍ사무위탁수임 : <b style='color:blue;'>".$samu_text."</b> (".$row_a4['com_name'].")<br>";
	if($samu_req_yn != "4") {
		echo "<div style='padding:0 0 4px 10px'><a href='/easynomu/files/hwp/samu_reg.hwp'><img src='/easynomu/images/btn_samu_reg.gif' border='0'></a></div>";
		echo "ㆍ사무위탁서 작성 후 FAX <b>0505-609-0001</b> 보내주십시오.<br>";
	}
}
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
			<TH scope=col>수임일자</TH>
		</TR>
	</THEAD>
  <TBODY>
<?
//코드
//$code_var = $row[comp_bznb]."_".$row[comp_name]."_".$row[comp_adr]."_".$row[comp_tel]."_".$row[comp_email]."_".$row[comp_fax];
$code_var = $row_a4['biz_no']."_".$row_a4['com_name']."_".$row_a4['com_juso']." ".$row_a4['com_juso2']."_".$row_a4['com_tel']."_".$row_a4['com_mail']."_".$row_a4['com_fax'];
//$w_date_array = explode(" ", $row[wr_datetime]);
//$w_date = $w_date_array[0];
$w_date = $row_a4_opt['samu_req_date'];
if($com_code) {
?>
  <TR>
    <TD class=alignC><INPUT title=코드선택 class=select01 type=radio value="<?=$code_var?>" name=select01></TD>
    <TD class=alignC><?=$row_a4['com_name']?></TD>
    <TD class=alignC><?=$row_a4['com_tel']?></TD>
    <TD class=alignC><?=$w_date?></TD>
	</TR>
<?
}
?>
	</TBODY>
</TABLE>

<P class=close><A onclick="win_close();event.returnValue = false;" href="#"><IMG alt=닫기 src="images/btn_close.gif"></A></P>
<DIV style="HEIGHT: 10px"></DIV></DIV></DIV></BODY></HTML>
