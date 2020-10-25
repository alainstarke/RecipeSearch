<?php 
// 		create_table.php create a mouselabWEB table 
//
//       v 2.00, Nov 2017
//
//     (c) 2003-2017 Martijn C. Willemsen and Eric J. Johnson 
//
//    This program is free software; you can redistribute it and/or modify
//    it under the terms of the GNU General Public License as published by
//    the Free Software Foundation; either version 2 of the License, or
//    (at your option) any later version.
//
//    This program is distributed in the hope that it will be useful,
//    but WITHOUT ANY WARRANTY; without even the implied warranty of
//    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//    GNU General Public License for more details.
//
//    You should have received a copy of the GNU General Public License
//    along with this program; if not, write to the Free Software
//    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

include('mlwebdb.inc.php');
$sqlquery = "CREATE TABLE IF NOT EXISTS `exps` (
  `expname` varchar(50) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `subject` varchar(30) DEFAULT NULL,
  `seqno` int(11) DEFAULT NULL,
  `starttime` datetime DEFAULT NULL
)";
$result=mysqli_query($link,$sqlquery) or die("Invalid Query : ".mysqli_error($link)); 
echo('exps Table created');
mysqli_close($link);
?>
