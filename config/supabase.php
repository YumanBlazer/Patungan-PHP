<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Supabase Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for Supabase integration
    |
    */

    'url' => env('SUPABASE_URL'),
    'anon_key' => env('SUPABASE_ANON_KEY'),
    'service_key' => env('SUPABASE_SERVICE_KEY'),
    
    /*
    |--------------------------------------------------------------------------
    | Database Configuration
    |--------------------------------------------------------------------------
    */
    'database' => [
        'host' => env('SUPABASE_DB_HOST'),
        'port' => env('SUPABASE_DB_PORT', '5432'),
        'database' => env('SUPABASE_DB_NAME', 'postgres'),
        'username' => env('SUPABASE_DB_USER', 'postgres'),
        'password' => env('SUPABASE_DB_PASSWORD'),
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Storage Configuration
    |--------------------------------------------------------------------------
    */
    'storage' => [
        'bucket' => env('SUPABASE_STORAGE_BUCKET', 'receipts'),
        'max_file_size' => 10 * 1024 * 1024, // 10MB
        'allowed_types' => ['jpg', 'jpeg', 'png', 'pdf'],
    ],
    
    /*
    |--------------------------------------------------------------------------
    | AI Services Configuration
    |--------------------------------------------------------------------------
    */
    'ai' => [
        'google_ai_key' => env('GOOGLE_AI_API_KEY'),
        'openai_key' => env('OPENAI_API_KEY'),
        'enabled' => env('AI_FEATURES_ENABLED', true),
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Authentication Configuration
    |--------------------------------------------------------------------------
    */
    'auth' => [
        'enable_email_confirmation' => env('SUPABASE_EMAIL_CONFIRMATION', true),
        'enable_phone_confirmation' => env('SUPABASE_PHONE_CONFIRMATION', false),
        'session_timeout' => env('SESSION_LIFETIME', 120),
    ],
];
