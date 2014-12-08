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
	
		
	private function parse($part)
	{
	    if ($part == '*') {
	        return 'any';
	    }
	    if (substr($part, 0, 2) == '*/') {
	        return 'every ' . $this->parse(substr($part, 2)); /* XXX: recursion */
	    }
	    preg_match("/\D/is", $part, $list, PREG_OFFSET_CAPTURE);

	    $index = $list[0][1];
	    if ($index) {
	        $return = substr($part, 0, $index);
	        $nextPart = substr($part, $index);
	        switch ($nextPart[0]) {
	            case '-':
	                $return .= ' until ';
	                break;
	            case ',':
	                $return .= ' and ';
	                break;
	        }
	        $return .= $this->parse(substr($nextPart, 1)); /* XXX: recursion */
	    } else {
	        $return = $part;
	    }
	    return $return;
	}

	
    	public function toEnglish()
    	{
		list($minute, $hour, $day, $month, $weekday, $year) = explode(' ', $this->getExpression());
	        return
	            'At minute  : ' . $this->parse($minute) . '<br>' .
	            'At hour    : ' . $this->parse($hour) . '<br>' .
	            'At day     : ' . $this->parse($day) . '<br>' .
	            'At month   : ' . $this->parse($month) . '<br>' .
	            'At weekday : ' . $this->parse($weekday) . '<br>' 
	            //'At year    : ' . $this->parse($year ?: '*') . '<br>'
	            ;
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
