<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Verify my Codeigniter Framework</title>
    <style>
        /* a small css reset */
        html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video {padding: 0; border: 0; font-size: 100%; font: inherit; vertical-align: baseline;}
        article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section {display: block;}
        body {line-height: 1;}
        /* and some styling */
        strong {font-weight:bold;}
        body {font-family: "Arial", Helvetica, Arial, sans-serif;font-size: 14px;background-color: #fefedc;color: #1f191d;}
        ul {list-style: none;}
        h1 {font-size: 24px;font-weight: bold;text-align: center;line-height: 48px;}
        table {border-collapse: collapse; border-spacing: 0;width: 820px;}
        table, th, td {border: 1px solid #3a6fb7;background-color: #caebfc;margin: 10px auto;}
        th, td {padding: 5px;vertical-align: middle;}
        th {text-align: right;background-color: #3a6fb7;color: #fefedc;}
        thead th {background-color: #ff3f7b;font-size: 18px;font-weight: bold;color: #fefedc;text-align: center;}
        .center {text-align: center;}
        .red {color: #ff3f7b;}
    </style>
</head>
<body>
<h1>My Codeigniter Framework:</h1>
<table>
    <thead>
    <tr>
        <th>Environment</th>
    </tr>
    <thead><tbody>
    <tbody>
    <tr>
        <td>
            <?= $environment; ?>
        </td>
    </tr>
    </tbody>
</tbody></table>
<table>
    <thead>
    <tr>
        <th colspan="3">Loader settings</th>
    </tr>
    <thead><tbody>
    <tbody>
    <tr>
        <th class="center">Loaded classes:</th>
        <th class="center">Loaded helpers:</th>
        <th class="center">Loaded models:</th>
    </tr>
    <tr>
        <td>
            <ul>
                <?php
                foreach ($loaded_classes as $class) {
                    echo '<li>' . $class . '</li>';
                }
                ?>
            </ul>
        </td>
        <td>
            <ul>
                <?php
                foreach ($loaded_helpers as $helper) {
                    echo '<li>' . $helper . '</li>';
                }
                ?>
            </ul>
        </td>
        <td>
            <ul>
                <?php
                foreach ($loaded_models as $model) {
                    echo '<li>' . $model . '</li>';
                }
                ?>
            </ul>
        </td>
    </tr>
    </tbody>
</tbody></table>
<div style="clear:both; width: 820px; margin:auto;">
<div style="float: left;">
    <table style="width: 400px;">
        <thead>
        <tr>
            <th colspan="2">Configuration:</th>
        </tr>
        <thead><tbody>
        <tbody>
        <tr>
            <th>Base URL:</th>
            <td><?= $config['base_url']; ?></td>
        </tr>
        <tr>
            <th>Index page:</th>
            <td><?= $config['index_page']; ?></td>
        </tr>
        <tr>
            <th>Language:</th>
            <td><?= $config['language']; ?></td>
        </tr>
        <tr>
            <th>Charset:</th>
            <td><?= $config['charset']; ?></td>
        </tr>
        <tr>
            <th>Enable Hooks:</th>
            <td><?=(($config['enable_hooks']) ? 'TRUE' : '<span class="red">FALSE</span>'); ?></td>
        </tr>
        <tr>
            <th>Subclass prefix:</th>
            <td><?= $config['subclass_prefix']; ?></td>
        </tr>
        <tr>
            <th>Composer autoload:</th>
            <td><?=(($config['composer_autoload']) ? 'TRUE' : '<span class="red">FALSE</span>'); ?></td>
        </tr>
        <tr>
            <th>Permited URI chars:</th>
            <td><?= $config['permitted_uri_chars']; ?></td>
        </tr>
        <tr>
            <th>Allow GET array:</th>
            <td><?=(($config['allow_get_array']) ? 'TRUE' : '<span class="red">FALSE</span>'); ?></td>
        </tr>
        <tr>
            <th>Enable query strings:</th>
            <td><?=(($config['enable_query_strings']) ? 'TRUE' : '<span class="red">FALSE</span>'); ?></td>
        </tr>
        <tr>
            <th>Controller trigger:</th>
            <td><?= $config['controller_trigger']; ?></td>
        </tr>
        <tr>
            <th>Function trigger:</th>
            <td><?= $config['function_trigger']; ?></td>
        </tr>
        <tr>
            <th>Directory trigger:</th>
            <td><?= $config['directory_trigger']; ?></td>
        </tr>
        <tr>
            <th>Log threshold:</th>
            <td><?= $config['log_threshold']; ?></td>
        </tr>
        <tr>
            <th>Log path:</th>
            <td><?=(($config['log_path']) ? $config['log_path'] : 'DEFAULT'); ?></td>
        </tr>
        <tr>
            <th>Log file extension:</th>
            <td><?=(($config['log_file_extension']) ? $config['log_file_extension'] : 'DEFAULT'); ?></td>
        </tr>
        <tr>
            <th>Log file permissions:</th>
            <td><?= $config['log_file_permissions']; ?></td>
        </tr>
        <tr>
            <th>Log date format:</th>
            <td><?= $config['log_date_format']; ?></td>
        </tr>
        <tr>
            <th>Error views path:</th>
            <td><?=(($config['error_views_path']) ? $config['error_views_path'] : 'DEFAULT'); ?></td>
        </tr>
        <tr>
            <th>Cache path:</th>
            <td><?=(($config['error_views_path']) ? $config['cache_path'] : 'DEFAULT'); ?></td>
        </tr>
        <tr>
            <th>Standardize new lines:</th>
            <td><?=(($config['standardize_newlines']) ? 'TRUE' : '<span class="red">FALSE</span>'); ?></td>
        </tr>
        <tr>
            <th>Compress output:</th>
            <td><?=(($config['compress_output']) ? 'TRUE' : '<span class="red">FALSE</span>'); ?></td>
        </tr>
        <tr>
            <th>Time reference:</th>
            <td><?= $config['time_reference']; ?></td>
        </tr>
        <tr>
            <th>Rewrite short tags:</th>
            <td><?= $config['rewrite_short_tags'] ? 'TRUE' : '<span class="red">FALSE</span>'; ?></td>
        </tr>
        <tr>
            <th>Reverse Proxy IPs:</th>
            <td><?= $config['proxy_ips']; ?></td>
        </tr>
        </tbody>
    </tbody></table>
    
</div>
<div style="float: right; width: 400px;">
    <table style="width: 100%;">
        <thead>
        <tr>
            <th>Writable directories</th>
        </tr>
        <thead><tbody>
        <tbody>
        <?php
        echo ($writable_cache) ? '<tr><td>The cache directory is writable</td></tr>' : '<tr><td><span class="red">The cache directory is not writable</span></td></tr>';
        echo ($writable_logs) ? '<tr><td>The logs directory is writable</td></tr>' : '<tr><td><span class="red">The logs directory is not writable</span></td></tr>';
        echo '<tr><td>'.$writable_uploads.'</td></tr>';
        ?>
        </tbody>
    </tbody></table>
    <table style="width: 100%;">
        <thead>
        <tr>
            <th colspan="2">XSS:</th>
        </tr>
        <thead><tbody>
        <tbody>
        <tr>
            <th>Global XSS filter:</th>
            <td><?=(($config['global_xss_filtering']) ? 'TRUE' : '<span class="red">FALSE</span>'); ?></td>
        </tr>
        </tbody>
    </tbody></table>
    <table style="width: 100%;">
        <thead>
        <tr>
            <th colspan="2">CSRF protection</th>
        </tr>
        <thead><tbody>
        <tbody>
        <tr>
            <th>CSRF protection:</th>
            <td><?=(($config['csrf_protection']) ? 'TRUE' : '<span class="red">FALSE</span>'); ?></td>
        </tr>
        <tr>
            <th>CSRF token name:</th>
            <td><?= $config['csrf_token_name']; ?></td>
        </tr>
        <tr>
            <th>CSRF cookie name:</th>
            <td><?= $config['csrf_cookie_name']; ?></td>
        </tr>
        <tr>
            <th>CSRF expire:</th>
            <td><?= $config['csrf_expire']; ?></td>
        </tr>
        <tr>
            <th>CSRF regenerate:</th>
            <td><?=(($config['csrf_regenerate']) ? 'TRUE' : '<span class="red">FALSE</span>'); ?></td>
        </tr>
        <tr>
            <th>CSRF exclude URIs:</th>
            <td>
                <?php
                if (sizeof($config['csrf_exclude_uris']) > 0) {
                    foreach ($config['csrf_exclude_uris'] as $excluded) {
                        echo $excluded;
                    }
                }
                ?>
            </td>
        </tr>
        </tbody>
    </tbody></table>
    <table style="width: 100%;">
        <thead>
        <tr>
            <th colspan="2">Sessions and cookies</th>
        </tr>
        <thead><tbody>
        <tbody>
        <tr>
            <th>Encryption key:</th>
            <td><?= $config['encryption_key']; ?></td>
        </tr>
        <tr>
            <th>Session driver:</th>
            <td><?= $config['sess_driver']; ?></td>
        </tr>
        <tr>
            <th>Session cookie name:</th>
            <td><?= $config['sess_cookie_name']; ?></td>
        </tr>
        <tr>
            <th>Session expiration:</th>
            <td><?= ($config['sess_expiration']==0) ? 'Expire on close' : $config['sess_expiration']; ?></td>
        </tr>
        <tr>
            <th>Session encrypt cookie:</th>
            <td><?=(($config['sess_encrypt_cookie']) ? 'TRUE' : '<span class="red">FALSE</span>'); ?></td>
        </tr>
        <tr>
            <th>Match IP for sessions:</th>
            <td><?=(($config['sess_match_ip']) ? 'TRUE' : '<span class="red">FALSE</span>'); ?></td>
        </tr>
        <tr>
            <th>Session time to update:</th>
            <td><?= $config['sess_time_to_update']; ?></td>
        </tr>
        <tr>
            <th>Cookie prefix:</th>
            <td><?=(($config['cookie_prefix']) ? $config['cookie_prefix'] : 'DEFAULT'); ?></td>
        </tr>
        <tr>
            <th>Cookie domain:</th>
            <td><?=(($config['cookie_domain']) ? $config['cookie_prefix'] : 'DEFAULT'); ?></td>
        </tr>
        <tr>
            <th>Cookie path:</th>
            <td><?= $config['cookie_path']; ?></td>
        </tr>
        <tr>
            <th>Cookie secure:</th>
            <td><?=(($config['cookie_secure']) ? 'TRUE' : '<span class="red">FALSE</span>'); ?></td>
        </tr>
        <tr>
            <th>Cookie HTTP only:</th>
            <td><?=(($config['cookie_httponly']) ? 'TRUE' : '<span class="red">FALSE</span>'); ?></td>
        </tr>
        </tbody>
    </tbody></table>
</div>
<div style="clear:both;">
    <table>
        <thead>
        <tr>
            <th colspan="2">Database:<br/><?= $loaded_database; ?></th>
        </tr>
        <thead><tbody>
        <?php
        if (!empty($db_settings)) {
            ?>
            <tbody>
            <tr>
                <th>DSN:</th>
                <td><?= $db_settings['dsn']; ?></td>
            </tr>
            <tr>
                <th>Hostname:</th>
                <td><?= $db_settings['hostname']; ?></td>
            </tr>
            <tr>
                <th>Port:</th>
                <td><?= $db_settings['port']; ?></td>
            </tr>
            <tr>
                <th>Username:</th>
                <td><?= $db_settings['username']; ?></td>
            </tr>
            <tr>
                <th>Password:</th>
                <td><?= $db_settings['password']; ?></td>
            </tr>
            <tr>
                <th>Database:</th>
                <td><?= $db_settings['database']; ?></td>
            </tr>
            <tr>
                <th>DB Driver:</th>
                <td><?= $db_settings['driver']; ?></td>
            </tr>
            <tr>
                <th>DB Prefix:</th>
                <td><?= $db_settings['dbprefix']; ?></td>
            </tr>
            <tr>
                <th>P Connect:</th>
                <td><?= $db_settings['pconnect']; ?></td>
            </tr>
            <tr>
                <th>DB Debug:</th>
                <td><?= $db_settings['db_debug']; ?></td>
            </tr>
            <tr>
                <th>Cache On:</th>
                <td><?= $db_settings['cache_on']; ?></td>
            </tr>
            <tr>
                <th>Cache Dir:</th>
                <td><?= $db_settings['cachedir']; ?></td>
            </tr>
            <tr>
                <th>Char Set:</th>
                <td><?= $db_settings['char_set']; ?></td>
            </tr>
            <tr>
                <th>DB Collation:</th>
                <td><?= $db_settings['dbcollat']; ?></td>
            </tr>
            <tr>
                <th>Swap pre:</th>
                <td><?= $db_settings['swap_pre']; ?></td>
            </tr>
            <tr>
                <th>Autoinit:</th>
                <td><?= $db_settings['autoinit']; ?></td>
            </tr>
            <tr>
                <th>Encrypt:</th>
                <td><?= $db_settings['encrypt']; ?></td>
            </tr>
            <tr>
                <th>Compress:</th>
                <td><?= $db_settings['compress']; ?></td>
            </tr>
            <tr>
                <th>Stricton:</th>
                <td><?= $db_settings['stricton']; ?></td>
            </tr>
            <tr>
                <th>Failover:</th>
                <td>
                    <?php
                    foreach ($db_settings['failover'] as $fail) {
                        echo $fail . '<br />';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th>Save queries:</th>
                <td><?= $db_settings['save_queries']; ?></td>
            </tr>
            </tbody>
        <?php
        }
        ?>
    </tbody></table>
</div>
</div>
</body>
</html>