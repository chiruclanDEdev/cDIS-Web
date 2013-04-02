<?php
/* chiruclan.de IRC services
 *
 * Copyright (C) 2012-2013 chiruclan.de IRC services
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see http://www.gnu.org/licenses/.
 */

require_once('inc/config.inc.php');
require_once('inc/class.mysqli.php');
require_once('inc/class.user.php');

$user_data = $user->cookies();

print('<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>
			'.$config->get_string('site', 'name').'
		</title>
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="stylesheet" type="text/css" href="inc/style.css" />
		<script type="text/javascript" src="jscripts/jquery.js"></script>
		<script type="text/javascript" src="jscripts/functions.js"></script>
		<script type="text/javascript" src="jscripts/user.js"></script>
		<script type="text/javascript" src="jscripts/event.js"></script>
	</head>
	<body>
		<header>
			'.$config->get_string('site', 'name').'
		</header>
		<div id="Content">
			<script type="text/javascript">$("#Content").slideUp(0);</script>
			<span class="Notification" id="Notification">loading...</span>
			<script type="text/javascript">$("#Notification").slideUp(0);</script>
');

if (!$db->verify_user($user_data))
{
	print('			<br />
			<form method="post" id="loginform">
				<input type="hidden" name="method" value="do" />
				<input type="hidden" name="action" value="login" />
				<table class="new" cellspacing="5" border="0" align="center">
					<tr>
						<td>
							<input type="email" name="email" maxlength="50" placeholder="your@email.com" />
						</td>
						<td>
							<input type="password" name="password" maxlength="64" placeholder="password" />
						</td>
						<td>
							<input type="submit" name="login" value="sign in" />
						</td>
					</tr>
				</table>
			</form>
');
}
else
{
	print('			<h1>Welcome, '.$user_data['name'].'!</h1>
			<table class="new" cellspacing="5" border="0" align="center">
				<tr>
					<th class="new">Option</th>
					<th class="new">Value</th>
				</tr>
				<tr>
					<td>Account status</td>
					<td>'.$db->get_banned($user_data['id']).'</td>
				</tr>
			</table>
');
}

print('			<script type="text/javascript">$("#Content").slideDown(750);</script>
		</div>
	</body>
</html>');