<?php
/**
 * Created by PhpStorm.
 * User: kurilov
 * Date: 28.05.15
 * Time: 12:41
 */

$I = new \AcceptanceTester\MailingsSteps($scenario);
$custom = new \AcceptanceTester\CustomSteps($scenario);
$I->wantTo('Create and Delete draft');
$subject = strval(time());
$I->goToCreateMailPage();
$I->fillDraftFields($subject, \MailingsPage::$editAsHtml);
$I->fillHTML();
//КАСТЫЛЬ
$I->wait(2);
$I->click(MailingsPage::$buttonSave);
$I->waitForText('Изменения успешно сохранены', 30);
$I->click(MailingsPage::$buttonBack);
$I->waitForElement(Page::$pageLoaded, 60);
$I->click(MailingsPage::$saveAsDraft);
//////

$I->waitForText('Все', 60);
$I->waitForElement(Page::$tableLoaded, 60);
$custom->findElemUsePaginationAndClick($subject, "//tr//td[2]");
$I->waitForElement(MailingsPage::$fieldName, 60);
$I->seeInFormFields('.form_createIssue', [
        'name' => MailingsPage::$fromName,
        'email' => MailingsPage::$fromEmail,
        'subject' => $subject
    ]
);

$I->click(MailingsPage::$goToSend);
$I->waitForElement(Page::$pageLoaded, 60);
$I->click(MailingsPage::$buttonPreview);
$I->waitForText('Предпросмотр выпуска', 60, Page::$contentTitle);
$I->waitForElementVisible('.draftPreview_type_desktop', 60);
$I->switchToIFrame('desktop');
$I->switchToIFrame();
$I->switchToIFrame('mobile');
$I->switchToIFrame();

$I->waitForElementVisible(['class' => 'button_redoToEdit'], 30);
$I->seeElement(['class' => 'button_redoToEdit']);
$I->click(['class' => 'button_redoToEdit']);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForElementVisible(MailingsPage::$buttonBack, 60);
$I->click(MailingsPage::$buttonBack);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForElementVisible(MailingsPage::$draftDelete, 60);
$I->click(MailingsPage::$draftDelete);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForElement(Page::$tableLoaded, 90);
$I->waitForText('Все', 60);
$I->selectOption('type', 'drafts');
$I->waitForElement(Page::$tableLoaded, 90);
$I->dontSee($subject);
