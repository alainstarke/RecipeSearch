<?php 

include('mlwebdb.inc.php');
$expname="food";

$ipstr = $_SERVER['REMOTE_ADDR'];

$sqlquery = "select MAX(seqno) from $table_exps where expname='$expname' and subject!='test'";

$result = mysqli_query($link, $sqlquery);

$seq = mysqli_fetch_array($result)[0];

if (is_null($seq)) $seq=0; else $seq++; 

if (isset($_GET['subject'])) {$subject=$_GET['subject'];}
	else {$subject="S$seq";}
if (isset($_GET['condnum'])) {$condnum=$_GET['condnum'];}
	else {$condnum=$seq;}


$sqlquery = "INSERT INTO $table_exps (expname, ip, subject, seqno, starttime) VALUES ('$expname', '$ipstr', '$subject', $condnum, NOW())";
$result = mysqli_query($link, $sqlquery);
mysqli_close($link);

session_start();

$d=array("Curry","Burger" ,"Salad", "Pasta"); 
$s=array();
//define 4 orders
$s[0]=array("queryBase.php", "queryVisual.php", "queryRanking.php","queryVisualRanking.php");
$s[1]=array("queryVisual.php", "queryVisualRanking.php","queryBase.php",  "queryRanking.php");
$s[2]=array("queryRanking.php","queryBase.php", "queryVisualRanking.php","queryVisual.php");
$s[3]=array("queryVisualRanking.php","queryRanking.php","queryVisual.php","queryBase.php");

//randomize the query term
shuffle($d);



$_SESSION['c1q']=$s[$condnum%4][0];
$_SESSION['c1qt']=$d[0];
$_SESSION['c2q']=$s[$condnum%4][1];
$_SESSION['c2qt']=$d[1];
$_SESSION['c3q']=$s[$condnum%4][2];
$_SESSION['c3qt']=$d[2];
$_SESSION['c4q']=$s[$condnum%4][3];
$_SESSION['c4qt']=$d[3];


?>
<html>
    <head>
        <title>Intro</title>
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
            <input id="expName" type=hidden name="expname" value="intro">
            <input type=hidden name="nextURL" value="index1.php">
            <input type=hidden name="to_email" value="">
            <!--these will be set by the script -->
			<input type=hidden name="subject" value="<?php echo($subject)?>">
			<input type=hidden id="condnum" name="condnum" value="<?php echo($condnum)?>">
           <input id="choice" type=hidden name="choice" value="">


        <header class="w3-container w3-blue w3-center">
            <h1>Recipe Search Tool</h1>
        </header>
        <div class="w3-white w3-container">

            <h1>First, a few questions</h1>
            <p>You will use our Recipe search tool in this study. Before doing so, we would first like to ask you a few questions about your background and your food preferences.</p>
			<div class="w3-container">
				<label class="w3-text-red"><b>What is your Prolific ID? *</b></label>
			  <input class="w3-input w3-border " name="prolific" type="text" required></p>
			  <p>    
			  <label class="w3-text-red"><b>What is your age? *</b></label>
			  <input class="w3-input w3-border " name="age" type="text" required></p>
			  <p>      
			  <label class="w3-text-red"><b>What is your highest completed education? *</b></label>
			  	<select class="w3-select w3-border" name="education" required>
			    <option value="" disabled selected>Choose your option</option>
			    <option value="1">Less than high school
			   	<option value="2">High school or equivalent</option>
			    <option value="3">Bachelor degree (e.g. BA, BSc)</option>
			    <option value="4">Master degree (e.g. MA, MSc)</option>
			    <option value="5">Doctorate (e.g. PhD)</option>
			    <option value="6">Prefer not to say</option>
			  </select> </p>
			  <p>      
			  <label class="w3-text-red"><b>Do you have any dietary restrictions? *</b></label>
			  <p><input class="w3-check" type="checkbox" >
			<label>Vegan/Vegetarian</label></p>
			<p><input class="w3-check" type="checkbox" name="diabetes" >
			Diabetes</p>
			<p><input class="w3-check" type="checkbox" name="lactose" >
			<label>Lactose intolerance</label></p>
			<p><input class="w3-check" type="checkbox" name="halal" >
			<label>Halal</label></p>
			<p><input class="w3-check" type="checkbox" name="gluten" >
			<label>Gluten free</label></p>
			<p><input class="w3-check" type="checkbox" name="lactose" >
			<label>Lactose intolerance</label></p>
			<label class="w3-text-black">Other, if any: </label>
			<input class="w3-input w3-border " name="last" type="text"></p>

			  <p class="w3-text-red"><b>What is your nationality? *</b>			
			  <input class="w3-input w3-border " name="nationality" type="text" required></p>
			  
			  <p> <label class="w3-text-red"><b>What is your gender? *</b></label></p>
			  <p><input class="w3-radio" type="radio" name="gender" value="male" required>
			  <label>Male &nbsp;&nbsp;&nbsp;</label> 
			  <input class="w3-radio" type="radio" name="gender" value="female">
			  <label>Female &nbsp;&nbsp;&nbsp; </label> 
			  <input class="w3-radio" type="radio" name="gender" value="other" >
			  <label>Other  </label></p>

			  <p> <label class="w3-text-red"><b>I consider my cooking experience to be: *</b></label></p><p>
			  <input class="w3-radio" type="radio" name="cooking" value="cverylow" required>
			  <label>Very low</label></p><p>
			  <input class="w3-radio" type="radio" name="cooking" value="clow">
			  <label>Low</label></p>
			  <input class="w3-radio" type="radio" name="cooking" value="cmedium" >
			  <label>Medium </label></p>
			  <input class="w3-radio" type="radio" name="cooking" value="chigh" >
			  <label>High </label></p>
			  <input class="w3-radio" type="radio" name="cooking" value="cveryhigh" >
			  <label>Very high</label></p>

			  <p> <label class="w3-text-red"><b>I consider my eating habits to be: *</b></label></p><p>
			  <input class="w3-radio" type="radio" name="health" value="vunhealthy" required>
			  <label>Very unhealthy</label></p><p>
			  <input class="w3-radio" type="radio" name="health" value="unhealthy">
			  <label>Unhealthy</label></p>
			  <input class="w3-radio" type="radio" name="health" value="neutral" >
			  <label>Neither healthy nor unhealthy </label></p>
			  <input class="w3-radio" type="radio" name="health" value="healthy" >
			  <label>Healthy </label></p>
			  <input class="w3-radio" type="radio" name="health" value="vhealhty" >
			  <label>Very healthy</label></p>





		  
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
