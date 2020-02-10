<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyAnalytics extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'property_analytics';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $fillable = ['value', 'property_id', 'analytic_type_id'];
}
