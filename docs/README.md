# Documentatie - TCR Keuzedelen Systeem

## Project Informatie
- **Projectnaam:** TCR Keuzedelen Systeem
- **Versie:** 1.0
- **Datum:** Januari 2026
- **Niveau:** MBO 4 Eindexamen

---

## Documentatie Overzicht

### 📁 Hoofddocumenten

| Document | Bestand | Beschrijving |
|----------|---------|--------------|
| Sprint Retrospectives | `Sprint_Retrospectives.md` | 4 sprint retrospectives met velocity, actiepunten en leerpunten |
| Acceptatietests | `Acceptatietests.md` | Volledige acceptatietests met testcases en verwachte resultaten |
| Sitemap | `Sitemap.md` | Tekstuele sitemap met URL structuur en routing |
| Wireframes | `Wireframes.md` | ASCII wireframes van alle belangrijke pagina's |

### 📁 Draw.io Diagrammen (`/diagrams/`)

| Diagram | Bestand | Beschrijving |
|---------|---------|--------------|
| Klassediagram | `ClassDiagram.drawio` | UML klassediagram met alle entiteiten, attributen, methoden en relaties |
| Use Case Diagram | `UseCaseDiagram.drawio` | Use case diagram met actoren en alle systeemfuncties |
| Activiteitendiagram | `ActivityDiagram.drawio` | Activiteitendiagram voor het aanmeldproces |
| ERD | `ERD.drawio` | Entity Relationship Diagram met alle database tabellen |
| Sitemap | `Sitemap.drawio` | Visuele sitemap van de applicatie |
| Wireframes | `Wireframes.drawio` | Visuele wireframes van de belangrijkste schermen |

---

## Hoe te gebruiken

### Draw.io bestanden openen
1. Ga naar [draw.io](https://app.diagrams.net/)
2. Klik op **File** → **Open from** → **Device**
3. Selecteer het `.drawio` bestand
4. Het diagram wordt geladen en is bewerkbaar

### Markdown bestanden bekijken
- Open in VS Code of een andere Markdown viewer
- Of bekijk direct op GitHub

---

## Inhoud per Document

### Sprint Retrospectives
- 4 complete sprint retrospectives
- Per sprint: wat ging goed, wat kan beter, actiepunten
- Velocity tracking en grafieken
- Totaaloverzicht met leerpunten

### Acceptatietests
- 15+ testcases
- Gestructureerd per functionaliteit
- Stap-voor-stap instructies
- Verwachte resultaten
- Resultaten tabel voor invullen

### Klassediagram
- 4 klassen: User, Keuzedeel, Notification, KeuzedeelUser
- Alle attributen met datatypes
- Alle methoden met return types
- Relaties met multipliciteit (1, 0..*)
- Associatieklasse voor many-to-many relatie

### Use Case Diagram
- 2 actoren: Student, Admin/SLB
- 18 use cases
- Include en extend relaties
- Kleurcodering per categorie

### Activiteitendiagram
- Volledig aanmeldproces
- Beslissingen (vol? opleiding match? 2e keuze?)
- Swimlanes voor Student en Systeem
- Start en eindpunten

### ERD
- 4 tabellen: users, keuzedelen, keuzedeel_user, notifications
- Alle kolommen met datatypes
- Primary keys en foreign keys
- Relaties met cardinaliteit

### Sitemap
- Volledige URL structuur
- Hiërarchische weergave
- Kleurcodering per sectie

### Wireframes
- Login pagina
- Keuzedelen overzicht
- Keuzedeel detail
- Mijn keuzedelen
- Admin dashboard

---

## MBO 4 Eindexamen Criteria

Deze documentatie voldoet aan de volgende MBO 4 criteria:

✅ **Klassediagram** - UML notatie, attributen, methoden, relaties, multipliciteit  
✅ **Use Case Diagram** - Actoren, use cases, include/extend relaties  
✅ **Activiteitendiagram** - Acties, beslissingen, swimlanes  
✅ **ERD** - Entiteiten, attributen, relaties, cardinaliteit  
✅ **Wireframes** - Schermontwerpen met UI elementen  
✅ **Sitemap** - Navigatiestructuur  
✅ **Acceptatietests** - Testcases met verwachte resultaten  
✅ **Sprint Retrospectives** - Agile/Scrum documentatie  

---

## Auteur
[Naam Student]  
[Studentnummer]  
[Opleiding]  
[Datum]
