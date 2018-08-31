<?php

if (!function_exists('context')) {
    function context() {
        return app('request')->context();
    }
}
