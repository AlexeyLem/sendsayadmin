<?php

$I = new \AcceptanceTester\StatisticsSteps($scenario);
$I->wantTo('Check issue deliv all errors stat');

$I->goToFullIssueStat();

$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();

$I->waitLoadingStatPage();

$D = new AcceptanceTester($scenario);
$D->clickLink(StatisticsPage::$deliveryStat);
$D->waitForElement(Page::$pageLoaded, 60);
$D->clickDropdown(StatisticsPage::$deliveryStat, StatisticsPage::$deliveryErrorsStat);
$I->waitForText(StatisticsPage::$fullStatIssueName, 30, Page::$contentTitle);
$I->waitForText(TitlePage::$deliveryErrorsStatTitle, 30, StatisticsPage::$title);

$I->waitForText('Наименование ошибки', 60);

$I->click(['link' => 'Не доставлено за 4 дня']);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText(TitlePage::$delivery4dayErrorsStatTitle, 60, StatisticsPage::$title);
$I->waitForText('Подписчик', 60, 'table thead tr th');
$I->see('@t-online.de', 'table tbody');
$D->clickDropdown(StatisticsPage::$deliveryStat, StatisticsPage::$deliveryErrorsStat);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText(TitlePage::$deliveryErrorsStatTitle, 30, StatisticsPage::$title);

$I->click(['link' => '550 Требуемое действие не выполнено: почтовый ящик недоступен']);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText(TitlePage::$delivery550ErrorsStatTitle, 60, StatisticsPage::$title);
$I->waitForText('Подписчик', 60, 'table thead tr th');
$I->see('91332@test.ru', 'table tbody');
$D->clickDropdown(StatisticsPage::$deliveryStat, StatisticsPage::$deliveryErrorsStat);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText(TitlePage::$deliveryErrorsStatTitle, 30, StatisticsPage::$title);

$I->click(['link' => '5.4.4 Невозможно выполнить маршрутизацию']);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText(TitlePage::$delivery544ErrorsStatTitle, 60, StatisticsPage::$title);
$I->waitForText('Подписчик', 60, 'table thead tr th');
$I->see('660862@pscomplect.ru', 'table tbody');
$D->clickDropdown(StatisticsPage::$deliveryStat, StatisticsPage::$deliveryErrorsStat);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText(TitlePage::$deliveryErrorsStatTitle, 30, StatisticsPage::$title);

$I->click(['link' => 'Сообщение расценено как спам. В приеме отказано']);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText(TitlePage::$deliverySpamErrorsStatTitle, 60, StatisticsPage::$title);
$I->waitForText('Подписчик', 60, 'table thead tr th');
$I->see('541650@nationalrent.ru', 'table tbody');
$D->clickDropdown(StatisticsPage::$deliveryStat, StatisticsPage::$deliveryErrorsStat);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText(TitlePage::$deliveryErrorsStatTitle, 30, StatisticsPage::$title);

$I->click(['link' => '540 Ящик заблокирован']);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText(TitlePage::$delivery540ErrorsStatTitle, 60, StatisticsPage::$title);
$I->waitForText('Подписчик', 60, 'table thead tr th');
$I->see('496660@rambler.ru', 'table tbody');
$D->clickDropdown(StatisticsPage::$deliveryStat, StatisticsPage::$deliveryErrorsStat);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText(TitlePage::$deliveryErrorsStatTitle, 60, StatisticsPage::$title);

$I->click('Все ошибки', '.table_fixed');
$I->waitForElement(Page::$pageLoaded);
$I->waitForText(TitlePage::$deliveryAllErrorsStatTitle, 90);
$I->waitForText('Подписчик', 60, 'table thead tr th:nth-child(1)');
$I->waitForText('Наименование ошибки', 60, 'table thead tr th:nth-child(2)');
$I->see('@t-online.de', 'table tbody');
$I->see('550 Требуемое действие не выполнено: почтовый ящик недоступен', 'table tbody');
$D->clickDropdown(StatisticsPage::$deliveryStat, StatisticsPage::$deliveryErrorsStat);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText(TitlePage::$deliveryErrorsStatTitle, 30, StatisticsPage::$title);
