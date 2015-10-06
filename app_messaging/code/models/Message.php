<?php

/**
 * Message object that represents a message between two members
 */
class Message extends DataObject {
    
    private static $db = array(
        'Text' => 'Text'
    );
    
    private static $has_one = array(
        'Sender' => 'Member',
        'Receiver' => 'Member'
    );
}