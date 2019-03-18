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

class BackendHelperForm extends HelperForm
{
    public function __construct($name)
    {
        parent::__construct();

        $default_lang = Configuration::get('PS_LANG_DEFAULT');

        $this->allow_employee_form_lang = $default_lang;

        $this->currentIndex = AdminController::$currentIndex . "&configure=$name";

        $this->default_form_language = $default_lang;

        $this->fields_form = array(array('form' => array(
            'legend' => array(
                'title' => $this->l('Settings'),
                'icon' => 'icon-cogs'
            ),
            'input' => array(
                array(
                    'type' => 'switch',
                    'name' => 'config[EOO_PINTEREST_PROFILE_WIDGET]',
                    'label' => $this->l('Enable Profile Widget?'),
                    'hint' =>
                        $this->l('Add a profile widget to your page to show the most recent Pins you’ve saved.'),
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
                    'name' => 'config[EOO_PINTEREST_PROFILE_WIDGET_URL]',
                    'label' => $this->l('Profile URL'),
                    'hint' => 'e.g. https://www.pinterest.com/anapinskywalker/',
                    'required' => true
                ),
                array(
                    'type' => 'text',
                    'name' => 'config[EOO_PINTEREST_PROFILE_WIDGET_BOARD_WIDTH]',
                    'label' => $this->l('Profile width inside the widget.'),
                    'hint' => $this->l('This width does not include the white border on either side.'),
                    'desc' => 'Minimum width of 130px. Default: Fill width of parent.',
                    'suffix' => 'px',
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'name' => 'config[EOO_PINTEREST_PROFILE_WIDGET_SCALE_HEIGHT]',
                    'label' => $this->l('Board height inside the widget.'),
                    'hint' => $this->l('This does not include the white border above and below.'),
                    'desc' => 'Minimum height of 60px. Default: 175px.',
                    'suffix' => 'px',
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'name' => 'config[EOO_PINTEREST_PROFILE_WIDGET_SCALE_WIDTH]',
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
        )));

        $this->fields_value['config[EOO_PINTEREST_PROFILE_WIDGET]']
            = Configuration::get('EOO_PINTEREST_PROFILE_WIDGET');

        $this->fields_value['config[EOO_PINTEREST_PROFILE_WIDGET_URL]']
            = Configuration::get('EOO_PINTEREST_PROFILE_WIDGET_URL');

        $this->fields_value['config[EOO_PINTEREST_PROFILE_WIDGET_BOARD_WIDTH]']
            = Configuration::get('EOO_PINTEREST_PROFILE_WIDGET_BOARD_WIDTH');

        $this->fields_value['config[EOO_PINTEREST_PROFILE_WIDGET_SCALE_HEIGHT]']
            = Configuration::get('EOO_PINTEREST_PROFILE_WIDGET_SCALE_HEIGHT');

        $this->fields_value['config[EOO_PINTEREST_PROFILE_WIDGET_SCALE_WIDTH]']
            = Configuration::get('EOO_PINTEREST_PROFILE_WIDGET_SCALE_WIDTH');

        $this->name = $name;

        $this->name_controller = $name;

        $this->module = $this;

        $this->show_toolbar = true;

        $this->submit_action = 'submit' . $name;

        $this->title = $name;

        $this->token = Tools::getAdminTokenLite('AdminModules');

        $this->toolbar_btn = array(
            'save' =>
                array(
                    'desc' => $this->l('Save'),
                    'href' => AdminController::$currentIndex . '&configure=' . $name . '&save' . $name .
                        '&token=' . Tools::getAdminTokenLite('AdminModules'),
                ),
            'back' => array(
                'href' => AdminController::$currentIndex . '&token=' . Tools::getAdminTokenLite('AdminModules'),
                'desc' => $this->l('Back to list')
            )
        );

        $this->toolbar_scroll = true;
    }
}
