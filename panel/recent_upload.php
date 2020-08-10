<?php
	include("../includes/db.php");
	
	$get_upload_data = "select * from old_upload order by time DESC";
	$run_upload_data = mysqli_query($con, $get_upload_data);
	if(mysqli_num_rows($run_upload_data)>0)
	{	
	$i=1;
	while($fetchdata=mysqli_fetch_array($run_upload_data))
	{
		if($i<=10)
		{
			echo "<tr>";
				echo "<td>".$i."</td>";
				echo "<td>".$fetchdata['email']."</td>";
				echo "<td>".$fetchdata['time']."</td>";
			echo "</tr>";
			$i++;
		}
	}
	}