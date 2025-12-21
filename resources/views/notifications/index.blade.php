@extends('layouts.app')

@section('title', 'Notificaties')

@section('styles')
<style>
    .notifications-header {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
        padding: 2rem;
        border-radius: var(--radius-xl);
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
    }

    .notifications-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--accent) 0%, var(--accent-light) 100%);
    }

    .notifications-header h1 {
        font-size: 1.75rem;
        margin-bottom: 0.5rem;
        color: #ffffff;
        font-weight: 800;
    }

    .notifications-header p {
        color: var(--text-muted);
        font-size: 0.95rem;
    }

    .notifications-actions {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .btn-delete-all {
        background: var(--danger-bg);
        color: var(--danger);
        border: 1px solid rgba(239, 68, 68, 0.3);
        padding: 0.75rem 1.5rem;
        border-radius: var(--radius);
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-delete-all:hover {
        background: var(--danger);
        color: #ffffff;
    }

    .notification-actions {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    .btn-delete {
        background: var(--danger-bg);
        color: var(--danger);
        border: 1px solid rgba(239, 68, 68, 0.3);
        padding: 0.4rem 0.8rem;
        border-radius: var(--radius);
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-delete:hover {
        background: var(--danger);
        color: #ffffff;
    }

    .notification-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 0.75rem;
        gap: 1rem;
    }

    .notification-title-wrapper {
        flex: 1;
    }

    .notifications-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .notification-card {
        background: var(--bg-card);
        padding: 1.5rem;
        border-radius: var(--radius-lg);
        border: 1px solid var(--border);
        transition: all 0.2s ease;
        box-shadow: var(--shadow);
    }

    .notification-card:hover {
        border-color: var(--accent);
        box-shadow: var(--shadow-md);
    }

    .notification-card.unread {
        border-left: 4px solid var(--accent);
        background: linear-gradient(135deg, rgba(212, 160, 36, 0.05) 0%, var(--bg-card) 100%);
    }

    .notification-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .notification-icon {
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 0.85rem;
    }

    .notification-icon.afwijzing {
        background: var(--danger-bg);
        color: var(--danger);
    }

    .notification-icon.goedkeuring {
        background: var(--success-bg);
        color: var(--success);
    }

    .notification-icon.voltooiing {
        background: var(--info-bg);
        color: var(--info);
    }

    .notification-date {
        font-size: 0.8rem;
        color: var(--text-muted);
        margin-top: 0.25rem;
    }

    .notification-message {
        color: var(--text-secondary);
        line-height: 1.7;
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
    }

    .notification-keuzedeel {
        display: inline-block;
        background: linear-gradient(135deg, rgba(212, 160, 36, 0.1) 0%, rgba(212, 160, 36, 0.2) 100%);
        padding: 0.4rem 0.9rem;
        border-radius: 20px;
        font-size: 0.8rem;
        color: var(--accent);
        font-weight: 600;
    }

    .no-notifications {
        background: var(--bg-card);
        padding: 4rem 2rem;
        border-radius: var(--radius-xl);
        text-align: center;
        color: var(--text-muted);
        border: 2px dashed var(--border);
    }

    .no-notifications-icon {
        font-size: 3.5rem;
        margin-bottom: 1rem;
        opacity: 0.6;
    }

    .no-notifications h3 {
        color: var(--text-dark);
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .alert {
        padding: 1rem 1.5rem;
        border-radius: var(--radius-lg);
        margin-bottom: 1.5rem;
        font-weight: 500;
    }

    .alert-success {
        background: var(--success-bg);
        border: 1px solid rgba(16, 185, 129, 0.3);
        color: #047857;
    }
</style>
@endsection

@section('content')
<div class="notifications-header">
    <h1>Notificaties</h1>
    <p>Bekijk al je berichten en updates</p>
</div>

@if(session('success'))
    <div style="background: rgba(34, 197, 94, 0.2); color: #4ade80; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid rgba(34, 197, 94, 0.3);">
        {{ session('success') }}
    </div>
@endif

@if($notifications->count() > 0)
<div class="notifications-actions">
    <form action="{{ route('notifications.destroy-all') }}" method="POST" onsubmit="return confirm('Weet je zeker dat je alle notificaties wilt verwijderen?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-delete-all">🗑️ Alle notificaties verwijderen</button>
    </form>
</div>
@endif

<div class="notifications-list">
    @forelse($notifications as $notification)
        <div class="notification-card {{ $notification->is_read ? '' : 'unread' }}">
            <div class="notification-header">
                <div class="notification-title-wrapper">
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
                <div class="notification-actions">
                    <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Weet je zeker dat je deze notificatie wilt verwijderen?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">🗑️ Verwijderen</button>
                    </form>
                </div>
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
