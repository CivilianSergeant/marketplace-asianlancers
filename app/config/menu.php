<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 9/14/14
 * Time: 3:17 PM
 */

return array(
  'freelancer' =>array(
      'main'=>array(
          'overview'    => array('title'=>'Profile','route'=>'freelancer/overview', 'icon'=>'job-overview'),
          'my-job-invitation' => array('title'=>'My Job Invitation','route'=>'freelancer/my-job-invitation','icon'=>'job-invaitation'),
          'my-job-request' => array('title'=>'My Job Request','route'=>'freelancer/my-job-request','icon'=>'job-request'),
          'active-jobs' => array('title'=>'Active Jobs','route'=>'freelancer/active-jobs','icon'=>'job-invaitation'),
          'job-history' => array('title'=>'Completed job list','route'=>'freelancer/job-history','icon'=>'job-history'),
          'skills'      => array('title'=>'Skills','route'=>'freelancer/skills','icon'=>'job-skills'),
          'portfolio'   => array('title'=>'Portfolio','route'=>'freelancer/portfolio','icon'=>'job-portfolio'),
          'agencies'    => array('title'=>'My Agencies', 'route'=> 'freelancer/agencies','icon'=>'job-agencies'),
          'finance'    => array('title'=>'Finance', 'route'=> 'freelancer/finance','icon'=>'job-agencies')
      ),
      'popup'=>array(
          'profile' => array('title'=>'Profile','route'=>'freelancer/overview','icon'=>''),
          'settings' => array('title'=>'Settings','route'=>'setting/freelancer', 'icon'=>''),
          'change-password' => array('title'=>'Change Password','route'=>'setting/change-password','icon'=>''),
          'login-admin' => array('title'=>'Login As Admin','route'=>'setting/login-admin','icon'=>'')
      )
  ),
  'agency' => array(
    'main' => array(
        'search-member'     => array('title'=>'Find Individual', 'route' => 'agency/search-member'),
        'members'     => array('title'=>'My Team', 'route' => 'agency/members')
    )
  ),
  'admin' => array(
      'main' => array(
          /*'all-jobs'=> array('title'=>' All Job ','route'=>'jobPost/all-jobs'),*/
          'admin'=> array('title'=>' Overview','route'=>'admin'),
          'notifications'=> array('title'=>' Notifications','route'=>'admin/notifications'),
          'request-jobs' => array('title'=>'Requested job list','route'=>'jobPost/request-jobs'),
          'new-jobs'=> array('title'=>' New job list','route'=>'jobPost/new-jobs'),
          'progress-jobs'=> array('title'=>' Progress job list','route'=>'jobPost/progress-jobs'),
          'complete-jobs'=> array('title'=>' Complete job list','route'=>'jobPost/complete-jobs'),
          'jobcategory'=> array('title'=>' Job Category','route'=>'jobcategory'),
          'jobpricecategory'=> array('title'=>' Job Price Category','route'=>'jobpricecategory'),
          'render-skill'=> array('title'=>' Skill','route'=>'skill'),
          'lists'=> array('title'=>' Q Builder','route'=>'qbuilder/lists'),
          'create-default-profile'=> array('title'=>' Create User','route'=>'admin/create-default-profile'),
          'show-all-users'=> array('title'=>' User List','route'=>'admin/show-all-users'),
          'page' => array('title' => 'Page Management','route'=>'page/'),
          'widget' => array('title'=> 'Widget Management','route'=>'widget/')
      ),
      'popup'=>array(
          'profile' => array('title'=>'Profile','route'=>'admin'),
          'settings' => array('title'=>'Settings','route'=>'setting/admin'),
          'change-password' => array('title'=>'Change Password','route'=>'setting/change-password')
      )
  ),
  'client' => array(
      'main' => array(
          'client'=> array('title'=>' Profile','route'=>'client'),
          'all-notification' => array('title'=>'Notifications','route'=>'client/all-notification'),
          'request-jobs' => array('title'=>'Requested job list','route'=>'jobPost/request-jobs'),
          'new-jobs'=> array('title'=>' New job list','route'=>'jobPost/new-jobs'),
          'progress-jobs'=> array('title'=>' Progress job list','route'=>'jobPost/progress-jobs'),
          'complete-jobs'=> array('title'=>' Complete job list','route'=>'jobPost/complete-jobs'),
          'payment-request' => array('title'=>'Payment Request','route'=>'client/payment-request'),
          'finance'    => array('title'=>'Finance', 'route'=> 'client/finance')
      ),
      'popup'=>array(
          'profile' => array('title'=>'Profile','route'=>'client/profile'),
          'settings' => array('title'=>'Settings','route'=>'setting/client'),
          'change-password' => array('title'=>'Change Password','route'=>'setting/change-password'),
          'login-admin' => array('title'=>'Login As Admin','route'=>'setting/login-admin')
      )
  )

);