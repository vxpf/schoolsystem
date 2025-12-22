<x-mail::message>
# 🎉 Aanmelding Bevestigd!

Beste {{ $user->name }},

Je aanmelding voor het keuzedeel **{{ $keuzedeel->naam }}** is succesvol ontvangen!

## 📋 Keuzedeel Details

**Code:** {{ $keuzedeel->code }}  
**Studiepunten:** {{ $keuzedeel->studiepunten }} SP  
**Niveau:** {{ $keuzedeel->niveau ?? 'N.v.t.' }}  
**Periode:** {{ $user->huidige_periode }}

## 📌 Wat nu?

Je aanmelding heeft de status **"Aangemeld"** en wordt zo snel mogelijk beoordeeld door je docent. Je ontvangt een nieuwe notificatie zodra je aanmelding is goedgekeurd.

Je kunt de status van je aanmelding altijd bekijken in het dashboard.

<x-mail::button :url="url('/keuzedelen/mijn')" color="success">
Bekijk Mijn Keuzedelen
</x-mail::button>

---

**Let op:** Als je deze aanmelding niet hebt gedaan, neem dan direct contact op met je docent.

Met vriendelijke groet,  
**Techniek College Rotterdam**  
Keuzedelen Administratie

<x-mail::subcopy>
Dit is een automatisch gegenereerde email. Je kunt hier niet op reageren.
</x-mail::subcopy>
</x-mail::message>
