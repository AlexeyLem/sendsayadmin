<?php
namespace AcceptanceTester;

class DraftsSteps extends \AcceptanceTester
{

    /**
     * @param $subject
     *
     * @throws \ErrorException
     */
    public function deleteAutosave($subject)
    {

        $I = $this;
        $custom = new CustomSteps($this->scenario);

        $I->click(\MenuPage::$mailings);
        $I->waitForElement(\Page::$pageLoaded, 60);
        $I->waitForText('Все', 60);
        $I->waitForElement(\Page::$tableLoaded, 60);
        $custom->findElemUsePagination('Редактировать', "//tr//td[last()]");
        $custom->findElemUsePagination('Статистика', "//tr//td[last()]");
        $I->selectOption('type', 'drafts');
        $I->waitForElement(\Page::$tableLoaded, 90);
        $custom->findElemUsePaginationAndClick($subject, "//tr//td[2]");
        $I->waitForElement(\MailingsPage::$fieldName, 60);
        $I->click(\MailingsPage::$draftDelete);
        $I->waitForText('Все', 60);
        $I->waitForElement(\Page::$tableLoaded, 90);
        $I->selectOption('type', 'drafts');
        $I->waitForElement(\Page::$tableLoaded, 90);
        $custom->dontSeeUsePagination($subject, "//tr//td[2]");
    }

}
