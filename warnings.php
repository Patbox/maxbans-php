<head><link rel="stylesheet" href="includes/main.css"></head>
<?php
   // <<-----------------Database Connection------------>> //
   require 'includes/database.php';
   $sql = 'SELECT name, reason, banner, expires FROM warnings ORDER BY expires DESC LIMIT 20';
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
               <center>Warned By</center>
            </th>
            <th class='bantable'>
               <center>Reason</center>
            </th>
	<th>
               <center>Warned on</center>
            </th>
            <th class='bantable'>
               <center>Warned Until</center>
            </th>
         </tr>
      </thead>
      <tbody>
         <?php while($row = $retval->fetch_assoc()) { 
            if($row['banner'] == null) {
               $row['banner'] = 'Console';
            }
            // <<-----------------Expiration Time Converter------------>> //
            $expiresEpoch = $row['expires'];
            $expiresConvert = $expiresEpoch / 1000;
            $expiresResult = date('F j, Y, g:i a', $expiresConvert);
            ?>
         <tr  class='bantable'>
				  <td class='bantable'><?php echo "<img src='https://minotar.net/helm/" . $row['name'] . "/256' class='head' />" . $row['name'];?></td>
				  <td class='bantable'><?php echo "<img src='https://minotar.net/helm/" . $row['banner'] . "/256'  class='head' />" . $row['banner'];?></td>
				  <td class='bantable' style="width: 30%;"><center><?php echo $row['reason'];?></center></td>
				  <td class='bantable'><?php echo $timeResult;?></td>
				  <td class='bantable'><center><?php if($row['expires'] == 0) {
					 echo 'Permanent Warning';
					 } else {
					 echo $expiresResult; }?></center></td>
			   </tr>
			   <?php }
				  $conn->close();
				  echo "</tbody></table>";
				  ?>
