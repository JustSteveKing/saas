<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Account\Status;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

/**
 * @property string $id
 * @property string $name
 * @property string $email
 * @property Status $status
 * @property string $user_id
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property User $user
 */
final class Account extends Model
{
    use HasFactory;
    use HasUlids;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'status',
        'user_id',
    ];

    protected $casts = [
        'status' => Status::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }
}
