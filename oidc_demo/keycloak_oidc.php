<?php

/**
 *
 * Copyright MITRE 2012
 *
 * OpenIDConnectClient for PHP5
 * Author: Michael Jett <mjett@mitre.org>
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 *
 */

require __DIR__ . '/../vendor/autoload.php';

use Jumbojett\OpenIDConnectClient;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$oidc = new OpenIDConnectClient(
    $_ENV['KEYCLOAK_PROVIDER_URL'],
    $_ENV['KEYCLOAK_CLIENT_ID']
);

$oidc->addScope(['email']);

$oidc->setRedirectURL($_ENV['REDIRECT_BASE_URI'] . 'keycloak_oidc.php');
$oidc->setVerifyHost(false);
$oidc->setVerifyPeer(false);

$oidc->authenticate();
$email = $oidc->requestUserInfo('email');

?>

<html>
<head>
    <title>Example OpenID Connect Client Use</title>
    <style>
        body {
            font-family: 'Lucida Grande', Verdana, Arial, sans-serif;
        }
    </style>
</head>
<body>

<div>
    Email: <?php echo $email; ?>
</div>

</body>
</html>
