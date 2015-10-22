<?php
/**
 * Created by PhpStorm.
 * User: kurilov
 * Date: 02.06.15
 * Time: 13:28
 */
$member = strval(time()) . "@test.ru";
$I = new \AcceptanceTester\GroupsSteps($scenario);
$custom = new \AcceptanceTester\CustomSteps($scenario);
$D = new AcceptanceTester($scenario);
$I->wantTo('Create and delete group with members');
$listName = strval(time());
$idImport = $I->createListWithMembers($listName, $member);
$I->see('Повторов: 0. Новых: 1.', "//tr[1]//td[last()]");
$I->waitForElementVisible('.button_refresh');
$I->click('.button_refresh');
$I->waitForElement(\Page::$pageLoaded, 60);
$I->see($member);
$idList = $I->grabFromCurrentUrl("/id=(.[a-zA-Z0-9]*)/");

$track = new \AcceptanceTester\TrackSteps($scenario);
$track->goToTrackPage();
$track->checkResult($idImport, 'Выполнено', 'Повторов: 0. Новых: 1.');
$I->goToGroupPage($listName);
$I->waitForText($listName, 30, \Page::$contentTitle);
$D->clickLink('Список подписчиков');
$I->waitForElement(\Page::$pageLoaded, 60);
$I->see($member, 'table tbody tr td a');
$I->dontSeeElement(Page::$paginationPrev);
$I->dontSeeElement(Page::$paginationNext);

$segmentName = strval(time());
$I->createSegment($segmentName);
$I->click(GroupsPage::$editSeg);
$I->waitForElement(\Page::$pageLoaded, 60);
$I->selectOption('add', 'byList');
$D->clickLink('Подходит');
$I->selectOption('list', $idList);
$I->click(GroupsPage::$groupCreateButton);
$I->waitForElement(\Page::$pageLoaded, 60);
$D->clickLink('Список подписчиков');
$I->waitForElement(\Page::$pageLoaded, 60);
$I->see($member);
$I->click(GroupsPage::$editSeg);
$I->waitForElement(\Page::$pageLoaded, 60);
$D->clickLink('Не подходит');
$I->click(GroupsPage::$groupCreateButton);
$I->waitForElement(\Page::$pageLoaded, 60);
$D->clickLink('Список подписчиков');
$I->waitForElement(\Page::$pageLoaded, 60);
$custom->dontSeeUsePagination($member, '//tr//td');
$I->click(GroupsPage::$groupDeleteButton);

$I->deleteGroupByName($listName);
