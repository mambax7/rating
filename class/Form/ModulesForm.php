<?php

namespace XoopsModules\Rating\Form;

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

use XoopsModules\Rating\Helper;

/**
 *
 */
class ModulesForm extends \XoopsThemeForm
{
    /**
     * @param \XoopsObject $obj
     */
    public function __construct($obj)
    {
        $helper = Helper::getInstance();

        $title = $obj->isNew() ? sprintf(_AM_RATING_ADD) : sprintf(_AM_RATING_EDIT);
        $stars = $obj->isNew() ? 5 : $obj->getVar('stars');

        //        parent::__construct($title, 'form', $xoops->getEnv('SCRIPT_NAME'), 'post', true);
        parent::__construct($title, 'form', \xoops_getenv('SCRIPT_NAME'), 'post', true);
        $modules = new \XoopsFormSelect(_AM_RATING_MODULES, 'mid', $obj->getVar('mid'));

        //        $modules_array = \XoopsLists::getModulesList();
        //        $modulesHandler = $helper->getHandler('Modules');
        //        $criteria      = new \CriteriaCompo(new \Criteria('hasmain', 1));
        //        $criteria->add(new \Criteria('isactive', 1));
        //        $options = $modulesHandler->getNameList($criteria);
        //        $modules->addOptionArray($options);

        /** @var XoopsModuleHandler $moduleHandler */
        $moduleHandler = xoops_getHandler('module');
        $criteria      = new \CriteriaCompo(new \Criteria('hasmain', 1));
        $criteria->add(new \Criteria('isactive', 1));
        $moduleList = $moduleHandler->getList($criteria);
        //        $moduleList[-1] = _AM_SYSTEM_BLOCKS_TOPPAGE;
        //        $moduleList[0]  = _AM_SYSTEM_BLOCKS_ALLPAGES;
        asort($moduleList);
        $modules->addOptionArray($moduleList);

        $this->addElement($modules, true);
        $this->addElement(new \XoopsFormText(_AM_RATING_PAGE, 'page', 50, 100, $obj->getVar('page'), '', '', '', true), true);
        $this->addElement(new \XoopsFormText(_AM_RATING_TITLE, 'title', 50, 100, $obj->getVar('title'), '', '', '', true), false);
        $this->addElement(new \XoopsFormText(_AM_RATING_NBSTARS, 'stars', 1, 50, $stars, '', '', '', true), true);

        $this->addElement(new \XoopsFormHidden('id', $obj->getVar('id')));

        /**
         * Buttons
         */
        $buttonTray = new \XoopsFormElementTray('', '');
        $buttonTray->addElement(new \XoopsFormHidden('op', 'save'));

        $cancelButton = new \XoopsFormButton('', 'cancel', \_CANCEL, 'cancel');
        $cancelButton->setExtra('onclick="history.go(-1)"');
        $cancelButton->setClass('btn btn-cancel');
        $buttonTray->addElement($cancelButton);

        $resetButton = new \XoopsFormButton('', 'reset', _RESET, 'reset');
        $resetButton->setClass('btn btn-warning');
        $buttonTray->addElement($resetButton);

        $submitButton = new \XoopsFormButton('', 'submit', _SUBMIT, 'submit');
        $submitButton->setClass('btn btn-success');
        $buttonTray->addElement($submitButton);

        $this->addElement($buttonTray);
    }
}
