<?php
namespace Codeception\Module;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

use Facebook\WebDriver\Exception\ExpectedException;

class AcceptanceHelper extends \Codeception\Module
{
	/**
	 * @return array
	 * Возвращает массив с данными для акуу аккаунта
	 */
	public static function configGet()
	{
		$memcache = new \Memcache();
		$memcache->addServer('localhost', 11211);
		return $memcache->get('free');
	}

	/**
	 * @return array
	 * Возвращает массив с данными для указанного ключа
	 */
	public static function getDataFromMemcache($key)
	{
		$memcache = new \Memcache();
		$memcache->addServer('localhost', 11211);
		return $memcache->get($key);
	}

	/**
	 * Записывает массив с данными временного аккаунта
	 * @param $newData array('free'=>array('login'=>'test', 'pass'=>'testPass'))
	 * @return bool
	 */
	public static function configSet($newData)
	{
		$memcache = new \Memcache();
		$memcache->addServer('localhost', 11211);
		$memcache->flush();
		try {
			return $memcache->set($newData, 'Login');
		} catch (\Exception $e) {
			ExpectedException::throwException('2', 'Error write to memcache', '');
		}
	}

	/**
	 * @param $number
	 * @return string
	 */
	public static function formatNumber($number)
	{
		return number_format($number, 0, '.', ' ');
	}

	/**
	 * @param $srcFile          string      Путь к архиву
	 * @param $destDir          string      Путь куда будет распакован архив
	 * @param $createZipNameDir boolean     Указывает, будут ли файлы распакованы в каталог с именем архива (true) или нет (false) (только если $destDir = false !)
	 * @param $overwrite        boolean     Перезаписывать файлы( true) или нет (false)
	 *
	 * @return  boolean or array()    false или массив названий файлов
	 */
	public static function unzip($srcFile, $destDir = false, $createZipNameDir = true, $overwrite = true)
	{
		if ($zip = zip_open($srcFile)) {
			if ($zip) {
				$splitter = ($createZipNameDir === true) ? "." : "/";
				if ($destDir === false) $destDir = substr($srcFile, 0, strrpos($srcFile, $splitter)) . "/";

				// Создаем директории в tests/_data если они не существуют
				codecept_data_dir($destDir);

				// Читаем каждый файл в архиве
				while ($zipEntry = zip_read($zip)) {
					// Создаем каталоги в директории назначения

					// Если файл не в корневой лдиректории
					$posLastSlash = strrpos(zip_entry_name($zipEntry), "/");
					if ($posLastSlash !== false) {
						// Создаем дирктории, куда сохраняем содержимое
						codecept_data_dir($destDir . substr(zip_entry_name($zipEntry), 0, $posLastSlash + 1));
					}

					// Открываем содержимое
					if (zip_entry_open($zip, $zipEntry, "r")) {

						// Получаем имя файла для сохранения
						$fileName = $destDir . zip_entry_name($zipEntry);

						// Проверяем перезаписывать файл или нет
						if ($overwrite === true || $overwrite === false && !is_file($fileName)) {
							// Получаем содержимое архива
							$fstream = zip_entry_read($zipEntry, zip_entry_filesize($zipEntry));

							file_put_contents($fileName, $fstream);
							// Устанавливаем права на файл
							chmod($fileName, 0777);
							$files[] = $fileName;
						}
						// Закрываем содержимое
						zip_entry_close($zipEntry);
					}
				}
				// Закрываем архив
				zip_close($zip);
			}
		} else {
			return false;
		}

		return $files;
	}

	public static function csvToArray($csvFile)
	{
		$fileHandle = fopen($csvFile, 'r');
		while (!feof($fileHandle)) {
			$csvArray[] = fgetcsv($fileHandle, 1024);
		}
		fclose($fileHandle);
		return $csvArray;
	}

	public static function parseIdFromNotification($selector)
	{
		preg_match('/ID\\:(.\\d+)/', $selector, $matches);
		return $matches[1];
	}


	/**
	 * @param        $date
	 * @param string $format
	 * @return bool
	 */
	public function validateDate($date, $format = 'd.m.Y H:i:s')
	{
		if ($format == 'm.Y') {
			$format = 'd.' . $format;
			$date = '01.' . $date;
		}
		$d = \DateTime::createFromFormat($format, $date);
		if ($d && $d->format($format) == $date) {
			return true;
		} else {
			ExpectedException::throwException(12, 'Неверный формат даты. Ожидается формат: ' . $format . '. Дата в поле: ' . $date, $date);
		}
	}

	public function grabDateFromString($string)
	{
		preg_match("/((\d\d)\.)?(\d\d)\.(\d{4})( (\d\d))?(\:?(\d\d))?(\:(\d\d))?/", $string, $array);
		return $array[0];
	}

	private function configDir()
	{
		return codecept_data_dir('config.yml');
	}
}

