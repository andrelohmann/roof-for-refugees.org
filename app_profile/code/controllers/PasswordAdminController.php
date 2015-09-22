<?php
/**
 * Implements a basic Controller
 * @package some config
 * http://doc.silverstripe.org/framework/en/3.1/topics/controller
 */
class PasswordAdminController extends Controller {
	
	public static $url_topic = 'passwordadmin';
	
	public static $url_segment = 'passwordadmin';
	
	private static $allowed_actions = array(
		'index',
		'PasswordEditForm'
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
        
        if(!Member::currentUser() || !Member::currentUser()->IsContentAuthor()) $this->redirect('Security/login?BackURL=cloud/index');
 	}

	/**
	 * Show the "index" page
	 *
	 * @return string Returns the "login" page as HTML code.
	 */
	public function index() {
            
            return $this->customise(new ArrayData(array(
                "Title" => _t("PasswordAdmin.TITLE", "PasswordAdmin.TITLE"),
                "Form" => $this->PasswordEditForm()
            )))->renderWith(
                array('PasswordAdmin_index', 'PasswordAdmin', $this->stat('template_main'), $this->stat('template'))
            );
	}
	
	public function PasswordEditForm(){
		return PasswordEditForm::create($this, "PasswordEditForm");
    }
}
