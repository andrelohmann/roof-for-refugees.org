<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class TwitterSignupForm extends BootstrapHorizontalForm {
 
    public function __construct($controller, $name, $fields = null, $actions = null) {
        
        $fields = new FieldList(
            $Nickname = TextField::create('Nickname')->setTitle(_t('Member.NICKNAME','Member.NICKNAME'))->setValue(Session::get('FormInfo.TwitterSignupForm.Nickname')),
            $Type = OptionsetField::create('Type')->setTitle(_t('Member.TYPE','Member.TYPE'))->setSource(array(
                "refugee" => _t('Member.TYPEREFUGEESIGNUP', 'Member.TYPEREFUGEESIGNUP'),
                "hostel" => _t('Member.TYPEHOSTELSIGNUP', 'Member.TYPEHOSTELSIGNUP'),
                "donator" => _t('Member.TYPEDONATORSIGNUP', 'Member.TYPEDONATORSIGNUP')
            )),
            $Email = EmailField::create('Email')->setTitle(_t('Member.EMAIL','Member.EMAIL')),
            $Location = BootstrapGeoLocationField::create('Location')->setTitle(_t('Member.LOCATION','Member.LOCATION')),
            
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
                        "Email",
                        "Location"
                    ), $unique = array(
                        "Email" => _t('SignupForm.EMAILEXISTS', 'SignupForm.EMAILEXISTS')
                    ), $objectClass = 'Member'
            )
        );
    }
    
    public function doSignup(array $data) {
        
        if(!$user = Session::get('TwitterUserData')) return $this->controller->redirect('twitter/error');
        
        $o_Member = new Member();
            
        $this->saveInto($o_Member);
            
        $o_Member->SocialConnectType = 'twitter';
            
        $o_Member->TwitterID = $user['id'];
            
        $o_Member->Locale = i18n::get_locale();
            
        Config::inst()->update('Member', 'deactivate_send_validation_mail', false);
        $o_Member->Verified = true;
        $o_Member->VerificationEmailSent = true;
        Config::inst()->update('Member', 'deactivate_send_validation_mail', true);
        $o_Member->write();
        Config::inst()->update('Member', 'deactivate_send_validation_mail', false);
            
        $o_Member->addToFrontendGroup();
            
        Session::clear('TwitterUserData');
            
        $o_Member->logIn();

        // return Director::redirect($this->URLSegment.'/profile');
        // We use Email Verified Member
        return $this->controller->redirect(Security::default_login_dest());
    }
}
