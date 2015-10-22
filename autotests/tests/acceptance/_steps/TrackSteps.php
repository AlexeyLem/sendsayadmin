<?php
/**
 * Created by PhpStorm.
 * User: nastya
 * Date: 08.07.15
 * Time: 15:45
 */

namespace AcceptanceTester;

class TrackSteps extends \AcceptanceTester
{

	/**
	 * @param $id
	 * @param $text
	 */
	public function seeStatLinkById($id, $text)
	{
		$I = $this;
		$customSteps = new CustomSteps($this->scenario);
		$statisticSteps = new StatisticsSteps($this->scenario);

		for ($i = 0; $i <= 10; $i++) {
			if (!($customSteps->checkTextElement($text, "//tr[td//text()[contains(., $id)]]//a"))) {
				$I->wait(10);
				$statisticSteps->goToStatisticsPage();
				$I->wait(1);
				self::goToTrackPage();
				$I->wait(1);
			} else {
				$i = 11;
			}
		}
		$I->seeElement("//tr[td//text()[contains(., $id)]]//a");
	}

	public function goToTrackPage()
	{
		$I = $this;
		$I->click(\TrackPage::$ring);
		$I->waitForElement(\Page::$pageLoaded, 180);
		$I->waitForText('Журнал заданий', 180, \Page::$contentTitle);
		$I->waitForElementVisible('//table/tbody[3]', 60);
	}

	/**
	 * @param $id
	 * @param $text
	 * @param $trueRes
	 *
	 * @throws \ErrorException
	 */
	public function checkResult($id, $text, $trueRes)
	{
		$I = $this;

		$I->see($text, "//tr[td//text()[contains(., $id)]]");
		$result = $I->grabTextFrom("//tr[td//text()[contains(., $id)]]//td[last()]");
		if ($result != $trueRes) throw new \ErrorException('Получен неверный результат!');
	}
}
