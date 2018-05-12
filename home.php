<?php

session_start();
if(!isset($_SESSION['username'])){
header('location:login.php');
}

$con = mysqli_connect('localhost','root');

mysqli_select_db($con, 'quizdbase');

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans" rel="stylesheet">

		
		<script type="text/javascript">
		function timeout()
		{
			var minute=Math.floor(timeLeft/60);
			var second=timeLeft%60;
	        var mint=checktime(minute);
			var sec=checktime(second);
			
			if(timeLeft<=0)
			{
				clearTimeout(tm);
			    document.getElementById("form1").submit();
			}
			  else
			  {  
				  document.getElementById("time").innerHTML=mint+":"+sec;
			  }
			  
			  timeLeft--;
			  
			  var tm setTimeout(function(){timeout()},1000);
			   
			  
			  
		}
		function checktime(msg)
		{
			if(msg<10)
			{
				msg="0"+msg;
			
		}
		return msg;
	}
		  </script>
		
		
		 
		 
		</head>
<body onload="timeout()”>
<div class="container">
<div class="col-sm-2"> </div>


 <h2 class="text-center text-primary"> GATE QUIZ </h2> <div id="time" style="float:right"> timeout </div> 
		
	<script type="text/javascript">
    var timeLeft=2*60;
    </script>
              
	
	<h2 class="text-center text-success"> Welcome <?php echo $_SESSION['username']; ?> </h2> <br>
  
   <div class="col-lg-8 m-auto d-block">
	              <div class="card" >
                     

		     <h3 class="text-center card-header">  Welcome <?php echo $_SESSION['username']; ?> Select only one out of four.   </h3>

	       </div><br>

	 <form action="check.php" id="form1" method="post">

	 <?php

	 for($i=1 ; $i < 6 ; $i++){
	 $q = " select * from questions where qid = $i";
	 $query = mysqli_query($con, $q);

	 while ($rows = mysqli_fetch_array($query) ) {
	 	?>
	 	
	 	<div class="card">
	 		<h4 class="card-header"> <?php echo $rows['question']  ?>  </h4>


	 		<?php
	 			 $q = " select * from answer where ans_id = $i";
				 $query = mysqli_query($con, $q);

				 while ($rows = mysqli_fetch_array($query) ) {
				 	?>

  				 	<div class="card-body">
				 		
				 		<input type="radio" name="quizcheck[<?php echo $rows['ans_id']; ?>]" value="<?php echo $rows['aid']; ?>"> 
				 		<?php echo $rows['answer']; ?>

				 	</div>

<?php
	 }
	 }
	}

	 ?>


	 <input type="submit" name="submit" value="Submit" class="btn btn-success m-auto d-block">

</form>
</div>
</div><br><br>

	<div class="m-auto d-block">
	<a href="logout.php" class="btn btn-primary "> LOGOUT </a>
	</div><br>

	<div>
		<h5 class="text-center">©2018 gatequiz </h5>
	</div><br><br>


	</div>
	





	
</div>

</body>
</html>