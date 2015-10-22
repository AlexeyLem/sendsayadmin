<?php
namespace AcceptanceTester;

use FakeMailSteps\FakeMailSteps;

class AccountSteps extends \AcceptanceTester
{
	public function goToRatesPageForPaid()
	{
		$this->goToAccountPage();
		$acceptance = new \AcceptanceTester($this->scenario);
		$acceptance->clickLink(\MenuPage::$accountRates);
		$this->waitForElement(\Page::$tableLoaded, 180);
		$this->waitForElementVisible('.button_color_yellow', 180);
		$this->wait(2);
	}
	public function goToRatesPage()
	{
		$this->goToAccountPage();
		$acceptance = new \AcceptanceTester($this->scenario);
		$acceptance->clickLink(\MenuPage::$accountRates);
		$this->waitForElement(\Page::$tableLoaded, 180);
		$this->waitForElementVisible(\AccountPage::$showRates, 180);
		$this->wait(2);
	}

	public function goToAccountPage()
	{
		$this->waitForElementVisible(\MenuPage::$account, 60);
		$this->click(\MenuPage::$account);
		$this->waitForElementVisible('.navigation_vertical', 30);
		$this->wait(1);
	}

	public function goToPayPage()
	{
		$this->goToAccountPage();
		$this->click(\MenuPage::$accountPay);
		$this->waitForElement('body.loaded', 60);
		$this->waitForText('Оплата', 60, \Page::$accontTitle);
	}

	/**
	 * @return mixed
	 */
	public function getSubscibersCountFromRatesPage()
	{
		$temp = $this->grabTextFrom(\AccountPage::$subscribersInfo);
		return preg_split("/\D+/", $temp)[0];
	}

	/**
	 * @return mixed
	 */
	public function getSubscibersLimitFromRatesPage()
	{
		$temp = $this->grabTextFrom(\AccountPage::$subscribersInfo);
		return preg_split("/\D+/", $temp)[1];
	}

	/**
	 * @return mixed
	 */
	public function getLettersCountFromRatesPage()
	{
		$temp = $this->grabTextFrom(\AccountPage::$lettersInfo);
		return preg_split("/\D+/", $temp)[0];
	}

	/**
	 * @return mixed
	 */
	public function getLettersLimitFromRatesPage()
	{
		$temp = $this->grabTextFrom(\AccountPage::$lettersInfo);
		return preg_split("/\D+/", $temp)[1];
	}

	/**
	 * @return mixed
	 */
	public function getSubscribersCountFromTitleOnRatesPage()
	{
		$temp = $this->grabTextFrom('.content__title b');
		return preg_split("/\D+/", $temp)[0];
	}

	public function getNewFakeAcount()
	{

		$fakeMail = new FakeMailSteps($this->scenario);

		$email = $fakeMail->getNewFakeEmail() . '@mailinator.com';
		$this->newRegister($email);
		$fakeMail->getPassFromRegisterMail($email);


	}

	/**
	 * @param $email
	 */
	public function newRegister($email)
	{

		$I = $this;

		$I->amOnUrl('http://localhost:8080/signup');
		$I->waitForElement(['name' => 'email'], 30);
		$I->fillField(['name' => 'email'], $email);
		$I->click('.button_signup');
		$I->waitForText('Аккаунт создан', 120);
	}

}
