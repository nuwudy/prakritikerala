<?php

namespace App\Filament\Resources\ShopSettingResource\Pages;

use App\Filament\Resources\ShopSettingResource;
use App\Models\ShopSetting;
use Filament\Resources\Pages\ListRecords;

class ListShopSettings extends ListRecords
{
    protected static string $resource = ShopSettingResource::class;

    public function mount(): void
    {
        // Ensure default settings record exists in database
        $setting = ShopSetting::getSettings();

        // Redirect directly to the Edit page so the client goes straight into the settings form
        redirect(ShopSettingResource::getUrl('edit', ['record' => $setting->id]));
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
