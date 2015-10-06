<?php

/**
 * Represents a Message from the Members MessageQueue.
 * 
 * Everytime an action takes place on e.g. a subscribed channel/artist, (friends) request, ...
 * this action will be posted to the users MessageQueue.
 * 
 * When a QueueMessage has been watched, it will be deleted after a certain time
 * 
 * @version 0.1
 * @author Andre lohmann <lohmann.andre@gmail.com>
 */
class QueueMessage extends DataObject {
    
    /**
     * @var Type
     * friendship_requested -> friendship was requested by other party
     * friendship_confirmed -> friendship was confirmed by other party
     * friendship_declined -> friendship was declined by other party
     * friendship_droped -> existing friendship was droped by other party
     */
    private static $db = array(
        "Type" => "Enum('friendship_requested,friendship_confirmed,friendship_declined,friendship_droped')", // types of Messages
        "SenderID" => "Int"//, // ObjectID of the sending Object
        //"RelatedID" => "Int" // ObjectID of a secondary related object
    );
    
    private static $has_one = array(
        'Receiver' => 'Member' // the Member, this Message was send to
    );
    
    public function Sender(){
        switch($this->Type){
            case 'friendship_requested':
            case 'friendship_confirmed':
            case 'friendship_declined':
            case 'friendship_droped':
                return Member::get()->byID($this->SenderID);
            break;
        }
        return false;
    }
    
    /*public function Related(){
        switch($this->Type){
            case 'friendship_requested':
            case 'friendship_confirmed':
            case 'friendship_declined':
            case 'friendship_droped':
                return Member::get()->byID($this->RelatedID);
            break;
        }
        return false;
    }*/
    
}