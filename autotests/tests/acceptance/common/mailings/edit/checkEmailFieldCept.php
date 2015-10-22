<?php
/**
 * Created by PhpStorm.
 * User: kurilov
 * Date: 26.05.15
 * Time: 9:39
 */
$I = new \AcceptanceTester\MailingsSteps($scenario);
$I->wantTo('Validate email field');
$I->checkWrongEmail();