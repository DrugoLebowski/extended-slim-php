<?php

return [
    "test"      => "array||required",
    "test.a"    => "array||required",
    "test.a.b"  => "int||lower_equal:2",
    "arrayTest" => [
        "string",
        "regex:/abc\-cbd/",
    ],
];