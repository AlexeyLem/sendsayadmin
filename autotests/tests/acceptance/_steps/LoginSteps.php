<?php
namespace AcceptanceTester;

use Facebook\WebDriver\Exception\ExpectedException;

class LoginSteps extends \AcceptanceTester
{
	public function Login()
	{

		$I = $this;
		$custom = new CustomSteps($this->scenario);

		$I->wantTo('log in as regular user');
		$I->resetCookie('session');
		$I->reloadPage();
		$I->amOnPage(\LoginPage::$URL);
		$I->waitForElement(\Page::$pageLoaded, 60);
		$I->wait(1);
		if ($custom->checkElement(\LoginPage::$loginInput) == true) {
			$I->waitForElement(\LoginPage::$loginInput, 60);
			$I->fillField(\LoginPage::$loginInput, getenv('LOGIN'));
			$I->fillField(\LoginPage::$passwordInput, getenv('PASS'));
			$I->click(\LoginPage::$submitButton);
			try {
				$I->waitForElement(\MenuPage::$account, 120);
			} catch (\Exception $e) {
				ExpectedException::throwException('2', 'Не смогли залогиниться', $e);
			}
		}
	}

	public function loginAfterResetCookie()
	{
		$I = $this;

		$I->waitForElement(\LoginPage::$loginInput, 120);
		$I->fillField(\LoginPage::$loginInput, getenv('LOGIN'));
		$I->fillField(\LoginPage::$passwordInput, getenv('PASS'));
		$I->click(\LoginPage::$submitButton);
		try {
			$I->waitForElement(\MenuPage::$account, 120);
		} catch (\Exception $e) {
			ExpectedException::throwException('2', 'Не смогли залогиниться', $e);
		}
	}

	public function logout()
	{
		$I = $this;

		$I->click(\MenuPage::$account);
		$I->click(\MenuPage::$logout);
		$I->waitForElement(\LoginPage::$loginInput, 60);
	}

	public function checkEmptyLoginForm()
	{

		$I = $this;

		$I->wantTo('Check empty login form');
		$I->amOnPage(\LoginPage::$URL);
		$I->waitForText('Нет аккаунта?', 60);
		$I->seeInTitle('Sendsay');
		$I->see('Зарегистрируйтесь');
		$I->seeElement(\LoginPage::$registerLink);
		//Тычем на кнопку Войти с незаполненными полями, проверяем, что форма показала ошибки
		$I->click(\LoginPage::$submitButton);
		$I->see('Обязательное поле', \LoginPage::$loginError);
		$I->see('Обязательное поле', \LoginPage::$passwordError);
		$I->seeElement(\LoginPage::$loginInput, ['class' => 'invalid']);
		$I->seeElement(\LoginPage::$passwordInput, ['class' => 'invalid']);
		$I->seeInCurrentUrl('login');
	}

	public function checkFormErrors()
	{

		$I = $this;

		$I->wantTo('check form validate');
		$I->amOnPage(\LoginPage::$URL);
		$I->waitForElement(\LoginPage::$loginInput, 60);
		//Заполняем поле логин, сабмитим, проверяем, что получили ошибку на поле пароля
		$I->fillField(\LoginPage::$loginInput, getenv('LOGIN'));
		$I->click(\LoginPage::$submitButton);
		$I->see('Обязательное поле', \LoginPage::$passwordError);
		$I->seeElement(\LoginPage::$passwordInput, ['class' => 'invalid']);
		//Очищаем поле логина, запролняем пароль, проверяем ошибку поля логин
		$I->fillField(\LoginPage::$loginInput, '');
		$I->fillField(\LoginPage::$passwordInput, getenv('PASS'));
		$I->click(\LoginPage::$submitButton);
		$I->seeElement(\LoginPage::$loginInput, ['class' => 'invalid']);
		$I->see('Обязательное поле', \LoginPage::$loginError);
	}

	public function checkTogglePassInput()
	{

		$I = $this;

		$I->wantTo('Check toggle input type pass to text');
		$I->amOnPage(\LoginPage::$URL);
		$I->waitForText('Нет аккаунта?', 60);
		$I->seeElement('input', ['type' => 'password', 'name' => 'password', 'placeholder' => 'Пароль']);
		$I->dontSeeElement('input', ['type' => 'text', 'name' => 'password', 'placeholder' => 'Пароль']);
		$I->fillField(\LoginPage::$passwordInput, 'qweasdzxc');
		$I->dontSee('qweasdzxc');
		$I->see('Показать');
		$I->click(\LoginPage::$showPass);
		$I->seeElement('input', ['type' => 'text', 'name' => 'password', 'placeholder' => 'Пароль']);
		$I->dontSeeElement('input', ['type' => 'password', 'name' => 'password', 'placeholder' => 'Пароль']);
		$I->see('Скрыть');
		$I->click(\LoginPage::$hidePass);
		$I->dontSee('qweasdzxc');
	}
}
