<?
$sub_menu = "1900300";
include_once("./_common.php");
$sql_common = " from electric_manage a ";

//현재 연도
$now_year = date('Y');

$is_admin = "super";

$sql_search = " where a.com_code='$id' and delete_yn='' ";
//월 문자형->숫자혈 변경 정렬 / 김소향 사원 의견 161013
$sql_order = " order by a.year desc, a.month *1 desc ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$sub_title = "전기요금컨설팅(고객관리)";
$g4['title'] = $sub_title." : 사업분야 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
//echo $sql;
$result = sql_query($sql);
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
<script type="text/javascript">
//<![CDATA[
function goInsert() {
	var frm = document.dataForm;
	if(frm.search_month.value == "") {
		alert("월을 선택하십시오.");
		frm.search_month.focus();
		return;
	}
	if(frm.electric_before.value == "") {
		alert("컨설팅 전을 입력하십시오.");
		frm.electric_before.focus();
		return;
	}
	if(frm.electric_after.value == "") {
		alert("컨설팅 후를 입력하십시오.");
		frm.electric_after.focus();
		return;
	}
	if(frm.electric_before_contrast.value == "") {
		alert("절감액(컨설팅 전 대비)을 입력하십시오.");
		frm.electric_before_contrast.focus();
		return;
	}
	if(frm.electric_same_month.value == "") {
		alert("전년 동월을 입력하십시오.");
		frm.electric_same_month.focus();
		return;
	}
	if(frm.electric_same_month_contrast.value == "") {
		alert("절감액(전년 동월 대비)을 입력하십시오.");
		frm.electric_same_month_contrast.focus();
		return;
	}
	frm.action = "iframe_electric_manage_update.php";
	frm.submit();
	return;
}
function goSMS(id,idx) {
	if(confirm("문자 발송하시겠습니까?")) {
		window.open("popup/popup_sms_send_electric.php?id="+id+"&idx="+idx, "electric_sms_send", "width=340, height=350, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
	}
}
function goDel(id,idx) {
	if(confirm("삭제하시겠습니까?")) {
		location.href = "iframe_electric_manage_delete.php?id="+id+"&idx="+idx;
	}
}
function only_number() {
	//키보드 상단 숫자키
	if (event.keyCode < 48 || event.keyCode > 57) {
		//키보드 우측 숫자키
		if (event.keyCode < 95 || event.keyCode > 105) {
			//del 46 , backsp 8 , left 37 , right 39 , tab 9 , shift 16
			if(event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39 && event.keyCode != 9 && event.keyCode != 16) {
				event.preventDefault ? event.preventDefault() : event.returnValue = false;
			}
		}
	}
}
//천단위 콤바
function checkThousand(inputVal, type, keydown) {
	main = document.dataForm;
	var chk		= 0;
	var share	= 0;
	var start	= 0;
	var triple	= 0;
	var end		= 0;
	var total	= "";			
	var input	= "";
	//탭 시프트+탭 좌 우 Home
	if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36) {
		if (inputVal.length > 3) {
			input = delCom(inputVal, inputVal.length);
			chk = (input.length)/3;
			chk = Math.floor(chk);
			share = (input.length)%3;
			if (share == 0 ) {						
				chk = chk - 1;
			}
			for(i=chk; i>0; i--) {
				triple = i * 3;
				end = Number(input.length)-Number(triple);
				total += input.substring(start,end)+",";
				start = end;
			}
			total +=input.substring(start,input.length);
		} else {
			total = inputVal;
		}
		if(keydown =='Y') {
			type.value=total;
		}else if(keydown =='N') {
			return total
		}
		return total
	}
}
function delCom(inputVal, count) {
	var tmp = "";
	for(i=0; i<count; i++) {
		if(inputVal.substring(i,i+1)!=',') {
			tmp += inputVal.substring(i,i+1);
		}
	}
	return tmp;
}
//number_format 함수
function number_format (number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');    }
    return s.join(dec);
}
//iframe resize
function resizeFrame(frm) {
 frm.style.height = "auto";
 contentHeight = frm.contentWindow.document.documentElement.scrollHeight;
 frm.style.height = contentHeight + 0 + "px";
}
//절감액(컨설팅 전 대비) 계산
function electric_calculate1() {
	var frm = document.dataForm;
	electric_before_contrast = toInt(frm.electric_before.value) - toInt(frm.electric_after.value);
	frm.electric_before_contrast.value = number_format(electric_before_contrast);
}
//절감액(전년 동월 대비) 계산
function electric_calculate2() {
	var frm = document.dataForm;
	electric_same_month_contrast = toInt(frm.electric_same_month.value) - toInt(frm.electric_after.value);
	frm.electric_same_month_contrast.value = number_format(electric_same_month_contrast);
}
//]]>
</script>
<?
$tr_class = "list_row_now_wh";
?>
<form name="dataForm" method="post" enctype="" style="margin:5px 0 0 0;height:84px;">
	<input type="hidden" name="id" value="<?=$id?>" />
	<input type="hidden" name="user_id" value="<?=$member['mb_id']?>" />
	<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
		<tr>
			<td class="tdhead_center" width="70">연</td>
			<td class="tdhead_center" width="60">월</td>
			<td class="tdhead_center" width="110">컨설팅 전</td>
			<td class="tdhead_center" width="110">컨설팅 후</td>
			<td class="tdhead_center" width="160">절감액(컨설팅 전 대비)</td>
			<td class="tdhead_center" width="110">전년 동월</td>
			<td class="tdhead_center" width="160">절감액(전년 동월 대비)</td>
			<td class="tdhead_center" width="">관리</td>
		</tr>
		<tr class="<?=$tr_class?>" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='<?=$tr_class?>';">
			<td class="ltrow1_center_h22">
				<select name="search_year" class="selectfm">
<?
for($i=2015;$i<=$now_year;$i++) {
?>
					<option value="<?=$i?>" <? if($i == $now_year) echo "selected"; ?>><?=$i?></option>
<?
}
?>
				</select>
			</td>
			<td class="ltrow1_center_h22">
				<select name="search_month" class="selectfm">
					<option value="">선택</option>
<?
for($i=1;$i<=12;$i++) {
?>
					<option value="<?=$i?>"><?=$i?></option>
<?
}
?>
				</select>
			</td>
			<td class="ltrow1_center_h22">
				<input name="electric_before" type="text" class="textfm" style="width:100px;ime-mode:disabled;" maxlength="14" onkeydown="only_number()" onkeyup="checkThousand(this.value, this,'Y')" />
			</td>
			<td class="ltrow1_center_h22">
				<input name="electric_after" type="text" class="textfm" style="width:100px;ime-mode:disabled;" maxlength="14" onkeydown="only_number()" onkeyup="checkThousand(this.value, this,'Y')" />
			</td>
			<td class="ltrow1_center_h22">
				<input name="electric_before_contrast" type="text" class="textfm" style="width:100px;ime-mode:disabled;margin-left:4px;float:left;" maxlength="14" onkeydown="only_number()" onkeyup="checkThousand(this.value, this,'Y')" />
				<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;margin:2px 0 0 4px;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')"><a href="#pop_electric_calculate" onclick="electric_calculate1();return false;" onkeypress="this.onclick;" style="color:white;font-size:8pt;">계산</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
			</td>
			<td class="ltrow1_center_h22">
				<input name="electric_same_month" type="text" class="textfm" style="width:100px;ime-mode:disabled;" maxlength="14" onkeydown="only_number()" onkeyup="checkThousand(this.value, this,'Y')" />
			</td>
			<td class="ltrow1_center_h22">
				<input name="electric_same_month_contrast" type="text" class="textfm" style="width:100px;ime-mode:disabled;margin-left:4px;float:left;" maxlength="14" onkeydown="only_number()" onkeyup="checkThousand(this.value, this,'Y')" />
				<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;margin:2px 0 0 4px;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')"><a href="#pop_electric_calculate" onclick="electric_calculate2();return false;" onkeypress="this.onclick;" style="color:white;font-size:8pt;">계산</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
			</td>
			<td class="ltrow1_left_h22">
				<table border="0" cellpadding="0" cellspacing="0" style="float:left;height:18px;margin-top:0;">
					<tr>
						<td width="2"></td><td><img src="images/btn9_lt.gif"></td>
						<td style="background:url('images/btn9_bg.gif') repeat-x center" class="ftbutton5_white" nowrap><a href="javascript:goInsert();">등록</a></td>
						<td><img src="images/btn9_rt.gif" /></td><td width=2></td>
					</tr>
				</table> 
			</td>
		</tr>
<?
for($i=0; $row=sql_fetch_array($result); $i++) {
	$idx = $row['idx'];
?>
		<tr class="<?=$tr_class?>" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='<?=$tr_class?>';">
			<td class="ltrow1_center_h22">
				<?=$row['year']?>년
			</td>
			<td class="ltrow1_center_h22">
				<?=$row['month']?>월
			</td>
			<td class="ltrow1_center_h22">
				<?=$row['electric_before']?>원
			</td>
			<td class="ltrow1_center_h22">
				<?=$row['electric_after']?>원
			</td>
			<td class="ltrow1_center_h22">
				<?=$row['electric_before_contrast']?>원
			</td>
			<td class="ltrow1_center_h22">
				<?=$row['electric_same_month']?>원
			</td>
			<td class="ltrow1_center_h22">
				<?=$row['electric_same_month_contrast']?>원
			</td>
			<td class="ltrow1_left_h22">
				<table border="0" cellpadding="0" cellspacing="0" style="float:left;height:18px;margin-top:0;">
					<tr>
						<td width="2"></td><td><img src="images/btn9_lt.gif"></td>
						<td style="background:url('images/btn9_bg.gif') repeat-x center" class="ftbutton5_white" nowrap><a href="javascript:goSMS('<?=$id?>','<?=$idx?>');">문자</a></td>
						<td><img src="images/btn9_rt.gif" /></td><td width=2></td>
					</tr>
				</table>
				<table border="0" cellpadding="0" cellspacing="0" style="float:left;height:18px;margin-top:0;">
					<tr>
						<td width="2"></td><td><img src="images/btn9_lt.gif"></td>
						<td style="background:url('images/btn9_bg.gif') repeat-x center" class="ftbutton5_white" nowrap><a href="javascript:goDel('<?=$id?>','<?=$idx?>');">삭제</a></td>
						<td><img src="images/btn9_rt.gif" /></td><td width=2></td>
					</tr>
				</table>
			</td>
		</tr>
<?
}
?>
	</table>
</form>
</body>
</html>
