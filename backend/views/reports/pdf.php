<?php
use yii\helpers\Html;
use kartik\growl\Growl;
?>


	<div style="text-align: center;, margin-left: 50%;, margin-right: 50%;">
        <div style = "float: left;, width: 15%;">
            <img src="/electrop/backend/web/uploads/electrop.png"  width="200px" height="200px">
        </div>
        <div style = "float: left;, margin-left: 0%;, width: 75%;">
            <h3><?= 'Electrop ' . $model->type . ' Report'; ?></h3>
            <p style = "text-align: center;">P.O. Box 4010 Arecibo P.R. 00614 || Tel. (787) 815-0000 Ext. 9999</p>
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
                <th style = "padding-left: 3%;, height: 30px;"><?php 
                if($groupedBy != 'All' && $groupedBy != 4)
                {
                  echo $model->findCategoryId($model->refers_to);
                }
                else if($groupedBy == 4)
                {
                  echo $model->findItemName($model->item_selected);
                }
                else 
                {
                    echo $model->refers_to;
                }
                 ?></th>
            </tr>
						<tr>
								<th style = "text-align: right;, font-weight: bold;">Title:</th>
								<td style = "padding-left: 3%;, height: 30px;"><?= $model->title; ?></td>
						</tr>
            <tr>
                <th style = "text-align: right;, font-weight: bold;">Description:</th>
                <td style = "padding-left: 3%;, height: 30px;"><?= $model->description; ?></td>
            </tr>
            <tr>
                <th style = "text-align: right;, font-weight: bold;">From:</th>
                <td style = "padding-left: 3%;, height: 30px;"><?= $fromDate; ?></td>
            </tr>
            <tr>
                <th style = "text-align: right;, font-weight: bold;">To:</th>
                <td style = "padding-left: 3%;, height: 30px;"><?= $toDate; ?></td>
            </tr>
        </table>
        <br>
        <br>
        <?php 

        //total sum of the revenue.
        $sumRevenue = 0;
        //Iterable for the foreach.
        $i = 0;
        //Boolean 
        $passedOnce = false;
        $sameOrder = false;

                if($allOrders && $ordersInfo != null)
                    {                            ?>
                        <div style="margin-left: 15%; margin-top: 15%;">
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

                               if(sizeof($order->contains) > 1 && $passedOnce && $orderNum == $order->order_number)
                               {
                                   if($i != 1){
                                       $i += 1;
                                   }
                                   else 
                                   {
                                       $i = 1;
                                   }
                               }
                               else 
                               {
                                   $i = 0;
                               }

                               if($groupedBy && $model->item_selected != '')
                               {
                                  if($order->contains[$i]->item_id != $model->item_selected)
                                  {
                                     $i += 1;
                                  }
                               }
                               else if($groupedBy != 'All' && $groupedBy != 4)
                               {
                                   if($order->contains[$i]->item->item_category_id != $groupedBy)
                                  {
                                     $i += 1;
                                  }
                               }
                            ?>
                            <tbody>
                                <tr style="background: WhiteSmoke; text-align:center;">
                                <td style="padding: 5px 10px;"> <?= $order->contains[$i]->item_id; ?></td>
                                <th style="padding: 5px 10px;"><?= '$' . $order->contains[$i]->item->production_cost; ?></th>
                                <th style="padding: 5px 10px;"><?= "$" . $order->contains[$i]->item->gross_price;
                                ?></th>            
                                <td style="padding: 5px 10px;"><?= $order->contains[$i]->quantity_in_order; ?></td>
                                <td style="padding: 5px 10px;"><?php
                                
                                    if($model->type == 'Sales')
                                    {
                                        echo '$' . ($order->contains[$i]->quantity_in_order * $order->contains[$i]->item->gross_price);
                                    } 
                                    else 
                                    {
                                        echo '$' . (($order->contains[$i]->quantity_in_order * $order->contains[$i]->item->gross_price) - ($order->contains[0]->quantity_in_order * $order->contains[0]->item->production_cost));
                                        $sumRevenue += (($order->contains[$i]->quantity_in_order * $order->contains[$i]->item->gross_price) - ($order->contains[0]->quantity_in_order * $order->contains[0]->item->production_cost));
                                    }
                                
                                ?></td>
                                </tr>
                            </tbody>
                            <?php 
                                if(sizeof($order->contains) > 1)
                                {
                                    $passedOnce = true;
                                    $orderNum = $order->order_number;
                                    $i += 1;
                                }
                                else
                                {
                                    $i = 0;
                                }
                            
                            endforeach;  ?>
                            <tfoot>
                                <tr style="background: #e50000;
                                    color: white;
                                    text-align: right;">
                                <th style="padding: 5px 10px; color: white;" colspan="3">Grand Total</th>
                                <th style="padding: 5px 10px; font-family: monospace; color: white;"><?php 
                                
                                if($allOrders && $groupedBy == 'All')
                                {
                                    echo $sumQty[0]->amount_sum;
                                }
                                else
                                {
                                    echo $sumQty[0]->amount_sum;
                                }
                                ?></th>
                                <th style="padding: 5px 10px; font-family: monospace; color: white;"><?php 
                                
                                if($model->type == 'Sales')
                                {
                                    if($allOrders && $groupedBy == 'All')
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
                        <br>
                        <br>
                        <br>
                    <div class="panel">
                        <h2>Queries Executed: </h2>
                        <div class="panel-body">
                            <div> <span style="font-size: 16px;"><?= 'Search Query: ' . $sql;  ?></span> </div>
                            <br>
                            <div> <span><?php 
                            if($groupedBy == 'All')
                            {
                                echo 'Sum Quantity Query: ' . $sumAllQty;
                            }
                            else 
                            {
                                echo 'Sum Quantity Query: ' . $sqlGroupByQty;
                            }
                            ?></span> </div> 
                            <br>
                            <div> <span><?php 
                            if($groupedBy == 'All')
                            {
                                echo 'Sum Total Price Query: ' . $sumAllQty;
                            }
                            else 
                            {
                                echo 'Sum Total Price Query: ' . $sqlGroupByPrice;
                            } 
                            ?></span> </div>
                        </div> 
                    </div>
                    
            <?php   } 
                    else 
                    {
                        echo "No orders were made in this time frame or there aren't any with stickers in this category.";
                    }
                  
                   ?>
</div>

