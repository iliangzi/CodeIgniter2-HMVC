<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
/** load the CI class for Modular Separation **/

class MX_Hooks extends CI_Hooks
{

	function _initialize($_module = '')
	{
		$RTR =& load_class('Router', 'core');
		$CFG =& load_class('Config', 'core');

		// If hooks are not enabled in the config file
		// there is nothing else to do

		if ($CFG->item('enable_hooks') == FALSE)
		{
			return;
		}

		$_module || $_module = $RTR->fetch_module();
		$file = 'hooks';
		list($path, $file) = Modules::find($file, $_module, 'config/');
		if ($path === FALSE) 
		{
			parent::_initialize();					
			return;
		}

		if ($config = Modules::load_file($file, $path, 'hook')) 
		{
			$this->hooks =& $hook;
			$this->enabled = TRUE;
		}  
	}

}
