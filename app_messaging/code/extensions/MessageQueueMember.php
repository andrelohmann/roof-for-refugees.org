<?php

/**
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MessageQueueMember extends DataExtension {
    
    private static $has_many = array(
        'MessageQueue' => 'QueueMessage.Receiver', // Messages from the Message Queue
    );
    
    public function FriendshipRequested($Member){
        $QM = QueueMessage::create();
        $QM->ReceiverID = $this->owner->ID;
        $QM->Type = 'friendship_requested';
        $QM->SenderID = $Member->ID;
        $QM->write();
    }
    
    public function FriendshipConfirmed($Member){
        $QM = QueueMessage::create();
        $QM->ReceiverID = $this->owner->ID;
        $QM->Type = 'friendship_confirmed';
        $QM->SenderID = $Member->ID;
        $QM->write();
    }
    
    public function FriendshipDeclined($Member){
        $QM = QueueMessage::create();
        $QM->ReceiverID = $this->owner->ID;
        $QM->Type = 'friendship_declined';
        $QM->SenderID = $Member->ID;
        $QM->write();
    }
    
    public function FriendshipDroped($Member){
        $QM = QueueMessage::create();
        $QM->ReceiverID = $this->owner->ID;
        $QM->Type = 'friendship_droped';
        $QM->SenderID = $Member->ID;
        $QM->write();
    }
    
    public function PaginatedMessageQueue(){
        
        $Messages = new PaginatedList($this->owner->MessageQueue()->Sort('Created DESC'), Controller::curr()->request);
        $Messages->setPageLength(10);
        return $Messages;
    }
}