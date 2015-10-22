<?php
/**
 * Created by PhpStorm.
 * User: kurilov
 * Date: 22.07.15
 * Time: 18:44
 */

use AcceptanceTester\CustomSteps;
use AcceptanceTester\MailingsSteps;
use Codeception\Module\AcceptanceHelper;

$I = new AcceptanceTester($scenario);
$mail = new MailingsSteps($scenario);
$custom = new CustomSteps($scenario);

//Создаем список
$I = new \AcceptanceTester\GroupsSteps($scenario);
$custom = new \AcceptanceTester\CustomSteps($scenario);
$I->wantTo('Send Message on grop list');
$groupName = strval(time());
$I->createListWithMembers($groupName, AcceptanceHelper::configGet()['login']);
$I->see('Повторов: 0. Новых: 1.', "//tr[1]//td[last()]");

$I->click(MenuPage::$mailings);
$I->waitForElement('.icon_mailingDraft', 90);
$I->click(['link' => 'Редактировать']);
$mail->goToSendPage();
$I->waitForElement('//select', 30);
$I->selectOption('//select[@name="group"]', "$groupName");
$I->click(MailingsPage::$goToSend);
$I->waitForElement(Page::$pageLoaded, 60);
