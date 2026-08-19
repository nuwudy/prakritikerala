<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use App\Models\ShippingRule;
use App\Services\ShippingCalculator;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class ManualCreateOrder extends Page
{
    protected static string $resource = OrderResource::class;
    protected string $view = 'filament.resources.orders.pages.manual-create-order';

    public ?Customer $customer = null;
    public ?ProductVariant $variant = null;
    public int $quantity = 1;
    public float $subtotal = 0.0;
    public float $shippingFee = 0.0;
    public float $taxRate = 0.0; // placeholder, admin can edit later
    public float $taxAmount = 0.0;
    public float $discount = 0.0;
    public float $total = 0.0;
    public ?string $phone = null;
    public ?string $whatsappLink = null;

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('phone')
                ->label('Customer Phone')
                ->required()
                ->placeholder('Enter phone number')
                ->reactive()
                ->afterStateUpdated(fn (callable $set, $state) => $this->lookupCustomer($state, $set)),
            Forms\Components\Select::make('customer_id')
                ->label('Existing Customer')
                ->options(fn () => Customer::pluck('name', 'id'))
                ->searchable()
                ->placeholder('Select existing customer or leave empty')
                ->reactive()
                ->afterStateUpdated(fn (callable $set, $state) => $this->populateFromCustomer($state, $set)),
            Forms\Components\Select::make('variant_id')
                ->label('Product Variant')
                ->options(fn (callable $get) => $this->variantOptions())
                ->searchable()
                ->required()
                ->reactive()
                ->afterStateUpdated(fn (callable $set, $state) => $this->loadVariant($state, $set)),
            Forms\Components\TextInput::make('quantity')
                ->numeric()
                ->default(1)
                ->minValue(1)
                ->reactive()
                ->afterStateUpdated(fn () => $this->recalculate()),
            Forms\Components\TextInput::make('discount')
                ->numeric()
                ->default(0)
                ->reactive()
                ->afterStateUpdated(fn () => $this->recalculate()),
            Forms\Components\Placeholder::make('subtotal')
                ->label('Subtotal')
                ->content(fn () => '₹' . number_format($this->subtotal, 2)),
            Forms\Components\Placeholder::make('shipping_fee')
                ->label('Shipping Fee')
                ->content(fn () => '₹' . number_format($this->shippingFee, 2)),
            Forms\Components\Placeholder::make('tax_amount')
                ->label('Tax')
                ->content(fn () => '₹' . number_format($this->taxAmount, 2)),
            Forms\Components\Placeholder::make('total')
                ->label('Total')
                ->content(fn () => '₹' . number_format($this->total, 2)),
        ];
    }

    protected function variantOptions(): array
    {
        return ProductVariant::with('product')
            ->get()
            ->mapWithKeys(fn (ProductVariant $v) => [
                $v->id => $v->product->name . ' – ' . $v->weight . ' – ₹' . number_format($v->price, 2),
            ])->toArray();
    }

    private function lookupCustomer(string $phone, callable $set): void
    {
        $customer = Customer::where('phone', $phone)->first();
        $this->customer = $customer;
        if ($customer) {
            $set('customer_id', $customer->id);
        }
    }

    private function populateFromCustomer(?int $customerId, callable $set): void
    {
        if ($customerId) {
            $customer = Customer::find($customerId);
            $this->customer = $customer;
            $this->phone = $customer->phone ?? null;
            $set('phone', $this->phone);
        }
    }

    private function loadVariant(?int $variantId, callable $set): void
    {
        if ($variantId) {
            $this->variant = ProductVariant::find($variantId);
        }
        $this->recalculate();
    }

    private function recalculate(): void
    {
        $price = $this->variant?->price ?? 0;
        $weight = $this->variant?->weight ? $this->parseWeight($this->variant->weight) : 0;
        $this->subtotal = $price * $this->quantity;
        $this->shippingFee = (new ShippingCalculator())->calculate($weight * $this->quantity);
        $this->taxAmount = $this->subtotal * ($this->taxRate / 100);
        $this->total = $this->subtotal + $this->shippingFee + $this->taxAmount - $this->discount;
        $this->whatsappLink = $this->generateWhatsAppLink();
    }

    private function parseWeight(string $weightString): float
    {
        // simple parser: accepts formats like '250g', '1kg'
        if (Str::endsWith($weightString, 'kg')) {
            return (float) rtrim($weightString, 'kg') * 1000;
        }
        if (Str::endsWith($weightString, 'g')) {
            return (float) rtrim($weightString, 'g');
        }
        return 0.0;
    }

    private function generateWhatsAppLink(): ?string
    {
        if (! $this->phone || ! $this->variant) {
            return null;
        }
        $message = "Hello, I would like to place an order:\n" .
            "Product: {$this->variant->product->name}\n" .
            "Variant: {$this->variant->weight}\n" .
            "Quantity: {$this->quantity}\n" .
            "Total: ₹" . number_format($this->total, 2);
        $encoded = urlencode($message);
        return "https://wa.me/{$this->phone}?text={$encoded}";
    }

    protected function getActions(): array
    {
        return [
            Action::make('create')
                ->label('Create Order')
                ->action('createOrder')
                ->color('primary'),
            Action::make('pdf')
                ->label('Download PDF')
                ->action('downloadPdf')
                ->color('secondary')
                ->disabled(fn () => $this->orderId === null),
            Action::make('whatsapp')
                ->label('Open WhatsApp')
                ->url(fn () => $this->whatsappLink)
                ->openUrlInNewTab()
                ->disabled(fn () => $this->whatsappLink === null),
        ];
    }

    public $orderId = null;

    public function createOrder(): void
    {
        DB::transaction(function () {
            $order = Order::create([
                'customer_id'   => $this->customer?->id,
                'status'        => 'pending',
                'payment_method'=> 'cod', // default, admin can edit later
                'payment_status'=> 'pending',
                'total_amount'  => $this->total,
                'shipping_fee'  => $this->shippingFee,
                'discount'      => $this->discount,
                // tax columns already exist
                'tax_rate'      => $this->taxRate,
                'tax_amount'    => $this->taxAmount,
            ]);

            OrderItem::create([
                'order_id'            => $order->id,
                'product_variant_id'  => $this->variant->id,
                'quantity'            => $this->quantity,
                'unit_price'          => $this->variant->price,
                'total_price'         => $this->subtotal,
            ]);

            $this->orderId = $order->id;
        });
    }

    public function downloadPdf()
    {
        if (! $this->orderId) {
            return;
        }
        $order = Order::with('items.productVariant.product')->find($this->orderId);
        $pdf = Pdf::loadView('orders.invoice', ['order' => $order]);
        return response()->streamDownload(
            function () use ($pdf) { echo $pdf->output(); },
            "order_{$order->id}.pdf"
        );
    }
}
