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
 * @author    André Matthies
 * @copyright 2018-present André Matthies
 * @license   LICENSE
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

class Eoo_PinterestProfileWidget extends Module
{
    protected $errors = array();

    protected $config = array(
        'EOO_PINTEREST_PROFILE_WIDGET' => '1',
        'EOO_PINTEREST_PROFILE_WIDGET_URL' => 'https://www.pinterest.com/anapinskywalker/',
        'EOO_PINTEREST_PROFILE_WIDGET_BOARD_WIDTH' => '',
        'EOO_PINTEREST_PROFILE_WIDGET_SCALE_HEIGHT' => 175,
        'EOO_PINTEREST_PROFILE_WIDGET_SCALE_WIDTH' => 92,
    );

    public function __construct()
    {
        $this->__moduleDir = dirname(__FILE__);
        $this->author = 'Andre Matthies';
        $this->bootstrap = true;
        $this->description = $this->l('Adds a block with Pinterest Profile Widget.');
        $this->displayName = $this->l('Pinterest Profile Widget');
        $this->name = 'eoo_pinterestprofilewidget';
        $this->need_instance = 0;
        $this->tab = 'front_office_features';
        $this->version = '1.0.3';

        parent::__construct();
    }

    public function install()
    {
        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }

        if (!parent::install()) {
            return false;
        }

        foreach ($this->config as $k => $v) {
            Configuration::updateValue($k, $v);
        }

        return $this->registerHook('actionAdminControllerSetMedia')
            && $this->registerHook('actionFrontControllerSetMedia')
            && $this->registerHook('displayFooter');
    }

    public function uninstall()
    {
        parent::uninstall();

        foreach ($this->config as $k) {
            Configuration::deleteByName($k);
        }

        return true;
    }

    public function getContent()
    {
        require_once $this->__moduleDir . '/backendhelperform.php';

        $output = "";

        if (Tools::isSubmit('submit' . $this->name)) {
            foreach (Tools::getValue('config') as $k => $v) {
                Configuration::updateValue($k, $v);
            }

            $output .= $this->errors
                ? $this->displayError(implode($this->errors, '<br>'))
                : $this->displayConfirmation($this->l('Settings updated'));
        }

        return $output . (new BackendHelperForm($this->name))->generate();
    }

    public function hookDisplayFooter()
    {
        $this->context->smarty->assign(Configuration::getMultiple(array_keys($this->config)));

        return $this->display(__FILE__, "$this->name.tpl");
    }

    public function hookDisplayLeftColumn()
    {
        return $this->hookDisplayFooter();
    }

    public function hookDisplayRightColumn()
    {
        return $this->hookDisplayFooter();
    }

    public function hookDisplayTop()
    {
        return $this->hookDisplayFooter();
    }

    public function hookDisplayHome()
    {
        return $this->hookDisplayFooter();
    }

    public function hookActionAdminControllerSetMedia()
    {
        $this->context->controller->addJqueryPlugin('validate');
        $this->context->controller->addJS($this->__moduleDir . '/views/js/backend.js');
    }


    public function hookActionFrontControllerSetMedia()
    {
        if (Configuration::get('EOO_PINTEREST_PROFILE_WIDGET')) {
            $this->context->controller->registerJavascript(
                'eoo-pinterest-pinit',
                "https://assets.pinterest.com/js/pinit_main.js",
                array(
                    'server' => 'remote',
                    'position' => 'bottom',
                    'priority' => 10,
                    'attribute' => 'async defer'
                )
            );
        }
    }
}
