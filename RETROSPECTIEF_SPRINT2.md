# Retrospectief Sprint 2

**Datum:** 19 januari 2026

---

## Team

- Jailon
- Youness
- Bassel

---

## Wat hebben we gedaan?

Vooral CSS bugs opgelost. Die oranje lijnen zaten overal - op de admin pagina's, de keuzedelen pagina, profiel, notificaties. Ze liepen van links naar rechts over de hele breedte van de pagina. Niet echt professioneel.

We hebben ze verstopt met `transform: scaleX(0)` en ze alleen laten verschijnen als je erover hovert. Ziet er beter uit nu.

---

## Wat ging goed?

- De bug was duidelijk - gebruiker stuurde screenshots, dus we wisten precies wat we moesten fixen
- Dezelfde fix werkte overal, dus we hebben het patroon gewoon in alle files toegepast
- Geen problemen met de fix - alles werkt nog normaal
- Snelle turnaround

---

## Wat was lastig?

- Had eerder moeten checken dat alle pagina's hetzelfde probleem hadden
- De CSS zat in 7 verschillende bestanden - dat is niet ideaal
- Niemand had dit eerder opgemerkt, dus misschien moeten we beter testen

---

## Wat gaan we volgende sprint doen?

- Die CSS code samenvoegen, het staat nu overal
- Beter testen zodat dit soort dingen niet meer gebeuren
- Misschien wat performance checks doen
- Accessibility kijken

---

## Bestanden die we hebben aangepast

- admin/students.blade.php
- admin/enrollments.blade.php
- admin/keuzedelen/index.blade.php
- keuzedelen/index.blade.php
- keuzedelen/show.blade.php
- profile/show.blade.php
- notifications/index.blade.php

---

## Wat we geleerd hebben

Transform is beter dan width/height aanpassen - geen layout shifts. En screenshots helpen echt om bugs sneller op te lossen.

---

**Status:** Klaar 
