<?php
/**
 * Created by PhpStorm.
 * User: kurilov
 * Date: 17.06.15
 * Time: 14:35
 */

use Facebook\WebDriver\Exception\ExpectedException;

class MailTester extends \Codeception\Actor
{
	/**
	 * @var MailTester
	 */
	private $_host = '{imap.gmail.com:993/imap/ssl}INBOX';

	/**
	 * @return bool
	 */
	public function getNewMessages()
	{
		$query = imap_search(self::__connect(), 'UNSEEN');
		$data = false;
		$messages = [];
		if (is_array($query)) {
			foreach ($query as $number) {
				$messages[] = imap_fetch_overview(self::__connect(), $number)[0];
			}
			for ($i = 0; $i < count($messages); $i++) {
				$data[$i]['msgno'] = $messages[$i]->msgno;
				$data[$i]['subject'] = imap_mime_header_decode(imap_utf8(mb_convert_encoding($messages[$i]->subject, 'UTF8', 'KOI8-R')))[0]->text;
			}
		}
		return $data;
	}

	private function __connect()
	{
		try {
			return imap_open($this->_host, \MailingsPage::$_email, getenv('MailPass'));
		} catch (\Exception $e) {
			return imap_last_error();
		}
	}

	/**
	 * @param $string //искомая тема
	 * @return string //в случае успеха возвращает Тело письма
	 */
	function getBodyBySubject($subject)
	{
		$body = false;
		$i = 1;
		while ($body === false) {
			$attempt = 30;
			codecept_debug('Пытаемся получить письмо. Попытка ' . $i . ' из ' . $attempt);
			$msgNo = imap_search(self::__connect(), 'SUBJECT "' . $subject . '"', SE_FREE, "UTF-8");
			codecept_debug($msgNo);
			if ($msgNo) {
				$body = imap_fetchbody(self::__connect(), end($msgNo), 1);
			}
			if ($i >= $attempt) {
				ExpectedException::throwException('3', 'Письмо не пришло в течение ' . $attempt * 6 . ' секунд.', $body);
			}
			$i += 1;
			sleep(6);
		}
		return $body;
	}

	/**
	 * @param $body //тело письма в виде строки
	 * @return mixed //массив url-ов
	 */
	function getUrls($body)
	{
		$regex = "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
		preg_match_all($regex, $body, $matches);
		return ($matches[0]);
	}

	/**
	 * @param $email //Тело письма
	 * @return mixed //пароль в виде строки
	 */
	function getPass($emailBody)
	{
		preg_match("/Пароль\:\s(.[a-zA-Z0-9]*)/", $emailBody["body"], $match);
		return ($match[1]);
	}

	/**
	 * @return bool|string
	 */
	public function markAllMessagesAsDelete()
	{
		try {
			for ($i = 1; $i <= self::getCountMessages(); $i++) {
				imap_delete(self::__connect(), $i);
			}
			return true;
		} catch (\Exception $e) {
			return imap_last_error();
		}
	}

	/**
	 * @return int
	 */
	public function getCountMessages()
	{
		return imap_num_msg(self::__connect());
	}

	/**
	 * @return bool
	 */
	public function closeConnection()
	{
		return imap_close(self::__connect());
	}
}
