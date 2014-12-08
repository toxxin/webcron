<?php

error_reporting ( E_ALL & ~E_NOTICE );

include_once "./class/cron.php";
include_once "./class/job.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$cron = new Cron();

	$job = new Job();

	if (($_POST['minute_chooser']) && ($_POST['minute']))
		$job->setMinute($_POST['minute']);

	if (($_POST['hour_chooser']) && ($_POST['hour']))
		$job->setHour($_POST['hour']);

	if (($_POST['day_chooser']) && ($_POST['day']))
		$job->setDay($_POST['day']);

	if (($_POST['month_chooser']) && ($_POST['month']))
		$job->setMonth($_POST['month']);

	if (($_POST['weekday_chooser']) && ($_POST['weekday']))
		$job->setWeekday($_POST['weekday']);

	$job->setScript($_POST['cmd'].".sh");

	$j = (string) $job->makeJob();

	$cron->appendJob($j);

	// $cron->dbg();

	$cron->commit();
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Crontab Code Generator</title>
<link rel="stylesheet" href="./style.css" type="text/css" media="all" />
<!--[if IE]>
<link rel="stylesheet" href="http://openjs.com/style_ie.css" type="text/css" media="all" />
<![endif]-->

<style type="text/css">
/* <![CDATA[ */
h3 {
	margin:0;
}
.select-box {
	height:100px;
	width:120px;
}
br {
	clear:both;
}
.box {
	width:150px;
	float:left;
}
/* ]]> */
</style>
<script language="javascript" type="text/javascript">
/* <![CDATA[ */
function init() {
	JSL.dom(".chooser").click(function(e) {
		var for_element = this.name.replace(/_chooser/,"");

		JSL.dom(for_element).disabled = (this.value !== "1");
	});
	
	JSL.dom("crontab-form").on("submit", function(e) {
		JSL.event(e).stop();
		
		var minute, hour, day, month, weekday;
		
		minute	= getSelection('minute');
		hour	= getSelection('hour');
		day		= getSelection('day');
		month	= getSelection('month');
		weekday	= getSelection('weekday');
		
		var command = JSL.dom("command").value;
		JSL.dom("cron").value = minute + "\t" + hour + "\t" + day + "\t" + month + "\t" + weekday + "\t" + command;
	});
}

function getSelection(name) {
	var chosen;
	if(JSL.dom(name + "_chooser_every").checked) {
		chosen = '*';
	} else {
		var all_selected = [];
		JSL.dom("#" + name+ " option").each(function(ele) {
			if(ele.selected)
				all_selected.push(ele.value);
		});
		if(all_selected.length)
			chosen = all_selected.join(",");
		else
			chosen = '*';
	}
	return chosen;
}
/* ]]> */
</script>
</head>

<body>

<!-- <form method="get" action="" id="crontab-form"> -->
<form method="post" action="">

Command:
<select type="text" name="cmd" id="cmd" height="1px">
  <option>load_off</option>
  <option>load_on</option>
  <option>test_battery_start</option>
  <option>test_battery_start_deep</option>
  <option>test_battery_start_quick</option>
  <option>test_battery_stop</option>
</select>

<br />
<br />

<div class="box">
<h3>Minute</h3>
<label for="minute_chooser_every">Every Minute</label>
<input type="radio" name="minute_chooser" id="minute_chooser_every" class="chooser" value="0" checked="checked" /><br />

<label for="minute_chooser_choose">Choose</label>
<input type="radio" name="minute_chooser" id="minute_chooser_choose" class="chooser" value="1" /><br />


<select class="select-box" name="minute" id="minute" multiple="multiple" disabled="disabled">
<option value="0">0</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
<option value="32">32</option>
<option value="33">33</option>
<option value="34">34</option>
<option value="35">35</option>
<option value="36">36</option>
<option value="37">37</option>
<option value="38">38</option>
<option value="39">39</option>
<option value="40">40</option>
<option value="41">41</option>
<option value="42">42</option>
<option value="43">43</option>
<option value="44">44</option>
<option value="45">45</option>
<option value="46">46</option>
<option value="47">47</option>
<option value="48">48</option>
<option value="49">49</option>
<option value="50">50</option>
<option value="51">51</option>
<option value="52">52</option>
<option value="53">53</option>
<option value="54">54</option>
<option value="55">55</option>
<option value="56">56</option>
<option value="57">57</option>
<option value="58">58</option>
<option value="59">59</option>
</select>
</div>

<div class="box">
<h3>Hour</h3>
<label for="hour_chooser_every">Every Hour</label>
<input type="radio" name="hour_chooser" id="hour_chooser_every" class="chooser" value="0" checked="checked" /><br />

<label for="hour_chooser_choose">Choose</label>
<input type="radio" name="hour_chooser" id="hour_chooser_choose" class="chooser" value="1" /><br />

<select class="select-box" name="hour" id="hour" multiple="multiple" disabled="disabled">
<option value="0">12 Midnight</option>
<option value="1">1 AM</option><option value="2">2 AM</option><option value="3">3 AM</option><option value="4">4 AM</option><option value="5">5 AM</option><option value="6">6 AM</option><option value="7">7 AM</option><option value="8">8 AM</option><option value="9">9 AM</option><option value="10">10 AM</option><option value="11">11 AM</option><option value="12">12 Noon</option>
<option value="13">1 PM</option><option value="14">2 PM</option><option value="15">3 PM</option><option value="16">4 PM</option><option value="17">5 PM</option><option value="18">6 PM</option><option value="19">7 PM</option><option value="20">8 PM</option><option value="21">9 PM</option><option value="22">10 PM</option><option value="23">11 PM</option></select>
</div>

<div class="box">
<h3>Day</h3>
<label for="day_chooser_every">Every Day</label>
<input type="radio" name="day_chooser" id="day_chooser_every" class="chooser" value="0" checked="checked" /><br />

<label for="day_chooser_choose">Choose</label>
<input type="radio" name="day_chooser" id="day_chooser_choose" class="chooser" value="1" /><br />

<select class="select-box"  name="day" id="day" multiple="multiple" disabled="disabled">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
</select>
</div>

<div class="box">
<h3>Month</h3>
<label for="month_chooser_every">Every Month</label>
<input type="radio" name="month_chooser" id="month_chooser_every" class="chooser" value="0" checked="checked" /><br />

<label for="month_chooser_choose">Choose</label>
<input type="radio" name="month_chooser" id="month_chooser_choose" class="chooser" value="1" /><br />

<select class="select-box" name="month" id="month" multiple="multiple" disabled="disabled">
<option value="1">January</option>
<option value="2">February</option>
<option value="3">March</option>
<option value="4">April</option>
<option value="5">May</option>
<option value="6">June</option>
<option value="7">July</option>
<option value="8">Augest</option>
<option value="9">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>
</select>
</div>

<div class="box">
<h3>Weekday</h3>
<label for="weekday_chooser_every">Every Weekday</label>
<input type="radio" name="weekday_chooser" id="weekday_chooser_every" class="chooser" value="0" checked="checked" /><br />

<label for="weekday_chooser_choose">Choose</label>
<input type="radio" name="weekday_chooser" id="weekday_chooser_choose" class="chooser" value="1" /><br />

<select class="select-box" name="weekday" id="weekday" multiple="multiple" disabled="disabled">
<option value="0">Sunday</option>
<option value="1">Monday</option>
<option value="2">Tuesday</option>
<option value="3">Wednesday</option>
<option value="4">Thursday</option>
<option value="5">Friday</option>
<option value="6">Saturday</option>
</select>
</div>

<br /><br />
<!-- <input type="submit" name="action" id="action" value="Create Crontab Line" /> -->
<p><input type="submit" name="action"/></p>
</form>

<?php

$cr = new Cron();

try {
	$i = 1;
	echo "<table border=\"1\" style=\"width:100%\">";
	
	foreach ($cr->content as $line) 
	{	
		list($minute, $hour, $day, $month, $weekday) = explode("\t", $line);

		$job = new Job();
		$job->setMinute($minute);
		$job->setHour($hour);
		$job->setDay($day);
		$job->setMonth($month);
		$job->setWeekday($weekday);
	
		if (strlen($line) > 10)
		{
			echo "<tr>";
			echo "<td>" . $line . "</td>";
			echo "<td>";
			echo '<a class="btn btn-danger" href="delete.php?id='.$i++.'">Delete</a>';
			echo "</td>";
			echo "<td>" . $job->toEnglish() . "</td>";
			echo "</tr>";
		}
	}
	echo "</table>";
} catch (Exception $e) {
	echo 'Exception: ',  $e->getMessage(), "\n";
}

?>

<script src="./js/jsl.js" type="text/javascript"></script>
<script src="./js/common.js" type="text/javascript"></script>

</body>
</html>
