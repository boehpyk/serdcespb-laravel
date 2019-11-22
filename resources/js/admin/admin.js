/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('bootstrap');
const $ = require('jquery');
require('@chenfengyuan/datepicker');
require('@chenfengyuan/datepicker/i18n/datepicker.ru-RU');

// enable datepicker for date fields in forms
$('[data-toggle="datepicker"]').datepicker({
    format: 'dd.mm.YYYY',
    language: 'ru-RU'
});

$('[data-action="delete"]').on('click', function (e) {
   return window.confirm('Не уверен - не удаляй!!!');
});
