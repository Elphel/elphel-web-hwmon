<?php
/**
 * @file hwmon.php
 * @brief temperature monitor backend
 * @copyright Copyright (C) 2017 Elphel Inc.
 * @author Oleg Dzhimiev <oleg@elphel.com>
 *
 * @par <b>License</b>:
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

if (isset($_GET['cmd']))
	$cmd = $_GET['cmd'];
else
	$cmd = "t";

if ($cmd=="t"){
	$t_cpu = file_get_contents("/tmp/core_temp");
	$t_10389 = "";
	$t_sda = "";
	$t_sdb = "";
	
	$temp1_input = "/sys/devices/soc0/amba@0/e0004000.ps7-i2c/i2c-0/0-001a/hwmon/hwmon0/temp1_input";
	
	if (is_file($temp1_input)){
		$t_10389 = trim(file_get_contents($temp1_input));
		$t_10389 = intval($t_10389)/1000;
	}
	
	//$t_sda = exec("smartctl -A /dev/sda | egrep ^194 | awk '{print $10}'");
	$t_sda = "";
	if ($t_sda=="") $t_sda = "-";
	else            $t_sda = intval($t_sda);
	
	//$t_sdb = exec("smartctl -A /dev/sdb | egrep ^194 | awk '{print $10}'");
	$t_sdb = "";
	if ($t_sdb=="") $t_sdb = "-";
	else            $t_sdb = intval($t_sdb);
	
	echo "$t_cpu $t_10389 $t_sda $t_sdb";
}

if ($cmd=="read"){
	echo file_get_contents("/tmp/core_temp_params");
}

if ($cmd=="write"){
	$cstr = "";
	foreach($_GET as $key => $val){
		if(strpos($key,"temp")===0){
			$cstr .= "$key:$val\n";
		}
	}
	file_put_contents("/tmp/core_temp_params",$cstr);
	echo "$cstr";
}

?> 
