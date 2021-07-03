<?php
    use yii\helpers\Html;
    use yii\widgets\DetailView;
?>
<div class="box box-primary users-view">
    <div class="box-header">
        <div class="pull-left">
            <h3 class="box-title"><?= html_encode(view_param('pageHeading')) ?></h3>
        </div>
        <div class="pull-right">
            <?= Html::a(t('app', 'Update'), ['update', 'id' => $model->user_id], ['class' => 'btn btn-xs btn-success']) ?>
            <?= Html::a(t('app', 'Delete'), ['delete', 'id' => $model->user_id], [
                'class' => 'btn btn-xs btn-danger',
                'data' => [
                    'confirm' => t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>
    <div class="box-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'user_id',
                'first_name',
                'last_name',
                [
                    'label' => 'Group Name',
                    'value' => ($model->group_id) ? Html::a($model->group->name, ['/admin/groups/view', 'id' => $model->group_id]) : t('app', 'No Group'),
                    'format' => 'raw',
                ],
                'email:email',
                'timezone',
                [
                    'label' => 'Status',
                    'attribute' => 'status',
                    'value'     => function($model) {
                        return t('app',ucfirst(html_encode($model->status)));
                    },
                ],
                'created_at',
                'updated_at',
            ],
        ]) ?>
    </div>

</div>
