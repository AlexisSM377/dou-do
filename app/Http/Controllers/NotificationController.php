<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store\NotificationStoreRequest;
use App\Http\Requests\Update\NotificationUpdateRequest;
use App\Http\Resources\Collections\NotificationCollection;
use App\Http\Resources\Resources\NotificationResource;
use App\Models\Notification;

/**
 * Controller class to Notifications
 */
class NotificationController extends Controller
{
    /**
     * Returns a general list from notifications
     *
     * @return JsonResponse<Notifications>
     */
    public function index()
    {
        $notifications = Notification::paginate(20);
        return new NotificationCollection($notifications);
    }

    /**
     * Save in database a new notification and returns it
     *
     * @param NotificationStoreRequest $request
     * @return JsonResponse<Notification>
     */
    public function store(NotificationStoreRequest $request)
    {
        return new NotificationResource(Notification::create($request->all()));
    }

    /**
     * Gets from database a notification and returns it
     *
     * @param Notification $notification
     * @return JsonResponse<Notification>
     */
    public function show(Notification $notification)
    {
        return new NotificationResource($notification);
    }

    /**
     * Updates a notification and returns it
     *
     * @param NotificationUpdateRequest $request
     * @param Notification $notification
     * @return JsonResponse<Notification>
     */
    public function update(NotificationUpdateRequest $request, Notification $notification)
    {
        $notification->update($request->all());
        return new NotificationResource($notification);
    }
}
