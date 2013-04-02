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

class user
{
	private $config;
	
	public function __construct()
	{
		$this->config = new config();
	}
	
	public function destruct()
	{ }
	
	public function cookies()
	{
		$prefix = $this->config->get_string('cookie', 'prefix');
		
		if (isset($_COOKIE[$prefix.'cdis_user_id']) and isset($_COOKIE[$prefix.'cdis_user_name']) and isset($_COOKIE[$prefix.'cdis_user_code']) and isset($_COOKIE[$prefix.'cdis_user_hash']))
		{
			$user_id = $_COOKIE[$prefix.'cdis_user_id'];
			$user_name = $_COOKIE[$prefix.'cdis_user_name'];
			$user_code = $_COOKIE[$prefix.'cdis_user_code'];
			$user_hash  = $_COOKIE[$prefix.'cdis_user_hash'];
			$user_data = array('id' => $user_id, 'name' => $user_name, 'code' => $user_code, 'hash' => $user_hash);
		}
		else
			$user_data = array('id' => 0, 'name' => null, 'code' => null, 'hash' => null);
			
		return $user_data;
	}
}

$user = new user();