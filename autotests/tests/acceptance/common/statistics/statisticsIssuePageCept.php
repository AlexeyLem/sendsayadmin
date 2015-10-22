<?php

$I = new \AcceptanceTester\StatisticsSteps($scenario);
$I->wantTo('Check issue page');
$I->goToStatisticsPage();
$I->goToFirstIssue();
$I->waitForElement(Page::$contentTitle, 60);
