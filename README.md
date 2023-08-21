# WebRouter @CafeWebCode

###### Simple component to make PHPMailler easier to use

Simple component that uses the facade pattern to abstract PHPMailler functions for sending emails. A component to facilitate and speed up your development.

## About CafeWebCodEmail

###### CafeWebCodEmail is a set of small and optimized PHP components for common tasks. Held by Cleyber F. Matos.

## Documentation


```php
<?php

require __DIR__ . "/../src/config.php";
require __DIR__ . "/../vendor/phpmailer/phpmailer/src/PHPMailer.php";
require __DIR__ . "/../vendor/phpmailer/phpmailer/src/Exception.php";
require __DIR__ . "/../vendor/phpmailer/phpmailer/src/SMTP.php";
require __DIR__ . "/../src/Mail.php";

use Cafewebcode\Cafewebcodemail\Mail;

$mail = new Mail();

$mail->bootstrap(
    "test submission " . time(),
    "<h1>Hello Word</h1><p>This is an email sending test</p>",
    "email@email.com.br",
    "recipient name"
);

if ($mail->send("frommail@mail.com.br", "from name")) {
    echo "Sent with success";
} else {
    var_dump($mail->fail());
}

```

###### Sending attachments

```php
<?php

$mail = new Mail();

$mail->bootstrap(
    "test submission " . time(),
    "<h1>Hello Word</h1><p>This is an email sending test</p>",
    "email@email.com.br",
    "recipient name"
);

$mail->attach("file path", "file Name");
$mail->attach("file path", "file Name");

$mail->send("frommail@mail.com.br", "from name");

```


## Contributing

Please see [CONTRIBUTING](https://github.com/cleyber2010/cafewebcodemail/blob/master/CONTRIBUTING.md) for details.

## Support

###### Security: If you discover any security related issues, please email cleyber.fernandes@gmail.com instead of using the issue tracker.

Thank you

## Credits

- [Cleyber F. Matos](https://github.com/cleyber2010) (Developer)
- [All Contributors](https://github.com/cleyber2010/cafewebcodemail/contributors)

## License

The MIT License (MIT). Please see [License File](https://github.com/cleyber2010/cafewebcodemail/blob/master/LICENSE) for more
information.