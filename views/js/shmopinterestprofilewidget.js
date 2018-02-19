/**
 * NOTICE OF LICENSE
 *
 * This file is licenced under the Software License Agreement.
 * With the purchase or the installation of the software in your application
 * you accept the licence agreement.
 *
 * You must not modify, adapt or create derivative works of this source code
 *
 *  @author    Andre Matthies
 *  @copyright 2016 Andre Matthies
 *  @license   license.txt
 */

$(function () {
    $("#configuration_form").validate({
        rules: {
            "config[SHMO_PINTEREST_PROFILE_WIDGET_BOARD_WIDTH]": {
                required: false,
                range: [130, 2000]
            },
            "config[SHMO_PINTEREST_PROFILE_WIDGET_SCALE_HEIGHT]": {
                required: false,
                range: [60, 4000]
            },
            "config[SHMO_PINTEREST_PROFILE_WIDGET_SCALE_WIDTH]": {
                required: false,
                range: [60, 2000]
            },
            "config[SHMO_PINTEREST_PROFILE_WIDGET_URL]": {
                required: true
            }
        },
        messages: {
            "config[SHMO_PINTEREST_PROFILE_WIDGET_BOARD_WIDTH]": {
                required: "Widget board width: Values between 130 and 2000."
            },
            "config[SHMO_PINTEREST_PROFILE_WIDGET_SCALE_HEIGHT]": {
                required: "Widget scale height: Values between 60 and 4000."
            },
            "config[SHMO_PINTEREST_PROFILE_WIDGET_SCALE_WIDTH]": {
                required: "Widget scale width: Values between 60 and 2000."
            },
            "config[SHMO_PINTEREST_PROFILE_WIDGET_URL]": {
                required: "Board widget URL: You must enter an URL."
            }
        }
    });
});