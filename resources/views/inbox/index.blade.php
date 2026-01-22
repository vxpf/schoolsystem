@extends('layouts.app')

@section('title', 'Inbox')

@section('styles')
<style>
    .inbox-page {
        max-width: 900px;
        margin: 0 auto;
    }

    .inbox-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border);
    }

    .inbox-title {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .inbox-title svg {
        width: 24px;
        height: 24px;
        color: var(--text-secondary);
    }

    .inbox-title h1 {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0;
    }

    .inbox-count {
        font-size: 0.875rem;
        color: var(--text-muted);
        font-weight: 400;
    }

    .inbox-toolbar-actions {
        display: flex;
        gap: 0.75rem;
    }

    .btn-toolbar {
        background: none;
        border: 1px solid var(--border);
        color: var(--text-secondary);
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-size: 0.8125rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.15s ease;
    }

    .btn-toolbar:hover {
        background: var(--bg-light);
        border-color: var(--text-muted);
        color: var(--text-dark);
    }

    .btn-toolbar.danger:hover {
        background: #fef2f2;
        border-color: #fca5a5;
        color: #dc2626;
    }

    .message-list {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 8px;
        overflow: hidden;
    }

    .message-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--border-light);
        transition: background 0.15s ease;
        cursor: default;
    }

    .message-item:last-child {
        border-bottom: none;
    }

    .message-item:hover {
        background: var(--bg-light);
    }

    .message-item.unread {
        background: #fffbeb;
    }

    .message-item.unread:hover {
        background: #fef3c7;
    }

    .message-indicator {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        margin-top: 6px;
        flex-shrink: 0;
    }

    .message-item.unread .message-indicator {
        background: var(--accent);
    }

    .message-item:not(.unread) .message-indicator {
        background: transparent;
    }

    .message-icon {
        width: 36px;
        height: 36px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .message-icon.success {
        background: #dcfce7;
        color: #16a34a;
    }

    .message-icon.error {
        background: #fee2e2;
        color: #dc2626;
    }

    .message-icon.warning {
        background: #fef3c7;
        color: #d97706;
    }

    .message-icon.info {
        background: #dbeafe;
        color: #2563eb;
    }

    .message-icon.default {
        background: #f3f4f6;
        color: #6b7280;
    }

    .message-icon svg {
        width: 18px;
        height: 18px;
    }

    .message-body {
        flex: 1;
        min-width: 0;
    }

    .message-header {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        gap: 1rem;
        margin-bottom: 0.25rem;
    }

    .message-subject {
        font-size: 0.9375rem;
        font-weight: 600;
        color: var(--text-dark);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .message-item.unread .message-subject {
        font-weight: 700;
    }

    .message-time {
        font-size: 0.75rem;
        color: var(--text-muted);
        white-space: nowrap;
        flex-shrink: 0;
    }

    .message-preview {
        font-size: 0.875rem;
        color: var(--text-secondary);
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .message-tag {
        display: inline-block;
        margin-top: 0.5rem;
        padding: 0.25rem 0.5rem;
        background: #f3f4f6;
        border-radius: 4px;
        font-size: 0.75rem;
        color: var(--text-secondary);
    }

    .message-actions {
        display: flex;
        align-items: center;
        opacity: 0;
        transition: opacity 0.15s ease;
    }

    .message-item:hover .message-actions {
        opacity: 1;
    }

    .btn-icon {
        background: none;
        border: none;
        padding: 0.5rem;
        border-radius: 4px;
        color: var(--text-muted);
        cursor: pointer;
        transition: all 0.15s ease;
    }

    .btn-icon:hover {
        background: #fee2e2;
        color: #dc2626;
    }

    .btn-icon svg {
        width: 16px;
        height: 16px;
    }

    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
    }

    .empty-state svg {
        width: 48px;
        height: 48px;
        color: var(--text-muted);
        margin-bottom: 1rem;
    }

    .empty-state h3 {
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        font-size: 0.875rem;
        color: var(--text-muted);
    }

    .alert {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.875rem 1rem;
        border-radius: 6px;
        margin-bottom: 1rem;
        font-size: 0.875rem;
    }

    .alert-success {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: #166534;
    }

    .alert svg {
        width: 16px;
        height: 16px;
        flex-shrink: 0;
    }

    @media (max-width: 640px) {
        .inbox-toolbar {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .message-actions {
            opacity: 1;
        }

        .message-time {
            display: none;
        }
    }
</style>
@endsection

@section('content')
<div class="inbox-page">
    @if(session('success'))
        <div class="alert alert-success">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="inbox-toolbar">
        <div class="inbox-title">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                <path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path>
            </svg>
            <h1>Inbox <span class="inbox-count">({{ $notifications->count() }})</span></h1>
        </div>
        @if($notifications->count() > 0)
        <div class="inbox-toolbar-actions">
            <form action="{{ route('inbox.destroy-all') }}" method="POST" onsubmit="return confirm('Weet je zeker dat je alle berichten wilt verwijderen?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-toolbar danger">Alles verwijderen</button>
            </form>
        </div>
        @endif
    </div>

    <div class="message-list">
        @forelse($notifications as $notification)
            <div class="message-item {{ $notification->is_read ? '' : 'unread' }}">
                <div class="message-indicator"></div>
                <div class="message-icon {{ $notification->type === 'goedkeuring' ? 'success' : ($notification->type === 'afwijzing' || $notification->type === 'verwijdering' ? 'error' : ($notification->type === 'wijziging' ? 'warning' : ($notification->type === 'voltooiing' || $notification->type === 'cijfer' ? 'info' : 'default'))) }}">
                    @if($notification->type === 'goedkeuring')
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    @elseif($notification->type === 'afwijzing' || $notification->type === 'verwijdering')
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    @elseif($notification->type === 'wijziging')
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                    @elseif($notification->type === 'voltooiing')
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                    @elseif($notification->type === 'cijfer')
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                    @endif
                </div>
                <div class="message-body">
                    <div class="message-header">
                        <span class="message-subject">{{ $notification->title }}</span>
                        <span class="message-time">{{ $notification->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="message-preview">{{ $notification->message }}</p>
                    @if($notification->keuzedeel)
                        <span class="message-tag">{{ $notification->keuzedeel->naam }}</span>
                    @endif
                </div>
                <div class="message-actions">
                    <form action="{{ route('inbox.destroy', $notification->id) }}" method="POST" onsubmit="return confirm('Bericht verwijderen?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-icon" title="Verwijderen">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                    <path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path>
                </svg>
                <h3>Geen berichten</h3>
                <p>Je inbox is leeg. Nieuwe meldingen verschijnen hier.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
