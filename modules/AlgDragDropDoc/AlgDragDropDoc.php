<?php
/*********************************************************************************
  ** The contents of this file are subject to the vtiger CRM Public License Version 1.0
   * ("License"); You may not use this file except in compliance with the License
   * The Original Code is:  Ing. Estefan Civera 
   * The Initial Developer of the Original Code is Ing. Estefan Civera.
   * Portions created by vtiger are Copyright (C) vtiger.
   * All Rights Reserved.
   * For more informations www.estefancivera.net - info@estefancivera.net
  *
 ********************************************************************************/

include_once 'modules/Vtiger/CRMEntity.php';

class AlgDragDropDoc /*extends Vtiger_CRMEntity*/{

    const module = 'AlgDragDropDoc';
    
//    protected $modules = array(
//                'Leads', 'Contacts', 'Accounts', 'Potentials', 'Products', 'HelpDesk', 'Invoice', 
//                'Quotes', 'SalesOrder', 'Project', 'ServiceContracts', 'Assets', 'Services', 'PurchaseOrder'                
//            );
//    
//    protected function enableWidget(){
//        $vtl = new Vtiger_Link();        
//               
//        foreach($this->modules as $module){
//            
//            $instance = Vtiger_Module::getInstance($module);            
//            $vtl->addLink($instance->getId(), 'DETAILVIEWSIDEBARWIDGET', 'Drag and drop documents', 'module=AlgDragDropDoc&view=DragDrop');            
//        }
//	
//
//    }
//    
//    protected function disableWidget(){
//        $vtl = new Vtiger_Link();
//               
//        foreach($this->modules as $module){
//            
//            $instance = Vtiger_Module::getInstance($module);
//            
//            $vtl->deleteLink($instance->getId(), 'DETAILVIEWSIDEBARWIDGET', 'Drag and drop documents');
//            
//        }
//
//    }

    /**
     * Invoked when special actions are to be performed on the module.
     * @param String Module name
     * @param String Event Type
     */
    function vtlib_handler($moduleName, $eventType) {
        //$adb = PearDatabase::getInstance();
       
        if ($eventType == 'module.postinstall') {
			//$this->enableWidget();
         
        } else if ($eventType == 'module.disabled') {
			//$this->disableWidget();
           
        } else if ($eventType == 'module.enabled') {
			//$this->enableWidget();
   
        } else if ($eventType == 'module.preuninstall') {
			//$this->disableWidget();
      
        } else if ($eventType == 'module.preupdate') {
            // TODO Handle actions before this module is updated.
        } else if ($eventType == 'module.postupdate') {
            
        }
    }
}
?>
