<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>New order at RechargeMyPlan</title>
        <style>				
        </style>
    </head>
    <body>
        <div style="max-width: 900px; margin: 0 auto; width: 80% padding: 0 1rem;border: 2px solid #848484;">
            <table rules="all" style="border-color: #000;" cellpadding="10" width="100%">
                <tr style='background: #F5F5F5;'>
                    <td colspan='2'><strong>Customer Details  </strong> </td>
                    <td colspan='2'><strong>PayPal Details  </strong> </td>
                </tr>
                <tr style='background: #fff;'>
                    <td width='25%'><strong>Contact Name : </strong> </td>
                    <td><?php echo $transaction['customer_name']; ?></td>
                    <td width='25%'><strong>Transaction ID : </strong> </td>
                    <td><?php echo $transaction['transaction_id']; ?></td>
                </tr>
                <tr style='background: #fff;'>
                    <td width='25%'><strong>Email : </strong> </td>
                    <td><?php echo $transaction['customer_email'];?></td>
                    <td width='25%'><strong>Transaction Date : </strong> </td>
                    <td><?php echo $transaction['payment_date_time']; ?></td>
                </tr>
                <tr style='background: #fff;'>
                    {{-- <td width='25%'><strong>Shipping Details : </strong> </td>
                    <td width='25%'>102 West Main St, New Britain, CT, 06051</td> --}}
                    <td width='25%'><strong>Paypal Email : </strong> </td>
                    <td width='25%'><?php echo $transaction['paypal_email']; ?></td>
                </tr>
            </table>
            <br/>
            <h3 style='border-bottom: 1px solid #333; padding-bottom: 10px;'>Product Details</h3>
            <table rules="all" style="border-color: #fff; margin-top:5px;" border="1" cellpadding="10" width="100%">
                <tr style='background: #F5F5F5;'>
                    <td width='20%'><strong>Item Name</strong> </td>
                    <td width='20%'><strong>Details</strong> </td>
                    <td width='5%'><strong>QTY</strong> </td>
                    <td width='20%'><strong>Price<br/>(USD)</strong> </td>
                </tr>
            <?php 
                $items = $transaction['items'];
                foreach ($items as $item) 
                {
            ?>
                <tr>
                    <td><?php echo $item['name']; ?></td>
                    <td><strong>Recharge No : </strong><?php echo $item['recharge_number']; ?></td>
                    <td><?php echo $item['qty']; ?></td>
                    <td><?php echo number_format($item['price'] , 2); ?></td>
                </tr>
            <?php
                }                                                                                            
            ?>
            </table>
            <br/>
            <table rules="all" style="border-color: #fff; margin-top:5px;" border="1" cellpadding="10" width="100%">
                <tr style='background: #fff;'>
                    <td width='80%' colspan='4' style='text-align:right;'>Gross Total</td>
                    <td width='20%'><?php echo number_format($invoice['subtotal'] , 2); ?></td>
                </tr>
                <tr style='background: #fff;'>
                    <td width='80%' colspan='4' style='text-align:right;'>(+) Handling Fee</td>
                    <td width='20%'><?php echo number_format($invoice['handling'] , 2); ?></td>
                </tr>
                <tr style='background: #fff;'>
                    <td width='80%' colspan='4' style='text-align:right;'>Total Amount</td>
                    <td width='20%'><?php echo number_format($invoice['total'] , 2); ?></td>
                </tr>
            </table>
            <br/><br/>
            <p>PayPal Method : <?php echo $transaction['paypal_method']; ?></p>
            <br/>
            <p>Sent From RMP Website</p>
            <br/>
        </div>
    </body>
    <?php //dd($transaction['subtotal']);?>
</html>
