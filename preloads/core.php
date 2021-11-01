<?php
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
class RatingCorePreload extends \XoopsPreloadItem
{
    public static function eventCoreIncludeCommonEnd($args)
    {
        $path = dirname(__DIR__);
        //        XoopsLoad::addMap(array(
        //            'rating' => $path . '/class/helper.php',
        //        ));

        // to add PSR-4 autoloader
        require_once __DIR__ . '/autoloader.php';
    }

    public static function eventCoreIndexStart($args)
    {
        // check once per user session if expired poll email has been sent
        //        if (empty($_SESSION['pollChecked'])) {
        //            $pollHandler = xoops_getModuleHandler('poll', 'xoopspoll');
        //            $pollHandler->mailResults();  //send the results of any polls that have ended
        //            unset($pollHandler);
        //            $_SESSION['pollChecked'] = 1;
        //        }
    }

    public static function eventCoreHeaderAddmeta($args)
    {
        $path = dirname(__DIR__);
        //        $helper = Helper::getInstance();;
        $GLOBALS['xoTheme']->addStylesheet('/modules/rating/assets/css/jRating.jquery.css');
        $GLOBALS['xoTheme']->addScript('browse.php?Frameworks/jquery/jquery.js');
        $GLOBALS['xoTheme']->addScript('/modules/rating/assets/js/jRating.jquery.js');
    }
}
