<?php

set_include_path(dirname(__FILE__));
require_once 'Zend/Loader/Autoloader.php';
$autoloader = Zend_Loader_Autoloader::getInstance();
$autoloader->registerNamespace( 'Zend_' );
ini_set('display_errors', 1);
error_reporting(E_ALL);

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


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Christoph Trattner">
		
	<title>Recipe Search Tool</title><!-- page title -->
	
	<script src="js/jquery-2.1.0.min.js"></script>
    <link rel="stylesheet" href="css/jquery.typeahead.css">
    <script src="js/jquery.typeahead.js"></script>
    
    <script src ="js/tether.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
         <script language=javascript src="mlweb20.js"></script>

        <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
	
	
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-34429356-1']);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>

 <body onLoad="timefunction('onload', 'body', 'body')">
        <!--BEGIN set vars-->
        <script language="javascript">

            //override defaults
            mlweb_outtype = "CSV";
            mlweb_fname = "mlwebform";
            chkFrm = false;
            warningTxt = "Please answer all questions.";
			choice = "";
        </script>


<FORM id="mlwebform" name="mlwebform" onSubmit="return false" method="POST" action="save.php">
 
			<INPUT type=hidden id='processData' name="procdata" value="">
            <!-- set all variables here -->
            <input id="expName" type=hidden name="expname" value="index1">
            <input type=hidden name="nextURL" value="SurveyC1.php">
            <input type=hidden name="to_email" value="">
            <!--these will be set by the script -->
			<input type=hidden name="subject" value="<?php echo($subject)?>">
			<input type=hidden id="condnum" name="condnum" value="<?php echo($condnum)?>">
           <input id="choice" type=hidden name="choice" value="">



<div class="container">

<!-- Page Content -->


<div style="width: 100%; max-width: 500px; margin: 0 auto;">

    <br/><br/>
   	 	<h2 class="text-center">Recipe Search Tool</h2>
        <p class="text-center">Task 1/4</p>
        <p>Use the search bar below to search for a recipe. If you do so, eight recipes will appear on your screen. Please inspect them carefully and click on the recipe that you like the most. Afterwards we will ask you a few questions about the chosen recipe and the list of search results. </p>
        <p> Please use the search bar below to type in the following search term: <b><?php echo($_SESSION['c1qt']);?></b>. It is important that you use <b>exactly</b> this search term.</p>
                    
  			Please click on the recipe that you like the most and would like to cook at home.

  		</p>

    <form id="form-user_v1" name="form-user_v1">
    <div class="typeahead__container">
        <div class="typeahead__field">
 
            <span class="typeahead__query">
                <input class="js-typeahead-user_v1" name="user_v1[query]" onfocus="if (this.hasAttribute('readonly')) {
    this.removeAttribute('readonly');
    // fix for mobile safari to show virtual keyboard
    this.blur();    this.focus();  }" type="search" placeholder="Search for recipe" autocomplete="off">
            </span>
            <span class="typeahead__button">
                <button type="submit">
                    <i class="typeahead__search-icon"></i>
                </button>
            </span>
 
        </div>
    </div>
</form>

    <br/>

    <script>

    $.typeahead({
        input: '.js-typeahead-user_v1',
        minLength: 1,
        dynamic: true,
        delay: 500,
        backdrop: {
            "background-color": "#fff"
        },
        template: function (query, item) {
     
            var color = "#777";
            if (item.status === "owner") {
                color = "#ff1493";
            }

            //alert("hallo");
     
            return '<span class="row">' +
                '<span class="image">' +
                    '&nbsp;&nbsp;<img width="50" src="{{image}}">' +
                "</span>" +
                '&nbsp;&nbsp;<span class="recipe">{{recipe}}</span>' +
            "</span>"
        },
        emptyTemplate: "no result for {{query}}",
        source: {
            recipes: {
                display: "recipe",
               // href: "{{id}}",
                /*data: [{
                    "id": 415849,
                    "recipe": "an inserted user that is not inside the database",
                    "image": "https://avatars3.githubusercontent.com/u/415849",
                    "status":  "contributor"
                }],*/
                ajax: function (query) {
                    return {
                        type: "GET",
                        url: "<?php echo($_SESSION['c1q']);?>",
                        path: "data.recipes",
                        data: {
                            q: "{{query}}"
                        },
                        callback: {
                            done: function (data) {
                                /*for (var i = 0; i < data.data.recipes.length; i++) {
                                    if (data.data.recipes[i].recipe === 'running-coder') {
                                        data.data.recipes[i].status = 'owner';
                                    } else {
                                        data.data.recipes[i].status = 'contributor';
                                    }
                                }*/
                               // console.log(data);
                                return data;
                            }
                        }
                    }
                }
     
            },
           
        },
        callback: {
            onClick: function (node, a, item, event) {


				//add value to form element
            	$("#choice").val(item.recipe);
                timefunction('submit', 'body', 'body')
				document.forms[mlweb_fname].submit();
				     
                // You can do a simple window.location of the item.href
                //alert(JSON.stringify(item));
     
            },
            onSendRequest: function (node, query) {
                console.log('request is sent')
            },
            onReceiveRequest: function (node, query) {
                console.log('request is received')
            }
        },
        debug: true
    });

    </script>

</div>

</div>


</form> 
</body>



</html>


