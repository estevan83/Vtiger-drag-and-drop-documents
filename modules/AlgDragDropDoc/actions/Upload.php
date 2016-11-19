<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

require_once('modules/Documents/Documents.php');

class AlgDragDropDoc_Upload_Action extends Vtiger_Action_Controller {

	public function checkPermission(Vtiger_Request $request) {
		$moduleName = $request->getModule();
                return true;

		if(!Users_Privileges_Model::isPermitted($moduleName, 'DetailView', $request->get('record'))) {
			throw new AppException(vtranslate('LBL_PERMISSION_DENIED', $moduleName));
		}
	}

	public function process(Vtiger_Request $request) {
		
            $response = new Vtiger_Response();
            foreach($_FILES as $fileindex => $files)
            {
                if($files['name'] != '' && $files['size'] > 0)
                {
                    require_once('modules/Documents/Documents.php');
                    $focus = new Documents();
                    $focus->column_fields['notes_title'] = $files['name'];
                    $focus->column_fields['filename'] = $files['name'];
                    $focus->column_fields['filetype'] = $files['type'];
                    $focus->column_fields['filesize'] = $files['size'];
                    $focus->column_fields['filelocationtype'] = 'I';
                    $focus->column_fields['filedownloadcount']= 0;
                    $focus->column_fields['filestatus'] = 1;
                    //$focus->column_fields['assigned_user_id'] = $user_id;$(".dropped").dropper({
                    $focus->column_fields['folderid'] = $request->get('folderid');
                    $focus->parent_id = $request->get('record');
                    $focus->save('Documents');

                    $db = PearDatabase::getInstance();

                    $db->pquery( 'insert into vtiger_senotesrel values(?,?)',array($request->get('record'),$focus->id));
                    
                    $response->setResult($files['name'] . ' ' . vtranslate("UPLOADED_SUCCESFULLY", 'AlgDragDropDoc'));
                }
                else { 
                    $response->setError(-1, vtranslate("ERROR_UPLOAD_FILE", 'AlgDragDropDoc')); 
                }
            }
            
            $response->emit();
		
		
	}
}
