<?php
use yii\helpers\Html;
use kartik\growl\Growl;
?>


	<div style="text-align: center;, margin-left: 50%;, margin-right: 50%;">
        <div style = "float: left;, width: 15%;">
            <img src="http://scene7.zumiez.com/is/image/zumiez/pdp_hero/Married-To-The-Mob-Birdie-Sticker-_261461-front.jpg"  width="200px" height="200px">
        </div>
        <div style = "float: left;, margin-left: 0%;, width: 75%;">
            <h3><?= 'Electrop ' . $model->type . ' Report'; ?></h3>
            <p style = "text-align: center;">PO Box 1234-Arecibo, P.R 00614 Tel. (787) 999-9999 Ext. 9999</p>
            <h3></h3>
        </div>
    </div>

    <div style = "margin-top: 8%;, font-size: large;">
        <p><strong>Report Number: <span><?= $model->id; ?></span></strong></p>
    </div>

    <div style = "margin-top: 3%;, font-size: large;">
        <table>
            <tr>
                <th style = "text-align: right;, font-weight: bold;">Type:</th>
                <td style = "padding-left: 3%;, height: 30px;"><?= $model->type; ?></td>
            </tr>
            <tr>
                <th style = "text-align: right;, font-weight: bold;">Product:</th>
                <th style = "padding-left: 3%;, height: 30px;"><?= $model->refers_to ?></th>
            </tr>
						<tr>
								<th style = "text-align: right;, font-weight: bold;">Title:</th>
								<td style = "padding-left: 3%;, height: 30px;"><?= $model->title; ?></td>
						</tr>
            <tr>
                <th style = "text-align: right;, font-weight: bold;">Description:</th>
                <td style = "padding-left: 3%;, height: 30px;"><?= $model->description; ?></td>
            </tr>
        </table>

        <?php 

        //total sum of the revenue.
        $sumRevenue = 0;

                if($allOrders && $ordersInfo != null)
                    {                            ?>
                        <div style="margin-left: 25%;">
                            <table style="font-family: "Helvetica Neue", Helvetica, sans-serif">
                            <caption style="text-align: left;
                            color: silver;
                            font-weight: bold;
                            text-transform: uppercase;
                            padding: 5px;"><?= Html::encode($model->type); ?></caption>
                            <thead>
                                <tr style="background: #4682b4;
                            color: white;">
                                <th style="text-align: center; color: white; padding: 5px 10px;">Item</th>
                                <th style="text-align: center; color: white; padding: 5px 10px;">Production Price</th>
                                <th style="text-align: center; color: white; padding: 5px 10px;">Gross Price</th>
                                <th style="text-align: center; color: white; padding: 5px 10px;">Quantity Sold</th>
                                <th style="text-align: center; color: white; padding: 5px 10px;"><?= 'Total ' . $model->type; ?></th>
                                </tr>
                            </thead>
                            <?php foreach($ordersInfo as $order): 
                            ?>
                            <tbody>
                                <tr style="background: WhiteSmoke; text-align:center;">
                                <td style="padding: 5px 10px;"> <?= $order->contains[0]->item_id; ?></td>
                                <th style="padding: 5px 10px;"><?= '$' . $order->contains[0]->item->production_cost; ?></th>
                                <th style="padding: 5px 10px;"><?= "$" . $order->contains[0]->item->gross_price;
                                ?></th>            
                                <td style="padding: 5px 10px;"><?= $order->contains[0]->quantity_in_order; ?></td>
                                <td style="padding: 5px 10px;"><?php
                                
                                if($model->type == 'Sales')
                                {
                                    echo '$' . ($order->contains[0]->quantity_in_order * $order->contains[0]->item->gross_price);
                                } 
                                else 
                                {
                                    echo '$' . (($order->contains[0]->quantity_in_order * $order->contains[0]->item->gross_price) - ($order->contains[0]->quantity_in_order * $order->contains[0]->item->production_cost));
                                    $sumRevenue += (($order->contains[0]->quantity_in_order * $order->contains[0]->item->gross_price) - ($order->contains[0]->quantity_in_order * $order->contains[0]->item->production_cost));
                                }
                                
                                ?></td>
                                </tr>
                            </tbody>
                            <?php endforeach;  ?>
                            <tfoot>
                                <tr style="background: #54FF9F;
                                    color: white;
                                    text-align: right;">
                                <th style="padding: 5px 10px;" colspan="3">Grand Total</th>
                                <th style="padding: 5px 10px; font-family: monospace;"><?php 
                                
                                if($allOrders && $groupedBy == 'No Group')
                                {
                                    echo $sumQty;
                                }
                                else
                                {
                                    echo $sumQty[0]->amount_sum;
                                }
                                ?></th>
                                <th style="padding: 5px 10px; font-family: monospace;"><?php 
                                
                                if($model->type == 'Sales')
                                {
                                    if($allOrders && $groupedBy == 'No Group')
                                    {
                                        echo "$" . $sumSales;
                                    }
                                    else
                                    {
                                        echo "$" . $sumSales[0]->total_sum;
                                    }
                                }
                                else 
                                {
                                    echo "$" . $sumRevenue;
                                }
                                
                                ?></th>
                                </tr>
                            </tfoot>
                            </table>
                    </div>
            <?php   } 
                    else 
                    {
                        echo "No orders were made in this time frame.";
                    }
                  
                   ?>
</div>

