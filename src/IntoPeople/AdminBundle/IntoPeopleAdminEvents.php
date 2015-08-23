<?php

namespace IntoPeople\AdminBundle;

final class IntoPeopleAdminEvents
{
    const CHANGE_PASSWORD_INITIALIZE = 'into_people_admin.change_password.edit.initialize';
    const CHANGE_PASSWORD_SUCCESS = 'into_people_admin.change_password.edit.success';
    const CHANGE_PASSWORD_COMPLETED = 'into_people_admin.change_password.edit.completed';
    const GROUP_CREATE_INITIALIZE = 'into_people_admin.group.create.initialize';
    const GROUP_CREATE_SUCCESS = 'into_people_admin.group.create.success';
    const GROUP_CREATE_COMPLETED = 'into_people_admin.group.create.completed';
    const GROUP_DELETE_COMPLETED = 'into_people_admin.group.delete.completed';
    const GROUP_EDIT_INITIALIZE = 'into_people_admin.group.edit.initialize';
    const GROUP_EDIT_SUCCESS = 'into_people_admin.group.edit.success';
    const GROUP_EDIT_COMPLETED = 'into_people_admin.group.edit.completed';
    const PROFILE_EDIT_INITIALIZE = 'into_people_admin.profile.edit.initialize';
    const PROFILE_EDIT_SUCCESS = 'into_people_admin.profile.edit.success';
    const PROFILE_EDIT_COMPLETED = 'into_people_admin.profile.edit.completed';
    const REGISTRATION_INITIALIZE = 'into_people_admin.registration.initialize';
    const REGISTRATION_SUCCESS = 'into_people_admin.registration.success';
    const REGISTRATION_COMPLETED = 'into_people_admin.registration.completed';
    const REGISTRATION_CONFIRM = 'into_people_admin.registration.confirm';
    const REGISTRATION_CONFIRMED = 'into_people_admin.registration.confirmed';
    const RESETTING_RESET_INITIALIZE = 'into_people_admin.resetting.reset.initialize';
    const RESETTING_RESET_SUCCESS = 'into_people_admin.resetting.reset.success';
    const RESETTING_RESET_COMPLETED = 'into_people_admin.resetting.reset.completed';
    const SECURITY_IMPLICIT_LOGIN = 'into_people_admin.security.implicit_login';
}
