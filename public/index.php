<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>PHP Template Engine Benchmarks</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body>

<div class="container">

	<h1>PHP Template Engine Benchmarks</h1>

	<form id="form" class="form-horizontal well" role="form">
		<div class="form-group">
			<label for="engine" class="col-sm-2 control-label">Engine</label>
			<div class="col-sm-2">
				<select id="engine" name="engine" class="form-control">
					<option value="php">Native PHP</option>
					<option value="smarty">Smarty</option>
					<option value="twig">Twig</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="test" class="col-sm-2 control-label">Test</label>
			<div class="col-sm-4">
				<select id="test" name="test" class="form-control">
					<optgroup label="Echo Same Variable">
						<option value="echo-100">Echo Same Variable x 100</option>
						<option value="echo-1000">Echo Same Variable x 1000</option>
						<option value="echo-10000">Echo Same Variable x 10000</option>
					</optgroup>
					<optgroup label="Echo Different Variables">
						<option value="variables-100">Echo 100 Different Variables</option>
						<option value="variables-1000">Echo 1000 Different Variables</option>
						<option value="variables-10000">Echo 10000 Different Variables</option>
					</optgroup>
					<optgroup label="Foreach Loop">
						<option value="foreach-100">Foreach Loop x 100</option>
						<option value="foreach-1000">Foreach Loop x 1000</option>
						<option value="foreach-10000">Foreach Loop x 10000</option>
					</optgroup>
					<optgroup label="Including">
						<option value="include-parent-100">Include x 100</option>
						<option value="include-parent-1000">Include x 1000</option>
						<option value="include-parent-10000">Include x 10000</option>
					</optgroup>
					<optgroup label="Inheritance">
						<option value="inheritance-child-100">Inheritance x 100</option>
						<option value="inheritance-child-1000">Inheritance x 1000</option>
						<option value="inheritance-child-1000">Inheritance x 10000</option>
					</optgroup>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="number" class="col-sm-2 control-label">Number of Tests</label>
			<div class="col-sm-2">
				<select id="cache" name="number" class="form-control">
					<?php for ($i=1; $i<=25; $i++) { ?>
					<option value="<?=$i?>"<?php if ($i === 10) { ?> selected<?php } ?>><?=$i?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="cache" class="col-sm-2 control-label">Use Cache</label>
			<div class="col-sm-2">
				<select id="cache" name="cache" class="form-control">
					<option value="0">No</option>
					<option value="1" selected>Yes</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="outliers" class="col-sm-2 control-label">Exclude Outliers</label>
			<div class="col-sm-2">
				<select id="cache" name="outliers" class="form-control">
					<option value="0">No</option>
					<option value="1" selected>Yes</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-primary">Run Tests</button>
			</div>
		</div>
	</form>

	<table id="results" class="table hidden">
		<thead>
			<tr>
				<th>Test</th>
				<th>Time (seconds)</th>
				<th>Memory (bytes)</th>
			</tr>
		</thead>
		<tbody></tbody>
		<tfoot></tfoot>
	</table>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/run.js"></script>

</body>
</html>