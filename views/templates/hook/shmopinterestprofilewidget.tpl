{*
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
*}

{if $shmoPntrstPrflWdgt.SHMO_PINTEREST_PROFILE_WIDGET}
<div id="pinterest-profile-widget">
	<a
	data-pin-do="embedUser"
	data-pin-board-width="{$shmoPntrstPrflWdgt.SHMO_PINTEREST_PROFILE_WIDGET_BOARD_WIDTH|data:'html':'UTF-8'}"
	data-pin-scale-height="{$shmoPntrstPrflWdgt.SHMO_PINTEREST_PROFILE_WIDGET_SCALE_HEIGHT|data:'html':'UTF-8'}"
	data-pin-scale-width="{$shmoPntrstPrflWdgt.SHMO_PINTEREST_PROFILE_WIDGET_SCALE_WIDTH|data:'html':'UTF-8'}"
	href="{$shmoPntrstPrflWdgt.SHMO_PINTEREST_PROFILE_WIDGET_URL|data:'html':'UTF-8'}"
	>
	</a>
</div>
{/if}