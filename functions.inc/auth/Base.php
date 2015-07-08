<?php
// vim: set ai ts=4 sw=4 ft=php:
//	License for all code of this FreePBX module can be found in the license file inside the module directory
//	Copyright 2013 Schmooze Com Inc.
//
namespace FreePBX\modules\Userman\Auth;

interface Base {
	/*
	 * Actions to run during Userman Install/Upgrade
	 */
	public function install();

	/*
	 * Actions to run during Userman Uninstall
	 */
	public function uninstall();

	public static function getInfo();
	public static function getConfig($userman);
	public static function saveConfig($userman);
	/**
	 * Return an array of permissions for this adaptor
	 */
	public function getPermissions();

	/**
	 * Get All Users
	 *
	 * Get a List of all User Manager users and their data
	 *
	 * @return array
	 */
	public function getAllUsers();

	/**
	 * Get All Groups
	 *
	 * Get a List of all User Manager users and their data
	 *
	 * @return array
	 */
	public function getAllGroups();

	/**
	 * Get all Users as contacts
	 *
	 * @return array
	 */
	public function getAllContactInfo();

	/**
	 * Get User Information by the Default Extension
	 *
	 * This gets user information from the user which has said extension defined as it's default
	 *
	 * @param string $extension The User (from Device/User Mode) or Extension to which this User is attached
	 * @return bool
	 */
	public function getUserByDefaultExtension($extension);

	/**
	 * Get User Information by Username
	 *
	 * This gets user information by username
	 *
	 * @param string $username The User Manager Username
	 * @return bool
	 */
	public function getUserByUsername($username);

	/**
	 * Get User Information by Username
	 *
	 * This gets user information by username
	 *
	 * @param string $username The User Manager Username
	 * @return bool
	 */
	public function getGroupByUsername($groupname);

	/**
	 * Get User Information by Email
	 *
	 * This gets user information by Email
	 *
	 * @param string $username The User Manager Email Address
	 * @return bool
	 */
	public function getUserByEmail($username);

	/**
	 * Get User Information by User ID
	 *
	 * This gets user information by User Manager User ID
	 *
	 * @param string $id The ID of the user from User Manager
	 * @return bool
	 */
	public function getUserByID($id);

	/**
	 * Get User Information by User ID
	 *
	 * This gets user information by User Manager User ID
	 *
	 * @param string $id The ID of the user from User Manager
	 * @return bool
	 */
	public function getGroupByGID($gid);

	/**
	 * Get all Groups that this user is a part of
	 * @param int $uid The User ID
	 */
	public function getGroupsByID($uid);

	/**
	 * Get User Information by Username
	 *
	 * This gets user information by username.
	 * !!This should never be called externally outside of User Manager!!
	 *
	 * @param string $id The ID of the user from User Manager
	 * @return array
	 */
	public function deleteUserByID($id);

	/**
	 * Delete a Group by it's ID
	 * @param int $gid The group ID
	 */
	public function deleteGroupByGID($gid);

	/**
	 * Add a user to User Manager
	 *
	 * This adds a new user to user manager
	 *
	 * @param string $username The username
	 * @param string $password The user Password
	 * @param string $default The default user extension, there is an integrity constraint here so there can't be duplicates
	 * @param string $description a short description of this account
	 * @param array $extraData A hash of extra data to provide about this account (work, email, telephone, etc)
	 * @param bool $encrypt Whether to encrypt the password or not. If this is false the system will still assume its hashed as sha1, so this is only useful if importing accounts with previous sha1 passwords
	 * @return array
	 */
	public function addUser($username, $password, $default='none', $description=null, $extraData=array(), $encrypt = true);

	/**
	 * Update a User in User Manager
	 *
	 * This Updates a User in User Manager
	 *
	 * @param int $uid The User ID
	 * @param string $username The username
	 * @param string $password The user Password
	 * @param string $default The default user extension, there is an integrity constraint here so there can't be duplicates
	 * @param string $description a short description of this account
	 * @param array $extraData A hash of extra data to provide about this account (work, email, telephone, etc)
	 * @param string $password The updated password, if null then password isn't updated
	 * @return array
	 */
	public function updateUser($uid, $prevUsername, $username, $default='none', $description=null, $extraData=array(), $password=null);
	/**
	 * Update Group
	 * @param string $prevGroupname The group's previous name
	 * @param string $groupname     The Groupname
	 * @param string $description   The group description
	 * @param array  $users         Array of users in this Group
	 */
	public function updateGroup($gid, $prevGroupname, $groupname, $description=null, $users=array());

	/**
	 * Check Credentials against username with a passworded sha
	 * @param {string} $username      The username
	 * @param {string} $password_sha1 The sha
	 */
	public function checkCredentials($username, $password);

	/**
	 * Add Group
	 * @param string $groupname   The Group Name
	 * @param string $description The group description
	 * @param array  $users       Array of Userman User IDs
	 */
	public function addGroup($groupname, $description=null, $users=array());
}
