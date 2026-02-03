# Sitemap - TCR Keuzedelen Systeem

## Project Informatie
- **Projectnaam:** TCR Keuzedelen Systeem
- **Versie:** 1.0
- **Datum:** Januari 2026

---

## Visuele Sitemap

```
                                    ┌─────────────────┐
                                    │   HOME (/)      │
                                    │   Landing Page  │
                                    └────────┬────────┘
                                             │
                    ┌────────────────────────┼────────────────────────┐
                    │                        │                        │
                    ▼                        ▼                        ▼
           ┌────────────────┐      ┌────────────────┐      ┌────────────────┐
           │    LOGIN       │      │   KEUZEDELEN   │      │     ADMIN      │
           │   /login       │      │  /keuzedelen   │      │    /admin      │
           └────────────────┘      └───────┬────────┘      └───────┬────────┘
                    │                      │                       │
                    ▼                      │                       │
           ┌────────────────┐              │         ┌─────────────┴─────────────┐
           │  MICROSOFT     │              │         │             │             │
           │  CALLBACK      │              │         ▼             ▼             ▼
           │ /auth/callback │              │  ┌───────────┐ ┌───────────┐ ┌───────────┐
           └────────────────┘              │  │KEUZEDELEN │ │STUDENTEN  │ │INSCHRIJV. │
                                           │  │  BEHEER   │ │  BEHEER   │ │  BEHEER   │
                                           │  └───────────┘ └───────────┘ └───────────┘
                    ┌──────────────────────┤         │             │             │
                    │                      │         ▼             ▼             ▼
                    ▼                      │  ┌───────────┐ ┌───────────┐ ┌───────────┐
           ┌────────────────┐              │  │  CREATE   │ │  DETAIL   │ │  DETAIL   │
           │  MIJN          │              │  │   EDIT    │ │           │ │           │
           │  KEUZEDELEN    │              │  └───────────┘ └───────────┘ └───────────┘
           │/keuzedelen/mijn│              │
           └────────────────┘              │
                                           ▼
                                  ┌────────────────┐
                                  │    DETAIL      │
                                  │/keuzedelen/{id}│
                                  └────────────────┘
```

---

## Gedetailleerde Paginastructuur

### 1. Publieke Pagina's (Geen login vereist)

| URL | Paginanaam | Beschrijving |
|-----|------------|--------------|
| `/` | Home | Landing pagina met login optie |
| `/login` | Login | Microsoft OAuth login pagina |
| `/auth/callback` | Auth Callback | Microsoft OAuth callback handler |

### 2. Student Pagina's (Login vereist - Rol: Student)

| URL | Paginanaam | Beschrijving |
|-----|------------|--------------|
| `/keuzedelen` | Keuzedelen Overzicht | Alle beschikbare keuzedelen bekijken |
| `/keuzedelen/{id}` | Keuzedeel Detail | Details van specifiek keuzedeel |
| `/keuzedelen/mijn` | Mijn Keuzedelen | Overzicht van aangemelde keuzedelen |
| `/notifications` | Notificaties | Alle notificaties bekijken |

### 3. Admin Pagina's (Login vereist - Rol: Admin/SLB)

| URL | Paginanaam | Beschrijving |
|-----|------------|--------------|
| `/admin` | Admin Dashboard | Overzicht statistieken |
| `/admin/keuzedelen` | Keuzedelen Beheer | CRUD voor keuzedelen |
| `/admin/keuzedelen/create` | Keuzedeel Aanmaken | Nieuw keuzedeel formulier |
| `/admin/keuzedelen/{id}/edit` | Keuzedeel Bewerken | Bewerk keuzedeel formulier |
| `/admin/students` | Studenten Beheer | Overzicht alle studenten |
| `/admin/students/{id}` | Student Detail | Details van specifieke student |
| `/admin/enrollments` | Inschrijvingen Beheer | Overzicht alle inschrijvingen |
| `/admin/enrollments/{id}` | Inschrijving Detail | Details van specifieke inschrijving |

---

## Navigatiestructuur

### Hoofdnavigatie (Header)

```
┌──────────────────────────────────────────────────────────────────────┐
│  [Logo] TCR Keuzedelen    Keuzedelen  Mijn Keuzedelen  [User Menu]   │
└──────────────────────────────────────────────────────────────────────┘
```

**Student Menu:**
- Keuzedelen
- Mijn Keuzedelen
- Notificaties
- Profiel
- Uitloggen

**Admin Menu:**
- Dashboard
- Keuzedelen
- Studenten
- Inschrijvingen
- Uitloggen

---

## URL Routing Tabel

| Method | URL | Controller | Actie | Middleware |
|--------|-----|------------|-------|------------|
| GET | `/` | HomeController | index | - |
| GET | `/login` | AuthController | login | guest |
| GET | `/auth/callback` | AuthController | callback | guest |
| POST | `/logout` | AuthController | logout | auth |
| GET | `/keuzedelen` | KeuzedeelController | index | auth |
| GET | `/keuzedelen/mijn` | KeuzedeelController | mijn | auth |
| GET | `/keuzedelen/{id}` | KeuzedeelController | show | auth |
| POST | `/keuzedelen/{id}/aanmelden` | KeuzedeelController | aanmelden | auth |
| DELETE | `/keuzedelen/{id}/afmelden` | KeuzedeelController | afmelden | auth |
| GET | `/admin` | AdminController | dashboard | auth, admin |
| GET | `/admin/keuzedelen` | AdminController | keuzedelen | auth, admin |
| GET | `/admin/keuzedelen/create` | AdminController | keuzedeelCreate | auth, admin |
| POST | `/admin/keuzedelen` | AdminController | keuzedeelStore | auth, admin |
| GET | `/admin/keuzedelen/{id}/edit` | AdminController | keuzedeelEdit | auth, admin |
| PUT | `/admin/keuzedelen/{id}` | AdminController | keuzedeelUpdate | auth, admin |
| DELETE | `/admin/keuzedelen/{id}` | AdminController | keuzedeelDestroy | auth, admin |
| GET | `/admin/students` | AdminController | students | auth, admin |
| GET | `/admin/students/{id}` | AdminController | studentDetail | auth, admin |
| GET | `/admin/enrollments` | AdminController | enrollments | auth, admin |
| GET | `/admin/enrollments/{id}` | AdminController | enrollmentDetail | auth, admin |
| PUT | `/admin/enrollments/{id}` | AdminController | enrollmentUpdate | auth, admin |

---

## Breadcrumb Navigatie

| Pagina | Breadcrumb |
|--------|------------|
| Home | Home |
| Keuzedelen | Home > Keuzedelen |
| Keuzedeel Detail | Home > Keuzedelen > [Naam] |
| Mijn Keuzedelen | Home > Mijn Keuzedelen |
| Admin Dashboard | Admin > Dashboard |
| Keuzedelen Beheer | Admin > Keuzedelen |
| Keuzedeel Aanmaken | Admin > Keuzedelen > Nieuw |
| Keuzedeel Bewerken | Admin > Keuzedelen > [Naam] > Bewerken |
| Studenten Beheer | Admin > Studenten |
| Student Detail | Admin > Studenten > [Naam] |
| Inschrijvingen | Admin > Inschrijvingen |
| Inschrijving Detail | Admin > Inschrijvingen > [ID] |
