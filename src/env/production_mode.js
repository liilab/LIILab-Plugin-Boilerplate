import glob from 'glob';
import { readFileSync, writeFile } from 'fs';

// For entry file selection
glob("liilab-plugin-boilerplate.php", function(err, files) {
        files.forEach(function(item, index, array) {
        var data = readFileSync(item, 'utf8');
        var mapObj = {
            LIILabPluginBoilerplate_DEVELOPMENT : "LIILabPluginBoilerplate_PRODUCTION"
        };
        var result = data.replace(/LIILabPluginBoilerplate_DEVELOPMENT/gi, function(matched){
            return mapObj[matched];
        });
        writeFile(item, result, 'utf8', function (err) {
            if (err) return console.log(err);
        });
        console.log('✅  Production assets enqueued!');
    });
});