<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PasswordEditForm extends BootstrapHorizontalForm {
    
    public function __construct($controller, $name, $fields = null, $actions = null) {
        
        $fields = new FieldList(
            ReadonlyField::create('Nickname')->setTitle(_t('Member.NICKNAME', 'Member.NICKNAME')),
            ReadonlyField::create('Email')->setTitle(_t('Member.EMAIL', 'Member.EMAIL')),
            $Password = new BootstrapConfirmedPasswordField(
                'Password',
                _t('Member.db_Password', 'Member.db_Password')
            )
        );
        
        $actions = new FieldList(
            $Submit = BootstrapLoadingFormAction::create('doEdit')->setTitle(_t('PasswordEditForm.CHANGEPASSWORD', 'PasswordEditForm.CHANGEPASSWORD'))
        );
         
        parent::__construct(
            $controller,
            $name,
            $fields,
            $actions,
            new RequiredFields(
                "Password"
            )
        );
        
        if(Member::currentUser()) $this->loadDataFrom(Member::currentUser());
    }
    
    public function doEdit(array $data) {
        
        if($Member = Member::currentUser()){
        
            $this->saveInto($Member);

            $Member->Changed = true;
            $Member->write();
            
            $this->sessionMessage(_t('PasswordEditForm.SUCCESS', 'PasswordEditForm.SUCCESS'), 'good');
        }
        
        $this->controller->redirect('passwordadmin/index');
    }
}
