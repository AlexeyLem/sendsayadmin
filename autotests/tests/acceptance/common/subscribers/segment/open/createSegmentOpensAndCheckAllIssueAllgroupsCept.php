<?php

$I = new \AcceptanceTester\GroupsSteps($scenario);
$custom = new \AcceptanceTester\CustomSteps($scenario);
$D = new AcceptanceTester($scenario);
$I->wantTo('Create and delete segment with filter by opens by all issue and all groups');

$segmentName = strval(time());
$I->createSegment($segmentName);
$I->click(\GroupsPage::$editSeg);
$I->waitForElement(\Page::$pageLoaded, 60);

$I->setSegmentConditionsGroup(
	[
		[
			'type' => 'byIssueOpens',
			'resp' => '0',
			'issue' => 'По всем выпускам',
			'list' => 'По всем спискам'
		]
	], 'conditions'
);

$D->clickLink('Список подписчиков');
$I->waitForElement(\Page::$pageLoaded, 60);
$I->waitForElementVisible(GroupsPage::$groupDeleteButton, 60);
$custom->findElemUsePagination(\GroupsPage::$defaultMember, '//tr//td');

$I->click(\GroupsPage::$editSeg);
$I->waitForElement(\Page::$pageLoaded, 60);
$I->waitForElementVisible('.select__box', 60);
$D->clickLink('Не были');
$I->click(\GroupsPage::$groupCreateButton);
$I->waitForElement(\Page::$pageLoaded, 60);
$I->waitForElementVisible('.select__box', 60);
$D->clickLink('Список подписчиков');
$I->waitForElement(\Page::$pageLoaded, 60);
$custom->dontSeeUsePagination(\GroupsPage::$defaultMember, '//tr//td');

$I->deleteGroupByName($segmentName);
