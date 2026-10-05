<?php

namespace App\Console\Commands;

use App\Models\MarketplaceListing;
use Illuminate\Console\Command;

class FinalizeAuctions extends Command
{
    /**
     * Not strictly required — MarketplaceListing::finalizeIfEnded() also
     * runs lazily whenever someone views an ended auction's page, so the
     * site works correctly even without this command scheduled. Wiring it
     * up to cron just means an auction settles the moment it ends rather
     * than waiting for the next visitor.
     */
    protected $signature = 'marketplace:finalize-auctions';

    protected $description = 'Settle any auction listings whose end time has passed';

    public function handle()
    {
        $ended = MarketplaceListing::where('listing_type', 'auction')
            ->where('status', 'active')
            ->where('ends_at', '<=', now())
            ->get();

        $count = 0;

        foreach ($ended as $listing) {
            if ($listing->finalizeIfEnded()) {
                $count++;
            }
        }

        $this->info("Finalized {$count} auction(s) out of {$ended->count()} that had ended.");
    }
}
