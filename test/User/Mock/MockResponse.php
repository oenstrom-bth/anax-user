<?php

namespace Oenstrom\User;

// use Anax\Database\DatabaseQueryBuilder;

/**
 * A DatabaseQueryBuilder mock class
 *
 * @SuppressWarnings("unused")
 */
class MockResponse {
    public function redirect($route)
    {
        return $route;
    }
}
