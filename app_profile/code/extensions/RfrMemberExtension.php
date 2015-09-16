<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class RfrMemberExtension extends DataExtension {
    
    private static $db = array(
        "Nickname" => "Varchar(255)",
        "Type" => "Enum('refugee,hostel,donator')",
        "Location" => "GeoLocation",
        "SignupFinalized" => "Boolean"
    );
}