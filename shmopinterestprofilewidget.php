<?php
/**
 * NOTICE OF LICENSE
 *
 * This file is licenced under the Software License Agreement.
 * With the purchase or the installation of the software in your application
 * you accept the licence agreement.
 *
 * You must not modify, adapt or create derivative works of this source code
 *
 *  @author    Shopmods
 *  @copyright 2016 Shopmods
 *  @license   license.txt
 */

if (!defined('_PS_VERSION_')) exit;

class ShmoPinterestProfileWidget extends Module
{

	protected $errors = array();

	protected $config = array(
		'SHMO_PINTEREST_PROFILE_WIDGET' => '',
		'SHMO_PINTEREST_PROFILE_WIDGET_URL' => '',
		'SHMO_PINTEREST_PROFILE_WIDGET_BOARD_WIDTH' => '',
		'SHMO_PINTEREST_PROFILE_WIDGET_SCALE_HEIGHT' => '',
		'SHMO_PINTEREST_PROFILE_WIDGET_SCALE_WIDTH' => '',
	);

	public function __construct()
	{
		$this->name = 'shmopinterestprofilewidget';
		$this->tab = 'front_office_features';
		$this->version = '1.0.0';
		$this->author = 'Shopmods';
		$this->need_instance = 0;
		$this->bootstrap = true;
	 	parent::__construct();
		$this->displayName = $this->l('Pinterest Profile Widget by Shopmods');
		$this->description = $this->l('Adds a block with Pinterest Profile Widget.');
		$this->confirmUninstall = $this->l('Are you sure you want to delete Pinterest Profile Widget by Shopmods?');
	}

	public function install()
	{
		if (Shop::isFeatureActive()) Shop::setContext(Shop::CONTEXT_ALL);
		if (!parent::install()
		|| !$this->installConfig()
		|| !$this->registerHook('displayHeader')
		|| !$this->registerHook('displayTop')
		|| !$this->registerHook('displayHome')
		|| !$this->registerHook('displayLeftColumn')
		|| !$this->registerHook('displayRightColumn')
		|| !$this->registerHook('displayFooter')
		|| !$this->registerHook('backOfficeHeader')) {
			return false;
		}
		return true;
	}

	public function uninstall()
	{
		if (!parent::uninstall()
		||	!$this->removeConfig())
			return false;
		return true;
	}

	private function installConfig()
	{
		foreach ($this->config as $keyname => $value)
			Configuration::updateValue(Tools::strtoupper($keyname), $value);
		return true;
	}

	private function removeConfig()
	{
		foreach ($this->config as $keyname)
			Configuration::deleteByName(Tools::strtoupper($keyname));
		return true;
	}

	public function getConfig()
	{
		$config_keys = array_keys($this->config);
		return Configuration::getMultiple($config_keys);
	}

 	public function getContent()
	{
		$output = null;
		if (Tools::isSubmit('submitshmopinterestprofilewidget')) {
 			foreach (Tools::getValue('config') as $key => $value)
				Configuration::updateValue($key, $value);
			if ($this->errors)
				$output .= $this->displayError(implode($this->errors, '<br/>'));
			else
				$output .= $this->displayConfirmation($this->l('Settings updated'));
		}
		$vars = array();
		$vars['config'] = $this->getConfig();
		return $output.$this->displayForm($vars);
	}

	public function displayForm($vars)
	{
		extract($vars);
		$default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
		$pinterest_profile_widget = null;
		$pinterest_profile_widget[0]['form'] = array(
			'legend' => array(
				'title' => $this->l('Settings'),
				'icon' => 'icon-cogs'
			),
			'input' => array(
				array(
					'type' => 'switch',
					'name' => 'config[SHMO_PINTEREST_PROFILE_WIDGET]',
					'label' => $this->l('Enable Profile Widget?'),
					'hint' => $this->l('Add a profile widget to your page to show the most recent Pins you’ve saved.'),
					'is_bool' => true,
					'required' => false,
					'values' => array(
						array(
							'id' => 'profile_widget_on',
							'value' => 1,
							'label' => $this->l('Yes')
						),
						array(
							'id' => 'profile_widget_off',
							'value' => 0,
							'label' => $this->l('No')
						)
					)
				),
				array(
					'type' => 'text',
					'name' => 'config[SHMO_PINTEREST_PROFILE_WIDGET_URL]',
					'label' => $this->l('Profile URL'),
					'hint' => 'e.g. https://www.pinterest.com/anapinskywalker/',
					'required' => false
				),
				array(
					'type' => 'text',
					'name' => 'config[SHMO_PINTEREST_PROFILE_WIDGET_BOARD_WIDTH]',
					'label' => $this->l('Profile width inside the widget.'),
					'hint' => $this->l('This width does not include the white border on either side.'),
					'desc' => 'Minimum width of 130px. Default: Fill width of parent.',
					'suffix' => 'px',
					'required' => false
				),
				array(
					'type' => 'text',
					'name' => 'config[SHMO_PINTEREST_PROFILE_WIDGET_SCALE_HEIGHT]',
					'label' => $this->l('Board height inside the widget.'),
					'hint' => $this->l('This does not include the white border above and below.'),
					'desc' => 'Minimum height of 60px. Default: 175px.',
					'suffix' => 'px',
					'required' => false
				),
				array(
					'type' => 'text',
					'name' => 'config[SHMO_PINTEREST_PROFILE_WIDGET_SCALE_WIDTH]',
					'label' => $this->l('Width of the Pin thumbnails within the widget.'),
					'desc' => 'Minimum width of 60px. Default: 92px.',
					'suffix' => 'px',
					'required' => false
				),
			),
			'submit' => array(
				'title' => $this->l('Save'),
				'class' => 'btn btn-default pull-right'
			)
		);
		$helper = new HelperForm();
		$helper->module = $this;
		$helper->name_controller = $this->name;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
		$helper->default_form_language = $default_lang;
		$helper->allow_employee_form_lang = $default_lang;
		$helper->title = $this->displayName;
		$helper->show_toolbar = true;
		$helper->toolbar_scroll = true;
		$helper->submit_action = 'submit'.$this->name;
		$helper->toolbar_btn = array(
			'save' =>
			array(
				'desc' => $this->l('Save'),
				'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.
				'&token='.Tools::getAdminTokenLite('AdminModules'),
			),
			'back' => array(
				'href' => AdminController::$currentIndex.'&token='.Tools::getAdminTokenLite('AdminModules'),
				'desc' => $this->l('Back to list')
			)
		);
		$helper->fields_value['config[SHMO_PINTEREST_PROFILE_WIDGET]'] = Configuration::get('SHMO_PINTEREST_PROFILE_WIDGET');
		$helper->fields_value['config[SHMO_PINTEREST_PROFILE_WIDGET_URL]'] = Configuration::get('SHMO_PINTEREST_PROFILE_WIDGET_URL');
		$helper->fields_value['config[SHMO_PINTEREST_PROFILE_WIDGET_BOARD_WIDTH]'] = Configuration::get('SHMO_PINTEREST_PROFILE_WIDGET_BOARD_WIDTH');
		$helper->fields_value['config[SHMO_PINTEREST_PROFILE_WIDGET_SCALE_HEIGHT]'] = Configuration::get('SHMO_PINTEREST_PROFILE_WIDGET_SCALE_HEIGHT');
		$helper->fields_value['config[SHMO_PINTEREST_PROFILE_WIDGET_SCALE_WIDTH]'] = Configuration::get('SHMO_PINTEREST_PROFILE_WIDGET_SCALE_WIDTH');

		return $helper->generateForm($pinterest_profile_widget);
	}

	public function hookDisplayLeftColumn()
	{
		$config = $this->getConfig();
		$this->context->smarty->assign(array(
			'shmoPntrstPrflWdgt' => $config
		));
		if (Configuration::get('SHMO_PINTEREST_PROFILE_WIDGET'))
			$this->context->controller->addJS('//assets.pinterest.com/js/pinit.js');
		return $this->display(__FILE__, 'shmopinterestprofilewidget.tpl');
	}

	public function hookDisplayRightColumn()
	{
		return $this->hookDisplayLeftColumn();
	}

	public function hookDisplayTop()
	{
		return $this->hookDisplayLeftColumn();
	}

	public function hookDisplayHome()
	{
		return $this->hookDisplayLeftColumn();
	}

	public function hookDisplayFooter()
	{
		return $this->hookDisplayLeftColumn();
	}

	public function hookBackOfficeHeader()
	{
		$this->context->controller->addJS('/js/jquery/plugins/jquery.validate.js');
		$this->context->controller->addJS(_MODULE_DIR_.$this->name.'/views/js/shmopinterestprofilewidget.js');
	}

}