<?php
use yii\helpers\StringHelper;
use app\models\ListingStat;

$isFavorite = (!empty($model->favorite)) ? true : false;
?>

<a href="<?= url(['/listing/index/', 'slug' => $model->slug]); ?>" title="<?= html_encode($model->category->name); ?>">
	<img alt="<?= html_encode($model->category->name); ?>" src="<?=($model->mainImage) ? $model->mainImage->image : '';?>" srcset="<?=($model->mainImage) ? $model->mainImage->image : '';?>" class=" lazyloaded">
	<span>
		<font style="vertical-align: inherit;">
			<font style="vertical-align: inherit;">
			 <a href="<?= url(['/listing/index/', 'slug' => $model->slug]); ?>" class="name">
        <span class="title"><?= html_encode($model->title); ?></span></a>
			</font>
		</font>
   </span>
</a>

