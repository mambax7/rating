<?php

declare(strict_types=1);

namespace XoopsModules\Rating;

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

/**
 *
 */
class Modules extends \XoopsObject
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->initVar('id', \XOBJ_DTYPE_INT, null, false);
        $this->initVar('mid', \XOBJ_DTYPE_INT, null, false);
        $this->initVar('page', \XOBJ_DTYPE_OTHER, null, false, 255);
        $this->initVar('default', \XOBJ_DTYPE_INT, null, false);
        $this->initVar('title', \XOBJ_DTYPE_OTHER, null, false, 255);
        $this->initVar('status', \XOBJ_DTYPE_INT, 1, false);
        $this->initVar('display', \XOBJ_DTYPE_INT, 1, false);
        $this->initVar('stars', \XOBJ_DTYPE_INT, null, false);
    }

    /**
     * @param $keys
     * @param $format
     * @param $maxDepth
     * @return array
     */
    public function getValues($keys = null, $format = null, $maxDepth = null)
    {
        $helper        = Helper::getInstance();
        $moduleHandler = \xoops_getHandler('module');
        $ret           = parent::getValues($keys, $format, $maxDepth);
        $module        = $moduleHandler->get($this->getVar('mid'));
        $ret['module'] = $module->getVar('name');
        $delete        = (1 == $this->getVar('default')) ? false : true;
        $ret['delete'] = $delete;

        return $ret;
    }

    /**
     * @return \XoopsModules\Rating\Form\ModulesForm
     */
    public function getForm()
    {
        $form = new Form\ModulesForm($this);
        return $form;
    }
}
