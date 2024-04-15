<?php

namespace App\Http\GlobalClases\Notifications;

use App\Http\GlobalClases\BuildError;
use Error;
use ExponentPhpSDK\Expo;

class NotificationPush
{
    /**
     * Builds the notification body and sends it
     *
     * @param Array $data
     */
    public static function build($data)
    {
        $data = json_decode(json_encode($data));
        $expo = Expo::normalSetup();
        $notification = null;
        try {
            $channel = 'user_' . $data->target_user->external_identifier;
            $expo->subscribe($channel, $data->target_user->expo_push_token);
            switch ($data->type) {
                case 'friend-request':
                    $notification = [
                        'title' => 'Solicitud de amistad.',
                        'body' => $data->body->user_name . ' te ha enviado una solicitud de amistad. 🤝',
                        'data' => [
                            'type' => 'friend-request'
                        ]
                    ];
                break;
                case 'friend-request-accepted':
                    $notification = [
                        'title' => 'Solicitud de amistad aceptada.',
                        'body' => $data->body->user_name . ' ha aceptado tu solicitud de amistad. 🎉',
                        'data' => [
                            'type' => 'friend-request-accepted'
                        ]
                    ];
                break;
                case 'workspace-invite':
                    $notification = [
                        'title' => 'Invitación a equipo de trabajo.',
                        'body' => $data->body->user_name . ' te ha invitado a colaborar en: ' . $data->body->workspace_name . ' 💼',
                        'data' => [
                            'workspace' => $data->workspace,
                            'type' => 'workspace-invite'
                        ]
                    ];
                break;
                case 'workspace-invite-accepted':
                    $notification = [
                        'title' => 'Invitación a equipo de trabajo aceptada.',
                        'body' => $data->body->user_name . ' ha aceptado tu invitación para colaborar en: ' . $data->body->workspace_name . ' 🎉',
                        'data' => [
                            'type' => 'workspace-invite-accepted'
                        ]
                    ];
                break;
                case 'partner-finished-task':
                    $notification = [
                        'title' => 'Tarea concluida.',
                        'body' => $data->body->user_name . ' ha terminado la tarea: ' . $data->body->task . ' ✔',
                        'data' => [
                            'type' => 'partner-finished-task'
                        ]
                    ];
                break;
                case 'task-assigned':
                    $notification = [
                        'title' => 'Asignación de tarea.',
                        'body' => 'Se te ha asignado la tarea: ' . $data->body->task . ' 😎✌',
                        'data' => [
                            'type' => 'task-assigned'
                        ]
                    ];
                break;
                case 'partner-left-team':
                    $notification = [
                        'title' => 'Baja en el equipo.',
                        'body' => $data->body->user_name . 'ha salido del espacio de trabajo: ' . $data->body->workspace_name . ' 😓👋',
                        'data' => [
                            'type' => 'partner-left-team'
                        ]
                    ];
                break;
                default:
                    throw new Error('Elección no encontrada');
                break;
            }
            $expo->notify([$channel], $notification);
        } catch (\Throwable $th) {
            BuildError::saveError($th, 7);
        }
    }
}