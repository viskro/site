<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Manufacturing Order - Sound Tags</title>
</head>
<body style="margin: 0; padding: 20px; font-family: Arial, sans-serif; background-color: #f5f5f5;">
    <div style="max-width: 800px; margin: 0 auto; background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        
        <!-- Header -->
        <div style="text-align: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 20px;">
            <h1 style="color: #333; margin: 0; font-size: 28px;">New Manufacturing Order</h1>
            <p style="color: #666; margin: 10px 0 0 0; font-size: 16px;">Order #{{ $order->order_number }}</p>
            <p style="color: #666; margin: 5px 0 0 0; font-size: 14px;">Date: {{ $order->created_at->format('d/m/Y H:i') }}</p>
        </div>

        <!-- Customer Info -->
        <div style="margin-bottom: 30px;">
            <h2 style="color: #333; font-size: 18px; margin-bottom: 15px;">Customer Information</h2>
            
            @php
                $customerDataArray = is_string($customerData) ? json_decode($customerData, true) : $customerData;
            @endphp
            
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="padding: 8px; border: 1px solid #ddd; background-color: #f9f9f9; font-weight: bold; width: 150px;">Name:</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">
                        {{ $customerDataArray['first_name'] ?? '' }} {{ $customerDataArray['last_name'] ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td style="padding: 8px; border: 1px solid #ddd; background-color: #f9f9f9; font-weight: bold;">Email:</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">{{ $customerDataArray['email'] ?? '' }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px; border: 1px solid #ddd; background-color: #f9f9f9; font-weight: bold;">Phone:</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">{{ $customerDataArray['phone'] ?? '' }}</td>
                </tr>
            </table>
        </div>

        <!-- Shipping Address -->
        @php
            $shippingData = is_string($shippingAddress) ? json_decode($shippingAddress, true) : $shippingAddress;
            $items = is_string($cartItems) ? json_decode($cartItems, true) : $cartItems;
            $items = is_array($items) ? $items : [];
        @endphp
        
        <div style="margin-bottom: 30px;">
            <h2 style="color: #333; font-size: 18px; margin-bottom: 15px;">Shipping Address</h2>
            
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="padding: 8px; border: 1px solid #ddd; background-color: #f9f9f9; font-weight: bold; width: 150px;">Address:</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">{{ $shippingData['address'] ?? '' }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px; border: 1px solid #ddd; background-color: #f9f9f9; font-weight: bold;">City:</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">{{ $shippingData['city'] ?? '' }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px; border: 1px solid #ddd; background-color: #f9f9f9; font-weight: bold;">Postal Code:</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">{{ $shippingData['postal_code'] ?? '' }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px; border: 1px solid #ddd; background-color: #f9f9f9; font-weight: bold;">Country:</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">{{ $shippingData['country'] ?? 'Not specified' }}</td>
                </tr>
            </table>
        </div>

        <!-- Sound Tags Manufacturing Details -->
        <div style="margin-bottom: 30px;">
            <h2 style="color: #333; font-size: 18px; margin-bottom: 15px;">Sound Tags Manufacturing Details</h2>
            
            @php
                // Table de correspondance pour les URLs d'encoding personnalisées
                $encodingUrls = [
                    'ALARME' => 'https://680731ae0bbd4a1400360230--willowy-torte-7513c4.netlify.app/',
                    'SOUND TAG ALARME' => 'https://680731ae0bbd4a1400360230--willowy-torte-7513c4.netlify.app/',
                    'BRAINROT-1' => 'https://680a365c983aa22ac36cf48b--zingy-flan-353f48.netlify.app/',
                    'SOUND TAG BRAINROT 1' => 'https://680a365c983aa22ac36cf48b--zingy-flan-353f48.netlify.app/',
                    'BRAINROT-2' => 'https://680a4643027663485bd9b2a1--stupendous-paprenjak-9268fe.netlify.app/',
                    'SOUND TAG BRAINROT 2' => 'https://680a4643027663485bd9b2a1--stupendous-paprenjak-9268fe.netlify.app/',
                    'CHINA' => 'https://6808a0639705b6de38c71e3f--jovial-brigadeiros-3ab2df.netlify.app/',
                    'SOUND TAG CHINA' => 'https://6808a0639705b6de38c71e3f--jovial-brigadeiros-3ab2df.netlify.app/',
                    'ERIKA' => 'https://680755a2d4464f5a0d0aff57--silver-dragon-1b472c.netlify.app/',
                    'SOUND TAG ERIKA' => 'https://680755a2d4464f5a0d0aff57--silver-dragon-1b472c.netlify.app/',
                    'EXPLOSION' => 'https://6808a2a247edfc38013657d2--sensational-pie-3446d2.netlify.app/',
                    'SOUND TAG EXPLOSION' => 'https://6808a2a247edfc38013657d2--sensational-pie-3446d2.netlify.app/',
                    'GOOFY' => 'https://680758d9f5d7e07077cdc5e3--gleeful-melba-c94e67.netlify.app/',
                    'SOUND TAG GOOFY' => 'https://680758d9f5d7e07077cdc5e3--gleeful-melba-c94e67.netlify.app/',
                    'JUST SLEEP' => 'https://680a4a0d286f2453877fb0f8--joyful-churros-74e832.netlify.app/',
                    'SOUND TAG JUST SLEEP' => 'https://680a4a0d286f2453877fb0f8--joyful-churros-74e832.netlify.app/',
                    'ORGASME-1' => 'https://680730813788da0ca22867e3--stupendous-strudel-d9c838.netlify.app/',
                    'SOUND TAG ORGASME 1' => 'https://680730813788da0ca22867e3--stupendous-strudel-d9c838.netlify.app/',
                    'ORGASME-2' => 'https://680881472c63b0990fdddb63--statuesque-figolla-c32288.netlify.app/',
                    'SOUND TAG ORGASME 2' => 'https://680881472c63b0990fdddb63--statuesque-figolla-c32288.netlify.app/'
                ];

                $items = $order->cart_data;
                $totalQuantity = 0;
                
                if (is_string($items)) {
                    $items = json_decode($items, true) ?? [];
                }
                
                foreach ($items as $item) {
                    if (isset($item['quantity'])) {
                        $totalQuantity += $item['quantity'];
                    }
                }
            @endphp
            
            @if(count($items) > 0)
                @foreach($items as $index => $item)
                    @if(isset($item['product_type']) && $item['product_type'] === 'pack')
                        <!-- Pack Item -->
                        <div style="margin-bottom: 25px; padding: 20px; border: 2px solid #28a745; border-radius: 8px; background-color: #f8fff8;">
                            <h3 style="color: #28a745; margin-top: 0; margin-bottom: 15px; font-size: 16px;">
                                Pack - {{ $item['pack_size'] ?? count($item['selected_tags_details'] ?? []) }} tags
                            </h3>
                            
                            @if(isset($item['selected_tags_details']) && is_array($item['selected_tags_details']))
                                @foreach($item['selected_tags_details'] as $tagIndex => $tag)
                                    <div style="margin-bottom: 15px; padding: 15px; border: 1px solid #ddd; border-radius: 5px; background-color: #fafafa;">
                                        <h4 style="color: #333; margin-top: 0; margin-bottom: 10px; font-size: 14px;">
                                            Sound Tag {{ $index + 1 }}-{{ $tagIndex + 1 }}
                                        </h4>
                                        
                                        <table style="width: 100%; border-collapse: collapse;">
                                            <tr>
                                                <td style="padding: 6px; border: 1px solid #ddd; background-color: #f9f9f9; font-weight: bold; width: 180px; font-size: 12px;">Chip:</td>
                                                <td style="padding: 6px; border: 1px solid #ddd; font-size: 12px;">144 bytes</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 6px; border: 1px solid #ddd; background-color: #f9f9f9; font-weight: bold; font-size: 12px;">Surface material:</td>
                                                <td style="padding: 6px; border: 1px solid #ddd; font-size: 12px;">PVC</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 6px; border: 1px solid #ddd; background-color: #f9f9f9; font-weight: bold; font-size: 12px;">Size:</td>
                                                <td style="padding: 6px; border: 1px solid #ddd; font-size: 12px;">25 mm</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 6px; border: 1px solid #ddd; background-color: #f9f9f9; font-weight: bold; font-size: 12px;">Encoding:</td>
                                                <td style="padding: 6px; border: 1px solid #ddd; font-size: 12px;">
                                                    @php
                                                        $tagName = strtoupper($tag['name'] ?? '');
                                                        $customUrl = $encodingUrls[$tagName] ?? url('/product/' . ($tag['id'] ?? ''));
                                                    @endphp
                                                    <!-- Debug: Tag name matching -->
                                                    {{ $customUrl }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 6px; border: 1px solid #ddd; background-color: #f9f9f9; font-weight: bold; font-size: 12px;">Printing logo:</td>
                                                <td style="padding: 6px; border: 1px solid #ddd; font-size: 12px;">
                                                    @if(isset($tag['image']))
                                                        {{-- <!-- Debug: Image info -->
                                                        <div style="background-color: #fff3cd; border: 1px solid #ffeaa7; padding: 5px; margin-bottom: 5px; border-radius: 3px; font-size: 10px; color: #856404;">
                                                            DEBUG: Image file = {{ $tag['image'] }}<br>
                                                            DEBUG: Old URL = {{ asset('storage/images/products/' . $tag['image']) }}<br>
                                                            DEBUG: New URL = https://soundtags.fr/storage/images/products/{{ $tag['image'] }}
                                                        </div> --}}
                                                        <img src="https://www.soundtags.fr/public/images/products/{{ $tag['image'] }}" alt="{{ $tag['name'] }} Tag Logo" style="max-width: 80px; max-height: 80px; border: 1px solid #ddd;" />
                                                    @else
                                                        <div style="background-color: #f8d7da; border: 1px solid #f5c6cb; padding: 5px; border-radius: 3px; font-size: 10px; color: #721c24;">
                                                            DEBUG: No image found in tag data
                                                        </div>
                                                        Image not available
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 6px; border: 1px solid #ddd; background-color: #f9f9f9; font-weight: bold; font-size: 12px;">Number printing:</td>
                                                <td style="padding: 6px; border: 1px solid #ddd; font-size: 12px;">Tracking: {{ $order->order_number }}-{{ $index + 1 }}-{{ $tagIndex + 1 }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 6px; border: 1px solid #ddd; background-color: #f9f9f9; font-weight: bold; font-size: 12px;">Quantity:</td>
                                                <td style="padding: 6px; border: 1px solid #ddd; font-size: 12px;">{{ $tag['count'] ?? 1 }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @else
                        <!-- Single Item -->
                        <div style="margin-bottom: 25px; padding: 20px; border: 2px solid #007bff; border-radius: 8px; background-color: #f8f9ff;">
                            <h3 style="color: #007bff; margin-top: 0; margin-bottom: 15px; font-size: 16px;">
                                Single Sound Tag
                            </h3>
                            
                            <table style="width: 100%; border-collapse: collapse;">
                                <tr>
                                    <td style="padding: 8px; border: 1px solid #ddd; background-color: #f9f9f9; font-weight: bold; width: 200px;">Chip:</td>
                                    <td style="padding: 8px; border: 1px solid #ddd;">144 bytes</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px; border: 1px solid #ddd; background-color: #f9f9f9; font-weight: bold;">Surface material:</td>
                                    <td style="padding: 8px; border: 1px solid #ddd;">PVC</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px; border: 1px solid #ddd; background-color: #f9f9f9; font-weight: bold;">Size:</td>
                                    <td style="padding: 8px; border: 1px solid #ddd;">25 mm</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px; border: 1px solid #ddd; background-color: #f9f9f9; font-weight: bold;">Encoding:</td>
                                    <td style="padding: 8px; border: 1px solid #ddd;">
                                        @php
                                            $tagName = strtoupper($item['name'] ?? '');
                                            $customUrl = $encodingUrls[$tagName] ?? (isset($item['id']) ? url('/product/' . $item['id']) : 'Link not available');
                                        @endphp
                                        {{-- <!-- Debug: Item name matching -->
                                        <div style="background-color: #e3f2fd; border: 1px solid #90caf9; padding: 3px; margin-bottom: 3px; border-radius: 3px; font-size: 9px; color: #1565c0;">
                                            DEBUG: Item name = "{{ $item['name'] ?? '' }}" | Upper = "{{ $tagName }}" | Found = {{ isset($encodingUrls[$tagName]) ? 'YES' : 'NO' }}
                                        </div> --}}
                                        {{ $customUrl }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px; border: 1px solid #ddd; background-color: #f9f9f9; font-weight: bold;">Printing logo:</td>
                                    <td style="padding: 8px; border: 1px solid #ddd;">
                                        @if(isset($item['image']))
                                            {{-- <!-- Debug: Image info -->
                                            <div style="background-color: #fff3cd; border: 1px solid #ffeaa7; padding: 5px; margin-bottom: 5px; border-radius: 3px; font-size: 10px; color: #856404;">
                                                DEBUG: Image file = {{ $item['image'] }}<br>
                                                DEBUG: Old URL = {{ asset('storage/images/products/' . $item['image']) }}<br>
                                                DEBUG: New URL = https://soundtags.fr/storage/images/products/{{ $item['image'] }}
                                            </div> --}}
                                            <img src="https://soundtags.fr/public/images/products/{{ $item['image'] }}" alt="Tag Logo" style="max-width: 100px; max-height: 100px; border: 1px solid #ddd;" />
                                        @else
                                            <div style="background-color: #f8d7da; border: 1px solid #f5c6cb; padding: 5px; border-radius: 3px; font-size: 10px; color: #721c24;">
                                                DEBUG: No image found in item data
                                            </div>
                                            Image not available
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px; border: 1px solid #ddd; background-color: #f9f9f9; font-weight: bold;">Number printing:</td>
                                    <td style="padding: 8px; border: 1px solid #ddd;">Tracking: {{ $order->order_number }}-{{ $index + 1 }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px; border: 1px solid #ddd; background-color: #f9f9f9; font-weight: bold;">Quantity:</td>
                                    <td style="padding: 8px; border: 1px solid #ddd;">{{ $item['quantity'] ?? 1 }}</td>
                                </tr>
                            </table>
                        </div>
                    @endif
                @endforeach
            @else
                <div style="margin-bottom: 30px; padding: 20px; border: 2px solid #dc3545; border-radius: 8px; background-color: #fff8f8;">
                    <h3 style="color: #dc3545; margin-top: 0; margin-bottom: 15px; font-size: 16px;">No Items Found</h3>
                    <p style="color: #666; margin: 0;">No sound tags found in this order.</p>
                </div>
            @endif
        </div>

        <!-- Footer -->
        <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd; color: #666; font-size: 14px;">
            <p>This email was automatically generated by Sound Tags</p>
            <p>For any questions, please contact the Sound Tags team</p>
        </div>
    </div>
</body>
</html>
