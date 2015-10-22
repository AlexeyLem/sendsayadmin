<?php

$I = new \AcceptanceTester\StatisticsSteps($scenario);
$I->wantTo('Check issues list');
$I->goToStatisticsPage();
$text = $I->grabTextFrom('table tbody tr:nth-child(1) td:nth-child(1) div:nth-child(2) span:nth-child(2)');
preg_match("/Отправлено\s(.*)/", $text, $date);
$I->validateDate($date[1], 'd.m.Y H:i');