<?php
	require_once("quiz.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Flat Quiz</title>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="style.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-tasks"></span> Flat Quiz</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
<?php
	if(isset($_POST['submit'])):
	$final = '';
		foreach($_POST['question'] as $key => $value):
			foreach($QUESTIONS[$key]['weight'][$value] as $vitamin => $value):
				$final[$vitamin] += $value;
			endforeach;
		endforeach;	
		foreach($final as $key => $value):
			if($value < 10):
				$final['not_enough'][$key] = $value;
			else:
				$final['enough'][$key] = $value;
			endif;
		endforeach;?>
	<div class="row">
	<div class="panel panel-default">
 		<div class="panel-heading">Quiz Results</div>
		<div class="panel-body">
<?php
		if(count($final['enough']) > 0):
?>
		<p>You are getting enough of <?php foreach($final['enough'] as $k => $v): echo "<strong>" . $k . "</strong> "; endforeach;?></p>
<?php
		endif;
?>
<?php
		if(count($final['not_enough']) > 0):
?>
		<p>You are not getting enough of <?php foreach($final['not_enough'] as $k => $v): echo "<strong>" . $k . "</strong> "; endforeach;?></p>
<?php
		endif;
?> 	</div>
	</div>	
<?php
	else:
?>
	<div class="row">
	<div class="panel panel-default">
 		<div class="panel-heading">Welcome to the Quiz</div>
		<div class="panel-body">
		<p><h2>In the last month, how often did you eat...</h2></p>
 	</div>
	<table class="table table-striped">
	<form action="index.php" method="POST">
<?php
	foreach($QUESTIONS as $KEY => $VALUE):
?>
		<tr>
		<td class="text-right"><strong><?php echo $VALUE['item']; ?></strong></td>
		<td>
			<select name="question[<?php echo $KEY; ?>]" class="form-control">
				<option value="1">Never or less than once a month</option>
				<option value="2">1-3 times per month</option>
				<option value="3">1 per week</option>
				<option value="4">2-4 per week</option>
				<option value="5">5-6 per week</option>
				<option value="6">1 per day</option>
				<option value="7">2-3 per day</option>
				<option value="8">4-5 per day</option>
			</select>
		</td>
		</tr>
<?php
	endforeach;
?>
	<tr>
		<td colspan="2">
			<input type="submit" name="submit" class="btn btn-default form-control">
		</td>
	</tr>
	</table>
	</div>
	</form>
	</div>
<?php
	endif;
?>
    </div><!-- /.container -->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
