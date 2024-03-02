<?php

namespace App\Http\Resources\Collections;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class to build a collection with notifications data
 */
class NotificationCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
