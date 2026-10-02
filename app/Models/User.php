<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{


    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
    'name',
    'email',
    'password',
    'join_date',
    'role',
    'course_title',
    'subscription_date',
    'plan',
    'renewal_date',
    'status',
];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function inboxMessages(): HasMany
    {
        return $this->hasMany(InboxMessage::class);
    }

    public function supportTickets(): HasMany { return $this->hasMany(SupportTicket::class); }

    public function contentComments(): HasMany { return $this->hasMany(ContentComment::class); }

    public function mastermindGroups(): BelongsToMany
    {
        return $this->belongsToMany(MastermindGroup::class, 'mastermind_group_user')->withPivot('role')->withTimestamps();
    }

    public function programmeEnrollments(): HasMany { return $this->hasMany(ProgrammeEnrollment::class); }
    public function lessonProgress(): HasMany { return $this->hasMany(LessonProgress::class); }
    public function eventAlerts(): HasMany { return $this->hasMany(EventAlert::class); }
    public function mentorAssignments(): HasMany { return $this->hasMany(MentorStudent::class, 'mentor_id'); }
    public function studentAssignments(): HasMany { return $this->hasMany(MentorStudent::class, 'student_id'); }
}
