<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
*
*/

/**
 * Prevent direct access to this controller via URL
 *
 * @access public
 * @param  string $method name of method to call
 * @param  array  $params Parameters that would normally get passed on to the method
 * @return void
 */





class Theme extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
	}


public function _remap($method, $params = array())
{
    // get controller name
    $controller = mb_strtolower(get_class($this));

    if ($controller === mb_strtolower($this->uri->segment(1))) {
        // if requested controller and this controller have the same name
        // show 404 error
        show_404();
    } elseif (method_exists($this, $method))
    {
        // if method exists
        // call method and pass any parameters we recieved onto it.
        return call_user_func_array(array($this, $method), $params);
    } else {
        // method doesn't exist, show error
        show_404();
    }
}





    function template($data = Null)
    {
        $this->load->view('theme/admin_template',$data);
				$this->output->cache(10);
    }
} //eof
