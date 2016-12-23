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
	if (_DEBUG) pHwpCtrl.SetClientName("DEBUG"); // Release �� ���� �̺κ��� �����Ѵ�.

	InitToolBarJS();
	
	if(!pHwpCtrl.Open(BasePath + "/files/docs/default.hwp")){
		alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
	}else{
		if (pHwpCtrl.MoveToField("[ȸ����]", true, true, false)) {	
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
//custom Toolbar ���� �⺻ �׼ǿ��� ���θ����, ����, �ٸ��̸����� ����, ����, �� ���µ� ��ü �׼��� ���� ���
//html�� onstart()�� ������ ���� �ְ� ����ϸ� �ȴ�. ��ܿ� �Լ��� onstart�ִ�.
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

function _VerifyVersion(){	 //��ġ Ȯ��
	if(pHwpCtrl.Version == null){
//	if(pHwpCtrl.getAttribute("Version") == null){
		document.getElementById('HwpCtrl').style.display='none';
		alert("�ѱ�  ��Ʈ���� ��ġ���� �ʾҽ��ϴ�.");
		return false;
	}
	//���� Ȯ��
	CurVersion = pHwpCtrl.Version;
	if(CurVersion < MinVersion){
		alert("HwpCtrl�� ������ ���Ƽ� ���������� �������� ���� �� �ֽ��ϴ�.\n"+
			"�ֽ� �������� ������Ʈ�ϱ⸦ �����մϴ�.\n\n"+
			"���� ����:" + CurVersion + "\n"+
			"���� ����:" + MinVersion + " �̻�"			
			);
	}
	return true;
}

function _GetBasePath(){
	//BasePath�� ���Ѵ�.
	var loc = unescape(document.location.href);
	var lowercase = loc.toLowerCase(loc);
	if (lowercase.indexOf("http://") == 0) // Internet
	{
		return loc.substr(0,loc.lastIndexOf("/") + 1);//BasePath ����
	}
	else // local
	{
		var path;
		path = loc.replace(/.{2,}:\/{2,}/, ""); // file:/// �� ����������.
		return path.substr(0,path.lastIndexOf("/") + 1);//BasePath ����
	}
}

function TableColumnContents(ColumnArray){
	if (pHwpCtrl.ParentCtrl.CtrlID == "tbl"){ // ���̺� ���� Ŀ���� �ִ°�?
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
			alert("���� Ŀ���� ��ġ�� ǥ�� ���ΰ� �ƴ�.");
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
			alert("���ʵ�(" + FirstCellName +")�� �������� �ʽ��ϴ�.");
		return false;
	}
}


// ǥ�� ������ ���� �߰��ϰ�, ������ ä���.
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
			alert("���� Ŀ���� ��ġ�� ǥ�� ���ΰ� �ƴ�.");
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
	//alert('�غ����Դϴ�!'); return;

	var labor1 ='';
	var frm = document.HwpControl;

	var now = new Date();
	var nowLs = ''+now.toLocaleString();
	var yyyy = ''+now.getFullYear();
	var mm = ''+(now.getMonth()+1);
	var dd = ''+now.getDate();
	var toDay = yyyy +' ��  '+ mm + ' ��  ' + dd + ' ��';


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
		case 'labor1': // �ٷΰ�༭
			if(!pHwpCtrl.Open(BasePath + "/files/docs/"+labor1)){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("[��������1]", true, true, false)) {	set.SetItem("Text",frm.addtxt11_0.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��������2]", true, true, false)) {	set.SetItem("Text",frm.addtxt11_1.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��������3]", true, true, false)) {	set.SetItem("Text",frm.addtxt11_2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��������4]", true, true, false)) {	set.SetItem("Text",frm.addtxt11_3.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��������5]", true, true, false)) {	set.SetItem("Text",frm.addtxt11_4.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��������6]", true, true, false)) {set.SetItem("Text",frm.addtxt11_5.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��������ݾ�1]", true, true, false)) {	set.SetItem("Text",frm.addtxt12_0.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��������ݾ�2]", true, true, false)) {	set.SetItem("Text",frm.addtxt12_1.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��������ݾ�3]", true, true, false)) {	set.SetItem("Text",frm.addtxt12_2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��������ݾ�4]", true, true, false)) {	set.SetItem("Text",frm.addtxt12_3.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��������ݾ�5]", true, true, false)) {set.SetItem("Text",frm.addtxt12_4.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��������ݾ�6]", true, true, false)) {set.SetItem("Text",frm.addtxt12_5.value);act.Execute(set);}

				if (pHwpCtrl.MoveToField("[ȣ��]", true, true, false)) {	set.SetItem("Text",frm.job_grade.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[���ó�¥]", true, true, false)) {set.SetItem("Text",frm.today.value);act.Execute(set);}
			
				if (pHwpCtrl.MoveToField("[������]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������1]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}

				if (pHwpCtrl.MoveToField("[����ڵ�Ϲ�ȣ]", true, true, false)) {	set.SetItem("Text",frm.comp_num.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������ǥ]", true, true, false)) {	set.SetItem("Text",frm.comp_ceo.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������ǥ1]", true, true, false)) {	set.SetItem("Text",frm.comp_ceo.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������ּ�]", true, true, false)) {	set.SetItem("Text",frm.comp_addr1.value +''+frm.comp_addr2.value );		act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������ּ�1]", true, true, false)) {	set.SetItem("Text",frm.comp_addr1.value +''+frm.comp_addr2.value );		act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������ּ�2]", true, true, false)) {	set.SetItem("Text",frm.comp_addr1.value +''+frm.comp_addr2.value );		act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[����]", true, true, false)) {	set.SetItem("Text",frm.jikjong.value );	act.Execute(set);	}

				if (pHwpCtrl.MoveToField("[�������]", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�������1]", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[����ֹι�ȣ]", true, true, false)) {	set.SetItem("Text",frm.jumin.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[����ֹι�ȣ1]", true, true, false)) {	set.SetItem("Text",frm.jumin.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[����ּ�]", true, true, false)) {	set.SetItem("Text",frm.addr.value +''+ frm.addr2.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[����ּ�1]", true, true, false)) {	set.SetItem("Text",frm.addr.value +''+ frm.addr2.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�����ȭ]", true, true, false)) {	set.SetItem("Text",frm.tel.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�Ի�����]", true, true, false)) {	set.SetItem("Text",frm.jdate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[��������]", true, true, false)) {	set.SetItem("Text",frm.edate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[ä������]", true, true, false)) {	set.SetItem("Text",frm.job_div.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[��������]", true, true, false)) {	set.SetItem("Text",frm.contract_sdate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[���������]", true, true, false)) {	set.SetItem("Text",frm.contract_edate.value );	act.Execute(set);	}

				if (pHwpCtrl.MoveToField("�����ٷνð�1", true, true, false)) {	set.SetItem("Text",frm.workhour_40.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�����ٷνð�2", true, true, false)) {	set.SetItem("Text",frm.workhour_44.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[��ٽð�]", true, true, false)) {	set.SetItem("Text",frm.stime.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[��ٽð�]", true, true, false)) {	set.SetItem("Text",frm.etime.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�ްԽð�]", true, true, false)) {	set.SetItem("Text",frm.rest2.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("����ϱٹ�1", true, true, false)) {	set.SetItem("Text",frm.saturday1.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("����ϱٹ�2", true, true, false)) {	set.SetItem("Text",frm.saturday2.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[����ϱٹ�����]", true, true, false)) {	set.SetItem("Text",frm.saturday_s.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[����ϱٹ�����]", true, true, false)) {	set.SetItem("Text",frm.saturday_e.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�ٹ���1]", true, true, false)) {	set.SetItem("Text",frm.workday1.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�ٹ���2]", true, true, false)) {	set.SetItem("Text",frm.workday2.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�ٹ���3]", true, true, false)) {	set.SetItem("Text",frm.workday3.value );	act.Execute(set);	}

				if (pHwpCtrl.MoveToField("�ñ�", true, true, false)) {	set.SetItem("Text",frm.time_chk.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�ϱ�", true, true, false)) {	set.SetItem("Text",frm.day_chk.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�ñ��ϱ�]", true, true, false)) {set.SetItem("Text",frm.timegub.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[����1]", true, true, false)) {set.SetItem("Text",frm.calculate1.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[����2]", true, true, false)) {set.SetItem("Text",frm.calculate2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("��������", true, true, false)) {set.SetItem("Text",frm.payment1.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("�Ա�", true, true, false)) {set.SetItem("Text",frm.payment2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("������", true, true, false)) {set.SetItem("Text",frm.hday.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("�󿩱�1", true, true, false)) {set.SetItem("Text",frm.bonus1.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("�󿩱�2", true, true, false)) {set.SetItem("Text",frm.bonus2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("�󿩱�3", true, true, false)) {set.SetItem("Text",frm.bonus3.value);act.Execute(set);}

				if (pHwpCtrl.MoveToField("[�ϱٹ��ð�]", true, true, false)) {	set.SetItem("Text",frm.wtime.value );		act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�ּ����ٹ��ð�]", true, true, false)) {	set.SetItem("Text",frm.jogun.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�⺻�޿�]", true, true, false)) {	set.SetItem("Text",frm.pay1.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[���������հ�]", true, true, false)) {	set.SetItem("Text",frm.pay2.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[����������հ�]", true, true, false)) {	set.SetItem("Text",frm.pay3.value );	act.Execute(set)	;}
				if (pHwpCtrl.MoveToField("[���������հ�]", true, true, false)) {	set.SetItem("Text",frm.pay4.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[���޿����հ�]", true, true, false)) {	set.SetItem("Text",frm.pay5.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[���޿����հ�2]", true, true, false)) {	set.SetItem("Text",frm.pay5.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�����Ѿ�]", true, true, false)) {	set.SetItem("Text",frm.annual_salary.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�޿���]", true, true, false)) {	set.SetItem("Text",frm.pay_day.value );	act.Execute(set);	}
			}
			break;

		default:
			if(!pHwpCtrl.Open(BasePath + "/files/docs/default.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("[ȸ����]", true, true, false)) {	
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
		alert('Active X�� �������� �ʴ� ������������ �ѱ���Ʈ���� ����� �� �����ϴ�!');
		location.href='index.php';
	}
});