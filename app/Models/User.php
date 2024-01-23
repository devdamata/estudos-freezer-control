<?php

namespace App\Models;


use Filament\Panel;
use App\Enums\PanelTypeEnum;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        'password' => 'hashed',
        'panel' => PanelTypeEnum::class,
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        if ($this->panel == PanelTypeEnum::ADMIN) {
            return true;
        }

        if ($this->panel == PanelTypeEnum::APP) {
            return true;
        }

        return false;
    }

    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class);
    }
}
