<?php

namespace App\Http\Controllers\Concerns;

use App\Models\ActivityLog;

trait LogsActivity
{
    protected function logActivity(string $action, string $entityType, ?int $entityId, string $description, array $data = []): void
    {
        $userId = auth()->id();
        if (!$userId) {
            return;
        }

        ActivityLog::create([
            'user_id' => $userId,
            'action' => $action,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'description' => $description,
            'data' => $data ?: null,
        ]);
    }
}
