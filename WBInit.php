<?php
/**
 * @package WB
 */
namespace WB;

/*use Wp\AddRewriteRules as AddRules;
use Api\SalesForce as SF;*/

/**
 * Class that ...
 */
class WBInit {
	/**
	 * Handler responsible for the oauth server's management
	 */
	protected $server = null;

	/**
	 * Constructor
	 */
	public function __construct() {
		// Custom API's rewrite rules
		//new AddRules( SERVICES_PATH . 'api/([^/]+)?', 'resource=$matches[1]', array( &$this, 'serve' ) );
		//new AddRules( SERVICES_PATH . 'oauth/token?', 'data', array( &$this, 'oauth' ) );

		if ( !empty($_GET['flush']) && $_GET['flush'] == 'true' )
			add_action('init', array(&$this, 'flush'));
	}

	/**
	 * This method does something ...
	 * @param $content The description of the variable
	 * @return string
	 */
	public function serve( $content ) {
		//...
		return "ok";
	}

	/**
	 * Flusher for rewrite rules defined
	 * @return void
	 */
	public function flush() {
		flush_rewrite_rules( false );
	}
}

new WBInit;