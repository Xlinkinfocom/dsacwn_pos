<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class CommissionLog extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'commission_log';
    protected $primaryKey = 'commission_log_id';

}
