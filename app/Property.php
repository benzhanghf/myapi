<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'properties';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $fillable = ['guid', 'suburb', 'state', 'country'];

    public static function getRequiredAttributes()
    {
        return ['guid', 'suburb', 'state', 'country'];
    }

    public function analytics()
    {
        return $this->hasMany('PropertyAnalytics');
    }
}
