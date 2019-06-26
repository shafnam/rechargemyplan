<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Thank you for your order at RechargeMyPlan</title>
        <style>				
        </style>
    </head>
    <body>
        <div marginwidth='0' marginheight='0'>
            <div style='background-color:#f5f5f5;margin:0;padding:70px 0 70px 0;width:100%'>
                <table border='0' cellpadding='0' cellspacing='0' height='100%' width='100%'>
                    <tbody>
                        <tr>
                            <td align='center' valign='top'>
                                <table border='0' cellpadding='0' cellspacing='0' width='800' style='background-color:#fdfdfd;border:1px solid #dcdcdc;border-radius:3px!important'>
                                    <tbody>
                                        <!-- HEADER PART -->
                                        <tr>
                                            <td align='center' valign='top'>

                                                <table border='0' cellpadding='0' cellspacing='0' width='800' style='background-color:#000;border-radius:3px 3px 0 0!important;color:#ffffff;border-bottom:0;font-weight:bold;line-height:100%;vertical-align:middle;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif'>
                                                    <tbody>
                                                        <tr>
                                                            <td style='padding:36px 48px;'>
                                                                <h1 style='color:#ffffff;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:30px;font-weight:300;line-height:150%;margin:0;text-align:left'>Thank You For Your Order</h1>
                                                            </td>
                                                            <td style='padding:36px 48px;'>
                                                                <div>
                                                                    <p style='margin-top:0'>
                                                                        <img src='https://rechargemyplan.com/images/rmp-tm-email-logo.png' alt='RechargeMyPlan' style='border:none;display:inline;font-size:14px;font-weight:bold;height:auto;line-height:100%;outline:none;text-decoration:none;text-transform:capitalize'>
                                                                    </p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </td>
                                        </tr>
                                        <!-- /.HEADER PART -->
                                        <!-- BODY PART -->
                                        <tr>
                                            <td align='center' valign='top'>

                                                <table border='0' cellpadding='0' cellspacing='0' width='700'>
                                                    <tbody>
                                                        <tr>
                                                            <td valign='top' style='background-color:#fdfdfd'>

                                                                <table border='0' cellpadding='20' cellspacing='0' width='100%'>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td valign='top' style='padding: 40px 20px;'>
                                                                                <div style='color:#000;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:14px;line-height:150%;text-align:left'>

                                                                                    <p style='margin:0 0 16px; font-size: 16px;'>Dear Customer, <br/>
                                                                                    Your Payment has been accepted. The order details are as below:
                                                                                    </p><br>
                                                                                    {{-- @if($invoice) --}}
                                                                                    {{-- $invoice --}}
                                                                                    {{-- @endif --}}
                                                                                    <h3 style='border-bottom: 2px solid #fd0909; padding-bottom: 10px;'>Product Details</h3>
                                                                                    <table cellspacing='0' cellpadding='6' style='width:100%;font-family:&#39;Helvetica Neue&#39;,Helvetica,Roboto,Arial,sans-serif;color:#000;border:1px solid #e4e4e4' border='1'>
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th scope='col' style='text-align:left;color:#000;border:1px solid #e4e4e4;padding:12px'>Product</th>
                                                                                                <th scope='col' style='text-align:left;color:#000;border:1px solid #e4e4e4;padding:12px'>Description</th>
                                                                                                <th scope='col' style='text-align:left;color:#000;border:1px solid #e4e4e4;padding:12px'>Qty</th>
                                                                                                <th scope='col' style='text-align:left;color:#000;border:1px solid #e4e4e4;padding:12px'>Price</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                        <?php 
                                                                                        $items = $invoice['items'];
                                                                                        foreach ($items as $item) 
                                                                                        {
                                                                                        ?>
                                                                                            <tr>
                                                                                                <td style='text-align:left;vertical-align:middle;border:1px solid #eee;word-wrap:break-word;color:#000;padding:12px'><?php echo $item['name']; ?></td>
                                                                                                <td style='text-align:left;vertical-align:middle;border:1px solid #eee;word-wrap:break-word;color:#000;padding:12px;line-height:25px;'><strong>Recharge No : </strong><?php echo $item['recharge_number']; ?></td>
                                                                                                <td style='text-align:left;vertical-align:middle;border:1px solid #eee;word-wrap:break-word;color:#000;padding:12px'><?php echo $item['qty']; ?></td>
                                                                                                <td style='text-align:left;vertical-align:middle;border:1px solid #eee;word-wrap:break-word;color:#000;padding:12px'><?php echo number_format($item['price'] , 2); ?></td>
                                                                                            </tr>
                                                                                        <?php
                                                                                        }                                                                                            
                                                                                        ?>                                                                                            
                                                                                        </tbody>
                                                                                    </table>
                                                                                    <br><br>
                                                                                    <h3 style='border-bottom: 2px solid #fd0909; padding-bottom: 10px;'>Order Summary</h3>
                                                                                    <table cellspacing='0' cellpadding='6' style='width:100%;font-family:&#39;Helvetica Neue&#39;,Helvetica,Roboto,Arial,sans-serif;color:#000;border:1px solid #e4e4e4' border='1'>
                                                                                        <tfoot>
                                                                                            <tr>
                                                                                                <th scope='row' width='50%' style='text-align:right;border-top-width:4px;color:#000;border:1px solid #e4e4e4;padding:12px'>Subtotal:</th>
                                                                                                <td width='50%' style='text-align:left;border-top-width:4px;color:#000;border:1px solid #e4e4e4;padding:12px'>
                                                                                                    <span><?php echo number_format($invoice['subtotal'] , 2); ?></span>
                                                                                                </td>
                                                                                            </tr>
                                                                                            {{-- <tr>
                                                                                                <th scope='row' width='50%' style='text-align:right;color:#000;border:1px solid #e4e4e4;padding:12px'>Shipping:</th>
                                                                                                <td width='50%' style='text-align:left;color:#000;border:1px solid #e4e4e4;padding:12px'>Free shipping</td>
                                                                                            </tr> --}}
                                                                                            <tr>
                                                                                                <th scope='row' width='50%' style='text-align:right;color:#000;border:1px solid #e4e4e4;padding:12px'>(+) Processing Fee:</th>
                                                                                                <td width='50%' style='text-align:left;color:#000;border:1px solid #e4e4e4;padding:12px'><?php echo number_format($invoice['handling'] , 2); ?></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th scope='row' width='50%' style='text-align:right;color:#000;border:1px solid #e4e4e4;padding:12px'>Total:</th>
                                                                                                <td width='50%' style='text-align:left;color:#000;border:1px solid #e4e4e4;padding:12px'>
                                                                                                    <span><?php echo number_format($invoice['total'] , 2); ?></span>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tfoot>
                                                                                    </table>
                                                                                    <table cellspacing='0' cellpadding='0' style='width:100%;vertical-align:top' border='0'>
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td style='text-align:left;color:#000;border:1px solid #e4e4e4;padding:12px' valign='top' width='50%'>
                                                                                                    <h3 style='color:#000;display:block;font-weight: bold;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:16px;font-weight:bold;line-height:130%;margin:16px 0 8px;text-align:left'>Customer Details</h3>
                                                                                                    <p style='color:#000;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;margin:0 0 16px'>
                                                                                                        Email:
                                                                                                        <span style='color:#000;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif'>
                                                                                                            <a href='mailto:shafna@witellsolutions.com' target='_blank'><?php echo $invoice['customer_email']; ?></a>
                                                                                                        </span>
                                                                                                    </p>
                                                                                                </td>
                                                                                                {{-- <td style='text-align:left;color:#000;border:1px solid #e4e4e4;padding:12px' valign='top' width='50%'>
                                                                                                    <h3 style='color:#000;display:block;font-weight: bold;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:16px;font-weight:bold;line-height:130%;margin:16px 0 8px;text-align:left'>Shipping Details</h3>
                                                                                                    <p style='color:#000;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;margin:0 0 16px'>
                                                                                                        fathima shafna<br/>
                                                                                                        102 West Main St, New Britain, CT, 06051
                                                                                                    </p>
                                                                                                </td> --}}
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <!-- /.BODY PART -->
                                        <!-- FOOTER PART -->
                                        <tr>
                                            <td align='center' valign='top'>
                                                <table border='0' cellpadding='10' cellspacing='0' width='700'>
                                                    <tbody>
                                                        <tr>
                                                            <td valign='top' style='padding:0'>
                                                                <table border='0' cellpadding='10' cellspacing='0' width='100%'>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td colspan='2' valign='middle' style='padding:0 48px 30px 48px;border:0;color:#000;font-family:Arial;font-size:12px;line-height:125%;text-align:left'>
                                                                                <p>Your plan will be activated within few minutes.
                                                                                If this payment was not done by you, Contact customerservice@rechargemyplan.com at your earliest. 
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan='1' valign='middle' style='padding:0 48px 48px 48px;border:0;color:#000;font-family:Arial;font-size:12px;line-height:125%;text-align:left'>
                                                                                <p>Sincerely,<br/>
                                                                                RechargeMyPlan Team<br/>
                                                                                Customer support - 860 581 4431<br/>
                                                                                E-mail - <a href='mailto:customerservice@rechargemyplan.com'>customerservice@rechargemyplan.com</a><br/><?php date("Y-m-d H:i:s") ; ?>
                                                                                <br/>
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan='2' valign='middle' style='padding:0 48px 48px 48px;border:0;color:#000;font-family:Arial;font-size:12px;line-height:125%;text-align:center'>
                                                                                <p>RechargeMyPlan<sup>TM</sup></p>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <!-- FOOTER PART -->
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>        
    </body>
    <?php //dd($invoice['subtotal']);?>
</html>
