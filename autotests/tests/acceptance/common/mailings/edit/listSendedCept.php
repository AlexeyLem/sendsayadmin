<?php
/**
 * Created by PhpStorm.
 * User: anastasya
 * Date: 23.07.15
 * Time: 14:13
 */
$I = new \AcceptanceTester\DraftsSteps($scenario);
$I->wantTo('Check sended list');
$I->click(MenuPage::$mailings);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText('Все', 60);
$I->waitForElement(Page::$tableLoaded, 90);
$I->selectOption('type', 'sended');
$I->waitForElement(Page::$tableLoaded, 90);
$I->see('Статистика', "//tr//td[last()]");
$I->dontSee('Редактировать', "//tr//td[last()]");
