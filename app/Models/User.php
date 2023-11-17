<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\Identity\Provider;
use App\Enums\Identity\Status;
use Carbon\CarbonInterface;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $email
 * @property null|string $password
 * @property null|string $remember_token
 * @property null|string $avatar
 * @property Status $status
 * @property Provider $provider
 * @property null|string $provider_id
 * @property null|string $access_token
 * @property null|CarbonInterface $email_verified_at
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property null|CarbonInterface $deleted_at
 * @property bool $onboarded
 * @property Collection<Account> $accounts
 */
final class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasUlids;
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'remember_token',
        'avatar',
        'status',
        'provider',
        'provider_id',
        'access_token',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'access_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'status' => Status::class,
        'provider' => Provider::class,
    ];

    public function onboarded(): bool
    {
        return Status::Onboarding !== $this->status;
    }

    public function accounts(): HasMany
    {
        return $this->hasMany(
            related: Account::class,
            foreignKey: 'user_id',
        );
    }
}
