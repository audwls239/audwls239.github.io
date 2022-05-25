<!DOCTYPE html>
<html>
<meta charset="UTF-8">

<?php
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "ticket";

    $conn = new mysqli($servername, $username, $password, $dbname);
    mysqli_set_charset($conn, "utf8");

    $sql = "SELECT id, name, price_child, price_adult, etc FROM price";
    $result = $conn->query($sql);

    $species_array = array();
    $array_len;
    if (0 < $result->num_rows) {
        $array_len = $result->num_rows;
        while($row = $result->fetch_assoc()) {
            array_push(
                $species_array, 
                [
                    'id'          => $row['id'], 
                    'name'        => $row['name'], 
                    'price_child' => $row['price_child'], 
                    'price_adult' => $row['price_adult'], 
                    'etc'         => $row['etc']
                ]
            );
        }
    } 

?>    

<style>
    table, tr, th, td {
        text-align: center;
        border: solid 2px black;
        border-collapse: collapse;
    }
    th {
        width: 100px;
        height: 30px;
    }
    .id {
        width: 25px;
    }
    .etc {
        width: 200px;
    }
</style>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">	
    고객성명 
    <input type='text' name="client_name"/>
    <input type="submit" name="submit" value="합계">
    <br><br>
    <table>
        <thead>
            <tr>
                <th class="id">No</th>
                <th>구분</th>
                <th colspan="2">어린이</th>
                <th colspan="2">어른</th>
                <th class="etc">구분</th>
            </tr>
        </thead>
        <tbody>
            <?php
                for ($i = 0; $i < $array_len; $i++) {
                    echo
                    "<tr>". 
                        "<th class=\"id\">". 
                            $species_array[$i]['id'].
                        "</th>".
                        "<th>". 
                            $species_array[$i]['name'].
                        "</th>". 
                        "<th>". 
                            $species_array[$i]['price_child'].
                        "</th>". 
                        "<th>
                            <select name='ticket_1_$i'>
                                <option value=\"0\">0</option>
                                <option value=\"1\">1</option>
                                <option value=\"2\">2</option>
                                <option value=\"3\">3</option>
                                <option value=\"4\">4</option>
                                <option value=\"5\">5</option>
                                <option value=\"6\">6</option>
                                <option value=\"7\">7</option>
                                <option value=\"8\">8</option>
                                <option value=\"9\">9</option>
                            </select>
                        </th>".
                        "<th>". $species_array[$i]['price_adult']. "</th>".
                        "<th>
                            <select name='ticket_2_$i'>
                                <option value=\"0\">0</option>
                                <option value=\"1\">1</option>
                                <option value=\"2\">2</option>
                                <option value=\"3\">3</option>
                                <option value=\"4\">4</option>
                                <option value=\"5\">5</option>
                                <option value=\"6\">6</option>
                                <option value=\"7\">7</option>
                                <option value=\"8\">8</option>
                                <option value=\"9\">9</option>
                            </select>
                        </th>".
                        "<th class=\"etc\">". $species_array[$i]['etc']. "</th>".
                    "<tr>";
                }
            ?>
        </tbody>
</table>
</form>
<br><br><br>


<?php 
    $client_name = "OOO";
    $counter_array = array();

    for($i = 0; $i < $array_len; $i++) {
        array_push(
            $counter_array, 
            [
                'ticket_1' => 0, 
                'ticket_2' => 0
            ]
        );
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_POST["client_name"] != "") {
            $client_name = $_POST["client_name"];
        }

        for ($i = 0; $i < $array_len; $i++) {
            $counter_array[$i]['ticket_1'] = $_POST["ticket_1_$i"];
            $counter_array[$i]['ticket_2'] = $_POST["ticket_2_$i"];
        }
    }
    
    print_bill($client_name, $counter_array, $species_array, $array_len);
?>

<?php 
    function print_bill($client_name, $counter_array, $species_array, $array_len) {
        date_default_timezone_set("Asia/Seoul");
        
        $now;
        if (date("a") == "am") {
            $now = "오전 ";
        }
        else {
            $now = "오후 ";
        }
        
        echo 
        date("Y"). "년 ". 
        date("m"). "월 ". 
        date("d"). "일 ".
        $now. date("h:i"). "분<br>";
        echo $client_name. " 고객님 감사합니다. <br><br>";

        $sum_price = 0;
        for ($i = 0; $i < $array_len; $i++) {
            if ($counter_array[$i]['ticket_1'] != 0) {
                echo "어린이 ". $species_array[$i]['name']. " ";
                echo $counter_array[$i]['ticket_1']. "매";
    
                echo ": ". $counter_array[$i]['ticket_1'] * $species_array[$i]['price_child']. "<br>";
                $sum_price += $counter_array[$i]['ticket_1'] * $species_array[$i]['price_child'];
            }
        }
        echo "<br>";

        for ($i = 0; $i < $array_len; $i++) {
            if ($counter_array[$i]['ticket_2'] != 0) {
                echo "어른 ". $species_array[$i]['name']. " ";
                echo $counter_array[$i]['ticket_2']. "매";

                echo ": ". $counter_array[$i]['ticket_2'] * $species_array[$i]['price_adult']. "<br>";
                $sum_price += $counter_array[$i]['ticket_2'] * $species_array[$i]['price_adult'];
            }
        }

        echo "<br>";
        echo "합계 ". $sum_price. " 입니다.";
    }
?>


</html>