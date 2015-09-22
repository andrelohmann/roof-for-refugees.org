<?php
/**
 * Implements a basic Controller
 * @package some config
 * http://doc.silverstripe.org/framework/en/3.1/topics/controller
 */
class FacebookSignupController extends Controller {
	
	public static $url_topic = 'socialconnectsignup';
	
	public static $url_segment = 'facebooksignup';
	
	private static $allowed_actions = array( 
            'index',
            'FacebookSignupForm'
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
	 * Returns a link to this controller.  Overload with your own Link rules if they exist.
	 */
	public function Link() {
		return self::$url_segment .'/';
	}

	/**
	 * Show the registration form
	 */
	public function index() { // Signup Step 1
            
            if(Member::currentUser()) return $this->redirect(Security::default_login_dest());
            
            // Signup nur zulassen, wennFacebookUserData Session gesetzt wurde
            if(!$user = Session::get('FacebookUserData')) return $this->redirect('home/index');
            
            if(isset($user['name']) && !Session::get('FormInfo.FacebookSignupForm.Nickname')){
                Session::set('FormInfo.FacebookSignupForm.Nickname', $user['name']);
            }
            
            return $this->customise(new ArrayData(array(
                'Title' => _t('RfrFacebookConnect.SIGNUPTITLE', 'RfrFacebookConnect.SIGNUPTITLE'),
                'Content' => _t('RfrFacebookConnect.SIGNUPCONTENT', 'RfrFacebookConnect.SIGNUPCONTENT'),
                'Form' => $this->FacebookSignupForm()
            )))->renderWith(
                array('Facebook_signup', 'Facebook', $this->stat('template_main'), $this->stat('template'))
            );
	}
        
        public function FacebookSignupForm(){
            // http://doc.silverstripe.org/framework/en/3.1/topics/forms
            return FacebookSignupForm::create($this, "FacebookSignupForm");
        }
}
