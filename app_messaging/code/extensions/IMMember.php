<?php

/**
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class IMMember extends DataExtension {
    
    private static $has_many = array(
        'Inbox' => 'Message.Receiver',
        'Outbox' => 'Message.Sender'
    );
    
    private static $many_many = array(
        'FriendRequested' => 'Member'
    );
    
    private static $belongs_many_many = array(
        'FriendConfirmed' => 'Member.FriendRequested'
    );
	
    private static $many_many_extraFields=array(
        'FriendRequested'=>array(
            'LastMessage'=>'SS_Datetime',
            'UnreadMessage'=>'Boolean'
	)
    );
    
    public function Friends(){
        return $this->owner->getManyManyComponents('FriendRequested')->innerJoin("Member_FriendRequested", "\"Member_FriendRequested\".\"MemberID\" = \"FriendConfirmed\".\"ChildID\" AND \"Member_FriendRequested\".\"ChildID\" = \"FriendConfirmed\".\"MemberID\"", "FriendConfirmed")->sort("\"Member_FriendRequested\".\"UnreadMessage\" DESC, \"FriendConfirmed\".\"LastMessage\" DESC");
    }
    
    public function OpenRequests(){ // Friend requests that haven't been confirmed by the other party
        return $this->owner->getManyManyComponents(
                'FriendRequested'
        )->leftJoin(
                "Member_FriendRequested", 
                "\"Member_FriendRequested\".\"MemberID\" = \"FriendConfirmed\".\"ChildID\" AND \"Member_FriendRequested\".\"ChildID\" = \"FriendConfirmed\".\"MemberID\"",
                "FriendConfirmed"
        )->where("\"FriendConfirmed\".\"MemberID\" IS NULL AND \"FriendConfirmed\".\"ChildID\" IS NULL");
    }
    
    public function OpenConfirmations(){ // Friend requests from other parties, that haven't been confirmed by me
        return $this->owner->getManyManyComponents(
                'FriendConfirmed'
        )->leftJoin(
                "Member_FriendRequested", 
                "\"Member_FriendRequested\".\"MemberID\" = \"FriendConfirmed\".\"ChildID\" AND \"Member_FriendRequested\".\"ChildID\" = \"FriendConfirmed\".\"MemberID\"",
                "FriendConfirmed"
        )->where("\"FriendConfirmed\".\"MemberID\" IS NULL AND \"FriendConfirmed\".\"ChildID\" IS NULL");
    }
    
    public function Friend($ID = false){
        if(!$ID) $ID = Member::currentUserID ();
        return $this->owner->Friends()->filter(array('ID' => $ID))->first();
    }
    
    public function OpenRequestsCount(){
        return $this->owner->OpenRequests()->Count();
    }
    
    public function OpenRequestsBadge(){
        $count = $this->owner->OpenRequestsCount();
        if($count > 0) return ' <span class="badge">'.$count.'</span>';
        else return '';
    }
    
    public function OpenConfirmationsCount(){
        return $this->owner->OpenConfirmations()->Count();
    }
    
    public function OpenConfirmationsBadge(){
        $count = $this->owner->OpenConfirmationsCount();
        if($count > 0) return ' <span class="badge">'.$count.'</span>';
        else return '';
    }
    
    public function FriendsCount(){
        return $this->owner->Friends()->Count();
    }
    
    public function OpenMessagesCount(){
        return $this->owner->Friends()->where("\"Member_FriendRequested\".\"UnreadMessage\"=1")->Count();
    }
    
    public function NewMessagesBadge(){
        $count = $this->owner->OpenMessagesCount();
        if($count > 0) return ' <span class="badge">'.$count.'</span>';
        else return '';
    }
    
    public function RequestFriend($Member = null){ // Request this Member as a friend
        if(!$Member) $Member = Member::currentUser();
        $Member->FriendRequested()->add($this->owner, array(
            'LastMessage' => SS_Datetime::now()
        ));
        $this->owner->extend('FriendshipRequested', $Member); // implement FriendshipRequest($From) for Message Queue
    }
    
    public function ConfirmFriend($Member = null){ // Confirm this Member as Friend
        if(!$Member) $Member = Member::currentUser();
        $Member->FriendRequested()->add($this->owner, array(
            'LastMessage' => SS_Datetime::now()
        ));
        $this->owner->extend('FriendshipConfirmed', $Member); // implement FriendshipConfirmed($From) for Message Queue
    }
    
    public function DeclineFriend($Member = null){ // decline a friend request
        if(!$Member) $Member = Member::currentUser();
        $this->owner->FriendRequested()->remove($Member);
        $Member->FriendRequested()->remove($this->owner);
        $this->owner->extend('FriendshipDeclined', $Member); // implement FriendshipDeclined($From) for Message Queue
    }
    
    public function DropFriend($Member = null){ // drop a friendship
        if(!$Member) $Member = Member::currentUser();
        $this->owner->FriendRequested()->remove($Member);
        $Member->FriendRequested()->remove($this->owner);
        $this->owner->extend('FriendshipDroped', $Member); // implement FriendshipDroped($From) for Message Queue
    }
    
    public function Messages(){
        if($this->owner->ID != Member::currentUserID()) return Message::get()->filter(array(
            'SenderID' => array($this->owner->ID, Member::currentUserID()),
            'ReceiverID' => array($this->owner->ID, Member::currentUserID())
        ))->sort('Created DESC');
        else die('Method Messages is not allowed on current User!');
    }
    
    public function MessagesCount(){
        return $this->owner->Messages()->Count();
    }
    
    public function updateCMSFields(FieldList $fields) {
        $fields->removeByName('FriendRequested');
        $fields->removeByName('FriendAccepted');
    }
}