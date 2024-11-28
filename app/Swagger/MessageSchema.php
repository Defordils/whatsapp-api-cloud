<?php

namespace App\Swagger;

/**
 * @OA\Schema(
 *     schema="Message",
 *     required={"id", "chatroom_id", "user_id", "message", "created_at", "updated_at"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="chatroom_id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="message", type="string", example="Hello World"),
 *     @OA\Property(property="attachment_path", type="string", example="path/to/attachment.jpg"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-01T12:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-01T12:00:00Z")
 * )
 */
class MessageSchema
{
    // This class is a placeholder to hold the OpenAPI schema for Message.
}
