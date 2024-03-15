<?php

namespace App\Http\Controllers;

use App\Http\GlobalClases\BuildError;
use App\Http\Requests\Store\NotificationStoreRequest;
use App\Http\Requests\Update\NotificationUpdateRequest;
use App\Http\Resources\Collections\NotificationCollection;
use App\Http\Resources\Resources\NotificationResource;
use App\Models\Notification;
use Error;
use ExponentPhpSDK\Expo;

/**
 * Controller class to Notifications
 */
class NotificationController extends Controller
{
    /**
     * Builds the notification body and sends it
     *
     * @param Array $data
     */
    public function buildNotification($data)
    {
        $data = json_decode(json_encode($data));
        try {
            $notification = null;
            switch ($data->type) {
                case 'friend-request':
                    $notification = [
                        'title' => 'Solicitud de amistad.',
                        'body' => $data->body->user_name . ' te ha enviado una solicitud de amistad. 🤝'
                    ];
                break;
                case 'friend-request-accepted':
                    $notification = [
                        'title' => 'Solicitud de amistad aceptada.',
                        'body' => $data->body->user_name . ' ha aceptado tu solicitud de amistad. 🎉'
                    ];
                break;
                case 'workspace-invite':
                    $notification = [
                        'title' => 'Solicitud de amistad aceptada.',
                        'body' => $data->body->user_name . ' te ha invitado a colaborar en: ' . $data->body->workspace_name
                    ];
                break;
                case 'workspace-invite-accepted':
                    $notification = [
                        'title' => 'Solicitud de amistad aceptada.',
                        'body' => $data->body->user_name . ' ha aceptado tu invitación para colaborar en: ' . $data->body->workspace_name
                    ];
                break;
                case 'partner-finished-task':
                    $notification = [
                        'title' => 'Solicitud de amistad aceptada.',
                        'body' => $data->body->user_name . ' ha terminado la tarea: ' . $data->body->task
                    ];
                break;
                case 'task-assigned':
                    $notification = [
                        'title' => 'Solicitud de amistad aceptada.',
                        'body' => 'Se te ha asignado la tarea: ' . $data->body->task
                    ];
                break;
                case 'partner-left-team':
                    $notification = [
                        'title' => 'Solicitud de amistad aceptada.',
                        'body' => $data->body->user_name . 'ha salido del espacio de trabajo: ' . $data->body->workspace_name
                    ];
                break;
                default:
                    throw new Error('Elección no encontrada');
                break;
            }
            $expo = \ExponentPhpSDK\Expo::normalSetup();
            $expo->notify(['general'], $notification);
        } catch (\Throwable $th) {
            BuildError::saveError($th, 7);
        }
    }
}
