<?php 
session_start();
ob_start();
include("../../includes/config.inc.php");
include("../../includes/useAVclass.php");
@extract($_GET);
@extract($_POST);
@extract($_SESSION);
$useAVclass = new useAVclass();
$useAVclass->connection();
$_SESSION['user'];
?>
<div class="frm_row"> <span class="label1">
                    <label for="menucategory">Primary Link:</label>
                    <span class="star">*</span></span> <span class="input1">
                    
            <?php
$nav_query = mysqli_query($conn,"select * from menu where approve_status='3' and m_flag_id='0' and language_id='$language'");
//echo "select * from menu where approve_status='3' and m_flag_id='0' and language_id='$language' and module_id='".$_SESSION['user']."'";
//echo "select * from menu where approve_status='3' and m_flag_id='0' and language_id='$language'";
$tree = "";                         // Clear the directory tree
$depth = 1;                         // Child level depth.
$top_level_on = 1;               // What top-level category are we on?
$exclude = array();               // Define the exclusion array
array_push($exclude, 0);     // Put a starting value in it
 $tree = '<option value ="0">It is Root Category</option>'; 
while ($nav_row = mysqli_fetch_array($nav_query) )
{
     $goOn = 1;               // Resets variable to allow us to continue building out the tree.
     for($x = 0; $x < count($exclude); $x++ )          // Check to see if the new item has been used
     {
          if ( $exclude[$x] == $nav_row['m_id'] )
          {
               $goOn = 0;
               break;                    // Stop looking b/c we already found that it's in the exclusion list and we can't continue to process this node
          }
     }
     if ( $goOn == 1 )
     {
	      $tree .= '<strong><option value="'.$nav_row['m_id'].'">&nbsp;'.$nav_row['m_name'].'</option></strong>';                    // Process the main tree node
          array_push($exclude, $nav_row['m_id']);          // Add to the exclusion list
          if ( $nav_row['m_id'] < 6 )
          { $top_level_on = $nav_row['m_id']; }
 
          $tree .= build_child($nav_row['m_id']);          // Start the recursive function of building the child tree
     }
}

 
function build_child($oldID)               // Recursive function to get all of the children...unlimited depth
{
     require('../../includes/connection.php');
     GLOBAL $exclude, $depth;               // Refer to the global array defined at the top of this script
     $child_query = mysqli_query($conn,"select * from menu where approve_status='3' and m_flag_id='$oldID'");
	 //echo "select * from menu where approve_status='3' and m_flag_id='$oldID'";
     while ( $child = mysqli_fetch_array($child_query) )
     {
	     //echo $child['m_id'];
          if ( $child['m_id'] != $child['m_flag_id'] )
          {
		  
               for ( $c=0;$c<$depth;$c++ )               // Indent over so that there is distinction between levels
               { $temp.= "&nbsp;&nbsp;&nbsp;"; }
           		  
			  $tempTree.='<option value="'.$child['m_id'].'">'.$temp.'--'.$child['m_name'].'</option>';
			  // <option value="'.$nav_row['division_id'].'">'.$nav_row['menu_name'].'</option>
               $depth++;          // Incriment depth b/c we're building this child's child tree  (complicated yet???)
               $tempTree .= build_child($child['m_id']);          // Add to the temporary local tree
               $depth--;  
			   $temp='';        // Decrement depth b/c we're done building the child's child tree.
               array_push($exclude, $child['m_id']);               // Add the item to the exclusion list
          }
     }
 
     return $tempTree;          // Return the entire child tree
}

echo '<select name="menucategory" id="menucategory">'.$tree.'</select>';

?>

                    </span>
                    <div class="clear"></div>
                    </div>




					
					
