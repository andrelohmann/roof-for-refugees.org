<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class SignupForm extends Form {
    
    public function __construct($controller, $name, $fields = null, $actions = null) {
        
        $fields = new FieldList(
            $Nickname = TextField::create('Nickname')->setTitle(_t('Member.NICKNAME','Member.NICKNAME')),
            $Type = OptionsetField::create('Type')->setTitle(_t('Member.TYPE','Member.TYPE'))->setSource(array(
                "refugee" => _t('Member.TYPEREFUGEESIGNUP', 'Member.TYPEREFUGEESIGNUP'),
                "hostel" => _t('Member.TYPEHOSTELSIGNUP', 'Member.TYPEHOSTELSIGNUP'),
                "donator" => _t('Member.TYPEDONATORSIGNUP', 'Member.TYPEDONATORSIGNUP')
            )),
            $Location = BootstrapGeoLocationField::create('Location')->setTitle(_t('Member.LOCATION','Member.LOCATION')),
            $Email = EmailField::create('Email')->setTitle(_t('Member.EMAIL','Member.EMAIL')),
            PasswordField::create('Password')->setTitle(_t('Member.PASSWORD','Member.PASSWORD')),
            LiteralField::create('Accept_TOS', _t('SignupForm.CONFIRMTOS', 'SignupForm.CONFIRMTOS'))
        );
        
        $Type->setRightTitle(_t('Member.TYPEDESCRIPTION','Member.TYPEDESCRIPTION'));
        $Location->setRightTitle(_t('Member.LOCATIONDESCRIPTION','Member.LOCATIONDESCRIPTION'));
        
        $actions = new FieldList(
            $Submit = BootstrapLoadingFormAction::create('doSignup')->setTitle(_t('SignupForm.BUTTONSIGNUP','SignupForm.BUTTONSIGNUP'))
        );
         
        parent::__construct(
            $controller,
            $name,
            $fields,
            $actions,
            new RequiredUniqueFields(
                    $required = array(
                        "Nickname",
                        "Type",
                        "Location",
                        "Email",
                        "Password"
                    ), $unique = array(
                        "Email" => _t('SignupForm.EMAILEXISTS', 'SignupForm.EMAILEXISTS')
                    ), $objectClass = 'Member'
            )
        );
    }
    
    public function doSignup(array $data) {
            
        $o_Member = Member::create();
        
        $this->saveInto($o_Member);
            
        $o_Member->Locale = i18n::get_locale();
        $o_Member->write();
            
        // We use Email Verified Member
        $this->controller->redirect('Security/emailsent/'.$data['Email']);
    }
}