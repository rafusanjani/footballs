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

		<?php
		   
		   $id = $_GET['id'];

    	   $tickets = "SELECT * FROM tickets WHERE id = $id";

    	   $records = $dbConnection->query($tickets); 

    	   foreach ($records as $key => $value) {

    		  	$id = $value['id'];
    		  	$name = $value['name'];
    		  	$price = $value['price'];

	        }


    	 ?>

	    <main class="py-4">
	        <div class="container">

	        	<h1>Football ticket for (UGANDA CRANES VS HARAMPE STARS) SPORTS</h1><br>
	        	<h4><?php echo $name ?> @ <?php echo $price ?></h4>
	        	<hr>

	        	

	        	<div class="row">
	        		 
	        		 <div class="col-md-6 col-sm-12">

	        		 	<img src="images/airtelmoney.png" width="100px" height="100px">

	        		 	<img src="images/mtn.png" width="100px" height="100px">

	        		 	<img src="images/credit_card.png" width="100px" height="100px">

	        		 	<hr>

	        		 	<form>
						  <script src="https://checkout.flutterwave.com/v3.js"></script>
						  <label>Name</label>
						  <input type="text" id="name" class="form-control">

						  <input type="hidden" id="ticket_id" value="<?php echo $id ?>">

						  <input type="hidden" id="amount" value="<?php echo $price ?>">

						  <label>Phone number</label>
						  <input type="text" id="phone_number" class="form-control">

						  <label>Email address</label>
						  <input type="text" id="email_address" class="form-control">

						  <hr>

						  <button type="button" id="make_payment" class="btn btn-danger">Pay Now</button>
						</form>

						1. save the data but set it to pending [status]<br>
					    2. launch the payment widget<br>
					    3. After payment return the staus and verify the transaction<br>
					    4. Send the SMS to the customer<br>
	        		 	
	        		 </div>	        	 
	        		
	        	</div>

	                

	        </div>
	    </main>

	    <script src="js/app.js"></script>

	    <script>  	
           $(document).ready( function(){

           	  $("#make_payment").click(function(){

           	  	$.ajax({

			            type: "POST",

			            url: "ininiate_payment.php",

			        data: {  

			          tx_ref: "<?php echo "Match-".time() ?>",

			          plan_id: $("#ticket_id").val(), 

			          amount: $("#amount").val(),	

			          name: $("#name").val(),	

			          phone_number: $("#phone_number").val(),			            


			        },
			          success: function(tx_ref){

			          	console.log(tx_ref);

			          	makePayment(tx_ref);

			        }
			    });
           	  })
           })


           function makePayment(tx_ref){

           	 FlutterwaveCheckout({
			      public_key: "FLWPUBK-84dbdced7ce4be6390853663680e0b09-X",
			      tx_ref: tx_ref,
			      amount: $("#amount").val(),
			      currency: "UGX",
			      country: "UG",
			      payment_options: "card,mobilemoneyuganda",
			      redirect_url:  
			        "verify_payment.php",
			      meta: {
			         
			      },
			      customer: {
			        email: $("#email_address").val(),
			        phone_number: $("#phone_number").val(),
			        name: $("#name").val(),
			      },
			      callback: function (data) {
			        console.log(data);
			      },
			      onclose: function() {
			        // close modal
			      },
			      customizations: {
			        title: "Football ticket UG VS HARAMBE STARS",
			        description: "Payment for movie",
			        logo: "https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.vectorstock.com%2Froyalty-free-vectors%2Fcinema-logo-vectors&psig=AOvVaw25fgpDn-vRg4i068JmYnSG&ust=1626955202609000&source=images&cd=vfe&ved=0CAsQjRxqFwoTCLD81oeN9PECFQAAAAAdAAAAABAD",
			      },
			    });


           }

	    </script>





	</body>
</html>