<div class="eerder-indicator" title="Student heeft dit keuzedeel eerder gedaan">
    <span class="eerder-badge">
        @if($markering === 'x')
            ✓ Gekoppeld
        @elseif($markering === 'pv')
            ⚠ Poging Vergeven
        @else
            ✓ Eerder gedaan
        @endif
    </span>
</div>

<style>
    .eerder-indicator {
        display: inline-block;
    }

    .eerder-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 10px;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        white-space: nowrap;
    }
</style>
