<?php
namespace Codeception\Module;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class TariffsHelper extends \Codeception\Module
{
	public static $freeSubscribers = 'table tbody tr:nth-child(1) td:nth-child(1)';
	public static $freePrice = 'table tbody tr:nth-child(1) td:nth-child(2)';
	public static $freeComment = 'table tbody tr:nth-child(1) td:nth-child(3)';

	public static $b1Subscribers = 'table tbody tr:nth-child(2) td:nth-child(1)';
	public static $b1Price = 'table tbody tr:nth-child(2) td:nth-child(2)';

	public static $b2Subscribers = 'table tbody tr:nth-child(3) td:nth-child(1)';
	public static $b2Price = 'table tbody tr:nth-child(3) td:nth-child(2)';

	public static $b5Subscribers = 'table tbody tr:nth-child(4) td:nth-child(1)';
	public static $b5Price = 'table tbody tr:nth-child(4) td:nth-child(2)';

	public static $b10Subscribers = 'table tbody tr:nth-child(5) td:nth-child(1)';
	public static $b10Price = 'table tbody tr:nth-child(5) td:nth-child(2)';

	public static $b25Subscribers = 'table tbody tr:nth-child(6) td:nth-child(1)';
	public static $b25Price = 'table tbody tr:nth-child(6) td:nth-child(2)';

	public static $b50Subscribers = 'table tbody tr:nth-child(7) td:nth-child(1)';
	public static $b50Price = 'table tbody tr:nth-child(7) td:nth-child(2)';

	public static $tariffs = [
		'free' => [
			'subscribers' => 200,
			'price' => 'Бесплатно',
			'comment' => 'Ограничение: 1 000 писем в месяц'
		],
		'B1' => [
			'subscribers' => '1 000',
			'price' => '1',
			'comment' => ''
		],
		'B2' => [
			'subscribers' => '2 500',
			'price' => '1 300',
			'comment' => ''
		],
		'B5' => [
			'subscribers' => '5 000',
			'price' => '2 000',
			'comment' => ''
		],
		'B10' => [
			'subscribers' => '10 000',
			'price' => '3 300',
			'comment' => ''
		],
		'B25' => [
			'subscribers' => '25 000',
			'price' => '6 500',
			'comment' => ''
		],
		'B50' => [
			'subscribers' => '50 000',
			'price' => '10 300',
			'comment' => ''
		]
	];

	public static $discounts = [
		'1' => 0,
		'3' => 0.10,
		'6' => 0.15,
		'12' => 0.20
	];

	public static function calcPrice($period, $rate = 'B10')
	{
		return (1 - self::$discounts[$period]) * $period * (int)str_replace(' ', '', self::$tariffs[$rate]['price']);
	}
}
