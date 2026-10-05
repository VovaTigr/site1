<?php
$roles = [
    [
        "role"       => "frontend developer",
        "multiplier" => 1.2,
    ],
    [
        "role"       => "backend developer",
        "multiplier" => 1.5,
    ],
    [
        "role"       => "design engineer",
        "multiplier" => 3,
    ],
    [
        "role"       => "API developer",
        "multiplier" => 2.5,
    ]
];
function salary(array $arr)
{
    foreach ($arr as $worker_number => $worker) {
        foreach ($worker as $key => $value) {
            $salary = 1000 * $worker['multiplier'];
            if (!is_numeric($value)) {
                echo "Role: $value\n";
            } else {
                echo "Salary: $salary\n";
            }
        }
    }
}

call_user_func('salary', $roles);

