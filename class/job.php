<?php

class Job
{
	var $minute = 0;
	var $hour = 0;
	var $day = 0;
	var $month = 0;
	var $weekday = 0;

	var $script_path = "/etc/upsConfig/scripts/";
	var $script_file = "";

	var $user = "root";


	public function setMinute($m)
	{
		$this->minute = $m;
	}


	public function setHour($h)
	{
		$this->hour = $h;
	}


	public function setDay($d)
	{
		$this->day = $d;
	}


	public function setMonth($m)
	{
		$this->month = $m;
	}


	public function setWeekday($w)
	{
		$this->weekday = $w;
	}


	public function setScript($s)
	{
		$this->script_file = $s;
	}


	public function makeJob()
	{
		$job = (string) (($this->minute == 0) ? "*" : $this->minute) . "\t".
							(($this->hour == 0) ? "*" : $this->hour) . "\t".
							(($this->day == 0) ? "*" : $this->day) . "\t".
							(($this->month == 0) ? "*" : $this->month) . "\t".
							(($this->weekday == 0) ? "*" : $this->weekday) . "\t".
							$this->user . "\t".
							$this->script_path . $this->script_file;

		return $job;
	}


	public function dbg()
	{
		print $this->minute;
		print $this->hour;
		print $this->day;
		print $this->month;
		print $this->weekday;
	}
}

?>