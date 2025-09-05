# EmailJS Setup - Complete Implementatie

## Overzicht
Je formulier gebruikt nu een **3-laags fallback systeem** voor maximale betrouwbaarheid:

1. **EmailJS** (Primair) - Directe verzending zonder doorverwijzing
2. **PHP Service** (Fallback) - Server-side email verzending
3. **Mailto Link** (Laatste redmiddel) - Opent email client van gebruiker

## Stap 1: EmailJS Account Aanmaken

1. Ga naar [EmailJS.com](https://www.emailjs.com/)
2. Maak een gratis account aan (200 emails/maand)
3. Log in op je dashboard

## Stap 2: Email Service Configureren

1. Ga naar **"Email Services"** in je dashboard
2. Klik op **"Add New Service"**
3. Kies je email provider:
   - **Gmail** (aanbevolen)
   - **Outlook/Hotmail**
   - **Yahoo**
   - Of andere provider
4. Volg de instructies om je email account te verbinden
5. **Noteer de Service ID** (bijv. `service_1234567`)

## Stap 3: Email Template Maken

1. Ga naar **"Email Templates"** in je dashboard
2. Klik op **"Create New Template"**
3. Gebruik deze template code:

```html
<h2>Nieuwe Aanmelding Kraamzorg</h2>

<p><strong>Naam:</strong> {{from_name}}</p>
<p><strong>Email:</strong> {{from_email}}</p>
<p><strong>Telefoon:</strong> {{phone}}</p>
<p><strong>Uitgerekende datum:</strong> {{due_date}}</p>
<p><strong>Zorgverzekeraar:</strong> {{zorgverzekeraar}}</p>
<p><strong>Woonplaats:</strong> {{plaats}}</p>
<p><strong>BSN:</strong> {{bsn}}</p>
<p><strong>Polisnummer:</strong> {{polisnummer}}</p>
<p><strong>Toelichting:</strong> {{bericht}}</p>

<hr>
<p><em>Deze aanmelding is verzonden via de website op {{current_date}}.</em></p>
```

4. Sla de template op en **noteer de Template ID** (bijv. `template_1234567`)

## Stap 4: Public Key Ophalen

1. Ga naar **"Account"** in je dashboard
2. Kopieer je **Public Key** (bijv. `user_1234567890abcdef`)

## Stap 5: Code Bijwerken

Vervang in `index.html` de volgende waarden:

### 1. Public Key (regel 822):
```javascript
emailjs.init("user_1234567890abcdef"); // Vervang met jouw public key
```

### 2. Service ID (regel 1242):
```javascript
await emailjs.send('service_1234567', 'template_1234567', emailData); // Vervang service ID
```

### 3. Template ID (regel 1242):
```javascript
await emailjs.send('service_1234567', 'template_1234567', emailData); // Vervang template ID
```

### 4. Ontvanger Email (regel 1228):
```javascript
to_email: 'mihriskraamzorg@hotmail.com', // Vervang indien gewenst
```

## Stap 6: Testen

1. Open de website
2. Vul het aanmeldformulier in
3. Controleer of je een email ontvangt
4. Controleer de browser console (F12) voor eventuele fouten

## Hoe het Fallback Systeem Werkt

### Niveau 1: EmailJS (Primair)
- Directe verzending via EmailJS
- Geen doorverwijzing nodig
- Snelle en betrouwbare service

### Niveau 2: PHP Service (Fallback)
- Als EmailJS faalt, wordt PHP service gebruikt
- Server-side email verzending
- Gebruikt bestaande `send-email.php`

### Niveau 3: Mailto Link (Laatste redmiddel)
- Als beide services falen
- Opent email client van gebruiker
- Voorgevulde email met alle formuliergegevens

## Voordelen van deze Implementatie

✅ **Geen doorverwijzing** - Gebruikers blijven op je website
✅ **Maximale betrouwbaarheid** - 3 fallback niveaus
✅ **Snelle verzending** - EmailJS is zeer snel
✅ **Gebruiksvriendelijk** - Geen extra stappen voor gebruikers
✅ **Kosteneffectief** - Gratis tier voldoende voor de meeste websites

## Troubleshooting

### EmailJS niet geladen
- Controleer of de CDN link correct is
- Controleer internetverbinding

### Public Key fout
- Controleer of je public key correct is ingevoerd
- Zorg dat er geen spaties zijn

### Service/Template ID fout
- Controleer of de IDs correct zijn gekopieerd
- Zorg dat de service actief is

### Geen emails ontvangen
- Controleer je spam folder
- Controleer email service instellingen
- Test met verschillende email adressen

## Monitoring

Het systeem logt automatisch:
- EmailJS success/failure
- PHP fallback usage
- Mailto link usage

Bekijk de browser console (F12) voor debugging informatie.

## Onderhoud

- Controleer maandelijks je EmailJS usage
- Test regelmatig alle 3 niveaus
- Update email adressen indien nodig

## Kosten

- **EmailJS**: Gratis (200 emails/maand)
- **PHP Service**: Gratis (server hosting)
- **Mailto**: Gratis (gebruiker's email client)

Voor meer dan 200 emails per maand, overweeg een EmailJS betaald plan.
