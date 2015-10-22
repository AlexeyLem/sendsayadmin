<?php
/**
 * Created by PhpStorm.
 * User: anastasya
 * Date: 19.08.15
 * Time: 14:46
 */

use AcceptanceTester\MailingsSteps;
use AcceptanceTester\DelayedSteps;
use AcceptanceTester\DraftsSteps;
use AcceptanceTester\CustomSteps;
use AcceptanceTester\TrackSteps;

$subject = strval(time());
codecept_debug($subject);

$I = new MailingsSteps($scenario);
$track = new TrackSteps($scenario);
$custom = new CustomSteps($scenario);
$I->wantTo('Delay message and delete draft');

$I->goToCreateMailPage();
$I->fillDraftFields($subject, \MailingsPage::$editAsHtml);
$I->fillHTML();

$I->click(\MailingsPage::$buttonSend);
$I->waitForElement(Page::$pageLoaded, 60);

$I->waitForText('Отправка выпуска', 90, Page::$contentTitle);
$I->see(MailingsPage::$fromEmail);
$I->see(MailingsPage::$fromName);
$I->see($subject);

$I->dontSeeElement(\MailingsPage::$singleMessageInput);
$I->selectOption('group', 'emailTesterDontDelete');

$I->click(MailingsPage::$datePicker);
$I->waitForElement(StatisticsPage::$dateApply, 60);
//подготовка времени
date_default_timezone_set('Europe/Samara');
codecept_debug($date = date('d.m.Y H'));
codecept_debug($hour = date('H'));
codecept_debug($nextDate = date('d.m.Y H', mktime(date("H") + 1)));
codecept_debug($nextHour = date('H', mktime(date("H") + 1)));
date_default_timezone_set('Europe/Moscow');
//выбираем дату
$I->selectOption('hour', $hour);
$I->see('Применить', StatisticsPage::$dateApply);
$I->click(StatisticsPage::$dateApply);
$I->see($date, '.datePicker__date');

$I->click(\MailingsPage::$goToSend);
$I->waitForText('Все', 90);
$I->waitForElement(\Page::$tableLoaded, 90);
$custom->checkNotification('Выпуск успешно запланирован');
$custom->findElemUsePagination($subject, "//tr//td[2]");

//меняем дату
$I->waitForElementVisible("//tr[td//text()[contains(., '$subject')]]//*[contains(@class,'dropdown_datePicker')]//button[contains(@type,'submit')]", 30);
$I->click("//tr[td//text()[contains(., '$subject')]]//*[contains(@class,'dropdown_datePicker')]//button[contains(@type,'submit')]");
$I->waitForElementVisible("//tr[td//text()[contains(., '$subject')]]//*[contains(@class,'applyBtn')]", 60);
$I->selectOption('hour', $nextHour);
$I->see('Применить', "//tr[td//text()[contains(., '$subject')]]//*[contains(@class,'applyBtn')]");
$I->click("//tr[td//text()[contains(., '$subject')]]//*[contains(@class,'applyBtn')]");
$I->waitForElement(\Page::$tableLoaded, 90);
$I->see($nextDate, "//tr[td//text()[contains(., '$subject')]]//span");

//проверяем в модальном окне закрытие по кнопке 'Отменить'
$I = new DelayedSteps($scenario);
$I->deleteDelayedIssue($subject, true);
//удаляем отложенный выпуск
$I->deleteDelayedIssue($subject);
$draft = new DraftsSteps($scenario);
$draft->deleteAutosave($subject);
