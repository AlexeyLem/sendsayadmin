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
$I->wantTo('Upload and Delete File');
$custom = new CustomSteps($scenario);
$files = new FilesSteps($scenario);
$name = 'test.jpg';

$files->goToFilesPage();

$files->createFile($name);
$I->waitForElementNotVisible(Page::$notificationText, 20);
$I->see($name);

$files->delete($name);
