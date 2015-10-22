<?php
/**
 * Created by PhpStorm.
 * User: kurilov
 * Date: 27.05.15
 * Time: 14:00
 */

$I = new \AcceptanceTester\DraftsSteps($scenario);
$I->wantTo('Check drafts list');
$I->click(MenuPage::$mailings);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText('Все', 60);
$I->waitForElement(Page::$tableLoaded, 90);
$I->waitForElement('.select__entry', 90);
$I->selectOption('type', 'drafts');
$I->waitForElement(Page::$tableLoaded, 90);
$I->see('Редактировать', "//tr//td[last()]");
$I->dontSee('Статистика', "//tr//td[last()]");
