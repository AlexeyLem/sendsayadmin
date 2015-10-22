<?php
/**
 * Created by PhpStorm.
 * User: nastya
 * Date: 21.07.15
 * Time: 18:22
 */
$email = strval(time()) . "@test.ru";
$I = new \AcceptanceTester\StopListSteps($scenario);
$member = new \AcceptanceTester\MembersSteps($scenario);
$group = new \AcceptanceTester\GroupsSteps($scenario);
$I->wantTo('Check stop-list page');
$groupName = strval(time());

$group->createListWithMembers($groupName, $email);
$I->waitForElementVisible('.button_refresh', 30);
$I->click('.button_refresh');
$I->waitForElement(Page::$pageLoaded, 60);
$D = new AcceptanceTester($scenario);
$D->clickLink('Список подписчиков');
$I->waitForElement(Page::$pageLoaded, 60);
$I->see($email);
$member->goToMemberPage($email);
$I->click(\Page::$meatball);
$I->waitForElement(StopListPage::$addToStopList, 30);
$I->click(StopListPage::$addToStopList);
$I->waitForElement(Page::$pageLoaded, 60);
$I->see('Недоступен, так как добавлен в стоп-лист', 'div:nth-child(2) span:nth-child(4)');
$I->goToStopListPage();
$I->see($email, 'table tbody tr td');

$group->goToGroupPage($groupName);
$D->clickLink('Список подписчиков');
$I->waitForElement(Page::$pageLoaded, 60);
$member->goToMemberPage($email);
$I->waitForElement(StopListPage::$deleteFromStopList, 10);
$I->click(StopListPage::$deleteFromStopList);
$I->waitForText('Доступен для рассылки', 10, 'div:nth-child(2) span:nth-child(4)');
$I->goToStopListPage();
$I->dontSee($email, 'table tbody tr td');
$group->deleteGroupByName($groupName);
