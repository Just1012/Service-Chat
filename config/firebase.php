<?php

declare(strict_types=1);

return [
    /*
     * ------------------------------------------------------------------------
     * Default Firebase project
     * ------------------------------------------------------------------------
     */

    'default' => env('FIREBASE_PROJECT', 'app'),

    /*
     * ------------------------------------------------------------------------
     * Firebase project configurations
     * ------------------------------------------------------------------------
     */

    'projects' => [
        'app' => [

            /*
             * ------------------------------------------------------------------------
             * Credentials / Service Account
             * ------------------------------------------------------------------------
             *
             * In order to access a Firebase project and its related services using a
             * server SDK, requests must be authenticated. For server-to-server
             * communication this is done with a Service Account.
             *
             * If you don't already have generated a Service Account, you can do so by
             * following the instructions from the official documentation pages at
             *
             * https://firebase.google.com/docs/admin/setup#initialize_the_sdk
             *
             * Once you have downloaded the Service Account JSON file, you can use it
             * to configure the package.
             *
             * If you don't provide credentials, the Firebase Admin SDK will try to
             * auto-discover them
             *
             * - by checking the environment variable FIREBASE_CREDENTIALS
             * - by checking the environment variable GOOGLE_APPLICATION_CREDENTIALS
             * - by trying to find Google's well known file
             * - by checking if the application is running on GCE/GCP
             *
             * If no credentials file can be found, an exception will be thrown the
             * first time you try to access a component of the Firebase Admin SDK.
             *
             */

         'credentials' => [
  "type" => "service_account",
  "project_id" =>  "cleaning-service-66ce3",
  "private_key_id" =>  "45b7ac9c78eebb467765ffacc514b120f9762efd",
  "private_key" =>  "-----BEGIN PRIVATE KEY-----\nMIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQDWXKpZlhfksj0a\nwvP73/OuTWfS8SB0zEdoMiVq0LiUA5K4vVXyJJb51f+H8tdYd/piJ4WCzn6RKCXo\nToJtkxR6CBVaC7DFXINfYfs9nc9HyfMOBoOBRqUypsWKZNK1KpvXckaD/r+luxXu\nWDJlnuMzmVwZyrr17UjE/EjE6kOHN0uZywSip5V7Z6x+XEVjryt5LvMvpmS3/uA0\n2cRHVHsnVkPHBQY69aYuCU6WLGoUyEOLnMbE2MvUAwCkvDv9xPosyGhukwmZyHq3\n9KbqZdvizqruOR7GPMibq0l45D0HzOOLmUss6Tm4gcg51l7z2Lyi2PmiGNoPszms\nG3lpylctAgMBAAECggEABGkRRpj9+NvQW6KZnoJAsA9lP91ry4gzpLZgN4H/3WiN\naXU/Aj80FAPawOAdA8CQ/qZnHgZEBS+/ex4fNN3xbk+7dyGfPqnlBUT6asDtqNtE\nDIygKNX2EPeGQCiyGFdXr+eCZ+jWTJsJNa3Lq6eVorqL2JDODY1KRMzkBzLCtoXb\nfPv33OAlSEyzL7xBKPcgpWrrSHpFc+LgmZFu0wE6V/1CSQMnz6JlQKZ899kCFj6u\nRmcjqWDX7lp7iBv5VHsOqHVZ8pyEXY6F2YMJvv0XEvOxwkdIiW9x/AZWlam5vUh2\nfpLLAMvja2Y1AFEH6IQrf6mcJ5KLYd3FmwrjIf27iQKBgQDqpRSJmouvmSRwE/wK\nf8o8xYdPJo0dXSe3BsIYOEIHZckqbZxT5DjAxbGYUeTqU99IgARNFIcsOJ6lsFOo\nDI5iZp2eqsICiWJ+Pcb/tv8D0pJiFkZBFmnKPQvvwNZtEe58kyPzftrtV+YxjIXh\nmwMZxqqFqpASoK8tjxSIEzp3iwKBgQDp3wVMn3WhmoA9KxIRWKNkdcTSPy2RhSdD\nXxGZJGbfDwLonnhpgzNZUvnrlw93Y8++xQFDSsO+ScB+nGjphLHbrp+V51hSiUfz\nNKzE0COMMIRLWtOTNArYWPEGLsSkVIeklykGgASJawG69Cl9IRQOurVcRsLE7O+k\nrYbfGOKDJwKBgASRikDTnXyhwq/b88BQlKNyRRwpZ/32XluV6hmGnuJ9/NiyoaSQ\ngPpf3wFUNtzJHUPQGkVV7PvTbmNTd42CEROhY9g/AuABxMUodsNr0LNGWktGm7+Q\nrCaf4aedXY9qFfae9sg65BBS8cxtK/4kgn7x+0f29i8mqcJ9Uq0DktPZAoGAXsqB\nOFxNblHT9nb1nMhDeZ1uSBVJX/kLP/hRhrPFalWIRUat4X5HGsZR+9Y/c5GmC1mI\nOIEeM4trFSZKM5QQDs2Ja1XYa6Ou4PmRqTf/oHuts2k95iUq3CO4lVvxYfXNAL4v\n562NqTERA3ihNFFq8slkZuFbYjvyqdmXl+dbL/MCgYBkG4bt3Z3Aeu39h5rVCkN5\nfapW/C2xpanr4SgOQsr51xHeqRBKgoja1+tRm5UCHeFUMtRSI2394Cp/xCf+/oD8\n6Zeof2yoFFTpPdGXONoyodXkrnoAf5YnO7ZsLSy+VaWWcugT/9T4UcP5Xqu909Lr\n000x+Fo52r1bJmX5o0Z3yA==\n-----END PRIVATE KEY-----\n",
  "client_email" =>  "firebase-adminsdk-76vb7@cleaning-service-66ce3.iam.gserviceaccount.com",
  "client_id" => "104965567632562362093",
  "auth_uri" =>  "https://accounts.google.com/o/oauth2/auth",
  "token_uri" =>  "https://oauth2.googleapis.com/token",
  "auth_provider_x509_cert_url" =>  "https://www.googleapis.com/oauth2/v1/certs",
  "client_x509_cert_url" =>  "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-76vb7%40cleaning-service-66ce3.iam.gserviceaccount.com",
  "universe_domain" => "googleapis.com"
],

            /*
             * ------------------------------------------------------------------------
             * Firebase Auth Component
             * ------------------------------------------------------------------------
             */

            'auth' => [
                'tenant_id' => env('FIREBASE_AUTH_TENANT_ID'),
            ],

            /*
             * ------------------------------------------------------------------------
             * Firestore Component
             * ------------------------------------------------------------------------
             */

            'firestore' => [

                /*
                 * If you want to access a Firestore database other than the default database,
                 * enter its name here.
                 *
                 * By default, the Firestore client will connect to the `(default)` database.
                 *
                 * https://firebase.google.com/docs/firestore/manage-databases
                 */

                // 'database' => env('FIREBASE_FIRESTORE_DATABASE'),
            ],

            /*
             * ------------------------------------------------------------------------
             * Firebase Realtime Database
             * ------------------------------------------------------------------------
             */

            'database' => [

                /*
                 * In most of the cases the project ID defined in the credentials file
                 * determines the URL of your project's Realtime Database. If the
                 * connection to the Realtime Database fails, you can override
                 * its URL with the value you see at
                 *
                 * https://console.firebase.google.com/u/1/project/_/database
                 *
                 * Please make sure that you use a full URL like, for example,
                 * https://my-project-id.firebaseio.com
                 */

                'url' => env('FIREBASE_DATABASE_URL'),

                /*
                 * As a best practice, a service should have access to only the resources it needs.
                 * To get more fine-grained control over the resources a Firebase app instance can access,
                 * use a unique identifier in your Security Rules to represent your service.
                 *
                 * https://firebase.google.com/docs/database/admin/start#authenticate-with-limited-privileges
                 */

                // 'auth_variable_override' => [
                //     'uid' => 'my-service-worker'
                // ],

            ],

            'dynamic_links' => [

                /*
                 * Dynamic links can be built with any URL prefix registered on
                 *
                 * https://console.firebase.google.com/u/1/project/_/durablelinks/links/
                 *
                 * You can define one of those domains as the default for new Dynamic
                 * Links created within your project.
                 *
                 * The value must be a valid domain, for example,
                 * https://example.page.link
                 */

                'default_domain' => env('FIREBASE_DYNAMIC_LINKS_DEFAULT_DOMAIN'),
            ],

            /*
             * ------------------------------------------------------------------------
             * Firebase Cloud Storage
             * ------------------------------------------------------------------------
             */

            'storage' => [

                /*
                 * Your project's default storage bucket usually uses the project ID
                 * as its name. If you have multiple storage buckets and want to
                 * use another one as the default for your application, you can
                 * override it here.
                 */

                'default_bucket' => env('FIREBASE_STORAGE_DEFAULT_BUCKET'),

            ],

            /*
             * ------------------------------------------------------------------------
             * Caching
             * ------------------------------------------------------------------------
             *
             * The Firebase Admin SDK can cache some data returned from the Firebase
             * API, for example Google's public keys used to verify ID tokens.
             *
             */

            'cache_store' => env('FIREBASE_CACHE_STORE', 'file'),

            /*
             * ------------------------------------------------------------------------
             * Logging
             * ------------------------------------------------------------------------
             *
             * Enable logging of HTTP interaction for insights and/or debugging.
             *
             * Log channels are defined in config/logging.php
             *
             * Successful HTTP messages are logged with the log level 'info'.
             * Failed HTTP messages are logged with the log level 'notice'.
             *
             * Note: Using the same channel for simple and debug logs will result in
             * two entries per request and response.
             */

            'logging' => [
                'http_log_channel' => env('FIREBASE_HTTP_LOG_CHANNEL'),
                'http_debug_log_channel' => env('FIREBASE_HTTP_DEBUG_LOG_CHANNEL'),
            ],

            /*
             * ------------------------------------------------------------------------
             * HTTP Client Options
             * ------------------------------------------------------------------------
             *
             * Behavior of the HTTP Client performing the API requests
             */

            'http_client_options' => [

                /*
                 * Use a proxy that all API requests should be passed through.
                 * (default: none)
                 */

                'proxy' => env('FIREBASE_HTTP_CLIENT_PROXY'),

                /*
                 * Set the maximum amount of seconds (float) that can pass before
                 * a request is considered timed out
                 *
                 * The default time out can be reviewed at
                 * https://github.com/kreait/firebase-php/blob/6.x/src/Firebase/Http/HttpClientOptions.php
                 */

                'timeout' => env('FIREBASE_HTTP_CLIENT_TIMEOUT'),

                'guzzle_middlewares' => [],
            ],
        ],
    ],
];
