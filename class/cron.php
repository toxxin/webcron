<?php

class Cron
{
	var $minute = 0;
	var $hour = 0;
	var $day = 0;
	var $month = 0;
	var $weekday = 0;

	var $path = "";
	var $file = "";

	var $content = array();
	var $new_jobs = array();


	function __construct($path="/home/acikers/scr/webcron/", $file="cron.txt") 
	{ 
		$this->path = $path;
		$this->file = $file;

		try
		{
			$this->content = file($this->file);
		}
		catch (Exception $e)
		{
			echo 'Exception: ',  $e->getMessage(), "\n";
			die();
		}
	}


	private function isExist($j)
	{
		return in_array($j."\n", $this->content);
	}


	public function appendJob($j)
	{
		if (!$this->isExist($j))
			array_push($this->new_jobs, $j."\n");
	}


	public function removeJob($id)
	{
		unset($this->content[$id]);
	}


	public function commit()
	{
		/* rewrite all content */
		file_put_contents($this->file, "");

		foreach ($this->content as $job)
			file_put_contents($this->file, $job, FILE_APPEND);

		foreach ($this->new_jobs as $job)
			file_put_contents($this->file, $job, FILE_APPEND);
	}


	public function dbg()
	{
		echo "Content:"."<br />";
		foreach ($this->content as $v) {
			print $v."<br />";
		}

		echo "New jobs:"."<br />";
		foreach ($this->new_jobs as $v) {
			print $v;
		}
	}
}

?>
