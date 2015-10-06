<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class SearchForm extends BootstrapHorizontalForm {
    
    static public $radius = array('1' => '1 KM','5' => '5 KM', '10' => '10 KM', '20' => '20 KM', '50' => '50 KM');
    static public $default_radius = 5;
 
    public function __construct($controller, $name, $fields = null, $actions = null) {
        
        $fields = new FieldList(
            $Radius = DropdownField::create('Radius')->setTitle(_t('SearchForm.RADIUS','SearchForm.RADIUS'))->setSource(self::$radius)->setValue((Session::get('SearchForm.Radius') ? Session::get('SearchForm.Radius') : self::$default_radius))
        );
        $Radius->addExtraClass('input-lg');
        
        
        $actions = new FieldList(
            $Search = BootstrapLoadingFormAction::create('doSearch')->setButtonContent(_t('SearchForm.UPDATERADIUS','SearchForm.UPDATERADIUS').' <span class="glyphicon glyphicon-screenshot" aria-hidden="true"></span>')
        );
        
        $Search->addExtraClass('btn-info btn-lg btn-block');
         
        parent::__construct(
            $controller,
            $name,
            $fields,
            $actions,
            new RequiredFields(
                "Radius"
            )
        );
    }
    
    public function doSearch(array $data) {
        
        Session::set('SearchForm.Radius', $data['Radius']);
        
        $this->controller->redirectBack();
    }
}