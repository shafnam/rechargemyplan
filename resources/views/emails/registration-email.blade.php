<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Welcome to RechargeMyPlan</title>
        <style>				
            p { font-family: Calibri; }		
            #img {
            float: left;
                width: 150px;
                margin: 10px;
            }
            #bodySection {
              
                background-color: #ffffff;
            }
            div.container {
                width: 500px;
                margin: 0 auto;
                border: 1px solid gray;
                background-color: #ffffff;
            }
            #section1 {
                margin-left: 30px;
                margin-right: 30px;
                margin-bottom: 30px;
                background-color: #ffffff;
            }
            #header {
                color: #ff9200;
               font-family: sans-serif;
            }
             #footer {
                margin-top: 20px;
                color: #666666;
                clear: left;
            }
            .clearFloat {clear: both;}
        </style>
    </head>
    <body>
        <div class='container'>
			<div></div>
            <div>
                <div id='section1'>
                    <div id='bodySection'><br />
                        <div align = 'left'>
                            <img id = 'img' src = 'http://rechargemyplan.com/images/recharge-my-plan-logo-black.png' />
                            <div class='clearFloat'></div>
                            <h2 id='header'>Welcome to RechargeMyPlan</h2>
                        </div>
                        <p>    
                            Dear {{$name}} <br /><br />
                            Thank you for registering with RechargeMyPlan. 
                            Login to our website and experience the convenience of recharging a plan at your fingertips.
                            Enjoy recharging with us.<br /><br />
                        </p>
    
                        <div id='footer'>Sincerely,<br />
                            RechargeMyPlan Team<br />
                            Customer support - 860 581 4431<br />
                            E-mail - <a href="mailto:customerservice@rechargemyplan.com">customerservice@rechargemyplan.com</a><br />
                            <?php date('Y-m-d H:i:s') ?><br /><br /><br />
                        </div>
                    </div>
                </div>
            </div>                    
        </div>
    </body>
</html>
