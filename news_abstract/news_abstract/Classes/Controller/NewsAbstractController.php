<?php
namespace NewsAbstract\NewsAbstract\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * NewsAbstractController
 */
class NewsAbstractController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * Initializes the view before invoking an action method.
     * Override this method to solve assign variables common for all actions
     * or prepare the view in another way before the action is called.
     * 
     * @param \TYPO3\CMS\Extbase\Mvc\View\ViewInterface $view The view to be initialized
     * @return void
     */
    protected function initializeView(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface $view)
    {
        $cObjData = $this->configurationManager->getContentObject()->data;
        $view->assign('newsItem', $cObjData);
        //$view->assign('contentObjectData', $this->configurationManager->getContentObject()->data);
        $view->assign('emConfiguration', EmConfiguration::getSettings());
        parent::initializeView($view);
    }
    
    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $newsAbstracts = $this->newsAbstractRepository->findAll();
        $this->view->assign('newsItem', $newsAbstracts);
    }
    
    /**
     * action show
     * 
     * @param \NewsAbstract\NewsAbstract\Domain\Model\NewsAbstract $newsAbstract
     * @return void
     */
    public function showAction(\NewsAbstract\NewsAbstract\Domain\Model\NewsAbstract $newsAbstract)
    {
        var_dump($newsAbstract);
        $this->view->assign('newsItem', $newsAbstract);
    }
    
    /**
     * action edit
     * 
     * @param \NewsAbstract\NewsAbstract\Domain\Model\NewsAbstract $newsAbstract
     * @ignorevalidation $newsAbstract
     * @return void
     */
    public function editAction(\NewsAbstract\NewsAbstract\Domain\Model\NewsAbstract $newsAbstract)
    {
        $this->view->assign('newsItem', $newsAbstract);
    }
    
    /**
     * action update
     * 
     * @param \NewsAbstract\NewsAbstract\Domain\Model\NewsAbstract $newsAbstract
     * @return void
     */
    public function updateAction(\NewsAbstract\NewsAbstract\Domain\Model\NewsAbstract $newsAbstract)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->newsAbstractRepository->update($newsAbstract);
        $this->redirect('list');
    }

}