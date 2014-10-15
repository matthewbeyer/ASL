<?php

return [
    'base_url' => route('sociallogincallback'),
    'providers' => [
        "Twitter" => [
            "enabled" => true,
            "keys" => [
                'key'    => '765pAwduopTzDeJ26ieVvDRjg',
                'secret' => '9IIEzv8LMpRn1jGSAWZeuoQ4KJMu5igde6FmHHltRpCQxisSKJ'
            ]
        ],
        "Google" => [
            "enabled" => true,
            "keys" => [
                "id" => "22221413262-0jhe9l9k771cuun8qvmnko8fflbqm9t7.apps.googleusercontent.com",
                "secret" => "dREKV9-SpITRzq3Ys8fVimUn"
            ],
            "scope" => "https://www.googleapis.com/auth/userinfo.profile ".
                       "https://www.googleapis.com/auth/userinfo.email",
        ],
        "Facebook" => [
            "enabled" => true,
            "keys" => [
                'id'     => '783560558354464',
                'secret' => 'b7988b80385498703d7472c0e5c851ff'
            ],
        ]
    ]
];