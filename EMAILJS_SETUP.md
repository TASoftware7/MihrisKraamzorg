# EmailJS Setup voor Backup Email Functionaliteit

## Overzicht
Dit document beschrijft hoe je EmailJS kunt configureren als backup email service voor het aanmeldformulier. Dit zorgt ervoor dat er altijd een email wordt verstuurd, zelfs als de primaire Formspree service faalt.

## Stap 1: EmailJS Account Aanmaken
1. Ga naar [EmailJS.com](https://www.emailjs.com/)
2. Maak een gratis account aan
3. Log in op je dashboard

## Stap 2: Email Service Configureren
1. Ga naar "Email Services" in je dashboard
2. Klik op "Add New Service"
3. Kies je email provider (Gmail, Outlook, etc.)
4. Volg de instructies om je email account te verbinden
5. Noteer de `Service ID` die wordt gegenereerd

## Stap 3: Email Template Maken
1. Ga naar "Email Templates" in je dashboard
2. Klik op "Create New Template"
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

<p>Deze aanmelding is verzonden via de website.</p>
```

4. Sla de template op en noteer de `Template ID`

## Stap 4: Code Bijwerken
Vervang in `index.html` de volgende waarden:

1. **EmailJS Public Key:**
   ```javascript
   emailjs.init("YOUR_PUBLIC_KEY"); // Regel 778
   ```

2. **Service ID:**
   ```javascript
   return emailjs.send('service_id', 'template_id', emailData); // Regel 800
   ```

3. **Template ID:**
   ```javascript
   return emailjs.send('service_id', 'template_id', emailData); // Regel 800
   ```

4. **Ontvanger Email:**
   ```javascript
   to_email: 'mihri@kraamzorg.nl', // Regel 789 - vervang door gewenste email
   ```

## Stap 5: Testen
1. Open de website
2. Vul het aanmeldformulier in
3. Controleer of je een email ontvangt
4. Controleer de browser console voor eventuele fouten

## Belangrijke Opmerkingen
- EmailJS heeft een gratis tier met 200 emails per maand
- Voor productie gebruik, overweeg een betaald plan
- Zorg ervoor dat je email service correct is geconfigureerd
- Test regelmatig of beide email methoden werken

## Troubleshooting
- **EmailJS niet geladen:** Controleer of de CDN link correct is
- **Public Key fout:** Controleer of je public key correct is ingevoerd
- **Service/Template ID fout:** Controleer of de IDs correct zijn gekopieerd
- **Geen emails ontvangen:** Controleer je spam folder en email service instellingen

## Alternatieven
Als EmailJS niet werkt, kun je ook overwegen:
- Een eigen backend server
- Netlify Forms
- AWS SES
- SendGrid

