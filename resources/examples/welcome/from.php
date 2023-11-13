<?php

// Keep "status" column and associated timestamps in sync
Application::saving(function($app) {
    if (! $app->isDirty('status')) {
        return;
    }
    
    if ($app->status === 'approved') {
        $app->approved_at = now();
        $app->rejected_at = null;
        $app->on_hold_at = null;
    }
    
    if ($app->status === 'rejected') {
        $app->rejected_at = now();
        $app->approved_at = null;
        $app->on_hold_at = null;
    }
    
    if ($app->status === 'on-hold') {
        $app->on_hold_at = now();
        $app->approved_at = null;
        $app->rejected_at = null;
    }
    
    if ($app->status === 'applied') {
        $app->applied_at ??= now();
        $app->approved_at = null;
        $app->rejected_at = null;
        $app->on_hold_at = null;
    }
});
