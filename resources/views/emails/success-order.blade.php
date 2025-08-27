<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de commande - Sound Tags</title>
    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <![endif]-->
    <style>
        /* Reset et styles de base */
        body, table, td, p, a, li, blockquote {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
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
        
        /* Styles principaux - EXACTEMENT comme Sound Tags */
        body {
            margin: 0;
            padding: 0;
            background-color: #0f172a;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #ffffff;
        }
        
        .email-container {
            max-width: 650px;
            margin: 0 auto;
            background-color: #0f172a;
        }
        
        /* Header - EXACTEMENT comme votre hero section */
        .header {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
            padding: 50px 30px;
            text-align: center;
            border-radius: 0;
            position: relative;
            overflow: hidden;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(255,255,255,0.05) 0%, transparent 50%, rgba(255,255,255,0.05) 100%);
            pointer-events: none;
        }
        
        .logo {
            width: 80px;
            height: 80px;
            background-color: #ffffff;
            border-radius: 50%;
            display: inline-block;
            margin-bottom: 25px;
            position: relative;
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        }
        
        .logo-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 40px;
            height: 40px;
            background-color: #000000;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .logo-icon::before {
            content: "♪";
            color: #ffffff;
            font-size: 24px;
            font-weight: bold;
        }
        
        .brand-name {
            font-size: 42px;
            font-weight: 800;
            color: #ffffff;
            margin: 0;
            letter-spacing: 2px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
        
        /* Badge de succès - BLANC comme vos boutons CTA */
        .success-badge {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            color: #000000;
            padding: 16px 32px;
            border-radius: 30px;
            display: inline-block;
            margin-top: 25px;
            font-weight: 700;
            font-size: 18px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.2);
            border: 2px solid rgba(255,255,255,0.1);
        }
        
        /* Content - EXACTEMENT comme vos sections */
        .content {
            background-color: #1e293b;
            padding: 50px 30px;
        }
        
        /* Order Info - EXACTEMENT comme vos cartes produits */
        .order-info {
            background: linear-gradient(135deg, #334155 0%, #475569 100%);
            padding: 40px;
            border-radius: 20px;
            margin-bottom: 40px;
            text-align: center;
            border: 1px solid #64748b;
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
            position: relative;
            overflow: hidden;
        }
        
        .order-info::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ffffff, #cbd5e1, #ffffff);
        }
        
        .order-number {
            font-size: 32px;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 15px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
        
        .order-date {
            color: #e2e8f0;
            font-size: 18px;
            margin: 0;
            font-weight: 500;
        }
        
        .section {
            margin-bottom: 40px;
        }
        
        .section-title {
            color: #ffffff;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 3px solid #475569;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #ffffff, #cbd5e1);
            border-radius: 2px;
        }
        
        .greeting {
            font-size: 20px;
            color: #f8fafc;
            margin-bottom: 25px;
            font-weight: 600;
        }
        
        .greeting-text {
            color: #cbd5e1;
            font-size: 16px;
            line-height: 1.7;
            margin: 0;
        }
        
        /* Cart Items - EXACTEMENT comme vos cartes produits */
        .cart-item {
            background: linear-gradient(135deg, #334155 0%, #475569 100%);
            padding: 25px;
            border-radius: 16px;
            margin-bottom: 20px;
            border: 1px solid #64748b;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
        }
        
        .cart-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.25);
        }
        
        .cart-item-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
        }
        
        .item-info {
            flex: 1;
        }
        
        .item-name {
            font-weight: 700;
            color: #ffffff;
            font-size: 18px;
            margin-bottom: 10px;
            line-height: 1.3;
        }
        
        .item-description {
            color: #cbd5e1;
            font-size: 14px;
            margin-bottom: 10px;
            line-height: 1.5;
            font-style: italic;
        }
        
        .item-quantity {
            color: #94a3b8;
            font-size: 14px;
            font-weight: 600;
            background-color: rgba(255,255,255,0.1);
            padding: 6px 12px;
            border-radius: 20px;
            display: inline-block;
        }
        
        /* Prix en BLANC comme vos accents */
        .item-price {
            font-weight: 800;
            color: #ffffff;
            font-size: 22px;
            text-align: right;
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            padding: 12px 20px;
            border-radius: 12px;
            border: 2px solid #64748b;
            min-width: 80px;
            text-align: center;
            box-shadow: 0 4px 16px rgba(0,0,0,0.2);
        }
        
        /* Summary Section - EXACTEMENT comme vos cartes */
        .cart-summary {
            background: linear-gradient(135deg, #334155 0%, #475569 100%);
            padding: 35px;
            border-radius: 20px;
            margin-bottom: 35px;
            border: 1px solid #64748b;
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
        }
        
        .cart-summary-title {
            color: #ffffff;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 25px;
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 2px solid #64748b;
        }
        
        .cart-summary-row {
            width: 100%;
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding: 12px 0;
            border-bottom: 1px solid rgba(100, 116, 139, 0.3);
        }
        
        .cart-summary-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .cart-summary-label {
            color: #cbd5e1;
            font-weight: 500;
        }
        
        .cart-summary-value {
            color: #ffffff;
            font-weight: 700;
            font-size: 16px;
        }
        
        /* Total Section - EXACTEMENT comme votre header */
        .total-section {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
            color: #ffffff;
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            border: 2px solid #475569;
            margin-bottom: 40px;
            box-shadow: 0 12px 40px rgba(0,0,0,0.3);
            position: relative;
            overflow: hidden;
        }
        
        .total-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ffffff, #cbd5e1, #ffffff);
        }
        
        .total-label {
            font-size: 20px;
            color: #cbd5e1;
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        /* Montant total en BLANC comme vos accents */
        .total-amount {
            font-size: 42px;
            font-weight: 900;
            color: #ffffff;
            margin: 20px 0;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
        
        .payment-info {
            color: #94a3b8;
            font-size: 16px;
            font-weight: 500;
            background-color: rgba(255,255,255,0.1);
            padding: 10px 20px;
            border-radius: 25px;
            display: inline-block;
        }
        
        /* Address Box - EXACTEMENT comme vos cartes */
        .address-box {
            background: linear-gradient(135deg, #334155 0%, #475569 100%);
            padding: 25px;
            border-radius: 16px;
            margin-bottom: 25px;
            border: 1px solid #64748b;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }
        
        .address-title {
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 15px;
        }
        
        .address-content {
            color: #cbd5e1;
            line-height: 1.8;
            font-size: 15px;
        }
        
        /* Next Steps - EXACTEMENT comme vos cartes */
        .next-steps {
            background: linear-gradient(135deg, #334155 0%, #475569 100%);
            padding: 35px;
            border-radius: 20px;
            border: 1px solid #64748b;
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
        }
        
        .next-steps ul {
            margin: 0;
            padding-left: 25px;
        }
        
        .next-steps li {
            color: #cbd5e1;
            margin-bottom: 12px;
            line-height: 1.7;
            font-size: 16px;
            position: relative;
        }
        
        .next-steps li::marker {
            color: #ffffff;
            font-weight: bold;
        }
        
        /* Footer - EXACTEMENT comme votre footer */
        .footer {
            background: linear-gradient(135deg, #000000 0%, #0f172a 100%);
            padding: 50px 30px;
            text-align: center;
            border-top: 1px solid #334155;
            position: relative;
        }
        
        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, #475569, transparent);
        }
        
        .footer-text {
            color: #cbd5e1;
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: 600;
        }
        
        .footer-signature {
            color: #ffffff;
            font-weight: 800;
            margin-bottom: 25px;
            font-size: 20px;
        }
        
        .footer-note {
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
            max-width: 500px;
            margin: 0 auto;
        }
        
        /* Responsive */
        @media only screen and (max-width: 600px) {
            .content {
                padding: 30px 20px;
            }
            
            .header {
                padding: 40px 20px;
            }
            
            .order-info {
                padding: 30px 20px;
            }
            
            .cart-item {
                padding: 20px;
            }
            
            .cart-item-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 15px;
            }
            
            .item-price {
                text-align: center;
                align-self: center;
            }
            
            .brand-name {
                font-size: 36px;
            }
            
            .total-amount {
                font-size: 36px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header - EXACTEMENT comme votre hero section -->
        <div class="header">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Sound Tags Logo" class="logo-image">
            </div>
            <h1 class="brand-name">Sound Tags</h1>
            <div class="success-badge">✓ Commande confirmée</div>
        </div>
        
        <!-- Content - EXACTEMENT comme vos sections -->
        <div class="content">
            <!-- Order Info - EXACTEMENT comme vos cartes produits -->
            <div class="order-info">
                <div class="order-number">Commande #{{ $order->order_number }}</div>
                <p class="order-date">Passée le {{ $order->created_at->format('d/m/Y à H:i') }}</p>
            </div>
            
            <!-- Greeting -->
            <div class="section">
                <p class="greeting">Bonjour {{ $customerData['first_name'] ?? $customerData['name'] ?? 'Cher client' }},</p>
                <p class="greeting-text">Nous avons bien reçu votre commande et le paiement a été traité avec succès. Voici le récapitulatif de votre achat :</p>
            </div>
            
            <!-- Cart Items - EXACTEMENT comme vos cartes produits -->
            @if($cartItems && (is_array($cartItems) || is_string($cartItems)))
                <div class="section">
                    <h3 class="section-title">🎵 Vos articles commandés</h3>
                    <p style="color: #cbd5e1; margin-bottom: 30px; text-align: center; font-size: 16px;">Voici ce que vous avez choisi pour surprendre vos amis :</p>
                    
                    @php
                        // Gérer les données JSON si elles sont stockées comme chaînes
                        $items = is_string($cartItems) ? json_decode($cartItems, true) : $cartItems;
                        $items = is_array($items) ? $items : [];
                    @endphp
                    
                    @if(count($items) > 0)
                        @foreach($items as $item)
                            <div class="cart-item">
                                <div class="cart-item-header">
                                    <div class="item-info">
                                        <div class="item-name">{{ $item['name'] ?? 'Produit' }}</div>
                                        @if(isset($item['short_description']))
                                            <div class="item-description">{{ $item['short_description'] }}</div>
                                        @elseif(isset($item['description']))
                                            <div class="item-description">{{ $item['description'] }}</div>
                                        @endif
                                        @if(isset($item['quantity']))
                                            <div class="item-quantity">Quantité : {{ $item['quantity'] }}</div>
                                        @endif
                                    </div>
                                    <div class="item-price">
                                        @if(isset($item['price']))
                                            {{ number_format($item['price'], 2) }} €
                                        @elseif(isset($item['formatted_price']))
                                            {{ $item['formatted_price'] }}
                                        @else
                                            Prix non disponible
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="cart-item">
                            <div style="text-align: center; color: #cbd5e1;">
                                Détails des produits non disponibles
                            </div>
                        </div>
                    @endif
                </div>
            @endif
            
            <!-- Summary - EXACTEMENT comme vos cartes -->
            @if($summary && (is_array($summary) || is_string($summary)))
                @php
                    // Gérer les données JSON si elles sont stockées comme chaînes
                    $summaryData = is_string($summary) ? json_decode($summary, true) : $summary;
                    $summaryData = is_array($summaryData) ? $summaryData : [];
                @endphp
                
                @if(count($summaryData) > 0)
                    <div class="cart-summary">
                        <h3 class="cart-summary-title">📋 Récapitulatif de la commande</h3>
                        @if(isset($summaryData['subtotal']))
                            <div class="cart-summary-row">
                                <span class="cart-summary-label">Sous-total :</span>
                                <span class="cart-summary-value">{{ number_format($summaryData['subtotal'], 2) }} €</span>
                            </div>
                        @endif
                        @if(isset($summaryData['shipping_cost']))
                            <div class="cart-summary-row">
                                <span class="cart-summary-label">Frais de livraison :</span>
                                <span class="cart-summary-value">{{ number_format($summaryData['shipping_cost'], 2) }} €</span>
                            </div>
                        @endif
                        @if(isset($summaryData['tax_amount']))
                            <div class="cart-summary-row">
                                <span class="cart-summary-label">TVA :</span>
                                <span class="cart-summary-value">{{ number_format($summaryData['tax_amount'], 2) }} €</span>
                            </div>
                        @endif
                        @if(isset($summaryData['items_count']))
                            <div class="cart-summary-row">
                                <span class="cart-summary-label">Nombre d'articles :</span>
                                <span class="cart-summary-value">{{ $summaryData['items_count'] }}</span>
                            </div>
                        @endif
                    </div>
                @endif
            @endif
            
            <!-- Total - EXACTEMENT comme votre header -->
            <div class="total-section">
                <div class="total-label">Total payé</div>
                <div class="total-amount">{{ $order->formatted_amount }}</div>
                <div class="payment-info">
                    Paiement {{ $order->status_label }} via Stripe
                </div>
            </div>
            
            <!-- Shipping Address - EXACTEMENT comme vos cartes -->
            @if($shippingAddress && is_array($shippingAddress))
                <div class="section">
                    <h3 class="section-title">🏠 Adresse de livraison</h3>
                    <div class="address-box">
                        <div class="address-content">
                            @if(isset($shippingAddress['name']))
                                <strong>{{ $shippingAddress['name'] }}</strong><br>
                            @endif
                            @if(isset($shippingAddress['line1']))
                                {{ $shippingAddress['line1'] }}<br>
                            @endif
                            @if(isset($shippingAddress['line2']) && $shippingAddress['line2'])
                                {{ $shippingAddress['line2'] }}<br>
                            @endif
                            @if(isset($shippingAddress['postal_code']) && isset($shippingAddress['city']))
                                {{ $shippingAddress['postal_code'] }} {{ $shippingAddress['city'] }}<br>
                            @endif
                            @if(isset($shippingAddress['country']))
                                {{ $shippingAddress['country'] }}
                            @endif
                        </div>
                    </div>
                </div>
            @endif
            
            <!-- Billing Address - EXACTEMENT comme vos cartes -->
            @if($billingAddress && is_array($billingAddress) && $billingAddress !== $shippingAddress)
                <div class="section">
                    <h3 class="section-title">📄 Adresse de facturation</h3>
                    <div class="address-box">
                        <div class="address-content">
                            @if(isset($billingAddress['name']))
                                <strong>{{ $billingAddress['name'] }}</strong><br>
                            @endif
                            @if(isset($billingAddress['line1']))
                                {{ $billingAddress['line1'] }}<br>
                            @endif
                            @if(isset($billingAddress['line2']) && $billingAddress['line2'])
                                {{ $billingAddress['line2'] }}<br>
                            @endif
                            @if(isset($billingAddress['postal_code']) && isset($billingAddress['city']))
                                {{ $billingAddress['postal_code'] }} {{ $billingAddress['city'] }}<br>
                            @endif
                            @if(isset($billingAddress['country']))
                                {{ $billingAddress['country'] }}
                            @endif
                        </div>
                    </div>
                </div>
            @endif
            
            <!-- Next Steps - EXACTEMENT comme vos cartes -->
            <div class="section">
                <div class="next-steps">
                    <h3 class="section-title">🚀 Que se passe-t-il maintenant ?</h3>
                    <ul>
                        <li>Votre commande est en cours de préparation</li>
                        <li>Vous recevrez un email de suivi avec les informations de livraison</li>
                        <li>Vos produits digitaux seront disponibles dans votre espace client</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Footer - EXACTEMENT comme votre footer -->
        <div class="footer">
            <p class="footer-text"><strong>Merci de votre confiance !</strong></p>
            <p class="footer-signature">L'équipe Sound Tags</p>
            <div class="footer-note">
                Cet email a été envoyé automatiquement, merci de ne pas y répondre.<br>
                Pour toute question, contactez-nous via notre site web.
            </div>
        </div>
    </div>
</body>
</html>
