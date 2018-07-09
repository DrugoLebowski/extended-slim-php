<?php

return [
    "test" => [
        "string",
        "required",
        function ($content) {
            return $content === "ddd";
        },
    ],
    "file" => [
        "file",
        new \App\Components\Validation\Rules\MediaType("image/png"),
        "media_max_size:0"
    ],
];