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
if (!defined('XOOPS_ROOT_PATH') || !is_object($GLOBALS['xoopsModule'])) {
    exit();
}

require dirname(__DIR__) . '/preloads/autoloader.php';

function rating($pageId = 0, $pageName = '')
{
    $helper = \XoopsModules\Rating\Helper::getInstance();
    $helper->loadLanguage('main');

    $GLOBALS['xoTheme']->addStylesheet('/modules/rating/assets/css/jRating.jquery.css');
    $GLOBALS['xoTheme']->addScript('browse.php?Frameworks/jquery/jquery.js');
    $GLOBALS['xoTheme']->addScript('/modules/rating/assets/js/jRating.jquery.js');

    if (is_numeric($pageId)) {
        $moduleId = $GLOBALS['xoopsModule']->getVar('mid');

        $script_name = explode('/', $_SERVER['SCRIPT_NAME']);
        $pageName    = end($script_name);

        $modulesHandler = $helper->getHandler('Modules');
        $ratings        = $modulesHandler->getRatingDisplay($pageId, $pageName, $moduleId);
    }
    $script = '(function($){
                    $(document).ready(function(){';
    foreach ($ratings as $rating) {
        $script .= '$(".rating-' . $rating['id'] . '").jRating({
                        url: "' . XOOPS_URL . '",
                        length : ' . $rating['stars'] . ',
                        rateMax : ' . $rating['stars'] . ',
                        pageId : ' . $rating['pageId'] . ',
                        isDisabled : ' . $rating['hasVoted'] . '
                    });';
    }
    $script .= '    });
               })(jQuery)';
    $GLOBALS['xoTheme']->addScript('', ['type' => 'text/javascript'], $script);

    return $ratings;
}
