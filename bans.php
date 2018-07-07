<head><link rel="stylesheet" href="includes/main.css"></head>
<?php
   // <<-----------------Database Connection------------>> //
   require 'includes/database.php';
   $sql = 'SELECT name, reason, banner, time, expires FROM bans ORDER BY time DESC LIMIT 20';
   $retval = $conn->query($sql);
   ?>
<body>
	<table class="col-sm-12 table-condensed">
		<thead>
			<tr class='bantable'>
				<th class='bantable'>
					<center>Name</center>
				</th>
				<th class='bantable'>
					<center>Banned By</center>
				</th>
				<th class='bantable'>
					<center>Reason</center>
				</th>
				<th class='bantable'>
					<center>Banned On</center>
				</th>
				<th class='bantable'>
					<center>Banned Until</center>
				</th>
			</tr>
			</thead>
			<tbody>
			   <?php while($row = $retval->fetch_assoc()) { 
				  if($row['banner'] == null) {
					 $row['banner'] = 'Console';
				  }
				  // <<-----------------Ban Date Converter------------>> //
				  $timeEpoch = $row['time'];
				  $timeConvert = $timeEpoch / 1000;
				  $timeResult = date('F j, Y, g:i a', $timeConvert);
				  // <<-----------------Expiration Time Converter------------>> //
				  $expiresEpoch = $row['expires'];
				  $expiresConvert = $expiresEpoch / 1000;
				  $expiresResult = date('F j, Y, g:i a', $expiresConvert);
				  ?>
			   <tr class='bantable'>
				  <td class='bantable'><?php echo "<img src='https://cravatar.eu/avatar/" . $row['name'] . "/256' class='head' />" . $row['name'];?></td>
				  <td class='bantable'><?php echo "<img src='https://cravatar.eu/avatar/" . $row['banner'] . "/256'  class='head' />" . $row['banner'];?></td>
				  <td class='bantable' style="width: 30%;"><center><?php echo $row['reason'];?></center></td>
				  <td class='bantable'><?php echo $timeResult;?></td>
				  <td class='bantable'><center><?php if($row['expires'] == 0) {
					 echo 'Permanent Ban';
					 } else {
					 echo $expiresResult; }?></center></td>
			   </tr>
			   <?php }
				  $conn->close();
				  echo "</tbody></table>";
				  ?>
