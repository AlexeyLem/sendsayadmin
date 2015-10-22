<?php
namespace AcceptanceTester;

class MailingsSteps extends \AcceptanceTester
{

    /**
     * @param $subject
     * @param $editAs
     */
    public function fillDraftFields($subject, $editAs)
    {

        $I = $this;
        $D = new \AcceptanceTester($this->scenario);

        $I->fillField(\MailingsPage::$fieldName, \MailingsPage::$fromName);
        $I->fillField(\MailingsPage::$fieldEmail, \MailingsPage::$fromEmail);
        $I->fillField(\MailingsPage::$fieldSubject, $subject);
        $D->clickLink($editAs);
        $I->click(\MailingsPage::$goToSend);
        $I->waitForElement(\Page::$pageLoaded, 30);
    }

    public function fillHTML()
    {
        $I = $this;

        $I->waitForElement(\Page::$pageLoaded, 30);
        $I->waitForElement(\MailingsPage::$aceEditor, 30);
        $I->waitForElementVisible('.htmlEditorPreview__content', 60);
        $I->fillField(\MailingsPage::$aceEditor, \MailingsPage::$messageTextWithUrls);
    }

    public function checkEmptyFields()
    {

        $I = $this;

        self::goToCreateMailPage();
        $I->waitForElement(\MailingsPage::$goToSend, 60);
        $I->dontSeeElement(['class' => 'invalid']);
        $I->click(\MailingsPage::$goToSend);
        $I->seeElement(\MailingsPage::$fieldNameInvalid);
        $I->seeElement(\MailingsPage::$fieldEmailInvalid);
        $I->seeElementInDOM(\MailingsPage::$fieldSubjectInvalid);

        $I->fillField(\MailingsPage::$fieldName, 'FromName');
        $I->click(\MailingsPage::$goToSend);
        $I->seeElement(\MailingsPage::$fieldEmailInvalid);
        $I->seeElementInDOM(\MailingsPage::$fieldSubjectInvalid);

        $I->fillField(\MailingsPage::$fieldName, 'FromName');
        $I->fillField(\MailingsPage::$fieldEmail, 'autotest@test.ru');
        $I->click(\MailingsPage::$goToSend);
        $I->seeElementInDOM(\MailingsPage::$fieldSubjectInvalid);

        //Визуальная пустота
        $I->fillField(\MailingsPage::$fieldName, \Page::$visualEmpty);
        $I->fillField(\MailingsPage::$fieldEmail, \Page::$visualEmpty);
        $I->fillField(\MailingsPage::$fieldSubject, \Page::$visualEmpty);
        $I->click(\MailingsPage::$goToSend);
        $I->seeElement(\MailingsPage::$fieldNameInvalid);
        $I->seeElement(\MailingsPage::$fieldEmailInvalid);
        $I->seeElementInDOM(\MailingsPage::$fieldSubjectInvalid);
    }

    public function goToCreateMailPage()
    {

        $I = $this;

        $I->waitForElement(\Page::$pageLoaded, 60);
        $I->click(\MenuPage::$mailings);
        $I->waitForElement(\Page::$tableLoaded, 90);
        $I->waitForElement(\MailingsPage::$createMail, 120);
        $I->wait(1);
        $I->click(\MailingsPage::$createMail);
        $I->waitForElement(\Page::$pageLoaded, 60);
        $I->waitForText('Создание выпуска', 120);
    }

    public function checkWrongEmail()
    {

        $I = $this;

        self::goToCreateMailPage();
        $I->waitForElement(\MailingsPage::$goToSend, 60);
        foreach (\MailingsPage::$wrongEmails as $key => $email) {
            $I->fillField(\MailingsPage::$fieldEmail, $email);
            $I->click(\MailingsPage::$goToSend);
            $I->seeElement(\MailingsPage::$fieldEmailInvalid);
        }
    }

    public function goToSendPage()
    {
        $I = $this;

		$I->waitForElement(\MailingsPage::$goToSend, 60);
		$I->click(\MailingsPage::$goToSend);
		$I->waitForElement(\Page::$pageLoaded, 60);
		$I->click(\MailingsPage::$buttonSend);
		$I->waitForElement(\Page::$pageLoaded, 60);
	}
}
