function convert_timestamp(timestamp)
{
	var dif = parseInt(timestamp);
	var days = 0;
	var hours = 0;
	var minutes = 0;
	var seconds = 0;
	
	if(dif >= 86400)
	{
		days = dif / 86400;
		days = parseInt(days);
		dif = dif - days * 86400;
	}
	
	if(dif >= 3600)
	{
		hours = dif / 3600;
		hours = parseInt(hours);
		dif = dif - hours * 3600;
	}
	
	if(dif >= 60)
	{
		minutes = dif / 60;
		minutes = parseInt(minutes);
		dif = dif - minutes * 60;
	}
	
	days = days.toString();
	hours = hours.toString();
	minutes = minutes.toString();
	seconds = dif.toString();
	
	if(parseInt(days) > 0)
		return days + 'd ' + hours + 'h ' + minutes + 'm ' + seconds + 's';
	else if(parseInt(hours) > 0)
		return hours + 'h ' + minutes + 'm ' + seconds + 's';
	else if(parseInt(minutes) > 0)
		return minutes + 'm ' + seconds + 's';
	else if(parseInt(seconds) > 0)
		return seconds + 's';
	else
		return '0';
}

function doDurationCountdown(timestamp, element, isNew)
{
	if (timestamp == 0)
		return;
	else
	{
		timestamp--;
		setTimeout(function() { doDurationCountdown(timestamp, element, false) }, 1000);
	}
		
	var date = convert_timestamp(timestamp).toString();
	
	if (date == '0')
	{
		date = 'expired';
	}
	
	if (isNew == false)
		$(element).html(date);
	else
	{
		$(element).fadeOut(500).fadeIn(750);
		setTimeout(function() { $(element).html(date) }, 500);
	}
}

function DisplayNotification(message, duration)
{
	if (!duration)
		var duration = 5;
		
	$('#Notification').html(message);
	duration = parseInt(duration) * 1000;
	$('#Notification')
		.slideDown(500)
		.delay(duration)
		.slideUp(750);
}

function loadPage(documentUrl, duration)
{
	if (!duration)
		var duration = 1;
		
	$('#Content').delay(duration * 1000 - 500).slideUp(500);
	
	setTimeout(function() { window.location.href = documentUrl }, duration * 1000);
}