<?php

namespace IntoPeople\DatabaseBundle;

final class IntoPeopleDatabaseEvents
{
    const CHANGE_PASSWORD_INITIALIZE = 'into_people_database.change_password.edit.initialize';
    const CHANGE_PASSWORD_SUCCESS = 'into_people_database.change_password.edit.success';
    const CHANGE_PASSWORD_COMPLETED = 'into_people_database.change_password.edit.completed';
    const GROUP_CREATE_INITIALIZE = 'into_people_database.group.create.initialize';
    const GROUP_CREATE_SUCCESS = 'into_people_database.group.create.success';
    const GROUP_CREATE_COMPLETED = 'into_people_database.group.create.completed';
    const GROUP_DELETE_COMPLETED = 'into_people_database.group.delete.completed';
    const GROUP_EDIT_INITIALIZE = 'into_people_database.group.edit.initialize';
    const GROUP_EDIT_SUCCESS = 'into_people_database.group.edit.success';
    const GROUP_EDIT_COMPLETED = 'into_people_database.group.edit.completed';
    const PROFILE_EDIT_INITIALIZE = 'into_people_database.profile.edit.initialize';
    const PROFILE_EDIT_SUCCESS = 'into_people_database.profile.edit.success';
    const PROFILE_EDIT_COMPLETED = 'into_people_database.profile.edit.completed';
    const REGISTRATION_INITIALIZE = 'into_people_database.registration.initialize';
    const REGISTRATION_SUCCESS = 'into_people_database.registration.success';
    const REGISTRATION_COMPLETED = 'into_people_database.registration.completed';
    const REGISTRATION_CONFIRM = 'into_people_database.registration.confirm';
    const REGISTRATION_CONFIRMED = 'into_people_database.registration.confirmed';
    const RESETTING_RESET_INITIALIZE = 'into_people_database.resetting.reset.initialize';
    const RESETTING_RESET_SUCCESS = 'into_people_database.resetting.reset.success';
    const RESETTING_RESET_COMPLETED = 'into_people_database.resetting.reset.completed';
    const SECURITY_IMPLICIT_LOGIN = 'into_people_database.security.implicit_login';
}
