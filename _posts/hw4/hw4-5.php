<!DOCTYPE HTML>
<html>

<head>
	<style>
		.error {
			color: #FF0000;
		}

		table,
		tr,
		td {
			border: 2px solid black;
			border-collapse: collapse;
		}

		td {
			padding: 10px;
			width: 20px;
			height: 20px;
			text-align: center;
		}
	</style>
</head>

<body>

	<?php
	$year_value = $mon_value = "";
	$year_errMsg = $mon_errMsg = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (year_check($_POST["year_value"])) {
			$year_value = test_input($_POST["year_value"]);
		} else {
			$year_errMsg = "1970년 이상으로 입력해주세요.";
		}

		if (month_check($_POST["mon_value"])) {
			$mon_value = test_input($_POST["mon_value"]);
		} else {
			$mon_errMsg = "1월 부터 12월 사이를 입력해주세요.";
		}
	}

	function year_check($year)
	{
		if (1970 <= $year) {
			return true;
		} else {
			return false;
		}
	}
	function month_check($month)
	{
		if (1 <= $month && $month <= 12) {
			return true;
		} else {
			return false;
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
	<h2>PHP Form Homework 4-5</h2>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		년: <input type="text" name="year_value" value="<?php echo $year_value; ?>">
		<span class="error">* <?php echo $year_errMsg; ?></span><br>
		월: <input type="text" name="mon_value" value="<?php echo $mon_value; ?>">
		<span class="error">* <?php echo $mon_errMsg; ?></span><br>
		<input type="submit" name="submit" value="Submit">
	</form>


	<?php
	function check_date($present_year, $present_month)
	{
		$year_count = 0;
		$inter_count = 0;
		$sum = 0;

		// 0 일
		// 1 월
		// 2 화
		// 3 수
		// 4 목
		// 5 금
		// 6 토
		for ($i = 1970; $i < $present_year + 1; $i++) {
			if (($i % 4) == 0 && ($i % 100) != 0) {
				$inter_count += 1;
			} else {
				$year_count += 1;
			}
		}

		switch ($present_month - 1) {
			case 11:
				$sum += 30;
			case 10:
				$sum += 31;
			case 9:
				$sum += 30;
			case 8:
				$sum += 31;
			case 7:
				$sum += 31;
			case 6:
				$sum += 30;
			case 5:
				$sum += 31;
			case 4:
				$sum += 30;
			case 3:
				$sum += 31;
			case 2:
				if (($present_year % 4) == 0 && ($present_year % 100) != 0) {
					$sum += 29;
				} else {
					$sum += 28;
				}
			case 1:
				$sum += 31;
			default:
				break;
		}

		$sum += (4 + $year_count * 365 + $inter_count * 366);
		$date = $sum % 7;
		if (6 < $date) {
			$date -= 7;
		}

		return $date;
	}


	$this_month = array(
		array(0, 0, 0, 0, 0, 0, 0),
		array(0, 0, 0, 0, 0, 0, 0),
		array(0, 0, 0, 0, 0, 0, 0),
		array(0, 0, 0, 0, 0, 0, 0),
		array(0, 0, 0, 0, 0, 0, 0),
		array(0, 0, 0, 0, 0, 0, 0),
		array(0, 0, 0, 0, 0, 0, 0)
	);

	if ($year_value != "" && $mon_value != "") {
		$start_date = check_date($year_value, $mon_value);

		echo "<table>";
		echo "<tr><td colspan=\"7\">";
		echo $year_value . "년 ";
		echo $mon_value . "월 달력</td></tr>";
		echo "<tr>
			<td>일</td>
			<td>월</td>
			<td>화</td>
			<td>수</td>
			<td>목</td>
			<td>금</td>
			<td>토</td>
		</tr>";

		$this_month_date = 0;
		switch ($mon_value) {
			case 1:
			case 3:
			case 5:
			case 7:
			case 8:
			case 10:
			case 12:
				$this_month_date = 31;
				break;
			case 4:
			case 6:
			case 9:
			case 11:
				$this_month_date = 30;
				break;
			case 2:
				if (($year_value % 4) == 0 && ($year_value % 100) != 0) {
					$this_month_date = 29;
				} else {
					$this_month_date = 28;
				}
				break;
		}

		$x = 0;
		$y = 0;
		for ($x = 0; $x < $start_date; $x++) {
			$this_month[$y][$x] = " ";
		}

		$i = 1;
		while ($i < $this_month_date + 1) {
			$this_month[$y][$x] = $i;
			$i += 1;
			$x += 1;

			if (6 < $x) {
				$y += 1;
				$x = 0;
			}
		}

		for ($i = 0; $i < 7; $i++) {
			echo "<tr>";

			for ($j = 0; $j < 7; $j++) {
				if ($this_month[$i][$j] == "") {
					break;
				}
				echo "<td>" . $this_month[$i][$j] . "</td>";
			}

			echo "</tr>";
		}
		echo "</table>";
	}
	?>

</body>

</html>