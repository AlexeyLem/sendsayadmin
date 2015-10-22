<?php
/**
 * Created by PhpStorm.
 * User: nastya
 * Date: 22.07.15
 * Time: 10:50
 */

namespace AcceptanceTester;


class StopListSteps extends \AcceptanceTester
{
	public function goToStopListPage()
	{
		$I = $this;
		$I->click(\MenuPage::$subscribers);
		$I->waitForElement(\Page::$pageLoaded, 60);
		$I->waitForText('Подписчики', 30, \Page::$contentTitle);
		$D = new \AcceptanceTester($this->scenario);
		$D->clickLink(\MenuPage::$stopList);
		$I->waitForElement(\Page::$pageLoaded, 90);
		$I->seeInCurrentUrl(\StopListPage::$URL);
		$I->waitForElement('.table_loaded', 60);
	}
}
