@extends('layouts.app')

@section('title', 'Privacy Policy')

@section('content')
<div style="max-width: 900px; margin: 0 auto; padding: 2rem;">
    <h1 style="font-size: 2.5rem; font-weight: 800; color: var(--text-dark); margin-bottom: 1rem;">Privacy Policy</h1>
    <p style="color: var(--text-secondary); margin-bottom: 2rem;">Laatst bijgewerkt: {{ date('d-m-Y') }}</p>

    <div style="background: var(--bg-card); padding: 2rem; border-radius: var(--radius); border: 1px solid var(--border); margin-bottom: 2rem;">
        <h2 style="font-size: 1.5rem; font-weight: 700; color: var(--text-dark); margin-bottom: 1rem;">1. Welke gegevens verzamelen wij?</h2>
        <p style="color: var(--text-secondary); line-height: 1.6; margin-bottom: 1rem;">
            Wij verzamelen de volgende persoonsgegevens:
        </p>
        <ul style="color: var(--text-secondary); line-height: 1.8; margin-left: 2rem;">
            <li>Naam en e-mailadres</li>
            <li>Studentnummer en opleiding</li>
            <li>Klas en studiejaar</li>
            <li>Keuzedeel inschrijvingen en voortgang</li>
            <li>Login gegevens (wachtwoord wordt versleuteld opgeslagen)</li>
        </ul>
    </div>

    <div style="background: var(--bg-card); padding: 2rem; border-radius: var(--radius); border: 1px solid var(--border); margin-bottom: 2rem;">
        <h2 style="font-size: 1.5rem; font-weight: 700; color: var(--text-dark); margin-bottom: 1rem;">2. Waarvoor gebruiken wij uw gegevens?</h2>
        <p style="color: var(--text-secondary); line-height: 1.6;">
            Uw gegevens worden gebruikt voor:
        </p>
        <ul style="color: var(--text-secondary); line-height: 1.8; margin-left: 2rem;">
            <li>Het beheren van uw keuzedeel inschrijvingen</li>
            <li>Communicatie over uw aanmeldingen en voortgang</li>
            <li>Het versturen van notificaties</li>
            <li>Rapportage aan docenten en administratie</li>
        </ul>
    </div>

    <div style="background: var(--bg-card); padding: 2rem; border-radius: var(--radius); border: 1px solid var(--border); margin-bottom: 2rem;">
        <h2 style="font-size: 1.5rem; font-weight: 700; color: var(--text-dark); margin-bottom: 1rem;">3. Beveiliging</h2>
        <p style="color: var(--text-secondary); line-height: 1.6;">
            Wij nemen de bescherming van uw gegevens serieus en hebben passende technische en organisatorische maatregelen genomen:
        </p>
        <ul style="color: var(--text-secondary); line-height: 1.8; margin-left: 2rem;">
            <li>Wachtwoorden worden versleuteld opgeslagen (bcrypt hashing)</li>
            <li>CSRF-bescherming op alle formulieren</li>
            <li>SQL-injectie preventie door gebruik van Eloquent ORM</li>
            <li>Beveiligde sessies en cookies</li>
        </ul>
    </div>

    <div style="background: var(--bg-card); padding: 2rem; border-radius: var(--radius); border: 1px solid var(--border); margin-bottom: 2rem;">
        <h2 style="font-size: 1.5rem; font-weight: 700; color: var(--text-dark); margin-bottom: 1rem;">4. Uw rechten (AVG)</h2>
        <p style="color: var(--text-secondary); line-height: 1.6; margin-bottom: 1rem;">
            Op grond van de AVG heeft u de volgende rechten:
        </p>
        <ul style="color: var(--text-secondary); line-height: 1.8; margin-left: 2rem;">
            <li><strong>Recht op inzage:</strong> U kunt opvragen welke gegevens wij van u hebben</li>
            <li><strong>Recht op rectificatie:</strong> U kunt onjuiste gegevens laten corrigeren</li>
            <li><strong>Recht op verwijdering:</strong> U kunt verzoeken uw gegevens te verwijderen</li>
            <li><strong>Recht op dataportabiliteit:</strong> U kunt uw gegevens in een leesbaar formaat opvragen</li>
            <li><strong>Recht van bezwaar:</strong> U kunt bezwaar maken tegen de verwerking van uw gegevens</li>
        </ul>
    </div>

    <div style="background: var(--bg-card); padding: 2rem; border-radius: var(--radius); border: 1px solid var(--border); margin-bottom: 2rem;">
        <h2 style="font-size: 1.5rem; font-weight: 700; color: var(--text-dark); margin-bottom: 1rem;">5. Cookies</h2>
        <p style="color: var(--text-secondary); line-height: 1.6;">
            Deze website gebruikt alleen functionele cookies die noodzakelijk zijn voor het functioneren van de website:
        </p>
        <ul style="color: var(--text-secondary); line-height: 1.8; margin-left: 2rem;">
            <li><strong>Sessie cookie:</strong> Voor het bijhouden van uw login sessie</li>
            <li><strong>CSRF token:</strong> Voor beveiliging tegen cross-site request forgery</li>
        </ul>
    </div>

    <div style="background: var(--bg-card); padding: 2rem; border-radius: var(--radius); border: 1px solid var(--border);">
        <h2 style="font-size: 1.5rem; font-weight: 700; color: var(--text-dark); margin-bottom: 1rem;">6. Contact</h2>
        <p style="color: var(--text-secondary); line-height: 1.6;">
            Voor vragen over deze privacy policy of het uitoefenen van uw rechten kunt u contact opnemen met:
        </p>
        <p style="color: var(--text-secondary); line-height: 1.6; margin-top: 1rem;">
            <strong>Techniek College Rotterdam</strong><br>
            E-mail: privacy@tcr.nl<br>
            Telefoon: 010-123 4567
        </p>
    </div>

    <div style="margin-top: 2rem; text-align: center;">
        <a href="{{ url('/') }}" class="btn btn-primary">Terug naar home</a>
    </div>
</div>
@endsection
