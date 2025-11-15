<?php
// Block IP script - Blocks bots, VPNs and restricts by country

// Configuration
$log_file = 'catched.txt';  // File to save blocked IPs
$allowed_countries = ['all'];   // Use 'all' for all countries or specific codes like ['us', 'de', 'es']
$block_proxy_vpn = true;        // Block proxy and VPN connections
$block_tor = true;              // Block Tor exit nodes
$block_bots = true;             // Block known bot networks

// Initialize block status
$is_blocked = false;
$block_reason = '';

// Function to log blocked IPs
function log_blocked_ip($ip, $reason) {
    global $log_file;
    $date = date('Y-m-d H:i:s');
    $log_entry = "$date | $ip | $reason\n";
    file_put_contents($log_file, $log_entry, FILE_APPEND);
}

// Get visitor's IP address
$ip = $_SERVER['REMOTE_ADDR'];
if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && filter_var($_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}

// Check country restriction
if ($allowed_countries[0] !== 'all') {
    // Get country code using ip-api.com (free API)
    $response = @file_get_contents("http://ip-api.com/json/$ip?fields=countryCode");
    if ($response) {
        $data = json_decode($response, true);
        if (isset($data['countryCode'])) {
            $visitor_country = strtolower($data['countryCode']);
            
            // Block if visitor's country is NOT in the allowed list
            if (!in_array($visitor_country, array_map('strtolower', $allowed_countries))) {
                $is_blocked = true;
                $block_reason = "Country not allowed: " . strtoupper($visitor_country);
            }
        }
    } else {
        // If country detection fails, log this but don't block
        error_log("Country detection failed for IP: $ip");
    }
}

// Block known bot networks
if ($block_bots && !$is_blocked) {
    // Define network ranges to block (from the provided list)
    $blocked_networks = [
        // Security Scanners & Vulnerability Bots
        '5.39.218.0/24', '5.196.77.0/24',  // Acunetix Scanner
        '64.39.96.0/20', '64.39.104.0/24', // Qualys Vulnerability Scanner
        '40.82.0.0/16', '23.97.177.0/24',  // Nessus/Tenable Scanner
        '97.74.127.0/24', '66.248.200.0/24', // Sucuri Security Scanner
        
        // Web Scrapers & Monitoring
        '54.36.148.0/24', '54.36.149.0/24', // Ahrefs Bot
        '46.229.168.0/24', '185.191.171.0/24', // Semrush Bot
        '69.162.124.0/24', '216.144.250.0/24', // Uptime Robot
        '5.172.196.188/32', '52.48.244.35/32', '151.106.52.0/24', // Pingdom
        '103.194.112.70/32', '178.255.152.2/32', '104.131.247.151/32', // StatusCake
        
        // Search Engine Bots - Uncomment if you want to block search engines
        '66.249.64.0/19', '64.233.160.0/19', // Googlebot
        '157.55.39.0/24', '207.46.13.0/24', '40.77.167.0/24', // Bingbot/MSNBot
        '180.76.15.0/24', '123.125.71.0/24', // Baiduspider
        '95.108.129.0/24', '95.108.213.0/24', // YandexBot
        
        // Suspicious/Security Threat Bots
        '89.234.157.0/24', // Known Malicious Crawlers
        '185.220.101.0/24', // Tor exit nodes
        '134.209.0.0/16', // Common VPS abuse
        '104.227.22.0/24', '193.56.29.0/24', '193.27.228.0/24' // Common Spam Sources
    ];
    
    foreach ($blocked_networks as $network) {
        if (cidr_match($ip, $network)) {
            $is_blocked = true;
            $block_reason = "Known bot network: $network";
            break;
        }
    }
}

// Check for VPN/Proxy
if ($block_proxy_vpn && !$is_blocked) {
    // Check using proxycheck.io API without API key
    $response = @file_get_contents("https://proxycheck.io/v2/$ip?vpn=1&asn=1");
    
    if ($response) {
        $data = json_decode($response, true);
        if (isset($data[$ip]['proxy']) && $data[$ip]['proxy'] == 'yes') {
            $is_blocked = true;
            $proxy_type = isset($data[$ip]['type']) ? $data[$ip]['type'] : 'Unknown';
            $provider = isset($data[$ip]['provider']) ? $data[$ip]['provider'] : 'Unknown';
            $block_reason = "VPN/Proxy detected: $proxy_type ($provider)";
        }
    }
}

// Detect common bot user agents
if ($block_bots && !$is_blocked) {
    $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    $bot_signatures = [
        'bot', 'spider', 'crawl', 'scan', 'wget', 'curl', 'zgrab', 'semrush',
        'lighthouse', 'slurp', 'facebook', 'woorank', 'ahrefs', 'screaming',
        'censys', 'masscan', 'nessus', 'nmap'
    ];
    
    foreach ($bot_signatures as $signature) {
        if (stripos($user_agent, $signature) !== false) {
            $is_blocked = true;
            $block_reason = "Bot signature in user agent: $signature";
            break;
        }
    }
}

// Function to check if an IP is in a CIDR range
function cidr_match($ip, $cidr) {
    list($subnet, $mask) = explode('/', $cidr);
    
    if (strpos($ip, ':') !== false && strpos($subnet, ':') !== false) {
        // IPv6 - basic implementation
        return $ip == $subnet; // Simple exact match for IPv6
    } else {
        // IPv4
        $ip_long = ip2long($ip);
        $subnet_long = ip2long($subnet);
        
        if ($ip_long === false || $subnet_long === false) {
            return false;
        }
        
        $mask = $mask === '' ? 32 : $mask;
        $mask_bits = 0xffffffff << (32 - $mask);
        
        return ($ip_long & $mask_bits) === ($subnet_long & $mask_bits);
    }
}

// Block the request if necessary
if ($is_blocked) {
    // Log the blocked IP
    log_blocked_ip($ip, $block_reason);
    
    // Return 404 Not Found
    header('HTTP/1.1 404 Not Found');
    header('Cache-Control: no-cache, no-store, must-revalidate');
    
    // Display a simple 404 Not Found message
    echo '<html><head><title>404 Not Found</title></head><body><h1>Not Found</h1><p>The requested URL was not found on this server.</p></body></html>';
    
    exit;
}

// If we get here, the user is allowed to continue
// You can include this file at the beginning of all pages with:
// require_once 'blockip.php';
?>