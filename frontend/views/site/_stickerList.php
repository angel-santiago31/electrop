<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="row">
  <div class="col-sm-12">
    <?php  if ($stickerList == NULL): ?>
      <div class="container text-left">
            <label>Oops! There are no search results for your search. Please try again.</label>
      </div>
    <?php  endif ?>

    <ul class="list-group">
      <?php foreach($stickerList as $sticker): ?>
          <div class="col-sm-4">
              <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="<?= '/electrop/backend/web/' . $sticker->picture ?>" class="stickerImg">
                    </div>
                    <div class="panel-footer text-center">
                        <label><?= Html::encode($sticker->name)?></label>
                        <br><br>
                        $ <?= Html::encode($sticker->gross_price) ?>
                        <br><br>
                        <div class="btn-group">
                            <?= Html::a('View details', [''], ['class' => 'btn btn-default']) ?>
                            <?= Html::a('<i class="glyphicon glyphicon-shopping-cart"></i> Add to cart', [''], ['class' => 'btn btn-danger redCss']) ?>
                        </div>
                    </div>
              </div>
          </div>
      <?php endforeach; ?>
    </ul>
  </div>
</div>
