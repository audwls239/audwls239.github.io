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
            } else if ($n_value < 0 || 100 < $n_value) {
                $nameErr = "100이하의 숫자만 넣어주세요.";
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
    <h2>PHP Form Homework 4-3</h2>
    <?php
    echo "100 이하의 정수를 입력해주세요.";
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        n: <input type="text" name="n_value" value="<?php echo $n_value; ?>">
        <span class="error">* <?php echo $nameErr; ?></span>
        <br><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    echo "<h2>Your Input:</h2>";
    echo "n: " . $n_value . "<br>";

    $array = array();

    if (1 <= $n_value) {
        $array[0] = 1;
        $array[1] = 1;
    }

    for ($i = 2; $i < ($n_value + 1); $i++) {
        $array[$i] = $array[$i - 2] + $array[$i - 1];
    }

    for ($i = 0; $i < $n_value; $i++) {
        echo ($i + 1) . " " . $array[$i] . " " . ($array[$i + 1] / $array[$i]) . "<br>";
    }
    ?>

</body>

</html>