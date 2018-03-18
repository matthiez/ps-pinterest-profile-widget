$(document).ready(function () {
    const BOARD_WIDTH_MIN = 130;
    const SCALE_HEIGHT_MIN = 60;
    const SCALE_WIDTH_MIN = 60;

    $("#configuration_form").validate({
        rules: {
            "config[PINTEREST_PROFILE_WIDGET_BOARD_WIDTH]": {
                min: BOARD_WIDTH_MIN
            },
            "config[PINTEREST_PROFILE_WIDGET_SCALE_HEIGHT]": {
                min: SCALE_HEIGHT_MIN
            },
            "config[PINTEREST_PROFILE_WIDGET_SCALE_WIDTH]": {
                min: SCALE_WIDTH_MIN
            },
            "config[PINTEREST_PROFILE_WIDGET_URL]": {
                required: true
            }
        }
    });
});