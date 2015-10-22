<?php

$I = new \AcceptanceTester\StatisticsSteps($scenario);
$I->wantTo('Check issue chart');
$I->goToStatisticsPage();
$I->goToFirstIssue();
