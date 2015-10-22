<?php
namespace AcceptanceTester;

class MembersSteps extends \AcceptanceTester
{

	/**
	 * @param $email
	 */
	public function goToMemberPage($email)
	{

		$I = $this;

		$I->click(['link' => $email]);
		$I->waitForElement(['class' => 'button'], 60);
		$I->waitForText('Карточка подписчика ' . $email, 60, \Page::$contentTitle);

	}

}
