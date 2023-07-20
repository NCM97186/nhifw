<?php ob_start();
session_start();
include("../../includes/config.inc.php");
require_once "../../includes/connection.php";
include("../../includes/useAVclass.php");
include("../../includes/functions.inc.php");
include("../../includes/def_constant.inc.php");
require_once("../../includes/ps_pagination.php");
@extract($_GET);
@extract($_POST);
@extract($_SESSION);
$useAVclass = new useAVclass();
$useAVclass->connection();

?>
<table border="1">
   <tr>
				<th width="118">Institution Type</th>
				<th width="127">Management Type </th>
				<th width="127">Institution Name </th>
				<th width="127">Address</th>
				<th width="127">City</th>
				<th width="127">District </th>  
				<th width="127">Pincode  </th>
				<th width="127">State</th>  
				<th width="127">Email</th>  
				<th width="127">Phone</th>
				<th width="127">Fax No</th>
				<th width="127">Contact Person</th>
				<th width="127">Designation Person  </th>
				<th width="127">Phone Contact </th>
				<th width="127">Email Contact </th>
				<th width="127">Fax Contact </th>
				<th width="127">Tatal Strength</th>
				<th width="127">No Of Computer </th>
				<th width="127">No Of Printer</th>
				<th width="127">Facility</th>
				<th width="127">No Of Printers</th>
				<th width="127">Area Of Interest</th>
				<th width="127">Current Activity</th>
				<th width="127">Expectation</th>
				<th width="127">Proposes Activity</th>
				<th width="127">Venue Activity</th>
				<th width="127">Suggestion</th>

				
	</tr>
   <?php
	$sql="select * from online_submission";
	$result=mysqli_query($conn,$sql);
	while($data = mysqli_fetch_array($result, mysqli_ASSOC))
	//print_r($data);
	
	{
    

	?>
	<td><?php  
	echo ($Institution_type[$data['institution_type']]);
		 
	  ?></td>
	<td><?php echo ($Management[$data['management_type']]); ?></td>
	<td><?php echo $data['institution_name']; ?></td>
	<td><?php echo $data['address']; ?></td>
	<td><?php echo $data['city']; ?></td>
	<td><?php echo $data['district']; ?></td>
	<td><?php echo $data['pincode']; ?></td>
	<td><?php echo $data['state']; ?></td>
	<td><?php echo $data['email']; ?></td>
	<td><?php echo $data['phone']; ?></td>
	<td><?php echo $data['vax_no']; ?></td>
	<td><?php echo $data['contact_person']; ?></td>
	<td><?php echo $data['designation_person']; ?></td>
	<td><?php echo $data['phone_contact']; ?></td>
	<td><?php echo $data['email_contact']; ?></td>
	<td><?php echo $data['fax_contact']; ?></td>
	<td><?php echo $data['tatal_strength']; ?></td>
	<td><?php echo $data['no_of_computer']; ?></td>
	<td><?php echo $data['no_of_printer']; ?></td>
	<td><?php echo $data['facility']; ?></td>
	<td><?php echo $data['no_of_printers']; ?></td>

   <td><?php echo $data['area_of_interest']; ?></td>
   <td><?php echo $data['current_activity']; ?></td>
   <td><?php echo $data['expectation']; ?></td>
   <td><?php echo $data['proposes_activity']; ?></td>
   <td><?php echo $data['venue_activity']; ?></td>
   <td><?php echo $data['suggestion']; ?></td>
 
<?php } ?>
</table>

<?php
header("Content-type: application/vnd-ms-excel");
$fileName = "onlinesubmission_export";
header("Content-Disposition: attachment; filename=".$fileName.".xls");

?>