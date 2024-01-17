<?php

require_once 'followupactivitydetatils.civix.php';
// phpcs:disable
use CRM_Followupactivitydetatils_ExtensionUtil as E;
// phpcs:enable

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function followupactivitydetatils_civicrm_config(&$config): void {
  _followupactivitydetatils_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function followupactivitydetatils_civicrm_install(): void {
  _followupactivitydetatils_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function followupactivitydetatils_civicrm_enable(): void {
  _followupactivitydetatils_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_buildForm().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_buildForm
 */
function followupactivitydetatils_civicrm_buildForm($formName, &$form) {
  if ($formName == 'CRM_Activity_Form_Activity'
    && !($form->getVar('_action') & CRM_Core_Action::DELETE)
  ) {
    $attributes = (CRM_Core_DAO::getAttribute('CRM_Activity_DAO_Activity', 'details') ?? []) + ['class' => 'collapsed', 'preset' => 'civiactivity'];
    $form->add('wysiwyg', 'follow_up_details', ts('Details'), $attributes);
    CRM_Core_Region::instance('page-body')->add([
      'template' => 'CRM/ActivityFollowUp/Form/Field.tpl',
    ]);
  }
}

/**
 * Implements hook_civicrm_pre().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_pre
 */
function followupactivitydetatils_civicrm_pre($op, $objectName, $id, &$params) {
  if ($objectName == 'Activity' && $op == 'create'
    && !empty($params['parent_id']) && !empty($_POST['follow_up_details'])
    && empty($params['details'])
  ) {
    $params['details'] = $_POST['follow_up_details'];
  }
}
