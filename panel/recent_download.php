<?php
	include("../includes/db.php");
	$get_download_data = "select * from old_download left join user on old_download.email = user.email order by time DESC";
	$run_download_data = mysqli_query($con, $get_download_data);
	if(mysqli_num_rows($run_download_data)>0)
	{	
	$i=1;
	while($fetchdata=mysqli_fetch_array($run_download_data))
	{
		if($i<=10)
		{
			echo "<tr>";
				echo "<td><span class='round'><img src='".$fetchdata['image']."' alt='user' width='50'></span></td>";
				echo "<td>".$fetchdata['username']."</td>";
				echo "<td>".$fetchdata['email']."</td>";
				echo "<td>".$fetchdata['time']."</td>";
			echo "</tr>";
			$i++;
		}
	}
	}