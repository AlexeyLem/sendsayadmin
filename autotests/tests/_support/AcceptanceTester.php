<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = null)
 *
 * @SuppressWarnings(PHPMD)
 */
class AcceptanceTester extends \Codeception\Actor
{
	use _generated\AcceptanceTesterActions;

	public function clickLink($text)
	{
		if (is_array($text)) {
			$text = $text['link'];
		}
		$I = new \AcceptanceTester($this->scenario);
		$I->click('//*[contains(text(), "' . $text . '")]');
	}

	public function clickDropdown($title, $text)
	{
		if (is_array($text)) {
			$text = $text['link'];
		}
		if (is_array($title)) {
			$title = $title['link'];
		}
		$I = new \AcceptanceTester($this->scenario);
		$I->waitForElement(Page::$pageLoaded, 60);
		$I->click("//div[contains(@class,'dropdown__toggle')][contains(text(), '$title')]");
		$I->waitForElement("//div[contains(@class, 'dropdown_opened')]", 30);
		$I->waitForElementVisible("//div[contains(@class,'navigation_vertical')]/a[contains(text(),'$text')]", 30);
		$I->click("//div[contains(@class,'navigation_vertical')]/a[contains(text(),'$text')]");
		$I->waitForElement(Page::$pageLoaded, 60);
	}
	/**
	 * Define custom actions here
	 */
}
