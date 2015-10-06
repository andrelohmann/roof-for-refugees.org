<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DonatorEditForm extends BootstrapHorizontalForm {
    
    public function hasErrors(){
        $errorInfo = Session::get("FormInfo.{$this->FormName()}");
        
        if(isset($errorInfo['errors']) && is_array($errorInfo['errors'])){
            return true;
        }
        
        if(isset($errorInfo['message']) && isset($errorInfo['type'])) {
            return true;
        }
        
        return false;
    }
    
    public function __construct($controller, $name, $fields = null, $actions = null) {
        
        $fields = new FieldList(
            $Nickname = TextField::create('Nickname')->setTitle(_t('Member.NICKNAME','Member.NICKNAME')),
            $Location = BootstrapGeoLocationField::create('Location')->setTitle(_t('Member.LOCATION','Member.LOCATION')),
            $About = TextareaField::create('About')->setTitle(_t('DonatorProfile.ABOUT','DonatorProfile.ABOUT'))->setPlaceholder(_t('DonatorProfile.ABOUTDESCRIPTION','DonatorProfile.ABOUTDESCRIPTION')),
            $Active = CheckboxField::create('Active')->setTitle(_t('Member.ACTIVE','Member.ACTIVE')),
            $Avatar = BootstrapFileField::create('Avatar')->setTitle(_t('Member.AVATAR','Member.AVATAR'))
        );
        
        $Location->setRightTitle(_t('Member.LOCATIONDESCRIPTION','Member.LOCATIONDESCRIPTION'));
        $About->setRightTitle(_t('DonatorProfile.ABOUTDESCRIPTION','DonatorProfile.ABOUTDESCRIPTION'));
        
        // Upload Parameters
        $exts = array('jpg', 'jpeg', 'gif', 'png');
        $validator = new Upload_Validator();
        $validator->setAllowedExtensions($exts);
        $validator->setAllowedMaxFileSize(5000000);
        $upload = Upload::create();
        $upload->setValidator($validator);
        
        // Avatar Upload Folder
        $Avatar->setFolderName("Uploads/Members/".Member::currentUser()->ID."/Avatars");
        $Avatar->setUpload($upload);
        
        $actions = new FieldList(
            $Submit = BootstrapLoadingFormAction::create('doSave')->setTitle(_t('HostelEditForm.SAVEBUTTON','HostelEditForm.SAVEBUTTON'))
        );
         
        parent::__construct(
            $controller,
            $name,
            $fields,
            $actions,
            new RequiredFields(
                "Nickname",
                "Location",
                "About"
            )
        );
        
        $this->loadDataFrom(Member::currentUser());
    }
    
    public function doSave(array $data) {
            
        $o_Member = Member::currentUser();
        
        $this->saveInto($o_Member);
        
        if(trim($o_Member->Nickname == '') || ($o_Member->LocationLatitude == 0 && $o_Member->LocationLongditude == 0) || trim($o_Member->LocationAddress) == '') $o_Member->Active = false;
        
        if($o_Member->Location && $o_Member->Nickname) $o_Member->SignupComplete = true;
        
        $o_Member->write();
            
        // We use Email Verified Member
        $this->controller->redirectBack();
    }
}