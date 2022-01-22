<?php
    session_start();
    $user_id = $_SESSION['user_login'];
    require_once 'vendor/autoload.php';

    use Dompdf\Dompdf;
    require_once './dbconn.php';

    $take = mysqli_query($link, "SELECT * FROM `user` WHERE user_id='$user_id';");
    $taker = mysqli_fetch_assoc($take);
    $name = $taker['name'];
    
    $tb_pinfo = mysqli_query($link, "SELECT * FROM `order_info` Where `user_id`=$user_id order by cardnumber desc limit 1");
    $rowtb = mysqli_fetch_assoc($tb_pinfo);
    $cnum=$rowtb['cardnumber'];
     
    $sqq = mysqli_query($link, "SELECT * FROM `address` Where `address_card`=$cnum");
    $nmm = mysqli_fetch_assoc($sqq);
    $ads=$nmm['city'].','.$nmm['subdistrict'].','.$nmm['district'];
    $html = '<!DOCTYPE html>
    <html lang="en">

    <head>
        
        <style>
            h2 {
                font-family: Verdana, Geneva, Tahoma, sans-serif;
                text-align: center;
            }

            table {
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            td,
            th {
                border: 1px solid #444;
                padding: 8px;
                text-align: left;
            }

            .my-table {
                text-align: right;
            }

            #sign {
                padding-top: 50px;
                text-align: right;
            }
            
        </style>

    </head>

    <body>
    <div>
      <h4>LOGO</h4>
      <h2>NO SHOP</h2>
     </div>
    
     <div style="width:60%s">
     <h4>Shipping Address</h4>
     <table class="table table-bordered">
     <tr>
         <td>ID</td>
         <td>'. $user_id.'</td>
     </tr>
     <tr>
         <td>Name</td>
         <td>'.ucwords($taker['name']).'</td>
     </tr>

     <tr>
         <td>Email</td>
         <td>'. $taker['email'].'</td>
     </tr>

     <tr>
         <td>Mobile</td>
         <td>'. $rowtb['phone'].'</td>
     </tr>
     <tr>
         <td>Address</td>
         <td>'. $ads.'</td>
     </tr>
     <tr>
         <td>Payment Method</td>
         <td>'. $rowtb['pmode'].'</td>
     </tr>
     <tr>
         <td>Date</td>
         <td>'. $rowtb['date'].'</td>
     </tr>
     <tr>
         <td>Card Number</td>
         <td>'. $rowtb['cardnumber'].'</td>
     </tr>
 </table>

</div>

      <br><br>
        <h2>Invoice</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>';

    $i = 1;
    $vt = 0;
    $total = 0;
    $tb_pinfo = mysqli_query($link, "SELECT * FROM `order_info` Where `user_id`=$user_id order by cardnumber desc limit 1");
    $roww = mysqli_fetch_assoc($tb_pinfo);
    $cnum = $roww['cardnumber'];

    $tb_pinfo = mysqli_query($link, "SELECT * FROM orders     
                            WHERE `order_info_id`=$cnum
                            ;");

    while ($row = mysqli_fetch_assoc($tb_pinfo)) {
        $pid=$row['p_id'];
        $pqr=mysqli_query($link, "SELECT * FROM products     
        WHERE `product_id`=$pid
        ;");

        $prow=mysqli_fetch_assoc($pqr);

        $html.= '<tr>
            <td>'.$i.'</td>
            <td>'.$prow['product_title'].'</td>

            <td>'.number_format($prow['product_price'], 2) . '/='.'</td>
            <td>'.$row['qty'].'</td>
            <td>'. number_format(($prow['product_price'] * $row['qty']), 2) . '/='.'</td>
        </tr>';

        $i++;
        $total += ($prow['product_price'] * $row['qty']);
    }
    $vt = ($total * 5) / 100;
    $html.='
    </tbody>
    <tr>
        <th colspan="4" class="my-table">VAT(5%)</th>
        <th>'.number_format($vt, 2) . '/=' .'</th>
    </tr>
    <tr>
        <th colspan="4" class="my-table">Grand Total</th>
        <th>'.number_format($vt + $total, 2) . '/='.'</th>
    </tr>
    <tr>
        <th colspan="4" class="my-table">Grand Total ground Fig</th>
        <th>'.number_format(round($vt + $total), 2) . '/='.'</th>
    </tr>
    <tr>
        <td colspan="5" id="sign">
            signature
        </td>
    </tr>
    </table>
    </body>

    </html>';

    $dompdf=new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4','portrait');
    $dompdf->render();
    $dompdf->stream('invoice.pdf',['Attachment'=>0]);
