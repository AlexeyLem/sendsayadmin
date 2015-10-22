<?php

$I = new \AcceptanceTester\StatisticsSteps($scenario);
$I->wantTo('Check issue stat header');

$I->goToEmptyIssueStat();

$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();

$I->waitLoadingStatPage();

$I->see('wer', Page::$contentTitle);

$table = 'table';

$I = new \AcceptanceTester\CustomSteps($scenario);
$I->checkDataInFirstTableLine($table, ['ОТПРАВЛЕНО', 'ДОСТАВЛЕНО', 'ОТКРЫТИЙ', 'ПЕРЕХОДОВ']);
$I->checkDataInFirstTableLine($table, ['0', '0', '0', '0']);
$I->checkDataInFirstTableLine($table, ['отписок', 'ошибок', 'уникальных', 'уникальных'], 2);
$I->checkDataInFirstTableLine($table, ['0', '0', '0', '0'], 2);
$I->moveMouseOver('.table_issueInfo', 20, 50);
$I->checkDataInFirstTableLine($table, ['ОТПРАВЛЕНО', 'ДОСТАВЛЕНО', 'ОТКРЫТИЙ', 'ПЕРЕХОДОВ']);
$I->checkDataInFirstTableLine($table, ['0', '0%', '0%', '0%']);
$I->checkDataInFirstTableLine($table, ['отписок', 'ошибок', 'уникальных', 'уникальных'], 2);
$I->checkDataInFirstTableLine($table, ['0%', '0%', '0%', '0%'], 2);
