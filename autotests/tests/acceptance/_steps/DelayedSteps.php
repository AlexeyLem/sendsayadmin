<?php
/**
 * Created by PhpStorm.
 * User: anastasya
 * Date: 26.08.15
 * Time: 14:43
 */

namespace AcceptanceTester;


class DelayedSteps extends \AcceptanceTester
{
    public function deleteDelayedIssue($subject, $cancel = false)
    {
        $I = $this;
        $custom = new CustomSteps($this->scenario);

        $I->selectOption('type', 'delayed');
        $I->waitForElement(\Page::$tableLoaded, 90);
        $custom->findElemUsePagination($subject, "//tr//td[2]");
        $I->seeElement("//tr[td//text()[contains(., '$subject')]]//*[contains(@class,'icon_moreHoriz')]");
        $I->click("//tr[td//text()[contains(., '$subject')]]//*[contains(@class,'icon_moreHoriz')]");
        $I->waitForElementVisible("//tr[td//text()[contains(., '$subject')]]//*[contains(@class,'mailing__delete')]", 30);
        $I->click("//tr[td//text()[contains(., '$subject')]]//*[contains(@class,'mailing__delete')]");
        $I->waitForElement(\Page::$modal, 10);
        $I->see('Подтвердите действие', \Page::$modal);
        $I->see('Подтвердить', \Page::$modalConfirm);
        $I->see('Отменить', \Page::$modalCancel);
        if ($cancel) {
            $I->click(\Page::$modalCancel);
            $I->dontSeeElement(\Page::$modal);
        } else {
            $I->click(\Page::$modalConfirm);
            $I->waitForElement(\Page::$pageLoaded, 60);
            $I->waitForElement(\Page::$tableLoaded, 90);
            $custom->dontSeeUsePagination($subject, "//tr//td[2]");
        }
    }
}
