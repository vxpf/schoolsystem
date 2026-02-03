# Acceptatietests - TCR Keuzedelen Systeem

## Project Informatie
- **Projectnaam:** TCR Keuzedelen Systeem
- **Versie:** 1.0
- **Testdatum:** Januari 2026
- **Tester:** [Naam]

---

## AT-01: Gebruiker Authenticatie

### Testcase AT-01.1: Microsoft Login
| Item | Beschrijving |
|------|--------------|
| **ID** | AT-01.1 |
| **Naam** | Inloggen met Microsoft account |
| **Prioriteit** | Hoog |
| **Precondities** | Gebruiker heeft een geldig Microsoft schoolaccount |

| Stap | Actie | Verwacht Resultaat |
|------|-------|-------------------|
| 1 | Navigeer naar de loginpagina | Loginpagina wordt getoond met Microsoft login knop |
| 2 | Klik op "Inloggen met Microsoft" | Redirect naar Microsoft login pagina |
| 3 | Voer schoolemail en wachtwoord in | Authenticatie wordt verwerkt |
| 4 | Accepteer permissies (eerste keer) | Redirect terug naar applicatie |
| 5 | Controleer dashboard | Gebruiker is ingelogd, naam wordt getoond in header |

| **Resultaat** | ☐ Geslaagd / ☐ Gefaald |
| **Opmerkingen** | |

### Testcase AT-01.2: Uitloggen
| Item | Beschrijving |
|------|--------------|
| **ID** | AT-01.2 |
| **Naam** | Uitloggen uit het systeem |
| **Prioriteit** | Hoog |
| **Precondities** | Gebruiker is ingelogd |

| Stap | Actie | Verwacht Resultaat |
|------|-------|-------------------|
| 1 | Klik op gebruikersnaam in header | Dropdown menu verschijnt |
| 2 | Klik op "Uitloggen" | Sessie wordt beëindigd |
| 3 | Controleer redirect | Gebruiker wordt naar loginpagina gestuurd |
| 4 | Probeer beschermde pagina te bezoeken | Redirect naar login |

| **Resultaat** | ☐ Geslaagd / ☐ Gefaald |
| **Opmerkingen** | |

---

## AT-02: Keuzedelen Bekijken

### Testcase AT-02.1: Keuzedelen Overzicht
| Item | Beschrijving |
|------|--------------|
| **ID** | AT-02.1 |
| **Naam** | Bekijken van alle beschikbare keuzedelen |
| **Prioriteit** | Hoog |
| **Precondities** | Gebruiker is ingelogd als student |

| Stap | Actie | Verwacht Resultaat |
|------|-------|-------------------|
| 1 | Klik op "Keuzedelen" in navigatie | Overzichtspagina wordt getoond |
| 2 | Controleer keuzedelen cards | Alle actieve keuzedelen worden getoond |
| 3 | Controleer informatie per card | Naam, code, studiepunten, capaciteit zichtbaar |
| 4 | Controleer capaciteitsbalk | Visuele weergave van bezetting |

| **Resultaat** | ☐ Geslaagd / ☐ Gefaald |
| **Opmerkingen** | |

### Testcase AT-02.2: Keuzedeel Detail
| Item | Beschrijving |
|------|--------------|
| **ID** | AT-02.2 |
| **Naam** | Bekijken van keuzedeel details |
| **Prioriteit** | Hoog |
| **Precondities** | Gebruiker is ingelogd |

| Stap | Actie | Verwacht Resultaat |
|------|-------|-------------------|
| 1 | Klik op een keuzedeel card | Detailpagina wordt getoond |
| 2 | Controleer beschrijving | Volledige beschrijving zichtbaar |
| 3 | Controleer "Wat leer je?" sectie | Leerdoelen worden getoond |
| 4 | Controleer sidebar informatie | Studiepunten, niveau, code, capaciteit zichtbaar |

| **Resultaat** | ☐ Geslaagd / ☐ Gefaald |
| **Opmerkingen** | |

### Testcase AT-02.3: Filteren op Periode
| Item | Beschrijving |
|------|--------------|
| **ID** | AT-02.3 |
| **Naam** | Filteren van keuzedelen op periode |
| **Prioriteit** | Medium |
| **Precondities** | Meerdere keuzedelen in verschillende periodes |

| Stap | Actie | Verwacht Resultaat |
|------|-------|-------------------|
| 1 | Ga naar keuzedelen overzicht | Alle keuzedelen getoond |
| 2 | Selecteer "Periode 1" in filter | Alleen periode 1 keuzedelen getoond |
| 3 | Selecteer "Periode 2" in filter | Alleen periode 2 keuzedelen getoond |
| 4 | Klik op "Reset" | Alle keuzedelen weer zichtbaar |

| **Resultaat** | ☐ Geslaagd / ☐ Gefaald |
| **Opmerkingen** | |

---

## AT-03: Aanmelden voor Keuzedeel

### Testcase AT-03.1: Succesvolle Aanmelding
| Item | Beschrijving |
|------|--------------|
| **ID** | AT-03.1 |
| **Naam** | Aanmelden voor een keuzedeel |
| **Prioriteit** | Hoog |
| **Precondities** | Student is ingelogd, keuzedeel heeft plek |

| Stap | Actie | Verwacht Resultaat |
|------|-------|-------------------|
| 1 | Ga naar keuzedeel detailpagina | Aanmeldknop is zichtbaar |
| 2 | Klik op "Aanmelden voor dit keuzedeel" | Aanmelding wordt verwerkt |
| 3 | Controleer bevestiging | Succesmelding wordt getoond |
| 4 | Controleer status | Status "Aangemeld" wordt getoond |
| 5 | Ga naar "Mijn Keuzedelen" | Keuzedeel staat in de lijst |

| **Resultaat** | ☐ Geslaagd / ☐ Gefaald |
| **Opmerkingen** | |

### Testcase AT-03.2: Aanmelding met 2e Keuze
| Item | Beschrijving |
|------|--------------|
| **ID** | AT-03.2 |
| **Naam** | Aanmelden met tweede keuze selectie |
| **Prioriteit** | Medium |
| **Precondities** | Meerdere keuzedelen beschikbaar |

| Stap | Actie | Verwacht Resultaat |
|------|-------|-------------------|
| 1 | Ga naar keuzedeel detailpagina | Aanmeldformulier zichtbaar |
| 2 | Selecteer een 2e keuze uit dropdown | Alternatief keuzedeel geselecteerd |
| 3 | Klik op "Aanmelden" | Aanmelding met 2e keuze opgeslagen |
| 4 | Controleer bevestiging | Melding toont 1e en 2e keuze |

| **Resultaat** | ☐ Geslaagd / ☐ Gefaald |
| **Opmerkingen** | |

### Testcase AT-03.3: Blokkering Verkeerde Opleiding
| Item | Beschrijving |
|------|--------------|
| **ID** | AT-03.3 |
| **Naam** | Blokkering bij verkeerde opleiding |
| **Prioriteit** | Hoog |
| **Precondities** | Keuzedeel heeft specifieke opleiding, student heeft andere opleiding |

| Stap | Actie | Verwacht Resultaat |
|------|-------|-------------------|
| 1 | Ga naar keuzedeel van andere opleiding | Detailpagina wordt getoond |
| 2 | Controleer aanmeldknop | Knop is uitgeschakeld (grijs) |
| 3 | Controleer melding | Tekst legt uit waarom aanmelding niet mogelijk is |
| 4 | Probeer direct POST request | Server weigert aanmelding met foutmelding |

| **Resultaat** | ☐ Geslaagd / ☐ Gefaald |
| **Opmerkingen** | |

### Testcase AT-03.4: Vol Keuzedeel
| Item | Beschrijving |
|------|--------------|
| **ID** | AT-03.4 |
| **Naam** | Aanmelding bij vol keuzedeel |
| **Prioriteit** | Hoog |
| **Precondities** | Keuzedeel heeft maximum capaciteit bereikt |

| Stap | Actie | Verwacht Resultaat |
|------|-------|-------------------|
| 1 | Ga naar vol keuzedeel | Detailpagina wordt getoond |
| 2 | Controleer aanmeldknop | Knop toont "Dit keuzedeel is vol" |
| 3 | Controleer alternatieven | Alternatieve keuzedelen worden getoond |

| **Resultaat** | ☐ Geslaagd / ☐ Gefaald |
| **Opmerkingen** | |

---

## AT-04: Afmelden voor Keuzedeel

### Testcase AT-04.1: Succesvolle Afmelding
| Item | Beschrijving |
|------|--------------|
| **ID** | AT-04.1 |
| **Naam** | Afmelden voor een keuzedeel |
| **Prioriteit** | Hoog |
| **Precondities** | Student is aangemeld voor keuzedeel, status is "aangemeld" |

| Stap | Actie | Verwacht Resultaat |
|------|-------|-------------------|
| 1 | Ga naar "Mijn Keuzedelen" | Aangemelde keuzedelen getoond |
| 2 | Klik op "Afmelden" bij keuzedeel | Bevestigingsdialoog verschijnt |
| 3 | Bevestig afmelding | Afmelding wordt verwerkt |
| 4 | Controleer lijst | Keuzedeel is verwijderd uit lijst |

| **Resultaat** | ☐ Geslaagd / ☐ Gefaald |
| **Opmerkingen** | |

---

## AT-05: Admin Functionaliteit

### Testcase AT-05.1: Keuzedeel Aanmaken
| Item | Beschrijving |
|------|--------------|
| **ID** | AT-05.1 |
| **Naam** | Nieuw keuzedeel aanmaken |
| **Prioriteit** | Hoog |
| **Precondities** | Gebruiker is ingelogd als admin |

| Stap | Actie | Verwacht Resultaat |
|------|-------|-------------------|
| 1 | Ga naar Admin > Keuzedelen | Overzicht wordt getoond |
| 2 | Klik op "Nieuw Keuzedeel" | Formulier wordt getoond |
| 3 | Vul alle verplichte velden in | Validatie is succesvol |
| 4 | Klik op "Opslaan" | Keuzedeel wordt aangemaakt |
| 5 | Controleer overzicht | Nieuw keuzedeel staat in lijst |

| **Resultaat** | ☐ Geslaagd / ☐ Gefaald |
| **Opmerkingen** | |

### Testcase AT-05.2: Aanmelding Goedkeuren
| Item | Beschrijving |
|------|--------------|
| **ID** | AT-05.2 |
| **Naam** | Studentaanmelding goedkeuren |
| **Prioriteit** | Hoog |
| **Precondities** | Er is een aanmelding met status "aangemeld" |

| Stap | Actie | Verwacht Resultaat |
|------|-------|-------------------|
| 1 | Ga naar Admin > Inschrijvingen | Overzicht wordt getoond |
| 2 | Zoek aanmelding met status "Aangemeld" | Aanmelding gevonden |
| 3 | Wijzig status naar "Goedgekeurd" | Status wordt opgeslagen |
| 4 | Controleer student notificatie | Student ontvangt notificatie |

| **Resultaat** | ☐ Geslaagd / ☐ Gefaald |
| **Opmerkingen** | |

### Testcase AT-05.3: Aanmelding Afwijzen
| Item | Beschrijving |
|------|--------------|
| **ID** | AT-05.3 |
| **Naam** | Studentaanmelding afwijzen |
| **Prioriteit** | Hoog |
| **Precondities** | Er is een aanmelding met status "aangemeld" |

| Stap | Actie | Verwacht Resultaat |
|------|-------|-------------------|
| 1 | Ga naar Admin > Inschrijvingen | Overzicht wordt getoond |
| 2 | Zoek aanmelding met status "Aangemeld" | Aanmelding gevonden |
| 3 | Wijzig status naar "Afgewezen" | Status wordt opgeslagen |
| 4 | Controleer student notificatie | Student ontvangt notificatie met reden |

| **Resultaat** | ☐ Geslaagd / ☐ Gefaald |
| **Opmerkingen** | |

---

## AT-06: Notificaties

### Testcase AT-06.1: Notificatie Ontvangen
| Item | Beschrijving |
|------|--------------|
| **ID** | AT-06.1 |
| **Naam** | Notificatie ontvangen bij statuswijziging |
| **Prioriteit** | Medium |
| **Precondities** | Student heeft aanmelding, admin wijzigt status |

| Stap | Actie | Verwacht Resultaat |
|------|-------|-------------------|
| 1 | Admin wijzigt status van aanmelding | Notificatie wordt aangemaakt |
| 2 | Student logt in | Notificatie badge toont aantal |
| 3 | Klik op notificatie icoon | Notificaties worden getoond |
| 4 | Controleer inhoud | Correcte titel en bericht |

| **Resultaat** | ☐ Geslaagd / ☐ Gefaald |
| **Opmerkingen** | |

### Testcase AT-06.2: Notificatie Markeren als Gelezen
| Item | Beschrijving |
|------|--------------|
| **ID** | AT-06.2 |
| **Naam** | Notificatie markeren als gelezen |
| **Prioriteit** | Laag |
| **Precondities** | Student heeft ongelezen notificaties |

| Stap | Actie | Verwacht Resultaat |
|------|-------|-------------------|
| 1 | Open notificaties | Ongelezen notificaties getoond |
| 2 | Klik op notificatie | Notificatie wordt geopend |
| 3 | Controleer status | Notificatie is gemarkeerd als gelezen |
| 4 | Controleer badge | Aantal ongelezen is verminderd |

| **Resultaat** | ☐ Geslaagd / ☐ Gefaald |
| **Opmerkingen** | |

---

## Testresultaten Samenvatting

| Test ID | Testnaam | Resultaat | Datum |
|---------|----------|-----------|-------|
| AT-01.1 | Microsoft Login | ☐ | |
| AT-01.2 | Uitloggen | ☐ | |
| AT-02.1 | Keuzedelen Overzicht | ☐ | |
| AT-02.2 | Keuzedeel Detail | ☐ | |
| AT-02.3 | Filteren op Periode | ☐ | |
| AT-03.1 | Succesvolle Aanmelding | ☐ | |
| AT-03.2 | Aanmelding met 2e Keuze | ☐ | |
| AT-03.3 | Blokkering Verkeerde Opleiding | ☐ | |
| AT-03.4 | Vol Keuzedeel | ☐ | |
| AT-04.1 | Succesvolle Afmelding | ☐ | |
| AT-05.1 | Keuzedeel Aanmaken | ☐ | |
| AT-05.2 | Aanmelding Goedkeuren | ☐ | |
| AT-05.3 | Aanmelding Afwijzen | ☐ | |
| AT-06.1 | Notificatie Ontvangen | ☐ | |
| AT-06.2 | Notificatie Markeren als Gelezen | ☐ | |

### Totaal
- **Geslaagd:** ___ / 15
- **Gefaald:** ___ / 15
- **Slagingspercentage:** ___%

### Handtekening
| Rol | Naam | Handtekening | Datum |
|-----|------|--------------|-------|
| Tester | | | |
| Opdrachtgever | | | |
