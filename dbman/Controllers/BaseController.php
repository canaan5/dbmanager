<?php
/**
 * This file is part of Proteux technologies Ltd (ChambersLegal)
 *
 * BaseController
 * @package
 * Date: 11/24/16
 */

namespace CANAAN;


class BaseController
{
    public function view($file, $data = [])
    {
        return include $file;
    }
}