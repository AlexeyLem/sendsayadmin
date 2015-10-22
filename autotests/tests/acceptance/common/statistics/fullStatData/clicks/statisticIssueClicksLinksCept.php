<?php
/**
 * Created by PhpStorm.
 * User: nastya
 * Date: 25.06.15
 * Time: 15:51
 */
$I = new \AcceptanceTester\StatisticsSteps($scenario);
$custom = new \AcceptanceTester\CustomSteps($scenario);
$I->wantTo('Check issue full clicks links stat');

$I->goToFullIssueStat();

$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();

$I->waitLoadingStatPage();

$D = new AcceptanceTester($scenario);
$D->clickLink(StatisticsPage::$clickStat);
$D->waitForElement(Page::$pageLoaded, 60);
$D->clickDropdown(StatisticsPage::$clickStat, StatisticsPage::$clickLinksStat);
$I->waitForText(StatisticsPage::$fullStatIssueName, 30, Page::$contentTitle);
$I->waitForText(TitlePage::$clickLinksStatTitle, 30, StatisticsPage::$title);

$link = 'http://www.gudiz.ru/?referer=gd_em240415&utm_source=gd_em&utm_medium=int_emailings&utm_term=gd_em240415&utm_campaign=gd_em240415';
$linkAll = 'http://www.gudiz.ru/catalog/goodies/dom_Tekstil_Skaterti/skatert_podsolnukhi_artikul_54943_150/&referer=gd_em240415&utm_source=gd_em&utm_medium=int_emailings&utm_term=gd_em240415&utm_campaign=gd_em240415';
$email = '215694@mail.ru';
$date = '06.05.2015 14:47:41';
$num = '8';
$table = 'table';


$I->waitForText('Ссылка', 60);
$custom->checkDataInHeadTableLine($table, ['Ссылка', 'Переходов', 'Уникальных переходов']);

//с учетом сортировки
$custom->checkDataInFirstTableLine($table, ['Все ссылки', '1 623', '1 280']);
$I->see('0.33%', 'table tbody tr:nth-child(1) td:nth-child(2) div');
$I->see('0.26%', 'table tbody tr:nth-child(1) td:nth-child(3) div');
$custom->checkDataInFirstTableLine($table, [$link, '280', '192'], 2);
$I->see('0.06%', 'table tbody tr:nth-child(2) td:nth-child(2) div');
$I->see('0.04%', 'table tbody tr:nth-child(2) td:nth-child(3) div');

$I->seeElement(StatisticsPage::$highchartsContainer);

$I->click(['link' => 'Все ссылки']);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText(TitlePage::$clickAllLinksStatTitle, 30, StatisticsPage::$title);
$custom->checkDataInHeadTableLine($table, ['Подписчик', 'Дата перехода', 'Ссылка', 'Всего переходов']);
$custom->checkDataInFirstTableLine($table, ['125377@mail.ru', '27.04.2015 23:44:44', $linkAll, '2']);

$I->click(['link' => '125377@mail.ru']);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText('125377@mail.ru', 60);
$custom->checkDataInHeadTableLine($table, ['Ссылка', 'Дата первого перехода', 'Всего переходов']);
$custom->checkDataInFirstTableLine($table, [$linkAll, '27.04.2015 23:44:44', '3']);

$I->click(['link' => $linkAll]);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForElement("//div[contains(@class,'table__caption')]//span[contains(@title,'$linkAll')]", 60);
$custom->checkDataInHeadTableLine($table, ['Подписчик', 'Дата первого перехода', 'Всего переходов']);
$custom->checkDataInFirstTableLine($table, ['395363@bk.ru', '26.04.2015 08:54:20', '4']);

$I->click(['link' => '395363@bk.ru']);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText('395363@bk.ru', 60);
$custom->checkDataInHeadTableLine($table, ['Ссылка', 'Дата первого перехода', 'Всего переходов']);
//$custom->checkDataInFirstTableLine($table, [$linkAll,'26.04.2015 08:54:20', '4']);

$I->click(['link' => $linkAll]);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForElement("//div[contains(@class,'table__caption')]//span[contains(@title,'$linkAll')]", 60);
$custom->checkDataInHeadTableLine($table, ['Подписчик', 'Дата первого перехода', 'Всего переходов']);
$custom->checkDataInFirstTableLine($table, ['395363@bk.ru', '26.04.2015 08:54:20', '4']);

$D->clickLink(StatisticsPage::$clickStat);
$D->waitForElement(Page::$pageLoaded, 60);
$D->clickDropdown(StatisticsPage::$clickStat, StatisticsPage::$clickLinksStat);
$I->waitForText(TitlePage::$clickLinksStatTitle, 30, StatisticsPage::$title);

$I->click(['link' => $link]);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForElement("//div[contains(@class,'table__caption')]//span[contains(@title,'$link')]", 60);
$custom->checkDataInHeadTableLine($table, ['Подписчик', 'Дата первого перехода', 'Всего переходов']);
$custom->checkDataInFirstTableLine($table, [$email, $date, $num]);

$I->click(['link' => $email]);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText($email, 60);
$custom->checkDataInHeadTableLine($table, ['Ссылка', 'Дата первого перехода', 'Всего переходов']);
//$custom->checkDataInFirstTableLine($table, [$link,$date,$num]);

$I->click(['link' => $link]);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForElement("//div[contains(@class,'table__caption')]//span[contains(@title,'$link')]", 60);
$custom->checkDataInHeadTableLine($table, ['Подписчик', 'Дата первого перехода', 'Всего переходов']);
$custom->checkDataInFirstTableLine($table, [$email, $date, $num]);
