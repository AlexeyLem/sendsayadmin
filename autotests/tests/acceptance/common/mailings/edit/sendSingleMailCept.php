<?php
/**
 * Created by PhpStorm.
 * User: kurilov
 * Date: 26.05.15
 * Time: 9:39
 */
use AcceptanceTester\CustomSteps;
use AcceptanceTester\DraftsSteps;
use AcceptanceTester\MailingsSteps;
use AcceptanceTester\StatisticsSteps;
use AcceptanceTester\TrackSteps;
use Codeception\Module\AcceptanceHelper;


$subject = '[% anketa.member.email %]';
codecept_debug($subject);

$I = new MailingsSteps($scenario);
$track = new TrackSteps($scenario);
$custom = new CustomSteps($scenario);
$I->wantTo('Send single message, delete draft and check Message');

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
$I->click(\MailingsPage::$goToSend);
$I->waitForText('Все', 90);

$id = $custom->checkNotification('Выпуск поставлен в очередь отправки'); //получаем id выпуска
$I->click(\TrackPage::$ring);
$I->wait(120);
/**
 * Получение почты
 */
//Соединяемся с гуглом
$message = new MailTester($scenario);
// Ищем письмо в течение минуты и возвращаем тело письма в виде строки, иначе ошибка
$body = $message->getBodyBySubject(\MailingsPage::$_email);
//Выведем сообщение в консоль при дебаге
codecept_debug($body);
//Получаем массив всех урлов в письме(в том числе из src)
$urls = $message->getUrls($body);
//Помечаем все письма как удаленные
$message->markAllMessagesAsDelete();
//Закрываем соединение
$message->closeConnection();
//2 перехода
codecept_debug(file_get_contents($urls[0]));
codecept_debug(file_get_contents($urls[0]));
//2 открытия
codecept_debug(file_get_contents($urls[2]));
codecept_debug(file_get_contents($urls[2]));

$I = new StatisticsSteps($scenario);
$track->seeStatLinkById($id, "Посмотреть статистику");
$I->click(['link' => 'Посмотреть статистику']);
$I->waitForText($subject, 60, Page::$contentTitle);
//Infinity повторяется если Доставки = 0
codecept_debug('Пишем в мемкэш ID рассылки');
codecept_debug('ID: ' . $I->grabFromCurrentUrl("/id=(.[a-zA-Z0-9]*)/"));
AcceptanceHelper::configSet(['issue' => [
        'id' => $I->grabFromCurrentUrl("/id=(.[a-zA-Z0-9]*)/")
    ]
    ]
);
codecept_debug(AcceptanceHelper::getDataFromMemcache('issue'));
$I->dontSee('Infinity%', "//div[4]/div[2]/div[1]/span[1]");

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
