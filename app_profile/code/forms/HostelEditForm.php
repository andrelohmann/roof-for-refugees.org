<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class HostelEditForm extends BootstrapHorizontalForm {
    
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
            $Adults = DropdownField::create('Adults')->setTitle(_t('HostelProfile.ADULTS','HostelProfile.ADULTS'))->setSource(Config::inst()->get('Member', 'people_sum')),
            $Children = DropdownField::create('Children')->setTitle(_t('HostelProfile.CHILDREN','HostelProfile.CHILDREN'))->setSource(Config::inst()->get('Member', 'people_sum')),
            $Baby = CheckboxField::create('Baby')->setTitle(_t('HostelProfile.BABY','HostelProfile.BABY')),
            $About = TextareaField::create('About')->setTitle(_t('HostelProfile.ABOUT','HostelProfile.ABOUT'))->setPlaceholder(_t('HostelProfile.ABOUTDESCRIPTION','HostelProfile.ABOUTDESCRIPTION')),
            $Active = CheckboxField::create('Active')->setTitle(_t('Member.ACTIVE','Member.ACTIVE')),
            $ConfirmTreatment = CheckboxField::create('ConfirmTreatment')->setTitle(_t('HostelProfile.CONFIRMTREATMENT','HostelProfile.CONFIRMTREATMENT')),
            $Avatar = BootstrapFileField::create('Avatar')->setTitle(_t('Member.AVATAR','Member.AVATAR'))
        );
        
        $Location->setRightTitle(_t('Member.LOCATIONDESCRIPTION','Member.LOCATIONDESCRIPTION'));
        $Adults->setRightTitle(_t('HostelProfile.ADULTSDESCRIPTION','HostelProfile.ADULTSDESCRIPTION'));
        $Children->setRightTitle(_t('HostelProfile.CHILDRENDESCRIPTION','HostelProfile.CHILDRENDESCRIPTION'));
        $Baby->setRightTitle(_t('HostelProfile.BABYDESCRIPTION','HostelProfile.BABYDESCRIPTION'));
        $About->setRightTitle(_t('HostelProfile.ABOUTDESCRIPTION','HostelProfile.ABOUTDESCRIPTION'));
        
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
                "Adults",
                "Children",
                "About",
                "ConfirmTreatment"
            )
        );
        
        $this->loadDataFrom(Member::currentUser());
    }
    
    public function doSave(array $data) {
            
        $o_Member = Member::currentUser();
        
        $this->saveInto($o_Member);
        
        if(trim($o_Member->Nickname == '') || ($o_Member->LocationLatitude == 0 && $o_Member->LocationLongditude == 0) || trim($o_Member->LocationAddress) == '' || ($o_Member->Adults == 0 && $o_Member->Children == 0)) $o_Member->Active = false;
        
        if($o_Member->Location && ($o_Member->Adults > 0 || $o_Member->Children > 0) && $o_Member->Nickname) $o_Member->SignupComplete = true;
        
        $o_Member->write();
            
        // We use Email Verified Member
        $this->controller->redirectBack();
    }
}