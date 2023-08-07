<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $enumStatus = ['todo', 'in_progress', 'done'];

    protected $fillable = [
        'title',
        'description',
        'status',
        'user_assigned_id',
        'user_created_id',
        'deadline'
    ];
    protected $dates = ['deadline'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_assigned_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_created_id');
    }

    public function getDaysUntilDeadlineAttribute()
    {
        return Carbon::now()
            ->startOfDay()
            ->diffInDays($this->deadline, false); // if you are past your deadline, the value returned will be negative.
    }

    public function getAssignedUserAttribute()
    {
        return User::findOrFail($this->user_assigned_id);
    }

    public function getCreatorUserAttribute()
    {
        return User::findOrFail($this->user_assigned_id);
    }

    public static function getStatusesWithIds()
    {
        return [
            'todo' => __('Не розпочато'),
            'in_progress' => __('В процесі'),
            'done' => __('Завершено'),
        ];
    }

    public function getStatusTextAttribute()
    {
        $statuses = $this->getStatusesWithIds();
        return $statuses[$this->status] ?? __('Невідомий статус');
    }

    public function getFormattedDeadlineAttribute()
    {
        return Carbon::parse($this->deadline)->format('d.m.Y');
    }

}
