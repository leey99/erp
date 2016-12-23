var BasePath = rooturl;  
var MinVersion = 0;//0x05050118;
var rowIndex = 1;
var tableIndex = 0;

var _DEBUG = true; // Debug mode.
var pHwpCtrl;

function InitToolBarJS(){
	HwpControl.HwpCtrl.ReplaceAction("FileNew", "HwpCtrlFileNew");
	HwpControl.HwpCtrl.ReplaceAction("FileSave", "HwpCtrlFileSave");
	HwpControl.HwpCtrl.ReplaceAction("FileSaveAs", "HwpCtrlFileSaveAs");
	HwpControl.HwpCtrl.ReplaceAction("FileOpen", "HwpCtrlFileOpen");
	HwpControl.HwpCtrl.SetToolBar(0, "FilePreview, Print, Separator, Undo, Redo, Separator, Cut, Copy, Paste,"
	+"Separator, ParaNumberBullet, MultiColumn, SpellingCheck, HwpDic, Separator, PictureInsertDialog, MacroPlay1");
	HwpControl.HwpCtrl.ShowToolBar(true);

}

function _VerifyVersion(){	 //설치 확인
	if(pHwpCtrl.Version == null){
		document.getElementById('HwpCtrl').style.display='none';
		alert("한글  컨트롤이 설치되지 않았습니다.");
		return false;
	}
	//버젼 확인
	CurVersion = pHwpCtrl.Version;
	if(CurVersion < MinVersion){
		alert("HwpCtrl의 버젼이 낮아서 정상적으로 동작하지 않을 수 있습니다.\n"+
			"최신 버젼으로 업데이트하기를 권장합니다.\n\n"+
			"현재 버젼:" + CurVersion + "\n"+
			"권장 버젼:" + MinVersion + " 이상"			
			);
	}
	return true;
}

function _GetBasePath(){
	//BasePath를 구한다.
	var loc = unescape(document.location.href);
	var lowercase = loc.toLowerCase(loc);
	if (lowercase.indexOf("http://") == 0) // Internet
	{
		return loc.substr(0,loc.lastIndexOf("/") + 1);//BasePath 생성
	}
	else // local
	{
		var path;
		path = loc.replace(/.{2,}:\/{2,}/, ""); // file:/// 를 지워버린다.
		return path.substr(0,path.lastIndexOf("/") + 1);//BasePath 생성
	}
}

function TableColumnContents(ColumnArray){
	if (pHwpCtrl.ParentCtrl.CtrlID == "tbl"){ // 테이블 내에 커서가 있는가?
		var i;
		var size;
		var dact = pHwpCtrl.CreateAction("InsertText");
		var dset = dact.CreateSet();
		size = ColumnArray.length;
		for (i = 0;i < size; i++){
			dset.SetItem("Text", ColumnArray[i]);
			if(i==4){
				dact.Execute(dset);
				pHwpCtrl.Run("TableSplitCellRow2");
				pHwpCtrl.Run("TableLowerCell");
			}else if(i==9){
				dact.Execute(dset);
				pHwpCtrl.Run("TableSplitCellRow2");
				pHwpCtrl.Run("TableLowerCell");
			}else{
				dact.Execute(dset);
				pHwpCtrl.Run("TableRightCell");
			}
		}
		return true;
	}else	{
		if (_DEBUG)
			alert("현재 커서의 위치가 표의 내부가 아님.");
		return false;
	}
}

function TableAppendRow(FirstCellName){
	if (pHwpCtrl.MoveToField(FirstCellName, false, false, false)){
		pHwpCtrl.Run("TableCellBlock");
		pHwpCtrl.Run("TableColPageDown");
		pHwpCtrl.Run("Cancel");
		pHwpCtrl.Run("TableAppendRow");
		return true;
	}else	{
		if (_DEBUG)
			alert("셀필드(" + FirstCellName +")가 존재하지 않습니다.");
		return false;
	}
}


// 표에 마지막 행을 추가하고, 내용을 채운다.
function TableAppendRowContents(FirstCellName, ColumnArray){
	if(TableAppendRow(FirstCellName))
		TableColumnContents(ColumnArray);
}

function TableAppendRowContents2(FirstCellName, ColumnArray){
	if(TableAppendRow(FirstCellName))
		TableColumnContents2(ColumnArray);
}



function TableColumnContents2(ColumnArray){
	if (pHwpCtrl.ParentCtrl.CtrlID == "tbl"){ 
		var i;
		var size;
		var dact = pHwpCtrl.CreateAction("InsertText");
		var dset = dact.CreateSet();
		size = ColumnArray.length;
		for (i = 0;i < size; i++){
			dset.SetItem("Text", ColumnArray[i]);
			dact.Execute(dset);
			pHwpCtrl.Run("TableRightCell");
		}
		return true;
	}else	{
		if (_DEBUG)
			alert("현재 커서의 위치가 표의 내부가 아님.");
		return false;
	}
}

function TableDeleteRow(FirstCellName){
	if (pHwpCtrl.MoveToField(FirstCellName, false, false, false))
	{
		pHwpCtrl.Run("TableDeleteRow");
	}
}

function OnStart(){
	//BasePath = _GetBasePath();
	pHwpCtrl = HwpControl.HwpCtrl;

	if(!_VerifyVersion()){
		location.href='<?=$PHP_SELF?>';
		return;
	}
	if (_DEBUG) pHwpCtrl.SetClientName("DEBUG"); // Release 할 때는 이부분을 제거한다.

	InitToolBarJS();

	var frm = document.HwpControl;
	var act = pHwpCtrl.CreateAction("InsertText");
	var set = act.CreateSet();

	var pay_count = frm.pay_count.value;
	var pay_page = frm.pay_page.value;

	if(pay_page > 1) pay_table = 'settle_report_'+pay_page+'page.hwp';
	else pay_table = 'settle_report.hwp';

	if(!pHwpCtrl.Open(BasePath + "/files/docs/"+pay_table)) {
		alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
	}else{
		alphabet = "abcdefghijklmnopqrstuvwxyyz";

		if (pHwpCtrl.MoveToField("결산년도", true, true, false)){set.SetItem("Text",frm.pay_year.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("결산월", true, true, false)){set.SetItem("Text",frm.pay_month.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("업무지원", true, true, false)){set.SetItem("Text",frm.service_support_staff.value);act.Execute(set);}

		for(k=1;k<=pay_page;k++) {
			if(k == 1) {
				p = "";
				u = "";
			} else {
				p = k;
				u = alphabet.charAt(k-1);
			}
		}
		if(pay_page == 1) tr_count = 24;
		else if(pay_page == 2) tr_count = 53;
		else tr_count = 53;
		for(i=0;i<=tr_count;i++) {
			if (pHwpCtrl.MoveToField("업체명"+i, true, true, false)){set.SetItem("Text",frm.com_name[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("담당자"+i, true, true, false)){set.SetItem("Text",frm.person_charge[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("신청"+i, true, true, false)){set.SetItem("Text",frm.application_kind[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("입금일"+i, true, true, false)){set.SetItem("Text",frm.main_receipt_date[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("업체입금"+i, true, true, false)){set.SetItem("Text",frm.client_receipt_fee[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("보수"+i, true, true, false)){set.SetItem("Text",frm.p_support[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통장"+i, true, true, false)){set.SetItem("Text",frm.requested_amount[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("수입"+i, true, true, false)){set.SetItem("Text",frm.main_income[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("김봉균"+i, true, true, false)){set.SetItem("Text",frm.lawyer_fee[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("수당"+i, true, true, false)){set.SetItem("Text",frm.allowance_rate[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("용역비"+i, true, true, false)){set.SetItem("Text",frm.allowance_pay[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("비고"+i, true, true, false)){set.SetItem("Text",frm.remark_text[i].value);act.Execute(set);}
		}
		for(k=0;k<pay_page;k++) {
			if(k == 0) m = "";
			else m = k+1;
		}
		//총계
		if (pHwpCtrl.MoveToField("업체입금s", true, true, false)){set.SetItem("Text",frm.client_receipt_fee_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통장s", true, true, false)){set.SetItem("Text",frm.requested_amount_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("수입s", true, true, false)){set.SetItem("Text",frm.main_income_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("김봉균s", true, true, false)){set.SetItem("Text",frm.lawyer_fee_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("용역비s", true, true, false)){set.SetItem("Text",frm.allowance_pay_sum_t.value);act.Execute(set);}
	}
	pHwpCtrl.MovePos(2);
}
$(document).ready(function(e) {
	if(myagent == 'ie' || myagent == 'ns') {
		OnStart();
	}else{
		alert('Active X를 지원하지 않는 브라우저에서는 한글컨트롤을 사용할 수 없습니다!');
		location.href='index.php';
	}		
});