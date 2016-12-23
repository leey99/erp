<?
$sub_menu = "1900300";
include_once("./_common.php");

//현재 연도
$now_year = date('Y');

$is_admin = "super";

$sub_title = "전기요금컨설팅(수금관리)";
$g4['title'] = $sub_title." : 사업분야 : ".$easynomu_name;

$sql = " select * from erp_application where com_code='$id' and application_kind=23 order by idx desc ";
//echo $sql;
$result = sql_query($sql);

//사업장DB 기본
$sql_base = " select * from com_list_gy where com_code='$id' ";
$result_base = sql_query($sql_base);
$row_base = mysql_fetch_array($result_base);
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
	<title><?=$g4['title']?></title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
	<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
	<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0 10px 10px 10px;">
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<script type="text/javascript">
//<![CDATA[
function goInsert() {
	var frm = document.dataForm;
	if(frm.statement_date.value == "") {
		alert("거래명세서 발행일을 입력하십시오.");
		frm.statement_date.focus();
		return;
	}
	if(frm.requested_amount.value == "") {
		alert("청구금액을 입력하십시오.");
		frm.requested_amount.focus();
		return;
	}
	frm.action = "iframe_electric_collection_update.php";
	frm.submit();
	return;
}
function goSMS(id,idx) {
	if(confirm("문자 발송하시겠습니까?")) {
		window.open("popup/popup_sms_send_electric.php?id="+id+"&idx="+idx, "electric_sms_send", "width=340, height=350, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
	}
}
function goDel(id,idx) {
	if(confirm("삭제하시겠습니까?\n지원금/결산현황도 삭제됩니다.")) {
		location.href = "iframe_electric_collection_delete.php?id="+id+"&idx="+idx;
	}
}
//수정 160912
function goMod(id,idx,no) {
	if(confirm("수정하시겠습니까?")) {
		location.href = "iframe_electric_collection.php?id="+id+"&idx="+idx+"&orderno="+no;
	}
}
//수정 : 결산현황
function goMod2(id) {
	if(confirm("수정하시겠습니까?\n1차 수금 수정은 결산현황에서 가능합니다.\n결산현황 페이지로 이동합니다.")) {
		parent.location.href = "settlement_view.php?w=u&id="+id+"#40001";
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
//절감금액
function client_receipt_fee_cal(client_receipt_fee) {
	var frm = document.dataForm;
	if(client_receipt_fee == "") {
		alert("절감금액이 등록 되어 있지 않습니다.");
		return;
	}
	frm['client_receipt_fee'].value = client_receipt_fee;	
}
//청구금액 = 절감금액 / 2
function requested_amount_cal() {
	var frm = document.dataForm;
	client_receipt_fee = toInt(frm['client_receipt_fee'].value);
	if(client_receipt_fee == "") {
		alert("절감금액을 입력하세요.");
		frm['client_receipt_fee'].focus();
		return;
	}
	requested_amount = client_receipt_fee * 0.5;
	frm['requested_amount'].value = number_format(requested_amount);
}
//본사입금금액 계산
function main_receipt_fee_cal() {
	var frm = document.dataForm;
	requested_amount = toInt(frm['requested_amount'].value);
	if(requested_amount == "") {
		alert("청구금액(거래)을 입력하세요.");
		frm['requested_amount'].focus();
		return;
	}
	main_receipt_fee = requested_amount * 1.1;
	frm['main_receipt_fee'].value = number_format(main_receipt_fee);
}
//용역비 계산
function allowance_pay_cal() {
	var frm = document.dataForm;
	//alert(k);
	main_receipt_fee = toInt(frm['main_receipt_fee'].value);
	requested_amount = toInt(frm['requested_amount'].value);
	//alert(requested_amount);
	allowance_rate = toInt(frm['allowance_rate'].value);
	//alert(allowance_rate);
	if(allowance_rate == "") {
		alert("수당료를 입력하세요.");
		frm['allowance_rate'].focus();
		return;
	}
	//수당료 VAT별도 체크 160128
	if(frm['allowance_rate_vat_extra']) {
		if(main_receipt_fee == "") {
			alert("본사입금금액(VAT포함)을 입력하세요.");
			frm['main_receipt_fee'].focus();
			return;
		}
		allowance_pay = main_receipt_fee * allowance_rate / 100;
	} else {
		if(requested_amount == "") {
			alert("청구금액(거래)을 입력하세요.");
			frm['requested_amount'].focus();
			return;
		}
		allowance_pay = requested_amount * allowance_rate / 100;
	}
	//alert(frm['allowance_rate_vat_extra'].checked);
	if(frm['grade_income_tax'].checked) allowance_pay = allowance_pay - (allowance_pay * 0.033);
	frm['allowance_pay'].value = number_format(allowance_pay);
	//alert(allowance_pay);
}
//]]>
</script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<script type="text/javascript">
//<![CDATA[
function loadCalendar( obj ) {
	var calendar = new Calendar(0, null, onSelect, onClose);
	calendar.create();
	calendar.parseDate(obj.value);
	calendar.showAtElement(obj, "Br");

	function onSelect(calendar, date)
	{
		var input_field = obj;
		input_field.value = date;
		if (calendar.dateClicked) {
			calendar.callCloseHandler();
		}
	};

	function onClose(calendar)
	{
		calendar.hide();
		calendar.destroy();
	};
}
//]]>
</script>
<?
$tr_class = "list_row_now_wh";
//결산 등록 여부
$sql_cnt = " select count(idx) as cnt from erp_application where com_code='$id' and application_kind=23 ";
//echo $sql_cnt;
$result_cnt = sql_query($sql_cnt);
$row_cnt = mysql_fetch_array($result_cnt);
$app_cnt = $row_cnt['cnt'];
//echo $app_cnt;
if($app_cnt) {
	$sql3 = " select * from erp_application where com_code='$id' and application_kind=23 order by idx asc limit 0, 1 ";
	//echo $sql3;
	$result3 = sql_query($sql3);
	$row3 = mysql_fetch_array($result3);
	$row2['allowance_rate'] = $row3['allowance_rate'];
	$row2['allowance_rate_vat_extra'] = $row3['allowance_rate_vat_extra'];
	$row2['grade_income_tax'] = $row3['grade_income_tax'];
	$row2['person_charge'] = $row3['person_charge'];
	$mid = $row3['idx'];
}
//수정일 경우 idx 데이터 erp_application 테이블 호출 160912
if($idx) {
	$sql2 = " select * from erp_application where com_code='$id' and idx='$idx' ";
	//echo $sql2;
	$result2 = sql_query($sql2);
	$row2 = mysql_fetch_array($result2);
	//수당료 데이터가 없을 경우 1차 결산현황 호출
	if(!$row2['allowance_rate']) {
		$sql3 = " select * from erp_application where com_code='$id' and application_kind=23 order by idx asc limit 0, 1 ";
		//echo $sql3;
		$result3 = sql_query($sql3);
		$row3 = mysql_fetch_array($result3);
		$row2['allowance_rate'] = $row3['allowance_rate'];
		$row2['allowance_rate_vat_extra'] = $row3['allowance_rate_vat_extra'];
		$row2['grade_income_tax'] = $row3['grade_income_tax'];
		$row2['person_charge'] = $row3['person_charge'];
	}
} else {
	//차수 자동 입력
	$orderno = $app_cnt + 1;
}
//고객관리 DB 호출
$orderno_pre = $orderno - 1;
//$sql4 = " select * from electric_manage where com_code='$id' order by idx asc limit $orderno_pre, 1 ";
$sql4 = " select * from electric_manage where com_code='$id' and delete_yn!=1 order by idx asc limit $orderno_pre, 1 ";
//echo $sql4;
$result4 = sql_query($sql4);
$row4 = mysql_fetch_array($result4);
$electric_before_contrast = $row4['electric_before_contrast'];
$client_receipt_fee_load = $electric_before_contrast;
?>
<form name="dataForm" method="post" enctype="" style="margin:5px 0 0 0;height:84px;">
	<input type="hidden" name="id" value="<?=$id?>" />
	<input type="hidden" name="idx" value="<?=$idx?>" />
	<input type="hidden" name="mid" value="<?=$mid?>" />
	<input type="hidden" name="orderno" value="<?=$orderno?>" />
	<input type="hidden" name="application_kind" value="23" />
	<input type="hidden" name="allowance_rate" value="<?=$row2['allowance_rate']?>" />
	<!--<input type="checkbox" name="allowance_rate_vat_extra" value="<?=$row2['allowance_rate_vat_extra']?>" style="display:none;" />-->
	<input type="hidden" name="allowance_rate_vat_extra" value="<?=$row2['allowance_rate_vat_extra']?>" />
	<input type="hidden" name="grade_income_tax" value="<?=$row2['grade_income_tax']?>" />
	<input type="hidden" name="person_charge" value="<?=$row2['person_charge']?>" />
	<input type="hidden" name="user_id" value="<?=$member['mb_id']?>" />
	<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
		<tr>
			<td class="tdhead_center" width="40">차수</td>
			<td class="tdhead_center" width="102">절감금액</td>
			<td class="tdhead_center" width="96">거래명세서</td>
			<td class="tdhead_center" width="124">청구금액(거래)</td>
			<td class="tdhead_center" width="96">세금계산서</td>
			<td class="tdhead_center" width="96">본사입금일</td>
			<td class="tdhead_center" width="124">본사입금액(VAT포함)</td>
			<td class="tdhead_center" width="124">용역비(실지급액)</td>
			<td class="tdhead_center" width="">관리</td>
		</tr>
<?
//본사 관리부 권한
if($member['mb_level'] > 7) {
?>
		<tr class="<?=$tr_class?>" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='<?=$tr_class?>';">
			<td class="ltrow1_center_h22">
<?
if($orderno) echo "<span style='color:red;font-weight:bold;'>".$orderno."차</span>";
else echo "-";
//업체입금액 -> 절감금액
if($row2['client_receipt_fee']) $client_receipt_fee = number_format($row2['client_receipt_fee']);
else $client_receipt_fee = "";
if($row2['requested_amount']) $requested_amount = number_format($row2['requested_amount']);
else $requested_amount = "";
if($row2['main_receipt_fee']) $main_receipt_fee = number_format($row2['main_receipt_fee']);
else $main_receipt_fee = "";
if($row2['allowance_pay']) $allowance_pay = number_format($row2['allowance_pay']);
else $allowance_pay = "";
?>
			</td>
			<td class="ltrow1_center_h22">
				<input name="client_receipt_fee" type="text" value="<?=$client_receipt_fee?>" class="textfm" style="width:80px;ime-mode:disabled;float:left;" maxlength="14" onkeydown="only_number()" onkeyup="checkThousand(this.value, this,'Y')" />
				<img src="images/emp_calculator.png" width="16" height="16" alt="계산" style="cursor:pointer;float:left;" onclick="client_receipt_fee_cal('<?=$client_receipt_fee_load?>');return false;" />
			</td>
			<td class="ltrow1_center_h22">
				<input name="statement_date" type="text" value="<?=$row2['statement_date']?>" class="textfm" style="width:70px;ime-mode:disabled;float:left;" maxlength="10" onkeypress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
				<img src="images/emp_calendar.png" width="16" height="16" alt="달력" style="cursor:pointer;float:left;" onclick="loadCalendar(document.dataForm.statement_date);" />
			</td>
			<td class="ltrow1_center_h22">
				<input name="requested_amount" type="text" value="<?=$requested_amount?>" class="textfm" style="width:100px;ime-mode:disabled;float:left;" maxlength="14" onkeydown="only_number()" onkeyup="checkThousand(this.value, this,'Y')" />
				<img src="images/emp_calculator.png" width="16" height="16" alt="계산" style="cursor:pointer;float:left;" onclick="requested_amount_cal();return false;" />
			</td>
			<td class="ltrow1_center_h22">
				<input name="tax_invoice" type="text" value="<?=$row2['tax_invoice']?>" class="textfm" style="width:70px;ime-mode:disabled;float:left;" maxlength="10" onkeypress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
				<img src="images/emp_calendar.png" width="16" height="16" alt="달력" style="cursor:pointer;float:left;" onclick="loadCalendar(document.dataForm.tax_invoice);" />
			</td>
			<td class="ltrow1_center_h22">
				<input name="main_receipt_date" type="text" value="<?=$row2['main_receipt_date']?>" class="textfm" style="width:70px;ime-mode:disabled;float:left;" maxlength="10" onkeypress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
				<img src="images/emp_calendar.png" width="16" height="16" alt="달력" style="cursor:pointer;float:left;" onclick="loadCalendar(document.dataForm.main_receipt_date);" />
			</td>
			<td class="ltrow1_center_h22">
				<input name="main_receipt_fee" type="text" value="<?=$main_receipt_fee?>" class="textfm" style="width:100px;ime-mode:disabled;float:left;" maxlength="14" onkeydown="only_number()" onkeyup="checkThousand(this.value, this,'Y')" />
				<img src="images/emp_calculator.png" width="16" height="16" alt="계산" style="cursor:pointer;float:left;" onclick="main_receipt_fee_cal();return false;" />
			</td>
			<td class="ltrow1_center_h22">
				<input name="allowance_pay" type="text" value="<?=$allowance_pay?>" class="textfm" style="width:100px;ime-mode:disabled;float:left;" maxlength="14" onkeydown="only_number()" onkeyup="checkThousand(this.value, this,'Y')" />
				<img src="images/emp_calculator.png" width="16" height="16" alt="계산" style="cursor:pointer;float:left;" onclick="allowance_pay_cal();return false;" />
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
}
for($i=0; $row=sql_fetch_array($result); $i++) {
	//$no = $i + 1;
	$no = $app_cnt - $i;
	$idx = $row['idx'];
?>
		<tr class="<?=$tr_class?>" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='<?=$tr_class?>';">
			<td class="ltrow1_center_h22">
				<?=$no?>차
			</td>
			<td class="ltrow1_center_h22">
				<?if($row['client_receipt_fee']) echo number_format($row['client_receipt_fee']);?>
<?
	//최종완료 : 공사 선택 시 "공사비" 표시 161027
	if($row['reapplication_done'] == 5) echo "공사비";
?>
			</td>
			<td class="ltrow1_center_h22">
				<?=$row['statement_date']?>
			</td>
			<td class="ltrow1_right_h22_padding">
				<?if($row['requested_amount']) echo number_format($row['requested_amount']);?>
			</td>
			<td class="ltrow1_center_h22">
				<?=$row['tax_invoice']?>
			</td>
			<td class="ltrow1_center_h22">
				<?=$row['main_receipt_date']?>
			</td>
			<td class="ltrow1_right_h22_padding">
				<?if($row['main_receipt_fee']) echo number_format($row['main_receipt_fee']);?>
			</td>
			<td class="ltrow1_right_h22_padding">
				<?if($row['allowance_pay']) echo number_format($row['allowance_pay']);?>
			</td>
			<td class="ltrow1_left_h22">
<?
	//본사 관리부 권한
	if($member['mb_level'] > 7) {
		//1차 삭제 불가
		//if($i > 0) {
		if($no > 1) {
?>
				<table border="0" cellpadding="0" cellspacing="0" style="float:left;height:18px;margin-top:0;">
					<tr>
						<td width="2"></td><td><img src="images/btn9_lt.gif"></td>
						<td style="background:url('images/btn9_bg.gif') repeat-x center" class="ftbutton5_white" nowrap><a href="javascript:goMod('<?=$id?>','<?=$idx?>','<?=$no?>');">수정</a></td>
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
<?
		} else {
?>
				<table border="0" cellpadding="0" cellspacing="0" style="float:left;height:18px;margin-top:0;">
					<tr>
						<td width="2"></td><td><img src="images/btn9_lt.gif"></td>
						<td style="background:url('images/btn9_bg.gif') repeat-x center" class="ftbutton5_white" nowrap><a href="javascript:goMod2('<?=$id?>');">수정</a></td>
						<td><img src="images/btn9_rt.gif" /></td><td width=2></td>
					</tr>
				</table>
<?
	}
}
?>
			</td>
		</tr>
<?
}
?>
	</table>
</form>
</body>
</html>
