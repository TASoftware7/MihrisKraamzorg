# 🌸 Mihri's Kraamzorg Website

Een professionele website voor Mihri's Kraamzorg, gebouwd met moderne webtechnieken en optimaal voor gebruikerservaring.

## 🚀 Features

- **Responsive Design** - Werkt perfect op alle apparaten
- **Direct Aanmelden** - Eenvoudig aanmeldformulier voor kraamzorg
- **Privacy Policy** - Volledige GDPR-compliant privacy informatie
- **Performance Geoptimaliseerd** - Snelle laadtijden en optimale Core Web Vitals
- **Toegankelijk** - Voldoet aan WCAG richtlijnen

## 🛠️ Technische Stack

- **HTML5** - Semantische markup
- **CSS3** - Moderne styling met CSS variabelen
- **Vanilla JavaScript** - Geen externe dependencies
- **GitHub Actions** - Automatische CI/CD pipeline
- **Lighthouse CI** - Performance monitoring

## 📁 Project Structuur

```
MihrisKraamzorg/
├── .github/
│   ├── workflows/
│   │   └── ci-cd.yml          # CI/CD pipeline
│   └── ISSUE_TEMPLATE/        # Issue templates
├── mihris-kraamzorg-layout-pro-always-send-welcome-fixed-icons-ig-clean.html
├── privacy-policy.html         # Privacy policy pagina
├── .lighthouserc.json         # Lighthouse CI configuratie
└── README.md                  # Deze documentatie
```

## 🔄 Development Workflow

### Branch Strategy
```
main (production)
├── development (hoofdbranch)
└── feature/* (feature branches)
```

### Workflow Stappen
1. **Feature Development**
   ```bash
   git checkout development
   git checkout -b feature/nieuwe-functionaliteit
   # Ontwikkel en test
   git commit -m "Add new feature"
   git push origin feature/nieuwe-functionaliteit
   ```

2. **Pull Request**
   - Maak PR van feature branch naar development
   - Gebruik de PR template
   - Wacht op code review en goedkeuring

3. **Development Deployment**
   - Na merge naar development wordt automatisch gedeployed
   - CI/CD pipeline voert alle tests uit

4. **Production Release**
   - Maak PR van development naar main
   - Na goedkeuring wordt automatisch gedeployed naar productie

## 🧪 Testing & Quality

### Automatische Tests
- **HTML Validation** - W3C HTML validator
- **CSS Validation** - Stylelint checks
- **Accessibility** - Pa11y accessibility testing
- **Performance** - Lighthouse CI performance monitoring
- **Security** - Trivy vulnerability scanning
- **Link Checking** - Broken link detection

### Performance Metrics
- **First Contentful Paint** < 2s
- **Largest Contentful Paint** < 4s
- **Cumulative Layout Shift** < 0.1
- **Total Blocking Time** < 300ms

## 🚀 Deployment

### Development Environment
- Automatisch na push naar `development` branch
- HTML minificatie en optimalisatie
- Artifact upload voor 30 dagen

### Production Environment
- Automatisch na merge naar `main` branch
- Volledige optimalisatie inclusief critical CSS
- Artifact upload voor 90 dagen
- Performance monitoring en validatie

## 🔧 Lokale Ontwikkeling

### Vereisten
- Python 3.x (voor lokale server)
- Node.js 18+ (voor tools)

### Setup
```bash
# Clone repository
git clone https://github.com/TASoftware7/MihrisKraamzorg.git
cd MihrisKraamzorg

# Start lokale server
python3 -m http.server 3000

# Open in browser
open http://localhost:3000/mihris-kraamzorg-layout-pro-always-send-welcome-fixed-icons-ig-clean.html
```

### Development Tools
```bash
# HTML validatie
npm install -g html-validate
html-validate *.html

# Performance testing
npm install -g @lhci/cli
lhci autorun
```

## 📋 Issue Management

### Bug Reports
- Gebruik de bug report template
- Voeg screenshots en console logs toe
- Specificeer browser en OS

### Feature Requests
- Gebruik de feature request template
- Beschrijf het probleem en de gewenste oplossing
- Voeg mockups toe indien mogelijk

## 🔒 Privacy & Compliance

- **GDPR Compliant** - Volledige privacy policy
- **Cookie Management** - Transparante cookie handling
- **Data Protection** - Veilige verwerking van persoonlijke gegevens
- **User Rights** - Duidelijke uitleg van gebruikersrechten

## 📞 Contact

Voor vragen over de website of privacy:
- **E-mail:** info@mihri-kraamzorg.nl
- **Telefoon:** +31612345678

## 📄 Licentie

Dit project is eigendom van Mihri's Kraamzorg. Alle rechten voorbehouden.

---

## 🆘 Troubleshooting

### Veelvoorkomende Problemen

**Website laadt niet lokaal**
```bash
# Controleer of poort 3000 vrij is
lsof -i :3000
# Of gebruik een andere poort
python3 -m http.server 8000
```

**GitHub Actions falen**
- Controleer de workflow logs
- Zorg dat alle secrets correct zijn ingesteld
- Verifieer dat Node.js versie 18+ wordt gebruikt

**Performance issues**
- Gebruik Lighthouse CI voor lokale testing
- Controleer Core Web Vitals
- Optimaliseer afbeeldingen en CSS

Voor meer hulp, raadpleeg de GitHub Issues of neem contact op met het development team.
