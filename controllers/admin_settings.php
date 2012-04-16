<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Slider settings controller
 *
 * @author 		Michael Giuliana
 */
class Admin_settings extends Admin_Controller {

	/**
	 * The current active section
	 *
	 * @var string
	 */
	protected $section = 'settings';

	/**
	 * Constructor method
	 *
	 * Loads the form_validation library, the pages, pages layout
	 * and navigation models along with the language for the pages
	 * module.
	 */
	public function __construct()
	{
		parent::__construct();

		// Load the required classes
		$this->load->model('slider_settings_m');
		$this->load->model('slider_m');
		$this->lang->load('sliders');

		// Load the validation library
		//$this->load->library('form_validation');

		// Set the validation rules
		//$this->form_validation->set_rules($this->validation_rules);
	}

	/**
	 * Index method
	 */
	public function index()
	{
		if ($_POST)
		{
			// Set validation rules from model
			//$this->form_validation->set_rules($this->slider_settings_m->validation_rules);

			// Get posted vars
			$setup_id = $this->input->post('id');
			$props = array(
				'jquery' = $this->input->post('jquery'),
			);

			// If val is run
			if ($this->form_validation->run())
			{
				if ($id = $this->slider_settings_m->update($setup_id, $props))
				{
					// Fire an event. A new keyword has been added.
					//Events::trigger('keyword_created', $id);

					$this->session->set_flashdata('success', 'Settings updated.');
				}
				else
				{
					$this->session->set_flashdata('error', 'Settings updated failed.'));
				}

				redirect('admin/sliders/settings');
			}
		}

		// Loop through each validation rule
		/*
		foreach ($this->validation_rules as $rule)
		{
			$slider_settings_m->{$rule['field']} = set_value($rule['field']);
		}
		*/

		$this->template
			->title($this->module_details['name'])
			->set('settings', $this->slider_settings_m->get_all())
			->build('admin/settings/index', $data);
	}

	public function create()
	{
		$this->template->get_theme_path();
	}
}