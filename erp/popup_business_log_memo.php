<?
$sub_menu = "700100";
include_once("./_common.php");

$sub_title = "스케줄";
$g4['title'] = $sub_title." : 업무일지 : 그룹웨어 : ".$easynomu_name;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4['title']?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0 10px 10px 10px;">
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<script language="javascript">
function goInsert() {
	var frm = document.dataForm;
	var rv = 0;
	if(frm.memo.value == "") {
		alert("내용을 입력하십시오.");
		frm.memo.focus();
		return;
	}
<?
/*
if($member['mb_id'] == $drafter_id) {
	$drafter_chk = 1;
*/
?>
/*
	//기본 결재자 1명 이상
	if(!frm.send_to1.checked <? if($position2) echo " && !frm.send_to2.checked "; ?> <? if($position3) echo " && !frm.send_to3.checked "; ?> <? if($position4) echo " && !frm.send_to4.checked "; ?> <? if($position5) echo " && !frm.send_to5.checked "; ?> ) {
		alert("전송할 결재자를 체크하십시오.");
		return;
	}
*/
<?
//}
?>
<?
//본사 직원 명단 160706
if($member['mb_profile'] == 1) {
?>
	//담당지사 제외 160811
	if(!frm.send_to1.checked && !frm.send_to2.checked && !frm.send_to3.checked && !frm.send_to4.checked && !frm.send_to5.checked && !frm.send_to6.checked && !frm.send_to7.checked && !frm.send_to8.checked && !frm.send_to9.checked && !frm.send_to10.checked ) {
// && !frm.send_to11.checked
		alert("담당자를 체크하십시오.");
		return;
	}
<?
}
?>
	frm.action = "popup_business_log_memo_update.php";
	frm.submit();
	return;
}
function memo_del(id,idx) {
	if(confirm("삭제하시겠습니까?")) {
		location.href = "popup_business_log_memo_delete.php?id="+id+"&idx="+idx+"&memo_type=<?=$memo_type?>&drafter_id=<?=$drafter_id?>";
	}
}
</script>
<?
$sql_comment = " select * from business_log_comment where mid='$id' and delete_yn != '1' order by regdt ";
$result_comment = sql_query($sql_comment);
for ($i=0; $row_comment=sql_fetch_array($result_comment); $i++) {
	if($row_comment['user_id'] == "master") $color = "blue";
	else $color = "#343434";
	//삭제 권한 설정
	if($member['mb_id'] == $row_comment['user_id'] || $member['mb_id'] == "master") {
		$memo_del_href = "javascript:memo_del('".$id."','".$row_comment['idx']."')";
		$comment_del = " <a href=\"".$memo_del_href."\"><img src='images/co_btn_delete.gif' border='0' style='vertical-align:middle;'></a>";
	} else {
		$memo_del_href = "javascript:alert('삭제 권한이 없습니다.')";
		$comment_del = " ";
	}
	if($row_comment['secret'] == '1') {
		$icon_secret = " <img src='images/icon_secret.png' width='16' height='15' border='0' style='vertical-align:middle;' alt='비밀글' title='비밀글'>";
		$color = "red";
	} else {
		$icon_secret = "";
	}
	$comment_del = " <a href=\"".$memo_del_href."\"><img src='images/co_btn_delete.gif' border='0' style='vertical-align:middle;' alt='삭제' title='삭제'></a>";
	$comment = "<span style='color:".$color.";'><b>".$row_comment['user_name']."</b>(".$row_comment['user_nick'].") : ".$row_comment['memo']."</span> <span>(".str_replace('-','.',$row_comment['regdt']).")</span>".$icon_secret.$comment_del."<br>";
	echo $comment;
}
?>
<form name="dataForm" method="post" enctype="" style="margin:5px 0 0 0;height:65px;">
	<input type="hidden" name="w" value="<?=$w?>" />
	<input type="hidden" name="id" value="<?=$id?>" />
	<input type="hidden" name="user_id" value="<?=$member['mb_id']?>" />
	<input type="hidden" name="drafter_id" value="<?=$drafter_id?>" />
	<input type="hidden" name="idx" value="<?=$idx?>" />
	<input type="hidden" name="memo_type" value="<?=$memo_type?>" />
	<textarea name="memo" class="textfm" style='width:100%;height:40px; word-break:break-all;' itemname="내용" required></textarea>
	<table border="0" cellpadding="0" cellspacing="0" style="float:left;height:18px;margin-top:5px;margin-right:5px">
		<tr>
			<td>
<?
//본사 직원 명단 160706
if($member['mb_profile'] == 1) {
?>
				<input type="checkbox" name="send_to1" value="kcmc1001" style="vertical-align:middle" /><b>최성민</b>
				<input type="checkbox" name="send_to2" value="kcmc1004" style="vertical-align:middle" /><b>정경용</b>
				<input type="checkbox" name="send_to3" value="kcmc1009" style="vertical-align:middle" /><b>김국진</b>
				<input type="checkbox" name="send_to4" value="kcmc2006" style="vertical-align:middle" /><b>이영래</b>
				<input type="checkbox" name="send_to5" value="kcmc1008" style="vertical-align:middle" /><b>전정애</b>
				<input type="checkbox" name="send_to6" value="kcmc1007" style="vertical-align:middle" /><b>임현미</b>
				<input type="checkbox" name="send_to7" value="kcmc1006" style="vertical-align:middle" /><b>박소향</b>
				<input type="checkbox" name="send_to8" value="kcmc2001" style="vertical-align:middle" /><b>최희용</b>
				<input type="checkbox" name="send_to9" value="kcmc2007" style="vertical-align:middle" /><b>박정현</b>
				<input type="checkbox" name="send_to10" value="kcmc1003" style="vertical-align:middle" /><b>이경훈</b>
				<!--<input type="checkbox" name="send_to10" value="kcmc4960" style="vertical-align:middle" /><b>송인혜</b>
				<input type="checkbox" name="send_to11" value="kcmc1012" style="vertical-align:middle" /><b>김미정</b>-->
<?
}
?>
			</td>
		</tr>
	</table> 
	<table border="0" cellpadding="0" cellspacing="0" style="float:left;height:18px;margin-top:5px">
		<tr>
			<td width="2"></td><td><img src="images/btn9_lt.gif"></td>
			<td style="background:url('images/btn9_bg.gif') repeat-x center" class="ftbutton5_white" nowrap><a href="javascript:goInsert();">등록</a></td>
			<td><img src="images/btn9_rt.gif" /></td><td width=2></td>
		</tr>
	</table> 
</form>
</body>
</html>
