<?php

namespace illuminates\Logs;

class Log extends \Exception
{
	protected string $log_file;
	public function __construct($message, $code = 0, \Exception $previous = null, $log_file = 'error.log')
	{
		parent::__construct($message, $code, $previous);
		$this->displayError();
		$this->log_file = $log_file;
		$this->logError();
	}
	
	public function logError(): void
	{
		$logMessage = date('Y-m-d H:i:s') . " - Error {$this->getMessage()} in {$this->getFile()} on line {$this->getLine()}\n";
		file_put_contents(storage_path('log/'.$this->log_file), $logMessage, FILE_APPEND);
	}
	
	public function displayError(): void
	{
		$message = $this->getMessage();
		$line = $this->getLine();
		$file = $this->getFile();
		$trace = $this->getTrace();
		include base_path('app/views/errors/exception.tpl.php');
	}
}
