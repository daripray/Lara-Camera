<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Validation\ValidationException;
use Filament\Notifications\Notification;

#[Fillable(['name', 'email', 'is_admin', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

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

    protected static function booted(): void
    {
        // User ID 1 Selalu Admin
        static::saving(function (User $user) {
            if ($user->id === 1) {
                $user->is_admin = true;
            }
        });

        static::deleting(function (User $user) {
            if ($user->id === 1) {
                Notification::make()
                    ->title('Akses Ditolak')
                    ->body('User Admin utama tidak boleh dihapus.')
                    ->danger()
                    ->send();

                throw ValidationException::withMessages([
                    'delete' => 'User Admin utama tidak boleh dihapus.',
                ]);
            }
        });

    }

    public function devices()
    {
        return $this->hasMany(Device::class);
    }
}
