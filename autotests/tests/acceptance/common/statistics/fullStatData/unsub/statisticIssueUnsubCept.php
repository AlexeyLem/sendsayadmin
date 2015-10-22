<?php
/**
 * Created by PhpStorm.
 * User: nastya
 * Date: 29.06.15
 * Time: 15:35
 */
$I = new \AcceptanceTester\StatisticsSteps($scenario);
$custom = new \AcceptanceTester\CustomSteps($scenario);
$I->wantTo('Check issue full unsub stat');

$I->goToFullIssueStat();

$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();

$I->waitLoadingStatPage();

$D = new AcceptanceTester($scenario);
$D->clickLink(StatisticsPage::$unsubStat);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText(StatisticsPage::$fullStatIssueName, 30, Page::$contentTitle);
$I->waitForText(TitlePage::$unsubStatTitle, 30, StatisticsPage::$title);

$table = 'table';
$custom->checkDataInHeadTableLine($table, ['Способ отписки', 'Количество']);

$I->seeElement(StatisticsPage::$highchartsContainer);

$custom->checkDataInFirstTableLine($table, ['Все отписки', '346']);
$I->see('0.07%', 'table tbody tr:nth-child(1) td:nth-child(2) div');
$custom->checkDataInFirstTableLine($table, ['Из письма по ссылке "Отписаться"', '170'], 2);
$I->see('0.03%', 'table tbody tr:nth-child(2) td:nth-child(2) div');
$custom->checkDataInFirstTableLine($table, ['Нажатие кнопки "Это спам" в почтовой системе/программе', '167'], 3);
$I->see('0.03%', 'table tbody tr:nth-child(3) td:nth-child(2) div');
$custom->checkDataInFirstTableLine($table, ['Нажатие "Отписаться" в почтовой системе/программе', '9'], 4);
$I->see('0.00%', 'table tbody tr:nth-child(4) td:nth-child(2) div');

$I->click(['link' => 'Все отписки']);
$I->waitForText(TitlePage::$unsubAllStatTitle, 60, StatisticsPage::$title);
$custom->checkDataInHeadTableLine($table, ['Подписчик', 'Способ отписки']);
$custom->checkDataInFirstTableLine($table, ['412406@mail.ru', 'Из письма по ссылке "Отписаться"']);

$D->clickLink(StatisticsPage::$unsubStat);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText(TitlePage::$unsubStatTitle, 30, StatisticsPage::$title);
$I->click(['link' => 'Из письма по ссылке "Отписаться"']);
$I->waitForText(TitlePage::$unsubLinkMailStatTitle, 60, StatisticsPage::$title);
$I->see('Подписчик', 'table thead tr th');
$I->see('412406@mail.ru', 'table tbody tr:nth-child(1) td');

$D->clickLink(StatisticsPage::$unsubStat);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText(TitlePage::$unsubStatTitle, 30, StatisticsPage::$title);
$I->click(['link' => 'Нажатие кнопки "Это спам" в почтовой системе/программе']);
$I->waitForText(TitlePage::$unsubSpamStatTitle, 60, StatisticsPage::$title);
$I->see('Подписчик', 'table thead tr th');
$I->see('228930@mail.ru', 'table tbody tr:nth-child(1) td');

$D->clickLink(StatisticsPage::$unsubStat);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText(TitlePage::$unsubStatTitle, 30, StatisticsPage::$title);
$I->click(['link' => 'Нажатие "Отписаться" в почтовой системе/программе']);
$I->waitForText(TitlePage::$unsubButtonStatTitle, 60, StatisticsPage::$title);
$I->see('Подписчик', 'table thead tr th');
$I->see('545301@yandex.ru', 'table tbody tr:nth-child(1) td');
