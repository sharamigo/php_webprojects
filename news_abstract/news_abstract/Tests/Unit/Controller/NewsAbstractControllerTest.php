<?php
namespace NewsAbstract\NewsAbstract\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class NewsAbstract\NewsAbstract\Controller\NewsAbstractController.
 *
 */
class NewsAbstractControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

	/**
	 * @var \NewsAbstract\NewsAbstract\Controller\NewsAbstractController
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = $this->getMock('NewsAbstract\\NewsAbstract\\Controller\\NewsAbstractController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllNewsAbstractsFromRepositoryAndAssignsThemToView()
	{

		$allNewsAbstracts = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$newsAbstractRepository = $this->getMock('', array('findAll'), array(), '', FALSE);
		$newsAbstractRepository->expects($this->once())->method('findAll')->will($this->returnValue($allNewsAbstracts));
		$this->inject($this->subject, 'newsAbstractRepository', $newsAbstractRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newsAbstracts', $allNewsAbstracts);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenNewsAbstractToView()
	{
		$newsAbstract = new \NewsAbstract\NewsAbstract\Domain\Model\NewsAbstract();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('newsAbstract', $newsAbstract);

		$this->subject->showAction($newsAbstract);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenNewsAbstractToView()
	{
		$newsAbstract = new \NewsAbstract\NewsAbstract\Domain\Model\NewsAbstract();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('newsAbstract', $newsAbstract);

		$this->subject->editAction($newsAbstract);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenNewsAbstractInNewsAbstractRepository()
	{
		$newsAbstract = new \NewsAbstract\NewsAbstract\Domain\Model\NewsAbstract();

		$newsAbstractRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$newsAbstractRepository->expects($this->once())->method('update')->with($newsAbstract);
		$this->inject($this->subject, 'newsAbstractRepository', $newsAbstractRepository);

		$this->subject->updateAction($newsAbstract);
	}
}
