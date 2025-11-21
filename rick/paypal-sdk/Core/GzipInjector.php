<?php

namespace Rick\PayPal\Core;

use Rick\PayPal\PayPalHttp\Injector;

class GzipInjector implements Injector
{
    public function inject($httpRequest)
    {
        $httpRequest->headers["Accept-Encoding"] = "gzip";
    }
}
