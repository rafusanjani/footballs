<!DOCTYPE html>
<?php
require 'config.php';

 ?>
<html> 
	<head>
		<meta charset="utf-8">
		<title>Buy Tickets</title>
		<link rel="stylesheet" type="text/css" href="css/app.css">
	</head>
	<body>

		<span id="app"></span>

	    <main class="py-4">
	        <div class="container">


	        	<h1>UGANDA CRANES VS HARAMPE STARS
	        	   DATE:1st May 2021 4:00pm 
                   VENUE: KITENDE STADIUM
	        	</h1> 
	        	
	        	<hr>

	        	<?php

	        	   $tickets = "SELECT * FROM tickets";

	        	   $records = $dbConnection->query($tickets); 


	        	 ?>

	        	<div class="row">
	        		<?php

	        		  foreach ($records as $key => $value) {

	        		  	$id = $value['id'];
	        		  	$name = $value['name'];
	        		  	$price = $value['price'];

	        		  	?>

	        		  	<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 col-xl-6">

	        		  		<h3><?php echo  $name?></h3>
	        		  		<hr>
	        		  		<strong>UGX <?php echo $price ?></strong><br>
	        		  		<a href="pay_ticket.php?id=<?php echo $id ?>" class="btn btn-danger">Pay Ticket</a>

	        		    </div>



	        		  	<?php
	        		   
	        		   	 
	        		   } 


	        		 ?>
	        		
	        	</div>


	        	<hr>

	        	<h3>Payments</h3>
	        	<hr>

	        	<table class="table table-striped table-hover">

	        		<th>ID</th> <th>Customer</th> <th>Status</th> <th>Amount</th> <th>Plan</th>

	        	<?php 

	        	   $paymentRecords = $dbConnection->query("SELECT payments.name as customer_name, phone_number,tickets.name as ticket_name, payments.price as amount, payments.id as transaction_id,status FROM payments,tickets WHERE payments.plan_id = tickets.id"); 

	        	   foreach ($paymentRecords as $key => $payment) {

	        	   	$id = $payment["transaction_id"];
	        	   	$name = $payment["customer_name"];
	        	   	$phone_number = $payment["phone_number"];
	        	   	$status = $payment["status"];
	        	   	$amount = $payment["amount"];
	        	   	$ticket_name = $payment["ticket_name"];

	        	   	?>

	        	   	<tr>

	        	   		<td><?php echo $id ?></td>
	        	   		<td><?php echo $name ?><br><?php echo $phone_number ?></td>
	        	   		<td>

						<?php 

	        	   			if($status == "successful")
	        	   				echo "<span class='text-success'> $status </span>";

	        	   			else

	        	   				echo "<span class='text-warning'> $status </span>";

	        	   			?>
	        	   				

	        	   			</td>
	        	   		<td><?php echo $amount ?></td>
	        	   		<td><?php echo $ticket_name ?></td>
	        	   	 
	        	   		


	        	   	</tr>



	        	   	<?php




 
	        	   }


	        	 ?>

	        	 </table>

	                

	        </div>
	    </main>

	</body>
</html>