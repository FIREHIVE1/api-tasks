<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Task
 *
 * @package App
 */
class Group extends Model
{

    /** @var int */
    const STATUS_ASSIGNED = 0;

    /** @var int */
    const STATUS_IN_PROGRESS = 1;

    /** @var int */
    const STATUS_NOT_DONE = 2;

    /** @var int */
    const STATUS_DONE = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'owner_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * Get the user that owns the task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function own()
    {
        return $this->belongsTo('App\User', 'owner_id', 'id');
    }

    /**
     * Group usergroups
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userGroups()
    {
        return $this->hasMany('App/userGroups','group_id','id');
    }

}
