# 🎓 TCR Keuzedelen Beheersysteem

Een volledig functioneel webapplicatie voor het beheren van keuzedelen bij Techniek College Rotterdam, gebouwd met Laravel 11 en moderne web technologieën.

## ✨ Belangrijkste Features

### 🔄 Automatische 2e Keuze Fallback Systeem
- Studenten selecteren verplicht een 2e keuze bij aanmelding
- Automatische verplaatsing naar 2e keuze bij afwijzing of annulering
- Notificaties voor alle statuswijzigingen

### 👨‍🎓 Student Functionaliteit
- Keuzedelen overzicht met zoeken en filteren
- Aanmelden voor keuzedelen met 2-staps proces
- Mijn keuzedelen dashboard
- Inbox voor notificaties
- Suggesties van alternatieve keuzedelen

### 👨‍💼 Admin Functionaliteit
- Keuzedelen beheer (CRUD)
- Inschrijvingen goedkeuren/afwijzen
- Keuzedelen annuleren met automatische fallback
- Studenten overzicht
- Dashboard met statistieken

### 👨‍🏫 SLB Functionaliteit
- Presentatiemodus voor keuzedelen
- Cijferbeheer
- Student voortgang overzicht

## 🛡️ Beveiliging & Compliance

✅ **Beveiliging:**
- Password hashing met bcrypt
- CSRF bescherming
- SQL injectie preventie (Eloquent ORM)
- XSS bescherming

✅ **AVG/GDPR Compliant:**
- Privacy policy pagina
- Cookie consent manager
- Veilige data opslag

✅ **Accessibility:**
- ARIA labels
- Keyboard navigation
- Semantic HTML
- Responsive design

✅ **SEO Optimized:**
- Meta tags
- Open Graph tags
- Semantic markup

## 🚀 Installatie

### Vereisten
- PHP 8.2 of hoger
- MySQL 5.7 of hoger
- Composer
- XAMPP (of andere Apache/MySQL stack)

### Stappen

1. **Clone het project**
```bash
cd c:\xampp\htdocs
git clone [repository-url] schoolsystem
cd schoolsystem
```

2. **Installeer dependencies**
```bash
composer install
```

3. **Configureer environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Database configuratie**
Bewerk `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=schoolsystem
DB_USERNAME=root
DB_PASSWORD=
```

5. **Maak database aan**
```sql
CREATE DATABASE schoolsystem CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

6. **Run migrations en seeders**
```bash
php artisan migrate:fresh --seed
```

7. **Start de applicatie**
```bash
php artisan serve
```

Bezoek: `http://localhost:8000`

## 👤 Test Accounts

### Student
- **Email:** `alivia.williamson@leerling.tcr.nl`
- **Password:** `Welkom2024!`

### Admin
- **Email:** `admin@tcr.nl`
- **Password:** `admin123`

### SLB Docent
- **Email:** `slb@tcr.nl`
- **Password:** `slb123`

## 📁 Project Structuur

```
schoolsystem/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php
│   │   │   ├── KeuzedeelController.php
│   │   │   ├── NotificationController.php
│   │   │   └── ...
│   │   └── Middleware/
│   └── Models/
│       ├── User.php
│       ├── Keuzedeel.php
│       └── Notification.php
├── database/
│   ├── migrations/
│   └── seeders/
├── docs/
│   ├── ERD-Diagram.drawio
│   ├── Activity-Diagram-Enrollment.drawio
│   ├── Sitemap.drawio
│   ├── UseCase-Diagram.drawio
│   ├── Wireframes.drawio
│   └── PROJECT-DOCUMENTATIE.md
├── public/
│   └── js/
│       └── cookie-consent.js
├── resources/
│   └── views/
│       ├── keuzedelen/
│       ├── admin/
│       ├── slb/
│       ├── privacy.blade.php
│       └── layouts/
└── routes/
    └── web.php
```

## 📚 Documentatie

Alle project documentatie is te vinden in de `/docs` folder:

- **PROJECT-DOCUMENTATIE.md** - Volledige project documentatie met MoSCoW, backlog, sprints, reflectie
- **ERD-Diagram.drawio** - Entity Relationship Diagram (import in draw.io)
- **Activity-Diagram-Enrollment.drawio** - Activity diagram voor aanmeldingsproces
- **Sitemap.drawio** - Complete sitemap van de applicatie
- **UseCase-Diagram.drawio** - Use case diagram met alle actors
- **Wireframes.drawio** - Wireframes van belangrijkste pagina's

### Diagrammen Openen
1. Ga naar [draw.io](https://app.diagrams.net/)
2. Klik op "Open Existing Diagram"
3. Selecteer een `.drawio` bestand uit de `/docs` folder
4. Bekijk en bewerk het diagram

## 🎯 Leerdoelen Behaald

### Ontwerpen
✅ ERD (gevorderd)  
✅ Activity Diagram (eindexamenniveau)  
✅ Sitemap (eindexamenniveau)  
✅ Use Case Diagram (beginner)  
✅ Wireframes (eindexamenniveau)  

### Programmeren
✅ Codestructuur (eindexamenniveau)  
✅ Projectstructuur (eindexamenniveau)  
✅ OOP (eindexamenniveau)  
✅ PHP (eindexamenniveau)  
✅ Laravel (gevorderd)  
✅ JavaScript (eindexamenniveau)  
✅ Accessibility (eindexamenniveau)  
✅ SEO (eindexamenniveau)  
✅ Hash en Salt (bcrypt)  
✅ Voorkomen SQL injecties (Eloquent ORM)  

### Project
✅ MoSCoW (eindexamenniveau)  
✅ User Stories (eindexamenniveau)  
✅ Backlog (beginner)  
✅ Sprint Planning (eindexamenniveau)  
✅ Scrum-board gebruik (eindexamenniveau)  
✅ Reflecteren (eindexamenniveau)  
✅ Retrospective (eindexamenniveau)  
✅ Versiebeheer (eindexamenniveau)  

### IT Skills
✅ AVG/GDPR (eindexamenniveau)  
✅ Bestandsystemen (eindexamenniveau)  

## 🔧 Technische Stack

- **Backend:** PHP 8.2, Laravel 11
- **Frontend:** Blade Templates, Vanilla JavaScript ES6+
- **Database:** MySQL 8.0
- **Styling:** Custom CSS met CSS Variables
- **Icons:** SVG icons
- **Versiebeheer:** Git
- **Server:** Apache (XAMPP)

## 🌟 Belangrijkste Functionaliteiten

### 2e Keuze Systeem
Het unieke 2e keuze systeem zorgt ervoor dat studenten nooit zonder keuzedeel zitten:
1. Student selecteert 1e keuze keuzedeel
2. Student selecteert verplicht 2e keuze (met live preview)
3. Bij afwijzing of annulering: automatisch naar 2e keuze
4. Status wordt automatisch "goedgekeurd" voor 2e keuze
5. Student ontvangt notificatie over verplaatsing

### Notificatiesysteem
- Real-time notificaties voor alle statuswijzigingen
- Inbox met ongelezen badge
- Markeer als gelezen functionaliteit
- Verwijder notificaties

### Admin Dashboard
- Overzicht van alle keuzedelen
- Statistieken (totaal studenten, keuzedelen, inschrijvingen)
- Snel inschrijvingen goedkeuren/afwijzen
- Keuzedelen annuleren met automatische fallback

## 🐛 Troubleshooting

### Database connectie error
```bash
php artisan config:clear
php artisan cache:clear
```

### Migrations error
```bash
php artisan migrate:fresh --seed
```

### Permission errors (Linux/Mac)
```bash
chmod -R 775 storage bootstrap/cache
```

## 📝 License

Dit project is ontwikkeld voor educatieve doeleinden bij Techniek College Rotterdam.

## 👨‍💻 Ontwikkelaar

**Naam:** [Jouw Naam]  
**Opleiding:** Software Development  
**School:** Techniek College Rotterdam  
**Jaar:** 2026  

---

**Versie:** 1.0  
**Laatste update:** 30 januari 2026  
**Status:** ✅ Productie-ready
