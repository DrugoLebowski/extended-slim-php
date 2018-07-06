<?php

return [
    "test"      => "string||required",
    "arrayTest" => [
        "string",
        "not_regex:/abc\-cbd/",
    ],
];