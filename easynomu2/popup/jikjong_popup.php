<?
$mode = "popup";
include_once("./_common.php");

$sql_common = " from a4_jikjong ";

$sql_search = " where 1=1";
$sfl = "jikjong";
if ($stx) {
    $sql_search .= " and ( ";
    $sql_search .= " ($sfl like '%$stx%') ";
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst = "code";
    $sod = "asc";
}

//$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

$row = sql_fetch($sql);
$total_count = $row[cnt];

$sub_title = "�����ڵ�";
$g4[title] = $sub_title." : �˾� : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
$result = sql_query($sql);

$colspan = 11;
//4���ȸ���� �������輾�� - �����ڵ�3(139�� �� KECO �ڵ�, ���,����)(���� 138��) �˻�
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
		if( rowNum != "null" && nhicRowNum != "null" ){
			parent.value_set('join_note<?=$n?>',value.split("_")[0],'join_jikjong<?=$n?>',value.split("_")[1])
			//parent.ifr_close('join_note','join_jikjong');
		}else{
			//$('#join_jikjong',opener.document).focus();
			$('#join_jikjong_code<?=$n?>',opener.document).val(value.split("_")[0]);
			$('#join_jikjong<?=$n?>',opener.document).val(value.split("_")[1]);
			//alert(value.split("_")[0]);
			self.close();
		}
	}); 
	if( rowNum != "null" && nhicRowNum != "null" ) {
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
style="BORDER-TOP: black 0px solid; BORDER-RIGHT: black 0px solid; BORDER-BOTTOM: black 0px solid; TEXT-ALIGN: left; BORDER-LEFT: black 0px solid; WIDTH: 540px">
<DIV id=popup class=width540 style="BORDER-TOP: blue 0px solid; BORDER-RIGHT: blue 0px solid; BORDER-BOTTOM: blue 0px solid; BORDER-LEFT: blue 0px solid">
<H1><IMG alt="�����ڵ�3(139�� �� KECO �ڵ�, ���,����)(���� 138��) �˻�" 
src="images/D107.gif"></H1>
<P class=logoBg><IMG alt="4���ȸ���� �������輾��" src="images/logoBg.gif"></P>
<form name="" method="post" style="margin:0" action="<?=$_PHP_SELF?>">
<p>������ <input type="text" name="stx" value="<?=$stx?>" style="width:200px;ime-mode:active"> <input type="image" src="images/btn_search.gif" onclick="this.form.submit()"></p>
</form>
<P class=full>��ü <SPAN><?=$total_count?></SPAN>��</P>
<TABLE class=skyTable width="100%" summary="�Ǻξ��� �ڰ�����ȣ(�ǰ�) �˻� ��ȸ���(�ڵ�,��Ī)">
  <CAPTION>4���ȸ���� �������輾�� - ��� �˻�</CAPTION>
  <COLGROUP>
  <COL width="7%">
  <COL width="7%">
  <COL width="50%">
  <COL width="">
	</COLGROUP>
  <THEAD>
		<TR>
			<TH scope=col>����</TH>
			<TH scope=col>�ڵ�</TH>
			<TH scope=col>����</TH>
			<TH scope=col>����</TH>
		</TR>
	</THEAD>
</TABLE>
<div style="overflow:auto;overflow-x:hidden;height:470px">
<TABLE class=skyTable2 width="100%" summary="�Ǻξ��� �ڰ�����ȣ(�ǰ�) �˻� ��ȸ���(�ڵ�,��Ī)">
  <CAPTION>4���ȸ���� �������輾�� - ��� �˻�</CAPTION>
  <COLGROUP>
  <COL width="7%">
  <COL width="7%">
  <COL width="50%">
  <COL width="">
	</COLGROUP>
  <TBODY>
<?
// ����Ʈ ���
for ($i=0; $row=sql_fetch_array($result); $i++) {
?>
		<TR>
			<TD class=alignC><INPUT title=�ڵ弱�� class=select01 type=radio value="<?=$row[code]?>_<?=$row[jikjong]?>" name=select01></TD>
			<TD class=alignC><?=$row[code]?></TD>
			<TD><?=$row[jikjong]?></TD>
			<TD><?=$row['class']?></TD>
		</TR>
<?
}
?>
	</TBODY>
</TABLE>
</div>
<P class=close><A onclick="win_close();event.returnValue = false;" href="#"><IMG alt=�ݱ� src="images/btn_close.gif"></A></P>
<DIV style="HEIGHT: 10px"></DIV></DIV></DIV></BODY></HTML>
