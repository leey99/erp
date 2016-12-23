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
//	HwpControl.HwpCtrl.SetToolBar(3, "FileNew, FileSave, FileSaveAs, FileOpen");
	/*
	HwpControl.HwpCtrl.SetToolBar(0, "FileNew, FileSave, FileSaveAs, FileOpen, Separator, FilePreview, Print, Separator, Undo, Redo, Separator, Cut, Copy, Paste,"
	+"Separator, ParaNumberBullet, MultiColumn, SpellingCheck, HwpDic, Separator, PictureInsertDialog, MacroPlay1");
	*/
	HwpControl.HwpCtrl.SetToolBar(0, "FilePreview, Print, Separator, Undo, Redo, Separator, Cut, Copy, Paste,"
	+"Separator, ParaNumberBullet, MultiColumn, SpellingCheck, HwpDic, Separator, PictureInsertDialog, MacroPlay1");
	/*
	HwpControl.HwpCtrl.SetToolBar(1, "DrawObjCreatorLine, DrawObjCreatorRectangle, DrawObjCreatorEllipse,"
	+"DrawObjCreatorArc, DrawObjCreatorPolygon, DrawObjCreatorCurve, DrawObjTemplateLoad,"
	+"Separator, ShapeObjSelect, ShapeObjGroup, ShapeObjUngroup, Separator, ShapeObjBringToFront,"
	+"ShapeObjSendToBack, ShapeObjDialog, ShapeObjAttrDialog");

	HwpControl.HwpCtrl.SetToolBar(2, "StyleCombo, CharShapeLanguage, CharShapeTypeFace, CharShapeHeight,"
	+"CharShapeBold, CharShapeItalic, CharShapeUnderline, ParagraphShapeAlignJustify, ParagraphShapeAlignLeft,"
	+"ParagraphShapeAlignCenter, ParagraphShapeAlignRight, Separator, ParaShapeLineSpacing,"
	+"ParagraphShapeDecreaseLeftMargin, ParagraphShapeIncreaseLeftMargin");
	*/
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

	if(frm.comp_type.value=='A') {
		if(frm.work_form.value == '2') {
			labor1='labor_1a_contract.hwp';
		} else if(frm.work_form.value == '3') {
			labor1='labor_1a_temporary.hwp';
		} else {
			labor1='labor_1a.hwp';
		}
		if(frm.pay_gbn.value == '3') {
			labor1='labor_1a_annual_salary.hwp';
		}
	}else if(frm.comp_type.value=='B'){
		labor1='labor_1b.hwp';
	}else if(frm.comp_type.value=='D'){
		labor1='labor_1d.hwp';
	}else{
		labor1='labor_1c.hwp';
	}

	switch(pName){
		case 'labor1': // 근로계약서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/"+labor1)){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("[별정수당1]", true, true, false)) {	set.SetItem("Text",frm.addtxt11_0.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[별정수당2]", true, true, false)) {	set.SetItem("Text",frm.addtxt11_1.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[별정수당3]", true, true, false)) {	set.SetItem("Text",frm.addtxt11_2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[별정수당4]", true, true, false)) {	set.SetItem("Text",frm.addtxt11_3.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[별정수당5]", true, true, false)) {	set.SetItem("Text",frm.addtxt11_4.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[별정수당6]", true, true, false)) {set.SetItem("Text",frm.addtxt11_5.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[별정수당금액1]", true, true, false)) {	set.SetItem("Text",frm.addtxt12_0.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[별정수당금액2]", true, true, false)) {	set.SetItem("Text",frm.addtxt12_1.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[별정수당금액3]", true, true, false)) {	set.SetItem("Text",frm.addtxt12_2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[별정수당금액4]", true, true, false)) {	set.SetItem("Text",frm.addtxt12_3.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[별정수당금액5]", true, true, false)) {set.SetItem("Text",frm.addtxt12_4.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[별정수당금액6]", true, true, false)) {set.SetItem("Text",frm.addtxt12_5.value);act.Execute(set);}

				if (pHwpCtrl.MoveToField("[호봉]", true, true, false)) {	set.SetItem("Text",frm.job_grade.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[오늘날짜]", true, true, false)) {set.SetItem("Text",frm.today.value);act.Execute(set);}
			
				if (pHwpCtrl.MoveToField("[사업장명]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장명1]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}

				if (pHwpCtrl.MoveToField("[사업자등록번호]", true, true, false)) {	set.SetItem("Text",frm.comp_num.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장대표]", true, true, false)) {	set.SetItem("Text",frm.comp_ceo.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장대표1]", true, true, false)) {	set.SetItem("Text",frm.comp_ceo.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장주소]", true, true, false)) {	set.SetItem("Text",frm.comp_addr1.value +''+frm.comp_addr2.value );		act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장주소1]", true, true, false)) {	set.SetItem("Text",frm.comp_addr1.value +''+frm.comp_addr2.value );		act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장주소2]", true, true, false)) {	set.SetItem("Text",frm.comp_addr1.value +''+frm.comp_addr2.value );		act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[직종]", true, true, false)) {	set.SetItem("Text",frm.jikjong.value );	act.Execute(set);	}

				if (pHwpCtrl.MoveToField("[사원성명]", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사원성명1]", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사원주민번호]", true, true, false)) {	set.SetItem("Text",frm.jumin.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사원주민번호1]", true, true, false)) {	set.SetItem("Text",frm.jumin.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사원주소]", true, true, false)) {	set.SetItem("Text",frm.addr.value +''+ frm.addr2.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사원주소1]", true, true, false)) {	set.SetItem("Text",frm.addr.value +''+ frm.addr2.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사원전화]", true, true, false)) {	set.SetItem("Text",frm.tel.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[입사일자]", true, true, false)) {	set.SetItem("Text",frm.jdate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[퇴직일자]", true, true, false)) {	set.SetItem("Text",frm.edate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[채용형태]", true, true, false)) {	set.SetItem("Text",frm.job_div.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[계약시작일]", true, true, false)) {	set.SetItem("Text",frm.contract_sdate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[계약종료일]", true, true, false)) {	set.SetItem("Text",frm.contract_edate.value );	act.Execute(set);	}

				if (pHwpCtrl.MoveToField("소정근로시간1", true, true, false)) {	set.SetItem("Text",frm.workhour_40.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("소정근로시간2", true, true, false)) {	set.SetItem("Text",frm.workhour_44.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[출근시간]", true, true, false)) {	set.SetItem("Text",frm.stime.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[퇴근시간]", true, true, false)) {	set.SetItem("Text",frm.etime.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[휴게시간]", true, true, false)) {	set.SetItem("Text",frm.rest2.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("토요일근무1", true, true, false)) {	set.SetItem("Text",frm.saturday1.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("토요일근무2", true, true, false)) {	set.SetItem("Text",frm.saturday2.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[토요일근무시작]", true, true, false)) {	set.SetItem("Text",frm.saturday_s.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[토요일근무종료]", true, true, false)) {	set.SetItem("Text",frm.saturday_e.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[근무일1]", true, true, false)) {	set.SetItem("Text",frm.workday1.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[근무일2]", true, true, false)) {	set.SetItem("Text",frm.workday2.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[근무일3]", true, true, false)) {	set.SetItem("Text",frm.workday3.value );	act.Execute(set);	}

				if (pHwpCtrl.MoveToField("시급", true, true, false)) {	set.SetItem("Text",frm.time_chk.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("일급", true, true, false)) {	set.SetItem("Text",frm.day_chk.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[시급일급]", true, true, false)) {set.SetItem("Text",frm.timegub.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[산정1]", true, true, false)) {set.SetItem("Text",frm.calculate1.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[산정2]", true, true, false)) {set.SetItem("Text",frm.calculate2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("직접지급", true, true, false)) {set.SetItem("Text",frm.payment1.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("입금", true, true, false)) {set.SetItem("Text",frm.payment2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("주휴일", true, true, false)) {set.SetItem("Text",frm.hday.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("상여금1", true, true, false)) {set.SetItem("Text",frm.bonus1.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("상여금2", true, true, false)) {set.SetItem("Text",frm.bonus2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("상여금3", true, true, false)) {set.SetItem("Text",frm.bonus3.value);act.Execute(set);}

				if (pHwpCtrl.MoveToField("[일근무시간]", true, true, false)) {	set.SetItem("Text",frm.wtime.value );		act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[주소정근무시간]", true, true, false)) {	set.SetItem("Text",frm.jogun.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[기본급여]", true, true, false)) {	set.SetItem("Text",frm.pay1.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[과세수당합계]", true, true, false)) {	set.SetItem("Text",frm.pay2.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[비과세수당합계]", true, true, false)) {	set.SetItem("Text",frm.pay3.value );	act.Execute(set)	;}
				if (pHwpCtrl.MoveToField("[별정수당합계]", true, true, false)) {	set.SetItem("Text",frm.pay4.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[월급여총합계]", true, true, false)) {	set.SetItem("Text",frm.pay5.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[월급여총합계2]", true, true, false)) {	set.SetItem("Text",frm.pay5.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[연봉총액]", true, true, false)) {	set.SetItem("Text",frm.annual_salary.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[급여일]", true, true, false)) {	set.SetItem("Text",frm.pay_day.value );	act.Execute(set);	}
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

$(document).ready(function(e) {
	if(myagent == 'ie' || myagent == 'ns') {
		OnStart();
	}else{
		alert('Active X를 지원하지 않는 브라우저에서는 한글컨트롤을 사용할 수 없습니다!');
		location.href='index.php';
	}
});