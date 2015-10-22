<?php
/**
 * Created by PhpStorm.
 * User: nastya
 * Date: 25.06.15
 * Time: 17:25
 */
$I = new \AcceptanceTester\StatisticsSteps($scenario);
$custom = new \AcceptanceTester\CustomSteps($scenario);
$I->wantTo('Check issue full clicks subscribers stat');

$I->goToFullIssueStat();

$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();

$I->waitLoadingStatPage();

$link = 'http://www.gudiz.ru/catalog/goodies/dom_Spalnya_Podushka/podushka_komfort_vo_vremya_kormleniya_banana/&referer=gd_em240415&utm_source=gd_em&utm_medium=int_emailings&utm_term=gd_em240415&utm_campaign=gd_em240415';
$email = '696101@hotmail.com';
$date = '28.04.2015 03:15:12';
$num = '21';

$D = new AcceptanceTester($scenario);
$D->clickLink(StatisticsPage::$clickStat);
$D->waitForElement(Page::$pageLoaded, 60);
$D->clickDropdown(StatisticsPage::$clickStat, StatisticsPage::$clickSubscribersStat);
$I->waitForText(StatisticsPage::$fullStatIssueName, 30, Page::$contentTitle);
$I->waitForText(TitlePage::$clickSubscribersStatTitle, 60, StatisticsPage::$title);

$table = 'table';
$custom->checkDataInHeadTableLine($table, ['Подписчик', 'Дата первого перехода', 'Всего переходов']);
$custom->checkDataInFirstTableLine($table, [$email, $date, $num]);

$I->click(['link' => $email]);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText($email, 60);
$custom->checkDataInHeadTableLine($table, ['Ссылка', 'Дата первого перехода', 'Всего переходов']);
$custom->checkDataInFirstTableLine($table, [$link, $date, $num]);

$I->click(['link' => $link]);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForElement("//div[contains(@class,'table__caption')]//span[contains(@title,'$link')]", 60);
$custom->checkDataInHeadTableLine($table, ['Подписчик', 'Дата первого перехода', 'Всего переходов']);
$custom->checkDataInFirstTableLine($table, [$email, $date, $num]);

$I->click(['link' => $email]);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText($email, 60);
$custom->checkDataInHeadTableLine($table, ['Ссылка', 'Дата первого перехода', 'Всего переходов']);
$custom->checkDataInFirstTableLine($table, [$link, $date, $num]);
