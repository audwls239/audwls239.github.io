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
    $triangle_width  = $triangle_height = "";
    $squre_width     = $squre_height    = "";
    $cuboid_width    = $cuboid_length   = $cuboid_height = "";
    $cylinder_radius = $cylinder_height = "";
    $circle_radius = "";
    $sphere_radius = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $triangle_width  = test_input($_POST["triangle_width"]);
        $triangle_height = test_input($_POST["triangle_height"]);
        $squre_width     = test_input($_POST["squre_width"]);
        $squre_height    = test_input($_POST["squre_height"]);
        $circle_radius   = test_input($_POST["circle_radius"]);
        $cuboid_width    = test_input($_POST["cuboid_width"]);
        $cuboid_length   = test_input($_POST["cuboid_length"]);
        $cuboid_height   = test_input($_POST["cuboid_height"]);
        $cylinder_radius = test_input($_POST["cylinder_radius"]);
        $cylinder_height = test_input($_POST["cylinder_height"]);
        $sphere_radius   = test_input($_POST["sphere_radius"]);
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
    <h2>PHP Form Homework 4-4</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        삼각형<br>
        밑변:
        <input type="text" name="triangle_width" value="<?php echo $triangle_width; ?>"><br>

        높이:
        <input type="text" name="triangle_height" value="<?php echo $triangle_height; ?>">
        <input type="submit" name="submit" value="Submit"><br><br><br>



        직사각형<br>
        가로:
        <input type="text" name="squre_width" value="<?php echo $squre_width; ?>"><br>

        세로:
        <input type="text" name="squre_height" value="<?php echo $squre_height; ?>">
        <input type="submit" name="submit" value="Submit"><br><br><br>



        원<br>
        반지름:
        <input type="text" name="circle_radius" value="<?php echo $circle_radius; ?>">
        <input type="submit" name="submit" value="Submit"><br><br><br>



        직육면체<br>
        가로:
        <input type="text" name="cuboid_width" value="<?php echo $cuboid_width; ?>"><br>

        세로:
        <input type="text" name="cuboid_length" value="<?php echo $cuboid_length; ?>"><br>

        높이:
        <input type="text" name="cuboid_height" value="<?php echo $cuboid_height; ?>">
        <input type="submit" name="submit" value="Submit"><br><br><br>



        원통<br>
        반지름:
        <input type="text" name="cylinder_radius" value="<?php echo $cylinder_radius; ?>"><br>

        높이:
        <input type="text" name="cylinder_height" value="<?php echo $cylinder_height; ?>">
        <input type="submit" name="submit" value="Submit"><br><br><br>


        구<br>
        반지름:
        <input type="text" name="sphere_radius" value="<?php echo $sphere_radius; ?>">
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    echo "<h2>Your Input:</h2>";

    $triangle = (($triangle_width * $triangle_height) / 2);
    $squre = $squre_width * $squre_height;
    $circle = pow($circle_radius, 2) * 3.14;
    $cuboid = $cuboid_width * $cuboid_length * $cuboid_height;
    $cylinder = 3.14 * pow($cylinder_radius, 2) * $cylinder_height;
    $sphere = 4 / 3 * pow($sphere_radius, 3) * 3.14;



    echo "삼각형: ";
    echo $triangle . "<br>";

    echo "직사각형: ";
    echo $squre . "<br>";

    echo "원: ";
    echo $circle . "<br>";

    echo "직육면체: ";
    echo $cuboid . "<br>";

    echo "원통: ";
    echo $cylinder . "<br>";

    echo "구: ";
    echo $sphere . "<br>";
    ?>

</body>

</html>