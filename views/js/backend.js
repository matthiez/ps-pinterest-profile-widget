/**
 * NOTICE OF LICENSE
 *
 * This file is licenced under the Software License Agreement.
 * With the purchase or the installation of the software in your application
 * you accept the licence agreement.
 *
 * You must not modify, adapt or create derivative works of this source code
 *
 *  @author    André Matthies
 *  @copyright 2018-present André Matthies
 *  @license   LICENSE
 */

$(document).ready(function () {
    const BOARD_WIDTH_MIN = 130;
    const SCALE_HEIGHT_MIN = 60;
    const SCALE_WIDTH_MIN = 60;

    $("#configuration_form").validate({
        rules: {
            "config[EOO_PINTEREST_PROFILE_WIDGET_BOARD_WIDTH]": {
                min: BOARD_WIDTH_MIN
            },
            "config[EOO_PINTEREST_PROFILE_WIDGET_SCALE_HEIGHT]": {
                min: SCALE_HEIGHT_MIN
            },
            "config[EOO_PINTEREST_PROFILE_WIDGET_SCALE_WIDTH]": {
                min: SCALE_WIDTH_MIN
            },
            "config[EOO_PINTEREST_PROFILE_WIDGET_URL]": {
                required: true
            }
        }
    });
});