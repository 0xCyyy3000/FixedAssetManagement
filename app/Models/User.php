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

    public function functionalItems()
    {
        return SerialNumber::where('condition', 'Functional')->count();
    }

    public function nonFunctionalItems()
    {
        return SerialNumber::where('condition', 'Non-Functional')->count();
    }
    
    public function countItem($reference_no)
    {
        return SerialNumber::where('reference_no', $reference_no)->count();
    }
    public function allItems()
    {
        return SerialNumber::count();
    }

    public function requester($id)
    {
        return $this::where('id', $id)->first('name');
    }
    public function totalApproved()
    {
        $repairCount = RepairRequest::where('status', 'Approved')->count();
        $replaceCount = ReplaceRequest::where('status', 'Approved')->count();
        $returnCount = ReturnRequest::where('status', 'Approved')->count();
        $purchaseCount = PurchaseRequest::where('status', 'Approved')->count();

        $count = $repairCount + $replaceCount + $returnCount + $purchaseCount;
        return $count;
    }
    public function totalPending()
    {
        $repairCount = RepairRequest::where('status', 'Pending')->count();
        $replaceCount = ReplaceRequest::where('status', 'Pending')->count();
        $returnCount = ReturnRequest::where('status', 'Pending')->count();
        $purchaseCount = PurchaseRequest::where('status', 'Pending')->count();

        $count = $repairCount + $replaceCount + $returnCount + $purchaseCount;
        return $count;
    }
    public function totalDenied()
    {
        $repairCount = RepairRequest::where('status', 'Rejected')->count();
        $replaceCount = ReplaceRequest::where('status', 'Rejected')->count();
        $returnCount = ReturnRequest::where('status', 'Rejected')->count();
        $purchaseCount = PurchaseRequest::where('status', 'Rejected')->count();

        $count = $repairCount + $replaceCount + $returnCount + $purchaseCount;
        return $count;
    }

}
