<?php

class FileLogger implements Logger
{
	private $filename = 'log';
    
	/* @var der FileHandle der Log Datei */
	private $fh;

	public function __construct( $filename )
	{
		$this->filename = $filename;
		$this->fh = fopen( $this->filename, 'w');
	}

	public function log( $msg, $severity = self::DEBUG, $category = null)
	{
		$time = date( 'Y.m.d H:i:s' );
		$severity = strtoupper( $this->mapSeverityLevel($severity));
		fwrite($this->fh, $time." ".$severity." ".$category.": ".$msg."\n");
	}

	public function __destruct()
	{
	        if( is_resource($this->fh) )
        	{
	            fclose($this->fh);
        	}
	}

	public function mapSeverityLevel( $lvl )
	{
		switch( $lvl )
		{
			case self::EMERG:
				return 'emergency';
				break;
			case self::ALERT:
				return 'alert';
				break;
			case self::CRIT:
				return 'crit';
				break;
			case self::ERR:
				return 'error';
				break;
			case self::WARNING:
				return 'warning';
				break;
			case self::NOTICE:
				return 'notice';
				break;
			case self::INFO:
				return 'info';
				break;
			case self::DEBUG:
				return 'debug';
				break;
		}
	}
}
# vim:encoding=utf8:syntax=php
