<?php

declare(strict_types=1);

header(
    "Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self'; object-src 'none'; base-uri 'self';"
);