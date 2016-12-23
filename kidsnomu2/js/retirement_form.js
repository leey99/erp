var BasePath = rooturl;  
var MinVersion = 0;//0x05050118;
var rowIndex = 1;
var tableIndex = 0;

var _DEBUG = true; // Debug mode.
var pHwpCtrl;

function OnStart(){

	//BasePath = _GetBasePath();
	pHwpCtrl = HwpControl.HwpCtrl;

	if(!_VerifyVersion()) {
		location.href='./';
		return;
	}
	if (_DEBUG) pHwpCtrl.SetClientName("DEBUG"); // Release 할 때는 이부분을 제거한다.

	InitToolBarJS();
	
	if(!pHwpCtrl.Open(BasePath + "/files/docs/default.hwp")){
		alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
	}else{
		if (pHwpCtrl.MoveToField("[회원명]", true, true, false)) {	
			var act = pHwpCtrl.CreateAction("InsertText");
			var set = act.CreateSet();
			set.SetItem("Text",document.HwpControl.mb_name.value );
			act.Execute(set);
		}
	}

	if(document.HwpControl.labor.value != '') {
		pageLoad(document.HwpControl.labor.value);
	}

}
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


function pageLoad(pName){
	//alert('준비중입니다!'); return;

	var labor1 ='';
	var frm = document.HwpControl;

	var now = new Date();
	var nowLs = ''+now.toLocaleString();
	var yyyy = ''+now.getFullYear();
	var mm = ''+(now.getMonth()+1);
	var dd = ''+now.getDate();
	var toDay = yyyy +' 년  '+ mm + ' 월  ' + dd + ' 일';


	var act = pHwpCtrl.CreateAction("InsertText");
	var set = act.CreateSet();

	labor1='retirement_list.hwp';

	switch(pName){
		case 'labor1': // 근로계약서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/"+labor1)){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("[상호명]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[발행일]", true, true, false)) {set.SetItem("Text",toDay);act.Execute(set);}

				for(i=0;i<16;i++){
					if (pHwpCtrl.MoveToField("[no"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.no[i].value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("[직위"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.jik[i].value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("[성명"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.name_k[i].value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("[주민등록번호"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.jumin[i].value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("[자격증"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.license[i].value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("[자격번호"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.license_no[i].value );	act.Execute(set);	}

					if (pHwpCtrl.MoveToField("[주소"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.addr[i].value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("[입사일자"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.jdate[i].value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("[호봉"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.job_grade[i].value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("[퇴직일자"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.edate[i].value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("[퇴직사유"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.retire_reason[i].value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("[집전화"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.tel[i].value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("[휴대번호"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.cel[i].value );	act.Execute(set);	}
				}
			}
			break;

		default:
			if(!pHwpCtrl.Open(BasePath + "/files/docs/default.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("[회원명]", true, true, false)) {	
					var act = pHwpCtrl.CreateAction("InsertText");
					var set = act.CreateSet();
					set.SetItem("Text",frm.mb_name.value );
					act.Execute(set);
				}
			}
	}
	pHwpCtrl.MovePos(2);
}

function toggleLayer(id,name){
	document.HwpControl.labor.value = name;
}

function toggleLayer2(id,name){
	document.HwpControl.labor.value = name;
}

function goSubmit(name){
	document.HwpControl.labor.value = name;
	document.HwpControl.submit();
}


$(document).ready(function(e) {
	if(myagent=='ie'){
		OnStart();
	}else{
		alert('Active X를 지원하지 않는 브라우저에서는 한글컨트롤을 사용할 수 없습니다!');
		location.href='index.php';
	}
});