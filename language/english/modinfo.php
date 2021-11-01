<?php

declare(strict_types=1);
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * rating module
 *
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 (https://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         rating
 * @since           2.6.0
 * @author          Cointin Maxime (AKA Kraven30)
 */
defined('XOOPS_ROOT_PATH') || exit('Restricted access');

//Info
define('_MI_RATING_NAME', 'Rating');
define('_MI_RATING_DSC', 'Provides rating for modules');

//Admin Menu
define('_MI_RATING_INDEX', 'Home');
define('_MI_RATING_MANAGE', 'Manage Rating');
define('_MI_RATING_ABOUT', 'About');

//Preferences
define('_MI_RATING_PAGER', 'Number of rating to Display on Admin Side');
define('_MI_RATING_PAGERDSC', '');
//0.2
//Help
define('_MI_RATING_DIRNAME', basename(dirname(__DIR__, 2)));
define('_MI_RATING_HELP_HEADER', __DIR__ . '/help/helpheader.tpl');
define('_MI_RATING_BACK_2_ADMIN', 'Back to Administration of ');
define('_MI_RATING_OVERVIEW', 'Overview');

//define('_MI_RATING_HELP_DIR', __DIR__);

//help multi-page
define('_MI_RATING_DISCLAIMER', 'Disclaimer');
define('_MI_RATING_LICENSE', 'License');
define('_MI_RATING_SUPPORT', 'Support');
