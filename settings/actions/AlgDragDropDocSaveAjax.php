<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  Ing. Estefan Civera.
 * The Initial Developer of the Original Code is Ing. Estefan Civera.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Settings_AlgDragDropDoc_AlgDragDropDocSaveAjax_Action extends Settings_Vtiger_Basic_Action {

        public function process(Vtiger_Request $request) {
                $response = new Vtiger_Response();
                $qualifiedModuleName = $request->getModule(false);
                $tabid = str_replace('tabid','',$request->get('tabid'));
                $operation = $request->get('operation');
                $moduleModel = Settings_AlgDragDropDoc_Module_Model::getInstance();
                if ($tabid) {
                    //we are toggling a tabid, and returning the current status of that tab
                    if($operation=="enable"){//if it is on at the moment we delete it
                    $moduleModel->enableWidget($tabid);
                    $result=true;
                    }else{
                        $moduleModel->disableWidget($tabid);
                        $result=false;
                    }
                   $response->setResult(array('tabid'=>"tabid$tabid",'enabled'=>$result));  
                } else {
                    $response->setError(vtranslate('Failed to enable', $qualifiedModuleName));
                }
                $response->emit();

        }
}

