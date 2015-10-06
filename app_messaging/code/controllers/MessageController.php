<?php
/**
 * Implements a basic Controller
 * @package some config
 * http://doc.silverstripe.org/framework/en/3.1/topics/controller
 */
class MessageController extends Controller {
	
	public static $url_topic = 'messaging';
	
	public static $url_segment = 'message';
	
	private static $allowed_actions = array( 
		'index',
                'chat',
                'MessageForm'
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
            $Members = new PaginatedList(Member::currentUser()->Friends(), $this->request);
            $Members->setPageLength(10);
            
            return $this->customise(new ArrayData(array(
                "Contacts" => $Members
            )))->renderWith(
                array('Message_index', 'Message', $this->stat('template_main'), $this->stat('template'))
            );
	}

	/**
	 * Show the "terms" page
	 *
	 * @return string Returns the "terms" page as HTML code.
	 */
	public function chat() {
            
            if(!$o_Member = Member::currentUser()->Friend($this->urlParams['ID'])){
                return $this->redirect('message/index');
            }
            
            // Update Many Many relation as read
            Member::currentUser()->Friends()->add($o_Member, array(
                'UnreadMessage' => false
            ));
            
            $Chat = new PaginatedList($o_Member->Messages(), $this->request);
            $Chat->setPageLength(10);
            
            return $this->customise(new ArrayData(array(
                "ChatPartner" => sprintf(_t('Message.CHATPARTNER', 'Message.CHATPARTNER'), $o_Member->Nickname),
                "Chat" => $Chat,
                "MessageForm" => $this->MessageForm()
            )))->renderWith(
                array('Message_chat', 'Message', $this->stat('template_main'), $this->stat('template'))
            );
	}
        
        public function MessageForm(){
            // http://doc.silverstripe.org/framework/en/3.1/topics/forms
            return MessageForm::create($this, "MessageForm");
        }
}
