<?php
/**
 * Implements a basic Controller
 * @package some config
 * http://doc.silverstripe.org/framework/en/3.1/topics/controller
 */
class GoogleSignupController extends Controller {
	
	public static $url_topic = 'socialconnectsignup';
	
	public static $url_segment = 'googlesignup';
	
	private static $allowed_actions = array( 
            'index',
            'GoogleSignupForm'
	);
	
	public static $template = 'BlankPage';
	
	/**
	 * Template thats used to render the pages.
	 *
	 * @var string
	 */
	public static $template_main = 'Page';
	
	/**
	 * Initialise the controller
	 */
	public function init() {
            parent::init();
 	}

	/**
	 * Show the registration form
	 */
	public function index() { // Signup Step 1
            
            if(Member::currentUser()) return $this->redirect(Security::default_login_dest());
            
            // Signup nur zulassen, wenn GoogleUserData Session gesetzt wurde
            if(!$user = Session::get('GoogleUserData')) return $this->redirect('home/index');
            
            if(isset($user['name']) && !Session::get('FormInfo.GoogleSignupForm.Nickname')){
                Session::set('FormInfo.GoogleSignupForm.Nickname', $user['name']);
            }
            
            return $this->customise(new ArrayData(array(
                'Title' => _t('RfrGoogleConnect.SIGNUPTITLE', 'RfrGoogleConnect.SIGNUPTITLE'),
                'Content' => _t('RfrGoogleConnect.SIGNUPCONTENT', 'RfrGoogleConnect.SIGNUPCONTENT'),
                'Form' => $this->GoogleSignupForm()
            )))->renderWith(
                array('Google_signup', 'Google', $this->stat('template_main'), $this->stat('template'))
            );
	}
        
        public function GoogleSignupForm(){
            // http://doc.silverstripe.org/framework/en/3.1/topics/forms
            return GoogleSignupForm::create($this, "GoogleSignupForm");
        }
}
