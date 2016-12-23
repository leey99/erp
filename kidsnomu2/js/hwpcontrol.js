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

	if(document.HwpControl.bohum.value != '') {
		pageLoad(document.HwpControl.bohum.value);
	}

}

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



// 표에 마지막 행을 추가하고, 내용을 채운다.
function TableAppendRowContents(FirstCellName, ColumnArray){
	if(TableAppendRow(FirstCellName))
		TableColumnContents(ColumnArray);
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

function TableColumnContents(ColumnArray){
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

function pageLoad(pName){

	var frm = document.HwpControl;

	var now = new Date();
	var nowLs = ''+now.toLocaleString();
	var yyyy = ''+now.getFullYear();
	var mm = ''+(now.getMonth()+1);
	var dd = ''+now.getDate();
	var toDay = yyyy +' 년  '+ mm + ' 월  ' + dd + ' 일';
	//alert(mm);
	var act = pHwpCtrl.CreateAction("InsertText");
	var set = act.CreateSet();

	switch(pName){
		case 'bohum1': // 자격취득신고서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/bohum_1.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("[사업장명]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업자등록번호]", true, true, false)){set.SetItem("Text",frm.comp_num.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장주소]", true, true, false)){set.SetItem("Text",frm.comp_addr1.value+' '+frm.comp_addr2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장전화]", true, true, false)){set.SetItem("Text",frm.comp_tel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[휴대전화]", true, true, false)){set.SetItem("Text",frm.comp_cel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장팩스]", true, true, false)){set.SetItem("Text",frm.comp_fax.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[작성일]", true, true, false)){set.SetItem("Text",toDay);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[대표성명]", true, true, false)){set.SetItem("Text",frm.comp_ceo.value);act.Execute(set);}

				for(i=0;i<4;i++){
				if (pHwpCtrl.MoveToField("[사원성명"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_name[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사원주민번호"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_jumin[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[통상임금A"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_pay[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[취득일A"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_jdate[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[통상임금B"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_pay[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[취득일B"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_jdate[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[통상임금C"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_pay[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[취득일C"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_jdate[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[시간제"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_jogun[i].value);act.Execute(set);}
				}
			}
			break;
		case 'bohum2': // 자격상실신고서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/bohum_2.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("[사업장명]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업자등록번호]", true, true, false)){set.SetItem("Text",frm.comp_num.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장주소]", true, true, false)){set.SetItem("Text",frm.comp_addr1.value+' '+frm.comp_addr2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장전화]", true, true, false)){set.SetItem("Text",frm.comp_tel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장팩스]", true, true, false)){set.SetItem("Text",frm.comp_fax.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[신고년월일]", true, true, false)){set.SetItem("Text",toDay);act.Execute(set);}
				
				for(i=0;i<7;i++){
				if (pHwpCtrl.MoveToField("[순번"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_no[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사원성명"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_name[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사원주민번호"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_jumin[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[휴대전화"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_cel[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[상실일A"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_rdate[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[상실일B"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_rdate[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[상실일C"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_rdate[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[해당년도보수총액A"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_hap1[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[산정월A"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_cnt1[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[전년도보수총액"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_hap2[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[산정월B"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_cnt2[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사유"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_sayu[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[해당년도보수총액B"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_hap1[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[3개월평균임금"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_pay[i].value);act.Execute(set);}
				}
			}
			break;
		case 'bohum3': // 피부양자격신고서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/bohum_3.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("[사업장명]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업자등록번호]", true, true, false)){set.SetItem("Text",frm.comp_num.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장번호]", true, true, false)){set.SetItem("Text",frm.comp_tel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장전화]", true, true, false)){set.SetItem("Text",frm.comp_tel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[신고년월일]", true, true, false)){set.SetItem("Text",toDay);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장대표]", true, true, false)){set.SetItem("Text",frm.comp_ceo.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사원성명]", true, true, false)){set.SetItem("Text",frm.emp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사원주민번호]", true, true, false)){set.SetItem("Text",frm.emp_jumin.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사원전화번호]", true, true, false)){set.SetItem("Text",frm.emp_cel.value);act.Execute(set);}
				for(i=0;i<9;i++){
					if (pHwpCtrl.MoveToField("[관계"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.relation[i].value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("[성명"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.fy_name[i].value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("[주민등록번호"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.fy_jumin_no[i].value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("[취득/상실일"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.fy_get_loss_date[i].value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("[취득/상실부호"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.fy_apply_txt[i].value);act.Execute(set);}
				}
			}
			break;
		case 'bohum4': // 보수총액신고서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/bohum_4.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("[사업장산재요율]", true, true, false)){set.SetItem("Text",frm.yoyul.value+'%');act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장명]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업자등록번호]", true, true, false)){set.SetItem("Text",frm.comp_num.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장대표]", true, true, false)){set.SetItem("Text",frm.comp_ceo.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장대표자]", true, true, false)){set.SetItem("Text",frm.comp_ceo.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장주소]", true, true, false)){set.SetItem("Text",frm.comp_addr1.value+' '+frm.comp_addr2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장전화번호]", true, true, false)){set.SetItem("Text",frm.comp_tel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장팩스번호]", true, true, false)){set.SetItem("Text",frm.comp_fax.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장업종]", true, true, false)){set.SetItem("Text",frm.comp_jongmok.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[신고년월일]", true, true, false)){set.SetItem("Text",toDay);act.Execute(set);}
				
				for(i=0;i<9;i++){
					if (pHwpCtrl.MoveToField("[사원성명"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_name[i].value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("[사원주민등록번호"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_jumin[i].value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("[입사일A"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_jdate[i].value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("[퇴직일A"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_rdate[i].value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("[보수총액A"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_hap[i].value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("[평균보수A"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_avg[i].value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("[입사일B"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_jdate[i].value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("[퇴직일B"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_rdate[i].value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("[보수총액B"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_hap[i].value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("[평균보수B"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_avg[i].value);act.Execute(set);}
				}
			}
			break;
		case 'bohum5': // 4대보험관리대장
			if(!pHwpCtrl.Open(BasePath + "/files/docs/bohum_5.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("[해당년월]", true, true, false)){set.SetItem("Text",frm.year.value+'년 '+frm.month.value+'월 ');act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장명]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}

				this.setAppendRow();
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

	document.HwpControl.bohum.value = name;
}

function checkSubmit(name,min,max){
	var cnt=0;
	var frm = document.HwpControl;
	var item = document.getElementsByName('employee[]');
	for(i=0;i<item.length;i++){
		if(item[i].checked==true) cnt++;
	}
	if(cnt<min){ alert('최소 '+min+'명의 직원을 선택해야합니다.'); return;}
	if(cnt>max){ alert('최대 '+max+'명의 직원을 입력할 수 있습니다.'); return;}

	document.HwpControl.bohum.value = name;
	frm.submit();
}

function goSubmit(name){

	document.HwpControl.bohum.value = name;
	document.HwpControl.submit();
}


$(document).ready(function(e) {
	if(myagent == 'ie' || myagent == 'ns') {
		OnStart();
	}else{
		alert('Active X를 지원하지 않는 브라우저에서는 한글컨트롤을 사용할 수 없습니다!');
		location.href='./';
	}
});