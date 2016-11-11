<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Common Language Lines
    |--------------------------------------------------------------------------
    |
    | The language lines below are used commonly throughout the application.
    |
    */

    // Navigation
    'create_issue' => 'Create Issue',
    'projects' => 'Projects',
    'project' => 'Project',
    'logout' => 'Log out',
    'my_profile' => 'My profile',
    'settings' => 'Settings',
    'administration' => 'Administration',

    'forgotpassword_response' => 'In case the mail you provided is attached to a user account, you will receive a mail with instructions within short time.',

    // Settings navigation
    'dashboard' => 'Dashboard',
    'users' => 'Users',
    'categories' => 'Categories',
    'priorities' => 'Priorities',
    'milestones' => 'Milestones',
    'milestone' => 'Milestone',

    // Issues
    'all_open_issues' => 'All open issues',
    'my_issues' => 'My issues',
    'users_issues' => ':name\'s issues',
    'assignee' => 'Assignee',
    'priority' => 'Priority',
    'title' => 'Title',
    'issue_title' => 'Issue title',
    'issue_title_help' => 'Issue title, short and descriptive...',
    'issue_description' => 'Issue description',
    'add_comment' => 'Add comment',
    'add_a_comment' => 'Add a comment',
    'you_can_use_markdown' => 'You can use Markdown for formatting.',
    'assigned_to' => 'Assigned to',
    'created_by' => 'Created by',
    'created' => 'Created',
    'updated' => 'Updated',
    'button_comment' => 'Comment',
    'button_assign' => 'Assign',
    'button_edit' => 'Edit',
    'button_resolve' => 'Resolve',
    'assign_issue' => 'Assign issue',
    'edit_issue' => 'Edit issue',
    'estimate' => 'Estimate',

    'assign_to' => 'Assign to...',
    'category' => 'Category',
    'estimate_placeholder' => 'e.g. 1w 2d 4h 10m',

    'name' => 'Name',
    'email' => 'E-mail',
    'email_address' => 'E-mail address',
    'created_at' => 'Created',

    'current_active_users' => 'You currently have :num_users active user.|You currently have :num_users active users.',
    'current_inactive_users' => 'You currently have :num_users inactive user.|You currently have :num_users inactive users.',
    'show_inactive_users' => 'Show inactive users',
    'show_active_users' => 'Show active users',
    'edit_user' => 'Edit user',
    'create_user' => 'Create user',
    'delete_user' => 'Delete user',
    'password' => 'Password',
    'confirm_password' => 'Confirm password',
    'change_password_help' => 'Only change this if you want to update the users password.',
    'usertype' => 'Usertype',
    'user' => 'User',
    'administrator' => 'Administrator',

    'success' => 'Success',
    'error' => 'Error',
    'user_was_updated' => 'User was updated',
    'user_was_created' => 'User was created',
    'user_was_deleted' => 'User was deleted',
    'user_was_activated' => 'User was activated',

    'confirm_deletion_user_header' => 'Delete :name?',
    'confirm_deletion_user_text' => 'You are currently in the process of deleting a user. All issues assigned to this user will be assigned the the \'Unassigned\' user.',
    'confirm_deletion_user_text_second' => 'This user currently has :num issue assigned.|This user currently has :num issues assigned.',
    'confirm_deletion_user_text_third' => 'Please be aware, that the user is not really deleted, but merely deactivated and can be reactivated at a later point if needed.',
    'confirm_delete_user' => 'Confirm delete',

    'create_project' => 'Create project',
    'edit_project' => 'Edit project',
    'delete_project' => 'Delete project',
    'projects_description' => 'An issue needs to be attached to a project.',
    'projects_description_second' => 'You\'re able to delete a project with open and resolved issues, but deleting a project forces you to delete the issues attached to a project.',
    'project_was_updated' => 'Project was updated',
    'project_was_created' => 'Project was created',
    'project_was_deleted' => 'Project was deleted',

    'confirm_deletion_project_header' => 'Delete :name?',
    'confirm_deletion_project_text' => 'You are currently in the process of deleting a project. All issues assigned to this project will be deleted with no possibility of recovery.',
    'confirm_deletion_project_text_second' => 'This project currently has :num issue assigned.|This project currently has :num issues assigned.',
    'confirm_deletion_project_text_third' => 'This action is not reversable!',
    'confirm_delete_project' => 'Confirm delete',

    'icon' => 'Icon',
    'icon_possibilities' => 'Icon possibilities',
    'create_category' => 'Create category',
    'edit_category' => 'Edit category',
    'delete_category' => 'Delete category',
    'new_category' => 'New category',
    'categories_description' => 'Issues has categories to group by. An issue needs a category.',
    'categories_description_second' => 'You\'re able to delete a category with open and resolved issues, but deleting a category forces you to provide another category attached issues should be attached to instead.',
    'category_was_updated' => 'Category was updated',
    'category_was_created' => 'Category was created',
    'category_was_deleted' => 'category was deleted',

    'confirm_deletion_category_header' => 'Delete :name?',
    'confirm_deletion_category_text' => 'You are currently in the process of deleting a category. All issues attached to this category needs to be reattached to another category.',
    'confirm_deletion_category_text_second' => 'This category currently has :num issue attached.|This category currently has :num issues attached.',
    'confirm_delete_category' => 'Confirm delete',

    'create_priority' => 'Create priority',
    'edit_priority' => 'Edit priority',
    'delete_priority' => 'Delete priority',
    'new_priority' => 'New priority',
    'priorities_description' => 'Issues needs to be prioritized. This is for easy sorting which issues are most important to work on.',
    'priorities_description_second' => 'The default priority is labeled in the list, which enables a user to skip selecting a priority when creating an issue. You can change the default priority by pressing the star button.',
    'priorities_description_third' => 'The sorting defines the priority. You can change the sorting by pressing the arrows in the list to fit your needs.',
    'priority_was_updated' => 'Priority was updated',
    'priority_was_created' => 'Priority was created',
    'priority_was_deleted' => 'Priority was deleted',
    'priority_default' => 'Default',

    'confirm_deletion_priority_header' => 'Delete :name?',
    'confirm_deletion_priority_text' => 'You are currently in the process of deleting a priority. All issues attached to this priority needs to be reattached to another priority.',
    'confirm_deletion_priority_text_second' => 'This priority currently has :num issue attached.|This priority currently has :num issues attached.',
    'confirm_delete_priority' => 'Confirm delete',


    'create_milestone' => 'Create milestone',
    'edit_milestone' => 'Edit milestone',
    'delete_milestone' => 'Delete milestone',
    'new_milestone' => 'New milestone',
    'milestones_description' => 'Milestones is a way of grouping your issues in to time slots.',
    'milestones_description_second' => 'It\'s possible to create issues without providing milestones.',
    'milestone_was_updated' => 'Milestone was updated',
    'milestone_was_created' => 'Milestone was created',
    'milestone_was_deleted' => 'Milestone was deleted',
    'milestone_date' => 'Milestone date',
    'milestone_date_placeholder' => 'YYYY-MM-DD',

    'confirm_deletion_milestone_header' => 'Delete :name?',
    'confirm_deletion_milestone_text' => 'You are currently in the process of deleting a milestone. All issues attached to this priority will no longer be attached to a milestone.',
    'confirm_deletion_milestone_text_second' => 'This milestone currently has :num issue attached.|This milestone currently has :num issues attached.',
    'confirm_delete_milestone' => 'Confirm delete',

    
    'issues' => 'Issues',
    'search' => 'Search',
    'submit' => 'Submit',
    'search_results' => 'Search results',

    'update' => 'Update',
    'create' => 'Create',
    'activate' => 'Activate',

    
    // 404
    'whoops' => 'Whoops...',
    'sorry' => 'Sorry, but I really don\'t know what you\'re looking for.',
    'how_about_looking_at_your_issues' => 'How about looking at <a href=":link">your issues</a>?',

    //403
    'unauthorized' => 'You\'re not allowed to do this.',
    'missing_rights' => 'Sorry, but you haven\'t got the correct permissions to access this area.',

];
