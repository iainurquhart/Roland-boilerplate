<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ExpressionEngine - by EllisLab
 *
 * @package		ExpressionEngine
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2003 - 2011, EllisLab, Inc.
 * @license		http://expressionengine.com/user_guide/license.html
 * @link		http://expressionengine.com
 * @since		Version 2.0
 * @filesource
 */
 
// ------------------------------------------------------------------------

/**
 * Roland Module Control Panel File
 *
 * @package		ExpressionEngine
 * @subpackage	Addons
 * @category	Module
 * @author		Iain Urquhart
 * @link		
 */

class Roland_mcp {
	
	public $return_data;
	
	private $_base_url;
	
	var $module_name = "roland";
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->EE =& get_instance();
		
		$this->_form_base_url 	= 'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module='.$this->module_name;
		$this->_base_url		= BASE.AMP.$this->_form_base_url;
		$this->_theme_base_url 	= $this->EE->config->item('theme_folder_url').'third_party/'.$this->module_name;

	}
	
	// ----------------------------------------------------------------

	/**
	 * Index Function
	 *
	 * @return 	void
	 */
	public function index()
	{
		$this->EE->cp->set_variable('cp_page_title', 
								lang('roland_module_name'));
		
		$this->EE->load->library('table');
		$this->EE->cp->add_js_script('ui', 'sortable'); 
		
		// add our shizzle
		$this->EE->cp->add_to_head('
			<link type="text/css" href="'.$this->_theme_base_url.'/css/roland.css" rel="stylesheet" />
			<script src="'.$this->_theme_base_url.'/js/jquery.roland.js"></script>
		');

		$vars = array();
		$vars['_form_base_url'] = $this->_form_base_url;
		
		// post values in example form
		$vars['templates'] = $this->EE->input->post('templates');
		$vars['users'] = $this->EE->input->post('users');
		$vars['hat_on'] = $this->EE->input->post('hat_on');
		
		// misc assets/classes required
		$vars['drag_handle'] = '&nbsp;';
		$vars['nav'] = '<a class="remove_row" href="#">-</a> <a class="add_row" href="#">+</a>';
		$vars['roland_template'] = array(
				'table_open'		=> '<table class="mainTable roland_table" border="0" cellspacing="0" cellpadding="0">',
				'row_start'			=> '<tr class="row">',
				'row_alt_start'     => '<tr class="row">'
		);
		
		return $this->EE->load->view('index', $vars, TRUE);
	
	}
	
}
/* End of file mcp.roland.php */
/* Location: /system/expressionengine/third_party/roland/mcp.roland.php */