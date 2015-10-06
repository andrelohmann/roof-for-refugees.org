<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class RefugeeEditForm extends BootstrapHorizontalForm {
    
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
            $Adults = DropdownField::create('Adults')->setTitle(_t('RefugeeProfile.ADULTS','RefugeeProfile.ADULTS'))->setSource(Config::inst()->get('Member', 'people_sum')),
            $Children = DropdownField::create('Children')->setTitle(_t('RefugeeProfile.CHILDREN','RefugeeProfile.CHILDREN'))->setSource(Config::inst()->get('Member', 'people_sum')),
            $Baby = CheckboxField::create('Baby')->setTitle(_t('RefugeeProfile.BABY','RefugeeProfile.BABY')),
            $About = TextareaField::create('About')->setTitle(_t('RefugeeProfile.ABOUT','RefugeeProfile.ABOUT'))->setPlaceholder(_t('RefugeeProfile.ABOUTDESCRIPTION','RefugeeProfile.ABOUTDESCRIPTION')),
            $Active = CheckboxField::create('Active')->setTitle(_t('Member.ACTIVE','Member.ACTIVE')),
            $Avatar = BootstrapFileField::create('Avatar')->setTitle(_t('Member.AVATAR','Member.AVATAR'))
        );
        
        $Location->setRightTitle(_t('Member.LOCATIONDESCRIPTION','Member.LOCATIONDESCRIPTION'));
        $Adults->setRightTitle(_t('RefugeeProfile.ADULTSDESCRIPTION','RefugeeProfile.ADULTSDESCRIPTION'));
        $Children->setRightTitle(_t('RefugeeProfile.CHILDRENDESCRIPTION','RefugeeProfile.CHILDRENDESCRIPTION'));
        $Baby->setRightTitle(_t('RefugeeProfile.BABYDESCRIPTION','RefugeeProfile.BABYDESCRIPTION'));
        $About->setRightTitle(_t('RefugeeProfile.ABOUTDESCRIPTION','RefugeeProfile.ABOUTDESCRIPTION'));
        
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
            $Submit = BootstrapLoadingFormAction::create('doSave')->setTitle(_t('RefugeeEditForm.SAVEBUTTON','RefugeeEditForm.SAVEBUTTON'))
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
                "About"
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
        
        //$M = new Member();
        //$M->Coordinated = true;
        //$M->Nickname = 'Wolfo';
        //$M->write();
        // We use Email Verified Member
        $this->controller->redirectBack();
    }
}