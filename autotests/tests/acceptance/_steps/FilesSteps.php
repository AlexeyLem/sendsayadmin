<?php
namespace AcceptanceTester;

use \Facebook\WebDriver\Remote\RemoteWebDriver;

class FilesSteps extends \AcceptanceTester
{
	public function goToFilesPage()
	{
		$I = $this;

		$I->waitForElement(\Page::$pageLoaded, 90);
		$I->waitForElementVisible('.navigation_type_primary', 60);
		$I->waitForElementVisible('.header__account', 60);
		$I->waitForElementVisible(\MenuPage::$mailings, 60);
		$I->click(\MenuPage::$mailings);
		$I->waitForElement(\Page::$tableLoaded, 90);
		$I->clickLink(\MenuPage::$mailingsFiles);
		$I->waitForElementNotVisible('.table_issues__primaryData', 60);
		$I->waitForElement(\Page::$pageLoaded, 60);
		$I->waitForElementVisible(\Page::$table, 60);
	}

	/**
	 * @param string $name
	 * @param bool|false $validate
	 */
	public function createDirectory($name, $validate = false)
	{
		$I = $this;

		$I->click(\Page::$buttonCreateDirectory);
		$I->waitForElementVisible(\Page::$modal, 30);
		$I->fillField('name', $name);
		$I->click(\Page::$modalConfirm);
		if (!$validate) {
			$I->waitForElement(\Page::$pageLoaded, 60);
		}
	}

	/**
	 * @param string $name
	 */
	public function delete($name)
	{
		$I = $this;

		$I->click("//tr[td//text()[contains(., '{$name}')]]//button");
		$I->waitForElementVisible('.dropdown_opened', 30);
		$I->click("//tr[td//text()[contains(., '{$name}')]]//div/div/div/div/div");
		$I->waitForElement(\Page::$pageLoaded);
	}

	/**
	 * @param string $filename
	 */
	public function createFile($filename)
	{
		$I = $this;

		$I->attachFile('.button__fileInput', $filename);
		$I->waitForElement(\Page::$pageLoaded, 60);
		$I->wait(2);
	}

	/**
	 * @return string
	 */
	public function generateName()
	{
		$str = '';
		for($i=1; $i <= 257; $i++){
			$str .= rand(1, 9);
		}
		return $str;
	}

}
