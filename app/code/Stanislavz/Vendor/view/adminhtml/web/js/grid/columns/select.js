define([
    'underscore',
    'Magento_Ui/js/grid/columns/select'
], function (_, Select) {
    'use strict';

    return Select.extend({
        defaults: {
            additionalCustomClass: '',
            customClasses: {
                inactive: 'grid-severity-critical',
                active: 'grid-severity-notice'
            },
            bodyTmpl: 'Stanislavz_Vendor/grid/cells/text'
        },

        /**
         *
         * @param {obj} row
         * @returns {str}
         */
        getCustomClass: function (row) {
            var customClass = this.customClasses[row.status] || '';

            return customClass;
        }
    });
});