<?php
session_start();

if(!isset($_SESSION['access_token'])) {
	header('Location: index.php');
	exit();	
}

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.1.9/jquery.datetimepicker.min.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.1.9/jquery.datetimepicker.min.js"></script>
<link rel="stylesheet" href="styles.css">
</head>

<body>
  
<div class ='container'>

    <h1>Choose The Platforms to Get Events in Your Calendar</h1>

    <form>
    <div class="inputGroup">
        <input id="option1" name="option1" type="checkbox"/>
        <label for="option1">CodeForces</label>
    </div>
  
    <div class="inputGroup">
        <input id="option2" name="option2" type="checkbox"/>
        <label for="option2">CodeChef</label>
    </div>
    <div class="inputGroup">
        <input id="option3" name="option3" type="checkbox"/>
        <label for="option3">LeetCode</label>
    </div>
    <div class="inputGroup">
        <input id="option4" name="option4" type="checkbox"/>
        <label for="option4">TopCoder</label>
    </div>
    <div class="inputGroup">
        <input id="option5" name="option5" type="checkbox"/>
        <label for="option5">HackerEarth</label>
    </div>
    </form>

    <button id="create-event">Add To My Calender &#8594</button>

</div>

</body>
<script>

$("#create-event").on('click', function(e) {
	
    parameters = { 	
        codeforces: $('#option1').is(":checked")?'yes': 'no',
        codechef:$('#option2').is(":checked")?'yes': 'no',
        leetcode:$('#option3').is(":checked")?'yes': 'no',
        topcoder:$('#option4').is(":checked")?'yes': 'no',
        hackerearth:$('#option5').is(":checked")?'yes': 'no',
	};

	$.ajax({
        type: 'POST',
        url: 'ajax.php',
        data: { sites: parameters },
        dataType: 'json',
        success: function(response) {
        	$("#create-event").removeAttr('disabled');
        	alert("SuccessFully Added To YOUR CALENDAR");
        },
        error: function(response) {
            $("#create-event").removeAttr('disabled');
            alert(response.responseJSON.message);
        }
    });
});
</script>

</html>



