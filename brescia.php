<?php

require_once 'brescia.civix.php';

/**
 * Implementation of hook_civicrm_config
 */
function brescia_civicrm_config(&$config) {
  _brescia_civix_civicrm_config($config);
}

/**
 * Implementation of hook_civicrm_xmlMenu
 *
 * @param $files array(string)
 */
function brescia_civicrm_xmlMenu(&$files) {
  _brescia_civix_civicrm_xmlMenu($files);
}

/**
 * Implementation of hook_civicrm_install
 */
function brescia_civicrm_install() {
  return _brescia_civix_civicrm_install();
}

/**
 * Implementation of hook_civicrm_uninstall
 */
function brescia_civicrm_uninstall() {
  return _brescia_civix_civicrm_uninstall();
}

/**
 * Implementation of hook_civicrm_enable
 */
function brescia_civicrm_enable() {
  return _brescia_civix_civicrm_enable();
}

/**
 * Implementation of hook_civicrm_disable
 */
function brescia_civicrm_disable() {
  return _brescia_civix_civicrm_disable();
}

/**
 * Implementation of hook_civicrm_upgrade
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed  based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 */
function brescia_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _brescia_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implementation of hook_civicrm_managed
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 */
function brescia_civicrm_managed(&$entities) {
  return _brescia_civix_civicrm_managed($entities);
}

function brescia_civicrm_postProcess( $formName, &$form ) {
  if ($formName == "CRM_Profile_Form_Edit" && ($form->getVar('_gid') == 15 || $form->getVar('_gid') == 24)) {
    // Create tour request activity
    $details = '';
    if (CRM_Utils_Array::value('custom_8', $form->_submitValues)) {
      $details .= '<p>Tour date: '. $form->_submitValues['custom_7_display'].'</p>';
      $details .= '<p>Tour time: '. $form->_submitValues['custom_8'].'</p>';
    }
    if (CRM_Utils_Array::value('custom_42', $form->_submitValues)) {
      $details .= '<p>Tour date: '. $form->_submitValues['custom_41_display'].'</p>';
      $details .= '<p>Tour time: '. $form->_submitValues['custom_42'].'</p>';
    }
    if (CRM_Utils_Array::value('custom_38', $form->_submitValues)) {
      $details .= '<p>I would like to tour: '. $form->_submitValues['custom_38'].'</p>';
    }
    if (CRM_Utils_Array::value('custom_40', $form->_submitValues) != NULL) {
      if ($form->_submitValues['custom_40'] == '1') {
        $details .= '<p>I would like to meet with an an Admissions Officer after my tour: Yes</p>';
      }
      else {
        $details .= '<p>I would like to meet with an an Admissions Officer after my tour: No</p>';
      }
    }
    $params = array(
      'source_contact_id' => $form->getVar('_id'),
      'target_contact_id' => $form->getVar('_id'),
      'activity_type_id' => 52,
      'subject' => 'Tour Request submitted by '. $form->_submitValues['first_name'],
      'activity_date_time' => date('Y-m-d H:i:s'),
      'status_id' => 2,
      'details' => $details,
    );
    civicrm_api3('Activity', 'create', $params);
  }
}