<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Invoice - {{ $order->order_number ?? $order->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; margin: 0; padding: 20px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; }
        .logo { max-width: 150px; margin-bottom: 10px; }
        .details, .totals { width: 100%; margin-top: 20px; border-collapse: collapse; }
        .details th, .details td, .totals th, .totals td { padding: 8px; border: 1px solid #ddd; }
        .details th { background: #f5f5f5; }
        .totals { margin-top: 10px; }
        .totals td { text-align: right; }
        .totals .label { text-align: left; }
        .footer { margin-top: 40px; font-size: 0.9em; text-align: center; color: #777; }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/logo.webp') }}" alt="Prakriti Kerala" class="logo"/>
        <h1>Invoice</h1>
        <p>Order #: {{ $order->order_number ?? $order->id }}</p>
        <p>Date: {{ $order->created_at->format('d M Y') }}</p>
    </div>

    <table class="details">
        <thead>
            <tr>
                <th>Product</th>
                <th>Variant (Weight)</th>
                <th>SKU</th>
                <th>Qty</th>
                <th>Unit Price (₹)</th>
                <th>Total (₹)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->productVariant->product->name }}</td>
                    <td>{{ $item->productVariant->weight }}</td>
                    <td>{{ $item->productVariant->sku }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->unit_price, 2) }}</td>
                    <td>{{ number_format($item->total_price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="totals">
        <tr>
            <td class="label">Subtotal:</td>
            <td>₹ {{ number_format($order->subtotal ?? $order->total_amount - $order->shipping_fee - $order->tax_amount + $order->discount, 2) }}</td>
        </tr>
        <tr>
            <td class="label">Discount:</td>
            <td>- ₹ {{ number_format($order->discount ?? 0, 2) }}</td>
        </tr>
        <tr>
            <td class="label">Shipping:</td>
            <td>₹ {{ number_format($order->shipping_fee ?? 0, 2) }}</td>
        </tr>
        <tr>
            <td class="label">Tax ({{ $order->tax_rate ?? 0 }}%):</td>
            <td>₹ {{ number_format($order->tax_amount ?? 0, 2) }}</td>
        </tr>
        <tr>
            <td class="label"><strong>Total:</strong></td>
            <td><strong>₹ {{ number_format($order->total_amount ?? 0, 2) }}</strong></td>
        </tr>
    </table>

    <div class="footer">
        <p>Thank you for ordering from Prakriti Kerala – The Gateway to Authenticity.</p>
        <p>Contact: +91 {{ $order->customer->phone ?? '' }} | Email: {{ $order->customer->email ?? '' }}</p>
        <p>Address: {{ $order->customer->address ?? '' }}, {{ $order->customer->city ?? '' }}, {{ $order->customer->state ?? '' }} {{ $order->customer->postal_code ?? '' }}</p>
    </div>
</body>
</html>
