{*
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
*}

{if $EOO_PINTEREST_PROFILE_WIDGET and is_string($EOO_PINTEREST_PROFILE_WIDGET_URL)}
    <div id='eoo-pinterest-profile-widget'>
        <a data-pin-do='embedUser'
           {if is_numeric($EOO_PINTEREST_PROFILE_WIDGET_BOARD_WIDTH)}
               data-pin-board-width='{$EOO_PINTEREST_PROFILE_WIDGET_BOARD_WIDTH|escape:'htmlall':'utf-8'}'
           {/if}

           {if is_numeric($EOO_PINTEREST_PROFILE_WIDGET_SCALE_HEIGHT)}
               data-pin-scale-height='{$EOO_PINTEREST_PROFILE_WIDGET_SCALE_HEIGHT|escape:'htmlall':'utf-8'}'
           {/if}

           {if is_numeric($EOO_PINTEREST_PROFILE_WIDGET_SCALE_WIDTH)}
               data-pin-scale-width='{$EOO_PINTEREST_PROFILE_WIDGET_SCALE_WIDTH|escape:'htmlall':'utf-8'}'
           {/if}

           href='{$EOO_PINTEREST_PROFILE_WIDGET_URL|escape:'htmlall':'utf-8'}'
        >
        </a>
    </div>
{/if}