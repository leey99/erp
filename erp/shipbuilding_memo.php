<?
$sub_menu = "100101";
include_once("./_common.php");
$sql_common = " from shipbuilding_gy a, shipbuilding_gy_opt b ";

//echo $member[mb_profile];
if($is_admin != "super") {
	$stx_man_cust_name = $member[mb_profile];
}
$is_admin = "super";
//echo $is_admin;
$sql_search = " where a.com_code=b.com_code and a.com_code='$id' ";

if (!$sst) {
    $sst = "a.com_code";
    $sod = "desc";
}

$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>처음</a>";

$sub_title = "인력 정보(뷰)";
$g4[title] = $sub_title." : 인력관리 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
//echo $sql;
$result = sql_query($sql);
//echo $row[com_code];

$colspan = 11;


$row=mysql_fetch_array($result);
//master 로그인시 com_code 오류
if(!$com_code) $com_code = $id;
//사업장DB 옵션
$sql1 = " select * from shipbuilding_gy_opt where com_code='$com_code' ";
//echo $sql1;
$result1 = sql_query($sql1);
$row1=mysql_fetch_array($result1);

//echo $row[com_code];
//검색 파라미터 전송
$qstr = "stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_comp_tel=".$stx_comp_tel."&stx_attend=".$stx_attend;
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
	frm.action = "shipbuilding_memo_update.php";
	frm.submit();
	return;
}
</script>
<b>※ 이름 : <?=$row[com_name]?> / 나이 : <?=$row[age]?> / 전화번호 : <?=$row[com_tel]?> / 지역 : <?=$row[area]?></b>
<br>
<?=$row[memo]?>
(<?=$row[regdt]?>)
<br>
<?
//덧글
$sql_comment = " select * from shipbuilding_comment where com_code='$row[com_code]' and delete_yn != '1' ";
$result_comment = sql_query($sql_comment);
for ($i=0; $row_comment=sql_fetch_array($result_comment); $i++) {
	if($i == 0) echo "<b>덧글</b> (".$member['mb_id'].")<br>";
	if($row_comment['user_id'] == "user") $color = "blue";
	else $color = "#343434";
	$comment_del = " <a href='shipbuilding_memo_delete.php?id=".$com_code."&idx=".$row_comment['idx']."'><img src='images/co_btn_delete.gif' border='0' style='vertical-align:middle;'></a>";
	$comment = "<span style='color:".$color."'>".$row_comment['memo']." (".$row_comment['regdt'].")</span>".$comment_del."<br>";
	echo $comment;
}
?>
<form name="dataForm" method="post" enctype="" style="margin:0">
<input type="hidden" name="w" value="<?=$w?>">
<input type="hidden" name="id" value="<?=$id?>">
<input type="hidden" name="user_id" value="<?=$member['mb_id']?>">
<input type="hidden" name="idx" value="<?=$idx?>">
<textarea name="memo" class="textfm" style='width:100%;height:40px; word-break:break-all;' itemname="내용" required></textarea>
<table border=0 cellpadding=0 cellspacing=0 style="display:inline;height:18px;"><tr><td width=2></td><td><img src="images/btn9_lt.gif"></td>
<td style="background:url(images/btn9_bg.gif) repeat-x center" class="ftbutton5_white" nowrap><a href="javascript:goInsert();" target="">덧글입력</a></td><td><img src=images/btn9_rt.gif></td><td width=2></td></tr></table> 
</form>
</body>
</html>
