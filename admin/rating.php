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

use Xmf\Module\Admin;
use Xmf\Request;
use XoopsModules\Rating\{
    Helper,
    ModulesHandler
};

//$GLOBALS['xoopsOption']['template_main'] = 'admin/rating.tpl';
require_once __DIR__ . '/admin_header.php';
xoops_load('XoopsPageNav');

global $xoopsTpl;

xoops_cp_header();
$adminObject = Admin::getInstance();
$adminObject->displayNavigation(basename(__FILE__));

$helper = Helper::getInstance();
/** @var ModulesHandler $modulesHandler */
$modulesHandler = $helper->getHandler('Modules');

// Parameters
$nb_rating = $helper->getConfig('rating_pager');

// Get $_GET, $_POST, ...
$op    = Request::getString('op', 'list');
$start = Request::getInt('start', 0);

switch ($op) {
    case 'list':
    default:

        $adminObject->addItemButton(_AM_RATING_ADD, 'rating.php?op=add', 'add');
        $adminObject->displayButton('left', '');

        $rating_count = $modulesHandler->getCount();
        $ratings      = $modulesHandler->getRatingModules($start, $nb_rating, false);

        //
        $xoopsTpl->assign('ratings', $ratings);
        $xoopsTpl->assign('rating_count', $rating_count);

        echo $GLOBALS['xoopsTpl']->fetch($helper->path('/templates/admin/rating.tpl'));

        break;
    // New rating
    case 'add':
        $adminObject->addItemButton(_AM_RATING_LIST, 'rating.php', 'list');
        $adminObject->addItemButton(_AM_RATING_ADD, 'rating.php?op=add', 'add');
        $adminObject->displayButton('left', '');

        // Create form
        $modulesObj = $helper->getHandler('Modules')->create();
        //        $form = $helper->getForm($obj, 'modules');
        /** @var \XoopsThemeForm $form */
        $form = $modulesObj->getForm();
        //        $xoopsTpl->assign('form', $form->render());
        $form->display();
        break;
    // Edit smilie
    case 'edit':
        $adminObject->addItemButton(_AM_RATING_LIST, 'rating.php', 'list');
        $adminObject->displayButton('left', '');
        //        $xoopsTpl->assign('info_msg', $xoops->alert('info', $info_msg, _AM_RATING_ALERT_INFO_TITLE));
        // Create form
        $id         = Request::getInt('id', 0);
        $modulesObj = $helper->getHandler('Modules')->get($id);
        $form       = $modulesObj->getForm();
        /** @var \XoopsThemeForm $form */
        //        $xoopsTpl->assign('form', $form->render());
        $form->display();
        break;
    // Save smilie
    case 'save':
        //        if (!$xoops->security()->check()) {
        //            $xoops->redirect('rating.php', 3, implode('<br>', $xoops->security()->getErrors()));
        //        }
        if (!$GLOBALS['xoopsSecurity']->check()) {
            $helper->redirect('admin/rating.php', 3, $GLOBALS['xoopsSecurity']->getErrors());
        }

        $id = Request::getInt('id', 0);
        if (isset($id) && 0 != $id) {
            $modulesObj = $helper->getHandler('Modules')->get($id);
        } else {
            $modulesObj = $helper->getHandler('Modules')->create();
        }
        $modulesObj->setVar('mid', Request::getInt('mid', 0));
        $modulesObj->setVar('page', Request::getString('page', ''));
        $modulesObj->setVar('title', Request::getString('title', ''));
        $modulesObj->setVar('status', Request::getBool('status', 1));
        $modulesObj->setVar('display', Request::getBool('display', 1));
        $modulesObj->setVar('stars', Request::getInt('stars', 5));

        $error_msg = '';
        if ('' == $error_msg) {
            if ($helper->getHandler('Modules')->insert($modulesObj)) {
                $helper->redirect('admin/rating.php', 2, _AM_RATING_SAVE);
            }
            $error_msg .= $modulesObj->getHtmlErrors();
        }
        $adminObject->addItemButton(_AM_RATING_LIST, 'rating.php', 'list');
        //        $adminObject->displayButton('left', '');
        //        $xoopsTpl->assign('info_msg', $xoops->alert('info', $info_msg, _AM_RATING_ALERT_INFO_TITLE));
        //        $xoopsTpl->assign('error_msg', $xoops->alert('error', $error_msg, _AM_RATING_ALERT_ERROR_TITLE));
        /** @var \XoopsThemeForm $form */
        $form = $modulesObj->getForm();
        //        $xoopsTpl->assign('form', $form->render());
        $form->display();
        break;
    //Del a rating
    case 'del':
        $id         = Request::getInt('id', 0);
        $ok         = Request::getInt('ok', 0);
        $modulesObj = $helper->getHandler('Modules')->get($id);

        if (1 == $ok) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                $helper->redirect('admin/rating.php', 3, $GLOBALS['xoopsSecurity']->getErrors());
            }
            if ($helper->getHandler('Modules')->delete($modulesObj)) {
                $helper->redirect('admin/rating.php', 2, _AM_RATING_DELETED);
            } else {
                echo $GLOBALS['xoopsSecurity']->getErrors();
            }
        } else {
            xoops_confirm(
                [
                    'ok' => 1,
                    'id' => $id,
                    'op' => 'del',
                ],
                XOOPS_URL . '/modules/rating/admin/rating.php',
                sprintf(_AM_RATING_SUREDEL) . '<br>'
            );
        }
        break;
    case 'rating_update_display':
        $id = Request::getInt('id', 0);
        if ($id > 0) {
            $modulesObj = $helper->getHandler('Modules')->get($id);
            $old        = $modulesObj->getVar('display');
            $modulesObj->setVar('display', !$old);
            if ($helper->getHandler('Modules')->insert($modulesObj)) {
                exit;
            }
            echo $modulesObj->getHtmlErrors();
        }
        break;
}

//xoops_cp_footer();
require __DIR__ . '/admin_footer.php';
