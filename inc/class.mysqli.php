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

class database
{
	public $result;
	public $rows;
	private $conn;
	
	public function __construct($host, $port, $user, $pass, $name)
	{
		$this->host = $host;
		$this->port = $port;
		$this->user = $user;
		$this->pass = $pass;
		$this->name = $name;
		
		$this->conn = new mysqli($this->host, $this->user, $this->pass, $this->name, $this->port);
		
		if (mysqli_connect_errno())
			printf('Connect failed: %s', mysqli_connect_error());
	}
	
	public function destruct()
	{
		$this->conn->close();
	}
	
	public function login_user($email, $password)
	{
		$pass_hash = hash('sha512', $password);
		
		$stmt = $this->conn->prepare('SELECT `id`, `name` FROM `users` WHERE `email` = ? AND `pass` = ?');
		$stmt->bind_param('ss', $email, $pass_hash);
		$stmt->execute();
		
		if ($stmt->num_rows ==  1)
		{
			$stmt->bind_result($id, $name);
			$stmt->fetch();
			
			$code = (string)rand(0, time());
			$hash = hash('md5', strrev($code));
			
			$duration = time() + $config->get_int('cookie', 'duration');
			setcookie($config->get_string('cookie', 'prefix').'cdis_user_id', $id, $duration, $config->get_string('site', 'path'), $config->get_string('site', 'url'));
			setcookie($config->get_string('cookie', 'prefix').'cdis_user_name', $name, $duration, $config->get_string('site', 'path'), $config->get_string('site', 'url'));
			setcookie($config->get_string('cookie', 'prefix').'cdis_user_code', $code, $duration, $config->get_string('site', 'path'), $config->get_string('site', 'url'));
			setcookie($config->get_string('cookie', 'prefix').'cdis_user_hash', $hash, $duration, $config->get_string('site', 'path'), $config->get_string('site', 'url'));
			
			$stmt->close();
			return true;
		}
		
		$stmt->close();
		return false;
	}
	
	public function verify_user($data = array())
	{
		$stmt = $this->conn->prepare('SELECT `id`, `name` FROM `users` WHERE `id` = ? AND `name` = ?');
		$stmt->bind_param('is', $data['id'], $data['name']);
		$stmt->execute();
		
		if ($stmt->num_rows == 1)
		{
			$stmt->close();
			
			$hash = hash('md5', strrev($data['code']));
			
			if ($hash == $data['hash'])
				return true;
			else
				return false;
		}
		
		$stmt->close();
		return false;
	}
}

$db = new database($config->get_string('mysql', 'host'), $config->get_int('mysql', 'port'), $config->get_string('mysql', 'user'), $config->get_string('mysql', 'pass'), $config->get_string('mysql', 'name'));