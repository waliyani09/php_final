<div style="padding-left:16px,border-style: groove;">
<p>Welcome to our website. Please select one option:</p>
<div id="view_inventory">
<?php

    $conn=mysqli_connect("localhost","netuser","4it3lq@YAHOO","salon");
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $result = mysqli_query($conn,"SELECT * FROM product");
    echo "<table border='1'>
    <tr>
    <th>SKU</th>
    <th>Product Name</th>
    <th>Price per unit</th>
    <th>Quantity on hand</th>
    <th>PAR</th>
    </tr>";
    while($row = mysqli_fetch_array($result))
    {
        echo "<tr>";
        echo "<td>" . $row['sku'] . "</td>";
        echo "<td>" . $row['pName'] . "</td>";
        echo "<td>" . $row['ppu'] . "</td>";
        echo "<td>" . $row['qoh'] . "</td>";
        echo "<td>" . $row['par'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_close($conn);

?>
</div>
<div id="perform_service">
  <a href="?value=1" onclick="serve()" id="thread">Thread</a>
  <a href="?value=2" onclick="serve()" id="thread using wax">Thread using wax</a>
  <a href="?value=3" onclick="serve()" id="facial">Facial</a>
  <a href="?value=4" onclick="serve()" id="Eyelash extension">Eyelash extension</a>
  <a href="?value=5" onclick="serve()" id="print receipt">Print Receipt</a>
</div>
<?php
$variable;
if (isset($_GET['value'])){
    $variable = $_GET['value'];
      serve();
      
}
function serve(){
    $conn=mysqli_connect("localhost","netuser","4it3lq@YAHOO","salon");
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    global $variable;
    $query = "SELECT * FROM service WHERE serviceid='$variable'";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($result);
    $sku1 = $row['sku1'];
    $sku2 = $row['sku2'];
    $sku3 = $row['sku3'];
    $q1 = $row['q1'];
    $q2 = $row['q2'];
    $q3 = $row['q3'];
    //mysqli_close($conn);//closing existing connection
    $query1 = "UPDATE product SET qoh=qoh-'$q1' WHERE sku='$sku1' AND sku!=11";
    $query2 = "UPDATE product SET qoh=qoh-'$q2' WHERE sku='$sku2' AND sku!=11";
    $query3 = "UPDATE product SET qoh=qoh-'$q3' WHERE sku='$sku3' AND sku!=11";
    $result1 = mysqli_query($conn,$query1);
    $result2 = mysqli_query($conn,$query2);
    $result3 = mysqli_query($conn,$query3);
    mysqli_close($conn);
}
?>
<?php include"receive_order.php"; ?>
<script>
  document.getElementById("link1").onclick = function(){
    document.getElementById("perform_service").style.display = "inline";
    document.getElementById("view_inventory").style.display = "none";
    document.getElementById("left_recieve_order").style.display="none";
    document.getElementById("right_recieve_order").style.display="none";
  }
  document.getElementById("link3").onclick = function() {
    document.getElementById("view_inventory").style.display = "inline";
    document.getElementById("perform_service").style.display = "none";
    document.getElementById("left_recieve_order").style.display="none";
    document.getElementById("right_recieve_order").style.display="none";
}
  document.getElementById("link2").onclick = function(){
    document.getElementById("left_recieve_order").style.display="inline";
    document.getElementById("right_recieve_order").style.display="inline";
    document.getElementById("perform_service").style.display = "none";
    document.getElementById("view_inventory").style.display = "none";
      
  }

</script>
