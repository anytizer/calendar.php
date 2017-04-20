<?php
date_default_timezone_set("America/Montreal");

/**
 * Set the date
 */
$date = strtotime(date("Y-m-d"));
#$date = strtotime(date("2016-01-01"));

$day = date('d', $date);
$month = date('m', $date);
$year = date('Y', $date);
$firstDay = mktime(0, 0, 0, $month, 1, $year);
$month_name = strftime('%B', $firstDay);
$dayOfWeek = date('D', $firstDay);
$daysInMonth = cal_days_in_month(0, $month, $year);

/**
 * Get the name of the week days
 */
$timestamp = strtotime('next Sunday');
$week_days = array();
for ($i = 0; $i < 7; $i++) {
	$week_days[] = strtolower(strftime('%a', $timestamp));
	$timestamp = strtotime('+1 day', $timestamp);
}

$blank = date('w', strtotime("{$year}-{$month}-01"));

$calendar = array();
$calendar['week_days'] = $week_days;
#print_r($calendar);
?>
<link rel="stylesheet" type="text/css" href="css/calendar.css">
<h2><?php echo $month_name, ' ', $year ?></h2>
<table class='calendar'>
	<tr class="week-names">
		<?php foreach($calendar['week_days'] as $key => $weekDay) : ?>
			<td><?php echo $weekDay ?></td>
		<?php endforeach ?>
	</tr>
	<tr class="new-week">
		<?php for($i = 0; $i < $blank; ++$i): ?>
			<td class="blank">&nbsp;</td>
		<?php endfor; ?>
		<?php for($i = 1; $i <= $daysInMonth; ++$i): ?>
			<td class="day <?php echo ($day!=$i)?'normal-day':'today', ' ', $calendar['week_days'][($blank+$i-1)%7]; ?>">
			<?php echo $i; ?></td>
			<?php if(($i + $blank) % 7 == 0): ?>
				</tr><tr class="new-week">
			<?php endif; ?>
		<?php endfor; ?>
		<?php for($i = 0; ($i + $blank + $daysInMonth) % 7 != 0; ++$i): ?>
			<td class="blank">&nbsp;</td>
		<?php endfor; ?>
	</tr>
</table>
