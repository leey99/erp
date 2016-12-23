<?
$sub_menu = "100101";
include_once("./_common.php");
$sub_title = "메모";
$g4[title] = $sub_title." : 보수총액신고 : ".$easynomu_name;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:10px;">
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<script language="javascript">
function goInsert() {
	var frm = document.dataForm;
	var rv = 0;
	if (frm.memo.value == "")
	{
		alert("내용을 입력하세요.");
		frm.memo.focus();
		return;
	}
	frm.action = "popup_memo_update.php";
	frm.submit();
	return;
}
function memo_del(id,idx) {
	if(confirm("삭제하시겠습니까?")) {
		location.href = "popup_memo_delete.php?id="+id+"&idx="+idx;
	}
}
</script>
<?
//덧글
$sql_comment = " select * from total_pay_comment where t_no='$t_no' and delete_yn != '1' ";
//echo $sql_comment;
$result_comment = sql_query($sql_comment);
for ($i=0; $row_comment=sql_fetch_array($result_comment); $i++) {
	if($row_comment['user_id'] == "master") $color = "blue";
	else $color = "#343434";
	//삭제 권한 설정
	if($member['mb_id'] == $row_comment['user_id']) {
		$memo_del_href = "javascript:memo_del('".$id."','".$row_comment['idx']."')";
		$comment_del = " <a href=\"".$memo_del_href."\"><img src='images/co_btn_delete.gif' border='0' style='vertical-align:middle;'></a>";
	} else {
		$memo_del_href = "javascript:alert('삭제 권한이 없습니다.')";
		$comment_del = " ";
	}
	$comment_del = " <a href=\"".$memo_del_href."\"><img src='images/co_btn_delete.gif' border='0' style='vertical-align:middle;'></a>";
	$comment = "<span style='color:".$color."'><b>".$row_comment['user_name']."</b>(".$row_comment['user_nick'].") : ".$row_comment['memo']."</span> <span style='font-size:9px'>(".str_replace('-','.',$row_comment[regdt]).")</span>".$comment_del."<br>";
	echo $comment;
}
?>
<form name="dataForm" method="post" enctype="" style="margin:0">
	<input type="hidden" name="w" value="<?=$w?>">
	<input type="hidden" name="id" value="<?=$id?>">
	<input type="hidden" name="t_no" value="<?=$t_no?>">
	<input type="hidden" name="user_id" value="<?=$member['mb_id']?>">
	<input type="hidden" name="idx" value="<?=$idx?>">
	<textarea name="memo" class="textfm" style='width:100%;height:40px; word-break:break-all;' itemname="내용" required></textarea>
	<table border=0 cellpadding=0 cellspacing=0 style="float:left;height:18px;margin-top:5px">
		<tr>
			<td width="2"></td><td><img src="images/btn9_lt.gif"></td>
			<td style="background:url('images/btn9_bg.gif') repeat-x center" class="ftbutton5_white" nowrap><a href="javascript:goInsert();" target="">등록</a></td>
			<td><img src=images/btn9_rt.gif></td><td width=2></td>
		</tr>
	</table> 
</form>
</body>
</html>
