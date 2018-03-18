<?php if (!defined('_PS_VERSION_')) exit;

class PinterestProfileWidget extends Module
{
    protected $errors = [];

    protected $config = [
        'PINTEREST_PROFILE_WIDGET' => '',
        'PINTEREST_PROFILE_WIDGET_URL' => '',
        'PINTEREST_PROFILE_WIDGET_BOARD_WIDTH' => '',
        'PINTEREST_PROFILE_WIDGET_SCALE_HEIGHT' => 175,
        'PINTEREST_PROFILE_WIDGET_SCALE_WIDTH' => 92,
    ];

    public function __construct() {
        $this->name = 'pinterestprofilewidget';
        $this->tab = 'front_office_features';
        $this->version = '1.0.2';
        $this->author = 'Andre Matthies';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Pinterest Profile Widget');
        $this->description = $this->l('Adds a block with Pinterest Profile Widget.');

        $this->__moduleDir = dirname(__FILE__);
    }

    public function install() {
        if (Shop::isFeatureActive()) Shop::setContext(Shop::CONTEXT_ALL);
        parent::install();
        foreach ($this->config as $k => $v) Configuration::updateValue($k, $v);
        $this->registerHook('hookActionAdminControllerSetMedia');
        $this->registerHook('displayFooter');
    }

    public function uninstall() {
        parent::uninstall();
        foreach ($this->config as $k) Configuration::deleteByName($k);
    }

    public function getContent() {
        require_once $this->__moduleDir . '/backendhelperform.php';
        $output = null;
        if (Tools::isSubmit('submit' . $this->name)) {
            foreach (Tools::getValue('config') as $k => $v) Configuration::updateValue($k, $v);
            if ($this->errors) $output .= $this->displayError(implode($this->errors, '<br/>'));
            else $output .= $this->displayConfirmation($this->l('Settings updated'));
        }
        return $output . (new BackendHelperForm($this->name))->generate();
    }

    public function hookDisplayFooter() {
        $this->context->smarty->assign(Configuration::getMultiple(array_keys($this->config)));
        if (Configuration::get('PINTEREST_PROFILE_WIDGET')) $this->context->controller->addJS('//assets.pinterest.com/js/pinit.js');
        return $this->display(__FILE__, $this->name . '.tpl');
    }

    public function hookDisplayLeftColumn() {
        return $this->hookDisplayFooter();
    }

    public function hookDisplayRightColumn() {
        return $this->hookDisplayFooter();
    }

    public function hookDisplayTop() {
        return $this->hookDisplayFooter();
    }

    public function hookDisplayHome() {
        return $this->hookDisplayFooter();
    }

    public function hookActionAdminControllerSetMedia() {
        $this->context->controller->addJqueryPlugin('validate');
        $this->context->controller->addJS($this->__moduleDir . '/views/js/backend.js');
    }
}