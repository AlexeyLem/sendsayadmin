<?php

class LoginCest
{
	/**
	 * @group common
	 */
	public function checkFormErrors(\AcceptanceTester $I, $scenario)
	{
		$I = new AcceptanceTester\LoginSteps($scenario);
		$I->checkFormErrors();
	}

	/**
	 * @group common
	 */
	public function checkEmptyLoginForm(\AcceptanceTester $I, $scenario)
	{
		$I = new AcceptanceTester\LoginSteps($scenario);
		$I->checkEmptyLoginForm();
	}

	/**
	 * @group common
	 */
	public function checkTogglePassInput(\AcceptanceTester $I, $scenario)
	{
		$I = new AcceptanceTester\LoginSteps($scenario);
		$I->checkTogglePassInput();
	}

	/**
	 * @group individual
	 * @group common
	 * @group individual
	 * @group test
	 * @group blockEditor
	 */
	public function login(\AcceptanceTester $I, $scenario)
	{
		$I = new AcceptanceTester\LoginSteps($scenario);
		$I->Login();
	}

}
