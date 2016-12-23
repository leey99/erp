<?
include_once("./_common.php");

$sql_common = " from a4_upjong ";

$sql_search = " where 1=1";
$sfl = "upjong";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        default :
            $sql_search .= " ($sfl like '%$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}
if ($stx_code) {
	$sql_search .= " and ( ";
	$sql_search .= " (code like '%$stx_code%') ";
	$sql_search .= " ) ";
}
if (!$sst) {
    $sst = "code";
    $sod = "asc";
}

//$sql_order = " order by $sst $sod ";

$sub_title = "업종코드";
$g4[title] = $sub_title." : 팝업 : ".$easynomu_name;

$search_text = "해당하는 업종이 없습니다.";

if($stx_code || $stx) {
	$sql = " select count(*) as cnt
					 $sql_common
					 $sql_search
					 $sql_order ";

	$row = sql_fetch($sql);
	$total_count = $row[cnt];

	$sql = " select *
						$sql_common
						$sql_search
						$sql_order ";
	$result = sql_query($sql);
} else {
	$total_count = 0;
	$search_text = "업종코드 또는 업종명으로 검색하십시오.";
}
$colspan = 3;
//4대사회보험 정보연계센터 - 업종코드(실제 1936개) 검색
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0096)http://www.4insure.or.kr/ins4/ptl/ptcp/clnt/popup/ClntCommPopupSrchP.do -->
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD><META content="IE=7.0000" 
http-equiv="X-UA-Compatible">
<TITLE><?=$g4[title]?></TITLE>
<META content="text/html; charset=ks_c_5601-1987" http-equiv=Content-Type>
<META content=IE=7 http-equiv=X-UA-Compatible>
<META content=text/css http-equiv=Content-Style-Type>
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
			
			if( rowNum != "null" && nhicRowNum != "null" ){
				parent.value_set('join_note<?=$n?>',value.split("_")[0],'upjong<?=$n?>',value.split("_")[1])
				//parent.ifr_close('join_note','upjong');
			}else{
							//$('#upjong',opener.document).focus();
							$('#upjong_code<?=$n?>',opener.document).val(value.split("_")[0]);
							$('#upjong<?=$n?>',opener.document).val(value.split("_")[1]);
							//alert(value.split("_")[0]);
							self.close();
			}
	}); 
	$("#searchKeyword").focus();
});
function win_close() {
	window.close();
}
</SCRIPT>
<META name=GENERATOR content="MSHTML 10.00.9200.16686"></HEAD>
<BODY onload=""><!-- width:540px, height:650px -->
<DIV 
style="BORDER-TOP: black 0px solid; BORDER-RIGHT: black 0px solid; BORDER-BOTTOM: black 0px solid; TEXT-ALIGN: left; BORDER-LEFT: black 0px solid; WIDTH: 540px">
<DIV id=popup class=width540 style="BORDER-TOP: blue 0px solid; BORDER-RIGHT: blue 0px solid; BORDER-BOTTOM: blue 0px solid; BORDER-LEFT: blue 0px solid">
<H1><IMG alt="직종코드3(139종 신 KECO 코드, 고용,산재)(실제 138개) 검색" src="images/D107.gif"></H1>
<P class=logoBg><IMG alt="4대사회보험 정보연계센터" src="images/logoBg.gif"></P>
<form name="searchForm" method="post" style="margin:0" action="<?=$_PHP_SELF?>">
<p>업종코드 <input type="text" name="stx_code" value="<?=$stx_code?>" style="width:80px;ime-mode:active"> 업종명 <input type="text" name="stx" value="<?=$stx?>" style="width:180px;ime-mode:active"> <input type="image" src="images/btn_search.gif" onclick="this.form.submit()"></p>
</form>
<P class=full>전체 <SPAN><?=$total_count?></SPAN>개</P>
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
<div style="overflow:auto;overflow-x:hidden;height:454px">
<TABLE class=skyTable2 width="100%" summary="피부양자 자격취득부호(건강) 검색 조회결과(코드,명칭)">
  <CAPTION>4대사회보험 정보연계센터 - 비고 검색</CAPTION>
  <COLGROUP>
  <COL width="11%">
  <COL width="12%">
  <COL></COLGROUP>
  <TBODY>
<?
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
?>
  <TR>
    <TD class=alignC><INPUT title=코드선택 class=select01 type=radio 
      value="<?=$row[code]?>_<?=$row[upjong]?>" name=select01></TD>
    <TD class=alignC><?=$row[code]?></TD>
    <TD><?=$row[upjong]?></TD>
	</TR>
<?
}
if(!$i) {
?>
  <TR>
    <TD colspan="<?=$colspan?>" align="center"><?=$search_text?></TD>
	</TR>
<?
}
?>
	</TBODY>
</TABLE>
</div>

<P class="close"><A onclick="win_close();event.returnValue = false;" href="#"><IMG alt="닫기" src="images/btn_close.gif"></A></P>
<DIV style="HEIGHT: 10px"></DIV></DIV></DIV>
<script language="javascript">
// onload 2개 이상 선언 가능 함수
function addLoadEvent(func) {
    var oldonload = window.onload;
        if(typeof window.onload != 'function') {
            window.onload = func;
        } else {
            window.onload = function() {
                oldonload();
                func();
        }
    }
}
function stx_focus() {
	var frm = document.searchForm;
	frm.stx.focus();
}
addLoadEvent(stx_focus);
</script>
</BODY></HTML>
