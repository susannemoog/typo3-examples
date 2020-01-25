/**
 * Module: TYPO3/CMS/Carl/GenerateData
 *
 * JavaScript to handle data import
 * @exports TYPO3/CMS/Carl/GenerateData
 */
define(function () {
  'use strict';

  /**
   * @exports TYPO3/CMS/Carl/GenerateData
   */
  var GenerateData = {};


  /**
   * initializes events using deferred bound to document
   * so AJAX reloads are no problem
   */
  GenerateData.initializeEvents = function () {

    $('.generateData').on('click', function (evt) {
      evt.preventDefault();
      top.TYPO3.Notification.success('Generation Done', 'yay');
    });
  };

  $(GenerateData.initializeEvents);

  return GenerateData;
});
