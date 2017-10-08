<?php

namespace Oenstrom\User;

/**
 * A Response mock class
 *
 * @SuppressWarnings("unused")
 */
class MockResponse
{
    public function redirect($route)
    {
        return $route;
    }
}
