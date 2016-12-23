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

	if(frm.comp_type.value=='A'){
		labor1='labor_1a.hwp';
	}else if(frm.comp_type.value=='B'){
		labor1='labor_1b.hwp';
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
				if (pHwpCtrl.MoveToField("[�ð���]", true, true, false)) {set.SetItem("Text",frm.timegub.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[���ó�¥]", true, true, false)) {set.SetItem("Text",frm.today.value);act.Execute(set);}
			
				if (pHwpCtrl.MoveToField("[������1]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������2]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������3]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������4]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������5]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������6]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������7]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������8]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������9]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������10]", true, true, false)) {set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������11]", true, true, false)) {set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������12]", true, true, false)) {set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}

				if (pHwpCtrl.MoveToField("[����ڵ�Ϲ�ȣ]", true, true, false)) {	set.SetItem("Text",frm.comp_num.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������ǥ]", true, true, false)) {	set.SetItem("Text",frm.comp_ceo.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������ּ�]", true, true, false)) {	set.SetItem("Text",frm.comp_addr1.value +' '+frm.comp_addr2.value );		act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[��������]", true, true, false)) {	set.SetItem("Text",frm.comp_upte.value );	act.Execute(set);	}

				if (pHwpCtrl.MoveToField("[�������1]", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�������2]", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�ֹε�Ϲ�ȣ]", true, true, false)) {	set.SetItem("Text",frm.jumin.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[����ּ�]", true, true, false)) {	set.SetItem("Text",frm.addr.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�Ի�����1]", true, true, false)) {	set.SetItem("Text",frm.jdate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�Ի�����2]", true, true, false)) {	set.SetItem("Text",frm.jdate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[ä������]", true, true, false)) {	set.SetItem("Text",frm.job_div.value );	act.Execute(set);	}

				if (pHwpCtrl.MoveToField("[��ٽð�]", true, true, false)) {	set.SetItem("Text",frm.stime.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[��ٽð�]", true, true, false)) {	set.SetItem("Text",frm.etime.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�ϱٹ��ð�]", true, true, false)) {	set.SetItem("Text",frm.wtime.value );		act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�ּ����ٹ��ð�]", true, true, false)) {	set.SetItem("Text",frm.jogun.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�⺻�޿�]", true, true, false)) {	set.SetItem("Text",frm.pay1.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[���������հ�]", true, true, false)) {	set.SetItem("Text",frm.pay2.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[����������հ�]", true, true, false)) {	set.SetItem("Text",frm.pay3.value );	act.Execute(set)	;}
				if (pHwpCtrl.MoveToField("[���������հ�]", true, true, false)) {	set.SetItem("Text",frm.pay4.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[���޿����հ�]", true, true, false)) {	set.SetItem("Text",frm.pay5.value );	act.Execute(set);	}
			}
			break;
		
		case 'labor15': // �������
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_15.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}
			else{


				if (pHwpCtrl.MoveToField("[�ٷ��ڼ���]", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�ٷ����ֹι�ȣ]", true, true, false)) {	set.SetItem("Text",frm.jumin.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�ٷ����ּ�]", true, true, false)) {	set.SetItem("Text",frm.addr.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�Ի�����]", true, true, false)) {	set.SetItem("Text",frm.jdate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[����ּ���]", true, true, false)){set.SetItem("Text",frm.comp_ceo.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�ٹ��μ�]", true, true, false)){set.SetItem("Text",frm.dept.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[����]", true, true, false)){set.SetItem("Text",frm.jik.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�����ȭ��ȣ]", true, true, false)){set.SetItem("Text",frm.cel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��������]", true, true, false)) {	set.SetItem("Text",frm.career.value );	act.Execute(set);	}		
				
			}
			break;
			
		case 'labor16': // ��������
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_16.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("[�������ȭ��ȣ]", true, true, false)){set.SetItem("Text",frm.comp_tel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������ּ�]", true, true, false)){set.SetItem("Text",frm.comp_addr1.value+' '+frm.comp_addr2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�ٷ��ڼ���]", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�ٷ����ֹι�ȣ]", true, true, false)) {	set.SetItem("Text",frm.jumin.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�ٷ����ּ�]", true, true, false)) {	set.SetItem("Text",frm.addr.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�Ի�����]", true, true, false)) {	set.SetItem("Text",frm.jdate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[����ּ���]", true, true, false)){set.SetItem("Text",frm.comp_ceo.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������1]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������2]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�ٹ��μ�]", true, true, false)){set.SetItem("Text",frm.dept.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[����]", true, true, false)){set.SetItem("Text",frm.jik.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�����ȭ��ȣ]", true, true, false)){set.SetItem("Text",frm.cel.value);act.Execute(set);}
				
			}
			break;			
		case 'labor17': // ��������Ȱ�뵿�Ǽ�
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_17.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("[������]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
			}
			break;			
						
		case 'labor2': // �λ��Ϻ�
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_2.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("[������]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[��ȣ��]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[����ָ�]", true, true, false)) {	set.SetItem("Text",frm.comp_ceo.value );	act.Execute(set);	}

				if (pHwpCtrl.MoveToField("[�����]", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�������]", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�����1]", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�����2]", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�����3]", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}

				if (pHwpCtrl.MoveToField("[�Ի���]", true, true, false)) {	set.SetItem("Text",frm.jdate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�Ի���1]", true, true, false)) {	set.SetItem("Text",frm.jdate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�Ի���2]", true, true, false)) {	set.SetItem("Text",frm.jdate.value );	act.Execute(set);	}

				if (pHwpCtrl.MoveToField("[����ֹι�ȣ]", true, true, false)) {	set.SetItem("Text",frm.jumin.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[����]", true, true, false)) {	set.SetItem("Text",frm.sex.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�������]", true, true, false)) {	set.SetItem("Text",frm.birth.value+frm.lunar.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[����ּ�]", true, true, false)) {	set.SetItem("Text",frm.addr.value );	act.Execute(set);	}

				if (pHwpCtrl.MoveToField("[����]", true, true, false)) {	set.SetItem("Text",frm.body_1.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[ü��]", true, true, false)) {	set.SetItem("Text",frm.body_2.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�½÷�]", true, true, false)) {	set.SetItem("Text",frm.body_4.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[��÷�]", true, true, false)) {	set.SetItem("Text",frm.body_5.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������]", true, true, false)) {	set.SetItem("Text",frm.body_3.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�ǰ�����]", true, true, false)) {	set.SetItem("Text",frm.body_6.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[����]", true, true, false)) {	set.SetItem("Text",frm.body_6.value );	act.Execute(set);	}

				if (pHwpCtrl.MoveToField("[Ư��]", true, true, false)) {	set.SetItem("Text",frm.etc_1.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[���]", true, true, false)) {	set.SetItem("Text",frm.etc_2.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[����]", true, true, false)) {	set.SetItem("Text",frm.etc_3.value );	act.Execute(set);	}

				// ��������
				//alert(parseInt(frm.family.length/5));
				//for(i=0;i<parseInt(frm.family.length/5);i++){
				for(i=0;i<6;i++){
				if (pHwpCtrl.MoveToField("[����"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.family[i*5+0].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[����"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.family[i*5+1].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[����"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.family[i*5+2].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[����"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.family[i*5+3].value );	act.Execute(set);	}
				//if (pHwpCtrl.MoveToField("[�з�"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.family[i*5+4].value );	act.Execute(set);	}
				}
				if (pHwpCtrl.MoveToField("[�з�1]", true, true, false)) {	set.SetItem("Text",' ' );	act.Execute(set);	}
				
				// �з»���
				for(i=0;i<6;i++){
				if (pHwpCtrl.MoveToField("[������"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.school[i*5+0].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.school[i*5+1].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�б���"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.school[i*5+2].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�����а�"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.school[i*5+3].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[����"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.school[i*5+4].value );	act.Execute(set);	}
				}

				//��»���
				for(i=0;i<6;i++){
				if (pHwpCtrl.MoveToField("[�Ի�"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.career[i*5+0].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[���"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.career[i*5+1].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�ٹ�ó"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.career[i*5+2].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[����"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.career[i*5+3].value );	act.Execute(set);	}
				}

				// ��������
				for(i=0;i<6;i++){
				if (pHwpCtrl.MoveToField("[������"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.edu[i*5+0].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[��������"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.edu[i*5+1].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[����������"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.edu[i*5+2].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[����������"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.edu[i*5+3].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�������"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.edu[i*5+4].value );	act.Execute(set);	}
				}

				// ¡����
				for(i=0;i<13;i++){
				if (pHwpCtrl.MoveToField("[¡�賻��"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.penalty[i*4+0].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.penalty[i*4+1].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.penalty[i*4+2].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[¡�����"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.penalty[i*4+3].value );	act.Execute(set);	}
				}

				// ������
				for(i=0;i<5;i++){
				if (pHwpCtrl.MoveToField("[���󳻿�"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.prize[i*3+0].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�����"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.prize[i*3+1].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[����û"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.prize[i*3+2].value );	act.Execute(set);	}
				}

				// �λ�߷�
				for(i=0;i<19;i++){
				if (pHwpCtrl.MoveToField("[�߷ɱ���"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.insa[i*4+0].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�߷�����"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.insa[i*4+1].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�λ�߷ɻ���"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.insa[i*4+2].value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������"+(i+1)+"]", true, true, false)) {	set.SetItem("Text",frm.insa[i*4+3].value );	act.Execute(set);	}
				}
			}
			break;
		case 'labor3': // �����ڸ��
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_3.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("[������]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��������]", true, true, false)){set.SetItem("Text",toDay);act.Execute(set);}
				this.setAppendRow1();
			}
			break;
		case 'labor4': // ����ڸ��
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_4.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("[������]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��������]", true, true, false)){set.SetItem("Text",toDay);act.Execute(set);}
				this.setAppendRow2();
			}
			break;
		case 'labor5': // �����ݽ�û��
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_5.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("[��ȣ��]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[����]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��û��]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��û����]", true, true, false)){set.SetItem("Text",toDay);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�Ի�����]", true, true, false)){set.SetItem("Text",frm.jdate.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�����ȣ]", true, true, false)){set.SetItem("Text",frm.employee_id.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�ҼӺμ�]", true, true, false)){set.SetItem("Text",frm.dept.value);act.Execute(set);}
			}
			break;
		case 'labor6': // �������ݱ޿���û��
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_6.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("[������]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[����ڵ�Ϲ�ȣ]", true, true, false)){set.SetItem("Text",frm.comp_num.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�������ȭ��ȣ]", true, true, false)){set.SetItem("Text",frm.comp_tel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������ѽ���ȣ]", true, true, false)){set.SetItem("Text",frm.comp_fax.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������ڵ�����ȣ]", true, true, false)){set.SetItem("Text",frm.comp_cel.value);act.Execute(set);}

				if (pHwpCtrl.MoveToField("[�������]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[����ֹε�Ϲ�ȣ]", true, true, false)){set.SetItem("Text",frm.jumin.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[����ּ�]", true, true, false)){set.SetItem("Text",frm.addr.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[����ڵ�����ȣ]", true, true, false)){set.SetItem("Text",frm.cel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�������ȭ��ȣ]", true, true, false)){set.SetItem("Text",frm.tel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[����̸����ּ�]", true, true, false)){set.SetItem("Text",frm.email.value);act.Execute(set);}

				if (pHwpCtrl.MoveToField("[���޹޴»����]", true, true, false)){set.SetItem("Text",frm.bank_3.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�����]", true, true, false)){set.SetItem("Text",frm.bank_1.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[���¹�ȣ]", true, true, false)){set.SetItem("Text",frm.bank_2.value);act.Execute(set);}
			}
			break;
		case 'labor7': // ��������,���Ʊ� �ٷνð� ����޿� ��û��
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_7.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("[����]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�ֹε�Ϲ�ȣ]", true, true, false)){set.SetItem("Text",frm.jumin.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�ּ�]", true, true, false)){set.SetItem("Text",frm.addr.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�޴���ȭ]", true, true, false)){set.SetItem("Text",frm.cel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[����ȭ]", true, true, false)){set.SetItem("Text",frm.tel.value);act.Execute(set);}

				if (pHwpCtrl.MoveToField("[������]", true, true, false)){set.SetItem("Text",frm.bank_3.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�����]", true, true, false)){set.SetItem("Text",frm.bank_1.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[���¹�ȣ]", true, true, false)){set.SetItem("Text",frm.bank_2.value);act.Execute(set);}

				if (pHwpCtrl.MoveToField("[��û��]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��û(��)��]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
			}
			break;
		case 'labor8': // ������� �޿���û��
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_8.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("[����]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�ֹε�Ϲ�ȣ]", true, true, false)){set.SetItem("Text",frm.jumin.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�ּ�]", true, true, false)){set.SetItem("Text",frm.addr.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�޴���ȭ]", true, true, false)){set.SetItem("Text",frm.cel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��ȭ��ȣ]", true, true, false)){set.SetItem("Text",frm.tel.value);act.Execute(set);}

				if (pHwpCtrl.MoveToField("[������]", true, true, false)){set.SetItem("Text",frm.bank_3.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�����]", true, true, false)){set.SetItem("Text",frm.bank_1.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[���¹�ȣ]", true, true, false)){set.SetItem("Text",frm.bank_2.value);act.Execute(set);}

				if (pHwpCtrl.MoveToField("[��û��]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��û(��)��]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
			}
			break;
		case 'labor9': // ������� �ް�Ȯ�μ�
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_9.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("[����ڵ�Ϲ�ȣ]", true, true, false)){set.SetItem("Text",frm.comp_num.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������ּ�]", true, true, false)){set.SetItem("Text",frm.addr.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�̸����ּ�]", true, true, false)){set.SetItem("Text",frm.comp_email.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��ȭ]", true, true, false)){set.SetItem("Text",frm.comp_tel.value);act.Execute(set);}

				if (pHwpCtrl.MoveToField("[�����]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[����ֹε�Ϲ�ȣ]", true, true, false)){set.SetItem("Text",frm.jumin.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�ٷ��ڼ���]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��ǥ�ڼ���]", true, true, false)){set.SetItem("Text",frm.comp_ceo.value);act.Execute(set);}
			}
			break;
		case 'labor10': // ������� �ް�Ȯ�μ�
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_10.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("[����������ȣ]", true, true, false)){set.SetItem("Text",frm.comp_num.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[����ڵ�Ϲ�ȣ]", true, true, false)){set.SetItem("Text",frm.comp_num.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�̸����ּ�]", true, true, false)){set.SetItem("Text",frm.comp_email.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�������ȭ]", true, true, false)){set.SetItem("Text",frm.comp_tel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������ѽ�]", true, true, false)){set.SetItem("Text",frm.comp_fax.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������ּ�]", true, true, false)){set.SetItem("Text",frm.comp_addr1.value+' '+frm.comp_addr2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�ۼ�����]", true, true, false)){set.SetItem("Text",toDay);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������ǥ]", true, true, false)){set.SetItem("Text",frm.comp_ceo.value);act.Execute(set);}
			}
			break;
		case 'labor11': // ������ް���������
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_11.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("[�����ȣ]", true, true, false)){set.SetItem("Text",frm.employee_id.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[����]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�Ի�����]", true, true, false)){set.SetItem("Text",frm.jdate.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[���࿬��]", true, true, false)){set.SetItem("Text",yyyy+" ��");act.Execute(set);}
				this.setAppendRow3();
			}
			break;
		case 'labor12': // ������������
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_12.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("[�ش�⵵]", true, true, false)){set.SetItem("Text",frm.sYear.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				this.setAppendRow4();
			}
			break;
		case 'labor13': // ���°�������(���)
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_13.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("[�ҼӺμ�]", true, true, false)){set.SetItem("Text",frm.dept.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[����]", true, true, false)){set.SetItem("Text",frm.jik.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�������]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�ش�⵵]", true, true, false)){set.SetItem("Text",frm.yy2.value+' �⵵');act.Execute(set);}
				this.setAppendRow5();
			}
			break;
		case 'labor14': // ���°�������(��ü)
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_14.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("[�ش���]", true, true, false)){set.SetItem("Text",frm.yy.value+'�� '+frm.mm.value+'�� ');act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				this.setAppendRow6();
			}
			break;
		case 'labor18': // �����ް����Ǽ�
			if(!pHwpCtrl.Open(BasePath + "/files/docs/labor_18.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("[������1]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�������1]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������2]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�������2]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������3]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�������3]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������4]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�������4]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������5]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}

				if (pHwpCtrl.MoveToField("[������6]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				this.setAppendRow1();
			}
			break;
		case 'employee_01': // �ٷ��ڴ�ǥ���ӵ��Ǽ�
			if(!pHwpCtrl.Open(BasePath + "/files/docs/employee_01.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("[������1]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������2]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������3]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������4]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������5]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}


				this.setAppendRow1();
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
		alert('Active X�� �������� �ʴ� ������������ �ѱ���Ʈ���� ����� �� �����ϴ�!');
		location.href='./';
	}
});