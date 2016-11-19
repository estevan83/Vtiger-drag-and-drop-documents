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

class AlgDragDropDoc_Module_Model extends Vtiger_Module_Model {

	// long max bytes allowed
    public static function getMaxUploadSize(){
        global  $upload_maxsize;
               
        return $upload_maxsize;
    }

    // array of invalid extensions
    public static function getBadExtensions(){
            global  $upload_badext;               
            return $upload_badext;
    }
    
    public function getSettingLinks(){
        $settingsLinks = array();
        $settingsLinks[] =  array(
            'linktype' => 'LISTVIEWSETTING',
            'linklabel' => vtranslate('LBL_ALGDRAGDROPDOC_SETTINGS', $this->getName()),
            'linkurl' => 'index.php?module=AlgDragDropDoc&parent=Settings&view=Index',
            'linkicon' => ''
        );

        return $settingsLinks;
    }
}

?>
