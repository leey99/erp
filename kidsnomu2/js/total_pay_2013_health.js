var BasePath = rooturl;  
var MinVersion = 0;//0x05050118;
var rowIndex = 1;
var tableIndex = 0;
var _DEBUG = true; // Debug mode.
var pHwpCtrl;
//custom Toolbar 사용시 기본 액션에는 새로만들기, 저장, 다른이름으로 저장, 열기, 가 없는데 대체 액션을 만들어서 사용
//html의 onstart()에 다음과 같이 넣고 사용하면 된다. 상단에 함수로 onstart있다.
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
//	if(pHwpCtrl.getAttribute("Version") == null){
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
	if(pay_count > 13 && pay_count <39) pay_table = 'total_pay_health_2page.hwp';
	else if(pay_count > 38) pay_table = 'total_pay_healt_3page.hwp';
	else pay_table = 'total_pay_health.hwp';
	if(!pHwpCtrl.Open(BasePath + "/files/docs/"+pay_table)) {
		alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
	}else{
		if (pHwpCtrl.MoveToField("사업장명", true, true, false)){set.SetItem("Text",frm.company.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("사업장명2", true, true, false)){set.SetItem("Text",frm.company.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("사업장관리번호", true, true, false)){set.SetItem("Text",frm.t_no.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("전화번호", true, true, false)){set.SetItem("Text",frm.tel.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("팩스번호", true, true, false)){set.SetItem("Text",frm.fax.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("대표자", true, true, false)){set.SetItem("Text",frm.ceo.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("오늘날짜", true, true, false)){set.SetItem("Text",frm.today.value);act.Execute(set);}

		if(pay_count > 13 && pay_count < 38) tr_count = '37';
		else if(pay_count > 37 && pay_count < 46) tr_count = 46;
		else tr_count = 13;
		for(i=0;i<=tr_count;i++){
			if (pHwpCtrl.MoveToField("no"+i, true, true, false)){set.SetItem("Text",frm.no[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("성명"+i, true, true, false)){set.SetItem("Text",frm.pay_name[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("주민등록번호"+i, true, true, false)){set.SetItem("Text",frm.ssnb[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("취득일"+i, true, true, false)){set.SetItem("Text",frm.sdate[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("보수총액"+i, true, true, false)){set.SetItem("Text",frm.ypay[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("근무"+i, true, true, false)){set.SetItem("Text",frm.month[i].value);act.Execute(set);}
		}
	}
	pHwpCtrl.MovePos(2);
}
$(document).ready(function(e) {
	if(myagent=='ie' || myagent=='ns') {
		OnStart();
	} 
else {
		alert('Active X를 지원하지 않는 브라우저에서는 한글컨트롤을 사용할 수 없습니다!');
		location.href='index.php';
	}		
});