<?php
/**
 * Created by PhpStorm.
 * User: kurilov
 * Date: 01.09.15
 * Time: 13:17
 */
use AcceptanceTester\CustomSteps;
use AcceptanceTester\FilesSteps;

$I = new AcceptanceTester($scenario);
$I->wantTo('Check Directory Change');
$custom = new CustomSteps($scenario);
$dataInPersonal = ['1.csv', '24.12.2014', '77'];
$files = new FilesSteps($scenario);
$files->goToFilesPage();
$I->click('personal');
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText('personal', 30, Page::$breadcrumb);
foreach($dataInPersonal as $k=>$v){
	$I->see($v, Page::$table);
}
$I->clickLink('Каталог файлов');
$I->wait(1);
$I->waitForElement(\Page::$pageLoaded, 60);
$I->waitForElementVisible(\Page::$table, 60);
$I->see('Каталог файлов', \Page::$breadcrumb);
$I->dontSee('personal', Page::$breadcrumb);
