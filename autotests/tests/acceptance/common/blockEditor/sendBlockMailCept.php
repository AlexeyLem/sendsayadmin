<?php
/**
 * Created by PhpStorm.
 * User: anastasya
 * Date: 18.08.15
 * Time: 16:49
 */
use AcceptanceTester\CustomSteps;
use AcceptanceTester\DraftsSteps;
use AcceptanceTester\MailingsSteps;
use AcceptanceTester\BlockEditorSteps;
use AcceptanceTester\StatisticsSteps;
use AcceptanceTester\TrackSteps;

$subject = strval(time());
codecept_debug($subject);

$I = new MailingsSteps($scenario);
$track = new TrackSteps($scenario);
$custom = new CustomSteps($scenario);
$I->wantTo('Send message creating in block editor, delete draft and check Message');

$I->amOnPage('/mailings/mailing/edit');
$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();
$I->fillDraftFields($subject, \MailingsPage::$editAsBlocks);

$I->waitForElement('.templateEditorBlocks', 30);
$I->waitForElement('.templateEditorWorkspace', 30);
$I->waitForElementVisible('tr:nth-child(2)[class=templateEditorWorkspaceBlock] img', 30);

$I->seeElement('.button_save.button_disabled');
$I->seeNumberOfElements('.templateEditorWorkspaceBlock', 19);

$I = new BlockEditorSteps($scenario);

$I->deleteAllBlocks();
$I->addAllBlocks();

$I->click(\MailingsPage::$buttonSend);
$I->waitForElement(Page::$pageLoaded, 60);

$I->waitForText('Отправка выпуска', 90, Page::$contentTitle);
$I->see(MailingsPage::$fromEmail);
$I->see(MailingsPage::$fromName);
$I->see($subject);

$I->selectOption('group', 'emailTesterDontDelete');
$I->click(\MailingsPage::$goToSend);
$I->waitForText('Все', 90);

$id = $custom->checkNotification('Выпуск поставлен в очередь отправки'); //получаем id выпуска
$I->click(\TrackPage::$ring);
$I->waitForElement(Page::$pageLoaded, 120);
/**
 * Получение почты
 */
//Соединяемся с гуглом
$message = new MailTester($scenario);
// Ищем письмо в течение минуты и возвращаем тело письма в виде строки, иначе ошибка
$body = $message->getBodyBySubject($subject);
//Выведем сообщение в консоль при дебаге
codecept_debug($body);
//Получаем массив всех урлов в письме(в том числе из src)
$urls = $message->getUrls($body);
//Помечаем все письма как удаленные
$message->markAllMessagesAsDelete();
//Закрываем соединение
$message->closeConnection();
//2 открытия
codecept_debug(file_get_contents($urls[count($urls)-1]));
codecept_debug(file_get_contents($urls[count($urls)-1]));

$I = new StatisticsSteps($scenario);
$track->seeStatLinkById($id, "Посмотреть статистику");
$I->click(['link' => 'Посмотреть статистику']);
$I->waitForText($subject, 60, Page::$contentTitle);

$D = new AcceptanceTester($scenario);
$D->clickLink(StatisticsPage::$deliveryStat);
$D->waitForElement(Page::$pageLoaded, 60);
$D->clickDropdown(StatisticsPage::$deliveryStat, StatisticsPage::$deliverySubscribersStat);
$I->waitForText($subject, 30, Page::$contentTitle);
$I->waitForText(TitlePage::$deliverySubscribersStatTitle, 30, StatisticsPage::$title);

$custom->checkDataInFirstTableLine('table', [MailingsPage::$_email, '', '-']);

$draft = new DraftsSteps($scenario);
$draft->deleteAutosave($subject);

$D->clickLink(MenuPage::$review);
$I->waitForElement(Page::$pageLoaded, 90);
$I->waitForElement('.widget_row', 90);
$I->seeElement('.lastIssue');
$I->see($subject, '.lastIssue');
$I->seeElement('//div/a[contains(text(),"Посмотреть статистику")]');
