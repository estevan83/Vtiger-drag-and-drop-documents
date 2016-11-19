{*<!--
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
-->*}
<link href="layouts/vlayout/modules/AlgDragDropDoc/resources/upload.css" rel="stylesheet" type="text/css" media="all">
<script type="text/javascript" src="layouts/vlayout/modules/AlgDragDropDoc/resources/core.js"></script>
<script type="text/javascript" src="layouts/vlayout/modules/AlgDragDropDoc/resources/upload.js"></script>

<span id="record" class="hide">{$RECORD}</span>
<span id="module" class="hide">{$SOURCE_MODULE}</span>

<form action="#" class="demo_form">
        <div class="row-fluid verticalBottomSpacing">
            <span class="span8">{$JS_FOLDERS}</span>
            <span class="span8 row-fluid">
                    <select class="span11" name="folderid" id="folderid">
                            <optgroup label="{$JS_FOLDERS}">
                                    {foreach item=FOLDER from=$FOLDERS}
                                            <option value="{$FOLDER->getId()}">{$FOLDER->getName()}</option>
                                    {/foreach}
                            </optgroup>
                    </select>
            </span>
        </div>
                            
        <div id="dropped"></div>
</form>

<script>      

    $(document).ready(function() {
       
        $("#dropped").upload({
            beforeSend: onBeforeSend,            
            action: "index.php?module=AlgDragDropDoc&action=Upload&record={$RECORD}&source_module={$SOURCE_MODULE}",
            label:'{$JS_DROPPER}',
            maxSize: {$MAXSIZE}
        })
        .on("filecomplete", onFileComplete)
        .on("filestart", onFileStart)
        .on("complete", onComplete)
        .on("fileerror", onFileError);

        $(window).one("pronto.load", function() {
                $("dropped").dropper("destroy").off(".dropper");
        });
    });
    
    function getExtension(filename){
        var a = filename.split(".");
        if( a.length === 1 || ( a[0] === "" && a.length === 2 ) ) {
            return "";
        }
        return a.pop().toLowerCase();
    }
   
    function onBeforeSend(formData, file) {
        var badExts = [{$BADEXTS}]; 
        
        var ext = getExtension(file.name);
        
        var found = $.inArray(ext, badExts) > -1;
        // Cancel request
        if (found > 0) {
            var params = {
                title : '{$JS_UPLOAD_WARNING}',
                text:'{$JS_INVALIDEXT}',
                animation: 'show',
                type: 'warning'
            };
            Vtiger_Helper_Js.showPnotify(params);
            return false;
        }

        // Modify and return form data
        formData.append("folderid", $( "#folderid" ).val());
       //console.log(formData);
        return formData;
    };
 
    function onFileComplete(e, file, response) {
        //console.log(response);
        var params = {
            title : '{$JS_UPLOAD_SUCCESFULLY}',
            text: file.name  + '{$JS_UPLOAD_SUCCESFULLY_TXT}',
            animation: 'show',
            type: 'success'
        };
        Vtiger_Helper_Js.showPnotify(params);
        
    };
    
    function onFileStart(e, file){
       
        var params = {
            title : '{$JS_UPLOADING}',
            text: '{$JS_UPLOADING_TXT}'+ file.name,
            animation: 'show',
            type: 'success'
        };
        Vtiger_Helper_Js.showPnotify(params);
    }
    
    function onComplete(){
        Vtiger_Detail_Js.reloadRelatedList();
    }
    

    function onFileError(e, file, response) {
        
        var params = {
            title : '{$JS_UPLOAD_ERROR}',
            text: '{$JS_UPLOAD_ERROR_TXT}'+ file.name,
            animation: 'show',
            type: 'error'
        };
        Vtiger_Helper_Js.showPnotify(params);

    };
</script>
