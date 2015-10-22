<?php
/**
 * Created by PhpStorm.
 * User: kurilov
 * Date: 22.07.15
 * Time: 15:05
 */

namespace FakeMailSteps;


use AcceptanceTester\CustomSteps;
use Codeception\Module\AcceptanceHelper;

class FakeMailSteps extends \AcceptanceTester
{
	private $_host = 'https://mailinator.com/';

	public function getNewFakeEmail()
	{

		$I = $this;

		$email = 'autotest' . strval(time());
		$I->amOnUrl($this->_host);
		$I->waitForElement(['id' => 'inboxfield'], 60);
		$I->fillField(['id' => 'inboxfield'], $email);
		$I->click('.btn-success');
		$I->waitForText($email . '@mailinator.com', 60);

		return $email;
	}

	/**
	 * @param $email
	 *
	 * @return array
	 */
	public function getPassFromRegisterMail($email)
	{

		$I = $this;
		$custom = new CustomSteps($this->scenario);
		do {
			$I->amOnUrl($this->_host);
			$I->waitForElement(['id' => 'inboxfield', 60]);
			$I->fillField(['id' => 'inboxfield'], $email);
			$I->click('.btn-success');
			$I->wait(5);
		} while ($custom->checkElement("//*[contains(text(), 'данные доступа')]") == false);
		$I->click('#mailcontainer a');
		$I->waitForElement(['name' => 'rendermail'], 60);
		$I->wait(2);
		$I->switchToIFrame('rendermail');
		$text = $I->grabTextFrom("//*[contains(text(), 'Пароль')]");
		preg_match("/Пароль\:\s(.[a-zA-Z0-9]*)/", $text, $match);
		AcceptanceHelper::configSet(['free' => [
				'login' => $email,
				'pass' => $match[1]
			]]
		);
		$I->switchToIFrame();
		$I->click('//*[@id="mailshowdivhead"]/div[2]/div/div[1]/div[2]/div[1]/button[3]');
		$I->wait(1);

		return AcceptanceHelper::configGet();
	}

}
