@extends('layouts.app')

@section('title', 'Notificaties')

@section('styles')
<style>
    .notifications-header {
        background: rgba(255, 255, 255, 0.05);
        padding: 2rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        border: 1px solid rgba(212, 160, 36, 0.2);
    }

    .notifications-header h1 {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        color: #d4a024;
    }

    .notifications-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .notification-card {
        background: rgba(255, 255, 255, 0.05);
        padding: 1.5rem;
        border-radius: 12px;
        border: 1px solid rgba(212, 160, 36, 0.2);
        transition: all 0.3s ease;
    }

    .notification-card:hover {
        border-color: #d4a024;
        background: rgba(255, 255, 255, 0.08);
    }

    .notification-card.unread {
        border-left: 4px solid #d4a024;
        background: rgba(212, 160, 36, 0.1);
    }

    .notification-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 0.75rem;
    }

    .notification-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #fff;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .notification-icon {
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 0.9rem;
    }

    .notification-icon.afwijzing {
        background: rgba(239, 68, 68, 0.2);
        color: #f87171;
    }

    .notification-icon.goedkeuring {
        background: rgba(34, 197, 94, 0.2);
        color: #4ade80;
    }

    .notification-icon.voltooiing {
        background: rgba(168, 85, 247, 0.2);
        color: #c084fc;
    }

    .notification-date {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.6);
    }

    .notification-message {
        color: rgba(255, 255, 255, 0.9);
        line-height: 1.6;
        margin-bottom: 0.75rem;
    }

    .notification-keuzedeel {
        display: inline-block;
        background: rgba(212, 160, 36, 0.2);
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        font-size: 0.85rem;
        color: #d4a024;
        font-weight: 500;
    }

    .no-notifications {
        background: rgba(255, 255, 255, 0.05);
        padding: 3rem;
        border-radius: 12px;
        text-align: center;
        color: rgba(255, 255, 255, 0.6);
        border: 1px solid rgba(212, 160, 36, 0.2);
    }

    .no-notifications-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }
</style>
@endsection

@section('content')
<div class="notifications-header">
    <h1>🔔 Notificaties</h1>
    <p style="color: rgba(255, 255, 255, 0.8);">Bekijk al je berichten en updates</p>
</div>

@if(session('success'))
    <div style="background: rgba(34, 197, 94, 0.2); color: #4ade80; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid rgba(34, 197, 94, 0.3);">
        {{ session('success') }}
    </div>
@endif

<div class="notifications-list">
    @forelse($notifications as $notification)
        <div class="notification-card {{ $notification->is_read ? '' : 'unread' }}">
            <div class="notification-header">
                <div class="notification-title">
                    <span class="notification-icon {{ $notification->type }}">
                        @if($notification->type === 'afwijzing')
                            ❌
                        @elseif($notification->type === 'goedkeuring')
                            ✅
                        @elseif($notification->type === 'voltooiing')
                            🎉
                        @else
                            📢
                        @endif
                    </span>
                    {{ $notification->title }}
                </div>
                <span class="notification-date">
                    {{ $notification->created_at->diffForHumans() }}
                </span>
            </div>

            <div class="notification-message">
                {{ $notification->message }}
            </div>

            @if($notification->keuzedeel)
                <span class="notification-keuzedeel">
                    📚 {{ $notification->keuzedeel->naam }}
                </span>
            @endif
        </div>
    @empty
        <div class="no-notifications">
            <div class="no-notifications-icon">📭</div>
            <h3 style="color: rgba(255, 255, 255, 0.8); margin-bottom: 0.5rem;">Geen notificaties</h3>
            <p>Je hebt momenteel geen berichten of updates.</p>
        </div>
    @endforelse
</div>
@endsection
