<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class RfrMemberExtension extends DataExtension {
    
    private static $people_sum = array(
        '0' => '0',
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4',
        '5' => '5',
        '6' => '>5'
    );
    
    private static $db = array(
        "Nickname" => "Varchar(255)",
        "Type" => "Enum('refugee,hostel,donator')",
        "Location" => "GeoLocation",
        "Active" => "Boolean",
        "Adults" => "Int",
        "Children" => "Int",
        "Baby" => "Boolean",
        "About" => "Text",
        "Occupied" => "Boolean", // Hostel is full/occupied
        "Coordinator" => "Boolean", // User manages refugee accounts for those without access to their own device
        "Coordinated" => "Boolean", // virtual user managed by thirdparty coordinator
        "SignupComplete" => "Boolean"
    );
    
    public function AdultsSum(){
        if($this->owner->Adults) return self::$people_sum[$this->owner->Adults];
        return 0;
    }
    
    public function ChildrenSum(){
        if($this->owner->Children) return self::$people_sum[$this->owner->Children];
        return 0;
    }
    
    private static $has_one = array(
        'Avatar' => 'SecureImage'
    );
    
    
    public function onBeforeWrite() {
        // Create a Long ID
        if(!$this->owner->ID) {
            do{
                $newId = mt_rand(1000000000, 2147483647);
                $Created = SS_Datetime::now()->Rfc2822();
            }while(Member::get()->byID($newId));
            $this->owner->Created = $Created;
            $this->owner->ID = $newId;
            if(!$this->owner->Email) $this->owner->Email = $newId;
        }
    }
    
    
}