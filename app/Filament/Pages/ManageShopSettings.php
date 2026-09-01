<?php

namespace App\Filament\Pages;

use App\Models\ShopSetting;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Actions\Action;

class ManageShopSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-building-storefront';
    protected static ?string $navigationLabel = 'Shop & Delivery Settings';
    protected static ?string $title = 'Shop & Delivery Settings';
    protected static string|\UnitEnum|null $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.manage-shop-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = ShopSetting::getSettings();
        $this->form->fill($settings->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Warehouse / Shop Location')
                    ->description('Configure the physical location of your store/warehouse. Distance to customer addresses will be measured from these coordinates.')
                    ->schema([
                        Forms\Components\TextInput::make('shop_name')
                            ->label('Store / Brand Name')
                            ->required()
                            ->default('Prakriti Kerala'),
                        Forms\Components\Textarea::make('warehouse_address')
                            ->label('Warehouse Physical Address')
                            ->placeholder('e.g. Building No 12, MG Road, Kochi, Kerala 682016')
                            ->rows(2),
                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\TextInput::make('latitude')
                                ->label('Warehouse Latitude')
                                ->numeric()
                                ->required()
                                ->helperText('e.g. 9.9312328 (Kochi)'),
                            Forms\Components\TextInput::make('longitude')
                                ->label('Warehouse Longitude')
                                ->numeric()
                                ->required()
                                ->helperText('e.g. 76.2673041 (Kochi)'),
                        ]),
                    ]),

                Forms\Components\Section::make('Free Local Delivery Rules')
                    ->description('Set up automatic free delivery for customers close to your warehouse.')
                    ->schema([
                        Forms\Components\Toggle::make('enable_free_delivery')
                            ->label('Enable Free Local Delivery')
                            ->default(true)
                            ->helperText('When enabled, orders within the specified radius get 100% free delivery.'),
                        Forms\Components\TextInput::make('free_delivery_radius_km')
                            ->label('Free Delivery Radius')
                            ->numeric()
                            ->suffix('km')
                            ->default(3.00)
                            ->helperText('Customers located within this distance (e.g. 3.0 km) will automatically receive FREE delivery.'),
                        Forms\Components\TextInput::make('standard_shipping_fee')
                            ->label('Standard Shipping Fee (Outside Free Radius)')
                            ->numeric()
                            ->prefix('₹')
                            ->default(50.00)
                            ->helperText('Fallback delivery fee charged to customers located outside the free delivery zone.'),
                    ]),

                Forms\Components\Section::make('Payment Settings')
                    ->description('Configure checkout payment options.')
                    ->schema([
                        Forms\Components\Toggle::make('enable_cod')
                            ->label('Enable Cash on Delivery (COD)')
                            ->default(true)
                            ->helperText('Allow customers to pay with cash when their order is delivered.'),
                        Forms\Components\TextInput::make('cod_extra_charge')
                            ->label('COD Handling Fee')
                            ->numeric()
                            ->prefix('₹')
                            ->default(0.00)
                            ->helperText('Optional extra charge for COD orders. Set 0 for no additional fee.'),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $state = $this->form->getState();
        $settings = ShopSetting::getSettings();
        $settings->update($state);

        Notification::make()
            ->title('Settings saved successfully!')
            ->success()
            ->send();
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Settings')
                ->submit('save')
                ->color('primary'),
        ];
    }
}
