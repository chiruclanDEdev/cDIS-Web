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

class config
{
	private $data = array();
	
	public function __construct()
	{
		$this->data['site']['name'] = 'chiruclan.de IRC services webinterface';
		$this->data['site']['url'] = '';
		$this->data['site']['path'] = '/';
		
		$this->data['cookie']['prefix'] = 'cdis_';
		$this->data['cookie']['duration'] = 3600;
		
		$this->data['mysql']['host'] = 'localhost';
		$this->data['mysql']['port'] = 3306;
		$this->data['mysql']['user'] = '';
		$this->data['mysql']['pass'] = '';
		$this->data['mysql']['name'] = '';
	}
	
	public function get($namespace, $key)
	{
		try
		{
			return $this->data[$namespace][$key];
		}
		catch (Exception $e)
		{
			throw new Exception('An error has occurred', 0, $e);
		}
	}
	
	public function get_string($namespace, $key)
	{
		try
		{
			return (string)$this->data[$namespace][$key];
		}
		catch (Exception $e)
		{
			throw new Exception('An error has occurred', 0, $e);
		}
	}
	
	public function get_int($namespace, $key)
	{
		try
		{
			return (int)$this->data[$namespace][$key];
		}
		catch (Exception $e)
		{
			throw new Exception('An error has occurred', 0, $e);
		}
	}
	
	public function get_double($namespace, $key)
	{
		try
		{
			return (double)$this->data[$namespace][$key];
		}
		catch (Exception $e)
		{
			throw new Exception('An error has occurred', 0, $e);
		}
	}
	
	public function get_float($namespace, $key)
	{
		try
		{
			return (float)$this->data[$namespace][$key];
		}
		catch (Exception $e)
		{
			throw new Exception('An error has occurred', 0, $e);
		}
	}
	
	public function destruct()
	{ }
}

$config = new config();