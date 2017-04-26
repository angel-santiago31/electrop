<?php
use yii\helpers\Html;
use kartik\growl\Growl;
?>


	<div style="text-align: center;, margin-left: 50%;, margin-right: 50%;">
        <div style = "float: left;, width: 15%;">
            <img src="/electrop/backend/web/uploads/electrop.png"  width="200px" height="200px">
        </div>
        <div style = "float: left;, margin-left: 0%;, width: 75%;">
            <h3><?= 'Electrop ' . $model->order_number . ' Invoice'; ?></h3>
            <p style = "text-align: center;">P.O. Box 4010 Arecibo P.R. 00614 || Tel. (787) 815-0000 Ext. 9999</p>
            <h3></h3>
        </div>
    </div>

    <div style = "margin-top: 8%;, font-size: large;">
        <p><strong>Order Date: <span><?= $model->order_date; ?></span></strong></p>
    </div>

    <div style = "margin-top: 3%;, font-size: large;">
        <p><strong>malangas</strong></p>
        <!--<table>
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
        </table>-->

</div>

