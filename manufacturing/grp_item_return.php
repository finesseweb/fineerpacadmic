<?php
/**********************************************************************
    Copyright (C) FrontAccounting, LLC.
	Released under the terms of the GNU General Public License, GPL, 
	as published by the Free Software Foundation, either version 3 
	of the License, or (at your option) any later version.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
    See the License here <http://www.gnu.org/licenses/gpl-3.0.html>.
***********************************************************************/
$page_security = 'SA_MANUFISSUE';
$path_to_root = "..";

include_once($path_to_root . "/includes/ui/items_cart.inc");

include_once($path_to_root . "/includes/session.inc");

include_once($path_to_root . "/includes/date_functions.inc");
include_once($path_to_root . "/includes/data_checks.inc");

include_once($path_to_root . "/manufacturing/includes/manufacturing_db.inc");
include_once($path_to_root . "/managements/includes/db/statutory_db.inc");
include_once($path_to_root . "/manufacturing/includes/manufacturing_ui.inc");
include_once($path_to_root . "/manufacturing/includes/work_order_issue_ui.inc");
$js = "";
if ($SysPrefs->use_popup_windows)
	$js .= get_js_open_window(800, 500);
if (user_use_date_picker())
	$js .= get_js_date_picker();

page(_($help_context = "Issue Items to Seat"), false, false, "", $js);

//-----------------------------------------------------------------------------------------------

if (isset($_GET['AddedID'])) 
{
	$id = $_GET['AddedID'];
   	display_notification(_("The Floor Item has been Issued."));
// display_note(get_trans_view_str(ST_FLOOR, $id, _("View this Floor items")));

//   	hyperlink_no_params("search_work_orders.php", _("Select another &Work Order to Process"));
handle_new_order();
	//display_footer_exit();
}
//--------------------------------------------------------------------------------------------------

function line_start_focus() {
  global 	$Ajax;

  $Ajax->activate('items_table');
  set_focus('_stock_id_edit');
}

//--------------------------------------------------------------------------------------------------
//$_GET['trans_no'] = 6;
$_POST['IssueType'] = 0;

function handle_new_order()
{
	if (isset($_SESSION['issue_items']))
	{
		$_SESSION['issue_items']->clear_items();
		unset ($_SESSION['issue_items']);
	}
     $_SESSION['issue_items'] = new items_cart(ST_MANUISSUE);
     $_SESSION['issue_items']->order_id = 0;
}

//-----------------------------------------------------------------------------------------------
function can_process()
{
	if (!is_date($_POST['date_']))
	{
		display_error(_("The entered date for the issue is invalid."));
		set_focus('date_');
		return false;
	} 
	elseif (!is_date_in_fiscalyear($_POST['date_']))
	{
		display_error(_("The entered date is out of fiscal year or is closed for further data entry."));
		set_focus('date_');
		return false;
	}
// 	if (!check_reference($_POST['ref'], ST_MANUISSUE))
// 	{
// 		set_focus('ref');
// 		return false;
// 	}

	$failed_item = $_SESSION['issue_items']->check_qoh($_POST['Location'], $_POST['date_'], !$_POST['IssueType']);
	if ($failed_item)
	{
   		display_error(_("The issue cannot be processed because it would cause negative inventory balance for marked items as of document date or later."));
		return false;
	}

	return true;
}

if (isset($_POST['addissue']) && can_process())
{

	$failed_data = add_building_issues($_POST['seat'],
		$_POST['ref'], 0, $_SESSION['issue_items']->line_items,
		$_POST['Location'], $_POST['WorkCentre'], $_POST['date_'], $_POST['memo_'],$_POST['sl_no'],"S");

	if ($failed_data != null) 
	{
		display_error(_("The process cannot be completed because there is an insufficient total quantity for a component.") . "<br>"
		. _("Component is :"). $failed_data[0] . "<br>"
		. _("From location :"). $failed_data[1] . "<br>");
	} 
	else 
	{
		meta_forward($_SERVER['PHP_SELF'], "AddedID=".$_POST['floor']);
	}

} /*end of process credit note */

//-----------------------------------------------------------------------------------------------

function check_item_data()
{
   // display_error(check_issues_serial());
    if(check_issues_serial($_POST['sl_no'])){
        display_error(_("this serial no already exist !"));
        return false;
    }
	if (input_num('qty') == 0 || !check_num('qty', 0))
	{
		display_error(_("The quantity entered is negative or invalid."));
		set_focus('qty');
		return false;
	}

	if (!check_num('std_cost', 0))
	{
		display_error(_("The entered standard cost is negative or invalid."));
		set_focus('std_cost');
		return false;
	}

   	return true;
}

//-----------------------------------------------------------------------------------------------

function handle_update_item()
{
    if($_POST['UpdateItem'] != "" && check_item_data())
    {
		$id = $_POST['LineNo'];
    	$_SESSION['issue_items']->update_cart_item($id, input_num('qty'), input_num('std_cost'),$_POST['sl_no']);
    }
	line_start_focus();
}

//-----------------------------------------------------------------------------------------------

function handle_delete_item($id)
{
	$_SESSION['issue_items']->remove_from_cart($id);
	line_start_focus();
}

//-----------------------------------------------------------------------------------------------

function handle_new_item()
{
	if (!check_item_data())
		return;
	add_to_issuem($_SESSION['issue_items'], $_POST['stock_id'], input_num('qty'),
		 input_num('std_cost'),$_POST['sl_no']);
        
	line_start_focus();
}

//-----------------------------------------------------------------------------------------------
$id = find_submit('Delete');
if ($id != -1)
	handle_delete_item($id);

if (isset($_POST['AddItem']))
	handle_new_item();

if (isset($_POST['UpdateItem']))
	handle_update_item();

if (isset($_POST['CancelItemChanges'])) {
	line_start_focus();
}

//-----------------------------------------------------------------------------------------------

if (!isset($_SESSION['issue_items']))
{
	handle_new_order();
}

//-----------------------------------------------------------------------------------------------

///display_wo_details($_SESSION['issue_items']->order_id);
echo "<br>";

start_form();
display_date_manuf();

div_start('controls', 'items_table');
display_grp_returned($_POST['from_date'],$_POST['to_date']);
div_end();
$Ajax->activate('items_table');
echo "<br>";
start_table(TABLESTYLE, "width='90%'", 10);
echo "<tr><td>";
//display_issue_itemsm(_("Items to Issue"), $_SESSION['issue_items']);
//issue_options_controlsm();
echo "</td></tr>";

end_table();

//submit_center('addissue', _("ADD Issue"), true, '', 'default');

end_form();

//------------------------------------------------------------------------------------------------

end_page();

