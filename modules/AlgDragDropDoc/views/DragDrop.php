<?php

/* +***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 * *********************************************************************************** */

class AlgDragDropDoc_DragDrop_View extends Vtiger_Detail_View {

    /**
     * must be overriden
     * @param Vtiger_Request $request
     * @return boolean 
     */
    function preProcess(Vtiger_Request $request) {
        return true;
    }

    /**
     * must be overriden
     * @param Vtiger_Request $request
     * @return boolean 
     */
    function postProcess(Vtiger_Request $request) {
        return true;
    }

    /**
     * called when the request is recieved.
     * if viewtype : detail then show location
     * TODO : if viewtype : list then show the optimal route.    
     * @param Vtiger_Request $request 
     */
    function process(Vtiger_Request $request) {
        
        if (!vtlib_isModuleActive('Documents')) {
            throw new AppException(vtranslate('LBL_PERMISSION_DENIED', $moduleName));
        }

        $viewer = $this->getViewer($request);
        $viewer->assign('MAXSIZE', AlgDragDropDoc_Module_Model::getMaxUploadSize());
        $viewer->assign('RECORD', $request->get('record'));
        $viewer->assign('SOURCE_MODULE', $request->get('source_module'));
	$viewer->assign('FOLDERS', Documents_Module_Model::getAllFolders());
        $viewer->assign('BADEXTS', $this->generateBadExtension());
        
        // Translantion manager        
        $viewer->assign('JS_FOLDERS', vtranslate("JS_FOLDERS", "AlgDragDropDoc"));
        $viewer->assign('JS_UPLOAD_WARNING', vtranslate("JS_UPLOAD_WARNING", "AlgDragDropDoc"));
        $viewer->assign('JS_INVALIDEXT', vtranslate("JS_INVALIDEXT", "AlgDragDropDoc"));
        $viewer->assign('JS_UPLOAD_SUCCESFULLY', vtranslate("JS_UPLOAD_SUCCESFULLY", "AlgDragDropDoc"));
        $viewer->assign('JS_UPLOAD_SUCCESFULLY_TXT', vtranslate("JS_UPLOAD_SUCCESFULLY_TXT", "AlgDragDropDoc"));
        $viewer->assign('JS_UPLOAD_ERROR', vtranslate("JS_UPLOAD_ERROR", "AlgDragDropDoc"));
        $viewer->assign('JS_UPLOAD_ERROR_TXT', vtranslate("JS_UPLOAD_ERROR_TXT", "AlgDragDropDoc"));
        $viewer->assign('JS_UPLOADING', vtranslate("JS_UPLOADING", "AlgDragDropDoc"));
        $viewer->assign('JS_UPLOADING_TXT', vtranslate("JS_UPLOADING_TXT", "AlgDragDropDoc"));
        
        $viewer->assign('JS_DROPPER', vtranslate("JS_DROPPER", "AlgDragDropDoc"));

        $viewer->view('dragdrop.tpl', $request->getModule());
        
	
    }
    
    
    
    function generateBadExtension(){
        
        $badExt = AlgDragDropDoc_Module_Model::getBadExtensions();
        
        $jsArray ='';
        foreach($badExt as $ext){
            if($jsArray != ""){
                $jsArray .=",";
            }
                
            $jsArray .= "'". $ext ."'";
        }
        return $jsArray;
        
    }

}

?>
