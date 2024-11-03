<?php

namespace Exceptions;

use src\Render;

class RouteNotFoundException extends \Exception
{


    public function error(): Render 
    {
        return Render::make('quatre_cent_quatre');
    }

}