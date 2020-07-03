var requireDir = require('require-dir');

// Search recursively for tasks in ./tasks

requireDir('./gulpfile.config', {recurse: true});
