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

require_once('config.inc.php');
require_once('class.mysqli.php');
require_once('class.user.php');

$user_data = $user->cookies();

if (isset($_POST['method']) and isset($_POST['action']))
{
	$method = $_POST['method'];
	$action = $_POST['action'];
	
	if (!$db->verify_user($user_data))
	{
		if ($method == 'do')
		{
			if ($action == 'login' and isset($_POST['email']) and isset($_POST['password']))
			{
				if ($db->login_user($_POST['email'], $_POST['password']))
					echo 'Login succeeded';
				else
					echo 'Login failed';
			}
		}
	}
}