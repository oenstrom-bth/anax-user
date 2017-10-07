<?php

namespace Oenstrom\User;

// use Anax\Database\DatabaseQueryBuilder;

/**
 * A DatabaseQueryBuilder mock class
 *
 * @SuppressWarnings("unused")
 */
class MockPageRender {
    public function renderPage($data, $status = 200)
    {
        return true;
    }
}
