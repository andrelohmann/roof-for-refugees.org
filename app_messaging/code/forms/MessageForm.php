<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class MessageForm extends BootstrapHorizontalForm {
 
    public function __construct($controller, $name, $fields = null, $actions = null) {
            
        $fields = new FieldList(
            $Message = TextareaField::create('Text')->setTitle(_t('Message.MESSAGETEXT','Message.MESSAGETEXT')),
            new HiddenField("ReceiverID", null, (int) $controller->urlParams['ID'])
        );
        
        $actions = new FieldList(
            $Submit = BootstrapLoadingFormAction::create('doSend')->setTitle(_t('Message.BUTTONSEND','Message.BUTTONSEND'))
        );
         
        parent::__construct(
            $controller,
            $name,
            $fields,
            $actions,
            new RequiredFields(
                "Text",
                "ReceiverID"
            )
        );
    }
    
    public function doSend(array $data) {
            
        $o_Message = new Message();
            
        $this->saveInto($o_Message);
        $o_Member = Member::get()->byID($data['ReceiverID']);
        // Redirect, if message send is not allowed
        //if(!Member::currentUser()->isAllowedTo('sendMessage', $o_Member)) return $this->controller->redirect('server-error');
        
        // 
        
        $o_Message->ReceiverID = $o_Member->ID;
        $o_Message->SenderID = Member::currentUserID();
        $o_Message->write();
        
        // Update Many Many relation as unread
        $o_Member->Friends()->add(Member::currentUser(), array(
            'UnreadMessage' => true,
            'LastMessage' => SS_Datetime::now()
        ));
        
        $this->controller->redirectBack();
    }
}
