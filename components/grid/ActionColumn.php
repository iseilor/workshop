<?php

namespace app\components\grid;

use Yii;
use yii\helpers\Html;

class ActionColumn extends \yii\grid\ActionColumn
{
    public $contentOptions = [
        'class' => 'action-column',
    ];

    public $gridViewId=''; // ID используется при AJAX-удалении

    public function init()
    {
        parent::init();
    }

    protected function initDefaultButtons()
    {
        $this->initDefaultButton('view', 'eye');
        $this->initDefaultButton('update', 'pencil-alt');
        $this->initDefaultButton(
            'delete',
            'trash',
            [
                //'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                //'data-method' => 'post',
                //'data-pjax' => 0,
            ]
        );
    }

    protected function initDefaultButton($name, $iconName, $additionalOptions = [])
    {
        if (!isset($this->buttons[$name]) && strpos($this->template, '{' . $name . '}') !== false) {
            $this->buttons[$name] = function ($url, $model, $key) use ($name, $iconName, $additionalOptions) {
                switch ($name) {
                    case 'view':
                        $title = Yii::t('yii', 'View');
                        $class="btn-primary";
                        break;
                    case 'update':
                        $title = Yii::t('yii', 'Update');
                        $class="btn-info";
                        break;
                    case 'delete':
                        $title = Yii::t('yii', 'Delete');
                        $class="btn-danger btn-delete";
                        break;
                    default:
                        $title = ucfirst($name);
                        $class="";
                }
                $options = array_merge(
                    [
                        'title' => $title,
                        'aria-label' => $title,
                        'data-pjax' => '0', // Для AJAX-удаления
                        'class' => 'btn btn-sm '.$class
                    ],
                    $additionalOptions,
                    $this->buttonOptions
                );
                $icon = Html::tag('i', '', ['class' => "fas fa-$iconName"]);
                return Html::a($icon, $url, $options);
            };
        }
    }
}