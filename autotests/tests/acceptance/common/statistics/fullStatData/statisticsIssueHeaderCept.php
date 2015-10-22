<?php

$I = new \AcceptanceTester\StatisticsSteps($scenario);
$custom = new \AcceptanceTester\CustomSteps($scenario);
$I->wantTo('Check issue stat header');

$I->goToFullIssueStat();

$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();

$I->waitLoadingStatPage();

$I->see(StatisticsPage::$fullStatIssueName, Page::$contentTitle);

$table = 'table';

$I = new \AcceptanceTester\CustomSteps($scenario);
$I->checkDataInFirstTableLine($table, ['ОТПРАВЛЕНО', 'ДОСТАВЛЕНО', 'ОТКРЫТИЙ', 'ПЕРЕХОДОВ']);
$I->checkDataInFirstTableLine($table, ['489 706', '489 658', '24 214', '1 623']);
$I->checkDataInFirstTableLine($table, ['отписок', 'ошибок', 'уникальных', 'уникальных'], 2);
$I->checkDataInFirstTableLine($table, ['338', '48', '10 377', '859'], 2);
$I->moveMouseOver('.table_issueInfo', 20, 50);
$I->checkDataInFirstTableLine($table, ['ОТПРАВЛЕНО', 'ДОСТАВЛЕНО', 'ОТКРЫТИЙ', 'ПЕРЕХОДОВ']);
$I->checkDataInFirstTableLine($table, ['489 706', '99,99%', '4,94%', '0,33%']);
$I->checkDataInFirstTableLine($table, ['отписок', 'ошибок', 'уникальных', 'уникальных'], 2);
$I->checkDataInFirstTableLine($table, ['0,07%', '0,01%', '2,12%', '0,18%'], 2);
