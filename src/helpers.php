<?php

if (!function_exists('context')) {
    function context() {
        $args = func_get_args();

        if (count($args) === 0) {
            return app(\Scuttlebyte\ContextManager\ContextManager::class);
        }

        if (count($args) === 1) {
            if (is_array($args[0])) {
                foreach ($args[0] as $alias => $value) {
                    app(\Scuttlebyte\ContextManager\ContextManager::class)->put($alias, $value);
                }

                return;
            }

            return app(\Scuttlebyte\ContextManager\ContextManager::class)->get($args[0]);
        }

        return app(\Scuttlebyte\ContextManager\ContextManager::class)->put($args[0], $args[1]);
    }
}
