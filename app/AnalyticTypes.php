<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class AnalyticTypes extends Model
{
    protected $fillable = ['name', 'units', 'is_numeric', 'num_decimal_places'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'annalytic_types';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

}
