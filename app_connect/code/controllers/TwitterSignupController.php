<?php
/**
 * Implements a basic Controller
 * @package some config
 * http://doc.silverstripe.org/framework/en/3.1/topics/controller
 */
class TwitterSignupController extends Controller {
	
	public static $url_topic = 'socialconnectsignup';
	
	public static $url_segment = 'twittersignup';
	
	private static $allowed_actions = array(
            'index',
            'TwitterSignupForm'
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
            
            // Signup nur zulassen, wenn TwitterUserData Session gesetzt wurde
            if(!$user = Session::get('TwitterUserData')) return $this->redirect('home/index');
            
            if(isset($user->screen_name) && !Session::get('FormInfo.TwitterSignupForm.Nickname')){
                Session::set('FormInfo.TwitterSignupForm.Nickname', $user->screen_name);
            }
            
            return $this->customise(new ArrayData(array(
                'Title' => _t('RfrTwitterConnect.SIGNUPTITLE', 'RfrTwitterConnect.SIGNUPTITLE'),
                'Content' => _t('RfrTwitterConnect.SIGNUPCONTENT', 'RfrTwitterConnect.SIGNUPCONTENT'),
                'Form' => $this->TwitterSignupForm()
            )))->renderWith(
                array('Twitter_signup', 'Twitter', $this->stat('template_main'), $this->stat('template'))
            );
	}
        
        public function TwitterSignupForm(){
            // http://doc.silverstripe.org/framework/en/3.1/topics/forms
            return TwitterSignupForm::create($this, "TwitterSignupForm");
        }
}
