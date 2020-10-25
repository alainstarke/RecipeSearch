<?php 
session_start();
if (isset($_GET['subject'])) {$subject=$_GET['subject'];$_SESSION['subject']=$subject;}
 else {
	 if (isset($_SESSION['subject'])) {$subject=$_SESSION['subject'];}
	 else {$subject="anonymous";};
		}
if (isset($_GET['condnum'])) {$condnum=$_GET['condnum'];}
 else {
	 if (isset($_SESSION['condnum'])) {$condnum=$_SESSION['condnum'];$_SESSION['condnum']=$condnum;}
		else {$condnum=-1;};
	}
	
?>
<html>
    <head>
        <title>Survey</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" src="main.js"></script>
        <script type="text/javascript" src="jquery-3.1.1.min.js"></script>
        <script src="jquery.foggy.min.js"></script>
        <script language=javascript src="mlweb20.js"></script>
        <link rel="stylesheet" href="w3.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
		
		
	</head>

    <body class="w3-light-grey w3-content" style="max-width:1600px" onLoad="timefunction('onload', 'body', 'body')">
        <!--BEGIN set vars-->
        <script language="javascript">

            //override defaults
            mlweb_outtype = "CSV";
            mlweb_fname = "mlwebform";
            chkFrm = false;
            warningTxt = "Please answer all questions.";
			choice = "";
        </script>


<FORM id="mlwebform" name="mlwebform" onSubmit="return checkForm(this)" method="POST" action="save.php">
 
			<INPUT type=hidden id='processData' name="procdata" value="">
            <!-- set all variables here -->
            <input id="expName" type=hidden name="expname" value="survey1">
            <input type=hidden name="nextURL" value="index2.php">
			<!-- save query info for first shown query-->
			<input type=hidden name="queryterm" value="<?php echo($_SESSION['c1qt']);?>"> 
            <input type=hidden name="querytype" value="<?php echo($_SESSION['c1q']);?>">
			<input type=hidden name="to_email" value="">
            <!--these will be set by the script -->
			<input type=hidden name="subject" value="<?php echo($subject)?>">
			<input type=hidden id="condnum" name="condnum" value="<?php echo($condnum)?>">
           <input id="choice" type=hidden name="choice" value="">


        <header class="w3-container w3-blue w3-center">
            <h1>Recipe Search Tool</h1>
        </header>
       <div class="w3-white w3-container">
            <h2>Questions about your search for <b><?php echo($_SESSION['c1qt']);?></b> </h2>
            <p> Below, we have formulated a number of propositions about the list of recipes for your search query <b><?php echo($_SESSION['c1qt']);?></b> and your chosen recipe. Please indicate to what extent you (dis)agree with each of them. 
			<h5>The recipe list</h5>
			<div class="w3-row w3-border">
				 <div class="w3-container w3-col w3-white w3-left-align w3-large " style="width: 50%;"></div>
			  <div class="w3-container w3-col w3-gray w3-center" style="width: 10%;" ><b>strongly disagree</b></div>
			  <div class="w3-container w3-col w3-white w3-center" style="width: 10%;" ><b>disagree</b></div>
			  <div class="w3-container w3-col w3-gray w3-center " style="width: 10%;" ><b>neither disagree/agree</b></div>
			  <div class="w3-container w3-col w3-white w3-center" style="width: 10%;" ><b>agree</b></div>
			  <div class="w3-container w3-col w3-gray w3-center " style="width: 10%;" ><b>strongly agree</b></div>
		</div>
<div class="w3-row w3-border">
		  <div class="w3-container w3-col w3-light-grey w3-left-align w3-hover-blue" style="width: 50%;height: 30px">The list of recipes was attractive</div>
		  <div class="w3-container w3-col w3-gray w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Rec-q1" value="-2" required> 1</div>
		  <div class="w3-container w3-col w3-white w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Rec-q1" value="-1" required> 2</div>
		  <div class="w3-container w3-col w3-gray w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Rec-q1" value="0" required > 3</div>
		  <div class="w3-container w3-col w3-white w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Rec-q1" value="1" required > 4</div>
		  <div class="w3-container w3-col w3-gray w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Rec-q1" value="2" required> 5</div>
		</div>
		<div class="w3-row w3-border">
		  <div class="w3-container w3-col w3-light-grey w3-left-align w3-hover-blue" style="width: 50%;height: 30px" >The list of recipes showed too many bad items</div>
		  <div class="w3-container w3-col w3-gray w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Rec-q2" value="-2" required> 1</div>
		  <div class="w3-container w3-col w3-white w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Rec-q2" value="-1" required> 2</div>
		  <div class="w3-container w3-col w3-gray w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Rec-q2" value="0" required> 3</div>
		  <div class="w3-container w3-col w3-white w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Rec-q2" value="1" required> 4</div>
		  <div class="w3-container w3-col w3-gray w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Rec-q2" value="2" required> 5</div>
		</div>
		  <div class="w3-row w3-border">
		  <div class="w3-container w3-col w3-light-grey w3-left-align w3-hover-blue" style="width: 50%;height: 30px" >I did not like the list of recipes</div>
		  <div class="w3-container w3-col w3-gray w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Rec-q3" value="-2" required> 1</div>
		  <div class="w3-container w3-col w3-white w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Rec-q3" value="-1" required> 2</div>
		  <div class="w3-container w3-col w3-gray w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Rec-q3" value="0" required> 3</div>
		  <div class="w3-container w3-col w3-white w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Rec-q3" value="1" required> 4</div>
		  <div class="w3-container w3-col w3-gray w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Rec-q3" value="2" required> 5</div>
		</div>
		  <div class="w3-row w3-border">
		  <div class="w3-container w3-col w3-light-grey w3-left-align w3-hover-blue" style="width: 50%;height: 30px" >The presented recipes matched my preferences</div>
		  <div class="w3-container w3-col w3-gray w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Rec-q5" value="-2" required> 1</div>
		  <div class="w3-container w3-col w3-white w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Rec-q5" value="-1" required> 2</div>
		  <div class="w3-container w3-col w3-gray w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Rec-q5" value="0" required> 3</div>
		  <div class="w3-container w3-col w3-white w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Rec-q5" value="1" required> 4</div>
		  <div class="w3-container w3-col w3-gray w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Rec-q5" value="2" required> 5</div>
		</div>
		
		 <h5>Chosen recipe</h5>
			<div class="w3-row w3-border">
		  <div class="w3-container w3-col w3-light-grey w3-left-align w3-hover-blue" style="width: 50%;height: 30px">I would recommend the chosen recipe to others</div>
		  <div class="w3-container w3-col w3-gray w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Ch-q1" value="-2" required> 1</div>
		  <div class="w3-container w3-col w3-white w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Ch-q1" value="-1" required> 2</div>
		  <div class="w3-container w3-col w3-gray w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Ch-q1" value="0" required> 3</div>
		  <div class="w3-container w3-col w3-white w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Ch-q1" value="1" required> 4</div>
		  <div class="w3-container w3-col w3-gray w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Ch-q1" value="2" required> 5</div>
		</div>
		<div class="w3-row w3-border">
		  <div class="w3-container w3-col w3-light-grey w3-left-align w3-hover-blue" style="width: 50%;height: 30px" >My chosen recipe could become one of my favorites</div>
		  <div class="w3-container w3-col w3-gray w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Ch-q2" value="-2" required > 1</div>
		  <div class="w3-container w3-col w3-white w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Ch-q2" value="-1" required> 2</div>
		  <div class="w3-container w3-col w3-gray w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Ch-q2" value="0" required> 3</div>
		  <div class="w3-container w3-col w3-white w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Ch-q2" value="1" required> 4</div>
		  <div class="w3-container w3-col w3-gray w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Ch-q2" value="2" required> 5</div>
		</div>
		  <div class="w3-row w3-border">
		  <div class="w3-container w3-col w3-light-grey w3-left-align w3-hover-blue" style="width: 50%;height: 30px" >I think I would enjoy eating the chosen recipe</div>
		  <div class="w3-container w3-col w3-gray w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Ch-q4" value="-2" required> 1</div>
		  <div class="w3-container w3-col w3-white w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Ch-q4" value="-1" required> 2</div>
		  <div class="w3-container w3-col w3-gray w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Ch-q4" value="0" required> 3</div>
		  <div class="w3-container w3-col w3-white w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Ch-q4" value="1" required> 4</div>
		  <div class="w3-container w3-col w3-gray w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Ch-q4" value="2" required> 5</div></div>
		  <div class="w3-row w3-border">
		  <div class="w3-container w3-col w3-light-grey w3-left-align w3-hover-blue" style="width: 50%;height: 30px">The recipe I chose matched my preferences</div>
		  <div class="w3-container w3-col w3-gray w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Ch-q5" value="-2" required> 1</div>
		  <div class="w3-container w3-col w3-white w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Ch-q5" value="-1" required> 2</div>
		  <div class="w3-container w3-col w3-gray w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Ch-q5" value="0" required> 3</div>
		  <div class="w3-container w3-col w3-white w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Ch-q5" value="1" required> 4</div>
		  <div class="w3-container w3-col w3-gray w3-center w3-hover-blue" style="width: 10%;" ><input class="w3-radio" type="radio" name="Ch-q5" value="2" required> 5</div>
		</div>
		</div>
       
		<div class="w3-white w3-container w3-center w3-padding">
			<button class="confirm w3-button w3-center w3-round-xlarge" name="submit" value="confirm">Confirm</button>
		</div>
        <footer class="w3-container w3-blue">

        </footer>
</div>

        <script type="text/javascript">

			// here the json file to generate the trial, for a particular set in the json file is generated. If the third attribute is set to random, it will select an order at random.
			// if you enter a number, it will choose one of the orders using modulo of that number
			// now taking the number from the condnum variable to set the order of the options
            o=$("#condnum").val();
			if (o<0) {o="random"};
            
			//generateTrial("json_files/tv.json", "dynSet", o);

            			
     		//function that starts the page
	$(document).ready(function () { 
		$(".confirm").click(function (event) {
			if (choice=="" && $(".choiceButton").length>0) {event.preventDefault();return false;}           
			});
		});	
	
			

        </script>
    </body>
</html>
