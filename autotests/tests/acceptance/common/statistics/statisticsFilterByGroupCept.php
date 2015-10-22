<?php
/**
 * Created by Komodo Edit.
 * User: lemesh
 * Date: 02.07.15
 * Time: 15:50
 */

$I = new \AcceptanceTester\StatisticsSteps($scenario);
$I->wantTo('Check filterByGroup');
$I->goToStatisticsPage();
$I = new \AcceptanceTester\CustomSteps($scenario);

$I->seeElement(StatisticsPage::$statGroupFilter);

/*
Test for Current Group
*/

$I->waitForElement(StatisticsPage::$statGroupFilterOption, 60);
$I->selectOption(StatisticsPage::$statGroupFilter, 'p324');

$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForElement(StatisticsPage::$statName, 60);

$I->seeElement(StatisticsPage::$statGroupFilter);
$I->seeOptionIsSelected(StatisticsPage::$statGroupFilter, 'codeception');

$I->seeElement(StatisticsPage::$statName);
$I->seeElement(StatisticsPage::$statName1);


/*
Test for All Groups
*/

$I->selectOption(StatisticsPage::$statGroupFilter, '');

$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForElement(StatisticsPage::$statName, 60);

$I->seeElement(StatisticsPage::$statGroupFilter);
$I->seeOptionIsSelected(StatisticsPage::$statGroupFilter, 'Статистика по выпускам по всем группам');

$I->seeElement(StatisticsPage::$statName);
$I->seeElement(StatisticsPage::$statName1);
