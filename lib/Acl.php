<?php

namespace lib;

/*
 * Slim Auth Implementation Example
 *
 * @link      http://github.com/jeremykendall/slim-auth-impl Canonical source repo
 * @copyright Copyright (c) 2013-2015 Jeremy Kendall (http://about.me/jeremykendall)
 * @license   http://github.com/jeremykendall/slim-auth-impl/blob/master/LICENSE MIT
 */

use Zend\Permissions\Acl\Acl as ZendAcl;

/**
 * ACL for Slim Auth Implementation Example.
 */
class Acl extends ZendAcl
{
    protected $defaultPrivilege = array('GET');

    public function __construct()
    {
        // APPLICATION ROLES
        $this->addRole('guest');
        // member role "extends" guest, meaning the member role will get all of
        // the guest role permissions by default
        $this->addRole('member', 'guest');
        $this->addRole('admin');

        // APPLICATION RESOURCES
        // Application resources == Slim route patterns
        $this->addResource('/');
        $this->addResource('/login');
        $this->addResource('/logout');
//        $this->addResource('/member');
//        $this->addResource('/admin');
        $this->addResource('/tasks');
        $this->addResource('/task');
        $this->addResource('/task/:id/:jsondata');
        $this->addResource('/task/:id');
        $this->addResource('/users');
        $this->addResource('/user/:id');
        $this->addResource('/user');
        $this->addResource('/user/:id/:jsondata');
        

        // APPLICATION PERMISSIONS
        // Now we allow or deny a role's access to resources.
        // The third argument is 'privilege'. In Slim Auth privilege == HTTP method
//        $this->allow('guest', '/', $this->defaultPrivilege);
        $this->allow('guest', '/login', array('GET', 'POST'));
        $this->allow('guest', '/logout', $this->defaultPrivilege);

//        $this->allow('member', '/member', $this->defaultPrivilege);
        $this->allow('member', '/', $this->defaultPrivilege);
        $this->allow('member', '/tasks', $this->defaultPrivilege);
        $this->allow('member', '/task', array('GET', 'POST'));
        $this->allow('member', '/task/:id/:jsondata', array('GET', 'PUT'));
        $this->allow('member', '/task/:id', array('GET', 'DELETE'));

        // This allows admin access to everything
        $this->allow('admin');
    }
}
