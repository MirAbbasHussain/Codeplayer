<?php

include_once 'source/session.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Code Player</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	     <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="HandheldFriendly" content="true"> 
        
        <script type="text/javascript" src="jquery.min.js"></script>
        <style type="text/css">
            body{
                font-family: sans-serif;
                padding:0;
                margin:0;
            }
            #header{

                width:100%;
                height:70px;
                padding:5px;
                background-color: white;
            }
            #logo {
             float: left;
            background-image: url(images/logo1.png);
            height: 70px;
            width: 220px;
            background-size: cover;
            }
            #toggle-container{
                margin:0 auto;
                width:249px;
                padding-top: 30px;
            }
            .toggleButton{
                float:left;
                border:1px solid grey;
                border-right:none;
                font-size:90%;
                font-weight:500;
                padding:6px;
            }
            #html{
                border-top-left-radius: 5px;
                border-bottom-left-radius: 5px;
            }
            #output{
                border-right:1px solid grey;
                border-top-right-radius: 5px;
                border-bottom-right-radius: 5px;
            }
            .active{
                background-color:#E8F2FF;
            }
            .highlightedButton{
                background-color:grey;
            }
            textarea{
                border-color:grey; 
                resize:none;
     
            
            }
            .panel{
                float:left;
                width:50%;
                border-left:none;
                padding-left:6px;
                padding-top:10px;
               
            }
            iframe{
                border:none;
            }
            .hidden{
                display:none;
            }
			.logout{
				text-decoration:none;
				color:black;
				margin-left:700px;
			}
         
        </style> 
</head>
<body>

    <?php if(!isset($_SESSION['username'])): header("location: logout.php");?>

    <?php else: ?>

    <?php endif ?>


    
	
	 <div id="header">
            <div id="logo"> </div>


            <div id="toggle-container">
				
                <div class="toggleButton active" id="html">HTML</div>
                <div class="toggleButton" id="css">CSS</div>
                <div class="toggleButton" id="javascript">JavaScript</div>
                <div class="toggleButton active" id="output">OUTPUT</div>
				<div class="logout" ><a href="logout.php" style="text-decoration:none; color:black;">Logout</a></div>
				
            </div>
        </div>
        <div id="bodyContainer">
		
            <textarea  class="panel" id="htmlPanel" placeholder="Type your HTML code here..."><p id="para"> Hello World!</p></textarea>
            <textarea  class="panel hidden" id="cssPanel" placeholder="Type your CSS code here...">p{color:blue;}</textarea>
            <textarea  class="panel hidden" id="javascriptPanel" placeholder="Type your JavaScript code here...">document.getElementById("para").innerHTML = "Hello, there!!";</textarea>
            <iframe  class="panel" id="outputPanel" title="Output:"></iframe>
		
        </div>
        <script type="text/javascript">
            function updateOutput() {
                
                $("iframe").contents().find("html").html("<html><head><style type='text/css'>" + $("#cssPanel").val() + "</style></head><body>" + $("#htmlPanel").val() + "</body></html>");
                
                document.getElementById("outputPanel").contentWindow.eval($("#javascriptPanel").val());
                
                  }
           
          
            $(".toggleButton").hover(function(){
                $(this).addClass("highlightedButton");
            },function(){
                $(this).removeClass("highlightedButton");
            });
           
            $(".toggleButton").click(function(){
                $(this).toggleClass("active");
                $(this).removeClass("highlightedButton");
                var panelId = $(this).attr("id") +"Panel";
                $("#" + panelId).toggleClass("hidden");
                var numberOfActivePanels =4 - $('.hidden').length;
                $(".panel").width(($(window).width() / numberOfActivePanels - 10));
            })
           
            $(".panel").height($(window).height() - $("#header").height() - 25);
            $(".panel").width(($(window).width() / 2 ) - 10);
            updateOutput();

            $("textarea").on('change keyup paste', function(){
               
            updateOutput(); 
            });



        </script>


</body>
</html>