<?php
declare(strict_types=1);

use Amsi\Libs\BankId\Client;
use Amsi\Libs\BankId\Config;
use Amsi\Libs\BankId\Provider\BankID;
use Amsi\Libs\BankId\Provider\ExpandedResourceOwnerInterface;

require __DIR__ . '/../vendor/autoload.php';

session_start();

const CLIENT_ID = '';
const CLIENT_SECRET = '';
const REDIRECT_URL = '';

const CERT_PASS = '';

$cert = file_get_contents('./test_keys/EU-5B63D88375D92018040000002E3D0000B2950000.cer');
$key = file_get_contents('./test_keys/Key-6.dat');

try{
    $bankIdProvider = new BankID(
        new Client(
            CLIENT_ID,
            CLIENT_SECRET,
            REDIRECT_URL,
            $cert,
            $key,
            CERT_PASS,
            new Config(Config::ENV_TEST)
        )
    );
} catch (Throwable $e) {
    var_dump($e);
    die;
}
//http://bankid-api/examples/authenticate.php?code=af051986c3ff4515d293402bb65f443042a0304f&state=3afa65642a4f41705ba353e60ec5853b
if (!isset($_GET['code'])) {
    $authUrl = $bankIdProvider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $bankIdProvider->getState();
    header(sprintf('Location: %s', $authUrl));
    exit;
}

if (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
    unset($_SESSION['oauth2state']);
    exit('Invalid state');
}

// Try to get an access token (using the authorization code grant)
$token = $bankIdProvider->getAccessToken('authorization_code', [
    'code' => $_GET['code']
]);

// Optional: Now you have a token you can look up a users profile data
try {
    // We got an access token, let's now get the user's details
    /** @var ExpandedResourceOwnerInterface $user */
    $user = $bankIdProvider->getResourceOwner($token);

    foreach ($user->getScansData() as $scanData) {
        print_r($scanData->getScanFile());
    }

    die;
} catch (Exception $e) {
    var_dump($e->getMessage());
    var_dump($e->getTrace());
    // Failed to get user details
    exit('Oh dear...');
}
