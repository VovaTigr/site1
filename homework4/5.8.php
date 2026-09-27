<?php
// 5.8 - Merging two dictionaries
$dict1 = [
    'луна' => ['місяць'],
    'время' => ['час'],
    'бумага' => ['папір'],
    'платье' => ['сукня', 'сукман'],
    'шаг' => ['крок']
];

$dict2 = [
    'луна' => ['місяць', 'місяченько'], 
    'время' => ['пора'],           
    'замок' => ['замок', 'твердиня'],
    'шаг' => ['крок', 'поступ']         
];

$mergedDict = $dict1;

foreach ($dict2 as $word => $translations) {
    if (isset($mergedDict[$word])) {
        $mergedDict[$word] = array_values(array_unique(array_merge($mergedDict[$word], $translations)));
    } else {
        $mergedDict[$word] = $translations;
    }
}

print_r($mergedDict);