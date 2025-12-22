# TCR Keuzedelen Systeem - Inloggegevens

## Toegang tot het systeem
- **URL**: http://localhost/schoolsystem/public/
- **Standaard wachtwoord voor alle studenten**: `Welkom2024!`

## Studentenaccounts

| Leerlingnummer | Naam | E-mailadres | Opleiding | Klas |
|----------------|------|-------------|-----------|------|
| 1234567 | Alivia Williamson | alivia.williamson@leerling.tcr.nl | 25604BOL | PALVSOD2F |
| 1234568 | Austin Padilla | austin.padilla@leerling.tcr.nl | 25998BOL | PALVSOD2F |
| 1234569 | Cole Leon | cole.leon@leerling.tcr.nl | 25604BOL | PALVSOD2F |
| 1234570 | Dale O'Ryan | dale.o'ryan@leerling.tcr.nl | 25998BOL | PALVSOD2F |
| 1234571 | Dawson Blankenship | dawson.blankenship@leerling.tcr.nl | 25998BOL | PALVSOD2F |
| 1234572 | Dewey Rhodes | dewey.rhodes@leerling.tcr.nl | 25604BOL | PALVSOD2F |
| 1234573 | Eileen Kelly | eileen.kelly@leerling.tcr.nl | 25604BOL | PALVSOD2F |
| 1234574 | Ella-Louise Heath | ella-louise.heath@leerling.tcr.nl | 25998BOL | PALVSOD2F |
| 1234575 | Ellie-Mae Trujillo | ellie-mae.trujillo@leerling.tcr.nl | 25998BOL | PALVSOD2F |
| 1234576 | Evie Campos | evie.campos@leerling.tcr.nl | 25998BOL | PALVSOD2F |
| 1234577 | Gwen Bonner | gwen.bonner@leerling.tcr.nl | 25998BOL | PALVSOD2F |
| 1234578 | Joe Boyle | joe.boyle@leerling.tcr.nl | 25998BOL | PALVSOD2F |
| 1234579 | Julia Adams | julia.adams@leerling.tcr.nl | 25998BOL | PALVSOD2F |
| 1234580 | Karen Richards | karen.richards@leerling.tcr.nl | 25998BOL | PALVSOD2F |
| 1234581 | Laura Ellis | laura.ellis@leerling.tcr.nl | 25998BOL | PALVSOD2F |
| 1234582 | Leila Copeland | leila.copeland@leerling.tcr.nl | 25998BOL | PALVSOD2F |
| 1234583 | Martina Roman | martina.roman@leerling.tcr.nl | 25998BOL | PALVSOD2F |
| 1234584 | Molly Cline | molly.cline@leerling.tcr.nl | 25604BOL | PALVSOD2F |
| 1234585 | Sarah Kemp | sarah.kemp@leerling.tcr.nl | 25998BOL | PALVSOD2F |
| 1234586 | Solomon Ball | solomon.ball@leerling.tcr.nl | 25998BOL | PALVSOD2F |
| 1234587 | Victor Gilmore | victor.gilmore@leerling.tcr.nl | 25604BOL | PALVSOD2F |
| 9024886 | Test Student Email | 9024886@student.zadkine.nl | 25998BOL | PALVSOD2F |

## Hoe in te loggen
1. Ga naar http://localhost/schoolsystem/public/
2. Klik op "Inloggen"
3. Gebruik het e-mailadres van de student (zie tabel hierboven)
4. Gebruik het standaard wachtwoord: `Welkom2024!`
5. Je wordt doorgestuurd naar het dashboard

## Testgegevens
- Alle studenten hebben dezelfde wachtwoord voor testdoeleinden
- De studenten zijn geïmporteerd uit het bestand `studentenschoolsystem.csv`
- Elke student heeft een uniek leerlingnummer, naam, e-mailadres, opleiding en klas

## 📧 Email Notificaties

Het systeem verstuurt automatisch emails naar studenten bij:
- **Aanmelding voor een keuzedeel** - Bevestigingsmail met keuzedeel details

### Test Student voor Email
- **Email**: 9024886@student.zadkine.nl
- **Wachtwoord**: Welkom2024!
- Deze student is speciaal aangemaakt om email functionaliteit te testen

### Email Configuratie (.env)

Voor **development/testing** met Mailtrap:
```
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@tcr.nl"
MAIL_FROM_NAME="TCR Keuzedelen"
```

Voor **local testing** (emails worden opgeslagen in log):
```
MAIL_MAILER=log
MAIL_FROM_ADDRESS="noreply@tcr.nl"
MAIL_FROM_NAME="TCR Keuzedelen"
```

### Email Testen
1. Log in met test student (9024886@student.zadkine.nl)
2. Meld je aan voor een keuzedeel
3. Check je inbox (of `storage/logs/laravel.log` bij log driver)
4. Je ontvangt een professionele bevestigingsmail met alle details
