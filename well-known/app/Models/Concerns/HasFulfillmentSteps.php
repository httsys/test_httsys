<?php

namespace App\Models\Concerns;

use App\Models\User;

/**
 * Shared by CurrencyOrder and MarketplaceOrder — the "seller releases or
 * rejects, then buyer confirms" steps are identical for both, so they live
 * here once instead of being copied into each model.
 */
trait HasFulfillmentSteps
{
    /**
     * The seller can only act once the buyer has actually paid (order is
     * pending review) and hasn't already been actioned.
     */
    public function sellerCanAct()
    {
        return $this->status === 'pending' && $this->seller_status === 'pending';
    }

    public function buyerCanConfirm()
    {
        return $this->seller_status === 'released'
            && $this->buyer_confirmed_at === null
            && in_array($this->status, ['pending', 'completed'], true);
    }

    public function sellerRelease(User $seller)
    {
        $this->assertSeller($seller);

        if (! $this->sellerCanAct()) {
            throw new \RuntimeException('This order can no longer be actioned.');
        }

        $this->update([
            'seller_status' => 'released',
            'seller_acted_at' => now(),
        ]);
    }

    public function sellerReject(User $seller, $reason)
    {
        $this->assertSeller($seller);

        $reason = trim((string) $reason);
        if ($reason === '') {
            throw new \RuntimeException('Please write why you are rejecting this order.');
        }

        if (! $this->sellerCanAct()) {
            throw new \RuntimeException('This order can no longer be actioned.');
        }

        $this->update([
            'seller_status' => 'rejected',
            'seller_note' => $reason,
            'seller_acted_at' => now(),
        ]);
    }

    public function buyerConfirm(User $buyer)
    {
        if ((int) $buyer->id !== (int) $this->buyer_id) {
            throw new \RuntimeException("This isn't your order.");
        }

        if (! $this->buyerCanConfirm()) {
            throw new \RuntimeException('There is nothing to confirm on this order right now.');
        }

        $this->update(['buyer_confirmed_at' => now()]);
    }

    protected function assertSeller(User $seller)
    {
        if ((int) $seller->id !== (int) $this->seller_id) {
            throw new \RuntimeException("This isn't your order.");
        }
    }
}
