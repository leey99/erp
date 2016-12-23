<?
$sub_menu = "500101";
include_once("./_common.php");
$sql_common = " from com_list_gy a, com_list_gy_opt b ";

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

$sub_title = "사무위탁현황(뷰)";
$g4[title] = $sub_title." : 통화메모 : ".$easynomu_name;

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
	frm.action = "client_call_iframe_update.php";
	frm.submit();
	return;
}
function memo_del(id,idx) {
	if(confirm("삭제하시겠습니까?")) {
		location.href = "client_call_iframe_delete.php?id="+id+"&idx="+idx;
	}
}
//사업게시일 입력 콤마
function checkcomma(inputVal, type, keydown) {		// inputVal은 천단위에 , 표시를 위해 가져오는 값
	var main = document.dataForm;			// 여기서 type 은 해당하는 값을 넣기 위한 위치지정 index
	var chk		= 0;				// chk 는 천단위로 나눌 길이를 check
	var chk2	= 0;
	var chk3	= 0;
	var share	= 0;				// share 200,000 와 같이 3의 배수일 때를 구분하기 위한 변수
	var start	= 0;
	var triple	= 0;			// triple 3, 6, 9 등 3의 배수 
	var end		= 0;				// start, end substring 범위를 위한 변수  
	var total	= "";			
	var input	= "";				// total 임의로 string 들을 규합하기 위한 변수
	input = delcomma(inputVal, inputVal.length);
	if(1 == 1) { // 모두 포함
		//탭 시프트+탭 좌 우 Home backsp
		if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
			if(inputVal.length == 4){
				total += input.substring(0,4)+".";
			} else if(inputVal.length == 7) {
				total += inputVal.substring(0,7)+".";
			} else if(inputVal.length == 12) {
				total += inputVal.substring(0,14)+"";
			} else {
				total += inputVal;
			}
			if(keydown =='Y'){
				type.value=total;
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
}
function delcomma(inputVal, count){
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!='.'){		// 먼저 substring을 위해
			tmp += inputVal.substring(i,i+1);	// 값의 모든 , 를 제거
		}
	}
	return tmp;
}
function only_number_comma() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if (event.keyCode < 95 || event.keyCode > 105) {
			if(event.keyCode != 46) event.returnValue = false;
		}
	}
}
</script>
<?
//덧글
$sql_comment = " select * from com_list_gy_call where com_code='$row[com_code]' and delete_yn != '1' ";
$result_comment = sql_query($sql_comment);
for ($i=0; $row_comment=sql_fetch_array($result_comment); $i++) {
	if($row_comment['user_id'] == "master") $color = "blue";
	else $color = "#343434";
	//삭제 권한 설정
	if($member['mb_id'] == $row_comment['user_id']) {
		$memo_del_href = "javascript:memo_del('".$com_code."','".$row_comment['idx']."')";
		$comment_del = " <a href=\"".$memo_del_href."\"><img src='images/co_btn_delete.gif' border='0' style='vertical-align:middle;'></a>";
	} else {
		$memo_del_href = "javascript:alert('삭제 권한이 없습니다.')";
		$comment_del = " ";
	}
	$comment_del = " <a href=\"".$memo_del_href."\"><img src='images/co_btn_delete.gif' border='0' style='vertical-align:middle;'></a>";
	$comment = "<span style='color:".$color."'><b>".$row_comment['user_name']."</b>(".$row_comment['user_nick'].") : ";
	if($row_comment['call_day']) $comment .= "통화일자(<span style='color:blue'>".$row_comment['call_day']."</span>) ";
	$comment .= $row_comment['memo']."</span> <span style='font-size:9px'>(".str_replace('-','.',$row_comment['regdt']).")</span>".$comment_del."<br>";
	echo $comment;
}
?>
<form name="dataForm" method="post" enctype="" style="margin:0">
	<input type="hidden" name="w" value="<?=$w?>">
	<input type="hidden" name="id" value="<?=$id?>">
	<input type="hidden" name="user_id" value="<?=$member['mb_id']?>">
	<input type="hidden" name="idx" value="<?=$idx?>">
	<textarea name="memo" class="textfm" style='width:100%;height:40px; word-break:break-all;' itemname="내용" required></textarea>
	<table border=0 cellpadding=0 cellspacing=0 style="float:left;height:18px;margin-top:5px;margin-right:5px">
		<tr>
			<td style="">
				<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">통화일자
				<input name="call" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
			</td>
		</tr>
	</table> 
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
