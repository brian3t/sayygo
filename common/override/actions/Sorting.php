<?php

namespace common\override\actions;

use kotchuprik\sortable\actions\Sorting as BaseSorting;

class Sorting extends BaseSorting
{
    // ngxtri: use $order + 1 instead of $order
    public function run()
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            foreach (\Yii::$app->request->post('sorting') as $order => $id) {
                $query = clone $this->query;
                $model = $query->andWhere(['id' => $id])->one();
                if ($model === null) {
                    throw new BadRequestHttpException();
                }
                $model->{$this->orderAttribute} = $order + 1;
                $model->update(false, [$this->orderAttribute]);
            }
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
        }
    }
}