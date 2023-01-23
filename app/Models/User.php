<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'badge_number',
        'name',
        'email',
        'password',
        'position'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getName()
    {
        return explode(' ', $this->name)[0];
    }

    public function getPosition()
    {
        return Position::where('id', $this->position)->first('position');
    }

    public function totalItems()
    {
        return ItemProfile::count();
    }

    public function functionalItems()
    {
        return ItemProfile::where('classification', 'Functional')->count();
    }

    public function nonFunctionalItems()
    {
        return ItemProfile::where('classification', 'Non-Functional')->count();
    }

    public function itemType($type)
    {
        return ItemProfile::where('type', $type)->count();
    }

    public function countItem($reference_no)
    {
        return SerialNumber::where('reference_no', $reference_no)->count();
    }

    public function requester($id)
    {
        return $this::where('id', $id)->first('name');
    }
}
