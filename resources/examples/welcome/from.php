<?php

Application::saving(function($app) {
    // Handle "approved" status
    if ($app->isDirty('approved_at') && $app->approved_at) {
        $app->status = 'approved';
        $app->rejected_at = null;
        $app->on_hold_at = null;
    }

    // Handle "rejected" status
    if ($app->isDirty('rejected_at') && $app->rejected_at) {
        $app->status = 'rejected';
        $app->approved_at = null;
        $app->on_hold_at = null;
    }

    // Handle "on hold" status
    if ($app->isDirty('on_hold_at') && $app->on_hold_at) {
        $app->status = 'on hold';
        $app->approved_at = null;
        $app->rejected_at = null;
    }
    
    // Handle initial state, or getting reset back to "applied"
    if (
        $app->isDirty('applied_at')
        || (! $app->on_hold_at && ! $app->rejected_at && ! $app->approved_at)
    ) {
        $app->rejected_at = null;
        $app->approved_at = null;
        $app->on_hold_at = null;
        $app->status = 'applied';

        if (! $app->applied_at) {
            $app->applied_at = now();
        }
    }
});
