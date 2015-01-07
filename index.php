<html>
	<head>
		<style>
			.container{width: 900px; margin: 0px auto;}
			.required{color:#F00; display: none; text-align: center;}
			table tr td{
				width: 150px;
			}
			input{width: 200px;}
			select{width: 200px;}
			.last td{
				border: none;
			}
			h1, h2{
				text-transformation: uppercase;
			}
			h1{color: #f00;}
			h2{color: #0f0;}
			.warning{
				color: #f00;
				font-size: 16px;
				font-weight: bold;
			}
		</style>
		
		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
		<script>
			//testing vars
			//var names = ['Kyle','Keegan','Dino'];
				//,'Kenny','Matt','Dino','Stacy','Lindy','Pete','Tim','Scott','Joe','Jill','Aaron','Sarah','Nate','Matts','Duy','Joe'];
			
			//var emails = ['Kyle@stormfrog.com','fauxkeegan@gmail.com','dinomannn@hotmail.com'];
				//,'Kenny@fauxgeek.com','Matt@fauxgeek.com','Dino@fauxgeek.com','Stacy@fauxgeek.com','Lindy@fauxgeek.com','Pete@fauxgeek.com','Tim@fauxgeek.com','Scott@fauxgeek.com','Joe@fauxgeek.com','Jill@fauxgeek.com','Aaron@fauxgeek.com','Sarah@fauxgeek.com','Nate@fauxgeek.com','Matts@fauxgeek.com','Duy@fauxgeek.com','Joe@fauxgeek.com'];
			
			var nop;
			var lop = new Array();
			var loe = new Array();
			var ss = new Array();
			var re = new Array();
			var allTheNumbers = new Array();
			var changeSlides = true;
			
			$(document).ready(function(){
				$(".container > .container").hide();
		
				$("#con1").show();
				$('#submit1').click(function(){
					nop = $('#sel').val();
					
					populateAllTheNumbers();
					
					for(var i = 0; i < nop ; i++){
						//$("#namesAndEmails").append("<tr><td>Person " + (i+1) + ":</td><td>Email " + (i+1) + ":</td></tr>");
						$("#namesAndEmails").append("<tr><td><input type='text' value='' name='name' /></td><td><input type='email' value='' name='email' /></td></tr>");
						//$("#namesAndEmails").append("<tr><td><input type='text' value='" + names[i] + "' name='name' /></td><td><input type='email' value='" + emails[i] + "' name='email' /></td></tr>");
					}
					
					$("#con1").hide(500);
					$("#con2").show(500);
				});
				
				$('#submit2').click(function(e){
					changeSlides = true;
					$('input').each(function(){
						$(this).css('border','1px solid #000');
						if($(this).val() == ''){
							changeSlides = false;
							$(this).css('border','1px solid #f00');
						}
					});
					
					if(changeSlides){
						$("#con2").hide(500);
						randomizeEveryone();
						$("#con3").show(500);
					}						
				});

				$('#reset').click(function(){
					$('input').val('');
					$("#con2").hide(500);
					$("#con3").hide(500);
					$("#con1").show(500);
					$('tr').remove();
					$('#namesAndEmails').appendTo('<tr><th>Name:</th><th>Email:</th></tr>');
				});
			});
			
			function populateAllTheNumbers(){
				for(var i = 0; i < nop; i++){allTheNumbers.push(i);}
				console.log(allTheNumbers);
			}
			
			function randomizeEveryone(){
				var rn;
				var flag = true;
				var run = 20;
				getAllPeople();
				
				for(var i = 0; i < nop; i++){					
					while(flag){
						rn = (Math.ceil((Math.random() * nop) - 1));
						
						if(i == rn){
							rn = (Math.ceil((Math.random() * nop) - 1));
						}else if(allTheNumbers[rn] != -1){
							ss.push(lop[rn]);
							//sse.push(loe[rn]);
							allTheNumbers[rn] = -1;
							flag = false;
							sendEmail(lop[i], ss[i], loe[i]);
						}
					}
					flag = true;
				}
				
				//testList(ss);
			}
			
			function sendEmail(from, to, toEmail){
				var ajaxRequest;
				ajaxRequest = new XMLHttpRequest();
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4){
						$('#checkSession').html(ajaxRequest.responseText);
					}
				}
				
				var queryString = "?to=" + to;
				queryString += "&from=" + from;
				queryString += "&toEmail=" + toEmail;
				
				
				//console.log(queryString);
				ajaxRequest.open("GET", "email.php" + queryString, true);
				ajaxRequest.send(null);
			}
			
			function getAllPeople(){
				$('input[type="text"]').each(function(){  lop.push($(this).val()); });
				$('input[type="email"]').each(function(){ loe.push($(this).val()); });
			}
		</script>
	</head>
	
	<body>
		<div class="container">
			<h1>SECRET SANTA RANDOMIZER</h1>
			<div class="container" id="con1">
				<h2>How many people would you like to send this to?</h2>
				<select name="num" id="sel">
					<option value="dead">NUMBERS</option>
					<?php for($i = 3; $i <= 17; $i++): ?>
						<option value="<?php echo $i?>"><?php echo $i?></option>
					<?php endfor ?>
				</select><br />
				<button id="submit1" value="Submit 1">Submit</button>
			</div>
			<div class="container" id="con2">
				<h2>Who are these bitches?</h2>
				<table id="namesAndEmails">
					<tr>
						<th>Name:</th>
						<th>Email:</th>
					</tr>
				</table>
				<div class="warning">
					<p>Hey, just so you know, when you submit it goes to everyone on this list. Make sure all those emails are correct!</p>
					<p>Also, this may be sent to your junk email. Tell everyone on this list to check there if they don't recieve the email</p>
				</div>
				<button id="submit2" value="Submit 2">Submit</button><!--button id="reset" value="">Reset</button-->
			</div>
			<div class="container" id="con3">
				<h2>ENJOY YOUR FUCKING CHRISTMAS</h2>
			</div>
		</div>
	</body>
</html>
