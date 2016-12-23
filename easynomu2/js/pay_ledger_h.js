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
		location.href='main.php';
		return;
	}
	if (_DEBUG) pHwpCtrl.SetClientName("DEBUG"); // Release 할 때는 이부분을 제거한다.
	InitToolBarJS();
	var frm = document.HwpControl;
	var act = pHwpCtrl.CreateAction("InsertText");
	var set = act.CreateSet();
	var pay_count = frm.pay_count.value;
	var pay_page = frm.pay_page.value;
	pay_table = 'pay_ledger_h_'+pay_page+'page.hwp';
	if(!pHwpCtrl.Open(BasePath + "/files/docs/"+pay_table)) {
		alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
	}else{
		alphabet = "abcdefghijklmnopqrstuvwxyyz";
		for(k=1;k<=pay_page;k++) {
			if(k == 1) {
				p = "";
				u = "";
			} else {
				p = k;
				u = alphabet.charAt(k-1);
			}
			if (pHwpCtrl.MoveToField("[사업장"+p+"]", true, true, false)){set.SetItem("Text",frm.company.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[급여년도"+p+"]", true, true, false)){set.SetItem("Text",frm.pay_year.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[급여월"+p+"]", true, true, false)){set.SetItem("Text",frm.pay_month.value);act.Execute(set);}
		}
		tr_count = pay_page * 15;
		for(i=0;i<=tr_count;i++) {
			if (pHwpCtrl.MoveToField("연번"+i, true, true, false)){set.SetItem("Text",frm.no[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[성명"+i+"]", true, true, false)){set.SetItem("Text",frm.pay_name[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[입사일"+i+"]", true, true, false)){set.SetItem("Text",frm.jdate[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("주민등록번호"+i, true, true, false)){set.SetItem("Text",frm.ssnb[i].value);act.Execute(set);}
			//근로시간
			if (pHwpCtrl.MoveToField("[소계"+i+"]", true, true, false)){set.SetItem("Text",frm.w_sum[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("평근a"+i, true, true, false)){set.SetItem("Text",frm.w_1[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("평근b"+i, true, true, false)){set.SetItem("Text",frm.w_2[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("평근c"+i, true, true, false)){set.SetItem("Text",frm.w_3[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("휴심a"+i, true, true, false)){set.SetItem("Text",frm.w_1_hday[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("휴심b"+i, true, true, false)){set.SetItem("Text",frm.w_2_hday[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("휴심c"+i, true, true, false)){set.SetItem("Text",frm.w_3_hday[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("교육시간"+i, true, true, false)){set.SetItem("Text",frm.w_edu[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("스마트폰"+i, true, true, false)){set.SetItem("Text",frm.w_phone[i].value);act.Execute(set);}
			//연차수당 = 교통지원금
			if (pHwpCtrl.MoveToField("연차수당"+i, true, true, false)){set.SetItem("Text",frm.annual_paid_holiday[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("급여총액"+i, true, true, false)){set.SetItem("Text",frm.money_for_tax[i].value);act.Execute(set);}
			//갑근세
			if (pHwpCtrl.MoveToField("소득세"+i, true, true, false)){set.SetItem("Text",frm.tax_so[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("주민세"+i, true, true, false)){set.SetItem("Text",frm.tax_jumin[i].value);act.Execute(set);}
			//사회보험
			if (pHwpCtrl.MoveToField("연금보험"+i, true, true, false)){set.SetItem("Text",frm.yun[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("건강보험"+i, true, true, false)){set.SetItem("Text",frm.health[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("장기요양"+i, true, true, false)){set.SetItem("Text",frm.yoyang[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("고용보험"+i, true, true, false)){set.SetItem("Text",frm.goyong[i].value);act.Execute(set);}
			//공제합계
			if (pHwpCtrl.MoveToField("공제계"+i, true, true, false)){set.SetItem("Text",frm.m_sum[i].value);act.Execute(set);}
			//실제 지급액
			if (pHwpCtrl.MoveToField("지급총액"+i, true, true, false)){set.SetItem("Text",frm.money_result[i].value);act.Execute(set);}
		}
		//총계
		if (pHwpCtrl.MoveToField("[소계t]", true, true, false)){set.SetItem("Text",frm.w_sum_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("평근at", true, true, false)){set.SetItem("Text",frm.w_1_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("평근bt", true, true, false)){set.SetItem("Text",frm.w_2_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("평근ct", true, true, false)){set.SetItem("Text",frm.w_3_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("휴심at", true, true, false)){set.SetItem("Text",frm.w_1_hday_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("휴심bt", true, true, false)){set.SetItem("Text",frm.w_2_hday_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("휴심ct", true, true, false)){set.SetItem("Text",frm.w_3_hday_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("교육시간t", true, true, false)){set.SetItem("Text",frm.w_edu_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("스마트폰t", true, true, false)){set.SetItem("Text",frm.w_phone_sum_t.value);act.Execute(set);}
		//연차수당 = 교통지원금
		if (pHwpCtrl.MoveToField("연차수당t", true, true, false)){set.SetItem("Text",frm.annual_paid_holiday_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("급여총액t", true, true, false)){set.SetItem("Text",frm.money_for_tax_sum_t.value);act.Execute(set);}
		//갑근세
		if (pHwpCtrl.MoveToField("주민세t", true, true, false)){set.SetItem("Text",frm.tax_jumin_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("소득세t", true, true, false)){set.SetItem("Text",frm.tax_so_sum_t.value);act.Execute(set);}
		//사회보험
		if (pHwpCtrl.MoveToField("연금보험t", true, true, false)){set.SetItem("Text",frm.yun_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("건강보험t", true, true, false)){set.SetItem("Text",frm.health_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("장기요양t", true, true, false)){set.SetItem("Text",frm.yoyang_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("고용보험t", true, true, false)){set.SetItem("Text",frm.goyong_sum_t.value);act.Execute(set);}
		//공제합계
		if (pHwpCtrl.MoveToField("공제계t", true, true, false)){set.SetItem("Text",frm.m_sum_sum_t.value);act.Execute(set);}
		//실제 지급액
		if (pHwpCtrl.MoveToField("지급총액t", true, true, false)){set.SetItem("Text",frm.money_result_sum_t.value);act.Execute(set);}
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