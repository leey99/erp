<?
$mode = "popup";
$member['mb_id'] = "test";
include_once("./_common.php");

$sql_common = " from sj_percent ";

$sql_search = " where 1=1";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        default :
            $sql_search .= " ($sfl like '$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst = "category_code";
    $sod = "asc";
}

//$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

$row = sql_fetch($sql);
$total_count = $row[cnt];

$sub_title = "산재업종";
$g4[title] = $sub_title." : 팝업 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
$result = sql_query($sql);

$colspan = 11;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0096)http://www.4insure.or.kr/ins4/ptl/ptcp/clnt/popup/ClntCommPopupSrchP.do -->
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD><META content="IE=7.0000" 
http-equiv="X-UA-Compatible">
<TITLE>4대사회보험 정보연계센터 - 산재업종(요율) 검색</TITLE>
<META content="text/html; charset=ks_c_5601-1987" http-equiv=Content-Type>
<META content=IE=7 http-equiv=X-UA-Compatible>
<META content=text/css http-equiv=Content-Style-Type>
<LINK rel=stylesheet type=text/css href="images/default.css">
<LINK rel=stylesheet type=text/css href="css/sj_upjong.css">
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
			
		$('#sj_upjong_code',opener.document).val(value.split("_")[0]);
		$('#sj_upjong',opener.document).val(value.split("_")[1]);
		$('#sj_percent', opener.document).val(value.split("_")[2]);
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
</SCRIPT>
<META name=GENERATOR content="MSHTML 10.00.9200.16686"></HEAD>
<BODY onload=""><!-- width:540px, height:650px -->
<DIV 
style="BORDER-TOP: black 0px solid; BORDER-RIGHT: black 0px solid; BORDER-BOTTOM: black 0px solid; TEXT-ALIGN: left; BORDER-LEFT: black 0px solid; WIDTH: 640px">
<DIV id=popup class=width540 style="BORDER-TOP: blue 0px solid; BORDER-RIGHT: blue 0px solid; BORDER-BOTTOM: blue 0px solid; BORDER-LEFT: blue 0px solid">
<H1><IMG alt="산재업종(요율) 검색" 
src="images/sj_upjong_title.gif"></H1>
<P class=logoBg><IMG alt="4대사회보험 정보연계센터" src="images/logoBg.gif"></P>
<p>※ Ctrl + F 단축키로 빠른 검색이 가능합니다.</p>
<P class=full>전체 <SPAN><?=$total_count?></SPAN>개</P>
<TABLE class=skyTable width="100%" summary="산재업종(요율) 검색 조회결과(코드,명칭)">
  <CAPTION>4대사회보험 정보연계센터 - 비고 검색</CAPTION>
  <COLGROUP>
  <COL width="7%">
  <COL width="11%">
  <COL width="40%">
  <COL width="8%">
  <COL>
	</COLGROUP>
  <THEAD>
		<TR>
			<TH scope=col>선택</TH>
			<TH scope=col>코드</TH>
			<TH scope=col>명칭</TH>
			<TH scope=col style="text-align:left">요율</TH>
			<TH scope=col style="padding:0 40px 0 0">분류</TH>
		</TR>
	</THEAD>
</TABLE>
<div style="overflow:auto;overflow-x:hidden;height:470px">
<TABLE class=skyTable2 width="100%" summary="피부양자 자격취득부호(건강) 검색 조회결과(코드,명칭)">
  <CAPTION>4대사회보험 정보연계센터 - 비고 검색</CAPTION>
  <COLGROUP>
  <COL width="7%">
  <COL width="11%">
  <COL width="40%">
  <COL width="8%">
  <COL>
	</COLGROUP>
  <TBODY>
<?
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
?>
  <TR>
    <TD class=alignC><INPUT title=코드선택 class=select01 type=radio value="<?=$row[category_code]?>_<?=$row[category_name]?>_<?=$row[category_rate]?>" name=select01></TD>
    <TD class=alignC><?=$row[category_code]?></TD>
    <TD><?=$row[category_name]?></TD>
    <TD><?=$row[category_rate]?></TD>
    <TD><?=$row[subdiv_name]?></TD>
	</TR>
<?
}
?>
	</TBODY>
</TABLE>
</div>

<P class=close><A onclick="win_close();event.returnValue = false;" href="#"><IMG alt=닫기 src="images/btn_close.gif"></A></P>
<DIV style="HEIGHT: 10px"></DIV></DIV></DIV></BODY></HTML>
