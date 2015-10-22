<?php
/**
 * Created by PhpStorm.
 * User: anastasya
 * Date: 23.07.15
 * Time: 15:45
 */
use AcceptanceTester\CustomSteps;
use AcceptanceTester\DraftsSteps;
use AcceptanceTester\MailingsSteps;
use AcceptanceTester\StatisticsSteps;
use AcceptanceTester\TrackSteps;

$subject = strval(time());
codecept_debug($subject);

$I = new MailingsSteps($scenario);
$custom = new CustomSteps($scenario);
$I->wantTo('Send single message, delete draft and check Message');

$I->goToCreateMailPage();
$I->fillDraftFields($subject, \MailingsPage::$editAsHtml);
$I->fillHTML();

$I->click(\MailingsPage::$buttonSend);
$I->waitForElement(Page::$pageLoaded, 60);

$I->waitForText('Отправка выпуска', 60, Page::$contentTitle);
$I->see(MailingsPage::$fromEmail);
$I->see(MailingsPage::$fromName);
$I->see($subject);

$I->dontSeeElement(\MailingsPage::$singleMessageInput);
$I->dontSee('Не подтвердившие подписку', "//select//option");
$I->dontSee('Подписка удалена (стоп-лист)', "//select//option");
$I->dontSee('Транзакционные выпуски', "//select//option");
$I->dontSee('Экспресс-Выпуск', "//select//option");

$draft = new DraftsSteps($scenario);
$draft->deleteAutosave($subject);

