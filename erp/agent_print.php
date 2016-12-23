<?
$sub_menu = "100500";
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

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>처음</a>";

$sub_title = "대리인 선임(프린트)";
$g4[title] = $sub_title." : 거래처관리 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
//echo $sql;
$result = sql_query($sql);
//echo $row[com_code];

$colspan = 11;

if($w == "u") {
	$row=mysql_fetch_array($result);
	//master 로그인시 com_code 오류
	if(!$com_code) $com_code = $id;
	//사업장DB 옵션
	$sql1 = " select * from com_list_gy_opt where com_code='$com_code' ";
	//echo $sql1;
	$result1 = sql_query($sql1);
	$row1=mysql_fetch_array($result1);
}
//echo $row[com_code];
//검색 파라미터 전송
$qstr = "stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_comp_tel=".$stx_comp_tel."&stx_proxy=".$stx_proxy;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#ffffff">
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<script language="javascript">

</script>
<form name="dataForm" method="post" enctype="MULTIPART/FORM-DATA">
<table border=0 cellspacing=0 cellpadding=0 style=""> 
	<tr>
		<td> 
			<div id='print_page' style="padding:0 0 0 30px">
				<div>
					<img src="./files/agent/agent_12709845550.jpg" width="700">
				</div>
<?
$pop_left = 200;
$pop_top  = 450;
?>
				<style type="text/css">
				#pop1 {
					position:absolute;
					z-index:100;
					left:<?=$pop_left?>px;
					top:<?=$pop_top?>px;
					width:440px;
				}
				</style>
				<div id="pop1" class="clsDrag" style="display:">
					<img src="images/agent_img.png" width="450" align="top" alt="" border="0" align="absmiddle" style="border: 0;" /></a>
				</div>
			</div>
<script type="text/JavaScript">
function pagePrint(Obj) {  
  var W = 740;        //screen.availWidth;  
  var H = Obj.offsetHeight + 50;       //screen.availHeight; 
 
  var features = "menubar=no,toolbar=no,location=no,directories=no,status=no,scrollbars=no,resizable=yes,width=" + W + ",height=" + H + ",left=0,top=0";  
  var PrintPage = window.open("about:blank",Obj.id,features);  
 
	var iepage_script = "<style type='text/css'>\n@media print{ \n#noPrint1{display: none;} \n} \n</style> \n<script language='javascript' type='text/javascript'> \nfunction Installed() \n{ \ntry \n{ \nreturn (new ActiveXObject('IEPageSetupX.IEPageSetup')); \n} \ncatch (e) \n{ \nreturn false; \n} \n} \nfunction PrintTest() \n{ \nif (!Installed()) \nalert('컨트롤이 설치되지 않았습니다. 정상적으로 인쇄되지 않을 수 있습니다.') \nelse \nalert('정상적으로 설치되었습니다.'); \n} \nfunction printsetup()\n{ \nIEPageSetupX.header = '';\nIEPageSetupX.footer = '';\nIEPageSetupX.leftMargin = 10;\nIEPageSetupX.rightMargin = 10;\nIEPageSetupX.topMargin = 20;\nIEPageSetupX.bottomMargin = 10;\nIEPageSetupX.PrintBackground = true;\nIEPageSetupX.Orientation = 0;\nIEPageSetupX.PaperSize = 'A4';\n</sc"+"ript>";
	var iepage_object = "<script language='JavaScript' for='IEPageSetupX' event='OnError(ErrCode, ErrMsg)'>\nalert('에러 코드: ' + ErrCode + '\n에러 메시지: ' + ErrMsg);\n</sc"+"ript>\n<object id=IEPageSetupX classid='clsid:41C5BC45-1BE8-42C5-AD9F-495D6C8D7586' codebase='/IEPageSetupX/IEPageSetupX.cab#version=1,4,0,3' width=0 height=0>\n<param name='copyright' value='http://isulnara.com'>\n<div style='position:absolute;top:276;left:320;width:300;height:68;border:solid 1 #99B3A0;background:#D8D7C4;overflow:hidden;z-index:1;visibility:visible;'><FONT style='font-family: '굴림', 'Verdana'; font-size: 9pt; font-style: normal;'>\n<BR>  인쇄 여백제어 컨트롤이 설치되지 않았습니다.  <BR>  <a href='/IEPageSetupX/IEPageSetupX.exe'><font color=red>이곳</font></a>을 클릭하여 수동으로 설치하시기 바랍니다.  </FONT>\n</div>\n</object>";

  PrintPage.document.open();  
  PrintPage.document.write("<html><head><title></title><link rel='stylesheet' type='text/css' href='css/style.css'>\n<link rel='stylesheet' type='text/css' href='css/style_admin.css'>\n</head>\n<body style='margin:0'>\n<div style='text-align:center;'>\n"+iepage_script+"\n"+iepage_object+"\n<div style=''>\n" + Obj.innerHTML + "\n</div>\n</div>\n</body></html>");
  PrintPage.document.close();  
  PrintPage.document.title = document.domain;
	// 여백
	PrintPage.IEPageSetupX.topMargin = 0;
	PrintPage.IEPageSetupX.bottomMargin = 0;
	// 가로출력
	PrintPage.IEPageSetupX.Orientation = 1;
	// 인쇄미리보기
	PrintPage.IEPageSetupX.Preview();
  //PrintPage.print(PrintPage.location.reload());
}

var x, y;
var objDoc;
var objIE = document.all;
var objOtherBrowsers = document.getElementById && !document.all;
var blIsDrag = false;
function fnMoveMouse(e) {
	frm = document.dataForm;
	if (blIsDrag)
	{
		objDoc.style.left = objOtherBrowsers ? intLeftX + e.clientX - x : intLeftX + event.clientX - x;
		objDoc.style.top  = objOtherBrowsers ? intTopY  + e.clientY - y : intTopY  + event.clientY - y;
		frm.pop_x.value = objDoc.style.left;
		frm.pop_y.value = objDoc.style.top;
		return false;
	}
}
function fnSelectMouse(e) {
	var objF = document.getElementById('pop1');
	blIsDrag = true;
	objDoc = objF;
	intLeftX = parseInt(objDoc.style.left + <?=$pop_left?>, 10);
	intTopY = parseInt(objDoc.style.top + <?=$pop_top?>, 10);
	x = objOtherBrowsers ? event.clientX : event.clientX;
	y = objOtherBrowsers ? event.clientY : event.clientY;
	document.onmousemove = fnMoveMouse;
	return false;
}
//팝업드래그
function fnSelectMouse_drag() {
	document.onmousedown = fnSelectMouse;
	document.onmouseup = new Function("blIsDrag = false");
}
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
addLoadEvent(fnSelectMouse);
addLoadEvent(fnSelectMouse_drag);
</script>
		</td>
		<td>
<?
//권한별 링크값
if($member['mb_level'] == 6) {
	$url_save = "javascript:alert_no_right();";
} else {
	$url_save = "javascript:checkData();";
}
?>
			<table border=0 cellpadding=0 cellspacing=0 style="">
				<tr>
					<td style="padding:0 4px 0 0">X좌표 <input type="text" name="pop_x" value="" style="width:50px"></td>
					<td>Y좌표 <input type="text" name="pop_y" value="" style="width:50px"></td>
				</tr>
			</table>
			<div style="height:10px;font-size:0px"></div>
			<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
				<tr>
					<td width=2></td>
					<td><img src=images/btn_lt.gif></td>
					<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:pagePrint(document.getElementById('print_page'))" target="">출 력</a></td>
					<td><img src=images/btn_rt.gif></td>
				 <td width=2></td>
				</tr>
			</table>
			<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_save?>" target="">저 장</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
			<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:window.close()" target="">닫기</td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
		</td>
	</tr>
</table>
</form>
</body>
</html>
