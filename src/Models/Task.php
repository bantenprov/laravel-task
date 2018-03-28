<?php namespace Bantenprov\Task\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * The TaskModel class.
 *
 * @package Bantenprov\Task
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class Task extends Model
{
    use SoftDeletes;
    
    protected $table = 'task';
    
    public $timestamps = true;

    protected $fillable = ['project_id','staf_id','member_id','name','description','start_date','end_date','parrent_id'];

    protected $hidden = ['deleted_at'];

    protected $dates = ['deleted_at'];

    /* relation table */

    public function getStaf()
    {
        return $this->belongsTo(config('task.models.staf'),'staf_id','id');
    }

    public function getMember()
    {
        return $this->belongsTo(config('task.models.member'),'member_id','id');
    }

    public function getProject()
    {
        return $this->hasOne(config('task.models.project'),'id','project_id');
    }

    public function getComment()
    {        
        return $this->hasMany(config('task.models.comment'),'task_id');
    }
}
