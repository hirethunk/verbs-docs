<?php

Application::saving(function($app) {
    if ($app->approved_at) {
        $app->status = 'approved';
        $app->rejected_at = null;
    } elseif ($app->rejected_at) {
        $app->status = 'rejected';
    } elseif ($app->on_hold_at) {
        $app->status = 'on-hold';
        $app->rejected_at = null;
        $app->approved_at = null;
    } else {
        $app->rejected_at = null;
        $app->approved_at = null;
        $app->on_hold_at = null;
        $app->status = 'applied';
        
        if (! $app->applied_at) {
            $app->applied_at = now();
        }
    }
});
