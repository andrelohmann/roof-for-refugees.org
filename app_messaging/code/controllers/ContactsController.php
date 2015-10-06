<?php
/**
 * Implements a basic Controller
 * @package some config
 * http://doc.silverstripe.org/framework/en/3.1/topics/controller
 */
class ContactsController extends Controller {
	
	public static $url_topic = 'contacts';
	
	public static $url_segment = 'contacts';
	
	private static $allowed_actions = array( 
		'index',
                'requests',
                'request',
                'confirm',
                'decline',
                'drop'
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
	 * Show the "login" page
	 *
	 * @return string Returns the "login" page as HTML code.
	 */
	public function index() {
            
            // Vorerst keine Seite erstellt
            $Contacts = new PaginatedList(Member::currentUser()->Friends(), $this->request);
            $Contacts->setPageLength(10);
            
            return $this->customise(new ArrayData(array(
                "Title" => _t('Contacts.INDEXTITLE', 'Contacts.INDEXTITLE'),
                "Contacts" => $Contacts
            )))->renderWith(
                array('Contacts_index', 'Contacts', $this->stat('template_main'), $this->stat('template'))
            );
	}

	/**
	 * Show the "login" page
	 *
	 * @return string Returns the "login" page as HTML code.
	 */
	public function requests() {
            
            // Vorerst keine Seite erstellt
            $Contacts = new PaginatedList(Member::currentUser()->OpenConfirmations(), $this->request);
            $Contacts->setPageLength(10);
            
            if($Contacts->getTotalItems() == 0) return $this->redirect('contacts/index');
            
            return $this->customise(new ArrayData(array(
                "Title" => _t('Contacts.REQUESTSTITLE', 'Contacts.REQUESTSTITLE'),
                "Contacts" => $Contacts
            )))->renderWith(
                array('Contacts_requests', 'Contacts', $this->stat('template_main'), $this->stat('template'))
            );
	}

	/**
	 * Show the "login" page
	 *
	 * @return string Returns the "login" page as HTML code.
	 */
	public function request() {
            
            if(!$o_Member = Member::get()->byID($this->urlParams['ID'])){
                return $this->redirect('contacts/index');
            }
            
            $o_Member->RequestFriend();
            
            return $this->redirectBack();
            
            /*return $this->customise(new ArrayData(array(
                "Title" => _t('Contacts.REQUESTTITLE', 'Contacts.REQUESTTITLE'),
                "Member" => $o_Member
            )))->renderWith(
                array('Contacts_request', 'Contacts', $this->stat('template_main'), $this->stat('template'))
            );*/
	}

	/**
	 * Show the "login" page
	 *
	 * @return string Returns the "login" page as HTML code.
	 */
	public function confirm() {
            
            if($o_Member = Member::currentUser()->OpenConfirmations()->byID($this->urlParams['ID'])){
                $o_Member->ConfirmFriend();
            }
            
            return $this->redirectBack();
	}

	/**
	 * Show the "login" page
	 *
	 * @return string Returns the "login" page as HTML code.
	 */
	public function decline() {
            
            if($o_Member = Member::currentUser()->OpenConfirmations()->byID($this->urlParams['ID'])){
                $o_Member->DeclineFriend();
            }
            
            return $this->redirectBack();
	}

	/**
	 * Show the "login" page
	 *
	 * @return string Returns the "login" page as HTML code.
	 */
	public function drop() {
            
            if($o_Member = Member::currentUser()->Friends()->byID($this->urlParams['ID'])){
                $o_Member->DropFriend();
            }
            
            return $this->redirectBack();
	}
}
