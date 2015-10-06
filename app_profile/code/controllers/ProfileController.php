<?php
/**
 * Implements a basic Controller
 * @package some config
 * http://doc.silverstripe.org/framework/en/3.1/topics/controller
 */
class ProfileController extends Controller {
	
	public static $url_topic = 'profile';
	
	public static $url_segment = 'profile';
	
	private static $allowed_actions = array( 
		'index',
                'refugee',
                'RefugeeEditForm',
                'hostel',
                'HostelEditForm',
                'occupiedtoggle',
                'donator',
                'DonatorEditForm',
                'delqueuemessage'
	);
	
	public static $template = 'BlankPage';
	
	/**
	 * Template thats used to render the pages.
	 *
	 * @var string
	 */
	public static $template_main = 'Page';

	/**
	 * Returns a link to this controller.  Overload with your own Link rules if they exist.
	 */
	public function Link() {
		return self::$url_segment .'/';
	}
	
	/**
	 * Initialise the controller
	 */
	public function init() {
		parent::init();
                
                if(!Member::currentUser()) $this->redirect('home/index');
 	}

	/**
	 * Show the "index" page
	 *
	 * @return string Returns the "index" page as HTML code.
	 */
	public function index() {
            
            switch(Member::currentUser()->Type){
                case 'refugee':
                    return $this->redirect('profile/refugee');
                break;
            
                case 'hostel':
                    return $this->redirect('profile/hostel');
                break;
            
                case 'donator':
                    return $this->redirect('profile/donator');
                break;
            }
        }
        
        public function refugee(){
            
            // Vorerst keine Seite erstellt
            return $this->customise(new ArrayData(array(
                "Content" => _t('Profile.REFUGEECONTENT', 'Profile.REFUGEECONTENT'),
                "Form" => $this->RefugeeEditForm()
            )))->renderWith(
                array('Profile_refugee', 'Profile', $this->stat('template_main'), $this->stat('template'))
            );
	}
        
        public function RefugeeEditForm(){
            return RefugeeEditForm::create($this, 'RefugeeEditForm');
        }
        
        public function hostel(){
            
            // Vorerst keine Seite erstellt
            return $this->customise(new ArrayData(array(
                "Content" => _t('Profile.HOSTELCONTENT', 'Profile.HOSTELCONTENT'),
                "Form" => $this->HostelEditForm()
            )))->renderWith(
                array('Profile_hostel', 'Profile', $this->stat('template_main'), $this->stat('template'))
            );
	}
        
        public function HostelEditForm(){
            return HostelEditForm::create($this, 'HostelEditForm');
        }
        
        public function occupiedtoggle(){
            if(Member::currentUser() && Member::currentUser()->Type == 'hostel'){
                $Member = Member::currentUser();
                if($Member->Occupied) $Member->Occupied = false;
                else $Member->Occupied = true;
                $Member->write();
            }
            
            $this->redirectBack();
        }
        
        public function donator(){
            
            // Vorerst keine Seite erstellt
            return $this->customise(new ArrayData(array(
                "Content" => _t('Profile.DONATORCONTENT', 'Profile.DONATORCONTENT'),
                "Form" => $this->DonatorEditForm()
            )))->renderWith(
                array('Profile_donator', 'Profile', $this->stat('template_main'), $this->stat('template'))
            );
	}
        
        public function DonatorEditForm(){
            return DonatorEditForm::create($this, 'DonatorEditForm');
        }
        
        public function delqueuemessage(){
            
            if($Message = Member::currentUser()->MessageQueue()->byID($this->urlParams['ID'])){
                $Message->delete();
            }
            
            return $this->redirect('profile/index');
        }
}
