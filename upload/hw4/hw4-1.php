<!DOCTYPE HTML>
<html>

<head>
	<style>
		.error {
			color: #FF0000;
		}
	</style>
</head>

<body>
	<?php
	$n_value = $nameErr = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["n_value"])) {
			$nameErr = "값을 넣어주세요";
		} else {
			$n_value = test_input($_POST["n_value"]);
			if (preg_match("/^[a-zA-Z-' ]*$/", $n_value)) {
				$nameErr = "숫자만 넣어주세요";
			}
		}
	}

	function test_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	?>

	<h2>20191449 김명진</h2>
	<h2>PHP Form Homework 4-1</h2>
	<?php
	echo "숫자 n을 입력해주세요.";
	?>

	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		n: <input type="text" name="n_value" value="<?php echo $n_value; ?>">
		<span class="error">* <?php echo $nameErr; ?></span><br>
		<input type="submit" name="submit" value="Submit">
	</form>

	<?php
	echo "<h2>Your Input:</h2>";
	echo "n: " . $n_value . "<br>";

	$prod = 1;
	$sum = 0;
	$fac = 1;

	for ($prod; $prod <= $n_value; $prod++) {
		$sum = $sum + $prod;
		$fac = $fac * $prod;

		echo $prod . " ";
	}
	echo "<br>";
	echo "1 ~ " . $n_value . "까지의 합: " . $sum . "<br>";
	echo "1 ~ " . $n_value . "까지의 곱(" . $n_value . "!): " . $fac . "<br><br>";
	?>

</body>

</html>