<?php
// custome config to control in variables easily
return[
    'image'=>[
        'directory'=>'img',
        'thumbnail'=>[
            'width'=>300,
            'heigth'=>200
        ]
    ],
    
    'uncategorized_id'=>12, // when delete category conating posts ,then all posts modve it to uncategorized_id 
    'admin_id'=>1,  // when delete user conating posts ,then all posts modve it to admin_id 
];
