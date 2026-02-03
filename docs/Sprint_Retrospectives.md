# Sprint Retrospectives - TCR Keuzedelen Systeem

## Project Informatie
- **Projectnaam:** TCR Keuzedelen Systeem
- **Opdrachtgever:** Techniek College Rotterdam
- **Ontwikkelaar:** [Naam Student]
- **Periode:** Januari 2026

---

## Sprint 1 Retrospective

### Sprint Informatie
| Item | Waarde |
|------|--------|
| Sprint Nummer | 1 |
| Startdatum | 06-01-2026 |
| Einddatum | 13-01-2026 |
| Sprint Doel | Basisstructuur en authenticatie opzetten |

### Wat ging goed? ✅
1. **Laravel project setup** - Het opzetten van het Laravel 11 framework verliep soepel
2. **Database ontwerp** - De database structuur voor users en keuzedelen is goed ontworpen
3. **Microsoft OAuth integratie** - Single Sign-On met Microsoft accounts werkt correct
4. **Basis navigatie** - Header en navigatie zijn responsive en gebruiksvriendelijk

### Wat kan beter? ⚠️
1. **Tijdsinschatting** - De OAuth implementatie duurde langer dan gepland (4 uur i.p.v. 2 uur)
2. **Documentatie** - Technische documentatie liep achter tijdens development
3. **Testing** - Meer tijd nodig voor unit tests

### Actiepunten voor volgende sprint 📋
| Actie | Verantwoordelijke | Deadline |
|-------|-------------------|----------|
| Buffer tijd inplannen voor complexe features | Developer | Sprint 2 |
| Documentatie bijwerken na elke feature | Developer | Doorlopend |
| Test coverage verhogen naar 60% | Developer | Sprint 2 |

### Sprint Velocity
- **Geplande Story Points:** 21
- **Behaalde Story Points:** 18
- **Velocity:** 86%

---

## Sprint 2 Retrospective

### Sprint Informatie
| Item | Waarde |
|------|--------|
| Sprint Nummer | 2 |
| Startdatum | 13-01-2026 |
| Einddatum | 20-01-2026 |
| Sprint Doel | Keuzedelen CRUD en aanmeldsysteem |

### Wat ging goed? ✅
1. **Keuzedelen overzicht** - De index pagina met filtering werkt uitstekend
2. **Aanmeldsysteem** - Studenten kunnen zich succesvol aanmelden voor keuzedelen
3. **Admin panel** - Beheerders kunnen keuzedelen toevoegen, bewerken en verwijderen
4. **Capaciteitsbeheer** - Maximum aantal studenten wordt correct afgedwongen

### Wat kan beter? ⚠️
1. **UI/UX feedback** - Gebruikers wilden meer visuele feedback bij acties
2. **Validatie** - Sommige edge cases werden niet afgevangen
3. **Performance** - Query's kunnen geoptimaliseerd worden

### Actiepunten voor volgende sprint 📋
| Actie | Verantwoordelijke | Deadline |
|-------|-------------------|----------|
| Toast notificaties toevoegen | Developer | Sprint 3 |
| Input validatie uitbreiden | Developer | Sprint 3 |
| Database queries optimaliseren met eager loading | Developer | Sprint 3 |

### Sprint Velocity
- **Geplande Story Points:** 21
- **Behaalde Story Points:** 21
- **Velocity:** 100%

---

## Sprint 3 Retrospective

### Sprint Informatie
| Item | Waarde |
|------|--------|
| Sprint Nummer | 3 |
| Startdatum | 20-01-2026 |
| Einddatum | 27-01-2026 |
| Sprint Doel | Notificatiesysteem en statusbeheer |

### Wat ging goed? ✅
1. **Notificatiesysteem** - Real-time notificaties voor studenten werken correct
2. **Status workflow** - Aangemeld → Goedgekeurd → Voltooid flow is geïmplementeerd
3. **Docent goedkeuring** - Docenten kunnen aanmeldingen goedkeuren/afwijzen
4. **Alternatieve keuzedelen** - Bij vol keuzedeel worden alternatieven getoond

### Wat kan beter? ⚠️
1. **Code duplicatie** - Sommige logica is herhaald in meerdere controllers
2. **Error handling** - Foutmeldingen kunnen gebruiksvriendelijker
3. **Mobile responsiveness** - Sommige tabellen scrollen niet goed op mobiel

### Actiepunten voor volgende sprint 📋
| Actie | Verantwoordelijke | Deadline |
|-------|-------------------|----------|
| Service classes maken voor herbruikbare logica | Developer | Sprint 4 |
| Custom error pages maken | Developer | Sprint 4 |
| Mobile-first CSS review | Developer | Sprint 4 |

### Sprint Velocity
- **Geplande Story Points:** 24
- **Behaalde Story Points:** 22
- **Velocity:** 92%

---

## Sprint 4 Retrospective

### Sprint Informatie
| Item | Waarde |
|------|--------|
| Sprint Nummer | 4 |
| Startdatum | 27-01-2026 |
| Einddatum | 03-02-2026 |
| Sprint Doel | Opleiding filtering en 2e keuze systeem |

### Wat ging goed? ✅
1. **Opleiding blokkering** - Studenten kunnen alleen keuzedelen van hun opleiding kiezen
2. **2e keuze systeem** - Automatische toewijzing naar 2e keuze bij onvoldoende inschrijvingen
3. **Artisan command** - Achtergrond proces voor automatische hertoewijzing werkt
4. **CSS verbeteringen** - Alle tekst heeft nu goede contrast en leesbaarheid

### Wat kan beter? ⚠️
1. **Testing** - Meer edge cases testen voor het 2e keuze systeem
2. **Scheduler** - Automatische taakplanning nog niet geconfigureerd
3. **Logging** - Meer logging toevoegen voor debugging

### Actiepunten voor volgende sprint 📋
| Actie | Verantwoordelijke | Deadline |
|-------|-------------------|----------|
| Laravel scheduler configureren | Developer | Volgende sprint |
| Uitgebreide logging implementeren | Developer | Volgende sprint |
| Acceptatietests schrijven | Developer | Volgende sprint |

### Sprint Velocity
- **Geplande Story Points:** 21
- **Behaalde Story Points:** 20
- **Velocity:** 95%

---

## Totaal Overzicht

### Velocity Grafiek (Story Points)
```
Sprint 1: ████████████████████░░░░ 18/21 (86%)
Sprint 2: █████████████████████████ 21/21 (100%)
Sprint 3: ██████████████████████░░░ 22/24 (92%)
Sprint 4: ████████████████████░░░░░ 20/21 (95%)
```

### Gemiddelde Velocity: 93%

### Belangrijkste Leerpunten
1. **Planning** - Altijd buffer tijd inplannen voor onvoorziene problemen
2. **Communicatie** - Regelmatig feedback vragen aan stakeholders
3. **Kwaliteit** - Code reviews en testing zijn essentieel
4. **Documentatie** - Bijhouden tijdens development, niet achteraf

### Aanbevelingen voor Toekomstige Projecten
1. Meer tijd reserveren voor testing en QA
2. Wekelijkse demo's aan stakeholders
3. Pair programming voor complexe features
4. Continuous Integration/Deployment opzetten
