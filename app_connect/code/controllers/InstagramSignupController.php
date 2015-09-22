<?php
/**
 * Implements a basic Controller
 * @package some config
 * http://doc.silverstripe.org/framework/en/3.1/topics/controller
 */
class InstagramSignupController extends Controller {
	
	public static $url_topic = 'socialconnectsignup';
	
	public static $url_segment = 'instagramsignup';
	
	private static $allowed_actions = array( 
            'index',
            'InstagramSignupForm'
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
            
            // Signup nur zulassen, wenn InstagramUserData Session gesetzt wurde
            if(!$user = Session::get('InstagramUserData')) return $this->redirect('home/index');
            
            if(isset($user['username']) && !Session::get('FormInfo.InstagramSignupForm.Nickname')){
                Session::set('FormInfo.InstagramSignupForm.Nickname', $user['username']);
            }
            
            return $this->customise(new ArrayData(array(
                'Title' => _t('RfrInstagramConnect.SIGNUPTITLE', 'RfrInstagramConnect.SIGNUPTITLE'),
                'Content' => _t('RfrInstagramConnect.SIGNUPCONTENT', 'RfrInstagramConnect.SIGNUPCONTENT'),
                'Form' => $this->InstagramSignupForm()
            )))->renderWith(
                array('Instagram_signup', 'Instagram', $this->stat('template_main'), $this->stat('template'))
            );
	}
        
        public function InstagramSignupForm(){
            // http://doc.silverstripe.org/framework/en/3.1/topics/forms
            return InstagramSignupForm::create($this, "InstagramSignupForm");
        }
}
