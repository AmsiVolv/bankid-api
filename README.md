# BankID API for UA.

## Requirements
You need to download and install PHP extension [EUSPHPE](https://iit.com.ua/download/EUSPHPE-20211206.zip). Instalation manual is located in

- root
    - EUSPHPE
        - EUSignPHPDescription.doc

### Short manual for PHP-FPM (PHP v. 8.0)
1. Create a directory - **/usr/lib/php/8.0/eusphpe_extension**
2. Unpack [downloaded archive](https://iit.com.ua/download/EUSPHPE-20211206.zip) to **/usr/lib/php/8.0/eusphpe_extension** directory | *Pick only needed file (archive/Modules/Linux/64/eusphpei.64.8.0.3.tar)*
3. Add to **/usr/lib/systemd/system/php8.0-fpm.service**  this line of code \
**`export LD_LIBRARY_PATH=/usr/lib/php/8.0/eusphpe_extension`**
4. Create a new file  **/etc/php/8.0/fpm/conf.d/eusphpe.ini**, to this file add \
   **`extension=/usr/lib/php/8.0/eusphpe_extension/eusphpe.so`**
5. Create a new directory for certificates (for example */data/certificates*)
6. Open **`  /usr/lib/php/8.0/eusphpe_extension/osplm.ini`**	and  edit **Path** parameter  (for example */data/certificates (directory from previous step)*).
7. Open certificate directory (for example */data/certificates*) and unpack [this archive](https://drive.google.com/file/d/1vkN_RdXapHp0n0gHU52v6i6yN90c01f5/view?usp=sharing) inside it.
8.Restart FPM **`service php8.0-fpm restart`**

### Optional:
Install [EUSPHPE stubs](https://github.com/andrew-svirin/phpstorm-stubs) for IDE

### Second step: 
`composer require amsi/bankid-api`

## Usage example
Example file is **authenticate.php**.
Create a new BankIdProvider

    $bankIdProvider = new BankID(  
      new Client(  
	     CLIENT_ID,       // -> Client ID reciveved from NBU  
	     CLIENT_SECRET,  // -> Client SECRET reciveved from NBU
	     REDIRECT_URL,  // -> Redirect URL, defiened for NBU 
	     $cert,        // -> file_get_contents('certificate.cer')
	     $key,        // -> file_get_contents('key.day')
	     CERT_PASS,  // -> Certificate password 
      new Config(Config::ENV_TEST) // -> For prod end -> new Config
     ));

1. Obtain authorization code

```
if (!isset($_GET['code'])) {
    $authUrl = $bankIdProvider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $bankIdProvider->getState();
    header(sprintf('Location: %s', $authUrl));
    exit;
}
```
2. Obtain access token 
```
$token = $bankIdProvider->getAccessToken('authorization_code', [
    'code' => $_GET['code']
]);
```
3. Obtain user data 
```
    /** @var ExpandedResourceOwnerInterface $user */ -> anotation is used to beeter code orientation
    $user = $bankIdProvider->getResourceOwner($token);
```
