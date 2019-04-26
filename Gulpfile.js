process.env.DISABLE_NOTIFIER = true;

'use strict';

var pkg = require('./package.json'),
    gulp = require('gulp'),
    toolkit = require('gulp-wp-toolkit');

toolkit.extendConfig(
    {
        theme: {
            name: pkg.theme.name,
            themeuri: pkg.theme.uri,
            description: pkg.description,
            author: pkg.author,
            authoruri: pkg.theme.authoruri,
            version: pkg.version,
            license: pkg.license,
            licenseuri: pkg.theme.licenseuri,
            tags: pkg.theme.tags,
            textdomain: pkg.theme.textdomain,
            domainpath: pkg.theme.domainpath,
            template: pkg.theme.template,
            notes: pkg.theme.notes
        },
        src: {
            php: ['**/*.php', '!vendor/**'],
            i18n: './assets/lang/'
        },
        dest: {
            i18npo: './assets/lang/',
            i18nmo: './assets/lang/',
        },
    }
);

toolkit.extendTasks(gulp, {});





