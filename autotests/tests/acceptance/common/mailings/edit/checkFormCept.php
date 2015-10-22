<?php
/**
 * Created by PhpStorm.
 * User: kurilov
 * Date: 26.05.15
 * Time: 14:30
 */
$I = new \AcceptanceTester\MailingsSteps($scenario);
$I->wantTo('Validate mail\draft create form');
$I->checkEmptyFields();