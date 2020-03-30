<?php
namespace app\components\grid;
use yii\grid\DataColumn;
use yii\helpers\Html;

class Value5Column extends DataColumn
{
    protected function renderDataCellContent($model, $key, $index)
    {
        $value = $this->getDataCellValue($model, $key, $index);
        if (isset($value) && $value<=3){
            $class = 'warning';
            if ($value<=2){
                $class='danger';
            }
            return Html::tag('span', Html::encode($value), ['class' => 'badge badge-'.$class]);
        }else{
            return $value === null ? $this->grid->emptyCell : $value;
        }
    }
}