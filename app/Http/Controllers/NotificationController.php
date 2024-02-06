<?php

namespace App\Http\Controllers;

use App\Http\Requests\store\NotificationBulkRequest;
use App\Http\Requests\Store\NotificationStoreRequest;
use App\Http\Requests\Update\NotificationUpdateRequest;
use App\Http\Resources\Collections\NotificationCollection;
use App\Http\Resources\Resources\NotificationResource;
use App\Models\Notification;
use Illuminate\Support\Arr;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::paginate(20);
        return new NotificationCollection($notifications);
    }

    public function store(NotificationStoreRequest $request)
    {
        return new NotificationResource(Notification::create($request->all()));
    }

    public function bulk(NotificationBulkRequest $request)
    {
        $bulk = collect($request->all())->map(function($array, $key){
            return Arr::except($array, ['user_id']);
        });
        dd($bulk);
    }

    public function show(Notification $notification)
    {
        return new NotificationResource($notification);
    }

    public function update(NotificationUpdateRequest $request, Notification $notification)
    {
        $notification->update($request->all());
        return new NotificationResource($notification);
    }
}
