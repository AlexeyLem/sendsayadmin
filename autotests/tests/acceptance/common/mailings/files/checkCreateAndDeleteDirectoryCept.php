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
$I->wantTo('Upload and Delete Directory');
$custom = new CustomSteps($scenario);
$name = 'testDirectory';

$files = new FilesSteps($scenario);
$files->goToFilesPage();
$files->createDirectory($name);
$I->see($name, \Page::$table);
$files->delete($name);
