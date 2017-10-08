<?php

namespace Oenstrom\User;

/**
 * A PageRender mock class
 *
 * @SuppressWarnings("unused")
 */
class MockPageRender
{
    public function renderPage($data, $status = 200)
    {
        return true;
    }
}
