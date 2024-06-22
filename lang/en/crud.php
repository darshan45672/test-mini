<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'activities' => [
        'name' => 'Activities',
        'index_title' => 'Activities List',
        'new_title' => 'New Activity',
        'create_title' => 'Create Activity',
        'edit_title' => 'Edit Activity',
        'show_title' => 'Show Activity',
        'inputs' => [
            'student_id' => 'Student',
            'activity_type_id' => 'Activity Type',
            'activityreport' => 'Activityreport',
            'certificate' => 'Certificate',
            'duration' => 'Duration',
            'title' => 'Title',
            'description' => 'Description',
        ],
    ],

    'colleges' => [
        'name' => 'Colleges',
        'index_title' => 'Colleges List',
        'new_title' => 'New College',
        'create_title' => 'Create College',
        'edit_title' => 'Edit College',
        'show_title' => 'Show College',
        'inputs' => [
            'name' => 'Name',
            'code' => 'Code',
            'email' => 'Email',
            'website' => 'Website',
            'address' => 'Address',
        ],
    ],

    'departments' => [
        'name' => 'Departments',
        'index_title' => 'Departments List',
        'new_title' => 'New Department',
        'create_title' => 'Create Department',
        'edit_title' => 'Edit Department',
        'show_title' => 'Show Department',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'faculties' => [
        'name' => 'Faculties',
        'index_title' => 'Faculties List',
        'new_title' => 'New Faculty',
        'create_title' => 'Create Faculty',
        'edit_title' => 'Edit Faculty',
        'show_title' => 'Show Faculty',
        'inputs' => [
            'user_id' => 'User',
            'department_id' => 'Department',
        ],
    ],

    'ho_ds' => [
        'name' => 'Ho Ds',
        'index_title' => 'HoDS List',
        'new_title' => 'New Ho d',
        'create_title' => 'Create HoD',
        'edit_title' => 'Edit HoD',
        'show_title' => 'Show HoD',
        'inputs' => [
            'department_id' => 'Department',
            'age' => 'Age',
        ],
    ],

    'students' => [
        'name' => 'Students',
        'index_title' => 'Students List',
        'new_title' => 'New Student',
        'create_title' => 'Create Student',
        'edit_title' => 'Edit Student',
        'show_title' => 'Show Student',
        'inputs' => [
            'user_id' => 'User',
            'college_id' => 'College',
            'department_id' => 'Department',
            'sem' => 'Sem',
            'usn' => 'Usn',
        ],
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'photo' => 'Photo',
            'password' => 'Password',
            'address' => 'Address',
            'role' => 'role',
        ],
    ],

    'activity_types' => [
        'name' => 'Activity Types',
        'index_title' => 'ActivityTypes List',
        'new_title' => 'New Activity type',
        'create_title' => 'Create ActivityType',
        'edit_title' => 'Edit ActivityType',
        'show_title' => 'Show ActivityType',
        'inputs' => [
            'title' => 'Title',
            'description' => 'Description',
            'credits' => 'Credits',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
