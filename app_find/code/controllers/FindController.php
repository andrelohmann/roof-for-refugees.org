<?php
/**
 * Implements a basic Controller
 * @package some config
 * http://doc.silverstripe.org/framework/en/3.1/topics/controller
 */
class FindController extends Controller {
	
	public static $url_topic = 'find';
	
	public static $url_segment = 'find';
	
	private static $allowed_actions = array( 
		'index',
                'refugees',
                'hostels',
                'donators',
                'SearchForm'
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
            $Members = new PaginatedList(self::members(), $this->request);
            $Members->setPageLength(10);
            
            return $this->customise(new ArrayData(array(
                "Members" => $Members,
                "SearchForm" => $this->SearchForm()
            )))->renderWith(
                array('Find_index', 'Find', $this->stat('template_main'), $this->stat('template'))
            );
	}

	/**
	 * Show the "login" page
	 *
	 * @return string Returns the "login" page as HTML code.
	 */
	public function refugees() {
            
            // Vorerst keine Seite erstellt
            $Members = new PaginatedList(self::members()->filter(array("Type" => 'refugee')), $this->request);
            $Members->setPageLength(10);
            
            return $this->customise(new ArrayData(array(
                "Members" => $Members,
                "SearchForm" => $this->SearchForm()
            )))->renderWith(
                array('Find_refugees', 'Find', $this->stat('template_main'), $this->stat('template'))
            );
	}

	/**
	 * Show the "login" page
	 *
	 * @return string Returns the "login" page as HTML code.
	 */
	public function hostels() {
            
            // Vorerst keine Seite erstellt
            $Members = new PaginatedList(self::members()->filter(array("Type" => 'hostel')), $this->request);
            $Members->setPageLength(10);
            
            return $this->customise(new ArrayData(array(
                "Members" => $Members,
                "SearchForm" => $this->SearchForm()
            )))->renderWith(
                array('Find_hostels', 'Find', $this->stat('template_main'), $this->stat('template'))
            );
	}

	/**
	 * Show the "login" page
	 *
	 * @return string Returns the "login" page as HTML code.
	 */
	public function donators() {
            
            // Vorerst keine Seite erstellt
            $Members = new PaginatedList(self::members()->filter(array("Type" => 'donator')), $this->request);
            $Members->setPageLength(10);
            
            return $this->customise(new ArrayData(array(
                "Members" => $Members,
                "SearchForm" => $this->SearchForm()
            )))->renderWith(
                array('Find_donators', 'Find', $this->stat('template_main'), $this->stat('template'))
            );
	}
        
        public function SearchForm(){
            return SearchForm::create($this, "SearchForm");
        }
    
        /**
         * Calculate all Tours within the matching time and distance frame
         * 
         * @return boolean
         */
        private static function members() {
            // Build Query
            $Bounce = Member::currentUser()->obj('Location')->getSQLFilter(Session::get('SearchForm.Radius') ? Session::get('SearchForm.Radius') : SearchForm::$default_radius);
            
            $sort = Member::currentUser()->obj('Location')->getSQLOrder();
            
            return Member::get()->filter(array("Active" => true, "SignupComplete" => true,))->exclude(array("ID" => Member::currentUserID()))->where($Bounce)->sort($sort, 'ASC');
        }
}
