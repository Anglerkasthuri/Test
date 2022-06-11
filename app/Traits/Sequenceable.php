<?php

namespace App\Traits;

trait Sequenceable {
    public static function setSequence($model, $params) {
        $sequence_field = $params['sequence_field'];
        $old_sequence = $params['old_sequence'];
        $new_sequence = $params['new_sequence'];

        $result = $model;
        if(isset($params['conditions'])) {
            $result = __reportConditions($model, $params['conditions']);
        }

        if($old_sequence && $new_sequence) {
            if($old_sequence > $new_sequence) {
                $result->where($sequence_field, '>=', $new_sequence)
                        ->where($sequence_field, '<', $old_sequence)
                        ->increment($sequence_field);
            } else if($new_sequence > $old_sequence) {
                $result->where($sequence_field, '>', $old_sequence)
                        ->where($sequence_field, '<=', $new_sequence)
                        ->decrement($sequence_field);
            }
        }
    }

    public static function getMaxSequence($model, $params) {
        // $max = $model->max($params['sequence_field']) ?? 0;
        if(isset($params['conditions'])) {
            $model = __reportConditions($model, $params['conditions']);
        }
        $max = $model->count('id') ?? 0;
        return  ($params['record_id']) ? $max : $max+1;
    }

}