<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;

?>

<style>
	.field-listingsearch-searchphrase
	{
		width: 100%;
	}
</style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php $form = ActiveForm::begin([
                    'method'      => 'get',
                    'fieldConfig' => ['options' => ['class' => 'input-group']],
                    'action'      => ['site/search'],
                    'options'     => [
                        'class' => 'search-form'
                    ]
                ]); ?>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                   
						
						<?= $form->field($searchModel, 'searchPhrase', [
                            'template' => "{label}\n{input}\n<div class='input-group-append'>
							  <button  class='btn btn-primary' type='submit' style='position: absolute;border-top-left-radius: 0px;border-bottom-left-radius: 0px;height: 39px;'>
								<i class='fa fa-search'></i>
							  </button>
						</div>\n{hint}\n{error}"])->textInput(['placeholder' => t('app', 'Enter keyword, Ad or store number')])->label(false) ?>
						
                    </div>

                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>