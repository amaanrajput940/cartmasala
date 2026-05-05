<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'session_id',
        'encrypted_data',
    ];

    protected $casts = [
        'encrypted_data' => 'encrypted',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get decrypted cart data
     */
    public function getCartData(): array
    {
        try {
            return json_decode(Crypt::decryptString($this->encrypted_data), true) ?? [];
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Set encrypted cart data
     */
    public function setCartData(array $data): void
    {
        $this->encrypted_data = Crypt::encryptString(json_encode($data));
    }

    /**
     * Get cart for user or session
     */
    public static function getCart($userId = null, $sessionId = null)
    {
        return static::where(function ($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->first();
    }

    /**
     * Merge guest cart into user cart
     */
    public function mergeCartData(array $guestData): void
    {
        $currentData = $this->getCartData();

        foreach ($guestData as $product => $item) {
            if (isset($currentData[$product])) {
                $currentData[$product]['quantity'] += $item['quantity'];
            } else {
                $currentData[$product] = $item;
            }
        }

        $this->setCartData($currentData);
    }

    public static function getOrCreateCart($userId = null, $sessionId = null)
    {
        $cart = static::getCart($userId, $sessionId);

        if (! $cart) {
            $cart = static::create([
                'user_id' => $userId,
                'session_id' => $sessionId,
                'encrypted_data' => Crypt::encryptString(json_encode([])),
            ]);
        }

        return $cart;
    }
}
