@props(['audioUrl', 'duration' => null, 'productName' => ''])

@php
    $safeDuration = (int) ($duration ?? 0);
    $safeAudioUrl = e($audioUrl ?? '');
    $safeProductName = e($productName ?? '');
@endphp

<div class="space-y-4">
    <audio
        controls
        preload="metadata"
        class="w-full h-12 rounded-full border border-gray-600 hover:border-gray-500 transition-colors duration-200"
        style="background: linear-gradient(135deg, #1f2937, #374151); outline: none;">
        <source src="{{ $safeAudioUrl }}" type="audio/mpeg">
        <source src="{{ $safeAudioUrl }}" type="audio/wav">
        <source src="{{ $safeAudioUrl }}" type="audio/ogg">
        Votre navigateur ne supporte pas l'audio HTML5.
    </audio>
</div>
<style>
    /* Styles minimalistes pour le player */

    audio::-webkit-media-controls-panel {
        background: linear-gradient(135deg, #1f2937, #374151);
        border-radius: 8px;
    }

    audio::-webkit-media-controls-play-button {
        border-radius: 50%;
        transition: transform 0.2s ease-in-out;
    }

    audio::-webkit-media-controls-play-button:hover {
        transform: scale(1.15);
    }
</style>
