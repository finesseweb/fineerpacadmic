<?php
/**********************************************************************
  
	Released underhe GNU General Public License, GPL, 
	as published by the Free Software Foundation, either version 3 
	of the License, or (at your option) any later version.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
    See the License here <http://www.gnu.org/licenses/gpl-3.0.html>.
***********************************************************************/
//-----------------------------------------------------------------------------
//
//	Entry/Modify Sales Quotations
//	Entry/Modify Sales Order
//	Entry Direct Delivery
//	Entry Direct Invoice
//

$path_to_root = "../..";

include($path_to_root . "/includes/session.inc");
//include($path_to_root . "/includes/ui.inc");
$cat  = $_POST['cat'];
$sub_cat  = $_POST['sub_cat'];
//display_error($sub_cat);
?>

 <?php $sql="SELECT u.freq_id,f.freq_id as frq_id,f.frequency_name FROM ".TB_PREF."utility u  join fa_frequency_master f on u.freq_id=f.freq_id WHERE u.sub_cat_id = ".db_escape($sub_cat)." and u.category_id=".db_escape($cat);
//display_error($sql);
 $res = db_query($sql);
echo "<option value=''>--Select--</option>";
 while($row = db_fetch($res)){ ?>
 <option value="<?php echo $row['freq_id']; ?>"><?php echo $row['frequency_name']; ?></option>
 <?php   //echo $row['sub_cat_name'];
 }
 
 ?>