<?php

namespace App\Observers;

use App\Models\AdminModel;

class AdminModelObserver
{
    public function creating(AdminModel $model) {
        $model->setUuid();
        $model->setCreatedBy();
        $model->enableCreateLog();
    }

    public function saving(AdminModel $model) {
        $model->setUpdatedBy();
    }
    
    public function deleting(AdminModel $model) {
        $model->setDeletedBy();
    }
    
}
