<!DOCTYPE html>
<html lang="fr" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="x-apple-disable-message-reformatting">
    <title>Confirmation de commande - Sound Tags</title>
    <meta name="color-scheme" content="light dark">
    <meta name="supported-color-schemes" content="light dark">
    <style>
        :root {
            color-scheme: light dark;
            supported-color-schemes: light dark;
        }
        body, table, td, p, a, li, blockquote {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }
        table, td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
        img {
            -ms-interpolation-mode: bicubic;
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }
        /* Style pour forcer l'aspect visuel sur mobile */
        @media only screen and (max-width: 620px) {
            .container { width: 100% !important; }
            .content { padding: 20px !important; }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #0f172a; color: #ffffff;">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#0f172a">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <table class="container" role="presentation" border="0" cellpadding="0" cellspacing="0" width="650" style="background-color: #1e293b; border-radius: 8px; overflow: hidden;">
                    
                    <tr>
                        <td align="center" bgcolor="#1e293b" style="padding: 50px 30px;">
                            <img src="{{ $message->embed(public_path('storage/images/logo.png')) }}" alt="Sound Tags" width="180" style="display: block; margin-bottom: 20px; border: 0;" />
                            <h1 style="font-size: 36px; font-weight: 800; color: #ffffff; margin: 0; letter-spacing: 1px;">Sound Tags</h1>
                            <div style="background-color: #ffffff; color: #0f172a; padding: 12px 24px; border-radius: 30px; display: inline-block; margin-top: 20px; font-weight: 700; font-size: 16px;">
                                ✓ Commande confirmée
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="content" style="padding: 40px 30px;">
                            
                            <div style="background-color: #334155; border-radius: 15px; padding: 30px; text-align: center; border: 1px solid #475569; margin-bottom: 30px;">
                                <div style="font-size: 24px; font-weight: 700; color: #ffffff; margin-bottom: 5px;">Commande #{{ $order->order_number }}</div>
                                <p style="color: #cbd5e1; font-size: 16px; margin: 0;">{{ $order->created_at->format('d/m/Y à H:i') }}</p>
                            </div>
                            
                            <p style="font-size: 18px; color: #ffffff; margin-bottom: 20px; font-weight: 600;">Bonjour {{ $customerData['first_name'] ?? $customerData['name'] ?? 'Cher client' }},</p>
                            <p style="color: #cbd5e1; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">Nous avons bien reçu votre commande. Votre paiement a été validé. Voici le détail de vos achats :</p>
                            
                            @php
                                $items = is_string($cartItems) ? json_decode($cartItems, true) : $cartItems;
                                $items = is_array($items) ? $items : [];
                            @endphp
                            
                            @if(count($items) > 0)
                                <h3 style="font-size: 20px; color: #ffffff; margin-bottom: 20px; border-bottom: 2px solid #334155; padding-bottom: 10px;">🎵 Vos articles</h3>
                                @foreach($items as $item)
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #334155; border-radius: 12px; margin-bottom: 15px; border: 1px solid #475569;">
                                        <tr>
                                            <td style="padding: 20px;">
                                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                    <tr>
                                                        <td valign="top">
                                                            <div style="font-weight: 700; color: #ffffff; font-size: 16px;">{{ $item['name'] ?? 'Produit' }}</div>
                                                            <div style="color: #94a3b8; font-size: 14px; margin-top: 5px;">Quantité : {{ $item['quantity'] ?? 1 }}</div>
                                                        </td>
                                                        <td valign="top" align="right" style="width: 100px;">
                                                            <div style="font-weight: 700; color: #ffffff; font-size: 16px;">
                                                                {{ isset($item['price']) ? number_format($item['price'], 2) . ' €' : ($item['formatted_price'] ?? '-') }}
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                @endforeach
                            @endif

                            @php
                                $summaryData = is_string($summary) ? json_decode($summary, true) : $summary;
                                $summaryData = is_array($summaryData) ? $summaryData : [];
                            @endphp

                            @if(count($summaryData) > 0)
                            <div style="margin: 30px 0; border-top: 1px solid #334155; padding-top: 20px;">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                    @if(isset($summaryData['subtotal']))
                                    <tr>
                                        <td style="padding: 5px 0; color: #cbd5e1;">Sous-total</td>
                                        <td align="right" style="padding: 5px 0; color: #ffffff;">{{ number_format($summaryData['subtotal'], 2) }} €</td>
                                    </tr>
                                    @endif
                                    @if(isset($summaryData['shipping_cost']))
                                    <tr>
                                        <td style="padding: 5px 0; color: #cbd5e1;">Livraison</td>
                                        <td align="right" style="padding: 5px 0; color: #ffffff;">{{ number_format($summaryData['shipping_cost'], 2) }} €</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td style="padding: 15px 0 5px 0; color: #ffffff; font-size: 22px; font-weight: 800;">Total payé</td>
                                        <td align="right" style="padding: 15px 0 5px 0; color: #ffffff; font-size: 22px; font-weight: 800;">{{ $order->formatted_amount }}</td>
                                    </tr>
                                </table>
                                <div style="text-align: center; margin-top: 20px;">
                                    <span style="background-color: rgba(255,255,255,0.1); color: #94a3b8; padding: 6px 15px; border-radius: 20px; font-size: 13px;">
                                        Paiement réalisé via Stripe
                                    </span>
                                </div>
                            </div>
                            @endif

                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top: 30px;">
                                <tr>
                                    @php
                                        $shippingData = is_string($shippingAddress) ? json_decode($shippingAddress, true) : $shippingAddress;
                                    @endphp
                                    @if($shippingData)
                                    <td valign="top" width="50%" style="padding-right: 10px;">
                                        <h4 style="color: #ffffff; margin-bottom: 10px; font-size: 16px;">🏠 Livraison</h4>
                                        <p style="color: #cbd5e1; font-size: 14px; line-height: 1.5;">
                                            @if(isset($shippingData['address']) && !empty($shippingData['address']))
                                                {{ $shippingData['address'] }}<br>
                                            @endif
                                            @if(isset($shippingData['postal_code']) && isset($shippingData['city']))
                                                {{ $shippingData['postal_code'] }} {{ $shippingData['city'] }}<br>
                                            @endif
                                            @if(isset($shippingData['country']) && !empty($shippingData['country']))
                                                {{ $shippingData['country'] }}
                                            @endif
                                        </p>
                                    </td>
                                    @endif
                                </tr>
                            </table>

                        </td>
                    </tr>
                    
                    <tr>
                        <td align="center" style="background-color: #0f172a; padding: 40px 30px; border-top: 1px solid #334155;">
                            <p style="color: #ffffff; font-weight: 700; margin-bottom: 10px;">L'équipe Sound Tags</p>
                            <p style="color: #64748b; font-size: 12px; line-height: 1.5;">
                                Vous recevez cet email suite à votre commande sur notre boutique.<br>
                                Besoin d'aide ? Contactez notre support via le site web.
                            </p>
                        </td>
                    </tr>
                </table>
                </td>
        </tr>
    </table>
</body>
</html>