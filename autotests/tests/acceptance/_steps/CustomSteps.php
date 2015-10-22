<?php
namespace AcceptanceTester;

use Codeception\Module\AcceptanceHelper;
use Facebook\WebDriver\Exception\ExpectedException;

class CustomSteps extends \AcceptanceTester
{
	/**
	 * @param $text
	 * @param $locator
	 *
	 * @throws \ErrorException
	 */
	public function findElemUsePaginationAndClick($text, $locator)
	{
		$I = $this;
		if ($I->checkTextElement($text, $locator)) {
			$I->click(['link' => $text]);
		} else {
			do {
				if ($I->checkElement(\Page::$paginationNext)) {
					$I->click(\Page::$paginationNext);
				} else throw new \ErrorException('Элемент не найден!');
			} while (!($I->checkTextElement($text, $locator)));
			$I->click(['link' => $text]);
		}
	}

	/**
	 * @param $data
	 * @param $locator
	 *
	 * @return bool
	 */
	public function checkTextElement($data, $locator)
	{
		$I = $this;

		try {
			$I->see($data, $locator);
			return true;
		} catch (\Exception $e) {
			return false;
		}
	}

	/**
	 * @param $locator
	 *
	 * @return bool
	 */
	public function checkElement($locator)
	{
		$I = $this;

		try {
			$I->seeElement($locator);
			return true;
		} catch (\Exception $e) {
			return false;
		}
	}

	/**
	 * @param $text
	 * @param $locator
	 *
	 * @throws \ErrorException
	 */
	public function findElemUsePagination($text, $locator)
	{
		$I = $this;
		$I->waitForElement(\Page::$pageLoaded, 60);
		if (!($I->checkTextElement($text, $locator))) {
			do {
				if ($I->checkElement(\Page::$paginationNext)) {
					$I->click(\Page::$paginationNext);
				} else throw new \ErrorException('Элемент не найден!');
			} while ($I->checkTextElement($text, $locator) === false);
		}
	}

	/**
	 * @param $text
	 * @param $locator
	 */
	public function dontSeeUsePagination($text, $locator)
	{
		$I = $this;
		if ($I->checkElement(\Page::$paginationNext)) {
			do {
				$I->dontSee($text, $locator);
				$I->click(\Page::$paginationNext);
				$I->waitForElement(\Page::$pageLoaded, 60);
			} while ($I->checkElement(\Page::$paginationNext));
		} else {
			$I->dontSee($text, $locator);
		}

	}

	public function paginationCheck()
	{
		$I = $this;

		$I->seeElement(\Page::$paginationNext);
		$I->dontSeeElement(\Page::$paginationPrev);

		do {
			$I->click(\Page::$paginationNext);
			$I->waitForElement(\Page::$pageLoaded, 60);
		} while ($I->checkElement(\Page::$paginationNext));

		$I->seeElement(\Page::$paginationPrev);
		$I->dontSeeElement(\Page::$paginationNext);

		do {
			$I->click(\Page::$paginationPrev);
			$I->waitForElement(\Page::$pageLoaded, 60);
		} while ($I->checkElement(\Page::$paginationPrev));

		$I->seeElement(\Page::$paginationNext);
		$I->dontSeeElement(\Page::$paginationPrev);

	}

	public function checkPaginationButton()
	{
		$I = $this;

		$I->seeElement(\Page::$paginationNext);
		$I->dontSeeElement(\Page::$paginationPrev);
		$I->click(\Page::$paginationNext);
		$I->waitForElement(\Page::$pageLoaded, 60);
		$I->seeElement(\Page::$paginationNext);
		$I->seeElement(\Page::$paginationPrev);
		$I->click(\Page::$paginationPrev);
		$I->waitForElement(\Page::$pageLoaded, 60);
		$I->seeElement(\Page::$paginationNext);
		$I->dontSeeElement(\Page::$paginationPrev);
	}

	public function paginationEnd()
	{
		$I = $this;

		$I->seeElement(\Page::$paginationNext);
		$I->dontSeeElement(\Page::$paginationPrev);

		do {
			$I->click(\Page::$paginationNext);
			$I->waitForElement(\Page::$pageLoaded, 60);
		} while ($I->checkElement(\Page::$paginationNext));

		$I->seeElement(\Page::$paginationPrev);
		$I->dontSeeElement(\Page::$paginationNext);
	}

	/**
	 * @param $locator
	 * Локатор для таблицы
	 * $locator = 'div.content__section.clearfix div.col-5-6 > table';
	 * @param $array
	 * Массив данных из первой строки в таблице(без процентов)
	 * $data = [20.01.2015 11:05:24, 10, 15]
	 */
	public function checkDataInFirstTableLine($locator, $array, $strNum = 1)
	{

		$I = $this;

		foreach ($array as $key => $data) {
			$key++;
			$I->see($data, $locator . " tbody tr:nth-child({$strNum}) td:nth-child({$key})");
		}

	}

	/**
	 * @param $locator
	 * @param $array
	 */
	public function checkDataInHeadTableLine($locator, $array)
	{

		$I = $this;

		foreach ($array as $key => $data) {
			$key++;
			$I->see($data, $locator . " thead tr th:nth-child({$key})");
		}

	}

	/**
	 * @param $locator
	 * @param $array
	 * @param int $cellNum
	 */
	public function checkDataInLinesTable($locator, $array, $cellNum = 1)
	{

		$I = $this;

		foreach ($array as $key => $data) {
			$key++;
			$I->see($data, $locator . " tbody tr:nth-child({$key}) td:nth-child($cellNum)");
		}

	}

	/**
	 * @param $text
	 *
	 * @return mixed
	 */
	public function checkNotification($text)
	{
		$I = $this;
		$I->waitForElementVisible(\Page::$notificationButton, 10);
		$I->waitForText($text, 10);
		$I->see('Открыть журнал заданий', \Page::$notificationButton);
		$I->wait(1);
		$id = AcceptanceHelper::parseIdFromNotification($I->grabTextFrom(\Page::$notificationText));
		return $id;
	}

	/**
	 * @param $url
	 */
	public function getStatArchive($url)
	{
		$I = $this;
		$I->url = $url;

		$test = $I->haveFriend('Test');
		$test->does(function (\AcceptanceTester $I) {
			$I->amOnUrl(\Page::$testSendsayAccountUrl);
			$I->maximizeWindow();
			$I->fillField(\LoginPage::$loginInput, getenv('LOGIN'));
			$I->fillField(\LoginPage::$passwordInput, getenv('PASS'));
			$I->click('div.login-modal__submit.js-login-submit');
			$I->waitForElementVisible(['class' => 'menu'], 60);
			$I->amOnUrl(\Page::$testSendsayUrl . $I->url);
			try {
				$I->waitForElementVisible(['class' => 'menu'], 120);
			} catch (\Exception $e) {
				ExpectedException::throwException('2', 'Не смогли залогиниться', $e);
			}
		}
		);
	}
}
