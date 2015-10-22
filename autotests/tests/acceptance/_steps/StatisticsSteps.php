<?php
namespace AcceptanceTester;

class StatisticsSteps extends \AcceptanceTester
{
	public function waitLoadingStatPage()
	{
		$I = $this;
		$I->waitForElement(\Page::$pageLoaded, 60);
		$I->waitForElement(\StatisticsPage::$highchartsContainer, 120);
		$I->wait(3);
	}

	public function goToFirstIssue($subject = null)
	{
		$I = $this;
		$I->goToStatisticsPage();
		if ($subject != null) {
			$I->click(['link' => $subject]);
		} else {
			$I->click("table tbody tr:nth-child(1) td:nth-child(1) div.table_issues__primaryData a");
		}
		$I->waitForElement(\StatisticsPage::$highchartsContainer, 120);
	}

	public function goToStatisticsPage()
	{
		$I = $this;
		$I->click(\MenuPage::$statistics);
		$I->waitForElement(\Page::$pageLoaded, 60);
		$I->waitForElement(['name' => 'group'], 60);
		$I->seeInCurrentUrl(\StatisticsPage::$URL);
		$I->wait(2);
	}

	public function goToFullIssueStat()
	{
		$I = $this;
		$I->amOnPage('/statistics/issue/summary?id=' . \StatisticsPage::$fullStatId);
	}

	public function goToEmptyIssueStat()
	{
		$I = $this;
		$I->amOnPage('/statistics/issue/summary?id=' . \StatisticsPage::$emptyStatId);
	}

	/**
	 * Проверяет что при нажатии на радиобаттон
	 * устанавливается правильный период в календаре
	 * и кнопка становится выделенной
	 *
	 * @param $button
	 * Локатор для кнопки
	 * $button = 'div.content__action div div:nth-child(1) label span';
	 * @param $value
	 * Значение для проверки выделения
	 * $value = 'today';
	 * @param $from
	 * Значение периода"с" в формате 'd.m.Y'
	 * $from = '01.01.2000';
	 * @param $to
	 * Значение периода"по" в формате 'd.m.Y'
	 * $to = '01.01.2000';
	 */
	public function checkDatePickerButtons($button, $value, $from, $to)
	{
		$I = $this;

		$I->validateDate($from, 'd.m.Y');
		$I->validateDate($to, 'd.m.Y');
		$I->click($button);
		$I->waitForElement(\Page::$pageLoaded, 60);
		$I->seeElementInDOM(['name' => 'range', 'value' => $value, 'checked' => 'checked']);
		$I->see($from, \StatisticsPage::$dateFrom);
		$I->see($to, \StatisticsPage::$dateTo);
	}

	/**
	 * Экспортирует отчет в нужном формате
	 *
	 * @param $type
	 * Тип отчета "XLSX" или "CSV"
	 * $type = 'XLSX'
	 *
	 * @return string
	 */
	public function exportTo($type)
	{
		$I = $this;
		$custom = new CustomSteps($this->scenario);
		$id = null;
		$I->waitForElement(\Page::$pageLoaded, 90);
		$I->click(\Page::$meatball);
		$I->waitForText("Экспортировать как " . $type, 10);
		if ($type == 'XLSX') {
			$I->click(\StatisticsPage::$exportXLSX);
			$I->wait(1);
			$id = $custom->checkNotification(\StatisticsPage::$texstExportToXLSX);
			$I->dontSee(\StatisticsPage::$texstExportToCSV);
		} elseif ($type == 'CSV') {
			$I->click(\StatisticsPage::$exportCSV);
			$I->wait(1);
			$id = $custom->checkNotification(\StatisticsPage::$texstExportToCSV);
			$I->dontSee(\StatisticsPage::$texstExportToXLSX);
		}
		return $id;
	}
}
