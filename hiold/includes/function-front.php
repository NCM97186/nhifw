<?php

date_default_timezone_set('Asia/Calcutta');

class funtion_lib
{

	
/** custom function for used *********************************************************************************************************************

****************************************************************** custom funtion for used ************************************************************

****************************************************************** custom funtion for used ************************************************************/

function checkTableRow($table)
{
	require("includes/connection.php");
	$sql =mysqli_query($conn,"select * from $table");

	if(mysqli_num_rows($sql)>0)
	{
		return mysqli_num_rows($sql);
	}
	else
	{
		return 0;
	}

}

function countTableRow($table,$id,$value)
{
	require("includes/connection.php");
 	$sql =mysqli_query($conn,"select * from $table where $id='$value'");
 	
   //echo $sql;
   
	if(mysqli_num_rows($sql)>0){

		return mysqli_num_rows($sql);

	}
	else{

		return 0;
	}
}


function countTableRowWhereClause($table,$whereClause){
	require_once "includes/connection.php";
	global $conn;
	//echo "select * from $table where $whereClause "; 
	$sql = mysqli_query($conn,"select * from $table where $whereClause ");
 

	if(mysqli_num_rows($sql)>0){

		return mysqli_num_rows($sql);

	}
	else{

		return 0;
	}
}

function countTableTwoRow($table,$id1,$value1,$id2,$value2){
	require("includes/connection.php");
  // echo "select * from $table where $id1='$value1' or $id2='$value2'";
	$sql =mysqli_query($conn,"select * from $table where $id1='$value1' or $id2='$value2'");

	if(mysqli_num_rows($sql)>0){

		return mysqli_num_rows($sql);

	}
	else{

		return 0;
	}
}

function checkTable_OneRow($table,$id,$value)
{
	require("includes/connection.php");
	$sql =mysqli_query($conn,"select * from $table where $id='$value'");
	//echo "select * from $table where $id='$value'";
	if(mysqli_num_rows($sql)>0)
	{
		return 1;
	}
	else
	{
		return 0;
	}

}


function checkTable_TwoRow($table,$id,$value,$id1,$value1)
{
	require("includes/connection.php");
 	$sql =mysqli_query($conn,"select * from $table where $id='$value' and $id1='$value1'");
	
	if(mysqli_num_rows($sql)>0)
	{
		return 1;
	}
	else
	{
		return 0;
	}

}


function checkRecord_notEqRow($table,$eid,$evalue,$nid,$nvalue)
{
	require("includes/connection.php");
	$sql =mysqli_query($conn,"select * from $table where $eid='$evalue' and $nid!='$nvalue'");
	
	if(mysqli_num_rows($sql)>0)
	{
		return 1;
	}
	else
	{
		return 0;
	}

}

function checkTable_threeRow($table,$id,$value,$id1,$value1,$id2,$value2)
{
	
	require("includes/connection.php");
	
	// echo "SELECT * FROM $table WHERE $id='$value' AND $id1='$value1' AND $id2='$value2'"; 

	$sql = mysqli_query($conn,"SELECT * FROM $table WHERE $id='$value' AND $id1='$value1' AND $id2='$value2'");


	if(mysqli_num_rows($sql)>0)
	{
		return 1;
	}
	else
	{
		return 0;
	}


}

function getstate_Rows($table,$order,$chk)
{
	require("includes/connection.php");
	$sql =mysqli_query($conn,"select * from $table order by $order $chk");

	//echo "select * from $table";

	if(mysqli_num_rows($sql)>0)
	{
		while($row = mysqli_fetch_assoc($sql))
		{
			$rows[] = $row;
		}
		
		return $rows;
		
	}
	else
	{
		return 0;
	}

}


function gettable_OneRow($table,$id,$value)
{
	require("includes/connection.php");
	$sql =mysqli_query($conn,"select * from $table where $id='$value'");
	//echo "select * from $table where $id='$value'"; 
	if(mysqli_num_rows($sql)>0)
	{
		$row = mysqli_fetch_assoc($sql);
		
		return $row;
	}
	else
	{
		return 0;
	}

}

function gettable_Rows_where($table,$id,$value)
{
	require("includes/connection.php");
 //echo "select * from $table where $id='$value'"; 
  $sql =mysqli_query($conn,"select * from $table where $id='$value'");

	if(mysqli_num_rows($sql)>0)
	{
		while($row = mysqli_fetch_assoc($sql))
		{
			$rows[] = $row;
		}
		
		return $rows;
	}
	else
	{
		return 0;
	}

}


function checktable_Rows_where($table,$id,$value)
{
	require("includes/connection.php");
	$sql =mysqli_query($conn,"select * from $table where $id='$value'");
	if(mysqli_num_rows($sql)>0)
	{
		return mysqli_num_rows($sql);
	}
	else
	{
		return 0;
	}

}



function gettable_RowsTwoColumn_where($table,$id,$value,$id1,$value1)
{
	require("includes/connection.php");
	$sql =mysqli_query($conn,"select * from $table where $id='$value' and $id1='$value1'");
	//echo "select * from $table where $id='$value' and $id1='$value1'";
	
	if(mysqli_num_rows($sql)>0)
	{
		while($row = mysqli_fetch_assoc($sql))
		{
			$rows[] = $row;
		}
		
		return $rows;
	}
	else
	{
		return 0;
	}

}

function gettable_search_Rows_TwoColumn_where($table,$id,$value,$id1,$value1)
{
	require("includes/connection.php");
	$sql =mysqli_query($conn,"select * from $table where $id='$value' and $id1 like '%$value1%'");
	//echo "select * from $table where $id='$value' and $id1='$value1'";
	
	if(mysqli_num_rows($sql)>0)
	{
		while($row = mysqli_fetch_assoc($sql))
		{
			$rows[] = $row;
		}
		
		return $rows;
	}
	else
	{
		return 0;
	}

}

function gettable_search_Rows_ThreeColumn_where($table,$id,$value,$id1,$value1,$id2,$value2)
{
	require("includes/connection.php");
	$sql =mysqli_query($conn,"select * from $table where $id='$value' and $id1='$value1' and $id2 like '%$value2%'");
	//echo "select * from $table where $id='$value' and $id1='$value1'";
	
	if(mysqli_num_rows($sql)>0)
	{
		while($row = mysqli_fetch_assoc($sql))
		{
			$rows[] = $row;
		}
		
		return $rows;
	}
	else
	{
		return 0;
	}

}


function gettable_RowsthreeColumn_where($table,$id,$value,$id1,$value1 ,$id2,$value2)
{
	
	require("includes/connection.php");

	$sql =mysqli_query($conn,"SELECT * FROM $table WHERE $id='$value' AND $id1='$value1' AND $id2='$value2'");
//	echo "select * from $table where $id='$value' and $id1='$value1' and $id2='$value2'";
	if(mysqli_num_rows($sql)>0)
	{
		while($row = mysqli_fetch_assoc($sql))
		{
			$rows[] = $row;
		}
		
		return $rows;
	}
	else
	{
		return 0;
	}

}

function gettable_RowsfourColumn_where($table,$id,$value,$id1,$value1 ,$id2,$value2 ,$id3,$value3)
{
	require("includes/connection.php");

	$sql =mysqli_query($conn,"select * from $table where $id='$value' and $id1='$value1' and $id2='$value2' and $id3='$value3'");
	//echo "select * from $table where $id='$value' and $id1='$value1' and $id2='$value2' and $id3='$value3'";
	
	if(mysqli_num_rows($sql)>0)
	{
		while($row = mysqli_fetch_assoc($sql))
		{
			$rows[] = $row;
		}
		
		return $rows;
	}
	else
	{
		return 0;
	}

}

function gettable_RowsthreeColumn1_where($table,$id,$value,$id1,$value1 ,$id2,$value2,$id3,$value3)
{
	require("includes/connection.php");
	$sql =mysqli_query($conn,"select * from $table where $id='$value' and $id1='$value1' and $id2='$value2' and $id3='$value3' order by page_postion Asc");
	//echo "select * from $table where $id='$value' and $id1='$value1' and $id2='$value2' and $id3='$value3' order by page_postion Asc";
	
	if(mysqli_num_rows($sql)>0)
	{
		while($row = mysqli_fetch_assoc($sql))
		{
			$rows[] = $row;
		}
		
		return $rows;
	}
	else
	{
		return 0;
	}

}

function gettable_Rows($table)
{
	require("includes/connection.php");
	//echo "select * from $table"; die;
	$sql =mysqli_query($conn,"select * from $table");

	if(mysqli_num_rows($sql)>0)
	{
		while($row = mysqli_fetch_assoc($sql))
		{
			$rows[] = $row;
		}
		
		return $rows;
		
	}
	else
	{
		return 0;
	}

}


function gettable_Rows_limit($table,$first,$secand){
	require("includes/connection.php");
	$sql =mysqli_query($conn,"select * from $table Orders  limit $first,$secand");

	if(mysqli_num_rows($sql)>0)
	{
		while($row = mysqli_fetch_assoc($sql))
		{
			$rows[] = $row;
		}
		
		return $rows;
		
	}
	else
	{
		return 0;
	}

}

function gettable_Rows_order($table,$fields,$asc)
{
	require("includes/connection.php");
	$sql =mysqli_query($conn,"select * from $table order by $fields $asc");

	if(mysqli_num_rows($sql)>0)
	{
		while($row = mysqli_fetch_assoc($sql))
		{
			$rows[] = $row;
		}
		
		return $rows;
		
	}
	else
	{
		return 0;
	}

}



function gettable_RowswithLikeCount($table,$fieldName,$value)
{
	require("includes/connection.php");
	$sql =mysqli_query($conn,"select * from $table where $fieldName like '" .$value . "%' ");
	$rows=mysqli_num_rows($sql);
	return $rows;
}



function gettable_Rows1_where($table,$id,$value)
{
	require("includes/connection.php");
	$sql =mysqli_query($conn,"select * from $table where $id='$value' order by suc_sto_id desc ");	
	if(mysqli_num_rows($sql)>0)
	{
		while($row = mysqli_fetch_assoc($sql))
		{
			$rows[] = $row;
		}
		
		return $rows;
	}
	else
	{
		return 0;
	}

}


function gettable_RowswithLike($table,$fieldName,$value)
{
	require("includes/connection.php");
	$sql =mysqli_query($conn,"select * from $table where $fieldName like '" .$value . "%' ");

	if(mysqli_num_rows($sql)>0)
	{
		while($row = mysqli_fetch_assoc($sql))
		{
			$rows[] = $row;
		}
		
		return $rows;
	}
	else
	{
		return 0;
	}

}



function dbRowInsert($table_name, $form_data)
{
	require("includes/connection.php");
    // retrieve the keys of the array (column titles)
	$fields = array_keys($form_data);

    // build the query
	$sql = "INSERT INTO ".$table_name."
	(`".implode('`,`', $fields)."`)
	VALUES('".implode("','", $form_data)."')";
    
    	echo $sql; 
//die;
    // run and return the query result resource
	if(mysqli_query($conn,$sql))
	{
		return mysqli_insert_id();
	}
	else
	{
		return 0;
	}

}


function dbRowUpdate($table_name, $form_data, $where_clause='')
{
	require("includes/connection.php");
    // check for optional where clause
	$whereSQL = '';
	if(!empty($where_clause))
	{
        // check to see if the 'where' keyword exists
		if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
		{
            // not found, add key word
			$whereSQL = " WHERE ".$where_clause;
		} else
		{
			$whereSQL = " ".trim($where_clause);
		}
	}
    // start the actual SQL statement
	 $sql = "UPDATE ".$table_name." SET ";

    // loop and build the column /
	$sets = array();
	foreach($form_data as $column => $value)
	{
		$sets[] = "`".$column."` = '".$value."'";
	}
	$sql .= implode(', ', $sets);

    // append the where statement
	 $sql .= $whereSQL;
//echo $sql;
//die;

    // run and return the query result
	if(mysqli_query($conn,$sql))
	{
		return 1;
	}
	else
	{
		return 0;
	}
}


function dbRowDelete($table_name, $where_clause='')
{
	require("includes/connection.php");
    // check for optional where clause
	$whereSQL = '';
	if(!empty($where_clause))
	{
        // check to see if the 'where' keyword exists
		if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
		{
            // not found, add keyword
			$whereSQL = " WHERE ".$where_clause;
		}else
		{
			$whereSQL = " ".trim($where_clause);
		}
	}
    // build the query
	$sql = "DELETE FROM ".$table_name.$whereSQL;
    //echo $sql; die;
    // run and return the query result resource
	if(mysqli_query($conn,$sql))
	{
		return 1;
	}
	else
	{
		return 0;
	}

}

function validate_email($email)
{
	require("includes/connection.php");
	$pattern = '/^[A-z0-9_\-.]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z.]{1,4}$/';
	
	if(preg_match($pattern, $email))
	{
		return 1;
	}
	else
	{
		return 0; 
	}

}


function pin_number($pin)
{
	require("includes/connection.php");
	$pattern = '/^\d{6,}$$/';

	if(preg_match($pattern, $pin))
	{
		return 1;
	}
	else
	{
		return 0; 
	}

}


function conatct_number($contact_number)
{
	$pattern = '/^\d{10,}$$/';

	if(preg_match($pattern, $contact_number))
	{
		return 1;
	}
	else
	{
		return 0; 
	}

}


function compareDate_Current($date,$format='m/d/y')
{
	if(strtotime(date('m/d/y'))>=strtotime($date))
	{
		return 1;  
	}
	else{return 0;} 
}


function compareDates($fdate,$ldate,$format='m/d/y')
{
	if(strtotime($ldate)>=strtotime($fdate))
	{
		return 1;  
	}
	else{return 0;} 
}


function calYear($fdate,$ldate,$format='m/d/y')
{
	$diff = strtotime($ldate)-strtotime($fdate);
	$year = $diff/(60*60*24*365);
	return $year;
}




function calMonth($fdate,$ldate,$format='m/d/y')
{
	$diff = strtotime($ldate)-strtotime($fdate);
	$month = number_format(($diff/(60*60*24*30)));
	if($month>0){ return $month; }else{ return 0;}

}



function calculaterange($fdate,$ldate,$format='m/d/y')
{
	if(strtotime(date('m/d/y'))<=strtotime($date))
	{
		$diff = strtotime($date)-strtotime(date('m/d/y'));
		$days = number_format(($diff/(60*60*24)));
		return $days; 
	}
	else{return 0;} 

}



function dayCompareDate_Current($date,$format='m/d/y')
{
	if(strtotime(date('m/d/y'))<=strtotime($date))
	{
		$diff = strtotime($date)-strtotime(date('m/d/y'));
		$days = number_format(($diff/(60*60*24)));
		return $days; 
	}
	else{return 0;} 
}

function ExpiryCompare($date,$format='m/d/y'){
	if(strtotime(date('m/d/y'))>=strtotime($date)){
		$diff = strtotime($date)-strtotime(date('m/d/y'));
		$days = number_format(($diff/(60*60*24)));
		return $days; 
	}
	else{return 0;} 
}



function getCountTable_OneRow($table,$id,$value)
{
	require("includes/connection.php");
	$sql =mysqli_query($conn,"select * from $table where $id='$value'");
	
	if(mysqli_num_rows($sql)>0)
	{
		$count = mysqli_num_rows($sql);
		return $count;
	}
	else
	{
		return 0;
	}

}


function uploads_file($file_id, $folder="", $types="",$ref_name) { 
	require("includes/connection.php");
	if(!$_FILES[$file_id]['name']){ $result = 'fl_empty'; return $result;}else{

		$file_title = $_FILES[$file_id]['name'];
    //Get file extension
		$ext_arr = explode(".",$file_title);
    $ext = end($ext_arr); //Get the last extension

    //Not really uniqe - but for all practical reasons, it is
    //$uniqer = substr(md5(uniqid(rand(),1)),0,5);
    $file_name = $ref_name .'.'.$ext;//Get Unique Name

    $all_types = explode(",",strtolower($types));  
    
    if($types) 
    {
    	if(!in_array($ext,$all_types))
    	{
            $result = 'ext_error'; //Show error if any.
            return $result;
            //exit;
        }
    }

    //Where the file must be uploaded to
    if($folder) $folder .= '/';  //Add a '/' at the end of the folder
    $uploadfile = $folder . $file_name;

    //$result = '';
    //Move the file from the stored location to the new location
    
    if (!move_uploaded_file($_FILES[$file_id]['tmp_name'], $uploadfile)) 
    {
        $result = 'fl_nupload'; //exit; //Show error if any.
        
        if(!file_exists($folder)) {
            $result = "fldr_nexists"; //exit;
            
        } elseif(!is_writable($folder)) {
            $result = "fldr_nwrite"; //exit;
            
        } elseif(!is_writable($uploadfile)) {
            $result = "fl_nwrite";  //exit;
        }
        
        //$file_name = '';
        
    } 
    else 
    {
    	if(!$_FILES[$file_id]['size']) 
        { //Check if the file is made
            @unlink($uploadfile);//Delete the Empty file
            //$file_name = '';
            $result = "fl_empty";  //exit; //Show the error message
        } 
        else 
        {
            chmod($uploadfile,0777);//Make it universally writable.
            $result = 1;
        }
    }

    return $result;

}
}


function numbertoword( $num = '' )
{
	require("includes/connection.php");
	/*$num    = ( string ) ( ( int ) $num );

	if( ( int ) ( $num ) && ctype_digit( $num ) )
	{
		$words  = array( );

		$num    = str_replace( array( ',' , ' ' ) , '' , trim( $num ) );

		$list1  = array('','one','two','three','four','five','six','seven',
			'eight','nine','ten','eleven','twelve','thirteen','fourteen',
			'fifteen','sixteen','seventeen','eighteen','nineteen');

		$list2  = array('','ten','twenty','thirty','forty','fifty','sixty',
			'seventy','eighty','ninety','hundred');

		$list3  = array('','thousand','million','billion','trillion',
			'quadrillion','quintillion','sextillion','septillion',
			'octillion','nonillion','decillion','undecillion',
			'duodecillion','tredecillion','quattuordecillion',
			'quindecillion','sexdecillion','septendecillion',
			'octodecillion','novemdecillion','vigintillion');

		$num_length = strlen( $num );
		$levels = ( int ) ( ( $num_length + 2 ) / 3 );
		$max_length = $levels * 3;
		$num    = substr( '00'.$num , -$max_length );
		$num_levels = str_split( $num , 3 );

		foreach( $num_levels as $num_part )
		{
			$levels--;
			$hundreds   = ( int ) ( $num_part / 100 );
			$hundreds   = ( $hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ( $hundreds == 1 ? '' : 's' ) . ' ' : '' );
			$tens       = ( int ) ( $num_part % 100 );
			$singles    = '';

			if( $tens < 20 )
			{
				$tens   = ( $tens ? ' ' . $list1[$tens] . ' ' : '' );
			}
			else
			{
				$tens   = ( int ) ( $tens / 10 );
				$tens   = ' ' . $list2[$tens] . ' ';
				$singles    = ( int ) ( $num_part % 10 );
				$singles    = ' ' . $list1[$singles] . ' ';
			}
			$words[]    = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_part ) ) ? ' ' . $list3[$levels] . ' ' : '' );
		}

		$commas = count( $words );

		if( $commas > 1 )
		{
			$commas = $commas - 1;
		}

		$words  = implode( ', ' , $words );

			//Some Finishing Touch
			//Replacing multiples of spaces with one space
		$words  = trim( str_replace( ' ,' , ',' , trim( ucwords( $words ) ) ) , ', ' );
		if( $commas )
		{
			$words  = str_replace( ',' , ' and' , $words );
		}

		return $words;
	}
	else if( ! ( ( int ) $num ) )
	{
		return 'Zero';
	}
	return ''; */
	
   $no = (int)$num;
	$words = array('0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five','6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten','11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen','16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty','30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy','80' => 'eighty','90' => 'ninty','100' => 'hundred','1000' => 'thousand','100000' => 'lakh','10000000' => 'crore','1000000000' => 'arab');
        if($no == 0)
            return '';
        else {
    	$novalue='';
    	$highno=$no;
    	$remainno=0;
    	$value=100;
    	$value1=1000;
    	      
               while($no>=100)
                {
                    if(($value <= $no) &&($no < $value1))
                    {   
					   $novalue=$words["$value"];
						$highno = (int)($no/$value);
						$remainno = $no % $value;
						break;
                    }
                    
                    $value= $value1;
                    $value1 = $value * 100;
                  
                }  
                
              if(array_key_exists("$highno",$words)){
                  return $words["$highno"]." ".$novalue." ".$this->numbertoword($remainno);
              }else{
                 $unit=$highno%10;
                 $ten =(int)($highno/10)*10;            
                 return $words["$ten"]." ".$words["$unit"]." ".$novalue." ".$this->numbertoword($remainno);
               }
        }
	
	

}

function getEXtension($file_name)
{
	$ext_arr = explode(".",$file_name);
        $ext = end($ext_arr); //Get the last extension
        return $ext;
    }

function getFilename($file_name){
	require("includes/connection.php");
    $name_array =  explode(".",$file_name);

      $name = $name_array['0']; //file name without extention
      return  $name;

}    


    function gettable_Rows_OrderLimit_where($table,$id,$value,$id1,$value1,$asc_dsc,$id2,$start,$end)
    {
		require("includes/connection.php");
    	$sql =mysqli_query($conn,"select * from  $table where $id='$value' and $id1='$value1' order by $asc_dsc $id2  limit $start,$end");

    	if(mysqli_num_rows($sql)>0)
    	{
    		while($row = mysqli_fetch_assoc($sql))
    		{
    			$rows[] = $row;
    		}

    		return $rows;
    	}
    	else
    	{
    		return 0;
    	}

    }

    function gettable_Rows_OrderLimit1_where($table,$id,$value,$asc_dsc,$id2,$start,$end)
    {
		require("includes/connection.php");
    	$sql =mysqli_query($conn,"select * from  $table where $id='$value'  order by $asc_dsc $id2  limit $start,$end");

    	if(mysqli_num_rows($sql)>0)
    	{
    		while($row = mysqli_fetch_assoc($sql))
    		{
    			$rows[] = $row;
    		}

    		return $rows;
    	}
    	else
    	{
    		return 0;
    	}

    }

    function gettable_RowsTwoColumn2_where($table,$id,$value,$id1,$value1)
    {
		require("includes/connection.php");
    	//echo "select * from $table where $id='$value' and $id1='$value1'"; die;
    	$sql =mysqli_query($conn,"select * from $table where $id='$value' and $id1='$value1'");
    	
    	if(mysqli_num_rows($sql)>0)
    	{
    		while($row = mysqli_fetch_assoc($sql))
    		{
    			$rows[] = $row;
    		}

    		return $rows;
    	}
    	else
    	{
    		return 0;
    	}

    }
	
	

    function filesizeMB($size,$mb,$sizeunit='Bytes')
    {
    	return ($size/1048576);
    } 

    function getLastRow($table)
    {
		require("includes/connection.php");
    	$sql =mysqli_query($conn,"select * from $table order by org_id desc limit 0,1");

    	if(mysqli_num_rows($sql)>0)
    	{
    		$row = mysqli_fetch_assoc($sql);
    		return $row;
    	}
    	else
    	{
    		return 0;
    	}
    }
	
	
	
	   function deleteOneRow($table,$roValue,$schemeValue){
		require("includes/connection.php");
		 $sql =mysqli_query($conn,"select * from $table where ro_id='$roValue' && scheme_id='$schemeValue'");
		 if(mysqli_num_rows($sql)>0){
    		$row = mysqli_fetch_assoc($sql);
    		    mysqli_query($conn,"delete from  $table where ro_id='$roValue' && scheme_id='$schemeValue'"); 
    	 } else {
    		return 0;
    	}
		 
	   }
	   
	   
	   function deleteRowWhere($table,$schemeid,$schemevalue){
		require("includes/connection.php");
		 $sql =mysqli_query($conn,"select * from $table where $schemeid='$schemevalue' ");
		 if(mysqli_num_rows($sql)>0){
    		$row = mysqli_fetch_assoc($sql);
    		    mysqli_query($conn,"delete from  $table where $schemeid='$schemevalue' "); 
    	 } else {
    		return 0;
    	}
		 
	   }
	   
	   
	   function checkTableNotOneRow($table,$id,$value) {
		require("includes/connection.php");
	       $sql =mysqli_query($conn,"select * from $table where $id!='$value'");
	if(mysqli_num_rows($sql)>0) {
		return mysqli_num_rows($sql);
	} else {
		return 0;
	}

 }
	   
	   
	   function gettable_Rows_where_not_one($table,$id,$value){
		require("includes/connection.php");
         	$sql =mysqli_query($conn,"select * from $table where $id!='$value'");
 	        if(mysqli_num_rows($sql)>0){
		     while($row = mysqli_fetch_assoc($sql)){
			$rows[] = $row;
		     }
		   return $rows;
	  } else {
		return 0;
	}

   }

   function opt_number_check($otp){
	$pattern = '/^\d{6,}$$/';

	if(preg_match($pattern, $otp))
	{
		return 1;
	}
	else
	{
		return 0; 
	}

}


//get role name from role table

 function sendmassege($number,$msg){ 
	
	$apiUrl = "http://sms.mysmsapp.in/api/push?apikey=561747c6777d2&route=Trans1&sender=NCMSMS&mobileno=$number&text=$msg";
		$apiUrl = rtrim($apiUrl, "&");

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_URL, $apiUrl);

		curl_exec($ch);
		curl_close($ch);

	if($apiUrl){
		return 1;
	} else {
		return 0; 
	}

}



function sendmail($from_email,$from_email_cc,$user_name,$user_email,$scheme_name,$appid){
	
	require("includes/connection.php");
			 /* email receipt to nt and user */
			$mail = new PHPMailer();
			$mail->From = $from_email;
			$mail->FromName = "The National Trust";
			$mail->AddAddress($user_email, $user_name);
			$mail->AddCC($from_email_cc);
			$mail->Subject = "$scheme_name Registration";
			$mail->MsgHTML("<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
			<html xmlns='http://www.w3.org/1999/xhtml'>
			<head>
			<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
			<title>Scheme Registration Application</title>
			</head>
			<body>
			<table width='80%' border='0' cellspacing='0' cellpadding='0' align='center'>
			<tr>
			<td style='border:1px solid #CCC; padding:5px;'>
			<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center'>
			<tr>
			<td style='padding:10px;'><img src='$HomeURL/assets/images/logo.png' width='121' height='105' alt='' /></td>
			</tr>
			<tr>
			<td style='padding:10px; font-size:12px; font-family:Verdana, Geneva, 'Open Sans'; text-align:justify; line-height:18px; color:#404040; border-top:1px solid #930'>
			Dear ".$user_name."<br>
			Your ".$scheme_name." temporary application ID is <strong>".$appid."<br></strong>
			<br><br>Your application has been created for further processing of registration.<br><br>
			</td>
			</tr>
			<tr>
			<td style='padding:10px; font-size:12px; font-family:Verdana, Geneva, 'Open Sans'; text-align:justify; line-height:18px; color:#404040'><strong>Regards,</strong><br />
			<strong> The National Trust</strong>
			</td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			</tr>
			</table>
			</td>
			</tr>
			</table>
			</body>
			</html>");
			$mail->IsHTML(true); 
			// set email format to HTML
			//$mail->AddAttachment($target);
			if(!$mail->Send()){
			} 
}

function sendmail_ngo($from_email,$from_email_cc,$user_name,$user_email,$scheme_name,$regid,$pwd){
	require("includes/connection.php");
			
			 /* email receipt to nt and user */
			$mail = new PHPMailer();
			$mail->From = $from_email;
			$mail->FromName = "The National Trust";
			$mail->AddAddress($user_email, $user_name);
			$mail->AddCC($from_email_cc);
			$mail->Subject = "$scheme_name Registration";
			$mail->MsgHTML("<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
			<html xmlns='http://www.w3.org/1999/xhtml'>
			<head>
			<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
			<title>Scheme Registration Application</title>
			</head>
			<body>
			<table width='80%' border='0' cellspacing='0' cellpadding='0' align='center'>
			<tr>
			<td style='border:1px solid #CCC; padding:5px;'>
			<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center'>
			<tr>
			<td style='padding:10px;'><img src='$HomeURL/assets/images/logo.png' width='121' height='105' alt='' /></td>
			</tr>
			<tr>
			<td style='padding:10px; font-size:12px; font-family:Verdana, Geneva, 'Open Sans'; text-align:justify; line-height:18px; color:#404040; border-top:1px solid #930'>
			Dear ".$user_name."<br>
			Your ".$scheme_name." registration application has been approved.Registration ID is <strong>".$regid.".</strong>
			Use the registration id with Password ".$pwd. " for login on The National Trust website.
			<br><br>Your application has been created for further processing of registration.<br><br>
			</td>
			</tr>
			<tr>
			<td style='padding:10px; font-size:12px; font-family:Verdana, Geneva, 'Open Sans'; text-align:justify; line-height:18px; color:#404040'><strong>Regards,</strong><br />
			<strong> The National Trust</strong>
			</td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			</tr>
			</table>
			</td>
			</tr>
			</table>
			</body>
			</html>");
			$mail->IsHTML(true); 
			// set email format to HTML
			//$mail->AddAttachment($target);
			if(!$mail->Send()){
			} 
}


function sendmail_ngo_reject($from_email,$from_email_cc,$user_name,$user_email,$scheme_name){
	require("includes/connection.php");
			
			 /* email receipt to nt and user */
			$mail = new PHPMailer();
			$mail->From = $from_email;
			$mail->FromName = "The National Trust";
			$mail->AddAddress($user_email, $user_name);
			$mail->AddCC($from_email_cc);
			$mail->Subject = "$scheme_name Registration";
			$mail->MsgHTML("<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
			<html xmlns='http://www.w3.org/1999/xhtml'>
			<head>
			<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
			<title>Scheme Registration Application</title>
			</head>
			<body>
			<table width='80%' border='0' cellspacing='0' cellpadding='0' align='center'>
			<tr>
			<td style='border:1px solid #CCC; padding:5px;'>
			<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center'>
			<tr>
			<td style='padding:10px;'><img src='$HomeURL/assets/images/logo.png' width='121' height='105' alt='' /></td>
			</tr>
			<tr>
			<td style='padding:10px; font-size:12px; font-family:Verdana, Geneva, 'Open Sans'; text-align:justify; line-height:18px; color:#404040; border-top:1px solid #930'>
			Dear ".$user_name."<br>
			Your ".$scheme_name." registration application has been rejected
			</td>
			</tr>
			<tr>
			<td style='padding:10px; font-size:12px; font-family:Verdana, Geneva, 'Open Sans'; text-align:justify; line-height:18px; color:#404040'><strong>Regards,</strong><br />
			<strong> The National Trust</strong>
			</td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			</tr>
			</table>
			</td>
			</tr>
			</table>
			</body>
			</html>");
			$mail->IsHTML(true); 
			// set email format to HTML
			//$mail->AddAttachment($target);
			if(!$mail->Send()){
			} 
}


	
	function gettable_twocolumnoneRow($table,$id,$value,$id1,$value1)
	{
		require("includes/connection.php");
		$sql =mysqli_query($conn,"select * from $table where $id='$value' and $id1='$value1'");
		
		if(mysqli_num_rows($sql)>0)
		{
			$row = mysqli_fetch_assoc($sql);
			
			return $row;
		}
		else
		{
			return 0;
		}

	}
	
	
	function gettable_oneRowFields($table,$fields,$id,$value)
	{
		require("includes/connection.php");
		$sql = mysqli_query($conn,"select $fields from $table where $id='$value'");
		//echo "select $fields from $table where $id='$value'";
		
		if(mysqli_num_rows($sql)>0)
		{
			$row = mysqli_fetch_assoc($sql);
			
			return $row;
		}
		else
		{
			return 0;
		}

	}
	
	function gettable_Rows_where_asc($table,$id,$value,$fields,$asc)
	{
		require("includes/connection.php");
	  $sql =mysqli_query($conn,"select * from $table where $id='$value'  order by $fields $asc");
	//echo "select * from $table where $id='$value'  order by $fields $asc";

		if(mysqli_num_rows($sql)>0)
		{
			while($row = mysqli_fetch_assoc($sql))
			{
				$rows[] = $row;
			}
			
			return $rows;
		}
		else
		{
			return 0;
		}

	}

	


	function gettable_Rows_where_asc1($table,$id1,$value1,$value2,$id2,$value3,$value4,$fields,$asc)
	{
		require("includes/connection.php");
	  $sql =mysqli_query($conn,"select * from $table where $id1 IN ('$value1','$value2') and  $id2 IN('$value3','$value4')   order by $fields $asc");
	//echo "select * from $table where $id1 IN ('$value1','$value2') and  $id2 IN('$value3','$value4') order by $fields $asc";

		if(mysqli_num_rows($sql)>0)
		{
			while($row = mysqli_fetch_assoc($sql))
			{
				$rows[] = $row;
			}
			
			return $rows;
		}
		else
		{
			return 0;
		}

	}


	
	function gettable_Rows_where_asc_or_condition($table,$id,$value,$id1,$value1,$id2,$value2,$fields,$asc)
	{
		require("includes/connection.php");
	  $sql =mysqli_query($conn,"select * from $table where $id='$value' OR $id1='$value1' OR $id2='$value2' order by $fields $asc");
	//echo "select * from $table where $id='$value' OR $id1='$value1' OR $id2='$value2' OR $id3='$value3'  order by $fields $asc";

		if(mysqli_num_rows($sql)>0)
		{
			while($row = mysqli_fetch_assoc($sql))
			{
				$rows[] = $row;
			}
			
			return $rows;
		}
		else
		{
			return 0;
		}

	}


function gettable_Rows_where_asc_or($table,$id,$value,$id1,$value1,$id2,$value2,$fields,$asc)
	{
		require("includes/connection.php");
	  $sql =mysqli_query($conn,"select * from $table where $id2='$value2' and ($id='$value' OR  $id1='$value1') order by $fields $asc");
	  //echo "select * from $table where $id2='$value2' and ($id='$value' OR  $id1='$value1') order by $fields $asc";


		if(mysqli_num_rows($sql)>0)
		{
			while($row = mysqli_fetch_assoc($sql))
			{
				$rows[] = $row;
			}
			
			return $rows;
		}
		else
		{
			return 0;
		}

	}



	function gettable_Rows_where_asc2($table,$id,$value,$id1,$value1,$fields,$asc)
	{
		require("includes/connection.php");
	  $sql =mysqli_query($conn,"select * from $table where $id='$value' and $id1='$value1' order by $fields $asc");
  // echo "select * from $table where $id='$value' and  $id1='$value1' order by $fields $asc"; 

		if(mysqli_num_rows($sql)>0)
		{
			while($row = mysqli_fetch_assoc($sql))
			{
				$rows[] = $row;
			}
			
			return $rows;
		}
		else
		{
			return 0;
		}

	}
	

function gettable_Rows_where_asc3($table,$id1,$value1,$value2,$id2,$value3,$fields,$asc)
	{
		require("includes/connection.php");
	  $sql =mysqli_query($conn,"select * from $table where $id1 IN('$value1','$value2') and $id2=$value3 order by $fields $asc");
  //echo "select * from $table where $id1 IN('$value1','$value2') and $id2=$value3 order by $fields $asc";

		if(mysqli_num_rows($sql)>0)
		{
			
			while($row = mysqli_fetch_assoc($sql))
			{
			
				$rows[] = $row;
			}
			
			return $rows;
		}
		else
		{
			return 0;
		}

	}


function gettable_Rows_where_asc4($table,$id1,$value1,$value2,$fields,$asc)
	{
		require("includes/connection.php");
	  $sql =mysqli_query($conn,"select * from $table where $id1 IN ('$value1','$value2') order by $fields $desc");
	//echo "select * from $table where $id1 IN ('$value1','$value2') order by $fields $desc";

		if(mysqli_num_rows($sql)>0)
		{
			while($row = mysqli_fetch_assoc($sql))
			{
				$rows[] = $row;
			}
			
			return $rows;
		}
		else
		{
			return 0;
		}

	}


function gettable_Rows_where_asc5($table,$id1,$value1,$value2,$id2,$value3,$value4,$fields,$asc)
	{
		require("includes/connection.php");
	  $sql =mysqli_query($conn,"select * from $table where $id1 IN('$value1','$value2') and $id2 IN($value3,$value4) order by $fields $Desc");
  //echo "select * from $table where $id1 IN('$value1','$value2') and $id2 IN($value3,$value4)  order by $fields $Desc";

		if(mysqli_num_rows($sql)>0)
		{
			
			while($row = mysqli_fetch_assoc($sql))
			{
			
				$rows[] = $row;
			}
			
			return $rows;
		}
		else
		{
			return 0;
		}

	}





	
	function gettable_Rowsfour_OrderLimit_where($table,$id,$value,$id1,$value1, $id3,$value3, $id4,$value4, $asc_dsc,$id2,$start,$end)
    {
		require("includes/connection.php");
    	$sql =mysqli_query($conn,"select * from  $table where $id='$value' and $id1='$value1' and $id3='$value3' and $id4='$value4' order by $asc_dsc $id2  limit $start,$end");

    	if(mysqli_num_rows($sql)>0)
    	{
    		while($row = mysqli_fetch_assoc($sql))
    		{
    			$rows[] = $row;
    		}

    		return $rows;
    	}
    	else
    	{
    		return 0;
    	}

    }
    
    function clean_stringsp($string) 
    {
       //$string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.

         return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
   }
   
   function website_url($website){
	   $pattern = "/^(www.)[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/";
		if ( preg_match($pattern, $website) ) {
		   return 1;
		} else {
		  return 0;
		}
   }
   
   
   function gettable_SingleRowTwoColumn($table,$id,$value,$id1,$value1)
	{
		require("includes/connection.php");
		$sql = mysqli_query($conn,"select * from $table where $id='$value' and $id1='$value1'");
		
		if(mysqli_num_rows($sql)>0)
		{
			$row = mysqli_fetch_assoc($sql);
			
			return $row;
		}
		else
		{
			return 0;
		}

	}
	
	
	function gettable_Rows_whereWithIN_asc($table,$id1,$value1,$value2,$value3,$id2,$value4,$value5,$value6,$id3,$value7,$value8,$fields,$asc)
	{
		require("includes/connection.php");
	  $sql =mysqli_query($conn,"select * from $table where ($id1 IN('$value1','$value2','$value3') and $id2 IN('$value4','$value5','$value6')) and $id3 IN('$value7','$value8') order by $fields $Desc");
   //echo "select * from $table where ($id1 IN('$value1','$value2','$value3') and $id2 IN('$value4','$value5','$value6')) order by $fields $Desc";
		if(mysqli_num_rows($sql)>0)
		{
			
			while($row = mysqli_fetch_assoc($sql))
			{
			
				$rows[] = $row;
			}
			
			return $rows;
		}
		else
		{
			return 0;
		}

	}
	
	function gettable_Rows_whereWithTwoIN_asc($table,$id1,$value1,$value2,$value3,$id2,$value4,$value5,$value6,$fields,$asc)
	{
		require("includes/connection.php");
	  $sql =mysqli_query($conn,"select * from $table where ($id1 IN('$value1','$value2','$value3') and $id2 IN('$value4','$value5','$value6')) order by $fields $Desc");
   //echo "select * from $table where ($id1 IN('$value1','$value2','$value3') and $id2 IN('$value4','$value5','$value6')) order by $fields $Desc";
		if(mysqli_num_rows($sql)>0)
		{
			
			while($row = mysqli_fetch_assoc($sql))
			{
			
				$rows[] = $row;
			}
			
			return $rows;
		}
		else
		{
			return 0;
		}

	}
	
	
	function getRowsthreeWith_OR($table,$status,$approve,$status1,$approve1,$status2,$approve2,$id,$asc)
	{
		require("includes/connection.php");
		$sql=mysqli_query($conn,"select * from $table where (($status && $approve) OR ($status1 && $approve1) OR ($status2 && $approve2)) order by $id $asc");

	   if(mysqli_num_rows($sql))
	   {
		  while($row = mysqli_fetch_assoc($sql))
			{
			
				$rows[] = $row;
			}
			
			return $rows; 
	   }
	   else
	   {
		 return 0;
	   }    
	}

   function getRowstwoWith_OR($table,$status,$approve,$status1,$approve1,$id,$asc)
	{
		require("includes/connection.php");
		$sql=mysqli_query($conn,"select * from $table where (($status && $approve) OR ($status1 && $approve1)) order by $id $asc");
		//echo "select * from $table where (($status && $approve) OR ($status1 && $approve1)) order by $id $asc";
	   if(mysqli_num_rows($sql))
	   {
		  while($row = mysqli_fetch_assoc($sql))
			{
			
				$rows[] = $row;
			}
			
			return $rows; 
	   }
	   else
	   {
		 return 0;
	   }    
	}

	function getlgDcRows($table,$status,$approve,$status1,$approve1,$field1,$value1,$id,$asc)
	{
		require("includes/connection.php");
		$sql=mysqli_query($conn,"select * from $table where  ((($status && $approve) OR ($status1 && $approve1)) AND ($field1 IN($value1))) order by $id $asc");
	  // echo "select * from $table where  ((($status && $approve) OR ($status1 && $approve1)) AND ($field1 IN($value1))) order by $id $asc";

	   if(mysqli_num_rows($sql))
	   {
		  while($row = mysqli_fetch_assoc($sql))
			{
			
				$rows[] = $row;
			}
			
			return $rows; 
	   }
	   else
	   {
		 return 0;
	   }    
	}
	
	
	
	
	function getRowstwoWith_ORAND($table,$status,$approve,$status1,$approve1,$status2,$approve2,$status3,$approve3,$id1,$value1,$value2,$id,$asc)
	{
		require("includes/connection.php");
		$sql=mysqli_query($conn,"select * from $table where ((($status && $approve) OR ($status1 && $approve1)  OR ($status2 && $approve2) OR ($status3 && $approve3)) and $id1 IN('$value1','$value2')) order by $id $asc");
	   //echo "select * from $table where ((($status && $approve) OR ($status1 && $approve1) OR ($status2 && $approve2) OR ($status3 && $approve3)) and $id1 IN('$value1','$value2')) order by $id $asc";
	   if(mysqli_num_rows($sql))
	   {
		  while($row = mysqli_fetch_assoc($sql))
			{
			
				$rows[] = $row;
			}
			
			return $rows; 
	   }
	   else
	   {
		 return 0;
	   }    
	}
	
	
function getcolumnfiveWith_ORAND($table,$status,$approve,$status1,$approve1,$status2,$approve2,$status3,$approve3,$status4,$approve4,$id1,$value1,$value2,$id,$asc)
	{
		require("includes/connection.php");
		$sql=mysqli_query($conn,"select * from $table where ((($status && $approve) OR ($status1 && $approve1)  OR ($status2 && $approve2) OR ($status3 && $approve3) OR ($status4 && $approve4)) and $id1 IN('$value1','$value2')) order by $id $asc");
	  // echo "select * from $table where ((($status && $approve) OR ($status1 && $approve1)  OR ($status2 && $approve2) OR ($status3 && $approve3) OR ($status4 && $approve4)) and $id1 IN('$value1','$value2')) order by $id $asc";
	   if(mysqli_num_rows($sql))
	   {
		  while($row = mysqli_fetch_assoc($sql))
			{
			
				$rows[] = $row;
			}
			
			return $rows; 
	   }
	   else
	   {
		 return 0;
	   }    
	}
	
	function getRowsthreeWith_ORAND($table,$status,$approve,$status1,$approve1,$status2,$approve2,$status3,$approve3,$status4,$approve4,$id1,$value1,$value2,$id,$asc)
	{
		require("includes/connection.php");
		$sql=mysqli_query($conn,"select * from $table where ((($status && $approve) OR ($status1 && $approve1)  OR ($status2 && $approve2) OR ($status3 && $approve3) OR ($status4 && $approve4)) and $id1 IN('$value1','$value2')) order by $id $asc");
	   //echo "select * from $table where ((($status && $approve) OR ($status1 && $approve1) OR ($status2 && $approve2) OR ($status3 && $approve3)) and $id1 IN('$value1','$value2')) order by $id $asc";
	   if(mysqli_num_rows($sql))
	   {
		  while($row = mysqli_fetch_assoc($sql))
			{
			
				$rows[] = $row;
			}
			
			return $rows; 
	   }
	   else
	   {
		 return 0;
	   }    
	}
	
	
	function getRowsfourWith_ORAND($table,$status,$approve,$status1,$approve1,$status2,$approve2,$status3,$approve3,$status4,$approve4,$status5,$approve5,$id1,$value1,$value2,$id,$asc)
	{
		require("includes/connection.php");
		$sql=mysqli_query($conn,"select * from $table where ((($status && $approve) OR ($status1 && $approve1)  OR ($status2 && $approve2) OR ($status3 && $approve3) OR ($status4 && $approve4) OR ($status5 && $approve5) ) and $id1 IN('$value1','$value2')) order by $id $asc");
	  // echo "select * from $table where ((($status && $approve) OR ($status1 && $approve1) OR ($status2 && $approve2) OR ($status3 && $approve3)) and $id1 IN('$value1','$value2')) order by $id $asc";
	   if(mysqli_num_rows($sql))
	   {
		  while($row = mysqli_fetch_assoc($sql))
			{
			
				$rows[] = $row;
			}
			
			return $rows; 
	   }
	   else
	   {
		 return 0;
	   }    
	}
	

	
	function getRowsFourWith_OR($table,$status,$approve,$status1,$approve1,$status2,$approve2,$status3,$approve3 ,$status4,$approve4,$id,$asc)
	{
		require("includes/connection.php");
		$sql=mysqli_query($conn,"select * from $table where (($status && $approve) OR ($status1 && $approve1) OR ($status2 && $approve2) OR ($status3 && $approve3) OR ($status4 && $approve4)) order by $id $asc");
	   //echo "select * from $table where (($status && $approve) OR ($status1 && $approve1) OR ($status2 && $approve2) OR ($status3 && $approve3) OR ($status4 && $approve4)) order by $id $asc";
	   if(mysqli_num_rows($sql))
	   {
		  while($row = mysqli_fetch_assoc($sql))
			{
			
				$rows[] = $row;
			}
			
			return $rows; 
	   }
	   else
	   {
		 return 0;
	   }    
	}
	
	
	function gettable_RowsTwoColumn_whereOrderBy($table,$id,$value,$id1,$value1,$orderby)
	{
		require("includes/connection.php");
		$sql =mysqli_query($conn,"select * from $table where $id='$value' and $id1='$value1' $orderby");
		//echo "select * from $table where $id='$value' and $id1='$value1'";
		
		if(mysqli_num_rows($sql)>0)
		{
			while($row = mysqli_fetch_assoc($sql))
			{
				$rows[] = $row;
			}
			
			return $rows;
		}
		else
		{
			return 0;
		}

	}
	
	function gettable_threeTwoColumn_whereOrderBy($table,$id,$value,$id1,$value1,$id2,$value2,$orderby)
	{
		require("includes/connection.php");
		$sql =mysqli_query($conn,"select * from $table where $id='$value' or $id1='$value1' and $id2='$value2' $orderby");
		//echo "select * from $table where $id='$value' and $id1='$value1'";
		
		if(mysqli_num_rows($sql)>0)
		{
			while($row = mysqli_fetch_assoc($sql))
			{
				$rows[] = $row;
			}
			
			return $rows;
		}
		else
		{
			return 0;
		}

	}
	
	function gettable_from_scheme_TwoColumn_whereOrderBy($table,$id,$value,$id1,$value1,$id2,$value2,$orderby)
	{
		require("includes/connection.php");
		$sql =mysqli_query($conn,"select * from $table where $id='$value' or $id1='$value1' and $id2='$value2' $orderby");
		//echo "select * from $table where $id='$value' and $id1='$value1'";
		
		if(mysqli_num_rows($sql)>0)
		{
			while($row = mysqli_fetch_assoc($sql))
			{
				$rows[] = $row;
			}
			
			return $rows;
		}
		else
		{
			return 0;
		}

	}
	
	
/* for scheme */

function getRowstwoWithscheme_ORAND($table,$status,$approve,$status1,$approve1,$status2,$approve2,$status3,$approve3,$value1,$value2)
	{
		require("includes/connection.php");
		$sql=mysqli_query($conn,"select * from $table where ((($status && $approve) OR ($status1 && $approve1)  OR ($status2 && $approve2) OR ($status3 && $approve3)))");
	   //echo "select * from $table where ((($status && $approve) OR ($status1 && $approve1) OR ($status2 && $approve2) OR ($status3 && $approve3)))";
	   if(mysqli_num_rows($sql))
	   {
		  while($row = mysqli_fetch_assoc($sql))
			{
			
				$rows[] = $row;
			}
			
			return $rows; 
	   }
	   else
	   {
		 return 0;
	   }    
	}

function getRowstwoWithscheme_ORANDRO($table,$status,$approve,$status1,$approve1,$status2,$approve2,$status3,$approve3 ,$status4,$approve4 ,$status5,$approve5,$status6,$approve6,$value1,$value2)
	{
		require("includes/connection.php");
		$sql=mysqli_query($conn,"select * from $table where ((($status && $approve) OR ($status1 && $approve1)  OR ($status2 && $approve2) OR ($status3 && $approve3) OR ($status4 && $approve4) OR ($status5 && $approve5) OR ($status6 && $approve6)))");
	  
	     //echo "select * from $table where ((($status && $approve) OR ($status1 && $approve1)  OR ($status2 && $approve2) OR ($status3 && $approve3) OR ($status4 && $approve4)))"; die;
	   if(mysqli_num_rows($sql))
	   {
		  while($row = mysqli_fetch_assoc($sql))
			{
			
				$rows[] = $row;
			}
			
			return $rows; 
	   }
	   else
	   {
		 return 0;
	   }    
	}


	function getlgRowsByStatus($table,$status,$value,$status1,$value1,$status2,$value2,$field1,$value3){
		require("includes/connection.php");

		$sql= "select * from $table where (( ($status && $value) OR ($status1 && $value1)  OR ($status2 && $value2))  AND ($field1 IN($value3)))";
	  
		$query= mysqli_query($conn,$sql);

		if(mysqli_num_rows($query))
		{
			while($row = mysqli_fetch_assoc($query))
			{

				$rows[] = $row;
			}
			
			return $rows; 
		}
		else
		{
			return 0;
		}    


	}


	function getlgRowsByApproval($table,$approve,$status,$approve1,$status1,$field,$value){
		require("includes/connection.php");
      //echo "select * from $table where (($status AND $approve) || ($status1 AND $approve1))  AND $field IN ($value)"; 
	  $sql=mysqli_query($conn,"select * from $table where (($status AND $approve) || ($status1 AND $approve1))  AND $field IN ($value)");
	 // echo "select * from $table where (($status AND $approve) || ($status1 AND $approve1))  AND $field IN ($value)"; die;
   
	   if(mysqli_num_rows($sql))
	   {
		  while($row = mysqli_fetch_assoc($sql))
			{
			
				$rows[] = $row;
			}
			
			return $rows; 
	   }
	   else
	   {
		 return 0;
	   }    


	}

	function getRowsByApproval($table,$status,$approve,$status1,$approve1,$field,$value,$id,$asc){
		require("includes/connection.php");
        //echo "select * from $table where (($status && $approve) OR ($status1 && $approve1)) AND $field IN ($value)  order by $id $asc";
		$sql=mysqli_query($conn,"select * from $table where (($status && $approve) OR ($status1 && $approve1)) AND $field IN ($value)  order by $id $asc");
	   
	   if(mysqli_num_rows($sql))
	   {
		  while($row = mysqli_fetch_assoc($sql))
			{
			
				$rows[] = $row;
			}
			
			return $rows; 
	   }
	   else
	   {
		 return 0;
	   }    


	}



	function gettable_RowsTwoColumnOR_whereOrderBy($table,$id,$value,$id1,$value2,$value3,$orderby)
	{
		require("includes/connection.php");
		$sql =mysqli_query($conn,"select * from $table where $id IN('$value') and $id1 IN('$value2',$value3) $orderby");
		//echo "select * from $table where $id IN('$value') and $id1 IN('$value2',$value3) $orderby";
		
		if(mysqli_num_rows($sql)>0)
		{
			while($row = mysqli_fetch_assoc($sql))
			{
				$rows[] = $row;
			}
			
			return $rows;
		}
		else
		{
			return 0;
		}

	}
	
	 function getRows_With_two_OR_one_and($table,$status,$approve,$status1,$approve1,$status2,$approve2,$id,$asc)
	{
		require("includes/connection.php");
		$sql=mysqli_query($conn,"select * from $table where ($status OR $approve) And ($status1)");
		//echo "select * from $table where ($status OR $approve) And ($status1)";
	   if(mysqli_num_rows($sql))
	   {
		  while($row = mysqli_fetch_assoc($sql))
			{
			
				$rows[] = $row;
			}
			
			return $rows; 
	   }
	   else
	   {
		 return 0;
	   }    
	}
	
	 function getRows_With_two_field_are_same($table,$status,$approve,$status1,$approve1,$status2,$approve2,$id,$asc)
	{
		require("includes/connection.php");
		$sql=mysqli_query($conn,"select * from $table where ($status and $approve) OR ($status1 and $approve1) OR ($status2 and $approve2) order by $id $asc");
		//echo "select * from $table where ($status and $approve) OR ($status1 and $approve1) OR ($status2 and $approve2) order by $id $asc";
	   if(mysqli_num_rows($sql))
	   {
		  while($row = mysqli_fetch_assoc($sql))
			{
			
				$rows[] = $row;
			}
			
			return $rows; 
	   }
	   else
	   {
		 return 0;
	   }    
	}
	
	
	

	function bulkNotificationWithAttachment($from_email,$from_email_cc,$user_email,$target,$subject,$message){
		require("includes/connection.php");
			 /* email receipt to nt and user */
			$mail = new PHPMailer();
			$mail->From = $from_email;
			$mail->FromName = "The National Trust";
		    for($i=0; $i<count($user_email); $i++){
			$mail->AddAddress($user_email[$i]);
			}
			$mail->AddCC($from_email_cc);
			$mail->Subject = $subject;
			$mail->MsgHTML("<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
			<html xmlns='http://www.w3.org/1999/xhtml'>
			<head>
			<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
			<title>Scheme Registration Application</title>
			</head>
			<body>
			<table width='80%' border='0' cellspacing='0' cellpadding='0' align='center'>
			<tr>
			<td style='border:1px solid #CCC; padding:5px;'>
			<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center'>
			<tr>
			<td style='padding:10px;'><img src='$HomeURL/assets/images/logo.png' width='121' height='105' alt='' /></td>
			</tr>
			<tr>
			<td style='padding:10px; font-size:12px; font-family:Verdana, Geneva, 'Open Sans'; text-align:justify; line-height:18px; color:#404040; border-top:1px solid #930'>
			Dear user,<br>$message.<br><br>
			</td>
			</tr>
			<tr>
			<td style='padding:10px; font-size:12px; font-family:Verdana, Geneva, 'Open Sans'; text-align:justify; line-height:18px; color:#404040'><strong>Regards,</strong><br />
			<strong> The National Trust</strong>
			</td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			</tr>
			</table>
			</td>
			</tr>
			</table>
			</body>
			</html>");
			$mail->IsHTML(true); 
			// set email format to HTML
			$mail->AddAttachment($target);
			if(!$mail->Send()){
			} 
}


function bulkNotificationWithoutAttachment($from_email,$from_email_cc,$user_email,$subject,$message){
	require("includes/connection.php");
			 /* email receipt to nt and user */
			$mail = new PHPMailer();
			$mail->From = $from_email;
			$mail->FromName = "The National Trust";
		    for($i=0; $i<count($user_email); $i++){
			$mail->AddAddress($user_email[$i]);
			}
			$mail->AddCC($from_email_cc);
			$mail->Subject = $subject;
			$mail->MsgHTML("<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
			<html xmlns='http://www.w3.org/1999/xhtml'>
			<head>
			<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
			<title>Scheme Registration Application</title>
			</head>
			<body>
			<table width='80%' border='0' cellspacing='0' cellpadding='0' align='center'>
			<tr>
			<td style='border:1px solid #CCC; padding:5px;'>
			<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center'>
			<tr>
			<td style='padding:10px;'><img src='$HomeURL/assets/images/logo.png' width='121' height='105' alt='' /></td>
			</tr>
			<tr>
			<td style='padding:10px; font-size:12px; font-family:Verdana, Geneva, 'Open Sans'; text-align:justify; line-height:18px; color:#404040; border-top:1px solid #930'>
			Dear user,<br>$message.<br><br>
			</td>
			</tr>
			<tr>
			<td style='padding:10px; font-size:12px; font-family:Verdana, Geneva, 'Open Sans'; text-align:justify; line-height:18px; color:#404040'><strong>Regards,</strong><br />
			<strong> The National Trust</strong>
			</td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			</tr>
			</table>
			</td>
			</tr>
			</table>
			</body>
			</html>");
			$mail->IsHTML(true); 
			// set email format to HTML
			//$mail->AddAttachment($target);
			if(!$mail->Send()){
			} 
}


  function sendmassegeNIC($number,$message)
  {
	 $mob="91".$number;   $tst=$message;
	
	 $uid=urlencode("nationaltrust.sms");  
	 $pass=urlencode("Ba$3vF#7kH"); 
	 $send=urlencode("NICSMS"); 
	 $dest=urlencode($mob); 
	 $msg=urlencode($tst); 
	
	 $url="https://smsgw.sms.gov.in/failsafe/HttpLink?";  
	 
	 $data = "username=$uid&pin=$pass&message=$msg&mnumber=$dest&signature=$send";
	 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
 	curl_setopt($ch, CURLOPT_POST, 1);
 	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,1);
	curl_setopt($ch, CURLOPT_CAINFO,'/etc/pki/tls/certs/ca-bundle.crt');
	
	if(curl_errno($ch))
    { 
        //echo 'Curl error: ' . curl_error($ch);
	}else
    { 
        //echo "Response = ".$curl_output =curl_exec($ch); 
    }
	curl_close($ch);

 } 
 

function getRowstwoWith_ORAND_GR($table,$status,$approve,$status1,$approve1,$status2,$approve2,$id,$asc)
	{
		require("includes/connection.php");
		$sql=mysqli_query($conn,"select * from $table where ((($status && $approve) OR ($status1 && $approve1) OR ($status2 && $approve2))) order by $id $asc");
	  //echo "select * from $table where ((($status && $approve) OR ($status1 && $approve1) OR ($status2 && $approve2))) order by $id $asc";
	   if(mysqli_num_rows($sql))
	   {
		  while($row = mysqli_fetch_assoc($sql))
			{
			
				$rows[] = $row;
			}
			
			return $rows; 
	   }
	   else
	   {
		 return 0;
	   }    
	}







function getRowsFourWith_OR_GR($table,$status,$approve,$status1,$approve1,$id,$asc)
	{
		require("includes/connection.php");
		$sql=mysqli_query($conn,"select * from $table where (($status && $approve) OR ($status1 && $approve1)) order by $id $asc");
		//echo "select * from $table where (($status && $approve) OR ($status1 && $approve1)) order by $id $asc";
	  // echo "select * from $table where (($status && $approve) OR ($status1 && $approve1)) order by $id $asc";
	   if(mysqli_num_rows($sql))
	   {
		  while($row = mysqli_fetch_assoc($sql))
			{
			
				$rows[] = $row;
			}
			
			return $rows; 
	   }
	   else
	   {
		 return 0;
	   }    
	}


  function dateComparisionDB($table,$comdt,$fieldname,$dtformat,$id,$value)
  {
	require("includes/connection.php");
	  $sql = mysqli_query($conn,"select * from $table where STR_TO_DATE($fieldname, '$dtformat') >= STR_TO_DATE('$comdt', '$dtformat') and $id='$value'");
	  if(mysqli_num_rows($sql)>0)
	  {
		return mysqli_num_rows($sql);  
	  }
	  else
	  {
		return 0;  
	  }
  }
  
  
  function calculateFiscalYearForDate($inputDate, $fyStart, $fyEnd){
    $date = strtotime($inputDate);
    $inputyear = strftime('%Y',$date);
 
    $fystartdate = strtotime($fyStart.$inputyear);
    $fyenddate = strtotime($fyEnd.$inputyear);
 
    if($date < $fyenddate){
        $fy = intval($inputyear);
    }else{
        $fy = intval(intval($inputyear) + 1);
    }
 
    return $fy;
 
}


function gettableRowWhereClause($table,$WhereClause){
	require("includes/connection.php");
	$sql =mysqli_query($conn,"SELECT * from $table WHERE $WhereClause ");
	//echo "select * from $table where $WhereClause "; 
	//die;
	if(mysqli_num_rows($sql)>0)
	{
		$row= mysqli_fetch_assoc($sql);
		return $row;
	}
	else
	{
		return 0;
	}

}

##############changed By arif###################

function getDataByWhereClouse($table,$WhereClause){
	require("includes/connection.php");
	$rows = array();
	$sql =mysqli_query($conn,"SELECT * from $table WHERE $WhereClause ");
	//echo "select * from $table where $WhereClause ";  die;
	
	if(mysqli_num_rows($sql)>0)

		{
			while($row = mysqli_fetch_assoc($sql))
			{
				$rows[] = $row;
			}
			
			return $rows;
		}
		else
		{
			return 0;
		}

}
############# end ################################ 

function search_name_like($table,$id,$value,$id2,$value2)
{
	require("includes/connection.php");
  //echo $dl="select * from $table where $id like '%$value%' and $id2 ='$value2' "; 
  $sql =mysqli_query($conn,"select * from $table where $id like '%$value%'");


	if(mysqli_num_rows($sql)>0)
	{
		while($row = mysqli_fetch_assoc($sql))
		{
			$rows[] = $row;
		}
		
		return $rows;
	}
	else
	{
		return 0;
	}

}





function gettable_Rows_where_desc($table,$id,$value,$fields,$id1,$asc)
	{
		require("includes/connection.php");
	  $sql =mysqli_query($conn,"select * from $table where $id='$value'  order by $fields $id1 $desc");
	//echo "select * from $table where $id='$value'  order by $fields $id1 $desc";

		if(mysqli_num_rows($sql)>0)
		{
			while($row = mysqli_fetch_assoc($sql))
			{
				$rows[] = $row;
			}
			
			return $rows;
		}
		else
		{
			return 0;
		}

	}



  function getIconType($estirng,$fielName,$position){
	$getData=explode($estirng,$fielName);
    $Ext=$getData[$position]; 
	if($Ext=="pdf" || $Ext=="PDF"){
	 return $URL="assets/images/icon_pdf.png";
	} else if($Ext=="png" || $Ext=="PNG" || $Ext=="jpg"|| $Ext=="JPG"|| $Ext=="jpeg"|| $Ext=="JPEG"){
	 return $URL="assets/images/gallery-icon.png";
	} else if($Ext=="doc" || $Ext=="doc" || $Ext=="docx" || $Ext=="DOCX"){
	 return $URL="assets/images/word_icon.png";
	}  else {
	   return $URL="assets/images/video_icon.png";
	} 	  
	  
  } 
  
  
  function getExplode($estirng,$fielName,$position){
	$getData=explode($estirng,$fielName);
    return $getData[$position];  
  }
  
  
  
  
  
  function getLast_oneRow_ID($table,$id,$value)
  {
	require("includes/connection.php");
    	$sql = mysqli_query($conn,"select * from $table where $id='$value' order by $id desc limit 0,1");

    	if(mysqli_num_rows($sql)>0)
    	{
    		$row = mysqli_fetch_assoc($sql);
    		return $row;
    	}
    	else
    	{
    		return 0;
    	}
  }

function getRowsfiveWith_ORAND_GR($table,$status,$approve,$status1,$approve1,$status2,$approve2,$status3,$approve3,$status4,$approve4,$status5,$approve5,$id,$asc)
	{
		require("includes/connection.php");
		$sql=mysqli_query($conn,"select * from $table where ((($status && $approve) OR ($status1 && $approve1) OR ($status2 && $approve2) OR ($status3 && $approve3) OR ($status4 && $approve4) OR ($status5 && $approve5))) order by $id $asc");
	// echo "select * from $table where ((($status && $approve) OR ($status1 && $approve1) OR ($status2 && $approve2)OR ($status3 && $approve3))) order by $id $asc";
	   if(mysqli_num_rows($sql))
	   {
		  while($row = mysqli_fetch_assoc($sql))
			{
			
				$rows[] = $row;
			}
			
			return $rows; 
	   }
	   else
	   {
		 return 0;
	   }    
	}



function getRowsfiveWith_ORAND_GRSquery($table,$status,$approve,$status1,$approve1,$status2,$approve2,$status3,$approve3,$status4,$approve4,$status6,$approve5,$status5,$id,$asc)
	{
		require("includes/connection.php");
		$sql=mysqli_query($conn,"select * from $table where ((($status && $approve) OR ($status1 && $approve1) OR ($status2 && $approve2) OR ($status3 && $approve3) OR ($status4 && $approve4) OR ($status6 && $approve5))) $status5  order by $id $asc");
	//echo "select * from $table where ((($status && $approve) OR ($status1 && $approve1) OR ($status2 && $approve2)OR ($status3 && $approve3) OR ($status4 && $approve4))) $status5 order by $id $asc";
	   if(mysqli_num_rows($sql))
	   {
		  while($row = mysqli_fetch_assoc($sql))
			{
			
				$rows[] = $row;
			}
			
			return $rows; 
	   }
	   else
	   {
		 return 0;
	   }    
	}

function gettable_RowsTwoColumn_where_query($table,$id,$value,$id1,$value1,$status)
{
	require("includes/connection.php");
	$sql =mysqli_query($conn,"select * from $table where $id='$value' and $id1='$value1' $status");

	//echo "select * from $table where $id='$value' and $id1='$value1' $status";
	
	if(mysqli_num_rows($sql)>0)
	{
		while($row = mysqli_fetch_assoc($sql))
		{
			$rows[] = $row;
		}
		
		return $rows;
	}
	else
	{
		return 0;
	}

}


function getRowstwoWith_ORAND_GR_Query($table,$status,$approve,$status1,$approve1,$status2,$approve2,$status3,$id,$asc)
	{
		require("includes/connection.php");
		$sql=mysqli_query($conn,"select * from $table where ((($status && $approve) OR ($status1 && $approve1) OR ($status2 && $approve2)) $status3) order by $id $asc");
	 // echo "select * from $table where ((($status && $approve) OR ($status1 && $approve1) OR ($status2 && $approve2)) $status3) order by $id $asc";
	   if(mysqli_num_rows($sql))
	   {
		  while($row = mysqli_fetch_assoc($sql))
			{
			
				$rows[] = $row;
			}
			
			return $rows; 
	   }
	   else
	   {
		 return 0;
	   }    
	}

function gettable_Rows_desc($table,$fields,$id1,$asc)
	{
		require("includes/connection.php");
	  $sql =mysqli_query($conn,"select * from $table order by $fields $id1 $desc");
	//echo "select * from $table  order by $fields $id1 $desc";

		if(mysqli_num_rows($sql)>0)
		{
			while($row = mysqli_fetch_assoc($sql))
			{
				$rows[] = $row;
			}
			
			return $rows;
		}
		else
		{
			return 0;
		}

	}
	
	
	
  function getLast_oneRow_ID_Orderby($table,$id,$value,$orderby)
  {
	require("includes/connection.php");
    	$sql = mysqli_query($conn,"select * from $table where $id='$value' order by $orderby desc limit 0,1");

    	if(mysqli_num_rows($sql)>0)
    	{
    		$row = mysqli_fetch_assoc($sql);
    		return $row;
    	}
    	else
    	{
    		return 0;
    	}
  }
  
  
  function getcolumnSevenWith_ORAND($table,$status,$approve,$status1,$approve1,$status2,$approve2,$status4,$approve4,$status5,$approve5,$id1,$value1,$value2,$id2,$NR,$DC,$CC,$IB,$id,$asc)
	{
		require("includes/connection.php");
		$sql=mysqli_query($conn,"select * from $table where ((($status && $approve) OR ($status1 && $approve1)  OR ($status2 && $approve2) OR ($status4 && $approve4) OR ($status5 && $approve5)) and (($id1 IN('$value1','$value2') and $id2='$NR') OR ($id1='$value2' and $id2 IN('$DC','$CC','$IB')))) order by $id $asc");
	  //echo "select * from $table where ((($status && $approve) OR ($status1 && $approve1)  OR ($status2 && $approve2) OR ($status4 && $approve4) OR ($status5 && $approve5)) and (($id1 IN('$value1','$value2') and $id2='$NR') OR ($id1='$value2' and $id2 IN('$DC','$CC','$IB')))) order by $id $asc";
	   if(mysqli_num_rows($sql))
	   {
		  while($row = mysqli_fetch_assoc($sql))
			{
			
				$rows[] = $row;
			}
			
			return $rows; 
	   }
	   else
	   {
		 return 0;
	   }    
	}

  function countTablethreeRow($table,$id1,$value1,$id2,$value2,$id3,$value3){
	require("includes/connection.php");
   //echo "select * from $table where $id1='$value1' or $id2='$value2' or $id3='$value3'";
	$sql =mysqli_query($conn,"select * from $table where $id1='$value1' or $id2='$value2' or $id3='$value3'");

	if(mysqli_num_rows($sql)>0){

		return mysqli_num_rows($sql);

	}
	else{

		return 0;
	}
}

    function getcolumnEightWith_ORAND($table,$status,$approve,$status1,$approve1,$status2,$approve2,$status3,$approve3,$status4,$approve4,$status5,$approve5,$id1,$value1,$value2,$id2,$NR,$DC,$CC,$IB,$id,$asc)
	{
		require("includes/connection.php");
		$sql=mysqli_query($conn,"select * from $table where ((($status && $approve) OR ($status1 && $approve1) OR ($status2 && $approve2) OR ($status3 && $approve3) OR ($status4 && $approve4) OR ($status5 && $approve5)) and (($id1 IN('$value1','$value2') and $id2='$NR') OR ($id1='$value2' and $id2 IN('$DC','$CC','$IB')))) order by $id $asc");
	   //echo "select * from $table where ((($status && $approve) OR ($status1 && $approve1) OR ($status2 && $approve2)  OR ($status4 && $approve4) OR ($status5 && $approve5)) and (($id1 IN('$value1','$value2') and $id2='$NR') OR ($id1='$value2' and $id2 IN('$DC','$CC','$IB')))) order by $id $asc";
	   if(mysqli_num_rows($sql))
	   {
		  while($row = mysqli_fetch_assoc($sql))
			{
			
				$rows[] = $row;
			}
			
			return $rows; 
	   }
	   else
	   {
		 return 0;
	   }    
	}
	
	function GetFiveColumnWith_ORAND($table,$status,$approve,$status1,$approve1,$status2,$approve2,$status3,$approve3,$status4,$approve4,$id,$asc)
	{
		require("includes/connection.php");
		$sql=mysqli_query($conn,"select * from $table where ((($status && $approve) OR ($status1 && $approve1) OR ($status2 && $approve2) OR ($status3 && $approve3) OR ($status4 && $approve4))) order by $id $asc");
	   //echo "select * from $table where ((($status && $approve) OR ($status1 && $approve1) OR ($status2 && $approve2) OR ($status3 && $approve3) OR ($status4 && $approve4))) order by $id $asc";
	   if(mysqli_num_rows($sql))
	   {
		  while($row = mysqli_fetch_assoc($sql))
			{
			
				$rows[] = $row;
			}
			
			return $rows; 
	   }
	   else
	   {
		 return 0;
	   }    
	}
	
	
	
	function ageCalculate($birthDate){
	  // dob formate= "12/17/1983";
	  $birthDate = explode("/", $birthDate);
	  $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
		? ((date("Y") - $birthDate[2]) - 1)
		: (date("Y") - $birthDate[2]));
	 return $age;
    }
    
	function gettable_Rows_whereCluse($table,$value){
		require("includes/connection.php");
		//$value =  str_replace("'", "", $value);
		//echo "select * from $table where $value";
     $sql =mysqli_query($conn,"select * from $table where $value");
	//echo "select * from $table where  $value";
	if(mysqli_num_rows($sql)>0){
		while($row = mysqli_fetch_assoc($sql)){
			$rows[] = $row;
		}
		return $rows;
	} else {
		return 0;
	}
  }
  
  
  function RowsNo_INClause_FourValue($table,$id,$value,$status,$firstvalue,$secvalue,$thirdvalue,$fourvalue)
  { 
	require("includes/connection.php");
     $sql = mysqli_query($conn,"select * from $table where $id='$value' and $status IN('$firstvalue','$secvalue','$thirdvalue','$fourvalue')");
	
	  if(mysqli_num_rows($sql)>0)
	  {
	    return mysqli_num_rows($sql);   
	  }
	  else
	  {
	    return 0;
	  }
	  
  } 
  
  
  function RowsNo_INClause_TwoValue($table,$id,$value,$status,$firstvalue,$secvalue)
  { 
	require("includes/connection.php");
     $sql = mysqli_query($conn,"select * from $table where $id='$value' and $status IN('$firstvalue','$secvalue')");
	
	  if(mysqli_num_rows($sql)>0)
	  {
	    return mysqli_num_rows($sql);   
	  }
	  else
	  {
	    return 0;
	  }
	  
  } 
  
  
  function dateDiff($start, $end) {
	  // date formate:  2015-10-18
	  $start_ts = strtotime($start);
	  $end_ts = strtotime($end);
	  $diff = $end_ts - $start_ts;
	  return round($diff / 86400);
  }

    function deleteRowfromtwoid($table,$schemeid,$schemevalue,$scheme2id,$scheme2value){
		require("includes/connection.php"); 
		 $sql =mysqli_query($conn,"select * from $table where $schemeid='$schemevalue' ");
		 if(mysqli_num_rows($sql)>0){
    		$row = mysqli_fetch_assoc($sql);
    		    mysqli_query($conn,"delete from  $table where $schemeid='$schemevalue' "); 
    	 } else {
    		return 0;
    	}
		 
	   }


   function NeftAxisCode($table,$scheme,$challan_no)
   {
	require("includes/connection.php");
      $chr = 'TNTW';
	  $sql = mysqli_query($conn,"select * from $table where scheme='$scheme'"); 
	   if(mysqli_num_rows($sql))
	   {
	      $row = mysqli_fetch_assoc($sql);
		  $result = $chr.$row['code'].$challan_no;
		   return $result;
	   }
	   else
	   {
	     return $challan_no;
	   }
	   
   }

}


$mydb = new funtion_lib();

?>
