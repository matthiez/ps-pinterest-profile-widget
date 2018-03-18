<?php

class BackendHelperForm extends HelperForm
{
    public function __construct($name) {
        parent::__construct();

        $default_lang = Configuration::get('PS_LANG_DEFAULT');

        $this->name = $name;

        $this->module = $this;

        $this->name_controller = $this->name;

        $this->token = Tools::getAdminTokenLite('AdminModules');

        $this->currentIndex = AdminController::$currentIndex . '&configure=' . $this->name;

        $this->default_form_language = $default_lang;

        $this->allow_employee_form_lang = $default_lang;

        $this->title = $this->displayName;

        $this->show_toolbar = true;

        $this->toolbar_scroll = true;


        $this->submit_action = 'submit' . $this->name;

        $this->toolbar_btn = [
            'save' =>
                [
                    'desc' => $this->l('Save'),
                    'href' => AdminController::$currentIndex . '&configure=' . $this->name . '&save' . $this->name .
                        '&token=' . Tools::getAdminTokenLite('AdminModules'),
                ],
            'back' => [
                'href' => AdminController::$currentIndex . '&token=' . Tools::getAdminTokenLite('AdminModules'),
                'desc' => $this->l('Back to list')
            ]
        ];
        $this->fields_value['config[PINTEREST_PROFILE_WIDGET]'] = Configuration::get('PINTEREST_PROFILE_WIDGET');

        $this->fields_value['config[PINTEREST_PROFILE_WIDGET_URL]'] = Configuration::get('PINTEREST_PROFILE_WIDGET_URL');

        $this->fields_value['config[PINTEREST_PROFILE_WIDGET_BOARD_WIDTH]'] = Configuration::get('PINTEREST_PROFILE_WIDGET_BOARD_WIDTH');

        $this->fields_value['config[PINTEREST_PROFILE_WIDGET_SCALE_HEIGHT]'] = Configuration::get('PINTEREST_PROFILE_WIDGET_SCALE_HEIGHT');

        $this->fields_value['config[PINTEREST_PROFILE_WIDGET_SCALE_WIDTH]'] = Configuration::get('PINTEREST_PROFILE_WIDGET_SCALE_WIDTH');

        $this->fields_form = [['form' => [
            'legend' => [
                'title' => $this->l('Settings'),
                'icon' => 'icon-cogs'
            ],
            'input' => [
                [
                    'type' => 'switch',
                    'name' => 'config[PINTEREST_PROFILE_WIDGET]',
                    'label' => $this->l('Enable Profile Widget?'),
                    'hint' => $this->l('Add a profile widget to your page to show the most recent Pins you’ve saved.'),
                    'is_bool' => true,
                    'required' => false,
                    'values' => [
                        [
                            'id' => 'profile_widget_on',
                            'value' => 1,
                            'label' => $this->l('Yes')
                        ],
                        [
                            'id' => 'profile_widget_off',
                            'value' => 0,
                            'label' => $this->l('No')
                        ]
                    ]
                ],
                [
                    'type' => 'text',
                    'name' => 'config[PINTEREST_PROFILE_WIDGET_URL]',
                    'label' => $this->l('Profile URL'),
                    'hint' => 'e.g. https://www.pinterest.com/anapinskywalker/',
                    'required' => true
                ],
                [
                    'type' => 'text',
                    'name' => 'config[PINTEREST_PROFILE_WIDGET_BOARD_WIDTH]',
                    'label' => $this->l('Profile width inside the widget.'),
                    'hint' => $this->l('This width does not include the white border on either side.'),
                    'desc' => 'Minimum width of 130px. Default: Fill width of parent.',
                    'suffix' => 'px',
                    'required' => false
                ],
                [
                    'type' => 'text',
                    'name' => 'config[PINTEREST_PROFILE_WIDGET_SCALE_HEIGHT]',
                    'label' => $this->l('Board height inside the widget.'),
                    'hint' => $this->l('This does not include the white border above and below.'),
                    'desc' => 'Minimum height of 60px. Default: 175px.',
                    'suffix' => 'px',
                    'required' => false
                ],
                [
                    'type' => 'text',
                    'name' => 'config[PINTEREST_PROFILE_WIDGET_SCALE_WIDTH]',
                    'label' => $this->l('Width of the Pin thumbnails within the widget.'),
                    'desc' => 'Minimum width of 60px. Default: 92px.',
                    'suffix' => 'px',
                    'required' => false
                ],
            ],
            'submit' => [
                'title' => $this->l('Save'),
                'class' => 'btn btn-default pull-right'
            ]
        ]]];
    }
}