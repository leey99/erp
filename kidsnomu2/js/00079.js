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

	if(frm.comp_type.value=='A'){
		labor1='labor_1a.hwp';
	}else if(frm.comp_type.value=='B'){
		labor1='labor_1b.hwp';
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
				if (pHwpCtrl.MoveToField("[시간급]", true, true, false)) {set.SetItem("Text",frm.timegub.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[오늘날짜]", true, true, false)) {set.SetItem("Text",frm.today.value);act.Execute(set);}
			
				if (pHwpCtrl.MoveToField("[사업장명1]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장명2]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장명3]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장명4]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장명5]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장명6]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장명7]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장명8]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장명9]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장명10]", true, true, false)) {set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장명11]", true, true, false)) {set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장명12]", true, true, false)) {set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}

				if (pHwpCtrl.MoveToField("[사업자등록번호]", true, true, false)) {	set.SetItem("Text",frm.comp_num.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장대표]", true, true, false)) {	set.SetItem("Text",frm.comp_ceo.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장주소]", true, true, false)) {	set.SetItem("Text",frm.comp_addr1.value +' '+frm.comp_addr2.value );		act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장업태]", true, true, false)) {	set.SetItem("Text",frm.comp_upte.value );	act.Execute(set);	}

				if (pHwpCtrl.MoveToField("[사원성명1]", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사원성명2]", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[주민등록번호]", true, true, false)) {	set.SetItem("Text",frm.jumin.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사원주소]", true, true, false)) {	set.SetItem("Text",frm.addr.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[입사일자1]", true, true, false)) {	set.SetItem("Text",frm.jdate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[입사일자2]", true, true, false)) {	set.SetItem("Text",frm.jdate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[채용형태]", true, true, false)) {	set.SetItem("Text",frm.job_div.value );	act.Execute(set);	}

				if (pHwpCtrl.MoveToField("[출근시간]", true, true, false)) {	set.SetItem("Text",frm.stime.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[퇴근시간]", true, true, false)) {	set.SetItem("Text",frm.etime.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[일근무시간]", true, true, false)) {	set.SetItem("Text",frm.wtime.value );		act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[주소정근무시간]", true, true, false)) {	set.SetItem("Text",frm.jogun.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[기본급여]", true, true, false)) {	set.SetItem("Text",frm.pay1.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[과세수당합계]", true, true, false)) {	set.SetItem("Text",frm.pay2.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[비과세수당합계]", true, true, false)) {	set.SetItem("Text",frm.pay3.value );	act.Execute(set)	;}
				if (pHwpCtrl.MoveToField("[별정수당합계]", true, true, false)) {	set.SetItem("Text",frm.pay4.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[월급여총합계]", true, true, false)) {	set.SetItem("Text",frm.pay5.value );	act.Execute(set);	}
			}
			break;
		
		case 'labor15': // 경력증명서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_15.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}
			else{


				if (pHwpCtrl.MoveToField("[근로자성명]", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[근로자주민번호]", true, true, false)) {	set.SetItem("Text",frm.jumin.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[근로자주소]", true, true, false)) {	set.SetItem("Text",frm.addr.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[입사일자]", true, true, false)) {	set.SetItem("Text",frm.jdate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업주성명]", true, true, false)){set.SetItem("Text",frm.comp_ceo.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장명]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[근무부서]", true, true, false)){set.SetItem("Text",frm.dept.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[직위]", true, true, false)){set.SetItem("Text",frm.jik.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사원전화번호]", true, true, false)){set.SetItem("Text",frm.cel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[퇴직일자]", true, true, false)) {	set.SetItem("Text",frm.career.value );	act.Execute(set);	}		
				
			}
			break;
			
		case 'labor16': // 재직증명서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_16.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("[사업장전화번호]", true, true, false)){set.SetItem("Text",frm.comp_tel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장주소]", true, true, false)){set.SetItem("Text",frm.comp_addr1.value+' '+frm.comp_addr2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[근로자성명]", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[근로자주민번호]", true, true, false)) {	set.SetItem("Text",frm.jumin.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[근로자주소]", true, true, false)) {	set.SetItem("Text",frm.addr.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[입사일자]", true, true, false)) {	set.SetItem("Text",frm.jdate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업주성명]", true, true, false)){set.SetItem("Text",frm.comp_ceo.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장명1]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장명2]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[근무부서]", true, true, false)){set.SetItem("Text",frm.dept.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[직급]", true, true, false)){set.SetItem("Text",frm.jik.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사원전화번호]", true, true, false)){set.SetItem("Text",frm.cel.value);act.Execute(set);}
				
			}
			break;			
		case 'labor17': // 개인정보활용동의서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_17.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("[사업장명]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
			}
			break;			
						
		case 'labor2': // 인사기록부
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_2.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("[사업장명]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[상호명]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업주명]", true, true, false)) {	set.SetItem("Text",frm.comp_ceo.value );	act.Execute(set);	}

				if (pHwpCtrl.MoveToField("[사원명]", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사원성명]", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사원명1]", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사원명2]", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사원명3]", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}

				if (pHwpCtrl.MoveToField("[입사일]", true, true, false)) {	set.SetItem("Text",frm.jdate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[입사일1]", true, true, false)) {	set.SetItem("Text",frm.jdate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[입사일2]", true, true, false)) {	set.SetItem("Text",frm.jdate.value );	act.Execute(set);	}

				if (pHwpCtrl.MoveToField("[사원주민번호]", true, true, false)) {	set.SetItem("Text",frm.jumin.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[성별]", true, true, false)) {	set.SetItem("Text",frm.sex.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[생년월일]", true, true, false)) {	set.SetItem("Text",frm.birth.value+frm.lunar.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사원주소]", true, true, false)) {	set.SetItem("Text",frm.addr.value );	act.Execute(set);	}

				if (pHwpCtrl.MoveToField("[신장]", true, true, false)) {	set.SetItem("Text",frm.body_1.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[체중]", true, true, false)) {	set.SetItem("Text",frm.body_2.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[좌시력]", true, true, false)) {	set.SetItem("Text",frm.body_4.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[우시력]", true, true, false)) {	set.SetItem("Text",frm.body_5.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[혈액형]", true, true, false)) {	set.SetItem("Text",frm.body_3.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[건강상태]", true, true, false)) {	set.SetItem("Text",frm.body_6.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[질병]", true, true, false)) {	set.SetItem("Text",frm.body_6.value );	act.Execute(set);	}

				if (pHwpCtrl.MoveToField("[특기]", true, true, false)) {	set.SetItem("Text",frm.etc_1.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[취미]", true, true, false)) {	set.SetItem("Text",frm.etc_2.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[종교]", true, true, false)) {	set.SetItem("Text",frm.etc_3.value );	act.Execute(set);	}

				// 가족관계
				//alert(parseInt(frm.family.length/5));
				//for(i=0;i<parseInt(frm.family.length/5);i++){
				for(i=0;i<6;i++){
				if (pHwpCtrl.MoveToField("[성명"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.family[i*5+0].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[관계"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.family[i*5+1].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[생일"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.family[i*5+2].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[직업"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.family[i*5+3].value );	act.Execute(set);	}
				//if (pHwpCtrl.MoveToField("[학력"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.family[i*5+4].value );	act.Execute(set);	}
				}
				if (pHwpCtrl.MoveToField("[학력1]", true, true, false)) {	set.SetItem("Text",' ' );	act.Execute(set);	}
				
				// 학력사항
				for(i=0;i<6;i++){
				if (pHwpCtrl.MoveToField("[입학일"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.school[i*5+0].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[졸업일"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.school[i*5+1].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[학교명"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.school[i*5+2].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[전공학과"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.school[i*5+3].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[학위"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.school[i*5+4].value );	act.Execute(set);	}
				}

				//경력사항
				for(i=0;i<6;i++){
				if (pHwpCtrl.MoveToField("[입사"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.career[i*5+0].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[퇴사"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.career[i*5+1].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[근무처"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.career[i*5+2].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[직위"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.career[i*5+3].value );	act.Execute(set);	}
				}

				// 교육사항
				for(i=0;i<6;i++){
				if (pHwpCtrl.MoveToField("[교육명"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.edu[i*5+0].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[교육내용"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.edu[i*5+1].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[교육시작일"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.edu[i*5+2].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[교육종료일"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.edu[i*5+3].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[교육기관"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.edu[i*5+4].value );	act.Execute(set);	}
				}

				// 징계경고
				for(i=0;i<13;i++){
				if (pHwpCtrl.MoveToField("[징계내용"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.penalty[i*4+0].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[시작일"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.penalty[i*4+1].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[종료일"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.penalty[i*4+2].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[징계사유"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.penalty[i*4+3].value );	act.Execute(set);	}
				}

				// 포상서훈
				for(i=0;i<5;i++){
				if (pHwpCtrl.MoveToField("[포상내용"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.prize[i*3+0].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[년월일"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.prize[i*3+1].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[시행청"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.prize[i*3+2].value );	act.Execute(set);	}
				}

				// 인사발령
				for(i=0;i<19;i++){
				if (pHwpCtrl.MoveToField("[발령구분"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.insa[i*4+0].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[발령일자"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.insa[i*4+1].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[인사발령사항"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.insa[i*4+2].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[비고사항"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.insa[i*4+3].value );	act.Execute(set);	}
				}
			}
			break;
		case 'labor3': // 재직자명부
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_3.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("[사업장명]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[발행일자]", true, true, false)){set.SetItem("Text",toDay);act.Execute(set);}
				this.setAppendRow1();
			}
			break;
		case 'labor4': // 퇴사자명부
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_4.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("[사업장명]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[발행일자]", true, true, false)){set.SetItem("Text",toDay);act.Execute(set);}
				this.setAppendRow2();
			}
			break;
		case 'labor5': // 퇴직금신청서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_5.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("[상호명]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[성명]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[신청인]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[신청일자]", true, true, false)){set.SetItem("Text",toDay);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[입사일자]", true, true, false)){set.SetItem("Text",frm.jdate.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사원번호]", true, true, false)){set.SetItem("Text",frm.employee_id.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[소속부서]", true, true, false)){set.SetItem("Text",frm.dept.value);act.Execute(set);}
			}
			break;
		case 'labor6': // 퇴직연금급여신청서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_6.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("[사업장명]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업자등록번호]", true, true, false)){set.SetItem("Text",frm.comp_num.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장전화번호]", true, true, false)){set.SetItem("Text",frm.comp_tel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장팩스번호]", true, true, false)){set.SetItem("Text",frm.comp_fax.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업자핸드폰번호]", true, true, false)){set.SetItem("Text",frm.comp_cel.value);act.Execute(set);}

				if (pHwpCtrl.MoveToField("[사원성명]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사원주민등록번호]", true, true, false)){set.SetItem("Text",frm.jumin.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사원주소]", true, true, false)){set.SetItem("Text",frm.addr.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사원핸드폰번호]", true, true, false)){set.SetItem("Text",frm.cel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사원집전화번호]", true, true, false)){set.SetItem("Text",frm.tel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사원이메일주소]", true, true, false)){set.SetItem("Text",frm.email.value);act.Execute(set);}

				if (pHwpCtrl.MoveToField("[지급받는사람명]", true, true, false)){set.SetItem("Text",frm.bank_3.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[은행명]", true, true, false)){set.SetItem("Text",frm.bank_1.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[계좌번호]", true, true, false)){set.SetItem("Text",frm.bank_2.value);act.Execute(set);}
			}
			break;
		case 'labor7': // 육아휴직,육아기 근로시간 단축급여 신청서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_7.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("[성명]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[주민등록번호]", true, true, false)){set.SetItem("Text",frm.jumin.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[주소]", true, true, false)){set.SetItem("Text",frm.addr.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[휴대전화]", true, true, false)){set.SetItem("Text",frm.cel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[집전화]", true, true, false)){set.SetItem("Text",frm.tel.value);act.Execute(set);}

				if (pHwpCtrl.MoveToField("[예금주]", true, true, false)){set.SetItem("Text",frm.bank_3.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[은행명]", true, true, false)){set.SetItem("Text",frm.bank_1.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[계좌번호]", true, true, false)){set.SetItem("Text",frm.bank_2.value);act.Execute(set);}

				if (pHwpCtrl.MoveToField("[신청인]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[신청(고)인]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
			}
			break;
		case 'labor8': // 출산전후 급여신청서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_8.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("[성명]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[주민등록번호]", true, true, false)){set.SetItem("Text",frm.jumin.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[주소]", true, true, false)){set.SetItem("Text",frm.addr.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[휴대전화]", true, true, false)){set.SetItem("Text",frm.cel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[전화번호]", true, true, false)){set.SetItem("Text",frm.tel.value);act.Execute(set);}

				if (pHwpCtrl.MoveToField("[예금주]", true, true, false)){set.SetItem("Text",frm.bank_3.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[은행명]", true, true, false)){set.SetItem("Text",frm.bank_1.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[계좌번호]", true, true, false)){set.SetItem("Text",frm.bank_2.value);act.Execute(set);}

				if (pHwpCtrl.MoveToField("[신청인]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[신청(고)인]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
			}
			break;
		case 'labor9': // 출산전후 휴가확인서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_9.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("[사업자등록번호]", true, true, false)){set.SetItem("Text",frm.comp_num.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장명]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장주소]", true, true, false)){set.SetItem("Text",frm.addr.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[이메일주소]", true, true, false)){set.SetItem("Text",frm.comp_email.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[전화]", true, true, false)){set.SetItem("Text",frm.comp_tel.value);act.Execute(set);}

				if (pHwpCtrl.MoveToField("[사원명]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사원주민등록번호]", true, true, false)){set.SetItem("Text",frm.jumin.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[근로자성명]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[대표자성명]", true, true, false)){set.SetItem("Text",frm.comp_ceo.value);act.Execute(set);}
			}
			break;
		case 'labor10': // 출산전후 휴가확인서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_10.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("[사업장관리번호]", true, true, false)){set.SetItem("Text",frm.comp_num.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업자등록번호]", true, true, false)){set.SetItem("Text",frm.comp_num.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장명]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[이메일주소]", true, true, false)){set.SetItem("Text",frm.comp_email.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장전화]", true, true, false)){set.SetItem("Text",frm.comp_tel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장팩스]", true, true, false)){set.SetItem("Text",frm.comp_fax.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장주소]", true, true, false)){set.SetItem("Text",frm.comp_addr1.value+' '+frm.comp_addr2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[작성일자]", true, true, false)){set.SetItem("Text",toDay);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장대표]", true, true, false)){set.SetItem("Text",frm.comp_ceo.value);act.Execute(set);}
			}
			break;
		case 'labor11': // 사원별휴가관리대장
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_11.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("[사원번호]", true, true, false)){set.SetItem("Text",frm.employee_id.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[성명]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[입사일자]", true, true, false)){set.SetItem("Text",frm.jdate.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[발행연도]", true, true, false)){set.SetItem("Text",yyyy+" 년");act.Execute(set);}
				this.setAppendRow3();
			}
			break;
		case 'labor12': // 연차관리대장
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_12.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("[해당년도]", true, true, false)){set.SetItem("Text",frm.sYear.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장명]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				this.setAppendRow4();
			}
			break;
		case 'labor13': // 근태관리대장(사원)
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_13.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("[소속부서]", true, true, false)){set.SetItem("Text",frm.dept.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[직급]", true, true, false)){set.SetItem("Text",frm.jik.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사원성명]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[해당년도]", true, true, false)){set.SetItem("Text",frm.yy2.value+' 년도');act.Execute(set);}
				this.setAppendRow5();
			}
			break;
		case 'labor14': // 근태관리대장(전체)
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_14.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("[해당년월]", true, true, false)){set.SetItem("Text",frm.yy.value+'년 '+frm.mm.value+'월 ');act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장명]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				this.setAppendRow6();
			}
			break;
		case 'labor18': // 연차휴가합의서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_18.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("[사업장명1]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사원성명1]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장명2]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사원성명2]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장명3]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사원성명3]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장명4]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사원성명4]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장명5]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}

				if (pHwpCtrl.MoveToField("[사업장명6]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				this.setAppendRow1();
			}
			break;
		case 'employee_01': // 근로자대표선임동의서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/employee_01.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("[사업장명1]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장명2]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장명3]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장명4]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장명5]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}


				this.setAppendRow1();
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
	if(document.getElementById(id).style.display=='block'){
		document.getElementById(id).style.display='none';
	}else{
		document.getElementById(id).style.display='block';
	}

	document.HwpControl.labor.value = name;
}

function toggleLayer2(id,name){
	if(document.getElementById(id).style.display=='block'){
		document.getElementById(id).style.display='none';
		document.getElementById('yy2').style.display='none';
	}else{
		document.getElementById(id).style.display='block';
		document.getElementById('yy2').style.display='inline';
	}

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
		location.href='./';
	}
});