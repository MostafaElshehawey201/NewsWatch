<?php
return [
    // name
    'name.required' => 'Name is required.',
    'name.string'   => 'Name must be a string.',
    'name.max'      => 'Name may not be greater than 255 characters.',

    // email
    'email.required' => 'Email is required.',
    'email.email'    => 'Email format is invalid.',
    'email.max'      => 'Email may not be greater than 255 characters.',
    'email.unique'   => 'Email already exists.',

    // phone
    'phone.required'        => 'Phone number is required.',
    'phone.digits_between'  => 'Phone number must be between 10 and 15 digits.',
    'phone.unique'          => 'Phone number already exists.', 


    // password
    'password.required'   => 'Password is required.',
    'password.string'     => 'Password must be a string.',
    'password.min'        => 'Password must be at least 6 characters.',
    'password.confirmed'  => 'Password confirmation does not match.',

    "Media_reporter" => "Media Reporter",
    "visitor" => "Visitor",
    "signup" => "Sign Up",
];
