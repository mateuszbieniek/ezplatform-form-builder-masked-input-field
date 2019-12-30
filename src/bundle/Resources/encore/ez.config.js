const path = require('path');

module.exports = (Encore) => {
    Encore.addEntry('ezplatform-form-builder-mb-masked-input', [
        path.resolve(__dirname, '../public/js/inputmask/inputmask.min.js'),
    ]);
};
