<?php
use Codeception\Module\AcceptanceHelper;

$I = new \AcceptanceTester\GroupsSteps($scenario);
$custom = new \AcceptanceTester\CustomSteps($scenario);
$D = new AcceptanceTester($scenario);
$I->wantTo('Create and delete segment with filter by delivery by issue');

$segmentName = strval(time());
$idIssueCache = AcceptanceHelper::getDataFromMemcache('issue');
$I->createSegment($segmentName);
$I->click(\GroupsPage::$editSeg);
$I->waitForElement(\Page::$pageLoaded, 60);

$I->setSegmentConditionsGroup(
	[
		[
			'type' => 'byIssueDelivery',
			'resp' => '0',
			'issue' => $idIssueCache['id']
		]
	], 'conditions'
);

$D->clickLink('Список подписчиков');
$I->waitForElement(\Page::$pageLoaded, 60);
$I->waitForElementVisible(GroupsPage::$groupDeleteButton, 60);
$I->see(\GroupsPage::$defaultMember, '//tr//td');

$I->click(GroupsPage::$editSeg);
$I->waitForElement(\Page::$pageLoaded, 60);
$I->waitForElementVisible('.select__box', 60);
$D->clickLink('Не была');
$I->click(GroupsPage::$groupCreateButton);
$I->waitForElement(\Page::$pageLoaded, 60);
$I->waitForElementVisible('.select__box', 60);
$D->clickLink('Список подписчиков');
$I->waitForElement(\Page::$pageLoaded, 60);
$custom->dontSeeUsePagination(\GroupsPage::$defaultMember, '//tr//td');

$I->deleteGroupByName($segmentName);

