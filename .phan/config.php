<?php
return [
    'target_php_version' => '7.1',
    'directory_list' => [
        'src',
        'vendor',
    ],
    "exclude_analysis_directory_list" => [
        'vendor/',
    ],
    'suppress_issue_types' => [
        'PhanDeprecatedClass',
        'PhanDeprecatedFunction',
        'PhanDeprecatedInterface',
        'PhanUnreferencedUseNormal',
    ],
];
